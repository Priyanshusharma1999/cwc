   <?php $user_role =  $this->session->userdata('user_role');?>
        <div class="page-wrapper">
            <div class="content container-fluid">
                
             <div class="row">
                   
                   <?php 

                   if($user_role ==1){ ?>
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><?php echo count($superadmin_pension_pending); ?></span>
                            <div class="dash-widget-info">
                                <span>Pending Pension cases for settlement</span>
                            </div>
                        </div>
                    </div>
                    
                   

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><?php echo count($superadmin_pension_settled); ?></span>
                            <div class="dash-widget-info">
                                <span>Pension Cases in CWC settled w.e.f </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                        <span class="dash-widget-icon bg-info"><?php echo count($superadmin_pension_pending_pao); ?></span>
                            <div class="dash-widget-info">
                                <span>Pension cases pending in PAO, CWC, New Delhi as on date</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><?php echo count($superadmin_pension_retired_employee); ?></span>
                            <div class="dash-widget-info">
                                <span>Employees of CWC due to retire in 8 months</span>
                            </div>
                        </div>
                    </div>

                     <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                        <span class="dash-widget-icon bg-info"><?php echo count($superadmin_pension_paper_submit_status); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pending Pension cases for Paper Submission:</span>
                            </div>
                        </div>
                    </div>

                    <?php } else if($user_role ==2){ ?> 

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><?php echo count($organisation_admin_pension_pending); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pending Pension cases of Organisation  </span>
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
                    
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5" style="min-height:144px;">
                           <span class="dash-widget-icon bg-info"><?php echo count($organisation_admin_pension_settled); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pension Cases in Organisation settled w.e.f </span>
                                <span></span>
                            </div>
                        </div>
                    </div>

                      <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><?php echo count($organisation_admin_pension_paper_submit_status); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pending Pension cases for Paper Submission:</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><?php echo count($organisation_admin_pension_pending_pao); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pension cases of Organisation pending in PAO, CWC, New Delhi as on date</span>
                            </div>
                        </div>
                    </div>
                   
                    <?php foreach ($total_division as $division) { ?>
                       <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><?php echo $division['count']; ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pension cases of under process in (<?php echo $division['division_name']; ?>) </span>
                            </div>
                        </div>
                    </div>
                    <?php } ?>
                   
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><?php echo count($organisation_admin_pension_ppo_empty); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pension cases of (Name of the Organisation) under process in Divisions</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><?php echo count($organisation_admin_pension_retired_employee); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of employees of (Name of the Organisation) due to retire in 8 months</span>
                            </div>
                        </div>
                    </div>
                    
                    <?php } else if($user_role ==3){ ?> 

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><?php echo count($pao_admin_pension_pending); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pending Pension cases for settlement: </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><?php echo count($pao_admin_pension_paper_submit_status); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pending Pension cases for Paper Submission:</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><?php echo count($pao_admin_pension_settled); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pension Cases in CWC settled w.e.f    (Date) </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><?php echo count($pao_admin_pension_pending_pao); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pension cases pending in PAO, CWC, New Delhi as on date</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><?php echo count($pao_admin_pension_retired_employee); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of employees of CWC due to retire in 8 months</span>
                            </div>
                        </div>
                    </div>

                    <?php } else if($user_role ==4){ ?>

                        <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                        <span class="dash-widget-icon bg-info"><?php echo count($division_admin_pension_pending);?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pending Pension cases of (Name of the Division)</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                           <span class="dash-widget-icon bg-info"><?php echo count($division_admin_pension_settled);?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pension Cases in (Name of the Division) settled w.e.f (Date) </span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                         <span class="dash-widget-icon bg-info"><?php echo count($division_admin_pension_settled);?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pending Pension cases for Paper Submission:</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                            <span class="dash-widget-icon bg-info"><?php echo count($division_admin_pension_pending_pao);?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pension cases of (Name of the Division) pending in PAO, CWC, New Delhi as on date</span>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                        <span class="dash-widget-icon bg-info"><?php echo count($division_admin_pension_ppo_empty);?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of Pending Pension cases under process in (Name of Division-1)</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-6 col-lg-4">
                        <div class="dash-widget dash-widget5">
                          <span class="dash-widget-icon bg-info"><?php echo count($division_admin_pension_retired_employee); ?></span>
                            <div class="dash-widget-info">
                                <span>Total Number of employees of  (Name of the Organisation) due to retire in 8 months</span>
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

        <script>

          
                // actual PDF options
                function printPDF() {
                   // let name = document.getElementById("namee2").value;
                    //let orgn = document.getElementById("namee3").value;
                    let name = '';
                    let orgn = '';
                    let date = document.getElementById("namee4").value;
                    var convert_date = new Date(date).toDateString("yyyy-MM-dd");
                 
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

    