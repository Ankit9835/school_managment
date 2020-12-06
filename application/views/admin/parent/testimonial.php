<div class="row">
                    <div class="col-sm-12">
                    <div class="panel panel-info">
                            <div class="panel-heading"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add_testimony'); ?></div>
                                        <div class="panel-body table-responsive">


        <?php echo form_open(base_url(). 'parents/testimony/submit_testimony' , array('class' => 'form-horizontal form-groups-bordered validate'));?>

<!----CREATION FORM STARTS---->

    <div class="form-group">
                    <label class="col-md-12" for="example-text"><?php echo get_phrase('content');?></label>
                    <div class="col-sm-12">
                    
                       <textarea class="form-control" name = "content" rows = "5"></textarea>   
                            
                    </div>
                </div>
                            
                            
                       
                            
                           
          
                            
                           <div class="form-group">
                                  <button type="submit" class="btn btn-info btn-sm btn-block btn-rounded"> <i class="fa fa-plus"></i>&nbsp;&nbsp;<?php echo get_phrase('add');?></button>
                            </div>
                    <?php echo form_close();?>            
                
                </div>                
            </div>
        </div>
            <!----CREATION FORM ENDS-->
        

            </div>
            <!----TABLE LISTING ENDS--->
            