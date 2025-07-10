

    <?php $this->load->view('header.php');?>
	   
	 
	      <div class="account-box">
				<div class="account-wrapper">
				  <h3 class="account-title">Forget Password</h3>
					<form>
						<div class="form-group form-focus">
							<label class="control-label">Email</label>
							<input class="form-control floating" type="text" placeholder="Enter Email">
						</div>
						<div class="form-group text-center">
							<button class="btn btn-primary btn-block account-btn" type="submit">Reset Password</button>
						</div>
						<div class="text-center">
							<a href="<?php echo site_url();?>frontend/login">Back to Login</a>
						</div>
                    </form>
				</div>
          </div>
	 
	 
	<?php $this->load->view('footer.php');?>