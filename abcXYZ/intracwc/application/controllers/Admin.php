<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {


    function __construct()
	{
			parent::__construct();
			$this->load->model('Base_model');
			
			if(empty($this->session->userdata('user_id')))
			 {
				$base_url = base_url();
				 redirect($base_url);
			 } 
			
	}
	 
	 
	public function index()
	{

		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');
		$this->load->view('admin/dashboard');
		$this->load->view('admin/footer');
	
	}
		
	
	
	/*********************** Profile *******************************/
	
	public function profile()
	{
		$segment_id = $this->uri->segment('3');

			$uriii = $this->session->userdata('user_id');

			if($segment_id!=$uriii)
			{
				$base_url = base_url();
				redirect($base_url.'Frontend/logout');
			}

			else
			{	
				$uri = $this->uri->segment('3');
				$data['user_data'] 	 = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar_permission');
				$this->load->view('admin/profile',$data);
				$this->load->view('admin/footer');

			}// ends else
		
	}//ends function
	
	public function editprofile()
	{	
			$segment_id = $this->uri->segment('3');

			$uriii = $this->session->userdata('user_id');

			if($segment_id!=$uriii)
			{
				
				$base_url = base_url();
				redirect($base_url.'Frontend/logout');
			}
			else
			{
				$uri = $this->uri->segment('3');
			if(isset($_REQUEST['submit'])) 
			{

			  $user_name  = xss_clean($this->input->post('user_name'));
			  $email  = xss_clean($this->input->post('email'));
			  $contact_no  = xss_clean($this->input->post('contact_no'));
			  $password  = xss_clean($this->input->post('password2'));
			  $old_password  = xss_clean($this->input->post('old_passworrd'));
			  $cnfrm_password  = xss_clean($this->input->post('cnfrm_passworrd'));

				$this->form_validation->set_rules('user_name','user name','trim|required');
				$this->form_validation->set_rules('email','email','trim|required');
				$this->form_validation->set_rules('contact_no','contact no','trim|required');
			
				if($this->form_validation->run() === false) 
					{
							$data['insertData'] = array(
							'user_name' => xss_clean($this->input->post('user_name')),
							'email' => xss_clean($this->input->post('email')),
							'contact_no' => xss_clean($this->input->post('contact_no')),
							'password2' => xss_clean($this->input->post('password2')),
							);

							$data['user_data'] 	 = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar_permission');
							$this->load->view('admin/editprofile',$data);
							$this->load->view('admin/footer');
					}// ends if

				else
					{
						$userDataa 	 = $this->Base_model->get_record_by_id('users', array('user_id' => $uri)); 

						$finfo = new finfo(FILEINFO_MIME_TYPE);
						$uploaded_file_name  = $_FILES['user_pic']['name'];
						$count_dots = substr_count($uploaded_file_name, '.');

						if($password != $cnfrm_password )
						{
							$msg = "Password and Confirm Password are not matched.";
							$this->session->set_flashdata('flashError_profileupdate',$msg);
							$uri = $this->uri->segment('3');
							$data['user_data'] 	 = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar_permission');
							$this->load->view('admin/editprofile',$data);
							$this->load->view('admin/footer');

						}// ends if conditional

						else if($password != $userDataa->password )
						{
							$msg = "Old password not matched.";
							$this->session->set_flashdata('flashError_profileupdate',$msg);
							$uri = $this->uri->segment('3');
							$data['user_data'] 	 = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar_permission');
							$this->load->view('admin/editprofile',$data);
							$this->load->view('admin/footer');

						}// ends else if conditional

						else if($count_dots > 1)
						{
							$msg = "Please upload correct file.";
							$this->session->set_flashdata('flashError_profileupdate',$msg);
							$uri = $this->uri->segment('3');
							$data['user_data'] 	 = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar_permission');
							$this->load->view('admin/editprofile',$data);
							$this->load->view('admin/footer');

						}// ends if conditional

						else if(false === $ext = array_search(
				        
				        $finfo->file($_FILES['user_pic']['tmp_name']),
				        array(
				            'jpg' => 'image/jpeg',
				            'png' => 'image/png',
				            'gif' => 'image/gif',
				        ),
				        true

				     ))
						{
							$msg = "Please upload correct file.";
							$this->session->set_flashdata('flashError_profileupdate',$msg);
							$uri = $this->uri->segment('3');
							$data['user_data'] 	 = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar_permission');
							$this->load->view('admin/editprofile',$data);
							$this->load->view('admin/footer');

						}// ends else if conditional

						else
						{
								/***********File upload code*******/
								$user_id = $this->session->userdata('user_id');
								$user_name = $this->session->userdata('user_name');
								$pic_name = $user_name.'_'.$user_id.'_'.time().'_photo_';
								
								if($_FILES['user_pic']['name'])
				                {
				                  $configg = array(
				                             'upload_path' => "./uploads/users/",
				                             'allowed_types' => "jpg|png|jpeg|",
				                             'overwrite' => TRUE,
				                             'max_size' => "4096000", 
				                             'file_name' => $pic_name.$_FILES["user_pic"]['name'],
				                             );              
				                   $this->load->library('upload', $configg);
				                   $this->upload->initialize($configg);
				                   $img_namee= $_FILES['user_pic']['name'];//echo "djdjjd";echo $img_namee;
				                   $pic['item_image']= $img_namee;
				                   $this->load->library('upload',$configg);
				               	   $this->upload->initialize($configg);
				                   if($this->upload->do_upload('user_pic'))
				                  {  
				                     $file_data = $this->upload->data();  
				                     $img_namee = $file_data['orig_name'];
				                     $file_path ='uploads/admin_photos/'.$img_namee;
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
						  $user 	 = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));

							if(empty($img_namee))
							{
									$img_name = $user->image;
							}

							else
							{
									$img_name = $img_namee;
							}

							 $user_name  = xss_clean($this->input->post('user_name'));
							 $email  = xss_clean($this->input->post('email'));
							 $contact_no  = xss_clean($this->input->post('contact_no'));
							 $uri = $this->uri->segment('3');
							 $password  = xss_clean($this->input->post('password2'));


							 if(empty($password))
							 {
							 		$update_data = array(
													'user_name' 		=> $user_name,
													'email' 				=> $email,
													'contact_no' 		=> $contact_no,
													'image'					=> $img_name,
													'updated_date' 	=> $created_date
												);
							 }

							 else
							 {
							 		$update_data = array(
													'user_name' 		=> $user_name,
													'email' 				=> $email,
													'contact_no' 		=> $contact_no,
													'image'					=> $img_name,
													'password'			=> $password,
													'updated_date' 	=> $created_date
												);
							 }
							
						$updateuser_id = $this->Base_model->update_record_by_id('users', $update_data, array('user_id'=> $uri));


							if($updateuser_id)
							{
									$msg = "Profile updated successfully.";
									$this->session->set_flashdata('flashSuccess_profileupdate',$msg);
									$uri = $this->uri->segment('3');
									$data['user_data'] 	 = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_permission');
									$this->load->view('admin/editprofile',$data);
									$this->load->view('admin/footer');
							}

							else
							{
									$msg = "Fail to update profile.";
									$this->session->set_flashdata('flashError_profileupdate',$msg);
									$uri = $this->uri->segment('3');
									$data['user_data'] 	 = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
									$this->load->view('admin/header');
									$this->load->view('admin/sidebar_permission');
									$this->load->view('admin/editprofile',$data);
									$this->load->view('admin/footer');
							}//ends else

						}// ends else contional
							

					}//ends else mainss
			}//ends if

			else
			{
				$uri = $this->uri->segment('3');
				$data['user_data'] 	 = $this->Base_model->get_record_by_id('users', array('user_id' => $uri));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar_permission');
				$this->load->view('admin/editprofile',$data);
				$this->load->view('admin/footer');
			}//ends else

			}// ends else main
			
	}//ends function
	
}
