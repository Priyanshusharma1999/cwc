
    

	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Circular</h6>
								<hr>

					<div class="col-sm-6">
								<div class="form-group">
									<label>Reference No. : </label>
									<?php echo $circular_data->refrence_no; ?>
								
								</div>
          </div>

          <div class="col-sm-6">
								<div class="form-group">
									<label>Circular Title : </label>
									<?php echo $circular_data->circular_title; ?>
								
								</div>
          </div>
						   


						  <div class="col-sm-6">
							<div class="form-group">
								<label>Circle Name : </label>
								<?php

									$circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id' =>$circular_data->circle_id));
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
								<label>Circular File : </label>
								<?php

									echo $circular_data->file;
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
      

