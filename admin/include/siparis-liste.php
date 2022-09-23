
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Sipariş Liste</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
              <li class="breadcrumb-item active">Sipariş Liste</li>
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
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                <th>S. KOD</th>
                <th>Müşteri Bilgisi</th>
                <th>KDV Hariç Tutar</th>
                <th>KDV Tutar</th>
                <th>Ödenen Tutar</th>
                <th>Ödeme Tipi</th>
                <th>Ödeme Durumu</th>
                <th>Tarih</th>
                <th>İncele</th>
              </tr>
                </thead>
                <tbody>
               
<?php
              $siparisler=$VT->VeriGetir("siparisler","","","ORDER BY ID DESC");
              if ($siparisler!=false) {
                for ($i=0; $i <count($siparisler) ; $i++) { 
          
          $uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=? AND durum=?",array($siparisler[$i]["uyeID"],1),"ORDER BY ID ASC",1);

            if ($uyebilgisi!=false) { 

            if ($siparisler[$i]["odemetipi"]==1) { $odemetipi="Kredi/Banka Kartı"; }
            if ($siparisler[$i]["odemetipi"]==2) { $odemetipi="Havale/EFT"; }
            if ($siparisler[$i]["odemetipi"]==3) { $odemetipi="Kapıda Ödeme"; }
            if($uyebilgisi[0]["tipi"]==1){
              $adsoyad=$uyebilgisi[0]["ad"]." ".$uyebilgisi[0]["soyad"];
            }else{
              $adsoyad=$uyebilgisi[0]["firmaadi"];

            }
                  ?>
            <tr>
              <td><?=$siparisler[$i]["sipariskodu"]?></td>
              <td><?=$adsoyad?></td>
              <td><?=number_format($siparisler[$i]["kdvharictutar"],2,".",",")?> TL</td>
              <td><?=number_format($siparisler[$i]["kdvtutar"],2,".",",")?> TL</td>
              <td><?=number_format($siparisler[$i]["odenentutar"],2,".",",")?> TL</td>
              <td><?=$odemetipi?></td>

              <td>
                <?php
                if ($siparisler[$i]["durum"]==1) { ?>
                  <strong style="color: #4caf50;">Ödendi</strong>

          <?php   }else{ ?>
                  <strong style="color: #ff9800;">Ödeme Bekliyor</strong>

          <?php     }

                ?>  

              </td>

              <td><?=date("d.m.Y",strtotime($siparisler[$i]["tarih"]))?></td>
              <td><a href="<?=SITE?>siparis-detay/<?=$siparisler[$i]["sipariskodu"]?>">İncele</a></td>
            </tr>
          <?php     }
                }
              }else{ ?>
                <tr>
                  <td colspan="7">Henüz siparişiniz bulunmamaktadır.</td>
                </tr>
        <?php   }
              
              ?>

                </tbody>
                <tfoot>
                <tr>
                <th>S. KODU</th>
                <th>Müşteri Bilgisi</th>
                <th>KDV Hariç Tutar</th>
                <th>KDV Tutar</th>
                <th>Ödenen Tutar</th>
                <th>Ödeme Tipi</th>
                <th>Ödeme Durumu</th>
                <th>Tarih</th>
                <th>İncele</th>
              </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
       
       
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
 
