   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Defected Item List</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_item')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_item');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>
								
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Item Name</th>
											<th>Quantity</th>
											<th>Remarks</th>
											<th>Return By</th>
											<th>Return Date</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
								<?php 
									if($all_items) {
											$i=1;
											foreach($all_items as $item) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
											<td>
											<?php 
											 $itemname = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$item->item_id,'service_type'=>'2'));
											 echo $itemname->item_name; 
											?>	
											</td>

											<td><?php echo $item->quantity; ?></td>
											<td><?php echo $item->remarks; ?></td>
                                            <td>
                                            <?php 
											 $empname = $this->Base_model->get_record_by_id('users',array('user_id'=>$item->user_id));
											 echo $empname->display_name; 
											?>	
										   </td>
                                            <td><?php echo date('d F Y', strtotime($item->return_date)); ?></td>

                                            <td>
                                              <?php if($item->approve_status == '0'){?>

                                            	  <a data-toggle="modal"  data-target="#deleteModal" onclick="changestatus(<?php echo $item->return_id; ?>,'Approve')" class="btn btn-sm btn-primary">Approve</a>

                                            	   <a data-toggle="modal"  data-target="#deleteModal" onclick="changestatus(<?php echo $item->return_id; ?>,'Reject')" class="btn btn-sm btn-danger">Reject</a>

                                              <?php } else if($item->approve_status == '1'){?>
                                                
                                                <i class="fa fa-check-circle" style="font-size:25px;color:#55ce63;"></i>

                                              <?php } else if($item->approve_status == '2'){?>
                                                  
                                                 <i class="fa fa-times-circle" style="font-size:25px;color:red"></i>

                                              <?php } else {} ?>
                                             
                                            </td>

                                      </tr>
									<?php $i++; } } else { ?>
										
										<tr><td>No Defected items list found</td></tr>
										
									<?php } ?>	
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <div class="example-modal">
			<div class="modal fade" aria-hidden="true" id="deleteModal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Change Status</h4>
						</div>
						<div class="modal-body">
							<p>Are you sure to change status of return item?</p>
						</div>
						<div class="modal-footer">
							<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
							<?php echo form_open(base_url().'itonlinestationary/Returnitems/changestatus'); ?>
								<input name="return_id" type="hidden" id="return_id" value="">
								<input name="status" type="hidden" id="status" value="">
								<input class="btn btn-primary" type="submit" value="Yes">
							<?php echo form_close() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
		

        <script>
        	
        	function changestatus(id,status){

        		$("#return_id").val(id);
        		$("#status").val(status);

        	}

        </script>