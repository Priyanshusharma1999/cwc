 	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Organisation</h6>
								<hr>
                       <?php if($this->session->flashdata('flashError_organisation')) { ?>
                        <div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_organisation'); ?> 
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
                        <?php } ?>
						        
						<?php
					 	$attributes = array('class' => '', 'id' =>'add_organisation');
     					echo form_open_multipart('Contact/Organisation/edit_organisation/'.$organisation_data->contact_organisation_id,$attributes);?>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Organisation Name<span class="required">*</span></label>
									<input class="form-control" name="organisation_name" type="text" placeholder="Organisation Name" maxlength="200" value = "<?php echo $organisation_data->contact_organisation_name;?>">
									<span class = "text-danger"><?php echo form_error('organisation_name');?></span>
								</div>
                            </div>
						   
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Update Organisation</button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

