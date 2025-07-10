<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Solvecomplain extends CI_Controller {

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
			   	
	}
	
	public function index()
	{

		$aa = array();
		
		$complaincat = $this->Base_model->get_all_record_by_condition('category',array('service_type'=>1,'delete_status'=>'1'));
		
		$complain_list = $this->Base_model->get_all_record_by_condition('complaint',array('service_type'=>1,'delete_status'=>'1'));
		
		foreach($complain_list as $complain){
			
		    $category = $this->Base_model->get_record_by_id('category',array('category_id' =>$complain->complaint_type_id));
		
		    $building = $this->Base_model->get_record_by_id('building',array('building_id' =>$complain->building_id));
		
		    $designation = $this->Base_model->get_record_by_id('designation',array('designation_id' =>$complain->designation_id));
				
			$gg['complaint_id']        = $complain->complaint_id;
			$gg['category_name']       = $category->category_name;
			$gg['building_name']       = $building->building_name;
			$gg['name']                = $complain->name;
			$gg['status']              = $complain->status;
			$gg['designation']         = $designation->designation_name;
			$gg['remarks']              = $complain->remarks;
			$gg['complain_solution']   = $complain->complain_solution;
			$gg['complain_date']       = $complain->date_created;
			$gg['resolved_on']         = $complain->date_resloved;
			$aa[] = $gg;
			
		}
		
		$data['complain_list'] = $aa;

		//echo '<pre>'; print_r($aa); exit;
		
		$data['complain_type'] = $complaincat;
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-asset');
		$this->load->view('admin/itcomplain_management/solvecomplainlist',$data);
		$this->load->view('admin/footer');
	
	}
	
	
	
	public function resolvecomplain(){
		
		$uri = $this->uri->segment('4'); 
		
		if(isset($_REQUEST['submit'])) 
		{

			//echo '<pre>'; print_r($_REQUEST); exit;
			
			$category        = xss_clean(strip_tags($this->input->post('category')));
			$description     = xss_clean(strip_tags($this->input->post('description')));
			$building        = xss_clean(strip_tags($this->input->post('building')));
			$roomno          = xss_clean(strip_tags($this->input->post('room')));
			$empname         = xss_clean(strip_tags($this->input->post('empname')));
			$designation     = xss_clean(strip_tags($this->input->post('designation')));
			$mobile_no       = xss_clean(strip_tags($this->input->post('mobile_no')));
			$landline_no     = xss_clean(strip_tags($this->input->post('landline_no')));
			$intercom        = xss_clean(strip_tags($this->input->post('intercom')));
			$solution        = xss_clean(strip_tags($this->input->post('solution')));
			
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('description','description','trim|required');
			$this->form_validation->set_rules('building','building','trim|required');
			$this->form_validation->set_rules('room','room','trim|required');
			$this->form_validation->set_rules('empname','empname','trim|required');
			$this->form_validation->set_rules('designation','designation','trim|required');
			$this->form_validation->set_rules('mobile_no','mobile_no','trim|required');
			$this->form_validation->set_rules('landline_no','landline_no','trim|required');
			$this->form_validation->set_rules('solution','solution','trim|required');

			if($this->form_validation->run() === false) 
			{
				$data['complain_type'] = $this->Base_model->get_all_record_by_condition('category',array('status'=>'1','delete_status'=>'1','service_type'=>1));

	
				$data['complain_detail'] = $comp_det = $this->Base_model->get_record_by_id('complaint',array('complaint_id' =>$uri));

				 $data['designation'] = $this->Base_model->get_record_by_id('designation',array('status'=>'1','delete_status'=>'1','designation_id'=>$comp_det->designation_id));
				
				$data['building'] =$building= $this->Base_model->get_record_by_id('building',array('status'=>'1','delete_status'=>'1','building_id'=>$comp_det->building_id));
				
				$data['room'] = $this->Base_model->get_record_by_id('room_no',array('status'=>'1','delete_status'=>'1','room_id'=>$comp_det->room_id));

				$history = $this->Base_model->get_all_record_by_condition('complaint_comment',array('status'=>'1','delete_status'=>'1','service_type'=>1,'complaint_id'=>$uri));


	            foreach($history as $comment_history){

	                   $name = $this->Base_model->get_record_by_id('users',array('user_id' =>$comment_history->user_id));

	                   $gg['name']    = $name->user_name;

	                   $gg['comment'] = $comment_history->comment;

	                   $aa[]=$gg;

	            }

	            $data['comment_history'] = $aa;
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-asset');
				$this->load->view('admin/itcomplain_management/resolvecomplain',$data);
				$this->load->view('admin/footer');
						

			} else
				{
				 date_default_timezone_set('Asia/Calcutta'); 
				 $created_date =  date("Y-m-d H:i:s"); 
			     $uri = $this->uri->segment('4');	

			     $complain_detail = $this->Base_model->get_record_by_id('complaint',array('complaint_id' =>$uri));

			      if($complain_detail->status=='Pending'){

						 $status = 'Inprogress';

					} else {
		                
		                $status = $complain_detail->status;

					}
				 
					  $update_data = array(
								'user_id' 	            => $complain_detail->user_id,
								'vendor_id' 	        => $complain_detail->user_id,
								'complaint_type_id' 	=> $category,
								'complaint_sub_type_id' => $category,
								'building_id' 	        => $building,
								'room_id' 	            => $roomno,
								'designation_id' 	    => $designation,
								'name' 	                => $empname,
								'mobile_no' 	        => $mobile_no,
								'landline_no' 	        => $landline_no,
								'description' 	        => $description,
								'intercom' 	            => $intercom,
								'date_created' 	        => $complain_detail->date_created,
								'date_resloved' 	    => $created_date,
								'ref_no' 	            => NULL,
								'remarks' 	            => $complain_detail->remarks,
								'complain_rating'       => $complain_detail->complain_rating,
								'status' 	            => $status,
								'service_type'          => 1,
								'delete_status' 	    => 1,
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							);
							
						$updateid = $this->Base_model->update_record_by_id('complaint', $update_data,array('complaint_id'=> $uri));


						  $insert_data = array(
								'user_id' 	            => $this->session->userdata('user_id'),
								'complaint_id' 	        => $uri,
								'comment' 	            => $solution,
								'status' 	            => 1,
								'service_type'          => 1,
								'delete_status' 	    => 1,
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							);

						$insertid = $this->Base_model->insert_one_row('complaint_comment', $insert_data);

						if($insertid)
						{
							$msg = "Solution has provided successfully.";
							$this->session->set_flashdata('flashSuccess_complain',$msg);
							
							/*********logs code*******/
								
								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' solution provided successfully to : '.$complain_detail->name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

						$data['complain_list'] = $this->Base_model->get_all_record_by_condition('complaint',array('delete_status'=>'1'));
							
							redirect('itcomplaint/solvecomplain',$data);
						}

						else
						{
							
						  $msg = "Fail to provide solution";
						  $this->session->set_flashdata('flashError_complain', $msg);
						  
						  /*********logs code*******/
								
								date_default_timezone_set('Asia/Calcutta'); 
								$created_date =  date("Y-m-d H:i:s");
								$user_logs_data = array(
												'USERNAME' 	    => $this->session->userdata('user_name'),
												'ROLE'			=> '',
												'USEREMAIL' 	=> $this->session->userdata('user_email'),
												'CLIENT_IP' 	=> $_SERVER['REMOTE_ADDR'],
												'LOGINSTATUS' 	=> 'Logged in',
												'ACTIVITY' 		=> $this->session->userdata('user_name').' fail to provide solution to : '.$complain_detail->name,
												'ACTIVITYTIME'  => time(),
												'CREATEDDATED'  => $created_date
												
											);

								$this->Base_model->insert_one_row('userlogs', $user_logs_data);

							/*********ends logs code*******/

						$uri = $this->uri->segment('4'); 
			
						$data['complain_type'] = $this->Base_model->get_all_record_by_condition('category',array('status'=>'1','delete_status'=>'1','service_type'=>1));

			
						$data['complain_detail'] = $comp_det = $this->Base_model->get_record_by_id('complaint',array('complaint_id' =>$uri));

						 $data['designation'] = $this->Base_model->get_record_by_id('designation',array('status'=>'1','delete_status'=>'1','designation_id'=>$comp_det->designation_id));
						
						$data['building'] =$building= $this->Base_model->get_record_by_id('building',array('status'=>'1','delete_status'=>'1','building_id'=>$comp_det->building_id));
						
						$data['room'] = $this->Base_model->get_record_by_id('room_no',array('status'=>'1','delete_status'=>'1','room_id'=>$comp_det->room_id));

						$history = $this->Base_model->get_all_record_by_condition('complaint_comment',array('status'=>'1','delete_status'=>'1','service_type'=>1,'complaint_id'=>$uri));



			            foreach($history as $comment_history){

			                   $name = $this->Base_model->get_record_by_id('users',array('user_id' =>$comment_history->user_id));

			                   $gg['name']    = $name->user_name;

			                   $gg['comment'] = $comment_history->comment;

			                   $aa[]=$gg;

			            }

			            $data['comment_history'] = $aa;
						
						
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-asset');
						$this->load->view('admin/itcomplain_management/resolvecomplain',$data);
						$this->load->view('admin/footer');
						
					}
					
				}

		} else {
			
			$uri = $this->uri->segment('4'); 

			$data['complain_type'] = $this->Base_model->get_all_record_by_condition('category',array('status'=>'1','delete_status'=>'1','service_type'=>1));

			
			$data['complain_detail'] = $comp_det = $this->Base_model->get_record_by_id('complaint',array('complaint_id' =>$uri));

			 $data['designation'] = $this->Base_model->get_record_by_id('designation',array('status'=>'1','delete_status'=>'1','designation_id'=>$comp_det->designation_id));
			
			$data['building'] =$building= $this->Base_model->get_record_by_id('building',array('status'=>'1','delete_status'=>'1','building_id'=>$comp_det->building_id));
			
			$data['room'] = $this->Base_model->get_record_by_id('room_no',array('status'=>'1','delete_status'=>'1','room_id'=>$comp_det->room_id));

			 $history = $this->Base_model->get_all_record_by_condition('complaint_comment',array('status'=>'1','delete_status'=>'1','service_type'=>1,'complaint_id'=>$uri));



            foreach($history as $comment_history){

                   $name = $this->Base_model->get_record_by_id('users',array('user_id' =>$comment_history->user_id));

                   $gg['name']    = $name->user_name;

                   $gg['comment'] = $comment_history->comment;

                   $aa[]=$gg;

            }

            $data['comment_history'] = $aa;
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-asset');
			$this->load->view('admin/itcomplain_management/resolvecomplain',$data);
			$this->load->view('admin/footer');
			
		}
		
	}
	


	public function viewcomplain(){
		
			$uri = $this->uri->segment('4'); 
			
			$data['complain_category'] = $this->Base_model->get_all_record_by_condition('category',array('status'=>'1','delete_status'=>'1','service_type'=>1));

			
			$data['complain_detail'] = $comp_det = $this->Base_model->get_record_by_id('complaint',array('complaint_id' =>$uri));

			 $data['designation'] = $this->Base_model->get_record_by_id('designation',array('status'=>'1','delete_status'=>'1','designation_id'=>$comp_det->designation_id));
			
			$data['building'] =$building= $this->Base_model->get_record_by_id('building',array('status'=>'1','delete_status'=>'1','building_id'=>$comp_det->building_id));
			
			$data['room'] = $this->Base_model->get_record_by_id('room_no',array('status'=>'1','delete_status'=>'1','room_id'=>$comp_det->room_id));
			

             $history = $this->Base_model->get_all_record_by_condition('complaint_comment',array('status'=>'1','delete_status'=>'1','service_type'=>1,'complaint_id'=>$uri));



            foreach($history as $comment_history){

                   $name = $this->Base_model->get_record_by_id('users',array('user_id' =>$comment_history->user_id));

                   $gg['name']    = $name->user_name;

                   $gg['comment'] = $comment_history->comment;

                   $aa[]=$gg;

            }

            $data['comment_history'] = $aa;


			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-asset');
			$this->load->view('admin/itcomplain_management/viewsolvecomplain',$data);
			$this->load->view('admin/footer');
			
	}
		
	
	
	
	public function get_roomno(){
		
		 $id = xss_clean(strip_tags($this->input->post('building_id')));
		 
		 $roomno = $this->Base_model->get_all_record_by_condition('room_no',array('building_id' =>$id,'status'=>1,'delete_status'=>1));
	
		 $all_rooms = json_encode($roomno);
		 
		 echo $all_rooms;
		
	}
	
	
	public function searchcomplain(){
		
		if(isset($_REQUEST['submit'])){
			
			$category = xss_clean(strip_tags($this->input->post('category')));
			$status = xss_clean(strip_tags($this->input->post('status')));
			
			$complain_list = $this->Stationary_model->search_complain($category,$status);

		$complaincat = $this->Base_model->get_all_record_by_condition('category',array('status'=>'1','delete_status'=>'1','service_type'=>1));
		
		foreach($complain_list as $complain){
			
			$category = $this->Base_model->get_record_by_id('category',array('category_id' =>$complain->complaint_type_id));
		
		   $building = $this->Base_model->get_record_by_id('building',array('building_id' =>$complain->building_id));
		
		   $designation = $this->Base_model->get_record_by_id('designation',array('designation_id' =>$complain->designation_id));
				
				$gg['complaint_id']         = $complain->complaint_id;
				$gg['category_name']        = $category->category_name;
				$gg['building_name']        = $building->building_name;
				$gg['name']                 = $complain->name;
				$gg['status']               = $complain->status;
				$gg['designation']          = $designation->designation_name;
				$gg['remarks']              = $complain->remarks;
				$gg['complain_solution']    = $complain->complain_solution;
				$gg['complain_date']        = $complain->date_created;
				$gg['resolved_on']          = $complain->date_resloved;
				$aa[] = $gg;
			
		}
		
			$data['complain_list'] = $aa;
			
			$data['complain_type'] = $complaincat;
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-asset');
			$this->load->view('admin/itcomplain_management/complainlist',$data);
			$this->load->view('admin/footer');
		
		}
		
	}
	
	
}
