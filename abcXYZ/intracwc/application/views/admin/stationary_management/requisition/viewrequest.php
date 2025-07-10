   
	 <div class="page-wrapper">
			<div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">General Store Requisition Form</h6>
								<hr>
					
						<p class="col-sm-6">        
						  <label>Officer Name</label><span><?php  echo $user_detail->user_name; ?></span>
						</p>
						<p class="col-sm-6">						
						 <label>Designation</label><span><?php  echo $user_detail->designation; ?></span>	
						</p>

						<p class="col-sm-6">	

						  <?php 
     					      $udet = $this->Base_model->get_record_by_id('users',array('user_id'=>$user_detail->user_id));
     					      $empdetail = $this->Base_model->get_record_by_id('employee',array('employee_id'=>$udet->employee_id));
     					      $office = $this->Base_model->get_record_by_id('employee_office',array('office_id'=>$empdetail->post));
     					  ?>

     					   <label>Directorate</label><span><?php  echo $office->office_name; ?></span>	

						</p>

						<p class="col-sm-6">					   
						 <label>Wing</label><span><?php  echo $wing->wing_name; ?></span>	
						<p>
						<p class="col-sm-6">					   
						 <label>Section</label><span><?php  echo $section->section_name; ?></span>
						</p>	


                    <?php if($req_detail->is_miscallenous == '0'){?>   

						<p class="col-sm-6">        
						  <label>Director</label><span><?php echo $req_detail->dir_no; ?></span>
						</p>
						<p class="col-sm-6">						
						 <label>Dupty Director</label><span><?php echo $req_detail->dydir_no; ?></span>	
						</p>
						<p class="col-sm-6">					   
						 <label>A.D./EAD</label><span><?php echo $req_detail->adead_no; ?></span>	
						<p>
						<p class="col-sm-6">					   
						 <label>Dman/JE Comp</label><span><?php echo $req_detail->dman_no; ?></span>
						</p>
						<p class="col-sm-6">         
						  <label>S.O.</label><span><?php echo $req_detail->so_no; ?></span>
						</p>
						<p class="col-sm-6">						
						 <label>Asstt.</label><span><?php echo $req_detail->asstt_no; ?></span>	
						</p>
						<p class="col-sm-6">					   
						 <label>UDC/LDC</label><span><?php echo $req_detail->udcldc_no; ?></span>	
						<p>
						<p class="col-sm-6">					   
						 <label>P.A./Steno.</label><span><?php echo $req_detail->pa_no; ?></span>
						</p>
						<p class="col-sm-6">					   
						 <label>Others</label><span><?php echo $req_detail->others; ?></span>
						</p>

				<?php  } ?>		
						
						  <table id="myTable" class="table table-stripped table-bordered table-responsive" >
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Item Name</th>
										<th>Quantity</th>
										<th>Approved Quantity</th>
										<th>Remarks</th>
									<?php if($req_detail->is_miscallenous == '1'){?>	
										<th>Employee Name</th>
										<th>Employee Designation</th>
									<?php } ?>	
									</tr>
								</thead>
								<tbody>
						
							<?php 
								if($all_request) {
									$i=1;
									foreach($all_request as $request) { ?>
									  <tr>
										 <td><?php echo $i; ?></td>
										 
										 <td>
								   <?php 
								
							       $item_name = $this->Base_model->get_record_by_id('osr_item_master', array('item_id' => $request->item_id));
								    echo $item_name->item_name; 
								  ?>
								
										 </td>
										 <td><?php  echo $request->req_qty; ?></td>
										  <td><?php echo $request->approved_qty; ?></td>
										 <td><?php  echo $request->req_remark; ?></td>

									<?php if($req_detail->is_miscallenous == '1'){?>	
								   	
										<td><?php echo $request->employee_name; ?></td>

										<td><?php echo $request->employee_desg; ?></td>

								   <?php } ?>	

									  </tr>
							  <?php $i++; } } else { ?>
									
									<tr><td>No Request found</td></tr>
									
								<?php } ?>	
										
								</tbody>
                            </table>
						
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
		
		
		<style>
		  p label{width:20%;}
		</style>
	