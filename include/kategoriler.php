<?php
if(!empty($_GET["seflink"]))
{
	$seflink=$VT->filter($_GET["seflink"]);
	$kategoriler=$VT->VeriGetir("kategoriler","WHERE durum=? AND seflink=?",array(1,$seflink),"ORDER BY ID ASC",1);
	if($kategoriler!=false){


?>

<main>
		<div class="top_banner">
			<div class="opacity-mask d-flex align-items-center" data-opacity-mask="rgba(0, 0, 0, 0.3)">
				<div class="container">

					<h1><?=stripslashes($kategoriler[0]["baslik"])?></h1>
				</div>
			</div>
			<img src="img/bg_cat_shoes.jpg" class="img-fluid" alt="">
		</div>
		<!-- /top_banner -->
			<div id="stick_here"></div>		
			<div class="toolbox elemento_stick">
				<div class="container">
				<ul class="clearfix">
					<li>

					</li>
					<li>
						<a href="<?=SITE?>kategori/<?=$kategoriler[0]["seflink"]?>?view=grid"><i class="ti-view-grid"></i></a>
						<a href="<?=SITE?>kategori/<?=$kategoriler[0]["seflink"]?>?view=list"><i class="ti-view-list"></i></a>
					</li>
					<li>
						<a href="#0" class="open_filters">
							<i class="ti-filter"></i><span>Filters</span>
						</a>
					</li>
				</ul>
				</div>
			</div>
			<!-- /toolbox -->
			
			<div class="container margin_30">
			
			<div class="row">
				<aside class="col-lg-3" id="sidebar_fixed">
				    <div class="filter_col">
				    	<form action="<?=SITE?>kategori/<?=$kategoriler[0]["seflink"]?>" method="GET">	
				        <div class="inner_bt"><a href="#" class="open_filters"><i class="ti-close"></i></a></div>
				        <div class="filter_type version_2">
				            <h4><a href="#filter_1" data-toggle="collapse" class="opened">Kategoriler</a></h4>
				            <div class="collapse show" id="filter_1">
				                <ul>
				                	<?php
				                	if($kategoriler[0]["tablo"]=="urunler"){
				                		$menukategori=$VT->VeriGetir("kategoriler","WHERE durum=? AND tablo=?",array(1,$kategoriler[0]["seflink"]),"ORDER BY sirano ASC");
				                	}else{
				                		$menukategori=$VT->VeriGetir("kategoriler","WHERE durum=? AND tablo=?",array(1,$kategoriler[0]["tablo"]),"ORDER BY sirano ASC");
				                	}

				                	if($menukategori!=false){
				                		for ($e=0; $e < count($menukategori); $e++) { 

				                			$urunsay=$VT->VeriGetir("urunler","WHERE durum=? AND kategori=?",array(1,$menukategori[$e]["ID"]));
				                			if($urunsay!=false){
				                				$sayac=count($urunsay);
				                			}else{
				                				$sayac=0;
				                			}
				                			?>
				                    <li>
				                    	<a href="<?=SITE?>kategori/<?=$menukategori[$e]["seflink"]?>">
				                        <label class="container_check"><?=stripslashes($menukategori[$e]["baslik"])?> <small><?=$sayac?></small>
				                        </a>
				                        </label>
				                    </li>				                			
				           <?php     		}
				                	}
				                	?>

				                </ul>
				            </div>
				            <!-- /filter_type -->
				        </div>
				        <!-- /filter_type -->

				        <div class="filter_type version_2">
				            <h4><a href="#filter_4" data-toggle="collapse" class="closed">Fiyat Aralığı</a></h4>
				            <div class="collapse" id="filter_4">
				            	<?php
				            	if(!empty($_GET["view"]) && $_GET["view"]=="list")
				            	{
				            		?>
				            		<input type="hidden" name="view" value="list">
				            		<?php
				            	}
				            	?>
				                <ul>
				                    <li>
				                        <label class="container_check">0 TL — 19 TL
				                            <input type="radio" name="fiyat" value="19">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">20 TL — 29 TL
				                            <input type="radio" name="fiyat" value="29">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">30 TL — 39 TL
				                            <input type="radio" name="fiyat" value="39">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                    <li>
				                        <label class="container_check">40 TL — 50 TL
				                            <input type="radio" name="fiyat" value="50">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                     <li>
				                        <label class="container_check">50+ TL
				                            <input type="radio" name="fiyat" value="51">
				                            <span class="checkmark"></span>
				                        </label>
				                    </li>
				                </ul>
				            </div>
				        </div>
				        <!-- /filter_type -->
				        <div class="buttons">
				            <input type="submit" name="" value="Arama Yap" class="btn_1">
				        </div>
				        </form>
				    </div>
				</aside>
				<!-- /col -->
				<div class="col-lg-9">
					<div class="row small-gutters">
						<?php
						if(!empty($_GET["view"]) && $_GET["view"]=="list"){
							$gorunum="liste";
						}else{
							$gorunum="kutu";
						}

						$tablo=$kategoriler[0]["tablo"];
						if($tablo=="urunler"){
							$altkategoriler=$VT->VeriGetir("kategoriler","WHERE durum=? AND tablo=?",array(1,$kategoriler[0]["seflink"]),"ORDER BY ID ASC");
							if($altkategoriler!=false){
								for ($i=0; $i < count($altkategoriler); $i++) { 

									if(!empty($_GET["fiyat"]) && ctype_digit($_GET["fiyat"])){
										$gelenfiyat=$VT->filter($_GET["fiyat"]);
										$baslamatutar=0;
										$bitistutar=0;
										if($gelenfiyat==19){$baslamatutar=0; $bitistutar=19;}
										if($gelenfiyat==29){$baslamatutar=20; $bitistutar=29;}
										if($gelenfiyat==39){$baslamatutar=30; $bitistutar=39;}
										if($gelenfiyat==50){$baslamatutar=40; $bitistutar=50;}
										if($gelenfiyat==51){$baslamatutar=51; $bitistutar=200000;}

										$urunler=$VT->VeriGetir("urunler","WHERE durum=? AND kategori=? AND (fiyat BETWEEN ? AND ?)",array(1,$altkategoriler[$i]["ID"],$baslamatutar,$bitistutar),"ORDER BY sirano ASC");

									}else{
										$urunler=$VT->VeriGetir("urunler","WHERE durum=? AND kategori=?",array(1,$altkategoriler[$i]["ID"]),"ORDER BY sirano ASC");
									}

									
if($urunler!=false){

	for ($x=0; $x < count($urunler); $x++) {  

		if($gorunum=="liste") { ?>

<!--
/*****************************************************************************************/

						 Buradan Aşağısı Liste Görünüm 

/*****************************************************************************************/
-->

	                <div class="row row_item">
	                    <div class="col-sm-4">
	                        <figure>
	                            <?php

						if(!empty($urunler[$x]["indirimlifiyat"])){

						$indirimlifiyat=$urunler[$x]["indirimlifiyat"].".".$urunler[$x]["indirimlikurus"]; 

						$normalfiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"]; 

						$hesapla=(($indirimlifiyat/$normalfiyat)*100);
						$indirimorani=(100-$hesapla);
						?>

							<span class="ribbon off">%<?=round($indirimorani)?> İndirimli</span>

					<?php	} ?>
	                            <a href="<?=SITE?>urun/<?=$urunler[$x]["seflink"]?>">
	                                <img class="img-fluid lazy" src="<?=SITE?>images/urunler/<?=$urunler[$x]["resim"]?>" data-src="<?=SITE?>images/urunler/<?=$urunler[$x]["resim"]?>" style="border: 0; box-shadow: 0 2px 6px 0; height: 250px; width: 250px;" alt="">
	                            </a>
	                           
	                        </figure>

	                    </div>

	                    <div class="col-sm-8">
	                       <!-- <div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div> -->
	                        <a href="<?=SITE?>urun/<?=$urunler[$x]["seflink"]?>">
	                            <h3><?=stripslashes($urunler[$x]["baslik"])?></h3>
	                        </a>
	                        <p><?=mb_substr(strip_tags(stripslashes($urunler[$x]["metin"])),0,250,"UTF-8")?>...</p>

	                        <div class="price_box">
	              <?php

					if(!empty($urunler[$x]["indirimlifiyat"])){
					$indirimlifiyat=$urunler[$x]["indirimlifiyat"].".".$urunler[$x]["indirimlikurus"];
					$fiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"];
 					?>

				<span class="new_price"><?=number_format($indirimlifiyat,2,",",".")?> TL</span><br>
				<span class="old_price"><?=number_format($fiyat,2,",",".")?> TL</span>

				<?php

				}else{
					$fiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"];
				 ?>

				<span class="new_price"><?=number_format($fiyat,2,",",".")?> TL</span>

		<?php			}
						?>
	                        </div>
	                        <ul>
	                            <li><a href="<?=SITE?>urun/<?=$urunler[$x]["seflink"]?>" class="btn_1">Ürünü İncele</a></li>

	                        </ul>
	                    </div>
	                </div>
	                <!-- /row_item -->
									<?php		} else {  ?>
<!--
/*****************************************************************************************/

						 Buradan Aşağısı Grid Görünüm 

/*****************************************************************************************/
-->

				<div class="col-6 col-md-4 col-xl-3">
				<div class="grid_item">
					<figure>
						<?php
						if(!empty($urunler[$x]["indirimlifiyat"])){
						$indirimlifiyat=$urunler[$x]["indirimlifiyat"].".".$urunler[$x]["indirimlikurus"]; 
						$normalfiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"]; 

						$hesapla=(($indirimlifiyat/$normalfiyat)*100);
						$indirimorani=(100-$hesapla);
						?>

							<span class="ribbon off">%<?=round($indirimorani)?> İndirimli</span>
					<?php	}?>
						
						<a href="<?=SITE?>urun/<?=$urunler[$x]["seflink"]?>">
							<img class="img-fluid lazy" src="<?=SITE?>images/urunler/<?=$urunler[$x]["resim"]?>" data-src="<?=SITE?>/images/urunler/<?=$urunler[$x]["resim"]?>" style="border: 0; box-shadow: 0 2px 6px 0; height: 250px; width: 250px;" alt="<?=stripslashes($urunler[$x]["baslik"])?>">
						</a>
	
					</figure>
			<!--		<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div> -->
					<a href="<?=SITE?>urun/<?=$urunler[$x]["seflink"]?>">
						<h3><?=stripslashes($urunler[$x]["baslik"])?></h3>
					</a>
					<div class="price_box">
						<?php

					if(!empty($urunler[$x]["indirimlifiyat"])){
					$indirimlifiyat=$urunler[$x]["indirimlifiyat"].".".$urunler[$x]["indirimlikurus"];
					$fiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"];
 					?>

				<span class="new_price"><?=number_format($indirimlifiyat,2,",",".")?> TL</span><br>
				<span class="old_price"><?=number_format($fiyat,2,",",".")?> TL</span>

				<?php

				}else{
					$fiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"];
				 ?>

				<span class="new_price"><?=number_format($fiyat,2,",",".")?> TL</span>

		<?php			}
						?>
						
					</div>
					<!--
					<ul>
						<li><a href="#0" class="tooltip-1" data-toggle="tooltip" data-placement="left" title="Favoriye Ekle"><i class="ti-heart"></i><span>Favoriye Ekle</span></a></li>
					</ul>
				-->
				</div>
				<!-- /grid_item -->
			</div>
			<!-- /col -->
					<?php
											}


										}
									}
								}
							}
						} else{

							if(!empty($_GET["fiyat"]) && ctype_digit($_GET["fiyat"])){
										$gelenfiyat=$VT->filter($_GET["fiyat"]);
										$baslamatutar=0;
										$bitistutar=0;
										if($gelenfiyat==19){$baslamatutar=0; $bitistutar=19;}
										if($gelenfiyat==29){$baslamatutar=20; $bitistutar=29;}
										if($gelenfiyat==39){$baslamatutar=30; $bitistutar=39;}
										if($gelenfiyat==50){$baslamatutar=40; $bitistutar=50;}
										if($gelenfiyat==51){$baslamatutar=51; $bitistutar=200000;}

										$urunler=$VT->VeriGetir("urunler","WHERE durum=? AND kategori=? AND (fiyat BETWEEN ? AND ?)",array(1,$kategoriler[0]["ID"],$baslamatutar,$bitistutar),"ORDER BY sirano ASC");

									}else{
										$urunler=$VT->VeriGetir("urunler","WHERE durum=? AND kategori=?",array(1,$kategoriler[0]["ID"]),"ORDER BY sirano ASC");
									}
							
									if($urunler!=false){
										for ($x=0; $x < count($urunler); $x++) {  ?>
				<div class="col-6 col-md-4 col-xl-3">
				<div class="grid_item">
					<figure>
						<?php
						if(!empty($urunler[$x]["indirimlifiyat"])){
						$indirimlifiyat=$urunler[$x]["indirimlifiyat"].".".$urunler[$x]["indirimlikurus"]; 
						$normalfiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"]; 

						$hesapla=(($indirimlifiyat/$normalfiyat)*100);
						$indirimorani=(100-$hesapla);
						?>

							<span class="ribbon off">%<?=round($indirimorani)?> İndirimli</span>
					<?php	}?>
						
						<a href="<?=SITE?>urun/<?=$urunler[$x]["seflink"]?>">
							<img class="img-fluid lazy" src="<?=SITE?>images/urunler/<?=$urunler[$x]["resim"]?>" data-src="<?=SITE?>/images/urunler/<?=$urunler[$x]["resim"]?>" style="border: 0; box-shadow: 0 2px 6px 0; height: 250px; width: 250px;" alt="<?=stripslashes($urunler[$x]["baslik"])?>">
						</a>
	
					</figure>
				<!--	<div class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star"></i></div> -->
					<a href="<?=SITE?>urun/<?=$urunler[$x]["seflink"]?>">
						<h3><?=stripslashes($urunler[$x]["baslik"])?></h3>
					</a>
					<div class="price_box">
						<?php

					if(!empty($urunler[$x]["indirimlifiyat"])){
					$indirimlifiyat=$urunler[$x]["indirimlifiyat"].".".$urunler[$x]["indirimlikurus"];
					$fiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"];
 					?>

				<span class="new_price"><?=number_format($indirimlifiyat,2,",",".")?> TL</span><br>
				<span class="old_price"><?=number_format($fiyat,2,",",".")?> TL</span>

				<?php

				}else{
					$fiyat=$urunler[$x]["fiyat"].".".$urunler[$x]["kurus"];
				 ?>

				<span class="new_price"><?=number_format($fiyat,2,",",".")?> TL</span>

		<?php			}
						?>
						
					</div>
					
				</div>
				<!-- /grid_item -->
			</div>
			<!-- /col -->
					<?php					}
									}
						}
						
?>
	
					</div>
					<!-- /row -->
					<div class="pagination__wrapper">
						<ul class="pagination">
							<li><a href="#0" class="prev" title="previous page">&#10094;</a></li>
							<li>
								<a href="#0" class="active">1</a>
							</li>
							<li>
								<a href="#0">2</a>
							</li>
							<li>
								<a href="#0">3</a>
							</li>
							<li>
								<a href="#0">4</a>
							</li>
							<li><a href="#0" class="next" title="next page">&#10095;</a></li>
						</ul>
					</div>
				</div>
				<!-- /col -->
			</div>
			<!-- /row -->			
				
		</div>
		<!-- /container -->
	</main>
	<!-- /main -->

	<?php
}
	}
?>