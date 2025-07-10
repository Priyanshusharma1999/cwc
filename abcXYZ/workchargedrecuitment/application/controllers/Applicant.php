<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicant extends CI_Controller {

	// Initialize Constructor Here
	function __construct()
	{
		parent::__construct();
		$this->load->model('Base_model');
		$this->load->library('Pdf');

		$applicantdata = $this->Base_model->get_record_by_id('tbl_applicant', array('id' =>$this->session->userdata('applicant_user_id')));

		if(empty($this->session->userdata('applicant_user_id')))
	     {
	     	$base_url = base_url().'Frontend/logout';
	         redirect($base_url);
	     } 

	     if($applicantdata->password != $this->session->userdata('applicant_pwd'))

		 {
		 	 $base_url = base_url().'Frontend/logout';
		     redirect($base_url);
		 }

 
	}

	/**
	 * Index Page for this controller.
	 */

	public function index()
	{

	}

	public function dashboard()
	{
		$segment_id = $this->uri->segment('3');

		$uri = $this->session->userdata('applicant_user_id');

		if($segment_id!=$uri)
		{
			
			$base_url = base_url();

			redirect($base_url.'Applicant/logout');
		}

		else
		{
			    $applicant_id = $this->session->userdata('applicant_user_id');
				$applicant_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $applicant_id));
				$data['insertData'] = array(
								'full_name' 	=> $applicant_data->name,
								'email' 			=> $applicant_data->email,
								'mobile_no' 	=> $applicant_data->mobile_no,
								'dob' 				=> $applicant_data->dob,
								'gender' 			=> $applicant_data->gender
							);
				
				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
				$data['all_circle']    = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
				$data['all_jobs']    = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
				$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
				$data['city'] = $this->Base_model->get_all_record_by_condition('district_master',NULL);

				$job_applied_data = $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'pending_status'=>0));
				$job_education_data = $this->Base_model->get_record_by_id('tbl_app_job_edu_info', array('basic_info_id' => $job_applied_data->id));
				$job_other_info_data = $this->Base_model->get_record_by_id('tbl_app_job_oth_info', array('basic_info_id' => $job_applied_data->id));
				
				
			$region_data = $this->Base_model->get_record_by_id('tbl_region', array('id' => $job_applied_data->region_id));

			$circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $job_applied_data->circle_id));

			$jobbb_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $job_applied_data->job_id));

			$posst_datta = $this->Base_model->get_record_by_id('tbl_post', array('id' => $job_applied_data->post_id));

	      $data['all_job_Applied_data'] =  array(

					'region_name' 					    =>  $job_applied_data->region_id,
					'circle_name' 					    =>  $job_applied_data->circle_id,
					'skilled_name' 					    =>  $job_applied_data->job_id,
					'post_code' 					    =>  $posst_datta->post_name.'-'.$posst_datta->post_code,
					'total_vacancy' 				    =>  $jobbb_data->total_vacancy,
					'full_name'  					    =>  $job_applied_data->full_name,
				  'father_name'  					    =>  $job_applied_data->father_name,
				  'email'  								=>  $job_applied_data->email,
				  'mobile_no'  							=>  $job_applied_data->mobile_no,
				  'dob'  								=>  $job_applied_data->dob,
				  'gender'  							=>  $job_applied_data->gender,
				 'highschool_metriculation'  			=>  empty($job_education_data) ? '' : $job_education_data->highschool_metriculation ,
				 'highschool_board_name'  				=>  empty($job_education_data) ? '' : $job_education_data->highschool_board_name ,
				
				 'highschool_passing_year'  			=>  empty($job_education_data) ? '' : $job_education_data->highschool_passing_year ,
				 'highschool_total_marks'  				=>  empty($job_education_data) ? '' : $job_education_data->highschool_total_marks ,
				 'highschool_marks_obtained'  		=>  empty($job_education_data) ? '' : $job_education_data->highschool_marks_obtained ,
				 'highschool_percentage'  				=>  empty($job_education_data) ? '' : $job_education_data->highschool_percentage ,
				
				 'graduation_qualification'  			=> empty($job_education_data) ? '' : $job_education_data->graduation_board_name ,
				 'graduation_passing_year'  			=> empty($job_education_data) ? '' : $job_education_data->graduation_passing_year ,
				 'graduation_total_marks'  				=> empty($job_education_data) ? '' : $job_education_data->graduation_total_marks ,
				 'graduation_marks_obtained'  		=> empty($job_education_data) ? '' : $job_education_data->graduation_marks_obtained ,
				 'graduation_percentage'  				=> empty($job_education_data) ? '' : $job_education_data->graduation_percentage ,

				 'post_graduation_qualification'  => empty($job_education_data) ? '' : $job_education_data->post_graduation_board_name ,
				 'post_graduation_passing_year'  	=> empty($job_education_data) ? '' : $job_education_data->post_graduation_passing_year ,
				 'post_graduation_total_marks'  	=> empty($job_education_data) ? '' : $job_education_data->post_graduation_total_marks ,
				 'post_graduation_marks_obtained' => empty($job_education_data) ? '' : $job_education_data->post_graduation_marks_obtained ,
				 'post_graduation_percentage'  		=> empty($job_education_data) ? '' : $job_education_data->post_graduation_percentage ,

				 'others_qualification'  					=> empty($job_education_data) ? '' : $job_education_data->others_board_name ,
				 'others_passing_year'  					=> empty($job_education_data) ? '' : $job_education_data->others_passing_year ,
				 'others_total_marks'  						=> empty($job_education_data) ? '' : $job_education_data->others_total_marks ,
				 'others_marks_obtained'  				=> empty($job_education_data) ? '' : $job_education_data->others_marks_obtained ,
				 'others_percentage'  						=> empty($job_education_data) ? '' : $job_education_data->others_percentage ,

				 'caste_category'  								=> empty($job_other_info_data) ? '' : $job_other_info_data->caste_category ,
				 'religion'  											=> empty($job_other_info_data) ? '' : $job_other_info_data->religion ,
				 'marital_status'  								=> empty($job_other_info_data) ? '' : $job_other_info_data->marital_status ,
				 'aadhar_no'  										=> empty($job_other_info_data) ? '' : $job_other_info_data->aadhar_no ,
				 'nationality'  									=> empty($job_other_info_data) ? '' : $job_other_info_data->nationality ,
				 'ex_serviceman'  								=> empty($job_other_info_data) ? '' : $job_other_info_data->ex_serviceman ,
				 'physical_fitness'  							=> empty($job_other_info_data) ? '' : $job_other_info_data->physical_fitness ,
				 'employment_exchange'  					=> empty($job_other_info_data) ? '' : $job_other_info_data->employment_exchange_reg_no ,
				 'physically_candicapped'  				=> empty($job_other_info_data) ? '' : $job_other_info_data->physically_handicapp ,
				 'present_address'  							=> empty($job_other_info_data) ? '' : $job_other_info_data->present_address ,
				 'present_address_state'  				=> empty($job_other_info_data) ? '' : $job_other_info_data->present_address_state ,
				 'present_address_city'  					=> empty($job_other_info_data) ? '' : $job_other_info_data->present_address_city ,
				 'present_address_pincode'  			=> empty($job_other_info_data) ? '' : $job_other_info_data->present_address_pincode ,
				 'permanent_address'  						=> empty($job_other_info_data) ? '' : $job_other_info_data->permanent_address ,
				 'permanent_address_state'  			=> empty($job_other_info_data) ? '' : $job_other_info_data->permanent_address_state ,
				 'permanent_address_city'  				=> empty($job_other_info_data) ? '' : $job_other_info_data->permanent_address_city ,
				 'permanent_address_pincode'  		=>  empty($job_other_info_data) ? '' : $job_other_info_data->permanent_address_pincode ,

		);
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/dashboard',$data);
				$this->load->view('admin/footer');	

		}//ends else session check

		

	}//ends function
	

	/**************Applicant Logout Function*************/

	public function logout()
	{
			$base_url = base_url().'Frontend/login';
			if ($this->session->userdata('applicant_user_id')) {
					$this->session->unset_userdata('applicant_username');
					$this->session->sess_destroy();
					redirect($base_url);
			} 
			else
			 {
				$base_url = base_url().'Frontend/login';
				redirect($base_url);
			 }
	}// ends function


	public function job_apply()
	{
			if(isset($_REQUEST['submit'])) 
			{	
				
			 $region_id  		= xss_clean(strip_tags($this->input->post('region_name')));
			 $circle_id  		= xss_clean(strip_tags($this->input->post('circle_name')));
			 $job_id  			= xss_clean(strip_tags($this->input->post('skilled_name')));
			 $post_id  			= xss_clean(strip_tags($this->input->post('post_code')));
			 $full_name  		= xss_clean(strip_tags($this->input->post('full_name')));
			 $father_name  	    = xss_clean(strip_tags($this->input->post('father_name')));
			 $email  			= xss_clean(strip_tags($this->input->post('email')));
			 $mobile_no  		= xss_clean(strip_tags($this->input->post('mobile_no')));
			 $dob  				= xss_clean(strip_tags($this->input->post('dob')));
			 $gender  			= xss_clean(strip_tags($this->input->post('gender')));


		 $highschool_metriculation  			= xss_clean(strip_tags($this->input->post('highschool_metriculation')));
		 $highschool_board_name  				= xss_clean(strip_tags($this->input->post('highschool_board_name')));
		 $highschool_passing_year  				= xss_clean(strip_tags($this->input->post('highschool_passing_year')));
		 $highschool_total_marks  				= xss_clean(strip_tags($this->input->post('highschool_total_marks')));
		 $highschool_marks_obtained  			= xss_clean(strip_tags($this->input->post('highschool_marks_obtained')));
		 $highschool_percentage  				= xss_clean(strip_tags($this->input->post('highschool_percentage')));
		 $intermediate_metriculation  		= xss_clean(strip_tags($this->input->post('intermediate_metriculation')));
		 $intermediate_board_name  				= xss_clean(strip_tags($this->input->post('intermediate_board_name')));
		 $intermediate_passing_year  			= xss_clean(strip_tags($this->input->post('intermediate_passing_year')));
		 $intermediate_total_marks  			= xss_clean(strip_tags($this->input->post('intermediate_total_marks')));
		 $intermediate_marks_obtained  		= xss_clean(strip_tags($this->input->post('intermediate_marks_obtained')));
		 $intermediate_percentage  				= xss_clean(strip_tags($this->input->post('intermediate_percentage')));
		 $graduation_qualification  			= xss_clean(strip_tags($this->input->post('graduation_qualification')));
		 $graduation_passing_year  				= xss_clean(strip_tags($this->input->post('graduation_passing_year')));
		 $graduation_total_marks  				= xss_clean(strip_tags($this->input->post('graduation_total_marks')));
		 $graduation_marks_obtained  			= xss_clean(strip_tags($this->input->post('graduation_marks_obtained')));
		 $graduation_percentage  					= xss_clean(strip_tags($this->input->post('graduation_percentage')));
		 $post_graduation_qualification  	= xss_clean(strip_tags($this->input->post('post_graduation_qualification')));
		 $post_graduation_passing_year  	= xss_clean(strip_tags($this->input->post('post_graduation_passing_year')));
		 $post_graduation_total_marks  		= xss_clean(strip_tags($this->input->post('post_graduation_total_marks')));
		 $post_graduation_marks_obtained  = xss_clean(strip_tags($this->input->post('post_graduation_marks_obtained')));
		 $post_graduation_percentage  		= xss_clean(strip_tags($this->input->post('post_graduation_percentage')));
		 $others_qualification  					= xss_clean(strip_tags($this->input->post('others_qualification')));
		 $others_passing_year  						= xss_clean(strip_tags($this->input->post('others_passing_year')));
		 $others_total_marks  						= xss_clean(strip_tags($this->input->post('others_total_marks')));
		 $others_marks_obtained  					= xss_clean(strip_tags($this->input->post('others_marks_obtained')));
		 $others_percentage  							= xss_clean(strip_tags($this->input->post('others_percentage')));


		 $caste_category  						= xss_clean(strip_tags($this->input->post('caste_category')));
		 $religion  									= xss_clean(strip_tags($this->input->post('religion')));
		 $marital_status  						= xss_clean(strip_tags($this->input->post('marital_status')));
		 $aadhar_no  									= xss_clean(strip_tags($this->input->post('aadhar_no')));
		 $nationality  								= xss_clean(strip_tags($this->input->post('nationality')));
		 $ex_serviceman  							= xss_clean(strip_tags($this->input->post('ex_serviceman')));
		 $physical_fitness  					= xss_clean(strip_tags($this->input->post('physical_fitness')));
		 $employment_exchange 				= xss_clean(strip_tags($this->input->post('employment_exchange')));
		 $physically_candicapped  		= xss_clean(strip_tags($this->input->post('physically_candicapped')));
		 $present_address  						= xss_clean(strip_tags($this->input->post('present_address')));
		 $present_address_state  			= xss_clean(strip_tags($this->input->post('present_address_state')));
		 $present_address_city  			= xss_clean(strip_tags($this->input->post('present_address_city')));
		 $present_address_pincode 		= xss_clean(strip_tags($this->input->post('present_address_pincode')));
		 $permanent_address  					= xss_clean(strip_tags($this->input->post('permanent_address')));
		 $permanent_address_state 		= xss_clean(strip_tags($this->input->post('permanent_address_state')));
		 $permanent_address_city  		= xss_clean(strip_tags($this->input->post('permanent_address_city')));
		 $permanent_address_pincode  	= xss_clean(strip_tags($this->input->post('permanent_address_pincode')));

		 $working_experience  				= xss_clean(strip_tags($this->input->post('working_experience')));
			

		 $this->form_validation->set_rules('region_name','region name','trim|required');
		 $this->form_validation->set_rules('circle_name','circle name','trim|required');
		 $this->form_validation->set_rules('skilled_name','job name','trim|required');
		 $this->form_validation->set_rules('post_code','post name and code','trim|required');
		 $this->form_validation->set_rules('full_name','full name','trim|required');
		 $this->form_validation->set_rules('father_name','father name','trim|required');
		 $this->form_validation->set_rules('email','email','trim|required');
		 $this->form_validation->set_rules('mobile_no','mobile no','trim|required');
		 $this->form_validation->set_rules('dob','date of birth','trim|required');
		 $this->form_validation->set_rules('gender','gender','trim|required');

		 $this->form_validation->set_rules('highschool_board_name','highschool board name','trim|required');
		 $this->form_validation->set_rules('highschool_passing_year','highschool passing year','trim|required');
		 // $this->form_validation->set_rules('highschool_total_marks','highschool total marks','trim|required');
		 // $this->form_validation->set_rules('highschool_marks_obtained','highschool marks','trim|required');
		 $this->form_validation->set_rules('highschool_percentage','highschool percentage','trim|required');

		 $this->form_validation->set_rules('caste_category','category','trim|required');
		 $this->form_validation->set_rules('religion','religion','trim|required');
		 $this->form_validation->set_rules('marital_status','marital status','trim|required');
	
		 $this->form_validation->set_rules('nationality','nationality','trim|required');
		 $this->form_validation->set_rules('ex_serviceman','ex-serviceman','trim|required');
		 $this->form_validation->set_rules('physical_fitness','physical fitness','trim|required');
		 
		 $this->form_validation->set_rules('physically_candicapped','physically handicapped','trim|required');
		 $this->form_validation->set_rules('present_address','address','trim|required');
		 $this->form_validation->set_rules('present_address_state','state','trim|required');
		 $this->form_validation->set_rules('present_address_city','city','trim|required');
		 $this->form_validation->set_rules('present_address_pincode','pincode','trim|required');
		 $this->form_validation->set_rules('permanent_address','permanent address','trim|required');
		 $this->form_validation->set_rules('permanent_address_state','state','trim|required');
		 $this->form_validation->set_rules('permanent_address_city','city','trim|required');
		 $this->form_validation->set_rules('permanent_address_pincode','pincode','trim|required');

				if($this->form_validation->run() === false) 
				{		

				
					
					$data['insertData'] = array(

					 'region_name'  									=> xss_clean($this->input->post('region_name')),
					 'circle_name'  									=> xss_clean($this->input->post('circle_name')),
					 'skilled_name'  									=> xss_clean($this->input->post('skilled_name')),
					 'post_code'  										=> xss_clean($this->input->post('post_code')),
					 'full_name'  										=> xss_clean($this->input->post('full_name')),
					 'father_name'  									=> xss_clean($this->input->post('father_name')),
					 'email'  												=> xss_clean($this->input->post('email')),
					 'mobile_no'  										=> xss_clean($this->input->post('mobile_no')),
					 'dob'  													=> xss_clean($this->input->post('dob')),
					 'gender'  												=> xss_clean($this->input->post('gender')),
					 'highschool_metriculation'  			=> xss_clean($this->input->post('highschool_metriculation')),
					 'highschool_board_name'  				=> xss_clean($this->input->post('highschool_board_name')),
					 'highschool_passing_year'  			=> xss_clean($this->input->post('highschool_passing_year')),
					 'highschool_total_marks'  				=> xss_clean($this->input->post('highschool_total_marks')),
					 'highschool_marks_obtained'  		=> xss_clean($this->input->post('highschool_marks_obtained')),
					 'highschool_percentage'  				=> xss_clean($this->input->post('highschool_percentage')),
					 'intermediate_metriculation'  		=> xss_clean($this->input->post('intermediate_metriculation')),
					 'intermediate_board_name'  			=> xss_clean($this->input->post('intermediate_board_name')),
					 'intermediate_passing_year'  		=> xss_clean($this->input->post('intermediate_passing_year')),
					 'intermediate_total_marks'  			=> xss_clean($this->input->post('intermediate_total_marks')),
					 'intermediate_marks_obtained'  	=> xss_clean($this->input->post('intermediate_marks_obtained')),
					 'intermediate_percentage'  			=> xss_clean($this->input->post('intermediate_percentage')),
					 'graduation_qualification'  			=> xss_clean($this->input->post('graduation_qualification')),
					 'graduation_passing_year'  			=> xss_clean($this->input->post('graduation_passing_year')),
					 'graduation_total_marks'  				=> xss_clean($this->input->post('graduation_total_marks')),
					 'graduation_marks_obtained'  		=> xss_clean($this->input->post('graduation_marks_obtained')),
					 'graduation_percentage'  				=> xss_clean($this->input->post('graduation_percentage')),
					 'post_graduation_qualification'  => xss_clean($this->input->post('post_graduation_qualification')),
					 'post_graduation_passing_year'  	=> xss_clean($this->input->post('post_graduation_passing_year')),
					 'post_graduation_total_marks'  	=> xss_clean($this->input->post('post_graduation_total_marks')),
					 'post_graduation_marks_obtained' => xss_clean($this->input->post('post_graduation_marks_obtained')),
					 'post_graduation_percentage'  		=> xss_clean($this->input->post('post_graduation_percentage')),
					 'others_qualification'  					=> xss_clean($this->input->post('others_qualification')),
					 'others_passing_year'  					=> xss_clean($this->input->post('others_passing_year')),
					 'others_total_marks'  						=> xss_clean($this->input->post('others_total_marks')),
					 'others_marks_obtained'  				=> xss_clean($this->input->post('others_marks_obtained')),
					 'others_percentage'  						=> xss_clean($this->input->post('others_percentage')),
					 'caste_category'  								=> xss_clean($this->input->post('caste_category')),
					 'religion'  											=> xss_clean($this->input->post('religion')),
					 'marital_status'  								=> xss_clean($this->input->post('marital_status')),
					 'aadhar_no'  										=> xss_clean($this->input->post('aadhar_no')),
					 'nationality'  									=> xss_clean($this->input->post('nationality')),
					 'ex_serviceman'  								=> xss_clean($this->input->post('ex_serviceman')),
					 'physical_fitness'  							=> xss_clean($this->input->post('physical_fitness')),
					 'employment_exchange'  					=> xss_clean($this->input->post('employment_exchange')),
					 'physically_candicapped'  				=> xss_clean($this->input->post('physically_candicapped')),
					 'present_address'  							=> xss_clean($this->input->post('present_address')),
					 'present_address_state'  				=> xss_clean($this->input->post('present_address_state')),
					 'present_address_city'  					=> xss_clean($this->input->post('present_address_city')),
					 'present_address_pincode'  			=> xss_clean($this->input->post('present_address_pincode')),
					 'permanent_address'  						=> xss_clean($this->input->post('permanent_address')),
					 'permanent_address_state'  			=> xss_clean($this->input->post('permanent_address_state')),
					 'permanent_address_city'  				=> xss_clean($this->input->post('permanent_address_city')),
					 'permanent_address_pincode'  		=> xss_clean($this->input->post('permanent_address_pincode')),
					
					);
				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
				$applicant_id = $this->session->userdata('applicant_user_id');
				$applicant_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $applicant_id));
				$data['insertData'] = array(
							'full_name' 	=> $applicant_data->name,
							'email' 		=> $applicant_data->email,
							'mobile_no' 	=> $applicant_data->mobile_no,
							'dob' 			=> $applicant_data->dob,
							'gender' 		=> $applicant_data->gender
						);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/dashboard',$data);
					$this->load->view('admin/footer');

		  }// ends if

				else
				{

					//echo 'else part..............'; exit;

					
						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s"); 

							/*****check applicant_apply_job********/
						$post_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' =>$job_id,'region_id'=>$region_id,'circle_id'=>$circle_id));

						$applicant_id = $this->session->userdata('applicant_user_id');
						$checked_apply_job = $this->Base_model->check_existent('tbl_app_job_bas_info', array('region_id' => $region_id,'circle_id' => $circle_id,'job_id' => $job_id,'post_id' => $post_data->post_id,'applicant_id'=> $applicant_id,'pending_status' => 1));

						/*****ends check applicant_apply_job*****/

						/**********Job*****/

							$job_data 		= $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $job_id,'region_id'=>$region_id,'circle_id'=>$circle_id));

								$current_date =  date("Y-m-d");

								$job_end_date = $job_data->end_date;


						/******ends job data******/
						if($checked_apply_job=='1')
							{
								$msg = "You have already applied for this job.";
								$this->session->set_flashdata('flashError_applied_job', $msg);
								$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/dashboard',$data);
								$this->load->view('admin/footer');

							}//ends if

							else if($current_date > $job_end_date)
							{
								$msg = "Sorry, job already expired.";
								$this->session->set_flashdata('flashError_applied_job', $msg);
								$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/dashboard',$data);
								$this->load->view('admin/footer');

							}//ends if

						else
							{

								$applicant_id = $this->session->userdata('applicant_user_id');
								$img_name 	  	= str_replace(' ','_', $img_namee);
								$img_name1 	  	= str_replace(' ','_', $img_namee1);
								$img_name2 	  	= str_replace(' ','_', $img_namee2);
								$img_name3 	  	= str_replace(' ','_', $img_namee3);
								$region_id  		= xss_clean($this->input->post('region_name'));
				 				$circle_id  		= xss_clean($this->input->post('circle_name'));
								$job_id  				= xss_clean($this->input->post('skilled_name'));
								$post_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' =>$job_id,'region_id'=>$region_id,'circle_id'=>$circle_id));
								
								//insert basic information
								 $previous_post_data 		= $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'pending_status'=>0));

									$basic_info_id = $previous_post_data->id;
									$applicant_id = $this->session->userdata('applicant_user_id');
									$update_data = array(
										 'region_id'  	=> xss_clean(strip_tags($this->input->post('region_name'))),
										 'applicant_id' => $applicant_id,
										 'circle_id'  	=> xss_clean(strip_tags($this->input->post('circle_name'))),
										 'job_id'  			=> xss_clean(strip_tags($this->input->post('skilled_name'))),
										 'post_id'  		=> $post_data->post_id,
									    'full_name'  	=> xss_clean(strip_tags($this->input->post('full_name'))),
										 'father_name'  => xss_clean(strip_tags($this->input->post('father_name'))),
										 'email'  			=> xss_clean(strip_tags($this->input->post('email'))),
										 'gender'  			=> xss_clean($this->input->post('gender')),
										 'mobile_no'  	=> xss_clean($this->input->post('mobile_no')),
										 'dob'  				=> xss_clean($this->input->post('dob')),
										 'pending_status'=>1,
										 'updated_date' 	=> $created_date
									);

				$updateid = $this->Base_model->update_record_by_id('tbl_app_job_bas_info', $update_data, array('id'=> $basic_info_id));

								

  $update_data2 = array(

		 'basic_info_id'					=> $basic_info_id,
		 'highschool_metriculation'			=> xss_clean(strip_tags($this->input->post('highschool_metriculation'))),
		 'highschool_board_name'  			=> xss_clean(strip_tags($this->input->post('highschool_board_name'))),
		 'highschool_passing_year'  		=> xss_clean(strip_tags($this->input->post('highschool_passing_year'))),
		 'highschool_total_marks'  			=> xss_clean(strip_tags($this->input->post('highschool_total_marks'))),
		 'highschool_marks_obtained'  		=> xss_clean(strip_tags($this->input->post('highschool_marks_obtained'))),
		 'highschool_percentage'  			=> xss_clean(strip_tags($this->input->post('highschool_percentage'))),
		 'intermediate_metriculation'	    => xss_clean(strip_tags($this->input->post('intermediate_metriculation'))),
		 'intermediate_board_name'  		=> xss_clean(strip_tags($this->input->post('intermediate_board_name'))),
		 'intermediate_passing_year'  		=> xss_clean(strip_tags($this->input->post('intermediate_passing_year'))),
		 'intermediate_total_marks'  		=> xss_clean(strip_tags($this->input->post('intermediate_total_marks'))),
		 'intermediate_marks_obtained'  	=> xss_clean(strip_tags($this->input->post('intermediate_marks_obtained'))),
		 'intermediate_percentage'  		=> xss_clean(strip_tags($this->input->post('intermediate_percentage'))),
		 'graduation_board_name'  			=> xss_clean(strip_tags($this->input->post('graduation_qualification'))),
		 'graduation_passing_year'  		=> xss_clean(strip_tags($this->input->post('graduation_passing_year'))),
		 'graduation_total_marks'  			=> xss_clean(strip_tags($this->input->post('graduation_total_marks'))),
		 'graduation_marks_obtained'  		=> xss_clean(strip_tags($this->input->post('graduation_marks_obtained'))),
		 'graduation_percentage'  			=> xss_clean(strip_tags($this->input->post('graduation_percentage'))),
		 'post_graduation_board_name'  		=> xss_clean(strip_tags($this->input->post('post_graduation_qualification'))),
		 'post_graduation_passing_year'  	=> xss_clean(strip_tags($this->input->post('post_graduation_passing_year'))),
		 'post_graduation_total_marks'  	=> xss_clean(strip_tags($this->input->post('post_graduation_total_marks'))),
		 'post_graduation_marks_obtained'   => xss_clean(strip_tags($this->input->post('post_graduation_marks_obtained'))),
		 'post_graduation_percentage'  		=> xss_clean(strip_tags($this->input->post('post_graduation_percentage'))),
		 'others_board_name'  				=> xss_clean(strip_tags($this->input->post('others_qualification'))),
		 'others_passing_year'  			=> xss_clean(strip_tags($this->input->post('others_passing_year'))),
		 'others_total_marks'  				=> xss_clean(strip_tags($this->input->post('others_total_marks'))),
		 'others_marks_obtained'  			=> xss_clean(strip_tags($this->input->post('others_marks_obtained'))),
		 'others_percentage'  				=> xss_clean(strip_tags($this->input->post('others_percentage'))),
		 'updated_date' 					=> $created_date
		);


		$updateid2 = $this->Base_model->update_record_by_id('tbl_app_job_edu_info', $update_data2, array('basic_info_id'=> $basic_info_id));

								
   $update_data3 = array(
			 'basic_info_id'					 => $basic_info_id,
			 'caste_category'  					=> xss_clean(strip_tags($this->input->post('caste_category'))),
			 'religion'  						=> xss_clean(strip_tags($this->input->post('religion'))),
			 'marital_status'  					=> xss_clean(strip_tags($this->input->post('marital_status'))),
			 'nationality'  					=> xss_clean(strip_tags($this->input->post('nationality'))),
			
			 'ex_serviceman'  					=> xss_clean(strip_tags($this->input->post('ex_serviceman'))),
			 'physical_fitness'  				=> xss_clean(strip_tags($this->input->post('physical_fitness'))),
			 'employment_exchange_reg_no' 		=> xss_clean(strip_tags($this->input->post('employment_exchange'))),
			 'physically_handicapp'  			=> xss_clean(strip_tags($this->input->post('physically_candicapped'))),
			  'present_address'  				=> xss_clean(strip_tags($this->input->post('present_address'))),
			 'present_address_state'  			=> xss_clean(strip_tags($this->input->post('present_address_state'))),
			 'present_address_city'  			=> xss_clean(strip_tags($this->input->post('present_address_city'))),
			 'present_address_pincode'  		=> xss_clean(strip_tags($this->input->post('present_address_pincode'))),
			 'permanent_address'  				=> xss_clean(strip_tags($this->input->post('permanent_address'))),
			 'permanent_address_state'  		=> xss_clean(strip_tags($this->input->post('permanent_address_state'))),
			 'permanent_address_city'  			=> xss_clean(strip_tags($this->input->post('permanent_address_city'))),
			 'permanent_address_pincode'  		=> xss_clean(strip_tags($this->input->post('permanent_address_pincode'))),
			
				'updated_date' 										=> $created_date
		);

										$updateid3 = $this->Base_model->update_record_by_id('tbl_app_job_oth_info', $update_data3, array('basic_info_id'=> $basic_info_id));

										  $applicant_id = $this->session->userdata('applicant_user_id');
											$img_name 	  	= str_replace(' ','_', $img_namee);
											$img_name1 	  	= str_replace(' ','_', $img_namee1);
											$img_name2 	  	= str_replace(' ','_', $img_namee2);
											$img_name3 	  	= str_replace(' ','_', $img_namee3);

											if(empty($img_name))
											{
												$img_name = '';
											}

											else
											{
												$img_name = $img_name;
											}
											//
											if(empty($img_name1))
											{
												$img_name1 = '';
											}

											else
											{
												$img_name1 = $img_name1;
											}

											//

											if(empty($img_name2))
											{
												$img_name2 = '';
											}

											else
											{
												$img_name2 = $img_name2;
											}
											//

											if(empty($img_name3))
											{
												$img_name3 = '';
											}

											else
											{
												$img_name3 = 	$img_name3;
											}

					$update_data4 = array(

									 'basic_info_id' 										=> $basic_info_id,
									 'working_experience'								=> xss_clean($this->input->post('working_experience')),		 
									 'updated_date' 										=> $created_date
								);

					$updateid4 = $this->Base_model->update_record_by_id('tbl_app_job_doc_info', $update_data4, array('basic_info_id'=> $basic_info_id));


							$applicant_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $this->session->userdata('applicant_user_id')));
				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
				$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($basic_info_id);

				$data['region_data'] = $this->Base_model->get_record_by_id('tbl_region', array('id' => $all_job_data[0]->region_id));
				$data['circle_data'] = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $all_job_data[0]->circle_id));
				$data['post_data'] = $this->Base_model->get_record_by_id('tbl_post', array('id' => $all_job_data[0]->post_id));
				$data['job_data'] = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $all_job_data[0]->job_id));
				$data['present_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->present_address_state));
				$data['permanent_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->permanent_address_state));
				if(empty($all_job_data[0]->file_uploaded_photo))
					{
						$file_uploaded_photo = 'no-image.jpg';
					}

					else
					{
						$file_uploaded_photo = $all_job_data[0]->file_uploaded_photo;
					}

					if(empty($all_job_data[0]->file_dob_certificate))
					{
						$file_dob_certificate = 'no-image.jpg';
					}

					else
					{
						$file_dob_certificate = $all_job_data[0]->file_dob_certificate;
					}

					if(empty($all_job_data[0]->file_matriculation_marksheet))
					{
						$file_matriculation_marksheet = 'no-image.jpg';
					}

					else
					{
						$file_matriculation_marksheet = $all_job_data[0]->file_matriculation_marksheet;
					}

					if(empty($all_job_data[0]->file_sc_st_obc_certitificate))
					{
						$file_sc_st_obc_certitificate = 'no-image.jpg';
					}

					else
					{
						$file_sc_st_obc_certitificate = $all_job_data[0]->file_sc_st_obc_certitificate;
					}

					$data['upload_photo'] = $base_url.'uploads/uploaded_photo/'.$file_uploaded_photo;

				
					$data['dobbb'] = $file_dob_certificate;
					
					$data['matriculation'] = $file_matriculation_marksheet;
				
					$data['scst'] = $file_sc_st_obc_certitificate;
				
				/*************PDF Code***************/
			
				 $applicant_id = $this->session->userdata('applicant_user_id');
		         $user_name = $this->session->userdata('applicant_username');
		         $pdf_name = $user_name.'_'.$applicant_id.'_'.time();

				/*********Ends PDF Code*************/

				$updateid = $this->Base_model->update_record_by_id('tbl_app_job_bas_info', array('pdf_name'=> $pdf_name), array('id'=> $basic_info_id));

				$data['pdf_name'] = $pdf_name;
				$this->load->view('pdf',$data);

								if($basic_info_id)
											{
												$msg = "Job applied successfully.";
												$this->session->set_flashdata('flashSuccess_applied_job',$msg);
												$this->load->library('email');
					                            $this->email->from('sriabhinav7071@gmail.com');
					                            $this->email->to($applicant_data->email);
					                            $this->email->subject('CWC JOB');
					                            $this->email->message('You have applied for one new job');
					                            $this->email->send();
												$data['insertData'] = array(
																'full_name' 	=> $applicant_data->name,
																'email' 		=> $applicant_data->email,
																'mobile_no' 	=> $applicant_data->mobile_no,
																'dob' 			=> $applicant_data->dob,
																'gender' 		=> $applicant_data->gender
															);
											
													$this->load->view('admin/header');
													$this->load->view('admin/sidebar');
													$this->load->view('admin/dashboard',$data);
													$this->load->view('admin/footer');
												 
											}

											else
											{
												$msg = "Fail to applied job.";
												$this->session->set_flashdata('flashError_applied_job', $msg);
												$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
												$applicant_id = $this->session->userdata('applicant_user_id');
												$applicant_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $applicant_id));
												$data['insertData'] = array(
																'full_name' 	=> $applicant_data->name,
																'email' 		=> $applicant_data->email,
																'mobile_no' 	=> $applicant_data->mobile_no,
																'dob' 			=> $applicant_data->dob,
																'gender' 		=> $applicant_data->gender
															);
													$this->load->view('admin/header');
													$this->load->view('admin/sidebar');
													$this->load->view('admin/dashboard',$data);
													$this->load->view('admin/footer');
											}

							}// ends else


				}// ends else
				 

			}//ends if

			else
			{
				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
				$applicant_id = $this->session->userdata('applicant_user_id');
				$applicant_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $applicant_id));
				$data['insertData'] = array(
								'full_name' 	=> $applicant_data->name,
								'email' 		=> $applicant_data->email,
								'mobile_no' 	=> $applicant_data->mobile_no,
								'dob' 			=> $applicant_data->dob,
								'gender' 		=> $applicant_data->gender
							);



					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/dashboard',$data);
					$this->load->view('admin/footer');

			}// ends else
		
	}//function ends

	/*********function genarate pdf**********/

	public function generate_pdf($basic_info_job_id)
	{
		
		$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($basic_info_job_id);
		$this->load->view('pdf',$data);
	}

/*********function for job list*******/

	public function job_list()
	{

		$segment_id = $this->uri->segment('3');

		$uri = $this->session->userdata('applicant_user_id');

		if($segment_id!=$uri)
		{
			$base_url = base_url();
			redirect($base_url.'Applicant/logout');
		}

		else
		{
				$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
				$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

				$applicant_id = $this->session->userdata('applicant_user_id');
				$data['all_applicant_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info', array('applicant_id'=>$applicant_id,'status' => '1'));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/jobs/joblist',$data);
				$this->load->view('admin/footer');

		}// ends else session check


		
		
	}// ends function

	/*******function to gettting all circles********/

	public function all_circle()
	{
		
		$region_id = $this->input->post('id');
		$all_circle =  $this->Base_model->get_all_record_by_condition('tbl_circle', array('region_id'=>$region_id,'status'=>1));
		$all_circles =  json_encode($all_circle);
		echo  $all_circles;

	}// ends function

	/*******function to gettting all city********/

	public function all_city()
	{
		
		$city_id = $this->input->post('id');
		$all_cities =  $this->Base_model->get_all_record_by_condition('district_master', array('State_Code'=>$city_id));
		$all_city =  json_encode($all_cities);
		echo  $all_city;

	}// ends function

	/*******function to gettting all job********/

	public function all_job()
	{
		
		$region_id = $this->input->post('region_id');
		$circle_id = $this->input->post('circle_id');
		$all_job =  $this->Base_model->getts_jobss($region_id,$circle_id);
		$all_jobs =  json_encode($all_job);
		echo  $all_jobs;

	}// ends function


	/***********function for post data*******/

	public function post_data()
	{
		
		$job_id = $this->input->post('job_id');
		$job_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $job_id,'job_status' =>1, 'status' => 1));
		$post_data = $this->Base_model->get_record_by_id('tbl_post', array('id' => $job_data->post_id,'status'=>1));

		if(empty($post_data))
		{
				$post = array(

				'id' => $post_data->id,
				'name' =>'',
				'total_vacancy' => ''
				);
		}

		else
		{
				$post = array(

				'id' => $post_data->id,
				'name' => $post_data->post_name.'-'.$post_data->post_code,
				'total_vacancy' => $job_data->total_vacancy
				);
		}
		
		$posts =  json_encode($post);
		echo  $posts;

	}// ends function

	/***********function for job data*******/

	public function job_data()
	{
		$base_url = base_url();
		$job_id = $this->input->get('id');
		$all_job_data = $this->Base_model->all_job_data($job_id);
		$region_data = $this->Base_model->get_record_by_id('tbl_region', array('id' => $all_job_data[0]->region_id));
		$circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $all_job_data[0]->circle_id));
		$post_data = $this->Base_model->get_record_by_id('tbl_post', array('id' => $all_job_data[0]->post_id));
		$job_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $all_job_data[0]->job_id));
		
		if(empty($all_job_data[0]->file_uploaded_photo))
		{
			$file_uploaded_photo = 'no-image.jpg';
		}

		else
		{
			$file_uploaded_photo = $all_job_data[0]->file_uploaded_photo;
		}

		if(empty($all_job_data[0]->file_dob_certificate))
		{
			$file_dob_certificate = 'no-image.jpg';
		}

		else
		{
			$file_dob_certificate = $all_job_data[0]->file_dob_certificate;
		}

		if(empty($all_job_data[0]->file_matriculation_marksheet))
		{
			$file_matriculation_marksheet = 'no-image.jpg';
		}

		else
		{
			$file_matriculation_marksheet = $all_job_data[0]->file_matriculation_marksheet;
		}

		if(empty($all_job_data[0]->file_sc_st_obc_certitificate))
		{
			$file_sc_st_obc_certitificate = 'no-image.jpg';
		}

		else
		{
			$file_sc_st_obc_certitificate = $all_job_data[0]->file_sc_st_obc_certitificate;
		}
		
		$job_data = array(
					 'status'													=> 'success',
					 'basic_info_id'									=> $all_job_data[0]->basic_info_id,
					 'region_name'  									=> $region_data->region_name,
					 'circle_name'  									=> $circle_data->circle_name,
					 'skilled_name'  									=> $job_data->job_title,
					 'post_code'  										=> $post_data->post_name.'-'.$post_data->post_code,
					 'full_name'  										=> $all_job_data[0]->full_name,
					 'father_name'  									=> $all_job_data[0]->father_name,
					 'email'  												=> $all_job_data[0]->email,
					 'mobile_no'  										=> $all_job_data[0]->mobile_no,
					 'dob'  													=> $all_job_data[0]->dob,
					 'gender'  												=> $all_job_data[0]->gender,
					 'highschool_metriculation'  			=> $all_job_data[0]->highschool_metriculation,
					 'highschool_board_name'  				=> $all_job_data[0]->highschool_board_name,
					 'highschool_passing_year'  			=> $all_job_data[0]->highschool_passing_year,
					 'highschool_total_marks'  				=> $all_job_data[0]->highschool_total_marks,
					 'highschool_marks_obtained'  		=> $all_job_data[0]->highschool_marks_obtained,
					 'highschool_percentage'  				=> $all_job_data[0]->highschool_percentage,
					 'intermediate_board_name'  			=> $all_job_data[0]->intermediate_board_name,
					 'intermediate_passing_year'  		=> $all_job_data[0]->intermediate_passing_year,
					 'intermediate_total_marks'  			=> $all_job_data[0]->intermediate_total_marks,
					 'intermediate_marks_obtained'  	=> $all_job_data[0]->intermediate_marks_obtained,
					 'intermediate_percentage'  			=> $all_job_data[0]->intermediate_percentage,
					 'graduation_qualification'  			=> $all_job_data[0]->graduation_board_name,
					 'graduation_passing_year'  			=> $all_job_data[0]->graduation_passing_year,
					 'graduation_total_marks'  				=> $all_job_data[0]->graduation_total_marks,
					 'graduation_marks_obtained'  		=> $all_job_data[0]->graduation_marks_obtained,
					 'graduation_percentage'  				=> $all_job_data[0]->graduation_percentage,
					 'post_graduation_qualification'  => $all_job_data[0]->post_graduation_board_name,
					 'post_graduation_passing_year'  	=> $all_job_data[0]->post_graduation_passing_year,
					 'post_graduation_total_marks'  	=> $all_job_data[0]->post_graduation_total_marks,
					 'post_graduation_marks_obtained' => $all_job_data[0]->post_graduation_marks_obtained,
					 'post_graduation_percentage'  		=> $all_job_data[0]->post_graduation_percentage,
					 'others_qualification'  					=> $all_job_data[0]->others_board_name,
					 'others_passing_year'  					=> $all_job_data[0]->others_passing_year,
					 'others_total_marks'  						=> $all_job_data[0]->others_total_marks,
					 'others_marks_obtained'  				=> $all_job_data[0]->others_marks_obtained,
					 'others_percentage'  						=> $all_job_data[0]->others_percentage,
					 'caste_category'  								=> $all_job_data[0]->caste_category,
					 'religion'  											=> $all_job_data[0]->religion,
					 'marital_status'  								=> $all_job_data[0]->marital_status,
				 	 'aadhar_no'  										=> $all_job_data[0]->aadhar_no,
					 'nationality'										=> $all_job_data[0]->nationality,
					 'ex_serviceman'  								=> $all_job_data[0]->ex_serviceman,
					 'physical_fitness'  							=> $all_job_data[0]->physical_fitness,
					 'employment_exchange'  					=> $all_job_data[0]->employment_exchange_reg_no,
					 'physically_candicapped'  				=> $all_job_data[0]->physically_handicapp,
					 'present_address'  							=> $all_job_data[0]->present_address,
					 'present_address_state'  				=> $all_job_data[0]->present_address_state,
					 'present_address_city'  					=> $all_job_data[0]->present_address_city,
					 'present_address_pincode'  			=> $all_job_data[0]->present_address_pincode,
					 'permanent_address'  						=> $all_job_data[0]->permanent_address,
					 'permanent_address_state'  			=> $all_job_data[0]->permanent_address_state,
					 'permanent_address_city'  				=> $all_job_data[0]->permanent_address_city,
					 'permanent_address_pincode'  		=> $all_job_data[0]->permanent_address_pincode,
					 'file_uploaded_photo'  					=> $base_url.'uploads/uploaded_photo/'.$file_uploaded_photo,
					 'file_dob_certificate'  					=> $base_url.'uploads/dob_certificate/'.$file_dob_certificate,
					 'file_matriculation_marksheet'  	=> $base_url.'uploads/matriculation_certificate/'.$file_matriculation_marksheet,
					 'file_sc_st_obc_certitificate'  	=> $base_url.'uploads/scc_St_obc_certificate/'.$file_sc_st_obc_certitificate,
		);

		$jjob_data =  json_encode($job_data);
		echo  $jjob_data;

	}// ends function

		/*************function for search job*********/

	public function search_job()
	{

			$region_name = xss_clean($this->input->post('regiion_name'));
			$circle_name = xss_clean($this->input->post('circlle_name'));
			$post_name 	 = xss_clean($this->input->post('posst_name'));

				if(empty($region_name) && empty($circle_name) && empty($post_name))
				{
					$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
					$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

					$applicant_id = $this->session->userdata('applicant_user_id');
					$data['all_applicant_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info', array('applicant_id'=>$applicant_id,'status' => '1'));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/jobs/joblist',$data);
					$this->load->view('admin/footer');

				}//ends if

				else
				{
						$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
						$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

						$applicant_id = $this->session->userdata('applicant_user_id');

						if($region_name && $circle_name && $post_name)
						{
								$data['all_applicant_jobs'] =  $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info', array('applicant_id'=>$applicant_id,'status' => '1','region_id'=>$region_name,'circle_id'=>$circle_name,'post_id'=>$post_name));
						}

						else if(empty($region_name) && $circle_name && $post_name)
						{
								$data['all_applicant_jobs'] =  $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info', array('applicant_id'=>$applicant_id,'status' => '1','circle_id'=>$circle_name,'post_id'=>$post_name));
						}

						else if($region_name && empty($circle_name) && $post_name)
						{
								$data['all_applicant_jobs'] =  $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info', array('applicant_id'=>$applicant_id,'status' => '1','region_id'=>$region_name,'post_id'=>$post_name));
						}

						else if($region_name && $circle_name && empty($post_name))
						{
								$data['all_applicant_jobs'] =  $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info', array('applicant_id'=>$applicant_id,'status' => '1','region_id'=>$region_name,'circle_id'=>$circle_name));
						}

						else if($region_name && empty($circle_name) && empty($post_name))
						{
								$data['all_applicant_jobs'] =  $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info', array('applicant_id'=>$applicant_id,'status' => '1','region_id'=>$region_name));
						}

						else if(empty($region_name) && $circle_name && empty($post_name))
						{
								$data['all_applicant_jobs'] =  $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info', array('applicant_id'=>$applicant_id,'status' => '1','circle_id'=>$circle_name));
						}

						else if(empty($region_name) && empty($circle_name) && $post_name)
						{
								$data['all_applicant_jobs'] =  $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info', array('applicant_id'=>$applicant_id,'status' => '1','post_id'=>$post_name));
						}

						else
						{
							$data['all_applicant_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info', array('applicant_id'=>$applicant_id,'status' => '1'));
						}
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/jobs/joblist',$data);
						$this->load->view('admin/footer');


				}


	}//ends function

	/*************function for get region data*********/

	public function region_all_data()
	{
		$region_id = $this->input->post('region_id');
		$region_data = $this->Base_model->get_record_by_id('tbl_region', array('id' => $region_id));
		$region = array(
		'region_name' => $region_data->region_name,
		);
		$regions =  json_encode($region);
		echo  $regions;

	}//ends function

	/*************function for get circle data*********/

	public function circle_all_data()
	{
		$circle_id = $this->input->post('circle_id');
		$circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $circle_id));
		$circle = array(
		'circle_name' => $circle_data->circle_name,
		);
		$circles =  json_encode($circle);
		echo  $circles;
		
	}//ends function

	/*************function for get job data*********/

	public function job_all_data()
	{
		$job_id = $this->input->post('job_id');
		$job_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $job_id));
		$job = array(
		'job_title' => $job_data->job_title,
		);
		$jobs =  json_encode($job);
		echo  $jobs;
		
	}//ends function

	/*************function for all applicant basioc info data*********/

	public function all_applicant_basic_info_data()
	{
		$applicant_user_id = $this->input->post('applicant_user_id');
		 $applicant_post_data     = $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('applicant_id' =>$this->session->userdata('applicant_user_id'),'pending_status'=>0));

        $basic_info_id = $applicant_post_data->id;
        $applicant_dattta = $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('id' => $basic_info_id));
              
                

       $pdf_name =  $applicant_dattta->pdf_name; 

		$pdf = array(
		'pdf_name' => $pdf_name,
		);
		$pdfs =  json_encode($pdf);
		echo  $pdfs;
		
	}//ends function



	/*************function for get state data*********/

	public function state_data()
	{
		$state_id = $this->input->post('state_id');
		$state_data = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $state_id));
		$state = array(
		'state_name' => $state_data->StateName_In_English,
		);
		$states =  json_encode($state);
		echo  $states;
		
	}//ends function

	/*************function for get post data*********/

	public function post_all_data()
	{
		$post_id = $this->input->post('post_id');
		$circle_id = $this->input->post('circle_id');
		$region_id = $this->input->post('region_id');
		$job_id = $this->input->post('job_id');
		$post_datttta = $this->Base_model->get_record_by_id('tbl_jobs', array('id' =>$job_id,'region_id'=>$region_id,'circle_id'=>$circle_id));
		$post_data = $this->Base_model->get_record_by_id('tbl_post', array('id' => $post_datttta->post_id));
		$post = array(
		'post_codee' => $post_data->post_code,
		);
		$posts =  json_encode($post);
		echo  $posts;
		
	}//ends function


	/***********function for edit profile**********/

	public function edit_profile()
	{
			$segment_id = $this->uri->segment('3');
			$uri = $this->session->userdata('applicant_user_id');

			if($segment_id!=$uri)
			{
				$base_url = base_url();
				redirect($base_url.'Applicant/logout');
			}

			else
			{

			$uri = $this->session->userdata('applicant_user_id'); 

			if(isset($_REQUEST['submit'])) 
			{

			  $name  = xss_clean(strip_tags($this->input->post('full_name')));
			  $email  = xss_clean(strip_tags($this->input->post('email')));
			  $mobile_no  = xss_clean(strip_tags($this->input->post('mobile_no')));
			  $dob  = xss_clean($this->input->post('dob'));
			  $gender  = xss_clean($this->input->post('gender'));
			  $password  = xss_clean($this->input->post('password'));
			  $old_passworrd  = xss_clean($this->input->post('old_passworrd'));
			  $cnfrm_passworrd  = xss_clean($this->input->post('cnfrm_passworrd'));
			 

				$this->form_validation->set_rules('full_name','user name','trim|required');
				$this->form_validation->set_rules('email','email','trim|required');
				$this->form_validation->set_rules('mobile_no','mobile no','trim|required');
				$this->form_validation->set_rules('dob','dob','trim|required');
				$this->form_validation->set_rules('gender','gender','trim|required');
			
				if($this->form_validation->run() === false) 
					{

						$data['insertData'] = array(
						'full_name' => xss_clean($this->input->post('full_name')),
						'email' => xss_clean($this->input->post('email')),
						'mobile_no' => xss_clean($this->input->post('mobile_no')),
						'dob' => xss_clean($this->input->post('dob')),
						'gender' => xss_clean($this->input->post('gender')),
						'password' => xss_clean($this->input->post('password')),
						);

						$uri = $this->session->userdata('applicant_user_id');
						$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/editprofile',$data);
						$this->load->view('admin/footer');

					}

				else
					{
						$user_id =  $this->session->userdata('applicant_user_id'); 
						$checked_email = $this->Base_model->check_applicant_query($email, $user_id);
						$old_passworrd  = xss_clean($this->input->post('old_passworrd'));
						$user_data 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));

							if($checked_email ==1)
							{
									$msg = "Please use different email, as this is used by someone else.";
									$this->session->set_flashdata('flashError_profileupdate',$msg);
									$uri = $this->session->userdata('applicant_user_id');
									$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/editprofile',$data);
									$this->load->view('admin/footer');
							}//ends if

							else if($old_passworrd !=$user_data->password)
							{
									$msg = "Old Password not matched.";
									$this->session->set_flashdata('flashError_profileupdate',$msg);
									$uri = $this->session->userdata('applicant_user_id');
									$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/editprofile',$data);
									$this->load->view('admin/footer');

							} 

							else
							{

							 if($_FILES['applicant_pic']['name'])
				                {	
									/***********File upload code*******/
							$user_id =  $this->session->userdata('applicant_user_id'); 
							$user_name = $this->session->userdata('applicant_username');
							$pic_name = $user_name.'_'.$user_id.'_'.time().'_photo_';

							$finfo = new finfo(FILEINFO_MIME_TYPE);

							$uploaded_file_name  = $_FILES['applicant_pic']['name'];
					
				            $count_dots = substr_count($uploaded_file_name, '.');

					       if($count_dots > 1)
					       {

							$msg = "Please select correct file.";

							$this->session->set_flashdata('flashError_profileupdate', $msg);

							$uri = $this->session->userdata('applicant_user_id');
							$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/editprofile',$data);
							$this->load->view('admin/footer');


						} else if (false === $ext = array_search(
					        
					        $finfo->file($_FILES['applicant_pic']['tmp_name']),
					        array(
					            'jpg' => 'image/jpeg',
					            'png' => 'image/png',
							   ),
					        true

					    )) {


				           $msg = "This type of file is not allowed. Please select file in correct formate.";

							$this->session->set_flashdata('flashError_profileupdate', $msg);

							$uri = $this->session->userdata('applicant_user_id');
							$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/editprofile',$data);
							$this->load->view('admin/footer');

					     } else {

					     
				                  $configg = array(
				                             'upload_path' => "./uploads/applicant_profile_photos/",
				                             'allowed_types' => "jpg|png|jpeg|",
				                             'overwrite' => TRUE,
				                             'max_size' => "4096000", 
				                             'file_name' => $pic_name.$_FILES["applicant_pic"]['name'],
				                             );              
				                   $this->load->library('upload', $configg);
				                   $this->upload->initialize($configg);
				                   $img_namee= $_FILES['applicant_pic']['name'];
				                   $pic['item_image']= $img_namee;
				                   $this->load->library('upload',$configg);
				               	   $this->upload->initialize($configg);
				                   if($this->upload->do_upload('applicant_pic'))
				                  {  
				                     $file_data = $this->upload->data();  
				                     $img_namee = $file_data['orig_name'];
				                     $file_path ='uploads/applicant_profile_photos/'.$img_namee;
				                  }

				                  else
				                  {
				                    $error=$this->upload->display_errors();   
				                  }

				                /********Ends file upload code******/

							date_default_timezone_set('Asia/Calcutta'); 
						  $created_date =  date("Y-m-d H:i:s");
						  $uri = $this->uri->segment('3'); 
						  $user 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));

							if(empty($img_namee))
							{
									$img_name = $user->image;
							}

							else
							{
									$img_name = $img_namee;
							}

							$name  = xss_clean(strip_tags($this->input->post('full_name')));
						  $email  = xss_clean(strip_tags($this->input->post('email')));
						  $mobile_no  = xss_clean(strip_tags($this->input->post('mobile_no')));
						  $dob  = xss_clean($this->input->post('dob'));
						  $gender  = xss_clean($this->input->post('gender'));
						  $password  = xss_clean($this->input->post('password'));


							 if(empty($password))
							 {
							 		$update_data = array(
													'name' 					=> $name,
													'email' 				=> $email,
													'mobile_no' 		=> $mobile_no,
													'dob' 					=> $dob,
													'gender' 				=> $gender,
													'image'					=> $img_name,
													'updated_date' 	=> $created_date
												);
							 }

							 else
							 {
							 		$update_data = array(
													'name' 					=> $name,
													'email' 				=> $email,
													'mobile_no' 		=> $mobile_no,
													'dob' 					=> $dob,
													'gender' 				=> $gender,
													'image'					=> $img_name,
													'password'			=> $password,
													'updated_date' 	=> $created_date
												);
							 }
							
					$updateid = $this->Base_model->update_record_by_id('tbl_applicant', $update_data, array('id'=> $uri));


						if($updateid)
						{
								$msg = "Profile updated successfully.";
								$this->session->set_flashdata('flashSuccess_profileupdate',$msg);
								$uri = $this->session->userdata('applicant_user_id');
								$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/editprofile',$data);
								$this->load->view('admin/footer');
						}

						else
						{
								$msg = "Fail to update profile.";
								$this->session->set_flashdata('flashError_profileupdate',$msg);
								$uri = $this->session->userdata('applicant_user_id');
								$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/editprofile',$data);
								$this->load->view('admin/footer');
						}//ends else

					  }	

                    } // end if

                     else {

						date_default_timezone_set('Asia/Calcutta'); 
						  $created_date =  date("Y-m-d H:i:s");
						  $uri = $this->uri->segment('3'); 
						  $user 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));

						$img_name = $user->image;
						

						$name  = xss_clean(strip_tags($this->input->post('full_name')));
						  $email  = xss_clean(strip_tags($this->input->post('email')));
						  $mobile_no  = xss_clean(strip_tags($this->input->post('mobile_no')));
						  $dob  = xss_clean($this->input->post('dob'));
						  $gender  = xss_clean($this->input->post('gender'));
						  $password  = xss_clean($this->input->post('password'));


							 if(empty($password))
							 {
							 		$update_data = array(
													'name' 					=> $name,
													'email' 				=> $email,
													'mobile_no' 		=> $mobile_no,
													'dob' 					=> $dob,
													'gender' 				=> $gender,
													'image'					=> $img_name,
													'updated_date' 	=> $created_date
												);
							 }

							 else
							 {
							 		$update_data = array(
													'name' 					=> $name,
													'email' 				=> $email,
													'mobile_no' 		=> $mobile_no,
													'dob' 					=> $dob,
													'gender' 				=> $gender,
													'image'					=> $img_name,
													'password'			=> $password,
													'updated_date' 	=> $created_date
												);
							 }
							
					$updateid = $this->Base_model->update_record_by_id('tbl_applicant', $update_data, array('id'=> $uri));


						if($updateid)
						{
								$msg = "Profile updated successfully.";
								$this->session->set_flashdata('flashSuccess_profileupdate',$msg);
								$uri = $this->session->userdata('applicant_user_id');
								$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/editprofile',$data);
								$this->load->view('admin/footer');
						}

						else
						{
								$msg = "Fail to update profile.";
								$this->session->set_flashdata('flashError_profileupdate',$msg);
								$uri = $this->session->userdata('applicant_user_id');
								$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/editprofile',$data);
								$this->load->view('admin/footer');
						}//ends else

                     }



			          } // end else 
								
					

				}//ends main else

			}//ends if

			else
			{

				$uri = $this->session->userdata('applicant_user_id');
				$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/editprofile',$data);
				$this->load->view('admin/footer');

			}//ends else
			

	    } //end else		

		//ends else session check

			
	}//ends function

	/******function for view applicant profile*****/

	public function profile()
	{
		$segment_id = $this->uri->segment('3');
		$uri = $this->session->userdata('applicant_user_id');

			if($segment_id!=$uri)
			{
				$base_url = base_url();
				redirect($base_url.'Applicant/logout');
			}


			else
			{
					$uri = $this->session->userdata('applicant_user_id');
					$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/viewprofile',$data);
					$this->load->view('admin/footer');
			}//ends else session check

		
	}//ends function

	/*****function for insert basic information*******/

	public function apply_basic_info()
	{
		$region_id 		= $this->input->post('region_id');
		$circle_id 		= $this->input->post('circle_id');
		$job_id 	 		= $this->input->post('job_id');
		$post_id 	 		= $this->input->post('post_id');
		date_default_timezone_set('Asia/Calcutta'); 
		$created_date =  date("Y-m-d H:i:s"); 
		$job_data 		= $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $job_id,'region_id'=>$region_id,'circle_id'=>$circle_id));
		$post_id2 	 		= $job_data->post_id;
		$applicant_id = $this->session->userdata('applicant_user_id');
		$current_date =  date("Y-m-d");

		$job_end_date = $job_data->end_date;
		
		
			/********checked basic information********/

		/*$checked_basic_info = $this->Base_model->check_existent('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'region_id' => $region_id,'circle_id' => $circle_id,'job_id' => $job_id,'post_id' => $post_id2));*/

		$checked_basic_info = $this->Base_model->check_existent('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'pending_status'=>0));

		/********ends checked basic information********/

		/***if checked_bascic_info is 1 then update else insert 1*******/

		if($checked_basic_info ==1)
		{
			/*$previous_post_data 		= $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'region_id' => $region_id,'circle_id' => $circle_id,'job_id' => $job_id,'post_id' => $post_id2,'pending_status'=>0));*/

			$previous_post_data 		= $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'pending_status'=>0));

				$basic_info_id = $previous_post_data->id;

				$update_data = array(
													 'region_id'  	=> $region_id,
													 'applicant_id' => $applicant_id,
													 'circle_id'  	=> $circle_id,
													 'pending_status' => '0',
													 'job_id'  			=> $job_id,
													 'post_id'  		=> $post_id2,
													 'updated_date' => $created_date
												);

				$updateid = $this->Base_model->update_record_by_id('tbl_app_job_bas_info', $update_data, array('id'=> $basic_info_id));
				$res = array('status'=>'success','msg' => 'Updated successfully', 'error' => 0);    
        print json_encode($res);
		}// ends if

		else
		{
				$insert_basic_info_data = array(
													 'region_id'  	=> $region_id,
													 'applicant_id' => $applicant_id,
													 'circle_id'  	=> $circle_id,
													 'job_id'  			=> $job_id,
													 'post_id'  		=> $post_id2,
													 'pending_status' => '0',
													 'created_date' => $created_date,
													 'updated_date' => $created_date
												);

				$insert_basic_info_id = $this->Base_model->insert_one_row('tbl_app_job_bas_info', 
																					$insert_basic_info_data);
				$res = array('status'=>'success','msg' => 'Insert successfully', 'error' => 0);    
        print json_encode($res);
		}// ends else

		//}//ends condotional if
		
		

	}//ends function

	/*****function for insert General basic information*******/

	public function apply_general_basic_info()
	{
	
		$full_name 	 	= $this->input->post('full_name');
		$father_name 	= $this->input->post('father_name');
		$email 	 		  = $this->input->post('email');
		$mobile_no 	 	= $this->input->post('mobile_no');
		$dob 	 				= $this->input->post('dob');
		$gender 	 		= $this->input->post('gender');
		date_default_timezone_set('Asia/Calcutta'); 
		$created_date =  date("Y-m-d H:i:s"); 
		$applicant_id = $this->session->userdata('applicant_user_id');
		
		/********checked basic information********/

		$checked_basic_info = $this->Base_model->check_existent('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'pending_status'=>0));

		/********ends checked basic information********/

		/***if checked_bascic_info is 1 then update else fail to update *******/

		if($checked_basic_info ==1)
		{
		
			$previous_post_data 		= $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'pending_status'=>0));

				$basic_info_id = $previous_post_data->id;

				$update_data = array(
													 'full_name'  	=> $full_name,
													 'father_name'  => $father_name,
													 'email'  			=> $email,
													 'mobile_no'  	=> $mobile_no,
													 'dob'  				=> $dob,
													 'gender'  			=> $gender,
													 'updated_date' => $created_date
												);

				$updateid = $this->Base_model->update_record_by_id('tbl_app_job_bas_info', $update_data, array('id'=> $basic_info_id));
				$res = array('status'=>'success','msg' => 'Updated successfully', 'error' => 0);    
        print json_encode($res);
		}// ends if

		else
		{

				$res = array('status'=>'success','msg' => 'Failed to update', 'error' => 1);    
        print json_encode($res);
		}// ends else

	}//ends function

	/*****function for insert Educational information*******/

	public function apply_educational_info()
	{
		
		$highschool_metriculation 	 			= $this->input->post('highschool_metriculation');
		$highschool_board_name 						= $this->input->post('highschool_board_name');
		$highschool_passing_year 	 				= $this->input->post('highschool_passing_year');
		$highschool_total_marks 	 				= $this->input->post('highschool_total_marks');
		$highschool_marks_obtained 	 			= $this->input->post('highschool_marks_obtained');
		$highschool_percentage 	 					= $this->input->post('highschool_percentage');

		$graduation_qualification 	 			= $this->input->post('graduation_qualification');
		$graduation_passing_year 					= $this->input->post('graduation_passing_year');
		$graduation_total_marks 	 				= $this->input->post('graduation_total_marks');
		$graduation_marks_obtained 	 			= $this->input->post('graduation_marks_obtained');
		$graduation_percentage 	 					= $this->input->post('graduation_percentage');

		$post_graduation_qualification 	 	= $this->input->post('post_graduation_qualification');
		$post_graduation_passing_year 		= $this->input->post('post_graduation_passing_year');
		$post_graduation_total_marks 	 		= $this->input->post('post_graduation_total_marks');
		$post_graduation_marks_obtained 	= $this->input->post('post_graduation_marks_obtained');
		$post_graduation_percentage 	 		= $this->input->post('post_graduation_percentage');

		$others_qualification 	 					= $this->input->post('others_qualification');
		$others_passing_year 							= $this->input->post('others_passing_year');
		$others_total_marks 	 						= $this->input->post('others_total_marks');
		$others_marks_obtained 	 					= $this->input->post('others_marks_obtained');
		$others_percentage 	 							= $this->input->post('others_percentage');
		
		
		date_default_timezone_set('Asia/Calcutta'); 
		$created_date =  date("Y-m-d H:i:s"); 

		$applicant_id = $this->session->userdata('applicant_user_id');
		$previous_post_data 		= $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'pending_status'=>0));

		$basic_info_id = $previous_post_data->id;
		
		/********checked educational information********/

		$checked_educational_info = $this->Base_model->check_existent('tbl_app_job_edu_info', array('basic_info_id' => $basic_info_id));

		
		if($checked_educational_info ==1)
		{
		
			$previous_post_data 		= $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'pending_status'=>0));

				$basic_info_id = $previous_post_data->id;

				$update_data = array(
													 'basic_info_id'								  => $basic_info_id,
													 'highschool_metriculation'			 	=> $highschool_metriculation,
													 'highschool_board_name'  				=> $highschool_board_name,
													 'highschool_passing_year'  			=> $highschool_passing_year,
													 'highschool_total_marks'  				=> $highschool_total_marks,
													 'highschool_marks_obtained'  		=> $highschool_marks_obtained,
													 'highschool_percentage'  				=> $highschool_percentage, 
													 'graduation_board_name'  				=> $graduation_qualification,
													 'graduation_passing_year'  			=> $graduation_passing_year,
													 'graduation_total_marks'  				=> $graduation_total_marks,
													 'graduation_marks_obtained'  		=> $graduation_marks_obtained,
													 'graduation_percentage'  				=> $graduation_percentage,
													 'post_graduation_board_name'  		=> $post_graduation_qualification,
													 'post_graduation_passing_year'  	=> $post_graduation_passing_year,
													 'post_graduation_total_marks'  	=> $post_graduation_total_marks,
													 'post_graduation_marks_obtained' => $post_graduation_marks_obtained,
													 'post_graduation_percentage'  		=> $post_graduation_percentage,
													 'others_board_name'  						=> $others_qualification,
													 'others_passing_year'  					=> $others_passing_year,
													 'others_total_marks'  						=> $others_total_marks,
													 'others_marks_obtained'  				=> $others_marks_obtained,
													 'others_percentage'  						=> $others_percentage,
													 'updated_date' 									=> $created_date,
												);

				$updateid = $this->Base_model->update_record_by_id('tbl_app_job_edu_info', $update_data, array('basic_info_id'=> $basic_info_id));
				$res = array('status'=>'success','msg' => 'Education Updated successfully', 'error' => 0);    
        print json_encode($res);
		}// ends if

		else
		{
			
				$insert_basic_info_data = array(
													 'basic_info_id'								  => $basic_info_id,
													 'highschool_metriculation'			 	=> $highschool_metriculation,
													 'highschool_board_name'  				=> $highschool_board_name,
													 'highschool_passing_year'  			=> $highschool_passing_year,
													 'highschool_total_marks'  				=> $highschool_total_marks,
													 'highschool_marks_obtained'  		=> $highschool_marks_obtained,
													 'highschool_percentage'  				=> $highschool_percentage, 
													 'graduation_board_name'  				=> $graduation_qualification,
													 'graduation_passing_year'  			=> $graduation_passing_year,
													 'graduation_total_marks'  				=> $graduation_total_marks,
													 'graduation_marks_obtained'  		=> $graduation_marks_obtained,
													 'graduation_percentage'  				=> $graduation_percentage,
													 'post_graduation_board_name'  		=> $post_graduation_qualification,
													 'post_graduation_passing_year'  	=> $post_graduation_passing_year,
													 'post_graduation_total_marks'  	=> $post_graduation_total_marks,
													 'post_graduation_marks_obtained' => $post_graduation_marks_obtained,
													 'post_graduation_percentage'  		=> $post_graduation_percentage,
													 'others_board_name'  						=> $others_qualification,
													 'others_passing_year'  					=> $others_passing_year,
													 'others_total_marks'  						=> $others_total_marks,
													 'others_marks_obtained'  				=> $others_marks_obtained,
													 'others_percentage'  						=> $others_percentage,
													 'created_date'										=> $created_date,
													 'updated_date' 									=> $created_date
												);

				$insert_basic_info_id = $this->Base_model->insert_one_row('tbl_app_job_edu_info', 
																					$insert_basic_info_data);
				$res = array('status'=>'success','msg' => 'Education insert successfully', 'error' => 0);    
        print json_encode($res);
		} //ends else

	}//ends function

	/***********function for insert others details**********/

public function apply_other_detail_info()
	{
		
		$caste_category 	 			    = xss_clean(strip_tags($this->input->post('caste_category')));
		$religion 	 						= xss_clean(strip_tags($this->input->post('religion')));
		$marital_status 	 			    = xss_clean(strip_tags($this->input->post('marital_status')));
		$nationality 	 					= xss_clean(strip_tags($this->input->post('nationality')));
		$aadhar_no 	 						= xss_clean(strip_tags($this->input->post('aadhar_no')));
		$ex_serviceman 	 				    = xss_clean(strip_tags($this->input->post('ex_serviceman')));
		$physical_fitness 	 		        = xss_clean(strip_tags($this->input->post('physical_fitness')));
		$employment_exchange 	 	        = xss_clean(strip_tags($this->input->post('employment_exchange')));
		$physically_candicapped             = xss_clean(strip_tags($this->input->post('physically_candicapped')));
		$present_address 	 			    = xss_clean(strip_tags($this->input->post('present_address')));
		$permanent_address 	 		        = xss_clean(strip_tags($this->input->post('permanent_address')));
		$present_address_state 	            = xss_clean(strip_tags($this->input->post('present_address_state')));
		$present_address_city 	            = xss_clean(strip_tags($this->input->post('present_address_city')));
		$present_address_pincode            = xss_clean(strip_tags($this->input->post('present_address_pincode')));
		$permanent_address_state            = xss_clean(strip_tags($this->input->post('permanent_address_state')));
		$permanent_address_city             = xss_clean(strip_tags($this->input->post('permanent_address_city')));
		$permanent_address_pincode          = xss_clean(strip_tags($this->input->post('permanent_address_pincode')));
		$adhar_text_value          					= xss_clean(strip_tags($this->input->post('adhar_text_value')));
		
		date_default_timezone_set('Asia/Calcutta'); 
		$created_date =  date("Y-m-d H:i:s"); 

		$applicant_id = $this->session->userdata('applicant_user_id');
		$previous_post_data 		= $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'pending_status'=>0));

		$basic_info_id = $previous_post_data->id;
		

		$checked_other_detail_info = $this->Base_model->check_existent('tbl_app_job_oth_info', array('basic_info_id' => $basic_info_id));

		
		if($checked_other_detail_info ==1)
		{
		
			$previous_post_data 		= $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'pending_status'=>0));

				$basic_info_id = $previous_post_data->id;

				$update_data = array(
									 'basic_info_id'								  => $basic_info_id,
									 'caste_category'  								=> $caste_category,
									 'religion'  											=> $religion,
									 'marital_status'  								=> $marital_status,
									 'nationality'  									=> $nationality,
									 'aadhar_no'  										=> $aadhar_no,
									 'ex_serviceman'  								=> $ex_serviceman,
									 'physical_fitness'  							=> $physical_fitness,
									 'employment_exchange_reg_no' 		=> $employment_exchange,
									 'physically_handicapp'  					=> $physically_candicapped,
									  'present_address'  							=> $present_address,
									 'present_address_state'  				=> $present_address_state,
									 'present_address_city'  					=> $present_address_city,
									 'present_address_pincode'  			=> $present_address_pincode,
									 'permanent_address'  						=> $permanent_address,
									 'permanent_address_state'  			=> $permanent_address_state,
									 'permanent_address_city'  				=> $permanent_address_city,
									 'permanent_address_pincode'  		=> $permanent_address_pincode,
									 'adhar_enc'  										=> $adhar_text_value,
									 'updated_date' 									=> $created_date
								);

				

				$updateid = $this->Base_model->update_record_by_id('tbl_app_job_oth_info', $update_data, array('basic_info_id'=> $basic_info_id));
				$res = array('status'=>'success','msg' => 'Other detail updated successfully', 'error' => 0);    
               print json_encode($res);

		}

		else
		{
			
				$insert_basic_info_data = array(
													  'basic_info_id'								  => $basic_info_id,
													 'caste_category'  								=> $caste_category,
													 'religion'  											=> $religion,
													 'marital_status'  								=> $marital_status,
													 'nationality'  									=> $nationality,
													 'aadhar_no'  										=> $aadhar_no,
													 'ex_serviceman'  								=> $ex_serviceman,
													 'physical_fitness'  							=> $physical_fitness,
													 'employment_exchange_reg_no' 		=> $employment_exchange,
													 'physically_handicapp'  					=> $physically_candicapped,
													  'present_address'  							=> $present_address,
													 'present_address_state'  				=> $present_address_state,
													 'present_address_city'  					=> $present_address_city,
													 'present_address_pincode'  			=> $present_address_pincode,
													 'permanent_address'  						=> $permanent_address,
													 'permanent_address_state'  			=> $permanent_address_state,
													 'permanent_address_city'  				=> $permanent_address_city,
													 'permanent_address_pincode'  		=> $permanent_address_pincode,
													  'adhar_enc'  										=> $adhar_text_value,
													 'created_date'										=> $created_date,
													 'updated_date' 									=> $created_date
												);

				$insert_basic_info_id = $this->Base_model->insert_one_row('tbl_app_job_oth_info', 
																					$insert_basic_info_data);
				$res = array('status'=>'success','msg' => 'Other detail insert successfully', 'error' => 0);    
        print json_encode($res);
		} //ends else

	}//ends function

	/*************function for saving documents*********/
	public function apply_documents_info()
	{
		  $applicant_id = $this->session->userdata('applicant_user_id');
	      $user_name = $this->session->userdata('applicant_username');
	      $docs_name = $user_name.'_'.$applicant_id.'_'.time().'_photo_';
	      $docs_name_dob = $user_name.'_'.$applicant_id.'_'.time().'_dob_';
	      $docs_name_matricualtion = $user_name.'_'.$applicant_id.'_'.time().'_matricualtion_';
	      $docs_name_scst = $user_name.'_'.$applicant_id.'_'.time().'_scst_';

	      //print_r($_FILES); exit;


           $finfo = new finfo(FILEINFO_MIME_TYPE);

			$uploaded_file_photosign  = $_FILES['uploaded_photo_sign']['name'];
			$uploaded_file_dobcertificate  = $_FILES['dob_certificate']['name'];
			$uploaded_file_matriculation  = $_FILES['matriculation_marksheet']['name'];
			$uploaded_file_scstobc  = $_FILES['scc_St_obc_certificate']['name'];
				
			$count_dotsphotosign = substr_count($uploaded_file_photosign, '.');
			$count_dotsdobcertificate = substr_count($uploaded_file_dobcertificate, '.');
			$count_dotsmatriculation = substr_count($uploaded_file_matriculation, '.');
			$count_dotsscstobc = substr_count($uploaded_file_scstobc, '.');

			if($count_dotsphotosign > 1)
			{	

			$res = array('status'=>'fail','msg' => 'Please upload file in correct format.', 'error' => 1,'type_error'=>1);    
	        print json_encode($res);

			} else if($count_dotsdobcertificate > 1)

			{

			$res = array('status'=>'fail','msg' => 'Please upload file in correct format.', 'error' => 1,'type_error'=>2);    
                print json_encode($res);

			} else if($count_dotsmatriculation > 1)
			{

			$res = array('status'=>'fail','msg' => 'Please upload file in correct format.', 'error' => 1,'type_error'=>3);    
               print json_encode($res);

			} /*else if($count_dotsscstobc > 1)
		   {

			 $res = array('status'=>'fail','msg' => 'Please upload file in correct format.', 'error' => 1,'type_error'=>4);    
              print json_encode($res);

			} */else  if (false === $ext = array_search(
		        
				        $finfo->file($_FILES['uploaded_photo_sign']['tmp_name']),
				        array(
				            'jpg' => 'image/jpeg',
				            'png' => 'image/png',
				        ),
				        true

				    )) {

		      
				$res = array('status'=>'fail','msg' => 'This type of file is not allowed. Please select file in correct formate.', 'error' => 1,'type_error'=>1);    
                print json_encode($res);
			

	      } else  if (false === $ext = array_search(
		        
		        $finfo->file($_FILES['dob_certificate']['tmp_name']),
		        array(
		            'jpg' => 'image/jpeg',
		            'png' => 'image/png',
		        ),
		        true

		    )) {

		      $res = array('status'=>'fail','msg' => 'This type of file is not allowed. Please select file in correct formate.', 'error' => 1,'type_error'=>2);    
               print json_encode($res);


		} else  if (false === $ext = array_search(
		        
		        $finfo->file($_FILES['matriculation_marksheet']['tmp_name']),
		        array(
		            'jpg' => 'image/jpeg',
		            'png' => 'image/png',
		        ),
		        true

		    )) {

		      $res = array('status'=>'fail','msg' => 'This type of file is not allowed. Please select file in correct formate.', 'error' => 1,'type_error'=>3);    
               print json_encode($res);


       } /*else if (false === $ext = array_search(
		        
		        $finfo->file($_FILES['scc_St_obc_certificate']['tmp_name']),
		        array(
		            'jpg' => 'image/jpeg',
		            'png' => 'image/png',
		        ),
		        true

		    )) {

		       $res = array('status'=>'fail','msg' => 'This type of file is not allowed. Please select file in correct formate.', 'error' => 1,'type_error'=>4);    
               print json_encode($res);


        } */else {

        	    $configg = array(
                     'upload_path' => "./uploads/uploaded_photo/",
                     'allowed_types' => "jpg|png|jpeg|",
                     'overwrite' => TRUE,
                     'max_size' => "4096000", 
                     'file_name' => $docs_name.$_FILES["uploaded_photo_sign"]['name'],
                     );              
                   $this->load->library('upload', $configg);
                   $this->upload->initialize($configg);
                   $img_namee= $_FILES['uploaded_photo_sign']['name'];//echo "djdjjd";echo $img_namee;
                   $pic['item_image']= $img_namee;
                   $this->load->library('upload',$configg);
               	   $this->upload->initialize($configg);
                   if($this->upload->do_upload('uploaded_photo_sign'))
                  {  
                     $file_data = $this->upload->data();  
                     $img_namee = $file_data['orig_name'];
                     $file_path ='uploads/uploaded_photo/'.$img_namee;
                  }


                    $configg2 = array(
	                             'upload_path' => "./uploads/dob_certificate/",
	                             'allowed_types' => "jpg|png|jpeg|",
	                             'overwrite' => TRUE,
	                             'max_size' => "4096000", 
	                             'file_name' => $docs_name_dob.$_FILES["dob_certificate"]['name'],
	                             );              
	                   $this->load->library('upload', $configg2);
	                   $this->upload->initialize($configg2);
	                   $img_namee1=	$_FILES['dob_certificate']['name'];
	                   $pic['item_image']= $img_namee1;
	                   $this->load->library('upload',$configg2);
	               	   $this->upload->initialize($configg2);
	                   if($this->upload->do_upload('dob_certificate'))
	                  {  
	                     $file_data = $this->upload->data();  
	                     $img_namee1 = $file_data['orig_name'];
	                     $file_path ='uploads/dob_certificate/'.$img_namee1;
	                  }


                   $configg3 = array(
                             'upload_path' => "./uploads/matriculation_certificate/",
                             'allowed_types' => "jpg|png|jpeg|",
                             'overwrite' => TRUE,
                             'max_size' => "4096000", 
                             'file_name' => $docs_name_matricualtion.$_FILES["matriculation_marksheet"]['name'],
                             );              
                   $this->load->library('upload', $configg3);
                   $this->upload->initialize($configg3);
                   $img_namee2= $_FILES['matriculation_marksheet']['name'];
                   $pic['item_image']= $img_namee2;
                   $this->load->library('upload',$configg3);
               	   $this->upload->initialize($configg3);
                   if($this->upload->do_upload('matriculation_marksheet'))
                  {  
                     $file_data = $this->upload->data();  
                     $img_namee2 = $file_data['orig_name'];
                     $file_path ='uploads/matriculation_certificate/'.$img_namee2;
                  }



                   $configg4 = array(
	                             'upload_path' => "./uploads/scc_St_obc_certificate/",
	                             'allowed_types' => "jpg|png|jpeg|",
	                             'overwrite' => TRUE,
	                             'max_size' => "4096000",
	                             'file_name' => $docs_name_scst.$_FILES["scc_St_obc_certificate"]['name'], 
	                             );              
	                   $this->load->library('upload', $configg4);
	                   $this->upload->initialize($configg4);
	                   $img_namee3= $_FILES['scc_St_obc_certificate']['name'];
	                   $pic['item_image']= $img_namee3;
	                   $this->load->library('upload',$configg4);
	               	   $this->upload->initialize($configg4);
	                   if($this->upload->do_upload('scc_St_obc_certificate'))
	                  {  
	                     $file_data = $this->upload->data();  
	                     $img_namee3 = $file_data['orig_name'];
	                     $file_path ='uploads/scc_St_obc_certificate/'.$img_namee3;
	                  }



				$uploaded_photo_sign 	 			= xss_clean($this->input->post('uploaded_photo_sign'));
				$dob_certificate 	 					= xss_clean($this->input->post('dob_certificate'));
				$matriculation_marksheet 	 	= xss_clean($this->input->post('matriculation_marksheet'));
				$scc_St_obc_certificate 	 	= xss_clean($this->input->post('scc_St_obc_certificate'));
				$working_experience 	 			= xss_clean($this->input->post('working_experience'));

				$applicant_id = $this->session->userdata('applicant_user_id');
				$img_name 	  	= str_replace(' ','_', $img_namee);
				$img_name1 	  	= str_replace(' ','_', $img_namee1);
				$img_name2 	  	= str_replace(' ','_', $img_namee2);
				$img_name3 	  	= str_replace(' ','_', $img_namee3);

				if(empty($img_name))
				{
					$img_name = '';
				}

				else
				{
					$img_name = $img_name;
				}
				//
				if(empty($img_name1))
				{
					$img_name1 = '';
				}

				else
				{
					$img_name1 = $img_name1;
				}

				//

				if(empty($img_name2))
				{
					$img_name2 = '';
				}

				else
				{
					$img_name2 = $img_name2;
				}
				//

				if(empty($img_name3))
				{
					$img_name3 = '';
				}

				else
				{
					$img_name3 = 	$img_name3;
				}
		
		
		date_default_timezone_set('Asia/Calcutta'); 
		$created_date =  date("Y-m-d H:i:s"); 

		$applicant_id = $this->session->userdata('applicant_user_id');
		$previous_post_data 		= $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'pending_status'=>0));

		$basic_info_id = $previous_post_data->id;
		

		$checked_documents_info = $this->Base_model->check_existent('tbl_app_job_doc_info', array('basic_info_id' => $basic_info_id));

		
		if($checked_documents_info ==1)
		{
		
			$previous_post_data 		= $this->Base_model->get_record_by_id('tbl_app_job_bas_info', array('applicant_id' => $applicant_id,'pending_status'=>0));

				$basic_info_id = $previous_post_data->id;

				$update_data = array(
										 'basic_info_id'					=> $basic_info_id,
										 'working_experience'  		=> $working_experience,
										 'file_uploaded_photo'  						=>$img_name,
										 'file_dob_certificate'  						=> $img_name1,
										 'file_matriculation_marksheet'  		=> $img_name2,
										 'file_sc_st_obc_certitificate'  		=> $img_name3,
										 'updated_date' 					=> $created_date
									);

	

				$updateid = $this->Base_model->update_record_by_id('tbl_app_job_doc_info', $update_data, array('basic_info_id'=> $basic_info_id));
				$applicant_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $this->session->userdata('applicant_user_id')));
				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
				$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($basic_info_id);

				$data['region_data'] = $this->Base_model->get_record_by_id('tbl_region', array('id' => $all_job_data[0]->region_id));
				$data['circle_data'] = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $all_job_data[0]->circle_id));
				$data['post_data'] = $this->Base_model->get_record_by_id('tbl_post', array('id' => $all_job_data[0]->post_id));
				$data['job_data'] = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $all_job_data[0]->job_id));
				$data['present_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->present_address_state));
				$data['permanent_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->permanent_address_state));
				if(empty($all_job_data[0]->file_uploaded_photo))
					{
						$file_uploaded_photo = 'no-image.jpg';
					}

					else
					{
						$file_uploaded_photo = $all_job_data[0]->file_uploaded_photo;
					}

					if(empty($all_job_data[0]->file_dob_certificate))
					{
						$file_dob_certificate = 'no-image.jpg';
					}

					else
					{
						$file_dob_certificate = $all_job_data[0]->file_dob_certificate;
					}

					if(empty($all_job_data[0]->file_matriculation_marksheet))
					{
						$file_matriculation_marksheet = 'no-image.jpg';
					}

					else
					{
						$file_matriculation_marksheet = $all_job_data[0]->file_matriculation_marksheet;
					}

					if(empty($all_job_data[0]->file_sc_st_obc_certitificate))
					{
						$file_sc_st_obc_certitificate = 'no-image.jpg';
					}

					else
					{
						$file_sc_st_obc_certitificate = $all_job_data[0]->file_sc_st_obc_certitificate;
					}

					$data['upload_photo'] = $base_url.'uploads/uploaded_photo/'.$file_uploaded_photo;

					/*$data['dob'] = $base_url.'uploads/dob_certificate/'.$file_dob_certificate;*/
					$data['dobbb'] = $file_dob_certificate;
					/*$data['matriculation'] = $base_url.'uploads/matriculation_certificate/'.$file_matriculation_marksheet;*/
					$data['matriculation'] = $file_matriculation_marksheet;
					/*$data['scst'] = $base_url.'uploads/scc_St_obc_certificate/'.$file_sc_st_obc_certitificate;*/
					$data['scst'] = $file_sc_st_obc_certitificate;
				
				/*************PDF Code***************/
				//echo "<pre>"; print_r($all_job_data);exit;
				 $applicant_id = $this->session->userdata('applicant_user_id');
		         $user_name = $this->session->userdata('applicant_username');
		         $pdf_name = $user_name.'_'.$applicant_id.'_'.time();

				/*********Ends PDF Code*************/

				$updateid = $this->Base_model->update_record_by_id('tbl_app_job_bas_info', array('pdf_name'=> $pdf_name), array('id'=> $basic_info_id));

				$data['pdf_name'] = $pdf_name;
				$this->load->view('pdf',$data);
				  $res = array('status'=>'success','msg' => 'Documents updated successfully', 'error' => 0);    
                  print json_encode($res);
		}// ends if

		else
		{
			
				$insert_basic_info_data = array(

									 'basic_info_id'					=> $basic_info_id,
									 'working_experience'  		=> $working_experience,
									  'file_uploaded_photo'  						=>$img_name,
									 'file_dob_certificate'  						=> $img_name1,
									 'file_matriculation_marksheet'  		=> $img_name2,
									 'file_sc_st_obc_certitificate'  		=> $img_name3,
									 'created_date'						=> $created_date,
									 'updated_date' 					=> $created_date
								);

				$insert_basic_info_id = $this->Base_model->insert_one_row('tbl_app_job_doc_info', 
																					$insert_basic_info_data);
				$applicant_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $this->session->userdata('applicant_user_id')));
				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
				$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($basic_info_id);

				$data['region_data'] = $this->Base_model->get_record_by_id('tbl_region', array('id' => $all_job_data[0]->region_id));
				$data['circle_data'] = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $all_job_data[0]->circle_id));
				$data['post_data'] = $this->Base_model->get_record_by_id('tbl_post', array('id' => $all_job_data[0]->post_id));
				$data['job_data'] = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $all_job_data[0]->job_id));
				$data['present_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->present_address_state));
				$data['permanent_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->permanent_address_state));
				if(empty($all_job_data[0]->file_uploaded_photo))
					{
						$file_uploaded_photo = 'no-image.jpg';
					}

					else
					{
						$file_uploaded_photo = $all_job_data[0]->file_uploaded_photo;
					}

					if(empty($all_job_data[0]->file_dob_certificate))
					{
						$file_dob_certificate = 'no-image.jpg';
					}

					else
					{
						$file_dob_certificate = $all_job_data[0]->file_dob_certificate;
					}

					if(empty($all_job_data[0]->file_matriculation_marksheet))
					{
						$file_matriculation_marksheet = 'no-image.jpg';
					}

					else
					{
						$file_matriculation_marksheet = $all_job_data[0]->file_matriculation_marksheet;
					}

					if(empty($all_job_data[0]->file_sc_st_obc_certitificate))
					{
						$file_sc_st_obc_certitificate = 'no-image.jpg';
					}

					else
					{
						$file_sc_st_obc_certitificate = $all_job_data[0]->file_sc_st_obc_certitificate;
					}

					$data['upload_photo'] = $base_url.'uploads/uploaded_photo/'.$file_uploaded_photo;

					
					$data['dobbb'] = $file_dob_certificate;
					
					$data['matriculation'] = $file_matriculation_marksheet;
					
					$data['scst'] = $file_sc_st_obc_certitificate;
				
				/*************PDF Code***************/
				//echo "<pre>"; print_r($all_job_data);exit;
				 $applicant_id = $this->session->userdata('applicant_user_id');
         		$user_name = $this->session->userdata('applicant_username');
         		$pdf_name = $user_name.'_'.$applicant_id.'_'.time();

				/*********Ends PDF Code*************/

				$updateid = $this->Base_model->update_record_by_id('tbl_app_job_bas_info', array('pdf_name'=> $pdf_name), array('id'=> $basic_info_id));

				$data['pdf_name'] = $pdf_name;
				$this->load->view('pdf',$data);
				 $res = array('status'=>'success','msg' => 'Documents insert successfully', 'error' => 0);    
                 print json_encode($res);

		    } //ends else

        } // ends else

	     

  }//ends function




	
}//class ends


