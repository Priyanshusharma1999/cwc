<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Room extends CI_Controller {

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
		$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/admin_management/masterdata/roomlist',$data);
		$this->load->view('admin/footer');

	}//ends function

	/***************function for add room***************/

	public function add_room()
	{	
		if(isset($_REQUEST['submit'])) 
		{
		
			$building_name  	  	 = xss_clean(strip_tags($this->input->post('building_name')));
			$room_name  					 = xss_clean(strip_tags($this->input->post('room_name')));
		
			$this->form_validation->set_rules('building_name','building name','trim|required');
			$this->form_validation->set_rules('room_name','room name','trim|required');
		

				if($this->form_validation->run() === false) 
				{
						
						$data['insertData'] = array(
							'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
							'room_name' => xss_clean(strip_tags($this->input->post('room_name')))
						
						);
						$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
						$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/masterdata/addroom',$data);
						$this->load->view('admin/footer');	
				}//ends if

				else
				{
					$building_name  	  		 = xss_clean(strip_tags($this->input->post('building_name')));
					$room_name  						 = xss_clean(strip_tags($this->input->post('room_name')));
					$ip_address							 = $_SERVER['REMOTE_ADDR'];
					$session_id 						 = $this->session->userdata('user_id');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					
					/*****check room name********/

						$checked = $this->Base_model->check_existent('room_no', array('building_id'=> $building_name,'room_name'=>$room_name,'status'=>1,'delete_status'=>1));

					/*****ends check room name*****/

						if($checked=='1')
						{
								$msg = "Room name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_room', $msg);

								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add room, already exits :'.$room_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

								$data['insertData'] = array(
									'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
									'room_name' => xss_clean(strip_tags($this->input->post('room_name')))
								
								);
								$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/addroom',$data);
								$this->load->view('admin/footer');	
						}//ends if

						else
						{
							
								$insert_data = array(
													'building_id' 						=> $building_name,
													'room_name' 							=> $room_name,
													'client_ip' 							=> $ip_address,
													'modified_by' 						=> $session_id,
													'created_date' 						=> $created_date,
													'updated_date' 						=> $created_date
												);
							 $insertid = $this->Base_model->insert_one_row('room_no', $insert_data);

							 if($insertid)
								{
									$msg = "Room name added successfully.";
									$this->session->set_flashdata('room_add_flashSuccess',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' added room successfully:'.$room_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
									$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/roomlist',$data);
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to add room name.";
									$this->session->set_flashdata('room_add_flashError',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' falied to add room : '.$room_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
									$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/roomlist',$data);
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{
			$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
			$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/masterdata/addroom',$data);
			$this->load->view('admin/footer');	
		}//ends else

	}//end function

/**********************function for update room***************/

	public function edit_room()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			
			$building_name  	  	 = xss_clean(strip_tags($this->input->post('building_name')));
			$room_name  					 = xss_clean(strip_tags($this->input->post('room_name')));
		
			$this->form_validation->set_rules('building_name','building name','trim|required');
			$this->form_validation->set_rules('room_name','room name','trim|required');

				if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
							'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
							'room_name' => xss_clean(strip_tags($this->input->post('room_name')))
						
						);
					$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
					$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
					$uri = $this->uri->segment('4');
					$data['room_data'] = $this->Base_model->get_record_by_id('room_no', array('room_id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/editroom',$data);
					$this->load->view('admin/footer');
					
					
				}//ends if

				else
				{
					$building_name  	  	   = xss_clean(strip_tags($this->input->post('building_name')));
					$room_name  					   = xss_clean(strip_tags($this->input->post('room_name')));
					$status  					 			 = xss_clean(strip_tags($this->input->post('status')));
					$ip_address							 = $_SERVER['REMOTE_ADDR'];
					$session_id 						 = $this->session->userdata('user_id');
					$uri 										 = $this->uri->segment('4');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");

					/*****check room name********/

						$checked = $this->Admin_model->check_existent_room($building_name, $room_name,$uri);

					/*****ends check room name*****/

						if($checked=='1')
						{
							
								$msg = "Room name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_room', $msg);

								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' falied to update room, already exits : '.$room_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

								$data['insertData'] = array(
								'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
								'building_short_name' => xss_clean(strip_tags($this->input->post('building_short_name')))
								);
							
								$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
								$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
								$uri = $this->uri->segment('4');
								$data['room_data'] = $this->Base_model->get_record_by_id('room_no', array('room_id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/editroom',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$uri = $this->uri->segment('4');
								$update_data = array(
													'building_id' 						=> $building_name,
													'room_name' 							=> $room_name,
													'client_ip' 							=> $ip_address,
													'status'									=>	$status,
													'modified_by' 						=> $session_id,
													'updated_date' 						=> $created_date
												);
							 $updateid = $this->Base_model->update_record_by_id('room_no', $update_data, array('room_id'=> $uri));

							 if($updateid)
								{
									$msg = "Room updated successfully.";
									$this->session->set_flashdata('room_add_flashSuccess',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' room updated successfully : '.$room_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

									$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
									$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
									$uri = $this->uri->segment('4');
									$data['room_data'] = $this->Base_model->get_record_by_id('room_no', array('room_id' => $uri));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/roomlist',$data);
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to update room.";
									$this->session->set_flashdata('room_add_flashError',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update room , already exits '.$room_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/


									$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
									$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
									$uri = $this->uri->segment('4');
									$data['room_data'] = $this->Base_model->get_record_by_id('room_no', array('room_id' => $uri));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/roomlist',$data);
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{

					$uri = $this->uri->segment('4');
					$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
					$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
					$data['room_data'] = $this->Base_model->get_record_by_id('room_no', array('room_id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/editroom',$data);
					$this->load->view('admin/footer');
		}//ends else

	}//end function

	/********function for Delete Room******/

	public function delete_room()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean(strip_tags($this->input->post('delete_itemId')));
				$data['room_data'] = $room_data = $this->Base_model->get_record_by_id('room_no', array('room_id' => $delete_itemId));

					/*****check room name********/

						$checked = $this->Base_model->check_existent('room_no', array('room_id' 	=>$delete_itemId,'delete_status'=>0));

					/*****ends check room name*****/

						if($checked=='1')
						{
								$msg = "Room already deleted.";
								$this->session->set_flashdata('room_add_flashError	', $msg);

								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted room successfully : '.$room_data->room_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

								
								$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
								$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
								
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/roomlist',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$update_data = array(
													'status'				=> '0',
													'delete_status' => '0',
													'updated_date' 	=> $created_date
												);
								$updateid = $this->Base_model->update_record_by_id('room_no', $update_data, array('room_id'=> $delete_itemId));
								$msg = "Room deleted successfully.";
								$this->session->set_flashdata('room_delete_flashSuccess',$msg);

								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted room successfully : '.$room_data->room_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/
									
								$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
								$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
								
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/roomlist',$data);
								$this->load->view('admin/footer');
						}
				
	}//ends function

	/********function for view room******/

	public function view_room()
	{
			$uri = $this->uri->segment('4');
			$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
			$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>'1','status'=>'1'));
			$data['room_data'] = $this->Base_model->get_record_by_id('room_no', array('room_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/masterdata/viewroom',$data);
			$this->load->view('admin/footer');	
	}//ends function

		/*******function for room search******/

	public function search_room()
	{
		
		$room_name  	= xss_clean(strip_tags($this->input->post('room_name')));
		$status  			= xss_clean(strip_tags($this->input->post('status')));

		if(empty($room_name) && empty($status))
				{
					
					$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/roomlist',$data);
					$this->load->view('admin/footer');
				}//ends if

				else
				{
					$data['all_room'] = $this->Admin_model->search_room($room_name,$status);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/roomlist',$data);
					$this->load->view('admin/footer');

				}//ends else
	}// function ends


	
}//class ends


