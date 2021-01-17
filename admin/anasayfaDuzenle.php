<?php
$sayfa = "Ana Sayfa";
include('Include/ahead.php');

if($_SESSION['yetki']!="1"){
    echo "<script> alert ('Bu işlem kısıtlıdır,yalnızca yönetici tarafından düzenlenebilir')</script>";
    exit;
}

$sorgu = $baglanti->prepare("select * from anasayfa where id=:id");
$sorgu->execute(['id' => (int)$_GET["id"]]);
$sonuc = $sorgu->fetch();

if($_POST){ //VERİ DÜZENLEME
    $duzenleSorgu=$baglanti->prepare("Update anasayfa set ustBaslik=:ustBaslik, altBaslik=:altBaslik, linkMetin=:linkMetin, link=:link, tanimlama=:tanimlama, anahtar=:anahtar where id=:id");
    $duzenle=$duzenleSorgu->execute([
        'ustBaslik'=>$_POST["ustBaslik"],
        'altBaslik'=>$_POST["altBaslik"],
        'linkMetin'=>$_POST["linkMetin"],
        'link'=>$_POST["link"],
        'tanimlama'=>$_POST["tanimlama"],
        'anahtar'=>$_POST["anahtar"],
        'id'=>(int)$_GET["id"]
    ]);
    if($duzenle){
        echo "<script> alert ('Düzenleme başarılı bir şekilde kaydedildi.')</script>";
    }
}
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Ana Sayfa Düzenleme</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Ana Sayfa Düzenleme</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <lable>Üst Başlık</lable>
                        <input type="text" name="ustBaslik" required class="form-control" value="<?=$sonuc["ustBaslik"]?>">
                    </div>
                    <div class="form-group">
                        <lable>Alt Başlık</lable>
                        <input type="text" name="altBaslik" required class="form-control" value="<?=$sonuc["altBaslik"]?>">
                    </div>
                    <div class="form-group">
                        <lable>Link Metin</lable>
                        <input type="text" name="linkMetin" required class="form-control" value="<?=$sonuc["linkMetin"]?>">
                    </div>
                    <div class="form-group">
                        <lable>Link</lable>
                        <input type="text" name="link" required class="form-control" value="<?=$sonuc["link"]?>">
                    </div>
                    <div class="form-group">
                        <lable>Tanımlama</lable>
                        <input type="text" name="tanimlama" required class="form-control" value="<?=$sonuc["tanimlama"]?>">
                    </div>
                    <div class="form-group">
                        <lable>Anahtar</lable>
                        <input type="text" name="anahtar" required class="form-control"
                               value="<?=$sonuc["anahtar"]?>">
                    </div>
                    <div class="form-group">

                        <input type="submit" value="Kaydet" class="btn-outline-primary">

                </form>
            </div>
        </div>
    </div>
</main>
<?php

include('Include/afooter.php')
?>
