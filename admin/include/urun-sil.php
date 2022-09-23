<?php
 
if(!empty($_GET["ID"]))
{

	$ID=$VT->filter($_GET["ID"]);

		$veri=$VT->VeriGetir("urunler","WHERE ID=?",array($ID),"ORDER BY ID ASC",1);

		if($veri!=false)
		{
			$resim=$veri[0]["resim"];
			if(file_exists("../images/urunler/".$resim)){
				unlink("../images/urunler/".$resim);
			}
			$sil=$VT->SorguCalistir("DELETE FROM urunler","WHERE ID=?",array($ID),1);

			$kotrol1=$VT->VeriGetir("urunvaryasyonlari","WHERE urunID=?",array($ID),"ORDER BY ID ASC",1);
			$kotrol2=$VT->VeriGetir("urunvaryasyonsecenekleri","WHERE urunID=?",array($ID),"ORDER BY ID ASC",1);
			$kotrol3=$VT->VeriGetir("urunvaryasyonstoklari","WHERE urunID=?",array($ID),"ORDER BY ID ASC",1);

			if($kotrol1!=false ){
				$sil=$VT->SorguCalistir("DELETE FROM urunvaryasyonlari","WHERE urunID=?",array($ID));
			}
			if($kotrol2!=false ){
				$sil=$VT->SorguCalistir("DELETE FROM urunvaryasyonsecenekleri","WHERE urunID=?",array($ID));
			}
			if($kotrol3!=false ){
				$sil=$VT->SorguCalistir("DELETE FROM urunvaryasyonstoklari","WHERE urunID=?",array($ID));
			}
			?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>urun-liste">
        <?php
		}
		else
		{
			?>
        <meta http-equiv="refresh" content="0;url=<?=SITE?>urun-liste">
        <?php
		}	
}
else
{
	?>

        <meta http-equiv="refresh" content="0;url=<?=SITE?>"> 
 <?php 
}

?>