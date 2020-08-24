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
              Add customer 
              <small>Customer form</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Customer form</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add Customer</h3>
                            <span class="pull-right">
                              <a href="<?= base_url('supplierdetail'); ?>" class="btn btn-block btn-primary">Back</a>
                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box box-primary">
                          <div class="row">
                             <form method="POST" id="formadduser" action="<?= base_url('supplierdetail/addsupplier'); ?>" enctype="multipart/form-data">
                              <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="billheader box-header with-border ">
                                            <h3 class="box-title">Customer Detail</h3>
                                        </div>
                                    </div>
                              </div>

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
                                    <label>Mobile no <span class="error">*</span></label>
                                    <input type="text" class="form-control" name="mobileno" onkeypress="return isNumber(event)" id="mobileno" value="<?= set_value('mobileno') ?>">
                                    <?= form_error('mobileno') ?>
                                  </div>
                                  
                                </div>


                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Lastname <span class="error">*</span></label>
                                     <input type="text" class="form-control" name="lastname" id="lastname" value="<?= set_value('lastname') ?>">
                                      <?= form_error('lastname') ?>
                                  </div>

<!--                                   <div class="form-group">
                                    <label>Gender</label>
                                     <select name="gender" id="gender" class="form-control select2">
                                      <option>Select a gender</option>
                                      <option value="male" <?php echo set_select('gender', 'male'); ?>>Male</option>
                                      <option value="female" <?php echo set_select('gender', 'female'); ?>>Female</option>
                                    </select>
                                  </div>       -->                            

                                   <div class="form-group">
                                    <label>Telephone number <span class="error">*</span></label>
                                    <input type="text" class="form-control" name="telephone_number" onkeypress="return isNumber(event)" id="telephone_number" value="<?= set_value('telephone_number') ?>">
                                    <?= form_error('telephone_number') ?>
                                  </div>

                                 <!--  <div class="form-group">
                                    <label>Profile</label>
                                     <input type="file" class="form-control" onchange="readURL(this);" id="profile" name="profile" value="<?= set_value('profile') ?>">
                                     <div class="thumbnail">
                                        <img id="blah" src="<?php echo base_url().'/assets/upload/profile/noprofile.jpg'; ?>" alt="your image" height="150px" width="150px" />
                                      </div>
                                  </div> -->
                              </div>

                              <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="billheader box-header with-border ">
                                            <h3 class="box-title">Company detail</h3>
                                        </div>
                                    </div>
                              </div>

                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Company name <span class="error">*</span></label>
                                     <input type="text" class="form-control" name="company_name" id="company_name" value="<?= set_value('company_name') ?>">
                                      <?= form_error('company_name') ?>
                                  </div>

                                   <div class="form-group">
                                    <label>Trading name <span class="error">*</span></label>
                                      <input type="text" class="form-control" name="trading_name" id="cust_ac_number" value="<?= set_value('trading_name') ?>">
                                       <?= form_error('trading_name') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>VAT no <span class="error">*</span></label>
                                     <input type="text" class="form-control" name="vat_no" id="vat_no" onkeypress="return isNumber(event)" value="<?= set_value('vat_no') ?>">
                                      <?= form_error('vat_no') ?>
                                  </div>

                                   <div class="form-group">
                                    <label>Company registration number <span class="error">*</span></label>
                                     <input type="text" class="form-control" name="com_reg_no" id="com_reg_no" value="<?= set_value('com_reg_no') ?>">
                                      <?= form_error('com_reg_no') ?>
                                  </div>

                                  <!-- add bank detail -->
                                    <div class="form-group">
                                       <label>GPHC number <span class="error">*</span></label>
                                        <input type="text" class="form-control" name="gphc_number" onkeypress="return isNumber(event)" id="gphc_number" value="<?= set_value('gphc_number') ?>">
                                      <?= form_error('gphc_number') ?>
                                  </div>
                                  
                                </div>

                                <div class="col-md-6">
                                   <div class="form-group">
                                    <label>WDA registration number <span class="error">*</span></label>
                                      <input type="text" class="form-control" name="wda_reg_number" onkeypress="return isNumber(event)" id="wda_reg_number" value="<?= set_value('wda_reg_number') ?>">
                                       <?= form_error('wda_reg_number') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Authorization date <span class="error">*</span></label>
                                     <input type="text" class="form-control" name="authorization_date" id="authorization_date" value="<?= set_value('authorization_date') ?>">
                                      <?= form_error('authorization_date') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Website url </label>
                                      <input type="text" class="form-control" name="website_url" id="website_url" value="<?= set_value('website_url') ?>">
                                  </div>

                                   <div class="form-group">
                                       <label>Invoice address <span class="error">*</span></label>
                                        <textarea class="form-control" name="invoice_address" id="invoice_address" rows="2"  ><?= set_value('invoice_address') ?></textarea>
                                      <?= form_error('invoice_address') ?>
                                      <br>
                                      <label>Same address </label> &nbsp;
                                       <input type="checkbox" onclick="copyText()" />
                                    </div>
                                 
                                    <div class="form-group">
                                       <label>Delivery address <span class="error">*</span></label>
                                         <textarea class="form-control" name="delivery_address" id="delivery_address" rows="2"  ><?= set_value('delivery_address') ?></textarea>
                                      <?= form_error('delivery_address') ?>
                                    </div>
                                   <script type="text/javascript" language="javascript">
                                     function copyText()
                                     {
                                        var a = document.getElementById('invoice_address');
                                        var b = document.getElementById('delivery_address');
                                        if (a != null)
                                        {
                                         b.value = a.value;
                                        }
                                      }
                                    </script>
                                  
                                  <!-- <div class="form-group">
                                    <label>Post code <span class="error">*</span></label>
                                     <input type="text" class="form-control" onkeypress="return isNumber(event)" name="post_code" id="post_code" value="<?= set_value('post_code') ?>">
                                  </div> -->
                                  
                              </div>
                              <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="billheader box-header with-border ">
                                            <h3 class="box-title">Bank detail</h3>
                                        </div>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                <div class="form-group">
                                    <label>Account number <span class="error">*</span></label>
                                     <input type="text" class="form-control" onkeypress="return isNumber(event)" name="account_number" id="account_number" value="<?= set_value('account_number') ?>">
                                      <?= form_error('account_number') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Bank name <span class="error">*</span></label>
                                     <input type="text" class="form-control"  name="bank_name" id="bank_name" value="<?= set_value('bank_name') ?>">
                                      <?= form_error('bank_name') ?>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group">
                                    <label>Bank Branch <span class="error">*</span></label>
                                     <input type="text" class="form-control" name="bank_branch" id="bank_branch" value="<?= set_value('bank_branch') ?>">
                                      <?= form_error('bank_branch') ?>
                                  </div>
                                 
                                   <div class="form-group">
                                    <label>Sort code <span class="error">*</span></label>
                                      <input type="text" class="form-control" name="sort_code" id="sort_code" onkeypress="return isNumber(event)" value="<?= set_value('sort_code') ?>">
                                       <?= form_error('sort_code') ?>
                                  </div>
                              </div>

                              <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="billheader box-header with-border ">
                                            <h3 class="box-title">References</h3>
                                        </div>
                                    </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Trade references 1 <span class="error">*</span></label>
                                        <input type="text" class="form-control" name="trade_references_1" id="trade_references_1" value="<?= set_value('trade_references_1') ?>">
                                      <?= form_error('trade_references_1') ?>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                     <label>Trade references 2</label>
                                      <input type="text" class="form-control" name="trade_references_2" id="trade_references_2" value="<?= set_value('trade_references_2') ?>">
                                  </div>
                              </div>

                              <div class="col-md-12">
                                <div class="col-md-1">
                                  <button type="submit" name="addsupplier" value="addsupplier" id="addsupplier" class="btn btn-block btn-primary">Save</button>
                                </div>
                                 <div class="col-md-1">
                                  <a href="<?= base_url('supplierdetail'); ?>" class="btn btn-block btn-danger">Cancel</a>
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

    $(function () {
     //Date picker
      $('#authorization_date').datepicker({
        format: 'dd-mm-yyyy'
     });
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

