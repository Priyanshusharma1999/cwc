
    <?php $this->load->view('admin/header.php');?>
	
	 <?php $this->load->view('admin/topmenu.php');?>
	 
	<?php $this->load->view('admin/sidebar.php');?>
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Job List</h6>
								<hr>
								
								<form class="form-inline sr-form" action="#">
								  <div class="form-group">
									<select required="required" class="form-control">
									   <option selected="selected" value="">Select Prefered region</option>
										<option value="1">UGBO, Lucknow</option>
										<option value="2">B&amp;BBO, Shillong</option>
										<option value="3">C&amp;SRO, Coimbatore</option>
										<option value="4">Chief Engineer(P&amp;D)</option>
										<option value="5">KGBO, Hyderabad</option>
										<option value="6">LGBO Patna</option>
										<option value="7">MERO, Bhubaneswar</option>
										<option value="8">MCO, Nagpur</option>
										<option value="9">Monitoring South Organization</option>
										<option value="10">NBO, Bhopal</option>
										<option value="11">YBO, New Delhi</option>
										<option value="12">NTBO, Gandhinagar</option>
										<option value="13">IBO, Chandigarh</option>
										<option value="14">TBO, Siliguri</option>
									</select>
								  </div>
								  <div class="form-group">
									<select required="required" class="form-control">
									   <option selected="selected" value="">Select Circle</option>
									   <option  value="">Hydrological Obervation</option>
									   <option  value="">Circle A</option>
									   <option  value="">Circle B</option>
									   <option  value="">Circle C</option>
									</select>
								  </div>
								  <div class="form-group">
									<select required="required" class="form-control">
									   <option selected="selected" value="">Select Post</option>
										<option value="1">Skilled Work Assistant-SWA-01</option>
										<option value="2">Machine Operator Grade-II-MO-II</option>
										<option value="3">OutBoard Engine Driver-OBED</option>
										<option value="4">Mechanic Grade-II-MEC-II</option>
										<option value="5">Carpenter Grade-II-CAR-II</option>
										<option value="6">Electrician Grade-II-ELEC-II</option>
										<option value="7">DrillOperator Grade-II-DOP-II</option>
										<option value="8">Motor Vehicle Driver OrdinaryGrade-MVD-OG</option>
										<option value="9">Other-OTH</option>
									</select>
								  </div>
								  <button type="submit" class="btn btn-success btn-search">Search</button>
								</form>
								
                                <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>Reference No.</th>
											<th>Region Name</th>
											<th>Circle Office</th>
											<th>Job Title</th>
                                            <th>Post Date</th>
											<th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											  <span class="label label-success">Accepted</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
										
										 <tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											  <span class="label label-success">Accepted</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
										
										
										 <tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											  <span class="label label-primary">Pending</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
										
										
										 <tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											  <span class="label label-success">Accepted</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
										
										
										 <tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											   <span class="label label-danger">Rejected</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
										
										 <tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											  <span class="label label-success">Accepted</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
										
										
										 <tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											  <span class="label label-primary">Pending</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
										
										
										
										 <tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											   <span class="label label-danger">Rejected</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
										
										
										
										 <tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											  <span class="label label-success">Accepted</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
										
										 <tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											  <span class="label label-danger">Rejected</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
										
										<tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											  <span class="label label-danger">Rejected</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
										
										<tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											  <span class="label label-success">Accepted</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
										
										
										<tr>
                                            <td>Aj-001</td>
											<td>UGBO,Lucknow</td>
											<td>Hydrological Obeservation</td>
                                            <td>Skilled Work Assistant</td>
                                            <td>25/04/2018</td>
											<td>
											  <span class="label label-success">Accepted</span>
											</td>
                                            <td>
											   <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
									
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      
<?php $this->load->view('admin/footer.php');?>	
