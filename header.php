<html>
<body>
<h3></h3>
<?php

if	( @$_SESSION['user'] )
{
	echo $_SESSION['user'];
	?><a href="logout.php">Logout</a><?php
} else {
?><a href="login.php">Not logged in</a><?php 
}
?>