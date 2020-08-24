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
              Update Customer
              <small>Customer Form</small>
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
                            <h3 class="box-title">Update Customer</h3>
                            <span class="pull-right">
                              <a href="<?= base_url('supplierdetail'); ?>" class="btn btn-block btn-primary">Back</a>
                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box box-primary">
                          <div class="row">
                             <form method="POST" id="formupdatesupplier" action="<?= base_url('supplierdetail/update_supplier'); ?>" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="billheader box-header with-border ">
                                            <h3 class="box-title">Customer Detail</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Firstname <strong class="error">*</strong></label>
                                      <input type="text" class="form-control" name="firstname" id="firstname" value="<?php if(!empty($supplierdata)){ echo $supplierdata->first_name;} ?>">
                                       <?= form_error('firstname') ?>
                                  </div>

                                   <div class="form-group">
                                    <label>Email <strong class="error">*</strong></label>
                                      <input type="email" class="form-control" id="email" name="email" value="<?php if(!empty($supplierdata)){ echo $supplierdata->email;} ?>">
                                      <?= form_error('email') ?>
                                  </div>

                                   <div class="form-group">
                                    <label>Mobile no <strong class="error">*</strong></label>
                                    <input type="number" class="form-control" name="mobileno" id="mobileno" value="<?php if(!empty($supplierdata)){ echo $supplierdata->mobile_no;} ?>">
                                    <?= form_error('mobileno') ?>
                                  </div>
                                  
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Lastname <strong class="error">*</strong></label>
                                     <input type="text" class="form-control" name="lastname" id="lastname" value="<?php if(!empty($supplierdata)){ echo $supplierdata->last_name;} ?>">
                                      <?= form_error('lastname') ?>
                                  </div>
                                  
                                  <!--  <div class="form-group">
                                    <label>Gender</label>
                                     <select name="gender" id="gender" class="form-control">
                                      <option>Select a gender</option>
                                      <option value="male" <?php if(!empty($supplierdata->gender == "male")){ echo "Selected"; } ?> >Male</option>
                                      <option value="female" <?php if(!empty($supplierdata->gender == "female")){ echo "Selected"; } ?>>Female</option>
                                    </select>
                                  </div> -->

                                  <div class="form-group">
                                    <label>Telephone number <strong class="error">*</strong></label>
                                    <input type="text" class="form-control" name="telephone_number" onkeypress="return isNumber(event)" id="telephone_number" value="<?php if(!empty($supplierdata)){ echo $supplierdata->telephone_number;} ?>">
                                    <?= form_error('telephone_number') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Customer Number <strong class="error">*</strong></label>
                                    <input type="number" class="form-control" readonly name="cust_number" id="cust_number" value="<?php if(!empty($supplierdata)){ echo $supplierdata->cust_account_number;} ?>">
                                  </div>
                                  
                                <!--   <div class="form-group">
                                    <label>Profile </label>
                                     <input type="hidden" name="profile1" value="<?php if(!empty($supplierdata->profile)){ echo  $supplierdata->profile; } ?>">
                                     <input type="file" class="form-control" onchange="readURL(this);" id="profile" name="profile" value="">
                                     <div class="thumbnail">
                                          <?php if(!empty($supplierdata->profile)){ ?>
                                                 <img id="blah" src="<?php echo base_url().'/assets/upload/supplier/'.$supplierdata->profile; ?>" alt="" height="150px" width="150px">
                                          <?php }else{ ?>
                                                <img id="blah" src="<?php echo base_url().'/assets/upload/supplier/noprofile.jpg'; ?>" alt="" height="150px" width="150px">
                                          <?php } ?>
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
                                    <label>Company name <strong class="error">*</strong></label>
                                     <input type="text" class="form-control" name="company_name" id="company_name" value="<?php if(!empty($supplierdata)){ echo $supplierdata->company_name;} ?>">
                                      <?= form_error('company_name') ?>
                                  </div>

                                   <div class="form-group">
                                    <label>Trading name <strong class="error">*</strong></label>
                                      <input type="text" class="form-control" name="trading_name" id="cust_ac_number" value="<?php if(!empty($supplierdata)){ echo $supplierdata->trading_name;} ?>">
                                       <?= form_error('trading_name') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>VAT no <strong class="error">*</strong></label>
                                     <input type="text" class="form-control" name="vat_no" id="vat_no" value="<?php if(!empty($supplierdata)){ echo $supplierdata->vat_no;} ?>">
                                      <?= form_error('vat_no') ?>
                                  </div>

                                   <div class="form-group">
                                    <label>Company registration number <strong class="error">*</strong></label>
                                     <input type="text" class="form-control" name="com_reg_no" id="com_reg_no" value="<?php if(!empty($supplierdata)){ echo $supplierdata->com_reg_no;} ?>">
                                      <?= form_error('com_reg_no') ?>
                                  </div>
                                  <div class="form-group">
                                       <label>GPHC number <strong class="error">*</strong></label>
                                        <input type="text" class="form-control" name="gphc_number" id="gphc_number" value="<?php if(!empty($supplierdata)){ echo $supplierdata->gphc_number;} ?>">
                                           <?= form_error('gphc_number') ?>
                                    </div>     
                              </div>

                              <div class="col-md-6">
                                   <div class="form-group">
                                    <label>WDA registration number <strong class="error">*</strong></label>
                                      <input type="text" class="form-control" name="wda_reg_number" id="wda_reg_number" value="<?php if(!empty($supplierdata)){ echo $supplierdata->wda_reg_number;} ?>">
                                       <?= form_error('wda_reg_number') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Authorization date <strong class="error">*</strong></label>
                                     <input type="text" class="form-control" name="authorization_date" id="authorization_date" value="<?php if(!empty($supplierdata)){ echo $supplierdata->authorization_date;} ?>">
                                      <?= form_error('authorization_date') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Website url </label>
                                      <input type="text" class="form-control" name="website_url" id="website_url" value="<?php if(!empty($supplierdata)){ echo $supplierdata->website_url;} ?>">
                                       <?= form_error('website_url') ?>
                                  </div>

                                   <div class="form-group">
                                       <label>Invoice address <strong class="error">*</strong></label>
                                        <textarea class="form-control" name="invoice_address" id="invoice_address" rows="2"  ><?php if(!empty($supplierdata)){ echo $supplierdata->invoice_address;} ?></textarea>
                                          <?= form_error('invoice_address') ?>
                                          <br>
                                        <label>Same address</label> &nbsp;
                                         <input type="checkbox" onclick="copyText()" />
                                    </div>
                                 
                                    <div class="form-group">
                                       <label>Delivery address <strong class="error">*</strong></label>
                                       <textarea class="form-control" name="delivery_address" id="delivery_address" rows="2"  ><?php if(!empty($supplierdata)){ echo $supplierdata->delivery_address;} ?></textarea>
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
                                    <label>Account number <strong class="error">*</strong></label>
                                     <input type="text" class="form-control" onkeypress="return isNumber(event)" name="account_number" id="account_number" value="<?php if(!empty($supplierdata)){ echo $supplierdata->account_number;} ?>">
                                     <?= form_error('account_number') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Bank name <strong class="error">*</strong></label>
                                     <input type="text" class="form-control"  name="bank_name" id="bank_name" value="<?php if(!empty($supplierdata)){ echo $supplierdata->bank_name;} ?>">
                                     <?= form_error('bank_name') ?>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Bank Branch <strong class="error">*</strong></label>
                                     <input type="text" class="form-control" name="bank_branch" id="bank_branch" value="<?php if(!empty($supplierdata)){ echo $supplierdata->bank_branch;} ?>">
                                      <?= form_error('bank_branch') ?>
                                  </div>
                                   
                                   <div class="form-group">
                                    <label>Sort code <strong class="error">*</strong></label>
                                      <input type="text" class="form-control" name="sort_code" id="sort_code" onkeypress="return isNumber(event)" value="<?php if(!empty($supplierdata)){ echo $supplierdata->sort_code;} ?>">
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
                                    <label>Trade references 1 <strong class="error">*</strong></label>
                                        <input type="text" class="form-control" name="trade_references_1" id="trade_references_1" value="<?php if(!empty($supplierdata)){ echo $supplierdata->trade_references_1;} ?>">
                                        <?= form_error('trade_references_1') ?>
                                  </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group">
                                       <label>Trade references 2</label>
                                        <input type="text" class="form-control" name="trade_references_2" id="trade_references_2" value="<?php if(!empty($supplierdata)){ echo $supplierdata->trade_references_2;} ?>">
                                    </div>
                              </div>


                                <?php   $viewdetail = $this->uri->segment(4);
                                 if(empty($viewdetail)){ ?>
                                  <div class="col-md-6">
                                    <div class="col-md-3">
                                      <input type="hidden" name="supplierid" value="<?php if(!empty($supplierdata)){ echo $supplierdata->id;} ?>"> 
                                      <button type="submit" name="updateuser" value="updateuser" id="updateuser" class="btn btn-block btn-primary">Update</button>
                                    </div>
                                     <div class="col-md-3">
                                      <a href="<?= base_url('supplierdetail'); ?>" class="btn btn-block btn-danger">Cancel</a>
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

    $(function () {
     //Date picker
      $('#authorization_date').datepicker({
        format: 'dd-mm-yyyy'
     });
   });

   //add user form validation
    ;(function($, window, document, undefined) {
          $("#formupdatesupplier").validate({
            errorClass: 'error',
            errorElement: 'span',
            rules: {
                "firstname": {required: true},
                "lastname": {required: true},

                "company_name": {required: true},
                "trading_name": {required: true},
                "vat_no": {required: true},
                "com_reg_no": {required: true},

                "email": {required: true},
                "mobileno": {required: true},

                "telephone_number": {required: true},
                "wda_reg_number": {required: true},
                "authorization_date": {required: true},
               // "website_url": {required: true},
                //"post_code": {required: true},

                "address": {required: true},
                //add extra filed

                "sort_code": {required: true},
                "account_number": {required: true},
                "bank_name": {required: true},
                "bank_branch": {required: true},

                "trade_references_1": {required: true},
                "invoice_address": {required: true},
                "delivery_address": {required: true},
                "gphc_number": {required: true},
               

            },
            messages: {
                "firstname": {required: "The first name field is required."},
                "lastname": {required: "The last name field is required."},
               
                "company_name": {required: "The company name field is required."},
                "trading_name": {required: "The trading name field is required."},
                "vat_no": {required: "The vat no field is required."},
                "com_reg_no": {required: "The company registration number field is required."},

                "email": {required: "The email field is required."},
                "mobileno": {required: "The mobile field is required."},

                "telephone_number": {required: "The telephone number field is required."},
                "wda_reg_number": {required: "The WDA registration number field is required."},
                "authorization_date": {required: "The authorization date field is required."},
              //  "website_url": {required: "The website url field is required."},
               // "post_code": {required: "The post code field is required."},

                "address": {required: "The address field is required."},
                //add extra filed

                "sort_code": {required: "The sort code field is required."},
                "account_number": {required: "The account number field is required."},
                "bank_name": {required: "The bank name field is required."},
                "bank_branch": {required: "The bank branch field is required."},

                "trade_references_1": {required: "The trade references 1 field is required."},
                "invoice_address": {required: "The invoice address field is required."},
                "delivery_address": {required: "The delivery address field is required."},
                "gphc_number": {required: "The GPHC number field is required."},

            }
       });
   })(jQuery, window, document);
</script>
<?php $this->load->view('layout/footer'); ?>

