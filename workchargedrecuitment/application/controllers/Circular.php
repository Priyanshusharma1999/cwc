<?php

error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');



class Circular extends CI_Controller {



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
					$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

					$data['all_circle']    = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/jobs/circularlist',$data);

					$this->load->view('mainadmin/footer');
			}//ends else check session

	}//ends function


	/***********function for add circular*******/

	public function add_circular()

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

			$refrence_no  		= xss_clean(strip_tags($this->input->post('refrence_no')));

			$circular_title  	= xss_clean(strip_tags($this->input->post('circular_title')));

			$circle_name  		= xss_clean(strip_tags($this->input->post('circle_name')));

			$job_name= xss_clean(strip_tags($this->input->post('circular_job_name')));

			$this->form_validation->set_rules('refrence_no','refrence no','trim|required');

			$this->form_validation->set_rules('circular_title','circular title','trim|required');

			$this->form_validation->set_rules('circle_name','circle name','trim|required');

			$this->form_validation->set_rules('circular_job_name','job name','trim|required');


			//echo mime_content_type($_FILES['circular_pdf']['tmp_name']); exit;


			if($this->form_validation->run() === false) 

				{

					$data['insertData'] = array(

						'refrence_no' 		=> xss_clean($this->input->post('refrence_no')),

						'circular_title'	=> xss_clean($this->input->post('circular_title')),

						'circle_name' 		=> xss_clean($this->input->post('circle_name')),

						'circular_job_name' 		=> xss_clean($this->input->post('circular_job_name')),

					);

					$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

					$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/jobs/addcirculars',$data);

					$this->load->view('mainadmin/footer');

				}//ends if
				else
				{
					date_default_timezone_set('Asia/Calcutta'); 

					$finfo = new finfo(FILEINFO_MIME_TYPE);

					$created_date =  date("Y-m-d H:i:s");

					$uploaded_file_name  = $_FILES['circular_pdf']['name'];
						
					$count_dots = substr_count($uploaded_file_name, '.');



					if($count_dots > 1)
					{
							$msg = "Please select correct file.";

							$this->session->set_flashdata('flashError_circular', $msg);

							$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

							$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/jobs/addcirculars',$data);

							$this->load->view('mainadmin/footer');


					} else if (false === $ext = array_search(
				        
				        $finfo->file($_FILES['circular_pdf']['tmp_name']),
				        array(
				            'pdf' => 'application/pdf',
				        ),
				        true

				    )) {


				           $msg = "This type of file is not allowed. Please select file in pdf formate.";

							$this->session->set_flashdata('flashError_circular', $msg);

							$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

							$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/jobs/addcirculars',$data);

							$this->load->view('mainadmin/footer');


					}

				else
				{
						/***********Pdf upload*********	**/

				if($_FILES['circular_pdf']['name'])

                   {

                  $configg = array(

                             'upload_path' => "./uploads/circular/",

                             'allowed_types' => "pdf",

                             'overwrite' => TRUE,

                             'max_size' => "2048", 

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


				$checked_job = $this->Base_model->check_existent('tbl_circular', array('refrence_no' => $refrence_no,'circular_title' => $circular_title,'circle_id' => $circle_name,'job_id'=>$job_name));

				

					if($checked_job=='1')

					{

						$msg = "Circular already exits, Please enter new one";

						$this->session->set_flashdata('flashError_circular', $msg);

							/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('ausername'),
												'ROLE'			=> $this->session->userdata('auser_type'),
												'USEREMAIL' 	=> $this->session->userdata('aemail'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to add circular '.$circular_title,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

						$data['all_circular'] = '';

						$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

						$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

						$this->load->view('mainadmin/header');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/jobs/addcirculars',$data);

						$this->load->view('mainadmin/footer');

					}

					else
					{
						$pdf_name 	  	= str_replace(' ','_', $pdf_namee);

							$insert_data = array(

													'refrence_no' 		=> $refrence_no,

													'circular_title' 	=> $circular_title,

													'circle_id' 		=> $circle_name,

													'job_id'			=> $job_name,

													'file'				=> $pdf_name,

													'created_date' 		=> $created_date,

													'updated_date' 		=> $created_date

												);

						$insertid = $this->Base_model->insert_one_row('tbl_circular', $insert_data);

						if($insertid)
						{
							$msg = "Circular added successfully.";

							$this->session->set_flashdata('flashSuccess_circular',$msg);

							/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('ausername'),
												'ROLE'			=> $this->session->userdata('auser_type'),
												'USEREMAIL' 	=> $this->session->userdata('aemail'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('ausername').' circular added successfully : '.$circular_title,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

							$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

							$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/jobs/addcirculars',$data);

							$this->load->view('mainadmin/footer');

						}

						else

						{

							$msg = "Fail to add circular.";

							$this->session->set_flashdata('flashError_circular', $msg);

							/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('ausername'),
												'ROLE'			=> $this->session->userdata('auser_type'),
												'USEREMAIL' 	=> $this->session->userdata('aemail'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to add circular '.$circular_title,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

							$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

							$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/jobs/addcirculars',$data);

							$this->load->view('mainadmin/footer');

						}

					}//ends else		

					}// ends else count dots check


					

				}//ends main else

		}//ends if

		else

		{

			$data['all_circular'] = '';

			$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

			$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

			$this->load->view('mainadmin/header');

			$this->load->view('mainadmin/sidebar');

			$this->load->view('mainadmin/jobs/addcirculars',$data);

			$this->load->view('mainadmin/footer');



		}//ends else	

	}//ends else session check


	}// ends function



	/********function for Edit Circular******/



	public function edit_circular()

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

			$refrence_no  		= xss_clean(strip_tags($this->input->post('refrence_no')));

			$circular_title  	= xss_clean(strip_tags($this->input->post('circular_title')));

			$circle_name  		= xss_clean(strip_tags($this->input->post('circle_name')));

			$job_name= xss_clean(strip_tags($this->input->post('circular_job_name')));

	

			$this->form_validation->set_rules('refrence_no','refrence no','trim|required');

			$this->form_validation->set_rules('circular_title','circular title','trim|required');

			$this->form_validation->set_rules('circle_name','circle name','trim|required');

			if($this->form_validation->run() === false) 

				{
					$uri = $this->uri->segment('3');

					$data['all_circle']  	 = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

					$data['circular_data'] = $this->Base_model->get_record_by_id('tbl_circular', array('id' => $uri));

					$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/jobs/edit_circular',$data);

					$this->load->view('mainadmin/footer');


				}

				else
				{
					date_default_timezone_set('Asia/Calcutta'); 

					$created_date =  date("Y-m-d H:i:s"); 

					$finfo = new finfo(FILEINFO_MIME_TYPE);

					$created_date =  date("Y-m-d H:i:s");

					$uploaded_file_name  = $_FILES['circular_pdff']['name'];
						
					$count_dots = substr_count($uploaded_file_name, '.');

					if($count_dots > 1)
					{
					
					$msg = "Please select correct file.";

					$this->session->set_flashdata('flashError_circular', $msg);

					$uri = $this->uri->segment('3');

			$data['all_circle']  	 = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

				$data['circular_data'] = $this->Base_model->get_record_by_id('tbl_circular', array('id' => $uri));

				$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/jobs/edit_circular',$data);

					$this->load->view('mainadmin/footer');


					} else if (false === $ext = array_search(
				        
				        $finfo->file($_FILES['circular_pdff']['tmp_name']),
				        array(
				            'pdf' => 'application/pdf',
				        ),
				        true

				    )) {


				           $msg = "This type of file is not allowed. Please select file in pdf formate.";

                         $uri = $this->uri->segment('3');

			$data['all_circle']  	 = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

			$data['circular_data'] = $this->Base_model->get_record_by_id('tbl_circular', array('id' => $uri));

			$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/jobs/edit_circular',$data);

					$this->load->view('mainadmin/footer');


					} else {

                         

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

					/*****check circular********/

						if(empty($pdf_namee))

						{
							$get_circular_data = $this->Base_model->get_record_by_id('tbl_circular', array('id' => $uri));

							$pdf_name 	  	= $get_circular_data->file;

						}

						else
						{
							$pdf_name 	  	= str_replace(' ','_', $pdf_namee);

						}

			$checked_job = $this->Base_model->check_existent('tbl_circular', array('refrence_no' => $refrence_no,'circular_title' => $circular_title,'circle_id' => $circle_name , 'file' =>$pdf_name,'job_id' =>$job_name));

					/*****ends check circular*****/

					if($checked=='1')

					{
						$msg = "Circular updated successfully.";

						$this->session->set_flashdata('flashSuccess_circular',$msg);

						/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('ausername'),
												'ROLE'			=> $this->session->userdata('auser_type'),
												'USEREMAIL' 	=> $this->session->userdata('aemail'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('ausername').' circular updated successfully : '.$circular_title,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

						$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

						$this->load->view('mainadmin/header');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/jobs/circularlist',$data);

						$this->load->view('mainadmin/footer');

					}
					else
					{
							$checked_refrence_no = $this->Base_model->check_existent('tbl_circular', array('refrence_no' => $refrence_no,'circle_id' => $circle_name,'job_id' =>$job_name));

							$checked_circular_title = $this->Base_model->check_existent('tbl_circular', array('circular_title' => $circular_title,'circle_id' => $circle_name,'job_id' =>$job_name));

							$get_circular_data = $this->Base_model->get_record_by_id('tbl_circular', array('id' => $uri));

							if($checked_refrence_no=='1')

							{
									if($checked_circular_title=='1')

									{

										if($refrence_no ==$get_circular_data->refrence_no)

											{//start refrence if

													if($circular_title ==$get_circular_data->circular_title)

														{

																$update_data = array('refrence_no' 		=> $refrence_no,

																'circular_title' 	=> $circular_title,

																'circle_id' 		=> $circle_name,

																'job_id' =>$job_name,

																'file'				=> $pdf_name,

																'updated_date' 		=> $created_date);

														

																$updateid = $this->Base_model->update_record_by_id('tbl_circular', $update_data, array('id'=> $uri));

																$msg = "Circular updated successfully.";

																	$this->session->set_flashdata('flashSuccess_circular',$msg);

																	/*********logs code*******/

							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							$user_logs_data = array(
											'USERNAME' 	    => $this->session->userdata('ausername'),
											'ROLE'			=> $this->session->userdata('auser_type'),
											'USEREMAIL' 	=> $this->session->userdata('aemail'),
											'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
											'LOGINSTATUS' 	=> 'Logged in',
											'ACTIVITY' 		=> $this->session->userdata('ausername').' circular updated successfully'.$circular_title,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);

																		$this->Base_model->insert_one_row('userlogs', $user_logs_data);

														 		/*********ends logs code*******/


																	$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

																	$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

																	$this->load->view('mainadmin/header');

																	//$this->load->view('mainadmin/topmenu');

																	$this->load->view('mainadmin/sidebar');

																	$this->load->view('mainadmin/jobs/circularlist',$data);

																	$this->load->view('mainadmin/footer');

														}



														else

														{

																$msg = "Circular title already exits.";

																$this->session->set_flashdata('flashError_circular',$msg);

																/*********logs code*******/

					date_default_timezone_set('Asia/Calcutta'); 
					$created_date =  date("Y-m-d H:i:s");
					$user_logs_data = array(
									'USERNAME' 	    => $this->session->userdata('ausername'),
									'ROLE'			=> $this->session->userdata('auser_type'),
									'USEREMAIL' 	=> $this->session->userdata('aemail'),
									'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
									'LOGINSTATUS' 	=> 'Logged in',
									'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to update circular, circular title already exits :'.$circular_title,
									'ACTIVITYTIME'  => time(),
									'CREATEDDATED'  => $created_date
									
								);

																		$this->Base_model->insert_one_row('userlogs', $user_logs_data);

														 		/*********ends logs code*******/

																$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

																$this->load->view('mainadmin/header');

																//$this->load->view('mainadmin/topmenu');

																$this->load->view('mainadmin/sidebar');

																$this->load->view('mainadmin/jobs/circularlist',$data);

																$this->load->view('mainadmin/footer');

														}

											}//ends refrence if
											else
											{

													$msg = "Refrence no already exits.";

													$this->session->set_flashdata('flashError_circular',$msg);

													/*********logs code*******/

							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							$user_logs_data = array(
											'USERNAME' 	    => $this->session->userdata('ausername'),
											'ROLE'			=> $this->session->userdata('auser_type'),
											'USEREMAIL' 	=> $this->session->userdata('aemail'),
											'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
											'LOGINSTATUS' 	=> 'Logged in',
											'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to update circular, refrence no. already exits :'.$circular_title,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);

																		$this->Base_model->insert_one_row('userlogs', $user_logs_data);

													/*********ends logs code*******/

													$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

													$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

													$this->load->view('mainadmin/header');

													$this->load->view('mainadmin/sidebar');

													$this->load->view('mainadmin/jobs/circularlist',$data);

													$this->load->view('mainadmin/footer');

											}//ends else ashjdsjdjsd

											

									}//ends circurlar title if

									else

									{

											if($refrence_no ==$get_circular_data->refrence_no)

											{

												$update_data = array('refrence_no' 		=> $refrence_no,

															'circular_title' 	=> $circular_title,

															'circle_id' 		=> $circle_name,

															'job_id' =>$job_name,

															'file'				=> $pdf_name,

															'updated_date' 		=> $created_date);

													

												$updateid = $this->Base_model->update_record_by_id('tbl_circular', $update_data, array('id'=> $uri));

												$msg = "Circular updated successfully.";

													$this->session->set_flashdata('flashSuccess_circular',$msg);

													/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('ausername'),
										'ROLE'			=> $this->session->userdata('auser_type'),
										'USEREMAIL' 	=> $this->session->userdata('aemail'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('ausername').' circular updated successfully : '.$circular_title,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);

																		$this->Base_model->insert_one_row('userlogs', $user_logs_data);

													/*********ends logs code*******/

													$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

													$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

													$this->load->view('mainadmin/header');

													$this->load->view('mainadmin/sidebar');

													$this->load->view('mainadmin/jobs/circularlist',$data);

													$this->load->view('mainadmin/footer');

											}

											else

											{

													$msg = "Refrence no already exits.";

													$this->session->set_flashdata('flashError_circular',$msg);

													/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('ausername'),
												'ROLE'			=> $this->session->userdata('auser_type'),
												'USEREMAIL' 	=> $this->session->userdata('aemail'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to update circular, refrence no. already exits :'.$circular_title,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

																		$this->Base_model->insert_one_row('userlogs', $user_logs_data);

													/*********ends logs code*******/

													$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

													$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

													$this->load->view('mainadmin/header');

													//$this->load->view('mainadmin/topmenu');

													$this->load->view('mainadmin/sidebar');

													$this->load->view('mainadmin/jobs/circularlist',$data);

													$this->load->view('mainadmin/footer');

											}//ends refrence else

									}//ends circurlar title else

									

							}//ends if



							else if($checked_refrence_no=='1')

							{

									if($refrence_no ==$get_circular_data->refrence_no)

											{

												$update_data = array('refrence_no' 		=> $refrence_no,

															'circular_title' 	=> $circular_title,

															'circle_id' 		=> $circle_name,

															'job_id' =>$job_name,

															'file'				=> $pdf_name,

															'updated_date' 		=> $created_date);

													

												$updateid = $this->Base_model->update_record_by_id('tbl_circular', $update_data, array('id'=> $uri));

												$msg = "Circular updated successfully.";

													$this->session->set_flashdata('flashSuccess_circular',$msg);

													/*********logs code*******/

							date_default_timezone_set('Asia/Calcutta'); 
							$created_date =  date("Y-m-d H:i:s");
							$user_logs_data = array(
											'USERNAME' 	    => $this->session->userdata('ausername'),
											'ROLE'			=> $this->session->userdata('auser_type'),
											'USEREMAIL' 	=> $this->session->userdata('aemail'),
											'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
											'LOGINSTATUS' 	=> 'Logged in',
											'ACTIVITY' 		=> $this->session->userdata('ausername').' circular updated successfully :'.$circular_title,
											'ACTIVITYTIME'  => time(),
											'CREATEDDATED'  => $created_date
											
										);

																		$this->Base_model->insert_one_row('userlogs', $user_logs_data);

													/*********ends logs code*******/

													$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

													$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

													$this->load->view('mainadmin/header');

													//$this->load->view('mainadmin/topmenu');

													$this->load->view('mainadmin/sidebar');

													$this->load->view('mainadmin/jobs/circularlist',$data);

													$this->load->view('mainadmin/footer');

											}



											else

											{

													$msg = "Refrence no already exits.";

													$this->session->set_flashdata('flashError_circular',$msg);

													/*********logs code*******/

						date_default_timezone_set('Asia/Calcutta'); 
						$created_date =  date("Y-m-d H:i:s");
						$user_logs_data = array(
										'USERNAME' 	    => $this->session->userdata('ausername'),
										'ROLE'			=> $this->session->userdata('auser_type'),
										'USEREMAIL' 	=> $this->session->userdata('aemail'),
										'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
										'LOGINSTATUS' 	=> 'Logged in',
										'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to update circular, refrence no. already exits :'.$circular_title,
										'ACTIVITYTIME'  => time(),
										'CREATEDDATED'  => $created_date
										
									);

												$this->Base_model->insert_one_row('userlogs', $user_logs_data);

													/*********ends logs code*******/

													$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

													$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

													$this->load->view('mainadmin/header');

													//$this->load->view('mainadmin/topmenu');

													$this->load->view('mainadmin/sidebar');

													$this->load->view('mainadmin/jobs/circularlist',$data);

													$this->load->view('mainadmin/footer');

											}//ends refrence else

							}// ends else if



							else

							{

								$update_data = array('refrence_no' 		=> $refrence_no,

													'circular_title' 	=> $circular_title,

													'circle_id' 		=> $circle_name,

													'job_id' =>$job_name,

													'file'				=> $pdf_name,

													'updated_date' 		=> $created_date);

											

										$updateid = $this->Base_model->update_record_by_id('tbl_circular', $update_data, array('id'=> $uri));



										if($updateid)

										{

											$msg = "Circular updated successfully.";

											$this->session->set_flashdata('flashSuccess_circular',$msg);

											$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

											$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

											$this->load->view('mainadmin/header');

											//$this->load->view('mainadmin/topmenu');

											$this->load->view('mainadmin/sidebar');

											$this->load->view('mainadmin/jobs/circularlist',$data);

											$this->load->view('mainadmin/footer');

										}
										else

										{

											$msg = "Fail to update circular.";

											$this->session->set_flashdata('flashError_circular', $msg);

											/*********logs code*******/

								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('ausername'),
												'ROLE'			=> $this->session->userdata('auser_type'),
												'USEREMAIL' 	=> $this->session->userdata('aemail'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('ausername').' failed to update circular'.$circular_title,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

													/*********ends logs code*******/
										

											$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

											$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

											$this->load->view('mainadmin/header');

											$this->load->view('mainadmin/sidebar');

											$this->load->view('mainadmin/jobs/circularlist',$data);

											$this->load->view('mainadmin/footer');

										}

									}//ends else last

					   }//ends main else


					}


				}//ends else

		}//ends if

		else

		{
				$uri = $this->uri->segment('3');

				$data['all_circle']  	 = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

				$data['circular_data'] = $this->Base_model->get_record_by_id('tbl_circular', array('id' => $uri));

				$data['all_jobs'] 		= $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

				$this->load->view('mainadmin/header');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/jobs/edit_circular',$data);

				$this->load->view('mainadmin/footer');

		}//ends else
		
			}// ends check session else

		

	}//ends function



	/********function for View Circular******/



	public function view_circular()

	{

				$uri = $this->uri->segment('3');

				$data['all_circle']  	 = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

				$data['circular_data'] = $this->Base_model->get_record_by_id('tbl_circular', array('id' => $uri));

				$this->load->view('mainadmin/header');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/jobs/view_circular',$data);

				$this->load->view('mainadmin/footer');



	}//ends function



	/********function for Delete Circular******/



	public function delete_circular()

	{

				date_default_timezone_set('Asia/Calcutta'); 

				$created_date =  date("Y-m-d H:i:s"); 

				$delete_itemId = xss_clean($this->input->post('delete_itemId'));

				$data['circular_data'] = $circular_data =  $this->Base_model->get_record_by_id('tbl_circular', array('id' => $delete_itemId));

				$update_data = array(

													'circular_title' 	=> $circular_data->circular_title,

													'status'				=> '0',

													'delete_status' => '0',

													'updated_date' 	=> $created_date

												);

				$updateid = $this->Base_model->update_record_by_id('tbl_circular', $update_data, array('id'=> $delete_itemId));

				$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

				$this->load->view('mainadmin/header');

				//$this->load->view('mainadmin/topmenu');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/jobs/circularlist',$data);

				$this->load->view('mainadmin/footer');

				$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

			

	}



		/*********function for search circular************/



		public function search_circular()

	{

			$circular_title = xss_clean($this->input->post('circular_title'));

			$circle_name = xss_clean($this->input->post('circle_nnname'));

			



			if(empty($circular_title) && empty($circle_name))

				{ 

					$data['all_circulars'] = $this->Base_model->get_all_record_by_condition('tbl_circular', array('status'=>'1'));

					$data['all_circle']    = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/jobs/circularlist',$data);

					$this->load->view('mainadmin/footer');



				}//ends if



				else

				{ 

					$data['all_circulars'] = $this->Base_model->search_circular($circular_title,$circle_name);

					$data['all_circle']    = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/jobs/circularlist',$data);

					$this->load->view('mainadmin/footer');



				}//ends else

	}//function ends





}//class ends

