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
              Add Inventory
              <small>Inventory Form</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Inventory Form</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add Inventory</h3>
                            <span class="pull-right">
                              <a href="<?= base_url('inventorydetail'); ?>" class="btn btn-block btn-primary">Back</a>
                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box box-primary">
                          <div class="row">
                             <form method="POST" id="formadduser" action="<?= base_url('inventorydetail/addinventory'); ?>" enctype="multipart/form-data">
                                
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Product category <span class="error">*</span></label>
                                        <select name="product_category" id="product_category" class="form-control select2" style="width: 100%;">
                                        <option>Select a category</option>
                                          <?php if(!empty($inventorycategory)){
                                              foreach ($inventorycategory as $value) { ?>
                                                 <option value="<?php echo $value->id; ?>" 
                                                  <?php echo set_select('product_category', $value->id); ?> >
                                                  <?php echo $value->category_name; ?></option>
                                          <?php }} ?>
                                      </select>
                                       <?= form_error('product_category') ?>
                                  </div>
                                  <div class="form-group">
                                    <label>Product Name <span class="error">*</span></label>
                                      <input type="text" class="form-control" name="product_name" id="product_name" value="<?= set_value('product_name') ?>">
                                       <?= form_error('product_name') ?>
                                  </div>
                                  <div class="form-group">
                                    <label>PIP Code</label>
                                     <input type="text" class="form-control" name="product_sku" id="product_sku" value="<?= set_value('product_sku') ?>">
                                  </div>

                                  <!-- <div class="form-group">
                                    <label>Product size <span class="error">*</span></label>
                                     <input type="text" class="form-control" name="product_size" id="product_size" value="<?= set_value('product_size') ?>">
                                      <?= form_error('product_size') ?>
                                  </div> -->

                                  <div class="form-group">
                                    <label>Quantity <span class="error">*</span></label>
                                     <input type="text" class="form-control" onkeypress="return isNumber(event)" name="quantity" id="quantity" value="<?= set_value('quantity') ?>">
                                      <?= form_error('quantity') ?>
                                  </div>

                                   <div class="form-group">
                                    <label>Price <span class="error">*</span></label>
                                     <input type="text" class="form-control" name="price" onkeypress="return isNumber(event)" id="price" value="<?= set_value('price') ?>">
                                      <?= form_error('price') ?>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Customer <span class="error">*</span></label>
                                       <select name="supplier_id" id="supplier_id" class="form-control select2" style="width: 100%;">
                                        <option>Select a customer</option>
                                        <?php if(!empty($suppliers)){
                                              foreach ($suppliers as $value) { ?>
                                                  <option value="<?php echo $value->id; ?>" 
                                                    <?php echo set_select('supplier_id', $value->id); ?> >
                                                    <?php echo $value->first_name.' '.$value->last_name; ?>
                                                  </option>
                                        <?php } } ?>                                        
                                      </select>
                                      <?= form_error('supplier_id') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Storage <span class="error">*</span></label>
                                       <select name="storage" id="storage" class="form-control select2"  style="width: 100%;">
                                        <option>Select a storage</option>
                                          <option value="1" <?php echo set_select('storage', '1'); ?>>Fridge</option>
                                          <option value="2" <?php echo set_select('storage', '2'); ?>>Ambient</option>
                                      </select>
                                      <?= form_error('storage') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Batch number </label>
                                     <input type="text" class="form-control" onkeypress="return isNumber(event)" name="batch_number" id="batch_number" value="<?= set_value('batch_number') ?>">
                                  </div>

                                  <div class="form-group">
                                    <label>Pack size <span class="error">*</span></label>
                                     <input type="text" class="form-control" onkeypress="return isNumber(event)" name="pack_size" id="pack_size" value="<?= set_value('pack_size') ?>">
                                       <?= form_error('pack_size') ?>
                                  </div>
                                
                                  <div class="form-group">
                                  <label>Expiry date <span class="error">*</span></label>
                                   <!--  <input type="text" class="form-control" name="expiry_date" id="expiry_date" value=""> -->
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="expiry_date" id="expiry_date" value="<?= set_value('expiry_date') ?>">
                                    </div>
                                    <?= form_error('expiry_date') ?>
                                  </div>

                                  <div class="form-group">
                                      <label>Note </label>
                                       <textarea class="form-control" name="note" id="note" rows="2"  ><?= set_value('note') ?></textarea>
                                  </div>

                                   <!--  <div class="form-group">
                                      <label>Sell or not </label>
                                       <select name="sell_or_not" id="sell_or_not" class="form-control select2" style="width: 100%;">
                                        <option value="1" <?php echo set_select('sell_or_not', '1'); ?>>Yes</option>
                                        <option value="0" <?php echo set_select('sell_or_not', '0'); ?>>No</option>
                                      </select>
                                    </div> -->
                              </div>

                              <div class="col-md-12">
                                <div class="col-md-1">
                                  <button type="submit" name="addinventory" value="addinventory" id="addinventory" class="btn btn-block btn-primary">Save</button>
                                </div>
                                 <div class="col-md-1">
                                  <a href="<?= base_url('inventorydetail'); ?>" class="btn btn-block btn-danger">Cancel</a>
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

    //Date picker
    $('#expiry_date').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })
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

