
<div class="row">
  <div class="col-sm-12">
  	<div class="panel panel-info"> 
  		<div class="panel-body"> 

  			<?php

  				$class = $this->db->get_where('class',array(
  					'class_id' => $class_id))->row()->name;

  				$students = $this->crud_model->get_students($class_id);

  				foreach ($students as $key => $student):
  					
  					$student_id = $student['student_id'];
  					$name = $student['name'];
  					$roll = $student['roll'];
  					$sex = $student['sex'];

  					$total_marks_score = 0;
  					$total_class_score = 0;
  					$total_grade_score = 0;
  			?>


					<div class="print" style="border:1px solid #000; padding-left:5px; padding-right:5px; padding-bottom:5px; padding-top:5px;">   
						<div class="printableArea">     
		
								<table width="1000" border="0">
								  <tr>
									<td>
										<div class="col-md-2">
											<img src = "<?php echo base_url() ?>uploads/logo.png" width = "100px" height = "100px">
										</div>
											<div class="col-md-8" style="text-align: center;">
												<div class="tile-stats tile-white tile-white-primary">
													<span style="text-align: center;font-size: 29px;">
														<?php echo $system_name; ?>
													</span>
													<br/>
													<span style="text-align: center;font-size: 18px;">
														<?php echo $system_address; ?>
													</span>
													<br/>
													<span style="text-align: center;font-size: 22px;">
															TERMINAL REPORT
													</span>                
												</div>
											</div>
											<div class="col-md-2 logo" >
	<img src = "<?php echo  base_url() ?>uploads/student_image/<?php echo $student['student_id'].'.jpg' ?>" width = "100px" height = "100px">
											</div>
										</div>
									</td>
								  </tr>
								</table>
				
								<table width="1000" border="0">
								  <tr>
									<td style="background:black">&nbsp;</td>
								  </tr>
								</table>
				
								<table width="1000" border="1">
				
								  <tr>
									<td>TERM FOR:<?php echo $running_year; ?></td>
									<td>Echo Term</td>
									<td>ACADEMIC YEAR:<?php echo $running_year; ?></td>
									<td>Echo Session</td>
									<td>SEX:<?php echo $sex; ?></td>
									<td>Echo Sex</td>
									<td>ATTENDANCE:

									</td>
									<td>
										<?php
									  echo $this->db->get_where('attendance',array('session' => $running_year, 'student_id' => $student_id,'status' => '1'))->num_rows();
									?>
									</td>
								  </tr>
				  
								   <tr>
									<td>NAME OF PUPIL:<?php echo $name; ?></td>
									<td>Echo Name</td>
									<td>ADMISSION NO:<?php echo $roll; ?></td>
									<td>Echo Roll</td>
									<td>CLASS:<?php echo $class; ?></td>
									<td>Echo Class</td>
									<td>DAYS OUT OF:</td>
									<td>
										<?php
											echo $this->db->get_where('attendance',array('session' => $running_year))->num_rows();
										 ?>
									</td>
								  </tr>
								</table>
						<br />
						        <table width="1000" style="border:1px solid #CCCCCC">
								   <tr style="background:#CCCCCC">
										<td ><strong>STUDENT SUBJECTS:</strong></td>
										<td ><strong>1ST SCORE</strong></td>
										<td ><strong>2ND SCORE</strong></td>
										<td ><strong>3RD SCORE</strong></td>
										<td ><strong>EXAM SCORE</strong></td>
										<td ><strong>TOTAL SCORE</strong></td>
										<td ><strong>AVERAGE SCORE</strong></td>
										<td ><strong>GRADE SCORE</strong></td>
										<td ><strong>SUBJECT REMARKS</strong></td>
								   </tr>
								   <?php 

								   $subjects = $this->db->get_where('subject',array('class_id' => $class_id))->result_array();
								   foreach($subjects as $subject):
								  

								   ?>
								   <tr>

										<td><?php echo $subject['name'] ?></td>
										<?php
										$obtained_marks =  	$this->db->get_where('mark',

								   		array('student_id' => $student_id,
								   			'subject_id' => $subject['subject_id'],
								   			'exam_id' => $exam_id,
								   			'class_id' => $class_id));

								  if($obtained_marks > 0){
								  	$class_score_one = $obtained_marks->row()->class_score1;

								  	$class_score_two = $obtained_marks->row()->class_score2;

								  	$class_score_three = $obtained_marks->row()->class_score3;

								  	$exam_score = $obtained_marks->row()->exam_score;

								  	$total_score = $class_score1 + $class_score2 + $class_score3 + $exam_score;

								  	$average_score = $total_score / 4;
								  }

								  ?>

										<td><?php echo $class_score_one; ?></td>
										<td><?php echo $class_score_two; ?></td>
										<td><?php echo $class_score_three; ?></td>
										<td><?php echo $exam_score; ?></td>
										<td><?php echo $total_score; ?></td>
										<td><?php echo $average_score; ?></td>
										<td></td>
										<td></td>
								    </tr>
								<?php endforeach; ?>
							    </table>
				
                                <table width="1000" style="border:1px solid #CCCCCC">
                                    <tr>
                                        <td style="background:#CCCCCC">&nbsp;</td>
                                    </tr>
                                </table>
						    <br>
						
						
                                <table width="1000" style="border:1px solid #CCCCCC">
                    
                                   
                                    <tr>
                                        <td width="150">NUMBER IN CLASS:</td>
                                        <td align="center"><div  style="border-bottom: 1px dotted #D2CBCB">
                                        	<?php 
                                        	$no = $this->db->get_where('student',array('class_id' => $class_id))->num_rows();
                                        	 ?>
                                        	 <?php echo $no; ?>

                                        </div></td>
                                        <td>CLASS POSITION:</td>
                                        <td align="center"><div  style="border-bottom: 1px dotted #D2CBCB">&nbsp;</div></td>
                                    </tr>
                                </table>
                    
                                <table width="1000" style="border:1px solid #CCCCCC">
                                    <tr>
                                        <td>CLASS TEACHER'S COMMENT:</td>
                                        <td><div  style="border-bottom: 1px dotted #D2CBCB">&nbsp;</div></td>
                                    </tr>
                                </table>
                            
                            
                    
                                <table width="1000" style="border:1px solid #CCCCCC">
                                    <tr>
                                        <td>HEAD TEACHER'S COMMENT:</td>
                                        <td><div style="border:1 px solid">&nbsp;</div></td>
                        
                                    </tr>
                                </table>
						
						
						
							<table width="1000" style="border:1px solid #CCCCCC">
								<tr>
									<td>RESUMPTION DATE:</td>
									<td><div  style="border-bottom: 1px dotted #D2CBCB">Term</div></td>
									<td>OUTSTANDING FEE:</td>
									<td><div  style="border-bottom: 1px dotted #D2CBCB"><strong style="color:red">Due
										<?php
										$student_due = 	$this->db->select_sum('due');
										$this->db->from('invoice');
										$this->db->where('student_id',$student_id);
										$query = $this->db->get();
										$due = $query->row()->due;
										?>
										<?php echo $due; ?>
									</strong></div></td>
									<td >TERM:</td>
									<td><div  style="border-bottom: 1px dotted #D2CBCB">Term</div></td>
						
								</tr>
								<tr>
									<td>SIGNATURE:</td>
									<td><div  style="border-bottom: 1px dotted #D2CBCB">Sign</div></td>
									<td>DATE:</td>
									<td><div  style="border-bottom: 1px dotted #D2CBCB">Date</div></td>
					   
								</tr>
							</table>
						</div>
					</div>
				<?php endforeach; ?>
				<hr />
				<button id="print" class="btn btn-info btn-rounded btn-block btn-sm pull-right" type="button"> <span><i class="fa fa-print"></i>&nbsp;Print</span> </button>

			</div>
		</div>
	</div>
</div>