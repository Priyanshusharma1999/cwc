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
		
		$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>'0','service_type'=>'1','status'=>'Pending'));
		
		$data['check_requisition'] = $this->Stationary_model->check_requisition(); 	

		 $user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("11", $user_roles))
			  {
			  	$roledata['permission_role'] = $user_roles;
			  }
				
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-itstationary',$roledata);
		$this->load->view('admin/itstationary_management/report/requisitionreport',$data);
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
									$this->load->view('admin/itstationary_management/report/requisitionreport',$data);
									$this->load->view('admin/footer');
							}
		
	   }// ends function
	
	
	public function proxylist()
	{
 			$data['all_request'] = $this->Stationary_model->get_proxylist();

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
			$this->load->view('admin/sidebar-itstationary',$roledata);
			$this->load->view('admin/itstationary_management/report/proxyreport',$data);
			$this->load->view('admin/footer');
	}//ends function


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
							$this->load->view('admin/sidebar-itstationary',$roledata);
							$this->load->view('admin/itstationary_management/report/proxyreport',$data);
							$this->load->view('admin/footer');
					}
		
	    }
	
	
	public function approvelist()
	{
			$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'service_type'=>1,'status'=>'Approved'));
		
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
		$this->load->view('admin/sidebar-itstationary',$roledata);
		$this->load->view('admin/itstationary_management/report/approvereport',$data);
		$this->load->view('admin/footer');
	}


	public function Issuelist()
	{
			$data['all_request'] = $this->Base_model->get_all_record_by_condition('osr_requisition_master',array('delete_status'=>0,'service_type'=>1,'status'=>'Closed'));
		
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
		$this->load->view('admin/sidebar-itstationary',$roledata);
		$this->load->view('admin/itstationary_management/report/issuereport',$data);
		$this->load->view('admin/footer');
	}



  public function directorateitem()
	{

        $items = array();

		$all_items = $this->Stationary_model->getitemreport();

		foreach($all_items as $iittemms){

			$items[] = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$iittemms->item_id,'status'=>'1','delete_status'=>'0','service_type'=>'1'));
		}
		
		$data['all_items'] =  $items;

		$data['all_directorate'] =  $this->Base_model->get_all_record_by_condition('employee_office',array('delete_status'=>0));
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-itstationary');
		$this->load->view('admin/itstationary_management/report/directorateitemreport',$data);
		$this->load->view('admin/footer');
	}


	public function itemhistoryreport()
	{

		$data['all_items'] = $this->Base_model->get_all_itemhistory('historical_item_master',array('status'=>'1','delete_status'=>'0','service_type'=>'1'));

		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-itstationary');
		$this->load->view('admin/itstationary_management/report/itemhistoryreport',$data);
		$this->load->view('admin/footer');
	}

	

	public function search_apprequest()
	{

		if(isset($_REQUEST['submit'])){

			   $status = 'Approved';
				
				$from_date = xss_clean(strip_tags($this->input->post('from_date')));

				$to_date = xss_clean(strip_tags($this->input->post('to_date')));

				$from_date = str_replace('/', '-', $from_date);
					
				$stdate = date('Y-m-d',  strtotime($from_date));
					
				$to_date = str_replace('/', '-', $to_date);
					
				$enddate = date('Y-m-d',  strtotime($to_date));
				
				$data['all_request'] = $this->Stationary_model->search_request($status,$stdate,$enddate);
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-itstationary');
				$this->load->view('admin/itstationary_management/report/approvereport',$data);
				$this->load->view('admin/footer');
				
		}
		
    }

    public function search_issuereport(){

    	if(isset($_REQUEST['submit'])){

			   $status = 'Closed';
				
				$from_date = xss_clean(strip_tags($this->input->post('from_date')));

				$to_date = xss_clean(strip_tags($this->input->post('to_date')));

				$from_date = str_replace('/', '-', $from_date);
					
				$stdate = date('Y-m-d',  strtotime($from_date));
					
				$to_date = str_replace('/', '-', $to_date);
					
				$enddate = date('Y-m-d',  strtotime($to_date));
				
				$data['all_request'] = $this->Stationary_model->search_request($status,$stdate,$enddate);
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-itstationary');
				$this->load->view('admin/itstationary_management/report/issuereport',$data);
				$this->load->view('admin/footer');
				
		}

    }


    public function search_reqreport(){

    	if(isset($_REQUEST['submit'])){

			   $status = 'Pending';
				
				$from_date = xss_clean(strip_tags($this->input->post('from_date')));

				$to_date = xss_clean(strip_tags($this->input->post('to_date')));

				$from_date = str_replace('/', '-', $from_date);
					
				$stdate = date('Y-m-d',  strtotime($from_date));
					
				$to_date = str_replace('/', '-', $to_date);
					
				$enddate = date('Y-m-d',  strtotime($to_date));
				
				$data['all_request'] = $this->Stationary_model->search_request($status,$stdate,$enddate);
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-itstationary');
				$this->load->view('admin/itstationary_management/report/requisitionreport',$data);
				$this->load->view('admin/footer');
				
		}

    }


     public function search_directreport(){

     	$items = array();

     	$all_items = array();

     	$all_emp = array();

     	$all_id = array();

    	if(isset($_REQUEST['submit'])){
				
			$directorate_id = xss_clean($this->input->post('directorate'));

			$all_emp = $this->Base_model->get_all_record_by_condition('employee',array('post'=>$directorate_id,'status'=>'1','delete_status'=>'1'));

			foreach($all_emp as $emp){

				$reqid = $this->Base_model->get_record_by_id('osr_requisition_master',array('emp_id'=>$emp->employee_id));
               
                $all_id[] = $reqid->req_id;
                 
			}

			$all_items = $this->Stationary_model->getsearchitemreport(array_filter($all_id));

			foreach($all_items as $iittemms){

				$items[] = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$iittemms->item_id,'status'=>'1','delete_status'=>'0','service_type'=>'1'));
			}
			
			$data['all_items'] =  $items;

			$data['all_directorate'] =  $this->Base_model->get_all_record_by_condition('employee_office',array('delete_status'=>0));

			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-itstationary');
			$this->load->view('admin/itstationary_management/report/directorateitemreport',$data);
			$this->load->view('admin/footer');
				
		}

    }


	  public function search_itemhistory(){

	  	    $item_name = xss_clean(strip_tags($this->input->post('item_name')));
					
			$from_date = xss_clean(strip_tags($this->input->post('from_date')));

			$to_date = xss_clean(strip_tags($this->input->post('to_date')));

			$from_date = str_replace('/', '-', $from_date);
				
			$stdate = date('Y-m-d',  strtotime($from_date));
				
			$to_date = str_replace('/', '-', $to_date);
				
			$enddate = date('Y-m-d',  strtotime($to_date));
			
			$data['all_items'] = $this->Stationary_model->item_history($item_name,$stdate,$enddate);
			
            $this->load->view('admin/header');
			$this->load->view('admin/sidebar-itstationary');
			$this->load->view('admin/itstationary_management/report/itemhistoryreport',$data);
			$this->load->view('admin/footer');

	  }

	  public function getdirectoratereport(){

	  	   $item_id = $this->input->post('id');

	  	  $item_issuedet = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('item_id' => $item_id,'approved_qty>'=>'0','service_type'=>'1'));

	  	/*****************all report json code**********/

        		$all_detail= array();

        		$i=1;

        		foreach ($item_issuedet as $issuedet) 
        		{
        			
                    $detail = $this->Base_model->get_record_by_id('osr_requisition_master', array('req_id' => $issuedet->req_id,'status'=>'Closed'));

                    if(!empty($detail->user_id)){
                        
                        $empdetail = $this->Base_model->get_record_by_id('users', array('user_id' => $detail->user_id));

	        			$issuedetails['S.No.']                  =  $i;
	        			$issuedetails['Employee Name'] 			=  $empdetail->display_name;
	        			$issuedetails['Employee Designation'] 	=  $empdetail->designation;
	        			$issuedetails['Approved Quantity'] 	    =  $issuedet->approved_qty; 
	        			$issuedetails['Issued Quantity'] 	    =  $issuedet->issued_qty; 
	        			$issuedetails['Issued Date'] 			=  date('d F Y', strtotime($detail->issue_date));
	        			$issuedetails['Finaicial Year'] 		=  $detail->financial_year;

	        			$all_detail[] = $issuedetails;

        		    	$i++;

                    }

        		}//ends foreach

        		$json_apprve = json_encode($all_detail);

        		echo $json_apprve;

        	/************ends all report json code**********/

	  }

	
}//ends function
