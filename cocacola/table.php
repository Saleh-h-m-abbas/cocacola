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
<?php $title = 'Data Tables HTML Template - Responsive Multipurpose Admin Templates'; ?>
<?php $keywords = 'HTML5 Template, CSS3, All Purpose Admin Template, Vendroid'; ?>
<?php $description = 'Data Tables - Responsive Admin HTML Template'; ?>
<?php $page = 'tables';   // To set active on the same id of primary menu ?>
<?php
// Specific Data Tables CSS
$specific_css[0] = 'plugins/dataTables/css/jquery.dataTables.css';   // Data Table CSS
$specific_css[1] = 'plugins/dataTables/css/dataTables.bootstrap.css';   // Data Table CSS
?>
    <!-- End of Data -->
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
            xhttp.open("GET", "./operation/getproducttable.php?org="+str, true);
            xhttp.send();
        }

    </script>
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
                                    <li><a href="listtables-tables-variation.php">List &amp; Tables</a> </li>
                                    <li class="active">Data Tables</li>
                                </ul>
                                <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                            </div>
                        </div>
                        <div class="vd_title-section clearfix">
                            <div class="vd_panel-header">
                                <h1>Data Tables</h1>
                       </div>
                        <div class="vd_content-section clearfix">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="panel widget">
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

                                          <div id="txtHint"></div>

                                    </div>
                                    <!-- Panel Widget -->
                                </div>
                                <!-- col-md-12 -->
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
<?php include('templates/scripts/listtables-data-tables.tpl.php'); ?>

    <!-- Specific Page Scripts END -->

<?php require_once('templates/footers/closing.tpl.php'); ?>