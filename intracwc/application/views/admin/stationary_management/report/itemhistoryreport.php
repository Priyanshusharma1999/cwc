   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Item History Report</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_approve')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_approve');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>
						
							
				<?php
					   
				$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_request');
     		     echo form_open_multipart('onlinestationary/report/search_itemhistory/',$attributes);?>	

     		             <div class="form-group">
						     <input class="form-control" placeholder="Item Name" name="item_name" type="text">
						 </div>		
								
						 <div class="form-group">
						   <div class="cal-icon">
						      <input class="form-control datetimepicker" placeholder="From Date" name="from_date" type="text">
						    </div>
						  </div>
								  
							<div class="form-group">
							  <div class="cal-icon">
							      <input class="form-control datetimepicker" placeholder="To Date" name="to_date" type="text">
							   </div>
							</div>
				<button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
								  
						<?php echo form_close();?>		
							<button onclick="saveFile()" class="btn btn-danger pull-right">Export to Excel</button>
                               

                               <table class="display datatable table table-stripped table-bordered table-responsive">
                                <thead>
                                    <tr>
                                        <th>S.No.</th>
										<th>Item Name</th>
										<th>Category</th>
										<th>Sub Category</th>
										<th>Available Stock</th>
										<th>Approved Stock</th>
										<th>Add Stock</th>
										<th>Issued Stock</th>
										<th>Date</th>
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

                                        <td><?php echo $item->approveddaily_stock; ?></td>

                                        <td><?php echo $item->adddaily_stock; ?></td>

                                        <td><?php echo $item->issueddaily_stock; ?></td>

                                        <td><?php echo date('d F, Y', strtotime($item->cronjob_date)); ?></td>

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
		 <?php 

        	/*****************all report json code**********/

        		$all_itemslist= array();

        		$i=1;

        		foreach ($all_items as $item) 
        		{
        			$catgory = $this->Base_model->get_record_by_id('category',array('category_id'=>$item->category_id));
				    if(!empty($catgory)){
				    	$catname =  $catgory->category_name;
				    } else {
				    	$catname = 'N/A';
				    }

				    $subcat = $this->Base_model->get_record_by_id('sub_category',array('subcat_id'=>$item->subcategory_id));
				    if(!empty($subcat)){
				    	$subcatname = $subcat->subcat_name;
				    } else {
				    	$subcatname = 'N/A';
				    }

    				$date = date('d F, Y', strtotime($item->cronjob_date));
											  

        			$itms['Serial No']        =  $i;
        			$itms['Item Name'] 		  =  $item->item_name;
        			$itms['Category'] 	      =  $catname;
        			$itms['Sub Category'] 	  =  $subcatname; 
        			$itms['Available Stock']  =  $item->quantity_stock;
        			$itms['Approved Stock']   =  $item->approveddaily_stock;
        			$itms['Add Stock']        =  $item->adddaily_stock;
        			$itms['Issued Stock']     =  $item->issueddaily_stock;
        			$itms['Financial Year']   =  $item->financial_year;
        			$itms['Date'] 		      =  $date;

        			$all_itemslist[] = $itms;

        			$i++;
	                

        	}//ends foreach

        	$json_items = json_encode($all_itemslist);

        	/************ends all report json code**********/
        ?>
		
		<style>
		  .form-inline .form-control{max-width:185px!important;}
		</style>

		<script>

			window.saveFile = function saveFile () 
			{
				var items_Array = <?php echo $json_items; ?>;
				var data1 = items_Array;

				if(data1.length==0)
		  		{
		  			var data1 =  [{'Serial No':'','Item Name':'','Category':'','Sub Category':'','Available Stock':'','Approved Stock':'','Add Stock':'','Issued Stock':'','Financial Year':'','Date':''}];
		  		}

		  		else
			  	{
			  		var data1 = data1;
			  	}

			  	var opts = [{sheetid:'Annexure A',header:true}];
		    	var res = alasql('SELECT INTO XLSX("itemhistory.xlsx",?) FROM ?',
		                     [opts,[data1]]);

			}//ends function
		</script>
      
	 

	<style>
	   .btn-search {
			margin-top: -15px;
		}
		
		
		.form-inline .form-group{margin-bottom:15px;}
		
		.form-inline .form-control{width:200px;}
		
	</style>
