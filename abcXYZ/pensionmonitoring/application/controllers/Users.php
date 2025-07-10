<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Users extends CI_Controller {

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
			
		 if(empty($this->session->userdata('applicant_user_id')) || ($this->session->userdata('user_role') != 1))
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
			$data['all_users'] = $this->Base_model->get_all_record_by_condition('users',array('DELETES'=>0));
			$data['all_organizations'] = $this->Base_model->getall_organizations();
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/user/userlist',$data);
			$this->load->view('admin/footer');
		}
			
	
	}
	
	
	public function addusers()
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
		
			$fullname  = xss_clean($this->input->post('full_name'));
			$mobile    = xss_clean($this->input->post('mobile_no'));
			$email     = xss_clean($this->input->post('email'));
			$orgname   = xss_clean($this->input->post('organization_name'));
			$divname   = xss_clean($this->input->post('division_name'));
			$username  = xss_clean($this->input->post('user_name'));
			$password  = xss_clean($this->input->post('password'));
			$con_password  = xss_clean($this->input->post('con_password'));
			$role  = xss_clean($this->input->post('role'));

			$finfo = new finfo(FILEINFO_MIME_TYPE);

        	$uploaded_file_name  = $_FILES['applicant_pic']['name'];
				
			$count_dots = substr_count($uploaded_file_name, '.');
			
			$this->form_validation->set_rules('full_name','full name','trim|required');
			$this->form_validation->set_rules('mobile_no','mobile no','trim|required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('email','email','trim|required|valid_email');
			$this->form_validation->set_rules('user_name','user name','trim|required');
			$this->form_validation->set_rules('password','password','trim|required');
			$this->form_validation->set_rules('con_password','confirm password','trim|required');
			$this->form_validation->set_rules('role','role name','trim|required');
		

			if($this->form_validation->run() === false) 
				{
					
					$data['insertData'] = array(
						'full_name' => xss_clean($this->input->post('full_name')),
						'mobile_no' => xss_clean($this->input->post('mobile_no')),
						'email' => xss_clean($this->input->post('email')),
						'organization_name' => xss_clean($this->input->post('organization_name')),
						'division_name' => xss_clean($this->input->post('division_name')),
						'user_name' => xss_clean($this->input->post('user_name')),
						'role' => xss_clean($this->input->post('role'))
					);
					
					 $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
		               $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', array('status' => 1));
					   
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/user/adduser',$data);
					$this->load->view('admin/footer');

				} else if($password != $con_password){
					
					$data['insertData'] = array(
						'full_name' => xss_clean($this->input->post('full_name')),
						'mobile_no' => xss_clean($this->input->post('mobile_no')),
						'email' => xss_clean($this->input->post('email')),
						'organization_name' => xss_clean($this->input->post('organization_name')),
						'division_name' => xss_clean($this->input->post('division_name')),
						'user_name' => xss_clean($this->input->post('user_name')),
						'role' => xss_clean($this->input->post('role'))
					);
					
					 $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
		               $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', array('status' => 1));
					
					/*********logs code*******/

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('user_name'),
									'ROLE'			=> $this->session->userdata('user_role'),
									'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logged in',
									'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user '.xss_clean($this->input->post('full_name')).'password and confirm password are not same',
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);
					$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 /*********ends logs code*******/

					$msg = "Password and confirm password are not same";
					$this->session->set_flashdata('flashError_user', $msg);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/user/adduser',$data);
					$this->load->view('admin/footer');

				} else if($count_dots > 1){
                          
                         
                         $data['insertData'] = array(
						'full_name' => xss_clean($this->input->post('full_name')),
						'mobile_no' => xss_clean($this->input->post('mobile_no')),
						'email' => xss_clean($this->input->post('email')),
						'organization_name' => xss_clean($this->input->post('organization_name')),
						'division_name' => xss_clean($this->input->post('division_name')),
						'user_name' => xss_clean($this->input->post('user_name')),
						'role' => xss_clean($this->input->post('role'))
					);
					
					 $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
		               $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', array('status' => 1));
					
					/*********logs code*******/

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('user_name'),
									'ROLE'			=> $this->session->userdata('user_role'),
									'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logged in',
									'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user '.xss_clean($this->input->post('full_name')).'password and confirm password are not same',
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);
					$this->Base_model->insert_one_row('userlogs', $user_logs_data);

                          $msg = "Please select correct file.";
						$this->session->set_flashdata('flashError_user', $msg);
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/user/adduser',$data);
						$this->load->view('admin/footer');

				} else if(false === $ext = array_search(
				        
				        $finfo->file($_FILES['applicant_pic']['tmp_name']),
				        array(
				            'jpg' => 'image/jpeg',
				            'png' => 'image/png',
				        ),
				        true

				    )){

					$data['insertData'] = array(
						'full_name' => xss_clean($this->input->post('full_name')),
						'mobile_no' => xss_clean($this->input->post('mobile_no')),
						'email' => xss_clean($this->input->post('email')),
						'organization_name' => xss_clean($this->input->post('organization_name')),
						'division_name' => xss_clean($this->input->post('division_name')),
						'user_name' => xss_clean($this->input->post('user_name')),
						'role' => xss_clean($this->input->post('role'))
					);
					
					 $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
		               $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', array('status' => 1));
					
					/*********logs code*******/

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('user_name'),
									'ROLE'			=> $this->session->userdata('user_role'),
									'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logged in',
									'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user '.xss_clean($this->input->post('full_name')).'password and confirm password are not same',
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);
					$this->Base_model->insert_one_row('userlogs', $user_logs_data);

                          
                           $msg = "Please select correct file format.";
							$this->session->set_flashdata('flashError_user', $msg);
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/user/adduser',$data);
							$this->load->view('admin/footer');

				}

				else
				{
					
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

				$checked = $this->Base_model->check_existent('users', array('EMAIL'=> $email, 'DELETES'=>0));
				$checked1 = $this->Base_model->check_existent('users', array('MOBILE'=> $mobile, 'DELETES'=>0));
				$checked2 = $this->Base_model->check_existent('users', array('LOGONID'=> $username, 'DELETES'=>0));
					
					if($checked=='1')
					{
						
						$data['insertData'] = array(
						'full_name' => xss_clean($this->input->post('full_name')),
						'mobile_no' => xss_clean($this->input->post('mobile_no')),
						'email' => xss_clean($this->input->post('email')),
						'organization_name' => xss_clean($this->input->post('organization_name')),
						'division_name' => xss_clean($this->input->post('division_name')),
						'user_name' => xss_clean($this->input->post('user_name')),
						'role' => xss_clean($this->input->post('role'))
					);
					
					 $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
		              $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', array('status' => 1));
					   /*********logs code*******/

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('user_name'),
									'ROLE'			=> $this->session->userdata('user_role'),
									'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logged in',
									'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user '.xss_clean($this->input->post('full_name')).'email already exits',
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);
					$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 /*********ends logs code*******/
						$msg = "Email already exits, Please enter new one";
						$this->session->set_flashdata('flashError_user', $msg);
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/user/adduser', $data);
						$this->load->view('admin/footer');
						
					} else if($checked1=='1'){
						
						$data['insertData'] = array(
						'full_name' => xss_clean($this->input->post('full_name')),
						'mobile_no' => xss_clean($this->input->post('mobile_no')),
						'email' => xss_clean($this->input->post('email')),
						'organization_name' => xss_clean($this->input->post('organization_name')),
						'division_name' => xss_clean($this->input->post('division_name')),
						'user_name' => xss_clean($this->input->post('user_name')),
						'role' => xss_clean($this->input->post('role'))
					   );
					   
					    $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
		               $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', array('status' => 1));
					/*********logs code*******/

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('user_name'),
									'ROLE'			=> $this->session->userdata('user_role'),
									'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logged in',
									'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user '.xss_clean($this->input->post('full_name')).'mobile number already exits',
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);
					$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 /*********ends logs code*******/

						$msg = "Mobile No already exits, Please enter new one";
						$this->session->set_flashdata('flashError_user', $msg);
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/user/adduser', $data);
						$this->load->view('admin/footer');
						
					}  else if($checked2=='1'){
						
						$data['insertData'] = array(
						'full_name' => xss_clean($this->input->post('full_name')),
						'mobile_no' => xss_clean($this->input->post('mobile_no')),
						'email' => xss_clean($this->input->post('email')),
						'organization_name' => xss_clean($this->input->post('organization_name')),
						'division_name' => xss_clean($this->input->post('division_name')),
						'user_name' => xss_clean($this->input->post('user_name')),
						'role' => xss_clean($this->input->post('role'))
					   );
					   
					   $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
		               $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', array('status' => 1));
						/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('user_name'),
										'ROLE'			=> $this->session->userdata('user_role'),
										'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user '.xss_clean($this->input->post('full_name')).'user name already exits',
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);
						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 /*********ends logs code*******/


						$msg = "User Name already exits, Please enter new one";
						$this->session->set_flashdata('flashError_user', $msg);
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/user/adduser', $data);
						$this->load->view('admin/footer');
						
					}  

					else
					{
					  $insert_data = array(
									'LOGONID' 	        => $username,
									'PASSWORD' 	        => $password,
									//'PASSWORD' 	        => md5($password),
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
						$insertid = $this->Base_model->insert_one_row('users', $insert_data);

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
										'ACTIVITY' 		=> $this->session->userdata('user_name').' added user '.xss_clean($this->input->post('full_name')),
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);
						$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 	/*********ends logs code*******/

							$msg = "User added successfully.";
							$this->session->set_flashdata('flashSuccess_user',$msg);
							$data['all_users'] = $this->Base_model->get_all_record_by_condition('users',array('status'=>1,'DELETES'=>0));
							$user_id = $this->session->userdata('applicant_user_id');
							redirect('users/index/'.$user_id,$data);
							//redirect('users',$data);
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
											'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user '.xss_clean($this->input->post('full_name')),
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);
							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 	/*********ends logs code*******/

							$msg = "Fail to add User";
							$this->session->set_flashdata('flashError_user', $msg);
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/user/adduser');
							$this->load->view('admin/footer');
						}
					}
				}

		}

		else
		{
			
			$data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',array('delete_status' => 0));
		    $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', array('status' => 1));
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/user/adduser',$data);
			$this->load->view('admin/footer');

		}
		}// ends else session check

	   
	
	}
	
	
	public function all_organizations()
	{
		
		$org_id = $this->input->post('id');
		$all_organization =  $this->Base_model->get_all_record_by_condition('division', array('DIVISION_ID'=>$org_id));
	
		$org_data = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $all_organization[0]->ORGANIZATION_ID));
		
		$all_organizations =  json_encode($org_data);
		echo  $all_organizations;
	}

	
	public function all_divisions()
	{
		
		$org_id = $this->input->post('id');
		
		$division_data = $this->Base_model->get_all_record_by_condition('division', array('ORGANIZATION_ID' => $org_id,'status' => 1));
		
		$all_divisions =  json_encode($division_data);
		echo  $all_divisions;
	}

	
	
	public function edit_user()
	{
		
		$uri = $this->uri->segment('3'); 
		$user_encrypt_id = $this->uri->segment('4');
		$session_user_id = $this->session->userdata('applicant_user_id');
		

		if($user_encrypt_id!=$session_user_id)
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
			$con_password  = xss_clean($this->input->post('con_password'));
			$role  = xss_clean($this->input->post('role'));
			$status  = xss_clean($this->input->post('status'));
			
			$this->form_validation->set_rules('full_name','Full Name','trim|required');
			$this->form_validation->set_rules('mobile_no','Mobile No','trim|required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('email','Email','trim|required|valid_email');
			$this->form_validation->set_rules('user_name','User Name','trim|required');
			$this->form_validation->set_rules('role','Role Name','trim|required');

			$finfo = new finfo(FILEINFO_MIME_TYPE);

        	$uploaded_file_name  = $_FILES['applicant_pic']['name'];
				
			$count_dots = substr_count($uploaded_file_name, '.');
			
				if($this->form_validation->run() === false) 
					{
				
				        $uri = $this->uri->segment('3');
						$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('USERS_ID' => $uri));
						$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
						$data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',NULL);
						$data['division_data'] = $this->Base_model->get_all_record_by_condition('division', NULL);
						
						$this->load->view('admin/header');
					    $this->load->view('admin/sidebar');
					    $this->load->view('admin/user/edituser',$data);
					    $this->load->view('admin/footer');
					
					}  else if(empty($password && $con_password)){
						
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
									'STATUS' 	        => $status,
									'DELETES'           => 0,
									'CREATEDDATE' 	    => $created_date,
									'LASTSESSION'   	=> $created_date,
									'CLIENIP' 	=> $_SERVER['REMOTE_ADDR']
								);

								
							$updateid = $this->Base_model->update_record_by_id('users', $update_data, array('USERS_ID'=> $uri));

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
											'ACTIVITY' 		=> $this->session->userdata('user_name').' updated user '.$fullname,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);
							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 	/*********ends logs code*******/
								$msg = "User updated successfully.";
								$this->session->set_flashdata('flashSuccess_user',$msg);
								$data['all_users'] = $this->Base_model->get_all_record_by_condition('users',array('status'=>1,'DELETES'=>0));
								$user_id = $this->session->userdata('applicant_user_id');
								redirect('users/index/'.$user_id,$data);
						        //redirect('users',$data);
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
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update user '.$fullname,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 			/*********ends logs code*******/

								$msg = "Fail to update user";
								$this->session->set_flashdata('flashError_useredit', $msg);
								$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('USERS_ID' => $uri));
								$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
						        $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',NULL);
						        $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', NULL);
						        $this->load->view('admin/header');
					            $this->load->view('admin/sidebar');
					            $this->load->view('admin/user/edituser',$data);
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
								 /*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> $this->session->userdata('user_role'),
												'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update user '.$fullname.'password and confirm password are not same',
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 			/*********ends logs code*******/

								 $msg = "Password and confirm password are not same";
								 $this->session->set_flashdata('flashError_useredit', $msg);
								 $this->load->view('admin/header');
								 $this->load->view('admin/sidebar');
								 $this->load->view('admin/user/edituser',$data);
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
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update user '.$fullname.'old password not matched',
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 			/*********ends logs code*******/

								 $msg = "Old Password not matched";
								 $this->session->set_flashdata('flashError_useredit', $msg);
								 $this->load->view('admin/header');
								 $this->load->view('admin/sidebar');
								 $this->load->view('admin/user/edituser',$data);
								 $this->load->view('admin/footer');
								 
						}  else {
								
								
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
									'STATUS' 	        => $status,
									'DELETES'           => 0,
									'CREATEDDATE' 	    => $created_date,
									'LASTSESSION'   	=> $created_date,
									'CLIENIP' 	=> $_SERVER['REMOTE_ADDR']
								);

								
							$updateid = $this->Base_model->update_record_by_id('users', $update_data, array('USERS_ID'=> $uri));

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
												'ACTIVITY' 		=> $this->session->userdata('user_name').' updated user '.$fullname,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 			/*********ends logs code*******/
								$msg = "User updated successfully.";
								$this->session->set_flashdata('flashSuccess_user',$msg);
								$data['all_users'] = $this->Base_model->get_all_record_by_condition('users',array('status'=>1,'DELETES'=>0));
								$user_id = $this->session->userdata('applicant_user_id');
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
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update user '.$fullname,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 			/*********ends logs code*******/
								$msg = "Fail to update user";
								$this->session->set_flashdata('flashError_useredit', $msg);
								$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('USERS_ID' => $uri));
								$data['all_roles'] = $this->Base_model->get_all_record_by_condition('role',NULL);
						        $data['org_data'] = $this->Base_model->get_all_record_by_condition('organization',NULL);
						        $data['division_data'] = $this->Base_model->get_all_record_by_condition('division', NULL);
						        $this->load->view('admin/header');
					            $this->load->view('admin/sidebar');
					            $this->load->view('admin/user/edituser',$data);
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
								$this->load->view('admin/user/edituser',$data);
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
			    $this->load->view('admin/user/edituser',$data);
				$this->load->view('admin/footer');
		}//ends else

		}//ends else
		
		
	}//ends function
	
	public function delete_users(){
			
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
			
             $data['post_data'] = $post_data =  $this->Base_model->get_record_by_id('users', array('USERS_ID' => $delete_itemId));			
			
			$update_data = array(
					'LOGONID' 	        => $post_data->LOGONID,
					'PASSWORD' 	        => md5($post_data->PASSWORD),
					'ROLE_ID' 	        => $post_data->ROLE_ID,
					'FULLNAME' 	        => $post_data->FULLNAME,
					'ORGANIZATION_ID' 	=> $post_data->ORGANIZATION_ID,
					'DIVISION_ID' 	    => $post_data->DIVISION_ID,
					'EMAIL' 	        => $post_data->EMAIL,
					'MOBILE' 	        => $post_data->MOBILE,
					'STATUS' 	        => 1,
					'DELETES'           => 1,
					'CREATEDDATE' 	    => $created_date,
					'LASTSESSION'   	=> $created_date,
					'CLIENIP' 	=> $_SERVER['REMOTE_ADDR']
				);
							
			$updateid = $this->Base_model->update_record_by_id('users', $update_data, array('USERS_ID'=> $delete_itemId));
			/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> $this->session->userdata('user_role'),
												'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' delete user '.$post_data->FULLNAME,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					 			/*********ends logs code*******/
			$msg = "User deleted successfully.";
			$this->session->set_flashdata('flashSuccess_user',$msg);					
			$data['all_users'] = $this->Base_model->get_all_record_by_condition('users',array('status'=>1,'DELETES'=>0));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/user/userlist',$data);
			$this->load->view('admin/footer');
			}// ends else session check

		    
		
	}//ends function
	
	
	public function view_user(){
		
		$uri = $this->uri->segment('3');
		$data['user_detail'] = $user_detail = $this->Base_model->get_record_by_id('users', array('USERS_ID' => $uri));
		$data['org_data'] = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $user_detail->ORGANIZATION_ID));
		$data['division_data'] = $this->Base_model->get_record_by_id('division', array('DIVISION_ID' => $user_detail->DIVISION_ID));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/user/viewuser',$data);
		$this->load->view('admin/footer');
		
	}
	
	   public function search_user()
	     {
			if(isset($_REQUEST['submit'])){
					$user_name = xss_clean($this->input->post('name'));
					$org_name = xss_clean($this->input->post('org_name'));

					if($org_name== 'All')
					{
						$org_name = '';
					}

					else
					{
						$org_name = $org_name;	
					}
					$data['all_users'] = $this->Base_model->search_user($user_name,$org_name);
					$data['all_organizations'] = $this->Base_model->getall_organizations();
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/user/userlist',$data);
					$this->load->view('admin/footer');
			}
		
	      }

	
}
