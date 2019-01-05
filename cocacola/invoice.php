
<?php
/**
 * Created by PhpStorm.
 * User: salehabbas
 * Date: 11/21/18
 * Time: 9:29 AM
 */

//call inv class
require './class/inv.inc';

//start session
session_start();
//unset($_SESSION["customerid"]);
//if not login go to login page
if (!isset($_SESSION['email'])) {
    echo("<script>location.href ='pages-login.php';</script>");
}
if (isset($_SESSION['groupID'])!=1) {
    echo("<script>location.href ='pages-login.php';</script>");
}
//if account lock go to lock page
if ($_SESSION['lock'] != 0) {
    echo("<script>location.href ='pages-Lockscreen.php';</script>");
}
if(!isset($_SESSION['salesemail'])){
    $_SESSION['salesemail']=$_SESSION['email'];
}
if(!isset($_SESSION['count'])){
    $_SESSION['count']=0;
}

//create object from inv class
$employee = new emp();
$numberofemployee=$employee->selectall('emp','*',NULL,'groupID=1','','number');

$product=new invenotry();
$customer=new customer();


$invoice=$_GET['invoice'];
$invoicenumber=$product->selectall('invoice','*',NULL,'invoiceid='.$invoice,'','number');
$invoicedata=$product->selectall('invoice','*',NULL,'invoiceid='.$invoice,'','data');
$totalprice=0;

?>

<?php require_once('templates/headers/opening.tpl.php'); ?>


<script>
    function printDiv(divName) {

        printContents = document.getElementById(divName).innerHTML;
        originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
    <!-- Specific Page Data -->
<?php $title = 'Invoices'; ?>
<?php $keywords = ''; ?>
<?php $description = ''; ?>
<?php $page = 'pages';   // To set active on the same id of primary menu ?>
    <!-- End of Data -->

<?php require_once('templates/headers/'.$header.'.tpl.php'); ?>

    <div class="content">
        <div class="container">
            <?php if ($navbar_left_config != 0) { $current_navbar="vd_navbar-left"; require('templates/navbars/'.$navbar_left.'.tpl.php'); }?>
            <?php if ($navbar_right_config != 0) { $current_navbar="vd_navbar-right"; require('templates/navbars/'.$navbar_right.'.tpl.php'); }?>

            <!-- Middle Content Start -->

            <div class="vd_content-wrapper">
                <div class="vd_container">
                    <div class="vd_content clearfix">
                        <div class="vd_head-section clearfix">
                            <div class="vd_panel-header">
                                <ul class="breadcrumb">
                                    <li><a href="index.php">Home</a> </li>
                                    <li><a href="pages-custom-product.php">Sales</a> </li>
                                    <li class="active">Invoice</li>
                                </ul>
                                <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                            </div>
                        </div>
                        <div class="vd_title-section clearfix">
                            <div class="vd_panel-header no-subtitle">
                                <h1>Invoice</h1>
                            </div>
                        </div>
                        <div class="vd_content-section clearfix">
                            <div  class="row" >
                                <div class="col-sm-9" id="invoice">
                                    <div class="panel widget light-widget">
                                        <div class="panel-body" style="padding:40px;">
                                            <div class="pull-right text-right">
                                                <h3 class="font-semibold mgbt-xs-20">INVOICE</h3>
                                                <table class="table table-bordered">
                                                    <tr>
                                                        <th>Invoice No.</th>
                                                        <th>Date</th>
                                                    </tr>
                                                    <tr>
                                                        <td><?php echo $invoicedata[0]['invoiceid']; ?></td>
                                                        <td><?php echo $invoicedata[0]['Invoicedate']; ?></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="mgbt-xs-20"><img alt="logo" src="img/logo.png"  STYLE="width: 200PX;"/></div>
                                            <address>
                                                Ramallah, Palestine<br>
                                                P.O. Box : 1395<br>
                                                Phone: + (972) 022907020
                                                <br>
                                                Email : <a href="mailto:info@nbc.ps">info@nbc.ps</a> <br>
                                                Web site:
                                                <a href="http://www.nbc-pal.ps">www.nbc-pal.ps</a>
                                            </address>
                                            <hr/>
                                            <br/>
                                            <div class="pd-25">
                                                <div class="row">
                                                    <?php

                                                 $customerselected=$customer->selectall('cutomertableorder','*',NULL,'cutomertableorderid='.$invoicedata[0]['customeridtable'],'','data');

                                                    ?>
                                                    <div class="col-xs-4">
                                                        <address>
                                                            <strong>Ship To:</strong><br>
                                                            <?php
                                                            $dataofcustomer=$product->selectall('customer','username',NULL,'id='.$customerselected[0]['customerid'],'','data');

                                                            echo $dataofcustomer[0]['username'];?><br>

                                                            <?php
                                                            $typedescdata=$product->selectall('customertype','typedesc',NULL,'custmeridty='.$customerselected[0]['typeid'],'','data');

                                                            echo $typedescdata[0]['typedesc'];?>, <?php echo $customerselected[0]['companyname'];?><br/>
                                                            <?php echo $customerselected[0]['country'];?>, <?php echo $customerselected[0]['street'];?><br>
                                                            Phone : + (970) <?php echo $customerselected[0]['phone'];?> <br>
                                                            Email : <a href="mailto:<?php echo $customerselected[0]['email'];?>"><?php echo $customerselected[0]['email'];?></a>
                                                        </address>
                                                    </div>

                                                    <div class="col-xs-8">
                                                        <div class="text-right">
                                                            <strong>Due Balance:</strong><br>
                                                            <span class="mgtp-5 vd_green font-md">₪ <?php echo $invoicedata[0]['total']; ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>


                                            <table class="table table-condensed table-striped">
                                                <?php
                                                $productnumber=$product->selectall('tableorderitem','*',NULL,'invnumber='.$invoice,'','number');
                                                $productdata=$product->selectall('tableorderitem','*',NULL,'invnumber='.$invoice,'','data');

                                                ?>
                                                <thead>

                                                <tr>
                                                    <th class="text-center" style="width:20px;">QTY</th>
                                                    <th>Product</th>
                                                    <th class="text-left" style="width:160px;">Unit of Measure</th>
                                                    <th class="text-left" style="width:80px;">Bonas</th>
                                                    <th class="text-left" style="width:110px;">Total QTY</th>
                                                    <th class="text-left" style="width:120px;">UNIT PRICE</th>
                                                    <th class="text-left" style="width:120px;">TOTAL</th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                <?php for($i=0;$i<$productnumber;$i++){ ?>
                                                <tr>
                                                    <td class="text-left"><?php echo $productdata[$i]['qty'];?></td>
                                                    <td><?php
                                                        $productselected=$product->selectall('item','*',NULL,'itemcode='.$productdata[$i]['itemid'],'','data');


                                                        echo $productselected[0]['itemdesc'];?></td>

                                                    <td class="text-left"> <?php
                                                      $unitofmes=  $product->selectall('itemuofm','*',NULL,'','numberofitem='.$productdata[$i]['uom'],'data');
                                                        $nameofunit=$product->selectall('uofm','*',NULL,'','id='.$unitofmes[$i]['uofmid'],'data');


                                                        echo $nameofunit[0]['uofm']; ?></td>
                                                    <td class="text-left">

                                                        <?php


                                                        $itemoffer=$product->selectall('offer','*',NULL,'id='.$productdata[$i]['offerid'],'','data');


                                                        echo intval(($productdata[$i]['qty']*$nameofunit[0]['weightofqty'])/$itemoffer[0]['qty'])*$itemoffer[0]['Bonus'];
                                                        ?>


                                                    </td>
                                                    <td class="text-left">
                                                        <?php echo $productdata[$i]['qty']*$nameofunit[0]['weightofqty']; ?>

                                                    </td>
                                                    <td class="text-left">
                                                        ₪
                                                        <?php

                                                        $itemprice=$product->selectall('itemprice','*',NULL,'itemcprice='.$productdata[$i]['itemid'].' AND status=1','','data');

                                                        echo $itemprice[0]['price'];?></td>
                                                    <td class="text-left">₪
                                                    <?php   echo $productdata[$i]['qty']*$nameofunit[0]['weightofqty']*$itemprice[0]['price'];


                                                    $totalprice=$totalprice+($productdata[$i]['qty']*$nameofunit[0]['weightofqty']*$itemprice[0]['price']);
                                                    ?>


                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th colspan="2" rowspan="3" class="bdr">Note:
                                                        <p class="font-normal"><?php echo $invoicedata[0]['note']; ?></p></th>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <th class="text-left">Sub Total</th>
                                                    <th class="text-left">₪ <?php echo $totalprice; ?></th>
                                                </tr>

                                                <tr>
                                                    <td  class="text-left  pd-10 no-bd"></td>
                                                    <td  class="text-left  pd-10 no-bd"></td>
                                                    <td  class="text-left  pd-10 no-bd"></td>
                                                    <th class="text-left  pd-10 no-bd">Discount</th>
                                                    <th class="text-left  pd-10 vd_red no-bd">(₪ <?php

                                                        $discount=$product->selectall('discount','*',NULL,'id='.$invoicedata[0]['discountid'],'','data');
                                                        echo $totalprice*$discount[0]['percentage']; ?>)</th>
                                                </tr>
                                                <tr>
                                                    <th  class="text-left  pd-10 no-bd"></th>
                                                    <th  class="text-left  pd-10 no-bd"></th>
                                                    <td  class="text-left  pd-10 no-bd"></td>
                                                    <th class="text-left  pd-10 no-bd">Taxes</th>
                                                    <th class="text-left  pd-10 no-bd">₪<?php

                                                        $tax=$product->selectall('tax','*',NULL,'id='.$invoicedata[0]['taxid'],'','data');
                                                        echo $totalprice*$tax[0]['taxpersentage']; ?>

                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th colspan="2">Thank you for your business. Please remit the total amount due within 30 days.</th>
                                                    <th></th>
                                                    <th></th>
                                                    <th></th>
                                                    <th class="text-left">Total</th>
                                                    <th class="text-left"><span class="vd_green font-sm font-normal">₪

                                                            <?php echo $totalprice-($totalprice*$discount[0]['percentage'])+($totalprice*$tax[0]['taxpersentage']) ;   ?>


                                                        </span></th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                        <!-- panel-body -->

                                    </div>
                                    <!-- Panel Widget -->
                                </div>
                                <!-- col-sm-9-->
                                <div class="col-sm-3">
                                    <div class="mgbt-xs-5">
                                        <button class="btn vd_btn vd_bg-grey" type="button" onclick="printDiv('invoice')"><i class="fa fa-print append-icon"></i>Print</button>
                                    </div>
                                    <div class="mgbt-xs-5">
                                        <button class="btn vd_btn vd_bg-green " type="button"><i class="fa fa-download append-icon"></i>Save as PDF</button>
                                    </div>
                                </div>
                            </div>
                            <!-- row -->

                        </div>
                        <!-- .vd_content-section -->

                    </div>
                    <!-- .vd_content -->
                </div>
                <!-- .vd_container -->
            </div>
            <!-- .vd_content-wrapper -->

            <!-- Middle Content End -->

        </div>
        <!-- .container -->
    </div>
    <!-- .content -->

<?php require_once('templates/footers/'.$footer.'.tpl.php'); ?>

    <!-- Specific Page Scripts Put Here -->


    <!-- Specific Page Scripts END -->

<?php require_once('templates/footers/closing.tpl.php'); ?>