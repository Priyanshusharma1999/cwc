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
   
        /*******Sign up*******/

        public function register_post()
        {
            $name               = $this->post('name');
            $email              = $this->post('email');
            $mobile             = $this->post('mobile');
            $dob                = $this->post('dob');
            $gender             = $this->post('gender');
            date_default_timezone_set('Asia/Calcutta'); 
            $created_date =  date("Y-m-d H:i:s"); 

            $checked_phone_verify = $this->Base_model->check_existent('tbl_verification', array('mobile_no' => $mobile,'status_mobile'=>'0'));

        $checked_phone_verify2 = $this->Base_model->check_existent('tbl_verification', array('mobile_no' => $mobile,'status_mobile'=>'1'));

        $checked_applicant_email = $this->Base_model->check_existent('tbl_applicant', array('email' => $email));
            

            if(empty($name)||empty($email)||empty($mobile)||empty($dob)||empty($gender))
         {
            $response_data['response_code']         = 400;
            $response_data['response_message'] = 'Fields are required.';
            $this->response($response_data);
         }

        /* else if($checked_phone_verify2 == '1')
                {
                    $response_data['response_code']         = 400;
            $response_data['response_message'] = 'Number already verified.';
            $this->response($response_data);
                }*/

         else if($checked_phone_verify == '1')
                {
                    $response_data['response_code']         = 400;
                    $response_data['response_message'] = 'Please verify your mobile no.';
                     $this->response($response_data);
                }

         else if($checked_applicant_email == '1')
                {
                    $response_data['response_code']         = 400;
                    $response_data['response_message'] = 'User already registered, Please enter new one.';
                    $this->response($response_data);
                }


         else
         {

                $insert_data = array(
                                    'name'                              => $name,
                                    'email'                             => $email,
                                    'mobile_no'                     => $mobile,
                                    'gender'                            => $gender,
                                    'dob'                               => $dob,
                                    'created_date'              => $created_date,
                                    'updated_date'              => $created_date
                                );
                                
                $insertid = $this->Base_model->insert_one_row('tbl_applicant', $insert_data);
                $user_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $insertid));
                                $resp = array(
                                        
                                        'user_id'                     => $user_data->id,
                                        'user_name'                 => $user_data->name,
                                        'user_email'                => $user_data->email,
                                        'user_mobile_no'        => $user_data->mobile_no,
                                        'user_gender'           => $user_data->gender,
                                        'user_dob'                  => $user_data->dob

                                    );
                  /**********random password*****/
                            $length = '6';
                            $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                            $charactersLength = strlen($characters);
                            $randomString = '';
                            for ($i = 0; $i < $length; $i++) {
                                $randomString .= $characters[rand(0, $charactersLength - 1)];
                            }

                        /**Ends random pwd**/
                         $update_data = array(
                              'password' => md5($randomString)
                            );
                         $this->load->library('twilio');
                        $send_otp = $this->twilio->sms('+12674364463', '+91'.$mobile, 'Your Password is: '.$randomString);
                        $this->Base_model->update_record_by_id('tbl_applicant', $update_data, array('id'=> $insertid));

                                    
                                    if(empty($resp))
                                    {
                                        $resp = array();
                                    }
                                    else
                                    {
                                        $resp =  $resp;
                                    }

                                    if($insertid)
                                    {
                                $response_data['response_code']         = 200;
                                $response_data['response_message'] = 'Success';
                                $response_data['response'] = $resp;
                                $this->response($response_data);    
                                    }

                                    else
                                    {
                                        $response_data['response_code']         = 400;
                                $response_data['response_message'] = 'Failed to register.';
                                $this->response($response_data);
                                    }

                                    
                
         }//ends main else
        }//ends function
    
    
    public function login_post()
        {
            $email              = $this->post('email');
            $password           = $this->post('password');
            $device_type        = $this->post('devicetype');
            $device_id          = $this->post('deviceid');
            
            date_default_timezone_set('Asia/Calcutta'); 
            $created_date =  date("Y-m-d H:i:s"); 

          $checked_applicant_email = $this->Base_model->check_existent('tbl_applicant', array('email' => $email));
            

           if(empty($email)||empty($password)||empty($device_type)||empty($device_id))
            {
                $response_data['response_code']   = 400;
                $response_data['response_message'] = 'Fields are required.';
                $this->response($response_data);
                
            } else if($checked_applicant_email == '0')
              {
                    $response_data['response_code']  = 400;
                    $response_data['response_message'] = 'Email not registered, Please create account';
                    $this->response($response_data);
              }
                
            else{
                
                    $table = 'tbl_applicant';
                    
                    
                    $data = array(
                                'email' => $email,
                                'password' => md5($password)
                            );

                    $applicant_data = $this->Base_model->get_login_data($table, $data);
                    
                    if($applicant_data)
                        {
                            
                            $insert_data = array(
                                    'user_id'                   => $applicant_data[0]['id'],
                                    'device_type'               => $device_type,
                                    'device_id'                 => $device_id,
                                    'created_date'              => $created_date,
                                    'updated_date'              => $created_date
                                );
                                
                              $insertid = $this->Base_model->insert_one_row('tbl_device', $insert_data);
                              
                              if($insertid){
                                  
                                  
                                $resp = array(
                                    'user_id'               => $applicant_data[0]['id'],
                                    'user_name'             => $applicant_data[0]['name'],
                                    'user_email'            => $applicant_data[0]['email'],
                                    'user_mobile_no'        => $applicant_data[0]['mobile_no'],
                                    'user_gender'           => $applicant_data[0]['gender'],
                                    'user_dob'              => $applicant_data[0]['dob']
                                );
                                
                                if(empty($resp))
                                {
                                    $resp = array();
                                }
                                else
                                {
                                    $resp =  $resp;
                                }
                                
                                $response_data['response_code']         = 200;
                                $response_data['response_message'] = 'Login Success';
                                $response_data['response'] = $resp;
                                $this->response($response_data);
                                  
                              } else {
                                  
                                $response_data['response_code'] = 400;
                                $response_data['response_message'] = 'Failed to Login.';
                                $this->response($response_data);
                                  
                              }
                
                        
                            
                        }//ends if

                        else
                        {
                        
                            $response_data['response_code'] = 400;
                            $response_data['response_message'] = 'Failed to Login.';
                            $this->response($response_data);
                                
                        }
            }               
                
         
        }//ends function
        
        
        
        
        public function verifyotp_post()
        {
            
            $phone = $this->post('phone');
            $otp_enter = $this->post('otp_enter');
            date_default_timezone_set('Asia/Calcutta'); 
            $created_date =  date("Y-m-d H:i:s");
            
            $verification_data = $this->Base_model->get_record_by_id('tbl_verification', array('mobile_no' => $phone));
            
             if(empty($phone)||empty($otp_enter))
            {
                $response_data['response_code']   = 400;
                $response_data['response_message'] = 'Fields are required.';
                $this->response($response_data);
                
            } else if($verification_data->mobile_otp == $otp_enter)
             {
                $update_data = array(
                    'status_mobile' => 1,
                    'updated_date'  => $created_date
                );
                
                $this->Base_model->update_record_by_id('tbl_verification', $update_data, array('mobile_no'=> $phone));
            
                $response_data['response_code'] = 200;
                $response_data['response_message'] = 'OTP has verified';
                $this->response($response_data);
             }

            else
            {
                
                $response_data['response_code'] = 400;
                $response_data['response_message'] = 'OTP has not verified';
                $this->response($response_data);
            
        
            }
                    
        }//ends function
        
        
        
    public function sendotp_post()
       {

        $phone = $this->post('phone');
        date_default_timezone_set('Asia/Calcutta'); 
        $created_date =  date("Y-m-d H:i:s");
        
          if(empty($phone))
            {
                $response_data['response_code']   = 400;
                $response_data['response_message'] = 'Fields are required.';
                $this->response($response_data);
                
            }  else
             {
                
                    $checked = $this->Base_model->check_existent('tbl_verification', array('mobile_no'=> $phone,'status_mobile'=>1));

                    $checked2 = $this->Base_model->check_existent('tbl_verification', array('mobile_no'=> $phone,'status_mobile'=>0));

                    if($checked==1)
                      { 
                            
                        $response_data['response_code'] = 400;
                        $response_data['response_message'] = 'Mobile no. is already in used, Please try with different number';
                        $this->response($response_data);
                            
                     } //ends if

                        
                    else
                    {
                        
                        $otp = rand(1000,9999);
                        $this->load->library('twilio');
                        $send_otp = $this->twilio->sms('+12674364463', '+91'.$phone, 'Your OTP is: '.$otp);

                        if($send_otp == 1)
                        {
                            $update_data = array(
                                                //'email'                   => $email,
                                                'mobile_no'         => $phone,
                                                'mobile_otp'        => $otp,
                                                'updated_date'  => $created_date
                                                
                                            );
                            $insert_data = array(
                                                //'email'                   => $email,
                                                'mobile_no'         => $phone,
                                                'mobile_otp'        => $otp,
                                                'status_mobile'     => 0,
                                                'updated_date'  => $created_date
                                                
                                            );
                           if($checked2==1)
                           {
                                 $this->Base_model->update_record_by_id('tbl_verification', $update_data, array('mobile_no'=> $phone));
                           }

                           else
                           {
                            
                                $this->Base_model->insert_one_row('tbl_verification', $insert_data);
                           }              
                           
                           
                          $response_data['response_code'] = 200;
                          $response_data['response_message'] = 'OTP sent to your mobile number.';
                          $this->response($response_data);
                        }

                        else
                        {
                            
                          $response_data['response_code'] = 400;
                          $response_data['response_message'] = 'Failed to send OTP';
                          $this->response($response_data);
                            
                        }
                            
                    }//ends else
            }//ends else

       }//ends function


       public function logout_post()
     {
      
      $userid =  $this->post('userid');
      $device_type = $this->post('devicetype');
      $device_id   = $this->post('deviceid');
      
      if(empty($userid) || empty($device_type) || empty($device_id)){
        
        $response_data['response_code']   = 400;
        $response_data['response_message'] = 'Fields Can not be empty';
        $this->response($response_data);
        
      } else {
        
         $this->db->where(array('user_id' => $userid,'device_type' => $device_type,'device_id' => $device_id));
     
           $this->db->delete('tbl_device'); 
        
         $response_data['response_code']   = 200;
         $response_data['response_message'] = 'Logout Successfully';
         $this->response($response_data);
        
      }
      
    }
   
       
    
}//class Ends



