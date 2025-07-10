<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_employee extends CI_Controller {

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
			$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
			$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/vendor/vendoremployeelist',$data);
			$this->load->view('admin/footer');

	}//ends function

	/***************function for add vendoremployee***************/

	public function add_vendoremployee()
	{	
		if(isset($_REQUEST['submit'])) 
		{
				$emplyee_name  	  	 		= xss_clean(strip_tags($this->input->post('emplyee_name')));
				$vendor_id  						= xss_clean(strip_tags($this->input->post('vendor_id')));
				$employee_designation  	= xss_clean(strip_tags($this->input->post('employee_designation')));
				$emplyee_mobile  				= xss_clean(strip_tags($this->input->post('emplyee_mobile')));
				$employee_landline_no  	= xss_clean(strip_tags($this->input->post('employee_landline_no')));
				$employee_email  	  	 	= xss_clean(strip_tags($this->input->post('employee_email')));
				
				$this->form_validation->set_rules('emplyee_name','emplyee name','trim|required');
				$this->form_validation->set_rules('vendor_id','vendor','trim|required');
				$this->form_validation->set_rules('employee_designation','employee designation','trim|required');
				$this->form_validation->set_rules('emplyee_mobile','emplyee mobile','trim|required');
				$this->form_validation->set_rules('employee_landline_no','employee landline no.','trim|required');
				$this->form_validation->set_rules('employee_email','employee email','trim|required');
			
		
				if($this->form_validation->run() === false) 
				{
						
						$data['insertData'] = array(
							'emplyee_name' => xss_clean(strip_tags($this->input->post('emplyee_name'))),
							'vendor_id' => xss_clean(strip_tags($this->input->post('vendor_id'))),
							'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
							'emplyee_mobile' => xss_clean(strip_tags($this->input->post('emplyee_mobile'))),
							'employee_landline_no' => xss_clean(strip_tags($this->input->post('employee_landline_no'))),
							'employee_email' => xss_clean(strip_tags($this->input->post('employee_email')))
						);

							$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
							$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
							$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/admin_management/vendor/addvendoremployee',$data);
							$this->load->view('admin/footer');	
				}//ends if

				else
				{
							$emplyee_name  	  	 		= xss_clean(strip_tags($this->input->post('emplyee_name')));
							$vendor_id  						= xss_clean(strip_tags($this->input->post('vendor_id')));
							$employee_designation  	= xss_clean(strip_tags($this->input->post('employee_designation')));
							$emplyee_mobile  				= xss_clean(strip_tags($this->input->post('emplyee_mobile')));
							$employee_landline_no  	= xss_clean(strip_tags($this->input->post('employee_landline_no')));
							$employee_email  	  	 	= xss_clean(strip_tags($this->input->post('employee_email')));
							$ip_address							= $_SERVER['REMOTE_ADDR'];
							$session_id 						= $this->session->userdata('user_id');
							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							
							/*****check condition********/

								$checked = $this->Base_model->check_existent('vendor_employee', array('vendor_id'=> $vendor_id,'vendor_employee_email'=>$vendor_employee_email ,'delete_status'=>1));

								$checked_email = $this->Base_model->check_existent('vendor_employee', array('vendor_employee_email'=>$vendor_employee_email ,'delete_status'=>1));

							/*****ends check condition*****/

								if($checked=='1')
								{
										$msg = "Employee already exits with this vendor, Please enter new one";
										$this->session->set_flashdata('flashError_vendoremployee', $msg);

										/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to vender employee '.$emplyee_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/


										$data['insertData'] = array(
										'emplyee_name' => xss_clean(strip_tags($this->input->post('emplyee_name'))),
										'vendor_id' => xss_clean(strip_tags($this->input->post('vendor_id'))),
										'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
										'emplyee_mobile' => xss_clean(strip_tags($this->input->post('emplyee_mobile'))),
										'employee_landline_no' => xss_clean(strip_tags($this->input->post('employee_landline_no'))),
										'employee_email' => xss_clean(strip_tags($this->input->post('employee_email')))
									);
										$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
										$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
										$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
										$this->load->view('admin/header');
										$this->load->view('admin/sidebar');
										$this->load->view('admin/admin_management/vendor/addvendoremployee',$data);
										$this->load->view('admin/footer');			
								}//ends if

								else if($checked_email=='1')
								{
										$msg = "Employee email exits, Please enter new one";
										$this->session->set_flashdata('flashError_vendoremployee', $msg);

										/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to vender employee,email already exits '.$emplyee_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/


										$data['insertData'] = array(
										'emplyee_name' => xss_clean(strip_tags($this->input->post('emplyee_name'))),
										'vendor_id' => xss_clean(strip_tags($this->input->post('vendor_id'))),
										'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
										'emplyee_mobile' => xss_clean(strip_tags($this->input->post('emplyee_mobile'))),
										'employee_landline_no' => xss_clean(strip_tags($this->input->post('employee_landline_no'))),
										'employee_email' => xss_clean(strip_tags($this->input->post('employee_email')))
									);
										$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
										$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
										$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
										$this->load->view('admin/header');
										$this->load->view('admin/sidebar');
										$this->load->view('admin/admin_management/vendor/addvendoremployee',$data);
										$this->load->view('admin/footer');	
								}//ends if

								else
								{
									$emplyee_name  	  	 		= xss_clean(strip_tags($this->input->post('emplyee_name')));
									$vendor_id  						= xss_clean(strip_tags($this->input->post('vendor_id')));
									$employee_designation  	= xss_clean(strip_tags($this->input->post('employee_designation')));
									$emplyee_mobile  				= xss_clean(strip_tags($this->input->post('emplyee_mobile')));
									$employee_landline_no  	= xss_clean(strip_tags($this->input->post('employee_landline_no')));
									$employee_email  	  	 	= xss_clean(strip_tags($this->input->post('employee_email')));
									$ip_address							= $_SERVER['REMOTE_ADDR'];
									$session_id 						= $this->session->userdata('user_id');
									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");

										$insert_data = array(
															'vendor_id' 										=> $vendor_id,
															'vendor_employee_name' 					=> $emplyee_name,
															'vendor_employee_designation' 	=> $employee_designation,
															'vendor_employee_mobile_no' 		=> $emplyee_mobile,
															'vendor_employee_landline_no' 	=> $employee_landline_no,
															'vendor_employee_email' 				=> $employee_email,
															'client_ip' 										=> $ip_address,
															'modified_by' 									=> $session_id,
															'created_date' 									=> $created_date,
															'updated_date' 									=> $created_date
														);
									 $insert_id = $this->Base_model->insert_one_row('vendor_employee', $insert_data);

									 if($insert_id)
										{
											$msg = "Vendor Employee added successfully.";
											$this->session->set_flashdata('vendoremployee_add_flashSuccess',$msg);

											/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' added vender employee : '.$emplyee_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/


											$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
											$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
											$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
											$this->load->view('admin/header');
											$this->load->view('admin/sidebar');
											$this->load->view('admin/admin_management/vendor/vendoremployeelist',$data);
											$this->load->view('admin/footer');
										}

										else
										{
											$msg = "Failed to add vendor employee.";
											$this->session->set_flashdata('vendoremployee_add_flashError',$msg);

											/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add vender employee: '.$emplyee_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/


											$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
											$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
											$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
											$this->load->view('admin/header');
											$this->load->view('admin/sidebar');
											$this->load->view('admin/admin_management/vendor/vendoremployeelist',$data);
											$this->load->view('admin/footer');
										}

								}//ends else
						}//ends main else
			
			
		}//ends if

		else
		{
			
			$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
			$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/vendor/addvendoremployee',$data);
			$this->load->view('admin/footer');	
		}//ends else

	}//end function

/**********************function for update vendoremployee***************/

	public function edit_vendoremployee()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			
				$emplyee_name  	  	 		= xss_clean(strip_tags($this->input->post('emplyee_name')));
				$vendor_id  						= xss_clean(strip_tags($this->input->post('vendor_id')));
				$employee_designation  	= xss_clean(strip_tags($this->input->post('employee_designation')));
				$emplyee_mobile  				= xss_clean(strip_tags($this->input->post('emplyee_mobile')));
				$employee_landline_no  	= xss_clean(strip_tags($this->input->post('employee_landline_no')));
				$employee_email  	  	 	= xss_clean(strip_tags($this->input->post('employee_email')));
				
				$this->form_validation->set_rules('emplyee_name','emplyee name','trim|required');
				$this->form_validation->set_rules('vendor_id','vendor','trim|required');
				$this->form_validation->set_rules('employee_designation','employee designation','trim|required');
				$this->form_validation->set_rules('emplyee_mobile','emplyee mobile','trim|required');
				$this->form_validation->set_rules('employee_landline_no','employee landline no.','trim|required');
				$this->form_validation->set_rules('employee_email','employee email','trim|required');

				if($this->form_validation->run() === false) 
				{	
						$data['insertData'] = array(
								'emplyee_name' => xss_clean(strip_tags($this->input->post('emplyee_name'))),
								'vendor_id' => xss_clean(strip_tags($this->input->post('vendor_id'))),
								'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
								'emplyee_mobile' => xss_clean(strip_tags($this->input->post('emplyee_mobile'))),
								'employee_landline_no' => xss_clean(strip_tags($this->input->post('employee_landline_no'))),
								'employee_email' => xss_clean(strip_tags($this->input->post('employee_email')))
							);

						$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
						$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
						$uri = $this->uri->segment('4');
						$data['vendoremployee_data'] = $this->Base_model->get_record_by_id('vendor_employee', array('vendor_employee_id' => $uri));
					
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/vendor/editvendoremployee',$data);
						$this->load->view('admin/footer');
						
				}//ends if

				else
				{
						$emplyee_name  	  	 		= xss_clean(strip_tags($this->input->post('emplyee_name')));
						$vendor_id  						= xss_clean(strip_tags($this->input->post('vendor_id')));
						$employee_designation  	= xss_clean(strip_tags($this->input->post('employee_designation')));
						$emplyee_mobile  				= xss_clean(strip_tags($this->input->post('emplyee_mobile')));
						$employee_landline_no  	= xss_clean(strip_tags($this->input->post('employee_landline_no')));
						$employee_email  	  	 	= xss_clean(strip_tags($this->input->post('employee_email')));
						$status  								= xss_clean(strip_tags($this->input->post('status')));
						$ip_address							= $_SERVER['REMOTE_ADDR'];
						$session_id 						= $this->session->userdata('user_id');
						$uri 										= $this->uri->segment('4');
						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");

				
					/*****check condition name********/

						$checked = $this->Admin_model->check_existent_vendoremployee($vendor_id,$employee_email,$uri);

						$checked_email = $this->Admin_model->check_existent_vendoremployee_email($employee_email,$uri);


					/*****ends check condition name*****/
						if($checked=='1')
						{
								$msg = "Employee already exits, Please enter new one";
								$this->session->set_flashdata('flashError_vendoremployee', $msg);

								/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update vender employee, already exits: '.$emplyee_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

								$data['insertData'] = array(
									'emplyee_name' => xss_clean(strip_tags($this->input->post('emplyee_name'))),
									'vendor_id' => xss_clean(strip_tags($this->input->post('vendor_id'))),
									'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
									'emplyee_mobile' => xss_clean(strip_tags($this->input->post('emplyee_mobile'))),
									'employee_landline_no' => xss_clean(strip_tags($this->input->post('employee_landline_no'))),
									'employee_email' => xss_clean(strip_tags($this->input->post('employee_email')))
								);

							$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
							$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
							$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
							$uri = $this->uri->segment('4');
							$data['vendoremployee_data'] = $this->Base_model->get_record_by_id('vendor_employee', array('vendor_employee_id' => $uri));
						
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/admin_management/vendor/editvendoremployee',$data);
							$this->load->view('admin/footer');
						}//ends if

							else if($checked_email=='1')
							{
								$msg = "Email already exits, Please enter new one";
								$this->session->set_flashdata('flashError_vendoremployee', $msg);

								/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update vender employee, email already exits: '.$emplyee_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

								$data['insertData'] = array(
										'emplyee_name' => xss_clean(strip_tags($this->input->post('emplyee_name'))),
										'vendor_id' => xss_clean(strip_tags($this->input->post('vendor_id'))),
										'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
										'emplyee_mobile' => xss_clean(strip_tags($this->input->post('emplyee_mobile'))),
										'employee_landline_no' => xss_clean(strip_tags($this->input->post('employee_landline_no'))),
										'employee_email' => xss_clean(strip_tags($this->input->post('employee_email')))
									);

								$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
								$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
								$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
								$uri = $this->uri->segment('4');
								$data['vendoremployee_data'] = $this->Base_model->get_record_by_id('vendor_employee', array('vendor_employee_id' => $uri));
							
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/vendor/editvendoremployee',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
									$emplyee_name  	  	 		= xss_clean(strip_tags($this->input->post('emplyee_name')));
									$vendor_id  						= xss_clean(strip_tags($this->input->post('vendor_id')));
									$employee_designation  	= xss_clean(strip_tags($this->input->post('employee_designation')));
									$emplyee_mobile  				= xss_clean(strip_tags($this->input->post('emplyee_mobile')));
									$employee_landline_no  	= xss_clean(strip_tags($this->input->post('employee_landline_no')));
									$employee_email  	  	 	= xss_clean(strip_tags($this->input->post('employee_email')));
									$ip_address							= $_SERVER['REMOTE_ADDR'];
									$session_id 						= $this->session->userdata('user_id');
									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$uri = $this->uri->segment('4');
									$update_data = array(
															'vendor_id' 										=> $vendor_id,
															'vendor_employee_name' 					=> $emplyee_name,
															'vendor_employee_designation' 	=> $employee_designation,
															'vendor_employee_mobile_no' 		=> $emplyee_mobile,
															'vendor_employee_landline_no' 	=> $employee_landline_no,
															'vendor_employee_email' 				=> $employee_email,
															'client_ip' 										=> $ip_address,
															'status'												=>	$status,
															'modified_by' 									=> $session_id,
															'updated_date' 									=> $created_date
												);
							 $updateid = $this->Base_model->update_record_by_id('vendor_employee', $update_data, array('vendor_employee_id'=> $uri));


							 if($updateid)
								{
									$msg = "Vendor Employee updated successfully.";
									$this->session->set_flashdata('vendoremployee_add_flashSuccess',$msg);

									/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' updated vender employee, already exits: '.$emplyee_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
									$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/vendor/vendoremployeelist',$data);
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to update vendor employee.";
									$this->session->set_flashdata('vendoremployee_add_flashSuccess',$msg);

									/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update vender employee : '.$emplyee_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
									$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/vendor/vendoremployeelist',$data);
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{
				$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
				$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
				$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
				$uri = $this->uri->segment('4');
				$data['vendoremployee_data'] = $this->Base_model->get_record_by_id('vendor_employee', array('vendor_employee_id' => $uri));
			
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/admin_management/vendor/editvendoremployee',$data);
				$this->load->view('admin/footer');
		}//ends else

	}//end function

	
	/********function for Delete vendor*******/

	public function delete_vendoremployee()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean(strip_tags($this->input->post('delete_itemId')));
				$data['vendor_data'] = $vendor_data = $this->Base_model->get_record_by_id('vendor_employee', array('vendor_employee_id' => $delete_itemId));

					/*****check condition name********/
						$checked = $this->Base_model->check_existent('vendor_employee', array('vendor_employee_id'=>$delete_itemId,'delete_status'=>0));
					/*****ends check condition name*****/

						if($checked=='1')
						{
								$msg = "Vendor Employee already deleted.";
								$this->session->set_flashdata('vendoremployee_add_flashError', $msg);
								
								/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted vender employee : '.$vendor_data->vendor_employee_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

								$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
								$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
								$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/vendor/vendoremployeelist',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$update_data = array(
													'status'				=> '0',
													'delete_status' => '0',
													'updated_date' 	=> $created_date
												);
								$updateid = $this->Base_model->update_record_by_id('vendor_employee', $update_data, array('vendor_employee_id'=> $delete_itemId));
								$msg = "Vendor Employee deleted successfully.";

								/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted vender employee : '.$vendor_data->vendor_employee_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/
								$this->session->set_flashdata('vendoremployee_delete_flashSuccess',$msg);
								$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
								$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
								$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/vendor/vendoremployeelist',$data);
								$this->load->view('admin/footer');
						}
				
	}//ends function

	/********function for view vendoremployee******/

	public function view_vendoremployee()
	{
			$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
				$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
				$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
				$uri = $this->uri->segment('4');
				$data['vendoremployee_data'] = $this->Base_model->get_record_by_id('vendor_employee', array('vendor_employee_id' => $uri));
			
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/admin_management/vendor/viewvendoremployee',$data);
				$this->load->view('admin/footer');	
	}//ends function

	/*******function for search vendoremployee******/

	public function search_vendoremployee()
	{

		$employee_name  = xss_clean(strip_tags($this->input->post('employee_name')));
		$status  			= xss_clean(strip_tags($this->input->post('status')));

		if(empty($employee_name) && empty($status))
				{
					$data['all_vendoremployee'] = $this->Base_model->get_all_record_by_condition('vendor_employee', array('delete_status'=>1));
					$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/vendor/vendoremployeelist',$data);
					$this->load->view('admin/footer');
				}//ends if

				else
				{
					$data['all_vendoremployee'] = $this->Admin_model->search_vendoremployee($employee_name,$status);
					$data['all_vendor'] = $this->Base_model->get_all_record_by_condition('vendor', array('status'=>1,'delete_status'=>1));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/vendor/vendoremployeelist',$data);
					$this->load->view('admin/footer');
				}//ends else
	}// function ends

	


	
}//class ends


