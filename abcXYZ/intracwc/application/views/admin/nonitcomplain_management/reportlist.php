   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Report List</h6>
								<hr>
								<form class="form-inline sr-form" action="#">
								  
								   <div class="form-group">
									<select required="required" class="form-control">
									   <option selected="selected" value="">Status</option>
									    <option value="1">All</option>
										<option value="1">Pending</option>
										<option value="1">Resolved</option>
									</select>
								  </div>
								 
								  <div class="form-group">
									<select required="required" class="form-control">
									   <option selected="selected" value="">Service</option>
									<option selected="selected" value="">SERVICE | VENDOR</option>
									<option value="13">A.C. Maintenance | Technical Services</option>
									<option value="9">Carpenter | S.S. Enterprises</option>
									<option value="12">Cleaning &amp; Sweeping | Sovereign Enterprises</option>
									<option value="1">Computer | dell</option>
									<option value="3">Computer Hardware | Corporate Infotech Pvt. Ltd.</option>
									<option value="7">Duplo Machine | HCL Service Limited</option>
									<option value="10">Electrician | Juli Electrician</option>
									<option value="28">EPABX System of Addl. Secretary's Office | Gurusons Communication(P) Ltd.</option>
									<option value="30">EPABX System of Block-3 CGO Complex | Gurusons Communication(P) Ltd.</option>
									<option value="22">EPABX System of Chief Adviser's | Teen Telecommunication(P) Limited</option>
									<option value="23">EPABX System of Comm.(SP) | Teen Telecommunication(P) Limited</option>
									<option value="29">EPABX System of Indus / Ganga Wing | Gurusons Communication(P) Ltd.</option>
									<option value="20">EPABX System of JS(A), JS &amp;FA, Office | Teen Telecommunication(P) Limited</option>
									<option value="21">EPABX System of JS(PP) | Teen Telecommunication(P) Limited</option>
									<option value="24">EPABX System of Krishi Bhawan Office of MoWR | Teen Telecommunication(P) Limited</option>
									<option value="25">EPABX System of Lok Nayak Bhawan | Teen Telecommunication(P) Limited</option>
									<option value="17">EPABX System of Minister's Office | Teen Telecommunication(P) Limited</option>
									<option value="19">EPABX System of MoS's office | Teen Telecommunication(P) Limited</option>
									<option value="18">EPABX System of Residential office of Minister's | Teen Telecommunication(P) Limited</option>
									<option value="26">EPABX System of Residential Office of MoS's | Oassis Telecommunication</option>
									<option value="27">EPABX System of Secretary's Office | Gurusons Communication(P) Ltd.</option>
									<option value="31">Fax Machine | Classes Repographic</option>
									<option value="2">Furniture | Sharma &amp; sons</option>
									<option value="16">Intercom System at SSB | Teen Telecommunication(P) Limited</option>
									<option value="6">Kyocera Multifunction Machine | Ankita Enterprises</option>
									<option value="5">Photocopier Machine` | Sympoh Marketing Pvt. Ltd</option>
									<option value="8">Set Making Machine(Collator) | TECHMART DIGITAL SYSTEM PRIVATE LIMITED</option>
									<option value="4">UPSs | Corporate Infotech Pvt. Ltd.</option>
									<option value="11">Water Dispenser | abc</option>
									</select>
								  </div>
								  
								   <div class="form-group">
									<select required="required" class="form-control">
									   <option selected="selected" value="">Employee</option>
										<option value="">SELECT EMPLOYEE</option>
										<option value="3842">A DEVANANDAN</option>
										<option value="3562">ABHIJEET KASHLIWAL</option>
										<option value="3238">ABHINAV SRIVASTAVA</option>
										<option value="3239">ABHISHEK GAURAV</option>
										<option value="3563">ABHISHEK GUPTA</option>
										<option value="3240">ADARSH M S</option>
										<option value="3241">ADITYA MISHRA</option>
										<option value="3564">ADITYA SARWESWARA SARMA MOOLA</option>
										<option value="3220">ADITYA SHARMA</option>
										<option value="3130">Ajay Kumar Sinha</option>
										<option value="3565">AJAY KUMAR SINHA</option>
										<option value="3566">AKHIL AKHOURI</option>
										<option value="3242">AKSHAT JAIN</option>
										<option value="3243">ALOK KUMAR BAJPAI</option>
										<option value="3567">ALOK PAUL KALSI</option>
										<option value="3244">ALTAF HUSSAIN</option>
									</select>
								  </div>
								  
								  <div class="form-group">
									 <div class="cal-icon">
									  <input class="form-control datetimepicker" placeholder="From Date" type="text">
								     </div> 
								  </div>
								  
								  
								  <div class="form-group">
									<div class="cal-icon">
									  <input class="form-control datetimepicker" placeholder="To Date" type="text">
								     </div> 
								  </div>
								  
									  <button type="submit" class="btn btn-success btn-search">Show Report</button>
									 
								</form>
								
								<button onclick="saveFile()" class="btn btn-danger pull-right">Export to Excel</button>
								
								
							 <!--  <button type="print" class="btn btn-primary pull-right" style="margin-right:20px;">
							    Print Data
							 </button> -->	
								
                       <table class="display datatable table table-stripped table-bordered table-responsive" id="example">
                                    <thead>
                                        <tr>
										    <th>S.No.</th> 
											<th>Complaint Category</th>
											<th>Name & Designation</th>
											<th>Location</th>
											<th>Complaint Registered On</th>
											<th>Complaint Resolved On</th>
											<th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											if($all_complaints) {
												$i=1;
												foreach($all_complaints as $complaints) { ?>
                                        <tr>
										    <td><?php echo $i;?></td>
											<td>
												<?php 
                                            	$complaint_data = $this->Base_model->get_record_by_id('category', array('category_id' => $complaints->complaint_type_id));
                                            	echo $complaint_data->category_name;
                                            	?>
											</td>
                                            <td>
                                            	<?php 
	                                            	$user_data = $this->Base_model->get_record_by_id('users', array('user_id' => $complaints->user_id));
	                                            	echo $user_data->user_name.'('.$user_data->designation.')';
                                            	?>
                                            </td>
											<td>
												<?php 
	                                            	$building_data = $this->Base_model->get_record_by_id('building', array('building_id' => $complaints->building_id));
	                                            	echo $building_data->building_name;
                                            	?>
											</td>
                                            <td><?php echo $complaints->date_created;?></td>
											<td>
												<?php 

													if(empty($complaints->date_resloved))
													{
														echo 'NA';
													}

													else
													{
														echo $complaints->date_resloved;
													}
													
												?>
													
											</td>
											<td><span class="label label-primary"></span><?php echo $complaints->status;?></span></td>
                                        </tr>
                                         <?php $i++;} } else { ?>
										<tr><td>No data found</td></tr>
										<?php } ?>
												
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <?php 

        	/*****************all report json code**********/

        		$all_comp= array();

        		foreach ($all_complaints as $comp) 
        		{
        			$complaint_data = $this->Base_model->get_record_by_id('category', array('category_id' => $comp->complaint_type_id));
        			$user_data = $this->Base_model->get_record_by_id('users', array('user_id' => $comp->user_id));
        			$building_data = $this->Base_model->get_record_by_id('building', array('building_id' => $comp->building_id));

        			$complain['Complaint Category'] =  $complaint_data->category_name;
        			$complain['Name & Designation'] 	=  $user_data->user_name.'('.$user_data->designation.')';
        			$complain['Location'] 		=  $building_data->building_name;
        			$complain['Complaint Registered On'] =  $comp->date_created;
        			$complain['Complaint Resolved On'] =  $comp->date_resloved;
        			$complain['Status'] 	=  $comp->status;

        			$all_comp[] = $complain;
	                

        		}//ends foreach

        		$json_complaint = json_encode($all_comp);
        	/************ends all report json code**********/
        ?>
		
		<style>
		  .form-inline .form-control{max-width:185px!important;}
		</style>

		<script>

			window.saveFile = function saveFile () 
			{
				var complaint_Array = <?php echo $json_complaint; ?>;
				var data1 = complaint_Array;

				if(data1.length==0)
		  		{
		  			var data1 =  [{'Complaint Category':'','Name & Designation':'','Location':'','Complaint Registered On':'','Complaint Resolved On':'','Status':''}];
		  		}

		  		else
			  	{
			  		var data1 = data1;
			  	}

			  	var opts = [{sheetid:'Annexure A',header:true}];
		    	var res = alasql('SELECT INTO XLSX("Report_nonit.xlsx",?) FROM ?',
		                     [opts,[data1]]);

			}//ends function
		</script>
      
	 
      
	 