<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

    public function __construct() {
        parent::__construct();
    }

    /*admin login code */
    public function index() {
         $post =  $this->input->post();
         $loginid = $this->session->userdata('login_id');

         if(empty($loginid)){
             if(!empty($post)){
                $username = $post['loginUsername'];
                $password = $post['loginPassword'];
                //admin login query
                $admindata_login = $this->db->select('*')->from('user_detail')->where("(username = '$username' OR email = '$username')")->where(['password' => md5($password),'roll' => '0' ])->get()->row();
                if(empty($admindata_login)){
                    //user login query 
                   $admindata_login = $this->db->select('*')->from('user_detail')->where("(username = '$username' OR email = '$username')")->where(['password' => md5($password),'roll' => '1','is_active' => '1'])->get()->row();
                }

                    if(!empty($admindata_login)) {
                            $logindata = array(
                                'login_id' => $admindata_login->id,
                                'fname' => $admindata_login->first_name,
                                'lname' => $admindata_login->last_name,
                                'username' => $admindata_login->username,
                                'roll' => $admindata_login->roll,
                                'login_email' => $admindata_login->username);
                            $this->session->set_userdata($logindata);
                            //admin admindata_login
                           // $adminid = $this->session->userdata('login_id');
                            $this->session->set_flashdata('Msg', "Welcome.");
                            $this->session->set_flashdata('Msg_class', 'success');
                            //return redirect('dashboard');
                            return redirect('sellbilldetails');
                    }else{
                         $this->session->set_flashdata('Msg', "Please enter a valid username & password.");
                         $this->session->set_flashdata('Msg_class', 'danger');
                         return redirect();
                    }
            }else{
                 $this->load->view('authentication/login');
            }
        }else{
           // return redirect('dashboard');
              return redirect('userdetail');
        }
    }
   
   	public function forgotpassemail() {
   		
            if(!empty($_POST['email'])){
                $email1 = $_POST['email'];
                $accountdetail = $this->db->select('*')->from('user_detail')->where(['email' => $email1])->get()->row();
               if(!empty($accountdetail)){
                    $email = $accountdetail->email;
                    $username = $accountdetail->username;
                    $id = $accountdetail->id;
                    $key =  base64_encode($id);
                    $url = base_url('login/resetpassword') . "?key=$key";
                    //logo
                    $date = date('d M Y');
                    //$logo = base_url('assets/img/bit-coin7.png');
                    $headers = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                    $headers .= 'From: Info@Tecocraft.Com' . "\r\n" .
                            'Reply-To: Info@Tecocraft.Com' . "\r\n" .
                            'X-Mailer: PHP/' . phpversion();
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
                                                <td width='570' style='background-color: white;'><p><b>Hi"  .$username."</b></p><br><h2>Forgot your password?</h2><br><p><b>Email id: </b>" . $email ."</p><br><p>To reset your password please click on this link. <br><a href='$url'>Click here for Reset your Passowrd</a><br>This link takes you to a secure your passowrd where you can change your password.</p></td>
                                            </tr>
                                            <tr>
                                                <td width='570' align='right' style='background-color: #1b83bd;'><p>". $date ."</p></td>
                                            </tr>
                                        </table><!-- header -->
                                    </td>
                                </tr>
                        </table>";
                    $subject = "Forgot password";
                    //if (mail($emailid, $subject, $body, $headers)) {
                    if($this->sendMail($email, $subject, $body)) {
                    	$this->session->set_flashdata('Msg', "Check your email for reset your password.");
                        $this->session->set_flashdata('Msg_class', 'success');
                        return redirect();
                    } else {
                        $this->session->set_flashdata('Msg', "failed to send email!");
                        $this->session->set_flashdata('Msg_class', 'danger');
                        return redirect();
                    }
                }else{
                      $this->session->set_flashdata('Msg', "our email Address is not register.");
                      $this->session->set_flashdata('Msg_class', 'danger');
                     return redirect();
                }
            }else{
                   $this->session->set_flashdata('Msg', "Please enter your registered email address.");
                   $this->session->set_flashdata('Msg_class', 'danger');
                 return redirect();
            }

    }

    public function resetpassword() {
    	/*echo "<pre>";
    	print_r($_POST);
    	die();*/
    	$this->form_validation->set_error_delimiters('<span class="error">', '</span>');
        if ($this->form_validation->run('resetPass')) {
           if (isset($_POST['btnsubmit']) && !empty($_POST['btnsubmit']) && isset($_POST['password'])) {
                $userid = $_GET['key'];
                $user_id = ['id' => base64_decode($userid)];
                $newpassword = $_POST['password'];
                $data = array(
                    'password' => md5($newpassword),
                );
                $updatesuccess = $this->Dbmodel->update_db($user_id, 'user_detail', $data);
                /*echo $updatesuccess;
                die();*/
              // echo $this->db->last_query();
            // exit();
                if (!empty($updatesuccess)) {
                	/*$this->session->set_flashdata('Msg', "our password updated successful.");
                    $this->session->set_flashdata('Msg_class', 'success');*/
                    return redirect();
                    $this->session->set_flashdata('Msg', "our password updated successful.");
                    $this->session->set_flashdata('Msg_class', 'success');
                }
            }
        }else{
            $this->load->view('authentication/resetpassword');
        }
    }

    public function logout() {
        //$this->session->unset_userdata('login_id');
         $this->session->sess_destroy();
        redirect(base_url());
    }

}
