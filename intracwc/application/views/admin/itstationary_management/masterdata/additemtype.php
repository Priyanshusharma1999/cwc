   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">

                            <h6 class="card-title text-bold">Add Item Type</h6>
							<hr>
								
						<?php if($this->session->flashdata('flashError_itemtype')) { ?>
							<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_itemtype'); ?> 
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
							<?php } ?>
	                                
						<?php
						 	$attributes = array('class' => '', 'id' =>'add_itemtype');
	     					echo form_open_multipart('itonlinestationary/Itemtype/additemtype/',$attributes);?>
							 
							    <div class="col-sm-6">
									<div class="form-group">
										<label>Item Type<span class="required">*</span></label>
								       <input class="form-control" type="text" name="item_type" placeholder="Item Type" value="<?php echo isset($insertData['item_type']) ? $insertData['item_type'] : ''; ?>">
										<span class = "text-danger"><?php echo form_error('item_type');?></span>
									</div>
	                            </div>
								
							   <div class="col-sm-6">
									<div class="form-group">
										<label>Item Type Description<span class="required">*</span></label>
								       <input class="form-control" type="text" name="itemtype_description" placeholder="Item Type Description" value="<?php echo isset($insertData['itemtype_description']) ? $insertData['itemtype_description'] : ''; ?>">
										<span class = "text-danger"><?php echo form_error('itemtype_description');?></span>
									</div>
	                            </div>

	                            <div class="m-t-20" style="padding-left:15px;clear:both;">
	                                <button type="submit"  name="submit" class="btn btn-primary">Add Item Type</button>
	                            </div>
								
	                       <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
   