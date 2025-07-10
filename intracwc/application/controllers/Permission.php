<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Permission extends CI_Controller {


  function __construct()
	{
			parent::__construct();
			$this->load->model('Base_model');
			
			if(empty($this->session->userdata('user_id')))
			 {
				$base_url = base_url();
				 redirect($base_url);
			 } 
			
	}
	 
	 
	public function index()
	{
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar_permission');
		$this->load->view('admin/permission');
		$this->load->view('admin/footer');
	
	}
		
	
	
	
}
