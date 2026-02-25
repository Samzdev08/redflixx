<?php
require_once __DIR__ . '/../vendor/autoload.php';



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Quicksand:wght@300..700&family=TASA+Orbiter:wght@400..800&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

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
            padding: 0 15px;
            position: relative;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6)), center/cover;
            height: 60vh;
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

        .infos-container {
            bottom: 30%;
            left: 5%;
            position: absolute;
        }

        .infos-container button {
            background-color: #da1c26;
            color: white;
            padding: 10px 30px;
            transition: 0.3s;
            border: none;
            border-radius: 4px;
            font-weight: 600;
        }

        .infos-container button:hover {
            transform: scale(1.05);
            background-color: #c41821;
        }

        .text-title {
            bottom: 0;
            left: 5%;
            position: absolute;
        }

        .text-title p {
            font-weight: 700;
            text-shadow: 0 0 10px black;
        }

        .controls {
            position: absolute;
            right: 2%;
            bottom: 4%;
            display: flex;
            gap: 20px;
        }

        .controls button {
            padding: 10px;
            object-fit: cover;
            align-items: center;
            transition: 0.4s;
            background-color: #da1c26;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            width: 45px;
            height: 45px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .controls button:hover {
            opacity: 0.8;
            transform: scale(0.98);
        }

        .controls button:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .slider-container {
            background-color: #2e2e2e;
            height: 35vh;
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 20px;
            overflow-x: auto;
            scroll-behavior: smooth;
            scrollbar-width: none;
            -ms-overflow-style: none;
        }

        .slider-container::-webkit-scrollbar {
            display: none;
        }

        .slider-item.card {
            min-width: 300px;
            max-width: 300px;
            flex-shrink: 0;
            background-color: #6d1717;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            transition: transform 0.3s;
        }

        .slider-item.card:hover {
            transform: translateY(-5px);
        }

        .slider-item.card img {
            width: 100%;
            margin: 0 auto;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            object-position: top;
            height: 200px;
            object-fit: cover;
        }

        .card-content {
            padding: 15px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
            color: white;
        }

        .card-btn {
            background-color: #da1c26;
            border: none;
            text-decoration: none;
            text-align: center;
            color: white;
            padding: 8px;
            cursor: pointer;
            transition: transform 0.3s;
            font-weight: bold;
            border-radius: 4px;
        }

        .card-btn:hover {
            transform: scale(1.05);
            background-color: #c41821;
        }

        .logo {
            font-size: 1.8rem;
            font-weight: 900;
            color: #da1c26;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="main-container">
        <header class="d-flex align-items-center justify-content-between px-5 pt-3">
            <div class="logo" onclick="window.location = 'index.php'">RedFlix</div>
            <div class="search-bar">
                <input type="text" placeholder="Rechercher un film...">
            </div>
        </header>

        <div class="infos-container">
            <p class="h1 fw-bolder fs-0 mb-5"></p>
            <button class="text-uppercase fw-semibold mt-4">View more</button>
        </div>

        <div class="text-title">
            <p class="text-uppercase h4">Nouveautés Estivales</p>
        </div>

        <div class="controls">
            <button id="prevBtn">
                <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                    <path d="M15.41 7.41L14 6l-6 6 6 6 1.41-1.41L10.83 12z" />
                </svg>
            </button>
            <button id="nextBtn">
                <svg width="20" height="20" fill="white" viewBox="0 0 24 24">
                    <path d="M10 6L8.59 7.41 13.17 12l-4.58 4.59L10 18l6-6z" />
                </svg>
            </button>
        </div>
    </div>

    <div class="slider-container" id="slider">
    </div>
    <script>

        const slider = document.getElementById('slider');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const input = document.querySelector('input');

        input.addEventListener('keypress', (e) => {
            if (e.key === 'Enter') {
                const value = input.value;
                fetch(`http://www.omdbapi.com/?apikey=d3c714f6&t=${value}`)
                    .then(async response => {
                        const data = await response.json();
                        if (data.Response === 'False') {
                            window.location = 'error.php';
                        } else {
                            window.location = `details.php?id=${data.imdbID}`;
                        }
                        return data;
                    })
                    .then(data => {
                        console.log("yes");
                    })
                    .catch(error => {
                        console.error(error.message);
                    });
            }
        })


        const scrollDistance = 320;


        function scrollLeft() {
            slider.scrollBy({
                left: -scrollDistance,
                behavior: 'smooth'
            });
        }


        function scrollRight() {
            slider.scrollBy({
                left: scrollDistance,
                behavior: 'smooth'
            });
        }


        function updateButtonStates() {

            if (slider.scrollLeft <= 0) {
                prevBtn.disabled = true;
            } else {
                prevBtn.disabled = false;
            }


            if (slider.scrollLeft >= slider.scrollWidth - slider.clientWidth) {
                nextBtn.disabled = true;
            } else {
                nextBtn.disabled = false;
            }
        }


        prevBtn.addEventListener('click', scrollLeft);
        nextBtn.addEventListener('click', scrollRight);


        slider.addEventListener('scroll', updateButtonStates);


        updateButtonStates();


        const mainContainer = document.querySelector('.main-container');

        const createElement = (element) => {
            return document.createElement(element);
        }

        const appendChild = (parent, child) => {

            return parent.appendChild(child);
        }

        const listIdMovie = ['tt4154664',
            "tt0418279",
            "tt10872600",
            "tt0371746", "tt1663662",
            "tt0816692",
            "tt22898462",
            "tt4154796"]

        for (let i = 0; i < listIdMovie.length; i++) {

            fetch(`http://www.omdbapi.com/?apikey=d3c714f6&i=${(listIdMovie[i])}`, {
                method: "GET",
            })
                .then(response => response.json())
                .then(data => {

                    const divCard = createElement('div');
                    divCard.className = 'slider-item card';
                    const mainImage = createElement('img');
                    mainImage.src = data.Poster;
                    const div = createElement('div');
                    div.className = 'card-content';
                    const h3 = createElement('h3');
                    h3.className = 'card-title';
                    h3.textContent = data.Title;
                    const a = createElement('a');
                    a.className = 'card-btn';
                    a.textContent = 'Voir plus';
                    a.href = `details.php?id=${listIdMovie[i]}`;

                    appendChild(slider, divCard);
                    appendChild(divCard, mainImage);
                    appendChild(divCard, div);
                    appendChild(div, h3);
                    appendChild(div, a);

                    divCard.addEventListener('mouseover', () => {
                        mainContainer.style.backgroundImage = `url(${data.Poster})`;
                        mainContainer.style.backgroundSize = "cover";
                        mainContainer.style.backgroundPosition = "top";
                        mainContainer.querySelector('.infos-container p').textContent = h3.textContent
                        mainContainer.style.backgroundRepeat = "no-repeat";
                    });
                })
                .catch(error => {
                    console.error("Erreur :", error);
                });
        }     
    </script>
</body>

</html>