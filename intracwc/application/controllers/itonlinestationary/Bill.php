<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bill extends CI_Controller {
	
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
	  
		   if (in_array("10", $user_roles))
			  {
			  	$roledata['permission_item'] = $user_roles;
			  }
			
   
	}
	
	
	public function index()
	{
		
		$data['all_bill'] = $this->Base_model->get_all_record_by_condition('osr_bill_master',array('delete_status'=>0,'status'=>1,'service_type'=>1));

		$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
		
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-itstationary');
		$this->load->view('admin/itstationary_management/bill/billlist', $data);
		$this->load->view('admin/footer');
	
	}
	
	public function addbill(){
		
		if(isset($_REQUEST['submit'])) 
		{

			//print_r($_REQUEST); exit;
		
			$billdate        = xss_clean(strip_tags($this->input->post('billdate')));
			$billno          = xss_clean(strip_tags($this->input->post('billno')));
			$vendorname      = xss_clean(strip_tags($this->input->post('shopname')));
			$address         = xss_clean(strip_tags($this->input->post('address')));
			$contact         = xss_clean(strip_tags($this->input->post('contactno')));
			$orderno         = xss_clean(strip_tags($this->input->post('orderno')));
			$orderdate       = xss_clean(strip_tags($this->input->post('orderdate')));
			$sourcereciept   = xss_clean(strip_tags($this->input->post('sourcereciept')));
			$email           = xss_clean(strip_tags($this->input->post('email')));
			$total_amount    = xss_clean(strip_tags($this->input->post('totalamount')));
			$remark          = xss_clean(strip_tags($this->input->post('remark')));
			$billtype        = xss_clean(strip_tags($this->input->post('billtype')));
			
			$item        = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$amount      = xss_clean($this->input->post('amount'));
			$unit      = xss_clean($this->input->post('unit'));
			$rate      = xss_clean($this->input->post('rate'));
			$charges      = xss_clean($this->input->post('charges'));
			
			
			$this->form_validation->set_rules('billdate','billdate','trim|required');
			$this->form_validation->set_rules('billno','billno','trim|required');
			$this->form_validation->set_rules('contactno','contact no','trim|required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');
			$this->form_validation->set_rules('amount[]','amount','trim|required');

			if($this->form_validation->run() === false) 
			{
				
			
				   $data['insertData'] = array(
						'billdate' 		=> xss_clean(strip_tags($this->input->post('billdate'))),
						'billno'		  => xss_clean(strip_tags($this->input->post('billno'))),
						'shopname' 				=> xss_clean(strip_tags($this->input->post('shopname'))),
						'address' 		=> xss_clean(strip_tags($this->input->post('address'))),
						'contactno'		  => xss_clean(strip_tags($this->input->post('contactno'))),
						'email' 				=> xss_clean(strip_tags($this->input->post('email'))),
						'totalamount' 		=> xss_clean(strip_tags($this->input->post('totalamount'))),
						'remark'		  => xss_clean(strip_tags($this->input->post('remark')))
					);
					
					$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
					
				  $this->load->view('admin/header');
				  $this->load->view('admin/sidebar-itstationary');
				  $this->load->view('admin/itstationary_management/bill/entrybill',$data);
				  $this->load->view('admin/footer');
	

			} else{
				
				$checked = $this->Base_model->check_existent('osr_bill_master', array('bill_no'=> $billno, 'delete_status'=>0,'status'=>1));
					
					if($checked=='1')
					{
						$msg = "Bill no already exits, Please enter new one";
						$this->session->set_flashdata('flashError_bill', $msg);
						
					  $data['insertData'] = array(
						'billdate' 		=> xss_clean(strip_tags($this->input->post('billdate'))),
						'billno'		  => xss_clean(strip_tags($this->input->post('billno'))),
						'shopname' 				=> xss_clean(strip_tags($this->input->post('shopname'))),
						'address' 		=> xss_clean(strip_tags($this->input->post('address'))),
						'contactno'		  => xss_clean(strip_tags($this->input->post('contactno'))),
						'email' 				=> xss_clean(strip_tags($this->input->post('email'))),
						'totalamount' 		=> xss_clean(strip_tags($this->input->post('totalamount'))),
						'remark'		  => xss_clean(strip_tags($this->input->post('remark')))
					  );
					
					 $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
					
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary');
						$this->load->view('admin/itstationary_management/bill/entrybill',$data);
						$this->load->view('admin/footer');
						
					} else
					 {
					
						date_default_timezone_set('Asia/Calcutta'); 
						
						 $created_date =  date("Y-m-d H:i:s"); 

						 $pst = date('Y');
			             $pt = date('Y', strtotime('+1 year'));
			             $fy = $pst.'-'.$pt;

						 //echo $billno; exit;
							 
						$insert_master = array(
								'bill_no' 	            => $billno,
								'bill_date' 	        => $billdate,
								'vendor_name' 	        => $vendorname,
								'vendor_address' 	    => !empty($address)?$address:NULL,
								'vendor_email' 	        => !empty($email)?$email:NULL,
								'vendor_contact_no' 	=> $contact,
								'order_no' 	            => !empty($orderno)?$orderno:NULL,
								'bill_type' 	        => $billtype,
								'source_reciept' 	    => !empty($sourcereciept)?$sourcereciept:NULL,
								'grand_total' 	        => !empty($total_amount)?$total_amount:NULL,
								'entry_date' 	        => $created_date,
								'remark' 	            => !empty($remark)?$remark:NULL,
								'status' 	            => '1',
								'delete_status' 	    => '0',
								'service_type'          => '1',
								'financial_year'        => $fy,
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							);
					$bill_id = $this->Base_model->insert_one_row('osr_bill_master', $insert_master);	
					
				 if($bill_id){
						   
					$i=0;

					//print_r($item); exit;
							
				foreach($item as $items){

				//	echo $items.' '.$quantity[$i].' '.$unit[$i].' '.$rate[$i].' '.$charges[$i]; exit;
							   
						  $insertid = $this->Base_model->insert_one_row('osr_bill_item', 
						  array('bill_master_id'        => $bill_id,
								'item_id'               => $items,
								'quantity'              => $quantity[$i],
								'unit'                  => !empty($unit[$i])?$unit[$i]:NULL,
								'rate'                  => !empty($rate[$i])?$rate[$i]:NULL,
								'incidental_charges'    => !empty($charges[$i])?$charges[$i]:NULL,
								'amount' 	            => $amount[$i],
								'status' 	            => '1',
								'delete_status' 	    => '0',
								'service_type'          => '1',
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							));
							
				      $available_qty = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$items));			
						
				     $total_qty = $available_qty->quantity_stock+$quantity[$i];	

				     $adddaily_stock = $available_qty->adddaily_stock+$quantity[$i];		
						
                       $update_item = array(
					        'quantity_stock' 	    => $total_qty,
					        'adddaily_stock' 	    => $adddaily_stock,
						    'modified_by' 	        => $this->session->userdata('user_id'),
							'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
							'inventory_increase_date' => $created_date,
							'updated_date'   	    => $created_date,
							'inventory_increase_date' => $created_date
					   );						
							
					$this->Base_model->update_record_by_id('osr_item_master', $update_item, array('item_id'=>$items));
						
					$i++;
						   
				}				

							if($insertid)
							{
								$msg = "Bill entry has done successfully.";
								$this->session->set_flashdata('flashSuccess_bill',$msg);
								
								$data['all_bill'] = $this->Base_model->get_all_record_by_condition('osr_bill_master',array('delete_status'=>0,'status'=>1,'service_type'=>1));
								
								redirect('itonlinestationary/bill',$data);
							}

							else
							{
								
							 $msg = "Fail to add item";
							 $this->session->set_flashdata('flashError_bill', $msg);
								
						 $data['insertData'] = array(
							'billdate' 		=> xss_clean(strip_tags($this->input->post('billdate'))),
							'billno'		  => xss_clean(strip_tags($this->input->post('billno'))),
							'shopname' 				=> xss_clean(strip_tags($this->input->post('shopname'))),
							'address' 		=> xss_clean(strip_tags($this->input->post('address'))),
							'contactno'		  => xss_clean(strip_tags($this->input->post('contactno'))),
							'email' 				=> xss_clean(strip_tags($this->input->post('email'))),
							'totalamount' 		=> xss_clean(strip_tags($this->input->post('totalamount'))),
							'remark'		  => xss_clean(strip_tags($this->input->post('remark')))
						 );
							 
							$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
							
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar-itstationary');
							$this->load->view('admin/itstationary_management/bill/entrybill',$data);
							$this->load->view('admin/footer');
							
						  }
						  
					   } else {
						   
						   $msg = "Fail to bill entry";
						   $this->session->set_flashdata('flashError_bill', $msg);
							
								
						 $data['insertData'] = array(
							'billdate' 		=> xss_clean(strip_tags($this->input->post('billdate'))),
							'billno'		  => xss_clean(strip_tags($this->input->post('billno'))),
							'shopname' 				=> xss_clean(strip_tags($this->input->post('shopname'))),
							'address' 		=> xss_clean(strip_tags($this->input->post('address'))),
							'contactno'		  => xss_clean(strip_tags($this->input->post('contactno'))),
							'email' 				=> xss_clean(strip_tags($this->input->post('email'))),
							'totalamount' 		=> xss_clean(strip_tags($this->input->post('totalamount'))),
							'remark'		  => xss_clean(strip_tags($this->input->post('remark')))
						);
							
							 $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
							
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar-itstationary');
							$this->load->view('admin/itstationary_management/bill/entrybill',$data);
							$this->load->view('admin/footer');
						   
					   }				
					
					 } 
			    }
			

		} else {
		
		   $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
		    $this->load->view('admin/header');
			$this->load->view('admin/sidebar-itstationary');
			$this->load->view('admin/itstationary_management/bill/entrybill',$data);
			$this->load->view('admin/footer');
			
		}
	
	}
	

	public function addoldbill(){
		
		if(isset($_REQUEST['submit'])) 
		{

			date_default_timezone_set('Asia/Calcutta');
			$created_date =  date("Y-m-d H:i:s");
			
			$billtype    = xss_clean(strip_tags($this->input->post('billtype')));
			$item        = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');

			if($this->form_validation->run() === false) 
			{
			
			   $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
					
				  $this->load->view('admin/header');
				  $this->load->view('admin/sidebar-stationary');
				  $this->load->view('admin/itstationary_management/bill/entrybill',$data);
				  $this->load->view('admin/footer');

			} else{
						 
				 $pst = date('Y');
	             $pt = date('Y', strtotime('+1 year'));
	             $fy = $pst.'-'.$pt;
					 
				$insert_master = array(
						'bill_date' 	        => $created_date,
						'bill_type' 	        => $billtype,
						'status' 	            => '1',
						'delete_status' 	    => '0',
						'service_type'          => '1',
						'financial_year'        => $fy,
						'modified_by' 	        => $this->session->userdata('user_id'),
						'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
						'created_date' 	        => $created_date,
						'updated_date'   	    => $created_date
					);

				$bill_id = $this->Base_model->insert_one_row('osr_bill_master', $insert_master);
					
				if($bill_id){
						   
					$i=0;
							
				foreach($item as $items){
							   
						  $insertid = $this->Base_model->insert_one_row('osr_bill_item', 
						  array('bill_master_id'        => $bill_id,
								'item_id'               => $items,
								'quantity'              => $quantity[$i],
								'status' 	            => '1',
								'delete_status' 	    => '0',
								'service_type'          => '1',
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							));
							
				      $available_qty = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$items));			
						
				     $total_qty = $available_qty->quantity_stock+$quantity[$i];	

				     $adddaily_stock = $available_qty->adddaily_stock+$quantity[$i];		
						
                       $update_item = array(
					        'quantity_stock' 	    => $total_qty,
					        'adddaily_stock' 	    => $adddaily_stock,
						    'modified_by' 	        => $this->session->userdata('user_id'),
							'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
							'inventory_increase_date' => $created_date,
							'updated_date'   	    => $created_date,
							'inventory_increase_date' => $created_date
					   );						
							
					$this->Base_model->update_record_by_id('osr_item_master', $update_item, array('item_id'=>$items));
						
					$i++;
						   
				  }				

					if($insertid)
					{
						$msg = "Bill entry has done successfully.";
						$this->session->set_flashdata('flashSuccess_bill',$msg);
						
						redirect('itonlinestationary/bill',$data);
					}

					else
					{
						
					 $msg = "Fail to add item";
					 $this->session->set_flashdata('flashError_bill', $msg);
					 
					$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary');
					$this->load->view('admin/itstationary_management/bill/entrybill',$data);
					$this->load->view('admin/footer');
					
				  }
						  
			   } else {
				   
				   $msg = "Fail to bill entry";
				   $this->session->set_flashdata('flashError_bill', $msg);
					
					$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary');
					$this->load->view('admin/itstationary_management/bill/entrybill',$data);
					$this->load->view('admin/footer');
				   
			   }
	        }

	  } else {
		
		   $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
		    $this->load->view('admin/header');
			$this->load->view('admin/sidebar-stationary');
			$this->load->view('admin/itstationary_management/bill/entrybill',$data);
			$this->load->view('admin/footer');
			
		}
	
	}
	
	
	public function editbill(){
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$uri = $this->uri->segment('4'); 

			$billdate        = xss_clean(strip_tags($this->input->post('billdate')));
			$billno          = xss_clean(strip_tags($this->input->post('billno')));
			$vendorname      = xss_clean(strip_tags($this->input->post('shopname')));
			$address         = xss_clean(strip_tags($this->input->post('address')));
			$contact         = xss_clean(strip_tags($this->input->post('contactno')));
			$orderno         = xss_clean(strip_tags($this->input->post('orderno')));
			$orderdate       = xss_clean(strip_tags($this->input->post('orderdate')));
			$sourcereciept   = xss_clean(strip_tags($this->input->post('sourcereciept')));
			$email           = xss_clean(strip_tags($this->input->post('email')));
			$total_amount    = xss_clean(strip_tags($this->input->post('totalamount')));
			$remark          = xss_clean(strip_tags($this->input->post('remark')));
			$billtype        = xss_clean(strip_tags($this->input->post('billtype')));
			
			$item        = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$amount      = xss_clean($this->input->post('amount'));
			$unit      = xss_clean($this->input->post('unit'));
			$rate      = xss_clean($this->input->post('rate'));
			$charges      = xss_clean($this->input->post('charges'));
			
			
			$this->form_validation->set_rules('billdate','billdate','trim|required');
			$this->form_validation->set_rules('billno','billno','trim|required');
			$this->form_validation->set_rules('contactno','contact no','trim|required|regex_match[/^[0-9]{10}$/]');
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');
			$this->form_validation->set_rules('amount[]','amount','trim|required');

			if($this->form_validation->run() === false) 
			{
				   $uri = $this->uri->segment('4'); 

				   $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
				   
				   $data['all_bill']= $this->Base_model->get_all_record_by_condition('osr_bill_item',array('bill_master_id'=>$uri));
				 
				
				 $data['bill_detail'] = $this->Base_model->get_record_by_id('osr_bill_master',array('bill_master_id' => $uri));
	 
					
				  $this->load->view('admin/header');
				  $this->load->view('admin/sidebar-itstationary');
				  $this->load->view('admin/itstationary_management/bill/entrybill',$data);
				  $this->load->view('admin/footer');
	

			} else {
				
				    $uri = $this->uri->segment('4'); 
					date_default_timezone_set('Asia/Calcutta'); 
					 $created_date =  date("Y-m-d H:i:s");
					 $uri = $this->uri->segment('4'); 

					 $pst = date('Y');
		             $pt = date('Y', strtotime('+1 year'));
		             $fy = $pst.'-'.$pt;
						 
					$update_master = array(
								'bill_no' 	            => $billno,
								'bill_date' 	        => $billdate,
								'vendor_name' 	        => $vendorname,
								'vendor_address' 	    => !empty($address)?$address:NULL,
								'vendor_email' 	        => !empty($email)?$email:NULL,
								'vendor_contact_no' 	=> $contact,
								'order_no' 	            => !empty($orderno)?$orderno:NULL,
								'bill_type' 	        => $billtype,
								'source_reciept' 	    => !empty($sourcereciept)?$sourcereciept:NULL,
								'grand_total' 	        => !empty($total_amount)?$total_amount:NULL,
								'entry_date' 	        => $created_date,
								'remark' 	            => !empty($remark)?$remark:NULL,
								'status' 	            => '1',
								'delete_status' 	    => '0',
								'service_type'          => '1',
								'financial_year'        => $fy,
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							);
			
				$updateid = $this->Base_model->update_record_by_id('osr_bill_master', $update_master, array('bill_master_id'=> $uri));

				 $this->Base_model->delete_record_by_id('osr_bill_item',array('bill_master_id'=>$uri));
				
				   if($updateid){
					   
						$i=0;

						foreach($item as $items){
							   
						  $insertid = $this->Base_model->insert_one_row('osr_bill_item', 
						  array('bill_master_id'        => $uri,
								'item_id'               => $items,
								'quantity'              => $quantity[$i],
								'amount' 	            => $amount[$i],
								'unit'                  => !empty($unit[$i])?$unit[$i]:NULL,
								'rate'                  => !empty($rate[$i])?$rate[$i]:NULL,
								'incidental_charges'    => !empty($charges[$i])?$charges[$i]:NULL,
								'status' 	            => '1',
								'delete_status' 	    => '0',
								'service_type'          => '1',
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							));
							
				      $available_qty = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$items));			
						
				     $total_qty = $available_qty->quantity_stock+$quantity[$i];	

				    $adddaily_stock = $available_qty->adddaily_stock+$quantity[$i];
						
                       $update_item = array(
					        'quantity_stock' 	    => $total_qty,
					        'adddaily_stock' 	    => $adddaily_stock,
						    'modified_by' 	        => $this->session->userdata('user_id'),
							'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
							'inventory_increase_date' => $created_date,
							'created_date' 	        => $created_date,
							'updated_date'   	    => $created_date
					   );	

				$updatefinalid = $this->Base_model->update_record_by_id('osr_item_master', $update_item, array('item_id'=>$items));
						
					$i++;
						   
				} }		

						if($updatefinalid)
						{
							$msg = "Bill entry has updated successfully.";
							$this->session->set_flashdata('flashSuccess_bill',$msg);
							
							$data['all_bill'] = $this->Base_model->get_all_record_by_condition('osr_bill_master',array('delete_status'=>'0','status'=>'1','service_type'=>'1'));
							
							redirect('itonlinestationary/bill',$data);
						}

						else
						{
							
						 $msg = "Fail to update bill entry";
						 $this->session->set_flashdata('flashError_billedit', $msg);
							
						 $uri = $this->uri->segment('4'); 
		  

					   $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>'1','delete_status'=>'0','service_type'=>'1'));
					   
					   $data['all_bill']= $this->Base_model->get_all_record_by_condition('osr_bill_item',array('bill_master_id'=>$uri));
					 
					
					 $data['bill_detail'] = $this->Base_model->get_record_by_id('osr_bill_master',array('bill_master_id' => $uri));
		 
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary');
						$this->load->view('admin/itstationary_management/bill/editbill',$data);
						$this->load->view('admin/footer');
						
					  }
					  
				   } 
		

		} else {
		
			 $uri = $this->uri->segment('4'); 

		     $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
			   
			 $data['all_bill']= $this->Base_model->get_all_record_by_condition('osr_bill_item',array('bill_master_id'=>$uri));
			
		     $data['bill_detail'] = $this->Base_model->get_record_by_id('osr_bill_master',array('bill_master_id' => $uri));
		 
		     $this->load->view('admin/header');
			 $this->load->view('admin/sidebar-itstationary');
			 $this->load->view('admin/itstationary_management/bill/editbill',$data);
			 $this->load->view('admin/footer');
			
		}
	
	}

	public function editoldbill(){
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$uri = $this->uri->segment('4'); 

			date_default_timezone_set('Asia/Calcutta');
			$created_date =  date("Y-m-d H:i:s");
			
			$billtype    = xss_clean(strip_tags($this->input->post('billtype')));
			$item        = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			
			$this->form_validation->set_rules('item[]','item','trim|required');
			$this->form_validation->set_rules('quantity[]','quantity','trim|required');

			if($this->form_validation->run() === false) 
			{
				   $uri = $this->uri->segment('4'); 

				   $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
				   
				   $data['all_bill']= $this->Base_model->get_all_record_by_condition('osr_bill_item',array('bill_master_id'=>$uri));
					
				  $this->load->view('admin/header');
				  $this->load->view('admin/sidebar-stationary');
				  $this->load->view('admin/itstationary_management/bill/entrybill',$data);
				  $this->load->view('admin/footer');
	

			} else {
				
		      $uri = $this->uri->segment('4'); 
			  date_default_timezone_set('Asia/Calcutta'); 
			  $created_date =  date("Y-m-d H:i:s");
			  $uri = $this->uri->segment('4'); 

			  $billdetail = $this->Base_model->get_record_by_id('osr_bill_master',array('bill_master_id' => $uri));

			 $pst = date('Y');
             $pt = date('Y', strtotime('+1 year'));
             $fy = $pst.'-'.$pt;
						 
			$update_master = array(
				'bill_date' 	        => $billdetail->bill_date,
				'bill_type' 	        => $billtype,
				'status' 	            => '1',
				'delete_status' 	    => '0',
				'service_type'          => '1',
				'financial_year'        => $fy,
				'modified_by' 	        => $this->session->userdata('user_id'),
				'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
				'updated_date'   	    => $created_date
			);


		$updateid = $this->Base_model->update_record_by_id('osr_bill_master', $update_master, array('bill_master_id'=> $uri));

     $olditems = $this->Base_model->get_all_record_by_condition('osr_bill_item',array('bill_master_id'=>$uri));	

	  foreach($olditems as $items){

			$available_qty = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$items->item_id));			
					
			    $total_qty = $available_qty->quantity_stock-$items->quantity;	

			    $adddaily_stock = $available_qty->adddaily_stock-$items->quantity;
					
	               $update_item = array(
				        'quantity_stock' 	    => $total_qty,
				        'adddaily_stock' 	    => $adddaily_stock,
					    'modified_by' 	        => $this->session->userdata('user_id'),
						'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
						'inventory_increase_date' => $created_date,
						'created_date' 	        => $created_date,
						'updated_date'   	    => $created_date
				   );	

			    $updatefinalid = $this->Base_model->update_record_by_id('osr_item_master', $update_item, array('item_id'=>$items->item_id));
		}

		$this->Base_model->delete_record_by_id('osr_bill_item',array('bill_master_id'=>$uri));
			
			   if($updateid){
				   
					$i=0;

					foreach($item as $items){
						   
					  $insertid = $this->Base_model->insert_one_row('osr_bill_item', 
					  array('bill_master_id'        => $uri,
							'item_id'               => $items,
							'quantity'              => $quantity[$i],
							'status' 	            => '1',
							'delete_status' 	    => '0',
							'service_type'          => '1',
							'modified_by' 	        => $this->session->userdata('user_id'),
							'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
							'created_date' 	        => $created_date,
							'updated_date'   	    => $created_date
						));
						
			    $available_qty = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$items));			
					
			    $total_qty = $available_qty->quantity_stock+$quantity[$i];	

			    $adddaily_stock = $available_qty->adddaily_stock+$quantity[$i];
					
	               $update_item = array(
				        'quantity_stock' 	    => $total_qty,
				        'adddaily_stock' 	    => $adddaily_stock,
					    'modified_by' 	        => $this->session->userdata('user_id'),
						'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
						'inventory_increase_date' => $created_date,
						'created_date' 	        => $created_date,
						'updated_date'   	    => $created_date
				   );	

			    $updatefinalid = $this->Base_model->update_record_by_id('osr_item_master', $update_item, array('item_id'=>$items));
					
				$i++;
					   
			 } 
		   }		

				if($updatefinalid)
				{
					$msg = "Bill entry has updated successfully.";
					$this->session->set_flashdata('flashSuccess_bill',$msg);

					redirect('itonlinestationary/bill',$data);
				}

				else
				{
					
				 $msg = "Fail to update bill entry";
				 $this->session->set_flashdata('flashError_billedit', $msg);
					
				 $uri = $this->uri->segment('4'); 

				 $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
				   
				 $data['all_bill']= $this->Base_model->get_all_record_by_condition('osr_bill_item',array('bill_master_id'=>$uri));

				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-stationary');
				$this->load->view('admin/itstationary_management/bill/editbill',$data);
				$this->load->view('admin/footer');
				
			  }
					  
		  } 
		

		} else {
		
		   $uri = $this->uri->segment('4'); 

		   $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
		   
		   $data['all_bill']= $this->Base_model->get_all_record_by_condition('osr_bill_item',array('bill_master_id'=>$uri));
		 
		     $this->load->view('admin/header');
			 $this->load->view('admin/sidebar-stationary');
			 $this->load->view('admin/itstationary_management/bill/editbill',$data);
			 $this->load->view('admin/footer');
			
		}
	
	}
	
	
	public function viewbill()
	{
		
		$uri = $this->uri->segment('4'); 
		
		$data['all_bill'] = $this->Base_model->get_all_record_by_condition('osr_bill_item',array('bill_master_id'=>$uri));
		
	     $data['bill_detail'] = $this->Base_model->get_record_by_id('osr_bill_master',array('bill_master_id' => $uri));
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-itstationary');
		$this->load->view('admin/itstationary_management/bill/viewbill',$data);
		$this->load->view('admin/footer');
	
	}
	
	
	  public function searchbill()
	     {
		
			if(isset($_REQUEST['submit'])){
				
					$from_date = xss_clean(strip_tags($this->input->post('from_date')));
					$to_date = xss_clean(strip_tags($this->input->post('to_date')));
					
					$from_date = str_replace('/', '-', $from_date);
					
					$stdate = date('Y-m-d',  strtotime($from_date));
					
					$to_date = str_replace('/', '-', $to_date);
					
					$enddate = date('Y-m-d',  strtotime($to_date));
					
					$data['all_bill'] = $this->Stationary_model->search_bill($stdate, $enddate);
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary');
					$this->load->view('admin/itstationary_management/bill/billlist',$data);
					$this->load->view('admin/footer');
			}
		
	   }


	 public function getpdfdata(){

	   	   $bill_id = $this->input->post('bill_master_id');
	   	   $service_type = $this->input->post('service_type');

	   	   $master_data = $this->Base_model->get_record_by_id('osr_bill_master',array('bill_master_id' => $bill_id,'service_type'=>$service_type));

	   	   $items = $this->Base_model->get_all_record_by_condition('osr_bill_item',array('bill_master_id' => $bill_id));

	   	   foreach ($items as $iitms) {

	   	   	  $itemname = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$iitms->item_id));
                
              $all_items[]  = array(
              	  'item_name'              => $itemname->item_name,
              	  'quantity'               => $iitms->quantity,
              	  'amount'                 => $iitms->amount,
              	  'unit'                   => $iitms->unit,
              	  'rate'                   => $iitms->rate,
              	  'incidental_charges'     => $iitms->incidental_charges,
              	  'remarks'                => $iitms->remarks
              );

	   	   }

			$json_data = array(

				'bill_no'          => $master_data->bill_no,
				'bill_date'        => date('d F Y', strtotime($master_data->bill_date)),
				'vendor_name'      => $master_data->vendor_name,
				'vendor_address'   => $master_data->vendor_address,
				'vendor_email'     => $master_data->vendor_email,
				'vendor_contact'   => $master_data->vendor_contact,
				'source_reciept'   => $master_data->source_reciept,
				'order_no'         => $master_data->order_no,
				'bill_type'        => $master_data->bill_type,
				'grand_total'      => $master_data->grand_total,
				'remark'           => $master_data->remark,
				'all_items'        => $all_items
			);

			$bill_data =  json_encode($json_data);
			echo  $bill_data;

	  }

	
	
}
