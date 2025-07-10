   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Vendor Employee Details</h6>
								<hr>

                             <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Employee Name</th>
											<th>Designation</th>
											<th>Email</th>
											<th>Mobile No.</th>
											<th>Landline No.</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
						<?php if($employee_list)
						  {  $i=1;
							foreach($employee_list as $employee){?>
								<tr>
									<td><?php echo $i; ?></td>
									
									<td><?php echo $employee->vendor_employee_name; ?></td>
									
									<td>
								
								<?php echo $employee->vendor_employee_designation; ?>
									</td>
									
									<td><?php echo $employee->vendor_employee_email; ?></td>
									
									<td><?php echo $employee->vendor_employee_mobile_no; ?></td>
									
									<td>
									 <?php echo $employee->vendor_employee_landline_no; ?>
									</td>
								</tr>
							<?php $i++; }} else {?>

							   <tr>
								 <td colspan="9">No employee list found.</td>
							   </tr>
						
							<?php } ?>	
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
