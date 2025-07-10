<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact_model extends CI_Model
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
     function to check organisation name
     */
    public function check_existent_organisation($organisation_name, $id)
    { 
        // $query = $this->db->query("SELECT * FROM `contact_organisation` WHERE `contact_organisation_name` = '".$organisation_name."' AND `contact_organisation_id`!='".$id."' AND `delete_status`= 1  ");

      $this->db->select('*');
       $this->db->from('contact_organisation');
       $this->db->where(array('contact_organisation_name'=>$organisation_name, 'contact_organisation_id != ' => $id,  'delete_status' =>1));

         $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     function to check post name
     */
    public function check_existent_post($post_name,$organisation_id,$id)
    { 
        // $query = $this->db->query("SELECT * FROM `contact_post` WHERE `contact_post_name` = '".$post_name."' AND `contact_organisation_id` = '".$organisation_id."' AND  `contact_post_id`!='".$id."' AND `delete_status`= 1  ");

       $this->db->select('*');
       $this->db->from('contact_post');
       $this->db->where(array('contact_post_name'=>$post_name, 'contact_organisation_id' => $organisation_id, 'contact_post_id !='=>$id, 'delete_status' =>1));

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
    public function check_existent_designation($organisation_name,$post_name,$designation_name,$id)
    { 
        // $query = $this->db->query("SELECT * FROM `contact_designation` WHERE `contact_designation_name` = '".$designation_name."' AND `contact_organisation_id` = '".$organisation_name."' AND `contact_post_id` = '".$post_name."'  AND  `contact_designation_id`!='".$id."' AND `delete_status`= 1  ");


       $this->db->select('*');
       $this->db->from('contact_designation');
       $this->db->where(array('contact_designation_name'=>$designation_name, 'contact_organisation_id' => $organisation_id, 'contact_post_id'=>$post_name,'contact_designation_id != '=> $id, 'delete_status' =>1));

        $query = $this->db->get();
        
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    /**
     function to search contact
     */
    public function searching_contact($contact_name,$wing_name,$organisation_name,$post_name,$designation_name)
    { 
        if(empty($contact_name))
        {
            $contact_name = '';
        }

        else
        {
            $contact_name = $contact_name;
        }//ends contact

        if(empty($wing_name))
        {
            $wing_name = '';
        }

        else
        {
            $wing_name = $wing_name;
        }//ends wing


        if(empty($organisation_name))
        {
            $organisation_name = '';
        }

        else
        {
            $organisation_name = $organisation_name;
        }//ends organisation

        if(empty($post_name))
        {
            $post_name = '';
        }

        else
        {
            $post_name = $post_name;
        }//ends post

        if(empty($designation_name))
        {
            $designation_name = '';
        }

        else
        {
            $designation_name = $designation_name;
        }//ends designation


        // $query = $this->db->query("SELECT *
        //     FROM `contact_detail_master`
        //     WHERE  `delete_status` = '1' AND
        //     `name`  LIKE '%".$contact_name."%' AND `contact_organisation`  LIKE '%".$organisation_name."%' AND`contact_wing`  LIKE '%".$wing_name."%' AND`contact_post`  LIKE '%".$post_name."%' AND`contact_designation`  LIKE '%".$designation_name."%' ESCAPE '!' 
        //     ORDER BY `contact_detail_master_id` DESC");

        $this->db->select('*');
        $this->db->from('contact_detail_master');
        $this->db->like(array('name'=>$contact_name,'contact_organisation'=>$organisation_name,'contact_wing'=>$wing_name,'contact_post'=>$post_name,'contact_designation'=>$designation_name));
        $this->db->escape_like_str($contact_name)."%' ESCAPE '!'";
        $this->db->where('delete_status', 1); 
        $this->db->order_by("contact_detail_master_id", "DESC");
        $query = $this->db->get();

        return $query->result();

    }//ends function

  /************function to sarch orgn*********/

  public function search_organisation($name)
  {
     // $query = $this->db->query("SELECT *
     //        FROM `contact_organisation`
     //        WHERE  `delete_status` = '1' AND
     //        `contact_organisation_name`  LIKE '%".$name."%'  ESCAPE '!' 
     //        ORDER BY `contact_organisation_id` DESC");

        $this->db->select('*');
        $this->db->from('contact_organisation');
        $this->db->like('contact_organisation_name', $name);
        $this->db->escape_like_str($name)."%' ESCAPE '!'";
        $this->db->where('delete_status', 1); 
        $this->db->order_by("contact_organisation_id", "DESC");
        $query = $this->db->get();

       return $query->result();
  }
  //search post
   public function search_post($name)
  {
     // $query = $this->db->query("SELECT *
     //        FROM `contact_post`
     //        WHERE  `delete_status` = '1' AND
     //        `contact_post_name`  LIKE '%".$name."%'  ESCAPE '!' 
     //        ORDER BY `contact_post_id` DESC");

        $this->db->select('*');
        $this->db->from('contact_post');
        $this->db->like('contact_post_name', $name);
        $this->db->escape_like_str($name)."%' ESCAPE '!'";
        $this->db->where('delete_status', 1); 
        $this->db->order_by("contact_post_id", "DESC");
        $query = $this->db->get();

            return $query->result();
  }

  public function search_designation($name)
  {
     // $query = $this->db->query("SELECT *
     //        FROM `contact_designation`
     //        WHERE  `delete_status` = '1' AND
     //        `contact_designation_name`  LIKE '%".$name."%'  ESCAPE '!' 
     //        ORDER BY `contact_designation_id` DESC");

        $this->db->select('*');
        $this->db->from('contact_designation');
        $this->db->like('contact_designation_name', $name);
        $this->db->escape_like_str($name)."%' ESCAPE '!'";
        $this->db->where('delete_status', 1); 
        $this->db->order_by("contact_designation_id", "DESC");
        $query = $this->db->get();

        return $query->result();

  }


}//class ends