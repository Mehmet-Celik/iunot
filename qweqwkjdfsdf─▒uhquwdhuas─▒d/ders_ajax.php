<?php include('../includes/config.php'); ?>
<select name="ders" id="ders" onChange="derssec()">
<option>Seçiniz...</option>
        	    <?php 
				$secilen_bolum_id=$_GET["bolum_id"];
				$sorgu=mysql_query("SELECT * FROM tbl_ders  WHERE bolum_id='$secilen_bolum_id'");
				
				while($bolumsql=mysql_fetch_array($sorgu))
				{
					echo
					'
					<option value="'.$bolumsql["id"].'">'.$bolumsql["ders_isim"].'</option>
					';
				}
				?>
  </select>
      	      