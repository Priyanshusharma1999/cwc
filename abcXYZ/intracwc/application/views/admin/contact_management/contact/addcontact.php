 	
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
     					echo form_open_multipart('Contact/Contactdetail/add_contact/',$attributes);?>

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation<span class="required">*</span></label>
                                    <input class="form-control" name="organisation_name" type="text" placeholder="Organisation Name" maxlength="200" value = "<?php echo isset($insertData['organisation_name']) ? $insertData['organisation_name'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('organisation_name');?></span>
                                </div>
                            </div>

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Wing<span class="required">*</span></label>
                                    <input class="form-control" name="wing_name" type="text" placeholder="Wing Name" maxlength="200" value = "<?php echo isset($insertData['wing_name']) ? $insertData['wing_name'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('wing_name');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Post<span class="required">*</span></label>
                                    <input class="form-control" name="post_name" type="text" placeholder="Post Name" maxlength="200" value = "<?php echo isset($insertData['post_name']) ? $insertData['post_name'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('post_name');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Designation<span class="required">*</span></label>
                                    <input class="form-control" name="designation_name" type="text" placeholder="Designation Name" maxlength="200" value = "<?php echo isset($insertData['designation_name']) ? $insertData['designation_name'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('designation_name');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Reporting<span class="required"></span></label>
                                    <select id=""  name="reporting[]" class="form-control multiple_roles" multiple="multiple" data-placeholder="Select Reporting">
                                       
                                        <?php
                                            if(empty($all_contact_user))
                                            {
                                                echo '<option selected="selected" value="">Select Reporting</option>';
                                            }

                                            else
                                            {
                                                foreach ($all_contact_user as $contact_user)
                                              {   
                                                 echo '<option value="'.$contact_user->contact_detail_master_id.'">'.$contact_user->name.' | '.$contact_user->contact_organisation.' | '.$contact_user->contact_wing.' | '.$contact_user->contact_designation.'</option>';
                                              }
                                            }
                                          
                                        ?>
                                    </select>
                                </div>
                            </div>

						   <div class="col-sm-6">
								<div class="form-group">
									<label>Name<span class="required">*</span></label>
									<input class="form-control" name="user_name" type="text" placeholder="Name" maxlength="200" value = "<?php echo isset($insertData['user_name']) ? $insertData['user_name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('user_name');?></span>
								</div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile No.<span class="required">*</span></label>
                                    <input class="form-control" name="mobile_no" type="text" placeholder="Mobile No" maxlength="10" value = "<?php echo isset($insertData['mobile_no']) ? $insertData['mobile_no'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('mobile_no');?></span>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Office No.<span class="required">*</span></label>
                                    <input class="form-control" name="office_no" type="text" placeholder="Office No" maxlength="13" value = "<?php echo isset($insertData['office_no']) ? $insertData['office_no'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('office_no');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Residence No.<span class="required">*</span></label>
                                    <input class="form-control" name="res_no" type="text" placeholder="Residence No" maxlength="13" value = "<?php echo isset($insertData['res_no']) ? $insertData['res_no'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('res_no');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Floor<span class="required">*</span></label>
                                    <input class="form-control" name="room_no" type="text" placeholder="Room No" maxlength="13" value = "<?php echo isset($insertData['room_no']) ? $insertData['room_no'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('room_no');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Extension No.<span class="required">*</span></label>
                                    <input class="form-control" name="extension_no" type="text" placeholder="Extension No" maxlength="200" value = "<?php echo isset($insertData['extension_no']) ? $insertData['extension_no'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('extension_no');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax No.<span class="required">*</span></label>
                                    <input class="form-control" name="fax_no" type="text" placeholder="Fax No" maxlength="200" value = "<?php echo isset($insertData['fax_no']) ? $insertData['fax_no'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('fax_no');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Office Address<span class="required">*</span></label>
                                    <textarea class="form-control" name="office_address" type="text" placeholder="Office Address" maxlength="200"></textarea>
                                    <span class = "text-danger"><?php echo form_error('office_address');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>State<span class="required"></span></label>
                                    <select id = "statee" name = "state" class="form-control" >
                                    <option value="">Select State</option>
                                        <?php
                                            if(empty($states))
                                            {
                                                echo '';
                                            }

                                            else
                                            {
                                                foreach ($states as $stat)
                                              {   
                                                 echo '<option value="'.$stat->State_Code.'">'.$stat->StateName_In_English.'</option>';
                                              }
                                            }
                                          
                                        ?>
                                    </select>
                                </div>
                            </div>

                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>City<span class="required"></span></label>
                                    <select id = "cityy" name = "city" class="form-control" >
                                   <option value="">Select City</option>
                                 
                                </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Pincode<span class="required">*</span></label>
                                    <input class="form-control" name="pincode" type="text" placeholder="Pincode" maxlength="6" value = "<?php echo isset($insertData['pincode']) ? $insertData['pincode'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('pincode');?></span>
                                </div>
                            </div>

                            	
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Add Contact</button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

