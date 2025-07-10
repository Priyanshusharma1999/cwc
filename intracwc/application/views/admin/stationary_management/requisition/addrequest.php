   
	 <div class="page-wrapper">
			<div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" style="float:left;width:100%;">
                            <div class="card-block">
                                <h6 class="card-title text-bold">General Store Requisition Form</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashError_request')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_request'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
						<?php } ?>		
					
						<p>        
						  <label>Officer Name</label><span><?php  echo $user_detail->user_name; ?></span>
						</p>
						<p>						
						 <label>Designation</label><span><?php  echo $user_detail->designation; ?></span>	
						</p>

						<p>	

						  <?php 
     					      $udet = $this->Base_model->get_record_by_id('users',array('user_id'=>$user_detail->user_id));
     					      $empdetail = $this->Base_model->get_record_by_id('employee',array('employee_id'=>$udet->employee_id));
     					      $office = $this->Base_model->get_record_by_id('employee_office',array('office_id'=>$empdetail->post));
     					  ?>

     					   <label>Directorate/Section</label><span><?php  echo $office->office_name; ?></span>	

						</p>

						<p>					   
						 <label>Wing</label><span><?php  echo $wing->wing_name; ?></span>	
						<p>
						<p>					   
						 <label>Section</label><span><?php  echo $section->section_name; ?></span>
						</p>	
					
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
									<label>Remarks<span class="required"></span></label>
									<input class="form-control" id="remarks"  type="text" placeholder="Enter Remarks">
									<span class="error3"></span>
								</div>
                            </div>
							
                            <div class="m-t-20" style="margin-bottom:20px;clear:both;">
                                <button class="btn btn-primary add-row">Add Item</button>
                            </div>
							
                         </form>
						
						
					<?php
					 	$attributes = array('class' => '');
     					echo form_open_multipart('onlinestationary/Requisition/addrequisition/',$attributes);?>

     					<div class="col-sm-2" style="padding-left:0;">
							<div class="form-group">
								<label>Dir.</label>
								<input class="form-control"  type="number" name="dir" min="0" placeholder="Dir.">
							</div>
                        </div>

                        <div class="col-sm-2">
							<div class="form-group">
								<label>Dy. Dir.</label>
								<input class="form-control"  type="number" name="dydir" min="0" placeholder="Dy. Dir.">
							</div>
                        </div>

                        <div class="col-sm-2">
							<div class="form-group">
								<label>A.D./EAD</label>
								<input class="form-control"  type="number" name="ad" min="0" placeholder="A.D./EAD">
							</div>
                        </div>

                        <div class="col-sm-2">
							<div class="form-group">
								<label>Dman/JE Comp</label>
								<input class="form-control"  type="number" name="dman" min="0" placeholder="Dman/JE Comp">
							</div>
                        </div>

                         <div class="col-sm-2">
							<div class="form-group">
								<label>S.O.</label>
								<input class="form-control"  type="number" name="so" min="0" placeholder="S.O.">
							</div>
                        </div>

                         <div class="col-sm-2" style="padding-right:0;">
							<div class="form-group">
								<label>Asstt.</label>
								<input class="form-control"  type="number" name="asstt" min="0" placeholder="Asstt.">
							</div>
                        </div>

                        <div class="col-sm-2" style="padding-left:0;">
							<div class="form-group">
								<label>UDC/LDC</label>
								<input class="form-control"  type="number" name="udcldc" min="0" placeholder="UDC/LDC">
							</div>
                        </div>

                         <div class="col-sm-2">
							<div class="form-group">
								<label>P.A./Steno.</label>
								<input class="form-control"  type="number" name="pasteno" min="0" placeholder="P.A./Steno.">
							</div>
                        </div>

                         <div class="col-sm-2">
							<div class="form-group">
								<label>Others</label>
								<input class="form-control"  type="number" name="others" min="0" placeholder="Others">
							</div>
                        </div>

                        <div id='add_request'>
						
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
								
					       <button type="submit"  name="submit" class="btn btn-primary">Save</button>	
                           <a href="<?php echo base_url(); ?>onlinestationary/Requisition/" class="btn btn-danger">Cancel</a>
                        
                        </div>

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
      