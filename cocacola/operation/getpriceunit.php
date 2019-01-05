<?php
require '../class/inv.inc';
$product = new invenotry();

$itemselected = $_REQUEST["itemid"];

$itemunitis = $product->selectall('itemprice','*', NULL,'itemcprice='.$itemselected. ' AND status=1 ','','data');

   echo $itemunitis[0]['price'];

?>

