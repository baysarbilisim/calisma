<link href="<?=SITE?>css/error_track.css" rel="stylesheet">

<main class="bg_gray">
		<div id="track_order">
			<div class="container">
				<div class="row justify-content-center text-center">
					
						<?php 
						$islemdurumu=false;
						if ($_POST) {
							
							if (!empty($_POST["sipariskodu"])) {
								$sipariskodu=$VT->filter($_POST["sipariskodu"]);
								$siparisler=$VT->VeriGetir("siparisler","WHERE sipariskodu=?",array($sipariskodu),"ORDER BY ID ASC",1);

								if ($siparisler!=false) {
									$islemdurumu=true;
								}
							}
						}
						if ($islemdurumu!=false) {
							$uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($siparisler[0]["uyeID"],1),"ORDER BY ID ASC",1);

							if ($uyebilgisi!=false) {  ?>
							<div class="row">
								<div class="col-md-12">
									
								
						<form action="#" method="POST">
						<table class="table">
							<tr>
								<th>Sipariş Kodu</th>
								<th>KDV Hariç Tutar</th>
								<th>KDV Tutar</th>
								<th>Ödenen Tutar</th>
								<th>Ödeme Tipi</th>
								<th>Ödeme Durumu</th>
								<th>Tarih</th>
							
							</tr>
							<?php

							

						if ($siparisler[0]["odemetipi"]==1) { $odemetipi="Kredi/Banka Kartı"; }
						if ($siparisler[0]["odemetipi"]==2) { $odemetipi="Havale/EFT"; }
						if ($siparisler[0]["odemetipi"]==3) { $odemetipi="Kapıda Ödeme"; }
									?>
						<tr>
							<td><?=$siparisler[0]["sipariskodu"]?></td>
							<td><?=number_format($siparisler[0]["kdvharictutar"],2,".",",")?> TL</td>
							<td><?=number_format($siparisler[0]["kdvtutar"],2,".",",")?> TL</td>
							<td><?=number_format($siparisler[0]["odenentutar"],2,".",",")?> TL</td>
							<td><?=$odemetipi?></td>

							<td>
								<?php
								if ($siparisler[0]["durum"]==1) { ?>
									<strong style="color: #4caf50;">Ödendi</strong>

					<?php		}else{ ?>
									<strong style="color: #ff9800;">Ödeme Bekliyor</strong>

					<?php 		}

								?>	

							</td>

							<td><?=date("d.m.Y",strtotime($siparisler[0]["tarih"]))?></td>
						
						</tr>
						
						</table>

						<h3>Sipariş Verilen Ürünler</h3>

						<table class="table">
							<tr>
								<th>Ürün Kodu</th>
								<th>Resim</th>
								<th>Açıklama</th>
								<th>Ürün Fiyatı</th>
								<th>Adet</th>
								<th>Toplam Tutar</th>
							</tr>
				<?php

				$siparisurunler=$VT->VeriGetir("siparisurunler","WHERE siparisID=?",array($siparisler[0]["ID"]),"ORDER BY ID ASC");
				if($siparisurunler!=false){
					for ($i=0; $i < count($siparisurunler); $i++) { 
						$urunler=$VT->VeriGetir("urunler","WHERE ID=?",array($siparisurunler[$i]["urunID"]),"ORDER BY ID ASC",1);
						if ($urunler!=false) { 

							$ozellikler="";

							if (!empty($siparisurunler[$i]["varyasyonID"])) {
								$varyasyonKontrol=$VT->VeriGetir("urunvaryasyonstoklari","WHERE ID=?",array($siparisurunler[$i]["varyasyonID"]),"ORDER BY ID ASC",1);

								if($varyasyonKontrol!=false){
									$varyasyonID=$varyasyonKontrol[0]["varyasyonID"];
									$secenekID=$varyasyonKontrol[0]["secenekID"];

									if(strpos($varyasyonID,"@")>0)
									{

									$varyasyonDizi=explode("@", $varyasyonID);
									$secenekDizi=explode("@", $secenekID);
									for($x=0;$x<count($varyasyonDizi);$x++)
									{
									$varyasyonBilgisi=$VT->VeriGetir("urunvaryasyonlari","WHERE ID=?",array($varyasyonDizi[$x]),"ORDER BY ID ASC",1);
									$secenekBilgisi=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE ID=?",array($secenekDizi[$x]),"ORDER BY ID ASC",1);

										if($varyasyonBilgisi!=false && $secenekBilgisi!=false)
										{
											$ozellikler.=stripslashes($secenekBilgisi[0]["baslik"])." ".$varyasyonBilgisi[0]["baslik"]." ";
											/* Mavi Renk Small Beden*/
										}
									}


									}else{
										$varyasyonBilgisi=$VT->VeriGetir("urunvaryasyonlari","WHERE ID=?",array($varyasyonID),"ORDER BY ID ASC",1);
										$secenekBilgisi=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE ID=?",array($secenekID),"ORDER BY ID ASC",1);

						if($varyasyonBilgisi!=false && $secenekBilgisi!=false)
			{
				$ozellikler=stripslashes($secenekBilgisi[0]["baslik"])." ".stripslashes($varyasyonBilgisi[0]["baslik"]);
			}


									}
								}
							}
							?>
						<tr>
							<td><?=$urunler[0]["urunkodu"]?></td>
							<td><img src="<?=SITE?>images/urunler/<?=$urunler[0]["resim"]?>" style="height: 50px; width: auto; display: block;"></td>
							<td><?=stripslashes($urunler[0]["baslik"])?><br><small style="float: left; color: #d24474; display: block;"><?=$ozellikler?></small></td>
							<td><?=number_format($siparisurunler[$i]["uruntutar"],2,".",",")?> TL</td>
							<td><?=$siparisurunler[$i]["adet"]?></td>
							<td><?=number_format($siparisurunler[$i]["toplamtutar"],2,".",",")?></td>
						</tr>
						<?php		}
								}
							}
							?>
						</table>

					</form>
					<!-- /form_container -->
					</div>
					</div>
					<?php	}

						}else{ ?>
						<div class="col-xl-7 col-lg-9">
						<img src="<?=SITE?>img/track_order.svg" alt="" class="img-fluid add_bottom_15" width="200" height="177">
						<p>Sipariş Takibi</p>
						<form action="#" method="POST">
							<div class="search_bar">
								<input type="text" name="sipariskodu" class="form-control" placeholder="Sipariş Kodu">
								<input type="submit" value="Arama">
							</div>
						</form>
					</div>

				<?php	}

						 ?>
						
				
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /track_order -->
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
		
	</main>
	<!--/main-->