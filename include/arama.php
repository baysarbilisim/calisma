<?php
if(!empty($_POST["aranan"]))
{
$aranan=$VT->filter($_POST['aranan']);
?>

		<div class="container margin_60_35">
		<div class="row small-gutters">
			<?php
				$urunler=$VT->VeriGetir("urunler","WHERE baslik LIKE ? ",array("%$aranan%"));
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
			<?php } 
} ?>
		</div>
	</div>
	


<?php
}
?>

