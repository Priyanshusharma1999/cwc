   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Sub Category</h6>
								<hr>
                                
						<?php if($this->session->flashdata('flashSuccess_editsubcategory')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashSuccess_editsubcategory'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
                                
						<?php
						
						$uri = $this->uri->segment('4'); 
					 	$attributes = array('class' => '', 'id' =>'add_category');
     					echo form_open_multipart('itonlinestationary/Subcategory/editsubcategory/'.$uri,$attributes);?>

                          <div class="col-sm-6">
								<div class="form-group">
									<label>Select Category<span class="required">*</span></label>
								    <select  class="form-control" name="category_name">
									   <option value="">Select Category</option>
									   <?php foreach($all_category as $category){?>
									    <option value="<?php echo $category->category_id;?>" <?php if($category->category_id ==$subcategory_detail->category_id ) {echo 'selected'; } ?>>
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
							       <input class="form-control" type="text" name="subcategory_name" placeholder="Sub Category Name" value="<?php echo $subcategory_detail->subcat_name; ?>">
									<span class = "text-danger"><?php echo form_error('subcategory_name');?></span>
								</div>
                            </div>
							
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Sub Category Shortname<span class="required">*</span></label>
							       <input class="form-control" type="text" name="subcategory_shortname" placeholder="Sub Category Short Name" value="<?php echo $subcategory_detail->subcat_short_name; ?>">
									<span class = "text-danger"><?php echo form_error('subcategory_shortname');?></span>
								</div>
                            </div>
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button type="submit"  name="submit" class="btn btn-primary">Update Category</button>
                            </div>
							
                       <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
   