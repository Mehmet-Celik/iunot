<?php
	if(isset($_SESSION["id"])){
	$oturum_id=$_SESSION["id"];
	$sorgu=mysql_query("select * from tbl_mesaj where atan_id='$oturum_id'");
	echo'
			<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';
				while($gidenkutusu=mysql_fetch_array($sorgu)){
				$alan_kisi_id=$gidenkutusu["alan_id"];
				$sorgu1=mysql_query("select * from tbl_uye where id='$alan_kisi_id'");
				$alan_kisi=mysql_fetch_array($sorgu1);
				echo'
				<div class="panel panel-default">
					<div class="panel-heading" role="tab" id="headingOne">
						<h4 class="panel-title">
						<a style="text-decoration:none;" role="button" data-toggle="collapse" data-parent="#accordion" href="#'.$gidenkutusu["id"].'" aria-expanded="false" aria-controls="'.$gidenkutusu["id"].'">
						Kime : '.$alan_kisi["uye_isim_soyisim"].' Mesaj Başlık : '.$gidenkutusu["mesaj_baslik"].' <span style="float:right;">Tarih : ';tarihformat($gidenkutusu["mesaj_tarihi"]); echo' </span>
						</a>
						</h4>
					</div>
					<div id="'.$gidenkutusu["id"].'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
						<div class="panel-body">
						İçerik : '.$gidenkutusu["mesaj_icerik"].'
						</div>
					</div>
				</div>';
				}
				
			echo'	
			</div>
			';
	}
?>