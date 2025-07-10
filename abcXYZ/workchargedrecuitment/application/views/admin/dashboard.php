  
    
        <div class="page-wrapper">
            <div class="content container-fluid">

              <?php if($this->session->flashdata('flashSuccess_applied_job')) { ?>
        <div class='alert alert-success'> <?php echo $this->session->flashdata('flashSuccess_applied_job');?> 
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div>
        <?php } ?>

        <?php if($this->session->flashdata('flashError_applied_job')) { ?>
        <div class='alert alert-danger' > <?php echo $this->session->flashdata('flashError_applied_job'); ?> 
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> </div> </div>
        <?php } ?>

       <?php
        $attributes = array('class' => '', 'id' =>'applicannnt_logginn');
          echo form_open_multipart('Applicant/job_apply/',$attributes);?>

         <div class="row">
        
           <div class="col-lg-2"></div>
           <div class="col-lg-8">
              <div class="card-box">
                  <div class="card-block" id = "apppllyy_job">
                        
                <h3 style="text-align: center;margin-bottom: 40px;margin-top: 10px;">Apply For Job</h3>
                
                  <div class="form-group">
                  <label class="control-label">Preferred Region<span class="required">*</span></label>
                  <select id = "region_name" name = "region_name" required="required"  class="form-control" onchange="remove_errors2('error_11')">
                     <option selected="selected" value="">Select Preferred Region</option>
                     <?php
                      $all_data5[] = $all_job_Applied_data['region_name'];

                    foreach ($all_regions as $rows5 ) {  ?>
                      <option value="<?php echo $rows5->id; ?>"
                    <?php 
                      echo (isset($all_job_Applied_data['region_name']) && in_array($rows5->id,$all_data5) ) ? "selected" : "" ?> ><?php echo $rows5->region_name; ?>
                    </option>
                    <?php } ?>
                    
                  </select>
                  <span class="error_11"></span>
                   </div> 
                   
                   <div class="form-group">
                  <label class="control-label">Circle Office<span class="required">*</span></label>
                  <select id = "circle_name" name = "circle_name" required="required" class="form-control" onchange="remove_errors2('error_12')">
                    <option selected="selected" value="" onchange="remove_errors2()">Select Circle
                      <?php
                      $all_data6[] = $all_job_Applied_data['circle_name'];

                    foreach ($all_circle as $rows6 ) {  ?>
                      <option value="<?php echo $rows6->id; ?>"
                    <?php 
                      echo (isset($all_job_Applied_data['circle_name']) && in_array($rows6->id,$all_data6) ) ? "selected" : "" ?> ><?php echo $rows6->circle_name; ?>
                    </option>
                    <?php } ?>
                    </option>
                    
                  </select>
                  <span class="error_12"></span>
                  </div>
                  
                  <div class="form-group">
                  <label class="control-label">Skilled Applied For<span class="required">*</span></label>
                  <select id = "skilled_name" name = "skilled_name"  required="required" class="form-control" onchange="remove_errors2('error_13')">
                      <option selected="selected" value="">Select Skills
                        <?php
                      $all_data7[] = $all_job_Applied_data['skilled_name'];

                    foreach ($all_jobs as $rows7 ) {  ?>
                      <option value="<?php echo $rows7->id; ?>"
                    <?php 
                      echo (isset($all_job_Applied_data['skilled_name']) && in_array($rows7->id,$all_data7) ) ? "selected" : "" ?> ><?php echo $rows7->job_title; ?>
                    </option>
                    <?php } ?>
                      </option>
                    
                  </select>
                  <span class="error_13"></span>
                  </div>
                  
                  <div class="form-group">
                  <label class="control-label">Post Code<span class="required">*</span></label>
                  <input id = "post_code" type="text" name = "post_code" class="form-control" placeholder="Post Code" required="required" onkeyup="remove_errors('error_14')" value = "<?php echo $all_job_Applied_data['post_code']; ?>"  readonly />
                  <span class="error_14 error"></span>
                  </div>
                
                   <div class="form-group">
                  <label class="control-label">Total Vacancy<span class="required">*</span></label>
                  <input id = "total_vacancy" type="text" name = "total_vacancy" class="form-control" placeholder="Total Vacancy" onkeyup="remove_errors('error_73')" value = "<?php echo $all_job_Applied_data['total_vacancy']; ?>"   readonly />
                  <span class="error_73 error"></span>
                  
                  </div>                  
                   <div class="form-group text-center">
                    
                <button class="btn btn-primary nextBtn btn-block btn-pd" type="submit">Proceed</button>
                  </div>
                   
                
                
              </div>
               
            </div>
             
          </div>    
            
     </div>
        
        <div class="row">
           <div class="col-lg-12">
            <div class="form-container" style="display:none;">  

               <div class="panel panel-primary">
            <div class="panel-heading">
               <h3 class="panel-title">Job Apply For</h3>
            </div>
            
            <div class="panel-body">
            
               <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label" style="min-width:110px;">Prefered Region</label>
                <span id = "span_region" ></span>
              </div>
               </div>
               
               <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label" style="min-width:110px;">Circle Office</label>
                <span id = "span_circle"></span>
              </div>
               </div> 
               
               <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label" style="min-width:110px;">Skilled Applied For</label>
                <span id = "span_skill"></span>
              </div>
               </div>
               
               <div class="col-sm-6">
              <div class="form-group">
                <label class="control-label" style="min-width:110px;">Post Code</label>
                <span id = "span_post_code"></span>
              </div>
               </div>
               
            </div>
            
          </div>
            
              <div class="stepwizard">
                <div class="stepwizard-row setup-panel">
                
                  <div class="stepwizard-step"> 
                    <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                    <p><small>Basic Information</small></p>
                  </div>
                  
                  <div class="stepwizard-step"> 
                  <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">
                    2
                  </a>
                  <p><small>Educational Details</small></p>
                  </div>
                  
                  <div class="stepwizard-step"> 
                  <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">
                    3
                  </a>
                  <p><small>Other Details</small></p>
                  </div>
                  
                  <div class="stepwizard-step"> 
                  <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">
                    4
                  </a>
                  <p><small>Upload Document</small></p>
                  </div>
                  
                  
                </div>
               </div>
              
                <div class="panel panel-primary setup-content" id="step-1">
                  <div class="panel-heading">
                     <h3 class="panel-title">Basic Information</h3>
                  </div>
                  
                  <div class="panel-body">
                  
                     <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Full Name<span class="required">*</span></label>
                      <input type="text" id = "full_name" name = "full_name" required="required" value = "<?php if($all_job_Applied_data['full_name']) echo $all_job_Applied_data['full_name']; else echo isset($insertData['full_name']) ? $insertData['full_name'] : ''; ?>" class="form-control" placeholder="Enter Full Name"  readonly />
                      <span class="error_21 error"></span>
                      
                    </div>
                     </div>
                     
                     <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Father's Name</label>
                    <input type="text" id = "father_name" name = "father_name" required="required"  class="form-control" placeholder="Enter Father's Name" onkeyup="remove_errors('error_22')" value = "<?php if($all_job_Applied_data['father_name']) echo $all_job_Applied_data['father_name']; else echo ''; ?>" />
                    <span class="error_22 error"></span>
                    
                    </div>
                     </div> 
                     
                     <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Email Id<span class="required">*</span></label>
                      <input type="email" id = "email" name = "email" required="required" value = "<?php if($all_job_Applied_data['email']) echo $all_job_Applied_data['email']; else echo isset($insertData['email']) ? $insertData['email'] : ''; ?>" class="form-control" placeholder="Enter Email Id" readonly/>
                      <span class="error_23 error"></span>
                      
                    </div>
                     </div>
                     
                     <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Mobile No.<span class="required">*</span></label>
                      <input type="text" id = "mobile_no" name = "mobile_no" value = "<?php if($all_job_Applied_data['mobile_no']) echo $all_job_Applied_data['mobile_no']; else echo isset($insertData['mobile_no']) ? $insertData['mobile_no'] : ''; ?>" required="required" class="form-control"  placeholder="Enter Mobile No."  maxlength="20" readonly />
                      <span class="error_24 error"></span>
                    </div>
                     </div>
                     
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Date Of Birth</label>
                 
                          <input name = "dob" id = "dob" class="form-control" onkeyup="remove_errors('error_25')" placeholder="dd/mm/yy" type="date" value = "<?php if($all_job_Applied_data['dob']) echo $all_job_Applied_data['dob']; else echo isset($insertData['dob']) ? $insertData['dob'] : ''; ?>" required="required">
                         <span class="error_25 error"></span>
                   
                      </div>
                    </div>
                      
                      <?php

                        if($all_job_Applied_data['gender'])
                        {
                          $gender =  $all_job_Applied_data['gender'];
                        }

                        else
                        {
                          $gender = $insertData['gender'];
                        }
                      ?>
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Gender</label>
                        <select id = "gender" name = "gender" required="required" class="form-control" readonly>
                           <option value="">Select Gender</option>
                           <option value="Male" <?php if($gender == 'Male') echo 'selected="selected"' ?>>Male</option>
                           <option value="Female" <?php if($gender == 'Female') echo 'selected="selected"' ?>>Female</option>
                           <option value="Trans Gender" <?php if($gender == 'Trans Gender') echo 'selected="selected"' ?>>Trans Gender</option>
                        </select>
                        <span class="error_26 error"></span>
                        
                      </div>
                    </div>
                     
                    <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-9">
                        <button class="btn btn-danger startBtn" type="button">Back</button>
                      </div>
                        <div class="col-sm-3">
                        <button class="btn btn-primary nextBtn pull-right " type="button">Save and Continue</button>
                        </div>
                        
                    </div>
                  </div>
                  
                </div>
                
                <div class="panel panel-primary setup-content" id="step-2">
                  <div class="panel-heading">
                     <h3 class="panel-title">Educational Details</h3>
                  </div>
                  
                  <div class="panel-body">

                  <h3 class="notice">Educational qualifications details(First row of education details is mandatory for all applicants)</h3>

                  <p><strong>Note:</strong></p>

                  <p>
                  1) Candidate having maximum marks have to fill two columns(i.e, Column of Maximum Marks & Column of Marks Obtained)
                   </p>

                  <p style="margin-bottom:30px;">
                  2) Candidate having grade points may fill Percentage of Marks columns only after conversion of SGPA/CGPA etc. into percentage of marks.
                  </p>

                    <div class="row-ed">
                    <div class="col-sm-2 nopadding">
                      <?php

                          if($all_job_Applied_data['highschool_metriculation'])
                          {
                            $highschool_metriculation =  $all_job_Applied_data['highschool_metriculation'];
                          }

                          else
                          {
                            $highschool_metriculation = '';
                          }
                      ?>
                      <div class="form-group">
                         <label class="control-label">Exam Passed<span class="required">*</span></label> 
                        <select  id ="highschool_metriculation" name = "highschool_metriculation" required="required" class="form-control" onchange="remove_errors2('error_71')">
                           <option value="">Select Exam Passed</option>
                         
                           <option value="Metriculation" <?php if($highschool_metriculation == 'Metriculation') echo 'selected="selected"' ?>>Metriculation</option>
                           
                           <option value="ITI" <?php if($highschool_metriculation == 'ITI') echo 'selected="selected"' ?>>ITI</option>
                        
                        </select>
                        <span class="error_71 error"></span>
                      </div>
                    </div>

                     <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <label class="control-label ed-label">Name of Board/University</label>
                        <input type="text" id = "highschool_board_name" name = "highschool_board_name" required="required" class="form-control" placeholder="Board Name" onkeyup="remove_errors('error_27')" value= "<?php if($all_job_Applied_data['highschool_board_name']) echo $all_job_Applied_data['highschool_board_name']; else echo ''; ?>" />
                        <span class="error_27 error"></span>
                      </div>
                    </div>
                    
                    <?php

                          if($all_job_Applied_data['highschool_passing_year'])
                          {
                            $highschool_passing_year =  $all_job_Applied_data['highschool_passing_year'];
                          }

                          else
                          {
                            $highschool_passing_year = '';
                          }
                      ?>

                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <label class="control-label ed-label">Passing Year</label>
                        <select  id ="highschool_passing_year" name = "highschool_passing_year" required="required" class="form-control" onchange="remove_errors2('error_28')">
                           <option value="">Select Year</option>
                        </select>
                        <span class="error_28 error"></span>
                      </div>
                    </div>

                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <label class="control-label ed-label"> Type </label>
                        <select  id ="percentage_type" name = "percentage_type" required="required" class="form-control" >
                           <option value="">Select</option>
                           <option value="Percentage" >Percentage </option>
                           <option value="Grade">Grade</option>
                        </select>
                        
                        
                      </div>
                    </div>
                    
                  <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <label class="control-label ed-label">Maximum Marks</label>
                        <input type="text" id = "highschool_total_marks" name = "highschool_total_marks"  class="form-control" placeholder="Total Marks" maxlength="4" onkeyup="remove_errors('error_29')" value= "<?php if($all_job_Applied_data['highschool_total_marks']) echo $all_job_Applied_data['highschool_total_marks']; else echo ''; ?>" />
                        <span class="error_29 error"></span>
                      </div>
                      
                    </div>
                    
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <label class="control-label ed-label">Marks Obtained</label>
                        <input type="text" id = "highschool_marks_obtained" name = "highschool_marks_obtained"  class="form-control" placeholder="Marks Obtained" maxlength="4" onkeyup="remove_errors('error_30')" value= "<?php if($all_job_Applied_data['highschool_marks_obtained']) echo $all_job_Applied_data['highschool_marks_obtained']; else echo ''; ?>" />
                        <span class="error_30 error"></span>
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <label class="control-label ed-label">Percentage</label>
                        <input type="text" id = "highschool_percentage" name = "highschool_percentage" required="required" class="form-control" placeholder="%" maxlength="5" onkeyup="remove_errors('error_31')" value= "<?php if($all_job_Applied_data['highschool_percentage']) echo $all_job_Applied_data['highschool_percentage']; else echo ''; ?>"  />
                        <span class="error_31 error"></span>
                      </div>
                    </div>
                    
                    
                    </div>
                    
                    
                    <div class="row-ed">

                    <div class="col-sm-2 nopadding">
                      <div class="form-group">  
                        <input type="text" id = "" name = "" class="form-control" placeholder="Others" readonly/>
                      </div>
                    </div>

                     <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "graduation_qualification" name = "graduation_qualification" class="form-control" placeholder="University Name" value= "<?php if($all_job_Applied_data['graduation_qualification']) echo $all_job_Applied_data['graduation_qualification']; else echo ''; ?>" />
                        <span class="error_37 error"></span>
                      </div>
                    </div>
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
               
                        <select  id ="graduation_passing_year" name = "graduation_passing_year"  class="form-control">
                           <option value="">Select Year</option>
                        </select>
                        <span class="error_38 error"></span>
                      </div>
                    </div>
                    
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        
                        <select  id ="percentage_type1" name = "percentage_type1" class="form-control">
                           <option value="">Select</option>
                           <option value="Percentage">Percentage</option>
                           <option value="Grade">Grade</option>
                        </select>
                        
                        
                      </div>
                    </div>
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text"  id ="graduation_total_marks" name = "graduation_total_marks" class="form-control" placeholder="Total Marks" maxlength="4" value= "<?php if($all_job_Applied_data['graduation_total_marks']) echo $all_job_Applied_data['graduation_total_marks']; else echo ''; ?>" />
                        <span class="error_39 error"></span>
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text"  id = "graduation_marks_obtained" name = "graduation_marks_obtained" class="form-control" placeholder="Marks Obtained" maxlength="4" value= "<?php if($all_job_Applied_data['graduation_marks_obtained']) echo $all_job_Applied_data['graduation_marks_obtained']; else echo ''; ?>" />
                        <span class="error_40 error"></span>
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <input type="text" id = "graduation_percentage" name = "graduation_percentage" class="form-control" placeholder="%" maxlength="5" value= "<?php if($all_job_Applied_data['graduation_percentage']) echo $all_job_Applied_data['graduation_percentage']; else echo ''; ?>" />
                        <span class="error_41 error"></span>
                      </div>
                    </div>
                    
                    </div>
                    
                    
                    <div class="row-ed">
                    <div class="col-sm-2 nopadding">
                      <div class="form-group">
                        <input type="text" id = "" name = "" class="form-control" placeholder="Others" readonly/>
                      </div>
                    </div>

                     <div class="col-sm-2 padding-5">
                      <div class="form-group">
                      <input type="text" id = "post_graduation_qualification" name = "post_graduation_qualification"  class="form-control" placeholder="University Name" value= "<?php if($all_job_Applied_data['post_graduation_qualification']) echo $all_job_Applied_data['post_graduation_qualification']; else echo ''; ?>" />
                      </div>
                    </div>
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                      
                        <select  id ="post_graduation_passing_year" name = "post_graduation_passing_year" class="form-control">
                           <option value="">Select Year</option>
                        </select>
                        <span class="error_42 error"></span>
                      </div>
                    </div>
                    
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        
                        <select  id ="percentage_type2" name = "percentage_type2"  class="form-control">
                           <option value="">Select</option>
                           <option value="Percentage">Percentage</option>
                           <option value="Grade">Grade</option>
                        </select>
                        
                        
                      </div>
                    </div>

                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text"  id = "post_graduation_total_marks" name = "post_graduation_total_marks" class="form-control" placeholder="Total Marks" maxlength="4" value= "<?php if($all_job_Applied_data['post_graduation_total_marks']) echo $all_job_Applied_data['post_graduation_total_marks']; else echo ''; ?>" />
                        <span class="error_43 error"></span>
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text"  id = "post_graduation_marks_obtained" name = "post_graduation_marks_obtained" class="form-control" placeholder="Marks Obtained" maxlength="4" value= "<?php if($all_job_Applied_data['post_graduation_marks_obtained']) echo $all_job_Applied_data['post_graduation_marks_obtained']; else echo ''; ?>" />
                        <span class="error_44 error"></span>
                      </div>
                    </div>
                    
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <input type="text" id = "post_graduation_percentage" name = "post_graduation_percentage" value= "<?php if($all_job_Applied_data['post_graduation_percentage']) echo $all_job_Applied_data['post_graduation_percentage']; else echo ''; ?>"  class="form-control" placeholder="%" maxlength="5" />
                        <span class="error_45 error"></span>
                      </div>
                    </div>
                    
                    </div>
                    
                    
                    <div class="row-ed">
                    <div class="col-sm-2 nopadding">
                      <div class="form-group" >
                        <input type="text" id = "" name = "" class="form-control" placeholder="Others" readonly/>
                      </div>
                    </div>

                     <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "others_qualification" name = "others_qualification" class="form-control" placeholder="Institute Name" value= "<?php if($all_job_Applied_data['others_qualification']) echo $all_job_Applied_data['others_qualification']; else echo ''; ?>" />
                      </div>
                    </div>
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <select  id ="others_passing_year" name = "others_passing_year"  class="form-control">
                           <option value="">Select Year</option>
                        </select>
                        <span class="error_46 error"></span>
                      </div>
                    </div>
                  
                    
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        
                        <select  id ="percentage_type3" name = "percentage_type3"  class="form-control">
                           <option value="">Select</option>
                           <option value="Percentage">Percentage</option>
                           <option value="Grade">Grade</option>
                        </select>
                        
                        
                      </div>
                    </div>

                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "others_total_marks" name = "others_total_marks" value= "<?php if($all_job_Applied_data['others_total_marks']) echo $all_job_Applied_data['others_total_marks']; else echo ''; ?>" class="form-control" placeholder="Total Marks" maxlength="4" />
                        <span class="error_47 error"></span>
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "others_marks_obtained" name = "others_marks_obtained" value= "<?php if($all_job_Applied_data['others_marks_obtained']) echo $all_job_Applied_data['others_marks_obtained']; else echo ''; ?>" class="form-control" placeholder="Marks Obtained" maxlength="4" />
                      </div>
                      <span class="error_48 error"></span>
                    </div>
                    
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <input type="text" id = "others_percentage" name = "others_percentage" value= "<?php if($all_job_Applied_data['others_percentage']) echo $all_job_Applied_data['others_percentage']; else echo ''; ?>"  class="form-control" placeholder="%" maxlength="5" />
                        <span class="error_49 error"></span>
                      </div>
                    </div>
                    
                    </div>
                    <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-9 col-xs-3">
                        <button class="btn btn-danger backBtn" type="button">Back</button>
                      </div>
                        <div class="col-sm-3 col-xs-9">
                            <!-- <button class="btn btn-primary pull-left" type="button">Save</button> -->
                        <button class="btn btn-primary nextBtn pull-right " type="button">Save and Continue</button>
                        </div>
                    </div>
                  </div>
                </div>
                
                <div class="panel panel-primary setup-content" id="step-3">
                  <div class="panel-heading">
                     <h3 class="panel-title">Other Details</h3>
                  </div>
                  <div class="panel-body">
                  
                     <?php

                      if($all_job_Applied_data['caste_category'])
                      {
                        $caste_category =  $all_job_Applied_data['caste_category'];
                      }

                      else
                      {
                        $caste_category = '';
                      }
                    ?>

                     <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Category<span class="required">*</span></label>
                        <select  id ="caste_category" name = "caste_category" required="required" class="form-control" onchange="remove_errors2('error_50')">
                           <option value="">Select Category</option>
                           <option value="General" <?php if($caste_category == 'General') echo 'selected="selected"' ?>>General</option>
                           <option value="OBC" <?php if($caste_category == 'OBC') echo 'selected="selected"' ?>>OBC</option>
                           <option value="SC" <?php if($caste_category == 'SC') echo 'selected="selected"' ?>>SC</option>
                           <option value="ST" <?php if($caste_category == 'ST') echo 'selected="selected"' ?>>ST</option>
                           <option value="Others" <?php if($caste_category == 'Others') echo 'selected="selected"' ?>>Others</option>
                        </select>
                        <span class="error_50 error"></span>
                      </div>
                    </div>  
                    
                    <?php

                      if($all_job_Applied_data['religion'])
                      {
                        $religion =  $all_job_Applied_data['religion'];
                      }

                      else
                      {
                        $religion = '';
                      }
                    ?>

                      <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Religion<span class="required">*</span></label>
                        <select  id = "religion" name = "religion" required="required" class="form-control" onchange="remove_errors2('error_51')">
                           <option value="">Select Religion</option>
                           <option value="Hindu" <?php if($religion == 'Hindu') echo 'selected="selected"' ?>>Hindu</option>
                           <option value="Muslim" <?php if($religion == 'Muslim') echo 'selected="selected"' ?>>Muslim</option>
                           <option value="Sikh" <?php if($religion == 'Sikh') echo 'selected="selected"' ?>>Sikh</option>
                           <option value="Christians" <?php if($religion == 'Christians') echo 'selected="selected"' ?>>Christians</option>
                           <option value="Other" <?php if($religion == 'Other') echo 'selected="selected"' ?>>Other</option>
                        </select>
                        <span class="error_51 error"></span>
                      </div>
                    </div>  
                    
                    <?php

                      if($all_job_Applied_data['marital_status'])
                      {
                        $marital_status =  $all_job_Applied_data['marital_status'];
                      }

                      else
                      {
                        $marital_status = '';
                      }
                    ?>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Marital Status<span class="required">*</span></label>
                        <select id ="marital_status" name = "marital_status" required="required" class="form-control" onchange="remove_errors2('error_52')">
                           <option value="">Select status</option>
                           <option value="Married" <?php if($marital_status == 'Married') echo 'selected="selected"' ?>>Married</option>
                           <option value="Unmarried" <?php if($marital_status == 'Unmarried') echo 'selected="selected"' ?>>Unmarried</option>
                        </select>
                        <span class="error_52 error"></span>
                      </div>
                    </div>

                    <?php

                      if($all_job_Applied_data['nationality'])
                      {
                        $nationality =  $all_job_Applied_data['nationality'];
                      }

                      else
                      {
                        $nationality = '';
                      }
                    ?>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Nationality</label>
                        <select id ="nationality" name = "nationality" required="required" class="form-control" onchange="remove_errors2('error_53')">
                           <option value="">Select Nationality</option>
                           <option value="Indian" <?php if($nationality == 'Indian') echo 'selected="selected"' ?>>Indian</option>
                           <option value="Others" <?php if($nationality == 'Others') echo 'selected="selected"' ?>>Others</option>
                        </select>
                        <span class="error_53 error"></span>
                      </div>
                    </div>  
                    
                    
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Aadhar No.</label>
                        <input id = "aadhar_no" name = "aadhar_no" type="text" class="form-control" placeholder="Aadhar No." value = "" />
                        <span class="error_54 error"></span>
                      </div>
                    </div>
                    
                    <?php

                      if($all_job_Applied_data['ex_serviceman'])
                      {
                        $ex_serviceman =  $all_job_Applied_data['ex_serviceman'];
                      }

                      else
                      {
                        $ex_serviceman = '';
                      }
                    ?>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Ex-Serviceman</label>
                        <select id = "ex_serviceman" required="required" name = "ex_serviceman" class="form-control" onchange="remove_errors2('error_66')">
                           <option value="">Select Option</option>
                           <option value="Yes" <?php if($ex_serviceman == 'Yes') echo 'selected="selected"' ?>>Yes</option>
                           <option value="No" <?php if($ex_serviceman == 'No') echo 'selected="selected"' ?>>No</option>
                        </select>
                        <span class="error_66 error"></span>
                      </div>
                    </div>
                    
                    <?php

                      if($all_job_Applied_data['physical_fitness'])
                      {
                        $physical_fitness =  $all_job_Applied_data['physical_fitness'];
                      }

                      else
                      {
                        $physical_fitness = '';
                      }
                    ?>

                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Do you fulfill eligibility of physical fitness criteria?<span class="required">*</span></label>
                        <select id = "physical_fitness" name = "physical_fitness" required="required" class="form-control" onchange="remove_errors2('error_55')">
                           <option value="">Select Option</option>
                          <option value="Yes" <?php if($physical_fitness == 'Yes') echo 'selected="selected"' ?>>Yes</option>
                           <option value="No" <?php if($physical_fitness == 'No') echo 'selected="selected"' ?>>No</option>
                        </select>
                        <span class="error_55 error"></span>
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Employment exchange registration no & place</label>
                        <input id = "employment_exchange" name = "employment_exchange" type="text"  class="form-control" maxlength = "12" placeholder="Registration No" value = "<?php if($all_job_Applied_data['employment_exchange']) echo $all_job_Applied_data['employment_exchange']; else echo ''; ?>" />
                        <span class="error_56 error"></span>
                      </div>
                    </div>
                    
                    <?php

                      if($all_job_Applied_data['physically_candicapped'])
                      {
                        $physically_candicapped =  $all_job_Applied_data['physically_candicapped'];
                      }

                      else
                      {
                        $physically_candicapped = '';
                      }
                    ?>
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Physically Handicapped<span class="required">*</span></label>
                        <select id = "physically_candicapped" name = "physically_candicapped" required="required" class="form-control" onchange="remove_errors2('error_57')">
                           <option value="">Select Option</option>
                            <option value="Yes" <?php if($physically_candicapped == 'Yes') echo 'selected="selected"' ?>>Yes</option>
                           <option value="No" <?php if($physically_candicapped == 'No') echo 'selected="selected"' ?>>No</option>
                        </select>
                        <span class="error_57 error"></span>
                      </div>
                    </div>
                    
                     
                     <div class="col-sm-6">
                        <div class="combined-container">
                      <div class="form-group">
                        <label class="control-label">Present Address<span class="required">*</span></label>
                        <textarea id = "present_address" name = "present_address" class="form-control" placeholder="Present Address"><?php echo $all_job_Applied_data['present_address']; ?></textarea>
                        <span class="error_58 error"></span>
                      </div>
                      
                      <div class="form-group">
                         <div class="col-sm-4 padding-5">
                          <div class="form-group">
                            <select id = "present_address_state" name = "present_address_state" required="required" class="form-control" onchange="remove_errors2('error_60')" >
                               <option value="">Select State</option>
                              <?php
                                $all_data4[] = $all_job_Applied_data['present_address_state'];

                              foreach ($states as $rows4 ) {  ?>
                                <option value="<?php echo $rows4->State_Code; ?>"
                              <?php 
                                echo (isset($all_job_Applied_data['present_address_state']) && in_array($rows4->State_Code,$all_data4) ) ? "selected" : "" ?> ><?php echo $rows4->StateName_In_English; ?>
                              </option>
                              <?php } ?>
                            </select>
                            <span class="error_60 error"></span>
                          </div>
                        </div>  
                    
                        <div class="col-sm-4 padding-5">
                          <div class="form-group">
                            <select id = "present_address_city" name = "present_address_city" required="required" class="form-control" onchange="remove_errors2('error_61')">
                               <option value="">Select District</option>
                               <?php
                              $all_data3[] = $all_job_Applied_data['present_address_city'];

                            foreach ($city as $rows3 ) {  ?>
                              <option value="<?php echo $rows3->District_Name_In_English; ?>"
                            <?php 
                              echo (isset($all_job_Applied_data['present_address_city']) && in_array($rows3->District_Name_In_English,$all_data3) ) ? "selected" : "" ?> ><?php echo $rows3->District_Name_In_English; ?>
                            </option>
                            <?php } ?>
                            </select>
                            <span class="error_61 error"></span>
                          </div>
                        </div>  
                    
                        <div class="col-sm-4 padding-5">
                          <div class="form-group">
                          <input id = "present_address_pincode" type="text" name = "present_address_pincode" required="required" class="form-control" placeholder="Pin Code" maxlength="6" onkeyup="remove_errors('error_62')" value = "<?php if($all_job_Applied_data['present_address_pincode']) echo $all_job_Applied_data['present_address_pincode']; else echo ''; ?>" />
                          <span class="error_62 error"></span>
                          </div>
                        </div>  
                      </div>
                     </div>
                   </div>  
                     
                     <div class="col-sm-6">
                      <div class="combined-container">
                      <div class="form-group">
                        <label class="control-label">Permanent Address<span class="required">*</span></label>
                        <textarea id = "permanent_address" class="form-control" name = "permanent_address" placeholder="Permanent Address"><?php echo $all_job_Applied_data['permanent_address'];?></textarea>
                        <span class="error_59 error"></span>
                      </div>
                      
                      <div class="form-group">
                         <div class="col-sm-4 padding-5">
                          <div class="form-group">
                            <select id = "permanent_address_state" name = "permanent_address_state" required="required" class="form-control" onchange="remove_errors2('error_63')">
                               <option value="">Select State</option>
                               <?php
                                          $all_data[] = $all_job_Applied_data['permanent_address_state'];

                                        foreach ($states as $rows ) {  ?>
                                          <option value="<?php echo $rows->State_Code; ?>"
                                        <?php 
                                          echo (isset($all_job_Applied_data['permanent_address_state']) && in_array($rows->State_Code,$all_data) ) ? "selected" : "" ?> ><?php echo $rows->StateName_In_English; ?>
                                        </option>
                                        <?php } ?>

                            </select>
                            <span class="error_63 error"></span>
                          </div>
                        </div>  
                    
                        <div class="col-sm-4 padding-5">
                          <div class="form-group">
                            <select id = "permanent_address_city" name = "permanent_address_city" required="required" class="form-control" onchange="remove_errors2('error_64')">
                               <option value="">Select District</option>
                              
                              <?php
                                          $all_data2[] = $all_job_Applied_data['permanent_address_city'];

                                        foreach ($city as $rows2 ) {  ?>
                                          <option value="<?php echo $rows2->District_Name_In_English; ?>"
                                        <?php 
                                          echo (isset($all_job_Applied_data['permanent_address_city']) && in_array($rows2->District_Name_In_English,$all_data2) ) ? "selected" : "" ?> ><?php echo $rows2->District_Name_In_English; ?>
                                        </option>
                                        <?php } ?>


                            </select>
                            <span class="error_64 error"></span>
                          </div>
                        </div>  
                    
                        <div class="col-sm-4 padding-5">
                          <div class="form-group">
                          <input id = "permanent_address_pincode" type="text" name = "permanent_address_pincode" required="required" class="form-control" placeholder="Pin Code" maxlength="6" onkeyup="remove_errors('error_65')" value = "<?php if($all_job_Applied_data['permanent_address_pincode']) echo $all_job_Applied_data['permanent_address_pincode']; else echo ''; ?>" />
                          <span class="error_65 error"></span>
                          </div>
                        </div>  
                      </div>

                    </div>
                      
                     </div>
                    <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-9 col-xs-3">
                        <button class="btn btn-danger backBtn" type="button">Back</button>
                      </div>
                        <div class="col-sm-3 col-xs-9">
                            <!-- <button class="btn btn-primary pull-left" type="button">Save</button> -->
                        <button class="btn btn-primary nextBtn pull-right nnn " type="button">Save and Continue</button>
                        </div>
                    </div>
                  </div>
                </div>
                
                
                <div class="panel panel-primary setup-content" id="step-4">
                  <div class="panel-heading">
                     <h3 class="panel-title">Upload Document</h3>
                  </div>
                  <div class="panel-body">
                    
                     <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-4">
                        <label class="control-label">Upload Photo With Sign<br/>(Only JPG, PNG and JPEG files are allowed)<span class="required">*</span></label>
                      </div>
                        <div class="col-sm-8">
                          <input type="file"  id = "uploaded_photo_sign" name = "uploaded_photo_sign" accept=".png,.jpg, .jpeg" required="required" onchange="remove_errors2('error_67')" />
                          <span class="error_67 error"></span>
                        </div>
                    </div>
                    
                     <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-4">
                        <label class="control-label">Date Of Birth Certificate<br/>(Only JPG, PNG and JPEG files are allowed)<span class="required">*</span></label>
                      </div>
                        <div class="col-sm-8">
                          <input type="file"  id = "dob_certificate" name = "dob_certificate" accept=".png,.jpg, .jpeg" required="required" onchange="remove_errors2('error_68')" />
                          <span class="error_68 error"></span>
                        </div>
                    </div>
                    
                    
                     <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-4">
                        <label class="control-label">Matriculation/ITI Marksheet<br/>(Only JPG, PNG and JPEG files are allowed)<span class="required">*</span></label>
                      </div>
                        <div class="col-sm-8">
                          <input type="file" id = "matriculation_marksheet" name = "matriculation_marksheet" accept=".png, .jpg,.jpeg" required="required" onchange="remove_errors2('error_69')" />
                          <span class="error_69 error"></span>
                        </div>
                    </div>
                    
                    
                     <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-4">
                        <label class="control-label">S.C./S.T., O.B.C. or Ex-Serviceman or PH. Certificate<br/>(Only JPG, PNG and JPEG files are allowed) </label>
                      </div>
                        <div class="col-sm-8">
                          <input type="file" id = "scc_St_obc_certificate" name = "scc_St_obc_certificate" accept=".png, .jpg,.jpeg" />
                          <span class="error_75 error"></span>
                        </div>
                    </div>

                    <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-4">
                        <label class="control-label">Working Experience </label>
                      </div>
                        <div class="col-sm-8">
                          <textarea class="form-control" name = "working_experience" id="working_experience" ><?php echo $all_job_Applied_data['working_experience']; ?></textarea>
                          <span>Working experience should be maximum 500 words.</span>
                          <span class="error_exp error"></span>
                        </div>
                    </div>

                    <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-12">
                        <span class="required">*</span><input type="checkbox" name="check_terms_condn" value="check" id="check_terms_condn"/> "I solemnly declare and affirm that the information given above is true & correct to the best of my knowledge and if any incorrect/false information is found, my candidature may be cancelled at any stage and in the event of any mis-statement/ discrepancy in the particulars detected after my appointment, my service is liable to be terminated without any notice to me.<span class="error_70 error"></span>
                      </div>
                        
                    </div>
      
                    
                    <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-9 col-xs-3">
                        <button class="btn btn-danger backBtn" type="button">Back</button>
                      </div>
                        <div class="col-sm-3 col-xs-9">
                           
                         <button class="btn btn-primary finalBtn pull-right " type="button">Save and Continue</button> 
                        </div>
                    </div>
                    
                  </div>
                </div>
               
            </div>
           
           </div>
        </div>
        
        
        <div class="row">
           <div class="col-lg-3"></div>
           <div class="col-lg-6">
            
                        <div class="card-box final-step" style="padding: 40px 40px 30px 40px;display:none;">
                          <div class="card-block">
                           <div class="form-group text-center">
                            <button  class="btn btn-warning btn-block btn-sbmt" id = "previewww_button" type="button">
                              Final Preview Form
                            </button>
                          </div>

                           <div class="form-group text-center">
                            <a href="javascript:void(0);" class="btn btn-primary btn-block btn-sbmt btn-back">Edit Form</a>
                          </div>

                           <div class="form-group text-center">
                             <button name="submit" class="btn btn-success btn-block btn-sbmt" type="submit">Final Submit</button>
                          </div>
                        </div>
                    </div>
                     
          </div>    
            
                </div>
        
         <?php echo form_close(); ?>
               
            </div>
           
        </div>
    
    
    
    <div id="preview_myModal" class="modal fade" role="dialog">
      <div class="modal-dialog preview-modal">
      <div class="modal-content">
        <div class="modal-body">
         <div class="account-box" style="box-shadow: none;border: 0;margin: 0;width: auto;">
          <div class="account-wrapper">
             <h3 class="text-center">Preview Form</h3>
             
           <!--  <button type="button" class=" btn btn-sm btn-danger" onclick="printJS('<?php// echo $url; ?>')">Print </button> -->

            <button type="button" class=" btn btn-sm btn-danger" onclick="get_pdf()">Print </button>
              <div class="panel panel-primary">
                <div class="panel-heading">
                   <h3 class="panel-title">Job Apply For</h3>
                </div>
                
                <div class="panel-body">
                
                   <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Prefered Region</label>
                   
                    <input type="text" id= "preview_region_name" class="form-control" readonly />
                  </div>
                   </div>
                   
                   <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Circle Office</label>
                   
                    <input type="text" id= "preview_circle_name" class="form-control" readonly />
                  </div>
                   </div> 
                   
                   <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Skilled Applied For</label>
                    <input type="text" id= "preview_skilled_name" class="form-control" readonly />
                    
                  </div>
                   </div>
                   
                   <div class="col-sm-6">
                    <div class="form-group">
                    <label class="control-label">Post Code</label>
                       <input type="text" id= "preview_post_code" class="form-control" readonly />
                    </div>
                   </div>

                   
                   
                </div>
                
              </div>
              
              
              
              <div class="panel panel-primary">
                  <div class="panel-heading">
                     <h3 class="panel-title">Basic Information</h3>
                  </div>
                  
                  <div class="panel-body">
                  
                     <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Full Name</label>
                      <input type="text"  id= "preview_full_name" class="form-control" value="" readonly />
                    </div>
                     </div>
                     
                     <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Father's Name</label>
                    <input type="text" id= "preview_father_name" class="form-control" value="" readonly />
                    </div>
                     </div> 
                     
                     <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Email Id</label>
                      <input type="email" id= "preview_email" class="form-control" value="" readonly />
                    </div>
                     </div>
                     
                     <div class="col-sm-4">
                    <div class="form-group">
                      <label class="control-label">Mobile No.</label>
                      <input type="text" id= "preview_mobile_no" class="form-control" value="" readonly />
                    </div>
                     </div>
                     
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Date Of Birth</label>
                        <input type="text" id= "preview_dob" class="form-control" value="" readonly />
                      </div>
                    </div>
                    
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Gender</label>
                        <input type="text" id= "preview_gender" class="form-control" value="" readonly />
                       
                      </div>
                    </div>
                     
                    
                  </div>
                  
                </div>
                
                <div class="panel panel-primary">
                  <div class="panel-heading">
                     <h3 class="panel-title">Educational Details</h3>
                  </div>
                  <div class="panel-body">
                    <div class="row-ed">
                    <div class="col-sm-2 nopadding">
                      <div class="form-group">
                        <label class="control-label">Exam Passed</label> 
                        <input type="text" id = "preview_highschool_metriculation" class="form-control" value="" readonly />
                        
                      </div>
                    </div>

                     <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <label class="control-label ed-label">Name of Board/University</label>
                        <input type="text" id = "preview_highschool_board_name" class="form-control" value="" readonly />
                      </div>
                    </div>
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <label class="control-label ed-label">Passing Year</label>
                        <input type="text" id = "preview_highschool_passing_year" class="form-control" value="" readonly />
                      </div>
                    </div>

                      <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <label class="control-label ed-label"> Type</label>
                        <input type="text" id = "preview_percentage_type" class="form-control" value="" readonly />
                        
                        
                        
                      </div>
                    </div>
                    
                  <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <label class="control-label ed-label">Maximum Marks</label>
                        <input type="text" id = "preview_highschool_total_marks" class="form-control" value="" readonly />
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <label class="control-label ed-label">Marks Obtained</label>
                        <input type="text" id = "preview_highschool_marks_obtained" class="form-control" value="" readonly />
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <label class="control-label ed-label">Percentage</label>
                        <input type="text" id = "preview_highschool_percentage" class="form-control" value="" readonly />
                      </div>
                    </div>
                    
                    
                    </div>
               
                    
                    <div class="row-ed">
                    <div class="col-sm-2 nopadding">
                      <div class="form-group">
                        <input type="text" id = "" class="form-control" value="Others" readonly />
                        
                      </div>
                    </div>

                     <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_graduation_qualification" class="form-control" readonly />
                      </div>
                    </div>
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_graduation_passing_year"  class="form-control" readonly />
                      </div>
                    </div>
                    
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_percentage_type1"  class="form-control" readonly />                        
                      </div>
                    </div>
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_graduation_total_marks"  class="form-control" readonly />
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_graduation_marks_obtained"  class="form-control" readonly />
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_graduation_percentage" required="required" class="form-control" readonly />
                      </div>
                    </div>
                    
                    </div>
                    
                    
                    <div class="row-ed">
                    <div class="col-sm-2 nopadding">
                      <div class="form-group">
                        <input type="text" id = "" class="form-control" value="Others" readonly />
                        
                      </div>
                    </div>

                     <div class="col-sm-2 padding-5">
                      <div class="form-group">
                      <input type="text" id = "preview_post_graduation_qualification" class="form-control" readonly />
                      </div>
                    </div>
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_post_graduation_passing_year" class="form-control" readonly />
                      </div>
                    </div>

                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_percentage_type2"  class="form-control" readonly />                        
                      </div>
                    </div>
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_post_graduation_total_marks" class="form-control" readonly />
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_post_graduation_marks_obtained" class="form-control" readonly />
                      </div>
                    </div>
                    
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_post_graduation_percentage"  class="form-control" readonly />
                      </div>
                    </div>
                    
                    </div>
                    
                    
                    <div class="row-ed">
                    <div class="col-sm-2 nopadding">
                      <div class="form-group">
                        <input type="text" id = "" class="form-control" value="Others" readonly />
                        
                      </div>
                    </div>

                     <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_others_qualification" class="form-control" readonly />
                      </div>
                    </div>
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_others_passing_year" class="form-control" readonly />
                      </div>
                    </div>
                  
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_percentage_type3"  class="form-control" readonly />                        
                      </div>
                    </div>
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_others_total_marks" class="form-control" readonly />
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-2 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_others_marks_obtained" class="form-control" readonly />
                      </div>
                    </div>
                    
                    <div class="col-sm-1 padding-5">
                      <div class="form-group">
                        <input type="text" id = "preview_others_percentage" required="required" class="form-control" readonly />
                      </div>
                    </div>
                    
                    </div>
                    
                  </div>
                </div>
                
                <div class="panel panel-primary">
                  <div class="panel-heading">
                     <h3 class="panel-title">Other Details</h3>
                  </div>
                  <div class="panel-body">
                  
                     
                     <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Category</label>
                        <input type="text" id = "preview_caste_category" required="required" class="form-control" readonly />
                        
                      </div>
                    </div>  
                    
                      <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Religion</label>
                        <input type="text" id = "preview_religion" required="required" class="form-control" readonly />
                       
                      </div>
                    </div>  
                    
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Marital Status</label>
                        <input type="text" id = "preview_marital_status" required="required" class="form-control" readonly />
                        
                      </div>
                    </div>  
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Nationality</label>
                        <input type="text" id= "preview_nationality" class="form-control" readonly />
                      </div>
                    </div>  
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Aadhar No.</label>
                        <input type="text" id="preview_aadhar_no" class="form-control" readonly />
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Ex-Serviceman</label>
                        <input type="text" id = "preview_ex_serviceman" required="required" class="form-control" readonly />
                       
                      </div>
                    </div>
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Do you fulfill eligibility of physical fitness criteria?</label>
                        <input type="text" id = "preview_physical_fitness" required="required" class="form-control" readonly />
                      
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Employment exchange Registration No & Place</label>
                        <input type="text" id="preview_employment_exchange"  class="form-control" readonly />
                      </div>
                    </div>
                    
                    
                    <div class="col-sm-4">
                      <div class="form-group">
                        <label class="control-label">Physically Handicapped</label>
                        <input type="text" id = "preview_physically_candicapped" required="required" class="form-control" readonly />
                       
                      </div>
                    </div>
                    
                     
                     <div class="col-sm-6" style="clear:both;">
                      <div class="form-group">
                        <label class="control-label">Present Address</label>
                        <textarea class="form-control" id="preview_present_address" readonly ></textarea>
                      </div>
                      
                      <div class="form-group">
                         <div class="col-sm-4 padding-5">
                          <div class="form-group">
                         
                            <input type="text" id = "preview_present_address_state" required="required" class="form-control" readonly />
                          </div>
                        </div>  
                    
                        <div class="col-sm-4 padding-5">
                          <div class="form-group">
                           
                            <input type="text" id ="preview_present_address_city" required="required" class="form-control" readonly />
                          </div>
                        </div>  
                    
                        <div class="col-sm-4 padding-5">
                          <div class="form-group">
                          <input type="text" id="preview_present_address_pincode"  class="form-control" readonly />
                          </div>
                        </div>  
                      </div>
                     </div>
                     
                     <div class="col-sm-6">
                      <div class="form-group">
                        <label class="control-label">Permanent Address</label>
                        <textarea class="form-control" id ="preview_permanent_address" readonly ></textarea>
                      </div>
                      
                      <div class="form-group">
                         <div class="col-sm-4 padding-5">
                          <div class="form-group">
                          
                            <input type="text" id = "preview_permanent_address_state" required="required" class="form-control" readonly />
                          </div>
                        </div>  
                    
                        <div class="col-sm-4 padding-5">
                          <div class="form-group">
                         
                            <input type="text" id = "preview_permanent_address_city" required="required" class="form-control" readonly />
                          </div>
                        </div>  
                    
                        <div class="col-sm-4 padding-5">
                          <div class="form-group">
                          <input type="text" id="preview_permanent_address_pincode"  class="form-control" readonly />
                          </div>
                        </div>  
                      </div>
                      
                     </div>

                  </div>
                </div>
                
                
                <div class="panel panel-primary">
                  <div class="panel-heading">
                     <h3 class="panel-title">Upload Document</h3>
                  </div>
                  <div class="panel-body">
                    <div class="col-sm-6">
                       <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-6">
                          <label class="control-label">Upload Photo With Sign</label>
                        </div>
                        <div class="col-sm-6">
                          <img id="preview_uploaded_photo_sign" src="<?php echo base_url();?>uploads/uploaded_photo/no-image.jpg" width="150" height= "100" >
                        </div>
                      </div>
                    </div>

                                    <div class="col-sm-6">                    
                     <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-6">
                        <label class="control-label">Date Of Birth Certificate</label>
                      </div>
                        <div class="col-sm-6">
                           <img  id="preview_dob_certificate" src="<?php echo base_url();?>uploads/uploaded_photo/no-image.jpg" width="150" height= "100">
                        </div>
                    </div>
                  </div>  
                    
                  <div class="col-sm-6">    
                     <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-6">
                        <label class="control-label">Matriculation/ITI Marksheet</label>
                      </div>
                        <div class="col-sm-6">
                          <img  id="preview_matriculation_marksheet" src="<?php echo base_url();?>uploads/uploaded_photo/no-image.jpg" width="150" height= "100">
                        </div>
                    </div>
                   </div>   
                    
                    <div class="col-sm-6">        
                     <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-6">
                        <label class="control-label">S.C./S.T., O.B.C. or Ex-Serviceman or PH. Certificate </label>
                      </div>
                        <div class="col-sm-6">
                          <img  id="preview_scc_St_obc_certificate" src="<?php echo base_url();?>uploads/uploaded_photo/no-image.jpg" width="150" height= "100">
                        
                        </div>
                    </div>
                    </div>

                    <div class="form-group" style="width:100%;float:left;">
                         <div class="col-sm-4">
                        <label class="control-label">Working Experience </label>
                      </div>
                        <div class="col-sm-8">
                          <textarea class="form-control" name = "preview_working_experience" id="preview_working_experience" readonly ></textarea>

                        </div>
                    </div>
                    
                  </div>
                </div>
                
            
           </div>
          </div>
        </div>
      </div>
      </div>
    </div>
    
  <!--Modal for job apply-->
  <div id="job_apply_modaal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body" style="float: left;">
       <div class="account-box" style="box-shadow: none;border: 0;margin: 0;width: auto;">
      <div class="account-wrapper" style="float: left;background:#fff;">
         <h3 class="account-title">Apply Job</h3>
            <label class="control-label" style="color:#333;">Disclaimer :</label>
          <div class="form-group form-focus">
                
              <p>Applicants should read official notification carefully for the detailed information regarding age limit, education qualification, selection process and how to apply for CWC-Job Recruitment. This portal only for facilitation regarding application for respective vacancies.</p>
              
             </div>
          
            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal">Close</button>
          
        
       </div>
      </div>
      </div>
    </div>
  </div>
</div>
  <!--Ends Modal-->


   

<script>
     $(document).ready(function () {

      // js code for encrypt adhar
           var adharrr_text = "<?php echo $all_job_Applied_data['aadhar_no']; ?>";
           var salt_key = "<?php echo $this->config->item('salt_keyy'); ?>";
           
           if(adharrr_text.length == 0)
           {
                var adhar_text_val = '';
                $('#aadhar_no').val(adhar_text_val);
           }

           else
           {  
          
                 var Normaltext1 = CryptoJS.AES.decrypt(adharrr_text,salt_key);
                 var adhar_text_val = Normaltext1.toString(CryptoJS.enc.Utf8); 
                 $('#aadhar_no').val(adhar_text_val);
           }
          

           
      //  ends code

      $('#job_apply_modaal').modal('show');


        var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');
          
          allBackBtn = $('.backBtn');

        allWells.hide();

        navListItems.click(function (e) {
          e.preventDefault();
          var $target = $($(this).attr('href')),
            $item = $(this);

          if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-success').addClass('btn-default');
            $item.addClass('btn-success');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
          }
        });

        allNextBtn.click(function () {

          

          var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='email'],select"),
            isValid = true;

          $(".form-group").removeClass("has-error");
          for (var i = 0; i < curInputs.length; i++) {
            if (!curInputs[i].validity.valid) {
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
          }

          var output = true;
          var full_name         = $('#full_name').val();
          var father_name       = $('#father_name').val();
          var email             = $('#email').val();
          var mobile_no         = $('#mobile_no').val();
          var dob             = $('#dob').val();
          var gender            = $('#gender').val();
        

          var highschool_metriculation  = $('#highschool_metriculation').val();
          var highschool_board_name     = $('#highschool_board_name').val();
          var highschool_passing_year   = $('#highschool_passing_year').val();
          var highschool_total_marks    = $('#highschool_total_marks').val();
          var highschool_marks_obtained   = $('#highschool_marks_obtained').val();
          var highschool_percentage     = $('#highschool_percentage').val();
          var intermediate_board_name   = $('#intermediate_board_name').val();
          var intermediate_passing_year   = $('#intermediate_passing_year').val();
          var intermediate_total_marks  = $('#intermediate_total_marks').val();
          var intermediate_marks_obtained = $('#intermediate_marks_obtained').val();
          var intermediate_percentage   = $('#intermediate_percentage').val();
          var graduation_qualification  = $('#graduation_qualification').val();
          var graduation_passing_year   = $('#graduation_passing_year').val();
          var graduation_total_marks    = $('#graduation_total_marks').val();
          var graduation_marks_obtained   = $('#graduation_marks_obtained').val();
          var graduation_percentage     = $('#graduation_percentage').val();
          var post_graduation_passing_year= $('#post_graduation_passing_year').val();
          var post_graduation_total_marks = $('#post_graduation_total_marks').val();
          var post_graduation_marks_obtained= $('#post_graduation_marks_obtained').val();
          var post_graduation_percentage  = $('#post_graduation_percentage').val();
          var others_passing_year     = $('#others_passing_year').val();
          var others_total_marks      = $('#others_total_marks').val();
          var others_marks_obtained     = $('#others_marks_obtained').val();
          var others_percentage       = $('#others_percentage').val();



          var caste_category        = $('#caste_category').val();
          var religion          = $('#religion').val();
          var marital_status        = $('#marital_status').val();
          var nationality         = $('#nationality').val();
          var adharr_1           = $('#aadhar_no').val();
          var rawdt               = "<?php echo $this->config->item('salt_keyy'); ?>";
          var ency                = CryptoJS.AES.encrypt(adharr_1,rawdt).toString();
          var aadhar_no =  ency;
      
          var ex_serviceman         = $('#ex_serviceman').val();
          var physical_fitness      = $('#physical_fitness').val();
          var employment_exchange     = $('#employment_exchange').val();
          var physically_candicapped    = $('#physically_candicapped').val();
          var present_address       = $('#present_address').val();
          var permanent_address       = $('#permanent_address').val();
          var present_address_state     = $('#present_address_state').val();
          var present_address_city    = $('#present_address_city').val();
          var present_address_pincode   = $('#present_address_pincode').val();
          var permanent_address_state   = $('#permanent_address_state').val();
          var permanent_address_city    = $('#permanent_address_city').val();
          var permanent_address_pincode   = $('#permanent_address_pincode').val();

            
            if ($("#step-1").css('display') != 'none')
          {
            

            if (full_name.length === 0) 
                      {
                        var msg = 'Please enter full name.';
                      $(".error_21").html(msg);
                      $(".error_21").show();
                      $('.error_21').css('color','red');           
                            output = false;
                            return output;        
                  
                      }
                    if (father_name.length === 0) 
                      {
                        var msg = 'Please enter father'+"'s"+' name.';
                      $(".error_22").html(msg);
                      $(".error_22").show();
                      $('.error_22').css('color','red');               
                            output = false;
                            return output;       
                      }

                    if (email.length === 0) 
                      {
                        var msg = 'Please enter email.';
                      $(".error_23").html(msg);
                      $(".error_23").show();
                      $('.error_23').css('color','red');               
                            output = false;
                            return output;
                          
                      }

                    if (mobile_no.length === 0) 
                      {
                        var msg = 'Please enter mobile no.';
                      $(".error_24").html(msg);
                      $(".error_24").show();
                      $('.error_24').css('color','red');               
                            output = false;
                            return output;
                          
                      }

                    if (isNaN(mobile_no)==1) 
                      {
                var msg = 'Please enter number only.';
                      $(".error_24").html(msg);
                      $(".error_24").show();
                      $('.error_24').css('color','red');               
                            output = false;
                            return output;   
                      }

                    if (dob.length === 0) 
                      {
                        var msg = 'Please enter dob.';
                      $(".error_25").html(msg);
                      $(".error_25").show();
                      $('.error_25').css('color','red');               
                            output = false;
                            return output;
                          
                      }

                      if (dob.length != 0) 
                      { 

                        var today = new Date();
                var birthDate = new Date(dob);
                var age = today.getFullYear() - birthDate.getFullYear();
                var m = today.getMonth() - birthDate.getMonth();
                var da = today.getDate() - birthDate.getDate();
                if (m < 0 || (m === 0 && today.getDate() < birthDate.getDate())) {
                    age--;
                }
                if(m<0){
                    m +=12;
                }
                if(da<0){
                    da +=30;
                }

                if(age < 18 || age > 100)
              {
              //alert("Age "+age+" is restrict");
              var msg = 'Age should be more than 18 years.';
                      $(".error_25").html(msg);
                      $(".error_25").show();
                      $('.error_25').css('color','red');               
                            output = false;
                            return output;

              } 
                        
                          
                      }

                    if (gender.length === 0) 
                      {
                        var msg = 'Please select gender.';
                      $(".error_26").html(msg);
                      $(".error_26").show();
                      $('.error_26').css('color','red');               
                            output = false;
                            return output;
                          
                      }

                      else
                      {
                        
              /*****AJAX code for data insert basic info procced form********/

              var full_name       = full_name;
              var father_name     = father_name;
              var email           = email;
              var mobile_no       = mobile_no;
              var dob           = dob;
              var gender          = gender;

             var base_url = "<?php echo base_url(); ?>";
             
                var link = base_url+'Applicant/apply_general_basic_info/';
                $.ajax({
                  method: "POST",

                  url: link,
                  data: {'full_name': full_name,'father_name': father_name,'email': email,'mobile_no': mobile_no,'dob': dob,'gender': gender},
                  success: function(result) {
                    console.log(result);

                  }
        
                });//ends ajax
              

            /*****Ends AJAX code for data insert basic info procced form********/

                        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
                      }
          }//ends if

          

          if ($("#step-2").css('display') != 'none')
          {

            if (highschool_metriculation.length === 0) 
                      { 
                        
                        var msg = 'Exam Passed.';
                      $(".error_71").html(msg);
                      $(".error_71").show();
                      $('.error_71').css('color','red');           
                            output = false;
                            return output;   
                      }

            if (highschool_board_name.length === 0) 
                      {
                        var msg = 'Board name.';
                      $(".error_27").html(msg);
                      $(".error_27").show();
                      $('.error_27').css('color','red');           
                            output = false;
                            return output;   
                      }

                      if (highschool_passing_year.length === 0) 
                      { 
                        var msg = 'Passing year.';
                      $(".error_28").html(msg);
                      $(".error_28").show();
                      $('.error_28').css('color','red');           
                            output = false;
                            return output;   
                      }

                      if (isNaN(highschool_passing_year)==1) 
                      { 
                var msg = 'Type numbers only.';
                      $(".error_28").html(msg);
                      $(".error_28").show();
                      $('.error_28').css('color','red');           
                            output = false;
                            return output;  
                      }

                    

                      if (isNaN(highschool_total_marks)==1) 
                      { 
                var msg = 'Type numbers only.';
                      $(".error_29").html(msg);
                      $(".error_29").show();
                      $('.error_29').css('color','red');           
                            output = false;
                            return output;   
                      }

                    

                      if (isNaN(highschool_marks_obtained)==1) 
                      { 
                var msg = 'Type numbers only.';
                      $(".error_30").html(msg);
                      $(".error_30").show();
                      $('.error_30').css('color','red');           
                            output = false;
                            return output;  
                      }

                      if (highschool_percentage.length === 0) 
                      { 
                        var msg = 'Percentage.';
                      $(".error_31").html(msg);
                      $(".error_31").show();
                      $('.error_31').css('color','red');           
                            output = false;
                            return output;   
                      }

                       if (isNaN(highschool_percentage)==1) 
                      { 
                var msg = 'Type numbers only.';
                      $(".error_31").html(msg);
                      $(".error_31").show();
                      $('.error_31').css('color','red');           
                            output = false;
                            return output;   
                      }

                 

                      if (isNaN(graduation_passing_year)==1) 
                      { 
                var msg = 'Type numbers only.';
                      $(".error_38").html(msg);
                      $(".error_38").show();
                      $('.error_38').css('color','red');           
                            output = false;
                            return output;     
                      }


                      if (isNaN(graduation_total_marks)==1) 
                      { 
                var msg = 'Type numbers only.';
                      $(".error_39").html(msg);
                      $(".error_39").show();
                      $('.error_39').css('color','red');           
                            output = false;
                            return output;      
                      }

                   

                      if (isNaN(graduation_marks_obtained)==1) 
                      { 
                var msg = 'Type numbers only.';
                      $(".error_40").html(msg);
                      $(".error_40").show();
                      $('.error_40').css('color','red');            
                            output = false;
                            return output;      
                      }


                      if (isNaN(graduation_percentage)==1) 
                      {
                var msg = 'Type numbers only.';
                      $(".error_41").html(msg);
                      $(".error_41").show();
                      $('.error_41').css('color','red');           
                            output = false;
                            return output;      
                      }

                     

                       if (isNaN(post_graduation_total_marks)==1) 
                      {
                var msg = 'Type numbers only.';
                      $(".error_43").html(msg);
                      $(".error_43").show();
                      $('.error_43').css('color','red');           
                            output = false;
                            return output;      
                      }

                       if (isNaN(post_graduation_marks_obtained)==1) 
                      {
                var msg = 'Type numbers only.';
                      $(".error_44").html(msg);
                      $(".error_44").show();
                      $('.error_44').css('color','red');           
                            output = false;
                            return output;      
                      }

                       if (isNaN(post_graduation_percentage)==1) 
                      {
                var msg = 'Type numbers only.';
                      $(".error_45").html(msg);
                      $(".error_45").show();
                      $('.error_45').css('color','red');           
                            output = false;
                            return output;      
                      }


                       if (isNaN(others_total_marks)==1) 
                      {
                var msg = 'Type numbers only.';
                      $(".error_47").html(msg);
                      $(".error_47").show();
                      $('.error_47').css('color','red');           
                            output = false;
                            return output;      
                      }

                       if (isNaN(others_marks_obtained)==1) 
                      {
                var msg = 'Type numbers only.';
                      $(".error_48").html(msg);
                      $(".error_48").show();
                      $('.error_48').css('color','red');           
                            output = false;
                            return output;      
                      }

                       if (isNaN(others_percentage)==1) 
                      {
                var msg = 'Type numbers only.';
                      $(".error_49").html(msg);
                      $(".error_49").show();
                      $('.error_49').css('color','red');           
                            output = false;
                            return output;      
                      } 

                      else
                      { 
                        /*****AJAX code for data insert educational info proceed form********/

              var highschool_metriculation  = $('#highschool_metriculation').val();
              var highschool_board_name     = $('#highschool_board_name').val();
              var highschool_passing_year   = $('#highschool_passing_year').val();
              var highschool_total_marks    = $('#highschool_total_marks').val();
              var highschool_marks_obtained   = $('#highschool_marks_obtained').val();
              var highschool_percentage     = $('#highschool_percentage').val();
              var graduation_qualification  = $('#graduation_qualification').val();
              var graduation_passing_year   = $('#graduation_passing_year').val();
              var graduation_total_marks    = $('#graduation_total_marks').val();
              var graduation_marks_obtained   = $('#graduation_marks_obtained').val();
              var graduation_percentage     = $('#graduation_percentage').val();
              var post_graduation_qualification= $('#post_graduation_qualification').val();
              var post_graduation_passing_year= $('#post_graduation_passing_year').val();
              var post_graduation_total_marks = $('#post_graduation_total_marks').val();
              var post_graduation_marks_obtained= $('#post_graduation_marks_obtained').val();
              var post_graduation_percentage  = $('#post_graduation_percentage').val();
              var others_qualification    = $('#others_qualification').val();
              var others_passing_year     = $('#others_passing_year').val();
              var others_total_marks      = $('#others_total_marks').val();
              var others_marks_obtained     = $('#others_marks_obtained').val();
              var others_percentage       = $('#others_percentage').val();
              var base_url = "<?php echo base_url(); ?>";
              var link = base_url+'Applicant/apply_educational_info/';
                $.ajax({
                  method: "POST",
                  url: link,
                  async: false,
                  data: {'highschool_metriculation': highschool_metriculation,'highschool_board_name': highschool_board_name,'highschool_passing_year': highschool_passing_year,'highschool_total_marks': highschool_total_marks,'highschool_marks_obtained': highschool_marks_obtained,'highschool_percentage': highschool_percentage,'graduation_qualification':graduation_qualification,'graduation_passing_year':graduation_passing_year,'graduation_total_marks':graduation_total_marks,'graduation_marks_obtained':graduation_marks_obtained,'graduation_marks_obtained':graduation_marks_obtained,'graduation_percentage':graduation_percentage,'post_graduation_qualification':post_graduation_qualification,'post_graduation_passing_year':post_graduation_passing_year,'post_graduation_total_marks':post_graduation_total_marks,'post_graduation_marks_obtained':post_graduation_marks_obtained,'post_graduation_percentage':post_graduation_percentage,'others_qualification':others_qualification,'others_passing_year':others_passing_year,'others_total_marks':others_total_marks,'others_marks_obtained':others_marks_obtained,'others_percentage':others_percentage},
                    success: function(result) {
                    console.log(result);
                  }
        
                });//ends ajax
              

            /*****Ends AJAX code for data insert basic info procced form********/

                        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
                      }
          }//end if

          if ($("#step-3").css('display') != 'none')
          {
            if (caste_category.length === 0) 
                      {
                        var msg = 'Caste required.';
                      $(".error_50").html(msg);
                      $(".error_50").show();
                      $('.error_50').css('color','red');           
                            output = false;
                            return output;   
                      }

                      if (religion.length === 0) 
                      {
                        var msg = 'Religion required.';
                      $(".error_51").html(msg);
                      $(".error_51").show();
                      $('.error_51').css('color','red');           
                            output = false;
                            return output;   
                      }

                      if (marital_status.length === 0) 
                      {
                        var msg = 'Marital status required.';
                      $(".error_52").html(msg);
                      $(".error_52").show();
                      $('.error_52').css('color','red');           
                            output = false;
                            return output;   
                      }

                      if (nationality.length === 0) 
                      {
                        var msg = 'Nationality required.';
                      $(".error_53").html(msg);
                      $(".error_53").show();
                      $('.error_53').css('color','red');           
                            output = false;
                            return output;   
                      }

                    

                      if (ex_serviceman.length === 0) 
                      {
                        var msg = 'Ex-Serviceman required.';
                      $(".error_66").html(msg);
                      $(".error_66").show();
                      $('.error_66').css('color','red');           
                            output = false;
                            return output;   
                      }

                      if (physical_fitness.length === 0) 
                      {
                        var msg = 'Physical fitness required.';
                      $(".error_55").html(msg);
                      $(".error_55").show();
                      $('.error_55').css('color','red');           
                            output = false;
                            return output;   
                      }

                     

                      if (physically_candicapped.length === 0) 
                      {
                        var msg = 'Physically handicapped required.';
                      $(".error_57").html(msg);
                      $(".error_57").show();
                      $('.error_57').css('color','red');           
                            output = false;
                            return output;   
                      }

                      if (present_address.length === 0) 
                      {
                        var msg = 'Present address required.';
                      $(".error_58").html(msg);
                      $(".error_58").show();
                      $('.error_58').css('color','red');           
                            output = false;
                            return output;   
                      }

                      if (permanent_address.length === 0) 
                      {
                        var msg = 'Permanent address required.';
                      $(".error_59").html(msg);
                      $(".error_59").show();
                      $('.error_59').css('color','red');           
                            output = false;
                            return output;   
                      }

                      if (present_address_state.length === 0) 
                      {
                        var msg = 'Present address state required.';
                      $(".error_60").html(msg);
                      $(".error_60").show();
                      $('.error_60').css('color','red');           
                            output = false;
                            return output;   
                      }

                      if (present_address_city.length === 0) 
                      {
                        var msg = 'Present address city required.';
                      $(".error_61").html(msg);
                      $(".error_61").show();
                      $('.error_61').css('color','red');           
                            output = false;
                            return output;   
                      }


                      if (present_address_pincode.length === 0) 
                      {
                        var msg = 'Present address pincode required.';
                      $(".error_62").html(msg);
                      $(".error_62").show();
                      $('.error_62').css('color','red');           
                            output = false;
                            return output;   
                      }

                       if (isNaN(present_address_pincode)==1) 
                      {
                var msg = 'Type numbers only.';
                      $(".error_62").html(msg);
                      $(".error_62").show();
                      $('.error_62').css('color','red');           
                            output = false;
                            return output;      
                      }

                      if (permanent_address_state.length === 0) 
                      {
                        var msg = 'Permanent address state required.';
                      $(".error_63").html(msg);
                      $(".error_63").show();
                      $('.error_63').css('color','red');           
                            output = false;
                            return output;   
                      }

                      if (permanent_address_city.length === 0) 
                      {
                        var msg = 'Permanent address city required.';
                      $(".error_64").html(msg);
                      $(".error_64").show();
                      $('.error_64').css('color','red');           
                            output = false;
                            return output;   
                      }

                      if (permanent_address_pincode.length === 0) 
                      {
                        var msg = 'Permanent address pincode required.';
                      $(".error_65").html(msg);
                      $(".error_65").show();
                      $('.error_65').css('color','red');           
                            output = false;
                            return output;   
                      }

                       if (isNaN(permanent_address_pincode)==1) 
                      {
                var msg = 'Type numbers only.';
                      $(".error_65").html(msg);
                      $(".error_65").show();
                      $('.error_65').css('color','red');           
                            output = false;
                            return output;      
                      }


                      else
                      {

              /*****AJAX code for data insert basic info procced form********/

              var caste_category        = $('#caste_category').val();
              var religion          = $('#religion').val();
              var marital_status        = $('#marital_status').val();
              var nationality         = $('#nationality').val();

              var adharr_1           = $('#aadhar_no').val();
              var adhar_text_value = $('#aadhar_no').val();
              var rawdt               = "<?php echo $this->config->item('salt_keyy'); ?>";
              var ency                = CryptoJS.AES.encrypt(adharr_1,rawdt).toString();
              var aadhar_no =  ency;
              
              
              //var adhar_text_value = Normaltext1.toString(CryptoJS.enc.Utf8); 


              var ex_serviceman         = $('#ex_serviceman').val();
              var physical_fitness      = $('#physical_fitness').val();
              var employment_exchange     = $('#employment_exchange').val();
              var physically_candicapped    = $('#physically_candicapped').val();
              var present_address       = $('#present_address').val();
              var permanent_address       = $('#permanent_address').val();
              var present_address_state     = $('#present_address_state').val();
              var present_address_city    = $('#present_address_city').val();
              var present_address_pincode   = $('#present_address_pincode').val();
              var permanent_address_state   = $('#permanent_address_state').val();
              var permanent_address_city    = $('#permanent_address_city').val();
              var permanent_address_pincode   = $('#permanent_address_pincode').val();
           
             
             var base_url = "<?php echo base_url(); ?>";
                var link = base_url+'Applicant/apply_other_detail_info/';
                $.ajax({
                  method: "POST",
                  async: false,
                  url: link,
                  data: {'caste_category': caste_category,'religion': religion,'marital_status': marital_status,'nationality': nationality,'aadhar_no': aadhar_no,'ex_serviceman': ex_serviceman,'physical_fitness':physical_fitness,'employment_exchange':employment_exchange,'physically_candicapped':physically_candicapped,'present_address':present_address,'permanent_address':permanent_address,'present_address_state':present_address_state,'present_address_city':present_address_city,'present_address_pincode':present_address_pincode,'present_address_pincode':present_address_pincode,'permanent_address_state':permanent_address_state,'permanent_address_city':permanent_address_city,'permanent_address_pincode':permanent_address_pincode,'adhar_text_value':adhar_text_value},
                  success: function(result) {
                    console.log(result);

                  }
        
                });//ends ajax
              

            /*****Ends AJAX code for data insert basic info procced form********/

                        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');

               }


          }//ends if

        
          else
                      {
                        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
                      }
                  
                
                 // if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
                     
          
        });
        
        allBackBtn.click(function () {
          var currStep = $(this).closest(".setup-content"),
            currStepBtn = currStep.attr("id"),
            backStepWizard = $('div.setup-panel div a[href="#' + currStepBtn + '"]').parent().prev().children("a");
            
            backStepWizard.removeAttr('disabled').trigger('click');
            
        });

        $('div.setup-panel div a.btn-success').trigger('click');
        
        $(".btn-pd").click(function () {  
          var output = true;
          var region_name   = $('#region_name').val();
          var circle_name   = $('#circle_name').val();
          var skilled_name  = $('#skilled_name').val();
          var post_code     = $('#post_code').val();
          var full_name     = $('#full_name').val();
          var total_vacancy = $('#total_vacancy').val();

          if ($("#apppllyy_job").css('display') != 'none')
          {
            if (region_name.length === 0) 
                      {
                        var msg = 'Please enter region name.';
                      $(".error_11").html(msg);
                      $(".error_11").show();
                      $('.error_11').css('color','red');                    
                            output = false;
                             return output;
                          
                      }

                      else if (circle_name.length === 0) 
                      {
                        var msg = 'Please enter circle name.';
                      $(".error_12").html(msg);
                      $(".error_12").show();
                      $('.error_12').css('color','red');                    
                            output = false;
                             return output;
                           
                  
                      }

                      

                      else if (skilled_name.length === 0) 
                      {
                        var msg = 'Please enter skilled name.';
                      $(".error_13").html(msg);
                      $(".error_13").show();
                      $('.error_13').css('color','red');                    
                            output = false;
                             return output;
                            
                  
                      }

                      else if (post_code.length === 0) 
                      {
                        var msg = 'Please enter post code.';
                      $(".error_14").html(msg);
                      $(".error_14").show();
                      $('.error_14').css('color','red');                    
                            output = false;
                             return output;
                           
                  
                      }

                      else if (skilled_name.length != 0 && post_code.length != 0 && total_vacancy == 0) 
                      {
                        var msg = 'You can not apply for this job as vacancy is not available.';
                      $(".error_73").html(msg);
                      $(".error_73").show();
                      $('.error_73').css('color','red');                    
                            output = false;
                             return output;
                           
                  
                      }

                      else
            {
              $(".form-container").show();
              $(".card-box").hide();

              /*****AJAX code for region name shw********/
              var region_id = region_name;
             var base_url = "<?php echo base_url(); ?>";
                var link = base_url+'Applicant/region_all_data/';
               $.ajax({
                  method: "POST",

                  url: link,
                  data: {'region_id':region_id},
                  success: function(result) {
                    console.log(result); 
    
                    var obj = JSON.parse(result);
                   
                   $("#span_region").html(obj.region_name);
                   event.preventDefault();

                  }
        
                });//ends ajax

            /*****Ends AJAX code for region name shw********/

            /*****AJAX code for circle name shw********/

              var circle_id = circle_name;
             var base_url = "<?php echo base_url(); ?>";
                var link = base_url+'Applicant/circle_all_data/';
               $.ajax({
                  method: "POST",

                  url: link,
                  data: {'circle_id':circle_id},
                  success: function(result) {
                    console.log(result); 
    
                    var obj = JSON.parse(result);
                   
                   $("#span_circle").html(obj.circle_name);
                   event.preventDefault();

                  }
        
                });//ends ajax

            /*****Ends AJAX code for circle_name  shw********/

            /*****AJAX code for skill name shw********/

              var job_id = skilled_name;
             var base_url = "<?php echo base_url(); ?>";
                var link = base_url+'Applicant/job_all_data/';
               $.ajax({
                  method: "POST",

                  url: link,
                  data: {'job_id':job_id},
                  success: function(result) {
                    console.log(result); 
    
                    var obj = JSON.parse(result);
                   
                   $("#span_skill").html(obj.job_title);
                   event.preventDefault();

                  }
        
                });//ends ajax

            /*****Ends AJAX code for skill_name  shw********/

            /*****AJAX code for post name shw********/

              var post_id = post_code;
              var circle_id = circle_name;
              var region_id = region_name;
              var job_id = skilled_name;
             var base_url = "<?php echo base_url(); ?>";
                var link = base_url+'Applicant/post_all_data/';
               $.ajax({
                  method: "POST",

                  url: link,
                  data: {'post_id':post_id,'circle_id':circle_id,'region_id':region_id,'job_id': job_id},
                  success: function(result) {
                    console.log(result); 
    
                    var obj = JSON.parse(result);
                   
                   $("#span_post_code").html(obj.post_codee);
                   event.preventDefault();

                  }
        
                });//ends ajax

            /*****Ends AJAX code for post_name  shw********/

            /*****AJAX code for data insert procced form********/

              var region_id = region_name;
              var circle_id = circle_name;
              var job_id = skilled_name;
              var post_id = post_code;
             var base_url = "<?php echo base_url(); ?>";
                var link = base_url+'Applicant/apply_basic_info/';
                $.ajax({
                  method: "POST",

                  url: link,
                  data: {'post_id':post_id,'circle_id':circle_id,'region_id':region_id,'job_id': job_id},
                  success: function(result) {
                   // alert(result);
                     var obj = JSON.parse(result);
                   if(obj.status == "fail")
                   {
                    
                      var msg = obj.msg;
                        $(".error_73").html(msg);
                        $(".error_73").show();
                        $('.error_73').css('color','red');                    
                        var output = false;
                        return output;
                   }

                   else
                   {
                   
                      return true;
                   }

                  }
        
                });//ends ajax
              

            /*****Ends AJAX code for data insert procced form********/
             
            }//ends else

                     
          }//ends if

          
          
        });
        

        $(".startBtn").click(function () {

          $(".card-box").show();
          $(".form-container").hide();
          $(".final-step").hide();
        });
        
        
        $(".finalBtn").click(function () {
          var output = true;
          var uploaded_photo_sign     = $('#uploaded_photo_sign').val();
          var dob_certificate       = $('#dob_certificate').val();
          var matriculation_marksheet = $('#matriculation_marksheet').val();
          var check_terms_condn       = $('#check_terms_condn').is(':checked');

          var experience = $('#working_experience').val();
          
        
          if (experience.length > 500) 
              {
                var msg = 'Experience message should be maximum length 500 words.';
              $(".error_exp").html(msg);
              $(".error_exp").show();
              $('.error_exp').css('color','red');                    
                    output = false;
                     return output;     
              }

                   if (uploaded_photo_sign.length === 0) 
                      {
                        var msg = 'Please upload photo.';
                      $(".error_67").html(msg);
                      $(".error_67").show();
                      $('.error_67').css('color','red');                    
                            output = false;
                             return output;     
                      }

                  if (dob_certificate.length === 0) 
                      {
                        var msg = 'Please upload dob certificate.';
                      $(".error_68").html(msg);
                      $(".error_68").show();
                      $('.error_68').css('color','red');                    
                            output = false;
                             return output;     
                      }


                  if (matriculation_marksheet.length === 0) 
                      {
                        var msg = 'Please upload matriculation marksheet.';
                      $(".error_69").html(msg);
                      $(".error_69").show();
                      $('.error_69').css('color','red');                    
                            output = false;
                             return output;     
                      }

                  if (check_terms_condn ==false) 
                      {
                        var msg = 'Please tick terms & condition.';
                      $(".error_70").html(msg);
                      $(".error_70").show();
                      $('.error_70').css('color','red');                    
                            output = false;
                             return output;     
                      }

                 
                  var uploaded_photo_sign_size = $("#uploaded_photo_sign")[0].files[0].size;
                  var dob_certificate_size = $("#dob_certificate")[0].files[0].size;
                  var matriculation_marksheet_size = $("#matriculation_marksheet")[0].files[0].size;
                  //var scc_St_obc_certificate_size = $("#scc_St_obc_certificate")[0].files[0].size;

                    if(uploaded_photo_sign_size > 30720)
                    {
                      var msg = 'Please upload files less than 30 kb.';
                      $(".error_67").html(msg);
                      $(".error_67").show();
                      $('.error_67').css('color','red');   
                      $('.error_67').css({ opacity: 1 });                 
                            output = false;
                            return output; 
                    }

                    if(dob_certificate_size > 30720) 
                      {
                        var msg = 'Please upload files less than 30 kb.';
                      $(".error_68").html(msg);
                      $(".error_68").show();
                      $('.error_68').css('color','red'); 
                      $('.error_68').css({ opacity: 1 });                    
                            output = false;
                             return output;     
                      }

                      if(matriculation_marksheet_size > 30720) 
                      {
                        var msg = 'Please upload files less than 30 kb.';
                      $(".error_69").html(msg);
                      $(".error_69").show();
                      $('.error_69').css('color','red');
                      $('.error_69').css({ opacity: 1 });                    
                            output = false;
                             return output;     
                      }

                             
                  
                else
                {
                    
               /*****AJAX code for data insert basic info procced form********/
                      
              var uploaded_photo_sign   = uploaded_photo_sign;
              var dob_certificate       = dob_certificate;
              var matriculation_marksheet = matriculation_marksheet;
              var scc_St_obc_certificate  =  $('#scc_St_obc_certificate').val();
              var working_experience  =  $('#working_experience').val();
              var csrf_test_name =$("input[name=csrf_test_name]").val();
              var base_url = "<?php echo base_url(); ?>";
              var file_data = $('#scc_St_obc_certificate').prop('files')[0];  
                var link = base_url+'Applicant/apply_documents_info/';
                var formData = new FormData($("#applicannnt_logginn")[0]);
                formData.append('csrf_test_name', csrf_test_name);
                $.ajax({
                  method: "POST",
                  enctype: 'multipart/form-data',
                  url: link,
                  cache: false,
				          contentType: false,
				          processData: false,
                  data: formData,
                  success: function(result) {

                  console.log(result);

                  var res = JSON.parse(result);

                    if(res.type_error == '1'){

                      var msg = "This type of file is not allowed. Please choose correct formate.";

                      $('.error_67').html(msg);
                      $('.error_67').css('color','red');
                      $('.error_67').css({ opacity: 1 });

                    } else if(res.type_error == '2'){
                     
                     var msg = "This type of file is not allowed. Please choose correct formate.";

                     $('.error_68').html(msg);
                     $('.error_68').css('color','red');
                     $('.error_68').css({ opacity: 1 });

                    } else if(res.type_error == '3'){

                      var msg = "This type of file is not allowed. Please choose correct formate.";
                     
                     $('.error_69').html(msg);
                     $('.error_69').css('color','red');
                     $('.error_69').css({ opacity: 1 });
                      
                    } /*else if(res.type_error == '4'){

                     var msg = "This type of file is not allowed. Please choose correct formate.";
                    
                     $('.error_75').html(msg);
                     $('.error_75').css('color','red');
                     $('.error_75').css({ opacity: 1 });
                      
                    }*/ else {

                          $(".final-step").show();
                          $(".form-container").hide();

                    }

                  }
			        
                });//ends ajax
             
                    
              }
          
        });
        
        $(".btn-back").click(function () {
          $(".final-step").hide();
          $(".form-container").show();
        });
        
      });
      
  </script>
  <script type="text/javascript">
    
    $('#previewww_button').on('click', function(event)
    {
      var region_name = $("#region_name").val();

      /*****AJAX code for region name shw********/
              var region_id = region_name;
             var base_url = "<?php echo base_url(); ?>";
                var link = base_url+'Applicant/region_all_data/';
               $.ajax({
                  method: "POST",

                  url: link,
                  data: {'region_id':region_id},
                  success: function(result) {
                    console.log(result); 
    
                    var obj = JSON.parse(result);
                   
                   $('#preview_region_name').val(obj.region_name);
                   event.preventDefault();

                  }
        
                });//ends ajax

    /*****Ends AJAX code for region name shw********/
      

      var circle_name = $("#circle_name").val();
          /*****AJAX code for circle name shw********/

              var circle_id = circle_name;
             var base_url = "<?php echo base_url(); ?>";
                var link = base_url+'Applicant/circle_all_data/';
               $.ajax({
                  method: "POST",

                  url: link,
                  data: {'circle_id':circle_id},
                  success: function(result) {
                    console.log(result); 
    
                    var obj = JSON.parse(result);
                   
                   $('#preview_circle_name').val(obj.circle_name);
                   event.preventDefault();

                  }
        
                });//ends ajax

            /*****Ends AJAX code for circle_name  shw********/
      

      var skilled_name = $("#skilled_name").val();
      /*****AJAX code for skill name shw********/

              var job_id = skilled_name;
             var base_url = "<?php echo base_url(); ?>";
                var link = base_url+'Applicant/job_all_data/';
               $.ajax({
                  method: "POST",

                  url: link,
                  data: {'job_id':job_id},
                  success: function(result) {
                    console.log(result); 
    
                    var obj = JSON.parse(result);
                   
                  // $("#span_skill").html(obj.job_title);
                   $('#preview_skilled_name').val(obj.job_title);
                   event.preventDefault();

                  }
        
                });//ends ajax

            /*****Ends AJAX code for skill_name  shw********/
      

      var post_code = $("#post_code").val();
      $('#preview_post_code').val(post_code);

      var full_name = $("#full_name").val();
      $('#preview_full_name').val(full_name);

      var father_name = $("#father_name").val();
      $('#preview_father_name').val(father_name);

      var email = $("#email").val();
      $('#preview_email').val(email);

      var mobile_no = $("#mobile_no").val();
      $('#preview_mobile_no').val(mobile_no);

      var dob = $("#dob").val();
      $('#preview_dob').val(dob);

      var gender = $("#gender").val();
      $('#preview_gender').val(gender);
      
      var highschool_metriculation = $("#highschool_metriculation").val();
      $('#preview_highschool_metriculation').val(highschool_metriculation);

      var highschool_board_name = $("#highschool_board_name").val();
      $('#preview_highschool_board_name').val(highschool_board_name);

      var highschool_passing_year = $("#highschool_passing_year").val();
      $('#preview_highschool_passing_year').val(highschool_passing_year);

      var percentage_type = $("#percentage_type").val();
      $('#preview_percentage_type').val(percentage_type);

      var highschool_total_marks = $("#highschool_total_marks").val();
      $('#preview_highschool_total_marks').val(highschool_total_marks);

      var highschool_marks_obtained = $("#highschool_marks_obtained").val();
      $('#preview_highschool_marks_obtained').val(highschool_marks_obtained);

      var highschool_percentage = $("#highschool_percentage").val();
      $('#preview_highschool_percentage').val(highschool_percentage);

      var intermediate_board_name = $("#intermediate_board_name").val();
      $('#preview_intermediate_board_name').val(intermediate_board_name);

      var intermediate_passing_year = $("#intermediate_passing_year").val();
      $('#preview_intermediate_passing_year').val(intermediate_passing_year);

      var intermediate_total_marks = $("#intermediate_total_marks").val();
      $('#preview_intermediate_total_marks').val(intermediate_total_marks);

      var intermediate_marks_obtained = $("#intermediate_marks_obtained").val();
      $('#preview_intermediate_marks_obtained').val(intermediate_marks_obtained);

      var intermediate_percentage = $("#intermediate_percentage").val();
      $('#preview_intermediate_percentage').val(intermediate_percentage);

      var graduation_qualification = $("#graduation_qualification").val();
      $('#preview_graduation_qualification').val(graduation_qualification);

      var graduation_passing_year = $("#graduation_passing_year").val();
      $('#preview_graduation_passing_year').val(graduation_passing_year);

      var percentage_type1 = $("#percentage_type1").val();
      $('#preview_percentage_type1').val(percentage_type1);

      var graduation_total_marks = $("#graduation_total_marks").val();
      $('#preview_graduation_total_marks').val(graduation_total_marks);

      var graduation_marks_obtained = $("#graduation_marks_obtained").val();
      $('#preview_graduation_marks_obtained').val(graduation_marks_obtained);

      var graduation_percentage = $("#graduation_percentage").val();
      $('#preview_graduation_percentage').val(graduation_percentage);

      var post_graduation_qualification = $("#post_graduation_qualification").val();
      $('#preview_post_graduation_qualification').val(post_graduation_qualification);

      var post_graduation_passing_year = $("#post_graduation_passing_year").val();
      $('#preview_post_graduation_passing_year').val(post_graduation_passing_year);

      var percentage_type2 = $("#percentage_type2").val();
      $('#preview_percentage_type2').val(percentage_type2);

      var post_graduation_total_marks = $("#post_graduation_total_marks").val();
      $('#preview_post_graduation_total_marks').val(post_graduation_total_marks);

      var post_graduation_marks_obtained = $("#post_graduation_marks_obtained").val();
      $('#preview_post_graduation_marks_obtained').val(post_graduation_marks_obtained);

      var post_graduation_percentage = $("#post_graduation_percentage").val();
      $('#preview_post_graduation_percentage').val(post_graduation_percentage);

      var others_qualification = $("#others_qualification").val();
      $('#preview_others_qualification').val(others_qualification);

      var others_passing_year = $("#others_passing_year").val();
      $('#preview_others_passing_year').val(others_passing_year);

      var percentage_type3 = $("#percentage_type3").val();
      $('#preview_percentage_type3').val(percentage_type3);

      var others_total_marks = $("#others_total_marks").val();
      $('#preview_others_total_marks').val(others_total_marks);

      var others_marks_obtained = $("#others_marks_obtained").val();
      $('#preview_others_marks_obtained').val(others_marks_obtained);

      var others_percentage = $("#others_percentage").val();
      $('#preview_others_percentage').val(others_percentage);

      var caste_category = $("#caste_category").val();
      $('#preview_caste_category').val(caste_category);

      var religion = $("#religion").val();
      $('#preview_religion').val(religion);

      var marital_status = $("#marital_status").val();
      $('#preview_marital_status').val(marital_status);

      var nationality = $("#nationality").val();
      $('#preview_nationality').val(nationality);

      var aadhar_no = $("#aadhar_no").val();
      $('#preview_aadhar_no').val(aadhar_no);

      var ex_serviceman = $("#ex_serviceman").val();
      $('#preview_ex_serviceman').val(ex_serviceman);

      var physical_fitness = $("#physical_fitness").val();
      $('#preview_physical_fitness').val(physical_fitness);

      var employment_exchange = $("#employment_exchange").val();
      $('#preview_employment_exchange').val(employment_exchange);

      var physically_candicapped = $("#physically_candicapped").val();
      $('#preview_physically_candicapped').val(physically_candicapped);

      var present_address = $("#present_address").val();
      $('#preview_present_address').val(present_address);

      var present_address_state = $("#present_address_state").val();

      /********AJAX Code for present address state********/
         var state_id = present_address_state;
             var base_url = "<?php echo base_url(); ?>";
                var link = base_url+'Applicant/state_data/';
               $.ajax({
                  method: "POST",

                  url: link,
                  data: {'state_id':state_id},
                  success: function(result) {
                    console.log(result); 
    
                    var obj = JSON.parse(result);
                   
                  // $("#span_skill").html(obj.job_title);
                   $('#preview_present_address_state').val(obj.state_name);
                   event.preventDefault();

                  }
        
                });//ends ajax

      /******Ends ajax for present address state******/
      

      var present_address_city = $("#present_address_city").val();
      $('#preview_present_address_city').val(present_address_city);

      var present_address_pincode = $("#present_address_pincode").val();
      $('#preview_present_address_pincode').val(present_address_pincode);

      var permanent_address = $("#permanent_address").val();
      $('#preview_permanent_address').val(permanent_address);

      var permanent_address_state = $("#permanent_address_state").val();
      /********AJAX Code for present address state********/
         var state_id = permanent_address_state;
             var base_url = "<?php echo base_url(); ?>";
                var link = base_url+'Applicant/state_data/';
               $.ajax({
                  method: "POST",

                  url: link,
                  data: {'state_id':state_id},
                  success: function(result) {
                    console.log(result); 
    
                    var obj = JSON.parse(result);
                   
                  // $("#span_skill").html(obj.job_title);
                   $('#preview_permanent_address_state').val(obj.state_name);
                   event.preventDefault();

                  }
        
                });//ends ajax

      /******Ends ajax for present address state******/
      

      var permanent_address_city = $("#permanent_address_city").val();
      $('#preview_permanent_address_city').val(permanent_address_city);

      var permanent_address_pincode = $("#permanent_address_pincode").val();
      $('#preview_permanent_address_pincode').val(permanent_address_pincode);

      var working_experience = $("#working_experience").val();
      $('#preview_working_experience').val(working_experience);

      
      $('#preview_myModal').modal('show');

        
    });
  


  $("#uploaded_photo_sign").change(function(){
        readURL(this);
    });

  function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview_uploaded_photo_sign').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#dob_certificate").change(function(){
        readURL_dob(this);
    });

    function readURL_dob(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview_dob_certificate').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#matriculation_marksheet").change(function(){
        readURL_matriculation_marksheet(this);
    });

    function readURL_matriculation_marksheet(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview_matriculation_marksheet').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

     $("#scc_St_obc_certificate").change(function(){
        readURL_scc_St_obc(this);
    });

    function readURL_scc_St_obc(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#preview_scc_St_obc_certificate').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    /***********Display year 1980 to current year*********/

    var html = '';
  for (var i = 1980; i <= new Date().getFullYear(); i++) {
      html += '<option value="' + i + '">' + i + '</option>';
  }
  $('#highschool_passing_year').append(html);

  var html2 = '';
  for (var i = 1980; i <= new Date().getFullYear(); i++) {
      html2 += '<option value="' + i + '">' + i + '</option>';
  }
  $('#intermediate_passing_year').append(html);


  var html3 = '';
  for (var i = 1980; i <= new Date().getFullYear(); i++) {
      html3 += '<option value="' + i + '">' + i + '</option>';
  }
  $('#graduation_passing_year').append(html);

  var html4 = '';
  for (var i = 1980; i <= new Date().getFullYear(); i++) {
      html4 += '<option value="' + i + '">' + i + '</option>';
  }
  $('#post_graduation_passing_year').append(html);

  var html5 = '';
  for (var i = 1980; i <= new Date().getFullYear(); i++) {
      html5 += '<option value="' + i + '">' + i + '</option>';
  }
  $('#others_passing_year').append(html);

  /*********Percentage Type*******/


    $("#percentage_type").change(function(){
       var percnt_type =  $("#percentage_type").val();
         if(percnt_type == 'Grade')
         {
            $('#highschool_total_marks').prop('readonly', true);
            $('#highschool_marks_obtained').prop('readonly', true);
            $("#highschool_total_marks").val("");
            $("#highschool_marks_obtained").val("");
            $("#highschool_percentage").val("");
            
            
         }

         else
         {
            $('#highschool_total_marks').prop('readonly', false);
            $('#highschool_marks_obtained').prop('readonly', false);
            $("#highschool_total_marks").val("");
            $("#highschool_marks_obtained").val("");
            $("#highschool_percentage").val("");
         }
    });///

    $("#percentage_type1").change(function(){
       var percnt_type =  $("#percentage_type1").val();
         if(percnt_type == 'Grade')
         {
            $('#graduation_total_marks').prop('readonly', true);
            $('#graduation_marks_obtained').prop('readonly', true);
            $("#graduation_total_marks").val("");
            $("#graduation_marks_obtained").val("");
            $("#graduation_percentage").val("");
            
            
         }

         else
         {
            $('#graduation_total_marks').prop('readonly', false);
            $('#graduation_marks_obtained').prop('readonly', false);
            $("#graduation_total_marks").val("");
            $("#graduation_marks_obtained").val("");
            $("#graduation_percentage").val("");
         }
    });///

    $("#percentage_type2").change(function(){
       var percnt_type =  $("#percentage_type2").val();
         if(percnt_type == 'Grade')
         {
            $('#post_graduation_total_marks').prop('readonly', true);
            $('#post_graduation_marks_obtained').prop('readonly', true);
            $("#post_graduation_total_marks").val("");
            $("#post_graduation_marks_obtained").val("");
            $("#post_graduation_percentage").val("");
            
            
         }

         else
         {
            $('#post_graduation_total_marks').prop('readonly', false);
            $('#post_graduation_marks_obtained').prop('readonly', false);
            $("#post_graduation_total_marks").val("");
            $("#post_graduation_marks_obtained").val("");
            $("#post_graduation_percentage").val("");
         }
    });//

    $("#percentage_type3").change(function(){
       var percnt_type =  $("#percentage_type3").val();
         if(percnt_type == 'Grade')
         {
            $('#others_total_marks').prop('readonly', true);
            $('#others_marks_obtained').prop('readonly', true);
            $("#others_total_marks").val("");
            $("#others_marks_obtained").val("");
            $("#others_percentage").val("");
            
            
         }

         else
         {
            $('#others_total_marks').prop('readonly', false);
            $('#others_marks_obtained').prop('readonly', false);
            $("#others_total_marks").val("");
            $("#others_marks_obtained").val("");
            $("#others_percentage").val("");
            
         }
    });

    function remove_errors(element) 
    {
      $("." + element).hide();
    }

  function remove_errors2(element) 
    {
      $("." + element).css({ opacity: 0 });
  }

  
  function encadhar(adhar_1) 
  {

    var rawdt = "<?php echo $this->config->item('salt_keyy'); ?>";
    var ency  = CryptoJS.AES.encrypt(adhar_1,rawdt);

     return ency;
    
  }
  
  </script>
  

 