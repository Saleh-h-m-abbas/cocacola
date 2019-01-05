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

        username = document.getElementById("username").value;
        fullname = document.getElementById("fullname").value;
        customertype = document.getElementById("customertype").value;
        company = document.getElementById("company").value;
        phone = document.getElementById("phone").value;
        area = document.getElementById("area").value;
        country = document.getElementById("country").value;
        street = document.getElementById("street").value;
        email = document.getElementById("email").value;
        password = document.getElementById("password").value;
        confirmpass = document.getElementById("confirmpass").value;

        fileName = "./operation/register-form.php?username=" + username +"&fullname=" + fullname +"&customertype" + customertype +"&company=" + company + "&phone=" + phone+"&area="+area+"&country="+country+"&street="+street+"&email="+email+"&password="+password;

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
<?php $title = 'Add Customer'; ?>
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
                                <li class="active">Add Customer</li>
                            </ul>
                            <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                        </div>
                    </div>
                    <div class="vd_title-section clearfix">
                        <div class="vd_panel-header">
                            <h1>Add Customer</h1>
                            <small class="subtitle"></small>
                            <div class="form-group">





                                    <div class="panel-body">
                                        <!--                  <div id="register-success" class="alert alert-success" style="display:none;"><i class="fa fa-exclamation-circle fa-fw"></i> Registration confirmation has been sent to your email </div>
                                                          <div id="register-passerror" class="alert alert-danger" style="display:none;"><i class="fa fa-exclamation-circle fa-fw"></i> Your password and Confirm password are not same </div>-->

                                        <form class="form-horizontal" action="operation/register-form.php" method="POST" role="form" id="register-form">
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="label-wrapper">
                                                        <label class="control-label">UserName <span class="vd_red">*</span></label>
                                                    </div>
                                                    <div class="vd_input-wrapper" id="first-name-input-wrapper"> <span class="menu-icon"> <i class="fa fa-user"></i> </span>
                                                        <input type="text" placeholder="Enter Username" class="required" required name="username" id="username">
                                                    </div>
                                                </div>

                                            </div>
                                <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="label-wrapper">
                                                        <label class="control-label">Full Name <span class="vd_red">*</span></label>
                                                    </div>
                                                    <div class="vd_input-wrapper" id="first-name-input-wrapper"> <span class="menu-icon"> <i class="fa fa-user"></i> </span>
                                                        <input type="text" placeholder="Enter Customer Full Name" class="required" required name="fullname" id="fullname">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="label-wrapper">
                                                        <label class="control-label">Customer Type <span class="vd_red">*</span></label>
                                                    </div>
                                                    <div class="vd_input-wrapper" id="company-input-wrapper"> <span class="menu-icon">  </span>
                                                        <select  name="customertype" id="customertype">
                                                            <option>Select Customer Type</option>
                                                            <?php
                                                            $numberofcusttype=$customer->selectall('customertype','custmeridty',NULL,'','','number');
                                                            //select item code using selectall
                                                            $custtypedata = $customer->selectall('customertype','*', NULL,'','','data');
                                                            for ($i = 0; $i < $numberofcusttype; $i++) {
                                                                // for loop to store single item in $item and create options from this item where itemcode
                                                                ?>
                                                                <option value="<?php echo $custtypedata[$i]['custmeridty']; ?>">  <?php echo $custtypedata[$i]['typedesc']; ?>    </option>

                                                            <?php } ?>

                                                        </select></div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="label-wrapper">
                                                        <label class="control-label">Company Name <span class="vd_red">*</span></label>
                                                    </div>
                                                    <div class="vd_input-wrapper" id="company-input-wrapper"> <span class="menu-icon"> <i class="fa fa-briefcase"></i> </span>
                                                        <input type="text" placeholder="Enter Customer Company" class="required" required  name="company" id="company">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group ">
                                                <div class="col-md-3">
                                                    <div class="label-wrapper">
                                                        <label class="control-label">Phone <span class="vd_red">*</span></label>
                                                    </div>
                                                    <div class="vd_input-wrapper" id="country-code-input-wrapper"> <span class="menu-icon"> <i class="fa fa-plus"></i> </span>
                                                        <input type="number" value="970" class="required" required  name="phonecountry" id="phonecountry" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-9">
                                                    <div class="label-wrapper">
                                                        <label class="control-label">&nbsp;</label>
                                                    </div>
                                                    <div class="vd_input-wrapper no-icon" id="phone-input-wrapper">
                                                        <input type="number" placeholder="Enter Phone Number" class="required" required  name="phone" id="phone">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="label-wrapper">
                                                        <label class="control-label">Area <span class="vd_red">*</span></label>
                                                    </div>
                                                    <div  class="vd_input-wrapper no-icon" id="phone-input-wrapper">
                                                        <select  name="area" id="area">
                                                            <option>Select Customer Area</option>
                                                            <?php
                                                            $numberofareais=$customer->selectall('area','id',NULL,'','','number');
                                                            //select item code using selectall
                                                            $areadata = $customer->selectall('area','*', NULL,'','','data');
                                                            for ($i = 0; $i < $numberofareais; $i++) {
                                                                // for loop to store single item in $item and create options from this item where itemcode
                                                                 ?>
                                                                <option value="<?php echo $areadata[$i]['id']; ?>">  <?php echo $areadata[$i]['areadesc']; ?>    </option>

                                                            <?php } ?>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="label-wrapper">
                                                        <label class="control-label">Country</label>
                                                    </div>
                                                    <div class="vd_input-wrapper">
                                                        <input type="text" placeholder="Enter Customer Country" class=""  name="country" id="country">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="label-wrapper">
                                                        <label class="control-label">Street</label>
                                                    </div>
                                                    <div class="vd_input-wrapper"> <span class="menu-icon">  </span>
                                                        <input type="text" placeholder="Enter Customer Street" class=""  name="street" id="street">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <div class="label-wrapper">
                                                        <label class="control-label">Email <span class="vd_red">*</span></label>
                                                    </div>
                                                    <div class="vd_input-wrapper" id="email-input-wrapper"> <span class="menu-icon"> <i class="fa fa-envelope"></i> </span>
                                                        <input type="email" placeholder="Enter Customer Email" class="required" required  name="email" id="email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-6">
                                                    <div class="label-wrapper">
                                                        <label class="control-label">Password <span class="vd_red">*</span></label>
                                                    </div>
                                                    <div class="vd_input-wrapper" id="password-input-wrapper"> <span class="menu-icon"> <i class="fa fa-lock"></i> </span>
                                                        <input type="password" placeholder="Enter Customer Password" class="required" required  name="password" id="password">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="label-wrapper">
                                                        <label class="control-label">Confirm Password <span class="vd_red">*</span></label>
                                                    </div>
                                                    <div class="vd_input-wrapper" id="confirm-password-input-wrapper"> <span class="menu-icon"> <i class="fa fa-lock"></i> </span>
                                                        <input type="password" placeholder="Enter Confirm Password" class="required" required  name="confirmpass" id="confirmpass">
                                                    </div>
                                                </div>
                                            </div>
                                            <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                                            <div class="form-group">

                                                <div class="col-md-12 text-center mgbt-xs-5">
                                                    <button class="btn vd_bg-green vd_white width-100" type="submit" id="submit" onclick="insertdata()" name="submit-register">Add Customer</button>
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

