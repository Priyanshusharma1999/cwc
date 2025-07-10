<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//require APPPATH . '/libraries/mpdf.php';
class Test_sms extends CI_Controller {

	// Initialize Constructor Here
	function __construct()
	{
			parent::__construct();
			$this->load->model('Base_model');
			$this->load->library("Pdf");
			
		
	}

	public function send_sms()
	{
    if (stripos($_SERVER["REQUEST_URI"], '') )
{
  echo 'aaaaaaaaaa';exit;
}

   

   

		$otp = rand(1000,9999);
        $this->load->library('twilio');
        $res = $this->twilio->sms('+12674364463', '+91'.'8447414004', 'Your OTP is: '.$otp);
        if($res==1)
        {
        	echo "mmm";exit;
        }

        else
        {
        	echo "ddsfsd";exit;
        }
	}

  public function create22_pdf() {

    $data['full_name'] = 'ahaa';
    $this->load->view('pdf',$data);
  }


	 public function create_pdf() {
    //============================================================+
    // File name   : example_001.php
    //
    // Description : Example 001 for TCPDF class
    //               Default Header and Footer
    //
    // Author: Muhammad Saqlain Arif
    //
    // (c) Copyright:
    //               Muhammad Saqlain Arif
    //               PHP Latest Tutorials
    //               http://www.phplatesttutorials.com/
    //               saqlain.sial@gmail.com
    //============================================================+
 
   
  
    // create new PDF document
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    
  
    // set document information
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Muhammad Saqlain Arif');
    $pdf->SetTitle('TCPDF Example 001');
    $pdf->SetSubject('TCPDF Tutorial');
    $pdf->SetKeywords('TCPDF, PDF, example, test, guide');   
  
    // set default header data
    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,'', '', array(0,64,255), array(0,64,128));
    $pdf->setFooterData(array(0,64,0), array(0,64,128)); 
  
    // set header and footer fonts
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
  
    // set default monospaced font
    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED); 
  
    // set margins
    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);    
  
    // set auto page breaks
    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM); 
  
    // set image scale factor
    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);  
  
    // set some language-dependent strings (optional)
    if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
        require_once(dirname(__FILE__).'/lang/eng.php');
        $pdf->setLanguageArray($l);
    }   
  
    // ---------------------------------------------------------    
  
    // set default font subsetting mode
    $pdf->setFontSubsetting(true);   
  
    // Set font
    // dejavusans is a UTF-8 Unicode font, if you only need to
    // print standard ASCII chars, you can use core fonts like
    // helvetica or times to reduce file size.
    $pdf->SetFont('dejavusans', '', 14, '', true);   
  
    // Add a page
    // This method has several options, check the source code documentation for more information.
    $pdf->AddPage(); 
  
    // set text shadow effect
    $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));    
    //$user_data = $this->Base_model->get_allrecord_withjoin_partner();   

    // Set some content to print
    $html = $html = '<table>
           <tr>
              <th>Partner Name</th>
              <th>Partner Id</th>
              <th>Email Id</th>
              <th>Mobile No.</th>
              <th>Last login Time</th>
              <th>Status</th>
              
              
           </tr>';
 
   
    //print_r($row);exit;
     $html .= '<tr>
                  <td>'.'dddd'.'</td>
                  <td>'.'4521'.'</td>
                  <td>'.'asdh@hh.com'.'</td>
                  <td>'.'9988774455'.'</td>
                  <td>'.'3 dayys ago'.'</td>
                    <td>'.'Never login'.'</td>
                  
                  
                   
               </tr>';
  
  $html .= '</table>';
  
 
    // Print text using writeHTMLCell()
    $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);   
     
    // ---------------------------------------------------------  
  
   //$pdf->Output('C:/xampp/htdocs/centralgov/uploads/'.'mmkkkmkmkmkmk'.'.pdf','D');
    // Close and output PDF document
    // This method has several options, check the source code documentation for more information.
    // $pdf->Output('report.pdf', 'I'); 
    $pdf->WriteHTML($html);
      ob_clean(); 
      //$mpdf->Output();
      $pdf->Output('D:/xampp/htdocs/centralgov/uploads/'.'bbb'.'.pdf','F');
     
  
    //============================================================+
    // END OF FILE
    //============================================================+
    }

    public function print_generateSavePdf()
  {
 	///$this->load->library('mpdf');
    $data['pdf_name'] = 'sss';
    $this->load->view('pdf',$data);
  }
	


}//class ends
