<?php if (!empty($_SESSION['uyeID'])) {
	$uyeID=$VT->filter($_SESSION['uyeID']);
	$uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($uyeID,1),"ORDER BY ID ASC",1);

	if ($uyebilgisi!=false) { ?>
		
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
								<th>İncele</th>
							</tr>
							<?php
							$siparisler=$VT->VeriGetir("siparisler","WHERE uyeID=?",array($uyebilgisi[0]["ID"]),"ORDER BY ID DESC");
							if ($siparisler!=false) {
								for ($i=0; $i <count($siparisler) ; $i++) { 
						if ($siparisler[$i]["odemetipi"]==1) { $odemetipi="Kredi/Banka Kartı"; }
						if ($siparisler[$i]["odemetipi"]==2) { $odemetipi="Havale/EFT"; }
						if ($siparisler[$i]["odemetipi"]==3) { $odemetipi="Kapıda Ödeme"; }
									?>
						<tr>
							<td><?=$siparisler[$i]["sipariskodu"]?></td>
							<td><?=number_format($siparisler[$i]["kdvharictutar"],2,".",",")?> TL</td>
							<td><?=number_format($siparisler[$i]["kdvtutar"],2,".",",")?> TL</td>
							<td><?=number_format($siparisler[$i]["odenentutar"],2,".",",")?> TL</td>
							<td><?=$odemetipi?></td>

							<td>
								<?php
								if ($siparisler[$i]["durum"]==1) { ?>
									<strong style="color: #4caf50;">Ödendi</strong>

					<?php		}else{ ?>
									<strong style="color: #ff9800;">Ödeme Bekliyor</strong>

					<?php 		}

								?>	

							</td>

							<td><?=date("d.m.Y",strtotime($siparisler[$i]["tarih"]))?></td>
							<td><a href="<?=SITE?>siparis-detay/<?=$siparisler[$i]["sipariskodu"]?>">İncele</a></td>
						</tr>
					<?php			}
							}else{ ?>
								<tr>
									<td colspan="7">Henüz siparişiniz bulunmamaktadır.</td>
								</tr>
				<?php		}
							
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
