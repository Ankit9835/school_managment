<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-body table-responsive">
                <div class="printableArea">
                <div align="center">
                    <img src = "<?php echo base_url() ?>uploads/logo.png" width = "30px" height = "30px" class = "img-circle"> <br>
                    <span style = "text-align:center; font-size:25px;"> <?php echo $system_name ?> </span> <br>
                    <span style = "text-align:center; font-size:25px;"> <?php echo $system_address ?> </span>
                </div>

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
                            <td><img src = "<?php echo base_url() ?>uploads/student_image/<?php echo $student['student_id'] . '.jpg' ?>" class="img-circle" width="30px" height="30px"></td>
                             <?php

                                    for($i = 0; $i <= $days; $i++){

                                        $full_date = $year."-".$month."/".$i;
                                        $verify_data = array('student_id' => $student['student_id'], 'date' => $full_date);
                                        $attendance = $this->db->get_where('attendance', $verify_data)->row();
                                        $status = $attendance->status;
                                ?>    

                            <td style="text-align: center;">
                                
                                <?php if($status == '0'): ?>
                                     <h9 style="color:black">U</h9>
                                <?php endif; ?>
                                 <?php if($status == '1'): ?>
                                    <h9 style="color:green">P</h9>
                                <?php endif; ?> 
                                 <?php if($status == '2'): ?>
                                     <h9 style="color:red">A</h9>
                                <?php endif; ?> 
                                 <?php if($status == '3'): ?>
                                   <h9 style="color:grey">L</h9>
                                <?php endif; ?> 
                                 <?php if($status == '4'): ?>
                                    <h9 style="color:yellow">H</h9>
                                <?php endif; ?>  
                               
                            </td>
                          <?php } ?>   
                        </tr>
                    <?php 
                   
                    };
                    ?>
                    </tbody>
                </table>
                <hr>
        <div align="center">
        <strong>KEYS: </strong>
        Present&nbsp;-&nbsp; P &nbsp;&nbsp;
        Absent&nbsp;-&nbsp;A&nbsp;&nbsp;
        Half Day&nbsp;-&nbsp; H&nbsp;&nbsp;
        Late&nbsp;-&nbsp; L&nbsp;&nbsp;
        Undefine&nbsp;-&nbsp;U
        </div>
    </div>
                
   <br>
    <button id ="print" class="btn btn-info btn-sm btn-rounded btn-block"><i class="fa fa-print"></i> Print</button>
            </div>
        </div>
    </div>
</div>
