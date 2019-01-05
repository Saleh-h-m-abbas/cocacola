<?php
/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 12/3/18
 * Time: 11:31 AM
 */


require '../class/inv.inc';

$item = new invenotry();

$invoiceid = $_REQUEST["numberinvoiceadded"];
$itemcode = $_REQUEST["itemidselected"];
$qty = $_REQUEST["qtyslected"];
$uofm = $_REQUEST["uomselected"];
$offer = $_REQUEST["offeridselected"];


$addeditemottable=($item->addarrayofitem($invoiceid,$itemcode,$qty,$uofm,$offer));

echo $addeditemottable[0];



?>