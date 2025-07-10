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
			
                <div id="sidebar-menu" class="sidebar-menu">
					<ul>
					
                        <li class="<?php if(($this->uri->segment(2))==''){ echo 'active'; } ?>" >
                            <a href="<?php echo site_url();?>admin"><i class="fa fa-dashboard"></i>Dashboard</a>
                        </li> 
						
						<li  class="<?php if(($this->uri->segment(2))=='circularlist' || ($this->uri->segment(2))=='addcircular' || ($this->uri->segment(2))=='editcircular'){ echo 'active'; } ?>">
                            <a href="<?php echo site_url();?>admin/circularlist">
							   <i class="fa fa-cloud-upload"></i>Circular Upload
							</a>
                        </li>
						
                    </ul>
                </div>
            </div>
        </div>