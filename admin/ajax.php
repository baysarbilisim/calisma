<?php
@session_start();
@ob_start();
define("DATA","data/");
define("SAYFA","include/");
define("SINIF","class/");
include_once(DATA."baglanti.php");
define("SITE",$siteURL."admin/");
define("ANASITE",$siteURL);

	if(!empty($_POST["tablo"]) && !empty($_POST["ID"]) && $_FILES && !empty($_FILES['file']['tmp_name'])){
		$tablo=$VT->filter($_POST["tablo"]);
        $ID=$VT->filter($_POST["ID"]);

         $resim=$VT->upload("file","../images/resimler/");
				   if($resim!=false)
				   {
					   $ekle=$VT->SorguCalistir("INSERT INTO resimler","SET tablo=?, KID=?, resim=?, tarih=?",array($tablo,$ID,$resim,date("Y-m-d")));
					   echo "Resim Yüklendi";
				   }
				   else
				   {
            		echo "Resim Yok";
            
				   }
	}

if($_POST)
{

	if(!empty($_POST["tablo"]) && !empty($_POST["ID"]) && !empty($_POST["durum"]))
	{
		$tablo=$VT->filter($_POST["tablo"]);
		$ID=$VT->filter($_POST["ID"]);
		$durum=$VT->filter($_POST["durum"]);
		$guncelle=$VT->SorguCalistir("UPDATE ".$tablo,"SET durum=? WHERE ID=?",array($durum,$ID),1);
		if($guncelle!=false)
		{
			echo "TAMAM";
		}
		else
		{
			echo "HATA";
		}
	}elseif(!empty($_POST["tablo"]) && !empty($_POST["ID"]) && !empty($_POST["vitrindurum"]))
	{
		$tablo=$VT->filter($_POST["tablo"]);
		$ID=$VT->filter($_POST["ID"]);
		$durum=$VT->filter($_POST["vitrindurum"]);
		$guncelle=$VT->SorguCalistir("UPDATE ".$tablo,"SET vitrindurum=? WHERE ID=?",array($durum,$ID),1);
		if($guncelle!=false)
		{
			echo "TAMAM";
		}
		else
		{
			echo "HATA";
		}
	}elseif (!empty($_POST["varyasyon1"]) && !empty($_POST["secenek1"])) {
		$varyasyon1=$VT->filter($_POST["varyasyon1"]);

		if(!empty($_POST["varyasyon2"]) && !empty($_POST["secenek2"])){
			$varyasyon2=$VT->filter($_POST["varyasyon2"]);
			$_SESSION["varyasyonlar"]=array($varyasyon1,$varyasyon2);
			$_SESSION["secenekler"]=array($varyasyon1=>$_POST["secenek1"],$varyasyon2=>$_POST["secenek2"]);

			?>
 		
 		<table class="table">
 			
 				<?php
 				for($i=0;$i<count($_POST["secenek1"]);$i++){ 
 					echo "<tr>";
 					for($x=0;$x<count($_POST["secenek2"]);$x++){
 						?>

 					<td><?=$_POST['secenek1'][$i]?> <?=$varyasyon1?> <?=$_POST['secenek2'][$x]?> <?=$varyasyon2?></td>
 					<td><input class="form-control" type="number" value="1" name="stok[]" min="1"></td>
 						<?php
 					}
 					echo "</tr>";
 					}
 				?>
 			
 		</table>


			<?php

		}else{
			$_SESSION["varyasyonlar"]=array($varyasyon1);
			$_SESSION["secenekler"]=array($varyasyon1=>$_POST["secenek1"]);
			?>
 		
 		<table class="table">
 			
 				<?php
 				for($i=0;$i<count($_POST["secenek1"]);$i++){ ?>
 					<tr>
 					<td><?=$_POST['secenek1'][$i]?> <?=$varyasyon1?></td>
 					<td><input type="number" value="1" name="stok[]" min="1"></td>
 					</tr>
 		<?php	}
 				?>
 			
 		</table>


			<?php
		}
	}
	else
	{
		echo "BOS";
	}
}
?>