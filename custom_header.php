<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    $user = $_SESSION['user'];
    ?>
<header>

<h1> Welcome <?= $user?>, Jet Ski Reservation System </h1>
</header>
