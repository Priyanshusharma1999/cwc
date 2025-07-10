 
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Room</h6>
								<hr>
                                <?php if($this->session->flashdata('flashError_room')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_room'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
						<?php
						 	$attributes = array('class' => '', 'id' =>'add_room');
	     					echo form_open_multipart('Administrator/Room/edit_room/'.$room_data->room_id,$attributes);?>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Building Name<span class="required">*</span></label>
									<select name="building_name" class="form-control">
									   <option selected="selected" value="">Select Building</option>
										<?php
				                        	$all_data[] = $room_data->building_id;
					                    	foreach ($all_building as $rows ) {  ?>
					                        <option value="<?php echo $rows->building_id; ?>"
					                    	<?php 
					                    		echo (isset($room_data->building_id) && in_array($rows->building_id,$all_data) ) ? "selected" : "" ?> ><?php echo $rows->building_name; ?>
					                    	</option>
				                      <?php } ?>
									</select>
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Floor Name<span class="required">*</span></label>
									<input class="form-control" name="room_name" type="text" placeholder="Room Name" value="<?php echo $room_data->room_name;?>">
								</div>
                            </div>

                             <div class="col-sm-6">
								<div class="form-group">
									<label>Status<span class="required">*</span></label>
									<select required="required" name = "status" class="form-control">
									   <option selected="selected" value="1" <?php if($room_data->status == '1') echo 'selected="selected"' ?>>Active</option>
									   <option  value="0" <?php if($room_data->status == '0') echo 'selected="selected"' ?>>Deactive</option>
									</select>
								</div>
                            </div>
							
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Update Room</button>
                            </div>
                       <?php echo form_close(); ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

