<?php

if(guvenlik(isset($_GET["slider"]))){
	$sorgu=mysql_query("SELECT * FROM tbl_slider order by id");
	echo '<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-list-ul"></i> Slider Listele</div>
  <table class="table">
  <thead>
  <tr>
  <th>Slider id</th>
  <th>Slider İsim</th>
  <th>Slider Resim</th>  
  <th>Görüntülenme</th> 
  </tr>
  </thead>
  <tbody>';
  while($slider_listesi=mysql_fetch_array($sorgu)){
	  $dosya_yolu=$slider_listesi["slider_dosya_yolu"];
	  $sliderisim=$slider_listesi["slider_isim"];
	  $sliderid=$slider_listesi["id"];
	  if($slider_listesi["goruntulenme"]==0){
		  $goruntuleme='<a href="adminpanel.php?slider&slider_goruntulenme='.$slider_listesi["id"].'"><i class="fa fa-eye-slash"></i> Yayınlanmıyor</a>';
	  }
	  else{
		  $goruntuleme='<a href="adminpanel.php?slider&slider_goruntulenme='.$slider_listesi["id"].'"><i class="fa fa-eye"></i> Yayınlanıyor</a>';
	  }
	echo ' <tr>
	<th scope="row">'.$slider_listesi["id"].'</th>
	<td>'.$slider_listesi["slider_isim"].'</td>
	<td><a href="#" data-toggle="modal" data-target="#myModal_'.$sliderid.'" >Resim</a></td>
	<td>'.$goruntuleme.'</td>
  </tr>'; 
    echo ' <div class="modal fade" id="myModal_'.$sliderid.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background-color:#444444;color:#fff;">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel5">'.$sliderisim.'</h4>
      </div>
      <div class="modal-body">
		<img src="../'.$dosya_yolu.'" class="img-responsive" alt="'.$sliderisim.'">
  </div>
</div>
      </div>
    </div>';
  }
  if(guvenlik(isset($_GET["slider_goruntulenme"]))){
	  $slider_id=guvenlik($_GET["slider_goruntulenme"]);
	  $sorgu=mysql_query("SELECT * FROM tbl_slider  where id='$slider_id'");
	  $sorgusql=mysql_fetch_array($sorgu);
	  $goster=$sorgusql["goruntulenme"];
		if($goster==0){
			$gosteriguncelle=mysql_query("UPDATE tbl_slider SET goruntulenme='1' where id='$slider_id'");
		}
		else{
			$gosteriguncelle=mysql_query("UPDATE tbl_slider SET goruntulenme='0' where id='$slider_id'");
		}
		if($gosteriguncelle){
			echo '<meta http-equiv="refresh" content="0;URL=adminpanel.php?slider">';
		}
		else{
			echo '<div class="alert alert-danger" role="alert">Görüntüleme Hatası ! </div>';
		}
}
   
  
  echo '</tbody> </table>
</div>';

}

 ?>