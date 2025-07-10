
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Post</h6>
								<hr>


						<?php if($this->session->flashdata('flashError_post')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_post'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
                                
						<?php
					 	$attributes = array('class' => '', 'id' =>'add_postt');
     					echo form_open_multipart('Superadmin/edit_post/'.$post_data->id,$attributes);?> 
							<div class="col-sm-6">
								<div class="form-group">
									<label>Select Region<span class="required">*</span></label>
									<select name = "region_name" class="form-control" id = "region_post">
									   <option selected="selected" value="">Select Prefered region</option>
										 <?php
				                        	$all_data[] = $post_data->region_id;
				                    	foreach ($all_regions as $rows ) {  ?>
				                        <option value="<?php echo $rows->id; ?>"
				                    	<?php 
				                    		echo (isset($post_data->region_id) && in_array($rows->id,$all_data) ) ? "selected" : "" ?> ><?php echo $rows->region_name; ?>
				                    	</option>
				                      <?php } ?>
										
								   </select>
									<span class = "text-danger"><?php echo form_error('region_name');?></span>
								</div>
						    </div>
						 
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Select Circle<span class="required" >*</span></label>
									<select name = "circle_name" class="form-control" id = "circlee_post">
									<option selected="selected" value="">Select Circle</option>
									 <?php
                    
					                     $all_dataa[]	 = $post_data->circle_id;
					                      foreach ($all_circle as $rowss){ ?>   
					                   
					                    <option value="<?php echo $rowss->id; ?>"
					                	<?php echo (isset($post_data->circle_id) && in_array($rowss->id,$all_dataa) ) ? "selected" : "" ?>  ><?php echo $rowss->circle_name; ?></option>
					            		<?php } ?>
									</select>
									<span class = "text-danger"><?php echo form_error('circle_name');?></span>
								</div>
							 </div>
							 
						  <div class="col-sm-6">
							<div class="form-group">
								<label>Post <span class="required">*</span></label>
								<input class="form-control" type="text" placeholder="Post Name" name="post_name" maxlength="80" value = "<?php echo $post_data->post_name; ?>">
								<span class = "text-danger"><?php echo form_error('post_name');?></span>
							</div>
						  </div>
						  
						  <div class="col-sm-6">
							<div class="form-group">
								<label>Post Code<span class="required">*</span></label>
								<input class="form-control" type="text" placeholder="Post Code" name="post_code" maxlength="80" value = "<?php echo $post_data->post_code; ?>">
								<span class = "text-danger"><?php echo form_error('post_code');?></span>
							</div>
						  </div>
							  
							  <div class="m-t-20" style="padding-left:15px;">
									 <button name="submit" type="submit" class="btn btn-primary">Update Post</button>
							  </div>
                       		<?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
				
				 
				
				
            </div>
            
        </div>
      
