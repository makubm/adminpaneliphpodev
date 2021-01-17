<?php
$sayfa = "Kullanıcılar";
include('Include/ahead.php');
if ($_SESSION["yetki"] != "1") {
    echo "<script> alert ('Bu işlem için yetkiniz yoktur')</script>";
    exit;
}
?>

<main>
    <div class="container-fluid">
        <h1 class="mt-4"><?= $sayfa ?></h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Dashboard</li>
            <li class="breadcrumb-item active"><?= $sayfa ?></li>
        </ol>


        <div class="card mb-4">
            <div class="card-header">
                <a href="kullaniciEkle.php"class="btn btn-success"> Kullanıcı Ekle</a>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table-bordered" id="veriTablosu" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>Kullanıcı Adı</th>
                            <th>Yetki</th>
                            <th>E-posta</th>
                            <th>Aktif</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        </tbody>
                        <?php
                        $sorgu = $baglanti->prepare("select * from kullanici");
                        $sorgu->execute();
                        while ($sonuc = $sorgu->fetch()) {
                            ?>
                            <tr>
                                <td><?= $sonuc["kadi"] ?></td>
                                <td><?= $sonuc["yetki"]==1?'Yönetici':'Normal kullanıcı' ?></td>
                                <td><?= $sonuc["email"] ?></td>
                                <td>
                                    <span class="fa fa-2x fa-<?= $sonuc["aktif"] == "1" ? "check text-success" : "times text-danger" ?>"></span>
                                </td>
                                <td class="text-center">
                                        <a href="kullaniciEkle.php?id=<?= $sonuc["id"] ?>">
                                            <span class="fa fa-edit fa-2x"></span>
                                        </a>

                                </td>
                                <td class="text-center">

                                        <a href="#" data-toggle="modal" data-target="#silModal<?= $sonuc["id"] ?>"><span
                                                    class="fa fa-trash fa-2x text-dark"></span></a>
                                        <!-- Modal -->
                                        <div class="modal fade" id="silModal<?= $sonuc["id"] ?>" tabindex="-1"
                                             role="dialog"
                                             aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                                        <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">

                                                        Silmek istediğinizden emin misiniz?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">İptal
                                                        </button>
                                                        <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=kullanici"
                                                           class="btn btn-outline-danger">Sil</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                </td>

                            </tr>
                            <?php
                        }
                        ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<?php

include('Include/afooter.php')
?>
