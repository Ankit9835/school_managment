<?php if (!defined('BASEPATH')) exit('No direct script access allowed');



class Admin extends CI_Controller { 

    function __construct() {
        parent::__construct();
                $this->load->database();
                $this->load->library('session'); 
                $this->load->model('vacancy_model');
                $this->load->model('application_model');
                $this->load->model('leave_model');
                $this->load->model('award_model');
                $this->load->model('class_model');
                $this->load->model('section_model');
                $this->load->model('academic_model');
                $this->load->model('barcode_model');
                $this->load->library('phpqrcode/Qrlib');

                                   

                
        /*cache control*/
        $this->output->set_header('Last-Modified: ' . gmdate("D, d M Y H:i:s") . ' GMT');
        $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate, post-check=0, pre-check=0');
        $this->output->set_header('Pragma: no-cache');
        $this->output->set_header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
    }

    /**default functin, redirects to login page if no admin logged in yet***/
    public function index() 
    {
    if ($this->session->userdata('admin_login') != 1) redirect(base_url() . 'login', 'refresh');
    if ($this->session->userdata('admin_login') == 1) redirect(base_url() . 'admin/dashboard', 'refresh');
    }
      /************* / default functin, redirects to login page if no admin logged in yet***/

    /*Admin dashboard code to redirect to admin page if successfull login** */
    function dashboard() {
        if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
        $page_data['page_name'] = 'dashboard';
        $page_data['page_title'] = get_phrase('admin_dashboard');
        $this->load->view('admin/index', $page_data);
    }
    /******************* / Admin dashboard code to redirect to admin page if successfull login** */


    function manage_profile($param1 = '', $param2 ='', $param3 =''){
    if ($this->session->userdata('admin_login') != 1) redirect(base_url(), 'refresh');
    if ($param1 == 'update') {


        $data['name']   =   $this->input->post('name');
        $data['email']  =   $this->input->post('email');

        $this->db->where('admin_id', $this->session->userdata('admin_id'));
        $this->db->update('admin', $data);
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $this->session->userdata('admin_id') . 'jpg');
        $this->session->set_flashdata('flash_message', get_phrase('Info Updated'));
        redirect(base_url() . 'admin/manage_profile', 'refresh');
       
    }

    if ($param1 == 'change_password') {

        $data['new_password']           =   sha1($this->input->post('new_password'));
        $data['confirm_new_password']   =   sha1($this->input->post('confirm_new_password'));


        if ($data['new_password'] == $data['confirm_new_password']) {
           
           $this->db->where('admin_id', $this->session->userdata('admin_id'));
           $this->db->update('admin', array('password' => $data['new_password']));
           $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));
        }

        else{
            $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
        }

        redirect(base_url() . 'admin/manage_profile', 'refresh');
       
    }



        $page_data['page_name']     = 'manage_profile';
        $page_data['page_title']    = get_phrase('Manage Profile');
        $page_data['edit_profile']  = $this->db->get_where('admin', array('admin_id' => $this->session->userdata('admin_id')))->result_array();
        $this->load->view('admin/index', $page_data);
    }


    public function enquiry_category($param1 = '', $param2 ='', $param3 =''){

    if($param1 == 'insert'){
   
       $this->crud_model->enquiry_category();
        $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');
    }

    if($param1 == 'update'){

       $this->crud_model->update_category($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');

        }

    if($param1 == 'delete'){

        $this->crud_model->delete_category($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
        redirect(base_url(). 'admin/enquiry_category', 'refresh');

        }

        $page_data['page_name']     = 'enquiry_category';
        $page_data['page_title']    = get_phrase('Manage Category');
        $page_data['enquiry_category']  = $this->db->get('enquiry_category')->result_array();
        $this->load->view('admin/index', $page_data);

    }

    public function list_enquiry($param1 = '', $param2 ='', $param3 =''){


        if($param1 == 'delete'){
            $this->db->where('enquiry_id', $param2);
            $this->db->delete('enquiry');
            $this->session->set_flashdata('flash_message', get_phrase('Data Deleted Succesfully'));
            redirect(base_url(). 'admin/list_enquiry', 'refresh');
        }

        $page_data['page_name'] = 'list_enquiry';
        $page_data['page_title'] = get_phrase('Enquiry List');
        $page_data['select_enquiry'] = $this->db->get('enquiry')->result_array();


        $this->load->view('admin/index', $page_data);

    }

    public function club($param1 = '', $param2 ='', $param3 =''){


        if($param1 == 'insert'){
            $page_data['club_name'] = $this->input->post('club_name');
            $page_data['description'] = $this->input->post('description');
            $page_data['date'] = $this->input->post('date');
            $this->db->insert('club', $page_data);
            $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
            redirect(base_url(). 'admin/club', 'refresh');
        }

        if($param1 == 'update'){
            $page_data['club_name'] = $this->input->post('club_name');
            $page_data['description'] = $this->input->post('description');
            $page_data['date'] = $this->input->post('date');
            $this->db->where('club_id', $param2);
            $this->db->update('club', $page_data);
            $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
            redirect(base_url(). 'admin/club', 'refresh');
        }

        if($param1 == 'delete'){
            $this->db->where('club_id', $param2);
            $this->db->delete('club');
            $this->session->set_flashdata('flash_message', get_phrase('Data Deleted Succesfully'));
            redirect(base_url(). 'admin/club', 'refresh');
        }

        $page_data['page_name'] = 'club';
        $page_data['page_title'] = get_phrase('Manage Club');
        $page_data['select_club'] = $this->db->get('club')->result_array();
        $this->load->view('admin/index', $page_data);

    }

    public function circular($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->crud_model->create_circular();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/circular', 'refresh');

      }

      if($param1 == 'update'){

         $this->crud_model->update_circular($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/circular', 'refresh');

      }

      if($param1 == 'delete'){
            $this->crud_model->delete_circular($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/circular', 'refresh');
      }


        $page_data['page_name'] = 'circular';
        $page_data['page_title'] = get_phrase('Manage Circular');
        $page_data['select_circular'] = $this->db->get('circular')->result_array();
        $this->load->view('admin/index', $page_data);
    }

    public function parent($param1 = '', $param2 = '', $param3 = ''){

            if($param1 == 'insert'){
                $this->crud_model->insert_parent();
                $this->session->set_flashdata('flash_message', 'Data Inserted Successfully');
                redirect(base_url(). 'admin/parent', 'refresh');
            }

            if($param1 == 'update'){
                $this->crud_model->update_parent($param2);
                $this->session->set_flashdata('flash_message', 'Data Updated Successfully');
                redirect(base_url(). 'admin/parent', 'refresh');
            }

            if($param1 == 'delete'){
                $this->crud_model->delete_parent($param2);
                $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
                redirect(base_url(). 'admin/parent', 'refresh');
            }

            $page_data['page_name'] = 'parent';
            $page_data['page_title'] = get_phrase('Manage Parent');
            $page_data['select_parent'] = $this->db->get('parent')->result_array();
            $this->load->view('admin/index', $page_data);

    }


     public function librarian($param1 = '', $param2 = '', $param3 = ''){

            if($param1 == 'insert'){
                $this->crud_model->insert_librarian();
                $this->session->set_flashdata('flash_message', 'Data Inserted Successfully');
                redirect(base_url(). 'admin/librarian', 'refresh');
            }

            if($param1 == 'update'){
                $this->crud_model->update_librarian($param2);
                $this->session->set_flashdata('flash_message', 'Data Updated Successfully');
                redirect(base_url(). 'admin/librarian', 'refresh');
            }

            if($param1 == 'delete'){
                $this->crud_model->delete_librarian($param2);
                $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
                redirect(base_url(). 'admin/librarian', 'refresh');
            }

            $page_data['page_name'] = 'librarian';
            $page_data['page_title'] = get_phrase('Manage Librarian');
            $page_data['select_library'] = $this->db->get('librarian')->result_array();
            /*var_dump($page_data['select_library']);
            die();*/
            $this->load->view('admin/index', $page_data);

    }

     public function accountant($param1 = '', $param2 = '', $param3 = ''){

            if($param1 == 'insert'){
                $this->crud_model->insert_accountant();
                $this->session->set_flashdata('flash_message', 'Data Inserted Successfully');
                redirect(base_url(). 'admin/accountant', 'refresh');
            }

            if($param1 == 'update'){
                $this->crud_model->update_accountant($param2);
                $this->session->set_flashdata('flash_message', 'Data Updated Successfully');
                redirect(base_url(). 'admin/accountant', 'refresh');
            }

            if($param1 == 'delete'){
                $this->crud_model->delete_accountant($param2);
                $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
                redirect(base_url(). 'admin/accountant', 'refresh');
            }

            $page_data['page_name'] = 'accountant';
            $page_data['page_title'] = get_phrase('Manage Accountant');
            $page_data['select_accountant'] = $this->db->get('accountant')->result_array();
            /*var_dump($page_data['select_library']);
            die();*/
            $this->load->view('admin/index', $page_data);

    }

     public function hostel($param1 = '', $param2 = '', $param3 = ''){

            if($param1 == 'insert'){
                $this->crud_model->insert_hostel();
                $this->session->set_flashdata('flash_message', 'Data Inserted Successfully');
                redirect(base_url(). 'admin/hostel', 'refresh');
            }

            if($param1 == 'update'){
                $this->crud_model->update_hostel($param2);
                $this->session->set_flashdata('flash_message', 'Data Updated Successfully');
                redirect(base_url(). 'admin/hostel', 'refresh');
            }

            if($param1 == 'delete'){
                $this->crud_model->delete_hostel($param2);
                $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
                redirect(base_url(). 'admin/hostel', 'refresh');
            }

            $page_data['page_name'] = 'hostel';
            $page_data['page_title'] = get_phrase('Manage Hostel');
            $page_data['select_hostel'] = $this->db->get('hostel')->result_array();
            /*var_dump($page_data['select_library']);
            die();*/
            $this->load->view('admin/index', $page_data);

    }

    public function hrm($param1 = '', $param2 = '', $param3 = ''){

            if($param1 == 'insert'){
                $this->crud_model->insert_hrm();
                $this->session->set_flashdata('flash_message', 'Data Inserted Successfully');
                redirect(base_url(). 'admin/hrm', 'refresh');
            }

            if($param1 == 'update'){
                $this->crud_model->update_hrm($param2);
                $this->session->set_flashdata('flash_message', 'Data Updated Successfully');
                redirect(base_url(). 'admin/hrm', 'refresh');
            }

            if($param1 == 'delete'){
                $this->crud_model->delete_hrm($param2);
                $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
                redirect(base_url(). 'admin/hrm', 'refresh');
            }

            $page_data['page_name'] = 'hrm';
            $page_data['page_title'] = get_phrase('Manage HRM');
            $page_data['select_hrm'] = $this->db->get('hrm')->result_array();
            /*var_dump($page_data['select_library']);
            die();*/
            $this->load->view('admin/index', $page_data);

    }

    public function alumni($param1 = '', $param2 = '', $param3 = ''){

        if($param1 == 'insert'){
            $this->alumni_model->insert_alumni();
            $this->session->set_flashdata('flash_message', 'Data Inserted Successfully');
            redirect(base_url(). 'admin/alumni', 'refresh');
        }

         if($param1 == 'update'){
            $this->alumni_model->update_alumni($param2);
            $this->session->set_flashdata('flash_message', 'Data Inserted Successfully');
            redirect(base_url(). 'admin/alumni', 'refresh');
        }

         if($param1 == 'delete'){
            $this->alumni_model->delete_alumni($param2);
            $this->session->set_flashdata('flash_message', 'Data Inserted Successfully');
            redirect(base_url(). 'admin/alumni', 'refresh');
        }

        $page_data['page_name'] = 'alumni';
        $page_data['page_title'] = get_phrase('Manage Alumni');
        $page_data['select_alumni'] = $this->db->get('alumni')->result_array();

        $this->load->view('admin/index', $page_data);

    }

     public function teacher($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->teacher_model->insertTeacher();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/teacher', 'refresh');

      }

      if($param1 == 'update'){

         $this->teacher_model->updateTeacher($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/teacher', 'refresh');

      }

      if($param1 == 'delete'){
            $this->teacher_model->deleteTeacher($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/teacher', 'refresh');
      }


        $page_data['page_name'] = 'teacher';
        $page_data['page_title'] = get_phrase('Manage Teacher');
        $page_data['select_teacher'] = $this->db->get('teacher')->result_array();
        $this->load->view('admin/index', $page_data);
    }

    function get_designation($department_id = null){

        $designation = $this->db->get_where('designation', array('department_id' => $department_id))->result_array();
        foreach($designation as $key => $row)
        echo '<option value="'.$row['designation_id'].'">' . $row['name'] . '</option>';
    }

    public function vacancy($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->vacancy_model->insertVacancy();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/vacancy', 'refresh');

      }

      if($param1 == 'update'){

         $this->vacancy_model->updateVacancy($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/vacancy', 'refresh');

      }

      if($param1 == 'delete'){
            $this->vacancy_model->deleteVacancy($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/vacancy', 'refresh');
      }


        $page_data['page_name'] = 'vacancy';
        $page_data['page_title'] = get_phrase('Manage Vacancy');
        $page_data['select_vacancy'] = $this->db->get('vacancy')->result_array();
        $this->load->view('admin/index', $page_data);
    }

    public function application($param1 = 'applied', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->application_model->insertApplication();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/application', 'refresh');

      }

      if($param1 == 'update'){

         $this->application_model->updateApplication($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/application', 'refresh');

      }

      if($param1 == 'delete'){
            $this->application_model->deleteApplication($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/application', 'refresh');
      }

      if($param1 != 'applied' && $param1 != 'on_review' && $param1 != 'interviewed' && $param1 != 'offered' && $param1 != 'hired' && $param1 != 'declined')
        $param1 ='applied';

        $page_data['status'] = $param1;
        $page_data['page_name'] = 'application';
        $page_data['page_title'] = get_phrase('Job Applicant');
       // $page_data['select_vacancy'] = $this->db->get('vacancy')->result_array();
        $this->load->view('admin/index', $page_data);
    }

     public function leave($param1 = '', $param2 ='', $param3 =''){

     
      if($param1 == 'update'){

         $this->leave_model->updateLeave($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/leave', 'refresh');

      }

      if($param1 == 'delete'){
            $this->leave_model->deleteLeave($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/leave', 'refresh');
      }


        $page_data['page_name'] = 'leave';
        $page_data['page_title'] = get_phrase('Manage Leave');
        $page_data['select_leave'] = $this->db->get('leave')->result_array();
        $this->load->view('admin/index', $page_data);
    }

     public function award($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->award_model->insertAward();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/award', 'refresh');

      }

      if($param1 == 'update'){

         $this->award_model->updateAward($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/award', 'refresh');

      }

      if($param1 == 'delete'){
            $this->award_model->deleteAward($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/award', 'refresh');
      }

      
        $page_data['page_name'] = 'award';
        $page_data['page_title'] = get_phrase('Manage Award');
       // $page_data['select_vacancy'] = $this->db->get('vacancy')->result_array();
        $this->load->view('admin/index', $page_data);
    }


    public function payroll(){

        $page_data['page_name'] = 'payroll_add';
        $page_data['page_title'] = get_phrase('Add PaySlip');
        $this->load->view('admin/index', $page_data);

    }

     function get_employees($department_id = null)
    {
        $employees = $this->db->get_where('teacher', array('department_id' => $department_id))->result_array();
        foreach($employees as $key => $employees)
            echo '<option value="' . $employees['teacher_id'] . '">' . $employees['name'] . '</option>';
    }

    public function payroll_selector(){

        $department_id = $this->input->post('department_id');
        $employee_id = $this->input->post('employee_id');
        $month = $this->input->post('month');
        $year = $this->input->post('year');

       redirect(base_url() . 'admin/payroll_view/' . $department_id. '/' . $employee_id . '/' . $month . '/' . $year, 'refresh');

    }



    public function payroll_view($department_id = '',$employee_id = '',$month = '',$year = ''){

        $page_data['department_id'] = $department_id;
        $page_data['employee_id'] = $employee_id;
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        
        $page_data['page_name'] = 'payroll_add_view';
        $page_data['page_title'] = get_phrase('Add Payslip');
        $this->load->view('admin/index', $page_data);


    }

    public function create_payroll(){
        
        $this->payroll_model->insertPayrollFunction();
        $this->session->set_flashdata('flash_message', get_phrase('data insert successfully'));
        redirect(base_url() . 'admin/payroll_list/filter2' . $this->input->post('month') . '/' . $this->input->post('year'), 'refresh');

    }

   function payroll_list ($param1 = null, $param2 = null, $param3 = null, $param4 = null){

        if($param1 == 'mark_paid'){
            
            $data['status'] =  1;
            $this->db->update('payroll', $data, array('payroll_id' => $param2));

            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/payroll_list/filter2/'. $param3.'/'. $param4, 'refresh');
        }

        if($param1 == 'filter'){
            $page_data['month'] = $this->input->post('month');
            $page_data['year'] = $this->input->post('year');
        }
        else{
            $page_data['month'] = date('n');
            $page_data['year'] = date('Y');
        }

        if($param1 == 'filter2'){
            
            $page_data['month'] = $param2;
            $page_data['year'] = $param3;
        }


        $page_data['page_name']     = 'payroll_list';
        $page_data['page_title']    = get_phrase('List Payroll');
        $this->load->view('admin/index', $page_data);

    }

    public function classes($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->class_model->insertClass();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/classes', 'refresh');

      }

      if($param1 == 'update'){

         $this->class_model->updateClass($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/classes', 'refresh');

      }

      if($param1 == 'delete'){
            $this->class_model->deleteClass($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/classes', 'refresh');
      }

      
        $page_data['page_name'] = 'class';
        $page_data['page_title'] = get_phrase('Manage Class');
       // $page_data['select_vacancy'] = $this->db->get('vacancy')->result_array();
        $this->load->view('admin/index', $page_data);
    }

    public function section($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->section_model->insertSection();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/section', 'refresh');

      }

      if($param1 == 'update'){

         $this->section_model->updateSection($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/section', 'refresh');

      }

      if($param1 == 'delete'){
            $this->section_model->deleteSection($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/section', 'refresh');
      }

      
        $page_data['page_name'] = 'section';
        $page_data['page_title'] = get_phrase('Manage Section');
       // $page_data['select_vacancy'] = $this->db->get('vacancy')->result_array();
        $this->load->view('admin/index', $page_data);
    }

    public function sections ($class_id = null){

            if($class_id == '')
            $class_id = $this->db->get('class')->first_row()->class_id;
            
            $page_data['page_name']     = 'section';
            $page_data['class_id']      = $class_id;
            $page_data['page_title']    = get_phrase('Manage Section');
            $this->load->view('admin/index', $page_data);

    }

     public function subject($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->subject_model->insertSubject();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/subject', 'refresh');

      }

      if($param1 == 'update'){

         $this->subject_model->updateSubject($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/subject', 'refresh');

      }

      if($param1 == 'delete'){
            $this->subject_model->deleteSubject($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/subject', 'refresh');
      }

      
        $page_data['page_name'] = 'subject';
        $page_data['page_title'] = get_phrase('Manage Subject');
       // $page_data['select_vacancy'] = $this->db->get('vacancy')->result_array();
        $this->load->view('admin/index', $page_data);
    }

     public function class_routine($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->class_routine_model->insertTimeTable();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/listStudentTimeTable', 'refresh');

      }

      if($param1 == 'update'){

         $this->class_routine_model->updateTimeTable($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/listStudentTimeTable', 'refresh');

      }

      if($param1 == 'delete'){
            $this->class_routine_model->deleteTimeTable($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/listStudentTimeTable', 'refresh');
      }

      
       
    }

    public function listStudentTimeTable(){

        $page_data['page_name'] = 'listStudentTimetable';
        $page_data['page_title'] = get_phrase('School TimeTable');
       // $page_data['select_vacancy'] = $this->db->get('vacancy')->result_array();
        $this->load->view('admin/index', $page_data);

    }

    public function class_routine_add(){

        $page_data['page_name'] = 'class_routine_add';
        $page_data['page_title'] = get_phrase('School TimeTable');
        $this->load->view('admin/index', $page_data);


    }

   function get_class_section_subject($class_id){
        $page_data['class_id']  =   $class_id;
        $this->load->view('admin/admin/class_routine_section_subject_selector', $page_data);

    }

    function studentTimetableLoad($class_id){

        $page_data['class_id']  =   $class_id;
        $this->load->view('admin/admin/studentTimetableLoad', $page_data);

    }

    function class_routine_print_view($class_id, $section_id){

        $page_data['class_id']  =   $class_id;
        $page_data['section_id']  =   $section_id;
        $this->load->view('admin/admin/class_routine_print_view', $page_data);

    }

    function section_subject_edit($class_id, $class_routine_id){

        $page_data['class_id'] = $class_id;
        $page_data['class_routine_id'] = $class_routine_id;
        $this->load->view('admin/admin/class_routine_section_subject_edit', $page_data);
    }

     public function dormitory($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->dormitory_model->insertDomitory();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/dormitory', 'refresh');

      }

      if($param1 == 'update'){

         $this->dormitory_model->updateDomitory($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/dormitory', 'refresh');

      }

      if($param1 == 'delete'){
            $this->dormitory_model->deleteDomitory($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/dormitory', 'refresh');
      }

        $page_data['page_name'] = 'dormitory';
        $page_data['page_title'] = get_phrase('Manage Dormitory');
        $this->load->view('admin/index', $page_data);
       
    }


     public function hostel_room($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->dormitory_model->insertHostelRoom();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/hostel_room', 'refresh');

      }

      if($param1 == 'update'){

         $this->dormitory_model->updateHostelRoom($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/hostel_room', 'refresh');

      }

      if($param1 == 'delete'){
            $this->dormitory_model->deleteHostelRoom($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/hostel_room', 'refresh');
      }

       $page_data['page_name'] = 'hostel_room';
       $page_data['page_title'] = get_phrase('Manage Hostel Room');
       $this->load->view('admin/index', $page_data);
      
       
    }


    public function hostel_category($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->dormitory_model->insertHostelCategory();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/hostel_category', 'refresh');

      }

      if($param1 == 'update'){

         $this->dormitory_model->updateHostelCategory($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/hostel_category', 'refresh');

      }

      if($param1 == 'delete'){
            $this->dormitory_model->deleteHostelCategory($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/hostel_category', 'refresh');
      }

       $page_data['page_name'] = 'hostel_category';
       $page_data['page_title'] = get_phrase('Manage Hostel Category');
       $this->load->view('admin/index', $page_data);
      
       
    }

    public function academic_syllabus($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->academic_model->insertAcademic();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/academic_syllabus', 'refresh');

      }

      if($param1 == 'update'){

         $this->academic_model->updateAcademic($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/academic_syllabus', 'refresh');

      }

      if($param1 == 'delete'){
            $this->academic_model->deleteAcademic($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/academic_syllabus', 'refresh');
      }

        $page_data['page_name'] = 'academic_syllabus';
        $page_data['page_title'] = get_phrase('Academic Syllabus');
        $this->load->view('admin/index', $page_data);
       
    }


    function get_class_subject($class_id){

        $subjects = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
        foreach ($subjects as $key => $subject){
            echo '<option value = "'.$subject['subject_id'].'"> '.$subject['name'].' </option>';
        }

    }

   function download_academic_syllabus($academic_syllabus_code){
        $file_name = $this->db->get_where('academic_syllabus', array('academic_syllabus_code' => $academic_syllabus_code))->row()->file_name;
        // Loading download from helper.
        $this->load->helper('download');
        $get_download_content = file_get_contents('uploads/syllabus' . $file_name);
        $name = $file_name;
        force_download($name, $get_download_content);
    }

     function get_academic_syllabus ($class_id = null){

        if($class_id == '')
        $class_id = $this->db->get('class')->first_row()->class_id;
        
        $page_data['page_name']     = 'academic_syllabus';
        $page_data['class_id']      = $class_id;
        $page_data['page_title']    = get_phrase('Academic Syllabus');
        $this->load->view('admin/index', $page_data);

    }


     public function new_student($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->student_model->insertStudent();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'admin/student_information', 'refresh');

      }

      if($param1 == 'update'){

         $this->student_model->updateStudent($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'admin/student_information', 'refresh');

      }

      if($param1 == 'delete'){
            $this->student_model->deleteStudent($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'admin/student_information', 'refresh');
      }

        $page_data['page_name'] = 'new_student';
        $page_data['page_title'] = get_phrase('Manage Student');
        $this->load->view('admin/index', $page_data);
       
    }

    public function student_information(){

        $page_data['page_name'] = 'student_information';
        $page_data['page_title'] = get_phrase('Student Information');
        $this->load->view('admin/index', $page_data);

    }

     function get_class_section($class_id){

        $sections = $this->db->get_where('section', array('class_id' => $class_id))->result_array();

        foreach($sections as $key => $section)
            {
                echo '<option value="'.$section['section_id'].'">'.$section['name'].'</option>';
            }   
     }

     function getStudentClasswise($class_id){

        $page_data['class_id'] = $class_id;
        $this->load->view('admin/admin/showStudentClasswise', $page_data);

     }

     function getStudentIdCard($class_id){

        $page_data['class_id'] = $class_id;
        $this->load->view('admin/admin/showStudentIdcard', $page_data);

     }

     public function edit_student($param2){

        $page_data['student_id'] = $param2;
        $page_data['page_name'] = 'edit_student';
        $page_data['page_title']    = get_phrase('Edit Student');
        $this->load->view('admin/index', $page_data);



     }

     public function resetStudentPassword($student_id){


        $password['password'] = sha1($this->input->post('new_password'));
        $confirm_password['confirm_new_password'] = sha1($this->input->post('confirm_new_password'));

        if($password['password'] == $confirm_password['confirm_new_password']){

            $this->db->where('student_id', $student_id);
            $this->db->update('student', $password);
            $this->session->set_flashdata('flash_message', get_phrase('Password Changed'));

        } else {
             $this->session->set_flashdata('error_message', get_phrase('Type the same password'));
        }
        redirect(base_url(). 'admin/student_information', 'refresh');


     }

     public function manage_attendance($date = null, $month= null, $year = null, $class_id = null, $section_id = null ){
        $active_sms_gateway = $this->db->get_where('sms_settings', array('type' => 'active_sms_gateway'))->row()->info;
        
        if ($_POST) {
    
            // Loop all the students of $class_id
            $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach ($students as $key => $student) {
            $attendance_status = $this->input->post('status_' . $student['student_id']);
            $full_date = $year . "-" . $month . "-" . $date;
            $this->db->where('student_id', $student['student_id']);
            $this->db->where('date', $full_date);
    
            $this->db->update('attendance', array('status' => $attendance_status));
    
                   if ($attendance_status == 2) 
            {
                     if ($active_sms_gateway != '' || $active_sms_gateway != 'disabled') {
                        $student_name   = $this->db->get_where('student' , array('student_id' => $student['student_id']))->row()->name;
                        $parent_id      = $this->db->get_where('student' , array('student_id' => $student['student_id']))->row()->parent_id;
                        $message        = 'Your child' . ' ' . $student_name . 'is absent today.';
                        if($parent_id != null && $parent_id != 0){
                            $recieverPhoneNumber = $this->db->get_where('parent' , array('parent_id' => $parent_id))->row()->phone;
                            if($recieverPhoneNumber != '' || $recieverPhoneNumber != null){
                                $this->sms_model->send_sms($message, $recieverPhoneNumber);
                            }
                            else{
                                $this->session->set_flashdata('error_message' , get_phrase('Parent Phone Not Found'));
                            }
                        }
                        else{
                            $this->session->set_flashdata('error_message' , get_phrase('SMS Gateway Not Found'));
                        }
                    }
           }
        }
    
            $this->session->set_flashdata('flash_message', get_phrase('Updated Successfully'));
            redirect(base_url() . 'admin/manage_attendance/' . $date . '/' . $month . '/' . $year . '/' . $class_id . '/' . $section_id, 'refresh');
        }

        $page_data['date'] = $date;
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['class_id'] = $class_id;
        $page_data['section_id'] = $section_id;
        $page_data['page_name'] = 'manage_attendance';
        $page_data['page_title'] = get_phrase('Manage Attendance');
        $this->load->view('admin/index', $page_data);

    }


     public function attendance_selector(){

        $date = $this->input->post('timestamp');
        $date = date_create($date);
        $date = date_format($date, 'd/m/Y');

        $class_id = $this->input->post('class_id');
        $section_id = $this->input->post('section_id');

        redirect(base_url(). 'admin/manage_attendance/' . $date . '/' . $class_id . '/' . $section_id, 'refresh');

     }


     public function attendance_report($class_id = NULL, $section_id = NULL, $month = NULL, $year = NULL){

        if ($_POST) {
         redirect(base_url() . 'admin/attendance_report/' . $class_id . '/' . $section_id . '/' . $month . '/' . $year, 'refresh');
        }

        $classes = $this->db->get('class')->result_array();
        foreach ($classes as $key => $class) {
            if(isset($class_id) && $class_id == $class['class_id'])
                $class_name = $class['name'];
        }

        $sections = $this->db->get('section')->result_array();
        foreach ($sections as $key => $section) {
            if(isset($section_id) && $section_id == $section['section_id'])
                $section_name = $section['name'];
        }

       
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $page_data['class_id'] = $class_id;
        $page_data['section_id'] = $section_id;

        $page_data['page_name'] = 'attendance_report';
        $page_data['page_title'] = "Attendance Report:" . $class_name . " : Section " . $section_name ;

        $this->load->view('admin/index', $page_data);


     }

     function loadAttendanceReport($class_id, $section_id, $month, $year){

        $page_data['class_id'] = $class_id;
        $page_data['section_id'] = $section_id;
        $page_data['month'] = $month;
        $page_data['year'] = $year;
        $this->load->view('admin/admin/loadAttendanceReport', $page_data);


     }

     public function printAttendanceReport($class_id = null, $section_id = null, $month = null, $year = null){

        $page_data['class_id'] = $class_id;
        $page_data['section_id'] = $section_id;
        $page_data['month'] = $month;
        $page_data['year'] = $year;

        $page_data['page_name'] = 'printAttendanceReport';
        $page_data['page_title'] = "Attendance Report" ;

        $this->load->view('admin/index', $page_data);

     }

     public function examQuestion ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->exam_question_model->createexamQuestion();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/examQuestion', 'refresh');
        }

        if($param1 == 'update'){
            $this->exam_question_model->updateexamQuestion($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/examQuestion', 'refresh');
        }

        if($param1 == 'delete'){
            $this->exam_question_model->deleteexamQuestion($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/examQuestion', 'refresh');
        }

        $page_data['page_name']     = 'examQuestion';
        $page_data['page_title']    = get_phrase('Exam Question');
        $this->load->view('admin/index', $page_data);
    }

    public function create_exam($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->exam_model->createExam();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/create_exam', 'refresh');
        }

        if($param1 == 'update'){
            $this->exam_model->updateExam($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/create_exam', 'refresh');
        }

        if($param1 == 'delete'){
            $this->exam_model->deleteExam($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/create_exam', 'refresh');
        }

        $page_data['page_name']     = 'createExamination';
        $page_data['page_title']    = get_phrase('Manage Exam');
        $this->load->view('admin/index', $page_data);
    }


    public function student_payment($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'single_invoice'){
            $this->student_payment_model->createStudentPayment();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        if($param1 == 'mass_invoice'){
            $this->student_payment_model->createStudentMassPaymentFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        if($param1 == 'update_invoice'){
            $this->student_payment_model->updateStudentPaymentFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

         if($param1 == 'take_payment'){
            $this->student_payment_model->takeNewPaymentFromStudent($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }

        if($param1 == 'delete_invoice'){
            $this->student_payment_model->deleteStudentInvoice($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/student_invoice', 'refresh');
        }


        $page_data['page_name']     = 'student_payment';
        $page_data['page_title']    = get_phrase('Student Payment');
        $this->load->view('admin/index', $page_data);
    }

     function get_class_student($class_id){
        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
            foreach($students as $key => $student)
            {
                echo '<option value="'.$student['student_id'].'">'.$student['name'].'</option>';
            }
    }

    public function get_class_mass_student($class_id){

        $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();

         foreach($students as $key => $student)
        {
            echo '<div class="">
            <label><input type="checkbox" class="check" name="student_id[]" value="' . $student['student_id'] . '">' . '&nbsp;'. $student['name'] .'</label></div>';
        }

        echo '<br><button type ="button" class="btn btn-success btn-sm btn-rounded" onClick="select()">'.get_phrase('Select All').'</button>';
        echo '<button type ="button" class="btn btn-primary btn-sm btn-rounded" onClick="unselect()">'.get_phrase('Unselect All').'</button>';
    }

    public function student_invoice(){

        $page_data['page_name']     = 'student_invoice';
        $page_data['page_title']    = get_phrase('Student Invoice');
        $this->load->view('admin/index', $page_data);

    }

    function publisher ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->library_model->createPublisherFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/publisher', 'refresh');
        }

        if($param1 == 'update'){
            $this->library_model->updatePublisherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/publisher', 'refresh');
        }

        if($param1 == 'delete'){
            $this->library_model->deletePublisherFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/publisher', 'refresh');
        }

        $page_data['page_name']     = 'publisher';
        $page_data['page_title']    = get_phrase('Manage Publisher');
        $this->load->view('admin/index', $page_data);
    }
    /***********  The function below add, update and delete publisher table ends here ***********************/


    /***********  The function below add, update and delete publisher table ***********************/
    function author ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->library_model->createAuthorFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/author', 'refresh');
        }

        if($param1 == 'update'){
            $this->library_model->updateAuthorFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/author', 'refresh');
        }

        if($param1 == 'delete'){
            $this->library_model->deleteAuthorFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/author', 'refresh');
        }

        $page_data['page_name']     = 'author';
        $page_data['page_title']    = get_phrase('Manage Author');
        $this->load->view('admin/index', $page_data);
    }

    /***********  The function below add, update and delete publisher table ends here ***********************/

    /***********  The function below add, update and delete BookCategory table ***********************/
    function book_category ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->library_model->createBookCategoryFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/book_category', 'refresh');
        }

        if($param1 == 'update'){
            $this->library_model->updateBookCategoryFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/book_category', 'refresh');
        }

        if($param1 == 'delete'){
            $this->library_model->deleteBookCategoryFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/book_category', 'refresh');
        }

        $page_data['page_name']     = 'book_category';
        $page_data['page_title']    = get_phrase('Book Category');
        $this->load->view('admin/index', $page_data);
    }
    /***********  The function below add, update and delete BookCategory table ends here ***********************/



    /***********  The function below add, update and delete book table ***********************/
    function book ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'insert'){
            $this->library_model->createBookFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/book', 'refresh');
        }

        if($param1 == 'update'){
            $this->library_model->updateBookFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/book', 'refresh');
        }

        if($param1 == 'delete'){
            $this->library_model->deleteBookFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/book', 'refresh');
        }

        $page_data['page_name']     = 'book';
        $page_data['page_title']    = get_phrase('Manage Library');
        $this->load->view('admin/index', $page_data);
    }

   public function noticeboard ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->event_model->createNoticeboardFunction();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        if($param1 == 'update'){
            $this->event_model->updateNoticeboardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        if($param1 == 'delete'){
            $this->event_model->deleteNoticeboardFunction($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/noticeboard', 'refresh');
        }

        $page_data['page_name']     = 'noticeboard';
        $page_data['page_title']    = get_phrase('School Event');
        $this->load->view('admin/index', $page_data);
    }

     public function manage_language ($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'edit_phrase'){

            $page_data['edit_profile'] = $param2;

        }

        if($param1 == 'add_language'){
            $this->language_model->createNewLanguage();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        if($param1 == 'add_phrase'){
            $this->language_model->createNewLanguagePhrase();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        if($param1 == 'delete_language'){
            $this->language_model->deleteLanguage($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/manage_language', 'refresh');
        }

        $page_data['page_name']     = 'manage_language';
        $page_data['page_title']    = get_phrase('add');
        $this->load->view('admin/index', $page_data);
    }

     function updatePhraseWithAjax(){

        $checker['phrase_id']   =   $this->input->post('phraseId');
        $updater[$this->input->post('currentEditingLanguage')]  =   $this->input->post('updatedValue');

        $this->db->where('phrase_id', $checker['phrase_id'] );
        $this->db->update('language', $updater);

        echo $checker['phrase_id']. ' '. $this->input->post('currentEditingLanguage'). ' '. $this->input->post('updatedValue');

    }

    public function marks ($exam_id = null, $class_id = null, $student_id = null){


        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id'] = $this->input->post('exam_id');
            $page_data['class_id'] = $this->input->post('class_id');
            $page_data['student_id'] = $this->input->post('student_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] && $page_data['student_id']){
                 redirect(base_url(). 'admin/marks/'. $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
            }


        }

        if($this->input->post('operation') == 'update_student_subject_score'){

            $update_subject_first = $this->db->get_where('subject', array('class_id' => $class_id))->result_array();

            foreach ($update_subject_first as $key => $subject) {

               $page_data['class_score1'] = $this->input->post('class_score1_'. $subject['subject_id'] );
               $page_data['class_score2'] = $this->input->post('class_score2_' . $subject['subject_id']);
               $page_data['class_score3'] = $this->input->post('class_score3_' . $subject['subject_id']);
               $page_data['exam_score'] = $this->input->post('exam_score_' . $subject['subject_id']);
               $page_data['comment'] = $this->input->post('comment_' . $subject['subject_id']);

               $this->db->where('mark_id', $this->input->post('mark_id_'. $subject['subject_id']));
               $this->db->update('mark', $page_data);

            }

             $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
            redirect(base_url(). 'admin/marks/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('student_id'), 'refresh');

            

        }

       

        $page_data['exam_id'] = $exam_id;
        $page_data['class_id'] = $class_id;
        $page_data['student_id'] = $student_id;
        $page_data['page_name']     = 'marks';
        $page_data['page_title']    = get_phrase('Student Marks');
        $this->load->view('admin/index', $page_data);
    }


    public function student_marksheet_subject($exam_id = null, $class_id = null, $subject_id = null){


        if($this->input->post('operation') == 'selection'){

            $page_data['exam_id'] = $this->input->post('exam_id');
            $page_data['class_id'] = $this->input->post('class_id');
            $page_data['subject_id'] = $this->input->post('subject_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] && $page_data['subject_id']){
                 redirect(base_url(). 'admin/marks/'. $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['subject_id'], 'refresh');
            }


        }

        if($this->input->post('operation') == 'update_student_subject_score'){

            $update_subject_first = $this->db->get_where('student', array('class_id' => $class_id))->result_array();

            foreach ($update_student_first as $key => $student) {

               $page_data['class_score1'] = $this->input->post('class_score1_'. $student['student_id'] );
               $page_data['class_score2'] = $this->input->post('class_score2_' . $student['student_id']);
               $page_data['class_score3'] = $this->input->post('class_score3_' . $student['student_id']);
               $page_data['exam_score'] = $this->input->post('exam_score_' . $student['student_id']);
               $page_data['comment'] = $this->input->post('comment_' . $student['student_id']);

               $this->db->where('mark_id', $this->input->post('mark_id_'. $student['student_id']));
               $this->db->update('mark', $page_data);

            }

             $this->session->set_flashdata('flash_message', get_phrase('Data Updated Successfully'));
            redirect(base_url(). 'admin/marks/'. $this->input->post('exam_id') .'/' . $this->input->post('class_id') . '/' . $this->input->post('subject_id'), 'refresh');

            

        }

       

        $page_data['exam_id'] = $exam_id;
        $page_data['class_id'] = $class_id;
        $page_data['student_id'] = $student_id;
        $page_data['page_name']     = 'student_marksheet_subject';
        $page_data['page_title']    = get_phrase('Student Marks');
        $this->load->view('admin/index', $page_data);
    }

     public function admin_add($param1 = null, $param2 = null, $param3 = null){

    
        if($param1 == 'insert'){
            
            $this->admin_model->createNewAdministrator();
            $this->session->set_flashdata('flash_message', get_phrase('Data saved successfully'));
            redirect(base_url(). 'admin/admin_add', 'refresh');
        }

        if($param1 == 'update'){
            $this->admin_model->updateAdministrator();
            $this->session->set_flashdata('flash_message', get_phrase('Data updated successfully'));
            redirect(base_url(). 'admin/admin_add', 'refresh');
        }

        if($param1 == 'delete'){
            $this->admin_model->deleteAdministrator($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));
            redirect(base_url(). 'admin/admin_add', 'refresh');
        }

        $page_data['page_name']     = 'newAdministrator';
        $page_data['page_title']    = get_phrase('');
        $this->load->view('admin/index', $page_data);
    }

    public function updateAdminRole($param2){

        $page_data['dashboard'] = $this->input->post('dashboard');
        $page_data['manage_academics'] = $this->input->post('manage_academics');
        $page_data['manage_employee'] = $this->input->post('manage_employee');
        $page_data['manage_student'] = $this->input->post('manage_student');
        $page_data['manage_attendance'] = $this->input->post('manage_attendance');
        $page_data['download_page'] = $this->input->post('download_page');
        $page_data['manage_parent'] = $this->input->post('manage_parent');
        $page_data['manage_alumni'] = $this->input->post('manage_alumni');
        $page_data['manage_loan'] = $this->input->post('manage_loan');
        $page_data['class_information'] = $this->input->post('class_information');
        $page_data['manage_subject'] = $this->input->post('manage_subject');
        $page_data['manage_exam'] = $this->input->post('manage_exam');
        $page_data['report_card'] = $this->input->post('report_card');
        $page_data['fee_collection'] = $this->input->post('fee_collection');
        $page_data['human_resource'] = $this->input->post('human_resource');
        $page_data['expense'] = $this->input->post('expense');
        $page_data['manage_library'] = $this->input->post('manage_library');
        $page_data['hostel_information'] = $this->input->post('hostel_information');
        $page_data['communication'] = $this->input->post('communication');
        $page_data['transport'] = $this->input->post('transport');
        $page_data['system_setting'] = $this->input->post('system_setting');
        $page_data['general_report'] = $this->input->post('general_report');
        $page_data['role_managment'] = $this->input->post('role_managment');

        $this->db->where('admin_id', $param2);
        $this->db->update('admin_role', $page_data);

        $this->session->set_flashdata('flash_message', get_phrase('Data Updated successfully'));
        redirect(base_url(). 'admin/admin_add', 'refresh');

    }

    public function set_language($lang){
        $this->session->set_userdata('language',$lang);
        redirect(base_url(). 'admin','refresh');
        recache();
    }

    public function tabulation_sheet($exam_id = null, $class_id = null, $student_id = null){


         if($this->input->post('operation') == 'selection'){

            $page_data['exam_id'] = $this->input->post('exam_id');
            $page_data['class_id'] = $this->input->post('class_id');
            $page_data['student_id'] = $this->input->post('student_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] && $page_data['student_id']){
                 redirect(base_url(). 'admin/tabulation_sheet/'. $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
            }


        }

       
       

        $page_data['exam_id'] = $exam_id;
        $page_data['class_id'] = $class_id;
        $page_data['student_id'] = $student_id;


        $page_data['page_name']     = 'tabulation_sheet';
        $page_data['page_title']    = get_phrase('Exam Mark Report');
       
        $this->load->view('admin/index', $page_data);

     }

    public function print_mass_report_card($class_id, $exam_id){

        $page_data['exam_id'] = $exam_id;
        $page_data['class_id'] = $class_id;
       

        $page_data['page_name']     = 'print_mass_report_card';
        $page_data['page_title']    = get_phrase('Terminal Report');
       
        $this->load->view('admin/index', $page_data);

     }

     function create_barcode($student_id){

        return $this->barcode_model->create_barcode($student_id);
     }

     public function studentIdentityCard(){

        $page_data['page_name']     = 'studentIdentityCard';
        $page_data['page_title']    = get_phrase('Student Id Card');
       
        $this->load->view('admin/index', $page_data);
     }

     public function websiteSetting($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'generalsetting'){
            $this->crud_model->updateGeneralSettings();

            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));

            redirect(base_url(). 'admin/websiteSetting', 'refresh');
        }

        if($param1 == 'bannersetting'){
            $this->crud_model->bannerSetting();

            $this->session->set_flashdata('flash_message', get_phrase('Data deleted successfully'));

            redirect(base_url(). 'admin/websiteSetting', 'refresh');
        }

        if($param1 == 'testimony'){
             $this->crud_model->testimonySetting($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Updated successfully'));
            redirect(base_url(). 'admin/websiteSetting', 'refresh');
        }

        if($param1 == 'testimony_delete'){
             $this->crud_model->testimonyDelete($param2);
            $this->session->set_flashdata('flash_message', get_phrase('Data Deleted successfully'));
            redirect(base_url(). 'admin/websiteSetting', 'refresh');
        }



         $page_data['page_name']     = 'websiteSetting';
        $page_data['page_title']    = get_phrase('Website Setting');
       
        $this->load->view('admin/index', $page_data);

     }

     public function chatRoomMessage(){

        $page_data['message'] = $this->input->post('chatSend');
        $page_data['user_id'] = $this->input->post('user_id');

        $this->db->insert('general_message',$page_data);
        echo json_encode($page_data);

     }





     


   
}
