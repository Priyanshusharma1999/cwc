   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Item Type</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_itemtype')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_itemtype');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>

						<?php if($this->session->flashdata('flashSuccess_updateitemtype')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_updateitemtype');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>


						<?php if($this->session->flashdata('flashSuccess_delitemtype')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_delitemtype');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>
					
								
							<a href="<?php echo site_url();?>onlinestationary/Itemtype/additemtype"  class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add Itemtype</a>
								
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Item Type</th>
											<th>Item Type Description</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
								<?php 
									if($itemtype) {
											$i=1;
											foreach($itemtype as $type) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>

											<td><?php echo $type->item_type; ?></td>

											<td><?php echo $type->itemtype_description; ?></td>
											
                                         <td>
									<a href="<?php echo base_url('onlinestationary/Itemtype/edititemtype/'.$type->itemtype_id) ?>" class="btn btn-sm btn-info"><i class="fa fa-pencil"></i></a>
									
									 <a data-toggle="modal"  data-target="#deleteModal" onclick="remove_circle(<?php echo $type->itemtype_id; ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
											   
											</td>
                                        </tr>
									<?php $i++; } } else { ?>
										
										<tr><td>No Item Type found</td></tr>
										
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
							<h4 class="modal-title">Delete Item Type</h4>
						</div>
						<div class="modal-body">
							<p>Are you sure want to delete this Item Type?</p>
						</div>
						<div class="modal-footer">
							<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
							<?php echo form_open(base_url().'onlinestationary/Itemtype/delete_itemtype'); ?>
								<input name="delete_itemtypeId" type="hidden" id="delete_itemtypeId" value="">
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
						$("#delete_itemtypeId").val(id);
					}

				</script>