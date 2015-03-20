<?php
define('OK', true);

define('USER_TYPE_ADMIN',1);
define('USER_TYPE_DOMAIN_ADMIN',2);
define('USER_TYPE_MAIL_ACCOUNT',3);

session_name('ratisp');
session_start();

if	 ( !@$_SESSION['user'] )
	require('login.php');
else
	switch( $_SESSION['user_type'] )
	{
		case USER_TYPE_ADMIN:
			require('domain_list.php');
			break;
		case USER_TYPE_DOMAIN_ADMIN:
			require('domain.php');
			break;
		case USER_TYPE_MAIL_ACCOUNT:
			require('mailbox.php');
			break;
		default:
			exit();
	}


?>