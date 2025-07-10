   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
					
					   <?php if($this->session->flashdata('flashSuccess_division')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_division');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>

				
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Division List</h6>
								<hr>
								
								<?php
								$attributes = array('class' => 'form-inline sr-form', 'id' =>'searchdiv');
								echo form_open_multipart('masterdata/search_division/',$attributes);?> 
								  <div class="form-group">
									<input type="text" class="form-control" name="division_name" placeholder="Division Name" >
								  </div>
								  <div class="form-group">
								  <button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
								 </div>
						      <?php echo form_close();?>
								
								<a href="<?php echo site_url();?>masterdata/adddivision" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add New Division</a>
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Organization Name</th>
											<th>Division Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     <?php
									 
										if($divisions_data) {
											$i=1;
											foreach($divisions_data as $division) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $division->ORGNAME; ?></td>
											<td><?php echo $division->DIVISIONNAME; ?></td>
                                            <td>
											   <a href="<?php echo base_url('Masterdata/edit_division/'.$division->DIVISION_ID) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											   <!-- <a data-toggle="modal"  data-target="#deleteModal" onclick="remove_org(<?php //echo $division->DIVISION_ID ;?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> -->
											   <button id="del-<?php echo $division->DIVISION_ID;?>" data-toggle="modal"  data-target="#deleteModal" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
											</td>
                                        </tr>
									
									    <?php $i++; } } else { ?>
											<tr><td>No Division found</td></tr>
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
										<h4 class="modal-title">Delete Division</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this division?</p>
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
						 var url=base_url+'Masterdata/delete_division';
						$.ajax({
								method: "POST",
								url: url,
								data: {id:requestArr[1],session_id:session_id},
								success: function(data) {
									window.location.reload();
								}
							});
					});

					/*function remove_org(id) 
					{
						$("#delete_itemId").val(id);
					}*/

				</script>
      
		
	