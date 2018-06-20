<?php 
	function soru_sayfa($s) {
		if(guvenlik(isset($_GET["sayfa"]))){
		$sayfa=guvenlik($_GET["sayfa"]);
		}
		else
			$sayfa=1;
		if($sayfa == $s)
			echo "ss_active";
		else
			echo "";
	}
?>
<?php	if(guvenlik(isset($_GET["notlar"]))){
	if(guvenlik(isset($_GET["not"]))){
		include("noticerik.php");
	}
	else{
		
	
	$notlar_id=guvenlik($_GET["notlar"]);
	
		$bolum=guvenlik($_GET["dersler"]);
		$notlarsorgu=mysql_query("select * from tbl_ders where id='$notlar_id'");
		$notlarsql=mysql_fetch_array($notlarsorgu);
		$bolumsorgu=mysql_query("select * from tbl_bolum where id='$bolum'");
		$bolumsql=mysql_fetch_array($bolumsorgu);
		$fakulte_id=$bolumsql["fakulte_id"];
		$fakultesorgu=mysql_query("select * from tbl_fakulte where id='$fakulte_id'");
		$fakultesql=mysql_fetch_array($fakultesorgu);
		$donem=$notlarsql["donem_id"];
		if($donem==1 || $donem==3 || $donem==5 || $donem==7){
			
			$donem=(($donem+1)/2);
		}
		else{
			$donem=$donem/2;
		}
		
	$sorgu=mysql_query("select * from tbl_ders where bolum_id='$bolum'");
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
							<a href="/'.tr_duzelt($fakultesql["fakulte_isim"]).'/'.tr_duzelt($bolumsql["bolum"]).'/'.$bolum.'/'.$notlarsql["id"].'">'.$bolumsql["bolum"].'</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-bookmark"></i>
							<a href="/'.tr_duzelt($fakultesql["fakulte_isim"]).'/'.tr_duzelt($bolumsql["bolum"]).'/'.$bolum.'/'.$notlarsql["id"].'">'.$donem.'. Sınıf</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-book"></i>
							<a href="/'.tr_duzelt($fakultesql["fakulte_isim"]).'/'.tr_duzelt($bolumsql["bolum"]).'/'.tr_duzelt($notlarsql["ders_isim"]).'/'.$bolum.'/'.$notlarsql["id"].'">'.$notlarsql["ders_isim"].'</a>
						</li>
					</ul>
				</div>
				
				<div class="row konular">
					<div>
						<center><h3><i class="fa fa-bookmark"></i> '.$notlarsql["ders_isim"].'</h3></center>
					</div>
					<hr/>
		';
	

				$notlarsorgu=mysql_query("select * from tbl_not where ders_id='$notlar_id' and goruntulenme='1'");
				$notlarsaydir=mysql_num_rows($notlarsorgu);
				if(guvenlik(isset($_GET["sayfa"]))){
					$sayfa=guvenlik($_GET["sayfa"]);
					}
					else $sayfa=1;
				$limit2=16;
				$baslangic=($sayfa*$limit2)-$limit2;
				$notlarsorgu=mysql_query("select * from tbl_not where ders_id='$notlar_id' and goruntulenme='1' limit $baslangic,$limit2");
				if($notlarsaydir<1){
					echo '<div class="alert alert-warning" style="width:80%;margin:50px auto;text-align:center;"role="alert">Bu Dersteki Notlar Editörlerimiz Tarafından Girilme Aşamasındadır,Anlayışınız için Teşekkürler...</div>';
				}
				else{
				while($notlarsql=mysql_fetch_array($notlarsorgu)){
					echo'
					<div class="col-xs-12 col-md-3">
					<div class="note-border"></div>
				<center><a href="/'.tr_duzelt($fakultesql["fakulte_isim"]).'/'.tr_duzelt($bolumsql["bolum"]).'/'.tr_duzelt($notlarsql["not_baslik"]).'/'.$bolum.'/'.$notlar_id.'/'.$notlarsql["id"].'" class="thumbnail">
					<p><i class="fa fa-sticky-note"></i> '.$notlarsql["not_baslik"].'</p>
				<br/>
					<p><i class="fa fa-eye"></i> '.$notlarsql["hit"].' Okunma</p>
				<br/>
					<p><i class="fa fa-clock-o"></i> ';tarihformat($notlarsql["not_eklenme_tarihi"]); echo'</p>
				<br/>
				<h3><span class="turuncu">İÜ</span>.NOT <i class="fa fa-laptop turuncu"></i></h3>
					</a></center>
				</div>
				
					';
				}
				}
				
	echo'</div>';
	
	echo '<center><ul class="pagination">';
		$syf=2;
		$i=$sayfa-$syf;
		$k=$sayfa+$syf;
		$sonsayfa=ceil($notlarsaydir/$limit2);
		$onceki=$sayfa-1;
		$sonraki=$sayfa+1;
		if($sayfa > 1)
		echo '<li><a href="/index.php?dersler='.$bolum.'&notlar='.$notlar_id.'&sayfa='.$onceki.'">Önceki</a></li>';
	if($sayfa > $syf+1 && $sonsayfa > 1)
		echo '<li><a href="/index.php?dersler='.$bolum.'&notlar='.$notlar_id.'&sayfa=1">1</a></li>';
	if($sayfa > $syf+2)
		echo '<li><a style="cursor:pointer;">...</a></li>';
		for(;$i<=$k;$i++){
			if($i>0 && $i <= $sonsayfa && $sonsayfa > 1){
				echo'<li class="';
				soru_sayfa($i);
				echo'"><a href="/index.php?dersler='.$bolum.'&notlar='.$notlar_id.'&sayfa='.$i.'">'.$i.'</a></li>';
			}
		}
		if($sayfa < $syf && $sonsayfa > $syf+1)
		echo '<li><a style="cursor:pointer;">...</a></li>';
		if($sayfa < $syf+1 && $sonsayfa > $syf +1)
		echo '<li><a href="/index.php?dersler='.$bolum.'&notlar='.$notlar_id.'&sayfa='.$sonsayfa.'">'.$sonsayfa.'</a></li>';
		if($sayfa < $sonsayfa)
		echo '<li><a href="/index.php?dersler='.$bolum.'&notlar='.$notlar_id.'&sayfa='.$sonraki.'">Sonraki</a></li>';
		echo '</ul></center>';
	echo'</div>';
}
}
?>