<html>
<head>
</head>
<body>
<?php

require( 'init.php' );

if	( HTTP_POST )
{
	if	( strlen($_REQUEST['new_password']) < 6 )
	{
		?><div class="error message">Password too short</div><?php
	}
	elseif( $_REQUEST['new_password'] != $_REQUEST['new_password_repeat'] )
	{
		?><div class="error message">Passwords did not match</div><?php
	}
	else
	{
		$stmtCheck = $db->prepare("SELECT local_part,domain_name FROM mailbox WHERE local_part = ? AND domain_name = ? AND password=MD5(?)");
		@list($requestLocalpart,$requestDomain) = explode('@',$_POST['username']);
		
		$stmtCheck->bind_param('sss',$requestLocalpart,$requestDomain,$_POST['old_password'] );
	    $stmtCheck->execute();
	    $stmtCheck->bind_result($localPart,$domain);
	    if	( $stmtCheck->fetch() )
	    {
	    	$stmtUpdatePW = $db->prepare("UPDATE mailbox SET password=MD5(?) WHERE local_part = ? AND domain_name = ?");
			$stmtCheck->bind_param('sss',$requestLocalpart,$requestDomain,$_POST['new_password'] );
	    	$stmtUpdatePW->execute();
	    	?><div class="success message">New password set</div><?php 
	    }
	    else
	    {
	    	?><div class="error message">Wrong password or not found</div><?php 
	    }
	}
}
	
?>

<form method="post">
<p><label for="id_username">E-Mail adress</label><input type="text" id="id_username" name="username" value="<?php echo @$_REQUEST['username'] ?>" /></p>
<p><label for="id_old_password">Old password</label><input type="password" name="old_password" id="id_old_password" />
<p><label for="id_new_password">New Password</label><input type="password" name="new_password"  id="id_new_password"/>
<p><label for="id_new_password_repeat">Repeat new password</label><input type="password" name="new_password_repeat"  id="id_new_password_repeat"/>
<input type="submit" value="Change password">
</form>



</body>
</html>