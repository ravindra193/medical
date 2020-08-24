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
              Update User
              <small>User Form</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Update Form</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Update User</h3>
                            <span class="pull-right">
                              <a href="<?= base_url('userdetail'); ?>" class="btn btn-block btn-primary">Back</a>
                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box box-primary">
                          <div class="row">
                             <form method="POST" id="formupdateuser" action="<?= base_url('userdetail/update_user'); ?>" enctype="multipart/form-data">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Firstname <strong class="error">*</strong></label>
                                      <input type="text" class="form-control" name="firstname" id="firstname" value="<?php if(!empty($userdata)){ echo $userdata->first_name;} ?>" >
                                       <?= form_error('firstname') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Email <strong class="error">*</strong></label>
                                      <input type="email" class="form-control" id="email" name="email" value="<?php if(!empty($userdata)){ echo $userdata->email;} ?>">
                                      <?= form_error('email') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Gender</label>
                                     <select name="gender" id="gender" class="form-control select2">
                                      <option>Select a gender</option>
                                      <option value="male" <?php if(!empty($userdata->gender == "male")){ echo "Selected"; } ?> <?php echo set_select("gender", "male"); ?>  >Male</option>
                                      <option value="female" <?php if(!empty($userdata->gender == "female")){ echo "Selected"; } ?> <?php echo set_select("gender", "female"); ?>>Female</option>
                                    </select>
                                     
                                  </div>
                                  <div class="form-group">
                                    <label>Profile</label>
                                     <input type="hidden" name="profile1" value="<?php  if(!empty($userdata->profile)){ echo  $userdata->profile; } ?>">
                                     <input type="file" class="form-control" onchange="readURL(this);"  id="profile" name="profile" value="">
                                     <div class="thumbnail">
                                          <?php if(!empty($userdata->profile)){ ?>
                                                 <img id="blah" src="<?php echo base_url().'/assets/upload/profile/'.$userdata->profile; ?>"  alt="" height="150px" width="150px">
                                          <?php }else{ ?>
                                                <img id="blah" src="<?php echo base_url().'/assets/upload/profile/noprofile.jpg'; ?>" alt="" height="150px" width="150px">
                                          <?php } ?>
                                      </div>
                                  </div>
                                 
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Lastname <strong class="error">*</strong></label>
                                     <input type="text" class="form-control" name="lastname" id="lastname" value="<?php if(!empty($userdata)){ echo $userdata->last_name;} ?>">
                                      <?= form_error('lastname') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Username</label>
                                      <input type="text" class="form-control" name="username" id="username" readonly value="<?php if(!empty($userdata)){ echo $userdata->username;} ?>">
                                      <?= form_error('username') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Mobile no <strong class="error">*</strong></label>
                                    <input type="text" class="form-control" onkeypress="return isNumber(event)" name="mobileno" id="mobileno" value="<?php if(!empty($userdata)){ echo $userdata->mobile_no;} ?>">
                                    <?= form_error('mobileno') ?>
                                  </div>
                                    <label>User Permissions</label>
                                   <div class="form-group"><br>
                                    <label>Inventory</label><br>
                                      <?php 
                                        if(!empty($inventory_permi)){
                                         /* echo "<pre>";
                                          print_r($inventory_permi);
                                          die();*/
                                         ?>
                                         <input type="hidden" name="inventory_id" value="<?php echo $inventory_permi->id; ?>">
                                        <?php 
                                         $inventory =  $inventory_permi->permissions;
                                           if(!empty($inventory)){
                                             $in_per = explode(",",$inventory);
                                          }
                                        }
                                      ?>
                                     <input type="checkbox" name="inventory[]"
                                     <?php if(!empty($in_per)){ foreach ($in_per as  $value) {  if(!empty($value) && $value == "view"){ echo "checked"; } } }  ?>  value="view"> View &nbsp;
                                 
                                    <input type="checkbox" name="inventory[]"
                                     <?php if(!empty($in_per)){ foreach ($in_per as  $value) {  if(!empty($value) && $value == "edit"){ echo "checked"; } } }  ?> value="edit"> Edit &nbsp;
                             
                                     <input type="checkbox" name="inventory[]" 
                                     <?php if(!empty($in_per)){ foreach ($in_per as  $value) {  if(!empty($value) && $value == "delete"){ echo "checked"; } } }  ?> value="delete"> Delete <br>
                                  </div>
                                  
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Sell</label><br>
                                     <?php 
                                        if(!empty($sell_permi)){ ?>
                                         <input type="hidden" name="sell_id" value="<?php echo $sell_permi->id; ?>">
                                        <?php 
                                          $sell =  $sell_permi->permissions;
                                           if(!empty($sell)){
                                             $sell_per = explode(",",$sell);
                                          }
                                        }
                                      ?>
                                      <input type="checkbox" name="sell[]" 
                                       <?php if(!empty($sell_per)){ foreach ($sell_per as  $value) {  if(!empty($value) && $value == "view"){ echo "checked"; } } }  ?>
                                        value="view"> View &nbsp;
                                 
                                     <input type="checkbox" name="sell[]" 
                                      <?php if(!empty($sell_per)){ foreach ($sell_per as  $value) {  if(!empty($value) && $value == "edit"){ echo "checked"; } } }  ?>
                                      value="edit"> Edit &nbsp;
                             
                                     <input type="checkbox" name="sell[]" 
                                      <?php if(!empty($sell_per)){ foreach ($sell_per as  $value) {  if(!empty($value) && $value == "delete"){ echo "checked"; } } }  ?>
                                       value="delete"> Delete <br>
                                   
                                  </div>

                                  <!-- <div class="form-group">
                                    <label>Generate bill</label><br>
                                    <?php 
                                        if(!empty($bill_permi)){ ?>
                                         <input type="hidden" name="bill_id" value="<?php echo $bill_permi->id; ?>">
                                        <?php 
                                          $bill =  $bill_permi->permissions;
                                           if(!empty($bill)){
                                             $bill_per = explode(",",$bill);
                                          }
                                        }
                                      ?>
                                     <input type="checkbox" name="bill[]" 
                                     <?php if(!empty($bill_per)){ foreach ($bill_per as  $value) {  if(!empty($value) && $value == "yes"){ echo "checked"; } } }  ?>
                                      value="yes"> Yes &nbsp;
                                     <input type="checkbox" name="bill[]" 
                                     <?php if(!empty($bill_per)){ foreach ($bill_per as  $value) {  if(!empty($value) && $value == "no"){ echo "checked"; } } }  ?>
                                      value="no"> No &nbsp;
                                  </div> -->
                                </div>

                                 <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Report</label><br>
                                    <?php 
                                        if(!empty($report_permi)){ ?>
                                         <input type="hidden" name="report_id" value="<?php echo $report_permi->id; ?>">
                                        <?php 
                                          $report =  $report_permi->permissions;
                                           if(!empty($report)){
                                             $report_per = explode(",",$report);
                                          }
                                        }
                                      ?>
                                     <input type="checkbox" name="report[]" 
                                     <?php if(!empty($report_per)){ foreach ($report_per as  $value) {  if(!empty($value) && $value == "view"){ echo "checked"; } } }  ?>
                                      value="view"> View &nbsp;
                                     <input type="checkbox" name="report[]"
                                     <?php if(!empty($report_per)){ foreach ($report_per as  $value) {  if(!empty($value) && $value == "edit"){ echo "checked"; } } }  ?>
                                      value="edit"> Edit &nbsp;
                                     <input type="checkbox" name="report[]" 
                                     <?php if(!empty($report_per)){ foreach ($report_per as  $value) {  if(!empty($value) && $value == "delete"){ echo "checked"; } } }  ?>
                                      value="delete"> Delete <br>
                                  </div>
                                </div>

                                <div class="col-md-12">
                                 <div class="form-group">
                                    <label>Address <strong class="error">*</strong></label>
                                    <textarea class="form-control" name="address" id="address" rows="2" ><?php if(!empty($userdata)){ echo $userdata->address;} ?></textarea>
                                     <?= form_error('address') ?>
                                  </div>
                                </div>

                            <?php   $viewdetail = $this->uri->segment(4);
                                   if(empty($viewdetail)){ ?>
                                <div class="col-md-6">
                                  <div class="col-md-3">
                                    <input type="hidden" name="userid" value="<?php if(!empty($userdata)){ echo $userdata->id;} ?>">
                                   <button type="submit" name="updateuser" value="updateuser" id="updateuser" class="btn btn-block btn-primary">Update</button>
                                 <!--  <button type="button" name="btnedit" value="edit" id="btnedit" class="btn btn-block btn-primary btnedit">Edit</button> -->
                                  </div>
                                   <div class="col-md-3">
                                    <a href="<?= base_url('userdetail'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                  </div>
                                </div>
                            <?php } ?>
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

   //edit detail
   $(document).ready(function(){
   /* $(".btnedit").click(function (e) {
          $('#btnedit').css('display','none');
          $('#updateuser').css('display','block');
      });
      $('#updateuser').css('display','none');*/
  });

   //add user form validation
    ;(function($, window, document, undefined) {
          $("#formupdateuser").validate({
            errorClass: 'error',
            errorElement: 'span',
            rules: {
                "firstname": {required: true},
                "lastname": {required: true},
                "email": {required: true},
                "mobileno": {required: true},
                "address": {required: true},
            },
            messages: {
                "firstname": {required: "The first name field is required."},
                "lastname": {required: "The last name field is required."},
                "email": {required: "The email field is required."},
                "mobileno": {required: "The mobile field is required."},
                "address": {required: "The address field is required."},
            }
       });
   })(jQuery, window, document);
</script>
<?php $this->load->view('layout/footer'); ?>