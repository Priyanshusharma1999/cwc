<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Controller {

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
			$this->load->model('Stationary_model');
	}
	
	public function index()
	{
		
		$data['all_complaints'] = $all_complaints= $this->Base_model->get_all_record_by_condition('complaint', array('service_type'=>'2','delete_status'=>'1'));
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-nonitasset');
		$this->load->view('admin/nonitcomplain_management/reportlist',$data);
		$this->load->view('admin/footer');
	
	}
	
	
	
}
