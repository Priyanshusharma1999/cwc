
    

	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Job</h6>
								<hr>

					<div class="col-sm-6">
								<div class="form-group">
									<label>Reference No. : </label>
									<?php echo $job_data->refrence_no; ?>
								
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Job Title : </label>
									<?php echo $job_data->job_title; ?>
								
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Total Vacancy : </label>
									<?php echo $job_data->total_vacancy; ?>
								</div>
                            </div>

						  <div class="col-sm-6">
							<div class="form-group">
								<label>Region Name : </label>
								<?php

									$region_data = $this->Base_model->get_record_by_id('tbl_region', array('id' => $job_data->region_id));
				                    if(empty($region_data))
				                    {
				                    		echo '';
				                    }
				                    else
				                    {
				                    		echo $region_data->region_name;
				                    }
								?>
								
							</div>
						  </div>

						  <div class="col-sm-6">
							<div class="form-group">
								<label>Circle Name : </label>
								<?php

									$circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id' =>$job_data->circle_id));
				                    if(empty($circle_data))
				                    {
				                    		echo '';
				                    }
				                    else
				                    {
				                    		echo $circle_data->circle_name;
				                    }
								?>
							
							</div>
						  </div>

						   <div class="col-sm-6">
							<div class="form-group">
								<label>Post Name and Code : </label>
								<?php

									$post_data = $this->Base_model->get_record_by_id('tbl_post', array('id' =>$job_data->post_id));
				                    if(empty($post_data))
				                    {
				                    		echo '';
				                    }
				                    else
				                    {
				                    		echo $post_data->post_name;
				                    }
								?>
							
							</div>
						  </div>

						   <div class="col-sm-6">
							<div class="form-group">
								<label>Job Status : </label>
								<?php

								
				                    if($job_data->job_status=='1')
				                    {
				                    		echo 'Active';
				                    }
				                    else if($job_data->job_status=='0')
				                    {
				                    		echo 'Deactive';
				                    }

				                    else
				                    {
				                    	echo '';
				                    }
								?>
							
							</div>
						  </div>

						   <div class="col-sm-6">
							<div class="form-group">
								<label>Start Date : </label>
								<?php

									echo date('d/m/Y',strtotime($job_data->start_date));
								?>
							
							</div>
						  </div>

						   <div class="col-sm-6">
							<div class="form-group">
								<label>End Date : </label>
								<?php

									echo date('d/m/Y',strtotime($job_data->end_date));
								?>
							
							</div>
						  </div>
						  
						  <div class="m-t-20" style="clear:both;padding-left:15px;">

                                
                          </div>
							
                        
								
                            </div>
                        </div>
                    </div>
                </div>
				
            </div>
            
        </div>
      

