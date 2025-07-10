  
	
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
			  <div class="breadcrumb flat">
		<!-- 		<a href="#"  class="active">Dashboard</a>
				<a href="#" class="active">Admin</a> -->
			  </div>
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Vendor's Employee Registration</h6>
								<hr>
                                
						<?php
						 	$attributes = array('class' => '', 'id' =>'add_vendoremployee');
	     					echo form_open_multipart('Administrator/Vendor_employee/add_vendoremployee/',$attributes);?>
						
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Employee Name<span class="required">*</span></label>
									<input class="form-control" name="emplyee_name" type="text" placeholder="Vendor's Employee Name" value = "<?php echo isset($insertData['emplyee_name']) ? $insertData['emplyee_name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('emplyee_name');?></span>
								</div>
                            </div>
						
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Vendor<span class="required">*</span></label>
									<select name="vendor_id" class="form-control">
									   <option selected="selected" value="">Select Vendor</option>
										
										<?php
											if(empty($all_vendor))
											{
												echo '';
											}

											else
											{
												foreach ($all_vendor as $vendor)
						                      {   
						                         echo '<option value="'.$vendor->vendor_id.'">'.$vendor->company_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								</div>
                            </div>
						
						  <div class="col-sm-6">
								<div class="form-group">
									<label>Designation<span class="required">*</span></label>
									<input class="form-control" type="text" name="employee_designation" maxlength="150" placeholder="Designation" value = "<?php echo isset($insertData['employee_designation']) ? $insertData['employee_designation'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_designation');?></span>
									<!-- <select name="employee_designation" class="form-control">
									   <option selected="selected" value="">Select Designation</option>
										<?php
											//if(empty($all_designation))
											{
												//echo '';
											}

											//else
											{
												//foreach ($all_designation as $designation)
						                      {//   
						                        // echo '<option value="'.$designation->designation_id.'">'.$designation->designation_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select> -->
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No.<span class="required">*</span></label>
									<input class="form-control" type="text" name="emplyee_mobile" maxlength="10" placeholder="Mobile No." value = "<?php echo isset($insertData['emplyee_mobile']) ? $insertData['emplyee_mobile'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('emplyee_mobile');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline No.<span class="required">*</span></label>
									<input class="form-control" name="employee_landline_no" maxlength="13" type="text" placeholder="Landline No." value = "<?php echo isset($insertData['employee_landline_no']) ? $insertData['employee_landline_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_landline_no');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email<span class="required">*</span></label>
									<input class="form-control" name="employee_email" maxlength="100" type="email" placeholder="Email" value = "<?php echo isset($insertData['employee_email']) ? $insertData['employee_email'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('employee_email');?></span>
								</div>
                            </div>
							
						
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Add Vendor's Employee</button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      
