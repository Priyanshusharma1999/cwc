  
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Notification List</h6>
								<hr>
								
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Message</th>
											<th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									<?php
										if($all_notification) {
											$i=1;
											foreach($all_notification as $notification) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php echo $notification->notification_message; ?></td>
											<td><?php 
											   $date = date('d F, Y', strtotime($notification->created_date));
											   echo $date; 
											 ?></td>
											<!--<td><a data-toggle="modal"  data-target="#withdrawModal" onclick="withdraw_request(<?php //echo $request->req_id; ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td> -->
                                        </tr>
										
										<?php $i++; } } else { ?>
										
										<tr><td>No Notification found</td></tr>
										
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

				<script type="text/javascript">
					
					function withdraw_request(id) 
					{
						$("#cancel_req").val(id);
					}

					function print_recipt(id) 
					{
							var req_id = id;
							var base_url = "<?php echo base_url(); ?>";
    						var link = base_url+'onlinestationary/Requisition/requistion_data/';
							 $.ajax({
					        method: "POST",

					        url: link,
					        data: {'req_id':req_id},
					        success: function(result) {
					          console.log(result); 
								
					          var obj = JSON.parse(result);
						      	
						      	var json_table = obj.all_request;
						      	 var tr='';

							        for (var i = 0; i < json_table.length; i++) {

			                    	tr += '<tr><td>'+ json_table[i].item_name +'</td><td>'+ json_table[i].req_qty +'</td><td>'+ json_table[i].approved_qty +'</td><td>'+ json_table[i].req_remark +'</td></tr>';

							        }
                                 
                        var divToPrint='<div class="page-wrapper"><div class="content container-fluid"><div class="row"><div class="col-lg-12"><div class="card-box"><div class="card-block"><h3 style="text-align:center;">Central Water Commission</h3><h4 style="text-align:center;">Receipt</h4><hr><p><label style="width:30%;display:inline-block;">Officer Name : </label><span>'+obj.user_name+'</span></p><p><label style="width:30%;display:inline-block;">Designation : </label><span >'+obj.designation+'</span></p><p><label style="width:30%;display:inline-block;">Wing :</label><span >'+obj.wing_name+'</span></p><p><label style="width:30%;display:inline-block;">Section : </label><span>'+obj.section_name+'</span></p><table class="table table-bordered"><tr><th style="width:20%;text-align:left;">Item Name</th><th style="width:20%;text-align:left;">Quantity</th><th style="width:20%;text-align:left;">Approved<th style="width:20%;text-align:left;">Remarks</th></tr>'+tr+'</table></div></div></div></div></div></div>';

							      newWin= window.open("");
							      newWin.document.write(divToPrint);
							      newWin.print();
							      newWin.close();
					    		}
        
    						});
						 	
						
					}

				</script>
		