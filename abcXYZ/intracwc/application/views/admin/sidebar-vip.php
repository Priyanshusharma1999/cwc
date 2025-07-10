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
						
						<li  class="<?php if(($this->uri->segment(2))=='vipdiarylist' || ($this->uri->segment(2))=='editvipdiary' || ($this->uri->segment(2))=='addvipdiary' || ($this->uri->segment(2))=='forwardvip' || ($this->uri->segment(2))=='transfervip' || ($this->uri->segment(2))=='updatevip' ){ echo 'active'; } ?>">
                            <a href="<?php echo site_url();?>admin/vipdiarylist">
							   <i class="fa fa-envelope-o"></i>New Pending References
							</a>
                        </li>
						
						
						<li class="submenu">
                            <a href="#"><i class="fa fa-file" aria-hidden="true"></i> <span>Reports</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display:none">
                                <li><a href="<?php echo site_url();?>admin/diaryreport">Diary Register</a></li>
								<li><a href="<?php echo site_url();?>admin/statusreport">Status Report</a></li>
								<li><a href="<?php echo site_url();?>admin/pendingreport">Pending Reference</a></li>
								<li><a href="<?php echo site_url();?>admin/sectionlist">Pendency Status</a></li>
								<li><a href="<?php echo site_url();?>admin/disposereport">Disposed Reference</a></li>
								<li><a href="<?php echo site_url();?>admin/winglist">Search Reference</a></li>
								<li><a href="<?php echo site_url();?>admin/winglist">Recieved Reference</a></li>
								<li><a href="<?php echo site_url();?>admin/winglist">Forwarded Reference</a></li>
							</ul>
                        </li> 
						
						<li class="" >
                            <a href="#"><i class="fa fa-dashboard"></i>Pull Back Reference</a>
                        </li>
						
						<li class="" >
                            <a href="#"><i class="fa fa-dashboard"></i>Delete Reference</a>
                        </li>
						
                    </ul>
                </div>
            </div>
        </div>