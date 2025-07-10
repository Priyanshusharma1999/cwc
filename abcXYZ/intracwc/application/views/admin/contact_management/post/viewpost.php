    
     <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box" style="float:left;width:100%;">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Post</h6>
                                <hr>
                       

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation<span class="required"></span></label>
                                    <?php 
                                        $organisation_data = $this->Base_model->get_record_by_id('contact_organisation', array('contact_organisation_id' => $post_data->contact_organisation_id));
                                        echo $organisation_data->contact_organisation_name;
                                    ?>
                                   
                                </div>
                            </div>

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Post Name<span class="required"></span></label>
                                    <?php echo $post_data->contact_post_name; ?>
                                </div>
                            </div>
                           
                            
                            
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

