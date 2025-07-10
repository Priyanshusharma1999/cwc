   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Handover  List</h6>
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
											<th>Handover User</th>
											<th>Receiver</th>
											<th>Remarks</th>
											<th>Date</th>
											<th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
								<?php 
									if($handover_list) {
											$i=1;
											foreach($handover_list as $list) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
											<td>
											<?php 
											 $huser = $this->Base_model->get_record_by_id('users',array('user_id'=>$list->handover_user));
											 echo $huser->display_name; 
											?>	
										  </td>

                                           <td>
                                            <?php 
											 $ruser = $this->Base_model->get_record_by_id('users',array('user_id'=>$list->reciever_user));
											 echo $ruser->display_name; 
											?>	
                                           </td>

											<td><?php echo $list->hand_remarks; ?></td>

											 <td><?php echo date('d F Y', strtotime($list->created_date)); ?></td>

                                            <td><?php if($list->otp_status == '0'){?>
                                             
                                              <span class="label label-primary">Pending</span>
                                                    
                                            <?php } else if($list->otp_status == '1'){?>
                                              
                                              <span class="label label-success">Approved</span>

                                            <?php } else {?>
                                               
                                               <span class="label label-danger">Rehjected</span>

                                            <?php } ?></td>
											
                                         <td>

									<a href="<?php echo base_url('onlinestationary/Handoveritems/viewitems/'.$list->handover_id) ?>" class="btn btn-sm btn-info">View Items</a>

                                 <?php if($list->otp_status == '0'){?>

									<a href="<?php echo base_url('onlinestationary/Handoveritems/Verifyhandover/'.$list->handover_id) ?>" class="btn btn-sm btn-success">Verify Handover</a>

								<?php } ?>	
											   
											</td>
                                        </tr>
									<?php $i++; } } else { ?>
										
										<tr><td>No List found</td></tr>
										
									<?php } ?>	
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>