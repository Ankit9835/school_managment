
<?php echo form_open(base_url() . 'admin/payroll_selector'); ?>
    
   	<div class="row">
                    <div class="col-sm-12">
				  	<div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('create_payroll'); ?></div>
                               <div class="panel-body table-responsive">
							   
				<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('department');?></label>
                    <div class="col-sm-12">
                <select name="department_id" class="form-control select2" onchange="get_employees(this.value);" required>
                    <option value=""><?php echo get_phrase('select_a_department'); ?></option></option>
                    <?php
                        $department = $this->db->get('department')->result_array();
                        foreach ($department as $key => $department):
                    ?>

                    <option value = "<?php echo $department['department_id'] ?>"> <?php echo $department['name']; ?> </option>

                    <?php endforeach; ?>
                   
                </select>
            </div>
        </div>
        
        <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('employee');?></label>
                    <div class="col-sm-12">
                <select name="employee_id" class="form-control" id="employee_holder" required>
                  
                        <!-- <option value=""> </option> -->
                
                </select>
            </div>
        </div>
        
       <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('month');?></label>
                    <div class="col-sm-12">
                <select name="month" class="form-control select2" required>
                    <option value=""><?php echo get_phrase('select_a_month'); ?></option>
                    <?php
                        for($i = 1; $i <=12; $i++):
                            if($i == 1){
                                $m = get_phrase('january');
                            } elseif($i == 2){
                                $m = get_phrase('february');
                            } elseif($i == 3){
                                $m = get_phrase('march');
                            } elseif($i == 4){
                                $m = get_phrase('april');
                            } elseif($i == 5){
                                $m = get_phrase('may');
                            } elseif($i == 6){
                                $m = get_phrase('june');
                            } elseif($i == 7){
                                $m = get_phrase('july');
                            } elseif($i == 8){
                                $m = get_phrase('august');
                            } elseif($i == 9){
                                $m = get_phrase('september');
                            } elseif($i == 10){
                                $m = get_phrase('october');
                            } elseif($i == 11){
                                $m = get_phrase('november');
                            } elseif($i == 12){
                                $m = get_phrase('december');
                            }
                    ?>
                        <option value="<?php echo $i; ?>"> <?php echo $m; ?> </option>
                        
                    <?php endfor; ?>
                  
                </select>
            </div>
        </div>
        
       <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase('year');?></label>
                    <div class="col-sm-12">
                <select name="year" class="form-control select2" required>
                    <option value=""><?php echo get_phrase('select_a_year'); ?></option>
                        <?php
                            for($i = 2020; $i <= 2036; $i++):


                        ?>
                        <option value="<?php echo $i; ?>"> <?php echo $i; ?> </option>
                   <?php endfor;  ?>
                </select>
            </div>
        </div>

        <div class="form-group">
						
        <button type="submit" class="btn btn-info btn-rounded btn-block btn-sm "><i class="fa fa-search"></i>&nbsp;<?php echo get_phrase('browse'); ?></button>
		</div>


<?php echo form_close(); ?>
<hr>

<script type="text/javascript">
        
    function get_employees(department_id)
    {
        if(department_id != '')
            $.ajax({
                url     : '<?php echo base_url(); ?>admin/get_employees/' + department_id,
                success : function(response)
                {
                    jQuery('#employee_holder').html(response);
                }
            });
        else
            jQuery('#employee_holder').html('<option value=""><?php echo get_phrase("Select Department"); ?></option>');
    }

</script>