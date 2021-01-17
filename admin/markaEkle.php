<?php
$sayfa = "Markalarımız";
include('Include/ahead.php');

if ($_SESSION["yetki"] != "1") {
    echo "<script> alert ('Bu işlem için yetkiniz yoktur')</script>";
    exit;
}


if ($_POST) {

    $aktif = 0;
    if (isset($_POST["aktif"])) $aktif = 1;

    $hata ='';

    if ($_POST["link"] != '' && $_POST["sira"] != '' && $_FILES["foto"]['name'] != '')
        if ($_FILES['foto']['error'] != 0) {
            $hata .= 'Dosya yüklenemedi,terar deneyiniz...';
        } else if (file_exists('../assents/img/logos/' . strtolower($_FILES["foto"]['name']))) {
            $hata .= 'Aynı dosyadan mevcut';
        } else if ($_FILES['foto']['size'] > (1024 * 1024 * 2)) {
            $hata .= 'Azami MB aşımı';
        } else if (!in_array($_FILES['foto']['type'], ['image/png', 'image/jpeg'])) {
            $hata .= 'Dosya türünüzün JPEG veya PNG  olmalıdır ';

        } else {
            copy($_FILES['foto']['tmp_name'], '../assets/img/logos' . strtolower(($_FILES["foto"]['name'])));
            $ekleSorgu = $baglanti->prepare('INSERT INTO referans SET foto=:foto, link=:link, sira=:sira, aktif=:aktif');
            $yukle = $ekleSorgu->execute([
                'foto' => strtolower($_FILES["foto"]['name']),
                'link' => $_POST['link'],
                'sira' => $_POST['sira'],
                'aktif' => $aktif
            ]);
            if ($yukle) {
                echo "<script> alert ('Görseliniz başarılı bir şekilde yüklendi')</script>";
            }


        }
    if ($hata!='') {
        echo "<script> alert ('Dosyanız 2MB büyük veya .PNG ya da .JPEG değildir.')</script>";
    }
}

?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4">Marka Ekle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active">Marka Ekle</li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <lable>Fotoğraf</lable>
                        <input type="file" name="foto" required class="form-control file">
                    </div>
                    <div class="form-group">
                        <lable>Link</lable>
                        <input type="text" name="link" required class="form-control" value="<?= @$_POST["link"] ?>">
                    </div>
                    <div class="form-group">
                        <lable>Sıra</lable>
                        <input type="text" name="sira" required class="form-control" value="<?= @$_POST["sira"] ?>">
                    </div>
                    <div class="form-group form-check">
                        <label><input type="checkbox" name="aktif" class="form-check-input"> Sayfanızda gösterilsin mi?</label>
                        </label>
                    </div>
                    <div class="form-group">

                        <input type="submit" value="Ekle" class="btn-outline-primary">
                    </div>


                </form>
            </div>
        </div>
    </div>
</main>
<?php

include('Include/afooter.php')
?>
