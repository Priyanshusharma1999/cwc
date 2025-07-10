
    

	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Circle</h6>
								<hr>
						
						
						  <div class="col-sm-6">
							<div class="form-group">
								<label>Region  : </label>
								<?php

									$region_data = $this->Base_model->get_record_by_id('tbl_region', array('id' => $circle_data->region_id));
		                    if(empty($region_data))
		                    {
		                    		echo '';
		                    }
		                    else
		                    {
		                    		echo $region_data->region_name;
		                    }
								?>
								<span class = "text-danger"><?php echo form_error('region_name');?></span>
							</div>
						  </div>

						  <div class="col-sm-6">
							<div class="form-group">
								<label>Circle  : </label>
								<?php echo $circle_data->circle_name ; ?>
								<span class = "text-danger"><?php echo form_error('region_name');?></span>
							</div>
						  </div>
						  
						  <div class="m-t-20" style="clear:both;padding-left:15px;">

                                
                          </div>
							
                        
								
                            </div>
                        </div>
                    </div>
                </div>
				
            </div>
            
        </div>
      

