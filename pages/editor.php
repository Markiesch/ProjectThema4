<!--
    Author: Mark Schuurmans
    Date: 29-5-2021
    File: pages/editor.php

    Project Thema 4
-->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="description" content="Foodz is an small catering industry based in the Netherlands. We help students make the best catering events possible." />
    <meta name="keywords" content="Foodz, Food, Horeca, Catering, Editor" />
    <meta name="author" content="Mark Schuurmans" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="32x32" href="../images/faviconx32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../images/faviconx16.png">
    <title data-lang="editorTitle"></title>
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="../styles/editor.css">
    <link rel="stylesheet" href="../styles/events.css">
    <script type="text/javascript" src="../scripts/script.js" defer></script>
    <script type="text/javascript" src="../scripts/editor.js" defer></script>
</head>
<body>
    <div class="progressbar"></div>
    <?php
        session_start();
        include "../includes/db_functions.php";

        $user = getLoggedin();

        // Checken of ingelogde gebruiker de juist permissions heeft
        if ($user["Role"] != "Editor")
        {
            header("Location: events.php");
        }

        $username = $user["UserName"];
        $leerlingnr = $user["StudentNr"];
        $role = $user["Role"];
        $newusername = false;
        $rowsAffected = false;

        if (isset($_POST["username"])) {
            $newusername = $_POST["username"];
            if ($newusername != $username)
            {
                $query = "UPDATE [User]
                          SET UserName = '$newusername'
                          WHERE StudentNr = $leerlingnr";

                $username = $newusername;
                $rowsAffected = $pdo->exec($query);
            }
        }
        $description = isset($_GET["name"]) ? $_GET["name"] : "";
        $location = isset($_GET["location"]) ? $_GET["location"] : "";
    ?>

    <div class="background"></div>
    <main>
        <aside>
            <div>
                <div class="logo-container">
                    <a href="/ProjectThema4/" class="logo">Foodz</a>
                    <!-- Tabindex nodig om focus:within te laten werken -->
                    <div tabindex="1" class="avatar-container">
                        <img class="avatar" src="../images/avatars/avatar1.png" alt="Avatar">
                        <div class="avatarmenu">
                            <p>Logged in as</p>
                            <h4><?php echo $username ?></h4>
                            <a href="login.php?logout">
                                <svg viewBox="0 0 512 512">
                                    <path d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path>
                                </svg>
                                <span data-lang="singOut">Logout</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div>
                    <div data-tab="dashboard" class="activeBtn">
                        <svg viewBox="0 0 512 512">
                            <path d="M488 272H296a24 24 0 0 0-24 24v160a24 24 0 0 0 24 24h192a24 24 0 0 0 24-24V296a24 24 0 0 0-24-24zm-272 0H24a24 24 0 0 0-24 24v160a24 24 0 0 0 24 24h192a24 24 0 0 0 24-24V296a24 24 0 0 0-24-24z"></path><path d="M488 32H296a24 24 0 0 0-24 24v160a24 24 0 0 0 24 24h192a24 24 0 0 0 24-24V56a24 24 0 0 0-24-24zm-272 0H24A24 24 0 0 0 0 56v160a24 24 0 0 0 24 24h192a24 24 0 0 0 24-24V56a24 24 0 0 0-24-24z"></path>
                        </svg>
                        <span data-lang="dashboardBtn">Dashboard</span>
                    </div>
                    <div data-tab="profile">
                        <svg viewBox="0 0 512 512">
                            <path d="M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z"></path>
                        </svg>
                        <span data-lang="profileBtn">Profile</span>
                    </div>
                    <div data-tab="settings">
                        <svg viewBox="0 0 512 512">
                            <path d="M496 384H160v-16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v16H16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h80v16c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-16h336c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm0-160h-80v-16c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v16H16c-8.8 0-16 7.2-16 16v32c0 8.8 7.2 16 16 16h336v16c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-16h80c8.8 0 16-7.2 16-16v-32c0-8.8-7.2-16-16-16zm0-160H288V48c0-8.8-7.2-16-16-16h-32c-8.8 0-16 7.2-16 16v16H16C7.2 64 0 71.2 0 80v32c0 8.8 7.2 16 16 16h208v16c0 8.8 7.2 16 16 16h32c8.8 0 16-7.2 16-16v-16h208c8.8 0 16-7.2 16-16V80c0-8.8-7.2-16-16-16z"></path>
                        </svg>
                        <span data-lang="settingsBtn">Settings</span>
                    </div>
                </div>
            </div>
            <div>
                <a href="login.php?logout" data-tab="dashboard" class="activeBtn">
                    <svg viewBox="0 0 512 512">
                        <path d="M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z"></path>
                    </svg>
                    <span data-lang="singOut">Logout</span>
                </a>
            </div>
        </aside>            
        <section>
            <article class="tab tab-dashboard active">
                <form class="search--form" action="editor.php">
                    <label for="name">Search</label>
                    <div class="filter-container">
                        <div>
                            <svg viewBox="0 0 512 512">
                                <path d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"></path>
                            </svg>
                            <input name="name" id="name" type="text" placeholder="Naam Filter">
                        </div>
                        <div>
                            <svg viewBox="0 0 512 512">
                                <path d="M508.5 468.9L387.1 347.5c-2.3-2.3-5.3-3.5-8.5-3.5h-13.2c31.5-36.5 50.6-84 50.6-136C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c52 0 99.5-19.1 136-50.6v13.2c0 3.2 1.3 6.2 3.5 8.5l121.4 121.4c4.7 4.7 12.3 4.7 17 0l22.6-22.6c4.7-4.7 4.7-12.3 0-17zM208 368c-88.4 0-160-71.6-160-160S119.6 48 208 48s160 71.6 160 160-71.6 160-160 160z"></path>
                            </svg>
                            <input name="location" id="location" type="text" placeholder="Locatie Filter">
                        </div>
                        <button type="submit">Search</button>
                    </div>
                </form>
                <a href="create.php" class="create">
                    <p>Add</p>
                    <svg viewBox="0 0 448 512">
                        <path d="M416 208H272V64c0-17.67-14.33-32-32-32h-32c-17.67 0-32 14.33-32 32v144H32c-17.67 0-32 14.33-32 32v32c0 17.67 14.33 32 32 32h144v144c0 17.67 14.33 32 32 32h32c17.67 0 32-14.33 32-32V304h144c17.67 0 32-14.33 32-32v-32c0-17.67-14.33-32-32-32z"></path>
                    </svg>
                </a>
                <div class="container">
                    <?php
                        $edit = true;
                        include "../includes/eventlist.php";
                    ?>
                </div>
            </article>
            <article class="tab tab-profile">
                <h2>Edit Profile</h2>
                <form class="profile--form" action="editor.php" method="POST">
                    <div>
                        <label for="username" data-lang="username">Username</label>
                        <input type="text" name="username" id="username" minlength="2" maxlength="30" value="<?php echo $username ?>">
                    </div>    

                    <div>
                        <label for="leerlingnr">Studentnummer</label>
                        <input type="text" value="<?php echo $leerlingnr ?>" readonly>
                    </div>

                    <div>
                        <label data-lang="role">Role</label>
                        <input type="text" value="<?php echo $role ?>" readonly>
                    </div>

                    <div>
                        <?php
                            if($rowsAffected)
                            {
                                echo "<p class='updated'>Username Updated</p>";
                            } else
                                {
                                if ($username != $newusername && $newusername)
                                {
                                    echo "<p class='updated update-error'>Error! Try again later</p>";
                                }
                            }
                        ?>
                    </div>

                    <button data-lang="save" name="submit" type="submit">Save</button>
                </form>
            </article>
            <article class="tab tab-settings">
                <div class="setting">
                    <div class="settings-title">
                        <div>
                            <svg viewBox="0 0 512 512">
                                <path d="M50.75 333.25c-12 12-18.75 28.28-18.75 45.26V424L0 480l32 32 56-32h45.49c16.97 0 33.25-6.74 45.25-18.74l126.64-126.62-128-128L50.75 333.25zM483.88 28.12c-37.47-37.5-98.28-37.5-135.75 0l-77.09 77.09-13.1-13.1c-9.44-9.44-24.65-9.31-33.94 0l-40.97 40.97c-9.37 9.37-9.37 24.57 0 33.94l161.94 161.94c9.44 9.44 24.65 9.31 33.94 0L419.88 288c9.37-9.37 9.37-24.57 0-33.94l-13.1-13.1 77.09-77.09c37.51-37.48 37.51-98.26.01-135.75z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4>Avatar Appearance</h4>
                            <p>Change the look and color of your avatar</p>
                        </div>
                    </div>
                    <div class="settings-container">
                        <div class="setting-column">
                            <div>
                                <svg viewBox="0 0 496 512">
                                    <path d="M248 8C111.03 8 0 119.03 0 256s111.03 248 248 248 248-111.03 248-248S384.97 8 248 8zm0 432c-101.69 0-184-82.29-184-184 0-101.69 82.29-184 184-184 101.69 0 184 82.29 184 184 0 101.69-82.29 184-184 184zm0-312c-70.69 0-128 57.31-128 128s57.31 128 128 128 128-57.31 128-128-57.31-128-128-128zm0 192c-35.29 0-64-28.71-64-64s28.71-64 64-64 64 28.71 64 64-28.71 64-64 64z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="setting-text">
                                    <h4>Theme color</h4>
                                    <p>Don't like our default color? Choose your own one!</p>
                                </div>
                                <canvas id="colorCanvas" width="150" height="150"></canvas>
                                <span class="reset" onclick="resetColor()">Reset</span>
                            </div>
                        </div>
                        <div class="setting-column">
                            <div>
                                <svg viewBox="0 0 640 512">
                                    <path d="M608 0H160a32 32 0 0 0-32 32v96h160V64h192v320h128a32 32 0 0 0 32-32V32a32 32 0 0 0-32-32zM232 103a9 9 0 0 1-9 9h-30a9 9 0 0 1-9-9V73a9 9 0 0 1 9-9h30a9 9 0 0 1 9 9zm352 208a9 9 0 0 1-9 9h-30a9 9 0 0 1-9-9v-30a9 9 0 0 1 9-9h30a9 9 0 0 1 9 9zm0-104a9 9 0 0 1-9 9h-30a9 9 0 0 1-9-9v-30a9 9 0 0 1 9-9h30a9 9 0 0 1 9 9zm0-104a9 9 0 0 1-9 9h-30a9 9 0 0 1-9-9V73a9 9 0 0 1 9-9h30a9 9 0 0 1 9 9zm-168 57H32a32 32 0 0 0-32 32v288a32 32 0 0 0 32 32h384a32 32 0 0 0 32-32V192a32 32 0 0 0-32-32zM96 224a32 32 0 1 1-32 32 32 32 0 0 1 32-32zm288 224H64v-32l64-64 32 32 128-128 96 96z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="setting-text">
                                    <h4>Avatar</h4>
                                    <p>Choose your avatar</p>
                                </div>
                                <div class="avatar-wrapper">
                                    <div onclick="setAvatar(1)">
                                        <img class="avatar1" src="../images/avatars/avatar1.png" alt="Avatar1">
                                    </div>
                                    <div onclick="setAvatar(2)">
                                        <img class="avatar2" src="../images/avatars/avatar2.png" alt="Avatar2">
                                    </div>
                                    <div onclick="setAvatar(3)">
                                        <img class="avatar3" src="../images/avatars/avatar3.png" alt="Avatar3">
                                    </div>
                                    <div onclick="setAvatar(4)">
                                        <img class="avatar4" src="../images/avatars/avatar4.png" alt="Avatar4">
                                    </div>
                                    <div onclick="setAvatar(5)">
                                        <img class="avatar5" src="../images/avatars/avatar5.png" alt="Avatar5">
                                    </div>
                                    <div onclick="setAvatar(6)">
                                        <img class="avatar6" src="../images/avatars/avatar6.png" alt="Avatar6">
                                    </div>
                                    <div onclick="setAvatar(7)">
                                        <img class="avatar7" src="../images/avatars/avatar7.png" alt="Avatar7">
                                    </div>
                                    <div onclick="setAvatar(8)">
                                        <img class="avatar8" src="../images/avatars/avatar8.png" alt="Avatar8">
                                    </div>
                                    <div onclick="setAvatar(9)">
                                        <img class="avatar9" src="../images/avatars/avatar9.png" alt="Avatar9">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="setting">
                    <div class="settings-title">
                        <div>
                            <svg viewBox="0 0 496 512">
                                <path d="M178.1 123.7c0-6.2-5.1-11.3-11.3-11.3-3 0-5.9 1.2-8 3.3l-25.4 25.4c-2.1 2.1-3.3 5-3.3 8 0 6.2 5.1 11.3 11.3 11.3h16c3 0 5.9-1.2 8-3.3l9.4-9.4c2.1-2.1 3.3-5 3.3-8v-16zM248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm175.1 344.4h-13.4c-4.8 0-9.5-1.9-12.9-5.3l-17.3-17.3c-6-6-14.1-9.4-22.6-9.4h-18.3l-43.2-37.1c-8.2-7.1-18.7-10.9-29.6-10.9h-31.2c-8.2 0-16.3 2.2-23.4 6.5l-42.9 25.7c-13.7 8.2-22.1 23-22.1 39v23.9c0 14.3 6.7 27.8 18.2 36.4l22.2 16.7c8.6 6.5 24.6 11.8 35.4 11.8h20.2c8.8 0 16 7.2 16 16v7.1c-3.4.2-6.7.5-10.1.5-110.3 0-200-89.7-200-200 0-108.3 86.7-196.6 194.3-199.7L213.3 78c-2 1.5-3.2 3.9-3.2 6.4v20c0 4.4 3.6 8 8 8h16c4.4 0 8-3.6 8-8v-8l16-16h20.7c6.2 0 11.3 5 11.3 11.3 0 3-1.2 5.9-3.3 8L260 126.5c-1.2 1.2-2.7 2.2-4.4 2.7l-40 13.3c-3.3 1.1-5.5 4.1-5.5 7.6 0 6.6-2.6 12.8-7.2 17.5l-20.1 20.1c-3 3-4.7 7.1-4.7 11.3v25.4c0 8.8 7.2 16 16 16h22.1c6.1 0 11.6-3.4 14.3-8.8l9.4-18.7c1.4-2.7 4.1-4.4 7.2-4.4h3.1c4.4 0 8 3.6 8 8s3.6 8 8 8h16c4.4 0 8-3.6 8-8v-2.2c0-3.4 2.2-6.5 5.5-7.6l31.6-10.5c6.5-2.2 10.9-8.3 10.9-15.2v-4.5c0-8.8 7.2-16 16-16h36.7c6.2 0 11.3 5.1 11.3 11.3v9.4c0 6.2-5.1 11.3-11.3 11.3h-32c-3 0-5.9 1.2-8 3.3l-9.4 9.4c-2.1 2.1-3.3 5-3.3 8 0 6.2 5.1 11.3 11.3 11.3h16c3 0 5.9 1.2 8 3.3l9.4 9.4c2.1 2.1 3.3 5 3.3 8v8.7l-12.5 12.5c-4.6 4.6-4.6 12-.1 16.7l31.9 32.6c3 3.1 7.1 4.8 11.4 4.8h20.3c-3.8 11-8.5 21.7-14.1 31.9z"></path>
                            </svg>
                        </div>
                        <div>
                            <h4 data-lang="lang">Language</h4>
                            <p data-lang="choose-lang">Choose your preferred language</p>
                        </div>
                    </div>
                    <div class="settings-container">
                        <div class="setting-column short">
                            <div class="lang--container">
                                <button class="lang" aria-label="Change language">
                                    <svg viewBox="0 0 640 512">
                                        <path d="M160.3 203.8h-.5s-4.3 20.9-7.8 33l-11 37.3h37.9l-10.7-37.3c-3.6-12.1-7.9-33-7.9-33zM616 96H24c-13.3 0-24 10.7-24 24v272c0 13.3 10.7 24 24 24h592c13.3 0 24-10.7 24-24V120c0-13.3-10.7-24-24-24zM233.2 352h-22.6a12 12 0 0 1-11.5-8.6l-9.3-31.7h-59.9l-9.1 31.6c-1.5 5.1-6.2 8.7-11.5 8.7H86.8c-8.2 0-14-8.1-11.4-15.9l57.1-168c1.7-4.9 6.2-8.1 11.4-8.1h32.2c5.1 0 9.7 3.3 11.4 8.1l57.1 168c2.6 7.8-3.2 15.9-11.4 15.9zM600 376H320V136h280zM372 228h110.8c-6.3 12.8-15.1 25.9-25.9 38.5-6.6-7.8-12.8-15.8-18.3-24-3.5-5.3-10.6-6.9-16.1-3.6l-13.7 8.2c-5.9 3.5-7.6 11.3-3.8 17 6.5 9.7 14.4 20.1 23.5 30.6-9 7.7-18.6 14.8-28.7 21.2-5.4 3.4-7.1 10.5-3.9 16l7.9 13.9c3.4 5.9 11 7.9 16.8 4.2 12.5-7.9 24.6-17 36-26.8 10.7 9.6 22.3 18.6 34.6 26.6 5.8 3.7 13.6 1.9 17-4.1l8-13.9c3.1-5.5 1.5-12.5-3.8-16-9.2-6-18.4-13.1-27.2-20.9 1.5-1.7 2.9-3.3 4.3-5 17.1-20.6 29.6-41.7 36.8-62H540c6.6 0 12-5.4 12-12v-16c0-6.6-5.4-12-12-12h-64v-16c0-6.6-5.4-12-12-12h-16c-6.6 0-12 5.4-12 12v16h-64c-6.6 0-12 5.4-12 12v16c0 6.7 5.4 12.1 12 12.1z"></path>
                                    </svg>
                                </button>
                                <p class="current-lang"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </section>
    </main>
</body>
</html>