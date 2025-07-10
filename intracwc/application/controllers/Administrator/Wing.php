<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wing extends CI_Controller {

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
		$data['all_wings'] = $this->Base_model->get_all_record_by_condition('wing', array('delete_status'=>1));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/admin_management/masterdata/wingnamelist',$data);	
		$this->load->view('admin/footer');

	}//ends function

	/***************function for add wings***************/

	public function add_wing()
	{	
		if(isset($_REQUEST['submit'])) 
		{
			
			$wing_name  	  	= xss_clean($this->input->post('wing_name'));
			$wing_short_name  = xss_clean($this->input->post('wing_short_name'));

			$this->form_validation->set_rules('wing_name','wing name','trim|required');
			$this->form_validation->set_rules('wing_short_name','wing short name','trim|required');

				if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
						'wing_name' => xss_clean($this->input->post('wing_name')),
						'wing_short_name' => xss_clean($this->input->post('wing_short_name'))
					);
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/addwingname',$data);
					$this->load->view('admin/footer');
				}//ends if

				else
				{
					$wing_name  	  			= xss_clean($this->input->post('wing_name'));
					$wing_short_name  		= xss_clean($this->input->post('wing_short_name'));
					$ip_address						= $_SERVER['REMOTE_ADDR'];
					$session_id 					= $this->session->userdata('user_id');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					
					 

					/*****check wing name********/

						$checked = $this->Base_model->check_existent('wing', array('wing_name'=> $wing_name,'delete_status'=>1));

					/*****ends check wing name*****/

						if($checked=='1')
						{
								$msg = "Wing name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_wing', $msg);

								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add wing, already exits : '.$wing_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

								$data['insertData'] = array(
									'wing_name' => xss_clean($this->input->post('wing_name')),
									'wing_short_name' => xss_clean($this->input->post('wing_short_name'))
								);
							
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/addwingname',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
							
								$insert_data = array(
													'wing_name' 						=> $wing_name,
													'wing_short_name' 			=> $wing_short_name,
													'client_ip' 						=> $ip_address,
													'modified_by' 					=> $session_id,
													'created_date' 					=> $created_date,
													'updated_date' 					=> $created_date
												);
							 $insertid = $this->Base_model->insert_one_row('wing', $insert_data);

							 if($insertid)
								{
									$msg = "Wing added successfully.";
									$this->session->set_flashdata('wing_add_flashSuccess',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' wing added successfully : '.$wing_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' added wing successfully : '.$wing_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/
									$data['all_wings'] = $this->Base_model->get_all_record_by_condition('wing', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/wingnamelist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to add wing.";
									$this->session->set_flashdata('wing_add_flashError',$msg);

								
									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add wing'.$wing_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									$data['all_wings'] = $this->Base_model->get_all_record_by_condition('wing', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/wingnamelist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/masterdata/addwingname');
			$this->load->view('admin/footer');		
		}//ends else

	}//end function

/**********************function for update wing***************/

	public function edit_wing()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			
			$wing_name  	  	= xss_clean($this->input->post('wing_name'));
			$wing_short_name  = xss_clean($this->input->post('wing_short_name'));

			$this->form_validation->set_rules('wing_name','wing name','trim|required');
			$this->form_validation->set_rules('wing_short_name','wing short name','trim|required');

				if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
						'wing_name' => xss_clean($this->input->post('wing_name')),
						'wing_short_name' => xss_clean($this->input->post('wing_short_name'))
					);
					$uri = $this->uri->segment('4');
					$data['wing_data'] = $this->Base_model->get_record_by_id('wing', array('wing_id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/editwingname',$data);
					$this->load->view('admin/footer');
					
				}//ends if

				else
				{
					$wing_name  	  	= xss_clean($this->input->post('wing_name'));
					$wing_short_name  = xss_clean($this->input->post('wing_short_name'));
					$status  							= xss_clean($this->input->post('status'));
					$ip_address						= $_SERVER['REMOTE_ADDR'];
					$session_id 					= $this->session->userdata('user_id');
					$uri 									= $this->uri->segment('4');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");

					/*****check wing name********/

						$checked = $this->Admin_model->check_existent_wing($wing_name, $uri);

					/*****ends check wing name*****/

						if($checked=='1')
						{
								$msg = "Wing name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_wing', $msg);

								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update wing : '.$wing_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

								$data['insertData'] = array(
									'wing_name' => xss_clean($this->input->post('wing_name')),
									'wing_short_name' => xss_clean($this->input->post('wing_short_name'))
								);
							
								$data['wing_data'] = $this->Base_model->get_record_by_id('wing', array('wing_id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/editwingname',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$uri = $this->uri->segment('4');
								$update_data = array(
													'wing_name' 						=> $wing_name,
													'wing_short_name' 			=> $wing_short_name,
													'client_ip' 						=> $ip_address,
													'status'								=> $status,
													'modified_by' 					=> $session_id,
													'updated_date' 					=> $created_date
												);
							 $updateid = $this->Base_model->update_record_by_id('wing', $update_data, array('wing_id'=> $uri));

							 if($updateid)
								{
									$msg = "Wing updated successfully.";
									$this->session->set_flashdata('wing_add_flashSuccess',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' updated wing : '.$wing_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									$data['all_wings'] = $this->Base_model->get_all_record_by_condition('wing', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/wingnamelist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to update wing.";
									$this->session->set_flashdata('wing_add_flashError',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update wing : '.$wing_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									$data['all_wings'] = $this->Base_model->get_all_record_by_condition('wing', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/wingnamelist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{
			$uri = $this->uri->segment('4');
			$data['wing_data'] = $this->Base_model->get_record_by_id('wing', array('wing_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/masterdata/editwingname',$data);
			$this->load->view('admin/footer');		
		}//ends else

	}//end function

	/********function for Delete Wing******/

	public function delete_wing()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean($this->input->post('delete_itemId'));
				$data['wing_data'] = $wing_data = $this->Base_model->get_record_by_id('wing', array('wing_id' => $delete_itemId));
				
					/*****check wing name********/
						$checked = $this->Base_model->check_existent('wing', array('wing_id'=> $delete_itemId,'delete_status'=>0));
					/*****ends check wing name*****/

						if($checked=='1')
						{
								$msg = "Wing already deleted.";
								$this->session->set_flashdata('wing_add_flashError', $msg);
								
								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted wing : '.$wing_data->wing_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

								$data['all_wings'] = $this->Base_model->get_all_record_by_condition('wing', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/wingnamelist',$data);	
									$this->load->view('admin/footer');
						}//ends if

						else
						{
								$update_data = array(
													'status'				=> '0',
													'delete_status' => '0',
													'updated_date' 	=> $created_date
												);
								$updateid = $this->Base_model->update_record_by_id('wing', $update_data, array('wing_id'=>$delete_itemId));
								$msg = "Wing deleted successfully.";
								$this->session->set_flashdata('wing_delete_flashSuccess',$msg);

								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted wing : '.$wing_data->wing_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/
							
								$data['all_wings'] = $this->Base_model->get_all_record_by_condition('wing', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/wingnamelist',$data);	
									$this->load->view('admin/footer');
						}
				
	}//ends function

	/********function for view Wing******/

	public function view_wing()
	{
			$uri = $this->uri->segment('4');
			$data['wing_data'] = $this->Base_model->get_record_by_id('wing', array('wing_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/masterdata/viewwing',$data);
			$this->load->view('admin/footer');	
	}//ends function

	/*******function for search wing******/

	public function search_wing()
	{
		
		$wing_name  	= xss_clean($this->input->post('wing_name'));
		$status  			= xss_clean($this->input->post('status'));

		if(empty($wing_name) && empty($status))
				{
					$data['all_wings'] = $this->Base_model->get_all_record_by_condition('wing', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/wingnamelist',$data);	
					$this->load->view('admin/footer');
				}//ends if

				else
				{
					$data['all_wings'] = $this->Admin_model->search_wing($wing_name,$status);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/wingnamelist',$data);	
					$this->load->view('admin/footer');
				}//ends else
	}// function ends


	
}//class ends


