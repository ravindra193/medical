<?php

defined('BASEPATH') OR exit('No direct script access allowed');
/*
  Dashboard  controlles
  call model in dbmodel
 */

class Supplierdetail extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    public function index() {
        $loginid = $this->session->userdata('login_id');
        if (!empty($loginid)) {
            // $Supplierdetail = $this->db->select('*')->from('tbl_supplier')->where(['roll' => '1'])->get()->result_array();
            $supplierdetail = $this->db->select('*')->from('tbl_supplier')->get()->result_array();

            $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
            $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
            $report_permi = $this->Dbmodel->get_report_permissions($loginid);
            $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

            $this->load->view('supplierdetail/supplierdetail', array('supplierdetail' => $supplierdetail,'inventory_permi' => $inventory_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi,'sell_permi' => $sell_permi));
        } else {
            return redirect();
        }
    }

    public function addsupplier() {
        $loginid = $this->session->userdata('login_id');
        if (!empty($loginid)) {
            $post = $this->input->post();
            $this->form_validation->set_error_delimiters('<span class="error">', '</span>');
            if ($this->form_validation->run('addsupplier')) {
                if (!empty($post['addsupplier'])) {
                    //profile upload
//                        $config = [
//                               'upload_path' => 'assets/upload/supplier/',
//                               'allowed_types' => 'jpg|jpeg|png|gif'
//                           ];
//                        $this->load->library('upload', $config);
//                        if($this->upload->do_upload('profile')) {
//                            $data = $this->upload->data();
//                             if (!empty($data['raw_name']) && !empty($data['file_ext'])) {
//                                 // $profile_name = rand(1, 99999999);
//                                 // $img_path = base_url('assets/upload/profile/' . $profile_name . $data['file_ext']);
//                                  $img_path = base_url('assets/upload/supplier/' . $data['raw_name'] . $data['file_ext']);
//                                  $post['profile'] = $img_path;
//                                  $photo =  $data['raw_name'] . $data['file_ext'];
//                             }
//                        }else{
//                             $photo = "";
//                        }

                    $firstname = $post['firstname'];
                    $lastname = $post['lastname'];

                    $company_name = $post['company_name'];
                    $trading_name = $post['trading_name'];
                    $vat_no = $post['vat_no'];
                    $com_reg_no = $post['com_reg_no'];

                    //$gender = $post['gender'];
                    $email = $post['email'];
                    $mobile_no = $post['mobileno'];

                    $telephone_number = $post['telephone_number'];
                    $wda_reg_number = $post['wda_reg_number'];
                    $authorization_date = $post['authorization_date'];
                    $website_url = $post['website_url'];
                    //$post_code = $post['post_code'];
                    //$address = $post['address'];
                    //add extra filed after 
                    $sort_code = $post['sort_code'];
                    $account_number = $post['account_number'];
                    $bank_name = $post['bank_name'];
                    $bank_branch = $post['bank_branch'];
                    $trade_references_1 = $post['trade_references_1'];
                    $trade_references_2 = $post['trade_references_2'];
                    $invoice_address = $post['invoice_address'];
                    $delivery_address = $post['delivery_address'];
                    $gphc_number = $post['gphc_number'];
                    $cust_account_number = rand(1, 99999999);

                    $data = array(
                        'user_id' =>  $loginid,
                        'first_name' => $firstname,
                        'last_name' => $lastname,
                        'company_name' => $company_name,
                        'trading_name' => $trading_name,
                        'vat_no' => $vat_no,
                        'com_reg_no' => $com_reg_no,
                        'email' => $email,
                        'mobile_no' => $mobile_no,
                        'telephone_number' => $telephone_number,
                        'cust_account_number' => $cust_account_number,
                        'wda_reg_number' => $wda_reg_number,
                        'authorization_date' => $authorization_date,
                        'website_url' => $website_url,
                        //'post_code' => $post_code,
                        // 'gender' => $gender,
                       //  'profile' =>  $photo,
                        //'address' => $address,
                        'is_active' => "1",
                        //add extra
                        'sort_code' => $sort_code,
                        'account_number' => $account_number,
                        'bank_name' => $bank_name,
                        'bank_branch' => $bank_branch,
                        'trade_references_1' => $trade_references_1,
                        'trade_references_2' => $trade_references_2,
                        'invoice_address' => $invoice_address,
                        'delivery_address' => $delivery_address,
                        'gphc_number' => $gphc_number,
                    );
                    $success = $this->Dbmodel->insert_db('tbl_supplier', $data);
                    $uid = $this->db->insert_id();

                    if (!empty($success)) {
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
                                                          Medicalstore
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td width='570' style='background-color: white;'><p><b>Hi " . $firstname . "</b></p><br><h2>Joining email in Medicalstore
                                                        </h2><br><p><b>Email id: </b>" . $email . "</p><br><p>You are become supplier of medicalstore. if you have any query about suppli then you can contact in suppote email</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td width='570' align='right' style='background-color: #1b83bd;'><p>" . $date . "</p></td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                </table>";
                        $subject = "Supplier registered";

                        if ($this->sendMail($email, $subject, $body)) {
                            $this->session->set_flashdata('Msg', "Supplier successfully added.");
                            $this->session->set_flashdata('Msg_class', 'success');
                            return redirect('supplierdetail');
                        } else {
                            $this->session->set_flashdata('Msg', "Supplier successfully added.");
                            $this->session->set_flashdata('Msg_class', 'success');
                            return redirect('supplierdetail');
                        }
                    }
                }
            }
            $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
            $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
            $report_permi = $this->Dbmodel->get_report_permissions($loginid);
            $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

            $this->load->view('supplierdetail/addsupplier',['inventory_permi' => $inventory_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi,'sell_permi' => $sell_permi]);
        } else {
            return redirect();
        }
    }

    // delete user
    public function delete_supplier() {
        if ($_POST['id']) {
            $id = $_POST['id'];
        }
        $supplierid = ['id' => $id];
        $suppliertbl = $this->Dbmodel->delete_db($supplierid, 'tbl_supplier');
        //exit();
        if (!empty($suppliertbl)) {
            return redirect('supplierdetail');
        }
    }

    // update user
    public function update_supplier() {
        $loginid = $this->session->userdata('login_id');
        if (!empty($loginid)) {
            $supplierid = $this->uri->segment(3);
            if (!empty($supplierid)) {
                $supplierdata = $this->db->select('*')->from('tbl_supplier')->where(['id' => $supplierid])->get()->row();

                // all permission
                 $inventory_permi = $this->Dbmodel->get_inventory_permissions($loginid);
                $sell_permi = $this->Dbmodel->get_sell_permissions($loginid);
                $report_permi = $this->Dbmodel->get_report_permissions($loginid);
                $bill_permi = $this->Dbmodel->get_bill_permissions($loginid);

                $this->load->view('supplierdetail/updatesupplier', array('supplierdata' => $supplierdata,'inventory_permi' => $inventory_permi,'report_permi'=>$report_permi,'bill_permi'=>$bill_permi,'sell_permi' => $sell_permi));
            }

            $post = $this->input->post();
            if (!empty($post['updateuser'])) {
                $sid = $post['supplierid'];
                $id = ['id' => $sid];

                //update image
               /* $config = [
                    'upload_path' => 'assets/upload/supplier/',
                    'allowed_types' => 'jpg|jpeg|png|gif'
                ];
                $this->load->library('upload', $config);
                if ($this->upload->do_upload('profile')) {
                    $data = $this->upload->data();
                    if (!empty($data['raw_name']) && !empty($data['file_ext'])) {
                        unlink(FCPATH . "assets/upload/supplier/" . $post['profile1']);
                        $img_path = base_url('/assets/upload/supplier/' . $data['raw_name'] . $data['file_ext']);
                        $post['photo'] = $img_path;
                        $photo = $data['raw_name'] . $data['file_ext'];
                        //die();
                    }
                } else {
                    $photo = $post['profile1'];
                }*/

                $firstname = $post['firstname'];
                $lastname = $post['lastname'];

                $company_name = $post['company_name'];
                $trading_name = $post['trading_name'];
                $vat_no = $post['vat_no'];
                $com_reg_no = $post['com_reg_no'];

                //$gender = $post['gender'];
                $email = $post['email'];
                $mobile_no = $post['mobileno'];

                $telephone_number = $post['telephone_number'];
                $wda_reg_number = $post['wda_reg_number'];
                $authorization_date = $post['authorization_date'];
                $website_url = $post['website_url'];
               // $post_code = $post['post_code'];

                //$address = $post['address'];
                //add extra filed
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
                    //'user_id' =>  $loginid,
                    'first_name' => $firstname,
                    'last_name' => $lastname,
                    'company_name' => $company_name,
                    'trading_name' => $trading_name,
                    'vat_no' => $vat_no,
                    'com_reg_no' => $com_reg_no,
                    'email' => $email,
                    'mobile_no' => $mobile_no,
                    'telephone_number' => $telephone_number,
                    'wda_reg_number' => $wda_reg_number,
                    'authorization_date' => $authorization_date,
                    'website_url' => $website_url,
                    //'post_code' => $post_code,
                    'gender' => $gender,
                    'profile' => $photo,
                    //'address' => $address,
                    //add extra filed
                    'sort_code' => $sort_code,
                    'account_number' => $account_number,
                    'bank_name' => $bank_name,
                    'bank_branch' => $bank_branch,
                    'trade_references_1' => $trade_references_1,
                    'trade_references_2' => $trade_references_2,
                    'invoice_address' => $invoice_address,
                    'delivery_address' => $delivery_address,
                    'gphc_number' => $gphc_number,
                    'updated' => date("Y-m-d H:i:s"),
                );
                /* echo "<pre>";
                  print_r($data);
                  die(); */
                $updatesuccess = $this->Dbmodel->update_db($id, 'tbl_supplier', $data);
                /* echo $this->db->last_query();
                  exit(); */

                if (!empty($updatesuccess)) {
                    $this->session->set_flashdata('Msg', "Successfully updated.");
                    $this->session->set_flashdata('Msg_class', 'success');
                    return redirect('supplierdetail');
                } else {
                    // die();
                    $this->session->set_flashdata('Msg', "Successfully updated.");
                    $this->session->set_flashdata('Msg_class', 'success');
                    return redirect('supplierdetail');
                }
            }
        } else {
            return redirect();
        }
    }

}
