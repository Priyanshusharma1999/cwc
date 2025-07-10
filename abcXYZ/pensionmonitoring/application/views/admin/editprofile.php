   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Profile</h6>
								<hr>
                 
						<?php if($this->session->flashdata('flashError_profileedit')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_profileedit'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
						<?php } ?>
                                
						<?php
						
						$uri = $this->uri->segment('3'); 
					 	$attributes = array('class' => '', 'id' =>'edit_users');
     					echo form_open_multipart('admin/edit_profile/'.$uri,$attributes);?>
						
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
									<span class="btn-text">Edit image</span>
									<input class="upload" name="applicant_pic"  type="file" accept=".png, .jpg, .jpeg" id="imgInp">
								</div>
							</div>
						
						    <div class="col-sm-6">
								<div class="form-group">
									<label>User Role<span class="required">*</span></label>
								<select  class="form-control" name="role" id="role" readonly style="pointer-events: none;">
									<option value="">Select Role</option>
									<?php foreach($all_roles as $roles){?>
									    <option value="<?php echo $roles->ROLE_ID; ?>" <?php if($roles->ROLE_ID==$user_detail->ROLE_ID){ echo 'selected'; }?> >
										  <?php echo $roles->ROLE; ?>
										</option>
									<?php } ?>
									</select>
								</div>
                            </div>
						
						    <div class="col-sm-6">
								<div class="form-group">
									<label>Full Name<span class="required">*</span></label>
									<input class="form-control" type="text" name="full_name" value="<?php echo $user_detail->FULLNAME; ?>" placeholder="Full Name">
									<span class = "text-danger"><?php echo form_error('full_name');?></span>
								</div>
                            </div>
						
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No.<span class="required">*</span></label>
									<input class="form-control" type="text" maxlength="10" name="mobile_no" value="<?php echo $user_detail->MOBILE; ?>" placeholder="Mobile No.">
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email<span class="required">*</span></label>
									<input class="form-control" type="email" name="email" value="<?php echo $user_detail->EMAIL; ?>" placeholder="Email">
									<span class = "text-danger"><?php echo form_error('email');?></span>
								</div>
                            </div>
							
						
							
							<?php if($user_detail->ORGANIZATION_ID != 0){?>
							
							<div class="col-sm-6" id="org" >
								<div class="form-group">
									<label>Organization Name<span class="required"></span></label>
									<select class="form-control" name="organization_name" id="orgname" readonly style="pointer-events: none;">
									   <option  value="">Select Organisation</option>
										 <?php foreach($org_data as $organization){?>
									    <option value="<?php echo $organization->ORGANIZATION_ID; ?>" <?php if($organization->ORGANIZATION_ID==$user_detail->ORGANIZATION_ID){ echo 'selected'; }?>>
										  <?php echo $organization->ORGNAME; ?>
										</option>
									<?php } ?>
									</select>
								</div>
                            </div>
							
							<?php } ?>
							
							<?php if($user_detail->DIVISION_ID !=0){?>
								
							<div class="col-sm-6" id="division">
								<div class="form-group">
								
									<label>Division Name<span class="required"></span></label>
									<select  class="form-control" name="division_name" id="div_name" readonly style="pointer-events: none;">
									   <option value="">Select Division</option>
									   
									   <?php foreach($division_data as $division){?>
									    <option value="<?php echo $division->DIVISION_ID; ?>" <?php if($division->DIVISION_ID==$user_detail->DIVISION_ID){ echo 'selected'; }?>>
										  <?php echo $division->DIVISIONNAME; ?>
										</option>
									<?php } ?>
									  
									</select>
								</div>
                            </div>
							<?php } ?>
							
							<h6 class="card-title text-bold" style="float: left;width: 100%;margin-top: 20px;border-bottom: 1px solid #ddd;padding-bottom: 15px;">Create User Name and Password</h6>
					   
							<div class="col-sm-6">
								<div class="form-group">
									<label>User Name<span class="required">*</span></label>
									<input class="form-control" type="text" name="user_name" value="<?php echo $user_detail->LOGONID; ?>" placeholder="User Name" readonly>
									<span class = "text-danger"><?php echo form_error('user_name');?></span>
								</div>
                            </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Old Password<span class="required"></span></label>
									<input class="form-control" type="password" id="old_pwd" name="old_password"  placeholder="Old Password" >
									<span class = "text-danger"><?php echo form_error('old_password');?></span>
									
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Create New Password<span class="required"></span></label>
									<input class="form-control" id="pwd" type="password" name="password"  placeholder="Password" >
									<span class = "text-danger"><?php echo form_error('password');?></span>
									<span id="span_password_msg" style="color:red">Please enter password in format consits of one upper case,one lower case,one digit, one special character.</span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Confirm New Password<span class="required"></span></label>
									<input class="form-control" id="pwd2" type="password" name="con_password" placeholder="Confirm Password" >
									<span class = "text-danger"><?php echo form_error('con_password');?></span>
									<span id="span_password_msg2" style="color:red">Please enter password in format consits of one upper case,one lower case,one digit, one special character.</span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>User Status<span class="required">*</span></label>
									<select  class="form-control" name="status">
									    <option value="1" selected="selected">Active</option>
										<option value="0">Deactive</option>
									</select>
									<span class="text-danger"><?php echo form_error('status');?></span>
								</div>
                            </div>
							
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button onClick="mySubmit_profile();" type="submit" name="submit"  class="btn btn-primary">Update User</button>
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
			$('#role').on('change', function() {
				
			  if (this.value == '1')
			  {
				  
				$("#org").hide();
				$("#division").hide();
				
			  } else if(this.value == '2'){
				  
				$("#org").show();
				$("#division").hide();
				
				
			  } else if(this.value == '3'){
				  
				$("#org").show();
				$("#division").show();
				 
				 
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
			var base_url = '<?php echo base_url(); ?>';
			var link = base_url+'users/all_divisions/';
		   
			$.ajax({
			method: "POST",
			url: link,
			data: {'id':org_id},
			success: function(result) {
			
			  var obj = JSON.parse(result);
			 
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
  