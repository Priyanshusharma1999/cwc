

	<div class="wl-home-banner">
	         <img src="<?php echo base_url();?>assets/img/career-banner.jpg" style="width:100%;">
     </div>

	  <div class="noticetab">
		<div class="row">
			<div class="col-lg-1 col-xs-3 noticelable">Help</div>
			<div class="col-lg-11 col-xs-9 noticedata">
			   
			     <div id="copyright" class="clear">
                  <marquee  scrollamount="6" onmouseover="this.stop();" onmouseout="this.start();">
	                <p class="fl_left">
					   <font style="text-shadow: 0 0 1px;color:#2662df;"> 
						  Help Desk (Only for Technical Support)- 011-29583246, 29583249 & Email-egovhelpdesk-cwc@nic.in
					   </font>
			        </p>
		       </marquee>
        
		        </div>
				
			</div>
		</div>
     </div>
   
   
  <div class="container">
        <div class="col-sm-12" style="padding:0;">
		    <div class="section-title"> 
                <h2>Download Links</h2>
            </div>
			
			<div class="download-container">
			   
			   <!-- <ul class="dn-links">
					<li>
						<a href="#">
							<img src="<?php echo base_url();?>assets/img/new_red.gif"> 
							SWA Recruitment at CWC Patna:Extension of Last Date- 15.03.2018_Extension.pdf
						</a>
					</li>
					<li><a href="#">Advertisement for SWA recruitment - CWC Patna.pdf</a></li>
					<li><a href="#">Advertisement for SWA recruitment - CWC Shimla.pdf</a></li>
					<li><a href="#">Guidelines Shimla.pdf</a></li>
					<li><a href="#">M&A, Jammu- Documents required for SWA recruitment.pdf</a></li>
					<li><a href="#">M&A, Jammu-Urgent.pdf</a></li>
					<li><a href="#">NTBO_SWA Vacancies Advertisement.pdf</a></li>
					<li><a href="#">Guidelines for scanning Photo/certificates/Documents/Applicant Login</a></li>
					<li><a href="#">Instructions for filling up online application form.</a></li>
					<li><a href="#">Download Certificate format for SC and ST</a></li>
					<li><a href="#">Certificate format to be produced by Other Backward Classes.</a></li>
					<li><a href="#">Download Certificate format to be produced by Physically Handicapped (PH) Certificate.</a></li>
		      </ul>  --> 
							<table>
								  <tr>
								    <th>S.No</th>
								    <th>Job Description</th>
								    <th>Circular</th>
								    <th>Start Date</th>
								    <th>End Date</th>
								    <th>Apply</th>
								  </tr>
								  <?php
											if($all_circulars) {
												$i = 1;
												foreach($all_circulars as $circular) { ?>
								  <tr>
								    <td><?php echo $i++; ?>
			
								    
									</td>
								    <td><img src="<?php echo base_url();?>assets/img/new_red.gif"> 
								    	<?php 

										    	$job_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $circular->job_id));
										    	echo $job_data->job_title; 
								    	?>
								    </td>
								    <td>
								    	<a href="<?php echo base_url('uploads/circular/'.$circular->file); ?>" download="<?php echo $circular->file; ?>"><?php echo $circular->circular_title; ?> </a>
								    	
								    </td>
								    <td>
								    		<?php 
								    	
										    	$job_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $circular->job_id));

										    	if($job_data->start_date)
										    	{
										    		$start_date = $job_data->start_date;
										    	}

										    	else
										    	{
										    		$start_date = '';
										    	}
										    	echo $start_date; 
								    	?>
								    </td>
								    <td>
								    	<?php 
								    	
										    	$job_data = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $circular->job_id));

										    	if($job_data->end_date)
										    	{
										    		$end_date = $job_data->end_date;
										    	}

										    	else
										    	{
										    		$end_date = '';
										    	}
										    	echo $end_date; 
								    	?>

								  	</td>
								  	<td>
								  		<button data-toggle="modal"  data-target="#job_apply_modaal" class="btn btn-sm btn-primary">Apply</button>
								  		
								  		
								  	</td>
								  </tr>
								   <?php } } else { ?>
										<tr><td>No Circular found</td></tr>
										<?php } ?>
							  
							</table>

			   
			</div>
		   
        </div>
  </div>

  <!--Modal for job apply-->
  <div id="job_apply_modaal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="float: left;">
	     <div class="account-box" style="box-shadow: none;border: 0;margin: 0;width: auto;">
			<div class="account-wrapper" style="float: left;background:#fff;">
			   <h3 class="account-title">Apply Job</h3>
			  		
					<div class="form-group form-focus">
						    <label class="control-label">Disclaimer :</label>
							<p>Applicants should read official notification carefully for the detailed information regarding,age limit,education qualification, selection process and how to apply for CWC-Job Recruitment. This portal only for facilitation regarding application for respective vacancies.</p>
							
				     </div>
				
						<a id = "verify_mobille" class="btn btn-primary pull-left" href="<?php echo site_url();?>frontend/login" >Login</a>
					
						<button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
					
				
			 </div>
		  </div>
      </div>
    </div>
  </div>
</div>
  <!--Ends Modal-->
  <style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
    background:#fff;
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

th {
    text-align: left;
    background: #4676b7;
    color: #fff;
}

</style>
   