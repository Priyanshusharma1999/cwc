   <?php 
	

  /******************************************Pension POPSEF Code***************************************/

   $get_poposef = array();
   $i=1;
   foreach ($all_data_POPSEF as $popsef_data)
	{
		$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $popsef_data->PENSION_ID,'STATUS'=>1));

		$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $popsef_data->PENSION_ID,'STATUS'=>1));

		$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $popsef_data->PENSION_ID,'STATUS'=>1));

		/*************annual verification**********/
		if($popsef_data->ANNUAL_VERIFICATION ==0)
		{
			$annnual_verification =  'No';
		}

		else if($popsef_data->ANNUAL_VERIFICATION ==1)
		{
			$annnual_verification = 'Yes';
		}

		else
		{
			$annnual_verification = '';
		}

		/************case  pending with pao**********/

		if($popsef_data->PENDING_PPO ==0)
		{
			$case_pending_pao = 'No';
		}

		else if($popsef_data->PENDING_PPO ==1)
		{
			$case_pending_pao = 'Yes';
		}

		else
		{
			$case_pending_pao = '';
		}

		 $email_data = $pension_contact_data->MOBILENO.','.$pension_contact_data->EMAILID.','.$pension_contact_data->PANText.','.$pension_contact_data->Adhartext;
		$pension_popsef['Pension Id'] = $i;
		$pension_popsef['PPO No'] = empty($popsef_data->PPO_NO) ? '':$popsef_data->PPO_NO;
		$pension_popsef['Name'] = empty($popsef_data->EMPLY_NAME) ? '':$popsef_data->EMPLY_NAME;
		$pension_popsef['Retirement date'] = empty($popsef_data->DATE_RETIREMENT) ? '':$popsef_data->DATE_RETIREMENT;
		$pension_popsef['Mobile No'] = empty($popsef_data->MOBILENO) ? '':$popsef_data->MOBILENO;
		$pension_popsef['Mobile No,Email,Pan,Adhar'] =  empty($email_data) ? '':$email_data;
		$pension_popsef['Address'] = empty($popsef_data->ADDRESS) ? '':$popsef_data->ADDRESS;
		$pension_popsef['Division Name'] = empty($popsef_data->DIVIS_DEAL_NAME) ? '':$popsef_data->DIVIS_DEAL_NAME;
		$pension_popsef['Annual verification of service book completed'] = empty($annnual_verification) ? '':$annnual_verification;
		$pension_popsef['Case pending with PAO'] = empty($case_pending_pao) ? '':$case_pending_pao;
		$pension_popsef['Status of pension papers'] = empty($popsef_data->STATUS_PENS_PAPER) ? '':$popsef_data->STATUS_PENS_PAPER;
		$pension_popsef['Terminal Benefits Granted'] = empty($popsef_data->TREMINAL_BENIFIT_GRANT) ? '':$popsef_data->TREMINAL_BENIFIT_GRANT;
		$pension_popsef['Remarks'] = empty($popsef_data->DESCRIPTION) ? '':$popsef_data->DESCRIPTION;

		$get_poposef[] = $pension_popsef;
		$i++;
	}	

	$json_popsef = json_encode($get_poposef);

	/******************************************Ends Pension POPSEF Code***************************************/


	/******************************************Pension POPSOF Code******************************************/
		$j = 1;
		 $get_poposof = array();
		   foreach ($all_data_POPSOF as $popsof_data)
			{
				$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $popsof_data->PENSION_ID,'STATUS'=>1));

				$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $popsof_data->PENSION_ID,'STATUS'=>1));

				$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $popsof_data->PENSION_ID,'STATUS'=>1));

				/*************annual verification**********/
				if($popsof_data->ANNUAL_VERIFICATION ==0)
				{
					$annnual_verification =  'No';
				}

				else if($popsof_data->ANNUAL_VERIFICATION ==1)
				{
					$annnual_verification = 'Yes';
				}

				else
				{
					$annnual_verification = '';
				}

				/************case  pending with pao**********/

				if($popsof_data->PENDING_PPO ==0)
				{
					$case_pending_pao = 'No';
				}

				else if($popsof_data->PENDING_PPO ==1)
				{
					$case_pending_pao = 'Yes';
				}

				else
				{
					$case_pending_pao = '';
				}

				 $email_data = $pension_contact_data->MOBILENO.','.$pension_contact_data->EMAILID.','.$pension_contact_data->PANText.','.$pension_contact_data->Adhartext;
				$pension_popsof['Pension Id'] =$j;
				$pension_popsof['PPO No'] = empty($popsof_data->PPO_NO) ? '':$popsof_data->PPO_NO;
				$pension_popsof['Name'] = empty($popsof_data->EMPLY_NAME) ? '':$popsof_data->EMPLY_NAME;
				$pension_popsof['Death of date'] = empty($popsof_data->DATE_DEATH) ? '':$popsof_data->DATE_DEATH;
				$pension_popsof['Mobile No'] = empty($popsof_data->MOBILENO) ? '':$popsof_data->MOBILENO;
				$pension_popsof['Mobile No,Email,Pan,Adhar'] = empty($email_data) ? '':$email_data;
				$pension_popsof['Address'] = empty($popsof_data->ADDRESS) ? '':$popsof_data->ADDRESS;
				$pension_popsof['Division Name'] = empty($popsof_data->DIVIS_DEAL_NAME) ? '':$popsof_data->DIVIS_DEAL_NAME;
				
				$pension_popsof['Case pending with PAO'] = empty($case_pending_pao) ? '':$case_pending_pao;
				$pension_popsof['Status of pension papers'] = empty($popsof_data->STATUS_PENS_PAPER) ? '':$popsof_data->STATUS_PENS_PAPER;
				$pension_popsof['Terminal Benefits Granted'] = empty($popsof_data->TREMINAL_BENIFIT_GRANT) ? '':$popsof_data->TREMINAL_BENIFIT_GRANT;
				$pension_popsof['Remarks'] = empty($popsof_data->DESCRIPTION) ? '':$popsof_data->DESCRIPTION;

				$get_poposof[] = $pension_popsof;
				$j++;
			}	

			$json_popsof = json_encode($get_poposof);

	/******************************************Ends Pension POPSOF Code***************************************/

	/******************************************Pension PNPSEF Code******************************************/
		  $z = 1;
		   $get_pnpsef = array();
		   foreach ($all_data_PNPSEF as $pnpsef_data)
			{
				$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $pnpsef_data->PENSION_ID,'STATUS'=>1));

				$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $pnpsef_data->PENSION_ID,'STATUS'=>1));

				$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $pnpsef_data->PENSION_ID,'STATUS'=>1));

				/*************annual verification**********/
				if($pnpsef_data->ANNUAL_VERIFICATION ==0)
				{
					$annnual_verification =  'No';
				}

				else if($pnpsef_data->ANNUAL_VERIFICATION ==1)
				{
					$annnual_verification = 'Yes';
				}

				else
				{
					$annnual_verification = '';
				}

				/************case  pending with pao**********/

				if($pnpsef_data->PENDING_PPO ==0)
				{
					$case_pending_pao = 'No';
				}

				else if($pnpsef_data->PENDING_PPO ==1)
				{
					$case_pending_pao = 'Yes';
				}

				else
				{
					$case_pending_pao = '';
				}

				$email_data = $pension_contact_data->MOBILENO.','.$pension_contact_data->EMAILID.','.$pension_contact_data->PANText.','.$pension_contact_data->Adhartext;
				
				$pension_pnpsef['Pension Id'] = $z;
				$pension_pnpsef['PPO No'] = empty($pnpsef_data->PPO_NO) ? '':$pnpsef_data->PPO_NO;
				$pension_pnpsef['Name'] = empty($pnpsef_data->EMPLY_NAME) ? '':$pnpsef_data->EMPLY_NAME;
				$pension_pnpsef['Death of retirement'] = empty($pnpsef_data->DATE_RETIREMENT) ? '':$pnpsef_data->DATE_RETIREMENT;
				$pension_pnpsef['Mobile No'] = empty($pnpsef_data->MOBILENO) ? '':$pnpsef_data->MOBILENO;
				$pension_pnpsef['Mobile No,Email,Pan,Adhar'] = empty($email_data) ? '':$email_data;
				$pension_pnpsef['Address'] = empty($pnpsef_data->ADDRESS) ? '':$pnpsef_data->ADDRESS;
				$pension_pnpsef['Division Name'] = empty($pnpsef_data->DIVIS_DEAL_NAME) ? '':$pnpsef_data->DIVIS_DEAL_NAME;
				
				$pension_pnpsef['Withdrawl request submit to NSDL'] = empty($pnpsef_data->WITHDRAWAL_REQ_NSDL) ? '':$pnpsef_data->WITHDRAWAL_REQ_NSDL;
				$pension_pnpsef['Case pending with PAO'] = empty($case_pending_pao) ? '':$case_pending_pao;
				$pension_pnpsef['Terminal Benefits Granted'] = empty($pnpsef_data->TREMINAL_BENIFIT_GRANT) ? '':$pnpsef_data->TREMINAL_BENIFIT_GRANT;
				$pension_pnpsef['Terminal Benefits Not Granted'] = empty($pnpsef_data->STATUS_TERM_BENI_NOT_GRANT) ? '':$pnpsef_data->STATUS_TERM_BENI_NOT_GRANT;
				$pension_pnpsef['Remarks'] = empty($pnpsef_data->DESCRIPTION) ? '':$pnpsef_data->DESCRIPTION;

				$get_pnpsef[] = $pension_pnpsef;
				$z++;
			}	

			$json_pnpsef = json_encode($get_pnpsef);

	/******************************************Ends Pension PNPSEF Code******************************************/

	/******************************************Pension PNPSOF Code******************************************/

		 $v = 1;
		 $get_pnpsof = array();
		   foreach ($all_data_PNPSOF as $pnpsof_data)
			{
				$pension_contact_data = $this->Base_model->get_record_by_id('penscontinfo', array('PENSION_ID' => $pnpsof_data->PENSION_ID,'STATUS'=>1));

				$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $pnpsof_data->PENSION_ID,'STATUS'=>1));

				$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $pnpsof_data->PENSION_ID,'STATUS'=>1));

				/*************annual verification**********/
				if($pnpsof_data->ANNUAL_VERIFICATION ==0)
				{
					$annnual_verification =  'No';
				}

				else if($pnpsof_data->ANNUAL_VERIFICATION ==1)
				{
					$annnual_verification = 'Yes';
				}

				else
				{
					$annnual_verification = '';
				}

				/************case  pending with pao**********/

				if($pnpsof_data->PENDING_PPO ==0)
				{
					$case_pending_pao = 'No';
				}

				else if($pnpsof_data->PENDING_PPO ==1)
				{
					$case_pending_pao = 'Yes';
				}

				else
				{
					$case_pending_pao = '';
				}

				$email_data = $pension_contact_data->MOBILENO.','.$pension_contact_data->EMAILID.','.$pension_contact_data->PANText.','.$pension_contact_data->Adhartext;
				$pension_pnpsof['Pension Id'] = $v;
				$pension_pnpsof['PPO No'] = empty($pnpsof_data->PPO_NO) ? '':$pnpsof_data->PPO_NO;
				$pension_pnpsof['Name'] = empty($pnpsof_data->EMPLY_NAME) ? '':$pnpsof_data->EMPLY_NAME;
				$pension_pnpsof['Death of death'] = empty($pnpsof_data->DATE_DEATH) ? '':$pnpsof_data->DATE_DEATH;
				$pension_pnpsof['Mobile No'] = empty($pnpsof_data->MOBILENO) ? '':$pnpsof_data->MOBILENO;
				$pension_pnpsof['Mobile No,Email,Pan,Adhar'] = empty($email_data) ? '':$email_data;
				$pension_pnpsof['Address'] = empty($pnpsof_data->ADDRESS) ? '':$pnpsof_data->ADDRESS;
				$pension_pnpsof['Division Name'] = empty($pnpsof_data->DIVIS_DEAL_NAME) ? '':$pnpsof_data->DIVIS_DEAL_NAME;
				
				$pension_pnpsof['Withdrawl request submit to NSDL'] = empty($pnpsof_data->WITHDRAWAL_REQ_NSDL) ? '':$pnpsof_data->WITHDRAWAL_REQ_NSDL;
				$pension_pnpsof['Case pending with PAO'] = empty($case_pending_pao) ? '':$case_pending_pao;
				$pension_pnpsof['Terminal Benefits Granted'] = empty($pnpsof_data->TREMINAL_BENIFIT_GRANT) ? '':$pnpsof_data->TREMINAL_BENIFIT_GRANT;
				$pension_pnpsof['Terminal Benefits Not Granted'] = empty($pnpsof_data->STATUS_TERM_BENI_NOT_GRANT) ? '':$pnpsof_data->STATUS_TERM_BENI_NOT_GRANT;
				$pension_pnpsof['Remarks'] = empty($pnpsof_data->DESCRIPTION) ? '':$pnpsof_data->DESCRIPTION;

				$get_pnpsof[] = $pension_pnpsof;
				$v++;
			}	

			$json_pnpsof = json_encode($get_pnpsof);

	/******************************************Ends Pension PNPSOF Code******************************************/

   ?>
   <div class="page-wrapper">
			<div class="content container-fluid">
				<div class="row">
					<div class="col-lg-12">
						<div class="card-box">
							<div class="card-block">
								<h6 class="card-title text-bold">Historical Data</h6>
								<hr>
								<!-- <form class="form-inline sr-form" action="#"> -->
									<?php
									$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_form_history');
									echo form_open_multipart('History/search_pension/',$attributes);?>
								

								   <div class="form-group" style="min-height:60px;">
										<select name = "organisation_name" class="form-control" id = "">
									   <option selected="selected" value="">Select Organisation</option>
									   <option value="All" <?php  if($insertData['organisation_name']==All) { echo 'selected'; } ?>>All</option>
										<?php
											if(empty($all_organisation))
											{
												echo '<option value="All">'.'Select Organisation'.'</option>';
											}

											else
											{
												foreach ($all_organisation as $organisation)
											  {?>   
												
												<option  value="<?php echo $organisation->ORGANIZATION_ID ?>" <?php if($insertData['organisation_name']==$organisation->ORGANIZATION_ID) { echo 'selected'; } ?> >

													<?php echo $organisation->ORGNAME; ?>

												</option>

											  <?php }
											}
										  
										?>
										
									</select>
								   </div>

								   <div class="form-group" style="min-height:60px;">
									<div class="cal-icon">
									<input type="text" name="select_date" autocomplete="off" class="form-control datetimepicker2" id="from_datte" placeholder="dd-mm-yy" value="<?php echo isset($insertData['select_date']) ? $insertData['select_date'] : ''; ?>"/>
									</div>

								   </div>
								   
									<div class="form-group" style="min-height:60px;">
									 <button type="submit" name = "submit" id ="generate_report" class="btn btn-success btn-search">Generate</button>

									
									</div>
								  
								<?php echo form_close();?>
								
								<button class="btn btn-success" style="float:right;margin-bottom:20px;" onclick="saveFile()">Download Excel<i class="fa fa-arrow-circle-down"></i></button>
								
								<button class="btn btn-warning" style="float:right;margin-bottom:20px;margin-right:20px;" onclick="generatePdf()">Download PDF<i class="fa fa-arrow-circle-down"></i></button>

								<button class="btn btn-danger" style="float:right;margin-bottom:20px;margin-right:20px;" onclick="generateWord()">Download Word<i class="fa fa-arrow-circle-down"></i></button>
					
					<div id ="pp1" style="clear:both;">	
					
					<div class="col-sm-6" style="margin-bottom:25px;padding-left:0;">
						<span><b>Organisation Name:</b></span> <span><?php echo $organisation_name; ?></span>	
					</div>
					<div class="col-sm-6 text-right" style="margin-bottom:25px;padding-right:0;">
					   <span><b>Status as on date : </b></span> <span id="set_date">
						<?php 

							if(!empty($selected_month))
							{
								if($selected_month == '1')
								{
									$month = 'Janurary';
								}

								else if($selected_month == '2')
								{
									$month = 'Feburary';
								}
								else if($selected_month == '3')
								{
									$month = 'March';
								}
								else if($selected_month == '4')
								{
									$month = 'April';
								}
								else if($selected_month == '5')
								{
									$month = 'May';
								}
								else if($selected_month == '6')
								{
									$month = 'June';
								}
								else if($selected_month == '7')
								{
									$month = 'July';
								}
								else if($selected_month == '8')
								{
									$month = 'August';
								}
								else if($selected_month == '9')
								{
									$month = 'September';
								}
								else if($selected_month == '10')
								{
									$month = 'October';
								}
								else if($selected_month == '11')
								{
									$month = 'November';
								}
								else if($selected_month == '12')
								{
									$month = 'December';
								}
								else 
								{
									$month = '';
								}
								echo $month.','.$selected_year;
							}

							else
							{
								$current_timestamp = strtotime("now");
								$current_date =  date("d F Y", $current_timestamp);
								echo $current_date;
							}
							
							?></span>	
					</div>
			
			<?php 
				 if($all_data_POPSEF) {?>
			<div class="pension-table">
			
			  <h3 style="color:#f05e27;font-size:14px;">A) Status Of Pending old Pension Scheme(Except Family Pension)</h3>
			
			<table border width="100%">
						<tr>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">S.No.</th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Name of the Employee/Pensioner</th>
							<!-- <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Pension Status</th> -->
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Date of Retirement</th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" colspan="2"></th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Name of the division dealing the pension cases</th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" colspan="10"></th>
						
						</tr>
									
						 <tr>
							
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Mobile No,Email Id, PAN No., Aadhar No.</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Present Residential Address</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether pension paper has been submitted</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether Verification of service book completed</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether the case is pending with PAO(YES/No)</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">PPO Number if issued</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">If PPO no. is yet to be issued, the status of pension papers</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP, LE, CGEGIS etc)</th>
							  <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Pension Status</th>
							  <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Remarks</th>
							  <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">PAO Remarks if any</th>
							  <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Updated Date</th>
						 </tr>
						 <?php
							if($all_data_POPSEF) {
							$i=1;
							foreach($all_data_POPSEF as $POPSEF) { ?>

						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $POPSEF->EMPLY_NAME; ?></td>
							<!-- <td><?php //echo $POPSEF->PENSION_STATUS; ?></td> -->
							<td><?php echo date('d F, Y', strtotime($POPSEF->DATE_RETIREMENT)); ?></td>
						
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
									echo "<script type='text/javascript' src='http://katiyarprint.com/pensionscheme-audit/assets/js/jquery-3.2.1.min.js'></script><script type='text/javascript' src='http://katiyarprint.com/pensionscheme-audit/assets/js/aes.js'></script>
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
								echo $POPSEF->ADDRESS;
								?>
							</td>
							
							<td>
								<?php
									echo $POPSEF->DIVIS_DEAL_NAME;
								?>
							</td>

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
									if($POPSEF->ANNUAL_VERIFICATION ==0)
									{
										echo 'No';
									}

									else if($POPSEF->ANNUAL_VERIFICATION ==1)
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
									if($POPSEF->PENDING_PPO ==0)
									{
										echo 'No';
									}

									else if($POPSEF->PENDING_PPO ==1)
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
									echo $POPSEF->STATUS_PENS_PAPER;

									
								?>
							</td>
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $POPSEF->PENSION_ID,'STATUS'=>1));
									echo $POPSEF->TREMINAL_BENIFIT_GRANT;
								?>
							</td>
							<td><?php echo $POPSEF->PENSION_STATUS; ?></td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $POPSEF->PENSION_ID,'STATUS'=>1));
									echo $POPSEF->DESCRIPTION;
								?>	
							</td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $POPSEF->PENSION_ID,'STATUS'=>1));
									echo $POPSEF->PAO_DESCRIPTION;
								?>	
							</td>
							<td>
								<?php echo date('d F, Y', strtotime($POPSEF->LASTMODIFIED)); ?>
									
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
						<!--2-->
						 <?php
			   if($all_data_POPSOF) { ?>
		 
		  <div class="pension-table">

			  <h3 style="color:#f05e27;font-size:14px;">B) Status Of Pending old Pension Scheme(Only Family Pension)</h3>
			
			<table border width="100%">
					
						<tr>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">S.No.</th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Name of the Employee</th>
							<!-- <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Pension Status</th> -->
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Date of Death</th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Name of Family Member Eligible for Pension</th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" colspan="2"></th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Name of the division dealing the pension cases </th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" colspan="9"></th>
							
						</tr>
									
						 <tr>
							
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Mobile No,Email Id, PAN No.,Aadhar No.</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Present Residential Address</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether pension paper has been submitted</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether the case is pending with PAO(YES/No)</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">PPO Number if issued</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">If PPO no. is yet to be issued, the status of pension papers</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP, LE, CGEGIS etc)</th>
							  <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Pension Status</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Remarks</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">PAO Remarks if any</th>
							  <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Updated Date</th>
						 </tr>
						<?php
							if($all_data_POPSOF) {
							$i=1;
							foreach($all_data_POPSOF as $POPSOF) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $POPSOF->EMPLY_NAME; ?></td>
							<!-- <td><?php //echo $POPSOF->PENSION_STATUS; ?></td> -->
							<td><?php echo date('d F, Y', strtotime($POPSOF->DATE_DEATH));?></td>
							<td><?php echo $POPSOF->FAMILYMEM_NAME; ?></td>
							
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
								  echo "<script type='text/javascript' src='http://katiyarprint.com/pensionscheme-audit/assets/js/jquery-3.2.1.min.js'></script><script type='text/javascript' src='http://katiyarprint.com/pensionscheme-audit/assets/js/aes.js'></script>
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
								echo $POPSOF->ADDRESS;
								?>
							</td>
							
							<td>
								<?php
									echo $POPSOF->DIVIS_DEAL_NAME;
								?>
							</td>

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
									if($POPSOF->PENDING_PPO ==0)
									{
										echo 'No';
									}

									else if($POPSOF->PENDING_PPO ==1)
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
									echo $POPSOF->STATUS_PENS_PAPER;

									
								?>
							</td>
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $POPSOF->PENSION_ID,'STATUS'=>1));
									echo $POPSOF->TREMINAL_BENIFIT_GRANT;
								?>
							</td>
							<td><?php echo $POPSOF->PENSION_STATUS; ?></td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $POPSOF->PENSION_ID,'STATUS'=>1));
									echo $POPSOF->DESCRIPTION;
								?>	
							</td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $POPSOF->PENSION_ID,'STATUS'=>1));
									echo $POPSOF->PAO_DESCRIPTION;
								?>	
							</td>
							<td>
								<?php echo date('d F, Y', strtotime($POPSOF->LASTMODIFIED)); ?>								
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
			   if($all_data_PNPSEF) {?>
		   <div class="pension-table">
		  
			
			  <h3 style="color:#f05e27;font-size:14px;">C) Status Of Pending New Pension Scheme(Except Family Pension)</h3>
			
			<table border width="100%">
					
						<tr>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">S.No.</th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Name of the Pensioner</th>
							<!-- <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Pension Status</th> -->
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Date of Retirement</th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" colspan="2"></th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Name of the division dealing the pension cases</th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" colspan="9"></th>
							
						</tr>
									
						 <tr>
							
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Mobile No,Email Id, PAN No.,Aadhar No.</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Present Residential Address</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether pension paper has been submitted</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether withdrawal request submitted to NSDL</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether terminal benefits granted(Provide specific details w.r.t, LE, CGEGIS, Service Gratuity, Retirement Gratuity  etc.)</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether the case is pending with PAO(YES/No)</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Status of the terminal benifits if not granted</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Pension Status</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Remarks</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">PAO Remarks if any</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Updated Date</th>
						 </tr>
						
						<?php
							if($all_data_PNPSEF) {
							$i=1;
							foreach($all_data_PNPSEF as $PNPSEF) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $PNPSEF->EMPLY_NAME; ?></td>
							<!-- <td><?php //echo $PNPSEF->PENSION_STATUS; ?></td> -->
							<td><?php echo date('d F, Y', strtotime($PNPSEF->DATE_RETIREMENT));?></td>
							
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
				  echo "<script type='text/javascript' src='http://katiyarprint.com/pensionscheme-audit/assets/js/jquery-3.2.1.min.js'></script><script type='text/javascript' src='http://katiyarprint.com/pensionscheme-audit/assets/js/aes.js'></script>
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
								echo $PNPSEF->ADDRESS;
								?>
							</td>
							
							<td>
								<?php
									echo $PNPSEF->DIVIS_DEAL_NAME;
								?>
							</td>

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
									
									echo $PNPSEF->WITHDRAWAL_REQ_NSDL;
								?>
							</td>
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $PNPSEF->PENSION_ID,'STATUS'=>1));
									echo $PNPSEF->TREMINAL_BENIFIT_GRANT;
								?>
							</td>
							<td>
							<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $PNPSEF->PENSION_ID,'STATUS'=>1));
									if($PNPSEF->PENDING_PPO ==0)
									{
										echo 'No';
									}

									else if($PNPSEF->PENDING_PPO ==1)
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
									
									echo $PNPSEF->STATUS_TERM_BENI_NOT_GRANT;
								?>
							</td>
							<td><?php echo $PNPSEF->PENSION_STATUS; ?></td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $PNPSEF->PENSION_ID,'STATUS'=>1));
									echo $PNPSEF->DESCRIPTION;
								?>	
							</td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $PNPSEF->PENSION_ID,'STATUS'=>1));
									echo $PNPSEF->PAO_DESCRIPTION;
								?>	
							</td>
							<td>
							<?php echo date('d F, Y', strtotime($PNPSEF->LASTMODIFIED)); ?>								
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
			 if($all_data_PNPSOF) {?>
		   <div class="pension-table">
		   
			
			  <h3 style="color:#f05e27;font-size:14px;">D) Status Of Pending New Pension Scheme(Only Family Pension)</h3>
			
			<table border width="100%">
					
						<tr>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">S.No.</th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Name of the Employee</th>
							<!-- <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Pension Status</th> -->
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Date of Death</th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" colspan="2"></th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="2">Name of the division dealing the pension cases </th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" colspan="9"></th>
							
						</tr>
									
						 <tr>
							
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Mobile No,Email Id, PAN No.,Aadhar No.</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Present Residential Address</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether pension paper has been submitted</th>
							<th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether withdrawal request submitted to NSDL</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether terminal benefits granted(Provide specific details w.r.t, LE, CGEGIS, Service Gratuity, Retirement Gratuity  etc.)</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Whether the case is pending with PAO(YES/No)</th>
							 <th style="padding: 10px;text-align: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Status of the terminal benifits if not granted</th>
							  <th style="padding: 10px;text-aligsn: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Pension Status</th>
							 <th style="padding: 10px;text-aligsn: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Remarks</th>
							 <th style="padding: 10px;text-aligsn: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">PAO Remarks if any</th>
							 <th style="padding: 10px;text-aligsn: center;font-size: 13px;background: #2662df;color: #fff;" rowspan="1">Updated Date</th>
						 </tr>
						<?php
							if($all_data_PNPSOF) {
							$i=1;
							foreach($all_data_PNPSOF as $PNPSOF) { ?>
						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $PNPSOF->EMPLY_NAME; ?></td>
							<!-- <td><?php //echo $PNPSOF->PENSION_STATUS; ?></td> -->
							<td><?php echo date('d F, Y', strtotime($PNPSOF->DATE_DEATH));?></td>
							
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
				  echo "<script type='text/javascript' src='http://katiyarprint.com/pensionscheme-audit/assets/js/jquery-3.2.1.min.js'></script><script type='text/javascript' src='http://katiyarprint.com/pensionscheme-audit/assets/js/aes.js'></script>
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
								echo $PNPSOF->ADDRESS;
								?>
							</td>
							
							<td>
								<?php
									echo $PNPSOF->DIVIS_DEAL_NAME;
								?>
							</td>
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
								
									echo $PNPSOF->WITHDRAWAL_REQ_NSDL;
								?>
							</td>
							<td>
								<?php 
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $PNPSOF->PENSION_ID,'STATUS'=>1));
									
										echo $PNPSOF->TREMINAL_BENIFIT_GRANT;	
									
								?>
							</td>
							<td>
								<?php
									$pension_record_status_data = $this->Base_model->get_record_by_id('pensrecostatus', array('PENSION_ID' => $PNPSOF->PENSION_ID,'STATUS'=>1));
									if($PNPSOF->PENDING_PPO ==0)
									{
										echo 'No';
									}

									else if($PNPSOF->PENDING_PPO ==1)
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
									
									echo $PNPSOF->STATUS_TERM_BENI_NOT_GRANT;
								?>
							</td>
							<td><?php echo $PNPSOF->PENSION_STATUS; ?></td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $PNPSOF->PENSION_ID,'STATUS'=>1));
									echo $PNPSOF->DESCRIPTION;
								?>
									
							</td>
							<td>
								<?php
									$pension_record_remark_data = $this->Base_model->get_record_by_id('pensrecoremark', array('PENSION_ID' => $PNPSOF->PENSION_ID,'STATUS'=>1));
									echo $PNPSOF->PAO_DESCRIPTION;
								?>
									
							</td>
							<td>
								<?php echo date('d F, Y', strtotime($PNPSOF->LASTMODIFIED)); ?>	
									
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
					<?php 

						$a1 = count($all_data_POPSEF) ;
						$b1 = count($all_data_POPSOF) ;
						$c1 = count($all_data_PNPSEF) ;
						$d1 = count($all_data_PNPSOF) ;
												
						if(empty($a1) && empty($b1) && empty($c1) && empty($d1))
						{
							echo 'No records found.';
						}

						else
						{
							echo '';
						}

					?>
					<!--table code ends-->
							
							</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<?php
		/******************************************Pension POPSEF Code***************************************/

   $get_poposef_pdf = array();
   foreach ($all_data_POPSEF as $popsef_data)
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
			$submit_datee = date('d F, Y', strtotime($popsef_data->PENSION_PAPER_SUBMIT_DATE));
		}

		else if($popsef_data->PENSION_PAPER_SUBMIT_STATUS=='No')
		{
			$submit_datee = '';
		}

		else
		{
			$submit_datee = '';
		}
	
		$email_data = $pension_contact_data->MOBILENO.','.$pension_contact_data->EMAILID.','.$pension_contact_data->PANText.','.$pension_contact_data->Adhartext;

		$pension_popsef['Pension_Id'] = empty($popsef_data->PENSION_ID) ? '':$popsef_data->PENSION_ID;
		$pension_popsef['PPO_No'] = empty($popsef_data->PPO_NO) ? '':$popsef_data->PPO_NO;
		$pension_popsef['Name'] = empty($popsef_data->EMPLY_NAME) ? '':$popsef_data->EMPLY_NAME;
		$pension_popsef['Pension_Status'] = empty($popsef_data->PENSION_STATUS) ? '':$popsef_data->PENSION_STATUS;
		$pension_popsef['Retirement_date'] = empty($popsef_data->DATE_RETIREMENT) ? '':$popsef_data->DATE_RETIREMENT;
		//$pension_popsef['Mobile_No'] = empty($pension_contact_data->MOBILENO) ? '':$pension_contact_data->MOBILENO;
		$pension_popsef['Email'] = empty($email_data) ? '':$email_data;
		$pension_popsef['Address'] = empty($pension_contact_data->ADDRESS) ? '':$pension_contact_data->ADDRESS;
		$pension_popsef['Division_Name'] = empty($popsef_data->DIVIS_DEAL_NAME) ? '':$popsef_data->DIVIS_DEAL_NAME;
		$pension_popsef['Pension_Submission'] = empty($popsef_data->PENSION_PAPER_SUBMIT_STATUS) ? '':$popsef_data->PENSION_PAPER_SUBMIT_STATUS.' '.$submit_datee;
		$pension_popsef['Annual_verification'] = empty($annnual_verification) ? '':$annnual_verification;
		$pension_popsef['Case_pending'] = empty($case_pending_pao) ? '':$case_pending_pao;
		$pension_popsef['Status_pension_papers'] = empty($pension_record_status_data->STATUS_PENS_PAPER) ? '':$pension_record_status_data->STATUS_PENS_PAPER;
		$pension_popsef['Terminal_Benefits_Granted'] = empty($pension_record_status_data->TREMINAL_BENIFIT_GRANT) ? '':$pension_record_status_data->TREMINAL_BENIFIT_GRANT;
		$pension_popsef['Remarks'] = empty($pension_record_remark_data->DESCRIPTION) ? '':$pension_record_remark_data->DESCRIPTION;
		$pension_popsef['Pao_Remarks'] = empty($pension_record_remark_data->PAO_DESCRIPTION) ? '':$pension_record_remark_data->PAO_DESCRIPTION;

		$get_poposef_pdf[] = $pension_popsef;
	}	

	$json_popsef_pdf = json_encode($get_poposef_pdf);

	/******************************************Ends Pension POPSEF Code***************************************/

	/******************************************Pension POPSOF Code******************************************/

		 $get_popospof_pdf = array();
		   foreach ($all_data_POPSOF as $popsof_data)
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
					$submit_datee = date('d F, Y', strtotime($popsof_data->PENSION_PAPER_SUBMIT_DATE));
				}

				else if($popsof_data->PENSION_PAPER_SUBMIT_STATUS=='No')
				{
					$submit_datee = '';
				}

				else
				{
					$submit_datee = '';
				}


				$email_data = $pension_contact_data->MOBILENO.','.$pension_contact_data->EMAILID.','.$pension_contact_data->PANText.','.$pension_contact_data->Adhartext;

				$pension_popsof['Pension_Id'] = empty($popsof_data->PENSION_ID) ? '':$popsof_data->PENSION_ID;
				$pension_popsof['PPO_No'] = empty($popsof_data->PPO_NO) ? '':$popsof_data->PPO_NO;
				$pension_popsof['Name'] = empty($popsof_data->EMPLY_NAME) ? '':$popsof_data->EMPLY_NAME;
				$pension_popsof['Pension_Status'] = empty($popsof_data->PENSION_STATUS) ? '':$popsof_data->PENSION_STATUS;

				$pension_popsof['Family_mem'] = empty($popsof_data->FAMILYMEM_NAME) ? '':$popsof_data->FAMILYMEM_NAME;
				$pension_popsof['Death_of_date'] = empty($popsof_data->DATE_DEATH) ? '':$popsof_data->DATE_DEATH;
				//$pension_popsof['Mobile_No'] = empty($pension_contact_data->MOBILENO) ? '':$pension_contact_data->MOBILENO;
				$pension_popsof['Email'] = empty($email_data) ? '':$email_data;
				$pension_popsof['Address'] = empty($pension_contact_data->ADDRESS) ? '':$pension_contact_data->ADDRESS;
				$pension_popsof['Division_Name'] = empty($popsof_data->DIVIS_DEAL_NAME) ? '':$popsof_data->DIVIS_DEAL_NAME;
				$pension_popsof['Pension_Submission'] = empty($popsof_data->PENSION_PAPER_SUBMIT_STATUS) ? '':$popsof_data->PENSION_PAPER_SUBMIT_STATUS.' '.$submit_datee;
				$pension_popsof['Case_pending_PAO'] = empty($case_pending_pao) ? '':$case_pending_pao;
				$pension_popsof['Status_pension_papers'] = empty($pension_record_status_data->STATUS_PENS_PAPER) ? '':$pension_record_status_data->STATUS_PENS_PAPER;
				$pension_popsof['Terminal_Benefits_Granted'] = empty($pension_record_status_data->TREMINAL_BENIFIT_GRANT) ? '':$pension_record_status_data->TREMINAL_BENIFIT_GRANT;
				$pension_popsof['Remarks'] = empty($pension_record_remark_data->DESCRIPTION) ? '':$pension_record_remark_data->DESCRIPTION;
				$pension_popsof['Pao_Remarks'] = empty($pension_record_remark_data->PAO_DESCRIPTION) ? '':$pension_record_remark_data->PAO_DESCRIPTION;

				$get_popospof_pdf[] = $pension_popsof;
			}	

			$json_popsof_pdf = json_encode($get_popospof_pdf);

	/******************************************Ends Pension POPSOF Code***************************************/

	/******************************************Pension PNPSEF Code******************************************/
		   $get_pnpsef_pdf = array();
		   foreach ($all_data_PNPSEF as $pnpsef_data)
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

				////////

				if($pnpsef_data->PENSION_PAPER_SUBMIT_STATUS=='Yes')
				{
					$submit_datee = date('d F, Y', strtotime($pnpsef_data->PENSION_PAPER_SUBMIT_DATE));
				}

				else if($pnpsef_data->PENSION_PAPER_SUBMIT_STATUS=='No')
				{
					$submit_datee = '';
				}

				else
				{
					$submit_datee = '';
				}

				$email_data = $pension_contact_data->MOBILENO.','.$pension_contact_data->EMAILID.','.$pension_contact_data->PANText.','.$pension_contact_data->Adhartext;

				$pension_pnpsef['Pension_Id'] = empty($pnpsef_data->PENSION_ID) ? '':$pnpsef_data->PENSION_ID;
				$pension_pnpsef['PPO_No'] = empty($pnpsef_data->PPO_NO) ? '':$pnpsef_data->PPO_NO;
				$pension_pnpsef['Name'] = empty($pnpsef_data->EMPLY_NAME) ? '':$pnpsef_data->EMPLY_NAME;
				$pension_pnpsef['Pension_Status'] = empty($pnpsef_data->PENSION_STATUS) ? '':$pnpsef_data->PENSION_STATUS;
				$pension_pnpsef['Death_of_retirement'] = empty($pnpsef_data->DATE_RETIREMENT) ? '':$pnpsef_data->DATE_RETIREMENT;
				//$pension_pnpsef['Mobile_No'] = empty($pension_contact_data->MOBILENO) ? '':$pension_contact_data->MOBILENO;
				$pension_pnpsef['Email'] = empty($email_data) ? '':$email_data;
				$pension_pnpsef['Address'] = empty($pension_contact_data->ADDRESS) ? '':$pension_contact_data->ADDRESS;
				$pension_pnpsef['Division_Name'] = empty($pnpsef_data->DIVIS_DEAL_NAME) ? '':$pnpsef_data->DIVIS_DEAL_NAME;
				$pension_pnpsef['Pension_Submission'] = empty($pnpsef_data->PENSION_PAPER_SUBMIT_STATUS) ? '':$pnpsef_data->PENSION_PAPER_SUBMIT_STATUS.' '.$submit_datee;
				$pension_pnpsef['Withdrawl_request_submit_NSDL'] = empty($pension_record_status_data->WITHDRAWAL_REQ_NSDL) ? '':$pension_record_status_data->WITHDRAWAL_REQ_NSDL;
				$pension_pnpsef['Case_pending_with_PAO'] = empty($case_pending_pao) ? '':$case_pending_pao;
				$pension_pnpsef['Terminal_Benefits_Granted'] = empty($pension_record_status_data->TREMINAL_BENIFIT_GRANT) ? '':$pension_record_status_data->TREMINAL_BENIFIT_GRANT;
				$pension_pnpsef['Terminal_Benefits_Not_Granted'] = empty($pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT) ? '':$pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT;
				$pension_pnpsef['Remarks'] = empty($pension_record_remark_data->DESCRIPTION) ? '':$pension_record_remark_data->DESCRIPTION;
				$pension_pnpsef['Pao_Remarks'] = empty($pension_record_remark_data->PAO_DESCRIPTION) ? '':$pension_record_remark_data->PAO_DESCRIPTION;

				$get_pnpsef_pdf[] = $pension_pnpsef;
			}	

			$json_pnpsef_pdf = json_encode($get_pnpsef_pdf);

	/******************************************Ends Pension PNPSEF Code******************************************/

	/******************************************Pension PNPSOF Code******************************************/

		 $get_pnpsof_pdf = array();
		   foreach ($all_data_PNPSOF as $pnpsof_data)
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

				///////

				if($pnpsof_data->PENSION_PAPER_SUBMIT_STATUS=='Yes')
				{
					$submit_datee = date('d F, Y', strtotime($pnpsof_data->PENSION_PAPER_SUBMIT_DATE));
				}

				else if($pnpsof_data->PENSION_PAPER_SUBMIT_STATUS=='No')
				{
					$submit_datee = '';
				}

				else
				{
					$submit_datee = '';
				}
				$email_data = $pension_contact_data->MOBILENO.','.$pension_contact_data->EMAILID.','.$pension_contact_data->PANText.','.$pension_contact_data->Adhartext;
				$pension_pnpsof['Pension_Id'] = empty($pnpsof_data->PENSION_ID) ? '':$pnpsof_data->PENSION_ID;
				$pension_pnpsof['PPO_No'] = empty($pnpsof_data->PPO_NO) ? '':$pnpsof_data->PPO_NO;
				$pension_pnpsof['Name'] = empty($pnpsof_data->EMPLY_NAME) ? '':$pnpsof_data->EMPLY_NAME;
				$pension_pnpsof['Pension_Status'] = empty($pnpsof_data->PENSION_STATUS) ? '':$pnpsof_data->PENSION_STATUS;
				$pension_pnpsof['Death_of_death'] = empty($pnpsof_data->DATE_DEATH) ? '':$pnpsof_data->DATE_DEATH;
				//$pension_pnpsof['Mobile_No'] = empty($pension_contact_data->MOBILENO) ? '':$pension_contact_data->MOBILENO;
				$pension_pnpsof['Email'] = empty($email_data) ? '':$email_data;
				$pension_pnpsof['Address'] = empty($pension_contact_data->ADDRESS) ? '':$pension_contact_data->ADDRESS;
				$pension_pnpsof['Division_Name'] = empty($pnpsof_data->DIVIS_DEAL_NAME) ? '':$pnpsof_data->DIVIS_DEAL_NAME;
				$pension_pnpsof['Pension_Submission'] = empty($pnpsof_data->PENSION_PAPER_SUBMIT_STATUS) ? '':$pnpsof_data->PENSION_PAPER_SUBMIT_STATUS.' '.$submit_datee;
				$pension_pnpsof['Withdrawl_request_submit_to_NSDL'] = empty($pension_record_status_data->WITHDRAWAL_REQ_NSDL) ? '':$pension_record_status_data->WITHDRAWAL_REQ_NSDL;
				$pension_pnpsof['Case_pending_with_PAO'] = empty($case_pending_pao) ? '':$case_pending_pao;
				$pension_pnpsof['Terminal_Benefits_Granted'] = empty($pension_record_status_data->TREMINAL_BENIFIT_GRANT) ? '':$pension_record_status_data->TREMINAL_BENIFIT_GRANT;
				$pension_pnpsof['Terminal_Benefits_Not_Granted'] = empty($pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT) ? '':$pension_record_status_data->STATUS_TERM_BENI_NOT_GRANT;
				$pension_pnpsof['Remarks'] = empty($pension_record_remark_data->DESCRIPTION) ? '':$pension_record_remark_data->DESCRIPTION;
				$pension_pnpsof['Pao_Remarks'] = empty($pension_record_remark_data->PAO_DESCRIPTION) ? '':$pension_record_remark_data->PAO_DESCRIPTION;

				$get_pnpsof_pdf[] = $pension_pnpsof;
			}	

			$json_pnpsof_pdf = json_encode($get_pnpsof_pdf);

	/******************************************Ends Pension PNPSOF Code******************************************/

		?>
		<?php

			 $json_organisation = json_encode($organisation_name);
		?>

		<?php

			$a1 = count($all_data_POPSEF) ;
			$b1 = count($all_data_POPSOF) ;
			$c1 = count($all_data_PNPSEF) ;
			$d1 = count($all_data_PNPSOF) ;
			
			
			if(empty($a1) && empty($b1) && empty($c1) && empty($d1))
			{
				$text =  'No records found.';
				$json_certificate = json_encode($text);
			}	

			else if($a1>0 || $b1>0 || $c1>0 || $d1>0)
			{
				$check_certificate_status = $this->Base_model->check_existent('penscertificate', array('ORGANISATION'=> $all_data_POPSEF[0]->ORGANISATION,'STATUS' => 1));

				if($check_certificate_status=='1')
				{
					$text =   '1';
					$json_certificate = json_encode($text);
				}

				else if($check_certificate_status=='0')
				{

					$text =   '0';
					$json_certificate = json_encode($text);

				}

				else
				{
					$text =   'content';
					$json_certificate = json_encode($text);
				}
			}

			else
			{
				$text =   'content';
				$json_certificate = json_encode($text);
			}
		?>
		<!--Certificateeee--------->

		<?php

			$a1 = count($all_data_POPSEF) ;
			$b1 = count($all_data_POPSOF) ;
			$c1 = count($all_data_PNPSEF) ;
			$d1 = count($all_data_PNPSOF) ;
			
			
			if(empty($a1) && empty($b1) && empty($c1) && empty($d1))
			{
				$text =  'No records found.';
				$json_certificate = json_encode($text);
			}	

			else if($a1>0 || $b1>0 || $c1>0 || $d1>0)
			{
				$check_certificate_status = $this->Base_model->check_existent('penscertificate', array('ORGANISATION'=> $all_data_POPSEF[0]->ORGANISATION,'STATUS' => 1));

				if($check_certificate_status=='1')
				{
					$text =   '1';
					$json_certificate = json_encode($text);
				}

				else if($check_certificate_status=='0')
				{

					$text =   '0';
					$json_certificate = json_encode($text);

				}

				else
				{
					$text =   'content';
					$json_certificate = json_encode($text);
				}
			}

			else
			{
				$text =   'content';
				$json_certificate = json_encode($text);
			}
		?>

		<!--Ends certificteee-->

		<!-- Current Date-->
		<?php

			$current_timestamp = strtotime("now");
			$current_date =  date("d F Y", $current_timestamp);
			$json_current_date = json_encode($current_date);

		?>

		<!-- Selected data-->
		<?php

			 $json_selected_division = json_encode($insertData['division']);
			 $json_selected_month = json_encode($insertData['month']);
			 $json_selected_from_date = json_encode($insertData['from_date']);
		?>

		<style>
		
			.pension-table{overflow-x:scroll;margin-bottom:50px;clear:both;position:relative;}

			.pension-table::-webkit-scrollbar {
				height:10px;
				background:#ddd;
			}

			.pension-table::-webkit-scrollbar-thumb {
				background: #aaa; 
				border-radius:10px;
			}

			table{width:1700px;border-color:#ddd;}

			table th{
				padding: 10px;
				text-align: center;
				font-size: 13px;
				background: #2662df;
				color: #fff;
			}


			table td{padding:10px;text-align: center;font-size:13px;}

			.table>thead>tr>th{vertical-align:top!important;}
		
		</style>
	
	
		<script>
			window.saveFile = function saveFile () {
			var popsef_Array = <?php echo $json_popsef; ?>;
			var popsof_Array = <?php echo $json_popsof; ?>;
			var pnpsef_Array = <?php echo $json_pnpsef; ?>;
			var pnpsof_Array = <?php echo $json_pnpsof; ?>;
			var organisation = <?php echo $json_organisation; ?>;
	   
			var data1 = popsef_Array;
			var data2 = popsof_Array;
			var data3 = pnpsef_Array;
			var data4 = pnpsof_Array;
			
			/**********data1***********/
			if(data1.length==0)
			{
				var data1 = [{'Pension Id':'','PPO No':'','Name of the Employee/Pensione':'','Retirement date':'','Mobile No':'','Mobile No,Email,Pan,Adhar':'','Address':'','Division Name':'','Annual verification of service book completed':'','Case pending with PAO':'','Status of pension papers':'','Terminal Benefits Granted':'','Remarks':''}];
			}

			else
			{
				var data1 = data1;
			}

			/**********data2***********/
			if(data2.length==0)
			{
				var data2 = [{'Pension Id':'','PPO No':'','Name of the Employee/Pensione':'','Date of death':'','Mobile No':'','Mobile No,Email,Pan,Adhar':'','Address':'','Division Name':'','Case pending with PAO':'','Status of pension papers':'','Terminal Benefits Granted':'','Remarks':''}];
			}

			else
			{
				var data2 = data2;
			}

			/**********data3***********/
			if(data3.length==0)
			{
				var data3 = [{'Pension Id':'','PPO No':'','Name of the Employee/Pensione':'','Date of retirement':'','Mobile No':'','Mobile No,Email,Pan,Adhar':'','Address':'','Division Name':'','Withdrawl request submit to NSDL':'','Case pending with PAO':'','Terminal Benefits Granted':'','Terminal Benefits Not Granted':'','Remarks':''}];
			}

			else
			{
				var data3 = data3;
			}

			/**********data4***********/
			if(data4.length==0)
			{
				var data4 = [{'Pension Id':'','PPO No':'','Name of the Employee/Pensione':'','Death of death':'','Mobile No':'','Mobile No,Email,Pan,Adhar':'','Address':'','Division Name':'','Withdrawl request submit to NSDL':'','Case pending with PAO':'','Terminal Benefits Granted':'','Terminal Benefits Not Granted':'','Remarks':''}];
			}

			else
			{
				var data4 = data4;
			}
			
				var opts = [{sheetid:'Annexure A',header:true},{sheetid:'Annexure B ',header:true},{sheetid:'Annexure C',header:true},{sheetid:'Annexure D',header:true}];
				var res = alasql('SELECT INTO XLSX("Pension_report.xlsx",?) FROM ?',
							 [opts,[data1,data2,data3,data4]]);
			

			
			
			}//ends function

			/******************function for generate PDF***************/

			 function generatePdf () 
			 {
				var popsef_Array = <?php echo $json_popsef_pdf; ?>;
				 var popsof_Array = <?php echo $json_popsof_pdf; ?>;
				 var pnpsef_Array = <?php echo $json_pnpsef_pdf; ?>;
				 var pnpsof_Array = <?php echo $json_pnpsof_pdf; ?>;
				 var organisation = <?php echo $json_organisation; ?>;
				 var ccertificate = <?php echo $json_certificate; ?>;
				 var output = <?php echo $json_current_date; ?>;
				


				 if(ccertificate == '1')
				 {
					header = [''];
					content = [['It is certified that no pension case in respect of "'+organisation+' "  is pending either with PAO or with this organization/office as on date: '+output+' ']];


					 var doc = new jsPDF('p', 'pt');
					 doc.text(organisation, 20, doc.autoTableEndPosY() + 20);
					var startingPage = doc.internal.getCurrentPageInfo().pageNumber;
					doc.autoTable(header, content, {
						showHeader: 'firstPage',
						overflow: 'linebreak',
						styles: { fontSize: 16 },
						avoidPageSplit: true,
						 columnWidth: 'auto',
						 tableWidth: 'auto',
					   
					   
					});

					 doc.setPage(startingPage);  
					doc.save("Pension_report.pdf")
				 }

				 else
				 {
						var header = ["S.No.                        ","Name of the Employee/Pensioner","Pension Status         ","Date of Retirement   ","Mobile No,Email,PAN No,Aadhar No                        ","Present Residential Address   ","Name of the division dealing the pension cases","Pension Paper Submission                       ","Whether Verification of service book completed","Whether the case is pending with PAO(YES/No)","PPO Number if issued","If PPO no. is yet to be issued, the status of pension papers","Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP, LE, CGEGIS etc)","Remarks                                ","PAO Remarks if any                                "];

						  // /var header = title1.concat(first_header);
						
						  var header2 = ["S.No.                        ","Name of the Employee/Pensioner","Pension Status         ","Date of Death   ","Name of Family Member Eligible for Pension                  ","Mobile No,Email,PAN No,Aadhar No                        ","Present Residential Address   ","Name of the division dealing the pension cases","Pension Paper Submission                       ","Whether the case is pending with PAO(YES/No)","PPO Number if issued","If PPO no. is yet to be issued, the status of pension papers","Whether terminal benefits granted(Provide specific details w.r.t DCRG, CVP, LE, CGEGIS etc)","Remarks                                ","PAO Remarks if any                                "];

						  /*var header2 = title2.concat(second_header);*/

						 header3 = ["S.No.                        ","Name of the Pensioner","Pension Status         ","Date of Retirement   ","Mobile No,Email,PAN No,Aadhar No                        ","Present Residential Address   ","Name of the division dealing the pension cases","Pension Paper Submission                       ","Whether withdrawal request submitted to NSDL","Whether the case is pending with PAO(YES/No)","Status of the terminal benifits if not granted","Whether terminal benefits granted(Provide specific details w.r.t, LE, CGEGIS, Service Gratuity, Retirement Gratuity etc.)","Remarks                                ","PAO Remarks if any                                "];

						  /*var header3 = title3.concat(third_header);*/

						  var header4 = ["S.No.                        ","Name of the Employee","Pension Status         ","Date of Death   ","Mobile No,Email,PAN No,Aadhar No                        ","Present Residential Address   ","Name of the division dealing the pension cases","Pension Paper Submission                       ","Whether withdrawal request submitted to NSDL","Whether the case is pending with PAO(YES/No)","Status of the terminal benifits if not granted","Whether terminal benefits granted(Provide specific details w.r.t, LE, CGEGIS, Service Gratuity, Retirement Gratuity etc.)","Remarks                                ","PAO Remarks if any                                "];

						  /*var header4 = title4.concat(fourth_header);*/
						 /*********table1***********/

						  var table1_data=[];
						  for (var j=0 ; j < popsef_Array.length; j++)
						  {
							 var table1=[];
							 
								 table1[0]=j+1;
								 table1[1]=popsef_Array[j].Name;
								 table1[2]=popsef_Array[j].Pension_Status;
								 table1[3]=popsef_Array[j].Retirement_date;
								 table1[4]=popsef_Array[j].Email;
								 table1[5]=popsef_Array[j].Address;
								 table1[6]=popsef_Array[j].Division_Name;
								 table1[7]=popsef_Array[j].Pension_Submission;
								 table1[8]=popsef_Array[j].Annual_verification;
								 table1[9]=popsef_Array[j].Case_pending;
								 table1[11]=popsef_Array[j].PPO_No;
								 table1[11]=popsef_Array[j].Status_pension_papers;
								 table1[12]=popsef_Array[j].Terminal_Benefits_Granted;
								 table1[13]=popsef_Array[j].Remarks;
								 table1[14]=popsef_Array[j].Pao_Remarks;
								 
							
							 table1_data[j]=table1;
						}

						 /*********ends table1***********/

						/******for table2*********/
						
						  var table2_data=[];
						  for (var j=0 ; j < popsof_Array.length; j++)
						  {
							 var table2=[];
								
								// table2[0]='';
								 table2[0]=j+1;
								 table2[1]=popsof_Array[j].Name;
								 table2[2]=popsof_Array[j].Pension_Status;
								 table2[3]=popsof_Array[j].Death_of_date;
								 table2[4]=popsof_Array[j].Family_mem;
								 table2[5]=popsof_Array[j].Email;
								 table2[6]=popsof_Array[j].Address;
								 table2[7]=popsof_Array[j].Division_Name;
								 table2[8]=popsof_Array[j].Pension_Submission;
								 table2[9]=popsof_Array[j].Case_pending_PAO;
								 table2[10]=popsof_Array[j].PPO_No;
								 table2[11]=popsof_Array[j].Status_pension_papers;
								 table2[12]=popsof_Array[j].Terminal_Benefits_Granted;
								 table2[13]=popsof_Array[j].Remarks;
								 table2[14]=popsof_Array[j].Pao_Remarks;


								
								 
							
							 table2_data[j]=table2;
						}

						/****ends for table2********/
						
						/******for table3*********/
						
						  var table3_data=[];
						  for (var j=0 ; j < pnpsef_Array.length; j++)
						  {
							 var table3=[];
								
								 //table3[0]='';
								 table3[0]=j+1;
								 table3[1]=pnpsef_Array[j].Name;
								 table3[2]=pnpsef_Array[j].Pension_Status;
								 table3[3]=pnpsef_Array[j].Death_of_retirement;
								 table3[4]=pnpsef_Array[j].Email;
								 table3[5]=pnpsef_Array[j].Address;
								 table3[6]=pnpsef_Array[j].Division_Name;
								 table3[7]=pnpsef_Array[j].Status_pension_papers;
								 table3[8]=pnpsef_Array[j].Withdrawl_request_submit_NSDL;
								 table3[9]=pnpsef_Array[j].Case_pending_with_PAO;
								 table3[10]=pnpsef_Array[j].Terminal_Benefits_Granted;
								 table3[11]=pnpsef_Array[j].Terminal_Benefits_Not_Granted;
								 table3[12]=pnpsef_Array[j].Remarks;
								 table3[13]=pnpsef_Array[j].Pao_Remarks;

								 
								 
							
							 table3_data[j]=table3;
						}

						/****ends for table3********/

						/******for table4*********/
						
						  var table4_data=[];
						  for (var j=0 ; j < pnpsof_Array.length; j++)
						  {
							 var table4=[];
								
								// table4[0]='';
								 table4[0]=j+1;
								 table4[1]=pnpsof_Array[j].Name;
								 table4[2]=pnpsof_Array[j].Pension_Status;
								 table4[3]=pnpsof_Array[j].Death_of_death;
								 table4[4]=pnpsof_Array[j].Email;
								 table4[5]=pnpsof_Array[j].Address;
								 table4[6]=pnpsof_Array[j].Division_Name;
								 table4[7]=pnpsof_Array[j].Status_pension_papers;
								 table4[8]=pnpsof_Array[j].Withdrawl_request_submit_to_NSDL;
								 table4[9]=pnpsof_Array[j].Case_pending_with_PAO;
								 table4[10]=pnpsof_Array[j].Terminal_Benefits_Granted;
								 table4[11]=pnpsof_Array[j].Terminal_Benefits_Not_Granted;
								 table4[12]=pnpsof_Array[j].Remarks;
								 table4[13]=pnpsof_Array[j].Pao_Remarks;
								 
								
								 
							
							 table4_data[j]=table4;
						}

						/****ends for table4********/
						
						 content = table1_data;
						 content2 = table2_data;
						 content3 = table3_data;
						 content4 = table4_data;

						  var doc = new jsPDF('l', 'pt', 'a4');
						  doc.text(10,13,'Organisation Name : ' + organisation);
						  var startingPage = doc.internal.getCurrentPageInfo().pageNumber;

						  doc.text("A) Status Of Pending old Pension Scheme(Except Family Pension)", 30, doc.autoTableEndPosY() + 30);
						
							doc.autoTable(header, content, {
								showHeader: 'firstPage',
								overflow: 'linebreak',
								styles: { fontSize: 5 },
								avoidPageSplit: true,
								columnWidth: 'auto',
								tableWidth: 'auto',

							   
							   
							});
							
							//doc.addPage();

							doc.text("B) Status Of Pending old Pension Scheme(Only Family Pension)", 15, doc.autoTableEndPosY() + 15);
							 doc.autoTable(header2, content2, {
								showHeader: 'firstPage',
								overflow: 'linebreak',
								styles: {fontSize: 5 },
								avoidPageSplit: true,
								columnWidth: 'auto',
								tableWidth: 'auto',
								  startY: doc.autoTableEndPosY() + 50
								
							   
							   
							});

							 doc.text("C) Status Of Pending New Pension Scheme(Except Family Pension)", 15, doc.autoTableEndPosY() + 15);
							 doc.autoTable(header3, content3, {
								showHeader: 'firstPage',
								overflow: 'linebreak',
								styles: { fontSize: 5 },
								avoidPageSplit: true,
								 columnWidth: 'auto',
								 tableWidth: 'auto',
								 startY: doc.autoTableEndPosY() + 50
							   
							   
							});

							 doc.text("D) Status Of Pending New Pension Scheme(Only Family Pension)", 15, doc.autoTableEndPosY() + 15);
							 doc.autoTable(header4, content4, {
								showHeader: 'firstPage',
								overflow: 'linebreak',
								styles: { fontSize: 5 },
								avoidPageSplit: true,
								 columnWidth: 'auto',
								 tableWidth: 'auto',
								 startY: doc.autoTableEndPosY() + 50
							   
							   
							});

							doc.setPage(startingPage);  
							doc.save("Pension_report.pdf")
						 }//ends else
						/* var title1 = ["A) Status Of Pending old Pension Scheme(Except Family Pension)                                             "];
						 var title2 = ["B) Status Of Pending old Pension Scheme(Only Family Pension)                                             "];
						 var title3 = ["C) Status Of Pending New Pension Scheme(Except Family Pension)                                        "];
						 var title4 = ["D) Status Of Pending New Pension Scheme(Only Family Pension)                                         "];*/

			 }//ends function


			 //function for generate word

			 function generateWord(){
						var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
						var postHtml = "</body></html>";
						var html = preHtml+document.getElementById('pp1').innerHTML+postHtml;
						//var html = preHtml+document.getElementById('pp2').innerHTML+postHtml;

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

		/*************JS for date change*********/

		   /********* JS for getting circle at Job section*********/

	  $('#from_datte').on('change', function(event)
	  {
	   
		var datevv = 'Date : '+ $("#from_datte").val();
		$('#set_date').text(datevv);
	  
		});// ends function

		</script>

		<style>
	
	.bootstrap-datetimepicker-widget{
		z-index: 9999!important;
	}
</style>


