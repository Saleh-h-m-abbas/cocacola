<?php
require '../class/inv.inc';


$product = new invenotry();


if(isset($_POST['submit'])) {


    $qty = $_POST["qty"];
    $uofm = $_POST["uofm"];
    $item = $_POST["item"];
    $trxtype = $_POST["trxtype"];
    $from = $_POST["from"];
    $to = $_POST["to"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $note = $_POST["note"];

    $trxdata = ($product->selectall('invtranstype', '*', NULL, 'invtycode=' . $trxtype, '','data'));

    $uofmw = ($product->selectall('uofm','*', NULL,'id='.$uofm,'','data'));
    $qtyafterw=$qty*$uofmw[0]['weightofqty'];
    if ($trxdata[0]['typeoftype'] == 0) {
        $newqty="-".$qtyafterw;
    } else {
        $newqty=$qtyafterw;
    }

    // $invtransdesc,$qty,$itemcodetrans,$trxtypecode,$date,$time,$fromorg,$toorg
    $inserttrx=($product->inserttrans($newqty,$uofm,$item,$trxtype,$from,$to,$date,$time,$note));
    $sumqty=$product->sumon($item);
    $product->updateonhand($item,$sumqty);

    if($inserttrx[0]>0){

        echo "<script>alert('Transaction Successfuly ');</script>";
        echo("<script>location.href = '../trx.php';</script>");

        exit;

    }else{

        echo "<script>alert('Some thing wrong > can not open this page');</script>";
        echo("<script>location.href = '../trx.php';</script>");

    }
}


?>