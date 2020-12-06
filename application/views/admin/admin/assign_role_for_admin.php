<?php

    $select_role = array('admin_id' => $param2);


    $query_admin_role_table = $this->db->get_where('admin_role', $select_role);
   
    if($query_admin_role_table->num_rows() < 1){
        $this->db->insert('admin_role', $select_role);
    }

?>



<?php

    $admin_role = $this->db->get_where('admin', array('admin_id' => $param2))->result_array();
    foreach ($admin_role as $key => $admin):
        
    
?>

<div class="col-sm-12">
	<div class="panel panel-info">
    <div class="panel-heading"> <i class="fa fa-list"></i>&nbsp;&nbsp;<?php echo get_phrase('Assign Role For:');?><?php echo $admin['name'] ?></div>
        <div class="panel-body table-responsive">
             <?php echo form_open(base_url() . 'admin/updateAdminRole/'. $param2, array('class' => 'form-horizontal form-goups-bordered validate'));?>
            <table class="display nowrap" cellspacing="0" width="100%">
                <tr>
                    <td>dashboard</td>
                    <td>Manage Academics </td>
                    <td>Manage Employee </td>
                    <td>Manage Student </td>
                </tr>
                <tr>
                    <td><input class="check" name="dashboard" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->dashboard) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="manage_academics" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->manage_academics) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="manage_employee" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->manage_employee) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="manage_student" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->manage_student) echo 'checked'; ?> type="checkbox"></td>
                </tr>
                <tr>
                    <td>Manage Attendance</td>
                    <td>Download Page</td>
                    <td>Manage Parent</td>
                    <td>Manage Alumni </td>
                </tr>
                <tr>
                    <td><input class="check" name="manage_attendance" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->manage_attendance) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="download_page" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->download_page) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="manage_parent" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->manage_parent) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="manage_alumni" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->manage_alumni) echo 'checked'; ?> type="checkbox"></td> 
                </tr>
                 <tr>
                    <td>Manage Loan</td>
                    <td>Class Information</td>
                    <td>Manage Subject</td>
                    <td>Manage Exam</td>
                </tr>
                <tr>
                    <td><input class="check" name="manage_loan" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->manage_loan) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="class_information" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->class_information) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="manage_subject" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->manage_subject) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="manage_exam" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->manage_exam) echo 'checked'; ?> type="checkbox"></td> 
                </tr>
                 <tr>
                    <td>Report Card</td>
                    <td>Fee Collection</td>
                    <td>Human Resource</td>
                    <td>Expense</td>
                </tr>
                <tr>
                    <td><input class="check" name="report_card" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->report_card) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="fee_collection" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->fee_collection) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="human_resource" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->human_resource) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="expense" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->expense) echo 'checked'; ?> type="checkbox"></td> 
                </tr>
                 <tr>
                    <td>Manage Library</td>
                    <td>Hostel Information</td>
                    <td>Communication</td>
                    <td>Transport</td>
                </tr>
                <tr>
                    <td><input class="check" name="manage_library" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->manage_library) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="hostel_information" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->hostel_information) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="communication" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->communication) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="transport" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->transport) echo 'checked'; ?> type="checkbox"></td> 
                </tr>
                 <tr>
                    <td>System Setting</td>
                    <td>General Report</td>
                    <td>Role Managment</td>
                    
                </tr>
                <tr>
                    <td><input class="check" name="system_setting" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->system_setting) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="general_report" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->general_report) echo 'checked'; ?> type="checkbox"></td>
                    <td><input class="check" name="role_managment" value="1" <?php if($this->db->get_where('admin_role', array('admin_id' => $param2))->row()->role_managment) echo 'checked'; ?> type="checkbox"></td>
                    
                </tr>


                
            </table>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-info btn-rounded btn-sm "><i class="fa fa-plus"></i>&nbsp;<?php echo get_phrase('update');?></button>
            </div>
        </form>
        </div>
	</div>
</div>
<?php endforeach; ?>