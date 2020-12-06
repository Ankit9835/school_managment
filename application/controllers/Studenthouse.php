<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Studenthouse extends CI_Controller { 

    function __construct() {
        parent::__construct();
                $this->load->database();
                $this->load->library('session');

    }

    public function studentHouse($param1 = '', $param2 = '', $param3 = ''){


	    if ($param1 == 'insert'){

	    $this->student_model->insertHouse();
	    $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
	    redirect(base_url(). 'studenthouse/studentHouse', 'refresh');
	    }


	    if($param1 == 'update'){

	        $this->student_model->updateHouse($param2);
	        $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
	       redirect(base_url(). 'studenthouse/studentHouse', 'refresh');

	    }

	    if($param1 == 'delete'){
	        $this->student_model->deleteHouse($param2);
	        $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
	        redirect(base_url(). 'studenthouse/studentHouse', 'refresh');

	    }

	    $page_data['page_name']         = 'house';
	    $page_data['page_title']        = get_phrase('Academic House');
	    $this->load->view('admin/index', $page_data);

    }


}