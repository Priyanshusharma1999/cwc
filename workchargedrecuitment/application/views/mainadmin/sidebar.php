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

                        <span class="user-img"><img class="img-circle" src="<?php echo $user_pic;?>" width="60" height="60" alt="Admin">
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
                                     $admin_name = 'Admin';
                                }

                               

                                echo $admin_name;
                            ?>
                        </span>
                        <?php $session_id = $this->session->userdata('auser_id'); ?>
						<span class="links">
							
							<a href = "<?php echo base_url('Superadmin/view_profile/'.$session_id); ?>"><i class="fa fa-user"></i></a>
							<a href="<?php echo base_url('Superadmin/edit_profile/'.$session_id); ?>"><i class="fa fa-pencil"></i></a>
							<a href="<?php echo base_url()?>Frontend/logout"><i class="fa fa-power-off"></i></a>
					   </span>	
                </li>
               </ul> 
			
                <div id="sidebar-menu" class="sidebar-menu">
					<ul>
					
					  <li class="<?php if(($this->uri->segment(1))=='Superadmin' && ($this->uri->segment(2))=='')
					    { echo 'active'; } ?>">
                           <a href="<?php echo base_url('Superadmin/index/'.$session_id);?>"><i class="fa fa-dashboard"></i>Dashboard</a>
                       </li> 
                    
                       <li class="<?php if(($this->uri->segment(2))=='add_region' || ($this->uri->segment(2))=='add_circle' || ($this->uri->segment(2))=='add_post'){ echo 'active'; } ?> submenu">
                            <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span>Master Data Management</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="<?php echo base_url('Superadmin/add_region/'.$session_id);?>">Add Region</a></li>
								<li><a href="<?php echo site_url('Superadmin/add_circle/'.$session_id);?>">Add Circle</a></li>
								<li><a href="<?php echo site_url('Superadmin/add_post/'.$session_id);?>">Add Post</a></li>
							</ul>
                        </li> 
						
			            <li class="<?php if(($this->uri->segment(2))=='add_users' || ($this->uri->segment(1))=='Users'){ echo 'active'; } ?> submenu">
                            <a href="#"><i class="fa fa-user-o" aria-hidden="true"></i> <span>User Management</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li>
								   <a href="<?php echo site_url('Users/add_users/'.$session_id);?>">Add Users</a>
								 </li>
								<li>
								<a href="<?php echo site_url('Users/index/'.$session_id);?>">Users List</a>
							   </li>
							</ul>
                        </li> 
						
						
						<li class="<?php if(($this->uri->segment(1))=='Applicant_admin'){ echo 'active'; } ?> submenu">
                            <a href="#"><i class="fa fa-user-o" aria-hidden="true"></i> <span>Applicants Management</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="<?php echo site_url('Applicant_admin/index/'.$session_id);?>">Applicants List</a></li>
								<!-- <li><a href="<?php echo site_url();?>Applicant_admin/bulk_sms">Send Bulk SMS</a></li> -->
							</ul>
                        </li> 
						
						<li class="<?php if(($this->uri->segment(1))=='Jobs' || ($this->uri->segment(1))=='Circular'){ echo 'active'; } ?> submenu">
                            <a href="#"><i class="fa fa-suitcase" aria-hidden="true"></i> <span>Job Management</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display: none;">
                                <li><a href="<?php echo site_url('Jobs/add_jobs/'.$session_id);?>">Add Job</a></li>
								<li><a href="<?php echo site_url('Jobs/index/'.$session_id);?>">Job List</a></li>
								<li><a href="<?php echo site_url('Circular/add_circular/'.$session_id);?>">Add Circular</a></li>
								<li><a href="<?php echo site_url('Circular/index/'.$session_id);?>">Circular List</a></li>
							</ul>
                        </li> 

                         <li class="<?php if(($this->uri->segment(1))=='logs' || ($this->uri->segment(1))=='Logs'){ echo 'active'; } ?>">
                           
                            <a href="<?php echo base_url('logs/index/'.$this->session->userdata('auser_id')) ?>"><i class="fa fa-users"></i>Audit Logs</a>
                        </li>
                     
                    </ul>
                </div>
            </div>
        </div>