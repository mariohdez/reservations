<!DOCTYPE html>
<!--
** Isaac Fimbres,
** Mario Hernandez
-->
<html>
<head>
<meta charset="UTF-8">
<title>Confirmation Page</title>
<link rel="stylesheet" href="styles.css">
</head>
<body id= "confirmationBody">

<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    
    $username = $_SESSION['user'];
    $num = $_POST['num_of_jets'];
    $date = $_POST['date'];
    
    require_once './DataBaseAdaptor.php';
    $db = new DatabaseAdaptor();
    
    if(!$db->overbooked ($date, $num)){
        $reservations = $db->createReservation($username, $date, $num);
        ?>

<div id="content" >
<h1>Congratulations <?=$username?>! You have successfully rented out <?=$num?> jet skis for <?=$date?></h1>
<p>Here are your jetski id's: <br>
<?php
    for($i=0; $i<sizeOf($reservations); ++$i){
        echo $reservations[$i] . ' ';
    }
    
    ?>
</p>
<p>Make sure to print a copy of this page just in case we mess something up. We cannot wait to see you! Be safe, and have a blast!</p>
<a href="index.php" >Go Back</a>
</div>
<?php
    }
    else{
        ?>
<div id="content" >
<h1>Sorry <?=$username?>! We are currently overbooked.</h1>
<p>We regret to inform you that we currently don't have <?=$num?> jet skis available on  <?=$date?> . <br>Please try a different quantity or a different date. Good luck, we hope to see you soon!</p>

<a href="index.php" >Go Back</a>
<?php }?>


</div>

</body>
</html>
