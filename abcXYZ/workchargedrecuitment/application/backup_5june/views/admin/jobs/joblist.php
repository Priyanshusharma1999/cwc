
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Job List</h6>
								<hr>
								<?php
								 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
			     					echo form_open_multipart('Applicant/search_job/',$attributes);?> 

								<form class="form-inline sr-form" action="#">
								  <div class="form-group">
									<select  name = "regiion_name" class="form-control">
									   <option selected="selected" value="">Select Preferred Region</option>
										<?php
											if(empty($all_regions))
											{
												echo '<option value="1">'.'Select Preferred Region'.'</option>';
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
								  </div>
								  <span>OR</span>
								  <div class="form-group">
									<select name = "circlle_name" class="form-control">
									   <option selected="selected" value="">Select Circle</option>
									  	<?php
											if(empty($all_circle))
											{
												echo '<option value="1">'.'Select Circle'.'</option>';
											}

											else
											{
												foreach ($all_circle as $circle)
						                      {   
						                         echo '<option value="'.$circle->id.'">'.$circle->circle_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								  </div>
								  <span>OR</span>
								  <div class="form-group">
									<select  name = "posst_name" class="form-control">
									   <option selected="selected" value="">Select Post</option>
											<?php
											if(empty($all_post))
											{
												echo '<option value="1">'.'Select Post'.'</option>';
											}

											else
											{
												foreach ($all_post as $post)
						                      {   
						                         echo '<option value="'.$post->id.'">'.$post->post_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								  </div>
								  <button type="submit" class="btn btn-success btn-search">Search</button>
								<?php echo form_close(); ?>
								
                                <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>Reference No.</th>
											<th>Region </th>
											<th>Circle</th>
											<th>Job Title</th>
                                            <th>Post Date</th>
											<th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
											if($all_applicant_jobs) {
												foreach($all_applicant_jobs as $jobs) { ?>
                                        <tr>
                                            <td>
                                            	<?php

													$job_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' =>$jobs->job_id));
								                    if(empty($job_data))
								                    {
								                    		echo '';
								                    }
								                    else
								                    {
								                    		echo $job_data->refrence_no;
								                    }
											?>
                                            </td>
											<td>
												<?php

												$region_data = $this->Base_model->get_record_by_id('tbl_region', array('id' => $jobs->region_id));
							                    if(empty($region_data))
							                    {
							                    		echo '';
							                    }
							                    else
							                    {
							                    		echo $region_data->region_name;
							                    }
											?>
											</td>
											<td>
											<?php

												$circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id' =>$jobs->circle_id));
							                    if(empty($circle_data))
							                    {
							                    		echo '';
							                    }
							                    else
							                    {
							                    		echo $circle_data->circle_name;
							                    }
											?>

											</td>
                                            <td>
                                            	<?php

													$job_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' =>$jobs->job_id));
								                    if(empty($job_data))
								                    {
								                    		echo '';
								                    }
								                    else
								                    {
								                    		echo $job_data->job_title;
								                    }
											?>
                                            </td>
                                            <td>
                                            	<?php echo date('d/m/Y',strtotime($jobs->created_date)); ?>
                                            		
                                            </td>
											<td>
												<?php 
													if($jobs->job_status=='1')
													{
														echo '<span class="label label-primary">Pending</span>';
													}

													else if($jobs->job_status=='2')
													{
														echo '<span class="label label-success">Accepted</span>';
													}

													else if($jobs->job_status=='3')
													{
														echo ' <span class="label label-danger">Rejected</span>';
													}

													else
													{
														echo '';
													}
												?>
											  
											  
											 
											</td>
                                            <td>
                                            	<?php $pdf_name =  $jobs->pdf_name;
                                            		$url ='http://103.70.201.212:2001/cwc-jobs/uploads/applicant_pdf/'.$pdf_name.'.pdf';
                                            		  ?>
                                            	 <a href="javascript:;" onclick = "return job_data(<?php echo $jobs->id; ?>)"  class=" btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
                                            	 <button type="button" class=" btn btn-sm btn-danger" onclick="printJS('<?php echo $url; ?>')">Print </button>
											  <!--  <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a> -->
											</td>
                                        </tr>
                                         <?php } } else { ?>
										<tr><td>No Jobs found</td></tr>
										<?php } ?>
										
										 
									
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    
      <div id="preview_myModal" class="modal fade" role="dialog">
		  <div class="modal-dialog preview-modal">
			<div class="modal-content">
			  <div class="modal-body">
				 <div class="account-box" style="box-shadow: none;border: 0;margin: 0;width: auto;">


					<div class="account-wrapper">
					   <h3 class="text-center">Job Detail</h3><br/>

                       <div class="col-sm-4">
                       	  <span style="color:#f05d27;font-size: 16px;">Sl No-</span>
                       	 <input type="text" id= "sl_no" class="form-control" readonly 
                       	 style="margin-bottom: 20px;display: inline-block;width: auto;background: transparent;
                       	 border: 0;font-size: 18px;" />
                       </div>

                      
							<div class="panel panel-primary" style="clear:both">
								<div class="panel-heading">
									 <h3 class="panel-title">Job Apply For</h3>
								</div>
								
								<div class="panel-body">
								
								   <div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Preferred Region</label>
										<!-- <select id = "preview_region_name" required="required" class="form-control" disabled>
										   
										</select> -->
										<input type="text" id= "preview_region_name" class="form-control" readonly />
									</div>
								   </div>
								   
								   <div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Circle Office</label>
										<!-- <select  class="form-control" disabled>
										   <option selected="selected" value="">Hydrological Observation</option>
										</select> -->
										<input type="text" id= "preview_circle_name" class="form-control" readonly />
									</div>
								   </div>	
								   
								   <div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Skilled Applied For</label>
										<input type="text" id= "preview_skilled_name" class="form-control" readonly />
										<!-- <select class="form-control" disabled>
											
										</select> -->
									</div>
								   </div>
								   
								   <div class="col-sm-6">
										<div class="form-group">
										<label class="control-label">Post Code</label>
									     <input type="text" id= "preview_post_code" class="form-control" readonly />
										</div>
								   </div>
								   
								</div>
								
							</div>
							
							
							
							<div class="panel panel-primary">
									<div class="panel-heading">
										 <h3 class="panel-title">Basic Information</h3>
									</div>
									
									<div class="panel-body">
									
									   <div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Full Name</label>
											<input type="text"  id= "preview_full_name" class="form-control" value="" readonly />
										</div>
									   </div>
									   
									   <div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Father's Name</label>
										<input type="text" id= "preview_father_name" class="form-control" value="" readonly />
										</div>
									   </div>	
									   
									   <div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Email Id</label>
											<input type="email" id= "preview_email" class="form-control" value="" readonly />
										</div>
									   </div>
									   
									   <div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Mobile No.</label>
											<input type="text" id= "preview_mobile_no" class="form-control" value="" readonly />
										</div>
									   </div>
									   
									   <div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Date Of Birth</label>
												<input type="text" id= "preview_dob" class="form-control" value="" readonly />
											</div>
										</div>
									  
									   <div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Gender</label>
												<input type="text" id= "preview_gender" class="form-control" value="" readonly />
												<!-- <select  class="form-control" disabled>
												   <option value="">Male</option>
												   <option value="">Female</option>
												</select> -->
											</div>
										</div>
									   
										
									</div>
									
								</div>
								
								<div class="panel panel-primary">
									<div class="panel-heading">
										 <h3 class="panel-title">Educational Details</h3>
									</div>
									<div class="panel-body">
									  <div class="row-ed">
										<div class="col-sm-2 nopadding">
											<div class="form-group">
												<label class="control-label">Exam Passed</label> 
												<input type="text" id = "preview_highschool_metriculation" class="form-control" value="" readonly />
												
											</div>
										</div>

									   <div class="col-sm-2 padding-5">
											<div class="form-group">
												<label class="control-label ed-label">Name of Board/University</label>
												<input type="text" id = "preview_highschool_board_name" class="form-control" value="" readonly />
											</div>
										</div>
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<label class="control-label ed-label">Passing Year</label>
												<input type="text" id = "preview_highschool_passing_year" class="form-control" value="" readonly />
											</div>
										</div>

											<!-- <div class="col-sm-1 padding-5">
											<div class="form-group">
												<label class="control-label ed-label"> Type</label>
												<input type="text" id = "preview_percentage_type" class="form-control" value="" readonly />
												
												
												
											</div>
										</div> -->
										
									<div class="col-sm-3 padding-5">
											<div class="form-group">
												<label class="control-label ed-label">Maximum Marks</label>
												<input type="text" id = "preview_highschool_total_marks" class="form-control" value="" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<label class="control-label ed-label">Marks Obtained</label>
												<input type="text" id = "preview_highschool_marks_obtained" class="form-control" value="" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-1 padding-5">
											<div class="form-group">
												<label class="control-label ed-label">Percentage</label>
												<input type="text" id = "preview_highschool_percentage" class="form-control" value="" readonly />
											</div>
										</div>
										
										
									  </div>
									  
									  
								<!-- 	  <div class="row-ed">
										<div class="col-sm-1 nopadding">
											<div class="form-group" style="margin-top:12px;">
												<label class="control-label">Intermediate<span class="required">*</span></label>
											</div>
										</div>

									   <div class="col-sm-4 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_intermediate_board_name" class="form-control" readonly />
											</div>
										</div>
										
										<div class="col-sm-1 padding-5">
											<div class="form-group">
												<input type="text"  id = "preview_intermediate_passing_year" class="form-control"  readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text"  id = "preview_intermediate_total_marks" class="form-control" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text"  id = "preview_intermediate_marks_obtained" class="form-control" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_intermediate_percentage" class="form-control" readonly />
											</div>
										</div>
										
										
									  </div>
									   -->
									  
									  <div class="row-ed">
										<div class="col-sm-2 nopadding">
											<div class="form-group">
												<input type="text" id = "" class="form-control" value="Others" readonly />
												
											</div>
										</div>

									   <div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_graduation_qualification" class="form-control" readonly />
											</div>
										</div>
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_graduation_passing_year"  class="form-control" readonly />
											</div>
										</div>
										
										<!-- <div class="col-sm-1 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_percentage_type1"  class="form-control" readonly />												
											</div>
										</div> -->
										
										<div class="col-sm-3 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_graduation_total_marks"  class="form-control" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_graduation_marks_obtained"  class="form-control" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-1 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_graduation_percentage" required="required" class="form-control" readonly />
											</div>
										</div>
										
									  </div>
									  
									  
									  <div class="row-ed">
										<div class="col-sm-2 nopadding">
											<div class="form-group">
												<input type="text" id = "" class="form-control" value="Others" readonly />
												
											</div>
										</div>

									   <div class="col-sm-2 padding-5">
											<div class="form-group">
											<input type="text" id = "preview_post_graduation_qualification" class="form-control" readonly />
											</div>
										</div>
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_post_graduation_passing_year" class="form-control" readonly />
											</div>
										</div>

										<!-- <div class="col-sm-1 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_percentage_type2"  class="form-control" readonly />												
											</div>
										</div> -->
										
										<div class="col-sm-3 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_post_graduation_total_marks" class="form-control" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_post_graduation_marks_obtained" class="form-control" readonly />
											</div>
										</div>
										
										<div class="col-sm-1 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_post_graduation_percentage"  class="form-control" readonly />
											</div>
										</div>
										
									  </div>
									  
									  
									  <div class="row-ed">
										<div class="col-sm-2 nopadding">
											<div class="form-group">
												<input type="text" id = "" class="form-control" value="Others" readonly />
												
											</div>
										</div>

									   <div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_others_qualification" class="form-control" readonly />
											</div>
										</div>
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_others_passing_year" class="form-control" readonly />
											</div>
										</div>
									
										<!-- <div class="col-sm-1 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_percentage_type3"  class="form-control" readonly />												
											</div>
										</div> -->
										
										<div class="col-sm-3 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_others_total_marks" class="form-control" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_others_marks_obtained" class="form-control" readonly />
											</div>
										</div>
										
										<div class="col-sm-1 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_others_percentage" required="required" class="form-control" readonly />
											</div>
										</div>
										
									  </div>
										
									</div>
								</div>
								
								<div class="panel panel-primary">
									<div class="panel-heading">
										 <h3 class="panel-title">Other Details</h3>
									</div>
									<div class="panel-body">
									
									   
									   <div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Category</label>
												<input type="text" id = "preview_caste_category" required="required" class="form-control" readonly />
												<!-- <select  class="form-control" disabled>
												   <option value="">General</option>
												   <option value="">OBC</option>
												   <option value="">SC/ST</option>
												   <option value="">Other</option>
												</select> -->
											</div>
										</div>	
										
										  <div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Religion</label>
												<input type="text" id = "preview_religion" required="required" class="form-control" readonly />
												<!-- <select  class="form-control" disabled>
												   <option value="">Hindu</option>
												   <option value="">Muslim</option>
												   <option value="">Sikh</option>
												   <option value="">Christians</option>
												   <option value="">Other</option>
												</select> -->
											</div>
										</div>	
										
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Marital Status</label>
												<input type="text" id = "preview_marital_status" required="required" class="form-control" readonly />
												<!-- <select  class="form-control" disabled>
												   <option value="">Married</option>
												   <option value="">Unmarried</option>
												</select> -->
											</div>
										</div>	
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Nationality</label>
												<input type="text" id= "preview_nationality" class="form-control" readonly />
											</div>
										</div>	
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Aadhar No.</label>
												<input type="text" id="preview_aadhar_no" class="form-control" readonly />
											</div>
										</div>
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Ex-Serviceman</label>
												<input type="text" id = "preview_ex_serviceman" required="required" class="form-control" readonly />
												<!-- <select  class="form-control" disabled>
												   <option value="">Yes</option>
												   <option value="">No</option>
												</select> -->
											</div>
										</div>
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Do you fulfill the eligibility of physical fitness criteria?</label>
												<input type="text" id = "preview_physical_fitness" required="required" class="form-control" readonly />
												<!-- <select class="form-control" disabled>
												  
												   <option value="">Yes</option>
												   <option value="" selected>No</option>
												</select> -->
											</div>
										</div>
										
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Employment exchange Registration No & Place</label>
												<input type="text" id="preview_employment_exchange"  class="form-control" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Physically Handicapped</label>
												<input type="text" id = "preview_physically_candicapped" required="required" class="form-control" readonly />
												<!-- <select  class="form-control" disabled>
												   <option value="">Yes</option>
												   <option value="" selected>No</option>
												</select> -->
											</div>
										</div>
										
									   
									   <div class="col-sm-6" style="clear:both;">
											<div class="form-group">
												<label class="control-label">Present Address</label>
												<textarea class="form-control" id="preview_present_address" readonly ></textarea>
											</div>
											
											<div class="form-group">
											   <div class="col-sm-4 padding-5">
													<div class="form-group">
														<!-- <select  class="form-control" disabled>
														   <option value="">UP</option>
														   <option value="">Bihar</option>
														   <option value="">MP</option>
														</select> -->
														<input type="text" id = "preview_present_address_state" required="required" class="form-control" readonly />
													</div>
												</div>	
										
												<div class="col-sm-4 padding-5">
													<div class="form-group">
														<!-- <select class="form-control" disabled>
														   <option value="">Kanpur</option>
														   <option value="">Patna</option>
														   <option value="">Bhopal</option>
														</select> -->
														<input type="text" id ="preview_present_address_city" required="required" class="form-control" readonly />
													</div>
												</div>	
										
												<div class="col-sm-4 padding-5">
													<div class="form-group">
													<input type="text" id="preview_present_address_pincode"  class="form-control" readonly />
													</div>
												</div>	
											</div>
									   </div>
									   
									   <div class="col-sm-6">
											<div class="form-group">
												<label class="control-label">Permanent Address</label>
												<textarea class="form-control" id ="preview_permanent_address" readonly ></textarea>
											</div>
											
											<div class="form-group">
											   <div class="col-sm-4 padding-5">
													<div class="form-group">
														<!-- <select class="form-control" disabled>
														   <option value="">UP</option>
														   <option value="">Bihar</option>
														   <option value="">MP</option>
														</select> -->
														<input type="text" id = "preview_permanent_address_state" required="required" class="form-control" readonly />
													</div>
												</div>	
										
												<div class="col-sm-4 padding-5">
													<div class="form-group">
													<!-- 	<select class="form-control" disabled>
														   <option value="">Kanpur</option>
														   <option value="">Patna</option>
														   <option value="">Bhopal</option>
														</select> -->
														<input type="text" id = "preview_permanent_address_city" required="required" class="form-control" readonly />
													</div>
												</div>	
										
												<div class="col-sm-4 padding-5">
													<div class="form-group">
													<input type="text" id="preview_permanent_address_pincode"  class="form-control" readonly />
													</div>
												</div>	
											</div>
											
									   </div>

									</div>
								</div>
								
								
								<div class="panel panel-primary">
									<div class="panel-heading">
										 <h3 class="panel-title">Upload Document</h3>
									</div>
									<div class="panel-body">
									  <div class="col-sm-6">
										   <div class="form-group" style="width:100%;float:left;">
											   <div class="col-sm-6">
												  <label class="control-label">Upload Photo With Sign</label>
												</div>
												<div class="col-sm-6">
												  <img id="preview_uploaded_photo_sign" src="<?php echo base_url();?>uploads/uploaded_photo/no-image.jpg" width="150" height="100">
												</div>
											</div>
									  </div>

                     <div class="col-sm-6">									  
										 <div class="form-group" style="width:100%;float:left;">
									       <div class="col-sm-6">
											  <label class="control-label">Date Of Birth Certificate : </label>
											  <a  href = "#" target = "_blank" id = "preview_dob_certificate">View</a>
											</div>
										   
										</div>
									</div>	
										
									<div class="col-sm-6">		
										 <div class="form-group" style="width:100%;float:left;">
									       <div class="col-sm-6">
											  <label class="control-label">Matriculation/ITI Marksheet</label>
											  <a  href = "#" target = "_blank" id = "preview_matriculation_marksheet">View</a>
											</div>
										    <!-- <div class="col-sm-6">
										      <img  id="preview_matriculation_marksheet" src="<?php //echo base_url();?>uploads/uploaded_photo/no-image.jpg" width="150" height="100">
										    </div> -->
										</div>
								   </div>		
										
								    <div class="col-sm-6">				
										 <div class="form-group" style="width:100%;float:left;">
									       <div class="col-sm-6">
											  <label class="control-label">S.C./S.T., O.B.C. or Ex-Serviceman or PH. Certificate </label>
											  <a  href = "#" target = "_blank" id = "preview_scc_St_obc_certificate">View</a>
											</div>
										   
										</div>
								    </div>		
										
									</div>
								</div>
								
						
					 </div>
				  </div>
			  </div>
			</div>
		  </div>
		</div>

		<script>
			        /*******JS for preview button click*******/
function job_data(id)
{

   var job_id = id;
   var base_url = 'http://103.70.201.212:2001/cwc-jobs/';
   var link = base_url+'Applicant/job_data/';
   var csrf_test_name = $("input[id=csrf-token]").val();

       //AJAX CODE START
       $.ajax({
        method: "GET",
        url: link,
        data: {'csrf_test_name' : csrf_test_name,'id':job_id},
        success: function(result) {
         
          console.log(result); 
          var obj = JSON.parse(result);
          if(obj.status == "success")
          {
          	
      	var job_iddd = obj.basic_info_id;
        $('#sl_no').val(job_iddd);

        var region_name = obj.region_name;
        $('#preview_region_name').val(region_name);

        var circle_name = obj.circle_name;
        $('#preview_circle_name').val(circle_name);

        var skilled_name = obj.skilled_name;
        $('#preview_skilled_name').val(skilled_name);

        var post_code = obj.post_code;
	    	$('#preview_post_code').val(post_code);

	  		var full_name = obj.full_name;
	  		$('#preview_full_name').val(full_name);

	  		var father_name = obj.father_name;
	  		$('#preview_father_name').val(father_name);

	  		var email = obj.email;
	  		$('#preview_email').val(email);

	  		var mobile_no = obj.mobile_no;
	  		$('#preview_mobile_no').val(mobile_no);

	  		var dob = obj.dob;
	  		$('#preview_dob').val(dob);

	  		var gender = obj.gender;
	  		$('#preview_gender').val(gender);
	  		
	  		var highschool_metriculation = obj.highschool_metriculation;
  			$('#preview_highschool_metriculation').val(highschool_metriculation);

	  		var highschool_board_name = obj.highschool_board_name;
	  		$('#preview_highschool_board_name').val(highschool_board_name);

	  		var highschool_passing_year = obj.highschool_passing_year;
	  		$('#preview_highschool_passing_year').val(highschool_passing_year);

	  		var highschool_total_marks = obj.highschool_total_marks;
	  		$('#preview_highschool_total_marks').val(highschool_total_marks);

	  		var highschool_marks_obtained = obj.highschool_marks_obtained;
	  		$('#preview_highschool_marks_obtained').val(highschool_marks_obtained);

	  		var highschool_percentage = obj.highschool_percentage;
	  		$('#preview_highschool_percentage').val(highschool_percentage);

	  		var intermediate_board_name = obj.intermediate_board_name;
	  		$('#preview_intermediate_board_name').val(intermediate_board_name);

	  		var intermediate_passing_year = obj.intermediate_passing_year;
	  		$('#preview_intermediate_passing_year').val(intermediate_passing_year);

	  		var intermediate_total_marks = obj.intermediate_total_marks;
	  		$('#preview_intermediate_total_marks').val(intermediate_total_marks);

	  		var intermediate_marks_obtained = obj.intermediate_marks_obtained;
	  		$('#preview_intermediate_marks_obtained').val(intermediate_marks_obtained);

	  		var intermediate_percentage = obj.intermediate_percentage;
	  		$('#preview_intermediate_percentage').val(intermediate_percentage);

	  		var graduation_qualification = obj.graduation_qualification;
	  		$('#preview_graduation_qualification').val(graduation_qualification);

	  		var graduation_passing_year = obj.graduation_passing_year;
	  		$('#preview_graduation_passing_year').val(graduation_passing_year);

	  		var graduation_total_marks = obj.graduation_total_marks;
	  		$('#preview_graduation_total_marks').val(graduation_total_marks);

	  		var graduation_marks_obtained = obj.graduation_marks_obtained;
	  		$('#preview_graduation_marks_obtained').val(graduation_marks_obtained);

	  		var graduation_percentage = obj.graduation_percentage;
	  		$('#preview_graduation_percentage').val(graduation_percentage);

	  		var post_graduation_qualification = obj.post_graduation_qualification;
	  		$('#preview_post_graduation_qualification').val(post_graduation_qualification);

	  		var post_graduation_passing_year = obj.post_graduation_passing_year;
	  		$('#preview_post_graduation_passing_year').val(post_graduation_passing_year);

	  		var post_graduation_total_marks = obj.post_graduation_total_marks;
	  		$('#preview_post_graduation_total_marks').val(post_graduation_total_marks);

	  		var post_graduation_marks_obtained = obj.post_graduation_marks_obtained;
	  		$('#preview_post_graduation_marks_obtained').val(post_graduation_marks_obtained);

	  		var post_graduation_percentage = obj.post_graduation_percentage;
	  		$('#preview_post_graduation_percentage').val(post_graduation_percentage);

	  		var others_qualification = obj.others_qualification;
	  		$('#preview_others_qualification').val(others_qualification);

	  		var others_passing_year = obj.others_passing_year;
	  		$('#preview_others_passing_year').val(others_passing_year);

	  		var others_total_marks = obj.others_total_marks;
	  		$('#preview_others_total_marks').val(others_total_marks);

	  		var others_marks_obtained = obj.others_marks_obtained;
	  		$('#preview_others_marks_obtained').val(others_marks_obtained);

	  		var others_percentage = obj.others_percentage;
	  		$('#preview_others_percentage').val(others_percentage);

	  		var caste_category = obj.caste_category;
	  		$('#preview_caste_category').val(caste_category);

	  		var religion = obj.religion;
	  		$('#preview_religion').val(religion);

	  		var marital_status = obj.marital_status;
	  		$('#preview_marital_status').val(marital_status);

	  		var nationality = obj.nationality;
	  		$('#preview_nationality').val(nationality);

	  		var aadhar_no = obj.aadhar_no;
	  		$('#preview_aadhar_no').val(aadhar_no);

	  		var ex_serviceman = obj.ex_serviceman;
	  		$('#preview_ex_serviceman').val(ex_serviceman);

	  		var physical_fitness = obj.physical_fitness;
	  		$('#preview_physical_fitness').val(physical_fitness);

	  		var employment_exchange = obj.employment_exchange;
	  		$('#preview_employment_exchange').val(employment_exchange);

	  		var physically_candicapped = obj.physically_candicapped;
	  		$('#preview_physically_candicapped').val(physically_candicapped);

	  		var present_address = obj.present_address;
	  		$('#preview_present_address').val(present_address);

	  		var present_address_state = obj.present_address_state;
	  		$('#preview_present_address_state').val(present_address_state);

	  		var present_address_city = obj.present_address_city;
	  		$('#preview_present_address_city').val(present_address_city);

	  		var present_address_pincode = obj.present_address_pincode;
	  		$('#preview_present_address_pincode').val(present_address_pincode);

	  		var permanent_address = obj.permanent_address;
	  		$('#preview_permanent_address').val(permanent_address);

	  		var permanent_address_state = obj.permanent_address_state;
	  		$('#preview_permanent_address_state').val(permanent_address_state);

	  		var permanent_address_city = obj.permanent_address_city;
	  		$('#preview_permanent_address_city').val(permanent_address_city);

	  		var permanent_address_pincode = obj.permanent_address_pincode;
	  		$('#preview_permanent_address_pincode').val(permanent_address_pincode);

	  		var file_uploaded_photo = obj.file_uploaded_photo;
	  		var file_dob_certificate = obj.file_dob_certificate;
	  		var file_matriculation_marksheet = obj.file_matriculation_marksheet;
	  		var file_sc_st_obc_certitificate = obj.file_sc_st_obc_certitificate;

	  		$('#preview_uploaded_photo_sign').attr('src', file_uploaded_photo);
	  		//$('#preview_dob_certificate').attr('src', file_dob_certificate);
	  		$("#preview_dob_certificate").attr("href", file_dob_certificate);
	  		$("#preview_matriculation_marksheet").attr("href", file_matriculation_marksheet);
	  		$("#preview_scc_St_obc_certificate").attr("href", file_sc_st_obc_certitificate);
	  		/*$('#preview_matriculation_marksheet').attr('src', file_matriculation_marksheet);
	  		$('#preview_scc_St_obc_certificate').attr('src', file_sc_st_obc_certitificate);*/

           $('#preview_myModal').modal('show');

          }
          else
          {	
            alert("Failed to load data");
          } 

    }
        
    });

       

}// function ends
		</script>

     