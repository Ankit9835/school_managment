<?php 
$system_name    = $this->db->get_where('settings', array('type' => 'system_name'))->row()->description;
$system_address    = $this->db->get_where('settings', array('type' => 'address'))->row()->description;
$footer = $this->db->get_where('settings', array('type' => 'footer'))->row()->description;
$running_year = $this->db->get_where('settings', array('type' => 'session'))->row()->description;
//$system_address = $this->db->get_where('settings', array('type' => 'address'))->row()->description;
//$footer         = $this->db->get_where('settings', array('type' => 'footer'))->row()->description;
$text_align     = $this->db->get_where('settings', array('type' => 'text_align'))->row()->description;
$loginType      = $this->session->userdata('login_type');


?>
<?php include 'plugins/css.php' ?>

<body>
    <!-- Preloader -->
    <div class="preloader">
        <div class="cssload-speeding-wheel"></div>
    </div>
    <div id="wrapper">
        <!-- Navigation -->
        <?php include 'header.php' ?>
        <!-- Left navbar-header -->
       <?php include  $loginType.'/navigation.php' ?>
        <!-- Left navbar-header end -->
        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <?php include 'page-info.php' ?>
                <?php include $loginType.'/'.$page_name.'.php';?>
                <!--row -->
                <?php //include 'dashboard.php' ?>
                <!-- /.row -->
                <!-- .right-sidebar -->
                <?php include 'rightbar.php' ?>
                <!-- /.right-sidebar -->

            </div>
            <div class="fabs">
    <div class="chat">
    
        <div class="chat_header">
              <div class="chat_option">
                    <div class="header_img">
                         <?php
                            $key = $this->session->userdata('login_type') . '_id';
                            $face_file = 'uploads/' . $this->session->userdata('login_type') . '_image/' . $this->session->userdata($key) . 'jpg';
                            if (!file_exists($face_file)) {
                                $face_file = 'uploads/default.jpg';                                 
                            }
                            ?>
                        <img src="<?php echo base_url() . $face_file;?>"/>
                    </div>
                    <span id="chat_head">
                        
                        <?php 
                                $account_type   =   $this->session->userdata('login_type');
                                $account_id     =   $account_type.'_id';
                                $name           =   $this->crud_model->get_type_name_by_id($account_type , $this->session->userdata($account_id), 'name');
                                echo $name;
                        ?>



                    </span> <br> <span class="agent"><?php echo $this->session->userdata('login_type'); ?></span> <span class="online">
                        
                         <?php if($login_status == '1'): ?>
                                   <?php echo '<i class="fa fa-circle" style="color:green"></i>';?>
                                   <?php endif;?>
                                   <?php if($login_status == '0'): ?>
                                   <?php echo '<i class="fa fa-circle" style="color:red"></i>';?>
                                   <?php endif;?>


                    </span>
                    <span id="chat_fullscreen_loader" class="chat_fullscreen_loader"><i class="fullscreen zmdi zmdi-window-maximize"></i></span>
              </div>
        </div>
        
        <div class="chat_body chat_login">
            <a id="chat_first_screen" class="fab"><i class="zmdi zmdi-arrow-right"></i></a>
            <p>We make it simple and seamless for businesses and people to talk to each other. Ask us anything</p>
        </div>
    
        <div id="chat_converse" class="chat_conversion chat_converse">
        <div class="refresh">
            <?php
                $messages = $this->crud_model->general_message();
                foreach($messages as $message):

                    $user_list = explode('-', $message['user_id']);
                    $user_login_type = $user_list[0];

                    $user_login_id = $user_list[1];
            ?>

            <?php
                if($message['user_id'] != $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id')):
            ?>
              <span class="chat_msg_item chat_msg_item_admin">
                    <div class="chat_avatar">
                       <img src="<?php echo $this->crud_model->get_image_url($user_login_type,$user_login_id); ?>"/>
                    </div>
                    <?php echo $message['message']; ?>
              </span>
             <?php endif; ?>

              <?php
                if($message['user_id'] == $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id')):
            ?>
              <span class="chat_msg_item chat_msg_item_admin">
                    <?php echo $message['message']; ?>
              </span>
             <?php endif; ?>
           

            <?php endforeach; ?>
        </div>
        </div>
   
        <div class="fab_field">
          <a id="fab_camera" class="fab"><i class="zmdi zmdi-camera"></i></a>
          <a id="fab_send" class="fab submit"><i class="zmdi zmdi-mail-send"></i></a>
          <input type= "hidden" id = "user_id" name = "user_id" value = "<?php 
          echo $this->session->userdata('login_type').'-'.$this->session->userdata('login_user_id') ?>">

          <textarea id="chatSend" name="chatSend" placeholder="Send a message" class="chat_field chat_message"></textarea>
        </div>
    
  </div>
    <a id="prime" class="fab"><i class="prime zmdi zmdi-comment-outline"></i></a>
</div>
<script src = "<?php echo base_url() ?>js/optimumajax.js"></script>
<script type="text/javascript">
    
    // Ajax post
$(document).ready(function() {
$(".submit").click(function(event) {
event.preventDefault();
var chatSend = $("textarea#chatSend").val();
var user_id = $("input#user_id").val();
jQuery.ajax({
type: "POST",
url: "<?php echo base_url(); ?>" + "admin/chatRoomMessage",
dataType: 'json',
data: {chatSend: chatSend, user_id: user_id},
success: function(res) {
if (res)
{
// echo some message here
}
}
});
});
});

</script>

 <script type="text/javascript">
    setInterval(function(){
        $('.refresh').load(location.href + ' .refresh');
    },2000);
</script> 
            <!-- /.container-fluid -->
           <?php include 'footer.php' ?>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
     <?php include 'modal.php'; ?>
    
   <?php //include 'plugins/js.php' ?>
   
   <?php include 'js.php' ?>





