function sepeteEkle(SITE,urunID)
{
    var adet=$(".adet").val();
    $.ajax({
        method:"POST",
        url:SITE+"ajax.php",
        data:$("form#urunbilgisi").serialize()+"&urunID="+urunID+"&islemtipi=sepeteEkle",
        success: function(sonuc)
        {
            if(sonuc=="TAMAM")
            {
                alert("Sepete Eklendi.");
            }
            else if (sonuc=="STOK")
            {
                alert("Bu ürün stokta bulunmuyor.");
            }
            else
            {
                alert("İşleminiz şuan geçersizdir. Lütfen daha sonra tekrar deneyiniz.");
                console.log(sonuc);
            }
         }
        });
}

function sifreIste(SITE){
    var mailadresi=$(".sifremail").val();
    $.ajax({
        method:"POST",
        url:SITE+"ajax.php",
        data:{"mailadresi":mailadresi,"islemtipi":"sifreIste"},
        success: function(sonuc)
        {
            if(sonuc=="TAMAM")
            {
               window.location.href = SITE+"sifre-belirle/dogrulama";
            }
            else
            {
                alert("İşleminiz şuan geçersizdir. Lütfen daha sonra tekrar deneyiniz.");
                console.log(sonuc);
            }
         }
        });
}
