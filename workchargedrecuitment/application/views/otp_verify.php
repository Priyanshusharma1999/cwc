	 

        		<?php if($this->session->flashdata('flashSuccess_applicant')) { ?>
				<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_applicant');?> 
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
				<?php } ?>

				<?php if($this->session->flashdata('flashError_applicant_otperror')) { ?>
				<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_applicant_otperror'); ?> 
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
				<?php } ?>
          

	      <div class="account-box">

				<div class="account-wrapper">

				  <h3 class="account-title">OTP Verify</h3>
				  		
					<!--  <?php
					 	$attributes //= array('class' => '', 'id' =>'applicannnt_register');
     					//echo form_open_multipart('Frontend/register/',$attributes);?>  -->
     					<?php
					 	$attributes = array('class' => '', 'id' =>'otp_form');
     					echo form_open_multipart('Frontend/register_otp/',$attributes);?>

							<input type="hidden" name="mobile_no" value="<?php echo $mobile_no; ?>" />

                            <div class="form-group form-focus">
							    <label class="control-label">OTP<span class="required">*</span></label>
                                <input class="form-control floating" maxlength="6" autocomplete="off" id = "" name = "otp" type="text" placeholder="Enter OTP" value = "" required="required" >
                                <span class = "text-danger"><?php echo form_error('otp');?></span>
								
                            </div>
							
                            
							
                            <div class="form-group text-center">
                            	
                                <button name="submit" class="btn btn-primary btn-block account-btn" type="submit" style="margin-top: 25px;">Verify</button>
                            </div>
                            <div class="text-center">
								  Already have an account? click 
								  <a href="<?php echo site_url();?>frontend/login">here</a>
								  to login
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
	 