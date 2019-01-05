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
//if not login go to login page
if (!isset($_SESSION['email'])) {
    echo("<script>location.href ='pages-login.php';</script>");
}
//if account lock go to lock page
if ($_SESSION['lock'] != 0) {
    echo("<script>location.href ='pages-Lockscreen.php';</script>");
}
//create object from inv class
$employee = new emp();
$product = new invenotry();

?>

<?php require_once('templates/headers/opening.tpl.php'); ?>

<script>

</script>


<!-- Specific Page Data -->
<?php $title = 'Invoices'; ?>
<?php $keywords = ''; ?>
<?php $description = ''; ?>
<?php $page = 'pages';   // To set active on the same id of primary menu  ?>
<?php
// Specific Data Tables CSS
$specific_css[0] = 'plugins/dataTables/css/jquery.dataTables.min.css';   // Data Table CSS
$specific_css[1] = 'plugins/dataTables/css/dataTables.bootstrap.css';   // Data Table CSS
$specific_css[2] = 'plugins/jquery-file-upload/css/jquery.fileupload.css';
$specific_css[3] = 'plugins/jquery-file-upload/css/jquery.fileupload-ui.css';
$page_css = '
						.form-wizard .nav > li > a{padding: 10px; margin-right:0; text-align: left; color:#888888;}
                        .tab-right{margin-left:-30px; margin-top:-1px; }
						.tab-right .panel {margin-right:-30px;}
						.tab-right .vd_panel-menu {right: 28px; top: -15px;}	
						.tab-right h3{border-bottom:1px solid #EEEEEE;}	
						table .vd_radio label:after{top:0;}		 
	 
	 ';
$page_responsive_css = '
						@media (max-width: 767px) {
							.tab-right{margin-left:0; margin-top:0;}
							.tab-right .panel{margin-right: 0;}

						}	
	';
?>
<!-- End of Data -->

<?php require_once('templates/headers/' . $header . '.tpl.php'); ?>


<!-- Body -->
<div class="content">
    <div class="container">
        <?php if ($navbar_left_config != 0) {
            $current_navbar = "vd_navbar-left";
            require('templates/navbars/' . $navbar_left . '.tpl.php');
        } ?>
        <?php if ($navbar_right_config != 0) {
            $current_navbar = "vd_navbar-right";
            require('templates/navbars/' . $navbar_right . '.tpl.php');
        } ?>

        <!-- Middle Content Start -->
        <div class="vd_content-wrapper">
            <div class="vd_container">
                <div class="vd_content clearfix">
                    <div class="vd_head-section clearfix">
                        <div class="vd_panel-header">
                            <ul class="breadcrumb">
                                <li><a href="index.php">Home</a> </li>
                                <li><a href="sales.php">Sales</a> </li>
                                <li class="active">Invoices</li>
                            </ul>
                            <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                        </div>
                    </div>
                    <div class="vd_title-section clearfix">
                        <div class="vd_panel-header">
                            <h1>Invoices</h1>
                            <small class="subtitle"></small>
                            <div class="form-group">


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel widget">
                                            <div class="panel-heading">
                                                <h3 class="panel-title  vd_black"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Table of Invoice </h3>
                                            </div>
                                            <div class="panel-body-list  table-responsive">
                                                <table class="table table-striped table-hover no-head-border">
                                                    <thead class="vd_bg-green vd_white">
                                                    <tr>
                                                        <th>Invoice ID</th>
                                                        <th>Invoice Date</th>
                                                        <th>Customer</th>
                                                        <th>Salesman</th>
                                                        <th>Order Type</th>
                                                        <th>Total</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>

                                                    <?php
                                                    $numberofinvoice=$product->selectall('invoice','invoiceid',NULL,'','','number');

                                                    $invoiceid=$product->selectall('invoice','*',NULL,'','','data');
                                                    for($i=0;$i<$numberofinvoice;$i++){
                                                        $invoicedata=$product->selectall('invoice','*',NULL,'invoiceid='.$invoiceid[$i]['invoiceid'],'','data');

                                                        ?>
                                                        <tr>
                                                            <td><?php echo $invoicedata[0]['invoiceid'];?></td>
                                                            <td><?php  echo $invoicedata[0]['Invoicedate'];?></td>

                                                            <td><?php

                                                          $customertabledata=$product->selectall('cutomertableorder','customerid',NULL,'cutomertableorderid='.$invoicedata[0]['customeridtable'],'','data');

                                                          $customer=$employee->selectall('customer','*',NULL,'id='.$customertabledata[0]['customerid'],'','data');
                                                            echo $customer[0]['username'];
                                                            ?></td>
                                                            <td><?php

                                                                $salesmantabledata=$product->selectall('salesman','empid',NULL,'id='.$invoicedata[0]['selesmanid'],'','data');

                                                                $salesman=$employee->selectall('emp','user',NULL,'empno='.$salesmantabledata[0]['empid'],'','data');
                                                                echo $salesman[0]['user'];
                                                                ?></td>
                                                            <td><?php
                                                                $ordertype=$product->selectall('ordertype','type',NULL,'id='.$invoicedata[0]['ordertypeid'],'','data');

                                                                echo $ordertype[0]['type'];?></td>

                                                            <td ><?php echo "₪ ". $invoicedata[0]['total'];?></td>
                                                            <td class="center">

                                                                <?php

                                                                    $quotations=$product->selectall('quotations','*',NULL,'invoicenumber='.$invoicedata[0]['invoiceid'],'','data');

                                                                if($quotations[0]['status']==1){
                                                                    ?>
                                                                    <span class="label label-success">Sales Order Confirmed</span>
                                                                <?php  }elseif($quotations[0]['status']==0){ ?>
                                                                    <span class="label label-warning">Sales Order</span>
                                                                <?php }elseif($quotations[0]['status']==2){?>
                                                                <span class="label label-danger">Cancelled</span>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="menu-action">
                                                                <a href="viewordertable.php?invoice=<?php echo $invoicedata[0]['invoiceid'];?>&status=<?php echo $quotations[0]['status'];?>" data-original-title="view" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-grey vd_grey">
                                                                    <i class="fa fa-eye"></i> </a>
                                                                <a href="invoice.php?invoice=<?php echo $invoicedata[0]['invoiceid'];?>" data-original-title="Invoice" data-toggle="tooltip" data-placement="top" class="btn menu-icon  vd_bd-grey vd_grey"> <i class="icon-text"></i> </a> </td>
                                                        </tr>
                                                    <?php } ?>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- col-md-12 -->
                                </div>


                            </div>
                            <!-- Panel Widget -->

                        </div>
                        <!-- vd_login-page -->

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


<?php require_once('templates/footers/' . $footer . '.tpl.php'); ?>



<?php require_once('templates/footers/closing.tpl.php'); ?>

<!-- Specific Page Scripts Put Here -->

