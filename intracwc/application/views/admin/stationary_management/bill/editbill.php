 
	 <div class="page-wrapper">
			<div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" style="width:100%;float:left;">
                        <div class="card-block">
                           <h6 class="card-title text-bold">General Store: Challan/Bill Entry</h6>
						   <hr>
						 
                 <?php if($this->session->flashdata('flashError_billedit')) { ?>
					<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_billedit'); ?> 
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> 
					</div> 
				<?php } ?>


			 <div class="col-sm-6">
				<div class="form-group">

				     <label>Bill/Challan Type</label>
					 <select required="required" class="form-control" style="margin-bottom:40px;" disabled>
					   <option selected="selected" value="">select Bill/Challan Type</option>
					   <option value="T&P" <?php if($bill_detail->bill_type == 'T&P'){ echo 'selected'; } ?>>T&P</option>
					   <option value="MAS" <?php if($bill_detail->bill_type == 'MAS'){ echo 'selected'; } ?>>MAS</option>
					</select>
                  
                   </div>
			 </div>


              <div class="col-sm-6">
				<div class="form-group">
					<label>New/Old Challan<span class="required">*</span></label>
					<select required="required" class="form-control" id="newold" style="margin-bottom:20px;" disabled>
					   <option selected="selected" value="">select New/Old</option>
					   <option value="New" <?php if(!empty($bill_detail->bill_no)){ echo 'selected'; } ?>>New</option>
					   <option value="Old" <?php if(empty($bill_detail->bill_no)){ echo 'selected'; } ?> >Old</option>
					</select>
			   </div>
			 </div>

	 <?php if(($bill_detail->bill_type == 'T&P' || $bill_detail->bill_type == 'MAS') && (empty($bill_detail->bill_no))){?> 		 

			<?php
				$attributes = array('class' => '', 'id' =>'entry_oldbill');
     			echo form_open_multipart('onlinestationary/bill/addoldbill/',$attributes);?>

     					<input type="hidden" class="bill_type" name="billtype">
						
						 <h4 style="clear:both;">Items Purchased</h4>
						 <hr>
						 
						  <div class="col-sm-4" style="padding-left:0;">
								<div class="form-group">
									<label>Select Item<span class="required">*</span></label>
									<select required="required" class="form-control multiple_roles" id="item2" >
									    <option selected="selected" value="">select item</option>
									  <?php foreach($all_items as $item) { ?>
										<option value="<?php echo $item->item_id; ?>">
										  <?php echo $item->item_name; ?>
										</option>
									  <?php } ?>
									</select>
									<span class="error1"></span>
								</div>
                           </div>

						   <div class="col-sm-4">
								<div class="form-group">
									<label>Enter Quantity<span class="required">*</span></label>
									<input class="form-control" id="quantity2" type="number" placeholder="Enter Quantity">
									<span class="error2"></span>
								</div>
                            </div>
							
                       <div class="m-t-20" style="margin-bottom:20px;clear:both;">
                            <button type="button" class="btn btn-primary add-rowold">Add Item</button>
                       </div>
                       
				       <div id="oldbillitems">
						  <table class="table table-stripped table-bordered" id="myTable11">
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Item</th>
										<th>Quantity</th>
										<th>Action</th>
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

								  <input  name='item[]' type='text' value="<?php echo $bill->item_id; ?>" hidden>
								
										 </td>
										 <td>
										 <?php echo $bill->quantity; ?>
										 	
										 <input  name='quantity[]' type='text' value="<?php echo $bill->quantity; ?>" hidden>	
										 </td>

										 <td><button type='button' class='btn btn-sm btn-danger delete-row' >Delete</button></td>

									  </tr>
							  <?php $i++; } } else { ?>
									
									<tr><td>No items found</td></tr>
									
								<?php } ?>	
								</tbody>
                            </table>
								
					       <button type="submit" name="submit" class="btn btn-primary">Save</button>
						   
                           <a href="<?php echo base_url(); ?>onlinestationary/bill/" class="btn btn-danger">Cancel</a>
					   </div>
					
			<?php echo form_close();?>		

		<?php } else if($bill_detail->bill_type == 'T&P'){?> 

				     	<?php

					 	$attributes = array('class' => '', 'id' =>'entry_bill_tnp');
     					echo form_open_multipart('onlinestationary/bill/editbill/'.$uri,$attributes); ?>

     					<input type="hidden" class="bill_type" name="billtype" value="<?php echo $bill_detail->bill_type; ?>">
							
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Date<span class="required">*</span></label>
							 <input class="form-control" name="billdate" value="<?php echo $bill_detail->bill_date; ?>" placeholder="Bill Date" type="text" >
						   </div>
						 </div>
						 
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Invoice R.R. No.<span class="required">*</span></label>
							  <input class="form-control" name="billno" value="<?php echo $bill_detail->bill_no; ?>" placeholder="Invoice R.R. No." type="text" >
						   </div>
						 </div>
						   
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Source of Reciept<span class="required">*</span></label>
							  <input class="form-control" name="sourcereciept" value="<?php echo $bill_detail->source_reciept; ?>" placeholder="Source of Reciept" type="text" >
							  
						   </div>
						 </div>

						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Order No<span class="required">*</span></label>
							  <input class="form-control" name="orderno" value="<?php echo $bill_detail->order_no; ?>" placeholder="Order No" type="text" >
							  
						   </div>
						 </div>


						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Order Date <span class="required">*</span></label>
							  <input class="form-control" name="orderdate" value="<?php echo $bill_detail->bill_date; ?>" placeholder="dd-mm-yy" type="text" >
							  
						   </div>
						 </div>

						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Contact No.<span class="required">*</span></label>
							  <input class="form-control" name="contactno" value="<?php echo $bill_detail->vendor_contact_no; ?>" placeholder="Enter Contact No." type="text" maxlength="10" >
							 
						   </div>
						 </div>
						 
						 
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Address<span class="required">*</span></label>
						     <textarea class="form-control" name="remark" placeholder="Address" ><?php echo $bill_detail->vendor_address; ?></textarea>
							
						   </div>
						 </div>
						 

						  <h4 style="clear:both;">Items Purchased</h4>
						 <hr>
						 
						  <div class="col-sm-3" >
								<div class="form-group">
									<label>Select Item<span class="required">*</span></label>
									<select  class="form-control multiple_roles" id="item1" >
									    <option selected="selected" value="">select item</option>
									  <?php foreach($all_items as $item) { ?>
										<option value="<?php echo $item->item_id; ?>">
										  <?php echo $item->item_name; ?>
										</option>
									  <?php } ?>
									</select>
									<span class="error1"></span>
								</div>
                           </div>

						   <div class="col-sm-3">
								<div class="form-group">
									<label>Enter Quantity<span class="required">*</span></label>
									<input class="form-control" id="quantity1" type="number" placeholder="Enter Quantity">
									<span class="error2"></span>
								</div>
                            </div>

                            <div class="col-sm-3">
								<div class="form-group">
									<label>Unit<span class="required">*</span></label>
									<input class="form-control" id="unit1" type="text" placeholder="Enter Unit">
									<span class="error3"></span>
								</div>
                            </div>

                            <div class="col-sm-3">
								<div class="form-group">
									<label>Rate<span class="required">*</span></label>
									<input class="form-control" id="rate1" type="number" placeholder="Enter Rate">
									<span class="error4"></span>
								</div>
                            </div>
							
							<div class="col-sm-3">
								<div class="form-group">
									<label>Amount<span class="required">*</span></label>
									<input class="form-control" id="amount1" type="number" placeholder="Enter Amount">
									<span class="error5"></span>
								</div>
                            </div>

                            <div class="col-sm-3">
								<div class="form-group">
									<label>Incidental Charges<span class="required">*</span></label>
									<input class="form-control" id="incharges" type="number" placeholder="Incidental Charges">
									<span class="error6"></span>
								</div>
                            </div>

                            <div class="col-sm-3">
								<div class="form-group">
									<label>Amount Including Incidental Charges<span class="required">*</span></label>
									<input class="form-control" id="tamount" type="number" placeholder="Total Amount">
									<span class="error7"></span>
								</div>
                            </div>

                         <div class="m-t-20" style="margin-bottom:20px;clear:both;">
                            <button type="button" class="btn btn-primary add-row1">Add Item</button>
                       </div>
						
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
										<th>Action</th>
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

								  <input  name='item[]' type='text' value="<?php echo $bill->item_id; ?>" hidden>
								
										 </td>
										 <td>
										 <?php echo $bill->quantity; ?>
										 	
										 <input  name='quantity[]' type='text' value="<?php echo $bill->quantity; ?>" hidden>	
										 </td>
										 <td><?php echo $bill->unit; ?>
										 	
                                        <input  name='unit[]' type='text' value="<?php echo $bill->unit; ?>" hidden>	

										 </td>
										 <td><?php echo $bill->rate; ?>
										 	<input  name='rate[]' type='text' value="<?php echo $bill->rate; ?>" hidden>	
										 </td>

										 <td><?php echo $bill->incidental_charges; ?>
										 	<input  name='charges[]' type='text' value="<?php echo $bill->incidental_charges; ?>" hidden>	
										 </td>

										 <td><?php echo $bill->amount; ?>
										 	
										 	<input  name='amount[]' type='text' value="<?php echo $bill->amount; ?>" hidden>	
										 </td>

										 <td><button type='button' class='btn btn-sm btn-danger delete-row' >Delete</button></td>

									  </tr>
							  <?php $i++; } } else { ?>
									
									<tr><td>No items found</td></tr>
									
								<?php } ?>	
								</tbody>
                            </table>
								
					       <button type="submit" name="submit" class="btn btn-primary">Save</button>
						   
                           <a href="<?php echo base_url(); ?>onlinestationary/bill/" class="btn btn-danger">Cancel</a>
					   </div>
					
						<?php echo form_close();?>	

				     <?php } else {?>

				       <?php
					    $uri = $this->uri->segment('4'); 
					 	$attributes = array('class' => '', 'id' =>'entry_bill');
     					echo form_open_multipart('onlinestationary/bill/editbill/'.$uri,$attributes);?> 

     					<input type="hidden" class="bill_type" name="billtype" value="<?php echo $bill_detail->bill_type; ?>">	
                                
                          <div class="col-sm-6">
						   <div class="form-group">
						     <label>Challan/Bill Date<span class="required">*</span></label>
							 <input class="form-control" name="billdate" value="<?php echo $bill_detail->bill_date; ?>" placeholder="Bill Date" type="text">
							 <span class = "text-danger"><?php echo form_error('billdate');?>
						   </div>
						 </div>
						 
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Challan/Bill No<span class="required">*</span></label>
					      <input class="form-control" name="billno" value="<?php echo $bill_detail->bill_no; ?>" placeholder="Enter Challan/Bill No." type="text">
							  <span class = "text-danger"><?php echo form_error('billno');?>
						   </div>
						 </div>
						 
						 <h4>Purchased From</h4>
						 <hr>
						   
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Name<span class="required">*</span></label>
							  <input class="form-control" name="shopname" value="<?php echo $bill_detail->vendor_name; ?>" placeholder="Enter Name" type="text">
							  <span class = "text-danger"><?php echo form_error('shopname');?>
						   </div>
						 </div>
						 
						 
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Address<span class="required"></span></label>
							  <input class="form-control" name="address" value="<?php echo $bill_detail->vendor_address; ?>" placeholder="Enter Address" type="text">
							  <span class = "text-danger"><?php echo form_error('address');?>
						   </div>
						 </div>
						 
						  <div class="col-sm-6">
						   <div class="form-group">
						     <label>Contact No.<span class="required"></span></label>
							  <input class="form-control" name="contactno" value="<?php echo $bill_detail->vendor_contact_no; ?>" placeholder="Enter Contact No." type="text">
							  <span class = "text-danger"><?php echo form_error('contactno');?>
						   </div>
						 </div>
						 
						<div class="col-sm-6">
						   <div class="form-group">
						     <label>Email<span class="required"></span></label>
							  <input class="form-control" name="email" value="<?php echo $bill_detail->vendor_email; ?>" placeholder="Enter Email" type="text">
							  <span class = "text-danger"><?php echo form_error('email');?>
						   </div>
						</div>
						 
						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Remark<span class="required"></span></label>
							  <textarea class="form-control" name="remark"><?php echo $bill_detail->	remark; ?></textarea>
							  <span class = "text-danger"><?php echo form_error('remark');?>
						   </div>
						 </div>

						 <div class="col-sm-6">
						   <div class="form-group">
						     <label>Bill Copy<span class="required"></span></label>
							 <input class="upload" name = "bill_copy" type="file">
						   </div>
						 </div>
						
						
						 <h4 style="clear:both;">Items Purchased</h4>
						 <hr>
						 
						  <div class="col-sm-4" style="padding-left:0;">
								<div class="form-group">
									<label>Select Item<span class="required">*</span></label>
									<select  class="form-control multiple_roles" id="item" >
									    <option selected="selected" value="">select item</option>
									  <?php foreach($all_items as $item) { ?>
										<option value="<?php echo $item->item_id; ?>">
										  <?php echo $item->item_name; ?>
										</option>
									  <?php } ?>
									</select>
									<span class="error1"></span>
								</div>
                            </div>
						   <div class="col-sm-4">
								<div class="form-group">
									<label>Enter Quantity<span class="required">*</span></label>
									<input class="form-control" id="quantity" type="number" placeholder="Enter Quantity">
									<span class="error2"></span>
								</div>
                            </div>
							
							<div class="col-sm-4" style="padding-right:0;">
								<div class="form-group">
									<label>Total Amount<span class="required">*</span></label>
									<input class="form-control" id="amount" type="number" placeholder="Enter Amount">
									<span class="error3"></span>
								</div>
                            </div>
							
                       <div class="m-t-20" style="margin-bottom:20px;clear:both;">
                            <button type="button" class="btn btn-primary add-row">Add Item</button>
                       </div>
					   
					 
				       <div id="billitems">
						  <table class="table table-stripped table-bordered" id="editmyTable">
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Item</th>
										<th>Quantity</th>
										<th>Amount</th>
										<th>Action</th>
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
							<input  name='item[]' type='text' value="<?php echo $bill->item_id; ?>" hidden>
										 </td>
										 <td><?php echo $bill->quantity; ?>
						<input  name='quantity[]' type='text' value="<?php echo $bill->quantity; ?>" hidden>		 
										</td>
									<td><?php echo $bill->amount; ?>
					<input  name='amount[]' type='text' value="<?php echo $bill->amount; ?>" hidden>		 
										 </td>
										 <td><button type='button' class='btn btn-sm btn-danger delete-row' >Delete</button></td>
									  </tr>
							    <?php $i++; } } else { ?>
									
									<tr><td colspan="9">No items found</td></tr>
									
								<?php } ?>	
								</tbody>
                            </table>
								
					       <button type="submit" name="submit" class="btn btn-primary">Update</button>
						   
                          <a href="<?php echo base_url(); ?>onlinestationary/bill/" class="btn btn-danger">Cancel</a>
					   </div>
					
						<?php echo form_close();?>	

				     <?php } ?>
							
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
		

<style>
	#entry_oldbill{
		clear:both;
	}

	#entry_bill_tnp{
		clear:both;
	}

	#entry_bill{
		clear:both;
	}
</style>		
		
		
<script type="text/javascript">
    $(document).ready(function(){
		 
  /******************************************************/
		$('#item').change(function() {
		    $(".error1").hide();
		});

		$('#quantity').keyup(function(event) {
			$(".error2").hide();
		});

		$('#amount').keyup(function(event) {
			$(".error3").hide();
		});

/**********************************************************/	
		

        $(".add-row").click(function(){
			if($("#item").val() == ''){
			  var msg = 'Please select Item.';
              $(".error1").html(msg);
              $(".error1").show();
              $('.error1').css('color','red');  
			   return false;
			} 
			
			if($("#quantity").val() == ''){
			  var msg = 'Please Enter Quantity.';
              $(".error2").html(msg);
              $(".error2").show();
              $('.error2').css('color','red');  
			   return false;
			} 
			
			if($("#amount").val() == ''){
			  var msg = 'Please Enter Amount.';
              $(".error3").html(msg);
              $(".error3").show();
              $('.error3').css('color','red');  
			  return false;
			} 
			
			$("#billitems").show();
			
            var item = $("#item").val();
            var itemname = $("#item>option:selected").text();
            var quantity = $("#quantity").val();
			var amount = $("#amount").val();
            var markup = "<tr><td>"+ i +"</td><td>" + itemname + "<input  name='item[]' type='text' value="+item+" hidden></td><td>" + quantity + "<input  name='quantity[]' value="+quantity+" type='text' hidden></td><td>" + amount + "<input  name='amount[]' value="+amount+"  type='text' hidden></td><td><button type='button' class='btn btn-sm btn-danger delete-row' >Delete</button></td></tr>";
            $("table tbody").append(markup);
			i++;
			
			$(".delete-row").click(function(){
					$(this).parents("tr").remove();
					var rows = $('#myTable tr').length;
					if(rows == 1){
						$("#billitems").hide();
					} else {
						$("#billitems").show();
					}
              });
        });


        $(".add-row1").click(function(){
			
			if($("#item1").val() == ''){
			  var msg = 'Please select Item.';
              $(".error1").html(msg);
              $(".error1").show();
              $('.error1').css('color','red');  
			  return false;
			} 
			
			if($("#quantity1").val() == ''){
			  var msg = 'Please Enter Quantity.';
              $(".error2").html(msg);
              $(".error2").show();
              $('.error2').css('color','red');  
			  return false;
			} 
			
			if($("#amount1").val() == ''){
			  var msg = 'Please Enter amount.';
              $(".error3").html(msg);
              $(".error3").show();
              $('.error3').css('color','red');  
			  return false;
			} 
			
			$("#billitems1").show();
			
            var item = $("#item1").val();
            var itemname = $("#item1>option:selected").text();
            var quantity = $("#quantity1").val();
			var amount = $("#tamount").val();
			var rate = $("#rate1").val();
			var unit = $("#unit1").val();
			var charges = $("#incharges").val();
            var markup = "<tr><td>"+ i +"</td><td>" + itemname + "<input  name='item[]' type='text' value="+item+" hidden></td><td>" + quantity + "<input  name='quantity[]' value="+quantity+" type='text' hidden></td><td>" + unit + "<input  name='unit[]' value="+unit+"  type='text' hidden></td><td>" + rate + "<input  name='rate[]' value="+rate+"  type='text' hidden></td><td>" + charges + "<input  name='charges[]' value="+charges+"  type='text' hidden></td><td>" + amount + "<input  name='amount[]' value="+amount+"  type='text' hidden></td><td><button type='button' class='btn btn-sm btn-danger delete-row1' >Delete</button></td></tr>";
            $("table tbody").append(markup);
			i++;
			
			$(".delete-row1").click(function(){
					$(this).parents("tr").remove();
					var rows = $('#myTable1 tr').length;
					if(rows == 1){
						$("#billitems1").hide();
					} else {
						$("#billitems1").show();
			       }
             });
        });



         $(".add-rowold").click(function(){
			if($("#item2").val() == ''){
			  var msg = 'Please select Item.';
              $(".error1").html(msg);
              $(".error1").show();
              $('.error1').css('color','red');  
			   return false;
			} 
			
			if($("#quantity2").val() == ''){
			  var msg = 'Please Enter Quantity.';
              $(".error2").html(msg);
              $(".error2").show();
              $('.error2').css('color','red');  
			   return false;
			} 
			
			$("#oldbillitems").show();
			
            var item = $("#item2").val();
            var itemname = $("#item2>option:selected").text();
            var quantity = $("#quantity2").val();
            var markup = "<tr><td>"+ i +"</td><td>" + itemname + "<input  name='item[]' type='text' value="+item+" hidden></td><td>" + quantity + "<input  name='quantity[]' value="+quantity+" type='text' hidden></td><td><button type='button' class='btn btn-sm btn-danger delete-row' >Delete</button></td></tr>";
            $("table tbody").append(markup);
			i++;
			
			$(".delete-row").click(function(){
					$(this).parents("tr").remove();
					var rows = $('#myTable11 tr').length;
					if(rows == 1){
						$("#oldbillitems").hide();
					} else {
						$("#oldbillitems").show();
					}
              });
        });
        
    });    
</script>
     
     