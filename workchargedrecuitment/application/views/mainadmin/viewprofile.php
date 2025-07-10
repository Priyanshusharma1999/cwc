

      

        <div class="page-wrapper">

            <div class="content container-fluid">

                <div class="row">

                    <div class="col-sm-12">

                        <h4 class="page-title">View Profile</h4>

                         

                    </div>

                </div>

                

                    <div class="card-box">

                        <h3 class="card-title">Basic Informations</h3>

                        <div class="row">

                            <div class="col-md-12">

                                <div  class="profile-img-wrap">

                                    <?php



                                        if(empty($user_data->user_pic))

                                        {

                                            $user_pic =  base_url().'uploads/admin_photos/'.'user-03.jpg';

                                        }



                                        else

                                        {

                                            $user_pic = base_url().'uploads/admin_photos/'.$user_data->user_pic;

                                        }

                                    ?>

                                    <img class="inline-block" id=""  src="<?php echo $user_pic; ?>" alt="user">

                                    <div class="fileupload btn btn-default">

                                        

                                      

                                    </div>

                                </div>



                                <div class="profile-basic">

                                    <div class="row">

                                        <div class="col-md-10">

                                            <div class="form-group form-focus">

                                                <!-- <label class="control-label">Full Name</label> -->

                                                <input type="text"  name = "user_name" value = "<?php echo $user_data->name; ?>" class="form-control floating" placeholder = "Full Name" readonly>

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

                                                    <input type="text" value = "<?php echo $user_data->user_id; ?>" class="form-control floating" placeholder = "User Id" readonly>

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

                                                <input type="email"  name = "email" value = "<?php echo $user_data->email; ?>" class="form-control floating" placeholder = "Email" readonly>

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

                                    <input type="text"  name = "contact_no" value = "<?php echo $user_data->phone; ?>" class="form-control floating" placeholder = "Contact No." readonly>

                                </div>

                            </div>

                            <div class="col-md-10">

                                <label class="control-label">User Type</label>

                                <div class="form-group form-focus">

                                     <input type="text" value = "<?php if($user_data->user_type==1) echo 'Admin'; else echo ''; ?>" class="form-control floating" placeholder = "User Type" readonly>

                                </div>

                            </div>



                           

                          

                            <!-- <div class="col-md-6">

                                <div class="form-group form-focus">

                                    <label class="control-label">Pin Code</label>

                                    <input type="password"  name = "password" value = "" class="form-control floating" placeholder = "Contact No.">

                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group form-focus">

                                    <label class="control-label">Phone Number</label>

                                    <input type="text" class="form-control floating">

                                </div>

                            </div> -->

                        </div>

                    </div>

                    

                    

            </div>

      

        </div>

       

           

        

	

	