<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	// Initialize Constructor Here
	function __construct()
	{
			parent::__construct();
			$this->load->model('Base_model');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));
		$this->load->view('header');
		$this->load->view('index',$data);
		$this->load->view('footer');

	}//ends function
	
	
	
	public function adminnew()
	{

			if(isset($_REQUEST['submit'])) 
			{
					$user_name 			= xss_clean($this->input->post('user'));
					$password 			= xss_clean($this->input->post('password'));
					$captcha_text 		= xss_clean($this->input->post('Captcha_text'));
					$captcha_input 		= xss_clean($this->input->post('CaptchaInput'));

					
					$this->form_validation->set_rules('user','UserId','trim|required');
					$this->form_validation->set_rules('password','Password','trim|required');
					$this->form_validation->set_rules('CaptchaInput','Captcha','trim|required');
					
					if($this->form_validation->run() === false) 
					{
						
							$data['insertData'] = array(
								'user' => xss_clean($this->input->post('user')),
								'password' => xss_clean($this->input->post('password')),
								'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
							);


							$this->load->view('header');
							$this->load->view('adminnew', $data);
							$this->load->view('footer');

					}//ends if

					else
					{
						/*******Check Captcha*******/
						if($captcha_text!=$captcha_input)
						{
							$msg = "Please enter correct captcha code";
							$this->session->set_flashdata('flashError', $msg);
							$this->load->view('header');
							$this->load->view('adminnew');
							$this->load->view('footer');
						}

					/****Ends Captcha Code******/

						else
						{
							$user_name 			= xss_clean($this->input->post('user'));
							$password 			= xss_clean($this->input->post('password'));

							$table = 'tbl_admin';
							$data = array(
									'user_id' 		 => $user_name,
									'password' => md5($password)
								);

							$user = $this->Base_model->get_login_data($table, $data);

							if($user)
							{
									$newdata = array(
									'auser_id' => $user[0]['Id'],
									'aemail' => $user[0]['email'],
									'auser_type' => $user[0]['user_type'],
									'alogged_in' => TRUE,
									'ausername' => $user[0]['name']
								);
								
								$this->session->set_userdata($newdata);

								if($user[0]['user_type'] == 1) 
								{
									
									redirect($base_url.'Superadmin');
								} 
								elseif($user[0]['user_type'] == 3)
								{
									
									redirect($base_url.'Circle');
								}

							}//ends if

							else
							{
									$msg = "Your userid or password is wrong";
									$this->session->set_flashdata('flashError', $msg);
									$this->load->view('header');
									$this->load->view('adminnew');
									$this->load->view('footer');	

							}//ends else
						}//ends else capcha elsee
					}//ends main else	
			}//ends main if

			else
			{
				$this->load->view('header');
				$this->load->view('adminnew');
				$this->load->view('footer');	
			}//ends else
			
		
	}//ends function

	/**************Logout Function*************/
	public function logout()
	{
			$base_url = base_url().'Frontend/adminnew';
			if ($this->session->userdata('auser_id')) {
					$this->session->unset_userdata('auser_id');
					$this->session->sess_destroy();
					redirect($base_url);
			} 
			else
			 {
				$base_url = base_url().'Frontend/adminnew';
				redirect($base_url);
			 }
	}// ends function
	
	
	/**********function for applicant registereation**********/
	public function register()
	{
		
   
		if(isset($_REQUEST['submit'])) 
			{

					$applicant_name 	= xss_clean($this->input->post('applicant_name'));
					$email 						= xss_clean($this->input->post('email'));
					$mobile_no 				= xss_clean($this->input->post('mobile_no'));
					$gender 					= xss_clean($this->input->post('gender'));
					$dob 							= xss_clean($this->input->post('dob'));
					$captcha_text 		= xss_clean($this->input->post('Captcha_text'));
					$captcha_input 		= xss_clean($this->input->post('CaptchaInput'));

					
					$this->form_validation->set_rules('applicant_name','applicant name','trim|required');
					$this->form_validation->set_rules('email','email','trim|required');
					$this->form_validation->set_rules('mobile_no','mobile no.','trim|required');
					$this->form_validation->set_rules('gender','gender','trim|required');
					$this->form_validation->set_rules('dob','dob','trim|required');
					$this->form_validation->set_rules('CaptchaInput','Captcha','trim|required');

					if($this->form_validation->run() === false) 
					{
						
							$data['insertData'] = array(
								'applicant_name' => xss_clean($this->input->post('applicant_name')),
								'email' 		=> xss_clean($this->input->post('email')),
								'mobile_no' => xss_clean($this->input->post('mobile_no')),
								'gender' => xss_clean($this->input->post('gender')),
								'dob' => xss_clean($this->input->post('dob')),
								'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
							);


							$this->load->view('header');
							$this->load->view('register', $data);
							$this->load->view('footer');

					}//ends if

					else
					{
						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s"); 

						/*****check applicant********/

						$checked_applicant = $this->Base_model->check_existent('tbl_applicant', array('email' => $email));
						$checked_phone_exits = $this->Base_model->check_existent('tbl_verification', array('mobile_no' => $mobile_no));
						$checked_email_exits = $this->Base_model->check_existent('tbl_verification', array('email' => $email));

						$checked_email_verify = $this->Base_model->check_existent('tbl_verification', array('email' => $email,'status_email'=>'0'));
					
						$checked_phone_verify = $this->Base_model->check_existent('tbl_verification', array('mobile_no' => $mobile_no,'status_mobile'=>'0'));

					/*****ends check applicant*****/

					/*******Check Captcha*******/

					/*if($checked_email_exits =='0')
						{
							
							$msg = "Please verify your correct email";
							$data['insertData'] = array(
								'applicant_name' => xss_clean($this->input->post('applicant_name')),
								'email' 		=> xss_clean($this->input->post('email')),
								'mobile_no' => xss_clean($this->input->post('mobile_no')),
								'gender' => xss_clean($this->input->post('gender')),
								'dob' => xss_clean($this->input->post('dob')),
								'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
							);
							$this->session->set_flashdata('flashError_applicant', $msg);
							$this->load->view('header');
							$this->load->view('register',$data);
							$this->load->view('footer');
						}*/

						 if($checked_phone_exits =='0')
						{
							$msg = "Please verify your correct mobile no";
							$data['insertData'] = array(
								'applicant_name' => xss_clean($this->input->post('applicant_name')),
								'email' 		=> xss_clean($this->input->post('email')),
								'mobile_no' => xss_clean($this->input->post('mobile_no')),
								'gender' => xss_clean($this->input->post('gender')),
								'dob' => xss_clean($this->input->post('dob')),
								'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
							);
							$this->session->set_flashdata('flashError_applicant', $msg);
							$this->load->view('header');
							$this->load->view('register',$data);
							$this->load->view('footer');
						}

						/*else if($checked_email_verify =='1')
						{
							$msg = "Please verify your email";
							$data['insertData'] = array(
								'applicant_name' => xss_clean($this->input->post('applicant_name')),
								'email' 		=> xss_clean($this->input->post('email')),
								'mobile_no' => xss_clean($this->input->post('mobile_no')),
								'gender' => xss_clean($this->input->post('gender')),
								'dob' => xss_clean($this->input->post('dob')),
								'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
							);
							$this->session->set_flashdata('flashError_applicant', $msg);
							$this->load->view('header');
							$this->load->view('register',$data);
							$this->load->view('footer');
						}*/

						else if ($checked_phone_verify == '1')
						{
							$msg = "Please verify your mobile no";
							$data['insertData'] = array(
								'applicant_name' => xss_clean($this->input->post('applicant_name')),
								'email' 		=> xss_clean($this->input->post('email')),
								'mobile_no' => xss_clean($this->input->post('mobile_no')),
								'gender' => xss_clean($this->input->post('gender')),
								'dob' => xss_clean($this->input->post('dob')),
								'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
							);
							$this->session->set_flashdata('flashError_applicant', $msg);
							$this->load->view('header');
							$this->load->view('register',$data);
							$this->load->view('footer');
						}
						
						else if($captcha_text!=$captcha_input)
						{
							$msg = "Please enter correct captcha code";
							$data['insertData'] = array(
								'applicant_name' => xss_clean($this->input->post('applicant_name')),
								'email' 		=> xss_clean($this->input->post('email')),
								'mobile_no' => xss_clean($this->input->post('mobile_no')),
								'gender' => xss_clean($this->input->post('gender')),
								'dob' => xss_clean($this->input->post('dob')),
								'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
							);
							$this->session->set_flashdata('flashError_applicant', $msg);
							$this->load->view('header');
							$this->load->view('register',$data);
							$this->load->view('footer');
						}

					/****Ends Captcha Code******/

					else if($checked_applicant == '1')
							{
								$msg = "User already registerd, Please enter new account";
								$this->session->set_flashdata('flashError_applicant', $msg);
								$data = '';
								$this->load->view('header');
								$this->load->view('register', $data);
								$this->load->view('footer');

							}//ends if


							else
							{
									$insert_data = array(
													'name' 								=> $applicant_name,
													'email' 							=> $email,
													'mobile_no' 					=> $mobile_no,
													'gender' 							=> $gender,
													'dob' 								=> $dob,
													'created_date' 				=> $created_date,
													'updated_date' 				=> $created_date
												);
									$insertid = $this->Base_model->insert_one_row('tbl_applicant', $insert_data);
									$user_data = $this->Base_model->get_all_record_by_condition('tbl_applicant', array('id' => $insertid));

									if($insertid)
											{
												$from         = "CWC Password";
												$to         	= $user_data[0]->email;
						            //Email Body
						            $message     = "Hello " . $user_data[0]->name . ",<br><br>";
						            $message    .= "Please check your password for login is 7777. <br><br>";
						            $message    .= " <br><br>
						                    --  Best Regards, <br>CWC Team";

						            /*Setting Content Type*/
						            $headers    = "MIME-Version: 1.0" . "\r\n";
						            $headers   .= "Content-type:text/html;charset=UTF-8" . "\r\n";
						            /*Setting More Headers*/
						            $headers   .= 'From: <sriabhinav7071@gmail.com>' . "\r\n";

						            $email_sent  = mail($to, $subject, $message, $headers);

						            /**********random password*****/
														$length = '5';
														$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
												    $charactersLength = strlen($characters);
												    $randomString = '';
												    for ($i = 0; $i < $length; $i++) {
												        $randomString .= $characters[rand(0, $charactersLength - 1)];
												    }

						            /**Ends random pwd**/

						            $update_data = array(
						            			'password' => md5($randomString)
						            		);

												$this->load->library('twilio');
												$send_otp = $this->twilio->sms('+12674364463', '+91'.$mobile_no, 'Your Password is: '.$randomString);
						            $this->Base_model->update_record_by_id('tbl_applicant', $update_data, array('id'=> $insertid));
												$msg = "Registered successfully, Please check your mail for password and login.";
												/*$this->session->set_flashdata('flashSuccess_applicant',$msg);*/
												$this->session->set_flashdata('flashSuccess_applicant_login',$msg);
												$data = '';
												$this->load->view('header');
												//$this->load->view('register', $data);
												$this->load->view('login', $data);
												$this->load->view('footer');
											}

											else
											{
												$msg = "Fail to applicant registeration.";
												$this->session->set_flashdata('flashError_applicant', $msg);
												$data = '';
												$this->load->view('header');
												$this->load->view('register', $data);
												$this->load->view('footer');
											}
							}

					}//ends main else
			}//ends if

		else
			{
					$this->load->view('header');
					$this->load->view('register');
					$this->load->view('footer');
			}//ends else
		
		
	}//ends function

	/**********function for verify email*********/

	public function verify_email()
	{
		$email = $this->input->post('email');
		date_default_timezone_set('Asia/Calcutta'); 
		$created_date =  date("Y-m-d H:i:s");
		$this->form_validation->set_rules('email','Email','trim|required');

					
					if($this->form_validation->run() === false) 
					{
							$this->load->view('header');
							$this->load->view('register');
							$this->load->view('footer');

					}//ends if

					else
					{
						
							$checked = $this->Base_model->check_existent('tbl_verification', array('email' => $email));

							if($checked=='1')
							{
									$res = array('status'=>'fails','msg' => 'Email already verified', 'error' => 1);    
                	echo json_encode($res);
							} //ends if

							else
							{
									$to           = $email;
			            $access_token = $this->generate_random_string();
			           
			            /*Email Subject*/
			            $from         = "Verify Email";
			            /*Email Body*/
			            $message     = "Hello " . $email . ",<br><br>";
			            $message    .= "Let's verify your email, your OTP is:<br><br>";
			            $message    .=  $access_token . "<br>";
			            $message    .= "<br>
			                    			--  Best Regards, <br>CWC Team";
			            /*Setting Content Type*/
			            $headers    = "MIME-Version: 1.0" . "\r\n";
			            $headers   .= "Content-type:text/html;charset=UTF-8" . "\r\n";
			            /*Setting More Headers*/
			            $headers   .= 'From: <sriabhinav7071@gmail.com>' . "\r\n";

			            $email_sent  = mail($to, $subject, $message, $headers);

			            if($email_sent != '1')
			            {
			            	$insert_data = array(
												'email'					=> $email,
												'email_otp' 		=> $access_token,
												'created_date' 	=> $created_date,
												'updated_date'  => $created_date
												
												);
										$insertid = $this->Base_model->insert_one_row('tbl_verification', $insert_data);
			            	 $res = array('status'=>'success','msg' => 'Pleae check your email, for verifying email', 'error' => 0);    
                			print json_encode($res);
			            }

			            else
			            {
			            	$res = array('status'=>'fails','msg' => 'Fail to sent email', 'error' => 1);    
                		print json_encode($res);
			            }
							}//ends else
					}//ends else

	}//ends function


	/********function for verify phone**********/

	public function verify_phone()
	{

		//$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		date_default_timezone_set('Asia/Calcutta'); 
		$created_date =  date("Y-m-d H:i:s");
		$this->form_validation->set_rules('phone','Mobile no.','trim|required');

					
					if($this->form_validation->run() === false) 
					{
							$this->load->view('header');
							$this->load->view('register');
							$this->load->view('footer');

					}//ends if

					else
					{
						
							//$checked = $this->Base_model->check_existent('tbl_verification', array('email' => $email,'mobile_no'=> $phone));
							$checked = $this->Base_model->check_existent('tbl_verification', array('mobile_no'=> $phone,'status_mobile'=>1));

							$checked2 = $this->Base_model->check_existent('tbl_verification', array('mobile_no'=> $phone,'status_mobile'=>0));

							/*$checked_email = $this->Base_model->check_existent('tbl_verification', array('email' => $email));

							$checked_email_verify = $this->Base_model->check_existent('tbl_verification', array('email' => $email,'status_email'=> '0'));*/

							if($checked==1)
							{	
									$res = array('status'=>'fails','msg' => 'Mobile no. is already in used, Please try with different number', 'error' => 1);    
                	print json_encode($res);
							} //ends if

							else if($checked2==1)
							{ 
									$res = array('status'=>'fails','msg' => 'Please verify your mobile no.', 'error' => 1);    
                	print json_encode($res);
							} //ends if

							/*else if($checked_email !='1')
							{
									$res = array('status'=>'fails','msg' => 'Email not exits, first verify email', 'error' => 1);    
                	echo json_encode($res);
							}*/ //ends if

							/*else if($checked_email_verify	=='1')
							{
									$res = array('status'=>'fails','msg' => 'Please verify your mail first', 'error' => 1);    
                	echo json_encode($res);
							}*/ //ends if


							else
							{
									$insertid = $this->Base_model->insert_one_row('tbl_verification', array('mobile_no'=>$phone,'created_date'=>$created_date,'updated_date'=>$created_date,'status_mobile'=>0));
									$otp = rand(1000,9999);
									$this->load->library('twilio');
									$send_otp = $this->twilio->sms('+12674364463', '+91'.$phone, 'Your OTP is: '.$otp);
        
			            if($send_otp == 1)
			            {
			            	$update_data = array(
												//'email'					=> $email,
												'mobile_no'			=> $phone,
												'mobile_otp' 		=> $otp,
												'updated_date'  => $created_date
												
												);
										$insertid = $this->Base_model->update_record_by_id('tbl_verification', $update_data, array('mobile_no'=> $phone));
			            	 $res = array('status'=>'success','msg' => 'OTP send to your mobile number, for mobile verification.', 'error' => 0);    
                			print json_encode($res);
			            }

			            else
			            {
			            	$res = array('status'=>'fails','msg' => 'Fail to sent otp', 'error' => 1);    
                		print json_encode($res);
			            }
							}//ends else
					}//ends else

	}//ends function

/**********function for resend otp*********/

public function resnd_otp()
	{

		//$email = $this->input->post('email');
		$phone = $this->input->post('phone');
		date_default_timezone_set('Asia/Calcutta'); 
		$created_date =  date("Y-m-d H:i:s");
		$this->form_validation->set_rules('phone','Mobile no.','trim|required');

					
					if($this->form_validation->run() === false) 
					{
							$this->load->view('header');
							$this->load->view('register');
							$this->load->view('footer');

					}//ends if

					else
					{
						
							//$checked = $this->Base_model->check_existent('tbl_verification', array('email' => $email,'mobile_no'=> $phone));
							$checked = $this->Base_model->check_existent('tbl_verification', array('mobile_no'=> $phone,'status_mobile'=>1));

							$checked2 = $this->Base_model->check_existent('tbl_verification', array('mobile_no'=> $phone,'status_mobile'=>0));

							/*$checked_email = $this->Base_model->check_existent('tbl_verification', array('email' => $email));

							$checked_email_verify = $this->Base_model->check_existent('tbl_verification', array('email' => $email,'status_email'=> '0'));*/

							if($checked==1)
							{	
									$res = array('status'=>'fails','msg' => 'Mobile no. is already in used, Please try with different number', 'error' => 1);    
                	print json_encode($res);
							} //ends if

						
							else
							{
									
									$otp = rand(1000,9999);
									$this->load->library('twilio');
									$send_otp = $this->twilio->sms('+12674364463', '+91'.$phone, 'Your OTP is: '.$otp);
        
			            if($send_otp == 1)
			            {
			            	$update_data = array(
												//'email'					=> $email,
												'mobile_no'			=> $phone,
												'mobile_otp' 		=> $otp,
												'updated_date'  => $created_date
												
												);
										$insertid = $this->Base_model->update_record_by_id('tbl_verification', $update_data, array('mobile_no'=> $phone));
			            	 $res = array('status'=>'success','msg' => 'OTP sent to your mobile number.', 'error' => 0);    
                			print json_encode($res);
			            }

			            else
			            {
			            	$res = array('status'=>'fails','msg' => 'Fail to sent otp', 'error' => 1);    
                		print json_encode($res);
			            }
							}//ends else
					}//ends else

	}//ends function

	/********function for otp verify phone**********/

	public function otp_verify()
	{
		
			$phone = $this->input->post('phone');
			$otp_enter = $this->input->post('otp_enter');
			date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s");
			/*$this->form_validation->set_rules('mobile_no','Mobile no.','trim|required');
			$this->form_validation->set_rules('otp_code','OTP','trim|required');
					
					if($this->form_validation->run() === false) 
					{
						
							$this->load->view('header');
							$this->load->view('register');
							$this->load->view('footer');

					}//ends if

					else
					{*/
						$verification_data = $this->Base_model->get_record_by_id('tbl_verification', array('mobile_no' => $phone));
						
								if($verification_data->mobile_otp == $otp_enter)
								{//echo "asknds";exit;
										$update_data = array(
											
												'status_mobile' 		=> 1,
												'updated_date'  => $created_date
												
												);
										 $this->Base_model->update_record_by_id('tbl_verification', $update_data, array('mobile_no'=> $phone));
			            	 	$res = array('status'=>'success','msg' => 'OTP verified', 'error' => 0);    
                			print json_encode($res);
								}//ends if

								else
								{
									//echo "mmmm";exit;
									$res = array('status'=>'fails','msg' => 'Incorrect otp', 'error' => 1);    
                	print json_encode($res);
								}//ends else
					//}//ends else
	}// function ends

	/*********function for generate random string**********/

	public function generate_random_string()
    {
        $str = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 5);
        $str = $str . time();
        return $str;

    }//function ends
	
	/**********Function for applicant login**********/
	public function login()
	{
		$base_url = base_url();
		if(isset($_REQUEST['submit'])) 
			{
					$email 						= xss_clean($this->input->post('email'));
					$password 				= xss_clean($this->input->post('password'));
					$captcha_text 		= xss_clean($this->input->post('Captcha_text'));
					$captcha_input 		= xss_clean($this->input->post('CaptchaInput'));

					
					$this->form_validation->set_rules('email','Email','trim|required');
					$this->form_validation->set_rules('password','Password','trim|required');
					$this->form_validation->set_rules('CaptchaInput','Captcha','trim|required');

					if($this->form_validation->run() === false) 
					{
						
							$data['insertData'] = array(
								'email' => xss_clean($this->input->post('email')),
								'password' => xss_clean($this->input->post('password')),
								'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
							);


							$this->load->view('header');
							$this->load->view('login', $data);
							$this->load->view('footer');

					}//ends if

					else
					{
						$checked_applicant_email = $this->Base_model->check_existent('tbl_applicant', array('email' => $email));
						
							/*******Check Captcha*******/

							if($checked_applicant_email =='0')
								{
									$msg = "Email not registered, Please create account";
									$this->session->set_flashdata('flashError_applicant_login', $msg);
											$data['insertData'] = array(
														'email' => xss_clean($this->input->post('email')),
														'password' => xss_clean($this->input->post('password')),
														'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
													);
									$this->load->view('header');
									$this->load->view('login',$data);
									$this->load->view('footer');
								}

								else if($captcha_text!=$captcha_input)
								{
									$msg = "Please enter correct captcha code";
									$this->session->set_flashdata('flashError_applicant_login', $msg);
									$data['insertData'] = array(
												'email' => xss_clean($this->input->post('email')),
												'password' => xss_clean($this->input->post('password')),
												'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
											);
									$this->load->view('header');
									$this->load->view('login',$data);
									$this->load->view('footer');
								}

							/****Ends Captcha Code******/

							else
							{
									$email 					= xss_clean($this->input->post('email'));
									$password 			= xss_clean($this->input->post('password'));

									$table = 'tbl_applicant';
									$data = array(
											'email' 		 => $email,
											'password' => md5($password)
										);

								$applicant_data = $this->Base_model->get_login_data($table, $data);

								if($applicant_data)
								{
										$newdata = array(
											'applicant_user_id' => $applicant_data[0]['id'],
											'applicant_email' => $applicant_data[0]['email'],
											'applicant_logged_in' => TRUE,
											'applicant_username' => $applicant_data[0]['name']
										);
								
									$this->session->set_userdata($newdata);
									redirect($base_url.'Applicant/');
								}//ends if

								else
								{
									$msg = "Your username or password is wrong";
									$this->session->set_flashdata('flashError_applicant_login', $msg);
									$data['insertData'] = array(
												'email' => xss_clean($this->input->post('email')),
												'password' => xss_clean($this->input->post('password')),
												'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
											);
									$this->load->view('header');
									$this->load->view('login',$data);
									$this->load->view('footer');	
								}//ends else

							}//ends else
					}//ends main else
			}//ends if

		else
			{
					$data = '';
					$this->load->view('header');
					$this->load->view('login', $data);
					$this->load->view('footer');
					
			}//ends else
		
		
	}//function ends

	
	
	public function forgetpassword()
	{
		
		
		$this->load->view('forgetpassword');
		
	}


  
       public function desclaimer()
	{
		
		
		$this->load->view('desclaimer');
		
	}


       public function privacypolicy()
	{
		
		$this->load->view('privacy-policy');
		
	}


       public function termsconditions()
	{
		
		
		$this->load->view('terms-and-conditions');
		
	}


        public function copyrightpolicy()
	{
		
	
		$this->load->view('copyright-policy');
		
	}


        public function termsofuse()
	{
		
	
		$this->load->view('terms-of-use');
		
	}


	
}//class ends
