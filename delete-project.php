<?php
// Starts the session and connects to the database if logged in. If not, the user is redirected to the login page.
session_start();
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}
include 'connectdb.php';

// Deletes a project from the database. This only works if the project belongs to the logged in user.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pid'])) {
    $stmt = $db->prepare("DELETE FROM projects WHERE pid = ? AND uid = ?");
    $stmt->execute([$_POST['pid'], $_SESSION['uid']]);
}

// Sends the user back to the project list page after deleting the project.
header("Location: project-list.php");
exit();
?>