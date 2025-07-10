 
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" style="float:left;width:100%;">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Floor</h6>
								<hr>
                                
						
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Building Name</label>
									<?php 
                                    	$building_data = $this->Base_model->get_record_by_id('building', array('building_id' => $room_data->building_id));
                                    	echo $building_data->building_name;
                                    	?>
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Floor Name</label>
									<?php echo $room_data->room_name;?>
								</div>
                            </div>

                             <div class="col-sm-6">
								<div class="form-group">
									<label>Status</label>
									<?php

										if($room_data->status==1) 
										{
											echo 'Active';
										}

										else if($room_data->status==0) 
										{
											echo 'Deactive';
										}

										else
										{
											echo '';
										}

									?>
								</div>
                            </div>
							
							
                         
                       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

<style>
	
	 label{width:35%;}
    .form-group{

	    margin-bottom: 20px;
	    float: left;
	    width: 100%;
	    padding: 10px;
	    border: 1px solid #ccc;
	}

</style>  