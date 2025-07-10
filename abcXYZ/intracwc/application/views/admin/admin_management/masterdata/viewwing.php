
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" style="float:left;width:100%;">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Wing</h6>
								<hr>
								   <div class="col-sm-6">
										<div class="form-group">
											<label>Wing Name</label>
											<?php echo $wing_data->wing_name; ?>
										</div>
									</div>
								   <div class="col-sm-6">
										<div class="form-group">
											<label>Wing Short Name</label>
											<?php echo $wing_data->wing_short_name; ?>
										</div>
									</div>

									<div class="col-sm-6">
									<div class="form-group">
										<label>Status</label>
										<?php

											if($wing_data->status==1) 
											{
												echo 'Active';
											}

											else if($wing_data->status==0) 
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