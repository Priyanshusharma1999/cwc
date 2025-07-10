<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

	// Initialize Constructor Here
	function __construct()
	{
		parent::__construct();
		$this->load->model('Base_model');
		$this->load->model('Contact_model');
		if(empty($this->session->userdata('user_id')))
	     {
	     	$base_url = base_url().'Frontend';
	        redirect($base_url);
	     } 
		
	}

	/**
	 * Index Page for this controller.
	 */
	public function index()
	{
		$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
		$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_contact');
		$this->load->view('admin/contact_management/post/postlist',$data);	
		$this->load->view('admin/footer');
	}//ends function

	/***************function for add post***************/

	public function add_post()
	{	
		if(isset($_REQUEST['submit'])) 
		{
			$post_name  	  = xss_clean(strip_tags($this->input->post('post_name')));
			$organisation_name  	  = xss_clean(strip_tags($this->input->post('organisation_name')));
			$this->form_validation->set_rules('post_name','post name','trim|required');
			$this->form_validation->set_rules('organisation_name','organisation name','trim|required');
			if($this->form_validation->run() === false) 
				{

						$data['insertData'] = array(
							'post_name' => xss_clean(strip_tags($this->input->post('post_name'))),
							'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name')))		
						);
						$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar_contact');
						$this->load->view('admin/contact_management/post/addpost',$data);	
						$this->load->view('admin/footer');
				}//ends if

				else
				{
					$post_name  	  = xss_clean(strip_tags($this->input->post('post_name')));
					$organisation_name  	  = xss_clean(strip_tags($this->input->post('organisation_name')));
					$ip_address					= $_SERVER['REMOTE_ADDR'];
					$session_id 				= $this->session->userdata('user_id');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");

					/*****check post name********/

						$checked = $this->Base_model->check_existent('contact_post', array('contact_post_name'=> $post_name,'contact_organisation_id'=>$organisation_name,'delete_status'=>1));

					/*****ends check post name*****/

					if($checked=='1')
						{
							$msg = "Post name already exits for this organisation, Please enter new one";
							$this->session->set_flashdata('flashError_post', $msg);

							/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add contact post : '.$post_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

							$data['insertData'] = array(
							'post_name' => xss_clean(strip_tags($this->input->post('post_name')))	
							);
							$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar_contact');
							$this->load->view('admin/contact_management/post/addpost',$data);	
							$this->load->view('admin/footer');
						}//ends if

						else
						{
							
								$insert_data = array(
													'contact_post_name'			=> $post_name,
													'contact_organisation_id'			=> $organisation_name,
													'client_ip' 						=> $ip_address,
													'modified_by' 					=> $session_id,
													'created_date' 					=> $created_date,
													'updated_date' 					=> $created_date
												);
							 $insertid = $this->Base_model->insert_one_row('contact_post', $insert_data);

							 if($insertid)
								{
									$msg = "Post added successfully.";
									$this->session->set_flashdata('post_add_flashSuccess',$msg);

									/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' add contact post successfully : '.$post_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/post/postlist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to add post.";
									$this->session->set_flashdata('post_add_flashError',$msg);

									/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add contact post : '.$post_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/post/postlist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}

		else
		{
			$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/post/addpost',$data);	
			$this->load->view('admin/footer');
		}
	}//ends function

	/*****************function for update post***************/

		public function edit_post()
	{	
		$uri = $this->uri->segment('4');
		if(isset($_REQUEST['submit'])) 
		{
			$post_name  	  = xss_clean(strip_tags($this->input->post('post_name')));
			$organisation_name  	  = xss_clean(strip_tags($this->input->post('organisation_name')));
			$this->form_validation->set_rules('post_name','post name','trim|required');
			$this->form_validation->set_rules('organisation_name','organisation name','trim|required');
			if($this->form_validation->run() === false) 
				{

						$data['insertData'] = array(
							'post_name' => xss_clean(strip_tags($this->input->post('post_name'))),
							'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name')))		
						);
						$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));	
						$uri = $this->uri->segment('4');
						$data['post_data'] = $this->Base_model->get_record_by_id('contact_post', array('contact_post_id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar_contact');
					$this->load->view('admin/contact_management/post/editpost',$data);	
					$this->load->view('admin/footer');
					
				}//ends if

				else
				{
					$post_name  = xss_clean(strip_tags($this->input->post('post_name')));
					$organisation_name  = xss_clean(strip_tags($this->input->post('organisation_name')));
					$ip_address						= $_SERVER['REMOTE_ADDR'];
					$session_id 					= $this->session->userdata('user_id');
					$uri 									= $this->uri->segment('4');
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
			 

					/*****check post name********/

						$checked = $this->Contact_model->check_existent_post($post_name,$organisation_name,$uri);

					/*****ends check post name*****/

						if($checked=='1')
						{
								$msg = "Post name already exits, Please enter new one";
								$this->session->set_flashdata('flashError_post', $msg);

								/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update contact post, already exits : '.$post_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

								$data['insertData'] = array(
								'post_name' => xss_clean(strip_tags($this->input->post('post_name'))),
								'organisation_name' => xss_clean(strip_tags($this->input->post('organisation_name')))		
							);
							$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));	
							$uri = $this->uri->segment('4');
							$data['post_data'] = $this->Base_model->get_record_by_id('contact_post', array('contact_post_id' => $uri));
							
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar_contact');
							$this->load->view('admin/contact_management/post/editpost',$data);	
							$this->load->view('admin/footer');
						}//ends if

						else
						{
								$uri = $this->uri->segment('4');
								$update_data = array(
													'contact_post_name'			=> $post_name,
													'contact_organisation_id'			=> $organisation_name,
													'client_ip' 						=> $ip_address,
													'modified_by' 					=> $session_id,
													'updated_date' 					=> $created_date
												);
							 $updateid = $this->Base_model->update_record_by_id('contact_post', $update_data, array('contact_post_id'=> $uri));

							 if($updateid)
								{
									$msg = "Post updated successfully.";
									$this->session->set_flashdata('post_add_flashSuccess',$msg);

									/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' contact post updated successfully : '.$post_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/post/postlist',$data);	
									$this->load->view('admin/footer');
								}

								else
								{
									$msg = "Failed to update post.";
									$this->session->set_flashdata('building_add_flashError',$msg);

									/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update contact post : '.$post_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

									$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
									$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_contact');
									$this->load->view('admin/contact_management/post/postlist',$data);	
									$this->load->view('admin/footer');
								}

						}//ends else
				}//ends main else
		}//ends if

		else
		{
			$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));	
			$uri = $this->uri->segment('4');
			$data['post_data'] = $this->Base_model->get_record_by_id('contact_post', array('contact_post_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/post/editpost',$data);	
			$this->load->view('admin/footer');
		}//ends else

	}//end function

		/********function for View post******/

	public function view_post()
	{
			$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));	
			$uri = $this->uri->segment('4');
			$data['post_data'] = $this->Base_model->get_record_by_id('contact_post', array('contact_post_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar_contact');
			$this->load->view('admin/contact_management/post/viewpost',$data);	
			$this->load->view('admin/footer');
	}//ends function


	/*****************function for delete post**********/

	public function delete_post()
	{
				date_default_timezone_set('Asia/Calcutta'); 
				$created_date =  date("Y-m-d H:i:s"); 
				$delete_itemId = xss_clean(strip_tags($this->input->post('delete_itemId')));
				$data['post_data'] = $post_data = $this->Base_model->get_record_by_id('contact_post', array('contact_post_id' => $delete_itemId));

					/*****check post name********/

						$checked = $this->Base_model->check_existent('contact_post', array('contact_post_id'=> $delete_itemId,'delete_status'=>0));

					/*****ends check post name*****/

						if($checked=='1')
						{
								$msg = "Post already deleted.";
								$this->session->set_flashdata('post_add_flashError', $msg);
								
									/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted contact post : '.$post_data->contact_post_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

								$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
								$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar_contact');
								$this->load->view('admin/contact_management/post/postlist',$data);	
								$this->load->view('admin/footer');
						}//ends if

						else
						{
								$update_data = array(
													'status'				=> '0',
													'delete_status' => '0',
													'updated_date' 	=> $created_date
												);
								$updateid = $this->Base_model->update_record_by_id('contact_post', $update_data, array('contact_post_id'=> $delete_itemId));
								$msg = "Post deleted successfully.";
								$this->session->set_flashdata('post_delete_flashSuccess',$msg);

								/*********logs code*******/
								
										date_default_timezone_set('Asia/Calcutta'); 
										$created_date =  date("Y-m-d H:i:s");
										$user_logs_data = array(
														'USERNAME' 	    => $this->session->userdata('user_name'),
														'ROLE'			=> '',
														'USEREMAIL' 	=> $this->session->userdata('user_email'),
														'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
														'LOGINSTATUS' 	=> 'Logged in',
														'ACTIVITY' 		=> $this->session->userdata('user_name').' deleted contact post : '.$post_data->contact_post_name,
														'ACTIVITYTIME'  => time(),
														'CREATEDDATED'  => $created_date
														
													);

										$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/
							
								$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
								$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
								$this->load->view('admin/header');
								$this->load->view('admin/sidebar_contact');
								$this->load->view('admin/contact_management/post/postlist',$data);	
								$this->load->view('admin/footer');
						}
				
	}//ends function

	/*********function for search post***********/

	public function search_post()
	{ 
		$post_name  	  = xss_clean(strip_tags($this->input->post('post_name')));

			if(empty($post_name))
			{
				$data['all_post'] = $this->Base_model->get_all_record_by_condition('contact_post', array('delete_status'=>1));
				$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar_contact');
				$this->load->view('admin/contact_management/post/postlist',$data);	
				$this->load->view('admin/footer');
			}

			else
			{
				$data['all_post'] = $this->Contact_model->search_post($post_name);
				$data['all_organisations'] = $this->Base_model->get_all_record_by_condition('contact_organisation', array('delete_status'=>1));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar_contact');
				$this->load->view('admin/contact_management/post/postlist',$data);	
				$this->load->view('admin/footer');
			}
		}//ends function



	

	
}//class ends


