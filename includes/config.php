<?php 

$db_adres = "127.0.0.1";
$db_user = "root";
$db_pass = "";
$db = "dhciiunot_db_iunot";

$conn = mysql_connect($db_adres,$db_user,$db_pass);

if(!$conn) {
	die("Ba�lant� Hatas�".mysql_error());
}

$db_select = mysql_select_db($db,$conn);

if(!$db_select) {
	die("Ba�lant� Hatas�".mysql_error());
}
 session_start();
	  ob_start();

?>