<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Sales extends MX_Controller {

    function __construct() {

        parent::__construct();

        $this->clear_cache();

        if (!$this->user_auth->is_logged_in()) {

            redirect($this->config->item('base_url') . 'admin');
        }

        $main_module = 'sales';
        
        $access_arr = array(
            'sales/invoice_list' => 'no_restriction',
            'sales/invoice_edit' => 'no_restriction',
            'sales/invoice_ajaxList' => 'no_restriction',
            'sales/new_direct_invoice' => 'no_restriction',
            'sales/update_invoice' => 'no_restriction',
            'sales/invoice_views' => 'no_restriction',
            'sales/delete_pc_id' => 'no_restriction',
            'sales/send_email' => 'no_restriction',
            'sales/convert_number' => 'no_restriction',
            'sales/clear_cache' => 'no_restriction',
            'sales/invoice_delete' => 'no_restriction',
            'sales/check_duplicate_records' => 'no_restriction',
        );

        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {

            redirect($this->config->item('base_url'));
        }

        $this->load->model('masters/categories_model');

        $this->load->model('masters/brand_model');

        $this->load->model('masters/customer_model');

        $this->load->model('masters/sales_man_model');

        $this->load->model('sales/project_cost_model');

        $this->load->model('admin/admin_model');

        $this->load->model('api/increment_model');

        $this->load->model('api/notification_model');

        $this->load->model('quotation/gen_model');

        $this->load->model('masters/product_model');

        $this->load->model('masters/sms_model');

        $this->load->model('master_state/master_state_model');

        if (isset($_GET['notification']))
            $this->notification_model->update_notification(array('status' => 1), $_GET['notification']);
    }

    public function invoice_list() {
        $datas = array();
        $datas['sales'] = $this->project_cost_model->get_all_sales_id();
        $this->template->write_view('content', 'sales/invoice_list', $datas);
        $this->template->render();
    }

    public function invoice_edit($id) {
        $datas["quotation"] = $this->project_cost_model->get_all_invoice_by_id($id);
        $datas['quotation_details'] = $this->project_cost_model->get_all_invoice_details_by_id($id);
        $datas['company_details'] = $this->admin_model->get_company_details();
        $datas["brand"] = $this->brand_model->get_brand();
        $datas["customers"] = $this->gen_model->get_all_customers();
        $datas["sales_man"] = $this->sales_man_model->get_sales_man();
        $datas["state"] = $this->sales_man_model->get_sales_man();
        $this->template->write_view('content', 'sales/invoice_edit', $datas);
        $this->template->render();
    }

    function invoice_ajaxList() {

        $list = $this->project_cost_model->get_datatables();
        $data = array();

        $no = $_POST['start'];

        foreach ($list as $ass) {

            $no++;

            $row = array();

            $row[] = $no;

            $row[] = $ass['inv_id'];

            $row[] = $ass['customer_name'];

            $row[] = number_format($ass['taxable_price'], 2);

            $row[] = number_format($ass['inv_amount'] - $ass['taxable_price'], 2);

            $row[] = number_format($ass['inv_amount'], 2);

            $row[] = date('d-M-Y',strtotime($ass['created_date']));
    
            $row[] = '<span class=" badge bg-green">Approved</span>';
          
            if ($ass['payment_status'] == 'Pending') {
                $payment_status = '<span class=" badge  bg-yellow">Pending</span>';
            } else if ($ass['payment_status'] == 'Completed') {
                $payment_status = '<span class=" badge bg-green">Completed</span>';
            }
            //$row[] = $payment_status;

            if ($this->user_auth->is_action_allowed('sales', 'invoice', 'edit')) {
                $rows = '<a href="' . $this->config->item('base_url') . 'sales/invoice_edit/' . $ass['id'] . '" class="btn btn-default btn-xs" title="Edit" ><span class="fa fa-log-out "> <span class="fa fa-edit"></span></span></a>&nbsp;&nbsp;';
            } else {
                $rows = '<a href="#" data-toggle="tooltip" class="btn btn-default btn-xs alerts" title="Edit" ><span class="fa fa-log-out "> <span class="fa fa-edit"></span></span></a>&nbsp;&nbsp;';
            }
            if ($this->user_auth->is_action_allowed('sales', 'invoice', 'view')) {
                $rowss = $rows . '<a href="' . $this->config->item('base_url') . 'sales/invoice_views/' . $ass['id'] . '" data-toggle="tooltip" class="tooltips btn btn-default btn-xs" title="View" ><span class="fa fa-log-out "> <span class="fa fa-eye"></span>  </span></a>&nbsp;&nbsp;';
            } else {
                $rowss = $rows . '<a href="#" data-toggle="tooltip" class="btn btn-default btn-xs alerts" title="View" ><span class="fa fa-log-out "> <span class="fa fa-eye"></span>  </span></a>&nbsp;&nbsp;';
            }
            if ($this->user_auth->is_action_allowed('sales', 'invoice', 'delete')) {
                $rowsss = $rowss . '<a href="#" data-toggle="modal" id="yesin" name="delete" title="In-Active" class="btn btn-default btn-xs" ><span class="fa fa-log-out"> <span class="fa fa-ban testspan" in_id="' . $ass['id'] . '" ></span>  </span></a>';
            }
             else {
                $rowsss = $rowss . '<a href="#" data-toggle="tooltip" class="btn btn-default btn-xs alerts" title="" ><span class="fa fa-log-out "> <span class="fa fa-ban"></span>  </span></a>';
            }

            $row[] = $rowsss;

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->project_cost_model->count_all(),
            "recordsFiltered" => $this->project_cost_model->count_filtered(),
            "data" => $data,
        );

        echo json_encode($output);

        exit;
    }

    public function new_direct_invoice() {

        if ($this->input->post()) {

            $input = $this->input->post();

            //Insert Customer Data
            $customer_id = $this->customer_model->insert_customer($input['customer']);
            $user_info = $this->user_auth->get_from_session('user_info');

            //Insert Invoice Data
            $invoice_data['inv_id']=$input['quotation']['inv_id'];
            $invoice_data['q_id']=0;
            $invoice_data['firm_id']=$input['quotation']['firm_id'];
            $invoice_data['customer']=$customer_id;
            $invoice_data['sales_man']=$input['quotation']['sales_man'];
            $invoice_data['total_qty']=$input['quotation']['total_qty'];
            $invoice_data['delivery_qty']=$input['quotation']['total_qty'];
            $invoice_data['cgst_price']=$input['quotation']['cgst_price'];
            $invoice_data['sgst_price']=$input['quotation']['sgst_price'];
            $invoice_data['igst_price']=$input['quotation']['igst_price'];
            $invoice_data['taxable_price']=$input['quotation']['taxable_price'];
            if($input['customer']['state_id'] == 31)
                $invoice_data['tax']=$input['quotation']['cgst_price'] + $input['quotation']['sgst_price'];
            else
                $invoice_data['tax']=$input['quotation']['cgst_price'] + $input['quotation']['igst_price'];
            $invoice_data['subtotal_qty']=$input['quotation']['subtotal_qty'];
            $invoice_data['net_total']=$input['quotation']['net_total'];
            $invoice_data['round_off']=$input['quotation']['round_off'];
            $invoice_data['transport']=($input['quotation']['transport']) ? $input['quotation']['transport'] : '0.00';
            $invoice_data['labour']=($input['quotation']['labour']) ? $input['quotation']['labour'] : '0.00';
            $invoice_data['remarks']=$input['quotation']['remarks'];
            $invoice_data['bill_type']=$input['quotation']['bill_type'];
            $invoice_data['created_date']=date('Y-m-d',strtotime($input['quotation']['created_date']));
            $invoice_data['credit_due_date']=date('Y-m-d',strtotime($input['quotation']['created_date']));
            $invoice_data['created_by']=$user_info[0]['id'];
            $invoice_data['invoice_status']='approved';
            $invoice_data['payment_status']='Pending';
            $invoice_data['delivery_status']=$input['quotation']['delivery_status'];
            
            $invoice_id = $this->project_cost_model->insert_invoice($invoice_data);
    
            if (isset($invoice_id) && !empty($invoice_id)) {
                if (isset($input['product_id']) && !empty($input['product_id'])) {
                    $insert_arr = array();
                    foreach ($input['product_id'] as $key => $val) {
                        $insert['in_id'] = $invoice_id;
                        $insert['q_id'] = 0;
                        $insert['category'] = $input['category'][$key];
                        $insert['product_id'] = $val;
                        $insert['product_description'] = $input['product_description'][$key];
                        $insert['product_type'] = 1;
                        $insert['brand'] = $input['brand'][$key];
                        $insert['unit'] = $input['unit'][$key];
                        $insert['quantity'] = $input['quantity'][$key];
                        if ($input['quotation']['delivery_status'] == 'delivered') {
                            $insert['delivery_quantity'] = $input['quantity'][$key];
                        }
                        $insert['per_cost'] = $input['per_cost'][$key];
                        $insert['tax'] = $input['tax'][$key];
                        $insert['gst'] = $input['gst'][$key];
                        $insert['igst'] = $input['igst'][$key];
                        $insert['taxable_cost'] = $input['taxable_cost'][$key];
                        $insert['discount'] = (!empty($input['discount'][$key])) ? $input['discount'][$key] : '';
                        $insert['sub_total'] = $input['sub_total'][$key];
                        $insert['created_date'] = date('Y-m-d H:i:s');
                        $insert_arr[] = $insert;
                    }
                    $this->project_cost_model->insert_invoice_details($insert_arr);
                }
            }
            if ($input['print'] == 'yes') {
                $file_name = base_url() . 'sales/invoice_views/' . $invoice_id;
                $file_name1 = base_url() . 'sales/invoice_pdf/' . $invoice_id;
                echo "<script>window.location.href = '$file_name';</script>";
                echo "<script>window.open('$file_name1');</script>";
                exit;
            } else {
                $redirect_url = base_url() . 'sales/invoice_list';
                echo "<script>window.location.href = '$redirect_url';</script>";
                exit;
            }
        }

        $data["category"] = $details = $this->categories_model->get_all_category();
        $data["brand"] = $this->brand_model->get_brand();
        $data["nick_name"] = $this->gen_model->get_all_nick_name();
        $data["ref_grps"] =array();
        $data['company_details'] = $this->admin_model->get_company_details();
        $data['firms'] = $firms = $this->user_auth->get_user_firms();
        $data["sales_man"] = $this->sales_man_model->get_sales_man();
        $data["products"] = $this->gen_model->get_all_product();
        $firm_id = array_column($data['firms'], 'firm_id');
        $data["customers"] = $this->gen_model->get_all_customers($firm_id);
        $data["states"]=$this->master_state_model->get_all_state();
        $this->template->write_view('content', 'sales/new_direct_invoice', $data);
        $this->template->render();
    }

    public function update_invoice() {

        if ($this->input->post()) {

            $input = $this->input->post();
            
            $customer =$input['customer'];

            $user_info = $this->user_auth->get_from_session('user_info');

            //Update Invoice Data
            $invoice_data['inv_id']=$input['quotation']['inv_id'];
            $invoice_data['q_id']=0;
            $invoice_data['customer']=$customer['id'];
            $invoice_data['customer_po']=$input['quotation']['customer_po'];
            $invoice_data['sales_man']=$input['quotation']['sales_man'];
            $invoice_data['total_qty']=$input['quotation']['total_qty'];
            $invoice_data['delivery_qty']=$input['quotation']['total_qty'];
            $invoice_data['cgst_price']=$input['quotation']['cgst_price'];
            $invoice_data['sgst_price']=$input['quotation']['sgst_price'];
            $invoice_data['igst_price']=$input['quotation']['igst_price'];
            $invoice_data['taxable_price']=$input['quotation']['taxable_price'];
            if($input['customer']['state_id'] == 31)
                $invoice_data['tax']=$input['quotation']['cgst_price'] + $input['quotation']['sgst_price'];
            else
                $invoice_data['tax']=$input['quotation']['cgst_price'] + $input['quotation']['igst_price'];
            $invoice_data['subtotal_qty']=$input['quotation']['subtotal_qty'];
            $invoice_data['net_total']=$input['quotation']['net_total'];
            $invoice_data['round_off']=$input['quotation']['round_off'];
            $invoice_data['transport']=($input['quotation']['transport']) ? $input['quotation']['transport'] : '0.00';
            $invoice_data['labour']=($input['quotation']['labour']) ? $input['quotation']['labour'] : '0.00';
            $invoice_data['remarks']=$input['quotation']['remarks'];
            $invoice_data['bill_type']=$input['quotation']['bill_type'];
            $invoice_data['created_date']=date('Y-m-d',strtotime($input['quotation']['created_date']));
            $invoice_data['credit_due_date']=date('Y-m-d',strtotime($input['quotation']['created_date']));
            $invoice_data['created_by']=$user_info[0]['id'];
            
            $this->project_cost_model->update_invoice($invoice_data,$input['quotation']['id']);
            $invoice_id = $input['quotation']['id'];
            $this->project_cost_model->delete_invoice_details($invoice_id);
            if (isset($invoice_id) && !empty($invoice_id)) {
                if (isset($input['product_id']) && !empty($input['product_id'])) {
                    $insert_arr = array();
                    foreach ($input['product_id'] as $key => $val) {
                        $insert['in_id'] = $invoice_id;
                        $insert['q_id'] = 0;
                        $insert['category'] = $input['category'][$key];
                        $insert['product_id'] = $val;
                        $insert['product_description'] = $input['product_description'][$key];
                        $insert['product_type'] = 1;
                        $insert['brand'] = $input['brand'][$key];
                        $insert['unit'] = $input['unit'][$key];
                        $insert['quantity'] = $input['quantity'][$key];
                        if ($input['quotation']['delivery_status'] == 'delivered') {
                            $insert['delivery_quantity'] = $input['quantity'][$key];
                        }
                        $insert['per_cost'] = $input['per_cost'][$key];
                        $insert['tax'] = $input['tax'][$key];
                        $insert['gst'] = $input['gst'][$key];
                        $insert['igst'] = $input['igst'][$key];
                        $insert['taxable_cost'] = $input['taxable_cost'][$key];
                        $insert['discount'] = (!empty($input['discount'][$key])) ? $input['discount'][$key] : '';
                        $insert['sub_total'] = $input['sub_total'][$key];
                        $insert['created_date'] = date('Y-m-d H:i:s');
                        $insert_arr[] = $insert;
                    }
                    $this->project_cost_model->insert_invoice_details($insert_arr);
                }
            }

            redirect($this->config->item('base_url') . 'sales/invoice_list');
        }
    }

    public function invoice_views($id) {

        $datas["quotation"] = $quotation = $this->project_cost_model->get_all_invoice_by_id($id);

        $datas["in_words"] = $this->convert_number($datas["quotation"][0]['net_total']);

        $datas["quotation_details"] = $quotation_details = $this->project_cost_model->get_all_invoice_details_by_id($id);

        $datas["category"] = $category = $this->categories_model->get_all_category();

        $datas['company_details'] = $this->admin_model->get_company_details();

        $datas["brand"] = $brand = $this->brand_model->get_brand();

        $datas["user_info"] = $this->user_auth->get_from_session('user_info');

        $datas['company_details'] = $this->project_cost_model->get_company_details_by_firm($id);

        $this->template->write_view('content', 'invoice_views', $datas);

        $this->template->render();
    }

    public function check_duplicate_records(){
        $post_data = $this->input->post('check_duplicate');
        $data = $this->project_cost_model->check_duplicate_records($post_data);
        echo json_encode($data);
    }

    public function invoice_delete() {

        $id = $this->input->POST('value1');

        $this->project_cost_model->delete_inv_by_id($id);

        $this->project_cost_model->delete_invoice($id);

       echo 1;
    }

   
   

  
    
    
    

   

  

    public function get_customer($id) {

        $atten_inputs = $this->input->get();

        $data = $this->project_cost_model->get_customer($atten_inputs, $id);

        echo '<ul id="country-list">';

        if (isset($data) && !empty($data)) {

            foreach ($data as $st_rlno) {

                if ($st_rlno['name'] != '')
                    echo '<li class="cust_class" cust_name="' . $st_rlno['name'] . '" cust_id="' . $st_rlno['id'] . '" cust_no="' . $st_rlno['mobil_number'] . '" cust_email="' . $st_rlno['email_id'] . '" cust_address="' . $st_rlno['address1'] . '" cust_tin="' . $st_rlno['tin'] . '">' . $st_rlno['name'] . '</li>';
            }
        }

        else {

            echo '<li style="color:red;">No Data Found</li>';
        }

        echo '</ul>';
    }

    

    public function get_customer_by_id() {

        $input = $this->input->post();

        $data_customer["customer_details"] = $this->project_cost_model->get_customer_by_id($input['id']);

        echo json_encode($data_customer);

        exit;
    }

    public function get_product($id) {

        $atten_inputs = $this->input->get();

        $product_data = $this->project_cost_model->get_product($atten_inputs, $id);



        echo '<ul id="product-list">';

        if (isset($product_data) && !empty($product_data)) {

            foreach ($product_data as $st_rlno) {

                if ($st_rlno['product_name'] != '')
                    echo '<li class="pro_class" pro_cost="' . $st_rlno['cost_price'] . '" pro_id="' . $st_rlno['id'] . '" mod_no="' . $st_rlno['model_no'] . '" pro_name="' . $st_rlno['product_name'] . '" pro_description="' . $st_rlno['product_description'] . '" pro_image="' . $st_rlno['product_image'] . '" pro_cgst="' . $st_rlno['cgst'] . '"pro_sgst ="' . $st_rlno['sgst'] . '"pro_cat ="' . $st_rlno['category_id'] . '">' . $st_rlno['product_name'] . '</li>';
            }
        }

        else {

            echo '<li style="color:red;">No Data Found</li>';
        }

        echo '</ul>';
    }

    public function get_product_by_id() {

        $input = $this->input->post();

        $data_customer["product_details"] = $this->project_cost_model->get_product_by_id($input['id']);

        echo json_encode($data_customer);

        exit;
    }

    public function delete_id() {

        $input = $this->input->get();

        $del = $this->project_cost_model->delete_id($input['del_id']);
    }

    public function delete_pc_id() {

        $input = $this->input->get();

        $del = $this->project_cost_model->delete_pc_id($input['del_id']);
    }

   
    

    public function approve_invoice() {

        $id = $this->input->POST('id');

        if ($id != '') {

            $approve = $this->project_cost_model->approve_invoice($id);

            if ($approve) {

                echo 'success';

                exit;
            }
        }
    }

    public function send_email() {

        $this->load->library("Pdf");

        $id = $this->input->get();

        $data["quotation"] = $quotation = $this->project_cost_model->get_all_invoice_by_id($id['id']);

        $data["quotation_details"] = $quotation_details = $this->project_cost_model->get_all_invoice_details_by_id($id['id']);

        $data["category"] = $category = $this->categories_model->get_all_category();

        $data['company_details'] = $this->admin_model->get_company_details();

        $data["brand"] = $brand = $this->brand_model->get_brand();

        $data["email_details"] = $email_details = $this->project_cost_model->get_all_email_details();



        $this->load->library('email');

        $config['protocol'] = 'sendmail';

        $config['mailpath'] = '/usr/sbin/sendmail';

        $config['charset'] = 'iso-8859-1';

        $config['wordwrap'] = TRUE;

        $this->email->initialize($config);

// $to_array = array($data['company_details'][0]['email'], $data['quotation'][0]['email_id']);

        $to_array = array($data['quotation'][0]['email_id']);

        $this->email->clear(TRUE);

        $this->email->to(implode(', ', $to_array));

        $this->email->from($data['email_details'][1]['value'], $data['email_details'][0]['value']);

// $this->email->to($data['company_details'][0]['email'],$data['quotation'][0]['email_id']);

        $this->email->cc($data['email_details'][3]['value']);

        $this->email->subject($data['email_details'][2]['value']);

        $this->email->set_mailtype("html");

        $msg1['test'] = $this->load->view('sales/email_page', $data, TRUE);

//$msg1['company_details']=$data['company_details'];

        $header = $this->load->view('quotation/pdf_header_view', $data, TRUE);

        $msg = $this->load->view('sales/pdf_email_template', $msg1, TRUE);

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);



        $pdf->AddPage();

        $pdf->Header($header);

        $pdf->writeHTMLCell(0, 0, '', '', $msg, 0, 1, 0, true, '', true);

        $filename = 'Invoice-' . date('d-M-Y-H-i-s') . '.pdf';

        $newFile = $this->config->item('theme_path') . 'attachement/' . $filename;

        $pdf->Output($newFile, 'F');

//echo "<pre>"; print_r($data); exit;

        $this->email->attach($this->config->item('theme_path') . 'attachement/' . $filename);

        $this->email->message('Dear ' . $data['quotation'][0]['name'] . ',<br> We Thank you for choosing us, Kindly find the attachment for Invoice Details <b>' . $data['quotation'][0]['inv_id'] . '</b><br>'
                . 'Company Name - ' . $data['quotation'][0]['store_name'] . '<br>

                       Address - ' . $data['quotation'][0]['address1'] . ' <br>

                        PH - ' . $data['quotation'][0]['mobil_number'] . ' <br>

                        Email ID - ' . $data['quotation'][0]['email_id'] . ' <br><br><br>Thanks<br>');

        $this->email->send();
    }

 

    function convert_number($number) {



        $hyphen = '-';

        $conjunction = '  ';

        $separator = ' ';

        $negative = 'negative ';

        $decimal = ' Rupees And ';

        $dictionary = array(
            0 => 'Zero',
            1 => 'One',
            2 => 'Two',
            3 => 'Three',
            4 => 'Four',
            5 => 'Five',
            6 => 'Six',
            7 => 'Seven',
            8 => 'Eight',
            9 => 'Nine',
            10 => 'Ten',
            11 => 'Eleven',
            12 => 'Twelve',
            13 => 'Thirteen',
            14 => 'Fourteen',
            15 => 'Fifteen',
            16 => 'Sixteen',
            17 => 'Seventeen',
            18 => 'Eighteen',
            19 => 'Nineteen',
            20 => 'Twenty',
            30 => 'Thirty',
            40 => 'Fourty',
            50 => 'Fifty',
            60 => 'Sixty',
            70 => 'Seventy',
            80 => 'Eighty',
            90 => 'Ninety',
            100 => 'Hundred',
            1000 => 'Thousand',
            1000000 => 'Million',
            1000000000 => 'Billion',
            1000000000000 => 'Trillion',
            1000000000000000 => 'Quadrillion',
            1000000000000000000 => 'Quintillion'
        );



        if (!is_numeric($number)) {

            return false;
        }



        if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {

// overflow

            trigger_error(
                    'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX, E_USER_WARNING
            );

            return false;
        }



        if ($number < 0) {

            return $negative . $this->convert_number(abs($number));
        }



        $string = $fraction = null;



        if (strpos($number, '.') !== false) {

            list($number, $fraction) = explode('.', $number);
        }



        switch (true) {

            case $number < 21:

                $string = $dictionary[$number];

                break;

            case $number < 100:

                $tens = ((int) ($number / 10)) * 10;

                $units = $number % 10;

                $string = $dictionary[$tens];

                if ($units) {

                    $string .= $hyphen . $dictionary[$units];
                }

                break;

            case $number < 1000:

                $hundreds = $number / 100;

                $remainder = $number % 100;

                $string = $dictionary[$hundreds] . ' ' . $dictionary[100];

                if ($remainder) {

                    $string .= $conjunction . $this->convert_number($remainder);
                }

                break;

            default:

                $baseUnit = pow(1000, floor(log($number, 1000)));

                $numBaseUnits = (int) ($number / $baseUnit);

                $remainder = $number % $baseUnit;

                $string = $this->convert_number($numBaseUnits) . ' ' . $dictionary[$baseUnit];

                if ($remainder) {

                    $string .= $remainder < 100 ? $conjunction : $separator;

                    $string .= $this->convert_number($remainder);
                }

                break;
        }



        if (null !== $fraction && is_numeric($fraction)) {

            $string .= $decimal;

            $words = array();

            $i = 0;

            foreach (str_split((string) $fraction) as $number) {

                $i++;

                if ($i == 1) {

                    $number = $number * 10;
                }

                $words[] = $dictionary[$number];
            }

//print_r($words);

            $string .= $words[0] . ' ' . $words[1] . ' Paise Only';
        }



        return $string;
    }

    function clear_cache() {

        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");

        $this->output->set_header("Pragma: no-cache");
    }

}
