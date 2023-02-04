<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends MX_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('admin/admin_model');
        $this->load->model('payments/payment_model');
        $this->load->model('sales/project_cost_model');
        
    }

    public function index($status = NULL) {
        $this->load->model('admin/admin_model');
        $user_info = $this->user_info = $this->user_auth->get_from_session('user_info');

        $data['admin'] = $this->admin_model->get_admin($user_info[0]['role'], $user_info[0]['id']);
        if ($this->input->post()) {
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            if ($this->user_auth->login($username, $password)) {
                $login_data = $this->admin_model->login($this->input->post());
                $session_array = array('user_info' => $login_data);
                $this->user_auth->store_in_session($session_array);
                redirect($this->config->item('base_url') . 'admin/dashboard');
            } else
                redirect($this->config->item('base_url') . 'admin?login=fail');
        }

        $data['login_status'] = 'success';
        if (isset($status) && $status != NULL) {
            $data['status'] = $status;
        }
        if (isset($_REQUEST['index']) && $_REQUEST['index'] == 'fail') {
            $data['login_status'] = 'fail';
        }

        $this->template->set_master_template('../../themes/' . $this->config->item("active_template") . '/template_login.php');
        $this->template->write_view('content', 'admin/index');
        $this->template->render();
    }

    public function dashboard() {
        $data['total_customers']=$this->admin_model->getTotalCustomers();
        $data['total_invoice']=$this->admin_model->getTotalInvoice();
        $data['invoice_amount']=$this->admin_model->getTotalInvoiceAmount();
        $data['paid_amount']=$this->admin_model->getTotalPaidAmount();
        $data['recent_invoice']=$this->project_cost_model->getInvoicelist('10');
        $data['recent_payments']=$this->payment_model->getPaymentslist('10');
        $this->template->write_view('content', 'admin/dashboard', $data);
        $this->template->render();
    }

    function logout($status = NULL) {
        $data = array();
        $this->user_auth->logout();

        if (isset($status) && $status != NULL) {
            redirect($this->config->item('base_url') . 'admin?inactive=true');
        }
        redirect($this->config->item('base_url') . 'admin');
    }

    public function update_profile() {
        $this->load->model('admin/admin_model');
        if ($this->input->post()) {
            $conpany_details = $this->input->post('company');
            $this->admin_model->insert_company_details($conpany_details);
            $user_info = $this->user_info = $this->user_auth->get_from_session('user_info');
            $data["admin"] = $this->admin_model->get_admin($user_info[0]['role'], $user_info[0]['id']);

            $this->load->helper('text');

            $config['upload_path'] = './admin_image/original';

            $config['allowed_types'] = '*';

            $config['max_size'] = '2000';

            $this->load->library('upload', $config);

            $upload_data['file_name'] = $_FILES;
            if (isset($_FILES) && !empty($_FILES)) {
                $upload_files = $_FILES;
                if ($upload_files['admin_image'] != '') {
                    $_FILES['admin_image'] = array(
                        'name' => $upload_files['admin_image']['name'],
                        'type' => $upload_files['admin_image']['type'],
                        'tmp_name' => $upload_files['admin_image']['tmp_name'],
                        'error' => $upload_files['admin_image']['error'],
                        'size' => '2000'
                    );
                    $this->upload->do_upload('admin_image');

                    $upload_data = $this->upload->data();

                    $dest = getcwd() . "/admin_image/original/" . $upload_data['file_name'];

                    $src = $this->config->item("base_url") . 'admin_image/original/' . $upload_data['file_name'];
                }
            }
            $user_info = $this->user_info = $this->user_auth->get_from_session('user_info');
            $id = $user_info[0]['id'];
            $role = $user_info[0]['role'];
            $password = $this->input->post('password');
            $input_data['admin']['admin_image'] = $upload_data['file_name'];
            $input = array();
            $input['username'] = $this->input->post('admin_name');
            if (isset($password) && !empty($password)) {
                $pass = md5($password);
                $input['password'] = $pass;
            }
            if (isset($upload_data['file_name']) && !empty($upload_data['file_name'])) {
                $input['admin_image'] = $upload_data['file_name'];
            }
            if (isset($input) && !empty($input))
                $this->admin_model->update_profile($input, $role, $id);
            redirect($this->config->item('base_url') . 'admin/dashboard');
        }
        $user_info = $this->user_info = $this->user_auth->get_from_session('user_info');
        $data["admin"] = $this->admin_model->get_admin($user_info[0]['role'], $user_info[0]['id']);
        $data['company_details'] = $this->admin_model->get_company_details();
        $this->template->write_view('content', 'admin/update_profile', $data);
        $this->template->render();
    }

    function clear_cache() {
        $this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate, no-transform, max-age=0, post-check=0, pre-check=0");
        $this->output->set_header("Pragma: no-cache");
    }

}
