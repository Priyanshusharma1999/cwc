  
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" style="float:left;width:100%;">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Building</h6>
								<hr>
                                
						
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Building Name<span class="required"></span></label>
									<?php echo $building_data->building_name; ?>
									
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Building  Short Name<span class="required"></span></label>
									<?php echo $building_data->building_short_name; ?>
									
								</div>
                            </div>

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Job Status<span class="required"></span></label>
									 <?php 
									 if($building_data->status == '1') 
									 	echo 'Active';
									else if($building_data->status == '0') 
										echo 'Dective';
									else
										echo '';

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