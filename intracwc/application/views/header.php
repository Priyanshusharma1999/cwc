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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style-front.css">
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/select2.min.css">
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
	  <img src="<?php echo base_url(); ?>assets/img/flag.jpg" alt="india flag image"> Government of India	
           
        </div>
    </div>
</div>

<section class="wrapper section-header-wrapper-top">
  <div class="container container-header">
    <div class="header-logo">
            <a href="<?php echo site_url();?>" title="Home" rel="home">
                <div class="logimg"><img src="<?php echo base_url();?>assets/img/cwc-logo2.png"></div>
		<div class="logtext"> 
                  <h1 class="logo">Central Water Commission</h1>
                  <p class="logo-text">(Serving the nation since 1945)</p>
               </div>
          </a>

	</div>
	<div class="header-logo-right">
		<a href="#" title="Home" rel="home">
			<img src="<?php echo base_url();?>assets/img/ministry-panel_1_1.png" alt="Home" style="width:60%;">
		</a>
	</div>
  </div>
</section>

<section class="wrapper section-header-wrapper">
  <div class="container container-header">
	   <ul class="nav navbar-nav links clearfix">
            <li class="active"><a href="http://cwc.gov.in/">Go to main website</a></li>
      </ul>
   </div>	  
</section>

<style>
  ul.links li a {
    color: #fff!important;
    display: block;
    font-size: 15px;
    text-transform: capitalize;
    padding: 15px 19px;
  }

 ul.links li a:hover {
    background: #f7541d!important;
    color: #fff!important;
 }

 ul.links li.active a{
    background: #f7541d!important;
    color: #fff!important;
}
</style>

