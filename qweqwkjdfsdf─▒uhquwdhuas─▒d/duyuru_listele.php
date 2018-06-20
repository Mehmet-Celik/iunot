<?php

if(guvenlik(isset($_GET["duyuru_listele"]))){
	$sorgu=mysql_query("SELECT * FROM tbl_duyuru order by duyuru_eklenme_tarihi desc");
	echo '<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-list-ul"></i> Duyuru Listele</div>
  <table class="table">
  <thead>
  <tr>
  <th>Duyuru id</th>
  <th>Bölüm İsim</th>
  <th>Ders İsim</th> 
  <th>Duyuru İçeriği</th> 
  <th>Sil</th> 
  <th>Güncelle</th> 
  </tr>
  </thead>
  <tbody>';
  while($duyuru_listesi=mysql_fetch_array($sorgu)){
			$bolum_id=$duyuru_listesi["bolum_id"];
			$ders_id=$duyuru_listesi["ders_id"];
			$sorgu1 = mysql_query("select * from tbl_bolum where id='$bolum_id'");
			$sorgu1sql=mysql_fetch_array($sorgu1);
			$sorgu2 = mysql_query("select * from tbl_ders where id='$ders_id'");
			$sorgu2sql=mysql_fetch_array($sorgu2);
	echo ' <tr>
	<th scope="row">'.$duyuru_listesi["id"].'</th>
  <td>'.$sorgu1sql["bolum"].'</td>
  <td>'.$sorgu2sql["ders_isim"].' Dönem</td>
  <td>'.$duyuru_listesi["duyuru_icerik"].'</td>
  <td><a href="adminpanel.php?duyuru_listele&duyuru_sil='.$duyuru_listesi["id"].'"><i class="fa fa-times"></a></i></td> 
  <td><a href="adminpanel.php?duyuru_listele&duyuru_guncelle='.$duyuru_listesi["id"].'"><i class="fa fa-pencil"></i></a></td>
  </tr>'; 
  }
  if(guvenlik(isset($_GET["duyuru_sil"]))){
	$silinen_duyuru_id=guvenlik($_GET["duyuru_sil"]);
	$duyuru_sil=mysql_query("DELETE FROM tbl_duyuru WHERE id='$silinen_duyuru_id'");
	if($duyuru_sil){
		echo '<div class="alert alert-success" role="alert">Duyuru Başarıyla Silinmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?duyuru_listele">';
	}
	if(!$duyuru_sil && guvenlik(!isset($_GET["duyuru_sil"]))) {
		echo '<div class="alert alert-danger" role="alert">Duyuru Silme Basarısız Olmuştur</div>';
	}	
}
   if(guvenlik(isset($_GET["duyuru_guncelle"]))){
	 $guncel_id=guvenlik($_GET["duyuru_guncelle"]);
	 $duyuru_guncelle=mysql_query("SELECT * FROM tbl_duyuru WHERE id='$guncel_id'");
	 $duyuru_goster=mysql_fetch_array($duyuru_guncelle);
	 echo '<tr><td colspan="6">
			<form id="duyuru_ekle" name="duyuru_ekle" method="post" action="">
				Duyuru İçeriği: <br/> <textarea class="form-control" style="resize:none;" cols="200" required="required" name="txDuyuruIcerik" id="txDuyuruIcerik" rows="10" >'.$duyuru_goster["duyuru_icerik"].'</textarea>
				<br/><input type="submit" class="btn btn-default" name="btDuyuruGuncelle" id="btDuyuruGuncelle" value="Güncelle" />
			</form></td></tr>';
		if(isset($_POST["btDuyuruGuncelle"])){
			$duyuruicerik=guvenlik($_POST["txDuyuruIcerik"]);
			$duyuruguncelle=mysql_query("UPDATE tbl_duyuru SET duyuru_icerik='$duyuruicerik' WHERE id='$guncel_id'");
			
		}
		if($duyuruguncelle){
			echo '<div class="alert alert-success" role="alert">Duyuru Başarıyla Güncellenmiştir.</div>';
			echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?duyuru_listele">';
			}
		if(!$duyuruguncelle && guvenlik(!isset($_GET["duyuru_guncelle"]))) {
		echo '<div class="alert alert-danger" role="alert">Duyuru Güncelleme Basarısız Olmuştur</div>';
	}
		
}
  
  
  echo '</tbody> </table>
</div>';

}

 ?>