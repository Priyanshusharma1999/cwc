<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor extends CI_Controller {

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
		
		$data['vendor_list'] = $this->Base_model->get_all_record_by_condition('vendor',array('status'=>'1','delete_status'=>'1','service_type'=> 2));
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-nonitasset');
		$this->load->view('admin/nonitcomplain_management/vendordetails',$data);
		$this->load->view('admin/footer');
	
	}
	
	
	public function employee_details(){
		
		$uri = $this->uri->segment('4'); 
		
		$data['employee_list'] = $this->Base_model->get_all_record_by_condition('vendor_employee',array('vendor_id'=>$uri,'status'=>'1','delete_status'=>'1'));
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-nonitasset');
		$this->load->view('admin/nonitcomplain_management/vendoremployeedetails',$data);
		$this->load->view('admin/footer');
		
	}
	
	
}
