   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Handover Items List</h6>
								<hr>
						
								
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
		

	