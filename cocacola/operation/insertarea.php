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
$area = $_POST['area'];

if(isset($_POST['submit'])){
$addarea=($customer->insertarea($area));


if ($addarea[0] > 0) {

    echo "<script>alert('Add Area Successfuly ');</script>";
    echo("<script>location.href = '../addarea.php';</script>");

    exit;
} else {

    echo "<script>alert('Some thing wrong > can not open this page');</script>";
    echo("<script>location.href = '../addcustomer.php';</script>");

}
}
?>