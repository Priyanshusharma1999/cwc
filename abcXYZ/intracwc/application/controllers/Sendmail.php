<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sendmail extends CI_Controller {


     function __construct()
    {
            parent::__construct();
           $this->load->library('email');
            
    }


    public function index()
    {   

       $config = array(
            'protocol' => 'smtp',
            'smtp_host' => '164.100.14.95',
            'smtp_port' => '25'
        );   

        $this->email->initialize($config);

        $this->email->from('support-intracwc@gov.in');
        $this->email->to('akhil-cwc@nic.in'); 

        $this->email->subject('Email Test');
        $this->email->message('Testing the email class.');  

       if ($this->email->send()) {
        echo 'Your email was sent, thanks.';
        } else {
            show_error($this->email->print_debugger());
        }

    }

    
}




