<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$log = new Logger('error_logger');
$log->pushHandler(new StreamHandler(__DIR__ . '/../logs/errorlog.log', Logger::ERROR));
// Ajout d'un handler pour les logs d'info (commentaires, cooldown, etc)
$log->pushHandler(new StreamHandler(__DIR__ . '/../logs/commentlog.log', Logger::INFO));
$log->pushHandler(new StreamHandler(__DIR__ . '/../logs/commentlog.log', Logger::WARNING));

$input = file_get_contents('php://input');
$data = json_decode($input, true);

if (
    !isset($data['film'], $data['user'], $data['message']) ||
    empty(trim($data['film'])) ||
    empty(trim($data['user'])) ||
    empty(trim($data['message']))
) {
    $log->error('Champs manquants ou vides', 
    [
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'film ' => $data['film'] ?? 'N/A'
    ]);
    http_response_code(400);
    echo json_encode([
        'Response' => false,
        'error' => 'Veuillez remplir tous les champs'
    ]);
    exit;
}

$film = $data['film'];
$user = $data['user'];
$message = $data['message'];

$cooldownFile = __DIR__ . '/../logs/cooldown.log';
$now = time();
$lastTime = 0;

if (file_exists($cooldownFile)) {
    $lastTime = (int)trim(file_get_contents($cooldownFile));
}

if (($now - $lastTime) < 15) {
    $log->warning('Spam détecté ', [
        'user' => $user,
        'film' => $film,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
    ]);
    http_response_code(429);
    echo json_encode([
        'Response' => false,
        'error' => 'Merci de patienter 8 secondes entre chaque commentaire.'
    ]);
    exit;
}

// Mettre à jour le timestamp global
file_put_contents($cooldownFile, $now);


$bannedWords = ['gay', 'fuck', 'shit', 'bitch'];
foreach ($bannedWords as $word) {
    if (stripos($message, $word) !== false) {
        $log->warning('Mot interdit détecté', [
            'user' => $user,
            'film' => $film,
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
            'message' => $message
        ]);
        http_response_code(403);
        echo json_encode([
            'Response' => false,
            'error' => 'Votre commentaire contient des mots interdits.'
        ]);
        exit;
    }
}

$commentaire = [
    'user' => $user,
    'message' => $message
];

$file = 'CommentMovie.json';
$allComments = [];

if (file_exists($file)) {
    $jsonData = file_get_contents($file);
    $allComments = json_decode($jsonData, true);
    if (!is_array($allComments)) {
        $allComments = [];
    }
}

if (!isset($allComments[$film])) {
    $allComments[$film] = [];
}

$allComments[$film][] = $commentaire;

if (file_put_contents($file, json_encode($allComments, JSON_PRETTY_PRINT))) {
    $log->info('Nouveau commentaire', [
        'user' => $user,
        'film' => $film,
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown',
        'message' => $message
    ]);
    echo json_encode(['message' => 'Commentaire enregistré avec succès']);
} else {
    $log->error('Erreur lors de l\'enregistrement du commentaire', ['film' => $film, 'user' => $user]);
    http_response_code(500);
    echo json_encode(['error' => 'Erreur lors de l\'enregistrement']);
}
