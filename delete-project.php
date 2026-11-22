<?php
// 
session_start();
if (!isset($_SESSION['uid'])) {
    header("Location: login.php");
    exit();
}
include 'connectdb.php';

// 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['pid'])) {
    $stmt = $db->prepare("DELETE FROM projects WHERE pid = ? AND uid = ?");
    $stmt->execute([$_POST['pid'], $_SESSION['uid']]);
}

// 
header("Location: project-list.php");
exit();
?>