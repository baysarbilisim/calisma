<?php
	$altbilgi=$VT->VeriGetir("ayarlar","WHERE ID=?",array(1));
	if ($altbilgi!=false) { ?>
		<footer class="revealed">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-6">
					<h3 data-target="#collapse_1">Hızlı Bağlantı</h3>
					<div class="collapse dont-collapse-sm links" id="collapse_1">
						<ul>
							<li><a href="<?=SITE?>kurumsal/hakkimizda">Hakkımızda</a></li>
							<li><a href="<?=SITE?>gizlilik-politikasi/uyelik-sozlesmesi">Üyelik Sözleşmesi</a></li>
							<li><a href="<?=SITE?>hesabim">Hesabım</a></li>
							<li><a href="<?=SITE?>blog">Blog</a></li>
							<li><a href="<?=SITE?>#0">İletişim</a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<h3 data-target="#collapse_2">Kategoriler</h3>
					<div class="collapse dont-collapse-sm links" id="collapse_2">
						<ul>
							<?php
					$kategoriler=$VT->VeriGetir("kategoriler","WHERE durum=? AND tablo=?",array(1,"urunler"),"ORDER BY sirano ASC");
						if($kategoriler!=false){
							for ($i=0; $i <count($kategoriler) ; $i++) { ?>
							
							<li><a href="<?=SITE?>kategori/<?=stripslashes($kategoriler[$i]["seflink"])?>"><?=stripslashes($kategoriler[$i]["baslik"])?></a></li>

							<?php
						}
					}
							?>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
						<h3 data-target="#collapse_3">İletişim</h3>
					<div class="collapse dont-collapse-sm contacts" id="collapse_3">
						<ul>
							<li><i class="ti-home"></i><?=$altbilgi[0]["adres"]?><br>Türkiye</li>
							<li><i class="ti-headphone-alt"></i><?=$altbilgi[0]["telefon"]?></li>
							<li><i class="ti-email"></i><a href="#0"><?=$altbilgi[0]["mail"]?></a></li>
						</ul>
					</div>
				</div>
				<div class="col-lg-3 col-md-6">
					<!--	<h3 data-target="#collapse_4">Keep in touch</h3>-->
					<div class="collapse dont-collapse-sm" id="collapse_4">
						<!--
						<div id="newsletter">
						    <div class="form-group">
						        <input type="email" name="email_newsletter" id="email_newsletter" class="form-control" placeholder="Your email">
						        <button type="submit" id="submit-newsletter"><i class="ti-angle-double-right"></i></button>
						    </div>
						</div>
						-->
						<div class="follow_us">
							<h5>Bizi Takip Edin</h5>
							<ul>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=SITE?>img/twitter_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=SITE?>img/facebook_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=SITE?>img/instagram_icon.svg" alt="" class="lazy"></a></li>
								<li><a href="#0"><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=SITE?>img/youtube_icon.svg" alt="" class="lazy"></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
			<!-- /row-->
			<hr>
			<div class="row add_bottom_25">
				<div class="col-lg-6">
					<ul class="footer-selector clearfix">
						<li><img src="data:image/gif;base64,R0lGODlhAQABAIAAAP///wAAACH5BAEAAAAALAAAAAABAAEAAAICRAEAOw==" data-src="<?=SITE?>img/cards_all.svg" alt="" width="198" height="30" class="lazy"></li>
					</ul>
				</div>
				<div class="col-lg-6">
					<ul class="additional_links">
						<li><a href="<?=SITE?>gizlilik-politikasi/uyelik-sozlesmesi">Gizlilik ve Kullanım</a></li>
						<li ><span><a href="https://baysarbilisim.com">© 2021 Baysar</a></span></li>
					</ul>
				</div>
			</div>
		</div>
	</footer>
	<!--/footer-->
<?php	}
?>
