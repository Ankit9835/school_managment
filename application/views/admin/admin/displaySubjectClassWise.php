
<table id="example" class="table display">
                    <thead>
                        <tr>
                            <th><div>#</div></th>
                            <th><div><?php echo get_phrase('class_name');?></div></th>
                            <th><div><?php echo get_phrase('subject_name');?></div></th>
                            <th><div><?php echo get_phrase('teacher');?></div></th>
                            <th><div><?php echo get_phrase('options');?></div></th>
                        </tr>
                    </thead>
                    <tbody>
    
                    <?php $counter = 1; $subjects =  $this->db->get_where('subject', array('class_id' => $class_id))->result_array();
                    foreach($subjects as $key => $subjects):?>         
                        <tr>
                            <td><?php echo $counter++;?></td>
                            <td><?php echo $this->db->get_where('class', array('class_id' => $subjects['class_id']))->row()->name;  ?></td>
                            <td><?php echo $subjects['name'];?></td>
                            <td> <?php echo $this->db->get_where('teacher', array('teacher_id' => $subjects['teacher_id']))->row()->name; ?> </td>
                            <td>
                            
                    <a href="#" onclick="showAjaxModal('<?php echo base_url();?>modal/popup/edit_subject/<?php echo $subjects['subject_id'];?>');"><button type="button" class="btn btn-info btn-circle btn-xs"><i class="fa fa-pencil"></i></button></a>
                     <a href="#" onclick="confirm_modal('<?php echo base_url();?>subject/subject/delete/<?php echo $subjects['subject_id'];?>');"><button type="button" class="btn btn-danger btn-circle btn-xs"><i class="fa fa-times"></i></button></a>
                     
            
                           
                            </td>
                        </tr>
    <?php endforeach;?>
                    </tbody>
                </table>