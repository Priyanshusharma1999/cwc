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

    public function cccheck_existent($table, $where)
    {
        $query = $this->db->get_where($table, $where);
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    //check admin email

    public function check_existent_user_email($email,$user_id)
    {
        $query = $this->db->query("SELECT * FROM `tbl_admin` WHERE `email` = '".$email."' 
            AND `user_id`!= '".$user_id."' ");
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }

    //function for check user 
     public function check_userr($table, $where,$userid)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($where);
        $this->db->where('user_id=', $userid);
        
        $query = $this->db->get();//echo $this->db->last_query();exit;
        if ($query->num_rows() > 0) {
            return 1;
        } 
        else {
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

    //function for get jobs in applicant section
    public function getts_jobss($region_id,$circle_id)
    {
      


        $query = $this->db->query("SELECT * FROM `tbl_jobs` Where `region_id` = '".$region_id."'  AND `circle_id` = '".$circle_id."' AND `status` = '1' AND `job_status` = '1' AND CURDATE() >= `start_date` AND CURDATE() <= `end_date` ");
       // $query = $this->db->query("SELECT * FROM `tbl_jobs` Where `region_id` = '1' AND `circle_id` = '3' AND '30/05/2018' >= `start_date` AND '30/05/2018' <= `end_date` ");
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

    /************function get all job data*******/

    public function all_job_data($job_id)
    {
        $query = $this->db->query("SELECT basic.*,education.*,other.*,document.*  FROM tbl_app_job_bas_info as basic 
             INNER JOIN tbl_app_job_edu_info as education ON education.basic_info_id = basic.id
             INNER JOIN tbl_app_job_oth_info as other ON other.basic_info_id = basic.id
             INNER JOIN tbl_app_job_doc_info as document ON document.basic_info_id = basic.id
             WHERE basic.id = '".$job_id."'");
        return $query->result();
    }

    /**********function for region search*******/

    public function search_region($region_name)
    {
        $this->db->select('*');
        $this->db->from('tbl_region');
        
        if($region_name)
        $this->db->like('region_name', $region_name);
        $this->db->where('status', 1);
        $this->db->order_by("id", "DESC");
        $query = $this->db->get();
        return $query->result();
    }

    /********function for circle search*********/

    public function search_circle($region_name,$circle_name)
    {
        if($region_name && $circle_name)
        {
            $this->db->select('*');
            $this->db->from('tbl_region');
        
            if($region_name)
            $this->db->like('region_name', $region_name);
            $this->db->where('status', 1);
            $this->db->order_by("id", "DESC");
            $query_region = $this->db->get();
            $region_data =  $query_region->result();

            
            foreach ($region_data as $region) 
            {
                $region_idd[] = $region->id;
            }
            $region_id = implode(',', $region_idd);
            $query = $this->db->query("SELECT *
                    FROM `tbl_circle`
                    WHERE `region_id` IN(".$region_id.") AND `status` = '1'
                    AND  circle_name  LIKE '%".$circle_name."%' ESCAPE '!' 
                    ORDER BY `id` DESC");

            return $query->result();
        }// ends if

        else
        {
           if($region_name && empty($circle_name))
           {
                 $this->db->select('*');
                $this->db->from('tbl_region');
        
                if($region_name)
                $this->db->like('region_name', $region_name);
                $this->db->order_by("id", "DESC");
                $query_region = $this->db->get();
                $region_data =  $query_region->result();

                foreach ($region_data as $region) 
                {
                    $region_idd[] = $region->id;
                }
                $region_id = implode(',', $region_idd);
                $query = $this->db->query("SELECT *
                        FROM `tbl_circle`
                        WHERE `region_id` IN(".$region_id.") AND `status` = '1'
                        ORDER BY `id` DESC");

                return $query->result();
           }//ends if

           if($circle_name && empty($region_name))
           {
                $this->db->select('*');
                $this->db->from('tbl_circle');
                if($circle_name)
                $this->db->like('circle_name', $circle_name);
                $this->db->where('status', 1);
                $this->db->order_by("id", "DESC");
                $query = $this->db->get();
                return $query->result();
           }
        }//ends else
    }// function ends

    /********function for post search*********/

    public function search_post($region_name,$circle_name,$post_name)
    {
        if($region_name && $circle_name && $post_name)
        {
            /********region id code *******/

            $this->db->select('*');
            $this->db->from('tbl_region');
            if($region_name)
            $this->db->like('region_name', $region_name);
            $this->db->order_by("id", "DESC");
            $query_region = $this->db->get();
            $region_data =  $query_region->result();

            
            foreach ($region_data as $region) 
            {
                $region_idd[] = $region->id;
            }
            $region_id = implode(',', $region_idd);

             /********circle id code *******/

            $this->db->select('*');
            $this->db->from('tbl_circle');
            if($circle_name)
            $this->db->like('circle_name', $circle_name);
            $this->db->order_by("id", "DESC");
            $query_circle = $this->db->get();
            $circle_data  =  $query_circle->result();

            
            foreach ($circle_data as $circle) 
            {
                $circle_idd[] = $circle->id;
            }
            $circle_id = implode(',', $circle_idd);

             $query = $this->db->query("SELECT *
                    FROM `tbl_post`
                    WHERE `region_id` IN(".$region_id.") AND `circle_id` IN(".$circle_id.") AND `status` = '1'
                    AND  post_name  LIKE '%".$post_name."%' ESCAPE '!' 
                    ORDER BY `id` DESC");

             return $query->result();

        }//ends if

        else
        {
            //if region name only and circle and post name empty
            if($region_name && empty($circle_name) && empty($post_name))
            {
                $this->db->select('*');
                $this->db->from('tbl_region');
                if($region_name)
                $this->db->like('region_name', $region_name);
                $this->db->order_by("id", "DESC");
                $query_region = $this->db->get();
                $region_data =  $query_region->result();

                
                foreach ($region_data as $region) 
                {
                    $region_idd[] = $region->id;
                }
                $region_id = implode(',', $region_idd);
                $query = $this->db->query("SELECT *
                    FROM `tbl_post`
                    WHERE `region_id` IN(".$region_id.") AND `status` = '1'
                    ORDER BY `id` DESC");

                return $query->result();

            }//end if

            //if circle name only and region and post name empty
            if($circle_name && empty($region_name) && empty($post_name))
            {
                $this->db->select('*');
                $this->db->from('tbl_circle');
                if($circle_name)
                $this->db->like('circle_name', $circle_name);
                $this->db->order_by("id", "DESC");
                $query_circle = $this->db->get();
                $circle_data  =  $query_circle->result();

                
                foreach ($circle_data as $circle) 
                {
                    $circle_idd[] = $circle->id;
                }
                $circle_id = implode(',', $circle_idd);

                $query = $this->db->query("SELECT *
                    FROM `tbl_post`
                    WHERE `circle_id` IN(".$circle_id.") AND `status` = '1'
                    ORDER BY `id` DESC");

                return $query->result();

            }//end if

             //if circle name, region name only and   post name empty
            if($circle_name && $region_name && empty($post_name))
            {
                $this->db->select('*');
                $this->db->from('tbl_region');
                if($region_name)
                $this->db->like('region_name', $region_name);
                $this->db->order_by("id", "DESC");
                $query_region = $this->db->get();
                $region_data =  $query_region->result();

                
                foreach ($region_data as $region) 
                {
                    $region_idd[] = $region->id;
                }
                $region_id = implode(',', $region_idd);


                $this->db->select('*');
                $this->db->from('tbl_circle');
                if($circle_name)
                $this->db->like('circle_name', $circle_name);
                $this->db->order_by("id", "DESC");
                $query_circle = $this->db->get();
                $circle_data  =  $query_circle->result();

                
                foreach ($circle_data as $circle) 
                {
                    $circle_idd[] = $circle->id;
                }
                $circle_id = implode(',', $circle_idd);
                $query = $this->db->query("SELECT *
                    FROM `tbl_post`
                    WHERE `region_id` IN(".$region_id.") AND `circle_id` IN(".$circle_id.") AND `status` = '1'
                    ORDER BY `id` DESC");


                return $query->result();

            }//end if

            /****** for region name and circle name are empty and post name exits***/

            if(empty($circle_name) && empty($region_name) && $post_name)
           {
                $this->db->select('*');
                $this->db->from('tbl_post');
                if($post_name)
                $this->db->like('post_name', $post_name);
                $this->db->where('status', 1);
                $this->db->order_by("id", "DESC");
                $query = $this->db->get();
                return $query->result();
           }

        }//ends else
    }//ends function

    /**********function for search user*******/

    public function search_user($region_name,$circle_name)
    {
        if($region_name && $circle_name)
        {
          $query = $this->db->get_where('tbl_admin', array('Division'=>$region_name,'Circle'=>$circle_name));
          return $query->result();
        }// ends if

        else
        {
           if($region_name && empty($circle_name))
           {
                $query = $this->db->get_where('tbl_admin', array('Division'=>$region_name));
                return $query->result();
           }//ends if

           if($circle_name && empty($region_name))
           {
             $query = $this->db->get_where('tbl_admin', array('Circle'=>$circle_name));
             return $query->result();
           }
        }//ends else
    }// function ends

    /*********function for searching applicant**********/

    public function searching_applicant($applicant_name,$post_name,$caste_category,$ex_serviceman)
    {
        /**********applicant code***********/

            if(empty($applicant_name))
            {
                $applicant_id = '';
            }// ends if

            else
            {
                $this->db->select('*');
                $this->db->from('tbl_applicant');
                if($applicant_name)
                $this->db->like('name', $applicant_name);
                $this->db->order_by("id", "DESC");
                $query_applicant = $this->db->get();
                $applicant_data =  $query_applicant->result();

                $applicant_idd = array();
                foreach ($applicant_data as $applicant) 
                {
                    $applicant_idd[] = $applicant->id;
                }
                $applicant_id = implode(',', $applicant_idd);

                if(empty($applicant_id))
                {
                    $applicant_id = '';
                }

                else
                {
                    $applicant_id =  $applicant_id;
                }
        }//ends else

         /**********ends applicant code***********/

         /*************post_name code***************/

               if(empty($post_name))
            {
                $post_name = '';
            }// ends if

            else
            {
                 $post_name = $post_name ;
            }//ends else

          /************ends post_name code***********/

          /*********caste category code*******/
            if(empty($caste_category))
            {
                $caste_basic_infom_idd = '';
            }

            else
            {
                 $caste_based_data = $this->db->get_where('tbl_app_job_oth_info', array('caste_category'=>$caste_category));
                 $caste_data =  $caste_based_data->result();
                 $caste_basic_info_idd = array();
                 foreach ($caste_data as $caste) 
                    {
                        $caste_basic_info_idd[] = $caste->id;
                    }
                    $caste_basic_infom_idd = implode(',', $caste_basic_info_idd);

                    if(empty($caste_basic_infom_idd))
                    {
                        $caste_basic_infom_idd = '';
                    }

                    else
                    {
                        $caste_basic_infom_idd =  $caste_basic_infom_idd;
                    }
            }//ends else

        /****************code for ex_serviceman***************/

            if(empty($ex_serviceman))
            {
                $ex_serviceman_basic_infom_idd = '';
            }//ends if

            else
            {
                 $ex_serviceman_based_data = $this->db->get_where('tbl_app_job_oth_info', array('ex_serviceman'=>$ex_serviceman));
                 $ex_serviceman_data =  $ex_serviceman_based_data->result();
                 $ex_serviceman_basic_info_idd = array();
                 foreach ($ex_serviceman_data as $ex_serviceman) 
                    {
                        $ex_serviceman_basic_info_idd[] = $ex_serviceman->id;
                    }
                 $ex_serviceman_basic_infom_idd = implode(',', $ex_serviceman_basic_info_idd);

                 if(empty($ex_serviceman_basic_infom_idd))
                    {
                        $ex_serviceman_basic_infom_idd = '';
                    }

                    else
                    {
                        $ex_serviceman_basic_infom_idd =  $ex_serviceman_basic_infom_idd;
                    }
            }//ends else

        /***************ends code for ex_serviceman***************/

        /******final query*******/
                 if($applicant_name && $post_name && $caste_category && $ex_serviceman)
                {
                    $query = $this->db->query("SELECT *
                    FROM `tbl_app_job_bas_info`
                    WHERE `applicant_id` IN(".$applicant_id.") AND `job_id` IN(".$post_name.") 
                    AND `id` IN(".$caste_basic_infom_idd.")  AND `id` IN(".$ex_serviceman_basic_infom_idd.")
                    ORDER BY `id` DESC");
                    return $query->result();
                }

                if($applicant_name && empty($post_name) && empty($caste_category) && empty($ex_serviceman))
                {
                    if(empty($applicant_id))
                    {
                        $query = $this->db->query("SELECT * FROM tbl_app_job_bas_info WHERE id IN (SELECT id FROM tbl_app_job_bas_info WHERE FALSE)");
                        return $query->result(); 
                    }
                    else
                    {
                        $query = $this->db->query("SELECT *
                        FROM `tbl_app_job_bas_info`
                        WHERE `applicant_id` IN(".$applicant_id.")
                        ORDER BY `id` DESC");
                        return $query->result(); 
                    }
                    
                }

                if($post_name && empty($applicant_name) && empty($caste_category) && empty($ex_serviceman))
                 {
                    $query = $this->db->query("SELECT *
                    FROM `tbl_app_job_bas_info`
                    WHERE `job_id` IN(".$post_name.") 
                    ORDER BY `id` DESC");
                    return $query->result();
                 }//end if

                //check caste category
                if($caste_category && empty($applicant_name) && empty($post_name) && empty($ex_serviceman))
                {

                    if(empty($caste_basic_infom_idd))
                    {
                        $query = $this->db->query("SELECT * FROM tbl_app_job_bas_info WHERE id IN (SELECT id FROM tbl_app_job_bas_info WHERE FALSE)");
                        return $query->result(); 
                    }

                    else
                    {
                        $query = $this->db->query("SELECT *
                        FROM `tbl_app_job_bas_info`
                        WHERE `id` IN(".$caste_basic_infom_idd.")
                        ORDER BY `id` DESC");
                        return $query->result();   
                    }
                    
             
                }//ends if

                //check ex-serviceman
                if($ex_serviceman && empty($applicant_name) && empty($post_name) && empty($applicant_name))
                {
                    if(empty($ex_serviceman_basic_infom_idd))
                    {
                        $query = $this->db->query("SELECT * FROM tbl_app_job_bas_info WHERE id IN (SELECT id FROM tbl_app_job_bas_info WHERE FALSE)");
                        return $query->result(); 
                    }
                    else
                    {
                        $query = $this->db->query("SELECT *
                        FROM `tbl_app_job_bas_info`
                        WHERE `id` IN(".$ex_serviceman_basic_infom_idd.")
                        ORDER BY `id` DESC");
                        return $query->result();
                    }
                    
                }//ends if

                //check applicant name and post name
                if($applicant_name && $post_name && empty($caste_category) && empty($ex_serviceman))
                {
                    $query = $this->db->query("SELECT *
                    FROM `tbl_app_job_bas_info`
                    WHERE `applicant_id` IN(".$applicant_id.") AND `job_id` IN(".$post_name.")
                    ORDER BY `id` DESC");
                    return $query->result();
                }

                //check applicant name and post name and caste
                if($applicant_name && $post_name && $caste_category && empty($ex_serviceman))
                {
                    $query = $this->db->query("SELECT *
                    FROM `tbl_app_job_bas_info`
                    WHERE `applicant_id` IN(".$applicant_id.") AND `job_id` IN(".$post_name.")
                    AND `id` IN(".$caste_basic_infom_idd.")
                    ORDER BY `id` DESC");
                    return $query->result();
                }

                //check post name and caste
                if(empty($applicant_name) && $post_name && $caste_category && empty($ex_serviceman))
                {
                    $query = $this->db->query("SELECT *
                    FROM `tbl_app_job_bas_info`
                    WHERE `job_id` IN(".$post_name.") 
                    AND `id` IN(".$caste_basic_infom_idd.")
                    ORDER BY `id` DESC");
                    return $query->result();
                }

                //check post name and ex-serviceman
                if(empty($applicant_name) && $post_name && empty($caste_category) && $ex_serviceman)
                {
                   $query = $this->db->query("SELECT *
                    FROM `tbl_app_job_bas_info`
                    WHERE `job_id` IN(".$post_name.") 
                    AND `id` IN(".$ex_serviceman_basic_infom_idd.")
                    ORDER BY `id` DESC");
                    return $query->result();
                }

                //check caste and ex service man
                if(empty($applicant_name) && empty($post_name) && $caste_category && $ex_serviceman)
                {
                    $query = $this->db->query("SELECT *
                    FROM `tbl_app_job_bas_info`
                    WHERE `id` IN(".$caste_basic_infom_idd.")  AND `id` IN(".$ex_serviceman_basic_infom_idd.")
                    ORDER BY `id` DESC");
                    return $query->result();
                }

                //check exservice name and applicant name
                if($applicant_name && empty($post_name) && empty($caste_category) && $ex_serviceman)
                {
                    $query = $this->db->query("SELECT *
                    FROM `tbl_app_job_bas_info`
                    WHERE `applicant_id` IN(".$applicant_id.") AND `id` IN(".$ex_serviceman_basic_infom_idd.")
                    ORDER BY `id` DESC");
                    return $query->result();
                }

                else
                {
                    $query = $this->db->query("SELECT *
                    FROM `tbl_app_job_bas_info`
                    WHERE 1 
                    ORDER BY `id` DESC");
                    return $query->result();
                }

        /******ends final query*******/
    }//ends function

    /********function for search jobs*********/

    public function search_jobs($region_name,$circle_name,$post_name)
    {
        if($region_name && $circle_name && $post_name)
        {
          $query = $this->db->get_where('tbl_jobs', array('status'=>'1','job_status'=>'1','region_id'=>$region_name,'circle_id'=>$circle_name,'post_id'=>$post_name));
          return $query->result();
        }// ends if

        else
        {
            //check region name only
           if($region_name && empty($circle_name) && empty($post_name))
           {
                $query = $this->db->get_where('tbl_jobs', array('status'=>'1','job_status'=>'1','region_id'=>$region_name));
                return $query->result();
           }

           //check circle name
           if($circle_name && empty($region_name) && empty($post_name))
           {

            $query = $this->db->get_where('tbl_jobs', array('status'=>'1','job_status'=>'1','circle_id'=>$circle_name));
                return $query->result();
           }

           //check post name
           if($post_name && empty($circle_name) && empty($region_name))
           {
                $query = $this->db->get_where('tbl_jobs', array('status'=>'1','job_status'=>'1','post_id'=>$post_name));
                return $query->result();
           }

           //check region name and circle name

           if($region_name && $circle_name && empty($post_name))
           {
                $query = $this->db->get_where('tbl_jobs', array('status'=>'1','job_status'=>'1','region_id'=>$region_name,'circle_id'=>$circle_name));
                return $query->result();
           }

           //check circle name and post name

           if(empty($region_name) && $circle_name && $post_name)
           {
               $query = $this->db->get_where('tbl_jobs', array('status'=>'1','job_status'=>'1','circle_id'=>$circle_name,'post_id'=>$post_name));
               return $query->result();
           }

           //check region name and post name
           if($region_name && empty($circle_name) && $post_name)
           {
               $query = $this->db->get_where('tbl_jobs', array('status'=>'1','job_status'=>'1','region_id'=>$region_name,'post_id'=>$post_name));
               return $query->result();
           }

           else
           {
              $query = $this->db->get_where('tbl_jobs', array('status'=>'1','job_status'=>'1'));
              return $query->result();
           }
        }//ends else
    }// function ends
 
/**********function for search circular*******/

    public function search_circular($circular_title,$circle_name)
    {
        if($circular_title && $circle_name)
        {
            $this->db->select('*');
            $this->db->from('tbl_circular');
        
            if($circular_title)
            $this->db->like('circular_title', $circular_title);
            $this->db->order_by("id", "DESC");
            $query_circular = $this->db->get();
            $circular_data =  $query_circular->result();

            
            foreach ($circular_data as $circular) 
            {
                $circular_idd[] = $circular->id;
            }
            $circular_id = implode(',', $circular_idd);

            if(empty($circular_id))
            {
                $query = $this->db->query("SELECT *
                    FROM `tbl_circular`
                    WHERE circle_id  LIKE '%".$circle_name."%' ESCAPE '!' AND `status` = '1'
                    ORDER BY `id` DESC");

                 return $query->result();
            }

            else
            {
                 $query = $this->db->query("SELECT *
                    FROM `tbl_circular`
                    WHERE `id` IN(".$circular_id.")
                    AND  circle_id  LIKE '%".$circle_name."%' ESCAPE '!' AND `status` = '1'
                    ORDER BY `id` DESC");

                 return $query->result();
            }
           
        }// ends if

        else
        {
            
                $this->db->select('*');
                $this->db->from('tbl_circular');
            
                if($circular_title)
                $this->db->like('circular_title', $circular_title);
                $this->db->order_by("id", "DESC");
                $query_circular = $this->db->get();
                $circular_data =  $query_circular->result();

                foreach ($circular_data as $circular) 
                {
                    $circular_idd[] = $circular->id;
                }
                $circular_id = implode(',', $circular_idd);
               
                if(empty($circular_id))
                {
                   $circular_id = '';
                }

                else
                {
                    $circular_id = $circular_id;
                }

                //check circular title 
                if($circular_title && empty($circle_name))
                   {    
                        if(empty($circular_id))
                        {
                            $query = $this->db->query("SELECT * FROM `tbl_circular` WHERE  `status` = '1'");
                            return $query->result();
                        }

                        else
                        {
                            $query = $this->db->query("SELECT *
                            FROM `tbl_circular`
                            WHERE `id` IN(".$circular_id.") AND `status` = '1'
                            ORDER BY `id` DESC");
                            return $query->result(); 
                        }
                        
                   }//ends if

                   //check circle name
                   if($circle_name && empty($circular_title))
                   {
                     $query = $this->db->query("SELECT *
                     FROM `tbl_circular`
                     WHERE  circle_id  LIKE '%".$circle_name."%' ESCAPE '!' AND `status` = '1' 
                     ORDER BY `id` DESC");

                     return $query->result();
                   }
            
        }//ends else
    }// function ends

    /*****fucntion check applicant email******/

    public function check_applicant_query($email, $id)
    {
        $query = $this->db->query("SELECT * FROM `tbl_applicant` WHERE `email` = '".$email."' AND `id` != '".$id."' ");
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }// function ends

     /*****fucntion all active jobs******/

    public function all_active_jobs()
    {
        $query = $this->db->query("SELECT * FROM `tbl_jobs` Where CURDATE() >= `start_date` AND CURDATE() <= `end_date`");
        return $query->result();
    }// function ends


}//class ends