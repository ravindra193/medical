<?php
defined('BASEPATH') OR exit('No direct script access allowed');

 $this->load->view('layout/header');
 $this->load->view('layout/sidebar');
?>
  <!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<?php if ($this->session->flashdata('Msg')) { ?>
            <div class="alert alert-<?= $this->session->flashdata('Msg_class'); ?> fade in" id="messagebox">
             <!--    <a href="#" class="close" data-dismiss="alert">&times;</a> -->
                <strong><?php echo $this->session->flashdata('Msg'); ?> </strong> 
            </div>
<?php } ?>  
      <section class="content-header">
          <h1>
              Profile 
              <small>Profile Form</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Profile Form</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> Profile</h3>
                           
                        </div>
                        <?php
                         $roll = $this->session->userdata('roll');
                          /*echo "<pre>";
                        print_r($userdata);
                        die();*/ ?>
                        <!-- /.box-header -->
                        <div class="box-body box box-primary">
                          <div class="row">
                             <form method="POST" id="formuserprofile" action="<?= base_url('userdetail/userprofile'); ?>" enctype="multipart/form-data">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Firstname <strong class="error">*</strong></label>
                                      <input type="text" class="form-control" name="firstname" id="firstname" value="<?php if(!empty($userdata)){ echo $userdata->first_name;} ?>">
                                      
                                  </div>
                                  <div class="form-group">
                                    <label>Lastname <strong class="error">*</strong></label>
                                     <input type="text" class="form-control" name="lastname" id="lastname" value="<?php if(!empty($userdata)){ echo $userdata->last_name;} ?>">
                                    
                                  </div>

                                  <div class="form-group">
                                    <label>Gender</label>
                                     <select name="gender" id="gender" class="form-control">
                                      <option>Select a gender</option>
                                      <option value="male" <?php if(!empty($userdata->gender == "male")){ echo "Selected"; } ?> >Male</option>
                                      <option value="female" <?php if(!empty($userdata->gender == "female")){ echo "Selected"; } ?>>Female</option>
                                    </select>
                                     
                                  </div>
                                  <div class="form-group">
                                    <label>Profile</label>
                                      <input type="hidden" name="profile1" value="<?php  if(!empty($userdata->profile)){ echo  $userdata->profile; } ?>">
                                     <input type="file" class="form-control" id="profile" onchange="readURL(this);"  name="profile" value="">
                                      <div class="thumbnail">
                                          <?php if(!empty($userdata->profile)){ ?>
                                                 <img id="blah" src="<?php echo base_url().'/assets/upload/profile/'.$userdata->profile; ?>" alt="" height="150px" width="150px">
                                          <?php }else{ ?>
                                                <img id="blah" src="<?php echo base_url().'/assets/upload/profile/noprofile.jpg'; ?>" alt="" height="150px" width="150px">
                                          <?php } ?>
                                      </div>
                                  </div>
                                 
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Email <strong class="error">*</strong></label>
                                      <input type="email" class="form-control" id="email" name="email" value="<?php if(!empty($userdata)){ echo $userdata->email;} ?>">
                                   
                                  </div>
                                  <div class="form-group">
                                    <label>Mobile no <strong class="error">*</strong></label>
                                    <input type="text" class="form-control" onkeypress="return isNumber(event)" name="mobileno" id="mobileno" value="<?php if(!empty($userdata)){ echo $userdata->mobile_no;} ?>">
                                  
                                  </div>

                                  <div class="form-group">
                                    <label>Username </label>
                                      <input type="text" class="form-control" readonly name="username" id="username" value="<?php if(!empty($userdata)){ echo $userdata->username;} ?>">
                                  </div>

                                  <!-- <div class="form-group">
                                    <label>vat % </label>
                                      <input type="text" class="form-control" <?php if($roll != "0"){ echo "readonly"; } ?>   name="vat" id="vat" value="<?php if(!empty($sellvat)){ echo $sellvat->medicine_vat;} ?>">
                                  </div> -->
                                </div>

                                <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="4"  ><?php if(!empty($userdata)){ echo $userdata->address;} ?></textarea>
                                    
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="col-md-3">
                                    <input type="hidden" name="userid" value="<?php if(!empty($userdata)){ echo $userdata->id;} ?>"> 
                                    <button type="submit" name="updateprofile" value="updateprofile" id="updateprofile" class="btn btn-block btn-primary">Update</button>
                                  </div>
                                   
                                </div>

                               </form>
                            </div>
                        </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
    </section>
</div>
<!-- /.content-wrapper -->
<script type="text/javascript">
  //Initialize Select2 Elements
   $(function () {
    $('.select2').select2()
   });
   //add user form validation
    ;(function($, window, document, undefined) {
          $("#formuserprofile").validate({
            errorClass: 'error',
            errorElement: 'span',
            rules: {
                "firstname": {required: true},
                "lastname": {required: true},
                "email": {required: true},
                "mobileno": {required: true},
               /* "username": {required: true},
                "password": {required: true},*/
            },
            messages: {
                "firstname": {required: "Please enter firstname"},
                "lastname": {required: "Please enter lastname"},
                "email": {required: "Please enter email id"},
                "mobileno": {required: "Please enter mobile no"},
                /*"username": {required: "Please enter username"},
                "password": {required: "Please enter password"},  */             
            }
       });
   })(jQuery, window, document);
</script>
<?php $this->load->view('layout/footer'); ?>

