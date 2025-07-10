<?php

defined('BASEPATH') OR exit('No direct script access allowed');



/**

 * @package     CodeIgniter

 * @subpackage  Rest Server

 * @category    Customer_Api Controller 

 */



require APPPATH . '/libraries/REST_Controller.php';



class Api extends REST_Controller {



    function __construct() {

        parent::__construct();

        $this->load->model('Base_model');



    }

   



   public function searchPension_post()

   {

      $name      = strip_tags($this->post('name'));
      $ppo_no    = strip_tags($this->post('ppo_no'));
      $status    = strip_tags($this->post('status'));

            if($name)
            { 
              $all_pension_data = $this->Base_model->get_pension_record_search3($name,$status);
              $pensioner = array();

              foreach ($all_pension_data as $pension_data) 
              {
                $pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $pension_data->PENSION_ID));

                $pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $pension_data->PENSION_ID));

                $pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $pension_data->PENSION_ID));

                  if($pension_record_status_data->PENDING_PPO ==0)
                  {
                    $case_pending_with_pao = 'No';
                  }

                  else
                  {
                    $case_pending_with_pao = 'Yes';
                  }

                  if($pension_record_status_data->WITHDRAWAL_REQ_NSDL ==0)
                  {
                    $withdrawl_req_nsdl = 'No';
                  }
                  else
                  {
                    $withdrawl_req_nsdl = 'Yes';
                  }

                  if($pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT ==0)
                  {
                    $status_term_benefir_not_grant = 'No';
                  }
                  else
                  {
                    $status_term_benefir_not_grant = 'Yes';
                  }


                  $pendata['pension_id']        = $pension_data->PENSION_ID;
                  $pendata['employee_name']     = $pension_data->EMPLY_NAME;
                  $pendata['family_mem_name']     = $pension_data->family_mem_name;
                  $pendata['ppo_no']            = $pension_data->PPO_NO;
                  $pendata['retirement_date']   = $pension_data->DATE_RETIREMENT;
                  $pendata['death_date']        = $pension_data->DATE_DEATH;
                  $pendata['division_name']     = $pension_data->DIVIS_DEAL_NAME;
                  $pendata['pension_status']    = $pension_data->PENSION_STATUS;
                  $pendata['pension_type']      = $pension_data->PENSION_TYPE;
                  $pendata['mobile_no']         = $pension_contact_data->MOBILENO;
                  $pendata['gender']         = $pension_contact_data->GENDER;
                  $pendata['relationshp_pensioner']         = $pension_contact_data->RELATIONWITHPENSIONER;
                  $pendata['full_name']         = $pension_contact_data->FULLNAME;
                  $pendata['email']             = $pension_contact_data->EMAILID;
                  $pendata['address']           = $pension_contact_data->ADDRESS;
                  $pendata['case_pending_with_pao'] = $case_pending_with_pao;
                  $pendata['status_pension_paper']  = $pension_record_status_data->STATUS_PENS_PAPER;
                  $pendata['terminal_grant_benefit'] = $pension_record_status_data->TREMINAL_BENIFIT_GRANT;
                  $pendata['withdrawl_req_nsdl']        = $withdrawl_req_nsdl;
                  $pendata['annual_verification']        = $pension_record_status_data->ANNUAL_VERIFICATION;
                  $pendata['status_term_benefir_not_grant']        = $status_term_benefir_not_grant;
                  $pendata['remark']        = $pension_record_remark_data->DESCRIPTION;
                  $pensioner[] = $pendata;

              }//ends foreach

              if(empty($pensioner))

              {
                $resp = array();
              }

              else
              {

                $resp =  $pensioner;

              }
              if($resp)

                    {

                      $response_data['response_code']     = 200;
                      $response_data['response_message'] = 'Success';
                      $response_data['pension_data'] = $resp;
                      $this->response($response_data);  

                    }

                    else

                    {
                      $response_data['response_code']     = 400;
                      $response_data['response_message'] = 'Failed to fetch data';
                      $this->response($response_data);

                    } 
            }//ends if

            else if($ppo_no)

            {
              $pension_data = $this->Base_model->get_record_by_id('pensrecoinfo', array('PPO_NO' => $ppo_no,'DELETES'=>'0')); 
              $pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $pension_data->PENSION_ID));
              $pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $pension_data->PENSION_ID));
              $pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $pension_data->PENSION_ID));

                  
              if($pension_record_status_data->PENDING_PPO ==0)
              {
                $case_pending_with_pao = 'No';
              }

              else
              {
                $case_pending_with_pao = 'Yes';

              }

              if($pension_record_status_data->WITHDRAWAL_REQ_NSDL ==0)
              {
                $withdrawl_req_nsdl = 'No';

              }

              else
              {
                $withdrawl_req_nsdl = 'Yes';
              }

              if($pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT ==0)
              {
                $status_term_benefir_not_grant = 'No';

              }
              else
              {
                $status_term_benefir_not_grant = 'Yes';

              }

              $resp = array(
                'pension_id'                => $pension_data->PENSION_ID,
                'employee_name'             => $pension_data->EMPLY_NAME,
                'family_mem_name'           => $pension_data->FAMILYMEM_NAME,
                'ppo_no'                    => $pension_data->PPO_NO,
                'retirement_date'           => $pension_data->DATE_RETIREMENT,
                'death_date'                => $pension_data->DATE_DEATH,
                'division_name'             => $pension_data->DIVIS_DEAL_NAME,
                'pension_status'            => $pension_data->PENSION_STATUS,
                'pension_type'              => $pension_data->PENSION_TYPE,
                'mobile_no'                 => $pension_contact_data->MOBILENO,
                'full_name'                 => $pension_contact_data->FULLNAME,
                'email'                     => $pension_contact_data->EMAILID,
                'address'                   => $pension_contact_data->ADDRESS,
                'gender'                    => $pension_contact_data->GENDER,
                'relationshp_pensioner'     => $pension_contact_data->RELATIONWITHPENSIONER,
                'case_pending_with_pao'     => $case_pending_with_pao,
                'status_pension_paper'      => $pension_record_status_data->STATUS_PENS_PAPER,
                'annual_verification'       => $pension_record_status_data->ANNUAL_VERIFICATION,
                'terminal_grant_benefit'    => $pension_record_status_data->TREMINAL_BENIFIT_GRANT,
                'withdrawl_req_nsdl'        => $withdrawl_req_nsdl,
                'status_term_benefir_not_grant' => $status_term_benefir_not_grant,
                'remark'                    => $pension_record_remark_data->DESCRIPTION,

              );

              if(empty($pension_data))
              {
                $resp = array();
              }
              else
              {
                $resp =  $resp;
              }

              if($resp)

                    {
                      $response_data['response_code']     = 200;
                      $response_data['response_message'] = 'Success';
                      $response_data['pension_data'] = $resp;
                      $this->response($response_data);  

                    }
                    else
                    {
                      $response_data['response_code']     = 400;
                      $response_data['response_message'] = 'Failed to fetch data';
                      $this->response($response_data);
                    }   
            }// ends else if

            else
            {
              $response_data['response_code']     = 400;
              $response_data['response_message'] = 'Failed to fetch data';
              $this->response($response_data);

            }//ends else

   }


   /**************function for all pension***********/

   public function all_pensions_post()
   {
     $all_pension_data = $this->Base_model->get_all_record_by_condition('pensrecoinfo', array('DELETES'=>'0'));

      $pensioner = array();
       foreach ($all_pension_data as $pension_data) 
              {
                $pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $pension_data->PENSION_ID));

                $pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $pension_data->PENSION_ID));

                $pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $pension_data->PENSION_ID));

                  if($pension_record_status_data->PENDING_PPO ==0)
                  {
                    $case_pending_with_pao = 'No';
                  }

                  else
                  {
                    $case_pending_with_pao = 'Yes';
                  }

                  if($pension_record_status_data->WITHDRAWAL_REQ_NSDL ==0)
                  {
                    $withdrawl_req_nsdl = 'No';
                  }
                  else
                  {
                    $withdrawl_req_nsdl = 'Yes';
                  }

                  if($pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT ==0)
                  {
                    $status_term_benefir_not_grant = 'No';
                  }
                  else
                  {
                    $status_term_benefir_not_grant = 'Yes';
                  }


                  $pendata['pension_id']        = $pension_data->PENSION_ID;
                  $pendata['employee_name']     = $pension_data->EMPLY_NAME;
                  $pendata['family_mem_name']     = $pension_data->family_mem_name;
                  $pendata['ppo_no']            = $pension_data->PPO_NO;
                  $pendata['retirement_date']   = $pension_data->DATE_RETIREMENT;
                  $pendata['death_date']        = $pension_data->DATE_DEATH;
                  $pendata['division_name']     = $pension_data->DIVIS_DEAL_NAME;
                  $pendata['pension_status']    = $pension_data->PENSION_STATUS;
                  $pendata['pension_type']      = $pension_data->PENSION_TYPE;
                  $pendata['mobile_no']         = $pension_contact_data->MOBILENO;
                  $pendata['gender']         = $pension_contact_data->GENDER;
                  $pendata['relationshp_pensioner']         = $pension_contact_data->RELATIONWITHPENSIONER;
                  $pendata['full_name']         = $pension_contact_data->FULLNAME;
                  $pendata['email']             = $pension_contact_data->EMAILID;
                  $pendata['address']           = $pension_contact_data->ADDRESS;
                  $pendata['case_pending_with_pao'] = $case_pending_with_pao;
                  $pendata['status_pension_paper']  = $pension_record_status_data->STATUS_PENS_PAPER;
                  $pendata['terminal_grant_benefit'] = $pension_record_status_data->TREMINAL_BENIFIT_GRANT;
                  $pendata['withdrawl_req_nsdl']        = $withdrawl_req_nsdl;
                  $pendata['annual_verification']        = $pension_record_status_data->ANNUAL_VERIFICATION;
                  $pendata['status_term_benefir_not_grant']        = $status_term_benefir_not_grant;
                  $pendata['remark']        = $pension_record_remark_data->DESCRIPTION;
                  $pensioner[] = $pendata;

              }//ends foreach

              if(empty($pensioner))

              {
                $resp = array();
              }

              else
              {
                $resp =  $pensioner;
              }
              if($resp)
                    {
                      $response_data['response_code']     = 200;
                      $response_data['response_message'] = 'Success';
                      $response_data['pension_data'] = $resp;
                      $this->response($response_data);  

                    }
                    else
                    {
                      $response_data['response_code']     = 400;
                      $response_data['response_message'] = 'Failed to fetch data';
                      $this->response($response_data);
                    } 
   }//ends function

    /*********function for pension detail*******/

  public function pension_post()

   {

      $pension_id      = strip_tags($this->post('pension_id'));

      if(empty($pension_id))

       {
            $response_data['response_code']     = 400;

            $response_data['response_message'] = 'Pension id is required.';

            $this->response($response_data);

       }//ends if

       else

       {
            $pension_data = $this->Base_model->get_record_by_id('pensrecoinfo', array('PENSION_ID' => $pension_id,'DELETES'=>'0')); 

              $pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $pension_data->PENSION_ID));

              $pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $pension_data->PENSION_ID));

              $pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $pension_data->PENSION_ID));

                  



              if($pension_record_status_data->PENDING_PPO ==0)

              {

                $case_pending_with_pao = 'No';

              }



              else

              {

                $case_pending_with_pao = 'Yes';

              }



              if($pension_record_status_data->WITHDRAWAL_REQ_NSDL ==0)

              {

                $withdrawl_req_nsdl = 'No';

              }



              else

              {

                $withdrawl_req_nsdl = 'Yes';

              }



              if($pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT ==0)

              {

                $status_term_benefir_not_grant = 'No';

              }



              else

              {

                $status_term_benefir_not_grant = 'Yes';

              }



  



              $resp = array(

                'pension_id'                => $pension_data->PENSION_ID,

                'employee_name'             => $pension_data->EMPLY_NAME,

                'family_mem_name'           => $pension_data->FAMILYMEM_NAME,

                'ppo_no'                    => $pension_data->PPO_NO,

                'retirement_date'           => $pension_data->DATE_RETIREMENT,

                'death_date'                => $pension_data->DATE_DEATH,

                'division_name'             => $pension_data->DIVIS_DEAL_NAME,

                'pension_status'            => $pension_data->PENSION_STATUS,

                'pension_type'              => $pension_data->PENSION_TYPE,

                'mobile_no'                 => $pension_contact_data->MOBILENO,

                'full_name'                 => $pension_contact_data->FULLNAME,

                'email'                     => $pension_contact_data->EMAILID,

                'gender'                    => $pension_contact_data->GENDER,
                'relationshp_pensioner'     => $pension_contact_data->RELATIONWITHPENSIONER,

                'address'                   => $pension_contact_data->ADDRESS,

                'case_pending_with_pao'     => $case_pending_with_pao,

                'status_pension_paper'      => $pension_record_status_data->STATUS_PENS_PAPER,

                'terminal_grant_benefit'    => $pension_record_status_data->TREMINAL_BENIFIT_GRANT,

                'withdrawl_req_nsdl'        => $withdrawl_req_nsdl,

                'annual_verification'       => $pension_record_status_data->ANNUAL_VERIFICATION,

                'status_term_benefir_not_grant' => $status_term_benefir_not_grant,

                'remark'                    => $pension_record_remark_data->DESCRIPTION,



              );



              if(empty($pension_data))

              {

                $resp = array();

              }

              else

              {

                $resp =  $resp;

              }



              if($resp)

                    {

                      $response_data['response_code']     = 200;

                      $response_data['response_message'] = 'Success';

                      $response_data['pension_data'] = $resp;

                      $this->response($response_data);  

                    }



                    else

                    {

                      $response_data['response_code']     = 400;

                      $response_data['response_message'] = 'Failed to fetch data';

                      $this->response($response_data);

                    }   

       }//ends else

   }//ends function

   

       

  

}//class Ends







