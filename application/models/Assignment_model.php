<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class Assignment_model extends CI_Model { 
    
    function __construct()
    {
        parent::__construct();
    }
    
   // The function below inserts into assignment table //
   function insertAssignment(){
    $page_data = array(
        'name'                      => $this->input->post('name'),
        'description'               => $this->input->post('description'),
        'class_id'                  => $this->input->post('class_id'),
        'subject_id'                => $this->input->post('subject_id'),
        'teacher_id'                => $this->input->post('teacher_id'),
        'timestamp'                 => $this->input->post('timestamp'),
        'file_type'                 => $this->input->post('file_type')
    );
    

//uploading file using codeigniter upload library
    $files = $_FILES['file_name'];
    $this->load->library('upload');
    $config['upload_path'] = 'uploads/assignment/';
    $config['allowed_types'] = '*';
    $config['max_size'] = 10000;
    $_FILES['file_name']['name'] = $files['name'];
    $_FILES['file_name']['type'] = $files['type'];
    $_FILES['file_name']['tmp_name'] = $files['tmp_name'];
    $_FILES['file_name']['size'] = $files['size'];
    $this->upload->initialize($config);
    $this->upload->do_upload('file_name');

$page_data['file_name'] = $_FILES['file_name']['name'];
$this->db->insert('assignment', $page_data);
}

 // The function below updates assignment table //
 function updateAssignment($param2){


      
     
   

    $page_data = array(
        'name'                      => $this->input->post('name'),
        'description'               => $this->input->post('description'),
        'class_id'                  => $this->input->post('class_id'),
        'subject_id'                => $this->input->post('subject_id'),
        'teacher_id'                => $this->input->post('teacher_id'),
        'timestamp'                 => $this->input->post('timestamp'),
        'file_type'                 => $this->input->post('file_type')
    );
    
   /* print_r($image);
    die();
*/

    $image = $this->input->post('old_image');

    $old_image = site_url('uploads/assignment/'.trim($image));
    /*print_r($old_image);
    die();*/

    if($_FILES['file_name']['name']){
        //unlink($old_image);
        unlink("uploads/assignment/".trim($image));
        $files = $_FILES['file_name'];
        $this->load->library('upload');
        $config['upload_path'] = 'uploads/assignment/';
        $config['allowed_types'] = '*';
        $config['max_size'] = 10000;
        $_FILES['file_name']['name'] = $files['name'];
        $_FILES['file_name']['type'] = $files['type'];
        $_FILES['file_name']['tmp_name'] = $files['tmp_name'];
        $_FILES['file_name']['size'] = $files['size'];
        $this->upload->initialize($config);
        $this->upload->do_upload('file_name');

        $page_data['file_name'] = $_FILES['file_name']['name'];
        $this->db->where('assignment_id', $param2);
        $this->db->update('assignment', $page_data);

    } else {
        //$page_data['file_name'] = $this->input->post('old_image');
        $this->db->where('assignment_id', $param2);
        $this->db->update('assignment', $page_data);
    }


}

// The function below delete from assignment table //
function deleteAssignment($param2){

    $data = $this->db->get_where('assignment',array('assignment_id' => $param2))->row();
    $image = $data->file_name;
    unlink("uploads/assignment/".trim($image));


    $this->db->where('assignment_id', $param2);
    $this->db->delete('assignment');
}


    
    
}

