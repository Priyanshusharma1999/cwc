 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Audit Logs</h6>
								<hr>
								
								
								
						<?php if($this->session->flashdata('flashSuccess_user')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_user');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>
		
								<?php
								$attributes = array('class' => 'form-inline sr-form', 'id' =>'searchuser');
								echo form_open_multipart('users/search_user/',$attributes);?> 
							<!-- 	  <div class="form-group">
									<input type="text" class="form-control" name="name" placeholder="Enter Name" >
								  </div>
								 -->
								 <!--  <div class="form-group">
								  <button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
								  </div> -->
								<?php echo form_close();?>
								
								
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>User Name</th>
											<th>Email</th>
											<th>IP Address</th>
											<th>Login Status</th>
											<th>Activity</th>
											<th>Date</th>
											<th>Time</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
										if($all_user_logs) {
											$i=1;
											foreach($all_user_logs as $users) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
											<td><?php echo $users->USERNAME; ?></td>
                                            <td><?php echo $users->USEREMAIL; ?></td>
                                            <td><?php echo $users->CLIENT_IP; ?></td>
                                            <td><?php echo $users->LOGINSTATUS; ?></td>
											<td><?php echo $users->ACTIVITY; ?></td>
											<td><?php echo date('d F, Y', strtotime($users->CREATEDDATED)); ?></td>
											<td><?php echo date('h:i:s a', strtotime($users->CREATEDDATED)); ?></td>
                                           
                                        </tr>
										
									<?php $i++; } } else { ?>
										
										<tr><td>No Records found</td></tr>
										
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
										<h4 class="modal-title">Delete User</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this user?</p>
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
						 var url=base_url+'Users/delete_users';
						$.ajax({
								method: "POST",
								url: url,
								data: {id:requestArr[1]},
								success: function(data) {
									window.location.reload();
								}
							});
					});

				</script>

				<script type="text/javascript">
					/*function remove_circle(id) 
					{
						$("#delete_itemId").val(id);
					}*/

				</script>