
    
     <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Applicant List</h6>
                                <hr>
                                <label>Total Applicant : <?php echo count($all_applicant_data);?> </label>
                                <?php
                                $attributes = array('class' => 'form-inline sr-form', 'id' =>'');
                                echo form_open_multipart('Applicant_admin/search_applicant/',$attributes);?>
                                <!-- <form class="form-inline sr-form" action="#"> -->

                                  <div class="form-group">
                                    <input name = "applicant_name" type="text" class="form-control" placeholder="Applicant Name" >
                                  </div>
                                  <div class="form-group">
                                    <select name = "post_name" class="form-control" id = "">
                                       <option selected="selected" value="">Select Post</option>
                                        <?php
                                            if(empty($all_jobs))
                                            {
                                                echo '<option value="1">'.'Select Region'.'</option>';
                                            }
                                            else
                                            {
                                                foreach ($all_jobs as $post)
                                              {   
                                                 echo '<option value="'.$post->id.'">'.$post->job_title.'</option>';
                                              }
                                            }
                                          
                                        ?>
                                        
                                    </select>
                                  </div>

                                  
                                <div class="form-group">
                                   
                                    <select  id ="caste_category" name = "caste_category"  class="form-control">
                                       <option value="">Select Category</option>
                                       <option value="General">General</option>
                                       <option value="OBC">OBC</option>
                                       <option value="SC/ST">SC/ST</option>
                                       <option value="Other">Other</option>
                                    </select>
                                    <span class="error_50"></span>
                                </div>
                   
                                <div class="form-group">
                                   
                                    <select id = "ex_serviceman" name = "ex_serviceman"  class="form-control">
                                       <option value="">Select Ex-Servicema</option>
                                       <option value="Yes">Yes</option>
                                       <option value="No">No</option>
                                    </select>
                                    <span class="error_66"></span>
                                </div>
                            
                                  <button type="submit" class="btn btn-success btn-search">Search</button>
                                <?php echo form_close(); ?>
                                <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Contact No.</th>
                                            <th>Job Applied For</th>
                                            <th>Applied Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if($all_applicant_data) {
                                        foreach($all_applicant_data as $applicant_data) { ?>
                                        <tr>
                                            <td>
                                                <?php 
                                                $applicant = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $applicant_data->applicant_id));
                                                if(empty($applicant))
                                                {
                                                        echo '';
                                                }
                                                else
                                                {
                                                        echo $applicant->name;
                                                }
                                            ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $applicant = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $applicant_data->applicant_id));
                                                if(empty($applicant))
                                                {
                                                        echo '';
                                                }
                                                else
                                                {
                                                        echo $applicant->email;
                                                }
                                            ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $applicant = $this->Base_model->get_record_by_id('tbl_applicant', array('id' => $applicant_data->applicant_id));
                                                if(empty($applicant))
                                                {
                                                        echo '';
                                                }
                                                else
                                                {
                                                        echo $applicant->mobile_no;
                                                }
                                            ?>
                                            </td>
                                            <td>
                                                <?php 
                                                $job = $this->Base_model->get_record_by_id('tbl_jobs', array('id' => $applicant_data->job_id));
                                                if(empty($job))
                                                {
                                                        echo '';
                                                }
                                                else
                                                {
                                                        echo $job->job_title;
                                                }
                                            ?>
                                            </td>
                                            <td>
                                                <?php echo date('d/m/Y',strtotime($applicant_data->created_date)); ?>
                                            </td>
                                            <?php $pdf_name =  $applicant_data->pdf_name;
                                                    $url ='http://103.70.201.212:2001/cwc-jobs/uploads/applicant_pdf/'.$pdf_name.'.pdf'; ?>
                                            <td>
                                                <a href = "<?php echo base_url('Applicant_admin/edit_job/'.$applicant_data->id) ?>" class="btn btn-sm btn-primary"><i class="fa fa-eye"></i>Edit</a>
                                                <a href = "<?php echo base_url('Applicant_admin/view_job/'.$applicant_data->id) ?>" class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a>
                                                 <button type="button" class=" btn btn-sm btn-danger" onclick="printJS('<?php echo $url; ?>')">Print </button>
                                              <!--  <a class="btn btn-sm btn-success"><i class="fa fa-eye"></i>View</a> -->
                                            </td>
                                        </tr>
                                         <?php } } else { ?>
                                        <tr><td>No applicant found</td></tr>
                                        <?php } ?>
                                        
                                    
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

