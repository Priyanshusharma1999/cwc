<?php

error_reporting(0);

defined('BASEPATH') OR exit('No direct script access allowed');

class Mainadmin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/dashboard');
	
	}
	
	public function addregion()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/masterdata/addregion');
	}
	
	public function addcircle()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/masterdata/addcircle');
	}
	
	public function addpost()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/masterdata/addpost');
	}
	
	
	public function addusers()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/users/addregionalofficers');
	}
	
	
	public function userslist()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/users/regionalofficerslist');
	}
	
	public function applicantlist()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/applicants/applicantslist');
	}
	
	
	public function sendbulksms()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/applicants/bulksms');
	}
	
	
	public function addjob()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/jobs/addjobs');
	}
	
	
	
	public function joblist()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/jobs/joblist');
	}
	
	
	public function addcircular()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/jobs/addcirculars');
	}
	
	
	
	public function circularlist()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/jobs/circularlist');
	}
	
	
	public function profile()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/profile');
	}
	
	public function editprofile()
	{
		$this->load->helper('url');
		$this->load->view('mainadmin/editprofile');
	}
	
}
