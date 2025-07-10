<?php
error_reporting(0);
use PHPMailer\PHPMailer\PHPMailer;
require 'vendor/autoload.php';

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
        //echo $captcha['word'];exit;
		//$random_number = $this->generate_random_string();
        // $data['captcha'] = create_captcha($vals);
        //$data['captcha'] = $random_number;
        $data['captcha'] = $captcha['word'];
		$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
		$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
		$this->load->view('header',$data);
		$this->load->view('index',$data);
		$this->load->view('footer');
	
	}

	 /**
     * To generate Random String
     *
     * @FNAME :generateRandomString
     * @param 
     * @param 
     * @return 
     * 
     * created by : 
     * date:   
     */
    private function generate_random_string()
    {
        $str = substr(str_shuffle("0123456789"), 0, 5);
        $str = $str;
        return $str;
    }


    //
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


	//

	public function getsessionval()
	{
		
	    $str = $this->session->userdata('valuecaptchaCode');
        $str = array('status'=>'success','msg' =>$str,'error' => 0);
		$all_str =  json_encode($str);
		echo  $all_str;

	}// ends function

	
	


	public function login()
	{
		
		$base_url = base_url();
		if(isset($_REQUEST['submit'])) 
			{		
					//echo "<pre>"; print_r($this->session->userdata('valuecaptchaCode'));exit;
					$email 				= trim(xss_clean($this->input->post('email')));
					$password 			= trim(xss_clean($this->input->post('password')));
					//$captcha_text 		= trim(xss_clean($this->input->post('Captcha_text')));
					$captcha_text 		= $this->session->userdata('valuecaptchaCode');
					$captcha_input 		= trim(xss_clean($this->input->post('CaptchaInput')));

				
				   /* $encrypt_method = "AES-256-CBC";
				    $secret_key = 'hsdd67466437hdjd874783';
				    $secret_iv 	= 'nsjjhsdjh7674747hdbd787';

				    $key = hash('sha256', $secret_key);
				    $iv = substr(hash('sha256', $secret_iv), 0, 16);
					$password = openssl_decrypt(base64_decode($passwordd), $encrypt_method, $key, 0, $iv);*/

					
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

							if($checked_user =='0')
								{
									
									$msg = "You have entered an invalid username or password.";
									$this->session->set_flashdata('flashError_applicant_login', $msg);
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
									$this->session->set_flashdata('flashError_applicant_login', $msg);
									$this->load->view('header',$data);
									$this->load->view('index',$data);
									$this->load->view('footer'); 
								 }

						

							else
							{
									
								$applicant_data = $this->Base_model->get_userdata($email, $email, $password);
							
								if($applicant_data)
								{
										$newdata = array(
											'applicant_user_id' => $applicant_data[0]['USERS_ID'],
											'applicant_email' => $applicant_data[0]['EMAIL'],
											'user_name'  => $applicant_data[0]['FULLNAME'],
											'asession_cookie' => $this->input->cookie('ci_session', TRUE),
											'user_role'  => $applicant_data[0]['ROLE_ID']
										);
									
									
									$this->session->set_userdata($newdata);

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $applicant_data[0]['FULLNAME'],
													'ROLE'			=> $applicant_data[0]['ROLE_ID'],
													'USEREMAIL' 	=> $applicant_data[0]['EMAIL'],
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Login Successfully',
													'ACTIVITY' 		=> 'User logged in',
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);
									redirect($base_url.'admin/index/'.$applicant_data[0]['USERS_ID']);
								}

								else
								{
									/*$msg = "Your password is wrong";*/
									$msg = "You have entered an invalid username or password.";
									$this->session->set_flashdata('flashError_applicant_login', $msg);
									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => '',
													'ROLE'			=> '',
													'USEREMAIL' 	=> $email,
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Login Failed',
													'ACTIVITY' 		=> 'Login Attempt',
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);
									$this->Base_model->insert_one_row('userlogs', $user_logs_data);
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
					$this->load->view('index', $data);
					$this->load->view('footer');
					
			}
		
		
	}
	

	/**************Logout Function*************/
	public function logout()
	{
			$base_url = base_url();
			if ($this->session->userdata('applicant_user_id')) {

					/*********user logs code*****/

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('user_name'),
									'ROLE'			=> $this->session->userdata('user_role'),
									'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logout Successfully',
									'ACTIVITY' 		=> 'User logged out',
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);
					$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					/******ends user logs code***/
					$this->session->unset_userdata('applicant_user_id');
					$this->session->sess_destroy();

					redirect($base_url);
			} 
			else
			 {
				//$base_url = base_url().'admin/';
				redirect($base_url);
			 }
			 
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
	
	
	public function contactlist()
	{
		
	     $contact = $this->Base_model->get_all_contactlist();

	     $contacts = array();
	     foreach ($contact as $contact_val) 
	     {
	     	$org_data = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $contact_val->ORGANIZATION_ID)); 

	     	if(empty($org_data))
	     	{
	     		$org_name = ''; 
	     	}

	     	else
	     	{
	     		$org_name = $org_data->ORGNAME;
	     	}

	     	$contact_data['EMPLOYEE_ID'] = $contact_val->EMPLOYEE_ID;
	     	$contact_data['ROLE'] 		 = $contact_val->ROLE;
	     	$contact_data['FULLENAME'] 	 = $contact_val->FULLENAME;
	     	$contact_data['ORGANIZATION_ID'] = $contact_val->ORGANIZATION_ID;
	     	$contact_data['ORGANIZATION_NAME'] = $org_name;
	     	$contact_data['DIVISION_ID'] = $contact_val->DIVISION_ID;
	     	$contact_data['DESIGNATION'] = $contact_val->DESIGNATION;
	     	$contact_data['OFFICENAME']  = $contact_val->OFFICENAME;
	     	$contact_data['EMAIL'] 		 = $contact_val->EMAIL;
	     	$contact_data['MOBILE'] 	 = $contact_val->MOBILE;
	     	$contact_data['LANDLINE_NO'] = $contact_val->LANDLINE_NO;
	     	$contact_data['CREATEDDATE'] = $contact_val->CREATEDDATE;
	     	$contact_data['STATUS'] 	 = $contact_val->STATUS;
	     	$contact_data['LASTMODIFIED'] = $contact_val->LASTMODIFIED;
	     	$contact_data['MODIFIED_BY'] = $contact_val->MODIFIED_BY;
	     	$contact_data['CLIENT_IP'] 	 = $contact_val->CLIENT_IP;
	     	$contact_data['OFFICE_ADDRESS'] = $contact_val->OFFICE_ADDRESS;

	     	$contacts[] =  $contact_data;
	     	
	     }
	     
	     usort($contacts, function($a, $b) {
			return $a['ORGANIZATION_NAME'] <=> $b['ORGANIZATION_NAME'];
			 });
	    
	    $data['all_contacts'] = $contacts;
	    $data['all_organizations'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
	    $data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
	    $this->load->view('header');
	    $this->load->view('contactlist',$data);
	    $this->load->view('footer');
	}

	
	/**************Search home page Function*************/

	public function search_pension()
	{
	  if(isset($_REQUEST['submit'])) 
	  {
		$select_type 		= xss_clean($this->input->post('select_type'));

		if($select_type == 'Name')
		{
			$name 						= xss_clean($this->input->post('name'));
			$division 				= xss_clean($this->input->post('division'));
			$status 					= xss_clean($this->input->post('status'));

				if(empty($name))
				{
					if($status=='All')
					{
							$data['all_data_POPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSEF','DELETES'=>'0'));
							$data['all_data_POPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSOF','DELETES'=>'0'));
							$data['all_data_PNPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSEF','DELETES'=>'0'));
							$data['all_data_PNPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSOF','DELETES'=>'0'));

							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
								'select_type' 					=> xss_clean($this->input->post('select_type')),
								'name'		  						=> xss_clean($this->input->post('name')),
								'division' 							=> xss_clean($this->input->post('division')),
								'status' 								=> xss_clean($this->input->post('status')),
								
							);
						$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
							$this->load->view('header');
							$this->load->view('index',$data);
							$this->load->view('footer');
					}

					else
					{	
						  $data['all_data_POPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSEF','DELETES'=>'0','PENSION_STATUS'=>$status));
							$data['all_data_POPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSOF','DELETES'=>'0','PENSION_STATUS'=>$status));
							$data['all_data_PNPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSEF','DELETES'=>'0','PENSION_STATUS'=>$status));
							$data['all_data_PNPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSOF','DELETES'=>'0','PENSION_STATUS'=>$status));

							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
							$data['insertData'] = array(
								'select_type' 					=> xss_clean($this->input->post('select_type')),
								'name'		  						=> xss_clean($this->input->post('name')),
								'division' 							=> xss_clean($this->input->post('division')),
								'status' 								=> xss_clean($this->input->post('status')),
								
							);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
							$this->load->view('header');
							$this->load->view('index',$data);
							$this->load->view('footer');	
					}
						
				}//ends if

				else
				{
						if($name && empty($division) && empty($status))
						{

							$data['all_data_POPSEF']  = $this->Base_model->get_pension_record_searchname1($name,NULL,NULL);
							$data['all_data_POPSOF']  = $this->Base_model->get_pension_record_searchname2($name,NULL,NULL);
							$data['all_data_PNPSEF']  = $this->Base_model->get_pension_record_searchname3($name,NULL,NULL);
							$data['all_data_PNPSOF']  = $this->Base_model->get_pension_record_searchname4($name,NULL,NULL);

							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
							$data['insertData'] = array(
										'select_type' 					=> xss_clean($this->input->post('select_type')),
										'name'		  						=> xss_clean($this->input->post('name')),
										'division' 							=> xss_clean($this->input->post('division')),
										'status' 								=> xss_clean($this->input->post('status')),
										
									);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
							$this->load->view('header');
							$this->load->view('index',$data);
							$this->load->view('footer');
						}

			else if($name && $division && $status)
			{
			    if($division =='All' && $status =='All')
				  {
						$data['all_data_POPSEF']  = $this->Base_model->get_pension_record_searchname1($name,NULL,NULL);
						$data['all_data_POPSOF']  = $this->Base_model->get_pension_record_searchname2($name,NULL,NULL);
						$data['all_data_PNPSEF']  = $this->Base_model->get_pension_record_searchname3($name,NULL,NULL);
						$data['all_data_PNPSOF']  = $this->Base_model->get_pension_record_searchname4($name,NULL,NULL);

						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));

						$data['insertData'] = array(
							'select_type' 					=> xss_clean($this->input->post('select_type')),
							'name'		  					=> xss_clean($this->input->post('name')),
							'division' 						=> xss_clean($this->input->post('division')),
							'status' 						=> xss_clean($this->input->post('status')),
							
						);

						$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));

						$this->load->view('header');
						$this->load->view('index',$data);
						$this->load->view('footer');
				   }

					else if($name && empty($division) && $status== 'All')
					{
							$data['all_data_POPSEF']  = $this->Base_model->get_pension_record_searchname1($name,NULL,NULL);
							$data['all_data_POPSOF']  = $this->Base_model->get_pension_record_searchname2($name,NULL,NULL);
							$data['all_data_PNPSEF']  = $this->Base_model->get_pension_record_searchname3($name,NULL,NULL);
							$data['all_data_PNPSOF']  = $this->Base_model->get_pension_record_searchname4($name,NULL,NULL);

							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
							$data['insertData'] = array(
								'select_type' 					=> xss_clean($this->input->post('select_type')),
								'name'		  						=> xss_clean($this->input->post('name')),
								'division' 							=> xss_clean($this->input->post('division')),
								'status' 								=> xss_clean($this->input->post('status')),
								
							);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
							$this->load->view('header');
							$this->load->view('index',$data);
							$this->load->view('footer');
					}

					else if($name && $division== 'All' && empty($status))
					{
							$data['all_data_POPSEF']  = $this->Base_model->get_pension_record_searchname1($name,NULL,NULL);
							$data['all_data_POPSOF']  = $this->Base_model->get_pension_record_searchname2($name,NULL,NULL);
							$data['all_data_PNPSEF']  = $this->Base_model->get_pension_record_searchname3($name,NULL,NULL);
							$data['all_data_PNPSOF']  = $this->Base_model->get_pension_record_searchname4($name,NULL,NULL);

							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
							$data['insertData'] = array(
								'select_type' 					=> xss_clean($this->input->post('select_type')),
								'name'		  						=> xss_clean($this->input->post('name')),
								'division' 							=> xss_clean($this->input->post('division')),
								'status' 								=> xss_clean($this->input->post('status')),
								
							);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
							$this->load->view('header');
							$this->load->view('index',$data);
							$this->load->view('footer');
					}

					else
					{
							$data['all_data_POPSEF']  = $this->Base_model->get_pension_record_searchname1($name,$division,$status);
							$data['all_data_POPSOF']  = $this->Base_model->get_pension_record_searchname2($name,$division,$status);
							$data['all_data_PNPSEF']  = $this->Base_model->get_pension_record_searchname3($name,$division,$status);
							$data['all_data_PNPSOF']  = $this->Base_model->get_pension_record_searchname4($name,$division,$status);

							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
							$data['insertData'] = array(
								'select_type' 					=> xss_clean($this->input->post('select_type')),
								'name'		  						=> xss_clean($this->input->post('name')),
								'division' 							=> xss_clean($this->input->post('division')),
								'status' 								=> xss_clean($this->input->post('status')),
								
							);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
							$this->load->view('header');
							$this->load->view('index',$data);
							$this->load->view('footer');
					}
					
			}


			else if(empty($name) && empty($division) && $status)
			{
					if($status=='All')
					{
							$data['all_data_POPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSEF','DELETES'=>'0'));
							$data['all_data_POPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSOF','DELETES'=>'0'));
							$data['all_data_PNPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSEF','DELETES'=>'0'));
							$data['all_data_PNPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSOF','DELETES'=>'0'));

							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
							$data['insertData'] = array(
								'select_type' 					=> xss_clean($this->input->post('select_type')),
								'name'		  						=> xss_clean($this->input->post('name')),
								'division' 							=> xss_clean($this->input->post('division')),
								'status' 								=> xss_clean($this->input->post('status')),
								
							);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
							$this->load->view('header');
							$this->load->view('index',$data);
							$this->load->view('footer');
					}

					else
					{	
							$data['all_data_POPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSEF','DELETES'=>'0','PENSION_STATUS'=>$status));
							$data['all_data_POPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSOF','DELETES'=>'0','PENSION_STATUS'=>$status));
							$data['all_data_PNPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSEF','DELETES'=>'0','PENSION_STATUS'=>$status));
							$data['all_data_PNPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSOF','DELETES'=>'0','PENSION_STATUS'=>$status));

							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
							$data['insertData'] = array(
								'select_type' 					=> xss_clean($this->input->post('select_type')),
								'name'		  						=> xss_clean($this->input->post('name')),
								'division' 							=> xss_clean($this->input->post('division')),
								'status' 								=> xss_clean($this->input->post('status')),
								
							);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
							$this->load->view('header');
							$this->load->view('index',$data);
							$this->load->view('footer');	
					}
					
			}

			else if($name && $division && empty($status))
			{
					if($division == 'All')
					{
							$data['all_data_POPSEF']  = $this->Base_model->get_pension_record_searchname1($name,NULL,NULL);
							$data['all_data_POPSOF']  = $this->Base_model->get_pension_record_searchname2($name,NULL,NULL);
							$data['all_data_PNPSEF']  = $this->Base_model->get_pension_record_searchname3($name,NULL,NULL);
							$data['all_data_PNPSOF']  = $this->Base_model->get_pension_record_searchname4($name,NULL,NULL);

							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
							$data['insertData'] = array(
								'select_type' 					=> xss_clean($this->input->post('select_type')),
								'name'		  						=> xss_clean($this->input->post('name')),
								'division' 							=> xss_clean($this->input->post('division')),
								'status' 								=> xss_clean($this->input->post('status')),
								
							);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
							$this->load->view('header');
							$this->load->view('index',$data);
							$this->load->view('footer');
					}

					else
					{	
							$data['all_data_POPSEF']  = $this->Base_model->get_pension_record_searchname1($name,$division,NULL);
							$data['all_data_POPSOF']  = $this->Base_model->get_pension_record_searchname2($name,$division,NULL);
							$data['all_data_PNPSEF']  = $this->Base_model->get_pension_record_searchname3($name,$division,NULL);
							$data['all_data_PNPSOF']  = $this->Base_model->get_pension_record_searchname4($name,$division,NULL);

							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
								'select_type' 					=> xss_clean($this->input->post('select_type')),
								'name'		  						=> xss_clean($this->input->post('name')),
								'division' 							=> xss_clean($this->input->post('division')),
								'status' 								=> xss_clean($this->input->post('status')),
								
							);
						$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
							$this->load->view('header');
							$this->load->view('index',$data);
							$this->load->view('footer');
					}
					
			}


			else if($name && empty($division) && $status)
			{
					if($status == 'All')
					{
							$data['all_data_POPSEF']  = $this->Base_model->get_pension_record_searchname1($name,NULL,NULL);
							$data['all_data_POPSOF']  = $this->Base_model->get_pension_record_searchname2($name,NULL,NULL);
							$data['all_data_PNPSEF']  = $this->Base_model->get_pension_record_searchname3($name,NULL,NULL);
							$data['all_data_PNPSOF']  = $this->Base_model->get_pension_record_searchname4($name,NULL,NULL);

							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
							$data['insertData'] = array(
								'select_type' 					=> xss_clean($this->input->post('select_type')),
								'name'		  						=> xss_clean($this->input->post('name')),
								'division' 							=> xss_clean($this->input->post('division')),
								'status' 								=> xss_clean($this->input->post('status')),
								
							);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
							$this->load->view('header');
							$this->load->view('index',$data);
							$this->load->view('footer');
					}

					else
					{
						$data['all_data_POPSEF']  = $this->Base_model->get_pension_record_searchname1($name,NULL,$status);
						$data['all_data_POPSOF']  = $this->Base_model->get_pension_record_searchname2($name,NULL,$status);
						$data['all_data_PNPSEF']  = $this->Base_model->get_pension_record_searchname3($name,NULL,$status);
						$data['all_data_PNPSOF']  = $this->Base_model->get_pension_record_searchname4($name,NULL,$status);

						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'select_type' 					=> xss_clean($this->input->post('select_type')),
							'name'		  						=> xss_clean($this->input->post('name')),
							'division' 							=> xss_clean($this->input->post('division')),
							'status' 								=> xss_clean($this->input->post('status')),
							
						);
						$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
						$this->load->view('header');
						$this->load->view('index',$data);
						$this->load->view('footer');
					}
					
			}

			else
			{
					$data['all_data_POPSEF']  = $this->Base_model->get_pension_record_search1($name,$status,'POPSEF');
					$data['all_data_POPSOF']  = $this->Base_model->get_pension_record_search1($name,$status,'POPSOF');
					$data['all_data_PNPSEF']  = $this->Base_model->get_pension_record_search1($name,$status,'PNPSEF');
					$data['all_data_PNPSOF']  = $this->Base_model->get_pension_record_search1($name,$status,'PNPSOF');

					$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
					$data['insertData'] = array(
								'select_type' 					=> xss_clean($this->input->post('select_type')),
								'name'		  						=> xss_clean($this->input->post('name')),
								'division' 							=> xss_clean($this->input->post('division')),
								'status' 								=> xss_clean($this->input->post('status')),
								
							);
					$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
					$this->load->view('header');
					$this->load->view('index',$data);
					$this->load->view('footer');
			}
						
	      }//ends else
        }

		else if($select_type == 'PPO')
		{

			$ppo_no 					= xss_clean($this->input->post('ppo_no'));
			$division 				= xss_clean($this->input->post('division'));
			$status 					= xss_clean($this->input->post('status'));

			if(empty($ppo_no))
			  {
				$data['all_data_POPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSEF','DELETES'=>'0'));
				$data['all_data_POPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSOF','DELETES'=>'0'));
				$data['all_data_PNPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSEF','DELETES'=>'0'));
				$data['all_data_PNPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSOF','DELETES'=>'0'));

				$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
				$data['insertData'] = array(
										'select_type' 					=> xss_clean($this->input->post('select_type')),
										'ppo_no'		  						=> xss_clean($this->input->post('ppo_no')),
										'status' 								=> xss_clean($this->input->post('status')),
										
									);
				$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
					$this->load->view('header');
					$this->load->view('index',$data);
					$this->load->view('footer');
			}//ends if

			else if($status == 'All')
			{
				$data['all_data_POPSEF']  = $this->Base_model->get_pension_record_search5($ppo_no,'POPSEF',$status);
				$data['all_data_POPSOF']  = $this->Base_model->get_pension_record_search5($ppo_no,'POPSOF',$status);
				$data['all_data_PNPSEF']  = $this->Base_model->get_pension_record_search5($ppo_no,'PNPSEF',$status);
				$data['all_data_PNPSOF']  = $this->Base_model->get_pension_record_search5($ppo_no,'PNPSOF',$status);
				
				$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
				$data['insertData'] = array(
									'select_type' 					=> xss_clean($this->input->post('select_type')),
									'ppo_no'		  						=> xss_clean($this->input->post('ppo_no')),
									'status' 								=> xss_clean($this->input->post('status'))
								);

				$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));

				$this->load->view('header');
				$this->load->view('index',$data);
				$this->load->view('footer');
			}
			else
			{
				$data['all_data_POPSEF']  = $this->Base_model->get_pension_record_search2($ppo_no,'POPSEF');
				$data['all_data_POPSOF']  = $this->Base_model->get_pension_record_search2($ppo_no,'POPSOF');
				$data['all_data_PNPSEF']  = $this->Base_model->get_pension_record_search2($ppo_no,'PNPSEF');
				$data['all_data_PNPSOF']  = $this->Base_model->get_pension_record_search2($ppo_no,'PNPSOF');
				
				$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
				$data['insertData'] = array(
									'select_type' 					=> xss_clean($this->input->post('select_type')),
									'ppo_no'		  						=> xss_clean($this->input->post('ppo_no')),
									'status' 								=> xss_clean($this->input->post('status')),
									
								);
				$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
				$this->load->view('header');
				$this->load->view('index',$data);
				$this->load->view('footer');
			}//ends else
		}
		else if($select_type == 'All')
		{ 
			$status 					= xss_clean($this->input->post('status'));

			if($status == 'All')
			{ 
				 $data['all_data_POPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSEF','DELETES'=>'0'));
				$data['all_data_POPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSOF','DELETES'=>'0'));
				$data['all_data_PNPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSEF','DELETES'=>'0'));
				$data['all_data_PNPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSOF','DELETES'=>'0'));

				$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
				$data['insertData'] = array(
							'select_type' 					=> xss_clean($this->input->post('select_type')),
							'status' 								=> xss_clean($this->input->post('status'))
						);

				$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));

				$this->load->view('header');
				$this->load->view('index',$data);
				$this->load->view('footer');
			}

			else
			{
				  $data['all_data_POPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=> $select_type,'DELETES'=>'0','PENSION_STATUS'=> $status));
					$data['all_data_POPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSOF','DELETES'=>'0','PENSION_STATUS'=> $status));
					$data['all_data_PNPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSEF','DELETES'=>'0','PENSION_STATUS'=> $status));
					$data['all_data_PNPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSOF','DELETES'=>'0','PENSION_STATUS'=> $status));

					$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
					$data['insertData'] = array(
							'select_type' 					=> xss_clean($this->input->post('select_type')),
							'status' 								=> xss_clean($this->input->post('status')),
							
						);
					$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
					$this->load->view('header');
					$this->load->view('index',$data);
					$this->load->view('footer');
			}
						 
		 }

	   else
		{ 
			
			$status 					= xss_clean($this->input->post('status'));

			if($status == 'All')
			{ 

				if($select_type == 'POPSEF'){

					 $data['all_data_POPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>$select_type,'DELETES'=>'0'));

				} else if($select_type == 'POPSOF'){

					$data['all_data_POPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>$select_type,'DELETES'=>'0'));

				} else if($select_type == 'PNPSEF'){

					$data['all_data_PNPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>$select_type,'DELETES'=>'0'));

				} else {

					$data['all_data_PNPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>$select_type,'DELETES'=>'0'));
				}

				$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
				$data['insertData'] = array(

							'select_type' 					=> xss_clean($this->input->post('select_type')),
							'status' 						=> xss_clean($this->input->post('status'))
					);

				$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));

				$this->load->view('header');
				$this->load->view('index',$data);
				$this->load->view('footer');
			}

			else
			{

			    if($select_type == 'POPSEF'){

					 $data['all_data_POPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=> $select_type,'DELETES'=>'0','PENSION_STATUS'=> $status));
					 
				} else if($select_type == 'POPSOF'){

					$data['all_data_POPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>$select_type,'DELETES'=>'0','PENSION_STATUS'=> $status));

				} else if($select_type == 'PNPSEF'){

					$data['all_data_PNPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>$select_type,'DELETES'=>'0','PENSION_STATUS'=> $status));

				} else {

					$data['all_data_PNPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>$select_type,'DELETES'=>'0','PENSION_STATUS'=> $status));
				}		

				$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
				$data['insertData'] = array(
						'select_type' 					=> xss_clean($this->input->post('select_type')),
						'status' 						=> xss_clean($this->input->post('status')),
						
					);
				$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
				$this->load->view('header');
				$this->load->view('index',$data);
				$this->load->view('footer');
			}
					 
		 }

		 /*else
		 {
			$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
			$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
			$this->load->view('header');
			$this->load->view('index',$data);
			$this->load->view('footer');;
		 } */
			//echo "<pre>"; print_r($_REQUEST);exit;
      }// ends if

		else
		{

		    $data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
			$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
			$this->load->view('header');
			$this->load->view('index',$data);
			$this->load->view('footer');

		}//ends else


	}//ends function



  public function all_divisions()
	{
		
		$org_id = $this->input->post('id');
		$all_divisions =  $this->Base_model->get_all_record_by_condition('division', array('ORGANIZATION_ID'=>$org_id,'status'=>1));
		
		$all_divisions =  json_encode($all_divisions);
		echo  $all_divisions;
	}


   public function search_contact()
	   {
				if(isset($_REQUEST['submit'])){
					
						$user_name = xss_clean($this->input->post('name'));
						$designation = xss_clean($this->input->post('designation'));
		        $organization = xss_clean($this->input->post('organization'));
		        $division = xss_clean($this->input->post('division'));

	            if($organization=='All')
	            {
	            	$organization = '';
	            }

	            else
	            {
	            	$organization = $organization;
	            }

							$contact = $this->Base_model->search_contact($user_name,$designation,$organization,$division);
							$contacts = array();
			     foreach ($contact as $contact_val) 
			     {
			     	$org_data = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $contact_val->ORGANIZATION_ID)); 

			     	if(empty($org_data))
			     	{
			     		$org_name = ''; 
			     	}

			     	else
			     	{
			     		$org_name = $org_data->ORGNAME;
			     	}

			     	$contact_data['EMPLOYEE_ID'] = $contact_val->EMPLOYEE_ID;
			     	$contact_data['ROLE'] 		 = $contact_val->ROLE;
			     	$contact_data['FULLENAME'] 	 = $contact_val->FULLENAME;
			     	$contact_data['ORGANIZATION_ID'] = $contact_val->ORGANIZATION_ID;
			     	$contact_data['ORGANIZATION_NAME'] = $org_name;
			     	$contact_data['DIVISION_ID'] = $contact_val->DIVISION_ID;
			     	$contact_data['DESIGNATION'] = $contact_val->DESIGNATION;
			     	$contact_data['OFFICENAME']  = $contact_val->OFFICENAME;
			     	$contact_data['EMAIL'] 		 = $contact_val->EMAIL;
			     	$contact_data['MOBILE'] 	 = $contact_val->MOBILE;
			     	$contact_data['LANDLINE_NO'] = $contact_val->LANDLINE_NO;
			     	$contact_data['CREATEDDATE'] = $contact_val->CREATEDDATE;
			     	$contact_data['STATUS'] 	 = $contact_val->STATUS;
			     	$contact_data['LASTMODIFIED'] = $contact_val->LASTMODIFIED;
			     	$contact_data['MODIFIED_BY'] = $contact_val->MODIFIED_BY;
			     	$contact_data['CLIENT_IP'] 	 = $contact_val->CLIENT_IP;
			     	$contact_data['OFFICE_ADDRESS'] = $contact_val->OFFICE_ADDRESS;

			     	$contacts[] =  $contact_data;
			     	
			     }
			     
			     usort($contacts, function($a, $b) {
					return $a['ORGANIZATION_NAME'] <=> $b['ORGANIZATION_NAME'];
					 });
			    
			    $data['all_contacts'] = $contacts;
					
							$data['all_organizations'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
							$data['insertData'] = array(
														'name' 	=> xss_clean($this->input->post('name')),
														'designation' 	=> xss_clean($this->input->post('designation')),
														'organization' 	=> xss_clean($this->input->post('organization')),
														'division' 			=> xss_clean($this->input->post('division')),
														
													);
					    $this->load->view('header');
					    $this->load->view('contactlist',$data);
					    $this->load->view('footer');
			}

			else
			{
				  $contact = $this->Base_model->get_all_contactlist();
				  $contacts = array();
			     foreach ($contact as $contact_val) 
			     {
			     	$org_data = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $contact_val->ORGANIZATION_ID)); 

			     	if(empty($org_data))
			     	{
			     		$org_name = ''; 
			     	}

			     	else
			     	{
			     		$org_name = $org_data->ORGNAME;
			     	}

			     	$contact_data['EMPLOYEE_ID'] = $contact_val->EMPLOYEE_ID;
			     	$contact_data['ROLE'] 		 = $contact_val->ROLE;
			     	$contact_data['FULLENAME'] 	 = $contact_val->FULLENAME;
			     	$contact_data['ORGANIZATION_ID'] = $contact_val->ORGANIZATION_ID;
			     	$contact_data['ORGANIZATION_NAME'] = $org_name;
			     	$contact_data['DIVISION_ID'] = $contact_val->DIVISION_ID;
			     	$contact_data['DESIGNATION'] = $contact_val->DESIGNATION;
			     	$contact_data['OFFICENAME']  = $contact_val->OFFICENAME;
			     	$contact_data['EMAIL'] 		 = $contact_val->EMAIL;
			     	$contact_data['MOBILE'] 	 = $contact_val->MOBILE;
			     	$contact_data['LANDLINE_NO'] = $contact_val->LANDLINE_NO;
			     	$contact_data['CREATEDDATE'] = $contact_val->CREATEDDATE;
			     	$contact_data['STATUS'] 	 = $contact_val->STATUS;
			     	$contact_data['LASTMODIFIED'] = $contact_val->LASTMODIFIED;
			     	$contact_data['MODIFIED_BY'] = $contact_val->MODIFIED_BY;
			     	$contact_data['CLIENT_IP'] 	 = $contact_val->CLIENT_IP;
			     	$contact_data['OFFICE_ADDRESS'] = $contact_val->OFFICE_ADDRESS;

			     	$contacts[] =  $contact_data;
			     	
			     }
			     
			     usort($contacts, function($a, $b) {
					return $a['ORGANIZATION_NAME'] <=> $b['ORGANIZATION_NAME'];
					 });
			    
			    $data['all_contacts'] = $contacts;
					$data['all_organizations'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
			    $data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
			    $this->load->view('header');
			    $this->load->view('contactlist',$data);
			    $this->load->view('footer');
			}
		
	  }//ends function

	  /***********report function*********/

	  public function report()
	  {

	    $select_type  = xss_clean($this->input->post('select_type'));
		$month  	  = xss_clean($this->input->post('month'));
		$division  	  = xss_clean($this->input->post('division'));
		$organisation_name  	  = xss_clean($this->input->post('organisation_name'));

	  	if(isset($_REQUEST['submit'])) 
		{ 

			if($select_type=='1')
			{
				
				if($organisation_name=='All')
				{
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1' ";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1'";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1' ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1' ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 
					if(!empty($org_data))
					{
						usort($org_data, function($a, $b) 
					{
						return $a['organisation_name'] <=> $b['organisation_name'];
					});

					}//

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));

					
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
						'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

					$this->load->view('header');
					$this->load->view('report_all',$data);
					$this->load->view('footer');
				}//ends if orgn

				else
				{
	
						/*$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1'  ";        
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();*/

						 $result1 = $this->Base_model->check1($organisation_name,'POPSEF');

						/********result2*****/

						/*$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1' ";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();*/

						$result2 = $this->Base_model->check1($organisation_name,'POPSOF');
 
						/********result3**********/

						/*$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1'  ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();*/

						$result3 = $this->Base_model->check1($organisation_name,'PNPSEF');

						/***************result4*************/

						/*$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1' ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();*/

						$result4 = $this->Base_model->check1($organisation_name,'PNPSOF');

						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;

						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
				}//ends else orgn
				
			}//ends if

			//****************************select type 2 means search month****************/

			else if($select_type=='2')
			{
				
				$select_type  = xss_clean($this->input->post('select_type'));
				$month  	  = xss_clean($this->input->post('month'));

					if($organisation_name=='All')
					{
						$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {
					 	
						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 
						if(!empty($org_data))
						{
							usort($org_data, function($a, $b) 
						{
							return $a['organisation_name'] <=> $b['organisation_name'];
						});

						}//

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> xss_clean($this->input->post('month')),
							'division' 	=> '',
							'from_date' => '',
							'to_date' 	=> ''
						);

						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');   
						
					}//ends if orgn

					else
					{
						
						/*$sql1 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1"; 
						      
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();*/

						 $result1 = $this->Base_model->check2($organisation_name,'POPSEF',$month);

						/********result2*****/

						/*$sql2 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
							 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
							WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";   

						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();*/

						 $result2 = $this->Base_model->check2($organisation_name,'POPSOF',$month);

						/********result3**********/

						/*$sql3 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
							 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
							WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();*/

						$result3 = $this->Base_model->check2($organisation_name,'PNPSEF',$month);

						/***************result4*************/

						/*$sql4 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
							 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
							WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();*/

						$result4 = $this->Base_model->check2($organisation_name,'PNPSOF',$month);


						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> xss_clean($this->input->post('month')),
							'division' 	=> '',
							'from_date' => '',
							'to_date' 	=> ''
						);
						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
					}//ends else orgn
				
			}//ends else if 2 

			/*************************Search division wise********************/

			else if($select_type=='3')
			{
				
				$select_type  = xss_clean($this->input->post('select_type'));
				$division  	  = xss_clean($this->input->post('division'));

				if($organisation_name=='All' && $division== 'All' || $organisation_name=='All' && empty($division))
				{
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {
					 	

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE  penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE  penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
				}

				
				if(!empty($org_data))
				{
					usort($org_data, function($a, $b) 
				{
					return $a['organisation_name'] <=> $b['organisation_name'];
				});

				}//

				$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));

						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> '',
							'division' 	=> xss_clean($this->input->post('division')),
							'from_date' => '',
							'to_date' 	=> ''
						);
						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');
			}	

				else if($organisation_name=='All' && $division)
				{
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {
					 	
					
						/*$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penrecord.DIVIS_DEAL_NAME = '".$division."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();*/

						 $result1 = $this->Base_model->check32($organisation_name,'POPSEF',$division);

						/* $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DIVIS_DEAL_NAME = '".$division."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();*/
						 $result2 = $this->Base_model->check32($organisation_name,'POPSOF',$division);

				
						/*$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DIVIS_DEAL_NAME = '".$division."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();*/
						$result3 = $this->Base_model->check32($organisation_name,'PNPSEF',$division);

						/*$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DIVIS_DEAL_NAME = '".$division."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();*/

						$result4 = $this->Base_model->check32($organisation_name,'PNPSOF',$division);

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 
						if(!empty($org_data))
						{
							usort($org_data, function($a, $b) 
						{
							return $a['organisation_name'] <=> $b['organisation_name'];
						});

						}//

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> '',
							'division' 	=> xss_clean($this->input->post('division')),
							'from_date' => '',
							'to_date' 	=> ''
						);

						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');

					
				}// ends if orgn

				else
				{
					////$organisation_name = "9'";
					/*$sql1 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
					 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
					 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
					 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
					WHERE  penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1"; 
					      
					$rs1 = $this->db->query($sql1);
					$result1 = $rs1->result();*/

					$result1 = $this->Base_model->check31($organisation_name,'POPSEF',$division);

					/********result2*****/

					/*$sql2 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";   

					$rs2 = $this->db->query($sql2);
					$result2 = $rs2->result();*/

					$result2 = $this->Base_model->check31($organisation_name,'POPSOF',$division);

					/********result3**********/

					/*$sql3 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
					$rs3 = $this->db->query($sql3);
					$result3 = $rs3->result();*/

					$result3 = $this->Base_model->check31($organisation_name,'PNPSEF',$division);

					/***************result4*************/

					/*$sql4 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
					$rs4 = $this->db->query($sql4);
					$result4 = $rs4->result();*/

					$result4 = $this->Base_model->check31($organisation_name,'PNPSOF',$division);


					$data['all_data_POPSEF']  = $result1;
					$data['all_data_POPSOF']  = $result2;
					$data['all_data_PNPSEF']  = $result3;
					$data['all_data_PNPSOF']  = $result4;
					$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
					$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;

					$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> '',
							'division' 	=> xss_clean($this->input->post('division')),
							'from_date' => '',
							'to_date' 	=>''
						);
						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
				}//ends else orgn

				
			}//ends else if 3

			/*****************Search date of retirement wise*****************/

			else if($select_type=='4')
			{
				
				$select_type  = xss_clean($this->input->post('select_type'));
				$from_date    = xss_clean($this->input->post('from_date'));
				$from_date    = str_replace('/', '-', $from_date);
				$from_date    = date('Y-m-d', strtotime($from_date));
				$to_date  	  = xss_clean($this->input->post('to_date'));
				$to_date      = str_replace('/', '-', $to_date);
				$to_date      = date('Y-m-d', strtotime($to_date));

				if($organisation_name=='All')
				{
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {
					 	

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 
						if(!empty($org_data))
						{
							usort($org_data, function($a, $b) 
						{
							return $a['organisation_name'] <=> $b['organisation_name'];
						});

						}//

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));

						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> '',
							'division' 	=> '',
							'from_date' => xss_clean($this->input->post('from_date')),
							'to_date' 	=> xss_clean($this->input->post('to_date'))
						);

						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');
						
					
				}//ends if orgn

				else
				{
					/*$sql1 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
					 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
					 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
					 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
					WHERE  penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1"; 
					      
					$rs1 = $this->db->query($sql1);
					$result1 = $rs1->result();*/

					$result1 = $this->Base_model->check4($organisation_name,'POPSEF',$from_date,$to_date);

					/********result2*****/

					/*$sql2 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";   

					$rs2 = $this->db->query($sql2);
					$result2 = $rs2->result();*/

					$result2 = $this->Base_model->check4($organisation_name,'POPSOF',$from_date,$to_date);

					/********result3**********/

					/*$sql3 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
					$rs3 = $this->db->query($sql3);
					$result3 = $rs3->result();*/

					$result3 = $this->Base_model->check4($organisation_name,'PNPSEF',$from_date,$to_date);

					/***************result4*************/

					/*$sql4 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
					$rs4 = $this->db->query($sql4);
					$result4 = $rs4->result();*/

					$result4 = $this->Base_model->check4($organisation_name,'PNPSOF',$from_date,$to_date);


					$data['all_data_POPSEF']  = $result1;
					$data['all_data_POPSOF']  = $result2;
					$data['all_data_PNPSEF']  = $result3;
					$data['all_data_PNPSOF']  = $result4;
					$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
					$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
					$data['organisation_name']  = $orgnstion->ORGNAME;
					$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> '',
							'division' 	=> '',
							'from_date' => xss_clean($this->input->post('from_date')),
							'to_date' 	=> xss_clean($this->input->post('to_date'))
						);

					
						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
				}//ends else orgnn
				
			}//ends else if 4

			/**************Ends Search date of retirement wise*****************/

			/***************** All Pension Cases pending for submission and pending for settlement *****************/

			else if($select_type=='5')
			{ 
				
					if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 
						if(!empty($org_data))
						{
							usort($org_data, function($a, $b) 
						{
							return $a['organisation_name'] <=> $b['organisation_name'];
						});

						}//

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);


						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');
				}//ends if orgn

				else
				{
						/*$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();*/

						$result1 = $this->Base_model->check5($organisation_name,'POPSEF');

						/********result2*****/

						/*$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();*/

						$result2 = $this->Base_model->check5($organisation_name,'POPSOF');

						/********result3**********/

						/*$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending'AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();*/

						$result3 = $this->Base_model->check5($organisation_name,'PNPSEF');

						/***************result4*************/

						/*$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();*/

						$result4 = $this->Base_model->check5($organisation_name,'PNPSOF');


						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);


						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
				}//ends else orgn
				

				
			}//ends else if 5

			/************** End All Pension Cases pending for submission and pending for settlement *****************/

		/***************** Pension Cases pending for submission *****************/

			else if($select_type=='6')
			{ 
				
				if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach

					  usort($org_data, function($a, $b) {
				    return $a['organisation_name'] <=> $b['organisation_name'];
					 });

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);


						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');
				}//ends if orgn

				else
				{
						/*$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();*/

						$result1 = $this->Base_model->check6($organisation_name,'POPSEF');

						/********result2*****/

						/*$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();*/

						$result2 = $this->Base_model->check6($organisation_name,'POPSOF');

						/********result3**********/

						/*$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending'AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();*/

						$result3 = $this->Base_model->check6($organisation_name,'PNPSEF');

						/***************result4*************/

						/*$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();*/

						$result4 = $this->Base_model->check6($organisation_name,'PNPSOF');


						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
				}//ends else orgn

			}//ends else if 6

			/***********************Ends Pension Cases pending for submission *************************/

			/***************** Pension Cases pending for settlement *****************/

			else if($select_type=='7')
			{ 
				
				if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 	 usort($org_data, function($a, $b) {
				    return $a['organisation_name'] <=> $b['organisation_name'];
					 });

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);


						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');
				}//ends if orgn

				else
				{
						/*$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();*/

						$result1 = $this->Base_model->check7($organisation_name,'POPSEF');

						/********result2*****/

						/*$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();*/

						$result2 = $this->Base_model->check7($organisation_name,'POPSOF');

						/********result3**********/

						/*$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending'AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();
*/
						$result3 = $this->Base_model->check7($organisation_name,'PNPSEF');

						/***************result4*************/

						/*$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();*/

						$result4 = $this->Base_model->check7($organisation_name,'PNPSOF');


						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);


						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
				}//ends else orgn

			}//ends else if 7

			/***********************Ends Pension Cases pending for settlement *************************/

			/********************** Pension Cases settled ************************/

			else if($select_type=='8')
			{ 
				
				if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 
					  usort($org_data, function($a, $b) {
				    return $a['organisation_name'] <=> $b['organisation_name'];
					 });

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);


						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');
				}//ends if orgn

				else
				{
						/*$sql1 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();*/

						$result1 = $this->Base_model->check8($organisation_name,'POPSEF');

						/********result2*****/

						/*$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();*/
						$result2 = $this->Base_model->check8($organisation_name,'POPSOF');

						/********result3**********/

						/*$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled'AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();*/

						$result3 = $this->Base_model->check8($organisation_name,'PNPSEF');

						/***************result4*************/

						/*$sql4 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();*/

						$result4 = $this->Base_model->check8($organisation_name,'PNPSOF');


						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);


						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
				}//ends else orgn
			}//ends else if 8

			/***********************Ends Pension Cases settled *************************/

			/***********************All Pension Cases *************************/

			else if($select_type=='9')
			{ 
				
				if($organisation_name=='All')
				{ 

					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 
					 usort($org_data, function($a, $b) {
				    return $a['organisation_name'] <=> $b['organisation_name'];
					 });

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');
				}//ends if orgn

				else
				{
						//////$organisation_name = "9'";

						/*$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";   

					  $result1 = $this->Base_model->check9($organisation_name);
		       
						/*$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();*/

						$result1 = $this->Base_model->check9($organisation_name,'POPSEF');

						/********result2*****/

						/*$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();*/

						$result2 = $this->Base_model->check9($organisation_name,'POPSOF');

						/********result3**********/

						/*$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();*/

						$result3 = $this->Base_model->check9($organisation_name,'PNPSEF');

						/***************result4*************/

						/*$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();*/

						$result4 = $this->Base_model->check9($organisation_name,'PNPSOF');

						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						
						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
				}//ends else orgn
			}//ends else if 9

			else if($select_type=='POPSEF')
			{ 
				
				if($organisation_name=='All')
				{ 

					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = '".$select_type."' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 
					 usort($org_data, function($a, $b) {
				    return $a['organisation_name'] <=> $b['organisation_name'];
					 });

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');
				}//ends if orgn

				else
				{
						

					   $result1 = $this->Base_model->check9($organisation_name,$select_type);

					   $data['all_data_POPSEF']  = $result1;

						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						
						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
				}//ends else orgn
			}//ends else if 10

           else if($select_type=='POPSOF')
			{ 
				
				if($organisation_name=='All')
				{ 

					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = '".$select_type."' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSOF'] = $result2;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 
					 usort($org_data, function($a, $b) {
				    return $a['organisation_name'] <=> $b['organisation_name'];
					 });

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');
				}//ends if orgn

				else
				{		

						$result2 = $this->Base_model->check9($organisation_name,$select_type);
						$data['all_data_POPSOF']  = $result2;

						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						
						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
				}//ends else orgn
			}//ends else if 11


			else if($select_type=='PNPSEF')
			{ 
				
				if($organisation_name=='All')
				{ 

					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = '".$select_type."' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						
						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_PNPSEF'] = $result3;  

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 
					 usort($org_data, function($a, $b) {
				    return $a['organisation_name'] <=> $b['organisation_name'];
					 });

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');
				}//ends if orgn

				else
				{
						

						$result3 = $this->Base_model->check9($organisation_name,$select_type);

						$data['all_data_PNPSEF']  = $result3;

						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						
						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
				}//ends else orgn
			}//ends else if 12


			else if($select_type=='PNPSOF')
			{ 
				
				if($organisation_name=='All')
				{ 

					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = '".$select_type."' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME; 
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 
					 usort($org_data, function($a, $b) {
				    return $a['organisation_name'] <=> $b['organisation_name'];
					 });

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');
				}//ends if orgn

				else
				{
						

						$result4 = $this->Base_model->check9($organisation_name,$select_type);
						
						$data['all_data_PNPSOF']  = $result4;

						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						
						$this->load->view('header');
						$this->load->view('report',$data);
						$this->load->view('footer');
				}//ends else orgn
			}//ends else if 13


			/***********************Ends All Pension Cases *************************/

			else
			{
					echo "Sorry, no data found.";
			}
		}//ends if

		else
		{
			
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						
						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 	$data['insertData'] = array(
								'type' 	=> xss_clean($this->input->post('select_type')),
								'org_name' 	=> xss_clean($this->input->post('organisation_name')),
								'month' 	=>   '',
								'division' 	=> '',
								'from_date' =>'',
								'to_date' 	=> ''
							);
					 
					 usort($org_data, function($a, $b) {
				    return $a['organisation_name'] <=> $b['organisation_name'];
					 });

					 	
					
						$data['all_org_data']  = $org_data;
						
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));

						
						$this->load->view('header');
						$this->load->view('report_all',$data);
						$this->load->view('footer');
		}// endsghsgsgsg else
	  	
	  
	  }// ends function

	  
	 /****************function for forget password****************/

	  public function forgetpwd()
	  {

	  	if(isset($_REQUEST['submit'])) 
			{
					$email 	= trim(xss_clean($this->input->post('email')));

					$this->form_validation->set_rules('email','Email','trim|required');

					if($this->form_validation->run() === false) 
					{
							$this->load->view('header');
							$this->load->view('forgetpassword');
							$this->load->view('footer');
					}// ends if

					else
						{
								 date_default_timezone_set('Asia/Calcutta'); 
								 $created_date =  date("Y-m-d H:i:s");
								 $length = '8';
					 			 $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
						     $charactersLength = strlen($characters);
						    
						     $randomString = '';
						     for ($i = 0; $i < $length; $i++) 
						     {
						         $randomString .= $characters[rand(0, $charactersLength - 1)];
						     }

							    if(empty($randomString))
							    {
							    	$randomString = 'Pension123';
							    }

							    else
							    {
							    	$randomString = $randomString;
							    }

							    $ency_password = hash('sha256', $randomString);

							    /*********updated data*************/

							    $update_data = array(
							
									'NEWPASSWORD' 	        => $ency_password,
									'NEWPASSWORDSTATUS' 	  => '1',
									'LASTSESSION'   				=> $created_date,
									'CLIENIP' 							=> $_SERVER['REMOTE_ADDR']
								);

							    $userdata = $this->Base_model->get_record_by_id('users',array('EMAIL' => $email));
							    $updateid = $this->Base_model->update_record_by_id('users', $update_data, array('EMAIL'=> $email));

							    $link = base_url().'Frontend/link/'.$ency_password;
							    /*$message     = "Dear " . $userdata->FULLNAME . ",<br><br>";
            	   	$message    .= "Your new password is " . $randomString . ".<br>Click here on link, to activate new password " . $link . "<br><br>";
            	   
            	   	$message    .= " <br><br>
                    --  Best Regards, <br>Pension Team"; */

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

									$mail->addAddress($userdata->EMAIL, 'Forget Password Pension CWC');     // Add a recipient
									$mail->addReplyTo('supportpension@gov.in', 'Forget Password Pension CWC');

									$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
									$mail->isHTML(true);                                  // Set email format to HTML

									$mail->Subject = 'Pension Forget Password';
									$mail->Body    = "Dear " . $userdata->FULLNAME . ",<br><br>";
									$mail->Body   .= "Your new password is " . $randomString . ".<br>Click here on link, to activate new password " . $link . "<br><br>";
									$mail->Body   .= " <br><br>
				                    --  Best Regards, <br>CWC Pension Team"; 

				          $send = $mail->send();

						      /*$this->load->library('email');
							  	$this->email->set_mailtype("html");
							  	$this->email->from('sriabhinav7071@gmail.com');
							  	$this->email->to($userdata->EMAIL);
							  	$this->email->subject('Forget Password Mail');
							  	$this->email->message($message);
							  	$send = $this->email->send();*/


							    if($send=='1')
									{
											$msg = "New password and link send to your email, Please check.";
											$this->session->set_flashdata('flashforgetSuccess_user',$msg);
											$this->load->view('header');
											$this->load->view('forgetpassword',$msg);
											$this->load->view('footer');
									}

									else
									{
											$msg = "Fail to send password.";
											$this->session->set_flashdata('flashErrorforget_user',$msg);
											$this->load->view('header');
											$this->load->view('forgetpassword',$msg);
											$this->load->view('footer');
									}
						}// ends else

			}// ends if
			else
			{
					$this->load->view('header');
					$this->load->view('forgetpassword');
					$this->load->view('footer');

			}// ends else		
	  }// ends function

	  /****************function for link activate****************/

	  public function link()
	  {
	  	$uri = $this->uri->segment('3');

	  		if(empty($uri))
	  		{
	  			redirect('Frontend');
	  		}// ends if

	  		else
	  		{
	  			  date_default_timezone_set('Asia/Calcutta'); 
					  $created_date =  date("Y-m-d H:i:s");

	  			 	$checked = $this->Base_model->check_existent('users', array('NEWPASSWORD'=> $uri));
	  			 	$checked2 = $this->Base_model->check_existent('users', array('NEWPASSWORD'=> $uri,'NEWPASSWORDSTATUS'=>0));

	  			 	if($checked == 0)
	  			 	{
	  			 		redirect('Frontend');
	  			 	}// ends if

	  			 	else if($checked2 == 1)
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
       							
       							$msg = "This link is expired.";
										$this->session->set_flashdata('flashErrorlink_user',$msg);

        						$data['captcha'] = $captcha['word'];
										$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
										$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
										$this->load->view('header',$data);
										$this->load->view('index',$data);
										$this->load->view('footer');

	  			 	}// ends else if

	  			 	else
	  			 	{
	  			 		$userdata = $this->Base_model->get_record_by_id('users',array('NEWPASSWORD' => $uri));

	  			 		$update_data = array(
									
									'PASSWORD'							=> $userdata->NEWPASSWORD,
									'NEWPASSWORDSTATUS' 	  => '0',
									'LASTSESSION'   				=> $created_date,
									'CLIENIP' 							=> $_SERVER['REMOTE_ADDR']
								);

							  $updateid = $this->Base_model->update_record_by_id('users', $update_data, array('NEWPASSWORD'=> $uri));

							  if($updateid)
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
       							
       							$msg = "New password updated.";
										$this->session->set_flashdata('flashSuccesslink_user',$msg);

        						$data['captcha'] = $captcha['word'];
										$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
										$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
										$this->load->view('header',$data);
										$this->load->view('index',$data);
										$this->load->view('footer');

							  }// ends if
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
       							
       							$msg = "Fail to update new password.";
										$this->session->set_flashdata('flashErrorlink_user',$msg);

        						$data['captcha'] = $captcha['word'];
										$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
										$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata', array('status'=>'1','delete_status'=>'0'));
										$this->load->view('header',$data);
										$this->load->view('index',$data);
										$this->load->view('footer');

							  }// ends elssseeee
	  			 	}// ends elseee
	  		}// ends else
	  }// ends function


	
}// ends class
