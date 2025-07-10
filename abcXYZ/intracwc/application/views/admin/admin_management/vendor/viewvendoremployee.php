
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" style="float:left;width:100%;">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Vendor's Employee</h6>
								<hr>
								

						   <div class="col-sm-6">
								<div class="form-group">
									<label>Employee Name<span class="required"></span></label>
									<?php echo $vendoremployee_data->vendor_employee_name; ?>
									
								</div>
                            </div>
						
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Vendor<span class="required"></span></label>
									<?php 
	                                	$vendor_data = $this->Base_model->get_record_by_id('vendor', array('vendor_id' => $vendoremployee_data->vendor_id));
	                                	echo $vendor_data->company_name;
                                	?>
									
								</div>
                            </div>
						
						  <div class="col-sm-6">
								<div class="form-group">
									<label>Designation<span class="required"></span></label>
									<?php 
	                                	/*$designation_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $vendoremployee_data->vendor_employee_designation));*/
	                                	echo $vendoremployee_data->vendor_employee_designation;
                                	?>
									
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No.<span class="required"></span></label>
									<?php echo $vendoremployee_data->vendor_employee_mobile_no; ?>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline No.</label>
									<?php echo $vendoremployee_data->vendor_employee_landline_no; ?>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email<span class="required"></span></label>
									<?php echo $vendoremployee_data->vendor_employee_email; ?>
								</div>
                            </div>

                             <div class="col-sm-6">
								<div class="form-group">
									<label>Status<span class="required"></span></label>
									<?php

											if($vendoremployee_data->status==1) 
											{
												echo 'Active';
											}

											else if($vendoremployee_data->status==0) 
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