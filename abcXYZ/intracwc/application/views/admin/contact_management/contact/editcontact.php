    
     <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Contact</h6>
                                <hr>
                        <?php if($this->session->flashdata('flashError_contact')) { ?>
                        <div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_contact'); ?> 
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
                        <?php } ?>
                                
                        <?php
                        $attributes = array('class' => '', 'id' =>'add_contact');
                        echo form_open_multipart('Contact/Contactdetail/edit_contact/'.$contact_user_data->contact_detail_master_id,$attributes);?>

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Wing<span class="required">*</span></label>
                                    <input class="form-control" name="wing_name" type="text" placeholder="Wing Name" maxlength="200" value = "<?php echo $contact_user_data->contact_wing;?>">
                                    <span class = "text-danger"><?php echo form_error('wing_name');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation<span class="required">*</span></label>
                                    <input class="form-control" name="organisation_name" type="text" placeholder="Organisation Name" maxlength="200" value = "<?php echo $contact_user_data->contact_organisation;?>">
                                    <span class = "text-danger"><?php echo form_error('organisation_name');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Post<span class="required">*</span></label>
                                    <input class="form-control" name="post_name" type="text" placeholder="Post Name" maxlength="200" value = "<?php echo $contact_user_data->contact_post;?>">
                                    <span class = "text-danger"><?php echo form_error('post_name');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Designation<span class="required">*</span></label>
                                    <input class="form-control" name="designation_name" type="text" placeholder="Designation Name" maxlength="200" value = "<?php echo $contact_user_data->contact_designation;?>">
                                    <span class = "text-danger"><?php echo form_error('designation_name');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Reporting<span class="required"></span></label>
                                    <select id="" name="reporting[]" class="form-control multiple_roles" multiple="multiple" data-placeholder="Select Reporting">
                                     
                                        <?php
                                         $parent_id = $this->Base_model->get_all_record_by_condition('contact_relation', array('contact_child_id'=>$contact_user_data->contact_detail_master_id));

                                           
                                                $all_data7=array();
                                                foreach ($parent_id as $row7) 
                                                {
                                                    $all_data7[]=$row7->contact_parent_id;
                                                }
                                             foreach ($all_contact_user as $rows1){
                                                    
                                            ?>
                                            <option value="<?php echo $rows1->contact_detail_master_id; ?>"
                                        <?php echo (isset($parent_id) && in_array($rows1->contact_detail_master_id,$all_data7) ) ? "selected" : "" ?>  ><?php echo $rows1->name.' | '.$rows1->contact_organisation.' | '.$rows1->contact_wing.$rows1->contact_designation; ?></option>
                                    <?php }

                                              
                                            //} ?>
                                            
                                          
                                       
                                    </select>
                                </div>
                            </div>

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name<span class="required">*</span></label>
                                    <input class="form-control" name="user_name" type="text" placeholder="Name" maxlength="200" value = "<?php echo $contact_user_data->name;?>">
                                    <span class = "text-danger"><?php echo form_error('user_name');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile No.<span class="required">*</span></label>
                                    <input class="form-control" name="mobile_no" type="text" placeholder="Mobile No" maxlength="10" value = "<?php echo $contact_user_data->mobile_no;?>">
                                    <span class = "text-danger"><?php echo form_error('mobile_no');?></span>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Office No.<span class="required">*</span></label>
                                    <input class="form-control" name="office_no" type="text" placeholder="Office No" maxlength="13" value = "<?php echo $contact_user_data->office_no;?>">
                                    <span class = "text-danger"><?php echo form_error('office_no');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Residence No.<span class="required">*</span></label>
                                    <input class="form-control" name="res_no" type="text" placeholder="Residence No" maxlength="13" value = "<?php echo $contact_user_data->res_no;?>">
                                    <span class = "text-danger"><?php echo form_error('res_no');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Floor<span class="required">*</span></label>
                                    <input class="form-control" name="room_no" type="text" placeholder="Room No" maxlength="13" value = "<?php echo $contact_user_data->room_no;?>">
                                    <span class = "text-danger"><?php echo form_error('room_no');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Extension No.<span class="required">*</span></label>
                                    <input class="form-control" name="extension_no" type="text" placeholder="Extension No" maxlength="200" value = "<?php echo $contact_user_data->extension_no;?>">
                                    <span class = "text-danger"><?php echo form_error('extension_no');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax No.<span class="required">*</span></label>
                                    <input class="form-control" name="fax_no" type="text" placeholder="Fax No" maxlength="200" value = "<?php echo $contact_user_data->fax_no;?>">
                                    <span class = "text-danger"><?php echo form_error('fax_no');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Office Address<span class="required">*</span></label>
                                    <textarea class="form-control" name="office_address" type="text" placeholder="Office Address" maxlength="200"><?php echo $contact_user_data->office_address;?></textarea>
                                    <span class = "text-danger"><?php echo form_error('office_address');?></span>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>State<span class="required"></span></label>
                                    <select id = "statee" name = "state" class="form-control" >
                                    <option value="">Select State</option>
                                       <?php
									  	$all_data4[] = $contact_user_data->state;

										foreach ($states as $rows4 ) {  ?>
									    <option value="<?php echo $rows4->State_Code; ?>"
										<?php 
											echo (isset($contact_user_data->state) && in_array($rows4->State_Code,$all_data4) ) ? "selected" : "" ?> ><?php echo $rows4->StateName_In_English; ?>
										</option>
										<?php } ?>
                                    </select>
                                </div>
                            </div>

                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>City<span class="required"></span></label>
                                    <select id = "cityy" name = "city" class="form-control" >
                                   <option value="">Select City</option>
                                 	<?php
								  	$all_data3[] = $contact_user_data->city;

									foreach ($city as $rows3 ) {  ?>
								    <option value="<?php echo $rows3->District_Name_In_English; ?>"
									<?php 
										echo (isset($contact_user_data->city) && in_array($rows3->District_Name_In_English,$all_data3) ) ? "selected" : "" ?> ><?php echo $rows3->District_Name_In_English; ?>
									</option>
									<?php } ?>
                                </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Pincode<span class="required">*</span></label>
                                    <input class="form-control" name="pincode" type="text" placeholder="Pincode" maxlength="6" value = "<?php echo $contact_user_data->pincode;?>">
                                    <span class = "text-danger"><?php echo form_error('pincode');?></span>
                                </div>
                            </div>

                                
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Update Contact</button>
                            </div>
                        <?php echo form_close();?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

