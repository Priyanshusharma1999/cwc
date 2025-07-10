   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" style="float:left;width:100%;">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Employee</h6>
								<hr>
                           		     
								
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Employee Code</label>
									<?php echo $employee_data->employee_code; ?>
								</div>
                           </div> 
                            
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Employee Name</label>
									<?php echo $employee_data->employee_name; ?>
								</div>
                            </div>
							
						 <div class="col-sm-6">
							<div class="form-group">
								<label>Office/Directorate/Section</label>
								<?php  $office = $this->Base_model->get_record_by_id('employee_office',array('office_id'=>$employee_data->post));
								echo $office->office_name; ?>
							</div>
                          </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Designation</label>
									<?php 
                                    	$desigantion_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $employee_data->employee_designation));
                                    	echo $desigantion_data->designation_name;
                                    ?>
									
									
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Reporting Officer</label>
									<?php 
										$desigantion_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $employee_data->employee_designation));
                                    	$desigantion =  $desigantion_data->designation_name;
                                    	$employee_data = $this->Base_model->get_record_by_id('employee', array('employee_id' => $employee_data->employee_id));
                                    	echo $employee_data->employee_name.' | '.$employee_data->employee_code.' | '.$desigantion;;
                                    ?>
									
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile</label>
									<?php echo $employee_data->employee_mobile_no; ?>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline(o)</label>
									<?php echo $employee_data->employee_landline_no; ?>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline(Residence)</label>
									<?php echo $employee_data->employee_landline_no_residence; ?>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email</label>
									<?php echo $employee_data->employee_email; ?>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Building</label>
									<?php 
                                    	$building_data = $this->Base_model->get_record_by_id('building', array('building_id' => $employee_data->building_id));
                                    	echo $building_data->building_name;
                                    ?>
								</div>
                            </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Floor</label>
									<?php 
                                    	$room_data = $this->Base_model->get_record_by_id('room_no', array('room_id' => $employee_data->room_id));
                                    	echo $room_data->room_name;
                                    ?>
									
								</div>
                            </div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>B.P.L. No.</label>
									<?php echo $employee_data->employee_intercom; ?>
								</div>
                            </div>
							
							<div class="col-sm-6">
								
									<div class="form-group">
										<label>Show in Telephone Directory</label>
											<?php

											if($employee_data->telephone==1) 
											{
												echo 'Show';
											}

											else if($employee_data->telephone==0) 
											{
												echo 'Not Show';
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
									<label>Status</label>
									<?php

											if($employee_data->status==1) 
											{
												echo 'Active';
											}

											else if($employee_data->status==0) 
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
                        
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

<style>
	
	 label{width:35%;}
    .form-group{

	    margin-bottom: 20px;
	    float: left;
	    width: 100%;
	    padding: 10px;
	    border: 1px solid #ccc;
	}

</style>