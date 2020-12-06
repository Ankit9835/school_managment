<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Website extends CI_Controller { 

    function __construct() {
        parent::__construct();
               
    }

    public function index(){

    	$page_data['page_name'] = 'index';
    	$page_data['page_title'] = 'Home Page';

        $this->load->view('website/index',$page_data);
    }

    public function about(){

    	$page_data['page_title'] = 'About Page';
        $this->load->view('website/about',$page_data);
    }

     public function teacher(){

    	$page_data['page_title'] = 'Teacher Page';
        $this->load->view('website/teacher',$page_data);
    }

     public function contact(){

    	$page_data['page_title'] = 'Contact Page';
        $this->load->view('website/contact',$page_data);
    }

    


}