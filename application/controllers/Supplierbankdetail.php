<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
  bank detail supplier  controlles
  call model in dbmodel
 */

class Supplierbankdetail extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
    	$loginid = $this->session->userdata('login_id');
    	if(!empty($loginid)){

              $supplierbankdetail = $this->db->select('supplier_bankdetail.*,tbl_supplier.first_name,tbl_supplier.last_name')
                    ->from('supplier_bankdetail')
                    ->join('tbl_supplier','tbl_supplier.id=supplier_bankdetail.supplier_id', 'left')
                    ->order_by('supplier_bankdetail.id', 'DESC')
                    ->get()->result();
          /* echo "<pre>";
           print_r($supplierbankdetail);
           die();*/
          
           // $supplierbankdetail = $this->db->select('*')->from('supplier_bankdetail')->get()->result_array();

                $suppliers = $this->Dbmodel->getsupplier();
                // $permission = $this->permission($loginid); 
                $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
                 
                 //all permistion modul wise
                $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
                $report_permi = $this->Dbmodel->get_report_permissions($loginid);
                $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

    		$this->load->view('supplierbankdetail/supplierbankdetail',
             array('supplierbankdetail' => $supplierbankdetail,
              'inventory_permi' => $inventory_permi,
              'report_permi'=>$report_permi,
              'bill_permi'=>$bill_permi,
              'sell_permi' => $sell_permi,
              'suppliers'=>$suppliers));
    	}else{
    		return redirect();
    	}
    }

     public function addsupplierbankdetail() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
            $post =  $this->input->post();
             $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
             if ($this->form_validation->run('addsupplierbankdetail')) {
                 if(!empty($post['addsupplierbankdetail'])){

                        $supplier_id = $post['supplier_id'];
                        $sort_code = $post['sort_code'];
                        $account_number = $post['account_number'];
                        $bank_name = $post['bank_name'];
                        $bank_branch = $post['bank_branch'];
                        $trade_references_1 = $post['trade_references_1'];
                        $trade_references_2 = $post['trade_references_2'];
                        $invoice_address = $post['invoice_address'];
                        $delivery_address = $post['delivery_address'];
                        $gphc_number = $post['gphc_number'];
                       
                        $data = array(
                            'user_id' => $loginid,
                            'supplier_id' => $supplier_id,
                            'sort_code' => $sort_code,
                            'account_number' => $account_number,
                            'bank_name' => $bank_name,
                            'bank_branch' =>  $bank_branch,
                            'trade_references_1' => $trade_references_1,
                            'trade_references_2' => $trade_references_2,
                            'invoice_address' => $invoice_address,
                            'delivery_address' => $delivery_address,
                            'gphc_number' => $gphc_number,
                        );
                        $success = $this->Dbmodel->insert_db('supplier_bankdetail', $data);
                        $supbankid = $this->db->insert_id();

                        if (!empty($success)) {
                                $this->session->set_flashdata('Msg', "Supplier bankdetail successfully added.");
                                $this->session->set_flashdata('Msg_class', 'success');
                                return redirect('supplierbankdetail');
                        }
                   }
             }
              $suppliers = $this->Dbmodel->getsupplier();
             /* echo "<pre>";
              print_r($inventorycategory);
              die();*/

           //all permistion modul wise
            $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
            $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
            $report_permi = $this->Dbmodel->get_report_permissions($loginid);
            $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

            $this->load->view('Supplierbankdetail/addsupplierbankdetail',
              ['suppliers' => $suppliers,
              'inventory_permi' => $inventory_permi,
              'sell_permi'=>$sell_permi,
              'report_permi'=>$report_permi,
              'bill_permi'=>$bill_permi]);
        }else{
            return redirect();
        }
    }

    // delete user
    public function delete_supplierbankdetail() {
         if($_POST['id']){
             $id =  $_POST['id'];
         }
         $supplierbankid = ['id' => $id];
         $supplier_bankdetailtbl = $this->Dbmodel->delete_db($supplierbankid,'supplier_bankdetail');
         //exit();
         if (!empty($supplier_bankdetailtbl)) {
                return redirect('supplierbankdetail');
        }
    }

    // update user
    public function updatesupplierbankdetail() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
           $sup_bankid = $this->uri->segment(3);
           $this->session->unset_userdata('supplier_bankid');

           //store the id in session
           $post =  $this->input->post();
           if(!empty($post)){
                $supplier_bankid =  $post['supplier_bankid'];
                $data = array(
                        'supplier_bankid' => $supplier_bankid,
                        );
                $this->session->set_userdata($data);
                $sup_bankid = $this->session->userdata('supplier_bankid');
            }

            $supplierbankdatadata = $this->db->select('*')->from('supplier_bankdetail')->where(['id' => $sup_bankid])->get()->row(); 
            $suppliers = $this->Dbmodel->getsupplier();
            $inventorycategory = $this->Dbmodel->getinventorycategory();
           // $this->load->view('inventorydetail/updateinventory', array('inventorydata' => $inventorydata,'suppliers' => $suppliers));
           
             $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
             if ($this->form_validation->run('addsupplierbankdetail')) {

                     if(!empty($post['updatesupplierbankdetail'])){

                            $inid =  $post['supplier_bankid'];
                            $id = ['id' => $inid];
                        
                            $supplier_id = $post['supplier_id'];
                            $sort_code = $post['sort_code'];
                            $account_number = $post['account_number'];
                            $bank_name = $post['bank_name'];
                            $bank_branch = $post['bank_branch'];
                            $trade_references_1 = $post['trade_references_1'];
                            $trade_references_2 = $post['trade_references_2'];
                            $invoice_address = $post['invoice_address'];
                            $delivery_address = $post['delivery_address'];
                            $gphc_number = $post['gphc_number'];
                           
                            $data = array(
                                'user_id' => $loginid,
                                'supplier_id' => $supplier_id,
                                'sort_code' => $sort_code,
                                'account_number' => $account_number,
                                'bank_name' => $bank_name,
                                'bank_branch' =>  $bank_branch,
                                'trade_references_1' => $trade_references_1,
                                'trade_references_2' => $trade_references_2,
                                'invoice_address' => $invoice_address,
                                'delivery_address' => $delivery_address,
                                'gphc_number' => $gphc_number,
                                'updated_date' => date("Y-m-d H:i:s"),
                            );
                            
                            $updatesuccess = $this->Dbmodel->update_db($id, 'supplier_bankdetail', $data);

                            if (!empty($updatesuccess)) {
                                $this->session->set_flashdata('Msg', "Successfully updated.");
                                $this->session->set_flashdata('Msg_class', 'success');
                                return redirect('supplierbankdetail');
                            }else{
                                return redirect('supplierbankdetail');
                            } 
                       }
                }
                ///all permistion modul wise
                $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
                $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
                $report_permi = $this->Dbmodel->get_report_permissions($loginid);
                $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

                $this->load->view('Supplierbankdetail/updatesupplierbankdetail',
                 array('supplierbankdatadata' => $supplierbankdatadata,
                  'suppliers' => $suppliers,
                  'inventorycategory'=>$inventorycategory,
                  'inventory_permi' => $inventory_permi,
                  'sell_permi'=>$sell_permi,
                  'report_permi'=>$report_permi,
                  'bill_permi'=>$bill_permi));
        }else{
            return redirect();
        }
    }

}
