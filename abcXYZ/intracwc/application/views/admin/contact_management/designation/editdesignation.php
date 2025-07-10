    
     <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Designation</h6>
                                <hr>
                        <?php if($this->session->flashdata('flashError_designation')) { ?>
                        <div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_designation'); ?> 
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
                        <?php } ?>
                                
                        <?php
                        $attributes = array('class' => '', 'id' =>'add_designation');
                        echo form_open_multipart('Contact/Designation/edit_designation/'.$designation_data->contact_designation_id,$attributes);?>

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation<span class="required">*</span></label>
                                    <select id="organisation_name1" name="organisation_name" class="form-control">
                                       <option selected="selected" value="">Select Organisation</option>
                                         <?php
                                            $all_data1[] = $designation_data->contact_organisation_id;
                                            foreach ($all_organisation as $rows1 ) {  ?>
                                            <option value="<?php echo $rows1->contact_organisation_id; ?>"
                                            <?php 
                                                echo (isset($designation_data->contact_organisation_id) && in_array($rows1->contact_organisation_id,$all_data1) ) ? "selected" : "" ?> ><?php echo $rows1->contact_organisation_name; ?>
                                            </option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Post<span class="required">*</span></label>
                                    <select id="post_name1" name="post_name" class="form-control">
                                       <option selected="selected" value="">Select Post</option>
                                        <?php
                                            $all_data2[] = $designation_data->contact_post_id;
                                            foreach ($all_post as $rows2 ) {  ?>
                                            <option value="<?php echo $rows2->contact_organisation_id; ?>"
                                            <?php 
                                                echo (isset($designation_data->contact_post_id) && in_array($rows2->contact_post_id,$all_data2) ) ? "selected" : "" ?> ><?php echo $rows2->contact_post_name; ?>
                                            </option>
                                      <?php } ?>
                                    </select>
                                </div>
                            </div>

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Designation Name<span class="required">*</span></label>
                                    <input class="form-control" name="designation_name" type="text" placeholder="Designation Name" maxlength="200" value = "<?php echo $designation_data->contact_designation_name; ?>">
                                    <span class = "text-danger"><?php echo form_error('designation_name');?></span>
                                </div>
                            </div>
                           
                            
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Update Designation</button>
                            </div>
                        <?php echo form_close();?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

