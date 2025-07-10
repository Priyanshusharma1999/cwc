 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">IT Users List</h6>
								<hr>
								
								<?php if($this->session->flashdata('user_add_flashSuccess')) { ?>
								<div class='alert alert-success'> <?php echo $this->session->flashdata('user_add_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } else if($this->session->flashdata('user_delete_flashSuccess')) { ?>

								
								<div class='alert alert-success'> <?php echo $this->session->flashdata('user_delete_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } else if($this->session->flashdata('user_add_flashError')) { ?>

								
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('user_add_flashError'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 

							</div>
								<?php } else {echo '';} ?>


						<?php 

						     $user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id'))); 

			            	 foreach ($user_role_data as $role_id)
							   {
							   		$user_roles[]= $role_id->role_id;
							   }

			            	?>

								<?php
                                $attributes = array('class' => 'form-inline sr-form', 'id' =>'');
                                echo form_open_multipart('Administrator/User/search_user/',$attributes);?>
								  <div class="form-group">
									<select name="wing_name" class="form-control">
									    <option selected="selected" value="">Select Wing Name</option>
										<?php
											if(empty($all_wing))
											{
												echo '<option value="1">'.'Select Wing'.'</option>';
											}

											else
											{
												foreach ($all_wing as $wing)
						                      {   
						                         echo '<option value="'.$wing->wing_id.'">'.$wing->wing_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								  </div>
								
								  <div class="form-group">
									<select name="designation_name" class="form-control">
									   <option selected="selected" value="">Select Designation</option>
										<?php
											if(empty($all_designation))
											{
												echo '<option selected="selected" value="">Select Designation</option>';
											}

											else
											{
												foreach ($all_designation as $designation)
						                      {   
						                         echo '<option value="'.$designation->designation_name.'">'.$designation->designation_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								  </div>
								  
								  
								  <div class="form-group">
									<input class="form-control restrict_special_char" type="text" name="user_name" placeholder="User Name" value = "">
								  </div>
								  
								    <div class="form-group">
									<select name="status" class="form-control">
									   <option  value="">Select Status</option>
										<option value="1">Active</option>
										<option value="2">Deactive</option>
									</select>
								  </div>
								  
								  <button type="submit" type="submit" name="submit" class="btn btn-success btn-search">Search</button>
								  
								<?php echo form_close(); ?>

						<?php if (in_array("1", $user_roles) || in_array("16", $user_roles)){ ?>		
								
								<a href="<?php echo site_url();?>Administrator/User/add_user" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add User</a>

				    	<?php } ?>			

							<div class="table-responsive" style="width:100%;">
                               <table class="datatable table table-stripped table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
											<th>Designation</th>
											<th>Contact No.</th>
											<th>Email</th>
											<th>Status</th>
                                            <th style="width:15%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										if($all_user) {
										$i=1;
										foreach($all_user as $user) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $user->display_name;?></td>
											<td><?php echo $user->designation;?></td>
                                            <td><?php echo $user->contact_no;?></td>
											<td><?php echo $user->email;?></td>
											<td>
												<?php

													if($user->status==1) 
													{
														echo '<span class="label label-success-border">Active</span>';
													}

													else if($user->status==0) 
													{
														echo '<span class="label label-danger-border">Deactive</span>';
													}

													else
													{
														echo '';
													}

												?>
											</td>
                                            <td>
											   <a href="<?php echo base_url('Administrator/User/view_user/'.$user->user_id) ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>

											<?php if (in_array("1", $user_roles) || in_array("16", $user_roles)){ ?>
											   
											    <a href="<?php echo base_url('Administrator/User/edit_user/'.$user->user_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											    <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_user(<?php echo $user->user_id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>

											   <?php } ?>
											    
											</td>
                                        </tr>
                                        <?php $i++;} } else { ?>
										<tr><td>No data found</td></tr>
										<?php } ?>
											
                                    </tbody>
                                  </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

         <!-- Delete Popup modal -->			
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
										<?php echo form_open(base_url().'Administrator/User/delete_user'); ?>
											<input name="delete_itemId" type="hidden" id="delete_itemId" value="">
											<input class="btn btn-primary" type="submit" id="" value="Yes">
										<?php echo form_close() ?>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div><!-- /.example-modal -->
				<!-- ./Delete Popup modal -->

				<script type="text/javascript">
					function remove_user(id) 
					{
						$("#delete_itemId").val(id);
					}
				</script>
		
	

		
	

			

		
