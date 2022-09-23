<?php if (!empty($_SESSION['uyeID']) && !empty($_GET["sipariskodu"])) {
	$uyeID=$VT->filter($_SESSION['uyeID']);
	$sipariskodu=$VT->filter($_GET['sipariskodu']);
	$uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($uyeID,1),"ORDER BY ID ASC",1);

	if ($uyebilgisi!=false) { 
		$siparisler=$VT->VeriGetir("siparisler","WHERE sipariskodu=? AND uyeID=?",array($sipariskodu,$uyebilgisi[0]["ID"]),"ORDER BY ID ASC",1);
		if ($siparisler!=false) {
			
		}else{ ?>
			<meta http-equiv="refresh" content="0;url=<?=SITE?>siparislerim">
<?php	exit();	}
		?>
		
		<link href="<?=SITE?>css/account.css" rel="stylesheet">
		<link href="<?=SITE?>css/faq.css" rel="stylesheet">

<main class="bg_gray">
		
	<div class="container margin_30">
		<div class="page_header">

		<h1>Siparişlerim</h1>
	</div>
	<!-- /page_header -->

	<div class="row">
				<div class="col-lg-3 col-md-4">
					<a class="box_topic" href="<?=SITE?>siparislerim">
						<i class="ti-wallet"></i>
						<h3>Siparişlerim</h3>
						
					</a>
				</div>
				
				<div class="col-lg-3 col-md-4">
					<a class="box_topic" href="<?=SITE?>siparis-takip">
						<i class="ti-truck"></i>
						<h3>Sipariş Takibi</h3>
						
					</a>
				</div>
				<div class="col-lg-3 col-md-4">
					<a class="box_topic" href="<?=SITE?>sepet">
						<i class="ti-shopping-cart"></i>
						<h3>Sepetim</h3>
						
					</a>
				</div>
				<div class="col-lg-3 col-md-4">
					<a class="box_topic" href="<?=SITE?>cikis-yap">
						<i class="ti-power-off"></i>
						<h3>Çıkış</h3>
						
					</a>
				</div>
			</div>
			<!--/row-->
			<div class="row justify-content-center">

				<div class="col-xl-12 col-lg-12 col-md-12">
				<div class="box_account" style="color: fff;">
				
					
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
								<th>Kargo Bilgileri</th>
							
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

						<td>
							<?php if (!empty($siparisler[0]["kargoadi"])) {
								echo $siparisler[0]["kargoadi"]."<br>Takip Numarası:".$siparisler[0]["takipno"];
							}

							?>
							
						</td>

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
				<!-- /box_account -->
			</div>

			
			
		</div>
		<!-- /row -->
		</div>
		<!-- /container -->
	</main>
	<!--/main-->


<?php	}else{
		?>
	<meta http-equiv="refresh" content="0;url=<?=SITE?>uyelik">
<?php
	}
}else{
	?>
	<meta http-equiv="refresh" content="0;url=<?=SITE?>uyelik">
<?php
} ?>
