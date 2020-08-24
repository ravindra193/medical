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
            <li class="active">Customer</li>
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
                                  
                            ?>
                            <!--  <button type="button" class="btn btn-block btn-primary ">Add User</button> -->
                            <a href="<?= base_url('supplierdetail/addsupplier'); ?>" class="btn btn-block btn-primary">Add Customer</a>
                        </span>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <div class="table-responsive">
                            <table id="table_id" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email id</th>
                                        <th>Mobile no</th>
                                        <th>Address</th> 
                                        <th>created</th> 
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($supplierdetail)) {
                                        foreach ($supplierdetail as $data) {
                                            if($data['user_id'] == $loginid ||  $roll == "0"){
                                            ?>
                                            <tr>
                                                <td><a href="<?= base_url(); ?>supplierdetail/update_supplier/<?= $data['id']; ?>/view"><?php echo $data['first_name'] . " " . $data['last_name']; ?></a></td>
                                                <td><?= $data['email'] ?> </td>
                                                <td><?= $data['mobile_no'] ?></td>
                                                <td><?= $data['invoice_address'] ?></td>
                                                <td><?= $data['created'] ?></td>
                                                <td>
                                                    <a  href="javascript:void(0);" onclick="delete_supplier(id)" id="<?php echo $data['id']; ?>"  class="btn btn-danger btn-xs" data-title="Delete" data-placement="top" data-toggle="tooltip" title="Delete"><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                    <a href="<?= base_url(); ?>supplierdetail/update_supplier/<?= $data['id']; ?>" class="btn btn-info btn-xs"  data-placement="top" title="Edit"><i class="fa fa-pencil-square-o"></i></a>
                                                </td>
                                            </tr>
                                            <?php
                                            }
                                        }
                                    }
                                    ?>
                                </tbody>
                               <!--  <tfoot>
                                <tr>
                                  <th>Name</th>
                                  <th>Email id</th>
                                  <th>Mobile no</th>
                                  <th>Address</th> 
                                  <th>created</th> 
                                  <th>Action</th>
                                </tr>
                                </tfoot> -->
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
    function delete_supplier(id)
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
        }, function (isConfirm) {
            if (isConfirm) {
                //$('.page-loader').show();
                $.ajax({
                    url: '<?= base_url(); ?>supplierdetail/delete_supplier',
                    type: 'POST',
                    data: {id: id},
                    success: function (data)
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