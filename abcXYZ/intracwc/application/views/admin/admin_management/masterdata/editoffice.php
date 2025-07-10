 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Office</h6>
								<hr>
								<?php if($this->session->flashdata('flashError_office')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_office'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>
							<?php 
						 	$attributes = array('class' => '', 'id' =>'add_office');
	     					echo form_open_multipart('Administrator/Office/edit_office/'.$office_data->office_id,$attributes);?>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Office Name<span class="required">*</span></label>
									<input class="form-control" name="office_name" type="text" placeholder="Office Name" value = "<?php echo $office_data->office_name; ?>">
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Office Description<span class="required">*</span></label>
									<input class="form-control" type="text" name="office_description" placeholder="Designation Short Name" value = "<?php echo $office_data->office_description; ?>">
								</div>
                            </div>
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Update</button>
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