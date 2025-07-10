

	   
	 
	      <div class="account-box">
				<div class="account-wrapper">
				  <h3 class="account-title">Admin Login</h3>
					<?php if($this->session->flashdata('flashError')) { ?>
					<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError'); ?> 
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
					<?php } ?>
					 <?php
					 	$attributes = array('class' => '', 'id' =>'admin_new_login','autocomplete' => 'new-password');
     					echo form_open_multipart('Frontend/adminnew/',$attributes);?> 
						<div class="form-group form-focus">
						    <label class="control-label">UserId<span class="required">*</span></label>
							<input class="form-control floating" autocomplete="off" name= "user" type="text" placeholder="Enter UserId" value = "<?php echo isset($insertData['user']) ? $insertData['user'] : ''; ?>">
							<span class = "text-danger"><?php echo form_error('user');?></span>
						</div>
						<div class="form-group form-focus">
						    <label class="control-label">Password<span class="required">*</span></label>
							<input class="form-control floating" autocomplete="off" id="pwd" maxlength="100" name= "password" type="password"  placeholder="Enter Password" value = "<?php echo isset($insertData['password']) ? $insertData['password'] : ''; ?>">
							<span class = "text-danger"><?php echo form_error('password');?></span>
						</div>
						
						<div class="form-group form-focus">
							
                              
							<label class="control-label" style="display:block;">Type the Characters:</label>
							
                        <input type="text" autocomplete="off" name="CaptchaInput" id="CaptchaInput" placeholder="Enter Captcha" class="form-control" maxlength="5" style="margin-bottom: 10px;" ondrop="return false;">

							  <span class = "text-danger"><?php echo form_error('CaptchaInput');?></span>
                             <span class="captcha-error"></span>

							<div id="CaptchaDiv_test" oncopy="return false" style="text-align: center;padding: 6px;width: 100px;font-size: 20px;color: #2662df;background: #b3d9ff;display: inline-block;"><?php echo $captcha; ?>
								
							</div>

						<a href="javascript:void(0)" onclick="refreshCaptcha()" style="font-size: 22px;margin-left: 20px;">
							<i class="fa fa-refresh"></i>
						</a>

						</div>
						
						<div class="form-group text-center">
					
						 <button onClick="mySubmit();" type="submit" class="btn btn-primary btn-block account-btn" name="submit">Login</button>
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
