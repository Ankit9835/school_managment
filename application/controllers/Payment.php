<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 


class Payment extends CI_Controller {

    function __construct() {
       
        parent::__construct();

		$this->load->database();
        
		$this->load->library('session');
    }

    public function paymentSetting($param1 = '', $param2 = '', $param3 = ''){

        if($this->session->userdata('admin_login') != 1)
            redirect(base_url() . 'login', 'refresh'); 

        if($param1 == 'update'){

        $this->crud_model->stripe_settings();
        $this->crud_model->paypal_settings();
        $this->session->set_flashdata('flash_message', get_phrase('Data Updated'));
        redirect(base_url(). 'payment/paymentSetting', 'refresh');

        }

       

    	$page_data['page_name'] = 'payment_settings';
    	$page_data['page_title'] = get_phrase('Payment Settings');

    	$this->load->view('admin/index', $page_data);
    }

}