   
	 <div class="page-wrapper">
			<div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Item Issued Detail</h6>
								<hr>

						<p>        
						  <label>Item Name</label><span><?php echo $item_detail->item_name; ?></span>
						</p>
						<p>					   
						 <label>Alert Quantity</label><span><?php  echo $item_detail->quantity_min; ?></span>
						</p>
						<p>						
						 <label>Total Stock</label><span><?php  echo $item_detail->quantity_stock; ?></span>	
						</p>
						<p>					   
						 <label>Available Stock</label><span><?php  echo ($item_detail->quantity_stock-$item_detail->approved_stock); ?></span>	
						<p>

							<button onclick="saveFile()" class="btn btn-danger pull-right">Export to Excel</button>
						
						  <table id="myTable" class="table datatable table-stripped table-bordered table-responsive" >
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Employee Name</th>
										<th>Employee Designation</th>
										<th>Approved Quantity</th>
										<th>Issued Quantity</th>
										<th>Issued Date</th>
										<th>Finaicial Year</th>
									</tr>
								</thead>
								<tbody>

						<?php

						if($item_issuedet) {

							$i=1;

							foreach($item_issuedet as $issuedet) { 

								$detail = $this->Base_model->get_record_by_id('osr_requisition_master', array('req_id' => $issuedet->req_id,'status'=>'Closed'));

								if(!empty($detail)){?>

									  <tr>
										 <td><?php  echo $i; ?></td>
										 <td> 
										 <?php 
										    $empdetail = $this->Base_model->get_record_by_id('users', array('user_id' => $detail->user_id));

										     echo $empdetail->display_name; ?> 
										</td>

										 <td><?php  echo $empdetail->designation; ?></td>
										  <td><?php echo $issuedet->approved_qty; ?></td>
										   <td><?php echo $issuedet->issued_qty; ?></td>
										 <td><?php  echo date('d F Y', strtotime($detail->issue_date)); ?></td>
										 <td><?php  echo $detail->financial_year; ?></td>
									  </tr>

							  <?php $i++; } } } else { ?>
									
									<tr><td>No Detail found</td></tr>
									
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
		  p label{width:20%;}
		</style>
	

	  <?php 

        	/*****************all report json code**********/

        		$all_detail= array();

        		$i=1;

        		foreach ($item_issuedet as $issuedet) 
        		{
        			
                    $detail = $this->Base_model->get_record_by_id('osr_requisition_master', array('req_id' => $issuedet->req_id,'status'=>'Closed'));

                    if(!empty($detail->user_id)){
                        
                        $empdetail = $this->Base_model->get_record_by_id('users', array('user_id' => $detail->user_id));

	        			$issuedetails['S.No.']                  =  $i;
	        			$issuedetails['Employee Name'] 			=  $empdetail->display_name;
	        			$issuedetails['Employee Designation'] 	=  $empdetail->designation;
	        			$issuedetails['Item Name'] 	            =  $item_detail->item_name;
	        			$issuedetails['Approved Quantity'] 	    =  $issuedet->approved_qty; 
	        			$issuedetails['Issued Quantity'] 	    =  $issuedet->issued_qty; 
	        			$issuedetails['Issued Date'] 			=  date('d F Y', strtotime($detail->issue_date));
	        			$issuedetails['Finaicial Year'] 		=  $detail->financial_year;

	        			$all_detail[] = $issuedetails;

        		    	$i++;

                    }

        		}//ends foreach

        		$json_apprve = json_encode($all_detail);
        	/************ends all report json code**********/
        ?>

        <script>

			window.saveFile = function saveFile () 
			{
				var item_Array = <?php echo $json_apprve; ?>;
				var data1 = item_Array;

				if(data1.length==0)
		  		{
		  			var data1 =  [{'S.No.':'','Employee Name':'','Employee Designation':'','Item Name':'','Approved Quantity':'','Issued Quantity':'','Issued Date':'','Finaicial Year':''}];
		  		}

		  		else
			  	{
			  		var data1 = data1;
			  	}

			  	var opts = [{sheetid:'Annexure A',header:true}];
		    	var res = alasql('SELECT INTO XLSX("itemissuereport.xlsx",?) FROM ?',
		                     [opts,[data1]]);

			}//ends function
		</script>