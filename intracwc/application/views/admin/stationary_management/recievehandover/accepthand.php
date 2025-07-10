   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Handover Items List</h6>
								<hr>
								
					<?php if($this->session->flashdata('flashError_item')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_item'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
						<?php } ?>

						<table class="display datatable table table-stripped table-bordered table-responsive" >
                            <thead>
                                <tr>
                                    <th>S.No.</th>
									<th>Item Name</th>
									<th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
						<?php 
								if($items_list) {
									$i=1;
									foreach($items_list as $item) { ?>
                                <tr>
                                    <td><?php echo $i; ?></td>
									<td>
									<?php 
									 $itemname = $this->Base_model->get_record_by_id('osr_item_master',array('item_id'=>$item->item_id,'service_type'=>'2'));
									 echo $itemname->item_name; 
									?>	
								  </td>
                                    <td><?php echo $item->item_quantity; ?></td>
                               
                                </tr>
							<?php $i++; } } else { ?>
								
								<tr><td>No Items found</td></tr>
								
							<?php } ?>	
								
                            </tbody>
                        </table>
						
						
					<?php
					
					    $uri = $this->uri->segment('4');
					 	$attributes = array('class' => '', 'id' =>'add_request');
     					echo form_open_multipart('onlinestationary/Recievehandover/Accepthandover/'.$uri,$attributes);?>

     				     <div class="col-sm-12">
								<div class="form-group">
									<label>Accept Remarks<span class="required">*</span></label>
									<textarea class="form-control" placeholder="Accept Remarks" name="aremarks"></textarea>
								</div>
                           </div>
								
					       <button type="submit"  name="submit" class="btn btn-primary">Accept</button>	

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
		
