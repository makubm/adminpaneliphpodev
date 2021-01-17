<?php
$sayfa = "İletişim Formu";
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


            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="veriTablosu" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th></th>
                            <th>Ad </th>
                            <th>E-mail</th>
                            <th>Mesaj</th>
                            <th>Tarih</th>
                            <th></th>
                            <th></th>
                        </tr>
                        </thead>
                        </tbody>
                        <?php
                        $sorgu = $baglanti->prepare("select * from iletisimformu");
                        $sorgu->execute();
                        while ($sonuc = $sorgu->fetch()) {
                            ?>
                            <tr>
                                <td><?= $sonuc["id"] ?></td>
                                <td><?= $sonuc["ad"] ?></td>
                                <td><?= $sonuc["email"] ?></td>
                                <td>

                                    <a href="#" class="btn btn-success" data-toggle="modal" data-target="#okuModal<?= $sonuc["id"] ?>">

                                        Mesajı Oku</span></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="okuModal<?= $sonuc["id"] ?>" tabindex="-1"
                                         role="dialog"
                                         aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Mesaj</h5>
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">

                                                    <?= $sonuc["mesaj"] ?>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Kapat
                                                    </button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </td>
                                <td><?= $sonuc["tarih"] ?></td>
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

                                                        Silmek istediğinizden emin misiniz?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                                data-dismiss="modal">İptal
                                                        </button>
                                                        <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=iletisimformu"
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
