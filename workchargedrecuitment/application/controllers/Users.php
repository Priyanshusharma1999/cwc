<?php

error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');



class Users extends CI_Controller {



	// Initialize Constructor Here

	function __construct()

	{

			parent::__construct();

			$this->load->model('Base_model');

			$admindata = $this->Base_model->get_record_by_id('tbl_admin', array('id' =>$this->session->userdata('auser_id')));

			if(empty($this->session->userdata('auser_id')))

	         {

	         	$base_url = base_url().'Frontend/logout';

	             redirect($base_url);

	         } 

	         if($admindata->password != $this->session->userdata('apwd'))

			 {

			 	 $base_url = base_url().'Frontend/logout';

			     redirect($base_url);

			 }

	}



	/**

	 * Index Page for this controller.

	 */

	public function index()

	{
		 $segment_id = $this->uri->segment('3');
		 $uri = $this->session->userdata('auser_id');

		 if($segment_id!=$uri)
		 {
			$base_url = base_url();
			redirect($base_url.'Frontend/logout');
		 }

		 else
		 {
		 		$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

		  	$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

		  	$data['all_users'] = $this->Base_model->get_all_record_by_condition('tbl_admin', array('status'=>'1'));

				$this->load->view('mainadmin/header');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/users/regionalofficerslist',$data);

				$this->load->view('mainadmin/footer');


		 }//ends else session check

	}//ends function



	/***********function for add users*******/

	public function add_users()

	{
		 $segment_id = $this->uri->segment('3');
		 $uri = $this->session->userdata('auser_id');

		 if($segment_id!=$uri)
		 {
			$base_url = base_url();
			redirect($base_url.'Frontend/logout');
		 }

		 else
		 {

		 		if(isset($_REQUEST['submit'])) 

		{ 

			$user_type  	= xss_clean(strip_tags($this->input->post('user_type')));

			$user_name  	= xss_clean(strip_tags($this->input->post('user_name')));

			$email  			= xss_clean(strip_tags($this->input->post('email')));

			$contact_no  	= xss_clean(strip_tags($this->input->post('contact_no')));

			$region_name  = xss_clean(strip_tags($this->input->post('region_name')));

			$circle_name  = xss_clean(strip_tags($this->input->post('circle_name')));

			$user_id  		= xss_clean(strip_tags($this->input->post('user_id')));

			$password 	  = xss_clean(strip_tags($this->input->post('password')));

			$cnfrm_password = xss_clean(strip_tags($this->input->post('cnfrm_password')));



			if($password != $cnfrm_password)

			{

					$msg = "Password and confirm password not match.";

					$this->session->set_flashdata('flashError_user', $msg);

					/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to add user, password not match',
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$data['insertData'] = array(

						'user_type' 		=> xss_clean($this->input->post('user_type')),

						'user_name'		  => xss_clean($this->input->post('user_name')),

						'email' 				=> xss_clean($this->input->post('email')),

						'contact_no' 		=> xss_clean($this->input->post('contact_no')),

						'user_id' 			=> xss_clean($this->input->post('user_id')),

						'region_name' 	=> xss_clean($this->input->post('region_name')),

						'circle_name' 	=> xss_clean($this->input->post('circle_name')),

					);

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/users/addregionalofficers',$data);

					$this->load->view('mainadmin/footer');

			}

			else

			{ 

			$this->form_validation->set_rules('user_type','user type','trim|required');

			$this->form_validation->set_rules('user_name','user name','trim|required');

			$this->form_validation->set_rules('contact_no','contact no.','trim|required');

			$this->form_validation->set_rules('user_id','user id','trim|required');

			if($this->form_validation->run() === false) 

				{

						

					$data['insertData'] = array(

						'user_type' 		=> xss_clean($this->input->post('user_type')),

						'user_name'		  => xss_clean($this->input->post('user_name')),

						'email' 				=> xss_clean($this->input->post('email')),

						'contact_no' 		=> xss_clean($this->input->post('contact_no')),

						'user_id' 		=> xss_clean($this->input->post('user_id')),

						'region_name' 	=> xss_clean($this->input->post('region_name')),

						'circle_name' 	=> xss_clean($this->input->post('circle_name')),

					);



					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					////$this->load->view('mainadmin/topmenu');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/users/addregionalofficers',$data);

					$this->load->view('mainadmin/footer');



				}//ends if



				else

				{

					date_default_timezone_set('Asia/Calcutta'); 

					$created_date =  date("Y-m-d H:i:s"); 



					/*****check user********/



						$checked = $this->Base_model->check_existent('tbl_admin', array('user_type' => $user_type,'name' => $user_name,'email' => $email,'Division' => $region_name,'Circle' => $circle_name,'user_id'=> $user_id));



						$checked_user = $this->Base_model->check_existent('tbl_admin', array('user_type' => $user_type,'user_id'=> $user_id));



						$checked_user_id = $this->Base_model->check_existent('tbl_admin', array('user_id'=> $user_id));



						$checked_email = $this->Base_model->check_existent('tbl_admin', array('email' => $email));



					/*****ends check user name*****/



					if($checked=='1')

					{

						$msg = "User already exits, Please enter new one";

						$this->session->set_flashdata('flashError_user', $msg);

						/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to add user, user already exits',
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

						$this->load->view('mainadmin/header');

					//	//$this->load->view('mainadmin/topmenu');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/users/addregionalofficers',$data);

						$this->load->view('mainadmin/footer');

					}



					else if($checked_user=='1')

					{

						$msg = "User already exits, Please enter new one";

						$this->session->set_flashdata('flashError_user', $msg);

						/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to add user, user already exits',
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

						$this->load->view('mainadmin/header');

					//	//$this->load->view('mainadmin/topmenu');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/users/addregionalofficers',$data);

						$this->load->view('mainadmin/footer');

					}



					else if($checked_user_id=='1')

					{

						$msg = "UserId already exits, Please enter new one";

						$this->session->set_flashdata('flashError_user', $msg);

						/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to add user, user already exits',
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

						$this->load->view('mainadmin/header');

					//	//$this->load->view('mainadmin/topmenu');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/users/addregionalofficers',$data);

						$this->load->view('mainadmin/footer');

					}



					else if($checked_email=='1')

					{

						$msg = "Email already exits, Please enter new one";

						$this->session->set_flashdata('flashError_user', $msg);

						/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to add user, email already exits',
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

						$this->load->view('mainadmin/header');

					//	//$this->load->view('mainadmin/topmenu');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/users/addregionalofficers',$data);

						$this->load->view('mainadmin/footer');

					}
					else

					{

							$password = xss_clean($this->input->post('password'));

							$insert_data = array(

													'user_type' 		=> $user_type,

													'name' 					=> $user_name,

													'email' 				=> $email,

													'user_id'				=> $user_id,

													'phone' 				=> $contact_no,

													'password' 			=> $password,

													'Division' 			=> $region_name,

													'Circle' 				=> $circle_name,

													'created_date' 	=> $created_date,

													'updated_date' 	=> $created_date

												);

						$insertid = $this->Base_model->insert_one_row('tbl_admin', $insert_data);



						if($insertid)

						{

							$msg = "User added successfully.";

							$this->session->set_flashdata('flashSuccess_user',$msg);

							/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' user added successfully :'.$user_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

							$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							//$this->load->view('mainadmin/topmenu');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/users/addregionalofficers',$data);

							$this->load->view('mainadmin/footer');

						}



						else

						{

							$msg = "Fail to add user.";

							$this->session->set_flashdata('flashError_user', $msg);

							/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to add user',
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/


							$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							//$this->load->view('mainadmin/topmenu');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/users/addregionalofficers',$data);

							$this->load->view('mainadmin/footer');

						}

					}//ends else		

				}//ends main else

			}//ends conditional else

		}//ends if

		else

		{

			$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

			$this->load->view('mainadmin/header');

			//$this->load->view('mainadmin/topmenu');

			$this->load->view('mainadmin/sidebar');

			$this->load->view('mainadmin/users/addregionalofficers',$data);

			$this->load->view('mainadmin/footer');


		}//ends else	

	}//ends else session check


	}// ends function

	/********function for Edit User******/

	public function edit_user()

	{
		  $segment_id = $this->uri->segment('4');

			$session_id = $this->session->userdata('auser_id');

			if($session_id!=$segment_id)
			{

			$base_url = base_url();

			redirect($base_url.'Frontend/logout');

			}

			else
			{

		$uri = $this->uri->segment('3');

		if(isset($_REQUEST['submit'])) 

		{
		
			$uri = $this->uri->segment('3');

			$user_type  	= xss_clean(strip_tags($this->input->post('user_type')));

			$user_name  	= xss_clean(strip_tags($this->input->post('user_name')));

			$email  		= xss_clean(strip_tags($this->input->post('email')));

			$user_id  		= xss_clean(strip_tags($this->input->post('user_id')));

			$contact_no  	= xss_clean(strip_tags($this->input->post('contact_no')));

			$region_name  = xss_clean(strip_tags($this->input->post('region_name')));

			$circle_name  = xss_clean(strip_tags($this->input->post('circle_name')));

			$password 	  = xss_clean(strip_tags($this->input->post('passworrd')));

			$old_pwd 	  	= xss_clean(strip_tags($this->input->post('old_passworrd')));

			$cnfrm_password = xss_clean(strip_tags($this->input->post('cnfrm_passworrd')));

			$usersData = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

			if($password != $cnfrm_password)

			{

					$msg = "Password and confirm password not match.";

					$this->session->set_flashdata('flashError_user', $msg);

					/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to update user, password not match :'. $user_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/


				$uri = $this->uri->segment('3');

				$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

				$data['user_data'] = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

				$this->load->view('mainadmin/header');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/users/editregionalofficers',$data);

				$this->load->view('mainadmin/footer');

			}// ends if

			else if($usersData->password != $old_pwd)

			{

					$msg = "Old Password not matched.";

					$this->session->set_flashdata('flashError_user', $msg);

					/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to add user, old password not match :'.$user_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

				$uri = $this->uri->segment('3');

				$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

				$data['user_data'] = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

				$this->load->view('mainadmin/header');

				//$this->load->view('mainadmin/topmenu');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/users/editregionalofficers',$data);

				$this->load->view('mainadmin/footer');

			}// ends if

			else

			{

			$this->form_validation->set_rules('user_type','user type','trim|required');

			$this->form_validation->set_rules('user_name','user name','trim|required');

			$this->form_validation->set_rules('contact_no','contact no.','trim|required');

			$this->form_validation->set_rules('user_id','user id','trim|required');



			if($this->form_validation->run() === false) 

				{

					$uri = $this->uri->segment('3');

					$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$data['user_data'] = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/users/editregionalofficers',$data);

					$this->load->view('mainadmin/footer');


				}//ends if



				else

				{ 
					$uri = $this->uri->segment('3');
					date_default_timezone_set('Asia/Calcutta'); 

					$created_date =  date("Y-m-d H:i:s"); 

					/*****check user********/
						$checked = $this->Base_model->check_existent('tbl_admin', array('user_type' => $user_type,'name' => $user_name,'email' => $email,'phone' =>$contact_no ,'Division' => $region_name,'Circle' => $circle_name,'user_id'=> $user_id));

						$checked_user = $this->Base_model->check_userr('tbl_admin', array('user_type' => $user_type),$user_id);

						//print_r($checked_user);exit;

						$checked_user_id = $this->Base_model->check_existent('tbl_admin', array('user_id'=> $user_id));



						$checked_email = $this->Base_model->check_existent_user_email($email,$user_id);



					/*****ends check user name*****/

					$uri = $this->uri->segment('3');
					$usersData = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));
					if($checked=='1')

					{
						
						if(empty($password))
											{
														$update_data = array(

																	'user_type' 		=> $user_type,

																	'name' 					=> $user_name,

																	'email' 				=> $email,

																	'phone' 				=> $contact_no,

																	'password' 			=> $usersData->password,

																	'user_id'				=> $user_id,

																	'Division' 			=> $region_name,

																	'Circle' 				=> $circle_name,

																	'created_date' 	=> $created_date,

																	'updated_date' 	=> $created_date

																);

											}

											else
											{
															$update_data = array(

																	'user_type' 		=> $user_type,

																	'name' 					=> $user_name,

																	'email' 				=> $email,

																	'phone' 				=> $contact_no,

																	'password' 			=> $password,

																	'user_id'				=> $user_id,

																	'Division' 			=> $region_name,

																	'Circle' 				=> $circle_name,

																	'created_date' 	=> $created_date,

																	'updated_date' 	=> $created_date

																);
											}
										
												
											

												

						$updateid = $this->Base_model->update_record_by_id('tbl_admin', $update_data, array('Id'=> $uri));

						$msg = "User updated successfully.";

						$this->session->set_flashdata('flashSuccess_user', $msg);

						/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' user updated successfully :'.$user_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

						$uri = $this->uri->segment('3');

						$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

						$data['user_data'] = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

						$data['all_users'] = $this->Base_model->get_all_record_by_condition('tbl_admin', array('status'=>'1'));

						$this->load->view('mainadmin/header');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/users/regionalofficerslist',$data);

						$this->load->view('mainadmin/footer');

					}

						else if($checked_user=='0')

					{
					
						$msg = "User already exits, Please enter new one";

						$this->session->set_flashdata('flashError_user', $msg);

						/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to updated user, user already exits :'.$user_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

						$uri = $this->uri->segment('3');

						$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

						$data['user_data'] = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

						$this->load->view('mainadmin/header');

						//$this->load->view('mainadmin/topmenu');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/users/editregionalofficers',$data);

						$this->load->view('mainadmin/footer');

					}



					else if($checked_email=='1')

					{
						
						$msg = "Email already exits, Please enter new one";

						$this->session->set_flashdata('flashError_user', $msg);

						/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to updated user, email already exits :'.$user_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

						$uri = $this->uri->segment('3');

						$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

						$data['user_data'] = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

						$this->load->view('mainadmin/header');

						//$this->load->view('mainadmin/topmenu');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/users/editregionalofficers',$data);

						$this->load->view('mainadmin/footer');

					}



					else

					{
						
								$get_user_data = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

								$get_user_data_name = $this->Base_model->check_existent('tbl_admin', array('user_type' => $user_type,'name' => $user_name,'Division' => $region_name,'Circle' => $circle_name,'user_id'=>$user_id));

								$get_user_data_email = $this->Base_model->check_existent('tbl_admin', array('user_type' => $user_type,'email' => $email,'Division' => $region_name,'Circle' => $circle_name,'user_id'=>$user_id));



								if($get_user_data_name=='1')

								{

									if($user_name == $get_user_data->name)

									{	

											$password = xss_clean($this->input->post('passworrd'));
											$usersData = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

											if(empty($password))
											{
														$update_data = array(

																	'user_type' 		=> $user_type,

																	'name' 					=> $user_name,

																	'email' 				=> $email,

																	'phone' 				=> $contact_no,

																	'password' 			=> $usersData->password,

																	'user_id'				=> $user_id,

																	'Division' 			=> $region_name,

																	'Circle' 				=> $circle_name,

																	'created_date' 	=> $created_date,

																	'updated_date' 	=> $created_date

																);

											}

											else
											{
															$update_data = array(

																	'user_type' 		=> $user_type,

																	'name' 					=> $user_name,

																	'email' 				=> $email,

																	'phone' 				=> $contact_no,

																	'password' 			=> $password,

																	'user_id'				=> $user_id,

																	'Division' 			=> $region_name,

																	'Circle' 				=> $circle_name,

																	'created_date' 	=> $created_date,

																	'updated_date' 	=> $created_date

																);
											}
										

												

											$updateid = $this->Base_model->update_record_by_id('tbl_admin', $update_data, array('Id'=> $uri));

											$msg = "User updated successfully.";

											$this->session->set_flashdata('flashSuccess_user',$msg);

											/*********logs code*******/

									date_default_timezone_set('Asia/Calcutta'); 
									$created_date =  date("Y-m-d H:i:s");
									$user_logs_data = array(
													'USERNAME' 	    => $this->session->userdata('ausername'),
													'ROLE'			=> $this->session->userdata('auser_type'),
													'USEREMAIL' 	=> $this->session->userdata('aemail'),
													'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
													'LOGINSTATUS' 	=> 'Logged in',
													'ACTIVITY' 		=> $this->session->userdata('ausername').' user updated successfully :'.$user_name,
													'ACTIVITYTIME'  => time(),
													'CREATEDDATED'  => $created_date
													
												);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

											$data['all_users'] = $this->Base_model->get_all_record_by_condition('tbl_admin', array('status'=>'1'));

											$this->load->view('mainadmin/header');

											$this->load->view('mainadmin/sidebar');

											$this->load->view('mainadmin/users/regionalofficerslist',$data);

											$this->load->view('mainadmin/footer');

									}//ends if



									else

									{

												$msg = "User name already exits.";

												$this->session->set_flashdata('flashError_user',$msg);

												/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('ausername'),
															'ROLE'			=> $this->session->userdata('auser_type'),
															'USEREMAIL' 	=> $this->session->userdata('aemail'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to update user,user name already exits :'.$user_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

												$data['all_users'] = $this->Base_model->get_all_record_by_condition('tbl_admin', array('status'=>'1'));

												$this->load->view('mainadmin/header');

												//$this->load->view('mainadmin/topmenu');

												$this->load->view('mainadmin/sidebar');

												$this->load->view('mainadmin/users/regionalofficerslist',$data);

												$this->load->view('mainadmin/footer');

									}//ends else

								

								}



								else if($get_user_data_email=='1')

								{

									if($email == $get_user_data->email)

									{

												$password = xss_clean($this->input->post('passworrd'));
												$usersData = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

												if(empty($password))
												{

													$update_data = array(

																	'user_type' 		=> $user_type,

																	'name' 					=> $user_name,

																	'email' 				=> $email,

																	'user_id'				=> $user_id,

																	'password'				=> $usersData->password,

																	'phone' 				=> $contact_no,

																	'Division' 			=> $region_name,

																	'Circle' 				=> $circle_name,

																	'created_date' 	=> $created_date,

																	'updated_date' 	=> $created_date

																);

												}

												else
												{
													$update_data = array(

																	'user_type' 		=> $user_type,

																	'name' 					=> $user_name,

																	'email' 				=> $email,

																	'user_id'				=> $user_id,

																	'phone' 				=> $contact_no,

																	'password' 			=> $password,

																	'Division' 			=> $region_name,

																	'Circle' 				=> $circle_name,

																	'created_date' 	=> $created_date,

																	'updated_date' 	=> $created_date

																);
												}

												

										$updateid = $this->Base_model->update_record_by_id('tbl_admin', $update_data, array('Id'=> $uri));

												$msg = "User updated successfully.";

												$this->session->set_flashdata('flashSuccess_user',$msg);

												/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('ausername'),
															'ROLE'			=> $this->session->userdata('auser_type'),
															'USEREMAIL' 	=> $this->session->userdata('aemail'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('ausername').' user update successfully :'.$user_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

									$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				/*********ends logs code*******/

												$data['all_users'] = $this->Base_model->get_all_record_by_condition('tbl_admin', array('status'=>'1'));

												$this->load->view('mainadmin/header');

												//$this->load->view('mainadmin/topmenu');

												$this->load->view('mainadmin/sidebar');

												$this->load->view('mainadmin/users/regionalofficerslist',$data);

												$this->load->view('mainadmin/footer');

									}



									else

									{

											$msg = "User email already exits.";

											$this->session->set_flashdata('flashError_user',$msg);

											/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('ausername'),
															'ROLE'			=> $this->session->userdata('auser_type'),
															'USEREMAIL' 	=> $this->session->userdata('aemail'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to update user,user email already exits :'.$user_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

											$data['all_users'] = $this->Base_model->get_all_record_by_condition('tbl_admin', array('status'=>'1'));

											$this->load->view('mainadmin/header');

											//$this->load->view('mainadmin/topmenu');

											$this->load->view('mainadmin/sidebar');

											$this->load->view('mainadmin/users/regionalofficerslist',$data);

											$this->load->view('mainadmin/footer');

									}

									

								}



								else

								{

												$password = xss_clean($this->input->post('passworrd'));
												$usersData = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

												if(empty($password))
												{
															$update_data = array(

																	'user_type' 		=> $user_type,

																	'name' 					=> $user_name,

																	'email' 				=> $email,

																	'phone' 				=> $contact_no,

																	'user_id'				=> $user_id,

																	'password' 			=> $usersData->password,

																	'Division' 			=> $region_name,

																	'Circle' 				=> $circle_name,

																	'created_date' 	=> $created_date,

																	'updated_date' 	=> $created_date

																);
												}

												else
												{
															$update_data = array(

																	'user_type' 		=> $user_type,

																	'name' 					=> $user_name,

																	'email' 				=> $email,

																	'phone' 				=> $contact_no,

																	'user_id'				=> $user_id,

																	'password' 			=> $password,

																	'Division' 			=> $region_name,

																	'Circle' 				=> $circle_name,

																	'created_date' 	=> $created_date,

																	'updated_date' 	=> $created_date

																);
												}
											

												

										$updateid = $this->Base_model->update_record_by_id('tbl_admin', $update_data, array('Id'=> $uri));



										if($updateid)

										{

											$msg = "User updated successfully.";

											$this->session->set_flashdata('flashSuccess_user',$msg);

											/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('ausername'),
															'ROLE'			=> $this->session->userdata('auser_type'),
															'USEREMAIL' 	=> $this->session->userdata('aemail'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('ausername').' user updated successfully :'.$user_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

											$data['all_users'] = $this->Base_model->get_all_record_by_condition('tbl_admin', array('status'=>'1'));

											$this->load->view('mainadmin/header');

											//$this->load->view('mainadmin/topmenu');

											$this->load->view('mainadmin/sidebar');

											$this->load->view('mainadmin/users/regionalofficerslist',$data);

											$this->load->view('mainadmin/footer');

										}



										else

										{

											$msg = "Fail to update user.";

											$this->session->set_flashdata('flashError_user', $msg);

											/*********logs code*******/

											date_default_timezone_set('Asia/Calcutta'); 
											$created_date =  date("Y-m-d H:i:s");
											$user_logs_data = array(
															'USERNAME' 	    => $this->session->userdata('ausername'),
															'ROLE'			=> $this->session->userdata('auser_type'),
															'USEREMAIL' 	=> $this->session->userdata('aemail'),
															'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
															'LOGINSTATUS' 	=> 'Logged in',
															'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to update user :'.$user_name,
															'ACTIVITYTIME'  => time(),
															'CREATEDDATED'  => $created_date
															
														);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

									/*********ends logs code*******/

											$data['all_users'] = $this->Base_model->get_all_record_by_condition('tbl_admin', array('status'=>'1'));

											$this->load->view('mainadmin/header');

											//$this->load->view('mainadmin/topmenu');

											$this->load->view('mainadmin/sidebar');

											$this->load->view('mainadmin/users/regionalofficerslist',$data);

											$this->load->view('mainadmin/footer');

										}

								}//ends else

					}

				}//ends else

			}// ends cncdtional else

		}//ends if

		else
		{

				$uri = $this->uri->segment('3');

				$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

				$data['user_data'] = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

				$this->load->view('mainadmin/header');

				//$this->load->view('mainadmin/topmenu');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/users/editregionalofficers',$data);

				$this->load->view('mainadmin/footer');

		}//ends else

			}// ends else session check

		

	}//ends function



	/********function for View User******/



	public function view_user()

	{

				$uri = $this->uri->segment('3');

				$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

				$data['user_data'] = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));

				$this->load->view('mainadmin/header');

				//$this->load->view('mainadmin/topmenu');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/users/viewregionalofficers',$data);

				$this->load->view('mainadmin/footer');

	}//ends function





	/********function for Search User******/



	public function search_user()

	{

			

			$region_name = xss_clean($this->input->post('region_name'));

			$circle_name = xss_clean($this->input->post('circle_name'));



			if(empty($region_name) && empty($circle_name))

				{

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

		 		  $data['all_users'] = $this->Base_model->get_all_record_by_condition('tbl_admin', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/users/regionalofficerslist',$data);

					$this->load->view('mainadmin/footer');



				}//ends if



				else

				{



					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

		 		  $data['all_users'] = $this->Base_model->search_user($region_name,$circle_name);

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/users/regionalofficerslist',$data);

					$this->load->view('mainadmin/footer');



				}//ends else

	}//function ends





}//class ends

