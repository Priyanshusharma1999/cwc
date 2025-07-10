   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Vendor Details</h6>
								<hr>
		
                             <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Company Name</th>
											<th>Address</th>
											<th>Mobile No.</th>
											<th>Landline No.</th>
                                            <th>View Employee Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
						<?php if($vendor_list)
						  {  $i=1;
							foreach($vendor_list as $vendors){?>
								<tr>
									<td><?php echo $i; ?></td>
									<td><?php echo $vendors->company_name; ?></td>
									<td><?php echo $vendors->address; ?></td>
									<td><?php echo $vendors->mobile_no; ?></td>
									<td><?php echo $vendors->landline_no; ?></td>
									<td>
									<a href="<?php echo base_url('nonitcomplaint/vendor/employee_details/'.$vendors->vendor_id) ?>">View</a>
									</td>
								</tr>
							<?php $i++; }} else {?>

							   <tr>
								 <td colspan="9">No vendor details found.</td>
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
