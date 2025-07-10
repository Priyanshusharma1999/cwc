  
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Requisition Report</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_request')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_request');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>
						
						<?php
					 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_req');
     					echo form_open_multipart('onlinestationary/report/search_reqreport/',$attributes);?>
						
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
											<th>Officer Name</th>
											<th>Designation</th>
											<th>Wing</th>
											
											<th>Item Name</th>
											<th>Date</th>
											<th>Status</th>
                                           <!--  <th>Action</th> -->
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

                                            		$user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $request->user_id));
	                                             	echo $user_detail->user_name; 
                                            	?>
                                            </td>
                                            <td>
                                            	<?php
	                                             	echo $user_detail->designation; 
                                            	?>
                                            </td>
                                            <td>
                                            	<?php
                                            	
                                            		$wing = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
	                                             	echo $wing->wing_name; 
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
											 <?php 
											   $date = date('d F, Y', strtotime($request->req_date));
											   echo $date; 
											 ?>
											</td>
                                            <td><span class="label label-success-border">
											    <?php echo $request->status; ?></span>
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
		
		
		<div class="example-modal">
			<div class="modal fade" aria-hidden="true" id="withdrawModal">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title">Withdraw Request</h4>
						</div>
					<?php echo form_open(base_url().'onlinestationary/requisition/withdraw_request'); ?>
						<div class="modal-body">
						  <textarea name="reason" placeholder="Reason for withdraw request" class="form-control"></textarea>
						</div>
						<div class="modal-footer">
								<input name="cancel_req" type="hidden" id="cancel_req" value="">
								<input class="btn btn-primary" type="submit" id="" value="Submit">
						</div>
					<?php echo form_close() ?>	
					</div>
				</div>
			</div>
		</div>

		 <?php 

        	/*****************all report json code**********/

        		$all_requistionnn= array();

        		foreach ($all_request as $req) 
        		{
        			$user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $req->user_id));
        			$wing = $this->Base_model->get_record_by_id('wing',array('wing_id' => $user_detail->wing_id));
        			$section = $this->Base_model->get_record_by_id('section',array('section_id'=>$user_detail->section_id));
        			$item_data = $this->Base_model->get_all_record_by_condition('osr_requisition_item',array('req_id'=>$req->req_id));
                 	$itemm = array();
                 	$reqqty = array();
                 	foreach ($item_data as $itm) 
                 	{

                 		$item_name = $this->Base_model->get_record_by_id('osr_item_master', array('item_id' => $itm->item_id));
                 		
                 		$itemm[] = $item_name->item_name;

                 		$reqqty[] = $itm->req_qty;
                 	}
             		
             		
    				$item = implode(',',$itemm); 
    				$reqquantity = implode(',',$reqqty); 
    				$date = date('d F, Y', strtotime($req->req_date));
											  

        			$requistionnn['Requisition No']         =  $req->req_id;
        			$requistionnn['Officer Name']        	=  $user_detail->user_name; 
        			$requistionnn['Designation'] 	        =  $user_detail->designation; 
        			$requistionnn['Wing'] 			        =  $wing->wing_name;
        			$requistionnn['Section'] 		        =  $section->section_name;
        			$requistionnn['Requisition Item'] 		=  $item;
        			$requistionnn['Requisition Quantity']   =  $reqquantity;
        			$requistionnn['Date'] 			        =  $date;

        			$all_requistionnn[] = $requistionnn;
	                

        		}//ends foreach

        		$json_requsn = json_encode($all_requistionnn);
        	/************ends all report json code**********/
        ?>
		
		<style>
		  .form-inline .form-control{max-width:185px!important;}
		</style>

		<script>

			window.saveFile = function saveFile () 
			{
				var complaint_Array = <?php echo $json_requsn; ?>;
				var data1 = complaint_Array;

				if(data1.length==0)
		  		{
		  			var data1 =  [{'Requisition No':'','Officer Name':'','Designation':'','Wing':'','Section':'','Requisition Item':'','Requisition Quantity':'','Requisition Date':''}];
		  		}

		  		else
			  	{
			  		var data1 = data1;
			  	}

			  	var opts = [{sheetid:'Annexure A',header:true}];
		    	var res = alasql('SELECT INTO XLSX("Requisition.xlsx",?) FROM ?',
		                     [opts,[data1]]);

			}//ends function
		</script>
      
	 
	