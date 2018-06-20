<?php

if(guvenlik(isset($_GET["mesaj_listele"]))){
	$sorgu=mysql_query("SELECT * FROM tbl_iletisim order by id desc");
	echo '<div class="panel panel-default">
  <div class="panel-heading"><i class="fa fa-list-ul"></i> Mesajlarım</div>
  <table class="table">
  <thead>
  <tr>
  <th>Mesaj İd</th>
  <th>İsim Soyisim</th> 
  <th>Fakülte</th> 
  <th>Bölüm</th> 
  <th>E-posta</th> 
  <th>Konu</th> 
  </tr>
  </thead>
  <tbody>';
  while($mesaj_listesi=mysql_fetch_array($sorgu)){
	echo ' 
	<tr>
	<td>'.$mesaj_listesi["id"].'</td>
	<td>'.$mesaj_listesi["msjAdSoyad"].'</td>
	<td>'.$mesaj_listesi["msjFakulte"].'</td>
	<td>'.$mesaj_listesi["msjBolum"].'</td>
	<td>'.$mesaj_listesi["msjEposta"].'</td>
	<td>'.$mesaj_listesi["msjKonu"].'</td></tr>
	<tr><td colspan=6> <b>Mesajı : </b>  '.$mesaj_listesi["msjMesaj"].'</td></tr>
	'; 
  }
    
  echo '
		</tbody> </table>
	</div>';

}

 ?>