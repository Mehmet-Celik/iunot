<?php
	if(isset($_SESSION["id"])){
	$oturum_id=$_SESSION["id"];
	$sorgu=mysql_query("select * from tbl_mesaj where alan_id='$oturum_id'");
	echo'
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
				while($gelenkutusu=mysql_fetch_array($sorgu)){
				$atan_kisi_id=$gelenkutusu["atan_id"];
				$sorgu1=mysql_query("select * from tbl_uye where id='$atan_kisi_id'");
				$atan_kisi=mysql_fetch_array($sorgu1);
				echo'
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
						<a style="text-decoration:none;" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$gelenkutusu["id"].'" aria-expanded="false" aria-controls="'.$gelenkutusu["id"].'">
						Kimden : '.$atan_kisi["uye_isim_soyisim"].' Mesaj Başlık : '.$gelenkutusu["mesaj_baslik"].' <span style="float:right;">Tarih : ';tarihformat($gelenkutusu["mesaj_tarihi"]); echo' </span>
						</a>
						</h4>
					</div>
					<div id="'.$gelenkutusu["id"].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
						İçerik : '.$gelenkutusu["mesaj_icerik"].'
						</div>
					</div>
				</div>';
				}
				
			echo'	
			</div>
			';
	}
?>