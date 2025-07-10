
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Post</h6>
								<hr>

						<?php if($this->session->flashdata('flashSuccess_post')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_post');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>

						<?php if($this->session->flashdata('flashError_post')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_post'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
                                
						<?php
						$session_idd = $this->session->userdata('auser_id');
					 	$attributes = array('class' => '', 'id' =>'add_postt');
     					echo form_open_multipart('Superadmin/add_post/'.$session_idd,$attributes);?> 
							<div class="col-sm-6">
								<div class="form-group">
									<label>Select Region<span class="required">*</span></label>
									<select name = "region_name" class="form-control" id = "region_post">
									   <option selected="selected" value="">Select Prefered region</option>
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
									<span class = "text-danger"><?php echo form_error('region_name');?></span>
								</div>
						    </div>
						 
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Select Circle<span class="required" >*</span></label>
									<select name = "circle_name" class="form-control" id = "circlee_post">
									<option selected="selected" value="">Select Circle</option>
									</select>
									<span class = "text-danger"><?php echo form_error('circle_name');?></span>
								</div>
							 </div>
							 
						  <div class="col-sm-6">
							<div class="form-group">
								<label>Post <span class="required">*</span></label>
								<input class="form-control restrict_special_char" type="text" placeholder="Post" name="post_name" maxlength="80" value = "<?php echo isset($insertData['post_name']) ? $insertData['post_name'] : ''; ?>">
								<span class = "text-danger"><?php echo form_error('post_name');?></span>
							</div>
						  </div>
						  
						  <div class="col-sm-6">
							<div class="form-group">
								<label>Post Code<span class="required">*</span></label>
								<input class="form-control" type="text" maxlength="80" placeholder="Post Code" name="post_code" maxlength="50" value = "<?php echo isset($insertData['post_code']) ? $insertData['post_code'] : ''; ?>">
								<span class = "text-danger"><?php echo form_error('post_code');?></span>
							</div>
						  </div>
							  
							  <div class="m-t-20" style="padding-left:15px;">
									 <button name="submit" type="submit" class="btn btn-primary">Add Post</button>
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
                                <h6 class="card-title text-bold">Post List</h6>
								<hr>
								<?php
								 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
			     					echo form_open_multipart('Superadmin/search_post/',$attributes);?> 

								  <div class="form-group">
									<input type="text" name = "regionn_nname" class="form-control restrict_special_char"  placeholder="Region" >
								  </div>
								   <div class="form-group">
									<input type="text" name = "cirrccle_nname" class="form-control" id="restrict_special_char2" placeholder="Circle" >
								  </div>
								  <div class="form-group">
									<input type="text" id="restrict_special_char3" name = "poosst_nname" class="form-control" placeholder="Post" >
								  </div>
								  <button type="submit" class="btn btn-success btn-search">Search</button>

								<?php echo form_close();?>
                              <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>Region </th>
											<th>Circle </th>
											<th>Post </th>
											<th>Post Code</th>
                                            <th>Created Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										if($all_post) {
										foreach($all_post as $post) { ?>
                                        <tr>
                                            <td>
                                            <?php 
                                            	$region_data = $this->Base_model->get_record_by_id('tbl_region', array('id' => $post->region_id));
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
											<td>
												<?php 
                                            	$circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $post->circle_id));
	                                            if(empty($circle_data))
	                                            {
	                                            		echo '';
	                                            }
	                                            else
	                                            {
	                                            		echo $circle_data->circle_name;
	                                            }
                                            ?>
											</td>
											<td><?php echo $post->post_name; ?></td>
											<td><?php echo $post->post_code; ?></td>
                                            <td><?php echo date('d F Y', strtotime($post->created_date)); ?></td>
                                            <td>
                                            	<?php $session_idd = $this->session->userdata('auser_id'); ?>
											   <a href = "<?php echo base_url('Superadmin/edit_post/'.$post->id.'/'.$session_idd) ?>"class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											   <a href = "<?php echo base_url('Superadmin/view_post/'.$post->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
											   <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_post(<?php echo $post->id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> </button>
											</td>
                                        </tr>
                                        <?php } } else { ?>
										<tr><td>No Post found</td></tr>
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
										<h4 class="modal-title">Delete Post</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this post?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<?php echo form_open(base_url().'Superadmin/delete_post'); ?>
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
					function remove_post(id) 
					{
						$("#delete_itemId").val(id);
					}

				</script>

