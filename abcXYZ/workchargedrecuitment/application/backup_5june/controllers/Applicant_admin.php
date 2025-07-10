<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicant_admin extends CI_Controller {

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
		$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
		$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
					$this->load->view('mainadmin/header');
		$data['all_applicant_data'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info',NULL);
		$this->load->view('mainadmin/header');
		$this->load->view('mainadmin/sidebar');
		$this->load->view('mainadmin/applicants/applicantslist',$data);
		$this->load->view('mainadmin/footer');
		
	}//ends function

	/**********function for view job*******/

	public function view_job()
	{
			$uri = $this->uri->segment('3');
			$job_id = $uri;
			$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($job_id);
			$data['region_data'] = $this->Base_model->get_record_by_id('tbl_region', array('id' => $all_job_data[0]->region_id));
			$data['circle_data'] = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $all_job_data[0]->circle_id));
			$data['post_data'] = $this->Base_model->get_record_by_id('tbl_post', array('id' => $all_job_data[0]->post_id));
			$data['job_data'] = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $all_job_data[0]->job_id));
			$data['present_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->present_address_state));
			$data['permanent_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->permanent_address_state));
			$this->load->view('mainadmin/header');
			$this->load->view('mainadmin/sidebar');
			$this->load->view('mainadmin/applicants/view_job',$data);
			$this->load->view('mainadmin/footer');
	}// ends function

	/*************function for edit job***********/

	public function edit_job()
	{
		$uri = $this->uri->segment('3');

			if(isset($_REQUEST['submit'])) 
			{

				$job_status  		= xss_clean($this->input->post('job_status'));
				$this->form_validation->set_rules('job_status','Job Status','trim|required');

				if($this->form_validation->run() === false) 
				{
					$uri = $this->uri->segment('3');
					$job_id = $uri;
						$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($job_id);
						$data['region_data'] = $this->Base_model->get_record_by_id('tbl_region', array('id' => $all_job_data[0]->region_id));
						$data['circle_data'] = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $all_job_data[0]->circle_id));
						$data['post_data'] = $this->Base_model->get_record_by_id('tbl_post', array('id' => $all_job_data[0]->post_id));
						$data['job_data'] = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $all_job_data[0]->job_id));
						$data['present_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->present_address_state));
						$data['permanent_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->permanent_address_state));
						$this->load->view('mainadmin/header');
						$this->load->view('mainadmin/sidebar');
						$this->load->view('mainadmin/applicants/edit_job',$data);
						$this->load->view('mainadmin/footer');
				}//ends if

				else
				{
						
						$uri = $this->uri->segment('3');
						$job_status  		= xss_clean($this->input->post('job_status'));
						$created_date =  date("Y-m-d H:i:s");
						$update_data = array(
																'job_status' => $job_status,
																'updated_date'		=> $created_date);
						$updateid = $this->Base_model->update_record_by_id('tbl_app_job_bas_info', $update_data, array('id'=> $uri));

						if($updateid)
										{
											$msg = "Job updated successfully.";
											$this->session->set_flashdata('flashSuccess_circular',$msg);
											$job_id = $uri;
											$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
											$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
														$this->load->view('mainadmin/header');
											$data['all_applicant_data'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info',NULL);

											$this->load->view('mainadmin/header');
											$this->load->view('mainadmin/sidebar');
											$this->load->view('mainadmin/applicants/applicantslist',$data);
											$this->load->view('mainadmin/footer');		
										}

										else
										{
											$msg = "Fail to update job.";
											$this->session->set_flashdata('flashError_circular', $msg);
										
											$job_id = $uri;
											$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($job_id);
											$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
											$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
														$this->load->view('mainadmin/header');
											$data['all_applicant_data'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info',NULL);
											$this->load->view('mainadmin/header');
											$this->load->view('mainadmin/sidebar');
											$this->load->view('mainadmin/applicants/applicantslist',$data);
											$this->load->view('mainadmin/footer');	
										}
				}

			}//ends if

			else
			{
						$uri = $this->uri->segment('3');
						$job_id = $uri;
						$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($job_id);
						$data['region_data'] = $this->Base_model->get_record_by_id('tbl_region', array('id' => $all_job_data[0]->region_id));
						$data['circle_data'] = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $all_job_data[0]->circle_id));
						$data['post_data'] = $this->Base_model->get_record_by_id('tbl_post', array('id' => $all_job_data[0]->post_id));
						$data['job_data'] = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $all_job_data[0]->job_id));
						$data['present_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->present_address_state));
						$data['permanent_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->permanent_address_state));
						$this->load->view('mainadmin/header');
						$this->load->view('mainadmin/sidebar');
						$this->load->view('mainadmin/applicants/edit_job',$data);
						$this->load->view('mainadmin/footer');
			}//ends else
		
	}// ends function

	/*******function for applicant search******/

	public function search_applicant()
	{
		
		$applicant_name  	= xss_clean($this->input->post('applicant_name'));
		$post_name  			= xss_clean($this->input->post('post_name'));
		$caste_category  	= xss_clean($this->input->post('caste_category'));
		$ex_serviceman  	= xss_clean($this->input->post('ex_serviceman'));

		if(empty($applicant_name) && empty($post_name) && empty($caste_category) && empty($ex_serviceman))
				{
					
					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
					$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
								$this->load->view('mainadmin/header');
					$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
					$data['all_applicant_data'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info',NULL);
					$this->load->view('mainadmin/header');
					$this->load->view('mainadmin/sidebar');
					$this->load->view('mainadmin/applicants/applicantslist',$data);
					$this->load->view('mainadmin/footer');
				}//ends if

				else
				{
					
					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
					$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
					$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
					$this->load->view('mainadmin/header');
					$data['all_applicant_data'] = $this->Base_model->searching_applicant($applicant_name,$post_name,$caste_category,$ex_serviceman);
					$this->load->view('mainadmin/header');
					$this->load->view('mainadmin/sidebar');
					$this->load->view('mainadmin/applicants/applicantslist',$data);
					$this->load->view('mainadmin/footer');

				}//ends else
	}// function ends

	/********Send bulk sms*****/

	public function bulk_sms()
	{
			$data = '';
			$this->load->view('mainadmin/header');
			$this->load->view('mainadmin/sidebar');
			$this->load->view('mainadmin/applicants/bulksms',$data);
			$this->load->view('mainadmin/footer');

	}//ends function



	
}//class ends
