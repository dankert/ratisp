Menu
<ul>
<?php

// if	( !OK ) die(':-O');

$stmt        = $db->prepare("SELECT name FROM domain");
$stmtRecords = $db->prepare("SELECT record_name FROM domain_record WHERE domain_name = ?");
$stmtMailbox = $db->prepare("SELECT local_part, domain_name FROM mailbox WHERE domain_name = ?");

$stmt->bind_result($domainName);
$stmtRecords->bind_param('s',$domain);
$stmtMailbox->bind_param('s',$domain);
$stmt->execute();
while( $stmt->fetch() )
{
	echo '<li>'.$domainName;

	echo '<ul><li>'.LANG_DNS_RECORD.'<ul>';
	$stmtRecords->execute();
	$stmtRecords->bind_result($record);
	while( $stmt->fetch() )
	{
		echo '<li>'.$record;
		echo '</li>';
	}
	echo '</ul></li></ul>';

	echo '<ul><li>'.LANG_MAILBOX.'<ul>';
	$stmtMailbox->bind_result($mailboxLocal,$mailboxDomain);
	$stmtMailbox->execute();
	while( $stmt->fetch() )
	{
		echo '<li>'.$mailboxLocal.'@'.$mailboxDomain;
		echo '</li>';
	}
	echo '</ul></li></ul>';
	
	echo '</li>';
}

?>
</ul>