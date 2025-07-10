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

	               <?php  if (in_array("1", $user_roles) || in_array("11", $user_roles) || in_array("12", $user_roles) || in_array("13", $user_roles) || in_array("16", $user_roles))
	                 { ?>
	                      <li class="" >
	                            <a href="<?php echo site_url();?>admin"><i class="fa fa-dashboard"></i>Dashboard</a>
	                      </li> 

	                <?php } ?>  

	                <?php

	                 $ndata = $this->Base_model->get_all_record_by_condition('tbl_notification',array('delete_status'=>'0','read_status'=>'0','service_type'=>'2'));

	                 if (in_array("13", $user_roles)) {?>

	                <li class="<?php if(($this->uri->segment(2))=='Notification'){ echo 'active'; } ?>" >
	                    <a href="<?php echo site_url();?>itonlinestationary/Notification"><i class="fa fa-bell-o"></i>Notifications <?php if(count($ndata) > 0){?> <span class="badge badge-pill bg-primary pull-right" style="background:#f00;"><?php echo count($ndata); ?></span><?php } ?></a>
	               </li> 

	                <?php } ?>  


	                <?php  if(in_array("1", $user_roles) || in_array("16", $user_roles))
	                 { ?>      

	                       <li class="<?php if(($this->uri->segment(2))=='Category' || ($this->uri->segment(2))=='Subcategory' || ($this->uri->segment(2))=='Itemtype'){ echo 'active'; } ?> submenu">
	                          <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span>Master Data Registration</span> <span class="menu-arrow"></span></a>
	                          <ul class="list-unstyled" style="display:none">
	                              <li><a href="<?php echo site_url();?>itonlinestationary/Category">Category</a></li>
	                              <li><a href="<?php echo site_url();?>itonlinestationary/Subcategory">Sub Category</a></li><!-- 
	                              <li><a href="<?php //echo site_url();?>itonlinestationary/Itemtype">Item Type</a></li> -->
	                          </ul>
	                      </li> 

	                <?php } ?>
							
	                     
	              <?php  if(in_array("1", $user_roles) || in_array("16", $user_roles) || in_array("12", $user_roles) || in_array("13", $user_roles))
	                 { ?>  
	        			<li class="<?php if(($this->uri->segment(2))=='item'){ echo 'active'; } ?>" >
	                         <a href="<?php echo site_url();?>itonlinestationary/item">
	        					<i class="fa fa-dashboard"></i>Item List Management
	        				</a>
	                    </li> 
	              <?php } ?>  


	                 <?php  if (in_array("1", $user_roles) || in_array("11", $user_roles) || in_array("16", $user_roles))
	                 { ?>      

	                       <li class="<?php if(($this->uri->segment(2))=='Returnitems'){ echo 'active'; } ?> submenu">
	                          <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span>Return Items</span> <span class="menu-arrow"></span></a>
	                          <ul class="list-unstyled" style="display:none">

	                           <?php  if (in_array("1", $user_roles) || in_array("16", $user_roles))
	                            { ?>   

	                              <li><a href="<?php echo site_url();?>itonlinestationary/Returnitems">Defected Items</a></li>

	                           <?php } ?>     

	                              <?php  if (in_array("11", $user_roles))
	                               { ?>  

	                              <li><a href="<?php echo site_url();?>itonlinestationary/Returnitems/returnitem">Return Items</a></li>

	                              <?php } ?>

	                          </ul>
	                      </li> 

	                <?php } ?>

	               <?php  if (in_array("1", $user_roles) || in_array("12", $user_roles) || in_array("13", $user_roles) || in_array("11", $user_roles) || in_array("16", $user_roles))
	                 { ?>      

	                       <li class="<?php if(($this->uri->segment(2))=='Handoveritems'){ echo 'active'; } ?> submenu">
	                          <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span>Handover Items</span> <span class="menu-arrow"></span></a>
	                          <ul class="list-unstyled" style="display:none">
	                              <li><a href="<?php echo site_url();?>itonlinestationary/Handoveritems">Handover Items List</a></li>

	                          <?php  if (in_array("11", $user_roles))
	                           { ?>    
	                            
	                             <li><a href="<?php echo site_url();?>itonlinestationary/Handoveritems/handover">Handover</a></li>
	                          
	                            <?php } ?>

	                          </ul>
	                      </li> 

	                <?php } ?>

	                <?php if(in_array("11", $user_roles))
	                 { ?>      

	                       <li class="<?php if(($this->uri->segment(2))=='Recievehandover'){ echo 'active'; } ?> submenu">
	                          <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span>Recieve Handover</span> <span class="menu-arrow"></span></a>
	                          <ul class="list-unstyled" style="display:none">
	                            <li><a href="<?php echo site_url();?>itonlinestationary/Recievehandover">Items List</a></li>
	                          </ul>
	                      </li> 

	                <?php } ?>


	               <?php  if(in_array("11", $user_roles))
	                 { ?>   
	                  
	      				<li class="<?php if(($this->uri->segment(2))=='Requisition'){ echo 'active'; } ?>" >
	                           <a href="<?php echo site_url();?>itonlinestationary/Requisition">
	      							 <i class="fa fa-dashboard"></i>Requisition
	      						</a>
	                    </li> 

	                <?php } ?>   

	                 <?php  if (in_array("13", $user_roles))
	                 { ?>   
						   
						         <li class="<?php if(($this->uri->segment(2))=='approverequisition'){ echo 'active'; } ?>" >
	                            <a href="<?php echo site_url();?>itonlinestationary/approverequisition"><i class="fa fa-dashboard"></i>Approve Requisition</a>
	                    </li>

	                <?php } ?>


	               <?php  if (in_array("1", $user_roles) || in_array("16", $user_roles))
	                 { ?> 
	                   
							        <li class="<?php if(($this->uri->segment(2))=='bill'){ echo 'active'; } ?>" >
	                       <a href="<?php echo site_url();?>itonlinestationary/bill"><i class="fa fa-dashboard"></i>Bill/Challan</a>
	                    </li> 
	                    
	                <?php } ?>

		         <?php  if (in_array("12", $user_roles))
		             { ?>
		               
						<li class="<?php if(($this->uri->segment(2))=='osradmin'){ echo 'active'; } ?> submenu">
		                  <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span>OSR Admin</span> <span class="menu-arrow"></span></a>
		                 <ul class="list-unstyled" style="display:none">
		                   <li><a href="<?php echo site_url();?>itonlinestationary/osradmin">Physical Issue</a></li>
						  <li><a href="<?php echo site_url();?>itonlinestationary/osradmin/proxylist">Proxy Entry</a></li>
					    </ul>
		              </li> 

		          <?php } ?>

		       <?php  if (in_array("1", $user_roles) || in_array("12", $user_roles) || in_array("16", $user_roles))
		           { ?>
								
					    <li class="<?php if(($this->uri->segment(2))=='report'){ echo 'active'; } ?> submenu">
		            <a href="#"><i class="fa fa-cog" aria-hidden="true"></i> <span>Report</span> <span class="menu-arrow"></span></a>
		            <ul class="list-unstyled" style="display:none">
		              <li><a href="<?php echo site_url();?>itonlinestationary/report/">Requisition Report</a></li>
		              <li><a href="<?php echo site_url();?>itonlinestationary/report/proxylist">Proxy Report</a></li>
		              <li><a href="<?php echo site_url();?>itonlinestationary/report/approvelist">Approve Report</a></li>
		              <li><a href="<?php echo site_url();?>itonlinestationary/report/Issuelist">Issued Item Report</a></li>
		              <li><a href="<?php echo site_url();?>itonlinestationary/report/directorateitem">Directorate Item Report</a></li>
		              <li><a href="<?php echo site_url();?>itonlinestationary/report/itemhistoryreport">Historical Item Report</a></li>
		            </ul>
		         </li>  

		        <?php } ?>

              </ul>

            </div>

            </div>
        </div>