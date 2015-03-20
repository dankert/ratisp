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

<?php

$config = parse_ini_file('config.ini.php',true);

define('HTTP_POST',$_SERVER['REQUEST_METHOD']=='POST');
define('HTTP_GET' ,!HTTP_POST                        );

define('LANG_DNS_RECORD','DNS Record');
define('LANG_MAILBOX','Mailbox');

$dbConfig = $config['database'];
$db       = new mysqli($dbConfig['host'], $dbConfig['user'],$dbConfig['password'], $dbConfig['database']);

if	( $db->connect_errno )
	die("Failed to connect to MySQL: (" . $db->connect_errno . ") " . $db->connect_error);

?>