<?php
    require_once './DataBaseAdaptor.php';
    if (isset($_POST['date'])) {
        # Specify that the output will be JSON.
        header('Content-Type: application/json');
        $base = new DatabaseAdaptor();
        $json =  $base->findDate($_POST['date']);
        echo $json;
    } else {
        header($_SERVER['SERVER_PROTOCOL'] . ' 400 Invalid Request');
    }

    ?>
