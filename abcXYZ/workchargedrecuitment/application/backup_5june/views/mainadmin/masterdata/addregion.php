
    

	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Region</h6>
								<hr>
						<?php if($this->session->flashdata('flashSuccess')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>

						<?php if($this->session->flashdata('flashError')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>

						<?php
					 	$attributes = array('class' => '', 'id' =>'add_regionn');
     					echo form_open_multipart('Superadmin/add_region/',$attributes);?> 
						
						  <div class="col-sm-6">
							<div class="form-group">
								<label>Region <span class="required">*</span></label>
								<input class="form-control" name="region_name" type="text" placeholder="Region " maxlength="50" value = "<?php echo isset($insertData['region_name']) ? $insertData['region_name'] : ''; ?>">
								<span class = "text-danger"><?php echo form_error('region_name');?></span>
							</div>
						  </div>
						  
						  <div class="m-t-20" style="clear:both;padding-left:15px;">

                                <button name="submit" type="submit" class="btn btn-primary">Add Region</button>
                          </div>
							
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
				
				<div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Region List</h6>
								<hr>
								<?php
								 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
			     					echo form_open_multipart('Superadmin/search_region/',$attributes);?> 
								
								  <div class="form-group">
									<input type="text" name = "regionn_nname" class="form-control" placeholder="Region" >
								  </div>
								  <button type="submit" class="btn btn-success btn-search">Search</button>
								 <?php echo form_close();?>
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>Region</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
									if($all_regions) {
										foreach($all_regions as $region) { ?>
                                        <tr>
                                            <td><?php echo $region->region_name; ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($region->created_date)); ?></td>
                                            <td>
											   <a href = "<?php echo base_url('Superadmin/edit_region/'.$region->id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i>Edit</a>
											   <a  href = "<?php echo base_url('Superadmin/view_region/'.$region->id) ?>"class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											   <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_region(<?php echo $region->id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
											   <!-- <a class="btn btn-sm btn-danger"><i class="fa fa-trash"></i>Delete</a> -->
											</td>
                                        </tr>
                                        <?php } } else { ?>
										<tr><td>No Region found</td></tr>
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
										<h4 class="modal-title">Delete Region</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this region?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<?php echo form_open(base_url().'Superadmin/delete_region'); ?>
											<input name="delete_itemId" type="hidden" id="delete_itemId" value="">
											<input class="btn btn-primary" type="submit" id="removeUser" value="Yes">
										<?php echo form_close() ?>
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div><!-- /.example-modal -->
				<!-- ./Delete Popup modal -->

				<script type="text/javascript">
					function remove_region(id) 
					{
						$("#delete_itemId").val(id);
					}

				</script>

