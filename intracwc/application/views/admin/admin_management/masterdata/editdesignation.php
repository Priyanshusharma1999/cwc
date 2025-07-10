  
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Designation</h6>
								<hr>
                                
						<?php if($this->session->flashdata('flashError_designation')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_designation'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
						        
						<?php
					 	$attributes = array('class' => '', 'id' =>'add_designation');
     					echo form_open_multipart('Administrator/Designation/edit_designation/'.$designation_data->designation_id,$attributes);?>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Designation Name<span class="required">*</span></label>
									<input class="form-control" name ="designation_name" type="text" placeholder="Designation Name" value="<?php echo $designation_data->designation_name; ?>"/>
									<span class = "text-danger"><?php echo form_error('designation_name');?></span>
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Designation  Short Name<span class="required">*</span></label>
									<input class="form-control" name="designation_short_name" type="text" placeholder="Designation  Short Name" value = "<?php echo $designation_data->designation_short_name; ?>"/>
									<span class = "text-danger"><?php echo form_error('designation_short_name');?></span>
								</div>
                            </div>
							
							 <div class="col-sm-6">
							<div class="form-group">
								<label>Designation Serial No.<span class="required">*</span></label>
								<input class="form-control" name="ser_no" value = "<?php echo $designation_data->deg_ser_no; ?>" type="text" placeholder="Designation Serial No."> 
							</div>
                           </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Status<span class="required">*</span></label>
									<select required="required" name = "status" class="form-control">
									   <option selected="selected" value="1" <?php if($designation_data->status == '1') echo 'selected="selected"' ?>>Active</option>
									   <option  value="0" <?php if($designation_data->status == '0') echo 'selected="selected"' ?>>Deactive</option>
									</select>
								</div>
                            </div>
							
							
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Update Designation</button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
