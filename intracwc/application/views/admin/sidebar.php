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
  <?php  $user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id')));
       
           foreach ($user_role_data as $role_id)
           {
                $user_roles[]= $role_id->role_id;
           }
      
          ?>
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul>
                    
                        <li class="<?php if(($this->uri->segment(1))=='admin'){ echo 'active'; } ?>" >
                            <a href="<?php echo site_url();?>admin"><i class="fa fa-dashboard"></i>Dashboard</a>
                        </li> 
                        
                        <?php if(($this->uri->segment(2))!=''){?>
                        
                        
                        
                        <li class="<?php if(($this->uri->segment(2))=='Masterdata' || ($this->uri->segment(2))=='Room' || ($this->uri->segment(2))=='Designation' || ($this->uri->segment(2))=='Office' || ($this->uri->segment(2))=='Wing' || ($this->uri->segment(2))=='Section'){ echo 'active'; } ?> submenu">
                            <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span>Master Data Registration</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display:none">
                                <li><a href="<?php echo site_url();?>Administrator/Masterdata">Building Name</a></li>
                                <li><a href="<?php echo site_url();?>Administrator/Room">Floor</a></li>
                                <li><a href="<?php echo site_url();?>Administrator/Designation">Designation</a></li>
                                <li><a href="<?php echo site_url();?>Administrator/Office">Office</a></li>
                                <li><a href="<?php echo site_url();?>Administrator/Wing">Wing Name</a></li>
                                <li><a href="<?php echo site_url();?>Administrator/Section">Section Name</a></li>
                                
                            </ul>
                        </li> 


                        <li class="<?php if(($this->uri->segment(2))=='Employee'){ echo 'active'; } ?>">
                            <a href="javascript:void(0)"><i class="fa fa-users" aria-hidden="true"></i> <span>Employee</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display:none">
                            	<li><a href="<?php echo site_url();?>Administrator/Employee">All Employee</a></li>
                                <li><a href="<?php echo site_url();?>Administrator/Employee/Nonitemployee">Non IT Employee</a></li>
                                <li><a href="<?php echo site_url();?>Administrator/Employee/Itemployee">IT Employee</a></li>
                                
			      <?php  if (in_array("15", $user_roles) || in_array("16", $user_roles) )
                 { ?>                         
                               
                 <li><a href="<?php echo site_url();?>Administrator/Employee/pendingemployee">Pending Employee</a></li>
                               <?php
                               
                 }
                 ?>
                            </ul>
                        </li> 

                         <li class="<?php if(($this->uri->segment(2))=='User'){ echo 'active'; } ?>">
                            <a href="javascript:void(0)"><i class="fa fa-users" aria-hidden="true"></i> <span>User Management</span> <span class="menu-arrow"></span></a>
                            <ul class="list-unstyled" style="display:none">
                            	<li><a href="<?php echo site_url();?>Administrator/User">All Users</a></li>
                                <li><a href="<?php echo site_url();?>Administrator/User/Nonitusers">Non IT Users</a></li>
                                <li><a href="<?php echo site_url();?>Administrator/User/Itusers">IT Users</a></li>
                                
                            </ul>
                        </li> 

                       

                          <li class="<?php if(($this->uri->segment(2))=='Role'){ echo 'active'; } ?>">
                            <a href="<?php echo site_url();?>Administrator/Role"><i class="fa fa-male"></i>Role</a>
                        </li>

                        <li class="<?php if(($this->uri->segment(1))=='logs' || ($this->uri->segment(1))=='Logs'){ echo 'active'; } ?>">
                            <a href="<?php echo base_url('logs/index/') ?>"><i class="fa fa-users"></i>Audit Logs</a>
                        </li>

                        <?php } ?>                      
                     
                    </ul>
                </div>
            </div>
        </div>