<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payments extends MX_Controller {

    function __construct() {
        parent::__construct();

      //  $this->clear_cache();

        if (!$this->user_auth->is_logged_in()) {
            redirect($this->config->item('base_url') . 'admin');
        }
        $main_module = 'payments';
        $access_arr = array(
            'payments/index' => 'no_restriction',
            'payments/payments_ajaxList' =>'no_restriction',
            'payments/add_payment' =>'no_restriction',
            'payments/delete_payment'=>'no_restriction',
        );
        $this->load->model('quotation/gen_model');
        $this->load->model('payments/payment_model');
        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
            redirect($this->config->item('base_url'));
        }
    }
    public function index(){
        $datas = array();
        $datas["customers"] = $this->gen_model->get_all_customers();
        $this->template->write_view('content', 'payments/payments_list', $datas);
        $this->template->render();
    }

    function payments_ajaxList() {
        $data = array();
        $no = $_POST['start'];
        $search_data = $this->input->post();
        $list = $this->payment_model->get_datatables($search_data);
        foreach ($list as $ass) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $ass->store_name;
            $row[] = $ass->payment_no;
            $row[] = ($ass->amount);
            $row[] =  date('d-M-Y',strtotime($ass->created_date));
            $rows = '<a data-toggle="modal" data-payno="'.$ass->payment_no.'" data-id="'.$ass->id.'" data-customer_id="'.$ass->customer_id.'" data-amount="'.$ass->amount.'" data-created_date="'.date('d-m-Y',strtotime($ass->created_date)).'" class="btn btn-default btn-xs edit_payment" title="Edit" ><span class="fa fa-edit"></span></a>&nbsp;&nbsp;';
            $row[] = $rows . '<a  href="#" data-toggle="modal" id="yesin" name="delete" class="tooltips btn btn-default btn-xs" ><span class="fa fa-log-out" title="In-Active"> <span class="fa fa-ban testspan" data-id="'.$ass->id.'"></span>  </span></a>';      
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->payment_model->count_all(),
            "recordsFiltered" => $this->payment_model->count_filtered($search_data),
            "data" => $data,
        );
        echo json_encode($output);
        exit;
    }
    public function add_payment(){
        $post_data = $this->input->post();
        $id = $post_data['id'];
        unset($post_data['id']);
        if($id==''){
            $payment_id = $this->payment_model->add_payments($post_data);
        }else{
            $post_data['amount']=number_format($post_data['amount'], 2);
            $post_data['created_date']=date('Y-m-d',strtotime($post_data['created_date']));
            $post_data['updated_date']=date('Y-m-d');
            $payment_id = $this->payment_model->update_payment($post_data,$id);
        }
        echo $payment_id;exit;

    }
    public function delete_payment(){
        $id=$this->input->post('id');
        $result = $this->payment_model->update_payment(array('is_deleted'=>1),$id);
        echo $result;exit;
    }

}
