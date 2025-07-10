   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Item</h6>
								<hr>
								
					<?php if($this->session->flashdata('flashError_item')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_item'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
						<?php } ?>
                                
					<?php
					 	$attributes = array('class' => '', 'id' =>'add_item');
     					echo form_open_multipart('itonlinestationary/item/additem/',$attributes);?>
						 

                             <div class="col-sm-6">
								<div class="form-group">
									<label>Select Category<span class="required">*</span></label>
								    <select  class="form-control" name="category" id="category">
									   <option value="">Select Category</option>
									   <?php foreach($all_category as $category){?>
									    <option value="<?php echo $category->category_id;?>">
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
									</select>
								    <span class="text-danger"><?php echo form_error('subcategory');?></span>
								</div>
                            </div>
                          

						   <div class="col-sm-6">
								<div class="form-group">
									<label>Item Name<span class="required">*</span></label>
							       <input class="form-control" type="text" name="itemname" placeholder="Item Name" value="<?php echo isset($insertData['item_name']) ? $insertData['item_name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('itemname');?></span>
								</div>
                            </div>
						
						 <div class="col-sm-6">
							<div class="form-group">
								<label>Alert Minimum Quantity<span class="required">*</span></label>
								<input class="form-control" type="number" min="0" name="minqty" placeholder="Alert Minimum Quantity" value="<?php echo isset($insertData['min_qty']) ? $insertData['min_qty'] : ''; ?>">
								<span class = "text-danger"><?php echo form_error('minqty');?></span>
							</div>
                         </div>
                         
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button type="submit"  name="submit" class="btn btn-primary">Add Item</button>
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
		                    var link = base_url+'itonlinestationary/Item/getallsubcategory';
		                   
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