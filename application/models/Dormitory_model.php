<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Dormitory_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }

    public function insertDomitory(){

         $input_data = array(
            'name'                  => html_escape($this->input->post('name')),
            'hostel_room_id'        => html_escape($this->input->post('hostel_room_id')),
            'hostel_category_id'    => html_escape($this->input->post('hostel_category_id')),
            'capacity'              => html_escape($this->input->post('capacity')),
            'address'               => html_escape($this->input->post('address')),
            'description'            => html_escape($this->input->post('description'))
        );

        $this->db->insert('dormitory', $input_data);

    	 
    }

    public function updateDomitory($param2){

        $input_data = array(
            'name'                  => html_escape($this->input->post('name')),
            'hostel_room_id'        => html_escape($this->input->post('hostel_room_id')),
            'hostel_category_id'    => html_escape($this->input->post('hostel_category_id')),
            'capacity'              => html_escape($this->input->post('capacity')),
            'address'               => html_escape($this->input->post('address')),
            'description'            => html_escape($this->input->post('description'))
        );

        $this->db->where('dormitory_id', $param2);
        $this->db->update('dormitory', $input_data);


    }

    public function deleteDomitory($param2){

        $this->db->where('dormitory_id', $param2);
        $this->db->delete('dormitory');

    }


    public function insertHostelCategory(){

         $input_data = array(
            'name'               => html_escape($this->input->post('name')),
            'description'        => html_escape($this->input->post('description'))
        );

        $this->db->insert('hostel_category', $input_data);

         
    }

    public function updateHostelCategory($param2){

        $input_data = array(
            'name'               => html_escape($this->input->post('name')),
            'description'        => html_escape($this->input->post('description'))
        );

        $this->db->where('hostel_category_id', $param2);
        $this->db->update('hostel_category', $input_data);


    }

    public function deleteHostelCategory($param2){

        $this->db->where('hostel_category_id', $param2);
        $this->db->delete('hostel_category');

    }

    public function insertHostelRoom(){

        $input_data = array(
                'name'                  => html_escape($this->input->post('name')),
                'room_type'             => html_escape($this->input->post('room_type')),
                'num_bed'               => html_escape($this->input->post('num_bed')),
                'cost_bed'              => html_escape($this->input->post('cost_bed')),
                'description'            => html_escape($this->input->post('description'))
        );

        $this->db->insert('hostel_room', $input_data);

         
    }

    public function updateHostelRoom($param2){

         $input_data = array(
                'name'                  => html_escape($this->input->post('name')),
                'room_type'             => html_escape($this->input->post('room_type')),
                'num_bed'               => html_escape($this->input->post('num_bed')),
                'cost_bed'              => html_escape($this->input->post('cost_bed')),
                'description'            => html_escape($this->input->post('description'))
        );

        $this->db->where('hostel_room_id', $param2);
        $this->db->update('hostel_room', $input_data);


    }

    public function deleteHostelRoom($param2){

        $this->db->where('hostel_room_id', $param2);
        $this->db->delete('hostel_room');

    }


     


   

}

?>