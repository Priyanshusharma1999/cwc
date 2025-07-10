 
	 <div class="page-wrapper">
			<div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Approve Request</h6>
								<hr>
								
					<?php if($this->session->flashdata('flashError_approve')) { ?>
					<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_approve'); ?> 
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
					<?php } ?>				
								
                    <?php
					     $uri = $this->uri->segment('4'); 
					 	$attributes = array('class' => '', 'id' =>'approve_request');
     					echo form_open_multipart('itonlinestationary/approverequisition/approverequest/'.$uri,$attributes);?>
						
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
							<input class="form-control" type="text" value="<?php echo $user_detail->display_name; ?>" readonly>
								</div>
                            </div>
							
							
							 <div class="col-sm-3">
								<div class="form-group">
									<label>Officer Designation</label>
						<input class="form-control" type="text" value="<?php echo $user_detail->designation; ?>" readonly>
								</div>
                            </div>

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
										<th>Item</th>
										<th>Remark</th>
										<?php if($req_detail->is_miscallenous == '1'){?> 
										<th>Employee Name</th>
										<th>Employee Designation</th>
										<?php } ?>	
										<th>Actual Stock</th>
										<th>Approved Stock</th>
										<th>Requisition Qty</th>
										<th>Approved Qty</th>
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
										
										
										<td><?php echo $request->req_remark; ?>
						<input type='text' name='remarks[]' value="<?php echo $request->req_remark; ?>" hidden>
										</td>

										<?php if($req_detail->is_miscallenous == '1'){?> 

										   <td><?php echo $request->employee_name; ?>
										   	<input type='text' name='empname[]' value="<?php echo $request->employee_name; ?>" hidden>
										   </td>

										   <td><?php echo $request->employee_desg; ?>
										   	<input type='text' name='empdesg[]' value="<?php echo $request->employee_desg; ?>" hidden>
										   </td>

										<?php } ?>	
										
										<td><?php echo $item_name->quantity_stock; ?>
											<input type='text'  value="<?php echo $remaining_stock; ?>" id="remstock" hidden>
										</td>

										<td><?php echo $item_name->approved_stock; ?></td>

									<td><?php echo $request->req_qty; ?>
						                  <input type='text' name='quantity[]' value="<?php echo $request->req_qty; ?>" id="reqty" hidden>
										</td>
										
										
					<td class="qtycont">
						 <?php if($remaining_stock == '0'){?>	

						 	 <input class="form-control qty" type="number" min="0" name="approveqty[]"  value="0" style="display:none;">

                              <span class="label label-danger">Out of stock</span>
						 <?php } else {?>
						 
		               <input class="form-control qty" type="number" min="0" name="approveqty[]"  value="<?php echo $request->approved_qty; ?>">
					    <span class="text-danger"></span>
					
						 <?php } ?>
					</td>
				</tr>
									
							<?php $i++; } } ?>	
							
								</tbody>
                            </table>
								
					       <button type="submit" name="submit" class="btn btn-primary">Save</button>

                           <a href="<?php echo base_url(); ?>itonlinestationary/approverequisition" class="btn btn-danger">Cancel</a>						   
					 <?php echo form_close();?>		
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
		
		<style>
		  .dataTables_wrapper{clear:both;}

		  .text-danger{font-size:12px;}
		</style>
		
		<script>
			
			   $('.qty').change(function(){

			   	  var msg = '';

			   	  $('.text-danger').html(msg);
                   
                   var approvedqnty = $(this).val();

                   approvedqnty = parseInt(approvedqnty);

                   var qnty1 = $(this).closest('tr').find('#remstock').val();

                   qnty1 = parseInt(qnty1);

                   var qnty2 = $(this).closest('tr').find('#reqty').val();

                    qnty2 = parseInt(qnty2);

                    if(approvedqnty>qnty1){
                      
                      msg = 'Approved quantity can not be greater than remaining_stock.';

                      $('.text-danger').html(msg);

                      return false;

                    } else if(approvedqnty>qnty2){
                         
                      msg = 'Approved quantity can not be greater than requisition quantity.';

                      $('.text-danger').html(msg);

                      return false;

                    }

			   });

		</script>
	
   