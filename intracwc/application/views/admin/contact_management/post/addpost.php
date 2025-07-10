 	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Add Post</h6>
								<hr>
                        <?php if($this->session->flashdata('flashError_post')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_post'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
						<?php } ?>
						        
						<?php
					 	$attributes = array('class' => '', 'id' =>'add_post');
     					echo form_open_multipart('Contact/Post/add_post/',$attributes);?>

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation<span class="required">*</span></label>
                                    <select name="organisation_name" class="form-control">
                                       <option selected="selected" value="">Select Organisation</option>
                                        <?php
                                            if(empty($all_organisations))
                                            {
                                                echo '';
                                            }

                                            else
                                            {
                                                foreach ($all_organisations as $organisation)
                                              {   
                                                 echo '<option value="'.$organisation->contact_organisation_id.'">'.$organisation->contact_organisation_name.'</option>';
                                              }
                                            }
                                          
                                        ?>
                                    </select>
                                </div>
                            </div>

						   <div class="col-sm-6">
								<div class="form-group">
									<label>Post Name<span class="required">*</span></label>
									<input class="form-control" name="post_name" type="text" placeholder="Post Name" maxlength="200" value = "<?php echo isset($insertData['post_name']) ? $insertData['post_name'] : ''; ?>">
									<span class = "text-danger"><?php echo form_error('post_name');?></span>
								</div>
                            </div>
						   
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button class="btn btn-primary" type="submit" name="submit">Add Post</button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

