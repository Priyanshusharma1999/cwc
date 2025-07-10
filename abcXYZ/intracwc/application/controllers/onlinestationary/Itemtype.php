<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Itemtype extends CI_Controller {

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

		$data['itemtype'] = $this->Base_model->get_all_record_by_condition('item_type',array('delete_status'=>1));

		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-stationary');
		$this->load->view('admin/stationary_management/masterdata/itemtypelist',$data);
		$this->load->view('admin/footer');
	
	}
	
	public function additemtype(){
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$item_type              = xss_clean(strip_tags($this->input->post('item_type')));
			$itemtype_description   = xss_clean(strip_tags($this->input->post('itemtype_description')));
			
			$this->form_validation->set_rules('item_type','Item Type','trim|required');
			$this->form_validation->set_rules('itemtype_description','Item Type Description','trim|required');
			

			if($this->form_validation->run() === false) 
			{
				   $data['insertData'] = array(
				   	    'item_type' 		=> xss_clean(strip_tags($this->input->post('item_type'))),
						'itemtype_description' 		=> xss_clean(strip_tags($this->input->post('itemtype_description')))
					);
					
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary');
					$this->load->view('admin/stationary_management/item/additem',$data);
					$this->load->view('admin/footer');

			} else
				{
					
				 $checked = $this->Base_model->check_existent('item_type', array('item_type'=> $item_type, 'delete_status'=>1));
					
					if($checked=='1')
					{
						$msg = "Item Type already exits, Please enter new one";
						$this->session->set_flashdata('flashError_itemtype', $msg);

						$data['insertData'] = array(
						   	'item_type' 		=> xss_clean(strip_tags($this->input->post('item_type'))),
						    'itemtype_description' 		=> xss_clean(strip_tags($this->input->post('itemtype_description')))
						);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-stationary');
						$this->load->view('admin/stationary_management/item/additem',$data);
						$this->load->view('admin/footer');
						
					} else
					 {
						 
					   date_default_timezone_set('Asia/Calcutta'); 
					   $created_date =  date("Y-m-d H:i:s"); 
						 
					  $insert_data = array(
									'item_type' 	        => $item_type,
									'itemtype_description' 	=> $itemtype_description,
									'delete_status' 	    => '1',
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								);
						$insertid = $this->Base_model->insert_one_row('item_type', $insert_data);

						if($insertid)
						{
							$msg = "Item Type added successfully.";
							$this->session->set_flashdata('flashSuccess_itemtype',$msg);
							
							redirect('onlinestationary/Itemtype');
						}

						else
						{
							$msg = "Fail to add Item Type";
							$this->session->set_flashdata('flashError_itemtype', $msg);
							
							$data['insertData'] = array(
							   	'item_type' 		=> xss_clean(strip_tags($this->input->post('item_type'))),
							    'itemtype_description' 		=> xss_clean(strip_tags($this->input->post('itemtype_description')))
						    );
						
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar-stationary');
							$this->load->view('admin/stationary_management/masterdata/additemtype',$data);
							$this->load->view('admin/footer');
						}
					}
				}

		}

		else
		{
			
		    $this->load->view('admin/header');
			$this->load->view('admin/sidebar-stationary');
			$this->load->view('admin/stationary_management/masterdata/additemtype');
			$this->load->view('admin/footer');

		}
		
	}
	
	
	public function edititemtype(){
		
		$uri = $this->uri->segment('4'); 
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$item_type              = xss_clean(strip_tags($this->input->post('item_type')));
			$itemtype_description   = xss_clean(strip_tags($this->input->post('itemtype_description')));
			
			$this->form_validation->set_rules('item_type','Item Type','trim|required');
			$this->form_validation->set_rules('itemtype_description','Item Type Description','trim|required');

			$data['itemtype_detail'] = $this->Base_model->get_record_by_id('item_type',array('itemtype_id' => $uri));
			

			if($this->form_validation->run() === false) 
			{
				   
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary');
					$this->load->view('admin/stationary_management/masterdata/edititemtype',$data);
					$this->load->view('admin/footer');

			} else
				{
					
				 $checked = $this->Base_model->check_existent('item_type', array('item_type'=> $item_type,'itemtype_id !=' => $uri, 'delete_status'=>1));
					
					if($checked=='1')
					{
						$msg = "Item Type already exits, Please enter new one";
						$this->session->set_flashdata('flashError_itemtypeedit', $msg);
                        
                        $data['itemtype_detail'] = $this->Base_model->get_record_by_id('item_type',array('itemtype_id' => $uri));

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-stationary');
						$this->load->view('admin/stationary_management/masterdata/edititemtype',$data);
						$this->load->view('admin/footer');
						
					} else
					 {
						 
					   date_default_timezone_set('Asia/Calcutta'); 
					   $created_date =  date("Y-m-d H:i:s"); 
						 
					  $update_data = array(
									'item_type' 	        => $item_type,
									'itemtype_description' 	=> $itemtype_description,
									'delete_status' 	    => '1',
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								);
						
						$updateid = $this->Base_model->update_record_by_id('item_type', $update_data, array('itemtype_id'=> $uri));

						if($updateid)
						{
							$msg = "Item Type Updated successfully.";
							$this->session->set_flashdata('flashSuccess_updateitemtype',$msg);

							redirect('onlinestationary/Itemtype');
						}

						else
						{
							$msg = "Fail to Update Item Type";
							$this->session->set_flashdata('flashError_itemtypeedit', $msg);

						$data['itemtype_detail'] = $this->Base_model->get_record_by_id('item_type',array('itemtype_id' => $uri));
						
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar-stationary');
							$this->load->view('admin/stationary_management/masterdata/edititemtype',$data);
							$this->load->view('admin/footer');
						}
					}
				}

		}

		else
		{
			 $data['itemtype_detail'] = $this->Base_model->get_record_by_id('item_type',array('itemtype_id' => $uri));

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-stationary');
			$this->load->view('admin/stationary_management/masterdata/edititemtype',$data);
			$this->load->view('admin/footer');

		}
		
	}
	
	
	public function delete_itemtype(){

	      date_default_timezone_set('Asia/Calcutta'); 
		  $created_date =  date("Y-m-d H:i:s"); 
		  $delete_itemtypeId = xss_clean(strip_tags($this->input->post('delete_itemtypeId')));
			
          $post_data =  $this->Base_model->get_record_by_id('item_type', array('itemtype_id' => $delete_itemtypeId));			
			
		  $update_data = array(
						'item_type' 	        => $post_data->item_type,
						'itemtype_description' 	=> $post_data->itemtype_description,
						'delete_status' 	    => '0',
						'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
						'created_date' 	        => $created_date,
						'updated_date'   	    => $created_date
					);
							
		$updateid = $this->Base_model->update_record_by_id('item_type', $update_data, array('itemtype_id'=> $delete_itemtypeId));
			
		$msg = "Item type deleted successfully.";
		$this->session->set_flashdata('flashSuccess_delitemtype',$msg);

		redirect('onlinestationary/Itemtype');
		
	}
	
	
	  
	
	
}
