 
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-xs-12">
                        <h4 class="page-title">Compose</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
					
					<?php if($this->session->flashdata('flashError_message')) { ?>
						<div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_message'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
						<?php } ?>
					
                        <div class="card-box">
                           <?php
                            $user_ssionid =  $this->session->userdata('applicant_user_id'); 
    					 	$attributes = array('class' => '', 'id' =>'send_message');
         					echo form_open_multipart('internalmessage/compose_message/'.$user_ssionid,$attributes);?>
						
                                <div class="form-group">
                                    <select class="form-control" name="to_mail">
                                       <option value="" selected>Select User</option>
                                       <?php foreach($user_list as $users){ $org_data =  $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $users->ORGANIZATION_ID));?>
                                         <option value="<?php echo $users->EMAIL; ?>">
                                           <?php 

                                            if(empty($org_data->ORGNAME))
                                            {
                                                 echo $users->FULLNAME;
                                            }
                                            else
                                            {
                                                echo $users->FULLNAME.' , '.$org_data->ORGNAME;
                                            } 

                                            ?>
                                         </option>
                                       <?php } ?>
                                    </select>
                                    <span class = "text-danger"><?php echo form_error('to_mail');?></span>
                                </div>
                                
                                <div class="form-group">
                                    <input type="text" name="subject" placeholder="Subject" class="form-control">
									<span class = "text-danger"><?php echo form_error('subject');?></span>
                                </div>
                                <div class="form-group">
                                    <textarea rows="4" cols="5" name="message" class="form-control summernote" placeholder="Enter your message here"></textarea>
									<span class = "text-danger"><?php echo form_error('message');?></span>
                                </div>
                                <div class="form-group">
                                    <label>
                                       Attach File (only jpg, png, pdf files allowed)
                                     </label>
                                    <input type="file" accept="image/*,application/pdf,application/msword,
  .csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,application/zip,application/x-zip,application/x-zip-compressed" name="attach_file" >
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
		
		<style>
          .note-insert, .note-view{display:none;}
          .note-editor.note-frame{margin-bottom:0;}
        </style>
        