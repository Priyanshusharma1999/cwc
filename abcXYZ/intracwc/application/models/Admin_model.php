<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin_model extends CI_Model
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
     function to check building name
     */
    public function check_existent_building($building_name, $id)
    { 
        // $query = $this->db->query("SELECT * FROM `building` WHERE `building_name` = '".$building_name."' AND `building_id`!='".$id."' AND `delete_status`= 1  ");

            $this->db->select('*');
	        $this->db->from('building');
	        $this->db->where(array('building_name'=>$building_name, 'building_id != ' => $id, 'delete_status' =>1));

	        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     function to check designation name
     */
    public function check_existent_designation($designation_name, $id)
    { 
        // $query = $this->db->query("SELECT * FROM `designation` WHERE `designation_name` = '".$designation_name."' AND `designation_id`!='".$id."' AND `delete_status`= 1  ");

         $this->db->select('*');
	     $this->db->from('designation');
	     $this->db->where(array('designation_name'=>$designation_name, 'designation_id != ' => $id, 'delete_status' =>1));
	        
	     $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }


     public function check_existent_office($office_name, $id)
    { 
        
         $this->db->select('*');
         $this->db->from('employee_office');
         $this->db->where(array('office_name'=>$office_name, 'office_id != ' => $id, 'delete_status' =>0));
            
         $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     function to check room name
     */
    public function check_existent_room($building_name, $room_name,$id)
    { 
        // $query = $this->db->query("SELECT * FROM `room_no` WHERE `building_id` = '".$building_name."' AND `room_id`!='".$id."' AND `room_name` = '".$room_name."' AND `delete_status`= 1  ");

         $this->db->select('*');
	     $this->db->from('room_no');
	     $this->db->where(array('building_id'=>$building_name, 'room_id != ' => $id, 'room_name'=>$room_name, 'delete_status' =>1));
	       
	      $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     function to check wing name
     */
    public function check_existent_wing($wing_name, $id)
    { 
        // $query = $this->db->query("SELECT * FROM `wing` WHERE `wing_name` = '".$wing_name."' AND `wing_id`!='".$id."' AND `delete_status`= 1  ");

        $this->db->select('*');
	     $this->db->from('wing');
	     $this->db->where(array('wing_name'=>$wing_name, 'wing_id != ' => $id, 'delete_status' =>1));

	      $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     function to check section name
     */
    public function check_existent_section($section_name,$wing_name,$id)
    { 
        // $query = $this->db->query("SELECT * FROM `section` WHERE `wing_id` = '".$wing_name."' AND `section_name` = '".$section_name."' AND `section_id`!='".$id."' AND `delete_status`= 1  ");

        $this->db->select('*');
	     $this->db->from('section');
	     $this->db->where(array('wing_id'=>$wing_name, 'section_name' => $section_name, 'section_id !='=>$id, 'delete_status' =>1));

	      $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }


    /**
     function to check employee employee code
     */
    public function check_existent_employee_empcode($employee_code,$id)
    { 
        // $query = $this->db->query("SELECT * FROM `employee` WHERE `employee_code` = '".$employee_code."' AND `employee_id`!='".$id."' AND `delete_status`= 1  ");

        $this->db->select('*');
	     $this->db->from('employee');
	     $this->db->where(array('employee_code'=>$employee_code, 'employee_id != ' => $id,'delete_status' =>1));

	      $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     function to check employee employee email
     */
    public function check_existent_employee_empemail($employee_email,$id)
    { 
        // $query = $this->db->query("SELECT * FROM `employee` WHERE `employee_email` = '".$employee_email."' AND `employee_id`!='".$id."' AND `delete_status`= 1  ");

        $this->db->select('*');
	     $this->db->from('employee');
	     $this->db->where(array('employee_email'=>$employee_email, 'employee_id != ' => $id, 'delete_status' =>1));

	      $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     function to check user employee loginid
     */
    public function check_existent_user_loginid($user_id,$id)
    { 
        // $query = $this->db->query("SELECT * FROM `users` WHERE `login_id` = '".$user_id."' AND `user_id`!='".$id."' AND `delete_status`= 1  ");

        $this->db->select('*');
	     $this->db->from('users');
	     $this->db->where(array('login_id'=>$user_id, 'user_id != ' => $id, 'delete_status' =>1));

	     $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     function to check user employee email
     */
    public function check_existent_user_email($email,$id)
    { 
        // $query = $this->db->query("SELECT * FROM `users` WHERE `email` = '".$email."' AND `user_id`!='".$id."' AND `delete_status`= 1  ");

        $this->db->select('*');
	     $this->db->from('users');
	     $this->db->where(array('email'=>$email, 'user_id != ' => $id, 'delete_status' =>1));

	     $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     function to check vendor employee email
     */
    public function check_existent_vendor_order($order,$id)
    { 
        // $query = $this->db->query("SELECT * FROM `vendor` WHERE `order_no` = '".$order."' AND `vendor_id`!='".$id."' AND `delete_status`= 1  ");

        $this->db->select('*');
	     $this->db->from('vendor');
	     $this->db->where(array('order_no'=>$order, 'vendor_id != ' => $id,'delete_status' =>1));

	      $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

     /**
     function to check vendor employee compnay and order
     */
    public function check_existent_vendor_companyorder($order_no,$company_name,$id)
    { 
        // $query = $this->db->query("SELECT * FROM `vendor` WHERE `order_no` = '".$order."' AND `company_name` = '".$company_name."' AND  `vendor_id`!='".$id."' AND `delete_status`= 1  ");

        $this->db->select('*');
	     $this->db->from('vendor');
	     $this->db->where(array('order_no'=>$order, 'company_name' => $company_name, 'vendor_id !='=>$id, 'delete_status' =>1));

	      $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

      /**
     function to check vendor employee compnay and employeeemail
     */
    public function check_existent_vendoremployee($vendor_id,$employee_email,$id)
    { 
        // $query = $this->db->query("SELECT * FROM `vendor_employee` WHERE `vendor_id` = '".$vendor_id."' AND `vendor_employee_email` = '".$employee_email."' AND  `vendor_employee_id`!='".$id."' AND `delete_status`= 1  ");
        

        $this->db->select('*');
	     $this->db->from('vendor_employee');
	     $this->db->where(array('vendor_id'=>$vendor_id, 'vendor_employee_email' => $employee_email, 'vendor_employee_id !='=>$id, 'delete_status' =>1));

	      $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

     /**
     function to check vendor employee email
     */
    public function check_existent_vendoremployee_email($employee_email,$id)
    { 
        // $query = $this->db->query("SELECT * FROM `vendor_employee` WHERE `vendor_employee_email` = '".$employee_email."' AND  `vendor_employee_id`!='".$id."' AND `delete_status`= 1  ");
        

         $this->db->select('*');
	     $this->db->from('vendor_employee');
	     $this->db->where(array('vendor_employee_email'=>$employee_email, 'vendor_employee_id != ' => $id,  'delete_status' =>1));

         $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

     /**
     function to check search building
     */
    public function search_building($building_name,$status)
    { 
        if($building_name && $status)
        {
            if($status=='2')
            {
                $status = 0;
            }

            // $query = $this->db->query("SELECT *
            // FROM `building`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."' AND `building_name`  LIKE '%".$building_name."%' ESCAPE '!' 
            // ORDER BY `building_id` DESC");


            $this->db->select('*');
	        $this->db->from('building');
	        $this->db->like('building_name',$building_name);
	        $this->db->escape_like_str($building_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status'=> 1,'status'=>$status)); 
	        $this->db->order_by("building_id", "DESC");
	        $query = $this->db->get();


            return $query->result();
        }

        else if($building_name && empty($status))
        {
            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `building`
            // WHERE  `delete_status` = '1' AND
            // `building_name`  LIKE '%".$building_name."%' ESCAPE '!' 
            // ORDER BY `building_id` DESC");

             $this->db->select('*');
	        $this->db->from('building');
	        $this->db->like('building_name',$building_name);
	        $this->db->escape_like_str($building_name)."%' ESCAPE '!'";
	        $this->db->where('delete_status', 1); 
	        $this->db->order_by("building_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else if(empty($building_name) && $status)
        {

            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `building`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'  
            // ORDER BY `building_id` DESC");

            $this->db->select('*');
	        $this->db->from('building');
	        $this->db->where(array('delete_status'=>1,'status'=>$status)); 
	        $this->db->order_by("building_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else
        {
            // $query = $this->db->query("SELECT *
            // FROM `building`
            // WHERE  `delete_status` = '1' AND `status` = '1'
            // ORDER BY `building_id` DESC");

            $this->db->select('*');
	        $this->db->from('building');
	        $this->db->where(array('delete_status'=>1,'status'=>1)); 
	        $this->db->order_by("building_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }
    }//ends function


     /**
     function to check search designation
     */
    public function search_designation($designation_name,$status)
    { 
        if($designation_name && $status)
        {
            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `designation`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'
            // AND  `designation_name`  LIKE '%".$designation_name."%' ESCAPE '!' 
            // ORDER BY `designation_id` DESC");

             $this->db->select('*');
	        $this->db->from('designation');
	        $this->db->like('designation_name',$designation_name);
	        $this->db->escape_like_str($designation_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status' =>1,'status'=>$status)); 
	        $this->db->order_by("designation_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else if($designation_name && empty($status))
        {
            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `designation`
            // WHERE  `delete_status` = '1' AND
            // `designation_name`  LIKE '%".$designation_name."%' ESCAPE '!' 
            // ORDER BY `designation_id` DESC");

            $this->db->select('*');
	        $this->db->from('designation');
	        $this->db->like('designation_name',$designation_name);
	        $this->db->escape_like_str($designation_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status' =>1)); 
	        $this->db->order_by("designation_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else if(empty($designation_name) && $status)
        {

            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `designation`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'  
            // ORDER BY `designation_id` DESC");

            $this->db->select('*');
	        $this->db->from('designation');
	        $this->db->where(array('delete_status' =>1,'status'=>$status)); 
	        $this->db->order_by("designation_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else
        {
            // $query = $this->db->query("SELECT *
            // FROM `designation`
            // WHERE  `delete_status` = '1' AND `status` = '1'
            // ORDER BY `designation_id` DESC");


            $this->db->select('*');
	        $this->db->from('designation');
	        $this->db->where(array('delete_status' =>1,'status'=>1)); 
	        $this->db->order_by("designation_id", "DESC");
	        $query = $this->db->get();


            return $query->result();
        }
    }//ends function

         /**
     function to check search room
     */
    public function search_room($room_name,$status)
    { 
        if($room_name && $status)
        {
            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `room_no`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'
            // AND  `room_name`  LIKE '%".$room_name."%' ESCAPE '!' 
            // ORDER BY `room_id` DESC");

             $this->db->select('*');
	        $this->db->from('room_no');
	        $this->db->like('room_name',$room_name);
	        $this->db->escape_like_str($room_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status' =>1,'status'=>$status)); 
	        $this->db->order_by("room_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else if($room_name && empty($status))
        {
            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `room_no`
            // WHERE  `delete_status` = '1' AND
            // `room_name`  LIKE '%".$room_name."%' ESCAPE '!' 
            // ORDER BY `room_id` DESC");

            $this->db->select('*');
	        $this->db->from('room_no');
	        $this->db->like('room_name',$room_name);
	        $this->db->escape_like_str($room_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status' =>1)); 
	        $this->db->order_by("room_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else if(empty($room_name) && $status)
        {

            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `room_no`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'  
            // ORDER BY `room_id` DESC");

            $this->db->select('*');
	        $this->db->from('room_no');
	        $this->db->where(array('delete_status' =>1,'status' => $status)); 
	        $this->db->order_by("room_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else
        {
            // $query = $this->db->query("SELECT *
            // FROM `room_no`
            // WHERE  `delete_status` = '1' AND `status` = '1'
            // ORDER BY `room_id` DESC");

            $this->db->select('*');
	        $this->db->from('room_no');
	        $this->db->where(array('delete_status' =>1,'status' => 1)); 
	        $this->db->order_by("room_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }
    }//ends function

     /**
     function to check search section
     */
    public function search_section($section_name,$status)
    { 
        if($section_name && $status)
        {
            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `section`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'
            // AND  `section_name`  LIKE '%".$section_name."%' ESCAPE '!' 
            // ORDER BY `section_id` DESC");


            $this->db->select('*');
	        $this->db->from('section');
	        $this->db->like('section_name',$section_name);
	        $this->db->escape_like_str($section_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status' =>1,'status'=>$status)); 
	        $this->db->order_by("section_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else if($section_name && empty($status))
        {
            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `section`
            // WHERE  `delete_status` = '1' AND
            // `section_name`  LIKE '%".$section_name."%' ESCAPE '!' 
            // ORDER BY `section_id` DESC");

            $this->db->select('*');
	        $this->db->from('section');
	        $this->db->like('section_name',$section_name);
	        $this->db->escape_like_str($section_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status' =>1)); 
	        $this->db->order_by("section_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else if(empty($section_name) && $status)
        {

            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `section`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'  
            // ORDER BY `section_id` DESC");

            $this->db->select('*');
	        $this->db->from('section');
	        $this->db->where(array('delete_status' =>1,'status' =>$status)); 
	        $this->db->order_by("section_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else
        {
            // $query = $this->db->query("SELECT *
            // FROM `section_name`
            // WHERE  `delete_status` = '1' AND `status` = '1'
            // ORDER BY `section_id` DESC");

            $this->db->select('*');
	        $this->db->from('section_name');
	        $this->db->where(array('delete_status' =>1,'status' =>1)); 
	        $this->db->order_by("section_id", "DESC");
	        $query = $this->db->get();


            return $query->result();
        }
    }//ends function


     /**
     function to check search wing
     */
    public function search_wing($wing_name,$status)
    { 
        if($wing_name && $status)
        {
            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `wing`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'
            // AND  `wing_name`  LIKE '%".$wing_name."%' ESCAPE '!' 
            // ORDER BY `wing_id` DESC");

            $this->db->select('*');
	        $this->db->from('wing');
	        $this->db->like('wing_name',$wing_name);
	        $this->db->escape_like_str($wing_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status' =>1,'status' =>$status)); 
	        $this->db->order_by("wing_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else if($wing_name && empty($status))
        {
            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `wing`
            // WHERE  `delete_status` = '1' AND
            // `wing_name`  LIKE '%".$wing_name."%' ESCAPE '!' 
            // ORDER BY `wing_id` DESC");

            $this->db->select('*');
	        $this->db->from('wing');
	        $this->db->like('wing_name',$wing_name);
	        $this->db->escape_like_str($wing_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status' =>1)); 
	        $this->db->order_by("wing_id", "DESC");
	        $query = $this->db->get();


            return $query->result();
        }

        else if(empty($wing_name) && $status)
        {

            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `wing`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'  
            // ORDER BY `wing_id` DESC");

            $this->db->select('*');
	        $this->db->from('wing');
	        $this->db->where(array('delete_status' =>1,'status' => $status)); 
	        $this->db->order_by("wing_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else
        {
            // $query = $this->db->query("SELECT *
            // FROM `wing`
            // WHERE  `delete_status` = '1' AND `status` = '1'
            // ORDER BY `section_id` DESC");

            $this->db->select('*');
	        $this->db->from('wing');
	        $this->db->where(array('delete_status' =>1,'status' => 1)); 
	        $this->db->order_by("wing_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }
    }//ends function


        /**
     function to check vendor search
     */
    public function search_vendor($company_name,$status)
    { 
        if($company_name && $status)
        {
            if($status=='2')
            {
                $status = 0;
            }
            
            // $query = $this->db->query("SELECT *
            // FROM `vendor`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'
            // AND  `company_name`  LIKE '%".$company_name."%' ESCAPE '!' 
            // ORDER BY `vendor_id` DESC");

            $this->db->select('*');
	        $this->db->from('vendor');
	        $this->db->like('company_name',$company_name);
	        $this->db->escape_like_str($company_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status' =>1,'status' =>$status)); 
	        $this->db->order_by("vendor_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else if($company_name && empty($status))
        {
            if($status=='2')
            {
                $status = 0;
            }

            // $query = $this->db->query("SELECT *
            // FROM `vendor`
            // WHERE  `delete_status` = '1' AND
            // `company_name`  LIKE '%".$company_name."%' ESCAPE '!' 
            // ORDER BY `vendor_id` DESC");

            $this->db->select('*');
	        $this->db->from('vendor');
	        $this->db->like('company_name',$company_name);
	        $this->db->escape_like_str($company_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status' =>1)); 
	        $this->db->order_by("vendor_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else if(empty($company_name) && $status)
        {

            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `vendor`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'  
            // ORDER BY `vendor_id` DESC");

            $this->db->select('*');
	        $this->db->from('vendor');
	        $this->db->where(array('delete_status' =>1,'status' =>$status)); 
	        $this->db->order_by("vendor_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else
        {
            // $query = $this->db->query("SELECT *
            // FROM `vendor`
            // WHERE  `delete_status` = '1' AND `status` = '1'
            // ORDER BY `vendor_id` DESC");

            $this->db->select('*');
	        $this->db->from('vendor');
	        $this->db->where(array('delete_status' =>1,'status' =>1)); 
	        $this->db->order_by("vendor_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }
    }//ends function

      /**
     function to check vendoremployeee search
     */
    public function search_vendoremployee($vendor_employee_name,$status)
    { 
        if($vendor_employee_name && $status)
        {
            if($status=='2')
            {
                $status = 0;
            }
            
            // $query = $this->db->query("SELECT *
            // FROM `vendor_employee`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'
            // AND  `vendor_employee_name`  LIKE '%".$vendor_employee_name."%' ESCAPE '!' 
            // ORDER BY `vendor_employee_id` DESC");

             $this->db->select('*');
	        $this->db->from('vendor_employee');
	        $this->db->like('vendor_employee_name',$vendor_employee_name);
	        $this->db->escape_like_str($vendor_employee_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status' =>1,'status'=>$status)); 
	        $this->db->order_by("vendor_employee_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else if($vendor_employee_name && empty($status))
        {
            if($status=='2')
            {
                $status = 0;
            }

            // $query = $this->db->query("SELECT *
            // FROM `vendor_employee`
            // WHERE  `delete_status` = '1' AND
            // `vendor_employee_name`  LIKE '%".$vendor_employee_name."%' ESCAPE '!' 
            // ORDER BY `vendor_employee_id` DESC");

          
            $this->db->select('*');
	        $this->db->from('vendor_employee');
	        $this->db->like('vendor_employee_name',$vendor_employee_name);
	        $this->db->escape_like_str($vendor_employee_name)."%' ESCAPE '!'";
	        $this->db->where(array('delete_status' =>1)); 
	        $this->db->order_by("vendor_employee_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else if(empty($vendor_employee_name) && $status)
        {

            if($status=='2')
            {
                $status = 0;
            }
            // $query = $this->db->query("SELECT *
            // FROM `vendor_employee`
            // WHERE  `delete_status` = '1' AND `status` = '".$status."'  
            // ORDER BY `vendor_employee_id` DESC");

             $this->db->select('*');
	        $this->db->from('vendor_employee');
	        $this->db->where(array('delete_status' =>1,'status'=>$status)); 
	        $this->db->order_by("vendor_employee_id", "DESC");
	        $query = $this->db->get();

            return $query->result();
        }

        else
        {
            // $query = $this->db->query("SELECT *
            // FROM `vendor_employee`
            // WHERE  `delete_status` = '1' AND `status` = '1'
            // ORDER BY `vendor_id` DESC");

            $this->db->select('*');
	        $this->db->from('vendor_employee');
	        $this->db->where(array('delete_status' =>1,'status'=>1)); 
	        $this->db->order_by("vendor_id", "DESC");
	        $query = $this->db->get();


            return $query->result();
        }
    }//ends function

     /*********function for searching employee**********/

    public function searching_employee($employee_name,$employee_code,$employee_designation,$status)
    {
        /**********employee name code***********/

            if(empty($employee_name))
            {
                $employee_id = '';
            }// ends if

            else
            {
                $this->db->select('*');
                $this->db->from('employee');
                if($employee_name)
                $this->db->like('employee_name', $employee_name);
                $this->db->order_by("employee_id", "DESC");
                $query_employee = $this->db->get();
                $employee_data =  $query_employee->result();

                $employee_idd = array();
                foreach ($employee_data as $employee) 
                {
                    $employee_idd[] = $employee->employee_id;
                }
                $employee_id = implode(',', $employee_idd);

                if(empty($employee_id))
                {
                    $employee_id = '';
                }

                else
                {
                    $employee_id =  $employee_id;
                }
        }//ends else

         /**********ends employee code***********/

         /*************employee_code code***************/

            if(empty($employee_code))
            {
                $employee_code = '';
            }// ends if

            else
            {
                $this->db->select('*');
                $this->db->from('employee');
                if($employee_code)
                $this->db->like('employee_code', $employee_code);
                $this->db->order_by("employee_id", "DESC");
                $query_employee = $this->db->get();
                $employee_data =  $query_employee->result();

                $employee_codeidd = array();
                foreach ($employee_data as $employee) 
                {
                    $employee_codeidd[] = $employee->employee_id;
                }
                $employee_codemmm = implode(',', $employee_codeidd);

               
                if(empty($employee_codemmm))
                {
                    $employee_code = '';
                }

                else
                {
                    $employee_code =  $employee_codemmm;
                }
            }//ends else
           
          /************ends employee_code code***********/

          /*********employee_designation code*******/

            if(empty($employee_designation))
            {
                $employee_designation = '';
            }// ends if

            else
            {
                 $employee_designation = $employee_designation ;
            }//ends else

            

        /******final query*******/
                 if($employee_name && $employee_code && $employee_designation && $status)
                {

                    if($status=='2')
                    {
                        $status = 0;
                    }
                    // $query = $this->db->query("SELECT *
                    // FROM `employee`
                    // WHERE `employee_id` IN('".$employee_id."') AND `employee_code` IN('".$employee_code."') 
                    // AND `employee_designation` IN('".$employee_designation."')  AND `status` IN('".$status."') AND `delete_status` ='1'
                    // ORDER BY `employee_id` DESC ")  ;

                    $this->db->select('*');
			        $this->db->from('employee');
			        $this->db->where_in(array('employee_id' => $employee_id,'employee_code'=>$employee_code,'employee_designation' => $employee_designation, 'status'=>$status));
			        $this->db->where('delete_status', 1);
			        $this->db->order_by("employee_id", "DESC");
			        $query = $this->db->get();

                    return $query->result();
                }

                if($employee_name && empty($employee_code) && empty($employee_designation) && empty($status))
                {
                    if($status=='2')
                    {
                        $status = 0;
                    }
                    if(empty($employee_id))
                    {
                        $query = $this->db->query("SELECT * FROM employee WHERE employee_id IN (SELECT employee_id FROM employee WHERE FALSE)");
                        return $query->result(); 
                    }
                    else
                    {
                        
                        // $query = $this->db->query("SELECT *
                        // FROM `employee`
                        // WHERE `employee_id` IN(".$employee_id.") AND `delete_status` ='1'
                        // ORDER BY `employee_id` DESC ")  ;

                        $this->db->select('*');
				        $this->db->from('employee');
				        $this->db->where_in(array('employee_id' => $employee_code));
				        $this->db->where('delete_status', 1);
				        $this->db->order_by("employee_id", "DESC");
				        $query = $this->db->get();
                    
                        return $query->result();
                    }
                    
                }


                //check employee code
                if($employee_code && empty($employee_name) && empty($employee_designation) && empty($status))
                {
                    if($status=='2')
                    {
                        $status = 0;
                    }


                    if(empty($employee_code))
                    {
                       $query = $this->db->query("SELECT * FROM employee WHERE employee_code IN (SELECT employee_code FROM employee WHERE FALSE)");
                        return $query->result(); 
                    }

                    else
                    {
                        // $query = $this->db->query("SELECT *
                        // FROM `employee`
                        // WHERE `employee_id` IN(".$employee_code.") AND `delete_status` ='1'
                        // ORDER BY `employee_id` DESC ")  ;

	                    $this->db->select('*');
				        $this->db->from('employee');
				        $this->db->where_in(array('employee_id' => $employee_code));
				        $this->db->where('delete_status', 1);
				        $this->db->order_by("employee_id", "DESC");
				        $query = $this->db->get();
                        
                        return $query->result(); 
                    }
                    
             
                }//ends if

                //check employee_designation
                if($employee_designation && empty($employee_name) && empty($employee_code) && empty($status))
                {   
                    if($status=='2')
                    {
                        $status = 0;
                    }
                    if(empty($employee_designation))
                    {
                        $query = $this->db->query("SELECT * FROM employee WHERE employee_designation IN (SELECT employee_designation FROM employee WHERE FALSE)");


                        return $query->result(); 
                    }
                    else
                    {
                        // $query = $this->db->query("SELECT *
                        // FROM `employee`
                        // WHERE `employee_designation` IN(".$employee_designation.") AND `delete_status` ='1'
                        // ORDER BY `employee_id` DESC ")  ;

	                    $this->db->select('*');
				        $this->db->from('employee');
				        $this->db->where_in(array('employee_designation' => $employee_designation));
				        $this->db->where('delete_status', 1);
				        $this->db->order_by("employee_id", "DESC");
				        $query = $this->db->get();
                    
                    
                        return $query->result(); 
                    }
                    
                }//ends if

                 //check status
                if($status && empty($employee_name) && empty($employee_code) && empty($employee_designation))
                {
                    if($status=='2')
                    {
                        $status = 0;
                    }
                  
                        // $query = $this->db->query("SELECT *
                        // FROM `employee`
                        // WHERE `status` IN('".$status."') AND `delete_status` ='1'
                        // ORDER BY `employee_id` DESC ")  ;


                    $this->db->select('*');
			        $this->db->from('employee');
			        $this->db->where_in(array('status' => $status));
			        $this->db->where('delete_status', 1);
			        $this->db->order_by("employee_id", "DESC");
			        $query = $this->db->get();
                    
                        return $query->result(); 
                    
                    
                }//ends if

                //check employee name and employee code
                if($employee_name && $employee_code && empty($employee_designation) && empty($status))
                {
                    if($status=='2')
                    {
                        $status = 0;
                    }
                    // $query = $this->db->query("SELECT *
                    // FROM `employee`
                    // WHERE `employee_id` IN(".$employee_id.") AND `employee_id` IN(".$employee_code.") 
                    // AND  `delete_status` ='1'
                    // ORDER BY `employee_id` DESC ")  ;

                    $this->db->select('*');
			        $this->db->from('employee');
			        $this->db->where_in(array('employee_id' => $employee_id,'employee_id' => $employee_code));
			        $this->db->where('delete_status', 1);
			        $this->db->order_by("employee_id", "DESC");
			        $query = $this->db->get();

                    return $query->result();
                }

                //check employee name and employee code and employee designation
                if($employee_name && $employee_code && $employee_designation && empty($status))
                {
                    if($status=='2')
                    {
                        $status = 0;
                    }
                    // $query = $this->db->query("SELECT *
                    // FROM `employee`
                    // WHERE `employee_id` IN(".$employee_id.") AND `employee_id` IN(".$employee_code.") 
                    // AND `employee_designation` IN(".$employee_designation.")  AND `delete_status` ='1'
                    // ORDER BY `employee_id` DESC ");

                 $this->db->select('*');
		        $this->db->from('employee');
		        $this->db->where_in(array('employee_id' => $employee_id,'employee_id' => $employee_code));
		        $this->db->where('delete_status', 1);
		        $this->db->order_by("employee_id", "DESC");
		        $query = $this->db->get();

                    return $query->result();
                }

                //check employee name and employee_designation
                if(empty($employee_code) && $employee_name && $employee_designation && empty($status))
                {
                    if($status=='2')
                    {
                        $status = 0;
                    }

                    if(empty($employee_id))
                    {
                        $employee_id = '';
                    }
                    // $query = $this->db->query("SELECT *
                    // FROM `employee`
                    // WHERE `employee_id` IN('".$employee_id."') 
                    // AND `employee_designation` IN(".$employee_designation.")  AND `delete_status` ='1'
                    // ORDER BY `employee_id` DESC ")  ;

                $this->db->select('*');
		        $this->db->from('employee');
		        $this->db->where_in(array('employee_id' => $employee_id,'employee_designation' => $employee_designation));
		        $this->db->where('delete_status', 1);
		        $this->db->order_by("employee_id", "DESC");
		        $query = $this->db->get();

                return $query->result();
                
              }

                //check employee name and status
                if(empty($employee_code) && $employee_name && empty($employee_designation) && $status)
                {
                    if($status=='2')
                    {
                        $status = 0;
                    }
                   // $query = $this->db->query("SELECT *
                   //  FROM `employee`
                   //  WHERE `employee_id` IN(".$employee_id.") 
                   //  AND `status` IN(".$status.") AND `delete_status` ='1'
                   //  ORDER BY `employee_id` DESC ")  ;

                $this->db->select('*');
		        $this->db->from('employee');
		        $this->db->where_in(array('employee_id' => $employee_code,'status' => $status));
		        $this->db->where('delete_status', 1);
		        $this->db->order_by("employee_id", "DESC");
		        $query = $this->db->get();


                    return $query->result();
                    
                }

                //check employee code and status
                if(empty($employee_name) && $employee_code && empty($employee_designation) && $status)
                {
                    if($status=='2')
                    {
                        $status = 0;
                    }
                    // $query = $this->db->query("SELECT *
                    // FROM `employee`
                    // WHERE `employee_id` IN(".$employee_code.") 
                    // AND `status` IN(".$status.") AND `delete_status` ='1'
                    // ORDER BY `employee_id` DESC ")  ;

                $this->db->select('*');
		        $this->db->from('employee');
		        $this->db->where_in(array('employee_id' => $employee_code,'status' => $status));
		        $this->db->where('delete_status', 1);
		        $this->db->order_by("employee_id", "DESC");
		        $query = $this->db->get();


                    return $query->result();
                    
                }

                //employee code and employee designation
                if(empty($employee_name) && $employee_code && $employee_designation && empty($status))
                {
                    if($status=='2')
                    {
                        $status = 0;
                    }
                    // $query = $this->db->query("SELECT *
                    // FROM `employee`
                    // WHERE `employee_id` IN(".$employee_code.") 
                    // AND `employee_designation` IN(".$employee_designation.") AND `delete_status` ='1'
                    // ORDER BY `employee_id` DESC ")  ;

	            $this->db->select('*');
		        $this->db->from('employee');
		        $this->db->where_in(array('employee_id' => $employee_code,'employee_designation' => $employee_designation));
		        $this->db->where('delete_status', 1);
		        $this->db->order_by("employee_id", "DESC");
		        $query = $this->db->get();

                return $query->result();
                    
                }


                else
                {
                    if($status=='2')
                    {
                        $status = 0;
                    }
                    // $query = $this->db->query("SELECT *
                    // FROM `employee`
                    // WHERE 1 
                    // ORDER BY `employee_id` DESC");
                    // return $query->result();

                     $this->db->select('*');
			        $this->db->from('employee');
			        $this->db->where(1);
			        $this->db->order_by("employee_id", "DESC");
			        $query = $this->db->get();
			        
			        return $query->result();

                }

        /******ends final query*******/
    }//ends function

    public function searchuser_role($user_id)
    {
        // $query = $this->db->query("SELECT *
        //             FROM `users`
        //             WHERE `user_id` IN(".$user_id.") 
        //             AND `delete_status` ='1'
        //             ORDER BY `user_id` DESC ")  ;
        //             return $query->result();

        $this->db->select('*');
        $this->db->from('users');
        $this->db->where_in('user_id', $user_id);
        $this->db->where('delete_status', 1);
        $this->db->order_by("user_id", "DESC");
        $query = $this->db->get();

        return $query->result();
                
    }

    public function search_usernamme($user_name)
    {
        $this->db->select('*');
        $this->db->from('users');
        
        if($user_name)
        $this->db->like('user_name', $user_name);
        $this->db->where('delete_status', 1);
        $this->db->order_by("user_id", "DESC");
        $query = $this->db->get();
        return $query->result();
                
    }



  public function lastid(){
     $query = $this->db->query('SELECT `employee_id` FROM employee ORDER BY `employee_id` DESC LIMIT 1');
     return $query->row();
  }




   public function search_office($office_name,$status)
    { 
        if($office_name && $status)
        {
            
            
            $this->db->select('*');
            $this->db->from('employee_office');
            $this->db->like('office_name',$office_name);
            $this->db->escape_like_str($office_name)."%' ESCAPE '!'";
            $this->db->where(array('delete_status' =>'0')); 
            $this->db->order_by("office_id", "DESC");
            $query = $this->db->get();

            return $query->result();
        }

        else if($office_name && empty($status))
        {
           

            $this->db->select('*');
            $this->db->from('employee_office');
            $this->db->like('office_name',$office_name);
            $this->db->escape_like_str($office_name)."%' ESCAPE '!'";
            $this->db->where(array('delete_status' =>'0')); 
            $this->db->order_by("office_id", "DESC");
            $query = $this->db->get();

            return $query->result();
        }

        else if(empty($office_name) && $status)
        {
            
            $this->db->select('*');
            $this->db->from('employee_office');
            $this->db->where(array('delete_status' =>'0')); 
            $this->db->order_by("office_id", "DESC");
            $query = $this->db->get();

            return $query->result();
        }

        else
        {

            $this->db->select('*');
            $this->db->from('employee_office');
            $this->db->where(array('delete_status' =>'0')); 
            $this->db->order_by("office_id", "DESC");
            $query = $this->db->get();
            return $query->result();
        }
    }//ends function



    
}//class ends