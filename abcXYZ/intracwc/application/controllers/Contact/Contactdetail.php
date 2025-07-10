<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contactdetail extends CI_Controller {

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
			$data['all_contact'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('delete_status'=>1));
			$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
			$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
			$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
			$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/contact/contactlist',$data);	
			$this->load->view('admin/footer');
	}//ends function

	/***************function for add contact***************/

	public function add_contact()
	{	
		if(isset($_REQUEST['submit'])) 
		{

			$wing_name  	 				 = xss_clean(strip_tags($this->input->post('wing_name')));
			$organisation_name  	 = xss_clean(strip_tags($this->input->post('organisation_name')));
			$post_name  	   			 = xss_clean(strip_tags($this->input->post('post_name')));
			$designation_name  	   = xss_clean(strip_tags($this->input->post('designation_name')));
			$reporting  	  			 = xss_clean(strip_tags($this->input->post('reporting')));
			$user_name  	  			 = xss_clean(strip_tags($this->input->post('user_name')));
			$mobile_no  	  			 = xss_clean(strip_tags($this->input->post('mobile_no')));
			$office_no  	  			 = xss_clean(strip_tags($this->input->post('office_no')));
			$res_no  	  					 = xss_clean(strip_tags($this->input->post('res_no')));
			$room_no  	  				 = xss_clean(strip_tags($this->input->post('room_no')));
			$extension_no  	  		 = xss_clean(strip_tags($this->input->post('extension_no')));
			$fax_no  	  					 = xss_clean(strip_tags($this->input->post('fax_no')));
			$office_address  	  	 = xss_clean(strip_tags($this->input->post('office_address')));
			$state  	  					 = xss_clean(strip_tags($this->input->post('state')));
			$city  	  						 = xss_clean(strip_tags($this->input->post('city')));
			$pincode  	  				 = xss_clean(strip_tags($this->input->post('pincode')));
			
			$this->form_validation->set_rules('wing_name','wing name','trim|required');
			$this->form_validation->set_rules('organisation_name','organisation name','trim|required');
			$this->form_validation->set_rules('post_name','post name','trim|required');
			$this->form_validation->set_rules('designation_name','designation name','trim|required');
			$this->form_validation->set_rules('user_name','user name','trim|required');
			$this->form_validation->set_rules('mobile_no','mobile number','trim|required');
			$this->form_validation->set_rules('office_no','office number','trim|required');
			$this->form_validation->set_rules('res_no','residence number','trim|required');
			$this->form_validation->set_rules('room_no','room number','trim|required');
			$this->form_validation->set_rules('extension_no','extension number','trim|required');
			$this->form_validation->set_rules('fax_no','fax number','trim|required');
			$this->form_validation->set_rules('office_address','office address','trim|required');
			$this->form_validation->set_rules('state','state','trim|required');
			$this->form_validation->set_rules('city','city','trim|required');
			$this->form_validation->set_rules('pincode','pincode','trim|required');

			if($this->form_validation->run() === false) 
				{
						$data['insertData'] = array(
							'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name'))),
							'post_name' 				=> xss_clean(strip_tags($this->input->post('post_name'))),
							'designation_name' 	=> xss_clean(strip_tags($this->input->post('designation_name'))),		
							'user_name' 	=> xss_clean(strip_tags($this->input->post('user_name'))),
							'mobile_no' 	=> xss_clean(strip_tags($this->input->post('mobile_no'))),
							'office_no' 	=> xss_clean(strip_tags($this->input->post('office_no'))),
							'res_no' 	=> xss_clean(strip_tags($this->input->post('res_no'))),
							'room_no' 	=> xss_clean(strip_tags($this->input->post('room_no'))),
							'extension_no' 	=> xss_clean(strip_tags($this->input->post('extension_no'))),
							'fax_no' 	=> xss_clean(strip_tags($this->input->post('fax_no'))),
							'office_address' 	=> xss_clean(strip_tags($this->input->post('office_address'))),
							'state' 	=> xss_clean(strip_tags($this->input->post('state'))),
							'city' 	=> xss_clean(strip_tags($this->input->post('city'))),
							'pincode' 	=> xss_clean(strip_tags($this->input->post('pincode'))),
							'reporting' 	=> xss_clean(strip_tags($this->input->post('reporting'))),

						);

						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
						$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
						$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
						$data['all_contact'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('delete_status'=>1));
						$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
						$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
						$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
						$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar_contact');
						$this->load->view('admin/contact_management/contact/addcontact',$data);	
						$this->load->view('admin/footer');
				}//ends if

				else
				{
						$wing_name  	 				 = xss_clean(strip_tags($this->input->post('wing_name')));
						$organisation_name  	 = xss_clean(strip_tags($this->input->post('organisation_name')));
						$post_name  	   			 = xss_clean(strip_tags($this->input->post('post_name')));
						$designation_name  	   = xss_clean(strip_tags($this->input->post('designation_name')));
						$reporting  	  			 = xss_clean(strip_tags($this->input->post('reporting')));
						$user_name  	  			 = xss_clean(strip_tags($this->input->post('user_name')));
						$mobile_no  	  			 = xss_clean(strip_tags($this->input->post('mobile_no')));
						$office_no  	  			 = xss_clean(strip_tags($this->input->post('office_no')));
						$res_no  	  					 = xss_clean(strip_tags($this->input->post('res_no')));
						$room_no  	  				 = xss_clean(strip_tags($this->input->post('room_no')));
						$extension_no  	  		 = xss_clean(strip_tags($this->input->post('extension_no')));
						$fax_no  	  					 = xss_clean(strip_tags($this->input->post('fax_no')));
						$office_address  	  	 = xss_clean(strip_tags($this->input->post('office_address')));
						$state  	  					 = xss_clean(strip_tags($this->input->post('state')));
						$city  	  						 = xss_clean(strip_tags($this->input->post('city')));
						$pincode  	  				 = xss_clean(strip_tags($this->input->post('pincode')));
						$ip_address						 = $_SERVER['REMOTE_ADDR'];
						$session_id 					 = $this->session->userdata('user_id');
						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");

					/*****check contact condtion********/

						$checked = 0;

					/*****ends check contact condtion*****/

					if($checked=='1')
						{
							$msg = "Contact already exits for this organisation, Please enter new one";
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
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add contact, already exits : '.$user_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						/*********ends logs code*******/

							$data['insertData'] = array(
								'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name'))),
							'post_name' 				=> xss_clean(strip_tags($this->input->post('post_name'))),
							'designation_name' 	=> xss_clean(strip_tags($this->input->post('designation_name'))),		
							'user_name' 	=> xss_clean(strip_tags($this->input->post('user_name'))),
							'mobile_no' 	=> xss_clean(strip_tags($this->input->post('mobile_no'))),
							'office_no' 	=> xss_clean(strip_tags($this->input->post('office_no'))),
							'res_no' 	=> xss_clean(strip_tags($this->input->post('res_no'))),
							'room_no' 	=> xss_clean(strip_tags($this->input->post('room_no'))),
							'extension_no' 	=> xss_clean(strip_tags($this->input->post('extension_no'))),
							'fax_no' 	=> xss_clean(strip_tags($this->input->post('fax_no'))),
							'office_address' 	=> xss_clean(strip_tags($this->input->post('office_address'))),
							'state' 	=> xss_clean(strip_tags($this->input->post('state'))),
							'city' 	=> xss_clean(strip_tags($this->input->post('city'))),
							'pincode' 	=> xss_clean(strip_tags($this->input->post('pincode'))),
							'reporting' 	=> xss_clean(strip_tags($this->input->post('reporting'))),

						);

							$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
							$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
							$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
							$data['all_contact'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('delete_status'=>1));
							$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
							$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
							$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
							$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar_contact');
							$this->load->view('admin/contact_management/contact/addcontact',$data);	
							$this->load->view('admin/footer');
						}//ends if

						else
						{
							
								$insert_data = array(
													'contact_wing'				=> $wing_name,
													'contact_organisation'=> $organisation_name,
													'contact_post'				=> $post_name,
													'contact_designation'	=> $designation_name,
													'name'								=> $user_name,
													'mobile_no'						=> $mobile_no,
													'office_no'						=> $office_no,
													'res_no'							=> $res_no,
													'room_no'							=> $room_no,
													'extension_no'				=> $extension_no,
													'fax_no'							=> $fax_no,
													'office_address'			=> $office_address,
													'state'								=> $state,
													'city'								=> $city,
													'pincode'							=> $pincode,
													'client_ip' 						=> $ip_address,
													'modified_by' 					=> $session_id,
													'created_date' 					=> $created_date,
													'updated_date' 					=> $created_date
												);
							 $insertid = $this->Base_model->insert_one_row('contact_detail_master', $insert_data);

							  /***************save contact reporting****************/
									 	$i=0;

									 	 foreach($reporting as $report)
									 	 {

										   $insertid2 = $this->Base_model->insert_one_row('contact_relation', 
										      array('contact_parent_id'	=> $reporting[$i],
													'contact_child_id'				=> $insertid,
													'client_ip' 							=> $ip_address,
													'modified_by' 						=> $session_id,
													'created_date' 						=> $created_date,
													'updated_date' 						=> $created_date
												) );	
												$i++;
								   
										}

									 /*************ends save contact reporting****************/
						

							 if($insertid)
								{
									$msg = "Contact added successfully.";
									$this->session->set_flashdata('contact_add_flashSuccess',$msg);

									/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' contact added:  : '.$user_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						/*********ends logs code*******/

									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
									$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$data['all_contact'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('delete_status'=>1));
									$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
									$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/contact/contactlist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to add contact.";
									$this->session->set_flashdata('contact_add_flashError',$msg);
									/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add contact : '.$user_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						/*********ends logs code*******/

									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
									$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$data['all_contact'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('delete_status'=>1));
									$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
									$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/contact/contactlist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}

		else
		{
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
			$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
			$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
			$data['all_contact'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('delete_status'=>1));
			$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
			$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
			$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
			$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/contact/addcontact',$data);	
			$this->load->view('admin/footer');
		}
	}//ends function

	/*****************function for update contact***************/

		public function edit_contact()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			$wing_name  	 				 = xss_clean(strip_tags($this->input->post('wing_name')));
			$organisation_name  	 = xss_clean(strip_tags($this->input->post('organisation_name')));
			$post_name  	   			 = xss_clean(strip_tags($this->input->post('post_name')));
			$designation_name  	   = xss_clean(strip_tags($this->input->post('designation_name')));
			$reporting  	  			 = xss_clean(strip_tags($this->input->post('reporting')));
			$user_name  	  			 = xss_clean(strip_tags($this->input->post('user_name')));
			$mobile_no  	  			 = xss_clean(strip_tags($this->input->post('mobile_no')));
			$office_no  	  			 = xss_clean(strip_tags($this->input->post('office_no')));
			$res_no  	  					 = xss_clean(strip_tags($this->input->post('res_no')));
			$room_no  	  				 = xss_clean(strip_tags($this->input->post('room_no')));
			$extension_no  	  		 = xss_clean(strip_tags($this->input->post('extension_no')));
			$fax_no  	  					 = xss_clean(strip_tags($this->input->post('fax_no')));
			$office_address  	  	 = xss_clean(strip_tags($this->input->post('office_address')));
			$state  	  					 = xss_clean(strip_tags($this->input->post('state')));
			$city  	  						 = xss_clean(strip_tags($this->input->post('city')));
			$pincode  	  				 = xss_clean(strip_tags($this->input->post('pincode')));
			
			$this->form_validation->set_rules('wing_name','wing name','trim|required');
			$this->form_validation->set_rules('organisation_name','organisation name','trim|required');
			$this->form_validation->set_rules('post_name','post name','trim|required');
			$this->form_validation->set_rules('designation_name','designation name','trim|required');
			$this->form_validation->set_rules('user_name','user name','trim|required');
			$this->form_validation->set_rules('mobile_no','mobile number','trim|required');
			$this->form_validation->set_rules('office_no','office number','trim|required');
			$this->form_validation->set_rules('res_no','residence number','trim|required');
			$this->form_validation->set_rules('room_no','room number','trim|required');
			$this->form_validation->set_rules('extension_no','extension number','trim|required');
			$this->form_validation->set_rules('fax_no','fax number','trim|required');
			$this->form_validation->set_rules('office_address','office address','trim|required');
			$this->form_validation->set_rules('state','state','trim|required');
			$this->form_validation->set_rules('city','city','trim|required');
			$this->form_validation->set_rules('pincode','pincode','trim|required');

			if($this->form_validation->run() === false) 
				{
						$data['insertData'] = array(
							'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name'))),
							'post_name' 				=> xss_clean(strip_tags($this->input->post('post_name'))),
							'designation_name' 	=> xss_clean(strip_tags($this->input->post('designation_name'))),		
							'user_name' 	=> xss_clean(strip_tags($this->input->post('user_name'))),
							'mobile_no' 	=> xss_clean(strip_tags($this->input->post('mobile_no'))),
							'office_no' 	=> xss_clean(strip_tags($this->input->post('office_no'))),
							'res_no' 	=> xss_clean(strip_tags($this->input->post('res_no'))),
							'room_no' 	=> xss_clean(strip_tags($this->input->post('room_no'))),
							'extension_no' 	=> xss_clean(strip_tags($this->input->post('extension_no'))),
							'fax_no' 	=> xss_clean(strip_tags($this->input->post('fax_no'))),
							'office_address' 	=> xss_clean(strip_tags($this->input->post('office_address'))),
							'state' 	=> xss_clean(strip_tags($this->input->post('state'))),
							'city' 	=> xss_clean(strip_tags($this->input->post('city'))),
							'pincode' 	=> xss_clean(strip_tags($this->input->post('pincode'))),
							'reporting' 	=> xss_clean(strip_tags($this->input->post('reporting'))),

						);

						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
						$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
						$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
						$data['all_contact'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('delete_status'=>1));
						$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
						$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
						$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
						$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
						$uri = $this->uri->segment('4');
						$data['contact_user_data'] = $this->Base_model->get_record_by_id('contact_detail_master', array('contact_detail_master_id' => $uri));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar_contact');
						$this->load->view('admin/contact_management/contact/editcontact',$data);	
						$this->load->view('admin/footer');
					
				}//ends if

				else
				{
					$wing_name  	 				 = xss_clean(strip_tags($this->input->post('wing_name')));
					$organisation_name  	 = xss_clean(strip_tags($this->input->post('organisation_name')));
					$post_name  	   			 = xss_clean(strip_tags($this->input->post('post_name')));
					$designation_name  	   = xss_clean(strip_tags($this->input->post('designation_name')));
					$reporting  	  			 = xss_clean(strip_tags($this->input->post('reporting')));
					$user_name  	  			 = xss_clean(strip_tags($this->input->post('user_name')));
					$mobile_no  	  			 = xss_clean(strip_tags($this->input->post('mobile_no')));
					$office_no  	  			 = xss_clean(strip_tags($this->input->post('office_no')));
					$res_no  	  					 = xss_clean(strip_tags($this->input->post('res_no')));
					$room_no  	  				 = xss_clean(strip_tags($this->input->post('room_no')));
					$extension_no  	  		 = xss_clean(strip_tags($this->input->post('extension_no')));
					$fax_no  	  					 = xss_clean(strip_tags($this->input->post('fax_no')));
					$office_address  	  	 = xss_clean(strip_tags($this->input->post('office_address')));
					$state  	  					 = xss_clean(strip_tags($this->input->post('state')));
					$city  	  						 = xss_clean(strip_tags($this->input->post('city')));
					$pincode  	  				 = xss_clean(strip_tags($this->input->post('pincode')));
					$ip_address						 = $_SERVER['REMOTE_ADDR'];
					$session_id 					 = $this->session->userdata('user_id');
					$uri 									 = $this->uri->segment('4');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
			 

					/*****check contact condition********/

						$checked = 0;

					/*****ends check contact condotion*****/

						if($checked=='1')
						{
								$msg = "Contact already exits, Please enter new one";
								$this->session->set_flashdata('flashError_contact', $msg);

								/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update contact, already exits : '.$user_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						/*********ends logs code*******/

								$data['insertData'] = array(
							'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name'))),
							'post_name' 				=> xss_clean(strip_tags($this->input->post('post_name'))),
							'designation_name' 	=> xss_clean(strip_tags($this->input->post('designation_name'))),		
							'user_name' 	=> xss_clean(strip_tags($this->input->post('user_name'))),
							'mobile_no' 	=> xss_clean(strip_tags($this->input->post('mobile_no'))),
							'office_no' 	=> xss_clean(strip_tags($this->input->post('office_no'))),
							'res_no' 	=> xss_clean(strip_tags($this->input->post('res_no'))),
							'room_no' 	=> xss_clean(strip_tags($this->input->post('room_no'))),
							'extension_no' 	=> xss_clean(strip_tags($this->input->post('extension_no'))),
							'fax_no' 	=> xss_clean(strip_tags($this->input->post('fax_no'))),
							'office_address' 	=> xss_clean(strip_tags($this->input->post('office_address'))),
							'state' 	=> xss_clean(strip_tags($this->input->post('state'))),
							'city' 	=> xss_clean(strip_tags($this->input->post('city'))),
							'pincode' 	=> xss_clean(strip_tags($this->input->post('pincode'))),
							'reporting' 	=> xss_clean(strip_tags($this->input->post('reporting'))),

						);

						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
						$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
						$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
						$data['all_contact'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('delete_status'=>1));
						$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
						$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
						$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
						$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
						$uri = $this->uri->segment('4');
						$data['contact_user_data'] = $this->Base_model->get_record_by_id('contact_detail_master', array('contact_detail_master_id' => $uri));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar_contact');
						$this->load->view('admin/contact_management/contact/editcontact',$data);	
						$this->load->view('admin/footer');
						}//ends if

						else
						{
								$uri = $this->uri->segment('4');
								$update_data = array(
													'contact_wing'				=> $wing_name,
													'contact_organisation'=> $organisation_name,
													'contact_post'				=> $post_name,
													'contact_designation'	=> $designation_name,
													'name'								=> $user_name,
													'mobile_no'						=> $mobile_no,
													'office_no'						=> $office_no,
													'res_no'							=> $res_no,
													'room_no'							=> $room_no,
													'extension_no'				=> $extension_no,
													'fax_no'							=> $fax_no,
													'office_address'			=> $office_address,
													'state'								=> $state,
													'city'								=> $city,
													'pincode'							=> $pincode,
													'client_ip' 					=> $ip_address,
													'modified_by' 				=> $session_id,
													'updated_date' 				=> $created_date
												);
							 $updateid = $this->Base_model->update_record_by_id('contact_detail_master', $update_data, array('contact_detail_master_id'=> $uri));
				
							 		  /***************update contact reporting****************/
							 		  
							 		  $where_user = array(
				            'contact_child_id' => $uri
				        		);
				        		$this->Base_model->delete_record_by_id('contact_relation', $where_user);
									 	$i=0;
									 	 foreach($reporting as $report)
									 	 {
										   $insertid2 = $this->Base_model->insert_one_row('contact_relation', 
										      array('contact_parent_id'	=> $reporting[$i],
													'contact_child_id'				=> $uri,
													'client_ip' 							=> $ip_address,
													'modified_by' 						=> $session_id,
													'created_date' 						=> $created_date,
													'updated_date' 						=> $created_date
												) );	
												$i++;
								   
										}

									 /*************ends update contact reporting****************/

							 if($updateid)
								{
									$msg = "Contact updated successfully.";
									$this->session->set_flashdata('contact_add_flashSuccess',$msg);

									/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' updated contact : '.$user_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						/*********ends logs code*******/

										$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
									$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$data['all_contact'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('delete_status'=>1));
									$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
									$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/contact/contactlist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to update contact.";
									$this->session->set_flashdata('contact_add_flashError',$msg);

									/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update contact : '.$user_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
									$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$data['all_contact'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('delete_status'=>1));
									$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
									$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/contact/contactlist',$data);	
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
			$data['all_contact'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('delete_status'=>1));
			$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
			$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
			$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
			$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
			$data['city'] = $this->Base_model->get_all_record_by_condition('district_master',NULL);
			$uri = $this->uri->segment('4');
			$data['contact_user_data'] = $this->Base_model->get_record_by_id('contact_detail_master', array('contact_detail_master_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/contact/editcontact',$data);	
			$this->load->view('admin/footer');
		}//ends else

	}//end function

		/********function for View contact******/

	public function view_contact()
	{
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
			$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
			$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
			$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
			$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
			$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
			$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
			$uri = $this->uri->segment('4');
			$data['contact_user_data'] = $this->Base_model->get_record_by_id('contact_detail_master', array('contact_detail_master_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/contact/viewcontact',$data);	
			$this->load->view('admin/footer');
	}//ends function

	/********function for upper_level******/

	public function upper()
	{
			$uri = $this->uri->segment('4');
			$parent= $this->Base_model->get_all_record_by_condition('contact_relation', array('contact_child_id'=>$uri));
			
			$all_upper = array();
			foreach ($parent as $parent_data) 
			{
				if($parent_data->contact_parent_id=='0')
				{
						$parent_id = '1';
				}

				else
				{
					 $parent_id = $parent_data->contact_parent_id;
				}
				$all_upper[] =  $this->Base_model->get_record_by_id('contact_detail_master', array('contact_detail_master_id' => $parent_id,'delete_status'=>1));
			}//ends foreach
	
			$data['all_contacts'] = $all_upper;
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/contact/upper1',$data);	
			$this->load->view('admin/footer');
	}//ends function

	/************function for upper level second fucntion*********/

	public function upper_second()
	{
			$uri = $this->uri->segment('4');
			$parent= $this->Base_model->get_all_record_by_condition('contact_relation', array('contact_child_id'=>$uri));
			
			if($uri=='1')
			{
				$parent_id = '1';
			}

			else
			{
				$parent_id = $uri;
			}
			
			$data['all_contacts'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('contact_detail_master_id' => $parent_id,'delete_status'=>1));
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/contact/upper1',$data);	
			$this->load->view('admin/footer');

	}//ends function

	/********function for lower_level******/

	public function lower()
	{
			$uri = $this->uri->segment('4');
			$childs= $this->Base_model->get_all_record_by_condition('contact_relation', array('contact_parent_id'=>$uri));
			
			$all_lower = array();
			foreach ($childs as $child) 
			{
				$all_lower[] =  $this->Base_model->get_record_by_id('contact_detail_master', array('contact_detail_master_id' => $child->contact_child_id,'delete_status'=>1));
			}
			
			$data['all_contacts'] = $all_lower;
		
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/contact/lower1',$data);	
			$this->load->view('admin/footer');
	}//ends function


	/*******function to gettting all city********/

	public function all_city()
	{
		
		$city_id = strip_tags($this->input->post('id'));
		$all_cities =  $this->Base_model->get_all_record_by_condition('district_master', array('State_Code'=>$city_id));
		$all_city =  json_encode($all_cities);
		echo  $all_city;

	}// ends function

	/******************function for search contact************/

	public function search_contact()
	{
			$contact_name = xss_clean(strip_tags($this->input->post('contact_name')));
			$wing_name = xss_clean(strip_tags($this->input->post('wing_name')));
			$organisation_name = xss_clean(strip_tags($this->input->post('organisation_name')));
			$post_name = xss_clean(strip_tags($this->input->post('post_name')));
			$designation_name = xss_clean(strip_tags($this->input->post('designation_name')));


			if(empty($contact_name)&&empty($wing_name)&&empty($organisation_name)&&empty($post_name)&&empty($designation_name))
			{		
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
					$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
					$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
					$data['all_contact'] = $this->Base_model->get_all_record_by_condition('contact_detail_master', array('delete_status'=>1));
					$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
					$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
					$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
					$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar_contact');
					$this->load->view('admin/contact_management/contact/contactlist',$data);	
					$this->load->view('admin/footer');
			}

			else
			{ 
				 	$data['all_designation'] = $this->Base_model->get_all_record_by_condition('contact_designation', array('delete_status'=>1));
					$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
					$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
					$data['all_contact'] = $this->Contact_model->searching_contact($contact_name,$wing_name,$organisation_name,$post_name,$designation_name);
					$data['all_hierarchy'] = $this->Base_model->get_all_record_by_condition('contact_parent_master',NULL);
					$data['all_contact_user'] = $this->Base_model->get_all_record_by_condition('contact_detail_master',NULL);
					$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
					$data['states'] = $this->Base_model->get_all_record_by_condition('state_master',NULL);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar_contact');
					$this->load->view('admin/contact_management/contact/contactlist',$data);	
					$this->load->view('admin/footer');
			}
	}//ends function



	

	
}//class ends


