   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">General Store Requisition</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashSuccess_request')) { ?>
						<div class='alert alert-success'> 
						   <?php echo $this->session->flashdata('flashSuccess_request');?> 
						  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div>
						<?php } ?>
						
						<?php
					 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_proxy');
     					echo form_open_multipart('itonlinestationary/osradmin/search_proxy/',$attributes);?>
						
							   <div class="form-group">
									<select  class="form-control" name="status">
									   <option selected="selected" value="">Select Status</option>
										<option value="">All</option>
										<option value="Closed">Closed</option>
										<option value="Pending">Pending</option>
										<option value="Withdrawn">Withdrawn</option>
									</select>
							  </div>
							  
						      <button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
								  
						<?php echo form_close();?>
							
								<a href="<?php echo site_url();?>itonlinestationary/osradmin/addproxy" class="btn btn-success pull-right"><i class="fa fa-plus"></i>New Proxy Requisition</a>
							
								
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Requisition No.</th>
											<th>Requisition Date</th>
											<th>Officer Name</th>
											<th>Officer Designation</th>
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
                                            <td><span class="label label-success-border">
											    <?php echo $request->status; ?></span>
											</td>
						<td>
					<?php if($request->status=='Pending'){?>					
					      <a href="<?php echo base_url('itonlinestationary/osradmin/editproxy/'.$request->req_id) ?>" class="btn btn-sm btn-info">Edit</a>
					<?php } ?>
						
			        <a href="<?php echo base_url('itonlinestationary/osradmin/viewrequest/'.$request->req_id) ?>" class="btn btn-sm btn-success">view</a>
					
					<?php if($request->status=='Pending'){?>
					<a data-toggle="modal"  data-target="#withdrawModal" onclick="withdraw_request(<?php echo $request->req_id; ?>)" class="btn btn-sm btn-danger">Withdraw</a>
					<?php } ?>											   
											 
					 <button onclick="print_recipt(<?php echo $request->req_id ;?>)" class="btn btn-sm btn-danger">Receipt</button>
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
					<?php echo form_open(base_url().'itonlinestationary/osradmin/withdraw_request'); ?>
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
    						var link = base_url+'itonlinestationary/osradmin/requistion_data/';
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