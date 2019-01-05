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
    function showCustomer(str) {
        var xhttp;
        if (str == "") {
            document.getElementById("txtHint").innerHTML = "";
            return;
        }
        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xhttp.open("GET", "./operation/selecttoorg.php?org="+str, true);
        xhttp.send();
    }
    //create function to insert transaction
    function insertdata() {

        qty = document.getElementById("qty").value;
        uofm=document.getElementById("uofm").value;
        item = document.getElementById("item").value;
        trxtype=document.getElementById("trxtype").value;
        from=document.getElementById("from").value;
        to=document.getElementById("to").value;
        date=document.getElementById("date").value;
        time=document.getElementById("time").value;
        note = document.getElementById("note").value;

        fileName = "./operation/trxinsert.php?qty=" + qty +"&uofm=" + uofm+"&item=" + item +"&trxtype=" + trxtype + "&from=" + from+"&to="+to+"&date="+date+"&time="+time+"&note="+note;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                //  alert( this.responseText);
            }
        };
        xhttp.open("POST", fileName, true);
        xhttp.send();

    }

</script>


<!-- Specific Page Data -->
<?php $title = 'Transaction Form '; ?>
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
                                <li class="active">Transaction Form</li>
                            </ul>
                            <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                        </div>
                    </div>
                    <div class="vd_title-section clearfix">
                        <div class="vd_panel-header">
                            <h1>Transaction Form</h1>
                            <small class="subtitle"></small>
                        </div>
                    </div>

                    <!-- start form -->
                        <form action= "./operation/trxinsert.php" method="POST" >
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="panel widget light-widget panel-bd-top">
                                    <div class="panel-heading bordered">
                                        <h3 class="panel-title">Transaction Panel </h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <!-- start QTY And Unit Of Measure -->
                                            <div  class="form-group">
                                                <label class="col-sm-4 control-label" style="margin-top: 20px;">QTY And Unit Of Measure</label>
                                                <div class="col-sm-5 controls" style="margin-top: 20px;">
                                                    <div class="input-group"> <span class="input-group-addon">QTY</span>
                                                        <input type="number" name="qty" id="qty" placeholder="">
                                                    </div>
                                                </div>
                                                <div class="col-sm-2 controls" style="margin-top: 20px;">
                                                    <select style="height: 35px" name="uofm" id="uofm">
                                                        <option disabled selected>Select Unit Of Measure</option>
                                                        <?php
                                                        //select # of Unit Of Measure from database using selectall method
                                                        $selectnomberofuom = $product->selectall('uofm','*', NULL,'','','number');
                                                        // for loop to get all Unit Of Measure from database and print as option
                                                        for ($i = 0; $i < $selectnomberofuom; $i++) {
                                                            // get Unit Of Measure and store in $uofm
                                                            $uofm = $product->selectall('uofm','*', NULL,'','','data')[$i];
                                                            //add Unit Of Measure value and name as option
                                                            ?>
                                                            <option value="<?php echo $uofm['id']; ?>"><?php echo $uofm['uofm']; ?></option>
                                                        <?php }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <!-- end QTY And Unit Of Measure -->
                                            <!-- start select item -->
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label" style="margin-top: 20px;" >Select Item </label>
                                                <div class="col-sm-7 controls" style="margin-top: 20px;">
                                                    <select  name="item" id="item">
                                                        <option selected disabled>Select Item</option>
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
                                            <!-- end select item -->
                                            <!-- start Transaction Type -->
                                            <div class="form-group">
                                                <label class="col-sm-4 control-label" style="margin-top: 20px;">Transaction Type</label>
                                                <div class="col-sm-7 controls" style="margin-top: 20px;">
                                                    <select name="trxtype" id="trxtype">
                                                        <option>Select Transaction Type</option>

                                                        <?php
                                                        //select transaction code and store in $trxtypecodeis
                                                        $trxtypecodeis = $product->selectall('invtranstype','*', NULL,'','','data');
                                                        // for loop to store single type in $item and create options from this item where itemcode
                                                        for ($i = 0; $i < $numberoftrxtype; $i++) {
                                                            //select trxtype where invtycode
                                                            $trxtype = ($product->selectall('invtranstype', '*', NULL, 'invtycode=' . $trxtypecodeis[$i]["invtycode"], '','data'));
                                                            ?>
                                                            <option value="<?php echo $trxtypecodeis[$i]['invtycode']; ?>">  <?php echo $trxtype[0]['trxtypedesc']; ?>    </option>

                                                        <?php } ?>



                                                    </select>
                                                </div>
                                                <!-- end Transaction Type -->

                                                <!-- start Date -->
                                                <?php
                                                // to add courent time
                                                $t=time();
                                                $date=date("Y-m-d",$t);
                                                $time=date("H:i:s",$t);
                                                ?>
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" style="margin-top: 20px;">Date</label>
                                                    <div class="col-sm-7 controls" style="margin-top: 20px;">
                                                        <input type="date" id="date" name="date" value="<?php echo $date;//date now?>" />
                                                    </div>
                                                    <!-- end Date -->
                                                    <!-- start Time -->
                                                    <label class="col-sm-4 control-label" style="margin-top: 20px;">Time</label>
                                                    <div class="col-sm-7 controls" style="margin-top: 20px;">
                                                        <div class="input-group bootstrap-timepicker">
                                                            <input type="time" id="time" name="time" value="<?php echo $time;//time now?>">
                                                            <span class="input-group-addon" id="timepicker-default-span"><i class="fa fa-clock-o"></i></span> </div>
                                                    </div>
                                                </div>
                                                <!-- end Time -->
                                                <!-- start Note -->
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" style="margin-top: 20px;">Note</label>
                                                    <div class="col-sm-7 controls" style="margin-top: 20px;">
                                                        <input type="text" name="note" id="note" placeholder="short Note">
                                                    </div>
                                                </div>
                                                <!-- end Note -->
                                                <!-- start From Organiztion -->
                                                <div class="form-group">
                                                    <label class="col-sm-4 control-label" style="margin-top: 20px;">From Organiztion</label>
                                                    <div class="col-sm-7 controls" style="margin-top: 20px;">
                                                        <select class="width-40" name="from" id="from" onchange="showCustomer(this.value)">
                                                            <option>Select Organiztion</option>

                                                            <?php
                                                            //select item code and store in $itemcodeis
                                                            $itemcodeis = $product->selectall('organization','*', NULL,'','','data');
                                                            for ($i = 0; $i < $numberoforg; $i++) {
                                                               ?>
                                                                <option value="<?php echo $itemcodeis[$i]['orgcode']; ?>">  <?php echo $itemcodeis[$i]['desc']; ?>    </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                    <!-- end From Organiztion -->
                                                    <!-- start To Organiztion -->
                                                    <label class="col-sm-4 control-label" style="margin-top: 20px;">To Organiztion</label>

                                                    <div id="txtHint"></div>

                                                </div>
                                                <!-- end To Organiztion -->
                                                <div class="form-group">
                                                    <div class="col-sm-12 col-xs-12 controls" style="margin-top:60px; margin-left: 55%;">
                                                        <!-- start rest -->
                                                        <button type="reset" value="Reset" class="btn vd_btn vd_btn-bevel vd_bg-red font-semibold" style="width: 20%;">Reset</button>
                                                        <!-- end rest -->
                                                        <!-- start submit -->
                                                        <button type="submit" value="Submit" name="submit" onclick="insertdata()"  class="btn vd_btn vd_btn-bevel vd_bg-blue font-semibold"  style="width: 20%;">Send</button>
                                                        <!-- end submit -->
                                                    </div>
                                                </div></div>
                                        </div>
                                        <!-- Panel Widget -->

                                    </div>
                                    <!-- col-sm-6 -->
                                </div>
                    </form>
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
