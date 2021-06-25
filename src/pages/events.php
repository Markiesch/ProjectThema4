<!--
    Author: Mark Schuurmans
    Date: 29-5-2021
    File: pages/events.php

    Project Thema 4
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Foodz is an small catering industry based in the Netherlands. We help students make the best catering events possible." />
    <meta name="keywords" content="Foodz, Food, Horeca, Catering, Events, Evenementen" />
    <meta name="author" content="Mark Schuurmans" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/faviconx32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/faviconx16.png">
    <title data-lang="eventsTitle">Events &#8226; Foodz</title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/events.css">
    <script type="text/javascript" src="../scripts/script.js" defer></script>
</head>
<body>
    <div class="progressbar"></div>
    <?php
        session_start();
        include "../includes/header.php";
        require "../includes/db_functions.php";

        // Stuurt de gebruiker naar de inlogpagina wanneer deze niet is ingelogd
        if (!isset($_SESSION["studentNr"]))
        {
            header("Location: login.php");
        }

        // Maakt variables aan om te gebruiken als value in de form en voor in de LIKE voor de query
        $description = isset($_GET["name"]) ? $_GET["name"] : "";
        $location = isset($_GET["location"]) ? $_GET["location"] : "";
    ?>
    <div class="background"></div>
    <main>
        <section class="events">
            <form class="search--form" action="events.php" method="GET">
                <label for="name" data-lang="search">Search</label>
                <div class="filter-container">
                    <div>
                        <svg viewBox="0 0 512 512">
                            <path d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"></path>
                        </svg>
                        <input name="name" id="name" type="text" placeholder="Naam Filter" value="<?php echo $description ?>">
                    </div>
                    <div>
                        <svg viewBox="0 0 512 512">
                            <path d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"></path>
                        </svg>
                        <input name="location" id="location" type="text" placeholder="Locatie Filter" value="<?php echo $location ?>">
                    </div>
                    <button data-lang="search" type="submit">Search</button>
                </div>
            </form>
            <div class="container">
                <?php
                    $edit = false;
                    include "../includes/eventlist.php";
                ?>

            </div>
        </section>
    </main>
    <?php 
        include "../includes/footer.php";
    ?>
</body>
</html>