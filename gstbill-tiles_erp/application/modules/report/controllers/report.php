<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Report extends MX_Controller {

    function __construct() {

        parent::__construct();

        if (!$this->user_auth->is_logged_in()) {

            redirect($this->config->item('base_url') . 'admin');
        }
        $main_module = 'report';

        $access_arr = array(
            'report/invoice_report' => 'no_restriction',
            'report/invoice_ajaxList' => 'no_restriction',
            'report/customer_payment_report' => 'no_restriction',
            'report/customer_pay_ajaxlist'  => 'no_restriction',
            'report/inv_excel_report' => 'no_restriction',
            'report/customer_pay_excel_report' => 'no_restriction',
            
        );

        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {

            $this->user_auth->is_permission_allowed();

            redirect($this->config->item('base_url'));
        }

        $this->load->helper('form');

        $this->load->helper('url');

        $this->load->library('session');

        $this->load->library('email');

        $this->load->database();

        $this->load->model('sales/project_cost_model');

        $this->load->model('report_model');

        $this->load->model('masters/sales_man_model');
    }

    function invoice_report() {

        $data['invoice_list'] = $this->report_model->get_all_invoice();

        $data['customers'] = $this->project_cost_model->get_all_customer();

        $data["sales_man_list"] = $this->sales_man_model->get_sales_man();

        $data['all_product'] = $this->report_model->get_all_product();

        $this->template->write_view('content', 'report/invoice_list', $data);

        $this->template->render();
    }

    function customer_payment_report() {

        $data['customers'] = $this->project_cost_model->get_all_customer();

        $this->template->write_view('content', 'report/customer_payment_report', $data);

        $this->template->render();
    }

    function inv_excel_report() {
        $inv = $this->report_model->get_invoice_datatables();
        $this->export_all_inv_csv($inv);
    }

    function export_all_inv_csv($query, $timezones = array()) {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Invoice Report.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('S.No', 'Invoice Id', 'Customer Name', 'Total Qty', 'Sub Total','CGST','SGST','IGST', 'Invoice Amt','Invoice Date', 'Sales Man'));
        foreach ($query as $key => $val) {
            $row = array($key + 1,
             $val['inv_id'], 
            ($val['store_name']) ? $val['store_name'] : $val['name'],
            round($val['total_qty']),
            number_format($val['subtotal_qty'], 2),
            number_format($val['cgst_price'], 2),
            ($val['state_id'] == 31) ? number_format($val['sgst_price'], 2) : '0.00',
            ($val['state_id'] != 31) ? number_format($val['igst_price'], 2) : '0.00',
            number_format($val['net_total'], 2),
            ($val['created_date'] != '1970-01-01') ? date('d-M-Y', strtotime($val['created_date'])) : '',
            $val['sales_man_name']);
            fputcsv($output, $row);
        }
        exit;
    }

    function customer_pay_excel_report() {
        $inv = $this->report_model->get_customer_payment_datatables();
        $this->export_all_customer_payment_csv($inv);
    }
    
    function export_all_customer_payment_csv($query, $timezones = array()) {
        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename=Customer Payment Report.csv');
        $output = fopen('php://output', 'w');
        fputcsv($output, array('S.No','Customer Name','Number','Amount','Reference'));
        foreach ($query as $key => $val) {
            $tax =($val['amount'] -  $val['taxable_price']);
            $row = array($key + 1,
            ($val['store_name']) ? $val['store_name'] : $val['name'],
            $val['q_no'],
            number_format($val['amount'],2),
            $val['reference_type']);
            fputcsv($output, $row);
        }
        exit;
    }

    function invoice_ajaxList() {

        $search_data = $this->input->post();

        $search_arr = array();

        $search_arr['overdue'] = $search_data['overdue'];

        $search_arr['from_date'] = $search_data['from_date'];

        $search_arr['to_date'] = $search_data['to_date'];

        $search_arr['inv_id'] = $search_data['inv_id'];

        $search_arr['customer'] = $search_data['customer'];

        $search_arr['product'] = $search_data['product'];

        $search_arr['gst'] = $search_data['gst'];

        $search_arr['sales_man'] = $search_data['sales_man'];

        if (empty($search_arr)) {

            $search_arr = array();
        }

        $list = $this->report_model->get_invoice_datatables($search_arr);


        $data = array();

        $no = $_POST['start'];

        foreach ($list as $val) {

            $no++;

            $row = array();

            $row[] = $no;

            $row[] = $val['inv_id'];

            $row[] = ($val['store_name']) ? $val['store_name'] : $val['name'];

            $row[] = round($val['total_qty']);

            $row[] = number_format($val['subtotal_qty'], 2);

            $row[] = number_format($val['cgst_price'], 2);

            $row[] = ($val['state_id'] == 31) ? number_format($val['sgst_price'], 2) : '0.00';

            $row[] = ($val['state_id'] != 31) ? number_format($val['igst_price'], 2) : '0.00';

            $row[] = number_format($val['net_total'], 2);

            $row[] = ($val['created_date'] != '1970-01-01') ? date('d-M-Y', strtotime($val['created_date'])) : '';

            $row[] = $val['sales_man_name'];

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->report_model->count_all_invoice($search_data),
            "recordsFiltered" => $this->report_model->count_filtered_invoice($search_data),
            "data" => $data,
        );

        echo json_encode($output);

        exit;
    }

    function customer_pay_ajaxlist() {

        $search_data = $this->input->post();

        $search_arr = array();

        $search_arr['from_date'] = $search_data['from_date'];

        $search_arr['to_date'] = $search_data['to_date'];

        $search_arr['customer'] = $search_data['customer'];

        $search_arr['reference_type'] = $search_data['reference_type'];


        if (empty($search_arr)) {

            $search_arr = array();
        }

        $list = $this->report_model->get_customer_payment_datatables($search_arr);

        $data = array();

        $no = $_POST['start'];

        foreach ($list as $val) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $val['store_name'];
            $row[] = ($val['q_no']);
           // $row[] = ($val['reference_type'] == 'payment') ? $val['amount'] : $val['taxable_price'];
           // $tax =($val['reference_type'] == 'payment') ? '0.00' : ($val['amount'] -  $val['taxable_price']);
           // $row[] = number_format($tax,2);
            $row[] = number_format($val['amount'],2);
            $row[] = ucfirst($val['reference_type']);
            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->report_model->count_all_customer_pay(),
            "recordsFiltered" => $this->report_model->count_filtered_customer_pay($search_data),
            "data" => $data,
        );

        echo json_encode($output);

        exit;
    }

    

}
