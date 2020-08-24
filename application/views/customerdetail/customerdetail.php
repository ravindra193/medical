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
              Customer 
              <small>Customer List</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Customers</li>
          </ol>
      </section>
      <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Customer Data Table</h3>
                            <span class="pull-right">
                              <?php 
                              //user permission
                                $roll = $this->session->userdata('roll');
                                $loginid = $this->session->userdata('login_id');
                                $permi_user_id = $this->session->userdata('permi_user_id');  
                               ?>

                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="table-responsive">
                              <table id="table_id" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                  <th>Bill number</th>
                                  <th>Customer name</th> 
                                  <th>Mobile no</th>
                                  <th>Address</th>
                                  <th>Created date</th>
                                  <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php if(!empty($customerdetil)){ 
                                      foreach($customerdetil as $data){
                                    ?>
                                    <tr>
                                      <td><?= $data['bill_number'] ?> </td>
                                      <td><?= $data['customer_name'] ?></td>
                                      <td><?= $data['customer_mobile'] ?></td>
                                       <td><?= $data['address'] ?></td>
                                       <td><?= $data['created_date'] ?></td>
                                      <td>
                                       <!--  <?php if(!empty($permission) && $permi_user_id == $loginid){
                                           foreach($permission as $value){ 
                                            //user delete permission
                                             if($value == "delete_inventory_category"){ ?>
                                                <a  href="javascript:void(0);" onclick="delete_customer(id)" id="<?php echo $data['id']; ?>"  class="btn btn-danger btn-xs" data-title="Delete" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            <?php }
                                            //edit permission
                                            if($value == "update_inventory_category"){ ?>
                                              <a href="#"  data-toggle="modal" data-target="#editcategory<?php echo $data['id']; ?>" class="btn btn-info btn-xs"  data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 
                                           <?php }
                                          } } ?>
 -->
                                         <?php //admin delete, edit permission 
                                          if($roll == "0"){ ?>
                                            <a  href="javascript:void(0);" onclick="delete_customer(id)" id="<?php echo $data['id']; ?>"  class="btn btn-danger btn-xs" data-title="Delete" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                           <!--   <a href="#"  data-toggle="modal" data-target="#editcategory<?php echo $data['id']; ?>" class="btn btn-info btn-xs"  data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a>  -->
                                          <?php } ?> 
 
                                      </td>
                                    </tr>
                                  <?php } } ?>
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
   //delete user
  function delete_customer(id) 
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
           url: '<?=base_url();?>customerdetail/delete_customer',
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

     //add category of inventory form validation
   /* ;(function($, window, document, undefined) {
          $("#forminventorycategory").validate({
            errorClass: 'error',
            errorElement: 'span',
            rules: {
                "category_name": {required: true},
            },
            messages: {
                "category_name": {required: "Please enter category name."},
            }
       });
*/
  

</script>

<?php $this->load->view('layout/footer'); ?>