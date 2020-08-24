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
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong><?php echo $this->session->flashdata('Msg'); ?> </strong> 
            </div>
<?php } ?>  

      <section class="content-header">
          <h1>
              Inventory
              <small>Inventory List</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Inventory</li>
          </ol>
      </section>
      <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Inventory Data Table</h3>
                            <span class="pull-right">
                               <?php 
                                  //user permission
                                  $roll = $this->session->userdata('roll');
                                  $loginid = $this->session->userdata('login_id');
                                  $permi_user_id = $this->session->userdata('permi_user_id');  

                                 // match 
                                  if(!empty($inventory_permi)){ 
                                    $inven =  $inventory_permi->permissions;
                                     if(!empty($inven)){
                                       $inven_per = explode(",",$inven);
                                    }
                                  }
                                  // match 
                                   if(!empty($inven_per)){
                                     foreach($inven_per as $value){
                                    if($value == "edit"){ ?>
                                    <a href="<?= base_url('inventorydetail/addinventory'); ?>" class="btn btn-block btn-primary">Add Inventory</a>
                                  <?php } } } ?>

                                  <?php if($roll == "0"){ ?>
                                     <a href="<?= base_url('inventorydetail/addinventory'); ?>" class="btn btn-block btn-primary">Add Inventory</a>
                                  <?php } ?>
                            </span>
                            <?php //echo $roll; ?>
                            <?php
                              if(!empty($inven_per)){
                                     foreach($inven_per as $value){
                                    if($value == "edit"){ ?>
                               <br><br>
                               <form method="GET" id="formsearch" action="<?= base_url('inventorydetail'); ?>" >
                                <div class="col-md-12 row">
                                  <div class="col-md-2"> 
                                      <label>Supplier Inventory</label>
                                    <?php   
                                    if(!empty($_GET['datewise'])){
                                        $date = $_GET['datewise'];
                                    }
                                    
                                    if(!empty($_GET['supplier_id'])){
                                         $supplier_id =  $_GET['supplier_id'];
                                       }else{
                                          $supplier_id = "0";
                                       }
                                     ?>
                                    <select class="form-control select2" name="supplier_id" id="supplier_id" style="width: 100%;">
                                      <option value="0">Select a Supplier</option>
                                      <?php 
                                      foreach ($suppliers as $value) { ?>
                                      <option value="<?php echo $value->id; ?>" <?php if($value->id == $supplier_id){ echo "selected"; } ?> ><?php echo $value->first_name.' '.$value->last_name; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                
                                   <div class="col-md-2"> 
                                     <label>Start Date</label>
                                    <input type="text" name="start1" id="start1" class="form-control" value="<?php if(!empty($_GET['start1'])){ echo $_GET['start1']; } ?>" placeholder="Select a start date" id="datewise">
                                  </div>
                                  <div class="col-md-2"> 
                                     <label>End Date</label>
                                    <input type="text" name="end1" id="end1" class="form-control" value="<?php if(!empty($_GET['end1'])){ echo $_GET['end1']; } ?>" placeholder="Select a end date" id="datewise">
                                  </div>
                                  
                                   <div class="col-md-1">
                                    <br>
                                    <button type="submit" name="search" value="search" id="search" class="btn btn-block btn-primary">Search</button>
                                  </div>
                                </div>
                              </form>
                            <?php } } } ?>

                              <?php if($roll == "0"){ ?>
                               <br><br>
                               <form method="GET" id="formsearch" action="<?= base_url('inventorydetail'); ?>" >
                                <div class="col-md-12 row">
                                  <div class="col-md-2"> 
                                      <label>Customer Inventory</label>
                                    <?php   
                                    if(!empty($_GET['supplier_id'])){
                                         $supplier_id =  $_GET['supplier_id'];
                                       }else{
                                          $supplier_id = "0";
                                       }
                                     ?>
                                    <select class="form-control select2" name="supplier_id" id="supplier_id" style="width: 100%;">
                                      <option value="0">Select a Customer</option>
                                      <?php 
                                      foreach ($suppliers as $value) { ?>
                                      <option value="<?php echo $value->id; ?>" <?php if($value->id == $supplier_id){ echo "selected"; } ?> ><?php echo $value->first_name.' '.$value->last_name; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                
                                   <div class="col-md-2"> 
                                     <label>Start Date</label>
                                    <input type="text" name="start1" id="start1" class="form-control" value="<?php if(!empty($_GET['start1'])){ echo $_GET['start1']; } ?>" placeholder="Select a start date" id="datewise">
                                  </div>
                                  <div class="col-md-2"> 
                                     <label>End Date</label>
                                    <input type="text" name="end1" id="end1" class="form-control" value="<?php if(!empty($_GET['end1'])){ echo $_GET['end1']; } ?>" placeholder="Select a end date" id="datewise">
                                  </div>
                                  
                                   <div class="col-md-1">
                                    <br>
                                    <button type="submit" name="search" value="search" id="search" class="btn btn-block btn-primary">Search</button>
                                  </div>
                                </div>
                              </form>
                            <?php } ?>

                        </div>


                        <!-- /.box-header -->
                        <div class="box-body">

                          <div class="table-responsive">
                              <table id="table_id" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                   <th>PIP number</th>
                                   <th>Product Name</th>
                                   <th>Pack size</th>
                                   <th>Batch number</th>
                                   <th>Expiry date</th>
                                   <th>Quantity</th> 
                                   <th>Price</th>
                                   <th>Purchase date</th>
                                   <th>Customer Name</th>
                                   <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php if(!empty($inventorydetail)){ 
                                      foreach($inventorydetail as $data){
                                       //if($data->user_id == $loginid || $roll == "0"){
                                    ?>
                                    <tr>
                                      <td><?= $data->product_sku ?></td>
                                      <td>
                                        <a href="<?= base_url('inventorydetail/inventorycompare/'); ?><?php echo $data->id; ?>"> 
                                           <?= $data->product_name ?>
                                        </a> 
                                      </td>
                                      <td><?= $data->pack_size ?></td>
                                      <td><?php if(!empty($data->batch_number)){ echo $data->batch_number; } ?></td>
                                      <td><?= $data->expiry_date ?></td>
                                      <td><?= $data->quantity ?></td>
                                      <td><?= $data->price ?></td>
                                      <td><?= $data->created_date ?></td>
                                      <td><?= $data->first_name.' '.$data->last_name ?> </td> 
                                      <td>
                                        <?php  //delete permission
                                        if(!empty($inven_per)){
                                           foreach($inven_per as $value){
                                          if($value == "delete"){ ?>
                                           <a  href="javascript:void(0);" onclick="delete_inventory(id)" id="<?php echo $data->id; ?>"  class="btn btn-danger btn-xs" data-title="Delete" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                         <?php } 
                                          if($value == "view"){ ?>
                                             <a href="<?= base_url(); ?>inventorydetail/updateinventory/<?= $data->id; ?>" class="btn btn-info btn-xs"  data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 
                                         <?php } } } ?>

                                        <?php if($roll == "0"){ ?>
                                            <a  href="javascript:void(0);" onclick="delete_inventory(id)" id="<?php echo $data->id; ?>"  class="btn btn-danger btn-xs" data-title="Delete" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                            <a href="<?= base_url(); ?>inventorydetail/updateinventory/<?= $data->id; ?>" class="btn btn-info btn-xs"  data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 
                                        <?php } ?>
                                      </td>
                                    </tr>
                                  <?php } } //} ?>
                                </tbody>
                              </table>
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
     //Date picker
      $('#date').datepicker({
        format: 'dd-mm-yyyy'
     });

    //date
     $('#start1').datepicker({
      format: 'dd-mm-yyyy'
     });

      $('#end1').datepicker({
      format: 'dd-mm-yyyy'
     });
   });


/*  $('#date').datepicker({
      autoclose: true,
    })*/
   //delete user
  function delete_inventory(id) 
  {
    swal({   
      title: "Are you sure? you want to delete?",   
      text: "You will not be able to recover this data!",   
      type: "warning",   
      showCancelButton: true,   
      confirmButtonColor: "#DD6B55",   
      confirmButtonText: "Yes, delete it!",   
      cancelButtonText: "No, cancel !",   
      closeOnConfirm: false,   
      closeOnCancel: true 
    }, function(isConfirm){   
      if (isConfirm) {     
         //$('.page-loader').show();
        $.ajax({
           url: '<?=base_url();?>inventorydetail/delete_inventory',
          type: 'POST',
          data: {id:id},
          success: function(data)
          {
            swal({
            title: "Deleted!",
            text: "Supplier deleted successfully.",
            type: "success"
            }, function () {
              window.location.reload();
            });
          }
        });   
      } else {
      return true;      
      } 
    });
  }
</script>

<?php $this->load->view('layout/footer'); ?>