  
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Organization</h6>
								<hr>
						
						<?php if($this->session->flashdata('flashError_org')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_org'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
							
						<?php
                        $sesssion_id = $this->session->userdata('applicant_user_id');
					 	$attributes = array('class' => '', 'id' =>'add_circlee');
     					echo form_open_multipart('Masterdata/edit_organization/'.$all_organization[0]->ORGANIZATION_ID.'/'.$sesssion_id,$attributes);?>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Organization Name<span class="required">*</span></label>
									<input class="form-control" type="text" name="organization_name" placeholder="Organization Name" value="<?php echo $all_organization[0]->ORGNAME; ?>">
								</div>
                            </div>
						 
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button name="submit" type="submit" class="btn btn-primary">Update Organization</button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      