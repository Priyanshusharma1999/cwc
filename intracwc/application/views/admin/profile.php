  
      
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
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                         <?php 
                                        $session_id = $this->session->userdata('user_id');
                                        $user_data = $this->Base_model->get_record_by_id('users', array('user_id' => $session_id));
                                       
                                           if(empty($user_data->image))
                                            {
                                                $user_pic =  base_url().'assets/img/'.'user.jpg';
                                            }

                                            else
                                            {
                                                $user_pic = base_url().'uploads/users/'.$user_data->image;
                                            }
                                           
                                        ?>
                                        <a href="#"><img class="avatar" src="<?php echo $user_pic;?>" height="150" width="150" alt=""></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 m-b-0"><?php echo $user_data->user_name;?></h3>
                                                <div class="staff-id"><?php echo $user_data->display_name; ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#"><?php echo $user_data->contact_no;?></a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="#"><?php echo $user_data->email;?></a></span>
                                                </li>
                                                 <li>
                                                    <span class="title">Login Id:</span>
                                                    <span class="text"><?php echo $user_data->login_id;?></a></span>
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
    
