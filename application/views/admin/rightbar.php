<div class="right-sidebar">
                    <div class="slimscrollright">
                        <div class="rpanel-title"> Chat System <span><i class="ti-close right-side-toggle"></i></span> </div>
                        <div class="r-panel-body">
                            <ul>

                                <?php

                                    $user_array = array('admin', 'student', 'teacher', 'parent', 'hrm', 'hostel', 'accountant', 'librarian');

                                    for($i=0; $i < sizeof($user_array); $i++):
                                    $user_lists =  $this->db->get($user_array[$i])->result_array();

                                    foreach ($user_lists as $key => $user_list):    
                                ?>

                                <?php $login_status = $user_list['login_status']; ?>
                               
                                <li> <img src = "<?php echo base_url() ?>uploads/<?php echo $user_array[$i].'_image' ?>/<?php echo $user_list[$user_array[$i].'_id'].'.jpg' ?>" width = "20px" height = "20px"> <?php echo $user_list['name']; ?>

                                     <span class="pull-right">
                                   <?php if($login_status == '1'): ?>
                                   <?php echo '<i class="fa fa-circle" style="color:green"></i>';?>
                                   <?php endif;?>
                                   <?php if($login_status == '0'): ?>
                                   <?php echo '<i class="fa fa-circle" style="color:red"></i>';?>
                                   <?php endif;?>
                                   
                                   
                                   </span>

                                 </li>
                               
                               <?php endforeach; ?>
                                <?php endfor; ?>


                            </ul>
                        </div>
                    </div>
                </div>