<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Designation extends CI_Controller {

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
		$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));
		$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>'1'));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/admin_management/masterdata/designationlist',$data);	
		$this->load->view('admin/footer');

	}//ends function

	/***************function for add designation***************/

	public function add_designation()
	{	
		if(isset($_REQUEST['submit'])) 
		{
			
			$designation_name  	  	 = xss_clean(strip_tags($this->input->post('designation_name')));
			$designation_short_name  = xss_clean(strip_tags($this->input->post('designation_short_name')));
			//$rank  					 = xss_clean(strip_tags($this->input->post('rank')));
			$ser_no  				 = xss_clean(strip_tags($this->input->post('ser_no')));

			$this->form_validation->set_rules('designation_name','designation name','trim|required');
			$this->form_validation->set_rules('designation_short_name','designation short name','trim|required');
		//	$this->form_validation->set_rules('rank','rank','trim|required');
			//$this->form_validation->set_rules('sub_rank','sub rank','trim|required');

				if($this->form_validation->run() === false) 
				{
						
						$data['insertData'] = array(
							'designation_name' => xss_clean($this->input->post('designation_name')),
							'designation_short_name' => xss_clean($this->input->post('designation_short_name')),
							'ser_no' => xss_clean($this->input->post('ser_no'))
						);
						//$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/masterdata/adddesignation',$data);
						$this->load->view('admin/footer');
				}//ends if

				else
				{
					$designation_name  	  	 = xss_clean(strip_tags($this->input->post('designation_name')));
					$designation_short_name  = xss_clean(strip_tags($this->input->post('designation_short_name')));
				//	$rank  					 = xss_clean(strip_tags($this->input->post('rank')));
					$ser_no  				 = xss_clean(strip_tags($this->input->post('ser_no')));
					$ip_address				 = $_SERVER['REMOTE_ADDR'];
					$session_id 			 = $this->session->userdata('user_id');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					
					/*****check designation name********/

						$checked = $this->Base_model->check_existent('designation', array('designation_name'=> $designation_name,'status'=>1,'delete_status'=>1));

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
														'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add designation, designation already exits '.$designation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

								$data['insertData'] = array(
									'designation_name' => xss_clean($this->input->post('designation_name')),
									'designation_short_name' => xss_clean($this->input->post('designation_short_name')),
									'ser_no' => xss_clean($this->input->post('ser_no'))
								);
								//$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/adddesignation',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
							
								$insert_data = array(
													'designation_name' 				=> $designation_name,
													'designation_short_name' 	    => $designation_short_name,
													'deg_ser_no' 					=> $ser_no,
													'client_ip' 					=> $ip_address,
													'modified_by' 					=> $session_id,
													'created_date' 					=> $created_date,
													'updated_date' 					=> $created_date
												);

							 $insertid = $this->Base_model->insert_one_row('designation', $insert_data);

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
														'ACTIVITY' 		=> $this->session->userdata('user_name').' added designation successfully '.$designation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

									redirect('Administrator/Designation');
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
														'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add designation '.$designation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>'1'));
									//$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/designationlist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>'1'));
			//$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/masterdata/adddesignation',$data);
			$this->load->view('admin/footer');	
		}//ends else

	}//end function

/**********************function for update designation***************/

	public function edit_designation()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			
			$designation_name  	  	 = xss_clean(strip_tags($this->input->post('designation_name')));
			$designation_short_name  = xss_clean(strip_tags($this->input->post('designation_short_name')));
			$ser_no  					 = xss_clean(strip_tags($this->input->post('ser_no')));
			//$sub_rank  				 = xss_clean(strip_tags($this->input->post('sub_rank')));

			$this->form_validation->set_rules('designation_name','designation name','trim|required');
			$this->form_validation->set_rules('designation_short_name','designation short name','trim|required');
			//$this->form_validation->set_rules('rank','rank','trim|required');
			//$this->form_validation->set_rules('sub_rank','sub rank','trim|required');

				if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
							'designation_name' => xss_clean($this->input->post('designation_name')),
							'designation_short_name' => xss_clean($this->input->post('designation_short_name')),
							'ser_no' => xss_clean($this->input->post('ser_no'))
						);

					//$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));

					$uri = $this->uri->segment('4');
					$data['designation_data'] = $this->Base_model->get_record_by_id('designation', array('designation_id' => $uri));

					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/editdesignation',$data);
					$this->load->view('admin/footer');
					
					
				}//ends if

				else
				{
					$designation_name  	  	= xss_clean(strip_tags($this->input->post('designation_name')));
					$designation_short_name = xss_clean(strip_tags($this->input->post('designation_short_name')));
					$ser_no  					= xss_clean(strip_tags($this->input->post('ser_no')));
					$status  				= xss_clean(strip_tags($this->input->post('status')));
					$ip_address				= $_SERVER['REMOTE_ADDR'];
					$session_id 			= $this->session->userdata('user_id');
					$uri 					= $this->uri->segment('4');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");

					/*****check designation name********/

						$checked = $this->Admin_model->check_existent_designation($designation_name, $uri);

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
														'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update designation '.$designation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

							
								$data['insertData'] = array(
										'designation_name' => xss_clean(strip_tags($this->input->post('designation_name'))),
										'designation_short_name' => xss_clean(strip_tags($this->input->post('designation_short_name'))),
										'ser_no' => xss_clean(strip_tags($this->input->post('ser_no')))
										//'sub_rank' => xss_clean(strip_tags($this->input->post('sub_rank')))
									);
								//$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));
								$uri = $this->uri->segment('4');
								$data['designation_data'] = $this->Base_model->get_record_by_id('designation', array('designation_id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/editdesignation',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$uri = $this->uri->segment('4');
								$update_data = array(
													'designation_name' 				=> $designation_name,
													'designation_short_name' 	    => $designation_short_name,
													'deg_ser_no' 					=> $ser_no,
													'client_ip' 					=> $ip_address,
													'status'						=>	$status,
													'modified_by' 					=> $session_id,
													'updated_date' 					=> $created_date
												);
							 $updateid = $this->Base_model->update_record_by_id('designation', $update_data, array('designation_id'=> $uri));

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
														'ACTIVITY' 		=> $this->session->userdata('user_name').' updated designation '.$designation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

									redirect('Administrator/Designation');
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
														'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update designation '.$designation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									//$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));
									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>'1'));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/designationlist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{

					$uri = $this->uri->segment('4');
					//$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>'1'));
					$data['designation_data'] = $building_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/editdesignation',$data);
					$this->load->view('admin/footer');
		}//ends else

	}//end function

	/********function for Delete Designation******/

	public function delete_designation()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean($this->input->post('delete_itemId'));
				$data['designation_data'] = $designation_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $delete_itemId));

					/*****check designation name********/

						$checked = $this->Base_model->check_existent('designation', array('designation_id' 	=>$delete_itemId,'delete_status'=>0));

					/*****ends check designation name*****/

						if($checked=='1')
						{
								$msg = "Designation already deleted.";
								$this->session->set_flashdata('designation_add_flashError	', $msg);
								
								$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));
								$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>'1'));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/designationlist',$data);	
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$update_data = array(
													'status'				=> '0',
													'delete_status' => '0',
													'updated_date' 	=> $created_date
												);
								$updateid = $this->Base_model->update_record_by_id('designation', $update_data, array('designation_id'=> $delete_itemId));
								$msg = "Designation deleted successfully.";

								/*********logs code*******/

										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted designation '.$designation_data->designation_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

								$this->session->set_flashdata('designation_delete_flashSuccess',$msg);
								$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));
								$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>'1'));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/designationlist',$data);	
								$this->load->view('admin/footer');
						}
				
	}//ends function

	/*******function for designation search******/

	public function search_designation()
	{
		
		$designation_name  	= xss_clean(strip_tags($this->input->post('designation_name')));
		$status  			= xss_clean(strip_tags($this->input->post('status')));

		if(empty($designation_name) && empty($status))
				{
					
					$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>'1'));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/designationlist',$data);	
					$this->load->view('admin/footer');
				}//ends if

				else
				{
					$data['all_rank'] = $this->Base_model->get_all_record_by_condition('rank', array('status'=>'1'));
					$data['all_designation'] = $this->Admin_model->search_designation($designation_name,$status);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/designationlist',$data);	
					$this->load->view('admin/footer');

				}//ends else
	}// function ends


	
}//class ends


