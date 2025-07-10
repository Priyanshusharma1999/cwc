
    <?php $this->load->view('admin/header.php');?>
	
	 <?php $this->load->view('admin/topmenu.php');?>
	 
	<?php $this->load->view('admin/sidebar.php');?>
      
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Edit Profile</h4>
                    </div>
                </div>
                <form>
                    <div class="card-box">
                        <h3 class="card-title">Basic Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="profile-img-wrap">
                                    <img class="inline-block" src="<?php echo base_url();?>assets/img/user.jpg" alt="user">
                                    <div class="fileupload btn btn-default">
                                        <span class="btn-text">edit</span>
                                        <input class="upload" type="file">
                                    </div>
                                </div>
                                <div class="profile-basic">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="control-label">First Name</label>
                                                <input type="text" class="form-control floating">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="control-label">Last Name</label>
                                                <input type="text" class="form-control floating">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus">
                                                <label class="control-label">Birth Date</label>
                                                <div class="cal-icon">
                                                    <input class="form-control floating datetimepicker" type="text">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-focus select-focus">
                                                <label class="control-label">Gendar</label>
                                                <select class="select form-control floating">
                                                    <option>Select Gendar</option>
                                                    <option>Male</option>
                                                    <option>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-box">
                        <h3 class="card-title">Contact Informations</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group form-focus">
                                    <label class="control-label">Address</label>
                                    <input type="text" class="form-control floating">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label">State</label>
                                    <input type="text" class="form-control floating">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label">Country</label>
                                    <input type="text" class="form-control floating">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label">Pin Code</label>
                                    <input type="text" class="form-control floating">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <label class="control-label">Phone Number</label>
                                    <input type="text" class="form-control floating">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="text-center m-t-20">
                        <button class="btn btn-primary btn-lg" type="button">Save Changes</button>
                    </div>
                </form>
            </div>
      
        </div>
	
<?php $this->load->view('admin/footer.php');?>	