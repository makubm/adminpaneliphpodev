<?php
$sayfa="İletişim";
include ("Include/vt.php");
$tanimlama="iletişim sayfası";
$key="iletişim";
include ("Include/head.php");
?>

        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase mt-3">Bizimle İletişime Geçin</h2>
                    <h3 class="section-subheading text-muted">Uzman çalışanlarımız ile iletişime geçerek istek / şikayet ve önerilerinizi belirtebilirsiniz.</h3>
                </div>
                <form id="contactForm" name="sentMessage" method="post" action="iletisim">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" id="name" name="txtAd" type="text" placeholder="Adınız Soyadınız *" required="required" data-validation-required-message="Please enter your name." />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="email" type="email" name="txtEmail" placeholder="E-posta adresiniz *" required="required" data-validation-required-message="Please enter your email address." />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group mb-md-0">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <textarea class="form-control" id="message" name="txtMesaj" placeholder="Mesajınızı yazınız *" required="required" data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div id="success"></div>
                        <button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">E-posta Gönder</button>
                    </div>
                </form>


                <?php
                if($_POST){
                    $sorgu=$baglanti->prepare("insert into iletisimformu SET ad=:ad,email=:email,mesaj=:mesaj");
                    $ekle=$sorgu->execute(
                            [
                                    'ad'=>htmlspecialchars($_POST["txtAd"]),
                                    'email'=>htmlspecialchars($_POST["txtEmail"]),
                                    'mesaj'=>htmlspecialchars($_POST["txtMesaj"]),

                            ]
                    );

                    if($ekle){
                        echo"<script> alert('Başarılı...')</script>";
                    }
                    else{
                        echo"<script> alert('Mesajınız gönderilemedi...')</script>";
                    }

                }
                ?>
            </div>
        </section>
<?php
include ("Include/footer.php");
?>
