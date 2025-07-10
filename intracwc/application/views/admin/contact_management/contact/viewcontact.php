    
     <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">View Contact</h6>
                                <hr>
                        

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Wing<span class="required"></span></label>
                                    <?php echo $contact_user_data->contact_wing;?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Organisation<span class="required"></span></label>
                                   <?php echo $contact_user_data->contact_organisation;?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Post<span class="required"></span></label>
                                    <?php echo $contact_user_data->contact_post;?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Designation<span class="required"></span></label>
                                    <?php echo $contact_user_data->contact_designation;?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Reporting<span class="required"></span></label>
                                   <?php 
                                          $parent_id = $this->Base_model->get_all_record_by_condition('contact_relation', array('contact_child_id'=>$contact_user_data->contact_detail_master_id));

                                          $p = array();
                                          foreach ($parent_id as $parent)
                                           {
                                              if($parent->contact_parent_id==0)
                                              {
                                                $p[] = 'Not available';
                                              }

                                              else
                                              {
                                                 $ps = $this->Base_model->get_record_by_id('contact_detail_master', array('contact_detail_master_id' => $parent->contact_parent_id));
                                                $p[] = $ps->name.' | '.$ps->contact_organisation.' | '.$ps->contact_wing.$ps->contact_designation;
                                              }
                                          }
                                            $a = implode(',', $p);
                                            echo $a;
                                       
                                       
                                    ?>
                                </div>
                            </div>

                           <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Name<span class="required"></span></label>
                                   <?php echo $contact_user_data->name;?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Mobile No.<span class="required"></span></label>
                                   <?php echo $contact_user_data->mobile_no;?>
                                </div>
                            </div>


                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Office No.<span class="required"></span></label>
                                    <?php echo $contact_user_data->office_no;?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Residence No.<span class="required"></span></label>
                                    <?php echo $contact_user_data->res_no;?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Floor<span class="required"></span></label>
                                   <?php echo $contact_user_data->room_no;?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Extension No.<span class="required"></span></label>
                                    <?php echo $contact_user_data->extension_no;?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fax No.<span class="required"></span></label>
                                    <?php echo $contact_user_data->fax_no;?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Office Address<span class="required"></span></label>
                                   <?php echo $contact_user_data->office_address;?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>State<span class="required"></span></label>
                                    <?php 
                                        $state_data = $this->Base_model->get_record_by_id('state_master', array('State_Code' => $contact_user_data->state));
                                        echo $state_data->StateName_In_English;
                                    ?>
                                   
                                </div>
                            </div>

                             <div class="col-sm-6">
                                <div class="form-group">
                                    <label>City<span class="required"></span></label>
                                    <?php echo $contact_user_data->city;?>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Pincode<span class="required"></span></label>
                                    <?php echo $contact_user_data->pincode;?>
                                </div>
                            </div>

                                
                          <div id="accordion" class="panel-group">
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                Upper Level <i class="fa fa-chevron-up"></i> <i class="fa fa-chevron-down"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <?php
                                           $uri = $this->uri->segment('4');
                                            $parent= $this->Base_model->get_all_record_by_condition('contact_relation', array('contact_child_id'=>$uri));
                                            
                                            $all_upper = array();
                                            foreach ($parent as $parent_data) 
                                            {
                                                if($parent_data->contact_parent_id=='0')
                                                {
                                                        $parent_id = '1';
                                                }

                                                else
                                                {
                                                     $parent_id = $parent_data->contact_parent_id;
                                                }
                                                $all_upper[] =  $this->Base_model->get_record_by_id('contact_detail_master', array('contact_detail_master_id' => $parent_id,'delete_status'=>1));
                                            }//ends foreach
                                    
                                            $all_contacts    = $all_upper;
                                            ?>
                                                 <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Contact Name</th>
                                            <th>Wing Name</th>
                                            <th>Organisation Name</th>
                                            <th>Post Name</th>
                                            <th>Designation Name</th>
                                            <th>One Level Up Hierarchy Level</th>
                                            <th>One Level Down Hierarchy Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                            if($all_contacts) {
                                                $i=1;
                                                foreach($all_contacts as $contact) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $contact->name;?></td>
                                            <td><?php echo $contact->contact_wing;?></td>
                                            <td><?php echo $contact->contact_organisation;?></td>
                                            <td><?php echo $contact->contact_post;?></td>
                                            <td><?php echo $contact->contact_designation;?></td>
                                            <td>
                                                <?php
                                                
                                                    $parent_relation_data = $this->Base_model->get_record_by_id('contact_relation', array('contact_child_id' => $contact->contact_detail_master_id));

                                                    if($parent_relation_data->contact_parent_id==0)
                                                    {
                                                        echo 'Not available';
                                                    }

                                                    else
                                                    {?>
                                                        <a href="<?php echo base_url('Contact/Contactdetail/upper_second/'.$parent_relation_data->contact_parent_id) ?>">One Level Up Hierarchy Level</a>
                                                    <?php }?>
                                                
                                                    
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('Contact/Contactdetail/lower/'.$contact->contact_detail_master_id) ?>">One Level Down Hierarchy Level</a>
                                                    
                                            </td>
                                            <td>
                                               <a href="<?php echo base_url('Contact/Contactdetail/view_contact/'.$contact->contact_detail_master_id) ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                                                
                                               <!--  <button data-toggle="modal"  data-target="#deleteModal" onclick="remove_contact(<?php //echo $contact->contact_detail_master_id ;?>)"  class="btn btn-sm btn-danger"><i class="fa fa-close"></i></button> -->
                                            </td>
                                        </tr>
                                        <?php $i++;} } else { ?>
                                        <tr><td>No data found</td></tr>
                                        <?php } ?>
                                            
                                    </tbody>
                                </table>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">Lower Level 
                                                <i class="fa fa-chevron-up"></i> <i class="fa fa-chevron-down"></i>
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <?php
                                            $uri = $this->uri->segment('4');
                                            $childs= $this->Base_model->get_all_record_by_condition('contact_relation', array('contact_parent_id'=>$uri));
                                            
                                            foreach ($childs as $child) 
                                            {
                                                $chld[] =  $this->Base_model->get_record_by_id('contact_detail_master', array('contact_detail_master_id' => $child->contact_child_id,'delete_status'=>1));
                                            }
                                            
                                            $all_contacts = $chld;
                                            ?>
                                             <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Contact Name</th>
                                            <th>Wing Name</th>
                                            <th>Organisation Name</th>
                                            <th>Post Name</th>
                                            <th>Designation Name</th>
                                            <th>One Level Up Hierarchy Level</th>
                                            <th>One Level Down Hierarchy Level</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                            if($all_contacts) {
                                                $i=1;
                                                foreach($all_contacts as $contact) { ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td><?php echo $contact->name;?></td>
                                            <td><?php echo $contact->contact_wing;?></td>
                                            <td><?php echo $contact->contact_organisation;?></td>
                                            <td><?php echo $contact->contact_post;?></td>
                                            <td><?php echo $contact->contact_designation;?></td>
                                            <td>
                                                <?php
                                                
                                                    $parent_relation_data = $this->Base_model->get_record_by_id('contact_relation', array('contact_child_id' => $contact->contact_detail_master_id));

                                                    if($parent_relation_data->contact_parent_id==0)
                                                    {
                                                        echo 'Not available';
                                                    }

                                                    else
                                                    {?>
                                                        <a href="<?php echo base_url('Contact/Contactdetail/upper_second/'.$parent_relation_data->contact_parent_id) ?>">One Level Up Hierarchy Level</a>
                                                    <?php }?>
                                                
                                                    
                                            </td>
                                            <td>
                                                <a href="<?php echo base_url('Contact/Contactdetail/lower/'.$contact->contact_detail_master_id) ?>">One Level Down Hierarchy Level</a>
                                                    
                                            </td>
                                            <td>
                                               <a href="<?php echo base_url('Contact/Contactdetail/view_contact/'.$contact->contact_detail_master_id) ?>" class="btn btn-sm btn-warning"><i class="fa fa-eye"></i></a>
                                        
                                            </td>
                                        </tr>
                                        <?php $i++;} } else { ?>
                                        <tr><td>No data found</td></tr>
                                        <?php } ?>
                                            
                                    </tbody>
                                </table>
                                        </div>
                                    </div>
                                </div>
</div><!--end accordina-->
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
      

<style>

   label{width:30%;}

   .panel-group{

    width: 100%;
    clear: both;
   }

   .panel-group .panel{margin-bottom: 15px;}

   .panel-group .panel-title a{width:100%;display:block;}

   .panel-group .panel-title a:hover,.panel-group .panel-title a:active,.panel-group .panel-title a:focus{color:#fff;}

   .panel-group .panel-title a[aria-expanded="true"] .fa-chevron-up{float:right;display:none;}
   .panel-group .panel-title a[aria-expanded="true"] .fa-chevron-down{float:right;display:block;}
   .panel-group .panel-title a .fa-chevron-up{float:right;display:block;}
   .panel-group .panel-title a .fa-chevron-down{float:right;display:none;}

</style>