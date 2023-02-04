<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report_model extends CI_Model {

    private $quotation = 'erp_quotation';
    private $erp_product = 'erp_product';
    private $customer = 'customer';
    private $customer_pay = 'customer_payment';
    private $erp_invoice = 'erp_invoice';
    private $erp_invoice_details = 'erp_invoice_details';
    var $selectColumn = 'u.id,u.quantity,c.categoryName,p.product_name,b.brands,p.model_no,u.category';
    var $column_order = array(null, 'c.categoryName', 'b.brands', 'p.product_name', 'u.quantity', null); //set column field database for datatable orderable
    var $column_search = array('c.categoryName', 'b.brands', 'p.product_name', 'u.quantity'); //set column field database for datatable searchable

    function __construct() {
        parent::__construct();
    }

    public function get_all_invoice() {
        $this->db->select('inv_id');
        $firms = $this->user_auth->get_user_firms();
        $frim_id = array();
        foreach ($firms as $value) {
            $frim_id[] = $value['firm_id'];
        }
        $this->db->where('is_deleted',0);
        $this->db->where_in('erp_invoice.firm_id', $frim_id);
        $query = $this->db->get('erp_invoice')->result_array();
        return $query;
    }

    public function get_all_product() {
        $productIds = array();
        $firms = $this->user_auth->get_user_firms();
        $frim_id = array();
        foreach ($firms as $value) {
            $frim_id[] = $value['firm_id'];
        }

        $this->db->select('DISTINCT(product_id)');
        $product_query = $this->db->get('erp_invoice_details')->result_array();

        $productIds = array_map(function($product_query) {
            return $product_query['product_id'];
        }, $product_query);
        if (!empty($productIds))
            $this->db->where_in('id', $productIds);

        $this->db->where_in('erp_product.firm_id', $frim_id);
        $query = $this->db->get($this->erp_product)->result_array();

        return $query;
    }

    public function get_invoice_datatables($serch_data) {
        $query = $this->get_invoice_datatables_query($serch_data);
        $query = $query->result_array();
    
        return $query;
    }

    public function get_invoice_datatables_query($serch_data) {

        if (!empty($serch_data['from_date']))
            $serch_data['from_date'] = date('Y-m-d', strtotime($serch_data['from_date']));
        if (!empty($serch_data['to_date']))
            $serch_data['to_date'] = date('Y-m-d', strtotime($serch_data['to_date']));
        if ($serch_data['from_date'] == '1970-01-01')
            $serch_data['from_date'] = '';
        if ($serch_data['to_date'] == '1970-01-01')
            $serch_data['to_date'] = '';

        if (!empty($serch_data['inv_id']) && $serch_data['inv_id'] != 'Select') {
            $this->db->where($this->erp_invoice . '.inv_id', $serch_data['inv_id']);
        }
        if (!empty($serch_data['customer']) && $serch_data['customer'] != 'Select') {
            $this->db->where($this->erp_invoice . '.customer', $serch_data['customer']);
        }
        if (!empty($serch_data['sales_man']) && $serch_data['sales_man'] != 'Select') {
            $this->db->where($this->erp_invoice . '.sales_man', $serch_data['sales_man']);
        }
        if (!empty($serch_data['product']) && $serch_data['product'] != 'Select') {
            $this->db->where($this->erp_invoice_details . '.product_id', $serch_data['product']);
        }
        if (isset($serch_data["from_date"]) && $serch_data["from_date"] != "" && isset($serch_data["to_date"]) && $serch_data["to_date"] != "") {

            $this->db->where("DATE_FORMAT(" . $this->erp_invoice . ".created_date,'%Y-%m-%d') >='" . $serch_data["from_date"] . "' AND DATE_FORMAT(" . $this->erp_invoice . ".created_date,'%Y-%m-%d') <= '" . $serch_data["to_date"] . "'");
        } elseif (isset($serch_data["from_date"]) && $serch_data["from_date"] != "" && isset($serch_data["to_date"]) && $serch_data["to_date"] == "") {

            $this->db->where("DATE_FORMAT(" . $this->erp_invoice . ".created_date,'%Y-%m-%d') >='" . $serch_data["from_date"] . "'");
        } elseif (isset($serch_data["from_date"]) && $serch_data["from_date"] == "" && isset($serch_data["to_date"]) && $serch_data["to_date"] != "") {

            $this->db->where("DATE_FORMAT(" . $this->erp_invoice . ".created_date,'%Y-%m-%d') <= '" . $serch_data["to_date"] . "'");
        }

        $this->db->select('customer.id as customer,customer.store_name,customer.tin,customer.state_id, customer.name,customer.mobil_number,customer.email_id,customer.address1,customer.advance,erp_invoice.id,erp_invoice.inv_id,erp_invoice.cgst_price,erp_invoice.sgst_price,erp_invoice.igst_price,erp_invoice.total_qty,erp_invoice.tax,erp_invoice.tax_label,'
                . 'erp_invoice.net_total,erp_invoice.created_date,erp_invoice.remarks,erp_invoice.subtotal_qty,erp_invoice.estatus,erp_invoice.customer_po,erp_sales_man.sales_man_name,erp_invoice.q_id');

        $firms = $this->user_auth->get_user_firms();
        $frim_id = array();
        foreach ($firms as $value) {
            $frim_id[] = $value['firm_id'];
        }
        $this->db->where_in('erp_invoice.firm_id', $frim_id);
        $this->db->join('customer', 'customer.id=erp_invoice.customer');
        $this->db->join('erp_sales_man', 'erp_sales_man.id=erp_invoice.sales_man', 'LEFT');
        $this->db->join('erp_invoice_details', 'erp_invoice_details.in_id=erp_invoice.id');
        $this->db->group_by('erp_invoice.id');

        $column_order = array(null, 'erp_invoice.inv_id', 'customer.store_name', 'erp_invoice.total_qty', 'erp_invoice.subtotal_qty', 'erp_invoice.cgst_price','erp_invoice.sgst_price', 'erp_invoice.igst_price','erp_invoice.net_total', 'erp_invoice.created_date', 'erp_sales_man.sales_man_name');
        $column_search = array('erp_invoice.inv_id', 'customer.store_name', 'erp_invoice.total_qty', 'erp_invoice.subtotal_qty', 'erp_invoice.cgst_price','erp_invoice.sgst_price', 'erp_invoice.igst_price','erp_invoice.net_total', 'erp_invoice.created_date', 'erp_sales_man.sales_man_name');
        $order = array('erp_invoice.id' => 'DESC');
        $i = 0;
        $like='';
        foreach ($column_search as $item) { // loop column
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $like = "" . $item . " LIKE '%" . $_POST['search']['value'] . "%'";
                    //$this->db->like($item, $_POST['search']['value']);
                } else {
                    //$query = $this->db->or_like($item, $_POST['search']['value']);
                    $like .= " OR " . $item . " LIKE '%" . $_POST['search']['value'] . "%'" . "";
                }
            }
            $i++;
        }
        if ($like) {
            $where = "(" . $like . " )";
            $this->db->where($where);
        }
        if (isset($_POST['order']) && $column_order[$_POST['order']['0']['column']] != null) { // here order processing
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($_POST['length'] != -1 && $_POST['length'])
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get('erp_invoice');
    
        return $query;
    }

    public function count_all_invoice() {
        $this->db->from('erp_invoice');
        return $this->db->count_all_results();
    }

    public function count_filtered_invoice($serch_data) {
        $query = $this->get_invoice_datatables_query($serch_data);
        return $query->num_rows();
    }

    public function get_customer_payment_datatables($serch_data) {
        $query = $query1 = '';
        if($serch_data['reference_type'] == 2){
            $query = $this->get_customer_payment_datatables_query($serch_data);
            $query = $query->result_array();
        }
        if($serch_data['reference_type'] == 1){
            $query1 = $this->get_customer_quotation_datatables_query($serch_data);
            $query1 = $query1->result_array();
        }
        if(!empty($query)){
            $result = $query;
        }
        if(!empty($query1)){
            $result = $query1;
        }
        if($serch_data['reference_type'] == ''){
            $query = $this->get_customer_payment_datatables_query($serch_data);
            $query = $query->result_array();
            $query1 = $this->get_customer_quotation_datatables_query($serch_data);
            $query1 = $query1->result_array();
        }
        if(!empty($query) && !empty($query1)){
            $result = (array_merge($query,$query1));
        }
     
        return ($result);
    }

    public function get_customer_payment_datatables_query($serch_data) {
        $selectColumn = 'cus_pay.payment_no as q_no,(CASE WHEN cus_pay.status IS NULL THEN "" ELSE "payment" END) as reference_type,cus_pay.id,cus_pay.customer_id,c.store_name,cus_pay.amount,cus_pay.created_date,c.state_id,cus_pay.taxable_price';
        $column_order = array(null, 'c.store_name', 'cus_pay.amount', 'cus_pay.created_date', null); //set column field database for datatable orderable
        $column_search = array('c.store_name', 'cus_pay.amount', 'cus_pay.created_date'); //set column field database for datatable searchable
        $order = array('cus_pay.id' => 'DESC');
        $group = 'cus_pay.id';
        if (!empty($serch_data['from_date']))
            $serch_data['from_date'] = date('Y-m-d', strtotime($serch_data['from_date']));
        if (!empty($serch_data['to_date']))
            $serch_data['to_date'] = date('Y-m-d', strtotime($serch_data['to_date']));
        if ($serch_data['from_date'] == '1970-01-01')
            $serch_data['from_date'] = '';
        if ($serch_data['to_date'] == '1970-01-01')
            $serch_data['to_date'] = '';

        if (!empty($serch_data['customer']) && $serch_data['customer'] != 'Select') {
            $this->db->where('c.id', $serch_data['customer']);
        }
        if (isset($serch_data["from_date"]) && $serch_data["from_date"] != "" && isset($serch_data["to_date"]) && $serch_data["to_date"] != "") {

            $this->db->where("DATE_FORMAT(cus_pay.created_date,'%Y-%m-%d') >='" . $serch_data["from_date"] . "' AND DATE_FORMAT(cus_pay.created_date,'%Y-%m-%d') <= '" . $serch_data["to_date"] . "'");
        } elseif (isset($serch_data["from_date"]) && $serch_data["from_date"] != "" && isset($serch_data["to_date"]) && $serch_data["to_date"] == "") {

            $this->db->where("DATE_FORMAT(cus_pay.created_date,'%Y-%m-%d') >='" . $serch_data["from_date"] . "'");
        } elseif (isset($serch_data["from_date"]) && $serch_data["from_date"] == "" && isset($serch_data["to_date"]) && $serch_data["to_date"] != "") {

            $this->db->where("DATE_FORMAT(cus_pay.created_date,'%Y-%m-%d') <= '" . $serch_data["to_date"] . "'");
        }
        $this->db->select($selectColumn);
        $this->db->join($this->customer.' c', 'c.id=cus_pay.customer_id','LEFT');
        $this->db->where('cus_pay.status', 1);
        $this->db->where('cus_pay.is_deleted', 0);
        $firms = $this->user_auth->get_user_firms();
        $frim_id = array();
        foreach ($firms as $value) {
            $frim_id[] = $value['firm_id'];
        }
        $like='';
        $i = 0;
        foreach ($column_search as $item) { // loop column
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $like = "" . $item . " LIKE '%" . $_POST['search']['value'] . "%'";
                    //$this->db->like($item, $_POST['search']['value']);
                } else {
                    //$query = $this->db->or_like($item, $_POST['search']['value']);
                    $like .= " OR " . $item . " LIKE '%" . $_POST['search']['value'] . "%'" . "";
                }
            }
            $i++;
        }
        if ($like) {
            $where = "(" . $like . " )";
            $this->db->where($where);
        }
        if (isset($_POST['order']) && $column_order[$_POST['order']['0']['column']] != null) { // here order processing
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($_POST['length'] != -1 && $_POST['length'])
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get($this->customer_pay." cus_pay");
        return $query;
    }

    public function get_customer_quotation_datatables_query($serch_data) {
        $selectColumn = 'q.q_no,(CASE WHEN q.id IS NULL THEN "" ELSE "quotation" END) as reference_type,q.customer,c.store_name,q.net_total as amount,q.created_date,c.state_id,q.taxable_price';
        $column_order = array(null, 'c.store_name', 'q.net_total', 'q.created_date', null); //set column field database for datatable orderable
        $column_search = array('c.store_name', 'q.net_total', 'q.created_date'); //set column field database for datatable searchable
        $order = array('q.id' => 'DESC');
        $group = 'q.id';
        if (!empty($serch_data['from_date']))
            $serch_data['from_date'] = date('Y-m-d', strtotime($serch_data['from_date']));
        if (!empty($serch_data['to_date']))
            $serch_data['to_date'] = date('Y-m-d', strtotime($serch_data['to_date']));
        if ($serch_data['from_date'] == '1970-01-01')
            $serch_data['from_date'] = '';
        if ($serch_data['to_date'] == '1970-01-01')
            $serch_data['to_date'] = '';

        if (!empty($serch_data['customer']) && $serch_data['customer'] != 'Select') {
            $this->db->where('c.id', $serch_data['customer']);
        }
        if (isset($serch_data["from_date"]) && $serch_data["from_date"] != "" && isset($serch_data["to_date"]) && $serch_data["to_date"] != "") {

            $this->db->where("DATE_FORMAT(q.created_date,'%Y-%m-%d') >='" . $serch_data["from_date"] . "' AND DATE_FORMAT(q.created_date,'%Y-%m-%d') <= '" . $serch_data["to_date"] . "'");
        } elseif (isset($serch_data["from_date"]) && $serch_data["from_date"] != "" && isset($serch_data["to_date"]) && $serch_data["to_date"] == "") {

            $this->db->where("DATE_FORMAT(q.created_date,'%Y-%m-%d') >='" . $serch_data["from_date"] . "'");
        } elseif (isset($serch_data["from_date"]) && $serch_data["from_date"] == "" && isset($serch_data["to_date"]) && $serch_data["to_date"] != "") {

            $this->db->where("DATE_FORMAT(q.created_date,'%Y-%m-%d') <= '" . $serch_data["to_date"] . "'");
        }
        $this->db->select($selectColumn);
        $this->db->join($this->customer.' c', 'c.id=q.customer','LEFT');
        $firms = $this->user_auth->get_user_firms();
        $frim_id = array();
        foreach ($firms as $value) {
            $frim_id[] = $value['firm_id'];
        }
        $like='';
        $i = 0;
        foreach ($column_search as $item) { // loop column
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $like = "" . $item . " LIKE '%" . $_POST['search']['value'] . "%'";
                    //$this->db->like($item, $_POST['search']['value']);
                } else {
                    //$query = $this->db->or_like($item, $_POST['search']['value']);
                    $like .= " OR " . $item . " LIKE '%" . $_POST['search']['value'] . "%'" . "";
                }
            }
            $i++;
        }
        if ($like) {
            $where = "(" . $like . " )";
            $this->db->where($where);
        }
        if (isset($_POST['order']) && $column_order[$_POST['order']['0']['column']] != null) { // here order processing
            $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }

        if ($_POST['length'] != -1 && $_POST['length'])
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get($this->quotation." q");
        return $query;
    }

    public function count_all_customer_pay($serch_data) {
        $query = $query1 = '0';
        if($serch_data['reference_type'] == 2){
            $this->db->from('customer_payment');
            $query = $this->db->count_all_results();
        }
        if($serch_data['reference_type'] == 1){
            $this->db->from('erp_quotation');
            $query1 = $this->db->count_all_results();
        }
        if(!empty($query)){
            $result = $query;
        }
        if(!empty($query1)){
            $result = $query1;
        }
           
        if($serch_data['reference_type'] == ''){
            $this->db->from('customer_payment');
            $query = $this->db->count_all_results();
            $this->db->from('erp_quotation');
            $query1 = $this->db->count_all_results();
        } 
        
        if($serch_data['reference_type'] == ''){
            $result = $query + $query1;
        }
        
        return ($result);
    }

    public function count_filtered_customer_pay($serch_data) {
        $query = $query1 = '0';
        if($serch_data['reference_type'] == 2){
            $query = $this->get_customer_payment_datatables_query($serch_data);
            $query = $query->num_rows();
        }
        if($serch_data['reference_type'] == 1){
            $query1 = $this->get_customer_quotation_datatables_query($serch_data);
            $query1 = $query1->num_rows();
        }
        if(!empty($query)){
            $result = $query;
        }
        if(!empty($query1)){
            $result = $query1;
        }
        if($serch_data['reference_type'] == ''){
            $query = $this->get_customer_payment_datatables_query($serch_data);
            $query = $query->num_rows();
            $query1 = $this->get_customer_quotation_datatables_query($serch_data);
            $query1 = $query1->num_rows();
        }
        if($serch_data['reference_type'] == ''){
            $result = $query + $query1;
        }
        return $result;
    }
   

}
