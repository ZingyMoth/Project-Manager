<?php
// ← 1. what these four lines are: the details used to connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "aproject";

// ← 2. what this block does: connects to the database using PDO
try {
    $db = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    // ← 3. what happens if it can't connect: shows the error and stops the page
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>