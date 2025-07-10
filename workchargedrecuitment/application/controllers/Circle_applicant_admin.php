<?php
//require 'vendor/autoload.php';  
	use Twilio\Rest\Client;

	error_reporting(0);
	
defined('BASEPATH') OR exit('No direct script access allowed');

class Circle_applicant_admin extends CI_Controller {

	// Initialize Constructor Here
	function __construct()
	{
			parent::__construct();
			$this->load->model('Base_model');

			$admindata = $this->Base_model->get_record_by_id('tbl_admin', array('id' =>$this->session->userdata('auser_id')));
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
		$user_id = $this->session->userdata('auser_id');
		$user_data = $this->Base_model->get_record_by_id('tbl_admin', array('Id' => $user_id));
		$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
		$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
					
		$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
		$data['all_applicant_data'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info',array('circle_id'=>$user_data->Circle));
		$this->load->view('circle/header');
		$this->load->view('circle/sidebar');
		$this->load->view('circle/applicants/applicantslist',$data);
		$this->load->view('circle/footer');
		
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
			$this->load->view('circle/header');
			$this->load->view('circle/sidebar');
			$this->load->view('circle/applicants/view_job',$data);
			$this->load->view('circle/footer');
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
					$this->load->view('circle/header');
					$this->load->view('circle/sidebar');
					$this->load->view('circle/applicants/applicantslist',$data);
					$this->load->view('circle/footer');
					
					
				}//ends if

				else
				{
					
					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));
					$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));
					$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));
					
					$data['all_applicant_data'] = $this->Base_model->searching_applicant($applicant_name,$post_name,$caste_category,$ex_serviceman);
					$this->load->view('circle/header');
					$this->load->view('circle/sidebar');
					$this->load->view('circle/applicants/applicantslist',$data);
					$this->load->view('circle/footer');

				}//ends else
	}// function ends

	

	




	
}//class ends
