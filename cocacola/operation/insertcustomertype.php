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
$type = $_POST['type'];

if(isset($_POST['submit'])){
$addtype=($customer->inserttype($type));


if ($addtype[0] > 0) {

    echo "<script>alert('Add Type Successfuly ');</script>";
    echo("<script>location.href = '../addcustomertype.php';</script>");

    exit;
} else {

    echo "<script>alert('Some thing wrong > can not open this page');</script>";
    echo("<script>location.href = '../addcustomertype.php';</script>");

}
}
?>