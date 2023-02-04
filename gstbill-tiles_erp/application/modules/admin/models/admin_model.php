<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model {

    private $table_name1 = 'company_details';
    private $erp_user = 'erp_user';
    private $erp_company_amount = 'erp_company_amount';
    private $erp_email_settings = 'erp_email_settings';

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->ttbs_database = $this->db->database;
    }

    public function get_user_by_login($username, $password) {

        $this->db->select('tab_1.*');
        $this->db->where('username', $username);
        $this->db->where('password', md5($password));
        $query = $this->db->get($this->erp_user . ' AS tab_1');

        if ($query->num_rows() >= 1) {
            return $query->row();
        } else {
            return FALSE;
        }
    }

    public function login($data) {
        $this->db->select('username,id,role');
        $this->db->where('username', $data['username']);
        $this->db->where('password', md5($data['password']));
        $query = $this->db->get($this->erp_user);
        if ($query->num_rows() >= 1) {
            return $query->result_array();
        }

        return false;
    }

    public function get_admin($role, $id) {

        $this->db->select('*');
        $this->db->where('role', $role);
        $this->db->where('id', $id);
        $query = $this->db->get($this->erp_user);
        if ($query->num_rows() >= 1) {

            return $query->result_array();
        } 

        return false;
    }

    function update_profile($data, $role, $id) {

        $this->db->where('id', $id);
        $this->db->where('role', $role);
        $this->db->update($this->erp_user, $data);
    }

    function insert_company_details($data) {
        $this->db->where('id', 1);
        if ($this->db->update($this->table_name1, $data)) {

            return true;
        }
        return false;
    }

    function get_company_details() {
        $this->db->select('*');
        $query = $this->db->get($this->table_name1)->result_array();
        return $query;
    }

    function get_company_amount() {
        $this->db->select('value');
        $this->db->where("(type='company_amount')");
        $query = $this->db->get($this->erp_email_settings)->result_array();
        return $query;
    }

    function update_company_amount($data) {
        $update_array = array('value' => $data);
        $this->db->where("type", "company_amount");
        if ($this->db->update($this->erp_email_settings, $update_array)) {
            return true;
        }
        return false;
    }

    function get_purchase_cost() {
        $this->db->select('SUM(bill_amount) as purchase_cost');
        $this->db->where("(receiver_type='Purchase Cost')");
        $this->db->where($this->erp_company_amount . '.type', 2);
        $query = $this->db->get($this->erp_company_amount)->result_array();
        return $query;
    }

    public function getTotalCustomers(){
        $this->db->from("customer");
        $this->db->where('status',1);
        return $this->db->count_all_results();
    }
    public function getTotalInvoice(){
        $this->db->from("erp_invoice");
        $this->db->where('is_deleted',0);
        return $this->db->count_all_results();
    }
    public function getTotalPaidAmount(){
        $this->db->select('SUM(amount) as amount');
        $this->db->where('is_deleted',0);
        $query = $this->db->get("customer_payment")->row_array();
        return $query['amount'];
    }
    public function getTotalInvoiceAmount(){
        $this->db->select('SUM(net_total) as amount');
        $this->db->where('is_deleted',0);
        $query = $this->db->get("erp_invoice")->row_array();
        return $query['amount'];
    }

}
