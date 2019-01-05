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

    $id=$_REQUEST["salesman"];
    $password=$_REQUEST["pass"];


    $x=$db->select('emp','*','','empno='.'"'.$id.'"'.' And pass='.$password,'','');
    $x1=$db->getResult();
    if(($db->numRows())!= null){
         $_SESSION['salesemail']=$x1[0]['email'];
         echo "welcome ".$x1[0]['user'];
    }else{
        echo "wrong password";
    }


?>
