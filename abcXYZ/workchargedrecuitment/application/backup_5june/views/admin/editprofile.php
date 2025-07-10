
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Edit Profile</h4>
                        <?php if($this->session->flashdata('flashSuccess_profileupdate')) { ?>
                                <div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_profileupdate');?> 
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
                                <?php } ?>

                                <?php if($this->session->flashdata('flashError_profileupdate')) { ?>
                                <div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_profileupdate'); ?> 
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
                                <?php } ?>
                    </div>
                </div>
                <?php
                $uri = $this->session->userdata('applicant_user_id');
                $attributes = array('class' => '', 'id' =>'edit_user_proffile');
                echo form_open_multipart('Applicant/edit_profile/'.$uri, $attributes);?> 
                    <div class="card-box">
                        <h3 class="card-title">Basic Information</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-img-wrap">
                                    <?php

                                        if(empty($user_data->image))
                                        {
                                            $user_pic =  base_url().'uploads/applicant_profile_photos/'.'user-03.jpg';
                                        }

                                        else
                                        {
                                            $user_pic = base_url().'uploads/applicant_profile_photos/'.$user_data->image;
                                        }
                                    ?>
                                    <img class="inline-block" src="<?php echo $user_pic; ?>" alt="user">
                                    <div class="fileupload btn btn-default">
                                        <span class="btn-text">Edit</span>
                                        <input class="upload" name="applicant_pic"  type="file" accept=".png, .jpg, .jpeg">
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label class="control-label">Name</label>
                                            <div class="form-group form-focus">
                                               <!--  <label class="control-label">Name</label> -->
                                                <input type="text" name="full_name" value = "<?php echo $user_data->name; ?>" class="form-control floating" placeholder = "Name">

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Email</label>
                                            <div class="form-group form-focus">
                                               <!--  <label class="control-label">Email</label> -->
                                                <input type="email" name="email" value = "<?php echo $user_data->email; ?>" class="form-control floating" placeholder = "Email">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label class="control-label">Mobile No.</label>
                                            <div class="form-group form-focus">
                                                <!-- <label class="control-label">Mobile No.</label> -->
                                              <!--   <div class="cal-icon"> -->
                                                   <input type="text" name="mobile_no" maxlength = "15" value = "<?php echo $user_data->mobile_no; ?>" class="form-control floating" placeholder = "Mobile No." readonly>
                                               <!--  </div> -->
                                            </div>
                                        </div>

                                         <div class="col-md-6">
                                            <label class="control-label">Date of birth</label>
                                            <div class="form-group form-focus">
                                               <!--  <label class="control-label">Date of birth</label> -->
                                                <!-- <div class="cal-icon"> -->
                                                   <input type="date"  name="dob" value = "<?php echo $user_data->dob; ?>" class="form-control floating" placeholder = "Date of birth">
                                               <!--  </div> -->
                                            </div>
                                        </div>

                                        <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Gender</label>
                                            <select required="required" name = "gender" class="form-control">
                                               <option selected="selected" value="male" <?php if($user_data->gender == 'male') echo 'selected="selected"' ?>>Male</option>
                                               <option  value="female" <?php if($job_data->gender == 'female') echo 'selected="selected"' ?>>Female</option>
                                            </select>
                                        </div>
                                    </div>

                                     <div class="col-md-6">
                                            <label class="control-label">Password</label>
                                            <div class="form-group form-focus">
                                                 <label class="control-label">*********</label> 
                                                <!-- <div class="cal-icon"> -->
                                                   <input type="password"  name="password" value = "" class="form-control floating" placeholder = "Password">
                                               <!--  </div> -->
                                            </div>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                    
                    <div class="text-center m-t-20">
                        <button class="btn btn-primary btn-lg" name="submit" type="submit">Save Changes</button>
                    </div>
               <?php echo form_close(); ?>
            </div>
      
        </div>

     