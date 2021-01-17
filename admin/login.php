<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Page Title - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
            crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Kullanıcı
                                    Girişi</h3></div>
                            <div class="card-body">
                                <?php
                                session_start();
                                include("../Include/vt.php");

                                if (isset($_SESSION["Oturum"]) && $_SESSION["Oturum"] == "10711453") {
                                    header("location:index.php");
                                } elseif (isset($_COOKIE["cerez"])) {
                                    $sorgu = $baglanti->prepare("select kadi, yetki from kullanici where aktif=1");
                                    $sorgu->execute();
                                    while ($sonuc = $sorgu->fetch()) {
                                        if ($_COOKIE["cerez"] == md5("1071" . $sonuc["kadi"] . "1453")) {
                                            $_SESSION["Oturum"] = "10711453";
                                            $_SESSION["kadi"] = $sonuc["kadi"];
                                            $_SESSION["yetki"] = $sonuc["yetki"];
                                            header("location:index.php");
                                        }
                                    }
                                }


                                if ($_POST) {
                                    $kadi = $_POST["txtKadi"];
                                    $parola = $_POST["txtParola"];
                                }

                                //echo md5("1071"."01234"."1453");
                                ?>
                                <form method="post" action="login.php">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Kullanıcı Adı</label>
                                        <input class="form-control py-4" id="inputEmailAddress" name="txtKadi"
                                               value="<?= @$kadi ?>" type="text"
                                               placeholder="Kullanıcı adınızı giriniz"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Şifre</label>
                                        <input class="form-control py-4" id="inputPassword" name="txtParola"
                                               type="password" placeholder="Parola giriniz"/>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="rememberPasswordCheck"
                                                   type="checkbox" name="cbHatirla"/>
                                            <label class="custom-control-label" for="rememberPasswordCheck">Şifremi
                                                Hatırla</label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="password.html">Forgot Password?</a>
                                        <input type="submit" class="btn btn-primary" value="Giriş"/>

                                    </div>
                                </form>
                                <?php
                                if ($_POST) {
                                    $sorgu = $baglanti->prepare("select parola, yetki from kullanici where kadi=:kadi and aktif=1");
                                    $sorgu->execute(['kadi' => htmlspecialchars($kadi)]);
                                    $sonuc = $sorgu->fetch();

                                    if (md5("1071" . $parola . "1453") == $sonuc["parola"]) {

                                        $_SESSION["Oturum"] = "10711453";
                                        $_SESSION["kadi"] = $kadi;
                                        $_SESSION["yetki"] = $sonuc["yetki"];

                                        if (isset($_POST["cbHatirla"])) {
                                            setcookie("cerez", md5("1071" . $kadi . "1453"), time() + (60 * 60 * 24 * 30));
                                        }

                                        header("location:index.php");

                                    }else {
                                        echo "<script> Swal.fire('Hata!', 'Kullanıcı adı veya parola hatalıdır!!!' 'error')</script>";
                                    }
                                }
                                ?>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>
