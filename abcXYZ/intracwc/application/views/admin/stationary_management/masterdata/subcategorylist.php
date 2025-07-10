   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Subcategory List</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_addsubcategory')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_addsubcategory');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>

						<?php if($this->session->flashdata('flashSuccess_editsubcategory')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_editsubcategory');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>

						<?php if($this->session->flashdata('flashSuccess_subcategory')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_subcategory');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>
						
					<?php
					 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_item');
     					echo form_open_multipart('onlinestationary/Subcategory/search_subcategory/',$attributes);?>
						
							  <div class="form-group">
								<input class="form-control restrict_special_char" type="text"  name="subcategory_name" placeholder="Subcatgory Name">
							  </div>
							  <button type="submit" name="submit" class="btn btn-success btn-search">
							    Search
							  </button>
						
						  <?php echo form_close();?>
								
							<a href="<?php echo site_url();?>onlinestationary/Subcategory/addsubcategory"  class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add Subcategory</a>
								
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Sub Category Name</th>
											<th>Category Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
								<?php 
										if($all_subcategory) {
											$i=1;
											foreach($all_subcategory as $subcategory) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
											<td><?php echo $subcategory->subcat_name; ?></td>

											<td><?php 

											  $category = $this->Base_model->get_record_by_id('category',array('category_id'=>$subcategory->category_id));
											    echo $category->category_name;

											 ?>
												
											</td>
											
                                         <td>
											<a href="<?php echo base_url('onlinestationary/Subcategory/editsubcategory/'.$subcategory->subcat_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
											
											 <a data-toggle="modal"  data-target="#deleteModal" onclick="remove_circle(<?php echo $subcategory->subcat_id; ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
											   
										</td>
                                      </tr>
									<?php $i++; } } else { ?>
										
										<tr><td>No Sub category found</td></tr>
										
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
							<h4 class="modal-title">Delete Sub Category</h4>
						</div>
						<div class="modal-body">
							<p>Are you sure want to delete this Sub Category?</p>
						</div>
						<div class="modal-footer">
							<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
							<?php echo form_open(base_url().'onlinestationary/Subcategory/deletesubcategory'); ?>
								<input name="delete_subcatId" type="hidden" id="delete_subcatId" value="">
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
						$("#delete_subcatId").val(id);
					}

				</script>