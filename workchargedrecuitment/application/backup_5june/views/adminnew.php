

	   
	 
	      <div class="account-box">
				<div class="account-wrapper">
				  <h3 class="account-title">Admin Login</h3>
					<?php if($this->session->flashdata('flashError')) { ?>
					<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError'); ?> 
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
					<?php } ?>
					 <?php
					 	$attributes = array('class' => '', 'id' =>'admin_new_login');
     					echo form_open_multipart('Frontend/adminnew/',$attributes);?> 
						<div class="form-group form-focus">
						    <label class="control-label">UserId<span class="required">*</span></label>
							<input class="form-control floating" name= "user" type="text" placeholder="Ente UserId" value = "<?php echo isset($insertData['user']) ? $insertData['user'] : ''; ?>">
							<span class = "text-danger"><?php echo form_error('user');?></span>
						</div>
						<div class="form-group form-focus">
						    <label class="control-label">Password<span class="required">*</span></label>
							<input class="form-control floating" name= "password" type="password"  placeholder="Enter Password" value = "<?php echo isset($insertData['password']) ? $insertData['password'] : ''; ?>">
							<span class = "text-danger"><?php echo form_error('password');?></span>
						</div>
						
						<div class="form-group form-focus">
							<label class="control-label">Type the Characters<span class="required">*</span></label>
							<input type="hidden" name="Captcha_text" id="txtCaptcha">
                            <input type="text" name="CaptchaInput" id="CaptchaInput" size="15" placeholder="Enter Captcha" class="form-control" maxlength="5" value = "<?php echo isset($insertData['CaptchaInput']) ? $insertData['CaptchaInput'] : ''; ?>">
                            <span class = "text-danger"><?php echo form_error('CaptchaInput');?></span>
							<div id="CaptchaDiv" oncopy="return false" ></div>
						<a href="javascript:void(0)" onclick="refreshCaptcha()" style="font-size: 22px;margin-left: 20px;"><i class="fa fa-refresh"></i></a>
						</div>
						
						<div class="form-group text-center">
						 <!-- <a href="<?php //echo site_url();?>mainadmin" class="btn btn-primary btn-block account-btn">Login</a> -->
						 <button type="submit" class="btn btn-primary btn-block account-btn" name="submit">Login</button>
						</div>
						<div class="text-center">
							<a href="forgot-password.html">Forgot your password?</a>
						</div>
					<?php echo form_close();?>
				</div>
          </div>
	 
	 
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
