<?php

error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');



class Applicant_admin extends CI_Controller {



	// Initialize Constructor Here

	function __construct()

	{

		parent::__construct();

	    $this->load->model('Base_model');

	    $admindata = $this->Base_model->get_record_by_id('tbl_admin', array('id' =>$this->session->userdata('auser_id')));

		if(empty($this->session->userdata('auser_id')))

         {

         	$base_url = base_url().'Frontend/logout';

             redirect($base_url);

         } 

         if($admindata->password != $this->session->userdata('apwd'))

		 {

		 	 $base_url = base_url().'Frontend/logout';

		     redirect($base_url);

		 }

	}

	/**

	 * Index Page for this controller.

	 */

	public function index()

	{
		$segment_id = $this->uri->segment('3');

		$type = array(1,2,3);

		$uri = $this->session->userdata('auser_type');

		if(!in_array($uri,$type))
		{
			
			$base_url = base_url();

			redirect($base_url.'Frontend/logout');

		} 

		else
		{
				$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

				$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

							$this->load->view('mainadmin/header');

				$data['all_applicant_data'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info',NULL);

				$this->load->view('mainadmin/header');

				$this->load->view('mainadmin/sidebar');

				$this->load->view('mainadmin/applicants/applicantslist',$data);

				$this->load->view('mainadmin/footer');

		}//ends else ssession check

	}//ends function



	/**********function for view job*******/



	public function view_job()

	{

			$uri = $this->uri->segment('3');

			$job_id = $uri;

			$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($job_id);

			$data['region_data'] = $this->Base_model->get_record_by_id('tbl_region', array('id' => $all_job_data[0]->region_id));

			$data['circle_data'] = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $all_job_data[0]->circle_id));

			$data['post_data'] = $this->Base_model->get_record_by_id('tbl_post', array('id' => $all_job_data[0]->post_id));

			$data['job_data'] = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $all_job_data[0]->job_id));

			$data['present_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->present_address_state));

			$data['permanent_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->permanent_address_state));

			$this->load->view('mainadmin/header');

			$this->load->view('mainadmin/sidebar');

			$this->load->view('mainadmin/applicants/view_job',$data);

			$this->load->view('mainadmin/footer');

	}// ends function



	/*************function for edit job***********/



	public function edit_job()

	{
		$segment_id = $this->uri->segment('4');

			$session_id = $this->session->userdata('auser_id');

			if($session_id!=$segment_id)
			{
				$base_url = base_url();
				redirect($base_url.'Frontend/logout');
			}

			else
			{
						$uri = $this->uri->segment('3');

			if(isset($_REQUEST['submit'])) 

			{
				$job_status  		= xss_clean($this->input->post('job_status'));

				$this->form_validation->set_rules('job_status','Job Status','trim|required');

				if($this->form_validation->run() === false) 

				{

					$uri = $this->uri->segment('3');

					$job_id = $uri;

						$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($job_id);

						$data['region_data'] = $this->Base_model->get_record_by_id('tbl_region', array('id' => $all_job_data[0]->region_id));

						$data['circle_data'] = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $all_job_data[0]->circle_id));

						$data['post_data'] = $this->Base_model->get_record_by_id('tbl_post', array('id' => $all_job_data[0]->post_id));

						$data['job_data'] = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $all_job_data[0]->job_id));

						$data['present_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->present_address_state));

						$data['permanent_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->permanent_address_state));

						$this->load->view('mainadmin/header');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/applicants/edit_job',$data);

						$this->load->view('mainadmin/footer');

				}//ends if



				else

				{

						

						$uri = $this->uri->segment('3');

						$job_status  		= xss_clean($this->input->post('job_status'));

						$created_date =  date("Y-m-d H:i:s");

						$update_data = array(

																'job_status' => $job_status,

																'updated_date'		=> $created_date);

						$updateid = $this->Base_model->update_record_by_id('tbl_app_job_bas_info', $update_data, array('id'=> $uri));



						if($updateid)

										{

											$msg = "Job updated successfully.";

											$this->session->set_flashdata('flashSuccess_circular',$msg);

												/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,updated job successfully',
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 /*********ends logs code*******/

											$job_id = $uri;

											$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

											$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

														$this->load->view('mainadmin/header');

											$data['all_applicant_data'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info',NULL);



											$this->load->view('mainadmin/header');

											$this->load->view('mainadmin/sidebar');

											$this->load->view('mainadmin/applicants/applicantslist',$data);

											$this->load->view('mainadmin/footer');		

										}



										else

										{

											$msg = "Fail to update job.";

											$this->session->set_flashdata('flashError_circular', $msg);

											/*********logs code*******/

													date_default_timezone_set('Asia/Calcutta'); 
													$created_date =  date("Y-m-d H:i:s");
													$user_logs_data = array(
																	'USERNAME' 	    => $this->session->userdata('ausername'),
																	'ROLE'			=> $this->session->userdata('auser_type'),
																	'USEREMAIL' 	=> $this->session->userdata('aemail'),
																	'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
																	'LOGINSTATUS' 	=> 'Logged in',
																	'ACTIVITY' 		=> $this->session->userdata('ausername').' ,failed to update job ',
																	'ACTIVITYTIME'  => time(),
																	'CREATEDDATED'  => $created_date
																	
																);

											$this->Base_model->insert_one_row('userlogs', $user_logs_data);

				 /*********ends logs code*******/
										

											$job_id = $uri;

											$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($job_id);

											$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

											$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

														$this->load->view('mainadmin/header');

											$data['all_applicant_data'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info',NULL);

											$this->load->view('mainadmin/header');

											$this->load->view('mainadmin/sidebar');

											$this->load->view('mainadmin/applicants/applicantslist',$data);

											$this->load->view('mainadmin/footer');	

										}

				}

			}//ends if

			else

			{

						$uri = $this->uri->segment('3');

						$job_id = $uri;

						$data['all_job_data'] = $all_job_data =  $this->Base_model->all_job_data($job_id);

						$data['region_data'] = $this->Base_model->get_record_by_id('tbl_region', array('id' => $all_job_data[0]->region_id));

						$data['circle_data'] = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $all_job_data[0]->circle_id));

						$data['post_data'] = $this->Base_model->get_record_by_id('tbl_post', array('id' => $all_job_data[0]->post_id));

						$data['job_data'] = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $all_job_data[0]->job_id));

						$data['present_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->present_address_state));

						$data['permanent_state'] = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $all_job_data[0]->permanent_address_state));

						$this->load->view('mainadmin/header');

						$this->load->view('mainadmin/sidebar');

						$this->load->view('mainadmin/applicants/edit_job',$data);

						$this->load->view('mainadmin/footer');

			}//ends else
			
			}//ends else session check


	

		

	}// ends function



	/*******function for applicant search******/



	public function search_applicant()

	{

		

		$applicant_name  	= xss_clean($this->input->post('applicant_name'));

		$post_name  			= xss_clean($this->input->post('post_name'));

		$caste_category  	= xss_clean($this->input->post('caste_category'));

		$ex_serviceman  	= xss_clean($this->input->post('ex_serviceman'));



		if(empty($applicant_name) && empty($post_name) && empty($caste_category) && empty($ex_serviceman))

				{

					

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

								$this->load->view('mainadmin/header');

					$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

					$data['all_applicant_data'] = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info',NULL);

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/applicants/applicantslist',$data);

					$this->load->view('mainadmin/footer');

				}//ends if



				else

				{

					

					$data['all_regions'] = $this->Base_model->get_all_record_by_condition('tbl_region', array('status'=>'1'));

					$data['all_post'] 	 = $this->Base_model->get_all_record_by_condition('tbl_post', array('status'=>'1'));

					$data['all_jobs'] 	 = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('status'=>'1'));

					$this->load->view('mainadmin/header');

					$data['all_applicant_data'] = $this->Base_model->searching_applicant($applicant_name,$post_name,$caste_category,$ex_serviceman);

					$this->load->view('mainadmin/header');

					$this->load->view('mainadmin/sidebar');

					$this->load->view('mainadmin/applicants/applicantslist',$data);

					$this->load->view('mainadmin/footer');



				}//ends else

	}// function ends



	/********Send bulk sms*****/



	public function bulk_sms()

	{

			$data = '';

			$this->load->view('mainadmin/header');

			$this->load->view('mainadmin/sidebar');

			$this->load->view('mainadmin/applicants/bulksms',$data);

			$this->load->view('mainadmin/footer');



	}//ends function

//To generate the Excel Report

	Public function Excel()
	{

		date_default_timezone_set('Asia/calcutta');

		$this->load->library('excel');
		$this->excel->setActiveSheetIndex(0);
        //name the worksheet
		$this->excel->getActiveSheet()->setTitle('Applicant');
        //set cell A1 content with some text
		$this->excel->getActiveSheet()->setCellValue('A1', 'Applicant List');

		$this->excel->getActiveSheet()->setCellValue('A2', 'Refrence No');
		$this->excel->getActiveSheet()->setCellValue('B2', 'Region Name');
		$this->excel->getActiveSheet()->setCellValue('C2', 'Circle Name');
		$this->excel->getActiveSheet()->setCellValue('D2', 'Job Title');
		$this->excel->getActiveSheet()->setCellValue('E2', 'Post Name');
		$this->excel->getActiveSheet()->setCellValue('F2', 'Post Code');
		$this->excel->getActiveSheet()->setCellValue('G2', 'Full Name');
		$this->excel->getActiveSheet()->setCellValue('H2', 'Father Name');
		$this->excel->getActiveSheet()->setCellValue('I2', 'Email');
		$this->excel->getActiveSheet()->setCellValue('J2', 'Mobile No');
		$this->excel->getActiveSheet()->setCellValue('K2', 'DOB');
		$this->excel->getActiveSheet()->setCellValue('L2', 'DOB');
		$this->excel->getActiveSheet()->setCellValue('M2', 'Matriculation Name');
		$this->excel->getActiveSheet()->setCellValue('N2', 'Board Name');
		$this->excel->getActiveSheet()->setCellValue('O2', 'Passing Year');
		$this->excel->getActiveSheet()->setCellValue('P2', 'Total Marks');
		$this->excel->getActiveSheet()->setCellValue('Q2', 'Marks Obtained');
		$this->excel->getActiveSheet()->setCellValue('R2', 'Percentage');
		$this->excel->getActiveSheet()->setCellValue('S2', 'Other Board Name');
		$this->excel->getActiveSheet()->setCellValue('T2', 'Passing Year');
		$this->excel->getActiveSheet()->setCellValue('U2', 'Total Marks');
		$this->excel->getActiveSheet()->setCellValue('V2', 'Marks Obtained');
		$this->excel->getActiveSheet()->setCellValue('W2', 'Percentage');
		$this->excel->getActiveSheet()->setCellValue('X2', 'Other Board Name');
		$this->excel->getActiveSheet()->setCellValue('Y2', 'Passing Year');
		$this->excel->getActiveSheet()->setCellValue('Z2', 'Total Marks');
		$this->excel->getActiveSheet()->setCellValue('AA2', 'Marks Obtained');
		$this->excel->getActiveSheet()->setCellValue('AB2', 'Percentage');
		$this->excel->getActiveSheet()->setCellValue('AC2', 'Other Board Name');
		$this->excel->getActiveSheet()->setCellValue('AD2', 'Passing Year');
		$this->excel->getActiveSheet()->setCellValue('AE2', 'Total Marks');
		$this->excel->getActiveSheet()->setCellValue('AF2', 'Marks Obtained');
		$this->excel->getActiveSheet()->setCellValue('AG2', 'Percentage');
		$this->excel->getActiveSheet()->setCellValue('AH2', 'Caste Category');
		$this->excel->getActiveSheet()->setCellValue('AI2', 'Religion');
		$this->excel->getActiveSheet()->setCellValue('AJ2', 'Martial Status');
		$this->excel->getActiveSheet()->setCellValue('AK2', 'Nationality');
		$this->excel->getActiveSheet()->setCellValue('AL2', 'Aadhar No');
		$this->excel->getActiveSheet()->setCellValue('AM2', 'Ex-Serviceman');
		$this->excel->getActiveSheet()->setCellValue('AN2', 'Physical Fitness');
		$this->excel->getActiveSheet()->setCellValue('AO2', 'Employment Registration No.');
		$this->excel->getActiveSheet()->setCellValue('AP2', 'Physically Handicapp');
		$this->excel->getActiveSheet()->setCellValue('AQ2', 'Present Address');
		$this->excel->getActiveSheet()->setCellValue('AR2', 'Present Address State');
		$this->excel->getActiveSheet()->setCellValue('AS2', 'Present Address City');
		$this->excel->getActiveSheet()->setCellValue('AT2', 'Present Address Pincode');
		$this->excel->getActiveSheet()->setCellValue('AU2', 'Permanent Address');
		$this->excel->getActiveSheet()->setCellValue('AV2', 'Permanent Address State');
		$this->excel->getActiveSheet()->setCellValue('AW2', 'Permanent Address City');
		$this->excel->getActiveSheet()->setCellValue('AX2', 'Permanent Address Pincode');
		$this->excel->getActiveSheet()->setCellValue('AY2', 'Working Experience');
		$this->excel->getActiveSheet()->setCellValue('AZ2', 'Apply Date');
	
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
		$sql = "SELECT basic.id as basic_info_id,region.region_name as region_name,circle.circle_name as circle_name,jobs.job_title as job_title,post.post_name as post_name,post.post_code as post_code,basic.full_name as full_name,basic.father_name as father_name,basic.email as email,basic.mobile_no as mobile_no,basic.dob as dob,basic.gender as gender,education.highschool_metriculation as highschool_metriculation,education.highschool_board_name as highschool_board_name,education.highschool_passing_year as highschool_passing_year,education.highschool_total_marks as highschool_total_marks,education.highschool_marks_obtained as highschool_marks_obtained,education.highschool_percentage as highschool_percentage,education.graduation_board_name as graduation_board_name,education.graduation_passing_year as graduation_passing_year,education.graduation_total_marks as graduation_total_marks,education.graduation_marks_obtained as graduation_marks_obtained,education.graduation_percentage as graduation_percentage,education.post_graduation_board_name as post_graduation_board_name,education.post_graduation_passing_year as post_graduation_passing_year,education.post_graduation_total_marks as post_graduation_total_marks,education.post_graduation_marks_obtained as post_graduation_marks_obtained,education.post_graduation_percentage as post_graduation_percentage,education.others_board_name as others_board_name,education.others_passing_year as others_passing_year,education.others_total_marks as others_total_marks,education.others_marks_obtained as others_marks_obtained,education.others_percentage as others_percentage,other.caste_category as caste_category,other.religion as religion,other.marital_status as marital_status,other.nationality as nationality,other.aadhar_no as aadhar_no,other.ex_serviceman as ex_serviceman,other.physical_fitness as physical_fitness,other.employment_exchange_reg_no as employment_exchange_reg_no,other.physically_handicapp as physically_handicapp,other.present_address as present_address,other.present_address_state as present_address_state,other.present_address_city as present_address_city,other.present_address_pincode as present_address_pincode,other.permanent_address as permanent_address,other.permanent_address_state as permanent_address_state,other.permanent_address_city as permanent_address_city,other.permanent_address_pincode as permanent_address_pincode,document.working_experience as working_experience,basic.created_date as apply_date FROM tbl_app_job_bas_info as basic INNER JOIN tbl_app_job_edu_info as education ON education.basic_info_id = basic.id INNER JOIN tbl_app_job_oth_info as other ON other.basic_info_id = basic.id INNER JOIN tbl_app_job_doc_info as document ON document.basic_info_id = basic.id INNER JOIN tbl_region as region ON region.id = basic.region_id INNER JOIN tbl_circle as circle ON circle.id = basic.circle_id INNER JOIN tbl_jobs as jobs ON jobs.id = basic.job_id INNER JOIN tbl_post as post ON post.id = basic.post_id";        
		$rs = $this->db->query($sql);
//        $rs = $this->db->get('countries');
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


                $filename='Applicant_List-'.date('d/m/y').'.xls'; //save our workbook as this file name
                header('Content-Type: application/vnd.ms-excel'); //mime type
                header('Content-Disposition: attachment;filename="'.$filename.'"'); //tell browser what's the file name
                header('Cache-Control: max-age=0'); //no cache

                //save it to Excel5 format (excel 2003 .XLS file), change this to 'Excel2007' (and adjust the filename extension, also the header mime type)
                //if you want to save it as .XLSX Excel 2007 format
                $objWriter = PHPExcel_IOFactory::createWriter($this->excel, 'Excel5');  
                //force user to download the Excel file without writing it to server's HD
                $objWriter->save('php://output');


            }
	







	

}//class ends

