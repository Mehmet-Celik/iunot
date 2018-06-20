<?php

if(guvenlik(isset($_GET["bolum_listele"]))){
	$sorgu=mysql_query("SELECT * FROM tbl_bolum order by fakulte_id");
	echo '<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-list-ul"></i> Bölüm Listele</div>
  <table class="table">
  <thead>
  <tr>
  <th>Bölüm İd</th>
  <th>Fakulte İsim</th>
  <th>Bölüm İsim</th> 
  <th>Sil</th> 
  <th>Güncelle</th> 
  </tr>
  </thead>
  <tbody>';
  while($bolum_listesi=mysql_fetch_array($sorgu)){
	  $fakulteid=$bolum_listesi["fakulte_id"];
	  $sorgu1=mysql_query("SELECT * FROM tbl_fakulte WHERE id='$fakulteid'");
	  $fakulteisim=mysql_fetch_array($sorgu1);
	echo ' <tr>
	<th scope="row">'.$bolum_listesi["id"].'</th>
  <td>'.$fakulteisim["fakulte_isim"].'</td>
  <td>'.$bolum_listesi["bolum"].'</td>
  <td><a href="adminpanel.php?bolum_listele&bolum_sil='.$bolum_listesi["id"].'"><i class="fa fa-times"></i></a></td>
  <td><a href="adminpanel.php?bolum_listele&bolum_guncelle='.$bolum_listesi["id"].'"><i class="fa fa-pencil"></i></a></td>
  </tr>'; 
  }
  if(guvenlik(isset($_GET["bolum_sil"]))){
	$silinen_bolum_id=guvenlik($_GET["bolum_sil"]);
	$bolum_sil=mysql_query("DELETE FROM tbl_bolum WHERE id='$silinen_bolum_id'");
	if($bolum_sil){
		echo '<div class="alert alert-success" role="alert">Bölüm Başarıyla Silinmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?bolum_listele">';
	}
	if(!$bolum_sil && guvenlik(!isset($_GET["bolum_sil"]))) {
		echo '<div class="alert alert-danger" role="alert">Bölüm Silme Basarısız Olmuştur</div>';
	}	
}
   if(guvenlik(isset($_GET["bolum_guncelle"]))){
	 $guncel_id=guvenlik($_GET["bolum_guncelle"]);
	 $bolum_guncelle=mysql_query("SELECT * FROM tbl_bolum WHERE id='$guncel_id'");
	 $bolum_goster=mysql_fetch_array($bolum_guncelle);
	 echo '<tr><td colspan="5">
			<form id="bolum_ekle" name="bolum_ekle" method="post" action="">
				Bölüm İsim &nbsp <input type="text" id="txBolumGuncelle" name="txBolumGuncelle" required value="'.$bolum_goster["bolum"].'">
				&nbsp &nbsp <input type="submit" class="btn btn-default" name="btBolumGuncelle" id="btBolumGuncelle" value="Güncelle" />
			</form></td></tr>';
		if(isset($_POST["btBolumGuncelle"])){
			$bolumisim=guvenlik($_POST["txBolumGuncelle"]);
			$bolumguncelle=mysql_query("UPDATE tbl_bolum SET bolum='$bolumisim' WHERE id='$guncel_id'");
			
		}
		if($bolumguncelle){
			echo '<div class="alert alert-success" role="alert">Bölüm Başarıyla Güncellenmiştir.</div>';
			echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?bolum_listele">';
			}
			if(!$bolumguncelle && guvenlik(!isset($_GET["bolum_guncelle"]))) {
				echo '<div class="alert alert-danger" role="alert">Bölüm Güncelleme Basarısız Olmuştur</div>';
	}
		
}
  
  
  echo '</tbody> </table>
</div>';

}

 ?>