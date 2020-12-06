 <div class="row">
                    <div class="col-sm-5">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_dormitory');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
<!----CREATION FORM STARTS---->

                	<?php echo form_open(base_url() . 'admin/dormitory/insert' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-12">
                                    <input type="text" class="form-control" name="name" / required>
                                </div>
                            </div>

								    
                                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('hostel_category');?></label>
                    <div class="col-sm-12">
                                    <select name="hostel_category_id" class="form-control select2" required>
                                     <option value=""><?php echo get_phrase('select_category');?></option>
                                     <?php
                                       $hostel_category = $this->db->get('hostel_category')->result_array();

                                        foreach ($hostel_category as $key => $hostel_category) {
                                     ?>
                                        <option value="<?php echo $hostel_category['hostel_category_id'] ?>">
                                            
                                            <?php echo $hostel_category['name']; ?>

                                        </option>

                                <?php } ?>
                                    </select>
                            </div>
                        </div>

                          <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('hostel_room');?></label>
                    <div class="col-sm-12">
                                    <select name="hostel_room_id" class="form-control select2" required>
                                     <option value=""><?php echo get_phrase('hostel_room');?></option>
                                     <?php
                                        $hostel_room = $this->db->get('hostel_room')->result_array();
                                        foreach ($hostel_room as $key => $hostel_room) {
                                     ?>
                                        <option value="<?php echo $hostel_room['hostel_room_id'] ?>">
                                            
                                            <?php echo $hostel_room['name']; ?>

                                        </option>

                                <?php } ?>
                                    </select>
                            </div>
                        </div>

                        <div class="form-group">
                             <label class="col-md-12" for="example-text"><?php echo get_phrase('capacity');?></label>
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="capacity" / required>
                            </div>
                        </div>

                        <div class="form-group">
                             <label class="col-md-12" for="example-text"><?php echo get_phrase('address');?></label>
                            <div class="col-sm-12">
                                <textarea class="form-control" name = "address" rows = "5"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                             <label class="col-md-12" for="example-text"><?php echo get_phrase('description');?></label>
                            <div class="col-sm-12">
                                <textarea class="form-control" name = "description" rows = "5"></textarea>
                            </div>
                        </div>


								
						
                        <div class="form-group">
                                  <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-book"></i>&nbsp;<?php echo get_phrase('add_dormitory');?></button>
							</div>
							
                    </form>                
                </div>                
			</div>
			</div>
			</div>
			<!----CREATION FORM ENDS-->

                    <div class="col-sm-7">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('list_dormitory');?></div>
                            <div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
				
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">
                	<thead>
                		<tr>
                    		<th><div>#</div></th>
                    		<th><div><?php echo get_phrase('name');?></div></th>
                    		<th><div><?php echo get_phrase('hostel_room');?></div></th>
                    		<th><div><?php echo get_phrase('hostel_category');?></div></th>
                            <th><div><?php echo get_phrase('capacity');?></div></th>
                            <th><div><?php echo get_phrase('address');?></div></th>
                    		<th><div><?php echo get_phrase('options');?></div></th>
						</tr>
					</thead>
                    <tbody>
                    <?php

                        $dormitory = $this->db->get('dormitory')->result_array();
                        $count = 1;
                        foreach ($dormitory as $key => $dormitory):
                        
                    ?>
                        <tr>
                            <td><?php echo $count++; ?></td>
							<td><?php echo $dormitory['name']; ?></td>
							<td><?php echo $this->db->get_where('hostel_room', array('hostel_room_id' => $dormitory['hostel_room_id']))->row()->name ?></td>
							=<td><?php echo $this->db->get_where('hostel_category', array('hostel_category_id' => $dormitory['hostel_category_id']))->row()->name ?></td>
                            <td><?php echo $dormitory['capacity']; ?></td>
                            <td><?php echo $dormitory['address']; ?></td>
                    <td>
                            
                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_dormitory/<?php echo $dormitory['dormitory_id'];?>');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a>
                     <a href="#" onclick="confirm_modal('<?php echo base_url();?>admin/dormitory/delete/<?php echo $dormitory['dormitory_id'];?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                     
            
                           
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
            