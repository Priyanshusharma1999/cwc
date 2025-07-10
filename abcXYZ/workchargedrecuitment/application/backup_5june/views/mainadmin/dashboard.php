      
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
					<div class="col-md-6 col-sm-6 col-lg-3">
						<div class="dash-widget dash-widget5">
							<a href = "<?php echo site_url();?>Jobs/">
							<span class="dash-widget-icon bg-info"><i class="fa fa-briefcase" aria-hidden="true"></i></span>
							<div class="dash-widget-info">
								<h3><?php echo count($all_jobs); ?></h3>
								<span style="font-size: 13px;">Total Job Post</span>
							</div>
						</a>
						</div>
					</div>
					<div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                        	<a href = "<?php echo site_url();?>Applicant_admin/">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($all_applicant); ?></h3>
                                <span style="font-size: 13px;">Total Applicants Applied For Jobs</span>
                            </div>
                        </a>
                        </div>
                    </div>
					
                </div>
				
		    </div>
	    </div>
	
	


