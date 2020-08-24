<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
  Inventorydetail  controlles
  call model in dbmodel
 */

class Inventorydetail extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
    	$loginid = $this->session->userdata('login_id');
    	if(!empty($loginid)){

             $get =  $this->input->get();
             if(empty($get['start1']) && empty($get['end1'])){
                $inventorydetail = $this->db->select('tbl_inventory.*,tbl_supplier.first_name,tbl_supplier.last_name')
                    ->from('tbl_inventory')
                    ->where("tbl_inventory.quantity > '0'")
                    ->join('tbl_supplier','tbl_supplier.id=tbl_inventory.supplier_id', 'left')
                    ->order_by('tbl_inventory.id', 'DESC')
                    ->group_by('tbl_inventory.product_name')
                    ->get()->result();
            }

            if(!empty($get['start1']) && !empty($get['end1']) && !empty($get['supplier_id'])){
                $start1 =  $get['start1'];
                $start = date_create($start1);
                $from = date_format($start,"Y-m-d");

                $end1 =  $get['end1'];
                $end = date_create($end1);
                $to = date_format($end,"Y-m-d");

                $supplier_id = $get['supplier_id'];

                $inventorydetail = $this->db->select('tbl_inventory.*,tbl_supplier.first_name,tbl_supplier.last_name')
                    ->from('tbl_inventory')
                    ->where("tbl_inventory.quantity > '0'")
                    ->where("(tbl_inventory.created_date BETWEEN '{$from}%' AND '{$to}%' AND tbl_inventory.supplier_id = '$supplier_id')")
                    ->join('tbl_supplier','tbl_supplier.id=tbl_inventory.supplier_id', 'left')
                    ->order_by('tbl_inventory.id', 'DESC')
                    ->get()->result();
            }else{
                if(!empty($get['supplier_id']) && $get['supplier_id'] != "0"){
                   $supplier_id = $get['supplier_id'];

                    $inventorydetail = $this->db->select('tbl_inventory.*,tbl_supplier.first_name,tbl_supplier.last_name')
                        ->from('tbl_inventory')
                        ->where("tbl_inventory.quantity > '0'")
                        ->where("(tbl_inventory.supplier_id = '$supplier_id')")
                        ->join('tbl_supplier','tbl_supplier.id=tbl_inventory.supplier_id', 'left')
                        ->order_by('tbl_inventory.id', 'DESC')
                        ->get()->result();
                 }

                 if(!empty($get['start1']) && !empty($get['end1'])){
                    $start1 =  $get['start1'];
                    $start = date_create($start1);
                    $from = date_format($start,"Y-m-d");

                    $end1 =  $get['end1'];
                    $end = date_create($end1);
                    $to = date_format($end,"Y-m-d");

                    $inventorydetail = $this->db->select('tbl_inventory.*,tbl_supplier.first_name,tbl_supplier.last_name')
                        ->from('tbl_inventory')
                        ->where("tbl_inventory.quantity > '0'")
                        ->where("(tbl_inventory.created_date BETWEEN '{$from}%' AND '{$to}%' OR tbl_inventory.created_date LIKE '{$from}%' OR tbl_inventory.created_date = '$to')")
                        ->join('tbl_supplier','tbl_supplier.id=tbl_inventory.supplier_id', 'left')
                        ->order_by('tbl_inventory.id', 'DESC')
                        ->get()->result();
                     /*   echo $this->db->last_query();
                      exit();*/
                }
            }

            //$inventorydetail = $this->db->select('*')->from('tbl_inventory')->get()->result_array();
                $suppliers = $this->Dbmodel->getsupplier();
                // $permission = $this->permission($loginid); 
                $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
                 //all permistion modul wise
                $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
                $report_permi = $this->Dbmodel->get_report_permissions($loginid);
                $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

    		$this->load->view('inventorydetail/inventorydetail', array('inventorydetail' => $inventorydetail,'inventory_permi' => $inventory_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi,'sell_permi' => $sell_permi,'suppliers'=>$suppliers));
    	}else{
    		return redirect();
    	}
    }

     public function addinventory() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
            $post =  $this->input->post();
             $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
             if ($this->form_validation->run('addinventory')) {
                 if(!empty($post['addinventory'])){
                        $supplier_id = $post['supplier_id'];
                        $product_category = $post['product_category'];
                        $product_name = $post['product_name'];
                        $product_sku = $post['product_sku'];
                        $quantity = $post['quantity'];
                        $price = $post['price'];
                        $expiry_date = $post['expiry_date'];
                        $note = $post['note'];

                        //add extra filed
                       // $product_size = $post['product_size'];
                        $batch_number = $post['batch_number'];
                        $storage = $post['storage'];
                        $pack_size = $post['pack_size'];
                       
                        $data = array(
                            'user_id' => $loginid,
                            'supplier_id' => $supplier_id,
                            'product_category' => $product_category,
                            'product_name' => $product_name,
                            'product_sku' => $product_sku,
                            'expiry_date' =>  $expiry_date,
                            'quantity' => $quantity,
                            'pack_size' => $pack_size,
                            'price' => $price,
                            'note' => $note,
                            //add extar filed
                            //'product_size' => $product_size,
                            'batch_number' => $batch_number,
                            'storage' => $storage,
                        );
                        $success = $this->Dbmodel->insert_db('tbl_inventory', $data);
                        $invetoryid = $this->db->insert_id();

                        //same name product entery for get the recode
                        $pro_name_exist =   $this->product_name($product_name,$product_category);
                        if(!empty($pro_name_exist->product_name)){
                            $name = array(
                              'user_id' => $loginid,
                              'product_name' => $pro_name_exist->product_name);
                            $this->Dbmodel->insert_db('tbl_inventory_name', $name);
                        }
                       /* echo "<pre>";
                        print_r();
                        die();*/

                        if (!empty($success)) {
                            if ($this->sendMail($email, $subject, $body)) {
                                 $this->session->set_flashdata('Msg', "Inventory successfully added.");
                                 $this->session->set_flashdata('Msg_class', 'success');
                                return redirect('inventorydetail');
                            }else {
                                $this->session->set_flashdata('Msg', "Inventory successfully added.");
                                $this->session->set_flashdata('Msg_class', 'success');
                                return redirect('inventorydetail');
                            }
                        }


                   }
             }


              $suppliers = $this->Dbmodel->getsupplier();
              $inventorycategory = $this->Dbmodel->getinventorycategory();
             
           // $permission = $this->permission($loginid); 
            
            

           //all permistion modul wise
            $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
            $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
            $report_permi = $this->Dbmodel->get_report_permissions($loginid);
            $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

            $this->load->view('inventorydetail/addinventory',['suppliers' => $suppliers,'inventorycategory'=>$inventorycategory,'inventory_permi' => $inventory_permi,'sell_permi'=>$sell_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi]);
        }else{
            return redirect();
        }
    }

    // delete user
    public function delete_inventory() {
         if($_POST['id']){
             $id =  $_POST['id'];
         }
         $inventoryid = ['id' => $id];
         $suppliertbl = $this->Dbmodel->delete_db($inventoryid,'tbl_inventory');
         //exit();
         if (!empty($suppliertbl)) {
                return redirect('inventorydetail');
        }
    }

    // update user
    public function updateinventory() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
           $inventid = $this->uri->segment(3);
           $this->session->unset_userdata('inventoryid');

           //store the id in session
           $post =  $this->input->post();
           if(!empty($post)){
                $inventory_id =  $post['inventoryid'];
                $data = array(
                        'inventoryid' => $inventory_id,
                        );
                $this->session->set_userdata($data);
                $inventid = $this->session->userdata('inventoryid');
            }

             $inventorydata = $this->db->select('*')->from('tbl_inventory')->where(['id' => $inventid])->get()->row(); 
             $suppliers = $this->Dbmodel->getsupplier();
             $inventorycategory = $this->Dbmodel->getinventorycategory();
           // $this->load->view('inventorydetail/updateinventory', array('inventorydata' => $inventorydata,'suppliers' => $suppliers));
           
             $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
             if ($this->form_validation->run('addinventory')) {

                     if(!empty($post['updateinventory'])){
                            $inid =  $post['inventoryid'];
                            $id = ['id' => $inid];
                        
                            $supplier_id = $post['supplier_id'];
                            $product_category = $post['product_category'];
                            $product_name = $post['product_name'];
                            $product_sku = $post['product_sku'];
                            $quantity = $post['quantity'];
                            $price = $post['price'];
                            $expiry_date = $post['expiry_date'];
                            $note = $post['note'];
                           
                            //add extra filed
                           // $product_size = $post['product_size'];
                            $batch_number = $post['batch_number'];
                            $storage = $post['storage'];
                            $pack_size = $post['pack_size'];

                            $data = array(
                                'supplier_id' => $supplier_id,
                                'product_category' => $product_category,
                                'product_name' => $product_name,
                                'product_sku' => $product_sku,
                                'expiry_date' =>  $expiry_date,
                                'quantity' => $quantity,
                                'price' => $price,
                                //'is_active' => $sell_or_not,
                                'note' => $note,
                                'updated_date' => date("Y-m-d H:i:s"),

                                //add extar filed
                               // 'product_size' => $product_size,
                                'batch_number' => $batch_number,
                                'storage' => $storage,
                                'pack_size' => $pack_size,
                            );
                            
                            $updatesuccess = $this->Dbmodel->update_db($id, 'tbl_inventory', $data);

                            if (!empty($updatesuccess)) {
                                $this->session->set_flashdata('Msg', "Successfully updated.");
                                $this->session->set_flashdata('Msg_class', 'success');
                                return redirect('inventorydetail');
                            }else{
                                return redirect('inventorydetail');
                            } 
                       }
                }
                //permission for
                // $permission = $this->permission($loginid); 
                   //$permission = $this->Dbmodel->get_inventory_permissions($loginid);
                ///all permistion modul wise
                $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
                $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
                $report_permi = $this->Dbmodel->get_report_permissions($loginid);
                $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

                $this->load->view('inventorydetail/updateinventory', array('inventorydata' => $inventorydata,'suppliers' => $suppliers,'inventorycategory'=>$inventorycategory,'inventory_permi' => $inventory_permi,'sell_permi'=>$sell_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi));
                 
        }else{
            return redirect();
        }
    }

    
    public function inventorystock() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
         
             $inventorystock = $this->db->select('tbl_inventory.*,tbl_supplier.first_name,tbl_supplier.last_name')
                ->from('tbl_inventory')
                ->where("(tbl_inventory.quantity <= 0)")
                ->join('tbl_supplier','tbl_supplier.id=tbl_inventory.supplier_id', 'left')
                ->order_by('tbl_inventory.id', 'DESC')
                ->get()->result();
          

              $suppliers = $this->Dbmodel->getsupplier();
            // $permission = $this->permission($loginid); 
             $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
                 
                 //all permistion modul wise
                $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
                $report_permi = $this->Dbmodel->get_report_permissions($loginid);
                $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

            $this->load->view('inventorydetail/inventorystock', array('inventorystock' => $inventorystock,'inventory_permi' => $inventory_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi,'sell_permi' => $sell_permi,'suppliers'=>$suppliers));
        }else{
            return redirect();
        }
    }

    public function inventorycompare() {
      $loginid = $this->session->userdata('login_id');
      $pro_id = $this->uri->segment(3);
      if(!empty($pro_id)){
        $name =  $this->db->select('product_name')->where('id', $pro_id)->get('tbl_inventory')->row();
        $pro_name = $name->product_name;
        /*echo "<pre>";
        print_r($name->product_name);*/
    
        if(!empty($pro_name)){
           $tbl_inventory_name_compare = $this->db->select('tbl_inventory.*,tbl_supplier.first_name,tbl_supplier.last_name')
                  ->from('tbl_inventory')
                  ->where("tbl_inventory.quantity > '0'")
                  ->where("(tbl_inventory.product_name LIKE '{$pro_name}%')")
                  ->join('tbl_supplier','tbl_supplier.id=tbl_inventory.supplier_id', 'left')
                  ->order_by('tbl_inventory.id', 'DESC')
                  ->get()->result();
        }
            $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
            $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
            $report_permi = $this->Dbmodel->get_report_permissions($loginid);
            $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

          $this->load->view('inventorydetail/inventorycompare', array('tbl_inventory_name_compare'=>$tbl_inventory_name_compare,'sell_permi'=>$sell_permi,'inventory_permi' => $inventory_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi));
      }else{
        return redirect('inventorydetail');
      }

    }

}
