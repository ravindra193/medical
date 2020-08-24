<?php



class Dbmodel extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    /**
     * @param  $str
     * @return array
     */

    function select_db($str) {
        $query = $this->db->query($str)->result_array();
        return $query;
    }



    /**
     * @param  $table string 
     * @param  $data array
     * @return result row 
     */

    function insert_db($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->affected_rows();
    }



    /**
     * @param  $table string
     * @param  $data array
     * @return insert data id
     */

    function insert_id_db($table, $data) {
        $this->db->insert($table, $data);
        return $this->db->insert_id();
    }



    /**
     * @param  $where array
     * @param  $table string
     * @param  $data array
     * @return row 
     */
    function update_db($where, $table, $data) {
        $this->db->where($where);
        $this->db->update($table, $data);
        return $this->db->affected_rows();
    }



    /**
     * @param  $where string
     * @param  $table array
     * @return null
     */

    function delete_db($where, $table) {
        $this->db->where($where);
        $this->db->delete($table);
        return $this->db->affected_rows();
    }



    /*
     * Admin Details
     */


    /*  public function _getWalletInfo() {
      return $this->db->limit(1)->get('tbl_btc_wallet')->row();
      }

      public function _getBankInfo() {
      return $this->db->select('*')->get('tbl_bank_info')->result_array();
      } */



    /*
     * Get users trading ads
     */
    public function _getTradesAds($id) {
        return $this->db->where('user_id', $id)->order_by('id', 'DESC')->get('tbl_trades')->result();
    }

    /*
     * Get the userdata data
     */
    public function getUserData($user_id) {
        return $this->db->select('*')->where('id', $user_id)->get('user_detail')->row();
    }

    //get the customer detail
    public function getcustomer($customer_id) {
        return $this->db->select('*')->where('id', $customer_id)->get('tbl_customer')->row();
    }



    //get the product detail
    public function getproduct($prod_id) {
        return $this->db->select('*')->where('product_sku', $prod_id)->get('tbl_inventory')->row();
        /* echo $this->db->last_query();
          exit(); */
    }

    public function getproductdata($prod_id) {
        return $this->db->select('*')->where('id', $prod_id)->get('tbl_inventory')->row();
    }

    public function getinvoicitem($prod_id,$invoice_no) {
        return $this->db->select('*')->where("(product_id = '$prod_id' AND invoice_no = '$invoice_no')")->get('tbl_invoice_item')->row();
    }



    /* get supplier */
    public function getsupplier() {
        return $this->db->select('*')->from('tbl_supplier')->get()->result();
    }



    /* get inventory category */
    public function getinventorycategory() {
        return $this->db->select('*')->from('tbl_inventory_category')->get()->result();
    }

    /* get permission for give in add userdetail page for */
    public function get_permissions_list() {
        return $this->db->select('*')->from('tbl_permissions_list')->get()->result();
    }

    //get the inventory product  list
    public function get_product_name($name,$category) {
        return $this->db->select('product_name')->from('tbl_inventory')->where("(product_name = '$name' AND product_category = '$category')")->get()->row();
    }


    /* get role wise permission */
    public function getpermissions($userid) {
        return $this->db->select('*')->from('tbl_permissions')->where(['user_id' => $userid])->get()->row();
        // $this->db->select('*')->from('tbl_permissions')->where("(user_id = '$userid' OR email = '$username')")->get()->row();
        /*  echo $this->db->last_query();
         exit(); */
    }



    //module wise permission

    public function get_inventory_permissions($userid) {
        return $this->db->select('*')->from('tbl_permissions')->where(['user_id' => $userid, 'permission_name' => 'inventory'])->get()->row();
    }



    public function get_sell_permissions($userid) {
        return $this->db->select('*')->from('tbl_permissions')->where(['user_id' => $userid, 'permission_name' => 'sell'])->get()->row();
    }



    public function get_report_permissions($userid) {
        return $this->db->select('*')->from('tbl_permissions')->where(['user_id' => $userid, 'permission_name' => 'report'])->get()->row();
    }



    public function get_bill_permissions($userid) {
        return $this->db->select('*')->from('tbl_permissions')->where(['user_id' => $userid, 'permission_name' => 'bill'])->get()->row();
    }



    //get supplier

    public function get_supplier_data($supplier_id) {
        return $this->db->select('*')->from('tbl_supplier')->where(['id' => $supplier_id])->get()->row();
    }



    public function getsellvat() {
        return $this->db->select('medicine_vat')->from('user_detail')->where('roll', '0')->get()->row();
    }



    public function getInvocieNo() {
        $query = $this->db->query("SELECT * FROM tbl_invoice ORDER BY id DESC LIMIT 1");
        return $query->row();
    }



    public function _postInvoice($data) {
        return $this->db->insert('tbl_invoice', [
                    'user_id' => $data['user_id'],
                    'invoice_date' => $data['invoice_date'],
                    'invoice_no' => $data['invoice_no'],
                    'customer_id' => $data['customer_id'],
                    'sub_total' => $data['sub_total'],
                    'total_vat' => $data['total_vat'],
                    //'reason_code' => $data['reason_code'],
                    'created_date' => date('Y-m-d H:i:s')
        ]);
    }

    public function _postInvoiceItem($data) {
        return $this->db->insert('tbl_invoice_item', [
                    'user_id' => $data['user_id'],
                    'invoice_no' => $data['invoice_no'],
                    'product_id' => $data['product_id'],
                    //'description' => $data['description'],
                    'qty' => $data['qty'],
                    'rate' => $data['rate'],
                    'vat' => $data['vat'],
                    'total' => $data['total']
        ]);
    }



    public function _getCustomerInfo($id) {
        $cust_id = $this->db->where('invoice_no', $id)->get('tbl_invoice')->row();
        return $this->db->select('tbl_invoice.customer_id,tbl_supplier.*')
                        ->from('tbl_invoice')
                        ->join('tbl_supplier', 'tbl_supplier.id=tbl_invoice.customer_id')
                        ->where('tbl_invoice.customer_id', $cust_id->customer_id)
                        ->get()->row();
    }



    public function _getInvoice($id) {
        return $this->db->where('invoice_no', $id)->get('tbl_invoice')->row();
    }



    public function _getInvoiceItem($id) {
        return $this->db->select('tbl_invoice_item.*,tbl_inventory.product_name,tbl_inventory.pack_size,tbl_inventory.batch_number,tbl_inventory.expiry_date')
                        ->from('tbl_invoice_item')
                        ->join('tbl_inventory', 'tbl_inventory.id=tbl_invoice_item.product_id')
                        ->where('tbl_invoice_item.invoice_no', $id)
                        ->get()->result();

    }
}
?>

