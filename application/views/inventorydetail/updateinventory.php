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
              Update inventory
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
                            <h3 class="box-title">Update Inventory <?php //echo $this->session->userdata('inventoryid'); ?></h3>
                            <span class="pull-right">
                              <a href="<?= base_url('inventorydetail'); ?>" class="btn btn-block btn-primary">Back</a>
                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box box-primary">
                          <div class="row">
                             <form method="POST" id="formupdatesupplier" action="<?= base_url('inventorydetail/updateinventory'); ?>" enctype="multipart/form-data">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Product category <span class="error">*</span></label>
                                       <select name="product_category" id="product_category" class="form-control select2" style="width: 100%;">
                                        <option>Select a category</option>
                                         <?php if(!empty($inventorycategory)){
                                              foreach ($inventorycategory as $value) { ?>
                                             <option value="<?php echo $value->id; ?>" 
                                               <?php echo set_select('product_category', $value->id); ?> 
                                              <?php if(!empty($inventorydata) && $inventorydata->product_category == $value->id){ echo "Selected"; } ?> >
                                              <?php echo $value->category_name; ?></option>
                                          <?php } } ?>
                                      </select>
                                       <?= form_error('product_category') ?>
                                  </div>
                                  <div class="form-group">
                                    <label>Product Name <span class="error">*</span></label>
                                      <input type="text" class="form-control" name="product_name" id="product_name" value="<?php if(!empty($inventorydata)){ echo $inventorydata->product_name;} ?>">
                                       <?= form_error('product_name') ?>
                                  </div>
                                  <div class="form-group">
                                    <label>PIP Code</label>
                                     <input type="text" class="form-control" name="product_sku" id="product_sku" value="<?php if(!empty($inventorydata)){ echo $inventorydata->product_sku;} ?>">
                                  </div>

                                  <!-- <div class="form-group">
                                    <label>Product size <span class="error">*</span></label>
                                     <input type="text" class="form-control" name="product_size" id="product_size" value="<?php if(!empty($inventorydata)){ echo $inventorydata->product_size;} ?>">
                                     
                                  </div> -->

                                  <div class="form-group">
                                    <label>Quantity <span class="error">*</span></label>
                                     <input type="text" class="form-control" name="quantity" id="quantity" value="<?php if(!empty($inventorydata)){ echo $inventorydata->quantity;} ?>">
                                      <?= form_error('quantity') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Price <span class="error">*</span></label>
                                     <input type="text" class="form-control" name="price" id="price" value="<?php if(!empty($inventorydata)){ echo $inventorydata->price;} ?>">
                                      <?= form_error('price') ?>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Customer <span class="error">*</span></label>
                                      <select name="supplier_id" id="supplier_id" class="form-control select2" style="width: 100%;">
                                        <option>Select a Customer</option>
                                        <?php if(!empty($suppliers)){
                                              foreach ($suppliers as $value) { ?>
                                                  <option value="<?php echo $value->id; ?>" 
                                                    <?php echo set_select('supplier_id', $value->id); ?> 
                                                    <?php if(!empty($inventorydata) && $inventorydata->supplier_id == $value->id){ echo "Selected"; } ?>>
                                                    <?php echo $value->first_name.' '.$value->last_name; ?>
                                                  </option>
                                        <?php } } ?>                                        
                                      </select>
                                      <?= form_error('supplier_id') ?>
                                  </div>

                                   <div class="form-group">
                                    <label>Storage <span class="error">*</span></label>
                                       <select name="storage" id="storage" class="form-control select2" style="width: 100%;">
                                        <option>Select a storage</option>
                                          <option value="1" <?php echo set_select("storage", "1"); ?>
                                          <?php if(!empty($inventorydata) && $inventorydata->storage == "1"){ echo "Selected"; } ?>  >Fridge</option>

                                          <option value="2" <?php echo set_select("storage", "2"); ?>
                                           <?php if(!empty($inventorydata) && $inventorydata->storage == "2"){ echo "Selected"; } ?> >Ambient</option>
                                      </select>
                                      <?= form_error('storage') ?>
                                  </div>

                                  <div class="form-group">
                                    <label>Batch number</label>
                                     <input type="text" class="form-control" onkeypress="return isNumber(event)" name="batch_number" id="batch_number" value="<?php if(!empty($inventorydata)){ echo $inventorydata->batch_number;} ?>">
                                  </div>

                                  <div class="form-group">
                                    <label>Pack size <span class="error">*</span></label>
                                     <input type="text" class="form-control" onkeypress="return isNumber(event)" name="pack_size" id="pack_size" value="<?php if(!empty($inventorydata)){ echo $inventorydata->pack_size;} ?>">
                                       <?= form_error('pack_size') ?>
                                  </div>

                                  <div class="form-group">
                                    <div class="form-group">
                                      <label>Entry date </label>
                                        <div class="input-group date">
                                        <div class="input-group-addon">
                                          <i class="fa fa-calendar"></i>
                                        </div>
                                      <input type="text" class="form-control pull-right" id="entry_date" readonly name="entry_date" value="<?php if(!empty($inventorydata)){ echo $inventorydata->created_date;} ?>">
                                      </div>
                                  </div>

                                  <label>Expiry date <span class="error">*</span></label>
                                    <div class="input-group date">
                                      <div class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                      </div>
                                      <input type="text" class="form-control pull-right" name="expiry_date" id="expiry_date" value="<?php if(!empty($inventorydata)){ echo $inventorydata->expiry_date;} ?>">
                                    </div>
                                    <?= form_error('expiry_date') ?>
                                  </div>

                                    <div class="form-group">
                                      <label>Sell or not</label>
                                       <textarea class="form-control" name="note" id="note" rows="2"  >
                                      <?php if(!empty($inventorydata)){ echo $inventorydata->note; } ?>
                                          
                                        </textarea>
                                       <!-- <select name="sell_or_not" id="sell_or_not" class="form-control select2" style="width: 100%;">
                                        <option value="1" 
                                         <?php echo set_select('sell_or_not', '1'); ?>
                                         <?php if(!empty($inventorydata) && $inventorydata->is_active == "1"){ echo "Selected"; } ?>>Yes</option>
                                        <option value="0" 
                                         <?php echo set_select('sell_or_not', '0'); ?>
                                        <?php if(!empty($inventorydata) && $inventorydata->is_active == "0"){ echo "Selected"; } ?>>No</option>
                                      </select> -->
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
                                          <input type="hidden" name="inventoryid" value="<?php if(!empty($inventorydata)){ echo $inventorydata->id;} ?>">
                                          <button type="submit" name="updateinventory" value="updateinventory" id="updateinventory" class="btn btn-block btn-primary">Update</button>
                                        </div>
                                        <div class="col-md-1">
                                          <a href="<?= base_url('inventorydetail'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                        </div>
                                     <?php } } } ?>
                                     <!-- admin permission -->
                                     <?php if($roll == "0"){ ?>
                                        <div class="col-md-1">
                                          <input type="hidden" name="inventoryid" value="<?php if(!empty($inventorydata)){ echo $inventorydata->id;} ?>">
                                          <button type="submit" name="updateinventory" value="updateinventory" id="updateinventory" class="btn btn-block btn-primary">Update</button>
                                        </div>
                                        <div class="col-md-1">
                                          <a href="<?= base_url('inventorydetail'); ?>" class="btn btn-block btn-danger">Cancel</a>
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
    $('#expiry_date').datepicker({
      autoclose: true,
      format: 'dd-mm-yyyy'
    })
   });

   //add user form validation
   /* ;(function($, window, document, undefined) {
          $("#formupdatesupplier").validate({
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

