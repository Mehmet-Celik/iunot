<?php
	echo '
	<div style="border:1px solid #c0c0c0;border-radius:5px;">
		  <ul class="nav nav-tabs" role="tablist" >
			<li role="presentation" class="active"><a href="#gelenkutusu" aria-controls="gelenkutusu" role="tab" data-toggle="tab"><i class="fa fa-envelope-o"></i> Gelen Kutusu</a></li>
			<li role="presentation"><a href="#gidenkutusu" aria-controls="gidenkutusu" role="tab" data-toggle="tab"><i class="fa fa-envelope-o"></i> Giden Kutusu</a></li>
			<li role="presentation"><a href="#mesajyaz" aria-controls="mesajyaz" role="tab" data-toggle="tab"><i class="fa fa-pencil"></i> Mesaj Yaz</a></li>
			<li role="presentation"><a href="#engelleme" aria-controls="engelleme" role="tab" data-toggle="tab"><i class="fa fa-ban"></i> Engellenenler Listesi</a></li>
		  </ul>
		  <div class="tab-content" style="padding:10px;">
			<div role="tabpanel" class="tab-pane fade in active" id="gelenkutusu">'; include("mesajlar/gelenkutusu.php"); echo'</div>
			<div role="tabpanel" class="tab-pane fade" id="gidenkutusu">'; include("mesajlar/gidenkutusu.php"); echo'</div>
			<div role="tabpanel" class="tab-pane fade" id="mesajyaz">'; include("mesajlar/mesajyaz.php"); echo'</div>
			<div role="tabpanel" class="tab-pane fade" id="engelleme"><div class="alert alert-warning" role="alert">Bu Sayfa Yapım Aşamasındadır !</div></div>
		  </div>
	</div>
	
	';
?>
		