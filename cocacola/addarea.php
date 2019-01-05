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
$customer = new customer();

?>

<?php require_once('templates/headers/opening.tpl.php'); ?>

<script>
    function insertdata() {

        area = document.getElementById("area").value;


        fileName = "./operation/insertarea.php?area=" + area ;

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
                                <li class="active">Add Area</li>
                            </ul>
                            <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                        </div>
                    </div>
                    <div class="vd_title-section clearfix">
                        <div class="vd_panel-header">
                            <h1>Add Area</h1>
                            <small class="subtitle"></small>
                            <div class="form-group">





                                <div class="panel-body">
                                    <!--                  <div id="register-success" class="alert alert-success" style="display:none;"><i class="fa fa-exclamation-circle fa-fw"></i> Registration confirmation has been sent to your email </div>
                                                      <div id="register-passerror" class="alert alert-danger" style="display:none;"><i class="fa fa-exclamation-circle fa-fw"></i> Your password and Confirm password are not same </div>-->

                                    <form class="form-horizontal" action="operation/insertarea.php" method="POST" role="form" id="register-form">
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <div class="label-wrapper">
                                                    <label class="control-label">Area Name <span class="vd_red">*</span></label>
                                                </div>
                                                <div class="vd_input-wrapper" id="first-name-input-wrapper"> <span class="menu-icon"> <i class="fa icon-location"></i> </span>
                                                    <input type="text" placeholder="Area Name" class="required" required name="area" id="area">
                                                </div>
                                            </div>


                                        <div class="form-group">

                                            <div class="col-md-3 text-center mgbt-xs-5" style="margin-left: 74%;">
                                                <button class="btn vd_bg-green vd_white width-100" type="submit" id="submit" onclick="insertdata()" name="submit">Add Area</button>
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

