 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="page-title">Send SMS</h4>
                    </div>
					
                </div>
                <div class="row">
                    <div class="col-xs-12">
					
					<?php if($this->session->flashdata('flashError_sms')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_sms'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>
					
                        <div class="card-box">
                           <?php
					 	$attributes = array('class' => '', 'id' =>'send_sms');
     					echo form_open_multipart('email/send_sms/',$attributes);?>
						
                                <div class="form-group">
								   <select class="form-control" name="mobile_no">
								     <option value="" selected>Select User</option>
									 <?php foreach($users_list as $users){?>
                                     <?php 

                                        if($users->ROLE_ID == 1)
                                        {
                                            $role = 'Super Admin';
                                        } 

                                        else if($users->ROLE_ID == 2)
                                        {
                                            $role = 'Organization Admin';
                                        } 

                                        else if($users->ROLE_ID == 3)
                                        {
                                            $role = 'PAO Admin';
                                        } 

                                        else
                                        {
                                            $role = 'Division Admin';
                                        } 
 
 

 
                                     ?>
									  <option value="<?php echo $users->MOBILE; ?>">
									     <?php echo $users->FULLNAME.','.$role; ?>
									  </option>
									 <?php } ?>
								   </select>
									<span class = "text-danger"><?php echo form_error('mobile_no');?></span>
                                </div>
                               
                                <div class="form-group">
                                    <textarea rows="4" cols="5" name="message" class="form-control" placeholder="Enter your message here"></textarea>
									<span class = "text-danger"><?php echo form_error('message');?></span>
                                </div>
                                <div class="form-group m-b-0">
                                    <div class="text-center">
                                        <button class="btn btn-primary" type="submit" name="submit">
										  <span>Send</span> <i class="fa fa-send m-l-5"></i>
										 </button>
                                    </div>
                                </div>
                             <?php echo form_close();?>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
		
		