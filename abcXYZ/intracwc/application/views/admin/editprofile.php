
      
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
                $uri = $this->uri->segment('3');
                $attributes = array('class' => '', 'id' =>'edit_profile');
                echo form_open_multipart('Admin/editprofile/'.$uri, $attributes);?> 
                    <div class="card-box">
                        <h3 class="card-title">Basic Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div  class="profile-img-wrap">
                                    <?php

                                        if(empty($user_data->image))
                                        {
                                            $user_pic =  base_url().'assets/img/'.'user-03.jpg';
                                        }

                                        else
                                        {
                                            $user_pic = base_url().'uploads/users/'.$user_data->image;
                                        }
                                    ?>
                                    <img class="inline-block" id=""  src="<?php echo $user_pic; ?>" alt="user">
                                    <div class="fileupload btn btn-default">
                                        <span class="btn-text">Edit</span>
                                        <input class="upload" name = "user_pic" type="file">
                                    </div>
                                </div>

                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-10">
                                            <div class="form-group form-focus">
                                                <!-- <label class="control-label">Full Name</label> -->
                                                <input type="text"  name = "user_name" value = "<?php echo $user_data->user_name; ?>" class="form-control floating" placeholder = "User Name">
                                            </div>
                                        </div>
                                       <!--  <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="control-label">Last Name</label>
                                                <input type="text" class="form-control floating">
                                            </div>
                                        </div> -->
                                        <div class="col-md-5">
                                            <div class="form-group form-focus">
                                              <!--   <label class="control-label">Birth Date</label> -->
                                                <!-- <div class="cal-icon"> -->
                                                    <!-- <input class="form-control floating datetimepicker" type="text"> -->
                                                    <input type="text" value = "<?php echo $user_data->login_id; ?>" class="form-control floating" placeholder = "Login Id" readonly>
                                               <!--  </div> -->
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group form-focus select-focus">
                                                <!-- <label class="control-label">Gendar</label> -->
                                                <!-- <select class="select form-control floating">
                                                    <option>Select Gendar</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select> -->
                                                <input type="email"  name = "email" value = "<?php echo $user_data->email; ?>" class="form-control floating" placeholder = "Email">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <h3 class="card-title">Contact Informations</h3>
                        <div class="row">
                            <div class="col-md-10">
                                <label class="control-label">Contact No.</label>
                                <div class="form-group form-focus">
                                    <!-- <label class="control-label">Address</label>
                                    <input type="text" class="form-control floating"> -->
                                    <input type="text"  name = "contact_no" value = "<?php echo $user_data->contact_no; ?>" class="form-control floating" placeholder = "Contact No." readonly>
                                </div>
                            </div>
                            
                            <div class="col-sm-10">
                             <div class="form-group">
                                <label>Old Password<span class="required"></span></label>
                                <input class="form-control" id="old_pwd" name = "old_passworrd" type="password" maxlength = "100" placeholder="Old Password" value = ""/>
                                <span class = "text-danger"><?php echo form_error('old_passworrd');?></span>
                                
                            </div>
                          </div>

                           <div class="col-sm-10">
                             <div class="form-group">
                                <label>New Password<span class="required"></span></label>
                                <input class="form-control" id="pwd" name = "password2" type="password" maxlength = "100" placeholder="New Password" value = "" maxlength = "100">
                                <span class = "text-danger"><?php echo form_error('password2');?></span>
                                <span id="span_password_msg" style="color:red">Please enter password in format consits of one upper case,one lower case,one digit, one special character.</span>
                            </div>
                          </div>

                            <div class="col-sm-10">
                             <div class="form-group">
                                <label>Confirm Password<span class="required"></span></label>
                                <input class="form-control" id="pwd2" name = "cnfrm_passworrd" type="password" maxlength = "100" placeholder="Confirm Password" value = "" maxlength = "100">
                                <span class = "text-danger"><?php echo form_error('cnfrm_passworrd');?></span>
                                <span id="span_password_msg2" style="color:red">Please enter password in format consits of one upper case,one lower case,one digit, one special character.</span>
                            </div>
                          </div>
                          
                         
                        </div>
                    </div>
                    
                    <div class="text-center m-t-20">
                        <button onclick="mySubmit_profile();" class="btn btn-primary btn-lg" name ="submit" type="submit">Save Changes</button>
                    </div>
                <?php echo form_close();?>
            </div>
      
        </div>
       
           
        <style>
            
            .form-focus .form-control {
                padding: 8px 12px 6px;
            }
        </style>
    
    