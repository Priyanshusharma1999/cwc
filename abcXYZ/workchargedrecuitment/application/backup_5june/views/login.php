
    
	   
			<?php if($this->session->flashdata('flashSuccess_applicant_login')) { ?>
			<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_applicant_login');?> 
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
			<?php } ?>

			<?php if($this->session->flashdata('flashError_applicant_login')) { ?>
			<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_applicant_login'); ?> 
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
			<?php } ?>
	      <div class="account-box">
				<div class="account-wrapper">
				  <h3 class="account-title">Login</h3>
					<?php
					 	$attributes = array('class' => '', 'id' =>'applicannnt_logginn');
     					echo form_open_multipart('Frontend/login/',$attributes);?> 
						<div class="form-group form-focus">
						    <label class="control-label">Email Id<span class="required">*</span></label>
							<input class="form-control floating" name = "email" type="text" placeholder="Enter Email Id" maxlength="80" value = "<?php echo isset($insertData['email']) ? $insertData['email'] : ''; ?>" required="required" >
                                <span class = "text-danger"><?php echo form_error('email');?></span>
						</div>
						<div class="form-group form-focus">
						    <label class="control-label">Password<span class="required">*</span></label>
							<input class="form-control floating" name = "password" type="password"  placeholder="Enter Password" maxlength="25" value = "<?php echo isset($insertData['password']) ? $insertData['password'] : ''; ?>" required="required" >
                                <span class = "text-danger"><?php echo form_error('password');?></span>
						</div>
						
						<div class="form-group form-focus">
							<label class="control-label">Type the Characters:</label>
							<input type="hidden" id="txtCaptcha" name="Captcha_text">
                            <input type="text" name="CaptchaInput" id="CaptchaInput" size="15" maxlength="5" placeholder="Enter Captcha" class="form-control" value = "<?php echo isset($insertData['CaptchaInput']) ? $insertData['CaptchaInput'] : ''; ?>" required="required" >
                                <span class = "text-danger"><?php echo form_error('CaptchaInput');?></span>
							<div id="CaptchaDiv" oncopy="return false" ></div>
							<a href="javascript:void(0)" oncopy="return false" onclick="refreshCaptcha()" style="font-size: 22px;margin-left: 20px;"><i class="fa fa-refresh"></i></a>
						</div>
						
						<div class="form-group text-center">

							<button name="submit" class="btn btn-primary btn-block account-btn" type="submit">Login</button>
							<!-- <a  href="<?php //echo site_url();?>admin" class="btn btn-primary btn-block account-btn">  Login
							</a> -->
						</div>
						<div class="text-center" style="margin-bottom:30px;">
						<a href="<?php echo site_url();?>frontend/forgetpassword" class="pull-left">Forgot your password?</a>
						<a href="<?php echo site_url();?>frontend/register" class="pull-right">New Registration</a>
						</div>
					 <?php echo form_close();?>
				</div>
          </div>

          <style>
  
    .alert{
    	width: 45%;
        margin: 40px auto 0;
   }

</style>


	<script type="text/javascript">

	// Captcha Script
	 $('#CaptchaInput').bind('cut copy paste', function (e) {
        e.preventDefault();
    });

	function checkform(theform){
	var why = "";

	if(theform.CaptchaInput.value == ""){
	why += "- Please Enter CAPTCHA Code.\n";
	}
	if(theform.CaptchaInput.value != ""){
	if(ValidCaptcha(theform.CaptchaInput.value) == false){
	why += "- The CAPTCHA Code Does Not Match.\n";
	}
	}
	if(why != ""){
	alert(why);
	return false;
	}
	}

	var a = Math.ceil(Math.random() * 9)+ '';
	var b = Math.ceil(Math.random() * 9)+ '';
	var c = Math.ceil(Math.random() * 9)+ '';
	var d = Math.ceil(Math.random() * 9)+ '';
	var e = Math.ceil(Math.random() * 9)+ '';

	var code = a + b + c + d + e;
	document.getElementById("txtCaptcha").value = code;
	document.getElementById("CaptchaDiv").innerHTML = code;
	
	function refreshCaptcha(){
		
		var f = Math.ceil(Math.random() * 9)+ '';
		var g = Math.ceil(Math.random() * 9)+ '';
		var h = Math.ceil(Math.random() * 9)+ '';
		var i = Math.ceil(Math.random() * 9)+ '';
		var j = Math.ceil(Math.random() * 9)+ '';

		var code = f + g + h + i + j;
		document.getElementById("txtCaptcha").value = code;
		document.getElementById("CaptchaDiv").innerHTML = code;
		
	}

	// Validate input against the generated number
	function ValidCaptcha(){
	var str1 = removeSpaces(document.getElementById('txtCaptcha').value);
	var str2 = removeSpaces(document.getElementById('CaptchaInput').value);
	if (str1 == str2){
	return true;
	}else{
	return false;
	}
	}

	// Remove the spaces from the entered and generated code
	function removeSpaces(string){
	return string.split(' ').join('');
	}
	</script>

	 
	 
	