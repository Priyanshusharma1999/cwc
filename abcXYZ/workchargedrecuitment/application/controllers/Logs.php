<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class Logs extends CI_Controller {

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
			$data['all_user_logs'] = $this->Base_model->get_all_record_by_condition('userlogs',NULL);
			$this->load->view('mainadmin/header');
			$this->load->view('mainadmin/sidebar');
			$this->load->view('mainadmin/auditlogs',$data);
			$this->load->view('mainadmin/footer');
		}
			
	
	}
	
	
	

	
}//ends cclass
