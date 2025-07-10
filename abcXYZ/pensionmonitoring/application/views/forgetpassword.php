				
				<div class="container">
	      <div class="account-box">
				<div class="account-wrapper">
				  <h3 class="account-title">Forget Password</h3>

				  <?php if($this->session->flashdata('flashErrorforget_user')) { ?>
						<div class='alert alert-danger'> <?php echo $this->session->flashdata('flashErrorforget_user');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>

						<?php if($this->session->flashdata('flashforgetSuccess_user')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashforgetSuccess_user');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>

					<?php
					 	$attributes = array('id' =>'frgt_pwd','autocomplete'=> 'new-password');
     					echo form_open_multipart('Frontend/forgetpwd/',$attributes);?> 
						<div class="form-group form-focus">
							
							<label class="control-label">Email</label>
							<input class="form-control floating" name="email" type="text" placeholder="Enter Email" maxlength="150"/>
						</div>
						<div class="form-group text-center">
							<button class="btn btn-primary btn-block account-btn" onClick="mySubmitforget();" name="submit" type="submit">Reset Password</button>
						</div>
						<div class="text-center">
							<a href="<?php echo site_url();?>frontend/login">Back to Login</a>
						</div>
                    <?php echo form_close();?>
				</div>
     </div>
   </div>

  
	 
	 
