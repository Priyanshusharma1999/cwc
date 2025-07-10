
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Circular</h6>
								<hr>
                         

							<?php if($this->session->flashdata('flashError_circular')) { ?>
							<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_circular'); ?> 
							<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
							<?php } ?> 

							<?php
							
						 	$attributes = array('class' => '', 'id' =>'add_circullar');
	     					echo form_open_multipart('Circle_circular/edit_circular/'.$circular_data->id,$attributes);?>
								
						    <div class="form-group">
                                <label>Reference Number</label>
                                <input class="form-control" type="text" name = "refrence_no" placeholder="Reference Number" value = "<?php echo $circular_data->refrence_no; ?>" maxlength = "25" >
                            </div>
								
                            <div class="form-group">
                                <label>Circular Title</label>
                                <input class="form-control" name = "circular_title" type="text" placeholder="Circular Title" value = "<?php echo $circular_data->circular_title; ?>" >
                            </div>
                            <div class="form-group">
                                <label>Jobs</label>
                                <select class="select select2-hidden-accessible" id = "circular_job_id" name= "circular_job_name">
                                    <option value="">Select Jobs</option>
                                    <?php
                    
                                         $all_dataajj[]    = $circular_data->job_id;
                                          foreach ($all_jobs as $rojjwss){ ?>   
                                       
                                        <option value="<?php echo $rojjwss->id; ?>"
                                        <?php echo (isset($circular_data->job_id) && in_array($rojjwss->id,$all_dataajj) ) ? "selected" : "" ?>  ><?php echo $rojjwss->job_title; ?></option>
                                        <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label>Circle</label>
                                <select class="select select2-hidden-accessible" id = "circular_circcle" name= "circle_name" readonly>
                                    <option value="">Select Circle</option>
                                    <?php
                    
                                         $all_dataa[]    = $circular_data->circle_id;
                                          foreach ($all_circle as $rowss){ ?>   
                                       
                                        <option value="<?php echo $rowss->id; ?>"
                                        <?php echo (isset($circular_data->circle_id) && in_array($rowss->id,$all_dataa) ) ? "selected" : "" ?>  ><?php echo $rowss->circle_name; ?></option>
                                        <?php } ?>
                                </select>
                            </div>
                          	
							<div class="form-group">
                                <label>Upload Circular</label>
                                <div>
                                    <input class="form-control" name = "circular_pdff" type="file" accept=".pdf" value = "<?php if($circular_data->file) echo $circular_data->file; else echo ''; ?>" >
                                </div>
                            </div>
                            
                            <div class="m-t-20 text-center">
                            	<button name = "submit" type = "submit" class="btn btn-primary btn-lg">Update Circular</button>
                              
                            </div>
                        <?php echo form_close(); ?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      