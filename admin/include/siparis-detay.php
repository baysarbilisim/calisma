<?php if (!empty($_GET["sipariskodu"])) {

  $sipariskodu=$VT->filter($_GET['sipariskodu']);
  
    $siparisler=$VT->VeriGetir("siparisler","WHERE sipariskodu=?",array($sipariskodu),"ORDER BY ID ASC",1);

    if ($siparisler!=false) {

    $uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($siparisler[0]["uyeID"],1),"ORDER BY ID ASC",1);

  if ($uyebilgisi!=false) { 


  }else{

  ?>
      <meta http-equiv="refresh" content="0;url=<?=SITE?>siparis-liste">

<?php exit(); 
  }
    ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sipariş Yönetim Ekranı</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
              <li class="breadcrumb-item active">Sipariş Yönetim Ekranı</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">

       <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
             
              <form action="#" method="POST">
            <table class="table">
              <tr>
                <th>Sipariş Kodu</th>
                <th>KDV Hariç Tutar</th>
                <th>KDV Tutar</th>
                <th>Ödenen Tutar</th>
                <th>Ödeme Tipi</th>
                <th>Ödeme Tipi</th>
                <th>Ödeme Durumu</th>
                <th>Tarih</th>
              
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
                if ($_POST) {
                  if (!empty($_POST["kargodurum"]) && !empty($_POST['kargoadi']) && !empty($_POST['takipno'])) {
                    $kargoadi=$VT->filter($_POST['kargoadi']);
                    $takipno=$VT->filter($_POST['takipno']);
                    $guncelle=$VT->SorguCalistir("UPDATE siparisler","SET kargoadi=?, takipno=? WHERE ID=?",array($kargoadi,$takipno,$siparisler[0]["ID"]),1);
                    ?>
                    <meta http-equiv="refresh" content="0">
                    <?php
                  }
                }
                ?>
                <form action="#" method="POST">
                  <input type="hidden" name="kargodurum" value="1">
                  <select name="kargoadi">
                    <option value="Aras Kargo" <?php if($siparisler[0]["kargoadi"]=="Aras Kargo") { echo 'selected="selected"';} ?> >Aras Kargo</option>
                    <option value="MNG Kargo" <?php if($siparisler[0]["kargoadi"]=="MNG Kargo") { echo 'selected="selected"';} ?> >MNG Kargo</option>
                    <option value="Sürat Kargo" <?php if($siparisler[0]["kargoadi"]=="Sürat Kargo") { echo 'selected="selected"';} ?> >Sürat Kargo</option>
                    <option value="Yurtiçi Kargo" <?php if($siparisler[0]["kargoadi"]=="Yurtiçi Kargo") { echo 'selected="selected"';} ?> >Yurtiçi Kargo</option>
                     <option value="UPS Kargo" <?php if($siparisler[0]["kargoadi"]=="UPS Kargo") { echo 'selected="selected"';} ?> >UPS Kargo</option>
                    <option value="PTT Kargo" <?php if($siparisler[0]["kargoadi"]=="PTT Kargo") { echo 'selected="selected"';} ?> >PTT Kargo</option>

                  </select>
                  <input type="text" name="takipno" value="<?=$siparisler[0]["takipno"]?>" placeholder="Takip No">
                  <input type="submit" name="ilet" value="Güncelle">

                </form>
              </td>

              <td>
                <?php
                if ($_POST) {
                  if (!empty($_POST["durum"]) && !empty($_POST['odemedurum'])) {
                    $odemedurum=$VT->filter($_POST['odemedurum']);
                    $guncelle=$VT->SorguCalistir("UPDATE siparisler","SET durum=? WHERE ID=?",array($odemedurum,$siparisler[0]["ID"]),1);
                    ?>
                    <meta http-equiv="refresh" content="0">
                    <?php
                  }
                }
                ?>
                <form action="#" method="POST">
                  <input type="hidden" name="durum" value="1">
                  <select name="odemedurum">
                    <option value="1" <?php if($siparisler[0]["durum"]==1) { echo 'selected="selected"';} ?> >Ödendi</option>
                    <option value="2" <?php if($siparisler[0]["durum"]==2) { echo 'selected="selected"';} ?>>Ödeme Bekliyor</option>
                  </select>
                  <input type="submit" name="ilet" value="Güncelle">
                </form>

              </td>

              <td><?=date("d.m.Y",strtotime($siparisler[0]["tarih"]))?></td>
            
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
              <td><img src="<?=ANASITE?>images/urunler/<?=$urunler[0]["resim"]?>" style="height: 50px; width: auto; display: block;"></td>
              <td><?=stripslashes($urunler[0]["baslik"])?><br><small style="float: left; color: #d24474; display: block;"><?=$ozellikler?></small></td>
              <td><?=number_format($siparisurunler[$i]["uruntutar"],2,".",",")?> TL</td>
              <td><?=$siparisurunler[$i]["adet"]?></td>
              <td><?=number_format($siparisurunler[$i]["toplamtutar"],2,".",",")?></td>
            </tr>
            <?php   }
                }
              }
              ?>
            </table>

          </form>
          <!-- /form_container -->

            </div>
            <!-- /.card-body -->
          </div>
       
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php } } ?>