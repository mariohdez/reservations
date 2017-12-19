<?php
        require_once './DataBaseAdaptor.php';
	if (isset($_POST['name'])) {
            # Specify that the output will be JSON.
            header('Content-Type: application/json');
            $base = new DatabaseAdaptor();
            $data =  $base->findUsernameMatch($_POST['name']);
            echo $data;
	} else {
            header($_SERVER['SERVER_PROTOCOL'] . ' 400 Invalid Request');
	}
?>
