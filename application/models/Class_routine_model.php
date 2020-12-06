<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Class_routine_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }

    public function insertTimeTable(){

       if($this->input->post('class_id') != ''){

            $data['class_id'] = $this->input->post('class_id');
       }

       $data['section_id'] = $this->input->post('section_id');
       $data['subject_id'] = $this->input->post('subject_id');

       // 12 AM for starting time

       if($this->input->post('time_start') == 12 && $this->input->post('starting_ampm') == 1){
            $data['time_start'] = 24;
       }

       // 12 PM for starting time

       elseif($this->input->post('time_start') == 12 && $this->input->post('starting_ampm') == 2) {

            $data['time_start'] = 12;
       }

       // otherwise for starting time

       else {

            $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));

       }

       // 12 AM for ending time

       if($this->input->post('time_end') == 12 && $this->input->post('ending_ampm') == 1){
            $data['time_end'] = 24;
       }

       // 12 PM for ending time

        elseif($this->input->post('time_end') == 12 && $this->input->post('ending_ampm') == 2) {

            $data['time_end'] = 12;
       }

       // otherwise for ending time

        else {

            $data['time_end'] = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));

       }

       $data['time_start_min'] = html_escape($this->input->post('time_start_min'));
       $data['time_end_min'] = html_escape($this->input->post('time_end_min'));
       $data['day'] = html_escape($this->input->post('day'));
       $data['year'] = $this->db->get_where('settings', array('type' => 'session'))->row()->description;

        $array = array(
             'section_id'       => $data['section_id'],
             'class_id'         => $data['class_id'],
             'time_start'       => $data['time_start'],
              'time_end'        => $data['time_end'],
              'time_start_min'  => $data['time_start_min'],
              'time_end_min'    => $data['time_end_min'],
              'day'             => $data['day'],
              'year'            => $data['year']
            );

        $this->db->insert('class_routine', $data);


    }

    public function updateTimeTable($param2){

        if($this->input->post('class_id') != ''){

            $data['class_id'] = $this->input->post('class_id');
       }

       $data['section_id'] = $this->input->post('section_id');
       $data['subject_id'] = $this->input->post('subject_id');

       // 12 AM for starting time

       if($this->input->post('time_start') == 12 && $this->input->post('starting_ampm') == 1){
            $data['time_start'] = 24;
       }

       // 12 PM for starting time

       elseif($this->input->post('time_start') == 12 && $this->input->post('starting_ampm') == 2) {

            $data['time_start'] = 12;
       }

       // otherwise for starting time

       else {

            $data['time_start'] = $this->input->post('time_start') + (12 * ($this->input->post('starting_ampm') - 1));

       }

       // 12 AM for ending time

       if($this->input->post('time_end') == 12 && $this->input->post('ending_ampm') == 1){
            $data['time_end'] = 24;
       }

       // 12 PM for ending time

        elseif($this->input->post('time_end') == 12 && $this->input->post('ending_ampm') == 2) {

            $data['time_end'] = 12;
       }

       // otherwise for ending time

        else {

            $data['time_end'] = $this->input->post('time_end') + (12 * ($this->input->post('ending_ampm') - 1));

       }

       $data['time_start_min'] = html_escape($this->input->post('time_start_min'));
       $data['time_end_min'] = html_escape($this->input->post('time_end_min'));
       $data['day'] = html_escape($this->input->post('day'));
       $data['year'] = $this->db->get_where('settings', array('type' => 'session'))->row()->description;

        $array = array(
             'section_id'       => $data['section_id'],
             'class_id'         => $data['class_id'],
             'time_start'       => $data['time_start'],
              'time_end'        => $data['time_end'],
              'time_start_min'  => $data['time_start_min'],
              'time_end_min'    => $data['time_end_min'],
              'day'             => $data['day'],
              'year'            => $data['year']
            );

        $this->db->where('class_routine_id', $param2);
        $this->db->update('class_routine', $array);

    }

    public function deleteTimeTable($param2){

        $this->db->where('class_routine_id',$param2);
        $this->db->delete('class_routine');

    }

     


   

}

?>