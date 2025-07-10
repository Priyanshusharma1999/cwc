
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Job</h6>
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
					 	$attributes = array('class' => '', 'id' =>'add_jobbss');
     					echo form_open_multipart('Circle_jobs/edit_jobs/'.$job_data->id,$attributes);?>

						   <div class="col-sm-6">
								<div class="form-group">
									<label>Reference No.<span class="required">*</span></label>
									<input class="form-control" name = "refrence_no" type="text" placeholder="Reference No." maxlength="20" value = "<?php echo $job_data->refrence_no; ?>">
								<span class = "text-danger"><?php echo form_error('refrence_no');?></span>
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Job Title<span class="required">*</span></label>
									<input class="form-control" name = "job_title" type="text" placeholder="Job Title" maxlength="80" value = "<?php echo $job_data->job_title; ?>">
								<span class = "text-danger"><?php echo form_error('job_title');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Total Vacancy<span class="required">*</span></label>
									<input class="form-control" name = "total_vacancy" type="text" placeholder="Total Vacancy" maxlength="20" value = "<?php echo $job_data->total_vacancy; ?>">
								<span class = "text-danger"><?php echo form_error('total_vacancy');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Select Region<span class="required">*</span></label>
									<select name = "region_name" class="form-control" id = "regggion_post">
									   <option selected="selected" value="">Select Preferred Region</option>
										<?php
				                        	$all_data[] = $job_data->region_id;
					                    	foreach ($all_regions as $rows ) {  ?>
					                        <option value="<?php echo $rows->id; ?>"
					                    	<?php 
					                    		echo (isset($job_data->region_id) && in_array($rows->id,$all_data) ) ? "selected" : "" ?> ><?php echo $rows->region_name; ?>
					                    	</option>
				                      <?php } ?>
										
									</select>
									<span class = "text-danger"><?php echo form_error('region_name');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Select Circle<span class="required">*</span></label>
									<select name = "circle_name" class="form-control" id = "ciiiirclee_post">
									<option selected="selected" value="">Select Circle</option>
									 <?php
                    
					                     $all_dataa[]	 = $job_data->circle_id;
					                      foreach ($all_circle as $rowss){ ?>   
					                   
					                    <option value="<?php echo $rowss->id; ?>"
					                	<?php echo (isset($job_data->circle_id) && in_array($rowss->id,$all_dataa) ) ? "selected" : "" ?>  ><?php echo $rowss->circle_name; ?></option>
					            		<?php } ?>
									</select>
									<span class = "text-danger"><?php echo form_error('circle_name');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Post Name and Code<span class="required">*</span></label>
									<select name = "post_name_code" class="form-control" id = "post_post_job">
									<option selected="selected" value="">Select Post Name and Code</option>
									<?php
                    
					                     $all_dataamm[]	 = $job_data->post_id;
					                      foreach ($all_posts as $rowssmm){ ?>   
					                   
					                    <option value="<?php echo $rowssmm->id; ?>"
					                	<?php echo (isset($job_data->post_id) && in_array($rowssmm->id,$all_dataamm) ) ? "selected" : "" ?>  ><?php echo $rowssmm->post_name; ?></option>
					            		<?php } ?>
									</select>
									<span class = "text-danger"><?php echo form_error('post_name_code');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Job Status<span class="required">*</span></label>
									<select required="required" name = "job_status" class="form-control">
									   <option selected="selected" value="1" <?php if($job_data->job_status == '1') echo 'selected="selected"' ?>>Active</option>
									   <option  value="0" <?php if($job_data->job_status == '0') echo 'selected="selected"' ?>>Deactive</option>
									</select>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Start Date<span class="required">*</span></label>
									<!-- <div class="cal-icon"> -->
									  <input class="form-control " name = "start_date" placeholder="dd/mm/yyyy" type="date" value = "<?php echo $job_data->start_date; ?>">
								<span class = "text-danger"><?php echo form_error('start_date');?></span>
									<!-- </div>  -->
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>End Date<span class="required">*</span></label>
									<!-- <div class="cal-icon"> -->
									  <input class="form-control" name = "end_date" placeholder="dd/mm/yyyy" type="date" value = "<?php echo $job_data->end_date; ?>">
								<span class = "text-danger"><?php echo form_error('end_date');?></span>
									<!-- </div>  -->
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
								</div>
                            </div>
                            
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button name = "submit" type = "submit" class="btn btn-primary">Update Job</button>
                            </div>
                         <?php echo form_close(); ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
     