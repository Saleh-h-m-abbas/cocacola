<?php
require '../class/customer.inc';

$customer = new customer();

//recipient data
$username = $_POST['username'];
$fullname = $_POST['fullname'];
$customertype = $_POST['customertype'];
$company = $_POST['company'];
$phone = $_POST['phone'];
$area = $_POST['area'];
$country = $_POST['country'];
$street = $_POST['street'];
$email = $_POST['email'];
$password = $_POST['password'];
$confirmpass = $_POST['confirmpass'];


$addcust=($customer->insertcustomer($username,$fullname,$customertype,$company,$phone,$area,$country,$street,$email,$password));

if ($addcust[0] > 0) {

    echo "<script>alert('Add Customer Successfuly ');</script>";
    echo("<script>location.href = '../customerlist.php';</script>");

    exit;
} else {

    echo "<script>alert('Some thing wrong > can not open this page');</script>";
    echo("<script>location.href = '../addcustomer.php';</script>");

}

?>