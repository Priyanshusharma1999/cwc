    
    <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-xs-7">
                        <h4 class="page-title">View Pensioner Detail</h4>
                    </div>
                </div>
                <div class="card-box pension-detail">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                    <div class="row">
									
						<?php if($pensioner_detail[0]->PENSION_TYPE == 'POPSEF'){
							
							$title = 'A) Status Of Pending old Pension Scheme(Except Family Pension)';
							
						  } else if($pensioner_detail[0]->PENSION_TYPE == 'POPSOF'){
							  
							  $title = 'B) Status Of Pending old Pension Scheme(Only Family Pension)';
							  
						  } else if($pensioner_detail[0]->PENSION_TYPE == 'PNPSEF'){
							  
							  $title = 'C) Status Of Pending New Pension Scheme(Except Family Pension)';
							  
						  } else {
							  
							  $title = 'D) Status Of Pending New Pension Scheme(Only Family Pension)';
							  
						  } ?>
						
						  <h3  class="title">
						     <?php echo $title; ?>
						  </h3>
									
                                        <div class="col-md-6">
                                            <ul class="personal-info">
											   
                                                <li>
                                                    <span class="title">Full Name:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->FULLNAME; ?></span>
                                                </li>

                                                 <li>
                                                    <span class="title">Employee/Pensioner Designation:</span>
                                                    <span class="text">
                                                 <?php  if(!empty($pensioner_detail[0]->EMP_DESG)){

                                                      echo $pensioner_detail[0]->EMP_DESG;

                                                    } else {
                                                        echo 'N/A';
                                                    } ?></span>
                                                </li>

                                                <li>
                                                    <span class="title">Pension Status For Final Settlement:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->PENSION_STATUS; ?></span>
                                                </li>

                                                <?php

                                                	if($pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS=='Yes')
                                                	{
                                                		$submit_date = $pensioner_detail[0]->PENSION_PAPER_SUBMIT_DATE;;
                                                	}

                                                	else
                                                	{
                                                		$submit_date = '';
                                                	}
                                                ?>
                                                <li>
                                                    <span class="title">Pension Paper Submission Status:</span>
                                                    <span class="text">
                                                        <?php echo $pensioner_detail[0]->PENSION_PAPER_SUBMIT_STATUS; ?>
                                                    </span>
                                                </li>

                                                <li>
                                                    <span class="title">Pension Paper Submission Date:</span>
                                                    <span class="text">
                                                        <?php 
                                                          echo date('d F Y', strtotime($submit_date));
                                                        ?>
                                                   </span>
                                                </li>
												
											<?php if($pensioner_detail[0]->PENSION_TYPE == 'POPSEF' || $pensioner_detail[0]->PENSION_TYPE == 'PNPSEF' ){?>		
                                                <li>
                                                    <span class="title">Date of Retirement:</span>
													<span class="text">
													 <?php 
														 if($pensioner_detail[0]->DATE_RETIREMENT){
															$date = $pensioner_detail[0]->DATE_RETIREMENT;
															$date = date('d F Y', strtotime($date));
															echo $date;
														 } else {
															  echo 'NA';;
														 }
													   ?>
													</span>
                                                </li>
											<?php } ?>
											
											<?php if($pensioner_detail[0]->PENSION_TYPE == 'PNPSOF' || $pensioner_detail[0]->PENSION_TYPE == 'POPSOF' ){?>		
                                                <li>
                                                    <span class="title">Date of Death:</span>
                                                    <span class="text">
													 <?php 
														 if($pensioner_detail[0]->DATE_DEATH){
															$date = $pensioner_detail[0]->DATE_DEATH;
															$date = date('d F, Y', strtotime($date));
															echo $date;
														 } else {
															  echo 'NA';;
														 }
													   ?>
													</span>
                                                </li>
												
						                     <?php } ?>
										
										<?php if($pensioner_detail[0]->PENSION_TYPE == 'POPSOF'){?>	
                                                 <li>
                                                    <span class="title">Name of Family Member Eligible for Pension:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->FAMILYMEM_NAME; ?></span>
                                                </li>
										<?php } ?>
										
												 <li>
                                                    <span class="title">Email Id:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->EMAILID; ?></span>
                                                </li>
												
                                                <li>
                                                    <span class="title">Mobile No:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->MOBILENO; ?></span>
                                                </li>

                                                <li>
                                                    <span class="title">Aadhar No:</span>
                                                    <span class="text adhar_view_chng"><?php echo $pensioner_detail[0]->AADHAR_NO; ?></span>
                                                </li>

                                                <li>
                                                    <span class="title">PAN No:</span>
                                                    <span class="text pan_view_chng"><?php echo $pensioner_detail[0]->PAN_NO; ?></span>
                                                </li>
												
												 <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->GENDER; ?></span>
                                                </li>
												
												 <li>
                                                    <span class="title">Relationship With Pensioner:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->RELATIONWITHPENSIONER; ?></span>
                                                </li>
												
												
                                            </ul>
                                        </div>
										
                                        <div class="col-md-6">
                                            <ul class="personal-info">

                                                
                                                 <li>
                                                    <span class="title">Present Residential Address:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->ADDRESS; ?></span>
                                                </li>
                                                
                                                 <li>
                                                    <span class="title">Name of the division dealing the pension cases:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->DIVIS_DEAL_NAME; ?></span>
                                                </li>
											
												 <li>
                                                    <span class="title">Whether the case is pending with PAO(YES/No):</span>
                                                    <span class="text"><?php 
													if($pensioner_detail[0]->PENDING_PPO==0){
														echo 'No';
													} else {
														echo 'Yes';
													}
													?></span>
                                                </li>
												
											<?php if($pensioner_detail[0]->PENSION_TYPE == 'POPSEF' || $pensioner_detail[0]->PENSION_TYPE == 'POPSOF' ){?>	
												 <li>
                                                    <span class="title">PPO Number if issued:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->PPO_NO; ?></span>
                                                </li>
												
												 <li>
                                                    <span class="title">If PPO no. is yet to be issued, the status of pension papers:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->STATUS_PENS_PAPER; ?></span>
                                                </li>
												
											<?php } ?>		
											
												 <li>
                                                    <span class="title">Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP etc):</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->TREMINAL_BENIFIT_GRANT; ?></span>
                                                </li>
												
											<?php if($pensioner_detail[0]->PENSION_TYPE == 'PNPSEF' || $pensioner_detail[0]->PENSION_TYPE == 'PNPSOF' ){?>	
											   <li>
                                                    <span class="title">Whether withdrawal request submitted to NSDL:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->WITHDRAWAL_REQ_NSDL; ?></span>
                                                </li>
											<?php } ?>
											
											<?php if($pensioner_detail[0]->PENSION_TYPE == 'PNPSEF' || $pensioner_detail[0]->PENSION_TYPE == 'PNPSOF' ){?>	
											   <li>
                                                    <span class="title">Status of the terminal benefits if not granted</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->STATUS_TERM_BENI_NOT_GRANT; ?></span>
                                                </li>
											<?php } ?>
											
												 <li>
                                                    <span class="title">Remarks:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->DESCRIPTION; ?></span>
                                                </li>

                                                <li>
                                                    <span class="title">Remarks by PAO:</span>
                                                    <span class="text"><?php echo $pensioner_detail[0]->PAO_DESCRIPTION; ?></span>
                                                </li>

                                                <li>
                                                    <?php

                                                        $all_pension_pdf = $this->Base_model->get_all_record_by_condition('penspdf',array('STATUS'=>1,'PENSION_ID'=>$pensioner_detail[0]->PENSION_ID));
                                                    ?>
                                                    <span class="title">Files uploaded by PAO:</span>
                                                    <?php

                                                    $base_url =  base_url(); 

                                                        foreach ($all_pension_pdf as $pension_pdf) 
                                                        {
                                                          
                                                            
                                                                echo '</br>'.'<a  href = "'.$base_url.'uploads/pension_files/'.$pension_pdf->FILE.'" download>'.$pension_pdf->FILE.'</a>';
                                                           
                                                        } 
                                                        

                                                   ?>
                                                </li>
                                              
                                            </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        
        </div>
		
		
<style>
 h3.title{
	color: #f05e27;
    font-size: 16px;
    padding-left: 15px;
    margin-bottom: 25px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 15px;
 }
</style>
<script>
   $(document).ready(function(){


    /********* view *********/

        var adhar_ency_val1 = $('.adhar_view_chng').text();
        var pan_ency_val1 = $('.pan_view_chng').text();
       
        var rawdt_val1      = "<?php echo $this->config->item('salt_keyy'); ?>";
     
        var Normaltext1 = CryptoJS.AES.decrypt(adhar_ency_val1, rawdt_val1);  
        var adhar_ency_val11 = Normaltext1.toString(CryptoJS.enc.Utf8); 

        var Normaltext2 = CryptoJS.AES.decrypt(pan_ency_val1, rawdt_val1);  
        var pan_ency_val12 = Normaltext2.toString(CryptoJS.enc.Utf8); 
      
      
        $('.adhar_view_chng').text(adhar_ency_val11);
        $('.pan_view_chng').text(pan_ency_val12);

     /********* ends view *********/


    });//ends 
</script>
	