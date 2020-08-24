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
   <!--  <?php if ($msg = $this->session->flashdata('Msg')) { ?>
    <script>
        $(document).ready(function () {
            Notification('<?= $this->session->flashdata('Msg_class'); ?>', '<?= $msg ?>', '<?= $this->session->flashdata('Msg_class'); ?>');
        });
    </script>
  <?php } ?> -->
      <section class="content-header">
          <h1>
              Dashboard <?php //echo $permi_user_id = $this->session->userdata('permi_user_id'); ?>
              
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Dashboard</li>
          </ol>
      </section>

      <!-- Main content -->
      <section class="content">
          <!-- Small boxes (Stat box) -->
          <div class="row">
              <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                      <div class="inner">
                          <h3><?php if(!empty($numberofuser)){ echo $numberofuser->user; } ?></h3>

                          <p>Users</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-person-add"></i>
                      </div>
                      <a href="<?=base_url('userdetail');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                      <div class="inner">
                          <h3><?php if(!empty($numberofsupplier)){ echo $numberofsupplier->supplier; } ?><sup style="font-size: 20px"></sup></h3>

                          <p>Suppliers</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-stats-bars"></i>
                      </div>
                      <a href="<?=base_url('supplierdetail');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                      <div class="inner">
                          <h3><?php if(!empty($numberofcustomer)){ echo $numberofcustomer->customer; } ?></h3>

                          <p>Customers</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-bag"></i>
                      </div>
                      <a href="<?=base_url('customerdetail');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-red">
                      <div class="inner">
                          <h3><?php if(!empty($totol_sell_count)){ echo $totol_sell_count->totol_sell_count; } ?>£</h3>

                          <p>Total Sell</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="<?=base_url('sellbilldetails');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
               <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-green">
                      <div class="inner">
                        <h3><?php $zz = "0"; if(!empty($your_totol_sell_count)){ echo $your_totol_sell_count->your_totol_sell_count; }else{ echo $zz; } ?>£
                            </h3>

                          <p>Your Total Sell</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-pie-graph"></i>
                      </div>
                      <a href="<?=base_url('sellbilldetails');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                      <div class="inner">
                          <h3><?php if(!empty($your_customer)){ echo $your_customer->your_customer; } ?></h3>

                          <p>Your Customers</p>
                      </div>
                      <div class="icon">
                          <i class="ion ion-bag"></i>
                      </div>
                      <a href="<?=base_url('customerdetail');?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                  </div>
              </div>
              <!-- ./col -->
          </div>
          <!-- /.row -->
      </section>
      <!-- /.content -->
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php $this->load->view('layout/footer'); ?>