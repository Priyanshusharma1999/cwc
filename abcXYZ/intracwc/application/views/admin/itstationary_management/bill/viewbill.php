 
	 <div class="page-wrapper">
			<div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                        <div class="card-block">
                           <h6 class="card-title text-bold">General Store: Challan/Bill Entry</h6>
						   <hr>
				
							
					 <?php if($bill_detail->bill_type == 'T&P'){?> 

                       <div class="col-sm-6">
						   <div class="form-group">
						     <label>Date<span class="required">*</span></label>
							 <input class="form-control" name="billdate" value="<?php echo $bill_detail->bill_date; ?>" placeholder="Bill Date" type="text" readonly>
							 
						   </div>
						 </div>
						 
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Invoice R.R. No.<span class="required">*</span></label>
							  <input class="form-control" name="billno" value="<?php echo $bill_detail->bill_no; ?>" placeholder="Invoice R.R. No." type="text" readonly>
							  
						   </div>
						 </div>
						   
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Source of Reciept<span class="required">*</span></label>
							  <input class="form-control" name="sourcereciept" value="<?php echo $bill_detail->source_reciept; ?>" placeholder="Source of Reciept" type="text" readonly>
							  
						   </div>
						 </div>

						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Order No<span class="required">*</span></label>
							  <input class="form-control" name="orderno" value="<?php echo $bill_detail->order_no; ?>" placeholder="Order No" type="text" readonly>
							  
						   </div>
						 </div>


						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Order Date <span class="required">*</span></label>
							  <input class="form-control" name="orderdate" value="<?php echo $bill_detail->bill_date; ?>" placeholder="dd-mm-yy" type="text" readonly>
							  
						   </div>
						 </div>

						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Contact No.<span class="required">*</span></label>
							  <input class="form-control" name="contactno" value="<?php echo $bill_detail->vendor_contact_no; ?>" placeholder="Enter Contact No." type="text" maxlength="10" readonly>
							 
						   </div>
						 </div>
						 
						 
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Address<span class="required">*</span></label>
						<textarea class="form-control" name="remark" placeholder="Address" readonly><?php echo $bill_detail->vendor_address; ?></textarea>
							
						   </div>
						 </div>
						 

                         <h4 style="clear:both;">Items Purchased</h4>
						 <hr>
						
						  <table class="table table-stripped table-bordered">
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Item</th>
										<th>Quantity</th>
										<th>Unit</th>
										<th>Rate</th>
										<th>Incidental Charges</th>
										<th>Total Amount</th>
									</tr>
								</thead>
								<tbody>
								   <?php
								if($all_bill) {
									$i=1;
									foreach($all_bill as $bill) { ?>
									  <tr>
										 <td><?php echo $i; ?></td>
										 
										 <td>
								   <?php 
								
							       $item_name = $this->Base_model->get_record_by_id('osr_item_master', array('item_id' => $bill->item_id));
								    echo $item_name->item_name; 
								  ?>
								
										 </td>
										 <td><?php echo $bill->quantity; ?></td>
										 <td><?php echo $bill->unit; ?></td>
										 <td><?php echo $bill->rate; ?></td>
										 <td><?php echo $bill->incidental_charges; ?></td>
										 <td><?php echo $bill->amount; ?></td>
									  </tr>
							  <?php $i++; } } else { ?>
									
									<tr><td>No items found</td></tr>
									
								<?php } ?>	
								</tbody>
                            </table>

				<?php } else {?>
							
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Challan/Bill Date<span class="required">*</span></label>
							 <input class="form-control" name="billdate" value="<?php echo $bill_detail->bill_date; ?>" placeholder="Bill Date" type="text" readonly>
						   </div>
						 </div>
						 
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Challan/Bill No<span class="required">*</span></label>
					      <input class="form-control" name="billno" value="<?php echo $bill_detail->bill_no; ?>" placeholder="Enter Challan/Bill No." type="text" readonly>
						   </div>
						 </div>
						 
						 <h4>Purchased From</h4>
						 <hr>
						   
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Name<span class="required">*</span></label>
							  <input class="form-control" name="shopname" value="<?php echo $bill_detail->vendor_name; ?>" placeholder="Enter Name" type="text" readonly>
						   </div>
						 </div>
						 
						 
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Address<span class="required"></span></label>
							  <input class="form-control" name="address" value="<?php echo $bill_detail->vendor_address; ?>" placeholder="Enter Address" type="text" readonly>
						   </div>
						 </div>
						 
						  <div class="col-sm-6">
						   <div class="form-group">
						     <label>Contact No.<span class="required"></span></label>
							  <input class="form-control" name="contactno" value="<?php echo $bill_detail->vendor_contact_no; ?>" placeholder="Enter Contact No." type="text" readonly>
						   </div>
						 </div>
						 
						<div class="col-sm-6">
						   <div class="form-group">
						     <label>Email<span class="required"></span></label>
							  <input class="form-control" name="email" value="<?php echo $bill_detail->vendor_email; ?>" placeholder="Enter Email" type="text" readonly>
						   </div>
						</div>
						 
						 
						<div class="col-sm-6">
						   <div class="form-group">
						     <label>Total Amount<span class="required">*</span></label>
							<input class="form-control" value="<?php echo $bill_detail->grand_total; ?>" placeholder="Enter Total Amount" name="totalamount" type="text" readonly>
						   </div>
						 </div>
						 
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Remark<span class="required"></span></label>
							  <textarea class="form-control" name="remark" readonly><?php echo $bill_detail->remark; ?></textarea>
						   </div>
						 </div>
						
						 <h4 style="clear:both;">Items Purchased</h4>
						 <hr>
						
						  <table class="table table-stripped table-bordered">
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Item Name</th>
										<th>Quantity</th>
										<th>Amount</th>
									</tr>
								</thead>
								<tbody>
								   <?php
								if($all_bill) {
									$i=1;
									foreach($all_bill as $bill) { ?>
									  <tr>
										 <td><?php echo $i; ?></td>
										 
										 <td>
								   <?php 
								
							       $item_name = $this->Base_model->get_record_by_id('osr_item_master', array('item_id' => $bill->item_id));
								    echo $item_name->item_name; 
								  ?>
								
										 </td>
										 <td><?php echo $bill->quantity; ?></td>
										 <td><?php echo $bill->amount; ?></td>
									  </tr>
							  <?php $i++; } } else { ?>
									
									<tr><td>No items found</td></tr>
									
								<?php } ?>	
								</tbody>
                            </table>
					
						<?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
		
		
		