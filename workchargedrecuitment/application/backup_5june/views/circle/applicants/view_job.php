
    

	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Job Detail</h6>
								<hr>

						   <div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Preferred Region</label>
										<!-- <select id = "preview_region_name" required="required" class="form-control" disabled>
										   
										</select> -->
										<input type="text" id= "preview_region_name" class="form-control" value = "<?php echo $region_data->region_name; ?>" readonly/>
									</div>
								   </div>
								   
								   <div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Circle Office</label>
										<!-- <select  class="form-control" disabled>
										   <option selected="selected" value="">Hydrological Observation</option>
										</select> -->
										<input type="text" id= "preview_circle_name"  value = "<?php echo $circle_data->circle_name; ?>" class="form-control" readonly />
									</div>
								   </div>	
								   
								   <div class="col-sm-6">
									<div class="form-group">
										<label class="control-label">Skilled Applied For</label>
										<input type="text" id= "preview_skilled_name" class="form-control"  value = "<?php echo $job_data->job_title; ?>" readonly />
										<!-- <select class="form-control" disabled>
											
										</select> -->
									</div>
								   </div>
								   
								   <div class="col-sm-6">
										<div class="form-group">
										<label class="control-label">Post Code</label>
									     <input type="text" id= "preview_post_code" class="form-control"  value = "<?php echo $post_data->post_name.'-'.$post_data->post_code; ?>" readonly />
										</div>
								   </div>

								   <div class="">
									<div class="">
										 <h3 class="panel-title">Basic Information</h3>
									</div>
									
									<div class="panel-body">
									
									   <div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Full Name</label>
											<input type="text"  id= "preview_full_name" class="form-control" value="<?php echo $all_job_data[0]->full_name; ?>" readonly />
										</div>
									   </div>
									   
									   <div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Father's Name</label>
										<input type="text" id= "preview_father_name" class="form-control" value="<?php echo $all_job_data[0]->father_name; ?>" readonly />
										</div>
									   </div>	
									   
									   <div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Email Id</label>
											<input type="email" id= "preview_email" class="form-control" value="<?php echo $all_job_data[0]->email; ?>" readonly />
										</div>
									   </div>
									   
									   <div class="col-sm-4">
										<div class="form-group">
											<label class="control-label">Mobile No.</label>
											<input type="text" id= "preview_mobile_no" class="form-control" value="<?php echo $all_job_data[0]->mobile_no; ?>" readonly />
										</div>
									   </div>
									   
									   <div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Date Of Birth</label>
												<input type="text" id= "preview_dob" class="form-control" value="<?php echo $all_job_data[0]->dob; ?>" readonly />
											</div>
										</div>
									  
									   <div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Gender</label>
												<input type="text" id= "preview_gender" class="form-control" value="<?php echo $all_job_data[0]->gender; ?>" readonly />
												<!-- <select  class="form-control" disabled>
												   <option value="">Male</option>
												   <option value="">Female</option>
												</select> -->
											</div>
										</div>
									   
										
									</div>
									
								</div>

									<div class="">
									<div class="">
										 <h3 class="">Education Details</h3>
									</div>
									<div class="panel-body">
									  <div class="row-ed">
										<div class="col-sm-2 nopadding">
											<label class="control-label">Exam Passed</label> 
											
												<input type="text" id = "" class="form-control" value="<?php echo $all_job_data[0]->highschool_metriculation; ?>" readonly />
												
											
										</div>

									   <div class="col-sm-2 padding-5">
											<div class="form-group">
												<label class="control-label ed-label">Qualification</label>
												<input type="text" id = "preview_highschool_board_name" class="form-control" value="<?php echo $all_job_data[0]->highschool_board_name; ?>" readonly />
											</div>
										</div>
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<label class="control-label ed-label">Passing Year</label>
												<input type="text" id = "preview_highschool_passing_year" class="form-control" value="<?php echo $all_job_data[0]->highschool_passing_year; ?>" readonly />
											</div>
										</div>
										
									<div class="col-sm-2 padding-5">
											<div class="form-group">
												<label class="control-label ed-label">Total Marks</label>
												<input type="text" id = "preview_highschool_total_marks" class="form-control" value="<?php echo $all_job_data[0]->highschool_total_marks; ?>" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<label class="control-label ed-label">Marks Obtained</label>
												<input type="text" id = "preview_highschool_marks_obtained" class="form-control" value="<?php echo $all_job_data[0]->highschool_marks_obtained; ?>" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<label class="control-label ed-label">Percentage</label>
												<input type="text" id = "preview_highschool_percentage" class="form-control" value="<?php echo $all_job_data[0]->highschool_percentage; ?>" readonly />
											</div>
										</div>
										
										
									  </div>
									  
									  
									<!--   <div class="row-ed">
										<div class="col-sm-1 nopadding">
											<div class="form-group" style="margin-top:12px;">
												<label class="control-label">Intermediate<span class="required">*</span></label>
											</div>
										</div>

									   <div class="col-sm-4 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_intermediate_board_name" class="form-control" value= "<?php echo $all_job_data[0]->intermediate_board_name; ?>" readonly />
											</div>
										</div>
										
										<div class="col-sm-1 padding-5">
											<div class="form-group">
												<input type="text"  id = "preview_intermediate_passing_year" class="form-control" value = "<?php echo $all_job_data[0]->intermediate_passing_year; ?>" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text"  id = "preview_intermediate_total_marks" class="form-control" value= "<?php echo $all_job_data[0]->intermediate_total_marks; ?>" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text"  id = "preview_intermediate_marks_obtained" class="form-control" value = "<?php echo $all_job_data[0]->intermediate_marks_obtained; ?>" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_intermediate_percentage" class="form-control" value ="<?php echo $all_job_data[0]->intermediate_percentage; ?>" readonly />
											</div>
										</div>
										
										
									  </div>
									   -->
									 
									  <div class="row-ed">
										<div class="col-sm-2 nopadding">
											
												<input type="text" id = "" class="form-control" placeholder="Others" readonly />
											
										</div>

									   <div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_graduation_qualification" class="form-control" value ="<?php echo $all_job_data[0]->graduation_board_name; ?>" readonly />
											</div>
										</div>
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_graduation_passing_year"  class="form-control" value ="<?php echo $all_job_data[0]->graduation_passing_year; ?>" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_graduation_total_marks"  class="form-control" value ="<?php echo $all_job_data[0]->graduation_total_marks; ?>" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_graduation_marks_obtained"  class="form-control" value ="<?php echo $all_job_data[0]->graduation_marks_obtained; ?>" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_graduation_percentage" required="required" class="form-control" value ="<?php echo $all_job_data[0]->graduation_percentage; ?>" readonly />
											</div>
										</div>
										
									  </div>
									  
									  
									  <div class="row-ed">
										<div class="col-sm-2 nopadding">
											
												<input type="text" id = "" class="form-control" placeholder="Others" readonly />
											
										</div>

									   <div class="col-sm-2 padding-5">
											<div class="form-group">
											<input type="text" id = "preview_post_graduation_qualification" class="form-control" value ="<?php echo $all_job_data[0]->post_graduation_board_name; ?>" readonly />
											</div>
										</div>
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_post_graduation_passing_year" class="form-control" value ="<?php echo $all_job_data[0]->post_graduation_passing_year; ?>" readonly />
											</div>
										</div>
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_post_graduation_total_marks" class="form-control" value ="<?php echo $all_job_data[0]->post_graduation_total_marks; ?>" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_post_graduation_marks_obtained" class="form-control" value ="<?php echo $all_job_data[0]->post_graduation_marks_obtained; ?>" readonly />
											</div>
										</div>
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_post_graduation_percentage"  class="form-control" value ="<?php echo $all_job_data[0]->post_graduation_percentage; ?>" readonly />
											</div>
										</div>
										
									  </div>
									  
									  
									  <div class="row-ed">
										<div class="col-sm-2 nopadding">
											
												<input type="text" id = "" class="form-control" placeholder="Others" readonly />
											
										</div>

									   <div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_others_qualification" class="form-control" value ="<?php echo $all_job_data[0]->others_board_name; ?>" readonly />
											</div>
										</div>
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_others_passing_year" value ="<?php echo $all_job_data[0]->others_passing_year; ?>" class="form-control" readonly />
											</div>
										</div>
									
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_others_total_marks" class="form-control" value ="<?php echo $all_job_data[0]->others_total_marks; ?>" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_others_marks_obtained" class="form-control" value ="<?php echo $all_job_data[0]->others_marks_obtained; ?>" readonly />
											</div>
										</div>
										
										<div class="col-sm-2 padding-5">
											<div class="form-group">
												<input type="text" id = "preview_others_percentage" required="required" value ="<?php echo $all_job_data[0]->others_percentage; ?>"class="form-control" readonly />
											</div>
										</div>
										
									  </div>
										
									</div>
								</div>

								<!--other details-->
								<div class="">
									<div class="">
										 <h3 class="panel-title">Other Details</h3>
									</div>
									<div class="panel-body">
									
									   
									   <div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Category</label>
												<input type="text" id = "preview_caste_category" required="required" class="form-control" value ="<?php echo $all_job_data[0]->caste_category; ?>" readonly />
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
												<input type="text" id = "preview_religion" required="required" class="form-control" value ="<?php echo $all_job_data[0]->religion; ?>" readonly />
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
												<input type="text" id = "preview_marital_status" required="required" class="form-control" value ="<?php echo $all_job_data[0]->marital_status; ?>" readonly />
												<!-- <select  class="form-control" disabled>
												   <option value="">Married</option>
												   <option value="">Unmarried</option>
												</select> -->
											</div>
										</div>	
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Nationality</label>
												<input type="text" id= "preview_nationality" class="form-control" value ="<?php echo $all_job_data[0]->nationality; ?>" readonly />
											</div>
										</div>	
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Aadhar No.</label>
												<input type="text" id="preview_aadhar_no" value ="<?php echo $all_job_data[0]->aadhar_no; ?>" class="form-control" readonly />
											</div>
										</div>
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Ex-Serviceman</label>
												<input type="text" id = "preview_ex_serviceman" required="required" class="form-control" value ="<?php echo $all_job_data[0]->ex_serviceman; ?>" readonly />
												<!-- <select  class="form-control" disabled>
												   <option value="">Yes</option>
												   <option value="">No</option>
												</select> -->
											</div>
										</div>
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Do you fulfill the eligibility of physical fitness criteria?</label>
												<input type="text" id = "preview_physical_fitness" required="required" class="form-control" value ="<?php echo $all_job_data[0]->physical_fitness; ?>" readonly />
												<!-- <select class="form-control" disabled>
												  
												   <option value="">Yes</option>
												   <option value="" selected>No</option>
												</select> -->
											</div>
										</div>
										
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Employment exchange Registration No & Place</label>
												<input type="text" id="preview_employment_exchange"  value ="<?php echo $all_job_data[0]->employment_exchange_reg_no; ?>" class="form-control" readonly />
											</div>
										</div>
										
										
										<div class="col-sm-4">
											<div class="form-group">
												<label class="control-label">Physically Handicapped</label>
												<input type="text" id = "preview_physically_candicapped" required="required" class="form-control" value ="<?php echo $all_job_data[0]->physically_handicapp; ?>" readonly />
												<!-- <select  class="form-control" disabled>
												   <option value="">Yes</option>
												   <option value="" selected>No</option>
												</select> -->
											</div>
										</div>
										
									   
									   <div class="col-sm-6" style="clear:both;">
											<div class="form-group">
												<label class="control-label">Present Address</label>
												<textarea class="form-control" value ="<?php echo $all_job_data[0]->present_address; ?>" id="preview_present_address" readonly ></textarea>
											</div>
											
											<div class="form-group">
											   <div class="col-sm-4 padding-5">
													<div class="form-group">
														<!-- <select  class="form-control" disabled>
														   <option value="">UP</option>
														   <option value="">Bihar</option>
														   <option value="">MP</option>
														</select> -->
														<input type="text" id = "preview_present_address_state" required="required" class="form-control" value ="<?php echo $present_state->StateName_In_English; ?>" readonly />
													</div>
												</div>	
										
												<div class="col-sm-4 padding-5">
													<div class="form-group">
														<!-- <select class="form-control" disabled>
														   <option value="">Kanpur</option>
														   <option value="">Patna</option>
														   <option value="">Bhopal</option>
														</select> -->
														<input type="text" id ="preview_present_address_city" required="required" class="form-control" value ="<?php echo $all_job_data[0]->present_address_city; ?>" readonly />
													</div>
												</div>	
										
												<div class="col-sm-4 padding-5">
													<div class="form-group">
													<input type="text" id="preview_present_address_pincode"  class="form-control" value ="<?php echo $all_job_data[0]->present_address_pincode; ?>" readonly />
													</div>
												</div>	
											</div>
									   </div>
									   
									   <div class="col-sm-6">
											<div class="form-group">
												<label class="control-label">Permanent Address</label>
												<textarea class="form-control" id ="preview_permanent_address" value ="<?php echo $all_job_data[0]->permanent_address; ?>" readonly ></textarea>
											</div>
											
											<div class="form-group">
											   <div class="col-sm-4 padding-5">
													<div class="form-group">
														<!-- <select class="form-control" disabled>
														   <option value="">UP</option>
														   <option value="">Bihar</option>
														   <option value="">MP</option>
														</select> -->
														<input type="text" id = "preview_permanent_address_state" required="required" class="form-control" value ="<?php echo $permanent_state->StateName_In_English; ?>" readonly />
													</div>
												</div>	
										
												<div class="col-sm-4 padding-5">
													<div class="form-group">
													<!-- 	<select class="form-control" disabled>
														   <option value="">Kanpur</option>
														   <option value="">Patna</option>
														   <option value="">Bhopal</option>
														</select> -->
														<input type="text" id = "preview_permanent_address_city" required="required" class="form-control" value ="<?php echo $all_job_data[0]->permanent_address_city; ?>" readonly />
													</div>
												</div>	
										
												<div class="col-sm-4 padding-5">
													<div class="form-group">
													<input type="text" id="preview_permanent_address_pincode"  class="form-control" value ="<?php echo $all_job_data[0]->permanent_address_pincode; ?>" readonly />
													</div>
												</div>	
											</div>
											
									   </div>

									</div>
								</div>

								<!--documents-->
									<?php
										if(empty($all_job_data[0]->file_uploaded_photo))
											{
												$file_uploaded_photo = 'placeholder.jpg';
											}

											else
											{
												$file_uploaded_photo = $all_job_data[0]->file_uploaded_photo;
											}

											if(empty($all_job_data[0]->file_dob_certificate))
											{
												$file_dob_certificate = 'placeholder.jpg';
											}

											else
											{
												$file_dob_certificate = $all_job_data[0]->file_dob_certificate;
											}

											if(empty($all_job_data[0]->file_matriculation_marksheet))
											{
												$file_matriculation_marksheet = 'placeholder.jpg';
											}

											else
											{
												$file_matriculation_marksheet = $all_job_data[0]->file_matriculation_marksheet;
											}

											if(empty($all_job_data[0]->file_sc_st_obc_certitificate))
											{
												$file_sc_st_obc_certitificate = 'placeholder.jpg';
											}

											else
											{
												$file_sc_st_obc_certitificate = $all_job_data[0]->file_sc_st_obc_certitificate;
											}
									?>
									<div class="">
									<div class="">
										 <h3 class="panel-title">Upload Document</h3>
									</div>
									<div class="panel-body">
									  <div class="col-sm-6">
										   <div class="form-group" style="width:100%;float:left;">
											   <div class="col-sm-6">
												  <label class="control-label">Upload Photo With Sign</label>
												</div>
												<div class="col-sm-6">
												  <img id="preview_uploaded_photo_sign" src="<?php echo base_url();?>uploads/uploaded_photo/<?php echo $file_uploaded_photo; ?>" width="150">
												</div>
											</div>
									  </div>

                                    <div class="col-sm-6">									  
										 <div class="form-group" style="width:100%;float:left;">
									       <div class="col-sm-6">
											  <label class="control-label">Date Of Birth Certificate</label>
											</div>
										    <div class="col-sm-6">
										       <img  id="preview_dob_certificate" src="<?php echo base_url();?>uploads/dob_certificate/<?php echo $file_dob_certificate; ?>" width="150">
										    </div>
										</div>
									</div>	
										
									<div class="col-sm-6">		
										 <div class="form-group" style="width:100%;float:left;">
									       <div class="col-sm-6">
											  <label class="control-label">Matriculation/ITI Marksheet</label>
											</div>
										    <div class="col-sm-6">
										      <img  id="preview_matriculation_marksheet" src="<?php echo base_url();?>uploads/matriculation_certificate/<?php echo $file_matriculation_marksheet; ?>" width="150">
										    </div>
										</div>
								   </div>		
										
								    <div class="col-sm-6">				
										 <div class="form-group" style="width:100%;float:left;">
									       <div class="col-sm-6">
											  <label class="control-label">S.C./S.T., O.B.C. or Ex-Serviceman or PH. Certificate </label>
											</div>
										    <div class="col-sm-6">
										    	<img  id="preview_scc_St_obc_certificate" src="<?php echo base_url();?>uploads/scc_St_obc_certificate/<?php echo $file_sc_st_obc_certitificate; ?>" width="150">
										       <!-- <img id="preview_scc_St_obc_certificate" src="<?php //echo base_url();?>assets/img/placeholder.jpg" width="150"> -->
										    </div>
										</div>
								    </div>		
										
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
      

