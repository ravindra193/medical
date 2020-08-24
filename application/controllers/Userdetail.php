<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
  Dashboard  controlles
  call model in dbmodel
 */

class Userdetail extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
    	$loginid = $this->session->userdata('login_id');
    	if(!empty($loginid)){
            $userdetail = $this->db->select('*')->from('user_detail')->where(['roll' => '1'])->get()->result_array();
    		$this->load->view('userdetail/userdetail', array('userdetail' => $userdetail));
    	}else{
    		return redirect();
    	}
    }

     public function adduser() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
            $post =  $this->input->post();
             $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
             if ($this->form_validation->run('adduser')) {
                 if(!empty($post['adduser'])){

                     /* echo "<pre>";
                      print_r($post);
                      die();*/
                        //profile upload
                        $config = [
                               'upload_path' => 'assets/upload/profile/',
                               'allowed_types' => 'jpg|jpeg|png|gif'
                           ];
                        $this->load->library('upload', $config);
                        if($this->upload->do_upload('profile')) {
                            $data = $this->upload->data();
                             if (!empty($data['raw_name']) && !empty($data['file_ext'])) {
                                 // $profile_name = rand(1, 99999999);
                                 // $img_path = base_url('assets/upload/profile/' . $profile_name . $data['file_ext']);
                                  $img_path = base_url('assets/upload/profile/' . $data['raw_name'] . $data['file_ext']);
                                  $post['profile'] = $img_path;
                                  $photo =  $data['raw_name'] . $data['file_ext'];
                             }
                        }else{
                             $photo = "";
                        }

                        $firstname = $post['firstname'];
                        $lastname = $post['lastname'];
                        $gender = $post['gender'];
                        $username = $post['username'];
                        $email = $post['email'];
                        $mobile_no = $post['mobileno'];
                        $password = rand(4, 999999);
                        $address = $post['address'];
                       
                        $data = array(
                            'first_name' => $firstname,
                            'last_name' => $lastname,
                            'username' => $username,
                            'email' => $email,
                            'mobile_no' => $mobile_no,
                            'password' => md5($password),
                            'gender' => $gender,
                            'profile' =>  $photo,
                            'roll' => "1",
                            'is_active' => "1",
                            'address' => $address,
                            'medicine_vat' => "0",
                        );
                        $success = $this->Dbmodel->insert_db('user_detail', $data);
                        $uid = $this->db->insert_id();

                         // give user to permission
                       /* if(!empty($post['permission'])){
                           
                                foreach($post['permission'] as $data){
                                     $data = [
                                        'user_id' => $uid,
                                        'permissions' => $data,
                                        'status' => "1"
                                    ];
                                    $this->Dbmodel->insert_db('tbl_permissions', $data);
                                }
                        }*/

                      /*if(!empty($post['permission'])){
                        $permission = $post['permission'];
                        $permi = implode(",", $permission);
                        $title = ltrim($permi,',');
                                 $data = [
                                    'user_id' => $uid,
                                    'permissions' => $title
                                ];
                                $this->Dbmodel->insert_db('tbl_permissions', $data);
                       }*/

                       if(!empty($post['inventory'])){
                        $inventory = $post['inventory'];
                        $in = implode(",", $inventory);
                        $title = ltrim($in,',');
                                 $data = [
                                    'user_id' => $uid,
                                    'permission_name' => 'inventory',
                                    'permissions' => $title
                                ];
                          $this->Dbmodel->insert_db('tbl_permissions', $data);
                       }

                       if(!empty($post['sell'])){
                        $sell = $post['sell'];
                        $se = implode(",", $sell);
                        $title = ltrim($se,',');
                                 $data = [
                                    'user_id' => $uid,
                                    'permission_name' => 'sell',
                                    'permissions' => $title
                                ];
                          $this->Dbmodel->insert_db('tbl_permissions', $data);
                       }

                       /*if(!empty($post['bill'])){
                        $bill = $post['bill'];
                        $b = implode(",", $bill);
                        $title = ltrim($b,',');
                                 $data = [
                                    'user_id' => $uid,
                                    'permission_name' => 'bill',
                                    'permissions' => $title
                                ];
                          $this->Dbmodel->insert_db('tbl_permissions', $data);
                       }*/

                       if(!empty($post['report'])){
                        $report = $post['report'];
                        $re = implode(",", $report);
                        $title = ltrim($re,',');
                                 $data = [
                                    'user_id' => $uid,
                                    'permission_name' => 'report',
                                    'permissions' => $title
                                ];
                         $this->Dbmodel->insert_db('tbl_permissions', $data);
                       }

                        if(!empty($success)) {
                            $date = date('d M Y');
                            //$logo = base_url('assets/img/bit-coin7.png');
                            $url = base_url();
                            $headers = "MIME-Version: 1.0" . "\r\n";
                            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                            $headers .= "From: Info@Tecocraft.Com" . "\r\n" .
                                    "Reply-To: Info@Tecocraft.Com" . "\r\n" .
                                    "X-Mailer: PHP/" . phpversion();
                            $body = "<table>
                                        <tr>
                                            <td>
                                                <table id='header' cellpadding='10' cellspacing='0' align='center'>
                                                    <tr>
                                                        <td width='570' style='background-color: #1b83bd;'>
                                                          <h2 style='color: white;'>Medical store</h2>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width='570' style='background-color: white;'><p><b>Hi " .$username."</b></p><br><h2>Welcome to Medicalstore
                                                        </h2><br><p><b>Email id: </b>" . $email ."</p><p><b>Username: </b>" . $username ."</p><p><b>Password: </b>" . $password ."</p><br><p>Thank you for join. You can access your personal panel. </p><p><a href='$url'>Click here for Login your account</a></p><br></td>
                                                    </tr>
                                                    <tr>
                                                        <td width='570' align='right' style='background-color: #1b83bd;'><p>". $date ."</p></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                </table>";
                            $subject = "Registered";
                            if ($this->sendMail($email, $subject, $body)) {
                                 $this->session->set_flashdata('Msg', "User successfully added. login detail sent to his email.");
                                 $this->session->set_flashdata('Msg_class', 'success');
                                return redirect('userdetail');
                            }else {
                                $this->session->set_flashdata('Msg', "User successfully added. login detail sent to his email.");
                                $this->session->set_flashdata('Msg_class', 'success');
                                return redirect('userdetail');
                            }
                           
                        }
                   }
             }
             $get_permissions_list = $this->Dbmodel->get_permissions_list();
            $this->load->view('userdetail/adduser', array('get_permissions_list' => $get_permissions_list));
        }else{
            return redirect();
        }
    }

    // delete user
    public function delete_user() {
         if($_POST['id']){
             $id =  $_POST['id'];
         }
         $userid = ['id' => $id];
         $usertbl = $this->Dbmodel->delete_db($userid,'user_detail');
         //exit();
         if (!empty($usertbl)) {
                $this->session->set_flashdata('success', 'User Delete Successfully.');
                return redirect('userdetail');
        }
    }

    // update user
    public function update_user() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
            $userid = $this->uri->segment(3);
            if(!empty($userid)){
                 $userdata = $this->db->select('*')->from('user_detail')->where(['id' => $userid])->get()->row();
                 //update permission purpose have to , user permission
                  $permi = $this->db->select('*')->from('tbl_permissions')->where(['user_id' => $userid])->get()->row();
                  $permission = $this->permission($userid);

                //all permistion modul wise
                $inventory_permi = $this->Dbmodel->get_inventory_permissions($userid);
                $sell_permi = $this->Dbmodel->get_sell_permissions($userid);
                $report_permi = $this->Dbmodel->get_report_permissions($userid);
                $bill_permi = $this->Dbmodel->get_bill_permissions($userid);

            
                $permi_s = $this->db->select('*')->from('tbl_permissions')->where(['user_id' => $userid])->get()->row();
                /*  echo "<pre>";
                  print_r($inventory_permi->permissions);
                  die();*/
                 //permission list
                  //$get_permissions_list = $this->Dbmodel->get_permissions_list();
                 /*echo "<pre>";
                  print_r($permission);
                  die();*/

                $this->load->view('userdetail/updateuser', array('userdata' => $userdata,'bill_permi'=>$bill_permi,'report_permi'=>$report_permi,'inventory_permi'=>$inventory_permi,'sell_permi'=>$sell_permi,'permission'=> $permission,'permi' => $permi));
            }
            $post =  $this->input->post();
             if(!empty($post['updateuser'])){
                    $uid =  $post['userid'];
                    $id = ['id' => $uid];

                    //update image
                    $config = [
                           'upload_path' => 'assets/upload/profile/',
                           'allowed_types' => 'jpg|jpeg|png|gif'
                       ];
                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('profile')) {
                            $data = $this->upload->data();
                             if (!empty($data['raw_name']) && !empty($data['file_ext'])) {
                                  unlink(FCPATH ."/assets/upload/profile/".$post['profile1']);
                                  $img_path = base_url('assets/upload/profile/' . $data['raw_name'] . $data['file_ext']);
                                  $post['profile'] = $img_path;
                                  $photo =  $data['raw_name'] . $data['file_ext'];
                             }
                    }else{
                         $photo = $post['profile1'];
                    }

                    $firstname = $post['firstname'];
                    $lastname = $post['lastname'];
                    $gender = $post['gender'];
                    $username = $post['username'];
                    $email = $post['email'];
                    $mobile_no = $post['mobileno'];
                    $address = $post['address'];
                   
                    $data = array(
                        'first_name' => $firstname,
                        'last_name' => $lastname,
                        'username' => $username,
                        'email' => $email,
                        'mobile_no' => $mobile_no,
                        'gender' => $gender,
                        'profile' =>  $photo,
                        'address' => $address,
                    );
                    
                    $updatesuccess = $this->Dbmodel->update_db($id, 'user_detail', $data);

                    //module wise permission
                     if(!empty($post['inventory'])){
                        if(empty($post['inventory_id'])){
                            $inventory = $post['inventory'];
                            $in = implode(",", $inventory);
                            $title = ltrim($in,',');
                                     $data = [
                                        'user_id' => $uid,
                                        'permission_name' => 'inventory',
                                        'permissions' => $title
                                    ];
                              $this->Dbmodel->insert_db('tbl_permissions', $data);
                        }else{
                            $inventory_id =  $post['inventory_id'];
                            $in_id = ['id' => $inventory_id];

                             $inventory = $post['inventory'];
                             $in = implode(",", $inventory);
                             $title = ltrim($in,',');
                                     $data = [
                                        'permissions' => $title
                                    ];
                              
                              $this->Dbmodel->update_db($in_id,'tbl_permissions', $data);
                        }
                      }

                      

                      if(!empty($post['sell'])){
                        if(empty($post['sell_id'])){
                            $sell = $post['sell'];
                            $se = implode(",", $sell);
                            $title = ltrim($se,',');
                                   $data = [
                                      'user_id' => $uid,
                                      'permission_name' => 'sell',
                                      'permissions' => $title
                                  ];
                            $this->Dbmodel->insert_db('tbl_permissions', $data);
                         }else{
                            $sell_id =  $post['sell_id'];
                            $se_id = ['id' => $sell_id];

                             $sell = $post['sell'];
                             $se = implode(",", $sell);
                             $title = ltrim($se,',');
                                     $data = [
                                        'permissions' => $title
                                    ];
                              $this->Dbmodel->update_db($se_id,'tbl_permissions', $data);
                        }
                      }

                     /*if(!empty($post['bill'])){
                        if(empty($post['bill_id'])){
                          $bill = $post['bill'];
                          $b = implode(",", $bill);
                          $title = ltrim($b,',');
                                   $data = [
                                      'user_id' => $uid,
                                      'permission_name' => 'bill',
                                      'permissions' => $title
                                  ];
                            $this->Dbmodel->insert_db('tbl_permissions', $data);
                        }else{
                            $bill_id =  $post['bill_id'];
                            $b_id = ['id' => $bill_id];

                             $bill = $post['bill'];
                             $bi = implode(",", $bill);
                             $title = ltrim($bi,',');
                                     $data = [
                                        'permissions' => $title
                                    ];
                              $this->Dbmodel->update_db($b_id,'tbl_permissions', $data);
                        }
                       }*/


                    if(!empty($post['report'])){
                        if(empty($post['report_id'])){
                          $report = $post['report'];
                          $re = implode(",", $report);
                          $title = ltrim($re,',');
                                   $data = [
                                      'user_id' => $uid,
                                      'permission_name' => 'report',
                                      'permissions' => $title
                                  ];
                           $this->Dbmodel->insert_db('tbl_permissions', $data);
                        }else{
                            $report_id =  $post['report_id'];
                            $r_id = ['id' => $report_id];

                             $report = $post['report'];
                             $re = implode(",", $report);
                             $title = ltrim($re,',');
                                     $data = [
                                        'permissions' => $title
                                    ];
                              $this->Dbmodel->update_db($r_id,'tbl_permissions', $data);
                            /*  echo $this->db->last_query();
                          exit();*/
                        }
                    }

                    if (!empty($updatesuccess)) {
                        $this->session->set_flashdata('Msg', "Successfully updated.");
                        $this->session->set_flashdata('Msg_class', 'success');
                        return redirect('userdetail');
                    }else{
                        $this->session->set_flashdata('Msg', "Successfully updated.");
                        $this->session->set_flashdata('Msg_class', 'success');
                        return redirect('userdetail');
                    }
                            
               }
        }else{
            return redirect();
        }
    }

     // profile 
    public function userprofile() {
        $loginid = $this->session->userdata('login_id');
        if(!empty($loginid)){
            $userdata =  $this->userdata($loginid);
           /* echo "<pre>";
            print_r($userdata);
            die();*/

            $post =  $this->input->post();
             if(!empty($post['updateprofile'])){
                    $uid =  $post['userid'];
                    $id = ['id' => $uid];

                    //update image
                    $config = [
                           'upload_path' => 'assets/upload/profile/',
                           'allowed_types' => 'jpg|jpeg|png|gif'
                       ];
                    $this->load->library('upload', $config);
                    if($this->upload->do_upload('profile')) {
                            $data = $this->upload->data();
                             if (!empty($data['raw_name']) && !empty($data['file_ext'])) {
                                  unlink(FCPATH ."/assets/upload/profile/".$post['profile1']);
                                  $img_path = base_url('assets/upload/profile/' . $data['raw_name'] . $data['file_ext']);
                                  $post['profile'] = $img_path;
                                  $photo =  $data['raw_name'] . $data['file_ext'];
                             }
                    }else{
                         $photo = $post['profile1'];
                    }

                    $firstname = $post['firstname'];
                    $lastname = $post['lastname'];
                    $gender = $post['gender'];
                    $email = $post['email'];
                    $mobile_no = $post['mobileno'];
                    $address = $post['address'];
                   // $vat = $post['vat'];
                   
                    $data = array(
                        'first_name' => $firstname,
                        'last_name' => $lastname,
                        'email' => $email,
                        'mobile_no' => $mobile_no,
                        'gender' => $gender,
                        'profile' =>  $photo,
                        'address' => $address,
                       // 'medicine_vat' => $vat,
                    );
                    
                    $updatesuccess = $this->Dbmodel->update_db($id, 'user_detail', $data);
                     if (!empty($updatesuccess)) {
                        $this->session->set_flashdata('Msg', "Successfully updated.");
                        $this->session->set_flashdata('Msg_class', 'success');
                        return redirect('userdetail/userprofile');
                    }else{
                        $this->session->set_flashdata('Msg', "Successfully updated.");
                        $this->session->set_flashdata('Msg_class', 'success');
                        return redirect('userdetail/userprofile');
                    }
            }

             //all permistion modul wise
            $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
            $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
            $report_permi = $this->Dbmodel->get_report_permissions($loginid);
            $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

            
            $sellvat = $this->Dbmodel->getsellvat();
          
            $this->load->view('userdetail/userprofile',array('userdata' => $userdata,'bill_permi'=>$bill_permi,'report_permi'=>$report_permi,'inventory_permi'=>$inventory_permi,'sell_permi'=>$sell_permi,'sellvat'=>$sellvat));


        }else{
               return redirect();
        }
          
    }

}
