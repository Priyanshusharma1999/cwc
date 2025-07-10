      <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
			
			   <ul class="nav navbar-nav navbar-right user-menu">
                <li>
                    <?php 
                                $session_id = $this->session->userdata('applicant_user_id');
                                $user_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $session_id));
                               

                               if(empty($user_data->image))
                                {
                                    $user_pic =  base_url().'uploads/applicant_profile_photos/'.'user-03.jpg';
                                }

                                else
                                {
                                    $user_pic = base_url().'uploads/applicant_profile_photos/'.$user_data->image;
                                }

                               
                            ?>

                        <span class="user-img"><img class="img-circle" src="<?php echo $user_pic;?>" width="60" height="60" alt="User">
					    <span class="status online"></span></span>
                        <span class="name">
                           <?php 
                                $session_id = $this->session->userdata('applicant_user_id');
                                $user_data = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $session_id));
                                if($user_data->name)
                                {
                                    $admin_name = $user_data->name;
                                }

                                else
                                {
                                     $admin_name = 'User';
                                }

                               

                                echo $admin_name;
                            ?>
                                
                        </span>
                           <?php $session_id = $this->session->userdata('applicant_user_id'); ?>
						<span class="links">
							
                            <a href="<?php echo site_url('Applicant/profile/'.$session_id);?>"><i class="fa fa-user"></i></a>
                            <a href="<?php echo site_url('Applicant/edit_profile/'.$session_id);?>"><i class="fa fa-pencil"></i></a>
							<a href="<?php echo base_url()?>Applicant/logout"><i class="fa fa-power-off"></i></a>
					   </span>	
                </li>
               </ul> 
			
                <div id="sidebar-menu" class="sidebar-menu">
					<ul>
					
                        <li class="<?php if(($this->uri->segment(2))==''){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('Applicant/dashboard/'.$session_id);?>"><i class="fa fa-address-card"></i>Apply For Job</a>
                        </li> 
						
						<li class="<?php if(($this->uri->segment(2))=='job_list'){ echo 'active'; } ?>">
                            <a href="<?php echo site_url('Applicant/job_list/'.$session_id);?>"><i class="fa fa-align-justify"></i>Applied Job List</a>
                        </li> 
                     
                    </ul>
                </div>
            </div>
        </div>