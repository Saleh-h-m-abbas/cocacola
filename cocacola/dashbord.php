<?php

require './class/inv.inc';

session_start();

if(!isset($_SESSION['email'])){
    echo("<script>location.href ='pages-login.php';</script>");

}
if($_SESSION['lock']!=0){
    echo("<script>location.href ='pages-Lockscreen.php';</script>");

}

$product= new invenotry();
?>

<?php require_once('templates/headers/opening.tpl.php'); ?>

    <!-- Specific Page Data -->
<?php $title = 'Morris Chart HTML Template - Responsive Multipurpose Admin Templates'; ?>
<?php $keywords = 'HTML5 Template, CSS3, All Purpose Admin Template, Vendroid'; ?>
<?php $description = 'Morris Chart - Responsive Admin HTML Template'; ?>
<?php $page = 'charts';   // To set active on the same id of primary menu ?>
<?php
// Specific CSS
$specific_css[0] = 'plugins/morris/morris.css';

?>

    <!-- End of Data -->

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
                                    <li class="active">Default Dashboard</li>
                                </ul>
                                <?php include('templates/widgets/panel-menu-head-section.tpl.php'); ?>
                            </div>
                        </div>
                        <!-- vd_head-section -->

                        <div class="vd_title-section clearfix">
                            <div class="vd_panel-header">
                                <h1>Dashboard</h1>
                                <small class="subtitle">Default dashboard for multipurpose demonstration</small>
                                <?php include('templates/widgets/panel-menu-title-section-index.tpl.php'); ?>
                            </div>
                            <!-- vd_panel-header -->
                        </div>
                        <!-- vd_title-section -->

                        <div class="vd_content-section clearfix">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel widget light-widget">
                                        <div class="panel-heading no-title"> </div>
                                        <div class="panel-body">
                                            <h2 class="mgtp--5"> <span class="font-semibold">Morris</span> Chart </h2>
                                            <p>Morris.js is the library that powers the graphs on <a href="http://www.oesmith.co.uk/morris.js/">http://www.oesmith.co.uk/morris.js/</a>.
                                                It's a very simple API for drawing line, bar, area and donut charts.</p>
                                        </div>
                                    </div>
                                    <!-- Panel Widget -->
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mgbt-xs-20 mgbt-md-0">
                                    <div class="panel widget  light-widget">
                                        <div class="panel-heading no-title">
                                        </div>
                                        <div class="panel-body-list pd-25">
                                            <h2 class="mgtp--5"> <span class="font-semibold">Area</span> Chart </h2>
                                            <div id="chart-placeholder" class="pie-chart" style="height:318px;"></div>
                                        </div>
                                    </div>
                                    <!-- col-md-6 -->
                                </div>
                                <!-- row -->

                                <div class="col-md-6 mgbt-xs-20 mgbt-md-0">
                                    <div class="panel widget light-widget">
                                        <div class="panel-heading no-title">
                                            <?php include('templates/widgets/panel-menu-widget-no-minimize.tpl.php'); ?>
                                        </div>
                                        <div class="panel-body-list pd-25">
                                            <h2 class="mgtp--5"> <span class="font-semibold">Line</span> Chart </h2>
                                            <div id="line-placeholder" class="line-placeholder" style="height:318px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- col-md-6 -->
                            </div>
                            <!-- row -->

                            <div class="row">
                                <div class="col-md-6 mgbt-xs-20 mgbt-md-0">
                                    <div class="panel widget  light-widget">
                                        <div class="panel-heading no-title">
                                            <?php include('templates/widgets/panel-menu-widget-no-minimize.tpl.php'); ?>
                                        </div>
                                        <div class="panel-body-list pd-25">
                                            <h2 class="mgtp--5"> <span class="font-semibold">Bar</span> Chart </h2>
                                            <div id="bar-placeholder" class="bar-chart" style="height:318px;"></div>
                                        </div>
                                    </div>
                                    <!-- col-md-6 -->
                                </div>
                                <!-- row -->

                                <div class="col-md-6 mgbt-xs-20 mgbt-md-0">
                                    <div class="panel widget light-widget">
                                        <div class="panel-heading no-title">
                                            <?php include('templates/widgets/panel-menu-widget-no-minimize.tpl.php'); ?>
                                        </div>
                                        <div class="panel-body-list pd-25">
                                            <h2 class="mgtp--5"> <span class="font-semibold">Pie</span> Chart </h2>
                                            <div id="donut-placeholder" class="donut-placeholder" style="height:318px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <!-- col-md-6 -->
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

<?php include('templates/scripts/charts-morris.tpl.php'); ?>


    <!-- Specific Page Scripts END -->

<?php require_once('templates/footers/closing.tpl.php'); ?>