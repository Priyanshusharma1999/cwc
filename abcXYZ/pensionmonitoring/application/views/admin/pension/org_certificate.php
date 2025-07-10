    
    <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-xs-7">
                        <h4 class="page-title">Generate Certificate</h4>
                    </div>
          
                </div>
                <div class="card-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="profile-view">
                              <?php
                                $attributes = array('class' => '', 'id' =>'');
                                  echo form_open_multipart('Pension/generate_certificate/',$attributes);?>
                                    <div class="row" id="content">
                                        <div class="col-md-12">
                                             <p>
                                                It is certified that no pension case in respect of " <?php echo '<b>'.$orgn_name.'</b>'; ?><!-- <input type="text" name="office" id="namee3" value="<?php //echo $orgn_name; ?>"/> --> " is pending either with PAO or with this organization/office as on date: <?php echo '<b>'.date('d F Y', strtotime($date)).'</b>'.'.'; ?></p>   

                                                 <!-- <input type="date" name="date" placeholder="dd-mm-yy" id="namee4" value="<?php //echo $date; ?>" readonly/> --> 
                                                <!-- <p>It is certified that no pension cases in respect of "CWC (HQ)-Training Dte., New Delhi, is pending either with PAO or with this organization/office as on <input type="date" name="date" placeholder="dd-mm-yy" id="namee4"/></p>
                                                <br><br> -->
                                                <br/>
                                            
                                        </div>
                                        <input type="hidden" name="orgn_id" value= "<?php echo $orgn_id; ?>" />
                                        <button class="btn btn-primary" type="submit" name="submit" >Submit</button>
                                       
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        
        </div>
  
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
                    var convert_date = new Date(date).toDateString("yyyy-MM-dd");
                 
                      var lMargin=15; //left margin in mm
                      var rMargin=15; //right margin in mm
                      var pdfInMM=210;  // width of A4 in mm

                      var doc = new jsPDF("p","mm","a4");
                      doc.text('Certificate', 85, 10);
                      doc.setFontType("Arial");
                      doc.setFontSize(13);
                     // var paragraph=`It is certified that no pension case in respect of " `+ name + `" Organisation Name "`+ orgn + `" office is pending either with PAO or with this office.`; 
                     var paragraph=`It is certified that no pension cases in respect of " CWC(HQ)-Training Dte., New Delhi,"is pending either with PAO or with this organization/office as on " `+ convert_date + `"`;  
                     var lines =doc.splitTextToSize(paragraph, (pdfInMM-lMargin-rMargin));
                     doc.text(lMargin,20,lines);
              

                    //doc.text(14, 80, `Dated: `+ convert_date);
                    doc.save('Certificate.pdf');
                    
                }
         
             
    </script>
