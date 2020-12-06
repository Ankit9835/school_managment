<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Admin_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }

    public function createNewAdministrator(){

        $input_data = array(

            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'password' => sha1($this->input->post('password')),
            'level' => $this->input->post('level')

        );

        $this->db->insert('admin', $input_data);
        $admin_image = $this->db->insert_id();

         move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/admin_image/' . $admin_image . '.jpg');  
        

    	 
    }

    public function updateAdministrator($param2){

       $input_data = array(

            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'password' => sha1($this->input->post('password')),
            'level' => $this->input->post('level')

        );

        $this->db->where('admin_id', $param2);
        $this->db->update('admin', $input_data);


    }

    public function deleteAdministrator($param2){

        $this->db->where('admin_id', $param2);
        $this->db->delete('admin');

    }

     


   

}

?>