<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Circle extends CI_Controller {

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

         if($this->session->userdata('auser_type')!= 3)
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
		$user_id = $this->session->userdata('auser_id');
		$circle_user_data = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $user_id));
		$data['all_applicant'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info',array('circle_id'=>$circle_user_data->Circle));
		$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs',array('circle_id'=>$circle_user_data->Circle));
		
		$this->load->view('circle/header');
		$this->load->view('circle/sidebar');
		$this->load->view('circle/dashboard',$data);
		$this->load->view('circle/footer');	

	}//ends function


	/*******function to gettting all circles********/

	public function all_circle()
	{
		
		$region_id = $this->input->post('id');
		$all_circle =  $this->Base_model->get_all_record_by_condition('tbl_circle', array('region_id'=>$region_id));
		$all_circles =  json_encode($all_circle);
		echo  $all_circles;

	}// ends function

		//function for edit profile
		
	public function edit_profile()
	{
			$uri = $this->uri->segment('3');
			if(isset($_REQUEST['submit'])) 
			{
				//echo "<pre>"; print_r($_REQUEST);exit;
			  $user_name  = xss_clean($this->input->post('user_name'));
			  $email  = xss_clean($this->input->post('email'));
			  $contact_no  = xss_clean($this->input->post('contact_no'));
			  $password  = xss_clean($this->input->post('passworrrrrd'));

				$this->form_validation->set_rules('user_name','user name','trim|required');
				$this->form_validation->set_rules('email','email','trim|required');
				$this->form_validation->set_rules('contact_no','contact no','trim|required');
			
				if($this->form_validation->run() === false) 
					{
							$data['insertData'] = array(
							'user_name' => xss_clean($this->input->post('user_name')),
							'email' => xss_clean($this->input->post('email')),
							'contact_no' => xss_clean($this->input->post('contact_no')),
							'passworrrrrd' => xss_clean($this->input->post('passworrrrrd')),
							);

							$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));
							$this->load->view('circle/header');
							$this->load->view('circle/sidebar');
							$this->load->view('circle/editprofile',$data);
							$this->load->view('circle/footer');	

						
					}// ends if

				else
					{
							/***********File upload code*******/
								$user_id = $this->session->userdata('auser_id');
								$user_name = $this->session->userdata('ausername');
								$pic_name = $user_name.'_'.$user_id.'_'.time().'_photo_';
								
								if($_FILES['user_pic']['name'])
                {
                  $configg = array(
                             'upload_path' => "./uploads/admin_photos/",
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
						  $user 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));

							if(empty($img_namee))
							{
									$img_name = $user->user_pic;
							}

							else
							{
									$img_name = $img_namee;
							}

							 $user_name  = xss_clean($this->input->post('user_name'));
							 $email  = xss_clean($this->input->post('email'));
							 $contact_no  = xss_clean($this->input->post('contact_no'));
							 $uri = $this->uri->segment('3');
							 $password  = xss_clean($this->input->post('passworrrrrd'));


							 if(empty($password))
							 {
							 		$update_data = array(
													'name' 					=> $user_name,
													'email' 				=> $email,
													'phone' 				=> $contact_no,
													'user_pic'			=> $img_name,
													'updated_date' 	=> $created_date
												);
							 }

							 else
							 {
							 		$update_data = array(
													'name' 					=> $user_name,
													'email' 				=> $email,
													'phone' 				=> $contact_no,
													'user_pic'			=> $img_name,
													'password'			=> md5($password),
													'updated_date' 	=> $created_date
												);
							 }
							
						$updateid = $this->Base_model->update_record_by_id('tbl_admin', $update_data, array('id'=> $uri));


							if($updateid)
							{
									$msg = "Profile updated successfully.";
									$this->session->set_flashdata('flashSuccess_profileupdate',$msg);
									$uri = $this->uri->segment('3');
									$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));
									$this->load->view('circle/header');
									$this->load->view('circle/sidebar');
									$this->load->view('circle/editprofile',$data);
									$this->load->view('circle/footer');	
							}

							else
							{
									$msg = "Fail to update profile.";
									$this->session->set_flashdata('flashError_profileupdate',$msg);
									$uri = $this->uri->segment('3');
									$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));
									$this->load->view('circle/header');
									$this->load->view('circle/sidebar');
									$this->load->view('circle/editprofile',$data);
									$this->load->view('circle/footer');	
							}//ends else

					}//ends else
			}//ends if

			else
			{
				$uri = $this->uri->segment('3');
				$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));
				$this->load->view('circle/header');
				$this->load->view('circle/sidebar');
				$this->load->view('circle/editprofile',$data);
				$this->load->view('circle/footer');	
			}//ends else
			
	}

	/********function for view profile******/

	public function view_profile()
	{
			$uri = $this->uri->segment('3');
			$data['user_data'] 	 	 = $user_data = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));
			$data['region_data'] 	 = $this->Base_model->get_record_by_id('tbl_region', array('id' => $user_data->Division));
			$data['circle_data'] 	 = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $user_data->Circle));
			$this->load->view('circle/header');
			$this->load->view('circle/sidebar');
			$this->load->view('circle/viewprofile',$data);
			$this->load->view('circle/footer');	
			
	}

}//class ends
