   
	 <div class="page-wrapper">
			<div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Contact</h6>
								<hr>
					
						<?php if($this->session->flashdata('flashError_contact')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_contact'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
                                
						<?php
					 	$attributes = array('class' => '', 'id' =>'add_contact');
     					echo form_open_multipart('Contacts/addcontacts/',$attributes);?> 

     					 <!--    <div class="col-sm-6">
								<div class="form-group">
									<label>User Role<span class="required">*</span></label>
									<select  class="form-control" name="role" id="role">
									   <option selected="selected" value="">Select Role</option>
									    <option value="1" <?php //if($insertData['role'] == 1){ echo 'selected';} ?>>Super Admin</option>
										<option value="2" <?php //if($insertData['role'] == 2){ echo 'selected';} ?>>Organization Admin</option>
										<option value="3" <?php //if($insertData['role'] == 3){ echo 'selected';} ?>>PAO Admin</option>
										<option value="4" <?php //if($insertData['role'] == 4){ echo 'selected';} ?>>Division Admin</option>
										<option value="5" <?php //if($insertData['role'] == 5){ echo 'selected';} ?>>Establishment Data Entry</option>
									</select>
									<span class = "text-danger"><?php //echo form_error('role');?></span>
								</div>
                            </div> -->
                            
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Name<span class="required">*</span></label>
									<input class="form-control" type="text" name="name" placeholder="Name" value="<?php echo isset($insertData['name']) ? $insertData['name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('name');?></span>
								</div>
                            </div>
							
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Designation<span class="required">*</span></label>
									<input class="form-control" type="text" name="designation" value="<?php echo isset($insertData['designation']) ? $insertData['designation'] : ''; ?>" placeholder="Designation">
									<span class = "text-danger"><?php echo form_error('designation');?></span>
								</div>
                            </div>
							
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Office Name<span class="required">*</span></label>
									<input class="form-control" type="text" name="office_name" value="<?php echo isset($insertData['office_name']) ? $insertData['office_name'] : ''; ?>" placeholder="Office Name">
									<span class = "text-danger"><?php echo form_error('office_name');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email id<span class="required">*</span></label>
									<input class="form-control" type="email" name="email" value="<?php echo isset($insertData['email']) ? $insertData['email'] : ''; ?>" placeholder="Email id">
									<span class = "text-danger"><?php echo form_error('email');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Office Address<span class="required">*</span></label>
									<input class="form-control" type="text" name="office_address" value="<?php echo isset($insertData['office_address']) ? $insertData['office_address'] : ''; ?>" placeholder="Office Address">
									<span class = "text-danger"><?php echo form_error('office_address');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline No.<span class="required">*</span></label>
									<input class="form-control" type="text" maxlength="12" value="<?php echo isset($insertData['landline_no']) ? $insertData['landline_no'] : ''; ?>" name="landline_no" placeholder="Landline No.">
									<span class = "text-danger"><?php echo form_error('landline_no');?></span>
								</div>
                            </div>
							
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile No.<span class="required">*</span></label>
									<input class="form-control" type="text" maxlength="10" value="<?php echo isset($insertData['mobile_no']) ? $insertData['mobile_no'] : ''; ?>" name="mobile_no" placeholder="Mobile No.">
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
                            </div>
							
								<?php
							   	if($this->session->userdata('user_role')== 2)
							   		{ 
							   			$user_data = $this->Base_model->get_record_by_id('users', array('USERS_ID' => $this->session->userdata('applicant_user_id')));

							   			$org_data = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' =>$user_data->ORGANIZATION_ID));
							   			?>
									    <div class="col-sm-6">
										<div class="form-group">
										<label>Organization Name<span class="required"></span></label>
										<select name="organization_name" class="form-control" id="organization" >
											<option value="" selected>Select</option>		
											<option value="<?php echo $org_data->ORGANIZATION_ID ?>"><?php echo $org_data->ORGNAME ?></option>				   
										</select>
										<span class = "text-danger"><?php echo form_error('organization_name');?></span>
									  	</div>
									  </div>

									  	<?php } else {?>
							<div class="col-sm-6">
								<div class="form-group">
								<label>Organization Name<span class="required"></span></label>
								
								<select name="organization_name" class="form-control" id="organization" >
									<option value="" >Select Organization</option>
									
									 <?php foreach($all_org as $org){?>
									     <option value="<?php echo $org->ORGANIZATION_ID; ?>" <?php if($insertData['organization_name'] == $org->ORGANIZATION_ID){ echo 'selected';} ?> >
										   <?php echo $org->ORGNAME; ?>
										 </option>
									   <?php } ?>
									
									
								</select>
								
									<span class = "text-danger"><?php echo form_error('organization_name');?></span>
								</div>
                            </div>
                            <?php }?>

							<div class="col-sm-6">
								<div class="form-group">
									<label>Division Name<span class="required"></span></label>
									
									<select class="form-control" name="division_name" id="division">
									   <option value="" selected>Select Division</option>
									   
									</select>
									
									<span class = "text-danger"><?php echo form_error('division_name');?></span>
								</div>
                            </div>
							
							
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button type="submit" name="submit" class="btn btn-primary">Add Contact</button>
                            </div>
							
                       <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
		
	<script>	
		
		/*$('#division').on('change', function(event){
        var division_id = $("#division").val();
		
        var option ='';
        var base_url = "<?php //echo base_url(); ?>";
        var link = base_url+'Contacts/all_organizations/';
       
        $.ajax({
        method: "POST",
        url: link,
        data: {'id':division_id},
        success: function(result) {
			
        console.log(typeof(result));
      
           var obj = JSON.parse(result);
		
		   option+='<option value="'+obj.ORGANIZATION_ID+'" selected>'+obj.ORGNAME+'</option>';
            
			$("#organization").html(option);
			 event.preventDefault();

        }
        
    });
    });*/


    	$('#organization').on('change', function(event){
        var org_id = $("#organization").val();
		
        var option ='';
        var base_url = "<?php echo base_url(); ?>";
        var link = base_url+'Contacts/all_divisionss/';
       
        $.ajax({
        method: "POST",
        url: link,
        data: {'id':org_id},
        success: function(result) {
			
        console.log(typeof(result));
      
           var obj = JSON.parse(result);
		 option = '<option selected="selected" value="">Select Division</option>';
		   $.each(obj, function(){

                    option+='<option value="'+this["DIVISION_ID"]+'">'+this["DIVISIONNAME"]+'</option>';
                });
            
			$("#division").html(option);
			 event.preventDefault();

        }
        
    });
    });
	
	</script>
  