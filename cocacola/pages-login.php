<?php
require './class/database.inc';
session_start();

if(isset($_SESSION['email'])){
    echo("<script>location.href ='index.php';</script>");

}

?>
<?php require_once('templates/headers/opening.tpl.php'); ?>

<!-- Specific Page Data -->
<?php $title = 'Login Pages'; ?>
<?php $keywords = 'Login'; ?>
<?php $description = 'Login Pages - CocaCola'; ?>
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

<script type="text/javascript">
    $(document).ready(function() {

        "use strict";

        var form_register_2 = $('#login-form');
        var error_register_2 = $('.alert-danger', form_register_2);
        var success_register_2 = $('.alert-success', form_register_2);

        form_register_2.validate({
            errorElement: 'div', //default input error message container
            errorClass: 'vd_red', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {

                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                },

            },

            errorPlacement: function(error, element) {
                if (element.parent().hasClass("vd_checkbox") || element.parent().hasClass("vd_radio")){
                    element.parent().append(error);
                } else if (element.parent().hasClass("vd_input-wrapper")){
                    error.insertAfter(element.parent());
                }else {
                    error.insertAfter(element);
                }
            },

            invalidHandler: function (event, validator) { //display error alert on form submit
                success_register_2.hide();
                error_register_2.show();


            },

            highlight: function (element) { // hightlight error inputs

                $(element).addClass('vd_bd-red');
                $(element).parent().siblings('.help-inline').removeClass('help-inline hidden');
                if ($(element).parent().hasClass("vd_checkbox") || $(element).parent().hasClass("vd_radio")) {
                    $(element).siblings('.help-inline').removeClass('help-inline hidden');
                }

            },

            unhighlight: function (element) { // revert the change dony by hightlight
                $(element)
                    .closest('.control-group').removeClass('error'); // set error class to the control group
            },

            success: function (label, element) {
                label
                    .addClass('valid').addClass('help-inline hidden') // mark the current input as valid and display OK icon
                    .closest('.control-group').removeClass('error').addClass('success'); // set success class to the control group
                $(element).removeClass('vd_bd-red');


            },

            submitHandler: function (form) {


                $(form).find('#login-submit').prepend('<i class="fa fa-spinner fa-spin mgr-10"></i>')/*.addClass('disabled').attr('disabled')*/;
                success_register_2.show();
                error_register_2.hide();


                //setTimeout(function(){window.location.href = "index.php"},2000)	 ;
            }
        });


    });
</script>


<?php require_once('templates/headers/'.$header.'.tpl.php'); ?>

<?php


$db=new Database();
$db->connect();

if(isset($_POST['submit']))
{

$email=$_POST['email'];
$password=$_POST['password'];
$rememberme = $_POST['checkbox-1'];



$x=$db->select('emp','*','','email='.'"'.$email.'"'.' And pass='.$password,'','');
$x1=$db->getResult();
if(($db->numRows())!= null){

$username= $x1[0]['user'];
    $groupid=$x1[0]['groupID'];
    $_SESSION['email'] = $email;
    $_SESSION['username'] = $username;
    $_SESSION['groupID'] = $groupid;
    $_SESSION['lock'] = 0;
if($rememberme==1){
    $hour = time() + 3600 * 24 * 30;
    setcookie('email', $email, $hour);
    setcookie('username', $username, $hour);
}
    echo "<script>alert('Welcome $username');</script>";
    echo("<script>location.href = 'index.php';</script>");
    exit();

}else{
    $message = "wrong username or password ";
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
                <h4 class="text-center font-semibold vd_grey">LOGIN TO YOUR ACCOUNT</h4>
              </div>
              <div class="panel widget">
                <div class="panel-body">
                  <div class="login-icon entypo-icon"> <i class="icon-key"></i> </div>
                  <form class="form-horizontal" id="login-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST' role="form">
                  <div class="alert alert-danger vd_hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-exclamation-circle vd_red"></i></span><strong>Oh snap!</strong> Change a few things up and try submitting again. </div>
                  <div class="alert alert-success vd_hidden">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon-cross"></i></button>
                    <span class="vd_alert-icon"><i class="fa fa-check-circle vd_green"></i></span><strong>Well done!</strong>. </div>                  
                    <div class="form-group  mgbt-xs-20">
                      <div class="col-md-12">
                        <div class="label-wrapper sr-only">
                          <label class="control-label" for="email">Email</label>
                        </div>
                        <div class="vd_input-wrapper" id="email-input-wrapper"> <span class="menu-icon"> <i class="fa fa-envelope"></i> </span>
                          <input type="email" placeholder="Email" id="email" name="email" class="required" required>
                        </div>
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
                        <button class="btn vd_bg-green vd_white width-100" type="submit" name='submit' id="login-submit">Login</button>
                      </div>
                      <div class="col-md-12">
                        <div class="row">
                          <div class="col-xs-6">
                            <div class="vd_checkbox">
                              <input type="checkbox" name="checkbox-1" id="checkbox-1" value="1">
                              <label for="checkbox-1"> Remember me</label>
                            </div>
                          </div>
                          <div class="col-xs-6 text-right">
                            <div class=""> <a href="pages-forget-password.php">Forget Password? </a> </div>
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
