<?php
ini_set('display_errors', 0); // 0 =  'Off'
$db     = "perlphpasp"; // will be created in ord_s2crtdb.php
$host   = "localhost";
$uname  = "root";
$upass  = "";
$tb     = "worker";
if (!$connect = mysql_connect($host,$uname,$upass)){
 die('connect : failed');
}
?>