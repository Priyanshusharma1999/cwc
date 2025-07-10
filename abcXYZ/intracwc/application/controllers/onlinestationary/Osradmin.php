<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Osradmin extends CI_Controller {

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
	  
		   if (in_array("12", $user_roles))
			  {
			  	$roledata['permission_osr'] = $user_roles;
			  }
				
   
	}



	public function index()
	{
		
		$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'service_type'=>2));
		

         	$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("12", $user_roles))
			  {
			  	$roledata['permission_osr'] = $user_roles;
			  }
				

		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-stationary',$roledata);
		$this->load->view('admin/stationary_management/osradmin/physicalissuelist',$data);
		$this->load->view('admin/footer');
	
	}
	
	
	public function proxylist()
	{

		$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("12", $user_roles))
			  {
			  	$roledata['permission_osr'] = $user_roles;
			  }

	    $data['all_request'] = $this->Stationary_model->get_proxylist();
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-stationary',$roledata);
		$this->load->view('admin/stationary_management/osradmin/proxyissuelist',$data);
		$this->load->view('admin/footer');
	
	}
	
	public function addproxy(){

		$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("12", $user_roles))
			  {
			  	$roledata['permission_osr'] = $user_roles;
			  }
				
		
		if(isset($_REQUEST['submit'])) 
		{
			
			//echo '<pre>'; print_r($_REQUEST); exit;
			
			$user_id     = xss_clean($this->input->post('u_id'));
			$item        = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$remarks     = xss_clean($this->input->post('remarks'));
			
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');
			

			if($this->form_validation->run() === false) 
			{
				
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>2));
				
				
				   $data['insertData'] = array(
						'item' 		=> xss_clean(strip_tags($this->input->post('item'))),
						'quantity'		  => xss_clean(strip_tags($this->input->post('quantity'))),
						'remarks' 				=> xss_clean(strip_tags($this->input->post('remarks')))
					);
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary',$roledata);
					$this->load->view('admin/stationary_management/osradmin/addproxy',$data);
					$this->load->view('admin/footer');
		

			} else
				{
				
					date_default_timezone_set('Asia/Calcutta'); 
					
					 $created_date =  date("Y-m-d H:i:s"); 
						 
					$insert_master = array(
									'user_id' 	            => $user_id,
									'emp_id' 	            => $user_id,
									'req_date' 	            => $created_date,
									'cancel_date' 	        => NULL,
									'cancel_remark' 	    => NULL,
									'status' 	            => 'Pending',
									'delete_status' 	    => '0',
									'service_type'          => '2',
									'is_proxy'              => '1',
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
								'approved_qty'          => '0',
								'approval_date'         => $created_date,
								'receipt_date'          => $created_date,
								'status' 	            => '1',
								'delete_status' 	    => '0',
								'service_type'          => '2',
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							));
							
							$i++;
						   
						}				

						if($insertid)
						{
							$msg = "Request successfully.";
							$this->session->set_flashdata('flashSuccess_request',$msg);
							
							$data['all_request'] = $this->Stationary_model->get_proxylist();
							
							redirect('onlinestationary/osradmin/proxylist',$data);
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
							
						$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>2));
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-stationary',$roledata);
						$this->load->view('admin/stationary_management/osradmin/addproxy',$data);
						$this->load->view('admin/footer');
						
					  }
					  
				   } else {
					   
					   $msg = "Fail Request";
					   $this->session->set_flashdata('flashError_request', $msg);
					   
					 	$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>2));
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-stationary',$roledata);
						$this->load->view('admin/stationary_management/osradmin/addproxy',$data);
						$this->load->view('admin/footer');
					   
				   }				
				
				}

		}

		else
		{
			
	        $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>2));
			
			 $data['all_users'] = $this->Base_model->get_all_record_by_condition('users',array('user_id !=' => $this->session->userdata('user_id'), 'status'=>1,'delete_status'=>1));
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-stationary',$roledata);
			$this->load->view('admin/stationary_management/osradmin/addproxy',$data);
			$this->load->view('admin/footer');

		}
	}
	
	
	public function search_proxy()
	     {

	     	$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("12", $user_roles))
			  {
			  	$roledata['permission_osr'] = $user_roles;
			  }
				


			if(isset($_REQUEST['submit'])){
					$status = xss_clean(strip_tags($this->input->post('status')));
					$data['all_request'] = $this->Stationary_model->search_proxy($status);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary',$roledata);
					$this->load->view('admin/stationary_management/osradmin/proxyissuelist',$data);
					$this->load->view('admin/footer');
			}
		
	    }
		
		public function getuser_detail()
	     {
			
		  $id = xss_clean(strip_tags($this->input->post('user_id')));
			
		  $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' =>$id));
		   
		  $wing = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
			
		  $section = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
		  
		  $user_detail = array(
		    'user_id'=>$user_detail->user_id,
			'user_name'=>$user_detail->user_name,
			'designation'=>$user_detail->designation,
			'wing_name'=> $wing->wing_name,
			'section_name' => $section->section_name
		  );
			
		   print json_encode($user_detail);
		   
	    }
		
		
    public function issueto(){

   // 	echo 'aaaaaaaaaaaaaaaaaaaaaa'; exit;
			
			$uri = $this->uri->segment('4'); 
			
			if(isset($_REQUEST['submit'])) 
		     {

		    // 	echo '<pre>'; print_r($_REQUEST); exit;
			   
				$item             = xss_clean($this->input->post('item'));
				$quantity         = xss_clean($this->input->post('quantity'));
				$remarks          = xss_clean($this->input->post('remarks'));
				$approveqty       = xss_clean($this->input->post('approveqty'));
				$issueqty       = xss_clean($this->input->post('issueqty'));
				$issueto          = xss_clean($this->input->post('issueto'));
				$issueremarks     = xss_clean($this->input->post('issueremarks'));
				$empname     = xss_clean($this->input->post('empname'));
		    	$empdesg     = xss_clean($this->input->post('empdesg'));
				
				$this->form_validation->set_rules('item[]','item','trim|required');
				$this->form_validation->set_rules('quantity[]','quantity','trim|required');
				//$this->form_validation->set_rules('approveqty[]','approve quantity','trim|required');
                $this->form_validation->set_rules('issueto','name','trim|required');
				
		     if($this->form_validation->run() === false) 
		      {

		      	//echo 'dfdfgfdgd';exit;
				
				$uri = $this->uri->segment('4'); 
				
				$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' =>$uri));
				
				$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('user_id' => $data['req_detail']->user_id));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary',$roledata);
					$this->load->view('admin/stationary_management/osradmin/issue',$data);
					$this->load->view('admin/footer');

				} else
					{

				 // $template = '<table><thead><tr><th>Item Name</th><th>Item Quantity</th><th>Requisition Quantity</th><th>Approved Quantity</th><th>Issued Quantity</th><tr></thead><tbody></tbody></table>'
					
					$uri = $this->uri->segment('4'); 
					
					date_default_timezone_set('Asia/Calcutta'); 
						
					$created_date =  date("Y-m-d H:i:s"); 
						
                    $req_master = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' => $uri));
					
					$update_master = array(
								'user_id' 	            => $req_master->user_id,
								'emp_id' 	            => $req_master->emp_id,
								'req_date' 	            => $created_date,
								'cancel_date' 	        => NULL,
								'cancel_remark' 	    => NULL,
								'status' 	            => 'Closed',
								'delete_status' 	    => '0',
								'service_type'          => '2',
								'issue_to'              => $issueto,
								'issue_remarks'         => $issueremarks,
								'issue_date'            => $created_date,
								'approved_by'           => $req_master->approved_by,
								'approved_date'         => $req_master->approved_date,
							    'issued_by'             => $this->session->userdata('user_id'),
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							);
					
                $reqid = $this->Base_model->update_record_by_id('osr_requisition_master', $update_master, array('req_id'=> $uri));		

                $this->Base_model->delete_record_by_id('osr_requisition_item',array('req_id'=> $uri));					
				
			 if($reqid){
					   
				$i=0;
                foreach($item as $items){
						  
					  $insertid = $this->Base_model->insert_one_row('osr_requisition_item', 
						  array(
						  	   'req_id'                 => $uri,
								'item_id'               => $items,
								'req_qty'               => $quantity[$i],
								'req_remark' 	        => $remarks[$i],
								'employee_name' 	    => empty($empname[$i])?NULL:$empname[$i],
								'employee_desg' 	    => empty($empdesg[$i])?NULL:$empdesg[$i],
								'approved_qty'          => $approveqty[$i],
								'approval_date'         => $created_date,
								'issued_qty'            => $issueqty[$i],
								'issued_date'           => $created_date,
								'receipt_date'          => $created_date,
								'status' 	            => '1',
								'delete_status' 	    => '0',
								'service_type'          => '2',
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
						));
						
                      $approved_stock = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$items));

                    //  $tr .= '<tr><td></td></tr>'			
						
				     $approved_stck = $approved_stock->approved_stock-$approveqty[$i];	
					 
					 $total_stck    = $approved_stock->quantity_stock-$issueqty[$i];

					 $issueddaily_stck   = $approved_stock->issued_qty+$issueqty[$i];
					 
					
						 $update_item = array(
						    'quantity_stock' 	       => $total_stck,
					        'approved_stock' 	       => $approved_stck,
					        'issueddaily_stock' 	   => $issueddaily_stck,
						    'modified_by' 	           => $this->session->userdata('user_id'),
							'client_ip' 	           => $_SERVER['REMOTE_ADDR'],
							'created_date' 	           => $created_date,
							'updated_date'   	       => $created_date,
							'inventory_decrease_date'  => $created_date
					   );	
				

					$finalid = $this->Base_model->update_record_by_id('osr_item_master', $update_item, array('item_id'=>$items));						
								
					$i++;
						   
			}				

		  if($finalid)
			{
					$msg = "Request has issued successfully.";
					$this->session->set_flashdata('flashSuccess_issue',$msg);
					
					$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'service_type'=>2));
					
					$data['check_requisition'] = $this->Stationary_model->check_requisition();

					$mail = $this->Base_model->get_record_by_id('users',array('user_id' => $req_master->user_id));

					$approver =  $this->Base_model->get_record_by_id('users',array('user_id' => $req_master->approved_by));

                   /* $this->load->library('email');
                    $config = array(
			            'protocol' => 'smtp',
			            'smtp_host' => '164.100.14.95',
			            'smtp_port' => '25'
			        );   
			        $this->email->initialize($config);
			        $this->email->from('support-intracwc@gov.in');
			        $this->email->to($mail->email);
                    $this->email->cc($approver->email);
                    $this->email->subject('Product Issue');
                    $this->email->message('Dear Sir, <br> Products has issued to '.$mail->display_name);
                    $this->email->send(); */

                    $config['charset'] = 'utf-8';
		            $config['mailtype'] = 'html';

			    	 $mesgtemplate = "Dear Sir, <br/> Products has been issued to ".$mail->display_name."<br/><br/> Thanks & Regards <br/> CWC New Delhi";

			       $this->load->library('email');
			       $this->email->initialize($config);
			       $this->email->from('support-intracwc@gov.in');
			       $this->email->to($approver->email);
			       $this->email->subject('Product Issue');
			       $this->email->message($mesgtemplate);
			       $this->email->send();
				
				 redirect('onlinestationary/osradmin',$data);
			}

			else
			 {

				$msg = "Fail to issued request";
				$this->session->set_flashdata('flashError_issue', $msg);
						
				$uri = $this->uri->segment('4'); 
			
				$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' =>$uri));
				
				$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('user_id' => $data['req_detail']->user_id));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));	
					
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-stationary');
				$this->load->view('admin/stationary_management/osradmin/issue',$data);
				$this->load->view('admin/footer');
				
			}
					  
		} else {
					   
			   $msg = "Fail to issued request";
			   $this->session->set_flashdata('flashError_issue', $msg);
				
				$uri = $this->uri->segment('4'); 
				
				$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' =>$uri));
				
				$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('user_id' => $data['req_detail']->user_id));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-stationary');
				$this->load->view('admin/stationary_management/osradmin/issue',$data);
				$this->load->view('admin/footer');
					   
			 }				
				
		   }

		 } else {
			
				$uri = $this->uri->segment('4'); 
			
				$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' => $uri));

				$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('user_id' => $data['req_detail']->user_id));
			
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
			
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-stationary');
				$this->load->view('admin/stationary_management/osradmin/issue',$data);
				$this->load->view('admin/footer');
			
		  }	

	  }
	

	public function editproxy(){


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
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$item        = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$remarks     = xss_clean($this->input->post('remarks'));
			
			
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');
			

			if($this->form_validation->run() === false) 
			{
				
			   $uri = $this->uri->segment('4'); 
				
				$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>2));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
				
				$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
			
				$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
					
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-stationary',$roledata);
				$this->load->view('admin/stationary_management/requestapprove/approverequest',$data);
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
						 
				$update_master = array(
									'user_id' 	            => $req_detail->user_id,
									'emp_id' 	            => $req_detail->emp_id,
									'req_date' 	            => $created_date,
									'cancel_date' 	        => NULL,
									'cancel_remark' 	    => NULL,
									'status' 	            => $req_detail->status,
									'delete_status' 	    => '0',
									'service_type'          => '2',
									'is_proxy'              => '1',
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
									'approved_qty'          => NULL,
									'approval_date'         => $created_date,
									'receipt_date'          => $created_date,
									'status' 	            => '1',
									'delete_status' 	    => '0',
									'service_type'          => '2',
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
							
						$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'user_id'=>$this->session->userdata('user_id'),'service_type'=>2));
							
							redirect('onlinestationary/requisition',$data);
						}

						else
						{
							$msg = "Fail to approve request";
							$this->session->set_flashdata('flashError_request', $msg);
							
						$uri = $this->uri->segment('4'); 
				
						$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
							
						$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>2));
							
						$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
							
						$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
						
						$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-stationary',$roledata);
						$this->load->view('admin/stationary_management/requisition/editrequest',$data);
						$this->load->view('admin/footer');
						
					  }
					  
				   } else {
					   
					   $msg = "Fail to approve request";
					   $this->session->set_flashdata('flashError_request', $msg);
						
					$uri = $this->uri->segment('4'); 
				
					$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
					
					$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>2));
					
					$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
					
					$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
				
					$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
				
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-stationary',$roledata);
						$this->load->view('admin/stationary_management/requisition/editrequest',$data);
						$this->load->view('admin/footer');
					   
				   }				
				
				}

		} 
		
		  else {
		
				$uri = $this->uri->segment('4'); 
				
				$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>2));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
				
				$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
			
				$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-stationary',$roledata);
				$this->load->view('admin/stationary_management/osradmin/editproxy',$data);
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
	  
		   if (in_array("12", $user_roles))
			  {
			  	$roledata['permission_osr'] = $user_roles;
			  }
				
		
		$uri = $this->uri->segment('4'); 
		
		$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
		
		$data['other_data'] = $userid= $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
		
	    $data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' =>$userid->user_id));
		
		$data['wing'] = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
		
		$data['section'] = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
						
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-stationary',$roledata);
		$this->load->view('admin/stationary_management/osradmin/viewrequest',$data);
		$this->load->view('admin/footer');
	
	}
	

	 public function search_request()
	{


		$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("12", $user_roles))
			  {
			  	$roledata['permission_approve'] = $user_roles;
			  }


		if(isset($_REQUEST['submit'])){
			
				$status = xss_clean(strip_tags($this->input->post('status')));
				
				$from_date = xss_clean(strip_tags($this->input->post('from_date')));

				$to_date = xss_clean(strip_tags($this->input->post('to_date')));

				$from_date = str_replace('/', '-', $from_date);
					
				$stdate = date('Y-m-d',  strtotime($from_date));
					
				$to_date = str_replace('/', '-', $to_date);
					
				$enddate = date('Y-m-d',  strtotime($to_date));
				
				$data['all_request'] = $this->Stationary_model->search_physicalissue($status,$stdate,$enddate );
				
				$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-stationary',$roledata);
				$this->load->view('admin/stationary_management/osradmin/physicalissuelist',$data);
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
			
		   $data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'service_type'=>1));
			
			
			redirect('onlinestationary/osradmin/proxylist',$data);
		
	}


    public function requistion_data()
	{
		$uri = xss_clean(strip_tags($this->input->post('req_id')));
		$data['all_request'] = $all_request = $this->Base_model->requsition_data($uri);
		

        $uid= $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' =>$uri));

		$data['user_detail']= $user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $uid->user_id));
		
		$data['wing'] = $wing=$this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
		
		$data['section'] = $section= $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));

		$json_data = array(

			'user_name' => $user_detail->user_name,
			'designation' => $user_detail->designation,
			'wing_name' => $wing->wing_name,
			'section_name' => $section->section_name,
			'all_request'=> $all_request
		);

		$req_datas =  json_encode($json_data);
		echo  $req_datas;
	}
	

	public function verifyotp(){

		 $req_id = $this->input->post('req_id');

		 $otp = $this->input->post('otp');

		 $approvedotp = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$req_id));

		 if($approvedotp->approved_otp == $otp){

		 	$this->Base_model->update_record_by_id('osr_requisition_master',array('otp_status'=>'1'),array('req_id'=>$req_id));

		 	$result =  json_encode(array('status'=>'Success'));

		     echo  $result;

		 } else {
               
             $result =  json_encode(array('status'=>'Fail'));

		     echo  $result;

		 }

	}


    
	
}
