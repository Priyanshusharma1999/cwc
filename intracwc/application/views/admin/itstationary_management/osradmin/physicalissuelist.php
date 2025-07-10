  
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Physical Issue</h6>
								<hr>
								
								
						<?php if($this->session->flashdata('flashSuccess_issue')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_issue');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>
						
								<?php
					   
				$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_request');
     		     echo form_open_multipart('itonlinestationary/osradmin/search_request/',$attributes);?>			
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
											<th>Req No.</th>
											<th>Req Date</th>
											<th>Officer Name</th>
											<th>Officer Desg</th>
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
											echo $user_detail->display_name;
											?>
											
											</td>
											
											<td><?php echo $user_detail->designation; ?></td>

											<td>
											  <?php if($request->is_supplementary == '1'){?>
												<span class="label label-success">Supplementary</span>
											  <?php } else if($request->is_miscallenous == '1'){?> 
											 	<span class="label label-success">Miscallenous</span> 
											  <?php } else {?>
		                                        <span class="label label-success">General Requisition</span>
											  <?php } ?>
											</td>
									
                                            <td><span class="label label-success-border">
											    <?php echo $request->status; ?></span>
											</td>
											
										<td>
								<?php if($request->status=='Approved')
								{?>	
							
									<a href="<?php echo base_url('itonlinestationary/osradmin/issueto/'.$request->req_id) ?>" class="btn btn-sm btn-primary"> <i class="fa fa-plus"></i> Issue To</a>
									
								<?php } ?>		

								 <a href="<?php echo base_url('itonlinestationary/osradmin/viewrequest/'.$request->req_id) ?>" class="btn btn-sm btn-success">view</a>

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
						var link = base_url+'itonlinestationary/Requisition/requistion_data/';

					   $.ajax({
				        method: "POST",
				        url: link,
				        data: {'req_id':req_id},
				        success: function(result) {
				          console.log(result); 
							
				          var obj = JSON.parse(result);
						      	
				      	var json_table = obj.all_request;
				      	 var tr='';
				      	 var j =1;

					        for (var i = 0; i < json_table.length; i++) {

	                    	tr += '<tr><td style="border:1px solid #333;">'+ j +'</td><td style="border:1px solid #333;">'+ json_table[i].item_name +'</td><td style="border:1px solid #333;">'+ json_table[i].req_qty +'</td><td style="border:1px solid #333;">'+ json_table[i].approved_qty +'</td><td style="border:1px solid #333;">'+ json_table[i].issued_qty +'</td><td style="border:1px solid #333;">'+ json_table[i].req_remark +'</td></tr>';

	                    	 j++;

					        }
                                 
                        var divToPrint='<div class="page-wrapper"><div class="content container-fluid"><div class="row"><div class="col-lg-12"><div class="card-box"><div class="card-block"><h3 style="text-align:center;">Government of India</h3><h3 style="text-align:center;">Central Water Commission</h3><h3 style="text-align:center;">Indent of MISC Items</h3><hr><p>Dte/Sec. Code No................ </p><p>Month ..............</p><p> Name pf Dte/Sec ..............</p><p>Existing strength of Dte/Sec .............</p><p>B.P.L. No...............</p><p>Dir. &nbsp&nbsp&nbsp&nbsp Dupty Dir.  &nbsp&nbsp&nbsp&nbsp A.D./E.A.D. &nbsp&nbsp&nbsp&nbsp  D/man  &nbsp&nbsp&nbsp&nbsp U.S./S.O. &nbsp&nbsp&nbsp&nbsp  AisstUDC/LDC &nbsp&nbsp&nbsp&nbsp OTHER</p><p>'+obj.dir_no+' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '+obj.dydir_no+' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '+obj.adead_no+' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'+obj.dman_no+'  &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '+obj.so_no+' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '+obj.udcldc_no+' &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp '+obj.others+'</p><p>Requisition No &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'+req_id+'</p><p>Requisition Date &nbsp&nbsp&nbsp&nbsp'+obj.req_date+'</p><p>Approved Date &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'+obj.approved_date+'</p><p>Issued Date &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'+obj.issued_date+'</p><table style="border:1px solid #333;"><tr><th style="width:10%;text-align:left;border:1px solid #333;">Item No.</th><th style="width:26%;text-align:left;border:1px solid #333;">Item Name</th><th style="width:16%;text-align:left;border:1px solid #333;">Quantity Idented</th><th style="width:16%;text-align:left;border:1px solid #333;">Quantity Approved</th><th style="width:16%;text-align:left;border:1px solid #333;">Quantity Issued</th><th style="width:16%;text-align:left;border:1px solid #333;">Remarks</th></tr>'+tr+'</table> <p>Certified that the quantity idented is absolutely minimum and is based on actual work load.</p><div style="width:48%;float:left;margin-top:30px;">Attested Sign Of Authorised Person</div><div style="width:50%;float:right;margin-top:30px;">Sign And Name of IdentinOfficer/Seal</div><div style="width:33%;float:left;margin-top:50px;">Approved</div> <div style="width:33%;float:left;margin-top:50px;">Issued</div> <div style="width:33%;float:left;margin-top:50px;">Material Recd. As perCol 4 in Full and Correct Condition</div>  <div style="width:33%;float:left;margin-top:50px;">Incharge(S.U.)</div> <div style="width:33%;float:left;margin-top:50px;">Issuing Officer</div> <div style="width:33%;float:left;margin-top:50px;">Sign. & Name Authoris Person</div> </div></div></div></div></div></div>';

						      newWin= window.open("");
						      newWin.document.write(divToPrint);
						      newWin.print();
						      newWin.close();
				    		}

						});
						 	
						
					}

				</script>
	