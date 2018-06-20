<?php
 if(isset($_GET["soru"])){
	 $soru_id=guvenlik($_GET["soru"]);
	$sorgu=mysql_query("SELECT * FROM tbl_cevap where soru_id='$soru_id' order by id desc");
	echo '<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-list-ul"></i> Cevap Listele</div>
  <table class="table">
  <thead>
  <tr>
  <th>Cevap İd</th>
  <th>Cevaplayan Kişi</th>
  <th>Cevap</th>
  <th>Görüntülenme</th>
  <th>Sil</th> 
  </tr>
  </thead>
  <tbody>';
  while($cevap_listele=mysql_fetch_array($sorgu)){
	  $goster=$cevap_listele["goruntulenme"];
	  $cevap_id=$cevap_listele["id"];
	  if($goster==0){
		  $goruntuleme='<a href="adminpanel.php?soru_cevap&soru='.$cevap_listele["soru_id"].'&cevap_goruntule='.$cevap_listele["id"].'"><i class="fa fa-eye-slash"></i> Yayınlanmıyor</a>';
	  }
	  else{
		  $goruntuleme='<a href="adminpanel.php?soru_cevap&soru='.$cevap_listele["soru_id"].'&cevap_goruntule='.$cevap_listele["id"].'"><i class="fa fa-eye"></i> Yayınlanıyor</a>';
	  }
	  $cevaplayan_id=$cevap_listele["cevaplayan_id"];
	  $kisisorgu=mysql_query("select * from tbl_uye where id='$cevaplayan_id'");
	echo ' <tr>
  <th scope="row">'.$cevap_listele["id"].'</th>
  <td>'.mysql_fetch_array($kisisorgu)["uye_isim_soyisim"].'</td>
  <td>'.$cevap_listele["cevap"].'</td>
  <td>'.$goruntuleme.'</td>
  <td><a href="adminpanel.php?soru_cevap&soru='.$cevap_listele["soru_id"].'&cevap_sil='.$cevap_listele["id"].'"><i class="fa fa-times"></i></a></td> 
  </tr>';
	
		
  }
  if(guvenlik(isset($_GET["cevap_goruntule"]))){
		 $cevap=guvenlik($_GET["cevap_goruntule"]);
		$sorgu=mysql_query("select * from tbl_cevap where id='$cevap'");
		$sorgucevap=mysql_fetch_array($sorgu);
		$goster=$sorgucevap["goruntulenme"];
		if($goster==0){
			$gosteriguncelle=mysql_query("UPDATE tbl_cevap SET goruntulenme='1' where id='$cevap'");
		}
		else{
			$gosteriguncelle=mysql_query("UPDATE tbl_cevap SET goruntulenme='0' where id='$cevap'");
		}
		if($gosteriguncelle){
			echo '<meta http-equiv="refresh" content="0;URL=adminpanel.php?soru_cevap&soru='.$sorgucevap["soru_id"].'">';
		}
		else{
			echo '<div class="alert alert-danger" role="alert">Görüntüleme Hatası ! </div>';
		}
	}
  if(guvenlik(isset($_GET["cevap_sil"]))){
	$silinen_cevap_id=guvenlik($_GET["cevap_sil"]);
	$sorgu=mysql_query("select * from tbl_cevap where id='$silinen_cevap_id'");
	$sorgucevap=mysql_fetch_array($sorgu);
	$cevap_sil=mysql_query("DELETE FROM tbl_cevap WHERE id='$silinen_cevap_id'");
	if($cevap_sil){
		echo '<div class="alert alert-success" role="alert">Cevap Başarıyla Silinmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?soru_cevap&soru='.$sorgucevap["soru_id"].'">';
	}
	if(!$cevap_sil && guvenlik(!isset($_GET["cevap_sil"]))) {
		echo '<div class="alert alert-danger" role="alert">Cevap Silme Basarısız Olmuştur</div>';
	}	
}
	
  echo '</tbody> </table>
</div>';
}
else if(guvenlik(isset($_GET["soru_cevap"]))){
	$sorgu=mysql_query("SELECT * FROM tbl_soru order by id desc");
	echo '<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-list-ul"></i> Soru Listele</div>
  <table class="table">
  <thead>
  <tr>
  <th>Soru İd</th>
  <th>Soran Kişi</th>
  <th>Soru Başlığı</th>
  <th>Soru İçerik</th>
  <th>Cevaplar</th>
  <th>Görüntülenme</th>
  <th>Sil</th> 
  </tr>
  </thead>
  <tbody>';
  while($soru_listele=mysql_fetch_array($sorgu)){
	  $goster=$soru_listele["goruntulenme"];
	  $soru_id=$soru_listele["id"];
	  if($goster==0){
		  $goruntuleme='<a href="adminpanel.php?soru_cevap&soru_goruntule='.$soru_listele["id"].'"><i class="fa fa-eye-slash"></i> Yayınlanmıyor</a>';
	  }
	  else{
		  $goruntuleme='<a href="adminpanel.php?soru_cevap&soru_goruntule='.$soru_listele["id"].'"><i class="fa fa-eye"></i> Yayınlanıyor</a>';
	  }
	  $soran_id=$soru_listele["soran_id"];
	  $kisisorgu=mysql_query("select * from tbl_uye where id='$soran_id'");
	echo ' <tr>
  <th scope="row">'.$soru_listele["id"].'</th>
  <td>'.mysql_fetch_array($kisisorgu)["uye_isim_soyisim"].'</td>
  <td>'.$soru_listele["soru_baslik"].'</td>
  <td>'.$soru_listele["soru"].'</td>
  <td><a style="margin-left:20px;" href="adminpanel.php?soru_cevap&soru='.$soru_listele["id"].'"><i class="fa fa-comments"></i></a></td>
  <td>'.$goruntuleme.'</td>
  <td><a href="adminpanel.php?soru_cevap&soru_sil='.$soru_listele["id"].'"><i class="fa fa-times"></i></a></td> 
  </tr>';
	
		
  }
  if(guvenlik(isset($_GET["soru_goruntule"]))){
		 $soru=guvenlik($_GET["soru_goruntule"]);
		$sorgu=mysql_query("select * from tbl_soru where id='$soru'");
		$sorgusoru=mysql_fetch_array($sorgu);
		$goster=$sorgusoru["goruntulenme"];
		if($goster==0){
			$gosteriguncelle=mysql_query("UPDATE tbl_soru SET goruntulenme='1' where id='$soru'");
		}
		else{
			$gosteriguncelle=mysql_query("UPDATE tbl_soru SET goruntulenme='0' where id='$soru'");
		}
		if($gosteriguncelle){
			echo '<meta http-equiv="refresh" content="0;URL=adminpanel.php?soru_cevap">';
		}
		else{
			echo '<div class="alert alert-danger" role="alert">Görüntüleme Hatası ! </div>';
		}
	}
  if(guvenlik(isset($_GET["soru_sil"]))){
	$silinen_soru_id=guvenlik($_GET["soru_sil"]);
	$soru_sil=mysql_query("DELETE FROM tbl_soru WHERE id='$silinen_soru_id'");
	$cevap_sil=mysql_query("DELETE FROM tbl_cevap WHERE soru_id='$silinen_soru_id'");
	if($soru_sil){
		echo '<div class="alert alert-success" role="alert">Soru Başarıyla Silinmiştir.</div>';
		echo '<meta http-equiv="refresh" content="1;URL=adminpanel.php?soru_cevap">';
	}
	if(!$soru_sil && guvenlik(!isset($_GET["soru_sil"]))) {
		echo '<div class="alert alert-danger" role="alert">Soru Silme Basarısız Olmuştur</div>';
	}	
}
	
  echo '</tbody> </table>
</div>';

}

 ?>
 
	
		