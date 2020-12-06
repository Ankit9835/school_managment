


<div class="row">
                    <div class="col-sm-5">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_admin'); ?></div>

                <?php echo form_open(base_url(). 'admin/admin_add/insert', array('class' => 'form-horizontal form-goups-bordered validate')); ?>
					<div class="panel-body table-responsive">
					
					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('name');?></label>
                    <div class="col-sm-12">
					
                            
                                    <input name="name" type="text" class="form-control"/ required>
                                </div>
                            </div>


                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('email');?></label>
                    <div class="col-sm-12">
                    
                            
                                    <input name="email" type="email" class="form-control"/ required>
                                </div>
                            </div>


                      <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('phone');?></label>
                    <div class="col-sm-12">
                    
                            
                                    <input name="phone" type="text" class="form-control"/ required>
                                </div>
                            </div>

                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('Select Role');?></label>
                    <div class="col-sm-12">
                    
                            <select class = "form-control" name = "level">
                                
                                <option value = "1"> Super Admin </option>
                                <option value = "2"> Normal Admin </option>

                            </select>
                                </div>
                            </div>

                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('password');?></label>
                    <div class="col-sm-12">    
                        <input name="password" type="password" class="form-control"/ required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('image');?></label>
                    <div class="col-sm-12">    
                        <input name="userfile" type="file" class="form-control"/ required>
                    </div>
                </div>


							
							
							
					
                            
                           <div class="form-group">
                                  <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add_admin');?></button>
							</div>
                            <?php echo form_close(); ?>
               
                </div>                
			</div>
			</div>
			<!----CREATION FORM ENDS-->
	
 <div class="col-sm-7">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('list_admin'); ?></div>
							


<div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
			
 								<table id="example23" class="display nowrap" cellspacing="0" width="100%">
				<thead>

                
                		<tr>
                    		<th><div>#</div></th>
                            <th><div><?php echo get_phrase('name');?></div></th>
                            <th><div><?php echo get_phrase('email');?></div></th>
                            <th><div><?php echo get_phrase('phone');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
						</tr>
                  
					</thead>
                    <tbody>
                       <?php

                        $admins = $this->db->get('admin')->result_array();
                        $count = 1;
                        foreach ($admins as $key => $admin):
                           
                       ?>
                        <tr>
                            <td> <?php echo $count++; ?> </td>
                            <td> <?php echo $admin['name']; ?>  </td>
                            <td><?php echo $admin['email']; ?></td>
							<td><?php echo $admin['phone']; ?></td>
							
							<td>

                                <?php

                                    if($admin['level'] == '2'):

                                ?>

                             <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/assign_role_for_admin/<?php echo $admin['admin_id'];?>')" class="btn btn-info btn-rounded btn-xs">Assign Role <i class="fa fa-edit"></i></a>
                            <a href="<?php echo base_url();?>admin/newAdministrator/delete/<?php echo $all_selected_administrator['admin_id'];?>" onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
                            
                            <?php endif; ?>
                            
                            
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
			