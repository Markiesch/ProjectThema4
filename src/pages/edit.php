<!--
    Author: Mark Schuurmans
    Date: 29-5-2021
    File: pages/edit.php
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
                isset($_POST["newstart"])       &&
                isset($_POST["newend"])         &&
                isset($_POST["newlocation"]))
            {
                $newdescription = $_POST["newdescription"];
                $newstart = date("Y-m-d G:i:s", strtotime($_POST["newstart"]));
                $newend = date("Y-m-d G:i:s", strtotime($_POST["newend"]));
                $newlocation = $_POST["newlocation"];
                $id = $_POST["id"];

                $query = "UPDATE Diner
                          SET Description = '$newdescription',
                              [Start] = '$newstart',
                              [End] = '$newend',
                              Location = '$newlocation'
                          WHERE DinerID = $id";

                $rowsAffected = $pdo->exec($query);

                if ($rowsAffected >= 1)
                {
                    echo "<div class='succes'>
                            <div>
                                <h4>Succes</h4>
                                <p>De wijzigingen zijn opgeslagen</p>
                            </div>
                            <div class='close'>
                                <a href='editor.php'>CLOSE</a>
                            </div>
                          </div>";
                } else {
                    echo "<div class='error'>
                            <div>
                                <h4>Error</h4>
                                <p>Er is een fout opgetreden</p>
                            </div>
                            <div class='close'>
                                <a href='editor.php'>CLOSE</a>
                            </div>
                          </div>";
                }

            }
            if (isset($_GET["id"])) {
                $id = $_GET["id"];
                $query = "SELECT * FROM Diner WHERE DinerID = '$id'";
                $result = executeQuery($query);
                $diner = $result->fetch (PDO::FETCH_ASSOC);
                if ($diner) {
                $description = $diner["Description"];
                $start = date("Y-m-d\TH:i", strtotime($diner["Start"]));
                $end = date("Y-m-d\TH:i", strtotime($diner["End"]));
                $location = $diner["Location"];
            ?>
                <form class="sql-form" action="edit.php" method="POST">
                    <input name="id" type="hidden" value="<?php echo $id ?>">

                    <label for="newdescription">Name:</label>
                    <input name="newdescription" id="newdescription" type="text" value="<?php echo $description ?>">

                    <label for="newstart">Start:</label>
                    <input name="newstart" id="newstart" type="datetime-local" value="<?php echo $start ?>">

                    <label for="newend">End:</label>
                    <input name="newend" id="newend" type="datetime-local" value="<?php echo $end ?>">

                    <label for="newlocation">Location:</label>
                    <input name="newlocation" id="newlocation" type="text" value="<?php echo $location ?>">

                    <button class="button" type="submit">Change</button>
                </form>
            <?php
                    } else
                        {
                        echo "<div class='error'>
                                <div>
                                    <h4>Error</h4>
                                    <p><span data-lang='noevents'>Geen evenement gevonden met het ID</span> " . $_GET["id"] . "</p>
                                </div>
                                <div class='close'>
                                    <a href='editor.php'>EXIT</a>
                                </div>
                              </div>";
                    }
                }
            ?>
        </section>
    </main>
    <?php
    include "../includes/footer.php";
    ?>
</body>
</html>