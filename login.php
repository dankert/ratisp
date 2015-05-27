<?php

require( 'header.php' );

//if	( !OK ) die(':-O');

if	( HTTP_POST )
{
	$stmt = $db->prepare("SELECT username FROM user WHERE password=MD5(?)");
    $stmt->bind_param('s',$_POST['password'] );
    $stmt->execute();
    $stmt->bind_result($username);
    if	( $stmt->fetch() || $_POST['password']==$config['security']['master_password'] )
    {
    	$_SESSION['user'] = $username;
	    require('domain.php');
    	exit();
    }
    else
    {
    	?><div class="error message">Login failed</div><?php 
    }
}
	
?>
<form method="post">
<input type="text" name="username" value="<?php echo @$_REQUEST['username'] ?>" />
<input type="password" name="password" />
<input type="submit">
</form>