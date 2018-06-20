<?php require_once("../includes/config.php"); ?>
<?php include("../includes/function.php"); ?>
<?php error_reporting(E_ALL ^ E_NOTICE);?>   <!-- Hataların Gizlenmesi -->
<!DOCTYPE html>
<html lang="tr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="description" content=""/>
	<meta name="keywords" content=""/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<meta name="robots" content="index, follow"/>
	<title>İÜ.NOT | ADMIN PANELI</title>
	<link rel="icon" href="../images/favicon.ico"/>
	<link href="../css/bootstrap.min.css" rel="stylesheet"/>
	<link href="../font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
	<link href="../css/style.css" rel="stylesheet"/>
</head>
<body>
<?php 
 if(isset($_SESSION["id"])){
	 $uyeid=$_SESSION["id"];
	 $sorgu=mysql_query("SELECT * FROM tbl_uye WHERE id='$uyeid'");
	 $uyegiris=mysql_fetch_Array($sorgu);
	 if($uyegiris["uye_yetki"]==0){
		 header("Location:login.php");
	 }
	 else{
		 echo'
		 <nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand caviar-dreams-bold" href="../index.php"><span class="turuncu">İÜ</span>.NOT <i class="fa fa-laptop turuncu"></i></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="adminpanel.php"><i class="fa fa-home"></i> Anasayfa<span class="sr-only">(current)</span></a></li>';
		if($uyegiris["uye_yetki"]==2){//Admin ise
			echo'
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-university"></i> Fakülte <i class="fa fa-angle-down"></i></span></a>
		  <ul class="dropdown-menu">
			<li><a href="adminpanel.php?fakulte_listele" class="trigger"><i class="fa fa-list-ul"></i> Fakülte Listele</a></li>
           <li><a href="adminpanel.php?fakulte_ekle" class="trigger"><i class="fa fa-plus"></i> Fakülte Ekle</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-graduation-cap"></i> Bölüm <i class="fa fa-angle-down"></i></span></a>
		  <ul class="dropdown-menu">
			<li><a href="adminpanel.php?bolum_listele" class="trigger"><i class="fa fa-list-ul"></i> Bölüm Listele</a></li>
           <li><a href="adminpanel.php?bolum_ekle" class="trigger"><i class="fa fa-plus"></i> Bölüm Ekle</a></li>
          </ul>
        </li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book"></i> Ders <i class="fa fa-angle-down"></i></span></a>
		  <ul class="dropdown-menu">
			<li><a href="adminpanel.php?ders_listele" class="trigger"><i class="fa fa-list-ul"></i> Ders Listele</a></li>
           <li><a href="adminpanel.php?ders_ekle" class="trigger"><i class="fa fa-plus"></i> Ders Ekle</a></li>
          </ul>
        </li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bullhorn"></i> Duyuru <i class="fa fa-angle-down"></i></span></a>
		  <ul class="dropdown-menu">
			<li><a href="adminpanel.php?duyuru_listele" class="trigger"><i class="fa fa-list-ul"></i> Duyuru Listele</a></li>
           <li><a href="adminpanel.php?duyuru_ekle" class="trigger"><i class="fa fa-plus"></i> Duyuru Ekle</a></li>
          </ul>
        </li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-o"></i> Not <i class="fa fa-angle-down"></i></span></a>
		  <ul class="dropdown-menu">
			<li><a href="adminpanel.php?not_listele" class="trigger"><i class="fa fa-list-ul"></i> Not Listele</a></li>
           <li><a href="adminpanel.php?not_ekle" class="trigger"><i class="fa fa-plus"></i> Not Ekle</a></li>
          </ul>
        </li>
		<li>
		<a href="adminpanel.php?soru_cevap"><i class="fa fa-comment"></i> Soru / Cevap</a>
		</li>
		<li>
		<a href="adminpanel.php?uyeler"><i class="fa fa-user"></i> Üyeler</a>
		</li>
		<li>
		<a href="adminpanel.php?mesaj_listele"><i class="fa fa-envelope"></i> Mesajlar</a>
		</li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-image"></i> Slider <i class="fa fa-angle-down"></i></span></a>
		  <ul class="dropdown-menu">
			<li><a href="adminpanel.php?slider" class="trigger"><i class="fa fa-list-ul"></i> Slider Listele</a></li>
           <li><a href="adminpanel.php?slider_ekle" class="trigger"><i class="fa fa-plus"></i> Slider Ekle</a></li>
          </ul>
        </li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
		<li class="navbar-right" style="margin-right:10px;"><a href="cikis.php"><i class="fa fa-times-circle-o"></i> Çıkış</a></li>
		</ul>
		</div>
	</div>
	</nav>
	<div class="row" style="margin:10px;margin-top:60px;">
		 
		 ';
		if(guvenlik(isset($_GET["fakulte_listele"]))){
		include("fakulte_listele.php");
		}else if(guvenlik(isset($_GET["fakulte_ekle"]))){
			include("fakulte_ekle.php");
		}else if(guvenlik(isset($_GET["bolum_ekle"]))){
			include("bolum_ekle.php");
		}else if(guvenlik(isset($_GET["bolum_listele"]))){
			include("bolum_listele.php");
		}else if(guvenlik(isset($_GET["ders_ekle"]))){
			include("ders_ekle.php");
		}else if(guvenlik(isset($_GET["ders_listele"]))){
			include("ders_listele.php");
		}else if(guvenlik(isset($_GET["duyuru_ekle"]))){
			include("duyuru_ekle.php");
		}else if(guvenlik(isset($_GET["duyuru_listele"]))){
			include("duyuru_listele.php");
		}else if(guvenlik(isset($_GET["uyeler"]))){
			include("uyeler.php");
		}else if(guvenlik(isset($_GET["soru_cevap"]))){
			include("soru_cevap.php");
		}else if(guvenlik(isset($_GET["slider"]))){
			include("slider.php");
		}else if(guvenlik(isset($_GET["slider_ekle"]))){
			include("slider_ekle.php");
		}else if(guvenlik(isset($_GET["not_ekle"]))){
			include("notekle.php");
		}else if(guvenlik(isset($_GET["not_listele"]))){
			include("not_listele.php");
		}else if(guvenlik(isset($_GET["mesaj_listele"]))){
			include("mesaj_listele.php");
		}else{
			echo'<div class="row">
					<div style="text-align:center;font-size:50px;margin-top:30px;"><span class="turuncu">İÜ</span>.NOT <i class="fa fa-laptop turuncu"></i></div>
					<div style="text-align:center;font-size:50px;margin-top:30px;"><span>'.$uyegiris["uye_isim_soyisim"].' Hoşgeldin :)</span></div>
					<div style="margin-top:30px;"><center></center></div>
				</div>';
		}
		echo'</div>';
		}
		else if($uyegiris["uye_yetki"]==1){//Editör ise
			echo'
			<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-bullhorn"></i> Duyuru <i class="fa fa-angle-down"></i></span></a>
		  <ul class="dropdown-menu">
			<li><a href="adminpanel.php?duyuru_listele" class="trigger"><i class="fa fa-list-ul"></i> Duyuru Listele</a></li>
           <li><a href="adminpanel.php?duyuru_ekle" class="trigger"><i class="fa fa-plus"></i> Duyuru Ekle</a></li>
          </ul>
        </li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-file-o"></i> Not <i class="fa fa-angle-down"></i></span></a>
		  <ul class="dropdown-menu">
			<li><a href="adminpanel.php?not_listele" class="trigger"><i class="fa fa-list-ul"></i> Not Listele</a></li>
           <li><a href="adminpanel.php?not_ekle" class="trigger"><i class="fa fa-plus"></i> Not Ekle</a></li>
          </ul>
        </li>
		<li>
		<a href="adminpanel.php?soru_cevap"><i class="fa fa-comment"></i> Soru / Cevap</a>
		</li>
		</ul>
		<ul class="nav navbar-nav navbar-right">
		<li class="navbar-right" style="margin-right:10px;"><a href="cikis.php"><i class="fa fa-times-circle-o"></i> Çıkış</a></li>
		</ul>
		</div>
	</div>
	</nav>
	<div class="row" style="margin:10px;margin-top:60px;">
		 
		 ';
		if(guvenlik(isset($_GET["duyuru_ekle"]))){
			include("duyuru_ekle.php");
		}else if(guvenlik(isset($_GET["duyuru_listele"]))){
			include("duyuru_listele.php");
		}else if(guvenlik(isset($_GET["soru_cevap"]))){
			include("soru_cevap.php");
		}else if(guvenlik(isset($_GET["not_ekle"]))){
			include("notekle.php");
		}else if(guvenlik(isset($_GET["not_listele"]))){
			include("not_listele.php");
		}
		else{
			echo'<div class="row">
					<div style="text-align:center;font-size:100px;margin-top:200px;"><span class="turuncu">İÜ</span>.NOT <i class="fa fa-laptop turuncu"></i></div>
					<div style="text-align:center;font-size:100px;margin-top:100px;"><span>'.$uyegiris["uye_isim_soyisim"].' Hoşgeldin :)</span></div>
				</div>';
			
		}
		echo'</div>';
			
		}
		
	 }
 }
?>








<script src="../js/jquery-2.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../ckeditor/ckeditor.js" type="text/javascript" language="javascript"></script>
<script>
$(function(){
	$(".dropdown-menu > li > a.trigger").on("click",function(e){
		var current=$(this).next();
		var grandparent=$(this).parent().parent();
		if($(this).hasClass('left-caret')||$(this).hasClass('right-caret'))
			$(this).toggleClass('right-caret left-caret');
		grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
		grandparent.find(".sub-menu:visible").not(current).hide();
		current.toggle();
		e.stopPropagation();
	});
	$(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
		var root=$(this).closest('.dropdown');
		root.find('.left-caret').toggleClass('right-caret left-caret');
		root.find('.sub-menu:visible').hide();
	});
});
</script>
</body>
</html>