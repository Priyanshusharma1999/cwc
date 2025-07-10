
	
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">User Registration</h6>
								<hr>
								<?php if($this->session->flashdata('flashError_user')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_user'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>
                                
						<?php
						 	$attributes = array('class' => '', 'id' =>'add_user');
	     					echo form_open_multipart('Administrator/User/add_user/',$attributes);?>
						
						   <div class="col-sm-6">
								<div class="form-group" style="min-height:62px;">
									<label>Role<span class="required">*</span><span class="help_icon" data-toggle="modal"  data-target="#deleteModal">?</span></label>
									<select id="user_role" class="form-control multiple_roles" multiple="multiple" name="user_role[]" data-placeholder="Select Role">
									    
										<?php
											if(empty($all_roles))
											{
												echo '<option value="">Select Role</option>';
											}

											else
											{
												foreach ($all_roles as $roles)
						                      {   
						                         echo '<option value="'.$roles->role_id.'">'.$roles->name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								</div>
                            </div>


                             <div class="col-sm-6">
								<div class="form-group" style="min-height:62px;">
									<label>User Access<span class="required"></span></label>
									<select id="user_access" class="form-control multiple_roles" multiple="multiple" name="user_access[]" data-placeholder="Select User Access">
										<option value="1">Non IT Online Stationery</option>
										<option value="2">IT Online Stationery</option>
									</select>
								</div>
                            </div>

                             <div class="col-sm-6">
								<div class="form-group">
									<label>Employee Name<span class="required">*</span></label>
									<select id="user_name" class="form-control" name="user_name" >
									    <option value="">Select Employee Name</option>
										<?php
											if(empty($all_employee))
											{
												echo '';
											}

											else
											{
												foreach ($all_employee as $employee)
						                      {   
						                      	$desigantion_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $employee->employee_designation));
                                    			$desigantion =  $desigantion_data->designation_name;	
						                         echo '<option value="'.$employee->employee_id.'">'.$employee->employee_name.' | '.$employee->employee_code.' | '.$desigantion.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								</div>
                            </div>
						
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Display Name<span class="required">*</span></label>
									<input class="form-control" type="text" name="display_name" placeholder="Display Name" value = "<?php echo isset($insertData['display_name']) ? $insertData['display_name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('display_name');?></span>
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Designation<span class="required">*</span></label>
									<input class="form-control" type="text" id="designation_id" name="designation_name" placeholder="Designation" value = "<?php echo isset($insertData['designation_name']) ? $insertData['designation_name'] : ''; ?>" readonly>
									<span class = "text-danger"><?php echo form_error('designation_name');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Contact(o)<span class="required">*</span></label>
									<input class="form-control" type="text" id="contact_no" maxlength="13"  name="contact_no" placeholder="Contact No." value = "<?php echo isset($insertData['contact_no']) ? $insertData['contact_no'] : ''; ?>" readonly>
									<span class = "text-danger"><?php echo form_error('contact_no');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Email<span class="required">*</span></label>
									<input class="form-control" type="email" id="email_id"  name="email"  placeholder="Email" value = "<?php echo isset($insertData['email']) ? $insertData['email'] : ''; ?>" readonly>
									<span class = "text-danger"><?php echo form_error('email');?></span>
								</div>
                            </div>

                            <div class="col-sm-6" id="wing_idd">
								<div class="form-group">
									<label>Wing<span class="required">*</span></label>
									<select id="wing_id1" class="form-control"  name="wing_name">
									   <option selected="selected" value="">Select Wing</option>
										<?php
											if(empty($all_wing))
											{
												echo '';
											}

											else
											{
												foreach ($all_wing as $wing)
						                      {   
						                         echo '<option value="'.$wing->wing_id.'">'.$wing->wing_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								</div>
                            </div>

                            <div class="col-sm-6" id="section_idd">
								<div class="form-group">
									<label>Section<span class="required">*</span></label>

									<select id="section_id1" class="form-control"  name="section_name">
										<option selected="selected" value="">Select Section</option>
									
									</select>
								</div>
                            </div>

                            <div class="col-sm-6" id="building_idd">
								<div class="form-group">
									<label>Building<span class="required">*</span></label>
									<select id="building_id" class="form-control" readonly name="building_name">
									   <option selected="selected" value="">Select Building</option>
										
									</select>
								</div>
                            </div>

                            <div class="col-sm-6" id="room_idd">
								<div class="form-group">
									<label>Floor<span class="required">*</span></label>
									<select id="room_id" class="form-control" readonly name="room_id">
									   <option selected="selected" value="">Select Floor</option>
										
									</select>
								</div>
                            </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>User Photo</label>
									<input type="file" name="user_image">
								</div>
                            </div>

                            <div class="col-sm-12">
								<div class="form-group">
									<label>Month For User Requisition</label>
									<div class="checkbox">
                                            <label>
                                                <input type="checkbox" name="reqmonth[]" value="January"> January
                                            </label>
                                            <label>
                                                <input type="checkbox" name="reqmonth[]" value="February"> February
                                            </label>
                                            <label>
                                                <input type="checkbox" name="reqmonth[]" value="March"> March
                                            </label>
                                            <label>
                                                <input type="checkbox" name="reqmonth[]" value="April"> April
                                            </label>
                                            <label>
                                                <input type="checkbox" name="reqmonth[]" value="May"> May
                                            </label>
                                            <label>
                                                <input type="checkbox" name="reqmonth[]" value="June"> June
                                            </label>
                                            <label>
                                                <input type="checkbox" name="reqmonth[]" value="July"> July
                                            </label>
                                            <label>
                                                <input type="checkbox" name="reqmonth[]" value="August"> August
                                            </label>
                                            <label>
                                                <input type="checkbox" name="reqmonth[]" value="September"> September
                                            </label>
                                            <label>
                                                <input type="checkbox" name="reqmonth[]" value="October"> October
                                            </label>
                                            <label>
                                                <input type="checkbox" name="reqmonth[]" value="November"> November
                                            </label>
                                            <label>
                                                <input type="checkbox" name="reqmonth[]" value="December"> December
                                            </label>
                                     </div>
								</div>
                            </div>
							
							<h6 class="card-title text-bold" style="float: left;width: 100%;padding-left: 15px;border-bottom: 1px solid #ddd;padding-bottom: 15px;">Create User Id and Password</h6>
					   
							<div class="col-sm-6">
								<div class="form-group">
									<label>User Id<span class="required">*</span></label>
									<input class="form-control" name="user_id" id="userrid" type="text" value = "<?php echo isset($insertData['user_id']) ? $insertData['user_id'] : ''; ?>" placeholder="User Id">
									<span class = "text-danger"><?php echo form_error('user_id');?></span>
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
									<input class="form-control" type="password" id="pwd2" name="cnfrm_password" placeholder="Confirm Password" maxlength="70">
									<span class = "text-danger"><?php echo form_error('cnfrm_password');?></span>
									<span id="span_password_msg2" style="color:red">Please enter password in format consits of one upper case,one lower case,one digit, one special character.</span>
								</div>
                            </div>

                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button onClick="mySubmit();" class="btn btn-primary" type="submit" name="submit">Add User</button>
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
        </style>



