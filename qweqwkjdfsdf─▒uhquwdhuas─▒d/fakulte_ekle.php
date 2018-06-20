<?php if(guvenlik(isset($_GET["fakulte_ekle"]))){
echo '<form id="fakulte_ekle" name="fakulte_ekle" method="post" action="">
<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-plus"></i> Fakülte Ekle</div>
  <table class="table">
  <thead>
  <tr>
  <th>Fakülte İsim &nbsp <input type="text" name="txFakulte" id="txFakulte" required />&nbsp&nbsp<input type="submit" class="btn btn-default" name="btFakulteEkle" id="btFakulteEkle" value="Ekle" /></th>
  </tr>
  </thead> </table>
</div>
</form>';

if(isset($_POST["btFakulteEkle"])){
	$fakulte_isim=guvenlik($_POST["txFakulte"]);
	$sorgu=mysql_query("INSERT into tbl_fakulte (fakulte_isim) values ('$fakulte_isim')");

	if($sorgu){
		echo '<div class="alert alert-success" role="alert">Fakülte Başarıyla Eklenmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?fakulte_listele">';
		
	}
	else {
		echo '<div class="alert alert-danger" role="alert">Fakülte Ekleme Basarısız Olmuştur</div>';
	}
}

}
?>