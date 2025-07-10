 
	
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
					 	$attributes = array('class' => '', 'id' =>'add_user');
     					echo form_open_multipart('Administrator/User/edit_user/'.$user_data->user_id,$attributes);?>
						

                           <div class="col-sm-6">
								<div class="form-group" style="width: 100%;min-height: 90px;margin-bottom: 0;">
									 <?php

                                        if(empty($user_data->image))
                                        {
                                            $user_pic =  base_url().'assets/img/user.jpg';
                                        }

                                        else
                                        {
                                            $user_pic = base_url().'uploads/users/'.$user_data->image;
                                        }
                                    ?>
								<div class="profile-img-wrap">
                                    <img class="inline-block" src="<?php echo $user_pic; ?>" alt="user">
                                    <div class="fileupload btn btn-default">
                                        <span class="btn-text">Edit</span>
                                        <input class="upload" type="file" name="usser_image">
                                    </div>
                                </div>
                            </div>
                            </div>

						   <div class="col-sm-6">
								<div class="form-group">
									<label>Role<span class="required">*</span><span class="help_icon" data-toggle="modal"  data-target="#deleteModal">?</span></label>
									<select  class="form-control multiple_roles" multiple="multiple" name="user_role[]" data-placeholder="Select Role">
									   <?php
						                        $all_data7=array();
						                        foreach ($role_selected as $row7) {
						                            $all_data7[]=$row7->role_id;
						                        }
						                     foreach ($all_roles as $roles){
						                            
						                    ?>
						                    <option value="<?php echo $roles->role_id; ?>"
						                <?php echo (isset($role_selected) && in_array($roles->role_id,$all_data7) ) ? "selected" : "" ?>  ><?php echo $roles->name; ?></option>
						            <?php }?> 
									</select>
								</div>
                            </div>


                             <div class="col-sm-6">
								<div class="form-group">
									<label>User Access<span class="required"></span></label>
									<select  class="form-control multiple_roles" multiple="multiple" name="user_access[]" data-placeholder="Select User Access">
									   <?php
						                        $all_data=array();

						                        foreach ($access_selected as $row8) {
						                            $all_data[]=$row8->service_type;
						                        }

						                    foreach ($all_access as $access){
						                    ?>
						                    <option value="<?php echo $access->access_value; ?>"
						                <?php echo (isset($access_selected) && in_array($access->access_value,$all_data) ) ? "selected" : "" ?>  ><?php echo $access->access_name; ?></option>
						            <?php }?> 
									</select>
								</div>
                            </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Name<span class="required">*</span></label>
									<select id="user_name" class="form-control" name="user_name" >
									    <option value="">Select User Name</option>
										  <?php
				                        	$all_data1[] = $user_data->employee_id;
					                    	foreach ($all_employee as $rows1 ) {  ?>
					                        <option value="<?php echo $rows1->employee_id; ?>"
					                    	<?php 
					                    		$desigantion_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $rows1->employee_designation));
                                    			$desigantion =  $desigantion_data->designation_name;
					                    		echo (isset($user_data->employee_id) && in_array($rows1->employee_id,$all_data1) ) ? "selected" : "" ?> ><?php echo $rows1->employee_name.' | '.$rows1->employee_code.' | '.$desigantion; ?>
					                    	</option>
				                      	  <?php } ?>
									</select>
								</div>
                            </div>
						
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Display Name<span class="required">*</span></label>
									<input class="form-control" name="display_name" type="text" placeholder="Display Name" value="<?php echo $user_data->display_name; ?>">
								</div>
                            </div>
                            
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Designation<span class="required">*</span></label>
									<input class="form-control" type="text" name="designation_name" id="designation_id" placeholder="Designation" value="<?php echo $user_data->designation; ?>" readonly>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Contact(o)<span class="required">*</span></label>
									<input class="form-control" type="text" maxlength="13" name="contact_no" id="contact_no" placeholder="Contact No." value="<?php echo $user_data->contact_no; ?>" readonly>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email<span class="required">*</span></label>
									<input class="form-control" type="email" id="email_id" name="email" placeholder="Email" value="<?php echo $user_data->email; ?>" readonly>
								</div>
                            </div>

                            <div class="col-sm-6" id="wing_idd2">
								<div class="form-group">
									<label>Wing<span class="required">*</span></label>
									<select id="wing_id1" class="form-control"  name="wing_name">
									   <option value="">Select Wing</option>
										 <?php
				                        	$all_data2[] = $user_data->wing_id;
					                    	foreach ($all_wing as $rows2 ) {  ?>
					                        <option value="<?php echo $rows2->wing_id; ?>"
					                    	<?php 
					                    		echo (isset($user_data->wing_id) && in_array($rows2->wing_id,$all_data2) ) ? "selected" : "" ?> ><?php echo $rows2->wing_name; ?>
					                    	</option>
				                      	  <?php } ?>
									</select>
								</div>
                            </div>

                            <div class="col-sm-6" id="section_idd2">
								<div class="form-group">
									<label>Section<span class="required">*</span></label>

									<select id="section_id1" class="form-control"  name="section_name">
										<option selected="selected" value="">Select Section</option>
									    <?php
				                        	$all_data3[] = $user_data->section_id;
					                    	foreach ($all_section as $rows3 ) {  ?>
					                        <option value="<?php echo $rows3->section_id; ?>"
					                    	<?php 
					                    		echo (isset($user_data->section_id) && in_array($rows3->section_id,$all_data3) ) ? "selected" : "" ?> ><?php echo $rows3->section_name; ?>
					                    	</option>
				                      	  <?php } ?>
									</select>
								</div>
                            </div>

                            <div class="col-sm-6" id="building_idd2">
								<div class="form-group">
									<label>Building<span class="required">*</span></label>
									<select id="building_id" class="form-control" readonly name="building_name">
									   <option selected="selected" value="">Select Building</option>
										<?php
				                        	$all_data4[] = $user_data->building_id;
					                    	foreach ($all_building as $rows4 ) {  ?>
					                        <option value="<?php echo $rows4->building_id; ?>"
					                    	<?php 
					                    		echo (isset($user_data->building_id) && in_array($rows4->building_id,$all_data4) ) ? "selected" : "" ?> ><?php echo $rows4->building_name; ?>
					                    	</option>
				                      	  <?php } ?>
									</select>
								</div>
                            </div>

                            <div class="col-sm-6" id="room_idd2">
								<div class="form-group">
									<label>Floor<span class="required">*</span></label>
									<select id="room_id" class="form-control" readonly name="room_id">
									   <option selected="selected" value="">Select Floor</option>
										<?php
				                        	$all_data5[] = $user_data->room_id;
					                    	foreach ($all_room as $rows5 ) {  ?>
					                        <option value="<?php echo $rows5->room_id; ?>"
					                    	<?php 
					                    		echo (isset($user_data->room_id) && in_array($rows5->room_id,$all_data5) ) ? "selected" : "" ?> ><?php echo $rows5->room_name; ?>
					                    	</option>
				                      	  <?php } ?>
									</select>
								</div>
                            </div>

                             <div class="col-sm-6">
								<div class="form-group">
									<label>Status<span class="required">*</span></label>
									<select required="required" name = "status" class="form-control">
									   <option selected="selected" value="1" <?php if($user_data->status == '1') echo 'selected="selected"' ?>>Active</option>
									   <option  value="0" <?php if($user_data->status == '0') echo 'selected="selected"' ?>>Deactive</option>
									</select>
								</div>
                            </div>

                           <div class="col-sm-12">
								<div class="form-group">
									<?php
                                        $months = array();
										foreach($month_req_data as $mreq){
											$months[] = $mreq->month_code;
										} 

								   ?>

									<label>Month For User Requisition</label>
									<div class="checkbox">
                                        <label>
                                           <input type="checkbox" name="reqmonth[]" value="January" <?php if(in_array("January",$months)){ echo 'checked'; }?> > January
                                        </label>
                                        <label>
                                            <input type="checkbox" name="reqmonth[]" value="February" <?php if(in_array('February',$months)){ echo 'checked'; }?> > February
                                        </label>
                                        <label>
                                            <input type="checkbox" name="reqmonth[]" value="March" <?php if(in_array('March',$months)){ echo 'checked'; }?> > March
                                        </label>
                                        <label>
                                            <input type="checkbox" name="reqmonth[]" value="April" <?php if(in_array('April',$months)){ echo 'checked'; }?> > April
                                        </label>
                                        <label>
                                            <input type="checkbox" name="reqmonth[]" value="May" <?php if(in_array('May',$months)){ echo 'checked'; }?> > May
                                        </label>
                                        <label>
                                            <input type="checkbox" name="reqmonth[]" value="June" <?php if(in_array('June',$months)){ echo 'checked'; }?> > June
                                        </label>
                                        <label>
                                            <input type="checkbox" name="reqmonth[]" value="July" <?php if(in_array('July',$months)){ echo 'checked'; }?> > July
                                        </label>
                                        <label>
                                            <input type="checkbox" name="reqmonth[]" value="August" <?php if(in_array('August',$months)){ echo 'checked'; }?> > August
                                        </label>
                                        <label>
                                            <input type="checkbox" name="reqmonth[]" value="September" <?php if(in_array('September',$months)){ echo 'checked'; }?> > September
                                        </label>
                                        <label>
                                            <input type="checkbox" name="reqmonth[]" value="October" <?php if(in_array('October',$months)){ echo 'checked'; }?> > October
                                        </label>
                                        <label>
                                            <input type="checkbox" name="reqmonth[]" value="November" <?php if(in_array('November',$months)){ echo 'checked'; }?> > November
                                        </label>
                                        <label>
                                            <input type="checkbox" name="reqmonth[]" value="December" <?php if(in_array('December',$months)){ echo 'checked'; }?> > December
                                        </label>
                                     </div>
								</div>
                            </div>
							

							
						<h6 class="card-title text-bold" style="float: left;width: 100%;padding-left: 15px;border-bottom: 1px solid #ddd;padding-bottom: 15px;">Create User Id and Password</h6>
					   

                      

							<div class="col-sm-6">
								<div class="form-group">
									<label>User Id<span class="required">*</span></label>
									<input class="form-control" name="user_id" type="text" value="<?php echo $user_data->login_id; ?>" placeholder="User Id">
								</div>
                            </div>



                           <div class="col-sm-6">
                             <div class="form-group">
                                <label>New Password<span class="required"></span></label>
                                <input class="form-control" id="pwd" name = "passwordd" type="password" maxlength = "100" placeholder="New Password" value = "" maxlength = "100">
                                <span class = "text-danger"><?php echo form_error('password2');?></span>
                                <span id="span_password_msg" style="color:red">Please enter password in format consits of one upper case,one lower case,one digit, one special character.</span>
                            </div>
                          </div>

                           <div class="col-sm-6">
                             <div class="form-group">
                                <label>Confirm Password<span class="required"></span></label>
                                <input class="form-control" id="pwd2" name = "cnfrm_passwordd" type="password" maxlength = "100" placeholder="Confirm Password" value = "" maxlength = "100">
                                <span class = "text-danger"><?php echo form_error('cnfrm_passworrd');?></span>
                                <span id="span_password_msg2" style="color:red">Please enter password in format consits of one upper case,one lower case,one digit, one special character.</span>
                            </div>
                          </div>
						
						
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button onclick="mySubmit_profile();" class="btn btn-primary" type="submit" name="submit">Update User</button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <!--  Popup modal -->			
					<div class="example-modal">
						<div class="modal fade" aria-hidden="true" id="deleteModal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Role Description</h4>
									</div>
									<div class="modal-body">
										       <table class="display datat22able table table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Role</th>
											<th>Description</th>
												
                                        </tr>
                                    </thead>
                                    <tbody>
									  <?php
											if($all_roles) {
												$i=1;
												foreach($all_roles as $rol) { ?>	
                                       <tr>
                                            <td><?php echo $i;?></td>
											<td><?php echo $rol->name;?></td>
                                            <td><?php echo $rol->description;?>e</td>	
                                       </tr>
                                        <?php $i++;} } else { ?>
										<tr><td>No data found</td></tr>
										<?php } ?>
											
                                    </tbody>
                                </table>
									</div>
									<div class="modal-footer">
										
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div><!-- /.example-modal -->
				<!-- ./ Popup modal -->
        <style type="text/css">
        	.help_icon {
		    color:#fff;
		    background-color:#feb22a;
		    width:12px;
		    height:12px;
		    display:inline-block;
		    border-radius:100%;
		    font-size:10px;
		    text-align:center;
		    text-decoration:none;
		    -webkit-box-shadow: inset -1px -1px 1px 0px rgba(0,0,0,0.25);
		    -moz-box-shadow: inset -1px -1px 1px 0px rgba(0,0,0,0.25);
		    box-shadow: inset -1px -1px 1px 0px rgba(0,0,0,0.25);
			}

			.checkbox label{
				       font-size: 15px;
					    width: 18%;
					    margin: 6px 0;
			}

			.checkbox input{
				    width: 16px;
                    height: 16px;
			}

			.select2-container{max-width:500px!important;}

        </style>
