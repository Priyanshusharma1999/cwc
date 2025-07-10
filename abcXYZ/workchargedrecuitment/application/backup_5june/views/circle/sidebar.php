      <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
			
			   <ul class="nav navbar-nav navbar-right user-menu">
                <li>
                  <?php 
                                $session_id = $this->session->userdata('auser_id');
                                $user_data = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $session_id));
                               

                               if(empty($user_data->user_pic))
                                {
                                    $user_pic =  base_url().'uploads/admin_photos/'.'user-03.jpg';
                                }

                                else
                                {
                                    $user_pic = base_url().'uploads/admin_photos/'.$user_data->user_pic;
                                }

                               
                            ?>
                         <span class="user-img"><img class="img-circle" src="<?php echo $user_pic;?>" width="70" height="70" alt="Circle">
					    <span class="status online"></span></span>
                        <span class="name">
                        	 <?php 
                                $session_id = $this->session->userdata('auser_id');
                                $user_data = $this->Base_model->get_record_by_id('tbl_admin', array('id' => $session_id));
                                if($user_data->name)
                                {
                                    $admin_name = $user_data->name;
                                }

                                else
                                {
                                     $admin_name = 'Circle User';
                                }

                               

                                echo $admin_name;
                            ?>
                        </span>
                        <?php $session_id = $this->session->userdata('auser_id'); ?>
						<span class="links">
							<!-- <a href="<?php //echo site_url();?>mainadmin/profile"><i class="fa fa-user"></i></a>
							<a href="<?php //echo site_url();?>mainadmin/editprofile"><i class="fa fa-pencil"></i></a> -->
							<a href="<?php echo base_url('Circle/view_profile/'.$session_id); ?>"><i class="fa fa-user"></i></a>
							<a href="<?php echo base_url('Circle/edit_profile/'.$session_id); ?>"><i class="fa fa-pencil"></i></a>
							<a href="<?php echo base_url()?>Frontend/logout"><i class="fa fa-power-off"></i></a>
					   </span>	
                </li>
               </ul> 
			
                <div id="sidebar-menu" class="sidebar-menu">
					<ul>
					
					  <li class="<?php if(($this->uri->segment(2))==''){ echo 'active'; } ?>">
                          <!--  <a href="<?php //echo base_url();?>Superadmin/"><i class="fa fa-dashboard"></i>Dashboard</a> -->
                          <a href="<?php echo base_url();?>Circle/"><i class="fa fa-dashboard"></i>Dashboard</a>
                       </li> 
                    
                     
						
						<li class="<?php if(($this->uri->segment(2))=='applicantlist' || ($this->uri->segment(2))=='sendbulksms'){ echo 'active'; } ?> submenu">
                            <a href="#"><i class="fa fa-user-o" aria-hidden="true"></i> <span>Applicants Management</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <!-- <li><a href="<?php //echo site_url();?>Applicant_admin/">Applicants List</a></li> -->
                                 <li><a href="<?php echo site_url();?>Circle_applicant_admin/">Applicants List</a></li>
								<!-- <li><a href="<?php //echo site_url();?>mainadmin/sendbulksms">Send Bulk SMS</a></li> -->
								<li><a href="#">Send Bulk SMS</a></li>
							</ul>
                        </li> 
						
						<li class="<?php if(($this->uri->segment(2))=='addjob' || ($this->uri->segment(2))=='joblist' || ($this->uri->segment(2))=='addcircular' || ($this->uri->segment(2))=='circularlist'){ echo 'active'; } ?> submenu">
                            <a href="#"><i class="fa fa-suitcase" aria-hidden="true"></i> <span>Job Management</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                          <!--  <li><a href="<?php echo site_url();?>Jobs/add_jobs">Add Job</a></li>
								<li><a href="<?php echo site_url();?>Jobs/">Job List</a></li>
								<li><a href="<?php echo site_url();?>Circular/add_circular">Add Circular</a></li>
								<li><a href="<?php echo site_url();?>Circular/">Circular List</a></li> -->

								<li><a href="<?php echo site_url();?>Circle_jobs/add_jobs">Add Job</a></li>
								<li><a href="<?php echo site_url();?>Circle_jobs/">Job List</a></li>
								<li><a href="<?php echo site_url();?>Circle_circular/add_circular">Add Circular</a></li>
								<li><a href="<?php echo site_url();?>Circle_circular/">Circular List</a></li>
							</ul>
                        </li> 
                     
                    </ul>
                </div>
            </div>
        </div>