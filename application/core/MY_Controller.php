<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set("Europe/London");

@require_once APPPATH . 'libraries/PHPMailer-master/PHPMailerAutoload.php';

class MY_Controller extends CI_Controller {
    
	public function userdata($user_id)
	{
            $userdata = $this->Dbmodel->getUserData($user_id);
            return $userdata;
	}

    //get the customer
    public function customerdata($customer_id)
    {
            $customerdata = $this->Dbmodel->getcustomer($customer_id);
            return $customerdata;
    }

    //get the product data
    public function productdata($prod_id)
    {
         $prodname = $this->Dbmodel->getproduct($prod_id);     
          return $prodname;
    }

    //get the product detail edit
    public function getproductdetail($prod_id)
    {
         $product = $this->Dbmodel->getproductdata($prod_id);     
          return $product;
    }
    

    public function getinvoicitem($prod_id,$invoice_no)
    {
         $invoice_item = $this->Dbmodel->getinvoicitem($prod_id,$invoice_no);     
          return $invoice_item;
    }

     //get the product data
    public function supplierdata($supplier_id)
    {
         $supplierdata = $this->Dbmodel->get_supplier_data($supplier_id);     
          return $supplierdata;
    }

     //product exist or not
    public function product_name($name,$category)
    {
         $pro_name = $this->Dbmodel->get_product_name($name,$category); 
          return $pro_name;
    }


    //get the user permission
    public function permission($userid)
    {
        $permission = $this->Dbmodel->getpermissions($userid); 
        if(!empty($permission)){
            //permited user id store in session
            $permi_user_id = $permission->user_id;
            $per_user_id = array('permi_user_id' => $permi_user_id);
            $this->session->set_userdata($per_user_id);
            //get permission list
            $str = $permission->permissions;
            if(!empty($str)){
               $userpermission = explode(",",$str);
            }
        }
        if(!empty($userpermission)){
            return $userpermission;    
        }else{
            return FALSE;
        }
    }


        
    public function sendMail($email, $subject, $body) {
        $mail = new PHPMailer;
        $mail->isSMTP(); // Use SMTP
        $mail->Host = "ssl://smtp.gmail.com"; // Sets SMTP server
        $mail->SMTPDebug = 0; // 2 to enable SMTP debug information
        $mail->SMTPAuth = TRUE; // enable SMTP authentication
        $mail->SMTPSecure = "tls"; //Secure conection
        $mail->Port = 465; // set the SMTP port
        $mail->Username = 'ravindra@tecocraft.com'; // SMTP account username
        $mail->Password = 'bs2ZLO[(irNE'; // SMTP account password
        $mail->Priority = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 = low)
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = '8bit';
        $mail->Subject = $subject;
        $mail->ContentType = 'text/html; charset=utf-8\r\n';
        $mail->From = 'ravindra@tecocraft.com';
        $mail->FromName = 'bitrust';
        $mail->WordWrap = 900; // RFC 2822 Compliant for Max 998 characters per  line
        $mail->AddAddress($email); // To:
        $mail->isHTML(TRUE);
        $mail->Body = $body;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        $mail->Send();
        $mail->SmtpClose();

        if ($mail->isError()) {
           // $this->session->set_flashdata('error', "Failed to send Code, please try again!<br/><pre>$mail->ErrorInfo<pre>");
            return FALSE;
        } else {
           // $this->session->set_flashdata('success', "Check your email verification code sent to your email : $email");
            return TRUE;    
        }
    }
    
}
