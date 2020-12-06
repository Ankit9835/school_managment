<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Login_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->model('crud_model');
        $this->load->database();
        $this->load->library('session');
		
    }



    public function loginFunctionForAllUsers(){

    	$email = html_escape($this->input->post('email'));
        
    	$password = html_escape($this->input->post('password'));

    	$data = array(
    		'email' => $email,
    		'password' => sha1($password)
    	);

    	$query = $this->db->get_where('admin', $data);

    	if($query->num_rows() > 0){
    		$row = $query->row();

    		
            $this->session->set_userdata('login_type', 'admin');
            
    		$this->session->set_userdata('admin_login', '1');

    		$this->session->set_userdata('admin_id', $row->admin_id);

    		$this->session->set_userdata('login_user_id', $row->admin_id);
    		$this->session->set_userdata('name', $row->name);

            return $this->db->set('login_status', ('1'))
                    ->where('admin_id', $this->session->userdata('admin_id'))
                    ->update('admin');

    		
    	}

        $query = $this->db->get_where('hrm', $data);

        if($query->num_rows() > 0){
            $row = $query->row();

            
            $this->session->set_userdata('login_type', 'hrm');
            
            $this->session->set_userdata('hrm_login', '1');

            $this->session->set_userdata('hrm_id', $row->hrm_id);

            $this->session->set_userdata('login_user_id', $row->hrm_id);
            $this->session->set_userdata('name', $row->name);

            return $this->db->set('login_status', ('1'))
                    ->where('hrm_id', $this->session->userdata('hrm_id'))
                    ->update('hrm');

            
        }

        $query = $this->db->get_where('hostel', $data);

        if($query->num_rows() > 0){
            $row = $query->row();

            
            $this->session->set_userdata('login_type', 'hostel');
            
            $this->session->set_userdata('hostel_login', '1');

            $this->session->set_userdata('hostel_id', $row->hostel_id);

            $this->session->set_userdata('login_user_id', $row->hostel_id);
            $this->session->set_userdata('name', $row->name);

            return $this->db->set('login_status', ('1'))
                    ->where('hostel_id', $this->session->userdata('hostel_id'))
                    ->update('hostel');

            
        }

         $query = $this->db->get_where('accountant', $data);

        if($query->num_rows() > 0){
            $row = $query->row();

            
            $this->session->set_userdata('login_type', 'accountant');
            
            $this->session->set_userdata('accountant_login', '1');

            $this->session->set_userdata('accountant_id', $row->accountant_id);

            $this->session->set_userdata('login_user_id', $row->accountant_id);
            $this->session->set_userdata('name', $row->name);

            return $this->db->set('login_status', ('1'))
                    ->where('accountant_id', $this->session->userdata('accountant_id'))
                    ->update('accountant');

            
        }

        $query = $this->db->get_where('librarian', $data);

        if($query->num_rows() > 0){
            $row = $query->row();

            
            $this->session->set_userdata('login_type', 'librarian');
            
            $this->session->set_userdata('librarian_login', '1');

            $this->session->set_userdata('librarian_id', $row->librarian_id);

            $this->session->set_userdata('login_user_id', $row->librarian_id);
            $this->session->set_userdata('name', $row->name);

            return $this->db->set('login_status', ('1'))
                    ->where('librarian_id', $this->session->userdata('librarian_id'))
                    ->update('librarian');

            
        }


        $query = $this->db->get_where('teacher', $data);

        if($query->num_rows() > 0){
            $row = $query->row();

            
            $this->session->set_userdata('login_type', 'teacher');
            
            $this->session->set_userdata('teacher_login', '1');

            $this->session->set_userdata('teacher_id', $row->teacher_id);

            $this->session->set_userdata('login_user_id', $row->teacher_id);
            $this->session->set_userdata('name', $row->name);

            return $this->db->set('login_status', ('1'))
                    ->where('teacher_id', $this->session->userdata('teacher_id'))
                    ->update('teacher');

            
        }

         $query = $this->db->get_where('student', $data);

        if($query->num_rows() > 0){
            $row = $query->row();

            
            $this->session->set_userdata('login_type', 'student');
            
            $this->session->set_userdata('student_login', '1');

            $this->session->set_userdata('student_id', $row->student_id);

            $this->session->set_userdata('login_user_id', $row->student_id);
            $this->session->set_userdata('name', $row->name);

            return $this->db->set('login_status', ('1'))
                    ->where('student_id', $this->session->userdata('student_id'))
                    ->update('student');

            
        }

         $query = $this->db->get_where('parent', $data);

        if($query->num_rows() > 0){
            $row = $query->row();

            
            $this->session->set_userdata('login_type', 'parent');
            
            $this->session->set_userdata('parent_login', '1');

            $this->session->set_userdata('parent_id', $row->parent_id);

            $this->session->set_userdata('login_user_id', $row->parent_id);
            $this->session->set_userdata('name', $row->name);

            return $this->db->set('login_status', ('1'))
                    ->where('parent_id', $this->session->userdata('parent_id'))
                    ->update('parent');

            
        }
    	

    	

    }

    public function logout_user_status(){

        return $this->db->set('login_status', ('0'))
                    ->where('admin_id', $this->session->userdata('admin_id'))
                    ->update('admin');

    }

    public function logout_hrm_status(){
          return $this->db->set('login_status', ('0'))
                    ->where('hrm_id', $this->session->userdata('hrm_id'))
                    ->update('hrm');
    }

    public function logout_hostel_status(){
          return $this->db->set('login_status', ('0'))
                    ->where('hostel_id', $this->session->userdata('hostel_id'))
                    ->update('hostel');
    }

    public function logout_accountant_status(){
        
          return $this->db->set('login_status', ('0'))
                    ->where('accountant_id', $this->session->userdata('accountant_id'))
                    ->update('accountant');
    }

    public function logout_librarian_status(){
          return $this->db->set('login_status', ('0'))
                    ->where('librarian_id', $this->session->userdata('librarian_id'))
                    ->update('librarian');
    }

    public function logout_teacher_status(){
          return $this->db->set('login_status', ('0'))
                    ->where('teacher_id', $this->session->userdata('teacher_id'))
                    ->update('teacher');
    }

    public function logout_student_status(){
          return $this->db->set('login_status', ('0'))
                    ->where('student_id', $this->session->userdata('student_id'))
                    ->update('student');
    }

    public function logout_parent_status(){
          return $this->db->set('login_status', ('0'))
                    ->where('parent_id', $this->session->userdata('parent_id'))
                    ->update('parent');
    }






}

?>