<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @package     CodeIgniter
 * @subpackage  Rest Server
 * @category    Customer_Api Controller 
 */

require APPPATH . '/libraries/REST_Controller.php';

class Auth extends REST_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Base_model');

    }
   
  /***********Login*********/

    public function login_post()
    { 

        $mobile_no          = $this->post('mobile_no');
        $device_type        = $this->post('device_type');
        $device_token       = $this->post('device_token');  
        date_default_timezone_set('Asia/Calcutta'); 
        $created_date       =  date("Y-m-d H:i:s"); 

        $checked_mobile = $this->Base_model->check_existent('users', array('contact_no' => $mobile_no));

        $checked_status = $this->Base_model->get_record_by_id('users', array('contact_no' => $mobile_no));
     

        if(empty($mobile_no))
        {
            $response_data['response_code']    = 400;
            $response_data['response_message'] = 'Mobile no. is required.';
            $this->response($response_data);
            
        } 
        else if($checked_mobile == '0')
        {
            $response_data['response_code']    = 400;
            $response_data['response_message'] = 'Mobile number not exits.';
            $this->response($response_data);

        } else if($checked_status->status == '0'){

        	$response_data['response_code']    = 400;
            $response_data['response_message'] = 'Your account has deactived. Please contact your system administartor.';
            $this->response($response_data);


        } else if($checked_status->delete_status == '0'){

        	$response_data['response_code']    = 400;
            $response_data['response_message'] = 'Your account has deleted. Please contact your system administartor.';
            $this->response($response_data);


        }  else
         {

               $otp = rand(1000,9999);
               $this->load->library('twilio');
               $send_otp = $this->twilio->sms('+12674364463', '+91'.$mobile_no, 'Your OTP is: '.$otp);
               $update_data = array(
                                    'mobile_otp'        => $otp,
                                    'otp_request_time'  => $created_date         
                                    );
              

                if($send_otp == 1)
                {
                    $this->Base_model->update_record_by_id('users', $update_data, array('contact_no'=> $mobile_no));

                    $this->load->library('email');
                    $this->email->set_mailtype("html");
                    $this->email->from('support-cwc@gov.in');
                    $this->email->to($checked_status->email);
                    $this->email->subject('OTP for Login');
                    $this->email->message('Your login OTP is:'.$otp);
                    $this->email->send();

                    $this->getotp($checked_status->contact_no,$otp);

                  //   $response_data['response_code'] = 200;
                   //  $response_data['response_message'] = 'OTP sent to your mobile number.';

                   //  print_r($response_data); exit;

                   //  $this->response($response_data);
                     
                }//ends if

                else
                {
                    $response_data['response_code'] = 400;
                    $response_data['response_message'] = 'Failed to sent OTP.';
                    $this->response($response_data);      

                }//ends else
        }//ends main else  
                 
    }//ends function
        
    
    /***********Verify OTP*************/

    public function verifyotp_post()
    {
        
        $mobile_no = $this->post('mobile_no');
        $device_type        = $this->post('device_type');
        $device_token       = $this->post('device_token');  
        $otp = $this->post('otp');
        date_default_timezone_set('Asia/Calcutta'); 
        $created_date =  date("Y-m-d H:i:s");
        
        $verification_data = $this->Base_model->get_record_by_id('users', array('contact_no' => $mobile_no));
        
         if(empty($mobile_no)||empty($otp))
        {
            $response_data['response_code']   = 400;
            $response_data['response_message'] = 'Fields are required.';
            $this->response($response_data);
            
        } 

         else if($verification_data->mobile_otp != $otp)
         {
            $response_data['response_code']   = 400;
            $response_data['response_message'] = 'Please enter correct otp.';
            $this->response($response_data);
         }

         else if($verification_data->mobile_otp == $otp)
         {
            $device_data = array(
                                    'user_id'           => $verification_data->user_id,
                                    'device_type'       => $device_type,
                                    'device_id'         => $device_token,
                                    'created_date'      => $created_date,
                                    'updated_date'      => $created_date         
                                   );

           $checked_device = $this->Base_model->check_existent('user_device', array('user_id' => $verification_data->user_id,'device_type'=>$device_type,'device_id'=>$device_token));
            
            if($checked_device=='1')
             {
                $this->Base_model->update_record_by_id('user_device', $device_data, array('user_id' => $verification_data->user_id,'device_type'=>$device_type,'device_id'=>$device_token));
             }

             else
             {
                $this->Base_model->insert_one_row('user_device', $device_data);
             }

             $user_data = $this->Base_model->get_record_by_id('users', array('contact_no' => $mobile_no));

             $resp = array(           
                            'user_id'             => $user_data->user_id,
                            'user_name'           => $user_data->user_name,
                            'user_email'          => $user_data->email,
                            'user_mobile_no'      => $user_data->contact_no,
                            'user_displayname'    => $user_data->display_name,
                            'user_employee_id'    => $user_data->employee_id
                          );

             $response_data['response_code'] = 200;
             $response_data['response_message'] = 'Login Successfully.';
             $response_data['user_data'] = $resp;
             $this->response($response_data);
         }

        else
        {
            
            $response_data['response_code'] = 400;
            $response_data['response_message'] = 'Failed to login';
            $this->response($response_data);
        }
                
    }//ends function
        
    /************Logout**********/

    public function logout_post()
     {
      
      $user_id      =  $this->post('user_id');
      $device_type  = $this->post('device_type');
      $device_token = $this->post('device_token');  
      
        if(empty($user_id) || empty($device_type) || empty($device_token))
        {
          $response_data['response_code']   = 400;
          $response_data['response_message'] = 'Fields are required';
          $this->response($response_data);
          
        } 
        else 
        { 
           $this->db->where(array('user_id' => $user_id,'device_type' => $device_type,'device_token' => $device_token));
           $this->db->delete('device'); 
          
           $response_data['response_code']   = 200;
           $response_data['response_message'] = 'Logout Successfully';
           $this->response($response_data);
          
        }
      
    }//ends function



     public function otpfunction($mobile, $smsOtp){


         $otpmessage= urlencode($smsOtp." is your OTP for login.");

         $url="http://45.114.143.11/api.php?username=getcaptain&password=965437&sender=MLNCTR&sendto=".$mobile."&message=".$otpmessage;

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_exec($ch);
        curl_close($ch);


    }
   

   function getotp($mobile, $smsOtp)
        {

           header('Content-Type: application/json');

        $otpmessage= urlencode($smsOtp." is your OTP for login. It is confidential. For security reasons, DO NOT share this OTP with anyone.");
        $url="http://45.114.143.11/api.php?username=getcaptain&password=965437&sender=MLNCTR&sendto=".$mobile."&message=".$otpmessage;

                $context = stream_context_create(array('http'=>array('protocol_version'=>'1.1')));
                if(file_get_contents($url, false, $context))
                {
                   $response=array(
                                   'response_code'=>200,
                                    'response_message'=>'OTP sent to your mobile number.'
                                 );
                }else
                {
                  
                  $response=array(
                                   'response_code'=>400,
                                    'response_message'=>'Falied to send otp.'
                                 );

                }

            echo json_encode($response);die; 
        

        }
       
    
}//class Ends



