	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Circle</h6>
								<hr>
            			<?php if($this->session->flashdata('flashSuccess_circle')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_circle');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>

						<?php if($this->session->flashdata('flashError_circle')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_circle'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>

						<?php
					 	$attributes = array('class' => '', 'id' =>'add_circlee');
     					echo form_open_multipart('Superadmin/add_circle/',$attributes);?>
						 
						 <div class="col-sm-6">
							<div class="form-group">
								<label>Select Region<span class="required">*</span></label>
								<select required="required" class="form-control" name="region_name">
								   <option selected="selected" value="">Select Preferred region</option>
									<?php
											if(empty($all_regions))
											{
												echo '<option value="1">'.'Select Region'.'</option>';
											}

											else
											{
												foreach ($all_regions as $service)
	                      {   
	                         echo '<option value="'.$service->id.'">'.$service->region_name.'</option>';
	                      }
											}
                      
                    ?>
									
								</select>
							</div>
						  </div>
						 
						 <div class="col-sm-6">
							<div class="form-group">
								<label>Circle <span class="required">*</span></label>
								<input class="form-control" type="text" placeholder="Circle " name="circle_name" maxlength="50"
								 value = "<?php echo isset($insertData['circle_name']) ? $insertData['circle_name'] : ''; ?>">
							</div>
						  </div>
						  
						  <div class="m-t-20" style="padding-left:15px;">
						  	<button name="submit" type="submit" class="btn btn-primary">Add Circle</button>
                                
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
                                <h6 class="card-title text-bold">Circle List</h6>
								<hr>
								<?php
								 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
			     					echo form_open_multipart('Superadmin/search_circle/',$attributes);?> 
								<!-- <form class="form-inline sr-form" action="#"> -->
										  <div class="form-group">
											<input type="text" name ="regionn_nname" class="form-control" placeholder="Region " >
										  </div>
										  <div class="form-group">
											<input type="text" name ="circlee_nname" class="form-control" placeholder="Circle " >
										  </div>
										  <button type="submit" class="btn btn-success btn-search">Search</button>
								<?php echo form_close();?>
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>Region </th>
											<th>Circle </th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
																				<?php
																					if($all_circle) {
																						foreach($all_circle as $circle) { ?>
                                        <tr>
                                            <td>
                                            <?php 

                                            $region_data = $this->Base_model->get_record_by_id('tbl_region', array('id' => $circle->region_id));
                                            if(empty($region_data))
                                            {
                                            		echo '';
                                            }

                                            else
                                            {
                                            		echo $region_data->region_name;
                                            }
                                            
                                            ?>
                                          	</td>
																						<td><?php echo $circle->circle_name; ?></td>
                                            <td><?php echo date('Y-m-d', strtotime($circle->created_date)); ?></td>
                                            <td>
																					   <a href = "<?php echo base_url('Superadmin/edit_circle/'.$circle->id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i>Edit</a>
																					   <a href = "<?php echo base_url('Superadmin/view_circle/'.$circle->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
																					   <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_circle(<?php echo $circle->id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button>
																					</td>
                                        </tr>
                                         <?php } } else { ?>
																					<tr><td>No Circle found</td></tr>
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
										<h4 class="modal-title">Delete Circle</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this circle?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<?php echo form_open(base_url().'Superadmin/delete_circle'); ?>
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
					function remove_circle(id) 
					{
						$("#delete_itemId").val(id);
					}

				</script>
      

