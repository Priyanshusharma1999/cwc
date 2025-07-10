   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Category</h6>
								<hr>
								
					<?php if($this->session->flashdata('flashError_addcategory')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_addcategory'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
						<?php } ?>
                                
					<?php
					 	$attributes = array('class' => '', 'id' =>'add_category');
     					echo form_open_multipart('itonlinestationary/Category/addcategory/',$attributes);?>

						   <div class="col-sm-6">
								<div class="form-group">
									<label>Category Name<span class="required">*</span></label>
							       <input class="form-control" type="text" name="category_name" placeholder="Category Name" value="<?php echo isset($insertData['category_name']) ? $insertData['category_name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('category_name');?></span>
								</div>
                            </div>
							
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Category Shortname<span class="required">*</span></label>
							       <input class="form-control" type="text" name="category_shortname" placeholder="Category Short Name" value="<?php echo isset($insertData['category_shortname']) ? $insertData['category_shortname'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('category_shortname');?></span>
								</div>
                            </div>

                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button type="submit"  name="submit" class="btn btn-primary">Add Category</button>
                            </div>
							
                       <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
   