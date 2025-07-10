   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Approve Report</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_approve')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_approve');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>
						
							
				<?php
					   
				$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_request');
     		     echo form_open_multipart('onlinestationary/report/search_apprequest/',$attributes);?>			
								
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
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Requisition No.</th>
											<th>Requisition Date</th>
                                            <th>Officer Name</th>
											<th>Officer Designation</th>
											<th>Wing</th>
											<th>Section</th>
											<th>Item Name</th>
											<th>Status</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										if($all_request) {
											$i=1;
											foreach($all_request as $request) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $request->req_id; ?></td>
											<td>
											 <?php 
											   $date = date('d F, Y', strtotime($request->req_date));
											   echo $date; 
											 ?>
											</td>
                                            <td>
											<?php
											$user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $request->user_id));
											echo $user_detail->user_name;
											?>
											
											</td>
											
											<td><?php echo $user_detail->designation; ?></td>
											 <td>
                                            	<?php
                                            		$wing = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
	                                             	echo $wing->wing_name; 
                                            	?>
                                            </td>
                                            <td>
                                            	<?php
                                            		
                                            		$section = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
	                                             	echo $section->section_name; 
                                            	?>

                                            </td>
                                             <td>
                                             	<?php 

	                                             	$item_data = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$request->req_id));
	                                             	$itemm = array();
	                                             	foreach ($item_data as $itm) 
	                                             	{

	                                             		$item_name = $this->Base_model->get_record_by_id('osr_item_master', array('item_id' => $itm->item_id));
	                                             		
	                                             		$itemm[] = $item_name->item_name;
	                                             	}
	                                         		
	                                         		
								    				$item = implode(',',$itemm); 
								    				echo $item; 
                                             	?>
                                             		
                                             </td>
											<td>
											  <span class="label label-success-border">
											     <?php echo $request->status; ?>
											  </span>
											</td>
										
                                        </tr>
										
										<?php $i++; } } else { ?>
										
										<tr><td>No Request found</td></tr>
										
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

        		$all_approve= array();

        		foreach ($all_request as $req) 
        		{
        			$user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $req->user_id));
        			$wing = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
        			$section = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
        			$item_data = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$req->req_id));
                 	$itemm = array();
                 	$appqty = array();
                 	foreach ($item_data as $itm) 
                 	{

                 		$item_name = $this->Base_model->get_record_by_id('osr_item_master', array('item_id' => $itm->item_id));
                 		
                 		$itemm[] = $item_name->item_name;

                 		$appqty[] = $itm->approved_qty;
                 	}
             		
             		
    				$item = implode(',',$itemm); 

    				$appquantity = implode(',',$appqty); 

    				$date = date('d F, Y', strtotime($req->req_date));
											  

        			$approve['Requisition No']   =  $req->req_id;
        			$approve['Requisition Date'] 			=  $date;
        			$approve['Officer Name'] 	=  $user_detail->user_name;
        			$approve['Officer Designation'] 	=  $user_detail->designation; 
        			$approve['Wing'] 			=  $wing->wing_name;
        			$approve['Section'] 		=  $section->section_name;
        			$approve['Item Name'] 		=  $item;
        			$approve['Item Quantity'] 	=  $appquantity;
        			

        			$all_approve[] = $approve;
	                

        		}//ends foreach

        		$json_apprve = json_encode($all_approve);
        	/************ends all report json code**********/
        ?>
		
		<style>
		  .form-inline .form-control{max-width:185px!important;}
		</style>

		<script>

			window.saveFile = function saveFile () 
			{
				var complaint_Array = <?php echo $json_apprve; ?>;
				var data1 = complaint_Array;

				if(data1.length==0)
		  		{
		  			var data1 =  [{'Requisition No':'','Requisition Date':'','Officer Name':'','Designation':'','Wing':'','Section':'','Item Name':'','Item Quantity':''}];
		  		}

		  		else
			  	{
			  		var data1 = data1;
			  	}

			  	var opts = [{sheetid:'Annexure A',header:true}];
		    	var res = alasql('SELECT INTO XLSX("Approvereport.xlsx",?) FROM ?',
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
