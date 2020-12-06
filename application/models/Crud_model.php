<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Crud_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
       
		
    }


    public function get_type_name_by_id($type, $type_id = '', $field = 'name'){

    	$this->db->where($type . '_id', $type_id);
    	$query = $this->db->get($type);
    	$result = $query->result_array();

    	foreach ($result as $key => $row) 
    		return $row[$field];
    }

    public function get_subject_name_by_id($subject_id){

        $query = $this->db->get_where('subject', array('subject_id' => $subject_id))->row();

        return $query->name;

    }

   public function get_image_url($type = '', $id = '') {
        if (file_exists('uploads/' . $type . '_image/' . $id . '.jpg'))
            $image_url = base_url() . 'uploads/' . $type . '_image/' . $id . '.jpg';
       /* else
            $image_url = base_url() . 'uploads/user.jpg';*/

        return $image_url;

    }

    public function general_message(){
        $query = $this->db->query('select * from general_message ORDER BY general_message_id asc');
        return $query->result_array();
    }

    public function enquiry_category(){

        $page_data['category']  =   $this->input->post('category');
        $page_data['purpose']   =   $this->input->post('purpose');
        $page_data['whom']      =   $this->input->post('whom');

        $this->db->insert('enquiry_category', $page_data);
    }

    public function update_category($param2){

        $page_data['category']  =   $this->input->post('category');
        $page_data['purpose']   =   $this->input->post('purpose');
        $page_data['whom']      =   $this->input->post('whom');

        $this->db->where('enquiry_category_id', $param2);
        $this->db->update('enquiry_category', $page_data);
    }

    public function delete_category($param2){

        $this->db->where('enquiry_category_id', $param2);
        $this->db->delete('enquiry_category');
    }

    public function create_circular(){
        $page_data['title'] = $this->input->post('title');
        $page_data['reference'] = $this->input->post('reference');
        $page_data['content'] = $this->input->post('content');
        $page_data['date'] = $this->input->post('date');

        $this->db->insert('circular', $page_data);
    }

    public function update_circular($param2){

        $page_data['title'] = $this->input->post('title');
        $page_data['reference'] = $this->input->post('reference');
        $page_data['content'] = $this->input->post('content');
        $page_data['date'] = $this->input->post('date');

        $this->db->where('circular_id', $param2);
        $this->db->update('circular', $page_data);

    }

    public function delete_circular($param2){

        $this->db->where('circular_id', $param2);
        $this->db->delete('circular');
    }

    public function insert_parent(){
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'profession' => $this->input->post('profession')

        );

        $this->db->insert('parent', $data);
    }

    public function update_parent($param2){
        $data = array(
            'name' => $this->input->post('name'),
            'email' => $this->input->post('email'),
            'password' => $this->input->post('password'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'profession' => $this->input->post('profession')

        );

        $this->db->where('parent_id', $param2);
        $this->db->update('parent', $data);

    }

    public function delete_parent($param2){
        $this->db->where('parent_id', $param2);
        $this->db->delete('parent');
    }

     public function insert_librarian(){
        $page_data = array(
             'name'                 => $this->input->post('name'),
            'librarian_number'  => $this->input->post('librarian_number'),
            'birthday'          => $this->input->post('birthday'),
            'sex'               => $this->input->post('sex'),
            'religion'          => $this->input->post('religion'),
            'blood_group'       => $this->input->post('blood_group'),
            'address'           => $this->input->post('address'),
            'phone'             => $this->input->post('phone'),
            
            'facebook'          => $this->input->post('facebook'),
            'twitter'           => $this->input->post('twitter'),
            'googleplus'        => $this->input->post('googleplus'),
            'linkedin'          => $this->input->post('linkedin'),
            'qualification'     => $this->input->post('qualification'),
            'marital_status'    => $this->input->post('marital_status'),
            'password'          => sha1($this->input->post('password'))

        );

        $page_data['file_name'] = $_FILES['file_name']['name'];
        $page_data['email'] = $this->input->post('email');
        $check_email = $this->db->get_where('librarian', array('email' => $data['email']))->row()->email;
        if($check_email != null){
            $this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/librarian/', 'refresh');
    } else {
        $this->db->insert('librarian', $page_data);
        $librarian_id = $this->db->insert_id();

        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/librarian_image/". $_FILES["file_name"]["name"]);

         move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/librarian_image/". $librarian_id . '.jpg');
    }

       
    }

     public function update_librarian($param2){
        $page_data = array(
             'name'                 => $this->input->post('name'),
            'librarian_number'  => $this->input->post('librarian_number'),
            'birthday'          => $this->input->post('birthday'),
            'sex'               => $this->input->post('sex'),
            'religion'          => $this->input->post('religion'),
            'blood_group'       => $this->input->post('blood_group'),
            'address'           => $this->input->post('address'),
            'phone'             => $this->input->post('phone'),
            
            'facebook'          => $this->input->post('facebook'),
            'twitter'           => $this->input->post('twitter'),
            'googleplus'        => $this->input->post('googleplus'),
            'linkedin'          => $this->input->post('linkedin'),
            'qualification'     => $this->input->post('qualification'),
            'marital_status'    => $this->input->post('marital_status')
           

        );

       
        $page_data['email'] = $this->input->post('email');
        
        $this->db->where('librarian_id', $param2);
        $this->db->update('librarian', $page_data);
       
         move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/librarian_image/' . $param2 . '.jpg');     
    

       
    }

     public function delete_librarian($param2){
        $this->db->where('librarian_id', $param2);
        $this->db->delete('librarian');
    }


     public function insert_accountant(){
        $page_data = array(
             'name'                 => $this->input->post('name'),
            'accountant_number'  => $this->input->post('accountant_number'),
            'birthday'          => $this->input->post('birthday'),
            'sex'               => $this->input->post('sex'),
            'religion'          => $this->input->post('religion'),
            'blood_group'       => $this->input->post('blood_group'),
            'address'           => $this->input->post('address'),
            'phone'             => $this->input->post('phone'),
            
            'facebook'          => $this->input->post('facebook'),
            'twitter'           => $this->input->post('twitter'),
            'googleplus'        => $this->input->post('googleplus'),
            'linkedin'          => $this->input->post('linkedin'),
            'qualification'     => $this->input->post('qualification'),
            'marital_status'    => $this->input->post('marital_status'),
            'password'          => sha1($this->input->post('password'))

        );

        $page_data['file_name'] = $_FILES['file_name']['name'];
        $page_data['email'] = $this->input->post('email');
        $check_email = $this->db->get_where('accountant', array('email' => $data['email']))->row()->email;
        if($check_email != null){
            $this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/librarian/', 'refresh');
    } else {
        $this->db->insert('accountant', $page_data);
        $accountant_id = $this->db->insert_id();

        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/accountant_image/". $_FILES["file_name"]["name"]);

         move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/accountant_image/". $accountant_id . '.jpg');
    }

       
    }

     public function update_accountant($param2){
        $page_data = array(
             'name'                 => $this->input->post('name'),
            
            'birthday'          => $this->input->post('birthday'),
            'sex'               => $this->input->post('sex'),
            'religion'          => $this->input->post('religion'),
            'blood_group'       => $this->input->post('blood_group'),
            'address'           => $this->input->post('address'),
            'phone'             => $this->input->post('phone'),
            
            'facebook'          => $this->input->post('facebook'),
            'twitter'           => $this->input->post('twitter'),
            'googleplus'        => $this->input->post('googleplus'),
            'linkedin'          => $this->input->post('linkedin'),
            'qualification'     => $this->input->post('qualification'),
            'marital_status'    => $this->input->post('marital_status')
           

        );

       
        $page_data['email'] = $this->input->post('email');
        
        $this->db->where('accountant_id', $param2);
        $this->db->update('accountant', $page_data);
        //$accountant_id = $this->db->insert_id();
       
         move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/accountant_image/' . $param2 . '.jpg');         
    

       
    }

     public function delete_accountant($param2){
        $this->db->where('accountant_id', $param2);
        $this->db->delete('accountant');
    }

    public function insert_hostel(){
        $page_data = array(
             'name'                 => $this->input->post('name'),
            'hostel_number'  => $this->input->post('hostel_number'),
            'birthday'          => $this->input->post('birthday'),
            'sex'               => $this->input->post('sex'),
            'religion'          => $this->input->post('religion'),
            'blood_group'       => $this->input->post('blood_group'),
            'address'           => $this->input->post('address'),
            'phone'             => $this->input->post('phone'),
            
            'facebook'          => $this->input->post('facebook'),
            'twitter'           => $this->input->post('twitter'),
            'googleplus'        => $this->input->post('googleplus'),
            'linkedin'          => $this->input->post('linkedin'),
            'qualification'     => $this->input->post('qualification'),
            'marital_status'    => $this->input->post('marital_status'),
            'password'          => sha1($this->input->post('password'))

        );

        $page_data['file_name'] = $_FILES['file_name']['name'];
        $page_data['email'] = $this->input->post('email');
        $check_email = $this->db->get_where('hostel', array('email' => $data['email']))->row()->email;
        if($check_email != null){
            $this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/librarian/', 'refresh');
    } else {
        $this->db->insert('hostel', $page_data);
        $hostel_id = $this->db->insert_id();

        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/hostel_image/". $_FILES["file_name"]["name"]);

         move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/hostel_image/". $hostel_id . '.jpg');
    }

       
    }

     public function update_hostel($param2){
        $page_data = array(
             'name'                 => $this->input->post('name'),
            
            'birthday'          => $this->input->post('birthday'),
            'sex'               => $this->input->post('sex'),
            'religion'          => $this->input->post('religion'),
            'blood_group'       => $this->input->post('blood_group'),
            'address'           => $this->input->post('address'),
            'phone'             => $this->input->post('phone'),
            
            'facebook'          => $this->input->post('facebook'),
            'twitter'           => $this->input->post('twitter'),
            'googleplus'        => $this->input->post('googleplus'),
            'linkedin'          => $this->input->post('linkedin'),
            'qualification'     => $this->input->post('qualification'),
            'marital_status'    => $this->input->post('marital_status')
           

        );

       
        $page_data['email'] = $this->input->post('email');
        
        $this->db->where('hostel_id', $param2);
        $this->db->update('hostel', $page_data);
        //$accountant_id = $this->db->insert_id();
       
         move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hostel_image/' . $param2 . '.jpg');         
    

       
    }

     public function delete_hostel($param2){
        $this->db->where('hostel_id', $param2);
        $this->db->delete('hostel');
    }

     public function insert_hrm(){
        $page_data = array(
             'name'                 => $this->input->post('name'),
            'hrm_number'  => $this->input->post('hrm_number'),
            'birthday'          => $this->input->post('birthday'),
            'sex'               => $this->input->post('sex'),
            'religion'          => $this->input->post('religion'),
            'blood_group'       => $this->input->post('blood_group'),
            'address'           => $this->input->post('address'),
            'phone'             => $this->input->post('phone'),
            
            'facebook'          => $this->input->post('facebook'),
            'twitter'           => $this->input->post('twitter'),
            'googleplus'        => $this->input->post('googleplus'),
            'linkedin'          => $this->input->post('linkedin'),
            'qualification'     => $this->input->post('qualification'),
            'marital_status'    => $this->input->post('marital_status'),
            'password'          => sha1($this->input->post('password'))

        );

        $page_data['file_name'] = $_FILES['file_name']['name'];
        $page_data['email'] = $this->input->post('email');
        $check_email = $this->db->get_where('hrm', array('email' => $data['email']))->row()->email;
        if($check_email != null){
            $this->session->set_flashdata('error_message', get_phrase('email_already_exist'));
        redirect(base_url() . 'admin/hrm/', 'refresh');
    } else {
        $this->db->insert('hrm', $page_data);
        $hrm_id = $this->db->insert_id();

        move_uploaded_file($_FILES["file_name"]["tmp_name"], "uploads/hrm_image/". $_FILES["file_name"]["name"]);

         move_uploaded_file($_FILES["userfile"]["tmp_name"], "uploads/hrm_image/". $hrm_id . '.jpg');
    }

       
    }

     public function update_hrm($param2){
        $page_data = array(
             'name'                 => $this->input->post('name'),
            
            'birthday'          => $this->input->post('birthday'),
            'sex'               => $this->input->post('sex'),
            'religion'          => $this->input->post('religion'),
            'blood_group'       => $this->input->post('blood_group'),
            'address'           => $this->input->post('address'),
            'phone'             => $this->input->post('phone'),
            
            'facebook'          => $this->input->post('facebook'),
            'twitter'           => $this->input->post('twitter'),
            'googleplus'        => $this->input->post('googleplus'),
            'linkedin'          => $this->input->post('linkedin'),
            'qualification'     => $this->input->post('qualification'),
            'marital_status'    => $this->input->post('marital_status')
           

        );

       
        $page_data['email'] = $this->input->post('email');
        
        $this->db->where('hrm_id', $param2);
        $this->db->update('hrm', $page_data);
        //$accountant_id = $this->db->insert_id();
       
         move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/hrm_image/' . $param2 . '.jpg');         
    

       
    }

     public function delete_hrm($param2){
        $this->db->where('hrm_id', $param2);
        $this->db->delete('hrm');
    }

    public function system_settings(){

         move_uploaded_file($_FILES['userfile']['tmp_name'], 'uploads/logo.png');
    }

    public function update_settings(){

        $data['description']    =   $this->input->post('system_name');
        $this->db->where('type', 'system_name');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('system_title');
        $this->db->where('type', 'system_title');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('address');
        $this->db->where('type', 'address');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('phone');
        $this->db->where('type', 'phone');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('paypal_email');
        $this->db->where('type', 'paypal_email');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('currency');
        $this->db->where('type', 'currency');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('system_email');
        $this->db->where('type', 'system_email');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('language');
        $this->db->where('type', 'language');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('text_align');
        $this->db->where('type', 'text_align');
        $this->db->update('settings', $data);



        $data['description']    =   $this->input->post('system_footer');
        $this->db->where('type', 'footer');
        $this->db->update('settings', $data);

        $data['description']    =   $this->input->post('running_session');
        $this->db->where('type', 'session');
        $this->db->update('settings', $data);


    }

    public function themeSettings(){

        $data['description']    =   $this->input->post('skin_colour');
        $this->db->where('type', 'skin_colour');
        $this->db->update('settings', $data);

    }

    public function get_settings($type){

        $settings = $this->db->get_where('settings', array('type' => $type))->row()->description;
        return $settings;

    }

    public function stripe_settings(){

        $info = array();

        $stripe['stripe_active']    = html_escape($this->input->post('stripe_active'));
        $stripe['testmode']         = html_escape($this->input->post('testmode'));
        $stripe['secret_key']       = html_escape($this->input->post('secret_key'));
        $stripe['public_key']       = html_escape($this->input->post('public_key'));
        $stripe['secret_live_key']  = html_escape($this->input->post('secret_live_key'));
        $stripe['public_live_key']  = html_escape($this->input->post('public_live_key'));

        array_push($info, $stripe);

        $data['description'] = json_encode($info);
        $this->db->where('type', 'stripe_setting');
        $this->db->update('settings', $data);



    }

    public function paypal_settings(){
        $paypal_info = array();

        $paypal['paypal_active']    = html_escape($this->input->post('paypal_active'));
        $paypal['paypal_mode']         = html_escape($this->input->post('paypal_mode'));
        $paypal['sandbox_client_id']       = html_escape($this->input->post('sandbox_client_id'));
        $paypal['production_client_id']       = html_escape($this->input->post('production_client_id'));
        
        array_push($paypal_info, $paypal);

        $data['description'] = json_encode($paypal_info);
        $this->db->where('type', 'paypal_setting');
        $this->db->update('settings', $data);


    }

   function get_class_name ($class_id){
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $result = $query->result_array();
        foreach ($result as $key => $row)
                return $row['name'];

    }

    function get_teachers() {
        $query = $this->db->get('teacher');
        return $query->result_array();
    }

    function get_teacher_name($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name'];
    }

    function get_admin_name($admin_id) {
        $query = $this->db->get_where('admin', array('admin_id' => $admin_id));
        $resi = $query->result_array();
        foreach ($resi as $row)
            return $row['name'];
    }

    function get_teacher_info($teacher_id) {
        $query = $this->db->get_where('teacher', array('teacher_id' => $teacher_id));
        return $query->result_array();
    }

    /***********  Subjects  *******************/
    function get_subjects() {
        $query = $this->db->get('subject');
        return $query->result_array();
    }

    function get_subject_info($subject_id) {
        $query = $this->db->get_where('subject', array('subject_id' => $subject_id));
        return $query->result_array();
    }

    function get_subjects_by_class($class_id) {
        $query = $this->db->get_where('subject', array('class_id' => $class_id));
        return $query->result_array();
    }


    function get_class_name_numeric($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        $res = $query->result_array();
        foreach ($res as $row)
            return $row['name_numeric'];
    }

    function get_classes() {
        $query = $this->db->get('class');
        return $query->result_array();
    }

    function get_class_info($class_id) {
        $query = $this->db->get_where('class', array('class_id' => $class_id));
        return $query->result_array();
    }

    /***********  Exams  *******************/
    function get_exams() {
        $query = $this->db->get('exam');
        return $query->result_array();
    }

    function get_exam_info($exam_id) {
        $query = $this->db->get_where('exam', array('exam_id' => $exam_id));
        return $query->result_array();
    }

    /***********  Grades  *******************/
    function get_grades() {
        $query = $this->db->get('grade');
        return $query->result_array();
    }

    function get_grade_info($grade_id) {
        $query = $this->db->get_where('grade', array('grade_id' => $grade_id));
        return $query->result_array();
    }

    function get_students($class_id){
        $query = $this->db->get_where('student', array('class_id' => $class_id));
        return $query->result_array();
    }

    function list_all_student(){

        $data = array();
        $sql = "select * from student order by student_id desc limit 0,5";

        $get_student_selected = $this->db->query($sql)->result_array();

        foreach ($get_student_selected as $key => $student) {
            $student_id = $student['student_id'];
            $face_file = 'uploads/student_image'. $student_id . '.jpg';

            if(!file_exists($face_file)){
                $face_file = 'uploads/student_image/default_image.jpg';
            }

            $student['face_file'] = base_url(). $face_file;
            array_push($data, $student);
        }
        return $data;

    }

    function list_all_teacher(){

        $data = array();
        $sql = "select * from teacher order by teacher_id desc limit 0,5";

        $get_teacher_selected = $this->db->query($sql)->result_array();

        foreach ($get_teacher_selected as $key => $teacher) {
            $teacher_id = $teacher['teacher_id'];
            $face_file = 'uploads/teacher_image'. $teacher_id . '.jpg';

            if(!file_exists($face_file)){
                $face_file = 'uploads/teacher_image/default_image.jpg';
            }

            $teacher['face_file'] = base_url(). $face_file;
            array_push($data, $teacher);
        }
        return $data;

    }


    public function updateGeneralSettings(){

        $data['description'] = $this->input->post('about');
        $this->db->where('type','about_us');
        $this->db->update('website_settings',$data);

        $data['description'] = $this->input->post('video');
        $this->db->where('type','video_link');
        $this->db->update('website_settings',$data);

        $data['description'] = $this->input->post('mission');
        $this->db->where('type','mission');
        $this->db->update('website_settings',$data);

        $data['description'] = $this->input->post('vision');
        $this->db->where('type','vision');
        $this->db->update('website_settings',$data);

        $data['description'] = $this->input->post('goal');
        $this->db->where('type','goal');
        $this->db->update('website_settings',$data);

        $data['description'] = $this->input->post('testimony');
        $this->db->where('type','testimony_message');
        $this->db->update('website_settings',$data);

        $data['description'] = $this->input->post('map_code');
        $this->db->where('type','map_code');
        $this->db->update('website_settings',$data);

    }

    public function bannerSetting(){
        $page_data['banner_image'] = $_FILES['banner_image']['name'];
        $page_data['banner_text'] = $this->input->post('banner_text');
        $this->db->insert('banners',$page_data);
        move_uploaded_file($_FILES["banner_image"]["tmp_name"], "uploads/banner_image/" . $_FILES["banner_image"]["name"]);
    }

    public function testimonySetting($param2){

         $input_data = array(

            'status' => $this->input->post('status')

        );
        $this->db->where('testimony_id',$param2);
        $this->db->update('testimony',$input_data);
    }

    public function submitTestimony(){
         $page_data['parent_id'] = $this->db->get_where('parent',array('parent_id' => $this->session->userdata('parent_id')))->row()->parent_id;
         
        $page_data['content'] = $this->input->post('content');
        $page_data['status'] = '0';

        $this->db->insert('testimony',$page_data);
    }

    public function testimonyDelete($param2){
        $this->db->where('testimony_id',$param2);
        $this->db->delete('testimony');
    }
    
    



}