<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
  user permission  controlles
  call model in dbmodel
 */

class Userpermissionslist extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
    	$loginid = $this->session->userdata('login_id');
    	if(!empty($loginid)){
            $permissions_list = $this->db->select('*')->from('tbl_permissions_list')->get()->result_array(); 
            
    		$this->load->view('userpermissionslist/userpermissionslist',['permissions_list' => $permissions_list]);
    	}else{
    		return redirect();
    	}
    }

    //add permission
     public function addpermission() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
            $post =  $this->input->post();
            
                 if(!empty($post['addpermissions'])){
                        $permissions_name = $post['permissions_name'];
                        $name = str_replace(' ', '_', $permissions_name);
                        $data = array(
                            'permissions_name' => $name,
                        );
                        $success = $this->Dbmodel->insert_db('tbl_permissions_list', $data);
                       // $permissionsid = $this->db->insert_id();

                        if (!empty($success)) {
                            if ($this->sendMail($email, $subject, $body)) {
                                 $this->session->set_flashdata('Msg', "Permissions successfully added.");
                                 $this->session->set_flashdata('Msg_class', 'success');
                                return redirect('userpermissionslist');
                            }else {
                                return redirect('userpermissionslist');
                            }
                        }
                   }
            $this->load->view('userpermissionslist/addpermission');
        }else{
            return redirect();
        }
    }

    // delete permission
    public function delete_permission() {
         if($_POST['id']){
             $id =  $_POST['id'];
         }
         $permissions_id = ['id' => $id];
         $tbl_permissions_list = $this->Dbmodel->delete_db($permissions_id,'tbl_permissions_list');
        
         if (!empty($tbl_permissions_list)) {
                return redirect('userpermissionslist');
        }
    }

    // update permission
    public function updatepermissions() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
             $post =  $this->input->post();
             if(!empty($post['updatepermissions'])){
                    $permissions_id =  $post['permissions_id'];
                    $id = ['id' => $permissions_id];
                
                    $permissions_name = $post['permissions_name'];
                    $name = str_replace(' ', '_', $permissions_name);
                   
                    $data = array(
                        'permissions_name' => $name,
                        'updated_date' => date("Y-m-d h:i:s"),
                    );
                    
                    $updatesuccess = $this->Dbmodel->update_db($id, 'tbl_permissions_list', $data);

                    if (!empty($updatesuccess)) {
                        $this->session->set_flashdata('Msg', "Permission successfully updated.");
                        $this->session->set_flashdata('Msg_class', 'success');
                        return redirect('userpermissionslist');
                    }else{
                        return redirect('userpermissionslist');
                    } 
               } 
        }else{
            return redirect();
        }
    }

    

}
