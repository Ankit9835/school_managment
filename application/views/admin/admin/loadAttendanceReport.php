<?php if($section_id!=null && $month!=null && $year!=null && $class_id!=null):?>


<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-body table-responsive">

            <?php $classes = $this->db->get('class')->result_array();
                    foreach($classes as $key => $class){ 
                        if(isset($class_id) && $class_id == $class['class_id'])
                            $class_name = $class['name'];
            }?>
                    <h3 style="color:#696969;">Attendance For: <?php echo $class_name;?></h3>
            
            <?php $secions = $this->db->get('section')->result_array();
                    foreach($secions as $key => $secion){ 
                        if(isset($section_id) && $section_id == $secion['section_id'])
                            $section_name = $secion['name'];
            }?>
            <h3 style="color:#696969;">Section: <?php echo $section_name;?></h3>
            
            
            
            <?php 
            $full_date = "5"."-".$month."-".$year;
            $full_date = date_create($full_date);
            $full_date = date_format($full_date, "F, Y");?>
            <h3 style="color:#696969;"><?php echo $full_date;?></h3>



            </div>
        </div>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-body table-responsive">

 KEYS: 
        Present&nbsp;-&nbsp; <i class="fa fa-circle" style="color: #00a651;"></i>&nbsp;&nbsp;
        Absent&nbsp;-&nbsp;<i class="fa fa-circle" style="color: #EE4749;"></i>&nbsp;&nbsp;
        Half Day&nbsp;-&nbsp; <i class="fa fa-circle" style="color: #0000FF;"></i>&nbsp;&nbsp;
        Late&nbsp;-&nbsp; <i class="fa fa-circle" style="color: #FF6600;"></i>&nbsp;&nbsp;
        Undefine&nbsp;-&nbsp;<i class="fa fa-circle" style="color:black;"></i>
            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            
                            <td style="text-align: left;">Students<i class="fa fa-down-thin"></i>| Date:</td>
                            <?php

                                $days = date("t", mktime(0,0,0,$month,1,$year));
                                for($i = 0; $i < $days; $i++){ ?>
                                     <td style="text-align: center;"><?php echo ($i+1);?></td>   
                                <?php 
                                     }
                                 ;?>
                               
                            
                            
                        </tr>
                    </thead>
                    <tbody>

                    <?php $students = $this->db->get_where('student', array('class_id' => $class_id))->result_array();
                         
                          foreach($students as $key => $student){?>
         
                        <tr class="gradeA">
                            <td><?php echo $student['name'];?></td>
                             <?php

                                    for($i = 0; $i <= $days; $i++){

                                        $full_date = $year."-".$month."/".$i;
                                        $verify_data = array('student_id' => $student['student_id'], 'date' => $full_date);
                                        $attendance = $this->db->get_where('attendance', $verify_data)->row();
                                        $status = $attendance->status;
                                ?>    

                            <td>
                                
                                <?php if($status == '0'): ?>
                                    <i class="fa fa-circle" style="color:black;"></i>
                                <?php endif; ?>
                                 <?php if($status == '1'): ?>
                                    <i class="fa fa-circle" style="color: green;"></i>
                                <?php endif; ?> 
                                 <?php if($status == '2'): ?>
                                     <i class="fa fa-circle" style="color: red;"></i>
                                <?php endif; ?> 
                                 <?php if($status == '3'): ?>
                                    <i class="fa fa-circle" style="color:grey;"></i>
                                <?php endif; ?> 
                                 <?php if($status == '4'): ?>
                                    <i class="fa fa-circle" style="color: yellow;"></i>
                                <?php endif; ?>  
                               
                            </td>
                          <?php } ?>   
                        </tr>
                    <?php 
                   
                    };
                    ?>
                    </tbody>
                </table>

                <a href = "<?php echo base_url(); ?>admin/printAttendanceReport/<?php echo $class_id ?>/<?php echo $section_id ?>/<?php echo $month ?>/<?php echo $year ?>" class = "btn btn-success btn-sm btn-rounded btn-block" style="color:white"> 

                    <i class="fa fa-print"></i> Print

                </a>
   
            </div>
        </div>
    </div>
</div>



<?php endif;?>