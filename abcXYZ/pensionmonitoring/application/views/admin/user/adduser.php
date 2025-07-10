  
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add User</h6>
								<hr>
								
					
						<?php if($this->session->flashdata('flashError_user')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_user'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
                                
						<?php
						$session_id = $this->session->userdata('applicant_user_id');
					 	$attributes = array('class' => 'penform', 'id' =>'add_users');
     					echo form_open_multipart('Users/addusers/'.$session_id,$attributes);?>
						
						
							<div class="profile-img-wrap">
							
							   <?php

                                        if(empty($user_detail->PROFILEIMG))
                                        {
                                          $user_pic =  base_url().'uploads/applicant_profile_photos/'.'user.jpg';
                                        }

                                        else
                                        {
                                         $user_pic = base_url().'uploads/applicant_profile_photos/'.$user_detail->PROFILEIMG;
                                        }
                                    ?>
							
								<img class="inline-block" src="<?php echo $user_pic; ?>" alt="user" id="blah">
								<div class="fileupload btn btn-default">
									<span class="btn-text">Add image</span>
									<input class="upload" name="applicant_pic"  type="file" accept=".png, .jpg, .jpeg" id="imgInp" required>
								</div>
							</div>
						   
						   <div class="col-sm-6">
								<div class="form-group">
									<label>User Role<span class="required">*</span></label>
									<select  class="form-control" name="role" id="role">
									   <option selected="selected" value="">Select Role</option>
									    <option value="1" <?php if($insertData['role'] == 1){ echo 'selected';} ?>>Super Admin (HRM Wing)</option>
										<option value="2" <?php if($insertData['role'] == 2){ echo 'selected';} ?>>Organization Admin</option>
										<option value="3" <?php if($insertData['role'] == 3){ echo 'selected';} ?>>PAO Admin</option>
										<option value="4" <?php if($insertData['role'] == 4){ echo 'selected';} ?>>Division Admin</option>
										<option value="5" <?php if($insertData['role'] == 5){ echo 'selected';} ?>>Establishment Data Entry</option>
									</select>
									<span class = "text-danger"><?php echo form_error('role');?></span>
								</div>
                            </div>
						
						    <div class="col-sm-6">
								<div class="form-group">
							<label>Full Name<span class="required">*</span></label>
							 <input class="form-control" type="text" name="full_name" autocomplete="off" placeholder="Full Name" value="<?php echo isset($insertData['full_name']) ? $insertData['full_name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('full_name');?></span>
								</div>
                            </div>
						
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No.<span class="required">*</span></label>
									<input class="form-control" type="text" maxlength="10" autocomplete="off" name="mobile_no" placeholder="Mobile No." value="<?php echo isset($insertData['mobile_no']) ? $insertData['mobile_no'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email<span class="required">*</span></label>
									<input class="form-control" type="email" name="email" autocomplete="off" value="<?php echo isset($insertData['email']) ? $insertData['email'] : ''; ?>" placeholder="Email">
									<span class = "text-danger"><?php echo form_error('email');?></span>
								</div>
                            </div>
							
							
								
							<div class="col-sm-6" id="org" style="display:none;">
								<div class="form-group">
									<label>Organization Name<span class="required"></span></label>
									<select class="form-control" name="organization_name" id="orgname">
									   <option selected="selected" value="">Select Organisation <?php echo $insertData['organization_name']; ?></option>
										 <?php foreach($org_data as $organization){?>
									    <option value="<?php echo $organization->ORGANIZATION_ID; ?>" <?php if($insertData['organization_name'] == $organization->ORGANIZATION_ID){ echo 'selected';} ?> >
										  <?php echo $organization->ORGNAME; ?>
										</option>
									<?php } ?>
									</select>
								</div>
                            </div>
							
							
							
								
							<div class="col-sm-6" id="division" style="display:none;">
								<div class="form-group">
								
									<label>Division Name<span class="required"></span></label>
									<select  class="form-control" name="division_name" id="div_name">
									   <option selected="selected" value="">Select Division</option>
									  
									  
									</select>
								</div>
                            </div>
							
							
							<h6 class="card-title text-bold" style="float: left;width: 100%;margin-top: 20px;border-bottom: 1px solid #ddd;padding-bottom: 15px;">Create User Name and Password</h6>
					   
							<div class="col-sm-6">
								<div class="form-group">
									<label>User Name<span class="required">*</span></label>
									<input class="form-control" type="text" name="user_name" autocomplete="off" value="<?php echo isset($insertData['user_name']) ? $insertData['user_name'] : ''; ?>" placeholder="User Name">
									<span class = "text-danger"><?php echo form_error('user_name');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Password<span class="required">*</span></label>
									<input class="form-control" type="password" id="pwd" name="password" placeholder="Password" maxlength="70">
									<span class = "text-danger"><?php echo form_error('password');?></span>
									<span id="span_password_msg" style="color:red">Please enter password in format consits of one upper case,one lower case,one digit, one special character.</span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Confirm Password<span class="required">*</span></label>
									<input class="form-control" type="password" id="pwd2" name="con_password" placeholder="Confirm Password" maxlength="70">
									<span class = "text-danger"><?php echo form_error('con_password');?></span>
									<span id="span_password_msg2" style="color:red">Please enter password in format consits of one upper case,one lower case,one digit, one special character.</span>
								</div>
                            </div>
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button onClick="mySubmit();" type="submit" name="submit" class="btn btn-primary">Add User</button>
                            </div>
							
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      
	  
<script>

          function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#blah').attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#imgInp").change(function(){
				readURL(this);
			});
			
			
   $(document).ready(function(){
	   
	        if($('#role').val() == 4){
				
				$("#org").show();
				$("#division").show();
			
				
			}
			else if($('#role').val() == 3)
			{

					$("#org").hide();
					$("#division").hide();
			} 
			else {
				
				$("#org").hide();
				$("#division").hide();
				
			}
	   
			$('#role').on('change', function() {
				
			  if (this.value == '1')
			  {
				  
				$("#org").hide();
				$("#division").hide();
				
			  } else if(this.value == '2'){
				  
				$("#org").show();
				$("#division").hide();
				
				
			  } else if(this.value == '3'){
				  
				$("#org").hide();
				$("#division").hide();
				 
				 
			  } else if(this.value == '4'){
				  
			    $("#org").show();
				$("#division").show();
				  
			  }  else {
				
				
				$("#org").hide();
				$("#division").hide();
				
				
			  }
			});
			
		
		$('#orgname').on('change', function(event){
			var org_id = $("#orgname").val();
			
			var option ='';
			var base_url = "<?php echo base_url(); ?>";
			var link = base_url+'users/all_divisions/';
		   
			$.ajax({
			method: "POST",
			url: link,
			data: {'id':org_id},
			success: function(result) {
			
			  var obj = JSON.parse(result);
			 option = '<option selected="selected" value="">Select Division</option>';
			 $.each(obj, function(i){
				 
			   option+='<option value="'+obj[i].DIVISION_ID+'">'+obj[i].DIVISIONNAME+'</option>';
				
			 });
			 
				$("#div_name").html(option);
				 event.preventDefault();

				}
				
			  });
			});
	
	});
		
</script>


<style>

.profile-img-wrap {
    height: 120px;
    position: relative;
    width: 135px;
    background: #fff;
    overflow: hidden;
    display: block;
    margin-bottom:20px;
	padding-left:15px;
}

</style>
  