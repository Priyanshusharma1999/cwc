	
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit User</h6>
								<hr>

						<?php if($this->session->flashdata('flashError_user')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_user'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
                                
						<?php
					 	$attributes = array('class' => '', 'id' =>'add_usserrs');
     					echo form_open_multipart('Users/edit_user/'.$user_data->Id,$attributes);?> 
						
						  <div class="col-sm-6">
						   <div class="form-group">
								<label class="control-label">Select User Type<span class="required">*</span></label>
								<select  class="form-control" id="usertype" name = "user_type">
								   <option selected="selected" value="">Select User Type</option>
								   <option value="1" <?php if($user_data->user_type == '1') echo 'selected="selected"' ?>>Admin</option>
								  <!--  <option value="2"<?php //if($user_data->user_type == '2') echo 'selected="selected"' ?>>Region Officer</option> -->
								   <option value="3" <?php if($user_data->user_type == '3') echo 'selected="selected"' ?>>Circle Officer</option>
								</select>
							</div>
						  </div>	
						  
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Name<span class="required">*</span></label>
									<input class="form-control" name = "user_name" type="text" maxlength = "80" placeholder="Officer Name" value = "<?php echo $user_data->name; ?>">
								</div>
                           </div>

                            <div class="col-sm-6">
						     <div class="form-group">
                                <label>UserId<span class="required">*</span></label>
                                <input class="form-control" name = "user_id" type="text" maxlength = "80" placeholder="UserId" value = "<?php echo $user_data->user_id; ?>">
                            </div>
						  </div>

						   
						  <div class="col-sm-6">
						     <div class="form-group">
                                <label>Email<span class="required">*</span></label>
                                <input class="form-control" name = "email" type="email" maxlength = "80" placeholder="Officer Email" value = "<?php echo $user_data->email; ?>">
                            </div>
						  </div>

						  <div class="col-sm-6">
						     <div class="form-group">
                                <label>Password<span class="required">*</span></label>
                                <input class="form-control" name = "password" type="password" maxlength = "80" placeholder="Password" value = "<?php echo $user_data->password; ?>">
                            </div>
						  </div>	
						  
						  <div class="col-sm-6">
						    <div class="form-group">
                                <label>Contact No.<span class="required">*</span></label>
                                <input class="form-control" name = "contact_no" maxlength = "20" type="text" placeholder=" Officer Contact No." value = "<?php echo $user_data->phone; ?>">
                            </div>
						  </div>
                          
						  
						  	<div class="col-sm-6" id="region">
							    <div class="form-group">
								<label class="control-label">Region Name<span class="required">*</span></label>
								<select name = "region_name" class="form-control" id = "region_post">
								   <option selected="selected" value="">Select Prefered region</option>
									<?php
				                        $all_data[] = $user_data->Division;
				                    	foreach ($all_regions as $rows ) {  ?>
				                        <option value="<?php echo $rows->id; ?>"
				                    	<?php 
				                    		echo (isset($user_data->Division) && in_array($rows->id,$all_data) ) ? "selected" : "" ?> ><?php echo $rows->region_name; ?>
				                    	</option>
				                      <?php } ?>
								</select>
							   </div>
							
						    </div>
						  
							<div class="col-sm-6" id="circle">
							    <div class="form-group">
									<label class="control-label">Circle Name<span class="required">*</span></label>
									<select name = "circle_name" class="form-control" id = "circlee_post">
									<?php
                    
					                     $all_dataa[]	 = $user_data->Circle;
					                      foreach ($all_circle as $rowss){ ?>   
					                   
					                    <option value="<?php echo $rowss->id; ?>"
					                	<?php echo (isset($user_data->Circle) && in_array($rowss->id,$all_dataa) ) ? "selected" : "" ?>  ><?php echo $rowss->circle_name; ?></option>
					            		<?php } ?>
									</select>
									<span class = "text-danger"><?php echo form_error('circle_name');?></span>
								</div>
						    </div>
						
							<div class="m-t-20" style="clear:both;padding-left:15px;">
								<button name="submit" type="submit" class="btn btn-primary">Update</button>
						
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
