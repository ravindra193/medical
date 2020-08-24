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
              Add supplier bankdetail
              <small>supplier bankde Form</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Supplier bankdetail Form</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add supplier bankdetail</h3>
                            <span class="pull-right">
                              <a href="<?= base_url('supplierbankdetail'); ?>" class="btn btn-block btn-primary">Back</a>
                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box box-primary">
                          <div class="row">
                             <form method="POST" id="formadduser" action="<?= base_url('supplierbankdetail/addsupplierbankdetail'); ?>" enctype="multipart/form-data">
                                
                                <div class="col-md-6">
                                   <div class="form-group">
                                    <label>Supplier name</label>
                                       <select name="supplier_id" id="supplier_id" class="form-control select2" style="width: 100%;">
                                        <option>Select a supplier</option>
                                        <?php if(!empty($suppliers)){
                                              foreach ($suppliers as $value) { ?>
                                                  <option value="<?php echo $value->id; ?>"><?php echo $value->first_name.' '.$value->last_name; ?></option>
                                        <?php } } ?>                                        
                                      </select>
                                      <?= form_error('supplier_id') ?>
                                  </div>
                                 
                                  <div class="form-group">
                                    <label>Sort code</label>
                                      <input type="text" class="form-control" name="sort_code" id="sort_code" value="<?= set_value('sort_code') ?>">
                                       <?= form_error('sort_code') ?>
                                  </div>
                                  <div class="form-group">
                                    <label>Account number</label>
                                     <input type="text" class="form-control" onkeypress="return isNumber(event)" name="account_number" id="account_number" value="<?= set_value('account_number') ?>">
                                      <?= form_error('account_number') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Bank name</label>
                                     <input type="text" class="form-control"  name="bank_name" id="bank_name" value="<?= set_value('bank_name') ?>">
                                      <?= form_error('bank_name') ?>
                                  </div>

                                   <div class="form-group">
                                    <label>Bank Branch</label>
                                     <input type="text" class="form-control" name="bank_branch" id="bank_branch" value="<?= set_value('bank_branch') ?>">
                                      <?= form_error('bank_branch') ?>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Trade references 1</label>
                                        <input type="text" class="form-control" name="trade_references_1" id="trade_references_1" value="<?= set_value('trade_references_1') ?>">
                                      <?= form_error('trade_references_1') ?>
                                  </div>

                                  <div class="form-group">
                                    <div class="form-group">
                                       <label>Trade references 2</label>
                                        <input type="text" class="form-control" name="trade_references_2" id="trade_references_2" value="<?= set_value('trade_references_2') ?>">
                                      <?= form_error('trade_references_2') ?>
                                      </div>
                                    </div>

                                   <div class="form-group">
                                    <div class="form-group">
                                       <label>Invoice address</label>
                                        <input type="text" class="form-control" name="invoice_address" id="invoice_address" value="<?= set_value('invoice_address') ?>">
                                      <?= form_error('invoice_address') ?>
                                      </div>
                                    </div>

                                   <div class="form-group">
                                    <div class="form-group">
                                       <label>Delivery address</label>
                                        <input type="text" class="form-control" name="delivery_address" id="delivery_address" value="<?= set_value('delivery_address') ?>">
                                      <?= form_error('delivery_address') ?>
                                      </div>
                                    </div>

                                     <div class="form-group">
                                    <div class="form-group">
                                       <label>GPHC number</label>
                                        <input type="text" class="form-control" name="gphc_number" id="gphc_number" value="<?= set_value('gphc_number') ?>">
                                      <?= form_error('gphc_number') ?>
                                      </div>
                                    </div>
                              </div>

                              <div class="col-md-12">
                                <div class="col-md-1">
                                  <button type="submit" name="addsupplierbankdetail" value="addsupplierbankdetail" id="addsupplierbankdetail" class="btn btn-block btn-primary">Save</button>
                                </div>
                                 <div class="col-md-1">
                                  <a href="<?= base_url('supplierbankdetail'); ?>" class="btn btn-block btn-danger">Cancel</a>
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

