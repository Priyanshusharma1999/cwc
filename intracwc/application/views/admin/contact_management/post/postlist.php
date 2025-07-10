 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Post List</h6>
								<hr>
								
								<?php if($this->session->flashdata('post_add_flashSuccess')) { ?>
								<div class='alert alert-success'> <?php echo $this->session->flashdata('post_add_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } ?>

								<?php if($this->session->flashdata('post_delete_flashSuccess')) { ?>
								<div class='alert alert-success'> <?php echo $this->session->flashdata('post_delete_flashSuccess');?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
								<?php } ?>

								<?php if($this->session->flashdata('post_add_flashError')) { ?>
								<div class='alert alert-danger' > <?php echo $this->session->flashdata('post_add_flashError'); ?> 
								<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
								<?php } ?>
								<?php
                                $attributes = array('class' => 'form-inline sr-form', 'id' =>'');
                                echo form_open_multipart('Contact/Post/search_post/',$attributes);?>
								  
								 <div class="form-group">
									<input type="text" name="post_name" class="form-control restrict_special_char" placeholder="Post Name" >
								 </div>
								  
								  
								  <button type="submit" type="submit" name="submit" class="btn btn-success btn-search">Search</button>
								  
								  <!-- <button type="reset" class="btn btn-danger btn-search">Reset</button> -->
								<?php echo form_close(); ?>
								
								<a href="<?php echo base_url();?>Contact/Post/add_post" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add Post</a>
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Post Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
										<?php
											if($all_post) {
												$i=1;
												foreach($all_post as $post) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
											<td><?php echo $post->contact_post_name;?></td>
                                            <td>
											   <a href="<?php echo base_url('Contact/Post/view_post/'.$post->contact_post_id) ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
											    <a href="<?php echo base_url('Contact/Post/edit_post/'.$post->contact_post_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											    <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_post(<?php echo $post->contact_post_id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-close"></i></button>
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
										<h4 class="modal-title">Delete Post</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this post?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<?php echo form_open(base_url().'Contact/Post/delete_post'); ?>
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
					function remove_post(id) 
					{
						$("#delete_itemId").val(id);
					}

				</script>
		
	

		
	

			

		
