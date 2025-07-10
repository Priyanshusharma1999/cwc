<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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

		 
			$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
			$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
			$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
			$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
			$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
			$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1,'approved_status'=>1));

			$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1,'approved_status'=>1));

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/user/userlist',$data);	
			$this->load->view('admin/footer');

	}//ends function

    
    public function Nonitusers()
	{

		    $uurrss = array();

			$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
			$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
			$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
			$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
			$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
			$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));

			 $accesss = $this->Base_model->get_all_record_by_condition('user_access', array('service_type'=>'1'));

			 foreach($accesss as $list){
                
              $uurrss[] = $this->Base_model->get_record_by_id('users', array('user_id'=>$list->user_id,'delete_status'=>1));

			}


			 $data['all_user'] = array_filter($uurrss);

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/user/nonituserlist',$data);	
			$this->load->view('admin/footer');

	}//ends function

	public function Itusers()
	{

		    $uurrss = array();

			$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
			$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
			$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
			$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
			$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
			$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));

			 $accesss = $this->Base_model->get_all_record_by_condition('user_access', array('service_type'=>'2'));

			// $users = array_unique($accesss);

			 foreach($accesss as $list){
                
              $uurrss[] = $this->Base_model->get_record_by_id('users', array('user_id'=>$list->user_id,'delete_status'=>1));

			}


			 $data['all_user'] = array_filter($uurrss);

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/user/ituserlist',$data);	
			$this->load->view('admin/footer');

	}//ends function

	/***************function for add user***************/

	public function add_user()
	{	
	  
	  if(isset($_REQUEST['submit'])) 
	  {
			
		$user_role  	  	 		= xss_clean($this->input->post('user_role'));
		$user_access  	  	 		= xss_clean($this->input->post('user_access'));
		$reqmonth  	  	 		    = xss_clean($this->input->post('reqmonth'));
		$employee_id  				= xss_clean(strip_tags($this->input->post('user_name')));
		$display_name  				= xss_clean(strip_tags($this->input->post('display_name')));
		$designation_name  		= xss_clean(strip_tags($this->input->post('designation_name')));
		$contact_no  	  	 		= xss_clean(strip_tags($this->input->post('contact_no')));
		$email  	  	 				= xss_clean(strip_tags($this->input->post('email')));
		$wing_name  	  	 		= xss_clean(strip_tags($this->input->post('wing_name')));
		$section_name 				= xss_clean(strip_tags($this->input->post('section_name')));
		$building_name  	  	= xss_clean(strip_tags($this->input->post('building_name')));
		$room_id  	  	 			= xss_clean(strip_tags($this->input->post('room_id')));
		$user_id  	  	 			= xss_clean(strip_tags($this->input->post('user_id')));
		$password  	  	 			= xss_clean(strip_tags($this->input->post('password')));
		$cnfrm_password  	  	= xss_clean(strip_tags($this->input->post('cnfrm_password')));
		$show_telephone  	  	= xss_clean(strip_tags($this->input->post('show_telephone')));

		$finfo = new finfo(FILEINFO_MIME_TYPE);
		$uploaded_file_name  = $_FILES['user_image']['name'];
		$count_dots = substr_count($uploaded_file_name, '.');


				if($password != $cnfrm_password)
				{
						$msg = "Password and confirm password not match.";
						$this->session->set_flashdata('flashError_user', $msg);

						/*********logs code*******/

							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							$user_logs_data = array(
											'USERNAME' 	    => $this->session->userdata('user_name'),
											'ROLE'			=> '',
											'USEREMAIL' 	=> $this->session->userdata('user_email'),
											'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
											'LOGINSTATUS' 	=> 'Logged in',
											'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user, password not match :'.$display_name,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);

							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					/*********ends logs code*******/

						$data['insertData'] = array(
							'user_role' => xss_clean(strip_tags($this->input->post('user_role'))),
							'user_name' => xss_clean(strip_tags($this->input->post('user_name'))),
							'display_name' => xss_clean(strip_tags($this->input->post('display_name'))),
							'designation_name' => xss_clean(strip_tags($this->input->post('designation_name'))),
							'contact_no' => xss_clean(strip_tags($this->input->post('contact_no'))),
							'email' => xss_clean(strip_tags($this->input->post('email'))),
							'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
							'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
							'room_id' => xss_clean(strip_tags($this->input->post('room_id'))),
							'user_id' => xss_clean(strip_tags($this->input->post('user_id'))),
							'password' => xss_clean(strip_tags($this->input->post('password'))),
							'cnfrm_password' => xss_clean(strip_tags($this->input->post('cnfrm_password'))),
							'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
						);

						$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
						$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
						$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
						$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
						$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
						$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
						
						$data['all_employee'] = $this->Base_model->get_emp_for_users();

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/user/adduser',$data);	
						$this->load->view('admin/footer');
				}//ends if

				else if($count_dots > 1)
				{

					$msg = "Please upload correct file.";
						$this->session->set_flashdata('flashError_user', $msg);

						/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user, upload incorrect file :'.$display_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

						$data['insertData'] = array(
							'user_role' => xss_clean(strip_tags($this->input->post('user_role'))),
							'user_name' => xss_clean(strip_tags($this->input->post('user_name'))),
							'display_name' => xss_clean(strip_tags($this->input->post('display_name'))),
							'designation_name' => xss_clean(strip_tags($this->input->post('designation_name'))),
							'contact_no' => xss_clean(strip_tags($this->input->post('contact_no'))),
							'email' => xss_clean(strip_tags($this->input->post('email'))),
							'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
							'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
							'room_id' => xss_clean(strip_tags($this->input->post('room_id'))),
							'user_id' => xss_clean(strip_tags($this->input->post('user_id'))),
							'password' => xss_clean(strip_tags($this->input->post('password'))),
							'cnfrm_password' => xss_clean(strip_tags($this->input->post('cnfrm_password'))),
							'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
						);

						$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
						$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
						$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
						$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
						$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
						$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
						
						$data['all_employee'] = $this->Base_model->get_emp_for_users();

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/user/adduser',$data);	
						$this->load->view('admin/footer');

				}// ends else if

				else if((false === $ext = array_search(
				        
				        $finfo->file($_FILES['user_image']['tmp_name']),
				        array(
				            'jpg' => 'image/jpeg',
				            'png' => 'image/png',
				            'gif' => 'image/gif',
				        ),
				        true

				     )) && $_FILES['user_image']['name'])
				{

					$msg = "Please upload correct file.";
						$this->session->set_flashdata('flashError_user', $msg);

						/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user, upload incorrect file :'.$display_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

						$data['insertData'] = array(
							'user_role' => xss_clean(strip_tags($this->input->post('user_role'))),
							'user_name' => xss_clean(strip_tags($this->input->post('user_name'))),
							'display_name' => xss_clean(strip_tags($this->input->post('display_name'))),
							'designation_name' => xss_clean(strip_tags($this->input->post('designation_name'))),
							'contact_no' => xss_clean(strip_tags($this->input->post('contact_no'))),
							'email' => xss_clean(strip_tags($this->input->post('email'))),
							'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
							'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
							'room_id' => xss_clean(strip_tags($this->input->post('room_id'))),
							'user_id' => xss_clean(strip_tags($this->input->post('user_id'))),
							'password' => xss_clean(strip_tags($this->input->post('password'))),
							'cnfrm_password' => xss_clean(strip_tags($this->input->post('cnfrm_password'))),
							'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
						);

						$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
						$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
						$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
						$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
						$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
						$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
						
						$data['all_employee'] = $this->Base_model->get_emp_for_users();

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/user/adduser',$data);	
						$this->load->view('admin/footer');

				}// ends else if


				else
				{
							$this->form_validation->set_rules('user_role[]','user role','trim|required');
							$this->form_validation->set_rules('user_name','user name','trim|required');
							$this->form_validation->set_rules('display_name','display name','trim|required');
							$this->form_validation->set_rules('designation_name','designation','trim|required');
							$this->form_validation->set_rules('contact_no','contact no','trim|required');
							$this->form_validation->set_rules('email','email','trim|required');
							$this->form_validation->set_rules('wing_name','wing name','trim|required');
							$this->form_validation->set_rules('section_name','section name','trim|required');
							$this->form_validation->set_rules('building_name','building name','trim|required');
							$this->form_validation->set_rules('room_id','room','trim|required');
							$this->form_validation->set_rules('user_id','user id','trim|required');
							$this->form_validation->set_rules('password','password','trim|required');
							$this->form_validation->set_rules('cnfrm_password','confirm password','trim|required');
			

				if($this->form_validation->run() === false) 
				{
						
						$data['insertData'] = array(
							'user_role' => xss_clean(strip_tags($this->input->post('user_role'))),
							'user_name' => xss_clean(strip_tags($this->input->post('user_name'))),
							'display_name' => xss_clean(strip_tags($this->input->post('display_name'))),
							'designation_name' => xss_clean(strip_tags($this->input->post('designation_name'))),
							'contact_no' => xss_clean(strip_tags($this->input->post('contact_no'))),
							'email' => xss_clean(strip_tags($this->input->post('email'))),
							'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
							'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
							'room_id' => xss_clean(strip_tags($this->input->post('room_id'))),
							'user_id' => xss_clean(strip_tags($this->input->post('user_id'))),
							'password' => xss_clean(strip_tags($this->input->post('password'))),
							'cnfrm_password' => xss_clean(strip_tags($this->input->post('cnfrm_password'))),
							'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
						);

						$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
						$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
						$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
						$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
						$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
						$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
						
						$data['all_employee'] = $this->Base_model->get_emp_for_users();

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/user/adduser',$data);	
						$this->load->view('admin/footer');
				}//ends if

				else
				{
							$user_role  	  	 		= xss_clean($this->input->post('user_role'));
							$user_access  	  	 		= xss_clean($this->input->post('user_access'));
							$reqmonth  	  	 		    = xss_clean($this->input->post('reqmonth'));
							$employee_id  				= xss_clean(strip_tags($this->input->post('user_name')));
							$display_name  				= xss_clean(strip_tags($this->input->post('display_name')));
							$designation_name  		= xss_clean(strip_tags($this->input->post('designation_name')));
							$contact_no  	  	 		= xss_clean(strip_tags($this->input->post('contact_no')));
							$email  	  	 				= xss_clean(strip_tags($this->input->post('email')));
							$wing_name  	  	 		= xss_clean(strip_tags($this->input->post('wing_name')));
							$section_name 				= xss_clean(strip_tags($this->input->post('section_name')));
							$building_name  	  	= xss_clean(strip_tags($this->input->post('building_name')));
							$room_id  	  	 			= xss_clean(strip_tags($this->input->post('room_id')));
							$user_id  	  	 			= xss_clean(strip_tags($this->input->post('user_id')));
							$password  	  	 			= xss_clean(strip_tags($this->input->post('password')));
							$cnfrm_password  	  	= xss_clean(strip_tags($this->input->post('cnfrm_password')));
							$show_telephone  	  	= xss_clean(strip_tags($this->input->post('show_telephone')));
							$ip_address						= $_SERVER['REMOTE_ADDR'];
							$session_id 					= $this->session->userdata('user_id');
							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							$employee_data =  $this->Base_model->get_record_by_id('employee', array('employee_id'=>$employee_id,'delete_status'=>1));
							$user_name = $employee_data->employee_name;
							
							if(empty($show_telephone))
							{
								$show_telephone = '0';
							}

							else
							{
								$show_telephone = $show_telephone;
							}

							/***********uploaded_photo**********/

									if($_FILES['user_image']['name'])
		                {
		                  $configg = array(
		                             'upload_path' => "./uploads/users/",
		                             'allowed_types' => "jpg|png|jpeg|",
		                             'overwrite' => TRUE,
		                             'max_size' => "4096000", 
		                             'file_name' => $_FILES["user_image"]['name'],
		                             );              
		                   $this->load->library('upload', $configg);
		                   $this->upload->initialize($configg);
		                   $img_namee= $_FILES['user_image']['name'];//echo "djdjjd";echo $img_namee;
		                   $pic['item_image']= $img_namee;
		                   $this->load->library('upload',$configg);
		               	   $this->upload->initialize($configg);
		                   if($this->upload->do_upload('user_image'))
		                  {  
		                     $file_data = $this->upload->data();  
		                     $img_namee = $file_data['orig_name'];
		                     $file_path ='uploads/users/'.$img_namee;
		                  }

		                  else
		                  {
		                    $error=$this->upload->display_errors();   
		                  }
		                }
		               $img_name 	  	= str_replace(' ','_', $img_namee);
		                /*******Ends uploaded_photo*******/ 

							/*****check condition********/

								$checked_user_login_id = $this->Base_model->check_existent('users', array('login_id'=> $user_id,'delete_status'=>1));

								$checked_user_email = $this->Base_model->check_existent('users', array('email'=> $email,'delete_status'=>1));

							/*****ends check condition*****/

								if($checked_user_login_id=='1')
								{
										$msg = "User id already exits, Please enter new one";
										$this->session->set_flashdata('flashError_user', $msg);

										/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user, already exits :'.$display_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

										$data['insertData'] = array(
											'user_role' => xss_clean(strip_tags($this->input->post('user_role'))),
											'user_name' => xss_clean(strip_tags($this->input->post('user_name'))),
											'display_name' => xss_clean(strip_tags($this->input->post('display_name'))),
											'designation_name' => xss_clean(strip_tags($this->input->post('designation_name'))),
											'contact_no' => xss_clean(strip_tags($this->input->post('contact_no'))),
											'email' => xss_clean(strip_tags($this->input->post('email'))),
											'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
											'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
											'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
											'room_id' => xss_clean(strip_tags($this->input->post('room_id'))),
											'user_id' => xss_clean(strip_tags($this->input->post('user_id'))),
											'password' => xss_clean(strip_tags($this->input->post('password'))),
											'cnfrm_password' => xss_clean(strip_tags($this->input->post('cnfrm_password'))),
											'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
										);

										$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
										$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
										$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
										$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
										$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
										$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
										$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
										
										$data['all_employee'] = $this->Base_model->get_emp_for_users();

										$this->load->view('admin/header');
										$this->load->view('admin/sidebar');
										$this->load->view('admin/admin_management/user/adduser',$data);	
										$this->load->view('admin/footer');	
								}//ends if

								else if($checked_user_email=='1')
								{
										$msg = "Email already exits, Please enter new one";
										$this->session->set_flashdata('flashError_user', $msg);

										/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user, email already exits :'.$display_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

										$data['insertData'] = array(
											'user_role' => xss_clean(strip_tags($this->input->post('user_role'))),
											'user_name' => xss_clean(strip_tags($this->input->post('user_name'))),
											'display_name' => xss_clean(strip_tags($this->input->post('display_name'))),
											'designation_name' => xss_clean(strip_tags($this->input->post('designation_name'))),
											'contact_no' => xss_clean(strip_tags($this->input->post('contact_no'))),
											'email' => xss_clean(strip_tags($this->input->post('email'))),
											'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
											'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
											'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
											'room_id' => xss_clean(strip_tags($this->input->post('room_id'))),
											'user_id' => xss_clean(strip_tags($this->input->post('user_id'))),
											'password' => xss_clean(strip_tags($this->input->post('password'))),
											'cnfrm_password' => xss_clean(strip_tags($this->input->post('cnfrm_password'))),
											'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
										);

										$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
										$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
										$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
										$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
										$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
										$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
										$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
										
										$data['all_employee'] = $this->Base_model->get_emp_for_users();

										$this->load->view('admin/header');
										$this->load->view('admin/sidebar');
										$this->load->view('admin/admin_management/user/adduser',$data);	
										$this->load->view('admin/footer');	
								}//ends if

								else
								{
									$user_role  	  	 		= xss_clean($this->input->post('user_role'));
									$user_access  	  	 		= xss_clean($this->input->post('user_access'));
									$reqmonth  	  	 		    = xss_clean($this->input->post('reqmonth'));
									$employee_id  				= xss_clean(strip_tags($this->input->post('user_name')));
									$display_name  				= xss_clean(strip_tags($this->input->post('display_name')));
									$designation_name  		= xss_clean(strip_tags($this->input->post('designation_name')));
									$contact_no  	  	 		= xss_clean(strip_tags($this->input->post('contact_no')));
									$email  	  	 				= xss_clean(strip_tags($this->input->post('email')));
									$wing_name  	  	 		= xss_clean(strip_tags($this->input->post('wing_name')));
									$section_name 				= xss_clean(strip_tags($this->input->post('section_name')));
									$building_name  	  	= xss_clean(strip_tags($this->input->post('building_name')));
									$room_id  	  	 			= xss_clean(strip_tags($this->input->post('room_id')));
									$user_id  	  	 			= xss_clean(strip_tags($this->input->post('user_id')));
									$password  	  	 			= xss_clean(strip_tags($this->input->post('password')));
									$cnfrm_password  	  	= xss_clean(strip_tags($this->input->post('cnfrm_password')));
									$show_telephone  	  	= xss_clean(strip_tags($this->input->post('show_telephone')));
									$ip_address						= $_SERVER['REMOTE_ADDR'];
									$session_id 					= $this->session->userdata('user_id');

										$insert_data = array(
															'login_id' 							=> $user_id,
															'password' 							=> $password,
															'user_name' 						=> $user_name,
															'designation' 					=> $designation_name,
															'contact_no' 						=> $contact_no,
															'email' 								=> $email,
															'image' 								=> $img_name,
															'employee_id' 					=> $employee_id,
															'room_id' 							=> $room_id,
															'building_id' 					=> $building_name,
															'wing_id' 							=> $wing_name,
															'section_id' 						=> $section_name,
															'telephone_directory_status'=> $show_telephone,
															'approved_status'=> 1,
															'display_name' 					=> $display_name,
															'client_ip' 						=> $ip_address,
															'modified_by' 					=> $session_id,
															'created_date' 					=> $created_date,
															'updated_date' 					=> $created_date
														);
									 $insert_user_id = $this->Base_model->insert_one_row('users', $insert_data);

									 /***************save user role****************/
									 	$i=0;

									 	 foreach($user_role as $saveuser_role)
									 	 {

										   $insertid = $this->Base_model->insert_one_row('save_users_role', 
										      array('user_id'		  =>  $insert_user_id,
											        'role_id'  		  =>  $user_role[$i],
											        'employee_id' 	  =>  $employee_id,
													'modified_by' 	  => $session_id,
													'client_ip' 	  => $_SERVER['REMOTE_ADDR'],
													'created_date' 	  => $created_date,
													'updated_date'    => $created_date
												) );	
												$i++;
								   
										}
									 /*************ends save user role****************/


									 /***************save user Access****************/
									   if(!empty($user_access)){

									 	 foreach($user_access as $access)
									 	 {

										   $insertid = $this->Base_model->insert_one_row('user_access', 
										      array('user_id'			=>  $insert_user_id,
											        'service_type'  	=>  $access,
											        'emp_id' 	        =>  $employee_id,
													'modified_by'    	=> $session_id,
													'client_ip' 	    => $_SERVER['REMOTE_ADDR'],
													'created_date' 	    => $created_date,
													'updated_date'      => $created_date
												) );	
								   
										}
									  }
									 /*************ends save user Access****************/

									 /***************save user Req Month****************/

									  if(!empty($reqmonth)){

									 	 foreach($reqmonth as $req_month)
									 	  {

										   $insertid = $this->Base_model->insert_one_row('user_req_month', 
										      array('user_id'			=>  $insert_user_id,
											        'month_code'  	    =>  $req_month,
											        'emp_id' 	        =>  $employee_id,
													'modified_by'    	=> $session_id,
													'client_ip' 	    => $_SERVER['REMOTE_ADDR'],
													'created_date' 	    => $created_date,
													'updated_date'      => $created_date
												) );	
								   
										  }
									   }
									 /*************ends save user Req Month****************/

									 if($insertid)
										{
											$msg = "User added successfully.";
											$this->session->set_flashdata('user_add_flashSuccess',$msg);

											/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' added user :'.$display_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

											redirect('Administrator/User');
										}

										else
										{
											$msg = "Failed to add user.";
											$this->session->set_flashdata('user_add_flashError',$msg);

											/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('user_name'),
															'ROLE'			=> '',
															'USEREMAIL' 	=> $this->session->userdata('user_email'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add user :'.$display_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

											$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
											$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
											$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
											$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
											$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
											$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
											$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
											
											$data['all_employee'] = $this->Base_model->get_emp_for_users();

											$this->load->view('admin/header');
											$this->load->view('admin/sidebar');
											$this->load->view('admin/admin_management/user/userlist',$data);	
											$this->load->view('admin/footer');
										}

								}//ends else
						}//ends main else
				}//ends else
			
		}//ends if

		else
		{
			$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
			$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
			$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
			$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
			$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
			$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
			
			$data['all_employee'] = $this->Base_model->get_emp_for_users();

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/user/adduser',$data);	
			$this->load->view('admin/footer');	
		}//ends else

	}//end function

/**********************function for update user***************/

	public function edit_user()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			
			$user_role  	  	 		= xss_clean($this->input->post('user_role'));
			$user_access  	  	 		= xss_clean($this->input->post('user_access'));
			$reqmonth  	  	 		    = xss_clean($this->input->post('reqmonth'));
			$reqmonth  	  	 		    = xss_clean($this->input->post('reqmonth'));
			$employee_id  				= xss_clean(strip_tags($this->input->post('user_name')));
			$display_name  				= xss_clean(strip_tags($this->input->post('display_name')));
			$designation_name  		= xss_clean(strip_tags($this->input->post('designation_name')));
			$contact_no  	  	 		= xss_clean(strip_tags($this->input->post('contact_no')));
			$email  	  	 				= xss_clean(strip_tags($this->input->post('email')));
			$wing_name  	  	 		= xss_clean(strip_tags($this->input->post('wing_name')));
			$section_name 				= xss_clean(strip_tags($this->input->post('section_name')));
			$building_name  	  	= xss_clean(strip_tags($this->input->post('building_name')));
			$room_id  	  	 			= xss_clean(strip_tags($this->input->post('room_id')));
			$user_id  	  	 			= xss_clean(strip_tags($this->input->post('user_id')));
			$password  	  	 			= xss_clean(strip_tags($this->input->post('passwordd')));
			$cnfrm_password  	  	= xss_clean(strip_tags($this->input->post('cnfrm_passwordd')));
			//$old_password  	  		= xss_clean(strip_tags($this->input->post('old_passworrd')));
			$show_telephone  	  	= xss_clean(strip_tags($this->input->post('show_telephone')));

			$finfo = new finfo(FILEINFO_MIME_TYPE);
			$uploaded_file_name  = $_FILES['usser_image']['name'];
			$count_dots = substr_count($uploaded_file_name, '.');


			$userDaata	= $this->Base_model->get_record_by_id('users', array('user_id' => $uri));

			if($password != $cnfrm_password)
				{
						$msg = "Password and confirm password not match.";
						$this->session->set_flashdata('flashError_user', $msg);

						/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('user_name'),
													'ROLE'			=> '',
													'USEREMAIL' 	=> $this->session->userdata('user_email'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update user, password not match :'.$display_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

						$data['insertData'] = array(
							'user_role' => xss_clean(strip_tags($this->input->post('user_role'))),
							'user_name' => xss_clean(strip_tags($this->input->post('user_name'))),
							'display_name' => xss_clean(strip_tags($this->input->post('display_name'))),
							'designation_name' => xss_clean(strip_tags($this->input->post('designation_name'))),
							'contact_no' => xss_clean(strip_tags($this->input->post('contact_no'))),
							'email' => xss_clean(strip_tags($this->input->post('email'))),
							'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
							'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
							'room_id' => xss_clean(strip_tags($this->input->post('room_id'))),
							'user_id' => xss_clean(strip_tags($this->input->post('user_id'))),
							'passwordd' => xss_clean(strip_tags($this->input->post('passwordd'))),
							'cnfrm_passwordd' => xss_clean(strip_tags($this->input->post('cnfrm_passwordd'))),
							'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
						);
						$uri = $this->uri->segment('4');
						$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
						$data['all_access'] = $this->Base_model->get_all_record_by_condition('tbl_access',NULL);
						$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
						$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
						$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
						$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
						$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
						$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));
						$data['role_selected'] = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id'=>$uri));

						$data['access_selected'] = $this->Base_model->get_all_record_by_condition('user_access', array('user_id'=>$uri));

						$uri = $this->uri->segment('4');
						$data['user_data'] = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/user/edituser',$data);	
						$this->load->view('admin/footer');

				}//ends if

				else
				{
						$this->form_validation->set_rules('user_role[]','user role','trim|required');
						$this->form_validation->set_rules('user_name','user name','trim|required');
						$this->form_validation->set_rules('display_name','display name','trim|required');
						$this->form_validation->set_rules('designation_name','designation','trim|required');
						$this->form_validation->set_rules('contact_no','contact no','trim|required');
						$this->form_validation->set_rules('email','email','trim|required');
						$this->form_validation->set_rules('wing_name','wing name','trim|required');
						$this->form_validation->set_rules('section_name','section name','trim|required');
						$this->form_validation->set_rules('building_name','building name','trim|required');
						$this->form_validation->set_rules('room_id','room','trim|required');
						$this->form_validation->set_rules('user_id','user id','trim|required');
						//$this->form_validation->set_rules('password','password','trim|required');
						//$this->form_validation->set_rules('cnfrm_password','confirm password','trim|required');

				if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
							'user_role' => xss_clean(strip_tags($this->input->post('user_role'))),
							'user_name' => xss_clean(strip_tags($this->input->post('user_name'))),
							'display_name' => xss_clean(strip_tags($this->input->post('display_name'))),
							'designation_name' => xss_clean(strip_tags($this->input->post('designation_name'))),
							'contact_no' => xss_clean(strip_tags($this->input->post('contact_no'))),
							'email' => xss_clean(strip_tags($this->input->post('email'))),
							'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
							'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
							'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
							'room_id' => xss_clean(strip_tags($this->input->post('room_id'))),
							'user_id' => xss_clean(strip_tags($this->input->post('user_id'))),
							'passwordd' => xss_clean(strip_tags($this->input->post('passwordd'))),
							'cnfrm_passwordd' => xss_clean(strip_tags($this->input->post('cnfrm_passwordd'))),
							'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
						);
						$uri = $this->uri->segment('4');
						$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
						$data['all_access'] = $this->Base_model->get_all_record_by_condition('tbl_access',NULL);
						$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
						$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
						$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
						$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
						$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
						$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));
						$data['role_selected'] = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id'=>$uri));

						$data['access_selected'] = $this->Base_model->get_all_record_by_condition('user_access', array('user_id'=>$uri));

						$uri = $this->uri->segment('4');
						$data['user_data'] = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/user/edituser',$data);	
						$this->load->view('admin/footer');
					
					
				}//ends if

				else
				{	
					
						$user_role  	  	 		= xss_clean($this->input->post('user_role'));
						$user_access  	  	 		= xss_clean($this->input->post('user_access'));
						$reqmonth  	  	 		    = xss_clean($this->input->post('reqmonth'));
						$employee_id  				= xss_clean(strip_tags($this->input->post('user_name')));
						$display_name  				= xss_clean(strip_tags($this->input->post('display_name')));
						$designation_name  		= xss_clean(strip_tags($this->input->post('designation_name')));
						$contact_no  	  	 		= xss_clean(strip_tags($this->input->post('contact_no')));
						$email  	  	 				= xss_clean(strip_tags($this->input->post('email')));
						$wing_name  	  	 		= xss_clean(strip_tags($this->input->post('wing_name')));
						$section_name 				= xss_clean(strip_tags($this->input->post('section_name')));
						$building_name  	  	= xss_clean(strip_tags($this->input->post('building_name')));
						$room_id  	  	 			= xss_clean(strip_tags($this->input->post('room_id')));
						$user_id  	  	 			= xss_clean(strip_tags($this->input->post('user_id')));
						$password  	  	 			= xss_clean(strip_tags($this->input->post('passwordd')));
						$cnfrm_password  	  		= xss_clean(strip_tags($this->input->post('cnfrm_passwordd')));
						//$old_password  	  			= xss_clean(strip_tags($this->input->post('old_passworrd')));
						$show_telephone  	  	= xss_clean(strip_tags($this->input->post('show_telephone')));
						$status  							= xss_clean(strip_tags($this->input->post('status')));
						$ip_address						= $_SERVER['REMOTE_ADDR'];
						$session_id 					= $this->session->userdata('user_id');
						$uri 									= $this->uri->segment('4');
						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$employee_data =  $this->Base_model->get_record_by_id('employee', array('employee_id'=>$employee_id,'delete_status'=>1));
						$user_name = $employee_data->employee_name;

						if(empty($show_telephone))
						{
							$show_telephone = '0';
						}

						else
						{
							$show_telephone = $show_telephone;
						}

						/***********uploaded_photo**********/

							$finfo = new finfo(FILEINFO_MIME_TYPE);
							$uploaded_file_name  = $_FILES['usser_image']['name'];
							$count_dots = substr_count($uploaded_file_name, '.');

							if($_FILES['usser_image']['name'])
                {

                	if($count_dots > 1)
					{

							$msg = "Please upload correct file.";
							$this->session->set_flashdata('flashError_user', $msg);

							/*********logs code*******/

							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							$user_logs_data = array(
											'USERNAME' 	    => $this->session->userdata('user_name'),
											'ROLE'			=> '',
											'USEREMAIL' 	=> $this->session->userdata('user_email'),
											'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
											'LOGINSTATUS' 	=> 'Logged in',
											'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update user, incorrect file upload :'.$display_name,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);

							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					/*********ends logs code*******/

							$data['insertData'] = array(
								'user_role' => xss_clean(strip_tags($this->input->post('user_role'))),
								'user_name' => xss_clean(strip_tags($this->input->post('user_name'))),
								'display_name' => xss_clean(strip_tags($this->input->post('display_name'))),
								'designation_name' => xss_clean(strip_tags($this->input->post('designation_name'))),
								'contact_no' => xss_clean(strip_tags($this->input->post('contact_no'))),
								'email' => xss_clean(strip_tags($this->input->post('email'))),
								'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
								'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
								'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
								'room_id' => xss_clean(strip_tags($this->input->post('room_id'))),
								'user_id' => xss_clean(strip_tags($this->input->post('user_id'))),
								'passwordd' => xss_clean(strip_tags($this->input->post('passwordd'))),
								'cnfrm_passwordd' => xss_clean(strip_tags($this->input->post('cnfrm_passwordd'))),
								'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
							);
							$uri = $this->uri->segment('4');
							$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
							$data['all_access'] = $this->Base_model->get_all_record_by_condition('tbl_access',NULL);
							$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
							$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
							$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
							$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
							$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
							$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
							$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));
							$data['role_selected'] = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id'=>$uri));

							$data['access_selected'] = $this->Base_model->get_all_record_by_condition('user_access', array('user_id'=>$uri));

							$uri = $this->uri->segment('4');
							$data['user_data'] = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/admin_management/user/edituser',$data);	
							$this->load->view('admin/footer');

					}// ends else if

					//
						else if(false === $ext = array_search(
				        
				        $finfo->file($_FILES['usser_image']['tmp_name']),
				        array(
				            'jpg' => 'image/jpeg',
				            'png' => 'image/png',
				            'gif' => 'image/gif',
				        ),
				        true

				     ))
					{

									$msg = "Please upload correct file.";
							$this->session->set_flashdata('flashError_user', $msg);

							/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update user, incorrect file upload :'.$display_name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						/*********ends logs code*******/

							$data['insertData'] = array(
								'user_role' => xss_clean(strip_tags($this->input->post('user_role'))),
								'user_name' => xss_clean(strip_tags($this->input->post('user_name'))),
								'display_name' => xss_clean(strip_tags($this->input->post('display_name'))),
								'designation_name' => xss_clean(strip_tags($this->input->post('designation_name'))),
								'contact_no' => xss_clean(strip_tags($this->input->post('contact_no'))),
								'email' => xss_clean(strip_tags($this->input->post('email'))),
								'wing_name' => xss_clean(strip_tags($this->input->post('wing_name'))),
								'section_name' => xss_clean(strip_tags($this->input->post('section_name'))),
								'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
								'room_id' => xss_clean(strip_tags($this->input->post('room_id'))),
								'user_id' => xss_clean(strip_tags($this->input->post('user_id'))),
								'passwordd' => xss_clean(strip_tags($this->input->post('passwordd'))),
								'cnfrm_passwordd' => xss_clean(strip_tags($this->input->post('cnfrm_passwordd'))),
								'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
							);
							$uri = $this->uri->segment('4');
							$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
							$data['all_access'] = $this->Base_model->get_all_record_by_condition('tbl_access',NULL);
							$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
							$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
							$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
							$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
							$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
							$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
							$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));
							$data['role_selected'] = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id'=>$uri));

							$data['access_selected'] = $this->Base_model->get_all_record_by_condition('user_access', array('user_id'=>$uri));

							$uri = $this->uri->segment('4');
							$data['user_data'] = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/admin_management/user/edituser',$data);	
							$this->load->view('admin/footer');
							
					}//ends else if

				else
					{

					  $configg = array(
                     'upload_path' => "./uploads/users/",
                     'allowed_types' => "jpg|png|jpeg|",
                     'overwrite' => TRUE,
                     'max_size' => "4096000", 
                     'file_name' => $_FILES["usser_image"]['name'],
                     );              
                   $this->load->library('upload', $configg);
                   $this->upload->initialize($configg);
                   $img_namee= $_FILES['usser_image']['name'];
                   $pic['item_image']= $img_namee;
                   $this->load->library('upload',$configg);
               	   $this->upload->initialize($configg);
                   if($this->upload->do_upload('usser_image'))
                  {  
                     $file_data = $this->upload->data();  
                     $img_namee = $file_data['orig_name'];
                     $file_path ='uploads/users/'.$img_namee;
                  }

                  else
                  {
                    $error=$this->upload->display_errors();   
                  }
                  
	              }
                
                }// ends if iamge


               $img_name 	  	= str_replace(' ','_', $img_namee);
               if(empty($img_name))
               {
               		$user_data	= $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
               		$img_name = $user_data->image;
               }

               else
               {
               		$img_name = $img_name;
               }
                /*******Ends uploaded_photo*******/ 

					/*****check condition name********/

						$checked_user_login_id = $this->Admin_model->check_existent_user_loginid($user_id,$uri);

						$checked_user_email = $this->Admin_model->check_existent_user_email($email,$uri);


					/*****ends check condition name*****/
						if($checked_user_login_id=='1')
						{
								$msg = "Login id already exits, Please enter new one";
								$this->session->set_flashdata('flashError_user', $msg);
								/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('user_name'),
																	'ROLE'			=> '',
																	'USEREMAIL' 	=> $this->session->userdata('user_email'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update user, login id already exits :'.$display_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

													$this->Base_model->insert_one_row('userlogs', $user_logs_data);

											/*********ends logs code*******/

								$data['insertData'] = array(
								'employee_code' => xss_clean(strip_tags($this->input->post('employee_code'))),
								'employee_name' => xss_clean(strip_tags($this->input->post('employee_name'))),
								'employee_post' => xss_clean(strip_tags($this->input->post('employee_post'))),
								'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
								'employee_mobile' => xss_clean(strip_tags($this->input->post('employee_mobile'))),
								'employee_landline_no' => xss_clean(strip_tags($this->input->post('employee_landline_no'))),
								'employee_landline_no_residence' => xss_clean(strip_tags($this->input->post('employee_landline_no_residence'))),
								'employee_email' => xss_clean(strip_tags($this->input->post('employee_email'))),
								'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
								'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
								'rooom_id' => xss_clean(strip_tags($this->input->post('rooom_id'))),
								'employee_intercom' => xss_clean(strip_tags($this->input->post('employee_intercom'))),
								'reporting_officer' => xss_clean(strip_tags($this->input->post('reporting_officer'))),
								'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
								);
								$uri = $this->uri->segment('4');
								$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
								$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
								$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
								$uri = $this->uri->segment('4');
								$data['user_data'] = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/user/edituser',$data);	
								$this->load->view('admin/footer');
						}//ends if

							else if($checked_user_email=='1')
							{
								$msg = "User email already exits, Please enter new one";
								$this->session->set_flashdata('flashError_user', $msg);

								/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('user_name'),
																	'ROLE'			=> '',
																	'USEREMAIL' 	=> $this->session->userdata('user_email'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update user, email already exits :'.$display_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

													$this->Base_model->insert_one_row('userlogs', $user_logs_data);

											/*********ends logs code*******/

								$data['insertData'] = array(
								'employee_code' => xss_clean(strip_tags($this->input->post('employee_code'))),
								'employee_name' => xss_clean(strip_tags($this->input->post('employee_name'))),
								'employee_post' => xss_clean(strip_tags($this->input->post('employee_post'))),
								'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
								'employee_mobile' => xss_clean(strip_tags($this->input->post('employee_mobile'))),
								'employee_landline_no' => xss_clean(strip_tags($this->input->post('employee_landline_no'))),
								'employee_landline_no_residence' => xss_clean(strip_tags($this->input->post('employee_landline_no_residence'))),
								'employee_email' => xss_clean(strip_tags($this->input->post('employee_email'))),
								'employee_designation' => xss_clean(strip_tags($this->input->post('employee_designation'))),
								'building_name' => xss_clean(strip_tags($this->input->post('building_name'))),
								'rooom_id' => xss_clean(strip_tags($this->input->post('rooom_id'))),
								'employee_intercom' => xss_clean(strip_tags($this->input->post('employee_intercom'))),
								'reporting_officer' => xss_clean(strip_tags($this->input->post('reporting_officer'))),
								'show_telephone' => xss_clean(strip_tags($this->input->post('show_telephone'))),
								);
								$uri = $this->uri->segment('4');
								$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
								$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
								$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
								$data['role_selected'] = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id'=>$uri));

								$data['access_selected'] = $this->Base_model->get_all_record_by_condition('user_access', array('user_id'=>$uri));

								$uri = $this->uri->segment('4');
								$data['user_data'] = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/user/edituser',$data);	
								$this->load->view('admin/footer');
						}//ends if

						

						else
						{
							$uri = $this->uri->segment('4');
							$user_data = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
								if(empty($password))
								{
										$update_data = array(
													'login_id' 							=> $user_id,
													'user_name' 						=> $user_name,
													'designation' 					=> $designation_name,
													'contact_no' 						=> $contact_no,
													'email' 								=> $email,
													'image' 								=> $img_name,
													'employee_id' 					=> $employee_id,
													'room_id' 							=> $room_id,
													'building_id' 					=> $building_name,
													'wing_id' 							=> $wing_name,
													'section_id' 						=> $section_name,
													'telephone_directory_status'=> $show_telephone,
													'display_name' 					=> $display_name,
													'client_ip' 						=> $ip_address,
													'status'								=>	$status,
													'modified_by' 					=> $session_id,
													'updated_date' 					=> $created_date
												);
								}

								else
								{
									$update_data = array(
													'login_id' 							=> $user_id,
													'password' 							=> $password,
													'user_name' 						=> $user_name,
													'designation' 					=> $designation_name,
													'contact_no' 						=> $contact_no,
													'email' 								=> $email,
													'image' 								=> $img_name,
													'employee_id' 					=> $employee_id,
													'room_id' 							=> $room_id,
													'building_id' 					=> $building_name,
													'wing_id' 							=> $wing_name,
													'section_id' 						=> $section_name,
													'telephone_directory_status'=> $show_telephone,
													'display_name' 					=> $display_name,
													'client_ip' 						=> $ip_address,
													'status'								=>	$status,
													'modified_by' 					=> $session_id,
													'updated_date' 					=> $created_date
												);
								}

								$uri = $this->uri->segment('4');
								
							 $updateuserdata = $this->Base_model->update_record_by_id('users', $update_data, array('user_id'=> $uri));

							  /***************update user role****************/
							   $where_user = array(
				            'user_id' => $uri
				        );

				        $this->Base_model->delete_record_by_id('save_users_role', $where_user);

				        $this->Base_model->delete_record_by_id('user_access', $where_user);

				        $this->Base_model->delete_record_by_id('user_req_month', $where_user);

							 	 $i=0;
							 	 foreach($user_role as $saveuser_role)
							 	 {

								   $insertid = $this->Base_model->insert_one_row('save_users_role', 
								      array('user_id'			=>  $uri,
									        'role_id'  			=>  $user_role[$i],
									        'employee_id' 	=>  $employee_id,
													'modified_by' 	=> $session_id,
													'client_ip' 	  => $_SERVER['REMOTE_ADDR'],
													'created_date' 	=> $created_date,
													'updated_date'  => $created_date
										) );	
										$i++;
						   
								}

                             if(!empty($user_access)){
								 foreach($user_access as $access)
							 	 {

								   $insertid = $this->Base_model->insert_one_row('user_access', 
								      array('user_id'			=>  $uri,
									        'service_type'  	=>  $access,
									        'emp_id' 	        =>  $employee_id,
											'modified_by'    	=> $session_id,
											'client_ip' 	    => $_SERVER['REMOTE_ADDR'],
											'created_date' 	    => $created_date,
											'updated_date'      => $created_date
										) );	
						   
								}
							}


							if(!empty($reqmonth)){

								 foreach($reqmonth as $req_month)
							 	 {

								   $insertid = $this->Base_model->insert_one_row('user_req_month', 
								      array('user_id'			=>  $uri,
									        'month_code'  	    =>  $req_month,
									        'emp_id' 	        =>  $employee_id,
											'modified_by'    	=> $session_id,
											'client_ip' 	    => $_SERVER['REMOTE_ADDR'],
											'created_date' 	    => $created_date,
											'updated_date'      => $created_date
										) );	
						   
								}

							}


							 /*************ends update user role****************/

							 if($updateuserdata)
								{
									$uri = $this->uri->segment('4');
									$msg = "User updated successfully.";

									/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('user_name'),
																	'ROLE'			=> '',
																	'USEREMAIL' 	=> $this->session->userdata('user_email'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('user_name').' updated user successfully : '.$display_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

													$this->Base_model->insert_one_row('userlogs', $user_logs_data);

											/*********ends logs code*******/

									$this->session->set_flashdata('user_add_flashSuccess',$msg);
									$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
									$data['all_access'] = $this->Base_model->get_all_record_by_condition('tbl_access',NULL);
									$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
									$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
									$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
									$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
									$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
									$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));
									$data['role_selected'] = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id'=>$uri));

									$data['access_selected'] = $this->Base_model->get_all_record_by_condition('user_access', array('user_id'=>$uri));

									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/user/userlist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$uri = $this->uri->segment('4');
									$msg = "Failed to update user.";

									/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('user_name'),
																	'ROLE'			=> '',
																	'USEREMAIL' 	=> $this->session->userdata('user_email'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update user : '.$display_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

													$this->Base_model->insert_one_row('userlogs', $user_logs_data);

											/*********ends logs code*******/

									$this->session->set_flashdata('user_add_flashError',$msg);
									$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
									$data['all_access'] = $this->Base_model->get_all_record_by_condition('tbl_access',NULL);
									$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
									$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
									$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
									$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
									$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
									$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));
									$data['role_selected'] = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id'=>$uri));

									$data['access_selected'] = $this->Base_model->get_all_record_by_condition('user_access', array('user_id'=>$uri));

									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/user/userlist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
				}//ends p else
			
		}//ends if

		else
		{
					$uri = $this->uri->segment('4');
					$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
					$data['all_access'] = $this->Base_model->get_all_record_by_condition('tbl_access',NULL);
					$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
					$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
					$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
					$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
					$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
					$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));
					$data['role_selected'] = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id'=>$uri));

					$data['access_selected'] = $this->Base_model->get_all_record_by_condition('user_access', array('user_id'=>$uri));

					$data['month_req_data'] = $this->Base_model->get_all_record_by_condition('user_req_month', array('user_id'=>$uri));

					$uri = $this->uri->segment('4');
					$data['user_data'] = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/user/edituser',$data);	
					$this->load->view('admin/footer');
		}//ends else

	}//end function

	/********function for Delete user*******/

	public function delete_user()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean(strip_tags($this->input->post('delete_itemId')));
				$data['user_data'] = $user_data = $this->Base_model->get_record_by_id('users', array('user_id' => $delete_itemId));

					/*****check condition name********/
						$checked = $this->Base_model->check_existent('users', array('user_id'=>$delete_itemId,'delete_status'=>0));
					/*****ends check condition name*****/

						if($checked=='1')
						{
								$msg = "User already deleted.";
								$this->session->set_flashdata('user_add_flashError', $msg);
								
											/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('user_name'),
																	'ROLE'			=> '',
																	'USEREMAIL' 	=> $this->session->userdata('user_email'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('user_name').' successfully deleted user '.$user_data->user_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

													$this->Base_model->insert_one_row('userlogs', $user_logs_data);

											/*********ends logs code*******/

							$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
							$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
							$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
							$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
							$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
							$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
							$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
							$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/admin_management/user/userlist',$data);	
							$this->load->view('admin/footer');
						}//ends if

						else
						{
								$update_data = array(
													'status'				=> '0',
													'delete_status' => '0',
													'updated_date' 	=> $created_date
												);
								$updateid = $this->Base_model->update_record_by_id('users', $update_data, array('user_id'=> $delete_itemId));
								$msg = "User deleted successfully.";
								$this->session->set_flashdata('user_delete_flashSuccess',$msg);

								/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('user_name'),
																	'ROLE'			=> '',
																	'USEREMAIL' 	=> $this->session->userdata('user_email'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('user_name').' successfully deleted user '.$user_data->user_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

													$this->Base_model->insert_one_row('userlogs', $user_logs_data);

								/*********ends logs code*******/

								$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
								$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
								$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
								$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
								$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
								$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
								$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
								$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar');
								$this->load->view('admin/admin_management/user/userlist',$data);	
								$this->load->view('admin/footer');
						}
				
	}//ends function

	/********function for view user******/

	public function view_user()
	{
			$uri = $this->uri->segment('4');
			$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
			$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
			$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
			$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
			$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
			$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
			$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));
			$data['role_selected'] = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id'=>$uri));
			$data['user_data'] = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/user/viewuser',$data);	
			$this->load->view('admin/footer');	
	}//ends function

	/*******function to gettting all employee data********/

	public function employee_data()
	{
		
		$employee_id = strip_tags($this->input->post('id'));
		$employee_data =  $this->Base_model->get_record_by_id('employee', array('employee_id'=>$employee_id,'delete_status'=>1));
		$building_data =  $this->Base_model->get_record_by_id('building', array('building_id'=>$employee_data->building_id,'delete_status'=>1));
		$room_data =  $this->Base_model->get_record_by_id('room_no', array('room_id'=>$employee_data->room_id,'delete_status'=>1));
		$designation_data =  $this->Base_model->get_record_by_id('designation', array('designation_id'=>$employee_data->employee_designation,'delete_status'=>1));

		$employee_data = array(

			'building_id' 		=> $employee_data->building_id,
			'building_name' 	=> $building_data->building_name,
			'room_id' 				=> $employee_data->room_id,
			'room_name' 			=> $room_data->room_name,
			'designation_id' 	=> $designation_data->designation_id,
			'designation_name'=> $designation_data->designation_name,
			'employee_email' 	=> $employee_data->employee_email,
			'employee_mobile' => $employee_data->employee_mobile_no,
		);

		$employee_datas =  json_encode($employee_data);
		echo  $employee_datas;
	}// ends function

	/*******function to gettting all section********/

	public function all_section()
	{
		
		$wing_id = strip_tags($this->input->post('id'));
		$all_section =  $this->Base_model->get_all_record_by_condition('section', array('wing_id'=>$wing_id,'status'=>1,'delete_status'=>1));
		$all_sections =  json_encode($all_section);
		echo  $all_sections;
	}// ends function
	/*******function for user search******/

	public function search_user()
	{
		
		$wing_name  			= xss_clean(strip_tags($this->input->post('wing_name')));
		$user_name  			= xss_clean(strip_tags($this->input->post('user_name')));
		$designation_name = xss_clean(strip_tags($this->input->post('designation_name')));
		$status  					= xss_clean(strip_tags($this->input->post('status')));

		if(empty($wing_name) && empty($user_name) && empty($designation_name) && empty($status))
				{
					$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
					$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
					$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
					$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
					$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
					$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
					$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/user/userlist',$data);	
					$this->load->view('admin/footer');
				}//ends if

				else
				{
					$data['all_roles'] = $this->Base_model->get_all_record_by_condition('roles',NULL);
					$data['all_building'] = $this->Base_model->get_all_record_by_condition('building', array('delete_status'=>1));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
					$data['all_wing'] = $this->Base_model->get_all_record_by_condition('wing', array('status'=>1,'delete_status'=>1));
					$data['all_section'] = $this->Base_model->get_all_record_by_condition('section', array('status'=>1,'delete_status'=>1));
					$data['all_room'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
					$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>1));

					if($wing_name && $user_name && $designation_name && $status)
					{
						if($status=='2')
						{
							$status = 0;
						}
						$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('wing_id'=>$wing_name,'user_name' => $user_name,'designation'=>$designation_name,'status'=>$status,'delete_status'=>1));
					}

					else if($wing_name && empty($user_name) && empty($designation_name) && empty($status))
					{
						$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('wing_id'=>$wing_name,'delete_status'=>1));
					}

					else if(empty($wing_name) && $user_name && empty($designation_name) && empty($status))
					{
							$data['all_user'] = $this->Admin_model->search_usernamme($user_name);
					}
					
					else if(empty($wing_name) && empty($user_name) && $designation_name && empty($status))
					{
						$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('designation'=>$designation_name,'delete_status'=>1));
					}

					else if(empty($wing_name) && empty($user_name) && empty($designation_name) && $status)
					{
						if($status=='2')
						{
							$status = 0;
						}
						$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('status'=>$status,'delete_status'=>1));
					}

					else if($wing_name && $user_name && empty($designation_name) && empty($status))
					{
							$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('wing_id'=>$wing_name,'user_name' => $user_name,'delete_status'=>1));
					}

					else if($wing_name && empty($user_name) && $designation_name && empty($status))
					{
							$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('wing_id'=>$wing_name,'designation'=>$designation_name,'delete_status'=>1));
					}

					else if($wing_name && empty($user_name) && empty($designation_name) && $status)
					{
						if($status=='2')
						{
							$status = 0;
						}
							$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('wing_id'=>$wing_name,'status'=>$status,'delete_status'=>1));
					}

					else if(empty($wing_name) && $user_name && $designation_name && empty($status))
					{
							$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('user_name' => $user_name,'designation'=>$designation_name,'delete_status'=>1));
					}

					else if(empty($wing_name) && $user_name && empty($designation_name) && $status)
					{
						if($status=='2')
						{
							$status = 0;
						}
							$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('user_name' => $user_name,'status'=>$status,'delete_status'=>1));
					}

					else if(empty($wing_name) && empty($user_name) && $designation_name && $status)
					{
						if($status=='2')
						{
							$status = 0;
						}
							$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('designation'=>$designation_name,'status'=>$status,'delete_status'=>1));
					}

					else
					{
						$data['all_user'] = $this->Base_model->get_all_record_by_condition('users', array('delete_status'=>1));
					}
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/user/userlist',$data);	
					$this->load->view('admin/footer');

				}//ends else
	}// function ends


	
}//class ends


