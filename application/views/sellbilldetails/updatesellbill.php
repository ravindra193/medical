<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('layout/header');
$this->load->view('layout/sidebar');
?>
<style>
    #country-list {
        float: left;
        list-style: none;
        margin-top: -3px;
        padding: 0;
        width: 190px;
        position: absolute;
        border: 1px solid #aaa;
        cursor: default;
        z-index: 10;
    }

    #country-list li {
        position: relative;
        cursor: pointer;
        padding: 10px;
        background: #ffffff;
        border-bottom: #bbb9b9 1px solid;
    } 
    #country-list li:hover {
        background-color: #aaa;
    }
</style>
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
            Edit Bill
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
                        <h3 class="box-title">Edit Bill</h3>
                        <span class="pull-right">
                            <a href="<?= base_url('sellbilldetails'); ?>" class="btn btn-block btn-primary">Back</a>
                        </span>
                    </div>
                    <?php
                     
                       if (!empty($customer)) {
                            /*  echo "<pre>";
                              print_r($customer);
                              die();*/
                          /*foreach ($customer as $value) {
                               echo "<pre>";
                              print_r($value);
                              die();
                          }*/
                      }

                    ?>
                    <!-- /.box-header -->
                    <div class="box-body box box-primary">
                        <div class="row">
                            <form method="POST" id="formupdatebill" action="<?= base_url('sellbilldetails/updatesellbill'); ?>" enctype="multipart/form-data">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="billheader box-header with-border ">
                                            <h3 class="box-title">Customer Detail</h3>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Customer Name <strong class="error">*</strong></label>
                                        <select name="customer_name" required  id="customer_name" class="form-control select2 customername " style="width: 100%;">
                                            <option value="0">Select a customer</option>
                                            <?php  if (!empty($suppliers)) {
                                                foreach ($suppliers as $value) {  ?>
                                                    <option 
                                                      <?php if($customer->customer_id == $value->id){ echo "Selected"; } ?> 
                                                      value="<?php echo $value->id; ?>">
                                                      <?php echo $value->first_name . ' ' . $value->last_name; ?>
                                                    </option>
                                              <?php  }  }  ?>                                        
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Customer Mobile no</label>
                                        <input type="text" class="form-control" onkeypress="return isNumber(event)" name="customer_mobile" id="mobileno" value="<?php if(!empty($customer)){ echo $customer->mobile_no;} ?>">
                                    </div>

                                    <!-- add bank detail -->

                                    <div class="form-group">
                                        <label>Customer Account number</label>
                                        <input type="text" class="form-control"  onkeypress="return isNumber(event)" name="cust_account_number" id="cust_account_number" value="<?php if(!empty($customer)){ echo $customer->cust_account_number;} ?>">
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <!-- bank detail -->
                                    <div class="form-group">
                                        <label>Invoice address</label>
                                        <textarea class="form-control" name="invoice_address" id="invoice_address" rows="2">
                                            <?php if(!empty($customer)){ echo $customer->invoice_address;} ?></textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Delivery address</label>
                                        <textarea class="form-control" name="delivery_address" id="delivery_address" rows="2"><?php if(!empty($customer)){ echo $customer->delivery_address;} ?> </textarea>
                                    </div>

                                </div>

                               <!--  <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="billheader box-header with-border ">
                                            <h3 class="box-title">Reason code</h3>
                                        </div>
                                    </div>
                                </div> -->
                                <?php 
                                   /*echo "<pre>";
                                    print_r($reasoncodes_list);
                                    die();*/
                                   /*$reasoncodes_list = $invoice->reason_code;
                                  if (!empty($reasoncodes_list)){
                                      $matchcode = explode(",", $reasoncodes_list);
                                  }*/
                                ?>

                               <!--  <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="checkbox" name="reason_code[]" value="a"
                                      <?php if(!empty($matchcode)){ foreach($matchcode as $value){ if ($value == "a"){ echo "checked"; } } } ?>
                                        > &nbsp; <label>A Incorrect Goods Received</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="reason_code[]" value="b"
                                        <?php if(!empty($matchcode)){ foreach($matchcode as $value){ if ($value == "b"){ echo "checked"; } } } ?>
                                        > &nbsp; <label>B Price Discrepancy</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="reason_code[]" value="c"
                                        <?php if(!empty($matchcode)){ foreach($matchcode as $value){ if ($value == "c"){ echo "checked"; } } } ?>
                                        > &nbsp; <label>C Expired Stock</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="reason_code[]" value="d" 
                                        <?php if(!empty($matchcode)){ foreach($matchcode as $value){ if ($value == "d"){ echo "checked"; } } } ?>
                                        > &nbsp; <label>D Missing Goods</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="checkbox" name="reason_code[]" value="e"
                                        <?php if(!empty($matchcode)){ foreach($matchcode as $value){ if ($value == "e"){ echo "checked"; } } } ?>
                                        > &nbsp; <label>E Damaged Goods </label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="reason_code[]" value="f" 
                                        <?php if(!empty($matchcode)){ foreach($matchcode as $value){ if ($value == "f"){ echo "checked"; } } } ?>> &nbsp; <label>F Goods received but not ordered </label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="reason_code[]" value="g"
                                        <?php if(!empty($matchcode)){ foreach($matchcode as $value){ if ($value == "g"){ echo "checked"; } } } ?>> &nbsp; <label>G Product Recall</label>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" name="reason_code[]" value="h"
                                         <?php if(!empty($matchcode)){ foreach($matchcode as $value){ if ($value == "h"){ echo "checked"; } } } ?> > &nbsp; <label>H Other</label>
                                    </div>
                                </div> -->

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="billheader box-header with-border">
                                            <h3 class="box-title">Product Detail</h3>
                                        </div>
                                    </div>
                                </div>
                                <!-- add bill style="background-color: white;" -->
                                <?php
                                 /*echo "<pre>";
                                print_r($invoiceItem);
                                die();*/
                                ?>

                                <div class="row">
                                    <div class="col-md-12 table-responsive">
                                        <table class="table table-bordered invoice__table" >
                                            <thead>
                                                <tr class="text-uppercase">
                                                    <th>#</th>
                                                    <th style="width: 20%">PRODUCT NAME. <strong class="error">*</strong></th>
                                                    <!-- <th style="width: 20%">DESCRIPTION. <strong class="error">*</strong></th> -->
                                                    <th style="width: 20%">PACK SIZE. <strong class="error">*</strong></th>
                                                    <th style="width: 15%;">QUANTITY <strong class="error">*</strong></th>
                                                    <th style="width: 15%;">RATE <strong class="error">*</strong></th>
                                                    <th style="width: 10%;">VAT(%) <strong class="error">*</strong></th>
                                                    <th style="width: 15%;">AMOUNT</th>
                                                </tr>
                                            </thead>
                                            <tbody id="dyRow">

                                              <?php if(!empty($invoiceItem)){
                                                  $total_price = "0";
                                                  $vat_total = "0";
                                                  $total_inc_grant = "0";
                                                  $k = "-1";
                                                  foreach ($invoiceItem as $data) {
                                                    $k++;
                                                    /*echo "<pre>";
                                                    print_r($data);
                                                    die();*/
                                               ?>
                                                <tr>
                                                    <td><input type='checkbox' class='case' id="chk-<?php echo $k; ?>"/></td>

                                                    <td>
                                                      <div class="col-sm-12">
                                                        <input type='text' required class='form-control category' onkeyup='getCategory(0)' id='description-<?php echo $k; ?>' name='product_name[]' 
                                                        value="<?php echo $data->product_name; ?>" />
                                                        <i class="form-group__bar"></i>
                                                        <input type="hidden" name="c_id[]" id="c_id-<?php echo $k; ?>" value="<?php echo $data->product_id; ?>" />
                                                        <input type="hidden" name="product_number[]" id="product_number-<?php echo $k; ?>" value="<?php echo $data->product_sku; ?>" />
                                                        <div class='autocomp' id="suggesstion-box-<?php echo $k; ?>"></div>
                                                      </div>
                                                    </td>

                                                   <!--  <td>
                                                      <div class='col-sm-12'>
                                                        <input type='text'  class='form-control pro_description' id='pro_description-<?php echo $k; ?>' name='pro_description[]' value="<?php echo $data->description; ?>" />
                                                      </div>
                                                    </td> -->

                                                    <td>
                                                      <div class='col-sm-12'>
                                                        <input type='number' required class='form-control pack_size' id='pack_size-<?php echo $k; ?>' name='pack_size[]' value="<?php echo $data->pack_size; ?>" />
                                                      </div>
                                                    </td>

                                                    <td>
                                                      <div class="col-sm-12">
                                                        <input type='number' onkeyup='onChangPrice()' class='form-control inputQty' id='itemQty-<?php echo $k; ?>' name='quantity[]' value='<?php echo $data->qty; ?>' /><i class="form-group__bar"></i>
                                                      </div>
                                                    </td>

                                                    <td>
                                                      <div class="col-sm-12">
                                                        <input type='number' required onkeyup='onChangPrice()' class='form-control inputPrice' id='itemPrice-<?php echo $k; ?>' name='price[]' value='<?php echo $data->rate; ?>'/>
                                                        <i class="form-group__bar"></i>
                                                      </div>
                                                    </td>

                                                    <td>
                                                      <div class="col-sm-12">
                                                        <input type='number' required onkeyup='onChangPrice()' class='form-control inputVat' id='itemVat-<?php echo $k; ?>' name='vat[]' value='<?php echo $data->vat; ?>' />

                                                        <input type='hidden' class='form-control inputVatAmt' id='itemVatAmt-<?php echo $k; ?>' name='vatAmt[]' value='<?php echo $data->vat; ?>'/>

                                                        <i class="form-group__bar"></i>
                                                      </div>
                                                    </td>


                                                    <td>
                                                      <div class="col-sm-12">
                                                        <input readonly class='form-control inputTotal' id='Total-<?php echo $k; ?>' name='total[]' value='<?php echo $data->total; ?>' />
                                                        <i class="form-group__bar"></i>
                                                      </div>
                                                    </td>
                                                </tr>
                                                <?php
                                               // $total = $data->rat * $data->vat; 
                                                    if($data->total){
                                                        $total_price += ($data->rate * $data->qty);
                                                    } else {
                                                        $total_price = "0";
                                                    }

                                                   if ($data->vat) {
                                                        $vat_total += ($data->rate * $data->qty) * $data->vat / 100;
                                                    } else {
                                                        $vat_total = "0";
                                                    }

                                                    $total_inc_grant += $data->total;
                                              
                                                ?>
                                                <!-- invoice item id -->
                                                <input type="hidden" name="invoice_item_id[]" id="invoice_item_id" value="<?php echo $data->id; ?>">
                                              <?php } } ?>
                                            </tbody>    
                                            <tfoot>
                                                <?php //if (!isset($invoice)) { ?>
                                                    <tr>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                        <td colspan="5" style="text-align: right">
                                                            <button type="button" onclick="delRow()" class='btn btn-danger btn--icon-text waves-effect delete'><i class="zmdi zmdi-minus"></i> Delete</button>
                                                            <button type="button" onclick="addRow()" class='btn btn-primary btn--icon-text waves-effect addmore'><i class="zmdi zmdi-plus"></i> Add More</button>
                                                        </td>
                                                    </tr>
                                                <?php //} ?>
                                                <?php

                                                 ?>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right" colspan="4"><strong>Subtotal</strong></td>
                                                    <td><p id="subTotal">&#8377;
                                                     <span id="lblsubTotal"><?php echo $total_price; ?></span> 
                                                     <input type="hidden" name="sub_Total" id="sub_Total" value="<?php echo $total_price; ?>" /></p></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right" colspan="4">
                                                        <strong>Total VAT
                                                            
                                                        </strong></td>
                                                    <td><p id="vat"> &#8377;
                                                            <span id="lblVat"><?php echo $vat_total; ?></span>
                                                            <input type="hidden" name="totalvat" id="totalvat" class="vat" value="<?php echo $vat_total; ?>" />
                                                        </p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-right" colspan="4"  style="font-size:28px;"><strong>Total</strong></td>
                                                    <td>
                                                      <p id="Total" style="font-size:28px;">&#8377; 
                                                      <span id="lblTotal"><?php echo $total_inc_grant; ?></span> 
                                                      <input type="hidden" name="invoice_total" id="invoice_total"  value="<?php echo $total_inc_grant; ?>"></p>
                                                    </td>
                                                </tr>
                                             
                                            </tfoot>
                                        </table>
                                    </div>
                                </div> 
                                <div class="col-md-12">
                                    <div class="col-md-1">
                                        <input type="hidden" name="vatpercentile" id="vatpercentile" value="">

                                         <input type="hidden" name="invoice_no" id="invoice_no" value="<?php echo $invoiceItem[0]->invoice_no; ?>">
                                        

                                        <button type="submit" name="updatebill" value="updatebill" id="updatebill" class="btn btn-block btn-primary">Update</button>
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
        $('.select2').select2();
        //Date picker
        $('#expiry_date').datepicker({
            autoclose: true
        });
//        $(".category").on('change', function () {
//            $(".autocomp").css('display', 'none');

//        });
    });
//*************Invoice Calucalation code*************//
    var i = $('tbody tr').length;
    function addRow() {
        var data = "<tr><td><input type='checkbox' class='case' id='chk-" + i + "'/></td>";
        data += "<td><div class='col-sm-12'><input type='text' onkeyup='getCategory(" + i + ")' required class='form-control category' id='description-" + i + "' name='product_name[]'/><i class='form-group__bar'></i><input type='hidden' name='c_id[]' id='c_id-" + i + "' /><input type='hidden' name='product_number[]' id='product_number-" + i + "' /><div class='autocomp' id='suggesstion-box-" + i + "'></div></div></td>    <td><div class='col-sm-12'><input type='number' class='form-control pack_size' id='pack_size-" + i + "' name='pack_size[]' value='' /></div></td>\n\
                <td><div class='col-sm-12'><input type='number' onkeyup='onChangPrice()' class='form-control inputQty' id='itemQty-" + i + "' name='quantity[]' value='1' /><i class='form-group__bar'></i></div></td>\n\
                <td><div class='col-sm-12'><input type='number' onkeyup='onChangPrice()' class='form-control inputPrice' id='itemPrice-" + i + "' name='price[]'/><i class='form-group__bar'></i></div></td>\n\
                <td><div class='col-sm-12'><input type='number' onkeyup='onChangPrice()' class='form-control inputVat' id='itemVat-" + i + "' name='vat[]'/><input type='hidden' class='form-control inputVatAmt' id='itemVatAmt-" + i + "' name='vatAmt[]'/><i class='form-group__bar'></i></div></td>\n\
                <td><div class='col-sm-12'><input readonly class='form-control input' id='Total-" + i + "' name='total[]'/><i class='form-group__bar'></i></div></td>\n\
                </tr>";
        $('table').append(data);
        i++;
    }
    function delRow() {
        var netAmt = $('#invoice_total').val();
        var tmptotal = $('#sub_Total').val();
        var tmpVat = $('#vat').val();
//        $('.case:checkbox:checked').parents("tr").remove();
        $('.case:checkbox:checked').each(function () {
            var i = $(this).prop('id').split('-')[1];
            var price = $('#itemPrice-' + i).val();
            var qty = $('#itemQty-' + i).val();
            var vat = $('#itemVat-' + i).val();
            var vatAmt = (price * qty) * vat / 100;
            netAmt -= parseFloat($('#Total-' + i).val());
            tmptotal -= parseInt($('#Total-' + i).val() - vatAmt);
            tmpVat -= parseFloat($('#itemVatAmt-' + i).val());
            $('#lblsubTotal').text(tmptotal);
            $('#sub_Total').val(tmptotal);
            $('#lblVat').text(tmpVat.toFixed(2));
            $('#totalvat').val(tmpVat.toFixed(2));
            $('#lblTotal').text(netAmt.toFixed(2));
            $('#invoice_total').val(netAmt.toFixed(2));
            $(this).parents("tr").remove();
        });
    }
    var rowId;
    function getCategory(i) {
        var url = "<?= base_url(); ?>";
//        var tblrows = $('#dyRow tr').length;
//        for (var j = 0; j < tblrows; j++)
//        {
        var key = $('#description-' + i).val();
//        if ($('#description-' + i).is(':focus')) {
        $.ajax({
            type: "POST",
            url: url + "sellbilldetails/sell_product_price",
            data: 'keyword=' + key,
            success: function (data) {
//                    var k = j - 1;
                $("#suggesstion-box-" + i).show();
                $("#suggesstion-box-" + i).html(data);
                $('#description-' + i).css("background", "#fff");
                rowId = i;
            }
        });
//        } else {
//            $("#suggesstion-box-" + i).css('display', 'none');
//        }
    }

    function onChangPrice() {
        var tblrows = document.getElementById('dyRow').getElementsByTagName("tr").length;
        var netAmt = 0;
        var tmptotal = 0;
        var tmpVat = 0;
        for (var i = 0; i <= tblrows - 1; i++)
        {
            var price = $('#itemPrice-' + i).val();
            var qty = $('#itemQty-' + i).val();
            var vat = $('#itemVat-' + i).val();
            if (vat === '') {
                vat = 0;
            }
            var vatAmt = (price * qty) * vat / 100;
            var total = (price * qty) + vatAmt;
            var tmpTtl = price * qty;
//            var vat = $('#vatpercentile').val();
            $('#Total-' + i).val(total.toFixed(2));
            $('#itemVatAmt-' + i).val(vatAmt.toFixed(2));
//          var vatRate = $('#lblVat').text();
            netAmt += parseFloat($('#Total-' + i).val());
            tmptotal += parseInt($('#Total-' + i).val() - vatAmt);
            tmpVat += parseFloat($('#itemVatAmt-' + i).val());
//            var vat = (subtotal * vat) / 100;
//            var _vat = parseFloat(vatAmt.toFixed(2));
            $('#lblsubTotal').text(tmptotal);
            $('#sub_Total').val(tmptotal);
            $('#lblVat').text(tmpVat.toFixed(2));
            $('#totalvat').val(tmpVat.toFixed(2));
//            var net = subtotal + _vat;

//            var netAmt = net.toFixed(2);
            $('#lblTotal').text(netAmt.toFixed(2));
            $('#invoice_total').val(netAmt.toFixed(2));
        }
    }

    function selectCategory(val) {
        var cat = val.split('/')[0];
        var price = val.split('/')[1];
        var cid = val.split('/')[2];
        var pack_size = val.split('/')[3];
        var pro_sku = val.split('/')[4];
        var tblrows = $('#dyRow tr').length;
//        var subtotal = 0;
        //*************new code******************//
        var netAmt = 0;
        var tmptotal = 0;
        var tmpVat = 0;
        var qty = $('#itemQty-' + rowId).val();
        var vat = $('#itemVat-' + rowId).val();
        if (vat === '') {
            vat = 0;
        }
        var vatAmt = (price * qty) * vat / 100;
        var total = (price * qty) + vatAmt;
        var tmpTtl = price * qty;
        $('#Total-' + rowId).val(total.toFixed(2));
        $('#itemVatAmt-' + rowId).val(vatAmt.toFixed(2));
        //*************************************************//
        // alert(pack_size);
        $('#c_id-' + rowId).val(cid);
        $("#description-" + rowId).val(cat);
        $('#itemPrice-' + rowId).val(price);
        $('#pack_size-' + rowId).val(pack_size);
        $('#product_number-' + rowId).val(pro_sku);
        var amount = price * $('#itemQty-' + rowId).val();
//        $('#Total-' + rowId).val(amount);
        $("#suggesstion-box-" + rowId).hide();
        for (var j = 0; j < tblrows; j++)
        {
//            subtotal += parseInt($('#Total' + j).val());
            //************************************//
            netAmt += parseFloat($('#Total-' + j).val());
            tmptotal += parseInt($('#Total-' + j).val() - $('#itemVatAmt-' + j).val());
            tmpVat += parseFloat($('#itemVatAmt-' + j).val());

            $('#lblsubTotal').text(tmptotal);
            $('#sub_Total').val(tmptotal);
            $('#lblVat').text(tmpVat.toFixed(2));
            $('#totalvat').val(tmpVat.toFixed(2));
            $('#lblTotal').text(netAmt.toFixed(2));
            $('#invoice_total').val(netAmt.toFixed(2));
            //************************************//
//            var vat = $('#vatpercentile').val();
//            var vat = (subtotal * vat) / 100;
//            var _vat = vat.toFixed(2);
//            //alert(_vat);
//            $('#vat').val(_vat);
//            $('.vat').attr('value', _vat);
//            $('#lblVat').text(_vat);
//            $('#lblsubTotal').text(subtotal);
//            $('#invoice_Total').val(subtotal);
//            var net = subtotal + vat;
//            $('#lblTotal').text(net);
//            $('#invoice_total').val(net);


//            var vat = 0;//(subtotal * gst) / 100;
//            $('#lblTax').text(vat);
//            $('#invoice_tax').val(vat);
//            $('#igst').text(vat);
//            $('#igst').val(vat);
        }
    }
    //formaddbill form validation
    (function ($, window, document, undefined) {

        //get the customet detail
        $('#customer_name').on('change', function () {
            var customer_id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?= base_url(); ?>Sellbilldetails/get_customerdata',
                data: "customer_id=" + customer_id,
                success: function (result) {
                    var obj = JSON.parse(result);
                    var company_name = obj.company_name;
                    var mobile_no = obj.mobile_no;
                    var cust_account_number = obj.cust_account_number;
                    var invoice_address = obj.invoice_address;
                    var delivery_address = obj.delivery_address;
                    // alert(com_name);
                    $('#company_name').attr('value', company_name);
                    $('#mobileno').attr('value', mobile_no);
                    $('#cust_account_number').attr('value', cust_account_number);
                    $("#invoice_address").text(invoice_address);
                    $("#delivery_address").text(delivery_address);
                }
            });
        });
        $("#formupdatebill").validate({
            errorClass: 'error',
            errorElement: 'span',
            rules: {
                "customer_name": {selectcheck: true},
                "product_name[]": {required: true},
               // "pro_description[]": {required: true},
                "pack_size[]": {required: true},
                "price[]": {required: true},
            },
            messages: {
                // "customer_name": {required: "Select customer name."},
                "product_name[]": {required: "This product field is required."},
                //"pro_description[]": {required: "This description field is required."},
                "pack_size[]": {required: "This pack size field is required."},
                "price[]": {required: "This price field is required."},
            }
        });
        jQuery.validator.addMethod('selectcheck', function (value) {
            return (value != '0');
        }, "Select customer name.");
    })(jQuery, window, document);

</script>
<?php $this->load->view('layout/footer'); ?>

