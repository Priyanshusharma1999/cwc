  
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Division</h6>
								<hr>
					
						<?php if($this->session->flashdata('flashError_division')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_division'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
							
						<?php
					 	$attributes = array('class' => '', 'id' =>'add_circlee');
     					echo form_open_multipart('Masterdata/edit_division/'.$all_divisions[0]->DIVISION_ID,$attributes);?>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Organization Name<span class="required">*</span></label>
									
									<select class="form-control" name="organization_name">
									   <option value="" selected>Select Organisation</option>
									   <?php foreach($all_organization as $org){?>
									     <option value="<?php echo $org->ORGANIZATION_ID; ?>" <?php if($org->ORGANIZATION_ID ==$all_divisions[0]->ORGANIZATION_ID ){echo 'selected';}?>>
										   <?php echo $org->ORGNAME; ?>
										 </option>
									   <?php } ?>
									</select>
									
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Division Name<span class="required">*</span></label>
									<input class="form-control" name="division_name" type="text" value="<?php echo $all_divisions[0]->DIVISIONNAME; ?>" placeholder="Division Name">
									<span class = "text-danger"><?php echo form_error('division_name');?></span>
								</div>
                            </div>
						 
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button name="submit" type="submit" class="btn btn-primary">Update Division</button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      