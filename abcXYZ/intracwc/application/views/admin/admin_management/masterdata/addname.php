   
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Section</h6>
								<hr>
								 <?php if($this->session->flashdata('flashError_section')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_section'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>
                                
						<?php
						 	$attributes = array('class' => '', 'id' =>'add_section');
	     					echo form_open_multipart('Administrator/Section/add_section/',$attributes);?>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Wing Name<span class="required">*</span></label>
									
									<select name="wing_name" class="form-control">
									   <option selected="selected" value="">Select Wing Name</option>
										<?php
											if(empty($all_wing))
											{
												echo '<option value="1">'.'Select Wing'.'</option>';
											}

											else
											{
												foreach ($all_wing as $wing)
						                      {   
						                         echo '<option value="'.$wing->wing_id.'">'.$wing->wing_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Section Name<span class="required">*</span></label>
									<input class="form-control" name="section_name" type="text" placeholder="Section Name" value = "<?php echo isset($insertData['section_name']) ? $insertData['section_name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('section_name');?></span>
								</div>
                            </div>
							
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Section Short Name<span class="required">*</span></label>
									<input class="form-control" name="section_short_name" type="text" placeholder="Section Short Name" value = "<?php echo isset($insertData['section_short_name']) ? $insertData['section_short_name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('section_short_name');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="checkbox" style="margin-top: 35px;">
									<label style="font-size:15px;">
										<input type="checkbox" value="1" name="show"> Show
									</label>
								</div>
						    </div>	
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Add Section</button>
                            </div>
                        <?php echo form_close(); ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      
  <style>
  	
  	.form-group {
	    margin-bottom: 0;
	    min-height: 90px;
	}

  </style>