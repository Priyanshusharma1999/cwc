
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Wing</h6>
								<hr>
                                <?php if($this->session->flashdata('flashError_wing')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_wing'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>

						      	<?php
							 	$attributes = array('class' => '', 'id' =>'add_wing');
		     					echo form_open_multipart('Administrator/Wing/edit_wing/'.$wing_data->wing_id,$attributes);?>
								   <div class="col-sm-6">
										<div class="form-group">
											<label>Wing Name<span class="required">*</span></label>
											<input class="form-control" name="wing_name" type="text" placeholder="Wing Name" value="<?php echo $wing_data->wing_name; ?>">
										</div>
									</div>
								   <div class="col-sm-6">
										<div class="form-group">
											<label>Wing Short Name<span class="required">*</span></label>
											<input class="form-control" name="wing_short_name" type="text" placeholder="Wing Short Name" value="<?php echo $wing_data->wing_short_name; ?>">
										</div>
									</div>

									<div class="col-sm-6">
									<div class="form-group">
									<label>Status<span class="required">*</span></label>
									<select required="required" name = "status" class="form-control">
									   <option selected="selected" value="1" <?php if($wing_data->status == '1') echo 'selected="selected"' ?>>Active</option>
									   <option  value="0" <?php if($wing_data->status == '0') echo 'selected="selected"' ?>>Deactive</option>
									</select>
								</div>
                            </div>
									
									
									<div class="m-t-20" style="padding-left:15px;clear:both;">
										<button class="btn btn-primary" type="submit" name="submit">Update Wing</button>
									</div>
								<?php echo form_close();?>
						
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

