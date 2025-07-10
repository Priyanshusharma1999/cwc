<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package     CodeIgniter
 * @subpackage  Rest Server
 * @category    Customer_Api Controller 
 */

require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Base_model');
        $this->load->model('Admin_model');

    }
   
  /***********get user data*********/

    public function userdata_post()
    { 
        $user_id            = $this->post('user_id'); 
        date_default_timezone_set('Asia/Calcutta'); 
        $created_date       =  date("Y-m-d H:i:s"); 
     

        if(empty($user_id))
        {
            $response_data['response_code']    = 400;
            $response_data['response_message'] = 'User id is required.';
            $this->response($response_data);
            
        } 
       
            
        else
        {
            $user_data = $this->Base_model->get_record_by_id('users', array('user_id' => $user_id));

            $resp = array(           
                            'user_id'             => $user_data->user_id,
                            'user_name'           => $user_data->user_name,
                            'user_email'          => $user_data->email,
                            'user_mobile_no'      => $user_data->contact_no,
                            'user_displayname'    => $user_data->display_name,
                            'user_employee_id'    => $user_data->employee_id
                          );
             if($resp)
             {
                 $response_data['response_code'] = 200;
                 $response_data['response_message'] = 'Fetch data successfully.';
                 $response_data['user_data'] = $resp;
                 $this->response($response_data);
             }

             else
             {
                 $response_data['response_code'] = 400;
                 $response_data['response_message'] = 'Failed to fetch data.';
                 $this->response($response_data);
             }
            
        }//ends main else               
                 
    }//ends function


    /*************Edit profile**********/


    public function editProfile_post()
    {
      $user_id        = $this->post('user_id');
      $name           = $this->post('name');
      $email          = $this->post('email');
      $image          = $this->post('image');
      $password       = $this->post('password');
      date_default_timezone_set('Asia/Calcutta'); 
      $created_date =  date("Y-m-d H:i:s"); 
      $checked_email = $this->Admin_model->check_existent_user_email($email, $user_id);

      if(empty($user_id)||empty($name)||empty($email)||empty($image))
       {
            $response_data['response_code']     = 400;
            $response_data['response_message'] = 'Fields are required.';
            $this->response($response_data);
       }// ends if

       else if($checked_email == 1)
       {
           $response_data['response_code']     = 400;
           $response_data['response_message'] = 'Please use different email, as this is used by someone else.';
           $this->response($response_data);
       }
       else
       {
          $user_id =  $user_id; 
          $user_name = $name;
          $pic_name = $user_name.'_'.$user_id.'_'.time().'_photo'.'.jpg';

          /******image code starts *******/
    
          $imagename   = $pic_name;
          $content = file_get_contents($image);
          $destination = './uploads/users/'.$imagename;
          $user_imgg = file_put_contents($destination, base64_decode($image));

          /******image code ends *******/

           if(empty($password))
               {
                  $update_data = array(
                          'user_name'     => $name,
                          'email'         => $email,
                          'image'         => $imagename,
                          'updated_date'  => $created_date
                        );
               }

               else
               {
                  $update_data = array(
                          'user_name'     => $name,
                          'email'         => $email,
                          'image'         => $imagename,
                          'password'      => md5($password),
                          'updated_date'  => $created_date
                        );
               }

              $updateid = $this->Base_model->update_record_by_id('users', $update_data, array('user_id'=> $user_id));
              if($updateid)
              {
                   $response_data['response_code']     = 200;
                   $response_data['response_message'] = 'Profile updated successfully.';
                   $this->response($response_data);
              }

              else
              {
                   $response_data['response_code']     = 400;
                   $response_data['response_message'] = 'Failed to update profile.';
                   $this->response($response_data);
              }
       }//end else

    }//ends function

    /*************function to get data at complaint section***********/

     public function userComplaintData_post()
    {
      $user_id        = $this->post('user_id');

      if(empty($user_id))
       {
            $response_data['response_code']     = 400;
            $response_data['response_message'] = 'User id is required.';
            $this->response($response_data);
       }// ends if

       else
       {
            $it_complain_category = $this->Base_model->get_all_record_by_condition('category',array('status'=>'1','delete_status'=>'1','service_type'=>1));

            $nonit_complain_category = $this->Base_model->get_all_record_by_condition('category',array('status'=>'1','delete_status'=>'1','service_type'=>2));

            $all_it = array();
            foreach ($it_complain_category as $it) 
            {
                $all_it[] = $it;
            }

            $all_nonit = array();
            foreach ($nonit_complain_category as $nonit) 
            {
                $all_nonit[] = $nonit;
            }

             $user_detail = $this->Base_model->get_record_by_id('users',array('user_id'=>$user_id));

              $designation = $this->Base_model->get_record_by_id('designation',array('status'=>'1','delete_status'=>'1','designation_name'=>$user_detail->designation));
            
              $building= $this->Base_model->get_record_by_id('building',array('status'=>'1','delete_status'=>'1','building_id'=>$user_detail->building_id));
            
              $room = $this->Base_model->get_record_by_id('room_no',array('status'=>'1','delete_status'=>'1','room_id'=>$user_detail->room_id));

              $resp = array(
                'all_it_category'           => $all_it,
                'all_non_category'          => $all_nonit,
                'user_name'                 => $user_detail->user_name,
                'building_name'             => $building->building_name,
                'building_id'               => $building->building_id,
                'designation'               => $designation->designation_name,
                'designation_id'            => $designation->designation_id,
                'room_id'                   => $room->room_id,
                'room_name'                 => $room->room_name,
                'contact_no'                => $user_detail->contact_no,

              );

              if($resp)
             {
                 $response_data['response_code'] = 200;
                 $response_data['response_message'] = 'Fetch data successfully.';
                 $response_data['response'] = $resp;
                 $this->response($response_data);
             }

             else
             {
                 $response_data['response_code'] = 400;
                 $response_data['response_message'] = 'Failed to fetch data.';
                 $this->response($response_data);
             }
       }
     
    }//ends function

    /*************function to add complaint data***********/

       
    
}//class Ends



