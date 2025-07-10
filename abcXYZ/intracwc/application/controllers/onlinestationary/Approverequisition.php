<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Approverequisition extends CI_Controller {

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
	  
		   if (in_array("13", $user_roles))
			  {
			  	$roledata['permission_approve'] = $user_roles;
			  }
				
   
	}
	
	public function index()
	{
		
		$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'service_type'=>2));
		
		$data['check_requisition'] = $this->Stationary_model->check_requisition(); 

		$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("13", $user_roles))
			  {
			  	$roledata['permission_approve'] = $user_roles;
			  }
				
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-stationary',$roledata);
		$this->load->view('admin/stationary_management/requestapprove/requestlist',$data);
		$this->load->view('admin/footer');
	
	
	}
	
	
	
	public function approverequest()
	{

		$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("13", $user_roles))
			  {
			  	$roledata['permission_approve'] = $user_roles;
			  }
				
		
		
		$uri = $this->uri->segment('4'); 
		
		if(isset($_REQUEST['submit'])) 
		{

		//	echo '<pre>'; print_r($_REQUEST); exit;
			
			
			$item      = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$remarks     = xss_clean($this->input->post('remarks'));
			$approveqty     = xss_clean($this->input->post('approveqty'));
			$empname     = xss_clean($this->input->post('empname'));
			$empdesg     = xss_clean($this->input->post('empdesg'));
			
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');
			$this->form_validation->set_rules('approveqty[]','approve quantity','trim|required');

			if($this->form_validation->run() === false) 
			{
				
				$uri = $this->uri->segment('4'); 
				
				$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' =>$uri));
				
				$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
					
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-stationary',$roledata);
				$this->load->view('admin/stationary_management/requestapprove/approverequest',$data);
				$this->load->view('admin/footer');

			} else
				{
				$uri = $this->uri->segment('4'); 
				date_default_timezone_set('Asia/Calcutta'); 
					
				$created_date =  date("Y-m-d H:i:s"); 
				
				$req_master = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' => $uri));

				$otp = rand(1000,9999);
						 
				$update_master = array(
							'user_id' 	            => $req_master->user_id,
							'emp_id' 	            => $req_master->emp_id,
							'req_date' 	            => $req_master->req_date,
							'cancel_date' 	        => NULL,
							'cancel_remark' 	    => NULL,
							'status' 	            => 'Approved',
							'delete_status' 	    => '0',
							'service_type'          => '2',
							'approved_otp'          => $otp,
							'otp_status'            => '0',
							'issue_to'              => NULL,
							'issue_remarks'         => NULL,
							'approved_by'           => $this->session->userdata('user_id'),
							'approved_date'         => $created_date,
							'issued_by'             => NULL,
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
						  	    'req_id'            => $uri,
								'item_id'           => $items,
								'req_qty'           => $quantity[$i],
								'req_remark' 	    => $remarks[$i],
								'employee_name' 	=> empty($empname[$i])?NULL:$empname[$i],
								'employee_desg' 	=> empty($empdesg[$i])?NULL:$empdesg[$i],
								'approved_qty'      => $approveqty[$i],
								'approval_date'     => $created_date,
								'receipt_date'      => $created_date,
								'status' 	        => '1',
								'delete_status' 	=> '0',
								'service_type'      => '2',
								'modified_by' 	    => $this->session->userdata('user_id'),
								'client_ip' 	    => $_SERVER['REMOTE_ADDR'],
								'created_date' 	    => $created_date,
								'updated_date'   	=> $created_date
							));
						
				    $approved_stock = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$items));			
						
				     $total_appstock = $approved_stock->approved_stock+$approveqty[$i];	

				     $appdaily_stck = $approved_stock->approveddaily_stock+$approveqty[$i];
					 
						 $update_item = array(
					        'approved_stock' 	    => $total_appstock,
					        'approveddaily_stock' 	=> $appdaily_stck,
						    'modified_by' 	        => $this->session->userdata('user_id'),
							'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
							'created_date' 	        => $created_date,
							'updated_date'   	    => $created_date
					   );						
							
			          $finalid = $this->Base_model->update_record_by_id('osr_item_master', $update_item, array('item_id'=>$items));							
								
					  $i++;
						   
				}//ends foreach				

						if($finalid)
						{
							$msg = "Request approved successfully.";
							$this->session->set_flashdata('flashSuccess_approve',$msg);
							
							$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'service_type'=>2));
							
							$data['check_requisition'] = $this->Stationary_model->check_requisition();

							$mail = $this->Base_model->get_record_by_id('users',array('user_id' => $req_master->user_id)); 

							//$this->otpfunction($mail->contact_no,$otp);

							$this->load->library('email');
	                        $config = array(
					            'protocol' => 'smtp',
					            'smtp_host' => '164.100.14.95',
					            'smtp_port' => '25'
					        );   
					        
					       $this->email->initialize($config);

					       $mesgtemplate = 'Dear Sir, Your Requisition has been approved and OTP for issue product is: '.$otp.'<br> Thanks & Regards <br> CWC New Delhi';

					       $this->load->library('email');
					       $this->email->from('support-intracwc@gov.in');
					       $this->email->to($mail->email);
					       $this->email->subject('OTP for Issue Product');
	                       $this->email->message($mesgtemplate);
	                       $this->email->send();

	                    /*   $config['charset'] = 'utf-8';
		                   $config['mailtype'] = 'html';

				    	 $mesgtemplate = "Dear Sir, <br/> Your Requisition has been approved and OTP for issue product is ".$otp."<br/> Thanks & Regards <br/> CWC New Delhi";

					       $this->load->library('email');
					       $this->email->initialize($config);
					       $this->email->from('support-intracwc@gov.in');
					       $this->email->to($mail->email);
					       $this->email->subject('OTP for Issue Product');
					       $this->email->message($mesgtemplate);
					       $this->email->send();*/
							
							redirect('onlinestationary/approverequisition',$data);
						}

						else
						{
							$msg = "Fail to approve request";
							$this->session->set_flashdata('flashError_approve', $msg);
							
						$uri = $this->uri->segment('4'); 
				
						$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' =>$uri));
						
						$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
						
						$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));	
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-stationary',$roledata);
						$this->load->view('admin/stationary_management/requestapprove/approverequest',$data);
						$this->load->view('admin/footer');
						
					  }
					  
				   }// ends if 

				   else {
					   
					   $msg = "Fail to approve request";
					   $this->session->set_flashdata('flashError_approve', $msg);
						
						$uri = $this->uri->segment('4'); 
				
					$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' =>$uri));
					
					$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
					
					$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
					
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-stationary',$roledata);
						$this->load->view('admin/stationary_management/requestapprove/approverequest',$data);
						$this->load->view('admin/footer');
					   
				   }				
				
				}

		} 
		
		  else {
		
				$uri = $this->uri->segment('4'); 
				
				$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' =>$uri));
				
				$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('user_id' => $data['req_detail']->user_id));
				
				$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-stationary',$roledata);
				$this->load->view('admin/stationary_management/requestapprove/approverequest',$data);
				$this->load->view('admin/footer');
		 
		    }
	 }
	 
	 
	 public function viewrequest(){
		 
		 $user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("13", $user_roles))
			  {
			  	$roledata['permission_approve'] = $user_roles;
			  }
				
		
		 
			$uri = $this->uri->segment('4'); 
			
			$data['req_detail'] = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id' =>$uri));
			
			$userid= $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$uri));
			
			$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('user_id' => $userid->user_id));
			
			$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$uri));
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-stationary',$roledata);
			$this->load->view('admin/stationary_management/requestapprove/viewapproverequest',$data);
			$this->load->view('admin/footer');
		 
	 }
	
	
	
    public function search_request()
	{


		$user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("13", $user_roles))
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
				
				$data['all_request'] = $this->Stationary_model->search_request($status,$stdate,$enddate );
				
				$data['user_detail'] = $this->Base_model->get_record_by_id('users',array('user_id' => $this->session->userdata('user_id')));
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-stationary',$roledata);
				$this->load->view('admin/stationary_management/requestapprove/requestlist',$data);
				$this->load->view('admin/footer');
				
		}
		
    }
	
	

     public function otpfunction($mobile, $smsOtp){


	     $otpmessage= urlencode($smsOtp." is your OTP for issue product.");

         $url="http://45.114.143.11/api.php?username=getcaptain&password=965437&sender=MLNCTR&sendto=".$mobile."&message=".$otpmessage;

        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_exec($ch);
		curl_close($ch);

    }
	
}
