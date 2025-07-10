  
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Complaint List</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_complain')) { ?>
							<div class='alert alert-success' > <?php echo $this->session->flashdata('flashSuccess_complain'); ?> 
							  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
							</div> 
						  <?php } ?> 	
          
            <?php  

            $user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
       
               foreach ($user_role_data as $role_id)
               {
                    $user_roles[]= $role_id->role_id;
               }

           ?>
					
			            <?php
						$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_complain');
			     		echo form_open_multipart('nonitcomplaint/complain/searchcomplain/',$attributes);?>  

						  <div class="form-group">
							<select  name="category" class="form-control">
							   <option selected="selected" value="">Select Category</option>
								<?php foreach($complain_type as $category){?>
								<option value="<?php echo $category->category_id;?>">
								<?php echo $category->category_name; ?>
								</option>
								<?php } ?>
							</select>
						  </div>
								  
								  
						   <div class="form-group">
							<select name="status" class="form-control">
							   <option selected="selected" value="">Status</option>
								<option value="">All</option>
								<option value="Pending">Pending</option>
								<option value="Inprogress">Inprogress</option>
								<option value="Fixed">Fixed</option>
							</select>
						  </div>
						  
				<button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
								 
		<?php echo form_close(); ?>
								
							<a href="<?php echo site_url();?>nonitcomplaint/complain/addcomplain" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add Complaint</a>
								
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Complaint Category</th>
											<th>Name & Designation</th>
											<th>Location</th>
											<th>Complaint Registered On</th>
											<th>Complaint Resolved On</th>
											<th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
						<?php if($complain_list)
						{   $i=1; 
							foreach($complain_list as $clist){?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $clist['category_name']; ?></td>
								<td><?php echo $clist['name']; ?> (<?php echo $clist['designation']; ?>)</td>
								<td><?php echo $clist['building_name']; ?></td>
								<td>
								<?php
								$date = date('d F, Y', strtotime($clist['complain_date']));
								echo $date;
								?>
								
								</td>
								<td>
									<?php if($clist['resolved_on']==NULL){
										echo 'N/A';
									} else {
										$date = date('d F, Y', strtotime($clist['resolved_on']));
										echo $date;
									}?>
								</td>

								<td>
								 <span class="label label-primary">
								   <?php echo $clist['status']; ?>
								   </span>
								</td>
								<td>
									
                                <?php if($clist['status']=='Pending'){?>

									 <a href="<?php echo base_url('nonitcomplaint/complain/editcomplain/'.$clist['complaint_id']) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>

									<?php }?>

									<?php if($clist['status']=='Inprogress'){?> 
										
                                              <a href="<?php echo base_url('nonitcomplaint/complain/givefeedback/'.$clist['complaint_id']) ?>" class="btn btn-sm btn-info">View & Action</a>

									 <?php } ?>


									 <?php if(!empty($clist['remarks'])){?> 
										
                                       <a href="<?php echo base_url('nonitcomplaint/complain/viewcomplain/'.$clist['complaint_id']) ?>" class="btn btn-sm btn-info">View</a>

									 <?php } ?>  

								</td>
							</tr>
						<?php $i++; }} else {?>

						   <tr>
							 <td colspan="9">No complain list found.</td>
						   </tr>
						
							<?php } ?>										
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
		
	