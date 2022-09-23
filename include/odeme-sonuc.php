<link href="<?=SITE?>css/checkout.css" rel="stylesheet">
<?php

if (!empty($_SESSION["siparisKodu"])) { 
	if (!empty($_SESSION["odemetipi"]) && $_SESSION["odemetipi"]==2) { ?>

		<main class="bg_gray">
		<div class="container">
            <div class="row justify-content-center">
				<div class="col-md-8">
					<div id="confirm">
						<div class="icon icon--order-success svg add_bottom_15">
							<svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
								<g fill="none" stroke="#8EC343" stroke-width="2">
									<circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
									<path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
								</g>
							</svg>
						</div>
					<h2>Ödemeniz Tamamlandı</h2>
					<p style="font-size: 16px;">Siparişinizi <strong style="color: #060709;"><?=$_SESSION["siparisKodu"]?></strong>'nolu numara üzerinden takip edebilirsiniz. </p>

					<div style="
    min-height: 20px;
    margin-bottom: 20px;
    background-color: #f5f5f5;
    border: 1px solid #e3e3e3;
    -webkit-box-shadow: inset 0 1px 1px rgb(0 0 0 / 5%);
    box-shadow: inset 0 1px 1px rgb(0 0 0 / 5%);
    padding: 9px;
    border-radius: 3px;
    text-align: left;
    font-size: 18px;
">
						<p>Halkbank Şubesi</p>
						<p>Hesap Adı: Muhammed Fatih Şahiner</p>
						<p>IBAN No: TR65 0001 2009 7010 0001 0052 99</p>
						<p>*** Lütfen ödeme yaptığınızda dekontunuza sipariş numaranızı da yazarak <strong>bilisimbaysar@gmail.com</strong> adresine mail atınız.</p>

<p>Siparişinizi verdikten sonraki 5 iş günü içinde havale/eft yapmadığınız taktirde siparişiniz iptal olur. </p>
					</div>
					
					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
		
	</main>
	<!--/main-->

<?php	}else{ ?>

	<main class="bg_gray">
		<div class="container">
            <div class="row justify-content-center">
				<div class="col-md-5">
					<div id="confirm">
						<div class="icon icon--order-success svg add_bottom_15">
							<svg xmlns="http://www.w3.org/2000/svg" width="72" height="72">
								<g fill="none" stroke="#8EC343" stroke-width="2">
									<circle cx="36" cy="36" r="35" style="stroke-dasharray:240px, 240px; stroke-dashoffset: 480px;"></circle>
									<path d="M17.417,37.778l9.93,9.909l25.444-25.393" style="stroke-dasharray:50px, 50px; stroke-dashoffset: 0px;"></path>
								</g>
							</svg>
						</div>
					<h2>Ödemeniz Tamamlandı</h2>
					<p>Siparişinizi <strong><?=$_SESSION["siparisKodu"]?></strong>'nolu numara üzerinden takip edebilirsiniz. </p>
					

					</div>
				</div>
			</div>
			<!-- /row -->
		</div>
		<!-- /container -->
		
	</main>
	<!--/main-->



<?php	}
	?>

	

<?php }else{ ?>
	<meta http-equiv="refresh" content="0;url=<?=SITE?>hesabim">
<?php }
?>
	