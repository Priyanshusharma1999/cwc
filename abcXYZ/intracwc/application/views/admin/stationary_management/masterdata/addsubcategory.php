   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Subcategory</h6>
								<hr>
								
					<?php if($this->session->flashdata('flashError_addsubcategory')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_addsubcategory'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
						<?php } ?>
                                
					<?php
					 	$attributes = array('class' => '', 'id' =>'add_subcategory');
     					echo form_open_multipart('onlinestationary/Subcategory/addsubcategory/',$attributes);?>
						
						
						  <div class="col-sm-6">
								<div class="form-group">
									<label>Select Category<span class="required">*</span></label>
								    <select  class="form-control" name="category_name">
									   <option value="">Select Category</option>
									   <?php foreach($all_category as $category){?>
									    <option value="<?php echo $category->category_id;?>">
										  <?php echo $category->category_name; ?>
										</option>
									   <?php } ?>	
									</select>
								    <span class="text-danger"><?php echo form_error('category_name');?></span>
								</div>
                            </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Sub Category Name<span class="required">*</span></label>
							       <input class="form-control" type="text" name="subcategory_name" placeholder="Sub Category Name" value="<?php echo isset($insertData['subcategory_name']) ? $insertData['subcategory_name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('subcategory_name');?></span>
								</div>
                            </div>
							
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Sub Category Shortname<span class="required">*</span></label>
							       <input class="form-control" type="text" name="subcategory_shortname" placeholder="Sub Category Short Name" value="<?php echo isset($insertData['subcategory_shortname']) ? $insertData['subcategory_shortname'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('subcategory_shortname');?></span>
								</div>
                            </div>
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button type="submit"  name="submit" class="btn btn-primary">Add Subcategory</button>
                            </div>
							
                       <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
   