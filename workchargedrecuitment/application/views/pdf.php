<?php
  /*************PDF Code***************/


                             // create new PDF document
                            $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);    
                          
                            // set document information
                            $pdf->SetCreator(PDF_CREATOR);
                            $pdf->SetAuthor('Muhammad Saqlain Arif');
                            $pdf->SetTitle('');
                            $pdf->SetSubject('TCPDF Tutorial');
                            $pdf->SetKeywords('TCPDF, PDF, example, test, guide');   
                          
                            // set default header data
                            //$title = 'Central Water Commission';
                            //$title="My Heading"
                            $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH,PDF_HEADER_TITLE.$title,'', '', array(0,64,100), array(0,64,100));
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
                            $pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(255,255,255), 'opacity'=>1, 'blend_mode'=>'Normal'));    
                            //$user_data = $this->Base_model->get_allrecord_withjoin_partner();   

                            // Set some content to print

                            if($all_job_data[0]->pending_status== 0)
                            {
                                $jobb_status = 'Incomplete';
                                $application_label = 'Last Modified:';
                            }

                            else
                            {
                              $jobb_status = 'Application submitted successfully';
                               $application_label = 'Submitted Date:';
                            }

                            $last_modify_date = date('d F, Y h:i A', strtotime($all_job_data[0]->updated_date));
                            $html .= '<div id="content">
                        
                            <h3 style="text-align: center;margin-bottom:50px;margin-top:0px;color:#0f4c9f;
                            font-size: 22px;">Application Form</h3>

                             <table class="table">
                              <tr>
                                  <td><span style="font-size:14px;">Application Form No: '.$all_job_data[0]->basic_info_id.'</span></td>
                                   <td></td>
                                  <td>
                                      <img src="'.$upload_photo.'" width="120" height="80" >
                                  </td>
                              </tr>

                               <tr>
                                  <td><span style="font-size:14px;">Application Status:</span></td>
                                   <td></td>
                                  <td>
                                      <td><span style="font-size:14px;">'.$jobb_status.'</span></td>
                                  </td>
                              </tr>

                              <tr>
                                  <td><span style="font-size:14px;">'.$application_label.'</span></td>
                                   <td></td>
                                  <td>
                                      <td><span style="font-size:14px;">'.$last_modify_date.'</span></td>
                                  </td>
                              </tr>
                            </table>


<h3 style="text-align: left;margin-bottom: 20px;margin-top:0px;background: #0f4c9f;color: #0f4c9f;
padding: 5px 15px;font-size: 18px;">Applied Post Details </h3>

<table class="table">
<tr>
    <td><label style="font-size:13px;">Preferred Region:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;">'. $region_data->region_name.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Circle Office:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;">'.$circle_data->circle_name.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Skilled Applied For:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$job_data->job_title.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Post :</label></td>
   <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$post_data->post_name.'-'.$post_data->post_code.'</span>
    </td>
</tr>

</table>



<h3 style="text-align: left;margin-bottom: 20px;margin-top:0px;background: #0f4c9f;color: #0f4c9f;
padding: 5px 15px;font-size: 18px;">Personal Details</h3>

<table class="table">
<tr>
    <td><label style="font-size:13px;">Full Name:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->full_name.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Father'."'s".' Name:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->father_name.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Email Id:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->email.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Mobile No:</label></td>
   <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->mobile_no.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Date Of Birth:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->dob.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Gender:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->gender.'</span>
    </td>
</tr>

</table>



<h3 style="text-align: left;margin-bottom: 20px;margin-top:0px;background: #0f4c9f;color: #0f4c9f;
padding: 5px 15px;font-size: 18px;">Qualification Details</h3>

<table  style="width:100%;border:1px solid #333;">
<thead>
  <tr>
  <th style="border:1px solid #333;"><label style="font-size:13px;">Qualification</label></th>
  <th style="border:1px solid #333;"><label style="font-size:13px;">Board/College</label></th>
  <th style="border:1px solid #333;"><label style="font-size:13px;">Passing Year</label></th>
  <th style="border:1px solid #333;"><label style="font-size:13px;">Total Marks</label></th>
  <th style="border:1px solid #333;"><label style="font-size:13px;">Marks Obtained</label></th>
  <th style="border:1px solid #333;"><label style="font-size:13px;">Percentage</label></th>
  </tr>
</thead>
<tbody>
<tr style="border-bottom:1px solid #333;">
    <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->highschool_metriculation.'</span>
    </td>
   <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->highschool_board_name.' 
      </span>
    </td>
    <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->highschool_passing_year.'</span>
    </td>
    <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->highschool_total_marks.'</span>
    </td>
    <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->highschool_marks_obtained.'</span>
    </td>
    <td style="border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->highschool_percentage.'</span>
    </td>

  </tr>  

  <tr style="border-bottom:1px solid #333;">
    <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">Others</span>
    </td>
   <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->graduation_board_name.'</span>
    </td>
    <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->graduation_passing_year.'</span>
    </td>
    <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->graduation_total_marks.'</span>
    </td>
    <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->graduation_marks_obtained.'</span>
    </td>
    <td style="border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->graduation_percentage.'</span>
    </td>

</tr>

<tr style="border-bottom:1px solid #333;">

    <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">Others</span>
    </td>
   <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->post_graduation_board_name.'</span>
    </td>
    <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->post_graduation_passing_year.'</span>
    </td>
    <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->post_graduation_total_marks.'</span>
    </td>
    <td style="border-right:1px solid #333;border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->post_graduation_marks_obtained.'</span>
    </td>
    <td style="border-bottom:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->post_graduation_percentage.'</span>
    </td>

</tr>

<tr style="border-bottom:1px solid #333;">


    <td style="border-right:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">Others</span>
    </td>
   <td style="border-right:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->others_board_name.'</span>
    </td>
    <td style="border-right:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->others_passing_year.'</span>
    </td>
    <td style="border-right:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->others_total_marks.'</span>
    </td>
    <td style="border-right:1px solid #333;">
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->others_marks_obtained.'</span>
    </td>
    <td>
      <span style="border:2px solid #0f4c9f;padding:5px 12px;font-size:12px;font-weight:600;">'.$all_job_data[0]->others_percentage.'</span>
    </td>



</tr>
</tbody>
</table>



<h3 style="text-align: left;margin-bottom: 20px;margin-top:0px;background: #0f4c9f;color: #0f4c9f;
padding: 5px 15px;font-size: 18px;">Other Details</h3>

<table class="table">
<tr>
    <td><label style="font-size:13px;">Category:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->caste_category.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Religion:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->religion.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Marital Status:</label></td>
   <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->marital_status.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Nationality:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->nationality.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Aadhar No:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->adhar_enc.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Ex-Serviceman:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->ex_serviceman.'</span>
    </td>
</tr>


<tr>
    <td><label style="font-size:13px;">Eligibility of physical fitness criteria?:</label></td>
   <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->physical_fitness.'</span>
    </td>
</tr>



<tr>
    <td><label style="font-size:13px;">Employment Exchange Registration No & Place:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->employment_exchange_reg_no.'</span>
    </td>
</tr>


<tr>
    <td><label style="font-size:13px;">Physically Handicapped:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->physically_handicapp.'</span>
    </td>
</tr>


<tr>
    <td><label style="font-size:13px;">Present Address:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->present_address.'</span>
    </td>
</tr>



<tr>
    <td><label style="font-size:13px;">State:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$present_state->StateName_In_English.'</span>
    </td>
</tr>


<tr>
    <td><label style="font-size:13px;">City:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->present_address_city.'</span>
    </td>
</tr>


<tr>
    <td><label style="font-size:13px;">Pin Code:</label></td>
   <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->present_address_pincode.'</span>
    </td>
</tr>



<tr>
    <td><label style="font-size:13px;">Permanent Address:</label></td>
   <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->permanent_address.'</span>
    </td>
</tr>



<tr>
    <td><label style="font-size:13px;">State:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$permanent_state->StateName_In_English.'</span>
    </td>
</tr>


<tr>
    <td><label style="font-size:13px;">City:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->permanent_address_city.'</span>
    </td>
</tr>


<tr>
    <td><label style="font-size:13px;">Pin Code:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->permanent_address_pincode.'</span>
    </td>
</tr>

<tr>
    <td><label style="font-size:13px;">Working Experience:</label></td>
    <td>
      <span style="width:200px;border:2px solid #0f4c9f;padding:5px 12px;font-size:11px;font-weight:600;display:inline-block">'.$all_job_data[0]->working_experience.'</span>
    </td>
</tr>

</table>

<h3 style="text-align: left;margin-bottom: 20px;margin-top:0px;background: #0f4c9f;color: #0f4c9f;
padding: 5px 15px;font-size: 18px;">Uploaded Documents</h3>
<table class="table">
<tr>
   <td><a style= "font-size: 14px;"  href = "http://katiyarprint.com/cwc-jobs/uploads/dob_certificate/'.$dobbb.'" target="_blank">Date Of Birth Certificate</a></td>
   <td><a style= "font-size: 14px;" href = "http://katiyarprint.com/cwc-jobs/uploads/matriculation_certificate/'.$matriculation.'" target="_blank">Matriculation Certificate</a></td>
   <td><a style= "font-size: 14px;"  href = "http://katiyarprint.com/cwc-jobs/uploads/scc_St_obc_certificate/'.$scst.'" target="_blank">SC/ST Certificate</a></td>
    
</tr>

</table>

<h3 style="text-align: left;margin-bottom: 20px;margin-top:0px;background: #0f4c9f;color: #0f4c9f;
padding: 5px 15px;font-size: 18px;">Disclaimer</h3>

<table class="table">
<tr>
    <td><label style="font-size:13px;"> "I solemnly declare and affirm that the information given above is true & correct to the best of my knowledge and if any incorrect/false information is found, my candidature may be cancelled at any stage and in the event of any mis-statement/ discrepancy in the particulars detected after my appointment, my service is liable to be terminated without any notice to me."</label></td>
    
</tr>



</table>



</div>';
                          
                         
                            // Print text using writeHTMLCell()
                            //$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);   
                             
                            // ---------------------------------------------------------  
                          
                          
                            // Close and output PDF document
                            // This method has several options, check the source code documentation for more information.
                            // $pdf->Output('report.pdf', 'I'); 
                            $pdf->WriteHTML($html);
                              ob_clean(); 
                              //$mpdf->Output();
                             
                              $pdf->Output($_SERVER['DOCUMENT_ROOT'].'workchargedrecuitment/uploads/applicant_pdf/'.$pdf_name.'.pdf','F');

                        /*********Ends PDF Code*************/


?>
