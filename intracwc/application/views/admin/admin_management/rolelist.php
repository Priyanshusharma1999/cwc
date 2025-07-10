 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Role List</h6>
								<hr>
                        		<table class="display datatable table table-responsive table-bordered" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Role</th>
											<th>Description</th>
												
                                        </tr>
                                    </thead>
                                    <tbody>
									  <?php
											if($all_roles) {
												$i=1;
												foreach($all_roles as $rol) { ?>	
                                       <tr>
                                            <td><?php echo $i;?></td>
											<td><?php echo $rol->name;?></td>
                                            <td><?php echo $rol->description;?>e</td>	
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
										<h4 class="modal-title">Delete User</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this user?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<?php echo form_open(base_url().'Administrator/User/delete_user'); ?>
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
					function remove_user(id) 
					{
						$("#delete_itemId").val(id);
					}

				</script>
		
	

		
	

			

		
