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
              Inventory category
              <small>Category List</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Inventory category</li>
          </ol>
      </section>
      <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Category Data Table</h3>
                            <span class="pull-right">
                              <?php 
                              //user permission
                                $roll = $this->session->userdata('roll');
                                $loginid = $this->session->userdata('login_id');
                                $permi_user_id = $this->session->userdata('permi_user_id');  
                                // match 
                                if(!empty($inventory_permi)){ 
                                  $in_cat =  $inventory_permi->permissions;
                                   if(!empty($in_cat)){
                                   $cat_per = explode(",",$in_cat);
                                  }
                                }
                                 if(!empty($cat_per)){
                                   foreach($cat_per as $value){
                                  if($value == "edit"){ ?>
                                    <a href="#" data-toggle="modal" data-target="#addcategory" class="btn btn-block btn-primary">Add Category</a>
                                 <?php } } } ?>

                                 <?php
                                  //admin access
                                  if($roll == "0"){ ?> 
                                      <a href="#" data-toggle="modal" data-target="#addcategory" class="btn btn-block btn-primary">Add Category</a>
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
                                  <th>Category Name</th> 
                                  <th>Created date</th>
                                  <th>Updated date</th>
                                  <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php if(!empty($inventorycategory)){ 
                                      foreach($inventorycategory as $data){
                                    ?>
                                    <tr>
                                      <td><?= $data['id'] ?> </td>
                                      <td><?= $data['category_name'] ?></td>
                                      <td><?= $data['created_date'] ?></td>
                                       <td><?= $data['updated_date'] ?></td>
                                      <td>
                                        <?php if(!empty($cat_per)){
                                           foreach($cat_per as $value){ 
                                            //user delete permission
                                             if($value == "delete"){ ?>
                                                <a  href="javascript:void(0);" onclick="delete_inventory_category(id)" id="<?php echo $data['id']; ?>"  class="btn btn-danger btn-xs" data-title="Delete" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                            <?php }
                                            //edit permission
                                            if($value == "edit"){ ?>
                                              <a href="#"  data-toggle="modal" data-target="#editcategory<?php echo $data['id']; ?>" class="btn btn-info btn-xs"  data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 
                                           <?php }
                                          } } ?>

                                         <?php //admin delete, edit permission 
                                          if($roll == "0"){ ?>
                                            <a  href="javascript:void(0);" onclick="delete_inventory_category(id)" id="<?php echo $data['id']; ?>"  class="btn btn-danger btn-xs" data-title="Delete" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>

                                             <a href="#"  data-toggle="modal" data-target="#editcategory<?php echo $data['id']; ?>" class="btn btn-info btn-xs"  data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a> 
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
<!-- add category model -->

    <div class="modal fade" id="addcategory">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Add inventory category</h4>
          </div>
          <div class="modal-body">
            <p>
               <form method="POST" id="forminventorycategory" action="<?= base_url('inventorycategory/addinventorycategory'); ?>" enctype="multipart/form-data">
                 <div class="form-group">
                  <label>Category name</label>
                    <input type="text" class="form-control" name="category_name" id="category_name" value="<?= set_value('category_name') ?>">
                </div>
                <button type="submit" name="addinventorycategory" value="addinventorycategory" class="btn btn-primary">Save</button>
              </form>
            </p>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


<!-- edit category -->
 <?php if(!empty($inventorycategory)){ 
        foreach($inventorycategory as $data){
      ?>
        <div class="modal fade" id="editcategory<?php echo $data['id']; ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Update inventory category</h4>
              </div>
              <div class="modal-body">
                <p>
                   <form method="POST" id="formupdatecategory" action="<?= base_url('inventorycategory/update_inventory_category'); ?>" enctype="multipart/form-data">
                     <div class="form-group">
                      <label>Category name</label>
                        <input type="text" class="form-control" name="category_name" id="category_name" value="<?php echo $data['category_name']; ?>">
                    </div>
                    <input type="hidden" name="category_id" value="<?php echo $data['id']; ?>">
                    <button type="submit" name="updateinventorycategory" value="updateinventorycategory" class="btn btn-primary">Update</button>
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
  function delete_inventory_category(id) 
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
           url: '<?=base_url();?>inventorycategory/delete_inventory_category',
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
    ;(function($, window, document, undefined) {
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

       $("#formupdatecategory").validate({
            errorClass: 'error',
            errorElement: 'span',
            rules: {
                "category_name": {required: true},
            },
            messages: {
                "category_name": {required: "Please enter category name."},
            }
       });
   })(jQuery, window, document);

</script>

<?php $this->load->view('layout/footer'); ?>