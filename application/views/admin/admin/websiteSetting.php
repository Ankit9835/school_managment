
<div class="row">
    <div class="col-sm-12">
		<div class="panel panel-info">
                <div class="panel-body table-responsive">

                            <section class="m-t-40">
                                <div class="sttabs tabs-style-linetriangle">
                                    <nav>
                                        <ul>
                                            <li><a href="#section-linetriangle-1"><span>Website Settings</span></a></li>
                                            <li><a href="#section-linetriangle-2"><span>Upload Banner</span></a></li>
                                            <li><a href="#section-linetriangle-3"><span>Testimonies</span></a></li>
                                            <li><a href="#section-linetriangle-4"><span>Subscriber</span></a></li>
                                            <li><a href="#section-linetriangle-5"><span>Contact Us</span></a></li>
                                        </ul>
                                    </nav>
                                    <div class="content-wrap">
                                        <section id="section-linetriangle-1">
                                            <h3>Website Settings</h3>
                                            <?php echo form_open(base_url() . 'admin/websiteSetting/generalsetting' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top'));?>
                            
                            
                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('about_us');?></label>
                            <div class="col-sm-12">
                                <textarea id = "mymce" name = "about">
                                    <?php 
                                        echo $this->db->get_where('website_settings',array('type' => 'about_us'))->row()->description;
                                    ?>
                                 </textarea> 
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('video_link');?></label>
                            <div class="col-sm-12">
                               <textarea name = "video" class="form-control">
                                   <?php 
                                        echo $this->db->get_where('website_settings',array('type' => 'video_link'))->row()->description;
                                    ?>
                               </textarea>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('mission');?></label>
                            <div class="col-sm-12">
                                <textarea name = "mission" class="form-control">
                                    <?php 
                                        echo $this->db->get_where('website_settings',array('type' => 'mission'))->row()->description;
                                    ?>
                                </textarea>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('vision');?></label>
                            <div class="col-sm-12">
                                <textarea name = "vision" class="form-control">
                                    <?php 
                                        echo $this->db->get_where('website_settings',array('type' => 'vision'))->row()->description;
                                    ?>
                                </textarea>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('goal');?></label>
                            <div class="col-sm-12">
                                <textarea name = "goal" class="form-control">
                                    <?php 
                                        echo $this->db->get_where('website_settings',array('type' => 'goal'))->row()->description;
                                    ?>
                                </textarea>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('testimony_message');?></label>
                            <div class="col-sm-12">
                               <textarea name = "testimony" class="form-control">
                                   <?php 
                                        echo $this->db->get_where('website_settings',array('type' => 'testimony_message'))->row()->description;
                                    ?>
                               </textarea>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('map_code');?></label>
                            <div class="col-sm-12">
                                <textarea name = "map_code" class="form-control">
                                    <?php 
                                        echo $this->db->get_where('website_settings',array('type' => 'map_code'))->row()->description;
                                    ?>
                                </textarea>
                            </div>
                        </div>

                         <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
                    </div>
                            
                    </form> 
                                        </section>
                                        <section id="section-linetriangle-2">
                                            <h2>
                                                
                                                <?php echo form_open(base_url() . 'admin/websiteSetting/bannersetting' , array('class' => 'form-horizontal form-groups-bordered validate','target'=>'_top','enctype'=>'multipart/form-data'));?>
                            
                            
                        <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('banner_image');?></label>
                            <div class="col-sm-12">
                                <input type="file" name="banner_image" class = "dropify">
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-12" for="example-text"><?php echo get_phrase('banner_text');?></label>
                            <div class="col-sm-12">
                                <input type="text" name="banner_text" class="form-control">
                            </div>
                        </div>

                          <div class="form-group">
                    <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('save');?></button>
                    </div>

                    </form>

                   
            
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo get_phrase('banner_image');?></div></th>
                            <th><div><?php echo get_phrase('banner_text');?></div></th>
                            
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
                <?php
                $banners = $this->db->get('banners')->result_array();

               $count = 1;  foreach($banners as $key => $banner):

                ?>
                        <tr>
                            <td><?php echo $count++;?></td>
                            <td><img src="<?php echo base_url() ?>uploads/banner_image/<?php echo $banner['banner_image']; ?>" width = "50px" height = "50px"></td>
                            <td> <?php echo $banner['banner_text'] ?> </td>
                            <td>
                            
                            <a onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_circular/<?php echo $circular['circular_id'];?>')" class="btn btn-info btn-circle btn-xs"><i class="fa fa-edit"></i></a>
                            <a href="<?php echo base_url();?>admin/circular/delete/<?php echo $circular['circular_id'];?>" onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
                            
                            </td>
                        </tr>
                <?php endforeach;?>
                    </tbody>
                </table>
            
                                            </h2></section>
                                        <section id="section-linetriangle-3">
                                            
                                                
                                            <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            
                            <th><div><?php echo get_phrase('parent_name');?></div></th>
                            <th><div><?php echo get_phrase('content');?></div></th>
                            <th><div><?php echo get_phrase('status');?></div></th>
                            <th><div><?php echo get_phrase('action');?></div></th>
                            
                        </tr>
                    </thead>
                    <tbody>
    
                    <?php $counter = 1; $testimony =  $this->db->get('testimony')->result_array();
                    foreach($testimony as $key => $row):?>         
                        <tr>
                            <td><?php echo $counter++;?></td>
                            <td><?php echo $this->db->get_where('parent',array('parent_id' => $row['parent_id']))->row()->name; ?></td>
                            <td><?php echo $row['content'];?></td>
                           
                            <td>
                            <span class="label label-<?php if($row['status']== 'available') echo 'success'; else echo 'warning';?>">

                                <?php

                                    if($row['status'] == '1') echo 'Available'; else echo 'Declined';

                                ?>

                           </span></td>
                            
                            <td>
                            
                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/testimony_status/<?php echo $row['testimony_id'];?>');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a>

                    <a href="<?php echo base_url();?>admin/websiteSetting/testimony_delete/<?php echo $row['testimony_id'];?>" onclick="return confirm('Are you sure want to delete?');" class="btn btn-danger btn-circle btn-xs" style="color:white"><i class="fa fa-times"></i></a>
                    
                            </td>
                        </tr>
    <?php endforeach;?>
                    </tbody>
                </table>

                                            </section>
                                        <section id="section-linetriangle-4">
                                            <h2>Tabbing 4</h2></section>
                                        <section id="section-linetriangle-5">
                                            <h2>Tabbing 5</h2></section>
                                    </div>
                                    <!-- /content -->
                                </div>
                                <!-- /tabs -->
                            </section>
            </div>
        </div>
    </div>
</div>
