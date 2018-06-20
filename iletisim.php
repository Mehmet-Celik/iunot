<?php
echo'
	<div class="col-md-7">
		<div style="margin-left:20px;" class="row">
		<center><div class="iletisim_title"><h1><i class="fa fa-envelope"></i> İletişim</h1></div></center>
		<br/>
		<div class="iletisim">
            <center><div>
                Aşağıdaki formu doldurarak mesajınızı bize ulaştırabilirsiniz.
                <br>
                Dilerseniz <a href="mailto:info@iunot.com">
                <strong>info@iunot.com</strong></a> e-posta adresinden de ulaşabilirsiniz.
            </div></center>
			<br/>
			<hr/>
                <form id="iletisimform" method="POST" action="" accept-charset="UTF-8">
				<div class="col-md-4">
                    <input class="form-control" placeholder="Adınız, Soyadınız" required="required" name="txAdSoyad" id="txAdSoyad" type="text">
                </div>
                <div class="col-md-4">
                    <input class="form-control" placeholder="Fakülte Giriniz" name="txFakulte" id="txFakulte" type="text" required>
                </div>
				<div class="col-md-4">
                    <input class="form-control" placeholder="Bölüm Giriniz" name="txBolum" id="txBolum" type="text" required>
                </div>
				<br/>
				<br/>
				<hr/>
				<div class="col-md-4">
                    <input class="form-control" placeholder="E-posta adresiniz" required="required" name="txEmail" id="txEmail" type="email">

                </div>
                <div class="col-md-4">
                    <input class="form-control" placeholder="Konu belirtiniz" required="required" name="txKonu" id="txKonu" type="text">
                </div>
                <div class="col-md-4">
                    <textarea class="form-control" placeholder="Mesajınızı yazın" style="height:150px;resize:none;" cols="599" required="required" name="txMesaj" id="txMesaj" rows="10"></textarea>

                </div>
                <div style="margin-left:10px;">
                    <button type="submit" class="btn btn-default" name="btGonder" id="btGonder">Gönder</button>
                </div>
				<hr/>
                </form>
	</div>
	';
	if(isset($_POST["btGonder"])){
		$adsoyad=guvenlik($_POST["txAdSoyad"]);
		$fakulte=guvenlik($_POST["txFakulte"]);
		$bolum=guvenlik($_POST["txBolum"]);
		$email=guvenlik($_POST["txEmail"]);
		$konu=guvenlik($_POST["txKonu"]);
		$mesaj=guvenlik($_POST["txMesaj"]);
		$sorguiletisim=mysql_query("insert into tbl_iletisim (msjAdSoyad,msjFakulte,msjBolum,msjEposta,msjKonu,msjMesaj) values('$adsoyad','$fakulte','$bolum','$email','$konu','$mesaj')");
		if($sorguiletisim){
			echo '<div class="alert alert-success" role="alert">Mesajınız Başarıyla İletilmiştir.</div>';
			echo '<meta http-equiv="refresh" content="1;URL=index.php">';
			}
			else{
			echo '<div class="alert alert-danger" role="alert">Mesajınız Gönderilirken Hata Oluştu ! </div>';	
			}
		
	}
echo'	</div>
		</div>';
	?>