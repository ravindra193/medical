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
              User Permissions
              <small>Permissions List</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Permissions name</li>
          </ol>
      </section>
      <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Permissions Data Table</h3>
                            <span class="pull-right">
                              <?php 
                                $loginid = $this->session->userdata('login_id');
                                $permi_user_id = $this->session->userdata('permi_user_id');  
                                if(!empty($permission) && $permi_user_id == $loginid){
                                   foreach($permission as $value){
                                    if($value == "add_inventory_category"){ ?>
                                      <a href="#" data-toggle="modal" data-target="#addpermissions" class="btn btn-block btn-primary">Add Permission</a>
                                   <?php } } }else{ ?> 
                                      <a href="#" data-toggle="modal" data-target="#addpermissions" class="btn btn-block btn-primary">Add Permission</a>
                                   <?php } ?>
                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="table-responsive">
                              <table id="table_id" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                  <th>Id</th>
                                  <th>Permission Name</th> 
                                  <th>Created date</th>
                                  <th>Updated date</th>
                                  <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php if(!empty($permissions_list)){ 
                                      foreach($permissions_list as $data){
                                    ?>
                                    <tr>
                                      <td><?= $data['id'] ?> </td>
                                      <td><?php  
                                         echo str_replace('_', ' ', $data['permissions_name']);
                                        ?>
                                      </td>
                                      <td><?= $data['created_date'] ?></td>
                                       <td><?= $data['updated_date'] ?></td>
                                      <td>
                                        <a  href="javascript:void(0);" onclick="delete_permission(id)" id="<?php echo $data['id']; ?>"  class="btn btn-danger btn-xs" data-title="Delete" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                        <a href="#"  data-toggle="modal" data-target="#editpermissions<?php echo $data['id']; ?>" class="btn btn-info btn-xs"  data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 
 
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
<!-- add permissions_list model -->

    <div class="modal fade" id="addpermissions">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add Permissions</h4>
          </div>
          <div class="modal-body">
            <p>
               <form method="POST" id="formaddpermissions" action="<?= base_url('userpermissionslist/addpermission'); ?>" enctype="multipart/form-data">
                 <div class="form-group">
                  <label>Permissions name</label>
                    <input type="text" class="form-control" name="permissions_name" id="permissions_name" value="<?= set_value('permissions_name') ?>">
                </div>
                <button type="submit" name="addpermissions" value="addpermissions" class="btn btn-primary">Save</button>
              </form>
            </p>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


<!-- edit permissions_list -->
 <?php if(!empty($permissions_list)){ 
        foreach($permissions_list as $data){
      ?>
        <div class="modal fade" id="editpermissions<?php echo $data['id']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update Permissions</h4>
              </div>
              <div class="modal-body">
                <p>
                   <form method="POST" id="formupdatepermissions" action="<?= base_url('userpermissionslist/updatepermissions'); ?>" enctype="multipart/form-data">
                     <div class="form-group">
                      <label>Permissions name</label>
                        <input type="text" class="form-control" name="permissions_name" id="permissions_name" value="<?php echo str_replace('_', ' ', $data['permissions_name']); ?>">
                    </div>
                    <input type="hidden" name="permissions_id" value="<?php echo $data['id']; ?>">
                    <button type="submit" name="updatepermissions" value="updatepermissions" class="btn btn-primary">Update</button>
                  </form>
                </p>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
<?php } } ?>


<script type="text/javascript">
   //delete user
  function delete_permission(id) 
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
           url: '<?=base_url();?>userpermissionslist/delete_permission',
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

     //add permissions form validation
    ;(function($, window, document, undefined) {
          $("#formaddpermissions").validate({
            errorClass: 'error',
            errorElement: 'span',
            rules: {
                "permissions_name": {required: true},
            },
            messages: {
                "permissions_name": {required: "Please enter permissions name."},
            }
       });

       $("#formupdatepermissions").validate({
            errorClass: 'error',
            errorElement: 'span',
            rules: {
                "permissions_name": {required: true},
            },
            messages: {
                "permissions_name": {required: "Please enter permissions name."},
            }
       });
   })(jQuery, window, document);

</script>

<?php $this->load->view('layout/footer'); ?>