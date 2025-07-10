    
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
			  <div class="breadcrumb flat">
				
			  </div>
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Employee</h6>
								<hr>
								<?php if($this->session->flashdata('flashError_employee')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_employee'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>
                                
							<?php
						 	$attributes = array('class' => '', 'id' =>'add_employee');
	     					echo form_open_multipart('Administrator/Employee/add_employee/',$attributes);?>
						   <!-- <div class="col-sm-6">
								<div class="form-group">
									<label>Employee Code<span class="required">*</span></label>
									<input class="form-control" name="employee_code" maxlength="100" type="text" placeholder="Employee Code" value = "<?php //echo isset($insertData['employee_code']) ? $insertData['employee_code'] : ''; ?>">
									<span class = "text-danger"><?php //echo form_error('employee_code');?></span>
								</div>
                            </div> -->
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Employee Name<span class="required">*</span></label>
									<input class="form-control" name="employee_name" type="text" placeholder="Employee Name" value = "<?php echo isset($insertData['employee_name']) ? $insertData['employee_name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_name');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Office/Directorate/Section<span class="required">*</span></label>
									<select name="employee_post" class="form-control">
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
									</select>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Designation<span class="required">*</span></label>
									<select name="employee_designation" class="form-control">
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

						                         echo '<option value="'.$designation->designation_id.'">'.$designation->designation_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								</div>
                            </div>

                            
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Reporting Officer<span class="required"></span></label>
									<select class="form-control" name="reporting_officer">
									   <option selected="selected" value="">Select Reporting Officer</option>
										
										<?php
											if(empty($all_employee))
											{
												echo '';
											}

											else
											{
												foreach ($all_employee as $employee)
						                      {   
						                      	$desigantion_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $employee->employee_designation));
                                    			$desigantion =  $desigantion_data->designation_name;	
						                         echo '<option value="'.$employee->employee_id.'">'.$employee->employee_name.' | '.$employee->employee_code.' | '.$desigantion.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile<span class="required">*</span></label>
									<input class="form-control" name="employee_mobile" maxlength="10" type="text" placeholder="Mobile" value = "<?php echo isset($insertData['employee_mobile']) ? $insertData['employee_mobile'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_mobile');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline No.(office)<span class="required">*</span></label>
									<input class="form-control" name="employee_landline_no" maxlength="13" type="text" placeholder="Landline No." value = "<?php echo isset($insertData['employee_landline_no']) ? $insertData['employee_landline_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_landline_no');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline No.(Residence)<span class="required"></span></label>
									<input class="form-control" maxlength="13" name="employee_landline_no_residence" type="text" placeholder="Landline Residence No." value = "<?php echo isset($insertData['employee_landline_no_residence']) ? $insertData['employee_landline_no_residence'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_landline_no_residence');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email<span class="required">*</span></label>
									<input class="form-control" maxlength="100" name="employee_email" type="email" placeholder="Email Id" value = "<?php echo isset($insertData['employee_email']) ? $insertData['employee_email'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_email');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Building<span class="required">*</span></label>
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
								<div class="form-group">
									<label>Floor<span class="required">*</span></label>
									<select name="rooom_id" id="room_id" class="form-control">
									   <option selected="selected" value="">Select Floor</option>
										
									</select>
								</div>
                            </div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>B.P.L. No.<span class="required">*</span></label>
									<input class="form-control" name="employee_intercom" type="text" placeholder="B.P.L. No." maxlength="5" value = "<?php echo isset($insertData['employee_intercom']) ? $insertData['employee_intercom'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_intercom');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								
									<div class="checkbox" >
										<label style="font-size:15px;">
											<input type="checkbox" name="show_telephone" value="1"> Show in Telephone Directory
										</label>
									</div>
								
                            </div>
							
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Add Employee</button>
                            </div>
                       	<?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

<style>
 
.form-group {
    margin-bottom: 0;
    min-height: 90px;
}
 
</style>