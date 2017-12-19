<?php

    # File: DatabaseAdaptor.php
    # Programmers: Isaac Fimbres, Mario Hernandez
    # Purpose: To connect to the database.

    class DatabaseAdaptor {
        private $DB;

        public function __construct(){
            $db = 'mysql:dbname=reservations;host=localhost';
            $user = 'root';
            $password = '';

            try {
                $this->DB = new PDO ($db, $user, $password);
                $this->DB->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo('Error establishing connection');
                exit ();
            }
        }

        #check if overbooked
        public function overbooked ($date, $num) { # Must be this format
            $date = date('Y-m-d', strtotime($date));
            $stmt = $this->DB->prepare( "SELECT * FROM users_jetskis WHERE reservation_date = :date;");
            $stmt->bindParam( 'date', $date );
            $stmt->execute();
            $reservations = $stmt->fetchAll (PDO::FETCH_ASSOC);

            if (sizeof($reservations) <= 12-$num){
                return false;
            } else {
                return true;
            }
        }

        #Create reservation if not overbooked
        public function createReservation($username, $date, $num) {
            $date = date('Y-m-d', strtotime($date));
            $userId = $this->getUserId($username);

            $availableJetskis = $this->getArrayOfAvailableJetskis($date);
            $reservedJetskis = Array ();

            for($i = 0; $i<$num; ++$i){
                $stmt = $this->DB->prepare("INSERT INTO users_jetskis VALUES (:user, :jetski, :date);");
                $stmt->bindParam( 'user', $userId );
                $stmt->bindParam( 'jetski', $availableJetskis[$i]);
                $stmt->bindParam( 'date', $date );
                $stmt->execute();
                $reservedJetskis[] = $availableJetskis[$i];
            }
            return $reservedJetskis;
        }

        #Get user id for a specific username
        public function getUserId($username) {
            $stmt = $this->DB->prepare( "SELECT * FROM users WHERE username = :username;");
            $stmt->bindParam( 'username', $username );
            $stmt->execute ();
            $data = $stmt->fetch (PDO::FETCH_ASSOC);
            return $data["user_id"];
        }

        public function get_hashed_password_by_user_id($user_id) {
            $stmt = $this->DB->prepare( "SELECT * FROM users WHERE user_id = :user_id;" );
            $stmt->bindParam( 'user_id', $user_id );
            $stmt->execute ();
            $data = $stmt->fetch (PDO::FETCH_ASSOC);
            return $data['password'];
        }

        # Returns array of available jetskis for a certain date
        public function getArrayOfAvailableJetskis($date) {
            $stmt = $this->DB->prepare( "SELECT jetski_id FROM users_jetskis WHERE reservation_date = :date;");
            $stmt->bindParam( 'date', $date );
            $stmt->execute ();
            $reservations = $stmt->fetchAll (PDO::FETCH_ASSOC);
            $ids = Array();

            foreach($reservations as $x){
                $ids[] = $x["jetski_id"];
            }
            if(sizeof($ids) > 0){
                $stmt = $this->DB->prepare( "SELECT jetski_id FROM jetskis WHERE jetski_id NOT IN (" . implode(",", $ids) . ");");
                $stmt->execute ();
                $reservations = $stmt->fetchAll (PDO::FETCH_ASSOC);
            } else {
                $stmt = $this->DB->prepare( "SELECT jetski_id FROM jetskis;");
                $stmt->execute ();
                $reservations = $stmt->fetchAll (PDO::FETCH_ASSOC);
            }
            $ids = Array ();
            foreach($reservations as $x){
                $ids[] = $x["jetski_id"];
            }
            return $ids;

        }

        #Add user
        public function addUser($username, $password) {
            $stmt = $this->DB->prepare( "INSERT INTO users VALUES(NULL, :username, :password);");
            $stmt->bindParam( 'username', $username );
            $stmt->bindParam( 'password', $password);
            $stmt->execute();
        }

        #find username match
        public function findUsernameMatch($name) {
            $statement = $this->DB->prepare ("SELECT username from users where username = :name");
            $statement->bindParam ('name', $name);
            $statement->execute ();
            $data = $statement->fetch (PDO::FETCH_ASSOC);
            return json_encode($data);
        }

        #join function for administrator function
        public function findDate($date){
            $stmt = $this->DB->prepare(
                                               "SELECT username, jetski_id,
                                               reservation_date from users
                                               JOIN users_jetskis WHERE users.user_id = users_jetskis.user_id
                                               and reservation_date = :date;"
                                       );
            $stmt->bindParam('date', $date);
            $stmt->execute ();
            $data = $stmt->fetchAll (PDO::FETCH_ASSOC);
            return json_encode($data);
        }
    }

    ?>
