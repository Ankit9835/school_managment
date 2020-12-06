<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 


class Systemsetting extends CI_Controller {

    function __construct() {
       
        parent::__construct();

		$this->load->database();
        
		$this->load->library('session');
    }

     function system_settings($param1 = '', $param2 = '', $param3 = ''){

        if($param1 == 'do_update'){

        $this->crud_model->update_settings();
        $this->session->set_flashdata('flash_message', get_phrase('Data Updated'));
        redirect(base_url(). 'systemsetting/system_settings', 'refresh');

        }

        if ($param1 == 'upload_logo') {
       $this->crud_model->system_settings();
       $this->session->set_flashdata('flash_message', get_phrase('Logo Uploaded'));
       redirect(base_url() . 'systemsetting/system_settings', 'refresh');
      }

       if ($param1 == 'themeSettings') {
        $this->crud_model->themeSettings();
       $this->session->set_flashdata('flash_message', get_phrase('Logo Uploaded'));
       redirect(base_url() . 'systemsetting/system_settings', 'refresh');
      }

    	$page_data['page_name'] = 'system_settings';
    	$page_data['page_title'] = get_phrase('System Settings');

    	$this->load->view('admin/index', $page_data);
    }

}