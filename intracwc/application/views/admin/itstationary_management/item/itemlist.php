   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Item List</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_item')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_item');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>
						
					<?php
					 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_item');
     					echo form_open_multipart('itonlinestationary/item/search_item/',$attributes);?>
						
							  <div class="form-group">
								<input class="form-control" type="text"  name="name" placeholder="Item Name">
							  </div>

							  <div class="form-group">
								<select  class="form-control" name="category">
								   <option selected="selected" value="">Select Category</option>
								    <?php
									 if($all_category) {
										foreach($all_category as $cat) { ?>
                                         <option value="<?php echo $cat->category_id; ?>">
                                         	<?php echo $cat->category_name; ?>
                                         </option>
									<?php } } ?>	
								</select>
							  </div>
							  <div class="form-group">
								<select  class="form-control" name="subcategory">
								   <option selected="selected" value="">Select Subcategory</option>
									<?php
									 if($all_subcategory) {
										foreach($all_subcategory as $subcat) { ?>
                                         <option value="<?php echo $subcat->subcat_id; ?>">
                                         	<?php echo $subcat->subcat_name; ?>
                                         </option>
									<?php } } ?>	
								</select>
							  </div>

							  <button type="submit" name="submit" class="btn btn-success btn-search">
							    Search
							  </button>
						
						  <?php echo form_close();?>
								
							<a href="<?php echo site_url();?>itonlinestationary/item/additem"  class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add Item</a>
								
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th style="width:22%;">Item Name</th>
											<th>Category</th>
											<th>Sub Category</th>
											<th>Total Stock</th>
											<th>Approved Stock</th>
											<th>Quantity Alert</th>
                                            <th style="width:15%;">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
								<?php 
										if($all_items) {
											$i=1;
											foreach($all_items as $item) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
											<td><?php echo $item->item_name; ?></td>
											<td>
											  <?php 
											    $catgory = $this->Base_model->get_record_by_id('category',array('category_id'=>$item->category_id));
											    if(!empty($catgory)){
											    	echo $catgory->category_name;
											    } else {
											    	echo 'N/A';
											    }
											  ?>	
											 </td>
											<td>
											  <?php 
											   $subcat = $this->Base_model->get_record_by_id('sub_category',array('subcat_id'=>$item->subcategory_id));
											    if(!empty($subcat)){
											    	echo $subcat->subcat_name;
											    } else {
											    	echo 'N/A';
											    }
											   ?>
											</td>
										
                                            <td><?php echo $item->quantity_stock; ?></td>
                                            <td><?php echo $item->approved_stock; ?></td>

                                          <td>
                                            <?php 
                                             if($item->quantity_stock <= $item->quantity_min){?>
                                               
                                             <span class="label label-danger">Item Shortage</span>

                                             <?php } else {?>

                                             	<span class="label label-success">In Stock</span>

                                            <?php } ?>
                                         </td>
											
                                         <td>
									<a href="<?php echo base_url('itonlinestationary/item/edititem/'.$item->item_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
									
									 <a data-toggle="modal"  data-target="#deleteModal" onclick="remove_circle(<?php echo $item->item_id; ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>

									  <a href="<?php echo base_url('itonlinestationary/item/viewitem/'.$item->item_id) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
											   
											</td>
                                        </tr>
									<?php $i++; } } else { ?>
										
										<tr><td>No Items found</td></tr>
										
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
							<h4 class="modal-title">Delete Item</h4>
						</div>
						<div class="modal-body">
							<p>Are you sure want to delete this item?</p>
						</div>
						<div class="modal-footer">
							<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
							<?php echo form_open(base_url().'itonlinestationary/item/delete_item'); ?>
								<input name="delete_itemId" type="hidden" id="delete_itemId" value="">
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
						$("#delete_itemId").val(id);
					}

				</script>