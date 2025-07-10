<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Office extends CI_Controller {

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
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		
		$data['all_office'] = $this->Base_model->get_all_record_by_condition('employee_office', array('delete_status'=>'0'));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/admin_management/masterdata/officelist',$data);	
		$this->load->view('admin/footer');

	}//ends function

	/***************function for add designation***************/

	public function add_office()
	{	
		if(isset($_REQUEST['submit'])) 
		{
			
			$office_name  	  	 = xss_clean(strip_tags($this->input->post('office_name')));
			$office_description  = xss_clean(strip_tags($this->input->post('office_description')));

			$ip_address		     = $_SERVER['REMOTE_ADDR'];
			$session_id 	     = $this->session->userdata('user_id');

			date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s");
			
			$this->form_validation->set_rules('office_name','Office name','trim|required');
			$this->form_validation->set_rules('office_description','designation short name','trim|required');
		

				if($this->form_validation->run() === false) 
				{
						
						$data['insertData'] = array(
							'office_name'          => xss_clean($this->input->post('office_name')),
							'office_description'   => xss_clean($this->input->post('office_description'))
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/masterdata/addoffice',$data);
						$this->load->view('admin/footer');

				}//ends if

				else
				{
					
					/*****check designation name********/

				  $checked = $this->Base_model->check_existent('employee_office', array('office_name'=> $office_name,'delete_status'=>0));

					/*****ends check designation name*****/

						if($checked=='1')
						{
								$msg = "Office name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_office', $msg);

								/*********logs code*******/

								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add office, office already exits '.$office_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

								$data['insertData'] = array(
									'office_name' => xss_clean($this->input->post('office_name')),
									'office_description' => xss_clean($this->input->post('office_description'))
								);

								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/addoffice',$data);
								$this->load->view('admin/footer');

						}//ends if

						else
						{
							
							$insert_data = array(
												'office_name' 				    => $office_name,
												'office_description' 	        => $office_description,
												'client_ip' 					=> $ip_address,
												'delete_status' 			    => '0',
												'created_date' 					=> $created_date,
												'updated_date' 					=> $created_date
											);

							 $insertid = $this->Base_model->insert_one_row('employee_office', $insert_data);

							 if($insertid)
								{
									$msg = "Office added successfully.";
									$this->session->set_flashdata('office_add_flashSuccess',$msg);

									/*********logs code*******/

										$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add office, office already exits '.$office_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
											);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

								 redirect('Administrator/Office',$data);

									
							}

								else
								{
									$msg = "Failed to add office.";
									$this->session->set_flashdata('office_add_flashError',$msg);

									/*********logs code*******/

										$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add office, office already exits '.$office_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
											);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

								   $data['insertData'] = array(
										'office_name' => xss_clean($this->input->post('office_name')),
										'office_description' => xss_clean($this->input->post('office_description'))
									);
									
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/addoffice',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{	
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/masterdata/addoffice');
			$this->load->view('admin/footer');	
		}//ends else

	}//end function

/**********************function for update designation***************/

	public function edit_office()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			
			$office_name  	  	 = xss_clean(strip_tags($this->input->post('office_name')));
			$office_description  = xss_clean(strip_tags($this->input->post('office_description')));

			$ip_address		     = $_SERVER['REMOTE_ADDR'];
			$session_id 	     = $this->session->userdata('user_id');

			date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s");

			$this->form_validation->set_rules('office_name','Office name','trim|required');
			$this->form_validation->set_rules('office_description','designation short name','trim|required');

			$uri = $this->uri->segment('4');
			$data['office_data'] = $building_data = $this->Base_model->get_record_by_id('employee_office', array('office_id' => $uri));
		

				if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
									'office_name' => xss_clean($this->input->post('office_name')),
									'office_description' => xss_clean($this->input->post('office_description'))
								);
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/editoffice',$data);
					$this->load->view('admin/footer');
					
					
				}//ends if

				else
				{
					

				   $checked = $this->Admin_model->check_existent_office($office_name, $uri);

					/*****ends check designation name*****/

						if($checked=='1')
						{
							
								$msg = "Designation name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_designation', $msg);

								/*********logs code*******/

										$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add office, office already exits '.$office_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
											);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

							   $data['insertData'] = array(
									'office_name' => xss_clean($this->input->post('office_name')),
									'office_description' => xss_clean($this->input->post('office_description'))
								);
							
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/editoffice',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$uri = $this->uri->segment('4');
								$update_data = array(
													'office_name' 			=> $office_name,
													'office_description' 	=> $office_description,
													'client_ip' 			=> $ip_address,
													'updated_date' 		    => $created_date
												);
							 $updateid = $this->Base_model->update_record_by_id('employee_office', $update_data, array('office_id'=> $uri));

							 if($updateid)
								{
									$msg = "Designation updated successfully.";
									$this->session->set_flashdata('office_add_flashSuccess',$msg);

									/*********logs code*******/

										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' updated office '.$office_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

                                   redirect('Administrator/Office',$data);
									
								}

								else
								{
									$msg = "Failed to update designation.";
									$this->session->set_flashdata('flashError_office',$msg);

									/*********logs code*******/

									
										$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update office '.$office_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
											);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['insertData'] = array(
										'office_name' => xss_clean($this->input->post('office_name')),
										'office_description' => xss_clean($this->input->post('office_description'))
								     );

									
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/editoffice',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{

					$uri = $this->uri->segment('4');
					$data['office_data'] = $building_data = $this->Base_model->get_record_by_id('employee_office', array('office_id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/editoffice',$data);
					$this->load->view('admin/footer');
		}//ends else

	}//end function

	/********function for Delete Designation******/

	public function delete_office()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean($this->input->post('delete_itemId'));

				$checked = $this->Base_model->check_existent('employee_office', array('office_id' 	=>$delete_itemId,'delete_status'=>'1'));

				if($checked=='1')
				{

					$msg = "Office already deleted.";
					$this->session->set_flashdata('office_add_flashError', $msg);
					
					$data['all_office'] = $this->Base_model->get_all_record_by_condition('employee_office', array('delete_status'=>'0'));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/officelist',$data);	
					$this->load->view('admin/footer');

				}//ends if

			else
			{
				$update_data = array(
									'delete_status' => '1',
									'updated_date' 	=> $created_date
								);
				$updateid = $this->Base_model->update_record_by_id('employee_office', $update_data, array('office_id'=> $delete_itemId));
				$msg = "Office deleted successfully.";

				$this->session->set_flashdata('office_delete_flashSuccess',$msg);
				
				$data['all_office'] = $this->Base_model->get_all_record_by_condition('employee_office', array('delete_status'=>'0'));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/admin_management/masterdata/officelist',$data);	
				$this->load->view('admin/footer');
			}
				
	}//ends function

	/*******function for designation search******/

	public function search_office()
	{
		
		$office_name  	= xss_clean(strip_tags($this->input->post('office_name')));
		$status  			= xss_clean(strip_tags($this->input->post('status')));

		  if(empty($office_name) && empty($status))
				{	

					$data['all_office'] = $this->Base_model->get_all_record_by_condition('employee_office', array('delete_status'=>'0'));
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/officelist',$data);	
					$this->load->view('admin/footer');
				}//ends if

				else
				{	
					$data['all_office'] = $this->Admin_model->search_office($office_name,$status);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/officelist',$data);	
					$this->load->view('admin/footer');

				}//ends else
	}// function ends


	
}//class ends


