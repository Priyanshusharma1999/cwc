   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Handover Item</h6>
								<hr>
								
					<?php if($this->session->flashdata('flashError_item')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_item'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
						<?php } ?>

                      <form action="javascript:void(0);">

                      	<div class="col-sm-12">
							<div class="form-group">
								<label>Select Reciever<span class="required">*</span></label>
								<select required="required" class="form-control multiple_roles" id="ruser" >
								   <option selected="selected" value="">select Reciever</option>
								  <?php foreach($all_users as $uussr) { ?>
									<option value="<?php echo $uussr->user_id; ?>">
									  <?php echo $uussr->display_name; ?>
									</option>
								  <?php } ?>
								</select>
								<span class="error3"></span>
							</div>
                        </div>

						<div class="col-sm-12">
							<div class="form-group">
								<label>Handover Remarks<span class="required">*</span></label>
								<textarea class="form-control" id="remarks"  placeholder="Enter Handover Remarks"></textarea>
								<span class="error4"></span>
							</div>
                        </div>
                    </form>
                                
					    <form action="javascript:void(0);" style="padding-top:40px;clear:both;">
						
						  <div class="col-sm-7">
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
						   <div class="col-sm-5">
								<div class="form-group">
									<label>Enter Quantity<span class="required">*</span></label>
									<input class="form-control" id="qty"  type="number" min="1" placeholder="Enter Quantity">
									<span class="error2"></span>
								</div>
                            </div>
							
                            <div class="m-t-20" style="margin-bottom:20px;clear:both;padding:0 15px;">
                                <button class="btn btn-primary add-row">Add Item</button>
                            </div>
							
                         </form>
						
						
							<?php
					 	$attributes = array('class' => '', 'id' =>'add_request');
     					echo form_open_multipart('itonlinestationary/Handoveritems/handover/',$attributes);?>

     					<input type="hidden" name="remarks" id="remarksss">

     					<input type="hidden" name="user_id" id="uidd">
						
						  <table id="myTable" class="table table-stripped table-bordered table-responsive" >
								<thead>
									<tr>
										<th>S.No.</th>
										<th>Item</th>
										<th>Quantity</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
								
								</tbody>
                            </table>
								
					       <button type="submit"  name="submit" class="btn btn-primary">Handover</button>	
                         <a href="<?php echo base_url(); ?>itonlinestationary/Handoveritems/" class="btn btn-danger">Cancel</a>

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

		$('#ruser').change(function() {
		 var user = $('#ruser').val();
		  $("#uidd").val(user);
		});

		$('#remarks').change(function() {
		  var remarks = $('#remarks').val();
		  $("#remarksss").val(remarks);
		});


  /******************************************************/
		$('#item').change(function() {
		  $(".error1").hide();
		});

		$('#qty').keyup(function(event) {
				$(".error2").hide();
		});

		$('#ruser').change(function(event) {
				$(".error3").hide();
		});

		$('#remarks').keyup(function(event) {
				$(".error4").hide();
		});

/**********************************************************/		
		
		$("#add_request").hide();
		
        $(".add-row").click(function(){
			
		 /***************************************************************/	

		 if($("#ruser").val() == ''){
			  var msg = 'Please Select User.';
              $(".error3").html(msg);
              $(".error3").show();
              $('.error3').css('color','red');  
			   return false;
			}

			if($("#remarks").val() == ''){
			  var msg = 'Please Enter Remarks.';
              $(".error4").html(msg);
              $(".error4").show();
              $('.error4').css('color','red');  
			   return false;
			}
			
			
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

			
		

	/***************************************************************/
			
			$("#add_request").show();
			
            var item = $("#item").val();
            var itemname = $("#item>option:selected").text();
            var quantity = $("#qty").val();
            var markup = "<tr><td>"+ i +"</td><td>" + itemname + "<input  name='item[]' type='text' value="+item+" hidden></td><td>" + quantity + "<input  name='quantity[]' value="+quantity+" type='text' hidden></td><td><button type='button' class='btn btn-sm btn-danger delete-row' >Delete</button></td></tr>";
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