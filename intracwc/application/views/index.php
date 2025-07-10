
  <div class="container mrt-60">
       <div class="col-sm-3">
	       <div class="download-container">
		       <h3>Directory</h3>
			   <ul class="dn-links">
					<li>
					   <a href="<?php echo base_url()?>assets/chairman.pdf" target="_blank">
						<i class="fa fa-angle-double-right"></i>Chairman
					   </a>
					</li>
					<li>
						<a href="<?php echo base_url()?>assets/contactlist.pdf" target="_blank">
							<i class="fa fa-angle-double-right"></i>Contact List
						</a>
					</li>
				<!-- 	<li><a href="#"><i class="fa fa-angle-double-right"></i>CE(HRM)/Secretary, CWC</a></li>
					<li><a href="#"><i class="fa fa-angle-double-right"></i>CE(fields)</a></li>
					<li><a href="#"><i class="fa fa-angle-double-right"></i>CE(HQ)</a></li> -->
		      </ul>  
			</div>
			
			 
			
	   </div>

      
	   
        <div class="col-sm-6">  <!--
		      <h3 style="color:#f00;text-align:center;margin-top:-35px;">Notice Board</h3>
		       <table class="table table-stripped table-bordered table-responsive notice-table" >
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Subject</th>
							<th>Circular Date</th>
							<th>Uploaded By</th>
							<th>Category</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>1</td>
							<td>Training Program on overview of water resource.</td>
							<td>23/06/2017</td>
							<td>Administration</td>
							<td>Circular</td>
						</tr>
						
						<tr>
							<td>2</td>
							<td>Training Program on overview of water resource.</td>
							<td>23/06/2017</td>
							<td>Administration</td>
							<td>Circular</td>
						</tr>
						
						<tr>
							<td>3</td>
							<td>Training Program on overview of water resource.</td>
							<td>23/06/2017</td>
							<td>Administration</td>
							<td>Circular</td>
						</tr>
						
						<tr>
							<td>4</td>
							<td>Training Program on overview of water resource.</td>
							<td>23/06/2017</td>
							<td>Administration</td>
							<td>Circular</td>
						</tr>
						<tr>
							<td>5</td>
							<td>Training Program on overview of water resource.</td>
							<td>23/06/2017</td>
							<td>Administration</td>
							<td>Circular</td>
						</tr>
						
						<tr>
							<td>6</td>
							<td>Training Program on overview of water resource.</td>
							<td>23/06/2017</td>
							<td>Administration</td>
							<td>Circular</td>
						</tr>
						
						
						<tr>
							<td>7</td>
							<td>Training Program on overview of water resource.</td>
							<td>23/06/2017</td>
							<td>Administration</td>
							<td>Circular</td>
						</tr>
						
						<tr>
							<td>8</td>
							<td>Training Program on overview of water resource.</td>
							<td>23/06/2017</td>
							<td>Administration</td>
							<td>Circular</td>
						</tr>
						
						<tr>
							<td>9</td>
							<td>Training Program on overview of water resource.</td>
							<td>23/06/2017</td>
							<td>Administration</td>
							<td>Circular</td>
						</tr>
						
						<tr>
							<td>10</td>
							<td>Training Program on overview of water resource.</td>
							<td>23/06/2017</td>
							<td>Administration</td>
							<td>Circular</td>
						</tr>
					
					</tbody>
				</table> -->
        </div>
        
		
		 <div class="col-sm-3">
		 
		 <?php if(empty($this->session->userdata('user_id')))
			    { ?>
		 
		      <a data-toggle="modal" data-target="#myModal1" class="btn btn-primary btn-block" style="margin-bottom:20px;background-color:#0F4C9F;">
		       <i class="fa fa-lock" aria-hidden="true"></i> Register</a>
			   
			   <a data-toggle="modal" data-target="#myModal" class="btn btn-primary btn-block" style="margin-bottom:20px;background-color:#0F4C9F;">
		       <i class="fa fa-lock" aria-hidden="true"></i> Login</a>
		   
				<?php } else {?> 
				
				 <a href="<?php echo base_url()?>admin/" class="btn btn-primary btn-block" style="margin-bottom:20px;background-color:#0F4C9F;">
		          <i class="fa fa-dashboard" aria-hidden="true"></i> Dashboard</a>

				 <a href="<?php echo base_url()?>frontend/logout" class="btn btn-primary btn-block" style="margin-bottom:20px;background-color:#0F4C9F;">
		          <i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
				
				<?php } ?>
		 
	    <!--    <div class="download-container">
		       <h3>Applications</h3>
			   <ul class="dn-links">
					<li><a href="#"><i class="fa fa-angle-double-right"></i>e-office</a></li>
					<li><a href="#"><i class="fa fa-angle-double-right"></i>
					Online stationery request management system</a></li>
					<li><a href="#"><i class="fa fa-angle-double-right"></i>E-HRMS</a></li>
					<li><a href="#"><i class="fa fa-angle-double-right"></i>E-PAMS</a></li>
					<li><a href="#"><i class="fa fa-angle-double-right"></i>PFMS</a></li>
		      </ul>  
			</div> -->

			<div class="download-container">
			   <h3>Related Sites</h3>
			   <ul class="dn-links">

			   	   <li>
				   	   	<a href="http://katiyarprint.com/cwcjobs-audit/">
				   	   		<i class="fa fa-angle-double-right"></i>Work Charged Recruitment System
				   	   	</a>
			   	   </li>

			   	   <li>
				   	   	<a href="http://katiyarprint.com/pensionscheme-audit/">
				   	   		<i class="fa fa-angle-double-right"></i>CWC Pensionscheme
				   	   	</a>
			   	   </li>

					<li>
						<a href="http://katiyarprint.com/intracwc-audit/">
							<i class="fa fa-angle-double-right"></i>Intra CWC
						</a>
					</li>
					
		      </ul>  
			</div>
			
		
	   </div>
		
  </div>
  
<!--- This modal for incorrect login----->
         <div id="messagemodal" class="modal fade" role="dialog">
			  <div class="modal-dialog">
				
				<div class="modal-content">
				
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
				
				  <div class="modal-body">
					  <div class="account-box">
							<div class="account-wrapper">
							  <div class='alert alert-danger'>
			                    <?php echo $this->session->flashdata('flashError_login'); ?> 
			                 </div> 
							</div>
					  </div>
				  </div> 
				</div>
			  </div>
            </div>
   
		
		    <?php if($this->session->flashdata('flashError_login')) { ?>
			
				<script>
				   $('#messagemodal').modal('show');
				</script>
				
			<?php } ?> 
		
<!--- This modal for incorrect login----->
  
  
<!--- This modal for registration ----->
         <div id="messagemodal1" class="modal fade" role="dialog">
			  <div class="modal-dialog">
				
				<div class="modal-content">
				
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
				
				  <div class="modal-body">
					  <div class="account-box">
							<div class="account-wrapper">
							  <div class='alert alert-danger'>
			                    <?php echo $this->session->flashdata('flashError_employee'); ?> 
			                 </div> 
							</div>
					  </div>
				  </div> 
				</div>
			  </div>
            </div>
   
		
		    <?php if($this->session->flashdata('flashError_employee')) { ?>
			
				<script>
				   $('#messagemodal1').modal('show');
				</script>
				
			<?php } ?> 
		
<!--- This modal for incorrect login----->
  
<!--- This modal for registration ----->
         <div id="messagemodal2" class="modal fade" role="dialog">
			  <div class="modal-dialog">
				
				<div class="modal-content">
				
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
				
				  <div class="modal-body">
					  <div class="account-box">
							<div class="account-wrapper">
							  <div class='alert alert-danger'>
			                    <?php echo $this->session->flashdata('registar_add_flashError'); ?> 
			                 </div> 
							</div>
					  </div>
				  </div> 
				</div>
			  </div>
            </div>
   
		
		    <?php if($this->session->flashdata('registar_add_flashError')) { ?>
			
				<script>
				   $('#messagemodal2').modal('show');
				</script>
				
			<?php } ?> 
		
<!--- This modal for incorrect login----->
  
<!--- This modal for registration ----->
         <div id="messagemodal3" class="modal fade" role="dialog">
			  <div class="modal-dialog">
				
				<div class="modal-content">
				
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
				
				  <div class="modal-body">
					  <div class="account-box">
							<div class="account-wrapper">
							  <div class='alert alert-success'>
			                    <?php echo $this->session->flashdata('employee_add_flashSuccess'); ?> 
			                 </div> 
							</div>
					  </div>
				  </div> 
				</div>
			  </div>
            </div>
   
		
		    <?php if($this->session->flashdata('employee_add_flashSuccess')) { ?>
			
				<script>
				   $('#messagemodal3').modal('show');
				</script>
				
			<?php } ?> 
		
<!--- This modal for incorrect login----->
  
  <div id="rolejii"></div>
  
  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
	<button type="button" class="close" data-dismiss="modal">×</button>
      <div class="modal-body">
	      <div class="account-box">
				<div class="account-wrapper">
				  <h3 class="account-title">Intra-CWC Login</h3>
					<?php
					 	$attributes = array('class' => '', 'id' =>'user_login');
     					echo form_open_multipart('frontend/login/',$attributes);?> 
						<div class="form-group form-focus">
						    <label class="control-label">Username/Email<span class="required">*</span></label>
							<input class="form-control floating" type="text" autocomplete="off" placeholder="Username/Email" name="email" >
							<span class = "text-danger"><?php echo form_error('email');?></span>
						</div>
						<div class="form-group form-focus">
						    <label class="control-label">Password<span class="required">*</span></label>
							<input class="form-control floating" type="password" id = "pwd" autocomplete="off" name="password"  placeholder="Password">
							<span class = "text-danger"><?php echo form_error('password');?></span>
						</div>
						
						<div class="form-group form-focus">
							<label class="control-label" style="display:block;">Type the Characters:</label>
							
							<div class="col-sm-6 nopadding">
							 <!--  <input type="hidden" id="txtCaptcha" name="Captcha_text"> -->
							  

                              <input ondrop="return false;" type="text" autocomplete="off" name="CaptchaInput" id="CaptchaInput" size="15" placeholder="Enter Captcha" class="form-control" maxlength="5">
							  <span class = "text-danger"><?php echo form_error('CaptchaInput');?></span>
							  <span class="captcha-error"></span>
							</div>
							
							<div class="col-sm-6">
							    <!-- <div id="CaptchaDiv" oncopy="return false"></div> -->
							    <div id="CaptchaDiv_test" oncopy="return false" style="text-align: center;padding: 6px;width: 100px;font-size: 20px;color: #2662df;background: #b3d9ff;display: inline-block;"><?php echo $captcha; ?></div>
								<a href="javascript:void(0)" onclick="refreshCaptcha()" oncopy="return false" style="font-size: 22px;margin-left: 20px;"><i class="fa fa-refresh"></i></a>
							</div>
							
						</div>
						
						<div class="form-group text-center">
							<button onClick="mySubmit();" type="submit" name="submit" id="login_btn" class="btn btn-primary btn-block account-btn">Login</button>
						</div>
						
					<?php echo form_close(); ?>
				</div>
          </div>
      </div>
    </div>
  </div>
</div>
   <!-- this modal for registration-->
  <div id="myModal1" class="modal fade " role="dialog">
  <div class="modal-dialog modal-lg" style="width:790px">
    <div class="modal-content">
	<button type="button" class="close" data-dismiss="modal">×</button>
      <div class="modal-body">
	      <div class="account-box ">
				<div class="account-wrapper">
				<?php
				$officelist = $this->Base_model->get_all_office_by_condition('employee_office', array('delete_status'=>'0'));
				$all_designation = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
				$all_buildings = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
				$all_employee = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
				$all_roles = $this->Base_model->get_all_record_by_condition('roles',NULL);
				$all_wing = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
				?>
				  <h3 class="account-title">Registration</h3>
					<?php
					 	$attributes = array('class' => '', 'id' =>'add_employee');
     					echo form_open_multipart('frontend/employee_registration/',$attributes);?> 
						<div class="col-sm-6">
							<div class="form-group form-focus min">
							
								<label class="control-label">Employee Name<span class="required">*</span></label>
								<input class="form-control floating" type="text" autocomplete="off" placeholder="Employee Name" name="employee_name" >
								<span class = "text-danger" ><?php echo form_error('employee_name');?></span>
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group form-focus min">
									<label>Office/Directorate/Section<span class="required">*</span></label>
									<select name="employee_post" id="employee_post"  class="form-control">
									   <option selected="selected" value="">Select Office</option>
										<?php
											if(empty($officelist))
											{
												echo '';
											}

											else
											{
											foreach ($officelist as $office)
						                      {  
													
						                         echo '<option value="'.$office->office_id.'">'.$office->office_name.'</option>';
													
						                      }
											}
					                      
					                    ?>
									</select>							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group form-focus min">
							
								<label class="control-label">Designation<span class="required">*</span></label>
								<select name="employee_designation" id="employee_designation" class="form-control">
									   <option selected="selected" value="">Select Designation</option>
										<?php
											if(empty($all_designation))
											{
												echo '';
											}

											else
											{
												foreach ($all_designation as $designation)
						                      {  
													if($designation->designation_id!=18 && $designation->designation_id!=172 && $designation->designation_id!=175 && $designation->designation_id!=174 &&  $designation->designation_id!=169)
													{
													continue;
													}
						                         echo '<option value="'.$designation->designation_id.'">'.$designation->designation_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
							</div>
						</div>
					<!--	<div class="col-sm-6">
							<div class="form-group form-focus min">
								<label class="control-label">Reporting Officer</label>
								<select class="form-control" name="reporting_officer">
									   <option selected="selected" value="">Select Reporting Officer</option>
										
										<?php
											// if(empty($all_employee))
											// {
												// echo '';
											// }

											// else
											// {
												// foreach ($all_employee as $employee)
						                      // {   
						                      	// $desigantion_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $employee->employee_designation));
                                    			// $desigantion =  $desigantion_data->designation_name;	
						                         // echo '<option value="'.$employee->employee_id.'">'.$employee->employee_name.' | '.$employee->employee_code.' | '.$desigantion.'</option>';
						                      // }
											// }
					                      
					                    ?>
									</select>
							</div>
						</div>-->
						<div class="col-sm-6">
							<div class="form-group form-focus min ">
							
								<label class="control-label">Mobile<span class="required">*</span></label>
								<input class="form-control" name="employee_mobile" maxlength="10" type="text" placeholder="Mobile" value = "<?php echo isset($insertData['employee_mobile']) ? $insertData['employee_mobile'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_mobile');?></span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group form-focus min">
								<label class="control-label">Landline No.(office)<span class="required">*</span></label>
								<input class="form-control" name="employee_landline_no" maxlength="13" type="text" placeholder="Landline No." value = "<?php echo isset($insertData['employee_landline_no']) ? $insertData['employee_landline_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_landline_no');?></span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group form-focus min">
								<label class="control-label">Landline No.(Residence)</label>
								<input class="form-control" maxlength="13" name="employee_landline_no_residence" type="text" placeholder="Landline Residence No." value = "<?php echo isset($insertData['employee_landline_no_residence']) ? $insertData['employee_landline_no_residence'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_landline_no_residence');?></span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group form-focus min">
								<label class="control-label">Email<span class="required">*</span></label>
								<input class="form-control" maxlength="100" name="employee_email" type="email" placeholder="Email Id" value = "<?php echo isset($insertData['employee_email']) ? $insertData['employee_email'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_email');?></span>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group form-focus min">
							
								<label class="control-label">Building<span class="required">*</span></label>
								<select name="building_name" id="building_id1" class="form-control">
									   <option selected="selected" value="">Select Building</option>
										<?php
									 		if(empty($all_buildings))
											{
												echo '<option value="1">'.'Select Building'.'</option>';
											}

											else
											{	
												foreach ($all_buildings as $building)
						                      {   
						                         echo '<option value="'.$building->building_id.'">'.$building->building_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group form-focus min">
								<label class="control-label">Floor</label>
								<select name="rooom_id" id="room_id" class="form-control">
									   <option selected="selected" value="">Select Floor</option>
									</select>
							</div>
						</div>
	
						<div class="col-sm-6">
							<div class="form-group form-focus min">
								<label class="control-label">B.P.L. No.<span class="required">*</span></label>
								<input class="form-control" name="employee_intercom" type="text" placeholder="B.P.L. No." maxlength="5" value = "<?php echo isset($insertData['employee_intercom']) ? $insertData['employee_intercom'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_intercom');?></span>
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group form-focus min">
								
								<label class="control-label" style="
                                  display: block;">Roles<span class="required">*</span></label>
									<select id="user_role" style="width: 335px;" class="form-control1 "  onchange="checkandverify();" name="user_role[]" data-placeholder="Select Role">
									    <option value="">Select Role</option>
										<?php
											if(empty($all_roles))
											{
												echo '<option value="">Select Role</option>';
											}

											else
											{
												foreach ($all_roles as $roles)
						                      {  
													if($roles->role_id!='11'  )
													{
														continue;
													}											  
						                         echo '<option value="'.$roles->role_id.'">'.$roles->name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
									<span class ="text-danger" id="alert" style="color:red;"></span>
							</div>
						</div>
						
						<div class="col-sm-6" id="alert2" style="display:none;">
							<div class="form-group form-focus min">
								<label class="control-label">Enter OTP</label>
								<input class="form-control" id="otp" onkeyup="checkotp();" type="text" autofocus placeholder="Enter Otp">
									<span class ="text-danger" id="alert3" style="color:green;"></span>
									<span class ="text-danger" id="alert4" style="color:red;"></span>
									<input class="form-control" id="text"   type="hidden" >
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group form-focus min">
								<label class="control-label" style="display: block;">User Access</label>
								<select id="user_access" style="width: 335px;" class="form-control multiple_roles" multiple="multiple" name="user_access[]" data-placeholder="Select User Access">
										<option value="1">Non IT Online Stationery</option>
										<option value="2">IT Online Stationery</option>
								</select>
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group form-focus min">
								<label class="control-label">Wing<span class="required">*</span></label>
									<select id="wing_id1" class="form-control"  name="wing_name">
									   <option selected="selected" value="">Select Wing</option>
										<?php
											if(empty($all_wing))
											{
												echo '';
											}

											else
											{
												foreach ($all_wing as $wing)
						                      {   
						                         echo '<option value="'.$wing->wing_id.'">'.$wing->wing_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>

							</div>
						</div>
						
						<!--<div class="col-sm-6">
							<div class="form-group form-focus min">
								<label class="control-label">Section<span class="required">*</span></label>
								<select id="section_id1" class="form-control"  name="section_name">
										<option selected="selected" value="">Select Section</option>
									
									</select>
							</div>
						</div>-->
						
						<div class="col-sm-6">
							<div class="form-group form-focus min">
								<label class="control-label">User Id<span class="required">*</span></label>
								<input class="form-control" name="user_id" id="userrid" type="text" value = "<?php echo isset($insertData['user_id']) ? $insertData['user_id'] : ''; ?>" placeholder="User Id">
									<span class ="text-danger"><?php echo form_error('user_id');?></span>
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group form-focus min">
									<label>Password<span class="required">*</span></label>
									<input class="form-control" type="password" id="pwd3" name="password" placeholder="Password" maxlength="70">
									<span class = "text-danger"><?php echo form_error('password');?></span>
									<span id="span_password_msg" style="color:red">Please enter password in format consits of one upper case,one lower case,one digit, one special character.</span>
							</div>
						</div>
						
						<div class="col-sm-6">
							<div class="form-group form-focus min">
									<label>Confirm Password<span class="required">*</span></label>
									<input class="form-control" type="password" id="pwd2" name="cnfrm_password" placeholder="Confirm Password" maxlength="70">
									<span class = "text-danger"><?php echo form_error('cnfrm_password');?></span>
									<span id="span_password_msg2" style="color:red">Please enter password in format consits of one upper case,one lower case,one digit, one special character.</span>
							</div> 
						</div>
						
						<div class="form-group text-center" >
							<button onClick="mySubmit_register();" type="submit" name="submit" disabled="disabled" id="reg_btn" class="btn btn-primary btn-block account-btn but">Register</button>
						</div>
						
					<?php echo form_close();?>
				</div>
          </div>
      </div>
    </div>
  </div>
</div>
   <!-- this modal for registration--> 
                  <!--  Popup modal -->			
					<div class="example-modal">
						<div class="modal fade" aria-hidden="true" id="deleteModal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Role Description</h4>
									</div>
									<div class="modal-body">
										       <table class="display datat22able table table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Role</th>
											<th>Description</th>
												
                                        </tr>
                                    </thead>
                                    <tbody>
									  <?php
											if($all_roles) {
												$i=1;
												foreach($all_roles as $rol) { ?>	
                                       <tr>
                                            <td><?php echo $i;?></td>
											<td><?php echo $rol->name;?></td>
                                            <td><?php echo $rol->description;?>e</td>	
                                       </tr>
                                        <?php $i++;} } else { ?>
										<tr><td>No data found</td></tr>
										<?php } ?>
											
                                    </tbody>
                                </table>
									</div>
									<div class="modal-footer">
										
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div><!-- /.example-modal -->
				<!-- ./ Popup modal -->
        <style type="text/css">
        	.help_icon {
		    color:#fff;
		    background-color:#feb22a;
		    width:12px;
		    height:12px;
		    display:inline-block;
		    border-radius:100%;
		    font-size:10px;
		    text-align:center;
		    text-decoration:none;
		    -webkit-box-shadow: inset -1px -1px 1px 0px rgba(0,0,0,0.25);
		    -moz-box-shadow: inset -1px -1px 1px 0px rgba(0,0,0,0.25);
		    box-shadow: inset -1px -1px 1px 0px rgba(0,0,0,0.25);
			}
			.checkbox label{
				       font-size: 15px;
					    width: 18%;
					    margin: 6px 0;
			}

			.checkbox input{
				    width: 16px;
                    height: 16px;
			}
        </style> 
   
	<script type="text/javascript">
	
	 // Captcha Script
	 $('#CaptchaInput').bind('cut copy paste', function (e) {
           e.preventDefault();
          });

	// Captcha Script

	// Captcha Script

	function checkform(theform){
	var why = "";

	if(theform.CaptchaInput.value == ""){
	why += "- Please Enter CAPTCHA Code.\n";
	}
	if(theform.CaptchaInput.value != ""){
	if(ValidCaptcha(theform.CaptchaInput.value) == false){
	why += "- The CAPTCHA Code Does Not Match.\n";
	}
	}
	if(why != ""){
	alert(why);
	return false;
	}
	}

	
	///////
	function refreshCaptcha(){
		
	var base_url = "<?php echo base_url(); ?>";
		var base_urwwwwl = "<?php echo time(); ?>";
        var link = base_url+'Frontend/captccha/';
        var csrf_test_name = $("input[name=csrf_test_name]").val();

          $.ajax({
            method: "POST",
            url: link,
           data: {'csrf_test_name' : base_urwwwwl},
            success: function(result) {
                //alert() console.log(typeof(result));
               var obj = JSON.parse(result);
               if(obj)
               {
          
                document.getElementById("CaptchaDiv_test").innerHTML = obj.msg;
                       
                     // return false;    
               }
            }
        
        });
	
	}//ends refreshcaptcha function

	// Validate input against the generated number
	function ValidCaptcha(){
	var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
	var str2 = removeSpaces(document.getElementById('CaptchaInput').value);
	if (str1 == str2){
	return true;
	}else{
	return false;
	}
	}

	// Remove the spaces from the entered and generated code
	function removeSpaces(string){
	return string.split(' ').join('');
	}
</script>	
<script>	
  function checkandverify(){
    var user_role = $('#user_role').val();
    var employee_post = $('#employee_post').val();
	var option='';
	if(user_role!='' && employee_post!='')
	{
	var base_url = "<?php echo base_url(); ?>";
    $.ajax({
     url:base_url+'Frontend/checkandverify/',
     method: 'post',
     data: {user_role: user_role,employee_post:employee_post},
     success: function(result){
	  console.log(typeof(result));
      var obj = JSON.parse(result);
	  if(obj)
	  {
	      
	      if(obj.new_user =='1'){
	          
	          $(".but").prop('disabled', false); 
	          
	      } else{
	          
	          $.each(obj, function(){
					$('#alert').html('This Role has already assigned to '+this["employee_name"]+'. OTP has sent to '+this["employee_name"]+' email.');
					$("#text").val(this["employee_email"]);
					$("#alert2").show();
					$("#otp").focus(); 
					$("#alert").show(); 
                });
	      }
            
	  }
	  
         event.preventDefault();
         
     },
    });
	}
	
	else
	{
		alert('Please Select Office.');
		$("#alert2").hide();
		$("#alert").hide();
	}
  } 
	</script>
<script>	
  function checkotp(){
    var otp = $('#otp').val();
    var id = $('#text').val();
	var len = otp.length;
	//alert(len);
	if(otp!='')
	{
	if(len==4)
	{
	var base_url = "<?php echo base_url(); ?>";
    $.ajax({
     url:base_url+'Frontend/checkotp/',
     method: 'post',
     data: {otp: otp,id:id},
     success: function(result){
	  console.log(typeof(result));
      var obj = JSON.parse(result);
	 // alert(obj);
	  if(obj==1)
	  {
		  $('#alert3').html('OTP Submitted.');
		  $("#alert3").hide(6000);
		  $(".but").prop('disabled', false);
	  }
	  else
	  {
		  $('#alert4').html('OTP is wrong,pleae try again.');
		  $("#alert4").hide(6000);
		  $(".but").prop('disabled', true);
	  }
         event.preventDefault();
     },
    });
	}
	}
	else
	{
		alert('Please Enter OTP First.');
	}
  } 
	</script>
 <style>
 .form-control1 {
    height: 40px;
    padding: 8px 12px 6px;
}
.form-control1 {
    border-radius: 0;
    box-shadow: none;
    height: 80px;
}
.form-control1 {
    display: block;
    width: 100%;
    height: 34px;
    padding: 6px 12px;
    font-size: 14px;
    line-height: 1.42857143;
    color: #555;
    background-color: #fff;
    background-image: none;
    border: 1px solid #ccc;
    border-radius: 4px;
    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
.min{
	    min-height: 84px;
}
 </style>