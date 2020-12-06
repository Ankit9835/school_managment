<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Activity extends CI_Controller { 

    function __construct() {
        parent::__construct();
                $this->load->database();
                $this->load->library('session');
    }


   public function clubActivity($param1 = '', $param2 = '', $param3 = ''){


    if ($param1 == 'insert'){

    $this->activity_model->insertActivity();
    $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
    redirect(base_url(). 'activity/clubActivity', 'refresh');
    }


    if($param1 == 'update'){

        $this->activity_model->updateActivity($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
        redirect(base_url(). 'activity/clubActivity', 'refresh');

    }

    if($param1 == 'delete'){
        $this->activity_model->deleteActivity($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
        redirect(base_url(). 'activity/clubActivity', 'refresh');

    }

    $page_data['page_name']         = 'activity';
    $page_data['page_title']        = get_phrase('Club Activity');
    $this->load->view('admin/index', $page_data);

    }

    
}

