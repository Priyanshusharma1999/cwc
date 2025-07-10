<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
		$filter_date = date('Y-m-d', strtotime('+8 months'));
		$session_id = $this->session->userdata('applicant_user_id');

		date('d/m/Y', strtotime('+2 months'));

		/**********super admin*************/

		$data['superadmin_pension_pending'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_STATUS' => 'Pending','DELETES'=>0));
		$data['superadmin_pension_settled'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_STATUS' => 'Settled','DELETES'=>0));
		$data['superadmin_pension_ppo_empty'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PPO_NO' => NULL,'DELETES'=>0));
		$data['superadmin_pension_pending_pao'] = $this->Base_model->get_record_pensionrecordstatusdashboard();
		$data['superadmin_pension_retired_employee'] = $this->Base_model->get_expiry_employee($filter_date,NULL);
		$data['superadmin_pension_paper_submit_status'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_PAPER_SUBMIT_STATUS' => 'No','DELETES'=>0));

		
		/************pao admin***********************/

		$data['pao_admin_pension_pending'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_STATUS' => 'Pending','MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));
		$data['pao_admin_pension_settled'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_STATUS' => 'Settled','MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));
		$data['pao_admin_pension_ppo_empty'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PPO_NO' => NULL,'MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));
		$data['pao_admin_pension_pending_pao'] = $this->Base_model->get_record_pensionrecordstatusdashboard2($session_id);
		$data['pao_admin_pension_paper_submit_status'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_PAPER_SUBMIT_STATUS' => 'No','DELETES'=>0));
		$data['pao_admin_pension_retired_employee'] = $this->Base_model->get_expiry_employee($filter_date,$session_id);	

		/***************division*************/

		$data['division_admin_pension_pending'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_STATUS' => 'Pending','MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));
		$data['division_admin_pension_settled'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_STATUS' => 'Settled','MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));
		$data['division_admin_pension_ppo_empty'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PPO_NO' => NULL,'MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));
		$data['division_admin_pension_pending_pao'] = $this->Base_model->get_record_pensionrecordstatusdashboard2($session_id);
		$data['division_admin_pension_retired_employee'] = $this->Base_model->get_expiry_employee($filter_date,$session_id);
		$data['division_admin_pension_paper_submit_status'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_PAPER_SUBMIT_STATUS' => 'No','MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));

		/************organisation*************/

		$check_pendingPension = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));

		if(empty($check_pendingPension))
		{
			$data['organisation_admin_pension_pending'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_STATUS' => 'Pending','MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));

			$data['organisation_certificate'] = '';
		}

		else
		{
			$check_pendingrecords_orgn = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_STATUS' => 'Pending','MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));

			$user_data = $this->Base_model->get_record_by_id('users', array('USERS_ID' => $session_id));
			$orgn_data = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $user_data->ORGANIZATION_ID));

			if(count($check_pendingrecords_orgn)==0)
			{
				$data['organisation_admin_pension_pending'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_STATUS' => 'Pending','MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));

				$data['organisation_certificate'] = 'Generate_Certificate';
			}

			else
			{
				$data['organisation_admin_pension_pending'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_STATUS' => 'Pending','MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));

				$data['organisation_certificate'] = '';
			}
			
		}
		$data['user_name']  = $user_data->FULLNAME;
		$data['organisation_name']  = $orgn_data->ORGNAME;
		$data['organisation_admin_pension_settled'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_STATUS' => 'Settled','MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));
		$data['organisation_admin_pension_ppo_empty'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PPO_NO' => NULL,'MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));
		$data['organisation_admin_pension_pending_pao'] = $this->Base_model->get_record_pensionrecordstatusdashboard2($session_id);
		$data['organisation_admin_pension_retired_employee'] = $this->Base_model->get_expiry_employee($filter_date,$session_id);
 		$data['organisation_admin_pension_paper_submit_status'] = $this->Base_model->get_all_record_by_condition('pensrecoinfo',array('PENSION_PAPER_SUBMIT_STATUS' => 'No','MODIFIEDBY_ID'=>$session_id,'DELETES'=>0));

 		$user_data = $this->Base_model->get_record_by_id('users', array('USERS_ID' => $session_id));

 		if($user_data->ORGANIZATION_ID)
 		{
 			$all_pension_data = $this->Base_model->get_all_record_by_condition('division',array('ORGANIZATION_ID'=>$user_data->ORGANIZATION_ID, 'status'=>1));
 		}

 		else
 		{
 			$all_pension_data = $this->Base_model->get_all_record_by_condition('division',NULL);
 		}
 		
		

		$total_division = array();
		foreach ($all_pension_data as  $pension) 
		{
			$division_data = $this->Base_model->get_record_by_id('division', array('DIVISION_ID' => $pension->DIVISION_ID));
	
			$count_records=$this->Base_model->get_all_record_by_condition('pensrecoinfo',array('DIVIS_DEAL_NAME'=>$pension->DIVISION_ID,'DELETES'=>0));

			
			$hh['count'] = count($count_records);
			$hh['division_name'] = $division_data->DIVISIONNAME;
			$total_division[] = $hh;
		}
		
		$alluser_data = $this->Base_model->get_record_by_id('users', array('USERS_ID' => $this->session->userdata('applicant_user_id')));
		$org_data = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' =>$alluser_data->ORGANIZATION_ID));

		if($alluser_data->DIVISION_ID==0)
		{
			$dvsn_name = '';
		}

		else
		{
			$div_data = $this->Base_model->get_record_by_id('division', array('DIVISION_ID' =>$alluser_data->DIVISION_ID));
			$dvsn_name = $div_data->DIVISIONNAME;

		}
		
		$data['organisation_name']  = $org_data->ORGNAME;
		$data['user_division_name'] = $dvsn_name;
		$data['total_division'] = array_filter($total_division);
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/dashboard',$data);
		$this->load->view('admin/footer');

		}//ends else


		
	
	}
	
	
	public function profile()
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
			$data['user_data']= $userdata = $this->Base_model->get_record_by_id('users', array('USERS_ID' => $uri));
			$data['org_name'] = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $userdata->ORGANIZATION_ID));
			$data['div_name'] = $this->Base_model->get_record_by_id('division', array('DIVISION_ID' => $userdata->DIVISION_ID));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/profile',$data);
			$this->load->view('admin/footer');
		}
		
	}



	public function edit_profile()
	{
		
		$uri = $this->uri->segment('3'); 
		$session_userid = $this->session->userdata('applicant_user_id');
		
		if($session_userid!=$uri)
		{
			$base_url = base_url();
			redirect($base_url.'Frontend/logout');
		}

		else
		{
			if(isset($_REQUEST['submit'])) 
		{
			
			$fullname  = xss_clean($this->input->post('full_name'));
			$mobile  = xss_clean($this->input->post('mobile_no'));
			$email  = xss_clean($this->input->post('email'));
			$orgname  = xss_clean($this->input->post('organization_name'));
			$divname  = xss_clean($this->input->post('division_name'));
			$username  = xss_clean($this->input->post('user_name'));
			$password  = xss_clean($this->input->post('password'));
			$old_password  = xss_clean($this->input->post('old_password'));
			$con_password  = xss_clean($this->input->post('con_password'));
			$role  = xss_clean($this->input->post('role'));
			
			$this->form_validation->set_rules('full_name','Full Name','trim|required');
			$this->form_validation->set_rules('mobile_no','Mobile No','trim|required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('user_name','User Name','trim|required');
			$this->form_validation->set_rules('role','Role Name','trim|required');

			
				if($this->form_validation->run() === false) 
					{
				
				        $uri = $this->uri->segment('3');
						$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('USERS_ID' => $uri));
						$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
						$data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',NULL);
						$data['division_data'] = $this->Base_model->get_all_record_by_condition('division', NULL);
						
						$this->load->view('admin/header');
					    $this->load->view('admin/sidebar');
					    $this->load->view('admin/editprofile',$data);
					    $this->load->view('admin/footer');
					
					} else if(empty($password && $con_password)){
						
						     $uri = $this->uri->segment('3');
							 $data['user_detail'] = $user = $this->Base_model->get_record_by_id('users',array('USERS_ID' => $uri));
							 
						     $blankpassword = $user->PASSWORD;
							 
							 
						    /***********File upload code*******/
								$user_id =  $this->session->userdata('applicant_user_id'); 
								$user_name = $this->session->userdata('applicant_username');
								$pic_name = $user_name.'_'.$user_id.'_'.time().'_photo_';
								
								if($_FILES['applicant_pic']['name'])
								{
								  $configg = array(
											 'upload_path' => "./uploads/applicant_profile_photos/",
											 'allowed_types' => "jpg|png|jpeg|",
											 'overwrite' => TRUE,
											 'max_size' => "4096000", 
											 'file_name' => $pic_name.$_FILES["applicant_pic"]['name'],
											 );              
								   $this->load->library('upload', $configg);
								   $this->upload->initialize($configg);
								   $img_namee= $_FILES['applicant_pic']['name'];
								   $pic['item_image']= $img_namee;
								   $this->load->library('upload',$configg);
								   $this->upload->initialize($configg);
								   if($this->upload->do_upload('applicant_pic'))
								  {  
									 $file_data = $this->upload->data();  
									 $img_namee = $file_data['orig_name'];
									 $file_path ='uploads/applicant_profile_photos/'.$img_namee;
								  }

								  else
								  {
									$error=$this->upload->display_errors();   
								  }
								}

							/********Ends file upload code******/
						
						
							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s"); 
							$uri = $this->uri->segment('3'); 
						    $user  = $this->Base_model->get_record_by_id('users', array('USERS_ID' => $uri));
							
							if(empty($img_namee))
							{
									$img_name = $user->PROFILEIMG;
							}

							else
							{
									$img_name = $img_namee;
							}

					
		                    $update_data = array(
									'LOGONID' 	        => $username,
									'PASSWORD' 	        => empty($password) ? $blankpassword : $password,
									'ROLE_ID' 	        => $role,
									'FULLNAME' 	        => $fullname,
									'ORGANIZATION_ID' 	=> $orgname,
									'DIVISION_ID' 	    => $divname,
									'EMAIL' 	        => $email,
									'MOBILE' 	        => $mobile,
									'PROFILEIMG'        => $img_name,
									'STATUS' 	        => 1,
									'DELETES'           => 0,
									'CREATEDDATE' 	    => $created_date,
									'LASTSESSION'   	=> $created_date,
									'CLIENIP' 	=> $_SERVER['REMOTE_ADDR']
								);

								
							$updateid = $this->Base_model->update_record_by_id('users', $update_data, array('USERS_ID'=> $uri));

							if($updateid)
							{
								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> $this->session->userdata('user_role'),
												'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' updated his profile.',
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								$msg = "Profile updated successfully.";
								$this->session->set_flashdata('flashSuccess_profile',$msg);
								$data['all_users'] = $this->Base_model->get_all_record_by_condition('users',array('status'=>1,'DELETES'=>0));
						        redirect('admin/profile/'.$uri,$data);
							}

							else
							{
								
								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> $this->session->userdata('user_role'),
												'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').'failed to updated his profile.',
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								$msg = "Fail to update user";
								$this->session->set_flashdata('flashError_profileedit', $msg);
								$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('USERS_ID' => $uri));
								$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
						        $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',NULL);
						        $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', NULL);
						        $this->load->view('admin/header');
					            $this->load->view('admin/sidebar');
					            $this->load->view('admin/editprofile',$data);
					            $this->load->view('admin/footer');
							}//ends else
							 
					 } else if(!empty($password && $con_password)){
						
						$userss_data = $this->Base_model->get_record_by_id('users',array('USERS_ID' => $uri));
						$old_password  = xss_clean($this->input->post('old_password'));

					   if($password != $con_password){
								 $uri = $this->uri->segment('3');
								 $data['user_detail'] = $this->Base_model->get_record_by_id('users',array('USERS_ID' => $uri));
								 $data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
								 $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',NULL);
								 $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', NULL);
								 $msg = "Password and confirm password are not same";
								 $this->session->set_flashdata('flashError_profileedit', $msg);

								 /*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> $this->session->userdata('user_role'),
												'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').'failed to updated his profile password not match.',
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								 /*********ends logs code*******/

								 $this->load->view('admin/header');
								 $this->load->view('admin/sidebar');
								 $this->load->view('admin/editprofile',$data);
								 $this->load->view('admin/footer');
								 
						} else if($userss_data->PASSWORD != $old_password){
								 $uri = $this->uri->segment('3');
								 $data['user_detail'] = $this->Base_model->get_record_by_id('users',array('USERS_ID' => $uri));
								 $data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
								 $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',NULL);
								 $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', NULL);

								  /*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> $this->session->userdata('user_role'),
												'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').'failed to updated his profile ,old password not match.',
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								 /*********ends logs code*******/

								 $msg = "Old Password not matched.";
								 $this->session->set_flashdata('flashError_profileedit', $msg);
								 $this->load->view('admin/header');
								 $this->load->view('admin/sidebar');
								 $this->load->view('admin/editprofile',$data);
								 $this->load->view('admin/footer');
								 
						}
						else {
								
								
								/***********File upload code*******/
								$user_id =  $this->session->userdata('applicant_user_id'); 
								$user_name = $this->session->userdata('applicant_username');
								$pic_name = $user_name.'_'.$user_id.'_'.time().'_photo_';
								
								if($_FILES['applicant_pic']['name'])
								{
								  $configg = array(
											 'upload_path' => "./uploads/applicant_profile_photos/",
											 'allowed_types' => "jpg|png|jpeg|",
											 'overwrite' => TRUE,
											 'max_size' => "4096000", 
											 'file_name' => $pic_name.$_FILES["applicant_pic"]['name'],
											 );              
								   $this->load->library('upload', $configg);
								   $this->upload->initialize($configg);
								   $img_namee= $_FILES['applicant_pic']['name'];
								   $pic['item_image']= $img_namee;
								   $this->load->library('upload',$configg);
								   $this->upload->initialize($configg);
								   if($this->upload->do_upload('applicant_pic'))
								  {  
									 $file_data = $this->upload->data();  
									 $img_namee = $file_data['orig_name'];
									 $file_path ='uploads/applicant_profile_photos/'.$img_namee;
								  }

								  else
								  {
									$error=$this->upload->display_errors();   
								  }
								}

							/********Ends file upload code******/
						
						
							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s"); 
							$uri = $this->uri->segment('3'); 
						    $user  = $this->Base_model->get_record_by_id('users', array('USERS_ID' => $uri));
							
							if(empty($img_namee))
							{
									$img_name = $user->PROFILEIMG;
							}

							else
							{
									$img_name = $img_namee;
							}

							if($password == 'e3b0c44298fc1c149afbf4c8996fb92427ae41e4649b934ca495991b7852b855')
							{
								$password = $user->PASSWORD;
							}

							else
							{
								$password = $password;
							}
					
		                    $update_data = array(
									'LOGONID' 	        => $username,
									'PASSWORD' 	        => empty($password) ? $blankpassword : $password,
									'ROLE_ID' 	        => $role,
									'FULLNAME' 	        => $fullname,
									'ORGANIZATION_ID' 	=> $orgname,
									'DIVISION_ID' 	    => $divname,
									'EMAIL' 	        => $email,
									'MOBILE' 	        => $mobile,
									'PROFILEIMG'        => $img_name,
									'STATUS' 	        => 1,
									'DELETES'           => 0,
									'CREATEDDATE' 	    => $created_date,
									'LASTSESSION'   	=> $created_date,
									'CLIENIP' 	=> $_SERVER['REMOTE_ADDR']
								);

								
							$updateid = $this->Base_model->update_record_by_id('users', $update_data, array('USERS_ID'=> $uri));

							if($updateid)
							{
								
								$msg = "User updated successfully.";
								$this->session->set_flashdata('flashSuccess_profile',$msg);
								$data['all_users'] = $this->Base_model->get_all_record_by_condition('users',array('status'=>1,'DELETES'=>0));

								$user_id = $this->session->userdata('applicant_user_id');
								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $applicant_data[0]['FULLNAME'],
												'ROLE'			=> $applicant_data[0]['ROLE_ID'],
												'USEREMAIL' 	=> $applicant_data[0]['EMAIL'],
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $applicant_data[0]['FULLNAME'].' updated his profile.',
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								redirect('users/index/'.$user_id,$data);

						       // redirect('users',$data);
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
												'ACTIVITY' 		=> $this->session->userdata('user_name').'failed to updated his profile.',
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								 /*********ends logs code*******/
								$msg = "Fail to update user";
								$this->session->set_flashdata('flashError_profileedit', $msg);
								$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('USERS_ID' => $uri));
								$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
						        $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',NULL);
						        $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', NULL);
						        $this->load->view('admin/header');
					            $this->load->view('admin/sidebar');
					            $this->load->view('admin/editprofile',$data);
					            $this->load->view('admin/footer');
							}//ends else
								
						}
					 } else
						{
							
								$uri = $this->uri->segment('3');
								$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('USERS_ID' => $uri));
								$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
								$data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',NULL);
								$data['division_data'] = $this->Base_model->get_all_record_by_condition('division', NULL);
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/editprofile',$data);
								$this->load->view('admin/footer');
					}//ends else
									 

				
		}//ends if

		else
		{
				$uri = $this->uri->segment('3');
				$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('USERS_ID' => $uri));
				$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
				$data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',NULL);
		        $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', NULL);
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
			    $this->load->view('admin/editprofile',$data);
				$this->load->view('admin/footer');
		}//ends else
		}//ends else
		
		
	}//ends function

	
	
	
	
	
}
