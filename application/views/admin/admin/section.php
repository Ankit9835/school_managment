 <div class="row">
                    <div class="col-sm-5">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_section');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/section/insert' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" / required>
                                </div>
                            </div>

								<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('nick_name');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="nick_name"/ required>
                                </div>
                            </div>

								
								<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('class');?></label>
                    <div class="col-sm-12">
                                    <select name="class_id" class="form-control select2" required>
                                     <option value=""><?php echo get_phrase('select_class');?></option>
                                     <?php
                                        $classes = $this->db->get('class')->result_array();
                                        foreach ($classes as $key => $class) {
                                     ?>
                                        <option value="<?php echo $class['class_id'] ?>">
                                            
                                            <?php echo $class['name']; ?>

                                        </option>

                                <?php } ?>
                                    </select>
                            </div>
                        </div>

                        <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('teacher');?></label>
                    <div class="col-sm-12">
                                    <select name="teacher_id" class="form-control select2" required>
                                     <option value=""><?php echo get_phrase('select_teacher');?></option>
                                     <?php
                                        $teachers = $this->db->get('teacher')->result_array();
                                        foreach ($teachers as $key => $teacher) {
                                     ?>
                                        <option value="<?php echo $teacher['teacher_id'] ?>">
                                            
                                            <?php echo $teacher['name']; ?>

                                        </option>

                                <?php } ?>
                                    </select>
                            </div>
                        </div>
                        <div class="form-group">
                                  <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;<?php echo get_phrase('add_section');?></button>
							</div>
							
                    </form>                
                </div>                
			</div>
			</div>
			</div>
			<!----CREATION FORM ENDS-->

                    <div class="col-sm-7">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('list_section');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">

                        <div class="tabs-vertical-env">
                        <ul class="nav tabs-vertical">

                        <?php $classess =  $this->db->get('class')->result_array();
                        foreach($classess as $key => $classess):?>  

                        <li class="<?php if($classess['class_id']== $class_id) echo 'active';?>">

                            <a class="btn btn-info btn-rounded btn-sm" href="<?php echo base_url();?>admin/sections/<?php echo $classess['class_id'];?>" style="color:white">

                                <?php echo get_phrase('class');?>: <?php echo $classess['name'];?>
                            </a>

                        </li>  
                        <?php endforeach;?>  
                        </ul>
                        <hr>
				
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('name');?></div></th>
                    		<th><div><?php echo get_phrase('nick_name');?></div></th>
                    		
                    		<th><div><?php echo get_phrase('teacher');?></div></th>
                            <th><div><?php echo get_phrase('option');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    <?php

                       
                        $count = 1;
                        $sections =  $this->db->get_where('section', array('class_id' => $class_id))->result_array();
                        foreach ($sections as $key => $section):
                        
                    ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
							<td><?php echo $section['name']; ?></td>
							<td><?php echo $section['nick_name']; ?></td>
							
                            <td><?php echo $this->db->get_where('teacher', array('teacher_id' => $section['teacher_id']))->row()->name; ?></td>
							 <td>
                            
                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_section/<?php echo $section['section_id'];?>');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a>
                     <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/section/delete/<?php echo $section['section_id'];?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                     
            
                           
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
				</div> </div>
			</div>
		</div>
	</div>
</div>
			
            <!----TABLE LISTING ENDS--->
            