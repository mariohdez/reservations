<!--
 * Programmer(s): Isaac Fimbres & Mario Hernandez
 * File: logout.php
 * Purpose: A link to destroy the session when a user logs out.
-->

<?php
    session_start();
    session_destroy();
    header('Location: index.php');
    exit;
    
?>
