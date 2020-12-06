
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Report extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
        		$this->load->library('session');		
    }



    public function studentReport ($param1 = null, $param2 = null, $param3 = null){

            

        $page_data['page_name']     = 'report';
        $page_data['page_title']    = get_phrase('Manage Student Report');
       
        $this->load->view('admin/index', $page_data);

    }


     public function examMarkReport($exam_id = null, $class_id = null, $student_id = null){


         if($this->input->post('operation') == 'selection'){

            $page_data['exam_id'] = $this->input->post('exam_id');
            $page_data['class_id'] = $this->input->post('class_id');
            $page_data['student_id'] = $this->input->post('student_id');

            if($page_data['exam_id'] > 0 && $page_data['class_id'] && $page_data['student_id']){
                 redirect(base_url(). 'report/examMarkReport/'. $page_data['exam_id'] . '/' . $page_data['class_id'] . '/' . $page_data['student_id'], 'refresh');
            }


        }

       
       

        $page_data['exam_id'] = $exam_id;
        $page_data['class_id'] = $class_id;
        $page_data['student_id'] = $student_id;


        $page_data['page_name']     = 'examMarkReport';
        $page_data['page_title']    = get_phrase('Exam Mark Report');
       
        $this->load->view('admin/index', $page_data);

     }

      

}