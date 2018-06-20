<script>
		function fakultesec() {
  		 fakulte_deger = $('select[name="fakulte"]').val();
 		  $.get('bolum_ajax.php', {fakulte_id: fakulte_deger}, function (gelen_cevap) {
  		    $('.bolum_option').html(gelen_cevap);
  		 });
		}
		

</script>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script>
		$(document).ready(function(){
		$("#btDersEkle").click(function(){
		var bolum = $("#bolum").val();
		var donem = $("#donem").val();
		var ders = $("#txDers").val();
		// Returns successful data submission message when the entered information is stored in database.
		var dataString = 'bolum='+ bolum + '&donem='+ donem + '&txDers='+ ders;
		
		// AJAX Code To Submit Form.
		$.ajax({
		type: "POST",
		url: "ajaxsubmit.php",
		data: dataString,
		cache: false,
		success: function(result){
		}
		});
		
		return false;
		});
		});
		
		$(document).ready(function(){
		$("#btDersEkle").click(function(){
        $("#txDers").val(" ");
		});
		});
		
		function sohbetGuncelle(){
			$.ajax({
			  type:"POST",
			  url:"ders_listele_ajax.php",
			  data:{"tip":"guncelle"},
			  success:function(sonuc){
				  $("#icerik").html(sonuc);
			  }
		
		  });
}
setInterval("sohbetGuncelle()",1500);
</script>
<?php

if(guvenlik(isset($_GET["ders_listele"]))){
	echo '
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
</div>';


if(guvenlik(isset($_GET["ders_sil"]))){
	$silinen_ders_id=guvenlik($_GET["ders_sil"]);
	$ders_sil=mysql_query("DELETE FROM tbl_ders WHERE id='$silinen_ders_id'");
	if($ders_sil){
		echo '<div class="alert alert-success" role="alert">Ders Başarıyla Silinmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?ders_listele">';
	}
	if(!$ders_sil && guvenlik(!isset($_GET["ders_sil"]))) {
		echo '<div class="alert alert-danger" role="alert">Ders Silme Basarısız Olmuştur</div>';
	}	
}
   if(guvenlik(isset($_GET["ders_guncelle"]))){
	 $guncel_id=guvenlik($_GET["ders_guncelle"]);
	 $ders_guncelle=mysql_query("SELECT * FROM tbl_ders WHERE id='$guncel_id'");
	 $ders_goster=mysql_fetch_array($ders_guncelle);
	 echo '<tr><td colspan="6">
			<form id="ders_ekle" name="ders_ekle" method="post" action="">
				Ders İsim &nbsp <input type="text" id="txDersGuncelle" name="txDersGuncelle" required value="'.$ders_goster["ders_isim"].'">
				&nbsp &nbsp <input type="submit" class="btn btn-default" name="btDersGuncelle" id="btDersGuncelle" value="Güncelle" />
			</form></td></tr>';
		if(isset($_POST["btDersGuncelle"])){
			$dersisim=guvenlik($_POST["txDersGuncelle"]);
			$dersguncelle=mysql_query("UPDATE tbl_ders SET ders_isim='$dersisim' WHERE id='$guncel_id'");
			
		}
		if($dersguncelle){
			echo '<div class="alert alert-success" role="alert">Ders Başarıyla Güncellenmiştir.</div>';
			echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?ders_listele">';
			}
		if(!$dersguncelle && guvenlik(!isset($_GET["ders_guncelle"]))) {
		echo '<div class="alert alert-danger" role="alert">Ders Güncelleme Basarısız Olmuştur</div>';
	}
		
}
	echo'<div id="icerik"></div>';
	
  
  
  echo '</tbody> </table>
</div>';

}

 ?>