   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Directorate Item Report</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_approve')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_approve');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>
						
							
				<?php
					   
				$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_request');
     		     echo form_open_multipart('onlinestationary/report/search_directreport/',$attributes);?>		

 		              <div class="form-group">
 		              	 <select class="form-control" name="directorate">
 		              	 	<option value="">Select Directorate</option>
 		              	 	  <?php foreach($all_directorate as $dirt){?>
                                 <option value="<?php echo $dirt->office_id; ?>"><?php echo $dirt->office_name; ?></option>
 		              	 	  <?php } ?>
 		              	 </select>
					  </div>	
						
				       <button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
								  
						<?php echo form_close();?>	

                            <table class="display datatable table table-stripped table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
										<th>Item Name</th>
										<th>Category</th>
										<th>Sub Category</th>
										<th>Available Stock</th>
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
                                     <td>

								      <button onclick="saveFile(<?php echo $item->item_id; ?>)" class="btn btn-danger">Export to Excel</button>
										   
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
		<style>
		  .form-inline .form-control{max-width:185px!important;}
		</style>

		<script>

			window.saveFile = function saveFile(id) 
			{

				var item_id = id;

                var base_url = "<?php echo base_url(); ?>";
                var link = base_url+'onlinestationary/Report/getdirectoratereport';

				$.ajax({
	                    method: "POST",
	                    url: link,
	                    data: {'id':item_id},
	                    success: function(result) {
	                  
	                       var data1 = JSON.parse(result);

	                     if(data1.length==0)
					  	  {
					  			var data1 =  [{'S.No.':'','Employee Name':'','Employee Designation':'','Approved Quantity':'','Issued Quantity':'','Issued Date':'','Finaicial Year':''}];
					  	  }

					  		else
						  	{
						  		var data1 = data1;
						  	}

						  	var opts = [{sheetid:'Annexure A',header:true}];
					    	var res = alasql('SELECT INTO XLSX("itemissuereport.xlsx",?) FROM ?',
					                     [opts,[data1]]); 

		                   } 

	             });
			

			} //ends function

		</script>
      
	 

	<style>
	   .btn-search {
			margin-top: -15px;
		}
		
		
		.form-inline .form-group{margin-bottom:15px;}
		
		.form-inline .form-control{width:200px;}
		
	</style>
