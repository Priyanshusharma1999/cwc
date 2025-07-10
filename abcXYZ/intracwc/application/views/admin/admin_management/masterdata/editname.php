
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Section</h6>
								<hr>

								<?php if($this->session->flashdata('flashError_section')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_section'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>
                                
						<?php
					 	$attributes = array('class' => '', 'id' =>'add_section');
     					echo form_open_multipart('Administrator/Section/edit_section/'.$section_data->section_id,$attributes);?>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Wing Name<span class="required">*</span></label>
									
									<select name="wing_name" class="form-control">
									   <option selected="selected" value="">Select Wing Name</option>
										<?php
				                        	$all_data[] = $section_data->wing_id;
					                    	foreach ($all_wing as $rows ) {  ?>
					                        <option value="<?php echo $rows->wing_id; ?>"
					                    	<?php 
					                    		echo (isset($section_data->wing_id) && in_array($rows->wing_id,$all_data) ) ? "selected" : "" ?> ><?php echo $rows->wing_name; ?>
					                    	</option>
				                      <?php } ?>
									</select>
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Section Name<span class="required">*</span></label>
									<input class="form-control" name="section_name" type="text" placeholder="Section Name" value="<?php echo $section_data->section_name; ?>">
								</div>
                            </div>
							
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Section Short Name<span class="required">*</span></label>
									<input class="form-control" type="text" name="section_short_name" placeholder="Section Short Name" value="<?php echo $section_data->section_short_name; ?>">
								</div>
                            </div>

						    <div class="col-sm-6">
								<div class="form-group">
									<label>Status<span class="required">*</span></label>
									<select required="required" name = "status" class="form-control">
									   <option selected="selected" value="1" <?php if($section_data->status == '1') echo 'selected="selected"' ?>>Active</option>
									   <option  value="0" <?php if($section_data->status == '0') echo 'selected="selected"' ?>>Deactive</option>
									</select>
								</div>
                            </div>

                            <div class="col-sm-6">
								<div class="checkbox">
									<label style="font-size:15px;">
										<input type="checkbox" name="show" value="1" <?php if($section_data->show_status==1) echo " checked "?>> Show
									</label>
								</div>
						    </div>	
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Update Section</button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
  
