<?php

require( 'header.php' );

//if	( !OK ) die(':-O');

if	( HTTP_POST )
{
	$stmt = $db->prepare("SELECT local_part,domain_name FROM mailbox WHERE local_part = ? AND password=MD5(?)");
    $stmt->bind_param('ss',$_POST['username'], $_POST['password'] );
    $stmt->execute();
    $stmt->bind_result($localPart,$domain);
    if	( $stmt->fetch() )
    {
    	echo "Login";
    	print_r($localPart);
    	$_SESSION['user'  ] = $localPart;
    	$_SESSION['domain'] = $domain;
    	$_SESSION['user_type'] = USER_TYPE_ADMIN;
    }
    else
    {
    	?><div class="message">Login failed</div><?php 
    }
    //require('index.php');
    exit();
}
require( 'menu.php' );
	
?>
<form method="post">
<input type="text" name="username" />
<input type="password" name="password" />
<input type="submit">
</form>