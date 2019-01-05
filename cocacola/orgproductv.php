<?php
require './class/inv.inc';
$product = new invenotry();

$numberoforg = $product->selectall('organization','orgcode',NULL,'','','number');

session_start();

if(!isset($_SESSION['email'])){
    echo("<script>location.href ='pages-login.php';</script>");

}
if($_SESSION['lock']!=0){
    echo("<script>location.href ='pages-Lockscreen.php';</script>");

}

?>

<?php require_once('templates/headers/opening.tpl.php'); ?>

    <!-- Specific Page Data -->
<?php $title = 'Product List'; ?>
<?php $keywords = ''; ?>
<?php $description = ''; ?>
<?php $page = 'forms';   // To set active on the same id of primary menu ?>
    <!-- End of Data -->

<?php require_once('templates/headers/'.$header.'.tpl.php'); ?>

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
            xhttp.open("GET", "./operation/getproduct.php?org="+str, true);
            xhttp.send();
        }

    </script>


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
                                    <li><a href="inventory.php">Inventory</a> </li>
                                    <li class="active">Product List</li>
                                </ul>
                                <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                            </div>
                        </div>
                        <div class="vd_title-section clearfix">
                            <div class="vd_panel-header">
                                <h1>Product List</h1>
                                <small class="subtitle"></small>

                            </div>
                        </div>

                        <div class="container">
                            <div class="tab-content">
                                <div id="view" class="tab-pane fade in active">
                                    <div class="vd_content-section clearfix">
                                        <div id="tabinfo" class="tab-pane active">
                                            <div class="row">
                                                <div class="col-md-12 col-xs-12">
                                                    <div class="panel widget light-widget panel-bd-top">
                                                        <div class="panel-heading no-title"> </div>
                                                        <div class="panel-body">
                                                            <h3 class="mgtp--5"> Product</h3>

                                                            <div class="content-grid column-xs-2 column-sm-2 column-md-4 column-lg-5 column-lg-10 height-xs-5">
                                                                <label class="col-sm-2 control-label">Organization</label>
                                                                <select class="width-80" name="from" id="from" onchange="showCustomer(this.value)">
                                                                    <option>Select Organiztion</option>
                                                                    <option value="All">  All    </option>
                                                                    <?php
                                                                    //select item code and store in $itemcodeis
                                                                    $itemcodeis = $product->selectall('organization','*', NULL,'','','data');
                                                                    for ($i = 0; $i < $numberoforg; $i++) {
                                                                        $orgfrom = ($product->selectall('organization', '*', NULL, 'orgcode=' . $itemcodeis[$i]["orgcode"], '','data'));
                                                                        ?>
                                                                        <option value="<?php echo $itemcodeis[$i]['orgcode']; ?>">  <?php echo $orgfrom[0]['desc']; ?>    </option>
                                                                    <?php } ?>
                                                                </select>

                                                                <div id="txtHint"></div>   </div>
                                                            <!-- content-grid -->
                                                        </div>
                                                    </div>
                                                    <!-- Panel Widget -->
                                                </div>
                                                <!-- col-md-4 -->
                                            </div>
                                        </div>
                                    </div>
                                </div></div></div></div>


                                </div></div></div></div>



<?php require_once('templates/footers/'.$footer.'.tpl.php'); ?>

    <!-- Specific Page Scripts Put Here -->
<?php include('templates/scripts/forms-wizard.tpl.php'); ?>


    <!-- Specific Page Scripts END -->

<?php require_once('templates/footers/closing.tpl.php'); ?>