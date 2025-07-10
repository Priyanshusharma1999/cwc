<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Subcategory extends CI_Controller {

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

		$data['all_subcategory'] = $this->Base_model->get_all_record_by_condition('sub_category',array('delete_status'=>1,'service_type'=>2));

		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-stationary');
		$this->load->view('admin/stationary_management/masterdata/subcategorylist',$data);
		$this->load->view('admin/footer');
	
	}
	
	public function addsubcategory(){
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$category_name       = xss_clean(strip_tags($this->input->post('category_name')));
			$subcategory_name    = xss_clean(strip_tags($this->input->post('subcategory_name')));
			$subcategory_shortname  = xss_clean(strip_tags($this->input->post('subcategory_shortname')));
			
			$this->form_validation->set_rules('category_name','category','trim|required');
			$this->form_validation->set_rules('subcategory_name','Sub category','trim|required');
			$this->form_validation->set_rules('subcategory_shortname','Category Short name','trim|required');

		   $data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>2));

			if($this->form_validation->run() === false) 
			{
				   $data['insertData'] = array(
				   	    'subcategory_name' 		=> xss_clean(strip_tags($this->input->post('subcategory_name'))),
						'subcategory_shortname'    => xss_clean(strip_tags($this->input->post('subcategory_shortname')))
					);

					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary');
					$this->load->view('admin/stationary_management/masterdata/addsubcategory',$data);
					$this->load->view('admin/footer');

			} else
				{
					
				   $checked = $this->Base_model->check_existent('sub_category', array('subcat_name'=> $subcategory_name, 'delete_status'=>1));
					
					if($checked=='1')
					{
						$msg = "Sub Category already exits, Please enter new one";
						$this->session->set_flashdata('flashError_addsubcategory', $msg);
						
						$data['insertData'] = array(
					   	    'subcategory_name' 		=> xss_clean(strip_tags($this->input->post('subcategory_name'))),
							'subcategory_shortname'    => xss_clean(strip_tags($this->input->post('subcategory_shortname')))
				     	);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-stationary');
						$this->load->view('admin/stationary_management/masterdata/addsubcategory',$data);
						$this->load->view('admin/footer');
						
					} else
					 {
						 
					   date_default_timezone_set('Asia/Calcutta'); 
					   $created_date =  date("Y-m-d H:i:s"); 
						 
					  $insert_data = array(
									'category_id' 	        => $category_name,
									'subcat_name' 	        => $subcategory_name,
									'subcat_short_name'     => $subcategory_shortname,
									'delete_status' 	    => '1',
									'service_type'          => '2',
									'modified_by' 	        => $this->session->userdata('user_id'),
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								);

						$insertid = $this->Base_model->insert_one_row('sub_category', $insert_data);

						if($insertid)
						{
							$msg = "Sub Category added successfully.";
							$this->session->set_flashdata('flashSuccess_addsubcategory',$msg);
							
							redirect('onlinestationary/Subcategory');
						}

						else
						{
							$msg = "Fail to add Category";
							$this->session->set_flashdata('flashError_addsubcategory', $msg);
							
							$data['insertData'] = array(
						   	    'subcategory_name' 		=> xss_clean(strip_tags($this->input->post('subcategory_name'))),
								'subcategory_shortname'    => xss_clean(strip_tags($this->input->post('subcategory_shortname')))
				     	    );

							$this->load->view('admin/header');
							$this->load->view('admin/sidebar-stationary');
							$this->load->view('admin/stationary_management/masterdata/addsubcategory',$data);
							$this->load->view('admin/footer');

						}
					}
				}

		}

		else
		{
			
		    $data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>2));

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-stationary');
			$this->load->view('admin/stationary_management/masterdata/addsubcategory',$data);
			$this->load->view('admin/footer');

		}
		
	}
	
	
	public function editsubcategory(){

		$uri = $this->uri->segment('4'); 
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$category_name       = xss_clean(strip_tags($this->input->post('category_name')));
			$subcategory_name    = xss_clean(strip_tags($this->input->post('subcategory_name')));
			$subcategory_shortname  = xss_clean(strip_tags($this->input->post('subcategory_shortname')));
			
			$this->form_validation->set_rules('category_name','category','trim|required');
			$this->form_validation->set_rules('subcategory_name','Sub category','trim|required');
			$this->form_validation->set_rules('subcategory_shortname','Category Short name','trim|required');

		   $data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>2));

		   $data['subcategory_detail'] = $this->Base_model->get_record_by_id('sub_category',array('subcat_id' => $uri));
			

			if($this->form_validation->run() === false) 
			{	    
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary');
					$this->load->view('admin/stationary_management/masterdata/editsubcategory',$data);
					$this->load->view('admin/footer');

			} else
				{

			      $checked = $this->Base_model->check_existent('sub_category', array('subcat_name'=> $subcategory_name,'subcat_id !='=>$uri,'delete_status'=>1));
					
					if($checked=='1')
					{
						$msg = "Sub Category already exits, Please enter new one";
						$this->session->set_flashdata('flashError_editcategory', $msg);

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-stationary');
						$this->load->view('admin/stationary_management/masterdata/editsubcategory',$data);
						$this->load->view('admin/footer');
						
					} else
					 {
						 
					   date_default_timezone_set('Asia/Calcutta'); 
					   $created_date =  date("Y-m-d H:i:s"); 
						 
					  $update_data = array(
									'category_id' 	        => $category_name,
									'subcat_name' 	        => $subcategory_name,
									'subcat_short_name'     => $subcategory_shortname,
									'delete_status' 	    => '1',
									'service_type'          => '2',
									'modified_by' 	        => $this->session->userdata('user_id'),
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								);
						
						$updateid = $this->Base_model->update_record_by_id('sub_category', $update_data, array('subcat_id'=> $uri));

						if($updateid)
						{
							$msg = "Sub Category Updated successfully.";
							$this->session->set_flashdata('flashSuccess_editsubcategory',$msg);
							redirect('onlinestationary/Subcategory');
						}

						else
						{
							$msg = "Fail to Update Sub Category";
							$this->session->set_flashdata('flashError_editsubcategory', $msg);

							$this->load->view('admin/header');
							$this->load->view('admin/sidebar-stationary');
							$this->load->view('admin/stationary_management/masterdata/editsubcategory',$data);
							$this->load->view('admin/footer');
						}
					}
				}

		}

		else
		{

		  $data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>2));
		   $data['subcategory_detail'] = $this->Base_model->get_record_by_id('sub_category',array('subcat_id' => $uri));

			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-stationary');
			$this->load->view('admin/stationary_management/masterdata/editsubcategory',$data);
			$this->load->view('admin/footer');

		}
		
	}
	
	
	public function deletesubcategory(){

		  date_default_timezone_set('Asia/Calcutta'); 
		  $created_date =  date("Y-m-d H:i:s"); 
		  $delete_subcatId = xss_clean(strip_tags($this->input->post('delete_subcatId')));
			
          $post_data =  $this->Base_model->get_record_by_id('sub_category', array('subcat_id' => $delete_subcatId));			
			
		  $update_data = array(
						'category_id' 	        => $post_data->category_id,
						'subcat_name' 	        => $post_data->subcat_name,
						'subcat_short_name' 	=> $post_data->subcat_short_name,
						'delete_status' 	    => '0',
						'service_type'          => '2',
						'modified_by' 	        => $this->session->userdata('user_id'),
						'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
						'created_date' 	        => $created_date,
						'updated_date'   	    => $created_date
					);
							
			$updateid = $this->Base_model->update_record_by_id('sub_category', $update_data, array('subcat_id'=> $delete_subcatId));
			
			$msg = "Sub Category deleted successfully.";
			$this->session->set_flashdata('flashSuccess_subcategory',$msg);

			redirect('onlinestationary/Subcategory');
		
	}
	
	
	   public function search_subcategory()
	     {

		
			if(isset($_REQUEST['submit'])){

					$subcategory_name = xss_clean(strip_tags($this->input->post('subcategory_name')));
					$data['all_subcategory'] = $this->Stationary_model->search_subcategory($subcategory_name);

					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary');
					$this->load->view('admin/stationary_management/masterdata/subcategorylist',$data);
					$this->load->view('admin/footer');

			  }
		
	      }
	
	
	
}
