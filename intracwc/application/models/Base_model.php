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
				
	  $query = $this->db->query("SELECT * FROM `users` WHERE `email` = '".$email."' AND `password` = '".$password."' AND `delete_status` = 1 OR `user_name` = '".$username."'  AND `password` = '".$password."' AND `delete_status` = 1");
	   
    
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

        $this->db->select('*');
		$this->db->from('organization');
		$this->db->where('ORGNAME',$orgaisation);
		$this->db->where("ORGANIZATION_ID",$id);

		$query=$this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
	
	public function user_existance($email, $username){
		
		        $this->db->select('*');
                $this->db->from('users');
                $this->db->where(array('status'=>1, 'delete_status' => 1));
                $this->db->where(array('email' => $email));
                $this->db->or_where(array('user_name' => $username));
                $query = $this->db->get();
                
                if ($query->num_rows() > 0) {
                    return 1;
                } else {
                    return 0;
                }
				
	    }
	    
	    
	    public function user_approvecheck($email, $username){
	        
	          if(!empty($email)){
	            $this->db->select('*');
                $this->db->from('users');
                $this->db->where(array('email' => $email,'status'=>1, 'delete_status' => 1,'approved_status'=>'0'));
                $query = $this->db->get();
                 //echo $this->db->last_query();die;
                if ($query->num_rows() > 0) {
                    return 1;
                } else {
                    return 0;
                }
	              
	          } else {
	              
	              
	              $this->db->select('*');
                  $this->db->from('users');
                  $this->db->where(array('user_name' => $username,'status'=>1, 'delete_status' => 1,'approved_status'=>'0'));
                  $query = $this->db->get();
                  //echo $this->db->last_query();die;
                if ($query->num_rows() > 0) {
                    return 1;
                } else {
                    return 0;
                }
	              
	              
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
        
        $this->db->order_by('created_date', 'DESC');
        $query = $this->db->get_where($table, $data);
        return $query->result();
    }


    public function get_all_office_by_condition($table, $data)
    {
        
        $this->db->order_by('office_name', 'ASC');
        $query = $this->db->get_where($table, $data);
        return $query->result();
    }


    public function get_all_logs($table, $data)
    {
        
        $this->db->order_by('CREATEDDATED', 'DESC');
        $query = $this->db->get_where($table, $data);
        return $query->result();
    }


    public function get_all_itemhistory($table, $data)
    {
        
        $this->db->order_by('cronjob_date', 'DESC');
        $query = $this->db->get_where($table, $data);
        return $query->result();
    }


    public function get_all_returnitems($table, $data)
    {
        
        $this->db->order_by('return_date', 'DESC');
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
        return $this->db->affected_rows();
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

    public function search_contact($user_name,$email_id)
    {
		
        if($user_name && $email_id)
        {
           
		    $this->db->select('*');
			$this->db->from('employees');
			$this->db->where(array('STATUS' => 1));
			$this->db->like('FULLENAME', $user_name);
			$this->db->like('EMAIL' , $email_id);
			$this->db->order_by("EMPLOYEE_ID", "ASC");
			$query = $this->db->get();
			return $query->result();
		  
        }// ends if

        else
        {
           if($user_name && empty($email_id))
           { 
                $this->db->select('*');
				$this->db->from('employees');
				$this->db->where(array('STATUS' => 1));
				$this->db->like('FULLENAME',$user_name);
				$this->db->order_by("EMPLOYEE_ID", "ASC");
				$query = $this->db->get();
				return $query->result();
           } else if($email_id && empty($user_name))
             {  
			    $this->db->select('*');
				$this->db->from('employees');
				$this->db->where(array('STATUS' => 1));
				$this->db->like('EMAIL' , $email_id);
				$this->db->order_by("EMPLOYEE_ID", "ASC");
				$query = $this->db->get();
				return $query->result();
			
             } else {
				
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
 
	
    

 //function for requisition data

    public function requsition_data($req_id)
    {
      
        $this->db->select('osr_requisition_item.*,osr_item_master.*');
        $this->db->from('osr_requisition_item');
        $this->db->join('osr_item_master','osr_requisition_item.item_id=osr_item_master.item_id');
        $this->db->where('osr_requisition_item.req_id',$req_id);

         $query = $this->db->get();
		
        return json_encode($query->result());
         
    }



     public function get_emp_for_users()
    {
		
		$query = $this->db->query('SELECT * FROM employee AS emp WHERE (emp.employee_id NOT IN (select employee_id from users)) AND status=1 AND delete_status=1');
        
        return $query->result();

    }


    public function get_all_admins(){

        $this->db->select('*');
        $this->db->from('save_users_role');
        $this->db->where(array('role_id'=>'15'));
        $this->db->or_where(array('role_id'=>'16'));
        $query = $this->db->get();
        $query->result();
        $str=$query->result();
		 
    }

	public function CheckForRegistration($employee_post,$user_role)
	{
        $this->db->select('employee.employee_id,employee.employee_email,employee.employee_mobile_no,employee.employee_name');
        $this->db->from('employee');
        $this->db->join('save_users_role','employee.employee_id=save_users_role.employee_id');
        $this->db->where('employee.post',$employee_post);
        $this->db->where('save_users_role.role_id',$user_role);
        $query = $this->db->get();
		//echo $this->db->last_query();die;
        return $query->result();
       
	}
	
}//class ends