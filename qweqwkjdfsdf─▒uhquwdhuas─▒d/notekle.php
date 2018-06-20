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
<?php if(guvenlik(isset($_GET["not_ekle"]))){
echo '<form id="not_ekle" name="not_ekle" method="post" action="">
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-plus"></i> Not Ekle</div>
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
  <th>Not Başlığı: &nbsp <input type="text" id="txNotBaslik" name="txNotBaslik" class="form-control" style="width:300px;" required/>
  </th>
  </tr>
  <tr>
  <th>(PDF,WORD)Link : &nbsp <input type="text" id="txEmbed" name="txEmbed" class="form-control" style="width:300px;"/>
  </th>
  </tr>
  <tr>
  <th>Not İçerik: <br/> <textarea style="resize:none;" class="ckeditor" cols="200" name="txNotIcerik" id="txNotIcerik" rows="10"></textarea><br/><input type="submit" class="btn btn-default" name="btNotEkle" id="btNotEkle" value="Ekle" /></th>
  </tr>
  </thead> </table>
</div>
</form>';

if(isset($_POST["btNotEkle"])){
	$ders_id=guvenlik($_POST["ders"]);
	$notbaslik=guvenlik($_POST["txNotBaslik"]);
	$noticerik=$_POST["txNotIcerik"];
	$embed=$_POST["txEmbed"];
	if($embed!=""){
		$embed='<embed src="'.$embed.'">';
	}
	$noticerik=$embed.$noticerik;
	$sorgu=mysql_query("INSERT into tbl_not (ders_id,not_baslik,not_icerik) values ('$ders_id','$notbaslik','$noticerik')");
	if($sorgu){
		echo '<div class="alert alert-success" role="alert">Not Başarıyla Eklenmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?not_listele">';
		
	}
	else {
		echo '<div class="alert alert-danger" role="alert">Not Ekleme Basarısız Olmuştur</div>';
	}
}

}
?>