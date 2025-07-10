 
	
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" style="float:left;width:100%;">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View User</h6>
								<hr>
								    
                           <div class="col-sm-2">
								<div style="width: 100%;min-height:120px;margin-bottom: 0;">
									 <?php

                                        if(empty($user_data->image))
                                        {
                                            $user_pic =  base_url().'assets/img/user.jpg';
                                        }

                                        else
                                        {
                                            $user_pic = base_url().'uploads/users/'.$user_data->image;
                                        }
                                    ?>
								<div class="profile-img-wrap">
                                    <img class="inline-block" src="<?php echo $user_pic; ?>" alt="user">
                                 
                                </div>
                            </div>
                            </div>

						   <div class="col-sm-5">

						     	<div class="form-group">
									<label>User Id<span class="required"></span></label>
									<?php echo $user_data->login_id; ?>
								</div>


								<div class="form-group">
									<label>Role<span class="required"></span></label>
									
									   <?php
						                        $all_data7=array();
						                        foreach ($role_selected as $row7) {
						                        	$role_data = $this->Base_model->get_record_by_id('roles', array('role_id' => $row7->role_id));
						                            $all_data7[]=$role_data->name;
						                        }

						                         $emp_role = implode(',', $all_data7);
						                         echo $emp_role;
						                     ?>
									
								</div>

                                <div class="form-group">
									<label>Name<span class="required"></span></label>
								    <?php 

								    $desigantion_data = $this->Base_model->get_record_by_id('designation', array('designation_id' => $user_data->employee_designation));
                                    $desigantion =  $desigantion_data->designation_name;
                                	$employee_data = $this->Base_model->get_record_by_id('employee', array('employee_id' => $user_data->employee_id));
                                	echo $employee_data->employee_name.' | '.$employee_data->employee_code.' | '.$user_data->designation;
                                	?>
										  
									
								</div>

								<div class="form-group">
									<label>Display Name<span class="required"></span></label>
									<?php echo $user_data->display_name; ?>
								</div>


                                <div class="form-group">
									<label>Designation<span class="required"></span></label>
									<?php echo $user_data->designation; ?>
								</div>

								<div class="form-group">
									<label>Contact(o)<span class="required"></span></label>
									<?php echo $user_data->contact_no; ?>
								</div>

                              	<div class="form-group">
										<label>Show in Telephone Directory</label>
											<?php

											if($user_data->telephone_directory_status==1) 
											{
												echo 'Show';
											}

											else if($user_data->telephone_directory_status==0) 
											{
												echo 'Not Show';
											}

											else
											{
												echo '';
											}

										?>
											
									</div>

                            </div>


                            <div class="col-sm-5">
                            	
                            	
                               <div class="form-group">
									<label>Email<span class="required"></span></label>
									<?php echo $user_data->email; ?>
								</div>

								<div class="form-group">
									<label>Wing<span class="required"></span></label>
									 <?php 
	                                	$wing_data = $this->Base_model->get_record_by_id('wing', array('wing_id' => $user_data->wing_id));
	                                	echo $wing_data->wing_name;
                                	?>
										
								</div>

								<div class="form-group">
									<label>Section<span class="required"></span></label>
									<?php 
	                                	$section_data = $this->Base_model->get_record_by_id('section', array('section_id' => $user_data->section_id));
	                                	echo $section_data->section_name;
                                	?>
									
								</div>

								<div class="form-group">
									<label>Building<span class="required"></span></label>
									<?php 
	                                	$building_data = $this->Base_model->get_record_by_id('building', array('building_id' => $user_data->building_id));
	                                	echo $building_data->building_name;
                                	?>
									
								</div>


								<div class="form-group">
									<label>Floor<span class="required"></span></label>
									<?php 
	                                	$room_data = $this->Base_model->get_record_by_id('room_no', array('room_id' => $user_data->room_id));
	                                	echo $room_data->room_name;
                                	?>
									
								</div>

								<div class="form-group">
									<label>Status<span class="required"></span></label>
									<?php

											if($user_data->status==1) 
											{
												echo 'Active';
											}

											else if($user_data->status==0) 
											{
												echo 'Deactive';
											}

											else
											{
												echo '';
											}

										?>
								</div>

                            </div>

                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      
  <style>
    .select2-container{max-width:500px!important;} label{width:35%;}
    .form-group{

	    margin-bottom: 20px;
	    float: left;
	    width: 100%;
	    padding: 10px;
	    border: 1px solid #ccc;
	}
    
 </style>