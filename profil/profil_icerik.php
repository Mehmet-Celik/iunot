<?php
		if(guvenlik(isset($_GET["profil"]))){
			$oturum_id=guvenlik($_GET["profil"]);
			$sorgu=mysql_query("select * from tbl_uye where id='$oturum_id'");
			$uye_rows=mysql_num_rows($sorgu);
			if($uye_rows){
			$uye=mysql_fetch_array($sorgu);
			$uye_fakulte=$uye["fakulte_id"];
			$uye_bolum=$uye["bolum_id"];
			$sorgu1=mysql_query("select * from tbl_fakulte where id='$uye_fakulte'");
			$fakulte=mysql_fetch_array($sorgu1);
			$sorgu2=mysql_query("select * from tbl_bolum where id='$uye_bolum'");
			$bolum=mysql_fetch_array($sorgu2);
			switch ($uye["uye_yetki"]){
				case 0: $yetkim="Kullanıcı";break;
				case 1: $yetkim="Editör";break;
				case 2: $yetkim="Admin";break;
			}
			echo'
			<div class="iletisim" style="margin-top:10px;margin-bottom:10px;">
				<span>Ad Soyad : '.$uye["uye_isim_soyisim"].'</span>
				<hr/>
				<span>Faküte : '.$fakulte["fakulte_isim"].'</span>
				<hr/>
				<span>Bölüm : '.$bolum["bolum"].'</span>
				<hr/>
				<span>E Mail : '.$uye["uye_email"].'</span>
				<hr/>
				<span>Üye Olma Tarihiniz : '; tarihformat($uye["uye_eklenme_tarihi"]); echo'</span>
				<hr/>
				<span>Yetkiniz : '.$yetkim.'</span>
				<hr/>
				<span>Açıklama : '.$uye["uye_aciklama"].'</span>
			</div>
			';
			}
			else{
				echo '<div class="alert alert-danger" role="alert">Böyle Bir Profil Bulunamamıştır.</div>';
				echo '<meta http-equiv="refresh" content="1;URL=index.php">';
			}
			
		}
		
	
	
?>
