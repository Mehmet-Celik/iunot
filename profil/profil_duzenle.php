<?php
		if(guvenlik(isset($_GET["profil"])) && guvenlik($_GET["profil"])==$_SESSION["id"]){
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
			$uye_isim=$uye["uye_isim_soyisim"];
			$fakulte_isim=$fakulte["fakulte_isim"];
			echo'
			<form id="uye_guncelle" name="uye_guncelle" method="post" action="">
			<div class="iletisim" style="margin-top:10px;margin-bottom:10px;">
				<div style="float:left;margin-top:5px;">Ad Soyad :</div> <div style="float:left;margin-left:10px;"><input style="width:300px;" class="form-control" value="'.$uye_isim.'" required="required" name="txAdsoyad" id="txAdsoyad" type="text"></div>
				<br>
				<hr/>
				Fakülte : 
				  <select name="fakulte" id="fakulte" onChange="uye_fakultesec()">';
				  
				  $sorgu=mysql_query("SELECT * FROM tbl_fakulte order by id");
				while($sorgusql=mysql_fetch_array($sorgu)){
					echo'<option value="'.$sorgusql["id"].'">'.$sorgusql["fakulte_isim"].'</option>';
				}
				
				echo'
				</select>
				<br>
				<hr/>
				<div style="float:left;">Bölüm : </div>
				<div style="float:left;margin-left:8px;"class="uye_option"></div>
				<br>
				<hr/>
				<div style="float:left;margin-top:5px;">E Mail :</div> <div style="float:left;margin-left:30px;"><input style="width:300px;" class="form-control" value="'.$uye["uye_email"].'" required="required" name="txEmail" id="txEmail" type="email"></div>
				<br>
				<hr/>
				Açıklama : <textarea class="form-control" style="height:150px;resize:none;" cols="699" required="required" name="txAciklama" id="txAciklama" rows="10">'.$uye["uye_aciklama"].'</textarea>
				<br>
				<br>
				<input class="btn btn-default" type="submit" name="btUyeGuncelle" id="btUyeGuncelle" value="Güncelle" />
		</div>
		</form>
			';
						if(isset($_POST["btUyeGuncelle"])){
							$isimsoyisim=guvenlik($_POST["txAdsoyad"]);
							$fakulte_id=guvenlik($_POST["fakulte"]);
							$bolum_id=guvenlik($_POST["bolum"]);
							$email=guvenlik($_POST["txEmail"]);
							$aciklama=guvenlik($_POST["txAciklama"]);
							$uyeguncelle=mysql_query("UPDATE tbl_uye SET uye_isim_soyisim='$isimsoyisim',fakulte_id='$fakulte_id',bolum_id='$bolum_id',uye_email='$email',uye_aciklama='$aciklama' WHERE id='$oturum_id'");
							
						}
						if($uyeguncelle){
							echo '<div class="alert alert-success" role="alert">Üye Başarıyla Güncellenmiştir.</div>';
							echo '<meta http-equiv="refresh" content="0;URL=index.php?profil='.$oturum_id.'">';
							}
						
						
				
			}
			else{
				echo '<div class="alert alert-danger" role="alert">Böyle Bir Profil Bulunamamıştır.</div>';
				echo '<meta http-equiv="refresh" content="1;URL=index.php">';
			}
			
		}
		
	
	
	
?>
