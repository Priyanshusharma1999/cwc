   <?php $user_role =  $this->session->userdata('user_role');?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                
             <div class="row">
                   
                   <?php 

                   if($user_role ==1){ ?>
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($superadmin_pension_pending); ?></h3>
                                <span>Pending Pension cases for settlement</span>
                            </div>
                        </div>
                    </div>
                    
                   

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($superadmin_pension_settled); ?></h3>
                                <span>Pension Cases in CWC settled w.e.f </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($superadmin_pension_pending_pao); ?></h3>
                                <span>Pension cases pending in PAO, CWC, New Delhi as on date</span>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php //echo count($superadmin_pension_ppo_empty); ?></h3>
                                <span>Pension cases under process in CWC</span>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($superadmin_pension_retired_employee); ?></h3>
                                <span>Employees of CWC due to retire in 8 months</span>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($superadmin_pension_paper_submit_status); ?></h3>
                                <span>Total Number of Pending Pension cases for Paper Submission:</span>
                            </div>
                        </div>
                    </div>

                    <?php } else if($user_role ==2){ ?> 

                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($organisation_admin_pension_pending); ?></h3>
                                <span>Total Number of Pending Pension cases of Organisation <?php if(!empty($organisation_name)) echo '"'.$organisation_name.'"'; else echo ''; ?>  </span>
                                <?php

                                    if($organisation_certificate=='Generate_Certificate')
                                    {?>
                                        <span><a onclick="printPDF()" style="cursor:pointer;">Generate Certificate</a></span>
                                        
                                    <?php } else {?>

                                            <span></span>

                                       <?php  }
                                        ?>

                                    
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5" style="min-height:144px;">
                           <span class="dash-widget-icon bg-info"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($organisation_admin_pension_settled); ?></h3>
                                <span>Total Number of Pension Cases in Organisation <?php if(!empty($organisation_name)) echo '"'.$organisation_name.'"'; else echo ''; ?>  settled w.e.f </span>
                                <span></span>
                            </div>
                        </div>
                    </div>

                      <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($organisation_admin_pension_paper_submit_status); ?></h3>
                                <span>Total Number of Pending Pension cases for Paper Submission:</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($organisation_admin_pension_pending_pao); ?></h3>
                                <span>Total Number of Pension cases of Organisation <?php if(!empty($organisation_name)) echo '"'.$organisation_name.'"'; else echo ''; ?> pending in PAO, CWC, New Delhi as on date</span>
                            </div>
                        </div>
                    </div>
                   
                    <?php foreach ($total_division as $division) { ?>
                       <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo $division['count']; ?></h3>
                                <span>Total Number of Pension cases of under process in "<?php echo $division['division_name']; ?>" </span>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                   
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($organisation_admin_pension_ppo_empty); ?></h3>
                                <span>Total Number of Pension cases of "<?php if(!empty($organisation_name)) echo $organisation_name; else echo 'Name of Organisation'?>" under process in Divisions</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($organisation_admin_pension_retired_employee); ?></h3>
                                <span>Total Number of employees of "<?php if(!empty($organisation_name)) echo $organisation_name; else echo 'Name of Organisation'?>" due to retire in 8 months</span>
                            </div>
                        </div>
                    </div>
                    
                    <?php } else if($user_role ==3){ ?> 

                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($pao_admin_pension_pending); ?></h3>
                                <span>Total Number of Pending Pension cases for settlement: </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($pao_admin_pension_paper_submit_status); ?></h3>
                                <span>Total Number of Pending Pension cases for Paper Submission:</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($pao_admin_pension_settled); ?></h3>
                                <span>Total Number of Pension Cases in CWC settled w.e.f    <?php $current_timestamp = strtotime("now");
								$current_date =  date("d F Y", $current_timestamp);
								echo '( '.$current_date. ' )';?> </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($pao_admin_pension_pending_pao); ?></h3>
                                <span>Total Number of Pension cases pending in PAO, CWC, New Delhi as on date</span>
                            </div>
                        </div>
                    </div>
                    
                    <!-- <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php //echo count($pao_admin_pension_ppo_empty); ?></h3>
                                <span>Total Number of Pension cases under process in CWC </span>
                            </div>
                        </div>
                    </div> -->

                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($pao_admin_pension_retired_employee); ?></h3>
                                <span>Total Number of employees of CWC due to retire in 8 months</span>
                            </div>
                        </div>
                    </div>

                    <?php } else if($user_role ==4){ ?>

                        <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($division_admin_pension_pending);?></h3>
                                <span>Total Number of Pending Pension cases of <?php echo '" '.$user_division_name.' "'; ?></span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($division_admin_pension_settled);?></h3>
                                <span>Total Number of Pension Cases in <?php echo '" '.$user_division_name.' " '; ?> settled w.e.f <?php $current_timestamp = strtotime("now");
								$current_date =  date("d F Y", $current_timestamp);
								echo '( '.$current_date. ' )';?> </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($division_admin_pension_paper_submit_status); ?></h3>
                                <span>Total Number of Pending Pension cases for Paper Submission:</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($division_admin_pension_pending_pao);?></h3>
                                <span>Total Number of Pension cases of <?php echo '" '.$user_division_name.' " '; ?> pending in PAO, CWC, New Delhi as on date</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><i class="fa fa-files-o"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($division_admin_pension_ppo_empty);?></h3>
                                <span>Total Number of Pending Pension cases under process in <?php echo '" '.$user_division_name.' " ';?></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-6">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><i class="fa fa-files-o" aria-hidden="true"></i></span>
                            <div class="dash-widget-info">
                                <h3><?php echo count($division_admin_pension_retired_employee); ?></h3>
                                <span>Total Number of employees of <?php echo '" '.$user_division_name.' " ';?>  due to retire in 8 months</span>
                            </div>
                        </div>

                    </div>
                    
                    <?php } ?>
                    
                    
                   
                </div> 
               
            </div>
        </div>

        <?php 

            $json_orgn_name = json_encode($organisation_name); 
            $json_user_name = json_encode($user_name); 
            $json_date      = json_encode(date("Y/m/d")); 

        ?>
        <style>

      input{
            border: 0;
            border-bottom: 1px solid #333;
            min-width: 250px;
      }

   </style>
<!--      <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js" integrity="sha256-vIL0pZJsOKSz76KKVCyLxzkOT00vXs+Qz4fYRVMoDhw=" crossorigin="anonymous"> -->
    </script>

        <script>

          
                // actual PDF options
                function printPDF() {
                   // let name = document.getElementById("namee2").value;
                    //let orgn = document.getElementById("namee3").value;
                    let name = '';
                    let orgn = '';
                    let date = document.getElementById("namee4").value;
                    var convert_date = new Date<?php $current_timestamp = strtotime("now");
								$current_date =  date("d F Y", $current_timestamp);
								echo '( '.$current_date. ' )';?>.toDateString("yyyy-MM-dd");
                 
                      var lMargin=15; //left margin in mm
                      var rMargin=15; //right margin in mm
                      var pdfInMM=210;  // width of A4 in mm

                      var doc = new jsPDF("p","mm","a4");
                      doc.text('Certificate', 85, 10);
                      doc.setFontType("Arial");
                      doc.setFontSize(13);
                     // var paragraph=`It is certified that no pension case in respect of " `+ name + `" Organisation Name "`+ orgn + `" office is pending either with PAO or with this office.`; 
                     var paragraph=`It is certified that no pension cases in pespect of " CWC(HQ)-Traning Dte., New Delhi "is pending either with PAO or with this organization/office as on " `+ convert_date + `"`;  
                     var lines =doc.splitTextToSize(paragraph, (pdfInMM-lMargin-rMargin));
                     doc.text(lMargin,20,lines);
              

                    //doc.text(14, 80, `Dated: `+ convert_date);
                    doc.save('Certificate.pdf');
                    
                }
         
             
    </script>

    