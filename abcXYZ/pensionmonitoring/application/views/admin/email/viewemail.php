    
    <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-xs-7">
                        <h4 class="page-title">View Mail</h4>
                    </div>
					
                </div>
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <ul class="personal-info">
                                                <li style="width:48%;margin-right:20px;">
                                                    <span class="title" style="width:10%;">From:</span>
                                                    <span class="text"><?php echo $mail_detail->from_email; ?></span>
                                                </li>
												 <li style="width:48%;float:right;">
                                                    <span class="title" style="width:10%;">To:</span>
                                                    <span class="text"><?php echo $mail_detail->to_email; ?></span>
                                                </li>
												
                                                <li>
                                                    <span class="title" style="width:5%;">Subject:</span>
                                                    <span class="text"><?php echo $mail_detail->subject; ?><span>
                                                </li>
												
												 <li>
                                                    <span class="title">Message:</span>
                                                   <p style="clear:both;">
  												     <?php echo $mail_detail->message; ?>
													</p>
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
	