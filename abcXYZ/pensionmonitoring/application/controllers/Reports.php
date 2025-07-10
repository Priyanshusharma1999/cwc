<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports extends CI_Controller {

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
			
			$coookie_ci_value = $this->input->cookie('ci_session', TRUE);

			$session_cookie_value = $this->session->userdata('asession_cookie');
			
			if(empty($this->session->userdata('applicant_user_id')))
			 {
				$base_url = base_url();
				 redirect($base_url.'Frontend/logout');
			 } 

			 if($coookie_ci_value != $session_cookie_value )
			 {
				$base_url = base_url();
				 redirect($base_url.'Frontend/logout');
			 } 
	}
	 
	public function index()
	{ 

		$segment_id = $this->uri->segment('3');
		$uri = $this->session->userdata('applicant_user_id');

		if($segment_id!=$uri)
		{
			$base_url = base_url();
			redirect($base_url.'Frontend/logout');
		}

		else
		{
			$userdata = $this->Base_model->get_record_by_id('users',array('USERS_ID'=>$this->session->userdata('applicant_user_id')));

		if($userdata->ROLE_ID == '1' || $userdata->ROLE_ID == '4')
		{
				$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
				$org_data = array();
				foreach ($all_org as $org)
				 {

					$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
					 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
					 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
					 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
					 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

					
					 $rs1 = $this->db->query($sql1);
					 $result1 = $rs1->result();

					 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
					$rs2 = $this->db->query($sql2);
					$result2 = $rs2->result();

			
					$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
					$rs3 = $this->db->query($sql3);
					$result3 = $rs3->result();

					$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
					$rs4 = $this->db->query($sql4);
					$result4 = $rs4->result();

					 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
					 $org_all['organisation_name'] = $org->ORGNAME;
					 $org_all['all_data_POPSEF'] = $result1;
					 $org_all['all_data_POPSOF'] = $result2;
					 $org_all['all_data_PNPSEF'] = $result3;   
					 $org_all['all_data_PNPSOF'] = $result4;

					  $org_data[] = $org_all;
					
				 } // ends foreach
				 	
				 	$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

				 	if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if


					$data['all_org_data']  = $org_data;
					$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/report/reportlist2',$data);
					$this->load->view('admin/footer');
		}

		/************for division role***********/

		/*else if($userdata->ROLE_ID == '4')
		{
			$division_data = $this->Base_model->get_record_by_id('division',array('DIVISION_ID'=>$userdata->DIVISION_ID));
			$organisation_name = $userdata->ORGANIZATION_ID;
			$division 		   = $division_data->DIVISIONNAME;
			

			$sql1 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
					 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
					 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
					 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
					WHERE  penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0  AND penrecord.PENSION_TYPE = 'POPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1"; 

					//echo $sql1;exit;
					      
					$rs1 = $this->db->query($sql1);
					$result1 = $rs1->result();

					/********result2*****/

					/*$sql2 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0  AND penrecord.PENSION_TYPE = 'POPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";   

					$rs2 = $this->db->query($sql2);
					$result2 = $rs2->result();*/

					/********result3**********/

					/*$sql3 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0  AND penrecord.PENSION_TYPE = 'PNPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
					$rs3 = $this->db->query($sql3);
					$result3 = $rs3->result();*/

					/***************result4*************/

					/*$sql4 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0  AND penrecord.PENSION_TYPE = 'PNPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
					$rs4 = $this->db->query($sql4);
					$result4 = $rs4->result();


					$data['all_data_POPSEF']  = $result1;
					$data['all_data_POPSOF']  = $result2;
					$data['all_data_PNPSEF']  = $result3;
					$data['all_data_PNPSOF']  = $result4;
					$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
					$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;

					$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/report/reportlist',$data);
					$this->load->view('admin/footer');*/
		//}//ends else if*/
		/*******ends division role*************/
		else
		{
			$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
				$org_data = array();
				foreach ($all_org as $org)
				 {

					$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
					 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
					 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
					 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
					 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.MODIFIEDBY_ID = '".$userdata->USERS_ID."' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

					
					 $rs1 = $this->db->query($sql1);
					 $result1 = $rs1->result();

					 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.MODIFIEDBY_ID = '".$userdata->USERS_ID."' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
					$rs2 = $this->db->query($sql2);
					$result2 = $rs2->result();

			
					$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.MODIFIEDBY_ID = '".$userdata->USERS_ID."' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
					$rs3 = $this->db->query($sql3);
					$result3 = $rs3->result();

					$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.MODIFIEDBY_ID = '".$userdata->USERS_ID."' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
					$rs4 = $this->db->query($sql4);
					$result4 = $rs4->result();

					 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
					 $org_all['organisation_name'] = $org->ORGNAME;
					 $org_all['all_data_POPSEF'] = $result1;
					 $org_all['all_data_POPSOF'] = $result2;
					 $org_all['all_data_PNPSEF'] = $result3;   
					 $org_all['all_data_PNPSOF'] = $result4;

					  $org_data[] = $org_all;
					
				 } // ends foreach

				 $data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);
				  
				  if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if

					$data['all_org_data']  = $org_data;
					$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/report/reportlist2',$data);
					$this->load->view('admin/footer');
		}

	
		}//ends else
		
		
	
	}

	/***********function for search pension records*******/

	public function search_pension()
	{
		$select_type  = xss_clean($this->input->post('select_type'));
		$month  	  = xss_clean($this->input->post('month'));
		$division  	  = xss_clean($this->input->post('division'));
		$organisation_name  	  = xss_clean($this->input->post('organisation_name'));


		if(isset($_REQUEST['submit'])) 
		{ 

			if($select_type=='1')
			{
				if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1' ";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1'";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1' ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1' ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 
					 if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));

					
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
						'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
				}//ends if orgn

				else
				{
				
						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1'  ";        
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();

						/********result2*****/

						$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1' ";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();
 
						/********result3**********/

						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1'  ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						/***************result4*************/

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.PENDING_PPO = '1' ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist',$data);
						$this->load->view('admin/footer');
				}//ends else orgn
				
			}//ends if

			//****************************select type 2 means search month****************/

			else if($select_type=='2')
			{
				$select_type  = xss_clean($this->input->post('select_type'));
				$month  	  = xss_clean($this->input->post('month'));

					if($organisation_name=='All')
					{
						$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {
					 	

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 
					 if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> xss_clean($this->input->post('month')),
							'division' 	=> '',
							'from_date' => '',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
	
					}//ends if orgn

					else
					{
						$sql1 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1"; 
						      
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();

						/********result2*****/

						$sql2 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
							 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
							WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";   

						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

						/********result3**********/

						$sql3 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
							 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
							WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						/***************result4*************/

						$sql4 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
							 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
							WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();


						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> xss_clean($this->input->post('month')),
							'division' 	=> '',
							'from_date' => '',
							'to_date' 	=> ''
						);
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist',$data);
						$this->load->view('admin/footer');	
					}//ends else orgn
				
			}//ends else if 2 

			/*************************Search division wise********************/

			else if($select_type=='3')
			{
				$select_type  = xss_clean($this->input->post('select_type'));
				$division  	  = xss_clean($this->input->post('division'));

				if($organisation_name=='All' && $division== 'All' || $organisation_name=='All' && empty($division))
				{
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {
					 	

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE  penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE  penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
				}

						if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));

						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> '',
							'division' 	=> xss_clean($this->input->post('division')),
							'from_date' => '',
							'to_date' 	=> ''
						);
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
			}	

				else if($organisation_name=='All' && $division)
				{
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {
					 	

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penrecord.DIVIS_DEAL_NAME = '".$division."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DIVIS_DEAL_NAME = '".$division."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DIVIS_DEAL_NAME = '".$division."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DIVIS_DEAL_NAME = '".$division."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 	if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> '',
							'division' 	=> xss_clean($this->input->post('division')),
							'from_date' => '',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');

					
				}// ends if orgn

				else
				{
					$sql1 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
					 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
					 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
					 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
					WHERE  penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1"; 
					      
					$rs1 = $this->db->query($sql1);
					$result1 = $rs1->result();

					/********result2*****/

					$sql2 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";   

					$rs2 = $this->db->query($sql2);
					$result2 = $rs2->result();

					/********result3**********/

					$sql3 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
					$rs3 = $this->db->query($sql3);
					$result3 = $rs3->result();

					/***************result4*************/

					$sql4 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
					$rs4 = $this->db->query($sql4);
					$result4 = $rs4->result();


					$data['all_data_POPSEF']  = $result1;
					$data['all_data_POPSOF']  = $result2;
					$data['all_data_PNPSEF']  = $result3;
					$data['all_data_PNPSOF']  = $result4;
					$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
					$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;

					$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> '',
							'division' 	=> xss_clean($this->input->post('division')),
							'from_date' => '',
							'to_date' 	=>''
						);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/report/reportlist',$data);
					$this->load->view('admin/footer');
				}//ends else orgn

				
			}//ends else if 3

			/*****************Search date of retirement wise*****************/

			else if($select_type=='4')
			{

				$select_type  = xss_clean($this->input->post('select_type'));
				$from_date    = xss_clean($this->input->post('from_date'));
				$from_date    = str_replace('/', '-', $from_date);
				$from_date    = date('Y-m-d', strtotime($from_date));
				$to_date  	  = xss_clean($this->input->post('to_date'));
				$to_date      = str_replace('/', '-', $to_date);
				$to_date      = date('Y-m-d', strtotime($to_date));

				if($organisation_name=='All')
				{
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {
					 	

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 	if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));

						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> '',
							'division' 	=> '',
							'from_date' => xss_clean($this->input->post('from_date')),
							'to_date' 	=> xss_clean($this->input->post('to_date'))
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
						
					
				}//ends if orgn

				else
				{
					$sql1 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
					 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
					 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
					 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
					WHERE  penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1"; 
					      
					$rs1 = $this->db->query($sql1);
					$result1 = $rs1->result();

					/********result2*****/

					$sql2 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";   

					$rs2 = $this->db->query($sql2);
					$result2 = $rs2->result();

					/********result3**********/

					$sql3 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
					$rs3 = $this->db->query($sql3);
					$result3 = $rs3->result();

					/***************result4*************/

					$sql4 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
						 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
						WHERE  penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";       
					$rs4 = $this->db->query($sql4);
					$result4 = $rs4->result();


					$data['all_data_POPSEF']  = $result1;
					$data['all_data_POPSOF']  = $result2;
					$data['all_data_PNPSEF']  = $result3;
					$data['all_data_PNPSOF']  = $result4;
					$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
					$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
					$data['organisation_name']  = $orgnstion->ORGNAME;
					$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> '',
							'division' 	=> '',
							'from_date' => xss_clean($this->input->post('from_date')),
							'to_date' 	=> xss_clean($this->input->post('to_date'))
						);

					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/report/reportlist',$data);
					$this->load->view('admin/footer');
				}//ends else orgnn
				
			}//ends else if 4

			/**************Ends Search date of retirement wise*****************/

			/***************** All Pension Cases pending for submission and pending for settlement *****************/

			else if($select_type=='5')
			{ 

					if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 	if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if

						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);


						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
				}//ends if orgn

				else
				{
						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();

						/********result2*****/

						$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

						/********result3**********/

						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending'AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						/***************result4*************/

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();


						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);


						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist',$data);
						$this->load->view('admin/footer');
				}//ends else orgn
				

				
			}//ends else if 5

			/************** End All Pension Cases pending for submission and pending for settlement *****************/

		/***************** Pension Cases pending for submission *****************/

			else if($select_type=='6')
			{ 
				
				if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 
						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
				}//ends if orgn

				else
				{
						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();

						/********result2*****/

						$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

						/********result3**********/

						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending'AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						/***************result4*************/

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'No' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();


						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist',$data);
						$this->load->view('admin/footer');
				}//ends else orgn

			}//ends else if 6

			/***********************Ends Pension Cases pending for submission *************************/

			/***************** Pension Cases pending for settlement *****************/

			else if($select_type=='7')
			{ 
				
				if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 
						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
				}//ends if orgn

				else
				{
						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();

						/********result2*****/

						$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

						/********result3**********/

						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending'AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						/***************result4*************/

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();


						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);


						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist',$data);
						$this->load->view('admin/footer');
				}//ends else orgn

			}//ends else if 7

			/***********************Ends Pension Cases pending for settlement *************************/

			/********************** Pension Cases settled ************************/

			else if($select_type=='8')
			{ 
				if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 
						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
				}//ends if orgn

				else
				{
						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();

						/********result2*****/

						$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

						/********result3**********/

						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled'AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						/***************result4*************/

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Settled' AND penrecord.PENSION_PAPER_SUBMIT_STATUS = 'Yes' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();


						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);


						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist',$data);
						$this->load->view('admin/footer');
				}//ends else orgn
			}//ends else if 8

			/***********************Ends Pension Cases settled *************************/

			/***********************All Pension Cases *************************/

			else if($select_type=='9')
			{ 
				if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;
						 $org_all['all_data_POPSOF'] = $result2;
						 $org_all['all_data_PNPSEF'] = $result3;   
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 	if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if
					
						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
				}//ends if orgn

				else
				{
						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();

						/********result2*****/

						$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

						/********result3**********/

						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						/***************result4*************/

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();


						$data['all_data_POPSEF']  = $result1;
						$data['all_data_POPSOF']  = $result2;
						$data['all_data_PNPSEF']  = $result3;
						$data['all_data_PNPSOF']  = $result4;
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist',$data);
						$this->load->view('admin/footer');
				}//ends else orgn
			}//ends else if 9

			/***********************Ends All Pension Cases *************************/

			else if($select_type=='POPSEF')
			{ 
				if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = '".$select_type."' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

						 $rs1 = $this->db->query($sql1);
						 $result1 = $rs1->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSEF'] = $result1;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 	if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if
					
						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
				}//ends if orgn

				else
				{
						$sql1 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
						 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
						 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
						 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = '".$select_type."' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs1 = $this->db->query($sql1);
						$result1 = $rs1->result();


						$data['all_data_POPSEF']  = $result1;

						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist',$data);
						$this->load->view('admin/footer');
				}//ends else orgn
			}//ends else if 10


			else if($select_type=='POPSOF')
			{ 
				if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						 $sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = '".$select_type."' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_POPSOF'] = $result2;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 	if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if
					
						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
				}//ends if orgn

				else
				{
						

						$sql2 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = '".$select_type."' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs2 = $this->db->query($sql2);
						$result2 = $rs2->result();

						$data['all_data_POPSOF']  = $result2;

						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist',$data);
						$this->load->view('admin/footer');
				}//ends else orgn
			}//ends else if 11

			else if($select_type=='PNPSEF')
			{ 
				if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						
				
						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = '".$select_type."' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;
						 $org_all['all_data_PNPSEF'] = $result3;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 	if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if
					
						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
				}//ends if orgn

				else
				{

						/********result3**********/

						$sql3 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = '".$select_type."' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs3 = $this->db->query($sql3);
						$result3 = $rs3->result();

						
						$data['all_data_PNPSEF']  = $result3;

						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist',$data);
						$this->load->view('admin/footer');
				}//ends else orgn
			}//ends else if 12

			else if($select_type=='PNPSOF')
			{ 
				if($organisation_name=='All')
				{ 
					$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$org_data = array();
					foreach ($all_org as $org)
					 {

						

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = '".$select_type."' AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						 $org_all['organisation_id'] =  $org->ORGANIZATION_ID;
						 $org_all['organisation_name'] = $org->ORGNAME;  
						 $org_all['all_data_PNPSOF'] = $result4;

						  $org_data[] = $org_all;
						
					 } // ends foreach
					 	
					 	if(!empty($org_data))
					{
								usort($org_data, function($a, $b) 
							{
									return $a['organisation_name'] <=> $b['organisation_name'];
							});

					}//ends org_data if
					
						$data['all_org_data']  = $org_data;
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist2',$data);
						$this->load->view('admin/footer');
				}//ends if orgn

				else
				{

						/***************result4*************/

						$sql4 = " SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_TYPE = '".$select_type."' AND penrecord.DELETES = 0 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 ";        
						$rs4 = $this->db->query($sql4);
						$result4 = $rs4->result();

						$data['all_data_PNPSOF']  = $result4;
						
						$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
						$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
						$data['organisation_name']  = $orgnstion->ORGNAME;
						$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=>   '',
							'division' 	=> '',
							'from_date' =>'',
							'to_date' 	=> ''
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar');
						$this->load->view('admin/report/reportlist',$data);
						$this->load->view('admin/footer');
				}//ends else orgn
			}//ends else if 13

			else
			{

			}
		}//ends if

		else
		{ 
			$data['all_data_POPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSEF','DELETES'=>'0'));
			$data['all_data_POPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'POPSOF','DELETES'=>'0'));
			$data['all_data_PNPSEF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSEF','DELETES'=>'0'));
			$data['all_data_PNPSOF']  = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('PENSION_TYPE'=>'PNPSOF','DELETES'=>'0'));

			$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
			$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
			$data['organisation_name']  = 'All Organisations';
			$data['insertData'] = array(
							'type' 	=> xss_clean($this->input->post('select_type')),
							'org_name' 	=> xss_clean($this->input->post('organisation_name')),
							'month' 	=> xss_clean($this->input->post('month')),
							'division' 	=> xss_clean($this->input->post('division')),
							'from_date' => xss_clean($this->input->post('from_date')),
							'to_date' 	=> xss_clean($this->input->post('to_date'))
						);

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/report/reportlist',$data);
			$this->load->view('admin/footer');
		} 
		
  }//ends function


	//function to generate excel
	
	public function Excel()
	{

		date_default_timezone_set('Asia/calcutta');

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Pension_Sheet1');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Status Of Pending old Pension Scheme(Except Family Pension)');


		$this->excel->getActiveSheet()->setCellValue('A2', 'Pension Id');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Full Name');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Mobile No');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Address');
		$this->excel->getActiveSheet()->setCellValue('F2', 'Gender');
		$this->excel->getActiveSheet()->setCellValue('G2', 'Relation with pensioner');
		$this->excel->getActiveSheet()->setCellValue('H2', 'PAO No');
		$this->excel->getActiveSheet()->setCellValue('I2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('J2', 'Employee Name');
		$this->excel->getActiveSheet()->setCellValue('K2', 'Family Mamber Name');
		$this->excel->getActiveSheet()->setCellValue('L2', 'Retirement Date');
		$this->excel->getActiveSheet()->setCellValue('M2', 'Death Date');
		$this->excel->getActiveSheet()->setCellValue('N2', 'Board Name');
		$this->excel->getActiveSheet()->setCellValue('O2', 'Division Name');
		$this->excel->getActiveSheet()->setCellValue('P2', 'Pension Status');
		$this->excel->getActiveSheet()->setCellValue('Q2', 'Annual Verification');
		$this->excel->getActiveSheet()->setCellValue('R2', 'Pending PAO');
		$this->excel->getActiveSheet()->setCellValue('S2', 'Status pension paper');
		$this->excel->getActiveSheet()->setCellValue('T2', 'Terminal Benefit');
		$this->excel->getActiveSheet()->setCellValue('U2', 'Withdrawl NSDL');
		$this->excel->getActiveSheet()->setCellValue('V2', 'Terminal benefit not granted');
		$this->excel->getActiveSheet()->setCellValue('W2', 'Remarks');
		


        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table datasql
		$sql = " SELECT penstatus.PENSION_ID as pension_id,pencontact.FULLNAME as full_name,pencontact.MOBILENO as mobile_no,pencontact.EMAILID as email,pencontact.ADDRESS as address,pencontact.GENDER as gender,pencontact.RELATIONWITHPENSIONER as relshp_with_pensioner,penrecord.PPO_NO as ppo_no,penrecord.EMPLY_NAME as employee_name,penrecord.FAMILYMEM_NAME as family_mem_name,penrecord.DATE_RETIREMENT as retirement_date,penrecord.DATE_DEATH as death_date,penrecord.DIVIS_DEAL_NAME as division_name,penrecord.PENSION_STATUS as pension_status, penstatus.ANNUAL_VERIFICATION as annual_verification,penstatus.PENDING_PPO as pending_ppo,penstatus.STATUS_PENS_PAPER as status_pension_paper,penstatus.TREMINAL_BENIFIT_GRANT as terminal_banefit,penstatus.WITHDRAWAL_REQ_NSDL as withdrawl_nsdl,penstatus.STATUS_TERM_BENI_NOT_GRANT as term_benft_not_grant,penremark.DESCRIPTION as description  FROM pensrecostatus as penstatus 
	 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
	 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
	 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
	 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 ";        
		$rs = $this->db->query($sql);

		$exceldata=array();
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		$this->excel->createSheet();

		/******************************************Second data*******************************************/

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(1);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Pension_Sheet2');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Status Of Pending old Pension Scheme(Only Family Pension)');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Pension Id');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Full Name');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Mobile No');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Address');
		$this->excel->getActiveSheet()->setCellValue('F2', 'Gender');
		$this->excel->getActiveSheet()->setCellValue('G2', 'Relation with pensioner');
		$this->excel->getActiveSheet()->setCellValue('H2', 'PAO No');
		$this->excel->getActiveSheet()->setCellValue('I2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('J2', 'Employee Name');
		$this->excel->getActiveSheet()->setCellValue('K2', 'Family Mamber Name');
		$this->excel->getActiveSheet()->setCellValue('L2', 'Retirement Date');
		$this->excel->getActiveSheet()->setCellValue('M2', 'Death Date');
		$this->excel->getActiveSheet()->setCellValue('N2', 'Board Name');
		$this->excel->getActiveSheet()->setCellValue('O2', 'Division Name');
		$this->excel->getActiveSheet()->setCellValue('P2', 'Pension Status');
		$this->excel->getActiveSheet()->setCellValue('Q2', 'Annual Verification');
		$this->excel->getActiveSheet()->setCellValue('R2', 'Pending PAO');
		$this->excel->getActiveSheet()->setCellValue('S2', 'Status pension paper');
		$this->excel->getActiveSheet()->setCellValue('T2', 'Terminal Benefit');
		$this->excel->getActiveSheet()->setCellValue('U2', 'Withdrawl NSDL');
		$this->excel->getActiveSheet()->setCellValue('V2', 'Terminal benefit not granted');
		$this->excel->getActiveSheet()->setCellValue('W2', 'Remarks');
		

        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table datasql
		$sql = " SELECT penstatus.PENSION_ID as pension_id,pencontact.FULLNAME as full_name,pencontact.MOBILENO as mobile_no,pencontact.EMAILID as email,pencontact.ADDRESS as address,pencontact.GENDER as gender,pencontact.RELATIONWITHPENSIONER as relshp_with_pensioner,penrecord.PPO_NO as ppo_no,penrecord.EMPLY_NAME as employee_name,penrecord.FAMILYMEM_NAME as family_mem_name,penrecord.DATE_RETIREMENT as retirement_date,penrecord.DATE_DEATH as death_date,penrecord.DIVIS_DEAL_NAME as division_name,penrecord.PENSION_STATUS as pension_status, penstatus.ANNUAL_VERIFICATION as annual_verification,penstatus.PENDING_PPO as pending_ppo,penstatus.STATUS_PENS_PAPER as status_pension_paper,penstatus.TREMINAL_BENIFIT_GRANT as terminal_banefit,penstatus.WITHDRAWAL_REQ_NSDL as withdrawl_nsdl,penstatus.STATUS_TERM_BENI_NOT_GRANT as term_benft_not_grant,penremark.DESCRIPTION as description  FROM pensrecostatus as penstatus 
	 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
	 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
	 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
	 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 ";        
		$rs = $this->db->query($sql);

		$exceldata=array();
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		$this->excel->createSheet();

		/*******************************End second data*****************************************/

		/******************************************Third data*******************************************/

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(2);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Pension_Sheet3');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Status Of Pending New Pension Scheme(Except Family Pension)');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Pension Id');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Full Name');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Mobile No');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Address');
		$this->excel->getActiveSheet()->setCellValue('F2', 'Gender');
		$this->excel->getActiveSheet()->setCellValue('G2', 'Relation with pensioner');
		$this->excel->getActiveSheet()->setCellValue('H2', 'PAO No');
		$this->excel->getActiveSheet()->setCellValue('I2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('J2', 'Employee Name');
		$this->excel->getActiveSheet()->setCellValue('K2', 'Family Mamber Name');
		$this->excel->getActiveSheet()->setCellValue('L2', 'Retirement Date');
		$this->excel->getActiveSheet()->setCellValue('M2', 'Death Date');
		$this->excel->getActiveSheet()->setCellValue('N2', 'Board Name');
		$this->excel->getActiveSheet()->setCellValue('O2', 'Division Name');
		$this->excel->getActiveSheet()->setCellValue('P2', 'Pension Status');
		$this->excel->getActiveSheet()->setCellValue('Q2', 'Annual Verification');
		$this->excel->getActiveSheet()->setCellValue('R2', 'Pending PAO');
		$this->excel->getActiveSheet()->setCellValue('S2', 'Status pension paper');
		$this->excel->getActiveSheet()->setCellValue('T2', 'Terminal Benefit');
		$this->excel->getActiveSheet()->setCellValue('U2', 'Withdrawl NSDL');
		$this->excel->getActiveSheet()->setCellValue('V2', 'Terminal benefit not granted');
		$this->excel->getActiveSheet()->setCellValue('W2', 'Remarks');
		

        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table datasql
		$sql = " SELECT penstatus.PENSION_ID as pension_id,pencontact.FULLNAME as full_name,pencontact.MOBILENO as mobile_no,pencontact.EMAILID as email,pencontact.ADDRESS as address,pencontact.GENDER as gender,pencontact.RELATIONWITHPENSIONER as relshp_with_pensioner,penrecord.PPO_NO as ppo_no,penrecord.EMPLY_NAME as employee_name,penrecord.FAMILYMEM_NAME as family_mem_name,penrecord.DATE_RETIREMENT as retirement_date,penrecord.DATE_DEATH as death_date,penrecord.DIVIS_DEAL_NAME as division_name,penrecord.PENSION_STATUS as pension_status, penstatus.ANNUAL_VERIFICATION as annual_verification,penstatus.PENDING_PPO as pending_ppo,penstatus.STATUS_PENS_PAPER as status_pension_paper,penstatus.TREMINAL_BENIFIT_GRANT as terminal_banefit,penstatus.WITHDRAWAL_REQ_NSDL as withdrawl_nsdl,penstatus.STATUS_TERM_BENI_NOT_GRANT as term_benft_not_grant,penremark.DESCRIPTION as description  FROM pensrecostatus as penstatus 
	 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
	 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
	 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
	 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 ";        
		$rs = $this->db->query($sql);

		$exceldata=array();
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		$this->excel->createSheet();

		/*******************************End Third data*****************************************/

		/******************************************Fourth data*******************************************/

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(3);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Pension_Sheet4');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Status Of Pending old Pension Scheme(Only Family Pension)');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Pension Id');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Full Name');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Mobile No');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Address');
		$this->excel->getActiveSheet()->setCellValue('F2', 'Gender');
		$this->excel->getActiveSheet()->setCellValue('G2', 'Relation with pensioner');
		$this->excel->getActiveSheet()->setCellValue('H2', 'PAO No');
		$this->excel->getActiveSheet()->setCellValue('I2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('J2', 'Employee Name');
		$this->excel->getActiveSheet()->setCellValue('K2', 'Family Mamber Name');
		$this->excel->getActiveSheet()->setCellValue('L2', 'Retirement Date');
		$this->excel->getActiveSheet()->setCellValue('M2', 'Death Date');
		$this->excel->getActiveSheet()->setCellValue('N2', 'Board Name');
		$this->excel->getActiveSheet()->setCellValue('O2', 'Division Name');
		$this->excel->getActiveSheet()->setCellValue('P2', 'Pension Status');
		$this->excel->getActiveSheet()->setCellValue('Q2', 'Annual Verification');
		$this->excel->getActiveSheet()->setCellValue('R2', 'Pending PAO');
		$this->excel->getActiveSheet()->setCellValue('S2', 'Status pension paper');
		$this->excel->getActiveSheet()->setCellValue('T2', 'Terminal Benefit');
		$this->excel->getActiveSheet()->setCellValue('U2', 'Withdrawl NSDL');
		$this->excel->getActiveSheet()->setCellValue('V2', 'Terminal benefit not granted');
		$this->excel->getActiveSheet()->setCellValue('W2', 'Remarks');
		

        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table datasql
		$sql = " SELECT penstatus.PENSION_ID as pension_id,pencontact.FULLNAME as full_name,pencontact.MOBILENO as mobile_no,pencontact.EMAILID as email,pencontact.ADDRESS as address,pencontact.GENDER as gender,pencontact.RELATIONWITHPENSIONER as relshp_with_pensioner,penrecord.PPO_NO as ppo_no,penrecord.EMPLY_NAME as employee_name,penrecord.FAMILYMEM_NAME as family_mem_name,penrecord.DATE_RETIREMENT as retirement_date,penrecord.DATE_DEATH as death_date,penrecord.DIVIS_DEAL_NAME as division_name,penrecord.PENSION_STATUS as pension_status, penstatus.ANNUAL_VERIFICATION as annual_verification,penstatus.PENDING_PPO as pending_ppo,penstatus.STATUS_PENS_PAPER as status_pension_paper,penstatus.TREMINAL_BENIFIT_GRANT as terminal_banefit,penstatus.WITHDRAWAL_REQ_NSDL as withdrawl_nsdl,penstatus.STATUS_TERM_BENI_NOT_GRANT as term_benft_not_grant,penremark.DESCRIPTION as description  FROM pensrecostatus as penstatus 
	 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
	 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
	 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
	 WHERE penstatus.STATUS = 1 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 ";        
		$rs = $this->db->query($sql);

		$exceldata=array();
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		//$this->excel->createSheet();

		/*******************************End Fourth data*****************************************/

                $filename='Penson_data'.date('d/m/y').'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache

                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');


            }//ends function

   /***********function for excel month wise according to 2 months or more********/

   	public function Excel_month()
	{

		date_default_timezone_set('Asia/calcutta');

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Pension_Sheet1');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Status Of Pending old Pension Scheme(Except Family Pension)');


		$this->excel->getActiveSheet()->setCellValue('A2', 'Pension Id');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Full Name');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Mobile No');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Address');
		$this->excel->getActiveSheet()->setCellValue('F2', 'Gender');
		$this->excel->getActiveSheet()->setCellValue('G2', 'Relation with pensioner');
		$this->excel->getActiveSheet()->setCellValue('H2', 'PAO No');
		$this->excel->getActiveSheet()->setCellValue('I2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('J2', 'Employee Name');
		$this->excel->getActiveSheet()->setCellValue('K2', 'Family Mamber Name');
		$this->excel->getActiveSheet()->setCellValue('L2', 'Retirement Date');
		$this->excel->getActiveSheet()->setCellValue('M2', 'Death Date');
		$this->excel->getActiveSheet()->setCellValue('N2', 'Board Name');
		$this->excel->getActiveSheet()->setCellValue('O2', 'Division Name');
		$this->excel->getActiveSheet()->setCellValue('P2', 'Pension Status');
		$this->excel->getActiveSheet()->setCellValue('Q2', 'Annual Verification');
		$this->excel->getActiveSheet()->setCellValue('R2', 'Pending PAO');
		$this->excel->getActiveSheet()->setCellValue('S2', 'Status pension paper');
		$this->excel->getActiveSheet()->setCellValue('T2', 'Terminal Benefit');
		$this->excel->getActiveSheet()->setCellValue('U2', 'Withdrawl NSDL');
		$this->excel->getActiveSheet()->setCellValue('V2', 'Terminal benefit not granted');
		$this->excel->getActiveSheet()->setCellValue('W2', 'Remarks');
		


        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table datasql
		$sql = "SELECT penstatus.PENSION_ID as pension_id,pencontact.FULLNAME as full_name,pencontact.MOBILENO as mobile_no,pencontact.EMAILID as email,pencontact.ADDRESS as address,pencontact.GENDER as gender,pencontact.RELATIONWITHPENSIONER as relshp_with_pensioner,penrecord.PPO_NO as ppo_no,penrecord.EMPLY_NAME as employee_name,penrecord.FAMILYMEM_NAME as family_mem_name,penrecord.DATE_RETIREMENT as retirement_date,penrecord.DATE_DEATH as death_date,penrecord.DIVIS_DEAL_NAME as division_name,penrecord.PENSION_STATUS as pension_status, penstatus.ANNUAL_VERIFICATION as annual_verification,penstatus.PENDING_PPO as pending_ppo,penstatus.STATUS_PENS_PAPER as status_pension_paper,penstatus.TREMINAL_BENIFIT_GRANT as terminal_banefit,penstatus.WITHDRAWAL_REQ_NSDL as withdrawl_nsdl,penstatus.STATUS_TERM_BENI_NOT_GRANT as term_benft_not_grant,penremark.DESCRIPTION as description  FROM pensrecostatus as penstatus 
		 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
		 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
		 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
		 WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL 4 MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL 4 MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSEF' AND penstatus.STATUS = 1 AND pencontact.STATUS = 1";        
		$rs = $this->db->query($sql);

		$exceldata=array();
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		$this->excel->createSheet();

		/******************************************Second data*******************************************/

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(1);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Pension_Sheet2');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Status Of Pending old Pension Scheme(Only Family Pension)');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Pension Id');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Full Name');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Mobile No');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Address');
		$this->excel->getActiveSheet()->setCellValue('F2', 'Gender');
		$this->excel->getActiveSheet()->setCellValue('G2', 'Relation with pensioner');
		$this->excel->getActiveSheet()->setCellValue('H2', 'PAO No');
		$this->excel->getActiveSheet()->setCellValue('I2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('J2', 'Employee Name');
		$this->excel->getActiveSheet()->setCellValue('K2', 'Family Mamber Name');
		$this->excel->getActiveSheet()->setCellValue('L2', 'Retirement Date');
		$this->excel->getActiveSheet()->setCellValue('M2', 'Death Date');
		$this->excel->getActiveSheet()->setCellValue('N2', 'Board Name');
		$this->excel->getActiveSheet()->setCellValue('O2', 'Division Name');
		$this->excel->getActiveSheet()->setCellValue('P2', 'Pension Status');
		$this->excel->getActiveSheet()->setCellValue('Q2', 'Annual Verification');
		$this->excel->getActiveSheet()->setCellValue('R2', 'Pending PAO');
		$this->excel->getActiveSheet()->setCellValue('S2', 'Status pension paper');
		$this->excel->getActiveSheet()->setCellValue('T2', 'Terminal Benefit');
		$this->excel->getActiveSheet()->setCellValue('U2', 'Withdrawl NSDL');
		$this->excel->getActiveSheet()->setCellValue('V2', 'Terminal benefit not granted');
		$this->excel->getActiveSheet()->setCellValue('W2', 'Remarks');
		

        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table datasql
		$sql = "SELECT penstatus.PENSION_ID as pension_id,pencontact.FULLNAME as full_name,pencontact.MOBILENO as mobile_no,pencontact.EMAILID as email,pencontact.ADDRESS as address,pencontact.GENDER as gender,pencontact.RELATIONWITHPENSIONER as relshp_with_pensioner,penrecord.PPO_NO as ppo_no,penrecord.EMPLY_NAME as employee_name,penrecord.FAMILYMEM_NAME as family_mem_name,penrecord.DATE_RETIREMENT as retirement_date,penrecord.DATE_DEATH as death_date,penrecord.DIVIS_DEAL_NAME as division_name,penrecord.PENSION_STATUS as pension_status, penstatus.ANNUAL_VERIFICATION as annual_verification,penstatus.PENDING_PPO as pending_ppo,penstatus.STATUS_PENS_PAPER as status_pension_paper,penstatus.TREMINAL_BENIFIT_GRANT as terminal_banefit,penstatus.WITHDRAWAL_REQ_NSDL as withdrawl_nsdl,penstatus.STATUS_TERM_BENI_NOT_GRANT as term_benft_not_grant,penremark.DESCRIPTION as description  FROM pensrecostatus as penstatus 
		 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
		 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
		 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
		 WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL 4 MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL 4 MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'POPSOF' AND penstatus.STATUS = 1 AND pencontact.STATUS = 1";        
		$rs = $this->db->query($sql);

		$exceldata=array();
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		$this->excel->createSheet();

		/*******************************End second data*****************************************/

		/******************************************Third data*******************************************/

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(2);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Pension_Sheet3');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Status Of Pending New Pension Scheme(Except Family Pension)');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Pension Id');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Full Name');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Mobile No');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Address');
		$this->excel->getActiveSheet()->setCellValue('F2', 'Gender');
		$this->excel->getActiveSheet()->setCellValue('G2', 'Relation with pensioner');
		$this->excel->getActiveSheet()->setCellValue('H2', 'PAO No');
		$this->excel->getActiveSheet()->setCellValue('I2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('J2', 'Employee Name');
		$this->excel->getActiveSheet()->setCellValue('K2', 'Family Mamber Name');
		$this->excel->getActiveSheet()->setCellValue('L2', 'Retirement Date');
		$this->excel->getActiveSheet()->setCellValue('M2', 'Death Date');
		$this->excel->getActiveSheet()->setCellValue('N2', 'Board Name');
		$this->excel->getActiveSheet()->setCellValue('O2', 'Division Name');
		$this->excel->getActiveSheet()->setCellValue('P2', 'Pension Status');
		$this->excel->getActiveSheet()->setCellValue('Q2', 'Annual Verification');
		$this->excel->getActiveSheet()->setCellValue('R2', 'Pending PAO');
		$this->excel->getActiveSheet()->setCellValue('S2', 'Status pension paper');
		$this->excel->getActiveSheet()->setCellValue('T2', 'Terminal Benefit');
		$this->excel->getActiveSheet()->setCellValue('U2', 'Withdrawl NSDL');
		$this->excel->getActiveSheet()->setCellValue('V2', 'Terminal benefit not granted');
		$this->excel->getActiveSheet()->setCellValue('W2', 'Remarks');
		

        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table datasql
		$sql = "SELECT penstatus.PENSION_ID as pension_id,pencontact.FULLNAME as full_name,pencontact.MOBILENO as mobile_no,pencontact.EMAILID as email,pencontact.ADDRESS as address,pencontact.GENDER as gender,pencontact.RELATIONWITHPENSIONER as relshp_with_pensioner,penrecord.PPO_NO as ppo_no,penrecord.EMPLY_NAME as employee_name,penrecord.FAMILYMEM_NAME as family_mem_name,penrecord.DATE_RETIREMENT as retirement_date,penrecord.DATE_DEATH as death_date,penrecord.DIVIS_DEAL_NAME as division_name,penrecord.PENSION_STATUS as pension_status, penstatus.ANNUAL_VERIFICATION as annual_verification,penstatus.PENDING_PPO as pending_ppo,penstatus.STATUS_PENS_PAPER as status_pension_paper,penstatus.TREMINAL_BENIFIT_GRANT as terminal_banefit,penstatus.WITHDRAWAL_REQ_NSDL as withdrawl_nsdl,penstatus.STATUS_TERM_BENI_NOT_GRANT as term_benft_not_grant,penremark.DESCRIPTION as description  FROM pensrecostatus as penstatus 
		 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
		 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
		 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
		 WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL 4 MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL 4 MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSEF' AND penstatus.STATUS = 1 AND pencontact.STATUS = 1";        
		$rs = $this->db->query($sql);

		$exceldata=array();
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		$this->excel->createSheet();

		/*******************************End Third data*****************************************/

		/******************************************Fourth data*******************************************/

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(3);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Pension_Sheet4');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Status Of Pending old Pension Scheme(Only Family Pension)');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Pension Id');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Full Name');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Mobile No');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Address');
		$this->excel->getActiveSheet()->setCellValue('F2', 'Gender');
		$this->excel->getActiveSheet()->setCellValue('G2', 'Relation with pensioner');
		$this->excel->getActiveSheet()->setCellValue('H2', 'PAO No');
		$this->excel->getActiveSheet()->setCellValue('I2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('J2', 'Employee Name');
		$this->excel->getActiveSheet()->setCellValue('K2', 'Family Mamber Name');
		$this->excel->getActiveSheet()->setCellValue('L2', 'Retirement Date');
		$this->excel->getActiveSheet()->setCellValue('M2', 'Death Date');
		$this->excel->getActiveSheet()->setCellValue('N2', 'Board Name');
		$this->excel->getActiveSheet()->setCellValue('O2', 'Division Name');
		$this->excel->getActiveSheet()->setCellValue('P2', 'Pension Status');
		$this->excel->getActiveSheet()->setCellValue('Q2', 'Annual Verification');
		$this->excel->getActiveSheet()->setCellValue('R2', 'Pending PAO');
		$this->excel->getActiveSheet()->setCellValue('S2', 'Status pension paper');
		$this->excel->getActiveSheet()->setCellValue('T2', 'Terminal Benefit');
		$this->excel->getActiveSheet()->setCellValue('U2', 'Withdrawl NSDL');
		$this->excel->getActiveSheet()->setCellValue('V2', 'Terminal benefit not granted');
		$this->excel->getActiveSheet()->setCellValue('W2', 'Remarks');
		

        //merge cell A1 until C1
		$this->excel->getActiveSheet()->mergeCells('A1:D1');
        //set aligment to center for that merged cell (A1 to C1)
		$this->excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        //make the font become bold
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(true);
		$this->excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
		$this->excel->getActiveSheet()->getStyle('A1')->getFill()->getStartColor()->setARGB('#333');

		for($col = ord('A'); $col <= ord('D'); $col++){
                //set column dimension
			$this->excel->getActiveSheet()->getColumnDimension(chr($col))->setAutoSize(true);
         //change the font size
			$this->excel->getActiveSheet()->getStyle(chr($col))->getFont()->setSize(12);

			$this->excel->getActiveSheet()->getStyle(chr($col))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		}
        //retrive contries table datasql
		$sql = "SELECT penstatus.PENSION_ID as pension_id,pencontact.FULLNAME as full_name,pencontact.MOBILENO as mobile_no,pencontact.EMAILID as email,pencontact.ADDRESS as address,pencontact.GENDER as gender,pencontact.RELATIONWITHPENSIONER as relshp_with_pensioner,penrecord.PPO_NO as ppo_no,penrecord.EMPLY_NAME as employee_name,penrecord.FAMILYMEM_NAME as family_mem_name,penrecord.DATE_RETIREMENT as retirement_date,penrecord.DATE_DEATH as death_date,penrecord.DIVIS_DEAL_NAME as division_name,penrecord.PENSION_STATUS as pension_status, penstatus.ANNUAL_VERIFICATION as annual_verification,penstatus.PENDING_PPO as pending_ppo,penstatus.STATUS_PENS_PAPER as status_pension_paper,penstatus.TREMINAL_BENIFIT_GRANT as terminal_banefit,penstatus.WITHDRAWAL_REQ_NSDL as withdrawl_nsdl,penstatus.STATUS_TERM_BENI_NOT_GRANT as term_benft_not_grant,penremark.DESCRIPTION as description  FROM pensrecostatus as penstatus 
		 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
		 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
		 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
		 WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL 4 MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL 4 MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = 'PNPSOF' AND penstatus.STATUS = 1 AND pencontact.STATUS = 1";        
		$rs = $this->db->query($sql);

		$exceldata=array();
		foreach ($rs->result_array() as $row){
			$exceldata[] = $row;
		}
                //Fill data 
		$this->excel->getActiveSheet()->fromArray($exceldata, null, 'A3');

		$this->excel->getActiveSheet()->getStyle('A3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('B3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('C3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		$this->excel->getActiveSheet()->getStyle('D3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


		//$this->excel->createSheet();

		/*******************************End Fourth data*****************************************/

                $filename='Penson_data'.date('d/m/y').'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache

                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');


            }//ends function
	
	
	
}
