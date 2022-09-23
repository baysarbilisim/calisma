<?php if (!empty($_SESSION['uyeID'])) {
	$uyeID=$VT->filter($_SESSION['uyeID']);
	$uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($uyeID,1),"ORDER BY ID ASC",1);

	if ($uyebilgisi!=false) { ?>
		
		<link href="<?=SITE?>css/account.css" rel="stylesheet">
		<link href="<?=SITE?>css/faq.css" rel="stylesheet">

<main class="bg_gray">
		
	<div class="container margin_30">
		<div class="page_header">

		<h1>Hesabım</h1>
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

				<div class="col-xl-8 col-lg-8 col-md-8">
				<div class="box_account">
					<h3 class="new_client">Üyelik Bilgileri</h3> 
					<?php
					if($_POST){
						if(!empty($_POST["ozellik"])){

							if (!empty($_POST["client_type"]) && $_POST["client_type"]=="private") {
								// bireysel üye

								if(!empty($_POST["ad"]) && !empty($_POST["soyad"]) && !empty($_POST["adres"]) && !empty($_POST["telefon"]) && !empty($_POST["postakodu"]) && !empty($_POST["ilce"]) && !empty($_POST["il"])){
									$ad=$VT->filter($_POST["ad"]);
									$soyad=$VT->filter($_POST["soyad"]);
									$adres=$VT->filter($_POST["adres"]);
									$telefon=$VT->filter($_POST["telefon"]);
									$postakodu=$VT->filter($_POST["postakodu"]);
									$ilce=$VT->filter($_POST["ilce"]);
									$il=$VT->filter($_POST["il"]);

										/*üye güncelleme yap*/
										$guncelle=$VT->SorguCalistir("UPDATE uyeler","SET ad=?, soyad=?, adres=?, ilce=?, ilID=?, postakodu=?, telefon=?, tipi=?, durum=?, tarih=? WHERE ID=?",array($ad, $soyad, $adres, $ilce, $il, $postakodu, $telefon, 1, 1,date("Y-m-d"),$uyebilgisi[0]["ID"]),1);

										$_SESSION["uyeAdi"]=$ad;
	$uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($uyebilgisi[0]["ID"],1),"ORDER BY ID ASC",1);


											?>
								<div class="alert alert-danger">Hesabınız başarıyla güncellendi.</div>
								<?php

									

							}else{ ?>
								<div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>
							<?php }

							}elseif (!empty($_POST["client_type"]) && $_POST["client_type"]=="company") {
								// kurumsal üye

								if(!empty($_POST["firmaadi"]) && !empty($_POST["vergidairesi"]) && !empty($_POST["vergino"]) && !empty($_POST["vergino"]) && !empty($_POST["firmaadres"]) && !empty($_POST["firmatelefon"]) && !empty($_POST["firmapostakodu"]) && !empty($_POST["firmailce"]) && !empty($_POST["firmail"])){
									$firmaadi=$VT->filter($_POST["firmaadi"]);
									$vergidairesi=$VT->filter($_POST["vergidairesi"]);
									$vergino=$VT->filter($_POST["vergino"]);
									$firmaadres=$VT->filter($_POST["firmaadres"]);
									$firmatelefon=$VT->filter($_POST["firmatelefon"]);
									$firmapostakodu=$VT->filter($_POST["firmapostakodu"]);
									$firmailce=$VT->filter($_POST["firmailce"]);
									$firmail=$VT->filter($_POST["firmail"]);

									
										/*kurumsal üye güncelleme yap*/

										$ekle=$VT->SorguCalistir("UPDATE uyeler","SET firmaadi=?, vergino=?, vergidairesi=?, adres=?, ilce=?, ilID=?, postakodu=?, telefon=?, tipi=?, durum=?, tarih=? WHERE ID=?",array($firmaadi, $vergino, $vergidairesi, $adres, $ilce, $il, $postakodu, $telefon, 2, 1,date("Y-m-d"),$uyebilgisi[0]["ID"]),1);

										$_SESSION["uyeAdi"]=$firmaadi;
										$uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($uyebilgisi[0]["ID"],1),"ORDER BY ID ASC",1);
									
											?>
								<div class="alert alert-danger">Hesabınız başarıyla güncellendi.</div>
								<?php

									

							}else{ ?>
								<div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>
							<?php }
							}

						
							
						}
					}
					?>
					<form action="#" method="POST">
						<input type="hidden" name="ozellik" value="1">
					
					<div class="form_container">
						<div class="form-group">
							<input type="email" class="form-control" name="mail" id="email_2" placeholder="Email*" value="<?=$uyebilgisi[0]["mail"]?>">
						</div>
						<hr>
						<div class="form-group">
							<label class="container_radio" style="display: inline-block; margin-right: 15px;">Bireysel
								<input type="radio" name="client_type" <?php
								if($uyebilgisi[0]["tipi"]==1){
								echo "checked";
								} ?> value="private">
								
								<span class="checkmark"></span>
							</label>
							<label class="container_radio" style="display: inline-block;">Kurumsal
								<input type="radio" name="client_type" <?php
								if($uyebilgisi[0]["tipi"]==2){
								echo "checked";
								} ?> value="company">
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="private box">
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
										<input type="text" class="form-control" name="ad" placeholder="Ad*" value="<?=$uyebilgisi[0]["ad"]?>">
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="soyad" placeholder="Soyad*" value="<?=$uyebilgisi[0]["soyad"]?>">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<input type="text" class="form-control" name="adres" placeholder="Adres*" value="<?=$uyebilgisi[0]["adres"]?>">
									</div>
								</div>
							</div>
							<!-- /row -->
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
										<input type="text" class="form-control" name="ilce" placeholder="İlçe*" value="<?=$uyebilgisi[0]["ilce"]?>">
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="postakodu" placeholder="Posta Kodu*" value="<?=$uyebilgisi[0]["postakodu"]?>">
									</div>
								</div>
							</div>
							<!-- /row -->
							
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
										<div class="custom-select-form">
											<select class="wide add_bottom_10" name="il" id="country">
												<?php
												$iller=$VT->VeriGetir("il");
												if($iller!=false){
													for ($i=0; $i <count($iller) ; $i++) { 
														if($uyebilgisi[0]["ilID"]==$iller[$i]["ID"]){
?>
													<option value="<?=$iller[$i]["ID"]?>" selected="selected"><?=$iller[$i]["ADI"]?></option>
											<?php
														}else{
															?>
													<option value="<?=$iller[$i]["ID"]?>" ><?=$iller[$i]["ADI"]?></option>
											<?php
														}
													
													}
												}
												?>
													
													
											</select>
										</div>
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="telefon" placeholder="Telefon" value="<?=$uyebilgisi[0]["telefon"]?>">
									</div>
								</div>
							</div>
							<!-- /row -->
							
						</div>
						<!-- /private -->
						<div class="company box" style="display: none;">
						
							<div class="row no-gutters">
								<div class="col-12">
									<div class="form-group">
										<input type="text" class="form-control" name="firmaadi" placeholder="Firma Adı" value="<?=$uyebilgisi[0]["firmaadi"]?>">
									</div>
								</div>
								<div class="col-6 pr-1">
									<div class="form-group">
										<input type="text" class="form-control" name="vergidairesi" placeholder="Vergi Dairesi" value="<?=$uyebilgisi[0]["vergidairesi"]?>">
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="vergino" placeholder="Vergi Numarası" value="<?=$uyebilgisi[0]["vergino"]?>">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<input type="text" class="form-control" name="firmaadres" placeholder="Adres*" value="<?=$uyebilgisi[0]["adres"]?>">
									</div>
								</div>
							</div>
							<!-- /row -->
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
										<input type="text" class="form-control" name="firmailce" placeholder="İlçe*" value="<?=$uyebilgisi[0]["ilce"]?>">
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="firmapostakodu" placeholder="Posta Kodu*" value="<?=$uyebilgisi[0]["postakodu"]?>">
									</div>
								</div>
							</div>
							<!-- /row -->
							
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
										<div class="custom-select-form">
											<select class="wide add_bottom_10" name="firmail" id="country">
												<?php
												$iller=$VT->VeriGetir("il");
												if($iller!=false){
													for ($i=0; $i <count($iller) ; $i++) { 
														if($uyebilgisi[0]["ilID"]==$iller[$i]["ID"]){
?>
													<option value="<?=$iller[$i]["ID"]?>" selected="selected"><?=$iller[$i]["ADI"]?></option>
											<?php
														}else{
															?>
													<option value="<?=$iller[$i]["ID"]?>" ><?=$iller[$i]["ADI"]?></option>
											<?php
														}

													}
												}
												?>
													
													
											</select>
										</div>
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="firmatelefon" placeholder="Telefon" value="<?=$uyebilgisi[0]["telefon"]?>">
									</div>
								</div>
							</div>
							<!-- /row -->
						
						</div>
						<!-- /company -->
						<hr>
			
						<div class="text-center"><input type="submit" value="Hesabı Güncelle" class="btn_1 full-width"></div>
					</div>
					</form>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->
			</div>

			<div class="col-xl-4 col-lg-4 col-md-8">
				<div class="box_account">
					<h3 class="client">Şifre Değiştir</h3>
					<?php
					if ($_POST) {
						if (!empty($_POST["giris"])) {
							if (!empty($_POST["esifre"]) && !empty($_POST["sifre"])) {
								$esifre=md5($VT->filter($_POST["esifre"]));
								$sifre=md5($VT->filter($_POST["sifre"]));
								
							if ($uyebilgisi[0]["sifre"]==$esifre) {
								$sifreguncelle=$VT->SorguCalistir("UPDATE uyeler","SET sifre=? WHERE ID=?",array($sifre,$uyebilgisi[0]["ID"]),1);

								?>
								<div class="alert alert-success">Şifreniz başarıyla güncellendi.</div>
								<?php

							}else{
								?>
								<div class="alert alert-danger">Eski şifreniz doğrulanamadı.</div>
								<?php
							}

							}else{
								?>
								<div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>
								<?php
							}

						}
					}
					 ?>
					<form action="#" method="POST">
						<input type="hidden" name="giris" value="1">
					
					<div class="form_container">
		
						<div class="form-group">
							<input type="password" class="form-control" name="esifre" id="password_in" value="" placeholder="Eski Şifre*">
						</div>

						<div class="form-group">
							<input type="password" class="form-control" name="sifre" id="password_in" value="" placeholder="Yeni Şifre*">
						</div>
						
						<div class="text-center"><input type="submit" value="Şifremi Güncelle" class="btn_1 full-width"></div>

					</div>
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
