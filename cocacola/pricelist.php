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
$product = new invenotry();
$numberofprice=$product->selectall('itemprice','price',NULL,'status=1','','number');
$numberofitemis=$product->selectall('item','itemcode',NULL,'','','number');
?>

<?php require_once('templates/headers/opening.tpl.php'); ?>

<script>
    function update() {

        item = document.getElementById("item").value;
        newprice = document.getElementById("newprice").value;
        newfrom = document.getElementById("newfrom").value;
        newto = document.getElementById("newto").value;



        fileName = "./operation/addprice.php?item="+ item+"&newprice=" + newprice + "&newfrom=" + newfrom + "&newto=" + newto;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //  alert( this.responseText);
            }
        };
        xhttp.open("POST", fileName, true);
        xhttp.send();

    }
</script>

<!-- Specific Page Data -->
<?php $title = 'Edit Product '; ?>
<?php $keywords = 'HTML5 Template, CSS3, All Purpose Admin Template, Vendroid'; ?>
<?php $description = 'Ecommerce Add Product - Responsive Admin HTML Template'; ?>
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
                                <li><a href="pages-custom-product.php">Sales</a> </li>
                                <li class="active">List Price</li>
                            </ul>

                            <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                        </div>
                    </div>
                    <div class="vd_title-section clearfix">
                        <div class="vd_panel-header">
                            <h1>List Price</h1>
                            <small class="subtitle"></small>
                            <div class="form-group">
                                <div class="col-sm-6 col-xs-6 controls" style=" margin-left: 80%;">
                                    <!-- start rest -->
                                    <a class="btn vd_btn btn-sm vd_bg-green" href="#" data-toggle="modal" data-target="#addPriceModal" style="width: 40%"><i class="fa fa-plus append-icon"></i> Add Price </a>
                                    <!-- end rest -->

                                </div>
                            </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel widget">
                                            <div class="panel-heading">

                                                <h3 class="panel-title  vd_black"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Table of Price List </h3>

                                            </div>
                                            <div class="panel-body-list  table-responsive">
                                                <table class="table table-striped table-hover no-head-border">
                                                    <thead class="vd_bg-green vd_white">
                                                    <tr>

                                                        <th>Item Name</th>
                                                        <th>Price</th>
                                                        <th>From</th>
                                                        <th>To</th>
                                                        <th>Status</th>

                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $itemid=$product->selectall('itemprice','*',NULL,'status=1','','data');
                                                    for($i=0;$i<$numberofprice;$i++){

                                                        $itemdata=$product->selectall('item','itemdesc',NULL,'itemcode='.$itemid[$i]['itemcprice'],'','data');

                                                        ?>


                                                        <tr>
                                                            <td><?php echo $itemdata[0]['itemdesc'];?></td>
                                                            <td><?php echo $itemid[$i]['price'];?></td>
                                                            <td><?php echo $itemid[$i]['from'];?></td>
                                                            <td><?php echo $itemid[$i]['to'];?></td>



                                                            <td class="center">

                                                                <?php
                                                                if($itemid[$i]['status']==1){
                                                                    ?>
                                                                    <span class="label label-success">Active</span>
                                                                <?php }elseif($itemid[$i]['status']==0){ ?>
                                                                    <span class="label label-danger">Deactivate</span>
                                                                <?php } ?>
                                                            </td>
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

    <div class="modal fade" id="addPriceModal" tabindex="-1" role="dialog" aria-labelledby="priceModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <form method="POST" action="./operation/addprice.php">
                <div class="modal-content" >
                    <div class="modal-header vd_bg-blue vd_white" >
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                        <h4 class="modal-title" id="priceModalLabel">Add Price for this item</h4>
                    </div>
                    <div class="modal-body" style="height: 350px;">

                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="margin-top: 20px;" >Select Item </label>
                            <div class="col-sm-7 controls" style="margin-top: 20px;">
                                <select  name="item" id="item">
                                    <option>Select Item</option>
                                    <?php
                                    //select item code using selectall
                                    $itemdata = $product->selectall('item','*', NULL,'','','data');
                                    for ($i = 0; $i < $numberofitemis; $i++) {
                                        // for loop to store single item in $item and create options from this item where itemcode
                                        ?>
                                        <option value="<?php echo $itemdata[$i]['itemcode']; ?>">  <?php echo $itemdata[$i]['itemdesc']; ?>    </option>

                                    <?php } ?>

                                </select>
                            </div>
                        </div>
                        <div class="form-group" >
                            <label class="col-sm-4 control-label" style="margin-top: 20px">Price</label>
                            <div class="col-sm-7 controls" style="margin-top: 20px">
                                <div class="input-group"> <span class="input-group-addon"> ₪ </span>
                                    <input type="number" placeholder="Price" name="newprice" id="newprice">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label"  style="margin-top: 20px" >From</label>
                            <div class="col-sm-7 controls">
                                <div class="input-group" style="margin-top: 20px">
                                    <input type="Date" placeholder="Date" id="newfrom" name="newfrom" >
                                    <span class="input-group-addon" id="datepicker-icon-trigger" data-datepicker="#datepicker-icon" ><i class="fa fa-calendar" ></i></span> </div>

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-4 control-label" style="margin-top: 20px">To</label>
                            <div class="col-sm-7 controls">
                                <div class="input-group" style="margin-top: 20px">
                                    <input type="Date" placeholder="Date" id="newto" name="newto" >
                                    <span class="input-group-addon" id="datepicker-icon-trigger" data-datepicker="#datepicker-icon"><i class="fa fa-calendar"></i></span> </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer background-login">
                        <button type="button" class="btn vd_btn vd_bg-grey" data-dismiss="modal">Close</button>
                        <button type="submit" onclick="update()" class="btn vd_btn vd_bg-green" id="submit" name="submit" ><i class="fa fa-plus append-icon" ></i> Add Price</button>
                    </div>
            </form> </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

</div>
<!-- .content -->


<?php require_once('templates/footers/' . $footer . '.tpl.php'); ?>



<?php require_once('templates/footers/closing.tpl.php'); ?>

<!-- Specific Page Scripts Put Here -->

