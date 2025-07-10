<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Handoveritems extends CI_Controller {

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
		
		$data['handover_list'] = $this->Base_model->get_all_record_by_condition('handover',array('service_type'=>'1'));

		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-itstationary');
		$this->load->view('admin/itstationary_management/handoveritems/handoveritemslist',$data);
		$this->load->view('admin/footer');
	
	}

	
	public function handover(){
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$item        = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$remarks     = xss_clean($this->input->post('remarks'));
			$user_id     = xss_clean($this->input->post('user_id'));
						 
			date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s"); 

			 $insert_data = array(
								'handover_user' 	    => $this->session->userdata('user_id'),
								'reciever_user' 	    => $user_id,
								'hand_remarks' 	        => $remarks,
								'otp_status' 	        => '0',
								'service_type'          => '1',
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							);

			    $insertid = $this->Base_model->insert_one_row('handover', $insert_data);

				if($insertid)
				{

			     $i=0; 
						 
				 foreach($item as $items){

					  $insertitemsid = $this->Base_model->insert_one_row('handover_items', 
					  array(

					  	    'handover_id'           => $insertid,
							'item_id'               => $items,
							'item_quantity' 	    => $quantity[$i],
							'service_type'          => '1',
							'created_date' 	        => $created_date,
						    'updated_date'   	    => $created_date
						) );
							
						$i++;
							   
					}
						 
			    }			 
					 

				if($insertitemsid)
				{
					$msg = "Item handover successfully.";
					$this->session->set_flashdata('flashSuccess_item',$msg);
					
					redirect('onlinestationary/Handoveritems');

				}

				else
				{
					$msg = "Fail to handover Item";
					$this->session->set_flashdata('flashError_item', $msg);
					
					$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));

				     $data['all_users'] = $this->Base_model->get_all_record_by_condition('users',array('status'=>1,'delete_status'=>1,'user_id !='=>$this->session->userdata('user_id')));

				    $this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary');
					$this->load->view('admin/itstationary_management/handoveritems/handoveritem',$data);
					$this->load->view('admin/footer');

				}
		}
				

		else
		{
			
		     $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));

		     $data['all_users'] = $this->Base_model->get_all_record_by_condition('users',array('status'=>1,'delete_status'=>1,'user_id !='=>$this->session->userdata('user_id')));

		    $this->load->view('admin/header');
			$this->load->view('admin/sidebar-itstationary');
			$this->load->view('admin/itstationary_management/handoveritems/handoveritem',$data);
			$this->load->view('admin/footer');

		}
		
	}


	public function Verifyhandover(){

		$uri = $this->uri->segment('4'); 

		date_default_timezone_set('Asia/Calcutta'); 
		$created_date =  date("Y-m-d H:i:s"); 
		
		if(isset($_REQUEST['submit'])) 
		{	
			
			$hotp     = xss_clean($this->input->post('hotp'));

			$hdata = $this->Base_model->get_record_by_id('handover',array('handover_id'=>$uri));

			$allitems = $this->Base_model->get_all_record_by_condition('handover_items',array('handover_id'=>$uri));

			if($hdata->handover_otp == $hotp)
			{

				$updateid = $this->Base_model->update_record_by_id('handover', array('otp_status' => '1'), array('handover_id'=>$uri));

			   foreach($allitems as $items){

					$itemdet = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$items->item_id));

					$total_stock = $itemdet->quantity_stock+$items->item_quantity;	

				 $update_item = array(
			        'quantity_stock' 	    => $total_stock,
				    'modified_by' 	        => $this->session->userdata('user_id'),
					'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
					'updated_date'   	    => $created_date
			      );						
					
		          $this->Base_model->update_record_by_id('osr_item_master', $update_item, array('item_id'=>$items->item_id));
			   }
				
				$msg = "OTP has verified successfully.";
				$this->session->set_flashdata('flashSuccess_item',$msg);
				
				redirect('onlinestationary/Handoveritems');

			}

			else
			{
				$msg = "Fail to verify OTP";
				$this->session->set_flashdata('flashError_votp', $msg);

			    $this->load->view('admin/header');
				$this->load->view('admin/sidebar-itstationary');
				$this->load->view('admin/itstationary_management/handoveritems/verifyhanover');
				$this->load->view('admin/footer');

			}
		}
				

		else
		{	
		     
		    $this->load->view('admin/header');
			$this->load->view('admin/sidebar-itstationary');
			$this->load->view('admin/itstationary_management/handoveritems/verifyhanover');
			$this->load->view('admin/footer');

		}
		
	}



	public function viewitems()
	{
		
		$uri = $this->uri->segment('4'); 
		
		$data['items_list'] = $this->Base_model->get_all_record_by_condition('handover_items',array('handover_id'=>$uri));
		
		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-itstationary');
		$this->load->view('admin/itstationary_management/handoveritems/itemlist',$data);
		$this->load->view('admin/footer');
	
	}
	
	
}
