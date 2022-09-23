
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Yorumlar </h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?=SITE?>">Anasayfa</a></li>
              <li class="breadcrumb-item active">Yorumlar </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <section class="content">
      <div class="container-fluid">
      <div class="row">
      
       </div>
       <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th style="width:50px;">Sıra</th>
                  <th>Açıklama</th>
                  <th>Ürün Bilgisi</th>
                  <th style="width:50px;">Durum</th>
                  <th style="width:80px;">Tarih</th>
                </tr>
                </thead>
                <tbody>
                <?php
				$veriler=$VT->VeriGetir("yorumlar","","","ORDER BY ID DESC");
				if($veriler!=false)
				{
					$sira=0;
					for($i=0;$i<count($veriler);$i++)
					{
						$sira++;
						if($veriler[$i]["durum"]==1){$aktifpasif=' checked="checked"';}else{$aktifpasif='';}
						
            $uyebilgisi=$VT->VeriGetir("uyeler","WHERE ID=?",array($veriler[$i]["uyeID"]));
            if ($uyebilgisi!=false) {
              $uyead=$uyebilgisi[0]["ad"];
            }else{
              $uyead="Belirtilmedi";
            }
            ?>
                        <tr>
                          <td><?=$sira?></td>
                          <td><?=stripslashes($veriler[$i]["metin"])?><br>
                            Üye Bilgisi:<?=$uyead?>

                        </td>
                        <td>
                          <?php
                          $urunler=$VT->VeriGetir("urunler","WHERE ID=?",array($veriler[$i]["urunID"]));
                          if ($urunler!=false) {
                            for ($x=0; $x <count($urunler) ; $x++) {  ?>
                              <p><?=$urunler[$x]["baslik"]?></p>
                              <p><?=$urunler[$x]["urunkodu"]?></p>
                   <?php        }
                          }
                          ?>
                        </td>
                          <td>
                          <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                      <input type="checkbox" class="custom-control-input aktifpasif<?=$veriler[$i]["ID"]?>" id="customSwitch3<?=$veriler[$i]["ID"]?>"<?=$aktifpasif?> value="<?=$veriler[$i]["ID"]?>" onclick="aktifpasif(<?=$veriler[$i]["ID"]?>,'yorumlar');">
                      <label class="custom-control-label" for="customSwitch3<?=$veriler[$i]["ID"]?>"></label>
                    </div>
                          </td>
                          <td><?=$veriler[$i]["tarih"]?></td>
                          
                        </tr>
                        <?php
					}
				}
				?>               
                </tbody>
                <tfoot>
                <tr>
                  <th>Sıra</th>
                  <th>Açıklama</th>
                  <th>Durum</th>
                  <th>Tarih</th>
                  <th>İşlem</th>
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
 
