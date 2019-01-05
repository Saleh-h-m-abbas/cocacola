<?php
require '../class/inv.inc';
$product = new invenotry();

$discoubtselected = $_REQUEST["id"];

$discountis = $product->selectall('discount','*', NULL,'id='.$discoubtselected,'','data');

echo $discountis[0]['percentage'];

?>





