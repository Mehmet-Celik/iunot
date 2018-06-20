<?php 
if(isset($_POST["btAra"])){
	$aranacak_kelime=guvenlik($_POST["txArama"]);

	$aramasorgu3=mysql_query("select * from tbl_ders where ders_isim like '%$aranacak_kelime%'");
	$aramasorgu4=mysql_query("select * from tbl_not where not_baslik like '%$aranacak_kelime%'");
	
	echo'
		<div class="col-md-7" style="padding-left:40px;">
			<div class="row konular">
				<div class="container">
				<center><h3><i class="fa fa-search"></i> '.$aranacak_kelime.'</h3></center>
				</div><hr>';
		if($aranacak_kelime==""){
			echo'<div class="alert alert-danger" role="alert">Aranacak Yeri Lütfen Boş Bırakmayın !</div>';
		}else if(mysql_num_rows($aramasorgu3)>0 || mysql_num_rows($aramasorgu4)>0){
		while($derssql=mysql_fetch_array($aramasorgu3)){
			$bolum_id=$derssql["bolum_id"];
			$bolumsorgu=mysql_query("select * from tbl_bolum where id='$bolum_id'");
			$bolumsql=mysql_fetch_array($bolumsorgu);
			$fakulte_id=$bolumsql["fakulte_id"];
			$fakultesorgu=mysql_query("select * from tbl_fakulte where id='$fakulte_id'");
			$fakultesql=mysql_fetch_array($fakultesorgu);
			  echo'
		  <div class="col-xs-12 col-md-3">
			<div class="note-border"></div>
			<center><a href="/'.tr_duzelt($fakultesql["fakulte_isim"]).'/'.tr_duzelt($bolumsql["bolum"]).'/'.tr_duzelt($derssql["ders_isim"]).'/'.$derssql["bolum_id"].'/'.$derssql["id"].'" class="thumbnail">
			  <p><i class="fa fa-book"></i> '.$derssql["ders_isim"].'</p>
			  <br/>
			  <p><i class="fa fa-graduation-cap"></i> '.$bolumsql["bolum"].'</p>
			  <br/>
			  <p><i class="fa fa-university"></i> '.$fakultesql["fakulte_isim"].'</p>
			  <br/>
			  <h3><span class="turuncu">İÜ</span>.NOT <i class="fa fa-laptop turuncu"></i></h3>
			</a></center>
		  </div>';  
		  }
		
		while($notlarsql=mysql_fetch_array($aramasorgu4)){
			$ders_id=$notlarsql["ders_id"];
			$derssorgu=mysql_query("select * from tbl_ders where id='$ders_id'");
			$dersql=mysql_fetch_array($derssorgu);
			$bolum_id=$dersql["bolum_id"];
			$bolumsorgu=mysql_query("select * from tbl_bolum where id='$bolum_id'");
			$bolumsql=mysql_fetch_array($bolumsorgu);
			$fakulte_id=$bolumsql["fakulte_id"];
			$fakultesorgu=mysql_query("select * from tbl_fakulte where id='$fakulte_id'");
			$fakultesql=mysql_fetch_array($fakultesorgu);
					echo'
					<div class="col-xs-12 col-md-3">
					<div class="note-border"></div>
				<center><a href="/'.tr_duzelt($fakultesql["fakulte_isim"]).'/'.tr_duzelt($bolumsql["bolum"]).'/'.tr_duzelt($notlarsql["not_baslik"]).'/'.$bolum_id.'/'.$dersql["id"].'/'.$notlarsql["id"].'" class="thumbnail">
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
		}else{
			echo'<div class="alert alert-danger" role="alert">Aradığınız Kelime Bulunamadı !</div>';
		}
		
	echo '
		</div>
		</div>';
}
?>