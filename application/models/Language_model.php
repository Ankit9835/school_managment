<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Language_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }

    public function createNewLanguage(){

       $language = $this->input->post('language');
       $this->load->dbforge();

       $fields = array(

            $language => array('type' => 'LONGTEXT')

       );

       $this->dbforge->add_column('language', $fields); 

    	 
    }

    public function createNewLanguagePhrase(){

        $page_data['phrase'] = $this->input->post('phrase');
        $this->db->insert('language', $page_data);


    }

    public function deleteLanguage($param2){

       $language = $param2;

       $this->load->dbforge();
       $this->dbforge->drop_column('language', $language);

    }

     


   

}

?>