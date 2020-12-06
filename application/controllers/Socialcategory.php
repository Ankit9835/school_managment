<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Socialcategory extends CI_Controller { 

    function __construct() {
        parent::__construct();
                $this->load->database();
                $this->load->library('session');
                $this->load->model('social_model');
    }


   public function socialCategory($param1 = '', $param2 = '', $param3 = ''){


    if ($param1 == 'insert'){

    $this->social_model->insertSocialCategory();
    $this->session->set_flashdata('flash_message', get_phrase('Data successfully saved'));
    redirect(base_url(). 'socialcategory/socialCategory', 'refresh');
    }


    if($param1 == 'update'){

        $this->social_model->updateSocialCategory($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data successfully updated'));
        redirect(base_url(). 'socialcategory/socialCategory', 'refresh');

    }

    if($param1 == 'delete'){
        $this->social_model->deleteSocialCategory($param2);
        $this->session->set_flashdata('flash_message', get_phrase('Data successfully deleted'));
        redirect(base_url(). 'socialcategory/socialCategory', 'refresh');

    }

    $page_data['page_name']         = 'social_category';
    $page_data['page_title']        = get_phrase('Social Category');
    $this->load->view('admin/index', $page_data);

    }

   
}

