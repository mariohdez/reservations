<!--
 * Programmer(s): Isaac Fimbres & Mario Hernandez
 * File: reserve_jet_skis.php
 * Purpose: To serve as the main page of functionallity.
-->


<?php
$number_of_available_jetskis =  rand( 1 , 12 );
# Call database adaptor.
# Get a list of all of the
# available jet skis and print those out.
# if count(list) > 0, then there is at least
# one jet ski to reserve
?>


<fieldset>
    <legend>Reserve</legend>
    <form action="confirmation.php" method="post">
        <dl>
            <dt> Number of Jetskis (Max 12) </dt> <dd> <input type="text" placeholder="3" name="num_of_jets" required="required" pattern="\d{1}{1,2}"/> </dd>
            <dt> Date </dt> <dd> <input type="input" name="date" placeholder="2017-07-21" pattern="\d{4}-\d{2}-\d{2}" required="required" /> </dd>
            <dt> </dt> <dd> <input type="submit" name="reserve_form" value="Reserve" /> </dd>
        </dl>
    </form>
</fieldset>
<div id="logoutButton">
    <a href="logout.php">Logout</a>
</div>

<?php



?>
