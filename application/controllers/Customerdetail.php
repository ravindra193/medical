<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
  Dashboard  controlles
  call model in dbmodel
 */

class Customerdetail extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
    	$loginid = $this->session->userdata('login_id');
    	if(!empty($loginid)){
            $customerdetil = $this->db->select('*')->from('tbl_customer')->get()->result_array();  
           /* echo "fdfdf";
            die();*/
            //give user to access permision
            //$permission = $this->permission($loginid); 
            //$get_permissions_list = $this->Dbmodel->get_permissions_list();

    		  $this->load->view('customerdetail/customerdetail', array('customerdetil' => $customerdetil));
    	}else{
    		return redirect();
    	}
    }

    // delete user
    public function delete_customer() {
         if($_POST['id']){
             $id =  $_POST['id'];
         }
         $custid = ['id' => $id];
         $customertbl = $this->Dbmodel->delete_db($custid,'tbl_customer');
         //exit();
         if (!empty($customertbl)) {
                return redirect('customerdetail');
        }
    }
}
