   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Verify Handover</h6>
								<hr>
								
					<?php if($this->session->flashdata('flashError_votp')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_votp'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
						<?php } ?>
						
						
					<?php
					
					    $uri = $this->uri->segment('4');
					 	$attributes = array('class' => '', 'id' =>'add_request');
     					echo form_open_multipart('itonlinestationary/Handoveritems/Verifyhandover/'.$uri,$attributes);?>

     				     <div class="col-sm-12">
								<div class="form-group">
									<label>OTP<span class="required">*</span></label>
									<input type="text" class="form-control" placeholder="Enter OTP" name="hotp">
								</div>
                           </div>
								
					       <button type="submit"  name="submit" class="btn btn-primary">Verify</button>	

						 <?php echo form_close(); ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        
         <style>
		  p label{width:20%;}
		</style>
		
