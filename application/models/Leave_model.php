<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Leave_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }


    public function updateLeave($param2){

        $input_data = array(

            'status' => $this->input->post('status')

        );

        $this->db->where('leave_id', $param2);
        $this->db->update('leave', $input_data);


    }

    public function deleteLeave($param2){

        $this->db->where('leave_id', $param2);
        $this->db->delete('leave');

    }

     


   

}

?>