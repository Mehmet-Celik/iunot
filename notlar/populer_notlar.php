<?php
				$notlarsorgu=mysql_query("select * from tbl_not order by hit desc limit 0,4");
				while($notlarsql=mysql_fetch_array($notlarsorgu)){
					$dersid=$notlarsql["ders_id"];
					$dersorgu=mysql_query("select * from tbl_ders where id='$dersid'");
					$derssql=mysql_fetch_array($dersorgu);
					$dersisim=$derssql["ders_isim"];
					$bolumid=$derssql["bolum_id"];
					
					$bolumsorgu=mysql_query("select * from tbl_bolum where id='$bolumid'");
					$bolumsql=mysql_fetch_array($bolumsorgu);
					$fakulte_id=$bolumsql["fakulte_id"];
					$fakultesorgu=mysql_query("select * from tbl_fakulte where id='$fakulte_id'");
					$fakultesql=mysql_fetch_array($fakultesorgu);
					
					
					echo'
					<div class="col-xs-12 col-md-3">
					<div class="note-border"></div>
				<center><a href="/'.tr_duzelt($fakultesql["fakulte_isim"]).'/'.tr_duzelt($bolumsql["bolum"]).'/'.tr_duzelt($notlarsql["not_baslik"]).'/'.$bolumid.'/'.$dersid.'/'.$notlarsql["id"].'" class="thumbnail">
					<p><i class="fa fa-sticky-note"></i> '.$notlarsql["not_baslik"].'</p>
				<br/>
				<p><i class="fa fa-book"></i> '.$dersisim.'</p>
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
?>