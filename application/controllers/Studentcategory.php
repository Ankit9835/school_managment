<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Studentcategory extends CI_Controller { 

    function __construct() {
        parent::__construct();
                $this->load->database();
                $this->load->library('session');

    }

    public function studentCategory($param1 = '', $param2 = '', $param3 = ''){


	    if ($param1 == 'insert'){

	    $this->student_model->insertStudentCategory();
	    $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
	    redirect(base_url(). 'studentcategory/studentCategory', 'refresh');

	    }


	    if($param1 == 'update'){

	        $this->student_model->updateStudentCategory($param2);
	        $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
	        redirect(base_url(). 'studentcategory/studentCategory', 'refresh');

	    }

	    if($param1 == 'delete'){
	        $this->student_model->deleteStudentCategory($param2);
	        $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
	        redirect(base_url(). 'studentcategory/studentCategory', 'refresh');

	    }

	    $page_data['page_name']         = 'student_category';
	    $page_data['page_title']        = get_phrase('Student Category');
	    $this->load->view('admin/index', $page_data);

    }

}