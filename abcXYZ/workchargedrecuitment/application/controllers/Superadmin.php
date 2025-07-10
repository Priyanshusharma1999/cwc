<?php

error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');



class Superadmin extends CI_Controller {



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

          if($this->session->userdata('auser_type')!= 1)

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
		 			$data['all_applicant'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info',array('status'=>'1','delete_status'=>'1'));

					$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs',array('status'=>'1','delete_status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/dashboard',$data);

					$this->load->view('mainadmin/footer');

		 }// ends else

	}//ends function



	/***********function for add region*******/

	public function add_region()

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

			$region_name  = xss_clean(strip_tags($this->input->post('region_name')));

			$this->form_validation->set_rules('region_name','region name','trim|required');



			if($this->form_validation->run() === false) 

				{
					$data['insertData'] = array(

						'region_name' => xss_clean($this->input->post('region_name'))

					);

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					//$this->load->view('mainadmin/topmenu');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/masterdata/addregion', $data);

					$this->load->view('mainadmin/footer');



				}//ends if



				else

				{

					date_default_timezone_set('Asia/Calcutta'); 

					$created_date =  date("Y-m-d H:i:s"); 



					/*****check region name********/



						$checked = $this->Base_model->check_existent('tbl_region', array('region_name' 	=> $region_name));



					/*****ends check region name*****/



					if($checked=='1')

					{

						$msg = "Region name already exits, Please enter new one";

						$this->session->set_flashdata('flashError', $msg);

						/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to add region, region name already exits : '.xss_clean($this->input->post('region_name')),
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 /*********ends logs code*******/

						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

						$this->load->view('mainadmin/header');

						//$this->load->view('mainadmin/topmenu');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/masterdata/addregion',$data);

						$this->load->view('mainadmin/footer');

					}



					else

					{

							$insert_data = array(

													'region_name' 	=> $region_name,

													'created_date' 	=> $created_date,

													'updated_date' 	=> $created_date

												);

						$insertid = $this->Base_model->insert_one_row('tbl_region', $insert_data);



						if($insertid)

						{

							$msg = "Region added successfully.";

							$this->session->set_flashdata('flashSuccess',$msg);

							/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,added region successfully : '.xss_clean($this->input->post('region_name')),
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 /*********ends logs code*******/

							$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							//$this->load->view('mainadmin/topmenu');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/masterdata/addregion',$data);

							$this->load->view('mainadmin/footer');

						}



						else

						{

							$msg = "Fail to add region";

							$this->session->set_flashdata('flashError', $msg);

							/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to region : '.xss_clean($this->input->post('region_name')),
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 /*********ends logs code*******/

							$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							//$this->load->view('mainadmin/topmenu');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/masterdata/addregion',$data);

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

			$this->load->view('mainadmin/masterdata/addregion',$data);

			$this->load->view('mainadmin/footer');



		}//ends else	

		}//ends else sessoion check


		



	}// ends function



	/********function for Edit Region******/



	public function edit_region()

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

			$region_name  = xss_clean(strip_tags($this->input->post('region_name')));

			$this->form_validation->set_rules('region_name','region name','trim|required');



			if($this->form_validation->run() === false) 

				{

						

					$data['region_data'] = $this->Base_model->get_record_by_id('tbl_region', array('id' => $uri));

					$this->load->view('mainadmin/header');

					//$this->load->view('mainadmin/topmenu');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/masterdata/editregion/'.$uri,$data);

					$this->load->view('mainadmin/footer');



				}//ends if



				else

				{

					date_default_timezone_set('Asia/Calcutta'); 

					$created_date =  date("Y-m-d H:i:s"); 



					/*****check region name********/



						$checked = $this->Base_model->check_existent('tbl_region', array('region_name' 	=> $region_name));



					/*****ends check region name*****/



					if($checked=='1')

					{

						$msg = "Region name already exits, Please enter new one";

						$this->session->set_flashdata('flashError', $msg);

						/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to update region, region name already exits : '.$region_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

						$this->load->view('mainadmin/header');

						//$this->load->view('mainadmin/topmenu');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/masterdata/addregion',$data);

						$this->load->view('mainadmin/footer');

					}



					else

					{

								$update_data = array(

													'region_name' 	=> $region_name,

													'updated_date' 	=> $created_date

												);

						$updateid = $this->Base_model->update_record_by_id('tbl_region', $update_data, array('id'=> $uri));



						if($updateid)

						{

							$msg = "Region updated successfully.";

							$this->session->set_flashdata('flashSuccess',$msg);

							/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,region updated successfully : '.$region_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

							$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							//$this->load->view('mainadmin/topmenu');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/masterdata/addregion',$data);

							$this->load->view('mainadmin/footer');

						}



						else

						{

							$msg = "Fail to update region";

							$this->session->set_flashdata('flashError', $msg);

							/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to update region : '.$region_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

							$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							//$this->load->view('mainadmin/topmenu');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/masterdata/addregion',$data);

							$this->load->view('mainadmin/footer');

						}

					}

				}//ends else



		}//ends if



		else

		{

				$uri = $this->uri->segment('3');

				$data['region_data'] = $this->Base_model->get_record_by_id('tbl_region', array('id' => $uri));

				$this->load->view('mainadmin/header');

				//$this->load->view('mainadmin/topmenu');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/masterdata/editregion',$data);

				$this->load->view('mainadmin/footer');

		}//ends else

			}//ends else session check


		

	}//ends function



	/********function for View Region******/



	public function view_region()

	{

				$uri = $this->uri->segment('3');

				$data['region_data'] = $this->Base_model->get_record_by_id('tbl_region', array('id' => $uri));

				$this->load->view('mainadmin/header');

				//$this->load->view('mainadmin/topmenu');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/masterdata/viewregion',$data);

				$this->load->view('mainadmin/footer');

	}//ends function



	/********function for Delete Region******/



	public function delete_region()

	{

				date_default_timezone_set('Asia/Calcutta'); 

				$created_date =  date("Y-m-d H:i:s"); 

				$delete_itemId = xss_clean($this->input->post('delete_itemId'));

				$data['region_data'] = $region_data =  $this->Base_model->get_record_by_id('tbl_region', array('id' => $delete_itemId));

				$update_data = array(

													'region_name' 	=> $region_data->region_name,

													'status'				=> '0',

													'delete_status' => '0',

													'updated_date' 	=> $created_date

												);

				/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,deleted region : '.$region_data->region_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

				$updateid = $this->Base_model->update_record_by_id('tbl_region', $update_data, array('id'=> $delete_itemId));

				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

				$this->load->view('mainadmin/header');

				//$this->load->view('mainadmin/topmenu');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/masterdata/addregion',$data);

				$this->load->view('mainadmin/footer');

	}//ends function



	/***********function for add circle*******/



	public function add_circle()

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

			$region_name  = xss_clean(strip_tags($this->input->post('region_name')));

			$circle_name  = xss_clean(strip_tags($this->input->post('circle_name')));

			$this->form_validation->set_rules('region_name','region name','trim|required');

			$this->form_validation->set_rules('circle_name','circle name','trim|required');



			if($this->form_validation->run() === false) 

				{

						

					$data['insertData'] = array(

						'region_name' => xss_clean($this->input->post('region_name')),

						'circle_name' => xss_clean($this->input->post('circle_name'))

					);

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					//$this->load->view('mainadmin/topmenu');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/masterdata/addcircle',$data);

					$this->load->view('mainadmin/footer');



				}//ends if



				else

				{

					date_default_timezone_set('Asia/Calcutta'); 

					$created_date =  date("Y-m-d H:i:s"); 



					/*****check circle name********/



						$checked = $this->Base_model->check_existent('tbl_circle', array('region_id'=> $region_name,'circle_name'=> $circle_name));



						/*****ends check circle name*****/



						if($checked=='1')

						{

							$msg = "Circle name already exits, Please enter new one";

							$this->session->set_flashdata('flashError_circle', $msg);

								/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to add circle : '.$circle_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

							$data['all_circle'] = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));

							$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							//$this->load->view('mainadmin/topmenu');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/masterdata/addcircle',$data);

							$this->load->view('mainadmin/footer');

							

						}



						else

						{

								$insert_data = array(

													'region_id' 		=> $region_name,

													'circle_name' 	=> $circle_name,

													'created_date' 	=> $created_date,

													'updated_date' 	=> $created_date

												);

							$insertid = $this->Base_model->insert_one_row('tbl_circle', $insert_data);



							if($insertid)

							{

								$msg = "Circle added successfully.";

								$this->session->set_flashdata('flashSuccess_circle',$msg);

								/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,circle add successfully : '.$circle_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

								$data['all_circle'] = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));

								$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

								$this->load->view('mainadmin/header');

								//$this->load->view('mainadmin/topmenu');

								$this->load->view('mainadmin/sidebar');

								$this->load->view('mainadmin/masterdata/addcircle',$data);

								$this->load->view('mainadmin/footer');

							}



							else

							{

								$msg = "Fail to add circle";

								$this->session->set_flashdata('flashError_circle', $msg);

									/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to add circle : '.$circle_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

								$data['all_circle'] = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));

								$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

								$this->load->view('mainadmin/header');

								//$this->load->view('mainadmin/topmenu');

								$this->load->view('mainadmin/sidebar');

								$this->load->view('mainadmin/masterdata/addcircle',$data);

								$this->load->view('mainadmin/footer');

							}//ends else

						}//ends else

				}//ends main else

		}//ends main if



		else

		{

			$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));

			$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

			$this->load->view('mainadmin/header');

			//$this->load->view('mainadmin/topmenu');

			$this->load->view('mainadmin/sidebar');

			$this->load->view('mainadmin/masterdata/addcircle',$data);

			$this->load->view('mainadmin/footer');

		}
		}//ends else session check


		

		

	}//ends function



	/********function for Edit Circle******/



	public function edit_circle()

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

				$region_name  = xss_clean(strip_tags($this->input->post('region_name')));

				$circle_name  = xss_clean(strip_tags($this->input->post('circle_name')));

				$this->form_validation->set_rules('region_name','region name','trim|required');

				$this->form_validation->set_rules('circle_name','circle name','trim|required');



				if($this->form_validation->run() === false) 

					{

							

						$data['insertData'] = array(

							'region_name' => xss_clean($this->input->post('region_name')),

							'circle_name' => xss_clean($this->input->post('circle_name'))

						);

						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

						$data['circle_data'] = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $uri));

						$this->load->view('mainadmin/header');

						//$this->load->view('mainadmin/topmenu');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/masterdata/editcircle/'.$uri,$data);

						$this->load->view('mainadmin/footer');



					}//ends if



					else

					{

							date_default_timezone_set('Asia/Calcutta'); 

							$created_date =  date("Y-m-d H:i:s"); 



					/*****check circle name********/



						$checked = $this->Base_model->check_existent('tbl_circle', array('region_id'=> $region_name,'circle_name'=> $circle_name));



						/*****ends check circle name*****/



						if($checked=='1')

						{

							$msg = "Circle name already exits, Please enter new one";

							$this->session->set_flashdata('flashError_circle', $msg);

								/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to updated circle, circle name already exits : '.$circle_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

							$data['all_circle'] = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));

							$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							//$this->load->view('mainadmin/topmenu');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/masterdata/addcircle',$data);

							$this->load->view('mainadmin/footer');

							

						}// ends if



						else

						{

							$update_data = array(

													'region_id' 		=> $region_name,

													'circle_name' 	=> $circle_name,

													'created_date' 	=> $created_date,

													'updated_date' 	=> $created_date

												);

							$updateid = $this->Base_model->update_record_by_id('tbl_circle', $update_data, array('id'=> $uri));



							if($updateid)

							{

								$msg = "Circle updated successfully.";

								$this->session->set_flashdata('flashSuccess_circle',$msg);

								/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,circle updated successfully : '.$circle_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

								$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));

								$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

								$this->load->view('mainadmin/header');

								//$this->load->view('mainadmin/topmenu');

								$this->load->view('mainadmin/sidebar');

								$this->load->view('mainadmin/masterdata/addcircle',$data);

								$this->load->view('mainadmin/footer');

							}



							else

							{

								$msg = "Fail to update circle";

								$this->session->set_flashdata('flashError_circle', $msg);

								/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to update circle : '.$circle_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

								$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));

								$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

								$this->load->view('mainadmin/header');

								//$this->load->view('mainadmin/topmenu');

								$this->load->view('mainadmin/sidebar');

								$this->load->view('mainadmin/masterdata/addcircle',$data);

								$this->load->view('mainadmin/footer');

							}//ends else

						}//ends else

					}//ends main else

		}//ends if



		else

		{

				$uri = $this->uri->segment('3');

				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

				$data['circle_data'] = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $uri));

				$this->load->view('mainadmin/header');

				//$this->load->view('mainadmin/topmenu');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/masterdata/editcircle',$data);

				$this->load->view('mainadmin/footer');

		}//ends else

			}// ends else circle session  check


		

	}//ends function



	/********function for View Circle******/



	public function view_circle()

	{

				$uri = $this->uri->segment('3');

				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

				$data['circle_data'] = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $uri));

				$this->load->view('mainadmin/header');

				//$this->load->view('mainadmin/topmenu');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/masterdata/viewcircle',$data);

				$this->load->view('mainadmin/footer');

	}//ends function



	/********function for Delete Circle******/



	public function delete_circle()

	{	

				date_default_timezone_set('Asia/Calcutta'); 

				$created_date =  date("Y-m-d H:i:s"); 

				$delete_itemId = xss_clean($this->input->post('delete_itemId'));

				$data['circle_data'] = $circle_data =  $this->Base_model->get_record_by_id('tbl_circle', array('id' => $delete_itemId));

				$update_data = array(

													'region_id' 		=> $circle_data->region_id,

													'circle_name' 	=> $circle_data->circle_name,

													'status'				=> '0',

													'delete_status' => '0',

													'updated_date' 	=> $created_date

												);

				$updateid = $this->Base_model->update_record_by_id('tbl_circle', $update_data, array('id'=> $delete_itemId));

				/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,deleted circle :'.$circle_data->circle_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

					$msg = "Circle deleted successfully.";

								$this->session->set_flashdata('flashSuccess_circle',$msg);

								$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));

								$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

								$this->load->view('mainadmin/header');

								//$this->load->view('mainadmin/topmenu');

								$this->load->view('mainadmin/sidebar');

								$this->load->view('mainadmin/masterdata/addcircle',$data);

								$this->load->view('mainadmin/footer');

	}//ends function



	/*******function to gettting all circles********/



	public function all_circle()

	{

		

		$region_id = $this->input->post('id');

		$all_circle =  $this->Base_model->get_all_record_by_condition(' tbl_circle', array('region_id'=>$region_id,'status'=>1));

		$all_circles =  json_encode($all_circle);

		echo  $all_circles;

	}// ends function



/*******function to gettting all circular circles********/

public function all_circular_circle()

	{

		

		$job_id = $this->input->post('id');

		$job_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $job_id));

		$all_circle =  $this->Base_model->get_all_record_by_condition('tbl_circle', array('id'=>$job_data->circle_id));

		

		$all_circles =  json_encode($all_circle);

		echo  $all_circles;

	}// ends function

	/***********function for add post*******/



	public function add_post()

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

				$region_name  = xss_clean(strip_tags($this->input->post('region_name')));

				$circle_name  = xss_clean(strip_tags($this->input->post('circle_name')));

				$post_name  	= xss_clean(strip_tags($this->input->post('post_name')));

				$post_code  	= xss_clean(strip_tags($this->input->post('post_code')));



				$this->form_validation->set_rules('region_name','region name','trim|required');

				$this->form_validation->set_rules('circle_name','circle name','trim|required');

				$this->form_validation->set_rules('post_name','post name','trim|required');

				$this->form_validation->set_rules('post_code','post code','trim|required');



			if($this->form_validation->run() === false) 

				{

						

					$data['insertData'] = array(

						'region_name' => xss_clean($this->input->post('region_name')),

						'circle_name' => xss_clean($this->input->post('circle_name')),

						'post_name' 	=> xss_clean($this->input->post('post_name')),

						'post_code' 	=> xss_clean($this->input->post('post_code'))

					);



					$data['all_circle']  = $this->Base_model->get_all_record_by_condition(' tbl_circle', array('status'=>'1'));

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					//$this->load->view('mainadmin/topmenu');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/masterdata/addpost',$data);

					$this->load->view('mainadmin/footer');



				}//ends if



				else

				{

						date_default_timezone_set('Asia/Calcutta'); 

						$created_date =  date("Y-m-d H:i:s"); 



					/*****check post name********/



						$checked = $this->Base_model->check_existent('tbl_post', array('region_id'=>$region_name,'circle_id'=>$circle_name,'post_name'=>$post_name,'post_code'=>$post_code));



					/*****ends check region name*****/



					if($checked=='1')

					{

						$msg = "Post name and Post Code already exits, Please enter new one";

						$this->session->set_flashdata('flashError_post', $msg);

						/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to add post, post name and code already exits :'.$post_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

						$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

						$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

						$this->load->view('mainadmin/header');

						//$this->load->view('mainadmin/topmenu');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/masterdata/addpost',$data);

						$this->load->view('mainadmin/footer');

					}



					else

					{

						$insert_data = array(

													'region_id' 		=> $region_name,

													'circle_id' 		=> $circle_name,

													'post_name' 		=> $post_name,

													'post_code' 		=> $post_code,

													'created_date' 	=> $created_date,

													'updated_date' 	=> $created_date

												);

							$insertid = $this->Base_model->insert_one_row('tbl_post', $insert_data);



							if($insertid)

							{

								$msg = "Post added successfully.";

								$this->session->set_flashdata('flashSuccess_post',$msg);

								/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,added post successfully :'.$post_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

								$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

								$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

								$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

								$this->load->view('mainadmin/header');

								//$this->load->view('mainadmin/topmenu');

								$this->load->view('mainadmin/sidebar');

								$this->load->view('mainadmin/masterdata/addpost',$data);

								$this->load->view('mainadmin/footer');

							}



							else

							{

								$msg = "Fail to add post";

								$this->session->set_flashdata('flashError_post', $msg);

								/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to add post :'.$post_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

								$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

								$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

								$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

								$this->load->view('mainadmin/header');

								//$this->load->view('mainadmin/topmenu');

								$this->load->view('mainadmin/sidebar');

								$this->load->view('mainadmin/masterdata/addpost',$data);

								$this->load->view('mainadmin/footer');

							}//ends else

					}//ends else

				}//ends main else

		}//ends if



		else

		{

				$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

				$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

				$this->load->view('mainadmin/header');

				//$this->load->view('mainadmin/topmenu');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/masterdata/addpost',$data);

				$this->load->view('mainadmin/footer');

		}// ends else
			}// ends else session check

			

	}// ends function



	/***********function for edit post*******/



	public function edit_post()

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

					if(isset($_REQUEST['submit'])) 

		{	

				$uri = $this->uri->segment('3');

				$region_name  = xss_clean(strip_tags($this->input->post('region_name')));

				$circle_name  = xss_clean(strip_tags($this->input->post('circle_name')));

				$post_name  	= xss_clean(strip_tags($this->input->post('post_name')));

				$post_code  	= xss_clean(strip_tags($this->input->post('post_code')));



				$this->form_validation->set_rules('region_name','region name','trim|required');

				$this->form_validation->set_rules('circle_name','circle name','trim|required');

				$this->form_validation->set_rules('post_name','post name','trim|required');

				$this->form_validation->set_rules('post_code','post code','trim|required');



				if($this->form_validation->run() === false) 

					{

							

						$data['insertData'] = array(

						'region_name' => xss_clean($this->input->post('region_name')),

						'circle_name' => xss_clean($this->input->post('circle_name')),

						'post_name' 	=> xss_clean($this->input->post('post_name')),

						'post_code' 	=> xss_clean($this->input->post('post_code'))

					);



					$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$data['post_data'] 	 = $this->Base_model->get_record_by_id('tbl_post', array('id' => $uri));

					$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					//$this->load->view('mainadmin/topmenu');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/masterdata/editpost',$data);

					$this->load->view('mainadmin/footer');



					}//ends if



					else

					{

							date_default_timezone_set('Asia/Calcutta'); 

							$created_date =  date("Y-m-d H:i:s"); 



					/*****check post name********/



						$checked = $this->Base_model->check_existent('tbl_post', array('region_id'=>$region_name,'circle_id'=>$circle_name,'post_name'=>$post_name,'post_code'=>$post_code));



					/*****ends check region name*****/



						if($checked=='1')

						{

							$msg = "Post name and Post Code already exits, Please enter new one";

							$this->session->set_flashdata('flashError_post', $msg);

							/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to update post, post name and code already exits :'.$post_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

							$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

							$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

							$data['post_data'] 	 = $this->Base_model->get_record_by_id('tbl_post', array('id' => $uri));

							$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

							$this->load->view('mainadmin/header');

							//$this->load->view('mainadmin/topmenu');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/masterdata/addpost',$data);

							$this->load->view('mainadmin/footer');

						}





						else

						{

								$update_data = array(

													'region_id' 		=> $region_name,

													'circle_id' 		=> $circle_name,

													'post_name' 		=> $post_name,

													'post_code' 		=> $post_code,

													'created_date' 	=> $created_date,

													'updated_date' 	=> $created_date

												);

							$updateid = $this->Base_model->update_record_by_id('tbl_post', $update_data, array('id'=> $uri));



							if($updateid)

							{

								$msg = "Post updated successfully.";

								$this->session->set_flashdata('flashSuccess_post',$msg);

								/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,post updated successfully :'.$post_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

								$uri = $this->uri->segment('3');

								$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

								$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

								$data['post_data'] 	 = $this->Base_model->get_record_by_id('tbl_post', array('id' => $uri));

								$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

								$this->load->view('mainadmin/header');

								//$this->load->view('mainadmin/topmenu');

								$this->load->view('mainadmin/sidebar');

								$this->load->view('mainadmin/masterdata/addpost',$data);

								$this->load->view('mainadmin/footer');

							}



							else

							{

								$msg = "Fail to update post.";

								$this->session->set_flashdata('flashError_post',$msg);

								/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to update post :'.$post_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

								$uri = $this->uri->segment('3');

								$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

								$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

								$data['post_data'] 	 = $this->Base_model->get_record_by_id('tbl_post', array('id' => $uri));

								$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

								$this->load->view('mainadmin/header');

								//$this->load->view('mainadmin/topmenu');

								$this->load->view('mainadmin/sidebar');

								$this->load->view('mainadmin/masterdata/addpost',$data);

								$this->load->view('mainadmin/footer');

							}//ends else

						}// ends else

					}//ends main else

		}// ends if



		else

		{

				$uri = $this->uri->segment('3');

				$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

				$data['post_data'] 	 = $this->Base_model->get_record_by_id('tbl_post', array('id' => $uri));

				$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

				$this->load->view('mainadmin/header');

				//$this->load->view('mainadmin/topmenu');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/masterdata/editpost',$data);

				$this->load->view('mainadmin/footer');

		}//ends else

		
			}// ends else session check

		

	}//ends function



	/********function for View Post******/



	public function view_post()

	{

				$uri = $this->uri->segment('3');

				$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

				$data['post_data'] 	 = $this->Base_model->get_record_by_id('tbl_post', array('id' => $uri));

				$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

				$this->load->view('mainadmin/header');

				//$this->load->view('mainadmin/topmenu');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/masterdata/viewpost',$data);

				$this->load->view('mainadmin/footer');

	}//ends function



	/********function for Delete Post******/



	public function delete_post()

	{	

				date_default_timezone_set('Asia/Calcutta'); 

				$created_date =  date("Y-m-d H:i:s"); 

				$delete_itemId = xss_clean($this->input->post('delete_itemId'));

				$data['post_data'] = $post_data =  $this->Base_model->get_record_by_id('tbl_post', array('id' => $delete_itemId));

				$update_data = array(

													'region_id' 		=> $post_data->region_id,

													'circle_id' 		=> $post_data->circle_id,

													'post_name' 		=> $post_data->post_name,

													'post_code' 		=> $post_data->post_code,

													'status'				=> '0',

													'delete_status' => '0',

													'updated_date' 	=> $created_date

												);
				/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,deleted  post : '.$post_data->post_name,
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 		/*********ends logs code*******/

				$updateid = $this->Base_model->update_record_by_id('tbl_post', $update_data, array('id'=> $delete_itemId));

					$msg = "Post deleted successfully.";

								$this->session->set_flashdata('flashSuccess_circle',$msg);

								$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

								$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

								$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

								$this->load->view('mainadmin/header');

								//$this->load->view('mainadmin/topmenu');

								$this->load->view('mainadmin/sidebar');

								$this->load->view('mainadmin/masterdata/addpost',$data);

								$this->load->view('mainadmin/footer');

	}//ends function



	/*************function for search region*********/



	public function search_region()

	{

		$region_name = xss_clean($this->input->post('regionn_nname'));



			if(empty($region_name))

			{

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/masterdata/addregion',$data);

					$this->load->view('mainadmin/footer');

			}//ends if



			else

			{

					$data['all_regions'] = $this->Base_model->search_region($region_name);

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/masterdata/addregion',$data);

					$this->load->view('mainadmin/footer');

			}//ends else



	}//ends function



	/*************function for search circle*********/



	public function search_circle()

	{

		$region_name = xss_clean($this->input->post('regionn_nname'));

		$circle_name = xss_clean($this->input->post('circlee_nname'));



			if(empty($region_name) && empty($circle_name))

			{

					$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/masterdata/addcircle',$data);

					$this->load->view('mainadmin/footer');



			}//ends if



			else

			{

					$circle_data = $this->Base_model->search_circle($region_name,$circle_name);

					$all_circle_data = array_filter($circle_data);

			

					$data['all_circle']  = $all_circle_data;

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/masterdata/addcircle',$data);

					$this->load->view('mainadmin/footer');



			}//ends else



	}//ends function



	/*************function for search post*********/



	public function search_post()

	{



			$region_name = xss_clean($this->input->post('regionn_nname'));

			$circle_name = xss_clean($this->input->post('cirrccle_nname'));

			$post_name 	 = xss_clean($this->input->post('poosst_nname'));



				if(empty($region_name) && empty($circle_name) && empty($post_name))

				{

					$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/masterdata/addpost',$data);

					$this->load->view('mainadmin/footer');



				}//ends if



				else

				{

						$post_data = $this->Base_model->search_post($region_name,$circle_name,$post_name);

						$all_post_data = array_filter($post_data);

				

						$data['all_circle']  = $this->Base_model->get_all_record_by_condition('tbl_circle', array('status'=>'1'));

						$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

						$data['all_post'] 	 = $all_post_data;

						$this->load->view('mainadmin/header');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/masterdata/addpost',$data);

						$this->load->view('mainadmin/footer');

				}





	}//ends function



	//function for edit profile

		

	public function edit_profile()

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
				
			$uri = $this->uri->segment('3');

			if(isset($_REQUEST['submit'])) 

			{

			  $user_name  = xss_clean(strip_tags($this->input->post('user_name')));

			  $email  = xss_clean(strip_tags($this->input->post('email')));

			  $contact_no  = xss_clean(strip_tags($this->input->post('contact_no')));

			  $password  = xss_clean(strip_tags($this->input->post('password2')));
			  $old_pwd  = xss_clean(strip_tags($this->input->post('old_passworrd')));
			  $cnfrm_passworrd  = xss_clean(strip_tags($this->input->post('cnfrm_passworrd')));

			  $usersData = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $uri));
			  

			  if($cnfrm_passworrd != $password)
				{

					$msg = "Password and Confirm Pasword not matched.";

					$this->session->set_flashdata('flashError_profileupdate', $msg);

					$uri = $this->uri->segment('3');

					$data['insertData'] = array(

							'user_name' => xss_clean($this->input->post('user_name')),

							'email' => xss_clean($this->input->post('email')),

							'contact_no' => xss_clean($this->input->post('contact_no')),

							'password2' => xss_clean($this->input->post('password2')),

							);



							$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));

							$this->load->view('mainadmin/header');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/editprofile',$data);

							$this->load->view('mainadmin/footer');

			}// ends if

				else
				{
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



							$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));

							$this->load->view('mainadmin/header');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/editprofile',$data);

							$this->load->view('mainadmin/footer');

					}// ends if



				else

					{
						$old_pwd  = xss_clean($this->input->post('old_passworrd'));
						
						if($usersData->password != $old_pwd)
					{

					$msg = "Old password not matched.";

					$this->session->set_flashdata('flashError_profileupdate', $msg);

					$uri = $this->uri->segment('3');

					$data['insertData'] = array(

							'user_name' => xss_clean($this->input->post('user_name')),

							'email' => xss_clean($this->input->post('email')),

							'contact_no' => xss_clean($this->input->post('contact_no')),

							'password2' => xss_clean($this->input->post('password2')),

							);



							$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));

							$this->load->view('mainadmin/header');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/editprofile',$data);

							$this->load->view('mainadmin/footer');

			}// ends if

							
			else
			{
				/***********File upload code*******/

				$user_id = $this->session->userdata('auser_id');

				$user_name = $this->session->userdata('ausername');

				$pic_name = $user_name.'_'.$user_id.'_'.time().'_photo_';

				

				if($_FILES['user_pic']['name'])

                {

                	$finfo = new finfo(FILEINFO_MIME_TYPE);

                	$uploaded_file_name  = $_FILES['user_pic']['name'];
						
					$count_dots = substr_count($uploaded_file_name, '.');


					if($count_dots > 1)
					{
							$msg = "Please select correct file.";

							$this->session->set_flashdata('flashError_profileupdate', $msg);

							$uri = $this->uri->segment('3');

							$data['insertData'] = array(

									'user_name' => xss_clean($this->input->post('user_name')),

									'email' => xss_clean($this->input->post('email')),

									'contact_no' => xss_clean($this->input->post('contact_no')),

									'password2' => xss_clean($this->input->post('password2')),

									);



							$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));

							$this->load->view('mainadmin/header');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/editprofile',$data);

							$this->load->view('mainadmin/footer');


					} else if (false === $ext = array_search(
				        
				        $finfo->file($_FILES['user_pic']['tmp_name']),
				        array(
				            'jpg' => 'image/jpeg',
				            'png' => 'image/png',
				            'gif' => 'image/gif',
				        ),
				        true

				    )) {


				           $msg = "This type of file is not allowed. Please select file in correct formate.";

							$this->session->set_flashdata('flashError_profileupdate', $msg);

							$uri = $this->uri->segment('3');

							$data['insertData'] = array(

									'user_name' => xss_clean($this->input->post('user_name')),

									'email' => xss_clean($this->input->post('email')),

									'contact_no' => xss_clean($this->input->post('contact_no')),

									'password2' => xss_clean($this->input->post('password2')),

									);



							$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));

							$this->load->view('mainadmin/header');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/editprofile',$data);

							$this->load->view('mainadmin/footer');


					} else {
                        

                         $configg = array(

                             'upload_path' => "./uploads/admin_photos/",

                             'allowed_types' => "jpg|png|jpeg|gif",

                             'overwrite' => TRUE,

                             'max_size' => "2048", 

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


							 $user_name  = xss_clean(strip_tags($this->input->post('user_name')));

							 $email  = xss_clean(strip_tags($this->input->post('email')));

							 $contact_no  = xss_clean(strip_tags($this->input->post('contact_no')));

							 $uri = $this->uri->segment('3');

							 $password  = xss_clean(strip_tags($this->input->post('password2')));

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

													'password'			=> $password,

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

								$this->load->view('mainadmin/header');

								$this->load->view('mainadmin/sidebar');

								$this->load->view('mainadmin/editprofile',$data);

								$this->load->view('mainadmin/footer');

							}

							else

							{

							$msg = "Fail to update profile.";

							$this->session->set_flashdata('flashError_profileupdate',$msg);

							$uri = $this->uri->segment('3');

							$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));

							$this->load->view('mainadmin/header');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/editprofile',$data);

							$this->load->view('mainadmin/footer');

							}//ends else


					     }  // end last update else

					} // end file check if	


					else {

                           
                         date_default_timezone_set('Asia/Calcutta'); 

						   $created_date =  date("Y-m-d H:i:s");

						    $uri = $this->uri->segment('3'); 

						    $user 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));

						    $img_name = $user->user_pic;

							 $user_name  = xss_clean(strip_tags($this->input->post('user_name')));

							 $email  = xss_clean(strip_tags($this->input->post('email')));

							 $contact_no  = xss_clean(strip_tags($this->input->post('contact_no')));

							 $uri = $this->uri->segment('3');

							 $password  = xss_clean(strip_tags($this->input->post('password2')));

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

													'password'			=> $password,

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

								$this->load->view('mainadmin/header');

								$this->load->view('mainadmin/sidebar');

								$this->load->view('mainadmin/editprofile',$data);

								$this->load->view('mainadmin/footer');

							}

							else

							{

							$msg = "Fail to update profile.";

							$this->session->set_flashdata('flashError_profileupdate',$msg);

							$uri = $this->uri->segment('3');

							$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));

							$this->load->view('mainadmin/header');

							$this->load->view('mainadmin/sidebar');

							$this->load->view('mainadmin/editprofile',$data);

							$this->load->view('mainadmin/footer');

							}//ends else     


					}


						}//ends conditional else


					}//ends else

				}//ends elsess

			}//ends if



			else

			{

				$uri = $this->uri->segment('3');

				$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));

				$this->load->view('mainadmin/header');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/editprofile',$data);

				$this->load->view('mainadmin/footer');

			}//ends else

			}//ends else session  check

			

	}



	/********function for view profile******/



	public function view_profile()

	{

			$uri = $this->uri->segment('3');

			$data['user_data'] 	 = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $uri));

			$this->load->view('mainadmin/header');

			$this->load->view('mainadmin/sidebar');

			$this->load->view('mainadmin/viewprofile',$data);

			$this->load->view('mainadmin/footer');

	}



	

	

}//class ends

