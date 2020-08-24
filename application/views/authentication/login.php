<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>MedicalStore | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/plugins/iCheck/square/blue.css">
  <!-- custome css -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/custom.css">
  <!-- toster css -->
  <link rel="stylesheet" href="<?= base_url(); ?>assets/css/build/toastr.css">
   <link rel="stylesheet" href="<?= base_url(); ?>assets/css/sweetalert.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
  <script src="<?= base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script> 

  
 <!--  <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script> -->
 <!--  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />
  <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" /> -->


 <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>

 
  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
      <?php if ($this->session->flashdata('Msg')) { ?>
            <div class="alert alert-<?= $this->session->flashdata('Msg_class'); ?> fade in" id="messagebox">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echo $this->session->flashdata('Msg'); ?> </strong> 
            </div>
     <?php } ?>  

   <!--  <?php if($msg = $this->session->flashdata('Msg')) { ?>
    <script>
        $(document).ready(function () {
            Notification('<?= $this->session->flashdata('Msg_class'); ?>', '<?= $msg ?>', '<?= $this->session->flashdata('Msg_class'); ?>');
        });
    </script>
  <?php } ?>  -->

  <div class="login-logo">
    <a href="#"><b>Medical</b>STORE</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>

    <form id="formlogin" action="<?= base_url(); ?>login" method="post">
        <div class="form-group has-feedback">
          <input type="text" name="loginUsername" class="form-control" placeholder="Username / Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" name="loginPassword" class="form-control" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        <div class="row">
          <div class="col-xs-8">
            <div class="checkbox icheck">
              <label>
                <input type="checkbox"> Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" name="login" id="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
    </form>

   <!--  <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div> -->
    <!-- /.social-auth-links -->

    <a href="#" data-toggle="modal" data-target="#myModal" >I forgot my password</a><br>
   <!--  <a href="" class="text-center">Register a new membership</a> -->

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- forget password -->
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
        <form action="<?= base_url('login/forgotpassemail'); ?>" method="POST" id="formforget" accept-charset="utf-8">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Forgot your account's password?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <fieldset>
                                <p>Enter your email address and we'll send you a recovery link.</p>
                                <div class="form-group">
                                    <input type="email" name="email" value="" class="form-control" placeholder="Email Address">
                                </div>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name="btnsend" id="btnsend" class="btn btn-primary">Send</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- jQuery 3 -->
<!-- <script src="<?= base_url(); ?>assets/bower_components/jquery/dist/jquery.min.js"></script> -->
<!-- jquery validation -->
 <script src="<?= base_url(); ?>assets/js/jquery.validate.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?= base_url(); ?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?= base_url(); ?>assets/plugins/iCheck/icheck.min.js"></script>


<!-- toster -->
<script src="<?= base_url(); ?>assets/js/toastr.js"></script> 
<script src="<?= base_url(); ?>assets/js/toasterJS.js"></script> 
<script src="<?= base_url(); ?>assets/js/sweetalert.min.js"></script> 
<script src="<?= base_url(); ?>assets/js/custom.js"></script> 

<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
<script>
    //message
    $("#messagebox").show().delay(3000).fadeOut();

    //login validation
    ;(function($, window, document, undefined) {
          //validation
          $("#formlogin").validate({
            errorClass: 'error pull-left text-capitalize',
            errorElement: 'span',
            rules: {
                "loginUsername": {required: true},
                "loginPassword": {required: true},
            },
            messages: {
                "loginUsername": {required: "Please enter username"},
                "loginPassword": {required: "Please enter password"},
            }
           });

              //forget passwird
             //validation
          $("#formforget").validate({
            errorClass: 'error pull-left text-capitalize',
            errorElement: 'span',
            rules: {
                "email": {required: true},
                
            },
            messages: {
                "email": {required: "Please enter email address"},
            }
          });

   })(jQuery, window, document);

   

</script>
</body>
</html>
