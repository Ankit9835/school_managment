
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Subject extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
        		$this->load->library('session');
                $this->load->model('subject_model');		
    }



    public function subject($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->subject_model->insertSubject();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'subject/subject', 'refresh');

      }

      if($param1 == 'update'){

         $this->subject_model->updateSubject($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'subject/subject', 'refresh');

      }

      if($param1 == 'delete'){
            $this->subject_model->deleteSubject($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'subject/subject', 'refresh');
      }

      
        $page_data['page_name'] = 'subject';
        $page_data['page_title'] = get_phrase('Manage Subject');
       // $page_data['select_vacancy'] = $this->db->get('vacancy')->result_array();
        $this->load->view('admin/index', $page_data);
    }

     function getSubjectByClasswise($class_id){

        $page_data['class_id'] = $class_id;
        $this->load->view('admin/admin/displaySubjectClasswise', $page_data);
    }


}