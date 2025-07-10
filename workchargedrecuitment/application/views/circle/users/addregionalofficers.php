	
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add User</h6>
								<hr>

						<?php if($this->session->flashdata('flashSuccess_user')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_user');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>

						<?php if($this->session->flashdata('flashError_user')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_user'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
                                
						<?php
					 	$attributes = array('class' => '', 'id' =>'add_usserrs');
     					echo form_open_multipart('Users/add_users/',$attributes);?> 
						
						  <div class="col-sm-6">
						   <div class="form-group">
								<label class="control-label">Select User Type<span class="required">*</span></label>
								<select  class="form-control" id="usertype" name = "user_type">
								   <option selected="selected" value="">Select User Type</option>
								   <option value="1">Admin</option>
								   <!-- <option value="2">Region Officer</option> -->
								   <option value="3">Circle Officer</option>
								</select>
							</div>
						  </div>	
						  
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Name<span class="required">*</span></label>
									<input class="form-control" name = "user_name" type="text" maxlength = "80" placeholder="Name" value = "<?php echo isset($insertData['user_name']) ? $insertData['user_name'] : ''; ?>">
								</div>
                           </div>
						   
						   <div class="col-sm-6">
						     <div class="form-group">
                                <label>UserId<span class="required">*</span></label>
                                <input class="form-control" name = "user_id" type="text" maxlength = "80" placeholder="UserId" value = "<?php echo isset($insertData['user_id']) ? $insertData['user_id'] : ''; ?>">
                            </div>
						  </div>

						  <div class="col-sm-6">
						     <div class="form-group">
                                <label>Email<span class="required">*</span></label>
                                <input class="form-control" name = "email" type="email" maxlength = "80" placeholder="Email" value = "<?php echo isset($insertData['email']) ? $insertData['email'] : ''; ?>">
                            </div>
						  </div>

						  <div class="col-sm-6">
						     <div class="form-group">
                                <label>Password<span class="required">*</span></label>
                                <input class="form-control" name = "password" type="password" maxlength = "80" placeholder="Password" value = "<?php echo isset($insertData['password']) ? $insertData['password'] : ''; ?>">
                            </div>
						  </div>	
						  
						  <div class="col-sm-6">
						    <div class="form-group">
                                <label>Contact No.<span class="required">*</span></label>
                                <input class="form-control" name = "contact_no" maxlength = "20" type="text" placeholder=" Contact No." value = "<?php echo isset($insertData['contact_no']) ? $insertData['contact_no'] : ''; ?>">
                            </div>
						  </div>
                          
						  
						  	<div class="col-sm-6" id="region">
							    <div class="form-group">
								<label class="control-label">Region Name<span class="required">*</span></label>
								<select name = "region_name" class="form-control" id = "region_post">
								   <option selected="selected" value="">Select Preferred Region</option>
									<?php
											if(empty($all_regions))
											{
												echo '<option value="1">'.'Select Region'.'</option>';
											}

											else
											{
												foreach ($all_regions as $service)
	                      {   
	                         echo '<option value="'.$service->id.'">'.$service->region_name.'</option>';
	                      }
											}
                      
                    ?>
								</select>
							   </div>
							
						    </div>
						  
							<div class="col-sm-6" id="circle">
							    <div class="form-group">
									<label class="control-label">Circle Name<span class="required">*</span></label>
									<select name = "circle_name" class="form-control" id = "circlee_post">
									<option selected="selected" value="">Select Circle</option>
									</select>
									<span class = "text-danger"><?php echo form_error('circle_name');?></span>
								</div>
						    </div>

						   
						
							<div class="m-t-20" style="clear:both;padding-left:15px;">
								<button name="submit" type="submit" class="btn btn-primary">Add User</button>
						
							</div>
							
                        <?php echo form_close() ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      


<script>
   $('#usertype').on('change', function() {
	 
	   if(this.value == "Admin"){
	     $("#region").hide();
		 $("#circle").hide();
	   } else if(this.value == "Region"){
		   
		   $("#region").show();
		    $("#circle").hide();
		   
	   } else if(this.value == "Circle"){
		   
		    $("#region").show();
		    $("#circle").show();
		   
	   } else {
		   
		    $("#region").show();
		    $("#circle").show();
		   
	   }
	  
	})
</script>
