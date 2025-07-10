  
	<div class="wl-home-banner">
	         <img src="<?php echo base_url();?>assets/img/bannernew.png" style="width:100%;">
    </div>
	  
   
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
					echo form_open_multipart('Frontend/report/',$attributes);?> 
		 
				 	    <div class="form-group">
								   <label style="display:block;min-height:18px;"></label>
									<select required="required" class="form-control" id="selecct_type" name = "select_type">
									   <option selected="selected" value="">Select Type</option>
									   <option value="9" <?php  if($insertData['type']==9) { echo 'selected'; } ?> >All</option>
										<option value="1" <?php  if($insertData['type']==1) { echo 'selected'; } ?> >List of pension cases pending with PAO</option>
										<option value="2" <?php  if($insertData['type']==2) { echo 'selected'; } ?>>List if pension cases pending for more than two months after retirements/death etc.</option>
										<option value="3" <?php  if($insertData['type']==3) { echo 'selected'; } ?>>List of pending pension cases with the Division</option>
										<option value="4" <?php  if($insertData['type']==4) { echo 'selected'; } ?>>List of pending pension cases with the Date of Retirement</option>
										<option value="5" <?php  if($insertData['type']==5) { echo 'selected'; } ?>>All Pension Cases pending for submission and pending for settlement</option>
										<option value="6" <?php  if($insertData['type']==6) { echo 'selected'; } ?>>Pension Cases pending for submission</option>
										<option value="7" <?php  if($insertData['type']==7) { echo 'selected'; } ?>>Pension Cases pending for settlement</option>
										<option value="8" <?php  if($insertData['type']==8) { echo 'selected'; } ?>>Pension Cases settled</option>
										<option value="POPSEF">Status Of Pending old Pension Scheme(Except Family Pension)</option>
									    <option value="POPSOF">Status Of Pending old Pension Scheme(Only Family Pension)</option>
									    <option value="PNPSEF">Status Of Pending New Pension Scheme(Except Family Pension)</option>
									    <option value="PNPSOF">Status Of Pending New Pension Scheme(Only Family Pension)</option>
									</select>
									
                           </div>
                           

								    <div class="form-group">
								    	 <label style="display:block;min-height:18px;"></label>
								   		<select required name = "organisation_name" class="form-control" id = "">
									   <option selected="selected" value="">Select Organisation</option>
									   <option value="All" <?php  if($insertData['org_name']==All) { echo 'selected'; } ?>>All</option>
										<?php
											if(empty($all_organisation))
											{
												echo '<option value="All">'.'Select Organisation'.'</option>';
											}

											else
											{
												foreach ($all_organisation as $organisation)
						                      {?>   
						                      	
						                      	<option  value="<?php echo $organisation->ORGANIZATION_ID ?>" <?php if($insertData['org_name']==$organisation->ORGANIZATION_ID) { echo 'selected'; } ?> >

						                      		<?php echo $organisation->ORGNAME; ?>

						                      	</option>

						                      <?php }}
					                      
					                    ?>
										
									</select>

									<!--Month-->

									<select class="form-control" id="month" name = "month">
									   <option selected="selected" value="">Select Month</option>
										<option value="1" <?php  if($insertData['month']==1) { echo 'selected'; } ?>>1</option>
										<option value="2" <?php  if($insertData['month']==2) { echo 'selected'; } ?>>2</option>
										<option value="3" <?php  if($insertData['month']==3) { echo 'selected'; } ?>>3</option>
										<option value="4" <?php  if($insertData['month']==4) { echo 'selected'; } ?>>4</option>
										<option value="5" <?php  if($insertData['month']==5) { echo 'selected'; } ?>>5</option>
										<option value="6" <?php  if($insertData['month']==6) { echo 'selected'; } ?>>6</option>
										<option value="7" <?php  if($insertData['month']==7) { echo 'selected'; } ?>>7</option>
										<option value="8" <?php  if($insertData['month']==8) { echo 'selected'; } ?>>8</option>
										<option value="9" <?php  if($insertData['month']==9) { echo 'selected'; } ?>>9</option>
										<option value="10" <?php  if($insertData['month']==10) { echo 'selected'; } ?>>10</option>
										<option value="11" <?php  if($insertData['month']==11) { echo 'selected'; } ?>>11</option>
										<option value="12" <?php  if($insertData['month']==12) { echo 'selected'; } ?>>12</option>
									</select>
									
									<!--Division-->
									<select name = "division" class="form-control" id = "divvision">
									   <option selected="selected" value="">Select Division</option>
									   <option value="All">All</option>
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

						                      <?php }}
					                      
					                    		?>
										
									</select>
                                </div>

                                 <div class="form-group">
									<!-- From and To date-->
									<div id="from_datte" style="display:inline-block;">
                                     <label>From Date:</label>
                                     <div class="cal-icon">
									<input type="text" name="from_date" class="form-control datetimepicker"  placeholder="dd-mm-yy" autocomplete="off" value="<?php echo isset($insertData['from_date']) ? $insertData['from_date'] : ''; ?>"/>
									</div>
								    </div>
                                 </div>


								 <div class="form-group">

								<div id="to_datte" style="display:inline-block;">
                                    <label>To Date:</label>
                                     <div class="cal-icon">
									<input type="text" name="to_date" class="form-control datetimepicker"  placeholder="dd-mm-yy" autocomplete="off" value="<?php echo isset($insertData['to_date']) ? $insertData['to_date'] : ''; ?>"/>
									</div>
								   </div>
								 </div>  
								   
								    <div class="form-group">
									 <button type="submit" name = "submit" id ="generate_report" class="btn btn-success btn-search" style="margin-top:20px;">Generate</button>

									<!--  <button type="reset" class="btn btn-danger btn-reset">Reset</button> -->
								    </div>
				
			<?php echo form_close();?>

			<button class="btn btn-danger" style="float:right;margin-bottom:20px;margin-right:20px;" onclick="generateWord()">Download Word<i class="fa fa-arrow-circle-down"></i></button>

			<!-- <button class="btn btn-success" style="float:right;margin-bottom:20px;margin-right:20px;" onclick="saveFile()">Download Excel<i class="fa fa-arrow-circle-down"></i></button> -->
			<button class="btn btn-success" style="float:right;margin-bottom:20px;margin-right:20px;" id="myButtonControlID">Download Excel<i class="fa fa-arrow-circle-down"></i></button>

			<button class="btn btn-warning" style="float:right;margin-bottom:20px;margin-right:20px;" onclick="printJS('pp3', 'html')" type="button">Download PDF<i class="fa fa-arrow-circle-down"></i></button>

			
			<br/>
			
			<div id ="pp1" style="clear:both;">	
				<?php 
					foreach ($all_org_data as $j1) 
					{
						
					?>
						<br/>
						<div class="col-sm-8" style="margin-bottom:25px;padding-left:0;">
							<span><b>Organisation Name:</b></span> <span><?php echo '<b style="color: #f7541d;">'.$j1['organisation_name'].'</b>'; ?></span>	
						</div>
					<div class="col-sm-4 text-right" style="margin-bottom:25px;padding-right:0;">
                       						<span><b>Status as on date:</b></span> <span id="set_date">
                       	<?php 
                       		if(empty($j1['all_data_POPSEF']) && empty($j1['all_data_POPSOF']) && empty($j1['all_data_PNPSEF']) && empty($j1['all_data_POPSOF']))
							 {
							 	echo date('d F Y'); 
							 } 
							 else 
							 	{
									$last_updatedate = $this->Base_model->lastupdatepensionrecored($j1['organisation_id']);
							 		
							 		echo date('d F Y',strtotime($last_updatedate[0]->LASTMODIDATE));

							 		
							 	}
							 ?></span>		
					</div>	

					<?php 

							$a1 = count($j1['all_data_POPSEF']) ;
							$b1 = count($j1['all_data_POPSOF']) ;
							$c1 = count($j1['all_data_PNPSEF']) ;
							$d1 = count($j1['all_data_PNPSOF']) ;
							
							$check_orgn_certificate_status = $this->Base_model->check_existent('penscertificate', array('ORGANISATION'=> $j1['organisation_id'],'STATUS' => 1));

							//print_r($check_orgn_certificate_status);exit;
							if($check_orgn_certificate_status == 1)
							{
								$pension_certificate_data = $this->Base_model->get_record_by_id('penscertificate', array('ORGANISATION'=> $j1['organisation_id'],'STATUS' => 1));

								echo 'It is certified that no pension case in respect of "<b>'.$j1['organisation_name']. '</b>" is pending either with PAO or with this organization/office as on date: '.date('d F, Y',strtotime($pension_certificate_data->CRATEDDATE)).'.</p>   ';
							}

							else
							{
								

							if(empty($a1) && empty($b1) && empty($c1) && empty($d1))
							{
								echo 'No records found.';
							}	

							else if($a1>0 || $b1>0 || $c1>0 || $d1>0)
							{
								$check_certificate_status = $this->Base_model->check_existent('penscertificate', array('ORGANISATION'=> $j1['all_data_POPSEF'][0]->ORGANISATION,'STATUS' => 1));

								if($check_certificate_status=='1')
								{
									echo 'It is certified that no pension case in respect of "<b>'.$j1['organisation_name']. '</b>" is pending either with PAO or with this organization/office as on date: '.date('d F, Y').'.</p>   ';
								}

								else if($check_certificate_status=='0'){?>

								<!--table code-->
		
			<?php

            if($j1['all_data_POPSEF']) { 
            	?>
			<div class="pension-table">
			
			  <h3 style="color:#f05e27;font-size:14px;">A) Status Of Pending old Pension Scheme(Except Family Pension)</h3>
			
			<table border width="100%">
					
							<tr>
							<th  rowspan="2">S.No.</th>
							<th  rowspan="2">Name of the Employee/Pensioner</th>
							<th  rowspan="2">Designation of the Employee/Pensioner</th>
							<th  rowspan="2">Date of Retirement</th>
							<th  colspan="5"></th>
							<th  rowspan="2">Name of the division dealing the pension cases</th>
							<th  colspan="8"></th>
							
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
						 					
                            if($j1['all_data_POPSEF']) {
                           	$i=1;
                            foreach($j1['all_data_POPSEF'] as $POPSEF) { ?>

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
		  
		  <?php } else { ?>
                        <br/><tr><td colspan="9"></td></tr>
                        <?php } ?>
                        <!--2-->
                         <?php
               if($j1['all_data_POPSOF']) { ?>
		 
		  <div class="pension-table">

			  <h3 style="color:#f05e27;font-size:14px;">B) Status Of Pending old Pension Scheme(Only Family Pension)</h3>
			
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
                            if($j1['all_data_POPSOF']) {
                            $i=1;
                            foreach($j1['all_data_POPSOF'] as $POPSOF) { ?>
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
		  

		   <?php } else { ?>
                        <br/><tr><td colspan="9"></td></tr>
                        <?php } ?>
			
                        <!--2 ends-->

                        <!--3-->
                        <?php
               if($j1['all_data_PNPSEF']) {?>
		   <div class="pension-table">
		  
			
			  <h3 style="color:#f05e27;font-size:14px;">C) Status Of Pending New Pension Scheme(Except Family Pension)</h3>
			
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
                            if($j1['all_data_PNPSEF']) {
                            $i=1;
                            foreach($j1['all_data_PNPSEF'] as $PNPSEF) { ?>
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

		  <?php } else { ?>
                        <br/><tr><td colspan="9"></td></tr>
                        <?php } ?>
                        <!--3 ends-->

                        <!--4-->
                         <?php
             if($j1['all_data_PNPSOF']) {?>
		   <div class="pension-table">
		   
			
			  <h3 style="color:#f05e27;font-size:14px;">D) Status Of Pending New Pension Scheme(Only Family Pension)</h3>
			
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
                            if($j1['all_data_PNPSOF']) {
                            $i=1;
                            foreach($j1['all_data_PNPSOF'] as $PNPSOF) { ?>
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

		  <?php } else { ?>
                        <br/><tr><td colspan="9"></td></tr>
                        <?php } ?>
                        <!--4 ends-->
					<!--table code ends-->
                             <?php }}}} ?>

                            </div><!--ends pp1 div-->

   <!--  </div> -->



	

  <!--div pp3 for pdf-->
       <div id = "pp3"  style="visibility:hidden;max-height:20px;overflow:hidden">
				<div class="col-sm-12 text-right" style="margin-bottom:25px;padding-right:0;">
                       <span><b>Status as on date:</b></span> <span id="set_date"><?php echo date('d F Y');?></span>	
				 </div>  
		
				<div id ="" style="clear:both;">	
				<?php 
					foreach ($all_org_data as $j1) 
					{
						
						  $a1 = count($j1['all_data_POPSEF']) ;
							$b1 = count($j1['all_data_POPSOF']) ;
							$c1 = count($j1['all_data_PNPSEF']) ;
							$d1 = count($j1['all_data_PNPSOF']) ;

							$last_updatedate = $this->Base_model->lastupdatepensionrecored($j1['organisation_id']);

							if(empty($a1) && empty($b1) && empty($c1) && empty($d1))
							{
									$lastdate = date('d F Y');
							}

							else
							{
								$lastdate = date('d F Y',strtotime($last_updatedate[0]->LASTMODIDATE));;
							}

					?>
						<br/>
						<div class="col-sm-12" style="width:100%;margin-bottom:40px;padding-left:0;">
							<span><b>Organisation Name:</b></span><span><?php echo '<b style="color: #f7541d;">'.$j1['organisation_name'].'</b>'; ?></span>&nbsp;&nbsp;&nbsp;
							<b><span>Status on Date :</b> <?php echo $lastdate;?></span>
						</div>
						

					<?php 

							$a1 = count($j1['all_data_POPSEF']) ;
							$b1 = count($j1['all_data_POPSOF']) ;
							$c1 = count($j1['all_data_PNPSEF']) ;
							$d1 = count($j1['all_data_PNPSOF']) ;
							
							$check_orgn_certificate_status = $this->Base_model->check_existent('penscertificate', array('ORGANISATION'=> $j1['organisation_id'],'STATUS' => 1));
							
							
							if($check_orgn_certificate_status == 1)
							{
								$pension_certificate_data = $this->Base_model->get_record_by_id('penscertificate', array('ORGANISATION'=> $j1['organisation_id'],'STATUS' => 1));

								echo 'It is certified that no pension case in respect of "<b>'.$j1['organisation_name']. '</b>" is pending either with PAO or with this organization/office as on date: '.date('d F Y',strtotime($pension_certificate_data->CRATEDDATE)).'.</p>   ';
							}

							else
							{
								
							if(empty($a1) && empty($b1) && empty($c1) && empty($d1))
							{
								echo 'No records found.';
							}	

							else if($a1>0 || $b1>0 || $c1>0 || $d1>0)
							{
								$check_certificate_status = $this->Base_model->check_existent('penscertificate', array('ORGANISATION'=> $j1['all_data_POPSEF'][0]->ORGANISATION,'STATUS' => 1));

								if($check_certificate_status=='1')
								{
									echo 'It is certified that no pension case in respect of "<b>'.$j1['organisation_name']. '</b>" is pending either with PAO or with this organization/office as on date: '.date('d F, Y').'.</p>   ';
								}

								else if($check_certificate_status=='0'){?>

								<!--table code-->
		
			<?php

       if($j1['all_data_POPSEF']) { ?>
			<div class="pension-table">
			
			  <h3 style="color:#f05e27;font-size:14px;">A) Status Of Pending old Pension Scheme(Except Family Pension)</h3>
			
			<table border width="100%">
					
							<tr>
							<th  rowspan="2">S.No.</th>
							<th  rowspan="2">Name of the Employee/Pensioner</th>
							<th  rowspan="2">Designation of the Employee/Pensioner</th>
							<th  rowspan="2">Date of Retirement</th>
							<th  colspan="3"></th>
							<th  rowspan="2">Name of the division dealing the pension cases</th>
							<th  colspan="8"></th>
							
						</tr>
									
						 <tr>
							
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
						 					
                            if($j1['all_data_POPSEF']) {
                           	$i=1;
                            foreach($j1['all_data_POPSEF'] as $POPSEF) { ?>

						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $POPSEF->EMPLY_NAME; ?></td>
							<td><?php if(!empty($POPSEF->EMP_DESG)){
								 echo $POPSEF->EMP_DESG; 
								} else { 
									echo 'N/A'; 
								} ?></td>
							<td><?php echo date('d F, Y', strtotime($POPSEF->DATE_RETIREMENT)); ?></td>
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
									echo $POPSEF->DIVIS_DEAL_NAME;
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
			
			
			
		  </div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		  
		  <?php }  ?>
                        <!--2-->
      <?php
           if($j1['all_data_POPSOF']) { ?>
		 
		  <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/> <div class="pension-table">

			  <h3 style="color:#f05e27;font-size:14px;">B) Status Of Pending old Pension Scheme(Only Family Pension)</h3>
			
			<table border width="100%">
					
							<tr>
							<th  rowspan="2">S.No.</th>
							<th  rowspan="2">Name of the Employee</th>
							<th  rowspan="2">Designation of the Employee</th>
							<th  rowspan="2">Date of Death</th>
							<th  rowspan="2">Name of Family Member Eligible for Pension</th>
							<th  colspan="3"></th>
							<th  rowspan="2">Name of the division dealing the pension cases </th>
							<th  colspan="7"></th>
						
						</tr>
									
						 <tr>
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
                            if($j1['all_data_POPSOF']) {
                            $i=1;
                            foreach($j1['all_data_POPSOF'] as $POPSOF) { ?>
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
									echo $POPSOF->DIVIS_DEAL_NAME;
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
		   
		 </div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		  

		   <?php } ?>
			
       <!--2 ends-->
       <!--3-->
        <?php
               if($j1['all_data_PNPSEF']) {?>
		   <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><div class="pension-table">
		  
			
			  <h3 style="color:#f05e27;font-size:14px;">C) Status Of Pending New Pension Scheme(Except Family Pension)</h3>
			
				<table border width="100%">
					
							<tr>
							<th  rowspan="2">S.No.</th>
							<th  rowspan="2">Name of the Pensioner</th>
							<th  rowspan="2">Designation of the Pensioner</th>
							<th  rowspan="2">Date of Retirement</th>
							<th  colspan="3"></th>
							<th  rowspan="2">Name of the division dealing the pension cases</th>
							<th  colspan="7"></th>
							
						</tr>
									
						 <tr>
					
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
                            if($j1['all_data_PNPSEF']) {
                            $i=1;
                            foreach($j1['all_data_PNPSEF'] as $PNPSEF) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $PNPSEF->EMPLY_NAME; ?></td>
							<td><?php if(!empty($PNPSEF->EMP_DESG)){
								 echo $PNPSEF->EMP_DESG; 
								} else { 
									echo 'N/A'; 
								} ?></td>
							<td><?php echo date('d F, Y', strtotime($PNPSEF->DATE_RETIREMENT));?></td>
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
									echo $PNPSEF->DIVIS_DEAL_NAME;
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
						<?php $i++;} } ?>					
						
						
		    </table>

		    
		  </div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
		  <?php } ?>
        <!--3 ends-->

        <!--4-->
                         <?php
             if($j1['all_data_PNPSOF']) {?>
		   <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><div class="pension-table">
		   
			
			  <h3 style="color:#f05e27;font-size:14px;">D) Status Of Pending New Pension Scheme(Only Family Pension)</h3>
			
			<table border width="100%">
					
						<tr>
							<th  rowspan="2">S.No.</th>
							<th  rowspan="2">Name of the Employee</th>
							<th  rowspan="2">Designation of the Employee</th>
							<th  rowspan="2">Date of Death</th>
							<th  colspan="3"></th>
							<th  rowspan="2">Name of the division dealing the pension cases </th>
							<th  colspan="7"></th>			
						</tr>
									
						 <tr>
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
                            if($j1['all_data_PNPSOF']) {
                            $i=1;
                            foreach($j1['all_data_PNPSOF'] as $PNPSOF) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $PNPSOF->EMPLY_NAME; ?></td>
							<td><?php if(!empty($PNPSOF->EMP_DESG)){
								 echo $PNPSOF->EMP_DESG; 
								} else { 
									echo 'N/A'; 
								} ?></td>
							<td><?php echo date('d F, Y', strtotime($PNPSOF->DATE_DEATH));?></td>
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
									echo $PNPSOF->DIVIS_DEAL_NAME;
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
						<?php $i++; } } ?>
									
		    </table>
		    
			
		  </div><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

		  <?php } else { }?>
                       
                        <!--4 ends-->
					<?php 

					 
						$a = empty($j1['all_data_POPSEF']) ? '' : $j1['all_data_POPSEF'];
						$b = empty($j1['all_data_POPSOF']) ? '' : $j1['all_data_POPSOF'];
						$c = empty($j1['all_data_PNPSEF']) ? '' : $j1['all_data_PNPSEF'];
						$d = empty($j1['all_data_PNPSOF']) ? '' : $j1['all_data_PNPSOF'];
												
						if(empty($a) && empty($b) && empty($c) && empty($d))
						{?>
						<span>No records found.</span>
						<?php } ?>
					<!--table code ends-->
							<?php }}}} ?>
               </div><!--ends pp1 div-->                      
        </div><!--div ends pp3-->

<!-- For Excel Generate Code -->
	
	<?php 
	    $get_poposef = array();
 		foreach ($all_org_data as $j1) 
		{
  /******************************************Pension POPSEF Code***************************************/

   
   $i=1;
   foreach ($j1['all_data_POPSEF'] as $popsef_data)
    {
    	$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $popsef_data->PENSION_ID,'STATUS'=>1));

    	$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $popsef_data->PENSION_ID,'STATUS'=>1));

    	$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $popsef_data->PENSION_ID,'STATUS'=>1));

    	/*************annual verification**********/
		if($pension_record_status_data->ANNUAL_VERIFICATION ==0)
		{
			$annnual_verification =  'No';
		}

		else if($pension_record_status_data->ANNUAL_VERIFICATION ==1)
		{
			$annnual_verification = 'Yes';
		}

		else
		{
			$annnual_verification = '';
		}

		/************case  pending with pao**********/

		if($pension_record_status_data->PENDING_PPO ==0)
		{
			$case_pending_pao = 'No';
		}

		else if($pension_record_status_data->PENDING_PPO ==1)
		{
			$case_pending_pao = 'Yes';
		}

		else
		{
			$case_pending_pao = '';
		}
		//
		if($popsef_data->PENSION_PAPER_SUBMIT_STATUS=='Yes')
		{
			$submit_date = date('d F, Y', strtotime($popsef_data->PENSION_PAPER_SUBMIT_DATE));
		}

		else if($popsef_data->PENSION_PAPER_SUBMIT_STATUS=='No')
		{
			$submit_date = '';
		}

		else
		{
			$submit_date = '';
		}
		///
		$a1 = count($j1['all_data_POPSEF']) ;
		$b1 = count($j1['all_data_POPSOF']) ;
		$c1 = count($j1['all_data_PNPSEF']) ;
		$d1 = count($j1['all_data_PNPSOF']) ;

		$check_orgn_certificate_status = $this->Base_model->check_existent('penscertificate', array('ORGANISATION'=> $j1['organisation_id'],'STATUS' => 1));

		  if(empty($a1) && empty($b1) && empty($c1) && empty($d1))
			{
				$check_empty_data =  'No records found.';
			}	

			else
			{
				$check_empty_data =  '';
			}

			if($check_orgn_certificate_status == 1)
			{
								
					$check_orgn_certificate_status_data = 'It is certified that no pension case in respect of "<b>'.$j1['organisation_name']. '</b>" is pending either with PAO or with this organization/office as on date: '.date('d F, Y').'.</p>   '.'<br/>';
			}

			else
			{
				$check_orgn_certificate_status_data = '';
			}


	   $email_data = $pension_contact_data->MOBILENO.','.$pension_contact_data->EMAILID.','.$pension_contact_data->PAN_NO.','.$pension_contact_data->AADHAR_NO;

   		$pension_popsef['Pension Id'] = $i;
   		$pension_popsef['PPO No'] = empty($popsef_data->PPO_NO) ? '':$popsef_data->PPO_NO;
   		$pension_popsef['Name'] = empty($popsef_data->EMPLY_NAME) ? '':$popsef_data->EMPLY_NAME;
   		$pension_popsef['Pension Status'] = empty($popsef_data->PENSION_STATUS) ? '':$popsef_data->PENSION_STATUS;
   		$pension_popsef['Retirement date'] = empty($popsef_data->DATE_RETIREMENT) ? '':$popsef_data->DATE_RETIREMENT;
   		
   		$pension_popsef['Division Name'] = empty($popsef_data->DIVIS_DEAL_NAME) ? '':$popsef_data->DIVIS_DEAL_NAME;
   		$pension_popsef['Pension Paper Submission'] = empty($popsef_data->PENSION_PAPER_SUBMIT_STATUS) ? '':$popsef_data->PENSION_PAPER_SUBMIT_STATUS.' '.$submit_date;
   		$pension_popsef['Annual verification of service book completed'] = empty($annnual_verification) ? '':$annnual_verification;
   		$pension_popsef['Case pending with PAO'] = empty($case_pending_pao) ? '':$case_pending_pao;
   		$pension_popsef['Status of pension papers'] = empty($pension_record_status_data->STATUS_PENS_PAPER) ? '':$pension_record_status_data->STATUS_PENS_PAPER;
   		$pension_popsef['Terminal Benefits Granted'] = empty($pension_record_status_data->TREMINAL_BENIFIT_GRANT) ? '':$pension_record_status_data->TREMINAL_BENIFIT_GRANT;
   		$pension_popsef['Remarks'] = empty($pension_record_remark_data->DESCRIPTION) ? '':$pension_record_remark_data->DESCRIPTION;
   		$pension_popsef['PAO Remarks if any'] = empty($pension_record_remark_data->PAO_DESCRIPTION) ? '':$pension_record_remark_data->PAO_DESCRIPTION;
   		$pension_popsef['check_empty_data'] = $check_empty_data;

   		$pension_popsef['check_orgn_certificate_status_data'] = $check_orgn_certificate_status_data;

   		$get_poposef[] = $pension_popsef;
   		$i++;
   	}	

   }

   	$json_popsef = json_encode($get_poposef);

   	/******************************************Ends Pension POPSEF Code***************************************/


   	/******************************************Pension POPSOF Code******************************************/
   	 $get_poposof = array();
 		foreach ($all_org_data as $j2) 
		{
   		$j = 1;
   		// $get_poposof = array();
		   foreach ($j2['all_data_POPSOF']as $popsof_data)
		    {
		    	$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $popsof_data->PENSION_ID,'STATUS'=>1));

		    	$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $popsof_data->PENSION_ID,'STATUS'=>1));

		    	$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $popsof_data->PENSION_ID,'STATUS'=>1));

		    	/*************annual verification**********/
				if($pension_record_status_data->ANNUAL_VERIFICATION ==0)
				{
					$annnual_verification =  'No';
				}

				else if($pension_record_status_data->ANNUAL_VERIFICATION ==1)
				{
					$annnual_verification = 'Yes';
				}

				else
				{
					$annnual_verification = '';
				}

				/************case  pending with pao**********/

				if($pension_record_status_data->PENDING_PPO ==0)
				{
					$case_pending_pao = 'No';
				}

				else if($pension_record_status_data->PENDING_PPO ==1)
				{
					$case_pending_pao = 'Yes';
				}

				else
				{
					$case_pending_pao = '';
				}
				//
				if($popsof_data->PENSION_PAPER_SUBMIT_STATUS=='Yes')
				{
					$submit_date = date('d F, Y', strtotime($popsof_data->PENSION_PAPER_SUBMIT_DATE));
				}

				else if($popsof_data->PENSION_PAPER_SUBMIT_STATUS=='No')
				{
					$submit_date = '';
				}

				else
				{
					$submit_date = '';
				}


				$email_data = $pension_contact_data->MOBILENO.','.$pension_contact_data->EMAILID.','.$pension_contact_data->PAN_NO.','.$pension_contact_data->AADHAR_NO;

		   		$pension_popsof['Pension Id'] =$j;
		   		$pension_popsof['PPO No'] = empty($popsof_data->PPO_NO) ? '':$popsof_data->PPO_NO;
		   		$pension_popsof['Name'] = empty($popsof_data->EMPLY_NAME) ? '':$popsof_data->EMPLY_NAME;
		   		$pension_popsof['Pension Status'] = empty($popsof_data->PENSION_STATUS) ? '':$popsof_data->PENSION_STATUS;
		   		$pension_popsof['Death of date'] = empty($popsof_data->DATE_DEATH) ? '':$popsof_data->DATE_DEATH;
		   		
		   		$pension_popsof['Division Name'] = empty($popsof_data->DIVIS_DEAL_NAME) ? '':$popsof_data->DIVIS_DEAL_NAME;
		   		$pension_popsof['Pension Paper Submission'] = empty($popsof_data->PENSION_PAPER_SUBMIT_STATUS) ? '':$popsof_data->PENSION_PAPER_SUBMIT_STATUS.' '.$submit_date;
		   		$pension_popsof['Case pending with PAO'] = empty($case_pending_pao) ? '':$case_pending_pao;
		   		$pension_popsof['Status of pension papers'] = empty($pension_record_status_data->STATUS_PENS_PAPER) ? '':$pension_record_status_data->STATUS_PENS_PAPER;
		   		$pension_popsof['Terminal Benefits Granted'] = empty($pension_record_status_data->TREMINAL_BENIFIT_GRANT) ? '':$pension_record_status_data->TREMINAL_BENIFIT_GRANT;
		   		$pension_popsof['Remarks'] = empty($pension_record_remark_data->DESCRIPTION) ? '':$pension_record_remark_data->DESCRIPTION;
		   		$pension_popsof['PAO Remarks if any'] = empty($pension_record_remark_data->PAO_DESCRIPTION) ? '':$pension_record_remark_data->PAO_DESCRIPTION;
		   		

		   		$get_poposof[] = $pension_popsof;
		   		$j++;
		   	}	
		   }

		   	$json_popsof = json_encode($get_poposof);

   	/******************************************Ends Pension POPSOF Code***************************************/

   	/******************************************Pension PNPSEF Code******************************************/
   $get_pnpsef = array();
 		foreach ($all_org_data as $j3) 
		{
   		  $z = 1;
   		   //$get_pnpsef = array();
		   foreach ($j3['all_data_PNPSEF'] as $pnpsef_data)
		    {
		    	$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $pnpsef_data->PENSION_ID,'STATUS'=>1));

		    	$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $pnpsef_data->PENSION_ID,'STATUS'=>1));

		    	$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $pnpsef_data->PENSION_ID,'STATUS'=>1));

		    	/*************annual verification**********/
				if($pension_record_status_data->ANNUAL_VERIFICATION ==0)
				{
					$annnual_verification =  'No';
				}

				else if($pension_record_status_data->ANNUAL_VERIFICATION ==1)
				{
					$annnual_verification = 'Yes';
				}

				else
				{
					$annnual_verification = '';
				}

				/************case  pending with pao**********/

				if($pension_record_status_data->PENDING_PPO ==0)
				{
					$case_pending_pao = 'No';
				}

				else if($pension_record_status_data->PENDING_PPO ==1)
				{
					$case_pending_pao = 'Yes';
				}

				else
				{
					$case_pending_pao = '';
				}

				/////

				if($pnpsef_data->PENSION_PAPER_SUBMIT_STATUS=='Yes')
				{
					$submit_date = date('d F, Y', strtotime($pnpsef_data->PENSION_PAPER_SUBMIT_DATE));
				}

				else if($pnpsef_data->PENSION_PAPER_SUBMIT_STATUS=='No')
				{
					$submit_date = '';
				}

				else
				{
					$submit_date = '';
				}

				$email_data = $pension_contact_data->MOBILENO.','.$pension_contact_data->EMAILID.','.$pension_contact_data->PAN_NO.','.$pension_contact_data->AADHAR_NO;

		   		$pension_pnpsef['Pension Id'] = $z;
		   		$pension_pnpsef['PPO No'] = empty($pnpsef_data->PPO_NO) ? '':$pnpsef_data->PPO_NO;
		   		$pension_pnpsef['Name'] = empty($pnpsef_data->EMPLY_NAME) ? '':$pnpsef_data->EMPLY_NAME;
		   		$pension_pnpsef['Pension Status'] = empty($pnpsef_data->PENSION_STATUS) ? '':$pnpsef_data->PENSION_STATUS;
		   		$pension_pnpsef['Death of retirement'] = empty($pnpsef_data->DATE_RETIREMENT) ? '':$pnpsef_data->DATE_RETIREMENT;
		   		
		   		$pension_pnpsef['Division Name'] = empty($pnpsef_data->DIVIS_DEAL_NAME) ? '':$pnpsef_data->DIVIS_DEAL_NAME;
		   		$pension_pnpsef['Pension Paper Submission'] = empty($pnpsef_data->PENSION_PAPER_SUBMIT_STATUS) ? '':$pnpsef_data->PENSION_PAPER_SUBMIT_STATUS.' '.$submit_date;
		   		$pension_pnpsef['Withdrawl request submit to NSDL'] = empty($pension_record_status_data->WITHDRAWAL_REQ_NSDL) ? '':$pension_record_status_data->WITHDRAWAL_REQ_NSDL;
		   		$pension_pnpsef['Case pending with PAO'] = empty($case_pending_pao) ? '':$case_pending_pao;
		   		$pension_pnpsef['Terminal Benefits Granted'] = empty($pension_record_status_data->TREMINAL_BENIFIT_GRANT) ? '':$pension_record_status_data->TREMINAL_BENIFIT_GRANT;
		   		$pension_pnpsef['Terminal Benefits Not Granted'] = empty($pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT) ? '':$pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT;
		   		$pension_pnpsef['Remarks'] = empty($pension_record_remark_data->DESCRIPTION) ? '':$pension_record_remark_data->DESCRIPTION;
		   		$pension_pnpsef['PAO Remarks if any'] = empty($pension_record_remark_data->PAO_DESCRIPTION) ? '':$pension_record_remark_data->PAO_DESCRIPTION;
		   		
		   		$get_pnpsef[] = $pension_pnpsef;
		   		$z++;
		   	}	

		   }

		   	$json_pnpsef = json_encode($get_pnpsef);

   	/******************************************Ends Pension PNPSEF Code******************************************/

   	/******************************************Pension PNPSOF Code******************************************/
   		 $get_pnpsof = array();
 		foreach ($all_org_data as $j4) 
		{
   		 $v = 1;
   		 //$get_pnpsof = array();
		   foreach ($j4['all_data_PNPSOF'] as $pnpsof_data)
		    {
		    	$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $pnpsof_data->PENSION_ID,'STATUS'=>1));

		    	$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $pnpsof_data->PENSION_ID,'STATUS'=>1));

		    	$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $pnpsof_data->PENSION_ID,'STATUS'=>1));

		    	/*************annual verification**********/
				if($pension_record_status_data->ANNUAL_VERIFICATION ==0)
				{
					$annnual_verification =  'No';
				}

				else if($pension_record_status_data->ANNUAL_VERIFICATION ==1)
				{
					$annnual_verification = 'Yes';
				}

				else
				{
					$annnual_verification = '';
				}

				/************case  pending with pao**********/

				if($pension_record_status_data->PENDING_PPO ==0)
				{
					$case_pending_pao = 'No';
				}

				else if($pension_record_status_data->PENDING_PPO ==1)
				{
					$case_pending_pao = 'Yes';
				}

				else
				{
					$case_pending_pao = '';
				}

				$email_data = $pension_contact_data->MOBILENO.','.$pension_contact_data->EMAILID.','.$pension_contact_data->PAN_NO.','.$pension_contact_data->AADHAR_NO;
				//

				if($pnpsof_data->PENSION_PAPER_SUBMIT_STATUS=='Yes')
				{
					$submit_date = date('d F, Y', strtotime($pnpsof_data->PENSION_PAPER_SUBMIT_DATE));
				}

				else if($pnpsof_data->PENSION_PAPER_SUBMIT_STATUS=='No')
				{
					$submit_date = '';
				}

				else
				{
					$submit_date = '';
				}

		   		$pension_pnpsof['Pension Id'] = $v;
		   		$pension_pnpsof['PPO No'] = empty($pnpsof_data->PPO_NO) ? '':$pnpsof_data->PPO_NO;
		   		$pension_pnpsof['Name'] = empty($pnpsof_data->EMPLY_NAME) ? '':$pnpsof_data->EMPLY_NAME;
		   		$pension_pnpsef['Pension Status'] = empty($pnpsef_data->PENSION_STATUS) ? '':$pnpsef_data->PENSION_STATUS;
		   		$pension_pnpsof['Death of death'] = empty($pnpsof_data->DATE_DEATH) ? '':$pnpsof_data->DATE_DEATH;
		   		
		   		$pension_pnpsof['Division Name'] = empty($pnpsof_data->DIVIS_DEAL_NAME) ? '':$pnpsof_data->DIVIS_DEAL_NAME;
		   		$pension_pnpsof['Pension Paper Submission'] = empty($pnpsof_data->PENSION_PAPER_SUBMIT_STATUS) ? '':$pnpsof_data->PENSION_PAPER_SUBMIT_STATUS.' '.$submit_date;
		   		$pension_pnpsof['Withdrawl request submit to NSDL'] = empty($pension_record_status_data->WITHDRAWAL_REQ_NSDL) ? '':$pension_record_status_data->WITHDRAWAL_REQ_NSDL;
		   		$pension_pnpsof['Case pending with PAO'] = empty($case_pending_pao) ? '':$case_pending_pao;
		   		$pension_pnpsof['Terminal Benefits Granted'] = empty($pension_record_status_data->TREMINAL_BENIFIT_GRANT) ? '':$pension_record_status_data->TREMINAL_BENIFIT_GRANT;
		   		$pension_pnpsof['Terminal Benefits Not Granted'] = empty($pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT) ? '':$pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT;
		   		$pension_pnpsof['Remarks'] = empty($pension_record_remark_data->DESCRIPTION) ? '':$pension_record_remark_data->DESCRIPTION;
		   		$pension_pnpsof['PAO Remarks if any'] = empty($pension_record_remark_data->PAO_DESCRIPTION) ? '':$pension_record_remark_data->PAO_DESCRIPTION;
		   		

		   		$get_pnpsof[] = $pension_pnpsof;
		   		$v++;
		   	}
		   	}	

		   	$json_pnpsof = json_encode($get_pnpsof);

   	/******************************************Ends Pension PNPSOF Code******************************************/
     
   ?>


       <!--PP%5 for excel-->
         <?php

					 foreach ($all_org_data as $j1) 
					{
					$a1 = count($j1['all_data_POPSEF']) ;
					$b1 = count($j1['all_data_POPSOF']) ;
					$c1 = count($j1['all_data_PNPSEF']) ;
					$d1 = count($j1['all_data_PNPSOF']) ;

		            $ab = '';
		            if(empty($a1) && empty($b1) && empty($c1) && empty($d1))
		             {
		             	$ab .= '<div id = "pp8" style="visibility:hidden;"><div class="pension-table">
	
							<table border width="100%" id="" style="border: 1px solid black;" >
					
							 <tr><td colspan="4" style="border: 1px solid black;padding: 5px;"><b> Organisation Name: </b>'.$j1['organisation_name'].' :</td><td colspan="6" style="border: 1px solid black;padding: 5px;"> No records found.<br/><b>Status On Date:</b> '.date('d F, Y').' </td></th></tr>
							 ';

		         	
		             }

		             else if($a1>0 || $b1>0 || $c1>0 || $d1>0)
							{
								$check_certificate_status = $this->Base_model->check_existent('penscertificate', array('ORGANISATION'=> $j1['organisation_id'],'STATUS' => 1));

								$last_updatedate = $this->Base_model->lastupdatepensionrecored($j1['organisation_id']);

								if($check_certificate_status=='1')
								{
									$ab .= '<div id = "pp8" style="visibility:hidden;"><div class="pension-table">
	
											<table border width="100%" id="1" style="border: 1px solid black;" >
									
											 <tr><td colspan="4" style="border: 1px solid black;padding: 5px;" >'.$j1['organisation_name'].' : </td><td colspan="6" style="border: 1px solid black;padding: 5px;">It is certified that no pension case in respect of "<b>'.$j1['organisation_name']. '</b>" is pending either with PAO or with this organization/office as on date:'.date('d F, Y').'</td></tr>
											 <tr></tr>';

							
								}


		            

		             else
		             {
		             	   

		             	$ab .= '<div id = "pp8" style="visibility:hidden;"><div class="pension-table">
	
							<table border width="100%" id="1" style="border: 1px solid black;" >
					
					<tr><td colspan="4" style="border: 1px solid black;padding: 5px;"><b> Organisation Name: </b>'.$j1['organisation_name'].' :</td><td colspan="6" style="border: 1px solid black;padding: 5px;"><b>Status On Date:</b> '.date('d F Y',strtotime($last_updatedate[0]->LASTMODIDATE)).' </td></th></tr>

					 <tr><td colspan="4">A) Status Of Pending old Pension Scheme(Except Family Pension)</td></tr>
						<tr>
							
							<th style="border: 1px solid black;padding: 5px;">Name of the Employee/Pensioner</th>
							<th style="border: 1px solid black;padding: 5px;">Designation of the Employee/Pensioner</th>
							<th style="border: 1px solid black;padding: 5px;">Pension Status</th>
							<th style="border: 1px solid black;padding: 5px;">Date of Retirement</th>
				
							 <th style="border: 1px solid black;padding: 5px;">Name of the division dealing the pension cases</th>
							 <th style="border: 1px solid black;padding: 5px;">Whether pension paper has been submitted</th>
							 <th style="border: 1px solid black;padding: 5px;">Whether Verification of service book completed</th>
							 <th style="border: 1px solid black;padding: 5px;">Whether the case is pending with PAO(YES/No)</th>
							 <th style="border: 1px solid black;padding: 5px;">PPO Number if issued</th>
							 <th style="border: 1px solid black;padding: 5px;">If PPO no. is yet to be issued, the status of pension papers</th>
							 <th style="border: 1px solid black;padding: 5px;">Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP, LE, CGEGIS etc)</th>
							 <th style="border: 1px solid black;padding: 5px;">Remarks</th>
							  <th style="border: 1px solid black;padding: 5px;">PAO Remarks if any</th>
						 </tr>';
		            
					  
						 
                            if($j1['all_data_POPSEF']) {

                           	
                            foreach($j1['all_data_POPSEF'] as $POPSEF) {

                            if($POPSEF->ANNUAL_VERIFICATION == 1)
                            {
                            	$annual = 'Yes';
                            }

                            else if($POPSEF->ANNUAL_VERIFICATION== 0)
                            {
                            	$annual = 'No';
                            }
                            else
                            {
                            	$annual = '';
                            }

                            if($POPSEF->PENDING_PPO == 1)
                            {
                            	$case_pending = 'Yes';
                            }

                            else if($POPSEF->PENDING_PPO== 0)
                            {
                            	$case_pending = 'No';
                            }
                            else
                            {
                            	$case_pending = '';
                            }
							$ab .= '<tr>
							
							<td style="border: 1px solid black;padding: 5px;">'.$POPSEF->EMPLY_NAME.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSEF->PENSION_STATUS.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSEF->EMP_DESG.'</td>

							<td style="border: 1px solid black;padding: 5px;">'.date('d F, Y', strtotime($POPSEF->DATE_RETIREMENT)).'</td>
					
							<td style="border: 1px solid black;padding: 5px;">'.$POPSEF->DIVIS_DEAL_NAME.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSEF->PENSION_PAPER_SUBMIT_STATUS.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$annual.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$case_pending.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSEF->PPO_NO.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSEF->STATUS_PENS_PAPER.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSEF->TREMINAL_BENIFIT_GRANT.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSEF->DESCRIPTION.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSEF->PAO_DESCRIPTION.'</td>

						</tr>';

						} } ;

						//Section B
						 if(empty($j1['all_data_POPSOF']))
		             	{
		             	$ab .= '
					 	<tr></tr>';
		             	}

		             else
		             {
		             	$ab .=' <tr><td>B) Status Of Pending old Pension Scheme(Only Family Pension)</td></tr>
						<tr>
						
							<th >Name of the Employee</th>
							<th >Designation of the Employee</th>
							<th >Pension Status</th>
							<th >Date of Death</th>
							<th >Name of Family Member Eligible for Pension</th>
					
							 <th >Name of the division dealing the pension cases </th>
							 <th>Whether pension paper has been submitted</th>

							 <th >Whether the case is pending with PAO(YES/No)</th>
							 <th >PPO Number if issued</th>
							 <th >If PPO no. is yet to be issued, the status of pension papers</th>
							 <th >Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP, LE, CGEGIS etc)</th>

							 <th >Remarks</th>
							 <th >PAO Remarks if any</th>
						 </tr>';
		             }
						

						    if($j1['all_data_POPSOF']) {
                            $i=1;
                            foreach($j1['all_data_POPSOF'] as $POPSOF) {
                            if($POPSOF->ANNUAL_VERIFICATION == 1)
                            {
                            	$annual = 'Yes';
                            }

                            else if($POPSOF->ANNUAL_VERIFICATION== 0)
                            {
                            	$annual = 'No';
                            }
                            else
                            {
                            	$annual = '';
                            }

                            if($POPSOF->PENDING_PPO == 1)
                            {
                            	$case_pending = 'Yes';
                            }

                            else if($POPSOF->PENDING_PPO== 0)
                            {
                            	$case_pending = 'No';
                            }
                            else
                            {
                            	$case_pending = '';
                            }
                            	$ab .= '<tr>
							
							<td style="border: 1px solid black;padding: 5px;">'.$POPSOF->EMPLY_NAME.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSOF->EMP_DESG.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSOF->PENSION_STATUS.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.date('d F, Y', strtotime($POPSOF->DATE_DEATH)).'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSOF->FAMILYMEM_NAME.'</td>
							
					
							<td style="border: 1px solid black;padding: 5px;">'.$POPSOF->DIVIS_DEAL_NAME.'	</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSOF->PENSION_PAPER_SUBMIT_STATUS.'	</td>
							
							<td style="border: 1px solid black;padding: 5px;">'.$case_pending.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSOF->PPO_NO.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSOF->STATUS_PENS_PAPER.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSOF->TREMINAL_BENIFIT_GRANT.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$POPSOF->DESCRIPTION.'</td><td style="border: 1px solid black;padding: 5px;">'.$POPSOF->PAO_DESCRIPTION.'</td>
						</tr>';
						
						 } };

						 //Section C

						 if(empty($j1['all_data_PNPSEF']))
		             	{
		             	$ab .= '
					 		<tr></tr>';
		             	}

		             	else
		             	{
		             		$ab .=' <tr><td>C) Status Of Pending New Pension Scheme(Except Family Pension)</td></tr>
						<tr>
						
							<th >Name of the Pensioner</th>
							<th >Designation of the Pensioner</th>
							<th >Pension Status</th>
							<th >Date of Retirement</th>
				
							 <th >Name of the division dealing the pension cases</th>
							 <th>Whether pension paper has been submitted</th>
							 <th >Whether withdrawal request submitted to NSDL </th>
							 <th >Whether terminal benefits granted(Provide specific details w.r.t, LE, CGEGIS, Service Gratuity, Retirement Gratuity  etc.)</th>
							 <th >Whether the case is pending with PAO(YES/No)</th>
							
							 <th >Status of the terminal benifits if not granted</th>
							 <th >Remarks</th>
							 <th >PAO Remarks if any</th>
						 </tr>';
		             	}

						 		

						    if($j1['all_data_PNPSEF']) {
                            $i=1;
                            foreach($j1['all_data_PNPSEF'] as $PNPSEF) {
                            if($PNPSEF->ANNUAL_VERIFICATION == 1)
                            {
                            	$annual = 'Yes';
                            }

                            else if($PNPSEF->ANNUAL_VERIFICATION== 0)
                            {
                            	$annual = 'No';
                            }
                            else
                            {
                            	$annual = '';
                            }

                            if($PNPSEF->PENDING_PPO == 1)
                            {
                            	$case_pending = 'Yes';
                            }

                            else if($PNPSEF->PENDING_PPO== 0)
                            {
                            	$case_pending = 'No';
                            }
                            else
                            {
                            	$case_pending = '';
                            }
                            	$ab .= '<tr>
							
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSEF->EMPLY_NAME.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSEF->EMP_DESG.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSEF->PENSION_STATUS.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.date('d F, Y', strtotime($PNPSEF->DATE_RETIREMENT)).'</td>
					
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSEF->DIVIS_DEAL_NAME.'	</td>
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSEF->PENSION_PAPER_SUBMIT_STATUS.'	</td>
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSEF->WITHDRAWAL_REQ_NSDL.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSEF->TREMINAL_BENIFIT_GRANT.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$case_pending.'</td>
							
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSEF->STATUS_TERM_BENI_NOT_GRANT.'</td>	
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSEF->DESCRIPTION.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSEF->PAO_DESCRIPTION.'</td>
						</tr>';
						
						 } };

						 //Section D

						 	if(empty($j1['all_data_PNPSOF']))
		             	{
		             	$ab .= '
					 		<tr></tr>';
		             	}

		             	else
		             	{
		             		$ab .=' <tr><td>D) Status Of Pending New Pension Scheme(Only Family Pension)</td></tr>
		             	
						<tr>
						
							<th >Name of the Employee</th>
							<th >Designation of the Employee</th>
							<th >Pension Status</th>
							<th >Date of Death</th>
					
							 <th >Name of the division dealing the pension cases</th>
							 <th>Whether pension paper has been submitted</th>

							 <th >Whether withdrawal request submitted to NSDL </th>
							 <th >Whether terminal benefits granted(Provide specific details w.r.t, LE, CGEGIS, Service Gratuity, Retirement Gratuity  etc.)</th>
							 <th >Whether the case is pending with PAO(YES/No)</th>
							 <th >Status of the terminal benifits if not granted</th>

							 <th >Remarks</th>
							  <th >PAO Remarks if any</th>
						 </tr>';
		             	}
						 	

						    if($j1['all_data_PNPSOF']) {
                            $i=1;
                            foreach($j1['all_data_PNPSOF'] as $PNPSOF) {
                            if($PNPSOF->ANNUAL_VERIFICATION == 1)
                            {
                            	$annual = 'Yes';
                            }

                            else if($PNPSOF->ANNUAL_VERIFICATION== 0)
                            {
                            	$annual = 'No';
                            }
                            else
                            {
                            	$annual = '';
                            }

                            if($PNPSOF->PENDING_PPO == 1)
                            {
                            	$case_pending = 'Yes';
                            }

                            else if($PNPSOF->PENDING_PPO== 0)
                            {
                            	$case_pending = 'No';
                            }
                            else
                            {
                            	$case_pending = '';
                            }
                            	$ab .= '<tr>
							
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSOF->EMPLY_NAME.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSOF->EMP_DESG.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSOF->PENSION_STATUS.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.date('d F, Y', strtotime($PNPSOF->DATE_DEATH)).'</td>
							
							
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSOF->DIVIS_DEAL_NAME.'	</td>
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSOF->PENSION_PAPER_SUBMIT_STATUS.'	</td>

							<td style="border: 1px solid black;padding: 5px;">'.$PNPSOF->WITHDRAWAL_REQ_NSDL.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSOF->TREMINAL_BENIFIT_GRANT.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$case_pending.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSOF->STATUS_TERM_BENI_NOT_GRANT.'</td>
						
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSOF->DESCRIPTION.'</td>
							<td style="border: 1px solid black;padding: 5px;">'.$PNPSOF->PAO_DESCRIPTION.'</td>
						</tr>';
						
						 } }}};

					    $ab .='</table>
					  </div>
				      </div>';
				     
				     	$excel_table[]= $ab;

			            }    

			        $newccAddress = implode(" ", $excel_table);
  					
  					echo '</div>';          
  			?>

				   
  				<div id = "pp7" style="max-height:20px;overflow:hidden">
  					<?php echo $newccAddress; ?>
  				</div>


  </div> <!-- end container class -->				
                  
                   
         <!--PP%5 for excel-->


   <!-- Current Date-->
		<?php

			$current_timestamp = strtotime("now");
			$current_date =  date("d F Y", $current_timestamp);
			$json_current_date = json_encode($current_date);

 		?>
<?php

			 $json_organisation = json_encode($organisation_name);
?>
<!-- Ends excel generate code -->

  <!-- Selected data-->
 		<?php

			 $json_selected_type = json_encode($insertData['select_type']);
			
		?>

		      <!-- Selected data-->
 		<?php

			 $json_selected_division = json_encode($insertData['division']);
			 $json_selected_month = json_encode($insertData['month']);
			 $json_selected_from_date = json_encode($insertData['from_date']);
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

		  	var selected_division 	  = <?php echo $json_selected_division; ?>;
				var selected_month 	  = <?php echo $json_selected_month; ?>;
				var selected_from_date = <?php echo $json_selected_from_date; ?>;
				
				if(selected_division.length != 0)
				{
		
					$("#divvision").show();
					$("#month").hide();
					$("#from_datte").hide();
					$("#to_datte").hide();
				}

				else if(selected_month.length != 0)
				{
					$("#month").show();
					$("#divvision").hide();
					$("#from_datte").hide();
					$("#to_datte").hide();
				}
				else if(selected_from_date.length != 0)
				{
					
					$("#from_datte").show();
					$("#to_datte").show();
					$("#divvision").hide();
					$("#month").hide();
					
				}


				//////////
				else
				{
					
					$("#month").hide();
					$("#divvision").hide();
					$("#from_datte").hide();
					$("#to_datte").hide();
				}

				$('#selecct_type').on('change', function() {

					if(this.value =='2')
					  {
						$("#month").show();
						$("#divvision").hide();
						$("#from_datte").hide();
					  	$("#to_datte").hide();
					  }

					else if(this.value =='1')
					  {
						$("#month").hide();
						$("#divvision").hide();
						$("#from_datte").hide();
						$("#to_datte").hide();
					  }


					else if(this.value =='3')
					  {
						$("#divvision").show();
						$("#month").hide();
						$("#from_datte").hide();
					  	$("#to_datte").hide();
					  }

					 else if(this.value =='4')
					  {
					  	$("#from_datte").show();
					  	$("#to_datte").show();
						$("#divvision").hide();
						$("#month").hide();
					  }

					  else if(this.value =='5')
					  {
						$("#month").hide();
						$("#divvision").hide();
						$("#from_datte").hide();
						$("#to_datte").hide();
					  }


					  else if(this.value =='6')
					  {
						$("#month").hide();
						$("#divvision").hide();
						$("#from_datte").hide();
						$("#to_datte").hide();
					  }

					  else if(this.value =='7')
					  {
						$("#month").hide();
						$("#divvision").hide();
						$("#from_datte").hide();
						$("#to_datte").hide();
					  }

					  else if(this.value =='8')
					  {
						$("#month").hide();
						$("#divvision").hide();
						$("#from_datte").hide();
						$("#to_datte").hide();
					  }

					  else if(this.value =='9')
					  {
						$("#month").hide();
						$("#divvision").hide();
						$("#from_datte").hide();
						$("#to_datte").hide();
					  }

				    else
			   		 {
				   		$("#month").hide();  
				   	 }


					});//function ends
			
			
			
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

		    	 //function for generate word

			 function generateWord(){
					    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
					    var postHtml = "</body></html>";
					    var html = preHtml+document.getElementById('pp1').innerHTML+postHtml;
					  

					    var blob = new Blob(['\ufeff', html], {
					        type: 'application/msword'
					    });
					    
					    // Specify link url
					    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
					    
					    // Specify file name
					    var filename = 'pension_report';
					    filename = filename?filename+'.doc':'document.doc';
					    
					    // Create download link element
					    var downloadLink = document.createElement("a");

					    document.body.appendChild(downloadLink);
					    
					    if(navigator.msSaveOrOpenBlob ){
					        navigator.msSaveOrOpenBlob(blob, filename);
					    }else{
					        // Create a link to the file
					        downloadLink.href = url;
					        
					        // Setting the file name
					        downloadLink.download = filename;
					        
					        //triggering the function
					        downloadLink.click();
					    }
					    
					    document.body.removeChild(downloadLink);
					}//ends function

								/**********Code for excel**********/

			window.saveFile = function saveFile () {
            var popsef_Array = <?php echo $json_popsef; ?>;
            var popsof_Array = <?php echo $json_popsof; ?>;
            var pnpsef_Array = <?php echo $json_pnpsef; ?>;
            var pnpsof_Array = <?php echo $json_pnpsof; ?>;
            var organisation = <?php echo $json_organisation; ?>;
           /* var ccertificate = <?php// echo $json_certificate; ?>;*/
           console.log(popsef_Array);
           alert(popsef_Array); return false;
             var output = <?php echo $json_current_date; ?>;
			 var ccertificate ='0';  


			var data1 = popsef_Array;
		    var data2 = popsof_Array;
		    var data3 = pnpsef_Array;
		    var data4 = pnpsof_Array;
		 // console.log(data1); return false;
		   if(ccertificate == '1')
			 {
			 	var data_text = [{[organisation]:' : It is certified that no pension case in respect of "'+organisation+' "  is pending either with PAO or with this organization/office as on date: '+output+'.'}];

			 	var opts = [{sheetid:'Annexure A',header:true}];
			    var res = alasql('SELECT INTO XLSX("Pension_report.xlsx",?) FROM ?',
			                     [opts,[data_text]]);


			 }// ends if

			else
			{

				/**********data1***********/
			  	if(data1.length==0)
			  	{
			  		var data1 = [{'Pension Id':'','PPO No':'','Name of the Employee/Pensione':'','Pension Status':'','Retirement date':'','Division Name':'','Pension Paper Submission':'','Annual verification of service book completed':'','Case pending with PAO':'','Status of pension papers':'','Terminal Benefits Granted':'','Remarks':'','PAO Remarks if any':''}];
			  	}

			  	else
			  	{
			  		var data1 = data1;
			  	}

			  	/**********data2***********/
			  	if(data2.length==0)
			  	{
			  		var data2 = [{'Pension Id':'','PPO No':'','Name of the Employee/Pensione':'','Pension Status':'','Date of death':'','Division Name':'','Pension Paper Submission':'','Case pending with PAO':'','Status of pension papers':'','Terminal Benefits Granted':'','Remarks':'','PAO Remarks if any':''}];
			  	}

			  	else
			  	{
			  		var data2 = data2;
			  	}

			  	/**********data3***********/
			  	if(data3.length==0)
			  	{
			  		var data3 = [{'Pension Id':'','PPO No':'','Name of the Employee/Pensione':'','Pension Status':'','Date of retirement':'','Division Name':'','Pension Paper Submission':'','Withdrawl request submit to NSDL':'','Case pending with PAO':'','Terminal Benefits Granted':'','Terminal Benefits Not Granted':'','Remarks':'','PAO Remarks if any':''}];
			  	}

			  	else
			  	{
			  		var data3 = data3;
			  	}

			  	/**********data4***********/
			  	if(data4.length==0)
			  	{
			  		var data4 = [{'Pension Id':'','PPO No':'','Name of the Employee/Pensione':'','Pension Status':'','Death of death':'','Division Name':'','Pension Paper Submission':'','Withdrawl request submit to NSDL':'','Case pending with PAO':'','Terminal Benefits Granted':'','Terminal Benefits Not Granted':'','Remarks':'','PAO Remarks if any':''}];
			  	}

			  	else
			  	{
			  		var data4 = data4;
			  	}
			  	
			    	var opts = [{sheetid:'Annexure A',header:true},{sheetid:'Annexure B ',header:true},{sheetid:'Annexure C',header:true},{sheetid:'Annexure D',header:true}];
			    	var res = alasql('SELECT INTO XLSX("Pension_report.xlsx",?) FROM ?',
			                     [opts,[data1,data2,data3,data4]]);

			}// ends else
		  	
		    
			}//ends function


			//
			$("[id$=myButtonControlID]").click(function(e) {
			    window.open('data:application/vnd.ms-excel,' + encodeURIComponent( $('div[id$=pp7]').html()));
			    e.preventDefault();
			});

	
		    
		
		
		
  </script>


  