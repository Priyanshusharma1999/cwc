	 

        		<?php if($this->session->flashdata('flashSuccess_applicant')) { ?>
				<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_applicant');?> 
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
				<?php } ?>

				<?php if($this->session->flashdata('flashError_applicant')) { ?>
				<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_applicant'); ?> 
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
				<?php } ?>
          

	      <div class="account-box">

				<div class="account-wrapper">

				  <h3 class="account-title">New Registration</h3>
				  		
					<!--  <?php
					 	$attributes //= array('class' => '', 'id' =>'applicannnt_register');
     					//echo form_open_multipart('Frontend/register/',$attributes);?>  -->
     					<?php
					 	$attributes = array('class' => '', 'id' =>'applicannnt_register');
     					echo form_open_multipart('Frontend/otp_verify_register/',$attributes);?>

                            <div class="form-group form-focus">
							    <label class="control-label">Applicant Name<span class="required">*</span></label>
                                <input class="form-control floating" autocomplete="off" type="text" name = "applicant_name" placeholder="Enter Name" value = "<?php echo isset($insertData['applicant_name']) ? $insertData['applicant_name'] : ''; ?>" required="required" >
                                <span class = "text-danger"><?php echo form_error('applicant_name');?></span>
                            </div>
                            <div class="form-group form-focus">
							    <label class="control-label">Email Id<span class="required">*</span></label>
                                <input class="form-control floating" autocomplete="off" id = "emaail_verrify_value" name = "email" type="email" placeholder="Enter Email Id" required="required" value = "<?php echo isset($insertData['email']) ? $insertData['email'] : ''; ?>" required="required" >
                                <span class = "text-danger"><?php echo form_error('email');?></span>
							
								<span class="errror"></span>
								
                            </div>
							
                            <div class="form-group form-focus">
							    <label class="control-label">Mobile No.<span class="required">*</span></label>
                                <input class="form-control floating" autocomplete="off" id = "phonnnee_verrify_value" name = "mobile_no" type="number" placeholder="Enter Mobile No." value = "<?php echo isset($insertData['mobile_no']) ? $insertData['mobile_no'] : ''; ?>" required="required" maxlength="10">
                                <span class = "text-danger"><?php echo form_error('mobile_no');?></span>
								<!-- <button type="button" id= "phonnnee_verrify_btn" class="btn btn-sm btn-color">Verify</button>
								<i class="fa fa-check otp-success" style="display:none;"></i>
								<span class="errffror"></span>
								<span style="margin-top:5px;display:block;">OTP will be sent to this Mobile No.</span> -->
                            </div>
							
                            <div class="form-group form-focus">
							    <label class="control-label">Gender</label>
                                <select required="required" name = "gender" class="form-control">
								   <option value="">Select Gender</option>
								   <option value="Male">Male</option>
								   <option value="Female">Female</option>
								   <option value="Trans Gender">Trans Gender</option>
								</select>
                            </div>
							
							<!-- <div class="form-group form-focus">
							     <label class="control-label">Date Of Birth</label>
								
								<input class="form-control " autocomplete="off" name = "dob" placeholder="dd/mm/yyyy" type="text" id="datepicker11" value = "<?php echo isset($insertData['dob']) ? $insertData['dob'] : ''; ?>" required="required" >
                                <span class = "text-danger"><?php echo form_error('dob');?></span>
								
                            </div> -->

                      <div class="form-group form-focus">
                       	 <label class="control-label">Date Of Birth</label>
					   <div class="cal-icon">
					   <input class="form-control datetimepicker" autocomplete="off" name = "dob" placeholder="dd/mm/yyyy" type="text"  value = "<?php echo isset($insertData['dob']) ? $insertData['dob'] : ''; ?>" required="required" >

					      <span class = "text-danger"><?php echo form_error('dob');?></span>
					    </div>
					  </div>
							
							<div class="form-group form-focus">

							<label class="control-label" style="display:block;">Type the Characters:</label>
							
                         <input type="text" autocomplete="off" name="CaptchaInput" id="CaptchaInput" placeholder="Enter Captcha" class="form-control" maxlength="5" style="margin-bottom: 10px;" ondrop="return false;">

							  <span class = "text-danger"><?php echo form_error('CaptchaInput');?></span>
                             <span class="captcha-error"></span>

							<div id="CaptchaDiv_test" oncopy="return false" style="text-align: center;padding: 6px;width: 100px;font-size: 20px;color: #2662df;background: #b3d9ff;display: inline-block;"><?php echo $captcha; ?></div>

						<a href="javascript:void(0)" onclick="refreshCaptcha()" style="font-size: 22px;margin-left: 20px;">
							<i class="fa fa-refresh"></i>
						</a>

						</div>

						<div class="form-group">
				       	
					<span class="required">*</span> <input type="checkbox" name="check_terms_condn" value="check" id=""> I accept all terms and conditions. 
						
					    
						</div>
							
                            <div class="form-group text-center">
                            	
                                <button name="submit" class="btn btn-primary btn-block account-btn" type="submit" style="margin-top: 25px;">Register</button>
                            </div>
                            <div class="text-center">
								  Already have an account? click 
								  <a href="<?php echo site_url();?>frontend/login">here</a>
								  to login
                            </div>
                   <?php echo form_close();?>
					
				</div>
          </div>
		  
		  
		  
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
	     <div class="account-box" style="box-shadow: none;border: 0;margin: 0;width: auto;">
			<div class="account-wrapper">
			   <h3 class="account-title">Enter OTP</h3>
				<form action="#">
					<div class="form-group form-focus">
						    <label class="control-label">Email OTP<span class="required">*</span></label>
							<input class="form-control floating"  type="text"  placeholder="Enter OTP">
				     </div>
					<div class="text-center">
						<button class="btn btn-primary btn-block account-btn" type="submit">Proceed</button>
					</div>
				</form>
			</div>
		  </div>
      </div>
    </div>
  </div>
</div>

<div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
	     <div class="account-box" style="box-shadow: none;border: 0;margin: 0;width: auto;">
			<div class="account-wrapper">
			   <h3 class="account-title">Enter OTP</h3>
			   <?php
				$attributes = array('class' => '', 'id' =>'');
				echo form_open_multipart('', $attributes);?>
				<form action="#">
					<div class="form-group form-focus">
						    <label class="control-label">Mobile OTP<span class="required">*</span></label>
							<input class="form-control floating" id = "otp_code" name = "otp_code" type="text"  placeholder="Enter OTP" maxlength = "4" required >
							<span class="errffrorrrr"></span><br/>
							<button type = "button" id= "resend_ottpp" class = "btn btn-success "> Resend OTP</button>
				     </div>
					<div class="text-center">
						<button type="button" id = "verify_mobille" class="btn btn-primary btn-block account-btn">Proceed</button>
					</div>
				<?php echo form_close();?>
			 </div>
		  </div>
      </div>
    </div>
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

	// var a = Math.ceil(Math.random() * 9)+ '';
	// var b = Math.ceil(Math.random() * 9)+ '';
	// var c = Math.ceil(Math.random() * 9)+ '';
	// var d = Math.ceil(Math.random() * 9)+ '';
	// var e = Math.ceil(Math.random() * 9)+ '';

	// var code = a + b + c + d + e;
	// document.getElementById("txtCaptcha").value = code;
	// document.getElementById("CaptchaDiv").innerHTML = code;
	
	function refreshCaptcha(){
		
		// var f = Math.ceil(Math.random() * 9)+ '';
		// var g = Math.ceil(Math.random() * 9)+ '';
		// var h = Math.ceil(Math.random() * 9)+ '';
		// var i = Math.ceil(Math.random() * 9)+ '';
		// var j = Math.ceil(Math.random() * 9)+ '';

		// var code = f + g + h + i + j;
		// document.getElementById("txtCaptcha").value = code;
		// document.getElementById("CaptchaDiv").innerHTML = code;

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
               	//document.getElementById("txtCaptcha").value = obj.msg;
                document.getElementById("CaptchaDiv_test").innerHTML = obj.msg;
                       
                     // return false;    
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
	 