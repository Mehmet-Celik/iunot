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
<div class="row" style="margin-top:250px;">
<div class="well center-block" style="max-width:500px;">
<div style="font-family: 'Roboto', sans-serif;"><center><h3>Admin Paneli İçin Giriş Yapınız</h3></div>
</br>
	<form class="form-horizontal" id="login" name="login" method="post" action="">
  <div class="form-group">
    <label for="txEmail" class="col-sm-2 control-label">Id</label>
    <div class="col-sm-10">
      <input type="email" class="form-control" id="txEmail" name ="txEmail" placeholder="E mail">
    </div>
  </div>
  <div class="form-group">
    <label for="txSifre" class="col-sm-2 control-label">Password</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" id="txSifre" name="txSifre" placeholder="Şifre">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <div class="checkbox">
        <label>
          <input type="checkbox"> Beni Hatırla
        </label>
      </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default" id="btGiris" name="btGiris">Giriş</button>
    </div>
  </div>
</form>
</div>
</div>
<?php 
	if(isset($_POST["btGiris"])){
		$email=guvenlik($_POST["txEmail"]);
		$sifre=guvenlik(md5($_POST["txSifre"]));
		$sorgu=mysql_query("SELECT * FROM tbl_uye WHERE uye_email='$email' and uye_sifre='$sifre'");
		$uyegiris=mysql_fetch_array($sorgu);
		if(mysql_num_rows($sorgu)!=0){
			if($uyegiris["uye_yetki"]!=0){
				$_SESSION["Email"]=$uyegiris["uye_email"];
				$_SESSION["id"]=$uyegiris["id"];
				header("Location:adminpanel.php");
			}
			else{
				header("Location:login.php");
			}
		}
		
	}

?>
<script src="../js/jquery-2.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</body>
</html>