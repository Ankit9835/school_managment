<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Application_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }

    public function insertApplication(){

       $page_data = array(
            'applicant_name' => $this->input->post('applicant_name'),
            'vacancy_id' => $this->input->post('vacancy_id'),
            'apply_date' => strtotime($this->input->post('apply_date')),
            'status' => $this->input->post('status')
            );

        $this->db->insert('application', $page_data);

    	 
    }

    public function updateApplication($param2){

        $page_data = array(
            'applicant_name' => $this->input->post('applicant_name'),
            'vacancy_id' => $this->input->post('vacancy_id'),
            'apply_date' => strtotime($this->input->post('apply_date')),
            'status' => $this->input->post('status')
            );

            $this->db->where('application_id', $param2);
            $this->db->update('application', $page_data);


    }

    public function deleteApplication($param2){

        $this->db->where('application_id', $param2);
        $this->db->delete('application');

    }

     


   

}

?>