<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Superadmin extends CI_Controller {

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
		$data['all_applicant'] = $this->Base_model->get_all_record_by_condition('tbl_applicant',NULL);
		$data['all_jobs'] = $this->Base_model->get_all_record_by_condition('tbl_jobs',NULL);
		$this->load->view('mainadmin/header');
		$this->load->view('mainadmin/sidebar');
		$this->load->view('mainadmin/dashboard',$data);
		$this->load->view('mainadmin/footer');	

	}//ends function

	/***********function for add region*******/

	public function add_region()
	{
		if(isset($_REQUEST['submit'])) 
		{
			$region_name  = xss_clean($this->input->post('region_name'));
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

	}// ends function

	/********function for Edit Region******/

	public function edit_region()
	{
		$uri = $this->uri->segment('3');
		if(isset($_REQUEST['submit'])) 
		{
			$uri = $this->uri->segment('3');
			$region_name  = xss_clean($this->input->post('region_name'));
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
		if(isset($_REQUEST['submit'])) 
		{
			$region_name  = xss_clean($this->input->post('region_name'));
			$circle_name  = xss_clean($this->input->post('circle_name'));
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
		
	}//ends function

	/********function for Edit Circle******/

	public function edit_circle()
	{
		$uri = $this->uri->segment('3');
		if(isset($_REQUEST['submit'])) 
		{
				$uri = $this->uri->segment('3');
				$region_name  = xss_clean($this->input->post('region_name'));
				$circle_name  = xss_clean($this->input->post('circle_name'));
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
		$all_circle =  $this->Base_model->get_all_record_by_condition(' tbl_circle', array('region_id'=>$region_id));
		$all_circles =  json_encode($all_circle);
		echo  $all_circles;
	}// ends function

	/***********function for add post*******/

	public function add_post()
	{
			if(isset($_REQUEST['submit'])) 
		{
				$region_name  = xss_clean($this->input->post('region_name'));
				$circle_name  = xss_clean($this->input->post('circle_name'));
				$post_name  	= xss_clean($this->input->post('post_name'));
				$post_code  	= xss_clean($this->input->post('post_code'));

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
	}// ends function

	/***********function for edit post*******/

	public function edit_post()
	{
		if(isset($_REQUEST['submit'])) 
		{	
				$uri = $this->uri->segment('3');
				$region_name  = xss_clean($this->input->post('region_name'));
				$circle_name  = xss_clean($this->input->post('circle_name'));
				$post_name  	= xss_clean($this->input->post('post_name'));
				$post_code  	= xss_clean($this->input->post('post_code'));

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

	
	
}//class ends
