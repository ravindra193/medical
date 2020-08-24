<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*

sell bill detail  controlles

call model in dbmodel

*/
class Sellbilldetails extends MY_Controller{
    function __construct(){
         parent::__construct();
    }

    public function index(){
        $loginid = $this->session->userdata('login_id');
        if (!empty($loginid))
            {
            $get = $this->input->get();
            if (empty($get['start1']) && empty($get['end1']))
                {
                // $tbl_sell_billdetail = $this->db->select('*')->from('tbl_invoice')->get()->result();

                $tbl_sell_billdetail = $this->db
                ->select('tbl_invoice.*,tbl_supplier.first_name,tbl_supplier.last_name,user_detail.username')
                ->from('tbl_invoice')
                ->join('tbl_supplier', 'tbl_supplier.id=tbl_invoice.customer_id', 'left')
                ->join('user_detail', 'user_detail.id=tbl_invoice.user_id', 'left')
                ->order_by('tbl_invoice.id', 'DESC')
                ->get()->result();

                /*echo "<pre>";
                print_r($tbl_sell_billdetail);
                die(); */
                }

            // user name wise from to date find recode

            if (!empty($get['start1']) && !empty($get['end1']) && !empty($get['user_id']))
                {
                $start1 = $get['start1'];
                $start = date_create($start1);
                $from = date_format($start, "Y-m-d");
                $end1 = $get['end1'];
                $end = date_create($end1);
                $to = date_format($end, "Y-m-d");
                $user_id = $get['user_id'];

                // $tbl_sell_billdetail = $this->db->select('*')->from('tbl_bill_history')->where("(created_date BETWEEN '{$from}%' AND '{$to}%' AND user_id = '$user_id')")->get()->result_array();
                

                $tbl_sell_billdetail = $this->db
                ->select('tbl_invoice.*,tbl_supplier.first_name,tbl_supplier.last_name,user_detail.username')
                ->from('tbl_invoice')
                ->where("(created_date BETWEEN '{$from}%' AND '{$to}%' AND customer_id = '$user_id')")
                ->join('tbl_supplier', 'tbl_supplier.id=tbl_invoice.customer_id', 'left')
                ->join('user_detail', 'user_detail.id=tbl_invoice.user_id', 'left')
                ->order_by('tbl_invoice.id', 'DESC')
                ->get()->result();

                /* echo $this->db->last_query();
                exit(); */
                }else{
                if (!empty($get['user_id']) && $get['user_id'] != "0")
                    {
                    $start1 = $get['start1'];
                    $start = date_create($start1);
                    $from = date_format($start, "Y-m-d");
                    $end1 = $get['end1'];
                    $end = date_create($end1);
                    $to = date_format($end, "Y-m-d");
                    $user_id = $get['user_id'];

                    // $tbl_sell_billdetail = $this->db->select('*')->from('tbl_bill_history')->where("(user_id = '$user_id')")->get()->result_array();


                    $tbl_sell_billdetail = $this->db
                        ->select('tbl_invoice.*,tbl_supplier.first_name,tbl_supplier.last_name,user_detail.username')
                        ->from('tbl_invoice')
                        ->where("(customer_id = '$user_id')")
                        ->join('tbl_supplier', 'tbl_supplier.id=tbl_invoice.customer_id', 'left')
                        ->join('user_detail', 'user_detail.id=tbl_invoice.user_id', 'left')
                        ->order_by('tbl_invoice.id', 'DESC')
                        ->get()->result();

                    /* echo $this->db->last_query();
                    exit(); */
                    }

                if (!empty($get['start1']) && !empty($get['end1']))
                    {
                    $start1 = $get['start1'];
                    $start = date_create($start1);
                    $from = date_format($start, "Y-m-d");
                    $end1 = $get['end1'];
                    $end = date_create($end1);
                    $to = date_format($end, "Y-m-d");

                    // $tbl_sell_billdetail = $this->db->select('*')->from('tbl_bill_history')->where("(created_date BETWEEN '{$from}%' AND '{$to}%' OR created_date LIKE '{$from}%' OR created_date LIKE '{$to}%')")->get()->result_array();

                     $tbl_sell_billdetail = $this->db
                        ->select('tbl_invoice.*,tbl_supplier.first_name,tbl_supplier.last_name,user_detail.username')
                        ->from('tbl_invoice')
                         ->where("(created_date BETWEEN '{$from}%' AND '{$to}%' OR created_date LIKE '{$from}%' OR created_date LIKE '{$to}%')")
                        ->join('tbl_supplier', 'tbl_supplier.id=tbl_invoice.customer_id', 'left')
                        ->join('user_detail', 'user_detail.id=tbl_invoice.user_id', 'left')
                        ->order_by('tbl_invoice.id', 'DESC')
                        ->get()->result();
                    /* echo $this->db->last_query();
                    exit(); */
                    }
                }

            // user list for filter
            $userdetail = $this->db->select('*')->from('tbl_supplier')->where(['is_active' => '1'])->get()->result_array();

            // module to give permission

            $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
            $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
            $report_permi = $this->Dbmodel->get_report_permissions($loginid);
            $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);
            $this->load->view('sellbilldetails/sellbilldetails', array(
                'tbl_sell_billdetail' => $tbl_sell_billdetail,
                'inventory_permi' => $inventory_permi,
                'sell_permi' => $sell_permi,
                'report_permi' => $report_permi,
                'bill_permi' => $bill_permi,
                'userdetail' => $userdetail
            ));
            }else{
              return redirect();
            }
        }

    public function get_customerdata(){
      
        $post = $this->input->post();
        if (!empty($post)){
            $customer_id = $post['customer_id'];
            $customerdata = $this->Dbmodel->get_supplier_data($customer_id);
            if (!empty($customerdata)){
                $customerdetail = array(
                    'company_name' => $customerdata->company_name,
                    'mobile_no' => $customerdata->mobile_no,
                    'cust_account_number' => $customerdata->cust_account_number,
                    'invoice_address' => $customerdata->invoice_address,
                    'delivery_address' => $customerdata->delivery_address,
                );
                $data = json_encode($customerdetail);
                echo $data;
            }else{
                $customerdetail = array(
                    'company_name' => "",
                    'mobile_no' => "",
                    'cust_account_number' => "",
                    'invoice_address' => "",
                    'delivery_address' => "",
                );
                $data = json_encode($customerdetail);
                echo $data;
                }
            }
        }


    public function sell_bill_pdf($bill_id)
    {
        require_once APPPATH . 'libraries/dompdf/lib/html5lib/Parser.php';
        require_once APPPATH . 'libraries/phenx/php-font-lib/src/FontLib/Autoloader.php';
        require_once APPPATH . 'libraries/phenx/php-svg-lib/src/autoload.php';
        require_once APPPATH . 'libraries/dompdf/src/Autoloader.php';
        DompdfAutoloader::register();
        $dompdf = new DompdfDompdf();
        if (!empty($bill_id))
        {
            $id = $bill_id;
        }

        $tbl_sell_bill = $this->db->where('bill_number', $id)->get('tbl_sell_bill')->result();
        /* echo $this->db->last_query();
        exit(); */
        /* echo "<pre>";
        print_r($tbl_sell_bill);
        die(); */
        if (!empty($tbl_sell_bill))
            {
            /* echo "<pre>";
            print_r($tbl_sell_bill);
            die(); */
            $customer_data = $this->supplierdata($tbl_sell_bill[0]->customer_id);
            /* echo "<pre>";
            print_r($customer_data);
            die(); */
            foreach($tbl_sell_bill as $value)
                {
                if (!empty($value->product_id))
                    {
                    $product_name = $this->productdata($value->product_id);
                    /* echo "<pre>";
                    print_r($product_name);
                    die(); */
                    if (!empty($product_name->product_name))
                        {
                        $name = $product_name->product_name;
                        }
                      else
                        {
                        $name = " ";
                        }

                    $value->product_name = $name;
                    }
                }

            /* echo "<pre>";
            print_r($tbl_sell_bill);
            die(); */

            // bill created date

            $date = date_create($tbl_sell_bill[0]->created_date);
            $bill_date = date_format($date, "d-m-Y");
            $html = '';
            $html.= '<style>

                          table {

                              width: 100%;

                              border-collapse: collapse;

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

                     </style>';
            $html.= '<html lang="en">';
            $html.= '<table style="">

                          <tr class="noBorder">

                            <td colspan="3">

                              <h3 class="returncolor">SNA PHARMA</h3>

                              <address contenteditable>

                                <p>17 The Broadway, Wood Green, London, N22 6DS, </p>

                                <p> Phone 0208 8888 1605 </p>

                                <p> email: isha@greenwoodspharmacy.co.uk</p>

                              </address> 

                                <p> VAT Reg No: vat_reg_number </p>

                            </td>

                            <td colspan="4" class="returncolor">

                                page 1 of 1

                            </td>

                            <td colspan="4" class="bordercolor">

                                 <p>INVOICE :  ' . $tbl_sell_bill[0]->bill_number . '</p>

                                 <p>INVOICE DATE :  ' . $bill_date . '</p>

                            </td>

                            <td colspan="2"  class="returncolor dashline">

                                 <h3>GOODS RETURN NOTE</h3>

                                  <address contenteditable>

                                    <p>Date : ' . $bill_date . ' <br />

                                    Invoice No: ' . $tbl_sell_bill[0]->bill_number . '</p>

                                    <p>customer name : ' . $customer_data->first_name . ' ' . $customer_data->last_name . ' 

                                    <br />address : ' . $tbl_sell_bill[0]->delivery_address . '  

                                    <br />' . $tbl_sell_bill[0]->cust_ac_number . ' </p>

                                  </address>

                             </td>

                            <td colspan="2"  class="returncolor">

                                <h3>SNA PHARMA</h3>

                                <address contenteditable>

                                    <p>17 The Broadway,<br /> Wood Green, <br /> London, N22 6DS, </p>

                                </address> 

                             </td>

                          </tr>



                          <tr>

                             <th class="tblheadcolor">Description</th>

                             <th class="tblheadcolor">Pack size</th>

                             <th class="tblheadcolor">Batch Num</th>

                             <th class="tblheadcolor">Exp Date</th>

                             <th class="tblheadcolor">Qty Ord</th>

                             <th class="tblheadcolor">Qty Sent</th>

                             <th class="tblheadcolor">Unit Cost</th>

                             <th class="tblheadcolor">Net Goods</th>

                             <th class="tblheadcolor">Vat %</th>

                             <th class="tblheadcolor">VAT Value</th>

                             <th class="tblheadcolor bordercolor">Total (Inc VAT)</th>

                             

                              <th class="goodreturncolor">Product Description</th>

                              <th class="goodreturncolor">Pack Size</th>

                              <th class="goodreturncolor">Qty</th>

                              <th class="goodreturncolor">Reason Code</th>

                          </tr>';
            if (!empty($tbl_sell_bill))
                {
                $total_inc = "0";
                $vat_value = "0";
                foreach($tbl_sell_bill as $data)
                    {
                    $html.= '<tr>

                                        <td>' . $data->pro_description . '</td>

                                        <td>' . $data->pack_size . '</td>

                                        <td>' . $data->batch_number . '</td>

                                        <td class="expiry_datebg">' . $data->expiry_date . '</td>

                                        <td>' . $data->quantity . '</td>

                                        <td class="qtysent">' . $data->quantity . '</td>

                                        <td>£' . $data->net_price . '</td>

                                        <td>£' . $data->total_price . '</td>

                                        <td>' . $data->vat . '</td>';

                    // count vat value

                    $vat_value = $data->total_price * $data->vat / 100;

                    // total inc

                    $total_inc = $data->total_price + $vat_value;
                    $html.= '<td>' . $vat_value . '</td>

                                        <td class="bordercolor">£' . $total_inc . '</td>

                                        

                                        <td class="goodreturncolor">' . $data->pro_description . '</td>

                                        <td class="goodreturncolor">' . $data->pack_size . '</td>

                                        <td class="goodreturncolor">' . $data->quantity . '</td>

                                        <td class="goodreturncolor"> </td>

                                      </tr>';
                    }
                }

            if (!empty($tbl_sell_bill))
                {
                $total_quantity = "0";
                $total_price = "0";
                $total_inc_grant = "0";
                foreach($tbl_sell_bill as $value)
                    {
                    if ($value->quantity)
                        {
                        $total_quantity+= $value->quantity;
                        }
                      else
                        {
                        $total_quantity = "0";
                        }

                    if ($value->total_price)
                        {
                        $total_price+= $value->total_price;
                        }
                      else
                        {
                        $total_price = "0";
                        }

                    // calculate grant total

                    $vat_value = $value->total_price * $value->vat / 100;
                    $total_inc_grant+= $value->total_price + $vat_value;
                    }

                /* echo $total_quantity;
                echo "<br />";
                echo $total_price;
                die(); */
                }

            $html.= '<tr>

                            <td colspan="5"></td>

                            <td>' . $total_quantity . '</td>

                            <td></td>

                            <td>£' . $total_price . '<td>

                            <td>#######</td>

                            <td class="bordercolor">£' . $total_inc_grant . '</td>

                            <td class="goodreturncolor">0</td>

                            <td class="goodreturncolor">0 </td>

                            <td class="goodreturncolor">0 </td>

                            <td class="goodreturncolor"></td>

                          </tr>';
            $html.= '<tr class="noBorder">

                            <td colspan="3">

                              <p>Customer A/C No: ' . $tbl_sell_bill[0]->cust_ac_number . ' <br />

                               Customer address : ' . $tbl_sell_bill[0]->delivery_address . '<br />

                                </p> 

                            </td>

                            <td colspan="4">

                              A/C Name:   asasas  <br />

                              Account No: ' . $tbl_sell_bill[0]->cust_ac_number . ' <br />

                              Sort Code:  232323

                            </td>

                            <td colspan="4" class="bordercolor">

                                Order Checked by:--------------------<br /><br />

                                Driver Signature:----------------------</td>';
            $html.= '<td colspan="2"  class="returncolor dashline">

                              <p>Reason code:<br />';
            $reasoncodes_list = $tbl_sell_bill[0]->reason_code;
            if (!empty($reasoncodes_list))
                {
                $matchcode = explode(",", $reasoncodes_list);
                foreach($matchcode as $value)
                    {
                    if ($value == "a")
                        {
                        $html.= 'A Incorrect Goods Received<br />';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "b")
                        {
                        $html.= 'B Price Discrepancy<br />';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "c")
                        {
                        $html.= 'C Expired Stock<br/>';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "d")
                        {
                        $html.= 'D Missing Goods <br />';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "e")
                        {
                        $html.= 'E Damaged Goods <br />';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "f")
                        {
                        $html.= 'F Goods received but not ordered <br />';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "g")
                        {
                        $html.= 'G Goods ordered in error <br />';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "h")
                        {
                        $html.= 'H Product Recall</p>';
                        }
                    }
                }

            $html.= '</td>';
            $html.= '<td colspan="2"  class="returncolor">

                                 <p>Signature:</p>

                            </td>

                          </tr>';
            $html.= '</table>';
            $html.= '</html>';

            // generate

            $dompdf->loadHtml($html);

            // $dompdf->setPaper('A4', 'fullpage');
            // $dompdf->setPaper('A4', 'landscape');
            // $dompdf->set_paper(DEFAULT_PDF_PAPER_SIZE, 'portrait');

            $paper_size = array(0, 0, 1300, 768);
            $dompdf->set_paper($paper_size);
            $dompdf->render();
            $dompdf->stream("billpdffile.pdf", array(
                'Attachment' => 0
            ));

            // save

            $pdf = $dompdf->output('I');
            $success = file_put_contents(($savein . 'bill.pdf') , $pdf);
            }else{
                return redirect('sellbilldetails/makesellbill');
            }
        }

    // onload event count product

    public function sell_product_price()
        {
        //         if (!empty($_POST['sku'])) {
        //            $sku = $_POST['sku'];
        //            $product = $this->db->where('product_sku', $sku)->get('tbl_inventory')->row();
        //            $price =  $product->price;
        //
        //            $sellchange = array('netprice' => $price);
        //
        //              $data =  json_encode($sellchange);
        //              echo  $data; ->where("quantity > '0'")
        //        }

        $key = $this->input->post();
        // $data = $this->db->like('product_sku', $key['keyword'])->where("quantity > '0'")->get('tbl_inventory')->result();
        $data = $this->db->like('product_name', $key['keyword'])->where("quantity > '0'")->get('tbl_inventory')->result();
        // echo $this->db->last_query();
        // exit();

        if (!empty($data)){ ?>
            <ul id="country-list">
            <?php  foreach($data as $val) { ?>
                    <li onClick="selectCategory('<?php
                echo $val->product_name . '/' . $val->price . '/' . $val->id . '/' . $val->pack_size . '/' . $val->product_sku; ?>');">
                <?php
                echo $val->product_name; ?></li>
                <?php
                } ?>
            </ul>
            <?php
            }
        }


    public function generat_bil(){
        require_once APPPATH . 'libraries/dompdf/lib/html5lib/Parser.php';
        require_once APPPATH . 'libraries/phenx/php-font-lib/src/FontLib/Autoloader.php';
        require_once APPPATH . 'libraries/phenx/php-svg-lib/src/autoload.php';
        require_once APPPATH . 'libraries/dompdf/src/Autoloader.php';
        Dompdf\Autoloader::register();
        $dompdf = new \Dompdf\Dompdf();

       /* if($_POST){
            $bill_id = $_POST['id'];
         }*/
         /*echo "sdsd";
          echo  $id = $this->uri->segment(3);
          die();*/

        $tbl_sell_bill = $this->db->where('bill_number', $bill_id)->get('tbl_sell_bill')->result();
        // // echo $this->db->last_query();
        // exit();
        /* echo "<pre>";
        print_r($tbl_sell_bill);
        die(); */
        if (!empty($tbl_sell_bill)){
            $customer_data = $this->supplierdata($tbl_sell_bill[0]->customer_id);
            // print_r($customer_data->first_name);

            /* echo "<pre>";
            print_r($customer_data);
            die(); */
            foreach($tbl_sell_bill as $value)
                {
                if (!empty($value->product_id))
                    {
                    $product_name = $this->productdata($value->product_id);
                    if (!empty($product_name->product_name))
                    {
                        $name = $product_name->product_name;
                    }else{
                        $name = " ";
                    }

                    $value->product_name = $name;
                    }
                }

            // bill created date

            $date = date_create($tbl_sell_bill[0]->created_date);
            $bill_date = date_format($date, "d-m-Y");
            /*  echo "<pre>";
            print_r($tbl_sell_bill);
            die(); */
            $html = '';
            $html.= '<style>

                          table {

                              width: 100%;

                              border-collapse: collapse;

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

                     </style>';
            $html.= '<html lang="en">';
            $html.= '<table style="">

                          <tr class="noBorder">

                            <td colspan="3">

                              <h3 class="returncolor">SNA PHARMA</h3>

                              <address contenteditable>

                                <p>17 The Broadway, Wood Green, London, N22 6DS, </p>

                                <p> Phone 0208 8888 1605 </p>

                                <p> email: isha@greenwoodspharmacy.co.uk</p>

                              </address> 

                                <p> VAT Reg No: ' . $tbl_sell_bill[0]->vat_reg_number . '</p>

                            </td>

                            <td colspan="4" class="returncolor" style=" border-left: 0px solid;">

                                page 1 of 1

                            </td>

                            <td colspan="4" class="bordercolor">

                                 <p>INVOICE :  ' . $tbl_sell_bill[0]->bill_number . '</p>

                                 <p>INVOICE DATE :  ' . $bill_date . '</p>

                            </td>

                            <td colspan="2"  class="returncolor dashline">

                                 <h3>GOODS RETURN NOTE</h3>

                                  <address contenteditable>

                                    <p>Date : ' . $bill_date . ' <br />

                                    Invoice No: ' . $tbl_sell_bill[0]->bill_number . '</p>

                                    <p>customer name : ' . $customer_data->first_name . ' ' . $customer_data->last_name . ' 

                                    <br />address : ' . $tbl_sell_bill[0]->delivery_address . '  

                                    <br />' . $tbl_sell_bill[0]->cust_ac_number . ' </p>

                                  </address>

                             </td>

                            <td colspan="2"  class="returncolor">

                                <h3>SNA PHARMA</h3>

                                <address contenteditable>

                                    <p>17 The Broadway,<br /> Wood Green, <br /> London, N22 6DS, </p>

                                </address> 

                             </td>

                          </tr>



                          <tr>

                             <th class="tblheadcolor">Description</th>

                             <th class="tblheadcolor">Pack size</th>

                             <th class="tblheadcolor">Batch Num</th>

                             <th class="tblheadcolor">Exp Date</th>

                             <th class="tblheadcolor">Qty Ord</th>

                             <th class="tblheadcolor">Qty Sent</th>

                             <th class="tblheadcolor">Unit Cost</th>

                             <th class="tblheadcolor">Net Goods</th>

                             <th class="tblheadcolor">Vat %</th>

                             <th class="tblheadcolor">VAT Value</th>

                             <th class="tblheadcolor bordercolor">Total (Inc VAT)</th>

                             

                              <th class="goodreturncolor">Product Description</th>

                              <th class="goodreturncolor">Pack Size</th>

                              <th class="goodreturncolor">Qty</th>

                              <th class="goodreturncolor">Reason Code</th>

                          </tr>';
            if (!empty($tbl_sell_bill))
                {
                foreach($tbl_sell_bill as $data)
                    {
                    $html.= '<tr>

                                        <td>' . $data->pro_description . '</td>

                                        <td>' . $data->pack_size . '</td>

                                        <td>' . $data->batch_number . '</td>

                                        <td class="expiry_datebg">' . $data->expiry_date . '</td>

                                        <td>' . $data->quantity . '</td>

                                        <td class="qtysent">' . $data->quantity . '</td>

                                        <td>£' . $data->net_price . '</td>

                                        <td>£' . $data->total_price . '</td>

                                        <td>' . $data->vat . '</td>';

                    // count vat value

                    $vat_value = $data->total_price * $data->vat / 100;

                    // total inc

                    $total_inc = $data->total_price + $vat_value;
                    $html.= ' <td>' . $vat_value . '</td>



                                        <td class="bordercolor">£' . $total_inc . '</td>

                                        

                                        <td class="goodreturncolor">' . $data->pro_description . '</td>

                                        <td class="goodreturncolor">' . $data->pack_size . '</td>

                                        <td class="goodreturncolor">' . $data->quantity . '</td>

                                        <td class="goodreturncolor"> </td>

                                      </tr>';
                    }
                }

            if (!empty($tbl_sell_bill))
                {
                $total_quantity = "0";
                $total_price = "0";
                $total_inc_grant = "0";
                foreach($tbl_sell_bill as $value)
                    {
                    if ($value->quantity)
                        {
                        $total_quantity+= $value->quantity;
                        }
                      else
                        {
                        $total_quantity = "0";
                        }

                    if ($value->total_price)
                        {
                        $total_price+= $value->total_price;
                        }
                      else
                        {
                        $total_price = "0";
                        }

                    // calculate grant total

                    $vat_value = $value->total_price * $value->vat / 100;
                    $total_inc_grant+= $value->total_price + $vat_value;
                    }
                }

            $html.= '<tr>

                            <td colspan="5"></td>

                            <td>' . $total_quantity . '</td>

                            <td></td>

                            <td>£' . $total_price . '<td>

                            <td>#######</td>';
            $html.= '<td class="bordercolor">£' . $total_inc_grant . '</td>';
            $html.= '<td class="goodreturncolor">0</td>

                            <td class="goodreturncolor">0 </td>

                            <td class="goodreturncolor">0 </td>

                            <td class="goodreturncolor"></td>

                          </tr>';
            $html.= '<tr class="noBorder">

                            <td colspan="3">

                              <p>Customer A/C No: ' . $tbl_sell_bill[0]->cust_ac_number . ' <br />

                               Customer address : ' . $tbl_sell_bill[0]->delivery_address . '<br />

                                </p> 

                            </td>

                            <td colspan="4">

                              A/C Name:   ' . $tbl_sell_bill[0]->account_name . '  <br />

                              Account No: ' . $tbl_sell_bill[0]->cust_ac_number . ' <br />

                              Sort Code:  ' . $tbl_sell_bill[0]->sort_code . '

                            </td>

                            <td colspan="4" class="bordercolor ">

                                Order Checked by:--------------------<br /><br />

                                Driver Signature:----------------------</td>';
            $html.= '<td colspan="2"  class="returncolor dashline">

                              <p>Reason code:<br />';
            $reasoncodes_list = $tbl_sell_bill[0]->reason_code;
            if (!empty($reasoncodes_list))
                {
                $matchcode = explode(",", $reasoncodes_list);
                foreach($matchcode as $value){
                    if ($value == "a")
                        {
                        $html.= 'A Incorrect Goods Received<br />';
                        }
                    }
                foreach($matchcode as $value){
                    if ($value == "b")
                        {
                        $html.= 'B Price Discrepancy<br />';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "c")
                        {
                        $html.= 'C Expired Stock<br />';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "d")
                        {
                        $html.= 'D Missing Goods <br />';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "e")
                        {
                        $html.= 'E Damaged Goods <br />';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "f")
                        {
                        $html.= 'F Goods received but not ordered <br />';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "g")
                        {
                        $html.= 'G Goods ordered in error <br />';
                        }
                    }

                foreach($matchcode as $value)
                    {
                    if ($value == "h")
                        {
                        $html.= 'H Product Recall</p>';
                        }
                    }
                }

            $html.= '</td>';
            $html.= '<td colspan="2"  class="returncolor">

                                 <p>Signature:</p>

                            </td>

                          </tr>';
            $html.= '</table>';
            $html.= '</html>';
            // generate
            $dompdf->loadHtml($html);
            // $dompdf->setPaper('A4', 'fullpage');
            // $dompdf->setPaper('A4', 'landscape');
            // $dompdf->set_paper(DEFAULT_PDF_PAPER_SIZE, 'portrait');
            $paper_size = array(0,0,1300,768);
            $dompdf->set_paper($paper_size);
            $dompdf->render();
            $dompdf->stream("billpdffile.pdf", array(
                'Attachment' => 0
            ));

            // save

            $pdf = $dompdf->output('I');
            $success = file_put_contents(($savein . 'bill.pdf') , $pdf);
            }
          else
            {
            return redirect('sellbilldetails/makesellbill');
            }
        }

    // delete bill

    public function delete_bill(){
        if ($_POST['id']){
            $id = $_POST['id'];
           //die();
        }

        $billid = ['invoice_no' => $id];
        $billtbl = $this->Dbmodel->delete_db($billid, 'tbl_invoice');
        $this->Dbmodel->delete_db($billid, 'tbl_invoice_item');
        /*  echo $this->db->last_query();
        exit(); */
        if (!empty($billtbl)){
             return redirect('sellbilldetails');
            }
    }


    /*
    * New Code
    *
    */
    public function makesellbill(){
        $loginid = $this->session->userdata('login_id');
        if (!empty($loginid)){
            $post = $this->input->post();
            if (!empty($post['addbill'])){
                // Invoice No

                $invoice = $this->Dbmodel->getInvocieNo();
                if (isset($invoice) && count($invoice) > 0){
                         $invNo = explode('-', $invoice->invoice_no);
                          $n = str_pad($invNo[1] + 1, 5, 0, STR_PAD_LEFT);
                }else{
                    $n = "00001";
                }

                $in = "IN-" . $n;
                // bill numbere

               /* $reasonCode = "";
                for ($i = 0; $i < count($post['reason_code']); $i++)
                {
                    $reasonCode.= $post['reason_code'][$i] . ',';
                }*/
                //                echo '<pre>';
                //                echo $in.'<br/>'.$reasonCode;
                //                print_r($post); 'description' => $post['pro_description'][$i] 'reason_code' => $reasonCode,
                //                exit();

                $invoice = ['user_id' => $loginid,'invoice_date' => date('Y-m-d') , 'invoice_no' => $in, 'customer_id' => $post['customer_name'], 'sub_total' => $post['sub_Total'], 'total_vat' => $post['totalvat'],];

                if ($result = $this->Dbmodel->_postInvoice($invoice))
                {
                    for ($i = 0; $i < count($post['product_name']); $i++){
                       /* echo "<pre>";
                        print_r($post);
                        die();*/
                        $qty = $post['quantity'][$i];
                        $sku = $post['product_number'][$i];
                        $invoice_item = ['user_id' => $loginid,'invoice_no' => $in, 'product_id' => $post['c_id'][$i],'qty' => $post['quantity'][$i], 'rate' => $post['price'][$i], 'vat' => $post['vat'][$i], 'total' => $post['total'][$i]];

                        $product_detail = $this->db->select('*')->where('product_sku', $sku)->get('tbl_inventory')->row();
                       
                        if (!empty($product_detail)){
                            $pid = $product_detail->id;
                            $total_quantity = $product_detail->quantity;
                            $deduct_sell_quantity = ($total_quantity - $qty);
                            $proid = ['id' => $pid];
                            $stock = array(
                                'quantity' => $deduct_sell_quantity,
                            );
                            $updatesuccess = $this->Dbmodel->update_db($proid, 'tbl_inventory', $stock);
                        }
                            //add 
                            $invoiceItems = $this->Dbmodel->_postInvoiceItem($invoice_item);
                        }
                    }
               /*  $invoice_no = array( 'invoice_no' => $in);
                 $this->session->set_userdata($invoice_no);*/
               // return redirect('sellbilldetails/invoice');
                 ?>
                  <script type="text/javascript">
                         window.location.href = "<?php echo base_url('sellbilldetails/invoice/'.$in); ?>";
                   </script>
                <?php
            }
            // }

            $suppliers = $this->Dbmodel->getsupplier();
            $inventorycategory = $this->Dbmodel->getinventorycategory();
            $inventorydetail = $this->db->select('*')->from('tbl_inventory')->get()->result_array();

            // module to give permission
            $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
            $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
            $report_permi = $this->Dbmodel->get_report_permissions($loginid);
            $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

            // get vat
            // $userdata =  $this->userdata($loginid);

            $sellvat = $this->Dbmodel->getsellvat();
            /* echo "<pre>";
            print_r($userdata); */
            $this->load->view('sellbilldetails/makesellbill', array(
                'inventory_permi' => $inventory_permi,
                'sell_permi' => $sell_permi,
                'report_permi' => $report_permi,
                'bill_permi' => $bill_permi,
                'inventoryname' => $inventorydetail,
                'sellvat' => $sellvat,
                'customer' => $suppliers
            ));
            }else{
                 return redirect();
            }
        }

    public function invoice(){
        //$id = $this->session->userdata('invoice_no');
         $loginid = $this->session->userdata('login_id');
        $id = $this->uri->segment(3);
        if (isset($id) && $id != ''){
            $customer = $this->Dbmodel->_getCustomerInfo($id);
            $invoice = $this->Dbmodel->_getInvoice($id);
            $invoiceItem = $this->Dbmodel->_getInvoiceItem($id);
            $userdata  =  $this->userdata($loginid);
            //            print_r($customer);
            //            print_r($invoice);
            //            print_r($invoiceItem);
            //            exit();
            //user wise permission
            $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
            $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
            $report_permi = $this->Dbmodel->get_report_permissions($loginid);
            $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

            $this->load->view('sellbilldetails/invoice', ['customer' => $customer, 'invoice' => $invoice, 'invoiceItem' => $invoiceItem,'userdata'=>$userdata,'inventory_permi' => $inventory_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi,'sell_permi' => $sell_permi]);
            }else{
              return $this->index();
            }
    }

    public function generat_bill_pdf(){
        require_once APPPATH . 'libraries/dompdf/lib/html5lib/Parser.php';
        require_once APPPATH . 'libraries/phenx/php-font-lib/src/FontLib/Autoloader.php';
        require_once APPPATH . 'libraries/phenx/php-svg-lib/src/autoload.php';
        require_once APPPATH . 'libraries/dompdf/src/Autoloader.php';
        Dompdf\Autoloader::register();
        $dompdf = new \Dompdf\Dompdf();

        $in_no = $this->uri->segment(3);
        $loginid = $this->session->userdata('login_id');
        if (isset($in_no) && $in_no != ''){
            $customer = $this->Dbmodel->_getCustomerInfo($in_no);
            $invoice = $this->Dbmodel->_getInvoice($in_no);
            $invoiceItem = $this->Dbmodel->_getInvoiceItem($in_no);
            $userdata  =  $this->userdata($loginid);
                       // echo "<pre>";
                         //print_r($customer);
                        //print_r($invoice);
                       // print_r($invoiceItem);
                      // exit();
        }
          
            $html = '';
            $html.= '<style>
                          table {
                              width: 100%;
                              border-collapse: collapse;
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

                     </style>';
                     if(!empty($userdata->address)){
                        $text = $userdata->address;
                     }else{
                        $text = "";
                     }     
            $html.= '<html lang="en">';
            $html.= '<table style="">
                          <tr class="noBorder">
                            <td colspan="3">
                              <h3 class="returncolor">SNA PHARMA</h3>
                              <p>'. $newtext = wordwrap($text, 20, "<br />\n").'</p>
                                <p> VAT Reg No: ' . $customer->vat_no . '</p>
                            </td>
                            <td colspan="4" class="returncolor" style=" border-left: 0px solid;">
                                page 1 of 1
                            </td>
                            <td colspan="4" class="bordercolor">
                                 <p>INVOICE :  ' . $invoice->invoice_no . '</p>
                                 <p>INVOICE DATE :  ' . $invoice->invoice_date . '</p>
                            </td>
                            <td colspan="2"  class="returncolor dashline">
                                 <h3>GOODS RETURN NOTE</h3>
                                  <address contenteditable>
                                    <p>Date : ' . $invoice->invoice_date . ' <br />
                                    Invoice No: ' . $invoice->invoice_no . '</p>
                                    <p>customer name : ' . $customer->first_name . ' ' . $customer->last_name . ' 
                                    <br />address : ' . $customer->delivery_address . '  
                                    <br />' . $customer->cust_account_number . ' </p>
                                  </address>
                             </td>
                            <td colspan="2"  class="returncolor">
                                <h3>SNA PHARMA</h3>
                                <address contenteditable>
                                    <p>17 The Broadway,<br /> Wood Green, <br /> London, N22 6DS, </p>
                                </address> 
                             </td>
                          </tr>
                          <tr>
                            
                             <th class="tblheadcolor" colspan="4">Pack size</th>
                            
                             <th class="tblheadcolor" colspan="2">Qty</th>
                             <th class="tblheadcolor">Unit Cost</th>
                             <th class="tblheadcolor">Net Goods</th>
                             <th class="tblheadcolor">Vat %</th>
                             <th class="tblheadcolor">VAT Value</th>
                             <th class="tblheadcolor bordercolor">Total (Inc VAT)</th>
            
                              
                              <th class="goodreturncolor">Pack Size</th>
                              <th class="goodreturncolor">Qty</th>
                              <th class="goodreturncolor" colspan="2">Reason Code</th>
                          </tr>';
            if (!empty($invoiceItem)){
                foreach($invoiceItem as $data){
                   /* echo "<pre>";
                    print_r($data);
                    die();*/
                    $html.= '<tr>
                               
                                <td colspan="4">' . $data->pack_size . '</td>
                               
                                
                                <td class="qtysent" colspan="2">' . $data->qty . '</td>
                                <td>£' . $data->rate . '</td>
                                <td>£' . $data->rate * $data->qty . '</td>
                                <td>' . $data->vat . '</td>';
                    // count vat value
                    $vat_value = ($data->rate * $data->qty) * $data->vat / 100;
                    // total inc
                    $total_inc = ($data->rate * $data->qty) + $vat_value;
                    $html.= ' <td>' . $vat_value . '</td>
                                <td class="bordercolor">£' . $total_inc . '</td>
                               
                                <td class="goodreturncolor">' . $data->pack_size . '</td>
                                <td class="goodreturncolor">' . $data->qty . '</td>
                                <td class="goodreturncolor" colspan="2"> </td>
                              </tr>';
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

            $html.= '<tr>
                            <td colspan="4"></td>
                            <td colspan="2">' . $total_quantity . '</td>
                            <td></td>
                            <td>£' . $total_price . '<td>
                            <td>£'.$total_vat.'</td>';

                    $html.= '<td class="bordercolor">£' . $total_inc_grant . '</td>';
                    $html.= '<td class="goodreturncolor">0</td>
                            <td class="goodreturncolor">0 </td>
                            <td class="goodreturncolor" colspan="2">0 </td>
                            
                          </tr>';
            $html.= '<tr class="noBorder">
                            <td colspan="3">
                              <p>Customer A/C No: ' . $customer->cust_account_number . ' <br />
                               Customer address : ' . $customer->delivery_address . '<br />
                              </p> 
                            </td>
                            <td colspan="4">
                              A/C Name:   ' . $customer->cust_account_number . '  <br />
                              Account No: ' . $customer->cust_account_number . ' <br />
                              Sort Code:  ' . $customer->sort_code . '
                            </td>
                            <td colspan="4" class="bordercolor ">
                                Order Checked by:--------------------<br /><br />
                                Driver Signature:----------------------</td>';
            $html.= '<td colspan="2"  class="returncolor dashline">
                              <p>Reason code:<br />
                              A Incorrect Goods Received<br>
                              B Price Discrepancy<br>
                              C Expired Stock<br>
                              D Missing Goods <br>
                              E Damaged Goods <br>
                              F Ordered in error <br>
                              G Product Recall <br>
                              H Other</p>';
         /*   $reasoncodes_list = $invoice->reason_code;
            if (!empty($reasoncodes_list)){
                $matchcode = explode(",", $reasoncodes_list);
                foreach($matchcode as $value){
                    if ($value == "a"){ $html.= 'A Incorrect Goods Received<br />'; }
                    if ($value == "b")
                    {
                     $html.= 'B Price Discrepancy<br />';
                    }
                    if ($value == "c"){
                      $html.= 'C Expired Stock <br />';
                    }
                    if ($value == "d"){
                      $html.= 'D Missing Goods <br />';
                    }
                    if ($value == "e"){
                          $html.= 'E Damaged Goods <br />';
                    }   
                    if ($value == "f")
                    {
                      $html.= 'F Ordered in error <br />';
                    }
                    if ($value == "g")
                    {
                     $html.= 'G Goods ordered in error <br />';
                    }
                    if ($value == "h")
                    {
                        $html.= 'H Product Recall</p>';
                    }
                }
            }*/
            $html.= '</td>';
            $html.= '<td colspan="2"  class="returncolor">
                                 <p>Signature:</p>
                     </td></tr>';
            $html.= '</table>';
            $html.= '</html>';
            // generate
            $dompdf->loadHtml($html);
            // $dompdf->setPaper('A4', 'fullpage');
            // $dompdf->setPaper('A4', 'landscape');
            // $dompdf->set_paper(DEFAULT_PDF_PAPER_SIZE, 'portrait');
            $paper_size = array(0,0,1300,768);
            $dompdf->set_paper($paper_size);
            $dompdf->render();
            $dompdf->stream("billpdffile.pdf", array(
                'Attachment' => 0
            ));

            // save
            $pdf = $dompdf->output('I');
            if($pdf){
                 $success = file_put_contents(($savein . 'bill.pdf') , $pdf);
            }else{
                 return redirect('sellbilldetails/makesellbill');
            }
        }


    public function updatesellbill() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
           $id = $this->uri->segment(3);

            $post = $this->input->post();
            if (!empty($post['updatebill'])){
               /* echo "<pre>";
                print_r($post);
                die();*/
                //vat percentage
                $product_id = $post['c_id'];
                for ($i = 0; $i < count($product_id); $i++) {
                    //using update
                    $invoice_item_id = $post['invoice_item_id'][$i];
                    $id_item = ['id' => $invoice_item_id];

                    $pro_id = $post['c_id'][$i];
                    //$pro_description = $post['pro_description'][$i];   
                    $quantity = $post['quantity'][$i];
                    $vat = $post['vat'][$i];
                    $total = $post['total'][$i];
                    //rate
                    $price = $post['price'][$i];

                    //stock maintent
                    $id_stock = ['id' => $pro_id];
                    $product_detail = $this->db->select('*')->where('id', $pro_id)->get('tbl_inventory')->row();

                    //current qty get 
                    $in_number = $post['invoice_no'];
                    $curent_qty_detail = $this->db->select('id,qty')->where("(invoice_no = '$in_number' AND product_id = '$pro_id')")->get('tbl_invoice_item')->row();
                    $current_qty = $curent_qty_detail->qty;

                    /*echo "<pre>";
                    print_r($curent_qty_detail);
                    die();*/

                    if($current_qty != $quantity){
                        if(!empty($product_detail)){
                            $total_quantity = $product_detail->quantity;

                            if($current_qty < $quantity){
                                 $deduct_sell_quantity = $total_quantity - $quantity;
                            }else{
                                 $deduct_sell_quantity = $total_quantity + $quantity;
                            }

                            $stock = array(
                                'quantity' => $deduct_sell_quantity,
                            );
                            $this->Dbmodel->update_db($id_stock, 'tbl_inventory', $stock);
                            /*echo $this->db->last_query();
                            exit();*/
                        }
                    }
                    //=================================== 
                    // update invoice
                    $tbl_invoice_item = array(
                            'product_id' => $pro_id,
                           // 'description' => $pro_description,
                            'qty' => $quantity,
                            'rate' => $price,
                            'vat' => $vat,
                            'total' => $total,
                            );
                    $this->Dbmodel->update_db($id_item, 'tbl_invoice_item', $tbl_invoice_item);
                    //if new item add then
                  if(empty($curent_qty_detail)){
                        $tbl_new_invoice_item = array(
                            'user_id' => $loginid,
                            'invoice_no' => $in_number,
                            'product_id' => $pro_id,
                            //'description' => $pro_description,
                            'qty' => $quantity,
                            'rate' => $price,
                            'vat' => $vat,
                            'total' => $total,
                            );
                    $success = $this->Dbmodel->insert_db('tbl_invoice_item', $tbl_new_invoice_item);
                  }
                }


                $i_no = $post['invoice_no'];
                $id_in = ['invoice_no' => $i_no];
                //
                $customer_id = $post['customer_name'];
                $sub_Total = $post['sub_Total'];
                $totalvat = $post['totalvat'];
                /*$reason_code = $post['reason_code'];
                if(!empty($reason_code)){
                    $code = implode(",", $reason_code);
                    $reasoncode = ltrim($code,',');
                }else{
                    $reasoncode = "";
                }*/
                $tbl_invoice = array(
                            'customer_id' => $customer_id,
                            'sub_total' => $sub_Total,
                            'total_vat' => $totalvat,
                           // 'reason_code' => $reasoncode,
                            'updated_date' => date("Y-m-d H:i:s"),
                            );
               $updatesuccess =  $this->Dbmodel->update_db($id_in, 'tbl_invoice', $tbl_invoice);
                if (!empty($updatesuccess)) {
                    $this->session->set_flashdata('Msg', "update successfully.");
                    $this->session->set_flashdata('Msg_class', 'success');
                     return redirect('sellbilldetails');
                } 
                /*echo $this->db->last_query();
                 exit();*/
            }

            if(isset($id) && $id != ''){
                $customer = $this->Dbmodel->_getCustomerInfo($id);
               
                $invoice = $this->Dbmodel->_getInvoice($id);
                $invoiceItem = $this->Dbmodel->_getInvoiceItem($id);
               /*  echo "<pre>";
                print_r($customer);
                die();*/
                $userdata  =  $this->userdata($loginid);

                foreach ($invoiceItem as $value) {
                    $pro_id =  $value->product_id;
                    $invoice_no = $value->invoice_no;
                    $product = $this->getproductdetail($pro_id);

                    $getinvoicitem = $this->getinvoicitem($pro_id,$invoice_no);
                   /* echo $this->db->last_query();
                    exit();*/
                    $value->product_sku = $product->product_sku;
                    //item table
                    $value->qty = $getinvoicitem->qty;
                    $value->rate = $getinvoicitem->rate; 
                    $value->vat = $getinvoicitem->vat;
                    $value->total = $getinvoicitem->total;  

                }
                //as customer
                $suppliers = $this->Dbmodel->getsupplier();
                //user wise permission
                $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
                $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
                $report_permi = $this->Dbmodel->get_report_permissions($loginid);
                $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

                $this->load->view('sellbilldetails/updatesellbill', ['suppliers'=>$suppliers,'customer' => $customer, 'invoice' => $invoice, 'invoiceItem' => $invoiceItem,'userdata'=>$userdata,'inventory_permi' => $inventory_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi,'sell_permi' => $sell_permi]);
            }else{
                return redirect('sellbilldetails');
            }
        }else{
              return redirect('sellbilldetails');
        }
    }

    //credite note
      public function creditnote() {
        $loginid = $this->session->userdata('login_id');
       /* echo "<pre>";
        print_r($post['id']);
        die();*/
       //$id = $this->uri->segment(3);
         $post =  $this->input->post();

        if($post['id']){
            $id = $post['id'];
        }
        
        if(!empty($id)){
             $credite_note_data = $this->db->where('invoice_no', $id)->get('tbl_credit_note')->result();

              $invoice = $this->Dbmodel->_getInvoice($id);
              $invoiceItem = $this->Dbmodel->_getInvoiceItem($id);
               foreach ($invoiceItem as $value) {
                    $pro_id =  $value->product_id;
                    $invoice_no = $value->invoice_no;
                    $product = $this->getproductdetail($pro_id);
                   /* echo "<pre>";
                    print_r($product->product_name);
                    die();*/
                    $getinvoicitem = $this->getinvoicitem($pro_id,$invoice_no);
                    $value->product_sku = $product->product_sku;
                    $value->product_name = $product->product_name;
                    //item table
                    $value->qty = $getinvoicitem->qty;
                }
                /*  echo "<pre>";
                print_r($invoiceItem);
                die();*/
                 ?>
                  
                <div class="modal-dialog modal-lg">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal">&times;</button>
                      <h4 class="modal-title">Credite note</h4>
                    </div>
                    <div class="modal-body">
                      <?php /* echo "<pre>";
                      print_r($data);*/
                      //die(); ?>
                      <div class="row">
                             <form method="POST" id="formcreditenote" action="<?= base_url('sellbilldetails/addcreditnote'); ?>" enctype="multipart/form-data">
                                <div class="col-md-6">
                                  <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Product Name</label><br> 
                                        <?php 
                                        if(!empty($invoiceItem)){
                                        foreach ($invoiceItem as $value) { ?>
                                        <input type="text" class="form-control" readonly name="product_name[]" value="<?php echo $value->product_name; ?>">
                                         <input type="hidden" name="product_id[]" value="<?php echo $value->product_id; ?>">
                                        <br>
                                        <?php } } ?>
                                      </div>
                                  </div>
                                   <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Order quantity</label><br> 
                                        <?php
                                          if(!empty($invoiceItem)){
                                          foreach ($invoiceItem as $value) { ?>
                                            <input type="text" class="form-control" readonly name="order_qty[]" value="<?php echo $value->qty; ?>">
                                            <br>
                                        <?php } } ?>          
                                     </div>
                                  </div>
                                   <div class="col-md-4">
                                      <div class="form-group">
                                        <label>Sent quantity</label><br> 
                                        <?php if($credite_note_data){   
                                            foreach ($credite_note_data as $data) {
                                             /* echo "<pre>";
                                              print_r($credite_note_data);
                                              die();*/
                                          ?>
                                          <input type="hidden" name="id[]" value="<?php echo $data->id; ?>">
                                          <input type="text" class="form-control" name="sent_qty[]"  value="<?php echo $data->sent_qty; ?>">
                                              <br>
                                          <?php } }else{ ?> 
                                            <?php
                                            if(!empty($invoiceItem)){
                                            foreach ($invoiceItem as $value) { ?>
                                              <input type="text" class="form-control" name="sent_qty[]"  value="<?= set_value('sent_qty') ?>">
                                                <br>
                                            <?php } } ?> 
                                          <?php } ?>
                                     </div>
                                  </div>

                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label>Note</label>
                                       <textarea class="form-control" name="note" id="note" rows="4">
                                        <?php if(!empty($credite_note_data[0]->note)){ echo $credite_note_data[0]->note; } ?>
                                        <?= set_value('note') ?>
                                        </textarea>
                                  </div>
                              </div>
                              <input type="hidden" name="invoice_no" id="invoice_no" value="<?php echo $invoiceItem[0]->invoice_no; ?>">
                               <div class="col-md-12">
                                <?php if(!empty($credite_note_data[0]->note)){ ?>
                                      <div class="col-md-2">
                                        <button type="submit" name="updatecreditnote" value="updatecreditnote" id="updatecreditnote" class="btn btn-block btn-primary">Update</button>
                                      </div>
                                <?php }else{ ?> 
                                      <div class="col-md-2">
                                        <button type="submit" name="addcreditnote" value="addcreditnote" id="addcreditnote" class="btn btn-block btn-primary">Save</button>
                                      </div>
                                <?php } ?>
                                 <div class="col-md-2">
                                  <a href="<?= base_url('sellbilldetails'); ?>" class="btn btn-block btn-danger">Cancel</a>
                                </div>
                              </div>

                           </form>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
                <script type="text/javascript">
                    $("#formcreditenote").validate({
                        errorClass: 'error',
                        errorElement: 'span',
                        rules: {
                          "sent_qty[]": {required: true},
                          "note": {required: true},
                        },
                        messages: {
                          "sent_qty[]": {required: "This sent qty field is required."}, 
                          "note": {required: "This note field is required."}, 
                        }
                    });
              </script>
            <?php  
            }
    }

     public function addcreditnote() {
        $loginid = $this->session->userdata('login_id');
        $post =  $this->input->post();

        if(!empty($post['addcreditnote'])){
             $product_id = $post['product_id']; 
             $note = $post['note'];
             $invoice_no = $post['invoice_no'];
            for($i = 0; $i < count($product_id); $i++) {
                        $productid = $post['product_id'][$i];
                        $sentqty = $post['sent_qty'][$i];

                 $tbl_credit_note = array(
                        'user_id' => $loginid,
                        'product_id' => $productid,
                        'invoice_no' => $invoice_no,
                        'sent_qty' => $sentqty,
                        'note' => $note,
                        );
                $success = $this->Dbmodel->insert_db('tbl_credit_note', $tbl_credit_note);
            }
           if(!empty($success)) {
                   $this->session->set_flashdata('Msg', "Credit note successfully added.");
                   $this->session->set_flashdata('Msg_class', 'success');
                  return redirect('sellbilldetails');
            }
        }
        //update
        if(!empty($post['updatecreditnote'])){
             $product_id = $post['product_id']; 
             $note = $post['note'];
            for($i = 0; $i < count($product_id); $i++) {
                        $productid = $post['product_id'][$i];
                        $crid =  $post['id'][$i];
                        $id = ['id' => $crid];

                        $sentqty = $post['sent_qty'][$i];

                 $tbl_credit_note = array(
                        'sent_qty' => $sentqty,
                        'note' => $note);

                $updatesuccess =  $this->Dbmodel->update_db($id, 'tbl_credit_note', $tbl_credit_note);
            }
           if(!empty($updatesuccess)) {
                   $this->session->set_flashdata('Msg', "Credit note update successfully added.");
                   $this->session->set_flashdata('Msg_class', 'success');
                  return redirect('sellbilldetails');
            }
        }
     }


}