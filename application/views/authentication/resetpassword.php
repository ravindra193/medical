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
    <p class="login-box-msg">Reset your Password</p>

    <form action="<?php base_url('login/resetpassword'); ?>" method="POST" role="form" class="resetpasswordForm">
            <div class="form-group">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Enter new password" >
                     <?= form_error('password') ?>
            </div>
            <div class="form-group">
                    <input type="password" class="form-control" name="conpass" id="conpass" placeholder="Enter confirm password" >
                     <?= form_error('conpass') ?>
            </div>
            
        <div class="text-center">
          <button type="submit" name="btnsubmit" id="btnsubmit" value="resetpass" class="btn btn-primary btn-lg">Submit</button>
        </div>
    </form>     

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->



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
   })(jQuery, window, document);

</script>
</body>
</html>
