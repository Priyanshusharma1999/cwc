<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stationary_model extends CI_Model
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

   
   public function check_existent_item($item_name, $id)
    {

         $this->db->select('*');
	     $this->db->from('osr_item_master');
	     $this->db->where(array('item_name'=>$item_name, 'item_id !='=>$id, 'delete_status' =>0));

	      $query = $this->db->get();
		
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
	
	public function check_existent_bill($billno, $id)
    {

         $this->db->select('*');
	     $this->db->from('osr_bill_master');
	     $this->db->where(array('bill_no'=>$billno, 'delete_status' =>0));

	      $query = $this->db->get();
		
        if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
	
	
	 /**********function for search Item*******/

    public function search_item($item_name,$category,$subcategory)
    {

    	if($this->uri->segment('1') == 'onlinestationary'){

    		$service_type = 2;

    	} else {

    		$service_type = 1;

    	}

        if($item_name && $category && $subcategory)
        {
          
		    $this->db->select('*');
			$this->db->from('osr_item_master');
			$this->db->where(array('status'=>1,'delete_status' => 0,'category_id'=>$category,'subcategory_id'=>$subcategory,'service_type='=>$service_type));
			$this->db->like('item_name', $item_name);
			$this->db->order_by("item_id", "ASC");
			$query = $this->db->get();
			return $query->result();
		  
        } else if($item_name &&  empty($category) && empty($subcategory)){

        	$this->db->select('*');
			$this->db->from('osr_item_master');
			$this->db->where(array('status'=>1,'delete_status' => 0,'service_type='=>$service_type));
			$this->db->like('item_name', $item_name);
			$this->db->order_by("item_id", "ASC");
			$query = $this->db->get();
			return $query->result();


        } else if(empty($item_name) &&  $category && empty($subcategory)){

           $this->db->select('*');
		   $this->db->from('osr_item_master');
		   $this->db->where(array('status'=>1,'delete_status' => 0,'category_id'=>$category,'service_type='=>$service_type));
		  $this->db->order_by("item_id", "ASC");
		   $query = $this->db->get();
		   return $query->result();

        	
       } else if(empty($item_name) &&  empty($category) && $subcategory){

        $this->db->select('*');
		$this->db->from('osr_item_master');
		$this->db->where(array('status'=>1,'delete_status' => 0,'subcategory_id'=>$subcategory,'service_type='=>$service_type));
		$this->db->order_by("item_id", "ASC");
		$query = $this->db->get();
		return $query->result();

        	
      } else if($item_name &&  $category && empty($subcategory)){

         $this->db->select('*');
		 $this->db->from('osr_item_master');
		 $this->db->where(array('status'=>1,'delete_status' => 0,'category_id'=>$category,'service_type='=>$service_type));
		 $this->db->like('item_name', $item_name);
		 $this->db->order_by("item_id", "ASC");
		 $query = $this->db->get();
		 return $query->result();
        	
      } else if($item_name &&  empty($category) && $subcategory){

      	  $this->db->select('*');
		  $this->db->from('osr_item_master');
		  $this->db->where(array('status'=>1,'delete_status' => 0,'subcategory_id'=>$subcategory,'service_type='=>$service_type));
		  $this->db->like('item_name', $item_name);
		  $this->db->order_by("item_id", "ASC");
		  $query = $this->db->get();
		  return $query->result();

        	
        } else if(empty($item_name) &&  $category && $subcategory){

        	$this->db->select('*');
			$this->db->from('osr_item_master');
			$this->db->where(array('status'=>1,'delete_status' => 0,'category_id'=>$category,'subcategory_id'=>$subcategory,'service_type='=>$service_type));
			$this->db->order_by("item_id", "ASC");
			$query = $this->db->get();
			return $query->result();
        	
        } else {
				 
				$this->db->select('*');
				$this->db->from('osr_item_master');
				$this->db->where(array('status'=>1,'delete_status' => 0,'service_type='=>$service_type));
				$this->db->order_by("item_id", "ASC");
				$query = $this->db->get();
				return $query->result();
				 
		 }
       
    }// function ends
	


	public function search_category($category_name)
    {

    	if($this->uri->segment('1') == 'onlinestationary'){

    		$service_type = 2;

    	} else {

    		$service_type = 1;

    	}

        if($category_name)
        {
          
		    $this->db->select('*');
			$this->db->from('category');
			$this->db->where(array('delete_status' => 1,'service_type='=>$service_type));
			$this->db->like('category_name', $category_name);
			$this->db->order_by("category_id", "ASC");
			$query = $this->db->get();
			return $query->result();
		  
        } else {
				 
				$this->db->select('*');
				$this->db->from('category');
				$this->db->where(array('delete_status' => 1,'service_type='=>$service_type));
				$this->db->order_by("category_id", "ASC");
				$query = $this->db->get();
				return $query->result();
				 
		 }
       
    }// function ends


    public function search_subcategory($subcategory_name)
    {

    	if($this->uri->segment('1') == 'onlinestationary'){

    		$service_type = 2;

    	} else {

    		$service_type = 1;

    	}

        if($subcategory_name)
        {
          
		    $this->db->select('*');
			$this->db->from('sub_category');
			$this->db->where(array('delete_status' => 1,'service_type='=>$service_type));
			$this->db->like('subcat_name', $subcategory_name);
			$this->db->order_by("subcat_id", "ASC");
			$query = $this->db->get();
			return $query->result();
		  
        } else {
				 
				$this->db->select('*');
				$this->db->from('sub_category');
				$this->db->where(array('delete_status' => 1,'service_type='=>$service_type));
				$this->db->order_by("subcat_id", "ASC");
				$query = $this->db->get();
				return $query->result();
				 
		 }
       
    }// function ends
	
	
	 /**********function for search Requisition*******/

    public function search_requisition($status)
    {

    	if($this->uri->segment('1') == 'onlinestationary'){

    		$service_type = 2;

    	} else {

    		$service_type = 1;

    	}


        if($status)
        {
          
		    $this->db->select('*');
			$this->db->from('osr_requisition_master');
			$this->db->where(array('delete_status' => 0,'status'=>$status,'service_type'=>$service_type,'user_id'=>$this->session->userdata('user_id')));
			$this->db->order_by("req_id", "ASC");
			$query = $this->db->get();
			return $query->result();
		  
        } else {
				 
				$this->db->select('*');
				$this->db->from('osr_requisition_master');
				$this->db->where(array('delete_status' => 0,'service_type'=>$service_type,'user_id'=>$this->session->userdata('user_id')));
				$this->db->order_by("req_id", "ASC");
				$query = $this->db->get();
				return $query->result();
				 
		 }
       
    }// function ends
	
	
	 /**********function for search Proxylist*******/

    public function search_proxy($status)
    {

       

    	if($this->uri->segment('1') == 'onlinestationary'){

    		$service_type = 2;

    	} else {

    		$service_type = 1;

    	}



        if($status)
        {
          
		  $id = $this->session->userdata('user_id');

         $this->db->select('*');
	     $this->db->from('osr_requisition_master');
	     $this->db->where(array('user_id !='=>$id, 'delete_status' =>0,'status'=>$status,'service_type'=>$service_type));
	     $this->db->order_by('req_id','ASC');
	     $query = $this->db->get();
		
		  return $query->result();
		  
        } else {
				 
		  $id = $this->session->userdata('user_id');

	     $this->db->select('*');
	     $this->db->from('osr_requisition_master');
	     $this->db->where(array('user_id !='=>$id, 'delete_status' =>0,'service_type'=>$service_type));
	     $this->db->order_by('req_id','ASC');
	     $query = $this->db->get();
		
		  return $query->result();
				 
		 }
       
    }// function ends
	
	
	public function get_item_by_name($itemname){
		
		    $this->db->select('item_id');
			$this->db->from('osr_item_master');
			$this->db->where(array('delete_status' => 0));
			$this->db->like('item_name', $itemname);
			$query = $this->db->get();
			return $query->result();
		
	}
	
	
	public function search_request($status,$from_date,$to_date)
    {

    	if($from_date=='1970-01-01')
		{
			$from_date='';
		}
		
		if($to_date=='1970-01-01')
		{
			$to_date='';
		}

		if($this->uri->segment('1') == 'onlinestationary'){

    		$service_type = 2;

    	} else {

    		$service_type = 1;

    	}
		
		 if($status && $from_date && $to_date)
		 {
			 $this->db->select('*');
		     $this->db->from('osr_requisition_master');
		     $this->db->where(array('delete_status' =>0,'req_date >='=>$from_date,'req_date <='=>$to_date,'status'=>$status,'service_type'=>$service_type));
		     $this->db->order_by('req_id','ASC');
		     $query = $this->db->get();
		  
			return $query->result();
				
		  } else {
	  
		      if($status &&  empty($from_date) && empty($to_date)){

				 $this->db->select('*');
			     $this->db->from('osr_requisition_master');
			     $this->db->where(array('delete_status' =>0,'status'=>$status,'service_type'=>$service_type));
			     $this->db->order_by('req_id','ASC');
			     $query = $this->db->get();
				  
			     return $query->result();
					   
		      } else if(empty($status) && $from_date && empty($to_date)){

						 $this->db->select('*');
					     $this->db->from('osr_requisition_master');
					     $this->db->where(array('req_date >='=>$from_date,'service_type'=>$service_type));
					     $this->db->order_by('req_id','ASC');
					     $query = $this->db->get();
		  
					   return $query->result();
					   
				} else if(empty($status) && empty($from_date) && $to_date){

					     $this->db->select('*');
					     $this->db->from('osr_requisition_master');
					     $this->db->where(array('req_date <='=>$to_date,'service_type'=>$service_type));
					     $this->db->order_by('req_id','ASC');
					     $query = $this->db->get();
		  
					   return $query->result();
					   
				 } else if($status && $from_date && empty($to_date)){
		  
		                 $this->db->select('*');
					     $this->db->from('osr_requisition_master');
					     $this->db->where(array('req_date >='=>$from_date,'delete_status' => 0,'status'=>$status,'service_type'=>$service_type));
					     $this->db->order_by('req_id','ASC');
					     $query = $this->db->get();
		  
					   return $query->result();
					   
				   } else if($status && empty($from_date) && $to_date){

					  $this->db->select('*');
				      $this->db->from('osr_requisition_master');
				      $this->db->where(array('req_date <='=>$to_date,'delete_status' => 0,'status'=>$status,'service_type'=>$service_type));
				      $this->db->order_by('req_id','ASC');
				      $query = $this->db->get();
		  
					   return $query->result();
					   
				} else if(empty($status) && $from_date && $to_date){

				   $this->db->select('*');
				   $this->db->from('osr_requisition_master');
				   $this->db->where(array('req_date >='=>$from_date,'req_date<=' => $to_date,'service_type'=>$service_type));
				   $this->db->order_by('req_id','ASC');
				   $query = $this->db->get();
		  
				   return $query->result();
					   
			 } else {
					 
						$this->db->select('*');
						$this->db->from('osr_requisition_master');
						$this->db->where(array('delete_status' => 0,'service_type'=>$service_type));
						$this->db->order_by("req_id", "ASC");
						$query = $this->db->get();
						return $query->result();
					   
			}
				 
		 }
       
    }// function ends


		public function search_physicalissue($status,$from_date,$to_date){

               if($from_date=='1970-01-01')
				{
					$from_date='';
				}
				
				if($to_date=='1970-01-01')
				{
					$to_date='';
				}

				if($this->uri->segment('1') == 'onlinestationary'){

		    		$service_type = 2;

		    	} else {

		    		$service_type = 1;

		    	}
				
				 if($status && $from_date && $to_date)
				 {

				   $this->db->select('*');
				   $this->db->from('osr_requisition_master');
				   $this->db->where(array('delete_status'=>0,'status' => $status,'req_date >='=>$from_date,'req_date<=' => $to_date,'service_type'=>$service_type));
				   $this->db->order_by('req_id','ASC');
				   $query = $this->db->get();
		  
				  
					return $query->result();
						
				  } else {
	  
				   if($status &&  empty($from_date) && empty($to_date)){

					   $this->db->select('*');
					   $this->db->from('osr_requisition_master');
					   $this->db->where(array('delete_status'=>0,'status' => $status,'service_type'=>$service_type));
					   $this->db->order_by('req_id','ASC');
					   $query = $this->db->get();
		  
		  
					   return $query->result();
					   
				   } else if(empty($status) && $from_date && empty($to_date)){

					   $this->db->select('*');
					   $this->db->from('osr_requisition_master');
					   $this->db->where(array('req_date >='=>$from_date,'service_type'=>$service_type));
					   $this->db->order_by('req_id','ASC');
					   $query = $this->db->get();
		  
		  
					   return $query->result();
					   
				   } else if(empty($status) && empty($from_date) && $to_date){

					   $this->db->select('*');
					   $this->db->from('osr_requisition_master');
					    $this->db->where(array('req_date<=' => $to_date,'service_type'=>$service_type));
					   $this->db->order_by('req_id','ASC');
					   $query = $this->db->get();
		  
		  
					   return $query->result();
					   
				   } else if($status && $from_date && empty($to_date)){

				   $this->db->select('*');
				   $this->db->from('osr_requisition_master');
				    $this->db->where(array('delete_status'=>0,'status' => $status,'req_date>=' => $from_date,'service_type'=>$service_type));
				   $this->db->order_by('req_id','ASC');

				   $query = $this->db->get();
		  
		  
					   return $query->result();
					   
				   } else if($status && empty($from_date) && $to_date){


				   $this->db->select('*');
				   $this->db->from('osr_requisition_master');
				   $this->db->where(array('delete_status'=>0,'status' => $status,'req_date<=' => $to_date,'service_type'=>$service_type));
				   $this->db->order_by('req_id','ASC');
				   $query = $this->db->get();
		  
		  
					   return $query->result();
					   
				   } else if(empty($status) && $from_date && $to_date){

				   $this->db->select('*');
				   $this->db->from('osr_requisition_master');
				   $this->db->where(array('req_date >='=>$from_date,'req_date<=' => $to_date,'service_type'=>$service_type));
				   $this->db->order_by('req_id','ASC');
				   $query = $this->db->get();
		  
		  
					   return $query->result();
					   
				   } else {
					 
						$this->db->select('*');
						$this->db->from('osr_requisition_master');
						$this->db->where(array('delete_status' => 0,'service_type'=>$service_type));
						$this->db->order_by("req_id", "ASC");
						$query = $this->db->get();
						return $query->result();
					   
				   }
				 
		   }

		}
			
	
	 /**********function for search Bill*******/

    public function search_bill($from_date, $to_date)
    {
		
		if($from_date=='1970-01-01')
		{
			$from_date='';
		}
		
		if($to_date=='1970-01-01')
		{
			$to_date='';
		}

		if($this->uri->segment('1') == 'onlinestationary'){

    		$service_type = 2;

    	} else {

    		$service_type = 1;

    	}

		
        if($from_date && $to_date)
        {

		 $this->db->select('*');
	     $this->db->from('osr_bill_master');
	     $this->db->where(array('bill_date >='=>$from_date,'bill_date <='=>$to_date,'service_type'=>$service_type));
	     $this->db->order_by('bill_master_id','ASC');
	     $query = $this->db->get();
		
		 return $query->result();
		  
        } else {
			
			if($from_date && empty($to_date)){

		 $this->db->select('*');
	     $this->db->from('osr_bill_master');
	     $this->db->where(array('bill_date >='=>$from_date,'service_type'=>$service_type));
	     $this->db->order_by('bill_master_id','ASC');
	     $query = $this->db->get();
		
		 return $query->result();
				
		} else if(empty($from_date) && $to_date){

		 $this->db->select('*');
	     $this->db->from('osr_bill_master');
	     $this->db->where(array('bill_date <='=>$to_date,'service_type'=>$service_type));
	     $this->db->order_by('bill_master_id','ASC');
	     $query = $this->db->get();
				
	            return $query->result();
				
			} else {
				
				$this->db->select('*');
				$this->db->from('osr_bill_master');
				$this->db->where(array('status'=>1, 'delete_status' => 0,'service_type'=>2));
				$this->db->order_by("bill_master_id", "ASC");
				$query = $this->db->get();
				return $query->result();
				
			} 
		 } 
       
    }// function ends
	
	
	public function get_proxylist(){
		
		$id = $this->session->userdata('user_id');

		if($this->uri->segment('1') == 'onlinestationary'){

    		$service_type = 2;

    	} else {

    		$service_type = 1;

    	}


	     $this->db->select('*');
	     $this->db->from('osr_requisition_master');
	     $this->db->where(array('user_id !='=>$id,'service_type'=>$service_type,'is_proxy'=>'1'));
	     $this->db->order_by('req_id','ASC');
	     $query = $this->db->get();
	   
		 return $query->result();

	}
	
	public function get_proxyusers(){
		
		$id = $this->session->userdata('user_id');

	     $this->db->select('*');
	     $this->db->from('users');
	     $this->db->where(array('user_id !='=>$id));
	     $this->db->order_by('user_id','ASC');
	     $query = $this->db->get();
	   
		 return $query->result();
	}


	

	public function check_requisition(){
		
		$id = $this->session->userdata('user_id');

		if($this->uri->segment('1') == 'onlinestationary'){

    		$service_type = 2;

    	} else {

    		$service_type = 1;

    	}

	    $this->db->select('*');
	    $this->db->from('osr_requisition_master');
	    $this->db->where(array('user_id'=>$id, 'delete_status' =>'0', 'status'=>'Pending', 'service_type'=>$service_type));
	     
	     $query = $this->db->get();
	
		if ($query->num_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
	}
	
	
	
	 public function search_complain($category,$status)
    {

      if($this->uri->segment('1') == 'itcomplaint'){

    		$service_type = 1;

    	} else {

    		$service_type = 2;

    	}

        if($category && $status)
        {
          
	     $this->db->select('*');
	     $this->db->from('complaint');
	     $this->db->where(array('complaint_type_id'=>$category, 'delete_status' =>1,'status'=>$status,'service_type'=>$service_type));
	     $this->db->order_by('complaint_id','ASC');
	     $query = $this->db->get();
		
		  return $query->result();
		  
        } else {
			
			if($category && empty($status)){

				 $this->db->select('*');
			     $this->db->from('complaint');
			     $this->db->where(array('delete_status' =>1,'complaint_type_id'=>$category,'service_type'=>$service_type));
			     $this->db->order_by('complaint_id','ASC');
			     $query = $this->db->get();
		
		
				return $query->result();
				
			} else if($status && empty($category)){

				 $this->db->select('*');
			     $this->db->from('complaint');
			     $this->db->where(array('delete_status' =>1,'status'=>$status,'service_type'=>$service_type));
			     $this->db->order_by('complaint_id','ASC');
			     $query = $this->db->get();
		
				return $query->result();
				
			} else {

				$this->db->select('*');
			     $this->db->from('complaint');
			     $this->db->where(array('delete_status' =>1,'service_type'=>$service_type));
			     $this->db->order_by('complaint_id','ASC');
			     $query = $this->db->get();
		
				return $query->result();
				
			}
				 
		 }
       
    }// function ends


  public function getitemreport(){

  	$this->db->select('item_id');
	$this->db->distinct();
	$query = $this->db->get('osr_requisition_item');
	return $query->result();

  }

  public function getsearchitemreport($reqid){

	  	if(!empty($reqid)){

	  		$this->db->select('item_id');
			$this->db->distinct();
			$this->db->where_in('req_id', $reqid);
			$query = $this->db->get('osr_requisition_item');
			return $query->result();

	  	} else {

	  		$this->db->select('item_id');
			$this->db->distinct();
			$query = $this->db->get('osr_requisition_item');
			return $query->result();

	  	}

  }
  
	


	public function item_history($item_name,$from_date,$to_date)
    {

    	if($from_date=='1970-01-01')
		{
			$from_date='';
		}
		
		if($to_date=='1970-01-01')
		{
			$to_date='';
		}

		if($this->uri->segment('1') == 'onlinestationary'){

    		$service_type = 2;

    	} else {

    		$service_type = 1;

    	}
		
		 if($item_name && $from_date && $to_date)
		 {
			 $this->db->select('*');
		     $this->db->from('historical_item_master');
		     $this->db->where(array('delete_status' =>0,'cronjob_date >='=>$from_date,'cronjob_date <='=>$to_date,'status'=>'1','service_type'=>$service_type));
		     $this->db->like('item_name', $item_name);
		     $query = $this->db->get();
		  
			 return $query->result();
				
		  } else {
	  
		      if($item_name && empty($from_date) && empty($to_date)){

				 $this->db->select('*');
			     $this->db->from('historical_item_master');
			     $this->db->where(array('delete_status' =>0,'status'=>'1','service_type'=>$service_type));
			     $this->db->like('item_name', $item_name);
			     $query = $this->db->get();
				return $query->result();
					   
		      } else if($item_name &&  $from_date && empty($to_date)){

						 $this->db->select('*');
					     $this->db->from('historical_item_master');
					     $this->db->where(array('delete_status' =>0,'cronjob_date >='=>$from_date,'status'=>'1','service_type'=>$service_type));
					     $this->db->like('item_name', $item_name);
					     $query = $this->db->get();
					  
						 return $query->result();
					   
				} else if($item_name && empty($from_date) && $to_date){

					     $this->db->select('*');
					     $this->db->from('historical_item_master');
					     $this->db->where(array('delete_status' =>0,'cronjob_date <='=>$to_date,'status'=>'1','service_type'=>$service_type));
					     $this->db->like('item_name', $item_name);
					     $query = $this->db->get();
					  
						 return $query->result();
					   
				} else if(empty($item_name) && empty($from_date) && $to_date){

					     $this->db->select('*');
					     $this->db->from('historical_item_master');
					     $this->db->where(array('delete_status' =>0,'cronjob_date <='=>$to_date,'status'=>'1','service_type'=>$service_type));
					     $query = $this->db->get();
					  
						 return $query->result();
					   
				} else if(empty($item_name) && $from_date && $to_date){

					     $this->db->select('*');
					     $this->db->from('historical_item_master');
					     $this->db->where(array('delete_status' =>0,'cronjob_date >='=>$from_date,'cronjob_date <='=>$to_date,'status'=>'1','service_type'=>$service_type));
					     $query = $this->db->get();
					  
						 return $query->result();
					   
				} else if(empty($item_name) && $from_date && empty($to_date)){

					     $this->db->select('*');
					     $this->db->from('historical_item_master');
					     $this->db->where(array('delete_status' =>0,'cronjob_date >='=>$from_date,'status'=>'1','service_type'=>$service_type));
					     $query = $this->db->get();
					  
						 return $query->result();
					   
				} else {

					     $this->db->select('*');
					     $this->db->from('historical_item_master');
					     $this->db->where(array('delete_status' =>0,'status'=>'1','service_type'=>$service_type));
					     $query = $this->db->get();
					  
						 return $query->result();
					   
				} 
				 
		 }
       
    }// function ends



	
}//class ends