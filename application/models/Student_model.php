<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Student_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }

    public function insertHouse(){

        $input_data = array(

            'name' => $this->input->post('name'),
            'description' => $this->input->post('description')
           

        );

        $this->db->insert('house', $input_data);

    	 
    }

    public function updateHouse($param2){

         $input_data = array(

            'name' => $this->input->post('name'),
            'description' => $this->input->post('description')
           

        );

        $this->db->where('house_id', $param2);
        $this->db->update('house', $input_data);


    }

    public function deleteHouse($param2){

        $this->db->where('house_id', $param2);
        $this->db->delete('house');

    }

    public function insertStudentCategory(){

        $input_data = array(

            'name' => $this->input->post('name'),
            'description' => $this->input->post('description')
           

        );

        $this->db->insert('student_category', $input_data);

         
    }

    public function updateStudentCategory($param2){

         $input_data = array(

            'name' => $this->input->post('name'),
            'description' => $this->input->post('description')
           

        );

        $this->db->where('student_category_id', $param2);
        $this->db->update('student_category', $input_data);


    }

    public function deleteStudentCategory($param2){

        $this->db->where('student_category_id', $param2);
        $this->db->delete('student_category');

    }

    public function insertStudent(){

        $input_data = array(
            'name'          => html_escape($this->input->post('name')),
            'birthday'      => html_escape($this->input->post('birthday')),
            'age'           => html_escape($this->input->post('age')),
            'place_birth'   => html_escape($this->input->post('place_birth')),
            'sex'           => html_escape($this->input->post('sex')),
            'm_tongue'      => html_escape($this->input->post('m_tongue')),
            'religion'      => html_escape($this->input->post('religion')),
            'blood_group'   => html_escape($this->input->post('blood_group')),
            'address'       => html_escape($this->input->post('address')),
            'city'          => html_escape($this->input->post('city')),
            'state'         => html_escape($this->input->post('state')),
            'nationality'   => html_escape($this->input->post('nationality')),
            'phone'         => html_escape($this->input->post('phone')),
            'email'         => html_escape($this->input->post('email')),
            'ps_attended'   => html_escape($this->input->post('ps_attended')),
            'ps_address'    => html_escape($this->input->post('ps_address')),
            'ps_purpose'    => html_escape($this->input->post('ps_purpose')),
            'class_study'   => html_escape($this->input->post('class_study')),
            'date_of_leaving' => html_escape($this->input->post('date_of_leaving')),
            'am_date'         => html_escape($this->input->post('am_date')),
            'tran_cert'       => html_escape($this->input->post('tran_cert')),
            'dob_cert'        => html_escape($this->input->post('dob_cert')),
            'mark_join'        => html_escape($this->input->post('mark_join')),
            'physical_h'      => html_escape($this->input->post('physical_h')),
            'password'        => sha1($this->input->post('password')),
            'class_id'        => html_escape($this->input->post('class_id')),
            'section_id'      => html_escape($this->input->post('section_id')),
            'parent_id'       => html_escape($this->input->post('parent_id')),
            'roll'            => html_escape($this->input->post('roll')),
            'transport_id'    => html_escape($this->input->post('transport_id')),
            'dormitory_id'    => html_escape($this->input->post('dormitory_id')),
            'house_id'        => html_escape($this->input->post('house_id')),
            'student_category_id' => html_escape($this->input->post('student_category_id')),
            'club_id'             => html_escape($this->input->post('club_id')),
            'session'             => html_escape($this->input->post('session'))
        );

        $this->db->insert('student', $input_data);
        $student_id = $this->db->insert_id();
           
        move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $student_id . '.jpg');


    }

     public function updateStudent($param2){

        $input_data = array(
            'name'          => html_escape($this->input->post('name')),
            'birthday'      => html_escape($this->input->post('birthday')),
            'age'           => html_escape($this->input->post('age')),
            'place_birth'   => html_escape($this->input->post('place_birth')),
            'sex'           => html_escape($this->input->post('sex')),
            'm_tongue'      => html_escape($this->input->post('m_tongue')),
            'religion'      => html_escape($this->input->post('religion')),
            'blood_group'   => html_escape($this->input->post('blood_group')),
            'address'       => html_escape($this->input->post('address')),
            'city'          => html_escape($this->input->post('city')),
            'state'         => html_escape($this->input->post('state')),
            'nationality'   => html_escape($this->input->post('nationality')),
            'phone'         => html_escape($this->input->post('phone')),
            'email'         => html_escape($this->input->post('email')),
            'ps_attended'   => html_escape($this->input->post('ps_attended')),
            'ps_address'    => html_escape($this->input->post('ps_address')),
            'ps_purpose'    => html_escape($this->input->post('ps_purpose')),
            'class_study'   => html_escape($this->input->post('class_study')),
            'date_of_leaving' => html_escape($this->input->post('date_of_leaving')),
            'am_date'         => html_escape($this->input->post('am_date')),
            'tran_cert'       => html_escape($this->input->post('tran_cert')),
            'dob_cert'        => html_escape($this->input->post('dob_cert')),
            'mark_join'        => html_escape($this->input->post('mark_join')),
            'physical_h'      => html_escape($this->input->post('physical_h')),
            'password'        => sha1($this->input->post('password')),
            'class_id'        => html_escape($this->input->post('class_id')),
            'section_id'      => html_escape($this->input->post('section_id')),
            'parent_id'       => html_escape($this->input->post('parent_id')),
           /* 'roll'            => html_escape($this->input->post('roll')),*/
            'transport_id'    => html_escape($this->input->post('transport_id')),
            'dormitory_id'    => html_escape($this->input->post('dormitory_id')),
            'house_id'        => html_escape($this->input->post('house_id')),
            'student_category_id' => html_escape($this->input->post('student_category_id')),
            'club_id'             => html_escape($this->input->post('club_id'))
            /*'session'             => html_escape($this->input->post('session'))*/
        );

        $this->db->where('student_id', $param2);
        $this->db->update('student', $input_data);
         move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/student_image/' . $param2 . '.jpg');


    }

    public function deleteStudent($param2){

        $this->db->where('student_id', $param2);
        $this->db->delete('student');

    }

    public function createStudentBookRequest(){

        $page_data = array(

            'book_id' => $this->input->post('book_id'),
            'student_id' => $this->input->post('student_id'),
            'return_date' => $this->input->post('return_date'),
            'request_date' => $this->input->post('request_date'),
            'status' => 2
        );

        $this->db->insert('book_request',$page_data);


    }

     


   

}

?>