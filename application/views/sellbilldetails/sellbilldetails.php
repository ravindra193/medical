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
<?php
 /*  $in_number =  $this->session->userdata('invoice_no');
   if(!empty($in_number)){ ?>

  <?php }*/
 ?>
      <section class="content-header">
          <h1>
              Bill
              <small>Bill</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Bill</li>
          </ol>
      </section>
      <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Bill Data Table</h3>
                            <span class="pull-right">
                               <?php 
                                  //user permission
                                  $roll = $this->session->userdata('roll');
                                  $loginid = $this->session->userdata('login_id');
                                  $permi_user_id = $this->session->userdata('permi_user_id');  
                                ?>
                                 <?php 
                                   // match 
                                    if(!empty($sell_permi)){ 
                                     /* echo "<pre>";
                                      print_r($sell_permi);
                                      die();*/
                                      $sell =  $sell_permi->permissions;
                                       if(!empty($sell)){
                                         $sell_per = explode(",",$sell);
                                      }
                                    }
                                  ?>
                                  <?php
                                   if(!empty($sell_per)){
                                     foreach($sell_per as $value){
                                    if($value == "edit"){ ?>
                                    <a href="<?= base_url('sellbilldetails/makesellbill'); ?>" class="btn btn-block btn-primary">
                                      <i class="fa fa-plus-circle"></i>&nbsp;Make Bill</a>
                                   <?php } } } ?>

                                  <?php if($roll == "0"){ ?>
                                     <a href="<?= base_url('sellbilldetails/makesellbill'); ?>" class="btn btn-block btn-primary">
                                      <i class="fa fa-plus-circle"></i>&nbsp;Make Bill</a>
                                  <?php } ?>
                            </span>

                            <!-- search date wise -->

                            <?php if(!empty($sell_per)){
                                     foreach($sell_per as $value){
                                    if($value == "edit"){ ?>
                                <br><br>
                               <form method="GET" id="formsearch" action="<?= base_url('sellbilldetails'); ?>" >
                                <div class="col-md-12 row">
                                  <div class="col-md-2"> 
                                     <label>Start Date</label>
                                    <input type="text" name="start1" id="start1" class="form-control" value="<?php if(!empty($_GET['start1'])){ echo $_GET['start1']; } ?>" placeholder="Select a start date" id="datewise">
                                  </div>
                                  <div class="col-md-2"> 
                                     <label>End Date</label>
                                    <input type="text" name="end1" id="end1" class="form-control" value="<?php if(!empty($_GET['end1'])){ echo $_GET['end1']; } ?>" placeholder="Select a end date" id="datewise">
                                  </div>
                                  
                                   <div class="col-md-1">
                                      <label></label>
                                    <button type="submit" name="search" value="search" id="search" class="btn btn-block btn-primary">Search</button>
                                  </div>
                                </div>
                              </form>
                            <?php } } } ?>

                             <?php if($roll == "0"){  ?>
                               <br><br>
                               <form method="GET" id="formsearch" action="<?= base_url('sellbilldetails'); ?>" >
                                <div class="col-md-12 row">
                                  <div class="col-md-2"> 
                                     <label>Start Date</label>
                                    <input type="text" name="start1" id="start1" class="form-control" value="<?php if(!empty($_GET['start1'])){ echo $_GET['start1']; } ?>" placeholder="Select a start date" id="datewise">
                                  </div>
                                  <div class="col-md-2"> 
                                     <label>End Date</label>
                                    <input type="text" name="end1" id="end1" class="form-control" value="<?php if(!empty($_GET['end1'])){ echo $_GET['end1']; } ?>" placeholder="Select a end date" id="datewise">
                                  </div>

                                   <div class="col-md-2"> 
                                    <?php if(!empty($_GET['user_id'])){
                                         $user_id =  $_GET['user_id'];
                                       }else{
                                          $user_id = "0";
                                      } ?>
                                    <label>Select a customer </label>
                                     <select class="form-control select2" name="user_id" id="user_id" style="width: 100%;">
                                      <option value="0">Select a customer</option>
                                      <?php  foreach ($userdetail as $value) { ?>
                                      <option value="<?php echo $value['id']; ?>" <?php if($value['id'] == $user_id){ echo "selected"; } ?> ><?php echo $value['first_name'].' '.$value['last_name']; ?></option>
                                      <?php } ?>
                                    </select>
                                  </div>
                                   <div class="col-md-1">
                                      <label></label>
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
                                  <th>User name</th>
                                  <th>Invoice date</th>
                                  <th>Customer name</th>
                                  <th>Invoice no</th> 
                                  <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php if(!empty($tbl_sell_billdetail)){ 
                                      foreach($tbl_sell_billdetail as $data){ 
                                      /*   echo "<pre>";
                                        print_r($data);
                                        die();*/
                                        if($data->user_id == $loginid || $roll == "0"){
                                    ?>
                                    <tr>
                                      <td>
                                        <a href="<?php base_url(); ?>sellbilldetails/invoice/<?php echo $data->invoice_no; ?>/view">
                                          <?= $data->username ?>
                                        </a>
                                      </td>
                                      <td><?= $data->invoice_date ?></td>
                                      <td>
                                        <a href="<?php base_url(); ?>sellbilldetails/invoice/<?php echo $data->invoice_no; ?>/view">
                                        <?= $data->first_name.' '.$data->last_name ?>
                                        </a>
                                      </td>
                                      <td><?= $data->invoice_no ?></td>
                                      <td>
                                         <?php  
                                         //user wise permission
                                        if(!empty($sell_per)){
                                           foreach($sell_per as $value){
                                          if($value == "delete"){ ?>
                                            <a  href="javascript:void(0);" onclick="delete_bill(id)" id="<?php echo $data->invoice_no; ?>"  class="btn btn-danger btn-xs" data-title="Delete" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                         <?php } 
                                          if($value == "view"){ ?>
                                              <a href="<?= base_url('sellbilldetails/invoice/'); ?><?php echo $data->invoice_no; ?>" id="<?php echo $data->invoice_no; ?>"  class="btn btn-info btn-xs"  data-placement="top" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a>  

                                               <a href="<?= base_url(); ?>sellbilldetails/updatesellbill/<?= $data->invoice_no; ?>" class="btn btn-info btn-xs"  data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a>

                                               <a href="#" id="<?php echo $data->invoice_no; ?>"  class="btn btn-primary btn-xs creditenote"  data-toggle="modal" data-target="#myModal"  data-placement="top" title="Credit note"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a> 
                                            <?php } ?>
                                         <?php } } ?>

                                        <?php 
                                          //admin permission
                                          if($roll == "0"){ ?>
                                            <a  href="javascript:void(0);" onclick="delete_bill(id)"  id="<?php echo $data->invoice_no; ?>"  class="btn btn-danger btn-xs" data-title="Delete" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                            <a href="<?= base_url('sellbilldetails/invoice/'); ?><?php echo $data->invoice_no; ?>" id="<?php echo $data->invoice_no; ?>"  class="btn btn-info btn-xs"  data-placement="top" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a> 

                                             <a href="<?= base_url(); ?>sellbilldetails/updatesellbill/<?= $data->invoice_no; ?>" class="btn btn-info btn-xs"  data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 

                                              <a href="#" id="<?php echo $data->invoice_no; ?>"  class="btn btn-primary btn-xs creditenote"  data-toggle="modal" data-target="#myModal"  data-placement="top" title="Credit note"><i class="fa fa-sticky-note-o" aria-hidden="true"></i></a>
                                        <?php } ?> 
 
                                      </td>
                                    </tr>
                                  <?php } } } ?>
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
<!--credite note -->

<div id="myModal" class="modal fade" role="dialog">

</div>

<script type="text/javascript">
   $(function () {
     //Date picker
      $('#date').datepicker({
        format: 'dd-mm-yyyy'
     });

     $('#start1').datepicker({
      format: 'dd-mm-yyyy'
     });

      $('#end1').datepicker({
      format: 'dd-mm-yyyy'
     });
   });
   

  function delete_bill(id) 
  {
    //var pro = $(this).attr('data-pro');
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
           url: '<?=base_url();?>sellbilldetails/delete_bill',
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

  //new tab in open

  //generate bill
  function generat_bill(id) 
  {
    $.ajax({
       url: '<?=base_url();?>sellbilldetails/generat_bil',
        type: 'POST',
        data:{id:id},
        success: function(data)
        {
        //  console.log(data);
       //var win =window.open('./bill.pdf', '_blank');
        var win =  window.open("<?=base_url();?>bill.pdf", "_blank"); 
         win.focus();
        }
    });
    return false;
  }


     // accept request
    $(document).on('click', '.creditenote', function (e) {
        e.preventDefault();
        var id = $(this).attr('id');
        $.ajax({
            url: '<?= base_url(); ?>sellbilldetails/creditnote',
            type: 'POST',
            data: {id: id},
            success: function (result) {
                jQuery('#myModal').html(result);
                jQuery('#myModal').modal('show');
                //location.reload();
            }
        });
    });

       

</script>


<?php $this->load->view('layout/footer'); ?>