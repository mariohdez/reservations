<!DOCTYPE html>
<html>

<!--
 * Programmer(s): Isaac Fimbres & Mario Hernandez
 * File: index.php
 * Purpose: To serve as the main page of the application.
-->

<head>
    <title> JetSki Reservation </title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script type= "text/javascript" src="./admin.js"></script>
    <script type= "text/javascript" src="./prototype.js"></script>
</head>

<!--
    * This is the header for the all of
    * the pages of the application.
-->

<body>

    <?php

        require_once './DataBaseAdaptor.php';
        $dataBase = new DatabaseAdaptor();
        if (!isset($_SESSION)) {
            session_start();
        }

        if (isset($_SESSION['user'])) {

          if (strcmp($_SESSION['user'], "coolkid420") == 0) {
                require_once("./admin.php");
          } else {
              require_once("./custom_header.php");
              require_once("./reserve_jet_skis.php");
          }
        } else {
          # registration logic.

            require_once("./regular_header.html");
            require_once("./info.html");

            if (isset($_POST['register']) && isset($_POST['password']) && isset($_POST['name'])) {
                $userName = $_POST['name'];
                $password = $_POST['password'];
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $result = $dataBase->findUsernameMatch($userName);
                  if (strcmp($result, "false") == 0) {
                      $dataBase->addUser($userName, $hashed_password);
                      $_SESSION['user'] = $userName;
		      if (strcmp($userName, "coolkid420") == 0) {
		          require_once("./admin.php");
		      } else {
            require_once("./custom_header.php");
            require_once("./reserve_jet_skis.php");
		      }
        } else {
          ?>
          <p> Username already exists. </p>
          <?php
          require_once("./user.php");
        }
      } else if (isset($_POST['login']) && isset($_POST['password']) && isset($_POST['name'])) {
                  # login logic.
                  $userName = $_POST['name'];

                  $password = $_POST['password'];
                  $result = $dataBase->findUsernameMatch($userName);
                  if (strcmp($result, "false") != 0) {
                      $userID = $dataBase->getUserId($userName);
                      $hashed = $dataBase->get_hashed_password_by_user_id ($userID);
                      $result = password_verify($password, $hashed);

                      if ($result == true) {
                        $_SESSION['user'] = $userName;
                            if (strcmp($userName, "coolkid420") == 0) {
                                  require_once("./admin.php");
                            } else {
                                require_once("./custom_header.php");
                                require_once("./reserve_jet_skis.php");
                            }

                      } else {
                        ?>
                          <p>Wrong Credentials</p>
                        <?php
                          require_once("./user.php");
                      }
                  } else {
                    ?>
                    <p>Wrong Credentials</p>
                    <?php
                      require_once("./user.php");
                  }
              } else {
                  require_once("./user.php");
              }
        }
    ?>
    <hr/>
    <footer id="footer">
        <p> Web Programming 2017 Isaac Fimbres and Mario Hernandez  </p>
    </footer>
</body>

</html>
