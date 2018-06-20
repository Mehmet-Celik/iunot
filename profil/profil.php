<?php
echo'
	<div class="col-md-7">
		<div style="border:1px solid #c0c0c0;border-radius:5px;">
		  <ul class="nav nav-tabs" role="tablist" >';
		  if($_SESSION["id"]==guvenlik($_GET["profil"])){
			  echo'
			<li role="presentation" class="active"><a href="#profilim" aria-controls="profilim" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Profilim</a></li>
			<li role="presentation"><a href="#mesaj" aria-controls="mesaj" role="tab" data-toggle="tab"><i class="fa fa-envelope"></i> Mesajlarım</a></li>
			<li role="presentation"><a href="#derslerim" aria-controls="derslerim" role="tab" data-toggle="tab"><i class="fa fa-book"></i> Derslerim</a></li>
			<li role="presentation"><a href="#soru_cevap" aria-controls="soru_cevap" role="tab" data-toggle="tab"><i class="fa fa-comment"></i> Sorduğum Sorular</a></li>
			<li role="presentation" class="navbar-right" style="margin-right:-2px;"><a href="#ders_duzenle" aria-controls="ders_duzenle" role="tab" data-toggle="tab"><i class="fa fa-book"></i> Derslerimi Düzenle</a></li>
			<li role="presentation" class="navbar-right" style="margin-right:-2px;"><a href="#profil_duzenle" aria-controls="profil_duzenle" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Profili Düzenle</a></li>
		  </ul>
		  <div class="tab-content" style="padding:10px;">
			<div role="tabpanel" class="tab-pane fade in active" id="profilim">'; include("profil_icerik.php"); echo '</div>
			<div role="tabpanel" class="tab-pane fade" id="mesaj">'; include("mesaj_icerik.php"); echo '</div>
			<div role="tabpanel" class="tab-pane fade" id="derslerim"><div class="alert alert-warning" role="alert">Bu Sayfa Yapım Aşamasındadır !</div></div>
			<div role="tabpanel" class="tab-pane fade" id="soru_cevap">'; include("sordugu_sorular.php"); echo'</div>
			<div role="tabpanel" class="tab-pane fade" id="profil_duzenle">'; include("profil_duzenle.php"); echo'</div>
			<div role="tabpanel" class="tab-pane fade" id="ders_duzenle"><div class="alert alert-warning" role="alert">Bu Sayfa Yapım Aşamasındadır !</div></div>
		  </div>
		</div>
	</div>
	';
		  }
		  else{
			  echo'
			  <li role="presentation" class="active"><a href="#profilim" aria-controls="profilim" role="tab" data-toggle="tab"><i class="fa fa-user"></i> Profil Bilgileri</a></li>
			  <li role="presentation"><a href="#mesaj" aria-controls="mesaj" role="tab" data-toggle="tab"><i class="fa fa-envelope"></i> Mesaj Yaz</a></li>
			  <li role="presentation"><a href="#sorulari" aria-controls="sorulari" role="tab" data-toggle="tab"><i class="fa fa-comment"></i> Sorduğu Sorular</a></li>
			  </ul>
			  <div class="tab-content" style="padding:10px;">
			<div role="tabpanel" class="tab-pane fade in active" id="profilim">'; include("profil_icerik.php"); echo '</div>
			<div role="tabpanel" class="tab-pane fade" id="mesaj">'; include("profilden_mesaj_yaz.php"); echo '</div>
			<div role="tabpanel" class="tab-pane fade" id="sorulari">'; include("sordugu_sorular.php"); echo'</div>
			</div>
		</div>
	</div>
			  ';
		  }
		  
?>