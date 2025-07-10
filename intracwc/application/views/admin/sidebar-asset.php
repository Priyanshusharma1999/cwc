      <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
			
			   <ul class="nav navbar-nav navbar-right user-menu">
                 <li>
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
                        <span class="user-img"><img class="img-circle" src="<?php echo $user_pic;?>" width="60" height="60" alt="Admin">
                        <span class="status online"></span></span>
                        <span class="name">
                            <?php 
                                $session_id = $this->session->userdata('user_id');
                                $user_data = $this->Base_model->get_record_by_id('users', array('user_id' => $session_id));
                                if($user_data->user_name)
                                {
                                    $admin_name = $user_data->user_name;
                                }

                                else
                                {
                                     $admin_name = 'User';
                                }
                                echo $admin_name;
                            ?>
                        </span>
                        <?php $session_id = $this->session->userdata('user_id'); ?>
                        <span class="links">
                            <a href="<?php echo base_url('admin/profile/'.$session_id); ?>"><i class="fa fa-user"></i></a>
                            <a href="<?php echo base_url('admin/editprofile/'.$session_id); ?>"><i class="fa fa-pencil"></i></a>
                            <a href="<?php echo base_url()?>frontend/logout"><i class="fa fa-power-off"></i></a>
                       </span>  
                </li>
               </ul> 

               <?php  

            $user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
       
               foreach ($user_role_data as $role_id)
               {
                    $user_roles[]= $role_id->role_id;
               }

           ?>
			
                <div id="sidebar-menu" class="sidebar-menu">
					<ul>
					
                        <li class="<?php if(($this->uri->segment(2))==''){ echo 'active'; } ?>" >
                            <a href="<?php echo site_url();?>admin"><i class="fa fa-dashboard"></i>Dashboard</a>
                        </li> 
						
						<li  class="<?php if(($this->uri->segment(2))=='complain'){ echo 'active'; } ?>">
                            <a href="<?php echo site_url();?>itcomplaint/complain">
							   <i class="fa fa-comments"></i>Complaint Management
							</a>
                        </li>

               <?php  if (in_array("1", $user_roles) || in_array("14", $user_roles)) {?>

                        <li  class="<?php if(($this->uri->segment(2))=='solvecomplain'){ echo 'active'; } ?>">
                            <a href="<?php echo site_url();?>itcomplaint/solvecomplain">
							   <i class="fa fa-comments"></i>Resolve Complaint
							</a>
                        </li>
						
						<li  class="<?php if(($this->uri->segment(2))=='report'){ echo 'active'; } ?>">
                            <a href="<?php echo site_url();?>itcomplaint/report">
							   <i class="fa fa-file"></i>Report
							</a>
                        </li>

                  <?php } ?>      
						
						
						<li  class="<?php if(($this->uri->segment(2))=='vendor'){ echo 'active'; } ?>">
                            <a href="<?php echo site_url();?>itcomplaint/vendor">
							   <i class="fa fa-industry"></i>Vendor Details
							</a>
                        </li>
						
                    </ul>
                </div>
            </div>
        </div>