<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Name:  Twilio
	*
	* Author: Ben Edmunds
	*		  ben.edmunds@gmail.com
	*         @benedmunds
	*
	* Location:
	*
	* Created:  03.29.2011
	*
	* Description:  Twilio configuration settings.
	*
	*
	*/

	/**
	 * Mode ("sandbox" or "prod")
	 **/
	$config['mode']   = 'sandbox';

	/**
	 * Account SID
	 **/
	//$config['account_sid']   = 'AC4490bbe8ca89df86c060e2bb8f463899';
	$config['account_sid']   = 'ACb6c44d6d24facc33ed7bbd8614b73b2f';

	/**
	 * Auth Token
	 **/
	//$config['auth_token']    = '24e700134dd2efbee059d8c74dfdd9f9';
	$config['auth_token']    = '36ac01f406be5e506af14f8574211ff0';
	
	/**
	 * API Version
	 **/
	$config['api_version']   = '2010-04-01';

	/**
	 * Twilio Phone Number
	 **/
	//$config['number']        = '+14804053339';
	$config['number']        = '+12674364463';


/* End of file twilio.php */
