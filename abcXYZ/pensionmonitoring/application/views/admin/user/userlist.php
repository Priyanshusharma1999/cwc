 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">User List</h6>
								<hr>
								
								
								
						<?php if($this->session->flashdata('flashSuccess_user')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_user');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>
		
								<?php
								$attributes = array('class' => 'form-inline sr-form', 'id' =>'searchuser');
								echo form_open_multipart('users/search_user/',$attributes);?> 
								  <div class="form-group">
									<input type="text" class="form-control" name="name" placeholder="Enter Name" >
								  </div>
								
								  <div class="form-group">
									<select name="org_name" class="form-control">
									   <option selected="selected" value="">Select Organisation</option>
									   <option value="All">All</option>
									   <?php foreach($all_organizations as $org) { ?>
										<option value="<?php echo $org->ORGANIZATION_ID; ?>">
										   <?php echo $org->ORGNAME; ?>
										 </option>
									   <?php } ?>
									</select>
								  </div>
								  <div class="form-group">
								  <button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
								  </div>
								<?php echo form_close();?>
								<?php $ssession_id = $this->session->userdata('applicant_user_id'); ?>
								<a href="<?php echo site_url('users/addusers/'.$ssession_id);?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add User</a>
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>User Name</th>
											<th>Full Name</th>
											<th>User Role</th>
											<th>Mobile No.</th>
											<th>Email Address</th>
                                            <th style="width:15%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
										if($all_users) {
											$i=1;
											foreach($all_users as $users) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
											<td><?php echo $users->LOGONID; ?></td>
                                            <td><?php echo $users->FULLNAME; ?></td>
                                            <td><?php 
                                          $role  = $this->Base_model->get_record_by_id('role', array('ROLE_ID' => $users->ROLE_ID));
                                          echo $role->ROLE; 
                                            ?></td>
                                            <td><?php echo $users->MOBILE; ?></td>
											<td><?php echo $users->EMAIL; ?></td>
                                            <td>
                                            	<?php 
                                            		$session_user_id = $this->session->userdata('applicant_user_id');
                                            	?>
											   <a href="<?php echo base_url('Users/edit_user/'.$users->USERS_ID.'/'.$session_user_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											   <a href="<?php echo base_url('Users/view_user/'.$users->USERS_ID) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
											  <!--  <a data-toggle="modal"  data-target="#deleteModal" onclick="remove_circle(<?php //echo $users->USERS_ID; ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> -->
											  <button id="del-<?php echo $users->USERS_ID;?>" data-toggle="modal"  data-target="#deleteModal" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
											</td>
                                        </tr>
										
									<?php $i++; } } else { ?>
										
										<tr><td>No Users found</td></tr>
										
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
						 var session_id = "<?php echo $this->session->userdata('applicant_user_id') ?>";
						 var url=base_url+'Users/delete_users';
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

				<script type="text/javascript">
					/*function remove_circle(id) 
					{
						$("#delete_itemId").val(id);
					}*/

				</script>