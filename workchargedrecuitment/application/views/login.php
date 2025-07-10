
    
	   
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
							<input class="form-control floating" autocomplete="off" name = "email" type="text" placeholder="Enter Email Id" maxlength="100" value = "<?php echo isset($insertData['email']) ? $insertData['email'] : ''; ?>" required="required" >
                                <span class = "text-danger"><?php echo form_error('email');?></span>
						</div>
						<div class="form-group form-focus">
						    <label class="control-label">Password<span class="required">*</span></label>
							<input class="form-control floating" autocomplete="off" id="pwd" name = "password" type="password"  placeholder="Enter Password"  maxlength="100" value = "<?php echo isset($insertData['password']) ? $insertData['password'] : ''; ?>" required="required" >
                                <span class = "text-danger"><?php echo form_error('password');?></span>
						</div>
						
						<div class="form-group form-focus">

							<label class="control-label" style="display:block;">Type the Characters:</label>
							
                        <input type="text" autocomplete="off" name="CaptchaInput" id="CaptchaInput" placeholder="Enter Captcha" class="form-control" maxlength="5" style="margin-bottom: 10px;" ondrop="return false;">

							  <span class = "text-danger"><?php echo form_error('CaptchaInput');?></span>
                             <span class="captcha-error"></span>

							<div id="CaptchaDiv_test" oncopy="return false" style="text-align: center;padding: 6px;width: 100px;font-size: 20px;color: #2662df;background: #b3d9ff;display: inline-block;">
								<?php echo $captcha; ?>
								
							</div>

						<a href="javascript:void(0)" onclick="refreshCaptcha()" style="font-size: 22px;margin-left: 20px;">
							<i class="fa fa-refresh"></i>
						</a>

						</div>
						
						<div class="form-group text-center">

							<button onClick="mySubmit();" name="submit" class="btn btn-primary btn-block account-btn" type="submit">Login</button>
							
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

	
	function refreshCaptcha(){
		
	    var base_url = "<?php echo base_url(); ?>";
		var base_urwwwwl = "<?php echo time(); ?>";
        var link = base_url+'Frontend/captccha/';
        var csrf_test_name = $("input[name=csrf_test_name]").val();

          $.ajax({
            method: "POST",
            url: link,
           data: {'csrf_test_name' : base_urwwwwl},
            success: function(result) {
                
               var obj = JSON.parse(result);
               if(obj)
               {
               	
                document.getElementById("CaptchaDiv_test").innerHTML = obj.msg;
                       
               }

               else
               {
                  
               }

              
            }
        
        });
		
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

	 
	 
	