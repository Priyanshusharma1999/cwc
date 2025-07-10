    
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
                                                    <span class="text">
                                                        <?php 
                                                        $user_data =  $this->Base_model->get_record_by_id('users', array('EMAIL' => $message_detail->from_email));
                                                        $org_data =  $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $user_data->ORGANIZATION_ID));
                                                        if(empty($org_data->ORGNAME))
                                                        {
                                                             echo $user_data->FULLNAME;
                                                        }
                                                        else
                                                        {
                                                            echo $user_data->FULLNAME.' , '.$org_data->ORGNAME;
                                                        } 
                                                        ?></span>
                                                </li>
												 <li style="width:48%;float:right;">
                                                    <span class="title" style="width:10%;">To:</span>
                                                    <span class="text">
                                                        <?php 
                                                        $user_data =  $this->Base_model->get_record_by_id('users', array('EMAIL' => $message_detail->to_email));
                                                        $org_data =  $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $user_data->ORGANIZATION_ID));
                                                        if(empty($org_data->ORGNAME))
                                                        {
                                                             echo $user_data->FULLNAME;
                                                        }
                                                        else
                                                        {
                                                            echo $user_data->FULLNAME.' , '.$org_data->ORGNAME;
                                                        } 
                                                        ?>
                                                    </span>
                                                </li>
												
                                                <li>
                                                    <span class="title" style="width:5%;">Subject:</span>
                                                    <span class="text"><?php echo $message_detail->subject; ?><span>
                                                </li>
												
												 <li>
                                                    <span class="title">Message:</span>
                                                   <p style="clear:both;">
  												     <?php echo $message_detail->message; ?>
													</p>
                                                    <?php 
                                                     $file = base_url().'uploads/message_files/'.$message_detail->file_name;
                                                    ?>

                                                   <a href="<?php echo $file; ?>" download>Download File</a>
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
	