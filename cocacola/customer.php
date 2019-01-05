<?php
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
$product = new invenotry();
//set # of item in $numberofitemis using selectall method
$numberofitemis = $product->selectall('item','itemcode',NULL,'','','number');
//set # of organiztion in $numberoforg using selectall method
$numberoforg = $product->selectall('organization','orgcode',NULL,'','','number');
//set # of transactiontype in $numberoftrxtype using selectall method
$numberoftrxtype = $product->selectall('invtranstype','invtycode',NULL,'','','number');
?>

<?php require_once('templates/headers/opening.tpl.php'); ?>

<script>

</script>


<!-- Specific Page Data -->
<?php $title = 'Customer'; ?>
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
                                <li class="active">Customer</li>
                            </ul>
                            <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                        </div>
                    </div>
                    <div class="vd_title-section clearfix">
                        <div class="vd_panel-header">
                            <h1>Customer</h1>
                            <small class="subtitle"></small>
                            <div class="form-group">
                                <div class="col-sm-6 col-xs-6 controls" style=" margin-left: 80%;">
                                    <!-- start rest -->
                                    <a href="customerlist.php" class="btn vd_btn vd_btn-bevel vd_bg-blue font-semibold" style="width: 20%;">List Customer</a>
                                    <!-- end rest -->
                                    <!-- start submit -->
                                    <a href="addcustomer.php" class="btn vd_btn vd_btn-bevel vd_bg-blue font-semibold" style="width: 20%;">Add Customer</a>
                                    <!-- end submit -->
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- start Body -->
                    <!-- end Body -->
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

<?php require_once('templates/footers/' . $footer . '.tpl.php'); ?>

<!-- Specific Page Scripts Put Here -->
<?php include('templates/scripts/pages-ecommerce-product-add.tpl.php'); ?>
<?php include('templates/scripts/ui-alert-notifications.tpl.php'); ?>
<!-- Specific Page Scripts END -->

<?php require_once('templates/footers/closing.tpl.php'); ?>
