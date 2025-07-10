<?php

//require 'class.phpmailer.php';
//use PHPMailer\PHPMailer\PHPMailer;
//require 'PHPMailer\PHPMailerAutoload.php';
//require APPPATH . 'PHPMailer\PHPMailerAutoload.php';
//require('PHPMailer/PHPMailerAutoload.php');

use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

/*require_once "vendor/autoload.php";



use vendor\PHPMailer\PHPMailer\PHPMailer;
use vendor\PHPMailer\PHPMailer\Exception;*/


//error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Cron extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 
	 function __construct()
	 {
			parent::__construct();
			$this->load->model('Base_model');
	 }
	 
	 /*********index function********/

	 public function index()
	 { 
		$all_pension = $this->Base_model->get_allnotupdated_record();
			
			$pension_data = array();
			foreach ($all_pension as $all_records) 
			{
				$pension['pension_id'] = $all_records->PENSION_ID;
				$pension['orgnstn_id'] = $all_records->ORGANISATION;
				$pension['user_name'] = $all_records->EMPLY_NAME;
				$pension['ppo_no'] = $all_records->PPO_NO;
				$pension['pension_status'] = $all_records->PENSION_STATUS;
				$pension_data[] = $pension;
			}

			
			$unique_organisation = $this->uniqueAssocArray($pension_data, 'orgnstn_id');
			
			// for ppo user list
			$pensionppo_userstatusdata = array();
			foreach ($unique_organisation as $pendingusersppo) 
			{
				$all_pendingppo = $this->Base_model->get_allnotupdated_ppouserrecord($pendingusersppo['pension_id']);

					if(!empty($all_pendingppo))
					{
							$pendingppopensiondatta = $this->Base_model->get_record_by_id('pensrecoinfo',array('PENSION_ID'=>$pendingusersppo['pension_id']));

							$pensionppo_userstatus['pension_id'] = $pendingppopensiondatta->PENSION_ID;
							$pensionppo_userstatus['orgnstn_id'] = $pendingppopensiondatta->ORGANISATION;
							$pensionppo_userstatus['user_name'] = $pendingppopensiondatta->EMPLY_NAME;
							$pensionppo_userstatus['ppo_no'] = $pendingppopensiondatta->PPO_NO;
							$pensionppo_userstatus['pension_status'] = $pendingppopensiondatta->PENSION_STATUS;
							$pensionppo_userstatusdata[] = $pensionppo_userstatus;
					}
			}// ends foreach

			

			// pension list
			$all_pension_list = array();
			foreach ($all_pension as $all_pension_list_name) 
			{
				$all_pension_list[] = 'Name: '.$all_pension_list_name->EMPLY_NAME.' , '.'PPO No: '.$all_pension_list_name->PPO_NO;
			}
			
			$pensionor_list = implode('<br/>',$all_pension_list);

			// for super_admin users
			$users = array();
			foreach ($unique_organisation as $orgn_data) 
			{
				$all_users = $this->Base_model->get_all_record_by_condition('users', array('ORGANIZATION_ID'=>$orgn_data['orgnstn_id'],'ROLE_ID'=> 1));


				foreach ($all_users as $uu) 
				{
					$users[] = $uu;
				}
			}

			/***********Ends super admin users list ************/
			//echo "<pre>"; print_r($users); exit;
			// for PPO admin users

			$ppousers = array();
			foreach ($pensionppo_userstatusdata as $ppo_orgn_data) 
			{ 
				//print_r($ppo_orgn_data['orgnstn_id']); exit;
				$all_ppousers = $this->Base_model->get_all_record_by_condition('users', array('ORGANIZATION_ID'=>$ppo_orgn_data['orgnstn_id'],'ROLE_ID'=> 3));


				foreach ($all_ppousers as $uu_ppo) 
				{
					$ppousers[] = $uu_ppo;
				}
			}

			/***********Ends ppo users list ************/
			
			/*************Email Code for super admin users ************/

			foreach ($users as $user_data) 
			{
				   //$message     = "Dear " . $user_data->FULLNAME . ",<br><br>";
            	   //$message    .= "It has been observed by system that follwing pension records has not been updated since last month, Please take necessary action on this, Please ignore if already action has been taken.<br><br>";
            	   // $message   .= $pensionor_list;
            	   //$message    .= " <br><br>
                    //--  Best Regards, <br>CWC Team"; 
			    /*$this->load->library('email');
				  $this->email->set_mailtype("html");
				  $this->email->from('sriabhinav7071@gmail.com');
				  $this->email->to($user_data->EMAIL);
				  $this->email->subject('Alerts-Pension Records Status');
				  $this->email->message($message);
				  $this->email->send();*/
		
						  $mail = new PHPMailer;

						  $mail->Host = 'relay.nic.in';  // Specify main and backup SMTP servers
							$mail->SMTPAuth = false;                               // Enable SMTP authentication
							$mail->Username = 'supportpension@gov.in';                 // SMTP username
							$mail->Password = 'abcdef';                           // SMTP password
							$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
							$mail->Port = 25;                                    // TCP port to connect to
							$mail->SMTPDebug = 1;

							$mail->From = 'supportpension@gov.in';
							$mail->FromName = 'CWC Pension';

							$mail->addAddress($user_data->EMAIL, 'Pension Check User');     // Add a recipient
							$mail->addReplyTo('supportpension@gov.in', 'Information');

							$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
							$mail->isHTML(true);                                  // Set email format to HTML

							$mail->Subject = 'Pension Record Status';
							$mail->Body    = "Dear " . $user_data->FULLNAME . ",<br><br>";
							$mail->Body   .= "It has been observed by system that follwing pension records has not been updated since last month, Please take necessary action on this, Please ignore if already action has been taken.<br><br>";
							$mail->Body   .= $pensionor_list;
							$mail->Body   .= " <br><br>
		                    --  Best Regards, <br>CWC Pension Team"; 

		          $mail->send();
		         
			}

			/***********Ends Email Code************/

			/****************Email for PPO users code*****************/

				if(!empty($ppousers))
				{
						foreach ($ppousers as $ppouser_data) 
						{
								$mail = new PHPMailer;

							  $mail->Host = 'relay.nic.in';  // Specify main and backup SMTP servers
								$mail->SMTPAuth = false;                               // Enable SMTP authentication
								$mail->Username = 'supportpension@gov.in';                 // SMTP username
								$mail->Password = 'abcdef';                           // SMTP password
								$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
								$mail->Port = 25;                                    // TCP port to connect to
								$mail->SMTPDebug = 1;

								$mail->From = 'supportpension@gov.in';
								$mail->FromName = 'CWC Pension';

								$mail->addAddress($ppouser_data->EMAIL, 'Pension Check Pending PPO User');     // Add a recipient
								$mail->addReplyTo('supportpension@gov.in', 'Pension Check Pending PPO User');

								$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
								$mail->isHTML(true);                                  // Set email format to HTML

								$mail->Subject = 'Pension Record Status';
								$mail->Body    = "Dear " . $ppouser_data->FULLNAME . ",<br><br>";
								$mail->Body   .= "It has been observed by system that follwing pension records has not been updated since last month, Please take necessary action on this, Please ignore if already action has been taken.<br><br>";
								$mail->Body   .= $pensionppo_userstatusdata;
								$mail->Body   .= " <br><br>
			                    --  Best Regards, <br>CWC Pension Team"; 

			          $mail->send();

						}// ends foreach popusers
				}//  ends if popusers
				
			/************Ends email for emaail PPO users code*********/

			/*************SMS Code************/

			foreach ($users as $user_data) 
			{
				   $this->load->library('twilio');

				   $message     = "Dear " . $user_data->FULLNAME . ",<br><br>";
            	   $message    .= "It has been observed by system that follwing pension records has not been updated since last month, Please take necessary action on this, Please ignore if already action has been taken.<br><br>";
            	    $message   .= $pensionor_list;
            	   $message    .= " <br><br>
                    --  Best Regards, <br>CWC Team"; 

				   $send_msg = $this->twilio->sms('+12674364463', '+91'.$user_data->MOBILE, 'New SMS From CWC: '.$message);

         
			}

			/***********Ends SMS Code************/

			echo "Sent Successfully.";


	 }//ends function


	 public function uniqueAssocArray($array, $uniqueKey) 
	 {
		  if (!is_array($array)) {
		    return array();
		  }
		  $uniqueKeys = array();
		  foreach ($array as $key => $item) {
		    if (!in_array($item[$uniqueKey], $uniqueKeys)) {
		      $uniqueKeys[$item[$uniqueKey]] = $item;
		    }
		  }
		  return $uniqueKeys;
	}// ends function


	// php mailer

	public function miler()
	{ 
			$mail = new PHPMailer;

			//$mail->SMTPDebug = 3;                               // Enable verbose debug output

			//$mail->isSMTP();                                      // Set mailer to use SMTP
			$mail->Host = 'relay.nic.in';  // Specify main and backup SMTP servers
			$mail->SMTPAuth = false;                               // Enable SMTP authentication
			$mail->Username = 'supportpension@gov.in';                 // SMTP username
			$mail->Password = 'abcdef';                           // SMTP password
			$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
			$mail->Port = 25;                                    // TCP port to connect to
			$mail->SMTPDebug = 1;

			$mail->From = 'supportpension@gov.in';
			$mail->FromName = 'Test CWC Pension';
			$mail->addAddress('sriabhinav7071@gmail.com', 'Pension Check User');     // Add a recipient
			//$mail->addAddress('ellen@example.com');               // Name is optional
			$mail->addReplyTo('supportpension@gov.in', 'Information');
			//$mail->addCC('cc@example.com');
			//$mail->addBCC('bcc@example.com');

			$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
			//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
			//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
			$mail->isHTML(true);                                  // Set email format to HTML

			$mail->Subject = 'Here is the subject';
			$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			if(!$mail->send()) {
			    echo 'Message could not be sent.';
			    echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
			    echo 'Message has been sent';
			}

	}// ends function

	

}


