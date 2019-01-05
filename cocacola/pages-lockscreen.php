<?php
require './class/database.inc';
session_start();


if(!isset($_SESSION['email'])){
    echo("<script>location.href ='pages-login.php';</script>");

}
$_SESSION['lock'] = 1 ;

?>

<?php require_once('templates/headers/opening.tpl.php'); ?>

<!-- Specific Page Data -->
<?php $title = 'Lockscreen '; ?>
<?php $keywords = 'HTML5 Template, CSS3, All Purpose Admin Template, Vendroid'; ?>
<?php $description = 'Lockscreen Pages - Responsive Admin HTML Template'; ?>
<?php $page = 'pages';   // To set active on the same id of primary menu ?>
<?php 
	// Specific Configuration
	$header = 'header-empty'; 
	$body_extra_class="remove-navbar login-layout";  
	$footer = "footer-2"; 
	$background = "background-login"; 
	$navbar_left_config = 0;
	$navbar_right_config = 0; 
?>

<!-- End of Data -->

<?php require_once('templates/headers/'.$header.'.tpl.php'); ?>




<?php


$db=new Database();
$db->connect();

if(isset($_POST['submit']))
{

    $email=$_SESSION['email'];
    $password=$_POST['password'];



    $x=$db->select('emp','*','','email='.'"'.$email.'"'.' And pass='.$password,'','');
    $x1=$db->getResult();
    if(($db->numRows())!= null){
        $_SESSION['lock'] = 0;

        echo("<script>location.href = 'index.php';</script>");
        exit();

    }else{
        $message = "wrong is password ";
        echo "<script>alert('$message');</script>";

    }

}

?>
<div class="content">
  <div class="container"> 
    
    <!-- Middle Content Start -->
    
    <div class="vd_content-wrapper">
      <div class="vd_container">
        <div class="vd_content clearfix">
          <div class="vd_content-section clearfix">
            <div class="vd_login-page">
              <div class="heading clearfix">
                <div class="logo">
                  <h2 class="mgbt-xs-5"><img src="img/logo1.png" alt="logo"></h2>
                </div>
                <h3 class="text-center font-semibold vd_grey">LOCK SCREEN</h3>
              </div>
              <div class="panel widget">
                <div class="panel-body">
                  <div class="login-icon no-bd"> <img class="img-circle" style="width:120px; height:120px; margin-top:-10px;" src="img/avatar/avatar.jpg" alt="avatar"> </div>
                  <form class="form-horizontal" id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST'  role="form">
                  <div class="alert alert-danger vd_hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Oh snap!</strong> Change a few things up and try submitting again. </div>
                  <div class="alert alert-success vd_hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-check-circle vd_green"></i></span><strong>Well done!</strong>. </div>                  
                    <div class="form-group  mgbt-xs-20">
                      <div class="col-md-12">
                        <div class="label-wrapper">
                          <label class="control-label sr-only" for="password">Password</label>
                        </div>
                        <div class="vd_input-wrapper" id="password-input-wrapper" > <span class="menu-icon"> <i class="fa fa-lock"></i> </span>
                          <input type="password" placeholder="Password" id="password" name="password" class="required" required>
                        </div>
                      </div>
                    </div>
                    <div id="vd_login-error" class="alert alert-danger hidden"><i class="fa fa-exclamation-circle fa-fw"></i> Please fill the necessary field </div>
                    <div class="form-group">
                      <div class="col-md-12 text-center mgbt-xs-5">
                        <button class="btn vd_bg-green vd_white width-100" type="submit" name="submit" id="login-submit"><i class="fa fa-unlock append-icon"></i>Login</button>
                      </div>                      
                    </div>
                  </form>
                </div>
              </div>
              <!-- Panel Widget -->
              <div class="register-panel text-center font-semibold"> <a href="pages-register.php">LOGOUT<span class="menu-icon"><i class="fa fa-angle-double-right fa-fw"></i></span></a> </div>
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

<?php require_once('templates/footers/'.$footer.'.tpl.php'); ?>



<!-- Specific Page Scripts END -->

<?php require_once('templates/footers/closing.tpl.php'); ?>
