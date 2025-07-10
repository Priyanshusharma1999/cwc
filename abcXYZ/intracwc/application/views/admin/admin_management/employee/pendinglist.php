	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Pending List</h6>
								<hr>
								<?php if($this->session->flashdata('employee_add_flashSuccess')) { ?>
								<div class='alert alert-success'> <?php echo $this->session->flashdata('employee_add_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } else if($this->session->flashdata('employee_aprove_flashSuccess')) {?>

								
								<div class='alert alert-success'> <?php echo $this->session->flashdata('employee_aprove_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php }else if($this->session->flashdata('employee_delete_flashSuccess')) {?>

								
								<div class='alert alert-success'> <?php echo $this->session->flashdata('employee_delete_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } else if($this->session->flashdata('employee_add_flashError')) { ?>

								
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('employee_add_flashError'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } else { echo '';} ?>

							<?php $user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id'))); 

				            	foreach ($user_role_data as $role_id)
								   {
								   		$user_roles[]= $role_id->role_id;
								   }

				            	?>

								<?php
								 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
			     					echo form_open_multipart('Administrator/Employee/search_employee_pending',$attributes);
			     				?>
								  <div class="form-group">
									<input type="text" name="employee_name" class="form-control restrict_special_char" placeholder="Employee Name" >
								  </div>
								  <div class="form-group">
									<input type="text" name="employee_code" class="form-control restrict_special_char" placeholder="Employee Code" >
								  </div>
								  <div class="form-group">
									<select name="employee_designation" class="form-control">
									   <option selected="selected" value="">Employee Designation</option>
										<?php
											if(empty($all_designation))
											{
												echo '';
											}

											else
											{
												foreach ($all_designation as $designation)
						                      {   
						                         echo '<option value="'.$designation->designation_id.'">'.$designation->designation_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								  </div>
								  
								   <div class="form-group">
									<select name="status" class="form-control">
									   <option  value="">Select Status</option>
										<option value="1">Active</option>
										<option value="2">Deactive</option>
									</select>
								  </div>
								  
								  <button type="submit" type="submit" name="submit" class="btn btn-success btn-search">Search</button>
								  
								  <!-- <button type="reset" class="btn btn-danger btn-search">Reset</button> -->
								<?php echo form_close(); 
								
								
								?>
							
								<a href="<?php echo site_url();?>Administrator/Employee/add_employee" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add Employee</a>
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Employee Name</th>
											<th>Designation</th>
											<th>Office</th>
											<th>Mobile No.</th>
											<th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php //echo '<pre>'; print_r($all_employee); exit;

											if($all_employee) {
												$i=1;
												foreach($all_employee as $employee) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $employee->employee_name;?></td>
                                            <td>
                                            	<?php 
                                            	$designation_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $employee->employee_designation));
                                            	echo $designation_data->designation_name;
                                            	?>
                                            </td>
											<td>
												<?php 
                                            	$office = $this->Base_model->get_record_by_id('employee_office', array('office_id' => $employee->post));
                                            	echo $office->office_name;
                                            	?>
											</td>
											<td><?php echo $employee->employee_mobile_no;?></td>
											<td>
												<?php

													if($employee->approved_status==1) 
													{
														echo '<span class="label label-success-border">Approved</span>';
													}

													else if($employee->approved_status==0) 
													{
														echo '<span class="label label-danger-border">Not Approve</span>';
													}

													else
													{
														echo '';
													}

												?>
											</td>
                                            <td>
											   <a href="<?php echo base_url('Administrator/Employee/view_employee/'.$employee->employee_id) ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
											    <a href="<?php echo base_url('Administrator/Employee/edit_employee/'.$employee->employee_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
												<a href="<?php echo base_url('Administrator/Employee/aproove_employee/'.$employee->employee_id) ?>"  class="btn btn-sm btn-info"><i class="fa fa-check-square-o"></i></a>
											    <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_employee(<?php echo $employee->employee_id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>


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
										<h4 class="modal-title">Delete Employee</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this employee?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<?php echo form_open(base_url().'Administrator/Employee/delete_employee'); ?>
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
					function remove_employee(id) 
					{
						$("#delete_itemId").val(id);
					}

				</script>
		
	

		
	

			
