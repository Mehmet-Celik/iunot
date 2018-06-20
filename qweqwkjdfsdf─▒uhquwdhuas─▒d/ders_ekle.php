<script>
		function fakultesec() {
  		 fakulte_deger = $('select[name="fakulte"]').val();
 		  $.get('bolum_ajax.php', {fakulte_id: fakulte_deger}, function (gelen_cevap) {
  		    $('.bolum_option').html(gelen_cevap);
  		 });
		}
		

</script>
<?php if(guvenlik(isset($_GET["ders_ekle"]))){
echo '<form id="ders_ekle" name="ders_ekle" method="post" action="">
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-plus"></i> Ders Ekle</div>
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
  <th>Dönem Seçiniz: &nbsp
  <select name="donem" id="donem">
  <option value="1">1. Dönem (1.Sınıf)</option>
  <option value="2">2. Dönem (1.Sınıf)</option>
  <option value="3">3. Dönem (2.Sınıf)</option>
  <option value="4">4. Dönem (2.Sınıf)</option>
  <option value="5">5. Dönem (3.Sınıf)</option>
  <option value="6">6. Dönem (3.Sınıf)</option>
  <option value="7">7. Dönem (4.Sınıf)</option>
  <option value="8">8. Dönem (4.Sınıf)</option>
  </select>
  </th>
  </tr>
  <tr>
  <th>Ders İsmi: &nbsp <input type="text" name="txDers" id="txDers" required />&nbsp&nbsp<input type="submit" class="btn btn-default" name="btDersEkle" id="btDersEkle" value="Ekle" /></th>
  </tr>
  </thead> </table>
</div>
</form>';

if(isset($_POST["btDersEkle"])){
	$bolum_id=guvenlik($_POST["bolum"]);
	$donem_id=guvenlik($_POST["donem"]);
	$ders_isim=guvenlik($_POST["txDers"]);
	$sorgu=mysql_query("INSERT into tbl_ders (bolum_id,donem_id,ders_isim) values ('$bolum_id','$donem_id','$ders_isim')");
	if($sorgu){
		echo '<div class="alert alert-success" role="alert">Ders Başarıyla Eklenmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?ders_listele">';
		
	}
	else {
		echo '<div class="alert alert-danger" role="alert">Ders Ekleme Basarısız Olmuştur</div>';
	}
}

}
?>