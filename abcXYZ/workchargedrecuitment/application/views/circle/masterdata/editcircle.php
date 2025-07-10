	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Circle</h6>
								<hr>
           

						<?php
					 	$attributes = array('class' => '', 'id' =>'add_circlee');
     					echo form_open_multipart('Superadmin/edit_circle/'.$circle_data->id,$attributes);?>
						 
						 <div class="col-sm-6">
							<div class="form-group">
								<label>Select Region<span class="required">*</span></label>
								<select required="required" class="form-control" name="region_name">
								   <option selected="selected" value="">Select Prefered region</option>
									<?php

                   $all_data[] = $circle_data->region_id;
                   foreach ($all_regions as $rows ) {  ?>
                    <option value="<?php echo $rows->id; ?>"
                    <?php echo (isset($circle_data->region_id) && in_array($rows->id,$all_data) ) ? "selected" : "" ?> ><?php echo $rows->region_name; ?></option>
                      <?php } ?>
									
								</select>
							</div>
						  </div>
						 
						 <div class="col-sm-6">
							<div class="form-group">
								<label>Circle Name<span class="required">*</span></label>
								<input class="form-control" type="text" placeholder="Circle Name" name="circle_name" maxlength="50"
								 value = "<?php echo $circle_data->circle_name; ?>">
							</div>
						  </div>
						  
						  <div class="m-t-20" style="padding-left:15px;">
						  	<button name="submit" type="submit" class="btn btn-primary">Update Circle</button>
                                
               </div>
						  
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
				
				
			
				
            </div>
            
        </div>
      

