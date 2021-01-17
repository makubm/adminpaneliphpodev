<?php
$sayfa = " ";
include('Include/ahead.php');

if ($_SESSION["yetki"] != "1") {
    echo "<script> alert ('Bu işlem için yetkiniz yoktur')</script>";
    exit;
}



if($_GET)
{
  $tablo=$_GET["tablo"];
  $id=(int)$_GET["id"];

  $sorgu=$baglanti->prepare("DELETE FROM $tablo WHERE id=:id");
  $sonuc=$sorgu->execute(["id"=>$id]);
  if($sonuc){
      echo "<script> alert ('Silme işlemi başarıyla gerçekleşmiştir.')</script>";
  }
}

include('Include/afooter.php');