  
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Vendor's Employee List</h6>
								<hr>
								<?php if($this->session->flashdata('vendoremployee_add_flashSuccess')) { ?>
								<div class='alert alert-success'> <?php echo $this->session->flashdata('vendoremployee_add_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } else if($this->session->flashdata('vendoremployee_delete_flashSuccess')) { ?>

								
								<div class='alert alert-success'> <?php echo $this->session->flashdata('vendoremployee_delete_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } else if($this->session->flashdata('vendoremployee_add_flashError')) { ?>

							
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('vendoremployee_add_flashError'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } else {echo '';} ?>
								<?php
								 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
			     					echo form_open_multipart('Administrator/Vendor_employee/search_vendoremployee',$attributes);
			     				?>

			     					<div class="form-group">
									<input type="text" name="employee_name" class="form-control restrict_special_char" placeholder="Employee Name" >
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
								<?php echo form_close(); ?>
								
								<a href="<?php echo site_url();?>Administrator/Vendor_employee/add_vendoremployee" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add Vendor's Employee</a>
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Employee Name</th>
											<th>Vendor Name</th>
											<th>Designation</th>
											<th>Mobile No.</th>
											<th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											if($all_vendoremployee) {
												$i=1;
												foreach($all_vendoremployee as $vendoremployee) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
											<td><?php echo $vendoremployee->vendor_employee_name;?></td>
											<td>
												<?php 
                                            	$vendor_data = $this->Base_model->get_record_by_id('vendor', array('vendor_id' => $vendoremployee->vendor_id));
                                            	echo $vendor_data->company_name;
                                            	?>
											</td>
                                            <td>
                                            	<?php 
                                            	/*$designation_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $vendoremployee->vendor_employee_designation));*/
                                            	echo $vendoremployee->vendor_employee_designation;
                                            	?>
                                            </td>
											<td><?php echo $vendoremployee->vendor_employee_mobile_no;?></td>
											<td>
												<?php

													if($vendoremployee->status==1) 
													{
														echo '<span class="label label-success-border">Active</span>';
													}

													else if($vendoremployee->status==0) 
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
											    <a href="<?php echo base_url('Administrator/Vendor_employee/view_vendoremployee/'.$vendoremployee->vendor_employee_id) ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
											    <a href="<?php echo base_url('Administrator/Vendor_employee/edit_vendoremployee/'.$vendoremployee->vendor_employee_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											    <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_vendoremployee(<?php echo $vendoremployee->vendor_employee_id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-close"></i></button>
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
										<h4 class="modal-title">Delete Vendor Employee</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this vendor employee?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<?php echo form_open(base_url().'Administrator/Vendor_employee/delete_vendoremployee'); ?>
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
					function remove_vendoremployee(id) 
					{
						$("#delete_itemId").val(id);
					}

				</script>
		
	

		
	

			

		



		

