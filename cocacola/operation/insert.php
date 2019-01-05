<?php
require '../class/inv.inc';


$product = new invenotry();


if(isset($_POST['submit'])) {
    $Name = $_POST["name"];
    $Type = $_POST["Type"];
    $Categories = $_POST["Categories"];
    $Barcode = $_POST["Barcode"];

    $Status = $_POST["Status"];
    $POS = $_POST["pos"];
    $website = $_POST["website"];
    $weight = $_POST["weight"];

    $cbs = $_POST["cbs"];
    $DFC = $_POST["DFC"];
    $DFDO = $_POST["DFDO"];
    $DFIT = $_POST["DFIT"];

    $Price = $_POST["price"];
    $From = $_POST["from"];
    $to = $_POST["to"];
    $cost = $_POST["cost"];

    if ($website == "") {
        $webb = 0;
    } else {
        $webb = 1;
    }
    if ($POS == "") {
        $poos = 0;
    } else {
        $poos = 1;
    }
    if ($cbs == 0) {
        $cbss = 0;
    } else {
        $cbss = 1;
    }
    if ($Status == "Active") {
        $stat = 1;
    } else {
        $stat = 0;
    }
    $t=time();
    $time=date("Y-m-d H:i:s",$t);
    if ($to > $time) {
        $pricestat = 1;
    } else {
        $pricestat = 0;
    }


    $num = ($product->insert($Name, $Type, $Categories, $Barcode, $stat, $poos, $webb, $weight, $cbss, $DFC, $DFDO, $DFIT));

    $product->insertitemprice($num[0], $Price, $From, $to,$cost,$pricestat);
    $product->insertitemonhand($num[0]);

    $product->insertimage($num[0]);

    if ($product->insertimage($num[0]) == 0) {

        echo "<script>alert('Add Product Successfuly ');</script>";
        echo("<script>location.href = '../orgproductv.php';</script>");

        exit;
    } elseif ($product->insertimage($num[0]) == 1) {
        echo "<script>alert('Add have problem on upload image error is ')</script>";
        echo("<script>location.href = '../addproduct.php';</script>");

        exit;

    } else {

        echo "<script>alert('Some thing wrong > can not open this page');</script>";
        echo("<script>location.href = '../index.php';</script>");

    }
}



?>