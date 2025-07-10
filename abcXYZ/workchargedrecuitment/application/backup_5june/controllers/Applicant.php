<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicant extends CI_Controller {

	// Initialize Constructor Here
	function __construct()
	{
		parent::__construct();
		$this->load->model('Base_model');
		$this->load->library('Pdf');
		if(empty($this->session->userdata('applicant_user_id')))
	     {
	     	$base_url = base_url().'Frontend/login';
	         redirect($base_url);
	     } 
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$applicant_id = $this->session->userdata('applicant_user_id');
		$applicant_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $applicant_id));
		$data['insertData'] = array(
						'full_name' 	=> $applicant_data->name,
						'email' 		=> $applicant_data->email,
						'mobile_no' 	=> $applicant_data->mobile_no,
						'dob' 			=> $applicant_data->dob,
						'gender' 		=> $applicant_data->gender
					);
		
		$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
		$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/dashboard',$data);
		$this->load->view('admin/footer');	

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
				
				 $region_id  		= xss_clean($this->input->post('region_name'));
				 $circle_id  		= xss_clean($this->input->post('circle_name'));
				 $job_id  			= xss_clean($this->input->post('skilled_name'));
				 $post_id  			= xss_clean($this->input->post('post_code'));
				 $full_name  		= xss_clean($this->input->post('full_name'));
				 $father_name  	= xss_clean($this->input->post('father_name'));
				 $email  				= xss_clean($this->input->post('email'));
				 $mobile_no  		= xss_clean($this->input->post('mobile_no'));
				 $dob  					= xss_clean($this->input->post('dob'));
				 $gender  			= xss_clean($this->input->post('gender'));


				 $highschool_metriculation  			= xss_clean($this->input->post('highschool_metriculation'));
				 $highschool_board_name  					= xss_clean($this->input->post('highschool_board_name'));
				 $highschool_passing_year  				= xss_clean($this->input->post('highschool_passing_year'));
				 $highschool_total_marks  				= xss_clean($this->input->post('highschool_total_marks'));
				 $highschool_marks_obtained  			= xss_clean($this->input->post('highschool_marks_obtained'));
				 $highschool_percentage  					= xss_clean($this->input->post('highschool_percentage'));
				 $intermediate_metriculation  		= xss_clean($this->input->post('intermediate_metriculation'));
				 $intermediate_board_name  				= xss_clean($this->input->post('intermediate_board_name'));
				 $intermediate_passing_year  			= xss_clean($this->input->post('intermediate_passing_year'));
				 $intermediate_total_marks  			= xss_clean($this->input->post('intermediate_total_marks'));
				 $intermediate_marks_obtained  		= xss_clean($this->input->post('intermediate_marks_obtained'));
				 $intermediate_percentage  				= xss_clean($this->input->post('intermediate_percentage'));
				 $graduation_qualification  			= xss_clean($this->input->post('graduation_qualification'));
				 $graduation_passing_year  				= xss_clean($this->input->post('graduation_passing_year'));
				 $graduation_total_marks  				= xss_clean($this->input->post('graduation_total_marks'));
				 $graduation_marks_obtained  			= xss_clean($this->input->post('graduation_marks_obtained'));
				 $graduation_percentage  					= xss_clean($this->input->post('graduation_percentage'));
				 $post_graduation_qualification  	= xss_clean($this->input->post('post_graduation_qualification'));
				 $post_graduation_passing_year  	= xss_clean($this->input->post('post_graduation_passing_year'));
				 $post_graduation_total_marks  		= xss_clean($this->input->post('post_graduation_total_marks'));
				 $post_graduation_marks_obtained  = xss_clean($this->input->post('post_graduation_marks_obtained'));
				 $post_graduation_percentage  		= xss_clean($this->input->post('post_graduation_percentage'));
				 $others_qualification  					= xss_clean($this->input->post('others_qualification'));
				 $others_passing_year  						= xss_clean($this->input->post('others_passing_year'));
				 $others_total_marks  						= xss_clean($this->input->post('others_total_marks'));
				 $others_marks_obtained  					= xss_clean($this->input->post('others_marks_obtained'));
				 $others_percentage  							= xss_clean($this->input->post('others_percentage'));


				 $caste_category  						= xss_clean($this->input->post('caste_category'));
				 $religion  									= xss_clean($this->input->post('religion'));
				 $marital_status  						= xss_clean($this->input->post('marital_status'));
				 $aadhar_no  									= xss_clean($this->input->post('aadhar_no'));
				 $nationality  								= xss_clean($this->input->post('nationality'));
				 $ex_serviceman  							= xss_clean($this->input->post('ex_serviceman'));
				 $physical_fitness  					= xss_clean($this->input->post('physical_fitness'));
				 $employment_exchange 				= xss_clean($this->input->post('employment_exchange'));
				 $physically_candicapped  		= xss_clean($this->input->post('physically_candicapped'));
				 $present_address  						= xss_clean($this->input->post('present_address'));
				 $present_address_state  			= xss_clean($this->input->post('present_address_state'));
				 $present_address_city  			= xss_clean($this->input->post('present_address_city'));
				 $present_address_pincode 		= xss_clean($this->input->post('present_address_pincode'));
				 $permanent_address  					= xss_clean($this->input->post('permanent_address'));
				 $permanent_address_state 		= xss_clean($this->input->post('permanent_address_state'));
				 $permanent_address_city  		= xss_clean($this->input->post('permanent_address_city'));
				 $permanent_address_pincode  	= xss_clean($this->input->post('permanent_address_pincode'));

				 $working_experience  				= xss_clean($this->input->post('working_experience'));
			

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
				 $this->form_validation->set_rules('highschool_total_marks','highschool total marks','trim|required');
				 $this->form_validation->set_rules('highschool_marks_obtained','highschool marks','trim|required');
				 $this->form_validation->set_rules('highschool_percentage','highschool percentage','trim|required');

				 /*$this->form_validation->set_rules('intermediate_board_name','intermediate board name','trim|required');
				 $this->form_validation->set_rules('intermediate_passing_year','intermediate passing year','trim|required');
				 $this->form_validation->set_rules('intermediate_total_marks','intermediate total marks','trim|required');
				 $this->form_validation->set_rules('intermediate_marks_obtained','intermediate marks','trim|required');
				 $this->form_validation->set_rules('intermediate_percentage','intermediate percentage','trim|required');
				 $this->form_validation->set_rules('graduation_qualification','graduation university','trim|required');
				 $this->form_validation->set_rules('graduation_passing_year','graduation passing year','trim|required');
				 $this->form_validation->set_rules('graduation_total_marks','graduation total marks','trim|required');
				 $this->form_validation->set_rules('graduation_marks_obtained','graduation marks','trim|required');
				 $this->form_validation->set_rules('graduation_percentage','graduation percentage','trim|required');*/
				/* $this->form_validation->set_rules('post_graduation_qualification','post graduation university','trim|required');
				 $this->form_validation->set_rules('post_graduation_passing_year','post graduation passing year','trim|required');
				 $this->form_validation->set_rules('post_graduation_total_marks','post graduation total marks','trim|required');
				 $this->form_validation->set_rules('post_graduation_marks_obtained','post graduation marks','trim|required');
				 $this->form_validation->set_rules('post_graduation_percentage','post graduation percentage','trim|required');*/


				 $this->form_validation->set_rules('caste_category','category','trim|required');
				 $this->form_validation->set_rules('religion','religion','trim|required');
				 $this->form_validation->set_rules('marital_status','marital status','trim|required');
				 //$this->form_validation->set_rules('aadhar_no','aadhar number','trim|required');
				 $this->form_validation->set_rules('nationality','nationality','trim|required');
				 $this->form_validation->set_rules('ex_serviceman','ex-serviceman','trim|required');
				 $this->form_validation->set_rules('physical_fitness','physical fitness','trim|required');
				 //$this->form_validation->set_rules('employment_exchange','employment exchange','trim|required');
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
					$applicant_id = $this->session->userdata('applicant_user_id');
          $user_name = $this->session->userdata('applicant_username');
          $docs_name = $user_name.'_'.$applicant_id.'_'.time().'_photo_';
          $docs_name_dob = $user_name.'_'.$applicant_id.'_'.time().'_dob_';
          $docs_name_matricualtion = $user_name.'_'.$applicant_id.'_'.time().'_matricualtion_';
          $docs_name_scst = $user_name.'_'.$applicant_id.'_'.time().'_scst_';
						/***********uploaded_photo_sign**********/

							if($_FILES['uploaded_photo_sign']['name'])
                {
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

                  else
                  {
                    $error=$this->upload->display_errors();   
                  }
                }
               
                /*******Ends uploaded_photo_sign code*******/ 

                /***********dob_certificate**********/

                	if($_FILES['dob_certificate']['name'])
                {
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

                  else
                  {
                    $error=$this->upload->display_errors();   
                  }
                }

                /*******Ends dob_certificate code*******/ 

                 /***********matriculation_marksheet**********/

                 	if($_FILES['matriculation_marksheet']['name'])
                {
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

                  else
                  {
                    $error=$this->upload->display_errors();   
                  }
                }

                 /*******Ends matriculation_marksheet code*******/

                 /***********scc_St_obc_certificate**********/ 

                 	 	if($_FILES['scc_St_obc_certificate']['name'])
                {
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

                  else
                  {
                    $error=$this->upload->display_errors();   
                  }
                }

                 /*******Ends scc_St_obc_certificate code*******/

                 //echo "<pre>";print_r($_FILES); exit;
						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s"); 

							/*****check applicant_apply_job********/
						$post_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' =>$job_id,'region_id'=>$region_id,'circle_id'=>$circle_id));

						$applicant_id = $this->session->userdata('applicant_user_id');
						$checked_apply_job = $this->Base_model->check_existent('tbl_app_job_bas_info', array('region_id' => $region_id,'circle_id' => $circle_id,'job_id' => $job_id,'post_id' => $post_data->post_id,'applicant_id'=> $applicant_id));

						/*****ends check applicant_apply_job*****/

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

						else
							{
								$img_name 	  	= str_replace(' ','_', $img_namee);
								$img_name1 	  	= str_replace(' ','_', $img_namee1);
								$img_name2 	  	= str_replace(' ','_', $img_namee2);
								$img_name3 	  	= str_replace(' ','_', $img_namee3);
								$region_id  		= xss_clean($this->input->post('region_name'));
				 				$circle_id  		= xss_clean($this->input->post('circle_name'));
								$job_id  				= xss_clean($this->input->post('skilled_name'));
								$post_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' =>$job_id,'region_id'=>$region_id,'circle_id'=>$circle_id));
								
								//insert basic information

									$applicant_id = $this->session->userdata('applicant_user_id');
									$insert_basic_info_data = array(
													 'region_id'  	=> xss_clean($this->input->post('region_name')),
													 'applicant_id' => $applicant_id,
													 'circle_id'  	=> xss_clean($this->input->post('circle_name')),
													 'job_id'  			=> xss_clean($this->input->post('skilled_name')),
													 'post_id'  		=> $post_data->post_id,
													 'full_name	'  	=> xss_clean($this->input->post('full_name')),
													 'father_name'  => xss_clean($this->input->post('father_name')),
													 'email'  			=> xss_clean($this->input->post('email')),
													 'gender'  			=> xss_clean($this->input->post('gender')),
													 'mobile_no'  	=> xss_clean($this->input->post('mobile_no')),
													 'dob'  				=> xss_clean($this->input->post('dob')),
													 'created_date' => $created_date,
													'updated_date' 	=> $created_date
												);

									$insert_basic_info_id = $this->Base_model->insert_one_row('tbl_app_job_bas_info', 
																					$insert_basic_info_data);

									//insert educational information

									$insert_education_info_data = array(

													 'basic_info_id'								  => $insert_basic_info_id,
													 'highschool_metriculation'			 => xss_clean($this->input->post('highschool_metriculation')),
													 'highschool_board_name'  				=> xss_clean($this->input->post('highschool_board_name')),
													 'highschool_passing_year'  			=> xss_clean($this->input->post('highschool_passing_year')),
													 'highschool_total_marks'  				=> xss_clean($this->input->post('highschool_total_marks')),
													 'highschool_marks_obtained'  		=> xss_clean($this->input->post('highschool_marks_obtained')),
													 'highschool_percentage'  				=> xss_clean($this->input->post('highschool_percentage')),
													 'intermediate_metriculation'			 => xss_clean($this->input->post('intermediate_metriculation')),
													 'intermediate_board_name'  			=> xss_clean($this->input->post('intermediate_board_name')),
													 'intermediate_passing_year'  		=> xss_clean($this->input->post('intermediate_passing_year')),
													 'intermediate_total_marks'  			=> xss_clean($this->input->post('intermediate_total_marks')),
													 'intermediate_marks_obtained'  	=> xss_clean($this->input->post('intermediate_marks_obtained')),
													 'intermediate_percentage'  			=> xss_clean($this->input->post('intermediate_percentage')),
													 'graduation_board_name'  				=> xss_clean($this->input->post('graduation_qualification')),
													 'graduation_passing_year'  			=> xss_clean($this->input->post('graduation_passing_year')),
													 'graduation_total_marks'  				=> xss_clean($this->input->post('graduation_total_marks')),
													 'graduation_marks_obtained'  		=> xss_clean($this->input->post('graduation_marks_obtained')),
													 'graduation_percentage'  				=> xss_clean($this->input->post('graduation_percentage')),
													 'post_graduation_board_name'  		=> xss_clean($this->input->post('post_graduation_qualification')),
													 'post_graduation_passing_year'  	=> xss_clean($this->input->post('post_graduation_passing_year')),
													 'post_graduation_total_marks'  	=> xss_clean($this->input->post('post_graduation_total_marks')),
													 'post_graduation_marks_obtained' => xss_clean($this->input->post('post_graduation_marks_obtained')),
													 'post_graduation_percentage'  		=> xss_clean($this->input->post('post_graduation_percentage')),
													 'others_board_name'  						=> xss_clean($this->input->post('others_qualification')),
													 'others_passing_year'  					=> xss_clean($this->input->post('others_passing_year')),
													 'others_total_marks'  						=> xss_clean($this->input->post('others_total_marks')),
													 'others_marks_obtained'  				=> xss_clean($this->input->post('others_marks_obtained')),
													 'others_percentage'  						=> xss_clean($this->input->post('others_percentage')),
													 'created_date' 									=> $created_date,
													 'updated_date' 									=> $created_date
												);

								$insert_education_info_id = $this->Base_model->insert_one_row('tbl_app_job_edu_info', 
																					$insert_education_info_data);

								//insert others information

								$insert_others_info_data = array(
													 'basic_info_id'								  => $insert_basic_info_id,
													 'caste_category'  								=> xss_clean($this->input->post('caste_category')),
													 'religion'  											=> xss_clean($this->input->post('religion')),
													 'marital_status'  								=> xss_clean($this->input->post('marital_status')),
													 'nationality'  									=> xss_clean($this->input->post('nationality')),
													 'aadhar_no'  										=> xss_clean($this->input->post('aadhar_no')),
													 'ex_serviceman'  								=> xss_clean($this->input->post('ex_serviceman')),
													 'physical_fitness'  							=> xss_clean($this->input->post('physical_fitness')),
													 'employment_exchange_reg_no' 		=> xss_clean($this->input->post('employment_exchange')),
													 'physically_handicapp'  					=> xss_clean($this->input->post('physically_candicapped')),
													  'present_address'  							=> xss_clean($this->input->post('present_address')),
													 'present_address_state'  				=> xss_clean($this->input->post('present_address_state')),
													 'present_address_city'  					=> xss_clean($this->input->post('present_address_city')),
													 'present_address_pincode'  			=> xss_clean($this->input->post('present_address_pincode')),
													 'permanent_address'  						=> xss_clean($this->input->post('permanent_address')),
													 'permanent_address_state'  			=> xss_clean($this->input->post('permanent_address_state')),
													 'permanent_address_city'  				=> xss_clean($this->input->post('permanent_address_city')),
													 'permanent_address_pincode'  		=> xss_clean($this->input->post('permanent_address_pincode')),
													 'created_date'										=> $created_date,
														'updated_date' 										=> $created_date
												);

									$insert_others_info_id = $this->Base_model->insert_one_row('tbl_app_job_oth_info', 
																					$insert_others_info_data);

									//insert documents information
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

									$insert_doc_info_data = array(

													 'basic_info_id' 										=> $insert_basic_info_id,
													 'file_uploaded_photo'  						=>$img_name,
													 'file_dob_certificate'  						=> $img_name1,
													 'file_matriculation_marksheet'  		=> $img_name2,
													 'file_sc_st_obc_certitificate'  		=> $img_name3,
													 'working_experience'								=> xss_clean($this->input->post('working_experience')),
													 'created_date'										  => $created_date,
													 'updated_date' 										=> $created_date
												);

									$insert_doc_info_id = $this->Base_model->insert_one_row('tbl_app_job_doc_info', 
																					$insert_doc_info_data);

									
									 //$this->generate_pdf($insert_basic_info_id);

								if($insert_basic_info_id)
											{
												$msg = "Job applied successfully.";
												$this->session->set_flashdata('flashSuccess_applied_job',$msg);
												$applicant_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $applicant_id));
												$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
												$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($insert_basic_info_id);

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

												$updateid = $this->Base_model->update_record_by_id('tbl_app_job_bas_info', array('pdf_name'=> $pdf_name), array('id'=> $insert_basic_info_id));

												$data['pdf_name'] = $pdf_name;
												$data['insertData'] = array(
																'full_name' 	=> $applicant_data->name,
																'email' 		=> $applicant_data->email,
																'mobile_no' 	=> $applicant_data->mobile_no,
																'dob' 			=> $applicant_data->dob,
																'gender' 		=> $applicant_data->gender
															);
											
													$this->load->view('admin/header');
													$this->load->view('admin/sidebar');
													$this->load->view('pdf',$data);
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
		//print_r($all_job_data);exit;
		$this->load->view('pdf',$data);
	}

/*********function for job list*******/

	public function job_list()
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
			$uri = $this->session->userdata('applicant_user_id'); 
			if(isset($_REQUEST['submit'])) 
			{
				//echo "<pre>"; print_r($_REQUEST);exit;
			  $name  = xss_clean($this->input->post('full_name'));
			  $email  = xss_clean($this->input->post('email'));
			  $mobile_no  = xss_clean($this->input->post('mobile_no'));
			  $dob  = xss_clean($this->input->post('dob'));
			  $gender  = xss_clean($this->input->post('gender'));
			  $password  = xss_clean($this->input->post('password'));
			 

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
					}// ends if

				else
					{
						$user_id =  $this->session->userdata('applicant_user_id'); 
						$checked_email = $this->Base_model->check_applicant_query($email, $user_id);

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

							else
							{
									/***********File upload code*******/
								$user_id =  $this->session->userdata('applicant_user_id'); 
								$user_name = $this->session->userdata('applicant_username');
								$pic_name = $user_name.'_'.$user_id.'_'.time().'_photo_';
								
								if($_FILES['applicant_pic']['name'])
                {
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

							$name  = xss_clean($this->input->post('full_name'));
						  $email  = xss_clean($this->input->post('email'));
						  $mobile_no  = xss_clean($this->input->post('mobile_no'));
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
													'password'			=> md5($password),
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

							}//ends else
							
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
			
	}

	/******function for view applicant profile*****/

	public function profile()
	{
		$uri = $this->session->userdata('applicant_user_id');
		$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $uri));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/viewprofile',$data);
		$this->load->view('admin/footer');
	}

	
	
	
	
}//class ends


