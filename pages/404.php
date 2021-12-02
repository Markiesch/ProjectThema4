<!-- 
    Author: Mark Schuurmans
    Date: 4-6-2021
    File: pages/404.php

    Project Thema 4    
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Foodz is an small catering industry based in the Netherlands. We help students make the best catering events possible." />
    <meta name="keywords" content="Foodz, Food, Horeca, Catering, 404" />
    <meta name="author" content="Mark Schuurmans" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Need to start at the root since you dont know if the user will insert a / in the URL -->
    <link rel="stylesheet" href="/ProjectThema4/styles/style.css">
    <link rel="stylesheet" href="/ProjectThema4/styles/404.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/ProjectThema4/images/faviconx32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/ProjectThema4/images/faviconx16.png">
    <title>404 &#8226; Foodz</title>
    <script type="text/javascript" src="scripts/script.js" defer></script>
</head>
<body>
    <?php 
        include "../includes/header.php";
    ?>
    <div class="background"></div>

    <main>
        <h1>404</h1>
        <h3 data-lang="errorSubtitle">Something's missing.</h3>
        <a data-lang="errorLink" href="/ProjectThema4/">Go back</a>
    </main>
</body>
</html>