 
	 <div class="page-wrapper">
			<div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Approve Request Detail</h6>
								<hr>
								
					<?php if($this->session->flashdata('flashError_approve')) { ?>
					<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_approve'); ?> 
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
					<?php } ?>				
								
                    <?php
					     $uri = $this->uri->segment('4'); 
					 	$attributes = array('class' => '', 'id' =>'approve_request');
     					echo form_open_multipart('onlinestationary/approverequisition/approverequest/'.$uri,$attributes);?>

     					 <?php 
     					      $udet = $this->Base_model->get_record_by_id('users',array('user_id'=>$user_detail->user_id));
     					      $empdetail = $this->Base_model->get_record_by_id('employee',array('employee_id'=>$udet->employee_id));
     					      $office = $this->Base_model->get_record_by_id('employee_office',array('office_id'=>$empdetail->post));
     					  ?>
						
						   <div class="col-sm-3">
								<div class="form-group">
									<label>Requisition Id</label>
								<input class="form-control" type="text" name="reqid" value="<?php echo $req_detail->req_id; ?>" readonly>
								</div>
                            </div>
							
							 <div class="col-sm-3">
								<div class="form-group">
									<label>Requisition Date</label>
				                    <input class="form-control" type="text" name="reqdate" value="<?php echo $req_detail->req_date; ?>" readonly>
								</div>
                            </div>
							
							 <div class="col-sm-3">
								<div class="form-group">
									<label>Officer Name</label>
							         <input class="form-control" type="text" value="<?php echo $user_detail->user_name; ?>" readonly>
								</div>
                            </div>
							
							
							 <div class="col-sm-3">
								<div class="form-group">
									<label>Officer Designation</label>
						            <input class="form-control" type="text" value="<?php echo $user_detail->designation; ?>" readonly>
								</div>
                            </div>

                            <div class="col-sm-3">
								<div class="form-group">
									<label>Office/Directorate/Section</label>
						            <input class="form-control" type="text" value="<?php echo $office->office_name; ?>" readonly>
								</div>
                            </div>

                        <hr style="width: 100%;border-top: 2px solid #eee;">    

                       <?php if($req_detail->is_miscallenous == '0'){?>      

                          <div class="col-sm-3">
							<div class="form-group">
								<label>Director</label>
						        <input class="form-control" type="text" value="<?php echo $req_detail->dir_no; ?>" readonly>
							</div>
                          </div>

                           <div class="col-sm-3">
							<div class="form-group">
								<label>Dupty Director</label>
						        <input class="form-control" type="text" value="<?php echo $req_detail->dydir_no; ?>" readonly>
							</div>
                          </div>

                           <div class="col-sm-3">
							<div class="form-group">
							   <label>A.D./EAD</label>
						       <input class="form-control" type="text" value="<?php echo $req_detail->adead_no; ?>" readonly>
							</div>
                          </div>

                           <div class="col-sm-3">
							<div class="form-group">
								<label>Dman/JE Comp</label>
						        <input class="form-control" type="text" value="<?php echo $req_detail->dman_no; ?>" readonly>
							</div>
                          </div>

                           <div class="col-sm-3">
							<div class="form-group">
								<label>S.O.</label>
						        <input class="form-control" type="text" value="<?php echo $req_detail->so_no; ?>" readonly>
							</div>
                          </div>

                          <div class="col-sm-3">
							<div class="form-group">
							   <label>Asstt.</label>
						       <input class="form-control" type="text" value="<?php echo $req_detail->asstt_no; ?>" readonly>
							</div>
                          </div>

                          <div class="col-sm-3">
							<div class="form-group">
							   <label>UDC/LDC</label>
						      <input class="form-control" type="text" value="<?php echo $req_detail->udcldc_no; ?>" readonly>
							</div>
                          </div>

                          <div class="col-sm-3">
							<div class="form-group">
							   <label>P.A./Steno.</label>
						       <input class="form-control" type="text" value="<?php echo $req_detail->pa_no; ?>" readonly>
							</div>
                          </div>

                          <div class="col-sm-3">
							<div class="form-group">
							   <label>Others</label>
						       <input class="form-control" type="text" value="<?php echo $req_detail->others; ?>" readonly>
							</div>
                          </div>

                       <?php } ?>   
                       
	                    <table class="display datatable table table-stripped table-bordered table-responsive">
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Item Name</th>
										<th>Available Stock</th>
										<th>Remark</th>
									<?php if($req_detail->is_miscallenous == '1'){?>	
										<th>Employee Name</th>
										<th>Employee Designation</th>
									<?php } ?>	
										
										<th>Requisition Qty</th>
										<th>Approved Qty</th>
										<th>Issued Qty</th>
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
						<input type='text' name='item[]' value="<?php echo $request->item_id; ?>" hidden>
										</td>

										<td><?php echo $item_name->quantity_stock; ?></td>
										
										
										<td><?php echo $request->req_remark; ?>
						<input type='text' name='remarks[]' value="<?php echo $request->req_remark; ?>" hidden>
										</td>
										
								   <?php if($req_detail->is_miscallenous == '1'){?>	
								   	
										<td><?php echo $request->employee_name; ?></td>

										<td><?php echo $request->employee_desg; ?></td>

								   <?php } ?>		
                                     
                                     <td><?php echo $request->req_qty; ?>
						                <input type='text' name='quantity[]' value="<?php echo $request->req_qty; ?>" hidden>
										</td>
										
										
										<td class="qtycont">
											<?php echo $request->approved_qty; ?>
										</td>

										<td><?php echo $request->issued_qty; ?></td>
				</tr>
									
							<?php $i++; } } ?>	
							
								</tbody>
                            </table>
								
					    
					 <?php echo form_close();?>		
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
		
		<style>
		  .dataTables_wrapper{clear:both;}
		</style>
		
		
	
  