<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Sitedata extends CI_Controller {

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

			 if($this->session->userdata('user_role') == 2)
			 {
				$base_url = base_url();
				 redirect($base_url.'Frontend/logout');
			 } 

			 if($this->session->userdata('user_role') == 4)
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
			$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('status'=>1,'delete_status'=>0));

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/sitedata/datalist',$data);
			$this->load->view('admin/footer');
		}//ends else
			
	
	}//ends function
	
	

	public function addtitle()
	{
	
	   if(isset($_REQUEST['submit'])) 
		{
			$title  = xss_clean($this->input->post('title'));
			////$url  = xss_clean($this->input->post('url'));
		
			$url  = '';

			$this->form_validation->set_rules('title','title','trim|required');
			//$this->form_validation->set_rules('url','url','trim|required');

			if($this->form_validation->run() === false) 
				{
					
				    $data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('status'=>1,'delete_status'=>0));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/sitedata/adddata',$data);
					$this->load->view('admin/footer');

				}//ends if

				else
				{
					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s"); 

					  $uploaded_file_name  = $_FILES['circular_pdf']['name'];
						
					  $count_dots = substr_count($uploaded_file_name, '.');

					  $finfo = new finfo(FILEINFO_MIME_TYPE);

						if($count_dots > 1)
						{
							$msg = "Please upload correct file.";
							$this->session->set_flashdata('flashError_site', $msg);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('status'=>1,'delete_status'=>0));
							$this->load->view('admin/header');
					         $this->load->view('admin/sidebar');
					         $this->load->view('admin/sitedata/adddata',$data);
					         $this->load->view('admin/footer');

						} else if(false === $ext = array_search(
				        
				        $finfo->file($_FILES['circular_pdf']['tmp_name']),
				        array(
				            'pdf' => 'application/pdf',
				        ),
				        true

				        )){
							$msg = "Please upload file in pdf formate.";
							$this->session->set_flashdata('flashError_site', $msg);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('status'=>1,'delete_status'=>0));
							$this->load->view('admin/header');
					         $this->load->view('admin/sidebar');
					         $this->load->view('admin/sitedata/adddata',$data);
					         $this->load->view('admin/footer');


						} else

						{
							/***********Pdf upload*********	**/
						if($_FILES['circular_pdf']['name'])
		                {
		                  $configg = array(
		                             'upload_path' => "./uploads/circular/",
		                             'allowed_types' => "pdf",
		                             'overwrite' => TRUE,
		                             'max_size' => "4096000", 
		                             );              
		                   $this->load->library('upload', $configg);
		                   $this->upload->initialize($configg);
		                   $pdf_namee=$_FILES['circular_pdf']['name'];
		                   $pic['item_image']= $pdf_namee;
		                   $this->load->library('upload',$configg);
		               	   $this->upload->initialize($configg);
		                   if($this->upload->do_upload('circular_pdf'))
		                  {  
		                     $file_data = $this->upload->data();  
		                     $pdf_namee = $file_data['orig_name'];
		                     $file_path ='uploads/circular'.$pdf_namee;
		                  }

		                  else
		                  {
		                    $error=$this->upload->display_errors();   
		                  }
		                }

		                $pdf_name 	  	= str_replace(' ','_', $pdf_namee);
					/*******Ends pdf upload code*******/

					$checked = $this->Base_model->check_existent('sitedata', array('title'=> $title));

					if($checked=='1')
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
											'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add circular '.$title,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);
							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							 /*********ends logs code*******/

						$msg = "Data already exits, Please enter new one";
						$this->session->set_flashdata('flashError_site', $msg);
						$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('status'=>1,'delete_status'=>0));
						$this->load->view('admin/header');
					    $this->load->view('admin/sidebar');
						$this->load->view('admin/sitedata/adddata',$data);
						$this->load->view('admin/footer');
					}

					else
					{
							$insert_data = array(
													'title' 	    => $title,
													'url' 	        => $url,
													'file'			=> $pdf_name,
													'status' 	    => 1,
													'delete_status' => 0,
													'created_date' 	=> $created_date,
													'updated_date' 	=> $created_date
												);
						$insertid = $this->Base_model->insert_one_row('sitedata', $insert_data);

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
											'ACTIVITY' 		=> $this->session->userdata('user_name').' added circular '.$title,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);
							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							 /*********ends logs code*******/

							$msg = "Circular data added successfully.";
							$this->session->set_flashdata('flashSuccess_site',$msg);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('status'=>1,'delete_status'=>0));
							$user_id = $this->session->userdata('applicant_user_id');
							redirect('sitedata/index/'.$user_id,$data);
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
											'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to add circular '.$title,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);
							$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							 /*********ends logs code*******/

							$msg = "Fail to add Circular data";
							$this->session->set_flashdata('flashError_site', $msg);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('status'=>1,'delete_status'=>0));
							$this->load->view('admin/header');
					         $this->load->view('admin/sidebar');
					         $this->load->view('admin/sitedata/adddata',$data);
					         $this->load->view('admin/footer');
						}
					}//ends else
						}// ends else circular pdf
						
								
				}//ends main else

		}//ends if

		else
		{
			
			$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('status'=>1,'delete_status'=>0));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/sitedata/adddata',$data);
			$this->load->view('admin/footer');

		}//ends else	
	
	}// ends function
	
	
	public function edittitle()
	{
		$segment_id = $this->uri->segment('4');
		$uri_check = $this->session->userdata('applicant_user_id');

		if($segment_id!=$uri_check)
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
				
				$title  = xss_clean($this->input->post('title'));
			    //$url  = xss_clean($this->input->post('url'));
				$url  = '';

				$this->form_validation->set_rules('title','title','trim|required');
				//$this->form_validation->set_rules('url','url','trim|required');

				if($this->form_validation->run() === false) 
					{
					
						$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('id' => $uri));
						$this->load->view('admin/header');
					    $this->load->view('admin/sidebar');
					    $this->load->view('admin/sitedata/editdata',$data);
					    $this->load->view('admin/footer');
					
					}//ends if

					else
					{
						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");

						$uploaded_file_name  = $_FILES['circular_pdff']['name'];
						
					    $count_dots = substr_count($uploaded_file_name, '.');

					     $finfo = new finfo(FILEINFO_MIME_TYPE);

						if($count_dots > 1)
						{

							$msg = "Please upload correct file.";
							$this->session->set_flashdata('flashError_site', $msg);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('id' => $uri));
					    $this->load->view('admin/header');
				      $this->load->view('admin/sidebar');
				      $this->load->view('admin/sitedata/editdata',$data);
				      $this->load->view('admin/footer');

						} else if(false === $ext = array_search(
				        
				        $finfo->file($_FILES['circular_pdff']['tmp_name']),
				        array(
				            'pdf' => 'application/pdf',
				        ),
				        true

				        )){

							$msg = "Please upload file in pdf formate.";
							$this->session->set_flashdata('flashError_site', $msg);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('id' => $uri));
						    $this->load->view('admin/header');
					      $this->load->view('admin/sidebar');
					      $this->load->view('admin/sitedata/editdata',$data);
					      $this->load->view('admin/footer');

						}

						else
						{
							/***********Pdf upload*********	**/
						if($_FILES['circular_pdff']['name'])
		                {
		                  $configg = array(
		                             'upload_path' => "./uploads/circular/",
		                             'allowed_types' => "pdf",
		                             'overwrite' => TRUE,
		                             'max_size' => "1024", 
		                             );              
		                   $this->load->library('upload', $configg);
		                   $this->upload->initialize($configg);
		                   $pdf_namee=$_FILES['circular_pdff']['name'];
		                   $pic['item_image']= $pdf_namee;
		                   $this->load->library('upload',$configg);
		               	   $this->upload->initialize($configg);
		                   if($this->upload->do_upload('circular_pdff'))
		                  {  
		                     $file_data = $this->upload->data();  
		                     $pdf_namee = $file_data['orig_name'];
		                     $file_path ='uploads/circular'.$pdf_namee;
		                  }

		                  else
		                  {
		                    $error=$this->upload->display_errors();   
		                  }
		                }
					/*******Ends pdf upload code*******/ 

						if(empty($pdf_namee))
						{
							$get_circular_data = $this->Base_model->get_record_by_id('sitedata', array('id' => $uri));
							$pdf_name 	  	= $get_circular_data->file;
						}

						else
						{
							$pdf_name 	  	= str_replace(' ','_', $pdf_namee);
						}	
						$update_data = array(
											'title' 	    => $title,
											'url' 	        => $url,
											'status' 	    => 1,
											'file' 			=>$pdf_name,
											'delete_status' => 0,
											'created_date' 	=> $created_date,
											'updated_date' 	=> $created_date
										);

							$updateid = $this->Base_model->update_record_by_id('sitedata', $update_data, array('id'=> $uri));

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
												'ACTIVITY' 		=> $this->session->userdata('user_name').' update circular '.$title,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							 /*********ends logs code*******/
								$msg = "Circular data updated successfully.";
							$this->session->set_flashdata('flashSuccess_site',$msg);
							$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('status'=>1,'delete_status'=>0));
						    $user_id = $this->session->userdata('applicant_user_id');
							redirect('sitedata/index/'.$user_id,$data);
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
												'ACTIVITY' 		=> $this->session->userdata('user_name').' failed to update circular '.$title,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							 /*********ends logs code*******/

								$msg = "Fail to update Circular data";
								$this->session->set_flashdata('flashError_site', $msg);
								$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('id' => $uri));
						       $this->load->view('admin/header');
					            $this->load->view('admin/sidebar');
					           $this->load->view('admin/sitedata/editdata',$data);
					            $this->load->view('admin/footer');
							}//ends else
						}// ends else count dots

						
						
						
					}//ends main else
		}//ends if

		else
		{
				$uri = $this->uri->segment('3');
				$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('id' => $uri));
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar');
			    $this->load->view('admin/sitedata/editdata',$data);
				$this->load->view('admin/footer');
		}//ends else
		
		}// ends else session check

		
		
	}//ends function
	
	public function deletetitle(){
			
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
			/*$delete_itemId = xss_clean($this->input->post('delete_itemId'));*/
			$delete_itemId = xss_clean($this->input->post('id'));
			
			  $data['post_data'] = $post_data =  $this->Base_model->get_record_by_id('sitedata', array('id' => $delete_itemId));			
				
		    $update_data = array(
								'title' 		=> $post_data->title,
								'url' 		    => $post_data->url,
								'created_date' 	=> $created_date,
								'status'        => 1,
								'delete_status' => 1,
								'updated_date' 	=> $created_date
							);
			$updateid = $this->Base_model->update_record_by_id('sitedata', $update_data, array('id'=> $delete_itemId));
			
			/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> $this->session->userdata('user_role'),
												'USEREMAIL' 	=> $this->session->userdata('applicant_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' delete circular '.$post_data->title,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);
								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							 /*********ends logs code*******/

			$msg = "Circular data deleted successfully.";
			$this->session->set_flashdata('flashSuccess_site',$msg);
			$data['all_data'] = $this->Base_model->get_all_record_by_condition('sitedata',array('status'=>1,'delete_status'=>0));
			$user_id = $this->session->userdata('applicant_user_id');
			redirect('sitedata/index/'.$user_id,$data);
			
			}// ends eklse session check
		    
		
	}// ends function
	
	
}
