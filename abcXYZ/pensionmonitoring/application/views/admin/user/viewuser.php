    
    <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-xs-7">
                        <h4 class="page-title">View User Detail</h4>
                    </div>
					
                </div>
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                    <div class="row">
									  <div class="col-md-2">
									  
									   <?php

                                        if(empty($user_detail->PROFILEIMG))
                                        {
                                          $user_pic =  base_url().'uploads/applicant_profile_photos/'.'user.jpg';
                                        }

                                        else
                                        {
                                         $user_pic = base_url().'uploads/applicant_profile_photos/'.$user_detail->PROFILEIMG;
                                        }
                                    ?>
									    <img class="inline-block" src="<?php echo $user_pic; ?>" alt="user" width="140">
										
									  </div>
									  
                                        <div class="col-md-5">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Full Name:</span>
                                                    <span class="text"><?php echo $user_detail->FULLNAME; ?></span>
                                                </li>
												 <li>
                                                    <span class="title">User Name:</span>
                                                    <span class="text"><?php echo $user_detail->LOGONID; ?></span>
                                                </li>
												<li>
                                                    <span class="title">User Type:</span>
													<?php if($user_detail->ROLE_ID == 1){?> 
                                                    <span class="text"><?php echo 'Super Admin'; ?></span>
													<?php } else if($user_detail->ROLE_ID == 2){?>
													<span class="text"><?php echo 'Organization Admin'; ?></span>
													<?php } else if($user_detail->ROLE_ID == 3){?> 
													<span class="text"><?php echo 'PAO Admin'; ?></span>
													<?php } else { ?>
													<span class="text"><?php echo 'Division Admin' ; ?></span>
													<?php }?>
                                                </li>
                                                <li>
                                                    <span class="title">Email Id:</span>
                                                    <span class="text"><?php echo $user_detail->EMAIL; ?><span>
                                                </li>
                                               
                                                
                                            </ul>
                                        </div>
                                        <div class="col-md-5">
                                            <ul class="personal-info">
											
											   <li>
                                                    <span class="title">Mobile No:</span>
                                                    <span class="text"><?php echo $user_detail->MOBILE; ?></span>
                                                </li>
											     <li>
                                                    <span class="title">Organization Name:</span>
                                                    <span class="text">
													<?php if($org_data->ORGNAME){
														echo $org_data->ORGNAME;
													} else{
														echo 'No Organization';
													}?>
													</span>
													
                                                </li>
												
                                                <li>
                                                    <span class="title">Division Name:</span>
                                                    <span class="text">
													<?php if($division_data->DIVISIONNAME){
														echo $division_data->DIVISIONNAME;
													} else{
														echo 'No Division';
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
	