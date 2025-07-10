<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Retirement extends CI_Controller {

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
			$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
			$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/retirement/retirementlist',$data);
			$this->load->view('admin/footer');
		}//ends else
		
	
	}

	/***********function for search pension records*******/

	public function search_retirement()
	{ 
		$from_date    		= xss_clean($this->input->post('from_date'));
		$to_date  	  		= xss_clean($this->input->post('to_date'));
		$division  	  		= xss_clean($this->input->post('division'));
		$organisation_name  = xss_clean($this->input->post('organisation_name'));


		if(isset($_REQUEST['submit'])) 
		{ 
		/*************************Search Retirement data wise********************/
			if($organisation_name)
			{
				$from_date    		= xss_clean($this->input->post('from_date'));
				$to_date  	  		= xss_clean($this->input->post('to_date'));
				$division  	  		= xss_clean($this->input->post('division'));
				$organisation_name  = xss_clean($this->input->post('organisation_name'));

				if($organisation_name=='All')
				{ 
					if($division=='All')
					{
						$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$report_data = array();
						foreach ($all_org as $org)
						 {
							$sql1 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

							 $rs1 = $this->db->query($sql1);
							 $result1 = $rs1->result();

							 $rep['retirement_list']  = $result1;
							 

							  $report_data[] = $rep;
							
						 } // ends foreach
						 	
							$data['all_retirement_list']  = $report_data;
							$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
							$data['insertData'] = array(
							'from_date' 	=> xss_clean($this->input->post('from_date')),
							'to_date' 	=> xss_clean($this->input->post('to_date')),
							'division' 	=> xss_clean($this->input->post('division')),
							'organisation_name' 	=> xss_clean($this->input->post('organisation_name')),
						
							);
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/retirement/retirementlist2',$data);
							$this->load->view('admin/footer');
					}//ends divisio All

					else
					{
						$all_org = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
						$report_data = array();
						foreach ($all_org as $org)
						 {
							$sql1 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.*  FROM pensrecostatus as penstatus 
							 INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
							 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
							 WHERE penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penrecord.DIVIS_DEAL_NAME = '".$division."' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$org->ORGANIZATION_ID."' AND penrecord.DELETES = 0 AND pencontact.STATUS = 1 AND penremark.STATUS = 1";

							 $rs1 = $this->db->query($sql1);
							 $result1 = $rs1->result();

							 $rep['retirement_list']  = $result1;
							 

							  $report_data[] = $rep;
							
						 } // ends foreach
						 	
							$data['all_retirement_list']  = $report_data;
							$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
							$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));

							$data['insertData'] = array(
							'from_date' 	=> xss_clean($this->input->post('from_date')),
							'to_date' 	=> xss_clean($this->input->post('to_date')),
							'division' 	=> xss_clean($this->input->post('division')),
							'organisation_name' 	=> xss_clean($this->input->post('organisation_name')),
						
							);
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar');
							$this->load->view('admin/retirement/retirementlist2',$data);
							$this->load->view('admin/footer');
					}//ends else
					

					
				}// ends if orgn

				else
				{
					$sql1 = "SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord 
					 INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
					 INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID
					 INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
					WHERE  penrecord.DATE_RETIREMENT BETWEEN '".$from_date."' AND '".$to_date."' AND penrecord.DIVIS_DEAL_NAME = '".$division."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND  penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1"; 
					      
					$rs1 = $this->db->query($sql1);
					$result1 = $rs1->result();

					$data['retirement_list']  = $result1;
					$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
					$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
					$data['insertData'] = array(
							'from_date' 	=> xss_clean($this->input->post('from_date')),
							'to_date' 	=> xss_clean($this->input->post('to_date')),
							'division' 	=> xss_clean($this->input->post('division')),
							'organisation_name' 	=> xss_clean($this->input->post('organisation_name')),
						
							);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');
					$this->load->view('admin/retirement/retirementlist',$data);
					$this->load->view('admin/footer');
				}//ends else orgn

				
			}//ends else if 3

			
		}//ends if

		else
		{
			$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
			$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');
			$this->load->view('admin/retirement/retirementlist',$data);
			$this->load->view('admin/footer');
		} 
		
  }//ends function

		
}
