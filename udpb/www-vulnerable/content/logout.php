<?php
//zrusime session
$_SESSION = array();
session_destroy();
//header("LOCATION: page.php") je v pohode avsak nikdy netreba verit pouzivatelovi a tak to radsej presmeruj priamo na stranku kde sa nachadza login ;)
$host  = $_SERVER['HTTP_HOST'];
header("LOCATION: http://$host/udpb/www-vulnerable/");
?>
