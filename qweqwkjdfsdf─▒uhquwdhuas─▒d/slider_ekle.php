<?php if(guvenlik(isset($_GET["slider_ekle"]))){
echo '<form id="slider_ekle" name="slider_ekle" method="post" enctype="multipart/form-data" action="">
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-plus"></i> Slider Ekle</div>
  <table class="table">
  <thead>
  <tr>
  <th>Slider İsim &nbsp <input class="form-control" style="width:300px;" name="txSliderisim" id="txSliderisim"  type="text" required="required" /><br><input name="txSlider" id="txSlider"  type="file" required="required" /></th>
  </tr>
  <tr>
  <th>&nbsp&nbsp<input type="submit" class="btn btn-default" name="btSliderEkle" id="btSliderEkle" value="Ekle" /></th>
  </tr>
  </thead> </table>
</div>
</form>';

if(isset($_POST["btSliderEkle"])){
	$slider_isim=guvenlik($_POST["txSliderisim"]);
	$kaynak		= $_FILES["txSlider"]["tmp_name"];
						$yol="../images";
						$yeniad		= substr(md5(time()), 0,30);
						$uzanti		= explode('/',$_FILES["txSlider"]["type"]);
						$uzantison=".".$uzanti[1];
						$isim=$_FILES["txSlider"]["type"];
							$resimurl		= $yeniad.$uzantison;
							@move_uploaded_file($kaynak,$yol."/".$resimurl);
							$resimurlson="images/".$resimurl;
							$slider_ekle=mysql_query("INSERT into tbl_slider (slider_isim,slider_dosya_yolu) values ('$slider_isim','$resimurlson')");
						
						

	if($slider_ekle){
		echo '<div class="alert alert-success" role="alert">Slider Başarıyla Eklenmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?slider">';
		
	}
	else {
		echo '<div class="alert alert-danger" role="alert">Slider Ekleme Basarısız Olmuştur</div>';
	}
}

}
?>