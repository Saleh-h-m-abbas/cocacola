<?php
require '../class/inv.inc';
$product = new invenotry();

$taxselected = $_REQUEST["id"];

$taxis = $product->selectall('tax','*', NULL,'id='.$taxselected,'','data');

    echo $taxis[0]['taxpersentage'];

?>





