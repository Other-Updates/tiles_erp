    <?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customers extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->clear_cache();
        if (!$this->user_auth->is_logged_in()) {
            redirect($this->config->item('base_url') . 'admin');
        }
        $main_module = 'masters';
        $access_arr = array(
            'customers/index' => array('add', 'edit', 'delete', 'view'),
            'customers/insert_customer' => array('add'),
            'customers/edit_customer' => array('edit'),
            'customers/update_customer' => array('edit'),
            'customers/delete_customer' => array('delete'),
            'customers/add_duplicate_email' => array('add', 'edit'),
            'customers/update_duplicate_email' => array('add', 'edit'),
            'customers/add_duplicate_mobile' => array('add', 'edit'),
            'customers/update_duplicate_mobile' => array('add', 'edit'),
            'customers/import_customers' => array('add', 'edit', 'delete', 'view'),
            'customers/add_state' => array('add', 'edit'),
            'customers/excel' => 'no_restriction',
            'customers/pdf' => 'no_restriction',
            'customers/ajaxList' => 'no_restriction',
            'customers/customer_piechart' => 'no_restriction',
            'customers/customer_barchart' => 'no_restriction',
        );

        if (!$this->user_auth->is_permission_allowed($access_arr, $main_module)) {
            redirect($this->config->item('base_url'));
        }
        $this->load->model('sales/project_cost_model');
        $this->load->model('masters/customer_model');
        $this->load->model('masters/manage_firms_model');
        $this->get_arr = is_array($this->input->get(null)) ? $this->input->get(null) : array();
        $this->post_arr = is_array($this->input->post(null)) ? $this->input->post(null) : array();
        $this->params_arr = array_merge($this->get_arr, $this->post_arr);
        $this->load->model('api/notification_model');
        if (isset($_GET['notification']))
            $this->notification_model->update_notification(array('status' => 1), $_GET['notification']);
    }

    public function index() {
        $data["customer"] = $this->customer_model->get_customer();
        $data['all_state'] = $this->customer_model->state();
        $data['all_street'] = $this->customer_model->get_all_street();
        // $data['firms'] = $firms = $this->user_auth->get_user_firms();
        $data["firms"] = $this->manage_firms_model->get_all_firms();
        $this->template->write_view('content', 'masters/customer', $data);
        $this->template->render();
    }

    public function insert_customer() {
        if ($this->input->post('customer_region') == 'local') {
            $street = $this->input->post('street_name');
        }
        $input_data = array(
            'name' => $this->input->post('name'),
            'store_name' => $this->input->post('store'),
            'address1' => $this->input->post('address1'),
            'address2' => $this->input->post('address2'),
            'city' => $this->input->post('city'),
            //'pincode'=>$this->input->post('pin'),
            'mobil_number' => $this->input->post('number'),
            'email_id' => $this->input->post('mail'),
            'dob' => date('d/m/Y', strtotime($this->input->post('dob'))),
            'anniversary' => date('d/m/Y', strtotime($this->input->post('anniversary'))),
            'bank_name' => $this->input->POST('bank'),
            'bank_branch' => $this->input->POST('branch'),
            'account_num' => $this->input->POST('acnum'),
            'state_id' => $this->input->post('state_id'),
            'ifsc' => $this->input->post('ifsc'),
            'agent_name' => $this->input->post('agent_name'),
            'payment_terms' => $this->input->post('payment_terms'),
            'advance' => $this->input->post('advance'),
            'tin' => $this->input->post('tin'),
            'customer_type' => $this->input->post('customer_type'),
            'customer_region' => $this->input->post('customer_region'),
            'credit_days' => $this->input->post('credit_days'),
            'credit_limit' => $this->input->post('credit_limit'),
            'firm_id' => $this->input->POST('firm_id'),
            'created_by' => $this->user_auth->get_user_id(),
            'street_name' => !empty($street) ? $street : '',
        );
        /* if ($this->input->post('credit_days') != '' && $this->input->post('credit_days') > 0) {
          $this->load->model('api/notification_model');
          $current_date = date('Y-m-d');
          $notification = array();
          $notification['notification_date'] = date('Y-m-d', strtotime("+" . $this->input->post('credit_days') . " days"));
          ;
          $notification['type'] = 'credit_days';
          $notification['link'] = 'masters/customers/edit_customer/' . $id;
          $notification['Message'] = 'Credit Days Exceeded for ' . $this->input->post('name');
          $this->notification_model->insert_notification($notification);
          } */
        $customer_id = $this->customer_model->insert_customer($input_data);

        $data["customer"] = $this->customer_model->get_customer();
        redirect($this->config->item('base_url') . 'masters/customers', $data);
    }

    public function edit_customer($id) {
        $data['all_state'] = $this->customer_model->state();
        $data["customer"] = $this->customer_model->get_customer1($id);
        $data["firms"] = $this->manage_firms_model->get_all_firms();
        $data['user_id'] = $this->user_auth->get_user_id();

        $data['all_street'] = $this->customer_model->get_all_street();
        $this->template->write_view('content', 'masters/update_customer', $data);
        $this->template->render();
    }

    public function update_customer() {
        $id = $this->input->POST('id');
        $dob = $this->input->post('dob');
        if ($this->input->post('temp_credit') != '' && $this->input->post('approved_by') != '') {
            $temp_credit_limit = $this->input->post('temp_credit');
            $approved_by = $this->input->post('approved_by');
        } else {
            $temp_credit_limit = NULL;
            $approved_by = NULL;
        }
        if ($this->input->post('customer_region') == 'local') {
            $street = $this->input->post('street_name');
        }
        $input = array(
            'name' => $this->input->post('name'),
            'store_name' => $this->input->post('store'),
            'address1' => $this->input->post('address1'),
            'address2' => $this->input->post('address2'),
            'city' => $this->input->post('city'),
            //'pincode'=>$this->input->post('pin'),
            'mobil_number' => $this->input->post('number'),
            'email_id' => $this->input->post('mail'),
            'dob' => $this->input->post('dob'),
            'anniversary' => $this->input->post('anniversary'),
            'bank_name' => $this->input->POST('bank'),
            'bank_branch' => $this->input->POST('branch'),
            'account_num' => $this->input->POST('acnum'),
            'state_id' => $this->input->post('state_id'),
            'ifsc' => $this->input->post('ifsc'),
            'agent_name' => $this->input->post('agent_name'),
            'payment_terms' => $this->input->post('payment_terms'),
            'advance' => $this->input->post('advance'),
            'tin' => $this->input->post('tin'),
            'customer_type' => $this->input->post('customer_type'),
            'customer_region' => $this->input->post('customer_region'),
            'credit_days' => $this->input->post('credit_days'),
            'credit_limit' => $this->input->post('credit_limit'),
            'temp_credit_limit' => $temp_credit_limit,
            'approved_by' => $approved_by,
            'firm_id' => $this->input->POST('firm_id'),
            'created_by' => $this->user_auth->get_user_id(),
            'street_name' => !empty($street) ? $street : '',
        );

        /* if ($this->input->post('credit_days') != '' && $this->input->post('credit_days') > 0) {
          $this->load->model('api/notification_model');
          $current_date = date('Y-m-d');
          $notification = array();
          $notification['notification_date'] = date('Y-m-d', strtotime("+" . $this->input->post('credit_days') . " days"));
          ;
          $notification['type'] = 'credit_days';
          $notification['link'] = 'masters/customers/edit_customer/' . $id;
          $notification['Message'] = 'Credit Days Exceeded for ' . $this->input->post('name');
          $this->notification_model->insert_notification($notification);
          } */

        $this->customer_model->update_customer($input, $id);

        redirect($this->config->item('base_url') . 'masters/customers/');
    }

    public function delete_customer() {
        $this->load->model('masters/customer_model');
        $data["customer"] = $this->customer_model->get_customer();
        $id = $this->input->POST('value1');
        {
            $this->customer_model->delete_customer($id);

            redirect($this->config->item('base_url') . 'masters/customers', $data);
        }
    }

    public function add_duplicate_email() {
        $this->load->model('masters/customer_model');
        $input = $this->input->get('value1');
        $validation = $this->customer_model->add_duplicate_email($input);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Email Already Exist";
        }
    }

    public function add_duplicate_mobile() {
        $this->load->model('masters/customer_model');
        $input = $this->input->post();
        $validation = $this->customer_model->add_duplicate_mobile($input);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Number Already Exist";
        }
    }

    public function update_duplicate_email() {
        $this->load->model('masters/customer_model');
        $input = $this->input->post('value1');
        $id = $this->input->post('value2');
        $validation = $this->customer_model->update_duplicate_email($input, $id);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Email already Exist";
        }
    }

    public function update_duplicate_mobile() {
        $this->load->model('masters/customer_model');
        $input = $this->input->post('value1');
        $id = $this->input->post('value2');
        $validation = $this->customer_model->update_duplicate_mobile($input, $id);
        $i = 0;
        if ($validation) {
            $i = 1;
        }if ($i == 1) {
            echo "Number already Exist";
        }
    }

    public function add_state() {
        $this->load->model('masters/customer_model');
        $input = $this->input->get();
        $insert_id = $this->customer_model->insert_state($input);
        echo $insert_id;
    }

    function import_customers() {
        if ($this->input->post()) {
            $is_success = 0;
            if (!empty($_FILES['customer_data'])) {
                $config['upload_path'] = './attachement/csv/';
                $config['allowed_types'] = '*';
                $config['max_size'] = '10000';
                $this->load->library('upload', $config);
                $random_hash = substr(str_shuffle(time()), 0, 3) . strrev(mt_rand(100000, 999999));
                $extension = pathinfo($_FILES['customer_data']['name'], PATHINFO_EXTENSION);
                $new_file_name = 'customer_' . $random_hash . '.' . $extension;
                $_FILES['customer_data'] = array(
                    'name' => $new_file_name,
                    'type' => $_FILES['customer_data']['type'],
                    'tmp_name' => $_FILES['customer_data']['tmp_name'],
                    'error' => $_FILES['customer_data']['error'],
                    'size' => $_FILES['customer_data']['size']
                );
                $config['file_name'] = $new_file_name;
                $this->upload->initialize($config);

                $this->upload->do_upload('customer_data');
                $upload_data = $this->upload->data();
                $file_name = $upload_data['file_name'];
                $file = base_url() . 'attachement/csv/' . $file_name;
                $handle = fopen($file, 'r');

                $skip_rows = 1;
                if ($file != NULL && $skip_rows > 0) {
                    $skipLines = $skip_rows;
                    $lineNum = 1;
                    if ($skipLines > 0) {
                        while (fgetcsv($handle)) {
                            if ($lineNum == $skipLines) {
                                break;
                            }
                            $lineNum++;
                        }
                    }
                }

                if ($file != NULL) {
                    while ($row_data = fgetcsv($handle)) {
                        $store_name = $row_data[0];
                        $email_id = $row_data[2];
                        $mobile = $row_data[3];
                        $status = 'Active';
                        $address1 = $row_data[4];

                        if ($store_name != '' && $store_name != ',') {
                            $firm_name = $row_data[1];

                            $firm_details = $this->customer_model->getfirm_id_based_on_firm_name($firm_name);

                            $firm_id = $firm_details[0]['firm_id'];
                            $cust_id = $this->customer_model->is_customer_name_exist($store_name, $firm_id);
                            $customer_data = array();
                            $customer_data['name'] = $store_name;
                            $customer_data['store_name'] = $store_name;
                            $customer_data['email_id'] = $email_id;
                            $customer_data['mobil_number'] = $mobile;
                            $customer_data['status'] = 1;
                            $customer_data['address1'] = $address1;
                            $customer_data['state_id'] = 31;
                            $customer_data['firm_id'] = $firm_id;
                            $customer_data['created_date'] = date('Y-m-d H:i:s');
                            if (empty($cust_id)) {
                                $cust_id = $this->customer_model->insert_customer($customer_data);
                            } else {
                                $this->customer_model->update_customer($customer_data, $cust_id);
                            }
                        }
                    }
                }
                $is_success = 1;
            }
            if ($is_success) {
                redirect($this->config->item('base_url') . 'masters/customers');
            }
        }
    }

    function ajaxList() {
        $list = $this->customer_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $ass) {
            $customer_type = '';
            if ($ass->customer_type == 1) {
                $customer_type = 'T1';
            } else if ($ass->customer_type == 2) {
                $customer_type = 'T2';
            } else if ($ass->customer_type == 3) {
                $customer_type = 'T3';
            } else if ($ass->customer_type == 4) {
                $customer_type = 'T4';
            } else if ($ass->customer_type == 5) {
                $customer_type = 'T5';
            } else if ($ass->customer_type == 6) {
                $customer_type = 'T6';
            } else if ($ass->customer_type == 7) {
                $customer_type = 'H1';
            } else if ($ass->customer_type == 8) {
                $customer_type = 'H2';
            }
            //  $edit_access = ($edit_access == 0) ? 'blocked_access' : '';
            // $delete_access = ($delete_access == 0) ? 'blocked_access' : '';
            $edit_row = '<a class="tooltips  btn btn-default btn-xs" href="' . base_url() . 'masters/customers/edit_customer/' . $ass->id . '"><i class="fa fa-edit" title="Edit"></i></a>';
            $delete_row = '<a onclick="check(' . $ass->id . ')" class="btn btn-default btn-xs delete_row" delete_id="test3_' . $ass->id . '" name="delete" title="In-Active" id="delete"><i class="fa fa-ban"></i></a>';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $ass->firm_name;
            $row[] = ucfirst($ass->store_name);
            $row[] = $customer_type;
            $row[] = $ass->mobil_number;
            $row[] = $ass->email_id;
            $row[] = $edit_row . '&nbsp;&nbsp;' . $delete_row;
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->customer_model->count_all(),
            "recordsFiltered" => $this->customer_model->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
        exit;
    }

    function customer_piechart() {
        $local_customers = $this->customer_model->count_local_customers();
        $non_local_customers = $this->customer_model->count_non_local_customers();
        $responce->cols[] = array(
            "id" => "",
            "label" => "Topping",
            "pattern" => "",
            "type" => "string"
        );
        $responce->cols[] = array(
            "id" => "",
            "label" => "Total",
            "pattern" => "",
            "type" => "number"
        );

        $responce->rows[]["c"] = array(
            array(
                "v" => "Local Customers",
                "f" => null
            ),
            array(
                "v" => $local_customers,
                "f" => null
            )
        );
        $responce->rows[]["c"] = array(
            array(
                "v" => "Non-Local Customers",
                "f" => null
            ),
            array(
                "v" => $non_local_customers,
                "f" => null
            )
        );


        echo json_encode($responce);
        exit;
    }

    function customer_barchart() {
        $customers = $this->customer_model->get_customer();
        $current_month = date('m');
        $month_range = $current_month - 5;
        $responce->cols[] = array(
            "id" => "",
            "label" => "Year",
            "pattern" => "",
            "type" => "string"
        );
        $responce->cols[] = array(
            "id" => "",
            "label" => "Local Customers",
            "pattern" => "",
            "type" => "number"
        );
        $responce->cols[] = array(
            "id" => "",
            "label" => "Non-Local Customers",
            "pattern" => "",
            "type" => "number"
        );
        for ($i = $current_month; $i >= $month_range; $i--) {
            $local_customers = $this->customer_model->count_local_customers(1, $i);
            $non_local_customers = $this->customer_model->count_non_local_customers(1, $i);
            $responce->rows[]["c"] = array(
                array(
                    "v" => date('F', mktime(0, 0, 0, $i, 10)),
                    "f" => null
                ),
                array(
                    "v" => $local_customers,
                    "f" => null
                ),
                array(
                    "v" => $non_local_customers,
                    "f" => null
                )
            );
        }
        echo json_encode($responce);
        exit;
    }

    function clear_cache() {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

}
