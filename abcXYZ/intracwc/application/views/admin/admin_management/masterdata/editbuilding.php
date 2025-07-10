  
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Building</h6>
								<hr>
                                
						<?php if($this->session->flashdata('flashError_building')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_building'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
						        
						<?php
					 	$attributes = array('class' => '', 'id' =>'add_building');
     					echo form_open_multipart('Administrator/Masterdata/edit_building/'.$building_data->building_id,$attributes);?>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Building Name<span class="required">*</span></label>
									<input class="form-control" name="building_name" type="text"placeholder="Building Name" value = "<?php echo $building_data->building_name; ?>" >
									<span class = "text-danger"><?php echo form_error('building_name');?></span>
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Building  Short Name<span class="required">*</span></label>
									<input class="form-control" name="building_short_name" type="text" placeholder="Building  Short Name" value = "<?php echo $building_data->building_short_name; ?>">
									<span class = "text-danger"><?php echo form_error('building_short_name');?></span>
								</div>
                            </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Status<span class="required">*</span></label>
									<select required="required" name = "status" class="form-control">
									   <option selected="selected" value="1" <?php if($building_data->status == '1') echo 'selected="selected"' ?>>Active</option>
									   <option  value="0" <?php if($building_data->status == '0') echo 'selected="selected"' ?>>Deactive</option>
									</select>
								</div>
                            </div>
							
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Update Building</button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

