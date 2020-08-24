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
              Add User
              <small>User Form</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">User Form</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
              <div class="box">
                  <div class="box-header">
                      <h3 class="box-title">Add User</h3>
                      <span class="pull-right">
                        <a href="<?= base_url('userdetail'); ?>" class="btn btn-block btn-primary">Back</a>
                      </span>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body box box-primary">
                    <div class="row">
                       <form method="POST" id="formadduser" action="<?= base_url('userdetail/adduser'); ?>" enctype="multipart/form-data">
                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Firstname <span class="error">*</span></label>
                                <input type="text" class="form-control" name="firstname" id="firstname" value="<?= set_value('firstname') ?>">
                                 <?= form_error('firstname') ?>
                            </div>

                            <div class="form-group">
                              <label>Email <span class="error">*</span></label>
                                <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email') ?>">
                                <?= form_error('email') ?>
                            </div>

                            <div class="form-group">
                              <label>Gender</label>
                               <select name="gender" id="gender" class="form-control select2">
                                <option>Select a gender</option>
                                <option value="male" <?php echo set_select('gender', 'male'); ?> >Male</option>
                                <option value="female" <?php echo set_select('gender', 'female'); ?>>Female</option>
                              </select>
                               
                            </div>
                            <div class="form-group">
                              <label>Profile</label>
                               <input type="file" class="form-control" id="profile" name="profile" onchange="readURL(this);"  value="<?= set_value('profile') ?>">
                                <div class="thumbnail">
                                  <img id="blah" src="<?php echo base_url().'/assets/upload/profile/noprofile.jpg'; ?>" alt="your image" height="150px" width="150px" />
                                </div>
                            </div>
                           
                          </div>

                          <div class="col-md-6">
                             <div class="form-group">
                              <label>Lastname <span class="error">*</span></label>
                               <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname') ?>">
                                <?= form_error('lastname') ?>
                            </div>

                            <div class="form-group">
                              <label>Username <span class="error">*</span></label>
                                <input type="text" class="form-control" name="username" id="username" value="<?= set_value('username') ?>">
                                <?= form_error('username') ?>
                            </div>

                            <div class="form-group">
                              <label>Mobile no <span class="error">*</span></label>
                              <input type="text" class="form-control" onkeypress="return isNumber(event)"  name="mobileno" id="mobileno" value="<?= set_value('mobileno') ?>">
                              <?= form_error('mobileno') ?>
                            </div>
                            <label>User Permissions</label>
                            <div class="form-group"><br>
                              <label>Inventory</label><br>
                               <input type="checkbox" name="inventory[]" value="view"> View &nbsp;
                               <input type="checkbox" name="inventory[]" value="edit"> Edit &nbsp;
                               <input type="checkbox" name="inventory[]" value="delete"> Delete <br>
                            </div>
                          </div>

                           <div class="col-md-6">
                            <div class="form-group">
                              <label>Sell</label><br>
                               <input type="checkbox" name="sell[]" value="view"> View &nbsp;
                               <input type="checkbox" name="sell[]" value="edit"> Edit &nbsp;
                               <input type="checkbox" name="sell[]" value="delete"> Delete <br>
                            </div>

                            <!-- <div class="form-group">
                              <label>Generate bill</label><br>
                               <input type="checkbox" name="bill[]" value="yes"> Yes &nbsp;
                               <input type="checkbox" name="bill[]" value="no"> No &nbsp;
                            </div> -->
                          </div>

                          <div class="col-md-6">
                            <div class="form-group">
                              <label>Report</label><br>
                               <input type="checkbox" name="report[]" value="view"> View &nbsp;
                               <input type="checkbox" name="report[]" value="edit"> Edit &nbsp;
                               <input type="checkbox" name="report[]" value="delete"> Delete <br>
                            </div>
                          </div>

                          <div class="col-md-12">
                           <div class="form-group">
                              <label>Address <span class="error">*</span></label>
                              <textarea class="form-control" name="address" id="address" rows="2"  ><?= set_value('address') ?></textarea>
                               <?= form_error('address') ?>
                            </div>
                          </div>

                          <div class="col-md-6">
                            <div class="col-md-3">
                              <button type="submit" name="adduser" value="adduser" id="adduser" class="btn btn-block btn-primary">Save</button>
                            </div>
                             <div class="col-md-3">
                              <a href="<?= base_url('userdetail'); ?>" class="btn btn-block btn-danger">Cancel</a>
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
   /* ;(function($, window, document, undefined) {
          $("#formadduser").validate({
            errorClass: 'error',
            errorElement: 'span',
            rules: {
                "firstname": {required: true},
                "lastname": {required: true},
                "email": {required: true},
                "mobileno": {required: true},
                "username": {required: true},
                "password": {required: true},
                "address": {required: true},
            },
            messages: {
                "firstname": {required: "Please enter firstname"},
                "lastname": {required: "Please enter lastname"},
                "email": {required: "Please enter email id"},
                "mobileno": {required: "Please enter mobile no"},
                "username": {required: "Please enter username"},
                "password": {required: "Please enter password"},
                "address": {required: "Please enter address"},
            }
       });
   })(jQuery, window, document);*/
</script>
<?php $this->load->view('layout/footer'); ?>

