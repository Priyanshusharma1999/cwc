   
    <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-xs-7">
                        <h4 class="page-title">My Profile</h4>
                    </div>
                </div>
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">

                        <?php if($this->session->flashdata('flashSuccess_profile')) { ?>
                        <div class='alert alert-success' > <?php echo $this->session->flashdata('flashSuccess_profile'); ?> 
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> 
                        <?php } ?>

                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
									
									  <?php

                                        if(empty($user_data->PROFILEIMG))
                                        {
                                          $user_pic =  base_url().'uploads/applicant_profile_photos/'.'user.jpg';
                                        }

                                        else
                                        {
                                         $user_pic = base_url().'uploads/applicant_profile_photos/'.$user_data->PROFILEIMG;
                                        }
                                    ?>
									
                                      <img class="avatar" src="<?php echo $user_pic; ?>" alt="">
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 m-b-0"><?php echo $user_data->FULLNAME; ?></h3>
												<?php
												   if($user_data->ROLE_ID ==1){
													   $user_role= 'Super Admin';
												   } else if($user_data->ROLE_ID ==2){
													   $user_role= 'Organization Admin';
												   } else if($user_data->ROLE_ID ==3){
													   $user_role= 'PAO Admin';
												   } else {
													   $user_role= 'Division Admin';
												   }?>
												 <small class="text-muted"><?php echo $user_role; ?></small>
                                                <div class="staff-id">Login Id : <?php echo $user_data->LOGONID; ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text">
													 <a href="tel:<?php echo $user_data->MOBILE; ?>">
													  <?php echo $user_data->MOBILE; ?>
													 </a>
													</span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text">
													  <a href="mailto:<?php echo $user_data->EMAIL; ?>">
													    <?php echo $user_data->EMAIL; ?>
													  </a>
													</span>
                                                </li>
                                               
                                                <li>
                                                    <span class="title">Organization:</span>
                                                    <span class="text">
													 <?php if($org_name->ORGNAME) {
														 echo $org_name->ORGNAME; 
													 } else {
														 echo 'N/A' ;
													 }?>
													</span>
                                                </li>
                                                <li>
                                                    <span class="title">Division:</span>
                                                    <span class="text">
													 <?php if($div_name->DIVISIONNAME) {
														 echo $div_name->DIVISIONNAME; 
													 } else {
														 echo 'N/A' ;
													 }?>
													</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        
        </div>
	