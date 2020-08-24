<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
  layout  controlles
  call model in dbmodel
 */

class Layout extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
    	$userid = $this->session->userdata('login_id');
    	if(!empty($userid)){
          //$permission = $this->permission($userid); 
        $inventory_permi = $this->Dbmodel->get_inventory_permissions($userid);
        $sell_permi = $this->Dbmodel->get_sell_permissions($userid);
        $report_permi = $this->Dbmodel->get_report_permissions($userid);
        $bill_permi = $this->Dbmodel->get_bill_permissions($userid);
         /* echo "<pre>";
          print_r($sell_permi);
          die();*/
    		$this->load->view('layout/sidebar', array('inventory_permi' => $inventory_permi,'sell_permi'=>$sell_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi));
    	}else{
    		return redirect();
    	}
    }

   
}
