<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Croncontroller extends CI_Controller {

  
     function __construct()
	{
		parent::__construct();
		$this->load->model('Base_model');
	}


	public function index()
	{

		$query = $this->db->get('osr_item_master');

		foreach ($query->result() as $row) {
			
		     $this->db->insert('historical_item_master',$row);

		     $update_data = array(
				'adddaily_stock'      => '0',
				'approveddaily_stock' => '0',
				'issueddaily_stock'   => '0'
		   );

		   $this->Base_model->update_record_by_id('osr_item_master', $update_data, array('item_id'=>$row->item_id));

	    }

    }



} // end class

