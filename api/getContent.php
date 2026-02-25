<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$file = 'CommentMovie.json';
$dataJson = json_decode(file_get_contents($file), true);
$film = $_GET['film'] ?? '';

$log = new Logger('error_logger');
$log->pushHandler(new StreamHandler(__DIR__ . '/../logs/errorlog.log', Logger::ERROR));

if (empty($film) || !isset($dataJson[$film]) || !$dataJson[$film]) {
    $log->error('Aucun commentaire pour le film', ['film' => $film, 'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown']);
    http_response_code(404);
    echo json_encode([
        'Response' => false,
        'error' => 'Aucun commentaire'
    ]);
} else {
    http_response_code(200);
    echo json_encode([
        'Response' => true,
        'message' => $dataJson[$film]
    ]);
}
