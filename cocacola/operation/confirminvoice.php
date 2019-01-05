<?php
/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 12/10/18
 * Time: 3:30 PM
 */

require '../class/inv.inc';

session_start();

$product = new invenotry();

$invoiceid=$_REQUEST['invoice'];
$stat=$_REQUEST['status'];

echo $product->updateinvoice($invoiceid,$stat)[0];


?>