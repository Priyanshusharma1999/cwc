   

    <section style="width:100%;padding:50px 0;">
     <div class="container">

       <h3>Contact List</h3>

       <?php
			 	$attributes = array('class' => 'form-inline sr-form text-center');
					echo form_open_multipart('frontend/search_contact/',$attributes);?> 
		   
				  <div class="form-group" >
					<input type="text" id="restrict_special_char" autocomplete="off" name ="name" value="<?php echo isset($insertData['name']) ? $insertData['name'] : ''; ?>" class="form-control" placeholder="Enter Name" >
				  </div>
				  
				  <div class="form-group" >
					<input type="text" id="restrict_special_char2" autocomplete="off" name ="designation" value="<?php echo isset($insertData['designation']) ? $insertData['designation'] : ''; ?>" class="form-control" placeholder="Enter designation" >
				  </div>

				   <div class="form-group" >
					 <select class="form-control" name ="organization" id="org">
					   <option value="" selected>Select Organization</option>
					    <option value="All" <?php if($insertData['organization'] == 'All') echo 'selected="selected"' ?>>All</option>
					    <?php 
					    foreach ($all_organizations as $organisation)
						{?>   
						                      	
                      	<option  value="<?php echo $organisation->ORGANIZATION_ID ?>" <?php if($insertData['organization']==$organisation->ORGANIZATION_ID) { echo 'selected'; } ?> >

                      		<?php echo $organisation->ORGNAME; ?>

                      	</option>

                      <?php }?>

					   
					</select>
				  </div>

				   <div class="form-group" >
					<select name ="division" class="form-control" id="division">
						<option value="" >Select Division</option>
					</select>
				  </div>
				  
				  <div class="form-group">
				     <button type="submit" name="submit" class="btn btn-success btn-search">Search</button>
				  </div>
			<?php echo form_close();?>
	  
	    <table class="remove_tabble display datatable table table-stripped table-bordered table-responsive " >
			<thead>
				<tr>
					<th>S.No.</th>
					<th>Name</th>
                    <th>Email Id</th>
                    <th>Mobile No.</th>
					<th>Designation</th>
					<th>Office Name</th>
					<th>Office Address</th>
					<th>Organization Name</th>
                    <th>Division Name</th>  
				</tr>
			</thead>
			<tbody>
									
			<?php
				if($all_contacts) {
					$i=1;
					foreach($all_contacts as $contacts) { ?>
			
				<tr>
					<td><?php echo $i; ?></td>
					<td><?php echo $contacts['FULLENAME']; ?></td>
					<td><?php echo $contacts['EMAIL']; ?></td>
					<td><?php echo $contacts['MOBILE']; ?></td>
					<td><?php echo $contacts['DESIGNATION']; ?></td>
                    <td><?php echo $contacts['OFFICENAME']; ?></td>
					<td><?php echo $contacts['OFFICE_ADDRESS']; ?></td>
					<td>
                       <?php 
                       $org_data = $this->Base_model->get_record_by_id('organization', array('ORGANIZATION_ID' => $contacts['ORGANIZATION_ID'])); 
                        echo $org_data->ORGNAME; ?>
                    </td>

                    <td>
                     <?php 
                          $division_data = $this->Base_model->get_record_by_id('division', array('DIVISION_ID' => $contacts['DIVISION_ID'])); 
                          echo $division_data->DIVISIONNAME; ?>
                    </td>
				</tr>
				
				<?php $i++; } } else { ?>
				
				<tr><td>No Contacts found</td></tr>
				
			<?php } ?>	
				
			</tbody>
		</table>
	   
     </div>
   </section>
	


	<script>	

		$('#org').on('change', function(event){
        var org_id = $("#org").val();
		
        var option ='';
        var base_url = '<?php echo base_url() ?>';
        var link = base_url+'frontend/all_divisions/';
       
        $.ajax({
        method: "POST",
        url: link,
        data: {'id':org_id},
        success: function(result) {
       
           var obj = JSON.parse(result);
      
           option ='<option value="" selected>Select Division</option>';

           $.each(obj, function(i){
			 
			    option+='<option value="'+obj[i].DIVISION_ID+'" >'+obj[i].DIVISIONNAME+'</option>';
				
			 });
            
			$("#division").html(option);
			 event.preventDefault();

        }
        
    });
    });
	
	</script>