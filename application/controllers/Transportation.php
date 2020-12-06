
<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Transportation extends CI_Controller { 

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('session');
        $this->load->model('transpotation_model');  
        				
    }



    public function transport($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->transpotation_model->insertTransport();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'transportation/transport', 'refresh');

      }

      if($param1 == 'update'){

         $this->transpotation_model->updateTransport($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'transportation/transport', 'refresh');

      }

      if($param1 == 'delete'){
            $this->transpotation_model->deleteTransport($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'transportation/transport', 'refresh');
      }

      
        $page_data['page_name'] = 'transport';
        $page_data['page_title'] = get_phrase('Manage Transport');
       // $page_data['select_vacancy'] = $this->db->get('vacancy')->result_array();
        $this->load->view('admin/index', $page_data);
    }

    public function transport_route($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->transpotation_model->insertTransportRoute();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'transportation/transport_route', 'refresh');

      }

      if($param1 == 'update'){

         $this->transpotation_model->updateTransportRoute($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
          redirect(base_url(). 'transportaion/transport_route', 'refresh');

      }

      if($param1 == 'delete'){
            $this->transpotation_model->deleteTransportRoute($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
          redirect(base_url(). 'transportation/transport_route', 'refresh');
          
      }

      
        $page_data['page_name'] = 'transport_route';
        $page_data['page_title'] = get_phrase('Manage Transport Route');
        $this->load->view('admin/index', $page_data);
    }

    public function vehicle($param1 = '', $param2 ='', $param3 =''){

      if($param1 == 'insert'){

        $this->transpotation_model->insertVehicle();
        $this->session->set_flashdata('flash_message', 'Data Inserted Succesfully');
        redirect(base_url(). 'transportation/vehicle', 'refresh');

      }

      if($param1 == 'update'){

         $this->transpotation_model->updateVehicle($param2);
         $this->session->set_flashdata('flash_message', 'Data Updated Succesfully');
         redirect(base_url(). 'transportation/vehicle', 'refresh');

      }

      if($param1 == 'delete'){
            $this->transpotation_model->deleteVechile($param2);
            $this->session->set_flashdata('flash_message', 'Data Deleted Succesfully');
            redirect(base_url(). 'transportation/vehicle', 'refresh');
      }

      
        $page_data['page_name'] = 'vechile';
        $page_data['page_title'] = get_phrase('Manage Vechile');
       // $page_data['select_vacancy'] = $this->db->get('vacancy')->result_array();
        $this->load->view('admin/index', $page_data);
    }




}