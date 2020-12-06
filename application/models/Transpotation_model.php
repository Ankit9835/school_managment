<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Transpotation_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }

    public function insertTransport(){

        $page_data = array(
            'name'                      => html_escape($this->input->post('name')),
            'transport_route_id'        => html_escape($this->input->post('transport_route_id')),
            'vehicle_id'                => html_escape($this->input->post('vehicle_id')),
            'route_fare'                => html_escape($this->input->post('route_fare')),
            'description'               => html_escape($this->input->post('description')),
        );

        $this->db->insert('transport', $page_data);

    	 
    }

    public function updateTransport($param2){

         $page_data = array(
            'name'                      => html_escape($this->input->post('name')),
            'transport_route_id'        => html_escape($this->input->post('transport_route_id')),
            'vehicle_id'                => html_escape($this->input->post('vehicle_id')),
            'route_fare'                => html_escape($this->input->post('route_fare')),
            'description'               => html_escape($this->input->post('description')),
        );

        $this->db->where('transport_id', $param2);
        $this->db->update('transport', $page_data);


    }

    public function deleteTransport($param2){

        $this->db->where('transport_id', $param2);
        $this->db->delete('transport');

    }

    public function insertTransportRoute(){

        $page_data = array(
            'name'               => html_escape($this->input->post('name')),
            'description'        => html_escape($this->input->post('description'))
        );
        $this->db->insert('transport_route', $page_data);

    }

    public function updateTransportRoute(){

        $page_data = array(
            'name'               => html_escape($this->input->post('name')),
            'description'        => html_escape($this->input->post('description'))
        );
        $this->db->where('transport_route_id', $param2);
        $this->db->update('transport_route', $page_data);

    }

    public function deleteTransportRoute($param2){

        $this->db->where('transport_route_id', $param2);
        $this->db->delete('transport_route');

    }

    public function insertVehicle(){
            $page_data = array(
                'name'                          => html_escape($this->input->post('name')),
                'vehicle_number'                => html_escape($this->input->post('vehicle_number')),
                'vehicle_model'                 => html_escape($this->input->post('vehicle_model')),
                'vehicle_quantity'              => html_escape($this->input->post('vehicle_quantity')),
                'year_made'                     => html_escape($this->input->post('year_made')),
                'driver_name'                   => html_escape($this->input->post('driver_name')),
                'driver_license'                => html_escape($this->input->post('driver_license')),
                'driver_contact'                => html_escape($this->input->post('driver_contact')),
                'description'                   => html_escape($this->input->post('description')),
                'status'                        => html_escape($this->input->post('status'))
            );
            $this->db->insert('vehicle', $page_data);

        }

       public function updateVehicle($param2){
            $page_data = array(
                'name'                          => html_escape($this->input->post('name')),
                'vehicle_number'                => html_escape($this->input->post('vehicle_number')),
                'vehicle_model'                 => html_escape($this->input->post('vehicle_model')),
                'vehicle_quantity'              => html_escape($this->input->post('vehicle_quantity')),
                'year_made'                     => html_escape($this->input->post('year_made')),
                'driver_name'                   => html_escape($this->input->post('driver_name')),
                'driver_license'                => html_escape($this->input->post('driver_license')),
                'driver_contact'                => html_escape($this->input->post('driver_contact')),
                'description'                   => html_escape($this->input->post('description')),
                'status'                        => html_escape($this->input->post('status'))
            );
    
            $this->db->where('vehicle_id', $param2);
            $this->db->update('vehicle', $page_data);
        }

        public function deleteVechile($param2){
            $this->db->where('vehicle_id', $param2);
            $this->db->delete('vehicle');
        }

     


   

}

?>