<?php
include_once(SINIF."class.phpmailer.php");
include_once(SINIF."VT.php");
$VT=new VT();

$sitebilgileri=$VT->VeriGetir("ayarlar","WHERE ID=?",array(1),"ORDER BY ID ASC",1);
	if($sitebilgileri!=false){
		$sitebaslik=stripslashes($sitebilgileri[0]["baslik"]);
		$siteanahtar=stripslashes($sitebilgileri[0]["anahtar"]);
		$sitedescription=stripslashes($sitebilgileri[0]["aciklama"]);
		$siteurl=stripslashes($sitebilgileri[0]["url"]);
	}else{
		echo "Lütfen Bağlantı Bilgilerinizi Kontrol Edin";
		exit();
	}
?>