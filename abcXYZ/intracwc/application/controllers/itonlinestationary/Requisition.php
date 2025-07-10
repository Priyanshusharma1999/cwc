<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Requisition extends CI_Controller {

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

		 $months = array();

		 $user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("1", $user_roles))
		  {

		  	$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'service_type'=>1));
		  	
		  } else {

		  	$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'user_id'=>$this->session->userdata('user_id'),'service_type'=>1));

		  }
		
		$data['check_requisition'] = $this->Stationary_model->check_requisition();

		$user_req_month  = $this->Base_model->get_all_record_by_condition('user_req_month', array('user_id' => $this->session->userdata('user_id')));

		foreach($user_req_month as $monthname){

			$months[] =  $monthname->month_code;

		}

	    $month = date('F');

	    if(in_array($month, $months)){

	    	$data['monyh_req'] = '1';

	    } else {

	    	$data['monyh_req'] = '0';
	    }
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-itstationary',$roledata);
		$this->load->view('admin/itstationary_management/requisition/requestlist',$data);
		$this->load->view('admin/footer');
		  
	
	}


	
	public function addrequisition(){


		$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		 foreach ($user_role_data as $role_id)
		  {
		   		$user_roles[]= $role_id->role_id;
		  }
	  
		  if (in_array("11", $user_roles))
		  {
		  	$roledata['permission_role'] = $user_roles;
		  }	

		
		if(isset($_REQUEST['submit'])) 
		{

			$item        = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$remarks     = xss_clean($this->input->post('remarks'));

			$dir           = xss_clean($this->input->post('dir'));
			$dydir         = xss_clean($this->input->post('dydir'));
			$ad            = xss_clean($this->input->post('ad'));
			$dman          = xss_clean($this->input->post('dman'));
			$so            = xss_clean($this->input->post('so'));
			$asstt         = xss_clean($this->input->post('asstt'));
			$udcldc        = xss_clean($this->input->post('udcldc'));
			$pasteno       = xss_clean($this->input->post('pasteno'));
			$others        = xss_clean($this->input->post('others'));
			
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');
			

			if($this->form_validation->run() === false) 
			{
				
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			
				$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
				
				$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
				
				   $data['insertData'] = array(
						'item' 		=> xss_clean(strip_tags($this->input->post('item'))),
						'quantity'		  => xss_clean(strip_tags($this->input->post('quantity'))),
						'remarks' 				=> xss_clean(strip_tags($this->input->post('remarks')))
					);
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary',$roledata);
					$this->load->view('admin/itstationary_management/requisition/addrequest',$data);
					$this->load->view('admin/footer');
		

			} else
				{
				
					date_default_timezone_set('Asia/Calcutta'); 
					
					 $created_date =  date("Y-m-d H:i:s"); 

					 $pst = date('Y');

	                 $pt = date('Y', strtotime('+1 year'));

	                 $fy = $pst.'-'.$pt;

					$user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						 
					$insert_master = array(
							'user_id' 	            => $this->session->userdata('user_id'),
							'emp_id' 	            => $user_detail->employee_id,
							'req_date' 	            => $created_date,
							'cancel_date' 	        => NULL,
							'cancel_remark' 	    => NULL,
							'status' 	            => 'Pending',
							'delete_status' 	    => '0',
							'service_type'          => '1',
							'issue_to'              => NULL,
							'issue_remarks'         => NULL,
							'issue_date'            => $created_date,
							'financial_year'        => $fy,
							'dir_no'                => $dir,
							'dydir_no'              => $dydir,
							'adead_no'              => $ad,
							'dman_no'               => $dman,
							'so_no'                 => $so,
							'asstt_no'              => $asstt,
							'udcldc_no'             => $udcldc,
							'pa_no'                 => $pasteno,
							'others'                => $others,
							'modified_by' 	        => $this->session->userdata('user_id'),
							'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
							'created_date' 	        => $created_date,
							'updated_date'   	    => $created_date
						);
				$reqid = $this->Base_model->insert_one_row('osr_requisition_master', $insert_master);	 
				
				   if($reqid){
					   
						$i=0;

                        foreach($item as $items){

						  $insertid = $this->Base_model->insert_one_row('osr_requisition_item', 
						  array(

						  	    'req_id'                => $reqid,
								'item_id'               => $items,
								'req_qty'               => $quantity[$i],
								'req_remark' 	        => $remarks[$i],
								'approved_qty'          => '0',
								'approval_date'         => $created_date,
								'receipt_date'          => $created_date,
								'status' 	            => '1',
								'delete_status' 	    => '0',
								'service_type'          => '1',
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							) );
								
								$i++;
						   
						}				

						if($insertid)
						{
							$msg = "Request successfully.";
							$this->session->set_flashdata('flashSuccess_request',$msg); 

							$insert_notdata = array(

							'notification_message' 	=> 'New Request has placed by '.$user_detail->display_name.'',
							'read_status' 	        => '0',
							'delete_status' 	    => '0',
							'service_type' 	        => '1',
							'created_date' 	        => $created_date,
							'updated_date'   	    => $created_date

						   );

				         $notifiid = $this->Base_model->insert_one_row('tbl_notification', $insert_notdata);	
							
							redirect('itonlinestationary/Requisition');
						}

						else
						{
							$msg = "Fail Request";
							$this->session->set_flashdata('flashError_request', $msg);
							
							
							$data['insertData'] = array(
								'item' 		=> xss_clean(strip_tags($this->input->post('item'))),
								'quantity'		  => xss_clean(strip_tags($this->input->post('quantity'))),
								'remarks' 				=> xss_clean(strip_tags($this->input->post('remarks')))
							);
							
							$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			
						$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						
						$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
						
						$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary',$roledata);
						$this->load->view('admin/itstationary_management/requisition/addrequest',$data);
						$this->load->view('admin/footer');
						
					  }
					  
				   } else {
					   
					   $msg = "Fail Request to add";
					   $this->session->set_flashdata('flashError_request', $msg);
					   
					   $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			
						$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						
						$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
						
						$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary',$roledata);
						$this->load->view('admin/itstationary_management/requisition/addrequest',$data);
						$this->load->view('admin/footer');
					   
				   }				
				
				}

		}

		else
		{
			
			$check_requisition = $this->Stationary_model->check_requisition(); 	
			
			 if($check_requisition=='1')
		      {
				$base_url = base_url();
				redirect($base_url);
		      } 
			
	        $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			
			$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
			
			$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
			
			$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-itstationary',$roledata);
			$this->load->view('admin/itstationary_management/requisition/addrequest',$data);
			$this->load->view('admin/footer');

		}
		
	}



  public function addsuprequisition(){


		$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		 foreach ($user_role_data as $role_id)
		  {
		   		$user_roles[]= $role_id->role_id;
		  }
	  
		  if (in_array("11", $user_roles))
		  {
		  	$roledata['permission_role'] = $user_roles;
		  }	

		
		if(isset($_REQUEST['submit'])) 
		{

			$item        = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$remarks     = xss_clean($this->input->post('remarks'));

			$dir           = xss_clean($this->input->post('dir'));
			$dydir         = xss_clean($this->input->post('dydir'));
			$ad            = xss_clean($this->input->post('ad'));
			$dman          = xss_clean($this->input->post('dman'));
			$so            = xss_clean($this->input->post('so'));
			$asstt         = xss_clean($this->input->post('asstt'));
			$udcldc        = xss_clean($this->input->post('udcldc'));
			$pasteno       = xss_clean($this->input->post('pasteno'));
			$others        = xss_clean($this->input->post('others'));
			
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');
			

			if($this->form_validation->run() === false) 
			{
				
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			
				$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
				
				$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
				
				   $data['insertData'] = array(
						'item' 		=> xss_clean(strip_tags($this->input->post('item'))),
						'quantity'		  => xss_clean(strip_tags($this->input->post('quantity'))),
						'remarks' 				=> xss_clean(strip_tags($this->input->post('remarks')))
					);
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary',$roledata);
					$this->load->view('admin/itstationary_management/requisition/addsuprequest',$data);
					$this->load->view('admin/footer');
		

			} else
				{
				
					date_default_timezone_set('Asia/Calcutta'); 
					
					 $created_date =  date("Y-m-d H:i:s"); 

					 $pst = date('Y');

	                 $pt = date('Y', strtotime('+1 year'));

	                 $fy = $pst.'-'.$pt;

					$user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						 
					$insert_master = array(
							'user_id' 	            => $this->session->userdata('user_id'),
							'emp_id' 	            => $user_detail->employee_id,
							'req_date' 	            => $created_date,
							'cancel_date' 	        => NULL,
							'cancel_remark' 	    => NULL,
							'status' 	            => 'Pending',
							'delete_status' 	    => '0',
							'service_type'          => '1',
							'is_supplementary'      => '1',
							'issue_to'              => NULL,
							'issue_remarks'         => NULL,
							'issue_date'            => $created_date,
							'financial_year'        => $fy,
							'dir_no'                => $dir,
							'dydir_no'              => $dydir,
							'adead_no'              => $ad,
							'dman_no'               => $dman,
							'so_no'                 => $so,
							'asstt_no'              => $asstt,
							'udcldc_no'             => $udcldc,
							'pa_no'                 => $pasteno,
							'others'                => $others,
							'modified_by' 	        => $this->session->userdata('user_id'),
							'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
							'created_date' 	        => $created_date,
							'updated_date'   	    => $created_date
						);
				$reqid = $this->Base_model->insert_one_row('osr_requisition_master', $insert_master);	 
				
				   if($reqid){
					   
						$i=0;

                        foreach($item as $items){

						  $insertid = $this->Base_model->insert_one_row('osr_requisition_item', 
						  array(

						  	    'req_id'                => $reqid,
								'item_id'               => $items,
								'req_qty'               => $quantity[$i],
								'req_remark' 	        => $remarks[$i],
								'approved_qty'          => '0',
								'approval_date'         => $created_date,
								'receipt_date'          => $created_date,
								'status' 	            => '1',
								'delete_status' 	    => '0',
								'service_type'          => '1',
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							) );
								
								$i++;
						   
						}				

						if($insertid)
						{
							$msg = "Request successfully.";
							$this->session->set_flashdata('flashSuccess_request',$msg); 

							$insert_notdata = array(

							'notification_message' 	=> 'New Request has placed by '.$user_detail->display_name.'',
							'read_status' 	        => '0',
							'delete_status' 	    => '0',
							'service_type' 	        => '1',
							'created_date' 	        => $created_date,
							'updated_date'   	    => $created_date

						   );

				         $notifiid = $this->Base_model->insert_one_row('tbl_notification', $insert_notdata);	
							
							redirect('itonlinestationary/Requisition');
						}

						else
						{
							$msg = "Fail Request";
							$this->session->set_flashdata('flashError_request', $msg);
							
							
							$data['insertData'] = array(
								'item' 		=> xss_clean(strip_tags($this->input->post('item'))),
								'quantity'		  => xss_clean(strip_tags($this->input->post('quantity'))),
								'remarks' 				=> xss_clean(strip_tags($this->input->post('remarks')))
							);
							
							$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			
						$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						
						$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
						
						$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary',$roledata);
						$this->load->view('admin/itstationary_management/requisition/addsuprequest',$data);
						$this->load->view('admin/footer');
						
					  }
					  
				   } else {
					   
					   $msg = "Fail Request to add";
					   $this->session->set_flashdata('flashError_request', $msg);
					   
					   $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			
						$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						
						$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
						
						$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary',$roledata);
						$this->load->view('admin/itstationary_management/requisition/addsuprequest',$data);
						$this->load->view('admin/footer');
					   
				   }				
				
				}

		}

		else
		{
			
			$check_requisition = $this->Stationary_model->check_requisition(); 	
			
			 if($check_requisition=='1')
		      {
				$base_url = base_url();
				redirect($base_url);
		      } 
			
	        $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			
			$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
			
			$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
			
			$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-itstationary',$roledata);
			$this->load->view('admin/itstationary_management/requisition/addsuprequest',$data);
			$this->load->view('admin/footer');

		}
		
	}



	public function addmiscallenous(){
		
		if(isset($_REQUEST['submit'])) 
		{

			$item        = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$remarks     = xss_clean($this->input->post('remarks'));
			$empname     = xss_clean($this->input->post('empname'));
			$empdesg     = xss_clean($this->input->post('empdesg'));
			
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');
			

			if($this->form_validation->run() === false) 
			{
				
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			
				$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
				
				$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
				
				   $data['insertData'] = array(
						'item' 		    => xss_clean(strip_tags($this->input->post('item'))),
						'quantity'		=> xss_clean(strip_tags($this->input->post('quantity'))),
						'remarks' 		=> xss_clean(strip_tags($this->input->post('remarks')))
					);
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary',$roledata);
					$this->load->view('admin/itstationary_management/requisition/addmiscallenous',$data);
					$this->load->view('admin/footer');
		

			} else
				{
				
					date_default_timezone_set('Asia/Calcutta'); 
					
					 $created_date =  date("Y-m-d H:i:s"); 

					 $pst = date('Y');

	                 $pt = date('Y', strtotime('+1 year'));

	                 $fy = $pst.'-'.$pt;

					$user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						 
					$insert_master = array(
							'user_id' 	            => $this->session->userdata('user_id'),
							'emp_id' 	            => $user_detail->employee_id,
							'req_date' 	            => $created_date,
							'cancel_date' 	        => NULL,
							'cancel_remark' 	    => NULL,
							'status' 	            => 'Pending',
							'delete_status' 	    => '0',
							'service_type'          => '1',
							'is_miscallenous'       => '1',
							'issue_to'              => NULL,
							'issue_remarks'         => NULL,
							'issue_date'            => $created_date,
							'financial_year'        => $fy,
							'modified_by' 	        => $this->session->userdata('user_id'),
							'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
							'created_date' 	        => $created_date,
							'updated_date'   	    => $created_date
						);
				$reqid = $this->Base_model->insert_one_row('osr_requisition_master', $insert_master);	 
				
				   if($reqid){
					   
						$i=0;

                        foreach($item as $items){

						  $insertid = $this->Base_model->insert_one_row('osr_requisition_item', 
						  array(

						  	    'req_id'                => $reqid,
								'item_id'               => $items,
								'req_qty'               => $quantity[$i],
								'req_remark' 	        => $remarks[$i],
								'employee_name' 	    => $empname[$i],
								'employee_desg' 	    => $empdesg[$i],
								'approved_qty'          => '0',
								'approval_date'         => $created_date,
								'receipt_date'          => $created_date,
								'status' 	            => '1',
								'delete_status' 	    => '0',
								'service_type'          => '1',
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							) );
								
								$i++;
						   
						}				

						if($insertid)
						{
							$msg = "Request successfully.";
							$this->session->set_flashdata('flashSuccess_request',$msg); 

						$insert_notdata = array(

						'notification_message' 	=> 'New Miscallaneous Request has placed by '.$user_detail->display_name.'',
						'read_status' 	        => '0',
						'delete_status' 	    => '0',
						'service_type' 	        => '2',
						'created_date' 	        => $created_date,
						'updated_date'   	    => $created_date

					   );

				         $notifiid = $this->Base_model->insert_one_row('tbl_notification', $insert_notdata);	
							
							redirect('itonlinestationary/Requisition');
						}

						else
						{
							$msg = "Fail Request";
							$this->session->set_flashdata('flashError_request', $msg);
							
							
							$data['insertData'] = array(
								'item' 		=> xss_clean(strip_tags($this->input->post('item'))),
								'quantity'		  => xss_clean(strip_tags($this->input->post('quantity'))),
								'remarks' 				=> xss_clean(strip_tags($this->input->post('remarks')))
							);
							
							$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			
						$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						
						$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
						
						$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary',$roledata);
						$this->load->view('admin/itstationary_management/requisition/addmiscallenous',$data);
						$this->load->view('admin/footer');
						
					  }
					  
				   } else {
					   
					   $msg = "Fail Request to add";
					   $this->session->set_flashdata('flashError_request', $msg);
					   
					   $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			
						$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						
						$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
						
						$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary',$roledata);
						$this->load->view('admin/itstationary_management/requisition/addmiscallenous',$data);
						$this->load->view('admin/footer');
					   
				   }				
				
				}

		}

		else
		{
			
		
	        $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			
			$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
			
			$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
			
			$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-itstationary');
			$this->load->view('admin/itstationary_management/requisition/addmiscallenous',$data);
			$this->load->view('admin/footer');

		}

	}

	
	
	public function editrequest(){


		$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if(in_array("11", $user_roles))
			{
			  	$roledata['permission_role'] = $user_roles;
			}
				
		
		$uri = $this->uri->segment('4'); 
		
		if(isset($_REQUEST['submit'])) 
		{
			
			
			$item      = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$remarks     = xss_clean($this->input->post('remarks'));

			$dir           = xss_clean($this->input->post('dir'));
			$dydir         = xss_clean($this->input->post('dydir'));
			$ad            = xss_clean($this->input->post('ad'));
			$dman          = xss_clean($this->input->post('dman'));
			$so            = xss_clean($this->input->post('so'));
			$asstt         = xss_clean($this->input->post('asstt'));
			$udcldc        = xss_clean($this->input->post('udcldc'));
			$pasteno       = xss_clean($this->input->post('pasteno'));
			$others        = xss_clean($this->input->post('others'));

		//	echo '<pre>'; print_r($_REQUEST); exit;
			
			
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');
			

			if($this->form_validation->run() === false) 
			{
				
			   $uri = $this->uri->segment('4'); 
				
				$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>'1','delete_status'=>'0','service_type'=>'2'));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));

				$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
				
				$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
			
				$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary',$roledata);
					$this->load->view('admin/itstationary_management/requisition/editrequest',$data);
					$this->load->view('admin/footer');

			} else
				{
				
				$uri = $this->uri->segment('4'); 
				
				date_default_timezone_set('Asia/Calcutta'); 
					
				$created_date =  date("Y-m-d H:i:s"); 

				$pst = date('Y');

	            $pt = date('Y', strtotime('+1 year'));

	            $fy = $pst.'-'.$pt;
				
				$req_detail = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' => $uri));

			     $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						 
				$update_master = array(
									'user_id' 	            => $this->session->userdata('user_id'),
									'emp_id' 	            => $user_detail->employee_id,
									'req_date' 	            => $created_date,
									'cancel_date' 	        => NULL,
									'cancel_remark' 	    => NULL,
									'status' 	            => $req_detail->status,
									'delete_status' 	    => '0',
									'service_type'          => '1',
									'issue_to'              => NULL,
									'issue_remarks'         => NULL,
									'issue_date'            => $created_date,
									'financial_year'        => $fy,
									'dir_no'                => $dir,
									'dydir_no'              => $dydir,
									'adead_no'              => $ad,
									'dman_no'               => $dman,
									'so_no'                 => $so,
									'asstt_no'              => $asstt,
									'udcldc_no'             => $udcldc,
									'pa_no'                 => $pasteno,
									'others'                => $others,
									'modified_by' 	        => $this->session->userdata('user_id'),
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								);
					
                 $reqid = $this->Base_model->update_record_by_id('osr_requisition_master', $update_master, array('req_id'=> $uri));	

                $this->Base_model->delete_record_by_id('osr_requisition_item',array('req_id'=>$uri));
				
				   if($reqid){
					   
						$i=0;
						
                        foreach($item as $items){
						   
						   $insertid = $this->Base_model->insert_one_row('osr_requisition_item', 
						      array(
						      	    'req_id'                => $uri,
							        'item_id'               => $items,
							        'req_qty'               => $quantity[$i],
									'req_remark' 	        => $remarks[$i],
									'approved_qty'          => NULL,
									'approval_date'         => $created_date,
									'receipt_date'          => $created_date,
									'status' 	            => '1',
									'delete_status' 	    => '0',
									'service_type'          => '1',
									'modified_by' 	        => $this->session->userdata('user_id'),
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								));
								
								$i++;
						   
						}	
						
						if($insertid)
						{
							$msg = "Request has edited successfully.";
							$this->session->set_flashdata('flashSuccess_request',$msg);
							
						    $data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'user_id'=>$this->session->userdata('user_id'),'service_type'=>1));
							
							redirect('itonlinestationary/Requisition',$data);
						}

						else
						{

						$msg = "Fail to approve request";
						$this->session->set_flashdata('flashError_request', $msg);
							
						$uri = $this->uri->segment('4'); 
				
						$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
							
						$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
							
						$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));

						$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
							
						$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
						
						$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary',$roledata);
						$this->load->view('admin/itstationary_management/requisition/editrequest',$data);
						$this->load->view('admin/footer');
						
					  }
					  
				   } else {
					   
					$msg = "Fail to approve request";
					$this->session->set_flashdata('flashError_request', $msg);
						
					$uri = $this->uri->segment('4'); 
				
					$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
					
					$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
					
					$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));

					$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
					
					$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
				
					$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
				
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary',$roledata);
					$this->load->view('admin/itstationary_management/requisition/editrequest',$data);
					$this->load->view('admin/footer');
					   
				   }				
				
				}

		} 
		
		  else {
		
				$uri = $this->uri->segment('4'); 
				
				$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));

				$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
				
				$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
			
				$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-itstationary',$roledata);
				$this->load->view('admin/itstationary_management/requisition/editrequest',$data);
				$this->load->view('admin/footer');
		 
		    }
	 
	}



	public function editsuprequest(){


		$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if(in_array("11", $user_roles))
			{
			  	$roledata['permission_role'] = $user_roles;
			}
				
		
		$uri = $this->uri->segment('4'); 
		
		if(isset($_REQUEST['submit'])) 
		{
			
			
			$item      = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$remarks     = xss_clean($this->input->post('remarks'));

			$dir           = xss_clean($this->input->post('dir'));
			$dydir         = xss_clean($this->input->post('dydir'));
			$ad            = xss_clean($this->input->post('ad'));
			$dman          = xss_clean($this->input->post('dman'));
			$so            = xss_clean($this->input->post('so'));
			$asstt         = xss_clean($this->input->post('asstt'));
			$udcldc        = xss_clean($this->input->post('udcldc'));
			$pasteno       = xss_clean($this->input->post('pasteno'));
			$others        = xss_clean($this->input->post('others'));

		//	echo '<pre>'; print_r($_REQUEST); exit;
			
			
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');
			

			if($this->form_validation->run() === false) 
			{
				
			   $uri = $this->uri->segment('4'); 
				
				$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>'1','delete_status'=>'0','service_type'=>'2'));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));

				$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
				
				$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
			
				$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary',$roledata);
					$this->load->view('admin/itstationary_management/requisition/editsuprequest',$data);
					$this->load->view('admin/footer');

			} else
				{
				
				$uri = $this->uri->segment('4'); 
				
				date_default_timezone_set('Asia/Calcutta'); 
					
				$created_date =  date("Y-m-d H:i:s"); 

				$pst = date('Y');

	            $pt = date('Y', strtotime('+1 year'));

	            $fy = $pst.'-'.$pt;
				
				$req_detail = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' => $uri));

				 $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						 
				$update_master = array(
									'user_id' 	            => $this->session->userdata('user_id'),
									'emp_id' 	            => $user_detail->employee_id,
									'req_date' 	            => $created_date,
									'cancel_date' 	        => NULL,
									'cancel_remark' 	    => NULL,
									'status' 	            => $req_detail->status,
									'delete_status' 	    => '0',
									'service_type'          => '1',
									'is_supplementary'      => '1',
									'issue_to'              => NULL,
									'issue_remarks'         => NULL,
									'issue_date'            => $created_date,
									'financial_year'        => $fy,
									'dir_no'                => $dir,
									'dydir_no'              => $dydir,
									'adead_no'              => $ad,
									'dman_no'               => $dman,
									'so_no'                 => $so,
									'asstt_no'              => $asstt,
									'udcldc_no'             => $udcldc,
									'pa_no'                 => $pasteno,
									'others'                => $others,
									'modified_by' 	        => $this->session->userdata('user_id'),
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								);
					
                 $reqid = $this->Base_model->update_record_by_id('osr_requisition_master', $update_master, array('req_id'=> $uri));	

                $this->Base_model->delete_record_by_id('osr_requisition_item',array('req_id'=>$uri));
				
				   if($reqid){
					   
						$i=0;
						
                        foreach($item as $items){
						   
						   $insertid = $this->Base_model->insert_one_row('osr_requisition_item', 
						      array(
						      	    'req_id'                => $uri,
							        'item_id'               => $items,
							        'req_qty'               => $quantity[$i],
									'req_remark' 	        => $remarks[$i],
									'approved_qty'          => NULL,
									'approval_date'         => $created_date,
									'receipt_date'          => $created_date,
									'status' 	            => '1',
									'delete_status' 	    => '0',
									'service_type'          => '1',
									'modified_by' 	        => $this->session->userdata('user_id'),
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								));
								
								$i++;
						   
						}	
						
						if($insertid)
						{
							$msg = "Request has edited successfully.";
							$this->session->set_flashdata('flashSuccess_request',$msg);
							
						    $data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'user_id'=>$this->session->userdata('user_id'),'service_type'=>1));
							
							redirect('itonlinestationary/Requisition',$data);
						}

						else
						{

						$msg = "Fail to approve request";
						$this->session->set_flashdata('flashError_request', $msg);
							
						$uri = $this->uri->segment('4'); 
				
						$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
							
						$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
							
						$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));

						$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
							
						$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
						
						$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary',$roledata);
						$this->load->view('admin/itstationary_management/requisition/editsuprequest',$data);
						$this->load->view('admin/footer');
						
					  }
					  
				   } else {
					   
					$msg = "Fail to approve request";
					$this->session->set_flashdata('flashError_request', $msg);
						
					$uri = $this->uri->segment('4'); 
				
					$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
					
					$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
					
					$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));

					$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
					
					$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
				
					$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
				
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary',$roledata);
					$this->load->view('admin/itstationary_management/requisition/editsuprequest',$data);
					$this->load->view('admin/footer');
					   
				   }				
				
				}

		} 
		
		  else {
		
				$uri = $this->uri->segment('4'); 
				
				$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));

				$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
				
				$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
			
				$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-itstationary',$roledata);
				$this->load->view('admin/itstationary_management/requisition/editsuprequest',$data);
				$this->load->view('admin/footer');
		 
		    }
	 
	}


	public function editmiscallenous(){


		$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if(in_array("11", $user_roles))
			{
			  	$roledata['permission_role'] = $user_roles;
			}
				
		
		$uri = $this->uri->segment('4'); 
		
		if(isset($_REQUEST['submit'])) 
		{
			
			
			$item      = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$remarks     = xss_clean($this->input->post('remarks'));
			$empname     = xss_clean($this->input->post('empname'));
			$empdesg     = xss_clean($this->input->post('empdesg'));

		//	echo '<pre>'; print_r($_REQUEST); exit;
			
			
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');
			

			if($this->form_validation->run() === false) 
			{
				
			   $uri = $this->uri->segment('4'); 
				
				$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>'1','delete_status'=>'0','service_type'=>'2'));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));

				$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
				
				$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
			
				$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary',$roledata);
					$this->load->view('admin/itstationary_management/requisition/editmiscallenous',$data);
					$this->load->view('admin/footer');

			} else
				{
				
				$uri = $this->uri->segment('4'); 
				
				date_default_timezone_set('Asia/Calcutta'); 
					
				$created_date =  date("Y-m-d H:i:s"); 

				$pst = date('Y');

	            $pt = date('Y', strtotime('+1 year'));

	            $fy = $pst.'-'.$pt;
				
				$req_detail = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' => $uri));

				 $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						 
				$update_master = array(
									'user_id' 	            => $this->session->userdata('user_id'),
									'emp_id' 	            => $user_detail->employee_id,
									'req_date' 	            => $created_date,
									'cancel_date' 	        => NULL,
									'cancel_remark' 	    => NULL,
									'status' 	            => $req_detail->status,
									'delete_status' 	    => '0',
									'service_type'          => '1',
									'is_miscallenous'       => '1',
									'issue_to'              => NULL,
									'issue_remarks'         => NULL,
									'issue_date'            => $created_date,
									'financial_year'        => $fy,
									'modified_by' 	        => $this->session->userdata('user_id'),
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								);
					
                 $reqid = $this->Base_model->update_record_by_id('osr_requisition_master', $update_master, array('req_id'=> $uri));	

                $this->Base_model->delete_record_by_id('osr_requisition_item',array('req_id'=>$uri));
				
				   if($reqid){
					   
						$i=0;
						
                        foreach($item as $items){
						   
						   $insertid = $this->Base_model->insert_one_row('osr_requisition_item', 
						      array(
						      	    'req_id'                => $uri,
							        'item_id'               => $items,
							        'req_qty'               => $quantity[$i],
									'req_remark' 	        => $remarks[$i],
									'employee_name' 	    => $empname[$i],
								    'employee_desg' 	    => $empdesg[$i],
									'approved_qty'          => NULL,
									'approval_date'         => $created_date,
									'receipt_date'          => $created_date,
									'status' 	            => '1',
									'delete_status' 	    => '0',
									'service_type'          => '1',
									'modified_by' 	        => $this->session->userdata('user_id'),
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								));
								
								$i++;
						   
						}	
						
						if($insertid)
						{
							$msg = "Request has edited successfully.";
							$this->session->set_flashdata('flashSuccess_request',$msg);
							
						    $data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'user_id'=>$this->session->userdata('user_id'),'service_type'=>1));
							
							redirect('itonlinestationary/Requisition',$data);
						}

						else
						{

						$msg = "Fail to approve request";
						$this->session->set_flashdata('flashError_request', $msg);
							
						$uri = $this->uri->segment('4'); 
				
						$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
							
						$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
							
						$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));

						$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
							
						$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
						
						$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary',$roledata);
						$this->load->view('admin/itstationary_management/requisition/editmiscallenous',$data);
						$this->load->view('admin/footer');
						
					  }
					  
				   } else {
					   
					$msg = "Fail to approve request";
					$this->session->set_flashdata('flashError_request', $msg);
						
					$uri = $this->uri->segment('4'); 
				
					$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
					
					$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
					
					$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));

					$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
					
					$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
				
					$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
				
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary',$roledata);
					$this->load->view('admin/itstationary_management/requisition/editmiscallenous',$data);
					$this->load->view('admin/footer');
					   
				   }				
				
				}

		} 
		
		  else {
		
				$uri = $this->uri->segment('4'); 
				
				$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));

				$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
				
				$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
			
				$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-itstationary',$roledata);
				$this->load->view('admin/itstationary_management/requisition/editmiscallenous',$data);
				$this->load->view('admin/footer');
		 
		    }
	 
	}
	
	
	public function viewrequest()
	{

		$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("11", $user_roles))
			  {
			  	$roledata['permission_role'] = $user_roles;
			  }
				
		
		$uri = $this->uri->segment('4'); 
		
		$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
		
		$data['req_detail'] = $req_detail =$this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
		
		$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $req_detail->user_id));
		
		$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
		
		$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-itstationary',$roledata);
		$this->load->view('admin/itstationary_management/requisition/viewrequest',$data);
		$this->load->view('admin/footer');
	
	}
	
	
	  public function search_requisition()
	     {

	     	$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("11", $user_roles))
			  {
			  	$roledata['permission_role'] = $user_roles;
			  }
				


			if(isset($_REQUEST['submit'])){
					$status = xss_clean(strip_tags($this->input->post('status')));
					$data['all_request'] = $this->Stationary_model->search_requisition($status);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary',$roledata);
					$this->load->view('admin/itstationary_management/requisition/requestlist',$data);
					$this->load->view('admin/footer');
			}
		
	    }
		
		
	public function withdraw_request(){
		
		    date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s"); 
			$request_id = xss_clean(strip_tags($this->input->post('cancel_req')));
			$cancel_reason = xss_clean(strip_tags($this->input->post('reason')));
			
			
             $data['req_date'] = $req_data =  $this->Base_model->get_record_by_id('osr_requisition_master', array('req_id' => $request_id));			
			
			$update_data = array(
					'user_id' 	        => $req_data->user_id,
					'emp_id' 	        => $req_data->emp_id,
					'modified_by' 	    => $this->session->userdata('user_id'),
					'status' 	        => 'Withdrawn',
					'delete_status'     => 0,
					'service_type'      => 2,
					'req_date' 	        => $req_data->req_date,
					'cancel_date' 	    => $created_date,
					'cancel_remark' 	=> $cancel_reason,
					'created_date' 	    => $created_date,
					'updated_date'   	=> $created_date,
					'client_ip' 	=> $_SERVER['REMOTE_ADDR']
				);
							
		$updateid = $this->Base_model->update_record_by_id('osr_requisition_master', $update_data, array('req_id'=> $request_id));
			
			$msg = "Request has withdrawn successfully.";
			$this->session->set_flashdata('flashSuccess_request',$msg);
			
			redirect('itonlinestationary/requisition');
		
	}
	

	public function requistion_data()
	{
		$uri = xss_clean(strip_tags($this->input->post('req_id')));
		$data['all_request'] = $all_request = $this->Base_model->requsition_data($uri);

		$masterdata = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
		

		$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
		
		$data['wing'] = $wing=$this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
		
		$data['section'] = $section= $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));

		if($masterdata->req_date != '0000-00-00 00:00:00'){

			$req_date = date('d, F Y',strtotime($masterdata->req_date));

		} else {

			$req_date = 'N/A';

		}

		if($masterdata->approved_date != '0000-00-00 00:00:00'){

			$approved_date = date('d, F Y',strtotime($masterdata->approved_date));

		} else {

			$approved_date = 'N/A';

		}

		if($masterdata->issue_date != '0000-00-00 00:00:00'){

			$issue_date = date('d, F Y',strtotime($masterdata->issue_date));

		} else {

			$issue_date = 'N/A';

		}


		$json_data = array(

			'user_name'     => $user_detail->user_name,
			'designation'   => $user_detail->designation,
			'wing_name'     => $wing->wing_name,
			'section_name'  => $section->section_name,
			'req_date'      => $req_date,
			'approved_date' => $approved_date,
			'issued_date'   => $issue_date,
			'dir_no'        => $masterdata->dir_no,
			'dydir_no'      => $masterdata->dydir_no,
			'adead_no'      => $masterdata->adead_no,
			'dman_no'       => $masterdata->dman_no,
			'so_no'         => $masterdata->so_no,
			'asstt_no'      => $masterdata->asstt_no,
			'udcldc_no'     => $masterdata->udcldc_no,
			'pa_no'         => $masterdata->pa_no,
			'others'        => $masterdata->others,
			'all_request'   => $all_request
		);

		$req_datas =  json_encode($json_data);
		echo  $req_datas;
	}
	
	
}
