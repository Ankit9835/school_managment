<div class="row">
                    <div class="col-sm-5">
                    <div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_request'); ?></div>

                <?php echo form_open(base_url(). 'student/studentBookRequest/insert', array('class' => 'form-horizontal form-goups-bordered validate')); ?>
                    <div class="panel-body table-responsive">
                    
                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('select_book');?></label>
                    <div class="col-sm-12">
                    
                        <select class="form-control" name = "book_id">
                            <?php
                                $select_book = $this->db->get_where('book',array('status' => '1'))->result_array();
                                foreach($select_book as $book):
                            ?>
                            <option value = "<?php echo $book['book_id']; ?>">
                                <?php echo $book['name']; ?>
                             </option>
                        <?php endforeach; ?>
                        </select>    
                        
                                </div>

               
                            </div>
                            
                         <input type="hidden" name="student_id" value = "<?php echo $this->db->get_where('student',array('student_id' => $this->session->userdata('login_user_id')))->row()->student_id; ?>">

                         <input type="hidden" name="request_date" value = "<?php echo date('m/d/Y'); ?>"> 
                            
                    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('return_date');?></label>
                    <div class="col-sm-12">
                    <input class="form-control m-r-10" name="return_date" type="date" value="" id="example-date-input" required>
                                </div>
                            </div>
                            
                           <div class="form-group">
                                  <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('add_book');?></button>
                            </div>
                            <?php echo form_close(); ?>
               
                </div>                
            </div>
            </div>
            <!----CREATION FORM ENDS-->
    
 <div class="col-sm-7">
                    <div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('book_request'); ?></div>
                            


<div class="panel-wrapper collapse in" aria-expanded="true">
                                <div class="panel-body table-responsive">
            
                                <table id="example23" class="display nowrap" cellspacing="0" width="100%">
                <thead>

                
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo get_phrase('book_name');?></div></th>
                            <th><div><?php echo get_phrase('request_date');?></div></th>
                            <th><div><?php echo get_phrase('return_date');?></div></th>
                            <th><div><?php echo get_phrase('status');?></div></th>
                            
                        </tr>
                  
                    </thead>
                    <tbody>
                        <?php 

                            $book_request = $this->db->get_where('book_request',array('student_id' => $this->session->userdata('login_user_id')))->result_array();
                            $count = 1;
                            foreach($book_request as $request):

                        ?>
                        <tr>
                            <td> <?php echo $count++; ?> </td>
                            <td> <?php
                                echo $this->db->get_where('book',array('book_id' => $request['book_id']))->row()->name;
                             ?> </td>
                             <td>
                                <?php
                                    echo date("d M, Y",$request['request_date']);
                                ?>

                            </td>
                            <td>
                                <?php
                                    echo date("d M, Y",$request['return_date']);
                                ?>

                            </td>
                            <td>
                                
                               <span class="label label-<?php if($request['status'] == '1') echo 'success'; else if($request['status'] == '2') echo 'danger'; else echo 'warning';?>">
                            <?php if($request['status'] == '1'):?>
                            <?php echo 'available';?>
                            <?php endif;?>
                            <?php if($request['status'] == '2'):?>
                            <?php echo 'pending';?>
                            <?php endif;?>
                            <?php if($request['status'] == '3'):?>
                            <?php echo 'disapproved';?>
                            <?php endif;?>
                            </span>

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
            