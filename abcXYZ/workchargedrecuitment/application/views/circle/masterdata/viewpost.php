
    

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
								<label>Region Name : </label>
								<?php

									$region_data = $this->Base_model->get_record_by_id('tbl_region', array('id' => $post_data->region_id));
		                    if(empty($region_data))
		                    {
		                    		echo '';
		                    }
		                    else
		                    {
		                    		echo $region_data->region_name;
		                    }
								?>
								
							</div>
						  </div>

						  <div class="col-sm-6">
							<div class="form-group">
								<label>Circle Name : </label>
								<?php

									$circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $post_data->circle_id));
				                    if(empty($circle_data))
				                    {
				                    		echo '';
				                    }
				                    else
				                    {
				                    		echo $circle_data->circle_name;
				                    }
								?>
							
							</div>
						  </div>

						  <div class="col-sm-6">
							<div class="form-group">
								<label>Post Name : </label>
								<?php
									echo $post_data->post_name;
								?>
							
							</div>
						  </div>

						  <div class="col-sm-6">
							<div class="form-group">
								<label>Post Code : </label>
								<?php
									echo $post_data->post_code;
								?>
							
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
      

