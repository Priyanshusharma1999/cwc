<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recievehandover extends CI_Controller {

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
		
		$data['rechandover_list'] = $this->Base_model->get_all_record_by_condition('handover',array('service_type'=>'2','otp_status'=>'0'));

		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-stationary');
		$this->load->view('admin/stationary_management/recievehandover/recievehandoverlist',$data);
		$this->load->view('admin/footer');
	
	}

	
	public function Accepthandover(){

		$uri = $this->uri->segment('4'); 
		
		if(isset($_REQUEST['submit'])) 
		{	
			
			$remarks     = xss_clean($this->input->post('aremarks'));

			//echo $remarks; exit;

			$hdata = $this->Base_model->get_record_by_id('handover',array('handover_id'=>$uri));
						 
			date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s"); 

            $otp = rand(1000,9999);

			 $update_data = array(
								'handover_user' 	    => $hdata->handover_user,
								'reciever_user' 	    => $hdata->reciever_user,
								'handover_otp' 	        => $otp,
								'accept_remark' 	    => $remarks,
								'hand_remarks' 	        => $hdata->hand_remarks,
								'otp_status' 	        => '0',
								'service_type'          => '2',
								'updated_date'   	    => $created_date
							);

			   $updateid = $this->Base_model->update_record_by_id('handover', $update_data, array('handover_id'=>$uri));

				if($updateid)
				{

					$urdet = $this->Base_model->get_record_by_id('users',array('user_id' => $hdata->handover_user)); 

					$this->otpfunction($urdet->contact_no,$otp);

					$msg = "Item handover successfully.";
					$this->session->set_flashdata('flashSuccess_item',$msg);
					
					redirect('onlinestationary/Recievehandover');

				}

				else
				{
					$msg = "Fail to handover Item";
					$this->session->set_flashdata('flashError_item', $msg);

					 $data['items_list'] = $this->Base_model->get_all_record_by_condition('handover_items',array('handover_id'=>$uri));

				    $this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary');
					$this->load->view('admin/stationary_management/recievehandover/accepthand',$data);
					$this->load->view('admin/footer');

				}
		}
				

		else
		{
			
		 $data['items_list'] = $this->Base_model->get_all_record_by_condition('handover_items',array('handover_id'=>$uri));
		     
		    $this->load->view('admin/header');
			$this->load->view('admin/sidebar-stationary');
			$this->load->view('admin/stationary_management/recievehandover/accepthand',$data);
			$this->load->view('admin/footer');

		}
		
	}


	

	public function viewitems()
	{
		
		$uri = $this->uri->segment('4'); 
		
		$data['items_list'] = $this->Base_model->get_all_record_by_condition('handover_items',array('handover_id'=>$uri));
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-stationary');
		$this->load->view('admin/stationary_management/recievehandover/itemlist',$data);
		$this->load->view('admin/footer');
	
	}
	

	public function otpfunction($mobile, $smsOtp){


	     $otpmessage= urlencode($smsOtp." is your OTP for verify Handover items.");

         $url="http://45.114.143.11/api.php?username=getcaptain&password=965437&sender=MLNCTR&sendto=".$mobile."&message=".$otpmessage;

        $ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_exec($ch);
		curl_close($ch);

    }
	
}
