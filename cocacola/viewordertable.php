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
$employee=new emp();


$invoice=$_GET['invoice'];
$status=$_GET['status'];
$invoicenumber=$product->selectall('invoice','*',NULL,'invoiceid='.$invoice,'','number');
$invoicedata=$product->selectall('invoice','*',NULL,'invoiceid='.$invoice,'','data');


?>

<?php require_once('templates/headers/opening.tpl.php'); ?>
<script src="./js/jquery-3.3.1.js"></script>
<script>

    function confirmupdate(invoice,status) {

        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
            }
        };
        xhttp.open("GET", "./operation/confirminvoice.php?invoice="+invoice+"&status="+status);
        xhttp.send();
        location.href ='qutation.php';
    }

</script>


<!-- Specific Page Data -->
<?php $title = 'Order'; ?>
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
                                <li><a href="pages-custom-product.php">Sales</a> </li>
                                <li class="active">Order</li>
                            </ul>
                            <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                        </div>
                    </div>
                    <form class="form-horizontal" action="#" role="form">
                        <div class="vd_title-section clearfix">
                            <div class="vd_panel-header">
                                <h1>Order</h1>

                                <div class="form-group">
                                    <div  class="col-sm-2 col-xs-2 controls" style=" margin-left: 80%;margin-top: -20px;">
                                        <label class="col-xs-2 control-label"><i class="glyphicon glyphicon-user"></i></label>
                                        <div  class="controls col-xs-9">
                                            <div id="select">
                                                <select id="salesman" name="salesman" onchange="changeselesman(this.value)"  >
                                                    <option disabled selected> select salesman</option>
                                                    <?php
                                                    $salesmanid=$employee->selectall('salesman','*',NULL,'id='.$invoicedata[0]['selesmanid'],'','data');


                                                    $empidselected=$employee->selectall('emp','*',NULL,'empno='.$salesmanid[0]['empid'],'','data');

                                                    $empid=$employee->selectall('emp','*',NULL,'groupID=1','','data');
                                                    for($i=0;$i<$numberofemployee;$i++){?>
                                                        <option  value="<?php echo $empid[$i]['empno'];?>" <?php if(($empid[$i]['email'])==$empidselected[0]['email']){echo "selected";} ?>  >
                                                            <?php echo $empid[$i]['user'];?> </option>
                                                    <?php } ?>


                                                </select>

                                            </div>
                                        </div>

                                    </div>
                                    <div  class="col-sm-2 col-xs-2 controls" style=" margin-left: 85%;margin-top: 10px;">
                                        <div id="txtHintsalesman"> </div>

                                    </div>
                                </div>
                                <div id="textdoneadded"> </div>
                                <div class="form-group">

                                    <div class="vd_content-section clearfix">
                                        <div class="row">
                                            <?php if($status==0){?>
                                            <div  class="col-sm-6 col-sm-offset-9">

                                             <a onclick="confirmupdate(<?php echo $invoice;?>,1);">  Confirm </a>
                                                <a onclick="confirmupdate(<?php echo $invoice;?>,2);">  Cancel </a>

                                            </div>

                                            <?php }  ?>
                                            <div class="col-md-12">

                                                <div class="panel widget">
                                                      <div class="panel-body">


                                                        <div class="row">
                                                            <div id="reloadcustomerdata">
                                                                <div class="col-md-12 col-xs-1">

                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-2 control-label"><i class="fa fa-users"></i> </label>
                                                                        <div class="controls col-xs-9">
                                                                            <select name="customer"  id="customer" onchange="changedata(this.value)">
                                                                                <option disabled selected> Select Customer </option>
                                                                                <?php
                                                                                $numberofcustomer=$customer->selectall('customer','*',NULL,'','','number');
                                                                                for($i=0;$i<$numberofcustomer;$i++){
                                                                                    $customerdata=$customer->selectall('customer','*',NULL,'','','data');
                                                                                    ?>
                                                                                    <option value="<?php echo $customerdata[$i]['id'];?>"  <?php if(($customerdata[$i]['id'])==$_SESSION['customerid']){echo "selected";} ?>> <?php echo $customerdata[$i]['username'];?> </option>

                                                                                <?php     } ?>

                                                                            </select>

                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-3 control-label">Order Type</label>
                                                                        <div class="controls col-xs-9">
                                                                            <select name="ordertype" id="ordertype">
                                                                                <?php
                                                                                $numberofordertypeis=$product->selectall('ordertype','id',NULL,'','','number');
                                                                                //select item code and store in $itemcodeis
                                                                                ?>
                                                                                <option value="1" selected  disabled> Select Order Type </option>

                                                                                <?php
                                                                                $ordertyoedata = $product->selectall('ordertype','*',NULL,'','','data');
                                                                                for ($i = 0; $i < $numberofordertypeis; $i++) {
                                                                                    ?>
                                                                                    <option value="<?php echo $ordertyoedata[$i]['id']; ?>">  <?php echo $ordertyoedata[$i]['type']; ?>    </option>
                                                                                <?php }?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">

                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-2 control-label"><i class="icon-mail"></i>	 </label>
                                                                        <div class="controls col-xs-10">
                                                                            <input type="email" name="cusomeremail" id="cusomeremail" value="<?php echo $_SESSION['customeremail'];?>" placeholder="Enter Email	" style="width: 87%;">

                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-3 control-label"> Discount</label>
                                                                        <div class="controls col-xs-9">
                                                                            <select id="discount" name="discount" onchange="updatediscount(this.value)">
                                                                                <?php
                                                                                $numberofdiscountis=$product->selectall('discount','id',NULL,'status=1','','number');
                                                                                //select item code and store in $itemcodeis
                                                                                ?>
                                                                                <option value="1" selected  disabled> Select Discount </option>

                                                                                <?php
                                                                                $discountdata = $product->selectall('discount','*',NULL,'','','data');
                                                                                for ($i = 0; $i < $numberofdiscountis; $i++) {
                                                                                    ?>
                                                                                    <option value="<?php echo $discountdata[$i]['id']; ?>" name="<?php echo $discountdata[$i]['percentage']; ?>">  <?php echo $discountdata[$i]['discountdesc']; ?>    </option>
                                                                                <?php }?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">

                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-2 control-label"><i class="fa fa-phone"></i> </label>
                                                                        <div class="controls col-xs-2">
                                                                            <input type="number" id="cityno" name="cityno" value="972" disabled>

                                                                        </div>


                                                                        <div class=" col-xs-7">
                                                                            <input type="number" value="<?php echo $_SESSION['customerphone'];?>" id="phonenumber" name="phonenumber">

                                                                        </div>

                                                                    </div>

                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-3 control-label">Taxes</label>
                                                                        <div class="controls col-xs-9">
                                                                            <select name="taxes" id="taxes" onchange="updatetax(this.value)">
                                                                                <?php
                                                                                $numberoftaxis=$product->selectall('tax','id',NULL,'','','number');
                                                                                //select item code and store in $itemcodeis
                                                                                ?>
                                                                                <option value="1" selected  disabled> Select Tax </option>

                                                                                <?php
                                                                                $taxdata = $product->selectall('tax','*',NULL,'','','data');
                                                                                for ($i = 0; $i < $numberoftaxis; $i++) {
                                                                                    ?>
                                                                                    <option value="<?php echo $taxdata[$i]['id']; ?>">  <?php echo $taxdata[$i]['taxdesc']; ?>    </option>
                                                                                <?php }?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">

                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-2 control-label"> Customer Type	 </label>
                                                                        <div class="controls col-xs-9">
                                                                            <select name="customertype" id="customertype">
                                                                                <option disabled selected> Select Customer Type </option>
                                                                                <?php
                                                                                $numberofcustomertyoe=$customer->selectall('customertype','*',NULL,'','','number');
                                                                                for($i=0;$i<$numberofcustomertyoe;$i++){
                                                                                    $customertype=$customer->selectall('customertype','*',NULL,'','','data');
                                                                                    ?>
                                                                                    <option value="<?php echo $customertype[$i]['custmeridty'];?>" <?php if(($customertype[$i]['custmeridty'])==$_SESSION['customertypeid']){echo "selected";} ?> > <?php echo $customertype[$i]['typedesc'];?> </option>

                                                                                <?php     } ?>


                                                                            </select>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-3 control-label">Note</label>
                                                                        <div class="controls col-xs-9">
                                                                            <textarea rows="1" id="note" name="note"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">

                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-2 control-label">Company Name	 </label>
                                                                        <div class="controls col-xs-10">
                                                                            <input type="text" name="company" id="company" value="<?php echo $_SESSION['companyname']; ?>" placeholder="Enter Company Name	" style="width: 87%;">

                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-3 control-label"></label>
                                                                        <div class="controls col-xs-9">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">

                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-2 control-label"> Area	</label>
                                                                        <div class="controls col-xs-9">

                                                                            <select name="area" id="area">
                                                                                <option disabled selected> Select Area </option>
                                                                                <?php
                                                                                $numberofarea=$customer->selectall('area','*',NULL,'','','number');
                                                                                for($i=0;$i<$numberofarea;$i++){
                                                                                    $areadata=$customer->selectall('area','*',NULL,'','','data');
                                                                                    ?>
                                                                                    <option value="<?php echo $areadata[$i]['id'];?>" <?php if(($areadata[$i]['id'])==$_SESSION['areaid']){echo "selected";} ?>> <?php echo $areadata[$i]['areadesc'];?> </option>

                                                                                <?php     } ?>


                                                                            </select>
                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-3 control-label"></label>
                                                                        <div class="controls col-xs-9">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12">

                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-2 control-label"> Address	</label>
                                                                        <div class="controls col-xs-4">
                                                                            <input type="text" value="<?php echo $_SESSION['contry'];?>" placeholder="Enter country 	" name="contry" id="contry">

                                                                        </div>
                                                                        <div class="controls col-xs-4">
                                                                            <input type="text" value="<?php echo $_SESSION['street'];?>" placeholder="Enter street	" name="street" id="street">

                                                                        </div>
                                                                    </div>


                                                                    <div class="col-md-6" style="margin-top: 20px;">
                                                                        <label class="col-xs-3 control-label"></label>
                                                                        <div class="controls col-xs-9">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="form-actions row ">

                                                            <div class="col-sm-12 col-sm-offset-9">
                                                                <span>Total Price:<span style="margin-left: 20px; ">₪</span>  <input type="number"  value="0" id="endtotalprice"  disabled style="background-color:transparent;border: 0px solid;height:30px;width:260px;"></span>
                                                                <hr>
                                                                <span>Discount:    <span style="margin-left: 30px;">₪</span> <input type="number"  value="0" id="enddiscount"  disabled style="background-color:transparent;border: 0px solid;height:30px;width:260px; color:red;"></span>
                                                                <br>
                                                                <span>Taxes:       <span style="margin-left: 55px; ">₪</span> <input type="number"  value="0" id="endtax"  disabled style="background-color:transparent;border: 0px solid;height:30px;width:260px;"></span>
                                                                <hr>
                                                                <span> Total:      <span style="margin-left: 60px; ">₪</span> <input type="number"  value="0" id="endtotal"  disabled style="background-color:transparent;border: 0px solid;height:30px;width:260px;"></span>
                                                            </div>

                                                        </div>



                                                        <div class="row" >
                                                            <div class="col-md-12">
                                                                <div class="panel widget">
                                                                    <div class="panel-body-list  table-responsive">
                                                                        <table class="table table-striped table-hover no-head-border">
                                                                            <thead class="vd_bg-blue vd_white">
                                                                            <tr>
                                                                                <th>Product</th>
                                                                                <th>QTY</th>
                                                                                <th>Unit of Measure</th>
                                                                                <th>offer</th>
                                                                                <th>Bonus</th>
                                                                                <th>Total QTY</th>
                                                                                <th>Unit Price</th>
                                                                                <th>Total Price</th>
                                                                            </tr>
                                                                            </thead>
                                                                            <tbody id="tbo">

                                                                            <tbody id="txtHint1" ></tbody>

                                                                            <tr>
                                                                                <td><a id="xx" onclick="x++ ; additemorder(x);"> <div> <i class="fa fa-plus"> </i> Add an item</div></a></td>
                                                                                <td></td>

                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>

                                                                                <td></td>

                                                                            </tr>

                                                                            </tbody>
                                                                        </table>
                                                                    </div>
                                                                </div>
                                                                <!-- Panel Widget -->
                                                            </div>
                                                        </div>

                                                        <div class="form-actions row" >
                                                            <div  class="col-sm-12 col-sm-offset-9">
                                                                <button style="width: 20%; " class="vd_bg-blue vd_white" onclick="senddata()"> Add Order  </button>
                                                            </div>
                                                        </div>


                                                    </div>
                                                </div>
                                                <!-- Panel Widget -->
                                            </div>
                                            <!-- col-md-12 -->
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- Panel Widget -->

        </div>
        <!-- vd_login-page -->

    </div>
    <!-- .vd_content-section -->

</div>
<!-- .vd_content -->


<?php require_once('templates/footers/' . $footer . '.tpl.php');


?>



<?php require_once('templates/footers/closing.tpl.php'); ?>

<!-- Specific Page Scripts Put Here -->

