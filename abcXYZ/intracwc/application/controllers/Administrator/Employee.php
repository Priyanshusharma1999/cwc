<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Employee extends CI_Controller {

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

		$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1','approved_status'=>'1'));
		$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
		$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/admin_management/employee/employeelist',$data);	
		$this->load->view('admin/footer');

	}//ends function

	public function pendingemployee()
	{

         $all_emp = array();
         
         $user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	     foreach ($user_role_data as $role_id)
		 {
		   		$user_roles[]= $role_id->role_id;
		  }
							   
		 $all_employee = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1','approved_status'=>'0'));
		
		 foreach($all_employee as $employee){
		     
		     if(in_array("15", $user_roles)){
		         $check = $this->Base_model->check_existent('user_access',array('emp_id'=>$employee->employee_id,'service_type'=>'1'));
		     } else if(in_array("16", $user_roles)){
		          $check = $this->Base_model->check_existent('user_access',array('emp_id'=>$employee->employee_id,'service_type'=>'2'));
		     } else {
		         $check == 0;
		     }
		     
		     if($check == '1'){
		         $all_emp[] = $employee;
		     }
		     
		 }
		 
		 $data['all_employee'] = $all_emp;
		
		$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
		$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/admin_management/employee/pendinglist',$data);	
		$this->load->view('admin/footer');

	}//ends function


	public function Nonitemployee()
	{
		$uurrss= array();

		 $accesss = $this->Base_model->get_all_record_by_condition('user_access', array('service_type'=>'1'));

		 foreach($accesss as $list){
            
           $uurrss[] = $this->Base_model->get_record_by_id('employee', array('employee_id'=>$list->emp_id,'delete_status'=>'1','approved_status'=>'1'));

		}

	    $data['all_employee'] = array_filter($uurrss);

		$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
		$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/admin_management/employee/nonitemployeelist',$data);	
		$this->load->view('admin/footer');

	}//ends function


	public function Itemployee()
	{
		$uurrss= array();

		 $accesss = $this->Base_model->get_all_record_by_condition('user_access', array('service_type'=>'2'));

		 foreach($accesss as $list){
            
           $uurrss[] = $this->Base_model->get_record_by_id('employee', array('employee_id'=>$list->emp_id,'delete_status'=>'1','approved_status'=>'1'));

		}

	    $data['all_employee'] = array_filter($uurrss);

		$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
		$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/admin_management/employee/itemployeelist',$data);	
		$this->load->view('admin/footer');

	}//ends function

	/***************function for add employee***************/

	public function add_employee()
	{	
		if(isset($_REQUEST['submit'])) 
		{
			
		   
		   $employee_name  					= xss_clean(strip_tags($this->input->post('employee_name')));
		   $employee_post  					= xss_clean(strip_tags($this->input->post('employee_post')));
		   $employee_designation  			= xss_clean(strip_tags($this->input->post('employee_designation')));
		   $reporting_officer  	  	 		= xss_clean(strip_tags($this->input->post('reporting_officer')));
		   $employee_mobile  	  	 		= xss_clean(strip_tags($this->input->post('employee_mobile')));
		   $employee_landline_no  	  	 	= xss_clean(strip_tags($this->input->post('employee_landline_no')));
		   $employee_landline_no_residence 	= xss_clean(strip_tags($this->input->post('employee_landline_no_residence')));
		   $employee_email  	  	 		= xss_clean(strip_tags($this->input->post('employee_email')));
		   $building_name  	  	 			= xss_clean(strip_tags($this->input->post('building_name')));
		   $rooom_id  	  	 				= xss_clean(strip_tags($this->input->post('rooom_id')));
		   $employee_intercom  	  	 		= xss_clean(strip_tags($this->input->post('employee_intercom')));
		   $show_telephone  	  	 		= xss_clean(strip_tags($this->input->post('show_telephone')));
			
			$this->form_validation->set_rules('employee_name','employee name','trim|required');
			$this->form_validation->set_rules('employee_post','employee post','trim|required');
			$this->form_validation->set_rules('employee_designation','employee designation','trim|required');
			$this->form_validation->set_rules('employee_mobile','employee mobile','trim|required');
			$this->form_validation->set_rules('employee_landline_no','employee landline no','trim|required');
			$this->form_validation->set_rules('employee_email','employee email','trim|required');
			$this->form_validation->set_rules('building_name','building name','trim|required');
			$this->form_validation->set_rules('rooom_id','rooom name','trim|required');
			$this->form_validation->set_rules('employee_intercom','employee intercom','trim|required');
			

				if($this->form_validation->run() === false) 
				{
						
						$data['insertData'] = array(
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

						$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
						$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
						$data['officelist'] = $this->Base_model->get_all_office_by_condition('employee_office', array('delete_status'=>'0'));
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/employee/addemployee',$data);
						$this->load->view('admin/footer');	
				}//ends if

				else
				{
					
					
					$employee_name  		= xss_clean(strip_tags($this->input->post('employee_name')));
					$employee_post  		= xss_clean(strip_tags($this->input->post('employee_post')));
					$employee_designation  	= xss_clean(strip_tags($this->input->post('employee_designation')));
					$reporting_officer  	 = xss_clean(strip_tags($this->input->post('reporting_officer')));
					$employee_mobile  	  	 = xss_clean(strip_tags($this->input->post('employee_mobile')));
					$employee_landline_no  	  = xss_clean(strip_tags($this->input->post('employee_landline_no')));
					$employee_landline_no_residence = xss_clean(strip_tags($this->input->post('employee_landline_no_residence')));
					$employee_email  	  	= xss_clean(strip_tags($this->input->post('employee_email')));
					$building_name  	  	= xss_clean(strip_tags($this->input->post('building_name')));
					$rooom_id  	  	 		= xss_clean(strip_tags($this->input->post('rooom_id')));
					$employee_intercom  	= xss_clean(strip_tags($this->input->post('employee_intercom')));
					$show_telephone  	  	= xss_clean(strip_tags($this->input->post('show_telephone')));
					$ip_address				= $_SERVER['REMOTE_ADDR'];
					$session_id 			= $this->session->userdata('user_id');

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					
					if(empty($show_telephone))
					{
						$show_telephone = '0';
					}

					else
					{
						$show_telephone = $show_telephone;
					}

					if(empty($reporting_officer))
					{
						$reporting_officer = '';
					}

					else
					{
						$reporting_officer = $reporting_officer;
					}

					/*****check condition********/

						$checked_emp_email = $this->Base_model->check_existent('employee', array('employee_email'=> $employee_email,'delete_status'=>1));

					/*****ends check condition*****/

				if($checked_emp_email=='1')
				{
								
						$msg = "Employee email already exits, Please enter new one";
						$this->session->set_flashdata('flashError_employee', $msg);

					/*********logs code*******/

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('user_name'),
									'ROLE'			=> '',
									'USEREMAIL' 	=> $this->session->userdata('user_email'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logged in',
									'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add employee, already exits :'.$employee_name,
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);

					$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					/*********ends logs code*******/

						$data['insertData'] = array(
						
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

						$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
						$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
						$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
						$data['officelist'] = $this->Base_model->get_all_office_by_condition('employee_office', array('delete_status'=>'0'));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/admin_management/employee/addemployee',$data);
						$this->load->view('admin/footer');	

					}//ends if

						else
						{

						  $lastid = $this->Admin_model->lastid();

						  $empid = $lastid->employee_id + 1;
							
			               $insert_data = array(
								'employee_code' 						=> 'emp_'.$empid,
								'employee_name' 						=> $employee_name,
								'employee_designation' 					=> $employee_designation,
								'employee_mobile_no' 					=> $employee_mobile,
								'employee_landline_no' 					=> $employee_landline_no,
								'employee_landline_no_residence' 		=> $employee_landline_no_residence,
								'employee_email' 						=> $employee_email,
								'employee_intercom' 					=> $employee_intercom,
								'post' 									=> $employee_post,
								'building_id' 							=> $building_name,
								'room_id' 								=> $rooom_id,
								'reporting_officer' 					=> $reporting_officer,
								'telephone' 							=> $show_telephone,
								'approved_status' 						=> 1,
								'client_ip' 							=> $ip_address,
								'modified_by' 							=> $session_id,
								'created_date' 							=> $created_date,
								'updated_date' 							=> $created_date
							);

							 $insertid = $this->Base_model->insert_one_row('employee', $insert_data);

						if($insertid)
							{
								$msg = "Employee added successfully.";
								$this->session->set_flashdata('employee_add_flashSuccess',$msg);

								/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('user_name'),
									'ROLE'			=> '',
									'USEREMAIL' 	=> $this->session->userdata('user_email'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logged in',
									'ACTIVITY' 		=> $this->session->userdata('user_name').' successfully added employee :'.$employee_name,
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

						   /*********ends logs code*******/

						  redirect('Administrator/Employee');

						}

						else
						{
							$msg = "Failed to add employee.";
							$this->session->set_flashdata('employee_add_flashError',$msg);

					/*********logs code*******/

							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							$user_logs_data = array(
											'USERNAME' 	    => $this->session->userdata('user_name'),
											'ROLE'			=> '',
											'USEREMAIL' 	=> $this->session->userdata('user_email'),
											'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
											'LOGINSTATUS' 	=> 'Logged in',
											'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add employee :'.$employee_name,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);

							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

					/*********ends logs code*******/

									$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
									$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
									$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar');
									$this->load->view('admin/admin_management/employee/employeelist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else

				}//ends main else
		}//ends if

		else
		{
			$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
			$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));

			$data['officelist'] = $this->Base_model->get_all_office_by_condition('employee_office', array('delete_status'=>'0'));

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/employee/addemployee',$data);
			$this->load->view('admin/footer');	
		}//ends else

	}//end function

/**********************function for update employee***************/

	public function edit_employee()
	{	
	
	 $uri = $this->uri->segment('4');
	 if(isset($_REQUEST['submit'])) 
	  {
			
		
		$employee_name  					= xss_clean(strip_tags($this->input->post('employee_name')));
		$employee_post  					= xss_clean(strip_tags($this->input->post('employee_post')));
		$employee_designation  				= xss_clean(strip_tags($this->input->post('employee_designation')));
		$reporting_officer  	  	 		= xss_clean(strip_tags($this->input->post('reporting_officer')));
		$employee_mobile  	  	 			= xss_clean(strip_tags($this->input->post('employee_mobile')));
		$employee_landline_no  	  	 		= xss_clean(strip_tags($this->input->post('employee_landline_no')));
		$employee_landline_no_residence 	= xss_clean(strip_tags($this->input->post('employee_landline_no_residence')));
		$employee_email  	  	 			= xss_clean(strip_tags($this->input->post('employee_email')));
		$building_name  	  	 			= xss_clean(strip_tags($this->input->post('building_name')));
		$rooom_id  	  	 					= xss_clean(strip_tags($this->input->post('rooom_id')));
		$employee_intercom  	  	 		= xss_clean(strip_tags($this->input->post('employee_intercom')));
		$show_telephone  	  	 			= xss_clean(strip_tags($this->input->post('show_telephone')));


		$this->form_validation->set_rules('employee_name','employee name','trim|required');
		$this->form_validation->set_rules('employee_post','employee post','trim|required');
		$this->form_validation->set_rules('employee_designation','employee designation','trim|required');
		$this->form_validation->set_rules('employee_mobile','employee mobile','trim|required');
		$this->form_validation->set_rules('employee_landline_no','employee landline no','trim|required');
		$this->form_validation->set_rules('employee_email','employee email','trim|required');
		$this->form_validation->set_rules('building_name','building name','trim|required');
		$this->form_validation->set_rules('rooom_id','rooom name','trim|required');
		$this->form_validation->set_rules('employee_intercom','employee intercom','trim|required');

			if($this->form_validation->run() === false) 
			{
					
			  $data['insertData'] = array(
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

				$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
				$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
				$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
				$uri = $this->uri->segment('4');
				$data['employee_data'] = $this->Base_model->get_record_by_id('employee', array('employee_id' => $uri));

				$data['officelist'] = $this->Base_model->get_all_office_by_condition('employee_office', array('delete_status'=>'0'));

				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/admin_management/employee/editemployee',$data);	
				$this->load->view('admin/footer');
				
				
			}//ends if

	else
	{

		
		$employee_name  = xss_clean(strip_tags($this->input->post('employee_name')));
		$employee_post  = xss_clean(strip_tags($this->input->post('employee_post')));
		$employee_designation  = xss_clean(strip_tags($this->input->post('employee_designation')));
		$reporting_officer  = xss_clean(strip_tags($this->input->post('reporting_officer')));
		$employee_mobile  	  = xss_clean(strip_tags($this->input->post('employee_mobile')));
		$employee_landline_no = xss_clean(strip_tags($this->input->post('employee_landline_no')));
		$employee_landline_no_residence = xss_clean(strip_tags($this->input->post('employee_landline_no_residence')));
		$employee_email  	  = xss_clean(strip_tags($this->input->post('employee_email')));
		$building_name  	  = xss_clean(strip_tags($this->input->post('building_name')));
		$rooom_id  	  	 	= xss_clean(strip_tags($this->input->post('rooom_id')));
		$employee_intercom  = xss_clean(strip_tags($this->input->post('employee_intercom')));
		$show_telephone  	= xss_clean(strip_tags($this->input->post('show_telephone')));
		$status  		= xss_clean(strip_tags($this->input->post('status')));
		$ip_address		= $_SERVER['REMOTE_ADDR'];
		$session_id     = $this->session->userdata('user_id');
		$uri 			= $this->uri->segment('4');

		date_default_timezone_set('Asia/Calcutta'); 
		$created_date =  date("Y-m-d H:i:s");

		if(empty($show_telephone))
		{
			$show_telephone = '0';
		}

		else
		{
			$show_telephone = $show_telephone;
		}

		if(empty($reporting_officer))
		{
			$reporting_officer = '';
		}

		else
		{
			$reporting_officer = $reporting_officer;
		}
	/*****check condition name********/


		$checked_emp_email = $this->Admin_model->check_existent_employee_empemail($employee_email,$uri);


	/*****ends check condition name*****/
		
		 if($checked_emp_email=='1')
			{
				$msg = "Employee email already exits, Please enter new one";
				$this->session->set_flashdata('flashError_employee', $msg);

				/*********logs code*******/

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('user_name'),
									'ROLE'			=> '',
									'USEREMAIL' 	=> $this->session->userdata('user_email'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logged in',
									'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add employee, already exits :'.$employee_name,
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);

					$this->Base_model->insert_one_row('userlogs', $user_logs_data);

			/*********ends logs code*******/
				$data['insertData'] = array(
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

				$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
				$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
				$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
				$uri = $this->uri->segment('4');
				$data['employee_data'] = $this->Base_model->get_record_by_id('employee', array('employee_id' => $uri));

				$data['officelist'] = $this->Base_model->get_all_office_by_condition('employee_office', array('delete_status'=>'0'));

				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
				$this->load->view('admin/admin_management/employee/editemployee',$data);	
				$this->load->view('admin/footer');
		}//ends if

		

		else
		{
	            $uri = $this->uri->segment('4');

	            $emp_data = $this->Base_model->get_record_by_id('employee', array('employee_id' => $uri));

	        	$update_data = array(
					'employee_code' 						=> $emp_data->employee_code,
					'employee_name' 						=> $employee_name,
					'employee_designation' 					=> $employee_designation,
					'employee_mobile_no' 					=> $employee_mobile,
					'employee_landline_no' 					=> $employee_landline_no,
					'employee_landline_no_residence' 		=> $employee_landline_no_residence,
					'employee_email' 						=> $employee_email,
					'employee_intercom' 					=> $employee_intercom,
					'post' 									=> $employee_post,
					'building_id' 							=> $building_name,
					'room_id' 								=> $rooom_id,
					'reporting_officer' 					=> $reporting_officer,
					'telephone' 							=> $show_telephone,
					'client_ip' 							=> $ip_address,
					'status'							    => $status,
					'modified_by' 							=> $session_id,
					'updated_date' 							=> $created_date
				);

			 $updateid = $this->Base_model->update_record_by_id('employee', $update_data, array('employee_id'=> $uri));

			 if($updateid)
				{
					$msg = "Employee updated successfully.";
					$this->session->set_flashdata('employee_add_flashSuccess',$msg);

					/*********logs code*******/

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('user_name'),
									'ROLE'			=> '',
									'USEREMAIL' 	=> $this->session->userdata('user_email'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logged in',
									'ACTIVITY' 		=> $this->session->userdata('user_name').' successfully updated employee : '.$employee_name,
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);

					$this->Base_model->insert_one_row('userlogs', $user_logs_data);

			    /*********ends logs code*******/

			    /******************* Send Mail ***************/

			    $this->load->library('email');

			    $usersroles = $this->Base_model->get_all_admins();

			    if($employee_mobile != $emp_data->employee_mobile_no){

			    	 foreach($usersroles as $uroles){

			    	 	 $usr_data = $this->Base_model->get_record_by_id('users', array('user_id' => $uroles->user_id));

                        $this->email->set_mailtype("html");
                        $this->email->from('support-cwc@gov.in');
                        $this->email->to($usr_data->email);
                        $this->email->subject('Mobile No Change');
                        $this->email->message('Mobile No of Employee'.$employee_name.'has changed.');
                        $this->email->send();

			    	 }
			    	    
			    }     


			    if($employee_email != $emp_data->employee_email){

			    	 foreach($usersroles as $uroles){

			    	 	 $usr_data = $this->Base_model->get_record_by_id('users', array('user_id' => $uroles->user_id));

                        $this->email->set_mailtype("html");
                        $this->email->from('support-cwc@gov.in');
                        $this->email->to($usr_data->email);
                        $this->email->subject('Email Id Change');
                        $this->email->message('Email Id of Employee '.$employee_name.' has changed.');
                        $this->email->send();

			    	 }
			    	    
			    }     

			     /*****************************************************/

					redirect('Administrator/Employee');
			}

			else
			{
					$msg = "Failed to employee.";
					$this->session->set_flashdata('employee_add_flashError',$msg);

					/*********logs code*******/

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('user_name'),
									'ROLE'			=> '',
									'USEREMAIL' 	=> $this->session->userdata('user_email'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logged in',
									'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update employee :'.$employee_name,
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);

					$this->Base_model->insert_one_row('userlogs', $user_logs_data);

			/*********ends logs code*******/

					$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
					$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));

					$data['officelist'] = $this->Base_model->get_all_office_by_condition('employee_office', array('delete_status'=>'0'));

					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/employee/employeelist',$data);	
					$this->load->view('admin/footer');
			}

		}//ends else

	}//ends main else

  }//ends if

	else
	{
	   
	   $data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
	   $data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
	   $data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>'1'));
	   $data['all_rooms'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>'1'));
	   $uri = $this->uri->segment('4');
	   $data['employee_data'] = $this->Base_model->get_record_by_id('employee', array('employee_id' => $uri));

	   $data['officelist'] = $this->Base_model->get_all_office_by_condition('employee_office', array('delete_status'=>'0'));

		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/admin_management/employee/editemployee',$data);	
		$this->load->view('admin/footer');

	}//ends else

}//end function

	/********function for Delete employee*******/

	public function delete_employee()
	{
		date_default_timezone_set('Asia/Calcutta'); 
		$created_date =  date("Y-m-d H:i:s"); 
		$delete_itemId = xss_clean(strip_tags($this->input->post('delete_itemId')));
		$data['employee_data'] = $employee_data = $this->Base_model->get_record_by_id('employee', array('employee_id' => $delete_itemId));

		/*****check condition name********/

		$checked = $this->Base_model->check_existent('employee', array('employee_id'=>$delete_itemId,'delete_status'=>0));

		/*****ends check condition name*****/

			if($checked=='1')
			{

					$msg = "Employee already deleted.";
					$this->session->set_flashdata('employee_add_flashError', $msg);
					
					$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
					$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/employee/employeelist',$data);	
					$this->load->view('admin/footer');

			}//ends if

		else
		{

			$update_data = array(
								'status'		=> '0',
								'delete_status' => '0',
								'updated_date' 	=> $created_date
							);

			$updateid = $this->Base_model->update_record_by_id('employee', $update_data, array('employee_id'=> $delete_itemId));
			$msg = "Employee deleted successfully.";
			$this->session->set_flashdata('employee_delete_flashSuccess',$msg);

			/*********logs code*******/

				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s");
				$user_logs_data = array(
								'USERNAME' 	    => $this->session->userdata('user_name'),
								'ROLE'			=> '',
								'USEREMAIL' 	=> $this->session->userdata('user_email'),
								'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
								'LOGINSTATUS' 	=> 'Logged in',
								'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted employee : '.$employee_data->employee_name,
								'ACTIVITYTIME'  => time(),
								'CREATEDDATED'  => $created_date
								
							);

			$this->Base_model->insert_one_row('userlogs', $user_logs_data);

			/*********ends logs code*******/

			$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
			$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/employee/employeelist',$data);	
			$this->load->view('admin/footer');
		}
				
	}//ends function

	/********function for view employee******/

	public function view_employee()
	{
			$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
			$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
			$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
			$data['all_rooms'] = $this->Base_model->get_all_record_by_condition('room_no', array('delete_status'=>1));
			$uri = $this->uri->segment('4');
			$data['employee_data'] = $this->Base_model->get_record_by_id('employee', array('employee_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/employee/viewemployee',$data);	
			$this->load->view('admin/footer');	
	}//ends function

	/*******function to gettting all rooms********/

	public function all_room()
	{
		
		$building_id = strip_tags($this->input->post('id'));
		$all_room =  $this->Base_model->get_all_record_by_condition('room_no', array('building_id'=>$building_id,'status'=>1,'delete_status'=>1));
		$all_rooms =  json_encode($all_room);
		echo  $all_rooms;
	}// ends function

	/*******function for employee search******/
	
	
	/*******function to Approve employee********/

	public function aproove_employee()
	{
		    $uri = $this->uri->segment('4');
			$updateid = $this->Base_model->update_record_by_id('employee', array('approved_status'=>1),array('employee_id'=>$uri));
			$updateid = $this->Base_model->update_record_by_id('users', array('approved_status'=>1),array('employee_id'=>$uri));
			$msg = "Employee approved successfully.";
			$this->session->set_flashdata('employee_aprove_flashSuccess',$msg);	
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/admin_management/employee/pendinglist',$data);	
			$this->load->view('admin/footer');
			
	}// ends function

	/*******function for employee search******/

	public function search_employee()
	{
	
		$employee_name  			= xss_clean(strip_tags($this->input->post('employee_name')));
		$employee_code  			= xss_clean(strip_tags($this->input->post('employee_code')));
		$employee_designation = xss_clean(strip_tags($this->input->post('employee_designation')));
		$status  							= xss_clean(strip_tags($this->input->post('status')));

		if(empty($employee_name) && empty($employee_code) && empty($employee_designation) && empty($status))
				{	
					$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1'));
					$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/employee/employeelist',$data);	
					$this->load->view('admin/footer');
				}//ends if

				else
				{
					$data['all_employee'] = $this->Admin_model->searching_employee($employee_name,$employee_code,$employee_designation,$status);
					$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/employee/employeelist',$data);	
					$this->load->view('admin/footer');

				}//ends else
	}// function ends

	/*******function for pending employee search******/

	public function search_employee_pending()
	{
	
		$employee_name  			= xss_clean(strip_tags($this->input->post('employee_name')));
		$employee_code  			= xss_clean(strip_tags($this->input->post('employee_code')));
		$employee_designation = xss_clean(strip_tags($this->input->post('employee_designation')));
		$status  							= xss_clean(strip_tags($this->input->post('status')));
			
		if(empty($employee_name) && empty($employee_code) && empty($employee_designation) && empty($status))
				{	
					$data['all_employee'] = $this->Base_model->get_all_record_by_condition('employee', array('delete_status'=>'1','approved_status'=>'0'));
					$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/employee/pendinglist',$data);	
					$this->load->view('admin/footer');
				}//ends if

				else
				{
					$data['all_employee'] = $this->Admin_model->searching_employee($employee_name,$employee_code,$employee_designation,$status);
					$data['all_buildings'] = $this->Base_model->get_all_record_by_condition('building', array('status'=>'1','delete_status'=>'1'));
					$data['all_designation'] = $this->Base_model->get_all_record_by_condition('designation', array('delete_status'=>1));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/admin_management/employee/pendinglist',$data);	
					$this->load->view('admin/footer');

				}//ends else
	}// function ends


	
}//class ends


