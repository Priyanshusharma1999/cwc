<?php
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Email extends CI_Controller {

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
			
			$coookie_ci_value = $this->input->cookie('ci_session', TRUE);

			$session_cookie_value = $this->session->userdata('asession_cookie');
			
			if(empty($this->session->userdata('applicant_user_id')))
			 {
				$base_url = base_url();
				 redirect($base_url.'Frontend/logout');
			 } 

			 if($coookie_ci_value != $session_cookie_value )
			 {
				$base_url = base_url();
				 redirect($base_url.'Frontend/logout');
			 } 
	}
	 
	public function index()
	{

		$segment_id = $this->uri->segment('3');
		$uri = $this->session->userdata('applicant_user_id');

		if($segment_id!=$uri)
		{
			$base_url = base_url();
			redirect($base_url.'Frontend/logout');
		}

		else
		{
			 $data['mail_list'] = $this->Base_model->get_all_record_by_condition('email',array('deletes'=>0,'from_email'=>$this->session->userdata('applicant_email')));	
		
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/email/inbox',$data);
			$this->load->view('admin/footer');	
		}//ends else
       
	
	}//ends function
	
	
	public function smslist()
	{
		$segment_id = $this->uri->segment('3');
		$uri = $this->session->userdata('applicant_user_id');

		if($segment_id!=$uri)
		{
			$base_url = base_url();
			redirect($base_url.'Frontend/logout');
		}

		else
		{
			$data['sms_list'] = $this->Base_model->get_all_record_by_condition('sms',array('deletes'=>0));	
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/email/sms',$data);
			$this->load->view('admin/footer');	
		}//ends else
        
	
	}//ends function
	
	
	public function send_sms()
	{
			
		if(isset($_REQUEST['submit'])) 
		{
			$mobile_no   = xss_clean($this->input->post('mobile_no'));
			$message     = xss_clean($this->input->post('message'));
			
			$this->form_validation->set_rules('mobile_no','mobile no','trim|required');
			$this->form_validation->set_rules('message','message','trim|required');
			

			if($this->form_validation->run() === false) 
			   {
				
				    $data['users_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id')));	
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/email/sendsms',$data);
					$this->load->view('admin/footer');	
			
			    } else {
					
					  date_default_timezone_set('Asia/Calcutta'); 
					  $created_date =  date("Y-m-d H:i:s"); 
					  
					
				$this->load->library('twilio');
			    $send_msg = $this->twilio->sms('+12674364463', '+91'.$mobile_no, 'New SMS From CWC: '.$message);
				
					  $insert_data = array(
									'mobile_no' 	    => $mobile_no,
									'message' 	        => $message,
									'deletes'           => 0,
									'send_date' 	    => $created_date
								);
						$insertid = $this->Base_model->insert_one_row('sms', $insert_data);

						if($insertid)
						{
						/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' send sms to '.$mobile_no,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);
						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/

							$msg = "SMS send successfully.";
							$this->session->set_flashdata('flashSuccess_sms',$msg);
							$data['sms_list'] = $this->Base_model->get_all_record_by_condition('sms',
							 array('deletes'=>0));
							$user_id = $this->session->userdata('applicant_user_id');
							redirect('email/smslist/'.$user_id,$data);
							//redirect('email/smslist',$data);
						}

						else
						{
							/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to send sms to '.$mobile_no,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);
						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/

							$msg = "Fail to send sms";
							$this->session->set_flashdata('flashError_sms', $msg);
							$data['users_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id')));	
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/email/sendsms',$data);
							$this->load->view('admin/footer');	
						}
					}
				

		}

		else
		{
			$data['users_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id')));	
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/email/sendsms',$data);
			$this->load->view('admin/footer');	

		}
	
	
	}
	
	
	public function compose_mail()
	{
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$from_email  = $this->session->userdata('applicant_email');
			$to_email    = xss_clean($this->input->post('to_mail'));
			$subject     = xss_clean($this->input->post('subject'));
			$message     = xss_clean($this->input->post('message'));
			
			$this->form_validation->set_rules('to_mail','to mail','trim|required');
			$this->form_validation->set_rules('subject','subject','trim|required');
			$this->form_validation->set_rules('message','message','trim|required');
			

			if($this->form_validation->run() === false) 
			   {
				$data['user_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id')));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/email/composemail',$data);
					$this->load->view('admin/footer');	
			
			    } else {
					
					  date_default_timezone_set('Asia/Calcutta'); 
					  $created_date =  date("Y-m-d H:i:s"); 
					  
					  $uploaded_file_name  = $_FILES['attach_file']['name'];
						
						$count_dots = substr_count($uploaded_file_name, '.');

						 $finfo = new finfo(FILEINFO_MIME_TYPE);


						if($count_dots > 1)
						{

							$data['user_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id')));
							$msg = "Please upload correct file.";
							$this->session->set_flashdata('flashError_mail', $msg);
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/email/composemail',$data);
							$this->load->view('admin/footer');	

						} else if(!empty($_FILES['attach_file']['tmp_name'])&&false === $ext = array_search(
				        
				        $finfo->file($_FILES['attach_file']['tmp_name']),
				        array(
				            'pdf' => 'application/pdf',
				             'jpg' => 'image/jpeg',
				            'png' => 'image/png',
				        ),
				        true

				        )){

			        	$data['user_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id')));
							$msg = "Please upload file in correct format.";
							$this->session->set_flashdata('flashError_mail', $msg);
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/email/composemail',$data);
							$this->load->view('admin/footer');	


						}

						else
						{
								 	/***********File upload code*******/
						$user_id =  $this->session->userdata('applicant_user_id'); 
						$user_name = $this->session->userdata('applicant_username');
						$pic_name = $user_name.'_'.$user_id.'_'.time().'_photo_';
						
						if($_FILES['attach_file']['name'])
						{
						  $configg = array(
									 'upload_path' => "./uploads/email_files/",
									 'allowed_types' => "jpg|png|jpeg|pdf|zip|gif|csv|xls|docx",
									 'overwrite' => TRUE,
									 'max_size' => "4096000",  
									 'file_name' => $pic_name.$_FILES["attach_file"]['name'],
									 );              
						   $this->load->library('upload', $configg);
						   $this->upload->initialize($configg);
						   $img_namee= $_FILES['attach_file']['name'];
						   $pic['item_image']= $img_namee;
						   $this->load->library('upload',$configg);
						   $this->upload->initialize($configg);
						   if($this->upload->do_upload('attach_file'))
						  {  
							 $file_data = $this->upload->data();  
							 $img_namee = $file_data['orig_name'];
							 $file_path ='uploads/email_files/'.$img_namee;
						  }

						  else
						  {
							$error=$this->upload->display_errors();   
						  }
						}

					/********Ends file upload code******/
					
					/*$this->load->library('email');
					$this->email->set_mailtype("html");
					$this->email->from($from_email);
					$this->email->to($to_email);
					$this->email->subject($subject);
					$this->email->message($message);
					$this->email->attach($file_path);
					$this->email->send();*/
					
					  $insert_data = array(
									'from_email' 	    => $from_email,
									'to_email' 	        => $to_email,
									'subject' 	        => $subject,
									'message' 	        => $message,
									'deletes'           => 0,
									'send_date' 	    => $created_date
								);
						$insertid = $this->Base_model->insert_one_row('email', $insert_data);
						$touser_data =  $this->Base_model->get_record_by_id('users', array('EMAIL' => $to_email));	

						/**********Mail Code**********/

							$mail = new PHPMailer;

								    $mail->Host = 'relay.nic.in';  // Specify main and backup SMTP servers
									$mail->SMTPAuth = false;                               // Enable SMTP authentication
									$mail->Username = 'supportpension@gov.in';                 // SMTP username
									$mail->Password = 'abcdef';                           // SMTP password
									$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
									$mail->Port = 25;                                    // TCP port to connect to
									$mail->SMTPDebug = 1;

									$mail->From ='supportpension@gov.in';
									$mail->FromName = 'CWC Pension Email';

									$mail->addAddress($to_email, $subject);     // Add a recipient
									$mail->addReplyTo('supportpension@gov.in', 'Pension Email');

									$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
									$mail->isHTML(true);                                  // Set email format to HTML

									$mail->Subject = 'Pension Email';
									$mail->Body    = "Dear " . $touser_data->FULLNAME . ",<br><br>";
									$mail->Body   .=   $message ."<br><br>";
									$mail->Body   .= " <br><br>
				                    --  Best Regards, <br>CWC Pension Team"; 

				                    
				                    //print_r($file_to_attach);exit;
									$mail->addStringAttachment(file_get_contents($file_path));

				          			$send = $mail->send();

				          

						/******Ends Mail Code*********/


						if($insertid)
						{
						/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' send mail to '.$to_email,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);
						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/

							$msg = "Mail send successfully.";
							$this->session->set_flashdata('flashSuccess_mail',$msg);
							$data['mail_list'] = $this->Base_model->get_all_record_by_condition('email',
							 array('deletes'=>0,'from_email'=>$this->session->userdata('applicant_email')));
							$user_id = $this->session->userdata('applicant_user_id');
							redirect('email/index/'.$user_id,$data);
							//redirect('email',$data);
						}

						else
						{
													/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to send mail to '.$to_email,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);
						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/

							$data['user_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id')));
							$msg = "Fail to send mail";
							$this->session->set_flashdata('flashError_mail', $msg);
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/email/composemail',$data);
							$this->load->view('admin/footer');	
						}
						}//ends else coount dots

							
					 
					}
				

		}

		else
		{
			$data['user_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id')));	
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/email/composemail',$data);
			$this->load->view('admin/footer');	

		}
	
	}// ends function
	
	public function delete_mail(){
		
		date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s"); 
			//$delete_itemId = xss_clean($this->input->post('delete_itemId'));
			$delete_itemId = xss_clean($this->input->post('id'));
			
             $data['post_data'] = $post_data =  $this->Base_model->get_record_by_id('email', array('id' => $delete_itemId));			
			
			$update_data = array(
					'from_email' 	    => $post_data->from_email,
					'to_email' 	        => $post_data->to_email,
					'subject' 	        => $post_data->subject,
					'message' 	        => $post_data->	message,
					'deletes'       	=> 1,
					'send_date' 	    => $post_data->send_date
				);
							
			$updateid = $this->Base_model->update_record_by_id('email', $update_data, array('id'=> $delete_itemId));
						
						/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' delete mail of '.$post_data->to_email,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);
						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/
			$msg = "Mail deleted successfully.";
			$this->session->set_flashdata('flashSuccess_mail',$msg);					
			$data['mail_list'] = $this->Base_model->get_all_record_by_condition('email',array('deletes'=>0,'from_email'=>$this->session->userdata('applicant_email')));
			$user_id = $this->session->userdata('applicant_user_id');
			redirect('email/index/'.$user_id,$data);
			//redirect('email',$data);
	}
	
	
	public function delete_sms(){
		
		date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s"); 
			//$delete_itemId = xss_clean($this->input->post('delete_itemId'));
			$delete_itemId = xss_clean($this->input->post('id'));
			
             $data['post_data'] = $post_data =  $this->Base_model->get_record_by_id('sms', array('id' => $delete_itemId));			
			
			$update_data = array(
					'mobile_no' 	        => $post_data->mobile_no,
					'message' 	        => $post_data->message,
					'deletes'       	=> 1,
					'send_date' 	    => $post_data->send_date
				);
							
			$updateid = $this->Base_model->update_record_by_id('sms', $update_data, array('id'=> $delete_itemId));
			
									/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' delete sms of '.$post_data->mobile_no,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);
						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/

			$msg = "SMS deleted successfully.";
			$this->session->set_flashdata('flashSuccess_sms',$msg);					
			$data['sms_list'] = $this->Base_model->get_all_record_by_condition('sms',array('deletes'=>0));
			$user_id = $this->session->userdata('applicant_user_id');
			redirect('email/smslist/'.$user_id,$data);
			//redirect('email/smslist',$data);
	}
	
	public function view_mail(){
		
		$uri = $this->uri->segment('3');
		$data['mail_detail'] = $this->Base_model->get_record_by_id('email', array('id' => $uri));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/email/viewemail',$data);
		$this->load->view('admin/footer');
		
	}
	
	
	    public function search_mail()
	    {
			if(isset($_REQUEST['submit'])){
					$from_mail = xss_clean($this->input->post('from_mail'));
					$to_mail = xss_clean($this->input->post('to_mail'));
					$data['mail_list'] = $this->Base_model->search_mail($from_mail,$to_mail);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/email/inbox',$data);
					$this->load->view('admin/footer');
			}
		
	    }
		
		public function search_sms()
	    {
			if(isset($_REQUEST['submit'])){
					$mobile_no = xss_clean($this->input->post('mobile_no'));
					$data['sms_list'] = $this->Base_model->search_sms($mobile_no);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/email/sms',$data);
					$this->load->view('admin/footer');
			}
		
	    }
	
}
