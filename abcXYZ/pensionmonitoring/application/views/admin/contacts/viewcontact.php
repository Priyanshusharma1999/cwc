    
    <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-xs-7">
                        <h4 class="page-title">View Contact Detail</h4>
                    </div>
					
                </div>
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                                    <div class="row">
                                        <div class="col-md-5">
                                            <ul class="personal-info">
                                                <li>
                                                    <span class="title">Name:</span>
                                                    <span class="text"><?php echo $contact_detail->FULLENAME; ?></span>
                                                </li>
                                                <li>
                                                    <span class="title">Designation:</span>
                                                    <span class="text"><?php echo $contact_detail->DESIGNATION; ?><span>
                                                </li>
                                                <li>
                                                    <span class="title">Office Name:</span>
                                                    <span class="text"><?php echo $contact_detail->OFFICENAME; ?></span>
                                                </li>
                                                 <li>
                                                    <span class="title">Email Id:</span>
                                                    <span class="text"><?php echo $contact_detail->EMAIL; ?></span>
                                                </li>
                                            </ul>
                                        </div>
										<div class="col-md-2"></div>
                                        <div class="col-md-5">
                                            <ul class="personal-info">
											     <li>
                                                    <span class="title">Office Address:</span>
                                                    <span class="text"><?php echo $contact_detail->OFFICE_ADDRESS; ?></span>
                                                </li>
												
                                                <li>
                                                    <span class="title">Landline No:</span>
                                                    <span class="text"><?php echo $contact_detail->LANDLINE_NO; ?></span>
                                                </li>
												
												 <li>
                                                    <span class="title">Mobile No:</span>
                                                    <span class="text"><?php echo $contact_detail->MOBILE; ?></span>
                                                </li>

                                               <!--  <li>
                                                    <span class="title">User Role:</span>
                                                    <span class="text">
                                                        <?php 
                                                        $role_data// = $this->Base_model->get_record_by_id('role',array('ROLE_ID' => $contact_detail->ROLE));
                                                        //echo $role_data->ROLE; ?></span>
                                                </li> -->
                                              
                                            </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        
        </div>
	