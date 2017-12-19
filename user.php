<!--
 * Programmer(s): Isaac Fimbres & Mario Hernandez
 * File: user.php
 * Purpose: To serve as the gateway to the main application.
-->


<script type="text/javascript" src="./prototype.js"></script>
<script type="text/javascript" src="login.js"></script>

<h2>Log in</h2>

<fieldset>
<legend>Login</legend>

<form id="login" action="index.php" method="post">

<dl>
<dt> Name </dt> <dd> <input type="text" name="name" /> </dd>
<dt> Password </dt> <dd> <input type="password" name="password" /> </dd>
<dt> </dt> <dd> <input type="submit" name="login" value="Log in" /> </dd>
</dl>

</form>
</fieldset>

<h2>Register</h2>
<fieldset>
<legend>Register</legend>

<form id="Register" action="index.php" method="post">

<dl>
<dt> Name </dt> <dd> <input type="text" id="name" name="name" /> <span id="status"> </span> </dd>
<dt> Password </dt> <dd> <input type="password" name="password" /> </dd>
<dt> </dt> <dd> <input type="submit" name="register" value="Register" /> </dd>
</dl>

</form>
</fieldset>

<div id="errors"><p></p></div>
