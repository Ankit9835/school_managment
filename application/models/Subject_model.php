<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Subject_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }

    public function insertSubject(){

        $input_data = array(

            'name' => $this->input->post('name'),
            'class_id' => $this->input->post('class_id'),
            'teacher_id' => $this->input->post('teacher_id')

        );

        $this->db->insert('subject', $input_data);

    	 
    }

    public function updateSubject($param2){

        $input_data = array(

            'name' => $this->input->post('name'),
            'class_id' => $this->input->post('class_id'),
            'teacher_id' => $this->input->post('teacher_id')

        );

        $this->db->where('subject_id', $param2);
        $this->db->update('subject', $input_data);


    }

    public function deleteSubject($param2){

        $this->db->where('subject_id', $param2);
        $this->db->delete('subject');

    }

     


   

}

?>