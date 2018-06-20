<?php
if(guvenlik(isset($_GET["iletisim"]))){
	include("iletisim.php");
}else if(isset($_POST["btAra"])){
	include("arama.php");
}
else if(guvenlik(isset($_GET["profil"]))){
	if(isset($_SESSION["id"])){
		include("profil/profil.php");
	}
	else{
		
		echo '<div class="col-md-7">
		<div class="alert alert-danger" role="alert">Profili Görebilmek İçin Lütfen Giriş Yapınız.</div></div>';
		echo '<meta http-equiv="refresh" content="2;URL=index.php">';
	}
}
else if(guvenlik(isset($_GET["soru_cevap"]))){
	include("soru_cevap.php");
}
else if(guvenlik(isset($_GET["dersler"]))){
	include("notlar/notlar.php");
}
else{/* AnaSAyfa icerigi*/
	echo'
	 <div style="padding-left:40px;" class="col-md-7">
		<div style="margin-right:15px;" id="carousel-example-generic" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';
	$sorguslider=mysql_query("select * from tbl_slider where goruntulenme=1 order by id limit 1,100");
	$sayac=1;
	while($slidersql=mysql_fetch_array($sorguslider)){
	echo'
    <li data-target="#carousel-example-generic" data-slide-to="'.$sayac.'"></li>';$sayac++;
	}
	echo'
  </ol>
  <div class="carousel-inner" role="listbox">
  ';
  $sorgusliderfirst=mysql_query("select * from tbl_slider where goruntulenme=1 order by id limit 0,1");
  $slidersqlfirst=mysql_fetch_array($sorgusliderfirst);
  echo'
    <div class="item active">
      <img src="'.$slidersqlfirst["slider_dosya_yolu"].'" alt="'.$slidersqlfirst["slider_isim"].'">
    </div>';
	$sorguslider=mysql_query("select * from tbl_slider where goruntulenme=1 order by id limit 1,100");
	
	while($slidersql=mysql_fetch_array($sorguslider)){
		echo'
			<div class="item">
			  <img src="'.$slidersql["slider_dosya_yolu"].'" alt="'.$slidersql["slider_isim"].'">
			</div>';
	}
	
echo'	
  </div>
  <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<div class="row konular">
  <div>
    <center><h3><i class="fa fa-clock-o"></i> Son Eklenen Konular</h3></center>
  </div>
  <hr/>
  ';include("notlar/son_eklenen_notlar.php");
  echo'
</div>
<div class="row konular">
  <div>
    <center><h3><i class="fa fa-star-o"></i> En Popüler Konular</h3></center>
  </div>
  <hr/>
  ';include("notlar/populer_notlar.php");
  echo'
</div>
<div class="row bilgi">
	<div class="col-xs-12 col-md-3 bordersag">
		<center><h1><i class="fa fa-archive"></i></i></p><h1/></center>
		<center><h3>Not Arşivi</h3></center>
		<center><p>Merhaba madur öğrenci arkadaş, sabahları sıcacık yatağından 
		çıkmak istemeyip gitmediğin dersin sınavı mı yaklaşıyor? Lafı nasıl dolandırsam da not istesem diye mi düşünüyorsun? 
		Uğraşma bunlarla, gel burada istemediğin kadar çok not var.</p></center>
	</div>
  <div class="col-xs-12 col-md-3 bordersag">
		<center><h1><i class="fa fa-search"></i></p><h1/></center>
		<center><h3>Not Takip</h3></center>
		<center><p>Not derdine düşüp de harıl harıl aradığın notları bir türlü bulamadığın zaman biz imdadına koşuyoruz. 
		Sitemizde notlara erişebilmen adeta çocuk oyuncağı. 
		Ayrıyetten not peşinde koşmana gerek yok biz sosyal platformlardan sana ulaştırıyoruz. Takipte kal.</p></center>
  </div>
  <div class="col-xs-12 col-md-3 bordersag">
		<center><h1><i class="fa fa-bullhorn"></i></p><h1/></center>
		<center><h3>Güncel Duyurular</h3></center>
		<center><p>Dersin iptal olduğunu okula gidince öğrenmek istemiyorsan, 
		sürekli duyuru sayfasına girip kontrol edecek vaktin yoksa tam olarak 
		doğru adrese geldin. Güncel duyuruları buradan hızlı ve kolay bir şekilde takip edebilirsin. Biz senin için buradayız.</p></center>
  </div>
  <div class="col-xs-12 col-md-3">
		<center><h1><i class="fa fa-question"></i></p><h1/></center>
		<center><h3>Soru/Cevap</h3></center>
		<center><p>Ders calışmaktan daha cok zorlandığımız bir nokta var ki o da kafamıza takılan sorular. 
		Bu soru işaretlerini temizleyebilmek için sana yardımcı olmaya hazırız. Aradığın her soruya burada kolayca cevap 
		bulabilirsin.</p></center>
  </div>
</div>
<br/>
		</div>
		
	 ';
}

 ?>
