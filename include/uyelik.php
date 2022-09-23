<?php if (!empty($_SESSION['uyeID'])) {
	?>
	<meta http-equiv="refresh" content="0;url=<?=SITE?>hesabim">
<?php
	exit();
} ?>
<link href="<?=SITE?>css/account.css" rel="stylesheet">

<main class="bg_gray">
		
	<div class="container margin_30">
		<div class="page_header">

		<h1>Giriş Yap veya Üye Ol</h1>
	</div>
	<!-- /page_header -->
			<div class="row justify-content-center">
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="client">Giriş Yap</h3>
					<?php
					if ($_POST) {
						if (!empty($_POST["giris"])) {
							if (!empty($_POST["mail"]) && !empty($_POST["sifre"])) {
								$mail=$VT->filter($_POST["mail"]);
								$sifre=md5($VT->filter($_POST["sifre"]));
								$kontrol=$VT->VeriGetir("uyeler","WHERE mail=? AND sifre=? AND durum=?",array($mail,$sifre,1),"ORDER BY ID ASC",1);

								if ($kontrol!=false) {
									$_SESSION['uyeID']=$kontrol[0]["ID"];
									$_SESSION['uyeTipi']=$kontrol[0]["tipi"];

									if ($kontrol[0]["tipi"]==1) {
										$_SESSION["uyeAdi"]=$kontrol[0]["ad"];
									}else{
										$_SESSION["uyeAdi"]=$kontrol[0]["firmaadi"];
									}
									?>
									<meta http-equiv="refresh" content="0;url=<?=SITE?>hesabim">
<?php
								}else{
								?>
								<div class="alert alert-danger">E-mail veya Şifre hatalı.</div>
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
							<input type="email" class="form-control" name="mail" id="email" placeholder="E-mail*">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="sifre" id="password_in" value="" placeholder="Şifre*">
						</div>
						<div class="clearfix add_bottom_15">
							<div class="checkboxes float-left">

							</div>
							<div class="float-right"><a id="forgot" href="javascript:void(0);">Şifremi Unuttum</a></div>
						</div>
						<div class="text-center"><input type="submit" value="Giriş Yap" class="btn_1 full-width"></div>

						<div id="forgot_pw">
							<div class="form-group">
								<input type="email" class="form-control sifremail" name="email" id="email_forgot" placeholder="E-Mail Adresiniz">
							</div>
							<p>Şifre sıfırlama bağlantısı için mail adresinizi yazınız.</p>
							<div class="text-center"><a class="btn_1" onclick="sifreIste('<?=SITE?>');">Yeni Şifre İste</a></div>
						</div>

					</div>
					</form>
					<!-- /form_container -->
				</div>
				<!-- /box_account -->

			</div>
			<div class="col-xl-6 col-lg-6 col-md-8">
				<div class="box_account">
					<h3 class="new_client">Ücretsiz Üye Ol</h3> 
					<?php
					if($_POST){
						if(!empty($_POST["ozellik"])){

							if(!empty($_POST["sozlesme"]) && $_POST["sozlesme"]==1){

							if (!empty($_POST["client_type"]) && $_POST["client_type"]=="private") {
								// bireysel üye

								if(!empty($_POST["ad"]) && !empty($_POST["soyad"]) && !empty($_POST["adres"]) && !empty($_POST["telefon"]) && !empty($_POST["postakodu"]) && !empty($_POST["ilce"]) && !empty($_POST["mail"]) && !empty($_POST["sifre"]) && !empty($_POST["il"])){
									$ad=$VT->filter($_POST["ad"]);
									$soyad=$VT->filter($_POST["soyad"]);
									$adres=$VT->filter($_POST["adres"]);
									$telefon=$VT->filter($_POST["telefon"]);
									$postakodu=$VT->filter($_POST["postakodu"]);
									$ilce=$VT->filter($_POST["ilce"]);
									$mail=$VT->filter($_POST["mail"]);
									$sifre=md5($VT->filter($_POST["sifre"]));
									$il=$VT->filter($_POST["il"]);

									$kontrol=$VT->VeriGetir("uyeler","WHERE mail=?",array($mail),"ORDER BY ID ASC",1);

									if($kontrol!=false){
										/*hesap oluşmayacak*/
								?>
								<div class="alert alert-danger">Bu hesap zaten mevcut. Lütfen giriş yapınız.</div>
								<?php

									}else{
										/*üye kaydını yap*/
										$ekle=$VT->SorguCalistir("INSERT INTO uyeler","SET ad=?, soyad=?, mail=?, sifre=?, adres=?, ilce=?, ilID=?, postakodu=?, telefon=?, tipi=?, durum=?, tarih=?",array($ad, $soyad, $mail, $sifre, $adres, $ilce, $il, $postakodu, $telefon, 1, 1,date("Y-m-d")));

											?>
								<div class="alert alert-danger">Hesabınız başarıyla oluşturuldu. Artık giriş yapabilirsiniz.</div>
								<?php

									}

							}else{ ?>
								<div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>
							<?php }

							}elseif (!empty($_POST["client_type"]) && $_POST["client_type"]=="company") {
								// kurumsal üye

								if(!empty($_POST["firmaadi"]) && !empty($_POST["vergidairesi"]) && !empty($_POST["vergino"]) && !empty($_POST["vergino"]) && !empty($_POST["firmaadres"]) && !empty($_POST["firmatelefon"]) && !empty($_POST["firmapostakodu"]) && !empty($_POST["firmailce"]) && !empty($_POST["mail"]) && !empty($_POST["sifre"]) && !empty($_POST["firmail"])){
									$firmaadi=$VT->filter($_POST["firmaadi"]);
									$vergidairesi=$VT->filter($_POST["vergidairesi"]);
									$vergino=$VT->filter($_POST["vergino"]);
									$firmaadres=$VT->filter($_POST["firmaadres"]);
									$firmatelefon=$VT->filter($_POST["firmatelefon"]);
									$firmapostakodu=$VT->filter($_POST["firmapostakodu"]);
									$firmailce=$VT->filter($_POST["firmailce"]);
									$mail=$VT->filter($_POST["mail"]);
									$sifre=md5($VT->filter($_POST["sifre"]));
									$firmail=$VT->filter($_POST["firmail"]);

									$kontrol=$VT->VeriGetir("uyeler","WHERE mail=?",array($mail),"ORDER BY ID ASC",1);

									if($kontrol!=false){
										/*hesap oluşmayacak*/
										?>
								<div class="alert alert-danger">Bu hesap zaten mevcut. Lütfen giriş yapınız.</div>
								<?php

									}else{
										/*üye kaydını yap*/

										$ekle=$VT->SorguCalistir("INSERT INTO uyeler","SET firmaadi=?, vergino=?, vergidairesi=?, mail=?, sifre=?, adres=?, ilce=?, ilID=?, postakodu=?, telefon=?, tipi=?, durum=?, tarih=?",array($firmaadi, $vergino, $vergidairesi, $mail, $sifre, $adres, $ilce, $il, $postakodu, $telefon, 2, 1,date("Y-m-d")));

											?>
								<div class="alert alert-danger">Hesabınız başarıyla oluşturuldu. Artık giriş yapabilirsiniz.</div>
								<?php

									}

							}else{ ?>
								<div class="alert alert-danger">Boş bıraktığınız alanları doldurunuz.</div>
							<?php }
							}

							}else{
								?>
								<div class="alert alert-danger">Üyelik Sözleşmesini Kabul Etmeden Üye Olamazsınız.</div>
							<?php
							}
							
						}
					}
					?>
					<form action="#" method="POST">
						<input type="hidden" name="ozellik" value="1">
					
					<div class="form_container">
						<div class="form-group">
							<input type="email" class="form-control" name="mail" id="email_2" placeholder="Email*">
						</div>
						<div class="form-group">
							<input type="password" class="form-control" name="sifre" id="password_in_2" value="" placeholder="Şifre*">
						</div>
						<hr>
						<div class="form-group">
							<label class="container_radio" style="display: inline-block; margin-right: 15px;">Bireysel
								<input type="radio" name="client_type" checked value="private">
								<span class="checkmark"></span>
							</label>
							<label class="container_radio" style="display: inline-block;">Kurumsal
								<input type="radio" name="client_type" value="company">
								<span class="checkmark"></span>
							</label>
						</div>
						<div class="private box">
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
										<input type="text" class="form-control" name="ad" placeholder="Ad*">
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="soyad" placeholder="Soyad*">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<input type="text" class="form-control" name="adres" placeholder="Adres*">
									</div>
								</div>
							</div>
							<!-- /row -->
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
										<input type="text" class="form-control" name="ilce" placeholder="İlçe*">
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="postakodu" placeholder="Posta Kodu*">
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
													for ($i=0; $i <count($iller) ; $i++) { ?>
													<option value="<?=$iller[$i]["ID"]?>" ><?=$iller[$i]["ADI"]?></option>
											<?php	}
												}
												?>
													
													
											</select>
										</div>
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="telefon" placeholder="Telefon">
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
										<input type="text" class="form-control" name="firmaadi" placeholder="Firma Adı">
									</div>
								</div>
								<div class="col-6 pr-1">
									<div class="form-group">
										<input type="text" class="form-control" name="vergidairesi" placeholder="Vergi Dairesi">
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="vergino" placeholder="Vergi Numarası">
									</div>
								</div>
								<div class="col-12">
									<div class="form-group">
										<input type="text" class="form-control" name="firmaadres" placeholder="Adres*">
									</div>
								</div>
							</div>
							<!-- /row -->
							<div class="row no-gutters">
								<div class="col-6 pr-1">
									<div class="form-group">
										<input type="text" class="form-control" name="firmailce" placeholder="İlçe*">
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="firmapostakodu" placeholder="Posta Kodu*">
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
													for ($i=0; $i <count($iller) ; $i++) { ?>
													<option value="<?=$iller[$i]["ID"]?>" ><?=$iller[$i]["ADI"]?></option>
											<?php	}
												}
												?>
													
													
											</select>
										</div>
									</div>
								</div>
								<div class="col-6 pl-1">
									<div class="form-group">
										<input type="text" class="form-control" name="firmatelefon" placeholder="Telefon">
									</div>
								</div>
							</div>
							<!-- /row -->
						
						</div>
						<!-- /company -->
						<hr>
						<div class="form-group">
							<?php
							$bilgiler=$VT->VeriGetir("gizlilikpolitikasi","WHERE durum=?",array(1),"ORDER BY ID ASC",1);
							if($bilgiler!=false){?>

							<label class="container_check"> <a href="<?=SITE?>gizlilik-politikasi/<?=$bilgiler[0]["seflink"]?>" target="_blank">Üyelik Sözleşmesi</a>'ni Okudum, Kabul Ediyorum.
								<input type="checkbox" name="sozlesme" value="1">
								<span class="checkmark"></span>
							</label>

					<?php   }
							?>
							
						</div>
						<div class="text-center"><input type="submit" value="Hesap Oluştur" class="btn_1 full-width"></div>
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