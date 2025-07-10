<?php
defined('BASEPATH') OR exit('No direct script access allowed');
error_reporting(0);

class History extends CI_Controller {

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
		$current_date =  date("Y/m/d");
		$ee = date_parse_from_format("Y-m-d", $current_date);
		$current_month = $ee["month"];
		
		$data['all_data_POPSEF']  = '';
		$data['all_data_POPSOF']  = '';
		$data['all_data_PNPSEF']  = '';
		$data['all_data_PNPSOF']  = '';
		$data['all_organisation']  = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));

		$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
		$data['organisation_name']  = 'All';
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar');	
		$this->load->view('admin/history/historylist',$data);
		$this->load->view('admin/footer');
	
	}

	/***********function for search pension records*******/

	public function search_pension()
	{
		
		$select_date  		= xss_clean($this->input->post('select_date'));
		$organisation_name 	= xss_clean($this->input->post('organisation_name'));
		
		$select_date      = str_replace('/', '-', $select_date);
		//$select_date      = date('m-d', strtotime($select_date));
		$d = explode('-',$select_date);
		
		//echo "<pre>"; print_r($d); exit;
		//$d = date_parse_from_format("Y-m-d", $select_date);
		/*$selected_month = $d[0]["month"];
		$selected_year  = $d[1]["year"];*/

		$selected_month = $d[0];
		$selected_year  = $d[1];
		

		if(isset($_REQUEST['submit'])) 
		{ 
			$all_pension = $this->Base_model->get_all_record_by_condition('pensrecoinfo',NULL);
			
			if($organisation_name =='All')
			{
				
				$cc= array();
				foreach ($all_pension as $pension)
				 {
					$tt['all_data_POPSEF']  = $this->Base_model->pensionhistory_data3($selected_month,'POPSEF',$pension->PENSION_ID,$selected_year);
					$tt['all_data_POPSOF']  = $this->Base_model->pensionhistory_data3($selected_month,'POPSOF',$pension->PENSION_ID,$selected_year);
					$tt['all_data_PNPSEF']  = $this->Base_model->pensionhistory_data3($selected_month,'PNPSEF',$pension->PENSION_ID,$selected_year);
					$tt['all_data_PNPSOF']  = $this->Base_model->pensionhistory_data3($selected_month,'PNPSOF',$pension->PENSION_ID,$selected_year);

					$pension_data_array[] = $tt;
				 }
			
			
					$popseff = array_column($pension_data_array, 'all_data_POPSEF');
					$popsoff = array_column($pension_data_array, 'all_data_POPSOF');
					$pnpseff = array_column($pension_data_array, 'all_data_PNPSEF');
					$pnpsoff = array_column($pension_data_array, 'all_data_PNPSOF');

			
					/*******popsef*****/
					
					$popsef_data = array();
					foreach ($popseff as $m1) 
			   		{
			   			$popsef_data[] = $m1[0];
			   		}
			   		

			   		/*$popsef_data = array();
					foreach ($popseff as $u1) 
					{
						foreach ($u1 as $u2) 
						{
							$popsef_data[] = $u2;
						}
						
					}*/
			   		
			   		/*******popsof*****/
			   		$popsof_data = array();
					foreach ($popsoff as $m2) 
			   		{
			   			$popsof_data[] = $m2[0];
			   		}
			   		
			   		/*$popsof_data = array();
					foreach ($popsoff as $u3) 
					{
						foreach ($u3 as $u4) 
						{
							$popsof_data[] = $u4;
						}
						
					}*/

			   		/*******pnpsef*****/
			   		$pnpsef_data = array();
					foreach ($pnpseff as $m3) 
			   		{
			   			$pnpsef_data[] = $m3[0];
			   		}

			   	/*	$pnpsef_data = array();
					foreach ($pnpseff as $u5) 
					{
						foreach ($u5 as $u6) 
						{
							$pnpsef_data[] = $u6;
						}
						
					}*/

			   		/*******pnpsof*****/

			   		$pnpsof_data = array();
					foreach ($pnpsoff as $m4) 
			   		{
			   			$pnpsof_data[] = $m4[0];
			   		}

			   		/*$pnpsof_data = array();
					foreach ($pnpsoff as $u7) 
					{
						foreach ($u7 as $u8) 
						{
							$pnpsof_data[] = $u8;
						}
						
					}
		*/
					$data['all_data_POPSEF']  = array_filter($popsef_data);
					$data['all_data_POPSOF']  = array_filter($popsof_data);
					$data['all_data_PNPSEF']  = array_filter($pnpsef_data);
					$data['all_data_PNPSOF']  = array_filter($pnpsof_data);
					$data['selected_year']    = $selected_year;
					$data['selected_month']  = $selected_month;
					
					$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));

					$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
					$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));
					
					$data['insertData'] = array(
							'select_date' 	=> xss_clean($this->input->post('select_date')),
							'organisation_name' 	=> xss_clean($this->input->post('organisation_name')),	
						);
					/*$data['organisation_name']  = $orgnstion->ORGNAME;*/
					$data['organisation_name']  = 'All';
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');	
					$this->load->view('admin/history/historylist',$data);
					$this->load->view('admin/footer');
			}//ends if condotion
			
			else
			{

				$cc= array();
				foreach ($all_pension as $pension)
				 {
					$tt['all_data_POPSEF']  = $this->Base_model->pensionhistory_data6($selected_month,'POPSEF',$pension->PENSION_ID,$selected_year,$organisation_name);
					$tt['all_data_POPSOF']  = $this->Base_model->pensionhistory_data6($selected_month,'POPSOF',$pension->PENSION_ID,$selected_year,$organisation_name);
					$tt['all_data_PNPSEF']  = $this->Base_model->pensionhistory_data6($selected_month,'PNPSEF',$pension->PENSION_ID,$selected_year,$organisation_name);
					$tt['all_data_PNPSOF']  = $this->Base_model->pensionhistory_data6($selected_month,'PNPSOF',$pension->PENSION_ID,$selected_year,$organisation_name);

					$pension_data_array[] = $tt;
				 }
			
			
					$popseff = array_column($pension_data_array, 'all_data_POPSEF');
					$popsoff = array_column($pension_data_array, 'all_data_POPSOF');
					$pnpseff = array_column($pension_data_array, 'all_data_PNPSEF');
					$pnpsoff = array_column($pension_data_array, 'all_data_PNPSOF');

			
					/*******popsef*****/
					
					$popsef_data = array();
					foreach ($popseff as $m1) 
			   		{
			   			$popsef_data[] = $m1[0];
			   		}
			   		

			   		/*$popsef_data = array();
					foreach ($popseff as $u1) 
					{
						foreach ($u1 as $u2) 
						{
							$popsef_data[] = $u2;
						}
						
					}*/
			   		
			   		/*******popsof*****/
			   		$popsof_data = array();
					foreach ($popsoff as $m2) 
			   		{
			   			$popsof_data[] = $m2[0];
			   		}
			   		
			   		/*$popsof_data = array();
					foreach ($popsoff as $u3) 
					{
						foreach ($u3 as $u4) 
						{
							$popsof_data[] = $u4;
						}
						
					}*/

			   		/*******pnpsef*****/
			   		$pnpsef_data = array();
					foreach ($pnpseff as $m3) 
			   		{
			   			$pnpsef_data[] = $m3[0];
			   		}

			   	/*	$pnpsef_data = array();
					foreach ($pnpseff as $u5) 
					{
						foreach ($u5 as $u6) 
						{
							$pnpsef_data[] = $u6;
						}
						
					}*/

			   		/*******pnpsof*****/

			   		$pnpsof_data = array();
					foreach ($pnpsoff as $m4) 
			   		{
			   			$pnpsof_data[] = $m4[0];
			   		}

			   		/*$pnpsof_data = array();
					foreach ($pnpsoff as $u7) 
					{
						foreach ($u7 as $u8) 
						{
							$pnpsof_data[] = $u8;
						}
						
					}
		*/
					$data['all_data_POPSEF']  = array_filter($popsef_data);
					$data['all_data_POPSOF']  = array_filter($popsof_data);
					$data['all_data_PNPSEF']  = array_filter($pnpsef_data);
					$data['all_data_PNPSOF']  = array_filter($pnpsof_data);
					
					$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));

					$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
					$orgnstion = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $organisation_name));

					$data['insertData'] = array(
							'select_date' 	=> xss_clean($this->input->post('select_date')),
							'organisation_name' 	=> xss_clean($this->input->post('organisation_name')),	
						);
					$data['selected_year']    = $selected_year;
					$data['selected_month']  = $selected_month;

					$data['organisation_name']  = $orgnstion->ORGNAME;
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar');	
					$this->load->view('admin/history/historylist',$data);
					$this->load->view('admin/footer');	
			}//ends else condtion
			
			
		}//ends if

		else
		{
			$current_date =  date("Y/m/d");
			$ee = date_parse_from_format("Y-m-d", $current_date);
			$current_month = $ee["month"];
			
			$data['all_data_POPSEF']  = '';
			$data['all_data_POPSOF']  = '';
			$data['all_data_PNPSEF']  = '';
			$data['all_data_PNPSOF']  = '';
			$data['all_organisation'] = $this->Base_model->get_all_record_by_condition('organization', array('delete_status'=>'0'));

			$data['all_division'] = $this->Base_model->get_all_record_by_condition('division', array('status'=>'1'));
			$data['organisation_name']  = 'All';
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar');	
			$this->load->view('admin/history/historylist',$data);
			$this->load->view('admin/footer');
		} 
		
  }//ends function


}
