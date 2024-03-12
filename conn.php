<?php
error_reporting(E_ERROR);
global $dbh;
$dbh = new PDO("informix:;  database=ppc;server=ead;service=7925;protocol=onsoctcp;EnableScrollableCursors=1","gmrep","gmrep");
global $quality;
$quality = new PDO("informix:; database=quality;server=ead;service=7925;protocol=onsoctcp;EnableScrollableCursors=1","gun","gun2003");
global $payroll;
$payroll = new PDO("informix:; database=payroll;server=ead;service=7925;protocol=onsoctcp;EnableScrollableCursors=1","acs","acs");
global $dbe;
$dbe = new PDO("informix:; database=eadmin;server=ead;service=7925;protocol=onsoctcp;EnableScrollableCursors=1","gmrep","gmrep");
global $dbq;
$dbq = new PDO("informix:; database=quality;server=ead;service=7925;protocol=onsoctcp;EnableScrollableCursors=1","gun","gun2003");
global $allowedIP;
$allowedIP = array(
		"172.61.100.75",
		"172.61.100.69",
		"172.61.100.76",
		"172.61.100.100",
		"172.61.102.200" 
		); 
		
/*global $dbh;
$dbh = new PDO("informix:; database=ppc;server=ead;service=7925;protocol=onsoctcp;EnableScrollableCursors=1","gmrep","gmrep");
global $quality;
$quality = new PDO("informix:; database=quality;server=ead;service=7925;protocol=onsoctcp;EnableScrollableCursors=1","gun","gun2003");
global $payroll;
$payroll = new PDO("informix:; database=payroll;server=ead;service=7925;protocol=onsoctcp;EnableScrollableCursors=1","acs","acs");
global $dbe;
$dbe = new PDO("informix:; database=eadmin;server=ead;service=7925;protocol=onsoctcp;EnableScrollableCursors=1","admdev","nov2018admdev");
global $dbq;
$dbq = new PDO("informix:; database=quality;server=ead;service=7925;protocol=onsoctcp;EnableScrollableCursors=1","gun","gun2003");*/
?>
