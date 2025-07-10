    
     <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Edit Post</h6>
                                <hr>
                        <?php if($this->session->flashdata('flashError_post')) { ?>
                        <div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_post'); ?> 
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
                        <?php } ?>
                                
                        <?php
                        $attributes = array('class' => '', 'id' =>'add_post');
                        echo form_open_multipart('Contact/Post/edit_post/'.$post_data->contact_post_id,$attributes);?>

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation<span class="required">*</span></label>
                                    <select name="organisation_name" class="form-control">
                                       <option selected="selected" value="">Select Organisation</option>
                                        <?php
                                            $all_data1[] = $post_data->contact_organisation_id;
                                            foreach ($all_organisations as $rows1 ) {  ?>
                                            <option value="<?php echo $rows1->contact_organisation_id; ?>"
                                            <?php 
                                                echo (isset($post_data->contact_organisation_id) && in_array($rows1->contact_organisation_id,$all_data1) ) ? "selected" : "" ?> ><?php echo $rows1->contact_organisation_name; ?>
                                            </option>
                                      <?php } ?>
                                        
                                    </select>
                                </div>
                            </div>

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Post Name<span class="required">*</span></label>
                                    <input class="form-control" name="post_name" type="text" placeholder="Post Name" maxlength="200" value = "<?php echo $post_data->contact_post_name; ?>">
                                    <span class = "text-danger"><?php echo form_error('post_name');?></span>
                                </div>
                            </div>
                           
                            
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Update Post</button>
                            </div>
                        <?php echo form_close();?>
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

