<?php

if(isset($_GET["uyeler"])){
	$sorgu=mysql_query("SELECT * FROM tbl_uye order by id");
	echo '<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-list-ul"></i> Üye Listele</div>
  <table class="table">
  <thead>
  <tr>
  <th>Üye İd</th>
  <th>Üye İsim Soyisim</th>
  <th>Üye Email</th>
  <th>Fakülte</th>
  <th>Bölüm</th>
  <th>Yetki</th>
  <th></th>
  <th>Profile Git</th>   
  <th>Sil</th> 
  </tr>
  </thead>
  <tbody>';
  while($uye_listele=mysql_fetch_array($sorgu)){
	  
	  $fakulteid=$uye_listele["fakulte_id"];
	  $sorgu1=mysql_query("SELECT * FROM tbl_fakulte WHERE id='$fakulteid'");
	  $fakulteisim=mysql_fetch_array($sorgu1);
	  
	  $bolumid=$uye_listele["bolum_id"];
	  $sorgu2=mysql_query("SELECT * FROM tbl_bolum WHERE id='$bolumid'");
	  $bolumisim=mysql_fetch_array($sorgu2);
	  
	 switch ($uye_listele["uye_yetki"]){
				case 0: $yetki="Kullanıcı";break;
				case 1: $yetki="Editör";break;
				case 2: $yetki="Admin";break;
			} 
	echo ' <tr>
	<th scope="row">'.$uye_listele["id"].'</th>
  <td>'.$uye_listele["uye_isim_soyisim"].'</td>
  <td>'. $uye_listele["uye_email"].'</td>
  <td>'. $fakulteisim["fakulte_isim"].'</td>
  <td>'. $bolumisim["bolum"].'</td>
  <td>'.$yetki.' </td>
  <td><a href="adminpanel.php?uyeler&yetki='.$uye_listele["id"].'"><i class="fa fa-pencil-square-o"></i></a></td>
  <td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a href="../index.php?profil='.$uye_listele["id"].'"><i class="fa fa-user"></i></a></td> 
  <td><a href="adminpanel.php?uyeler&uye_sil='.$uye_listele["id"].'"><i class="fa fa-times"></a></i></td> 
  </tr>';
		
  }
  if(guvenlik(isset($_GET["uye_sil"]))){
	$silinen_uye_id=guvenlik($_GET["uye_sil"]);
	$uye_sil=mysql_query("DELETE FROM tbl_uye WHERE id='$silinen_uye_id'");
	if($uye_sil){
		echo '<div class="alert alert-success" role="alert">Üye Başarıyla Silinmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?uyeler">';
	}
	if(!$uye_sil && guvenlik(!isset($_GET["uye_sil"]))) {
		echo '<div class="alert alert-danger" role="alert">Üye Silme Basarısız Olmuştur</div>';
	}	
}
	if(guvenlik(isset($_GET["yetki"]))){
		$id=guvenlik($_GET["yetki"]);
		$sorgu=mysql_query("SELECT * FROM tbl_uye where id='$id'");
		echo'
		<tr>
		<td colspan="9">
		<form id="yetki" name="yetki" method="post" action="">
		'.mysql_fetch_array($sorgu)["uye_isim_soyisim"].' <i class="fa fa-arrow-right"></i> 
		Yetkiyi Seçiniz : 
		<select name="uyeyetki" id="uyeyetki">
		';
		$uye_id=$uye_listele["id"];
		echo'
		<option value="0">Kullanıcı</option>
		<option value="1">Editör</option>
		<option value="2">Admin</option>
		</select> &nbsp;
		<input type="submit" id="btYetkiGuncelle" name="btYetkiGuncelle" value="Seç" class="btn btn-default">
		</form>
		</td>
		</tr>
	';
	if(isset($_POST["btYetkiGuncelle"])){
		$uye_id=guvenlik($_GET["yetki"]);
		$uye_yetkisi=guvenlik($_POST["uyeyetki"]);
		$yetkiguncelle=mysql_query("UPDATE tbl_uye SET uye_yetki='$uye_yetkisi' WHERE id='$uye_id'");
		if($yetkiguncelle){
		echo '<div class="alert alert-success" role="alert">Yetki Güncellendi.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?uyeler">';
		}
		if(!$yetkiguncelle && guvenlik(!isset($_GET["yetki"]))) {
		echo '<div class="alert alert-danger" role="alert">Yetki Güncelleme Başarısız!</div>';
		}
	}
		
	}	

  
  
  echo '</tbody> </table>
</div>';

}

 ?>
 
	
		