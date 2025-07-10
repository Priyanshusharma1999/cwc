
    <?php $this->load->view('admin/header.php');?>
	
	 <?php $this->load->view('admin/topmenu.php');?>
	 
	<?php $this->load->view('admin/sidebar.php');?>
      
    <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-xs-7">
                        <h4 class="page-title">My Profile</h4>
                    </div>

                </div>
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                <div class="profile-img-wrap">
                                    <div class="profile-img">
                                        <a href="#"><img class="avatar" src="assets/img/user.jpg" alt=""></a>
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="profile-info-left">
                                                <h3 class="user-name m-t-0 m-b-0">John Doe</h3>
                                                <small class="text-muted">Admin</small>
                                                <div class="staff-id">Employee ID : FT-0001</div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Phone:</span>
                                                    <span class="text"><a href="#">9876543210</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Email:</span>
                                                    <span class="text"><a href="#">johndoe@example.com</a></span>
                                                </li>
                                                <li>
                                                    <span class="title">Birthday:</span>
                                                    <span class="text">24th July</span>
                                                </li>
                                                <li>
                                                    <span class="title">Address:</span>
                                                    <span class="text">1861 Bayonne Ave, Manchester Township, NJ, 08759</span>
                                                </li>
                                                <li>
                                                    <span class="title">Gender:</span>
                                                    <span class="text">Male</span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        
        </div>
	
<?php $this->load->view('admin/footer.php');?>	