   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Category List</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_addcategory')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_addcategory');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>

						<?php if($this->session->flashdata('flashSuccess_editcategory')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_editcategory');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>

						<?php if($this->session->flashdata('flashSuccess_category')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_category');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>
						
					<?php
					 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_item');
     					echo form_open_multipart('onlinestationary/Category/search_category/',$attributes);?>
						
							  <div class="form-group">
								<input class="form-control restrict_special_char" type="text"  name="category_name" placeholder="Catgory Name">
							  </div>
							  <button type="submit" name="submit" class="btn btn-success btn-search">
							    Search
							  </button>
						
						  <?php echo form_close();?>
								
							<a href="<?php echo site_url();?>onlinestationary/Category/addcategory"  class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add Category</a>
								
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
								<?php 
										if($all_category) {
											$i=1;
											foreach($all_category as $category) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
											<td><?php echo $category->category_name; ?></td>
											
                                         <td>
									<a href="<?php echo base_url('onlinestationary/Category/editcategory/'.$category->category_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
									
									 <a data-toggle="modal"  data-target="#deleteModal" onclick="remove_circle(<?php echo $category->category_id; ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
											   
											</td>
                                        </tr>
									<?php $i++; } } else { ?>
										
										<tr><td>No category found</td></tr>
										
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
							<h4 class="modal-title">Delete Category</h4>
						</div>
						<div class="modal-body">
							<p>Are you sure want to delete this Category?</p>
						</div>
						<div class="modal-footer">
							<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
							<?php echo form_open(base_url().'onlinestationary/Category/deletecategory'); ?>
								<input name="delete_catId" type="hidden" id="delete_catId" value="">
								<input class="btn btn-primary" type="submit" id="" value="Yes">
							<?php echo form_close() ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	

				<script type="text/javascript">
					function remove_circle(id) 
					{
						$("#delete_catId").val(id);
					}

				</script>