<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Class_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }

    public function insertClass(){

        $input_data = array(

            'name' => $this->input->post('name'),
            'name_numeric' => $this->input->post('name_numeric'),
            'teacher_id' => $this->input->post('teacher_id')

        );

        $this->db->insert('class', $input_data);

    	 
    }

    public function updateClass($param2){

        $input_data = array(

            'name' => $this->input->post('name'),
            'name_numeric' => $this->input->post('name_numeric'),
            'teacher_id' => $this->input->post('teacher_id')

        );

        $this->db->where('class_id', $param2);
        $this->db->update('class', $input_data);


    }

    public function deleteClass($param2){

        $this->db->where('class_id', $param2);
        $this->db->delete('class');

    }

     


   

}

?>