
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/img/favicon.ico">
    <title>Central Water Commission</title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style-front.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/responsive.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"></script>
	 <script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
	 <script type="text/javascript" src="<?php echo base_url();?>assets/js/app.js"></script>
</head>

<body>

<div class="header-top">
   <div class="container">
	<div class="top-menu">
	  <img src="http://itestweb.in/cwc/sites/all/themes/nexus/images/flag.jpg" alt="india flag image"> Government of India	
            
        </div>
    </div>
</div>

<section class="wrapper section-header-wrapper-top">
  <div class="container container-header">
    <div class="header-logo">
		
          <a href="<?php echo base_url();?>" title="Home" rel="home">
                <div class="logimg"><img src="<?php echo base_url();?>assets/img/cwc-logo2.png"></div>
		<div class="logtext"> 
                  <h1 class="logo">Central Water Commission</h1>
                  <p class="logo-text">(Serving the nation since 1945)</p>
               </div>
          </a>        

     </div>

	<div class="header-logo-right">
		<a href="<?php echo base_url();?>" title="Home" rel="home">
			<img src="<?php echo base_url();?>assets/img/ministry-panel.png" alt="Home">
		</a>
	</div>
  </div>
</section>

<?php if($this->session->flashdata('flashSuccesslink_user')) { ?>
<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccesslink_user');?> 
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
<?php } ?>

<?php if($this->session->flashdata('flashErrorlink_user')) { ?>
<div class='alert alert-danger'> <?php echo $this->session->flashdata('flashErrorlink_user');?> 
<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
<?php } ?>


<section class="wrapper section-header-wrapper">
  <div class="container container-header">
	  <nav class="navbar navbar-default header-nav">
		 
			<div class="collapse navbar-collapse header-nav nopadding">
			  <ul class="nav navbar-nav links clearfix">
			  
				<li class="first"><a href="<?php echo site_url();?>" class="<?php if(($this->uri->segment(2))==''){ echo 'active'; } ?>">Home</a></li>

                 <?php
                 if($this->session->userdata('applicant_user_id'))
			 	{?>
                 <li class="first"><a href="<?php echo site_url();?>admin" class="<?php if(($this->uri->segment(2))==''){ echo 'active'; } ?>">Dashboard</a>
                 </li>
                 <?php } ?>

			      <li><a href="http://cwc.gov.in/">Go to main website</a></li>
				
			  </ul>
			  
			  
			  <ul class="nav navbar-nav pull-right login-btn">
			  
			   <?php if(empty($this->session->userdata('applicant_user_id')))
			    { ?>
				
				  <li>
				    <a href="#" data-toggle="modal" data-target="#myModal"><i class="fa fa-sign-in" aria-hidden="true" style="margin-right:5px;"></i> Login</a>
				  </li>
				
			    <?php } else {?>
				
				   	
				  <li>
				    <a href="<?php echo base_url()?>Frontend/logout">
				    <i class="fa fa-power-off" aria-hidden="true" style="margin-right:5px;"></i> Logout</a>
				  </li>
				
			     <?php }?>
			
			  </ul>
			
			</div>
		  
	  </nav> 
	  
   </div>	  
</section>



  <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    
	<div class="modal-content">
	
          <button type="button" class="close" data-dismiss="modal">&times;</button>
    
      <div class="modal-body">
	      <div class="account-box">
				<div class="account-wrapper">
				  <h3 class="account-title">Login</h3>
					<?php
					 	$attributes = array('class' => '', 'id' =>'user_login', 'name'=>'login_forrm','autocomplete'=> 'new-password');
     					echo form_open_multipart('Frontend/login/',$attributes);?> 
						<div class="form-group form-focus">
						    <label class="control-label">Username/Email<span class="required">*</span></label>
							<input class="form-control floating" autocomplete="off" type="text" name="email" placeholder="Username or Email">
							<span class = "text-danger"><?php echo form_error('email');?></span>
						</div>
						<div class="form-group form-focus">
						    <label class="control-label">Password<span class="required">*</span></label>
							<input class="form-control floating" autocomplete="new-password" type="password" id = "pwd" name="password" placeholder="Password" >
							<span class = "text-danger"><?php echo form_error('password');?></span>
						</div>
						
						<div class="form-group form-focus">
							<label class="control-label" style="display:block;">Type the Characters:</label>
							
							<div class="col-sm-6 nopadding">
							  <!-- <input type="hidden" id="txtCaptcha" name="Captcha_text" value="<?php //echo $captcha; ?>"> -->
                              <input ondrop="return false;" type="text" autocomplete="off" name="CaptchaInput" id="CaptchaInput" placeholder="Enter Captcha" class="form-control" maxlength="5" >
							  <span class = "text-danger"><?php echo form_error('CaptchaInput');?></span>
                                                          <span class="captcha-error"></span>
							</div>
							
							<div class="col-sm-6">
							 	<!-- <div id="CaptchaDiv" oncopy="return false"></div> -->
							 	<div id="CaptchaDiv_test" oncopy="return false" style="text-align: center;padding: 6px;width: 100px;font-size: 20px;color: #2662df;background: #b3d9ff;display: inline-block;"><?php echo $captcha; ?></div>
					    		<a href="javascript:void(0)" oncopy="return false" onclick="refreshCaptcha()" 
                                            style="font-size: 22px;margin-left: 20px;"><i class="fa fa-refresh"></i></a>
							</div>
							
						</div>
						
					
						<div class="form-group text-center">
							<button  onClick="mySubmit();" type="submit" name="submit" id="login_btn" class="btn btn-primary btn-block account-btn"> 
							 Login
							</button>
						</div>
						
					 <?php echo form_close();?>
				</div>
          </div>
      </div> 
    </div>
  </div>
</div>
   

	<script type="text/javascript">

           // Captcha Script
	 $('#CaptchaInput').bind('cut copy paste', function (e) {
           e.preventDefault();
          });

	// Captcha Script

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

	/*var a = Math.ceil(Math.random() * 9)+ '';
	var b = Math.ceil(Math.random() * 9)+ '';
	var c = Math.ceil(Math.random() * 9)+ '';
	var d = Math.ceil(Math.random() * 9)+ '';
	var e = Math.ceil(Math.random() * 9)+ '';

	var code = a + b + c + d + e;
	document.getElementById("txtCaptcha").value = code;
	document.getElementById("CaptchaDiv").innerHTML = code;*/
	
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
               	//document.getElementById("txtCaptcha").value = obj.msg;
                document.getElementById("CaptchaDiv_test").innerHTML = obj.msg;
                       
                     // return false;    
               }

               else
               {
                  
               }

              
            }
        
        });
		/*var f = Math.ceil(Math.random() * 9)+ '';
		var g = Math.ceil(Math.random() * 9)+ '';
		var h = Math.ceil(Math.random() * 9)+ '';
		var i = Math.ceil(Math.random() * 9)+ '';
		var j = Math.ceil(Math.random() * 9)+ '';

		var code = f + g + h + i + j;
		document.getElementById("txtCaptcha").value = code;
		document.getElementById("CaptchaDiv").innerHTML = code;*/
		
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

$('#login_bssssddddtn').on('click', function(event){
		
		var textcaptcha= $('#CaptchaInput').val();
		
		var divcaptcha= "<?php echo $this->session->userdata('valuecaptchaCode'); ?>";
		alert(divcaptcha);
		if(textcaptcha != divcaptcha){
			
			   var msg = 'Incorrect Captcha';
               $(".captcha-error").html(msg);
               $(".captcha-error").show();
               $('.captcha-error').css('color','red');
			
			    return false;
		}
		
	});
	</script>
     
