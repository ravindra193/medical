    <!-- Left side column. contains the logo and sidebar -->
  
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?= base_url(); ?>assets/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $this->session->userdata('username'); ?></p>
          <!-- Status -->
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
         <?php
            $roll = $this->session->userdata('roll');
            $loginid = $this->session->userdata('login_id');
            $permi_user_id = $this->session->userdata('permi_user_id');
         ?>
      <!-- Sidebar Menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <!-- Optionally, you can add icons to the links -->
          <!-- menu set permission wise -->
           

         <!--  <li class="<?php echo ($this->uri->segment(1) == 'dashboard' ? 'active' : '') ?>">
              <a href="<?=base_url('dashboard');?>">
                  <i class="fa fa-dashboard"></i> <span>Dashboard</span>
              </a>
          </li> -->

        <?php if($roll == "0"){ ?>
          <li class="<?php echo ($this->uri->segment(1) == 'userdetail' ? 'active' : '') ?>">
             <a href="<?=base_url('userdetail');?>">
              <i class="fa fa-users"></i> <span>Users</span>
            </a>
          </li>
           
         <!--  <li class="<?php echo ($this->uri->segment(1) == 'supplierbankdetail' ? 'active' : '') ?>">
            <a href="<?=base_url('supplierbankdetail');?>"><i class="fa fa-university" ></i></i>Supplier Bank Detail</a>
          </li> -->

            <!-- <li class="treeview">
              <a href="#">
                <i class="fa fa-exchange"></i>
                <span>Supplier</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu" style="display: none;">
                <li><a href="<?=base_url('supplierdetail');?>"><i class="fa fa-circle-o"></i>Add Supplier</a></li>
         
              </ul>
           </li> -->
         <?php } ?>
          <li class="<?php echo ($this->uri->segment(1) == 'supplierdetail' ? 'active' : '') ?>">
            <a href="<?=base_url('supplierdetail');?>"><i class="fa fa-exchange"></i>Customer</a>
          </li>

           <?php 
            if(!empty($sell_permi)){ 
              $sell =  $sell_permi->permissions;
               if(!empty($sell)){
               $sell_per = explode(",",$sell);
              }
            }
          
           if(!empty($sell_per) && $roll != "0"){
             foreach($sell_per as $value){
             if($value == 'view'){ ?>
             <li class="<?php echo ($this->uri->segment(1) == 'sellbilldetails' ? 'active' : '') ?>">
               <a href="<?=base_url('sellbilldetails');?>">
                <i class="fa fa-sellsy"></i> <span>Sell</span>
               </a>
            </li>
          <?php } } }  ?>

          <?php  if($roll == "0"){ ?>
               <li class="<?php echo ($this->uri->segment(1) == 'sellbilldetails' ? 'active' : '') ?>">
                 <a href="<?=base_url('sellbilldetails');?>">
                  <i class="fa fa-sellsy"></i> <span>Sell</span>
                 </a>
              </li>
              <!--  <li class="<?php echo ($this->uri->segment(1) == 'customerdetail' ? 'active' : '') ?>">
                 <a href="<?=base_url('customerdetail');?>">
                  <i class="fa fa-address-book"></i> <span>Customer</span>
                 </a>
              </li> -->
          <?php } ?>

         
       
        <li>
           <?php
            if(!empty($inventory_permi)){ 
              $inventory =  $inventory_permi->permissions;
               if(!empty($inventory)){
               $inventory_per = explode(",",$inventory);
              }
            }
            if(!empty($inventory_per) && $roll != "0"){
             foreach($inventory_per as $value){
             if($value == "view"){ ?>
               <li class="treeview <?php echo ($this->uri->segment(1) == 'inventorydetail' ? 'active menu-open' : '') ?>">
                        <a href="#">
                          <i class="fa fa-product-hunt"></i>
                          <span>Inventory</span>
                          <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                        </a>
                        <ul class="treeview-menu">
                          <li> 
                           <a href="<?=base_url('inventorydetail');?>"><i class="fa fa-circle-o"></i> <span>Inventory</span></a>
                         </li>
                         <li> 
                            <a href="<?=base_url('inventorydetail/inventorystock');?>"><i class="fa fa-circle-o"></i> <span>Out of stock</span></a>
                         </li>
                        </ul>
                     </li> 
            <?php } } } ?>

          <?php if($roll == "0"){ ?>
                   <li class="treeview <?php echo ($this->uri->segment(1) == 'inventorydetail' ? 'active menu-open' : '') ?>">
                        <a href="#">
                          <i class="fa fa-product-hunt"></i>
                          <span>Inventory</span>
                          <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                          </span>
                        </a>
                        <ul class="treeview-menu">
                          <li class=""> 
                           <a href="<?=base_url('inventorydetail');?>"><i class="fa fa-circle-o"></i> <span>Inventory</span></a>
                         </li>
                           <li>  
                            <a href="<?=base_url('inventorydetail/inventorystock');?>"><i class="fa fa-circle-o"></i> <span>Out of stock</span></a>
                          </li>
                        </ul>
                     </li> 
            <?php } ?> 
        </li>
       
       <!--  <li>
           <a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a>
        </li> -->
       <!--  <li class="treeview <?php echo ($this->uri->segment(1) == 'inventorycategory' ? 'active menu-open' : '') ?>">
          <a href="#"><i class="fa fa-share"></i> <span>Multilevel</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>      
            </span>
          </a> -->
<!-- 
          <ul class="treeview-menu">
            <?php 
            if(!empty($inventory_permi)){ 
              $inventory =  $inventory_permi->permissions;
               if(!empty($inventory)){
               $inventory_per = explode(",",$inventory);
              }
            }
            if(!empty($inventory_per)){
               foreach($inventory_per as $value){
              if($value == "view"){ ?>
                    <li><a href="<?=base_url('inventorycategory');?>"><i class="fa fa-circle-o"></i>Inventory category</a></li> 
                <?php } } } ?>

              <?php if($roll == "0"){ ?>
                <li><a href="<?=base_url('inventorycategory');?>"><i class="fa fa-circle-o"></i> Inventory category</a></li>
               <li><a href="<?=base_url('userpermissionslist');?>"><i class="fa fa-circle-o"></i>User permissions list</a></li>
              <?php } ?>
          </ul> -->

       <!--  </li> -->
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>