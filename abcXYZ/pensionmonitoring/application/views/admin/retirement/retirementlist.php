   <?php 

  /******************************************Retire List Code***************************************/

   $get_retire_list = array();
   $i=1;
   foreach ($retirement_list as $retire)
    {
    	
   		$retire_list['Pension Id'] = $i;
   		$retire_list['Name'] =  empty($retire->EMPLY_NAME) ? '':$retire->EMPLY_NAME;
   		$retire_list['Retirement date'] =  empty($retire->DATE_RETIREMENT) ? '':$retire->DATE_RETIREMENT;
   		$retire_list['Mobile No'] = empty($retire->MOBILENO) ? '':$retire->MOBILENO;
   		$retire_list['Email,Aadhar No,PAN NO'] = $retire->EMAILID.','.$retire->AADHAR_NO.','.$retire->PAN_NO;
   		$retire_list['Division Name'] = empty($retire->DIVIS_DEAL_NAME) ? '':$retire->DIVIS_DEAL_NAME;
   		

   		$get_retire_list[] = $retire_list;
   		$i++;
   	}	

   	$json_retire_list = json_encode($get_retire_list);

   	/******************************************Ends Retire List Code***************************************/


   ?>
   <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Retirement List</h6>
								<hr>
								<!-- <form class="form-inline sr-form" action="#"> -->
									<?php
								 	$attributes = array('class' => 'form-inline sr-form', 'id' =>'');
			     					echo form_open_multipart('Retirement/search_retirement/',$attributes);?>


								   <div class="form-group">
								   		<select required name = "organisation_name" class="form-control" id = "">
									   <option selected="selected" value="">Select Organisation</option>
									   <option value="All" <?php  if($insertData['organisation_name']==All) { echo 'selected'; } ?>>All</option>
										<?php
											if(empty($all_organisation))
											{
												echo '<option value="All">'.'Select Organisation'.'</option>';
											}

											else
											{
												foreach ($all_organisation as $organisation)
						                      {?>   
						                      	
						                      	<option  value="<?php echo $organisation->ORGANIZATION_ID ?>" <?php if($insertData['organisation_name']==$organisation->ORGANIZATION_ID) { echo 'selected'; } ?> >

						                      		<?php echo $organisation->ORGNAME; ?>

						                      	</option>

						                      <?php }
											}
					                      
					                    ?>
										
									</select>
								   </div>
								   <div class="form-group">
									
									<select name = "division" class="form-control" id = "divvision" required>
									   <option selected="selected" value="">Select Division</option>
									   <option value="All" <?php  if($insertData['division']==All) { echo 'selected'; } ?>>All</option>
										<?php
											if(empty($all_division))
											{
												echo '<option value="1">'.'Select Division'.'</option>';
											}

											else
											{
												foreach ($all_division as $division)
						                      {?>   
						                      	
						                      	<option  value="<?php echo $division->DIVISIONNAME ?>" <?php if($insertData['division']==$division->DIVISIONNAME) { echo 'selected'; } ?> >

						                      		<?php echo $division->DIVISIONNAME; ?>

						                      	</option>

						                      <?php }
											}
					                      
					                    ?>
										
									</select>
									

									<!-- From and To date-->
									<div id="from_datte" style="display:inline-block;">
                                    <label>From Date:</label>
									<input type="date" name="from_date" class="form-control"  placeholder="dd-mm-yy" value="<?php echo isset($insertData['from_date']) ? $insertData['from_date'] : ''; ?>"/>
                                    </div>

                                    <div  id="to_datte" style="display:inline-block;">
                                    <label>To Date:</label>
									<input type="date" name="to_date" class="form-control" placeholder="dd-mm-yy" value="<?php echo isset($insertData['to_date']) ? $insertData['to_date'] : ''; ?>"/>

									 </div>

									 

								   </div>

								   
								    <div class="form-group">
									 <button type="submit" name = "submit" id ="generate_report" class="btn btn-success btn-search">Generate</button>

									<!--  <button type="reset" class="btn btn-danger btn-reset">Reset</button> -->
								    </div>
								  
								<?php echo form_close();?>
								
								<button class="btn btn-success" style="float:right;margin-bottom:20px;" onclick="saveFile()">Download Excel<i class="fa fa-arrow-circle-down"></i></button>
								
								<button class="btn btn-warning" style="float:right;margin-bottom:20px;margin-right:20px;" onclick="generatePdf()">Download PDF<i class="fa fa-arrow-circle-down"></i></button>

								<button class="btn btn-danger" style="float:right;margin-bottom:20px;margin-right:20px;" onclick="generateWord()">Download Word<i class="fa fa-arrow-circle-down"></i></button>
			<div id ="pp1" style="clear:both;">	
								
								<!--table code-->
			
			<?php
                 if($retirement_list) {?>
			<div class="pension-table">
			
		
			
			<table border width="100%">
					
						<tr>
							<th >S.No.</th>
							<th >Name of the Employee/Pensioner</th>
							<th >Date of Retirement</th>
							<th >Mobile No</th>
							<th >Email Id, Aadhar No., PAN No.</th>
							<th >Name of the division</th>
							
						</tr>
									
						 <?php
                            if($retirement_list) {
                           	$i=1;
                            foreach($retirement_list as $retirement) { ?>

						<tr>
							<td><?php echo $i; ?></td>
							<td><?php echo $retirement->EMPLY_NAME; ?></td>
							<td><?php echo date('d F, Y', strtotime($retirement->DATE_RETIREMENT)); ?></td>
							<td>
								<?php 
									echo $retirement->MOBILENO;
								?>
								
							</td>
							<td>
								<?php 
								
								echo $retirement->EMAILID.'<br/>'.'<span id="fileId8_'.$i.'"></span>'.'<br/>'.'<span id="fileId7_'.$i.'"></span>';
								?>

								<?php               
				                  $base_url = base_url();
				                  $adhar_1 = $retirement->AADHAR_NO;

				                  $pan_1 = $retirement->PAN_NO; 
				                  $salt_key = 'asdbasg67532rbdwsfbshdfghsdfwegh';
				                  echo "<script type='text/javascript' src='http://katiyarprint.com/pensionscheme-audit/assets/js/jquery-3.2.1.min.js'></script><script type='text/javascript' src='http://katiyarprint.com/pensionscheme-audit/assets/js/aes.js'></script>
				                  <script type = 'text/javascript'>
				                  
				                  var Normaltext1 = CryptoJS.AES.decrypt('".$adhar_1."', '".$salt_key."');
				                  var adhar_ency_val11 = Normaltext1.toString(CryptoJS.enc.Utf8); 

				                  var Normaltext2 = CryptoJS.AES.decrypt('".$pan_1."', '".$salt_key."');
				                  var pan_ency_val12 = Normaltext2.toString(CryptoJS.enc.Utf8); 

				                   $('#fileId7_".$i."').text(adhar_ency_val11);
				                   $('#fileId8_".$i."').text(pan_ency_val12);</script>"; ?>

							</td>
							
							<td>
								<?php
									echo $retirement->DIVIS_DEAL_NAME;
								?>
							</td>
							
						</tr>

						<?php $i++;} } else { ?>
                        <tr><td colspan="9">No data found</td></tr>
                        <?php } ?>
		
						
						
		    </table>
			
			
		  </div>
		  
		  <?php } else { ?>
                        <br/><tr><td colspan="9"></td></tr>
                        <?php } ?>
                        
		    
			
		  </div>

		 
						
					<!--table code ends-->
							
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

<?php
		/******************************************Pension POPSEF Code***************************************/

   $get_retire_listtt = array();
   foreach ($retirement_list as $retire)
    {
		
   		
   		$retire_list['Pension Id'] = $i;
   		$retire_list['Name'] =  empty($retire->EMPLY_NAME) ? '':$retire->EMPLY_NAME;
   		$retire_list['Retirement_date'] =  empty($retire->DATE_RETIREMENT) ? '':$retire->DATE_RETIREMENT;
   		$retire_list['Mobile_No'] = empty($retire->MOBILENO) ? '':$retire->MOBILENO;
   		$retire_list['Email_Aadhar_No_PAN_NO'] = $retire->EMAILID.','.$retire->AADHAR_NO.','.$retire->PAN_NO;
   		$retire_list['Division_Name'] = empty($retire->DIVIS_DEAL_NAME) ? '':$retire->DIVIS_DEAL_NAME;
   		

   		$get_retire_listtt[] = $retire_list;
   	}	

   	$json_retire_pdf = json_encode($get_retire_listtt);

   	/******************************************Ends Pension POPSEF Code***************************************/

		?>
		
		<style>
		
		    .pension-table{overflow-x:scroll;margin-bottom:50px;clear:both;position:relative;}

			.pension-table::-webkit-scrollbar {
				height:10px;
				background:#ddd;
			}

			.pension-table::-webkit-scrollbar-thumb {
				background: #aaa; 
				border-radius:10px;
			}

			table{width:1700px;border-color:#ddd;}

			table th{
				padding: 10px;
				text-align: center;
				font-size: 13px;
				background: #2662df;
				color: #fff;
			}


			table td{padding:10px;text-align: center;font-size:13px;}

			.table>thead>tr>th{vertical-align:top!important;}
		
		</style>
	
		<script>
			function generateWord(){
					    var preHtml = "<html xmlns:o='urn:schemas-microsoft-com:office:office' xmlns:w='urn:schemas-microsoft-com:office:word' xmlns='http://www.w3.org/TR/REC-html40'><head><meta charset='utf-8'><title>Export HTML To Doc</title></head><body>";
					    var postHtml = "</body></html>";
					    var html = preHtml+document.getElementById('pp1').innerHTML+postHtml;
					    //var html = preHtml+document.getElementById('pp2').innerHTML+postHtml;

					    var blob = new Blob(['\ufeff', html], {
					        type: 'application/msword'
					    });
					    
					    // Specify link url
					    var url = 'data:application/vnd.ms-word;charset=utf-8,' + encodeURIComponent(html);
					    
					    // Specify file name
					    var filename = 'pension_report';
					    filename = filename?filename+'.doc':'document.doc';
					    
					    // Create download link element
					    var downloadLink = document.createElement("a");

					    document.body.appendChild(downloadLink);
					    
					    if(navigator.msSaveOrOpenBlob ){
					        navigator.msSaveOrOpenBlob(blob, filename);
					    }else{
					        // Create a link to the file
					        downloadLink.href = url;
					        
					        // Setting the file name
					        downloadLink.download = filename;
					        
					        //triggering the function
					        downloadLink.click();
					    }
					    
					    document.body.removeChild(downloadLink);
					}//ends function

		/********Exccel Code**********/

		window.saveFile = function saveFile () { 
            var retire_Array = <?php echo $json_retire_list; ?>;
           
       
			var data1 = retire_Array;
		  
		  	
		  	/**********data1***********/
		  	if(data1.length==0)
		  	{
		  		var data1 = [{'Pension Id':'','Name of the Employee':'','Retirement date':'','Mobile No':'','Email,Aadhar No,PAN NO':'','Division Name':''}];
		  	}

		  	else
		  	{
		  		var data1 = data1;
		  	}

		  	
		  	
		    	var opts = [{sheetid:'Annexure A',header:true}];
		    	var res = alasql('SELECT INTO XLSX("Retire_report.xlsx",?) FROM ?',
		                     [opts,[data1]]);
		    

		    
		    
			}//ends function

			//PDF Generate 


		</script>
		<script>
            

			/******************function for generate PDF***************/

			 function generatePdf () 
			 {

			 	 var retirepdf_Array = <?php echo $json_retire_pdf; ?>;
			 

			 

			  	 var header = ["S.No.                        ","Name of the Employee","Date of Retirement   ","Mobile No                           ","Email,Aadhar No,PAN NO                        ","Name of the division"];

			  
			  	 /*********table1***********/

			  	  var table1_data=[];
			  	  for (var j=0 ; j < retirepdf_Array.length; j++)
			  	  {
			  	  	 var table1=[];
				  	 
						 table1[0]=j+1;
						 table1[1]=retirepdf_Array[j].Name;
						 table1[2]=retirepdf_Array[j].Retirement_date;
						 table1[3]=retirepdf_Array[j].Mobile_No;
						 table1[4]=retirepdf_Array[j].Email_Aadhar_No_PAN_NO;
						 table1[5]=retirepdf_Array[j].Division_Name; 
					
					 table1_data[j]=table1;
				}

				 /*********ends table1***********/
			  	
			  	 content = table1_data;
			  	 

			  	  var doc = new jsPDF('l', 'pt', 'a4');
			  	 // doc.text(15,10,'Organisation Name : ' + organisation);
			  	  var startingPage = doc.internal.getCurrentPageInfo().pageNumber;

			  	  doc.text("Retirement List", 33, doc.autoTableEndPosY() + 33);
			  	
				    doc.autoTable(header, content, {
				        showHeader: 'firstPage',
				        overflow: 'linebreak',
				        styles: { fontSize: 4 },
				        avoidPageSplit: true,
				        columnWidth: 'auto',
				        tableWidth: 'auto',

				       
				       
				    });
				    
				    
				    doc.setPage(startingPage);  
				    doc.save("Pension_report.pdf")
			 }//ends function


			 //function for generate word

			 

        </script>


