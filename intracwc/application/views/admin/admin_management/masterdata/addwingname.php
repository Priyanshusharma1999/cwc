
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Wing Name</h6>
								<hr>
                        <?php if($this->session->flashdata('flashError_wing')) { ?>
                        <div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_wing'); ?> 
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
                        <?php } ?>      
						<?php
                            $attributes = array('class' => '', 'id' =>'add_wing');
                            echo form_open_multipart('Administrator/Wing/add_wing/',$attributes);?>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Wing Name<span class="required">*</span></label>
									<input class="form-control" name="wing_name" type="text" placeholder="Wing Name" value = "<?php echo isset($insertData['wing_name']) ? $insertData['wing_name'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('wing_name');?></span>
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Wing Short Name<span class="required">*</span></label>
									<input class="form-control" name="wing_short_name" type="text" placeholder="Wing Short Name" value = "<?php echo isset($insertData['wing_short_name']) ? $insertData['wing_short_name'] : ''; ?>">
                                    <span class = "text-danger"><?php echo form_error('wing_short_name');?></span>
								</div>
                            </div>
							
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Add Wing</button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

