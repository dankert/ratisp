<?php

require( 'header.php' );

if	( !OK ) die(':-O');

unset($_SESSION['user'  ]);
unset($_SESSION['domain']);
unset($_SESSION['user_type']);


include('login.php');
?>
