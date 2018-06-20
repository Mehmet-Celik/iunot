<?php if(isset($_GET["bolum_ekle"])){
echo '<form id="bolum_ekle" name="bolum_ekle" method="post" action="">
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-plus"></i> Bölüm Ekle</div>
  <table class="table">
  <thead>
  <tr>
  <th>
  Fakülte Seçiniz: &nbsp 
  <select name="fakulte" id="fakulte">
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
  <th>Bölüm İsmi &nbsp <input type="text" name="txBolum" id="txBolum" required />&nbsp&nbsp<input type="submit" class="btn btn-default" name="btBolumEkle" id="btBolumEkle" value="Ekle" /></th>
  </tr>
  </thead> </table>
</div>
</form>';

if(isset($_POST["btBolumEkle"])){
	$fakulte_id=guvenlik($_POST["fakulte"]);
	$bolum_isim=guvenlik($_POST["txBolum"]);
	$sorgu=mysql_query("INSERT into tbl_bolum (fakulte_id,bolum) values ('$fakulte_id','$bolum_isim')");
	if($sorgu){
		echo '<div class="alert alert-success" role="alert">Bölüm Başarıyla Eklenmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?bolum_listele">';
		
	}
	else {
		echo '<div class="alert alert-danger" role="alert">Bölüm Ekleme Basarısız Olmuştur</div>';
	}
}

}
?>