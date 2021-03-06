
<div class="row">
                    <div class="col-sm-12">
                    <div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('Student Marks');?></div>
                                <div class="panel-body table-responsive">
            
<!----CREATION FORM STARTS---->

                    <?php echo form_open(base_url() . 'report/examMarkReport' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top', 'enctype' => 'multipart/form-data'));?>
                    
                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('exam');?></label>
                    <div class="col-sm-12">
                    <select name="exam_id" class="form-control select2" onchange="return get_class_sections(this.value)">
                    <option value=""><?php echo get_phrase('select_exam');?></option>

                    <?php $exams =  $this->db->get('exam')->result_array();
                    foreach($exams as $key => $exam):?>
                    <option value="<?php echo $exam['exam_id'];?>"<?php if(isset($exam_id) && $exam_id==$exam['exam_id']) echo 'selected="selected"';?>><?php echo $exam['name'];?></option>
                    <?php endforeach;?>
                   </select>

                  </div>
                 </div>

                                
                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('class');?></label>
                    <div class="col-sm-12">
                    <select name="class_id" class="form-control select2" id="section_selector_holder" onchange="show_students(this.value)">
                       <option value=""><?php echo get_phrase('select_class');?></option>
                    <?php $class =  $this->db->get('class')->result_array();
                    foreach($class as $key => $class):?>
                    <option value="<?php echo $class['class_id'];?>"<?php if(isset($class_id) && $class_id==$class['class_id']) echo 'selected="selected"';?>>Class: <?php echo $class['name'];?></option>
                    <?php endforeach;?>
                    </select>
                  </div>
                 </div>


                  <div class="form-group">
                                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Student');?></label>
                                <div class="col-sm-12">

                                <?php $classes = $this->crud_model->get_classes();
                                        foreach ($classes as $key => $row): ?>

                                    <select name="<?php if($class_id == $row['class_id']) echo 'student_id'; else echo 'temp';?>" id="student_id_<?php echo $row['class_id'];?>" style="display:<?php if($class_id == $row['class_id']) echo 'block'; else echo 'none';?>"  class="form-control">
                                        <option value="">Student of: <?php echo $row['name'] ;?></option>

                                        <?php $students = $this->crud_model->get_students($row['class_id']);
                                        foreach ($students as $key => $student): ?>
                                        <option value="<?php echo $student['student_id'];?>"<?php if(isset($student_id) && $student_id == $student['student_id']) echo 'selected="selected"';?>><?php echo $student['name'];?></option>
                                        <?php endforeach;?>
                                    </select>
                                <?php endforeach;?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-sm-12">
                                    <select name="" id="student_id_0" style="display:<?php if(isset($student_id) && $student_id > 0) echo 'none'; else echo 'block';?>"  class="form-control">
                                        <option value=""><?php echo get_phrase('Select Class First');?></option>
                                    </select>
                                </div>
                            </div>
                            
                            <input class="" type="hidden" value="selection" name="operation">
                        <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-search"></i>&nbsp;<?php echo get_phrase('Browse');?></button>
                        </div>
                            
                    </form>                
                </div>                
            </div>
            </div>
            </div>

<?php if($class_id > 0 && $student_id > 0 && $exam_id > 0):?>

  <?php 

  $select_subject = $this->crud_model->get_subjects_by_class($class_id);

  foreach ($select_subject as $key => $subject) {
      
    $verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'student_id' => $student_id, 'subject_id' => $subject['subject_id']);

    $query = $this->db->get_where('mark', $verify_data);
    if($query->num_rows() < 1){
      $this->db->insert('mark', $verify_data);
    }

  }


  ?>

<div class="row">
  <div class="col-sm-12">
    <div class="panel panel-info">
            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('student_score'); ?></div>
                <div class="panel-body table-responsive">
                 
              <table cellpadding="0" cellspacing="0" border="0" class="table">
                <thead>
                  <tr>
                    <td><?php echo get_phrase('subject');?></td>
                    <td><?php echo get_phrase('1st score');?></td>
                    <td><?php echo get_phrase('2nd score');?></td>
                    <td><?php echo get_phrase('3rd score');?></td>
                    <td><?php echo get_phrase('exam score');?></td>
                    <td><?php echo get_phrase('comment');?></td>
                  </tr>
                </thead>
                            <tbody>


                               <?php 

  $select_subject = $this->crud_model->get_subjects_by_class($class_id);

  foreach ($select_subject as $key => $subject):
      
    $verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'student_id' => $student_id, 'subject_id' => $subject['subject_id']);

    $query = $this->db->get_where('mark', $verify_data);
    $update_subject_marks = $query->result_array();

    foreach ($update_subject_marks as $key => $update_marks):

  ?>
                      
                    
                      <?php echo form_open(base_url() . 'report/examMarkReport/' . $exam_id . '/' . $class_id);?>
                    <tr>
                      <td>
                        <?php echo $subject['name']; ?>
                      </td>
                      <td>
                       <?php echo $update_marks['class_score1'] ?>
                      </td>
                        <td>
                        <?php echo $update_marks['class_score2'] ?>
                      </td>
                        <td>
                         <?php echo $update_marks['class_score3'] ?>
                      </td>
                        <td>
                         <?php echo $update_marks['exam_score'] ?>
                      </td>
      
                      <td>
                        <?php echo $update_marks['comment'] ?>
                      </td>
                       <input type="hidden" name="mark_id_<?php echo $subject['subject_id'] ;?>" value="<?php echo $update_marks['mark_id'];?>" />
                        
                        <input type="hidden" name="exam_id" value="<?php echo $exam_id;?>" />
                        <input type="hidden" name="class_id" value="<?php echo $class_id;?>" />
                        <input type="hidden" name="student_id" value="<?php echo $student_id;?>" />
                        
                        <input type="hidden" name="operation" value="update_student_subject_score" />
                    </tr>
<?php 

  endforeach;
endforeach;

 ?>
                            
                          
                        </tbody>
               </table>

                 
                  <?php echo form_close();?>

                    <h3 align="center"> Student Score (Over 100)</h3>
                <div id="bar_chartdiv"></div>     
            
      </div>
        </div>
  </div>
 </div>

<?php endif; ?> 




<script type="text/javascript">
  
   function show_students(class_id){
            for(i=0;i<=50;i++){
                try{
                    document.getElementById('student_id_'+i).style.display = 'none' ;
                    document.getElementById('student_id_'+i).setAttribute("name" , "temp");
                }
                catch(err){}
            }
            if (class_id == "") {
                class_id = "0";
        }
        document.getElementById('student_id_'+class_id).style.display = 'block' ;
        document.getElementById('student_id_'+class_id).setAttribute("name" , "student_id");
        var student_id = $(".student_id");
        for(var i = 0; i < student_id.length; i++)
            student_id[i].selected = "";
    }
  </script>

  <style>
    #bar_chartdiv {
        width   : 100%;
        height    : 397px;
        font-size : 11px;
    } 
  .amcharts-chart-div a{
    display:none !important;
    }                 
</style>

   <script>
        var chart = AmCharts.makeChart("bar_chartdiv", {
            "theme": "light",
            "type": "serial",
            "startDuration": 2,
            "dataProvider": [
        
      <?php
        $get_subjects_by_class = $this->crud_model->get_subjects_by_class($class_id);

        foreach ($get_subjects_by_class as $key => $subject):

          $verify_data = array('exam_id' => $exam_id, 'class_id' => $class_id, 'student_id' => $student_id, 'subject_id' => $subject['subject_id']);

          $query = $this->db->get_where('mark', $verify_data);
          $update_subject_marks = $query->result_array();

          foreach($update_subject_marks as $key=>$sum_marks):

            $total_marks = $sum_marks['class_score1'] + $sum_marks['class_score2'] + $sum_marks['class_score3'];
        
      ?>

                  


                    {
                        "country": "<?php echo $subject['name']; ?>",
                        "visits": "<?php echo $total_marks; ?>",
                        "color": "#99BDF9"
                    },

            <?php endforeach;
                  endforeach;

             ?>
               
            ],
            "valueAxes": [{
                    "position": "left",
                    "title": "Student Score in Subject"
                }],
            "graphs": [{
                    "balloonText": "[[category]]: <b>[[value]]</b>",
                    "fillColorsField": "color",
                    "fillAlphas": 1,
                    "lineAlpha": 0.1,
                    "type": "column",
                    "valueField": "visits"
                }],
            "depth3D": 20,
            "angle": 30,
            "chartCursor": {
                "categoryBalloonEnabled": true,
                "cursorAlpha": 0,
                "zoomable": false
            },
            "categoryField": "country",
            "categoryAxis": {
                "gridPosition": "start",
                "labelRotation": 90,
                "position": "bottom",
                "title": "All Subjects",
            },
            "export": {
                "enabled": true
            }

        });
        jQuery('.chart-input').off().on('input change', function () {
            var property = jQuery(this).data('property');
            var target = chart;
            chart.startDuration = 0;

            if (property == 'topRadius') {
                target = chart.graphs[0];
                if (this.value == 0) {
                    this.value = undefined;
                }
            }

            target[property] = this.value;
            chart.validateNow();
        });
    </script>


   


