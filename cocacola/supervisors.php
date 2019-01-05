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
$employee = new emp();
$numberofsupervisors=$employee->selectall('supervisors','id',NULL,'','','number');
?>

<?php require_once('templates/headers/opening.tpl.php'); ?>

<script>
function salesman(superid) {
    var name="txtHint"+superid;
    var xhttp;
    if (superid == "") {
        document.getElementById(name).innerHTML = "";
        return;
    }
    xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(name).innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "./operation/selectselesman.php?superid="+superid, true);
    xhttp.send();
}
</script>


<!-- Specific Page Data -->
<?php $title = 'List Supervisors'; ?>
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
                                <li class="active">List Supervisors</li>
                            </ul>
                            <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                        </div>
                    </div>
                    <div class="vd_title-section clearfix">
                        <div class="vd_panel-header">
                            <h1>List Supervisors</h1>
                            <small class="subtitle"></small>
                            <div class="form-group">


                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="panel widget">
                                            <div class="panel-heading">
                                                <h3 class="panel-title  vd_black"> <span class="menu-icon"> <i class="fa fa-dot-circle-o"></i> </span> Table of Supervisors </h3>
                                            </div>
                                            <div class="panel-body-list  table-responsive">
                                                <table class="table table-striped table-hover no-head-border">
                                                    <thead class="vd_bg-green vd_white">
                                                    <tr>
                                                        <th>Id</th>
                                                        <th>Username</th>
                                                        <th>Email</th>
                                                        <th>Area</th>
                                                        <th>Group</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                    $supervisorsid=$employee->selectall('supervisors','*',NULL,'','','data');
                                                    for($i=0;$i<$numberofsupervisors;$i++){
                                                        $employeeid=$employee->selectall('emp','*',NULL,'empno='.$supervisorsid[$i]['empid'],'','data');
                                                        $employeearea=$employee->selectall('area','*',NULL,'id='.$supervisorsid[$i]['areaid'],'','data');
                                                         ?>
                                                        <tr>
                                                            <td ><?php echo $employeeid[0]['empno'];?><span id="<?php echo $supervisorsid[$i]['id'];?>" class="icon-arrow-down4" onclick="salesman(this.id)" data-placeholder="List Salesman"></span>
                                                             </td>


                                                            <td><?php echo $employeeid[0]['user'];?></td>
                                                            <td><?php echo $employeeid[0]['email'];?></td>
                                                            <td><?php echo $employeearea[0]['areadesc'];?></td>
                                                            <td ><?php if($employeeid[0]['groupID']==2){echo "Supervisors";} ;?></td>
                                                            <td class="center">
                                                                <?php
                                                                if($employeeid[0]['status']==1){
                                                                    ?>
                                                                    <span class="label label-success">Active</span>
                                                                <?php }elseif($employeeid[0]['status']==0){ ?>
                                                                    <span class="label label-danger">Deactivate</span>
                                                                <?php } ?>
                                                            </td>
                                                            <td class="menu-action"><a data-original-title="view" data-toggle="tooltip" data-placement="top" class="btn menu-icon vd_bd-grey vd_grey"> <i class="fa fa-eye"></i> </a> <a data-original-title="edit" data-toggle="tooltip" data-placement="top" class="btn menu-icon  vd_bd-grey vd_grey"> <i class="fa fa-pencil"></i> </a> </td>
                                                        <tbody id="txtHint<?php echo $supervisorsid[$i]['id'];?>"></tbody>
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
</div>
<!-- .content -->


<?php require_once('templates/footers/' . $footer . '.tpl.php'); ?>



<?php require_once('templates/footers/closing.tpl.php'); ?>

<!-- Specific Page Scripts Put Here -->

