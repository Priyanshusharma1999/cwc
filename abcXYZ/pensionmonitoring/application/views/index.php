   
	<!--<div class="wl-home-banner">
	         <img src="<?php echo base_url();?>assets/img/bannernew.png" style="width:100%;">
	        <!--  <marquee><b style="color:#f05e27;font-size:16px;">This site is testing purpose only</b></marquee> 

    </div>-->
	  
   
  <div class="container mrt-60">
       <div class="col-sm-3"  style="width:20%;">
			
			<div class="panel panel-default side-panel">
			  <div class="panel-heading">Contact Details</div>
			  <div class="panel-body">
			     <ul class="dn-links">
					<li>
					  <a href="<?php echo site_url();?>frontend/contactlist">
					   <i class="fa fa-angle-double-right"></i>View Contact List
					  </a>
					</li>
		        </ul> 
			  </div>
			</div>
			
			<div class="panel panel-default side-panel">
			  <div class="panel-heading">Circular</div>
			  <div class="panel-body scrolltop">
			     <ul class="dn-links">
			     	<?php if($all_data) {
			     	 foreach($all_data as $data){?>
					<li>
						<a href="<?php echo 'uploads/circular/'.$data->file; ?>" target="_blank" >
							<i class="fa fa-angle-double-right"></i><?php echo $data->title; ?>
						</a>
					</li>
				   <?php } } else { echo 'Empty List'; } ?>
				
		         </ul>
			  </div>
			</div>

		<div class="panel panel-default side-panel">
			  <div class="panel-heading">Pension Details</div>
			  <div class="panel-body">
			     <ul class="dn-links">
					<li>
					  <a href="<?php echo site_url();?>frontend/report">
					   <i class="fa fa-angle-double-right"></i>View Pension Report
					  </a>
					</li>
		        </ul> 
			  </div>
			</div>
			
	   </div>
	   
        <div class="col-sm-9" style="width:80%;">
		
		   <div id="messagemodal" class="modal fade" role="dialog">
			  <div class="modal-dialog">
				
				<div class="modal-content">
				
					  <button type="button" class="close" data-dismiss="modal">&times;</button>
				
				  <div class="modal-body">
					  <div class="account-box">
							<div class="account-wrapper">
							  <div class='alert alert-danger'>
			                    <?php echo $this->session->flashdata('flashError_applicant_login'); ?> 
			                 </div> 
							</div>
					  </div>
				  </div> 
				</div>
			  </div>
            </div>
   
		
		    <?php if($this->session->flashdata('flashError_applicant_login')) { ?>
			
				<script>
				   $('#messagemodal').modal('show');
				</script>
				
			<?php } ?> 
		
			<h3 style="color: #fff;text-align: center;background:#0f4c9f;padding: 10px 0;font-size: 16px;">
			  Search Your Pension Status
			</h3>
			<?php
			 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_form');
					echo form_open_multipart('Frontend/search_pension/',$attributes);?> 
		    <!-- <form class="form-inline sr-form" action="#"> -->
			
				  <div class="form-group" style="min-height:60px;">
					<select  name ="select_type" class="form-control" id="type">
					   <option selected="selected" value="">Select Type</option>
					    <option value="All"  <?php if($insertData['select_type'] == 'All') echo 'selected="selected"' ?>>All</option>
						<option value="Name"  <?php if($insertData['select_type'] == 'Name') echo 'selected="selected"' ?>>Name</option>
						<option value="PPO"  <?php if($insertData['select_type'] == 'PPO') echo 'selected="selected"' ?>>PPO No.</option>

						<option value="POPSEF">Status Of Pending old Pension Scheme(Except Family Pension)</option>
					   <option value="POPSOF">Status Of Pending old Pension Scheme(Only Family Pension)</option>
					   <option value="PNPSEF">Status Of Pending New Pension Scheme(Except Family Pension)</option>
					   <option value="PNPSOF">Status Of Pending New Pension Scheme(Only Family Pension)</option>

					</select>
				  </div>
				  
				  <div class="form-group" style="display:none;min-height:60px;" id="name">
					<input type="text" name ="name" value="<?php echo isset($insertData['name']) ? $insertData['name'] : ''; ?>" class="form-control" placeholder="Enter Name" >
				  </div>
				  
				  <div class="form-group" style="display:none;min-height:60px;" id="ppo">
					<input type="text" name ="ppo_no" value="<?php echo isset($insertData['ppo_no']) ? $insertData['ppo_no'] : ''; ?>" class="form-control" placeholder="Enter PPO No." >
				  </div>
				  
				   <div class="form-group" id="division" style="min-height:60px;">
					<select  name= "division"  class="form-control" >
					   <option selected="selected" value="">Select Division</option>
					    <option value="All" <?php if($insertData['division'] == 'All') echo 'selected="selected"' ?>>All</option>
						<?php
							if(empty($all_division))
							{
								echo '<option value="1">'.'Select Division'.'</option>';
							}

							else
							{
								foreach ($all_division as $division)
						                      {?>   
						                      	
						                      	<option  value="<?php echo $division->DIVISIONNAME ?>" <?php if($insertData['division']==$division->DIVISIONNAME) { echo 'selected'; } ?> >

						                      		<?php echo $division->DIVISIONNAME; ?>

						                      	</option>

						                      <?php }
							}
	                      
	                    ?>
					</select>
				  </div>
				  
				   <div class="form-group" id="status" style="min-height:60px;">
					<select name= "status"  class="form-control">
					   <option selected="selected" value="">Select Status</option>
					   <option value="All" <?php if($insertData['status'] == 'All') echo 'selected="selected"'?>>All</option>
						<option value="Pending" <?php if($insertData['status'] == 'Pending') echo 'selected="selected"' ?>>Pending</option>
						<option value="Settled" <?php if($insertData['status'] == 'Settled') echo 'selected="selected"' ?>>Settled</option>
					</select>
				  </div>
				  
				  <div class="form-group" style="min-height:60px;">
				     <button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
				  </div>
			<?php echo form_close();?>
			
			
			<?php
                 if($all_data_POPSEF) {?>
			<div class="pension-table">
			
			  <h3 style="color:#f05e27;font-size:14px;">A) Status of old Pension Scheme(Except Family Pension)</h3>
			
			<table border width="100%">
					
							<tr>
							<th  rowspan="2">S.No.</th>
							<th  rowspan="2">Name of the Employee/Pensioner</th>
							<th  rowspan="2">Designation of the Employee/Pensioner</th> 
							<th  rowspan="2">Date of Retirement</th>
							<th  colspan="5"></th>
							<th  rowspan="2">Name of the division dealing the pension cases</th>
							<th  colspan="6"></th>
							
						</tr>
									
						 <tr>
						 	<?php
							if($this->session->userdata('applicant_user_id'))
			 				{?>
			 					<th rowspan="1">Mobile No,Email Id, PAN No., Aadhar No.</th>
							 <th rowspan="1">Present Residential Address</th>
			 				<?php } ?>
							 <th  rowspan="1">Whether pension paper has been submitted</th>
							 <th  rowspan="1">Whether Verification of service book completed</th>
							 <th  rowspan="1">Whether the case is pending with PAO(YES/No)</th>
							 <th  rowspan="1">PPO Number if issued</th>
							 <th  rowspan="1">If PPO no. is yet to be issued, the status of pension papers</th>
							 <th  rowspan="1">Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP, LE, CGEGIS etc)</th>
							 <th  rowspan="1">Pension Status</th>
							  <th  rowspan="1">Remarks</th>
							  <th  rowspan="1">PAO Remarks if any</th>
						 </tr>
						 <?php

                            if($all_data_POPSEF) {
                           	$i=1;
                            foreach($all_data_POPSEF as $POPSEF) { ?>

						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $POPSEF->EMPLY_NAME; ?></td>
							<td><?php if(!empty($POPSEF->EMP_DESG)){
								 echo $POPSEF->EMP_DESG; 
								} else { 
									echo 'N/A'; 
								} ?></td>
							<td><?php echo date('d F, Y', strtotime($POPSEF->DATE_RETIREMENT)); ?></td>

							<?php
								if($this->session->userdata('applicant_user_id'))
			 				{?>
			 					
			 					<td>

								<?php 
								$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $POPSEF->PENSION_ID,'STATUS'=>1));
								echo $pension_contact_data->MOBILENO.'<br/>'.$pension_contact_data->EMAILID.'<br/>'.'<span id="fileId2_'.$i.'"></span>'.'<br/>'.'<span id="fileId_'.$i.'"></span>';
								?>

								<?php								
									$base_url = base_url();
									$adhar_1 = $pension_contact_data->AADHAR_NO;

									$pan_1 = $pension_contact_data->PAN_NO; 
									$salt_key = 'asdbasg67532rbdwsfbshdfghsdfwegh';
									$jquery_script = $base_url.'assets/js/jquery-3.2.1.min.js';
									$aes_script = $base_url.'assets/js/aes.js';
									echo "<script type='text/javascript' src= ".$jquery_script."></script><script type='text/javascript' src=".$aes_script."></script>
									<script type = 'text/javascript'>
									
									var Normaltext1 = CryptoJS.AES.decrypt('".$adhar_1."', '".$salt_key."');
									var adhar_ency_val11 = Normaltext1.toString(CryptoJS.enc.Utf8); 

									var Normaltext2 = CryptoJS.AES.decrypt('".$pan_1."', '".$salt_key."');
									var adhar_ency_val12 = Normaltext2.toString(CryptoJS.enc.Utf8); 

									 $('#fileId_".$i."').text(adhar_ency_val11);
									 $('#fileId2_".$i."').text(adhar_ency_val12);</script>"; ?>


							</td>
							<td>
								<?php 
								$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $POPSEF->PENSION_ID,'STATUS'=>1));
								echo $pension_contact_data->ADDRESS;
								?>
							</td>

			 				<?php } ?>


							<td>
								<?php 
									
									if($POPSEF->PENSION_PAPER_SUBMIT_STATUS=='Yes')
									{
										$datwwe = date('d F, Y', strtotime($POPSEF->PENSION_PAPER_SUBMIT_DATE));

										if($datwwe == '01 January, 1970')
										{
											$datwwe = '';
										}
										else
										{
											$datwwe = $datwwe;
										}

									}

									else if($POPSEF->PENSION_PAPER_SUBMIT_STATUS=='No')
									{
										$datwwe = '';
									}

									else
									{
										$datwwe = '';
									}

									echo $POPSEF->PENSION_PAPER_SUBMIT_STATUS.'<br/>'.$datwwe;
								?>
							</td>
							
							<td>
								<?php 
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $POPSEF->PENSION_ID,'STATUS'=>1));
									if($pension_record_status_data->ANNUAL_VERIFICATION ==0)
									{
										echo 'No';
									}

									else if($pension_record_status_data->ANNUAL_VERIFICATION ==1)
									{
										echo 'Yes';
									}

									else
									{
										echo'';	
									}
								?>
							</td>
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $POPSEF->PENSION_ID,'STATUS'=>1));
									if($pension_record_status_data->PENDING_PPO ==0)
									{
										echo 'No';
									}

									else if($pension_record_status_data->PENDING_PPO ==1)
									{
										echo 'Yes';
									}

									else
									{
										echo'';	
									}
								?>
							</td>
							<td>
								<?php
									echo $POPSEF->PPO_NO;
								?>
							</td>
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $POPSEF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_status_data->STATUS_PENS_PAPER;

									
								?>
							</td>
							<td>
								<?php
									echo $POPSEF->DIVIS_DEAL_NAME;
								?>
							</td>
							
							
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $POPSEF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_status_data->TREMINAL_BENIFIT_GRANT;
								?>
							</td>
							<td><?php echo $POPSEF->PENSION_STATUS; ?></td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $POPSEF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_remark_data->DESCRIPTION;
								?>	
							</td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $POPSEF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_remark_data->PAO_DESCRIPTION;
								?>	
							</td>
						</tr>

						<?php $i++;}} else { ?>
                        <tr><td colspan="9">No data found</td></tr>
                        <?php } ?>
		
						
						
		    </table>
			
			
		  </div>
		  
		  <?php } ?>
			


		 <?php
           if($all_data_POPSOF) { ?>
		 
		  <div class="pension-table">

			  <h3 style="color:#f05e27;font-size:14px;">B) Status of old Pension Scheme(Only Family Pension)</h3>
			
			<table border width="100%">
					
							<tr>
							<th  rowspan="2">S.No.</th>
							<th  rowspan="2">Name of the Employee</th>
							<th  rowspan="2">Designation of the Employee</th> 
							<th  rowspan="2">Date of Death</th>
							<th  rowspan="2">Name of Family Member Eligible for Pension</th>
							<th  colspan="5"></th>
							<th  rowspan="2">Name of the division dealing the pension cases </th>
							<th  colspan="7"></th>
						
							</tr>
									
						 <tr>
						 	<?php
							if($this->session->userdata('applicant_user_id'))
			 				{?>
			 				 <th rowspan="1">Mobile No,Email Id, PAN No.,Aadhar No.</th>
							 <th  rowspan="1">Present Residential Address</th>
			 				<?php } ?>
							 <th  rowspan="1">Whether pension paper has been submitted</th>
							 <th  rowspan="1">Whether the case is pending with PAO(YES/No)</th>
							 <th  rowspan="1">PPO Number if issued</th>
							 <th  rowspan="1">If PPO no. is yet to be issued, the status of pension papers</th>
							 <th  rowspan="1">Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP, LE, CGEGIS etc)</th>
							 <th  rowspan="1">Pension Status</th>
							 <th  rowspan="1">Remarks</th>
							 <th  rowspan="1">PAO Remarks if any</th>
						 </tr>
						<?php
                            if($all_data_POPSOF) {
                            $i=1;
                            foreach($all_data_POPSOF as $POPSOF) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $POPSOF->EMPLY_NAME; ?></td>
							<td><?php if(!empty($POPSOF->EMP_DESG)){
								 echo $POPSOF->EMP_DESG; 
								} else { 
									echo 'N/A'; 
								} ?></td>
							<td><?php echo date('d F, Y', strtotime($POPSOF->DATE_DEATH));?></td>
							<td><?php echo $POPSOF->FAMILYMEM_NAME; ?></td>
							<?php
							if($this->session->userdata('applicant_user_id'))
			 				{?>
			 				<td>
								<?php 
								$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $POPSOF->PENSION_ID,'STATUS'=>1));
								echo $pension_contact_data->MOBILENO.'<br/>'.$pension_contact_data->EMAILID.'<br/>'.'<span id="fileId4_'.$i.'"></span>'.'<br/>'.'<span id="fileId3_'.$i.'"></span>';
								?>

								 <?php               
                  $base_url = base_url();
                  $adhar_1 = $pension_contact_data->AADHAR_NO;

                  $pan_1 = $pension_contact_data->PAN_NO; 
                  $salt_key = 'asdbasg67532rbdwsfbshdfghsdfwegh';
									$jquery_script = $base_url.'assets/js/jquery-3.2.1.min.js';
									$aes_script = $base_url.'assets/js/aes.js';
									echo "<script type='text/javascript' src= ".$jquery_script."></script><script type='text/javascript' src=".$aes_script."></script>
									<script type = 'text/javascript'>
                  
                  var Normaltext1 = CryptoJS.AES.decrypt('".$adhar_1."', '".$salt_key."');
                  var adhar_ency_val11 = Normaltext1.toString(CryptoJS.enc.Utf8); 

                  var Normaltext2 = CryptoJS.AES.decrypt('".$pan_1."', '".$salt_key."');
                  var pan_ency_val12 = Normaltext2.toString(CryptoJS.enc.Utf8); 

                   $('#fileId3_".$i."').text(adhar_ency_val11);
                   $('#fileId4_".$i."').text(pan_ency_val12);</script>"; ?>

							</td>
							<td>
								<?php 
								$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $POPSOF->PENSION_ID,'STATUS'=>1));
								echo $pension_contact_data->ADDRESS;
								?>
							</td>
			 				<?php } ?>
							
							<td>
								<?php 
									
									if($POPSOF->PENSION_PAPER_SUBMIT_STATUS=='Yes')
									{
										$datwwe = date('d F, Y', strtotime($POPSOF->PENSION_PAPER_SUBMIT_DATE));

										if($datwwe == '01 January, 1970')
										{
											$datwwe = '';
										}
										else
										{
											$datwwe = $datwwe;
										}
									}

									else if($POPSOF->PENSION_PAPER_SUBMIT_STATUS=='No')
									{
										$datwwe = '';
									}

									else
									{
										$datwwe = '';
									}

								echo $POPSOF->PENSION_PAPER_SUBMIT_STATUS.'<br/>'.$datwwe;
								?>
							</td>
							
							
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $POPSOF->PENSION_ID,'STATUS'=>1));
									if($pension_record_status_data->PENDING_PPO ==0)
									{
										echo 'No';
									}

									else if($pension_record_status_data->PENDING_PPO ==1)
									{
										echo 'Yes';
									}

									else
									{
										echo'';	
									}
								?>
							</td>
							<td>
								<?php
									echo $POPSOF->PPO_NO;
								?>
									
							</td>
							
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $POPSOF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_status_data->STATUS_PENS_PAPER;

								?>
							</td>

							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $POPSOF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_status_data->TREMINAL_BENIFIT_GRANT;
								?>
							</td>
							<td>
								<?php
									echo $POPSOF->DIVIS_DEAL_NAME;
								?>
							</td>
							<td><?php echo $POPSOF->PENSION_STATUS; ?></td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $POPSOF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_remark_data->DESCRIPTION;
								?>	
							</td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $POPSOF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_remark_data->PAO_DESCRIPTION;
								?>	
							</td>
						</tr>
						<?php $i++;} } else { ?>
                        <tr><td colspan="9">No data found</td></tr>
                        <?php } ?>
		
					
		    </table>
		   
		  </div>
		  

		   <?php } ?>
			

			 <?php
               if($all_data_PNPSEF) {?>
		   <div class="pension-table">
		  
			
			  <h3 style="color:#f05e27;font-size:14px;">C) Status of New Pension Scheme(Except Family Pension)</h3>
			
			<table border width="100%">
					
							<tr>
							<th  rowspan="2">S.No.</th>
							<th  rowspan="2">Name of the Pensioner</th>
							<th  rowspan="2">Designation of the Pensioner</th>
							<th  rowspan="2">Date of Retirement</th>
							<th  colspan="5"></th>
							<th  rowspan="2">Name of the division dealing the pension cases</th>
							<th  colspan="7"></th>
							
						</tr>
									
						 <tr>
							 <?php
							if($this->session->userdata('applicant_user_id'))
			 				{?>
			 					<th rowspan="1">Mobile No,Email Id, PAN No.,Aadhar No.</th>
							  <th rowspan="1">Present Residential Address</th>
			 				<?php } ?>
							 <th  rowspan="1">Whether pension paper has been submitted</th>
							 <th  rowspan="1">Whether withdrawal request submitted to NSDL</th>
							 <th  rowspan="1">Whether terminal benefits granted(Provide specific details w.r.t, LE, CGEGIS, Service Gratuity, Retirement Gratuity  etc.)</th>
							 <th  rowspan="1">Whether the case is pending with PAO(YES/No)</th>
							 <th  rowspan="1">Status of the terminal benifits if not granted</th>
							 <th  rowspan="1">Pension Status</th>
							 <th  rowspan="1">Remarks</th>
							 <th  rowspan="1">PAO Remarks if any</th>
						 </tr>
						
						<?php
                            if($all_data_PNPSEF) {
                            $i=1;
                            foreach($all_data_PNPSEF as $PNPSEF) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $PNPSEF->EMPLY_NAME; ?></td>
							<td><?php if(!empty($PNPSEF->EMP_DESG)){
								 echo $PNPSEF->EMP_DESG; 
								} else { 
									echo 'N/A'; 
								} ?></td>
							<td><?php echo date('d F, Y', strtotime($PNPSEF->DATE_RETIREMENT));?></td>
							<?php
							if($this->session->userdata('applicant_user_id'))
			 				{?>

			 					<td>
								<?php 
								$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $PNPSEF->PENSION_ID,'STATUS'=>1));
								echo $pension_contact_data->MOBILENO.'<br/>'.$pension_contact_data->EMAILID.'<br/>'.'<span id="fileId6_'.$i.'"></span>'.'<br/>'.'<span id="fileId5_'.$i.'"></span>';
								?>

								<?php               
                  $base_url = base_url();
                  $adhar_1 = $pension_contact_data->AADHAR_NO;

                  $pan_1 = $pension_contact_data->PAN_NO; 
                  $salt_key = 'asdbasg67532rbdwsfbshdfghsdfwegh';
					$jquery_script = $base_url.'assets/js/jquery-3.2.1.min.js';
					$aes_script = $base_url.'assets/js/aes.js';
					echo "<script type='text/javascript' src= ".$jquery_script."></script><script type='text/javascript' src=".$aes_script."></script>
					<script type = 'text/javascript'>
                  
                  var Normaltext1 = CryptoJS.AES.decrypt('".$adhar_1."', '".$salt_key."');
                  var adhar_ency_val11 = Normaltext1.toString(CryptoJS.enc.Utf8); 

                  var Normaltext2 = CryptoJS.AES.decrypt('".$pan_1."', '".$salt_key."');
                  var pan_ency_val12 = Normaltext2.toString(CryptoJS.enc.Utf8); 

                   $('#fileId5_".$i."').text(adhar_ency_val11);
                   $('#fileId6_".$i."').text(pan_ency_val12);</script>"; ?>

							</td>
							<td>
								<?php 
								$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $PNPSEF->PENSION_ID,'STATUS'=>1));
								echo $pension_contact_data->ADDRESS;
								?>
							</td>
							

			 				<?php } ?>
							<td>
								<?php 
									if($PNPSEF->PENSION_PAPER_SUBMIT_STATUS=='Yes')
									{
										$datwwe = date('d F, Y', strtotime($PNPSEF->PENSION_PAPER_SUBMIT_DATE));

										if($datwwe == '01 January, 1970')
										{
											$datwwe = '';
										}
										else
										{
											$datwwe = $datwwe;
										}
									}

									else if($PNPSEF->PENSION_PAPER_SUBMIT_STATUS=='No')
									{
										$datwwe = '';
									}

									else
									{
										$datwwe = '';
									}
									


									echo $PNPSEF->PENSION_PAPER_SUBMIT_STATUS.'<br/>'.$datwwe;
								?>
							</td>
							
							<td>
								<?php 
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $PNPSEF->PENSION_ID,'STATUS'=>1));
									
									echo $pension_record_status_data->WITHDRAWAL_REQ_NSDL;
								?>
							</td>
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $PNPSEF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_status_data->TREMINAL_BENIFIT_GRANT;
								?>
							</td>
							
							<td>
							<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $PNPSEF->PENSION_ID,'STATUS'=>1));
									if($pension_record_status_data->PENDING_PPO ==0)
									{
										echo 'No';
									}

									else if($pension_record_status_data->PENDING_PPO ==1)
									{
										echo 'Yes';
									}

									else
									{
										echo'';	
									}
								?>
								
							</td>
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $PNPSEF->PENSION_ID,'STATUS'=>1));
									
									echo $pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT;
								?>
							</td>
							<td>
								<?php
									echo $PNPSEF->DIVIS_DEAL_NAME;
								?>
							</td>
							<td><?php echo $PNPSEF->PENSION_STATUS; ?></td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $PNPSEF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_remark_data->DESCRIPTION;
								?>	
							</td>

							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $PNPSEF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_remark_data->PAO_DESCRIPTION;
								?>	
							</td>
						</tr>	
						<?php $i++;} } else { ?>
                        <tr><td colspan="9">No data found</td></tr>
                        <?php } ?>					
						
						
		    </table>

		    
		  </div>

		  <?php } ?>
		  
		  <?php
             if($all_data_PNPSOF) {?>
		   <div class="pension-table">
		   
			
			  <h3 style="color:#f05e27;font-size:14px;">D) Status of New Pension Scheme(Only Family Pension)</h3>
			
			<table border width="100%">
					
						<tr>
							<th  rowspan="2">S.No.</th>
							<th  rowspan="2">Name of the Employee</th>
							<th  rowspan="2">Designation of the Employee</th> 
							<th  rowspan="2">Date of Death</th>
							<th  colspan="5"></th>
							<th  rowspan="2">Name of the division dealing the pension cases </th>
							<th  colspan="7"></th>
							
						</tr>
									
						 <tr>
							<?php
							if($this->session->userdata('applicant_user_id'))
			 				{?>
			 				 <th rowspan="1">Mobile No,Email Id, PAN No.,Aadhar No.</th>
							 <th rowspan="1">Present Residential Address</th>
			 				<?php }?>
							<th  rowspan="1">Whether pension paper has been submitted</th>
							<th  rowspan="1">Whether withdrawal request submitted to NSDL</th>
							 <th  rowspan="1">Whether terminal benefits granted(Provide specific details w.r.t, LE, CGEGIS, Service Gratuity, Retirement Gratuity  etc.)</th>
							 <th  rowspan="1">Whether the case is pending with PAO(YES/No)</th>
							 <th  rowspan="1">Status of the terminal benifits if not granted</th>
							 <th  rowspan="1">Pension Status</th>
							 <th  rowspan="1">Remarks</th>
							 <th  rowspan="1">PAO Remarks if any</th>
						 </tr>
						
						<?php
                            if($all_data_PNPSOF) {
                            $i=1;
                            foreach($all_data_PNPSOF as $PNPSOF) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $PNPSOF->EMPLY_NAME; ?></td>
							<td><?php if(!empty($PNPSOF->EMP_DESG)){
								 echo $PNPSOF->EMP_DESG; 
								} else { 
									echo 'N/A'; 
								} ?></td>
							<td><?php echo date('d F, Y', strtotime($PNPSOF->DATE_DEATH));?></td>
							<?php
							if($this->session->userdata('applicant_user_id'))
			 				{?>
			 					<td>
								<?php 
								$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $PNPSOF->PENSION_ID,'STATUS'=>1));
								echo $pension_contact_data->MOBILENO.'<br/>'.$pension_contact_data->EMAILID.'<br/>'.'<span id="fileId8_'.$i.'"></span>'.'<br/>'.'<span id="fileId7_'.$i.'"></span>';
								?>

								<?php               
                  $base_url = base_url();
                  $adhar_1 = $pension_contact_data->AADHAR_NO;

                  $pan_1 = $pension_contact_data->PAN_NO; 
                 $salt_key = 'asdbasg67532rbdwsfbshdfghsdfwegh';
				$jquery_script = $base_url.'assets/js/jquery-3.2.1.min.js';
				$aes_script = $base_url.'assets/js/aes.js';
				echo "<script type='text/javascript' src= ".$jquery_script."></script><script type='text/javascript' src=".$aes_script."></script>
				<script type = 'text/javascript'>
                  
                  var Normaltext1 = CryptoJS.AES.decrypt('".$adhar_1."', '".$salt_key."');
                  var adhar_ency_val11 = Normaltext1.toString(CryptoJS.enc.Utf8); 

                  var Normaltext2 = CryptoJS.AES.decrypt('".$pan_1."', '".$salt_key."');
                  var pan_ency_val12 = Normaltext2.toString(CryptoJS.enc.Utf8); 

                   $('#fileId7_".$i."').text(adhar_ency_val11);
                   $('#fileId8_".$i."').text(pan_ency_val12);</script>"; ?>

							</td>
							<td>
								<?php 
								$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $PNPSOF->PENSION_ID,'STATUS'=>1));
								echo $pension_contact_data->ADDRESS;
								?>
							</td>

			 				<?php } ?>
							<td>
								<?php 
									if($PNPSOF->PENSION_PAPER_SUBMIT_STATUS=='Yes')
									{
										$datwwe = date('d F, Y', strtotime($PNPSOF->PENSION_PAPER_SUBMIT_DATE));

										if($datwwe == '01 January, 1970')
										{
											$datwwe = '';
										}
										else
										{
											$datwwe = $datwwe;
										}
									}

									else if($PNPSOF->PENSION_PAPER_SUBMIT_STATUS=='No')
									{
										$datwwe = '';
									}

									else
									{
										$datwwe = '';
									}
									
									echo $PNPSOF->PENSION_PAPER_SUBMIT_STATUS.'<br/>'.$datwwe;
								?>
							</td>
							
							<td>
								<?php 
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $PNPSOF->PENSION_ID,'STATUS'=>1));
								
									echo $pension_record_status_data->WITHDRAWAL_REQ_NSDL;
								?>
							</td>
							<td>
								<?php 
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $PNPSOF->PENSION_ID,'STATUS'=>1));
									
										echo $pension_record_status_data->TREMINAL_BENIFIT_GRANT;	
									
								?>
							</td>
							
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $PNPSOF->PENSION_ID,'STATUS'=>1));
									if($pension_record_status_data->PENDING_PPO ==0)
									{
										echo 'No';
									}

									else if($pension_record_status_data->PENDING_PPO ==1)
									{
										echo 'Yes';
									}

									else
									{
										echo'';	
									}
								?>
							</td>
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $PNPSOF->PENSION_ID,'STATUS'=>1));
									
									echo $pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT;
								?>
							</td>
							<td>
								<?php
									echo $PNPSOF->DIVIS_DEAL_NAME;
								?>
							</td>
							<td><?php echo $PNPSOF->PENSION_STATUS; ?></td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $PNPSOF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_remark_data->DESCRIPTION;
								?>
									
							</td>

							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $PNPSOF->PENSION_ID,'STATUS'=>1));
									echo $pension_record_remark_data->PAO_DESCRIPTION;
								?>
									
							</td>
						</tr>
						<?php $i++; } } else { ?>
                        <tr><td colspan="9">No data found</td></tr>
                        <?php } ?>	
		
						
						
						
						
		    </table>
		    
			
		  </div>

		  <?php } ?>
		 
			
        </div>
		
  </div>
  <!-- Selected data-->
 		<?php

			 $json_selected_type = json_encode($insertData['select_type']);
			
		?>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
  <script >
  	 $('#search_form').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        status:{
            required : true
        },

        select_type:{
            required : true
        },

        
       
       },

    messages: {
       
        status:{
           required : "Please select status"
          
        },

         select_type:{
            required : "Please select type"
        },


         

      },
            errorElement: "div",
            wrapper: "div",
            errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
            },
 
}); 
  </script>
  <script>
  
		  $(document).ready(function(){

		  	var selected_type = <?php echo $json_selected_type; ?>;

		  	if(selected_type == 'Name')
		  	{
		  		$("#name").show();
				$("#fname").hide();
				$("#ppo").hide();
				 $("#division").show();
				 $("#status").show();
		  	}

		  	else if(selected_type == 'PPO')
		  	{
		  		 $("#name").hide();
				  $("#fname").hide();
				  $("#ppo").show();
				  $("#division").hide();
				  $("#status").show();
		  	}

		  	else if(selected_type == 'All')
		  	{
		  		$("#division").hide();
				  $("#status").show();
				  $("#ppo").hide();
				  $("#name").hide();

		  	} else if(selected_type == 'POPSEF')
		  	{
		  		$("#division").hide();
				  $("#status").show();
				  $("#ppo").hide();
				  $("#name").hide();

		  	}else if(selected_type == 'POPSOF')
		  	{
		  		$("#division").hide();
				  $("#status").show();
				  $("#ppo").hide();
				  $("#name").hide();

		  	}else if(selected_type == 'PNPSEF')
		  	{
		  		$("#division").hide();
				  $("#status").show();
				  $("#ppo").hide();
				  $("#name").hide();

		  	} else if(selected_type == 'PNPSOF')
		  	{
		  		$("#division").hide();
				  $("#status").show();
				  $("#ppo").hide();
				  $("#name").hide();
		  	}

		  	else
		  	{
		  		$("#name").hide();
				  $("#fname").hide();
				  $("#ppo").hide();
		  	}

			$('#type').on('change', function() {
			  if ( this.value == 'Name')
			  {
				$("#name").show();
				$("#fname").hide();
				$("#ppo").hide();
				 $("#division").show();
				 $("#status").show();
				
			  } else if(this.value == 'PPO'){
				  
				  $("#name").hide();
				  $("#fname").hide();
				  $("#ppo").show();
				  $("#division").hide();
				  $("#status").show();

			  } else if(this.value == 'All'){
				  
				   $("#division").hide();
				  $("#status").show();
				  $("#ppo").hide();
				  $("#name").hide();

			  } else if(this.value == 'POPSEF'){
				  
				   $("#division").hide();
				  $("#status").show();
				  $("#ppo").hide();
				  $("#name").hide();
				  
			  } else if(this.value == 'POPSOF'){
				  
				   $("#division").hide();
				  $("#status").show();
				  $("#ppo").hide();
				  $("#name").hide();
				  
			  } else if(this.value == 'PNPSEF'){
				  
				   $("#division").hide();
				  $("#status").show();
				  $("#ppo").hide();
				  $("#name").hide();
				  
			  }  else if(this.value == 'PNPSOF'){
				  
				   $("#division").hide();
				  $("#status").show();
				  $("#ppo").hide();
				  $("#name").hide();
				  
			  } 

			  else
			  {
				
				 $("#name").hide();
				  $("#fname").hide();
				  $("#ppo").hide();
				
			  }

		});
			
			$(".scrolltop").animate({ scrollTop: $(document).height() }, 4000);
		
		setTimeout(function() {
		   $('.scrolltop').animate({scrollTop:0}, 4000); 
		},4000);
	
	   var scrolltopbottom =  setInterval(function(){
		$(".scrolltop").animate({ scrollTop: $(document).height() }, 4000);
		setTimeout(function() {
		   $('.scrolltop').animate({scrollTop:0}, 4000); 
		},4000);

		},8000);
			
		  });
		
		
		
  </script>
  