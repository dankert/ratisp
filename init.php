<?php

session_name('ratisp');
session_start();

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