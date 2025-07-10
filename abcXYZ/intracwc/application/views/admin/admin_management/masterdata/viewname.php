
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" style="float:left;width:100%;">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Section</h6>
								<hr>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Wing Name</label>
									
									<?php 
                                	$wing_data = $this->Base_model->get_record_by_id('wing', array('wing_id' => $section_data->wing_id));
                                	echo $wing_data->wing_name;
                                	?>
								</div>
                            </div>
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Section Name</label>
									<?php echo $section_data->section_name; ?>
								</div>
                            </div>
							
							 <div class="col-sm-6">
								<div class="form-group">
									<label>Section Short Name</label>
									<?php echo $section_data->section_short_name; ?>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Show Status</label>
										<?php

										if($section_data->show_status==1) 
										{
											echo 'Show';
										}

										else if($section_data->status==0) 
										{
											echo 'Not show';
										}

										else
										{
											echo '';
										}

									?>
									
								</div>
						    </div>	

						   <div class="col-sm-6">
								<div class="form-group">
									<label>Status</label>
									<?php

										if($section_data->status==1) 
										{
											echo 'Active';
										}

										else if($section_data->status==0) 
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