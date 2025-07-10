      
        <div class="page-wrapper">
            <div class="content container-fluid">

            	<?php $user_role_data  = $this->Base_model->get_all_record_by_condition('save_users_role', array('user_id' => $this->session->userdata('user_id'))); 

            	foreach ($user_role_data as $role_id)
				   {
				   		$user_roles[]= $role_id->role_id;
				   }

            	?>


            	<?php $servicetype = array();

            	   $user_access  = $this->Base_model->get_all_record_by_condition('user_access', array('user_id' => $this->session->userdata('user_id'))); 

            	foreach ($user_access as $uaccess)
				   {
				   		$servicetype[]= $uaccess->service_type;
				   }

            	?>
                
				<div class="row">

					<?php if (in_array("1", $user_roles) || in_array("15", $user_roles) || in_array("16", $user_roles)){ ?>

					        <div class="col-md-4">
					          <div class="info-box bg-blue">
					            <span class="info-box-icon push-bottom"><i class="fa fa-user"></i></span>
					            <div class="info-box-content">
					              <span class="info-box-text">Admin</span>
					              <div class="progress">
					                <div class="progress-bar width-60"></div>
					              </div>
					              <span class="progress-description">
					                    <a href="<?php echo base_url();?>Administrator/Masterdata">Click Here <i class="fa fa-arrow-circle-right"></i></a>
					               </span>
					            </div>
					            <!-- /.info-box-content -->
					          </div>
					          <!-- /.info-box -->
					        </div>
					        <!-- /.col -->

					    <?php } ?>
					    
					     <?php if ((!in_array("14", $user_roles)) && in_array("1", $servicetype)){ ?>

					       <div class="col-md-4">
					          <div class="info-box bg-orange">
					            <span class="info-box-icon push-bottom"><i class="fa fa-book"></i></span>
					            <div class="info-box-content">
					              <span class="info-box-text">Non IT Online Stationery</span>
					              <div class="progress">
					                <div class="progress-bar width-40"></div>
					              </div>
					              <span class="progress-description">
					                     <a href="<?php echo site_url();?>onlinestationary/Category">Click Here <i class="fa fa-arrow-circle-right"></i></a>
					               </span>
					            </div>
					          </div>
					        </div>
                          
                          <?php } ?>

                          <?php if ((!in_array("14", $user_roles)) && in_array("2", $servicetype)){ ?>

							 <div class="col-md-4">
					          <div class="info-box bg-orange">
					            <span class="info-box-icon push-bottom"><i class="fa fa-book"></i></span>
					            <div class="info-box-content">
					              <span class="info-box-text">IT Online Stationery</span>
					              <div class="progress">
					                <div class="progress-bar width-40"></div>
					              </div>
					              <span class="progress-description">
					                     <a href="<?php echo site_url();?>itonlinestationary/Category">Click Here <i class="fa fa-arrow-circle-right"></i></a>
					               </span>
					            </div>
					          </div>
					        </div>

					    <?php } ?>

					     <?php if (in_array("1", $user_roles) || in_array("2", $servicetype)){ ?>
					        
					        <div class="col-md-4">
					          <div class="info-box bg-purple">
					            <span class="info-box-icon push-bottom"><i class="fa fa-comments"></i></span>
					            <div class="info-box-content">
					              <span class="info-box-text">IT Complaints Management System</span>
					           
					              <div class="progress">
					                <div class="progress-bar width-80"></div>
					              </div>
					              <span class="progress-description">
					                  
					                  <?php if(in_array("1", $user_roles) || in_array("14", $user_roles)){?>
					                      <a href="<?php echo site_url();?>itcomplaint/solvecomplain">Click Here <i class="fa fa-arrow-circle-right"></i></a>
					                  <?php } else {?>
					                      <a href="<?php echo site_url();?>itcomplaint/complain">Click Here <i class="fa fa-arrow-circle-right"></i></a>
					                  <?php } ?>
					                   
					               </span>
					            </div>
					            <!-- /.info-box-content -->
					          </div>
					          <!-- /.info-box -->
					        </div>
					        <!-- /.col -->

					     <?php } ?>   

                          <?php if (in_array("1", $user_roles) || in_array("1", $servicetype)){ ?>

                              <div class="col-md-4">
					          <div class="info-box bg-purple">
					            <span class="info-box-icon push-bottom"><i class="fa fa-comments"></i></span>
					            <div class="info-box-content">
					              <span class="info-box-text">Non IT Complaints Management System</span>
					           
					              <div class="progress">
					                <div class="progress-bar width-80"></div>
					              </div>
					              <span class="progress-description">
					                    <?php if(in_array("1", $user_roles) || in_array("14", $user_roles)){?>
					                      <a href="<?php echo site_url();?>nonitcomplaint/solvecomplain">Click Here <i class="fa fa-arrow-circle-right"></i></a>
					                  <?php } else {?>
					                      <a href="<?php echo site_url();?>nonitcomplaint/complain">Click Here <i class="fa fa-arrow-circle-right"></i></a>
					                  <?php } ?>
					               </span>
					            </div>
					            <!-- /.info-box-content -->
					          </div>
					      </div>
					          <!-- /.info-box -->

					      <?php } ?>

                           <!--  <div class="col-md-4">
					          <div class="info-box bg-blue">
					            <span class="info-box-icon push-bottom"><i class="fa fa-user"></i></span>
					            <div class="info-box-content">
					              <span class="info-box-text">Contact Management</span>
					              <div class="progress">
					                <div class="progress-bar width-60"></div>
					              </div>
					              <span class="progress-description">
					                    <a href="<?php //echo base_url();?>Contact/Organisation">Click Here <i class="fa fa-arrow-circle-right"></i></a>
					               </span>
					            </div>
					        </div>
					        </div> -->
						

				 </div>
				
               
            </div>
        </div>
	

 <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        <div class="modal-body">
          <p>coming soon..</p>
        </div>
      </div>
      
    </div>
  </div>

<style>
  .modal-dialog{

    background: #28a745;
    border: 0;
    color: #fff;
    font-size: 35px;
    text-align: center;
    padding: 25px;
    border-radius: 20px;    
    margin:100px auto;
}


.modal-content{
   
      box-shadow: none;
    border: 0;
    background: transparent;  

}

.close{
      opacity: 1;
    position: absolute;
    top: -40px;
    right: -30px;
    background: #fff!important;
    width: 30px;
    height: 30px;
    border-radius: 5px;
}

.close:hover{
    opacity: 1;
}

.modal-body {
    position: relative;
    padding: 15px;
    float: none;
    width: 100%;
    background: transparent;
}

</style>
  	
