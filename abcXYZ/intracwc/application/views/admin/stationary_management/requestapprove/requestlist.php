   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Approve Request</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_approve')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_approve');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>
						
							
				<?php
					   
				$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_request');
     		     echo form_open_multipart('onlinestationary/approverequisition/search_request/',$attributes);?>			
								 <div class="form-group">
									<select class="form-control" name="status">
									   <option selected="selected" value="">Select Status</option>
										<option value="">All</option>
										<option value="Closed">Closed</option>
										<option value="Pending">Pending</option>
										<option value="Approved">Approved</option>
										<option value="Withdrawn">Withdrawn</option>
									</select>
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
							
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Req Date</th>
                                            <th>Officer Name</th>
											<th>Officer Desg</th>
											<th>Directorate</th>
											<th>Req Type</th>
											<th>Status</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										if($all_request) {
											$i=1;
											foreach($all_request as $request) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
											<td>
											 <?php 
											   $date = date('d F, Y', strtotime($request->req_date));
											   echo $date; 
											 ?>
											</td>
                                            <td>
											<?php
											$user_detail = $this->Base_model->get_record_by_id('users',array('user_id' => $request->user_id));
											echo $user_detail->display_name;
											?>
											
											</td>
											
											<td><?php echo $user_detail->designation; ?></td>

											<td>
											<?php 

				     					      $udet = $this->Base_model->get_record_by_id('users',array('user_id'=>$user_detail->user_id));
				     					      $empdetail = $this->Base_model->get_record_by_id('employee',array('employee_id'=>$udet->employee_id));
				     					      $office = $this->Base_model->get_record_by_id('employee_office',array('office_id'=>$empdetail->post));

				     					        echo $office->office_name;
					     					  ?>

											</td>

											<td>
											  <?php if($request->is_supplementary == '1'){?>
												<span class="label label-success">Supplementary</span>
											  <?php } else if($request->is_miscallenous == '1'){?> 
											 	<span class="label label-success">Miscallenous</span> 
											  <?php } else {?>
		                                        <span class="label label-success">General Requisition</span>
											  <?php } ?>
											</td>

											<td>
											  <span class="label label-success-border">
											     <?php echo $request->status; ?>
											  </span>
											</td>
											<td>
							
					<?php if($request->status=='Pending'){?>		
					<a href="<?php echo base_url('onlinestationary/approverequisition/approverequest/'.$request->req_id) ?>" class="btn btn-sm btn-primary">Action for Approve</a>
					<?php } ?>	
					
              <a href="<?php echo base_url('onlinestationary/approverequisition/viewrequest/'.$request->req_id) ?>" class="btn btn-sm btn-success">View</a>

              <button onclick="print_recipt(<?php echo $request->req_id ;?>)"  class="btn btn-sm btn-danger">Receipt</button>
				
                        					
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
		
	<style>
	   .btn-search {
			margin-top: -15px;
		}
		
		.sr-form{text-align:left;}
		
		.form-inline .form-group{margin-bottom:15px;}
		
		.form-inline .form-control{width:200px;}
		
	</style>


            <script type="text/javascript">
					
              function print_recipt(id) 
					{
							
						var req_id = id;
						var base_url = "<?php echo base_url(); ?>";
						var link = base_url+'onlinestationary/Requisition/requistion_data/';

					   $.ajax({
				        method: "POST",
				        url: link,
				        dataType: 'json',
				        data: {'req_id':req_id},
				        success: function(result) {
				            
				          console.log(result); 
				          
				         var alldata = JSON.parse(result.all_request);
						
				      	 var tr='';
				      	 var j =1;

                       $.each(alldata, function(){

                            tr += '<tr><td style="border:1px solid #333;">'+ j +'</td><td style="border:1px solid #333;">'+ this['item_name'] +'</td><td style="border:1px solid #333;">'+ this['req_qty'] +'</td><td style="border:1px solid #333;">'+ this['approved_qty'] +'</td><td style="border:1px solid #333;">'+ this['issued_qty'] +'</td><td style="border:1px solid #333;">'+ this['req_remark'] +'</td></tr>';

	                    	 j++;
                        });
                                 
                     
                    var divToPrint='<div class="page-wrapper"><div class="content container-fluid"><div class="row"><div class="col-lg-12"><div class="card-box"><div class="card-block"><h3 style="text-align:center;">Government of India</h3><h3 style="text-align:center;">Central Water Commission</h3><h3 style="text-align:center;">Indent of MISC Items</h3><hr><p>Dte/Sec. Code No................ </p><p>Month ..............</p><p> Name pf Dte/Sec ..............</p><p>Existing strength of Dte/Sec .............</p><p>B.P.L. No...............</p><p>Dir. &nbsp&nbsp&nbsp&nbsp Dupty Dir.  &nbsp&nbsp&nbsp&nbsp A.D./E.A.D. &nbsp&nbsp&nbsp&nbsp  D/man  &nbsp&nbsp&nbsp&nbsp U.S./S.O. &nbsp&nbsp&nbsp&nbsp  AisstUDC/LDC &nbsp&nbsp&nbsp&nbsp OTHER</p><p>'+result.dir_no+' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '+result.dydir_no+' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '+result.adead_no+' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'+result.dman_no+'  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '+result.so_no+' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '+result.udcldc_no+' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '+result.others+'</p><p>Requisition No &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'+result.req_id+'</p><p>Requisition Date &nbsp&nbsp&nbsp&nbsp'+result.req_date+'</p><p>Approved Date &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'+result.approved_date+'</p><p>Issued Date &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'+result.issued_date+'</p><table style="border:1px solid #333;"><tr><th style="width:10%;text-align:left;border:1px solid #333;">Item No.</th><th style="width:26%;text-align:left;border:1px solid #333;">Item Name</th><th style="width:16%;text-align:left;border:1px solid #333;">Quantity Idented</th><th style="width:16%;text-align:left;border:1px solid #333;">Quantity Approved</th><th style="width:16%;text-align:left;border:1px solid #333;">Quantity Issued</th><th style="width:16%;text-align:left;border:1px solid #333;">Remarks</th></tr>'+tr+'</table> <p>Certified that the quantity idented is absolutely minimum and is based on actual work load.</p><div style="width:48%;float:left;margin-top:30px;">Attested Sign Of Authorised Person</div><div style="width:50%;float:right;margin-top:30px;">Sign And Name of IdentinOfficer/Seal</div><div style="width:33%;float:left;margin-top:50px;">Approved</div> <div style="width:33%;float:left;margin-top:50px;">Issued</div> <div style="width:33%;float:left;margin-top:50px;">Material Recd. As perCol 4 in Full and Correct Condition</div>  <div style="width:33%;float:left;margin-top:50px;">Incharge(S.U.)</div> <div style="width:33%;float:left;margin-top:50px;">Issuing Officer</div> <div style="width:33%;float:left;margin-top:50px;">Sign. & Name Authoris Person</div> </div></div></div></div></div></div>';
                    
                     	      newWin= window.open("");
						      newWin.document.write(divToPrint);
						      newWin.print();
						      newWin.close();
				    		}

						});
						 	
						
					}

			</script>