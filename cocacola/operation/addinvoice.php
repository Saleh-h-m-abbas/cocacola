<?php
/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 12/3/18
 * Time: 11:16 AM
 */

require '../class/inv.inc';

session_start();

$product = new invenotry();
$emp=new emp();

$selesmanemail = $_SESSION['salesemail'];

$selesmanid= $emp->selectall('emp','*',NULL,'email="'.$selesmanemail.'"','','data');

$selesmanempnu=$selesmanid[0]['empno'];


$selesmanselected= $emp->selectall('salesman','id',NULL,'empid='.$selesmanempnu,'','data');

$salesmanidselected= $selesmanselected[0]['id'];


$customer = $_REQUEST["customer"];
$ordertype = $_REQUEST["ordertype"];
$discount = $_REQUEST["discount"];
$taxes = $_REQUEST["taxes"];
$note = $_REQUEST["note"];
$endtotal = $_REQUEST["endtotal"];


$newinvoiceid=($product->insertinvoice($salesmanidselected,$customer,$ordertype,$discount,$taxes,$note,$endtotal));

$product->addquta($newinvoiceid[0]);


echo $newinvoiceid[0];

?>