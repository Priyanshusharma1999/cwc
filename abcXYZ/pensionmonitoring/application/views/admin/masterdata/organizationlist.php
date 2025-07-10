   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
					
					<?php if($this->session->flashdata('flashSuccess_org')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_org');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>
					
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Organization List</h6>
								<hr>
							<?php
								$attributes = array('class' => 'form-inline sr-form', 'id' =>'searchform');
								echo form_open_multipart('masterdata/search_organization/',$attributes);?> 
								  <div class="form-group">
									<input type="text" class="form-control" name="organization_name" placeholder="Organization Name" >
								  </div>
								  <div class="form-group">
								  <button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
								 </div>
						      <?php echo form_close();?>
								<?php $sesssion_id = $this->session->userdata('applicant_user_id'); ?>
								<a href="<?php echo site_url('masterdata/addorganization/'.$sesssion_id);?>" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add New Organization</a>
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Organization Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
									 
										if($all_organization) {
											$i=1;
											foreach($all_organization as $organization) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $organization->ORGNAME; ?></td>
                                            <td>
											   <a href="<?php echo base_url('Masterdata/edit_organization/'.$organization->ORGANIZATION_ID.'/'.$sesssion_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											 <!--   <a data-toggle="modal"  data-target="#deleteModal" onclick="remove_org(<?php //echo $organization->ORGANIZATION_ID ;?>)"class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> -->
										

											    <button id="del-<?php echo $organization->ORGANIZATION_ID;?>" data-toggle="modal"  data-target="#deleteModal" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
											</td>
                                        </tr>
									
									    <?php $i++; } } else { ?>
											<tr><td>No Organization found</td></tr>
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
										<h4 class="modal-title">Delete Organization</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this organization?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>

										<button type="button" class="btn btn-danger" id="delValue-" data-dismiss="modal">Yes</button>
										
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div><!-- /.example-modal -->
				<!-- ./Delete Popup modal -->

				<script type="text/javascript">

					$("[id ^='del-']").click(function(){
						var requestID  = $(this).attr('id');
						var requestArr = requestID.split('-');
					$("[id ^='delValue-']").attr("id","delValue-"+requestArr[1]);
					});
					$("[id ^='delValue-']").click(function(){
						 var requestID  = $(this).attr('id');
						 var requestArr = requestID.split('-');
						 var base_url = "<?php echo base_url(); ?>";
						 var session_id = "<?php echo $this->session->userdata('applicant_user_id') ?>";
						 var url=base_url+'Masterdata/delete_organization';
						$.ajax({
								method: "POST",
								url: url,
								data: {id:requestArr[1],session_id:session_id},
								success: function(data) {
									window.location.reload();
								}
							});
					});

				</script>

				<!-- function remove_org(id) 
					{
						$("#delete_itemId").val(id);
					} -->
      
		
	