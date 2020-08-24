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
             <!--    <a href="#" class="close" data-dismiss="alert">&times;</a> -->
                <strong><?php echo $this->session->flashdata('Msg'); ?> </strong> 
            </div>
<?php } ?>  
      <section class="content-header">
          <h1>
              Add Bill
              <small>Bill Form</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Bill Form</li>
          </ol>
      </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Add Bill</h3>
                            <span class="pull-right">
                              <a href="<?= base_url('sellbilldetails'); ?>" class="btn btn-block btn-primary">Back</a>
                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body box box-primary">
                            

                          <div class="row">
                            <form method="POST" id="formaddbill" action="<?= base_url('sellbilldetails/makesellbill'); ?>" enctype="multipart/form-data">
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="billheader box-header with-border ">
                                      <h3 class="box-title">Customer Detail</h3>
                                    </div>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Customer Name</label>
                                    <input type="text" class="form-control" name="customer_name" id="customer_name" value="<?= set_value('customer_name') ?>">
                                      <?php //echo form_error('customer_name') ?>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Customer Mobile no</label>
                                    <input type="text" class="form-control" onkeypress="return isNumber(event)" name="customer_mobile" id="customer_mobile" value="<?= set_value('customer_mobile') ?>">            
                                    <?php //echo form_error('customer_mobile') ?>                        
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <label>Address</label>
                                    <textarea class="form-control" name="address" id="address" rows="2" placeholder="Enter ..." >
                                      <?php //echo set_value('address') ?>
                                    </textarea>                                    
                                  </div>
                                </div>
                                <div class="col-md-12">
                                  <div class="form-group">
                                    <div class="billheader box-header with-border">
                                      <h3 class="box-title">Product Detail</h3>
                                    </div>
                                  </div>
                                </div>
                                <!-- add bill -->
                                <div class="col-md-12 peoductlist" id="add">
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label>Product number</label>
                                        <input type="text" class="form-control product_number sku" name="product_number[]" id="product_number" value="<?= set_value('product_number') ?>">  
                                         <!--  <select name="product_number" id="product_number" class="form-control select2" style="width: 100%;">
                                             <option value="">Select a Product</option>
                                            <?php  if(!empty($inventoryname)){
                                             foreach ($inventoryname as $value) {  ?>
                                                <option value="<?php echo $value['product_sku']; ?>"><?php echo $value['product_name']; ?></option>
                                             <?php  } } ?>
                                           </select>        -->
                                             <?php //echo form_error('product_number') ?>                             
                                      </div>
                                   </div>
                                   <div class="col-md-3">
                                      <div class="form-group">
                                        <label>Product quantity</label>
                                        <input type="number" class="form-control quantity" name="quantity[]" id="quantity" value="<?= set_value('quantity') ?>">     <?php //echo form_error('quantity') ?>                                   
                                      </div>
                                   </div>
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label>Price</label>
                                        <input type="number" class="form-control price" name="Price[]" id="price" value="<?= set_value('Price') ?>">     
                                                                     
                                      </div>
                                   </div> 
                                    <div class="col-md-1">
                                      <div class="form-group">
                                        <label>Add more</label>
                                         <button type="button" name="addproduct" value="addproduct" id="addproduct1" class="btn btn-block btn-primary addproduct1">  <i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                      </div>
                                   </div>
                                    <div class="col-md-5">
                                    </div>
                                </div>

                                 <div class="col-md-12" >
                                    <div class="col-md-3">
                                   </div>
                                   <div class="col-md-3">
                                   </div>
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label>Sub Total</label>
                                        <input type="number" class="form-control subtotla" name="subtotl" id="subtotla" value="<?= set_value('subtotla') ?>">             
                                      </div>    
                                   </div> 
                                    <div class="col-md-1">
                                   </div>
                                    <div class="col-md-5">
                                    </div>
                                </div>

                                 <div class="col-md-6">
                                  <div class="form-group">
                                    <label>Discount</label>
                                    <input type="number" class="form-control" name="discount" id="discount" value="<?= set_value('discount') ?>">
                                  </div>

                                  <div class="form-group">
                                    <label>Description</label>
                                     <textarea class="form-control" name="description" id="description" rows="2" placeholder="Enter ..." >
                                      <?= set_value('description') ?>
                                    </textarea>   
                                  </div>
                                </div>
                             
                                <div class="col-md-12">
                                  <div class="col-md-1">
                                    <button type="submit" name="addbill" value="addbill" id="addbill" class="btn btn-block btn-primary">Save</button>
                                  </div>
                                   <div class="col-md-1">
                                    <a href="<?= base_url('sellbilldetails'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                  </div>
                                </div>

                               </form>
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
    $('.select2').select2()

     //Date picker
    $('#expiry_date').datepicker({
      autoclose: true
    })
   });
  
    $(function() {
      var i=$('#add').length;
      $('#addproduct1').click(function(e) {
        e.preventDefault();
        /* $('#add').append('<div class="col-md-12 peoductlist row"><div class="col-md-3"><input type="number" class="form-control product_number" name="product_number[]" id="product_number" value=""> </div><div class="col-md-3"><input  type="number" class="form-control quantity" name="quantity[]" id="quantity" value=""></div> <div class="col-md-3"> <div class="form-group"><input type="number" class="form-control price" name="price[]" id="price" value=""> </div></div> <div class="col-md-1"><div class="form-group"> <button type="button" name="addproduct" value="addproduct" id="remove1" class="btn btn-block btn-danger remove hidden">  <i class="fa fa-minus" aria-hidden="true"></i></button></div></div><div class="col-md-5"></div></div>');*/
        
        
           htmlString = '<div class="col-md-12 peoductlist row">';
        
             htmlString += '<div class="col-md-3">';
               htmlString += '<div class="form-group">';
               htmlString += '<input  type="number" class="form-control product_number sku" name="product_number[]"  onkeyup="onChangPrice()" id="product_number_'+i+'" value="">';
               htmlString += '</div>';
             htmlString += '</div>';

             htmlString += '<div class="col-md-3">';
               htmlString += '<div class="form-group">';
               htmlString += '<input  type="number" class="form-control quantity" name="quantity[]" id="quantity_'+i+'" onkeyup="onChangPrice()"  value="">';
               htmlString += '</div>';
             htmlString += '</div>';

             htmlString += '<div class="col-md-3">'; 
               htmlString += '<div class="form-group">';
               htmlString += '<input type="number" class="form-control price " name="price[]" id="price_'+i+'"  value="">'; 
               htmlString += '</div>';
             htmlString += '</div>'; 

             htmlString += '<div class="col-md-1">';
               htmlString += '<div class="form-group">'; 
                 htmlString += '<button type="button" name="addproduct" value="addproduct" id="remove1_'+i+'"  class="btn btn-block btn-danger remove hidden">';
                 htmlString += '<i class="fa fa-minus" aria-hidden="true"></i></button>';
               htmlString += '</div>';
             htmlString += '</div>';
           
             htmlString += '<div class="col-md-5"></div>';
           htmlString += '</div>';


          $('#add').append(htmlString)
          i++;

      });
        $('.remove').click(function (e) {
         e.preventDefault();
        if ($('#add').length > 1) {
          $('#add').children().last().remove();
        }
      });
    });


     ;(function($, window, document, undefined) {
              //get price
              $(".product_number").keyup(function() {
                //var sku = $(".product_number").val();
                  var sku=$(this).val();
                  $.ajax({
                      type: 'post',
                      url: '<?= base_url(); ?>sellbilldetails/sell_product_price',
                      data: "sku=" + sku,
                      success: function(result) {
                          //$(".changeqr").html(data);
                          //alert(result);
                         var obj = JSON.parse(result);
                         var netpri = obj.netprice; 
                         //hidden
                        $('#price').attr('value',netpri);
                        // $('#amountils2').attr('value',total);
                      }
                  });
              });

               $("#price").keyup(function() {
                   var price =$(this).val();
                   //alert(price);
               });

               $(".quantity").keyup(function() {
                    var price_qty = $(".price").val();
                    var qty = $(this).val();
                    var total_price = (price_qty * qty);

                    $('#price').attr('value',total_price);
                     //alert(total);
               });
       })(jQuery, window, document);


      function onChangPrice(){
        //alert('SDSDSDS');
         //get price
         
            var apend = $("#add","#product").length;
          alert(apend);
             for (var i = 1; i < apend; i++)
             {
              // alert(i);
              $('"#product_number_'+i+'"').on('keyup',function() {
              
                //var sku = $(".product_number").val();
                  var sku=$(this).val();  
                  alert(sku);

                  $.ajax({
                      type: 'post',
                      url: '<?= base_url(); ?>sellbilldetails/sell_product_price',
                      data: "sku=" + sku,
                      success: function(result) {
                          //$(".changeqr").html(data);
                          //alert(result);
                         var obj = JSON.parse(result);
                         var netpri = obj.netprice; 
                         //hidden
                        $('"#price_'+i+'"').attr('value',netpri);
                        // $('#amountils2').attr('value',total);
                      }
                  });
              });

               $('"#price_'+i+'"').keyup(function() {
                   var price =$(this).val();
                   //alert(price);
               });
             
                 $('"#quantity_'+i+'"').keyup(function() {


                      var price_qty = $('"#price_'+i+'"').val();
                      var qty = $(this).val();
                      var total_price = (price_qty * qty);

                      $('"#price_'+i+'"').attr('value',total_price);
                       //alert(total);
                 });
              }

              /* $( "#paymentdis" ).keyup(function() {
                  var rs=$(this).val();
                  var planid=$("#planid").children(":selected").html();
                  var planiddata=planid.split('-'); 
                   var paym=$('#paymentmonth').val();
                  $('#paymentrs').val(planiddata[1]*paym-rs);
              });*/

      }
           

                     
   //formaddbill form validation
   ;(function($, window, document, undefined) {
          $("#formaddbill").validate({
            errorClass: 'error',
            errorElement: 'span',
            rules: {
                "customer_name": {required: true},
                "customer_mobile": {required: true},
                "product_number[]": {required: true},
                "quantity[]": {required: true},
            },
            messages: {
                "customer_name": {required: "Please enter customer name"},
                "customer_mobile": {required: "Please enter customer mobile no"},
                "product_number[]": {required: "Please enter product"},
                "quantity[]": {required: "Please enter quantity"},
            }
       });
   })(jQuery, window, document);
</script>
<?php $this->load->view('layout/footer'); ?>

