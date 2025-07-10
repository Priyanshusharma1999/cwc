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
		$data['all_applicant_data'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info',NULL);
		$this->load->view('mainadmin/header');
		$this->load->view('mainadmin/sidebar');
		$this->load->view('mainadmin/applicants/applicantslist',$data);
		$this->load->view('mainadmin/footer');
		
	}//ends function

	
}//class ends
