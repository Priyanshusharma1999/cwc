<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	// Initialize Constructor Here
	function __construct()
	{
			parent::__construct();
			$this->load->model('Base_model');
			if(empty($this->session->userdata('auser_id')))
         {
         	$base_url = base_url().'Frontend/adminnew';
             redirect($base_url);
         } 
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		  $data['all_users'] = $this->Base_model->get_all_record_by_condition('tbl_admin', array('status'=>'1'));
			$this->load->view('mainadmin/header');
			////$this->load->view('mainadmin/topmenu');
			$this->load->view('mainadmin/sidebar');
			$this->load->view('mainadmin/users/regionalofficerslist',$data);
			$this->load->view('mainadmin/footer');

	}//ends function

	/***********function for add users*******/

	public function add_users()
	{

		if(isset($_REQUEST['submit'])) 
		{ 
			$user_type  	= xss_clean($this->input->post('user_type'));
			$user_name  	= xss_clean($this->input->post('user_name'));
			$email  			= xss_clean($this->input->post('email'));
			$contact_no  	= xss_clean($this->input->post('contact_no'));
			$region_name  = xss_clean($this->input->post('region_name'));
			$circle_name  = xss_clean($this->input->post('circle_name'));
			

			$this->form_validation->set_rules('user_type','user type','trim|required');
			$this->form_validation->set_rules('user_name','user name','trim|required');
			$this->form_validation->set_rules('email','email','trim|required');
			$this->form_validation->set_rules('contact_no','contact no.','trim|required');
			$this->form_validation->set_rules('region_name','region name','trim|required');
			$this->form_validation->set_rules('circle_name','circle name','trim|required');


			if($this->form_validation->run() === false) 
				{
						
					$data['insertData'] = array(
						'user_type' 		=> xss_clean($this->input->post('user_type')),
						'user_name'		  => xss_clean($this->input->post('user_name')),
						'email' 				=> xss_clean($this->input->post('email')),
						'contact_no' 		=> xss_clean($this->input->post('contact_no')),
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

						$checked = $this->Base_model->check_existent('tbl_admin', array('user_type' => $user_type,'name' => $user_name,'email' => $email,'Division' => $region_name,'Circle' => $circle_name));

					/*****ends check user name*****/

					if($checked=='1')
					{
						$msg = "User already exits, Please enter new one";
						$this->session->set_flashdata('flashError_user', $msg);
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
													'phone' 				=> $contact_no,
													'password' 			=> md5($password),
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
							$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
							$this->load->view('mainadmin/header');
							//$this->load->view('mainadmin/topmenu');
							$this->load->view('mainadmin/sidebar');
							$this->load->view('mainadmin/users/addregionalofficers',$data);
							$this->load->view('mainadmin/footer');
						}
					}//ends else		
				}//ends main else

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

	}// ends function

	/********function for Edit User******/

	public function edit_user()
	{
		$uri = $this->uri->segment('3');
		if(isset($_REQUEST['submit'])) 
		{

			$uri = $this->uri->segment('3');
			$user_type  	= xss_clean($this->input->post('user_type'));
			$user_name  	= xss_clean($this->input->post('user_name'));
			$email  			= xss_clean($this->input->post('email'));
			$contact_no  	= xss_clean($this->input->post('contact_no'));
			$region_name  = xss_clean($this->input->post('region_name'));
			$circle_name  = xss_clean($this->input->post('circle_name'));
			

			$this->form_validation->set_rules('user_type','user type','trim|required');
			$this->form_validation->set_rules('user_name','user name','trim|required');
			$this->form_validation->set_rules('email','email','trim|required');
			$this->form_validation->set_rules('contact_no','contact no.','trim|required');
			$this->form_validation->set_rules('region_name','region name','trim|required');
			$this->form_validation->set_rules('circle_name','circle name','trim|required');

			if($this->form_validation->run() === false) 
				{

					$uri = $this->uri->segment('3');
					$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
					$data['user_data'] = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));
					$this->load->view('mainadmin/header');
					//$this->load->view('mainadmin/topmenu');
					$this->load->view('mainadmin/sidebar');
					$this->load->view('mainadmin/users/editregionalofficers',$data);
					$this->load->view('mainadmin/footer');

				}//ends if

				else
				{
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s"); 

					/*****check user********/

						$checked = $this->Base_model->check_existent('tbl_admin', array('user_type' => $user_type,'name' => $user_name,'email' => $email,'phone' =>$contact_no ,'Division' => $region_name,'Circle' => $circle_name));

					/*****ends check user name*****/

					if($checked=='1')
					{
						
						$msg = "User updated successfully.";
						$this->session->set_flashdata('flashSuccess_user', $msg);
						$uri = $this->uri->segment('3');
						$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
						$data['user_data'] = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));
						$data['all_users'] = $this->Base_model->get_all_record_by_condition('tbl_admin', array('status'=>'1'));
						$this->load->view('mainadmin/header');
						//$this->load->view('mainadmin/topmenu');
						$this->load->view('mainadmin/sidebar');
						$this->load->view('mainadmin/users/regionalofficerslist',$data);
						$this->load->view('mainadmin/footer');
					}

					else
					{
								
								$get_user_data = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));
								$get_user_data_name = $this->Base_model->check_existent('tbl_admin', array('user_type' => $user_type,'name' => $user_name,'Division' => $region_name,'Circle' => $circle_name));
								$get_user_data_email = $this->Base_model->check_existent('tbl_admin', array('user_type' => $user_type,'email' => $email,'Division' => $region_name,'Circle' => $circle_name));

								if($get_user_data_name=='1')
								{
									if($user_name == $get_user_data->name)
									{	
											$password = xss_clean($this->input->post('password'));
											$update_data = array(
																	'user_type' 		=> $user_type,
																	'name' 					=> $user_name,
																	'email' 				=> $email,
																	'phone' 				=> $contact_no,
																	'password' 			=> md5($password),
																	'Division' 			=> $region_name,
																	'Circle' 				=> $circle_name,
																	'created_date' 	=> $created_date,
																	'updated_date' 	=> $created_date
																);
												
											$updateid = $this->Base_model->update_record_by_id('tbl_admin', $update_data, array('Id'=> $uri));
											$msg = "User updated successfully.";
											$this->session->set_flashdata('flashSuccess_user',$msg);
											$data['all_users'] = $this->Base_model->get_all_record_by_condition('tbl_admin', array('status'=>'1'));
											$this->load->view('mainadmin/header');
											//$this->load->view('mainadmin/topmenu');
											$this->load->view('mainadmin/sidebar');
											$this->load->view('mainadmin/users/regionalofficerslist',$data);
											$this->load->view('mainadmin/footer');
									}//ends if

									else
									{
												$msg = "User name already exits.";
												$this->session->set_flashdata('flashError_user',$msg);
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
												$password = xss_clean($this->input->post('password'));
												$update_data = array(
																	'user_type' 		=> $user_type,
																	'name' 					=> $user_name,
																	'email' 				=> $email,
																	'phone' 				=> $contact_no,
																	'password' 			=> md5($password),
																	'Division' 			=> $region_name,
																	'Circle' 				=> $circle_name,
																	'created_date' 	=> $created_date,
																	'updated_date' 	=> $created_date
																);
												
										$updateid = $this->Base_model->update_record_by_id('tbl_admin', $update_data, array('Id'=> $uri));
												$msg = "User updated successfully.";
												$this->session->set_flashdata('flashSuccess_user',$msg);
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
												$password = xss_clean($this->input->post('password'));
												$update_data = array(
																	'user_type' 		=> $user_type,
																	'name' 					=> $user_name,
																	'email' 				=> $email,
																	'phone' 				=> $contact_no,
																	'password' 			=> md5($password),
																	'Division' 			=> $region_name,
																	'Circle' 				=> $circle_name,
																	'created_date' 	=> $created_date,
																	'updated_date' 	=> $created_date
																);
												
										$updateid = $this->Base_model->update_record_by_id('tbl_admin', $update_data, array('Id'=> $uri));

										if($updateid)
										{
											$msg = "User updated successfully.";
											$this->session->set_flashdata('flashSuccess_user',$msg);
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

		}//ends if

		else
		{
				$uri = $this->uri->segment('3');
				$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
				$data['user_data'] = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));
				$this->load->view('mainadmin/header');
				//$this->load->view('mainadmin/topmenu');
				$this->load->view('mainadmin/sidebar');
				$this->load->view('mainadmin/users/editregionalofficers',$data);
				$this->load->view('mainadmin/footer');
		}//ends else
	}//ends function

	/********function for View User******/

	public function view_user()
	{
				$uri = $this->uri->segment('3');
				$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));
				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
				$data['user_data'] = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));
				$this->load->view('mainadmin/header');
				//$this->load->view('mainadmin/topmenu');
				$this->load->view('mainadmin/sidebar');
				$this->load->view('mainadmin/users/viewregionalofficers',$data);
				$this->load->view('mainadmin/footer');
	}//ends function


}//class ends
