<?php


if	( ! $stmtDomains = $db->prepare("SELECT name FROM domain WHERE owner=?") ) {echo "Query failed: (" . $mysqli->errno . ") " . $mysqli->error;}

$stmtDomains->bind_param('s',$user);
$user=$_SESSION['user'];

$stmtDomains->execute();

$stmtDomains->bind_result($domainName);

?><div class="container"><h1>Domains</h1><?php 
?><ul><?php 
while( $stmtDomains->fetch() )
{
	echo '<li>'.$domainName.'</li>';
}
?></ul><?php
?></div><?php

?>



?><div class="container"><h1>Subdomains</h1><?php 
?><ul><?php
$stmtRecords = $db->prepare("SELECT subdomain_name FROM domain_record WHERE domain_name IN (SELECT domain_name FROM domain WHERE owner=?)");
$stmtRecords->bind_param('s',$user);
$user=$_SESSION['user'];

// $stmtMailbox = $db->prepare("SELECT local_part, domain_name FROM mailbox WHERE domain_name IN (SELECT domain_name FROM domain WHERE owner=?)");
// $stmtMailbox->bind_param('s',$user);

$stmtRecords->execute();
$stmtRecords->bind_result($subDomain);

while( $stmtRecords->fetch() )
{
	echo '<li>'.$subDomain.'</li>';
}
?></ul><?php
?></div><?php





?><div class="container"><h1>Mailbox</h1><?php
?><ul><?php

$stmtMailbox = $db->prepare("SELECT local_part, domain_name FROM mailbox WHERE domain_name IN (SELECT domain_name FROM domain WHERE owner=?)");
$stmtMailbox->bind_param('s',$user);
$user=$_SESSION['user'];

$stmtMailbox->bind_result($mailboxLocal,$mailboxDomain);
$stmtMailbox->execute();
while( $stmtMailbox->fetch() )
{
	echo '<li>'.$mailboxLocal.'@'.$mailboxDomain;
	echo '</li>';
}
	
?></ul><?php
?></div><?php

