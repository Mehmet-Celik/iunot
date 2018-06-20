<?php 
	function soru_sayfa1($s) {
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
<?php 
if (guvenlik(isset($_GET["dersler"]))) {
	if(guvenlik(isset($_GET["notlar"]))){
		include("konu.php");
	}
	else{
	
			
	$bolum=guvenlik($_GET["dersler"]);
	$dersvarmi=mysql_query("select * from tbl_ders where bolum_id='$bolum'");
	if(!mysql_num_rows($dersvarmi)){
		echo '<div class="col-md-7" style="padding-left:40px;">
		<div class="alert alert-danger" role="alert">Böyle Bir Ders Bulunamamıştır.</div></div>';
	}
	else{
	echo '<div class="col-md-7" style="padding-left:40px;">';
			if(guvenlik(isset($_GET["sayfa"]))){
			$sayfa=guvenlik($_GET["sayfa"]);
			}
			else {
				$sayfa=1;
			}
			$donemsorgu=mysql_query("select * from tbl_donem order by id");
			$donem_sayisi=mysql_num_rows($donemsorgu);
			$limit2=2;
			$baslangic=($sayfa*$limit2)-$limit2;				
	$donemsorgu=mysql_query("select * from tbl_donem limit $baslangic,$limit2");
	while($donemsql=mysql_fetch_array($donemsorgu)){
		$bolum=guvenlik($_GET["dersler"]);
		$donem=$donemsql["donem"];
		$derssorgu=mysql_query("select * from tbl_ders where donem_id='$donem' and bolum_id='$bolum'");
		$derssql=mysql_fetch_array($derssorgu);
		$bolum_id=$derssql["bolum_id"];
		$bolumsorgu=mysql_query("select * from tbl_bolum where id='$bolum_id'");
		$bolumsql=mysql_fetch_array($bolumsorgu);
		$fakulte_id=$bolumsql["fakulte_id"];
		$fakultesorgu=mysql_query("select * from tbl_fakulte where id='$fakulte_id'");
		$fakultesql=mysql_fetch_array($fakultesorgu);
	if($donem==1 || $donem==3 || $donem==5 || $donem==7){
		echo'	<br>
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
							<a href="/'.tr_duzelt($fakultesql["fakulte_isim"]).'/'.tr_duzelt($bolumsql["bolum"]).'/'.$derssql["bolum_id"].'/'.$derssql["id"].'">'.$bolumsql["bolum"].'</a>
							<i class="fa fa-angle-right"></i>
						</li>
						<li>
							<i class="fa fa-bookmark"></i>
							<a href="/'.tr_duzelt($fakultesql["fakulte_isim"]).'/'.tr_duzelt($bolumsql["bolum"]).'/'.$derssql["bolum_id"].'/'.$derssql["id"].'">'.(($donem+1)/2).'.Sınıf</a>
						</li>
					</ul>
				</div>';
		
	}			
	echo'
	<div class="row konular">
  <div>
    <center><h3><i class="fa fa-bookmark"></i> '.$donemsql["donem"].'.Dönem</h3></center>
  </div>
  <hr/>';
  $bolum=guvenlik($_GET["dersler"]);
  $donem=guvenlik($donemsql["donem"]);
  $derssorgu=mysql_query("select * from tbl_ders where donem_id='$donem' and bolum_id='$bolum'");
  while($derssql=mysql_fetch_array($derssorgu)){
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

  echo'</div>';
  }
  echo '<center><ul class="pagination">';
		$syf=2;
		$i=$sayfa-$syf;
		$k=$sayfa+$syf;
		$sonsayfa=ceil($donem_sayisi/$limit2);
		$onceki=$sayfa-1;
		$sonraki=$sayfa+1;
		if($sayfa > 1)
		echo '<li><a href="/index.php?dersler='.$bolum.'&sayfa='.$onceki.'">Önceki</a></li>';
	if($sayfa > $syf+1 && $sonsayfa > 1)
		echo '<li><a href="/index.php?dersler='.$bolum.'&sayfa=1">1</a></li>';
	if($sayfa > $syf+2)
		echo '<li><a style="cursor:pointer;">...</a></li>';
		for(;$i<=$k;$i++){
			if($i>0 && $i <= $sonsayfa && $sonsayfa > 1){
				echo'<li class="';
				soru_sayfa1($i);
				echo'"><a href="/index.php?dersler='.$bolum.'&sayfa='.$i.'">'.$i.'</a></li>';
			}
		}
		if($sayfa < $syf && $sonsayfa > $syf+1)
		echo '<li><a style="cursor:pointer;">...</a></li>';
		if($sayfa < $syf+1 && $sonsayfa > $syf +2)
		echo '<li><a href="/index.php?dersler='.$bolum.'&sayfa='.$sonsayfa.'">'.$sonsayfa.'</a></li>';
		if($sayfa < $sonsayfa)
		echo '<li><a href="/index.php?dersler='.$bolum.'&sayfa='.$sonraki.'">Sonraki</a></li>';
		echo '</ul></center>';
echo'</div>';
}
}
}
?>