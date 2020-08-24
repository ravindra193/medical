<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
  Dashboard  controlles
  call model in dbmodel
 */

class Inventorycategory extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
    	$loginid = $this->session->userdata('login_id');
    	if(!empty($loginid)){
            $inventorycategory = $this->db->select('*')->from('tbl_inventory_category')->get()->result_array();  
            //give user to access permision
           // $permission = $this->permission($loginid); 
           // $get_permissions_list = $this->Dbmodel->get_permissions_list();
           
             //all permistion modul wise
            $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
            $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
            $report_permi = $this->Dbmodel->get_report_permissions($loginid);
            $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

    		$this->load->view('inventorycategory/inventorycategory', array('inventorycategory' => $inventorycategory,'inventory_permi' => $inventory_permi,'sell_permi'=>$sell_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi));
    	}else{
    		return redirect();
    	}
    }

     public function addinventorycategory() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
            $post =  $this->input->post();
            
                 if(!empty($post['addinventorycategory'])){
                        $category_name = $post['category_name'];
                        $data = array(
                            'user_id' => $loginid,
                            'category_name' => $category_name,
                        );
                        $success = $this->Dbmodel->insert_db('tbl_inventory_category', $data);
                       // $invetorycatgoryid = $this->db->insert_id();

                        if(!empty($success)){
                                $this->session->set_flashdata('Msg', "Category successfully added.");
                                $this->session->set_flashdata('Msg_class', 'success');
                                return redirect('inventorycategory');
                        }else{
                                return redirect('inventorycategory');
                        }
                   }
            $this->load->view('inventorycategory/addinventorycategory');
        }else{
            return redirect();
        }
    }

    // delete user
    public function delete_inventory_category() {
         if($_POST['id']){
             $id =  $_POST['id'];
         }
         $category_id = ['id' => $id];
         $tbl_inventory_category = $this->Dbmodel->delete_db($category_id,'tbl_inventory_category');
        
         if (!empty($tbl_inventory_category)) {
                return redirect('inventorycategory');
        }
    }

    // update user
    public function update_inventory_category() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
             $post =  $this->input->post();
             if(!empty($post['updateinventorycategory'])){
                    $catid =  $post['category_id'];
                    $id = ['id' => $catid];
                
                    $category_name = $post['category_name'];
                   
                    $data = array(
                        'user_id' => $loginid,
                        'category_name' => $category_name,
                        'updated_date' => date("Y-m-d H:i:s"),
                    );
                    
                    $updatesuccess = $this->Dbmodel->update_db($id, 'tbl_inventory_category', $data);

                    if (!empty($updatesuccess)) {
                        $this->session->set_flashdata('Msg', "Category successfully updated.");
                        $this->session->set_flashdata('Msg_class', 'success');
                        return redirect('inventorycategory');
                    }else{
                        return redirect('inventorycategory');
                    } 
               } 
              // return redirect('inventorycategory');
        }else{
            return redirect();
        }
    }

    

}
