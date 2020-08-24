<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
  Dashboard  controlles
  call model in dbmodel
 */

class Dashboard extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
    	$loginid = $this->session->userdata('login_id');
    	if(!empty($loginid)){
            // $permission = $this->permission($loginid); 
      // module to give permission
        $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
        $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
        $report_permi = $this->Dbmodel->get_report_permissions($loginid);
        $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

        //number of user 
        $numberofuser = $this->countuser();
        $numberofsupplier = $this->supplier();
        $numberofcustomer = $this->customer();
        $totol_sell_count = $this->totol_sell_count();
        $your_totol_sell_count = $this->your_totol_sell_count();
        $your_customer = $this->your_customer();
                
        


    		$this->load->view('dashboard/dashboard', array('sell_permi' => $sell_permi,'inventory_permi' => $inventory_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi,'numberofuser'=>$numberofuser,'numberofsupplier'=>$numberofsupplier,'numberofcustomer'=>$numberofcustomer,'totol_sell_count'=>$totol_sell_count,'your_totol_sell_count'=>$your_totol_sell_count,'your_customer'=>$your_customer));
    	}else{
    		return redirect();
    	}
    }

    //user
     public function countuser() {
        return $this->db->select('COUNT(id) as user')
                    ->from('user_detail')
                    ->where(['is_active' => '1'])
                    ->get()->row();
    }

    //supplier
    public function supplier() {
        return $this->db->select('COUNT(id) as supplier')
                    ->from('tbl_supplier')
                    ->where(['is_active' => '1'])
                    ->get()->row();
    }

    //customer
     public function customer() {
        return $this->db->select('COUNT(id) as customer')
                    ->from('tbl_customer')
                    ->get()->row();
    }

    //your customer
     public function your_customer() {
        $loginid = $this->session->userdata('login_id');
        return $this->db->select('COUNT(id) as your_customer')
                    ->where('user_id', $loginid)
                    ->from('tbl_customer')
                    ->get()->row();
    }

    //total sell
     public function totol_sell_count() {
        return $this->db->select('SUM(total_price) as totol_sell_count')
                    ->from('tbl_sell_bill')
                    ->get()->row();
    }

    //your total sell
     public function your_totol_sell_count() {
        $loginid = $this->session->userdata('login_id');
        return $this->db->select('SUM(total_price) as your_totol_sell_count')
                    ->where('user_id', $loginid)
                    ->from('tbl_sell_bill')
                    ->get()->row();
    }
}
