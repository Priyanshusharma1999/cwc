<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Returnitems extends CI_Controller {

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

		$data['all_items'] = $this->Base_model->get_all_returnitems('items_return',array('service_type'=>1));

		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-itstationary');
		$this->load->view('admin/itstationary_management/returnitems/returnitemlist',$data);
		$this->load->view('admin/footer');
	
	}


	
	public function returnitem(){
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$item        = xss_clean($this->input->post('item'));
			$quantity    = xss_clean($this->input->post('quantity'));
			$remarks     = xss_clean($this->input->post('remarks'));
						 
		    date_default_timezone_set('Asia/Calcutta'); 
		    $created_date =  date("Y-m-d H:i:s");

		    $i=0; 
						 
			 foreach($item as $items){

				  $insertid = $this->Base_model->insert_one_row('items_return', 
				  array(

				  	    'item_id'               => $items,
						'user_id'               => $this->session->userdata('user_id'),
						'quantity' 	            => $quantity[$i],
						'remarks'               => $remarks[$i],
						'service_type'          => '1',
						'approve_status'        => '0',
						'return_date' 	        => $created_date
					) );
						
						$i++;
						   
				}

					if($insertid)
					{
						$msg = "Item returned successfully.";
						$this->session->set_flashdata('flashSuccess_item',$msg);
						
						redirect('itonlinestationary/Returnitems');
					}

					else
					{

							$msg = "Fail to return Item";
							$this->session->set_flashdata('flashError_item', $msg);
							
							$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));

							$this->load->view('admin/header');
							$this->load->view('admin/sidebar-itstationary');
							$this->load->view('admin/itstationary_management/returnitems/returnitem',$data);
							$this->load->view('admin/footer');

				     }
		     }

			else
			{
				
			   $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));

				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-itstationary');
				$this->load->view('admin/itstationary_management/returnitems/returnitem',$data);
				$this->load->view('admin/footer');

			}
		
	}
	



	public function changestatus(){

		    date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s"); 

			$return_id = xss_clean($this->input->post('return_id'));
			$status    = xss_clean($this->input->post('status'));

			if($status == 'Approve'){

				$status = '1';

			} else {

				$status = '2';
			}
			
            $post_data =  $this->Base_model->get_record_by_id('items_return', array('return_id' => $return_id));
			
			  $update_data = array(
							'item_id'               => $post_data->item_id,
							'user_id'               => $post_data->user_id,
							'quantity' 	            => $post_data->quantity,
							'remarks'               => $post_data->remarks,
							'service_type'          => '1',
							'approve_status'        => $status
						);
							
		$updateid = $this->Base_model->update_record_by_id('items_return', $update_data, array('return_id'=> $return_id));

		if($status == '1'){

			$itemdet = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$post_data->item_id));

		     $total_stock = $itemdet->quantity_stock-$post_data->quantity;	
			 
				 $update_item = array(
			        'quantity_stock' 	    => $total_stock,
				    'modified_by' 	        => $this->session->userdata('user_id'),
					'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
					'updated_date'   	    => $created_date
			   );						
					
		   $this->Base_model->update_record_by_id('osr_item_master', $update_item, array('item_id'=>$post_data->item_id));

		}
			
		$msg = "Status has changed successfully.";
		$this->session->set_flashdata('flashSuccess_item',$msg);	
         
        redirect('itonlinestationary/Returnitems');

		
	}
	


	
}
