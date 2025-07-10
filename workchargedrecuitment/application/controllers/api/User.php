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



    }


    /*******Profile*******/

    public function profile_post()

    {

      $user_id          = strip_tags($this->post('user_id'));

      if(empty($user_id))

       {

            $response_data['response_code']     = 400;

            $response_data['response_message'] = 'User id is required.';

            $this->response($response_data);

       }



       else

       {

          $user_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $user_id));

          $resp = array(

                      

                      'user_id'           => $user_data->id,

                      'user_name'         => $user_data->name,

                      'user_email'        => $user_data->email,

                      'user_mobile_no'    => $user_data->mobile_no,

                      'user_gender'       => $user_data->gender,

                      'user_dob'          => $user_data->dob,

                      'user_image'        => base_url().'uploads/applicant_profile_photos/'.$user_data->image,

                    );

                    

                    if(empty($resp))

                    {

                      $resp = array();

                    }

                    else

                    {

                      $resp =  $resp;

                    }



                    if($user_data)

                    {

                      $response_data['response_code']     = 200;

                      $response_data['response_message'] = 'Success';

                      $response_data['user_detail'] = $resp;

                      $this->response($response_data);  

                    }



                    else

                    {

                      $response_data['response_code']     = 400;

                      $response_data['response_message'] = 'Failed to fetch data';

                      $this->response($response_data);

                    }   

       }//ends main else

    }//ends function



    /*************Update Profile*********/



    public function editProfile_post()

    {

      $user_id        = strip_tags($this->post('user_id'));

      $name           = strip_tags($this->post('name'));

      $email          = strip_tags($this->post('email'));

      $mobile         = strip_tags($this->post('mobile'));

      $dob            = strip_tags($this->post('dob'));

      $gender         = strip_tags($this->post('gender'));

      $image          = strip_tags($this->post('image'));

      $password       = strip_tags($this->post('password'));

      date_default_timezone_set('Asia/Calcutta'); 

      $created_date =  date("Y-m-d H:i:s"); 

      $checked_email = $this->Base_model->check_applicant_query($email, $user_id);



      if(empty($user_id)||empty($name)||empty($email)||empty($mobile)||empty($dob)||empty($gender)||empty($image))

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

       //  $certificate = $i.'User_Certificate'.'-'.time().'.'.$image1['type'];

      //$destination = 'uploads/users/certificate/'.$certificate;

      //$fid = file_put_contents($destination, base64_decode($image1['certifi']));

          $imagename   = $pic_name;

          $content = file_get_contents($image);

          $destination = './uploads/applicant_profile_photos/'.$imagename;

          $user_imgg = file_put_contents($destination, base64_decode($image));



          /******image code ends *******/



           if(empty($password))

               {

                  $update_data = array(

                          'name'          => $name,

                          'email'         => $email,

                          'mobile_no'     => $mobile,

                          'dob'           => $dob,

                          'gender'        => $gender,

                          'image'         => $imagename,

                          'updated_date'  => $created_date

                        );

               }



               else

               {

                  $update_data = array(

                          'name'          => $name,

                          'email'         => $email,

                          'mobile_no'     => $mobile_no,

                          'dob'           => $dob,

                          'gender'        => $gender,

                          'image'         => $imagename,

                          'password'      => md5($password),

                          'updated_date'  => $created_date

                        );

               }



              $updateid = $this->Base_model->update_record_by_id('tbl_applicant', $update_data, array('id'=> $user_id));

              if($updateid)

              {

                   $response_data['response_code']     = 200;

                   $response_data['response_message'] = 'Profile updated successfully.';

                   $this->response($response_data);

              }



              else

              {

                   $response_data['response_code']     = 400;

                   $response_data['response_message'] = 'Failed to update.';

                   $this->response($response_data);

              }

       }//end else



    }//ends function



    /**************Applicant Job List********/



    public function userJobList_post()

    {

      $user_id          = strip_tags($this->post('user_id'));



      if(empty($user_id))

       {

            $response_data['response_code']     = 400;

            $response_data['response_message'] = 'User id is required.';

            $this->response($response_data);

       }// ends if



       else

       {

          $all_applicant_jobs = $this->Base_model->get_all_record_by_condition('tbl_app_job_bas_info', array('applicant_id'=>$user_id,'status' => '1'));



          $all_jobData = array();

          foreach ($all_applicant_jobs as $job_data)

           {



              $region_data = $this->Base_model->get_record_by_id('tbl_region', array('id'=>$job_data->region_id));

              $circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id'=>$job_data->circle_id));

              $job = $this->Base_model->get_all_record_by_condition('tbl_jobs', array('id'=>$job_data->job_id));

              $pdf_name = $job_data->pdf_name;


              $base_url = base_url();
              $data['job_title']   = $job[0]->job_title;

              $data['region']      = $region_data->region_name;

              $data['circle']      = $circle_data->circle_name;

              $data['user_pdf']    = $base_url.'uploads/applicant_pdf/'.$pdf_name.'.pdf';

              $all_jobData[] = $data;



           }//ends for each



           if(empty($all_jobData))

           {

                $response_data['response_code']     = 400;

                $response_data['response_message'] = 'No records found.';

                $this->response($response_data);

           }// ends if



           else

           {

              $response_data['response_code']     = 200;

              $response_data['response_message'] = 'Success';

              $response_data['user_jobList'] = $all_jobData;

              $this->response($response_data);

           }

       }//ends main else

    }



    /**************Job List********/



    public function allJobList_post()

    {

        $all_jobs = $this->Base_model->all_active_jobs();



        $all_jobData = array();

        foreach ($all_jobs as $job_data)

        {

          $region_data = $this->Base_model->get_record_by_id('tbl_region', array('id'=>$job_data->region_id));

          $circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id'=>$job_data->circle_id));

          $circular_data = $this->Base_model->get_record_by_id('tbl_circular', array('circle_id'=>$job_data->circle_id,'job_id'=>$job_data->id));



          if(empty($circular_data->file))

          {

            $pdf = '';

          }



          else

          {
            $base_url = base_url();
            $pdf = $base_url.'uploads/circular/'.$circular_data->file;

          }



            $data['job_title']   = $job_data->job_title;

            $data['region']      = $region_data->region_name;

            $data['circle']      = $circle_data->circle_name;

            $data['start_date']  = $job_data->start_date;

            $data['end_date']    = $job_data->end_date;

            $data['circle']      = $circle_data->circle_name;

            $data['user_pdf']    = $pdf;

            $all_jobData[] = $data;

        }//ends foreach



         if(empty($all_jobData))

           {

                $response_data['response_code']     = 400;

                $response_data['response_message'] = 'No records found.';

                $this->response($response_data);

           }// ends if



           else

           {

              $response_data['response_code']     = 200;

              $response_data['response_message'] = 'Success';

              $response_data['job_list'] = $all_jobData;

              $this->response($response_data);

           }



    }// function ends

   

       

  

}//class Ends







