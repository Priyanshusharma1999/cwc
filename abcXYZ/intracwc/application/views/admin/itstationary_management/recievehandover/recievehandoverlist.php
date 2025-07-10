   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Reciever  List</h6>
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
									if($rechandover_list) {
											$i=1;
											foreach($rechandover_list as $list) { ?>
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

                                            <td><?php if(empty($list->handover_otp)){?>
                                             
                                              <span class="label label-primary">Pending</span>
                                                    
                                            <?php } else if(!empty($list->handover_otp)){?>
                                              
                                              <span class="label label-success">Approved</span>

                                            <?php } else {?>
                                               
                                               <span class="label label-danger">Rehjected</span>

                                            <?php } ?></td>
											
                                         <td>

									<a href="<?php echo base_url('itonlinestationary/Recievehandover/viewitems/'.$list->handover_id) ?>" class="btn btn-sm btn-info">View Items</a>

								   <?php if(empty($list->handover_otp)){?> 

									<a href="<?php echo base_url('itonlinestationary/Recievehandover/Accepthandover/'.$list->handover_id) ?>" class="btn btn-sm btn-success">Accept Handover</a>
								
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