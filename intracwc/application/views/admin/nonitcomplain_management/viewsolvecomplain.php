   
	 <div class="page-wrapper">
			<div class="content container-fluid">
			
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" style="float:left;">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Complain</h6>
								<hr>
               
						  <div class="col-sm-6">
								<div class="form-group">
									<label>Complaint Category<span class="required">*</span></label>
							   <select  class="form-control" disabled>
								   <option value="">Select Category</option>
								   <?php foreach($complain_category as $category){?>
								    <option <?php if($complain_detail->complaint_type_id == $category->category_id){ echo 'selected'; } ?> value="<?php echo $category->category_id;?>">
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
								   <h4>Feedback & Rating</h4>
	                             
									<fieldset class="rating">
										 <input type="radio" id="star5" disabled="true" name="rating" value="5" <?php if($complain_detail->complain_rating == 5){ echo 'checked'; }?> /><label for="star5" title="Rocks!">5 star</label>
									    <input type="radio" id="star4" name="rating" disabled="true" value="4" <?php if($complain_detail->complain_rating == 4){ echo 'checked'; }?> /><label for="star4" title="Pretty good">4 stars</label>
									    <input type="radio" id="star3" name="rating" disabled="true" value="3" <?php if($complain_detail->complain_rating == 3){ echo 'checked'; }?> /><label for="star3" title="Meh">3 stars</label>
									    <input type="radio" id="star2" name="rating" disabled="true" value="2" <?php if($complain_detail->complain_rating == 2){ echo 'checked'; }?> /><label for="star2" title="Kinda bad">2 stars</label>
									    <input type="radio" id="star1" name="rating" disabled="true" value="1" <?php if($complain_detail->complain_rating == 1){ echo 'checked'; }?> />
									    <label for="star1" title="Sucks big time">1 star</label>
	                               </fieldset>
	                              
							      <p style="width: 100%;float: left;"><?php echo $complain_detail->remarks; ?></p>
								</div>
                            </div>
							
                         
								
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

		.rating {
			float:left;
		}


.rating:not(:checked) > input {
    position:absolute;
    top:-9999px;
    clip:rect(0,0,0,0);
}

.rating:not(:checked) > label {
    float:right;
    width:1em;
    padding:0 .1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:200%;
    line-height:1.2;
    color:#ddd;
    text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
}

.rating:not(:checked) > label:before {
    content: '★ ';
}

.rating > input:checked ~ label {
    color: #f70;
    text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
}



.rating > label:active {
    position:relative;
   
}
</style>

