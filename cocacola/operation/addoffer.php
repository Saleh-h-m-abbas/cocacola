<?php
/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 11/21/18
 * Time: 3:38 PM
 */


require '../class/inv.inc';
$product = new invenotry();
if(isset($_POST['submit'])){

    $itemcode = $_POST["item"];
    $qty = $_POST["qty"];
    $bonus = $_POST["bonus"];
    $t=time();
    $date=date("Y-m-d",$t);
    $from = $_POST["newfrom"];
    $to = $_POST["newto"];
    if($to >$date){$status=1;}else{$status=0;}
/*
    $product->updateprice($itemcode);
    $insertnewprice=$product->insertnewoffer($itemcode, $qty, $from, $to,$bonus,$status);

    if($insertnewprice[0]>=0){

        echo "<script>alert('Added Price Successfuly ');</script>";
        echo("<script>location.href = '../pricelist.php';</script>");

        exit;

    }else{

        echo "<script>alert('Some thing wrong > can not open this page');</script>";
        echo("<script>location.href = '../pricelist.php';</script>");

    }*/
}

?>