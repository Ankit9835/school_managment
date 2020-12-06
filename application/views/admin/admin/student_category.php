 <div class="row">
                    <div class="col-sm-5">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_student_category');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'studentcategory/studentCategory/insert' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" / required>
                                </div>
                            </div>

								<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('description');?></label>
                    <div class="col-sm-12">
                                   <textarea class="form-control" rows="3" name = "description"></textarea>
                                </div>
                            </div>

								
							
                        <div class="form-group">
                                  <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;<?php echo get_phrase('add');?></button>
							</div>
							
                    </form>                
                </div>                
			</div>
			</div>
			</div>
			<!----CREATION FORM ENDS-->

                    <div class="col-sm-7">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('list_student_category');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
				
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('name');?></div></th>
                    		<th><div><?php echo get_phrase('description');?></div></th>
                    		
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    <?php

                        $category = $this->db->get('student_category')->result_array();
                        $count = 1;
                        foreach ($category as $key => $cat):
                        
                    ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
							<td><?php echo $cat['name']; ?></td>
							<td><?php echo $cat['description']; ?></td>
							
                            
                            <td>

                                 <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_student_category/<?php echo $cat['student_category_id'];?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>

                                <a href="#" onclick="confirm_modal('<?php echo base_url();?>Studentcategory/studentCategory/delete/<?php echo $cat['student_category_id'];?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
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
            