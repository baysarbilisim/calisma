<main>
	<div id="carousel-home">
		<div class="owl-carousel owl-theme">
			<?php
			$banner=$VT->VeriGetir("banner","WHERE durum=?", array(1),"ORDER BY sirano ASC");
			if($banner!=false){
				for ($i=0; $i < count($banner); $i++) { ?>

					<div class="owl-slide cover" style="background-image: url(<?=SITE?>images/banner/<?=$banner[$i]["resim"]?>);">
						<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0)">
							<div class="container">
								<div class="row justify-content-center justify-content-md-start">
									<div class="col-lg-6 static">
										<div class="slide-text">
											<h2 class="owl-slide-animated owl-slide-title" style="text-transform: none;"><?=stripslashes($banner[$i]["baslik"])?></h2>
											<p class="owl-slide-animated owl-slide-subtitle">
												<?=stripslashes($banner[$i]["aciklama"])?>
											</p>
											<?php
												if(!empty($banner[$i]["url"])){ ?>
										<div class="owl-slide-animated owl-slide-cta"><a class="btn_1" href="<?=$banner[$i]["url"]?>" role="button">İncele</a></div>
										<?php	}
											?>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				<?php		}
			}
			?>
			<!--/owl-slide-->

			<!--/owl-slide-->

		</div>
		<div id="icon_drag_mobile"></div>
	</div>
	<!--/carousel-->

	<ul id="banners_grid" class="clearfix">

		<?php
			$secilenkategoriler=$VT->VeriGetir("kategoriler","WHERE durum=? AND tablo=?",array(1,"urunler"),"ORDER BY RAND() ASC",3);
			if($secilenkategoriler!=false){
				for ($i=0; $i <count($secilenkategoriler) ; $i++) { ?>
					 
		<li>
			<a href="<?=SITE?>kategori/<?=$secilenkategoriler[$i]["seflink"]?>" class="img_container">
				<img src="<?=SITE?>images/kategoriler/<?=$secilenkategoriler[$i]["resim"]?>" data-src="<?=SITE?>images/kategoriler/<?=$secilenkategoriler[$i]["resim"]?>" alt="<?=stripslashes($secilenkategoriler[$i]["baslik"])?>" class="lazy">
				<div class="short_info opacity-mask" data-opacity-mask="rgba(0, 0, 0, 0.5)">
					<h3><?=stripslashes($secilenkategoriler[$i]["baslik"])?></h3>
					<div><span class="btn_1">Alışverişe Başla</span></div>
				</div>
			</a>
		</li>

		<?php		}
			}
		?>

	</ul>
	<!--/banners_grid -->

<div class="container margin_60_35">
		<div class="main_title">
			<h2>Vitrin Ürünlerimiz</h2>
			<p>Size Özel Vitrin Ürünlerimiz Keşfedin</p>
		</div>
		<div class="owl-carousel owl-theme products_carousel">

			<?php
				$urunler=$VT->VeriGetir("urunler","WHERE durum=? AND vitrindurum=?",array(1,1),"ORDER BY sirano ASC");
				if($urunler!=false){
					for ($i=0; $i <count($urunler) ; $i++) {  ?>
						
						<div class="item">
				<div class="grid_item">
					<figure>
						<?php
						if(!empty($urunler[$i]["indirimlifiyat"])){
						$indirimlifiyat=$urunler[$i]["indirimlifiyat"].".".$urunler[$i]["indirimlikurus"]; 
						$normalfiyat=$urunler[$i]["fiyat"].".".$urunler[$i]["kurus"]; 

						$hesapla=(($indirimlifiyat/$normalfiyat)*100);
						$indirimorani=(100-$hesapla);
						?>

							<span class="ribbon off">%<?=round($indirimorani)?> İndirimli</span>
					<?php	}?>
					
						<a href="<?=SITE?>urun/<?=$urunler[$i]["seflink"]?>">
							<img class="owl-lazy" src="<?=SITE?>images/urunler/<?=$urunler[$i]["resim"]?>" data-src="<?=SITE?>images/urunler/<?=$urunler[$i]["resim"]?>" alt="<?=stripslashes($urunler[$i]["baslik"])?>" style="border: 0; box-shadow: 0 2px 6px 0; height: 250px; width: 250px;">
						</a>
					</figure>
					<!--<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div> -->
					<a href="<?=SITE?>urun/<?=$urunler[$i]["seflink"]?>">
						<h3><?=stripslashes($urunler[$i]["baslik"])?></h3>
					</a>

			<div class="price_box">
	                <?php

					if(!empty($urunler[$i]["indirimlifiyat"])){
					$indirimlifiyat=$urunler[$i]["indirimlifiyat"].".".$urunler[$i]["indirimlikurus"];
					$fiyat=$urunler[$i]["fiyat"].".".$urunler[$i]["kurus"];
 					?>

				<span class="new_price"><?=number_format($indirimlifiyat,2,",",".")?> TL</span><br>
				<span class="old_price"><?=number_format($fiyat,2,",",".")?> TL</span>

				<?php

				}else{
					$fiyat=$urunler[$i]["fiyat"].".".$urunler[$i]["kurus"];
				 ?>

				<span class="new_price"><?=number_format($fiyat,2,",",".")?> TL</span>

		<?php			}
						?>
	        </div>

				</div>
				<!-- /grid_item -->
			</div>
			<!-- /item -->

			<?php		}
				}
			?>
		</div>
		<!-- /products_carousel -->
	
</div>
	<!-- /container -->


	
	<!-- /container -->

	<div class="featured lazy" data-bg="url(img/orta.jpg)">
		<!--
		<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.5)">
			<div class="container margin_60">
				<div class="row justify-content-center justify-content-md-start">
					<div class="col-lg-6 wow" data-wow-offset="150">
						<h3>Armor<br>Air Color 720</h3>
						<p>Lightweight cushioning and durable support with a Phylon midsole</p>
						<div class="feat_text_block">
							<div class="price_box">
								<span class="new_price">$90.00</span>
								<span class="old_price">$170.00</span>
							</div>
							<a class="btn_1" href="listing-grid-1-full.html" role="button">Shop Now</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	-->
	</div>
	<!-- /featured -->


	<div class="container margin_60_35">

		<div class="main_title">
			<h2>Sizin İçin Seçtiklerimiz!</h2>
			<p>Sizin İçin Hazırladığımız Fırsatları Kaçırmayın.</p>
		</div>
		<div class="row small-gutters">
			<?php
				$urunler=$VT->VeriGetir("urunler","WHERE durum=? ",array(1),"ORDER BY RAND() ASC",8);
				if($urunler!=false){
					for ($i=0; $i <count($urunler) ; $i++) {  ?>

				<div class="col-6 col-md-4 col-xl-3">
				<div class="grid_item">
					<figure>
						<?php
						if(!empty($urunler[$i]["indirimlifiyat"])){
						$indirimlifiyat=$urunler[$i]["indirimlifiyat"].".".$urunler[$i]["indirimlikurus"]; 
						$normalfiyat=$urunler[$i]["fiyat"].".".$urunler[$i]["kurus"]; 

						$hesapla=(($indirimlifiyat/$normalfiyat)*100);
						$indirimorani=(100-$hesapla);
						?>

							<span class="ribbon off">%<?=round($indirimorani)?> İndirimli</span>
					<?php	}?>
						
						<a href="<?=SITE?>urun/<?=$urunler[$i]["seflink"]?>">
							<img class="img-fluid lazy" src="<?=SITE?>images/urunler/<?=$urunler[$i]["resim"]?>" data-src="<?=SITE?>images/urunler/<?=$urunler[$i]["resim"]?>" alt="<?=stripslashes($urunler[$i]["baslik"])?>" style="border: 0; box-shadow: 0 2px 6px 0; height: 250px; width: 250px;">
						</a>
	
					</figure>

					<a href="<?=SITE?>/urun/<?=$urunler[$i]["seflink"]?>">
						<h3><?=stripslashes($urunler[$i]["baslik"])?></h3>
					</a>
					
					<div class="price_box">

	        <?php

					if(!empty($urunler[$i]["indirimlifiyat"])){
					$indirimlifiyat=$urunler[$i]["indirimlifiyat"].".".$urunler[$i]["indirimlikurus"];
					$fiyat=$urunler[$i]["fiyat"].".".$urunler[$i]["kurus"];
 					?>

				<span class="new_price"><?=number_format($indirimlifiyat,2,",",".")?> TL</span><br>
				<span class="old_price"><?=number_format($fiyat,2,",",".")?> TL</span>

				<?php

				}else{
					$fiyat=$urunler[$i]["fiyat"].".".$urunler[$i]["kurus"];
				 ?>

				<span class="new_price"><?=number_format($fiyat,2,",",".")?> TL</span>

		<?php			}
						?>
	        </div>

				</div>
				<!-- /grid_item -->
			</div>
			<!-- /col -->

			<?php		}
				}
				?>
			
			

			
		</div>
		<!-- /row -->
	</div>
	<!-- /container -->

	<div class="bg_gray">
		
	
	<div class="container margin_60_35">
		<div class="main_title">
			<h2>Bloglar</h2>
			<p>Merak Ettikleriniz Burada</p>
		</div>
		<div class="row">

			<?php
			$bloglar=$VT->VeriGetir("bloglar","WHERE durum=?",array(1),"ORDER BY ID DESC",4);
			if($bloglar!=false){
				for ($i=0; $i < count($bloglar); $i++) { 
					if(!empty($bloglar[$i]["resim"])){
						$resim=$bloglar[$i]["resim"];
					}else{
						$resim="varsayilan.png";
					}
					?>
				<div class="col-lg-6">
				<a class="box_news" href="<?=SITE?>blog-detay/<?=$bloglar[$i]["seflink"]?>">
					<figure>
						<img src="<?=SITE?>images/bloglar/<?=$resim?>" data-src="<?=SITE?>images/bloglar/<?=$resim?>" alt="<?=stripslashes($bloglar[$i]["baslik"])?>" width="400" height="266" class="lazy">
					
					</figure>
					<ul>
						<li><?=date("d.m.Y", strtotime($bloglar[$i]["tarih"]))?></li>
					</ul>
					<h4><?=stripslashes($bloglar[$i]["baslik"])?></h4>
					<p><?=mb_substr(strip_tags(stripslashes($bloglar[$i]["metin"])),0,150,"UTF-8")?>...</p>
				</a>
			</div>
			<?php	}
			}
			?>
			<!-- /box_news -->
		</div>
		<!-- /row -->
	</div>
	</div>
	<!-- /container -->
</main>
	<!-- /main -->