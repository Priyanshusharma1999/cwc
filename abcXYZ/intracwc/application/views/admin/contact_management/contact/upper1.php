 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Upper List</h6>
								<hr>
						
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Contact Name</th>
											<th>Wing Name</th>
											<th>Organisation Name</th>
											<th>Post Name</th>
											<th>Designation Name</th>
											<th>One Level Up Hierarchy Level</th>
											<th>One Level Down Hierarchy Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
										
											if($all_contacts) {
												$i=1;
												foreach($all_contacts as $contact) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
											<td><?php echo $contact->name;?></td>
											<td><?php echo $contact->contact_wing;?></td>
											<td><?php echo $contact->contact_organisation;?></td>
											<td><?php echo $contact->contact_post;?></td>
											<td><?php echo $contact->contact_designation;?></td>
											<td>
												<?php
												
													$parent_relation_data = $this->Base_model->get_record_by_id('contact_relation', array('contact_child_id' => $contact->contact_detail_master_id));

													if($parent_relation_data->contact_parent_id==0)
													{
														echo 'Not available';
													}

													else
													{?>
														<a href="<?php echo base_url('Contact/Contactdetail/upper_second/'.$parent_relation_data->contact_parent_id) ?>">One Level Up Hierarchy Level</a>
													<?php }?>
												
													
											</td>
											<td>
												<a href="<?php echo base_url('Contact/Contactdetail/lower/'.$contact->contact_detail_master_id) ?>">One Level Down Hierarchy Level</a>
													
											</td>
                                            <td>
											   <a href="<?php echo base_url('Contact/Contactdetail/view_contact/'.$contact->contact_detail_master_id) ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
											    <a href="<?php echo base_url('Contact/Contactdetail/edit_contact/'.$contact->contact_detail_master_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											   <!--  <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_contact(<?php //echo $contact->contact_detail_master_id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-close"></i></button> -->
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

        