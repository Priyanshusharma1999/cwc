<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

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
           
          $user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
	   
		   foreach ($user_role_data as $role_id)
		   {
		   		$user_roles[]= $role_id->role_id;
		   }
	  
		   if (in_array("10", $user_roles))
			  {

			  	$roledata['permission_item'] = $user_roles;

			  } else if (in_array("11", $user_roles)){

			  	redirect('onlinestationary/Requisition',$roledata);

			  } else if(in_array("12", $user_roles)){

                redirect('onlinestationary/osradmin',$roledata);

			  } else if(in_array("13", $user_roles)){

                redirect('onlinestationary/approverequisition',$roledata);

			}

   
	}
	
	public function index()
	{
		$data['all_category'] = $this->Base_model->get_all_record_by_condition('category',array('delete_status'=>1,'service_type'=>2));

		$this->load->view('admin/header');
		$this->load->view('admin/sidebar-stationary');
		$this->load->view('admin/stationary_management/masterdata/categorylist',$data);
		$this->load->view('admin/footer');
	
	}
	
	public function addcategory(){
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$category_name  = xss_clean(strip_tags($this->input->post('category_name')));
			$category_shortname  = xss_clean(strip_tags($this->input->post('category_shortname')));
			
			$this->form_validation->set_rules('category_name','category','trim|required');
			$this->form_validation->set_rules('category_shortname','Category Short name','trim|required');

			if($this->form_validation->run() === false) 
			{
				   $data['insertData'] = array(
				   	    'category_name' 		=> xss_clean(strip_tags($this->input->post('category_name'))),
						'category_shortname'    => xss_clean(strip_tags($this->input->post('category_shortname')))
					);

					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary');
					$this->load->view('admin/stationary_management/masterdata/addcategory',$data);
					$this->load->view('admin/footer');

			} else
				{
					
				   $checked = $this->Base_model->check_existent('category', array('category_name'=> $category_name, 'delete_status'=>1));
					
					if($checked=='1')
					{
						$msg = "Category already exits, Please enter new one";
						$this->session->set_flashdata('flashError_addcategory', $msg);
						
						$data['insertData'] = array(
				   	    'category_name' 		=> xss_clean(strip_tags($this->input->post('category_name'))),
						'category_shortname' 	=> xss_clean(strip_tags($this->input->post('category_shortname')))
					   );

						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-stationary');
						$this->load->view('admin/stationary_management/masterdata/addcategory',$data);
						$this->load->view('admin/footer');
						
					} else
					 {
						 
					   date_default_timezone_set('Asia/Calcutta'); 
					   $created_date =  date("Y-m-d H:i:s"); 
						 
					  $insert_data = array(
									'category_name' 	    => $category_name,
									'category_short_name' 	=> $category_shortname,
									'delete_status' 	    => '1',
									'service_type'          => '2',
									'modified_by' 	        => $this->session->userdata('user_id'),
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								);

						$insertid = $this->Base_model->insert_one_row('category', $insert_data);

						if($insertid)
						{
							$msg = "Category added successfully.";
							$this->session->set_flashdata('flashSuccess_addcategory',$msg);
							
							redirect('onlinestationary/Category');
						}

						else
						{
							$msg = "Fail to add Category";
							$this->session->set_flashdata('flashError_addcategory', $msg);
							
							$data['insertData'] = array(
					   	    'category_name' 		=> xss_clean(strip_tags($this->input->post('category_name'))),
							'category_shortname' 	=> xss_clean(strip_tags($this->input->post('category_shortname')))
						   );

							$this->load->view('admin/header');
							$this->load->view('admin/sidebar-stationary');
							$this->load->view('admin/stationary_management/masterdata/addcategory',$data);
							$this->load->view('admin/footer');

						}
					}
				}

		}

		else
		{
			
		    
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-stationary');
			$this->load->view('admin/stationary_management/masterdata/addcategory');
			$this->load->view('admin/footer');

		}
		
	}
	
	
	public function editcategory(){

		$uri = $this->uri->segment('4'); 
		
		if(isset($_REQUEST['submit'])) 
		{
			
			$category_name  = xss_clean(strip_tags($this->input->post('category_name')));
			$category_shortname  = xss_clean(strip_tags($this->input->post('category_shortname')));
			
			$this->form_validation->set_rules('category_name','category','trim|required');
			$this->form_validation->set_rules('category_shortname','Category Short name','trim|required');
			

			if($this->form_validation->run() === false) 
			{
				 
				    $data['category_detail'] = $this->Base_model->get_record_by_id('category',array('category_id' => $uri));
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary');
					$this->load->view('admin/stationary_management/masterdata/editcategory',$data);
					$this->load->view('admin/footer');

			} else
				{

			      $checked = $this->Base_model->check_existent('category', array('category_name'=> $category_name,'category_id !='=>$uri,'delete_status'=>1));
					
					if($checked=='1')
					{
						$msg = "Category already exits, Please enter new one";
						$this->session->set_flashdata('flashError_editcategory', $msg);
						
						$data['category_detail'] = $this->Base_model->get_record_by_id('category',array('category_id' => $uri));
						$this->load->view('admin/header');
						$this->load->view('admin/sidebar-stationary');
						$this->load->view('admin/stationary_management/masterdata/editcategory',$data);
						$this->load->view('admin/footer');
						
					} else
					 {
						 
					   date_default_timezone_set('Asia/Calcutta'); 
					   $created_date =  date("Y-m-d H:i:s"); 
						 
					  $update_data = array(
									'category_name' 	    => $category_name,
									'category_short_name' 	=> $category_shortname,
									'delete_status' 	    => '1',
									'service_type'          => '2',
									'modified_by' 	        => $this->session->userdata('user_id'),
									'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
									'created_date' 	        => $created_date,
									'updated_date'   	    => $created_date
								);
						
						$updateid = $this->Base_model->update_record_by_id('category', $update_data, array('category_id'=> $uri));

						if($updateid)
						{
							$msg = "Category Updated successfully.";
							$this->session->set_flashdata('flashSuccess_editcategory',$msg);
							redirect('onlinestationary/Category');
						}

						else
						{
							$msg = "Fail to Update Category";
							$this->session->set_flashdata('flashError_editcategory', $msg);
							
						    $data['category_detail'] = $this->Base_model->get_record_by_id('category',array('category_id' => $uri));
							$this->load->view('admin/header');
							$this->load->view('admin/sidebar-stationary');
							$this->load->view('admin/stationary_management/masterdata/editcategory',$data);
							$this->load->view('admin/footer');
						}
					}
				}

		}

		else
		{
			$data['category_detail'] = $this->Base_model->get_record_by_id('category',array('category_id' => $uri));
			$this->load->view('admin/header');
			$this->load->view('admin/sidebar-stationary');
			$this->load->view('admin/stationary_management/masterdata/editcategory',$data);
			$this->load->view('admin/footer');

		}
		
	}
	
	
	public function deletecategory(){

		    date_default_timezone_set('Asia/Calcutta'); 
			$created_date =  date("Y-m-d H:i:s"); 
			$delete_catId = xss_clean(strip_tags($this->input->post('delete_catId')));
			
          $post_data =  $this->Base_model->get_record_by_id('category', array('category_id' => $delete_catId));			
			
		  $update_data = array(
						'category_name' 	    => $post_data->category_name,
						'category_short_name' 	=> $post_data->category_short_name,
						'delete_status' 	    => '0',
						'service_type'          => '2',
						'modified_by' 	        => $this->session->userdata('user_id'),
						'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
						'created_date' 	        => $created_date,
						'updated_date'   	    => $created_date
					);
							
			$updateid = $this->Base_model->update_record_by_id('category', $update_data, array('category_id'=> $delete_catId));
			
			$msg = "Category deleted successfully.";
			$this->session->set_flashdata('flashSuccess_category',$msg);

			redirect('onlinestationary/Category');
		
	}
	
	
	   public function search_category()
	     {

		
			if(isset($_REQUEST['submit'])){
					$category_name = xss_clean(strip_tags($this->input->post('category_name')));
					$data['all_category'] = $this->Stationary_model->search_category($category_name);
					$this->load->view('admin/header');
					$this->load->view('admin/sidebar-stationary');
					$this->load->view('admin/stationary_management/masterdata/categorylist',$data);
					$this->load->view('admin/footer');
			  }
		
	      }
	
	
}
