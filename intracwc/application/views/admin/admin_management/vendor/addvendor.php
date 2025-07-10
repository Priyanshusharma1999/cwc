
	
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
			  <div class="breadcrumb flat">
				<!-- <a href="#"  class="active">Dashboard</a>
				<a href="#" class="active">Admin</a> -->
			  </div>
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Vendor Registration</h6>
								<hr>
								<?php if($this->session->flashdata('flashError_vendor')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_vendor'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>
                                
						<?php
						 	$attributes = array('class' => '', 'id' =>'add_vendor');
	     					echo form_open_multipart('Administrator/Vendor/add_vendor/',$attributes);?>
						
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Company Name<span class="required">*</span></label>
									<input class="form-control" name="company_name" type="text" placeholder="Company Name" value = "<?php echo isset($insertData['company_name']) ? $insertData['company_name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('company_name');?></span>
								</div>
                            </div>
							
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Order No.<span class="required">*</span></label>
									<input class="form-control" name="order_no" type="text" placeholder="Order No." value = "<?php echo isset($insertData['order_no']) ? $insertData['order_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('order_no');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Address<span class="required">*</span></label>
									<input class="form-control" name="address" type="text" placeholder="Address" value = "<?php echo isset($insertData['address']) ? $insertData['address'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('address');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No.<span class="required">*</span></label>
									<input class="form-control" name="mobile_no" maxlength="10" type="text" placeholder="Mobile No." value = "<?php echo isset($insertData['mobile_no']) ? $insertData['mobile_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline No.<span class="required">*</span></label>
									<input class="form-control" name="vendorlandline_no" maxlength="13" type="text" placeholder="Landline No." value = "<?php echo isset($insertData['vendorlandline_no']) ? $insertData['vendorlandline_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('vendorlandline_no');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email<span class="required">*</span></label>
									<input class="form-control"  name="email" type="email" maxlength="80" placeholder="Email" value = "<?php echo isset($insertData['email']) ? $insertData['email'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('email');?></span>
								</div>
                            </div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Contract Valid Till<span class="required">*</span></label>
							
							 <!-- <div class="cal-icon"> -->
									  <input class="form-control"  name="contact_valid_till" placeholder="dd/mm/yy" type="date" value = "<?php echo isset($insertData['contact_valid_till']) ? $insertData['contact_valid_till'] : ''; ?>">
									  <span class = "text-danger"><?php echo form_error('contact_valid_till');?></span>
							<!--  </div> --> 
						
						     </div>
                            </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Service Type<span class="required">*</span></label>
									<select name="service_type" class="form-control">
									   <option selected="selected"  value="">Select Service Type</option>
										<option value="1">IT</option>
										<option value="2">Non-IT</option>
									</select>
								</div>
                            </div>
							
							
							<h6 class="card-title text-bold" style="float: left;width: 100%;padding-left: 15px;border-bottom: 1px solid #ddd;padding-bottom: 15px;">Service</h6>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Category<span class="required">*</span></label>
									<select required="required" name="complaint_type" class="form-control">
									   <option selected="selected"  value="">Select Category</option>
										<?php
											if(empty($all_complaint))
											{
												echo '<option selected="selected"  value="">Select Category</option>';
											}

											else
											{
												foreach ($all_complaint as $complaint)
						                      {   
						                         echo '<option value="'.$complaint->complaint_type_id.'">'.$complaint->description.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Estimated Time(In hrs.)<span class="required">*</span></label>
									<input class="form-control" maxlength="10" name="estimated_time" type="text" placeholder="Time to resolve" value = "<?php echo isset($insertData['estimated_time']) ? $insertData['estimated_time'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('estimated_time');?></span>
								</div>
                            </div>
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Add Vendor</button>
                            </div>
                        </form>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

