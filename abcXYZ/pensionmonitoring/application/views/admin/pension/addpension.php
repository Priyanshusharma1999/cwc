  
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Pension Details</h6>
								<hr>
					

						<?php if($this->session->flashdata('flashError_pension')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_pension'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
						<?php } ?>
								
						<form>
						   <div class="col-sm-12">
								<div class="form-group" style="margin-bottom:30px;">
									<label>Select Type<span class="required">*</span></label>
									<select required="required" class="form-control" id="type">
										<option value="A" selected="selected">
										  Status Of Pending old Pension Scheme(Except Family Pension)
										</option>
										
										<option value="B">
										  Status Of Pending old Pension Scheme(Only Family Pension)
										</option>
										
										<option value="C">
										   Status Of Pending New Pension Scheme(Except Family Pension)
										</option>
										
										<option value="D">
										  Status Of Pending New Pension Scheme(Only Family Pension)
										</option>
									</select>
								</div>
							</div>
						</form>  
						
						<?php
					 	$attributes = array('class' => 'penform', 'id' =>'addpenform', 'onSubmit'=>'return pension_submit1();');
     					echo form_open_multipart('Pension/addpension_form/'.$this->session->userdata('applicant_user_id'),$attributes);?> 
						
						  <h3 class="title">
						     A) Status Of Pending old Pension Scheme(Except Family Pension)
						  </h3>
						  
						 
						  <input type="hidden" name="pension_type" value="POPSEF" id="pensiontype">

						  <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Organisation<span class="required">*</span></label>
									<?php

									$userdata = $this->Base_model->get_record_by_id('users',array('USERS_ID'=>$this->session->userdata('applicant_user_id')));

									$orgndata = $this->Base_model->get_record_by_id('organization',array('ORGANIZATION_ID'=>$userdata->ORGANIZATION_ID));


									if($userdata->ROLE_ID == '1' || $userdata->ROLE_ID == '5')
									{?>
									<select  name="organisation" class="form-control" id="org">
									    <option value="">Select Organisation</option>
										<?php foreach($all_organizations as $orgn){?>
									     <option value="<?php echo $orgn->ORGANIZATION_ID; ?>" >
										   <?php echo $orgn->ORGNAME; ?>
										 </option>
									   <?php } ?>
									</select>
								  <?php }else{?>
								  	<select  name="organisation" class="form-control" id="org">
									    <option value="">Select Organisation</option>
										
									     <option value="<?php echo $orgndata->ORGANIZATION_ID; ?>" >
										   <?php echo $orgndata->ORGNAME; ?>
										 </option>
									   
									</select>
									<?php } ?>
									<span class = "text-danger"><?php echo form_error('organisation');?></span>
								</div>
							</div>


							<div class="col-sm-6">
								<div class="form-group">
									<label>Name of the division dealing the pension cases<span class="required">*</span></label>
									<select  name="division" class="form-control" id="division">
									   <option value="">Select Division</option>
									</select>
									
									<span class = "text-danger"><?php echo form_error('division');?></span>
								</div>
							</div>
							
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Employee/Pensioner<span class="required">*</span></label>
									<input class="form-control" type="text" name="name" placeholder="Name of the Employee/Pensioner" id="name1" value = "<?php echo isset($insertData['name']) ? $insertData['name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('name');?></span>
								</div>
							</div>

							 <div class="col-sm-6">
								<div class="form-group">
									<label>Employee/Pensioner Designation<span class="required">*</span></label>
									<input class="form-control" type="text" name="emp_designation" placeholder="Employee/Pensioner Designation"  value = "<?php echo isset($insertData['emp_designation']) ? $insertData['emp_designation'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('emp_designation');?></span>
								</div>
							</div>

							<!--a-->

							<div class="col-sm-6">
								<div class="form-group">
									<label>Whether pension paper has been submitted<span class="required">*</span></label>
									<select name="pension_paper_submit" id="pension_paper_submit" class="form-control pension_paper_submit">
									   <option  selected="selected" value="">Select Pension Paper Status</option>
									   <option  value="Yes">Yes</option>
									   <option  value="No">No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>


							<div class="col-sm-6 submission_date" >
								<div class="form-group">
									<label>Pension Paper Submission Date<span class="required"></span></label>
									<div class="cal-icon">
									<input class="form-control datetimepicker" type="text" name="pension_paper_submission_date" autocomplete="off" id="datepicker11" placeholder="Pension Paper Submission Date(DD/MM/YY)" value = "<?php echo isset($insertData['pension_paper_submission_date']) ? $insertData['pension_paper_submission_date'] : ''; ?>">
									</div>
									<span class = "text-danger"><?php echo form_error('pension_paper_submission_date');?></span>

								</div>
							</div>

							<div class="col-sm-6 submission_status1">
								<div class="form-group">
									<label>Pension status for final settlement<span class="required">*</span></label>
									<select  name="submission_status1"  class="form-control">
									  <!--  <option selected="selected" value="">Select Status of Pension Final Settlement</option> -->
									   <option  selected="selected" value="Pending">Pending</option>
									   <option  value="Settled">Settled</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status2">
								<div class="form-group">
									<label>Pension status for final settlement<span class="required">*</span></label>
									<select  name="submission_status2"  class="form-control">
									   <!-- <option selected="selected" value="">Select Status of Pension Final Settlement</option> -->
									   <option selected="selected"  value="Pending">Pending</option>
									  
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>


							<!--ddd-->
						  
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Date of Retirement<span class="required">*</span></label>
									<div class="cal-icon">
									  <input class="form-control datetimepicker" name="date_ret"  placeholder="DD/MM/YY" type="text" autocomplete="off" id="datepicker12" value = "<?php echo isset($insertData['date_ret']) ? $insertData['date_ret'] : ''; ?>">
									</div>
									  <span class = "text-danger"><?php echo form_error('date_ret');?></span>
									
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No<span class="required">*</span></label>
									<input class="form-control" type="text" name="mobile_no" maxlength="10" placeholder="Mobile No" id="mobile_no1" value = "<?php echo isset($insertData['mobile_no']) ? $insertData['mobile_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email Id<span class="required"></span></label>
									<input class="form-control" type="text" name="email" placeholder="Email Id" value = "<?php echo isset($insertData['email']) ? $insertData['email'] : ''; ?>" id="email1">
									<span class = "text-danger"></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Gender<span class="required">*</span></label>
									<select  name="gender" class="form-control" id="gender1">
									   <option selected="selected" value="">Select gender</option>
									   <option  value="MALE" <?php if($insertData['gender'] == 'MALE') echo 'selected="selected"' ?>>Male</option>
									   <option  value="FEMALE" <?php if($insertData['gender'] == 'FEMALE') echo 'selected="selected"' ?>>Female</option>
									</select>
									<span class = "text-danger"><?php echo form_error('gender');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Aadhar No.<span class="required"></span></label>
									<input class="form-control stop_alpha" id="adhar_1" type="text" name="aadhar_no" placeholder="Aadhar No." value = "<?php echo isset($insertData['aadhar_no']) ? $insertData['aadhar_no'] : ''; ?>" >
									<span class="aadhar_validation"></span>
									<span class = "text-danger"><?php echo form_error('aadhar_no');?></span>
								</div>
							</div>

							

							<div class="col-sm-6">
								<div class="form-group">
									<label>PAN No.<span class="required">*</span></label>
									<input class="form-control" type="text" id="pan_1" name="pan_no" placeholder="PAN No." value = "<?php echo isset($insertData['pan_no']) ? $insertData['pan_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('pan_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Relationship With Pensioner<span class="required">*</span></label>
									<select  name="relation" class="form-control" id="relnshp_pensioner1">
									   <option selected="selected" value="">Select relation</option>
									   <option  value="Self" <?php if($insertData['relation'] == 'Self') echo 'selected="selected"' ?>>Self</option>
									   <option  value="Spouse" <?php if($insertData['relation'] == 'Spouse') echo 'selected="selected"' ?>>Spouse</option>
									   <option  value="Father" <?php if($insertData['relation'] == 'Father') echo 'selected="selected"' ?>>Father</option>
									   <option  value="Mother" <?php if($insertData['relation'] == 'Mother') echo 'selected="selected"' ?>>Mother</option>
									   <option  value="Son" <?php if($insertData['relation'] == 'Son') echo 'selected="selected"' ?>>Son</option>
									   <option  value="Daughter" <?php if($insertData['relation'] == 'Daughter') echo 'selected="selected"' ?>>Daughter</option>
									</select>
									<span class = "text-danger"><?php echo form_error('relation');?></span>
								</div>
							</div>
							
							<div class="col-sm-6" id="annual_ver">
								<div class="form-group">
									<label>Whether Annual Verification of service book completed<span class="required">*</span></label>
									<select  name="service_book" class="form-control" id="servicebook1">
									   <option selected="selected" value="">Select Status</option>
									   <option  value="1" <?php if($insertData['service_book'] == '1') echo 'selected="selected"' ?>>Yes</option>
									   <option  value="0" <?php if($insertData['service_book'] == '0') echo 'selected="selected"' ?>>No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('service_book');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Whether the case is pending with PAO(YES/No)<span class="required">*</span></label>
									<select  name="pao_status" class="form-control" id="paostatus1">
									   <option selected="selected" value="">Select Status</option>
									   <option  value="1" <?php if($insertData['pao_status'] == '1') echo 'selected="selected"' ?>>Yes</option>
									   <option  value="0" <?php if($insertData['pao_status'] == '0') echo 'selected="selected"' ?>>No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pao_status');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6" id="ppono">
								<div class="form-group">
									<label>PPO Number if issued<span class="required"></span></label>
									<input class="form-control" type="text" maxlength="12" name="ppo_number" placeholder="PPO No." value = "<?php echo isset($insertData['ppo_number']) ? $insertData['ppo_number'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('ppo_number');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Present Residential Address<span class="required">*</span></label>
									<textarea class="form-control" id="address1" name="address" placeholder="Present Residential Address"><?php echo isset($insertData['address']) ? $insertData['address'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('address');?></span>
								</div>
							</div>
							
							<div class="col-sm-6" id="ppostatus">
								<div class="form-group">
								  <label>If PPO no. is yet to be issued, the status of pension papers<span class="required"></span></label>
									<textarea class="form-control" name="status_pensioner"  placeholder="status of pension papers"><?php echo isset($insertData['status_pensioner']) ? $insertData['status_pensioner'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('status_pensioner');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>
									Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP etc)<span class="required">*</span>
									</label>
									<textarea class="form-control" id="specific_details1" name="specific_details" placeholder="details"><?php echo isset($insertData['specific_details']) ? $insertData['specific_details'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('specific_details');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Remarks<span class="required"></span></label>
									<textarea class="form-control" name="remarks" placeholder="Remarks"><?php echo isset($insertData['remarks']) ? $insertData['remarks'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('remarks');?></span>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="checkbox" id="accept1" name="accept" value="1"><span class="required">*</span> It is certified that the above updated status has the approval of Chief Engineer of this Organisation.
									<span class = "text-danger"><?php echo form_error('remarks');?></span>
								</div>
							</div>
							
							<div class="m-t-20" style="padding-left:15px;clear:both;">
						<button type="submit" name="submit" class="btn btn-primary" id="pensionbtn">Add Pension Details</button>
							</div>
						<?php echo form_close();?>



	<!--**************************************************************************************************************-->

						<?php
					 	$attributes = array('class' => 'penform', 'id' =>'addpenform1','onSubmit'=>'return pension_submit2();');
     					echo form_open_multipart('pension/addpension_form/'.$this->session->userdata('applicant_user_id'),$attributes);?> 
						
						  
						  <h3 class="title">
						     B) Status Of Pending old Pension Scheme(Only Family Pension)
						  </h3>
						 
						  
						  <input type="hidden" name="pension_type" value="POPSEF" id="pensiontype1">


						 <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Organisation<span class="required">*</span></label>
									<?php

									$userdata = $this->Base_model->get_record_by_id('users',array('USERS_ID'=>$this->session->userdata('applicant_user_id')));

									$orgndata = $this->Base_model->get_record_by_id('organization',array('ORGANIZATION_ID'=>$userdata->ORGANIZATION_ID));


									if($userdata->ROLE_ID == '1' || $userdata->ROLE_ID == '5')
									{?>
									<select  name="organisation" class="form-control" id="org1">
									    <option value="">Select Organisation</option>
										<?php foreach($all_organizations as $orgn){?>
									     <option value="<?php echo $orgn->ORGANIZATION_ID; ?>" >
										   <?php echo $orgn->ORGNAME; ?>
										 </option>
									   <?php } ?>
									</select>
								  <?php }else{?>
								  	<select  name="organisation" class="form-control" id="org1">
									    <option value="">Select Organisation</option>
										
									     <option value="<?php echo $orgndata->ORGANIZATION_ID; ?>" >
										   <?php echo $orgndata->ORGNAME; ?>
										 </option>
									   
									</select>
									<?php } ?>
									<span class = "text-danger"><?php echo form_error('organisation');?></span>
								</div>
							</div>


							<div class="col-sm-6">
								<div class="form-group">
									<label>Name of the division dealing the pension cases<span class="required">*</span></label>
									<select  name="division" class="form-control" id="division1">
									   <option value="">Select Division</option>
									</select>
									
									<span class = "text-danger"><?php echo form_error('division');?></span>
								</div>
							</div>
						  
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Employee/Pensioner<span class="required">*</span></label>
									<input class="form-control" id="name2" type="text" name="name" placeholder="Name of the Employee/Pensioner" value = "<?php echo isset($insertData['name']) ? $insertData['name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('name');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Employee/Pensioner Designation<span class="required">*</span></label>
									<input class="form-control" type="text" name="emp_designation" placeholder="Employee/Pensioner Designation"  value = "<?php echo isset($insertData['emp_designation']) ? $insertData['emp_designation'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('emp_designation');?></span>
								</div>
							</div>

							<!--dfgh-->

							<div class="col-sm-6">
								<div class="form-group">
									<label>Whether pension paper has been submitted<span class="required">*</span></label>
									<select name="pension_paper_submit" id="pension_paper_submit2" class="form-control pension_paper_submit">
									   <option  selected="selected" value="">Select Pension Paper Status</option>
									   <option  value="Yes">Yes</option>
									   <option  value="No">No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>


							<div class="col-sm-6 submission_date" >
								<div class="form-group">
									<label>Pension Paper Submission Date<span class="required">*</span></label>
									<div class="cal-icon">
									<input class="form-control datetimepicker" type="text" name="pension_paper_submission_date" placeholder="Pension Paper Submission Date(DD/MM/YY)" autocomplete="off" id="datepicker13" value = "<?php echo isset($insertData['pension_paper_submission_date']) ? $insertData['pension_paper_submission_date'] : ''; ?>">
								</div>
									<span class = "text-danger"><?php echo form_error('pension_paper_submission_date');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status1">
								<div class="form-group">
									<label>Pension status for final settlement<span class="required">*</span></label>
									<select  name="submission_status1"  class="form-control">
									  <!--  <option selected="selected" value="">Select Status of Pension Final Settlement</option> -->
									   <option  selected="selected" value="Pending">Pending</option>
									   <option  value="Settled">Settled</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status2">
								<div class="form-group">
									<label>Pension status for final settlement<span class="required">*</span></label>
									<select  name="submission_status2"  class="form-control">
									   <!-- <option selected="selected" value="">Select Status of Pension Final Settlement</option> -->
									   <option selected="selected"  value="Pending">Pending</option>
									  
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							
							<!--Dfghh-->
						 
							
							<div class="col-sm-6 nodispaly" id="dod">
								<div class="form-group">
									<label>Date of Death<span class="required">*</span></label>
									<div class="cal-icon">
									 <input class="form-control datetimepicker"  name="date_death" id="datepicker14" autocomplete="off" placeholder="DD/MM/YY" type="text" value = "<?php echo isset($insertData['date_death']) ? $insertData['date_death'] : ''; ?>">
									 <span class = "text-danger"><?php echo form_error('date_death');?></span>
									</div>
								</div>
							</div>
							
							<div class="col-sm-6 nodispaly" id="namofm">
								<div class="form-group">
									<label>Name of Family Member Eligible for Pension<span class="required">*</span></label>
									<input class="form-control" id="familymemname2" type="text" name="name_familymember" placeholder="Name of Family Member" value = "<?php echo isset($insertData['name_familymember']) ? $insertData['name_familymember'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('name_familymember');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No<span class="required">*</span></label>
									<input class="form-control" id="mobile_no2" type="text" name="mobile_no" maxlength="10" placeholder="Mobile No" value = "<?php echo isset($insertData['mobile_no']) ? $insertData['mobile_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email Id<span class="required"></span></label>
									<input class="form-control" id="email2" type="text" name="email" placeholder="Email Id" value = "<?php echo isset($insertData['email']) ? $insertData['email'] : ''; ?>">
									<span class = "text-danger"></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Gender<span class="required">*</span></label>
									<select  name="gender" id="gender2" class="form-control">
									   <option selected="selected" value="">Select gender</option>
									   <option  value="MALE" <?php if($insertData['gender'] == 'MALE') echo 'selected="selected"' ?>>Male</option>
									   <option  value="FEMALE" <?php if($insertData['gender'] == 'FEMALE') echo 'selected="selected"' ?>>Female</option>
									</select>
									<span class = "text-danger"><?php echo form_error('gender');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Aadhar No.<span class="required"></span></label>
									<input class="form-control stop_alpha" id="adhar_2" type="text" name="aadhar_no" placeholder="Aadhar No." value = "<?php echo isset($insertData['aadhar_no']) ? $insertData['aadhar_no'] : ''; ?>">
									<span class="aadhar_validation"></span>
									<span class = "text-danger"><?php echo form_error('aadhar_no');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>PAN No.<span class="required">*</span></label>
									<input class="form-control" type="text" id="pan_2" name="pan_no" placeholder="PAN No." value = "<?php echo isset($insertData['pan_no']) ? $insertData['pan_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('pan_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Relationship With Pensioner<span class="required">*</span></label>
									<select  name="relation" id="relnshp_pensioner2" class="form-control">
									   <option selected="selected" value="">Select relation</option>
									   <option  value="Self" <?php if($insertData['relation'] == 'Self') echo 'selected="selected"' ?>>Self</option>
									   <option  value="Spouse" <?php if($insertData['relation'] == 'Spouse') echo 'selected="selected"' ?>>Spouse</option>
									    <option  value="Father" <?php if($insertData['relation'] == 'Father') echo 'selected="selected"' ?>>Father</option>
									   <option  value="Mother" <?php if($insertData['relation'] == 'Mother') echo 'selected="selected"' ?>>Mother</option>
									   <option  value="Son" <?php if($insertData['relation'] == 'Son') echo 'selected="selected"' ?>>Son</option>
									   <option  value="Daughter" <?php if($insertData['relation'] == 'Daughter') echo 'selected="selected"' ?>>Daughter</option>
									</select>
									<span class = "text-danger"><?php echo form_error('relation');?></span>
								</div>
							</div>
							
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Whether the case is pending with PAO(YES/No)<span class="required">*</span></label>
									<select  name="pao_status" id="paostatus2" class="form-control">
									   <option selected="selected" value="">Select Status</option>
									   <option  value="1" <?php if($insertData['pao_status'] == '1') echo 'selected="selected"' ?>>Yes</option>
									   <option  value="0" <?php if($insertData['pao_status'] == '0') echo 'selected="selected"' ?>>No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pao_status');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6" id="ppono">
								<div class="form-group">
									<label>PPO Number if issued<span class="required"></span></label>
									<input class="form-control" type="text" maxlength="12" name="ppo_number" placeholder="PPO No." value = "<?php echo isset($insertData['ppo_number']) ? $insertData['ppo_number'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('ppo_number');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Present Residential Address<span class="required">*</span></label>
									<textarea class="form-control" id="address2" name="address" placeholder="Present Residential Address"><?php echo isset($insertData['address']) ? $insertData['address'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('address');?></span>
								</div>
							</div>
							
							<div class="col-sm-6" id="ppostatus">
								<div class="form-group">
								  <label>If PPO no. is yet to be issued, the status of pension papers<span class="required"></span></label>
									<textarea class="form-control" name="status_pensioner"  placeholder="status of pension papers"><?php echo isset($insertData['status_pensioner']) ? $insertData['status_pensioner'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('status_pensioner');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>
									Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP etc)<span class="required">*</span>
									</label>
									<textarea class="form-control" id="specific_details2" name="specific_details" placeholder="details"><?php echo isset($insertData['specific_details']) ? $insertData['specific_details'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('specific_details');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Remarks<span class="required"></span></label>
									<textarea class="form-control" name="remarks" placeholder="Remarks"><?php echo isset($insertData['remarks']) ? $insertData['remarks'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('remarks');?></span>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="checkbox" name="accept" value="1" id="accept2"><span class="required">*</span> It is certified that the above updated status has the approval of Chief Engineer of this Organisation.
									<span class = "text-danger"><?php echo form_error('remarks');?></span>
								</div>
							</div>
							
							<div class="m-t-20" style="padding-left:15px;clear:both;">
						<button type="submit" name="submit" class="btn btn-primary" id="pensionbtn1">Add Pension Details</button>
							</div>
						<?php echo form_close();?>

	<!--**************************************************************************************************************-->

						<?php
					 	$attributes = array('class' => 'penform', 'id' =>'addpenform2','onSubmit'=>'return pension_submit3();');
     					echo form_open_multipart('pension/addpension_form/'.$this->session->userdata('applicant_user_id'),$attributes);?> 

						  <h3 class="title">
						     C) Status Of Pending New Pension Scheme(Except Family Pension)
						  </h3>
						  
						  <input type="hidden" name="pension_type" value="POPSEF" id="pensiontype2">


						   <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Organisation<span class="required">*</span></label>
									<?php

									$userdata = $this->Base_model->get_record_by_id('users',array('USERS_ID'=>$this->session->userdata('applicant_user_id')));

									$orgndata = $this->Base_model->get_record_by_id('organization',array('ORGANIZATION_ID'=>$userdata->ORGANIZATION_ID));


									if($userdata->ROLE_ID == '1' || $userdata->ROLE_ID == '5')
									{?>
									<select  name="organisation" class="form-control" id="org2">
									    <option value="">Select Organisation</option>
										<?php foreach($all_organizations as $orgn){?>
									     <option value="<?php echo $orgn->ORGANIZATION_ID; ?>" >
										   <?php echo $orgn->ORGNAME; ?>
										 </option>
									   <?php } ?>
									</select>
								  <?php }else{?>
								  	<select  name="organisation" class="form-control" id="org2">
									    <option value="">Select Organisation</option>
										
									     <option value="<?php echo $orgndata->ORGANIZATION_ID; ?>" >
										   <?php echo $orgndata->ORGNAME; ?>
										 </option>
									   
									</select>
									<?php } ?>
									<span class = "text-danger"><?php echo form_error('organisation');?></span>
								</div>
							</div>


							<div class="col-sm-6">
								<div class="form-group">
									<label>Name of the division dealing the pension cases<span class="required">*</span></label>
									<select  name="division" class="form-control" id="division2">
									   <option value="">Select Division</option>
									</select>
									
									<span class = "text-danger"><?php echo form_error('division');?></span>
								</div>
							</div>
							
							
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Employee/Pensioner<span class="required">*</span></label>
									<input class="form-control" id="name3" type="text" name="name" placeholder="Name of the Employee/Pensioner" value = "<?php echo isset($insertData['name']) ? $insertData['name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('name');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Employee/Pensioner Designation<span class="required">*</span></label>
									<input class="form-control" type="text" name="emp_designation" placeholder="Employee/Pensioner Designation"  value = "<?php echo isset($insertData['emp_designation']) ? $insertData['emp_designation'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('emp_designation');?></span>
								</div>
							</div>

							<!--d1-->

							<div class="col-sm-6">
								<div class="form-group">
									<label>Whether pension paper has been submitted<span class="required">*</span></label>
									<select name="pension_paper_submit" id="pension_paper_submit3" class="form-control pension_paper_submit">
									   <option  selected="selected" value="">Select Pension Paper Status</option>
									   <option  value="Yes">Yes</option>
									   <option  value="No">No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>


							<div class="col-sm-6 submission_date" >
								<div class="form-group">
									<label>Pension Paper Submission Date<span class="required">*</span></label>
									<div class="cal-icon">
									<input class="form-control datetimepicker" type="text" name="pension_paper_submission_date" id="datepicker15" autocomplete="off" placeholder="Pension Paper Submission Date(DD/MM/YY)" value = "<?php echo isset($insertData['pension_paper_submission_date']) ? $insertData['pension_paper_submission_date'] : ''; ?>">
									</div>
									<span class = "text-danger"><?php echo form_error('pension_paper_submission_date');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status1">
								<div class="form-group">
									<label>Pension status for final settlement<span class="required">*</span></label>
									<select  name="submission_status1"  class="form-control">
								
									   <option  selected="selected" value="Pending">Pending</option>
									   <option  value="Settled">Settled</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status2">
								<div class="form-group">
									<label>Pension status for final settlement<span class="required">*</span></label>
									<select  name="submission_status2"  class="form-control">
									 
									   <option selected="selected"  value="Pending">Pending</option>
									  
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<!--d2-->
							
							 <div class="col-sm-6" id="dor">
								<div class="form-group">
									<label>Date of Retirement<span class="required">*</span></label>
									<div class="cal-icon">
									  <input class="form-control datetimepicker" name="date_ret" id="datepicker16" autocomplete="off" placeholder="DD/MM/YY" type="text" value = "<?php echo isset($insertData['date_ret']) ? $insertData['date_ret'] : ''; ?>">
									</div>
									  <span class = "text-danger"><?php echo form_error('date_ret');?></span>
									
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No<span class="required">*</span></label>
									<input class="form-control" type="text" id="mobile_no3" name="mobile_no" maxlength="10" placeholder="Mobile No" value = "<?php echo isset($insertData['mobile_no']) ? $insertData['mobile_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email Id<span class="required"></span></label>
									<input class="form-control" type="text" id="email3" name="email" placeholder="Email Id" value = "<?php echo isset($insertData['email']) ? $insertData['email'] : ''; ?>">
									<span class = "text-danger"></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Gender<span class="required">*</span></label>
									<select  name="gender" id="gender3" class="form-control">
									   <option selected="selected" value="">Select gender</option>
									   <option  value="MALE" <?php if($insertData['gender'] == 'MALE') echo 'selected="selected"' ?>>Male</option>
									   <option  value="FEMALE" <?php if($insertData['gender'] == 'FEMALE') echo 'selected="selected"' ?>>Female</option>
									</select>
									<span class = "text-danger"><?php echo form_error('gender');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Aadhar No.<span class="required"></span></label>
									<input class="form-control stop_alpha" type="text" name="aadhar_no" placeholder="Aadhar No." id="adhar_3" value = "<?php echo isset($insertData['aadhar_no']) ? $insertData['aadhar_no'] : ''; ?>">
									<span class="aadhar_validation"></span>
									<span class = "text-danger"><?php echo form_error('aadhar_no');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>PAN No.<span class="required">*</span></label>
									<input class="form-control" id="pan_3" type="text" name="pan_no" placeholder="PAN No." value = "<?php echo isset($insertData['pan_no']) ? $insertData['pan_no'] : ''; ?>" >
									<span class = "text-danger"><?php echo form_error('pan_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Relationship With Pensioner<span class="required">*</span></label>
									<select  id="relnshp_pensioner3" name="relation" class="form-control">
									   <option selected="selected" value="">Select relation</option>
									   <option  value="Self" <?php if($insertData['relation'] == 'Self') echo 'selected="selected"' ?>>Self</option>
									   <option  value="Spouse" <?php if($insertData['relation'] == 'Spouse') echo 'selected="selected"' ?>>Spouse</option>
									    <option  value="Father" <?php if($insertData['relation'] == 'Father') echo 'selected="selected"' ?>>Father</option>
									   <option  value="Mother" <?php if($insertData['relation'] == 'Mother') echo 'selected="selected"' ?>>Mother</option>
									   <option  value="Son" <?php if($insertData['relation'] == 'Son') echo 'selected="selected"' ?>>Son</option>
									   <option  value="Daughter" <?php if($insertData['relation'] == 'Daughter') echo 'selected="selected"' ?>>Daughter</option>
									</select>
									<span class = "text-danger"><?php echo form_error('relation');?></span>
								</div>
							</div>
							
						
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Whether the case is pending with PAO(YES/No)<span class="required">*</span></label>
									<select  id="paostatus3" name="pao_status" class="form-control">
									   <option selected="selected" value="">Select Status</option>
									   <option  value="1" <?php if($insertData['pao_status'] == '1') echo 'selected="selected"' ?>>Yes</option>
									   <option  value="0" <?php if($insertData['pao_status'] == '0') echo 'selected="selected"' ?>>No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pao_status');?></span>
								</div>
							</div>
							
						
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Present Residential Address<span class="required">*</span></label>
									<textarea id="address3" class="form-control" name="address" placeholder="Present Residential Address"><?php echo isset($insertData['address']) ? $insertData['address'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('address');?></span>
								</div>
							</div>
							
							<div class="col-sm-6 nodispaly" id="withdrawal">
								<div class="form-group">
									<label>Whether withdrawal request submitted to NSDL<span class="required">*</span></label>
									<textarea id="nsdl3" class="form-control" name="withdrawal" placeholder="NSDL"><?php echo isset($insertData['withdrawal']) ? $insertData['withdrawal'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('withdrawal');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>
									Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP etc)<span class="required">*</span>
									</label>
									<textarea id="specific_details3" class="form-control" name="specific_details" placeholder="details"><?php echo isset($insertData['specific_details']) ? $insertData['specific_details'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('specific_details');?></span>
								</div>
							</div>



							<div class="col-sm-6 nodispaly" >
								<div class="form-group">
									<label>Status of terminal Benifits if not Granted<span class="required"></span></label>
									<textarea class="form-control" name="terminal_ben" placeholder="status of pension papers"><?php echo isset($insertData['terminal_ben']) ? $insertData['terminal_ben'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('terminal_ben');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Remarks<span class="required"></span></label>
									<textarea class="form-control" name="remarks" placeholder="Remarks"><?php echo isset($insertData['remarks']) ? $insertData['remarks'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('remarks');?></span>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="checkbox" id="accept3" name="accept" value="1"><span class="required">*</span> It is certified that the above updated status has the approval of Chief Engineer of this Organisation.
									<span class = "text-danger"><?php echo form_error('remarks');?></span>
								</div>
							</div>
							
							<div class="m-t-20" style="padding-left:15px;clear:both;">
						<button type="submit" name="submit" class="btn btn-primary" id="pensionbtn2">Add Pension Details</button>
							</div>
						<?php echo form_close();?>



		<!--**************************************************************************************************************-->

						<?php
					 	$attributes = array('class' => 'penform', 'id' =>'addpenform3','onSubmit'=>'return pension_submit4();');
     					echo form_open_multipart('pension/addpension_form/'.$this->session->userdata('applicant_user_id'),$attributes);?> 
						
						 
						  <h3  class="title">
						     D) Status Of Pending New Pension Scheme(Only Family Pension)
						  </h3>
						  
						  <input type="hidden" name="pension_type" value="POPSEF" id="pensiontype3">
 								<div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Organisation<span class="required">*</span></label>
									<?php

									$userdata = $this->Base_model->get_record_by_id('users',array('USERS_ID'=>$this->session->userdata('applicant_user_id')));

									$orgndata = $this->Base_model->get_record_by_id('organization',array('ORGANIZATION_ID'=>$userdata->ORGANIZATION_ID));


									if($userdata->ROLE_ID == '1' || $userdata->ROLE_ID == '5')
									{?>
									<select  name="organisation" class="form-control" id="org3">
									    <option value="">Select Organisation</option>
										<?php foreach($all_organizations as $orgn){?>
									     <option value="<?php echo $orgn->ORGANIZATION_ID; ?>" >
										   <?php echo $orgn->ORGNAME; ?>
										 </option>
									   <?php } ?>
									</select>
								  <?php }else{?>
								  	<select  name="organisation" class="form-control" id="org3">
									    <option value="">Select Organisation</option>
										
									     <option value="<?php echo $orgndata->ORGANIZATION_ID; ?>" >
										   <?php echo $orgndata->ORGNAME; ?>
										 </option>
									   
									</select>
									<?php } ?>
									<span class = "text-danger"><?php echo form_error('organisation');?></span>
								</div>
							</div>


							<div class="col-sm-6">
								<div class="form-group">
									<label>Name of the division dealing the pension cases<span class="required">*</span></label>
									<select  name="division" class="form-control" id="division3">
									   <option value="">Select Division</option>
									</select>
									
									<span class = "text-danger"><?php echo form_error('division');?></span>
								</div>
							</div>
							
							
						<!--d4-->

							<div class="col-sm-6">
								<div class="form-group">
									<label>Whether pension paper has been submitted<span class="required">*</span></label>
									<select name="pension_paper_submit" id="pension_paper_submit4" class="form-control pension_paper_submit">
									   <option  selected="selected" value="">Select Pension Paper Status</option>
									   <option  value="Yes">Yes</option>
									   <option  value="No">No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							
							<div class="col-sm-6 submission_date" >
								<div class="form-group">
									<label>Pension Paper Submission Date<span class="required">*</span></label>
									<div class="cal-icon">
									<input class="form-control datetimepicker" type="text" id="datepicker17" autocomplete="off" name="pension_paper_submission_date" placeholder="Pension Paper Submission Date(DD/MM/YY)" value = "<?php echo isset($insertData['pension_paper_submission_date']) ? $insertData['pension_paper_submission_date'] : ''; ?>">
									</div>
									<span class = "text-danger"><?php echo form_error('pension_paper_submission_date');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status1">
								<div class="form-group">
									<label>Pension status for final settlement<span class="required">*</span></label>
									<select  name="submission_status1"  class="form-control">
									   <!-- <option selected="selected" value="">Select Status of Pension Final Settlement</option> -->
									   <option  selected="selected" value="Pending">Pending</option>
									   <option  value="Settled">Settled</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status2">
								<div class="form-group">
									<label>Pension status for final settlement<span class="required">*</span></label>
									<select  name="submission_status2"  class="form-control">
									   <!-- <option selected="selected" value="">Select Status of Pension Final Settlement</option> -->
									   <option selected="selected"  value="Pending">Pending</option>
									  
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							

							<!--fffv-->
							
						  
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Employee/Pensioner<span class="required">*</span></label>
									<input class="form-control" id="name4" type="text" name="name" placeholder="Name of the Employee/Pensioner" value = "<?php echo isset($insertData['name']) ? $insertData['name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('name');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Employee/Pensioner Designation<span class="required">*</span></label>
									<input class="form-control" type="text" name="emp_designation" placeholder="Employee/Pensioner Designation"  value = "<?php echo isset($insertData['emp_designation']) ? $insertData['emp_designation'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('emp_designation');?></span>
								</div>
							</div>
							
							<div class="col-sm-6 nodispaly" id="dod">
								<div class="form-group">
									<label>Date of Death<span class="required">*</span></label>
									<div class="cal-icon">
									 <input class="form-control datetimepicker"  name="date_death" id="datepicker18" autocomplete="off" placeholder="DD/MM/YY" type="text" value = "<?php echo isset($insertData['date_death']) ? $insertData['date_death'] : ''; ?>">
									</div>
									 <span class = "text-danger"><?php echo form_error('date_death');?></span>
								</div>
							</div>


							<div class="col-sm-6 nodispaly" id="namofm">
								<div class="form-group">
									<label>Name of Family Member Eligible for Pension<span class="required">*</span></label>
									<input class="form-control" id="familymem4" type="text" name="name_familymember" placeholder="Name of Family Member" value = "<?php echo isset($insertData['name_familymember']) ? $insertData['name_familymember'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('name_familymember');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No<span class="required">*</span></label>
									<input class="form-control" id="mobile_no4" type="text" name="mobile_no" maxlength="10" placeholder="Mobile No" value = "<?php echo isset($insertData['mobile_no']) ? $insertData['mobile_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email Id<span class="required"></span></label>
									<input class="form-control" id="email4" type="text" name="email" placeholder="Email Id" value = "<?php echo isset($insertData['email']) ? $insertData['email'] : ''; ?>">
									<span class = "text-danger"></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Gender<span class="required">*</span></label>
									<select  name="gender" id="gender4" class="form-control">
									   <option selected="selected" value="">Select gender</option>
									   <option  value="MALE" <?php if($insertData['gender'] == 'MALE') echo 'selected="selected"' ?>>Male</option>
									   <option  value="FEMALE" <?php if($insertData['gender'] == 'FEMALE') echo 'selected="selected"' ?>>Female</option>
									</select>
									<span class = "text-danger"><?php echo form_error('gender');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Aadhar No.<span class="required"></span></label>
									<input class="form-control stop_alpha" id="adhar_4" type="text" name="aadhar_no" placeholder="Aadhar No." value = "<?php echo isset($insertData['aadhar_no']) ? $insertData['aadhar_no'] : ''; ?>">
									<span class="aadhar_validation"></span>
									<span class = "text-danger"><?php echo form_error('aadhar_no');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>PAN No.<span class="required">*</span></label>
									<input class="form-control" type="text" id="pan_4" name="pan_no" placeholder="PAN No." value = "<?php echo isset($insertData['pan_no']) ? $insertData['pan_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('pan_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Relationship With Pensioner<span class="required">*</span></label>
									<select  name="relation" id="relnshp_pensioner4" class="form-control">
									   <option selected="selected" value="">Select relation</option>
									   <option  value="Self" <?php if($insertData['relation'] == 'Self') echo 'selected="selected"' ?>>Self</option>
									   <option  value="Spouse" <?php if($insertData['relation'] == 'Spouse') echo 'selected="selected"' ?>>Spouse</option>
									    <option  value="Father" <?php if($insertData['relation'] == 'Father') echo 'selected="selected"' ?>>Father</option>
									   <option  value="Mother" <?php if($insertData['relation'] == 'Mother') echo 'selected="selected"' ?>>Mother</option>
									   <option  value="Son" <?php if($insertData['relation'] == 'Son') echo 'selected="selected"' ?>>Son</option>
									   <option  value="Daughter" <?php if($insertData['relation'] == 'Daughter') echo 'selected="selected"' ?>>Daughter</option>
									</select>
									<span class = "text-danger"><?php echo form_error('relation');?></span>
								</div>
							</div>
							
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Whether the case is pending with PAO(YES/No)<span class="required">*</span></label>
									<select  id= "paostatus4" name="pao_status" class="form-control">
									   <option selected="selected" value="">Select Status</option>
									   <option  value="1" <?php if($insertData['pao_status'] == '1') echo 'selected="selected"' ?>>Yes</option>
									   <option  value="0" <?php if($insertData['pao_status'] == '0') echo 'selected="selected"' ?>>No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pao_status');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Present Residential Address<span class="required">*</span></label>
									<textarea id="address4" class="form-control" name="address" placeholder="Present Residential Address"><?php echo isset($insertData['address']) ? $insertData['address'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('address');?></span>
								</div>
							</div>
							
						
							
							<div class="col-sm-6 nodispaly" id="statusterm">
								<div class="form-group">
									<label>Status of terminal Benifits if not Granted<span class="required"></span></label>
									<textarea class="form-control" name="terminal_ben" placeholder="status of pension papers"><?php echo isset($insertData['terminal_ben']) ? $insertData['terminal_ben'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('terminal_ben');?></span>
								</div>
							</div>
							
							<div class="col-sm-6 nodispaly" id="withdrawal">
								<div class="form-group">
									<label>Whether withdrawal request submitted to NSDL<span class="required">*</span></label>
									<textarea id="nsdl4" class="form-control" name="withdrawal" placeholder="NSDL"><?php echo isset($insertData['withdrawal']) ? $insertData['withdrawal'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('withdrawal');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>
									Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP etc)<span class="required">*</span>
									</label>
									<textarea id="specific_details4" class="form-control" name="specific_details" placeholder="details"><?php echo isset($insertData['specific_details']) ? $insertData['specific_details'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('specific_details');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Remarks<span class="required"></span></label>
									<textarea class="form-control" name="remarks" placeholder="Remarks"><?php echo isset($insertData['remarks']) ? $insertData['remarks'] : ''; ?></textarea>
									<span class = "text-danger"><?php echo form_error('remarks');?></span>
								</div>
							</div>

							<div class="col-sm-12">
								<div class="form-group">
									<input type="checkbox" id="accept4" name="accept" value="1"><span class="required">*</span> It is certified that the above updated status has the approval of Chief Engineer of this Organisation.
									<span class = "text-danger"><?php echo form_error('remarks');?></span>
								</div>
							</div>
							
							<div class="m-t-20" style="padding-left:15px;clear:both;">
						
						   <button type="submit" name="submit" class="btn btn-primary" id="pensionbtn3">Add Pension Details</button>
							</div>
						<?php echo form_close();?>
								
					</div>
				</div>
			</div>
		</div>
	</div>
	
</div>

<script>
   $(document).ready(function(){


   	          $('#adhar_1').on('change', function() {

   	          	  var aadharno = $("#adhar_1").val();
   	          	  if(aadharno.length > 12){
   	          	  	 $('.aadhar_validation').text('Aadhar no should not be greater than 12 digits.');
   	          	  	 $('.aadhar_validation').css({'display':'block','color':"#f00"});
   	          	  	 return false;
   	          	  } else if(aadharno.length < 12) {
   	          	  	$('.aadhar_validation').text('Aadhar no should be equal to 12 digits.');
   	          	  	 $('.aadhar_validation').css({'display':'block','color':"#f00"});
   	          	  	 return false;
   	          	  } else {
   	          	  	$('.aadhar_validation').hide();
   	          	  }

   	          });

   	          $('#adhar_2').on('change', function() {

   	          	  var aadharno = $("#adhar_2").val();
   	          	  if(aadharno.length > 12){
   	          	  	 $('.aadhar_validation').text('Aadhar no should not be greater than 12 digits.');
   	          	  	 $('.aadhar_validation').css({'display':'block','color':"#f00"});
   	          	  	 return false;
   	          	  } else if(aadharno.length < 12) {
   	          	  	$('.aadhar_validation').text('Aadhar no should be equal to 12 digits.');
   	          	  	 $('.aadhar_validation').css({'display':'block','color':"#f00"});
   	          	  	 return false;
   	          	  } else {
   	          	  	$('.aadhar_validation').hide();
   	          	  }

   	          });

   	          $('#adhar_3').on('change', function() {

   	          	  var aadharno = $("#adhar_3").val();
   	          	  if(aadharno.length > 12){
   	          	  	 $('.aadhar_validation').text('Aadhar no should not be greater than 12 digits.');
   	          	  	 $('.aadhar_validation').css({'display':'block','color':"#f00"});
   	          	  	 return false;
   	          	  } else if(aadharno.length < 12) {
   	          	  	$('.aadhar_validation').text('Aadhar no should be equal to 12 digits.');
   	          	  	 $('.aadhar_validation').css({'display':'block','color':"#f00"});
   	          	  	 return false;
   	          	  } else {
   	          	  	$('.aadhar_validation').hide();
   	          	  }

   	          });

   	          $('#adhar_4').on('change', function() {

   	          	  var aadharno = $("#adhar_4").val();
   	          	  if(aadharno.length > 12){
   	          	  	 $('.aadhar_validation').text('Aadhar no should not be greater than 12 digits.');
   	          	  	 $('.aadhar_validation').css({'display':'block','color':"#f00"});
   	          	  	 return false;
   	          	  } else if(aadharno.length < 12) {
   	          	  	$('.aadhar_validation').text('Aadhar no should be equal to 12 digits.');
   	          	  	 $('.aadhar_validation').css({'display':'block','color':"#f00"});
   	          	  	 return false;
   	          	  } else {
   	          	  	$('.aadhar_validation').hide();
   	          	  }

   	          });

				$('#org').on('change', function(event){
		        var org_id = $("#org").val();
				
		        var option ='';
		        var base_url = '<?php echo base_url() ?>';
		        var link = base_url+'frontend/all_divisions/';
		       
		        $.ajax({
		        method: "POST",
		        url: link,
		        data: {'id':org_id},
		        success: function(result) {
		       
		           var obj = JSON.parse(result);
		      
		           option ='<option value="" selected>Select Division</option>';

		           $.each(obj, function(i){
					 
					    option+='<option value="'+obj[i].DIVISIONNAME+'" >'+obj[i].DIVISIONNAME+'</option>';
						
					 });
		            
					$("#division").html(option);
					 event.preventDefault();

		        }
		        
		       });
		    });




				$('#org1').on('change', function(event){
		        var org_id = $("#org1").val();
				
		        var option ='';
		        var base_url = '<?php echo base_url() ?>';
		        var link = base_url+'frontend/all_divisions/';
		       
		        $.ajax({
		        method: "POST",
		        url: link,
		        data: {'id':org_id},
		        success: function(result) {
		       
		           var obj = JSON.parse(result);
		      
		           option ='<option value="" selected>Select Division</option>';

		           $.each(obj, function(i){
					 
					    option+='<option value="'+obj[i].DIVISIONNAME+'" >'+obj[i].DIVISIONNAME+'</option>';
						
					 });
		            
					$("#division1").html(option);
					 event.preventDefault();

		        }
		        
		       });
		    });



				$('#org2').on('change', function(event){
		        var org_id = $("#org2").val();
				
		        var option ='';
		        var base_url = '<?php echo base_url() ?>';
		        var link = base_url+'frontend/all_divisions/';
		       
		        $.ajax({
		        method: "POST",
		        url: link,
		        data: {'id':org_id},
		        success: function(result) {
		       
		           var obj = JSON.parse(result);
		      
		           option ='<option value="" selected>Select Division</option>';

		           $.each(obj, function(i){
					 
					    option+='<option value="'+obj[i].DIVISIONNAME+'" >'+obj[i].DIVISIONNAME+'</option>';
						
					 });
		            
					$("#division2").html(option);
					 event.preventDefault();

		        }
		        
		       });
		    });



				$('#org3').on('change', function(event){
		        var org_id = $("#org3").val();
				
		        var option ='';
		        var base_url = '<?php echo base_url() ?>';
		        var link = base_url+'frontend/all_divisions/';
		       
		        $.ajax({
		        method: "POST",
		        url: link,
		        data: {'id':org_id},
		        success: function(result) {
		       
		           var obj = JSON.parse(result);
		      
		           option ='<option value="" selected>Select Division</option>';

		           $.each(obj, function(i){
					 
					    option+='<option value="'+obj[i].DIVISIONNAME+'" >'+obj[i].DIVISIONNAME+'</option>';
						
					 });
		            
					$("#division3").html(option);
					 event.preventDefault();

		        }
		        
		       });
		    });


	        $("#addpenform").show();
			$("#addpenform1").hide();
			$("#addpenform2").hide();
			$("#addpenform3").hide();		

			$('#type').on('change', function() {

			  if (this.value == 'A')
			  {
				$('#pensiontype').val('POPSEF');   
				$("#addpenform").show();
				$("#addpenform1").hide();
				$("#addpenform2").hide();
				$("#addpenform3").hide();
			
			  } else if(this.value == 'B'){
				  
				$('#pensiontype1').val('POPSOF'); 
				$("#addpenform").hide();
				$("#addpenform1").show();
				$("#addpenform2").hide();
				$("#addpenform3").hide();
				
			  } else if(this.value == 'C'){
				  
				$('#pensiontype2').val('PNPSEF');   
				$("#addpenform").hide();
				$("#addpenform1").hide();
				$("#addpenform2").show();
				$("#addpenform3").hide();
				 
			  } else if(this.value == 'D'){
				  
				$('#pensiontype3').val('PNPSOF');   
			    $("#addpenform").hide();
				$("#addpenform1").hide();
				$("#addpenform2").hide();
				$("#addpenform3").show();
				  
			  }  else {
				
				$('#pensiontype').val('POPSEF'); 
				$("#addpenform").show();
				$("#addpenform1").hide();
				$("#addpenform2").hide();
				$("#addpenform3").hide();
				
			  }
			});

			///////////////

			$(".submission_date").hide();
			$(".submission_status1").hide();
			$(".submission_status2").hide();
			$('.pension_paper_submit').on('change', function() {

			  if (this.value == 'Yes')
			  {
				 
				$(".submission_date").show();
				$(".submission_status1").show();
				$(".submission_status2").hide();
				
			
			  } else if(this.value == 'No'){
				  
				$(".submission_date").hide();
				$(".submission_status1").hide();
				$(".submission_status2").show();
				
			  }  else {
				
				$(".submission_date").hide();
				$(".submission_status1").hide();
				$(".submission_status2").hide();
				
			  }
			});


 /***************************** validation ***************************************************/

   $("#pensionbtn").click(function(){

		  $('#addpenform').validate({

		    focusInvalid: false,
		    ignore: "",
		    rules: {

			 name:{
					 required :true
				 },

			 emp_designation:{
				 required :true
			 },

		        mobile_no:{
		            required : true,
		            number: true
		        },

		        gender:{
		            required : true
		        },

		        date_ret:{
		            required :  true  
		        },

		        relation:{
		            required : true
		        },

		        pan_no:{
		            required : true
		        },

		        organisation:{
		            required : true
		        },

		        division:{
		            required : true
		        },

		       /* pstatus:{
		            required : true
		        },*/

		         pension_paper_submit:{
		            required : true
		        },

		        pao_status:{
		            required : true
		        },
		        
		        address:{
		            required : true
		        },

		        service_book:{
		            required : true
		        },

		         specific_details:{
		            required : true
		        },

		        accept:{
		            required : true
		        }

		     },
		   

		    messages: {

		        name:{
		                required :"Please enter Employer/Pensioner name."
		         },

		       emp_designation:{

				 required : "Please enter Employer/Pensioner designation."

			    },
		      
		        mobile_no:{
		          required : "Please enter mobile no." ,
		          number : "Please enter number only."
		          
		        },

		        gender:{
		            required : "Please select gender."  
		        },

		        date_ret:{
		            required : "Please enter date of retirement."  
		        },
		      
		         relation:{
		           required : "Please select relation."
		        },

		        pan_no:{
		            required : "Please enter pan no."
		        },

		         organisation:{
		            required : "Please select organisation."
		        },

		        division:{
		            required : "Please select division name."
		        },

		        pension_paper_submit:{
		            required : "Please select pension paper submitted."
		        },

		        pao_status:{
		            required : "Please select PAO status."
		        },

		        address:{
		            required : "Please fill address."
		        },

		        service_book:{
		            required : "Please select annual verification."
		        },

		        specific_details:{
		            required : "Please enter terminal benefits granted."
		        },
		         accept:{
		            required : "Please select checkbox."
		        }
		      },
		   
				errorElement: "div",
				wrapper: "div",
				errorPlacement: function(error, element) {
				offset = element.offset();
				error.insertAfter(element)
				error.css('color','red');
				error.css('position','absolute');
				$('#adhar_1').val('');
				$('#pan_1').val('');
				},
		 
		    }); 

   });



   $("#pensionbtn1").click(function(){
      
       $('#addpenform1').validate({
		    focusInvalid: false,
		    ignore: "",

		    rules: {

		       name:{
		                required :true
		           },

		      emp_designation:{
				 required :true
			   },

		       name_familymember:{
		                required :true
		        },

		        mobile_no:{
		            required : true,
		            number: true
		        },

		        gender:{
		            required : true
		        },


		        date_death:{
		            required : true
		        },

		        relation:{
		            required : true
		        },

		      /*  aadhar_no:{
		            required : true
		        },*/

		        pan_no:{
		            required : true
		        },

		        organisation:{
		            required : true
		        },

		        division:{
		            required : true
		        },

		      /*  pstatus:{
		            required : true
		        },*/
		        pension_paper_submit:{
		            required : true
		        },

		        pao_status:{
		            required : true
		        },
		        
		        address:{
		            required : true
		        },

		         service_book:{
		            required : true
		        },

		         specific_details:{
		            required : true
		        },
		        accept:{
		            required : true
		        }
		       },

		    messages: {

		        name:{
		                required :"Please enter Employer/Pensioner name."
		         },

		        emp_designation:{

				 required : "Please enter Employer/Pensioner designation."

			    },

		        name_familymember:{
		                required :"Please enter Family member  name."
		         },
		      
		        mobile_no:{
		          required : "Please enter mobile no." ,
		          number : "Please enter number only."
		          
		        },

		        gender:{
		            required : "Please select gender."  
		        },


		        date_death:{
		            required : "Please enter date of death."  
		        },

		         relation:{
		           required : "Please select relation."
		        },

		       
		        pan_no:{
		            required : "Please enter pan no."
		        },

		        organisation:{
		            required : "Please select organisation."
		        },

		        division:{
		            required : "Please select division name."
		        },

		       pension_paper_submit:{
		            required : "Please select pension paper submitted."
		        },

		        pao_status:{
		            required : "Please select PAO status."
		        },

		        address:{
		            required : "Please fill address."
		        },

		        service_book:{
		            required : "Please select annual verification."
		        },

		        specific_details:{
		            required : "Please enter terminal benefits granted."
		        },
		        accept:{
		            required : "Please select checkbox."
		        }
		      },
		   
				errorElement: "div",
				wrapper: "div",
				errorPlacement: function(error, element) {
				offset = element.offset();
				error.insertAfter(element)
				error.css('color','red');
				error.css('position','absolute');
				$('#adhar_2').val('');
				$('#pan_2').val('');
				},
		 
		    }); 


   });

   $("#pensionbtn2").click(function(){

        $('#addpenform2').validate({
		    focusInvalid: false,
		    ignore: "",

		    rules: {

		       name:{
		                required :true
		           },

		      emp_designation:{
				 required :true
			 },

		        mobile_no:{
		            required : true,
		            number: true
		        },

		        gender:{
		            required : true
		        },


		        date_ret:{
		            required : true
		        },

		        relation:{
		            required : true
		        },

		      /*  aadhar_no:{
		            required : true
		        },*/

		        pan_no:{
		            required : true
		        },

		        organisation:{
		            required : true
		        },

		        division:{
		            required : true
		        },

		        /*pstatus:{
		            required : true
		        },*/
		        pension_paper_submit:{
		            required : true
		        },

		        pao_status:{
		            required : true
		        },
		        
		        address:{
		            required : true
		        },

		         service_book:{
		            required : true
		        },

		         specific_details:{
		            required : true
		        },
		        withdrawal:{
		            required : true
		        },
		        accept:{
		            required : true
		        }
		       },

		    messages: {

		        name:{
		                required :"Please enter Employer/Pensioner name."
		         },

		        emp_designation:{

				 required : "Please enter Employer/Pensioner designation."

			    },
		      
		        mobile_no:{
		          required : "Please enter mobile no." ,
		          number : "Please enter number only."
		          
		        },

		        gender:{
		            required : "Please select gender."  
		        },


		        date_ret:{
		            required : "Please enter date of retirement."  
		        },

		         relation:{
		           required : "Please select relation."
		        },

		        organisation:{
		            required : "Please select organisation."
		        },

		       /* aadhar_no:{
		            required : "Please enter aadhar no."
		        },*/

		        pan_no:{
		            required : "Please enter pan no."
		        },

		        division:{
		            required : "Please select division name."
		        },

		       pension_paper_submit:{
		            required : "Please select pension paper submitted."
		        },

		        pao_status:{
		            required : "Please select PAO status."
		        },

		        address:{
		            required : "Please fill address."
		        },

		        service_book:{
		            required : "Please select annual verification."
		        },

		        specific_details:{
		            required : "Please enter terminal benefits granted."
		        },
		        withdrawal:{
		            required : "Please enter withdrawal request."
		        },
		        accept:{
		            required : "Please select checkbox."
		        }
		      },
		   
				errorElement: "div",
				wrapper: "div",
				errorPlacement: function(error, element) {
				offset = element.offset();
				error.insertAfter(element)
				error.css('color','red');
				error.css('position','absolute');
				$('#adhar_3').val('');
				$('#pan_3').val('');
				},
		 
		    }); 


   });


   $("#pensionbtn3").click(function(){

       $('#addpenform3').validate({
		    focusInvalid: false,
		    ignore: "",

		    rules: {

		       name:{
		                required :true
		           },

		       emp_designation:{
				 required :true
			 },

		         name_familymember:{
		                required :true
		        },

		        mobile_no:{
		            required : true,
		            number: true
		        },

		        gender:{
		            required : true
		        },


		        date_death:{
		            required : true
		        },

		        relation:{
		            required : true
		        },

		       /* aadhar_no:{
		            required : true
		        },*/

		        pan_no:{
		            required : true
		        },

		        organisation:{
		            required : true
		        },

		        division:{
		            required : true
		        },

		        /*pstatus:{
		            required : true
		        },*/
		        pension_paper_submit:{
		            required : true
		        },

		        pao_status:{
		            required : true
		        },
		        
		        address:{
		            required : true
		        },

		        service_book:{
		            required : true
		        },

		         specific_details:{
		            required : true
		        },
		        withdrawal:{
		            required : true
		        },
		        accept:{
		            required : true
		        }
		       },

		    messages: {

		        name:{
		                required :"Please enter Employer/Pensioner name."
		         },

		       emp_designation:{

				 required : "Please enter Employer/Pensioner designation."

			    },

		         name_familymember:{
		                required :"Please enter Family member  name."
		         },
		      
		        mobile_no:{
		          required : "Please enter mobile no." ,
		          number : "Please enter number only."
		          
		        },

		        gender:{
		            required : "Please select gender."  
		        },


		        date_death:{
		            required : "Please enter date of death."  
		        },

		         relation:{
		           required : "Please select relation."
		        },

		       /* aadhar_no:{
		            required : "Please enter aadhar no."
		        },*/

		        pan_no:{
		            required : "Please enter pan no."
		        },

		        organisation:{
		            required : "Please select organisation."
		        },

		        division:{
		            required : "Please select division name."
		        },

		        pension_paper_submit:{
		            required : "Please select pension paper submitted."
		        },

		        pao_status:{
		            required : "Please select PAO status."
		        },

		        address:{
		            required : "Please fill address."
		        },

		       service_book:{
		            required : "Please select annual verification."
		        },

		        specific_details:{
		            required : "Please enter terminal benefits granted."
		        },
		        withdrawal:{
		            required : "Please enter withdrawal request."
		        },
		        accept:{
		            required : "Please select checkbox."
		        }
		      },
		   
				errorElement: "div",
				wrapper: "div",
				errorPlacement: function(error, element) {
				offset = element.offset();
				error.insertAfter(element)
				error.css('color','red');
				error.css('position','absolute');
				$('#adhar_4').val('');
				$('#pan_4').val('');
				},
		 
		    }); 

   });
			
  });

  //adhar masking

  $(".social, .newsocial").on("keydown keyup", function(e) {
    $(this).prop("value", function(i, o) {
        if (o.length < 9) {
        return o.replace(/\d/g,"*")
        }
    })
})

  //pan

  $(".newsocial2").on("keydown keyup", function(e) {
    $(this).prop("value", function(i, o) {
        if (o.length < 6) {
        return o.replace(/\d/g,"*")
        }
    })
})


//
$(function() {

  var regExp = /[a-z]/i;
  $('.stop_alpha').on('keydown keyup', function(e) {
    var value = String.fromCharCode(e.which) || e.key;

    // No letters
    if (regExp.test(value)) {
      e.preventDefault();
      return false;
    }
  });

});

//vinod tets

// pension submit 1
function pension_submit1() 
{
	var adhar_1 = $('#adhar_1').val();
	var pan1 	= $('#pan_1').val();
	var rawdt = "<?php echo $this->config->item('salt_keyy'); ?>";

	var org 					= $('#org').val();
	var division 				= $('#division').val();
	var name 					= $('#name1').val();
	var pension_paper_submit 	= $('#pension_paper_submit').val();
	var dateofretirement 		= $('#datepicker12').val();
	var mobile_no 				= $('#mobile_no1').val();
	var email 					= $('#email1').val();
	var gender 					= $('#gender1').val();
	var relnshp_pensioner 		= $('#relnshp_pensioner1').val();
	var servicebook 			= $('#servicebook1').val();
	var paostatus 				= $('#paostatus1').val();
	var address 				= $('#address1').val();
	var specific_details 		= $('#specific_details1').val();
	var accept 					= $('#accept1').is(':checked');
	
	if(org.length == 0 || division.length == 0 || name.length == 0 || pension_paper_submit.length == 0 || dateofretirement.length == 0 || mobile_no.length == 0  || gender.length == 0 || relnshp_pensioner.length == 0 || servicebook.length == 0 || paostatus.length == 0 || address.length == 0 || specific_details.length == 0 || accept == false)
	{
		 $('#adhar_1').val('');
	     $('#pan_1').val('');
	}

	else
	{
			if(adhar_1.length == 0 && pan1.length == 0)
			{
				 $('#adhar_1').val('');
			     $('#pan_1').val('');
			}

			else if(adhar_1.length != 0 && pan1.length == 0)
			{
				 $('#adhar_1').val('');
			     $('#pan_1').val('');
			}

			else if(adhar_1.length == 0 && pan1.length != 0)
			{
				var ency2 	= CryptoJS.AES.encrypt(pan1,rawdt); 

				 $('#adhar_1').val('');
			     $('#pan_1').val(ency2);
			}

			else
			{
				var ency 	= CryptoJS.AES.encrypt(adhar_1,rawdt);
				var ency2 	= CryptoJS.AES.encrypt(pan1,rawdt);  


			    $('#adhar_1').val(ency);
			    $('#pan_1').val(ency2);
			}
	}// ends else

	
}

//pension submit 2

function pension_submit2() 
{

	var adhar_2 = $('#adhar_2').val();
	var pan_2 	= $('#pan_2').val();
	var rawdt 	= "<?php echo $this->config->item('salt_keyy'); ?>";

	var org 					= $('#org1').val();
	var division 				= $('#division1').val();
	var name 					= $('#name2').val();
	var pension_paper_submit 	= $('#pension_paper_submit2').val();
	var dateofretirement 		= $('#datepicker14').val();
	var familymemname 			= $('#familymemname2').val();
	var mobile_no 				= $('#mobile_no2').val();
	var email 					= $('#email2').val();
	var gender 					= $('#gender2').val();
	var relnshp_pensioner 		= $('#relnshp_pensioner2').val();
	var paostatus 				= $('#paostatus2').val();
	var address 				= $('#address2').val();
	var specific_details 		= $('#specific_details2').val();
	var accept 					= $('#accept2').is(':checked');

	if(org.length == 0 || division.length == 0 || name.length == 0 || pension_paper_submit.length == 0 || dateofretirement.length == 0 || mobile_no.length == 0 ||  gender.length == 0 || relnshp_pensioner.length == 0 ||  paostatus.length == 0 || address.length == 0 || specific_details.length == 0 || accept == false || familymemname.length == 0)
	{
		 $('#adhar_2').val('');
	     $('#pan_2').val('');
	}

	else
	{
		if(adhar_2.length == 0 && pan_2.length == 0)
		{
			$('#adhar_2').val('');
		    $('#pan_2').val('');
		}

		else if(adhar_2.length != 0 && pan_2.length == 0)
		{
			 $('#adhar_2').val('');
		     $('#pan_2').val('');
		}

		else if(adhar_2.length == 0 && pan_2.length != 0)
		{
			var ency2 	= CryptoJS.AES.encrypt(pan_2,rawdt);  
			
			 $('#adhar_2').val('');
		     $('#pan_2').val(ency2);
		}

		else
		{
			var ency 	= CryptoJS.AES.encrypt(adhar_2,rawdt);
			var ency2 	= CryptoJS.AES.encrypt(pan_2,rawdt);  


		    $('#adhar_2').val(ency);
		    $('#pan_2').val(ency2);
		}
	}// ends else

	
}//ends function

//pension submit 3

function pension_submit3() 
{
	var adhar_3 = $('#adhar_3').val();
	var pan_3 	= $('#pan_3').val();
	var rawdt 	= "<?php echo $this->config->item('salt_keyy'); ?>";

	var org 					= $('#org2').val();
	var division 				= $('#division2').val();
	var name 					= $('#name3').val();
	var pension_paper_submit 	= $('#pension_paper_submit3').val();
	var dateofretirement 		= $('#datepicker16').val();
	var mobile_no 				= $('#mobile_no3').val();
	var email 					= $('#email3').val();
	var gender 					= $('#gender3').val();
	var relnshp_pensioner 		= $('#relnshp_pensioner3').val();
	var paostatus 				= $('#paostatus3').val();
	var address 				= $('#address3').val();
	var nsdl 					= $('#nsdl3').val();
	var specific_details 		= $('#specific_details3').val();
	var accept 					= $('#accept3').is(':checked');

	if(org.length == 0 || division.length == 0 || name.length == 0 || pension_paper_submit.length == 0 || dateofretirement.length == 0 || mobile_no.length == 0 ||  gender.length == 0 || relnshp_pensioner.length == 0 ||  paostatus.length == 0 || address.length == 0 || specific_details.length == 0 || accept == false || nsdl.length == 0)
	{
		 $('#adhar_3').val('');
	     $('#pan_3').val('');
	}

	else
	{
		if(adhar_3.length == 0 && pan_3.length == 0)
		{
			$('#adhar_3').val('');
		    $('#pan_3').val('');
		}

		else if(adhar_3.length != 0 && pan_3.length == 0)
		{
			$('#adhar_3').val('');
		    $('#pan_3').val('');
		}

		else if(adhar_3.length == 0 && pan_3.length != 0)
		{
			var ency2 	= CryptoJS.AES.encrypt(pan_3,rawdt);   
			
			 $('#adhar_3').val('');
		     $('#pan_3').val(ency2);
		}

		else
		{
			var ency 	= CryptoJS.AES.encrypt(adhar_3,rawdt);
			var ency2 	= CryptoJS.AES.encrypt(pan_3,rawdt);  


			$('#adhar_3').val(ency);
		    $('#pan_3').val(ency2);

		}
	}// ends else

}//ends

//pension submit 4

function pension_submit4() 
{
	var adhar_4 = $('#adhar_4').val();
	var pan_4 	= $('#pan_4').val();
	var rawdt 	= "<?php echo $this->config->item('salt_keyy'); ?>";

	var org 					= $('#org3').val();
	var division 				= $('#division3').val();
	var name 					= $('#name4').val();
	var pension_paper_submit 	= $('#pension_paper_submit4').val();
	var dateofretirement 		= $('#datepicker18').val();
	var familymem4 				= $('#familymem4').val();
	var mobile_no 				= $('#mobile_no4').val();
	var email 					= $('#email4').val();
	var gender 					= $('#gender4').val();
	var relnshp_pensioner 		= $('#relnshp_pensioner4').val();
	var paostatus 				= $('#paostatus4').val();
	var address 				= $('#address4').val();
	var nsdl 					= $('#nsdl4').val();
	var specific_details 		= $('#specific_details4').val();
	var accept 					= $('#accept4').is(':checked');


	if(org.length == 0 || division.length == 0 || name.length == 0 || pension_paper_submit.length == 0 || dateofretirement.length == 0 || mobile_no.length == 0 || gender.length == 0 || relnshp_pensioner.length == 0 ||  paostatus.length == 0 || address.length == 0 || specific_details.length == 0 || accept == false || nsdl.length == 0 || familymem4.length == 0)
	{
		 $('#adhar_4').val('');
	     $('#pan_4').val('');
	}

	else
	{
			if(adhar_4.length == 0 && pan_4.length == 0)
			{
				$('#adhar_4').val('');
			    $('#pan_4').val('');
			}

			else if(adhar_4.length != 0 && pan_4.length == 0)
			{
				$('#adhar_4').val('');
			    $('#pan_4').val('');
			}

			else if(adhar_4.length == 0 && pan_4.length != 0)
			{
				var ency2 	= CryptoJS.AES.encrypt(pan_4,rawdt);   
				
				 $('#adhar_4').val('');
			     $('#pan_4').val(ency2);
			}

			else
			{
				var ency 	= CryptoJS.AES.encrypt(adhar_4,rawdt);
				var ency2 	= CryptoJS.AES.encrypt(pan_4,rawdt);  

				$('#adhar_4').val(ency);
			    $('#pan_4').val(ency2);
			}
	}// ends else
	
}//ends


</script>

<style>
 .title{color:#f05e27;font-size:14px;padding-left:15px;margin-bottom:25px;}
</style>