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
              Update supplier bankdetail
              <small>inventory Form</small>
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
                            <h3 class="box-title">Update supplier bankdetail <?php //echo $this->session->userdata('inventoryid'); ?></h3>
                            <span class="pull-right">
                              <a href="<?= base_url('supplierbankdetail'); ?>" class="btn btn-block btn-primary">Back</a>
                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box box-primary">
                          <div class="row">
                             <form method="POST" id="formupdatesupplierbank" action="<?= base_url('supplierbankdetail/updatesupplierbankdetail'); ?>" enctype="multipart/form-data">

                                 <div class="col-md-6">
                                   <div class="form-group">
                                    <label>Supplier name</label>
                                      <select name="supplier_id" id="supplier_id" class="form-control select2" style="width: 100%;">
                                        <option>Select a supplier</option>
                                        <?php if(!empty($suppliers)){
                                              foreach ($suppliers as $value) { ?>
                                                  <option value="<?php echo $value->id; ?>" 
                                                    <?php if(!empty($supplierbankdatadata) && $supplierbankdatadata->supplier_id == $value->id){ echo "Selected"; } ?>>
                                                    <?php echo $value->first_name.' '.$value->last_name; ?>
                                                  </option>
                                        <?php } } ?>                                        
                                      </select>
                                       <?= form_error('supplier_id') ?>
                                  </div>
                                 
                                  <div class="form-group">
                                    <label>Sort code</label>
                                      <input type="text" class="form-control" name="sort_code" id="sort_code" value="<?php if(!empty($supplierbankdatadata)){ echo $supplierbankdatadata->sort_code;} ?>">
                                       <?= form_error('sort_code') ?>
                                  </div>
                                  <div class="form-group">
                                    <label>Account number</label>
                                     <input type="text" class="form-control" onkeypress="return isNumber(event)" name="account_number" id="account_number" value="<?php if(!empty($supplierbankdatadata)){ echo $supplierbankdatadata->account_number;} ?>">
                                     <?= form_error('account_number') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Bank name</label>
                                     <input type="text" class="form-control"  name="bank_name" id="bank_name" value="<?php if(!empty($supplierbankdatadata)){ echo $supplierbankdatadata->bank_name;} ?>">
                                     <?= form_error('bank_name') ?>
                                  </div>

                                   <div class="form-group">
                                    <label>Bank Branch</label>
                                     <input type="text" class="form-control" name="bank_branch" id="bank_branch" value="<?php if(!empty($supplierbankdatadata)){ echo $supplierbankdatadata->bank_branch;} ?>">
                                      <?= form_error('bank_branch') ?>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Trade references 1</label>
                                        <input type="text" class="form-control" name="trade_references_1" id="trade_references_1" value="<?php if(!empty($supplierbankdatadata)){ echo $supplierbankdatadata->trade_references_1;} ?>">
                                        <?= form_error('trade_references_1') ?>
                                  </div>

                                
                                    <div class="form-group">
                                       <label>Trade references 2</label>
                                        <input type="text" class="form-control" name="trade_references_2" id="trade_references_2" value="<?php if(!empty($supplierbankdatadata)){ echo $supplierbankdatadata->trade_references_2;} ?>">
                                      </div>

                                 
                                    <div class="form-group">
                                       <label>Invoice address</label>
                                        <input type="text" class="form-control" name="invoice_address" id="invoice_address" value="<?php if(!empty($supplierbankdatadata)){ echo $supplierbankdatadata->invoice_address;} ?>">
                                          <?= form_error('invoice_address') ?>
                                      </div>
                                 
                                    <div class="form-group">
                                       <label>Delivery address</label>
                                        <input type="text" class="form-control" name="delivery_address" id="delivery_address" value="<?php if(!empty($supplierbankdatadata)){ echo $supplierbankdatadata->delivery_address;} ?>">
                                         <?= form_error('delivery_address') ?>
                                    </div>
                                
                                    <div class="form-group">
                                       <label>GPHC number</label>
                                        <input type="text" class="form-control" name="gphc_number" id="gphc_number" value="<?php if(!empty($supplierbankdatadata)){ echo $supplierbankdatadata->gphc_number;} ?>">
                                           <?= form_error('gphc_number') ?>
                                     </div>
                              </div>

                                <div class="col-md-12">
                                    <?php 
                                      //user permission
                                      $roll = $this->session->userdata('roll');
                                      $loginid = $this->session->userdata('login_id');
                                      $permi_user_id = $this->session->userdata('permi_user_id');  

                                     if(!empty($inventory_permi)){ 
                                      $in =  $inventory_permi->permissions;
                                       if(!empty($in)){
                                         $in_per = explode(",",$in);
                                      }
                                    }
                                     // match 
                                     if(!empty($in_per)){
                                       foreach($in_per as $value){
                                      if($value == "edit"){ ?>
                                        <div class="col-md-1">
                                          <input type="hidden" name="supplier_bankid" value="<?php if(!empty($supplierbankdatadata)){ echo $supplierbankdatadata->id;} ?>">
                                          <button type="submit" name="updatesupplierbankdetail" value="updatesupplierbankdetail" id="updatesupplierbankdetail" class="btn btn-block btn-primary">Update</button>
                                        </div>
                                        <div class="col-md-1">
                                          <a href="<?= base_url('supplierbankdetail'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                        </div>
                                     <?php } } } ?>
                                     <!-- admin permission -->
                                     <?php if($roll == "0"){ ?>
                                        <div class="col-md-1">
                                          <input type="hidden" name="supplier_bankid" value="<?php if(!empty($supplierbankdatadata)){ echo $supplierbankdatadata->id;} ?>">
                                          <button type="submit" name="updatesupplierbankdetail" value="updatesupplierbankdetail" id="updatesupplierbankdetail" class="btn btn-block btn-primary">Update</button>
                                        </div>
                                        <div class="col-md-1">
                                          <a href="<?= base_url('supplierbankdetail'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                        </div>
                                     <?php } ?>
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

    //Date picker
  /*  $('#expiry_date').datepicker({
      autoclose: true
    })*/
   });

   //add user form validation
  /*  ;(function($, window, document, undefined) {
          $("#formupdatesupplierbank").validate({
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
   })(jQuery, window, document);*/
</script>
<?php $this->load->view('layout/footer'); ?>

