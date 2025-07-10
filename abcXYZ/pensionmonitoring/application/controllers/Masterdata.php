<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Masterdata extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 
	 
	 function __construct()
	{
			parent::__construct();
			$this->load->model('Base_model');
			
			$coookie_ci_value = $this->input->cookie('ci_session', TRUE);

			$session_cookie_value = $this->session->userdata('asession_cookie');
			
			if(empty($this->session->userdata('applicant_user_id')))
			 {
				$base_url = base_url();
				 redirect($base_url.'Frontend/logout');
			 } 

			 if($coookie_ci_value != $session_cookie_value )
			 {
				$base_url = base_url();
				 redirect($base_url.'Frontend/logout');
			 }  
	}
	 
	public function index()
	{
		$segment_id = $this->uri->segment('3');
		$uri = $this->session->userdata('applicant_user_id');

		if($segment_id!=$uri)
		{
			$base_url = base_url();
			redirect($base_url.'Frontend/logout');
		}

		else
		{
			
			 $all_organization = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));

			 usort($all_organization, function($firstrow, $secondrow){
					
						$firstrow = $firstrow->ORGNAME;
						$secondrow = $secondrow->ORGNAME;
						if ($firstrow == $secondrow) {
								return 0;
						}
						return ($firstrow < $secondrow) ? -1 : 1;
					});

			
			$data['all_organization'] = $all_organization;
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/masterdata/organizationlist',$data);
			$this->load->view('admin/footer');	
		}
		
	
	}
	
	
	public function divisionlist()
	{
		$segment_id = $this->uri->segment('3');
		$uri = $this->session->userdata('applicant_user_id');

		if($segment_id!=$uri)
		{
			$base_url = base_url();
			redirect($base_url.'Frontend/logout');
		}

		else
		{
			$data['divisions_data'] = $this->Base_model->getall_divisions();
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/masterdata/divisionlist',$data);
			$this->load->view('admin/footer');
		}
			
	
	}

	public function addorganization()
	{
	   $segment_id = $this->uri->segment('3');
		$uri = $this->session->userdata('applicant_user_id');

		if($segment_id!=$uri)
		{
			$base_url = base_url();
			redirect($base_url.'Frontend/logout');
		}

		else
		{
			if(isset($_REQUEST['submit'])) 
		{
			$org_name  = xss_clean($this->input->post('organization_name'));
			$this->form_validation->set_rules('organization_name','organization name','trim|required');

			if($this->form_validation->run() === false) 
				{
					
				    $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/masterdata/addorganization',$data);
					$this->load->view('admin/footer');

				}//ends if

				else
				{
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s"); 

					/*****check region name********/

						$checked = $this->Base_model->check_existent('organization', array('ORGNAME'=> $org_name));

					/*****ends check region name*****/

					if($checked=='1')
					{
						/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add organization, already exits '.$org_name,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);

						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/

						$msg = "Organization name already exits, Please enter new one";
						$this->session->set_flashdata('flashError_org', $msg);
						$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
						$this->load->view('admin/header');
					    $this->load->view('admin/sidebar');
						$this->load->view('admin/masterdata/addorganization',$data);
						$this->load->view('admin/footer');
					}

					else
					{
							$insert_data = array(
													'ORGNAME' 	    => $org_name,
													'delete_status' => 0,
													'created_date' 	=> $created_date,
													'updated_date' 	=> $created_date
												);
						$insertid = $this->Base_model->insert_one_row('organization', $insert_data);

						if($insertid)
						{

						/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' added organization '.$org_name,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);

						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/

							$msg = "Organization name added successfully.";
							$this->session->set_flashdata('flashSuccess_org',$msg);
							$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/masterdata/organizationlist',$data);
							$this->load->view('admin/footer');
						}

						else
						{
							/*********logs code*******/

							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							$user_logs_data = array(
											'USERNAME' 	    => $this->session->userdata('user_name'),
											'ROLE'			=> $this->session->userdata('user_role'),
											'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
											'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
											'LOGINSTATUS' 	=> 'Logged in',
											'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add organization '.$org_name,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);

							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/

							$msg = "Fail to add organization name";
							$this->session->set_flashdata('flashError_org', $msg);
							$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
							$this->load->view('admin/header');
					         $this->load->view('admin/sidebar');
					         $this->load->view('admin/masterdata/addorganization',$data);
					         $this->load->view('admin/footer');
						}
					}//ends else		
				}//ends main else

		}//ends if

		else
		{
			
			$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/masterdata/addorganization',$data);
			$this->load->view('admin/footer');

		}//ends else
		}// ends else seession organisation
	   	
	
	}
	
	
	public function edit_organization()
	{
		
		$uri = $this->uri->segment('3'); 
		$segment_id = $this->uri->segment('4');
		$uri_check = $this->session->userdata('applicant_user_id');

		if($segment_id!=$uri_check)
		{
			$base_url = base_url();
			redirect($base_url.'Frontend/logout');
		}

		else
		{
			if(isset($_REQUEST['submit'])) 
		{
			
				$uri = $this->uri->segment('3');
				$org_name  = xss_clean($this->input->post('organization_name'));
				$this->form_validation->set_rules('organization_name','Organization name','trim|required');

				if($this->form_validation->run() === false) 
					{
					
						$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('ORGANIZATION_ID' => $uri));
						$this->load->view('admin/header');
					    $this->load->view('admin/sidebar');
					    $this->load->view('admin/masterdata/editorganization',$data);
					    $this->load->view('admin/footer');
					
					}//ends if

					else
					{
						
						
							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s"); 

					/*****check circle name********/

						//$checked = $this->Base_model->check_existent('organization', array('ORGNAME'=> $org_name));
						$uri = $this->uri->segment('3'); 
						$checked = $this->Base_model->check_existent_oraganisation($org_name,$uri);

						/*****ends check circle name*****/

						if($checked=='1')
						{
							/*********logs code*******/

							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							$user_logs_data = array(
											'USERNAME' 	    => $this->session->userdata('user_name'),
											'ROLE'			=> $this->session->userdata('user_role'),
											'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
											'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
											'LOGINSTATUS' 	=> 'Logged in',
											'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update organization '.$org_name,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);

							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/
							
							$msg = "Organization name already exits, Please enter new one";
							$this->session->set_flashdata('flashError_org', $msg);
							$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('ORGANIZATION_ID'=> $uri));
						    $this->load->view('admin/header');
					        $this->load->view('admin/sidebar');
					        $this->load->view('admin/masterdata/editorganization',$data);
					        $this->load->view('admin/footer');
							
						}// ends if

						else
						{
						
							
							$update_data = array(
													'ORGNAME' 		=> $org_name,
													'created_date' 	=> $created_date,
													'delete_status' => 0,
													'updated_date' 	=> $created_date
												);
							$updateid = $this->Base_model->update_record_by_id('organization', $update_data, array('ORGANIZATION_ID'=> $uri));

							if($updateid)
							{
							/*********logs code*******/

							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							$user_logs_data = array(
											'USERNAME' 	    => $this->session->userdata('user_name'),
											'ROLE'			=> $this->session->userdata('user_role'),
											'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
											'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
											'LOGINSTATUS' 	=> 'Logged in',
											'ACTIVITY' 		=> $this->session->userdata('user_name').' update organization '.$org_name,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);

							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/
								$msg = "Organization name updated successfully.";
								$this->session->set_flashdata('flashSuccess_org',$msg);
								$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
						       $this->load->view('admin/header');
					            $this->load->view('admin/sidebar');
					           $this->load->view('admin/masterdata/organizationlist',$data);
					            $this->load->view('admin/footer');
							}

							else
							{
								/*********logs code*******/

							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							$user_logs_data = array(
											'USERNAME' 	    => $this->session->userdata('user_name'),
											'ROLE'			=> $this->session->userdata('user_role'),
											'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
											'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
											'LOGINSTATUS' 	=> 'Logged in',
											'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update organization '.$org_name,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);

							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/
								$msg = "Fail to update Organization";
								$this->session->set_flashdata('flashError_org', $msg);
								$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
						       $this->load->view('admin/header');
					            $this->load->view('admin/sidebar');
					           $this->load->view('admin/masterdata/editorganization',$data);
					            $this->load->view('admin/footer');
							}//ends else
						}//ends else
					}//ends main else
		}//ends if

		else
		{
				$uri = $this->uri->segment('3');
				$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('ORGANIZATION_ID' => $uri));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
			    $this->load->view('admin/masterdata/editorganization',$data);
				$this->load->view('admin/footer');
		}//ends else
		}//ends else session  check

		
		
		
	}
	
	public function delete_organization(){
			
			$session_id = xss_clean($this->input->post('session_id'));
			$uri = $this->session->userdata('applicant_user_id');

			if($session_id!=$uri)
			{
				$base_url = base_url();
				redirect($base_url.'Frontend/logout');
			}

			else
			{

				date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s"); 
			//$delete_itemId = xss_clean($this->input->post('delete_itemId'));
			$delete_itemId = xss_clean($this->input->post('id'));
			
			  $data['post_data'] = $post_data =  $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $delete_itemId));			
				
		    $update_data = array(
								'ORGNAME' 		=> $post_data->ORGNAME,
								'created_date' 	=> $created_date,
								'delete_status' => 1,
								'updated_date' 	=> $created_date
							);
			$updateid = $this->Base_model->update_record_by_id('organization', $update_data, array('ORGANIZATION_ID'=> $delete_itemId));
			/*********logs code*******/

			date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s");
			$user_logs_data = array(
							'USERNAME' 	    => $this->session->userdata('user_name'),
							'ROLE'			=> $this->session->userdata('user_role'),
							'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
							'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
							'LOGINSTATUS' 	=> 'Logged in',
							'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted organization '.$post_data->ORGNAME,
							'ACTIVITYTIME'  => time(),
							'CREATEDDATED'  => $created_date
							
						);

			$this->Base_model->insert_one_row('userlogs', $user_logs_data);

		 /*********ends logs code*******/

			$msg = "Organization name deleted successfully.";
			$this->session->set_flashdata('flashSuccess_org',$msg);
			$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/masterdata/organizationlist',$data);
			$this->load->view('admin/footer');
		
		
			}// ends else session check
		    
	}// ends function
	
	
	public function adddivision()
	{
	
	   if(isset($_REQUEST['submit'])) 
		{
			$org_name  = xss_clean($this->input->post('organization_name'));
			$division_name  = xss_clean($this->input->post('division_name'));
			$this->form_validation->set_rules('organization_name','organization name','trim|required');
			$this->form_validation->set_rules('division_name','Division name','trim|required');

			if($this->form_validation->run() === false) 
				{
					
				    $data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/masterdata/adddivision',$data);
					$this->load->view('admin/footer');

				}//ends if

				else
				{
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s"); 

					/*****check region name********/

			  $checked = $this->Base_model->check_existent('division', array('DIVISIONNAME'=> $division_name,'status'=> 1));

					/*****ends check region name*****/

					if($checked=='1')
					{
						/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add division, already exits  '.$division_name,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);

						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 /*********ends logs code*******/

						$msg = "Division name already exits, Please enter new one";
						$this->session->set_flashdata('flashError_division', $msg);
						$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
						$this->load->view('admin/header');
					    $this->load->view('admin/sidebar');
						$this->load->view('admin/masterdata/adddivision',$data);
						$this->load->view('admin/footer');
					}

					else
					{
							$insert_data = array(
													'DIVISIONNAME' 	=> $division_name,
													'ORGANIZATION_ID' => $org_name,
													'status' => 1,
													'created_date' 	=> $created_date,
													'updated_date' 	=> $created_date
												);
						$insertid = $this->Base_model->insert_one_row('division', $insert_data);

						if($insertid)
						{
							/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' added division, '.$division_name,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);

						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 /*********ends logs code*******/

							$msg = "Division name added successfully.";
							$this->session->set_flashdata('flashSuccess_division',$msg);
							$data['divisions_data'] = $this->Base_model->getall_divisions();
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/masterdata/divisionlist',$data);
							$this->load->view('admin/footer');
						}

						else
						{
						/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add division, '.$division_name,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);

						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 /*********ends logs code*******/

							$msg = "Fail to add division name";
							$this->session->set_flashdata('flashError_division', $msg);
							$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
							$this->load->view('admin/header');
					         $this->load->view('admin/sidebar');
					         $this->load->view('admin/masterdata/adddivision',$data);
					         $this->load->view('admin/footer');
						}
					}//ends else		
				}//ends main else

		}//ends if

		else
		{  
	       $data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/masterdata/adddivision',$data);
			$this->load->view('admin/footer');

		}//ends else	
	
	}
	
	
	
	public function edit_division()
	{
		
		$uri = $this->uri->segment('3'); 
		
		if(isset($_REQUEST['submit'])) 
		{
			
				$uri = $this->uri->segment('3');
				$org_id  = xss_clean($this->input->post('organization_name'));
				$division_name  = xss_clean($this->input->post('division_name'));
				$this->form_validation->set_rules('organization_name','Organization name','trim|required');
				$this->form_validation->set_rules('division_name','Division name','trim|required');

				if($this->form_validation->run() === false) 
					{
						
						$data['insertData'] = array(
							'ORGNAME' => xss_clean($this->input->post('organization_name'))
						);
					
					
						$data['all_divisions'] = $this->Base_model->get_all_record_by_condition('division',array('DIVISION_ID' => $uri));
						
			        	$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
						
						$this->load->view('admin/header');
					    $this->load->view('admin/sidebar');
					    $this->load->view('admin/masterdata/editdivision',$data);
					    $this->load->view('admin/footer');
					
					}//ends if

					else
					{
							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s"); 

					
							
							$update_data = array(
													'DIVISIONNAME' 		=> $division_name,
													'ORGANIZATION_ID' => $org_id,
													'status' => 1,
													'updated_date' 	=> $created_date
												);
							$updateid = $this->Base_model->update_record_by_id('division', $update_data, array('DIVISION_ID'=> $uri));

							if($updateid)
							{
								/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> $this->session->userdata('user_role'),
												'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' update division, '.$division_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							 /*********ends logs code*******/

								$msg = "Division name updated successfully.";
								$this->session->set_flashdata('flashSuccess_division',$msg);
								$data['divisions_data'] = $this->Base_model->getall_divisions();
						        $this->load->view('admin/header');
					            $this->load->view('admin/sidebar');
					            $this->load->view('admin/masterdata/divisionlist',$data);
					            $this->load->view('admin/footer');
							}

							else
							{
								/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> $this->session->userdata('user_role'),
												'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update division, '.$division_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							 /*********ends logs code*******/
								$msg = "Fail to update Division";
								$this->session->set_flashdata('flashError_division', $msg);
								$data['all_divisions'] = $this->Base_model->get_all_record_by_condition('division',array('DIVISION_ID' => $uri));
				                $data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
						       $this->load->view('admin/header');
					            $this->load->view('admin/sidebar');
					           $this->load->view('admin/masterdata/editdivision',$data);
					            $this->load->view('admin/footer');
							}//ends else
						
					}//ends main else
		}//ends if

		else
		{
				$uri = $this->uri->segment('3');
				$data['all_divisions'] = $this->Base_model->get_all_record_by_condition('division',array('DIVISION_ID' => $uri));
				$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
			    $this->load->view('admin/masterdata/editdivision',$data);
				$this->load->view('admin/footer');
		}
		
	}
	
	
	public function delete_division(){
			
			$session_id = xss_clean($this->input->post('session_id'));
			$uri = $this->session->userdata('applicant_user_id');

			if($session_id!=$uri)
			{
				$base_url = base_url();
				redirect($base_url.'Frontend/logout');
			}

			else
			{
				date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s"); 
			//$delete_itemId = xss_clean($this->input->post('delete_itemId'));
			$delete_itemId = xss_clean($this->input->post('id'));
			
             $data['post_data'] = $post_data =  $this->Base_model->get_record_by_id('division', array('DIVISION_ID' => $delete_itemId));			
				
		    $update_data = array(
								'DIVISION_ID' 		=> $post_data->DIVISION_ID,
								'DIVISIONNAME' 		=> $post_data->DIVISIONNAME,
								'ORGANIZATION_ID' 		=> $post_data->ORGANIZATION_ID,
								'status'				=> 0,
								'updated_date' 	=> $created_date
							);
			$updateid = $this->Base_model->update_record_by_id('division', $update_data, array('DIVISION_ID'=> $delete_itemId));
			
			/*********logs code*******/

				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s");
				$user_logs_data = array(
								'USERNAME' 	    => $this->session->userdata('user_name'),
								'ROLE'			=> $this->session->userdata('user_role'),
								'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
								'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
								'LOGINSTATUS' 	=> 'Logged in',
								'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted division, '.$post_data->DIVISIONNAME,
								'ACTIVITYTIME'  => time(),
								'CREATEDDATED'  => $created_date
								
							);

				$this->Base_model->insert_one_row('userlogs', $user_logs_data);

			 /*********ends logs code*******/

			$msg = "Division deleted successfully.";
			$this->session->set_flashdata('flashSuccess_division',$msg);					
			$data['divisions_data'] = $this->Base_model->getall_divisions();
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/masterdata/divisionlist',$data);
			$this->load->view('admin/footer');
			}// ends else session check
		    
		
	}// ends function
	
	
	
		public function search_organization()
	     {
			if(isset($_REQUEST['submit'])){
					$org_name = xss_clean($this->input->post('organization_name'));
					$data['all_organization'] 	 = $this->Base_model->search_organization($org_name);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/masterdata/organizationlist',$data);
					$this->load->view('admin/footer');
			}

			else
			{
				$data['all_organization'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status'=>0));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/masterdata/organizationlist',$data);
				$this->load->view('admin/footer');
			}
		
	      }
		  
		 public function search_division()
	     {
			if(isset($_REQUEST['submit'])){
					$division_name = xss_clean($this->input->post('division_name'));
					$data['divisions_data'] = $this->Base_model->search_division($division_name);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/masterdata/divisionlist',$data);
					$this->load->view('admin/footer');
			}

			else

			{
				$data['divisions_data'] = $this->Base_model->getall_divisions();
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/masterdata/divisionlist',$data);
				$this->load->view('admin/footer');	
			}
		
	      }
		  
	
	
}
