<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

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

		if(empty($this->session->userdata('user_id')))
	     {
	     	$base_url = base_url().'Frontend';
	        redirect($base_url);
	     } 
		
	   	$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("11", $user_roles))
			  {
			  	$roledata['permission_role'] = $user_roles;
			  }
				
   
	}
	
	

	public function index()
	{
		
		 $data['all_notification'] = $this->Base_model->get_all_record_by_condition('tbl_notification',array('delete_status'=>'0','read_status'=>'0','service_type'=>'1'));

		 $update_data = array(
							'read_status' => '1'
						   );

	    $this->Base_model->update_record_by_id('tbl_notification', $update_data, array('read_status' => '0','service_type' => '1'));
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-itstationary');
		$this->load->view('admin/itstationary_management/notification/notificationlist',$data);
		$this->load->view('admin/footer');
	
	}
	
	
}
