		
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                            		<?php if($this->session->flashdata('flashSuccess_user')) { ?>
																<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_user');?> 
																<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
																<?php } ?>

																<?php if($this->session->flashdata('flashError_user')) { ?>
																				<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_user'); ?> 
																				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
																<?php } ?>
                                <h6 class="card-title text-bold">Users List</h6>
								<hr>
								<?php
							 		$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
		     					echo form_open_multipart('Users/search_user/',$attributes);?>
								<!-- <form class="form-inline sr-form" action="#"> -->
								 <div class="form-group">
									<select name = "region_name" class="form-control" id = "region_post">
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
									<select name = "circle_name" class="form-control" id = "">
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
								  <button type="submit" class="btn btn-success btn-search">Search</button>
								<?php echo form_close();?>
                                <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>UserId</th>
											<th>Email</th>
											<th>Contact No.</th>
                                            <th>Region</th>
                                            <th>Circle</th>
											<th>User Type</th>
                                            
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    	<?php
										if($all_users) {
										foreach($all_users as $users) { ?>
                                        <tr>
                                            <td><?php echo $users->name; ?></td>
                                            <td><?php echo $users->user_id; ?></td>
                                            <td><?php echo $users->email; ?></td>
                                            <td><?php echo $users->phone; ?></td>
                                            <td>
                                            <?php

												$region_data = $this->Base_model->get_record_by_id('tbl_region', array('id' => $users->Division));
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

												$circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $users->Circle));
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

							                    if($users->user_type=='1')
							                    {
							                    	echo 'Super Admin';
							                    }
							                    else if($users->user_type=='2')
							                    {
							                    	echo 'Regional Officer';
							                    }

							                    else if($users->user_type=='3')
							                    {
							                    	echo 'Circle Officer';
							                    }

							                    else
							                    {
							                    	echo '';
							                    }
											?>
											</td>
                                            
                                            <td>
											   <a href = "<?php echo base_url('Users/edit_user/'.$users->Id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i>Edit</a>
											   <a href = "<?php echo base_url('Users/view_user/'.$users->Id) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											</td>
                                        </tr>
                                        <?php } } else { ?>
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
	
