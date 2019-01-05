<?php
/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 11/21/18
 * Time: 10:29 AM
 */


require '../class/customer.inc';

$customer = new customer();

//recipient data
$typeofsales = $_POST['typeofsales'];

if(isset($_POST['submit'])){
    $addtypeofsales=($customer->inserttypeofsales($typeofsales));


    if ($addtypeofsales[0] > 0) {

        echo "<script>alert('Add Type Of Sales Successfuly ');</script>";
        echo("<script>location.href = '../addtypeofsales.php';</script>");

        exit;
    } else {

        echo "<script>alert('Some thing wrong > can not open this page');</script>";
        echo("<script>location.href = '../addtypeofsales.php';</script>");

    }
}
?>