<?php

error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

	// Initialize Constructor Here
	function __construct()
	{
			parent::__construct();
			$this->load->model('Base_model');
			$this->load->helper('captcha');
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		
		$all_jobs = $this->Base_model->all_active_jobs();

        $all_jobData = array();
        foreach ($all_jobs as $job_data)
        {
          $region_data = $this->Base_model->get_record_by_id('tbl_region', array('id'=>$job_data->region_id));
          $circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id'=>$job_data->circle_id));
          $circular_data = $this->Base_model->get_record_by_id('tbl_circular', array('circle_id'=>$job_data->circle_id,'job_id'=>$job_data->id));

          if(empty($circular_data->file))
          {
            $pdf = '';
          }

          else
          {
            $pdf = base_url().'uploads/circular/'.$circular_data->file;
          }
          	$data1['job_id']   = $job_data->job_id;
            $data1['job_title']   = $job_data->job_title;
            $data1['circular_title']   = $circular_data->circular_title;
            $data1['region']      = $region_data->region_name;
            $data1['circle']      = $circle_data->circle_name;
            $data1['start_date']  = $job_data->start_date;
            $data1['end_date']    = $job_data->end_date;

            $data1['circular_pdf']    = $pdf;
            $all_jobData[] = $data1;
        }//ends foreach

        usort($all_jobData, function($firstrow, $secondrow){
				
					$firstrow = $firstrow['job_id'];
					$secondrow = $secondrow['job_id'];
					if ($firstrow == $secondrow) {
							return 0;
					}
					return ($firstrow > $secondrow) ? -1 : 1;
				});


        $data['all_circulars'] = $all_jobData;
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
					$captcha_text 		= $this->session->userdata('valuecaptchaCode');
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

							$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];


							$this->load->view('header');
							$this->load->view('adminnew', $data);
							$this->load->view('footer');

					}//ends if

					else
					{
						/*******Check Captcha*******/
						if($captcha_text!=$captcha_input)
						{

							$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


			        $captcha = create_captcha($captcha_config);
			        $this->session->unset_userdata('valuecaptchaCode');
			        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
			        $data['captcha'] = $captcha['word'];

							$msg = "Please enter correct captcha code";
							$this->session->set_flashdata('flashError', $msg);
							$this->load->view('header');
							$this->load->view('adminnew',$data);
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
									'password' 		 => $password
								);

							$user = $this->Base_model->get_login_data($table, $data);

							if($user)
							{
									$newdata = array(
									'auser_id' => $user[0]['Id'],
									'aemail' => $user[0]['email'],
									'auser_type' => $user[0]['user_type'],
									'alogged_in' => TRUE,
									'apwd' => $user[0]['password'],
									'ausername' => $user[0]['name']
								);
								
								$this->session->set_userdata($newdata);

								/********Logs Code*****/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $user[0]['name'],
													'ROLE'			=> $user[0]['user_type'],
													'USEREMAIL' 	=> $user[0]['email'],
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Login Successfully',
													'ACTIVITY' 		=> 'User logged in',
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/******Ends Logs Code***/

								if($user[0]['user_type'] == 1) 
								{
									
									redirect($base_url.'Superadmin/index/'.$user[0]['Id']);
								} 
								elseif($user[0]['user_type'] == 3)
								{
									
									redirect($base_url.'Circle/index/'.$user[0]['Id']);
								}

							}//ends if

							else
							{

								$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];

									$msg = "Your userid or password is wrong";
									$this->session->set_flashdata('flashError', $msg);
									$this->load->view('header');
									$this->load->view('adminnew',$data);
									$this->load->view('footer');	

							}//ends else
						}//ends else capcha elsee
					}//ends main else	
			}//ends main if

			else
			{

				$captcha_config = array(
				        'img_url' => base_url() . 'image_for_captcha/',
				        'img_path' => 'image_for_captcha/',
				        'img_height' => 45,
				        'word_length' => 5,
				        'img_width' => 100,
				        'font_size' => 14
				    );


			        $captcha = create_captcha($captcha_config);
			        $this->session->unset_userdata('valuecaptchaCode');
			        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
			        $data['captcha'] = $captcha['word'];

				$this->load->view('header');
				$this->load->view('adminnew',$data);
				$this->load->view('footer');	
			}//ends else
			
		
	}//ends function

	/**************Logout Function*************/
	public function logout()
	{
			$base_url = base_url().'Frontend/adminnew';
			if ($this->session->userdata('auser_id')) {

				/*********user logs code*****/

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('ausername'),
									'ROLE'			=> $this->session->userdata('auser_type'),
									'USEREMAIL' 	=> $this->session->userdata('aemail'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logout Successfully',
									'ACTIVITY' 		=> 'User logged out',
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);
					$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					/******ends user logs code***/
					
					$this->session->unset_userdata('auser_id');
					$this->session->sess_destroy();
					redirect($base_url);
			} else if($this->session->userdata('applicant_user_id')){

				    $this->session->unset_userdata('applicant_user_id');
					$this->session->sess_destroy();
					redirect($base_url);
			}
			else
			 {
				$base_url = base_url().'Frontend/adminnew';
				redirect($base_url);
			 }
	}// ends function
	
	/*********otp verify_ register*********/

		public function otp_verify_register()
		{
			if(isset($_REQUEST['submit'])) 
			{
					$applicant_name 	= xss_clean(strip_tags($this->input->post('applicant_name')));
					$email 				= xss_clean(strip_tags($this->input->post('email')));
					$mobile_no 			= xss_clean(strip_tags($this->input->post('mobile_no')));
					$gender 			= xss_clean($this->input->post('gender'));
					
					$captcha_text 		= $this->session->userdata('valuecaptchaCode');
					$captcha_input 		= xss_clean($this->input->post('CaptchaInput'));
					//$dob 			    = xss_clean($this->input->post('dob'));

					$dob = str_replace('/', '-', xss_clean($this->input->post('dob')));
					$dob = date('Y-m-d', strtotime($dob));

					
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

							$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];


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

						$checked_applicant_mobile = $this->Base_model->check_existent('tbl_applicant', array('mobile_no' => $mobile_no));

						
						if($captcha_text!=$captcha_input)
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

							$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];

							$this->session->set_flashdata('flashError_applicant', $msg);
							$this->load->view('header');
							$this->load->view('register',$data);
							$this->load->view('footer');

						}// ends caaptcha if

						 else if($checked_applicant == '1')
							{
								$msg = "User already registerd with same email, Please enter new account";
								$this->session->set_flashdata('flashError_applicant', $msg);
								
								$data['insertData'] = array(
						 		'applicant_name' => xss_clean($this->input->post('applicant_name')),
						  		'email' 		=> xss_clean($this->input->post('email')),
						  		'mobile_no' => xss_clean($this->input->post('mobile_no')),
						  		'gender' => xss_clean($this->input->post('gender')),
						  		'dob' => xss_clean($this->input->post('dob')),
						  		'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
						 		);

								$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];

								$this->load->view('header');
								$this->load->view('register', $data);
								$this->load->view('footer');

							}//ends if

						else if ($checked_applicant_mobile == '1')
						  {
						  	$msg = "User already registerd with same mobile no., Please enter new account";

						  	$data['insertData'] = array(
						 		'applicant_name' => xss_clean($this->input->post('applicant_name')),
						  		'email' 		=> xss_clean($this->input->post('email')),
						  		'mobile_no' => xss_clean($this->input->post('mobile_no')),
						  		'gender' => xss_clean($this->input->post('gender')),
						  		'dob' => xss_clean($this->input->post('dob')),
						  		'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
						 	);


						 	$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];

						 	$this->session->set_flashdata('flashError_applicant', $msg);
						 	$this->load->view('header');
						 	$this->load->view('register',$data);
						  	$this->load->view('footer');
						 }

						 else
						 {
						 	$checked_phone_verify = $this->Base_model->check_existent('tbl_tmp_applicant', array('mobile_no' => $mobile_no,'status_mobile'=>'0'));

						 	if($checked_phone_verify==1)
						 	{
						 		 $otp = rand(1000,9999);
								 $number = '+91'.$mobile_no;
								 $send_otp = $this->otpfunction($mobile_no, $otp);
								 $dob = str_replace('/', '-', xss_clean($this->input->post('dob')));
								 $dob = date('Y-m-d', strtotime($dob));

						 		$updated_data = array(
												'name' 							=> $applicant_name,
												'email' 						=> $email,
												'mobile_no' 					=> $mobile_no,
												'gender' 						=> $gender,
												'dob' 							=> $dob,
												'status_mobile'					=> '0',
												'otp'							=> $otp,
												'created_date' 					=> $created_date,
												'updated_date' 					=> $created_date
											);

						 		$updateid = $this->Base_model->update_record_by_id('tbl_tmp_applicant', $updated_data, array('mobile_no'=> $mobile_no));



						 		if($updateid == 1)
						 		{
						 			$msg = "OTP send to your mobile number, for mobile verification.";
									$this->session->set_flashdata('flashSuccess_applicant_otp',$msg);
									$data['mobile_no'] = $mobile_no;
									$this->load->view('header');
									$this->load->view('otp_verify', $data);
									$this->load->view('footer');
						 		}

						 		else
						 		{
						 			$msg = "Fail to applicant registeration.";
									$this->session->set_flashdata('flashError_applicant', $msg);
									$data['insertData'] = array(
								 		'applicant_name' => xss_clean($this->input->post('applicant_name')),
								  		'email' 		=> xss_clean($this->input->post('email')),
								  		'mobile_no' => xss_clean($this->input->post('mobile_no')),
								  		'gender' => xss_clean($this->input->post('gender')),
								  		'dob' => xss_clean($this->input->post('dob')),
								  		'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
								 	);
												
										$captcha_config = array(
								        'img_url' => base_url() . 'image_for_captcha/',
								        'img_path' => 'image_for_captcha/',
								        'img_height' => 45,
								        'word_length' => 5,
								        'img_width' => 100,
								        'font_size' => 14
								    );

								        $captcha = create_captcha($captcha_config);
								        $this->session->unset_userdata('valuecaptchaCode');
								        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
								        $data['captcha'] = $captcha['word'];
								        $data['mobile_no'] = $mobile_no;
										$this->load->view('header');
										$this->load->view('register', $data);
										$this->load->view('footer');

						 		}//ends els eupdate

						 	}

						 	else
						 	{
						 		 $otp = rand(100000,999999);
								 $number = '+91'.$mobile_no;
								 $send_otp = $this->otpfunction($mobile_no, $otp);
								 $dob = str_replace('/', '-', xss_clean($this->input->post('dob')));
								 $dob = date('Y-m-d', strtotime($dob));

						 		$insert_data = array(
												'name' 							=> $applicant_name,
												'email' 						=> $email,
												'mobile_no' 					=> $mobile_no,
												'gender' 						=> $gender,
												'dob' 							=> $dob,
												'status_mobile'					=> '0',
												'otp'							=> $otp,
												'created_date' 					=> $created_date,
												'updated_date' 					=> $created_date
											);
								$insertid = $this->Base_model->insert_one_row('tbl_tmp_applicant', $insert_data);
								$user_data = $this->Base_model->get_all_record_by_condition('tbl_tmp_applicant', array('id' => $insertid));
								 /*
									 $otp = rand(1000,9999);
									 $number = '+91'.$phone;
									 $send_otp = $this->otpfunction($mobile_no, $otp);

								*/

								if($insertid)
								{
									$msg = "OTP send to your mobile number, for mobile verification.";
									$this->session->set_flashdata('flashSuccess_applicant_otp',$msg);
									$data['mobile_no'] = $mobile_no;
									$this->load->view('header');
									$this->load->view('otp_verify', $data);
									$this->load->view('footer');
								}

								else
								{
									$msg = "Fail to applicant registeration.";
									$this->session->set_flashdata('flashError_applicant', $msg);
									$data['insertData'] = array(
								 		'applicant_name' => xss_clean($this->input->post('applicant_name')),
								  		'email' 		=> xss_clean($this->input->post('email')),
								  		'mobile_no' => xss_clean($this->input->post('mobile_no')),
								  		'gender' => xss_clean($this->input->post('gender')),
								  		'dob' => xss_clean($this->input->post('dob')),
								  		'CaptchaInput' => xss_clean($this->input->post('CaptchaInput')),
								 	);
												
										$captcha_config = array(
								        'img_url' => base_url() . 'image_for_captcha/',
								        'img_path' => 'image_for_captcha/',
								        'img_height' => 45,
								        'word_length' => 5,
								        'img_width' => 100,
								        'font_size' => 14
								    );

								        $captcha = create_captcha($captcha_config);
								        $this->session->unset_userdata('valuecaptchaCode');
								        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
								        $data['captcha'] = $captcha['word'];
								        $data['mobile_no'] = $mobile_no;
										$this->load->view('header');
										$this->load->view('register', $data);
										$this->load->view('footer');
								}


						 	}// ends else paert final

						 }// ends else

					}// ends else after validation
			}// ends if main 

			else
			{
				$captcha_config = array(
				        'img_url' => base_url() . 'image_for_captcha/',
				        'img_path' => 'image_for_captcha/',
				        'img_height' => 45,
				        'word_length' => 5,
				        'img_width' => 100,
				        'font_size' => 14
				    );


			        $captcha = create_captcha($captcha_config);
			        $this->session->unset_userdata('valuecaptchaCode');
			        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
			        $data['captcha'] = $captcha['word'];

					$this->load->view('header');
					$this->load->view('register',$data);
					$this->load->view('footer');

			}//ends else main

		}// ends function

	/*******ends otp verify register******/

	/********* function for register otp*********/

	public function register_otp()
	{	
		if(isset($_REQUEST['submit'])) 
		{

			$otp 			= xss_clean($this->input->post('otp'));

			$this->form_validation->set_rules('otp','otp','trim|required');

			if($this->form_validation->run() === false) 
			{
					$data['mobile_no'] = '';
					$this->load->view('header');
					$this->load->view('otp_verify', $data);
					$this->load->view('footer');
			}

			else
			{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s");
				$mobile_no 	= xss_clean($this->input->post('mobile_no'));
				$otp 		= xss_clean($this->input->post('otp'));

				$check_mobile_exits = $this->Base_model->check_existent('tbl_tmp_applicant', array('mobile_no' => $mobile_no));

				$check_mobile_exitsverify = $this->Base_model->check_existent('tbl_tmp_applicant', array('mobile_no' => $mobile_no,'status_mobile' => '1'));

				$temporarypplicant_data = $this->Base_model->get_record_by_id('tbl_tmp_applicant', array('mobile_no' => $mobile_no));

				if($check_mobile_exits == '0')
				{
					$msg = "Mobile number does not exits.";
					$this->session->set_flashdata('flashError_applicant_otperror',$msg);
					$data['mobile_no'] = $mobile_no;
					$this->load->view('header');
					$this->load->view('otp_verify', $data);
					$this->load->view('footer');
				}

				else if($check_mobile_exitsverify == '1')
				{
					$msg = "Mobile number already verified.";
					$this->session->set_flashdata('flashError_applicant_otperror',$msg);
					$data['mobile_no'] = $mobile_no;
					$this->load->view('header');
					$this->load->view('otp_verify', $data);
					$this->load->view('footer');
				}

				else if($temporarypplicant_data->otp != $otp)
				{

					$msg = "OTP not matched, Please enter correct otp.";
					$this->session->set_flashdata('flashError_applicant_otperror',$msg);
					$data['mobile_no'] = $mobile_no;
					$this->load->view('header');
					$this->load->view('otp_verify', $data);
					$this->load->view('footer');
				}

				else
				{
					if(empty($mobile_no))
					{
						$data['mobile_no'] = '';
						$this->load->view('header');
						$this->load->view('otp_verify', $data);
						$this->load->view('footer');
					}

					else
					{
						$updated_data = array(
												
												'status_mobile'					=> '1',
												'updated_date' 					=> $created_date
											);

						$updateid = $this->Base_model->update_record_by_id('tbl_tmp_applicant', $updated_data, array('mobile_no'=> $mobile_no));

						/*********insert******/

						$user_data = $this->Base_model->get_all_record_by_condition('tbl_tmp_applicant', array('mobile_no' => $mobile_no));

						$insert_datsa = array(
												'name' 							=> $user_data[0]->name,
												'email' 						=> $user_data[0]->email,
												'mobile_no' 					=> $user_data[0]->mobile_no,
												'gender' 						=> $user_data[0]->gender,
												'dob' 							=> $user_data[0]->dob,
												'created_date' 					=> $created_date,
												'updated_date' 					=> $created_date
											);
								$insertid = $this->Base_model->insert_one_row('tbl_applicant', $insert_datsa);
								$user_data = $this->Base_model->get_all_record_by_condition('tbl_applicant', array('id' => $insertid));

									if($insertid)
										{
												

						          /**********random password*****/
								 $length = '10';
								 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							     $charactersLength = strlen($characters);
							    
							     $randomString = '';
							     for ($i = 0; $i < $length; $i++) {
							         $randomString .= $characters[rand(0, $charactersLength - 1)];
							     }

							   
														 $this->load->library('email');
                            $this->email->from('sriabhinav7071@gmail.com');
                            $this->email->to($user_data[0]->email);
                            $this->email->subject('CWC Password');
                            $this->email->message('Your password for login is: '.$randomString);
                            $this->email->send();
                           
                        
                        echo "<script type='text/javascript' src='http://katiyarprint.com/cwcjobs-audit/assets/js/jquery-3.2.1.min.js'></script><script type='text/javascript' src='http://katiyarprint.com/cwcjobs-audit/assets/js/encpass.js'></script>
                              <script type = 'text/javascript'>
                              var password = '".$randomString."';

                              var id = '".$insertid."';
                              var md = sha256(password);

                              $.ajax({
                                        
                                        url:'http://katiyarprint.com/cwcjobs-audit/Frontend/updatepass/',
                                        method:'POST',
                                        data:{'id':id,'password':md},
                                        success:function(result){

                                              console.log(result);
                                        }

                              	});

                              </script>";
            

								$msg = "Verify and Registered successfully, Password has sent on your email address";
								$this->session->set_flashdata('flashSuccess_applicant_login',$msg);
								 $captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);

								$data['captcha'] = $captcha['word'];
								$this->load->view('header');
								$this->load->view('login', $data);
								$this->load->view('footer');

							}

							else
							{
								$msg = "Fail to verify and regsiter.";
								$this->session->set_flashdata('flashError_applicant_otperror', $msg);

								$data['mobile_no'] = '';
								$this->load->view('header');
								$this->load->view('otp_verify', $data);
								$this->load->view('footer');
							}


						/*******ends insert*****/

					}//ends else mobile no

				}// ends conditional elseeeeee

				
			}// ends else conditional
		}// ends main if

		else
		{
			$data['mobile_no'] = '';
			$this->load->view('header');
			$this->load->view('otp_verify', $data);
			$this->load->view('footer');

		}// ends main else

	}// ends function

	/******ends functn for register otp********/

	/**********function for applicant registereation**********/

	public function register()
	{
		
   
		if(isset($_REQUEST['submit'])) 
			{

					$applicant_name 	= xss_clean(strip_tags($this->input->post('applicant_name')));
					$email 				= xss_clean(strip_tags($this->input->post('email')));
					$mobile_no 			= xss_clean(strip_tags($this->input->post('mobile_no')));
					$gender 			= xss_clean($this->input->post('gender'));
					$dob 			    = xss_clean($this->input->post('dob'));
					$captcha_text 		= $this->session->userdata('valuecaptchaCode');
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

							$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];


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

						 	$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];

						  	$this->session->set_flashdata('flashError_applicant', $msg);
						 	$this->load->view('header');
						  	$this->load->view('register',$data);
						 	$this->load->view('footer');
						  }

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


						 	$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];

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

							$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];

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
								

								$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];

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
												

						          /**********random password*****/
								 $length = '10';
								 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
							     $charactersLength = strlen($characters);
							    
							     $randomString = '';
							     for ($i = 0; $i < $length; $i++) {
							         $randomString .= $characters[rand(0, $charactersLength - 1)];
							     }

							   
							 $this->load->library('email');
                            $this->email->from('sriabhinav7071@gmail.com');
                            $this->email->to($user_data[0]->email);
                            $this->email->subject('CWC Password');
                            $this->email->message('Your password for login is: '.$randomString);
                            $this->email->send();
                           
                        
                        echo "<script type='text/javascript' src='http://katiyarprint.com/cwcjobs-audit/assets/js/jquery-3.2.1.min.js'></script><script type='text/javascript' src='http://katiyarprint.com/cwcjobs-audit/assets/js/encpass.js'></script>
                              <script type = 'text/javascript'>
                              var password = '".$randomString."';

                              var id = '".$insertid."';
                              var md = sha256(password);

                              $.ajax({
                                        
                                        url:'http://katiyarprint.com/cwcjobs-audit/Frontend/updatepass/',
                                        method:'POST',
                                        data:{'id':id,'password':md},
                                        success:function(result){

                                              console.log(result);
                                        }

                              	});

                              </script>";
            

												$msg = "Registered successfully, Password has sent on your email address";
												$this->session->set_flashdata('flashSuccess_applicant_login',$msg);
												$data = '';
												$this->load->view('header');
												$this->load->view('login', $data);
												$this->load->view('footer');
											}

											else
											{
												$msg = "Fail to applicant registeration.";
												$this->session->set_flashdata('flashError_applicant', $msg);
												
												$captcha_config = array(
										        'img_url' => base_url() . 'image_for_captcha/',
										        'img_path' => 'image_for_captcha/',
										        'img_height' => 45,
										        'word_length' => 5,
										        'img_width' => 100,
										        'font_size' => 14
										    );


									        $captcha = create_captcha($captcha_config);
									        $this->session->unset_userdata('valuecaptchaCode');
									        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
									        $data['captcha'] = $captcha['word'];

												$this->load->view('header');
												$this->load->view('register', $data);
												$this->load->view('footer');
											}
							}

					}//ends main else
			}//ends if

		else
			{

					$captcha_config = array(
				        'img_url' => base_url() . 'image_for_captcha/',
				        'img_path' => 'image_for_captcha/',
				        'img_height' => 45,
				        'word_length' => 5,
				        'img_width' => 100,
				        'font_size' => 14
				    );


			        $captcha = create_captcha($captcha_config);
			        $this->session->unset_userdata('valuecaptchaCode');
			        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
			        $data['captcha'] = $captcha['word'];

					$this->load->view('header');
					$this->load->view('register',$data);
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

							$number = '+91'.$phone;

							$send_otp = $this->otpfunction($number, $otp);

						   $resp = json_decode($send_otp);

			            if($resp->type == 'success')
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

							$number = '+91'.$phone;

							$send_otp = $this->otpfunction($number, $otp);

						   $resp = json_decode($send_otp);

        
			            if($resp->type == 1)
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

			            // else
			            // {
			            // 	$res = array('status'=>'fails','msg' => 'Fail to sent otp', 'error' => 1);    
               //  		print json_encode($res);
			            // }
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


					$email 			    = xss_clean($this->input->post('email'));
					$password 		    = xss_clean($this->input->post('password'));
					$captcha_text 		= $this->session->userdata('valuecaptchaCode');
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

							$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];


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

								$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];
						        			
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

							        $captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];
						        		
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
											'password' => $password
										);

								$applicant_data = $this->Base_model->get_login_data($table, $data);

								if($applicant_data)
								{
										$newdata = array(
											'applicant_user_id' => $applicant_data[0]['id'],
											'applicant_email' => $applicant_data[0]['email'],
											'applicant_logged_in' => TRUE,
											'applicant_pwd' => $applicant_data[0]['password'],
											'applicant_username' => $applicant_data[0]['name']
										);
								
									$this->session->set_userdata($newdata);
									redirect($base_url.'Applicant/dashboard/'.$applicant_data[0]['id']);
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

									$captcha_config = array(
							        'img_url' => base_url() . 'image_for_captcha/',
							        'img_path' => 'image_for_captcha/',
							        'img_height' => 45,
							        'word_length' => 5,
							        'img_width' => 100,
							        'font_size' => 14
							    );


						        $captcha = create_captcha($captcha_config);
						        $this->session->unset_userdata('valuecaptchaCode');
						        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
						        $data['captcha'] = $captcha['word'];

						        
									$this->load->view('header');
									$this->load->view('login',$data);
									$this->load->view('footer');	
								}//ends else

							}//ends else
					}//ends main else
			}//ends if

		else
			{
					$captcha_config = array(
				        'img_url' => base_url() . 'image_for_captcha/',
				        'img_path' => 'image_for_captcha/',
				        'img_height' => 45,
				        'word_length' => 5,
				        'img_width' => 100,
				        'font_size' => 14
				    );


			        $captcha = create_captcha($captcha_config);
			        $this->session->unset_userdata('valuecaptchaCode');
			        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
			        $data['captcha'] = $captcha['word'];


					$this->load->view('header');
					$this->load->view('login', $data);
					$this->load->view('footer');
					
			}//ends else
		
		
	}//function ends

	/*******function for contact us****/

	public function contact()
	{
		$data = '';
		$this->load->view('header');
		$this->load->view('contact', $data);
		$this->load->view('footer');
	}
	
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


   public function updatepass(){

   	     $id = xss_clean($this->input->post('id'));
        
        $password = xss_clean($this->input->post('password'));

        $updateid = $this->Base_model->update_record_by_id('tbl_applicant', array('password'=>$password), array('id'=> $id));

        if($updateid){

        	echo 'success';
        }

   }


public function otpfunction($mobile, $smsOtp){


	        $authkey="237603ASzWWM8r31v75b9bb8d8";
			$message="Your%20Verification%20OTP%20is%20";
			$sender="G4WOTP";
			$otp_expiry="15";
			$otp_length="8";
			
		$dynamic_url="http://control.msg91.com/api/sendotp.php?template=template&otp_length=".$otp_length."&authkey=".$authkey."&message=".$message.$smsOtp."&sender=".$sender."&mobile=".$mobile."&otp=".$smsOtp."&otp_expiry=".$otp_expiry;


			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => $dynamic_url,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "POST",
			  CURLOPT_POSTFIELDS => "",
			  CURLOPT_SSL_VERIFYHOST => 0,
			  CURLOPT_SSL_VERIFYPEER => 0,
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} else {

                 return $response;
			  

			}


}


  public function captccha(){

           $captcha_config = array(
	        'img_url' => base_url() . 'image_for_captcha/',
	        'img_path' => 'image_for_captcha/',
	        'img_height' => 45,
	        'word_length' => 5,
	        'img_width' => 100,
	        'font_size' => 14
	    );

	    $captcha = create_captcha($captcha_config);
	    $this->session->unset_userdata('valuecaptchaCode');
        $this->session->set_userdata('valuecaptchaCode', $captcha['word']);
	    $str = $captcha['word'];
        $str = array('status'=>'success','msg' =>$str,'error' => 0);
		$all_str =  json_encode($str);
		echo  $all_str;

  }




	
}//class ends
