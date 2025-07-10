
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Job</h6>
								<hr>
                         <?php if($this->session->flashdata('flashSuccess_job')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_job');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>

						<?php if($this->session->flashdata('flashError_job')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_job'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>

						<?php
						$sess_id = $this->session->userdata('auser_id');
					 	$attributes = array('class' => '', 'id' =>'add_jobbss');
     					echo form_open_multipart('Jobs/add_jobs/'.$sess_id,$attributes);?>

						   <div class="col-sm-6">
								<div class="form-group">
									<label>Reference No.<span class="required">*</span></label>
									<input class="form-control" name = "refrence_no" type="text" placeholder="Reference No." maxlength="20" value = "<?php echo isset($insertData['refrence_no']) ? $insertData['refrence_no'] : ''; ?>">
								<span class = "text-danger"><?php echo form_error('refrence_no');?></span>
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Job Title<span class="required">*</span></label>
									<input class="form-control" name = "job_title" type="text" placeholder="Job Title" maxlength="80" value = "<?php echo isset($insertData['job_title']) ? $insertData['job_title'] : ''; ?>">
								<span class = "text-danger"><?php echo form_error('job_title');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Total Vacancy<span class="required">*</span></label>
									<input class="form-control" name = "total_vacancy" type="text" placeholder="Total Vacancy" maxlength="20" value = "<?php echo isset($insertData['total_vacancy']) ? $insertData['total_vacancy'] : ''; ?>">
								<span class = "text-danger"><?php echo form_error('total_vacancy');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Select Region<span class="required">*</span></label>
									<select name = "region_name" class="form-control" id = "regggion_post">
									   <option selected="selected" value="">Select Preferred Region</option>
										<?php
											if(empty($all_regions))
											{
												echo '<option value="1">'.'Select Region'.'</option>';
											}

											else
											{
												foreach ($all_regions as $service)
						                      {   
						                         echo '<option value="'.$service->id.'">'.$service->region_name.'</option>';
						                      }
											}
					                      
					                    ?>
										
									</select>
									<span class = "text-danger"><?php echo form_error('region_name');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Select Circle<span class="required">*</span></label>
									<select name = "circle_name" class="form-control" id = "ciiiirclee_post">
									<option selected="selected" value="">Select Circle</option>
									</select>
									<span class = "text-danger"><?php echo form_error('circle_name');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Post Name and Code<span class="required">*</span></label>
									<select name = "post_name_code" class="form-control" id = "post_post_job">
									<option selected="selected" value="">Select Post Name and Code</option>
									</select>
									<span class = "text-danger"><?php echo form_error('post_name_code');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Select Job Status<span class="required">*</span></label>
									<select required="required" name = "job_status" class="form-control">
									   <option selected="selected" value="">Select Job Status</option>
									   <option  value="1">Active</option>
									   <option  value="0">Deactive</option>
									</select>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Start Date<span class="required">*</span></label>
									
									  <input class="form-control datetimepicker"  name = "start_date" autocomplete="off" placeholder="dd/mm/yyyy" type="text" id="" value = "<?php echo isset($insertData['start_date']) ? $insertData['start_date'] : ''; ?>">
								<span class = "text-danger"><?php echo form_error('start_date');?></span>
									
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>End Date<span class="required">*</span></label>
								<!-- 	<div class="cal-icon"> -->
									  <input class="form-control datetimepicker" id="" name = "end_date" autocomplete="off" placeholder="dd/mm/yyyy" type="text" value = "<?php echo isset($insertData['end_date']) ? $insertData['end_date'] : ''; ?>">
								<span class = "text-danger"><?php echo form_error('end_date');?></span>
									<!-- </div> --> 
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
								</div>
                            </div>
                            
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button name = "submit" type = "submit" class="btn btn-primary">Add Job</button>
                            </div>
                         <?php echo form_close(); ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
     