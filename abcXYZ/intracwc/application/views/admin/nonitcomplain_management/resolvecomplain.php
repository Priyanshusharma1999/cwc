   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Provide Solution</h6>
								<hr>
                 <?php 
				$uri = $this->uri->segment('4'); 
				$attributes = array('class' => '', 'id' =>'solve_complain');
     			echo form_open_multipart('nonitcomplaint/solvecomplain/resolvecomplain/'.$uri,$attributes); ?>
						   
						     <div class="col-sm-6">
								<div class="form-group">
									<label>Complaint Category<span class="required">*</span></label>
							   <select  class="form-control" disabled>
								   <option value="">Select Category</option>
								   <?php foreach($complain_type as $category){?>
								    <option <?php if($complain_detail->complaint_type_id ==$category->category_id){ echo 'selected'; } ?> value="<?php echo $category->category_id;?>">
									  <?php echo $category->category_name; ?>
									</option>
								   <?php } ?>	
								</select>
								<span class="text-danger"><?php echo form_error('category');?></span>
								<input type="text" value="<?php echo $category->category_id;?>" name="category" hidden>
								</div>
                            </div>
							
							 <div class="col-sm-6">
								<div class="form-group">
								<label>Building<span class="required">*</span></label>
								<input type="text" value="<?php echo $building->building_id; ?>" name="building" hidden>
								<input class="form-control floating" type="text"  value="<?php echo $building->building_name; ?>" readonly>
								 <span class="text-danger"><?php echo form_error('building');?></span>
							</div>
                            </div>
							
							 <div class="col-sm-6">
								<div class="form-group">
								    <label>Floor<span class="required">*</span></label>
								    <input type="text" value="<?php echo $room->room_id; ?>" name="room" hidden>
									<input class="form-control floating" type="text"  value="<?php echo $room->room_name; ?>" readonly>
									 <span class="text-danger"><?php echo form_error('room');?></span>
								</div>
                            </div>
						

                            <div class="col-sm-6">
								<div class="form-group">
									<label>Name<span class="required">*</span></label>
					    <input class="form-control floating" name="empname" type="text"  value="<?php echo $complain_detail->name; ?>" readonly>
								    <span class="text-danger"><?php echo form_error('empname');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
								<label>Designation<span class="required">*</span></label>
								<input type="text" value="<?php echo $designation->designation_id; ?>" name="designation" hidden>
								<input class="form-control floating" type="text"  value="<?php echo $designation->designation_name; ?>" readonly>
								<span class="text-danger"><?php echo form_error('designation');?></span>
								</div>
                            </div>
						
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>Mobile no.<span class="required">*</span></label>
							<input class="form-control floating" name="mobile_no" type="text" placeholder="Enter Mobile No." maxlength="10" value="<?php echo $complain_detail->mobile_no; ?>" readonly>
							<span class="text-danger"><?php echo form_error('mobile_no');?></span>
								</div>
                            </div>
							
						
							<div class="col-sm-6">
								<div class="form-group">
									<label>Landline no.<span class="required">*</span></label>
								<input class="form-control floating" type="text" placeholder="Enter Landline No." name="landline_no" value="<?php echo $complain_detail->landline_no; ?>" maxlength="10" readonly>
								<span class="text-danger"><?php echo form_error('landline_no');?></span>
								</div>
                            </div>
							
							<div class="col-sm-6">
								<div class="form-group">
									<label>B.P.L. No. </label>
								<input class="form-control floating" name="intercom" type="text" placeholder="Enter B.P.L. No." value="<?php echo $complain_detail->intercom; ?>" readonly>
								</div>
                            </div>

                             <div class="col-sm-6">
								<div class="form-group" style="margin-bottom:20px;">
									<label>Description<span class="required">*</span></label>
							   <textarea class="form-control" name="description"  placeholder="Description" readonly><?php echo $complain_detail->description; ?></textarea>
							   <span class="text-danger"><?php echo form_error('description');?></span>
								</div>
                            </div>

                            <?php if($comment_history){?>
                             <div class="col-sm-12">
								<div class="form-group" >
								  <h4>Solution History</h4>
								  <?php foreach($comment_history as $comment){?> 
                                      <p> <label><?php echo $comment['name']; ?></label>
                                       <span style="margin-left:10px;"><?php echo $comment['comment']; ?></span></p>
								  <?php }?>
							   </div>
                            </div>
                        <?php } ?>

                             <div class="col-sm-6">
								<div class="form-group" style="margin-bottom:20px;">
								  <label>Provide Solution<span class="required">*</span></label>
							      <textarea class="form-control" name="solution"  placeholder="Provide solution"></textarea>
							      <span class="text-danger"><?php echo form_error('solution');?></span>
								</div>
                            </div>
						
							
                            <div class="m-t-20" style="padding-left:15px;clear:both;">
                                <button type="submit" name="submit" class="btn btn-primary">
								  Provide Solution
							    </button>
                            </div>
                        <?php echo form_close();?>
								
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
	


	<style>
		
		.form-group {
		    margin-bottom: 0;
		    min-height: 86px;
		}

	</style>