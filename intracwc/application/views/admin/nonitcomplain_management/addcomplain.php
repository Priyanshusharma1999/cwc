   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Complaint</h6>
								<hr>
                   <?php if($this->session->flashdata('flashError_complain')) { ?>
					<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_complain'); ?> 
					  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
					</div> 
				  <?php } ?>        
						   
				<?php
					$attributes = array('class' => '', 'id' =>'add_complain');
     				echo form_open_multipart('nonitcomplaint/complain/addcomplain/',$attributes);?>
						   
						     <div class="col-sm-6">
								<div class="form-group">
									<label>Complaint Category<span class="required">*</span></label>
							   <select  class="form-control" name="category">
								   <option value="">Select Category</option>
								   <?php foreach($complain_category as $category){?>
								    <option value="<?php echo $category->category_id;?>">
									  <?php echo $category->category_name; ?>
									</option>
								   <?php } ?>	
								</select>
								<span class="text-danger"><?php echo form_error('category');?></span>
								</div>
                            </div>
						  
							 <div class="col-sm-6">
								<div class="form-group">
								<label>Building<span class="required">*</span></label>
								<input type="text" value="<?php echo $building->building_id; ?>" name="building" hidden>
								<input class="form-control floating" type="text"  value="<?php echo $building->building_name; ?>" readonly>
								 <span class="text-danger"><?php echo form_error('building');?></span>
							</div>
                            </div>
							
							 <div class="col-sm-6">
								<div class="form-group">
								    <label>Floor<span class="required">*</span></label>
								    <input type="text" value="<?php echo $room->room_id; ?>" name="room" hidden>
									<input class="form-control floating" type="text"  value="<?php echo $room->room_name; ?>" readonly>
									 <span class="text-danger"><?php echo form_error('room');?></span>
								</div>
                            </div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Name<span class="required">*</span></label>
					    <input class="form-control floating" name="empname" type="text"  value="<?php echo $user_detail->user_name; ?>" readonly>
								    <span class="text-danger"><?php echo form_error('empname');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
								<label>Designation<span class="required">*</span></label>
								<input type="text" value="<?php echo $designation->designation_id; ?>" name="designation" hidden>
								<input class="form-control floating" type="text"  value="<?php echo $designation->designation_name; ?>" readonly>
								<span class="text-danger"><?php echo form_error('designation');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile no.<span class="required">*</span></label>
								<input class="form-control floating" name="mobile_no" type="text"  value="<?php echo $user_detail->contact_no; ?>" maxlength="10" readonly>
									<span class="text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
                            </div>
							
							<?php 

                            	$emp_data = $this->Base_model->get_record_by_id('employee', array('	employee_id' => $user_detail->employee_id));
                            	$landline =  $emp_data->employee_landline_no;
                            ?>
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline no.<span class="required">*</span></label>
								<input class="form-control floating" type="text" placeholder="Enter Landline No." name="landline_no"  maxlength="13" value="<?php echo $landline; ?>">
								<span class="text-danger"><?php echo form_error('landline_no');?></span>
								</div>
                            </div>
							
							<?php 

                            	$emp_data = $this->Base_model->get_record_by_id('employee', array('	employee_id' => $user_detail->employee_id));
                            	$intercom =  $emp_data->employee_intercom;
                            ?>

							<div class="col-sm-6">
								<div class="form-group">
									<label>B.P.L. No.<span class="required"></span></label>
									<input class="form-control floating" name="intercom" type="text" placeholder="Enter B.P.L. No." value="<?php echo $intercom; ?>"  maxlength="5" >
								</div>
                            </div>
						
						   <div class="col-sm-6">
								<div class="form-group" style="margin-bottom:20px;">
									<label>Description<span class="required">*</span></label>
							   <textarea class="form-control" name="description"  placeholder="Description"></textarea>
							   <span class="text-danger"><?php echo form_error('description');?></span>
								</div>
                            </div>
							
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button type="submit" name="submit" class="btn btn-primary">
								  Add Complaint
							    </button>
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
		    min-height: 86px;
		}

	</style>