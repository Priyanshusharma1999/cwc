<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Frontend extends CI_Controller {

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
			$this->load->model('Admin_model');
			$this->load->helper('cookie');   
			$this->load->helper('captcha');
	}
	
	public function index()
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
		$this->load->view('index',$data);
		$this->load->view('footer');
	
	}
	
	//ajax captcha

	public function captccha()
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
	    $str = $captcha['word'];
        $str = array('status'=>'success','msg' =>$str,'error' => 0);
		$all_str =  json_encode($str);
		echo  $all_str;

	}// ends function
	
	
	public function login()
	{

		$base_url = base_url();
		if(isset($_REQUEST['submit'])) 
			{

					$email 				= trim(xss_clean(strip_tags($this->input->post('email'))));
					$password 			= trim(xss_clean(strip_tags($this->input->post('password'))));
					$captcha_text 		= $this->session->userdata('valuecaptchaCode');
					$captcha_input 		= trim(xss_clean(strip_tags($this->input->post('CaptchaInput'))));
					
					
					$this->form_validation->set_rules('email','Email','trim|required');
					$this->form_validation->set_rules('password','Password','trim|required');
					$this->form_validation->set_rules('CaptchaInput','Captcha','trim|required');

					if($this->form_validation->run() === false) 
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

							$this->load->view('header',$data);
							$this->load->view('index',$data);
							$this->load->view('footer');

					}//ends if

					else
					{
						
						$checked_user = $this->Base_model->user_existance($email, $email);
						
						$checked_approve = $this->Base_model->user_approvecheck($email, $email);

							if($checked_user =='0')
								{
									
									$msg = "You have entered an invalid username or password.";
									$this->session->set_flashdata('flashError_login', $msg);

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

									$this->load->view('header',$data);
									$this->load->view('index',$data);
									$this->load->view('footer'); 
									
								} else if($checked_approve == '1'){
								    
								    $msg = "Your account is not approve.";
									$this->session->set_flashdata('flashError_login', $msg);

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

									$this->load->view('header',$data);
									$this->load->view('index',$data);
									$this->load->view('footer'); 
								    
								} else if($captcha_text!=$captcha_input)
								 {
									
									$msg = "Please enter correct captcha code.";
									$this->session->set_flashdata('flashError_login', $msg);


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

									$this->load->view('header',$data);
									$this->load->view('index',$data);
									$this->load->view('footer'); 
								 }

						

							else
							{
									
								$user_data = $this->Base_model->get_userdata($email, $email, $password);
							
								if($user_data)
								{
										$newdata = array(
											'user_id' => $user_data[0]['user_id'],
											'user_email' => $user_data[0]['email'],
											'user_name'  => $user_data[0]['user_name']
										);
								
									$this->session->set_userdata($newdata);

									/********Logs Code*****/

										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $user_data[0]['user_name'],
														'ROLE'					=> '',
														'USEREMAIL' 		=> $user_data[0]['email'],
														'CLIENT_IP' 		=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Login Successfully',
														'ACTIVITY' 			=> 'User logged in',
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/******Ends Logs Code***/

									redirect($base_url.'admin/');
								}

								else
								{
									$msg = "You have entered an invalid username or password.";
									$this->session->set_flashdata('flashError_login', $msg);
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

									$this->load->view('header',$data);
									$this->load->view('index',$data);
									$this->load->view('footer');	
								}

							}
					}
			}

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

									$this->load->view('header',$data);
									$this->load->view('index',$data);
									$this->load->view('footer');
					
			}
		
		
	}
	
	
	
	/**************Logout Function*************/

	public function logout()
	{
			$base_url = base_url();
			if ($this->session->userdata('user_id')) {

				/*********user logs code*****/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
								'USERNAME' 	    => $this->session->userdata('user_name'),
								'ROLE'			=> '',
								'USEREMAIL' 	=> $this->session->userdata('user_email'),
								'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
								'LOGINSTATUS' 	=> 'Logout Successfully',
								'ACTIVITY' 		=> 'User logged out',
								'ACTIVITYTIME'  => time(),
								'CREATEDDATED'  => $created_date
								
							);
				$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/******ends user logs code***/

					$this->session->unset_userdata('user_id');
					$this->session->sess_destroy();
					redirect($base_url);
			} 
			else
			 {
				//$base_url = base_url().'admin/';
				redirect($base_url);
			 }
			 
	}
	
	/*******function to gettting all rooms********/

	public function all_room()
	{
		
		$building_id = strip_tags($this->input->post('id'));
		$all_room =  $this->Base_model->get_all_record_by_condition('room_no', array('building_id'=>$building_id,'status'=>1,'delete_status'=>1));
		$all_rooms =  json_encode($all_room);
		echo  $all_rooms;
	}// ends function

	/*******function for employee search******/
	/*******function to gettting all section********/

	public function all_section()
	{
		
		$wing_id = strip_tags($this->input->post('id'));
		$all_section =  $this->Base_model->get_all_record_by_condition('section', array('wing_id'=>$wing_id,'status'=>1,'delete_status'=>1));
		$all_sections =  json_encode($all_section);
		echo  $all_sections;
	}// ends function
	/*******function for user search******/

	public function forgetpassword()
	{
		
		$this->load->helper('url');
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
	

	/***************function for add employee***************/

	public function employee_registration()
	{	
	    
	     
	//echo "<pre>";print_r($_POST);die;
		if(isset($_REQUEST['submit'])) 
		{   
		   
	   $employee_name  					= xss_clean(strip_tags($this->input->post('employee_name')));
	   $employee_post  					= xss_clean(strip_tags($this->input->post('employee_post')));
	   $employee_designation  			= xss_clean(strip_tags($this->input->post('employee_designation')));
	   $reporting_officer  	  	 		= xss_clean(strip_tags($this->input->post('reporting_officer')));
	   $employee_mobile  	  	 		= xss_clean(strip_tags($this->input->post('employee_mobile')));
	   $employee_landline_no  	  	 	= xss_clean(strip_tags($this->input->post('employee_landline_no')));
	   $employee_landline_no_residence 	= xss_clean(strip_tags($this->input->post('employee_landline_no_residence')));
	   $employee_email  	  	 		= xss_clean(strip_tags($this->input->post('employee_email')));
	   $building_name  	  	 			= xss_clean(strip_tags($this->input->post('building_name')));
	   $rooom_id  	  	 				= xss_clean(strip_tags($this->input->post('rooom_id')));
	   $employee_intercom  	  	 		= xss_clean(strip_tags($this->input->post('employee_intercom')));
	   //$show_telephone  	  	 		= xss_clean(strip_tags($this->input->post('show_telephone')));
		   
		$user_access  	  	 		= xss_clean($this->input->post('user_access'));
		$wing_name  	  	 		= xss_clean(strip_tags($this->input->post('wing_name')));
		//$section_name 				= xss_clean(strip_tags($this->input->post('section_name')));
		$user_id  	  	 			= xss_clean(strip_tags($this->input->post('user_id')));
		$password  	  	 			= xss_clean(strip_tags($this->input->post('password')));
		$cnfrm_password  	  	    = xss_clean(strip_tags($this->input->post('cnfrm_password')));
		   
		   
			
			$this->form_validation->set_rules('employee_name','employee name','trim|required');
			$this->form_validation->set_rules('employee_post','employee post','trim|required');
			$this->form_validation->set_rules('employee_designation','employee designation','trim|required');
			$this->form_validation->set_rules('employee_mobile','employee mobile','trim|required');
			$this->form_validation->set_rules('employee_landline_no','employee landline no','trim|required');
			$this->form_validation->set_rules('employee_email','employee email','trim|required');
			$this->form_validation->set_rules('building_name','building name','trim|required');
			$this->form_validation->set_rules('rooom_id','rooom name','trim|required');
			$this->form_validation->set_rules('employee_intercom','employee intercom','trim|required');
			$this->form_validation->set_rules('user_role[]','user role','trim|required');
			$this->form_validation->set_rules('wing_name','wing name','trim|required');
			//$this->form_validation->set_rules('section_name','section name','trim|required');
			$this->form_validation->set_rules('user_id','user id','trim|required');
			$this->form_validation->set_rules('password','password','trim|required');
			$this->form_validation->set_rules('cnfrm_password','confirm password','trim|required');
			
				if($this->form_validation->run() === false) 
				{
						
						$data['insertData'] = array(
							'employee_name' => xss_clean(strip_tags($this->input->post('employee_name'))),
							'employee_post' => xss_clean(strip_tags($this->input->post('employee_post'))),
							'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
							'employee_mobile' => xss_clean(strip_tags($this->input->post('employee_mobile'))),
							'employee_landline_no' => xss_clean(strip_tags($this->input->post('employee_landline_no'))),
							'employee_landline_no_residence' => xss_clean(strip_tags($this->input->post('employee_landline_no_residence'))),
							'employee_email' => xss_clean(strip_tags($this->input->post('employee_email'))),
							'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
							'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
							'rooom_id' => xss_clean(strip_tags($this->input->post('rooom_id'))),
							'employee_intercom' => xss_clean(strip_tags($this->input->post('employee_intercom'))),
							'reporting_officer' => xss_clean(strip_tags($this->input->post('reporting_officer'))),
							//'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
							'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							//'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
							'user_id' => xss_clean(strip_tags($this->input->post('user_id'))),
							'password' => xss_clean(strip_tags($this->input->post('password'))),
							'cnfrm_password' => xss_clean(strip_tags($this->input->post('cnfrm_password'))),
						);
						
						$msg = "From validation failed";
						$this->session->set_flashdata('flashError_employee', $msg);
						$this->load->view('header');
						$this->load->view('index',$data);
						$this->load->view('footer');	
				}//ends if

				else
				{
					$desigantion_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $this->input->post('employee_designation')));
                    $desigantion =  $desigantion_data->designation_name;
					
					$employee_name  		= xss_clean(strip_tags($this->input->post('employee_name')));
					$employee_post  		= xss_clean(strip_tags($this->input->post('employee_post')));
					$employee_designation  	= xss_clean(strip_tags($this->input->post('employee_designation')));
					$reporting_officer  	 = xss_clean(strip_tags($this->input->post('reporting_officer')));
					$employee_mobile  	  	 = xss_clean(strip_tags($this->input->post('employee_mobile')));
					$employee_landline_no  	  = xss_clean(strip_tags($this->input->post('employee_landline_no')));
					$employee_landline_no_residence = xss_clean(strip_tags($this->input->post('employee_landline_no_residence')));
					$employee_email  	  	= xss_clean(strip_tags($this->input->post('employee_email')));
					$building_name  	  	= xss_clean(strip_tags($this->input->post('building_name')));
					$rooom_id  	  	 		= xss_clean(strip_tags($this->input->post('rooom_id')));
					$employee_intercom  	= xss_clean(strip_tags($this->input->post('employee_intercom')));
					//$show_telephone  	  	= xss_clean(strip_tags($this->input->post('show_telephone')));
					$ip_address				= $_SERVER['REMOTE_ADDR'];
					//$session_id 			= $this->session->userdata('user_id');
					$user_role  	  	 		= xss_clean($this->input->post('user_role'));
					$user_access  	  	 		= xss_clean($this->input->post('user_access'));
					$wing_name  	  	 		= xss_clean(strip_tags($this->input->post('wing_name')));
					//$section_name 				= xss_clean(strip_tags($this->input->post('section_name')));
					$user_id  	  	 			= xss_clean(strip_tags($this->input->post('user_id')));
					$password  	  	 			= xss_clean(strip_tags($this->input->post('password')));
					$cnfrm_password  	  	= xss_clean(strip_tags($this->input->post('cnfrm_password')));
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					
					/*****check condition********/

						$checked_emp_email = $this->Base_model->check_existent('employee', array('employee_email'=> $employee_email,'delete_status'=>1));

					/*****ends check condition*****/

				if($checked_emp_email=='1')
				{
						
						$msg = "Employee email already exits, Please enter new one";
						$this->session->set_flashdata('flashError_employee', $msg);
						$data['insertData'] = array(
						
						'employee_name' => xss_clean(strip_tags($this->input->post('employee_name'))),
						'employee_post' => xss_clean(strip_tags($this->input->post('employee_post'))),
						'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
						'employee_mobile' => xss_clean(strip_tags($this->input->post('employee_mobile'))),
						'employee_landline_no' => xss_clean(strip_tags($this->input->post('employee_landline_no'))),
						'employee_landline_no_residence' => xss_clean(strip_tags($this->input->post('employee_landline_no_residence'))),
						'employee_email' => xss_clean(strip_tags($this->input->post('employee_email'))),
						'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
						'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
						'rooom_id' => xss_clean(strip_tags($this->input->post('rooom_id'))),
						'employee_intercom' => xss_clean(strip_tags($this->input->post('employee_intercom'))),
						'reporting_officer' => xss_clean(strip_tags($this->input->post('reporting_officer'))),
						//'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
						);

						$this->load->view('header');
						$this->load->view('index',$data);
						$this->load->view('footer');	

					}//ends if

						else
						{
							
						  $lastid = $this->Admin_model->lastid();

						  $empid = $lastid->employee_id + 1;
							
			               $insert_data = array(
								'employee_code' 						=> 'emp_'.$empid,
								'employee_name' 						=> $employee_name,
								'employee_designation' 					=> $employee_designation,
								'employee_mobile_no' 					=> $employee_mobile,
								'employee_landline_no' 					=> $employee_landline_no,
								'employee_landline_no_residence' 		=> $employee_landline_no_residence,
								'employee_email' 						=> $employee_email,
								'employee_intercom' 					=> $employee_intercom,
								'post' 									=> $employee_post,
								'building_id' 							=> $building_name,
								'room_id' 								=> $rooom_id,
								'reporting_officer' 					=> $reporting_officer,
								'client_ip' 							=> $ip_address,
								'created_date' 							=> $created_date,
								'updated_date' 							=> $created_date
							);

							 $insertid = $this->Base_model->insert_one_row('employee', $insert_data);
							
							$insert_data_user = array(
												'login_id' 							=> $user_id,
												'password' 							=> $password,
												'user_name' 						=> $user_name,
												'designation' 					    => $desigantion,
												'contact_no' 						=> $employee_mobile,
												'email' 							=> $employee_email,
												'employee_id' 					    => $insertid,
												'room_id' 							=> $rooom_id,
												'building_id' 					    => $building_name,
												'wing_id' 							=> $wing_name,
												//'section_id' 						=> $section_name,
												'display_name' 						=> $employee_name,
												'client_ip' 						=> $ip_address,
												'created_date' 					    => $created_date,
												'updated_date' 					    => $created_date
											);
													
								 $insert_user_id = $this->Base_model->insert_one_row('users', $insert_data_user);
								 
								 /***************save user role****************/
									$i=0;

									 foreach($user_role as $saveuser_role)
									 {

									   $insertroleid = $this->Base_model->insert_one_row('save_users_role', 
										  array('user_id'		  =>  $insert_user_id,
												'role_id'  		  =>  $saveuser_role,
												'employee_id' 	  =>  $insertid,
												'client_ip' 	  => $_SERVER['REMOTE_ADDR'],
												'created_date' 	  => $created_date,
												'updated_date'    => $created_date
											) );	
											$i++;
							   
									}
								 /*************ends save user role****************/


								 /***************save user Access****************/
								   if(!empty($user_access)){

									 foreach($user_access as $access)
									 {

									   $insertaccessid = $this->Base_model->insert_one_row('user_access', 
										  array('user_id'			=>  $insert_user_id,
												'service_type'  	=>  $access,
												'emp_id' 	        =>  $insertid,
												'client_ip' 	    => $_SERVER['REMOTE_ADDR'],
												'created_date' 	    => $created_date,
												'updated_date'      => $created_date
											) );	
							   
									}
								  }
								 /*************ends save user Access****************/
						
					
						if($insertaccessid)
							{
							    
							    
								$msg = "You have registered successfully.";
								$this->session->set_flashdata('employee_add_flashSuccess',$msg);

							     redirect($base_url);
 
					    	}

						else
						 {
						    
							$msg = "Failed to Registration.";
							$this->session->set_flashdata('flashError_employee',$msg);
						  }

						}//ends else

				}//ends main else
		}//ends if

		else
		{
			$this->load->view('header');
			$this->load->view('index',$data);
			$this->load->view('footer');	
		}//ends else

	}//end function
	

	public function checkandverify()
	{
		$employee_post= $this->input->post('employee_post');
		$user_role= $this->input->post('user_role');
		$status=$this->Base_model->CheckForRegistration($employee_post,$user_role);
	//	echo "<pre>";print_r($status);die;
		if(!empty($status))
		{
						$otp = rand(1000,9999);
					    $this->load->library('email');
						$config = array(
					            'protocol' => 'smtp',
					            'smtp_host' => '164.100.14.95',
					            'smtp_port' => '25'
					        );   
					    $this->email->initialize($config);
                        $this->email->from('support-intracwc@gov.in');
                        $this->email->to($status[0]->employee_email);
                        $this->email->subject('Registration OTP');
                        $this->email->message('OTP for verify registration is:'.$otp);
						$this->email->send();
 
					 		$insdata = array(
											'email_id' 						=> $status[0]->employee_email,
											'mobile_no' 					=> $status[0]->employee_mobile_no,
											'email_code' 					=> '',
											'mobile_otp' 					=> $otp,
											'status_email' 				    => 1,
											'status_mobile'					=> 0,
											//'created_date' 					=> $created_date,
											//'updated_date' 					=> $created_date
										);

			 		        $inid = $this->Base_model->insert_one_row('user_verification', $insdata);
				$all_str =  json_encode($status);
		    echo  $all_str;
			
		}
		else
		{
		  	$all_str =  json_encode(array('new_user' => '1'));
		    echo  $all_str;
		
		}
	
	
	}// ends function
	
	public function checkotp()
	{
		$otp= $this->input->post('otp');
		$email= $this->input->post('id');
		$status=$this->Base_model->check_existent('user_verification', array('mobile_otp'=>$otp,'email_id'=>$email,'status_email'=>1));
		//echo "<pre>";print_r($status);die;
		if(!empty($status))
		{
			$inid = $this->Base_model->update_record_by_id('user_verification', array('status_email'=>0),array('mobile_otp'=>$otp,'email_id'=>$email,'status_email'=>1));
			$return=1;
		}
		else
		{
			$return=0;
		}
		$all_str =  json_encode($return);
		echo  $all_str;
	
	}// ends function
}
