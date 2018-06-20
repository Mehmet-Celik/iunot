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
<?php if(guvenlik(isset($_GET["duyuru_ekle"]))){
echo '<form id="duyuru_ekle" name="duyuru_ekle" method="post" action="">
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-plus"></i> Duyuru Ekle</div>
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
  <th>Duyuru İçerik: <br/> <textarea style="resize:none;" class="form-control" cols="200" required="required" name="txDuyuruIcerik" id="txDuyuruIcerik" rows="10"></textarea><br/><input type="submit" class="btn btn-default" name="btDuyuruEkle" id="btDuyuruEkle" value="Ekle" /></th>
  </tr>
  </thead> </table>
</div>
</form>';

if(isset($_POST["btDuyuruEkle"])){
	$bolum_id=guvenlik($_POST["bolum"]);
	$ders_id=guvenlik($_POST["ders"]);
	$duyuruicerik=guvenlik($_POST["txDuyuruIcerik"]);
	$sorgu=mysql_query("INSERT into tbl_duyuru (bolum_id,ders_id,duyuru_icerik) values ('$bolum_id','$ders_id','$duyuruicerik')");
	if($sorgu){
		echo '<div class="alert alert-success" role="alert">Duyuru Başarıyla Eklenmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?duyuru_listele">';
		
	}
	else {
		echo '<div class="alert alert-danger" role="alert">Ders Ekleme Basarısız Olmuştur</div>';
	}
}

}
?>