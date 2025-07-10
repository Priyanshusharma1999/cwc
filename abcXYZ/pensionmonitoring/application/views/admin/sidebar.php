
      <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
			
			   <ul class="nav navbar-nav navbar-right user-menu">
                <li>
				
				      <?php 
							$session_id = $this->session->userdata('applicant_user_id');
							$user_data = $this->Base_model->get_record_by_id('users', array('USERS_ID' => $session_id));
							$role_data = $this->Base_model->get_record_by_id('role', array('ROLE_ID' => $user_data->ROLE_ID));
						   

						   if(empty($user_data->PROFILEIMG))
							{
								$user_pic =  base_url().'uploads/applicant_profile_photos/'.'user.jpg';
							}

							else
							{
								$user_pic = base_url().'uploads/applicant_profile_photos/'.$user_data->PROFILEIMG;
							}

						   
                         ?>
                        <span class="user-img">
						  <img class="img-circle" src="<?php echo $user_pic; ?>" width="50" height="50" alt="">
					      <span class="status online"></span>
						</span>
						
						
                        <span class="name"><?php echo $this->session->userdata('user_name'); ?></span>
                        <!-- <br/><b><span style="font-size: 12px;"><?php //echo $role_data->ROLE;?></span></b> -->

						<span class="links">
							<a href="<?php echo base_url('admin/profile/'.$session_id);?>"><i class="fa fa-user"></i></a>
							<a href="<?php echo base_url('admin/edit_profile/'.$session_id) ?>"><i class="fa fa-pencil"></i></a>
							<a href="<?php echo base_url()?>Frontend/logout"><i class="fa fa-power-off"></i></a>
					   </span>	
                </li>
               </ul> 
			
                <div id="sidebar-menu" class="sidebar-menu">
					<ul>
						
						<?php if($user_data->ROLE_ID == 1 || $user_data->ROLE_ID == 2 ||  $user_data->ROLE_ID == 3 ||  $user_data->ROLE_ID == 4)
						{ ?>
                        <li class="<?php if(($this->uri->segment(1))=='admin'){ echo 'active'; } ?>" >
                            <a href="<?php echo base_url('admin/index/'.$session_id) ?>"><i class="fa fa-dashboard"></i>Dashboard</a>
                        </li>
                        <?php } ?> 

					
					
					   <?php if($user_data->ROLE_ID == 1)
						{ ?>
					
                         <li class="<?php if(($this->uri->segment(1))=='users' || ($this->uri->segment(1))=='Users'){ echo 'active'; } ?>">
                           
                            <a href="<?php echo base_url('users/index/'.$session_id) ?>"><i class="fa fa-users"></i>User Management</a>
                        </li>
						
						<?php } ?>
						
						 <?php if($user_data->ROLE_ID == 1)
						{ ?>
						
						<li class="<?php if(($this->uri->segment(1))=='masterdata' || ($this->uri->segment(1))=='Masterdata'){ echo 'active'; } ?> submenu">
                            <a href="#"><i class="fa fa-database" aria-hidden="true"></i> <span>Master Data Management</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display:none">
                                <li><a href="<?php echo base_url('masterdata/index/'.$session_id) ?>">Organization List</a></li>
								<li><a href="<?php echo base_url('masterdata/divisionlist/'.$session_id) ?>">Division List</a></li>
							</ul>
                        </li> 
						
						<?php } ?>
						
						<?php if($user_data->ROLE_ID == 1 || $user_data->ROLE_ID == 2 || $user_data->ROLE_ID == 5|| $user_data->ROLE_ID == 3)
						{ ?>
						<li class="<?php if(($this->uri->segment(1))=='pension' || ($this->uri->segment(1))=='Pension'){ echo 'active'; } ?> submenu">
                            <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span>Pension Management</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display:none">
                                <li><a href="<?php echo base_url('pension/index/'.$session_id) ?>">Pension List</a></li>
							</ul>
                        </li> 
                         <?php } ?>

                         <?php if($user_data->ROLE_ID == 1 || $user_data->ROLE_ID == 2 ||  $user_data->ROLE_ID == 3 ||  $user_data->ROLE_ID == 4)
						{ ?>
						<li class="<?php if(($this->uri->segment(1))=='reports' || ($this->uri->segment(1))=='Reports'){ echo 'active'; } ?> submenu">
                            <a href="#"><i class="fa fa-database" aria-hidden="true"></i> <span>Report Data Management</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display:none">
                                <li><a href="<?php echo base_url('reports/index/'.$session_id); ?>"><i class="fa fa-file"></i>Pension Reports</a>
                        		</li>
								<li><a href="<?php echo base_url('History/index/'.$session_id) ?>"><i class="fa fa-address-book"></i>Historical Data</a>
                        		</li>
                        		<li><a href="<?php echo base_url('Retirement/index/'.$session_id); ?>"><i class="fa fa-address-book"></i>Retirement Data</a>
                        		</li>
							</ul>
                        </li> 
						<?php } ?>
						
						 <?php if($user_data->ROLE_ID == 1 || $user_data->ROLE_ID == 2 ||  $user_data->ROLE_ID == 3 ||  $user_data->ROLE_ID == 4)
						{ ?>
						
						<li class="<?php if(($this->uri->segment(1))=='contacts' || ($this->uri->segment(1))=='Contacts'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url('contacts/index/'.$session_id); ?>"><i class="fa fa-address-book"></i>Manage Contacts</a>
                        </li>
						
					   <?php } ?>

					   <?php if($user_data->ROLE_ID == 1 || $user_data->ROLE_ID == 2 ||  $user_data->ROLE_ID == 3 ||  $user_data->ROLE_ID == 4)
						{ ?>
						<li class="<?php if(($this->uri->segment(1))=='internalmessage'){ echo 'active'; } ?> submenu">
                               <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> <span>Internal Messages
                             <?php 

                             	$count_unreadmsg = $this->Base_model->get_all_record_by_condition('internal_message',
							 array('delete_status'=>0,'to_email'=>$this->session->userdata('applicant_email'),'read_status'=>0));

                             	if(count($count_unreadmsg)==0)
                             	{
                             		echo '';
                             	}

                             	else
                             	{
                             		echo '  '.'<b><span style="color: #f7541d;">('.count($count_unreadmsg).')</span></b>';
                             	}
                             	

                             ?></span> <span class="menu-arrow"></span></a>

                            <ul class="list-unstyled" style="display:none">
                            	<li><a href="<?php echo base_url('internalmessage/compose_message/'.$session_id); ?>">Compose</a></li>
                            	<li><a href="<?php echo base_url('internalmessage/inbox/'.$session_id); ?>">Inbox</a></li>
								<li><a href="<?php echo base_url('internalmessage/outbox/'.$session_id); ?>">Outbox</a></li>
                               
							</ul>
                        </li>
                        <?php } ?> 
						
						
					   
						 <?php if($user_data->ROLE_ID == 1 || $user_data->ROLE_ID == 2 ||  $user_data->ROLE_ID == 3 ||  $user_data->ROLE_ID == 4)
						{ ?>
					   <li class="<?php if(($this->uri->segment(1))=='email'){ echo 'active'; } ?> submenu">
                            <a href="#"><i class="fa fa-envelope" aria-hidden="true"></i> <span>Email</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display:none">
                            	<li><a href="<?php echo base_url('email/index/'.$session_id); ?>">Send  Mail</a></li>
                                <li><a href="<?php echo base_url('email/smslist/'.$session_id); ?>">Send SMS</a></li>
                                
							</ul>
                        </li> 
                        <?php } ?>

                         <?php if($user_data->ROLE_ID == 1 || $user_data->ROLE_ID == 3)
						{ ?>

                         <li class="<?php if(($this->uri->segment(1))=='sitedata'){ echo 'active'; } ?>">
                         	<a href="<?php echo base_url('sitedata/index/'.$session_id); ?>"><i class="fa fa-database"></i>Circular</a>
                        </li>

                    <?php } ?>

                     <?php if($user_data->ROLE_ID == 1)
						{ ?>
					
                         <li class="<?php if(($this->uri->segment(1))=='logs' || ($this->uri->segment(1))=='Logs'){ echo 'active'; } ?>">
                           
                            <a href="<?php echo base_url('logs/index/'.$session_id) ?>"><i class="fa fa-users"></i>Audit Logs</a>
                        </li>
						
						<?php } ?>
                    
                 <!--    <?php //if($user_data->ROLE_ID == 4)
						{ ?>
					  	<li class="<?php //if($this->uri->segment(1)=='Certificate') { echo 'active'; } ?>">
                            <a href="<?php //echo site_url();?>Certificate"><i class="fa fa-address-book"></i>Generate Certificate</a>
                        </li>
                        <?php } ?> -->

                       

                    </ul>
                </div>
            </div>
        </div>