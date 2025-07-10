   <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Contact</h6>
								<hr>
						
						<?php if($this->session->flashdata('flashError_contact')) { ?>
						<div class='alert alert-danger'> <?php echo $this->session->flashdata('flashError_contact');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>
								
							<?php
							$uri = $this->uri->segment('3'); 
					 	$attributes = array('class' => '', 'id' =>'edit_contact');
     					echo form_open_multipart('Contacts/edit_contact/'.$uri,$attributes);?> 
									 
								

									   <div class="col-sm-6">
											<div class="form-group">
												<label>Name<span class="required">*</span></label>
												<input class="form-control" type="text" placeholder="Name" name="name" value="<?php echo $contact_detail->FULLENAME; ?>">
												<span class = "text-danger"><?php echo form_error('name');?></span>
											</div>
										</div>
										
										 <div class="col-sm-6">
											<div class="form-group">
												<label>Designation<span class="required">*</span></label>
												<input class="form-control" type="text"  name="designation" placeholder="Designation" value="<?php echo $contact_detail->DESIGNATION; ?>">
												<span class = "text-danger"><?php echo form_error('designation');?></span>
											</div>
										</div>
										
										 <div class="col-sm-6">
											<div class="form-group">
												<label>Office Name<span class="required">*</span></label>
												<input class="form-control" type="text" name="office_name" placeholder="Office Name" value="<?php echo $contact_detail->OFFICENAME; ?>">
												<span class = "text-danger"><?php echo form_error('office_name');?></span>
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="form-group">
												<label>Email id<span class="required">*</span></label>
												<input class="form-control" type="email"  name="email" placeholder="Email id" value="<?php echo $contact_detail->EMAIL; ?>">
												<span class = "text-danger"><?php echo form_error('email');?></span>
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="form-group">
												<label>Office Address<span class="required">*</span></label>
												<input class="form-control" type="text" name="office_address"  placeholder="Office Address" value="<?php echo $contact_detail->OFFICE_ADDRESS; ?>">
												<span class = "text-danger"><?php echo form_error('office_address');?></span>
											</div>
										</div>
										
										<div class="col-sm-6">
											<div class="form-group">
												<label>Landline No.<span class="required">*</span></label>
												<input class="form-control" type="text" name="landline_no"  placeholder="Landline No." value="<?php echo $contact_detail->LANDLINE_NO; ?>" maxlength="12">
												<span class = "text-danger"><?php echo form_error('landline_no');?></span>
											</div>
										</div>
										
										
										<div class="col-sm-6">
											<div class="form-group">
												<label>Mobile No.<span class="required">*</span></label>
												<input class="form-control" type="text" maxlength="10" name="mobile_no"  placeholder="Mobile No." value="<?php echo $contact_detail->MOBILE; ?>">
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
											<option value="<?php echo $org_data->ORGANIZATION_ID ?>" selected><?php echo $org_data->ORGNAME ?></option>				   
										</select>
										<span class = "text-danger"><?php echo form_error('organization_name');?></span>
									  	</div>
									  </div>

									  	<?php } else {?>

								<div class="col-sm-6">
								<div class="form-group">
								<label>Organization Name<span class="required"></span></label>
								
								<select name="organization_name" class="form-control" id="organization" >
									<option value="" selected>Select Organization</option>
									 <?php foreach($all_org as $org){?>
									     <option value="<?php echo $org->ORGANIZATION_ID; ?>" <?php if($org->ORGANIZATION_ID == $contact_detail->ORGANIZATION_ID){ echo 'selected'; } ?>>
										   <?php echo $org->ORGNAME; ?>
										 </option>
									   <?php } ?>
								</select>
								
									<span class = "text-danger"><?php echo form_error('organization_name');?></span>
								</div>
                            </div>

                            <?php } ?>

								<div class="col-sm-6">
								<div class="form-group">
									<label>Division Name<span class="required"></span></label>
									
									<select class="form-control" name="division_name" id="division" >
									   <option value="">Select Division</option>
									   <?php foreach($all_divisions as $division){?>
									     <option value="<?php echo $division->DIVISION_ID; ?>" <?php if($division->DIVISION_ID == $contact_detail->DIVISION_ID){ echo 'selected'; } ?>>
										   <?php echo $division->DIVISIONNAME; ?>
										 </option>
									   <?php } ?>
									</select>
									
									<span class = "text-danger"><?php echo form_error('division_name');?></span>
								</div>
                            </div>
							
							
					
								
								
								<div class="m-t-20" style="padding-left:15px;clear:both;">
									<button type="submit" name="submit" class="btn btn-primary">Update Contact</button>
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
				var base_url = 'http://katiyarprint.com/pensionscheme/';
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
			});
	*/

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
  