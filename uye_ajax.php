<?php include('includes/config.php'); ?>
<select name="bolum" id="bolum" onChange="bolumsec()">
        	    <?php 
				$secilen_fakulte_id=$_GET["fakulte_id"];
				$sorgu=mysql_query("SELECT * FROM tbl_bolum  WHERE fakulte_id='$secilen_fakulte_id'");
				
				while($fakultesql=mysql_fetch_array($sorgu))
				{
					echo
					'
					<option value="'.$fakultesql["id"].'">'.$fakultesql["bolum"].'</option>
					';
				}
				?>
  </select>
      	      