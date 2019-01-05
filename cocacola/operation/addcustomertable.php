<?php
/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 12/3/18
 * Time: 10:15 AM
 */

require '../class/inv.inc';


$customer = new customer();

$customerid = $_REQUEST["customerid"];
$email = $_REQUEST["email"];
$phone = $_REQUEST["phone"];
$typeid = $_REQUEST["typeid"];
$company = $_REQUEST["company"];
$areaid = $_REQUEST["areaid"];
$contry = $_REQUEST["contry"];
$street = $_REQUEST["street"];



$customeridintable = ($customer->insertcustomerintable($customerid,$email,$phone,$typeid,$company,$areaid,$contry,$street));


echo $customeridintable[0];



?>