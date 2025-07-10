<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Organisation extends CI_Controller {

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
		$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_contact');
		$this->load->view('admin/contact_management/organisation/organisationlist',$data);	
		$this->load->view('admin/footer');
	}//ends function

	/***************function for add organisation***************/

	public function add_organisation()
	{	
		if(isset($_REQUEST['submit'])) 
		{
			$organisation_name  	  = xss_clean(strip_tags($this->input->post('organisation_name')));
			$this->form_validation->set_rules('organisation_name','organisation name','trim|required');
			if($this->form_validation->run() === false) 
				{

						$data['insertData'] = array(
							'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name')))	
						);
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar_contact');
						$this->load->view('admin/contact_management/organisation/addorganisation',$data);	
						$this->load->view('admin/footer');
				}//ends if

				else
				{
					$organisation_name  = xss_clean(strip_tags($this->input->post('organisation_name')));
					$ip_address			= $_SERVER['REMOTE_ADDR'];
					$session_id 		= $this->session->userdata('user_id');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");

					/*****check organisation name********/

						$checked = $this->Base_model->check_existent('contact_organisation', array('contact_organisation_name' 	=> $organisation_name,'delete_status'=>1));

					/*****ends check organisation name*****/

					if($checked=='1')
						{
								$msg = "Organisation name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_organisation', $msg);

								/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add contact organisation, already exits : '.$organisation_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/


								$data['insertData'] = array(
							'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name')))	
						);
						
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar_contact');
							$this->load->view('admin/contact_management/organisation/addorganisation',$data);	
							$this->load->view('admin/footer');
						}//ends if

						else
						{
							
								$insert_data = array(
													'contact_organisation_name'=> $organisation_name,
													'client_ip' 						=> $ip_address,
													'modified_by' 					=> $session_id,
													'created_date' 					=> $created_date,
													'updated_date' 					=> $created_date
												);
							 $insertid = $this->Base_model->insert_one_row('contact_organisation', $insert_data);

							 if($insertid)
								{
									$msg = "Organisation added successfully.";
									$this->session->set_flashdata('organisation_add_flashSuccess',$msg);

									/*********logs code*******/
								
								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' added contact organisation successfully : '.$organisation_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/organisation/organisationlist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to add orgnisation.";
									$this->session->set_flashdata('organisation_add_flashError',$msg);

									/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add contact organisation : '.$organisation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/organisation/organisationlist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}

		else
		{
			$data = '';
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/organisation/addorganisation',$data);	
			$this->load->view('admin/footer');
		}
	}//ends function

	/*****************function for update organisation***************/

		public function edit_organisation()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			$organisation_name  	  = xss_clean(strip_tags($this->input->post('organisation_name')));
			$this->form_validation->set_rules('organisation_name','organisation name','trim|required');

				if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
							'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name')))	
						);
						
					$uri = $this->uri->segment('4');
					$data['organisation_data'] = $this->Base_model->get_record_by_id('contact_organisation', array('contact_organisation_id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar_contact');
					$this->load->view('admin/contact_management/organisation/editorganisation',$data);	
					$this->load->view('admin/footer');
					
				}//ends if

				else
				{
					$organisation_name  = xss_clean(strip_tags($this->input->post('organisation_name')));
					$ip_address						= $_SERVER['REMOTE_ADDR'];
					$session_id 					= $this->session->userdata('user_id');
					$uri 									= $this->uri->segment('4');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
			 

					/*****check organisation name********/

						$checked = $this->Contact_model->check_existent_organisation($organisation_name, $uri);

					/*****ends check organisation name*****/

						if($checked=='1')
						{
								$msg = "Organisation name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_organisation', $msg);

								/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update contact organisation : '.$organisation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

								$data['insertData'] = array(
								'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name')))	
								);
								$uri = $this->uri->segment('4');
								$data['organisation_data'] = $this->Base_model->get_record_by_id('contact_organisation', array('contact_organisation_id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar_contact');
								$this->load->view('admin/contact_management/organisation/editorganisation',$data);	
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$uri = $this->uri->segment('4');
								$update_data = array(
													'contact_organisation_name'=> $organisation_name,
													'client_ip' 						=> $ip_address,
													'modified_by' 					=> $session_id,
													'updated_date' 					=> $created_date
												);
							 $updateid = $this->Base_model->update_record_by_id('contact_organisation', $update_data, array('contact_organisation_id'=> $uri));

							 if($updateid)
								{
									$msg = "Organisation updated successfully.";
									$this->session->set_flashdata('organisation_add_flashSuccess',$msg);

									/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' contact organisation updated successfully : '.$organisation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/organisation/organisationlist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to update organisation.";
									$this->session->set_flashdata('building_add_flashError',$msg);

									/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' fail to update contact organisation : '.$organisation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/organisation/organisationlist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{
			$uri = $this->uri->segment('4');
			$data['organisation_data'] = $this->Base_model->get_record_by_id('contact_organisation', array('contact_organisation_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/organisation/editorganisation',$data);	
			$this->load->view('admin/footer');
		}//ends else

	}//end function

		/********function for View Organisation******/

	public function view_organisation()
	{
			$uri = $this->uri->segment('4');
			$data['organisation_data'] = $this->Base_model->get_record_by_id('contact_organisation', array('contact_organisation_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/organisation/vieworganisation',$data);	
			$this->load->view('admin/footer');	
	}//ends function


	/*****************function for delete organisation**********/

	public function delete_organisation()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean(strip_tags($this->input->post('delete_itemId')));
				$data['organisation_data'] = $organisation_data = $this->Base_model->get_record_by_id('contact_organisation', array('contact_organisation_id' => $delete_itemId));

					/*****check organisation name********/
						$checked = $this->Base_model->check_existent('contact_organisation', array('contact_organisation_id' 	=> $delete_itemId,'delete_status'=>0));
					/*****ends check organisation name*****/

						if($checked=='1')
						{
								$msg = "Organisation already deleted.";
								$this->session->set_flashdata('organisation_add_flashError	', $msg);
								
								/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted contact organisation : '.$organisation_data->contact_organisation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/


								$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/organisation/organisationlist',$data);	
									$this->load->view('admin/footer');
						}//ends if

						else
						{
								$update_data = array(
													'status'				=> '0',
													'delete_status' => '0',
													'updated_date' 	=> $created_date
												);
								$updateid = $this->Base_model->update_record_by_id('contact_organisation', $update_data, array('contact_organisation_id'=> $delete_itemId));
								$msg = "Organisation deleted successfully.";
								$this->session->set_flashdata('organisation_delete_flashSuccess',$msg);

								/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted contact organisation : '.$organisation_data->contact_organisation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/
								
								$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/organisation/organisationlist',$data);	
									$this->load->view('admin/footer');
						}
				
	}//ends function

	/*********function for search organisation***********/

	public function search_organisation()
	{
		$organisation_name  	  = xss_clean(strip_tags($this->input->post('organisation_name')));

			if(empty($organisation_name))
			{
				$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar_contact');
				$this->load->view('admin/contact_management/organisation/organisationlist',$data);	
				$this->load->view('admin/footer');
			}

			else
			{
				$data['all_organisations'] = $this->Contact_model->search_organisation($organisation_name);
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar_contact');
				$this->load->view('admin/contact_management/organisation/organisationlist',$data);	
				$this->load->view('admin/footer');
			}
	}//ends function



	

	
}//class ends


