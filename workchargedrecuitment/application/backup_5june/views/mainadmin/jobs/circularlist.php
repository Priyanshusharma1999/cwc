
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Circular List</h6>
								<hr>
								<?php if($this->session->flashdata('flashSuccess_circular')) { ?>
								<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_circular');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } ?>

								<?php if($this->session->flashdata('flashError_circular')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_circular'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>
								<!-- <form class="form-inline sr-form" action="#"> -->
								<?php
							 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
		     					echo form_open_multipart('Circular/search_circular/',$attributes);?> 
								  <div class="form-group">
									<input type="text" name = "circular_title" class="form-control" placeholder="Circular Title" >
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
								  <button type="submit" class="btn btn-success btn-search">Search</button>
								<?php echo form_close(); ?>
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>Reference No.</th>
											<th>Circular Title</th>
											<th>Circle Name</th>
                                            <th>Post Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										
										<?php
											if($all_circulars) {
												foreach($all_circulars as $circular) { ?>
                                         <tr>
                                            <td><?php echo $circular->refrence_no; ?></td>
                                            <td><?php echo $circular->circular_title; ?></td>
                                            <td>
                                            	<?php

													$circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $circular->circle_id));
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
                                            <td><?php echo $circular->created_date; ?></td>
                                            <td>
											   <a href = "<?php echo base_url('Circular/edit_circular/'.$circular->id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i>Edit</a>
											   <a href = "<?php echo base_url('Circular/view_circular/'.$circular->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
											   <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_circular(<?php echo $circular->id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-trash"> Delete</i></button>
											  
											</td>
                                        </tr>
                                        <?php } } else { ?>
										<tr><td>No Circular found</td></tr>
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
										<h4 class="modal-title">Delete Circular</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this circular?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<?php echo form_open(base_url().'Circular/delete_circular'); ?>
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
					function remove_circular(id) 
					{
						$("#delete_itemId").val(id);
					}

				</script>

