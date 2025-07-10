  

<div class="footer-bottom">
      Website owned &amp; maintained by Central Water Commission, Ministry of Water Resources, River Development &amp; Ganga 
                       Rejuvenation, Government of India
     </div>


  
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/print.min.js"></script>
    
    <script>

        $(function($) {

      $.ajaxSetup({
          data: {
              '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          }
      });
   
  });//ends function


      /********* JS for getting circle at Job section*********/

      $('#region_name').on('change', function(event){
       
        var region_id = $("#region_name").val();
        var option ='';
        var base_url = 'http://103.70.201.212:2001/cwc-jobs/';
        var link = base_url+'Applicant/all_circle/';
        var csrf_test_name = $("input[id=csrf-token]").val();
      
        $.ajax({
        method: "POST",

        url: link,
        data: {'csrf_test_name' : csrf_test_name,'id':region_id},
        success: function(result) {
          console.log(result); 
           var obj = JSON.parse(result);
           option = '<option selected="selected" value="">Select Circle</option>';
            $.each(obj, function(){

                    option+='<option value="'+this["id"]+'">'+this["circle_name"]+'</option>';
                });

        $("#circle_name").html(option);
        $("#skilled_name").empty();
        option2 = '<option selected="selected" value="">Select Skills</option>';
        $("#skilled_name").html(option2);
        $("#post_code").val("");
        $("#total_vacancy").val("");
         event.preventDefault();

    }
        
    });
    });// ends function

      /********** JS for getting Job name based on circle id *********/

      $('#circle_name').on('change', function(event){
        var region_id = $("#region_name").val();
        var circle_id = $("#circle_name").val();
        var option ='';
        var base_url = 'http://103.70.201.212:2001/cwc-jobs/';
        var link = base_url+'Applicant/all_job/';
        var csrf_test_name = $("input[id=csrf-token]").val();
      
        $.ajax({
        method: "POST",

        url: link,
        data: {'csrf_test_name' : csrf_test_name,'region_id':region_id , 'circle_id': circle_id},
        success: function(result) {
          console.log(result); 
           var obj = JSON.parse(result);
           option = '<option selected="selected" value="">Select Skills</option>';
            $.each(obj, function(){
                    option+='<option value="'+this["id"]+'">'+this["job_title"]+'</option>';
                });

        $("#skilled_name").html(option);
        $("#post_code").val("");
        $("#total_vacancy").val("");
         event.preventDefault();

    }
        
    });
    });//ends function

      /********for post name and post code*****/

      $('#skilled_name').on('change', function(event){
        var job_id = $("#skilled_name").val();
       
        var option ='';
        var base_url = 'http://103.70.201.212:2001/cwc-jobs/';
        var link = base_url+'Applicant/post_data/';
        var csrf_test_name = $("input[id=csrf-token]").val();
      
        $.ajax({
        method: "POST",

        url: link,
        data: {'csrf_test_name' : csrf_test_name,'job_id':job_id},
        success: function(result) {
         
          console.log(result); 
           var obj = JSON.parse(result);
           
        
        $("#post_code").val(obj.name);
        $("#total_vacancy").val(obj.total_vacancy);
         event.preventDefault();

    }
        
    });
    });//ends function

      //JS for dynamic value of city in applicant section*******

      $('#present_address_state').on('change', function(event){
       
        var city_id = $("#present_address_state").val();
        var option ='';
        var base_url = 'http://103.70.201.212:2001/cwc-jobs/';
        var link = base_url+'Applicant/all_city/';
        var csrf_test_name = $("input[id=csrf-token]").val();
      
        $.ajax({
        method: "POST",

        url: link,
        data: {'csrf_test_name' : csrf_test_name,'id':city_id},
        success: function(result) {
          console.log(result); 
           var obj = JSON.parse(result);
            $.each(obj, function(){
                    option+='<option value="'+this["District_Name_In_English"]+'">'+this["District_Name_In_English"]+'</option>';
                });

        $("#present_address_city").html(option);
         event.preventDefault();

    }
        
    });
    });// ends function

  /***********JS for present address city dynamic*******/

  $('#permanent_address_state').on('change', function(event){
       
        var city_id = $("#permanent_address_state").val();
        var option ='';
        var base_url = 'http://103.70.201.212:2001/cwc-jobs/';
        var link = base_url+'Applicant/all_city/';
        var csrf_test_name = $("input[id=csrf-token]").val();
      
        $.ajax({
        method: "POST",

        url: link,
        data: {'csrf_test_name' : csrf_test_name,'id':city_id},
        success: function(result) {
          console.log(result); 
           var obj = JSON.parse(result);
            $.each(obj, function(){
                    option+='<option value="'+this["District_Name_In_English"]+'">'+this["District_Name_In_English"]+'</option>';
                });

        $("#permanent_address_city").html(option);
         event.preventDefault();

    }
        
    });
    });// ends function
    
//JS

 $('#edit_user_proffile').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        full_name:{
            required : true
        },

        email:{
            required : true
        },

        mobile_no:{
            required : true,
            number : true,
            maxlength :10
           
        },
        dob:{
          required : true
        },

        gender:{
          required : true
        },

        
       
       },

    messages: {

        full_name:{
            required : "Please enter username"    
        },

        email:{
           required : "Please enter email"
          
        },

         mobile_no:{
            required : "Please enter mobile no.",
             maxlength : "Please enter 10 digit number only",
             number : "Please enter number only"
        },

        dob:{
          required : "Please enter date of birth"
        },

         gender:{
          required : "Please select gender"
        },

        

      },
            errorElement: "div",
            wrapper: "div",
            errorPlacement: function(error, element) {
            offset = element.offset();
            error.insertAfter(element)
            error.css('color','red');
            },
 
}); 
    </script>
    

</body>

</html>