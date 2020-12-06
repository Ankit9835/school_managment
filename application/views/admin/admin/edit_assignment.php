<?php $edit_assignment = $this->db->get_where('assignment', array('assignment_id' => $param2))->result_array();
        foreach($edit_assignment as $key => $row){ ?>
    <div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-edit"></i>&nbsp;&nbsp;<?php echo get_phrase('edit_assignment'); ?></div>
										<div class="panel-body table-responsive">
                    <?php echo form_open(site_url('assignment/assignment/update/' . $param2), array('class' => 'form-horizontal form-groups-bordered validate',
                        'enctype' => 'multipart/form-data')); ?>

                        <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" value = "<?php echo $row['name'] ?>" / required>
                        </div>
                    </div>


                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('class');?></label>
                    <div class="col-sm-12">
                    <select name="class_id" id="class_id" class="form-control select2" onchange="return get_class_subject(this.value)">
                    <option value=""><?php echo get_phrase('select_class');?></option>

                    <?php $class =  $this->db->get('class')->result_array();
                    foreach($class as $key => $class):?>
                    <option value="<?php echo $class['class_id'];?>"<?php if($class['class_id'] == $row['class_id']) echo 'selected'; ?>><?php echo $class['name'];?></option>
                    <?php endforeach;?>
                   </select>

                  </div>
                 </div>

                                
                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('subject');?></label>
                    <div class="col-sm-12">
                    <select name="subject_id" class="form-control" id="subject_selector_holder">
                    <option value=""><?php echo get_phrase('select_subject');?></option>
                    </select>
                  </div>
                 </div>


                        <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('select_date');?></label>
                    <div class="col-sm-12">

                    <input type="date" name="timestamp" value="2018-08-19" class="form-control datepicker" id="example-date-input" value = "<?php echo $row['timestamp'] ?>" required>
                   
                    </div>
                </div>

               <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('select_teacher');?></label>
                    <div class="col-sm-12">
                       
                       <select name="teacher_id" class="form-control select2" style="width:100%;" required>
                                        <option value=""><?php echo get_phrase('select');?></option>

                           <?php $teacher =  $this->db->get('teacher')->result_array();
                                    foreach($teacher as $key => $teacher):?>            
                                            <option value="<?php echo $teacher['teacher_id'];?>" <?php if($teacher['teacher_id'] == $row['teacher_id']) echo 'selected'; ?>><?php echo $teacher['name'];?></option>
                            <?php endforeach;?>
                                     
                                    </select>              
                        
                        
                    </div> 
                </div>


                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('file_type');?></label>
                    <div class="col-sm-12">
                       
                       <select name="file_type" class="form-control select2" style="width:100%;">
                                        <option value=""><?php echo get_phrase('file_type');?></option>

                           
                                            <option value="pdf">PDF</option>
                                            <option value="xlsx">Excel</option>
                                            <option value="docx">Word Document</option>
                                            <option value="img">Image</option>
                                            <option value="txt">Text File</option>
                          
                                     
                                    </select>              
                        
                        
                    </div> 
                </div>


                
                
                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('description');?></label>
                    <div class="col-sm-12">
                                <textarea  name="description" class="form-control textarea_editor">
                                    <?php echo $row['description']; ?>
                                </textarea>
                            </div>
                        </div>
                
                
                            
                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('select_document');?></label>
                    <div class="col-sm-12">
                    <input type="file" name="file_name" class="dropify">
                    <input type="hidden" name="old_image" value = " <?php echo $row['file_name']; ?>">
                    <img src="<?php echo base_url() ?>uploads/assignment/<?php echo $row['file_name']; ?>" width = "60px" height = "60px">
                    </div></div>
                            
                        

                    
                    <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-sm btn-rounded"> <i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add_assignment');?></button>
                    </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </div>
    </div>

<?php } ?>


<script type="text/javascript">

    $( document ).ready(function() {

        // SelectBoxIt Dropdown replacement
        if($.isFunction($.fn.selectBoxIt))
        {
            $("select.selectboxit").each(function(i, el)
            {
                var $this = $(el),
                    opts = {
                        showFirstOption: attrDefault($this, 'first-option', true),
                        'native': attrDefault($this, 'native', false),
                        defaultText: attrDefault($this, 'text', ''),
                    };
                    
                $this.addClass('visible');
                $this.selectBoxIt(opts);
            });
        }

    });

</script>