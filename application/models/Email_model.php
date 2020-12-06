<?php if (!defined('BASEPATH'))exit('No direct script access allowed'); 

class Email_model extends CI_Model {

    function __construct() {
        parent::__construct();
       
        
    }

    public function send_email($message = NULL, $receiverEmail = NULL, $from = NULL, $attachment_files = NULL){

        $school_website = "<a href = \"https://www.optimumlinkupsoftware.com/newschool\"> Developed with Love by Optimum Linkup Computers </a>";

        $from = $this->db->get_where('settings', array('type' => 'system_email'))->row()->description;

        $headers = "From : " . $from . "\r\n";
        $headers .= "Reply-To " . $receiverEmail . "\r\n";
        $headers        .=    "Return-Path: " . $receiverEmail . "\r\n";
        $headers        .=    "Website: " . $schoolWebsite . "\r\n";

         if($attachmentFiles != NULL){
            $message    .= "\r\nAttachment-Files: " . $attachmentFiles;
        }

        if(mail($receiverEmail, $message, $headers)){

        } else {
            echo "Not Sent";
        }


    }

     


   

}

?>