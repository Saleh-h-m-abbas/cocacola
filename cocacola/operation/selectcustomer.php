<?php

require '../class/database.inc';
session_start();

if(isset($_SESSION['email'])){
    echo("<script>location.href ='index.php';</script>");

}
/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 11/24/18
 * Time: 12:29 PM
 */


$db=new Database();
$db->connect();



$id=$_REQUEST["customerid"];


$x=$db->select('customer','*','','id='.$id,'','');
$x1=$db->getResult();
if(($db->numRows())!= null){
     $_SESSION['customerid']=$id;
     $_SESSION['customeremail']=$x1[0]['email'];
     $_SESSION['customerphone']=$x1[0]['phone'];
     $_SESSION['customertypeid']=$x1[0]['customertypeid'];
     $_SESSION['companyname']=$x1[0]['company'];
     $_SESSION['areaid']=$x1[0]['areaid'];
     $_SESSION['contry']=$x1[0]['country'];
     $_SESSION['street']=$x1[0]['street'];

     return "yes";
}else{
    echo "no";
}



?>