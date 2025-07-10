 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Pension List</h6>
								<hr>
								
							
						<?php if($this->session->flashdata('flashSuccess_pension')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_pension');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>

						<?php if($this->session->flashdata('flashSuccess_orgcertificate')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_orgcertificate');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>

							
							<?php
							 $sesssion_id = $this->session->userdata('applicant_user_id');
							$attributes = array('class' => 'form-inline sr-form', 'id' =>'searchpension');
							echo form_open_multipart('pension/search_penion/',$attributes);?> 

						    <div class="form-group">
							 <select  class="form-control" name="pension_status">
							   <option selected="selected" value="">Pension Status</option>
							   <option value="All">All</option>
							   <option value="Pending">Pending</option>
							   <option value="Settled">Settled</option>
						     </select>
							 </div>

							 <div class="form-group">
							 <select  class="form-control" name="pension_type">
							   <option selected="selected" value="">Pension Type</option>
							   <option value="POPSEF">Status Of Pending old Pension Scheme(Except Family Pension)</option>
							   <option value="POPSOF">Status Of Pending old Pension Scheme(Only Family Pension)</option>
							   <option value="PNPSEF">Status Of Pending New Pension Scheme(Except Family Pension)</option>
							   <option value="PNPSOF">Status Of Pending New Pension Scheme(Only Family Pension)</option>
						     </select>
							 </div>

							  <div class="form-group">
							   <button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
	                         </div>

						   <?php echo form_close();?>
								
							<?php 
							 $session_id = $this->session->userdata('applicant_user_id');
						     $user_data = $this->Base_model->get_record_by_id('users', array('USERS_ID' => $session_id));
							?>
							
							<?php if($user_data->ROLE_ID == 1 || $user_data->ROLE_ID == 2 || $user_data->ROLE_ID == 5)
					         { ?>
							 
								<a href="<?php echo site_url('pension/addpension_form/'.$session_id);?>" class="btn btn-success pull-right"style="margin-bottom:20px;"><i class="fa fa-plus"></i>Add Pension</a>
								
								<?php } ?>

								 <?php if($user_data->ROLE_ID == 2)
						         { ?>
							 
								<a  href="<?php echo base_url('pension/generate_certificate/'); ?>" class="btn btn-warning pull-right"style="margin-bottom:20px;margin-right:20px;">Generate Certicate</a>
								
								<?php } ?>
								
                               <table class="display table table-stripped table-bordered table-responsive datatable" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>PPO Number</th>
											<th>Name of Employee/Pensioner</th>
											<th>Designation of Employee/Pensioner</th>
											<th>Date Of Retirement</th>
											<th>Date Of Death</th>
                                            <th>Pension Status</th>
											<th style="width:15%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
										if($all_pensions) {
											$i=1;
											foreach($all_pensions as $pensions) { ?>

                                        <tr>
                                            <td><?php echo $i; ?></td>
											<td>
											  <?php 
											     if($pensions->PPO_NO){
													 echo $pensions->PPO_NO;
												 } else {
													  echo 'N/A';
												 } ?>
											</td>
                                            <td><?php  echo $pensions->EMPLY_NAME; ?></td>

                                            <td><?php  if(!empty($pensions->EMP_DESG)){

                                            	echo $pensions->EMP_DESG;

                                            } else {
                                            	echo 'N/A';
                                            } ?></td>
											
											<td>
											  <?php 
											     if($pensions->DATE_RETIREMENT){
													$date = $pensions->DATE_RETIREMENT;
													$date = date('d F, Y', strtotime($date));
											        if($date=='01 January, 1970')
													{
														echo 'N/A';
													}

													else
													{
														echo $date;
													}
												 } else {
													  echo 'N/A';
												 } ?>
										    </td>
											
											<td>
												  <?php 
											     if($pensions->DATE_DEATH){
													$date = $pensions->DATE_DEATH;
													$date = date('d F, Y', strtotime($date));
													if($date=='01 January, 1970')
													{
														echo 'N/A';
													}

													else
													{
														echo $date;
													}
											        
												 } else {
													  echo 'N/A';
												 } ?>
										    </td>
											
											<td>
												<?php  
													if($pensions->PENSION_STATUS=='Settled')
													{
														echo 'Settled';
													}
													else
													{
														echo $pensions->PENSION_STATUS;
													}
												 ?>
												 	
												 </td>
                                            <td>
                                            	<?php $session_id = $this->session->userdata('applicant_user_id'); ?>
											   <?php if($user_data->ROLE_ID == 1 || $user_data->ROLE_ID == 2)
						                       { ?>
											   <a href="<?php echo base_url('pension/edit_pension/'.$pensions->PENSION_ID).'/'.$session_id ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											   <!-- <a data-toggle="modal"  data-target="#deleteModal" onclick="remove_circle(<?php //echo $pensions->PENSION_ID; ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> -->
											   <button id="del-<?php echo $pensions->PENSION_ID;?>" data-toggle="modal"  data-target="#deleteModal" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>

											    <a href="<?php echo base_url('pension/view_pension/'.$pensions->PENSION_ID) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
											   <?php } else if($user_data->ROLE_ID == 3){ ?>
											   	<a href="<?php echo base_url('pension/edit_pension/'.$pensions->PENSION_ID.'/'.$session_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											   	<a href="<?php echo base_url('pension/view_pension/'.$pensions->PENSION_ID) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
											   	<?php } else{?>
											   <a href="<?php echo base_url('pension/view_pension/'.$pensions->PENSION_ID) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
											   <?php }?>
											</td>
                                        </tr>
										
										<?php $i++; } } else { ?>
										
										<tr><td>No Pension Record found</td></tr>
										
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
										<h4 class="modal-title">Delete Pension Record</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this Pension Record?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<button type="button" class="btn btn-danger" id="delValue-" data-dismiss="modal">Yes</button>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div><!-- /.example-modal -->
				<!-- ./Delete Popup modal -->

					<script type="text/javascript">

					$("[id ^='del-']").click(function(){
						var requestID  = $(this).attr('id');
						var requestArr = requestID.split('-');
					$("[id ^='delValue-']").attr("id","delValue-"+requestArr[1]);
					});
					$("[id ^='delValue-']").click(function(){
						 var requestID  = $(this).attr('id');
						 var requestArr = requestID.split('-');
						 var base_url = "<?php echo base_url(); ?>";
						 var session_id = "<?php echo $this->session->userdata('applicant_user_id') ?>";
						 var url=base_url+'Pension/delete_pension';
						$.ajax({
								method: "POST",
								url: url,
								data: {id:requestArr[1],session_id:session_id},
								success: function(data) {
									window.location.reload();
								}
							});
					});

				</script>
	