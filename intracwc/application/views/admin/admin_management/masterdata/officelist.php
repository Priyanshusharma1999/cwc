
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Office List</h6>
								<hr>
								<?php if($this->session->flashdata('office_delete_flashSuccess')) { ?>
								<div class='alert alert-success'> <?php echo $this->session->flashdata('office_delete_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } else if($this->session->flashdata('office_add_flashSuccess')) { ?>

							
								<div class='alert alert-success'> <?php echo $this->session->flashdata('office_add_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } else if($this->session->flashdata('office_add_flashError')) { ?>

								
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('office_add_flashError'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } else {echo "";} ?>
								<?php
								 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
			     					echo form_open_multipart('Administrator/Office/search_office',$attributes);
			     				?>
								  <div class="form-group">
									<input type="text" name="office_name" class="form-control" placeholder="Office Name" >
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

								<a href="<?php echo site_url();?>Administrator/Office/add_office" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add New Office</a>
								
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Office Name</th>
											<th>Office Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											if($all_office) {
												$i=1;
												foreach($all_office as $office) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $office->office_name;?></td>
                                            
											<td><?php echo $office->office_description;?></td>

                                            <td>
											   <a href="<?php echo base_url('Administrator/Office/edit_office/'.$office->office_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											   <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_office(<?php echo $office->office_id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-close"></i></button>
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
										<h4 class="modal-title">Delete Office</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this office?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<?php echo form_open(base_url().'Administrator/Office/delete_office'); ?>
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
					function remove_office(id) 
					{
						$("#delete_itemId").val(id);
					}

				</script>
		
