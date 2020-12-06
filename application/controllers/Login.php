<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 


class Login extends CI_Controller {

    function __construct() {
        parent::__construct();
        

		$this->load->model('login_model');
		//$this->load->library('session');
    }


    public function index() {

    if($this->session->userdata('admin_login') == 1) redirect(base_url().'admin/dashboard', 'refresh');

     if ($this->session->userdata('hrm_login')== 1) redirect (base_url(). 'hrm/dashboard'); 

    if ($this->session->userdata('hostel_login')== 1) redirect (base_url(). 'hostel/dashboard');

    if ($this->session->userdata('accountant_login')== 1) redirect (base_url(). 'accountant/dashboard');

    	$this->load->view('admin/login2');
    }

    public function check_login(){
        
       
    	 $login_check_model = $this->login_model->loginFunctionForAllUsers();
       
        $login_user = $this->session->userdata('login_type');
        if(!$login_check_model){
          // Here, if the above conditions are not meant, the user will be redirected to login page again.
          $this->session->set_flashdata('error_message', get_phrase('Wrong email or password'));
          redirect(base_url() . 'login', 'refresh');
        }
        if($login_user == 'admin') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'admin/dashboard', 'refresh');
        }

        if($login_user == 'hrm') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'hrm/dashboard', 'refresh');
        }

        if($login_user == 'hostel') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'hostel/dashboard', 'refresh');
        }

        if($login_user == 'accountant') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'accountant/dashboard', 'refresh');
        }

        if($login_user == 'librarian') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'librarian/dashboard', 'refresh');
        }

        if($login_user == 'teacher') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'teacher/dashboard', 'refresh');
        }

         if($login_user == 'student') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'student/dashboard', 'refresh');
        }

        if($login_user == 'parent') {
          $this->session->set_flashdata('flash_message', get_phrase('Successfully Login'));
          redirect(base_url() . 'parents/dashboard', 'refresh');
        }



    }

    public function logout(){

        $login_user = $this->session->userdata('login_type');
       if($login_user == 'admin'){
          $this->login_model->logout_user_status();
      }
      if($login_user == 'hrm'){
        $this->login_model->logout_hrm_status();
      }
      if($login_user == 'hostel'){
        $this->login_model->logout_hostel_status();
      }
      if($login_user == 'accountant'){
        $this->login_model->logout_accountant_status();
      }
      if($login_user == 'librarian'){
        $this->login_model->logout_librarian_status();
      }
      if($login_user == 'teacher'){
        $this->login_model->logout_teacher_status();
      }
      if($login_user == 'student'){
        $this->login_model->logout_student_status();
      }
      if($login_user == 'parent'){
        $this->login_model->logout_parent_status();
      }

        $this->session->sess_destroy();
        redirect(base_url(). 'login', 'refresh');
    }

   

    
}

?>
