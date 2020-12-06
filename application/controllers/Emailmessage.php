
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Emailmessage extends CI_Controller { 

    function __construct() {
        parent::__construct();
        		$this->load->database();
        		$this->load->library('session');		
    }


    public function sendEmailMessage($param1 = null, $param2 = null, $param3 = null){

        if($param1 == 'create'){
            $this->send_email_message_model->sendMessageEmail();
            $this->session->set_flashdata('flash_message', get_phrase('Email sent successfully'));
            redirect(base_url(). 'emailmessage/sendEmailMessage', 'refresh');
        }

        $page_data['page_name']     = 'sendEmailMessage';
        $page_data['page_title']    = get_phrase('Manage Email Message');
        $this->load->view('admin/index', $page_data);

    }
    
        


}