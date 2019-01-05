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
if (!isset($_GET['id'])) {
    echo("<script>location.href ='orgproductv.php';</script>");
}
//create object from inv class
$product = new invenotry();

$id = $_GET['id'];
$productdata =  $product->selectall('item','*',NULL,'itemcode='.$id,'','data');
$type=$product->selectall('itemtype','*',NULL,'id='.$productdata[0]["itemtype"],'','data');
$price=$product->selectall('itemprice','*',NULL,'itemcprice='.$id,'time DESC','data');
$cat=$product->selectall('categories','*',NULL,'id='.$productdata[0]["itemcat"],'','data');
?>

<?php require_once('templates/headers/opening.tpl.php'); ?>


<!-- Specific Page Data -->
<?php $title = 'Product View '; ?>
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
                                <li><a href="inventory.php">Inventory</a> </li>
                                <li class="active">Product View</li>
                            </ul>
                            <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                        </div>
                    </div>
                    <div class="vd_title-section clearfix">
                        <div class="vd_panel-header">
                            <h1>Product View</h1>
                            <small class="subtitle"></small>


                        </div>
                    </div>

                    <div class="vd_content-section clearfix">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel widget light-widget">
                                    <div class="panel-heading no-title"> </div>
                                    <form class="form-horizontal" action="#" role="form">
                                        <div  class="panel-body">
                                            <h2 class="mgbt-xs-20"> Product Name: <span class="font-semibold"><?php  echo $productdata[0]['itemdesc']; ?></span> </h2>
                                            <br/>
                                            <div class="row">
                                                <div class="col-sm-3 mgbt-xs-20">
                                                    <div class="form-group">
                                                        <div class="col-xs-12">
                                                            <div class="form-img text-center mgbt-xs-15"> <img alt="example image" src="img/product/<?php  echo $productdata[0]['itemimage']; ?>"> </div>
                                                            <br/>
                                                            <div>
                                                                <table class="table table-striped table-hover">
                                                                    <tbody>
                                                                    <tr>
                                                                        <td style="width:60%;">Status</td>
                                                                        <?php if(($productdata[0]['status'])==1){ ?>
                                                                        <td><span class="label label-success">Active</span></td>
                                                                        <?php }elseif(($productdata[0]['status'])==0){ ?>
                                                                        <td><span class="label label-danger">Archive</span></td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width:60%;">Website</td>
                                                                        <?php if(($productdata[0]['addweb'])==1){ ?>
                                                                            <td><span class="label label-success">Yes</span></td>
                                                                        <?php }elseif(($productdata[0]['addweb'])==0){ ?>
                                                                            <td><span class="label label-danger" >NO</span></td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width:60%;">Point of Sales</td>
                                                                        <?php if(($productdata[0]['addpos'])==1){ ?>
                                                                            <td><span class="label label-success">Yes</span></td>
                                                                        <?php }elseif(($productdata[0]['addpos'])==0){ ?>
                                                                            <td><span class="label label-danger">No</span></td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>User Rating</td>
                                                                        <td><i class="fa fa-star vd_yellow fa-fw"></i><i class="fa fa-star vd_yellow fa-fw"></i><i class="fa fa-star vd_yellow fa-fw"></i><i class="fa fa-star vd_yellow fa-fw"></i><i class="fa fa-star vd_yellow fa-fw"></i></td>
                                                                    </tr>

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-9">
                                                    <h3 class="mgbt-xs-15">Product Information</h3>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Product Type</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <input type="text"  class="form-control" value="<?php  echo $type[0]['type'] ; ?>" placeholder="Disabled input" disabled>
                                                                </div>
                                                                <!-- col-xs-12 -->
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>

                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Categories</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <input type="text"  class="form-control" value="<?php  echo $cat[0]['seg1']."|".$cat[0]['seg2']."|".$cat[0]['seg3'] ; ?>" placeholder="Disabled input" disabled>

                                                                </div>
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Barcode</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <input type="number"  class="form-control" value="<?php echo $productdata[0]['barcode']; ?>" placeholder="Disabled input" disabled>

                                                                </div>
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>






                                                    <hr />
                                                    <h3 class="mgbt-xs-15">Prices</h3>

                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Price</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <input type="text"  class="form-control" value="<?php echo $price[0]['price'] ; ?>" placeholder="Empty" disabled>

                                                                </div>
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>


                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">From</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <input type="date"  class="form-control" value="<?php  echo $price[0]['from']; ?>" placeholder="Empty" disabled>

                                                                </div>
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>



                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">To</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <input type="date"  class="form-control" value="<?php echo $price[0]['to']; ?>" placeholder="Empty" disabled>

                                                                </div>
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>

                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Price Status</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <?php
                                                                    $t=time();
                                                                    $date=date("Y-m-d",$t);
                                                                    if(($price[0]['to'])<$date){ ?>
                                                                        <td><span class="label label-danger">expired</span></td>

                                                                    <?php }elseif(($price[0]['to'])>$date){ ?>
                                                                        <td><span class="label label-success">Active</span></td>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>



                                                    <hr/>
                                                    <h3 class="mgbt-xs-15">Sales And Inventory</h3>

                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Cost</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <input type="number"  class="form-control" value="<?php echo $price[0]['cost']; ?>" placeholder="Empty" disabled>

                                                                </div>
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>

                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Weight</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <input type="number"  class="form-control" value="<?php echo $productdata[0]['weight']; ?>" placeholder="Empty" disabled>

                                                                </div>
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>


                                                    <hr/>
                                                    <h3 class="mgbt-xs-15">Invoicing</h3>

                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Can Be Sold</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <?php if(($productdata[0]['canbesold'])==1){ ?>
                                                                        <td><span class="fa fa-fw fa-check-square-o" style="font-size: 30px;"></span></td>
                                                                    <?php }elseif(($productdata[0]['canbesold'])==0){ ?>
                                                                        <td><span class="fa fa-fw icon-cross2" style="font-size: 30px;"></span></td>
                                                                    <?php } ?>
                                                                </div>
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>

                                                    <hr/>
                                                    <h3 class="mgbt-xs-15">Note</h3>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Description for Customers</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <input type="text"  class="form-control" value="<?php echo $productdata[0]['descriptionforcustomers']; ?>" placeholder="Empty" disabled>

                                                                </div>
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Description for Delivery Orders</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <input type="text"  class="form-control" value="<?php echo $productdata[0]['descriptionfordeliveryorders']; ?>" placeholder="Empty" disabled>

                                                                </div>
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-sm-3 control-label">Description for Internal Transfers</label>
                                                        <div class="col-sm-9 controls">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-xs-9">
                                                                    <input type="text"  class="form-control" value="<?php echo $productdata[0]['descriptionforinternaltransfers']; ?>" placeholder="Empty" disabled>

                                                                </div>
                                                            </div>
                                                            <!-- row -->
                                                        </div>
                                                        <!-- col-sm-10 -->
                                                    </div>



                                                </div>
                                                <!-- col-sm-12 -->
                                            </div>
                                            <!-- row -->

                                        </div>
                                        <!-- panel-body -->
                                        <div class="pd-20">
                              <a  href="./productv.php" > <span class="btn vd_btn vd_bg-blue col-md-offset-0" style="width: 20%;"><i class="fa  fa-angle-double-left"></i> Back</span></a>
                                            <a  href="./edit.php?itemcodeedit=<?php  echo $id; ?>" > <span class="btn vd_btn vd_bg-blue col-md-offset-0" style="width: 20%;"><span class="menu-icon"><i class="fa fa-edit"></i></span> Edit</span></a>
                                        </div>
                                    </form>
                                </div>
                                <!-- Panel Widget -->
                            </div>
                            <!-- col-sm-12-->
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

<?php require_once('templates/footers/' . $footer . '.tpl.php'); ?>

<!-- Specific Page Scripts Put Here -->
<?php include('templates/scripts/pages-ecommerce-product-add.tpl.php'); ?>
<?php include('templates/scripts/ui-alert-notifications.tpl.php'); ?>
<!-- Specific Page Scripts END -->

<?php require_once('templates/footers/closing.tpl.php'); ?>
