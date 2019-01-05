<?php
/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 11/21/18
 * Time: 3:04 PM
 */
require '../class/inv.inc';
$product = new invenotry();
if(isset($_POST['submit'])){

    $itemcode = $_POST["item"];
    $Price = $_POST["newprice"];
    $From = $_POST["newfrom"];
    $t=time();
    $date=date("Y-m-d",$t);

    $to = $_POST["newto"];
    if($to >$date){$status=1;}else{$status=0;}

    $product->updateprice($itemcode);
  $insertnewprice=$product->insertnewprice($itemcode, $Price, $From, $to,$status);

    if($insertnewprice[0]>=0){

        echo "<script>alert('Added Price Successfuly ');</script>";
        echo("<script>location.href = '../pricelist.php';</script>");

        exit;

    }else{

        echo "<script>alert('Some thing wrong > can not open this page');</script>";
        echo("<script>location.href = '../pricelist.php';</script>");

    }
}

?>