<?php	if(guvenlik(isset($_GET["not"]))){
		$not=guvenlik($_GET["not"]);
		$notlar_id=guvenlik($_GET["notlar"]);
		$bolum=guvenlik($_GET["dersler"]);
		$notsorgu=mysql_query("select * from tbl_not where id='$not' and goruntulenme='1'");
		$notsql=mysql_fetch_array($notsorgu);
		$notlarsorgu=mysql_query("select * from tbl_ders where id='$notlar_id'");
		$notlarsql=mysql_fetch_array($notlarsorgu);
		$bolumsorgu=mysql_query("select * from tbl_bolum where id='$bolum'");
		$bolumsql=mysql_fetch_array($bolumsorgu);
		$fakulte_id=$bolumsql["fakulte_id"];
		$fakultesorgu=mysql_query("select * from tbl_fakulte where id='$fakulte_id'");
		$fakultesql=mysql_fetch_array($fakultesorgu);
		$sorgu=mysql_query("select * from tbl_ders where bolum");
		echo'
		<div class="col-md-7" style="padding-left:40px;">
			<br>
				<div class="page-bar">
					<ul class="page-breadcrumb">
						<li>
							<i class="fa fa-home"></i>
							<a href="/anasayfa">Anasayfa</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-university"></i>
							<a href="#">'.$fakultesql["fakulte_isim"].'</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-graduation-cap"></i>
							<a href="/'.tr_duzelt($fakultesql["fakulte_isim"]).'/'.tr_duzelt($bolumsql["bolum"]).'/'.$notlarsql["bolum_id"].'/'.$notlarsql["id"].'">'.$bolumsql["bolum"].'</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-book"></i>
							<a href="/'.tr_duzelt($fakultesql["fakulte_isim"]).'/'.tr_duzelt($bolumsql["bolum"]).'/'.tr_duzelt($notlarsql["ders_isim"]).'/'.$bolum.'/'.$notlarsql["id"].'">'.$notlarsql["ders_isim"].'</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-sticky-note"></i>
							<a href="/'.tr_duzelt($fakultesql["fakulte_isim"]).'/'.tr_duzelt($bolumsql["bolum"]).'/'.tr_duzelt($notsql["not_baslik"]).'/'.$bolum.'/'.$notlarsql["id"].'/'.$notsql["id"].'">'.$notsql["not_baslik"].'</a>
						</li>
					</ul>
				</div>
				
				<div class="row konular">
					<div>
						<center><h3><i class="fa fa-sticky-note"></i> '.$notsql["not_baslik"].'</h3></center>
					</div>
					<hr/>
		';
	

				$notsorgu=mysql_query("select * from tbl_not where id='$not' and goruntulenme='1'");
				$notsaydir=mysql_num_rows($notsorgu);
				if($notsaydir<1){
					echo '<div class="alert alert-warning" style="width:80%;margin:50px auto;text-align:center;"role="alert">Bu  Not Editörlerimiz Tarafından Girilme Aşamasındadır,Anlayışınız için Teşekkürler...</div>';
				}
				else{
				$notsql=mysql_fetch_array($notsorgu);
					$hit=$notsql["hit"];
					$hit=$hit+1;
					$hitguncelle=mysql_query("update tbl_not set hit='$hit' where id='$not'");
					echo'<div class="col-md-12" style="box-shadow:0px 1px 1px #444;border-radius:5px;background-color:#fff;width:98%;margin-left:10px;margin-bottom:10px;padding:20px;">
					'.$notsql["not_icerik"].'
					</div>';
				
				}
				
	echo'</div>';
		
	echo'</div>';
}
?>