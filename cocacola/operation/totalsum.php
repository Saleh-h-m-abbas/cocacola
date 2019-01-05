<?php
require '../class/inv.inc';
session_start();
$product = new invenotry();

$qty = $_REQUEST["qty"];
$uofm  = $_REQUEST["uofm"];
$offer  = $_REQUEST["offer"];
$itemselected  = $_REQUEST["itemselected"];

$itemcodeis = $product->selectall('offer','*', NULL,'id='.$offer,'','data');

$offerqty=$itemcodeis[0]['qty'];
    $offerBonus=$itemcodeis[0]['Bonus'];



$total=$qty*$uofm;
if($offerBonus!=0){
$offereq=($total/$offerqty)*$offerBonus;
$totalqty=$offereq;
}else{

    $totalqty=0;
}

echo $totalqty;

?>

