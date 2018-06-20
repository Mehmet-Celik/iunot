<?php
		if(guvenlik(isset($_GET["profil"]))){
			$oturum_id=guvenlik($_GET["profil"]);
			
			if($_SESSION["id"]==guvenlik($_GET["profil"])){
				$sorgu=mysql_query("select * from tbl_soru where soran_id='$oturum_id'");
				$sorusql_rows=mysql_num_rows($sorgu);
				if($sorusql_rows){
				echo'
				<div class="iletisim" style="margin-top:10px;margin-bottom:10px;">';
				while($sorusql=mysql_fetch_array($sorgu)){
					if($sorusql["goruntulenme"]==0){
						$yayın='Sorunuz Henüz Yayınlanmadı ! ';
					}
					else{
						$yayın='Sorunuz Eklenmiştir ! ';
					}
				echo'
				<span><i class="fa fa-question-circle"></i> Soru : '.$sorusql["soru_baslik"].'</span> <span style="float:right;margin-right:20px;"><kbd>'.$yayın.'</kbd></span> <br><br><span style="margin-left:10px;"> <i class="fa fa-angle-right"></i> '.$sorusql["soru"].'</span>
				<br>
				<br>
				<a style="float:right;margin-right:20px;color:#444444;" href="/index.php?profil='.$oturum_id.'&soru_sil='.$sorusql["id"].'"><i class="fa fa-times"></i> Soruyu Sil</a>
				<a style="float:right;margin-right:70px;color:#444444;" href="/index.php?soru_cevap&soru='.$sorusql["id"].'"><i class="fa fa-eye"></i> Soruyu Görüntüle</a>
				<hr/>';
				}
				
				echo'</div>
				';
				}
				else{
				echo '<div class="alert alert-danger" role="alert">Henüz Soru Girmemişsiniz !</div>';
					}
				if(guvenlik(isset($_GET["soru_sil"]))){
					$soruid=guvenlik($_GET["soru_sil"]);
					$soru_sil=mysql_query("DELETE FROM tbl_soru WHERE id='$soruid'");
					if($soru_sil){
						echo '<meta http-equiv="refresh" content="0;URL=index.php?profil='.$oturum_id.'">';
						//echo '<div class="alert alert-success" role="alert">Soru Başarıyla Silinmiştir.</div>';
						
					}
					if(!$soru_sil && guvenlik(!isset($_GET["soru_sil"]))) {
						echo '<div class="alert alert-danger" role="alert">Soru Silme Basarısız Olmuştur</div>';
					}	
				}
				}
			else{
				$sorgu=mysql_query("select * from tbl_soru where soran_id='$oturum_id' and goruntulenme='1'");
				$sorusql_rows=mysql_num_rows($sorgu);
				if($sorusql_rows){
			
				echo'
				<div class="iletisim" style="margin-top:10px;margin-bottom:10px;">';
				while($sorusql=mysql_fetch_array($sorgu)){
				echo'
				<span><i class="fa fa-question-circle"></i> Soru : '.$sorusql["soru_baslik"].'</span> <br><span style="margin-left:10px;"> <i class="fa fa-angle-right"></i> '.$sorusql["soru"].'</span>
				<a style="float:right;color:#444444;" href="/index.php?soru_cevap&soru='.$sorusql["id"].'">Soruyu Görüntüle <i class="fa fa-eye"></i></a>
				<hr/>';
				}
				
				echo'</div>
				';
				}
				else{
				echo '<div class="alert alert-danger" role="alert">Henüz Soru Sormamıştır !</div>';			
				}
				}	
		}
		
	
	
?>
