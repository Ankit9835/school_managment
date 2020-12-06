<?php 
$testimony = $this->db->get_where('testimony', array('testimony_id' => $param2))->result_array();
foreach($testimony as $key => $row):  ?>



<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
				<?php echo get_phrase('Update Status');?></div>
                        <div class="panel-body">

                        <?php echo form_open(base_url() . 'admin/websiteSetting/testimony/'. $row['testimony_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Status');?></label>
                    <div class="col-sm-12">
                    <select class="form-control select2" name="status">

                    <option value="1"<?php if ($row['status'] == '1') echo 'selected;' ?>><?php echo get_phrase('Available');?></option>
                    <option value="0"<?php if ($row['status'] == '0') echo 'selected;' ?>><?php echo get_phrase('Unavailable');?></option>
                    </select>

                        </div>
                    </div>

                    <div class="form-group">
							<button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Save</button>
					</div>
			<?php echo form_close();?>
            </div>
		</div>
    </div>
</div>

<?php endforeach;?>