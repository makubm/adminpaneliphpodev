<?php
$sayfa = "Markalarımız";
include('Include/ahead.php');

if ($_SESSION["yetki"] != "1") {
    echo "<script> alert ('Bu işlem için yetkiniz yoktur')</script>";
    exit;
}
$id = $_GET['id'];
$sorgu = $baglanti->prepare("select * from referans where id=:id");
$sorgu->execute(['id' => $id]);
$sonuc = $sorgu->fetch();


if ($_POST) {

    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;

    $hata = '';
    $foto = '';

    if ($_POST["link"] != '' && $_POST["sira"] != '' && $_FILES["foto"]['name'] != '') {
        if ($_FILES['foto']['error'] != 0) {
            $hata .= 'Dosya yüklenemedi,terar deneyiniz...';
        } else if (file_exists('../assents/img/logos/' . strtolower($_FILES["foto"]['name']))) {
            $hata .= 'Aynı dosyadan mevcut';
        } else if ($_FILES['foto']['size'] > (1024 * 1024 * 4)) {
            $hata .= 'Azami MB aşımı';
        } else if (!in_array($_FILES['foto']['type'], ['image/png', 'image/jpeg'])) {
            $hata .= 'Dosya türünüzün JPEG veya PNG  olmalıdır ';

        } else {
           copy($_FILES['foto']['tmp_name'],'../assents/img/logos/'.strtolower(($_FILES["foto"]['name'])));
           unlik('../assents/img/logos/'.$sonuc['foto']);
           $foto=strtolower($_FILES["foto"]['name']);


        }
        if ($hata != '') {
            echo "<script> alert ('Dosyanız yüklenemedi')</script>";
        }


    } else {
        $foto = $sonuc['foto'];
    }
    if ($_POST["link"] != '' && $_POST["sira"] != '' && $hata == '') {
        $Sorgu = $baglanti->prepare('UPDATE  referans SET foto=:foto, link=:link, sira=:sira, aktif=:aktif WHERE id=:id');
        $guncelle = $Sorgu->execute([
            'foto' => $foto,
            'link' => $_POST['link'],
            'sira' => $_POST['sira'],
            'aktif' => $aktif,
            'id' => $id
        ]);
        if ($guncelle) {
            echo "<script> alert ('Dosyanız başarıyla eklendi.')</script>";
        }
    }
}
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Markaları Düzenle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Marka Düzenle</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <img width="100" src="../assents/img/logos/<?= $sonuc['foto'] ?>" alt=""> <br>
                        <lable>Fotoğraf</lable>
                        <input type="file" name="foto" class="form-control file">
                    </div>
                    <div class="form-group">
                        <lable>Link</lable>
                        <input type="text" name="link" required class="form-control" value="<?= $sonuc["link"] ?>">
                    </div>
                    <div class="form-group">
                        <lable>Sıra</lable>
                        <input type="text" name="sira" required class="form-control" value="<?= $sonuc["sira"] ?>">
                    </div>
                    <div class="form-group form-check">
                        <label>
                            <input type="checkbox" name="aktif"
                                   class="form-check-input"<?= $sonuc['aktif'] == 1 ? 'checked' : '' ?>> Sayfanızda
                            gösterilsin mi?</label>

                    </div>
                    <div class="form-group">

                        <input type="submit" value="Düzenle" class="btn-outline-primary">

                </form>
            </div>
        </div>
    </div>
</main>
<?php

include('Include/afooter.php')
?>
