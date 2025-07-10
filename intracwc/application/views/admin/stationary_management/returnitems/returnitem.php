   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Return Items</h6>
								<hr>
								
					          <form action="javascript:void(0);">
						
						  <div class="col-sm-4" style="padding-left:0;">
								<div class="form-group">
									<label>Select Item<span class="required">*</span></label>
									<select required="required" class="form-control multiple_roles" id="item" >
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
									<input class="form-control" id="qty"  type="number" min="1" placeholder="Enter Quantity">
									<span class="error2"></span>
								</div>
                            </div>
							
							<div class="col-sm-4" style="padding-right:0;">
								<div class="form-group">
									<label>Remarks<span class="required">*</span></label>
									<input class="form-control" id="remarks"  type="text" placeholder="Enter Remarks">
									<span class="error3"></span>
								</div>
                            </div>
							
                            <div class="m-t-20" style="margin-bottom:20px;clear:both;">
                                <button class="btn btn-primary add-row">Add Item</button>
                            </div>
							
                         </form>
						
						
							<?php
					 	$attributes = array('class' => '', 'id' =>'add_request');
     					echo form_open_multipart('onlinestationary/Returnitems/returnitem/',$attributes);?>
						
						  <table id="myTable" class="table table-stripped table-bordered table-responsive" >
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Item</th>
										<th>Quantity</th>
										<th>Remarks</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								
								</tbody>
                            </table>
								
					       <button type="submit"  name="submit" class="btn btn-primary">Return</button>	
                           <a href="<?php echo base_url(); ?>onlinestationary/Returnitems/" class="btn btn-danger">Cancel</a>

						 <?php echo form_close(); ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

       

       <style>
		  p label{width:20%;}
		</style>
		
<script type="text/javascript">
    $(document).ready(function(){
		var i=1;


  /******************************************************/
		$('#item').change(function() {
		  $(".error1").hide();
		});

		$('#qty').keyup(function(event) {
				$(".error2").hide();
		});

		$('#remarks').keyup(function(event) {
				$(".error3").hide();
		});

/**********************************************************/		
		
		$("#add_request").hide();
		
        $(".add-row").click(function(){
			
		 /***************************************************************/	
			
			if($("#item").val() == ''){
			var msg = 'Please select Item.';
              $(".error1").html(msg);
              $(".error1").show();
              $('.error1').css('color','red');  
			   return false;
			}
			
			if($("#qty").val() == ''){
			  var msg = 'Please Enter Quantity.';
              $(".error2").html(msg);
              $(".error2").show();
              $('.error2').css('color','red');  
			   return false;
			}
			
			if($("#remarks").val() == ''){
			var msg = 'Please Enter Remarks.';
              $(".error3").html(msg);
              $(".error3").show();
              $('.error3').css('color','red');  
			   return false;
			}

	/***************************************************************/
			
			$("#add_request").show();
			
            var item = $("#item").val();
            var itemname = $("#item>option:selected").text();
            var quantity = $("#qty").val();
			var remarks = $("#remarks").val();
            var markup = "<tr><td>"+ i +"</td><td>" + itemname + "<input  name='item[]' type='text' value="+item+" hidden></td><td>" + quantity + "<input  name='quantity[]' value="+quantity+" type='text' hidden></td><td>" + remarks + "<input  name='remarks[]' value='"+remarks+"'  type='text' hidden></td><td><button type='button' class='btn btn-sm btn-danger delete-row' >Delete</button></td></tr>";
            $("table tbody").append(markup);
			i++;

			 $(".delete-row").click(function(){
				
						$(this).parents("tr").remove();
						
						var rows = $('#myTable tr').length;
						
						if(rows == 1){
							
							$("#add_request").hide();
							
						} else {
							
							$("#add_request").show();
							
						}
				
           });
		
        });
        
    });    
</script>