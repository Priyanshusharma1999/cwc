   
	 <div class="page-wrapper">
			<div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Physical Issue Form</h6>
								<hr>
                 
                    <?php
					     $uri = $this->uri->segment('4'); 
					 	$attributes = array('class' => '', 'id' =>'issueto');
     					echo form_open_multipart('onlinestationary/osradmin/issueto/'.$uri,$attributes);?>
						
                       <p class="col-sm-6">       						  
						<label>Req. No.</label><span><?php echo $req_detail->req_id; ?></span>	
                      </p>
                      <p class="col-sm-6">       					  
						<label>Req. Date</label>
						<span>
						   <?php 

                            $otpstatus = $this->Base_model->get_record_by_id('osr_requisition_master',array('req_id'=>$req_detail->req_id));

							   $date = date('d F, Y', strtotime($req_detail->req_date));
							   echo $date; 
							   
							?>
						</span>	
                      </p>
                      <p class="col-sm-6">					  
						<label>User</label><span><?php echo $user_detail->user_name; ?></span>
					  </p> 
					  <p class="col-sm-6">					  
						<label>Officer Name</label><span><?php echo $user_detail->user_name; ?></span>	
					  </p> 
					  <p class="col-sm-6">					  
						<label>Designation</label><span><?php echo $user_detail->designation; ?></span>	
					  </p> 	

					 <?php if($req_detail->is_miscallenous == '0'){?> 

					  <p class="col-sm-6">        
						  <label>Director</label><span><?php echo $req_detail->dir_no; ?></span>
						</p>
						<p class="col-sm-6">						
						 <label>Dupty Director</label><span><?php echo $req_detail->dydir_no; ?></span>	
						</p>
						<p class="col-sm-6">					   
						 <label>A.D./EAD</label><span><?php echo $req_detail->adead_no; ?></span>	
						<p>
						<p class="col-sm-6">					   
						 <label>Dman/JE Comp</label><span><?php echo $req_detail->dman_no; ?></span>
						</p>
						<p class="col-sm-6">         
						  <label>S.O.</label><span><?php echo $req_detail->so_no; ?></span>
						</p>
						<p class="col-sm-6">						
						 <label>Asstt.</label><span><?php echo $req_detail->asstt_no; ?></span>	
						</p>
						<p class="col-sm-6">					   
						 <label>UDC/LDC</label><span><?php echo $req_detail->udcldc_no; ?></span>	
						<p>
						<p class="col-sm-6">					   
						 <label>P.A./Steno.</label><span><?php echo $req_detail->pa_no; ?></span>
						</p>
						<p class="col-sm-6">					   
						 <label>Others</label><span><?php echo $req_detail->others; ?></span>
						</p>

					<?php } ?>					  
						
			  <table class="display datatable table table-stripped table-bordered table-responsive" >
					<thead>
						<tr>
							<th>S.No.</th>
							<th>Item</th>
							<th>Available Stock</th>
							<th>Requisition Quantity</th>
							<th>Approved Qty.</th>
							<th>Issued Qty.</th>
							<th>Remarks</th>
							<?php if($req_detail->is_miscallenous == '1'){?>	
							<th>Employee Name</th>
							<th>Employee Designation</th>
						   <?php } ?>
						</tr>
					</thead>
					<tbody>
				<?php
					if($all_items) {

					$i=1;

					foreach($all_items as $item) { ?>
						
				   <tr>

					 <td><?php echo $i; ?></td>
							
					<td>
						<?php 
						 $item_name = $this->Base_model->get_record_by_id('osr_item_master', array('item_id' => $item->item_id));
						  echo $item_name->item_name; 
					     ?>
		                <input type='text' name='item[]' value="<?php echo $item->item_id; ?>" hidden>		 
			        </td>

			        <td>
						<?php echo $item_name->quantity_stock; ?>	 
			        </td>
							
					<td>
					    <?php echo $item->req_qty; ?>
		               <input type='text' name='quantity[]' value="<?php echo $item->req_qty; ?>" hidden>
					</td>
							
				   <td>
				       <?php echo $item->approved_qty; ?>
                       <input  type="text" name="approveqty[]"  value="<?php echo $item->approved_qty; ?>" hidden id="appstock">
				   
				   </td>

				   <td>
				      <input class="form-control issueqty" type="number" min="0" name="issueqty[]" placeholder="Issued Qty">
					   <span class="text-danger"></span>
				   </td>
							
					<td>
					  <?php echo $item->req_remark; ?>
	                  <input type='text' name='remarks[]' value="<?php echo $item->req_remark; ?>" hidden>
					</td>

					 <?php if($req_detail->is_miscallenous == '1'){?>	
								   	
						<td><?php echo $item->employee_name; ?>
							<input type='text' name='empname[]' value="<?php echo $item->employee_name; ?>" hidden>
						</td>

						<td><?php echo $item->employee_desg; ?>
							<input type='text' name='empdesg[]' value="<?php echo $item->employee_desg; ?>" hidden>
						</td>

				   <?php } ?>
			
				</tr>
						
				<?php $i++; } } ?>	
					
					</tbody>
                </table>

					 	<div id="form-issueto">

					 		<div class="alert alert-success"></div>

							<div class="form-group">
								<label>Issued To</label>
					            <input class="form-control" type="text" name="issueto" value="<?php echo $user_detail->user_name; ?>" placeholder="Enter Name">
							</div>

							<div class="form-group">
								<label>Issued Remark</label>
					            <textarea class="form-control"  name="issueremarks" placeholder="Enter Remarks"></textarea>
							</div>
                            <button type="submit" name="submit" class="btn btn-primary">
							  Issue
							</button>

							<button class="btn btn-danger">Cancel</button>	

                         </div>
				   
								
                   <?php echo form_close();?>	

                   <?php if($otpstatus->otp_status == '0'){?>    
                
	                    <form id="otpform">

	                    	<div class="alert alert-danger"></div>

	                       <div class="form-group">
									<label>OTP (Please verify otp for issue)</label>
						            <input class="form-control" type="number" name="otp"  id="enteredotp" placeholder="Enter Otp">
						            <span class="otp-error"></span>
							</div>

	                          <button type="button" class="btn btn-primary verifyotp">
								  Verify
							</button>	

						    <button class="btn btn-danger">Cancel</button>

						</form>	

					<?php  } ?>	
					       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
   
   	
<style>
	p label{width:20%;}
	span.text-danger{
		    display: block;
		    font-size: 11px;
		    font-weight: 500;
	}
	.otp-error{

		display: block;
	    font-size: 11px;
	    font-weight: 500;
	    color:#f00;

	}
</style>


<script>


    $('#enteredotp').change(function() {
		  $('.otp-error').hide(); 
		});

	$('.issueqty').keyup(function(){

			   	  var msg = '';

			   	  $('.text-danger').html(msg);
                   
                   var issuedqnty = $(this).val();

                   issuedqnty = parseInt(issuedqnty);

                   var qnty1 = $(this).closest('tr').find('#appstock').val();

                   qnty1 = parseInt(qnty1);

                    if(issuedqnty>qnty1){
                      
                      msg = 'Issued quantity can not be greater than Approved qty.';

                      $('.text-danger').html(msg);

                      return false;

                    }

	    });



	$('.alert').hide();

	var status = '<?php echo $otpstatus->otp_status; ?>';

	if(status == '1'){
          
          $('#form-issueto').show();

	} else {

		$('#form-issueto').hide();

	}
	

	$('.verifyotp').click(function(){
       
       var otp = $('#enteredotp').val();
       var req_id = '<?php echo $req_detail->req_id; ?>';
       var msg = '';

        if(otp == ''){

	        msg = 'Please Enter OTP';
	        $('.otp-error').html(msg);
	        return false;

        } 

        if($('.issueqty').val() == ''){

        	msg = 'Please Enter Issued Quantity';
	        $('.text-danger').html(msg);
	        return false;

        }

        var base_url = "<?php echo base_url(); ?>";
        var link = base_url+'onlinestationary/Osradmin/verifyotp';

        $.ajax({
                    method: "POST",
                    url: link,
                    data: {'req_id':req_id,'otp':otp},
                    success: function(result) {

                    	var obj = JSON.parse(result);

                    	if(obj.status == 'Success'){

                    	   msg = 'Otp has verified successfully.';
                    	   $('#otpform').hide();
                           $('#form-issueto').show();
                    	   $('.alert').show();
                           $('.alert-success').html(msg);

                    	} else {
                           
                           msg = 'Failed to verify otp.';
                           $('.alert').show();
                           $('.alert-danger').html(msg);
                    	}

                    }

           });

	});

</script>