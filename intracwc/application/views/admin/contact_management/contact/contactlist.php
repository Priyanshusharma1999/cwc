 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Contact List</h6>
								<hr>
								
								<?php if($this->session->flashdata('contact_add_flashSuccess')) { ?>
								<div class='alert alert-success'> <?php echo $this->session->flashdata('contact_add_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } ?>

								<?php if($this->session->flashdata('contact_delete_flashSuccess')) { ?>
								<div class='alert alert-success'> <?php echo $this->session->flashdata('contact_delete_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } ?>

								<?php if($this->session->flashdata('contact_add_flashError')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('contact_add_flashError'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>
								<?php
                                $attributes = array('class' => 'form-inline sr-form', 'id' =>'');
                                echo form_open_multipart('Contact/Contactdetail/search_contact/',$attributes);?>
								  
								 <div class="form-group">
									<input type="text" name="contact_name" class="form-control restrict_special_char" placeholder="Contact Name" >
								 </div>

								 <div class="form-group">
									<input type="text" name="wing_name" class="form-control restrict_special_char" placeholder="Wing Name" >
								 </div>

								 <div class="form-group">
									<input type="text" name="organisation_name" class="form-control restrict_special_char" placeholder="Organisation Name" >
								 </div>

								 <div class="form-group">
									<input type="text" name="post_name" class="form-control restrict_special_char" placeholder="Post Name" >
								 </div>

								  <div class="form-group">
									<input type="text" name="designation_name" class="form-control restrict_special_char" placeholder="Designation Name" >
								 </div>
								  <br/> <br/>
								  
								  
								  <button type="submit" type="submit" name="submit" class="btn btn-success btn-search">Search</button>
								  
								  <!-- <button type="reset" class="btn btn-danger btn-search">Reset</button> -->
								<?php echo form_close(); ?>
								
								<a href="<?php echo base_url();?>Contact/Contactdetail/add_contact" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add Contact</a>
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
                                            <th style="width:10%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											if($all_contact) {
												$i=1;
												foreach($all_contact as $contact) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
											<td><?php echo $contact->name;?></td>
											<td><?php echo $contact->contact_wing;?></td>
											<td><?php echo $contact->contact_organisation;?></td>
											<td><?php echo $contact->contact_post;?></td>
											<td><?php echo $contact->contact_designation;?></td>
											<td>
												<a href="<?php echo base_url('Contact/Contactdetail/upper/'.$contact->contact_detail_master_id) ?>">One Level Up Hierarchy Level</a>
													
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

         <!-- Delete Popup modal -->			
					<div class="example-modal">
						<div class="modal fade" aria-hidden="true" id="deleteModal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Delete Designation</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this designation?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<?php echo form_open(base_url().'Contact/designation/delete_designation'); ?>
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
					function remove_designation(id) 
					{
						$("#delete_itemId").val(id);
					}

				</script>
		
	

		
	

			

		
