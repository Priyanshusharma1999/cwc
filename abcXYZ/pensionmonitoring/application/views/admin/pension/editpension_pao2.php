  <?php

  	//echo "<pre>";
  	//print_r($pensioner_detail);exit;
  ?>
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Update Pension Details</h6>
								<hr>

						<?php if($this->session->flashdata('flashError_pension')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_pension'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
						
						<form>
						   <div class="col-sm-12">
								<div class="form-group" style="margin-bottom:30px;">
									<label>Select Type<span class="required">*</span></label>
									<select readonly required="required" class="form-control" id="type">
									
			<?php if($pensioner_detail[0]->PENSION_TYPE == 'POPSEF' || $pensioner_detail[0]->PENSION_TYPE == 'POPSOF'){ ?>						
										<option value="A" <?php if($pensioner_detail[0]->PENSION_TYPE == 'POPSEF'){ echo 'selected'; } ?>>
										  Status Of Pending old Pension Scheme(Except Family Pension)
										</option>
										
										<option value="B" <?php if($pensioner_detail[0]->PENSION_TYPE == 'POPSOF'){ echo 'selected'; } ?> >
										  Status Of Pending old Pension Scheme(Only Family Pension)
										</option>
			<?php } else { ?>							
										
										<option value="C" <?php if($pensioner_detail[0]->PENSION_TYPE == 'PNPSEF'){ echo 'selected'; } ?>>
										   Status Of Pending New Pension Scheme(Except Family Pension)
										</option>
										
										<option value="D" <?php if($pensioner_detail[0]->PENSION_TYPE == 'PNPSOF'){ echo 'selected'; } ?>>
										  Status Of Pending New Pension Scheme(Only Family Pension)
										</option>
										
			<?php } ?>						
									</select>
								</div>
							</div>
						</form>  
				
						<?php
						$sessionn_id = $this->session->userdata('applicant_user_id');
						$uri = $this->uri->segment('3'); 
					 	$attributes = array('class' => '', 'id' =>'editpensionform','onSubmit'=>'return pension_submit1();');
     					echo form_open_multipart('pension/edit_pension/'.$uri.'/'.$sessionn_id,$attributes);?> 
					
			<input type="hidden" name="pension_type" value="<?php echo $pensioner_detail[0]->PENSION_TYPE; ?>" id="pensiontype">
						  
						  <h5 class="divider">Basic Details</h6>
						  
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Employee/Pensioner<span class="required">*</span></label>
									<input class="form-control" readonly type="text" name="name" value="<?php echo $pensioner_detail[0]->EMPLY_NAME; ?>" placeholder="Name of the Employee/Pensioner">
									<span class = "text-danger"><?php echo form_error('name');?></span>
								</div>
							</div>
							
							
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Date of Retirement<span class="required">*</span></label>
									  <input class="form-control" readonly name="date_ret" value="<?php if(!empty($pensioner_detail[0]->DATE_RETIREMENT)) { echo date('Y-m-d',strtotime($pensioner_detail[0]->DATE_RETIREMENT)); } ?>" placeholder="dd-mm-yy" type="date">
									  <span class = "text-danger"><?php echo form_error('date_ret');?></span>
								</div>
							</div>
						  
							<div class="col-sm-6">
								<div class="form-group">
									<label>Gender<span class="required">*</span></label>
									<select readonly  name="gender" class="form-control">
									   <option value="">Select gender</option>
									   <option  value="MALE" <?php if($pensioner_detail[0]->GENDER == 'MALE'){ echo 'selected'; }?> >    Male
									   </option>
									   <option  value="FEMALE" <?php if($pensioner_detail[0]->GENDER == 'FEMALE'){ echo 'selected'; }?> >  Female
									   </option>
									</select>
									<span class = "text-danger"><?php echo form_error('gender');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Relationship With Pensioner<span class="required">*</span></label>
									<select readonly  name="relation" class="form-control">
									   <option  value="">Select relation</option>
									   <option  value="Self" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Self'){ echo 'selected'; }?>>Self</option>
									   <option  value="Spouse" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Spouse'){ echo 'selected'; }?>>Spouse</option>
									   <option  value="Son" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Son'){ echo 'selected'; }?>>Son</option>
									   <option  value="Daughter" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Daughter'){ echo 'selected'; }?>>Daughter</option>
									   <option  value="Father" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Father') echo 'selected' ?>>Father</option>
									   <option  value="Mother" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Mother') echo 'selected' ?>>Mother</option>
									   <option  value="Father" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Father') echo 'selected' ?>>Father</option>
									   <option  value="Mother" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Mother') echo 'selected' ?>>Mother</option>
									</select>
									<span class = "text-danger"><?php echo form_error('relation');?></span>
								</div>
							</div>
						
						<h5 class="divider">Contact Details</h6>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No<span class="required">*</span></label>
									<input class="form-control" readonly type="text" maxlength="10" value="<?php echo $pensioner_detail[0]->MOBILENO; ?>" name="mobile_no" placeholder="Mobile No">
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email Id<span class="required"></span></label>
									<input class="form-control" readonly type="text" value="<?php echo $pensioner_detail[0]->EMAILID; ?>" name="email" placeholder="Email Id">
									<span class = "text-danger"></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Aadhar No.<span class="required">*</span></label>
									<input class="form-control adhar_1_chng" readonly type="text" name="aadhar_no" placeholder="Aadhar No." id="adhar_1" value = "<?php echo $pensioner_detail[0]->AADHAR_NO; ?>" >
									<span class = "text-danger"><?php echo form_error('aadhar_no');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>PAN No.<span class="required">*</span></label>
									<input class="form-control pan_1_chng" id="pan_1" readonly type="text" name="pan_no" placeholder="PAN No." value = "<?php echo $pensioner_detail[0]->PAN_NO; ?>" >
									<span class = "text-danger"><?php echo form_error('pan_no');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Present Residential Address<span class="required">*</span></label>
									<textarea readonly class="form-control" name="address"  placeholder="Present Residential Address"><?php echo $pensioner_detail[0]->ADDRESS; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('address');?></span>
								</div>
							</div>
							
							
							
					<h5 class="divider">Status Details</h6>	


					     <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Organisation<span class="required">*</span></label>
									<select readonly  name="organisation" class="form-control" id="org">
									    <option value="">Select Organisation</option>
										<?php foreach($all_organizations as $orgn){?>
									     <option value="<?php echo $orgn->ORGANIZATION_ID; ?>" <?php if($orgn->ORGANIZATION_ID == $pensioner_detail[0]->ORGANISATION){ echo 'selected'; }?> >
										   <?php echo $orgn->ORGNAME; ?>
										 </option>
									   <?php } ?>
									</select>
									
									<span class = "text-danger"><?php echo form_error('organisation');?></span>
								</div>
							</div>


							<div class="col-sm-6">
								<div class="form-group">
									<label>Name of the division dealing the pension cases<span class="required">*</span></label>
									<select readonly  name="division" class="form-control" id="division">
									   <option value="">Select Division</option>
									   
									<?php foreach($divisions_data as $division){?>
									
									   <option  value="<?php echo $division->DIVISIONNAME; ?>" <?php if($division->DIVISIONNAME == $pensioner_detail[0]->DIVIS_DEAL_NAME){ echo 'selected'; }?>>
									      <?php echo $division->DIVISIONNAME; ?>
									   </option>
									   
									<?php } ?>
									   
									</select>
									
									<span class = "text-danger"><?php echo form_error('division');?></span>
								</div>
							</div>	
							<!--dddd-->
							<?php

							if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'Yes')
							{?>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Whether pension paper has been submitted<span class="required">*</span></label>
										<select readonly name="pension_paper_submit" id="" class="form-control pension_paper_submit">
										   <option  selected="selected" value="">Select Pension Paper Status</option>
										   <option  value="Yes" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'Yes'){ echo 'selected'; }?>>Yes</option>
										   <option  value="No" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'No'){ echo 'selected'; }?>>No</option>
										</select>
										<span class = "text-danger"><?php echo form_error('pstatus');?></span>
									</div>
								</div>

								<div class="col-sm-6 submission_date" >
								<div class="form-group">
									<label>Pension Paper Submission Date<span class="required">*</span></label>
									<input class="form-control" readonly type="date" name="pension_paper_submission_date" placeholder="Pension Paper Submission Date" value = "<?php echo $pensioner_detail[0]->PENSION_PAPER_SUBMIT_DATE; ?>">
									<span class = "text-danger"><?php echo form_error('pension_paper_submission_date');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status1">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status1"  class="form-control">
									  <!--  <option selected="selected" value="">Select Submission Status</option> -->
									   <option  selected="selected" value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									   <option  value="Settled" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Settled'){ echo 'selected'; }?>>Settled</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status2">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status2"  class="form-control">
									   <!-- <option selected="selected" value="">Select Submission Status</option> -->
									   <option selected="selected"  value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									  
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>
							<?php } else if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'No'){ ?>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Whether pension paper has been submitted<span class="required">*</span></label>
										<select readonly name="pension_paper_submit" id="" class="form-control pension_paper_submit">
										   <option  selected="selected" value="">Select Pension Paper Status</option>
										   <option  value="Yes" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'Yes'){ echo 'selected'; }?>>Yes</option>
										   <option  value="No" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'No'){ echo 'selected'; }?>>No</option>
										</select>
										<span class = "text-danger"><?php echo form_error('pstatus');?></span>
									</div>
								</div>

								
								<div class="col-sm-6 submission_date" >
								<div class="form-group">
									<label>Pension Paper Submission Date<span class="required">*</span></label>
									<input class="form-control" readonly type="date" name="pension_paper_submission_date" placeholder="Pension Paper Submission Dat" value = "<?php echo $pensioner_detail[0]->PENSION_PAPER_SUBMIT_DATE; ?>">
									<span class = "text-danger"><?php echo form_error('pension_paper_submission_date');?></span>
								</div>
							</div>
							

							<div class="col-sm-6 submission_status1">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status1"  class="form-control">
									  <!--  <option selected="selected" value="">Select Submission Status</option> -->
									   <option  selected="selected" value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									   <option  value="Settled" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Settled'){ echo 'selected'; }?>>Settled</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status2">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status2"  class="form-control">
									   <!-- <option selected="selected" value="">Select Submission Status</option> -->
									   <option selected="selected"  value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									  
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>
							<?php } else{} ?>

							<!--cccccc-->
							
							
							<div class="col-sm-6" id="annual_ver">
								<div class="form-group">
									<label>Whether Annual Verification of service book completed<span class="required">*</span></label>
									<select readonly  name="service_book" class="form-control">
									   <option  value="">Select Status</option>
									   <option  value="1" <?php if($pensioner_detail[0]->ANNUAL_VERIFICATION == 1){ echo 'selected'; }?>>Yes</option>
									   <option  value="0" <?php if($pensioner_detail[0]->ANNUAL_VERIFICATION == 0){ echo 'selected'; }?>>No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('service_book');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Whether the case is pending with PAO(YES/No)<span class="required">*</span></label>
									<select readonly  name="pao_status" class="form-control">
									   <option value="">Select Status</option>
									   <option  value="1" <?php if($pensioner_detail[0]->PENDING_PPO == 1){ echo 'selected'; }?>>
									     Yes
										</option>
									   <option  value="0" <?php if($pensioner_detail[0]->PENDING_PPO == 0){ echo 'selected'; }?>>No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pao_status');?></span>
								</div>
							</div>
							
							<div class="col-sm-6" id="ppono">
								<div class="form-group">
									<label>PPO Number if issued<span class="required">*</span></label>
									<input class="form-control" readonly type="text" maxlength="12" value="<?php echo $pensioner_detail[0]->PPO_NO; ?>" name="ppo_number" placeholder="PPO No.">
									<span class = "text-danger"><?php echo form_error('ppo_number');?></span>
								</div>
							</div>
							
							
							
							<div class="col-sm-6" id="ppostatus">
								<div class="form-group">
									<label>If PPO no. is yet to be issued, the status of pension papers<span class="required"></span></label>
									<textarea readonly class="form-control" name="status_pensioner" placeholder="status of pension papers"><?php echo $pensioner_detail[0]->STATUS_PENS_PAPER; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('status_pensioner');?></span>
								</div>
							</div>
							
							<div class="col-sm-6 nodispaly" id="withdrawal">
								<div class="form-group">
									<label>Whether withdrawal request submitted to NSDL<span class="required">*</span></label>
									<textarea readonly class="form-control" name="withdrawal" placeholder="NSDL"><?php echo $pensioner_detail[0]->WITHDRAWAL_REQ_NSDL; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('withdrawal');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>
									Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP etc)<span class="required">*</span>
									</label>
									<textarea readonly class="form-control" name="specific_details"  placeholder="details"><?php echo $pensioner_detail[0]->TREMINAL_BENIFIT_GRANT; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('specific_details');?></span>
								</div>
							</div>


							
					<h5 class="divider">Remarks</h6>
					
							<div class="col-sm-6">
								<div class="form-group">
									<label>Remarks<span class="required"></span></label>
									<textarea class="form-control" name="remarks"  placeholder="Remarks"><?php echo $pensioner_detail[0]->DESCRIPTION; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('remarks');?></span>
								</div>
							</div>

							 <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Upload File</label>
                                    <div>
                                        <input class="form-control" name = "filesss" type="file" accept=".pdf" required>
                                    </div>
                                </div>
                            </div>
							
						<div class="col-sm-12">
							<div class="form-group">
								<input type="checkbox" name="accept" value="1" <?php if($pensioner_detail[0]->TERM_ACCEPT == 1){
									echo 'checked'; } ?> ><span class="required">*</span> It is certified that the above updated status has the approval of Chief Engineer of this Organisation.
								<span class = "text-danger"><?php echo form_error('remarks');?></span>
							</div>
						</div>


							<div class="m-t-20" style="padding-left:15px;clear:both;">
								<button type="submit" name="submit" class="btn btn-primary" id="pensionbtn">
								  Update Pension Details
								</button>
							</div>
						<?php echo form_close();?>

		<!--**********************************************************************************************************-->
		

		             <?php
		             	$sessionn_id = $this->session->userdata('applicant_user_id');
						$uri = $this->uri->segment('3'); 
					 	$attributes = array('class' => '', 'id' =>'editpensionform1','onSubmit'=>'return pension_submit2();');
     					echo form_open_multipart('pension/edit_pension/'.$uri.'/'.$sessionn_id,$attributes);?> 
						
						
					
						  <input type="hidden" name="pension_type" value="<?php echo $pensioner_detail[0]->PENSION_TYPE; ?>" id="pensiontype1">
						  
						  <h5 class="divider">Basic Details</h6>
						  
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Employee/Pensioner<span class="required">*</span></label>
									<input class="form-control" readonly type="text" name="name" value="<?php echo $pensioner_detail[0]->EMPLY_NAME; ?>" placeholder="Name of the Employee/Pensioner">
									<span class = "text-danger"><?php echo form_error('name');?></span>
								</div>
							</div>
							
							
							<div class="col-sm-6" id="dod">
								<div class="form-group">
									<label>Date of Death<span class="required">*</span></label>
									 <input class="form-control" readonly  name="date_death" value="<?php if(!empty($pensioner_detail[0]->DATE_DEATH)){ echo date('Y-m-d',strtotime($pensioner_detail[0]->DATE_DEATH)); }?>" id="datepicker" placeholder="dd-mm-yy" type="date">
									 <span class = "text-danger"><?php echo form_error('date_death');?></span>
								</div>
							</div>
							
						
							
							<div class="col-sm-6" id="namofm">
								<div class="form-group">
									<label>Name of Family Member Eligible for Pension<span class="required">*</span></label>
									<input class="form-control" readonly type="text" value="<?php if(!empty($pensioner_detail[0]->FAMILYMEM_NAME)){ echo $pensioner_detail[0]->FAMILYMEM_NAME; } ?>" name="name_familymember" placeholder="Name of Family Member">
									<span class = "text-danger"><?php echo form_error('name_familymember');?></span>
								</div>
							</div>
						
						  
							<div class="col-sm-6">
								<div class="form-group">
									<label>Gender<span class="required">*</span></label>
									<select readonly  name="gender" class="form-control">
									   <option value="">Select gender</option>
									   <option  value="MALE" <?php if($pensioner_detail[0]->GENDER == 'MALE'){ echo 'selected'; }?> >    Male
									   </option>
									   <option  value="FEMALE" <?php if($pensioner_detail[0]->GENDER == 'FEMALE'){ echo 'selected'; }?> >  Female
									   </option>
									</select>
									<span class = "text-danger"><?php echo form_error('gender');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Relationship With Pensioner<span class="required">*</span></label>
									<select readonly  name="relation" class="form-control">
									   <option  value="">Select relation</option>
									   <option  value="Self" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Self'){ echo 'selected'; }?>>Self</option>
									   <option  value="Spouse" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Spouse'){ echo 'selected'; }?>>Spouse</option>
									   <option  value="Son" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Son'){ echo 'selected'; }?>>Son</option>
									   <option  value="Daughter" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Daughter'){ echo 'selected'; }?>>Daughter</option>
									   <option  value="Father" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Father') echo 'selected' ?>>Father</option>
									   <option  value="Mother" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Mother') echo 'selected' ?>>Mother</option>
									</select>
									<span class = "text-danger"><?php echo form_error('relation');?></span>
								</div>
							</div>
						
						<h5 class="divider">Contact Details</h6>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No<span class="required">*</span></label>
									<input class="form-control" readonly type="text" maxlength="10" value="<?php echo $pensioner_detail[0]->MOBILENO; ?>" name="mobile_no" placeholder="Mobile No">
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email Id<span class="required"></span></label>
									<input class="form-control" readonly type="text" value="<?php echo $pensioner_detail[0]->EMAILID; ?>" name="email" placeholder="Email Id">
									<span class = "text-danger"></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Aadhar No.<span class="required">*</span></label>
									<input class="form-control adhar_2_chng" readonly type="text" name="aadhar_no" placeholder="Aadhar No." id="adhar_2" value = "<?php echo $pensioner_detail[0]->AADHAR_NO; ?>" >
									<span class = "text-danger"><?php echo form_error('aadhar_no');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>PAN No.<span class="required">*</span></label>
									<input class="form-control pan_2_chng" id="pan_2" readonly type="text" name="pan_no" placeholder="PAN No." value = "<?php echo $pensioner_detail[0]->PAN_NO; ?>">
									<span class = "text-danger"><?php echo form_error('pan_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Present Residential Address<span class="required">*</span></label>
									<textarea readonly class="form-control" name="address"  placeholder="Present Residential Address"><?php echo $pensioner_detail[0]->ADDRESS; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('address');?></span>
								</div>
							</div>
							
							
							
					<h5 class="divider">Status Details</h6>		
							
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Organisation<span class="required">*</span></label>
									<select readonly  name="organisation" class="form-control" id="org1">
									    <option value="">Select Organisation</option>
										<?php foreach($all_organizations as $orgn){?>
									     <option value="<?php echo $orgn->ORGANIZATION_ID; ?>" <?php if($orgn->ORGANIZATION_ID == $pensioner_detail[0]->ORGANISATION){ echo 'selected'; }?> >
										   <?php echo $orgn->ORGNAME; ?>
										 </option>
									   <?php } ?>
									</select>
									
									<span class = "text-danger"><?php echo form_error('organisation');?></span>
								</div>
							</div>


							<div class="col-sm-6">
								<div class="form-group">
									<label>Name of the division dealing the pension cases<span class="required">*</span></label>
									<select readonly  name="division" class="form-control" id="division1">
									   <option value="">Select Division</option>
									   
									<?php foreach($divisions_data as $division){?>
									
									   <option  value="<?php echo $division->DIVISIONNAME; ?>" <?php if($division->DIVISIONNAME == $pensioner_detail[0]->DIVIS_DEAL_NAME){ echo 'selected'; }?>>
									      <?php echo $division->DIVISIONNAME; ?>
									   </option>
									   
									<?php } ?>
									   
									</select>
									
									<span class = "text-danger"><?php echo form_error('division');?></span>
								</div>
							</div>	
							
							<!--xxxccc-->
							<?php

							if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'Yes')
							{?>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Whether pension paper has been submitted<span class="required">*</span></label>
										<select readonly name="pension_paper_submit" id="" class="form-control pension_paper_submit">
										   <option  selected="selected" value="">Select Pension Paper Status</option>
										   <option  value="Yes" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'Yes'){ echo 'selected'; }?>>Yes</option>
										   <option  value="No" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'No'){ echo 'selected'; }?>>No</option>
										</select>
										<span class = "text-danger"><?php echo form_error('pstatus');?></span>
									</div>
								</div>

								<div class="col-sm-6 submission_date" >
								<div class="form-group">
									<label>Pension Paper Submission Date<span class="required">*</span></label>
									<input class="form-control" readonly type="date" name="pension_paper_submission_date" placeholder="Pension Paper Submission Dat" value = "<?php echo $pensioner_detail[0]->PENSION_PAPER_SUBMIT_DATE; ?>">
									<span class = "text-danger"><?php echo form_error('pension_paper_submission_date');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status1">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status1"  class="form-control">
									  <!--  <option selected="selected" value="">Select Submission Status</option> -->
									   <option  selected="selected" value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									   <option  value="Settled" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Settled'){ echo 'selected'; }?>>Settled</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status2">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status2"  class="form-control">
									   <!-- <option selected="selected" value="">Select Submission Status</option> -->
									   <option selected="selected"  value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									  
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>
							<?php } else if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'No'){ ?>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Whether pension paper has been submitted<span class="required">*</span></label>
										<select readonly name="pension_paper_submit" id="" class="form-control pension_paper_submit">
										   <option  selected="selected" value="">Select Pension Paper Status</option>
										   <option  value="Yes" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'Yes'){ echo 'selected'; }?>>Yes</option>
										   <option  value="No" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'No'){ echo 'selected'; }?>>No</option>
										</select>
										<span class = "text-danger"><?php echo form_error('pstatus');?></span>
									</div>
								</div>

								<div class="col-sm-6 submission_date" >
								<div class="form-group">
									<label>Pension Paper Submission Date<span class="required">*</span></label>
									<input class="form-control" readonly type="date" name="pension_paper_submission_date" placeholder="Pension Paper Submission Dat" value = "<?php echo $pensioner_detail[0]->PENSION_PAPER_SUBMIT_DATE; ?>">
									<span class = "text-danger"><?php echo form_error('pension_paper_submission_date');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status1">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status1"  class="form-control">
									  <!--  <option selected="selected" value="">Select Submission Status</option> -->
									   <option  selected="selected" value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									   <option  value="Settled" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Settled'){ echo 'selected'; }?>>Settled</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status2">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status2"  class="form-control">
									   <!-- <option selected="selected" value="">Select Submission Status</option> -->
									   <option selected="selected"  value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									  
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>
							<?php } else{} ?>

							<!--wweeeee-->
						
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Whether the case is pending with PAO(YES/No)<span class="required">*</span></label>
									<select readonly  name="pao_status" class="form-control">
									   <option value="">Select Status</option>
									   <option  value="1" <?php if($pensioner_detail[0]->PENDING_PPO == 1){ echo 'selected'; }?>>
									     Yes
										</option>
									   <option  value="0" <?php if($pensioner_detail[0]->PENDING_PPO == 0){ echo 'selected'; }?>>No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pao_status');?></span>
								</div>
							</div>
							
							<div class="col-sm-6" id="ppono">
								<div class="form-group">
									<label>PPO Number if issued<span class="required">*</span></label>
									<input class="form-control" readonly type="text" maxlength="12" value="<?php echo $pensioner_detail[0]->PPO_NO; ?>" name="ppo_number" placeholder="PPO No.">
									<span class = "text-danger"><?php echo form_error('ppo_number');?></span>
								</div>
							</div>
							
							
							
							<div class="col-sm-6" id="ppostatus">
								<div class="form-group">
									<label>If PPO no. is yet to be issued, the status of pension papers<span class="required"></span></label>
									<textarea readonly class="form-control" name="status_pensioner" placeholder="status of pension papers"><?php echo $pensioner_detail[0]->STATUS_PENS_PAPER; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('status_pensioner');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>
									Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP etc)<span class="required">*</span>
									</label>
									<textarea readonly class="form-control" name="specific_details"  placeholder="details"><?php echo $pensioner_detail[0]->TREMINAL_BENIFIT_GRANT; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('specific_details');?></span>
								</div>
							</div>
							
					<h5 class="divider">Remarks</h6>
					
							<div class="col-sm-6">
								<div class="form-group">
									<label>Remarks<span class="required"></span></label>
									<textarea class="form-control" name="remarks"  placeholder="Remarks"><?php echo $pensioner_detail[0]->DESCRIPTION; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('remarks');?></span>
								</div>
							</div>

							 <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Upload File</label>
                                    <div>
                                        <input class="form-control" name = "filesss" type="file" accept=".pdf" required>
                                    </div>
                                </div>
                            </div>
							
						<div class="col-sm-12">
							<div class="form-group">
								<input type="checkbox" name="accept" value="1" <?php if($pensioner_detail[0]->TERM_ACCEPT == 1){
									echo 'checked'; } ?> ><span class="required">*</span> It is certified that the above updated status has the approval of Chief Engineer of this Organisation.
								<span class = "text-danger"><?php echo form_error('remarks');?></span>
							</div>
						</div>


							<div class="m-t-20" style="padding-left:15px;clear:both;">
								<button type="submit" name="submit" class="btn btn-primary" id="pensionbtn1">
								  Update Pension Details
							   </button>
							</div>
						<?php echo form_close();?>


	<!--**********************************************************************************************************-->
		

		            <?php
		            	$sessionn_id = $this->session->userdata('applicant_user_id');
						$uri = $this->uri->segment('3'); 
					 	$attributes = array('class' => '', 'id' =>'editpensionform2','onSubmit'=>'return pension_submit3();');
     					echo form_open_multipart('pension/edit_pension/'.$uri.'/'.$sessionn_id,$attributes);?> 
						
						
					
						  <input type="hidden" name="pension_type" value="<?php echo $pensioner_detail[0]->PENSION_TYPE; ?>" id="pensiontype2">
						  
						  <h5 class="divider">Basic Details</h6>
						  
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Employee/Pensioner<span class="required">*</span></label>
									<input class="form-control" readonly type="text" name="name" value="<?php echo $pensioner_detail[0]->EMPLY_NAME; ?>" placeholder="Name of the Employee/Pensioner">
									<span class = "text-danger"><?php echo form_error('name');?></span>
								</div>
							</div>
							
							
						   <div class="col-sm-6" id="dor">
								<div class="form-group">
									<label>Date of Retirement<span class="required">*</span></label>
									  <input class="form-control" readonly name="date_ret" value="<?php if(!empty($pensioner_detail[0]->DATE_RETIREMENT)) { echo date('Y-m-d',strtotime($pensioner_detail[0]->DATE_RETIREMENT)); } ?>" placeholder="dd-mm-yy" type="date">
									  <span class = "text-danger"><?php echo form_error('date_ret');?></span>
								</div>
							</div>
						
						  
							<div class="col-sm-6">
								<div class="form-group">
									<label>Gender<span class="required">*</span></label>
									<select readonly  name="gender" class="form-control">
									   <option value="">Select gender</option>
									   <option  value="MALE" <?php if($pensioner_detail[0]->GENDER == 'MALE'){ echo 'selected'; }?> >    Male
									   </option>
									   <option  value="FEMALE" <?php if($pensioner_detail[0]->GENDER == 'FEMALE'){ echo 'selected'; }?> >  Female
									   </option>
									</select>
									<span class = "text-danger"><?php echo form_error('gender');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Relationship With Pensioner<span class="required">*</span></label>
									<select readonly  name="relation" class="form-control">
									   <option  value="">Select relation</option>
									   <option  value="Self" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Self'){ echo 'selected'; }?>>Self</option>
									   <option  value="Spouse" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Spouse'){ echo 'selected'; }?>>Spouse</option>
									   <option  value="Son" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Son'){ echo 'selected'; }?>>Son</option>
									   <option  value="Daughter" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Daughter'){ echo 'selected'; }?>>Daughter</option>
									   <option  value="Father" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Father') echo 'selected' ?>>Father</option>
									   <option  value="Mother" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Mother') echo 'selected' ?>>Mother</option>
									</select>
									<span class = "text-danger"><?php echo form_error('relation');?></span>
								</div>
							</div>
						
						<h5 class="divider">Contact Details</h6>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No<span class="required">*</span></label>
									<input class="form-control" readonly type="text" maxlength="10" value="<?php echo $pensioner_detail[0]->MOBILENO; ?>" name="mobile_no" placeholder="Mobile No">
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email Id<span class="required"></span></label>
									<input class="form-control" readonly type="text" value="<?php echo $pensioner_detail[0]->EMAILID; ?>" name="email" placeholder="Email Id">
									<span class = "text-danger"></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Aadhar No.<span class="required">*</span></label>
									<input class="form-control adhar_3_chng" readonly type="text" name="aadhar_no" placeholder="Aadhar No." id="adhar_3" value = "<?php echo $pensioner_detail[0]->AADHAR_NO; ?>" >
									<span class = "text-danger"><?php echo form_error('aadhar_no');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>PAN No.<span class="required">*</span></label>
									<input class="form-control pan_3_chng" id="pan_3" readonly type="text" name="pan_no" placeholder="PAN No." value = "<?php echo $pensioner_detail[0]->PAN_NO; ?>" >
									<span class = "text-danger"><?php echo form_error('pan_no');?></span>
								</div>
							</div>

							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Present Residential Address<span class="required">*</span></label>
									<textarea readonly class="form-control" name="address"  placeholder="Present Residential Address"><?php echo $pensioner_detail[0]->ADDRESS; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('address');?></span>
								</div>
							</div>
							
							
							
					<h5 class="divider">Status Details</h6>		
							
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Organisation<span class="required">*</span></label>
									<select readonly  name="organisation" class="form-control" id="org2">
									    <option value="">Select Organisation</option>
										<?php foreach($all_organizations as $orgn){?>
									     <option value="<?php echo $orgn->ORGANIZATION_ID; ?>" <?php if($orgn->ORGANIZATION_ID == $pensioner_detail[0]->ORGANISATION){ echo 'selected'; }?> >
										   <?php echo $orgn->ORGNAME; ?>
										 </option>
									   <?php } ?>
									</select>
									
									<span class = "text-danger"><?php echo form_error('organisation');?></span>
								</div>
							</div>


							<div class="col-sm-6">
								<div class="form-group">
									<label>Name of the division dealing the pension cases<span class="required">*</span></label>
									<select readonly  name="division" class="form-control" id="division2">
									   <option value="">Select Division</option>
									   
									<?php foreach($divisions_data as $division){?>
									
									   <option  value="<?php echo $division->DIVISIONNAME; ?>" <?php if($division->DIVISIONNAME == $pensioner_detail[0]->DIVIS_DEAL_NAME){ echo 'selected'; }?>>
									      <?php echo $division->DIVISIONNAME; ?>
									   </option>
									   
									<?php } ?>
									   
									</select>
									
									<span class = "text-danger"><?php echo form_error('division');?></span>
								</div>
							</div>	
							
							<!--zcvb-->
							<?php

							if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'Yes')
							{?>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Whether pension paper has been submitted<span class="required">*</span></label>
										<select readonly name="pension_paper_submit" id="" class="form-control pension_paper_submit">
										   <option  selected="selected" value="">Select Pension Paper Status</option>
										   <option  value="Yes" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'Yes'){ echo 'selected'; }?>>Yes</option>
										   <option  value="No" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'No'){ echo 'selected'; }?>>No</option>
										</select>
										<span class = "text-danger"><?php echo form_error('pstatus');?></span>
									</div>
								</div>

								<div class="col-sm-6 submission_date" >
								<div class="form-group">
									<label>Pension Paper Submission Date<span class="required">*</span></label>
									<input class="form-control" readonly type="date" name="pension_paper_submission_date" placeholder="Pension Paper Submission Dat" value = "<?php echo $pensioner_detail[0]->PENSION_PAPER_SUBMIT_DATE; ?>">
									<span class = "text-danger"><?php echo form_error('pension_paper_submission_date');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status1">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status1"  class="form-control">
									  <!--  <option selected="selected" value="">Select Submission Status</option> -->
									   <option  selected="selected" value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									   <option  value="Settled" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Settled'){ echo 'selected'; }?>>Settled</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status2">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status2"  class="form-control">
									   <!-- <option selected="selected" value="">Select Submission Status</option> -->
									   <option selected="selected"  value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									  
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>
							<?php } else if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'No'){ ?>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Whether pension paper has been submitted<span class="required">*</span></label>
										<select readonly name="pension_paper_submit" id="" class="form-control pension_paper_submit">
										   <option  selected="selected" value="">Select Pension Paper Status</option>
										   <option  value="Yes" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'Yes'){ echo 'selected'; }?>>Yes</option>
										   <option  value="No" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'No'){ echo 'selected'; }?>>No</option>
										</select>
										<span class = "text-danger"><?php echo form_error('pstatus');?></span>
									</div>
								</div>

								<div class="col-sm-6 submission_date" >
								<div class="form-group">
									<label>Pension Paper Submission Date<span class="required">*</span></label>
									<input class="form-control" readonly type="date" name="pension_paper_submission_date" placeholder="Pension Paper Submission Dat" value = "<?php echo $pensioner_detail[0]->PENSION_PAPER_SUBMIT_DATE; ?>">
									<span class = "text-danger"><?php echo form_error('pension_paper_submission_date');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status1">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status1"  class="form-control">
									  <!--  <option selected="selected" value="">Select Submission Status</option> -->
									   <option  selected="selected" value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									   <option  value="Settled" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Settled'){ echo 'selected'; }?>>Settled</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status2">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status2"  class="form-control">
									   <!-- <option selected="selected" value="">Select Submission Status</option> -->
									   <option selected="selected"  value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									  
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>
							<?php } else{} ?>

							<!--jj-->
							
						
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Whether the case is pending with PAO(YES/No)<span class="required">*</span></label>
									<select readonly  name="pao_status" class="form-control">
									   <option value="">Select Status</option>
									   <option  value="1" <?php if($pensioner_detail[0]->PENDING_PPO == 1){ echo 'selected'; }?>>
									     Yes
										</option>
									   <option  value="0" <?php if($pensioner_detail[0]->PENDING_PPO == 0){ echo 'selected'; }?>>No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pao_status');?></span>
								</div>
							</div>
						
							
							
							
							<div class="col-sm-6 nodispaly" id="statusterm">
								<div class="form-group">
									<label>Status of terminal Benifits if not Granted<span class="required"></span></label>
									<textarea readonly class="form-control" name="terminal_ben" placeholder="status of pension papers"><?php echo $pensioner_detail[0]->STATUS_TERM_BENI_NOT_GRANT; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('terminal_ben');?></span>
								</div>
							</div>
							
							<div class="col-sm-6 nodispaly" id="withdrawal">
								<div class="form-group">
									<label>Whether withdrawal request submitted to NSDL<span class="required">*</span></label>
									<textarea readonly class="form-control" name="withdrawal" placeholder="NSDL"><?php echo $pensioner_detail[0]->WITHDRAWAL_REQ_NSDL; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('withdrawal');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>
									Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP etc)<span class="required">*</span>
									</label>
									<textarea readonly class="form-control" name="specific_details"  placeholder="details"><?php echo $pensioner_detail[0]->TREMINAL_BENIFIT_GRANT; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('specific_details');?></span>
								</div>
							</div>
							
					<h5 class="divider">Remarks</h6>
					
							<div class="col-sm-6">
								<div class="form-group">
									<label>Remarks<span class="required"></span></label>
									<textarea class="form-control" name="remarks"  placeholder="Remarks"><?php echo $pensioner_detail[0]->DESCRIPTION; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('remarks');?></span>
								</div>
							</div>

							 <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Upload File</label>
                                    <div>
                                        <input class="form-control" name = "filesss" type="file" accept=".pdf" required>
                                    </div>
                                </div>
                            </div>
							
						<div class="col-sm-12">
							<div class="form-group">
								<input type="checkbox" name="accept" value="1" <?php if($pensioner_detail[0]->TERM_ACCEPT == 1){
									echo 'checked'; } ?> ><span class="required">*</span> It is certified that the above updated status has the approval of Chief Engineer of this Organisation.
								<span class = "text-danger"><?php echo form_error('remarks');?></span>
							</div>
						</div>


							<div class="m-t-20" style="padding-left:15px;clear:both;">
								<button type="submit" name="submit" class="btn btn-primary" id="pensionbtn2">
								   Update Pension Details
								</button>
							</div>
						<?php echo form_close();?>


	<!--**********************************************************************************************************-->
		

		              <?php
		              	$sessionn_id = $this->session->userdata('applicant_user_id');
						$uri = $this->uri->segment('3'); 
					 	$attributes = array('class' => '', 'id' =>'editpensionform3','onSubmit'=>'return pension_submit4();');
     					echo form_open_multipart('pension/edit_pension/'.$uri.'/'.$sessionn_id,$attributes);?> 
						
						
					
						  <input type="hidden" name="pension_type" value="<?php echo $pensioner_detail[0]->PENSION_TYPE; ?>" id="pensiontype3">
						  
						  <h5 class="divider">Basic Details</h6>
						  
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Employee/Pensioner<span class="required">*</span></label>
									<input class="form-control" readonly type="text" name="name" value="<?php echo $pensioner_detail[0]->EMPLY_NAME; ?>" placeholder="Name of the Employee/Pensioner">
									<span class = "text-danger"><?php echo form_error('name');?></span>
								</div>
							</div>
							
						
							
							<div class="col-sm-6" id="dod">
								<div class="form-group">
									<label>Date of Death<span class="required">*</span></label>
									 <input class="form-control" readonly  name="date_death" value="<?php if(!empty($pensioner_detail[0]->DATE_DEATH)){ echo date('Y-m-d',strtotime($pensioner_detail[0]->DATE_DEATH)); }?>" id="datepicker" placeholder="dd-mm-yy" type="date">
									 <span class = "text-danger"><?php echo form_error('date_death');?></span>
								</div>
							</div>
						  
							<div class="col-sm-6">
								<div class="form-group">
									<label>Gender<span class="required">*</span></label>
									<select readonly  name="gender" class="form-control">
									   <option value="">Select gender</option>
									   <option  value="MALE" <?php if($pensioner_detail[0]->GENDER == 'MALE'){ echo 'selected'; }?> >    Male
									   </option>
									   <option  value="FEMALE" <?php if($pensioner_detail[0]->GENDER == 'FEMALE'){ echo 'selected'; }?> >  Female
									   </option>
									</select>
									<span class = "text-danger"><?php echo form_error('gender');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Relationship With Pensioner<span class="required">*</span></label>
									<select readonly  name="relation" class="form-control">
									   <option  value="">Select relation</option>
									   <option  value="Self" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Self'){ echo 'selected'; }?>>Self</option>
									   <option  value="Spouse" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Spouse'){ echo 'selected'; }?>>Spouse</option>
									   <option  value="Son" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Son'){ echo 'selected'; }?>>Son</option>
									   <option  value="Daughter" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Daughter'){ echo 'selected'; }?>>Daughter</option>
									   <option  value="Father" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Father') echo 'selected' ?>>Father</option>
									   <option  value="Mother" <?php if($pensioner_detail[0]->RELATIONWITHPENSIONER == 'Mother') echo 'selected' ?>>Mother</option>
									</select>
									<span class = "text-danger"><?php echo form_error('relation');?></span>
								</div>
							</div>
						
						<h5 class="divider">Contact Details</h6>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No<span class="required">*</span></label>
									<input class="form-control" readonly type="text" maxlength="10" value="<?php echo $pensioner_detail[0]->MOBILENO; ?>" name="mobile_no" placeholder="Mobile No">
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email Id<span class="required"></span></label>
									<input class="form-control" readonly type="text" value="<?php echo $pensioner_detail[0]->EMAILID; ?>" name="email" placeholder="Email Id">
									<span class = "text-danger"></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Aadhar No.<span class="required">*</span></label>
									<input class="form-control adhar_4_chng" id="adhar_4" readonly type="text" name="aadhar_no" placeholder="Aadhar No." value = "<?php echo $pensioner_detail[0]->AADHAR_NO; ?>" >
									<span class = "text-danger"><?php echo form_error('aadhar_no');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>PAN No.<span class="required">*</span></label>
									<input class="form-control pan_4_chng" readonly type="text" id="pan_4" name="pan_no" placeholder="PAN No." value = "<?php echo $pensioner_detail[0]->PAN_NO; ?>" >
									<span class = "text-danger"><?php echo form_error('pan_no');?></span>
								</div>
							</div>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Present Residential Address<span class="required">*</span></label>
									<textarea readonly class="form-control" name="address"  placeholder="Present Residential Address"><?php echo $pensioner_detail[0]->ADDRESS; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('address');?></span>
								</div>
							</div>
							
							
							
					<h5 class="divider">Status Details</h6>		
							
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Name of the Organisation<span class="required">*</span></label>
									<select readonly  name="organisation" class="form-control" id="org3">
									    <option value="">Select Organisation</option>
										<?php foreach($all_organizations as $orgn){?>
									     <option value="<?php echo $orgn->ORGANIZATION_ID; ?>" <?php if($orgn->ORGANIZATION_ID == $pensioner_detail[0]->ORGANISATION){ echo 'selected'; }?> >
										   <?php echo $orgn->ORGNAME; ?>
										 </option>
									   <?php } ?>
									</select>
									
									<span class = "text-danger"><?php echo form_error('organisation');?></span>
								</div>
							</div>


							<div class="col-sm-6">
								<div class="form-group">
									<label>Name of the division dealing the pension cases<span class="required">*</span></label>
									<select readonly  name="division" class="form-control" id="division3">
									   <option value="">Select Division</option>
									   
									<?php foreach($divisions_data as $division){?>
									
									   <option  value="<?php echo $division->DIVISIONNAME; ?>" <?php if($division->DIVISIONNAME == $pensioner_detail[0]->DIVIS_DEAL_NAME){ echo 'selected'; }?>>
									      <?php echo $division->DIVISIONNAME; ?>
									   </option>
									   
									<?php } ?>
									   
									</select>
									
									<span class = "text-danger"><?php echo form_error('division');?></span>
								</div>
							</div>	
							
							<!--qwer-->
							<?php

							if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'Yes')
							{?>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Whether pension paper has been submitted<span class="required">*</span></label>
										<select readonly name="pension_paper_submit" id="" class="form-control pension_paper_submit">
										   <option  selected="selected" value="">Select Pension Paper Status</option>
										   <option  value="Yes" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'Yes'){ echo 'selected'; }?>>Yes</option>
										   <option  value="No" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'No'){ echo 'selected'; }?>>No</option>
										</select>
										<span class = "text-danger"><?php echo form_error('pstatus');?></span>
									</div>
								</div>

								<div class="col-sm-6 submission_date" >
								<div class="form-group">
									<label>Pension Paper Submission Date<span class="required">*</span></label>
									<input class="form-control" readonly type="date" name="pension_paper_submission_date" placeholder="Pension Paper Submission Dat" value = "<?php echo $pensioner_detail[0]->PENSION_PAPER_SUBMIT_DATE; ?>">
									<span class = "text-danger"><?php echo form_error('pension_paper_submission_date');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status1">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status1"  class="form-control">
									  <!--  <option selected="selected" value="">Select Submission Status</option> -->
									   <option  selected="selected" value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									   <option  value="Settled" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Settled'){ echo 'selected'; }?>>Settled</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status2">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status2"  class="form-control">
									   <!-- <option selected="selected" value="">Select Submission Status</option> -->
									   <option selected="selected"  value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									  
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>
							<?php } else if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'No'){ ?>
								<div class="col-sm-6">
									<div class="form-group">
										<label>Whether pension paper has been submitted<span class="required">*</span></label>
										<select readonly name="pension_paper_submit" id="" class="form-control pension_paper_submit">
										   <option  selected="selected" value="">Select Pension Paper Status</option>
										   <option  value="Yes" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'Yes'){ echo 'selected'; }?>>Yes</option>
										   <option  value="No" <?php if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS == 'No'){ echo 'selected'; }?>>No</option>
										</select>
										<span class = "text-danger"><?php echo form_error('pstatus');?></span>
									</div>
								</div>

								<div class="col-sm-6 submission_date" >
								<div class="form-group">
									<label>Pension Paper Submission Date<span class="required">*</span></label>
									<input class="form-control" readonly type="date" name="pension_paper_submission_date" placeholder="Pension Paper Submission Dat" value = "<?php echo $pensioner_detail[0]->PENSION_PAPER_SUBMIT_DATE; ?>">
									<span class = "text-danger"><?php echo form_error('pension_paper_submission_date');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status1">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status1"  class="form-control">
									  <!--  <option selected="selected" value="">Select Submission Status</option> -->
									   <option  selected="selected" value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									   <option  value="Settled" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Settled'){ echo 'selected'; }?>>Settled</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>

							<div class="col-sm-6 submission_status2">
								<div class="form-group">
									<label>Submission Status<span class="required">*</span></label>
									<select readonly  name="submission_status2"  class="form-control">
									   <!-- <option selected="selected" value="">Select Submission Status</option> -->
									   <option selected="selected"  value="Pending" <?php if($pensioner_detail[0]->PENSION_STATUS == 'Pending'){ echo 'selected'; }?>>Pending</option>
									  
									</select>
									<span class = "text-danger"><?php echo form_error('pstatus');?></span>
								</div>
							</div>
							<?php } else{} ?>

							<!--hhii-->
							
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Whether the case is pending with PAO(YES/No)<span class="required">*</span></label>
									<select readonly  name="pao_status" class="form-control">
									   <option value="">Select Status</option>
									   <option  value="1" <?php if($pensioner_detail[0]->PENDING_PPO == 1){ echo 'selected'; }?>>
									     Yes
										</option>
									   <option  value="0" <?php if($pensioner_detail[0]->PENDING_PPO == 0){ echo 'selected'; }?>>No</option>
									</select>
									<span class = "text-danger"><?php echo form_error('pao_status');?></span>
								</div>
							</div>
						
							
							<div class="col-sm-6 nodispaly" id="statusterm">
								<div class="form-group">
									<label>Status of terminal Benifits if not Granted<span class="required"></span></label>
									<textarea readonly class="form-control" name="terminal_ben" placeholder="status of pension papers"><?php echo $pensioner_detail[0]->STATUS_TERM_BENI_NOT_GRANT; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('terminal_ben');?></span>
								</div>
							</div>
							
							<div class="col-sm-6 nodispaly" id="withdrawal">
								<div class="form-group">
									<label>Whether withdrawal request submitted to NSDL<span class="required">*</span></label>
									<textarea readonly class="form-control" name="withdrawal" placeholder="NSDL"><?php echo $pensioner_detail[0]->WITHDRAWAL_REQ_NSDL; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('withdrawal');?></span>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>
									Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP etc)<span class="required">*</span>
									</label>
									<textarea readonly class="form-control" name="specific_details"  placeholder="details"><?php echo $pensioner_detail[0]->TREMINAL_BENIFIT_GRANT; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('specific_details');?></span>
								</div>
							</div>
							
					<h5 class="divider">Remarks</h6>
					
							<div class="col-sm-6">
								<div class="form-group">
									<label>Remarks<span class="required"></span></label>
									<textarea class="form-control" name="remarks"  placeholder="Remarks"><?php echo $pensioner_detail[0]->DESCRIPTION; ?>
									</textarea>
									<span class = "text-danger"><?php echo form_error('remarks');?></span>
								</div>
							</div>

							 <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Upload File</label>
                                    <div>
                                        <input class="form-control" name = "filesss" type="file" accept=".pdf" required>
                                    </div>
                                </div>
                            </div>
							
						<div class="col-sm-12">
							<div class="form-group">
								<input type="checkbox" name="accept" value="1" <?php if($pensioner_detail[0]->TERM_ACCEPT == 1){
									echo 'checked'; } ?> ><span class="required">*</span> It is certified that the above updated status has the approval of Chief Engineer of this Organisation.
								<span class = "text-danger"><?php echo form_error('remarks');?></span>
							</div>
						</div>


							<div class="m-t-20" style="padding-left:15px;clear:both;">
								<button type="submit" name="submit" class="btn btn-primary" id="pensionbtn3">
								   Update Pension Details
							   </button>
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

   		/********* 1 *********/

        var adhar_ency_val1 = $('.adhar_1_chng').val();
        var pan_ency_val1 = $('.pan_1_chng').val();
        
        var rawdt_val1      = "<?php echo $this->config->item('salt_keyy'); ?>";
     
        var Normaltext1 = CryptoJS.AES.decrypt(adhar_ency_val1, rawdt_val1);  
        var adhar_ency_val11 = Normaltext1.toString(CryptoJS.enc.Utf8); 

        var Normaltext2 = CryptoJS.AES.decrypt(pan_ency_val1, rawdt_val1);  
        var pan_ency_val12 = Normaltext2.toString(CryptoJS.enc.Utf8); 
      
      
        $('.adhar_1_chng').val(adhar_ency_val11);
        $('.pan_1_chng').val(pan_ency_val12);

     /********* ends 1 *********/

     /********* 2 *********/
   		
        var adhar_ency_val2 = $('.adhar_2_chng').val();
        var pan_ency_val2 = $('.pan_2_chng').val();
        
        var rawdt_val1      = "<?php echo $this->config->item('salt_keyy'); ?>";
     
        var Normaltext1 = CryptoJS.AES.decrypt(adhar_ency_val2, rawdt_val1);  
        var adhar_ency_val11 = Normaltext1.toString(CryptoJS.enc.Utf8); 

        var Normaltext2 = CryptoJS.AES.decrypt(pan_ency_val2, rawdt_val1);  
        var pan_ency_val12 = Normaltext2.toString(CryptoJS.enc.Utf8); 
      
      
        $('.adhar_2_chng').val(adhar_ency_val11);
        $('.pan_2_chng').val(pan_ency_val12);

     /********* ends 2 *********/

      /********* 3 *********/
   		
        var adhar_ency_val3 = $('.adhar_3_chng').val();
        var pan_ency_val3 = $('.pan_3_chng').val();
        
        var rawdt_val1      = "<?php echo $this->config->item('salt_keyy'); ?>";
     
        var Normaltext1 = CryptoJS.AES.decrypt(adhar_ency_val3, rawdt_val1);  
        var adhar_ency_val11 = Normaltext1.toString(CryptoJS.enc.Utf8); 

        var Normaltext2 = CryptoJS.AES.decrypt(pan_ency_val3, rawdt_val1);  
        var pan_ency_val12 = Normaltext2.toString(CryptoJS.enc.Utf8); 
      
      
        $('.adhar_3_chng').val(adhar_ency_val11);
        $('.pan_3_chng').val(pan_ency_val12);

     /********* ends 3 *********/

     /********* 4 *********/
   		
        var adhar_ency_val4 = $('.adhar_4_chng').val();
        var pan_ency_val4 = $('.pan_4_chng').val();
        
        var rawdt_val1      = "<?php echo $this->config->item('salt_keyy'); ?>";
     
        var Normaltext1 = CryptoJS.AES.decrypt(adhar_ency_val4, rawdt_val1);  
        var adhar_ency_val11 = Normaltext1.toString(CryptoJS.enc.Utf8); 

        var Normaltext2 = CryptoJS.AES.decrypt(pan_ency_val4, rawdt_val1);  
        var pan_ency_val12 = Normaltext2.toString(CryptoJS.enc.Utf8); 
      
      
        $('.adhar_4_chng').val(adhar_ency_val11);
        $('.pan_4_chng').val(pan_ency_val12);

     /********* ends 4 *********/

     //
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
	   
	      var type= '<?php echo $pensioner_detail[0]->PENSION_TYPE; ?>';
		
		   if (type == 'POPSEF')
			  {
				$("#editpensionform").show();
				$("#editpensionform1").hide();
				$("#editpensionform2").hide();
				$("#editpensionform3").hide();
				
			  } else if(type == 'POPSOF'){

				$("#editpensionform").hide();
				$("#editpensionform1").show();
				$("#editpensionform2").hide();
				$("#editpensionform3").hide();

			  } else if(type == 'PNPSEF'){

				$("#editpensionform").hide();
				$("#editpensionform1").hide();
				$("#editpensionform2").show();
				$("#editpensionform3").hide();
				 
			  } else if(type == 'PNPSOF'){
				
				$("#editpensionform").hide();
				$("#editpensionform1").hide();
				$("#editpensionform2").hide();
				$("#editpensionform3").show();
				  
			  }  else {
				
				$("#editpensionform").show();
				$("#editpensionform1").hide();
				$("#editpensionform2").hide();
				$("#editpensionform3").hide();
				
			  }
	   
			$('#type').on('change', function() {
				
			  if (this.value == 'A')
			  {
				$('#pensiontype').val('POPSEF');   
				
				$("#editpensionform").show();
				$("#editpensionform1").hide();
				$("#editpensionform2").hide();
				$("#editpensionform3").hide();
				
				
			  } else if(this.value == 'B'){
				  
				$('#pensiontype1').val('POPSOF'); 
				
				$("#editpensionform").hide();
				$("#editpensionform1").show();
				$("#editpensionform2").hide();
				$("#editpensionform3").hide();
				
			  } else if(this.value == 'C'){
				  
				$('#pensiontype2').val('PNPSEF');   
				
				$("#editpensionform").hide();
				$("#editpensionform1").hide();
				$("#editpensionform2").show();
				$("#editpensionform3").hide();
				 
			  } else if(this.value == 'D'){
				  
				$('#pensiontype3').val('PNPSOF');   
			   
				$("#editpensionform").hide();
				$("#editpensionform1").hide();
				$("#editpensionform2").hide();
				$("#editpensionform3").show();
				  
			  }  else {
				
				$('#pensiontype').val('POPSEF'); 
				
				$("#editpensionform").show();
				$("#editpensionform1").hide();
				$("#editpensionform2").hide();
				$("#editpensionform3").hide();
				
				
			  }

			});


			//////////////

		/*	$(".submission_date").hide();
			$(".submission_status1").hide();
			$(".submission_status2").hide();*/
			$('.pension_paper_submit').on('change', function() {

			  if (this.value == 'Yes')
			  {
				 
				$(".submission_date").show();
				$(".submission_status1").show();
				$(".submission_status2").hide();
				
			
			  } else if(this.value == 'No'){
				  
				$(".submission_date").hide();
				$(".submission_status1").val('');
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

		  $('#editpensionform').validate({
		    focusInvalid: false,
		    ignore: "",
		    rules: {

			 name:{
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

		        aadhar_no:{
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

		        pstatus:{
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

		        aadhar_no:{
		            required : "Please enter aadhar no."
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

		        pstatus:{
		            required : "Please select pension status."
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
				},
		 
		    }); 

   });



   $("#pensionbtn1").click(function(){
      
       $('#editpensionform1').validate({
		    focusInvalid: false,
		    ignore: "",

		    rules: {

		       name:{
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

		        aadhar_no:{
		            required : true
		        },

		        pan_no:{
		            required : true
		        },

		        relation:{
		            required : true
		        },


		        organisation:{
		            required : true
		        },

		        division:{
		            required : true
		        },

		        pstatus:{
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

		        aadhar_no:{
		            required : "Please enter aadhar no."
		        },

		        pan_no:{
		            required : "Please enter pan no."
		        },

		        date_death:{
		            required : "Please enter date of death."  
		        },

		         relation:{
		           required : "Please select relation."
		        },

		        organisation:{
		            required : "Please select organisation."
		        },

		        division:{
		            required : "Please select division name."
		        },

		        pstatus:{
		            required : "Please select pension status."
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
				},
		 
		    }); 


   });

   $("#pensionbtn2").click(function(){

        $('#editpensionform2').validate({
		    focusInvalid: false,
		    ignore: "",

		    rules: {

		       name:{
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

		         aadhar_no:{
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

		        pstatus:{
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

		        aadhar_no:{
		            required : "Please enter aadhar no."
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

		        pstatus:{
		            required : "Please select pension status."
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
				},
		 
		    }); 


   });


   $("#pensionbtn3").click(function(){

       $('#editpensionform3').validate({
		    focusInvalid: false,
		    ignore: "",

		    rules: {

		       name:{
		                required :true
		           },

		        mobile_no:{
		            required : true,
		            number: true
		        },

		        gender:{
		            required : true
		        },

		        aadhar_no:{
		            required : true
		        },

		        pan_no:{
		            required : true
		        },

		        date_death:{
		            required : true
		        },

		        relation:{
		            required : true
		        },

		        organisation:{
		            required : true
		        },

		        division:{
		            required : true
		        },

		        pstatus:{
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

		        organisation:{
		            required : "Please select organisation."
		        },

		        division:{
		            required : "Please select division name."
		        },

		        pstatus:{
		            required : "Please select pension status."
		        },

		        aadhar_no:{
		            required : "Please enter aadhar no."
		        },

		        pan_no:{
		            required : "Please enter pan no."
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

// pension submit 1
function pension_submit1() 
{
	var adhar_1 = $('#adhar_1').val();
	var pan1 	= $('#pan_1').val();
	var rawdt = "<?php echo $this->config->item('salt_keyy'); ?>";

	var ency 	= CryptoJS.AES.encrypt(adhar_1,rawdt);
	var ency2 	= CryptoJS.AES.encrypt(pan1,rawdt);  


    $('#adhar_1').val(ency);
    $('#pan_1').val(ency2);
}

//pension submit 2

function pension_submit2() 
{

	var adhar_2 = $('#adhar_2').val();
	var pan_2 	= $('#pan_2').val();
	var rawdt 	= "<?php echo $this->config->item('salt_keyy'); ?>";

	var ency 	= CryptoJS.AES.encrypt(adhar_2,rawdt);
	var ency2 	= CryptoJS.AES.encrypt(pan_2,rawdt);  


    $('#adhar_2').val(ency);
    $('#pan_2').val(ency2);
	
}//ends function

//pension submit 3

function pension_submit3() 
{
	var adhar_3 = $('#adhar_3').val();
	var pan_3 	= $('#pan_3').val();
	var rawdt 	= "<?php echo $this->config->item('salt_keyy'); ?>";

	var ency 	= CryptoJS.AES.encrypt(adhar_3,rawdt);
	var ency2 	= CryptoJS.AES.encrypt(pan_3,rawdt);  

	$('#adhar_3').val(ency);
    $('#pan_3').val(ency2);

}//ends

//pension submit 4

function pension_submit4() 
{
	var adhar_4 = $('#adhar_4').val();
	var pan_4 	= $('#pan_4').val();
	var rawdt 	= "<?php echo $this->config->item('salt_keyy'); ?>";

	var ency 	= CryptoJS.AES.encrypt(adhar_4,rawdt);
	var ency2 	= CryptoJS.AES.encrypt(pan_4,rawdt);  

	$('#adhar_4').val(ency);
    $('#pan_4').val(ency2);

	
}//ends


</script>

<style>
 .nodispaly{display:none;}
 .title{color:#f05e27;font-size:14px;padding-left:15px;margin-bottom:25px;}
 
 h5.divider{
	clear: both;
    padding: 10px;
    background: #0f4c9f;
    color: #fff;
    margin-left: -20px;
    margin-right: -20px;
    margin-bottom: 25px;
 }
</style>