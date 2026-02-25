<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&family=TASA+Orbiter:wght@400..800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Quicksand', sans-serif;
        background-color: black;
        color: white;
        overflow-x: hidden;
    }

    .main-container {
        position: relative;
        height: 70vh;
        background: center/cover no-repeat;
        background-position:center ;
    }

    .overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.3);
        backdrop-filter: blur(30px);
    }

    .logo {
        font-size: 1.8rem;
        font-weight: 900;
        color: #da1c26;
        text-decoration: none;
    }

    .search-bar input {
        background-color: transparent;
        color: white;
        width: 250px;
        border: #ccc 1px solid;
        padding: 5px;
        border-radius: 4px;
    }

    .search-bar input:focus {
        outline: none;
        border-color: #da1c26;
    }

    .search-bar input::placeholder {
        color: #ccc;
    }

    .movie-container {
        position: absolute;
        bottom: 0;
        left: 50%;
        height: 50vh;
        transform: translateX(-50%);
        display: flex;
        flex-direction: row;
        gap: 50px;
        background-color: transparent;
        color: #fff;
        padding: 15px;
        border-radius: 10px;
        max-width: 800px;
        margin: 20px auto;
    }


    .movie-container img {
        width: 300px;
        height: auto;
        border-radius: 10px;
        object-position: center;
        object-fit: cover;
    }

    .text-container {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .text-container h3 {
        margin: 0 0 10px 0;
        font-size: 1.5rem;
        color: #da1c26;
    }

    .text-container p {
        margin: 5px 0;
        line-height: 1.4;
    }

    .commentary-container {
        background-color: rgba(255, 255, 255, 0.05);
        padding: 25px;
        margin: 40px auto;
        border-radius: 15px;
        max-width: 800px;
        color: #fff;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .commentary-container h2 {
        font-size: 1.8rem;
        margin-bottom: 20px;
        color: #da1c26;
    }

    .comment-list {
        list-style: none;
        padding-left: 0;
        max-height: 300px;
        overflow-y: auto;
    }

    .comment-list li {
        background-color: rgba(255, 255, 255, 0.08);
        padding: 12px 18px;
        border-radius: 12px;
        margin-bottom: 12px;
        transition: background-color 0.2s ease;
    }

    .comment-list li:hover {
        background-color: rgba(243, 70, 18, 0.2);
    }

    .comment-list li p {
        margin: 0;
        line-height: 1.5;
        font-size: 0.95rem;
    }

    .comment-list li strong {
        color: #da1c26;
    }

    .comment-form {
        display: flex;
        flex-direction: column;
        gap: 12px;
        margin-top: 20px;
    }

    .comment-form input,
    .comment-form textarea {
        padding: 10px 15px;
        border-radius: 25px;
        border: none;
        background-color: rgba(255, 255, 255, 0.1);
        color: #fff;
        font-size: 0.9rem;
        resize: none;
    }
    .comment-form input:focus,
    .comment-form textarea:focus{

        outline:none;
        border: 1px solid #da1c26;
    }

    .comment-form input::placeholder,
    .comment-form textarea::placeholder {
        color: #ccc;
    }

    .comment-form textarea {
        min-height: 70px;
        border-radius: 20px;
    }

    .comment-form button {
        padding: 10px 20px;
        border-radius: 25px;
        border: none;
        background-color: #da1c26;
        color: #ffffff;
        font-weight: bold;
        cursor: pointer;
        font-size: 0.95rem;
        transition: background-color 0.2s ease;
    }

    .comment-form button:hover {
        background-color: #c41821;
    }
</style>

<body>

    <div class="main-container">
        <div class="overlay">
            <header class="d-flex align-items-center justify-content-between px-5 pt-3">
                <div class="logo" onclick="window.location = 'index.php'">RedFlix</div>
                <div class="search-bar">
                    <input type="text" placeholder="Rechercher un film...">
                </div>
            </header>
            <div class="movie-container" id="movie-spiderman">
                <img src="img/critique-no-way-home-nouvelle-une-630x380.jpg" alt="Spider Man No Way Home"
                    id="movie-img">
                <div class="text-container" id="movie-info">
                    <h3 id="movie-title"></h3>
                    <p id="movie-duration"><strong>Durée :</strong> <span id="movie-duration-text"></span></p>
                    <p id="movie-year"><strong>Année :</strong> <span id="movie-year-text"></span></p>
                    <p id="movie-description"><strong>Synopsis :</strong> <span id="movie-description-text"></span></p>
                    <p id="movie-genre"><strong>Genre :</strong> <span id="movie-genre-text"></span></p>
                    <p id="movie-director"><strong>Réalisateur :</strong> <span id="movie-director-text"></span></p>
                    <p id="movie-rating"><strong>Note :</strong> <span id="movie-rating-text"></span></p>
                </div>
            </div>
        </div>
    </div>
    <div class="commentary-container">
        <h2>Commentaires (<span id="comment-count"></span>)</h2>

        <ul class="comment-list" id="comment-list">

        </ul>

        <div class="comment-form">
            <input type="text" id="username" placeholder="Votre nom">
            <textarea id="comment-text" name="comment-text" placeholder="Votre commentaire"></textarea>
            <button id="add-comment">Ajouter</button>
        </div>
    </div>

    <script>

        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const movieId = urlParams.get('id');

        const movieContainer = document.getElementById('movie-spiderman');
        const mainContainer = document.querySelector('.main-container');
        const movieImg = document.getElementById('movie-img');
        const movieTitle = document.getElementById('movie-title');
        const movieDurationText = document.getElementById('movie-duration-text');
        const movieYearText = document.getElementById('movie-year-text');
        const movieDescriptionText = document.getElementById('movie-description-text');
        const movieGenreText = document.getElementById('movie-genre-text');
        const movieDirectorText = document.getElementById('movie-director-text');
        const movieRatingText = document.getElementById('movie-rating-text');

        fetch(`http://www.omdbapi.com/?apikey=d3c714f6&i=${movieId}`, {
            method: "GET",
        })
            .then(response => response.json())
            .then(data => {
                mainContainer.style.backgroundImage = `url(${data.Poster})`;
                movieImg.src = data.Poster;
                movieTitle.textContent = data.Title;
                movieGenreText.textContent = data.Genre;
                movieYearText.textContent = data.Year;
                movieDurationText.textContent = data.Runtime;
                movieDirectorText.textContent = data.Director;
                movieDescriptionText.textContent = data.Plot;
                movieRatingText.innerHTML = `${data.imdbRating} `;
            })
            .catch(error => {
                console.error("Erreur :", error);
            });


        const input = document.querySelector('input');

        input.addEventListener('keypress', (e) => {

            if (e.key === 'Enter') {

                const value = input.value;
                fetch(`http://www.omdbapi.com/?apikey=d3c714f6&t=${value}`)
                    .then(async response => {

                        const data = await response.json();


                        if (data.Response === 'False') {


                            window.location = 'error.php';
                        }
                        else {

                            window.location = `details.php?id=${data.imdbID}`
                        }

                        return data
                    })
                    .catch(error => {

                        console.error(error.message)
                    })
            }
        });

        document.getElementById('add-comment').addEventListener('click', function () {
            const username = document.getElementById('username');
            const comment = document.getElementById('comment-text');

            const commentaire = {
                film: movieTitle.textContent,
                user: username.value,
                message: comment.value
            }

            fetch('http://localhost:8080/api/server.php', {
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                method: "POST",
                body: JSON.stringify(commentaire)
            })
                .then(async response => {
                    let data = await response.json();
                    if (data.Response === false) {
                        throw new Error(data.error);
                    }
                    temp();
                })
                .catch(error => {
                    console.error(error.message)
                    alert(error.message);
                    return error.message
                })

            username.value = "";
            comment.value = "";
            lastCommentTime = now;
        });

        setTimeout(() => {

            let film = movieTitle.textContent;
            console.log(film)

            fetch(`http://localhost:8080/api/getContent.php?film=${film}`)
                .then(async reponse => {

                    let data = await reponse.json();

                    if (data.Response === false) {

                        throw new Error(data.error);
                    }

                    const commentList = document.getElementById('comment-list');
                    commentList.innerHTML = '';

                    if (data.message.length > 0) {
                        commentList.style.display = 'block';
                        document.getElementById('comment-count').textContent = data.message.length;

                        data.message.forEach(item => {
                            const li = document.createElement('li');
                            const p = document.createElement('p');
                            const strong = document.createElement('strong');

                            strong.textContent = `${item.user} : `;
                            p.textContent = item.message;
                            p.prepend(strong);
                            li.appendChild(p);
                            commentList.appendChild(li);
                        });
                    } else {
                        commentList.style.display = 'none';
                        document.getElementById('comment-count').textContent = 0;
                    }

                    return data;
                })
                .catch(error => {

                    console.log(error.message);
                    document.querySelector('#comment-list').style.display = 'none';
                    document.getElementById('comment-count').textContent = 0;
                    const div = document.createElement('div');
                    document.querySelector('.commentary-container').insertBefore(div, document.querySelector('.comment-form'))
                    div.className = 'message';
                    div.textContent = error.message;
                })
        }, 220)


        const temp = () => {

            let film = movieTitle.textContent;
            console.log(film)

            fetch(`http://localhost:8080/api/getContent.php?film=${film}`)
                .then(async reponse => {

                    let data = await reponse.json();

                    if (data.Response === false) {

                        throw new Error(data.error);
                    }

                    const commentList = document.getElementById('comment-list');
                    commentList.innerHTML = '';

                    if (data.message.length > 0) {
                        commentList.style.display = 'block';
                        document.getElementById('comment-count').textContent = data.message.length;

                        data.message.forEach(item => {
                            const li = document.createElement('li');
                            const p = document.createElement('p');
                            const strong = document.createElement('strong');

                            strong.textContent = `${item.user} : `;
                            p.textContent = item.message;
                            p.prepend(strong);
                            li.appendChild(p);
                            commentList.appendChild(li);
                        });
                    } else {
                        commentList.style.display = 'none';
                        document.getElementById('comment-count').textContent = 0;
                    }

                    return data;
                })
                .catch(error => {

                    console.log(error.message);
                    document.querySelector('#comment-list').style.display = 'none';
                    document.getElementById('comment-count').textContent = 0;
                    const div = document.createElement('div');
                    document.querySelector('.commentary-container').insertBefore(div, document.querySelector('.comment-form'))
                    div.className = 'message';
                    div.textContent = error.message;
                })
        }


    </script>
</body>

</html>