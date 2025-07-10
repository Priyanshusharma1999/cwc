
    

	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Region</h6>
								<hr>
						
						<?php if($this->session->flashdata('flashError')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>

						<?php
						$session_id = $this->session->userdata('auser_id');
					 	$attributes = array('class' => '', 'id' =>'add_regionn');
     					echo form_open_multipart('Superadmin/edit_region/'.$region_data->id.'/'.$session_id,$attributes);?> 
						
						  <div class="col-sm-6">
							<div class="form-group">
								<label>Region Name<span class="required">*</span></label>
								<input class="form-control" name="region_name" type="text" placeholder="Region Name" maxlength="50" value = "<?php echo $region_data->region_name ; ?>">
								<span class = "text-danger"><?php echo form_error('region_name');?></span>
							</div>
						  </div>
						  
						  <div class="m-t-20" style="clear:both;padding-left:15px;">

                                <button name="submit" type="submit" class="btn btn-primary">Update Region</button>
                          </div>
							
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
				
            </div>
            
        </div>
      

