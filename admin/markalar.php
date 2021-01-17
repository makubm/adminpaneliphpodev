<?php
$sayfa = "Markalarımız";
include('Include/ahead.php');

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
                <a href="markaEkle.php"class="btn btn-success"> Marka Ekle</a>

            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="veriTablosu" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Görsel</th>
                            <th>Link</th>
                            <th>Sıra</th>
                            <th>Aktif</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        </tbody>
                        <?php
                        $sorgu = $baglanti->prepare("select * from referans");
                        $sorgu->execute();
                        while ($sonuc = $sorgu->fetch()) {
                            ?>
                            <tr>
                                <td><?= $sonuc["id"] ?></td>
                                <td><img width="100" src="../assets/img/logos/<?= $sonuc["foto"] ?>" alt=""></td>
                                <td><?= $sonuc["link"] ?></td>
                                <td><?= $sonuc["sira"] ?></td>
                                <td>
                                    <span class="fa fa-2x fa-<?= $sonuc["aktif"] == "1" ? "check text-success" : "times text-danger" ?>"></span>
                                </td>
                                <td><?php if ($_SESSION["yetki"] == "1") {
                                        ?>
                                        <a href="markaDuzenle.php?id=<?= $sonuc["id"] ?>">
                                            <span class="fa fa-edit fa-2x"></span>
                                        </a>
                                        <?php
                                    }
                                    ?>
                                </td>
                                <td class="text-center">
                                    <?php if ($_SESSION["yetki"] == "1") {
                                        ?>
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
                                                        <img src="../assets/img/logos/<?= $sonuc["foto"] ?>" alt="">
                                                        Silmek istediğinizden emin misiniz?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">İptal
                                                        </button>
                                                        <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=referans"
                                                           class="btn btn-outline-danger">Sil</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
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
