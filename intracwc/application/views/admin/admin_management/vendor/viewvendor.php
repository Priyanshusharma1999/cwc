   
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" style="float:left;width:100%;">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Vendor</h6>
								<hr>
								 
						   
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Company Name<span class="required"></span></label>
									<?php echo $vendor_data->company_name;?>
									<?php echo form_error('company_name');?>
								</div>
                            </div>
							
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Order No.<span class="required"></span></label>
									<?php echo $vendor_data->order_no;?>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Address<span class="required"></span></label>
									<?php echo $vendor_data->address;?>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No.<span class="required"></span></label>
									<?php echo $vendor_data->mobile_no;?>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline No.</label>
									<?php echo $vendor_data->landline_no;?>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email<span class="required"></span></label>
									<?php echo $vendor_data->email;?>
								</div>
                            </div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Contract Valid Till<span class="required"></span></label>
							
							 <!-- <div class="cal-icon"> -->
									<?php echo $vendor_data->contract_valid_till;?>
							<!--  </div> --> 
						
						     </div>
                            </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Service Type<span class="required"></span></label>
									<?php

											if($vendor_data->service_type==1) 
											{
												echo 'IT';
											}

											else if($vendor_data->service_type==2) 
											{
												echo 'Non-IT';
											}

											else
											{
												echo '';
											}

										?>
								</div>
                            </div>
							
							
							
							<h6 class="card-title text-bold" style="float: left;width: 100%;padding-left: 15px;border-bottom: 1px solid #ddd;padding-bottom: 15px;">Service</h6>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Category<span class="required"></span></label>
									<?php 
	                                	$complaint_type_data = $this->Base_model->get_record_by_id('compliant_type', array('complaint_type_id' => $vendor_service_data->complaint_type_id));
	                                	echo $complaint_type_data->description;
                                	?>
									
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Estimated Time(In hrs.)<span class="required"></span></label>
									<?php echo $vendor_service_data->estimated_time;?>
								</div>
                            </div>

                           <div class="col-sm-6">
								<div class="form-group">
									<label>Status<span class="required"></span></label>
									<?php

											if($vendor_data->status==1) 
											{
												echo 'Active';
											}

											else if($vendor_data->status==0) 
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