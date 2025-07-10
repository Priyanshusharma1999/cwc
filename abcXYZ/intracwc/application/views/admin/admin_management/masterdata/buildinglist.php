  
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Building List</h6>
								<hr>
								<?php if($this->session->flashdata('building_add_flashSuccess')) { ?>
								<div class='alert alert-success'> <?php echo $this->session->flashdata('building_add_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } else if($this->session->flashdata('building_delete_flashSuccess')) { ?>

								<div class='alert alert-success'> <?php echo $this->session->flashdata('building_delete_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } else if($this->session->flashdata('building_add_flashError')) { ?>

							
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('building_add_flashError'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } else {echo '';} ?>
								<!-- <form class="form-inline sr-form" action="#"> -->
									<?php
								 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
			     					echo form_open_multipart('Administrator/Masterdata/search_building',$attributes);?>
								  <div class="form-group">
									<input type="text" name="building_name" class="form-control restrict_special_char" placeholder="Building Name" >
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
								
								<!-- <a href="<?php //echo site_url();?>Admini/addbuilding" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add New Building</a> -->
								<a href="<?php echo site_url();?>Administrator/Masterdata/add_building" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add New Building</a>
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Building Name</th>
											<th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											if($all_buildings) {
												$i=1;
												foreach($all_buildings as $building) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $building->building_name; ?></td>
											<td>
												<?php

													if($building->status==1) 
													{
														echo '<span class="label label-success-border">Active</span>';
													}

													else if($building->status==0) 
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
                                            	<a href="<?php echo base_url('Administrator/Masterdata/view_building/'.$building->building_id) ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
											   <a href="<?php echo base_url('Administrator/Masterdata/edit_building/'.$building->building_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											   <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_building(<?php echo $building->building_id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-close"></i></button>
											  <!--  <a class="btn btn-sm btn-danger"><i class="fa fa-close"></i></a> -->
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
										<h4 class="modal-title">Delete Job</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this building?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<?php echo form_open(base_url().'Administrator/Masterdata/delete_building'); ?>
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
					function remove_building(id) 
					{
						$("#delete_itemId").val(id);
					}

				</script>
		
	
