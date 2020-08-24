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
              Inventory price average
              <small>Inventory price average list</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Inventory price average</li>
          </ol>
      </section>
      <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Inventory Price Average Data Table</h3>
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
                        </div>


                        <!-- /.box-header -->
                        <div class="box-body">

                          <div class="table-responsive">
                              <table id="table_id" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                  <th>Product Name</th>
                                  <th>Customer Name</th>
                                  <th>PIP Code</th>
                                  <th>Expiry date</th> 
                                  <th>Purchase date</th> 
                                  <th>Quantity</th> 
                                  <th>Price</th> 
                                  <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php if(!empty($tbl_inventory_name_compare)){ 
                                      $total_quantity = "0";
                                      $total_price = "0";
                                      $i = 0;
                                      foreach($tbl_inventory_name_compare as $data){
                                         $i++;
                                       //if($data->user_id == $loginid || $roll == "0"){
                                    ?>
                                    <tr>
                                      <td><?= $data->product_name ?> </td>
                                      <td><?= $data->first_name.' '.$data->last_name ?> </td> 
                                      <td><?= $data->product_sku ?></td>
                                      <td><?= $data->expiry_date ?></td>
                                      <td><?= $data->created_date ?></td>
                                      <td><?= $data->quantity ?></td>
                                       <td><?= $data->price ?></td>
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
                                  <?php 
                                    //total qty
                                    if ($data->quantity) {
                                        $total_quantity += $data->quantity;
                                    } else {
                                        $total_quantity = "0";
                                    }

                                    //price avg
                                    if ($data->price) {
                                        $total_price += $data->price;
                                    } else {
                                        $total_price = "0";
                                    }
                                  ?>

                                  <?php } } //} ?>
                                    <!-- <tr>
                                      <th>sdsdsd</td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <th><?= $total_quantity /  $i ?></th>
                                      <th><?= $total_price / $i ?></th>
                                      <td></td>
                                   </tr> -->
                                 <?php  ?>
                                </tbody>
                                <tr>
                                      <th></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <td></td>
                                      <th>
                                        <?php 
                                         $qty_avg = $total_quantity /  $i;
                                         echo number_format((float)$qty_avg, 2, '.', '');
                                        ?>
                                      </th>
                                      <th><?php
                                        $price_avg =  $total_price / $i;
                                        echo number_format((float)$price_avg, 2, '.', '');
                                       ?></th>
                                      <td></td>
                                </tr>
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