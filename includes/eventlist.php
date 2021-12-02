<?php
$description = isset($_GET["name"]) ? $_GET["name"] : "";
$location = isset($_GET["location"]) ? $_GET["location"] : "";

$query = "SELECT * FROM Diner WHERE Description LIKE '%$description%' AND Location LIKE '%$location%'";
$result = executeQuery($query);

$hasResults = false;

while ($row = $result->fetch(PDO::FETCH_ASSOC))
{
    $hasResults = true;

    $id = $row["DinerID"];
    $description = $row["Description"];
    $creator = $row["Maker"];
    $start = date("d M, Y", strtotime($row['Start']));
    $end = date("d M, Y", strtotime($row['End']));
    $location = $row["Location"];

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
            <p><span>$start</span> - <span>$end</span></p>";
            // Voegt alleen een bewerk knop toe wanneer de gebruiker vanuit de editor page laadt
            if ($edit)
            {
                echo "
                    <div class='btn-container'>
                        <a href='delete.php?id=$id'>
                            <svg viewBox='0 0 448 512'>
                                <path d='M432 32H312l-9.4-18.7A24 24 0 0 0 281.1 0H166.8a23.72 23.72 0 0 0-21.4 13.3L136 32H16A16 16 0 0 0 0 48v32a16 16 0 0 0 16 16h416a16 16 0 0 0 16-16V48a16 16 0 0 0-16-16zM53.2 467a48 48 0 0 0 47.9 45h245.8a48 48 0 0 0 47.9-45L416 128H32z'></path>
                            </svg>
                        </a>
                        <a href='edit.php?id=$id'>Edit</a>
                    </div>";
            }
        echo "</div>
        </article>";
}

if (!$hasResults)
{
    echo "<p data-lang='no-result'>Geen resultaten gevonden</p>";
}