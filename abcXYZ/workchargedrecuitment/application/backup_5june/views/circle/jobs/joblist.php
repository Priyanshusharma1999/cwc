
  
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Job List</h6>
								<hr>
								<label>Total Jobs : <?php echo count($all_jobs);?> </label>
								 <?php if($this->session->flashdata('flashSuccess_job')) { ?>
								<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_job');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } ?>

								<?php if($this->session->flashdata('flashError_job')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_job'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>
								<?php
							 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
		     					echo form_open_multipart('Circle_jobs/search_jobs/',$attributes);?> 
								<!-- <form class="form-inline sr-form" action="#"> -->
								  <div class="form-group">
									<select name = "region_nnname" class="form-control" id = "">
									   <option selected="selected" value="">Select Preferred Region</option>
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
								  <div class="form-group">
									<select name = "circle_nnname" class="form-control" id = "">
									<option selected="selected" value="">Select Circle</option>
										<?php
											if(empty($all_circle))
											{
												echo '<option value="1">'.'Select Circle'.'</option>';
											}

											else
											{
												foreach ($all_circle as $circle)
						                      {   
						                         echo '<option value="'.$circle->id.'">'.$circle->circle_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								  </div>
								  <div class="form-group">

									<select name = "post_nnname" class="form-control">
									<option selected="selected" value="">Select Post</option>
									   <?php
											if(empty($all_post))
											{
												echo '<option value="1">'.'Select Post'.'</option>';
											}

											else
											{
												foreach ($all_post as $post)
						                      {   
						                         echo '<option value="'.$post->id.'">'.$post->post_name.'</option>';
						                      }
											}
					                      
					                    ?>
									</select>
								  </div>
								  <button type="submit" class="btn btn-success btn-search">Search</button>
								<?php echo form_close(); ?>
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>Reference No.</th>
											<th>Job Title</th>
											<th>Total Vacancy</th>
											<th>Region</th>
											<th>Circle</th>
											<th>Post Name</th>
											<th>Status</th>
											<th>Start Date</th>
											<th>End Date</th>
                                            <th>Post Date</th>
                                            <th style="width:13.5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											if($all_jobs) {
												foreach($all_jobs as $jobs) { ?>
                                        <tr>
                                            <td><?php echo $jobs->refrence_no; ?></td>
                                            <td><?php echo $jobs->job_title; ?></td>
											<td><?php echo $jobs->total_vacancy; ?></td>
                                            <td>
                                            	<?php

													$region_data = $this->Base_model->get_record_by_id('tbl_region', array('id' => $jobs->region_id));
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

													$circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $jobs->circle_id));
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
											<td>
												<?php

													$post_data = $this->Base_model->get_record_by_id('tbl_post', array('id' => $jobs->post_id));
								                    if(empty($post_data))
								                    {
								                    		echo '';
								                    }
								                    else
								                    {
								                    		echo $post_data->post_name;
								                    }
												?>
											</td>
											<td>
												<?php

								                    if($jobs->job_status =='1' )
								                    {
								                    	echo '<span class="label label-success">Active</span>';
								                    }

								                    else
								                    {
								                    	echo '<span class="label label-danger">Deactive</span>';
								                    }
												?>
											</td>
                                            <td><?php echo $jobs->start_date; ?></td>
											<td><?php echo $jobs->end_date; ?></td>
											<td><?php echo $jobs->created_date; ?></td>
                                            <td>
											   <a href = "<?php echo base_url('Circle_jobs/edit_jobs/'.$jobs->id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											   <a href = "<?php echo base_url('Circle_jobs/view_job/'.$jobs->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
											   <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_job(<?php echo $jobs->id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
											  
											</td>
                                        </tr>
						
                                         <?php } } else { ?>
										<tr><td>No Jobs found</td></tr>
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
										<p>Are you sure want to delete this job?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<?php echo form_open(base_url().'Circle_jobs/delete_job'); ?>
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
					function remove_job(id) 
					{
						$("#delete_itemId").val(id);
					}

				</script>
      
		
		<style>
		   
			.dataTables_wrapper{
				overflow-x: scroll;
				width: 100%;
			}
			
			table.dataTable{
				max-width: 1300px!important;
				width: 100%;
				min-width: 1240px;
			}
					
		</style>
      
