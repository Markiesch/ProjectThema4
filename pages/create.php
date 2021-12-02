<!--
    Author: Mark Schuurmans
    Date: 29-5-2021
    File: pages/create.php

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
<body class="low">
    <div class="progressbar"></div>
    <?php
        session_start();
        include "../includes/header.php";
        require "../includes/db_functions.php";

        $user = getLoggedin();

        // Checken of ingelogde gebruiker de juist permissions heeft
        if ($user["Role"] != "Editor")
        {
            header("Location: events.php");
        }
    ?>
    <div class="background"></div>
    <main>
        <section class="events">
            <?php

            if (isset($_POST["newdescription"]) &&
                isset($_POST["newstart"]) &&
                isset($_POST["newend"]) &&
                isset($_POST["newlocation"])
                )
            {
                $newdescription = $_POST["newdescription"];
                $newstart = date("Y-m-d G:i:s", strtotime($_POST["newstart"]));
                $newend = date("Y-m-d G:i:s", strtotime($_POST["newend"]));
                $newlocation = $_POST["newlocation"];

                $query = "INSERT INTO Diner VALUES ('$newdescription', '" . $user["UserName"] . "', '$newstart', '$newend', '$newlocation')";
                $result = executeInsertQuery($query);

                if ($result >= 1)
                {
                    ?>
                    <div class='succes'>
                        <div>
                            <h4>Succes</h4>
                            <p>De wijzigingen zijn opgeslagen</p>
                        </div>
                        <div class='close'>
                            <a href='editor.php'>CLOSE</a>
                        </div>
                    </div>
                <?php
                } else
                    {
                    ?>
                    <div class='error'>
                        <div>
                            <h4>Error</h4>
                            <p>Er is een fout opgetreden</p>
                        </div>
                        <div class='close'>
                            <a href='editor.php'>CLOSE</a>
                        </div>
                    </div>
                <?php
                }

            } else
                {
                ?>
                <form class="sql-form" action="create.php" method="POST">
                    <label for="newdescription">Name:</label>
                    <input required name="newdescription" id="newdescription" type="text">

                    <label for="newstart">Start:</label>
                    <input required name="newstart" id="newstart" type="datetime-local">

                    <label for="newend">End:</label>
                    <input required name="newend" id="newend" type="datetime-local">

                    <label for="newlocation">Location:</label>
                    <input required name="newlocation" id="newlocation" type="text">

                    <button class="button" type="submit">Add</button>
                </form>
            <?php
                }
            ?>
        </section>
    </main>
    <?php
        include "../includes/footer.php";
    ?>
</body>
</html>