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
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/fullcalendar.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/select2.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/plugins/morris/morris.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>assets/css/print.min.css">

   
</head>

<body>

<section class="wrapper section-header-wrapper-top">

<div class="header-top">
   <div class="container">
    <div class="top-menu">
      <img src="http://itestweb.in/cwc/sites/all/themes/nexus/images/flag.jpg" alt="india flag image"> Government of India  
           <a href="javascript:void(0)" class="pull-right zoom" >A+</a>
           <a href="javascript:void(0)" class="pull-right zoom" >A</a>      
           <a href="javascript:void(0)" class="pull-right zoom" >A-</a>              
        </div>
    </div>
</div>

  <div class="container container-header">
       <div class="header-logo">
      <a href="#" title="Home" rel="home">
                <div class="logimg"><img src="<?php echo base_url();?>assets/img/cwc-logo2.png"></div>
        <div class="logtext"> 
                  <h1 class="logo">Central Water Commission</h1>
                  <p class="logo-text">(Serving the nation since 1945)</p>
               </div>
          </a>
       </div>
    <div class="header-logo-right">
        <a href="#" title="Home" rel="home">
            <img src="<?php echo base_url();?>assets/img/ministry-panel.png" alt="Home">
        </a>
    </div>
  </div>

<section class="wrapper section-header-wrapper">
  <div class="container container-header">
      <nav class="navbar navbar-default header-nav">
         
            <div class="collapse navbar-collapse header-nav nopadding">
             
            
            </div>
          
      </nav> 
      
   </div>     
</section>

</section>


