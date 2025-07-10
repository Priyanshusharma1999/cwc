<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Masterdata extends CI_Controller {

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
		$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/admin_management/masterdata/buildinglist',$data);	
		$this->load->view('admin/footer');

	}//ends function

	/***************function for add building***************/

	public function add_building()
	{	
		if(isset($_REQUEST['submit'])) 
		{
			$building_name  	  = xss_clean(strip_tags($this->input->post('building_name')));
			$building_short_name  = xss_clean(strip_tags($this->input->post('building_short_name')));

			$this->form_validation->set_rules('building_name','building name','trim|required');
			$this->form_validation->set_rules('building_short_name','building short name','trim|required');

				if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
						'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
						'building_short_name' => xss_clean(strip_tags($this->input->post('building_short_name')))
					);
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/addbuilding',$data);
					$this->load->view('admin/footer');
				}//ends if

				else
				{
					$building_name  	  	= xss_clean(strip_tags($this->input->post('building_name')));
					$building_short_name  = xss_clean(strip_tags($this->input->post('building_short_name')));
					$ip_address						= $_SERVER['REMOTE_ADDR'];
					$session_id 					= $this->session->userdata('user_id');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					
					 

					/*****check building name********/

						$checked = $this->Base_model->check_existent('building', array('building_name' 	=> $building_name,'status'=>1,'delete_status'=>1));

					/*****ends check building name*****/

						if($checked=='1')
						{
								$msg = "Building name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_building', $msg);

								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add building, already exits :'.$building_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

								$data['insertData'] = array(
								'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
								'building_short_name' => xss_clean(strip_tags($this->input->post('building_short_name')))
								);
							
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/addbuilding',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
							
								$insert_data = array(
													'building_name' 				=> $building_name,
													'building_short_name' 	=> $building_short_name,
													'client_ip' 						=> $ip_address,
													'modified_by' 					=> $session_id,
													'created_date' 					=> $created_date,
													'updated_date' 					=> $created_date
												);
							 $insertid = $this->Base_model->insert_one_row('building', $insert_data);

							 if($insertid)
								{
									$msg = "Building added successfully.";
									$this->session->set_flashdata('building_add_flashSuccess',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' added building successfully :'.$building_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

									$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/buildinglist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to add building.";
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
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add building:'.$building_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

									$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/buildinglist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/masterdata/addbuilding');
			$this->load->view('admin/footer');		
		}//ends else

	}//end function

/**********************function for update building***************/

	public function edit_building()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			
			$building_name  	  = xss_clean(strip_tags($this->input->post('building_name')));
			$building_short_name  = xss_clean(strip_tags($this->input->post('building_short_name')));

			$this->form_validation->set_rules('building_name','building name','trim|required');
			$this->form_validation->set_rules('building_short_name','building short name','trim|required');

				if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
						'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
						'building_short_name' => xss_clean(strip_tags($this->input->post('building_short_name')))
					);
					$uri = $this->uri->segment('4');
					$data['building_data'] = $this->Base_model->get_record_by_id('building', array('building_id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/editbuilding',$data);
					$this->load->view('admin/footer');
					
				}//ends if

				else
				{
					$building_name  	  	= xss_clean(strip_tags($this->input->post('building_name')));
					$building_short_name  = xss_clean(strip_tags($this->input->post('building_short_name')));
					$status  							= xss_clean(strip_tags($this->input->post('status')));
					$ip_address						= $_SERVER['REMOTE_ADDR'];
					$session_id 					= $this->session->userdata('user_id');
					$uri 									= $this->uri->segment('4');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");

					
					 

					/*****check building name********/

						$checked = $this->Admin_model->check_existent_building($building_name, $uri);

					/*****ends check building name*****/

						if($checked=='1')
						{
								$msg = "Building name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_building', $msg);

								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update building, already exits :'.$building_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

								$data['insertData'] = array(
								'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
								'building_short_name' => xss_clean(strip_tags($this->input->post('building_short_name')))
								);
							
								$data['building_data'] = $this->Base_model->get_record_by_id('building', array('building_id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/editbuilding',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$uri = $this->uri->segment('4');
								$update_data = array(
													'building_name' 				=> $building_name,
													'building_short_name' 	=> $building_short_name,
													'client_ip' 						=> $ip_address,
													'status'								=> $status,
													'modified_by' 					=> $session_id,
													'updated_date' 					=> $created_date
												);
							 $updateid = $this->Base_model->update_record_by_id('building', $update_data, array('building_id'=> $uri));

							 if($updateid)
								{
									$msg = "Building updated successfully.";
									$this->session->set_flashdata('building_add_flashSuccess',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' updated building successfully :'.$building_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/buildinglist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to update building.";
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
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update building :'.$building_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/buildinglist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{
			$uri = $this->uri->segment('4');
			$data['building_data'] = $this->Base_model->get_record_by_id('building', array('building_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/masterdata/editbuilding',$data);
			$this->load->view('admin/footer');		
		}//ends else

	}//end function

	/********function for Delete Building******/

	public function delete_building()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean(strip_tags($this->input->post('delete_itemId')));
				$data['building_data'] = $building_data = $this->Base_model->get_record_by_id('building', array('building_id' => $delete_itemId));
					/*****check building name********/

						$checked = $this->Base_model->check_existent('building', array('building_id' 	=> $delete_itemId,'delete_status'=>0));

					/*****ends check building name*****/

						if($checked=='1')
						{
								$msg = "Building already deleted.";
								$this->session->set_flashdata('building_add_flashError	', $msg);

								$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/buildinglist',$data);	
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$update_data = array(
													'status'				=> '0',
													'delete_status' => '0',
													'updated_date' 	=> $created_date
												);
								$updateid = $this->Base_model->update_record_by_id('building', $update_data, array('building_id'=> $delete_itemId));
								$msg = "Building deleted successfully.";
								$this->session->set_flashdata('building_delete_flashSuccess',$msg);

								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted building :'.$building_data->building_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/
									
								$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/buildinglist',$data);	
								$this->load->view('admin/footer');
						}
				
	}//ends function

	/********function for Delete Building******/

	public function view_building()
	{
			$uri = $this->uri->segment('4');
			$data['building_data'] = $this->Base_model->get_record_by_id('building', array('building_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/masterdata/viewbuilding',$data);
			$this->load->view('admin/footer');	
	}//ends function

	/*******function for building search******/

	public function search_building()
	{
		
		$building_name  	= xss_clean(strip_tags($this->input->post('building_name')));
		$status  					= xss_clean(strip_tags($this->input->post('status')));

		if(empty($building_name) && empty($status))
				{
					
					$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/buildinglist',$data);	
					$this->load->view('admin/footer');
				}//ends if

				else
				{
					
					$data['all_buildings'] = $this->Admin_model->search_building($building_name,$status);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/buildinglist',$data);	
					$this->load->view('admin/footer');

				}//ends else
	}// function ends


	
}//class ends


