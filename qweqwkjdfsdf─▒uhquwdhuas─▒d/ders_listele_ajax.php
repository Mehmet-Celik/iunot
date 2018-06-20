<?php include('../includes/config.php'); ?>
<?php include('../includes/function.php'); ?>
<?php
$sorgu=mysql_query("SELECT * FROM tbl_ders order by bolum_id,donem_id");
	echo '<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-list-ul"></i> Ders Listele</div>
  <table class="table">
  <thead>
  <tr>
  <th>Ders Id</th>
  <th>Bölüm İsim</th>
  <th>Dönem</th> 
  <th>Ders İsim</th> 
  <th>Sil</th> 
  <th>Güncelle</th> 
  </tr>
  </thead>
  <tbody>';
  while($ders_listesi=mysql_fetch_array($sorgu)){
	  $bolumid=$ders_listesi["bolum_id"];
	  $sorgu1=mysql_query("SELECT * FROM tbl_bolum WHERE id='$bolumid'");
	  $bolumsql=mysql_fetch_array($sorgu1);
	echo ' <tr>
	<th scope="row">'.$ders_listesi["id"].'</th>
  <td>'.$bolumsql["bolum"].'</td>
  <td>'.$ders_listesi["donem_id"].' Dönem</td>
  <td>'.$ders_listesi["ders_isim"].'</td>
  <td><a href="adminpanel.php?ders_listele&ders_sil='.$ders_listesi["id"].'"><i class="fa fa-times"></a></i></td> 
  <td><a href="adminpanel.php?ders_listele&ders_guncelle='.$ders_listesi["id"].'"><i class="fa fa-pencil"></i></a></td>
  </tr>'; 
  }
  
 ?>