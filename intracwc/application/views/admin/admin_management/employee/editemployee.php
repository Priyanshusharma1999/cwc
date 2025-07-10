   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Employee</h6>
								<hr>
                           		<?php if($this->session->flashdata('flashError_employee')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_employee'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>     
								<?php
							 	$attributes = array('class' => '', 'id' =>'add_employee');
		     					echo form_open_multipart('Administrator/Employee/edit_employee/'.$employee_data->employee_id,$attributes);?>
						   <!-- <div class="col-sm-6">
								<div class="form-group">
									<label>Employee Code<span class="required">*</span></label>
									<input class="form-control" name="employee_code" maxlength="100" type="text" placeholder="Employee Code" value="<?php //echo $employee_data->employee_code; ?>">
								</div>
                            </div> -->
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Employee Name<span class="required">*</span></label>
									<input class="form-control" name="employee_name" type="text" placeholder="Employee Name" value="<?php echo $employee_data->employee_name; ?>">
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									
									<label>Office/Directorate/Section<span class="required">*</span></label>
									
									<select name="employee_post" class="form-control">
									   <option selected="selected" value="">Select Office</option>
										<?php
											foreach ($officelist as $office)
						                      {?> 

						                      	<option value="<?php echo $office->office_id; ?>" <?php if($employee_data->post == $office->office_id){ echo 'selected';} ?>><?php echo $office->office_name; ?></option>

						                      <?php }
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
				                        	$all_data1[] = $employee_data->employee_designation;
					                    	foreach ($all_designation as $rows1 ) {  ?>
					                        <option value="<?php echo $rows1->designation_id; ?>"
					                    	<?php 
					                    		echo (isset($employee_data->employee_designation) && in_array($rows1->designation_id,$all_data1) ) ? "selected" : "" ?> ><?php echo $rows1->designation_name; ?>
					                    	</option>
				                      <?php } ?>
										
									</select>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Reporting Officer<span class="required"></span></label>
									<select class="form-control" name="reporting_officer">
									   <option selected="selected" value="">Select Reporting Officer</option>
										<?php
				                        	$all_data2[] = $employee_data->reporting_officer;
					                    	foreach ($all_employee as $rows2 ) {  ?>
					                        <option value="<?php echo $rows2->employee_id; ?>"
					                    	<?php 
					                    		$desigantion_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $rows2->employee_designation));
                                    			$desigantion =  $desigantion_data->designation_name;	
					                    		echo (isset($employee_data->reporting_officer) && in_array($rows2->employee_id,$all_data2) ) ? "selected" : "" ?> ><?php echo $rows2->employee_name.' | '.$rows2->employee_code.' | '.$desigantion; ?>
					                    	</option>
				                      <?php } ?>
										
									</select>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile<span class="required">*</span></label>
									<input class="form-control" type="text" name="employee_mobile" maxlength="10" placeholder="Mobile" value="<?php echo $employee_data->employee_mobile_no; ?>">
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline No.(office)<span class="required">*</span></label>
									<input class="form-control" type="text" name="employee_landline_no" maxlength="13" placeholder="Landline No." value="<?php echo $employee_data->employee_landline_no; ?>">
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline No.(Residence)<span class="required"></span></label>
									<input class="form-control" type="text" maxlength="13" name="employee_landline_no_residence" placeholder="Landline Residence No." value="<?php echo $employee_data->employee_landline_no_residence; ?>">
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email<span class="required">*</span></label>
									<input class="form-control" type="email" maxlength="100" name="employee_email" placeholder="Email Id" value="<?php echo $employee_data->employee_email; ?>">
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Building<span class="required">*</span></label>
									<select name="building_name" id="building_id1" class="form-control">
									   <option selected="selected" value="">Select Building</option>
									   <?php
				                        	$all_data3[] = $employee_data->building_id;
					                    	foreach ($all_buildings as $rows3 ) {  ?>
					                        <option value="<?php echo $rows3->building_id; ?>"
					                    	<?php 
					                    		echo (isset($employee_data->building_id) && in_array($rows3->building_id,$all_data3) ) ? "selected" : "" ?> ><?php echo $rows3->building_name; ?>
					                    	</option>
				                      <?php } ?>
										
									</select>
								</div>
                            </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Floor<span class="required">*</span></label>
									<select name="rooom_id" id="room_id" class="form-control">
									   <option selected="selected" value="">Select Floor</option>
										<?php
				                        	$all_data4[] = $employee_data->room_id;
					                    	foreach ($all_rooms as $rows4 ) {  ?>
					                        <option value="<?php echo $rows4->room_id; ?>"
					                    	<?php 
					                    		echo (isset($employee_data->room_id) && in_array($rows4->room_id,$all_data4) ) ? "selected" : "" ?> ><?php echo $rows4->room_name; ?>
					                    	</option>
				                      <?php } ?>
									</select>
								</div>
                            </div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>B.P.L. No.<span class="required">*</span></label>
									<input class="form-control" maxlength="5" name="employee_intercom" value="<?php echo $employee_data->employee_intercom; ?>" type="text" placeholder="B.P.L. No.">
								</div>
                            </div>
							
							
                             <div class="col-sm-6">
								<div class="form-group">
									<label>Status<span class="required">*</span></label>
									<select required="required" name = "status" class="form-control">
									   <option selected="selected" value="1" <?php if($employee_data->status == '1') echo 'selected="selected"' ?>>Active</option>
									   <option  value="0" <?php if($employee_data->status == '0') echo 'selected="selected"' ?>>Deactive</option>
									</select>
								</div>
                            </div>
							
							<div class="col-sm-6">
								
									<div class="checkbox" style="margin-top:35px;">
										<label style="font-size:15px;">
											<input type="checkbox" name="show_telephone" value="1" <?php if($employee_data->telephone==1) echo " checked "?>> Show in Telephone Directory
										</label>
									</div>
								
                            </div>

							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Update Employee</button>
                            </div>
                        <?php echo form_close(); ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

