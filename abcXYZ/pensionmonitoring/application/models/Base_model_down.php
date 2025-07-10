<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Base_model extends CI_Model
{
    /**
     * Get data from passed table name with given where condition
     *
     * @param string $table
     * @param array  $where
     *
     * @return array
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get data from passed table name with given where condition
     *
     * @param string $table
     * @param array  $where
     *
     * @return array
     */
    public function get_login_data($table,$data)
    {
            $result = $this->db->get_where($table,$data);
            
            return $result->result_array();
    }
    
    
    public function get_userdata($email, $username, $password){
              
               /* $query = $this->db->query("
                          SELECT * FROM `users` WHERE `EMAIL` = '".$email."' AND `PASSWORD` = '".md5($password)."' AND `DELETES` = 0 OR `LOGONID` = '".$email."'  AND `PASSWORD` = '".md5($password)."' AND `DELETES` = 0");*/

                 $query = $this->db->query("
                          SELECT * FROM `users` WHERE `EMAIL` = '".$email."' AND `PASSWORD` = '".$password."' AND `DELETES` = 0 OR `LOGONID` = '".$email."'  AND `PASSWORD` = '".$password."' AND `DELETES` = 0");
                    
                return $query->result_array();
            
    }

    /**
     * Get data from passed table name with given where condition
     *
     * @param string $table
     * @param array  $where
     *
     * @return array
     */
     
    public function insert_one_row($table, $data)
    {
        $query = $this->db->insert($table, $data);

        return $this->db->insert_id();
    }

    /**
     * Get data from passed table name with given where condition
     *
     * @param string $table
     * @param array  $where
     *
     * @return array
     */
    public function check_existent($table, $where)
    {
        $query = $this->db->get_where($table, $where); 
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    public function check_existent_oraganisation($orgaisation,$id)
    {
        $query = $this->db->query("SELECT * FROM `organization` WHERE `ORGNAME` = '".$orgaisation."' AND `ORGANIZATION_ID` != '".$id."' ");
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    public function user_existance($email, $username){
        
                $this->db->select('*');
                $this->db->from('users');
                $this->db->where(array('DELETES' => 0));
                $this->db->where(array('EMAIL' => $email));
                $this->db->or_where(array('LOGONID' => $username));
                $query = $this->db->get();
                
                if ($query->num_rows() > 0) {
                    return 1;
                } else {
                    return 0;
                }
                
        }


    /**
     * Get data from passed table name with given where condition
     *
     * @param string $table
     * @param array  $where
     *
     * @return array
     */
    public function get_all_record_by_condition($table, $data)
    {
        
        $query = $this->db->get_where($table, $data);
        return $query->result();
    }

   
    /**
     * Get data from passed table name with given where condition
     *
     * @param string $table
     * @param array  $where
     *
     * @return array
     */
    public function get_record_by_id($table, $data)
    {
        $query = $this->db->get_where($table, $data);
        return $query->row();

        
    }

    /**
     * Update data to passed table name with given where condition
     *
     * @param string $table
     * @param array  $where
     *
     * @return array
     */
    public function update_record_by_id($table, $data, $where)
    {
        $query = $this->db->update($table, $data, $where);
        return 1;
    }

   
    /**********function for Organization search*******/

    public function search_organization($org_name)
    {
        $this->db->select('*');
        $this->db->from('organization');
        $this->db->where('delete_status',0);
        $this->db->like('ORGNAME', $org_name);
        $this->db->order_by("ORGANIZATION_ID", "ASC");
        $query = $this->db->get();
        return $query->result();
    }
    
    
     /**********function for Division search*******/
     
    public function search_division($division_name)
    {
        
        $this->db->select('*');
        $this->db->from('division');
        $this->db->like('DIVISIONNAME', $division_name);
        $this->db->join('organization', 'division.ORGANIZATION_ID = organization.ORGANIZATION_ID');
        $this->db->where(array('division.status' => 1));
        $this->db->order_by("DIVISION_ID", "ASC"); 
        $query = $this->db->get();
        
        return $query->result();
    }
    
    
     public function search_pension($pension_status)
    {
        $this->db->select('*');
        $this->db->from('pensrecoinfo');
        $this->db->where('DELETES',0);
        $this->db->like('PENSION_STATUS', $pension_status);
        $this->db->order_by("PENSION_ID", "ASC");
        $query = $this->db->get();
        return $query->result();
    }
    

    /**********function for search user*******/

    public function search_user($user_name,$org_name)
    {
        if($user_name && $org_name)
        {
          
            $this->db->select('*');
            $this->db->from('users');
            $this->db->where(array('DELETES' => 0,'ORGANIZATION_ID' => $org_name));
            $this->db->like('FULLNAME', $user_name);
            $this->db->order_by("USERS_ID", "ASC");
            $query = $this->db->get();
            return $query->result();
          
        }// ends if

        else
        {
           if($user_name && empty($org_name))
           {
                $this->db->select('*');
                $this->db->from('users');
                $this->db->where(array('DELETES' => 0));
                $this->db->like('FULLNAME',$user_name);
                $this->db->order_by("USERS_ID", "ASC");
                $query = $this->db->get();
                return $query->result();
           } else if($org_name && empty($user_name))
             {
                $this->db->select('*');
                $this->db->from('users');
                $this->db->where(array('DELETES' => 0));
                $this->db->where(array('ORGANIZATION_ID' => $org_name));
                $this->db->order_by("USERS_ID", "ASC");
                $query = $this->db->get();
                return $query->result();
            
             } else {
                 
                $this->db->select('*');
                $this->db->from('users');
                $this->db->where(array('DELETES' => 0));
                $this->db->order_by("USERS_ID", "ASC");
                $query = $this->db->get();
                return $query->result();
                 
             }
        }//ends else
    }// function ends



 /**********function for search Contact*******/

     public function search_contact($user_name,$designation,$organization,$division)
    {
        
        if($user_name && $designation && $organization && $division)
        {
           
            $this->db->select('*');
            $this->db->from('employees');
            $this->db->where(array('STATUS' => 1,'ORGANIZATION_ID'=>$organization,'DIVISION_ID'=>$division));
            $this->db->like('FULLENAME', $user_name);
            $this->db->like('DESIGNATION' , $designation);
            $this->db->order_by("EMPLOYEE_ID", "ASC");
            $query = $this->db->get();
            return $query->result();
          
        } else
         {
           if($user_name && empty($designation) && empty($organization) && empty($division))
           { 
                $this->db->select('*');
                $this->db->from('employees');
                $this->db->where(array('STATUS' => 1));
                $this->db->like('FULLENAME',$user_name);
                $this->db->order_by("EMPLOYEE_ID", "ASC");
                $query = $this->db->get();
                return $query->result();

           }else if($user_name && $designation && empty($organization) && empty($division))
             {  
                $this->db->select('*');
                $this->db->from('employees');
                $this->db->where(array('STATUS' => 1));
                $this->db->like('FULLENAME', $user_name);
                $this->db->like('DESIGNATION' , $designation);
                $this->db->order_by("EMPLOYEE_ID", "ASC");
                $query = $this->db->get();
                return $query->result();
            
             }else if(empty($user_name) && $designation && empty($organization) && empty($division))
             {  
                $this->db->select('*');
                $this->db->from('employees');
                $this->db->where(array('STATUS' => 1,));
                $this->db->like('DESIGNATION' , $designation);
                $this->db->order_by("EMPLOYEE_ID", "ASC");
                $query = $this->db->get();
                return $query->result();
            
             } else if(empty($user_name) && empty($designation) && $organization && $division)
             {  
                $this->db->select('*');
                $this->db->from('employees');
                $this->db->where(array('STATUS' => 1,'ORGANIZATION_ID'=>$organization,'DIVISION_ID'=>$division));
                $this->db->order_by("EMPLOYEE_ID", "ASC");
                $query = $this->db->get();
                return $query->result();
            
             }
             else if(empty($user_name) && empty($designation) && empty($organization) && $division)
             {  
                $this->db->select('*');
                $this->db->from('employees');
                $this->db->where(array('STATUS' => 1,'DIVISION_ID'=>$division));
                $this->db->order_by("EMPLOYEE_ID", "ASC");
                $query = $this->db->get();
                return $query->result();
            
             }
             else if(empty($user_name) && empty($designation) && $organization && empty($division))
             {  
                $this->db->select('*');
                $this->db->from('employees');
                $this->db->where(array('STATUS' => 1,'ORGANIZATION_ID'=>$organization));
                $this->db->order_by("EMPLOYEE_ID", "ASC");
                $query = $this->db->get();
                return $query->result();
            
             }  else {
                
                $this->db->select('*');
                $this->db->from('employees');
                $this->db->where(array('STATUS' => 1));
                $this->db->order_by("EMPLOYEE_ID", "ASC");
                $query = $this->db->get();
                return $query->result();
                 
             }
        }//ends else
    }// function ends



 /**********function for search Mail*******/

    public function search_mail($from_mail,$to_mail)
    {
        if($from_mail && $to_mail)
        {
          
            $this->db->select('*');
            $this->db->from('email');
            $this->db->where(array('deletes' => 0,'from_email'=>$this->session->userdata('applicant_email')));
            $this->db->like('from_email', $from_mail);
            $this->db->like('to_email', $to_mail);
            $this->db->order_by("id", "ASC");
            $query = $this->db->get();
            return $query->result();
          
        }// ends if

        else
        {
           if($from_mail && empty($to_mail))
           {
                $this->db->select('*');
                $this->db->from('email');
                $this->db->where(array('deletes' => 0,'from_email'=>$this->session->userdata('applicant_email')));
                $this->db->like('from_email',$from_mail);
                $this->db->order_by("id", "ASC");
                $query = $this->db->get();
                return $query->result();
           } else if($to_mail && empty($from_mail))
             {
                $this->db->select('*');
                $this->db->from('email');
                $this->db->where(array('deletes' => 0,'from_email'=>$this->session->userdata('applicant_email')));
                $this->db->where(array('to_email' => $to_mail));
                $this->db->order_by("id", "ASC");
                $query = $this->db->get();
                return $query->result();
            
             } else {
                 
                $this->db->select('*');
                $this->db->from('email');
                $this->db->where(array('deletes' => 0,'from_email'=>$this->session->userdata('applicant_email')));
                $this->db->order_by("id", "ASC");
                $query = $this->db->get();
                return $query->result();
                 
             }
        }//ends else
    }// function ends


/**
     * Delete data from passed table name with given where condition
     *
     * @param string $table
     * @param array  $where
     *
     * @return array
     */
    public function delete_record_by_id($table, $where)
    {
        $query = $this->db->delete($table,$where);
    //echo $this->db->last_query();die();
        //return $query;
        return $this->db->affected_rows();
    }
    
/**********function for search Inbox message*******/

    public function search_inbox($from_mail)
    {
        if($from_mail)
        {
          
            $this->db->select('*');
            $this->db->from('internal_message');
            $this->db->where(array('delete_status' => 0,'from_email'=>$from_mail,'to_email'=>$this->session->userdata('applicant_email')));
            $this->db->order_by("id", "ASC");
            $query = $this->db->get();
            return $query->result();
          
        }// ends if

        else
        {
            $this->db->select('*');
            $this->db->from('internal_message');
            $this->db->where(array('delete_status' => 0,'to_email'=>$this->session->userdata('applicant_email')));
            $this->db->order_by("id", "ASC");
            $query = $this->db->get();
            return $query->result();
       
        }//ends else
    }// function ends


/**********function for search Outbox message*******/

    public function search_outbox($to_mail)
    {
        if($to_mail)
        {
          
            $this->db->select('*');
            $this->db->from('internal_message');
            $this->db->where(array('delete_status' => 0,'to_email'=>$to_mail, 'from_email'=>$this->session->userdata('applicant_email')));
            $this->db->order_by("id", "ASC");
            $query = $this->db->get();
            return $query->result();
          
        }// ends if

        else
        {
            $this->db->select('*');
            $this->db->from('internal_message');
            $this->db->where(array('delete_status' => 0,'from_email'=>$this->session->userdata('applicant_email')));
            $this->db->order_by("id", "ASC");
            $query = $this->db->get();
            return $query->result();
       
        }//ends else
    }// function ends

   /**********function for search Mail*******/

    public function search_sms($mobile_no)
    {
        if($mobile_no)
        {
          
            $this->db->select('*');
            $this->db->from('sms');
            $this->db->where(array('deletes' => 0,'mobile_no'=>$mobile_no));
            $this->db->order_by("id", "ASC");
            $query = $this->db->get();
            return $query->result();
          
        }// ends if

        else
        {
                 
                $this->db->select('*');
                $this->db->from('sms');
                $this->db->where(array('deletes' => 0));
                $this->db->order_by("id", "ASC");
                $query = $this->db->get();
                return $query->result();
        }        
        
    }// function ends

   
   public function getall_divisions(){
       
        $this->db->select('*');
        $this->db->from('division');
        $this->db->join('organization', 'division.ORGANIZATION_ID = organization.ORGANIZATION_ID');
        $this->db->where(array('division.status' => 1));
         
        $query = $this->db->get();
        
        return $query->result();
   }
   
   
   public function getall_organizations(){
       
        $this->db->select('*');
        $this->db->from('organization');
        $this->db->where(array('organization.delete_status' => 0));
        $query = $this->db->get();
        return $query->result();
   }
   
   
     public function get_all_contactlist(){
         
        $this->db->select('*');
        $this->db->from('employees');
        $this->db->where(array('STATUS' => 1));
        $query = $this->db->get();
        return $query->result();
   }
   
   public function get_pension_record($pension_id)
    {
        $query = $this->db->query("SELECT penrecord.*,pencont.*,penstatus.*,penremark.*  FROM pensrecoinfo as penrecord 
             INNER JOIN penscontinfo as pencont ON pencont.PENSION_ID = penrecord.PENSION_ID 
             INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID 
             INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID 
             WHERE penrecord.PENSION_ID = '".$pension_id."' AND penrecord.DELETES = 0 AND penrecord.STATUS = 1 AND pencont.STATUS = 1 AND penstatus.STATUS = 1 AND penremark.STATUS = 1");

        return $query->result();
    }
    
    
     public function get_expiry_employee($filter_date,$user_id)
    {
        $user_role = $this->session->userdata('user_role');

        if($user_role==1)
        {
            $query = $this->db->query("SELECT * FROM `pensrecoinfo` Where  '".$filter_date."' >= `DATE_RETIREMENT` ");
        }

        else
        {
            $query = $this->db->query("SELECT * FROM `pensrecoinfo` Where  '".$filter_date."' >= `DATE_RETIREMENT` AND `MODIFIEDBY_ID` =  '".$user_id."' ");
        }
        
        //

        return $query->result();
    }

    //function for report

     public function get_pension_report()
    {
        $query = $this->db->query("SELECT penrecord.*,pencont.*,penstatus.*,penremark.*  FROM pensrecoinfo as penrecord 
             INNER JOIN penscontinfo as pencont ON pencont.PENSION_ID = penrecord.PENSION_ID
             INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID
             INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID
             WHERE penrecord.DELETES = 0");
        return $query->result();
    }
    
     public function get_pension_record_search1($name,$status,$type)
    {
       $this->db->select('*');
       $this->db->like('EMPLY_NAME', $name);
       $this->db->where('PENSION_TYPE', $type);
       $this->db->where('PENSION_STATUS', $status);
       $this->db->where('DELETES', 0);
       $this->db->from('pensrecoinfo');
       $this->db->order_by("PENSION_ID", "DESC");
       $query = $this->db->get();
       return $query->result();  
        
         
    }

    //function 2 for pension searching

     public function get_pension_record_search2($ppo_no,$type)
    {
       $this->db->select('*');
       $this->db->where('PPO_NO', $ppo_no);
       $this->db->where('PENSION_TYPE', $type);
       //$this->db->where('PENSION_STATUS', $status);
      // $this->db->where('DIVIS_DEAL_NAME', $division); 
       $this->db->where('DELETES', 0);
       $this->db->from('pensrecoinfo');
       $this->db->order_by("PENSION_ID", "ASC");
       $query = $this->db->get();
    
       return $query->result();  
        
         
    }

    // function to check status all and with 
    public function get_pension_record_search5($ppo_no,$type,$status)
    {
       $this->db->select('*');
       $this->db->where('PPO_NO', $ppo_no);
       $this->db->where('PENSION_TYPE', $type);
      // $this->db->where('PENSION_STATUS', $status);
      // $this->db->where('DIVIS_DEAL_NAME', $division); 
       $this->db->where('DELETES', 0);
       $this->db->from('pensrecoinfo');
       $this->db->order_by("PENSION_ID", "ASC");
       $query = $this->db->get();
    
       return $query->result();  
        
         
    }

  //function 3 for pension searching

    public function get_pension_record_search3($name,$status)
    {
         if($name && $status)
         {
             $this->db->select('*');
             $this->db->like('EMPLY_NAME', $name);
             $this->db->where('PENSION_STATUS', $status);
             $this->db->where('DELETES', 0);
             $this->db->from('pensrecoinfo');
             $this->db->order_by("PENSION_ID", "DESC");
             $query = $this->db->get();
             return $query->result(); 
         }

         else if($name && empty($status))
         {
            $this->db->select('*');
            $this->db->like('EMPLY_NAME', $name);
            $this->db->where('DELETES', 0);
            $this->db->from('pensrecoinfo');
            $this->db->order_by("PENSION_ID", "DESC");
            $query = $this->db->get();
            return $query->result(); 
         }

         else if(empty($name) && $status)
         {
             $this->db->select('*');
             $this->db->where('PENSION_STATUS', $status);
             $this->db->where('DELETES', 0);
             $this->db->from('pensrecoinfo');
             $this->db->order_by("PENSION_ID", "DESC");
             $query = $this->db->get();
             return $query->result(); 
         }

         else
         {
            $this->db->select('*');
             $this->db->like('EMPLY_NAME', $name);
             $this->db->where('PENSION_STATUS', $status);
             $this->db->where('DELETES', 0);
             $this->db->from('pensrecoinfo');
             $this->db->order_by("PENSION_ID", "DESC");
             $query = $this->db->get();
             return $query->result();
         }   
         
    }


    //function  4 for seacrcvvvvvvvvvvvvvvvvvvvvh by name

    public function get_pension_record_searchname1($name,$division,$status)
    {
           if($name && $division && $status)
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'POPSEF');
               $this->db->where('DIVIS_DEAL_NAME', $division); 
               $this->db->where('PENSION_STATUS', $status); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();
           }

           else if($name && empty($division) && empty($status))
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'POPSEF');
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();  
           }

           else if($name && $division && empty($status))
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'POPSEF');
               $this->db->where('DIVIS_DEAL_NAME', $division); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();  
           }

            else if($name && empty($division) && $status)
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'POPSEF');
               $this->db->where('PENSION_STATUS', $status); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result(); 
           }

           else
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'POPSEF');
               $this->db->where('DIVIS_DEAL_NAME', $division); 
               $this->db->where('PENSION_STATUS', $status); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();
           }
    
        
         
    }

     public function get_pension_record_searchname2($name,$division,$status)
    {
         if($name && $division && $status)
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'POPSOF');
               $this->db->where('DIVIS_DEAL_NAME', $division); 
               $this->db->where('PENSION_STATUS', $status); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();
           }

           else if($name && empty($division) && empty($status))
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'POPSOF');
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();  
           }

           else if($name && $division && empty($status))
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'POPSOF');
               $this->db->where('DIVIS_DEAL_NAME', $division); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();  
           }

            else if($name && empty($division) && $status)
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'POPSOF');
               $this->db->where('PENSION_STATUS', $status); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result(); 
           }

           else
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'POPSOF');
               $this->db->where('DIVIS_DEAL_NAME', $division); 
               $this->db->where('PENSION_STATUS', $status); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();
           }         
         
    }


     public function get_pension_record_searchname3($name,$division,$status)
    {
        if($name && $division && $status)
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'PNPSEF');
               $this->db->where('DIVIS_DEAL_NAME', $division); 
               $this->db->where('PENSION_STATUS', $status); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();
           }

           else if($name && empty($division) && empty($status))
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'PNPSEF');
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();  
           }

           else if($name && $division && empty($status))
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'PNPSEF');
               $this->db->where('DIVIS_DEAL_NAME', $division); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();  
           }

            else if($name && empty($division) && $status)
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'PNPSEF');
               $this->db->where('PENSION_STATUS', $status); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result(); 
           }

           else
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'PNPSEF');
               $this->db->where('DIVIS_DEAL_NAME', $division); 
               $this->db->where('PENSION_STATUS', $status); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();
           }           
         
    }

     public function get_pension_record_searchname4($name,$division,$status)
    {
          if($name && $division && $status)
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'PNPSOF');
               $this->db->where('DIVIS_DEAL_NAME', $division); 
               $this->db->where('PENSION_STATUS', $status); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();
           }

           else if($name && empty($division) && empty($status))
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'PNPSOF');
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();  
           }

           else if($name && $division && empty($status))
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'PNPSOF');
               $this->db->where('DIVIS_DEAL_NAME', $division); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();  
           }

            else if($name && empty($division) && $status)
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'PNPSOF');
               $this->db->where('PENSION_STATUS', $status); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result(); 
           }

           else
           {
               $this->db->select('*');
               $this->db->like('EMPLY_NAME', $name);
               $this->db->where('PENSION_TYPE', 'PNPSOF');
               $this->db->where('DIVIS_DEAL_NAME', $division); 
               $this->db->where('PENSION_STATUS', $status); 
               $this->db->where('DELETES', 0);
               $this->db->from('pensrecoinfo');
               $this->db->order_by("PENSION_ID", "DESC");
               $query = $this->db->get();
               return $query->result();
           } 
           
    }

    /***************function to get pension history data*********/

    public function pensionhistory_data($current_month,$type,$organisation)
    {
        $query = $this->db->query("SELECT * FROM pensrecoinfo WHERE MONTH(`LASTMODIDATE`) = '".$current_month."' AND `PENSION_TYPE` = '".$type."' AND `PENSION_STATUS` = 'Pending' AND `DELETES` = '0' ");

        return $query->result();
    }

    public function pensionhistory_data2($current_month,$type,$organisation)
    {
        $query = $this->db->query("SELECT * FROM pensrecoinfo WHERE MONTH(`LASTMODIDATE`) = '".$current_month."' AND `PENSION_TYPE` = '".$type."' AND `ORGANISATION` = '".$organisation."' AND `PENSION_STATUS` = 'Pending' AND `DELETES` = '0' ");

        return $query->result();
    }

   public function pensionhistory_data3($month,$type,$pension,$year)
    {
       
       /* $query = $this->db->query("SELECT penstatus.*,pencontact.*,penrecord.*,penremark.* FROM pensrecostatus as penstatus 
         INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
         INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
         INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
         WHERE YEAR(penstatus.LASTMODIFIED) = '".$year."' AND MONTH(penstatus.LASTMODIFIED) = '".$month."' AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = '".$type."' AND penstatus.STATUS = 1 AND penremark.STATUS = 1 AND pencontact.STATUS = 1 AND penstatus.PENSION_ID = '".$pension."' ");*/

        /* $query = $this->db->query("SELECT penstatus.*,pencontact.*,penrecord.*,penremark.* FROM pensrecostatus as penstatus 
         INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
         INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
         INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
         WHERE YEAR(penstatus.LASTMODIFIED) = '".$year."' AND MONTH(penstatus.LASTMODIFIED) = '".$month."' AND penrecord.DELETES = 0 AND penrecord.PENSION_TYPE = '".$type."' AND penstatus.PENSION_ID = '".$pension."' GROUP BY penstatus.RECORDSTATUS_ID ORDER BY penstatus.RECORDSTATUS_ID DESC ");*/

        /* $query = $this->db->query("SELECT penstatus.*,pencontact.*,penrecord.*,penremark.* FROM pensrecostatus as penstatus 
         INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
         INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
         INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
         WHERE YEAR(penstatus.LASTMODIFIED) = '".$year."' AND MONTH(penstatus.LASTMODIFIED) = '".$month."' AND penrecord.DELETES = 0 AND penrecord.PENSION_TYPE = '".$type."' AND penstatus.PENSION_ID = '".$pension."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.STATUS = 1 GROUP BY penstatus.RECORDSTATUS_ID ORDER BY penstatus.RECORDSTATUS_ID DESC ");*/

           $query = $this->db->query("SELECT penstatus.*,pencontact.*,penrecord.*,penremark.* FROM pensrecostatus as penstatus 
         INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
         INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
         INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
         WHERE YEAR(penstatus.LASTMODIFIED) = '".$year."' AND MONTH(penstatus.LASTMODIFIED) = '".$month."' AND penrecord.DELETES = 0 AND penrecord.PENSION_TYPE = '".$type."' AND penstatus.PENSION_ID = '".$pension."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.STATUS = 1 ORDER BY penstatus.RECORDSTATUS_ID DESC ");

       // echo $this->db->last_query();exit; 
        return $query->result();
    }

    /**********hsitory data based on orgn***********/

      public function pensionhistory_data6($month,$type,$pension,$year,$organisation_id)
    {
  
        //echo "djdjdjd"; exit;
       /*  $query = $this->db->query("SELECT penstatus.*,pencontact.*,penrecord.*,penremark.* FROM pensrecostatus as penstatus 
         INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
         INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
         INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
         WHERE YEAR(penstatus.LASTMODIFIED) = '".$year."' AND MONTH(penstatus.LASTMODIFIED) = '".$month."' AND penrecord.DELETES = 0 AND penrecord.PENSION_TYPE = '".$type."' AND penrecord.ORGANISATION = '".$organisation_id."' AND penstatus.PENSION_ID = '".$pension."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.STATUS = 1 GROUP BY penstatus.RECORDSTATUS_ID ORDER BY penstatus.RECORDSTATUS_ID DESC ");*/

          $query = $this->db->query("SELECT penstatus.*,pencontact.*,penrecord.*,penremark.* FROM pensrecostatus as penstatus 
         INNER JOIN pensrecoinfo as penrecord ON penrecord.PENSION_ID = penstatus.PENSION_ID
         INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penstatus.PENSION_ID
         INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penstatus.PENSION_ID
         WHERE YEAR(penstatus.LASTMODIFIED) = '".$year."' AND MONTH(penstatus.LASTMODIFIED) = '".$month."' AND penrecord.DELETES = 0 AND penrecord.PENSION_TYPE = '".$type."' AND penrecord.ORGANISATION = '".$organisation_id."' AND penstatus.PENSION_ID = '".$pension."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1 AND penstatus.STATUS = 1 ORDER BY penstatus.RECORDSTATUS_ID DESC ");

       // echo $this->db->last_query();exit; 
        return $query->result();
    }//ends function

     /******for all not updated pension recors********/

    public function get_allnotupdated_record()
    {
        $query = $this->db->query("Select * from pensrecoinfo t where t.LASTMODIDATE <= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), INTERVAL 1 DAY) and t.LASTMODIDATE <= DATE_SUB(NOW(), INTERVAL 1 MONTH) and t.DELETES = 0 and t.PENSION_STATUS = 'Pending' ");

        return $query->result();

    }//ends function


    /**************not updated ppo users************/

    public function get_allnotupdated_ppouserrecord($pension_id)
    {
        $query = $this->db->query("Select t.* from pensrecoremark t where t.LASTMODIFIED <= DATE_ADD(LAST_DAY(DATE_SUB(NOW(), INTERVAL 2 MONTH)), INTERVAL 1 DAY) and t.LASTMODIFIED <= DATE_SUB(NOW(), INTERVAL 1 MONTH) and t.STATUS = 1 and t.PENSION_ID = '".$pension_id."' ");
        //echo $this->db->last_query(); exit;
        return $query->result();

    }//ends function

    ///check condtion for 9

    public function check9($organisation_name,$type)
    {
        $this->db->select('pencontact.*,penrecord.*,penstatus.*,penremark.*');
        $this->db->from('pensrecostatus penstatus');
        $this->db->join('pensrecoinfo penrecord','penrecord.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('penscontinfo pencontact','pencontact.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('pensrecoremark penremark','penremark.PENSION_ID = penstatus.PENSION_ID');
        $this->db->where('penstatus.STATUS',1);
        $this->db->where('penrecord.PENSION_TYPE',$type);
        $this->db->where('penrecord.DELETES',0);
        $this->db->where('penrecord.ORGANISATION',$organisation_name);
        $this->db->where('pencontact.STATUS',1);
        $this->db->where('penremark.STATUS',1);
        $query = $this->db->get();
        return $query->result();

    }// ends function

    //check condtion for 8

    public function check8($organisation_name,$type)
    {
        $this->db->select('pencontact.*,penrecord.*,penstatus.*,penremark.*');
        $this->db->from('pensrecostatus penstatus');
        $this->db->join('pensrecoinfo penrecord','penrecord.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('penscontinfo pencontact','pencontact.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('pensrecoremark penremark','penremark.PENSION_ID = penstatus.PENSION_ID');
        $this->db->where('penstatus.STATUS',1);
        $this->db->where('penrecord.PENSION_STATUS','Settled');
        $this->db->where('penrecord.PENSION_PAPER_SUBMIT_STATUS','Yes');
        $this->db->where('penrecord.PENSION_TYPE',$type);
        $this->db->where('penrecord.DELETES',0);
        $this->db->where('penrecord.ORGANISATION',$organisation_name);
        $this->db->where('pencontact.STATUS',1);
        $this->db->where('penremark.STATUS',1);
        $query = $this->db->get();
        return $query->result();

    }// ends function


    //check for 7

    public function check7($organisation_name,$type)
    {
        $this->db->select('pencontact.*,penrecord.*,penstatus.*,penremark.*');
        $this->db->from('pensrecostatus penstatus');
        $this->db->join('pensrecoinfo penrecord','penrecord.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('penscontinfo pencontact','pencontact.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('pensrecoremark penremark','penremark.PENSION_ID = penstatus.PENSION_ID');
        $this->db->where('penstatus.STATUS',1);
        $this->db->where('penrecord.PENSION_STATUS','Pending');
        $this->db->where('penrecord.PENSION_PAPER_SUBMIT_STATUS','Yes');
        $this->db->where('penrecord.PENSION_TYPE',$type);
        $this->db->where('penrecord.DELETES',0);
        $this->db->where('penrecord.ORGANISATION',$organisation_name);
        $this->db->where('pencontact.STATUS',1);
        $this->db->where('penremark.STATUS',1);
        $query = $this->db->get();
        return $query->result();

    }// ends function

    //check for condition 6

    public function check6($organisation_name,$type)
    {
        $this->db->select('pencontact.*,penrecord.*,penstatus.*,penremark.*');
        $this->db->from('pensrecostatus penstatus');
        $this->db->join('pensrecoinfo penrecord','penrecord.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('penscontinfo pencontact','pencontact.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('pensrecoremark penremark','penremark.PENSION_ID = penstatus.PENSION_ID');
        $this->db->where('penstatus.STATUS',1);
        $this->db->where('penrecord.PENSION_STATUS','Pending');
        $this->db->where('penrecord.PENSION_PAPER_SUBMIT_STATUS','No');
        $this->db->where('penrecord.PENSION_TYPE',$type);
        $this->db->where('penrecord.DELETES',0);
        $this->db->where('penrecord.ORGANISATION',$organisation_name);
        $this->db->where('pencontact.STATUS',1);
        $this->db->where('penremark.STATUS',1);
        $query = $this->db->get();
        return $query->result();

    }// ends function

    //check condition for 5

    public function check5($organisation_name,$type)
    {
        $this->db->select('pencontact.*,penrecord.*,penstatus.*,penremark.*');
        $this->db->from('pensrecostatus penstatus');
        $this->db->join('pensrecoinfo penrecord','penrecord.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('penscontinfo pencontact','pencontact.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('pensrecoremark penremark','penremark.PENSION_ID = penstatus.PENSION_ID');
        $this->db->where('penstatus.STATUS',1);
        $this->db->where('penrecord.PENSION_STATUS','Pending');
        $this->db->where('penrecord.PENSION_PAPER_SUBMIT_STATUS','No');
        $this->db->where('penrecord.PENSION_TYPE',$type);
        $this->db->where('penrecord.DELETES',0);
        $this->db->where('penrecord.ORGANISATION',$organisation_name);
        $this->db->where('pencontact.STATUS',1);
        $this->db->where('penremark.STATUS',1);
        $query = $this->db->get();
        return $query->result();

    }// ends function

    //check condition for 4

    public function check4($organisation_name,$type,$from_date,$to_date)
    {
        $this->db->select('pencontact.*,penrecord.*,penstatus.*,penremark.*');
        $this->db->from('pensrecoinfo penrecord');
        $this->db->join('pensrecostatus penstatus','penstatus.PENSION_ID = penrecord.PENSION_ID');
        $this->db->join('penscontinfo pencontact','pencontact.PENSION_ID = penrecord.PENSION_ID');
        $this->db->join('pensrecoremark penremark','penremark.PENSION_ID = penrecord.PENSION_ID');
        $this->db->where('penrecord.DATE_RETIREMENT >=', $from_date);
        $this->db->where('penrecord.DATE_RETIREMENT <=', $to_date);
        $this->db->where('penrecord.DELETES',0);
        $this->db->where('penrecord.PENSION_STATUS','Pending');
        $this->db->where('penrecord.PENSION_TYPE',$type);
        $this->db->where('penstatus.STATUS',1);
        $this->db->where('penrecord.ORGANISATION',$organisation_name);
        $this->db->where('pencontact.STATUS',1);
        $this->db->where('penremark.STATUS',1);
        $query = $this->db->get();
        return $query->result();

    }// ends function

    //check condtion for 3 part 1

    public function check31($organisation_name,$type,$division)
    {
        $this->db->select('pencontact.*,penrecord.*,penstatus.*,penremark.*');
        $this->db->from('pensrecoinfo penrecord');
        $this->db->join('pensrecostatus penstatus','penstatus.PENSION_ID = penrecord.PENSION_ID');
        $this->db->join('penscontinfo pencontact','pencontact.PENSION_ID = penrecord.PENSION_ID');
        $this->db->join('pensrecoremark penremark','penremark.PENSION_ID = penrecord.PENSION_ID');
        $this->db->where('penrecord.DIVIS_DEAL_NAME',$division);
        $this->db->where('penrecord.DELETES',0);
        $this->db->where('penrecord.PENSION_STATUS','Pending');
        $this->db->where('penrecord.PENSION_TYPE',$type);
        $this->db->where('penstatus.STATUS',1);
        $this->db->where('penrecord.ORGANISATION',$organisation_name);
        $this->db->where('pencontact.STATUS',1);
        $this->db->where('penremark.STATUS',1);
    
        $query = $this->db->get();
        return $query->result();

    }// ends function

    //check condtion for 3 part 2

    public function check32($organisation_name,$type,$division)
    {
        $this->db->select('pencontact.*,penrecord.*,penstatus.*,penremark.*');
        $this->db->from('pensrecostatus penstatus');
        $this->db->join('pensrecoinfo penrecord','penrecord.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('penscontinfo pencontact','pencontact.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('pensrecoremark penremark','penremark.PENSION_ID = penstatus.PENSION_ID');
        $this->db->where('penrecord.DIVIS_DEAL_NAME',$division);
        $this->db->where('penstatus.STATUS',1);
        $this->db->where('penrecord.PENSION_STATUS','Pending');
        $this->db->where('penrecord.PENSION_TYPE',$type);
        $this->db->where('penrecord.ORGANISATION',$organisation_name);
        $this->db->where('penrecord.DELETES',0);
        $this->db->where('pencontact.STATUS',1);
        $this->db->where('penremark.STATUS',1);
        $query = $this->db->get();
        return $query->result();

    }// ends function

    //check condtion for 1

    public function check1($organisation_name,$type)
    {
        $this->db->select('pencontact.*,penrecord.*,penstatus.*,penremark.*');
        $this->db->from('pensrecostatus penstatus');
        $this->db->join('pensrecoinfo penrecord','penrecord.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('penscontinfo pencontact','pencontact.PENSION_ID = penstatus.PENSION_ID');
        $this->db->join('pensrecoremark penremark','penremark.PENSION_ID = penstatus.PENSION_ID');
        $this->db->where('penstatus.STATUS',1);
        $this->db->where('penrecord.PENSION_STATUS','Pending');
        $this->db->where('penrecord.PENSION_TYPE',$type);
        $this->db->where('penrecord.ORGANISATION',$organisation_name);
        $this->db->where('penrecord.DELETES',0);
        $this->db->where('pencontact.STATUS',1);
        $this->db->where('penremark.STATUS',1);
        $this->db->where('penstatus.PENDING_PPO',1);
        $query = $this->db->get();
        return $query->result();

    }// ends function


    public function check2($organisation_name,$type,$month)
    {
        $query = $this->db->query("SELECT pencontact.*,penrecord.*, penstatus.*,penremark.* FROM pensrecoinfo as penrecord INNER JOIN pensrecostatus as penstatus ON penstatus.PENSION_ID = penrecord.PENSION_ID INNER JOIN penscontinfo as pencontact ON pencontact.PENSION_ID = penrecord.PENSION_ID INNER JOIN pensrecoremark as penremark ON penremark.PENSION_ID = penrecord.PENSION_ID WHERE YEAR(penrecord.LASTMODIDATE) = YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND MONTH(penrecord.LASTMODIDATE) = MONTH(CURRENT_DATE - INTERVAL '".$month."' MONTH) AND penrecord.DELETES = 0 AND penrecord.PENSION_STATUS = 'Pending' AND penrecord.PENSION_TYPE = '".$type."' AND penstatus.STATUS = 1 AND penrecord.ORGANISATION = '".$organisation_name."' AND pencontact.STATUS = 1 AND penremark.STATUS = 1");

        return $query->result();


    /*    $this->db->select('pencontact.*,penrecord.*,penstatus.*,penremark.*');
        $this->db->from('pensrecoinfo penrecord');
        $this->db->join('pensrecostatus penstatus','penstatus.PENSION_ID = penrecord.PENSION_ID');
        $this->db->join('penscontinfo pencontact','pencontact.PENSION_ID = penrecord.PENSION_ID');
        $this->db->join('pensrecoremark penremark','penremark.PENSION_ID = penrecord.PENSION_ID');
        $this->db->where('YEAR(penrecord.LASTMODIDATE)',YEAR(CURRENT_DATE - INTERVAL '".$month."' MONTH));
        $this->db->where('penrecord.DELETES',0);
        $this->db->where('penrecord.PENSION_STATUS','Pending');
        $this->db->where('penrecord.PENSION_TYPE',$type);
        $this->db->where('penstatus.STATUS',1);
        $this->db->where('penrecord.ORGANISATION',$organisation_name);
        $this->db->where('pencontact.STATUS',1);
        $this->db->where('penremark.STATUS',1);
    
        $query = $this->db->get();
        return $query->result();*/

    }// ends function

    //

    public function get_record_pensionrecordstatusdashboard()
    {
        
        $query = $this->db->query("SELECT * FROM `pensrecostatus`
                 INNER JOIN pensrecoinfo ON pensrecostatus.PENSION_ID=pensrecoinfo.PENSION_ID WHERE pensrecoinfo.DELETES='0' AND pensrecostatus.PENDING_PPO = '1' AND pensrecostatus.STATUS = '1' ");

        return $query->result();

    }// ends function


    public function get_record_pensionrecordstatusdashboard2($id)
    {
        
        $query = $this->db->query("SELECT * FROM `pensrecostatus`
                 INNER JOIN pensrecoinfo ON pensrecostatus.PENSION_ID=pensrecoinfo.PENSION_ID WHERE pensrecoinfo.DELETES='0' AND pensrecostatus.MODIFIEDBY_ID = '".$id."' AND pensrecostatus.PENDING_PPO = '1' AND pensrecostatus.STATUS = '1' " );

        return $query->result();

    }// ends function

    public function lastupdatepensionrecored($organisation)
    {
        $query = $this->db->query("SELECT * FROM `pensrecoinfo` WHERE `ORGANISATION` = '".$organisation."' ORDER BY `PENSION_ID` DESC LIMIT 1" );
        return $query->result();

    }// ends function


   
}//class ends