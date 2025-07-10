<?php
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');

class Encrypt extends CI_Controller {

	/**
	 * Index Page for this controller.

	 */
	 
	 
	function __construct()
	{
			parent::__construct();
			$this->load->model('Base_model');
			
		 
	}
	 
	public function index()
	{
	
	}

	//function for encrypted text

	public function encrypt_text()
	{
		$password = $this->input->post('password');
		
		$string = $password;
        $output = false;
 
        $encrypt_method = "AES-256-CBC";
        $secret_key = 'hsdd67466437hdjd874783';
        $secret_iv = 'nsjjhsdjh7674747hdbd787';

        $key = hash('sha256', $secret_key);
        $iv = substr(hash('sha256', $secret_iv), 0, 16);
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
        $encrypted_output =  json_encode($output);
		echo  $encrypted_output;
	}// ends function
	
	
	
}
