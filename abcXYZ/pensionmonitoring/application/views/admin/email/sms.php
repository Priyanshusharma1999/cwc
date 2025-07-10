  
	   <div class="page-wrapper">
			
			<div class="content container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="page-title">SMS List</h4>
                    </div>
					
					<?php if($this->session->flashdata('flashSuccess_sms')) { ?>
						<div class='alert alert-success' style="clear:both;"> 
						  <?php echo $this->session->flashdata('flashSuccess_sms'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
						</div> 
					<?php } ?>
					
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="card-box">
                            <div class="email-header" style="margin-bottom:20px;">
                                <div class="row">
                                    <div class="col-sm-9 col-md-8 col-xs-8 top-action-left">
                                        <div class="pull-left hidden-xs">
											<?php
								      $attributes = array('class' => 'form-inline sr-form', 'id' =>'searchsms');
										echo form_open_multipart('email/search_sms/',$attributes);?> 
										   <div class="form-group">
											  <input class="form-control" type="text" name="mobile_no" placeholder="Mobile No">
										   </div>
										  <div class="form-group">
										   <button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
										  </div>
										<?php echo form_close();?>
											
                                        </div>
                                    </div>
									
									<div class="col-sm-3 col-md-4 col-xs-4 top-action-right">
                                        <div class="text-right">
                                            <a href="<?php echo site_url();?>email/send_sms" class="btn btn-primary">Send SMS</a>
                                        </div>
                                    </div>
                                  
                                </div>
                            </div>
                            <div class="email-content">
                                <table class="table table-bordered datatable">
                                    <thead>
                                        <tr>
										    <th>S. No.</th>
											<th>Mobile Number</th>
											<th style="width:45%;">Message</th>
											<th>Date</th>
											<th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php if($sms_list) { $i=1;
										
										foreach($sms_list as $sms){?>
										
										   <tr>
										     <td><?php echo $i; ?></td>
											<td><?php echo $sms->mobile_no; ?></td>
                                            <td style="width:200px;max-width:200px;word-wrap: break-word;"><?php echo $sms->message; ?></td>
                                            <td class="mail-date"><?php

                                              $date = date("d F,Y h:i A",strtotime($sms->send_date));

                                               echo $date;

                                             ?></td>
											<td>
											   <!-- <a data-toggle="modal"  data-target="#deleteModal" onclick="remove_circle(<?php //echo $sms->id; ?>)" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a> -->
											    <button id="del-<?php echo $sms->id;?>" data-toggle="modal"  data-target="#deleteModal" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
											</td>
										</tr>	
										
									<?php $i++; } } else {?>
										
										<tr>
										  <td><?php echo 'No SMS list found.'; ?></td>
										</tr>
										
									<?php }?>
										
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
			
       </div>
	   
	   <div class="example-modal">
						<div class="modal fade" aria-hidden="true" id="deleteModal">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<h4 class="modal-title">Delete SMS</h4>
									</div>
									<div class="modal-body">
										<p>Are you sure want to delete this SMS?</p>
									</div>
									<div class="modal-footer">
										<button data-dismiss="modal" class="btn btn-default pull-left" type="button">No</button>
										<button type="button" class="btn btn-danger" id="delValue-" data-dismiss="modal">Yes</button>
										<!-- <?php //echo form_open(base_url().'email/delete_sms'); ?>
											<input name="delete_itemId" type="hidden" id="delete_itemId" value="">
											<input class="btn btn-primary" type="submit" id="" value="Yes">
										<?php //echo form_close() ?> -->
									</div>
								</div><!-- /.modal-content -->
							</div><!-- /.modal-dialog -->
						</div><!-- /.modal -->
					</div><!-- /.example-modal -->
				<!-- ./Delete Popup modal -->

						<script type="text/javascript">

					$("[id ^='del-']").click(function(){
						var requestID  = $(this).attr('id');
						var requestArr = requestID.split('-');
					$("[id ^='delValue-']").attr("id","delValue-"+requestArr[1]);
					});
					$("[id ^='delValue-']").click(function(){
						 var requestID  = $(this).attr('id');
						 var requestArr = requestID.split('-');
						 var base_url = "<?php echo base_url(); ?>";
						 var url=base_url+'email/delete_sms';
						$.ajax({
								method: "POST",
								url: url,
								data: {id:requestArr[1]},
								success: function(data) {
									window.location.reload();
								}
							});
					});

				</script>
				
				<script type="text/javascript">
					/*function remove_circle(id) 
					{
						$("#delete_itemId").val(id);
					}*/

				</script>
      
	