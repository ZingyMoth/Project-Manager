<?php
//Starts the session and then destroys it, logging the user out of the site once they click the 'Log Out' button.
session_start();
session_destroy();

// Redirect the user to the home page after logging out.
header("Location: index.php");
exit();
?>