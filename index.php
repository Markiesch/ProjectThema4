<!--
    Author: Mark Schuurmans
    Date: 29-5-2021
    File: index.php

    Project Thema 44
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Foodz is an small catering industry based in the Netherlands. We help students make the best catering events possible." />
    <meta name="keywords" content="Foodz, Food, Horeca, Catering" />
    <meta name="author" content="Mark Schuurmans" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="images/faviconx32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="images/faviconx16.png">
    <title data-lang="homepageTitle">Homepage &#8226; Foodz</title>
    <link rel="stylesheet" href="styles/style.css">
    <link rel="stylesheet" href="styles/index.css">
    <script type="text/javascript" src="scripts/script.js" defer></script>
    <script type="text/javascript" src="scripts/index.js" defer></script>
</head>
<body>
    <div class="progressbar"></div>
    <?php
        session_start();
        include "includes/header.php";
        require "includes/db_functions.php";
    ?>

    <div class="background"></div>

    <main>
        <section class="hero">
            <div>
                <h4 class="fade-in" data-lang="heroTag"></h4>
                <h1 class="fade-in" data-lang="heroTitle"></h1>
                <p class="fade-in" data-lang="heroSubtitle"></p>
                <a class="fade-in" href="pages/login.php">Get Started</a>
            </div>
            <div class="image--container fade-in">
                <div data-speed="1" class="animate">
                    <div class="img--background"></div>
                    <img src="images/bg4.png" alt="Hero Image">
                </div>
                <svg data-speed="0.5" class="plane animate" viewBox="0 0 512 512">
                    <path class="plane-base" d="M245.53 410.5l-75 92.83c-14 17.1-42.5 7.8-42.5-15.8V358l280.26-252.77c5.5-4.9 13.3 2.6 8.6 8.3L191.72 387.87z"></path>
                    <path class="plane-sides" d="M511.59 28l-72 432a24.07 24.07 0 0 1-33 18.2l-214.87-90.33 225.17-274.34c4.7-5.7-3.1-13.2-8.6-8.3L128 358 14.69 313.83a24 24 0 0 1-2.2-43.2L476 3.23c17.29-10 39 4.6 35.59 24.77z"></path>
                </svg>
                <svg data-speed="0.8" class="bolt animate" viewBox="0 0 320 512">
                    <path d="M296 160H180.6l42.6-129.8C227.2 15 215.7 0 200 0H56C44 0 33.8 8.9 32.2 20.8l-32 240C-1.7 275.2 9.5 288 24 288h118.7L96.6 482.5c-3.6 15.2 8 29.5 23.3 29.5 8.4 0 16.4-4.4 20.8-12l176-304c9.3-15.9-2.2-36-20.7-36z"></path>
                </svg>
                <span data-speed="0.2" class="dot1 dot animate"></span>
                <span data-speed="0.3" class="dot2 dot animate"></span>
                <span data-speed="0.1" class="dot3 dot animate"></span>
            </div>
        </section>
        <section class="iframe--section">
            <article>
                <div class="iframe--container">
                    <iframe src="https://www.youtube.com/embed/fwsbQxsJJ8Q" frameborder="0"></iframe>
                </div>
            </article>
            <article>
                <div>
                    <h4 data-lang="iframeTag">Onze Studenten</h4>
                    <h2 data-lang="iframeTitle">Horeca studenten op het <span>Koning Willem I College</span></h2>
                    <p data-lang="iframeSubTitle">Maak kennis met de Middelbare Horeca School van het Koning Willem I College en neem een kijkje in onze restaurants en keukens.</p>
                    <a href="pages/login.php">Get started</a>
                </div>
            </article>
        </section>

    </main>
    <?php 
        include "includes/footer.php";
    ?>
</body>
</html>