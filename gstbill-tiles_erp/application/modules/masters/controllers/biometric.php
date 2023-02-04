<?php

class Biometric extends MX_Controller {

    function __construct() {

        parent::__construct();

        $this->load->helper('url');

        $this->load->library('session');

        $this->load->helper('form');

        $this->load->library("pagination");

        //  $this->load->library('user_auth');

        /*

          if (!$this->user_auth->active_application()) {

          redirect($this->config->item("base_url") . "users/login/");
          }



          if ($this->router->method == "index") {

          if (!$this->user_auth->get_user_permission("admin_dashboard:index")) {



          $this->session_messages->add_message('warning', 'You dont have permission to access this area');

          redirect($this->config->item("base_url") . "users/");
          }
          } else if ($this->router->method == "generate_id_card") {

          if (!$this->user_auth->get_user_permission("masters:id_card")) {



          $this->session_messages->add_message('warning', 'You dont have permission to access this area');

          redirect($this->config->item("base_url") . "users/");
          }
          } else {

          if ($this->user_auth->get_user_permission($this->router->class . ":" . $this->router->method)) {



          if ($this->router->method == "view_public_holiday" && $this->router->class == "masters") {

          if (!$this->user_auth->get_user_permission("masters:public_holidays")) {

          $this->session_messages->add_message('warning', 'You dont have permission to access this area');

          redirect($this->config->item("base_url") . "users/");
          }
          }
          } else {

          $this->session_messages->add_message('warning', 'You dont have permission to access this area');

          redirect($this->config->item("base_url") . "users/");
          }
          }

         */


        /* $datam["messages"]= $this->session_messages->view_all_messages();

          $this->template->write_view('session_msg', 'masters/session_messages',$datam); */

        $this->load->model('masters/department_model');
        $this->load->model('masters/holidays_model');
        $this->load->model('masters/options_model');
        $this->load->model('masters/temp_data_model');
        $this->load->model('masters/increment_model');
        $this->load->model('masters/user_roles_model');
        $this->load->model('masters/users_model');
        $this->load->model('masters/shift_model');
        $this->load->model('masters/salary_group_model');
        $this->load->model('masters/designation_model');
        $this->load->model('masters/designation_model');
        $this->load->model('temp_data_model');
        $this->load->library('make_thumb');
        $this->load->model('masters/user_roles_model');
        $this->load->model('masters/emergency_contacts_model');
    }

    function index() {

        $this->load->model('attendance/leave_model');

        $this->load->model('attendance/attendance_model');

        $this->load->model('users_model');

        $this->load->model('options_model');

        $this->load->model('user_roles_model');

        $this->load->model('department_model');

        $this->load->model('designation_model');



        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $week_starting_day = $this->options_model->get_options_by_type('week_starting_day');


        $today = date('Y-m-d');

        $start = "";

        $end = "";



        $week_start_date = date('Y-m-d', strtotime("+1 days"));

        $week_end_date = date('Y-m-d', strtotime("+7 days"));



        $today_count = $this->leave_model->get_user_leaves_count_by_today($today);

        $week_count = $this->leave_model->get_user_leaves_count_by_week($week_start_date, $week_end_date);



        $data["today_count"] = 0;

        $data["week_count"] = 0;

        if (isset($today_count) && !empty($today_count)) {

            $data["today_count"] = $today_count[0]["count"];
        }

        if (isset($week_count) && !empty($week_count)) {

            $data["week_count"] = $week_count[0]["count"];
        }

        $result1 = $result2 = array();



        $result1["total_rows"] = $data["today_count"];

        $result2["total_rows"] = $data["week_count"];

        $result1["base_url"] = $this->config->item('base_url') . "api/leaves_today/";

        $result2["base_url"] = $this->config->item('base_url') . "api/leaves_week/";

        $result1["per_page"] = $result2["per_page"] = 5;

        $result1["num_links"] = $result2["num_links"] = 3;

        $result1["uri_segment"] = $result2["uri_segment"] = 3;

        $result1['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01 today_ul">';

        $result2['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01 week_ul">';

        $result1['full_tag_close'] = '</ul>';

        $result1['prev_link'] = '&lt;';

        $result1['prev_tag_open'] = '<li>';

        $result1['prev_tag_close'] = '</li>';

        $result1['next_link'] = '&gt;';

        $result1['next_tag_open'] = '<li>';

        $result1['next_tag_close'] = '</li>';

        $result1['cur_tag_open'] = '<li class="current"><a href="#">';

        $result1['cur_tag_close'] = '</a></li>';

        $result1['num_tag_open'] = '<li>';

        $result1['num_tag_close'] = '</li>';



        $result1['first_tag_open'] = '<li>';

        $result1['first_tag_close'] = '</li>';

        $result1['last_tag_open'] = '<li>';

        $result1['last_tag_close'] = '</li>';



        $result1['first_link'] = '&lt;&lt;';

        $result1['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($result1);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;



        $data['today'] = $this->leave_model->get_user_leaves_by_today($result1["per_page"], $page, $today);

        $data["links1"] = $this->pagination->create_links();

        $data["start1"] = $page;



        $this->pagination->initialize($result2);

        $page1 = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data["week"] = $this->leave_model->get_user_leaves_by_week($result2["per_page"], $page1, $week_start_date, $week_end_date);

        $data["links2"] = $this->pagination->create_links();

        $data["start2"] = $page1;



        if ($this->input->post("go")) {

            $filter = $this->input->post();

            //print_r($filter);

            if (isset($filter["go"]))
                unset($filter["go"]);

            $this->session_view->add_session('masters', 'index', $filter);

            $data['no_of_users'] = $this->users_model->get_number_of_users_by_filter($filter, 1, $today);

            $data['no_of_users_present'] = $this->attendance_model->get_number_of_users_present_by_filter($filter);

            $data["filter"] = $filter;

            //echo $this->db->last_query();
        }

        else {

            $filter = $this->session_view->get_session('masters', 'index');

            if (isset($filter) && !empty($filter)) {

                $data['no_of_users'] = $this->users_model->get_number_of_users_by_filter($filter, 1, $today);

                $data['no_of_users_present'] = $this->attendance_model->get_number_of_users_present_by_filter($filter);

                $data["filter"] = $filter;
            } else {

                $data['no_of_users'] = $this->users_model->get_number_of_users(1, $today);

                $data['no_of_users_present'] = $this->attendance_model->get_number_of_users_present();
            }
        }



        $data['no_of_users'] = $data['no_of_users'][0]['count'];

        $data['no_of_users_present'] = $data['no_of_users_present'][0]['count'];

        $data['no_of_users_absent'] = $data['no_of_users'] - $data['no_of_users_present'];

        $data["departments"] = $this->department_model->get_all_departments_by_status(1);

        $data["designations"] = $this->designation_model->get_all_designations();

        //$this->pre_print->viewExit($data);

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/index', $data);

        $this->template->render();
    }

    //Employee Module

    function employees($page = null) {



        $this->load->model('users_model');

        $this->load->model('department_model');

        $this->load->model('designation_model');

        $this->load->model('options_model');

        $this->load->model('masters/user_roles_model');



//        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["default_number_of_records"] = $this->options_model->get_option_by_name('default_number_of_records');

        $result = array();

        $filter = null;



        if ($this->input->post("go")) {

            $filter = $this->input->post();





            if (isset($filter["go"]))
                unset($filter["go"]);



            $data["no_of_users1"] = $this->users_model->get_filter_user_count($filter, 1);


//            $this->session_view->add_session('masters', 'employees', $filter);



            redirect($this->config->item('base_url') . "masters/biometric/employees/");
        }

        else {

//            $filter = $this->session_view->get_session('masters', 'employees');



            if (isset($filter) && !empty($filter)) {

                $data["no_of_users1"] = $this->users_model->get_filter_user_count($filter, 1);
            } else {

                $data["no_of_users1"] = $this->users_model->get_users_count(1);
            }
        }

        if (isset($filter["show_count"]))
            $default = $filter["show_count"];



        else {

            if (isset($data["default_number_of_records"]) && !empty($data["default_number_of_records"]))
                $default = $data["default_number_of_records"][0]["value"];
            else
                $default = 10;
        }

        if (isset($filter["inactive"]))
            $data["status"] = TRUE;

//$result['suffix'] = '?show='.$default ;

        $result["total_rows"] = $data["no_of_users1"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/biometric/employees/";

        $result["per_page"] = $default;

        $data["count"] = $default;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

//        $this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if ($default == "all")
            $data['users'] = $this->users_model->get_users_with_dept($filter, 1);
        else
            $data['users'] = $this->users_model->get_users_with_dept_by_limit($result["per_page"], $page, $filter, 1);

        $data["links1"] = $this->pagination->create_links();

        $data["start"] = $page;

//$data["per_page"] = $default;
//echo $this->db->last_query();

        $data["departments"] = $this->department_model->get_all_departments_by_status(1);

        $data["designations"] = $this->designation_model->get_all_designations();

//print_r($filter);
//$this->pre_print->viewExit($data);
//        $datam["messages"] = $this->session_messages->view_all_messages();
//        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/employees', $data);

        $this->template->render();
    }

    function add_employee() {
        $validation = array();
        // $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());
        if ($this->input->post("users")) {

//            echo "<pre> In IF condition";
//            print_r($_POST);
//            exit;
            $input = $this->input->post();

            //echo "<pre> In IF condition";
            //  print_r($input);
            //exit;
//$this->pre_print->viewExit($input);
            // insert erp_user table - For TTBS Users..
            $ttbs_user = array();
            $ttbs_user['name'] = $input['users']['first_name'];
            $ttbs_user['nick_name'] = $input['users']['last_name'];
            $ttbs_user['username'] = $input['users']['username'];
            $ttbs_user['password'] = md5($input['users']['password']);
            $ttbs_user['admin_image'] = 'test';
            $ttbs_user['mobile_no'] = $input['users']['mobile'];
            $ttbs_user['email_id'] = $input['users']['email'];
            $ttbs_user['address'] = 'test';
            $ttbs_user['role'] = $input['role'];
            $ttbs_user['signature'] = 'test';
            $ttbs_user['status'] = '1';

            $id = $this->user_model->insert_user($ttbs_user);

            $firm_id = array();
            $firm_id = $this->input->POST('firm_id');
            if (isset($firm_id) && !empty($firm_id)) {
                $i = 0;
                foreach ($firm_id as $firm) {
                    $firm_input = array('user_id' => $id, 'firm_id' => $firm);
                    $this->user_model->insert_firm($firm_input);
                }
            }

            $data["input"] = $input;
            $data["f_length"] = count(array_filter($input["family"]["name"]));
            $data["edu_length"] = count(array_filter($input["edu"]["type"]));
            $data["f_length"] = count(array_filter($input["family"]["name"]));
            $data["l_length"] = count(array_filter($input["lang"]["language"]));
            $data["ref_length"] = count(array_filter($input["ref"]["name"]));
            $data["exp_length"] = count(array_filter($input["exp"]["company"]));

            if (isset($input["temp"]["file"]) && !empty($input["temp"]["file"])) {
                /* replace [removed] with header */
                //echo "Inside";
                //exit;

                $prof_image["prof_image"] = str_replace("[removed]", "data:image/png;base64,", $input["temp"]["file"]);
                $filename = getcwd() . "/attachments/user_profile/" . $_FILES['users']['name']['image'];
                /* Check for existance of file name and rename the new image */
                while (file_exists($filename)) {
                    $path_parts = pathinfo($filename);
                    $filename = $path_parts['dirname'] . "/" . $path_parts['filename'] . "1." . $path_parts['extension'];
                }
                $prof_image["name"] = $filename;
                /* Add image date in database and id in session */
                $temp_data = $this->temp_data_model->insert_temp_data(array("key" => "temp", "value" => json_encode($prof_image)));
//                $this->session_view->add_session(null, null, array("temp_data" => $temp_data["id"]));
            }

            if (isset($input["users"]) && !empty($input["users"])) {
                foreach ($input["users"] as $key => $val) {
                    if ($key != 'landline_no') {
                        $field_name = ucfirst(str_replace('_', ' ', $key));
                        $rules = "required";
                        if ($field_name == "Email") {
                            $rules = "required|valid_email";
                        }
                        if ($field_name == "Dob") {
                            $field_name = "Date of Birth";
                        }
                        $validation[] = array(
                            'field' => "users[" . $key . "]",
                            'label' => $field_name,
                            'rules' => $rules
                        );
                    }
                }

                /* echo "<pre>";
                  print_r($input["users"]);
                  print_r($validation);
                  exit; */
                $select_array = array("gender", "marital_status", "status");
                foreach ($select_array as $sel_value) {
                    if (!isset($input["users"][$sel_value])) {
                        $sel_value = ($sel_value != "status") ? $sel_value : "Employee status";
                        $validation[] = array(
                            'field' => "users[" . $sel_value . "]",
                            'label' => ucfirst(str_replace('_', ' ', $sel_value)),
                            'rules' => 'required'
                        );
                    }
                }
//
                $this->form_validation->set_rules($validation);
                if ($this->form_validation->run() != FALSE) {

                    if (isset($input["contact"]) && !empty($input["contact"])) {
                        foreach ($input["contact"] as $key => $val) {
                            $rules = "required";
                            if ($key == "name")
                                $field_name = "Contact Name";

                            else if ($key == "contact_no")
                                $field_name = "Contact Number";

                            $contact[] = array(
                                'field' => "contact[" . $key . "][]",
                                'label' => $field_name,
                                'rules' => $rules
                            );
                        }
                    }

                    $this->form_validation->set_rules($contact);
                    if ($this->form_validation->run() != FALSE) {
                        if (isset($input["user_dep"]) && !empty($input["user_dep"]) && isset($input["user_salary"]) && !empty($input["user_salary"]) && isset($input["user_shift"]) && !empty($input["user_shift"])) {
                            foreach ($input["user_dep"] as $key => $val) {
                                $field_name = ucfirst(str_replace('_', ' ', $key));
                                $rules = "required";
                                $dept[] = array(
                                    'field' => "user_dep[" . $key . "]",
                                    'label' => $field_name,
                                    'rules' => $rules
                                );
                            }


                            foreach ($input["user_salary"] as $key => $val) {

                                $field_name = ucfirst(str_replace('_', ' ', $key));

                                $rules = "required";
                                $dept[] = array(
                                    'field' => "user_salary[" . $key . "]",
                                    'label' => $field_name,
                                    'rules' => $rules
                                );
                            }
                            foreach ($input["user_shift"] as $key => $val) {
                                $field_name = ucfirst(str_replace('_', ' ', $key));
                                $rules = "required";
                                if ($key == "shift_id")
                                    $field_name = "Shift";
                                $dept[] = array(
                                    'field' => "user_shift[" . $key . "]",
                                    'label' => $field_name,
                                    'rules' => $rules
                                );
                            }
                            $dept[] = array(
                                'field' => "user_shift[ot_applicable]",
                                'label' => 'OT applicable',
                                'rules' => "required"
                            );

                            foreach ($input["user_salary"] as $key => $val) {
                                $field_name = ucfirst(str_replace('_', ' ', $key));
                                $rules = "required";
                                if ($key == "type")
                                    $field_name = "Salary Type";
                                $dept[] = array(
                                    'field' => "user_salary[" . $key . "]",
                                    'label' => $field_name,
                                    'rules' => $rules
                                );
                            }

                            if (isset($input["leave"]) && !empty($input["leave"])) {
                                foreach ($input["leave"] as $key => $val) {
                                    $field_name = ucfirst(str_replace('_', ' ', $key));
                                    $rules = "required";
                                    $dept[] = array(
                                        'field' => "leave[" . $key . "]",
                                        'label' => $field_name,
                                        'rules' => $rules
                                    );
                                }
                            }
                            $dept[] = array(
                                'field' => "user_history[date]",
                                'label' => 'Date of Joining',
                                'rules' => $rules
                            );
                        }

                        $this->form_validation->set_rules($dept);
                        if ($this->form_validation->run() != FALSE) {
//print_r($input['edu']['type']);
//$res = array_filter($input['edu']['type']);
//echo $res;
//start education
                            /* if(isset($res) && !empty($res))

                              {

                              $data["edu_length"] = count(array_filter($input["edu"]["type"]));



                              foreach($input["edu"] as $key=>$val)

                              {

                              $field_name = ucfirst(str_replace('_',' ',$key));

                              $rules = "required";

                              if($key=="specialization")

                              $rules = "trim";

                              $edu[] = array(

                              'field'   => "edu[".$key."][]" ,

                              'label'   => $field_name,

                              'rules'   => $rules

                              );



                              }

                              $this->form_validation->set_rules($edu);

                              if ($this->form_validation->run() != FALSE)

                              {





                              }

                              else

                              {

                              //education

                              $data["error"] = "3";



                              }

                              }

                              //end education */
//$res1 = $input["family"];
                            $res1 = array_filter($input["family"]["name"]);
                            if (isset($res1) && !empty($res1)) {
                                if ($data["f_length"] == 0)
                                    $data["f_length"] = 1;
                                foreach ($input["family"] as $key => $val) {
                                    $field_name = ucfirst(str_replace('_', ' ', $key));
                                    $rules = "required";
                                    if ($key == "designation" || $key == "monthly_income" || $key == "percentage")
                                        $rules = "trim";
                                    $family[] = array(
                                        'field' => "family[" . $key . "][]",
                                        'label' => $field_name,
                                        'rules' => $rules
                                    );
                                }
                                if (!isset($input["family"]["nominee"])) {
                                    $family[] = array(
                                        'field' => "family[nominee]",
                                        'label' => 'Nominee',
                                        'rules' => 'required'
                                    );
                                    $family[] = array(
                                        'field' => "family[percentage]",
                                        'label' => 'Gratuity',
                                        'rules' => 'required'
                                    );
                                } elseif (isset($input["family"]["nominee"])) {
                                    $nominee_count = count($input["family"]["nominee"]);
                                    $percentage_count = count(array_filter($input["family"]["percentage"]));
                                    if ($nominee_count > $percentage_count) {
                                        $family[] = array(
                                            'field' => "family[percentage]",
                                            'label' => 'Gratuity',
                                            'rules' => 'required'
                                        );
                                    } elseif ($nominee_count == $percentage_count) {
                                        $enter = 0;
                                        $input["family"]["percentage"] = array_filter($input["family"]["percentage"]);
                                        foreach ($input["family"]["percentage"] as $key => $per) {
                                            if (!isset($input["family"]["nominee"][$key])) {
                                                $family[] = array(
                                                    'field' => "family[nominee][" . $key . "]",
                                                    'label' => 'Nominee',
                                                    'rules' => 'required'
                                                );

                                                $enter = 1;
                                            }
                                        }

                                        foreach ($input["family"]["nominee"] as $key => $per) {
//echo $input["family"]["percentage"][$key];
                                            if (isset($input["family"]["percentage"][$key]) && $input["family"]["percentage"][$key] == "") {
                                                $family[] = array(
                                                    'field' => "family[percentage][" . $key . "]",
                                                    'label' => 'Gratuity',
                                                    'rules' => 'required'
                                                );

                                                $enter = 1;
                                            }
                                        }
                                        if ($enter == 0):
                                            $total_count = array_sum($input["family"]["percentage"]);
                                            if ($total_count != 100) {
                                                $data["exist"] = "The sum of gratuity percentage must be equal to 100.";
                                                $data["error"] = 4;
                                                goto last;
                                            }

                                        endif;
                                    } elseif ($nominee_count < $percentage_count) {
                                        foreach ($input["family"]["percentage"] as $key => $per) {
                                            if (!isset($input["family"]["nominee"][$key])) {
                                                $family[] = array(
                                                    'field' => "family[nominee][" . $key . "]",
                                                    'label' => 'Nominee',
                                                    'rules' => 'required'
                                                );
                                            }
                                        }
                                    }
                                }
                                $this->form_validation->set_rules($family);
//$this->pre_print->view($family);
//	exit;
                            }
                            if ($this->form_validation->run() != FALSE) {
                                /* }

                                  else

                                  {

                                  //family

                                  $data["error"] = "4";

                                  }

                                  } */
                                $res2 = array_filter($input["lang"]["language"]);
                                $enter = 0;
                                if (isset($res2) && !empty($res2)) {
                                    $data["l_length"] = count(array_filter($input["lang"]["language"]));
                                    foreach ($input["lang"] as $key => $val) {
                                        $field_name = ucfirst(str_replace('_', ' ', $key));
                                        $rules = "required";
                                        if ($key == "rws") {
                                            $arr_chk = array_chunk($input["lang"]["rws"], 3);

                                            /* echo "<pre>";

                                              print_r($arr_chk); */

                                            foreach ($arr_chk as $r) {



                                                if ($r[0] != 1 && $r[1] != 1 && $r[2] != 1)
                                                    $lang[] = array(
                                                        'field' => "lang[" . $key . "][]",
                                                        'label' => $field_name,
                                                        'rules' => $rules
                                                    );
                                            }
                                        }

                                        else {



                                            $lang[] = array(
                                                'field' => "lang[" . $key . "][]",
                                                'label' => $field_name,
                                                'rules' => $rules
                                            );
                                        }
                                    }

                                    $this->form_validation->set_rules($lang);

                                    if ($this->form_validation->run() == FALSE)
                                        $enter = 1;
                                }

                                /* 	$res3 = array_filter($input["ref"]["name"]);

                                  if(isset($res3) && !empty($res3))

                                  {

                                  $data["ref_length"] = count(array_filter($input["ref"]["name"]));

                                  foreach($input["ref"] as $key=>$val)

                                  {

                                  $field_name = ucfirst(str_replace('_',' ',$key));

                                  $rules = "required";



                                  $ref[] = array(

                                  'field'   => "ref[".$key."][]" ,

                                  'label'   => $field_name,

                                  'rules'   => $rules

                                  );



                                  }

                                  $this->form_validation->set_rules($ref);

                                  if ($this->form_validation->run() != FALSE)

                                  {



                                  }

                                  else

                                  {

                                  $data["error"] = "7";

                                  }

                                  }

                                  $res4 = array_filter($input["exp"]["company"]);

                                  if(isset($res4) && !empty($res4) )

                                  {

                                  $data["exp_length"] = count(array_filter($input["exp"]["company"]));

                                  foreach($input["exp"] as $key=>$val)

                                  {

                                  $field_name = ucfirst(str_replace('_',' ',$key));

                                  $rules = "required";



                                  $exp[] = array(

                                  'field'   => "exp[".$key."][]" ,

                                  'label'   => $field_name,

                                  'rules'   => $rules

                                  );



                                  }

                                  $this->form_validation->set_rules($exp);

                                  if ($this->form_validation->run() != FALSE)

                                  {



                                  }

                                  else

                                  {

                                  //experience

                                  $data["error"] = "8";

                                  }

                                  } */

                                if ($enter == 0) {
                                    $usernames = $this->users_model->check_user_name_exist($input["users"]["username"]);

                                    if (isset($usernames) && !empty($usernames)) {

                                        $data["username"] = "1";

//                                        $this->session_messages->add_message('warning', 'Username already exist');
                                    }

                                    $accessid = $this->users_model->check_access_id_exist($input["users"]["access_id"]);

                                    if (isset($accessid) && !empty($accessid)) {

                                        $data["access_id"] = "1";

//                                        $this->session_messages->add_message('warning', 'Access Id already exist');
                                    }
                                    if (isset($data["username"]) || isset($data["access_id"])) {

                                        goto last;
                                    }

                                    /* Get image details from session */

//                                    $temp_data = $this->session_view->get_session();
                                    $temp_data = $temp_data["temp_data"];
                                    $image_details = $this->temp_data_model->get_temp_data_by_id($temp_data);
                                    $image_details = (array) json_decode($image_details[0]["value"]);
                                    if (isset($image_details["name"]) && isset($image_details["prof_image"])) {
                                        /* Save data as image */
                                        $data1 = $image_details["prof_image"];
                                        list($type, $data1) = explode(';', $data1);
                                        list(, $data1) = explode(',', $data1);
                                        $data1 = base64_decode($data1);
                                        file_put_contents($image_details["name"], $data1);
                                        /* Generate Thumbnail */
                                        $path_parts = pathinfo($image_details["name"]);
                                        $destination = $path_parts['dirname'] . "/thumb/" . $path_parts['filename'] . "." . $path_parts['extension'];
                                        $this->make_thumb->save($image_details["name"], $destination, 100);
                                        $this->temp_data_model->delete_temp_data($temp_data);

                                        /* Assign image name to users array */

                                        $input["users"]['image'] = $path_parts['filename'] . "." . $path_parts['extension'];
                                    }


//$this->pre_print->vieExit($input);

                                    $this->load->model('masters/education_model');
                                    $this->load->model('masters/options_model');
                                    $this->load->model('masters/family_model');
                                    $this->load->model('masters/language_model');
                                    $this->load->model('masters/identification_model');
                                    $this->load->model('masters/reference_model');
                                    $this->load->model('masters/user_department_model');
                                    $this->load->model('masters/user_salary_model');
                                    $this->load->model('masters/available_leaves_model');
                                    $this->load->model('masters/experience_model');
                                    $this->load->model('masters/user_history_model');
                                    $this->load->model('masters/address_model');
                                    $this->load->model('masters/user_shift_model');
                                    $this->load->model('masters/user_model');

                                    //$this->pre_print->view($input);
                                    $this->load->model('masters/leave_updated_model');
                                    $last_id = $this->increment_model->get_increment_id('employee');
                                    $input["users"]["employee_id"] = $last_id[0]["last_increment_id"];
                                    $input["users"]["created"] = date("Y-m-d H:i:s");
                                    $input["users"]["dob"] = date("Y-m-d", strtotime($input["users"]["dob"]));
                                    $input['users']['id'] = $id;

                                    $user_id = $this->users_model->insert_user($input['users']);

                                    $last_updated["user_id"] = $user_id;
                                    $last_updated["last_updated"] = date('Y-m-d', strtotime($input['user_history']['date']));

                                    //$this->pre_print->viewExit($last_updated);

                                    $this->leave_updated_model->insert_leave_updated_date_for_user($last_updated);

                                    $this->increment_model->update_increment_id('employee');

                                    if (isset($input["edu"]) && !empty($input["edu"])) {

                                        for ($i = 0; $i < count(array_filter($input["edu"]["type"])); $i++) {

                                            $edu_val = array("specialization" => $input["edu"]["specialization"][$i],
                                                "institute" => $input["edu"]["institute"][$i],
                                                "type" => $input["edu"]["type"][$i],
                                                "completed_year" => $input["edu"]["completed_year"][$i],
                                                "percentage" => $input["edu"]["percentage"][$i],
                                                "user_id" => $user_id
                                            );

                                            $this->education_model->insert_education($edu_val);
                                        }
                                    }

                                    if (isset($input["address"]) && !empty($input["address"])) {

                                        for ($a = 0; $a < count($input["address"]); $a++) {

                                            $input["address"][$a]["user_id"] = $user_id;

                                            $input["address"][$a]["type"] = $a + 1;

                                            $this->address_model->insert_address($input["address"][$a]);
                                        }
                                    }

                                    if (isset($input["contact"]) && !empty($input["contact"])) {

                                        if ($input["contact"]["name"] != "" && $input["contact"]["contact_no"] != "") {

                                            $input["contact"]["user_id"] = $user_id;

                                            $this->emergency_contacts_model->insert_emergency_contacts($input["contact"]);
                                        }
                                    }

                                    if (isset($input["family"]) && !empty($input["family"])) {

                                        for ($i = 0; $i < count(array_filter($input["family"]["name"])); $i++) {

//echo $input["family"]["dob"][$i];

                                            $fa_val = array("name" => $input["family"]["name"][$i],
                                                "relation" => $input["family"]["relation"][$i],
                                                "age" => $input["family"]["age"][$i],
                                                "designation" => $input["family"]["designation"][$i],
                                                "monthly_income" => $input["family"]["monthly_income"][$i],
                                                "user_id" => $user_id
                                            );

                                            $family_id = $this->family_model->insert_family_members($fa_val);

                                            if (isset($input["wages"]["family_member_id"])) {

                                                if (isset($input["wages"]["family_member_id"]) && $input["wages"]["family_member_id"] == $i) {

                                                    $input["wages"]["user_id"] = $user_id;

                                                    $input["wages"]["family_member_id"] = $family_id;



                                                    $this->family_model->insert_wages_share($input["wages"]);
                                                }
                                            }

                                            if (isset($input["family"]["nominee"][$i])) {



                                                if (isset($input["family"]["percentage"][$i]) && $input["family"]["percentage"][$i] != "") {



                                                    $nominee = array(
                                                        "user_id" => $user_id,
                                                        "percentage" => $input["family"]["percentage"][$i],
                                                        "family_member_id" => $family_id
                                                    );

                                                    $this->family_model->insert_nominee($nominee);
                                                }
                                            }
                                        }
                                    }

                                    if (isset($input["lang"]) && !empty($input["lang"])) {

                                        $arr_chk = array_chunk($input["lang"]["rws"], 3);

                                        for ($i = 0; $i < count(array_filter($input["lang"]["language"])); $i++) {



                                            $lang_val = array("language" => $input["lang"]["language"][$i],
                                                "rws" => $arr_chk[$i][0] . ":" . $arr_chk[$i][1] . ":" . $arr_chk[$i][2],
                                                "user_id" => $user_id
                                            );

                                            $this->language_model->insert_languages($lang_val);
                                        }
                                    }

                                    if (isset($input["identification_marks"]["identification_mark"]) && !empty($input["identification_marks"]["identification_mark"])) {

                                        for ($i = 0; $i < count(array_filter($input["identification_marks"]["identification_mark"])); $i++) {



                                            $id_val = array("identification_mark" => $input["identification_marks"]["identification_mark"][$i],
                                                "user_id" => $user_id
                                            );

                                            $this->identification_model->insert_identification($id_val);
                                        }
                                    }

                                    if (isset($input["ref"]) && !empty($input["ref"])) {

                                        for ($i = 0; $i < count(array_filter($input["ref"]["name"])); $i++) {



                                            $ref_val = array("name" => $input["ref"]["name"][$i],
                                                "relation" => $input["ref"]["relation"][$i],
                                                "company_name" => $input["ref"]["company_name"][$i],
                                                "city" => $input["ref"]["city"][$i],
                                                "contact_no" => $input["ref"]["contact_no"][$i],
                                                "user_id" => $user_id
                                            );

                                            $this->reference_model->insert_reference($ref_val);
                                        }
                                    }

                                    $input["user_dep"]["user_id"] = $user_id;

//$salary_group = $this->department_model->get_department_by_id($input["user_dep"]["department"]);
//$input["user_salary"]["salary_group"] = $salary_group[0]["salary_group_id"];

                                    $input["user_salary"]["user_id"] = $user_id;

                                    $input["user_salary"]["revised_date"] = date('Y-m-d H:i:s', strtotime($input['user_history']['date']));

                                    $input["leave"]["available_casual_leave"] = $input["leave"]["casual_leave"];

                                    $input["leave"]["available_sick_leave"] = $input["leave"]["sick_leave"];

                                    $input["leave"]["user_id"] = $user_id;

                                    $permission = $this->options_model->get_options_by_type('permission_per_month');

                                    $input["leave"]["permission"] = $permission[0]['value'];

//$this->pre_print->viewExit($input['user_salary']);

                                    $history['date'] = date('Y-m-d', strtotime($input['user_history']['date']));

                                    $history['type'] = 1;

                                    $history['user_id'] = $user_id;

                                    $input["user_shift"]["user_id"] = $user_id;

                                    $input["user_shift"]["created"] = date('Y-m-d', strtotime($input['user_history']['date']));

                                    $this->user_history_model->insert_history($history);


                                    $this->user_shift_model->insert_user_shift($input["user_shift"]);

                                    $this->user_department_model->insert_user_department($input["user_dep"]);

                                    $this->user_salary_model->insert_user_salary($input["user_salary"]);

                                    $this->available_leaves_model->insert_user_leaves($input["leave"]);

                                    if (isset($input["exp"]) && !empty($input["exp"])) {

                                        for ($i = 0; $i < count(array_filter($input["exp"]["company"])); $i++) {



                                            $exp_val = array("company" => $input["exp"]["company"][$i],
                                                "designation" => $input["exp"]["designation"][$i],
                                                "start_date" => date("Y-m-d", strtotime($input["exp"]["start_date"][$i])),
                                                "end_date" => date("Y-m-d", strtotime($input["exp"]["end_date"][$i])),
                                                "salary" => $input["exp"]["salary"][$i],
                                                "reason_for_leaving" => $input["exp"]["reason_for_leaving"][$i],
                                                "user_id" => $user_id
                                            );

                                            $this->experience_model->insert_experiences($exp_val);
                                        }
                                    }
//                                    $this->session_messages->add_message('success', 'Employee details added');

                                    redirect($this->config->item('base_url') . "masters/biometric/employees");
                                } else {

                                    $data["error"] = "5";
                                }
                            } else {

                                $data["error"] = 4;
                            }
                        } else {

//leave

                            $data["error"] = "2";
                        }
                    } else {

//general

                        $data["error"] = "1";
                    }
                } else {

//general

                    $data["error"] = "0";
                }
            }
        }
        last:
        $data['relations'] = $this->options_model->get_options_by_type('relations');
        $data["last_increment_id"] = $this->increment_model->get_increment_id('employee');
//$data["departments"] = $this->department_model->get_all_departments();
        $data["departments"] = $this->department_model->get_all_departments_by_status(1);
        $data["designations"] = $this->designation_model->get_all_designations();
        $data["salary_group"] = $this->salary_group_model->get_all_salary_groups();
        $data["shift"] = $this->shift_model->get_all_shifts();
        $data["edu_type"] = $this->options_model->get_options_by_type('education_type');
        $data["blood_group"] = $this->options_model->get_options_by_type('blood_group');
        // echo "<pre>";
        // print_r($data['error']);
        // exit;
//        $datam["messages"] = $this->session_messages->view_all_messages();
//        $this->template->write_view('session_msg', 'masters/session_messages', $datam);
        $data['user_role'] = $user = $this->user_model->get_user_role();
        $data['firms'] = $firms = $this->user_model->get_all_firms();
        $this->template->write_view('content', 'masters/add_employee', $data);
        $this->template->render();
    }

    public function view_employee($user_id) {

        $this->load->model('users_model');

        $this->load->model('education_model');

        $this->load->model('family_model');

        $this->load->model('language_model');

        $this->load->model('identification_model');

        $this->load->model('reference_model');

        $this->load->model('user_department_model');

        $this->load->model('user_salary_model');

        $this->load->model('available_leaves_model');

        $this->load->model('experience_model');

        $this->load->model('user_history_model');

        $this->load->model('address_model');

        $this->load->model('user_shift_model');

        $this->load->model('user_roles_model');

        $this->load->model('emergency_contacts_model');

        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["user"] = $this->users_model->get_user_by_id($user_id);

        $data["edu"] = $this->education_model->get_user_education_by_id($user_id);

        $data["family"] = $this->family_model->get_family_members_by_user_id($user_id);

        $data["lang"] = $this->language_model->get_languages_by_user_id($user_id);

        $data["identification"] = $this->identification_model->get_identifications_by_user_id($user_id);

        $data["reference"] = $this->reference_model->get_references_by_user_id($user_id);

        $data["user_dep"] = $this->user_department_model->get_department_by_user_id($user_id);

        $data["user_sal"] = $this->user_salary_model->get_user_salary_by_user_id($user_id);

        $data["leave"] = $this->available_leaves_model->get_user_leaves_by_user_id($user_id);

        $data["exp"] = $this->experience_model->get_experiences_by_user_id($user_id);

        $data["user_history"] = $this->user_history_model->get_history_by_user_id_and_type($user_id, 'doj');

        $data["dol"] = $this->user_history_model->get_history_by_user_id_and_type($user_id, 'dol');

        $data["nominee"] = $this->family_model->get_nominees_by_user_id($user_id);

        $data["address"][0] = $this->address_model->get_address_by_user_id_by_type($user_id, 'present');

        $data["address"][1] = $this->address_model->get_address_by_user_id_by_type($user_id, 'permanent');

        $data['share'] = $this->family_model->get_wages_share_by_user_id($user_id);

        $data["user_shift"] = $this->user_shift_model->get_user_current_shift_by_user_id($user_id);

        $data["all_shift"] = $this->user_shift_model->get_all_user_shift_by_user_id($user_id);

        $data["all_salary"] = $this->user_salary_model->get_all_user_salary_by_user_id($user_id);

        $data['contact'] = $this->emergency_contacts_model->get_user_emergency_contacts_by_id($user_id);

        $data["user_id"] = $user_id;

        /* echo "<pre>";

          print_r($data);

          exit; */

//        $datam["messages"] = $this->session_messages->view_all_messages();
//        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/view_employee', $data);

        $this->template->render();
    }

    public function edit_employee($user_id) {

        $this->load->model('masters/department_model');

        $this->load->model('masters/designation_model');

        $this->load->model('masters/users_model');

        $this->load->model('masters/education_model');

        $this->load->model('masters/family_model');

        $this->load->model('masters/language_model');

        $this->load->model('masters/identification_model');

        $this->load->model('masters/reference_model');

        $this->load->model('masters/shift_model');

        $this->load->model('masters/salary_group_model');

        $this->load->model('masters/user_department_model');

        $this->load->model('masters/user_salary_model');

        $this->load->model('masters/available_leaves_model');

        $this->load->model('masters/experience_model');

        $this->load->model('masters/options_model');

        $this->load->model('masters/address_model');

        $this->load->model('masters/user_history_model');

        $this->load->model('masters/temp_data_model');

        $this->load->library('make_thumb');

        $this->load->model('masters/user_shift_model');

        $this->load->model('masters/user_roles_model');

        $this->load->model('masters/emergency_contacts_model');

        $this->load->model('masters/user_model');

// $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());
//        echo 'test';
//        exit;
        $data["user"] = $this->users_model->get_user_by_id($user_id);
//        echo '<pre>';
//        print_r($data["user"]);
//        exit;


        if ($data["user"][0]["status"] != 0) {

            $data["salary_group"] = $this->salary_group_model->get_all_salary_groups();

            $data["shift"] = $this->shift_model->get_all_shifts();

            $data["departments"] = $this->department_model->get_all_departments_by_status(1);

            $data["designations"] = $this->designation_model->get_all_designations();

            $data["edu_type"] = $this->options_model->get_options_by_type('education_type');

            $data["blood_group"] = $this->options_model->get_options_by_type('blood_group');

            $data["user_history"] = $this->user_history_model->get_history_by_user_id_and_type($user_id, 'doj');

            $data["dol"] = $this->user_history_model->get_history_by_user_id_and_type($user_id, 'dol');

            $data["user_dep"] = $this->user_department_model->get_department_by_user_id($user_id);

            $data["user_sal"] = $this->user_salary_model->get_user_salary_by_user_id($user_id);

//echo $this->db->last_query();

            $data["leave"] = $this->available_leaves_model->get_user_leaves_by_user_id($user_id);

            $data['relations'] = $this->options_model->get_options_by_type('relations');

            $data['share'] = $this->family_model->get_wages_share_by_user_id($user_id);

            $data['contact'] = $this->emergency_contacts_model->get_user_emergency_contacts_by_id($user_id);



            $validation = array();

            $data["user_id"] = $user_id;

            if ($this->input->post("users")) {

                $revise = $this->input->post("revise");

                $sal = $this->input->post("user_salary");
                $revise["revised_date"] = date('Y-m-d', strtotime($revise["revised_date"])) . " 00:00:00";
                $revise["user_id"] = $user_id;
                $revise["type"] = $data["user_sal"][0]["type"];
//$this->pre_print->viewExit($this->input->post());
//$revise["salary_group"] = $data["user_sal"][0]["salary_group"];
//$this->pre_print->viewExit($revise);
                $this->user_salary_model->insert_user_salary($revise);
            }
//            print_r($this->input->post("change"));
//            exit;
            $id = $user_id;

            if ($this->input->post()) {
                $ttbs_user = array();
                $ttbs_user['name'] = $input['users']['first_name'];
                $ttbs_user['nick_name'] = $input['users']['last_name'];
                $ttbs_user['username'] = $input['users']['username'];
                $ttbs_user['password'] = md5($input['users']['password']);
                $ttbs_user['admin_image'] = 'test';
                $ttbs_user['mobile_no'] = $input['users']['mobile'];
                $ttbs_user['email_id'] = $input['users']['email'];
                $ttbs_user['address'] = 'test';
                $ttbs_user['role'] = $input['role'];
                $ttbs_user['signature'] = 'test';
                $ttbs_user['status'] = '1';

                $this->user_model->update_user($ttbs_user, $id);
                $this->user_model->delete_user_firm($id);
                $firm_id = array();
                $firm_id = $this->input->POST('firm_id');
                if (isset($firm_id) && !empty($firm_id)) {
                    $i = 0;
                    foreach ($firm_id as $firm) {
                        $firm_input = array('user_id' => $id, 'firm_id' => $firm);
                        $this->user_model->insert_firm($firm_input);
                    }
                }
            }


            if ($this->input->post()) {

                $shift = $this->input->post("user_shift");

                $shift["user_id"] = $user_id;

                $shift["created"] = date('Y-m-d', strtotime($shift["created"]));

                $this->user_shift_model->insert_user_shift($shift);

//$this->pre_print->viewExit($shift);
            }

            if ($this->input->post("users")) {

                $input = $this->input->post();

                $data["edu_length"] = count(array_filter($input["edu"]["type"]));

                $data["f_length"] = count(array_filter($input["family"]["name"]));

                $data["l_length"] = count(array_filter($input["lang"]["language"]));

                $data["ref_length"] = count(array_filter($input["ref"]["name"]));

                $data["exp_length"] = count(array_filter($input["exp"]["company"]));
                $data["post"] = $input;


//$this->pre_print->view($input);
//$this->pre_print->viewExit($data);

                if (isset($input["temp"]["file"]) && !empty($input["temp"]["file"])) {

                    /* replace [removed] with header */

                    $prof_image["prof_image"] = str_replace("[removed]", "data:image/png;base64,", $input["temp"]["file"]);

                    $filename = getcwd() . "/attachments/user_profile/" . $_FILES['users']['name']['image'];

                    /* Check for existance of file name and rename the new image */

                    while (file_exists($filename)) {
                        $path_parts = pathinfo($filename);

                        $filename = $path_parts['dirname'] . "/" . $path_parts['filename'] . "1." . $path_parts['extension'];
                    }

                    $prof_image["name"] = $filename;

                    /* Add image date in database and id in session */

                    $temp_data = $this->temp_data_model->insert_temp_data(array("key" => "temp", "value" => json_encode($prof_image)));

//                    $this->session_view->add_session(null, null, array("temp_data" => $temp_data["id"]));
                }

                if (isset($input["users"]) && !empty($input["users"])) {

                    foreach ($input["users"] as $key => $val) {

                        if ($key != "password" && $key != 'landline_no') {

                            $field_name = ucfirst(str_replace('_', ' ', $key));

                            $rules = "required";

                            if ($field_name == "Email") {

                                $rules = "required|valid_email";
                            }



                            if ($field_name == 'Dob') {

                                $field_name = "Date of Birth";
                            }



                            $validation[] = array(
                                'field' => "users[" . $key . "]",
                                'label' => $field_name,
                                'rules' => $rules
                            );
                        }
                    }


                    $select_array = array("gender", "marital_status", "status");




                    foreach ($select_array as $sel_value) {



                        if (!isset($input["users"][$sel_value])) {

                            $sel_value = ($sel_value != "status") ? $sel_value : "Employee status";

                            $validation[] = array(
                                'field' => "users[" . $sel_value . "]",
                                'label' => ucfirst(str_replace('_', ' ', $sel_value)),
                                'rules' => 'required'
                            );
                        }
                    }
                }



                $this->form_validation->set_rules($validation);



                if ($this->form_validation->run() != FALSE) {


                    if (isset($input["contact"]) && !empty($input["contact"])) {


                        foreach ($input["contact"] as $key => $val) {

                            $rules = "required";

                            if ($key == "name")
                                $field_name = "Contact Name";

                            else if ($key == "contact_no")
                                $field_name = "Contact Number";

                            $contact[] = array(
                                'field' => "contact[" . $key . "][]",
                                'label' => $field_name,
                                'rules' => $rules
                            );
                        }
                    }



                    $this->form_validation->set_rules($contact);




                    //   if ($this->form_validation->run() != FALSE) {





                    /* if(isset($input["edu"]) && !empty($input["edu"]))

                      {



                      foreach($input["edu"] as $key=>$val)

                      {





                      $field_name = ucfirst(str_replace('_',' ',$key));

                      $rules = "required";

                      if($key=="specialization")

                      $rules = "trim";

                      $edu[] = array(

                      'field'   => "edu[".$key."][]" ,

                      'label'   => $field_name,

                      'rules'   => $rules

                      );



                      }

                      $this->form_validation->set_rules($edu);

                      if ($this->form_validation->run() != FALSE)

                      {

                      if(isset($input["family"]) && !empty($input["family"]))

                      {



                      foreach($input["family"] as $key=>$val)

                      {

                      $field_name = ucfirst(str_replace('_',' ',$key));

                      $rules = "required";

                      if($key=="designation" || $key =="monthly_income")

                      $rules = "trim";

                      $family[] = array(

                      'field'   => "family[".$key."][]" ,

                      'label'   => $field_name,

                      'rules'   => $rules

                      );



                      }

                      }

                      $this->form_validation->set_rules($family);

                      if ($this->form_validation->run() != FALSE)

                      {

                      if(isset($input["lang"]) && !empty($input["lang"]))

                      {



                      foreach($input["lang"] as $key=>$val)

                      {

                      $field_name = ucfirst(str_replace('_',' ',$key));

                      $rules = "required";



                      if($key=="rws")

                      {

                      $arr_chk = array_chunk($input["lang"]["rws"], 3);

                      /*echo "<pre>";

                      print_r($arr_chk);

                      foreach($arr_chk as $r)

                      {



                      if($r[0]!=1 && $r[1]!=1 && $r[2]!=1)



                      $lang[] = array(

                      'field'   => "lang[".$key."][]" ,

                      'label'   => $field_name,

                      'rules'   => $rules



                      );



                      }

                      }

                      else

                      {



                      $lang[] = array(

                      'field'   => "lang[".$key."][]" ,

                      'label'   => $field_name,

                      'rules'   => $rules



                      );

                      }



                      }



                      }

                      $this->form_validation->set_rules($lang);

                      if ($this->form_validation->run() != FALSE)

                      {

                      if(isset($input["identification_marks"]) && !empty($input["identification_marks"]))

                      {



                      foreach($input["identification_marks"] as $key=>$val)

                      {

                      $field_name = ucfirst(str_replace('_',' ',$key));

                      $rules = "required";



                      $iden[] = array(

                      'field'   => "identification_marks[".$key."][]" ,

                      'label'   => $field_name,

                      'rules'   => $rules

                      );



                      }



                      }

                      $this->form_validation->set_rules($iden);

                      if ($this->form_validation->run() != FALSE)

                      {

                      if(isset($input["ref"]) && !empty($input["ref"]))

                      {



                      foreach($input["ref"] as $key=>$val)

                      {

                      $field_name = ucfirst(str_replace('_',' ',$key));

                      $rules = "required";



                      $ref[] = array(

                      'field'   => "ref[".$key."][]" ,

                      'label'   => $field_name,

                      'rules'   => $rules

                      );



                      }



                      }

                      $this->form_validation->set_rules($ref);

                      if ($this->form_validation->run() != FALSE)

                      { */

                    //$this->pre_print->view($input);

                    if (isset($input["user_dep"]) && !empty($input["user_dep"])) {

                        foreach ($input["user_dep"] as $key => $val) {

                            $field_name = ucfirst(str_replace('_', ' ', $key));

                            $rules = "required";



                            $dept[] = array(
                                'field' => "user_dep[" . $key . "]",
                                'label' => $field_name,
                                'rules' => $rules
                            );
                        }

                        //foreach($input["user_salary"] as $key=>$val)

                        /* {

                          $field_name = ucfirst(str_replace('_',' ',$key));

                          $rules = "required";



                          $dept[] = array(

                          'field'   => "user_salary[".$key."]" ,

                          'label'   => $field_name,

                          'rules'   => $rules

                          );



                          } */

                        $dept[] = array(
                            'field' => "user_history[doj]",
                            'label' => 'Date of Joining',
                            'rules' => $rules
                        );

                        if (isset($input["leave"]) && !empty($input["leave"])) {



                            foreach ($input["leave"] as $key => $val) {

                                $field_name = ucfirst(str_replace('_', ' ', $key));

                                $rules = "required";



                                $dept[] = array(
                                    'field' => "leave[" . $key . "]",
                                    'label' => $field_name,
                                    'rules' => $rules
                                );
                            }
                        }
                    }

                    $this->form_validation->set_rules($dept);

                    // if ($this->form_validation->run() != FALSE) {


                    $res1 = array_filter($input["family"]['name']);



                    if (isset($res1) && !empty($res1)) {



                        $data["f_length"] = count(array_filter($input["family"]["name"]));

                        if ($data["f_length"] == 0)
                            $data["f_length"] = 1;

                        foreach ($input["family"] as $key => $val) {

                            $field_name = ucfirst(str_replace('_', ' ', $key));

                            $rules = "required";

                            if ($key == "designation" || $key == "monthly_income" || $key == "percentage")
                                $rules = "trim";

                            $family[] = array(
                                'field' => "family[" . $key . "][]",
                                'label' => $field_name,
                                'rules' => $rules
                            );
                        }

                        if (!isset($input["family"]["nominee"])) {

                            $family[] = array(
                                'field' => "family[nominee]",
                                'label' => 'Nominee',
                                'rules' => 'required'
                            );

                            $family[] = array(
                                'field' => "family[percentage]",
                                'label' => 'Gratuity',
                                'rules' => 'required'
                            );
                        } elseif (isset($input["family"]["nominee"])) {

                            $nominee_count = count($input["family"]["nominee"]);

                            $percentage_count = count(array_filter($input["family"]["percentage"]));



                            if ($nominee_count > $percentage_count) {

                                $family[] = array(
                                    'field' => "family[percentage]",
                                    'label' => 'Gratuity',
                                    'rules' => 'required'
                                );
                            } elseif ($nominee_count == $percentage_count) {

                                $enter = 0;

                                $input["family"]["percentage"] = array_filter($input["family"]["percentage"]);

                                foreach ($input["family"]["percentage"] as $key => $per) {

                                    if (!isset($input["family"]["nominee"][$key])) {

                                        //  print_r($input["family"]["percentage"]);

                                        $family[] = array(
                                            'field' => "family[nominee][" . $key . "]",
                                            'label' => 'Nominee',
                                            'rules' => 'required'
                                        );

                                        $enter = 1;
                                    }
                                }

                                foreach ($input["family"]["nominee"] as $key => $per) {

                                    //echo $input["family"]["percentage"][$key];

                                    if (isset($input["family"]["percentage"][$key]) && $input["family"]["percentage"][$key] == "") {



                                        $family[] = array(
                                            'field' => "family[percentage][" . $key . "]",
                                            'label' => 'Gratuity',
                                            'rules' => 'required'
                                        );

                                        $enter = 1;
                                    }
                                }



                                if ($enter == 0):

                                    $total_count = array_sum($input["family"]["percentage"]);

                                    if ($total_count != 100) {

                                        $data["exist"] = "The sum of gratuity percentage must be equal to 100.";

                                        $data["error"] = 4;

                                        goto last;
                                    }

                                endif;
                            } elseif ($nominee_count < $percentage_count) {



                                foreach ($input["family"]["percentage"] as $key => $per) {

                                    if (!isset($input["family"]["nominee"][$key])) {

                                        $family[] = array(
                                            'field' => "family[nominee][" . $key . "]",
                                            'label' => 'Nominee',
                                            'rules' => 'required'
                                        );
                                    }
                                }
                            }
                        }



                        $this->form_validation->set_rules($family);

                        //$this->pre_print->view($family);
                        //	exit;
                    }

                    // if ($this->form_validation->run() != FALSE) {

                    $res2 = array_filter($input["lang"]["language"]);

                    $enter = 0;

                    if (isset($res2) && !empty($res2)) {

                        $data["l_length"] = count(array_filter($input["lang"]["language"]));

                        foreach ($input["lang"] as $key => $val) {

                            $field_name = ucfirst(str_replace('_', ' ', $key));

                            $rules = "required";



                            if ($key == "rws") {

                                $arr_chk = array_chunk($input["lang"]["rws"], 3);

                                /* echo "<pre>";

                                  print_r($arr_chk); */

                                foreach ($arr_chk as $r) {



                                    if ($r[0] != 1 && $r[1] != 1 && $r[2] != 1)
                                        $lang[] = array(
                                            'field' => "lang[" . $key . "][]",
                                            'label' => $field_name,
                                            'rules' => $rules
                                        );
                                }
                            }

                            else {



                                $lang[] = array(
                                    'field' => "lang[" . $key . "][]",
                                    'label' => $field_name,
                                    'rules' => $rules
                                );
                            }
                        }

                        $this->form_validation->set_rules($lang);

                        if ($this->form_validation->run() == FALSE)
                            $enter = 1;
                    }
                    $enter = 0;
                    /* if(isset($input["exp"]) && !empty($input["exp"]) )

                      {



                      foreach($input["exp"] as $key=>$val)

                      {

                      $field_name = ucfirst(str_replace('_',' ',$key));

                      $rules = "required";



                      $exp[] = array(

                      'field'   => "exp[".$key."][]" ,

                      'label'   => $field_name,

                      'rules'   => $rules

                      );



                      }

                      }

                      $this->form_validation->set_rules($exp);

                      if ($this->form_validation->run() != FALSE)

                      {

                     */

                    if ($enter == 0) {

                        //check  username and access id already exist

                        $usernames = $this->users_model->check_user_name_exist($input["users"]["username"], $data["user"][0]["id"]);



                        if (isset($usernames) && !empty($usernames)) {



                            $data["username"] = "1";

//                                        $this->session_messages->add_message('warning', 'Username already exist');
                        }



                        $accessid = $this->users_model->check_access_id_exist($input["users"]["access_id"], $data["user"][0]["id"]);

                        if (isset($accessid) && !empty($accessid)) {



                            $data["access_id"] = "1";

//                                        $this->session_messages->add_message('warning', 'Access ID already exist');
                        }



                        if (isset($data["username"]) || isset($data["access_id"])) {

                            goto last;
                        }

                        /* Get image details from session */

//                                    $temp_data = $this->session_view->get_session();

                        $temp_data = $temp_data["temp_data"];

                        $image_details = $this->temp_data_model->get_temp_data_by_id($temp_data);

                        $image_details = (array) json_decode($image_details[0]["value"]);



                        if (isset($image_details["name"]) && isset($image_details["prof_image"])) {



                            /* Save data as image */

                            $data1 = $image_details["prof_image"];

                            list($type, $data1) = explode(';
', $data1);

                            list(, $data1) = explode(', ', $data1);

                            $data1 = base64_decode($data1);

                            file_put_contents($image_details["name"], $data1);



                            /* Generate Thumbnail */

                            $path_parts = pathinfo($image_details["name"]);

                            $destination = $path_parts['dirname'] . "/thumb/" . $path_parts['filename'] . "." . $path_parts['extension'];

                            $this->make_thumb->save($image_details["name"], $destination, 100);



                            $this->temp_data_model->delete_temp_data($temp_data);

                            /* Assign image name to users array */

                            $input["users"]['image'] = $path_parts['filename'] . "." . $path_parts['extension'];
                        }

                        /* echo $input["users"]['image'];

                          exit; */

                        $this->load->model('masters/users_model');

                        $this->load->model('masters/education_model');

                        $this->load->model('masters/family_model');

                        $this->load->model('masters/language_model');

                        $this->load->model('masters/identification_model');

                        $this->load->model('masters/reference_model');

                        $this->load->model('masters/user_department_model');

                        $this->load->model('masters/user_salary_model');

                        $this->load->model('masters/user_shift_model');

                        $this->load->model('masters/available_leaves_model');

                        $this->load->model('masters/experience_model');

                        //$this->pre_print->viewExit($input);

                        $input["users"]["created"] = date("Y-m-d H:i:s");

                        $input["users"]["dob"] = date("Y-m-d", strtotime($input["users"]["dob"]));

                        //echo $user_id . ' test';
                        //exit;

                        $u_id = $this->users_model->update_user($user_id, $input['users']);




                        if (isset($input["edu"]) && !empty($input["edu"])) {

                            $this->education_model->delete_user_education($user_id);

                            for ($i = 0; $i < count(array_filter($input["edu"]["type"])); $i++) {

                                $edu_val = array("specialization" => $input["edu"]["specialization"][$i],
                                    "institute" => $input["edu"]["institute"][$i],
                                    "type" => $input["edu"]["type"][$i],
                                    "completed_year" => $input["edu"]["completed_year"][$i],
                                    "percentage" => $input["edu"]["percentage"][$i],
                                    "user_id" => $user_id
                                );

                                $this->education_model->insert_education($edu_val);
                            }
                        }

                        if (isset($input["contact"]) && !empty($input["contact"])) {//$this->pre_print->viewExit($input["contact"]);
                            if ($input["contact"]["name"] != "" && $input["contact"]["contact_no"] != "") {

                                $this->emergency_contacts_model->delete_user_emergency_contacts($user_id);

                                $input["contact"]["user_id"] = $user_id;



                                $this->emergency_contacts_model->insert_emergency_contacts($input["contact"]);
                            }
                        }

                        if (isset($input["family"]) && !empty($input["family"])) {

                            $this->family_model->delete_family_members_by_user_id($user_id);

                            $this->family_model->delete_nominees_by_user_id($user_id);

                            for ($i = 0; $i < count(array_filter($input["family"]["name"])); $i++) {

                                //echo $input["family"]["dob"][$i];

                                $fa_val = array("name" => $input["family"]["name"][$i],
                                    "relation" => $input["family"]["relation"][$i],
                                    "age" => $input["family"]["age"][$i],
                                    "designation" => $input["family"]["designation"][$i],
                                    "monthly_income" => $input["family"]["monthly_income"][$i],
                                    "user_id" => $user_id
                                );

                                $family_id = $this->family_model->insert_family_members($fa_val);

                                //echo $family_id;

                                if (isset($input["wages"]["family_member_id"]) && $input["wages"]["family_member_id"] == $i) {



                                    $this->family_model->delete_wages_share_by_user_id($user_id);



                                    $input["wages"]["user_id"] = $user_id;

                                    $input["wages"]["family_member_id"] = $family_id;



                                    $this->family_model->insert_wages_share($input["wages"]);
                                }

                                if (isset($input["family"]["nominee"][$i])) {



                                    if (isset($input["family"]["percentage"][$i]) && $input["family"]["percentage"][$i] != "") {



                                        $nominee = array(
                                            "user_id" => $user_id,
                                            "percentage" => $input["family"]["percentage"][$i],
                                            "family_member_id" => $family_id
                                        );

                                        $this->family_model->insert_nominee($nominee);
                                    }
                                }
                            }
                        }

                        if (isset($input["address"]) && !empty($input["address"])) {

                            $old_address = $this->address_model->delete_address_by_user_id($user_id);



                            for ($a = 0; $a < count($input["address"]); $a++) {

                                $input["address"][$a]["user_id"] = $user_id;

                                $input["address"][$a]["type"] = $a + 1;

                                $this->address_model->insert_address($input["address"][$a]);
                            }
                        }

                        if (isset($input["lang"]) && !empty($input["lang"])) {

                            $this->language_model->delete_language_by_user_id($user_id);

                            for ($i = 0; $i < count(array_filter($input["lang"]["language"])); $i++) {

                                $arr_chk = array_chunk($input["lang"]["rws"], 3);

                                $lang_val = array("language" => $input["lang"]["language"][$i],
                                    "rws" => $arr_chk[$i][0] . ":" . $arr_chk[$i][1] . ":" . $arr_chk[$i][2],
                                    "user_id" => $user_id
                                );

                                $this->language_model->insert_languages($lang_val);
                            }
                        }

                        if (isset($input["identification_marks"]) && !empty($input["identification_marks"])) {

                            $this->identification_model->delete_identifcation_by_user_id($user_id);

                            for ($i = 0; $i < count($input["identification_marks"]["identification_mark"]); $i++) {



                                $id_val = array("identification_mark" => $input["identification_marks"]["identification_mark"][$i],
                                    "user_id" => $user_id
                                );

                                $this->identification_model->insert_identification($id_val);
                            }
                        }

                        if (isset($input["ref"]) && !empty($input["ref"])) {

                            $this->reference_model->delete_reference_by_user_id($user_id);

                            for ($i = 0; $i < count(array_filter($input["ref"]["name"])); $i++) {



                                $ref_val = array("name" => $input["ref"]["name"][$i],
                                    "relation" => $input["ref"]["relation"][$i],
                                    "company_name" => $input["ref"]["company_name"][$i],
                                    "city" => $input["ref"]["city"][$i],
                                    "contact_no" => $input["ref"]["contact_no"][$i],
                                    "user_id" => $user_id
                                );

                                $this->reference_model->insert_reference($ref_val);
                            }
                        }

                        $input["user_dep"]["user_id"] = $user_id;

                        //$salary_group = $this->department_model->get_department_by_id($input["user_dep"]["department"]);
                        //$input["user_salary"]["salary_group"] = $salary_group[0]["salary_group_id"];
                        //$input["user_salary"]["user_id"] = $user_id;
                        //$input["user_salary"]["revised_date"] = date('Y-m-d H:i:s');

                        $input["leave"]["user_id"] = $user_id;

                        if (isset($data["user_history"][0]['date'])) {

                            $history['date'] = date('Y-m-d', strtotime($input['user_history']['doj']));

                            $this->user_history_model->update_history_by_user_id($user_id, 1, $history);

                            $user_salary["revised_date"] = date('Y-m-d H:i:s', strtotime($input['user_history']['doj']));

                            $this->user_salary_model->update_user_salary_by_user_id_and_date($user_id, $data["user_history"][0]['date'], $user_salary);

                            $user_shift["created"] = date('Y-m-d', strtotime($input['user_history']['doj']));

                            $this->user_shift_model->update_user_shift_by_user_id_and_date($user_id, $data["user_history"][0]['date'], $user_shift);
                        } else {

                            $history['date'] = date('Y-m-d', strtotime($input['user_history']['doj']));

                            $history["user_id"] = $user_id;

                            $history["type"] = 1;

                            $this->user_history_model->insert_history($history);
                        }



                        if ($input['user_history']['dol'] != ""):

                            $this->user_history_model->delete_history_by_user_id($user_id, 'dol');

                            $dol["date"] = date('Y-m-d', strtotime($input['user_history']['dol']));

                            $dol["user_id"] = $user_id;

                            $dol["type"] = 2;

                            $this->user_history_model->insert_history($dol);

                        endif;

                        // if (isset($data["user_dep"]) && !empty($data["user_dep"]))
                        //   $this->user_department_model->update_user_department_by_user_id($user_id, $input["user_dep"]);
                        //  else
                        //   $this->user_department_model->insert_user_department($input["user_dep"]);
                        //$this->user_salary_model->insert_user_salary($input["user_salary"]);
                        //$this->user_salary_model->update_user_salary_by_salary_id($data["user_sal"][0]["id"],$input["user_salary"]);

                        if (isset($data["leave"]) && !empty($data["leave"]))
                            $this->available_leaves_model->update_user_leaves_by_user_id($user_id, $input["leave"]);
                        else
                            $this->available_leaves_model->insert_user_leaves($input["leave"]);

                        if (isset($input["exp"]) && !empty($input["exp"])) {

                            $this->experience_model->delete_experiences_by_user_id($user_id);



                            for ($i = 0; $i < count(array_filter($input["exp"]["company"])); $i++) {



                                $exp_val = array("company" => $input["exp"]["company"][$i],
                                    "designation" => $input["exp"]["designation"][$i],
                                    "start_date" => date("Y-m-d", strtotime($input["exp"]["start_date"][$i])),
                                    "end_date" => date("Y-m-d", strtotime($input["exp"]["end_date"][$i])),
                                    "salary" => $input["exp"]["salary"][$i],
                                    "reason_for_leaving" => $input["exp"]["reason_for_leaving"][$i],
                                    "user_id" => $user_id
                                );

                                $this->experience_model->insert_experiences($exp_val);
                            }
                        }

                        /* if(isset($_GET['users']))

                          {

                          $user_view =$_GET['users'];

                          }

                          else

                          $user_view = 1;



                          if(isset($_GET['show']))

                          {

                          $user_show = $_GET['show'];

                          }

                          else

                          $user_show =10; */

//                                    $this->session_messages->add_message('success', 'Employee details are updated');

                        redirect($this->config->item('base_url') . "masters/biometric/employees");
                    } else {

                        $data["error"] = 5;
                    }
                    //} else {
                    // $data["error"] = '4';
                    // }
                    //  } else {
                    //leave
                    //    $data["error"] = "2";
                    //   }
                    // } else {
                    //leave
                    //$data["error"] = "1";
                    // }
                } else {

                    //general

                    $data["error"] = "0";
                }
            }

            last:



            $data["edu"] = $this->education_model->get_user_education_by_id($user_id);

            $data["family"] = $this->family_model->get_family_members_by_user_id($user_id);

            $data["nominee"] = $this->family_model->get_nominees_by_user_id($user_id);

            $data["lang"] = $this->language_model->get_languages_by_user_id($user_id);

            $data["identification"] = $this->identification_model->get_identifications_by_user_id($user_id);

            $data["ref"] = $this->reference_model->get_references_by_user_id($user_id);

            $data["user_dep"] = $this->user_department_model->get_department_by_user_id($user_id);

            $data["user_sal"] = $this->user_salary_model->get_user_salary_by_user_id($user_id);

            $data["user_shift"] = $this->user_shift_model->get_user_current_shift_by_user_id($user_id);

            $data["all_shift"] = $this->user_shift_model->get_all_user_shift_by_user_id($user_id);

            $data["all_salary"] = $this->user_salary_model->get_all_user_salary_by_user_id($user_id);

            $data["leave"] = $this->available_leaves_model->get_user_leaves_by_user_id($user_id);

            $data["exp"] = $this->experience_model->get_experiences_by_user_id($user_id);

            $data["address"][0] = $this->address_model->get_address_by_user_id_by_type($user_id, 'present');

            $data["address"][1] = $this->address_model->get_address_by_user_id_by_type($user_id, 'permanent');

            //$this->pre_print->viewExit($data);
//            $datam["messages"] = $this->session_messages->view_all_messages();
//            $this->template->write_view('session_msg', 'masters/session_messages', $datam);
            $data['user_role'] = $user = $this->user_model->get_user_role();
            $data['firms'] = $firms = $this->user_model->get_all_firms();
            $this->template->write_view('content', 'masters/edit_employee', $data);

            $this->template->render();
        } else {

            echo "Access denied";
        }
    }

    public function delete_employee($user_id) {

        $this->load->model('users_model');

        $this->users_model->delete_user($user_id, 0);

//        $this->session_messages->add_message('error', 'Employee deactivated');
//
//        $datam["messages"] = $this->session_messages->view_all_messages();
//
//        $this->template->write_view('session_msg', 'masters/session_messages', $datam);
        //	$delete = $this->users_model->delete_user($user_id);
        redirect($this->config->item('base_url') . "masters/employees");
    }

    //Department Module

    public function departments() {

        // $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["no_of_depts"] = $this->department_model->get_department_count();

        $result = array();

        $result["total_rows"] = $data["no_of_depts"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/biometric/departments/";

        $result["per_page"] = 50;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

        //$this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $filter = array();

        $data['departments'] = $this->department_model->get_all_departments_by_limit($result["per_page"], $page, $filter);

        $data["links"] = $this->pagination->create_links();

        $data["start"] = $page;

        //$this->pre_print->viewExit($data);
        // $datam["messages"] = $this->session_messages->view_all_messages();
        // $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/departments', $data);

        $this->template->render();
    }

    public function view_department($dept_id) {


        //  $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["dept"] = $this->department_model->get_department_by_id($dept_id);

        //  $datam["messages"] = $this->session_messages->view_all_messages();
        //   $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/view_department', $data);

        $this->template->render();
    }

    public function edit_department($dept_id) {

        //print_r($_POST);
        //exit;
        $data['department_id'] = $dept_id;
        $data["dept"] = $this->department_model->get_department_by_id($dept_id);

        $data["users"] = $this->users_model->get_all_users(1);

        $data["shifts"] = $this->shift_model->get_all_shifts();

        $data["salary_groups"] = $this->salary_group_model->get_all_salary_groups();

        // if ($this->input->post('save')) {
        if (isset($_POST['department_id'])) {

            $dept = $this->input->post("dept");

            $data["dept"] = $dept;

            //$this->pre_print->viewExit($dept);



            if (isset($dept) && !empty($dept)) {



                foreach ($dept as $key => $val) {

                    if ($key != "department_head") {

                        $field_name = ucfirst(str_replace('_', ' ', $key));

                        if ($key == "name")
                            $field_name = "Department Name";

                        $rules = "required";



                        $department[] = array(
                            'field' => "dept[" . $key . "]",
                            'label' => $field_name,
                            'rules' => $rules
                        );
                    }
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($department);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->department_model->check_department_exist($dept["name"], $dept_id);



                if (isset($existing) && !empty($existing))
                    goto last;



                if (isset($dept["department_head"]) && $dept["department_head"] == "")
                    $dept["department_head"] = NULL;

                $this->department_model->update_department($dept_id, $dept);

                //   $this->session_messages->add_message('success', 'Department details updated');

                redirect($this->config->item('base_url') . "masters/biometric/departments");

                last:

                //   $this->session_messages->add_message('warning', 'Department already exist');
            }
        }

        //$this->pre_print->viewExit($data);
        //  $datam["messages"] = $this->session_messages->view_all_messages();
        //  $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/edit_department', $data);

        $this->template->render();
    }

    public function add_department() {

        $data["users"] = $this->users_model->get_all_users(1);

        $data["shifts"] = $this->shift_model->get_all_shifts();

        $data["salary_groups"] = $this->salary_group_model->get_all_salary_groups();

        if ($this->input->post('save')) {

            $dept = $this->input->post("dept");



            //$this->pre_print->viewExit($dept);



            if (isset($dept) && !empty($dept)) {

                $data["dept_length"] = count($dept["name"]);

                $data["post"] = $dept;



                foreach ($dept as $key => $val) {

                    if ($key != 'status' && $key != "department_head") {

                        $field_name = ucfirst(str_replace('_', ' ', $key));

                        if ($key == "name")
                            $field_name = "Department Name";

                        $rules = "required";



                        $department[] = array(
                            'field' => "dept[" . $key . "][]",
                            'label' => $field_name,
                            'rules' => $rules
                        );
                    }
                }

                //$this->pre_print->viewExit($department);

                for ($k = 0; $k < count($dept["name"]); $k++) {



                    $department[] = array(
                        'field' => "dept[status][" . $k . "]",
                        'label' => 'Department Status',
                        'rules' => 'required'
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($department);

            if ($this->form_validation->run() != FALSE) {

                //$this->pre_print->viewExit($dept);

                $dept_list = array();

                if (isset($dept["name"]) && !empty($dept["name"])) {

                    foreach ($dept["name"] as $d_name)
                        $dept_list[] = trim(strtolower($d_name));
                }



                $dept_list_count_before = count($dept_list);

                $dept_list = array_unique($dept_list);

                $dept_list_count_after = count($dept_list);

                $data["multiple_dept"] = "";

//                if ($dept_list_count_before != $dept_list_count_after) {
//
//                    $data["multiple_dept"] = 1;
//
//                    $this->session_messages->add_message('warning', 'Duplicate department not allowed');
//                }

                $existing_dept = $this->department_model->check_department_exist($dept_list);

//                if (isset($existing_dept) && !empty($existing_dept)) {
//
//                    $data["exist"] = 1;
//
//                    $this->session_messages->add_message('warning', 'Department already exist');
//                }

                if ($data["multiple_dept"] == "" && !isset($data["exist"])) {

                    //$this->pre_print->viewExit($existing);

                    for ($i = 0; $i < count($dept["name"]); $i++) {

                        $dept_ar = array("name" => $dept["name"][$i], "status" => $dept["status"][$i]);

                        if ($dept["department_head"][$i] != "")
                            $dept_ar["department_head"] = $dept["department_head"][$i];



                        $this->department_model->insert_department($dept_ar);
                    }

                    //   $this->session_messages->add_message('success', 'Department(s) added');

                    redirect($this->config->item('base_url') . "masters/biometric/departments");
                }
            }
        }

        //$this->pre_print->viewExit($data);
        //  $datam["messages"] = $this->session_messages->view_all_messages();
        //  $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/add_department', $data);

        $this->template->render();
    }

    public function delete_department($dept_id) {

        $this->load->model('department_model');

        $delete = $this->department_model->delete_department($dept_id);

        //   $this->session_messages->add_message('error', 'Department deleted');
        //  $datam["messages"] = $this->session_messages->view_all_messages();
        //  $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        redirect($this->config->item('base_url') . "masters/biometric/departments");
    }

    //Shift module

    public function shifts() {

        $this->load->model('shift_model');

        $this->load->model('masters/user_roles_model');



        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["no_of_shifts"] = $this->shift_model->get_shift_count();

        $result = array();

        $result["total_rows"] = $data["no_of_shifts"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/biometric/shifts/";

        $result["per_page"] = 10;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class = "tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;
';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;
';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class = "current"><a href = "#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;
&lt;
';

        $result['last_link'] = '&gt;
&gt;
';

        $this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

//        $filter = $this->session_view->get_session(null, null);

        $data['shifts'] = $this->shift_model->get_all_shifts_by_limit($result["per_page"], $page, $filter);

        $data["links"] = $this->pagination->create_links();

        $data["start"] = $page;
        $data['shift_datas'] = $this->shift_model->get_all_shift_datas();

        //array_unique($data["shifts"]);
        //$this->pre_print->viewExit($data);
//        $datam["messages"] = $this->session_messages->view_all_messages();
//        $this->template->write_view('session_msg', 'masters/session_messages', $datam);
        $this->template->write_view('content', 'masters/shifts', $data);

        $this->template->render();
    }

    public function add_shift() {

        $this->load->model('shift_model');

        $data = array();

        if ($this->input->post('shift')) {

            $shift = $this->input->post("shift");


            $data["shift"] = $shift;

            //$this->pre_print->viewExit($shift);


            if (isset($shift) && !empty($shift)) {

                $data["s_length"] = count($shift["from_time"]);

                foreach ($shift as $key => $val) {



                    $field_name = ucfirst(str_replace('_', ' ', $key));

                    $rules = "required";

                    if ($key == "name") {

                        $field_name = "Shift name";



                        $shft[] = array(
                            'field' => "shift[" . $key . "]",
                            'label' => $field_name,
                            'rules' => $rules
                        );
                    } else {

                        $shft[] = array(
                            'field' => "shift[" . $key . "][]",
                            'label' => $field_name,
                            'rules' => $rules
                        );
                    }
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($shft);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->shift_model->check_shift_exist($shift["name"]);

                if (isset($existing) && !empty($existing))
                    goto last;



                $shift_new = array("name" => $shift['name']);

                $shift_id = $this->shift_model->insert_shift($shift_new);



                for ($i = 0; $i < count($shift["from_time"]); $i++) {
                    $shift_details = array("type" => $shift["type"][$i], "from_time" => $shift["from_time"][$i], "to_time" => $shift["to_time"][$i], "shift_id" => $shift_id);

                    //print_r($shift_details);

                    $this->shift_model->insert_shift_details($shift_details);
                }

                //exit;
//                $this->session_messages->add_message('success', 'Shift added');

                redirect($this->config->item('base_url') . "masters/biometric/shifts");

                last:

//                $this->session_messages->add_message('warning', 'Shift already exist');
            }
        }

//        $datam["messages"] = $this->session_messages->view_all_messages();
//
//        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/add_shift', $data);

        $this->template->render();
    }

    public function view_shift($shift_id) {

        $this->load->model('shift_model');
        $this->load->model('masters/user_roles_model');



        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["shift"] = $this->shift_model->get_shift_by_id($shift_id);

        //$this->pre_print->viewExit($data);
//        $datam["messages"] = $this->session_messages->view_all_messages();
//
//        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/view_shift', $data);

        $this->template->render();
    }

    public function edit_shift($shift_id) {

        $this->load->model('shift_model');

        $data = array();


        $data["shift"] = $this->shift_model->get_shift_by_id($shift_id);



        if ($this->input->post()) {


            $shift = $this->input->post("shift");



            if (isset($shift) && !empty($shift)) {

                $data["s_length"] = count($shift["type"]);

                foreach ($shift as $key => $val) {
                    $field_name = ucfirst(str_replace('_', ' ', $key));

                    $rules = "required";

                    if ($key == "name") {

                        $field_name = "Shift name";



                        $shft[] = array(
                            'field' => "shift[" . $key . "]",
                            'label' => $field_name,
                            'rules' => $rules
                        );
                    } else {

                        $shft[] = array(
                            'field' => "shift[" . $key . "][]",
                            'label' => $field_name,
                            'rules' => $rules
                        );
                    }
                }
            }



            $this->form_validation->set_rules($shft);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->shift_model->check_shift_exist($shift["name"], $shift_id);
                if (isset($existing) && !empty($existing)) {
                    $this->session_messages->add_message('success', 'Shift already exists');
                    redirect($this->config->item('base_url') . "masters/biometric/edit_shift/" . $shift_id);
                }
                //if (isset($existing) && !empty($existing))
                //goto last;


                $shift_new = array("name" => $shift['name']);

                $this->shift_model->update_shift($shift_id, $shift_new);

                $this->shift_model->delete_shift_details_by_shift_id($shift_id);


                for ($i = 0; $i < count($shift["type"]); $i++) {

                    $shift_details = array("type" => $shift["type"][$i], "from_time" => $shift["from_time"][$i], "to_time" => $shift["to_time"][$i], "shift_id" => $shift_id);

                    $this->shift_model->insert_shift_details($shift_details);
                }


                // $this->session_messages->add_message('success', 'Shift details updated');
                // redirect($this->config->item('base_url') . "masters/biometric/shifts");
                // last:
            }
        }

        //  exit;
//        $datam["messages"] = $this->session_messages->view_all_messages();
//        $this->template->write_view('session_msg', 'masters/session_messages', $datam);
        //echo "<pre>";print_r($data);exit;


        $this->template->write_view('content', 'masters/edit_shift', $data);

        $this->template->render();
    }

    public function delete_shift($shift_id) {

        $this->load->model('shift_model');

        $delete = $this->shift_model->delete_shift($shift_id);



//        $this->session_messages->add_message('error', 'Shift deleted');
//        $datam["messages"] = $this->session_messages->view_all_messages();
//        $this->template->write_view('session_msg', 'masters/session_messages', $datam);
        redirect($this->config->item('base_url') . "masters/biometric/shifts");
    }

    //Salary Group Module

    public function salary_groups($page = null) {



        $this->load->model('salary_group_model');

        $this->load->model('masters/user_roles_model');



        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["no_of_groups"] = $this->salary_group_model->get_salary_group_count();

        $result = array();

        $result["total_rows"] = $data["no_of_groups"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/salary_groups/";

        $result["per_page"] = 10;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $filter = $this->session_view->get_session(null, null);

        $data["salary_groups"] = $this->salary_group_model->get_all_salary_groups_by_limit($result["per_page"], $page, $filter);



        $data["links"] = $this->pagination->create_links();

        $data["start"] = $page;

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/salary_groups', $data);



        $this->template->render();
    }

    //Salary Group Type Module

    public function salary_group_type($page = null) {

        $this->load->model('options_model');

        $this->load->model('masters/user_roles_model');



        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["no_of_des"] = $this->options_model->get_options_by_count_type('salary_group_type');

        $result = array();

        $result["total_rows"] = $data["no_of_des"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/salary_group_type/";

        $result["per_page"] = 10;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';

        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $filter = $this->session_view->get_session(null, null);

        $data['salary_group_type'] = $this->options_model->get_options_by_limit($result["per_page"], $page, 'salary_group_type', $filter);

        $data["links"] = $this->pagination->create_links();

        $data["start"] = $page;

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/salary_group_type', $data);



        $this->template->render();
    }

    function add_salary_group_type() {

        $this->load->model('options_model');

        $data = array();

        if ($this->input->post('save')) {

            $des = $this->input->post("salary_group_type");



            if (isset($des) && !empty($des)) {

                foreach ($des as $key => $val) {





                    $rules = "required";



                    $des_rules[] = array(
                        'field' => "salary_group_type[" . $key . "]",
                        'label' => 'Salary group type',
                        'rules' => $rules
                    );
                }
            }

            $this->form_validation->set_rules($des_rules);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->options_model->get_option_by_name('salary_group_type');



                if (isset($existing) && !empty($existing)) {



                    foreach ($existing as $old) {

                        if (strtolower($old["value"]) == strtolower($des["value"])) {

                            goto last;
                        }
                    }
                }

                $des["key"] = "salary_group_type";

                $des_id = $this->options_model->insert_options($des);

                $this->session_messages->add_message('success', 'Salary group type added');

                redirect($this->config->item('base_url') . "masters/salary_group_type");

                last:

                $this->session_messages->add_message('warning', 'Salary group type already exist');
            }
        }

        //$this->pre_print->viewExit($data);

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/add_salary_group_type', $data);

        $this->template->render();
    }

    function edit_salary_group_type($des_id) {

        $this->load->model('options_model');



        $data["salary_group_type"] = $this->options_model->get_options_by_id($des_id);



        if ($this->input->post('save')) {

            $des = $this->input->post("salary_group_type");



            if (isset($des) && !empty($des)) {

                foreach ($des as $key => $val) {

                    $rules = "required";



                    $des_rules[] = array(
                        'field' => "salary_group_type[" . $key . "]",
                        'label' => 'Salary group type',
                        'rules' => $rules
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($des_rules);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->options_model->get_all_options_except($des_id, 'salary_group_type');



                if (isset($existing) && !empty($existing)) {

                    foreach ($existing as $old) {

                        if ($old["value"] == $des["value"]) {

                            goto last;
                        }
                    }
                }

                $des["key"] = "salary_group_type";

                $des_id = $this->options_model->update_options($des_id, $des);

                $this->session_messages->add_message('success', 'Salary group type updated');

                redirect($this->config->item('base_url') . "masters/salary_group_type");

                last:

                $this->session_messages->add_message('warning', 'Salary group type already exist');
            }
        }

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/edit_salary_group_type', $data);

        $this->template->render();
    }

    public function delete_salary_group_type($id) {

        $this->load->model('options_model');

        $this->options_model->delete_options_by_id($id);

        $this->session_messages->add_message('error', 'Salary group type deleted');

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);
    }

    public function add_salary_group() {

        $this->load->model('salary_group_model');

        $this->load->model('options_model');

        $data = array();

        if ($this->input->post('save')) {

            $salary = $this->input->post("salary_group");



            if (isset($salary) && !empty($salary)) {

                $data["s_length"] = count($salary["type"]);

                $data["post"] = $salary;



                foreach ($salary as $key => $val) {

                    if ($key != 'percentage' && $key != 'deduction') {

                        $field_name = ucfirst(str_replace('_', ' ', $key));

                        $rules = "required";

                        if ($key == "name") {

                            $field_name = "Salary group Name";



                            $groups[] = array(
                                'field' => "salary_group[" . $key . "]",
                                'label' => $field_name,
                                'rules' => $rules
                            );
                        } else {



                            $groups[] = array(
                                'field' => "salary_group[" . $key . "][]",
                                'label' => $field_name,
                                'rules' => $rules
                            );
                        }
                    }
                }

                //$this->pre_print->viewExit($salary);

                for ($k = 0; $k < count($salary["type"]); $k++) {



                    $groups[] = array(
                        'field' => "salary_group[percentage][" . $k . "]",
                        'label' => 'Percentage',
                        'rules' => 'required'
                    );





                    $groups[] = array(
                        'field' => "salary_group[deduction][" . $k . "]",
                        'label' => 'Deduction',
                        'rules' => 'required'
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($groups);

            if ($this->form_validation->run() != FALSE) {

                //$this->pre_print->viewExit($salary);

                $existing = $this->salary_group_model->check_salary_group_exist($salary["name"]);

                if (isset($existing) && !empty($existing))
                    goto last;



                $salary_gr = array("name" => $salary["name"], "status" => 1);

                $salary_gr_id = $this->salary_group_model->insert_salary_group($salary_gr);

                for ($i = 0; $i < count($salary["type"]); $i++) {

                    $split_ar = array("type" => $salary["type"][$i], "percentage" => $salary["percentage"][$i], "salary_group_id" => $salary_gr_id,
                        "value" => $salary["value"][$i], "deduction" => $salary["deduction"][$i]);



                    $this->salary_group_model->insert_salary_group_details($split_ar);
                }

                $this->session_messages->add_message('success', 'Salary group added');

                redirect($this->config->item('base_url') . "masters/salary_groups/");

                last:

                $this->session_messages->add_message('warning', 'Salary group already exist');
            }
        }

        $data["salary_group_type"] = $this->options_model->get_options_by_type('salary_group_type');

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/add_salary_group', $data);



        $this->template->render();
    }

    public function edit_salary_group($group_id) {

        $this->load->model('salary_group_model');

        $this->load->model('options_model');



        $data['salary_group'] = $this->salary_group_model->get_salary_group_by_id($group_id);



        $data["salary_split"] = $this->salary_group_model->get_salary_group_split_by_salary_group_id($group_id);



        if ($this->input->post('save')) {

            $salary = $this->input->post("salary_group");



            if (isset($salary) && !empty($salary)) {

                $data["s_length"] = count($salary["type"]);

                $data["post"] = $salary;



                foreach ($salary as $key => $val) {

                    if ($key != 'percentage' && $key != 'deduction') {

                        $field_name = ucfirst(str_replace('_', ' ', $key));

                        $rules = "required";

                        if ($key == "name") {

                            $field_name = "Salary group Name";



                            $groups[] = array(
                                'field' => "salary_group[" . $key . "]",
                                'label' => $field_name,
                                'rules' => $rules
                            );
                        } else {



                            $groups[] = array(
                                'field' => "salary_group[" . $key . "][]",
                                'label' => $field_name,
                                'rules' => $rules
                            );
                        }
                    }
                }

                //$this->pre_print->viewExit($salary);

                for ($k = 0; $k < count($salary["type"]); $k++) {



                    $groups[] = array(
                        'field' => "salary_group[percentage][" . $k . "]",
                        'label' => 'Percentage',
                        'rules' => 'required'
                    );





                    $groups[] = array(
                        'field' => "salary_group[deduction][" . $k . "]",
                        'label' => 'Deduction',
                        'rules' => 'required'
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($groups);

            if ($this->form_validation->run() != FALSE) {

                //$this->pre_print->viewExit($salary);

                $existing = $this->salary_group_model->check_salary_group_exist($salary["name"], $group_id);

                if (isset($existing) && !empty($existing))
                    goto last;



                $salary_gr = array("name" => $salary["name"]);

                $salary_gr_id = $this->salary_group_model->update_salary_group($group_id, $salary_gr);

                $this->salary_group_model->delete_split_details_by_salary_group_id($group_id);

                for ($i = 0; $i < count($salary["type"]); $i++) {

                    $split_ar = array("type" => $salary["type"][$i], "percentage" => $salary["percentage"][$i], "salary_group_id" => $group_id,
                        "value" => $salary["value"][$i], "deduction" => $salary["deduction"][$i]);



                    $this->salary_group_model->insert_salary_group_details($split_ar);
                }

                $this->session_messages->add_message('success', 'Salary group details updated');

                redirect($this->config->item('base_url') . "masters/salary_groups/");

                last:

                $this->session_messages->add_message('warning', 'Salary group already exist');
            }
        }

        $data["salary_group_type"] = $this->options_model->get_options_by_type('salary_group_type');

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/edit_salary_group', $data);



        $this->template->render();
    }

    public function view_salary_group($group_id) {

        $this->load->model('salary_group_model');

        $data['salary_group'] = $this->salary_group_model->get_salary_group_by_id($group_id);

        $data["salary_split"] = $this->salary_group_model->get_salary_group_split_by_salary_group_id($group_id);

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/view_salary_group', $data);

        $this->template->render();
    }

    public function delete_salary_group($group_id) {

        $this->load->model('salary_group_model');

        //$delete = $this->salary_group_model->delete_salary_group($group_id);

        $this->salary_group_model->update_status_by_salary_group_id($group_id);

        $this->session_messages->add_message('error', 'Salary group deleted');

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);
    }

    //Designation Module

    public function designations() {

        //  $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["no_of_des"] = $this->designation_model->get_designation_count();

        $result = array();

        $result["total_rows"] = $data["no_of_des"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/biometric/designations/";

        $result["per_page"] = 10;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $filter = array();



        $data['designations'] = $this->designation_model->get_all_designations_by_limit($result["per_page"], $page, $filter);

        $data["links"] = $this->pagination->create_links();

        $data["start"] = $page;

        //   $datam["messages"] = $this->session_messages->view_all_messages();
        //  $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/designations', $data);



        $this->template->render();
    }

    public function add_designation() {

        //  $this->load->model('designation_model');

        $data = array();

        if ($this->input->post('save')) {

            $des = $this->input->post("designation");



            if (isset($des) && !empty($des)) {

                foreach ($des as $key => $val) {



                    $field_name = ucfirst(str_replace('_', ' ', $key));



                    $rules = "required";



                    $des_rules[] = array(
                        'field' => "designation[" . $key . "]",
                        'label' => $field_name,
                        'rules' => $rules
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($des_rules);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->designation_model->check_designation_exist($des["name"]);



                if (isset($existing) && !empty($existing))
                    goto last;



                $des_id = $this->designation_model->insert_designation($des);

                //    $this->session_messages->add_message('success', 'Designation added');

                redirect($this->config->item('base_url') . "masters/biometric/designations");

                last:

                //   $this->session_messages->add_message('warning', 'Designation already exist');
            }
        }

        //$this->pre_print->viewExit($data);
        //$datam["messages"] = $this->session_messages->view_all_messages();
        //   $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/add_designation', $data);



        $this->template->render();
    }

    public function edit_designation($des_id) {

        //  $this->load->model('designation_model');
        $data['designation_id'] = $des_id;
        $data["dest"] = $this->designation_model->get_designation_by_id($des_id);

        // if ($this->input->post('save')) {
        if (isset($_POST['designation_id'])) {
            $des = $this->input->post("designation");



            if (isset($des) && !empty($des)) {

                foreach ($des as $key => $val) {



                    $field_name = ucfirst(str_replace('_', ' ', $key));



                    $rules = "required";



                    $des_rules[] = array(
                        'field' => "designation[" . $key . "]",
                        'label' => $field_name,
                        'rules' => $rules
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($des_rules);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->designation_model->check_designation_exist($des["name"], $des_id);



                if (isset($existing) && !empty($existing))
                    goto last;



                $des_id = $this->designation_model->update_designation($des_id, $des);

                // $this->session_messages->add_message('success', 'Designation updated');

                redirect($this->config->item('base_url') . "masters/biometric/designations");

                last:

                //   $this->session_messages->add_message('warning', 'Designation already exist');
            }
        }

        //  $datam["messages"] = $this->session_messages->view_all_messages();
        // $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/edit_designation', $data);



        $this->template->render();
    }

    public function delete_designation($des_id) {

        //  $this->load->model('designation_model');

        $delete = $this->designation_model->delete_designation($des_id);

        //  $this->session_messages->add_message('error', 'Designation deleted');
        //$datam["messages"] = $this->session_messages->view_all_messages();
        //   $this->template->write_view('session_msg', 'masters/session_messages', $datam);
        redirect($this->config->item('base_url') . "masters/biometric/designations");
    }

    //Whitelist Module

    public function white_list() {

        $this->load->model('whitelist_ip_model');

        $this->load->model('masters/user_roles_model');



        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["no_of_ips"] = $this->whitelist_ip_model->get_whitelist_count();

        $result = array();

        $result["total_rows"] = $data["no_of_ips"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/white_list/";

        $result["per_page"] = 10;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $filter = $this->session_view->get_session(null, null);

        $data['whitelists'] = $this->whitelist_ip_model->get_all_whitelist_ips_by_limit($result["per_page"], $page, $filter);

        $data["all"] = $this->whitelist_ip_model->get_all_activate_ip();

        $data["links"] = $this->pagination->create_links();

        $data["start"] = $page;

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/whitelists', $data);

        $this->template->render();
    }

    public function add_whitelist() {

        $this->load->model('whitelist_ip_model');



        $data = array();



        if ($this->input->post('save')) {

            $input = $this->input->post();



            //print_r($input);
            //exit;

            if (isset($input["whitelist"]) && !empty($input["whitelist"])) {

                $data["list_length"] = count($input["whitelist"]["ip_address"]);

                $data["post"] = $input["whitelist"];

                foreach ($input["whitelist"] as $key => $val) {

                    if ($key != "status") {

                        $field_name = ucfirst(str_replace('_', ' ', $key));

                        $rules = "required";



                        $list[] = array(
                            'field' => "whitelist[" . $key . "][]",
                            'label' => $field_name,
                            'rules' => $rules
                        );
                    }
                }

                for ($k = 0; $k < $data["list_length"]; $k++) {



                    $list[] = array(
                        'field' => "whitelist[status][" . $k . "]",
                        'label' => 'Status',
                        'rules' => 'required'
                    );
                }
            }

            //$this->pre_print->viewExit($list);

            $this->form_validation->set_rules($list);

            if ($this->form_validation->run() != FALSE) {

                $ip_list = array();

                if (isset($data["post"]["ip_address"]) && !empty($data["post"]["ip_address"])) {

                    foreach ($data["post"]["ip_address"] as $current_ip) {

                        $ip_list[] = trim($current_ip);
                    }
                }

                $ip_count_before = count($ip_list);

                $ip_list = array_unique($ip_list);

                $ip_count_after = count($ip_list);

                //print_r($ip_list);

                $data["multiple_ip"] = "";

                $data["exist"] = "";

                if ($ip_count_before != $ip_count_after) {

                    $data["multiple_ip"] = $ip_list;

                    $this->session_messages->add_message('warning', 'Duplicate IP Address not allowed');
                }

                $existed_ips = $this->whitelist_ip_model->check_ip_exist($ip_list);

                if (isset($existed_ips) && !empty($existed_ips)) {

                    $data["exist"] = $ip_list;



                    $m = 1;

                    foreach ($existed_ips as $row) {

                        $com_arr[] = $row['id'];

                        $m++;
                    }

                    $existing_ip_list = $this->whitelist_ip_model->get_ip_details_by_id_list($com_arr);



                    foreach ($existing_ip_list as $row) {

                        $com_arr[] = $row['ip_address'];

                        $m++;
                    }

                    $data["duplicate_ip"] = $com_arr;

                    $this->session_messages->add_message('warning', 'IP Address already exist');
                }

                if ($data["multiple_ip"] == "" && $data["exist"] == "") {

                    for ($i = 0; $i < count($data["post"]["ip_address"]); $i++) {

                        $whitelist_ar = array("ip_address" => $data["post"]["ip_address"][$i], "status" => $data["post"]["status"][$i]);

                        //$this->pre_print->viewExit($whitelist_ar);

                        $this->whitelist_ip_model->insert_ip($whitelist_ar);
                    }

                    $this->session_messages->add_message('success', 'Whitelist IP(s) added');

                    redirect($this->config->item('base_url') . "masters/white_list");
                }
            }
        }

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/add_whitelist', $data);



        $this->template->render();
    }

    public function edit_whitelist($whitelist_id) {

        $this->load->model('whitelist_ip_model');

        if ($this->input->post('save')) {

            $input = $this->input->post();

            if (isset($input["whitelist"]) && !empty($input["whitelist"])) {

                $data["post"] = $input["whitelist"];

                foreach ($input["whitelist"] as $key => $val) {

                    $field_name = ucfirst(str_replace('_', ' ', $key));

                    $rules = "required";



                    $list[] = array(
                        'field' => "whitelist[" . $key . "]",
                        'label' => $field_name,
                        'rules' => $rules
                    );
                }
            }

            $this->form_validation->set_rules($list);

            if ($this->form_validation->run() != FALSE) {

                $existed_ips = $this->whitelist_ip_model->check_ip_exist($input["whitelist"]["ip_address"], $whitelist_id);

                //print_r($existed_ips);
                //exit;

                $data["exist"] = 0;

                if (isset($existed_ips) && !empty($existed_ips)) {

                    $this->session_messages->add_message('warning', 'IP Address already exist');

                    $data["exist"] = 1;
                }

                if ($data["exist"] == 0) {

                    $id = $this->whitelist_ip_model->update_ip_by_id($whitelist_id, $input["whitelist"]);

                    $this->session_messages->add_message('success', 'Whitelist IP updated');

                    if ($id)
                        redirect($this->config->item('base_url') . "masters/white_list");
                }
            }
        }



        $data["whitelist"] = $this->whitelist_ip_model->get_ip_details_by_id($whitelist_id);

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/edit_whitelist', $data);



        $this->template->render();
    }

    public function delete_whitelist($whitelist_id) {

        $this->load->model('whitelist_ip_model');

        $delete = $this->whitelist_ip_model->delete_ip_by_id($whitelist_id);

        $this->session_messages->add_message('error', 'Whitelist IP # deleted');

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);
    }

    //Holiday Module

    public function public_holidays($page = null) {
        if ($this->input->post("go")) {

            $filter = $this->input->post();

            // $this->session_view->add_session(null, null, $filter);

            $data["count"] = $this->holidays_model->get_holidays_count($filter);
        } else {

            //  $filter = $this->session_view->get_session(null, null);

            if (isset($filter))
                $data["count"] = $this->holidays_model->get_holidays_count($filter);
            else
                $data["count"] = $this->holidays_model->get_holidays_count();
        }

        $data["count"] = count($data["count"]);

        $result = array();

        $result["total_rows"] = $data["count"];

        $result["base_url"] = $this->config->item('base_url') . "masters/biometric/public_holidays/";

        $result["per_page"] = 50;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

        //$this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        //   $filter = $this->session_view->get_session(null, null);

        $data["departments"] = $this->department_model->get_all_departments_by_status(1);

        if ($this->input->post("go")) {

            $filter = $this->input->post();

            $data['holidays'] = $this->holidays_model->get_all_holidays_by_limit($result["per_page"], $page, $filter);
        } else {

            $data['holidays'] = $this->holidays_model->get_all_holidays_by_limit($result["per_page"], $page, $filter);
        }

        //$data['holidays'] = $this->holidays_model->get_all_holidays_by_limit($result["per_page"],$page,$filter);

        $data["links"] = $this->pagination->create_links();

        $data["start"] = $page;

        //$this->pre_print->viewExit($data);
        //   $datam["messages"] = $this->session_messages->view_all_messages();
        //    $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/public_holidays', $data);

        $this->template->render();
    }

    public function add_public_holidays() {

        $this->load->model('holidays_model');

        $this->load->model('department_model');

        $data["departments"] = $this->department_model->get_all_department_names_with_status(1);

        if ($this->input->post('save')) {

            $input = $this->input->post();

            $data["holiday_length"] = count($input["holiday"]["reason"]);

            //echo $data["holiday_length"];

            if (isset($input["holiday"]) && !empty($input["holiday"])) {

                $data["post"] = $input["holiday"];



                $a1 = $input["holiday"]["holiday_from"];

                $a2 = $input["holiday"]["holiday_to"];

                $a3 = $input["holiday"]["department"];

                $v = 0;

                foreach ($a1 as $key => $val) {



                    $from = date($a1[$key]);

                    $to = date($a2[$key]);

                    $arr = array();

                    foreach ($a1 as $arr_key => $arr_val) {

                        if ($v != $arr_key) {

                            $from_d = date($a1[$arr_key]);

                            $to_d = date($a2[$arr_key]);



                            if ((strtotime($from_d) >= strtotime($from) && strtotime($from_d) <= strtotime($to)) || (strtotime($to_d) >= strtotime($from) && strtotime($to_d) <= strtotime($to))) {

                                foreach ($a3[$arr_key] as $dept1) {

                                    $arr[] = $dept1;
                                }

                                foreach ($a3[$v] as $dept2) {

                                    $arr[] = $dept2;
                                }

                                //print_r($arr);

                                $count1 = count($arr);

                                $com_array = array_unique($arr);

                                $count2 = count($com_array);

                                if ($count1 != $count2) {

                                    $data["leave_error"] = 1;
                                }
                            }
                        }
                    }

                    $v++;
                }





                /* $count_arr = count($input["holiday"]["holiday_from"]);

                  $unique = array_unique($input["holiday"]["holiday_from"]);

                  // Duplicates

                  $duplicates = array_diff_assoc($input["holiday"]["holiday_from"], $unique);

                  // Unique values

                  $result = array_diff($unique, $duplicates);

                  // Get the unique keys

                  $unique_keys = array_keys($result);



                  if($count_arr>1 && !empty($duplicates))

                  {

                  for($i=0;$i<count($input["holiday"]["department"]);$i++)

                  {

                  if(!empty($unique_keys))

                  {

                  foreach($unique_keys as $unq)

                  {

                  if($unq!=$i)

                  {

                  foreach($input["holiday"]["department"][$i] as $uss)

                  {

                  $com_arr[]=$uss;

                  }

                  }

                  }

                  }

                  else

                  {

                  foreach($input["holiday"]["department"][$i] as $uss)

                  {

                  $com_arr[]=$uss;

                  }

                  }

                  }

                  }

                  //print_r($com_arr);

                  $this->pre_print->viewExit($input["holiday"]);

                  if(isset($com_arr))

                  {

                  $com_arr_count_before=count($com_arr);

                  $com_array=array_unique($com_arr);

                  $com_arr_count_after=count($com_array);

                  if($com_arr_count_before!=$com_arr_count_after)

                  {

                  $data["leave_error"] = 1;

                  }

                  } */

                if (isset($data["leave_error"])) {

//                    $this->session_messages->add_message('warning', 'More than one holiday for same deparment at same date not allowed');

                    goto last1;
                }

                //$this->pre_print->viewExit($input["holiday"]);
                //$data["s_length"] = count($input["holiday"]["reason"]);
                //echo $data["s_length"];

                foreach ($input["holiday"] as $key => $val) {

                    if ($key != "department") {

                        $field_name = ucfirst(str_replace('_', ' ', $key));

                        $rules = "required";



                        $list[] = array(
                            'field' => "holiday[" . $key . "][]",
                            'label' => $field_name,
                            'rules' => $rules
                        );
                    }
                }

                for ($k = 0; $k < $data["holiday_length"]; $k++) {



                    $list[] = array(
                        'field' => "holiday[department][" . $k . "][]",
                        'label' => 'Department',
                        'rules' => 'required'
                    );
                }
            }

            //$this->pre_print->viewExit($list);

            $this->form_validation->set_rules($list);

            if ($this->form_validation->run() != FALSE) {
                $existing = $this->holidays_model->get_all_holidays();



                $result = $input["holiday"];

                $count = 0;

                for ($s = 0; $s < count($result["reason"]); $s++) {



                    $count = $count + count($result["department"][$s]);
                }

                if (isset($existing) && !empty($existing)) {

                    foreach ($existing as $old) {



                        $old_list = explode(',', $old["departments"]);

                        for ($o = 0; $o < count($old_list); $o++) {

                            for ($s = 0; $s < count($result["reason"]); $s++) {

                                for ($t = 0; $t < count($result["department"][$s]); $t++) {



                                    if (date('Y-m-d', strtotime($result["holiday_from"][$s])) == $old["holiday_from"] && date('Y-m-d', strtotime($result["holiday_to"][$s])) == $old["holiday_to"] && $old_list[$o] == $result["department"][$s][$t]) {

                                        //$this->pre_print->viewExit($existing);

                                        goto last;
                                    }
                                }
                            }
                        }
                    }
                }





                for ($s = 0; $s < count($result["reason"]); $s++) {

                    for ($t = 0; $t < count($result["department"][$s]); $t++) {

                        $holi_day = array("reason" => $result["reason"][$s], "holiday_from" => date('Y-m-d', strtotime($result["holiday_from"][$s])),
                            "holiday_to" => date('Y-m-d', strtotime($result["holiday_to"][$s])), "department" => $result["department"][$s][$t]);

                        //$this->pre_print->view($holi_day);

                        $this->holidays_model->insert_holiday($holi_day);
                    }
                }

                //exit;
//                $this->session_messages->add_message('success', 'Holiday(s) added');

                redirect($this->config->item('base_url') . "masters/biometric/public_holidays");

                last:

//                $this->session_messages->add_message('warning', 'Holiday(s) already exist');

                last1:
            }
        }

//        $datam["messages"] = $this->session_messages->view_all_messages();
//        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/add_holiday', $data);

        $this->template->render();
    }

    public function edit_public_holiday($holiday_id) {



        $this->load->model('holidays_model');

        $this->load->model('department_model');

        $data["departments"] = $this->department_model->get_all_department_names_with_status(1);


        $data["holiday"] = $this->holidays_model->get_holiday_details_by_id($holiday_id);


        $data["depts"] = $this->holidays_model->get_group_holidays($data["holiday"]);
//
//        echo'<pre>';
//        print_r($data["depts"]);
//        exit;
        $holiday_list = array();

        if (isset($data["depts"]) && !empty($data["depts"])) {

            foreach ($data["depts"] as $dep) {

                $holiday_list[] = $dep["id"];
            }
        }

        //$this->pre_print->view($data);

        if ($this->input->post('save')) {

            $input = $this->input->post();



            if (isset($input["holiday"]) && !empty($input["holiday"])) {



                $data["post"] = $input["holiday"];



                //$this->pre_print->viewExit($input);
                //echo $data["s_length"];

                foreach ($input["holiday"] as $key => $val) {



                    if ($key == "department") {



                        $rules = "required";



                        $list[] = array(
                            'field' => "holiday[" . $key . "][]",
                            'label' => "Departments",
                            'rules' => $rules
                        );
                    } else {

                        $field_name = ucfirst(str_replace('_', ' ', $key));

                        $rules = "required";



                        $list[] = array(
                            'field' => "holiday[" . $key . "]",
                            'label' => $field_name,
                            'rules' => $rules
                        );
                    }
                }
            }

            //$this->pre_print->viewExit($list);

            $this->form_validation->set_rules($list);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->holidays_model->get_all_holidays_except($holiday_list);

                if (isset($existing) && !empty($existing)) {

                    foreach ($existing as $old) {

                        $old_list = explode(',', $old["departments"]);

                        for ($o = 0; $o < count($old_list); $o++) {

                            for ($i = 0; $i < count($input["holiday"]["department"]); $i++) {



                                if (date('Y-m-d', strtotime($input["holiday"]["holiday_from"])) == $old["holiday_from"] && date('Y-m-d', strtotime($input["holiday"]["holiday_to"])) == $old["holiday_to"] && $old_list[$o] == $input["holiday"]["department"][$i]) {



                                    goto last;
                                }
                            }
                        }
                    }
                }

                if (isset($data["depts"]) && !empty($data["depts"])) {

                    foreach ($data["depts"] as $dep) {

                        $this->holidays_model->delete_holiday_by_id($dep["id"]);
                    }
                }

                for ($i = 0; $i < count($input["holiday"]["department"]); $i++) {

                    $result = array("holiday_from" => date('Y-m-d', strtotime($input["holiday"]["holiday_from"])),
                        "holiday_to" => date('Y-m-d', strtotime($input["holiday"] ["holiday_to"])),
                        "reason" => $input["holiday"]["reason"], "department" => $input["holiday"]["department"][$i]);



                    $new_id = $this->holidays_model->insert_holiday($result);
                }

//                $this->session_messages->add_message('success', 'Holiday updated');

                if (isset($input["page"]))
                    redirect($this->config->item('base_url') . "masters/biometric/view_public_holiday/" . $new_id);
                else
                    redirect($this->config->item('base_url') . "masters/biometric/public_holidays");

                last:

//                $this->session_messages->add_message('warning', 'Holiday(s) already exist');
            }
        }

        //$this->pre_print->viewExit($data);
//        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/edit_holiday', $data);

        $this->template->render();
    }

    public function view_public_holiday($holiday_id) {



        $this->load->model('holidays_model');

        $this->load->model('department_model');

        // $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["holiday"] = $this->holidays_model->get_holiday_details_by_id($holiday_id);

        $data["depts"] = $this->holidays_model->get_group_holidays($data["holiday"]);

        $data["departments"] = array();

        if (isset($data["depts"]) && !empty($data["depts"])) {

            foreach ($data["depts"] as $dep) {

                $data["departments"][] = $dep["name"];
            }
        }

        //$this->pre_print->view($data);
        //  $datam["messages"] = $this->session_messages->view_all_messages();
//        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/view_public_holiday', $data);

        $this->template->render();
    }

    public function delete_public_holiday($holiday_id) {

        $this->load->model('holidays_model');

        $data["holiday"] = $this->holidays_model->get_holiday_details_by_id($holiday_id);

        $data["depts"] = $this->holidays_model->get_group_holidays($data["holiday"]);

        if (isset($data["depts"]) && !empty($data["depts"])) {

            foreach ($data["depts"] as $dep) {

                $this->holidays_model->delete_holiday_by_id($dep["id"]);
            }
        }
        redirect($this->config->item('base_url') . "masters/biometric/public_holidays");
        // $this->session_messages->add_message('error', 'Holiday(s) deleted');
        //  $datam["messages"] = $this->session_messages->view_all_messages();
        // $this->template->write_view('session_msg', 'masters/session_messages', $datam);
    }

    //Settings module

    public function settings() {

        $this->load->model('masters/options_model');

        $this->load->model('masters/temp_data_model');

        $this->load->model('masters/increment_model');

        $this->load->model('masters/user_roles_model');

        $this->load->model('masters/users_model');


        $data = array();

        //$data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());
//        echo "<pre>";
//        print_r($data["roles"]);
//        exit;
        //  $options = array('overtime_wages', 'attendance_threshold', 'saturday_holiday', 'cl_carry_forward', 'sl_carry_forward', 'permission_per_month', 'company_name', 'place', 'district', 'address', 'pincode', 'logo', 'emp_id_prefix', 'emp_id_suffix', 'min_ot_hours', 'ot_threshold', 'ot_division', 'week_starting_day', 'month_starting_date', 'manual_attendance_entry', 'enable_force_break', 'leave_mail_notifications', 'leave_extra_mail_notifications', 'leave_notify_mail', 'wage_slip_mail_notifications', 'wage_slip_extra_mail_notifications', 'wage_slip_mail', 'leave_mail_notification_for_other_appliers', 'enable_earned_leave', 'working_days_for_earned_leave', 'earned_leave_carry_forward', 'company_website', 'company_phone', 'default_number_of_records');
        $options = array('overtime_wages', 'attendance_threshold', 'saturday_holiday', 'permission_per_month', 'company_name', 'place', 'district', 'address', 'pincode', 'logo', 'emp_id_prefix', 'emp_id_suffix', 'min_ot_hours', 'ot_threshold', 'ot_division', 'week_starting_day', 'month_starting_date', 'manual_attendance_entry', 'enable_force_break', 'working_days_for_earned_leave', 'earned_leave_carry_forward', 'company_website', 'company_phone', 'default_number_of_records', 'early_going_threshold_value', 'late_coming_threshold_value', 'Week_end_holidays', 'quater_day_calculation', 'half_day_calculation');

        //$emp_id_prefix = $this->options_model->get_employee_id_prefix();
//        echo "<pre>";
//        print_r($options);
//        exit;

        if ($this->input->post('save')) {



            $input = $this->input->post();

            $data["post"] = $input;
            // echo "<pre>";print_r($input);exit;


            if (isset($input["setting"]) && !empty($input["setting"])) {

                foreach ($input["setting"] as $key => $val) {

                    if ($key == "leave_notify_mail") {

                        if (isset($input["setting"]["leave_extra_mail_notifications"]) && $input["setting"]["leave_extra_mail_notifications"] == 1) {

                            $field_name = "Leave extra notifications email id";

                            $rules = "required";



                            $list[] = array(
                                'field' => "setting[" . $key . "]",
                                'label' => $field_name,
                                'rules' => $rules
                            );
                        }
                    } else if ($key == "wage_slip_mail") {

                        if (isset($input["setting"]["wage_slip_extra_mail_notifications"]) && $input["setting"]["wage_slip_extra_mail_notifications"] == 1) {

                            $field_name = "Wage slip extra notifications email id";

                            $rules = "required";



                            $list[] = array(
                                'field' => "setting[" . $key . "]",
                                'label' => $field_name,
                                'rules' => $rules
                            );
                        }
                    } else if ($key == "working_days_for_earned_leave") {

                        if (isset($input["setting"]["enable_earned_leave"]) && $input["setting"]["enable_earned_leave"] == 1) {

                            $field_name = ucfirst(str_replace('_', ' ', $key));

                            $rules = "required";



                            $list[] = array(
                                'field' => "setting[" . $key . "]",
                                'label' => $field_name,
                                'rules' => $rules
                            );
                        }
                    } else {

                        $field_name = ucfirst(str_replace('_', ' ', $key));

                        $rules = "required";



                        $list[] = array(
                            'field' => "setting[" . $key . "]",
                            'label' => $field_name,
                            'rules' => $rules
                        );
                    }
                }
            }


            // $radio_options = array('saturday_holiday', 'cl_carry_forward', 'sl_carry_forward', 'manual_attendance_entry', 'enable_force_break', 'leave_mail_notifications', 'wage_slip_mail_notifications', 'enable_earned_leave');
            //   $radio_options = array('saturday_holiday', 'manual_attendance_entry');

            $radio_options = ['manual_attendance_entry', 'late_coming_threshold_value', 'early_going_threshold_value', 'quater_day_calculation', 'half_day_calculation'];
            if (isset($input["setting"]["leave_mail_notifications"]) && $input["setting"]["leave_mail_notifications"] == 1) {

                $radio_options [] = 'leave_extra_mail_notifications';

                $radio_options [] = 'leave_mail_notification_for_other_appliers';
            }

            if (isset($input["setting"]["wage_slip_mail_notifications"]) && $input["setting"]["wage_slip_mail_notifications"] == 1)
                $radio_options [] = 'wage_slip_extra_mail_notifications';

            if (isset($input["setting"]["enable_earned_leave"]) && $input["setting"]["enable_earned_leave"] == 1)
                $radio_options[] = 'earned_leave_carry_forward';

            foreach ($radio_options as $val) {

                if (!isset($input["setting"][$val])) {

                    $field_name = ucfirst(str_replace('_', ' ', $val));

                    $rules = "required";



                    $list[] = array(
                        'field' => "setting[" . $val . "]",
                        'label' => $field_name,
                        'rules' => $rules
                    );
                }
            }

            //$this->pre_print->viewExit($list);

            $this->form_validation->set_rules($list);

            if (isset($input["temp"]["file"]) && !empty($input["temp"]["file"])) {

                /* replace [removed] with header */



                $prof_image["prof_image"] = str_replace("[removed]", "data:image/png;base64,", $input["temp"]["file"]);

                $filename = getcwd() . "/attachments/company_logo/" . $_FILES['setting']['name']['logo'];

                /* Check for existance of file name and rename the new image */

                while (file_exists($filename)) {



                    $path_parts = pathinfo($filename);

                    $filename = $path_parts['dirname'] . "/" . $path_parts['filename'] . "1." . $path_parts['extension'];
                }

                $prof_image["name"] = $filename;

                /* Add image date in database and id in session */

                $temp_data = $this->temp_data_model->insert_temp_data(array("key" => "temp", "value" => json_encode($prof_image)));

                // $this->session_view->add_session(null, null, array("temp_data" => $temp_data["id"]));
            }

            if ($this->form_validation->run() != FALSE) {

                //$this->session_messages->add_message('success', 'Company Settings are updated');
                // $opt = array('overtime_wages', 'attendance_threshold', 'saturday_holiday', 'cl_carry_forward', 'sl_carry_forward', 'permission_per_month', 'company_name', 'place', 'district', 'address', 'pincode', 'emp_id_prefix', 'emp_id_suffix', 'min_ot_hours', 'ot_threshold', 'ot_division', 'week_starting_day', 'month_starting_date', 'manual_attendance_entry', 'enable_force_break', 'leave_mail_notifications', 'leave_extra_mail_notifications', 'leave_notify_mail', 'wage_slip_mail_notifications', 'wage_slip_extra_mail_notifications', 'wage_slip_mail', 'leave_mail_notification_for_other_appliers', 'enable_earned_leave', 'working_days_for_earned_leave', 'earned_leave_carry_forward', 'company_website', 'company_phone', 'default_number_of_records');
                $opt = array('overtime_wages', 'attendance_threshold', 'saturday_holiday', 'permission_per_month', 'company_name', 'place', 'district', 'address', 'pincode', 'emp_id_prefix', 'emp_id_suffix', 'min_ot_hours', 'ot_threshold', 'ot_division', 'week_starting_day', 'month_starting_date', 'manual_attendance_entry', 'enable_force_break', 'company_website', 'company_phone', 'default_number_of_records', 'late_coming_threshold_value', 'early_going_threshold_value', 'quater_day_calculation', 'half_day_calculation');

                $this->options_model->delete_options_by_key($opt);



                //$temp_data = $this->session_view->get_session();

                if (isset($temp_data) && !empty($temp_data)):

                    $temp_data = $temp_data["temp_data"];

                    $image_details = $this->temp_data_model->get_temp_data_by_id($temp_data);

                    $image_details = (array) json_decode($image_details[0]["value"]);

                endif;



                //print_r($temp_data);

                if (isset($image_details["name"]) && isset($image_details["prof_image"])) {



                    /* Save data as image */

                    $data1 = $image_details["prof_image"];

                    list($type, $data1) = explode(';', $data1);

                    list(, $data1) = explode(',', $data1);

                    $data1 = base64_decode($data1);

                    file_put_contents($image_details["name"], $data1);





                    $path_parts = pathinfo($image_details["name"]);



                    $this->temp_data_model->delete_temp_data($temp_data);

                    /* Assign image name to users array */

                    $input["setting"]['logo'] = $path_parts['filename'] . "." . $path_parts['extension'];

                    $logo = $this->options_model->get_options_by_type('logo');

                    if (isset($logo) && !empty($logo)) {

                        //$prefix_array = array("key" =>"emp_id_prefix","value"=>$input["setting"]["emp_id_prefix"]);

                        $increment_result = $this->increment_model->update_increment_prefix($input["setting"]["emp_id_prefix"], $input["setting"]["emp_id_suffix"]);

                        $res1 = array("value" => $input["setting"]['logo']);

                        $result = $this->options_model->update_options($logo[0]["id"], $res1);
                    } else {

                        $increment_result = $this->increment_model->update_increment_prefix($input["setting"]["emp_id_prefix"], $input["setting"]["emp_id_suffix"]);

                        $res1 = array("key" => "logo", "value" => $input["setting"]['logo']);

                        $result = $this->options_model->insert_options($res1);
                    }



                    unset($input["setting"]['logo']);
                }

                //$this->pre_print->viewExit($increment_result);

                foreach ($input['setting'] as $key => $val) {

                    if ($key != "emp_id_prefix" && $key != "emp_id_suffix") {

                        if ($key != "Week_end_holidays") {
                            $res = array("key" => $key, "value" => $val);

                            $this->options_model->insert_options($res);
                        }
                    }
                }


                //echo "<pre>";print_r($input);exit;
                if ($input["setting"]["emp_id_prefix"] != "") {
                    $increment_result = $this->increment_model->update_increment_prefix($input["setting"]["emp_id_prefix"], $input["setting"]["emp_id_suffix"]);
                }
                if ($input['setting']['late_coming_threshold_value'] != '') {
                    $get_option = $this->options_model->get_menu_update('late_coming_threshold_value', $input['setting']['late_coming_threshold_value']);
                }

                if ($input['setting']['early_going_threshold_value'] != '') {
                    $get_option = $this->options_model->get_menu_update('early_going_threshold_value', $input['setting']['early_going_threshold_value']);
                }

                if ($input['setting']['Week_end_holidays'] != '') {
                    $week_holidays = implode(',', $input['setting']['Week_end_holidays']);
                    $get_option = $this->options_model->get_menu_update('Week_end_holidays', $week_holidays);
                }


                //$this->session_view->clear_session(null, null);
            }
        }



        $settings = $this->options_model->get_option_by_name($options);


        //$this->pre_print->viewExit($data);

        if (isset($settings) && !empty($settings)) {

            foreach ($settings as $key => $set) {

                /* foreach($set as $key1=>$val1)

                  {



                  //print_r($val1); */

                $data["settings"][$set["key"]] = $set;

                //}
            }
        }

        //Employee _id _ increments

        $last_inc_id = $this->increment_model->get_increment_id('employee');

        if (isset($last_inc_id[0]["last_increment_id"])) {

            $last_inc_id = explode("-", $last_inc_id[0]["last_increment_id"]);

            $data["settings"]['emp_id_prefix']['value'] = $last_inc_id[0];

            $data["settings"]['emp_id_suffix']['value'] = $last_inc_id[1];
        }

        if (isset($last_inc_id[0])) {

            // $last_inc_id = explode("-", $last_inc_id[0]["last_increment_id"]);

            $data["settings"]['emp_id_prefix']['value'] = $last_inc_id[0];

            $data["settings"]['emp_id_suffix']['value'] = $last_inc_id[1];
        }

        // print_r($last_inc_id);
        // $datam["messages"] = $this->session_messages->view_all_messages();
        // $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'settings', $data);
        $this->template->render();
    }

    //education module

    public function educations_list($page = null) {

        $this->load->model('options_model');

        $this->load->model('masters/user_roles_model');



        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["no_of_des"] = $this->options_model->get_options_by_count_type('education_type');

        $result = array();

        $result["total_rows"] = $data["no_of_des"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/educations_list/";

        $result["per_page"] = 10;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $filter = $this->session_view->get_session(null, null);

        $data['educations'] = $this->options_model->get_options_by_limit($result["per_page"], $page, 'education_type', $filter);

        $data["links"] = $this->pagination->create_links();

        $data["start"] = $page;

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/educations_list', $data);



        $this->template->render();
    }

    public function add_education() {

        $this->load->model('options_model');

        $data = array();

        if ($this->input->post('save')) {

            $des = $this->input->post("education");



            if (isset($des) && !empty($des)) {

                foreach ($des as $key => $val) {

                    $rules = "required";



                    $des_rules[] = array(
                        'field' => "education[" . $key . "]",
                        'label' => 'Education',
                        'rules' => $rules
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($des_rules);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->options_model->get_option_by_name('education_type');



                if (isset($existing) && !empty($existing)) {



                    foreach ($existing as $old) {

                        if (strtolower($old["value"]) == strtolower($des["value"])) {

                            goto last;
                        }
                    }
                }

                $des["key"] = "education_type";

                $des_id = $this->options_model->insert_options($des);

                $this->session_messages->add_message('success', 'Education added');

                redirect($this->config->item('base_url') . "masters/educations_list");

                last:

                $this->session_messages->add_message('warning', 'Education already exist');
            }
        }

        //$this->pre_print->viewExit($data);

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/add_education', $data);



        $this->template->render();
    }

    public function edit_education($des_id) {

        $this->load->model('options_model');



        $data["edu"] = $this->options_model->get_options_by_id($des_id);



        if ($this->input->post('save')) {

            $des = $this->input->post("education");



            if (isset($des) && !empty($des)) {

                foreach ($des as $key => $val) {



                    $rules = "required";



                    $des_rules[] = array(
                        'field' => "education[" . $key . "]",
                        'label' => 'Education type',
                        'rules' => $rules
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($des_rules);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->options_model->get_all_options_except($des_id, 'education_type');



                if (isset($existing) && !empty($existing)) {

                    foreach ($existing as $old) {

                        if ($old["value"] == $des["value"]) {

                            goto last;
                        }
                    }
                }

                $des["key"] = "education_type";

                $des_id = $this->options_model->update_options($des_id, $des);

                $this->session_messages->add_message('success', 'Education updated');

                redirect($this->config->item('base_url') . "masters/educations_list");

                last:

                $this->session_messages->add_message('warning', 'Education already exist');
            }
        }

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/edit_education_type', $data);



        $this->template->render();
    }

    public function delete_education($id) {

        $this->load->model('options_model');

        $this->options_model->delete_options_by_id($id);

        $this->session_messages->add_message('error', 'Education deleted');

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);
    }

    public function delete_blood_group($id) {

        $this->load->model('options_model');

        $this->options_model->delete_options_by_id($id);

        $this->session_messages->add_message('error', 'Blood group deleted');

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);
    }

    public function blood_groups($page = null) {

        $this->load->model('options_model');

        $this->load->model('masters/user_roles_model');



        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["no_of_des"] = $this->options_model->get_options_by_count_type('blood_group');

        $result = array();

        $result["total_rows"] = $data["no_of_des"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/blood_groups/";

        $result["per_page"] = 10;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $filter = $this->session_view->get_session(null, null);

        $data['blood_groups'] = $this->options_model->get_options_by_limit($result["per_page"], $page, 'blood_group', $filter);

        $data["links"] = $this->pagination->create_links();

        $data["start"] = $page;

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/blood_groups', $data);



        $this->template->render();
    }

    function add_blood_group() {

        $this->load->model('options_model');

        $data = array();

        if ($this->input->post('save')) {

            $des = $this->input->post("blood");



            if (isset($des) && !empty($des)) {

                foreach ($des as $key => $val) {





                    $rules = "required";



                    $des_rules[] = array(
                        'field' => "blood[" . $key . "]",
                        'label' => 'Blood group',
                        'rules' => $rules
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($des_rules);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->options_model->get_option_by_name('blood_group');



                if (isset($existing) && !empty($existing)) {



                    foreach ($existing as $old) {

                        if (strtolower($old["value"]) == strtolower($des["value"])) {

                            goto last;
                        }
                    }
                }

                $des["key"] = "blood_group";

                $des_id = $this->options_model->insert_options($des);

                $this->session_messages->add_message('success', 'Blood group added');

                redirect($this->config->item('base_url') . "masters/blood_groups");

                last:

                $this->session_messages->add_message('warning', 'Blood group already exist');
            }
        }

        //$this->pre_print->viewExit($data);

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/add_bloodgroup', $data);



        $this->template->render();
    }

    function edit_blood_group($des_id) {

        $this->load->model('options_model');



        $data["blood"] = $this->options_model->get_options_by_id($des_id);



        if ($this->input->post('save')) {

            $des = $this->input->post("blood");



            if (isset($des) && !empty($des)) {

                foreach ($des as $key => $val) {







                    $rules = "required";



                    $des_rules[] = array(
                        'field' => "blood[" . $key . "]",
                        'label' => 'Blood group',
                        'rules' => $rules
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($des_rules);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->options_model->get_all_options_except($des_id, 'blood_group');



                if (isset($existing) && !empty($existing)) {

                    foreach ($existing as $old) {

                        if ($old["value"] == $des["value"]) {

                            goto last;
                        }
                    }
                }

                $des["key"] = "blood_group";

                $des_id = $this->options_model->update_options($des_id, $des);

                $this->session_messages->add_message('success', 'Blood group updated');

                redirect($this->config->item('base_url') . "masters/blood_groups");

                last:

                $this->session_messages->add_message('warning', 'Blood group already exist');
            }
        }

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/edit_blood_group', $data);



        $this->template->render();
    }

    function relations() {

        $this->load->model('options_model');

        $this->load->model('masters/user_roles_model');



        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["no_of_des"] = $this->options_model->get_options_by_count_type('relations');

        $result = array();

        $result["total_rows"] = $data["no_of_des"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/relations/";

        $result["per_page"] = 10;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $filter = $this->session_view->get_session(null, null);

        $data['relations'] = $this->options_model->get_options_by_limit($result["per_page"], $page, 'relations', $filter);

        $data["links"] = $this->pagination->create_links();

        $data["start"] = $page;

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/relations', $data);



        $this->template->render();
    }

    function add_relation() {

        $this->load->model('options_model');

        $data = array();

        if ($this->input->post('save')) {

            $des = $this->input->post("relation");



            if (isset($des) && !empty($des)) {

                foreach ($des as $key => $val) {





                    $rules = "required";



                    $des_rules[] = array(
                        'field' => "relation[" . $key . "]",
                        'label' => 'Relation name',
                        'rules' => $rules
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($des_rules);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->options_model->get_option_by_name('relations');



                if (isset($existing) && !empty($existing)) {



                    foreach ($existing as $old) {

                        if (strtolower($old["value"]) == strtolower($des["value"])) {

                            goto last;
                        }
                    }
                }

                $des["key"] = "relations";

                $des_id = $this->options_model->insert_options($des);

                $this->session_messages->add_message('success', 'Relation added');

                redirect($this->config->item('base_url') . "masters/relations");

                last:

                $this->session_messages->add_message('warning', 'Relation already exist');
            }
        }

        //$this->pre_print->viewExit($data);

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/add_relation', $data);



        $this->template->render();
    }

    function edit_relation($des_id) {

        $this->load->model('options_model');



        $data["relation"] = $this->options_model->get_options_by_id($des_id);



        if ($this->input->post('save')) {

            $des = $this->input->post("relation");



            if (isset($des) && !empty($des)) {

                foreach ($des as $key => $val) {



                    $rules = "required";



                    $des_rules[] = array(
                        'field' => "relation[" . $key . "]",
                        'label' => 'Relation name',
                        'rules' => $rules
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($des_rules);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->options_model->get_all_options_except($des_id, 'relations');



                if (isset($existing) && !empty($existing)) {

                    foreach ($existing as $old) {

                        if (strtolower($old["value"]) == strtolower($des["value"])) {

                            goto last;
                        }
                    }
                }

                $des["key"] = "relations";

                $des_id = $this->options_model->update_options($des_id, $des);

                $this->session_messages->add_message('success', 'Relation updated');

                redirect($this->config->item('base_url') . "masters/relations");

                last:

                $this->session_messages->add_message('warning', 'Relation already exist');
            }
        }

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/edit_relation', $data);



        $this->template->render();
    }

    public function delete_relation($id) {

        $this->load->model('options_model');

        $this->options_model->delete_options_by_id($id);

        $this->session_messages->add_message('error', 'Relation deleted');

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);
    }

    //document module

    function documents() {

        $this->load->model('options_model');

        $this->load->model('masters/user_roles_model');



        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $data["no_of_des"] = $this->options_model->get_options_by_count_type('documents');

        $result = array();

        $result["total_rows"] = $data["no_of_des"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/documents/";

        $result["per_page"] = 10;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $filter = $this->session_view->get_session(null, null);

        $data['documents'] = $this->options_model->get_options_by_limit($result["per_page"], $page, 'documents', $filter);



        $data["links"] = $this->pagination->create_links();

        $data["start"] = $page;

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/documents', $data);



        $this->template->render();
    }

    function add_document() {

        $this->load->model('options_model');

        $data = array();

        if ($this->input->post('save')) {

            $des = $this->input->post("document");

            $data["input"] = $this->input->post("document");

            if (isset($des) && !empty($des)) {

                foreach ($des as $key => $val) {





                    $rules = "required";



                    $des_rules[] = array(
                        'field' => "document[" . $key . "]",
                        'label' => 'Document name',
                        'rules' => $rules
                    );
                }
            }

            //$this->pre_print->viewExit($department);

            $this->form_validation->set_rules($des_rules);

            if ($this->form_validation->run() != FALSE) {

                $existing = $this->options_model->get_option_by_name('documents');



                if (isset($existing) && !empty($existing)) {



                    foreach ($existing as $old) {

                        if (strtolower($old["value"]) == strtolower($des["value"])) {

                            goto last;
                        }
                    }
                }

                $des["key"] = "documents";

                //print_r($des);exit;

                $des_id = $this->options_model->insert_options($des);

                $this->session_messages->add_message('success', 'Documents added');

                redirect($this->config->item('base_url') . "masters/documents");

                last:

                $this->session_messages->add_message('warning', 'Document already exist');
            }
        }

        //$this->pre_print->viewExit($data);

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/add_document', $data);



        $this->template->render();
    }

    function edit_document($des_id) {

        $this->load->model('options_model');



        $data["document"] = $this->options_model->get_options_by_id($des_id);

        if ($data["document"][0]["status"] != 2) {

            if ($this->input->post('save')) {

                $des = $this->input->post("document");



                if (isset($des) && !empty($des)) {

                    foreach ($des as $key => $val) {



                        $rules = "required";



                        $des_rules[] = array(
                            'field' => "document[" . $key . "]",
                            'label' => 'Relation name',
                            'rules' => $rules
                        );
                    }
                }

                //$this->pre_print->viewExit($department);

                $this->form_validation->set_rules($des_rules);

                if ($this->form_validation->run() != FALSE) {

                    $existing = $this->options_model->get_all_options_except($des_id, 'documents');



                    if (isset($existing) && !empty($existing)) {

                        foreach ($existing as $old) {

                            if (strtolower($old["value"]) == strtolower($des["value"])) {

                                goto last;
                            }
                        }
                    }

                    $des["key"] = "documents";

                    $des_id = $this->options_model->update_options($des_id, $des);

                    $this->session_messages->add_message('success', 'Documents updated');

                    redirect($this->config->item('base_url') . "masters/documents");

                    last:

                    $this->session_messages->add_message('warning', 'Document already exist');
                }
            }

            $datam["messages"] = $this->session_messages->view_all_messages();

            $this->template->write_view('session_msg', 'masters/session_messages', $datam);

            $this->template->write_view('content', 'masters/edit_document', $data);



            $this->template->render();
        } else
            echo "Access denied";
    }

    public function delete_document($id) {

        $this->load->model('options_model');

        $this->options_model->delete_options_by_id($id);

        $this->session_messages->add_message('error', 'Document deleted');

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);
    }

    function employee_roles() {



        $this->load->library('update_roles');

        $this->load->model('users_model');

        $this->load->model('department_model');

        $this->load->model('designation_model');

        $this->load->model('masters/user_roles_model');

        $this->load->model('masters/options_model');



        $this->update_roles->update_all();

        $data["default_number_of_records"] = $this->options_model->get_option_by_name('default_number_of_records');



        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $result = array();

        $filter = null;



        if ($this->input->post("go")) {



            $filter = $this->input->post();



            if (isset($filter["go"]))
                unset($filter["go"]);



            $data["no_of_users1"] = $this->users_model->get_filter_user_count($filter, 1);



            $this->session_view->add_session(null, null, $filter);



            redirect($this->config->item('base_url') . "masters/employee_roles/");
        }

        else {

            $filter = $this->session_view->get_session('masters', 'employee_roles');



            if (isset($filter) && !empty($filter)) {

                $data["no_of_users1"] = $this->users_model->get_filter_user_count($filter, 1);
            } else {

                $data["no_of_users1"] = $this->users_model->get_users_count(1);
            }
        }



        if (isset($filter["show_count"]))
            $default = $filter["show_count"];



        else {

            if (isset($data["default_number_of_records"]) && !empty($data["default_number_of_records"]))
                $default = $data["default_number_of_records"][0]["value"];
            else
                $default = 10;
        }

        if (isset($filter["inactive"]))
            $data["status"] = TRUE;

        $result["total_rows"] = $data["no_of_users1"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/employee_roles/";

        $result["per_page"] = $default;

        $data["count"] = $default;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if ($default == "all")
            $data['users'] = $this->users_model->get_users_with_dept($filter, 1);
        else
            $data['users'] = $this->users_model->get_users_with_dept_by_limit($result["per_page"], $page, $filter, 1);

        $data["links1"] = $this->pagination->create_links();

        $data["start"] = $page;

        $data["departments"] = $this->department_model->get_all_departments_by_status(1);

        $data["designations"] = $this->designation_model->get_all_designations();

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/employee_roles', $data);

        $this->template->render();
    }

    function view_roles($user_id) {



        if (!isset($user_id)) {



            redirect($this->config->item('base_url') . "masters/employee_roles/");
        }



        $this->load->model('user_roles_model');

        $this->load->model('user_role_categories_model');

        $this->load->model('user_roles_model');



        $user_permissions = $this->user_roles_model->get_user_role($user_id);

        $data["permissions"] = json_decode($user_permissions[0]["roles"]);

        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $modules = array();

        $allmodules = $this->user_role_categories_model->get_user_role_categories("module");



        $temp = $temp1 = array();



        if (!empty($allmodules)) {

            foreach ($allmodules as $key => $value) {

                $temp = $this->user_role_categories_model->get_user_role_categories("section", $value["id"]);

                if (!empty($temp)) {

                    foreach ($temp as $key1 => $value1) {

                        $temp1 = $this->user_role_categories_model->get_user_role_categories("action", $value1["id"]);

                        if (!empty($temp1)) {

                            foreach ($temp1 as $key2 => $value2) {

                                $modules[$value["value"]][$value1["value"]][$value2["value"]] = $value2["link"];
                            }
                        }
                    }
                }
            }
        }



        $data["modules"] = $modules;

        $data["user_id"] = $user_id;

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/view_roles', $data);

        $this->template->render();
    }

    function edit_roles($user_id) {



        if (!isset($user_id)) {



            redirect($this->config->item('base_url') . "masters/employee_roles/");
        }



        $this->load->model('user_roles_model');

        $this->load->model('user_role_categories_model');

        $this->load->model('user_roles_model');



        $user_permissions = $this->user_roles_model->get_user_role($user_id);

        $data["permissions"] = json_decode($user_permissions[0]["roles"]);



        $modules = array();

        $allmodules = $this->user_role_categories_model->get_user_role_categories("module");



        $temp = $temp1 = array();



        if (!empty($allmodules)) {

            foreach ($allmodules as $key => $value) {

                $temp = $this->user_role_categories_model->get_user_role_categories("section", $value["id"]);

                if (!empty($temp)) {

                    foreach ($temp as $key1 => $value1) {

                        $temp1 = $this->user_role_categories_model->get_user_role_categories("action", $value1["id"]);

                        if (!empty($temp1)) {

                            foreach ($temp1 as $key2 => $value2) {

                                $modules[$value["value"]][$value1["value"]][$value2["value"]] = $value2["link"];
                            }
                        }
                    }
                }
            }
        }



        $data["modules"] = $modules;

        if ($this->input->post("save")) {

            //$this->pre_print->vi
            //$this->pre_print->viewExit($this->input->post("roles"));

            $result = $this->user_roles_model->insert_user_role($user_id, array("roles" => json_encode($this->input->post("roles"))));



            $this->load->model('users_model');

            $userdata = $this->users_model->get_user_by_id($user_id);

            if ($result) {

                $this->session_messages->add_message('success', 'Roles for user <b>' . $userdata[0]["username"] . ' </b>updated');
            } else {



                $this->session_messages->add_message('error', 'There was a problem updating Roles for user <b>' . $userdata[0]["username"] . ' </b>.Try again');
            }

            redirect($this->config->item('base_url') . "masters/employee_roles/");
        }

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/edit_roles', $data);

        $this->template->render();
    }

    function id_card($page = null) {



        $this->load->model('users_model');

        $this->load->model('department_model');

        $this->load->model('designation_model');

        $this->load->model('masters/user_roles_model');

        $this->load->model('masters/options_model');





        $data["default_number_of_records"] = $this->options_model->get_option_by_name('default_number_of_records');



        $data["roles"] = $this->user_roles_model->get_user_role($this->user_auth->get_user_id());

        $result = array();

        $filter = null;



        if ($this->input->post("go")) {



            $filter = $this->input->post();

            //	print_r($filter);exit;



            if (isset($filter["go"]))
                unset($filter["go"]);



            $data["no_of_users1"] = $this->users_model->get_filter_user_count($filter, 1);



            $this->session_view->add_session(null, null, $filter);



            redirect($this->config->item('base_url') . "masters/id_card/");
        }

        else {

            $filter = $this->session_view->get_session(null, null);



            if (isset($filter) && !empty($filter)) {

                $data["no_of_users1"] = $this->users_model->get_filter_user_count($filter, 1);
            } else {

                $data["no_of_users1"] = $this->users_model->get_users_count(1);
            }
        }

        if (isset($filter["show_count"]))
            $default = $filter["show_count"];



        else {

            if (isset($data["default_number_of_records"]) && !empty($data["default_number_of_records"]))
                $default = $data["default_number_of_records"][0]["value"];
            else
                $default = 10;
        }



        if (isset($filter["inactive"]))
            $data["status"] = TRUE;

        //$result['suffix'] = '?show='.$default ;

        $result["total_rows"] = $data["no_of_users1"][0]['count'];

        $result["base_url"] = $this->config->item('base_url') . "masters/id_card/";

        $result["per_page"] = $default;

        $data["count"] = $default;

        $result["num_links"] = 3;

        $result["uri_segment"] = 3;

        $result['full_tag_open'] = '<ul class="tsc_pagination tsc_paginationA tsc_paginationA01">';

        $result['full_tag_close'] = '</ul>';

        $result['prev_link'] = '&lt;';

        $result['prev_tag_open'] = '<li>';

        $result['prev_tag_close'] = '</li>';

        $result['next_link'] = '&gt;';

        $result['next_tag_open'] = '<li>';

        $result['next_tag_close'] = '</li>';

        $result['cur_tag_open'] = '<li class="current"><a href="#">';

        $result['cur_tag_close'] = '</a></li>';

        $result['num_tag_open'] = '<li>';

        $result['num_tag_close'] = '</li>';



        $result['first_tag_open'] = '<li>';

        $result['first_tag_close'] = '</li>';

        $result['last_tag_open'] = '<li>';

        $result['last_tag_close'] = '</li>';



        $result['first_link'] = '&lt;&lt;';

        $result['last_link'] = '&gt;&gt;';

        $this->pagination->initialize($result);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        if ($default == "all")
            $data['users'] = $this->users_model->get_users_with_dept($filter, 1);
        else
            $data['users'] = $this->users_model->get_users_with_dept_by_limit($result["per_page"], $page, $filter, 1);

        $data["links1"] = $this->pagination->create_links();

        $data["start"] = $page;

        //$data["per_page"] = $default;
        //echo $this->db->last_query();

        $data["departments"] = $this->department_model->get_all_departments_by_status(1);

        $data["designations"] = $this->designation_model->get_all_designations();

        //print_r($filter);
        //$this->pre_print->viewExit($data);

        $datam["messages"] = $this->session_messages->view_all_messages();

        $this->template->write_view('session_msg', 'masters/session_messages', $datam);

        $this->template->write_view('content', 'masters/employees_id_card', $data);

        $this->template->render();
    }

    function generate_id_card($user_id) {



        $this->load->model('users_model');



        $this->load->model('address_model');



        $this->load->model('emergency_contacts_model');



        $this->load->model('options_model');



        $data["user_id"] = $user_id;



        $data["user"] = $this->users_model->get_user_by_id($user_id);



        $data["des"] = $this->users_model->get_user_dept_des_by_user_id($user_id);



        $data["user_address"] = $this->address_model->get_address_by_user_id_by_type($user_id, 'permanent');



        $data["contact"] = $this->emergency_contacts_model->get_user_emergency_contacts_by_id($user_id);



        $options = array('company_name', 'address', 'place', 'district', 'pincode', 'company_website', 'logo', 'company_phone');



        $settings = $this->options_model->get_option_by_name($options);



        if (isset($settings) && !empty($settings)) {

            foreach ($settings as $set) {

                $data[$set["key"]] = $set["value"];
            }
        }



        //$this->pre_print->viewExit($data);



        $datam["messages"] = $this->session_messages->view_all_messages();



        $this->template->write_view('session_msg', 'masters/session_messages', $datam);



        $this->template->write_view('content', 'masters/id_card', $data);



        $this->template->render();
    }

    public function addttbsusers_to_biometricusers_table() {
        $this->load->model('masters/users_model');
        $get_all_ttbsusers = $this->users_model->get_all_ttbs_users();
        if (!empty($get_all_ttbsusers)) {
            foreach ($get_all_ttbsusers as $ttbs_user) {
                $ttbs_user_id = $ttbs_user['id'];
                $ttbs_user_firstname = $ttbs_user['nick_name'];
                $ttbs_user_username = $ttbs_user['username'];
                $ttbs_user_password = $ttbs_user['password'];
                $ttbs_user_image = $ttbs_user['admin_image'];
                $ttbs_user_mobile_no = $ttbs_user['mobile_no'];
                $ttbs_user_email_id = $ttbs_user['email_id'];
                $ttbs_user_address = $ttbs_user['address'];
                $ttbs_user_role = $ttbs_user['role'];
                $ttbs_user_signature = $ttbs_user['signature'];
                $ttbs_user_status = $ttbs_user['status'];

                $data['access_id'] = '';
                $data['employee_id'] = '';
                $data['username'] = '';
                $data['password'] = '';
                $data['first_name'] = '';
                $data['last_name'] = '';
                $data['mobile'] = '';
                $data['landline_no'] = '';
                $data['dob'] = '';
                $data['gender'] = '';
                $data['marital_status'] = '';
                $data['religion'] = '';
                $data['image'] = '';
                $data['moved'] = '';
                $data['status'] = '';
                $data['created'] = '';

                // user history table save
                // user shift table save
                // user department and designation save
                // user salary - not recommended (No need)
                // available leave model - check.
            }
        }
    }

}
?>

