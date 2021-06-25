<?php
// Een "leeg" $pdo variabele aanmaken
$pdo = null;

// Starten van een DB connectie
function startConnection()
{
    global $pdo;
    // Open de database connectie en ODBC driver
    try
    {
        $pdo = new PDO("odbc:odbc2sqlserverproject");
    }
    catch (PDOException $e)
    {
        echo "<h1>Database error:</h1>";
        echo $e->getMessage();
        die();
    }
}

// Uitvoeren van een query
function executeQuery($sql)
{
    global $pdo;
    // Uitvoeren van een SQl query
    try
    {
        // Query uitvoeren
        return $pdo->query($sql);
    }
    catch (PDOException $e)
    {
        echo 'Er is een probleem met ophalen van jokes: ' . $e->getMessage();
        exit();
    }
}

function executeInsertQuery($query)
{
    global $pdo;

    try {
        $rowsAffected = $pdo->exec($query);
    } catch (PDOException $error)
    {
        $rowsAffected = 0;
        echo "<p>Er is een error opgetreden: " . $error->getMessage() . "</p>";
    }


    return $rowsAffected;
}

function getLoggedin()
{
    $studentNr = false;

    // Checkt of de session variable bestaat
    if (isset($_SESSION["studentNr"])) {
        // Zet de global studentNr variable gelijk aan het opgeslagen leerlingnummer
        $studentNr = $_SESSION["studentNr"];
    }

    // Stuurt de gebruiker naar de inlog pagina wanneer deze niet is ingelogd
    if (!$studentNr) {
        header("Location: login.php");
    }

    // Query om data op te halen voor de ingelogde gebruiker
    $query = "SELECT * FROM [User] WHERE StudentNr = '$studentNr'";
    $result = executeQuery($query);
    return $result->fetch (PDO::FETCH_ASSOC);
}

startConnection();
