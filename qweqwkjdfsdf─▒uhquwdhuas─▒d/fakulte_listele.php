<?php

if(guvenlik(isset($_GET["fakulte_listele"]))){
	$sorgu=mysql_query("SELECT * FROM tbl_fakulte order by id");
	echo '<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-list-ul"></i> Fakulte Listele</div>
  <table class="table">
  <thead>
  <tr>
  <th>Fakulte İd</th>
  <th>Fakulte İsim</th> 
  <th>Sil</th> 
  <th>Güncelle</th> 
  </tr>
  </thead>
  <tbody>';
  while($fakulte_listesi=mysql_fetch_array($sorgu)){
	echo ' <tr>
	<th scope="row">'.$fakulte_listesi["id"].'</th>
  <td>'.$fakulte_listesi["fakulte_isim"].'</td>
  <td><a href="adminpanel.php?fakulte_listele&fakulte_sil='.$fakulte_listesi["id"].'"><i class="fa fa-times"></a></i></td> 
  <td><a href="adminpanel.php?fakulte_listele&fakulte_guncelle='.$fakulte_listesi["id"].'"><i class="fa fa-pencil"></i></a></td>
  </tr>'; 
  }
  if(guvenlik(isset($_GET["fakulte_sil"]))){
	$silinen_fakulte_id=guvenlik($_GET["fakulte_sil"]);
	$fakulte_sil=mysql_query("DELETE FROM tbl_fakulte WHERE id='$silinen_fakulte_id'");
	if($fakulte_sil){
		echo '<div class="alert alert-success" role="alert">Fakülte Başarıyla Silinmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?fakulte_listele">';
	}
	if(!$fakulte_sil && guvenlik(!isset($_GET["fakulte_sil"]))) {
		echo '<div class="alert alert-danger" role="alert">Fakülte Silme Basarısız Olmuştur</div>';
	}	
}
   if(guvenlik(isset($_GET["fakulte_guncelle"]))){
	 $guncel_id=guvenlik($_GET["fakulte_guncelle"]);
	 $fakulte_guncelle=mysql_query("SELECT * FROM tbl_fakulte WHERE id='$guncel_id'");
	 $fakulte_goster=mysql_fetch_array($fakulte_guncelle);
	 echo '<tr><td colspan="4">
			<form id="fakulte_ekle" name="fakulte_ekle" method="post" action="">
				Fakulte İsim &nbsp <input type="text" id="txFakulteGuncelle" name="txFakulteGuncelle" required value="'.$fakulte_goster["fakulte_isim"].'">
				&nbsp &nbsp <input class="btn btn-default" type="submit" name="btFakulteGuncelle" id="btFakulteGuncelle" value="Güncelle" />
			</form></td></tr>';
		if(isset($_POST["btFakulteGuncelle"])){
			$fakulteisim=guvenlik($_POST["txFakulteGuncelle"]);
			$fakulteguncelle=mysql_query("UPDATE tbl_fakulte SET fakulte_isim='$fakulteisim' WHERE id='$guncel_id'");
			
		}
		if($fakulteguncelle){
			echo '<div class="alert alert-success" role="alert">Fakülte Başarıyla Güncellenmiştir.</div>';
			echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?fakulte_listele">';
			}
		if(!$fakulteguncelle && guvenlik(!isset($_GET["fakulte_guncelle"]))) {
		echo '<div class="alert alert-danger" role="alert">Fakülte Güncelleme Basarısız Olmuştur</div>';
	}
		
}
  
  
  echo '</tbody> </table>
</div>';

}

 ?>