<?php
require './class/inv.inc';
session_start();

if (!isset($_SESSION['email'])) {
    echo("<script>location.href ='pages-login.php';</script>");
}
if ($_SESSION['lock'] != 0) {
    echo("<script>location.href ='pages-Lockscreen.php';</script>");
}


$itemcodeedit = $_GET['itemcodeedit'];

$product = new invenotry();
$x1 = ($product->selectall('item', '*', NULL, 'itemcode=' . $itemcodeedit, '','data'));
$x2 = ($product->sumon($itemcodeedit));
$activestat=1;
$x3 = ($product->selectall('itemprice', '*', NULL, 'itemcprice=' . $itemcodeedit.' AND status='.$activestat, '','data'));
?>



<?php require_once('templates/headers/opening.tpl.php'); ?>

<!-- Specific Page Data -->
<?php $title = 'Edit Product '; ?>
<?php $keywords = ''; ?>
<?php $description = ''; ?>
<?php $page = 'pages';   // To set active on the same id of primary menu ?>
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
<?php

$itemcodeedit = $_GET['itemcodeedit'];

$product = new invenotry();
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $Price = $_POST["newprice"];
    $From = $_POST["newfrom"];
    $t=time();
    $date=date("Y-m-d",$t);

    $to = $_POST["newto"];
    if($to>$date){$status=1;}else{$status=0;}
   $product->updateprice($itemcodeedit);
    $product->insertnewprice($itemcodeedit, $Price, $From, $to,$status);

  //  header("reload:0; href=#tabprice");
}


?>
<script>


    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#blah')
                    .attr('src', e.target.result)
                    .width(500)
                    .height(400);
                $('#imgname')
                    .attr('value',input.files[0]['name']);

            };

            reader.readAsDataURL(input.files[0]);

        }
    }

    function refresh() {
        location.reload();
    }

    function update() {
        itemcodeedit= <?php echo $itemcodeedit; ?>;
        Name = document.getElementById("Name").value;
        Categories = document.getElementById("Categories").value;
        Type = document.getElementById("Type").value;
        Barcode = document.getElementById("Barcode").value;
        var website = document.getElementById("website");
        xw = "";
        if (website.checked == true) {
            xw = "on";
        } else {
            xw = "off";
        }
        var POS = document.getElementById("POS");
        xp = "";
        if (POS.checked == true) {
            xp = "on";
        } else {
            xp = "off";
        }
        Weight = document.getElementById("weight").value;
        cost = document.getElementById("cost").value;
        DFC = document.getElementById("DFC").value;
        DFDO = document.getElementById("DFDO").value;
        DFIT = document.getElementById("DFIT").value;

        radios = document.getElementsByName('Status');
        stat = "";
        for (var i = 0, length = radios.length; i < length; i++) {
            if (radios[i].checked) {
                // do whatever you want with the checked radio
                stat = radios[i].value;
                // only one radio can be logically checked, don't check the rest
                break;
            }
        }
        cbs = document.getElementById("cbs");
        cbso = "";
        if (cbs.checked == true) {
            cbso = 1;
        } else {
            cbso = 0;
        }



        fileName = "./operation/updateitemdata.php?itemcodeedit="+ itemcodeedit+"&Name=" + Name + "&Categories=" + Categories + "&Type=" + Type + "&Barcode=" + Barcode + "&website=" + xw + "&pos=" + xp + "&Status=" + radios + "&Weight=" + Weight + "&cost=" + cost+ "&cbs=" + cbss + "&DFC=" + DFC + "&DFDO=" + DFDO + "&DFIT=" + DFIT;

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                //  alert( this.responseText);
            }
        };
        xhttp.open("GET", fileName, true);
        xhttp.send();



    }

</script>
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
                                <li class="active">Edit Product</li>
                            </ul>
                            <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                        </div>
                    </div>
                    <div class="vd_title-section clearfix">
                        <div class="vd_panel-header">
                            <h1>Edit Product</h1>
                            <small class="subtitle"></small>


                        </div>
                    </div>


                    <div class="vd_content-section clearfix" id="ecommerce-product-add">
                        <div class="row">

                            <div class="col-sm-3 col-md-4 col-lg-3">

                                <div class="form-wizard condensed mgbt-xs-20" style="margin-top: 20px;">

                                    <ul class="nav nav-tabs nav-stacked">
                                        <li class="active"><a href="#tabinfo" data-toggle="tab"> <i class="fa fa-info-circle append-icon"></i> Product Information </a></li>
                                        <li><a href="#tabprice" data-toggle="tab"> <i class="fa fa-money append-icon"></i> Prices </a></li>
                                        <li><a href="#tabseo" data-toggle="tab"> <i class="glyphicon glyphicon-home"></i> Sales and Inventory </a></li>
                                        <li><a href="#tabship" data-toggle="tab"> <i class="icon-text"></i> invoicing </a></li>
                                        <li><a href="#tabasso" data-toggle="tab"> <i class="icon-add-to-list"></i> Notes </a></li>
                                        <li><a href="#tabimage" data-toggle="tab"> <i class="fa fa-picture-o append-icon"></i> Images </a></li>

                                    </ul>
                                </div>
                            </div>

                            <div class="col-sm-9 col-md-8 col-lg-9 tab-right">
                                <form class="form-horizontal" method="POST" action="./operation/updateitemdata.php" enctype="multipart/form-data">
                                    <div class="vd_panel-menu">
                                        <div>
                                            <button type="submit" id="submit" name="submit" value="<?php echo $itemcodeedit; ?>" class="btn vd_btn vd_bg-blue btn-sm " onclick="update()"><i class="fa fa-save append-icon"></i> Save Changes</button> <a  data-toggle="modal" data-target="#myModal" class="btn btn-default btn-sm"><i class="fa fa-times append-icon"></i> Cancel Changes</a>
                                        </div>
                                    </div>

                                <div class="panel widget panel-bd-left light-widget" style="margin-top: 20px;">

                                    <div class="panel-heading no-title"> </div>
                                    <div  class="panel-body">
                                        <div class="tab-content no-bd mgbt-xs-20">
                                            <div id="tabinfo" class="tab-pane active">
                                                <span class="form-horizontal">

                                                    <h3 class="mgtp-15 mgbt-xs-20"> Product Information </h3>

                                                    <!-- form-group -->

                                                    <div class="form-group">
                                                        <label for="name_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="The public name for this product. Invalid characters &lt;&gt;;=#{}"> Name </span> </label>
                                                        <div class="col-lg-5">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-sm-9">
                                                                    <input type="text" required value="<?php echo $x1[0]['itemdesc']; ?>" name="name" class="  updateCurrentText " id="name" >
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label  class="control-label col-lg-3" >
                                                            <span data-toggle="tooltip" class="label-tooltip" data-original-title="Product type">Product Type </span></label>
                                                        <div class="col-lg-3">
                                                            <select  name="Type" class="input-border-btm" id="Type" >

                                                                <option  value="00" > Select Type </option>
                                                                <?php
                                                                $numberoftype = $product->selectall('itemtype','*',NULL,'','','number');
                                                                for ($i = 0; $i < $numberoftype; $i++) {
                                                                    $x5 = $product->selectall('itemtype','*', NULL,'','','data')[$i];
                                                                    ?>

                                                                    <option <?php if ($x1[0]['itemtype'] == $x5['id']) {
                                                                        echo 'selected="selected"';
                                                                    } ?> value="<?php echo $x5['id']; ?>"><?php echo $x5['type']; ?></option>

                                                                <?php }
                                                                ?>

                                                            </select>

                                                        </div>

                                                    </div>
                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label for="code_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Product reference number (SKU-10423, etc.)"> Categories </span> </label>
                                                        <div class="col-lg-3">
                                                            <select  name="Categories" class="input-border-btm" id="Categories" >

                                                                <option selected="selected" value="00" > Select Categories </option>
                                                                <?php
                                                                $numberofcat = $product->selectall('categories','*',NULL,'','','number');
                                                                for ($i = 0; $i < $numberofcat; $i++) {
                                                                    $x6 = $product->selectall('categories','*', NULL,'','','data')[$i];
                                                                    ?>
                                                                    <option <?php if ($x1[0]['itemcat'] == $x6['id']) {
                                                                        echo 'selected="selected"';
                                                                    } ?> value="<?php echo $x6['id']; ?>"><?php echo $x6['seg1'] . " | " . $x6['seg2'] . " | " . $x6['seg3']; ?></option>
                                                                <?php }
                                                                ?>

                                                            </select>

                                                        </div>
                                                    </div>
                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label for="code_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Product reference number (SKU-10423, etc.)"> BarCode </span> </label>
                                                        <div class="col-lg-3">
                                                            <input type="number" value="<?php echo $x1[0]['barcode']; ?>" name="Barcode" class=" updateCurrentText " id="Barcode" >
                                                        </div>
                                                    </div>
                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label for="enable_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Enable product" > Enable Website </span> </label>
                                                        <div class="col-lg-3">
                                                            <input id="website" name="website"  type="checkbox" data-rel="switch" data-wrapper-class="inverse" data-size="small" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>"  <?php if (($x1[0]['addweb']) == 1) {
                                                                echo "checked";
                                                            } ?>>
                                                        </div>
                                                    </div>
                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label for="enable_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Enable product" > Enable POS </span> </label>
                                                        <div class="col-lg-3">
                                                            <input id="pos" name="pos"  type="checkbox" data-rel="switch" data-wrapper-class="inverse" data-size="small" data-on-text="<i class='fa fa-check'></i>" data-off-text="<i class='fa fa-times'></i>"  <?php if (($x1[0]['addpos']) == 1) {
                                                                echo "checked";
                                                            } ?>>
                                                        </div>
                                                    </div>
                                                    <!-- form-group -->
                                                    <div class="form-group">
                                                        <label for="enable_1" class="control-label col-lg-3 required"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Enable product" > Status </span> </label>
                                                        <div class="col-lg-3">
                                                            <div class="vd_radio radio-success">
                                                                <input type="radio"  value="Active" name="Status" id="yes" <?php if (($x1[0]['status']) == 1) {
                                                                    echo "checked";
                                                                } ?>>
                                                                <label for="yes">Active</label>
                                                            </div>
                                                            <div class="vd_radio radio-success">
                                                                <input type="radio"  value="Archive" name="Status" id="no" <?php if (($x1[0]['status']) == 0) {
                                                                    echo "checked";
                                                                } ?>>
                                                                <label for="no">Archive</label>
                                                            </div>

                                                        </div>
                                                    </div>

                                                </span>
                                            </div>
                                            <!-- #tabinfo -->
                                            <div id="tabprice" class="tab-pane">

                                                <h3 class="mgtp-15 mgbt-xs-20"> Product Price last added</h3>
                                                <span class="form-horizontal">
                                                    <div class="form-group">
                                                        <label for="wholesale_price" class="control-label col-lg-3"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="The wholesale price is the price you paid for the product. Do not include the tax."> Price</span> </label>
                                                        <div class="col-lg-2">
                                                            <div class="input-group"> <span class="input-group-addon"> ₪  </span>
                                                                <input type="text"  value="<?php echo $x3[0]['price']; ?>" id="price" name="price" maxlength="14" readonly>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="priceTE" class="control-label col-lg-3"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="The pre-tax retail price is the price for which you intend sell this product to your customers." >From</span> </label>
                                                        <div class="col-lg-4">
                                                            <div class="input-group">
                                                                <input type="Date" value="<?php echo $x3[0]['from']; ?>" id="from" name="from" readonly>
                                                                <span class="input-group-addon" id="datepicker-icon-trigger" data-datepicker="#datepicker-icon"><i class="fa fa-calendar"></i></span> </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="priceTE" class="control-label col-lg-3"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="The pre-tax retail price is the price for which you intend sell this prod" >To</span> </label>
                                                        <div class="col-lg-4">
                                                            <div class="input-group">
                                                                <input type="Date" value="<?php echo $x3[0]['to']; ?>"  id="to" name="to" readonly>
                                                                <span class="input-group-addon" id="datepicker-icon-trigger" data-datepicker="#datepicker-icon"><i class="fa fa-calendar"></i></span> </div>
                                                        </div>
                                                    </div>


                                                    <br/>
                                                    <h3 class="mgtp-15 mgbt-xs-20"> All Price </h3>
                                                    <a class="btn vd_btn btn-sm vd_bg-green" href="#" data-toggle="modal" data-target="#addPriceModal"><i class="fa fa-plus append-icon"></i> Add Price </a>
                                                    <table class="table table-condensed table-striped mgtp-10" id="specific_price_table">
                                                        <thead class="vd_bg-dark-blue vd_white">
                                                        <tr>
                                                            <th>Date</th>
                                                            <th>Price</th>
                                                            <th>Enabled</th>

                                                        </tr>
                                                        </thead>
                                                        <tbody>


                                                        <?php

                                                        $numberofitemprice = $product->selectall('itemprice','itemcprice', NULL,'itemcprice='.$itemcodeedit,'','number');
                                                        for ($i = 0; $i < $numberofitemprice; $i++) {
                                                            $x7 = $product->selectall('itemprice', '*', NULL, 'itemcprice=' . $itemcodeedit, '','data')[$i];

                                                            $t=time();

                                                            $date=date("Y-m-d",$t);
                                                            ?>

                                                            <tr>
                                                                <td><?php echo $x7['from']; ?>    -    <?php echo $x7['to']; ?></td>
                                                                <td><?php echo $x7['price']; ?></td>
                                                                <td><?php if(($x7['status']==0)||$x7['to']<$date){
                                                                    echo "<p class='vd_red'>Expired</p>";
                                                                    }else{
                                                                        echo "<p class='vd_green'>Active</p>";
                                                                    } ?></td>
                                                                 </tr>


                                                        <?php }
                                                        ?>






                                                        </tbody>
                                                    </table>
                                                </span>
                                            </div>







                                            <!-- #tab-price -->
                                            <div id="tabseo" class="tab-pane">
                                                <h3 class="mgtp-15 mgbt-xs-20"> Sales And Inventory </h3>
                                                <span class="form-horizontal">

                                                    <div class="form-group">

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="meta_title_1" class="control-label col-lg-3"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Public title for the product's page, and for search engines. Leave blank to use the product name."> Cost </span> </label>
                                                        <div class="col-lg-8">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-lg-9  mgbt-xs-10 mgbt-lg-0">
                                                                    <div class="input-group">
                                                                        <input type="number" value="<?php echo $x3[0]['cost']; ?>" class="input-border-btm" id="cost" name="cost">

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="meta_title_1" class="control-label col-lg-3"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Public title for the product's page, and for search engines. Leave blank to use the product name."> Weight </span> </label>
                                                        <div class="col-lg-8">
                                                            <div class="row mgbt-xs-0">
                                                                <div class="col-lg-9  mgbt-xs-10 mgbt-lg-0">
                                                                    <div class="input-group">
                                                                        <input type="text" value="<?php echo $x1[0]['weight']; ?>" class="input-border-btm" id="weight" name="weight">

                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>



                                                </span>
                                            </div>
                                            <!-- tabseo -->

                                            <div id="tabship" class="tab-pane">
                                                <h3 class="mgtp-15 mgbt-xs-20"> Invoicing</h3>
                                                <span class="form-horizontal">

                                                    <div class="form-group">
                                                        <label for="width" class="control-label col-lg-3"> Can Be Sold</label>
                                                        <div class="col-sm-7 controls">
                                                            <div class="vd_checkbox checkbox-success">
                                                                <input type="checkbox"  id="cbs" name="cbs" <?php if ($x1[0]['canbesold'] == 1) {
                                                                    echo 'checked';
                                                                } ?>>
                                                                <label for="cbs"> Yes </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </span>
                                            </div>
                                            <div id="tabasso" class="tab-pane">
                                                <h3 class="mgtp-15 mgbt-xs-20"> Note</h3>
                                                <span class="form-horizontal">



                                                    <!-- form-group -->

                                                    <div class="form-group">
                                                        <label for="description_1" class="control-label col-lg-3"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Appears in the body of product detail."> Description for Customers </span> </label>
                                                        <div class="col-lg-8 mgbt-xs-10 mgbt-lg-0">
                                                            <textarea name="DFC"  id="DFC" rows="4" ><?php echo $x1[0]['descriptionforcustomers'] ?> </textarea>
                                                        </div>

                                                    </div>
                                                    <!-- form-group -->

                                                    <div class="form-group">
                                                        <label for="description_1" class="control-label col-lg-3"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Appears in the body of product detail."> Description for Delivery Orders </span> </label>
                                                        <div class="col-lg-8 mgbt-xs-10 mgbt-lg-0">
                                                            <textarea name="DFDO" id="DFDO"  rows="4" ><?php echo $x1[0]['descriptionfordeliveryorders'] ?></textarea>
                                                        </div>

                                                    </div>
                                                    <!-- form-group -->

                                                    <div class="form-group">
                                                        <label for="description_1" class="control-label col-lg-3"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Appears in the body of product detail."> Description for Internal Transfers </span> </label>
                                                        <div class="col-lg-8 mgbt-xs-10 mgbt-lg-0">
                                                            <textarea name="DFIT" id="DFIT" rows="4" > <?php echo $x1[0]['descriptionforinternaltransfers'] ?></textarea>
                                                        </div>

                                                    </div>
                                                    <!-- form-group -->


                                                </span>
                                            </div>
                                            <!-- tab-pane -->
                                            <div id="tabimage" class="tab-pane">
                                                <h3 class="mgtp-15 mgbt-xs-20"> Images</h3>
                                                <span class="form-horizontal">

                                                    <div class="form-group">
                                                        <label class="control-label col-lg-3 file_upload_label"> <span title="" data-toggle="tooltip" class="label-tooltip" data-original-title="Format JPG, GIF, PNG. Filesize 8.00 MB max."> Add a new image  </span> </label>
                                                        <div class="col-lg-9"> <span class="btn vd_btn vd_bg-green fileinput-button"> <i class="glyphicon glyphicon-plus"></i> <span>Add files...</span>
                                                                <!-- The file input field used as target for the file upload widget -->
                                                                <input  type="file" name="fileToUpload" id="fileToUpload" onchange="readURL(this);">

                                                            </span> <br>

                                                        </div>
                                                    </div>

                                                    <table id="imageTable" class="table table-dragable">
                                                        <thead>
                                                        <tr class="nodrag nodrop">

                                                            <th class="fixed-width-lg" style="width:40%"><span class="title_box">Image</span></th>
                                                            <th class="fixed-width-lg"><span class="title_box">Caption</span></th>

                                                            <!-- action -->
                                                        </tr>
                                                        </thead>
                                                        <tbody id="imageList">
                                                        <tr>
                                                            <td>
                                                                <a data-rel="prettyPhoto" > <img id="blah" class="rounded mx-auto d-block" src="img/product/<?php echo $x1[0]['itemimage'] ?>" style="width:500px;height: 400px;" alt="product image"> </a></td>
                                                            <td><input type="text" id="imgname" value="<?php echo $x1[0]['itemimage'] ?>" > </input></td>

                                                        </tr>

                                                        </tbody>
                                                    </table>
                                                </span>
                                            </div>
                                            <!-- tab-pane -->

                                        </div>
                                        <!-- tab-content -->

                                    </div>
                                    <!-- panel-body -->

                                    <!-- form-horizontal -->
                                </div>
                                <!-- Panel Widget -->
                                </form>
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
<!-- .content -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header vd_bg-blue vd_white">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                <h4 class="modal-title" id="myModalLabel">Cancel Changes</h4>
            </div>
            <div class="modal-body">
                <h5>Are you sure you want to cancel your changes?</h5>
            </div>
            <div class="modal-footer background-login">
                <button type="button"  class="btn vd_btn vd_bg-grey" data-dismiss="modal" onclick="refresh()">Yes</button>
                <button type="button" class="btn vd_btn vd_bg-green"  data-dismiss="modal">No</button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<div class="modal fade" id="addPriceModal" tabindex="-1" role="dialog" aria-labelledby="priceModalLabel" aria-hidden="true" >
        <div class="modal-dialog">
            <form method="POST" action="">
            <div class="modal-content" >
                <div class="modal-header vd_bg-blue vd_white" >
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="fa fa-times"></i></button>
                    <h4 class="modal-title" id="priceModalLabel">Add Price for this item</h4>
                </div>
                <div class="modal-body" style="height: 250px;">

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
                    <button type="submit" value="submit"  class="btn vd_btn vd_bg-green" id="submit"><i class="fa fa-plus append-icon" ></i> Add Price</button>
                </div>
                </form> </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->


<!-- /.modal -->

<?php require_once('templates/footers/' . $footer . '.tpl.php'); ?>

<!-- Specific Page Scripts Put Here -->
<?php include('templates/scripts/pages-ecommerce-product-add.tpl.php'); ?>

<!-- Specific Page Scripts END -->

<?php require_once('templates/footers/closing.tpl.php'); ?>
