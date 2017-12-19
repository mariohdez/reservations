<!DOCTYPE html>
<!-- Isaac Fimbres, Mario Hernandez-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Administration Page</title>
        <link rel="stylesheet" href="styles.css">
        <script type= "text/javascript" src="./admin.js"></script>
        <script type= "text/javascript" src="./prototype.js"></script>
    </head>

    <body>
    <div id="adminReport">
    <h1>Welcome Administrator!</h1>
    <p>Please enter a date (YYYY-MM-DD) to see a report of available jetskis: </p>
    <input id= "reportDateText"/>

    <table id = "report">
    <tr><td>Jetski ID</td><td>Username</td></tr>
    </table>
    <p id ="errors"></p>
    <div id="logoutButton">
        <a href="logout.php">Logout</a>
    </div>
    </div>
    </body>

</html>
