<?php
// Scrambles the password into a hash so it can be stored in the database
echo password_hash('Password123!', PASSWORD_DEFAULT);
?>