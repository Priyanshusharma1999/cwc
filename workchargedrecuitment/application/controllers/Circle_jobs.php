<?php

error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');

class Circle_jobs extends CI_Controller {

	// Initialize Constructor Here
	function __construct()
	{
			parent::__construct();
			$this->load->model('Base_model');

			$admindata = $this->Base_model->get_record_by_id('tbl_admin', array('id' =>$this->session->userdata('auser_id')));

			if(empty($this->session->userdata('auser_id')))
         {
         	$base_url = base_url().'Frontend/adminnew';
             redirect($base_url);
         } 

         if($this->session->userdata('auser_type')!= 3)
         {    
         	 $base_url = base_url().'Frontend/adminnew';
             redirect($base_url);
         }

         if($admindata->password != $this->session->userdata('apwd'))

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
		$user_id = $this->session->userdata('auser_id');
		$circle_user_data = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $user_id));
		$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1',));
		$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
		$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
		$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1','circle_id'=>$circle_user_data->Circle));
		$this->load->view('circle/header');
		$this->load->view('circle/sidebar');
		$this->load->view('circle/jobs/joblist',$data);
		$this->load->view('circle/footer');

	}//ends function

	/*******function to gettting all post********/

	public function all_post()
	{

		$region_id 		= $this->input->post('region_id');
		$circle_id 		= $this->input->post('circle_id');
		$all_post 		=  $this->Base_model->get_all_record_by_condition('tbl_post', array('region_id'=>$region_id,'circle_id'=> $circle_id));
		$all_posts  	=  json_encode($all_post);
		echo  $all_posts;

	}// ends function

	/***********function for add jobs*******/

	public function add_jobs()
	{

		if(isset($_REQUEST['submit'])) 
		{ 
		
			$refrence_no  		= xss_clean(strip_tags($this->input->post('refrence_no')));
			$job_title  			= xss_clean(strip_tags($this->input->post('job_title')));
			$total_vacancy  	= xss_clean(strip_tags($this->input->post('total_vacancy')));
			$region_name  		= xss_clean(strip_tags($this->input->post('region_name')));
			$circle_name  		= xss_clean(strip_tags($this->input->post('circle_name')));
			$post_name_code  	= xss_clean(strip_tags($this->input->post('post_name_code')));
			$job_status  			= xss_clean($this->input->post('job_status'));
			$start_date  			= xss_clean($this->input->post('start_date'));
			$end_date  				= xss_clean($this->input->post('end_date'));
			

			$this->form_validation->set_rules('refrence_no','refrence no','trim|required');
			$this->form_validation->set_rules('job_title','job title','trim|required');
			$this->form_validation->set_rules('total_vacancy','total vacancy','trim|required');
			$this->form_validation->set_rules('region_name','region name','trim|required');
			$this->form_validation->set_rules('post_name_code','post name and code','trim|required');
			$this->form_validation->set_rules('circle_name','circle name','trim|required');
			$this->form_validation->set_rules('job_status','job status','trim|required');
			$this->form_validation->set_rules('start_date','start date','trim|required');
			$this->form_validation->set_rules('end_date','end date','trim|required');


			if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
						'refrence_no' 		=> xss_clean($this->input->post('refrence_no')),
						'job_title'		  	=> xss_clean($this->input->post('job_title')),
						'total_vacancy' 	=> xss_clean($this->input->post('total_vacancy')),
						'region_name' 		=> xss_clean($this->input->post('region_name')),
						'post_name_code' 	=> xss_clean($this->input->post('post_name_code')),
						'circle_name' 		=> xss_clean($this->input->post('circle_name')),
						'job_status' 			=> xss_clean($this->input->post('job_status')),
						'start_date' 			=> xss_clean($this->input->post('start_date')),
						'end_date' 				=> xss_clean($this->input->post('end_date'))
					);

					$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));
					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
					$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
					$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
					$this->load->view('circle/header');
					//$this->load->view('circle/topmenu');
					$this->load->view('circle/sidebar');
					$this->load->view('circle/jobs/addjobs',$data);
					$this->load->view('circle/footer');

				}//ends if

				else
				{
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s"); 

					/*****check job********/

						$checked_job = $this->Base_model->check_existent('tbl_jobs', array('refrence_no' => $refrence_no,'job_title' => $job_title,'region_id' => $region_name,'circle_id' => $circle_name,'post_id' => $post_name_code));

						$checked_job2 = $this->Base_model->check_existent('tbl_jobs', array('region_id' => $region_name,'circle_id' => $circle_name,'post_id' => $post_name_code,'job_status'=>1));

						$checked_job3 = $this->Base_model->check_expiry_job($region_name,$circle_name,$post_name_code);

					/*****ends check job*****/

					if($checked_job=='1')
					{
						$msg = "Job already exits, Please enter new one";
						$this->session->set_flashdata('flashError_job', $msg);
						$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));
						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
						$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
						$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
						$this->load->view('circle/header');
						//$this->load->view('circle/topmenu');
						$this->load->view('circle/sidebar');
						$this->load->view('circle/jobs/addjobs',$data);
						$this->load->view('circle/footer');
					}

					else if($checked_job2=='1')
					{
						$msg = "Job already exits, Please enter new job";
						$this->session->set_flashdata('flashError_job', $msg);
						$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));
						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
						$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
						$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
						$this->load->view('mainadmin/header');
						//$this->load->view('mainadmin/topmenu');
						$this->load->view('mainadmin/sidebar');
						$this->load->view('mainadmin/jobs/addjobs',$data);
						$this->load->view('mainadmin/footer');
					}

					else if($checked_job3=='1')
					{
						$msg = "Job alredy exits, not expired";
						$this->session->set_flashdata('flashError_job', $msg);
						$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));
						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
						$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
						$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
						$this->load->view('mainadmin/header');
						//$this->load->view('mainadmin/topmenu');
						$this->load->view('mainadmin/sidebar');
						$this->load->view('mainadmin/jobs/addjobs',$data);
						$this->load->view('mainadmin/footer');
					}

					else
					{
							
							$insert_data = array(
													'refrence_no' 		=> $refrence_no,
													'job_title' 			=> $job_title,
													'total_vacancy' 	=> $total_vacancy,
													'region_id' 			=> $region_name,
													'circle_id' 			=> $circle_name,
													'post_id' 				=> $post_name_code,
													'job_status' 			=> $job_status,
													'start_date' 			=> $start_date,
													'end_date' 				=> $end_date,
													'created_date' 		=> $created_date,
													'updated_date' 		=> $created_date
												);
						$insertid = $this->Base_model->insert_one_row('tbl_jobs', $insert_data);

						if($insertid)
						{
							$msg = "Job added successfully.";
							$this->session->set_flashdata('flashSuccess_job',$msg);
							$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));
							$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
							$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
							$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
							$this->load->view('circle/header');
							//$this->load->view('circle/topmenu');
							$this->load->view('circle/sidebar');
							$this->load->view('circle/jobs/addjobs',$data);
							$this->load->view('circle/footer');
						}

						else
						{
							$msg = "Fail to add job.";
							$this->session->set_flashdata('flashError_job', $msg);
							$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));
							$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
							$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
							$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
							$this->load->view('circle/header');
							//$this->load->view('circle/topmenu');
							$this->load->view('circle/sidebar');
							$this->load->view('circle/jobs/addjobs',$data);
							$this->load->view('circle/footer');
						}
					}//ends else		
				}//ends main else

		}//ends if

		else
		{
			$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
			$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));
			$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
			$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
			$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
			$this->load->view('circle/header');
			//$this->load->view('circle/topmenu');
			$this->load->view('circle/sidebar');
			$this->load->view('circle/jobs/addjobs',$data);
			$this->load->view('circle/footer');

		}//ends else	

	}// ends function

	/********function for Edit Jobs******/

	public function edit_jobs()
	{
		$uri = $this->uri->segment('3');
		if(isset($_REQUEST['submit'])) 
		{

			$uri = $this->uri->segment('3');
			$refrence_no  		= xss_clean(strip_tags($this->input->post('refrence_no')));
			$job_title  			= xss_clean(strip_tags($this->input->post('job_title')));
			$total_vacancy  	= xss_clean(strip_tags($this->input->post('total_vacancy')));
			$region_name  		= xss_clean(strip_tags($this->input->post('region_name')));
			$circle_name  		= xss_clean(strip_tags($this->input->post('circle_name')));
			$post_name_code  	= xss_clean(strip_tags($this->input->post('post_name_code')));
			$job_status  			= xss_clean($this->input->post('job_status'));
			$start_date  			= xss_clean($this->input->post('start_date'));
			$end_date  				= xss_clean($this->input->post('end_date'));
			

			$this->form_validation->set_rules('refrence_no','refrence no','trim|required');
			$this->form_validation->set_rules('job_title','job title','trim|required');
			$this->form_validation->set_rules('total_vacancy','total vacancy','trim|required');
			$this->form_validation->set_rules('region_name','region name','trim|required');
			$this->form_validation->set_rules('post_name_code','post name and code','trim|required');
			$this->form_validation->set_rules('circle_name','circle name','trim|required');
			$this->form_validation->set_rules('job_status','job status','trim|required');
			$this->form_validation->set_rules('start_date','start date','trim|required');
			$this->form_validation->set_rules('end_date','end date','trim|required');

			if($this->form_validation->run() === false) 
				{

					$uri = $this->uri->segment('3');
					$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
					$data['all_posts'] = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
					$data['job_data'] = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $uri));
					$this->load->view('circle/header');
					//$this->load->view('circle/topmenu');
					$this->load->view('circle/sidebar');
					$this->load->view('circle/jobs/edit_jobs',$data);
					$this->load->view('circle/footer');

				}//ends if

				else
				{
					
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s"); 

					/*****check job********/

						$checked = $this->Base_model->check_existent('tbl_jobs', array('refrence_no' => $refrence_no,
													'job_title' 			=> $job_title,
													'total_vacancy' 	=> $total_vacancy,
													'region_id' 			=> $region_name,
													'circle_id' 			=> $circle_name,
													'post_id' 				=> $post_name_code,
													'job_status' 			=> $job_status,
													'start_date' 			=> $start_date,
													'end_date' 				=> $end_date
												  ));

					/*****ends check job*****/

					if($checked=='1')
					{
						
						$msg = "Job updated successfully.";
						$this->session->set_flashdata('flashSuccess_job', $msg);
						$uri = $this->uri->segment('3');
						$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
						$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
						$this->load->view('circle/header');
						//$this->load->view('circle/topmenu');
						$this->load->view('circle/sidebar');
						$this->load->view('circle/jobs/joblist',$data);
						$this->load->view('circle/footer');
					}

					else
					{
								
								$get_job_data = $this->Base_model->get_record_by_id('tbl_jobs', array('Id' => $uri));
								$get_job_title_name = $this->Base_model->check_existent('tbl_jobs', array('job_title' => $job_title,'region_id' => $region_name,'circle_id' => $circle_name,'post_id' => $post_name_code));
								$get_refrence_no = $this->Base_model->check_existent('tbl_jobs', array('refrence_no' => $refrence_no,'region_id' => $region_name,'circle_id' => $circle_name,'post_id' => $post_name_code));

								if($get_job_title_name=='1')
								{
											if($get_refrence_no=='1')
											{
													if($refrence_no == $get_job_data->refrence_no)
													{
															if($job_title == $get_job_data->job_title)
															{	
																
																	$update_data = array('refrence_no' => $refrence_no,
																			'job_title' 			=> $job_title,
																			'total_vacancy' 	=> $total_vacancy,
																			'region_id' 			=> $region_name,
																			'circle_id' 			=> $circle_name,
																			'post_id' 				=> $post_name_code,
																			'job_status' 			=> $job_status,
																			'start_date' 			=> $start_date,
																			'end_date' 				=> $end_date,
																		  'updated_date'		=> $created_date);
																		
																	$updateid = $this->Base_model->update_record_by_id('tbl_jobs', $update_data, array('id'=> $uri));
																	$msg = "Job updated successfully.";
																	$this->session->set_flashdata('flashSuccess_job',$msg);
																	$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
																	$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
																	$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
																	$this->load->view('circle/header');
																	//$this->load->view('circle/topmenu');
																	$this->load->view('circle/sidebar');
																	$this->load->view('circle/jobs/joblist',$data);
																	$this->load->view('circle/footer');
															}//ends if

															else
																{
																	
																			$msg = "Job Title already exits.";
																			$this->session->set_flashdata('flashError_job',$msg);
																			$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
																			$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
																			$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
																			$this->load->view('circle/header');
																			//$this->load->view('circle/topmenu');
																			$this->load->view('circle/sidebar');
																			$this->load->view('circle/jobs/joblist',$data);
																			$this->load->view('circle/footer');
																}//ends else

																
													}

														else
														{
															$msg = "Refrence no. already exits.";
															$this->session->set_flashdata('flashError_job',$msg);
															$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
																$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
																$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
																$this->load->view('circle/header');
																//$this->load->view('circle/topmenu');
																$this->load->view('circle/sidebar');
																$this->load->view('circle/jobs/joblist',$data);
																$this->load->view('circle/footer');
														}
											}

									else
									{
														if($job_title == $get_job_data->job_title)
												{	
													
														$update_data = array('refrence_no' => $refrence_no,
																'job_title' 			=> $job_title,
																'total_vacancy' 	=> $total_vacancy,
																'region_id' 			=> $region_name,
																'circle_id' 			=> $circle_name,
																'post_id' 				=> $post_name_code,
																'job_status' 			=> $job_status,
																'start_date' 			=> $start_date,
																'end_date' 				=> $end_date,
															  'updated_date'		=> $created_date);
															
														$updateid = $this->Base_model->update_record_by_id('tbl_jobs', $update_data, array('id'=> $uri));
														$msg = "Job updated successfully.";
														$this->session->set_flashdata('flashSuccess_job',$msg);
														$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
														$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
														$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
														$this->load->view('circle/header');
														//$this->load->view('circle/topmenu');
														$this->load->view('circle/sidebar');
														$this->load->view('circle/jobs/joblist',$data);
														$this->load->view('circle/footer');
												}//ends if

												else
												{
													
															$msg = "Job Title already exits.";
															$this->session->set_flashdata('flashError_job',$msg);
															$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
															$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
															$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
															$this->load->view('circle/header');
															//$this->load->view('circle/topmenu');
															$this->load->view('circle/sidebar');
															$this->load->view('circle/jobs/joblist',$data);
															$this->load->view('circle/footer');
												}//ends else
								
									}//ends elsee
									
								}//ends if 

								else if($get_refrence_no=='1')
								{
									
									if($refrence_no == $get_job_data->refrence_no)
									{
												$update_data = array('refrence_no' => $refrence_no,
												'job_title' 			=> $job_title,
												'total_vacancy' 	=> $total_vacancy,
												'region_id' 			=> $region_name,
												'circle_id' 			=> $circle_name,
												'post_id' 				=> $post_name_code,
												'job_status' 			=> $job_status,
												'start_date' 			=> $start_date,
												'end_date' 				=> $end_date,
											  'updated_date'		=> $created_date);
											
												$updateid = $this->Base_model->update_record_by_id('tbl_jobs', $update_data, array('id'=> $uri));
												$msg = "Job updated successfully.";
												$this->session->set_flashdata('flashSuccess_job',$msg);
												$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
												$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
												$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
												$this->load->view('circle/header');
												//$this->load->view('circle/topmenu');
												$this->load->view('circle/sidebar');
												$this->load->view('circle/jobs/joblist',$data);
												$this->load->view('circle/footer');
									}

									else
									{
										
											$msg = "Refrence no. already exits.";
											$this->session->set_flashdata('flashError_job',$msg);
											$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
												$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
												$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
												$this->load->view('circle/header');
												//$this->load->view('circle/topmenu');
												$this->load->view('circle/sidebar');
												$this->load->view('circle/jobs/joblist',$data);
												$this->load->view('circle/footer');
									}
									
								}

								else
								{
										$update_data = array('refrence_no' => $refrence_no,
												'job_title' 			=> $job_title,
												'total_vacancy' 	=> $total_vacancy,
												'region_id' 			=> $region_name,
												'circle_id' 			=> $circle_name,
												'post_id' 				=> $post_name_code,
												'job_status' 			=> $job_status,
												'start_date' 			=> $start_date,
												'end_date' 				=> $end_date,
											  'updated_date'		=> $created_date);
											
										$updateid = $this->Base_model->update_record_by_id('tbl_jobs', $update_data, array('id'=> $uri));

										if($updateid)
										{
											$msg = "Job updated successfully.";
											$this->session->set_flashdata('flashSuccess_job',$msg);
											$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
											$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
											$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
											$this->load->view('circle/header');
											//$this->load->view('circle/topmenu');
											$this->load->view('circle/sidebar');
											$this->load->view('circle/jobs/joblist',$data);
											$this->load->view('circle/footer');
										}

										else
										{
											$msg = "Fail to update job.";
											$this->session->set_flashdata('flashError_job', $msg);
											$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
											$this->load->view('circle/header');
											//$this->load->view('circle/topmenu');
											$this->load->view('circle/sidebar');
											$this->load->view('circle/jobs/joblist',$data);
											$this->load->view('circle/footer');
										}
								}//ends else
					}
				}//ends else

		}//ends if

		else
		{

				$uri = $this->uri->segment('3');
				$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
				$data['all_posts'] = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
				$data['job_data'] = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $uri));
				$this->load->view('circle/header');
				//$this->load->view('circle/topmenu');
				$this->load->view('circle/sidebar');
				$this->load->view('circle/jobs/edit_jobs',$data);
				$this->load->view('circle/footer');
		}//ends else
	}//ends function

	/********function for View Job******/

	public function view_job()
	{
				$uri = $this->uri->segment('3');
				$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
				$data['all_posts'] = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
				$data['job_data'] = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $uri));
				$this->load->view('circle/header');
				//$this->load->view('circle/topmenu');
				$this->load->view('circle/sidebar');
				$this->load->view('circle/jobs/view_jobs',$data);
				$this->load->view('circle/footer');

	}//ends function

	/********function for Delete Job******/

	public function delete_job()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean($this->input->post('delete_itemId'));
				$data['job_data'] = $job_data =  $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $delete_itemId));
				$update_data = array(
													'job_title' 		=> $job_data->job_title,
													'status'				=> '0',
													'delete_status' => '0',
													'job_status' 		=> '0',
													'updated_date' 	=> $created_date
												);
				$updateid = $this->Base_model->update_record_by_id('tbl_jobs', $update_data, array('id'=> $delete_itemId));
				$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
				$this->load->view('circle/header');
				//$this->load->view('circle/topmenu');
				$this->load->view('circle/sidebar');
				$this->load->view('circle/jobs/joblist',$data);
				$this->load->view('circle/footer');
	}//function ends

	/*********function for search jobs************/

		public function search_jobs()
	{
		
			$region_name = xss_clean($this->input->post('region_nnname'));
			$circle_name = xss_clean($this->input->post('circle_nnname'));
			$post_name 	 = xss_clean($this->input->post('post_nnname'));
			$user_id = $this->session->userdata('auser_id');
			$circle_user_data = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $user_id));
			if(empty($region_name) && empty($circle_name) && empty($post_name))
				{
					$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));
					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
					$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
					$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1','circle_id'=>$circle_user_data->Circle));
					$this->load->view('circle/header');
					$this->load->view('circle/sidebar');
					$this->load->view('circle/jobs/joblist',$data);
					$this->load->view('circle/footer');

				}//ends if

				else
				{
					$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));
					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
					$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
					$data['all_jobs'] 	 = $this->Base_model->search_jobs_circle($region_name,$circle_name,$post_name);
					$this->load->view('circle/header');
					$this->load->view('circle/sidebar');
					$this->load->view('circle/jobs/joblist',$data);
					$this->load->view('circle/footer');

				}//ends else
	}//function ends


	


}//class ends
