 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Designation</h6>
								<hr>

								<?php if($this->session->flashdata('flashError_designation')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_designation'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>
                             <?php if($this->session->flashdata('flashError_building')) { ?>
							<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_building'); ?> 
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
							<?php } ?>   

							<?php
						 	$attributes = array('class' => '', 'id' =>'add_designation');
	     					echo form_open_multipart('Administrator/Designation/add_designation/',$attributes);?>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Designation Name<span class="required">*</span></label>
									<input class="form-control" name="designation_name" type="text" placeholder="Designation Name" value = "<?php echo isset($insertData['designation_name']) ? $insertData['designation_name'] : ''; ?>">
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Designation Short Name<span class="required">*</span></label>
									<input class="form-control" type="text" name="designation_short_name" placeholder="Designation Short Name" value = "<?php echo isset($insertData['designation_short_name']) ? $insertData['designation_short_name'] : ''; ?>">
								</div>
                            </div>
							
							
						  <div class="col-sm-6">
							<div class="form-group">
								<label>Designation Serial No.<span class="required">*</span></label>
								<input class="form-control" name="ser_no" type="text" placeholder="Designation Serial No."> 
							</div>
                           </div>
							
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Add Designation</button>
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