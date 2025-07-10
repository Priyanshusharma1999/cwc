   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Update Item</h6>
								<hr>
                                
						<?php if($this->session->flashdata('flashError_itemedit')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_itemedit'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
                                
						<?php
						
						$uri = $this->uri->segment('4'); 
					 	$attributes = array('class' => '', 'id' =>'edit_item');
     					echo form_open_multipart('onlinestationary/item/edititem/'.$uri,$attributes);?>
						

                          <div class="col-sm-6">
								<div class="form-group">
									<label>Select Category<span class="required">*</span></label>
								    <select  class="form-control" name="category" id="category">
									   <option value="">Select Category</option>
									   <?php foreach($all_category as $category){?>
									    <option <?php if($category->category_id == $item_detail->category_id) { echo 'selected'; } ?> value="<?php echo $category->category_id;?>">
										  <?php echo $category->category_name; ?>
										</option>
									   <?php } ?>	
									</select>
								    <span class="text-danger"><?php echo form_error('category');?></span>
								</div>
                            </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Select Sub Category<span class="required">*</span></label>
								    <select  class="form-control" name="subcategory" id="subcategory">
									   <option value="">Select Sub Category</option>
									    <?php foreach($all_subcategory as $subcategory){?>
									    <option <?php if($subcategory->subcat_id == $item_detail->subcategory_id) { echo 'selected'; } ?> value="<?php echo $subcategory->subcat_id;?>">
										  <?php echo $subcategory->subcat_name; ?>
										</option>
									   <?php } ?>	
									</select>
								    <span class="text-danger"><?php echo form_error('subcategory');?></span>
								</div>
                            </div>

						 <div class="col-sm-6">
								<div class="form-group">
									<label>Item Name<span class="required">*</span></label>
							       <input class="form-control" type="text" name="itemname" placeholder="Item Name" value="<?php echo $item_detail->item_name; ?>">
									<span class = "text-danger"><?php echo form_error('itemname');?></span>
								</div>
                         </div>
						
						 <div class="col-sm-6">
							<div class="form-group">
								<label>Alert Minimum Quantity<span class="required">*</span></label>
								<input class="form-control" type="number" min="0" name="minqty" placeholder="Alert Minimum Quantity" value="<?php echo $item_detail->quantity_min; ?>">
								<span class = "text-danger"><?php echo form_error('minqty');?></span>
							</div>
                         </div>
							
					
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button type="submit"  name="submit" class="btn btn-primary">Update Item</button>
                            </div>
							
                       <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
   

    <script>
        	
        $(document).ready(function() {

		 	  $('#category').on('change', function(event){
		                    var cat_id = $("#category").val();
		                    
		                    var option ='';
		                    var base_url = "<?php echo base_url(); ?>";
		                    var link = base_url+'onlinestationary/Item/getallsubcategory';
		                   
		                  $.ajax({
		                    method: "POST",
		                    url: link,
		                    data: {'id':cat_id},
		                    success: function(result) {
		                  
		                       var obj = JSON.parse(result);

		                       console.log(obj);

		                     option = '<option selected="selected" value="">Select Sub Category</option>';
		                       $.each(obj, function(){

		                                option+='<option value="'+this["subcat_id"]+'">'+this["subcat_name"]+'</option>';
		                            });
		                        
		                        $("#subcategory").html(option);
		                         event.preventDefault();

		                    }
		                    
		                });

		           });
 	          });

        </script>