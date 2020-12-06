<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Vacancy_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }

    public function insertVacancy(){

        $input_data = array(

            'name' => $this->input->post('name'),
            'number_of_vacancies' => $this->input->post('number_of_vacancies'),
            'last_date' => $this->input->post('last_date')

        );

        $this->db->insert('vacancy', $input_data);

    	 
    }

    public function updateVacancy($param2){

        $input_data = array(

            'name' => $this->input->post('name'),
            'number_of_vacancies' => $this->input->post('number_of_vacancies'),
            'last_date' => $this->input->post('last_date')

        );

        $this->db->where('vacancy_id', $param2);
        $this->db->update('vacancy', $input_data);


    }

    public function deleteVacancy($param2){

        $this->db->where('vacancy_id', $param2);
        $this->db->delete('vacancy');

    }

     


   

}

?>