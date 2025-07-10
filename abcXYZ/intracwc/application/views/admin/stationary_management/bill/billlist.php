   
	 <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-box">
                            <div class="card-block">
                                <h6 class="card-title text-bold">Challan/Bill Entry</h6>
								<hr>
								
				   <?php if($this->session->flashdata('flashSuccess_bill')) { ?>
						<div class='alert alert-success'> 
						<?php echo $this->session->flashdata('flashSuccess_bill'); ?> 
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						</div> 
					<?php } ?>
					
					
				<?php
					$attributes = array('class' => 'form-inline sr-form', 'id' =>'search_bill');
     				echo form_open_multipart('onlinestationary/bill/searchbill/',$attributes);
     			?>
						
					 <div class="form-group">
					   <div class="cal-icon">
					      <input class="form-control datetimepicker" placeholder="From Bill Date" name="from_date" type="text">
					    </div>
					  </div>
							  
						<div class="form-group">
						  <div class="cal-icon">
						      <input class="form-control datetimepicker" placeholder="To Bill Date" name="to_date" type="text">
						   </div>
						</div>
						<button type="submit" name="submit" class="btn btn-success btn-search">Search
						</button>
						  
					<?php echo form_close();?>		
								
							<a href="<?php echo site_url();?>onlinestationary/bill/addbill" class="btn btn-success pull-right"><i class="fa fa-plus"></i>Add Challan/Bill</a>
								
								
                               <table class="display datatable table table-stripped table-bordered table-responsive" >
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
											<th>Bill. No.</th>
											<th>Bill Date</th>
											<th>Vendor Name</th>
											<th>Bill Type</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
									
									<?php
										if($all_bill) {
											$i=1;
											foreach($all_bill as $bill) { ?>
                                        <tr>
                                            <td><?php echo $i; ?></td>
                                            <td><?php if(!empty($bill->bill_no)){
                                                 echo $bill->bill_no;
                                            }else {
                                            	echo 'N/A';
                                            } ?></td>
											<td>
											<?php 
											   $bdate = date('d F, Y', strtotime($bill->bill_date));
											   echo $bdate; 
											 ?>
											</td>

											 <td><?php if(!empty($bill->vendor_name)){
                                                 echo $bill->vendor_name;
                                            }else {
                                            	echo 'N/A';
                                            } ?></td>

											<td><?php echo $bill->bill_type; ?></td>
                                           
											<td>
									    <a href="<?php echo base_url('onlinestationary/bill/editbill/'.$bill->bill_master_id)?>" class="btn btn-sm btn-info">Edit</a>
										<a href="<?php echo base_url('onlinestationary/bill/viewbill/'.$bill->bill_master_id)?>" class="btn btn-sm btn-primary">Details</a>

							             <button onclick="print_bill(<?php echo $bill->bill_master_id ;?>)"  class="btn btn-sm btn-danger">Print</button>

							             <?php /*if($bill->bill_type == 'T&P'){?>

							             <button onclick="form_fourteen()"  class="btn btn-sm btn-danger">Form 14</button>

							             <button onclick="form_fifteen()"  class="btn btn-sm btn-danger">Form 15</button>

							             <?php } */?>

											</td>
                                        </tr>
										
									<?php $i++; } } else { ?>
										
										<tr><td>No bill list found</td></tr>
										
									<?php } ?>	
									
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


   <script>
   	  
   	  	function print_bill(id) 
					{
						var bill_id = id;
						var base_url = "<?php echo base_url(); ?>";
    					var link = base_url+'onlinestationary/bill/getpdfdata';

						 $.ajax({
					        method: "POST",
					        url: link,
					        data: {'bill_master_id':bill_id,'service_type':'2'},
					        success: function(result) {
					          console.log(result); 
								
					          var obj = JSON.parse(result);
						      
						      var tr='';

			                   var json_table = obj.all_items;
						      	 var tr='';

						   if(obj.bill_type == 'MAS'){

						   	    for (var i = 0; i < json_table.length; i++) {

	                    	         tr += '<tr><td>'+ json_table[i].item_name +'</td><td>'+ json_table[i].quantity +'</td><td>'+ json_table[i].amount +'</td></tr>';

					               }
                                 
                               var divToPrint='<div class="page-wrapper"><div class="content container-fluid"><div class="row"><div class="col-lg-12"><div class="card-box"><div class="card-block"><h3 style="text-align:center;">Central Water Commission</h3><h4 style="text-align:center;">Tools And Plant Received sheet</h4><hr><p><label style="width:30%;display:inline-block;">Challan/Bill Date : </label><span>'+obj.bill_date+'</span></p><p><label style="width:30%;display:inline-block;">Challan/Bill No : </label><span >'+obj.bill_no+'</span></p><p><label style="width:30%;display:inline-block;">Name :</label><span >'+obj.vendor_name+'</span></p><p><label style="width:30%;display:inline-block;">Address : </label><span>'+obj.vendor_address+'</span></p><p><label style="width:30%;display:inline-block;">Contact No : </label><span>'+obj.vendor_contact+'</span></p><p><label style="width:30%;display:inline-block;">Email : </label><span>'+obj.vendor_email+'</span></p><p><label style="width:30%;display:inline-block;">Total Amount : </label><span>'+obj.grand_total+'</span></p><p><label style="width:30%;display:inline-block;">Remark : </label><span>'+obj.remark+'</span></p><table style="width:100%;"><tr><th style="width:20%;text-align:left;">Item Name</th><th style="width:20%;text-align:left;">Quantity</th><th style="width:20%;text-align:left;">Amount</th></tr>'+tr+'</table></div></div></div></div></div></div>';

							      newWin= window.open("");
							      newWin.document.write(divToPrint);
							      newWin.print();
							      newWin.close();


					} else {

					   	      var j= 1;
                              
                              for (var i = 0; i < json_table.length; i++) {

                    	         tr += '<tr><td style="border:1px solid #333;">'+ j +'</td><td style="border:1px solid #333;">'+ obj.bill_date +'</td><td style="border:1px solid #333;">'+ obj.bill_no +'</td><td style="border:1px solid #333;"></td><td style="border:1px solid #333;"></td><td style="border:1px solid #333;">'+ obj.source_reciept +'</td><td style="border:1px solid #333;">'+ json_table[i].item_name +'</td><td style="border:1px solid #333;">'+ json_table[i].quantity +'</td><td style="border:1px solid #333;">'+ json_table[i].unit +'</td><td style="border:1px solid #333;">'+ json_table[i].rate +'</td><td style="border:1px solid #333;">'+ json_table[i].quantity*json_table[i].rate +'</td><td style="border:1px solid #333;">'+ json_table[i].incidental_charges +'</td><td style="border:1px solid #333;">'+ json_table[i].amount +'</td><td style="border:1px solid #333;"></td><td style="border:1px solid #333;"></td><td style="border:1px solid #333;"></td><td style="border:1px solid #333;"></td></tr>';

                    	          j++;
				               }
                                 
                              var divToPrint='<div class="page-wrapper"><div class="content container-fluid"><div class="row"><div class="col-lg-12"><div class="card-box"><div class="card-block"><h4 style="text-align:center;margin-bottom:10px;">Form 13</h4><h3 style="text-align:center;margin-bottom:10px;">Tools And Plant Received sheet</h3><h5 style="text-align:center;margin-bottom:10px;">(Referred to in paragraph 7.3.4)</h5><h4 style="text-align:left;">Division .............</h4><h4 style="text-align:left;">Sub-Division .............</h4><table style="width:100%;"><tr><th style="border:1px solid #333;" rowspan="1">S.No.</th><th style="border:1px solid #333;" rowspan="1">Date</th><th style="border:1px solid #333;" rowspan="1">Invoice R. R. No.</th><th style="border:1px solid #333;" colspan="2">Purchase/Supply order of Indent</th><th style="border:1px solid #333;" rowspan="1">Source Of Reciept</th><th style="border:1px solid #333;" rowspan="1">Name of Article</th><th style="border:1px solid #333;" rowspan="1">Quantity</th><th style="border:1px solid #333;" rowspan="1">Unit</th><th style="border:1px solid #333;" rowspan="1">Rate</th><th style="border:1px solid #333;" rowspan="1">Amount</th><th style="border:1px solid #333;" rowspan="1">Incidental Charges</th><th style="border:1px solid #333;" rowspan="1">Amount including Incidental Charges</th><th style="border:1px solid #333;" rowspan="1">Tools and Plant Ledger Folio</th><th style="border:1px solid #333;" colspan="2">Reference to payment voucher or adjustment of debit</th><th style="border:1px solid #333;" rowspan="1">Remarks including Results of test check by Superior Officers</th></tr>     <tr><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1">No.</th><th style="border:1px solid #333;height:30px;" rowspan="1">Date</th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1">No.</th><th style="border:1px solid #333;height:30px;" rowspan="1">Date</th><th style="border:1px solid #333;height:30px;" rowspan="1"></th></tr>'+tr+'</table><p>* The articles to be entered in column 6 should be grouped by the prescribed Sub-Head of classification, vide paragraph 7.3.7</p><p>* The entries in respect of receipt back of articles lent or sent out(vide paragarph 7.3.3) should be distinguished from others by quoting reference to the original entries in the Tools and Plant Indent in Col.15.</p><h4 style="text-align:right;">Divisional/Sub-Divisional Officer</h4></div></div></div></div></div></div>';

							      newWin= window.open("");
							      newWin.document.write(divToPrint);
							      newWin.print();
							      newWin.close();
						   }   	 

					        
					    }
        
    			  });
						
			}

    function form_fourteen(){
               
             var tr='';

			tr += '<tr><td style="border:1px solid #333;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td></tr>';

				var divToPrint='<div class="page-wrapper"><div class="content container-fluid"><div class="row"><div class="col-lg-12"><div class="card-box"><div class="card-block"><h4 style="text-align:center;margin-bottom:10px;">Form 14</h4><h3 style="text-align:center;margin-bottom:10px;">Tools And Plant Indent</h3><h5 style="text-align:center;margin-bottom:10px;">(Referred to in paragraph 7.3.5)</h5><h4 style="text-align:left;">No .............</h4><h4 style="text-align:left;">Date .............</h4><h4 style="text-align:left;">Division .............</h4><h4 style="text-align:left;">Sub-Division .............</h4><table style="width:100%;"><tr><th style="border:1px solid #333;" rowspan="1">S.No.</th><th style="border:1px solid #333;" rowspan="1">Name of Article</th><th style="border:1px solid #333;" colspan="2">Quantity</th><th style="border:1px solid #333;" rowspan="1">Unit</th><th style="border:1px solid #333;" rowspan="1">Rate</th><th style="border:1px solid #333;" rowspan="1">Amount</th><th style="border:1px solid #333;" rowspan="1">Head of Account</th><th style="border:1px solid #333;" rowspan="1">Name of work/job with name of contractor from whom value is recoverable</th><th style="border:1px solid #333;" rowspan="1">NAme of person to whom the articles are to be delivered and his signature</th><th style="border:1px solid #333;" rowspan="1">Signature of Indenting officer</th><th style="border:1px solid #333;" rowspan="1">Issued on Signature of Supplying Officer & Designation</th><th style="border:1px solid #333;" rowspan="1">Received Dated Signature & Designation of Receiving Officer</th><th style="border:1px solid #333;" colspan="2">Tools and Plant Ledger Folio No</th><th style="border:1px solid #333;" rowspan="1">Remarks</th></tr>     <tr><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1">Indented</th><th style="border:1px solid #333;height:30px;" rowspan="1">Issued</th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;height:30px;" rowspan="1">Signature of Lodger Keeper</th><th style="border:1px solid #333;height:30px;" rowspan="1">Signature of Sub. Div.Div. officer</th><th style="border:1px solid #333;height:30px;" rowspan="1"></th></tr>'+tr+'</table><p>* The articles to be entered in column 2 should be grouped by the prescribed Sub-Head of classification, vide paragraph 7.3.7</p><p>* The entries in respect of receipt back of articles lent or sent out(vide paragarph 7.3.3) should be distinguished from others by a suitable remark in this column.</p><h4 style="text-align:right;">Name .............</h4><h4 style="text-align:right;">Signature .............</h4><h4 style="text-align:right;">Divisional Officer .............</h4><h4 style="text-align:right;">Division .............</h4></div></div></div></div></div></div>';

				      newWin= window.open("");
				      newWin.document.write(divToPrint);
				      newWin.print();
				      newWin.close();
			}


   function form_fifteen(){
               
             var tr='';

			tr += '<tr><td style="border:1px solid #333;"></td><td  style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td><td style="border:1px solid #333;height:50px;"></td></tr>';

				var divToPrint='<div class="page-wrapper"><div class="content container-fluid"><div class="row"><div class="col-lg-12"><div class="card-box"><div class="card-block"><h4 style="text-align:center;margin-bottom:10px;">Form 15</h4><h3 style="text-align:center;margin-bottom:10px;">Tools And Plant Ledger</h3><h5 style="text-align:center;margin-bottom:10px;">(Referred to in paragraph 7.3.7 and 7.3.8)</h5><h5 style="text-align:center;margin-bottom:10px;">Part 1- Article In Hand</h5><h4 style="text-align:left;">Name of Article .............</h4><table style="width:100%;"><tr><th style="border:1px solid #333;" rowspan="1">S.No.</th><th style="border:1px solid #333;" rowspan="1">Date</th><th style="border:1px solid #333;" rowspan="1">From Whom Received</th><th style="border:1px solid #333;" rowspan="1">To Whom issued</th><th style="border:1px solid #333;" rowspan="1">T & P Received sheet No. & date T & P Indent etc. No. & Date</th><th style="border:1px solid #333;" colspan="2">Permanent Transactions</th><th style="border:1px solid #333;" colspan="2">Temporary Transactions</th><th style="border:1px solid #333;" rowspan="1">Total Receipts</th><th style="border:1px solid #333;" rowspan="1">Total Issue</th><th style="border:1px solid #333;" rowspan="1">Balance</th><th style="border:1px solid #333;" rowspan="1">Reference to Vr. or Adjustment of value</th><th style="border:1px solid #333;" rowspan="1">Initials of Sub-Divisional clerk</th><th style="border:1px solid #333;" rowspan="1">Remarks</th></tr>     <tr><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1">Receipt</th><th style="border:1px solid #333;height:30px;" rowspan="1">Issue</th><th style="border:1px solid #333;height:30px;" rowspan="1">Receipt</th><th style="border:1px solid #333;height:30px;height:30px;" rowspan="1">Issue</th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;height:30px;" rowspan="1"></th><th style="border:1px solid #333;height:30px;" rowspan="1"></th></tr>'+tr+'</table><p>* Represents articles temporarily lent out for repairs.</p></div></div></div></div></div></div>';

				      newWin= window.open("");
				      newWin.document.write(divToPrint);
				      newWin.print();
				      newWin.close();
			}

   </script>