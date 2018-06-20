<?php require_once("includes/config.php"); ?>
<?php include("includes/function.php"); ?>
<?php error_reporting(E_ALL ^ E_NOTICE);?>
<script>
		function uye_fakultesec() {
  		 fakulte_deger = $('select[name="fakulte"]').val();
 		  $.get('uye_ajax.php', {fakulte_id: fakulte_deger}, function (gelen_cevap) {
  		    $('.uye_option').html(gelen_cevap);
  		 });
		}
		
</script>
<!DOCTYPE html>
<html lang="tr">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="description" content="Hızlı ve Kolay Not Takip Sitesi"/>
	<meta name="keywords" content="not, iunot, iu, istanbul üniversitesi, ders notu, sınav notu, hızlı ve kolay not, not takip"/>
	<meta name="url" content="http://iunot.com<?php echo $_SERVER["REQUEST_URI"]; ?>"/>
	<meta name="viewport" content="width=device-width,initial-scale=1.0"/>
	<meta name="robots" content="index, follow"/>
	<title>
	<?php
	if(guvenlik(isset($_GET["notlar"]))){
		$notlar_id=guvenlik($_GET["notlar"]);
	
		$bolum=guvenlik($_GET["dersler"]);
		$notlarsorgu=mysql_query("select * from tbl_ders where id='$notlar_id'");
		$notlarsql=mysql_fetch_array($notlarsorgu);
		$bolumsorgu=mysql_query("select * from tbl_bolum where id='$bolum'");
		$bolumsql=mysql_fetch_array($bolumsorgu);
		$fakulte_id=$bolumsql["fakulte_id"];
		$fakultesorgu=mysql_query("select * from tbl_fakulte where id='$fakulte_id'");
		$fakultesql=mysql_fetch_array($fakultesorgu);
		echo $fakultesql["fakulte_isim"].' '.$bolumsql["bolum"].' '.$notlarsql["ders_isim"].' -';
	}
	
	?>  İÜ.NOT | Hızlı ve Kolay Not Takip Sitesi</title>
	<link rel="icon" href="/images/favicon.ico"/>
	<link href="/css/bootstrap.min.css" rel="stylesheet"/>
	<link href="/font-awesome-4.5.0/css/font-awesome.min.css" rel="stylesheet"/>
	<link href="/css/style.css" rel="stylesheet"/>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand caviar-dreams-bold" href="/anasayfa"><span class="turuncu">İÜ</span>.NOT <i class="fa fa-laptop turuncu"></i></a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/anasayfa"><i class="fa fa-home"></i> Anasayfa<span class="sr-only">(current)</span></a></li>
		<li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book"></i> Notlar <i class="fa fa-angle-down"></i></span></a>
		  <ul class="dropdown-menu">
            <?php 
				notlar_ustmenu();
			?>
          </ul>
        </li>
        <li><a href="/index.php?soru_cevap"><i class="fa fa-comment"></i> Soru / Cevap</a></li>
		<li><a href="/index.php?iletisim"><i class="fa fa-envelope"></i> İletişim</a></li>
		<li role="menuitem" class="nav-search">
          <form id="Aramaform" name="Aramaform" method="post" action="">
            <label for="search"></label>
            <input type="text" id="txArama" name="txArama" title="Arama" placeholder="Notlarda Ara...">
            <input type="submit" id="btAra" name="btAra" value="">
          </form>
        </li>
		</ul>
		<?php
		if($_SESSION["id"]){
			$oturum_id=$_SESSION["id"];
			$sorgu=mysql_query("SELECT * FROM tbl_uye WHERE id='$oturum_id'");
			$uyegiris=mysql_fetch_array($sorgu);
			
			echo '
			<ul class="nav navbar-nav navbar-right">
			<li class="dropdown" id="profil_kisim">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i> '.$uyegiris["uye_isim_soyisim"].' <i class="fa fa-angle-down"></i></span></a>
		  <ul class="dropdown-menu"  id="sag_taraf">
			<li><a href="/index.php?profil='.$oturum_id.'"><i class="fa fa-user"></i> Profilim</a></li>';
			
			if($uyegiris["uye_yetki"]==0){
			echo'
			<li><a href="#"><i class="fa fa-book"></i> Derslerim</a></li>';}
			if($uyegiris["uye_yetki"]!=0){
				echo'
				<li><a href="/qweqwkjdfsdfıuhquwdhuasıd/adminpanel.php"><i class="fa fa-product-hunt"></i> Panel</a></li>
				';
			}
			echo'
			<li><a href="/includes/cikis.php"><i class="fa fa-times-circle-o"></i> Çıkış</a></li>
			</ul>
			</li>
			</ul>
			';
			
		}
		else{
			echo '
			
			<ul class="nav navbar-nav navbar-right">
			<li><a href="#" data-toggle="modal" data-target="#myModal">Üye Girişi <i class="fa fa-user"></i></a></li>
			<li><a href="#" data-toggle="modal" data-target="#myModal1">Üye Ol <i class="fa fa-user-plus"></i></a></li>
			</ul>
			';
			
		}
	  
	  ?>
    </div>
  </div>
</nav>
	<div class="row">
		<div class="col-md-2 border" style="height:auto;overflow:hidden;">
		<div class="sidebar-nav">
		<ul class="nav" id="sidenav01">
		<li><a href="#" class="sol"><h5><i class="fa fa-book"></i> Notlar</h5></a></li>
		<?php notlar_yanmenu();?>
      </ul>
	</div>
	</div>
	<br/>
		 <?php 
		if(isset($_POST["btGiris"])){
		$email=guvenlik($_POST["txEmail"]);
		$sifre=md5(guvenlik($_POST["txSifre"]));
		$sorgu=mysql_query("SELECT * FROM tbl_uye WHERE uye_email='$email' and uye_sifre='$sifre'");
		$uyegiris=mysql_fetch_array($sorgu);
		if(mysql_num_rows($sorgu)!=0){
			
				$_SESSION["Email"]=$uyegiris["uye_email"];
				$_SESSION["id"]=$uyegiris["id"];
				echo '<meta http-equiv="refresh" content="0;URL=/anasayfa">';
			
		}
		else{
			echo '<div class="col-md-10">
			<div class="alert alert-danger" role="alert">Giriş Basarısız Olmuştur ! </div></div>';
			echo '<meta http-equiv="refresh" content="2;URL=/anasayfa">';
		}
		
		
	}

	?>
		<?php
		if(isset($_POST["btUyeOl"])){
		$isimsoyisim=guvenlik($_POST["txAdSoyad"]);
		$fakulte_id=guvenlik($_POST["fakulte"]);
		$bolum_id=guvenlik($_POST["bolum"]);
		$email=guvenlik($_POST["txEmail"]);
		$sifre=md5(guvenlik($_POST["txSifre"]));
		$karsilastir=mysql_query("SELECT * FROM tbl_uye WHERE uye_email='$email'");

		if($fakulte_id!=0 && $bolum_id!=0 && mysql_num_rows($karsilastir)<1){
		$uye_ekleme=mysql_query("INSERT into tbl_uye (uye_isim_soyisim,uye_email,uye_sifre,fakulte_id,bolum_id) values ('$isimsoyisim','$email','$sifre','$fakulte_id','$bolum_id')");
		}
		
		if($uye_ekleme){
		echo '
		<div class="col-md-10">
		<div class="alert alert-success" role="alert">Üyeliğiniz Başarıyla Eklenmiştir.</div></div>';
		echo '<meta http-equiv="refresh" content="2;URL=/anasayfa">';
		}
		else{
			echo '<div class="col-md-10">
			<div class="alert alert-danger" role="alert">Üyelik Sırasında Hata Olmuştur , Tekrar Deneyiniz ! </div></div>';
			echo '<meta http-equiv="refresh" content="2;URL=/anasayfa">';
		}
	}
		 ?>
		<?php include("icerik.php"); ?>
		<div class="col-md-3">
			<div class="panel panel-default">
				<div class="panel-heading"><h5><i class="fa fa-bullhorn"></i> Güncel Duyurular</h5></div>
				<ul class="list-group">
				<?php duyurular();?>
				</ul>
			</div>
			<a data-width="465" data-height="504" class="twitter-timeline" href="https://twitter.com/InfoIunot" data-widget-id="700431324167979008">@Cenotumnet tarafından gönderilen tweetler</a>
		<br/>
		<br/>
		<center><div class="fb-page" data-href="https://www.facebook.com/iunotcom-996993257054230/?skip_nax_wizard=true" data-tabs="timeline" data-width="340" data-height="520" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"></div></center>
		<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		</div>
		
		</div>
			<footer>
		<center><div class="row fot">
			<div class="col-md-4"><span>2016 © iunot.com</span></div> <div class="col-md-4"><span><span class="turuncu">İÜ</span>.NOT <i class="fa fa-laptop turuncu"></i> Hızlı ve Kolay Not Takip Sitesi</span></div> <div class="col-md-4"><a href="https://www.facebook.com/iunotcom-996993257054230/"><i class="fa fa-facebook-square"></i> Facebook</a> <a href="https://twitter.com/Cenotumnet"><i class="fa fa-twitter-square"></i> Twitter</a></div>
		</div></center>
			</footer>
		<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#444444;color:#fff;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Üye Girişi <i class="fa fa-user"></i></h4>
      </div>
      <div class="modal-body">
	  <div class="row">
        <form class="form-horizontal" id="uye_giris" name="uye_giris" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">E-Mail</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="txEmail" name="txEmail" placeholder="E-Mail">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="txSifre" name="txSifre" placeholder="Password">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" id="btGiris" name="btGiris">Giriş</button>
    </div>
  </div>
  <br/>
  <br/>
</form>
</div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#444444;color:#fff;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Üye Ol <i class="fa fa-user-plus"></i></h4>
      </div>
      <div class="modal-body">
	  <div class="row">
        <form class="form-horizontal" id="uye_ol" name="uye_ol" method="post">
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Ad-Soyad</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" id="txAdSoyad" name="txAdSoyad" placeholder="Ad-Soyad Giriniz" required>
    </div>
  </div>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">Fakülte</label>
    <div class="col-sm-10">
      <select name="fakulte" id="fakulte" onChange="uye_fakultesec()">
	  <option>Seçiniz...</option>
	  <?php
	  $sorgu=mysql_query("SELECT * FROM tbl_fakulte order by id");
	while($sorgusql=mysql_fetch_array($sorgu)){
		echo'<option value="'.$sorgusql["id"].'">'.$sorgusql["fakulte_isim"].'</option>';
	}
	?>
	</select>
    </div>
  </div>
  <div class="form-group ">
    <label for="inputPassword3" class="col-sm-2 control-label">Bölüm</label>
    <div class="col-sm-10 uye_option">
    </div>
  </div>
   <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">E-Mail</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="txEmail" name ="txEmail" placeholder="E-Mail Giriniz" required>
    </div>
  </div>
   <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Şifre</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="txSifre" name="txSifre" placeholder="Şifre Giriniz" required>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" id="btUyeOl" name="btUyeOl">Üye Ol</button>
    </div>
  </div>
  <br/>
  <br/>
</form>

</div>
      </div>
    </div>
  </div>
</div>
<script src="/js/jquery-2.2.0.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/tr_TR/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script>
$(document).ready(function(){
		var genislik=$( "#profil_kisim" ).width();
         $("#sag_taraf li").css({"width": genislik});
		});
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
<script>
	$(document).ready(function(){
      $('body').append('<div id="toTop"><i class="fa fa-chevron-up"></i></div>');
    	$(window).scroll(function () {
			if ($(this).scrollTop() != 0) {
				$('#toTop').fadeIn();
			} else {
				$('#toTop').fadeOut();
			}
		}); 
    $('#toTop').click(function(){
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });
});
</script>
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-74723867-1', 'auto');
  ga('send', 'pageview');

</script>
</body>
</html>