<?php 
$houses = $this->db->get_where('house', array('house_id' => $param2))->result_array();
foreach($houses as $key => $house):  ?>



<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-info">
            <div class="panel-heading">
				<?php echo get_phrase('Edit House');?></div>
                        <div class="panel-body">

                       <?php echo form_open(base_url() . 'studenthouse/studentHouse/update/'. $house['house_id'] , array('class' => 'form-horizontal form-groups-bordered validate', 'enctype' => 'multipart/form-data'));?>

 					<div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Name');?></label>

                    <div class="col-sm-12">
                            <input type="text" name="name" value="<?php echo $house['name'];?>" class="form-control">
                        </div>
                    </div>


                    <div class="form-group">
                 	<label class="col-md-12" for="example-text"><?php echo get_phrase ('Description');?></label>
                         <div class="col-sm-12">
                            <textarea class = "form-control" name = "description" rows = "5"> <?php echo $house['description']; ?> </textarea>
                        </div>
                    </div>

                     <div class="form-group">
                            <button type="submit" class="btn btn-info btn-block btn-rounded btn-sm"><i class="fa fa-plus"></i>&nbsp;&nbsp;Save</button>
                    </div>

                   
                        </div>
                    </div>

                   
			<?php echo form_close();?>
            </div>
		</div>
    </div>
</div>

<?php endforeach;?>