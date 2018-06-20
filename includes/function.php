<?php

function guvenlik($q) {
         $q = str_replace(",","",$q);
         $q = str_replace(";","",$q);
         $q = str_replace("'","",$q);
         $q = str_replace("`","",$q);
         $q = str_replace('"',"",$q);
         $q = str_replace("<","",$q);
         $q = str_replace(">","",$q);
         $q = str_replace("´","",$q);
         $q = str_replace("|","",$q);
         $q = str_replace("=","",$q);
         $q = str_replace("'","",$q);
         $q = str_replace("!","",$q);
         $q=trim($q);
         return $q;
}

?>
<?php
	function tarihformat($tarihformat){
		$tarihformat=explode(' ',$tarihformat);
		$tarih=$tarihformat[0];
		$zaman=$tarihformat[1];
		$yil=explode('-',$tarih)[0];
		$ay=explode('-',$tarih)[1];
		$gun=explode('-',$tarih)[2];
		$saat=explode(':',$zaman)[0];
		$dakika=explode(':',$zaman)[1];
		$saniye=explode(':',$zaman)[2];
		
		switch($ay){
			case 1:$ay='Ocak';break;
			case 2:$ay='Şubat';break;
			case 3:$ay='Mart';break;
			case 4:$ay='Nisan';break;
			case 5:$ay='Mayıs';break;
			case 6:$ay='Haziran';break;
			case 7:$ay='Temmuz';break;
			case 8:$ay='Ağustos';break;
			case 9:$ay='Eylül';break;
			case 10:$ay='Ekim';break;
			case 11:$ay='Kasım';break;
			case 12:$ay='Aralık';break;
		}
		switch($gun){
			case 1:$gun1='Pazartesi';break;
			case 2:$gun1='Salı';break;
			case 3:$gun1='Çarşamba';break;
			case 4:$gun1='Perşembe';break;
			case 5:$gun1='Cuma';break;
			case 6:$gun1='Cumartesi';break;
			case 7:$gun1='Pazar';break;
		}
		echo $gun.' '.$ay.' '.$yil;
	}
?>
<?php 
	function notlar_ustmenu(){
		//$sorgu=mysql_query("select tbl_fakulte.* from tbl_fakulte inner join tbl_bolum on tbl_bolum.fakulte_id=tbl_fakulte.id inner join tbl_ders on tbl_ders.bolum_id=tbl_bolum.id inner join tbl_not on tbl_not.ders_id=tbl_ders.id group by tbl_fakulte.id");
		$sorgu = mysql_query("select * from tbl_fakulte");
		while($fakulte=mysql_fetch_array($sorgu)) {
			$fakulte_id=$fakulte["id"];
			echo '<li style="margin-top:5px;"><a href="#" class="trigger right-caret"><i class="fa fa-university"></i> '.$fakulte["fakulte_isim"].'</a>
					<ul class="dropdown-menu sub-menu">';
			$sorgu1=mysql_query("select * from tbl_bolum where fakulte_id='$fakulte_id'");
			//$sorgu1=mysql_query("select tbl_bolum.* from tbl_bolum inner join tbl_ders on tbl_ders.bolum_id=tbl_bolum.id inner join tbl_not on tbl_not.ders_id=tbl_ders.id group by tbl_bolum.id");
				while($bolum=mysql_fetch_array($sorgu1)){
				echo '
				<li><a href="/'.tr_duzelt($fakulte["fakulte_isim"]).'/'.tr_duzelt($bolum["bolum"]).'/'.$bolum["id"].'/1"><i class="fa fa-graduation-cap"></i> '.$bolum["bolum"].'</a></li>';
				}
			echo '</ul>
				</li>';
		}
	}
?>
<?php 
function tr_duzelt($tr1) {  //türkçe karakter düzelt
	$turkce=array("ş","Ş","ı","(",")","'","ü","Ü","ö", "Ö","ç","Ç"," ","/","*","?","ş","Ş","ı","ğ","Ğ","İ","ö","Ö","Ç","ç", "ü","Ü"); 
	$duzgun=array("s","S","i","","","","u","U","o","O" ,"c","C","_","_","_","","s","S","i","g","G","I","o","O","C","c","u"," U"); 
	$tr1=str_replace($turkce,$duzgun,$tr1);
	$tr1= strtolower($tr1);
	$tr1 = preg_replace("@[^A-Za-z0-9\-_]+@i","",$tr1); 
	return $tr1; 
}
	function notlar_yanmenu(){
		$sayac=0;
		$sorgu=mysql_query("select tbl_fakulte.* from tbl_fakulte inner join tbl_bolum on tbl_bolum.fakulte_id=tbl_fakulte.id inner join tbl_ders on tbl_ders.bolum_id=tbl_bolum.id inner join tbl_not on tbl_not.ders_id=tbl_ders.id group by tbl_fakulte.id");
		//$sorgu = mysql_query("select * from tbl_fakulte");
		while($fakulte=mysql_fetch_array($sorgu)) {
			$sayac++;
			
			$fakulte_id=$fakulte["id"];
			echo '
					<li>
          <a href="#" data-toggle="collapse" data-target="#toggleDemo'; 
		  if($sayac==1){
				echo'';
			}
			else{
				echo $sayac;
			}
		  echo'" data-parent="#sidenav01" class="collapsed">
          <i class="fa fa-university"></i> '.$fakulte["fakulte_isim"].'<i class="fa fa-angle-down pull-right"></i>
          </a>
          <div class="collapse" id="toggleDemo'; 
		  if($sayac==1){
				echo'';
			}
			else{
				echo $sayac;
			}
		  echo'">
            <ul class="nav nav-list">';
			$sorgu1=mysql_query("select tbl_bolum.* from tbl_bolum inner join tbl_ders on tbl_ders.bolum_id=tbl_bolum.id inner join tbl_not on tbl_not.ders_id=tbl_ders.id group by tbl_bolum.id");
			//$sorgu1=mysql_query("select * from tbl_bolum where fakulte_id='$fakulte_id'");
				while($bolum=mysql_fetch_array($sorgu1)){
				echo '
						<li><a href="/'.tr_duzelt($fakulte["fakulte_isim"]).'/'.tr_duzelt($bolum["bolum"]).'/'.$bolum["id"].'/1"><i class="fa fa-graduation-cap"></i> '.$bolum["bolum"].'</a></li>';
				}
			echo '</ul>
					</div>
					</li>';
				
		}
	}
?>
<?php 
	function duyurular(){
		$sorgu = mysql_query("select * from tbl_duyuru order by id desc ,id LIMIT 0,5");
		while($duyuru=mysql_fetch_array($sorgu)) {
			$bolum_id=$duyuru["bolum_id"];
			$ders_id=$duyuru["ders_id"];
			$sorgu1 = mysql_query("select * from tbl_bolum where id='$bolum_id'");
			$sorgu1sql=mysql_fetch_array($sorgu1);
			$sorgu2 = mysql_query("select * from tbl_ders where id='$ders_id'");
			$sorgu2sql=mysql_fetch_array($sorgu2);
			echo'<li style="padding-bottom:20px;" class="list-group-item"><a href="#"><i class="fa fa-bell-o"></i> '.$sorgu1sql["bolum"].' / '.$sorgu2sql["ders_isim"].' <br/><span class="pull-right"><i class="fa fa-clock-o"></i> ';tarihformat($duyuru["duyuru_eklenme_tarihi"]); echo'</span></a></li>
						<div class="panel-body">
							<p>'.$duyuru["duyuru_icerik"].'</p>
						</div>';
			
			
		}
	}
?>