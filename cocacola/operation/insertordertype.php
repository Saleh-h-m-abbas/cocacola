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
$ordertype = $_POST['ordertype'];

if(isset($_POST['submit'])){
    $addordertype=($customer->insertordertype($ordertype));


    if ($addordertype[0] > 0) {

        echo "<script>alert('Add Order Type Successfuly ');</script>";
        echo("<script>location.href = '../addordertype.php';</script>");

        exit;
    } else {

        echo "<script>alert('Some thing wrong > can not open this page');</script>";
        echo("<script>location.href = '../addordertype.php';</script>");

    }
}
?>