<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Section_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }

    public function insertSection(){

        $input_data = array(

            'name' => $this->input->post('name'),
            'nick_name' => $this->input->post('nick_name'),
            'class_id' => $this->input->post('class_id'),
            'teacher_id' => $this->input->post('teacher_id')

        );

        $this->db->insert('section', $input_data);

    	 
    }

    public function updateSection($param2){

        $input_data = array(

            'name' => $this->input->post('name'),
            'nick_name' => $this->input->post('nick_name'),
            'class_id' => $this->input->post('class_id'),
            'teacher_id' => $this->input->post('teacher_id')

        );

        $this->db->where('section_id', $param2);
        $this->db->update('section', $input_data);


    }

    public function deleteSection($param2){

        $this->db->where('section_id', $param2);
        $this->db->delete('section');

    }

     


   

}

?>