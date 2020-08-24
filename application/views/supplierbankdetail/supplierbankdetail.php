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
              Supplier bankdetail
              <small> Supplier bankdetail List</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Supplier bankdetail</li>
          </ol>
      </section>
      <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title"> Supplier bankdetail Data Table</h3>
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
                                    <a href="<?= base_url('supplierbankdetail/addsupplierbankdetail'); ?>" class="btn btn-block btn-primary">Add supplier bankdetail</a>
                                  <?php } } } ?>

                                  <?php if($roll == "0"){ ?>
                                     <a href="<?= base_url('supplierbankdetail/addsupplierbankdetail'); ?>" class="btn btn-block btn-primary">Add supplier bankdetail</a>
                                  <?php } ?>
                            </span>
                        
                           

                        </div>


                        <!-- /.box-header -->
                        <div class="box-body">

                          <div class="table-responsive">
                              <table id="table_id" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                  <th>Account number</th>
                                 <th>Supplier Name</th>
                                  <th>Bank name</th>
                                  <th>Invoice address</th> 
                                  <th>Delivery address</th> 
                                  <th>GPHC number</th> 
                                  <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php if(!empty($supplierbankdetail)){ 
                                      foreach($supplierbankdetail as $data){
                                       /* echo "<pre>";
                                        print_r($data);
                                        die();*/
                                       //if($data->user_id == $loginid || $roll == "0"){
                                    ?>
                                    <tr>
                                      <td><?= $data->account_number ?> </td>
                                      <td> <?= $data->first_name.' '.$data->last_name ?></td> 
                                      <td><?= $data->bank_name ?></td>
                                      <td><?= $data->invoice_address ?></td>
                                      <td><?= $data->delivery_address ?></td>
                                      <td><?= $data->gphc_number ?></td>
                                      <td>
                                        <?php  //delete permission
                                        if(!empty($inven_per)){
                                           foreach($inven_per as $value){
                                          if($value == "delete"){ ?>
                                           <a  href="javascript:void(0);" onclick="delete_supplierbankdetail(id)" id="<?php echo $data->id; ?>"  class="btn btn-danger btn-xs" data-title="Delete" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                         <?php } 
                                          if($value == "view"){ ?>
                                             <a href="<?= base_url(); ?>supplierbankdetail/updatesupplierbankdetail/<?= $data->id; ?>" class="btn btn-info btn-xs"  data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 
                                         <?php } } } ?>

                                        <?php if($roll == "0"){ ?>
                                            <a  href="javascript:void(0);" onclick="delete_supplierbankdetail(id)" id="<?php echo $data->id; ?>"  class="btn btn-danger btn-xs" data-title="Delete" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                            <a href="<?= base_url(); ?>supplierbankdetail/updatesupplierbankdetail/<?= $data->id; ?>" class="btn btn-info btn-xs"  data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 
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
   
   });


/*  $('#date').datepicker({
      autoclose: true,
    })*/
   //delete user
  function delete_supplierbankdetail(id) 
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
           url: '<?=base_url();?>supplierbankdetail/delete_supplierbankdetail',
          type: 'POST',
          data: {id:id},
          success: function(data)
          {
            swal({
            title: "Deleted!",
            text: "Data deleted successfully.",
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