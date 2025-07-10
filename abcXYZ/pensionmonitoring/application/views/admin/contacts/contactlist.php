 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Contact List</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_contact')) { ?>
						<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_contact');?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>

							
								<?php
								 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
										echo form_open_multipart('contacts/search_contact/',$attributes);?> 
							   
									  <div class="form-group" >
										<input type="text" name ="name" class="form-control" placeholder="Enter Name" value="<?php echo isset($insertData['name']) ? $insertData['name'] : ''; ?>" >
									  </div>
									  
									  <div class="form-group" >
										<input type="text" name ="designation" class="form-control" placeholder="Enter designation" value="<?php echo isset($insertData['designation']) ? $insertData['designation'] : ''; ?>" >
									  </div>

									   <div class="form-group" >
										 <select class="form-control" name ="organization" id="org">
										   <option value="" selected>Select Organization</option>
										   <option value="All" <?php if($insertData['organization'] == 'All') echo 'selected="selected"' ?>>All</option>
										  <?php 
					    foreach ($all_organizations as $organisation)
						{?>   
						                      	
                      	<option  value="<?php echo $organisation->ORGANIZATION_ID ?>" <?php if($insertData['organization']==$organisation->ORGANIZATION_ID) { echo 'selected'; } ?> >

                      		<?php echo $organisation->ORGNAME; ?>

                      	</option>

                      <?php }?>

										</select>
									  </div>

									   <div class="form-group" >
										<select name ="division" class="form-control" id="division">
											<option value="" >Select Division</option>
											<option value="All">All</option>
										</select>
									  </div>
									  
									  <div class="form-group">
									     <button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
									  </div>
								<?php echo form_close();?>
								
								<a href="<?php echo site_url();?>contacts/addcontacts" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add Contact</a>
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                           <!--  <th>Role</th> -->
											<th>Name</th>
											<th>Designation</th>
											<th>Office Name</th>
											<th>Email Id</th>
											<th>Office Address</th>
											<th>Mobile No.</th>
                                            <th style="width:14%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
										if($all_contacts) {
											$i=1;
											foreach($all_contacts as $contacts) { ?>
									
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                           <!--  <td><?php $role_data// = $this->Base_model->get_record_by_id('role',array('ROLE_ID' => $contacts->ROLE));
                                                 //echo $role_data->ROLE; ?>
                                                 	
                                            </td> -->
											<td><?php echo $contacts->FULLENAME; ?></td>
                                            <td><?php echo $contacts->DESIGNATION; ?></td>
											<td><?php echo $contacts->OFFICENAME; ?></td>
											<td><?php echo $contacts->EMAIL; ?></td>
											<td><?php echo $contacts->OFFICE_ADDRESS; ?></td>
                                            <td><?php echo $contacts->MOBILE; ?></td>
                                            <td>
											 <a href="<?php echo base_url('Contacts/edit_contact/'.$contacts->EMPLOYEE_ID) ?>" class="btn btn-sm btn-info">
											 <i class="fa fa-pencil"></i></a>
											   
										    <a href="<?php echo base_url('Contacts/view_contact/'.$contacts->EMPLOYEE_ID) ?>" class="btn btn-sm btn-success">
										     <i class="fa fa-eye"></i></a>
												
											 <!-- <a class="btn btn-sm btn-danger" data-toggle="modal"  data-target="#deleteModal" onclick="remove_circle(<?php //echo $contacts->EMPLOYEE_ID; ?>)"><i class="fa fa-trash"></i></a> -->
											 <button id="del-<?php echo $contacts->EMPLOYEE_ID;?>" data-toggle="modal"  data-target="#deleteModal" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
											</td>
                                        </tr>
										
										<?php $i++; } } else { ?>
										
										<tr><td>No Contacts found</td></tr>
										
									<?php } ?>	
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
		
		            <div class="example-modal">
						<div class="modal fade" aria-hidden="true" id="deleteModal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Delete Contact</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this contact?</p>
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
						 var url=base_url+'Contacts/delete_contacts';
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


				<script type="text/javascript">
					/*function remove_circle(id) 
					{
						$("#delete_itemId").val(id);
					}*/

						$('#org').on('change', function(event){
				        var org_id = $("#org").val();
						
				        var option ='';
				        var base_url = '<?php echo base_url() ?>';
				        var link = base_url+'contacts/all_divisions/';
				       
				        $.ajax({
				        method: "POST",
				        url: link,
				        data: {'id':org_id},
				        success: function(result) {
				       
				           var obj = JSON.parse(result);
				      
				           option = '<option value="All">All</option>';
				           $.each(obj, function(i){
							 
							    option+='<option value="'+obj[i].DIVISION_ID+'" selected>'+obj[i].DIVISIONNAME+'</option>';
								
							 });
				            
							$("#division").html(option);
							 event.preventDefault();

				        }
				        
				    });
				    });
					
			</script>
						