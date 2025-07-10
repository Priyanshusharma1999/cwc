<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

class Internalmessage extends CI_Controller {

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
      
        $data['message_list'] = $this->Base_model->get_all_record_by_condition('internal_message',
							 array('delete_status'=>0,'to_email'=>$this->session->userdata('applicant_email')));
						
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/internalmessage/inbox',$data);
		$this->load->view('admin/footer');	
	
	}

	public function inbox()
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
			$update_data = array(

					'read_status'     => 1,
					
				);
							
			$updateid = $this->Base_model->update_record_by_id('internal_message', $update_data, array('to_email'=> $this->session->userdata('applicant_email')));

	        $data['message_list'] = $this->Base_model->get_all_record_by_condition('internal_message',
								 array('delete_status'=>0,'to_email'=>$this->session->userdata('applicant_email')));
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/internalmessage/inbox',$data);
			$this->load->view('admin/footer');	
		}// ends else

       
	
	}//end function


	public function outbox()
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
			 $data['message_list'] = $this->Base_model->get_all_record_by_condition('internal_message',
							 array('delete_status'=>0,'from_email'=>$this->session->userdata('applicant_email')));
			 $this->load->view('admin/header');
			 $this->load->view('admin/sidebar');
			 $this->load->view('admin/internalmessage/outbox',$data);
			 $this->load->view('admin/footer');	
		}// ends else
      
	
	}// ends function
	
	
	public function compose_message()
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
			if(isset($_REQUEST['submit'])) 
		{
			
			$from_email  = $this->session->userdata('applicant_email');
			$to_email    = xss_clean($this->input->post('to_mail'));
			$subject     = xss_clean($this->input->post('subject'));
			$message     = xss_clean($this->input->post('message'));
			
			$this->form_validation->set_rules('to_mail','To Mail','trim|required');
			$this->form_validation->set_rules('subject','Subject','trim|required');
			$this->form_validation->set_rules('message','Message','trim|required');
			$this->form_validation->set_rules('message','Message','trim|required');
			

			if($this->form_validation->run() === false) 
				{
					$data['user_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id') ));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/internalmessage/composemessage',$data);
					$this->load->view('admin/footer');	
			
				} else {
					
					  date_default_timezone_set('Asia/Calcutta'); 
					  $created_date =  date("Y-m-d H:i:s"); 
					  $uploaded_file_name  = $_FILES['attach_file']['name'];
						
						$count_dots = substr_count($uploaded_file_name, '.');
						//echo "djdjdjdjdjd";echo "<pre>"; print_r($count_dots); exit;
						 $finfo = new finfo(FILEINFO_MIME_TYPE);


						if($count_dots > 1)
						{ 
								$msg = "Please upload correct file.";
								$this->session->set_flashdata('flashError_message', $msg);
								$data['user_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id') ));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/internalmessage/composemessage',$data);
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
							
				        	$msg = "Please upload file in correct format.";
							$this->session->set_flashdata('flashError_message', $msg);
							$data['user_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id') ));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/internalmessage/composemessage',$data);
							$this->load->view('admin/footer');	


						}

						else
						{ 
						$user_id =  $this->session->userdata('applicant_user_id'); 
						$user_name = $this->session->userdata('applicant_username');
						$pic_name = $user_name.'_'.$user_id.'_'.time().'_photo_';
						
						if($_FILES['attach_file']['name'])
						{
						  $configg = array(
									 'upload_path' => "./uploads/message_files/",
									 'allowed_types' => "jpg|png|jpeg|pdf|zip|gif|csv|xls|docx",
									 'overwrite' => TRUE,
									'max_size' => "4096000",  
									 'file_name' => $pic_name.$_FILES["attach_file"]['name'],
									 );              
						   $this->load->library('upload', $configg);
						   $this->upload->initialize($configg);
						   $img_namee= $_FILES['attach_file']['name'];
						   $this->load->library('upload',$configg);
						   $this->upload->initialize($configg);
						   if($this->upload->do_upload('attach_file'))
						  {  
							 $file_data = $this->upload->data();  
							 $img_namee = $file_data['orig_name'];
							 $file_path ='uploads/message_files/'.$img_namee;
						  }

						  else
						  {
							$error=$this->upload->display_errors();   
						  }
						}
						
						if(empty($img_namee))
						{
							$img_namee = '';
						}

						else
						{
							$img_namee = $img_namee;
						}
					  $insert_data = array(
									'from_email' 	    => $from_email,
									'to_email' 	        => $to_email,
									'subject' 	        => $subject,
									'message' 	        => $message,
									'file_name' 	    => $img_namee,
									'delete_status'     => 0,
									'created_date' 	    => $created_date,
									'updated_date' 	    => $created_date
									
								);
						$insertid = $this->Base_model->insert_one_row('internal_message', $insert_data);
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
									$mail->FromName = 'CWC Pension Itnernal Message';

									$mail->addAddress($to_email, $subject);     // Add a recipient
									$mail->addReplyTo('supportpension@gov.in', 'Pension Internal Message');

									$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
									$mail->isHTML(true);                                  // Set email format to HTML

									$mail->Subject = 'Pension Internal Message';
									$mail->Body    = "Dear " . $touser_data->FULLNAME . ",<br><br>";
									$mail->Body   .=   $message ."<br><br>";
									$mail->Body   .= " <br><br>
				                    --  Best Regards, <br>CWC Pension Team"; 

				                    $file_to_attach = base_url().'uploads/message_files/';
				                    //print_r($file_to_attach);exit;
									$mail->addStringAttachment(file_get_contents($file_to_attach), $img_namee);

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
											'ACTIVITY' 		=> $this->session->userdata('user_name').' send message to '.$to_email,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);
							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

 							/*********ends logs code*******/

							$msg = "Message send successfully.";
							$this->session->set_flashdata('flashSuccess_message',$msg);
							$data['message_list'] = $this->Base_model->get_all_record_by_condition('internal_message',
							 array('delete_status'=>0,'from_email'=>$this->session->userdata('applicant_email')));
							$user_id = $this->session->userdata('applicant_user_id');
							redirect('internalmessage/outbox/'.$user_id,$data);
							//redirect('internalmessage/outbox',$data);
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
											'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to send message to '.$to_email,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);
							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

 							/*********ends logs code*******/

							$msg = "Fail to send message";
							$this->session->set_flashdata('flashError_message', $msg);
							$data['user_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id') ));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/internalmessage/composemessage',$data);
							$this->load->view('admin/footer');	
						}
						}// ends else countdots

					 
					}
				

		}

		else
		{
			$data['user_list'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0,'USERS_ID!='=>$this->session->userdata('applicant_user_id') ));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/internalmessage/composemessage',$data);
			$this->load->view('admin/footer');	

		}

		}//ends else
		
	
	}//ends function
	
	public function delete_inbox(){
		
		$session_id = xss_clean($this->input->post('session_id'));
			$uri = $this->session->userdata('applicant_user_id');

			if($session_id!=$uri)
			{
				$base_url = base_url();
				redirect($base_url.'Frontend/logout');
			}

			else
			{
				date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s"); 
			//$delete_itemId = xss_clean($this->input->post('delete_itemId'));
			$delete_itemId = xss_clean($this->input->post('id'));
			
             $data['post_data'] = $post_data =  $this->Base_model->get_record_by_id('internal_message', array('id' => $delete_itemId));			
			
			$update_data = array(
					'from_email' 	    => $post_data->from_email,
					'to_email' 	        => $post_data->to_email,
					'subject' 	        => $post_data->subject,
					'message' 	        => $post_data->message,
					'file_name' 	    => $post_data->file_name,
					'delete_status'     => 1,
					'created_date' 	    => $created_date,
					'updated_date' 	    => $created_date
				);
							
			$updateid = $this->Base_model->update_record_by_id('internal_message', $update_data, array('id'=> $delete_itemId));

			/*********logs code*******/

			date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s");
			$user_logs_data = array(
							'USERNAME' 	    => $this->session->userdata('user_name'),
							'ROLE'			=> $this->session->userdata('user_role'),
							'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
							'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
							'LOGINSTATUS' 	=> 'Logged in',
							'ACTIVITY' 		=> $this->session->userdata('user_name').' delete message of '.$post_data->to_email,
							'ACTIVITYTIME'  => time(),
							'CREATEDDATED'  => $created_date
							
						);
			$this->Base_model->insert_one_row('userlogs', $user_logs_data);

			/*********ends logs code*******/

			$msg = "Message deleted successfully.";
			$this->session->set_flashdata('flashSuccess_message',$msg);					
			$data['message_list'] = $this->Base_model->get_all_record_by_condition('internal_message',array('delete_status'=>0,'to_email'=>$this->session->userdata('applicant_email')));
			$user_id = $this->session->userdata('applicant_user_id');
			redirect('internalmessage/inbox/'.$user_id,$data);
			//redirect('internalmessage/inbox',$data);

			}// ends else session check
		
	}// ends function


	public function delete_outbox(){
		
		$session_id = xss_clean($this->input->post('session_id'));
			$uri = $this->session->userdata('applicant_user_id');

			if($session_id!=$uri)
			{
				$base_url = base_url();
				redirect($base_url.'Frontend/logout');
			}

			else
			{
				date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s"); 
			//$delete_itemId = xss_clean($this->input->post('delete_itemId'));
			$delete_itemId = xss_clean($this->input->post('id'));
			
             $data['post_data'] = $post_data =  $this->Base_model->get_record_by_id('internal_message', array('id' => $delete_itemId));			
			
			$update_data = array(
					'from_email' 	    => $post_data->from_email,
					'to_email' 	        => $post_data->to_email,
					'subject' 	        => $post_data->subject,
					'message' 	        => $post_data->message,
					'file_name' 	    => $post_data->file_name,
					'delete_status'     => 1,
					'created_date' 	    => $created_date,
					'updated_date' 	    => $created_date
				);
							
			$updateid = $this->Base_model->update_record_by_id('internal_message', $update_data, array('id'=> $delete_itemId));
			
				/*********logs code*******/

			date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s");
			$user_logs_data = array(
							'USERNAME' 	    => $this->session->userdata('user_name'),
							'ROLE'			=> $this->session->userdata('user_role'),
							'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
							'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
							'LOGINSTATUS' 	=> 'Logged in',
							'ACTIVITY' 		=> $this->session->userdata('user_name').' delete message of '.$post_data->to_email,
							'ACTIVITYTIME'  => time(),
							'CREATEDDATED'  => $created_date
							
						);
			$this->Base_model->insert_one_row('userlogs', $user_logs_data);

			/*********ends logs code*******/

			$msg = "Message deleted successfully.";
			$this->session->set_flashdata('flashSuccess_message',$msg);					
			$data['message_list'] = $this->Base_model->get_all_record_by_condition('internal_message',array('delete_status'=>0,'from_email'=>$this->session->userdata('applicant_email')));
			$user_id = $this->session->userdata('applicant_user_id');
			redirect('internalmessage/outbox/'.$user_id,$data);
			//redirect('internalmessage/outbox',$data);
			
			}// ends else session check
		
	}// ends function
	
	
	public function view_message(){
		
		$uri = $this->uri->segment('3');
		$data['message_detail'] = $this->Base_model->get_record_by_id('internal_message', array('id' => $uri));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/internalmessage/viewmessage',$data);
		$this->load->view('admin/footer');
		
	}
	
	
	    public function search_inbox()
	    {
			if(isset($_REQUEST['submit'])){
					$from_mail = xss_clean($this->input->post('from_mail'));
					$data['message_list'] = $this->Base_model->search_inbox($from_mail);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/internalmessage/inbox',$data);
					$this->load->view('admin/footer');
			}
		
	    }

	     public function search_outbox()
	    {
			if(isset($_REQUEST['submit'])){
					$to_mail = xss_clean($this->input->post('to_mail'));
					$data['message_list'] = $this->Base_model->search_outbox($to_mail);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/internalmessage/outbox',$data);
					$this->load->view('admin/footer');
			}
		
	    }
	
}
