<?php
	if(isset($_SESSION["id"]) && guvenlik(isset($_GET["profil"]))){
		echo'
		<form method="POST" action="" accept-charset="UTF-8">
				<br/>
                <div style="max-width:500px;">
                    <input class="form-control" placeholder="Konu belirtiniz..." required="required" name="txKonu" id="txKonu" type="text">
                </div>
				<br/>
                <div>
                    <textarea class="form-control" placeholder="Mesajınızı yazın..." style="height:150px;resize:none;" cols="699" required="required" name="txIcerik" id="txIcerik" rows="10"></textarea>
                </div>
				<br/>
                <div style="margin-left:10px;">
                    <button type="submit" class="btn btn-default" name="btGonder" id="btGonder">Gönder</button>
                </div>
        </form>
		';
			if(isset($_POST["btGonder"])){
			$profil_id=guvenlik($_GET["profil"]);	
			$oturum_id=guvenlik($_SESSION["id"]);
			$kisi=mysql_query("select * from tbl_uye where id='$profil_id'");
			$alankisi_id=mysql_fetch_array($kisi)["id"];
			if(mysql_num_rows($kisi)){
				$konu=guvenlik($_POST["txKonu"]);
				$icerik=guvenlik($_POST["txIcerik"]);
				$sorgu=mysql_query("INSERT into tbl_mesaj (alan_id,atan_id,mesaj_baslik,mesaj_icerik) values ('$alankisi_id','$oturum_id','$konu','$icerik')");

				if($sorgu){
					echo '<div class="alert alert-success" role="alert">Mesajınız Başarıyla Gönderilmiştir...</div>';
					echo '<meta http-equiv="refresh" content="2;URL=index.php?profil='.$profil_id.'">';
				
				}
				else {
					echo '<div class="alert alert-danger" role="alert">Mesajınız Gönderilemedi!</div>';
				}
			}
			
		  }
		
	}
?>