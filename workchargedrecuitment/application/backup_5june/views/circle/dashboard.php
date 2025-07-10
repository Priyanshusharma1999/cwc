      
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
					<div class="col-md-6 col-sm-6 col-lg-3">
						<div class="dash-widget dash-widget5">
							<span class="dash-widget-icon bg-info"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
							<a href = "<?php echo site_url();?>Circle_jobs/">
							<div class="dash-widget-info">
								<h3><?php if(empty($all_jobs)) echo '0'; else echo count($all_jobs); ?></h3>
								<span style="font-size: 13px;">Total Job Post</span>
							</div>
						</a>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                            <a href = "<?php echo site_url();?>Circle_applicant_admin/">
                            <div class="dash-widget-info">
                                <h3><?php if(empty($all_applicant)) echo '0'; else echo count($all_applicant); ?></h3>
                              <span style="font-size: 13px;">Total Applicants Applied For Jobs</span>
                            </div>
                        </a>
                        </div>
                    </div>
					
                </div>
				
		    </div>
	    </div>
	
	


