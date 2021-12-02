<!--
    Author: Mark Schuurmans
    Date: 29-5-2021
    File: pages/delete.php

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

            if (isset($_POST["id"]))
            {
                $query = "DELETE FROM Diner WHERE DinerID = " . $_POST["id"];
                $result = executeInsertQuery($query);

                if ($result >= 1)
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
                } else
                    {
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

            if (isset($_GET["id"]))
            {
            $id = $_GET["id"];
            $query = "SELECT * FROM Diner WHERE DinerID = '$id'";
            $result = executeQuery($query);
            $diner = $result->fetch (PDO::FETCH_ASSOC);
            if ($diner)
            {
                $description = $diner["Description"];
                $creator = $diner["Maker"];
                $location = $diner["Location"];
                $start = date("d M, Y", strtotime($diner['Start']));
                $end = date("d M, Y", strtotime($diner['End']));

                    echo "<article class='item'>
                    <h2>$description</h2>
                    <div class='author'>
                    <p><em>By</em> <span>$creator</span></p>
                    </div>
                        <div class='location'>
                            <svg viewBox='0 0 384 512'>
                                <path d='M172.268 501.67C26.97 291.031 0 269.413 0 192 0 85.961 85.961 0 192 0s192 85.961 192 192c0 77.413-26.97 99.031-172.268 309.67-9.535 13.774-29.93 13.773-39.464 0zM192 272c44.183 0 80-35.817 80-80s-35.817-80-80-80-80 35.817-80 80 35.817 80 80 80z'></path>
                            </svg>    
                            <p>$location</p>
                        </div>
                    <div class='date'>
                    <p><span>$start</span> - <span>$end</span></p></div>
                </article>";
                ?>
                <h4 class="delete-header" data-lang="confirm-delete">Are you sure you want to delete the following item?</h4>
                <form action="delete.php" method="POST">
                    <input name="id" type="hidden" value="<?php echo $id ?>">
                    <button class="button" data-lang="confirm" type="submit">Confirm</button>
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