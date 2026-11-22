<?php
//Connection details for the database, showing where it is located, the username and password to access it, and the name of the database to connect to.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aproject";

//Uses the details above to open a connection to the database.
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {

    //If the database connection fails, an error message is displayed and the script stops running.
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>