
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Circular</h6>
								<hr>
                             <?php if($this->session->flashdata('flashSuccess_circular')) { ?>
							<div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_circular');?> 
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
							<?php } ?>

							<?php if($this->session->flashdata('flashError_circular')) { ?>
							<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_circular'); ?> 
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
							<?php } ?> 

							<?php
							
						 	$attributes = array('class' => '', 'id' =>'add_circullar');
	     					echo form_open_multipart('Circular/add_circular/',$attributes);?>
								
						    <div class="form-group">
                                <label>Reference Number</label>
                                <input class="form-control" type="text" name = "refrence_no" placeholder="Reference Number" maxlength = "25" >
                            </div>
								
                            <div class="form-group">
                                <label>Circular Title</label>
                                <input class="form-control" name = "circular_title" type="text" placeholder="Circular Title">
                            </div>

                             <div class="form-group">
                                <label>Jobs</label>
                                <select class="select select2-hidden-accessible" id = "circular_job_id" name= "circular_job_name" required="required">
								    <option value="">Select Jobs</option>
									<?php
											if(empty($all_jobs))
											{
												echo '<option value="1">'.'Select Circle'.'</option>';
											}

											else
											{
												foreach ($all_jobs as $jobs)
						                      {   
						                         echo '<option value="'.$jobs->id.'">'.$jobs->job_title.'</option>';
						                      }
											}
					                      
					                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Circle</label>
                                <select class="select select2-hidden-accessible" id = "circular_circcle" name= "circle_name">
								    <option value="">Select Circle</option>
									
                                </select>
                            </div>
                          
							<div class="form-group">
                                <label>Upload Circular</label>
                                <div>
                                    <input class="form-control" name = "circular_pdf" type="file" accept=".pdf">
                                </div>
                            </div>
                            
                            <div class="m-t-20 text-center">
                            	<button name = "submit" type = "submit" class="btn btn-primary btn-lg">Add Circular</button>
                              
                            </div>
                        <?php echo form_close(); ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      