<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="<?= $this->security->get_csrf_hash(); ?>">
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>assets/img/favicon.ico">
    <title>Central Water Commission</title>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style-front.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/responsive.css">
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
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

<section class="wrapper section-header-wrapper">
  <div class="container container-header">
	  <nav class="navbar navbar-default header-nav">
		 
			<div class="collapse navbar-collapse header-nav nopadding">
			  <ul class="nav navbar-nav links clearfix">
				<li class="first"><a href="<?php echo site_url();?>" class="<?php if(($this->uri->segment(2))==''){ echo 'active'; } ?>">Home</a></li>

				 <?php
                 if($this->session->userdata('applicant_user_id') || $this->session->userdata('auser_id'))
			 	{?>
				
				 <li>
				 <a href="<?php echo base_url()?>Frontend/logout">Logout</a>
			  </li>

			  <li>
				 <a href="<?php echo base_url('Applicant/dashboard/'.$this->session->userdata('applicant_user_id'))?>">Dashboard</a>
			  </li>


			<?php } else {?>
              
			  <li>
				 <a href="javascript:void(0);" class="<?php if(($this->uri->segment(2))=='register' || ($this->uri->segment(2))=='login'){ echo 'active'; } ?>">   Apply Here
				 </a>
				
				 <ul class="sub">
					<li><a href="<?php echo site_url();?>frontend/register">New Applicant</a></li>
					<li><a href="<?php echo site_url();?>frontend/login" >Registered Applicant</a></li>
				 </ul>
				</li>
				
				<li><a href="<?php echo site_url();?>frontend/adminnew" class="<?php if(($this->uri->segment(2))=='adminnew'){ echo 'active'; } ?>">Admin</a></li>

			<?php } ?>

			  <li><a href="http://cwc.gov.in/">Go to main website</a></li>
				
			  </ul>
				
			</div>
		  
	  </nav> 

	    <span style="float: right;padding: 12px;font-size: 18px;color: #fff;font-weight:900;">Work Charged Recruitment System</span>

	  
   </div>	  
</section>

