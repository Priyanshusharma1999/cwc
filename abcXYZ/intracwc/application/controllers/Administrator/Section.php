<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Section extends CI_Controller {

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
		$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('delete_status'=>'1'));
		$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/admin_management/masterdata/namelist',$data);
		$this->load->view('admin/footer');

	}//ends function

	/***************function for add section***************/

	public function add_section()
	{	
		if(isset($_REQUEST['submit'])) 
		{
			
			$wing_name  	  	 		= xss_clean(strip_tags($this->input->post('wing_name')));
			$section_name  				= xss_clean(strip_tags($this->input->post('section_name')));
			$section_short_name  	= xss_clean(strip_tags($this->input->post('section_short_name')));
			$show  							  = xss_clean(strip_tags($this->input->post('show')));

			$this->form_validation->set_rules('wing_name','wing name','trim|required');
			$this->form_validation->set_rules('section_name','section name','trim|required');
			$this->form_validation->set_rules('section_short_name','section short name','trim|required');
			

				if($this->form_validation->run() === false) 
				{
						
						$data['insertData'] = array(
							'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
							'section_short_name' => xss_clean(strip_tags($this->input->post('section_short_name'))),
							'show' => xss_clean(strip_tags($this->input->post('show')))
						);
						$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/masterdata/addname',$data);
						$this->load->view('admin/footer');
				}//ends if

				else
				{
					$wing_name  	  	 		= xss_clean(strip_tags($this->input->post('wing_name')));
					$section_name  				= xss_clean(strip_tags($this->input->post('section_name')));
					$section_short_name  	= xss_clean(strip_tags($this->input->post('section_short_name')));
					$show  							  = xss_clean(strip_tags($this->input->post('show')));
					$ip_address						= $_SERVER['REMOTE_ADDR'];
					$session_id 					= $this->session->userdata('user_id');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					
					if(empty($show))
					{
						$show = '0';
					}

					else
					{
						$show = $show;
					}
					/*****check section name********/

						$checked = $this->Base_model->check_existent('section', array('section_name'=> $section_name,'wing_id'=> $wing_name,'delete_status'=>1));

					/*****ends check section name*****/

						if($checked=='1')
						{
								$msg = "Section name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_section', $msg);

								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add section, already exits '.$section_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

								$data['insertData'] = array(
									'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
									'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
									'section_short_name' => xss_clean(strip_tags($this->input->post('section_short_name'))),
									'show' => xss_clean(strip_tags($this->input->post('show')))
								);
								$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/addname',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
							
								$insert_data = array(
													'wing_id' 								=> $wing_name,
													'section_name' 						=> $section_name,
													'section_short_name' 			=> $section_short_name,
													'show_status' 						=> $show,
													'client_ip' 							=> $ip_address,
													'modified_by' 						=> $session_id,
													'created_date' 						=> $created_date,
													'updated_date' 						=> $created_date
												);
							 $insertid = $this->Base_model->insert_one_row('section', $insert_data);

							 if($insertid)
								{
									$msg = "Section added successfully.";
									$this->session->set_flashdata('section_add_flashSuccess',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' section added successfully '.$section_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('delete_status'=>'1'));
									$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/namelist',$data);
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to add section.";
									$this->session->set_flashdata('section_add_flashError',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add section '.$section_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('delete_status'=>'1'));
									$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/namelist',$data);
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{
			$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/masterdata/addname',$data);
			$this->load->view('admin/footer');	
		}//ends else

	}//end function

/**********************function for update section***************/

	public function edit_section()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			
			$wing_name  	  	 		= xss_clean(strip_tags($this->input->post('wing_name')));
			$section_name  				= xss_clean(strip_tags($this->input->post('section_name')));
			$section_short_name  	= xss_clean(strip_tags($this->input->post('section_short_name')));
			$show  							  = xss_clean(strip_tags($this->input->post('show')));

			$this->form_validation->set_rules('wing_name','wing name','trim|required');
			$this->form_validation->set_rules('section_name','section name','trim|required');
			$this->form_validation->set_rules('section_short_name','section short name','trim|required');

				if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
							'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
							'section_short_name' => xss_clean(strip_tags($this->input->post('section_short_name'))),
							'show' => xss_clean(strip_tags($this->input->post('show')))
						);
					$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
					$uri = $this->uri->segment('4');
					$data['section_data'] = $this->Base_model->get_record_by_id('section', array('section_id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/editname',$data);
					$this->load->view('admin/footer');
					
					
				}//ends if

				else
				{
						$wing_name  	  	 			 = xss_clean(strip_tags($this->input->post('wing_name')));
						$section_name  				 	 = xss_clean(strip_tags($this->input->post('section_name')));
						$section_short_name  		 = xss_clean(strip_tags($this->input->post('section_short_name')));
						$show  							  	 = xss_clean(strip_tags($this->input->post('show')));
						$status  								 = xss_clean(strip_tags($this->input->post('status')));
						$ip_address							 = $_SERVER['REMOTE_ADDR'];
						$session_id 						 = $this->session->userdata('user_id');
						$uri 										 = $this->uri->segment('4');
						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");

						if(empty($show))
						{
							$show = '';
						}

						else
						{
							$show = $show;
						}
					/*****check section name********/

						$checked = $this->Admin_model->check_existent_section($section_name,$wing_name,$uri);

					/*****ends check section name*****/

						if($checked=='1')
						{
							
								$msg = "Section name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_section', $msg);

								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add section, already exits '.$section_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

								$data['insertData'] = array(
									'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
									'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
									'section_short_name' => xss_clean(strip_tags($this->input->post('section_short_name'))),
									'show' => xss_clean(strip_tags($this->input->post('show')))
								);
								$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
								$uri = $this->uri->segment('4');
								$data['section_data'] = $this->Base_model->get_record_by_id('section', array('section_id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/editname',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$uri = $this->uri->segment('4');
								$update_data = array(
													'wing_id' 								=> $wing_name,
													'section_name' 						=> $section_name,
													'section_short_name' 			=> $section_short_name,
													'show_status' 						=> $show,
													'client_ip' 							=> $ip_address,
													'status'									=>	$status,
													'modified_by' 						=> $session_id,
													'updated_date' 						=> $created_date
												);
							 $updateid = $this->Base_model->update_record_by_id('section', $update_data, array('section_id'=> $uri));

							 if($updateid)
								{
									$msg = "Section updated successfully.";
									$this->session->set_flashdata('section_add_flashSuccess',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' section updated successfully : '.$section_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('delete_status'=>'1'));
									$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/namelist',$data);
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to update section.";
									$this->session->set_flashdata('section_add_flashError',$msg);

									/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update section :'.$section_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('delete_status'=>'1'));
									$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/masterdata/namelist',$data);
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{

					$uri = $this->uri->segment('4');
					$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('delete_status'=>'1'));
					$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
					$data['section_data'] = $this->Base_model->get_record_by_id('section', array('section_id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/editname',$data);
					$this->load->view('admin/footer');
		}//ends else

	}//end function

	/********function for Delete section******/

	public function delete_section()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean(strip_tags($this->input->post('delete_itemId')));
				$data['section_data'] = $section_data = $this->Base_model->get_record_by_id('section', array('section_id' => $delete_itemId));

					/*****check section name********/
						$checked = $this->Base_model->check_existent('section', array('section_id'=>$delete_itemId,'delete_status'=>0));
					/*****ends check section name*****/

						if($checked=='1')
						{
								$msg = "Section already deleted.";
								$this->session->set_flashdata('section_add_flashError', $msg);
								
								/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted section :'.$section_data->section_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

								$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('delete_status'=>'1'));
								$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/namelist',$data);
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$update_data = array(
													'status'				=> '0',
													'delete_status' => '0',
													'updated_date' 	=> $created_date
												);
								$updateid = $this->Base_model->update_record_by_id('section', $update_data, array('section_id'=> $delete_itemId));
								$msg = "Section deleted successfully.";
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
													'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted section :'.$section_data->section_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/
							
								$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('delete_status'=>'1'));
								$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/masterdata/namelist',$data);
								$this->load->view('admin/footer');
						}
				
	}//ends function

	/********function for view section******/

	public function view_section()
	{
			$uri = $this->uri->segment('4');
			$data['section_data'] = $this->Base_model->get_record_by_id('section', array('section_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/masterdata/viewname',$data);
			$this->load->view('admin/footer');	
	}//ends function

		/*******function for section search******/

	public function search_section()
	{
		
		$section_name  	= xss_clean(strip_tags($this->input->post('section_name')));
		$status  				= xss_clean(strip_tags($this->input->post('status')));

		if(empty($section_name) && empty($status))
				{
					$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('delete_status'=>'1'));
					$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/namelist',$data);
					$this->load->view('admin/footer');
				}//ends if

				else
				{
					$data['all_section'] = $this->Admin_model->search_section($section_name,$status);
					$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>'1','delete_status'=>'1'));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/masterdata/namelist',$data);
					$this->load->view('admin/footer');

				}//ends else
	}// function ends


	
}//class ends


