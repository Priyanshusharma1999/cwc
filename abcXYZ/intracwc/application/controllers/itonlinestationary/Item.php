<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

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
		 
		 $data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>'1','delete_status'=>'0','service_type'=>'1'));

		 $data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('service_type'=>'1','delete_status'=>'1'));

	     $data['all_subcategory'] = $this->Base_model->get_all_record_by_condition('sub_category',array('delete_status'=>'1','service_type'=>'1'));

		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-itstationary');
		$this->load->view('admin/itstationary_management/item/itemlist',$data);
		$this->load->view('admin/footer');
	
	}
	
	public function additem(){
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$category  = xss_clean(strip_tags($this->input->post('category')));
			$subcategory  = xss_clean(strip_tags($this->input->post('subcategory')));
			//$itemtype  = xss_clean(strip_tags($this->input->post('itemtype')));
			$itemname  = xss_clean(strip_tags($this->input->post('itemname')));
			//$unitname    = xss_clean(strip_tags($this->input->post('unit')));
			$minquantity     = xss_clean(strip_tags($this->input->post('minqty')));
			//$stockquantity   = xss_clean(strip_tags($this->input->post('stockqty')));
			
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('subcategory','sub category','trim|required');
			//$this->form_validation->set_rules('itemtype','item type','trim|required');
			$this->form_validation->set_rules('itemname','Item name','trim|required');
			//$this->form_validation->set_rules('unit','unit','trim|required');
			$this->form_validation->set_rules('minqty','min quantity','trim|required');
			//$this->form_validation->set_rules('stockqty','stock quantity','trim|required');
			

			if($this->form_validation->run() === false) 
			{
			   $data['insertData'] = array(
			   	    'category_id' 		=> xss_clean(strip_tags($this->input->post('category'))),
					'item_name' 		=> xss_clean(strip_tags($this->input->post('itemname'))),
					'min_qty' 				=> xss_clean(strip_tags($this->input->post('minqty')))
				);

			   $data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>1));

			   //$data['item_type'] = $this->Base_model->get_all_record_by_condition('item_type',array('delete_status'=>1));
				
				$this->load->view('admin/header');
				$this->load->view('admin/sidebar-itstationary');
				$this->load->view('admin/itstationary_management/item/additem',$data);
				$this->load->view('admin/footer');

			} else
				{
					
				 $checked = $this->Base_model->check_existent('osr_item_master', array('item_name'=> $itemname, 'delete_status'=>0,'status'=>1));
					
					if($checked=='1')
					{
						$msg = "Item already exits, Please enter new one";
						$this->session->set_flashdata('flashError_item', $msg);

						$data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>1));

						//$data['item_type'] = $this->Base_model->get_all_record_by_condition('item_type',array('delete_status'=>1));
						
						$data['insertData'] = array(
							'category_id' 		=> xss_clean(strip_tags($this->input->post('category'))),
							'item_name' 		=> xss_clean(strip_tags($this->input->post('itemname'))),
							'min_qty' 				=> xss_clean(strip_tags($this->input->post('minqty')))
						);
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary');
						$this->load->view('admin/itstationary_management/item/additem',$data);
						$this->load->view('admin/footer');
						
					} else
					 {
						 
					   date_default_timezone_set('Asia/Calcutta'); 
					   $created_date =  date("Y-m-d H:i:s");

					   $pst = date('Y');
			           $pt = date('Y', strtotime('+1 year'));
			           $fy = $pst.'-'.$pt; 
						 
					  $insert_data = array(
									'item_name' 	        => $itemname,
									'quantity_min' 	        => $minquantity,
									'quantity_stock' 	    => '0',
									'status' 	            => '1',
									'delete_status' 	    => '0',
									'service_type'          => '1',
									'category_id'           => $category,
									'subcategory_id'        => $subcategory,
									'financial_year'        => $fy,
									'modified_by' 	        => $this->session->userdata('user_id'),
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								);
						$insertid = $this->Base_model->insert_one_row('osr_item_master', $insert_data);

						if($insertid)
						{
							$msg = "Item added successfully.";
							$this->session->set_flashdata('flashSuccess_item',$msg);
							
							$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0,'service_type'=>1));
							
							redirect('itonlinestationary/item',$data);
						}

						else
						{
							$msg = "Fail to add Item";
							$this->session->set_flashdata('flashError_item', $msg);
							
							$data['insertData'] = array(
							'category_id' 		=> xss_clean(strip_tags($this->input->post('category'))),
							'item_name' 		=> xss_clean(strip_tags($this->input->post('itemname'))),
							'min_qty' 			=> xss_clean(strip_tags($this->input->post('minqty')))
						   );

							$data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>1));

							//$data['item_type'] = $this->Base_model->get_all_record_by_condition('item_type',array('delete_status'=>1));
						
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar-itstationary');
							$this->load->view('admin/itstationary_management/item/additem',$data);
							$this->load->view('admin/footer');
						}
					}
				}

		}

		else
		{
			
		    $data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>1));

		  //  $data['item_type'] = $this->Base_model->get_all_record_by_condition('item_type',array('delete_status'=>1));

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-itstationary');
			$this->load->view('admin/itstationary_management/item/additem',$data);
			$this->load->view('admin/footer');

		}
		
	}
	
	
	public function edititem(){
		
		$uri = $this->uri->segment('4'); 
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$category  = xss_clean(strip_tags($this->input->post('category')));
			$subcategory  = xss_clean(strip_tags($this->input->post('subcategory')));
			//$itemtype  = xss_clean(strip_tags($this->input->post('itemtype')));
			$itemname  = xss_clean(strip_tags($this->input->post('itemname')));
			//$unitname    = xss_clean(strip_tags($this->input->post('unit')));
			$minquantity     = xss_clean(strip_tags($this->input->post('minqty')));
			//$stockquantity   = xss_clean(strip_tags($this->input->post('stockqty')));
			
			
			$this->form_validation->set_rules('category','category','trim|required');
			$this->form_validation->set_rules('subcategory','sub category','trim|required');
			//$this->form_validation->set_rules('itemtype','item type','trim|required');
			$this->form_validation->set_rules('itemname','Item name','trim|required');
			//$this->form_validation->set_rules('unit','unit','trim|required');
			$this->form_validation->set_rules('minqty','min quantity','trim|required');
			//$this->form_validation->set_rules('stockqty','stock quantity','trim|required');
			

			if($this->form_validation->run() === false) 
			{
				 
				   $data['item_detail'] = $this->Base_model->get_record_by_id('osr_item_master',array('item_id' => $uri));

				    // $data['item_type'] = $this->Base_model->get_all_record_by_condition('item_type',array('delete_status'=>1));

				     $data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>1));

				   $data['all_subcategory'] = $this->Base_model->get_all_record_by_condition('sub_category',array('delete_status'=>1,'service_type'=>1,'subcat_id'=>$data['item_detail']->subcategory_id));

					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary');
					$this->load->view('admin/itstationary_management/item/edititem',$data);
					$this->load->view('admin/footer');

			} else
				{
					
				 $checked = $this->Stationary_model->check_existent_item($itemname,$uri);
					
					if($checked=='1')
					{
						$msg = "Item already exits, Please enter new one";
						$this->session->set_flashdata('flashError_itemedit', $msg);
						
						$data['item_detail'] = $this->Base_model->get_record_by_id('osr_item_master',array('item_id' => $uri));

					//$data['item_type'] = $this->Base_model->get_all_record_by_condition('item_type',array('delete_status'=>1));

					$data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>1));

				   $data['all_subcategory'] = $this->Base_model->get_all_record_by_condition('sub_category',array('delete_status'=>1,'service_type'=>1,'subcat_id'=>$data['item_detail']->subcategory_id));
						 
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-itstationary');
						$this->load->view('admin/itstationary_management/item/edititem',$data);
						$this->load->view('admin/footer');
						
					} else
					 {
						 
					   date_default_timezone_set('Asia/Calcutta'); 
					   $created_date =  date("Y-m-d H:i:s"); 

					   $pst = date('Y');
			           $pt = date('Y', strtotime('+1 year'));
			           $fy = $pst.'-'.$pt; 

			         $item_detail = $this->Base_model->get_record_by_id('osr_item_master',array('item_id' => $uri));
						 
					  $update_data = array(
								'item_name' 	        => $itemname,
								'quantity_min' 	        => $minquantity,
								'quantity_stock' 	    => $item_detail->quantity_stock,
								'status' 	            => '1',
								'delete_status' 	    => '0',
								'service_type'          => '1',
								'category_id'           => $category,
								'subcategory_id'        => $subcategory,
								'financial_year'        => $fy,
								'modified_by' 	        => $this->session->userdata('user_id'),
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							);
						
					$updateid = $this->Base_model->update_record_by_id('osr_item_master', $update_data, array('item_id'=> $uri));

						if($updateid)
						{

							$msg = "Item Updated successfully.";
							$this->session->set_flashdata('flashSuccess_item',$msg);
							
							$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0));
							
							redirect('itonlinestationary/item',$data);
						}

						else
						{
							$msg = "Fail to Update Item";
							$this->session->set_flashdata('flashError_itemedit', $msg);
							
						 $data['item_detail'] = $this->Base_model->get_record_by_id('osr_item_master',array('item_id' => $uri));

						 $data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>1));

						//$data['item_type'] = $this->Base_model->get_all_record_by_condition('item_type',array('delete_status'=>1));

				        $data['all_subcategory'] = $this->Base_model->get_all_record_by_condition('sub_category',array('delete_status'=>1,'service_type'=>1,'subcat_id'=>$data['item_detail']->subcategory_id));
						
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar-itstationary');
							$this->load->view('admin/itstationary_management/item/edititem',$data);
							$this->load->view('admin/footer');
						}
					}
				}

		}

		else
		{
			  $data['item_detail'] = $this->Base_model->get_record_by_id('osr_item_master',array('item_id' => $uri));

			  $data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>1));

			  //$data['item_type'] = $this->Base_model->get_all_record_by_condition('item_type',array('delete_status'=>1));

		      $data['all_subcategory'] = $this->Base_model->get_all_record_by_condition('sub_category',array('delete_status'=>1,'service_type'=>1,'subcat_id'=>$data['item_detail']->subcategory_id));

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-itstationary');
			$this->load->view('admin/itstationary_management/item/edititem',$data);
			$this->load->view('admin/footer');

		}
		
	}



	public function viewitem(){

		   $uri = $this->uri->segment('4'); 

		   $data['item_detail'] = $this->Base_model->get_record_by_id('osr_item_master',array('item_id' => $uri));

		   $data['item_issuedet'] = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('item_id' => $uri,'approved_qty>'=>'0','service_type'=>'1'));
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-itstationary');
			$this->load->view('admin/itstationary_management/item/itemdetail',$data);
			$this->load->view('admin/footer');
	}
	
	
	public function delete_item(){

		  
		    date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s"); 
			$delete_itemId = xss_clean(strip_tags($this->input->post('delete_itemId')));
			
             $data['post_data'] = $post_data =  $this->Base_model->get_record_by_id('osr_item_master', array('item_id' => $delete_itemId));			
			
			  $update_data = array(
							'item_name' 	        => $post_data->item_name,
							'quantity_min' 	        => $post_data->quantity_min,
							'quantity_stock' 	    => $post_data->quantity_stock,
							'status' 	            => '1',
							'delete_status' 	    => '1',
							'service_type'          => '1',
							'category_id'           => $post_data->category_id,
							'subcategory_id'        => $post_data->subcategory_id,
							'modified_by' 	        => $this->session->userdata('user_id'),
							'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
							'created_date' 	        => $created_date,
							'updated_date'   	    => $created_date
						);
							
			$updateid = $this->Base_model->update_record_by_id('osr_item_master', $update_data, array('item_id'=> $delete_itemId));
			
			$msg = "Item deleted successfully.";
			$this->session->set_flashdata('flashSuccess_item',$msg);					
			$data['all_items'] = $this->Base_model->get_all_record_by_condition('osr_item_master',array('status'=>1,'delete_status'=>0));
			
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-itstationary');
			$this->load->view('admin/itstationary_management/item/itemlist',$data);
			$this->load->view('admin/footer');
		
	}
	
	
	   public function search_item()
	     {


			if(isset($_REQUEST['submit'])){
					$item_name = xss_clean(strip_tags($this->input->post('name')));
					$category  = xss_clean(strip_tags($this->input->post('category')));
					$subcategory = xss_clean(strip_tags($this->input->post('subcategory')));

					$data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('service_type'=>'1','delete_status'=>'1'));

	               $data['all_subcategory'] = $this->Base_model->get_all_record_by_condition('sub_category',array('delete_status'=>'1','service_type'=>'1'));

					$data['all_items'] = $this->Stationary_model->search_item($item_name,$category,$subcategory);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-itstationary');
					$this->load->view('admin/itstationary_management/item/itemlist',$data);
					$this->load->view('admin/footer');
			}
		
	    }

	      public function getallsubcategory(){

	      	$category_id = $this->input->post('id');

	      	$allsubcategory =  $this->Base_model->get_all_record_by_condition('sub_category', array('category_id'=>$category_id,'delete_status'=>'1','service_type'=>'1'));

	      	$subcatlist =  json_encode($allsubcategory);

			echo  $subcatlist;

	      }
	
	
}
