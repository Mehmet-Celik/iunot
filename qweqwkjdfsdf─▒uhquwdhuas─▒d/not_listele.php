<script>
		function fakultesec() {
  		 fakulte_deger = $('select[name="fakulte"]').val();
 		  $.get('fakulte_option.php', {fakulte_id: fakulte_deger}, function (gelen_cevap) {
  		    $('.bolum_option').html(gelen_cevap);
  		 });
		}
		

</script>
<script>
		function bolumsec() {
  		 bolum_deger = $('select[name="bolum"]').val();
 		  $.get('ders_ajax.php', {bolum_id: bolum_deger}, function (gelen_cevap) {
  		    $('.ders').html(gelen_cevap);
  		 });
		}
		

</script>
<?php if(guvenlik(isset($_GET["not_listele"]))){
echo '<form id="not_listele" name="not_listele" method="post" action="">
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-plus"></i> Not Listele</div>
  <table class="table">
  <thead>
  <tr>
  <th>
  Fakülte Seçiniz: &nbsp 
  <select name="fakulte" id="fakulte" onChange="fakultesec()">
  <option>Seçiniz...</option>
	';
	$sorgu=mysql_query("SELECT * FROM tbl_fakulte order by id");
	while($sorgusql=mysql_fetch_array($sorgu)){
		echo'<option value="'.$sorgusql["id"].'">'.$sorgusql["fakulte_isim"].'</option>';
	}
	echo'
  </select>
  </th>
  </tr>
  <tr>
  <th>Bölüm Seçiniz: &nbsp <div class="bolum_option" style="display:inline;"></div>
  </th>
  </tr>
  <tr>
  <th>Ders Seçiniz: &nbsp <div class="ders" style="display:inline;"></div>
  </th>
  </tr>
  <tr>
  <th><input type="submit" class="btn btn-default" name="btNotListele" id="btNotListele" value="Notları Listele" /></th>
  </tr>
  </thead> </table>
</form>
		<table class="table">
		  <thead>
		  <tr>
		  <th>Not Başlığı</th>
		  <th>Not İçeriği</th>
		  <th>Not Hit</th>
		  <th>Not Eklenme Tarihi</th>
		   <th>Görüntülenme</th>
		   <th>Sil</th>
		  </tr></thead>';

if(isset($_POST["btNotListele"])){
	$ders_id=guvenlik($_POST["ders"]);
	$sorgu=mysql_query("select * from tbl_not where ders_id='$ders_id'");
	while($notlistele=mysql_fetch_array($sorgu)){
		$goster=$notlistele["goruntulenme"];
		if($goster==0){
		  $goruntuleme='<a href="adminpanel.php?not_listele&not='.$notlistele["id"].'"><i class="fa fa-eye-slash"></i> Yayınlanmıyor</a>';
	  }
	  else{
		  $goruntuleme='<a href="adminpanel.php?not_listele&not='.$notlistele["id"].'"><i class="fa fa-eye"></i> Yayınlanıyor</a>';
	  }
		echo'
		
		  <tr>
		  <td>'.$notlistele["not_baslik"].'</td>
		  <td>'.$notlistele["not_icerik"].'</td>
		  <td>'.$notlistele["hit"].'</td>
		  <td>';tarihformat($notlistele["not_eklenme_tarihi"]); echo'</td>
		  <td>'.$goruntuleme.'</td>
		  <td><a href="adminpanel.php?not_listele&sil_not='.$notlistele["id"].'"><i class="fa fa-times"></i></a></td>
		  </tr>
		
		';
	}
}else{
	$sorgu=mysql_query("select * from tbl_not order by id desc");
		while($notlistele=mysql_fetch_array($sorgu)){
		$goster=$notlistele["goruntulenme"];
		if($goster==0){
		  $goruntuleme='<a href="adminpanel.php?not_listele&not='.$notlistele["id"].'"><i class="fa fa-eye-slash"></i> Yayınlanmıyor</a>';
	  }
	  else{
		  $goruntuleme='<a href="adminpanel.php?not_listele&not='.$notlistele["id"].'"><i class="fa fa-eye"></i> Yayınlanıyor</a>';
	  }
		echo'
		
		  <tr>
		  <td>'.$notlistele["not_baslik"].'</td>
		  <td>'.$notlistele["not_icerik"].'</td>
		  <td>'.$notlistele["hit"].'</td>
		  <td>';tarihformat($notlistele["not_eklenme_tarihi"]); echo'</td>
		  <td>'.$goruntuleme.'</td>
		  <td><a href="adminpanel.php?not_listele&sil_not='.$notlistele["id"].'"><i class="fa fa-times"></i></a></td>
		  </tr>
		
		';
	}
}
	if(guvenlik(isset($_GET["not"]))){
		$not=guvenlik($_GET["not"]);
		$sorgu=mysql_query("select * from tbl_not where id='$not'");
		$notsorgu=mysql_fetch_array($sorgu);
		$goster=$notsorgu["goruntulenme"];
		if($goster==0){
			$gosteriguncelle=mysql_query("UPDATE tbl_not SET goruntulenme='1' where id='$not'");
		}
		else{
			$gosteriguncelle=mysql_query("UPDATE tbl_not SET goruntulenme='0' where id='$not'");
		}
		if($gosteriguncelle){
			echo '<meta http-equiv="refresh" content="0;URL=adminpanel.php?not_listele">';
		}
		else{
			echo '<div class="alert alert-danger" role="alert">Görüntüleme Hatası ! </div>';
		}
		
	}
	if(guvenlik(isset($_GET["sil_not"]))){
	$silinen_not_id=guvenlik($_GET["sil_not"]);
	$not_sil=mysql_query("DELETE FROM tbl_not WHERE id='$silinen_not_id'");
	if($not_sil){
		echo '<div class="alert alert-success" role="alert">Not Başarıyla Silinmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?not_listele">';
	}
	if(!$not_sil && guvenlik(!isset($_GET["not_sil"]))) {
		echo '<div class="alert alert-danger" role="alert">Not Silme Basarısız Olmuştur</div>';
	}	
}
echo'</table></div>';
}
?>