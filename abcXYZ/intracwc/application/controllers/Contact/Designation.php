<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designation extends CI_Controller {

	// Initialize Constructor Here
	function __construct()
	{
		parent::__construct();
		$this->load->model('Base_model');
		$this->load->model('Contact_model');
		if(empty($this->session->userdata('user_id')))
	     {
	     	$base_url = base_url().'Frontend';
	        redirect($base_url);
	     } 
		
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
		$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
		$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_contact');
		$this->load->view('admin/contact_management/designation/designationlist',$data);	
		$this->load->view('admin/footer');
	}//ends function

	/***************function for add designation***************/

	public function add_designation()
	{	
		if(isset($_REQUEST['submit'])) 
		{
			
			$organisation_name  	  = xss_clean(strip_tags($this->input->post('organisation_name')));
			$post_name  	  				= xss_clean(strip_tags($this->input->post('post_name')));
			$designation_name  	  	= xss_clean(strip_tags($this->input->post('designation_name')));
			
			$this->form_validation->set_rules('organisation_name','organisation name','trim|required');
			$this->form_validation->set_rules('post_name','post name','trim|required');
			$this->form_validation->set_rules('designation_name','designation name','trim|required');

			if($this->form_validation->run() === false) 
				{
						$data['insertData'] = array(
						
							'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name'))),
							'post_name' 				=> xss_clean(strip_tags($this->input->post('post_name'))),
							'designation_name' 	=> xss_clean(strip_tags($this->input->post('designation_name'))),		
						);

						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
						$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
						$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar_contact');
						$this->load->view('admin/contact_management/designation/adddesignation',$data);	
						$this->load->view('admin/footer');
				}//ends if

				else
				{
						$organisation_name  	  = xss_clean(strip_tags($this->input->post('organisation_name')));
						$post_name  	  				= xss_clean(strip_tags($this->input->post('post_name')));
						$designation_name  	  	= xss_clean(strip_tags($this->input->post('designation_name')));
						$ip_address					= $_SERVER['REMOTE_ADDR'];
						$session_id 				= $this->session->userdata('user_id');
						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");

					/*****check designation name********/

						$checked = $this->Base_model->check_existent('contact_designation', array('contact_designation_name'=> $designation_name,'contact_organisation_id'=>$organisation_name,'contact_post_id'=>$post_name,'delete_status'=>1));

					/*****ends check designation name*****/

					if($checked=='1')
						{
							$msg = "Designation name already exits for this organisation, Please enter new one";
							$this->session->set_flashdata('flashError_designation', $msg);

										/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add contact designation, already exits : '.$designation_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

										/*********ends logs code*******/

							$data['insertData'] = array(
						
							'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name'))),
							'post_name' 				=> xss_clean(strip_tags($this->input->post('post_name'))),
							'designation_name' 	=> xss_clean(strip_tags($this->input->post('designation_name'))),		
						);

							$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
							$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
							$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar_contact');
							$this->load->view('admin/contact_management/designation/adddesignation',$data);	
							$this->load->view('admin/footer');
						}//ends if

						else
						{
							
								$insert_data = array(
													'contact_designation_name'=> $designation_name,
													'contact_organisation_id'=> $organisation_name,
													'contact_post_id'				=> $post_name,
													'client_ip' 						=> $ip_address,
													'modified_by' 					=> $session_id,
													'created_date' 					=> $created_date,
													'updated_date' 					=> $created_date
												);
							 $insertid = $this->Base_model->insert_one_row('contact_designation', $insert_data);

							 if($insertid)
								{
									$msg = "Designation added successfully.";
									$this->session->set_flashdata('designation_add_flashSuccess',$msg);

									/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' added contact designation successfully : '.$designation_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

										/*********ends logs code*******/

									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
									$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/designation/designationlist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to add designation.";
									$this->session->set_flashdata('designation_add_flashError',$msg);

									/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add contact designation : '.$designation_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

										/*********ends logs code*******/

									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
									$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/designation/designationlist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}

		else
		{
			$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
			$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/designation/adddesignation',$data);	
			$this->load->view('admin/footer');
		}
	}//ends function

	/*****************function for update designation***************/

		public function edit_designation()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			$organisation_name  	  = xss_clean(strip_tags($this->input->post('organisation_name')));
			$post_name  	  				= xss_clean(strip_tags($this->input->post('post_name')));
			$designation_name  	  	= xss_clean(strip_tags($this->input->post('designation_name')));
			
			$this->form_validation->set_rules('organisation_name','organisation name','trim|required');
			$this->form_validation->set_rules('post_name','post name','trim|required');
			$this->form_validation->set_rules('designation_name','designation name','trim|required');

			if($this->form_validation->run() === false) 
				{
						$data['insertData'] = array(
						
							'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name'))),
							'post_name' 				=> xss_clean(strip_tags($this->input->post('post_name'))),
							'designation_name' 	=> xss_clean(strip_tags($this->input->post('designation_name'))),		
						);

						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
						$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
						$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
						$uri = $this->uri->segment('4');
						$data['designation_data'] = $this->Base_model->get_record_by_id('contact_designation', array('contact_designation_id' => $uri));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar_contact');
						$this->load->view('admin/contact_management/designation/editdesignation',$data);	
						$this->load->view('admin/footer');
					
				}//ends if

				else
				{
					$organisation_name  	  = xss_clean(strip_tags($this->input->post('organisation_name')));
					$post_name  	  				= xss_clean(strip_tags($this->input->post('post_name')));
					$designation_name  	  	= xss_clean(strip_tags($this->input->post('designation_name')));
					$ip_address						= $_SERVER['REMOTE_ADDR'];
					$session_id 					= $this->session->userdata('user_id');
					$uri 									= $this->uri->segment('4');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
			 

					/*****check designation name********/

						$checked = $this->Contact_model->check_existent_designation($organisation_name,$post_name,$designation_name,$uri);

					/*****ends check designation name*****/

						if($checked=='1')
						{
								$msg = "Designation name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_designation', $msg);

								/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update contact designation, already exits : '.$designation_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

								$data['insertData'] = array(
						
								'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name'))),
								'post_name' 				=> xss_clean(strip_tags($this->input->post('post_name'))),
								'designation_name' 	=> xss_clean(strip_tags($this->input->post('designation_name'))),		
									);

								$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
								$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
								$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
								$uri = $this->uri->segment('4');
								$data['designation_data'] = $this->Base_model->get_record_by_id('contact_designation', array('contact_designation_id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar_contact');
								$this->load->view('admin/contact_management/designation/editdesignation',$data);	
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$uri = $this->uri->segment('4');
								$update_data = array(
													'contact_designation_name'=> $designation_name,
													'contact_organisation_id'=> $organisation_name,
													'contact_post_id'				=> $post_name,
													'client_ip' 						=> $ip_address,
													'modified_by' 					=> $session_id,
													'updated_date' 					=> $created_date
												);
							 $updateid = $this->Base_model->update_record_by_id('contact_designation', $update_data, array('contact_designation_id'=> $uri));

							 if($updateid)
								{
									$msg = "Designation updated successfully.";
									$this->session->set_flashdata('designation_add_flashSuccess',$msg);

									/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' contact designation updated successfully : '.$designation_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
									$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/designation/designationlist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to update designation.";
									$this->session->set_flashdata('designation_add_flashError',$msg);

									/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update contact designation : '.$designation_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
									$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/designation/designationlist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
			$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
			$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
			$uri = $this->uri->segment('4');
			$data['designation_data'] = $this->Base_model->get_record_by_id('contact_designation', array('contact_designation_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/designation/editdesignation',$data);	
			$this->load->view('admin/footer');
		}//ends else

	}//end function

		/********function for View designation******/

	public function view_designation()
	{
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
			$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
			$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
			$uri = $this->uri->segment('4');
			$data['designation_data'] = $this->Base_model->get_record_by_id('contact_designation', array('contact_designation_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/designation/viewdesignation',$data);	
			$this->load->view('admin/footer');
	}//ends function


	/*****************function for delete designation**********/

	public function delete_designation()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean(strip_tags($this->input->post('delete_itemId')));
				$data['designation_data'] = $designation_data = $this->Base_model->get_record_by_id('contact_designation', array('contact_designation_id' => $delete_itemId));

					/*****check designation name********/

						$checked = $this->Base_model->check_existent('contact_designation', array('contact_designation_id'=> $delete_itemId,'delete_status'=>0));

					/*****ends check designation name*****/

						if($checked=='1')
						{
								$msg = "Designation already deleted.";
								$this->session->set_flashdata('designation_add_flashError', $msg);
								
								/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' already deleted contact designation: '.$designation_data->contact_designation_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

								$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
								$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
								$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar_contact');
								$this->load->view('admin/contact_management/designation/designationlist',$data);	
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$update_data = array(
													'status'				=> '0',
													'delete_status' => '0',
													'updated_date' 	=> $created_date
												);
								$updateid = $this->Base_model->update_record_by_id('contact_designation', $update_data, array('contact_designation_id'=> $delete_itemId));
								$msg = "Designation deleted successfully.";
								$this->session->set_flashdata('designation_delete_flashSuccess',$msg);

								/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted contact designation : '.$designation_data->contact_designation_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/
								$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
								$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
								$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar_contact');
								$this->load->view('admin/contact_management/designation/designationlist',$data);	
								$this->load->view('admin/footer');
						}
				
	}//ends function


	/*******function to gettting all post********/

	public function all_post()
	{
		
		$organisation_id = strip_tags($this->input->post('id'));
		$all_organisation =  $this->Base_model->get_all_record_by_condition('contact_post', array('contact_organisation_id'=>$organisation_id,'delete_status'=>1));
		$all_posts =  json_encode($all_organisation);
		echo  $all_posts;
	}// ends function

		/*******function to gettting all designations********/

	public function search_designation()
	{
	
		$designation_name = xss_clean(strip_tags($this->input->post('designation_name')));

			if(empty($designation_name))
			{
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
					$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
					$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar_contact');
					$this->load->view('admin/contact_management/designation/designationlist',$data);	
					$this->load->view('admin/footer');
			}

			else
			{
					$data['all_designation'] = $this->Contact_model->search_designation($designation_name);
					$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
					$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar_contact');
					$this->load->view('admin/contact_management/designation/designationlist',$data);	
					$this->load->view('admin/footer');
			}
	}// ends function



	

	
}//class ends


