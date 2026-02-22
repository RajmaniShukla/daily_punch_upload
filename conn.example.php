<?php
/**
 * Database Connection Configuration
 * 
 * INSTRUCTIONS:
 * 1. Copy this file to conn.php
 * 2. Replace placeholder values with actual credentials
 * 3. Never commit conn.php to version control
 */

error_reporting(E_ERROR);

// Main PPC Database
global $dbh;
$dbh = new PDO(
    "informix:; database=YOUR_DATABASE; server=YOUR_SERVER; service=YOUR_PORT; protocol=onsoctcp; EnableScrollableCursors=1",
    "YOUR_USERNAME",
    "YOUR_PASSWORD"
);

// Quality Database
global $quality;
$quality = new PDO(
    "informix:; database=quality; server=YOUR_SERVER; service=YOUR_PORT; protocol=onsoctcp; EnableScrollableCursors=1",
    "YOUR_USERNAME",
    "YOUR_PASSWORD"
);

// Payroll Database
global $payroll;
$payroll = new PDO(
    "informix:; database=payroll; server=YOUR_SERVER; service=YOUR_PORT; protocol=onsoctcp; EnableScrollableCursors=1",
    "YOUR_USERNAME",
    "YOUR_PASSWORD"
);

// E-Admin Database
global $dbe;
$dbe = new PDO(
    "informix:; database=eadmin; server=YOUR_SERVER; service=YOUR_PORT; protocol=onsoctcp; EnableScrollableCursors=1",
    "YOUR_USERNAME",
    "YOUR_PASSWORD"
);

// Allowed IP addresses for access control
global $allowedIP;
$allowedIP = array(
    "YOUR_IP_1",
    "YOUR_IP_2",
    // Add more allowed IPs
);
?>
