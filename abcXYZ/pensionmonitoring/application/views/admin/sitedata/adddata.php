   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Circular</h6>
								<hr>
								
						<?php if($this->session->flashdata('flashError_site')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_site'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
                                
						<?php
					 	$attributes = array('class' => '', 'id' =>'add_title');
     					echo form_open_multipart('sitedata/addtitle/',$attributes);?> 
						   <div class="col-sm-6">
								<div class="form-group">
									<label>Title<span class="required">*</span></label>
									<input class="form-control" name="title" type="text" placeholder="Title">
									<span class = "text-danger"><?php echo form_error('title');?></span>
								</div>
                            </div>

                            <!--  <div class="col-sm-6">
                                <div class="form-group">
                                    <label>URL<span class="required">*</span></label>
                                    <input class="form-control" name="url" type="text" placeholder="URL">
                                    <span class = "text-danger"><?php //echo form_error('url');?></span>
                                </div>
                            </div> -->

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Upload Circular(only pdf file allowed)</label>
                                    <div>
                                        <input class="form-control" name = "circular_pdf" type="file" accept=".pdf" required>
                                    </div>
                                </div>
                            </div>
						      
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button name="submit" type="submit"  class="btn btn-primary">Add Data</button>
                            </div>
                        <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    