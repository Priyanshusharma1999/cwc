
    

	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View User</h6>
								<hr>

						  <div class="col-sm-6">
						   <div class="form-group">
								<label class="control-label">Select User Type</label>
								
								   <?php 

								   if($user_data->user_type == '1') 
								   	echo 'Super Admin';

								   	else if($user_data->user_type == '2') 
								   	echo 'Regional Officer';

								   	if($user_data->user_type == '3') 
								   	echo 'Circle Officer';

								   	else
								   	echo ''; 
								   ?>
							</div>
						  </div>
						
						  <div class="col-sm-6">
							<div class="form-group">
								<label> Name : </label>
								<?php
									echo $user_data->name;
								?>
							
							</div>
						  </div>

						  <div class="col-sm-6">
							<div class="form-group">
								<label> UserId : </label>
								<?php
									echo $user_data->user_id;
								?>
							
							</div>
						  </div>

						  <div class="col-sm-6">
							<div class="form-group">
								<label>Contact No. : </label>
								<?php
									echo $user_data->phone;
								?>
							
							</div>
						  </div>

						  <div class="col-sm-6">
							<div class="form-group">
								<label>Email : </label>
								<?php
									echo $user_data->email;
								?>
							
							</div>
						  </div>

						  <div class="col-sm-6">
							<div class="form-group">
								<label>Region Name : </label>
								<?php

									$region_data = $this->Base_model->get_record_by_id('tbl_region', array('id' => $user_data->Division));
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

									$circle_data = $this->Base_model->get_record_by_id('tbl_circle', array('id' => $user_data->Circle));
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
						  
						  <div class="m-t-20" style="clear:both;padding-left:15px;">

                                
                          </div>
							
                        
								
                            </div>
                        </div>
                    </div>
                </div>
				
            </div>
            
        </div>
      

