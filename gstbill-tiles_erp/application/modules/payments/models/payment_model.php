<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment_model extends CI_Model {

    private $table_name = 'customer_payment';
    private $customer = 'customer c';
    var $selectColumn = 'cus_pay.id,cus_pay.payment_no,cus_pay.customer_id,c.store_name,cus_pay.amount,cus_pay.created_date';
    var $column_order = array(null, 'c.store_name', 'cus_pay.payment_no','cus_pay.amount', 'cus_pay.created_date', null); //set column field database for datatable orderable
    var $column_search = array('c.store_name', 'cus_pay.payment_no','cus_pay.amount', 'cus_pay.created_date'); //set column field database for datatable searchable
    var $group = 'cus_pay.id';
    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function add_payments($data){
        $data['amount']=number_format($data['amount'], 2);
        $data['created_date']=date('Y-m-d',strtotime($data['created_date']));
        if ($this->db->insert($this->table_name, $data)) {
            $insert_id = $this->db->insert_id();
            return $insert_id;
        }
        return false;
    }

    public function getPaymentslist($limit){
        $this->db->select($this->selectColumn);
        $this->db->join($this->customer, 'c.id=cus_pay.customer_id','LEFT');
        $this->db->where('cus_pay.status',1);
        $this->db->where('cus_pay.is_deleted',0);
        $this->db->order_by('cus_pay.id','desc');
        $this->db->limit($limit);
        $query = $this->db->get($this->table_name." cus_pay")->result_array();
        if($query)
            return $query;
        else
            return false;
    }

    public function update_payment($data,$id) {
        $this->db->where($this->table_name . '.id', $id);
        if ($this->db->update($this->table_name, $data)) {
            return $id;
        }
        return false;
    }

    function get_datatables($search_data) {
        $this->db->select($this->selectColumn);
        $this->_get_datatables_query($search_data);
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function _get_datatables_query($serch_data = array()) {
        $this->db->join($this->customer, 'c.id=cus_pay.customer_id','LEFT');
        $this->db->where('cus_pay.status', 1);
        $this->db->where('cus_pay.is_deleted', 0);
        if(!empty($serch_data)){
            if (!empty($serch_data['from_date']))
                $serch_data['from_date'] = date('Y-m-d', strtotime($serch_data['from_date']));
            if (!empty($serch_data['to_date']))
                $serch_data['to_date'] = date('Y-m-d', strtotime($serch_data['to_date']));
            if ($serch_data['from_date'] == '1970-01-01')
                $serch_data['from_date'] = '';
            if ($serch_data['to_date'] == '1970-01-01')
                $serch_data['to_date'] = '';
            if (isset($serch_data["from_date"]) && $serch_data["from_date"] != "" && isset($serch_data["to_date"]) && $serch_data["to_date"] != "") {
                $this->db->where("DATE_FORMAT(cus_pay.created_date,'%Y-%m-%d') >='" . $serch_data["from_date"] . "' AND DATE_FORMAT(cus_pay.created_date,'%Y-%m-%d') <= '" . $serch_data["to_date"] . "'");
            } elseif (isset($serch_data["from_date"]) && $serch_data["from_date"] != "" && isset($serch_data["to_date"]) && $serch_data["to_date"] == "") {
                $this->db->where("DATE_FORMAT(cus_pay.created_date,'%Y-%m-%d') >='" . $serch_data["from_date"] . "'");
            } elseif (isset($serch_data["from_date"]) && $serch_data["from_date"] == "" && isset($serch_data["to_date"]) && $serch_data["to_date"] != "") {
                $this->db->where("DATE_FORMAT(cus_pay.created_date,'%Y-%m-%d') <= '" . $serch_data["to_date"] . "'");
            }
            if (!empty($serch_data['customer']) && $serch_data['customer'] != 'Select') {
                $this->db->where('c.id', $serch_data['customer']);
            }
        }
        $firms = $this->user_auth->get_user_firms();
        $frim_id = array();
        foreach ($firms as $value) {
            $frim_id[] = $value['firm_id'];
        }
        $this->db->from($this->table_name." cus_pay");
        $i = 0;
        $like='';
        foreach ($this->column_search as $item) { // loop column
            if ($_POST['search']['value']) { // if datatable send POST for search
                if ($i === 0) { // first loop
                    $like = "" . $item . " LIKE '%" . $_POST['search']['value'] . "%'";
                } else {
                    $like .= " OR " . $item . " LIKE '%" . $_POST['search']['value'] . "%'" . "";
                }
            }
            $i++;
        }
        if ($like) {
            $where = "(" . $like . " )";
            $this->db->where($where);
        }
        if (isset($_POST['order']) && $this->column_order[$_POST['order']['0']['column']] != null) { // here order processing
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($order)) {
            $order = $order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }

    function count_filtered($search_data) {
        $this->_get_datatables_query($search_data);
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_all() {
        $firms = $this->user_auth->get_user_firms();
        $frim_id = array();
        foreach ($firms as $value) {
            $frim_id[] = $value['firm_id'];
        }
        $this->db->from($this->table_name." cus_pay");
        return $this->db->count_all_results();
    }

}
