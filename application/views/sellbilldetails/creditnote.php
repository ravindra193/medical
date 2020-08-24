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
              Add credit note
              <small>credit note Form</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">credit note Form</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add credit note</h3>
                            <span class="pull-right">
                              <a href="<?= base_url('sellbilldetails'); ?>" class="btn btn-block btn-primary">Back</a>
                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box box-primary">
                          <?php /*echo "<pre>";
                          print_r($invoiceItem);*/
                           ?>
                          <div class="row">
                             <form method="POST" id="formadduser" action="<?= base_url('sellbilldetails/creditnote'); ?>" enctype="multipart/form-data">
                                
                                <div class="col-md-6">
                                  <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Product Name</label><br> 
                                        <?php 
                                        if(!empty($invoiceItem)){
                                        foreach ($invoiceItem as $value) { ?>
                                          <p><?php echo $value->product_name; ?></p> 
                                        <?php } } ?>
                                         
                                      </div>
                                  </div>
                                   <div class="col-md-6">
                                      <div class="form-group">
                                        <label>Quantity</label><br> 
                                        <?php
                                          if(!empty($invoiceItem)){
                                          foreach ($invoiceItem as $value) { ?>
                                             <p><?php echo $value->qty; ?></p> 
                                        <?php } } ?>          
                                     </div>
                                  </div>

                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Note </label>
                                       <textarea class="form-control" name="note" id="note" rows="4"  ><?= set_value('note') ?></textarea>
                                  </div>

                              </div>

                              <div class="col-md-12">
                                <div class="col-md-1">
                                  <button type="submit" name="addcreditnote" value="addcreditnote" id="addcreditnote" class="btn btn-block btn-primary">Save</button>
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

