<?php

defined('BASEPATH') OR exit('No direct script access allowed');

$this->load->view('layout/header');

$this->load->view('layout/sidebar');

?>

<style>
    table {
        width: 100%;
        border-collapse: collapse;
        overflow: hidden;
    }
    td, th {
        border: 1px  solid  black;
        border-collapse: collapse;
        text-align:left !important;
        padding: 18px;
    }

    .tblheadcolor{
        background-color: gray;
        color: white;
        text-align: center !important;
        padding: 17px;
    }
    .bordercolor{
        border-right: 2px solid  black;
    }
    .goodreturncolor{
        color: red;
        text-align: center;
        padding: 16px;
    }
    .returncolor{
        color: red;
    }
    .expiry_datebg{
        background-color: #e6b8b8;
        text-align: center;
    }
    .qtysent{
        background-color: #cbcbd8;
    }
    tr.noBorder td {
        border: 0;
    }
    .dashline{
        border-left: 2px dashed black !important;
    }
</style>

<div class="content-wrapper">
      <section class="content-header">
          <h1>
              Invoice
              <small>Invoice List</small>
          </h1>
          <ol class="breadcrumb">
              <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
              <li class="active">Invoice</li>
          </ol>
      </section>
      <!-- Main content -->
    <section class="content">
        <div class="row">
          <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Invoice : <?= $invoice->invoice_no ?></h3>
                            <span class="pull-right">
                                 <!-- <button type="button" name="btnPrint" onclick="window.print()" class="btn btn-primary print">Print</button> -->
                                <a class="btn btn-primary print" target="_blank" href="<?php echo base_url('sellbilldetails/generat_bill_pdf/'); ?><?= $invoice->invoice_no ?>">Print</a>
                            </span>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                          <div class="table-responsive">
                             <div class="table-responsive">
                            <table style="">
                                <tr class="noBorder">
                                    <td colspan="3">
                                        <h3 class="returncolor">SNA PHARMA</h3>
                                        <address readonly contenteditable>
                                            <p><?php
                                              $text = $userdata->address ;
                                              echo  $newtext = wordwrap($text, 20, "<br />\n");
                                               ?></p>
                                        </address> 
                                        <p> VAT Reg No: <?= $customer->vat_no ?></p>
                                    </td>
                                    <td colspan="4" class="returncolor" style=" border-left: 0px solid;">
                                        page 1 of 1
                                    </td>
                                    <td colspan="4" class="bordercolor">
                                        <p>INVOICE :  <?= $invoice->invoice_no ?></p>
                                        <p>INVOICE DATE :  <?= $invoice->invoice_date ?></p>
                                    </td>
                                    <td colspan="2"  class="returncolor dashline">
                                        <h3>GOODS RETURN NOTE</h3>
                                        <address readonly contenteditable>
                                            <p>Date : <?= $invoice->invoice_date ?> <br>
                                                Invoice No: <?= $invoice->invoice_no ?></p>
                                            <p>customer name : <?= $customer->first_name ?> <?= $customer->last_name ?> 
                                                <br>address : <?= $customer->delivery_address ?>  
                                                <br><?= $customer->cust_account_number ?> </p>
                                        </address>
                                    </td>
                                    <td colspan="2"  class="returncolor">
                                        <h3>SNA PHARMA</h3>
                                        <address readonly contenteditable>
                                             <p><?php 
                                                $text = $userdata->address ;
                                              echo  $newtext = wordwrap($text, 20, "<br />\n");
                                             ?></p>
                                        </address> 
                                    </td>
                                </tr>
                                <tr>
                                   <!--  <th class="tblheadcolor">Description</th> -->
                                    <th class="tblheadcolor" colspan="3">Pack size</th>
                                   <!--  <th class="tblheadcolor">Batch Num</th>
                                    <th class="tblheadcolor" >Exp Date</th> -->
                                   
                                    <th class="tblheadcolor" colspan="3">Qty</th>
                                    <th class="tblheadcolor">Unit Cost</th>
                                    <th class="tblheadcolor">Net Goods</th>
                                    <th class="tblheadcolor">Vat %</th>
                                    <th class="tblheadcolor">VAT Value</th>
                                    <th class="tblheadcolor bordercolor">Total (Inc VAT)</th>

                                    <!-- <th class="goodreturncolor">Product Description</th> -->
                                    <th class="goodreturncolor">Pack Size</th>
                                    <th class="goodreturncolor">Qty</th>
                                    <th class="goodreturncolor" colspan="2">Reason Code</th>
                                </tr>
                                <?php
                                if (!empty($invoiceItem)) {
                                    foreach ($invoiceItem as $data) {
                                        ?>
                                        <tr>
                                            <!-- <td><?= $data->description ?></td> -->
                                            <td colspan="3"><?= $data->pack_size ?></td>
                                            <!-- <td><?= $data->batch_number ?></td>
                                            <td class="expiry_datebg" ><?= $data->expiry_date ?></td> -->
                                           
                                            <td class="qtysent" colspan="3"><?= $data->qty ?></td>
                                            <td>£<?= $data->rate ?></td>
                                            <td>£<?= $data->rate * $data->qty ?></td>
                                            <td><?= $data->vat ?></td>
                                            <?php
                                            //count vat value
                                            $vat_value = ($data->rate * $data->qty) * $data->vat / 100;
                                            //total inc
                                            $total_inc = ($data->rate * $data->qty) + $vat_value;
                                            ?>
                                            <td><?= $vat_value ?></td>
                                            <td class="bordercolor">£<?= $total_inc ?></td>

                                            <!-- <td class="goodreturncolor"><?= $data->description ?></td> -->
                                            <td class="goodreturncolor"><?= $data->pack_size ?></td>
                                            <td class="goodreturncolor"><?= $data->qty ?></td>
                                            <td class="goodreturncolor" colspan="2"> </td>
                                        </tr>
                                        <?php
                                    }
                                }
                                if (!empty($invoiceItem)) {
                                    $total_quantity = "0";
                                    $total_price = "0";
                                    $total_vat="0";
                                    $total_inc_grant = "0";
                                    foreach ($invoiceItem as $value) {
                                        if ($value->qty) {
                                            $total_quantity += $value->qty;
                                        } else {
                                            $total_quantity = "0";
                                        }
                                        if ($value->total) {
                                            $total_price += ($value->rate * $value->qty);
                                        } else {
                                            $total_price = "0";
                                        }
                                        if ($value->vat) {
                                            $total_vat += ($value->rate * $value->qty) * $value->vat / 100;
                                        } else {
                                            $total_vat = "0";
                                        }
                                        //calculate grant total
                                        $vat_value = $value->total;
                                        $total_inc_grant += $value->total;
                                    }
                                }
                                ?>
                                <tr>
                                    <td colspan="3"></td>
                                    <td colspan="3"><?= $total_quantity ?></td>
                                    <td></td>
                                    <td>£<?= $total_price ?><td>
                                    <td>£<?= $total_vat ?></td>
                                    
                                    <td class="bordercolor">£<?= $total_inc_grant ?></td>
                                    <td class="goodreturncolor">0</td>
                                    <td class="goodreturncolor">0 </td>
                                    <td class="goodreturncolor" colspan="2">0 </td>
                                    <!-- <td class="goodreturncolor" ></td> -->
                                </tr>
                                <tr class="noBorder">
                                    <td colspan="3">
                                        <p>Customer A/C No: <?= $customer->cust_account_number ?> <br>
                                            Customer address : <?= $customer->delivery_address ?><br>
                                        </p> 
                                    </td>
                                    <td colspan="4">
                                        A/C Name:   <?= $customer->cust_account_number ?>  <br>
                                        Account No: <?= $customer->cust_account_number ?> <br>
                                        Sort Code:  <?= $customer->sort_code ?>
                                    </td>
                                    <td colspan="4" class="bordercolor ">
                                        Order Checked by:______________________<br><br>
                                        Driver Signature:______________________</td>
                                    <td colspan="2"  class="returncolor dashline">
                                        <p>Reason code:<br>
                                        A Incorrect Goods Received<br>
                                        B Price Discrepancy<br>
                                        C Expired Stock<br>
                                        D Missing Goods <br>
                                        E Damaged Goods <br>
                                        F Ordered in error <br>
                                        G Product Recall <br>
                                        H Other</p>

                                            <?php
                                            /*$reasoncodes_list = $invoice->reason_code;
                                            if (!empty($reasoncodes_list)) {
                                                $matchcode = explode(",", $reasoncodes_list);
                                                foreach ($matchcode as $value) {
                                                    if ($value == "a") {
                                                        echo 'A Incorrect Goods Received<br>';
                                                    } elseif ($value == "b") {
                                                        echo 'B Price Discrepancy<br>';
                                                    } elseif ($value == "c") {
                                                        echo 'C Expired Stock<br>';
                                                    } elseif ($value == "d") {
                                                        echo 'D Missing Goods <br>';
                                                    } elseif ($value == "e") {
                                                        echo 'E Damaged Goods <br>';
                                                    } elseif ($value == "f") {
                                                        echo 'F Ordered in error <br>';
                                                    } elseif ($value == "g") {
                                                        echo 'G Product Recall <br>';
                                                    }else{
                                                        echo 'H Other</p>';
                                                    }
                                                }
                                            }*/

                                            ?>

                                    </td>
                                    <td colspan="2"  class="returncolor">
                                        <p>Signature:</p>
                                    </td>
                                </tr>
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
<?php  $this->load->view('layout/footer'); ?>