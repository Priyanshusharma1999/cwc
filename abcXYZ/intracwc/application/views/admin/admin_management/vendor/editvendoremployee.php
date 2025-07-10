
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Vendor's Employee</h6>
								<hr>
								<?php if($this->session->flashdata('flashError_vendor')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_vendor'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>  
                                
							<?php
							 	$attributes = array('class' => '', 'id' =>'add_vendoremployee');
		     					echo form_open_multipart('Administrator/Vendor_employee/edit_vendoremployee/'.$vendoremployee_data->vendor_employee_id,$attributes);?>

						   <div class="col-sm-6">
								<div class="form-group">
									<label>Employee Name<span class="required">*</span></label>
									<input class="form-control" name="emplyee_name" type="text" placeholder="Vendor Employee Name" value = "<?php echo $vendoremployee_data->vendor_employee_name; ?>">
									<span class = "text-danger"><?php echo form_error('emplyee_name');?></span>
								</div>
                            </div>
						
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Vendor<span class="required">*</span></label>
									<select name="vendor_id" class="form-control">
									   <option selected="selected" value="">Select Vendor</option>
										 <?php
				                        	$all_data1[] = $vendoremployee_data->vendor_id;
					                    	foreach ($all_vendor as $rows2 ) {  ?>
					                        <option value="<?php echo $rows2->vendor_id; ?>"
					                    	<?php 
					                    		echo (isset($vendoremployee_data->vendor_id) && in_array($rows2->vendor_id,$all_data1) ) ? "selected" : "" ?> ><?php echo $rows2->company_name; ?>
					                    	</option>
				                      <?php } ?>
										
									</select>
								</div>
                            </div>
						
						  <div class="col-sm-6">
								<div class="form-group">
									<label>Designation<span class="required">*</span></label>
									<input class="form-control" type="text" name="employee_designation" maxlength="150" placeholder="Designation" value = "<?php echo $vendoremployee_data->vendor_employee_designation ?>">
									<span class = "text-danger"><?php echo form_error('employee_designation');?></span>
								
										
									</select>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No.<span class="required">*</span></label>
									<input class="form-control" type="text" name="emplyee_mobile" maxlength="10" placeholder="Mobile No." value = "<?php echo $vendoremployee_data->vendor_employee_mobile_no; ?>">
									<span class = "text-danger"><?php echo form_error('emplyee_mobile');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline No.<span class="required">*</span></label>
									<input class="form-control" name="employee_landline_no" maxlength="13" type="text" placeholder="Landline No." value = "<?php echo $vendoremployee_data->vendor_employee_landline_no; ?>">
									<span class = "text-danger"><?php echo form_error('employee_landline_no');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email<span class="required">*</span></label>
									<input class="form-control" name="employee_email" maxlength="100" type="email" placeholder="Email" value = "<?php echo $vendoremployee_data->vendor_employee_email; ?>">
									<span class = "text-danger"><?php echo form_error('employee_email');?></span>
								</div>
                            </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Status<span class="required">*</span></label>
									<select required="required" name = "status" class="form-control">
									   <option selected="selected" value="1" <?php if($vendoremployee_data->status == '1') echo 'selected="selected"' ?>>Active</option>
									   <option  value="0" <?php if($vendoremployee_data->status == '0') echo 'selected="selected"' ?>>Deactive</option>
									</select>
								</div>
                            </div>
							
							
						
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Update Vendor's Employee</button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

