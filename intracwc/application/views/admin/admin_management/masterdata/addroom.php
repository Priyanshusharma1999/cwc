  
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Floor</h6>
								<hr>
								 <?php if($this->session->flashdata('flashError_room')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_room'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>
                                
						<?php
						 	$attributes = array('class' => '', 'id' =>'add_room');
	     					echo form_open_multipart('Administrator/Room/add_room/',$attributes);?>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Building Name<span class="required">*</span></label>
									<select name="building_name" class="form-control">
									   <option selected="selected" value="">Select Building</option>
										<?php
											if(empty($all_building))
											{
												echo '<option value="1">'.'Select Building'.'</option>';
											}

											else
											{
												foreach ($all_building as $building)
						                      {   
						                         echo '<option value="'.$building->building_id.'">'.$building->building_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Floor Name<span class="required">*</span></label>
									<input class="form-control" name="room_name"  type="text" placeholder="Room Name" value = "<?php echo isset($insertData['room_name']) ? $insertData['room_name'] : ''; ?>">
								</div>
                           </div>
							
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Add Floor</button>
                            </div>
                        <?php echo form_close(); ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

