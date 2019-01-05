<?php

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
<?php $title = 'Home | Dashboard '; ?>
<?php $keywords = ''; ?>
<?php $description = ''; ?>
<?php $page = 'dashboard';   // To set active on the same id of primary menu ?>
<?php
// Additional Specific CSS
$specific_css[0] = 'plugins/fullcalendar/fullcalendar.css';
$specific_css[1] = 'plugins/fullcalendar/fullcalendar.print.css';
$specific_css[2] = 'plugins/introjs/css/introjs.min.css';
?>

    <!-- End of Data -->

<?php require_once('templates/headers/'.$header.'.tpl.php'); ?>

    <div class="content">
        <div class="container">
            <?php if ($navbar_left_config != 0) { $current_navbar="vd_navbar-left"; require('templates/navbars/'.$navbar_left.'.tpl.php'); }?>
            <?php if ($navbar_right_config != 0) { $current_navbar="vd_navbar-right"; require('templates/navbars/'.$navbar_right.'.tpl.php'); }?>

            <br><br><br><br><br><br><br> <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

        </div>
        <!-- .container -->
    </div>
    <!-- .content -->

<?php require_once('templates/footers/'.$footer.'.tpl.php'); ?>

    <!-- Specific Page Scripts Put Here -->
<?php include('templates/scripts/index.tpl.php'); ?>

    <!-- Specific Page Scripts END -->

<?php require_once('templates/footers/closing.tpl.php'); ?>