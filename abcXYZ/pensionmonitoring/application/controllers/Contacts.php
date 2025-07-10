<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Contacts extends CI_Controller {

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

		$controle = array(1,2,3,4);
			
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

	     if (in_array($this->session->userdata('user_role'), $controle)){

	     	$auth = $this->session->userdata('user_role');

	     }

         if(empty($auth)){

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
			$all_contacts = $this->Base_model->get_all_record_by_condition('employees',array('status'=>1));
			$data['all_organizations'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
			$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);

			usort($all_contacts, function($firstrow, $secondrow){
					
						$firstrow = $firstrow->ROLE;
						$secondrow = $secondrow->ROLE;
						if ($firstrow == $secondrow) {
								return 0;
						}
						return ($firstrow < $secondrow) ? -1 : 1;
					});
			$data['all_contacts'] = $all_contacts;
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/contacts/contactlist',$data);
			$this->load->view('admin/footer');	
		}// ends else
		
	
	}
	
	
	public function addcontacts()
	{
	
	   if(isset($_REQUEST['submit'])) 
		{
			
			$name  = xss_clean($this->input->post('name'));
			$designation  = xss_clean($this->input->post('designation'));
			$office_name  = xss_clean($this->input->post('office_name'));
			$email  = xss_clean($this->input->post('email'));
			$office_address  = xss_clean($this->input->post('office_address'));
			$landline_no  = xss_clean($this->input->post('landline_no'));
			$mobile_no  = xss_clean($this->input->post('mobile_no'));
			$division_name  = xss_clean($this->input->post('division_name'));
			$organization_name  = xss_clean($this->input->post('organization_name'));
			/*$role  = xss_clean($this->input->post('role'));*/
			$role  = '';
			
			$this->form_validation->set_rules('name','Name','trim|required');
			$this->form_validation->set_rules('designation','designation','trim|required');
			$this->form_validation->set_rules('office_name','office name','trim|required');
			$this->form_validation->set_rules('email','email id','trim|required');
			$this->form_validation->set_rules('office_address','office address','trim|required');
			$this->form_validation->set_rules('mobile_no','mobile no','trim|required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('landline_no','landline no','trim|required');
			//$this->form_validation->set_rules('division_name','division name','trim|required');
			//$this->form_validation->set_rules('role','role','trim|required');
		

			if($this->form_validation->run() === false) 
				{
					
					$data['insertData'] = array(
						'name' => xss_clean($this->input->post('name')),
						'designation' => xss_clean($this->input->post('designation')),	
						'email' => xss_clean($this->input->post('email')),
						'office_name' => xss_clean($this->input->post('office_name')),
						'office_address' => xss_clean($this->input->post('office_address')),
						'landline_no' => xss_clean($this->input->post('landline_no')),
						'mobile_no' => xss_clean($this->input->post('mobile_no')),
						'division_name' => xss_clean($this->input->post('division_name')),
						'organization_name' => xss_clean($this->input->post('organization_name'))
					);
					
					$data['all_divisions'] = $this->Base_model->get_all_record_by_condition('division',array('status' => 1));
			        $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/contacts/addcontact',$data);
					$this->load->view('admin/footer');

				}//ends if

				else
				{
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s"); 

						$checked = $this->Base_model->check_existent('employees', array('EMAIL'=> $email));
						
						$checked1 = $this->Base_model->check_existent('employees', array('MOBILE' => $mobile_no));

					if($checked=='1')
					{
						
					$data['insertData'] = array(
						'name' => xss_clean($this->input->post('name')),
						'designation' => xss_clean($this->input->post('designation')),
						'email' => xss_clean($this->input->post('email')),
						'office_name' => xss_clean($this->input->post('office_name')),
						'office_address' => xss_clean($this->input->post('office_address')),
						'landline_no' => xss_clean($this->input->post('landline_no')),
						'mobile_no' => xss_clean($this->input->post('mobile_no')),
						'division_name' => xss_clean($this->input->post('division_name')),
						
						'organization_name' => xss_clean($this->input->post('organization_name'))
					);
					
					$data['all_divisions'] = $this->Base_model->get_all_record_by_condition('division',array('status' => 1));
			        $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
						
						  /*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add contact ,email already exits.',
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);
						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/

						$msg = "Email already exits, Please enter new one";
						$this->session->set_flashdata('flashError_contact', $msg);
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/contacts/addcontact',$data);
						$this->load->view('admin/footer');
						
					} else if($checked1=='1'){
						
						
					$data['insertData'] = array(
						'name' => xss_clean($this->input->post('name')),
						'designation' => xss_clean($this->input->post('designation')),
						'email' => xss_clean($this->input->post('email')),
						'office_name' => xss_clean($this->input->post('office_name')),
						'office_address' => xss_clean($this->input->post('office_address')),
						'landline_no' => xss_clean($this->input->post('landline_no')),
						'mobile_no' => xss_clean($this->input->post('mobile_no')),
						
						'division_name' => xss_clean($this->input->post('division_name')),
						'organization_name' => xss_clean($this->input->post('organization_name'))
					);
					
					$data['all_divisions'] = $this->Base_model->get_all_record_by_condition('division',array('status' => 1));
			        $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
					
						/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add contact ,mobile number already exits.',
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);
						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/

						$msg = "Mobile no. already exits, Please enter new one";
						$this->session->set_flashdata('flashError_contact', $msg);
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/contacts/addcontact',$data);
						$this->load->view('admin/footer');
						
					} else
					 {
					  $insert_data = array(
									'FULLENAME' 	    => $name,
									'ORGANIZATION_ID' 	=> $organization_name,
									'DIVISION_ID' 	    => $division_name,
									'DESIGNATION' 	    => $designation,
									'OFFICENAME' 	    => $office_name,
									'EMAIL' 	        => $email,
									'MOBILE' 	        => $mobile_no,
									'LANDLINE_NO' 	    => $landline_no,
									'STATUS' 	        => 1,
									
									'CREATEDDATE' 	    => $created_date,
									'LASTMODIFIED'   	=> $created_date,
									'OFFICE_ADDRESS' 	=> $office_address
								);
						$insertid = $this->Base_model->insert_one_row('employees', $insert_data);

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
										'ACTIVITY' 		=> $this->session->userdata('user_name').' add contact : '.$name,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);
						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/

							$msg = "Contact name added successfully.";
							$this->session->set_flashdata('flashSuccess_contact',$msg);
							$all_contacts = $this->Base_model->get_all_record_by_condition('employees',array('status'=>1));
							usort($all_contacts, function($firstrow, $secondrow){
				
										$firstrow = $firstrow->ROLE;
										$secondrow = $secondrow->ROLE;
										if ($firstrow == $secondrow) {
												return 0;
										}
										return ($firstrow < $secondrow) ? -1 : 1;
									});
							$data['all_contacts'] = $all_contacts;
							$data['all_divisions'] = $this->Base_model->get_all_record_by_condition('division',array('status' => 1));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/contacts/contactlist',$data);
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
										'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add contact ,mobile number already exits.',
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);
						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						 /*********ends logs code*******/

							$msg = "Fail to add Contact name";
							$this->session->set_flashdata('flashError_contact', $msg);
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/contacts/addcontact',$data);
							$this->load->view('admin/footer');
						}
					}
				}

		}

		else
		{
			
			$data['all_divisions'] = $this->Base_model->get_all_record_by_condition('division',array('status' => 1));
			$data['all_org'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/contacts/addcontact',$data);
			$this->load->view('admin/footer');

		}
	
	}
	
	
  public function all_organizations()
	{
		
		$org_id = $this->input->post('id');
		$all_organization =  $this->Base_model->get_all_record_by_condition('division', array('DIVISION_ID'=>$org_id));
	
		$org_data = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $all_organization[0]->ORGANIZATION_ID));
		
		$all_organizations =  json_encode($org_data);
		echo  $all_organizations;
	}


	public function all_divisionss()
	{
		
		$org_id = $this->input->post('id');
		$all_divisions =  $this->Base_model->get_all_record_by_condition('division', array('ORGANIZATION_ID'=>$org_id));
		
		//$org_data = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $all_organization[0]->ORGANIZATION_ID));
		
		$all_division =  json_encode($all_divisions);
		echo  $all_division;
	}




	
	
	public function edit_contact()
	{
		
		$uri = $this->uri->segment('3'); 
		
		if(isset($_REQUEST['submit'])) 
		{
			
			
			
			$uri = $this->uri->segment('3');
				
			$name  = xss_clean($this->input->post('name'));
			$designation  = xss_clean($this->input->post('designation'));
			$office_name  = xss_clean($this->input->post('office_name'));
			$email  = xss_clean($this->input->post('email'));
			$office_address  = xss_clean($this->input->post('office_address'));
			$landline_no  = xss_clean($this->input->post('landline_no'));
			$mobile_no  = xss_clean($this->input->post('mobile_no'));
			$division_name  = xss_clean($this->input->post('division_name'));
			$organization_name  = xss_clean($this->input->post('organization_name'));
			/*$role  = xss_clean($this->input->post('role'));*/
			$role  = '';
			
			$this->form_validation->set_rules('name','Name','trim|required');
			$this->form_validation->set_rules('designation','Designation','trim|required');
			$this->form_validation->set_rules('office_name','Office Name','trim|required');
			$this->form_validation->set_rules('email','Email Id','trim|required');
			$this->form_validation->set_rules('office_address','Office Address','trim|required');
			$this->form_validation->set_rules('mobile_no','Mobile No','trim|required');
			$this->form_validation->set_rules('landline_no','Landline No','trim|required');
			//$this->form_validation->set_rules('division_name','Division Name','trim|required');
			//$this->form_validation->set_rules('role','Role','trim|required');
			
				if($this->form_validation->run() === false) 
					{
				
					$data['contact_detail'] = $this->Base_model->get_all_record_by_condition('employees',array('EMPLOYEE_ID' => $uri));
					$data['all_divisions'] = $this->Base_model->get_all_record_by_condition('division',NULL);
					$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
					$data['all_org'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
						$this->load->view('admin/header');
					    $this->load->view('admin/sidebar');
					    $this->load->view('admin/contacts/editcontact',$data);
					    $this->load->view('admin/footer');
					
					}//ends if

					else
					{
						
						
							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s"); 

					
		                    $update_data = array(
									'FULLENAME' 	    => $name,
									'ORGANIZATION_ID' 	=> $organization_name,
									'DIVISION_ID' 	    => $division_name,
									'DESIGNATION' 	    => $designation,
									'OFFICENAME' 	    => $office_name,
									'EMAIL' 	        => $email,
									
									'MOBILE' 	        => $mobile_no,
									'LANDLINE_NO' 	    => $landline_no,
									'STATUS' 	        => 1,
									'CREATEDDATE' 	    => $created_date,
									'LASTMODIFIED'   	=> $created_date,
									'OFFICE_ADDRESS' 	=> $office_address
								);

								
							$updateid = $this->Base_model->update_record_by_id('employees', $update_data, array('EMPLOYEE_ID'=> $uri));

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
												'ACTIVITY' 		=> $this->session->userdata('user_name').' updated contact : '.$name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

 								/*********ends logs code*******/

								$msg = "Contact updated successfully.";
								$this->session->set_flashdata('flashSuccess_contact',$msg);
								$all_contacts = $this->Base_model->get_all_record_by_condition('employees',array('status'=>1));
								usort($all_contacts, function($firstrow, $secondrow){
					
											$firstrow = $firstrow->ROLE;
											$secondrow = $secondrow->ROLE;
											if ($firstrow == $secondrow) {
													return 0;
											}
											return ($firstrow < $secondrow) ? -1 : 1;
										});
								$data['all_contacts'] = $all_contacts;
								$data['all_divisions'] = $this->Base_model->get_all_record_by_condition('division',NULL);
								$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
								$data['all_org'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
						       $this->load->view('admin/header');
					            $this->load->view('admin/sidebar');
					           $this->load->view('admin/contacts/contactlist',$data);
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
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update contact : '.$name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

 								/*********ends logs code*******/

								$msg = "Fail to update contact";
								$this->session->set_flashdata('flashError_contact', $msg);
								$data['contact_detail'] = $this->Base_model->get_record_by_id('employees',array('EMPLOYEE_ID' => $uri));
								$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
						       $this->load->view('admin/header');
					            $this->load->view('admin/sidebar');
					           $this->load->view('admin/contacts/editcontact',$data);
					            $this->load->view('admin/footer');
							}//ends else
						
					}//ends main else
		}//ends if

		else
		{
				$uri = $this->uri->segment('3');
				$data['contact_detail'] = $this->Base_model->get_record_by_id('employees',array('EMPLOYEE_ID' => $uri));
				$data['all_divisions'] = $this->Base_model->get_all_record_by_condition('division',NULL);
				$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
				$data['all_org'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
			    $this->load->view('admin/contacts/editcontact',$data);
				$this->load->view('admin/footer');
		}//ends else
		
	}
	
	public function delete_contacts(){
		
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

             $data['post_data'] = $post_data =  $this->Base_model->get_record_by_id('employees', array('EMPLOYEE_ID' => $delete_itemId));			
			
			$update_data = array(
					'FULLENAME' 	    => $post_data->FULLENAME,
					'ORGANIZATION_ID' 	=> $post_data->ORGANIZATION_ID,
					'DIVISION_ID' 	    => $post_data->DIVISION_ID,
					'DESIGNATION' 	    => $post_data->DESIGNATION,
					'OFFICENAME' 	    => $post_data->OFFICENAME,
					'EMAIL' 	        => $post_data->EMAIL,
					'MOBILE' 	        => $post_data->MOBILE,
					'LANDLINE_NO' 	    => $post_data->LANDLINE_NO,
					'STATUS' 	        => 0,
					'CREATEDDATE' 	    => $created_date,
					'LASTMODIFIED'   	=> $created_date,
					'OFFICE_ADDRESS' 	=> $post_data->OFFICE_ADDRESS
				);
							
			$updateid = $this->Base_model->update_record_by_id('employees', $update_data, array('EMPLOYEE_ID'=> $delete_itemId));
				/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> $this->session->userdata('user_role'),
												'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' delete contact of : '.$post_data->FULLENAME,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

 								/*********ends logs code*******/

			$msg = "Contact deleted successfully.";
			$this->session->set_flashdata('flashSuccess_contact',$msg);					
			$all_contacts= $this->Base_model->get_all_record_by_condition('employees',array('status'=>1));
			usort($all_contacts, function($firstrow, $secondrow){

						$firstrow = $firstrow->FULLENAME;
						$secondrow = $secondrow->FULLENAME;
						if ($firstrow == $secondrow) {
								return 0;
						}
						return ($firstrow < $secondrow) ? -1 : 1;
					});
			
			$data['all_contacts'] = $all_contacts;
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/contacts/contactlist',$data);
			$this->load->view('admin/footer');
			}// ends else session check
		   
		
	}// ends function
	
	
	public function view_contact(){
		
		$uri = $this->uri->segment('3');
		$data['contact_detail'] = $this->Base_model->get_record_by_id('employees', array('EMPLOYEE_ID' => $uri));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/contacts/viewcontact',$data);
		$this->load->view('admin/footer');
		
	}
	

	 public function all_divisions()
	{
		
		$org_id = $this->input->post('id');
		$all_divisions =  $this->Base_model->get_all_record_by_condition('division', array('ORGANIZATION_ID'=>$org_id,'status'=>1));
		
		$all_divisions =  json_encode($all_divisions);
		echo  $all_divisions;
	}
	 

	     public function search_contact()
	     {
			if(isset($_REQUEST['submit'])){
				
			$user_name = xss_clean($this->input->post('name'));
			$designation = xss_clean($this->input->post('designation'));
            $organization = xss_clean($this->input->post('organization'));
            $division = xss_clean($this->input->post('division'));

            if($organization =='All')
            {
            	$organization = '';
            }

            else
            {
            	$organization = $organization;
            }

            if($division =='All')
            {
            	$division = '';
            }

            else
            {
            	$division = $division;
            }
			

				$all_contacts = $this->Base_model->search_contact($user_name,$designation,$organization,$division);
			
				usort($all_contacts, function($firstrow, $secondrow){

							$firstrow = $firstrow->ROLE;
							$secondrow = $secondrow->ROLE;
							if ($firstrow == $secondrow) {
									return 0;
							}
							return ($firstrow < $secondrow) ? -1 : 1;
						});

					$data['all_contacts'] = $all_contacts;
					$data['all_organizations'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
					
					$data['insertData'] = array(
						'name' 			=> xss_clean($this->input->post('name')),
						'designation' 	=> xss_clean($this->input->post('designation')),
						'organization' 	=> xss_clean($this->input->post('organization')),
						'division' 		=> xss_clean($this->input->post('division')),
						
					);
				    $this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/contacts/contactlist',$data);
					$this->load->view('admin/footer');
			
			
		}

		else
		{

				$all_contacts = $this->Base_model->get_all_record_by_condition('employees',array('status'=>1));
				$data['all_organizations'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
				$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);

				usort($all_contacts, function($firstrow, $secondrow){
						
							$firstrow = $firstrow->ROLE;
							$secondrow = $secondrow->ROLE;
							if ($firstrow == $secondrow) {
									return 0;
							}
							return ($firstrow < $secondrow) ? -1 : 1;
						});
				$data['all_contacts'] = $all_contacts;
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/contacts/contactlist',$data);
				$this->load->view('admin/footer');	
		}
		
	  }
	
	
}
