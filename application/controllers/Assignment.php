<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Assignment extends CI_Controller { 

    function __construct() {
        parent::__construct();
                $this->load->database();
                $this->load->library('session');
               
    }


   public function assignment($param1 = '', $param2 = '', $param3 = ''){


    if ($param1 == 'insert'){

    $this->assignment_model->insertAssignment();
    $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
    redirect(base_url(). 'assignment/assignment', 'refresh');
    }


    if($param1 == 'update'){

        $this->assignment_model->updateAssignment($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
        redirect(base_url(). 'assignment/assignment', 'refresh');

    }

    if($param1 == 'delete'){
        $this->assignment_model->deleteAssignment($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
        redirect(base_url(). 'assignment/assignment', 'refresh');

    }

    $page_data['page_name']         = 'assignment';
    $page_data['page_title']        = get_phrase('Manage Assignment');
    $this->load->view('admin/index', $page_data);

    }

   
}

