<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package     CodeIgniter
 * @subpackage  Rest Server
 * @category    Customer_Api Controller 
 */

require APPPATH . '/libraries/REST_Controller.php';

class Complaint extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('Admin_model');

    }
   
  /***********get user data*********/

  
    public function addcomplain_post()
    {
        $user_id            = $this->post('user_id');
        $vendor_id          = $this->post('user_id');
        $category_id        = $this->post('category_id');
        $building_id        = $this->post('building_id');
        $room_id            = $this->post('room_id');
        $user_name          = $this->post('user_name');
        $designation_id     = $this->post('designation_id');
        $contact_no         = $this->post('contact_no');
        $landline_no        = $this->post('landline_no');
        $intercom           = $this->post('intercom');
        $description        = $this->post('description');
        $service_type       = $this->post('service_type');

        if(empty($user_id) || empty($category_id) || empty($building_id) || empty($room_id) || empty($user_name) || empty($designation_id) || empty($contact_no) || empty($description) || empty($service_type))
          {

            $response_data['response_code']   = 400;
            $response_data['response_message'] = 'Fields are required.';
            $this->response($response_data);

          }

        else
        {

        	 date_default_timezone_set('Asia/Calcutta'); 
			  $created_date =  date("Y-m-d H:i:s"); 
            
              $compdata = array(
								'user_id' 	            => $user_id,
								'vendor_id' 	        => $vendor_id,
								'complaint_type_id' 	=> $category_id,
								'complaint_sub_type_id' => $category_id,
								'building_id' 	        => $building_id,
								'room_id' 	            => $room_id,
								'designation_id' 	    => $designation_id,
								'name' 	                => $user_name,
								'mobile_no' 	        => $contact_no,
								'landline_no' 	        => $landline_no,
								'description' 	        => $description,
								'intercom' 	            => $intercom,
								'date_created' 	        => $created_date,
								'date_resloved' 	    => NULL,
								'ref_no' 	            => NULL,
								'remarks' 	            => NULL,
								'status' 	            => 'Pending',
								'service_type'          => $service_type,
								'delete_status' 	    => 1,
								'modified_by' 	        => $user_id,
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							);

					$insertid = $this->Base_model->insert_one_row('complaint', $compdata);

					if($insertid)
					{
						$response_data['response_code']   = 200;
                        $response_data['response_message'] = 'Complain added successfully.';
                        $this->response($response_data);
					}

        }
        
    }//ends function

   

    public function complainlist_post()
    { 

        $user_id                = $this->post('user_id');
        $service_type            = $this->post('service_type'); 
        date_default_timezone_set('Asia/Calcutta'); 
        $created_date       =  date("Y-m-d H:i:s"); 
        $resp = array();
     

        if(empty($user_id) || empty($service_type))
        {
            $response_data['response_code']    = 400;
            $response_data['response_message'] = 'User id and service type both are required.';
            $this->response($response_data);
            
        } 
            
        else
        {

            $complain_list = $this->Base_model->get_all_record_by_condition('complaint', array('service_type' => $service_type,'user_id'=>$user_id));
           
            foreach ($complain_list as $list) 
            {

            	 $category_name = $this->Base_model->get_record_by_id('category', array('category_id' => $list->complaint_type_id));

            	  $desg_name = $this->Base_model->get_record_by_id('designation', array('designation_id' => $list->designation_id));


                  $resp[] = array(    
                            'complain_id'         => $list->complaint_id,   
                            'category_name'       => $category_name->category_name,
                            'user_name'           => $list->name,
                            'designation'         => $desg_name->designation_name,
                            'complain_register'   => $list->date_created,
                            'complain_resolved'   => $list->date_resolved,
                            'status'              => $list->status
                     );


            }
           
          
             if($resp)
             {
                 $response_data['response_code'] = 200;
                 $response_data['response_message'] = 'Complain list has fetched successfully.';
                 $response_data['complain_list'] = $resp;
                 $this->response($response_data);
             }

             else
             {
                 $response_data['response_code'] = 400;
                 $response_data['response_message'] = 'Complain list is empty.';
                 $response_data['complain_list'] = $resp;
                 $this->response($response_data);
             }
            
        }//ends main else               
                 
    }//ends function




    public function complaindeatil_post()
    { 

        $user_id              = $this->post('user_id');
        $complaint_id         = $this->post('complaint_id');
        $service_type         = $this->post('service_type'); 
        date_default_timezone_set('Asia/Calcutta'); 
        $created_date         =  date("Y-m-d H:i:s"); 
        $resp = array();
        $comm = array();
     

        if(empty($user_id) || empty($service_type) || empty($complaint_id))
        {

            $response_data['response_code']    = 400;
            $response_data['response_message'] = 'Fields are required.';
            $this->response($response_data);
            
        } 
            
        else
        {

          $complain_list = $this->Base_model->get_record_by_id('complaint', array('service_type' => $service_type,'user_id'=>$user_id,'complaint_id'=>$complaint_id));


          $category_name = $this->Base_model->get_record_by_id('category', array('category_id' => $complain_list->complaint_type_id));

          $desg_name = $this->Base_model->get_record_by_id('designation', array('designation_id' => $complain_list->designation_id));

          $building_name = $this->Base_model->get_record_by_id('building', array('building_id' => $complain_list->building_id));

           $room_name = $this->Base_model->get_record_by_id('room_no', array('room_id' => $complain_list->room_id));


            $comment = $this->Base_model->get_all_record_by_condition('complaint_comment', array('service_type' => $service_type,'complaint_id'=>$complaint_id));


             foreach ($comment as $commlist) 
            {

            	 $name = $this->Base_model->get_record_by_id('users', array('user_id' => $commlist->user_id));

                  $comm[] = array(    
                            'name'                => $name->user_name,   
                            'comment_id'          => $commlist->comment_id,
                            'user_id'             => $commlist->user_id,
                            'complaint_id'        => $commlist->complaint_id,
                            'comment'             => $commlist->comment,
                            'status'              => $commlist->status,
                            'delete_status'       => $commlist->delete_status,
                            'service_type'        => $commlist->service_type,
                            'created_date' 	      => $created_date,
							              'updated_date'        => $created_date
                     );


            }

                  $resp = array(    
                            'complain_id'          => $complain_list->complaint_id,   
                            'category_name'        => $category_name->category_name,
                            'user_name'            => $complain_list->name,
                            'designation'          => $desg_name->designation_name,
                            'building_name'        => $building_name->building_name,
                            'room_name'            => $room_name->room_name,
                            'mobile_number'        => $complain_list->mobile_no,
                            'landline_number'      => $complain_list->landline_no,
                            'intercom'             => $complain_list->intercom,
                            'description'          => $complain_list->description,
                            'remarks'              => isset($complain_list->remarks)? $complain_list->remarks :'N/A',
                            'complain_rating'     => isset($complain_list->complain_rating)? $complain_list->complain_rating :'N/A',
                            'status'               => $complain_list->status,
                            'complain_register'    => $complain_list->date_created,
                            'complain_resolved'    => isset($complain_list->date_resolved)? $complain_list->date_resolved :'N/A',
                            'complain_comment'     => $comm
                     );

               
             if($resp)
             {
                 $response_data['response_code'] = 200;
                 $response_data['response_message'] = 'Complain detail has fetched successfully.';
                 $response_data['complain_detail'] = $resp;
                 $this->response($response_data);
             }

             else
             {
                 $response_data['response_code'] = 400;
                 $response_data['response_message'] = 'Complain detail is empty.';
                 $response_data['complain_detail'] = $resp;
                 $this->response($response_data);
             }
            
        }//ends main else    

     }




    public function addcomment_post()
    {
        $user_id            = $this->post('user_id');
        $complaint_id        = $this->post('complaint_id');
        $comment             = $this->post('comment');
        $service_type       = $this->post('service_type');

        if(empty($user_id) || empty($complaint_id) || empty($comment) || empty($service_type))
          {

            $response_data['response_code']   = 400;
            $response_data['response_message'] = 'Fields are required.';
            $this->response($response_data);

          }

        else
        {

        	 date_default_timezone_set('Asia/Calcutta'); 
			  $created_date =  date("Y-m-d H:i:s"); 
            
              $commdata = array(
								'user_id' 	            => $user_id,
								'complaint_id' 	        => $complaint_id,
								'comment'               => $comment,
								'service_type'          => $service_type,
								'status' 	            => 1,
								'delete_status' 	    => 1,
								'created_date' 	        => $created_date,
								'updated_date'   	    => $created_date
							);

					$insertid = $this->Base_model->insert_one_row('complaint_comment', $commdata);

					if($insertid)
					{
						$response_data['response_code']   = 200;
                        $response_data['response_message'] = 'Comment has posted successfully.';
                        $this->response($response_data);
					}

        }
        
    }//ends function


    public function givereview_post()
    {
        $user_id              = $this->post('user_id');
        $complaint_id         = $this->post('complaint_id');
        $service_type         = $this->post('service_type');
        $remarks              = $this->post('remarks');
        $rating               = $this->post('rating');
       

        if(empty($user_id) || empty($complaint_id) || empty($service_type))
          {

            $response_data['response_code']   = 400;
            $response_data['response_message'] = 'Fields are required.';
            $this->response($response_data);

          }

        else
        {

        	 date_default_timezone_set('Asia/Calcutta'); 
			  $created_date =  date("Y-m-d H:i:s"); 


			  $review = $this->Base_model->get_record_by_id('complaint', array('complaint_id' => $complaint_id));

              $reviewarr = array( 
                 'user_id' 	            => $user_id,
								'vendor_id' 	        => $user_id,
								'complaint_type_id' 	=> $review->complaint_type_id,
								'complaint_sub_type_id' => $review->complaint_sub_type_id,
								'building_id' 	        => $review->building_id,
								'room_id' 	            => $review->room_id,
								'designation_id' 	    => $review->designation_id,
								'name' 	                => $review->name,
								'mobile_no' 	        => $review->mobile_no,
								'landline_no' 	        => $review->landline_no,
								'description' 	        => $review->description,
								'intercom' 	            => $review->intercom,
								'date_created' 	        => $review->date_created,
								'date_resloved' 	    => $created_date,
								'ref_no' 	            => NULL,
								'remarks' 	            => $remarks,
								'complain_rating' 	    => $rating,
								'status' 	            => 'Fixed',
								'service_type'          => $service_type,
								'delete_status' 	    => 1,
								'modified_by' 	        => $user_id,
								'client_ip' 	        => $_SERVER['REMOTE_ADDR'],
								'created_date' 	        => $review->created_date,
								'updated_date'   	    => $created_date
                     );
            
				$updateid = $this->Base_model->update_record_by_id('complaint', $reviewarr,array('complaint_id'=>$complaint_id));

					if($updateid)
					{
						$response_data['response_code']   = 200;
                        $response_data['response_message'] = 'Feedback and review has given successfully.';
                        $this->response($response_data);
					}

        }
        
    }//ends function

   
    
}//class Ends



