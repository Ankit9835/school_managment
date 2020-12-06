 <div class="row">
                    <div class="col-sm-5">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_class');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/classes/insert' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" / required>
                                </div>
                            </div>

								<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name_numeric');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name_numeric"/ required>
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
                                  <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;<?php echo get_phrase('add_class');?></button>
							</div>
							
                    </form>                
                </div>                
			</div>
			</div>
			</div>
			<!----CREATION FORM ENDS-->

                    <div class="col-sm-7">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('list_class');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
				
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('class_name');?></div></th>
                    		<th><div><?php echo get_phrase('numeric_name');?></div></th>
                    		<th><div><?php echo get_phrase('teacher');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    <?php

                        $classes = $this->db->get('class')->result_array();
                        $count = 1;
                        foreach ($classes as $key => $class):
                        
                    ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
							<td><?php echo $class['name']; ?></td>
							<td><?php echo $class['name_numeric']; ?></td>
							<td><?php echo $this->db->get_where('teacher', array('teacher_id' => $class['teacher_id']))->row()->name; ?></td>
							 <td>
                            
                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_class/<?php echo $class['class_id'];?>');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a>
                     <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/classes/delete/<?php echo $class['class_id'];?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                     
            
                           
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
				</div>
			</div>
		</div>
	</div>
</div>
			
            <!----TABLE LISTING ENDS--->
            