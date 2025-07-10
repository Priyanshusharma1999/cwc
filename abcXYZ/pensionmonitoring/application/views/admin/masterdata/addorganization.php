   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Organization</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashError_org')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_org'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
                                
						<?php
                        $sesssion_id = $this->session->userdata('applicant_user_id');
					 	$attributes = array('class' => '', 'id' =>'add_postt');
     					echo form_open_multipart('Masterdata/addorganization/'.$sesssion_id,$attributes);?> 
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Organization Name<span class="required">*</span></label>
									<input class="form-control" name="organization_name" type="text" placeholder="Organization Name">
									<span class = "text-danger"><?php echo form_error('organization_name');?></span>
								</div>
                            </div>
						 
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button name="submit" type="submit"  class="btn btn-primary">Add Organization</button>
                            </div>
                        <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    