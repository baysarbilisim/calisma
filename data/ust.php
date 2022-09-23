<header class="version_1">
	<div class="layer"></div><!-- Mobile menu overlay mask -->
	<div class="main_header">
		<div class="container">
			<div class="row small-gutters">
				<div class="col-xl-3 col-lg-3 d-lg-flex align-items-center">
					<div id="logo">
						<a href="<?=SITE?>"><img src="<?=SITE?>img/logo2.jpg" alt="" width="100" height="35"></a>
					</div>
				</div>

				<nav class="col-xl-6 col-lg-7">
					
					<a class="open_close" href="javascript:void(0);">
						<div class="hamburger hamburger--spin">
							<div class="hamburger-box">
								<div class="hamburger-inner"></div>
							</div>
						</div>
					</a>
		
					<!-- Mobile menu button -->
					<div class="main-menu">
						<div id="header_menu">
							<a href="<?=SITE?>"><img src="<?=SITE?>img/logo2.jpg" alt="" width="100" height="35"></a>
							<a href="#" class="open_close" id="close_in"><i class="ti-close"></i></a>
						</div>
						<ul>
							<li><a href="<?=SITE?>">Ana Sayfa</a></li>

							<li class="submenu">
								<a href="javascript:void(0);" class="show-submenu">Kurumsal</a>
								<ul>
									<?php 
									$kurumsal=$VT->VeriGetir("kurumsal","WHERE durum=?",array(1),"ORDER BY sirano ASC");
									if ($kurumsal!=false) {
										for ($i=0; $i < count($kurumsal); $i++) { ?>
											<li><a href="<?=SITE?>kurumsal/<?=$kurumsal[$i]["seflink"]?>"><?=stripslashes($kurumsal[$i]["baslik"])?></a></li>
							<?php			}
									}
									 ?>
									
								
								</ul>
							</li>

							<li class="submenu">
								<a href="javascript:void(0);" class="show-submenu">Gizlilik ve Kullanım</a>
								<ul>
									<?php 
									$gizlilikvekullanim=$VT->VeriGetir("gizlilikpolitikasi","WHERE durum=?",array(1),"ORDER BY sirano ASC");
									if ($gizlilikvekullanim!=false) {
										for ($i=0; $i < count($gizlilikvekullanim); $i++) { ?>
											<li><a href="<?=SITE?>gizlilik-politikasi/<?=$gizlilikvekullanim[$i]["seflink"]?>"><?=stripslashes($gizlilikvekullanim[$i]["baslik"])?></a></li>
							<?php			}
									}
									 ?>
									
								
								</ul>
							</li>

							<li><a href="<?=SITE?>blog">Blog</a></li>
							<li><a href="<?=SITE?>iletisim">İletişim</a></li>
						</ul>
					</div>
					<!--/main-menu -->
				</nav>
				
			</div>
			<!-- /row -->
		</div>
	</div>
	<!-- /main_header -->

	<div class="main_nav Sticky">
		<div class="container">
			<div class="row small-gutters">
				<div class="col-xl-3 col-lg-3 col-md-3">
					<nav class="categories">
						<ul class="clearfix">
							<li><span>
								<a href="#">
									<span class="hamburger hamburger--spin">
										<span class="hamburger-box">
											<span class="hamburger-inner"></span>
										</span>
									</span>
									Kategoriler
								</a>
							</span>
							<div id="menu">
								<ul>
									<?php
									$kategoriler=$VT->VeriGetir("kategoriler","WHERE durum=? AND tablo=?",array(1,"urunler"),"ORDER BY sirano ASC");
									if($kategoriler!=false){
										for ($i=0; $i <count($kategoriler) ; $i++) { ?>
											<li><span><a href="<?=SITE?>kategori/<?=$kategoriler[$i]["seflink"]?>"><?=stripslashes($kategoriler[$i]["baslik"])?></a></span>
												<?php 
												$altkategoriler=$VT->VeriGetir("kategoriler","WHERE durum=? AND tablo=?",array(1,$kategoriler[$i]["seflink"]),"ORDER BY sirano ASC");
												if($altkategoriler!=false){
													echo "<ul>";
													for ($j=0; $j <count($altkategoriler) ; $j++) { ?>

														<li><a href="<?=SITE?>kategori/<?=$altkategoriler[$j]["seflink"]?>"><?=stripslashes($altkategoriler[$j]["baslik"])?></a></li>
											<?php }
													echo "</ul>";
												}
												?>
											</li>

										<?php			}

									}
									?>

										
								</ul>
							</div>
						</li>
					</ul>
				</nav>
			</div>

			<div class="col-xl-6 col-lg-7 col-md-6 d-none d-md-block">
				<form action="<?=SITE?>arama" method="POST">
					<div class="custom-search-input">
					<input type="text" name="aranan" placeholder="Ürün Ara...">
					<button type="submit"><i class="header-icon_search_custom"></i></button>
				</div>
				</form>
				
			</div>

			<div class="col-xl-2 col-lg-2 col-md-3">
				<ul class="top_tools">
					<li>
						<div class="dropdown dropdown-cart">
							<a href="<?=SITE?>sepet" class="cart_bt">
								<strong><?php if (!empty($_SESSION["sepet"])) {
								echo count($_SESSION['sepet']);
							} ?></strong>
							</a>

							<div class="dropdown-menu">
								<div class="total_drop">
									<a href="<?=SITE?>sepet" class="btn_1 outline">Sepete Git</a>
								</div>
							</div>

						</div>
						<!-- /dropdown-cart-->
					</li>
					<!--
					<li>
						<a href="#0" class="wishlist"><span>Wishlist</span></a>
					</li>
					-->
					<li>
						<div class="dropdown dropdown-access">
							<a href="<?=SITE?>uyelik" class="access_link"><span>Üyelik</span></a>
							<div class="dropdown-menu">
								<?php 
								if (!empty($_SESSION['uyeID'])) {
									echo "Hoşgeldiniz ".$_SESSION['uyeAdi'];
								}else{?>
								<a href="<?=SITE?>uyelik" class="btn_1">Giriş Yap veya Üye Ol</a>

							<?php 	}
								 ?>
								<ul>
									<li>
										<a href="<?=SITE?>siparis-takip"><i class="ti-truck"></i>Sipariş Takibi</a>
									</li>
									<?php 
								if (!empty($_SESSION['uyeID'])) {?>
									<li>
										<a href="<?=SITE?>siparislerim"><i class="ti-package"></i>Siparişlerim</a>
									</li>
									<li>
										<a href="<?=SITE?>hesabim"><i class="ti-user"></i>Hesabım</a>
									</li>
									<li>
										<a href="<?=SITE?>cikis-yap"><i class="ti-power-off"></i>Güvenli Çıkış</a>
									</li>
							<?php 	}?>
									
								
								</ul>
							</div>
						</div>
						<!-- /dropdown-access-->
					</li>
					
					<li>
						<a href="javascript:void(0);" class="btn_search_mob"><span>Ara</span></a>
					</li>
					
					<li>
						<a href="#menu" class="btn_cat_mob">
							<div class="hamburger hamburger--spin" id="hamburger">
								<div class="hamburger-box">
									<div class="hamburger-inner"></div>
								</div>
							</div>
							Kategoriler
						</a>
					</li>
		
				</ul>
			</div>
		</div>
		<!-- /row -->
	</div>
	
	<form action="<?=SITE?>arama" method="POST">
	<div class="search_mob_wp">
		<input type="text" name="aranan" class="form-control" placeholder="Ürün Ara...">
		<input type="submit" class="btn_1 full-width" value="Search">
	</div>
	</form>

	<!-- /search_mobile -->
</div>
<!-- /main_nav -->
</header>
	<!-- /header -->