      <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
			
			   <ul class="nav navbar-nav navbar-right user-menu">
                <li>
                        <span class="user-img"><img class="img-circle" src="<?php echo base_url();?>assets/img/user-06.jpg" width="50" alt="Admin">
					    <span class="status online"></span></span>
                        <span class="name">User Name</span>
						<span class="links">
							<a href="<?php echo site_url();?>admin/profile"><i class="fa fa-user"></i></a>
							<a href="<?php echo site_url();?>admin/editprofile"><i class="fa fa-pencil"></i></a>
							<a href="<?php echo base_url()?>Applicant/logout"><i class="fa fa-power-off"></i></a>
					   </span>	
                </li>
               </ul> 
			
                <div id="sidebar-menu" class="sidebar-menu">
					<ul>
					
                        <li class="<?php if(($this->uri->segment(2))==''){ echo 'active'; } ?>">
                            <a href="<?php echo site_url();?>Applicant/"><i class="fa fa-dashboard"></i>Apply For Job</a>
                        </li> 
						
						<li class="<?php if(($this->uri->segment(2))=='joblist'){ echo 'active'; } ?>">
                            <a href="<?php echo site_url();?>admin/joblist"><i class="fa fa-dashboard"></i>Applied Job List</a>
                        </li> 
                     
                    </ul>
                </div>
            </div>
        </div>