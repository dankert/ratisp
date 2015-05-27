<?php

require('init.php');
require('header.php');

define('OK', true);

define('USER_TYPE_ADMIN',1);
define('USER_TYPE_DOMAIN_ADMIN',2);
define('USER_TYPE_MAIL_ACCOUNT',3);



if	 ( !@$_SESSION['user'] )
	require('login.php');
else
	require('domain.php');
	

?>