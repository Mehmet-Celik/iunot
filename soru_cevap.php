<?php 
	function soru_sayfa($s) {
		if(isset($_GET["sayfa"])){
		$sayfa=$_GET["sayfa"];
		}
		else
			$sayfa=1;
		if($sayfa == $s)
			echo "ss_active";
		else
			echo "";
	}
?>
<?php

echo'
	<div class="col-md-7">
		<div style="border:1px solid #c0c0c0;border-radius:5px;font-family: \'Roboto\', sans-serif;color:#444444;padding:20px;">
			<h3><i class="fa fa-comment"></i> Soru / Cevap</h3>
			<hr/>
			<p>Ders calışmaktan daha cok zorlandığımız bir nokta var ki o da kafamıza takılan sorular.
			Bu soru işaretlerini temizleyebilmek için sana yardımcı olmaya hazırız.
			Aradığın her soruya burada kolayca cevap bulabilirsin.</p>
		';
		if(isset($_SESSION["id"])){
				
				if(guvenlik(isset($_GET["sor"]))){
				echo '<form id="sor" name="sor" method="post" action="">
						
						  <h4 style="margin-left:10px;"><i class="fa fa-pencil"></i> Soru Ekle</h4>
						  <table >
						  <thead>
						  <br/>
						  <tr>
						  <td>
						  <input type="text" id="txSoruBaslik" name="txSoruBaslik" placeholder="Soru Başlığını Giriniz..." required class="form-control" />
						  </td>
						  </tr>
						  <tr><td><br/></td></tr>
						  <tr>
						  <td><textarea style="resize:none;" class="form-control" placeholder="Sorunuzu yazınız..." id="txSoru" name="txSoru" style="height:150px" cols="599" required="required" name="content" rows="10"></textarea><br/><input type="submit" class="btn btn-default" style="float:right;border:1px solid #c0c0c0;border-radius:5px;padding:10px;background-color:#444444;color:#fff;" name="btSor" id="btSor" value="Sor" /></td>
						  </tr>
						  </thead> </table>
						
					 </form>';
				if($_POST["btSor"]){
					$soru_atan_id=$_SESSION["id"];
					$soru_baslik=guvenlik($_POST["txSoruBaslik"]);
					$soru=guvenlik($_POST["txSoru"]);
					$sorusorgu=mysql_query("INSERT into tbl_soru (soran_id,soru_baslik,soru) values ('$soru_atan_id','$soru_baslik','$soru')");
					if($sorusorgu){
						echo '<div class="alert alert-success" role="alert">Sorunuz Başarıyla Yöneticiye Ulaşmıştır , Denetimden Geçerek Yayınlanacaktır.</div>';
						echo '<meta http-equiv="refresh" content="2;URL=index.php?soru_cevap">';
					}
					else{
						echo '<div class="alert alert-danger" role="alert">Sorunuz Eklenemedi !</div>';
					}
				}
				
			}else{
				echo'<div style="float:right;border:1px solid #c0c0c0;border-radius:5px;padding:10px;background-color:#444444;"><a style="text-decoration:none;color:#fff;" href="/index.php?soru_cevap&sor"><i class="fa fa-pencil"></i> Haydi Sen de Sor !</a></div>';
				echo'
				<br/>
				<br/>';
				
			}
			}
			else{
				echo '<div class="alert alert-danger" role="alert">Soru Sormak için Lütfen Giriş Yapınız..</div>';
			}
		echo'
		</div>
		';
	if(guvenlik(isset($_GET["soru"]))){
		$soru_id=guvenlik($_GET["soru"]);
		$sorgu=mysql_query("select * from tbl_soru  where id='$soru_id' and goruntulenme='1'");
		if(mysql_num_rows($sorgu)){
			$sorular=mysql_fetch_array($sorgu);
		$hitsayisi=$sorular["hit"];
		$hitsayisi++;
		$fakulteguncelle=mysql_query("UPDATE tbl_soru SET hit='$hitsayisi' WHERE id='$soru_id'");
		$sorankisi_id=$sorular["soran_id"];
		$sorgu1=mysql_query("select * from tbl_uye where id='$sorankisi_id'");
		$kisi=mysql_fetch_array($sorgu1);
		
		$fakulteid=$kisi["fakulte_id"];
		$sorgu2=mysql_query("SELECT * FROM tbl_fakulte WHERE id='$fakulteid'");
		$fakulteisim=mysql_fetch_array($sorgu2);
	  
		$bolumid=$kisi["bolum_id"];
		$sorgu3=mysql_query("SELECT * FROM tbl_bolum WHERE id='$bolumid'");
		$bolumisim=mysql_fetch_array($sorgu3);
		echo'
		<br/>
		<div style="border:1px solid #c0c0c0;border-radius:5px;font-family: \'Roboto\', sans-serif;color:#444444;padding:20px;">
			<h3><i class="fa fa-question"></i> '.$sorular["soru_baslik"].'</h3>
			<h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="/index.php?profil='.$kisi["id"].'"><kbd><i class="fa fa-user"></i> '.$kisi["uye_isim_soyisim"].' / <i class="fa fa-university"></i> '.$fakulteisim["fakulte_isim"].' / <i class="fa fa-graduation-cap"></i> '.$bolumisim["bolum"].' / <i class="fa fa-eye"></i> '.$sorular["hit"].' / <i class="fa fa-clock-o"></i> ';tarihformat($sorular["soru_tarihi"]);echo'</kbd></a></h6>
		
			<hr>
			<span style="margin-left:10px;"><i class="fa fa-arrow-right"></i> '.$sorular["soru"].'</span>
			<hr>
			<h3><i class="fa fa-comments"></i> Yorumlar</h3>
			<hr/>
			';
			if(guvenlik(isset($_GET["sayfa"]))){
		$sayfa=guvenlik($_GET["sayfa"]);
		}
		else {
			$sayfa=1;
		}
			$cevapsorgu=mysql_query("select * from tbl_cevap where soru_id='$soru_id' and goruntulenme='1'");
			$cevap_sayisi=mysql_num_rows($cevapsorgu);
			$limit2=8;
			$baslangic=($sayfa*$limit2)-$limit2;
			$cevapsorgu=mysql_query("select * from tbl_cevap where soru_id='$soru_id' and goruntulenme='1' limit $baslangic,$limit2");
			while($cevaplar=mysql_fetch_array($cevapsorgu)){
				$cevap_id=guvenlik($_GET["soru"]);
				
				$cevaplayan_id=$cevaplar["cevaplayan_id"];
				$sorgu1=mysql_query("select * from tbl_uye where id='$cevaplayan_id'");
				$kisi=mysql_fetch_array($sorgu1);
				
				$fakulteid=$kisi["fakulte_id"];
				$sorgu2=mysql_query("SELECT * FROM tbl_fakulte WHERE id='$fakulteid'");
				$fakulteisim=mysql_fetch_array($sorgu2);
			  
				$bolumid=$kisi["bolum_id"];
				$sorgu3=mysql_query("SELECT * FROM tbl_bolum WHERE id='$bolumid'");
				$bolumisim=mysql_fetch_array($sorgu3);
				
				echo'
				<span><i class="fa fa-comments-o"></i> '.$cevaplar["cevap"].'</span>
				<br/>
				<h6 style="float:right;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="/index.php?profil='.$kisi["id"].'"><kbd><i class="fa fa-user"></i> '.$kisi["uye_isim_soyisim"].' / <i class="fa fa-university"></i> '.$fakulteisim["fakulte_isim"].' / <i class="fa fa-graduation-cap"></i> '.$bolumisim["bolum"].' / <i class="fa fa-clock-o"></i> ';tarihformat($cevaplar["cevap_tarihi"]);echo'</kbd></a></h6>
				<br/>
				<hr>';
				
			}
			echo '<center><ul class="pagination">';
		$syf=2;
		$i=$sayfa-$syf;
		$k=$sayfa+$syf;
		$sonsayfa=ceil($cevap_sayisi/$limit2);
		$onceki=$sayfa-1;
		$sonraki=$sayfa+1;
		if($sayfa > 1)
		echo '<li><a href="/index.php?soru_cevap&soru='.$cevap_id.'&sayfa='.$onceki.'">Önceki</a></li>';
	if($sayfa > $syf+1 && $sonsayfa > 1)
		echo '<li><a href="/index.php?soru_cevap&soru='.$cevap_id.'&sayfa=1">1</a></li>';
	if($sayfa > $syf+2)
		echo '<li><a style="cursor:pointer;">...</a></li>';
		for(;$i<=$k;$i++){
			if($i>0 && $i <= $sonsayfa && $sonsayfa > 1){
				echo'<li class="';
				soru_sayfa($i);
				echo'"><a href="/index.php?soru_cevap&soru='.$cevap_id.'&sayfa='.$i.'">'.$i.'</a></li>';
			}
		}
		if($sayfa < $syf && $sonsayfa > $syf+1)
		echo '<li><a style="cursor:pointer;">...</a></li>';
		if($sayfa < $syf+1 && $sonsayfa > $syf +1)
		echo '<li><a href="/index.php?soru_cevap&soru='.$cevap_id.'&sayfa='.$sonsayfa.'">'.$sonsayfa.'</a></li>';
		if($sayfa < $sonsayfa)
		echo '<li><a href="/index.php?soru_cevap&soru='.$cevap_id.'&sayfa='.$sonraki.'">Sonraki</a></li>';
		echo '</ul></center>';
			
			if(isset($_SESSION["id"])){
				if(guvenlik(isset($_GET["cevapla"]))){
				echo '<form id="cevap_ekle" name="cevap_ekle" method="post" action="">
						
						  <h4 style="margin-left:10px;"><i class="fa fa-pencil"></i> Cevap Yaz</h4>
						  <table class="table">
						  <thead>
						  <tr>
						  <th><textarea style="resize:none;" class="form-control" placeholder="Cevabınızı yazınız..." id="txCevap" name="txCevap" style="height:150px" cols="599" required="required" name="content" rows="10"></textarea><br/><input type="submit" class="btn btn-default" style="float:right;border:1px solid #c0c0c0;border-radius:5px;padding:10px;background-color:#444444;color:#fff;" name="btCevapla" id="btCevapla" value="Cevapla" /></th>
						  </tr>
						  </thead> </table>
						
					 </form>';
				if($_POST["btCevapla"]){
					$cevap_atan_id=$_SESSION["id"];
					$soru_id=guvenlik($_GET["soru"]);
					$cevap=guvenlik($_POST["txCevap"]);
					$cevapsorgu=mysql_query("INSERT into tbl_cevap (soru_id,cevaplayan_id,cevap) values ('$soru_id','$cevap_atan_id','$cevap')");
					if($cevapsorgu){
						echo '<div class="alert alert-success" role="alert">Cevabınız Başarıyla Eklendi!</div>';
						echo '<meta http-equiv="refresh" content="2;URL=index.php?soru_cevap&soru='.$soru_id.'">';
					}
					else{
						echo '<div class="alert alert-danger" role="alert">Cevabınız Eklenemedi !</div>';
					}
				}
				
			}else{
				echo'<div style="float:right;border:1px solid #c0c0c0;border-radius:5px;padding:10px;background-color:#444444;"><a style="text-decoration:none;color:#fff;" href="/index.php?soru_cevap&soru='.$sorular["id"].'&cevapla"><i class="fa fa-pencil"></i> Cevapla</a></div>';
				echo'
				<br/>
				<br/>';
				
			}
				
			}
			else{
				echo '<div class="alert alert-danger" role="alert">Cevaplamak için Lütfen Giriş Yapınız..</div>';
			}
			
			
			echo'
			
		</div>';
		
	
			
		}
		else{
			echo '<br><div class="alert alert-danger" role="alert">Böyle Bir Soru Bulunamamıştır !</div>';
		}
		}
	else{
		if(guvenlik(isset($_GET["sayfa"]))){
		$sayfa=guvenlik($_GET["sayfa"]);
		}
		else {
			$sayfa=1;
		}
		$limit=6;
		$sorgu=mysql_query("select * from tbl_soru where goruntulenme='1'");
		$soru_sayi=mysql_num_rows($sorgu);
		$baslangic=($sayfa*$limit)-$limit;
		$bitis=$baslangic+$limit;
		$sorgu=mysql_query("select * from tbl_soru where goruntulenme='1' order by id desc limit $baslangic,$limit");
		while($sorular=mysql_fetch_array($sorgu)){
		
		$sorankisi_id=$sorular["soran_id"];
		$sorgu1=mysql_query("select * from tbl_uye where id='$sorankisi_id'");
		$kisi=mysql_fetch_array($sorgu1);
		
		$fakulteid=$kisi["fakulte_id"];
		$sorgu2=mysql_query("SELECT * FROM tbl_fakulte WHERE id='$fakulteid'");
		$fakulteisim=mysql_fetch_array($sorgu2);
	  
		$bolumid=$kisi["bolum_id"];
		$sorgu3=mysql_query("SELECT * FROM tbl_bolum WHERE id='$bolumid'");
		$bolumisim=mysql_fetch_array($sorgu3);
		echo'
		<br/>
		<div style="border:1px solid #c0c0c0;border-radius:5px;font-family: \'Roboto\', sans-serif;color:#444444;padding:20px;">
			<h3><i class="fa fa-question"></i> '.$sorular["soru_baslik"].'</h3>
			<h6>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="/index.php?profil='.$kisi["id"].'"><kbd><i class="fa fa-user"></i> '.$kisi["uye_isim_soyisim"].' / <i class="fa fa-university"></i> '.$fakulteisim["fakulte_isim"].' / <i class="fa fa-graduation-cap"></i> '.$bolumisim["bolum"].' / <i class="fa fa-eye"></i> '.$sorular["hit"].' / <i class="fa fa-clock-o"></i> ';tarihformat($sorular["soru_tarihi"]);echo'</kbd></a></h6>
			<hr/>
			<span><i class="fa fa-arrow-right"></i> '.$sorular["soru"].'</span>
			<br/>
			<div style="float:right;border:1px solid #c0c0c0;border-radius:5px;padding:10px;background-color:#444444;"><a style="text-decoration:none;color:#fff;" href="/index.php?soru_cevap&soru='.$sorular["id"].'"><i class="fa fa-sign-in"></i> Cevapları Gör</a></div>
			<br/>
			<br/>
		</div>';
		
		}
		echo '<center><ul class="pagination">';
		$syf=2;
		$i=$sayfa-$syf;
		$k=$sayfa+$syf;
		$sonsayfa=ceil($soru_sayi/$limit);
		$onceki=$sayfa-1;
		$sonraki=$sayfa+1;
		if($sayfa > 1)
		echo '<li><a href="/index.php?soru_cevap&sayfa='.$onceki.'">Önceki</a></li>';
	if($sayfa > $syf+1 && $sonsayfa > 1)
		echo '<li><a href="/index.php?soru_cevap&sayfa=1">1</a></li>';
	if($sayfa > $syf+2)
		echo '<li><a style="cursor:pointer;">...</a></li>';
		for(;$i<=$k;$i++){
			if($i>0 && $i <= $sonsayfa && $sonsayfa > 1){
				echo'<li class="';
				soru_sayfa($i);
				echo'"><a href="/index.php?soru_cevap&sayfa='.$i.'">'.$i.'</a></li>';
			}
		}
		if($sayfa < $syf+2 && $sonsayfa > $syf)
		echo '<li><a style="cursor:pointer;">...</a></li>';
		if($sayfa < $syf+1 && $sonsayfa > $syf +1)
		echo '<li><a href="/index.php?soru_cevap&sayfa='.$sonsayfa.'">'.$sonsayfa.'</a></li>';
		if($sayfa < $sonsayfa)
		echo '<li><a href="/index.php?soru_cevap&sayfa='.$sonraki.'">Sonraki</a></li>';
		echo '</ul></center>';
	}
	
	
	echo'	
	</div>
	';
	?>