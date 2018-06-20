<?php include('../includes/config.php'); ?>
<?php

	$bolum_id=$_POST["bolum"];
	$donem_id=$_POST["donem"];
	$ders_isim=$_POST["txDers"];
	$sorgu=mysql_query("INSERT into tbl_ders (bolum_id,donem_id,ders_isim) values ('$bolum_id','$donem_id','$ders_isim')");

?>