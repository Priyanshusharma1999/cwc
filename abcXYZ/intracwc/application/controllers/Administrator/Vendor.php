<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

	// Initialize Constructor Here
	function __construct()
	{
		parent::__construct();
		$this->load->model('Base_model');
		$this->load->model('Admin_model');
		if(empty($this->session->userdata('user_id')))
	     {
	     	$base_url = base_url().'Frontend';
	        redirect($base_url);
	     } 
		
	   	$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   	$roles  = $this->Base_model->get_all_record_by_condition('roles', NULL);
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("1", $user_roles) || in_array("15", $user_roles) || in_array("16", $user_roles))
			  {
			  	$permission_role = $user_roles;
			  }
				else
			  {
			 		$permission_role = '';
			  }

		   	if(empty($permission_role))
		   	{
		   		$base_url_permission = base_url().'Permission';
		      redirect($base_url_permission);
		   	}
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
			$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('delete_status'=>1));
			$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/vendor/vendorlist',$data);
			$this->load->view('admin/footer');

	}//ends function

	/***************function for add vendor***************/

	public function add_vendor()
	{	
		if(isset($_REQUEST['submit'])) 
		{

				$company_name  	  	 		= xss_clean(strip_tags($this->input->post('company_name')));
				$order_no  							= xss_clean(strip_tags($this->input->post('order_no')));
				$address  							= xss_clean(strip_tags($this->input->post('address')));
				$mobile_no  						= xss_clean(strip_tags($this->input->post('mobile_no')));
				$landline_no  	  	 		= xss_clean(strip_tags($this->input->post('vendorlandline_no')));
				$email  	  	 					= xss_clean(strip_tags($this->input->post('email')));
				$contact_valid_till  	  = xss_clean(strip_tags($this->input->post('contact_valid_till')));
				$complaint_type 				= xss_clean(strip_tags($this->input->post('complaint_type')));
				$estimated_time  	  		= xss_clean(strip_tags($this->input->post('estimated_time')));
				$service_type  	  			= xss_clean(strip_tags($this->input->post('service_type')));

			
				$this->form_validation->set_rules('company_name','company name','trim|required');
				$this->form_validation->set_rules('order_no','order no','trim|required');
				$this->form_validation->set_rules('address','address','trim|required');
				$this->form_validation->set_rules('mobile_no','mobile no','trim|required');
				$this->form_validation->set_rules('email','email','trim|required');
				$this->form_validation->set_rules('vendorlandline_no','landline no.','trim|required');
				$this->form_validation->set_rules('contact_valid_till','contact valid till','trim|required');
				$this->form_validation->set_rules('complaint_type','complaint type','trim|required');
				$this->form_validation->set_rules('estimated_time','estimated time','trim|required');
				
			

				if($this->form_validation->run() === false) 
				{
						
						$data['insertData'] = array(
							'company_name' => xss_clean(strip_tags($this->input->post('company_name'))),
							'order_no' => xss_clean(strip_tags($this->input->post('order_no'))),
							'address' => xss_clean(strip_tags($this->input->post('address'))),
							'mobile_no' => xss_clean(strip_tags($this->input->post('mobile_no'))),
							'email' => xss_clean(strip_tags($this->input->post('email'))),
							'vendorlandline_no' => xss_clean(strip_tags($this->input->post('vendorlandline_no'))),
							'contact_valid_till' => xss_clean(strip_tags($this->input->post('contact_valid_till'))),
							'complaint_type' => xss_clean(strip_tags($this->input->post('complaint_type'))),
							'estimated_time' => xss_clean(strip_tags($this->input->post('estimated_time'))),
						);

							$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/admin_management/vendor/addvendor',$data);
							$this->load->view('admin/footer');	
				}//ends if

				else
				{
							$company_name  	  	 		= xss_clean(strip_tags($this->input->post('company_name')));
							$order_no  							= xss_clean(strip_tags($this->input->post('order_no')));
							$address  							= xss_clean(strip_tags($this->input->post('address')));
							$mobile_no  						= xss_clean(strip_tags($this->input->post('mobile_no')));
							$landline_no  	  	 		= xss_clean(strip_tags($this->input->post('vendorlandline_no')));
							$email  	  	 					= xss_clean(strip_tags($this->input->post('email')));
							$contact_valid_till  	  = xss_clean(strip_tags($this->input->post('contact_valid_till')));
							$complaint_type 				= xss_clean(strip_tags($this->input->post('complaint_type')));
							$estimated_time  	  		= xss_clean(strip_tags($this->input->post('estimated_time')));
							$service_type  	  		= xss_clean(strip_tags($this->input->post('service_type')));
							$ip_address							= $_SERVER['REMOTE_ADDR'];
							$session_id 						= $this->session->userdata('user_id');
							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							
							/*****check condition********/

								$checked = $this->Base_model->check_existent('vendor', array('company_name'=> $company_name,'order_no'=>$order_no ,'delete_status'=>1));

								$checked_order = $this->Base_model->check_existent('vendor', array('order_no'=>$order_no ,'delete_status'=>1));


							/*****ends check condition*****/

								if($checked=='1')
								{
										$msg = "Vendor already exits with same order no., Please enter new one";
										$this->session->set_flashdata('flashError_vendor', $msg);

										/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add vendor,vendot already exits : '.$company_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

										$data['insertData'] = array(
										'company_name' => xss_clean(strip_tags($this->input->post('company_name'))),
										'order_no' => xss_clean(strip_tags($this->input->post('order_no'))),
										'address' => xss_clean(strip_tags($this->input->post('address'))),
										'mobile_no' => xss_clean(strip_tags($this->input->post('mobile_no'))),
										'email' => xss_clean(strip_tags($this->input->post('email'))),
										'vendorlandline_no' => xss_clean(strip_tags($this->input->post('vendorlandline_no'))),
										'contact_valid_till' => xss_clean(strip_tags($this->input->post('contact_valid_till'))),
										'complaint_type' => xss_clean(strip_tags($this->input->post('complaint_type'))),
										'estimated_time' => xss_clean(strip_tags($this->input->post('estimated_time'))),
									);

										$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
										$this->load->view('admin/header');
										$this->load->view('admin/sidebar');
										$this->load->view('admin/admin_management/vendor/addvendor',$data);
										$this->load->view('admin/footer');		
								}//ends if

								else if($checked_order=='1')
								{
										$msg = "Order no. exits, Please enter new one";
										$this->session->set_flashdata('flashError_vendor', $msg);

										/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add vendor, order no. already exits : '.$company_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

										$data['insertData'] = array(
										'company_name' => xss_clean(strip_tags($this->input->post('company_name'))),
										'order_no' => xss_clean(strip_tags($this->input->post('order_no'))),
										'address' => xss_clean(strip_tags($this->input->post('address'))),
										'mobile_no' => xss_clean(strip_tags($this->input->post('mobile_no'))),
										'email' => xss_clean(strip_tags($this->input->post('email'))),
										'vendorlandline_no' => xss_clean(strip_tags($this->input->post('vendorlandline_no'))),
										'contact_valid_till' => xss_clean(strip_tags($this->input->post('contact_valid_till'))),
										'complaint_type' => xss_clean(strip_tags($this->input->post('complaint_type'))),
										'estimated_time' => xss_clean(strip_tags($this->input->post('estimated_time'))),
									);

										$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
										$this->load->view('admin/header');
										$this->load->view('admin/sidebar');
										$this->load->view('admin/admin_management/vendor/addvendor',$data);
										$this->load->view('admin/footer');	
								}//ends if

								else
								{
									$company_name  	  	 		= xss_clean(strip_tags($this->input->post('company_name')));
									$order_no  							= xss_clean(strip_tags($this->input->post('order_no')));
									$address  							= xss_clean(strip_tags($this->input->post('address')));
									$mobile_no  						= xss_clean(strip_tags($this->input->post('mobile_no')));
									$landline_no  	  	 		= xss_clean(strip_tags($this->input->post('vendorlandline_no')));
									$email  	  	 					= xss_clean(strip_tags($this->input->post('email')));
									$contact_valid_till  	  = xss_clean(strip_tags($this->input->post('contact_valid_till')));
									$complaint_type 				= xss_clean(strip_tags($this->input->post('complaint_type')));
									$estimated_time  	  		= xss_clean(strip_tags($this->input->post('estimated_time')));
									$service_type  	  		= xss_clean(strip_tags($this->input->post('service_type')));
									$ip_address							= $_SERVER['REMOTE_ADDR'];
									$session_id 						= $this->session->userdata('user_id');
									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");

										$insert_data = array(
															'company_name' 					=> $company_name,
															'order_no' 							=> $order_no,
															'address' 							=> $address,
															'mobile_no' 						=> $mobile_no,
															'landline_no' 					=> $landline_no,
															'email' 								=> $email,
															'contract_valid_till' 	=> $contact_valid_till,
															'service_type'					=> $service_type,
															'client_ip' 						=> $ip_address,
															'modified_by' 					=> $session_id,
															'created_date' 					=> $created_date,
															'updated_date' 					=> $created_date
														);
									 $insert_vendor_id = $this->Base_model->insert_one_row('vendor', $insert_data);

									 /***************save vendor service****************/

										   $vendor_service_id = $this->Base_model->insert_one_row('vendor_service', 
										      array(
										      		'vendor_id'					=>  $insert_vendor_id,
											        'complaint_type_id' =>  $complaint_type,
											        'estimated_time' 		=>  $estimated_time,
															'modified_by' 			=> $session_id,
															'client_ip' 	  		=> $_SERVER['REMOTE_ADDR'],
															'created_date' 			=> $created_date,
															'updated_date'  		=> $created_date
												) );	
												
									 /*************ends save vendor service****************/

									 if($insert_vendor_id)
										{
											$msg = "Vendor added successfully.";
											$this->session->set_flashdata('vendor_add_flashSuccess',$msg);

											/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' vender added successfully : '.$company_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

											$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('delete_status'=>1));
											$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
											$this->load->view('admin/header');
											$this->load->view('admin/sidebar');
											$this->load->view('admin/admin_management/vendor/vendorlist',$data);
											$this->load->view('admin/footer');
										}

										else
										{
											$msg = "Failed to add vendor.";
											$this->session->set_flashdata('vendor_add_flashError',$msg);

											/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add vender: '.$company_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

										/*********ends logs code*******/

											$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('delete_status'=>1));
											$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
											$this->load->view('admin/header');
											$this->load->view('admin/sidebar');
											$this->load->view('admin/admin_management/vendor/vendorlist',$data);
											$this->load->view('admin/footer');
										}

								}//ends else
						}//ends main else
			
			
		}//ends if

		else
		{
			
			$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/vendor/addvendor',$data);
			$this->load->view('admin/footer');	
		}//ends else

	}//end function

/**********************function for update vendor***************/

	public function edit_vendor()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			
				$company_name  	  	 		= xss_clean(strip_tags($this->input->post('company_name')));
				$order_no  							= xss_clean(strip_tags($this->input->post('order_no')));
				$address  							= xss_clean(strip_tags($this->input->post('address')));
				$mobile_no  						= xss_clean(strip_tags($this->input->post('mobile_no')));
				$landline_no  	  	 		= xss_clean(strip_tags($this->input->post('vendorlandline_no')));
				$email  	  	 					= xss_clean(strip_tags($this->input->post('email')));
				$contact_valid_till  	  = xss_clean(strip_tags($this->input->post('contact_valid_till')));
				$complaint_type 				= xss_clean(strip_tags($this->input->post('complaint_type')));
				$estimated_time  	  		= xss_clean(strip_tags($this->input->post('estimated_time')));
				$service_type  	  		= xss_clean(strip_tags($this->input->post('service_type')));

			
				$this->form_validation->set_rules('company_name','company name','trim|required');
				$this->form_validation->set_rules('order_no','order no','trim|required');
				$this->form_validation->set_rules('address','address','trim|required');
				$this->form_validation->set_rules('mobile_no','mobile no','trim|required');
				$this->form_validation->set_rules('email','email','trim|required');
				$this->form_validation->set_rules('vendorlandline_no','landline no.','trim|required');
				$this->form_validation->set_rules('contact_valid_till','contact valid till','trim|required');
				$this->form_validation->set_rules('complaint_type','complaint type','trim|required');
				$this->form_validation->set_rules('estimated_time','estimated time','trim|required');

				if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
							'company_name' => xss_clean(strip_tags($this->input->post('company_name'))),
							'order_no' => xss_clean(strip_tags($this->input->post('order_no'))),
							'address' => xss_clean(strip_tags($this->input->post('address'))),
							'mobile_no' => xss_clean(strip_tags($this->input->post('mobile_no'))),
							'email' => xss_clean(strip_tags($this->input->post('email'))),
							'vendorlandline_no' => xss_clean(strip_tags($this->input->post('vendorlandline_no'))),
							'contact_valid_till' => xss_clean(strip_tags($this->input->post('contact_valid_till'))),
							'complaint_type' => xss_clean(strip_tags($this->input->post('complaint_type'))),
							'estimated_time' => xss_clean(strip_tags($this->input->post('estimated_time'))),
						);

						$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
						$uri = $this->uri->segment('4');
						$data['vendor_data'] = $this->Base_model->get_record_by_id('vendor', array('vendor_id' => $uri));
						$data['vendor_service_data'] = $this->Base_model->get_record_by_id('vendor_service', array('vendor_id' => $uri));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/vendor/editvendor',$data);
						$this->load->view('admin/footer');
					
					
				}//ends if

				else
				{
						$company_name  	  	 		= xss_clean(strip_tags($this->input->post('company_name')));
						$order_no  							= xss_clean(strip_tags($this->input->post('order_no')));
						$address  							= xss_clean(strip_tags($this->input->post('address')));
						$mobile_no  						= xss_clean(strip_tags($this->input->post('mobile_no')));
						$landline_no  	  	 		= xss_clean(strip_tags($this->input->post('vendorlandline_no')));
						$email  	  	 					= xss_clean(strip_tags($this->input->post('email')));
						$contact_valid_till  	  = xss_clean(strip_tags($this->input->post('contact_valid_till')));
						$complaint_type 				= xss_clean(strip_tags($this->input->post('complaint_type')));
						$estimated_time  	  		= xss_clean(strip_tags($this->input->post('estimated_time')));
						$service_type  	  		= xss_clean(strip_tags($this->input->post('service_type')));
						$status  								= xss_clean(strip_tags($this->input->post('status')));
						$ip_address							= $_SERVER['REMOTE_ADDR'];
						$session_id 						= $this->session->userdata('user_id');
						$uri 										= $this->uri->segment('4');
						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");

				
					/*****check condition name********/

						$checked_oder = $this->Admin_model->check_existent_vendor_order($order_no,$uri);

						$checked = $this->Admin_model->check_existent_vendor_companyorder($order_no,$company_name,$uri);


					/*****ends check condition name*****/
						if($checked=='1')
						{
								$msg = "Company already exits, Please enter new one";
								$this->session->set_flashdata('flashError_vendor', $msg);

								/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update vender : '.$company_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

								$data['insertData'] = array(
									'company_name' => xss_clean(strip_tags($this->input->post('company_name'))),
									'order_no' => xss_clean(strip_tags($this->input->post('order_no'))),
									'address' => xss_clean(strip_tags($this->input->post('address'))),
									'mobile_no' => xss_clean(strip_tags($this->input->post('mobile_no'))),
									'email' => xss_clean(strip_tags($this->input->post('email'))),
									'vendorlandline_no' => xss_clean(strip_tags($this->input->post('vendorlandline_no'))),
									'contact_valid_till' => xss_clean(strip_tags($this->input->post('contact_valid_till'))),
									'complaint_type' => xss_clean(strip_tags($this->input->post('complaint_type'))),
									'estimated_time' => xss_clean(strip_tags($this->input->post('estimated_time'))),
								);

								$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
								$uri = $this->uri->segment('4');
								$data['vendor_data'] = $this->Base_model->get_record_by_id('vendor', array('vendor_id' => $uri));
								$data['vendor_service_data'] = $this->Base_model->get_record_by_id('vendor_service', array('vendor_id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/vendor/editvendor',$data);
								$this->load->view('admin/footer');
						}//ends if

							else if($checked_oder=='1')
							{
								$msg = "Order no. already exits, Please enter new one";
								$this->session->set_flashdata('flashError_vendor', $msg);

									/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update vender, order no. already exits : '.$company_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['insertData'] = array(
										'company_name' => xss_clean(strip_tags($this->input->post('company_name'))),
										'order_no' => xss_clean(strip_tags($this->input->post('order_no'))),
										'address' => xss_clean(strip_tags($this->input->post('address'))),
										'mobile_no' => xss_clean(strip_tags($this->input->post('mobile_no'))),
										'email' => xss_clean(strip_tags($this->input->post('email'))),
										'vendorlandline_no' => xss_clean(strip_tags($this->input->post('vendorlandline_no'))),
										'contact_valid_till' => xss_clean(strip_tags($this->input->post('contact_valid_till'))),
										'complaint_type' => xss_clean(strip_tags($this->input->post('complaint_type'))),
										'estimated_time' => xss_clean(strip_tags($this->input->post('estimated_time'))),
									);

									$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
									$uri = $this->uri->segment('4');
									$data['vendor_data'] = $this->Base_model->get_record_by_id('vendor', array('vendor_id' => $uri));
									$data['vendor_service_data'] = $this->Base_model->get_record_by_id('vendor_service', array('vendor_id' => $uri));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/vendor/editvendor',$data);
									$this->load->view('admin/footer');
						}//ends if

						

						else
						{
								$uri = $this->uri->segment('4');
								$update_data = array(
															'company_name' 					=> $company_name,
															'order_no' 							=> $order_no,
															'address' 							=> $address,
															'mobile_no' 						=> $mobile_no,
															'landline_no' 					=> $landline_no,
															'email' 								=> $email,
															'contract_valid_till' 	=> $contact_valid_till,
															'service_type'					=> $service_type,
															'client_ip' 						=> $ip_address,
															'status'								=>	$status,
															'modified_by' 					=> $session_id,
															'updated_date' 					=> $created_date
												);
							 $updateid = $this->Base_model->update_record_by_id('vendor', $update_data, array('vendor_id'=> $uri));

							 /*********vendor service data***********/
							 	$update_data2 = array(
															'vendor_id'					=>  $uri,
											        'complaint_type_id' =>  $complaint_type,
											        'estimated_time' 		=>  $estimated_time,
															'modified_by' 			=> $session_id,
															'client_ip' 	  		=> $_SERVER['REMOTE_ADDR'],
															'created_date' 			=> $created_date,
															'updated_date'  		=> $created_date
												);
							 $updateid_service = $this->Base_model->update_record_by_id('vendor_service', $update_data2, array('vendor_id'=> $uri));

							  /*********vendor service data ends***********/

							 if($updateid)
								{
									$msg = "Vendor updated successfully.";
									$this->session->set_flashdata('vendor_add_flashSuccess',$msg);

										/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' updated vender : '.$company_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/vendor/vendorlist',$data);
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to update vendor.";
									$this->session->set_flashdata('vendor_add_flashSuccess',$msg);

										/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update vender : '.$company_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/vendor/vendorlist',$data);
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{
				$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
				$uri = $this->uri->segment('4');
				$data['vendor_data'] = $this->Base_model->get_record_by_id('vendor', array('vendor_id' => $uri));
				$data['vendor_service_data'] = $this->Base_model->get_record_by_id('vendor_service', array('vendor_id' => $uri));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/admin_management/vendor/editvendor',$data);
				$this->load->view('admin/footer');
		}//ends else

	}//end function

	
	/********function for Delete vendor*******/

	public function delete_vendor()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean(strip_tags($this->input->post('delete_itemId')));
				$data['vendor_data'] = $vendor_data = $this->Base_model->get_record_by_id('vendor', array('vendor_id' => $delete_itemId));

					/*****check condition name********/
						$checked = $this->Base_model->check_existent('vendor', array('vendor_id'=>$delete_itemId,'delete_status'=>0));
					/*****ends check condition name*****/

						if($checked=='1')
						{
								$msg = "Vendor already deleted.";
								$this->session->set_flashdata('vendor_add_flashError', $msg);
								
									/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted vender : '.$vendor_data->company_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

								$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('delete_status'=>1));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/vendor/vendorlist',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$update_data = array(
													'status'				=> '0',
													'delete_status' => '0',
													'updated_date' 	=> $created_date
												);
								$updateid = $this->Base_model->update_record_by_id('vendor', $update_data, array('vendor_id'=> $delete_itemId));
								$msg = "Vendor deleted successfully.";
								$this->session->set_flashdata('vendor_delete_flashSuccess',$msg);

								/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted vender : '.$vendor_data->company_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/
									
								$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/vendor/vendorlist',$data);
									$this->load->view('admin/footer');
						}
				
	}//ends function

	/********function for view vendor******/

	public function view_vendor()
	{
			$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
			$uri = $this->uri->segment('4');
			$data['vendor_data'] = $this->Base_model->get_record_by_id('vendor', array('vendor_id' => $uri));
			$data['vendor_service_data'] = $this->Base_model->get_record_by_id('vendor_service', array('vendor_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/vendor/viewvendor',$data);
			$this->load->view('admin/footer');	
	}//ends function

	/*******function for search vendor******/

	public function search_vendor()
	{
		$vendor_name  = xss_clean(strip_tags($this->input->post('vendor_name')));
		$status  			= xss_clean(strip_tags($this->input->post('status')));

		if(empty($vendor_name) && empty($status))
				{
					$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('delete_status'=>1));
					$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/vendor/vendorlist',$data);
					$this->load->view('admin/footer');
				}//ends if

				else
				{
					$data['all_vendor'] = $this->Admin_model->search_vendor($vendor_name,$status);
					$data['all_complaint'] = $this->Base_model->get_all_record_by_condition('compliant_type', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/vendor/vendorlist',$data);
					$this->load->view('admin/footer');
				}//ends else
	}// function ends

	


	
}//class ends


