
<div class="footer-bottom">
      Website owned &amp; maintained by Central Water Commission, Ministry of Water Resources, River Development &amp; Ganga 
                       Rejuvenation, Government of India
     </div>


    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/validationn.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/print.min.js"></script>
    <script type="text/javascript">
    $(function($) {

      $.ajaxSetup({
          data: {
              '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          }
      });
   
  });//ends function

        /* JS for getting circle in drop down*/
     
        $('#region_post').on('change', function(event){
        var region_id = $("#region_post").val();
        var option ='';
        var base_url = "<?php echo base_url(); ?>";
        var link = base_url+'Circle/all_circle/';
        var csrf_test_name = $("input[name=csrf_test_name]").val();
      
        $.ajax({
        method: "POST",
        url: link,
        data: {'csrf_test_name' : csrf_test_name,'id':region_id},
        success: function(result) {
        console.log(typeof(result));
      
           var obj = JSON.parse(result);
           option = '<option selected="selected" value="">Select Circle</option>';
            $.each(obj, function(){
                    option+='<option value="'+this["id"]+'">'+this["circle_name"]+'</option>';
                });

        $("#circlee_post").html(option);
         event.preventDefault();

    }
        
    });
    });
      
      /********* JS for getting circle at Job section*********/
      $('#regggion_post').on('change', function(event){
        var region_id = $("#regggion_post").val();
        var option ='';
        var base_url = "<?php echo base_url(); ?>";
        var link = base_url+'Circle/all_circle/';
        var csrf_test_name = $("input[name=csrf_test_name]").val();
      
        $.ajax({
        method: "POST",
        url: link,
        data: {'csrf_test_name' : csrf_test_name,'id':region_id},
        success: function(result) {
        //console.log(result);
        
           var obj = JSON.parse(result);
           option = '<option selected="selected" value="">Select Circle</option>';
            $.each(obj, function(){
                    option+='<option value="'+this["id"]+'">'+this["circle_name"]+'</option>';
                });

        $("#ciiiirclee_post").html(option);
         event.preventDefault();

    }
        
    });
    });// ends function

      /********** JS for getting post name and code *********/

      $('#ciiiirclee_post').on('change', function(event){

        var region_id = $("#regggion_post").val();
        var circle_id = $("#ciiiirclee_post").val();
        var option ='';
        var base_url = "<?php echo base_url(); ?>";
        var link = base_url+'Jobs/all_post/';
        var csrf_test_name = $("input[name=csrf_test_name]").val();
      
        $.ajax({
                method: "POST",
                url: link,
                data: {'csrf_test_name' : csrf_test_name,'region_id':region_id,'circle_id':circle_id},
                success: function(result) {
                console.log(typeof(result));
              
                   var obj = JSON.parse(result);
                   option = '<option selected="selected" value="">Select Post</option>';
                    $.each(obj, function(){
                            option+='<option value="'+this["id"]+'">'+this["post_name"]+'-'+this["post_code"]+'</option>';
                        });

                $("#post_post_job").html(option);
                 event.preventDefault();

                }        
          });

        

      });//ends function

       /***********JS for get circle based on job id***********/

        $('#circular_job_id').on('change', function(event){
        var job_id = $("#circular_job_id").val();
        var option ='';
        var base_url = "<?php echo base_url(); ?>";
        var link = base_url+'Circle_circular/all_circular_circle/';
        var csrf_test_name = $("input[name=csrf_test_name]").val();
      
        $.ajax({
        method: "POST",
        url: link,
        data: {'csrf_test_name' : csrf_test_name,'id':job_id},
        success: function(result) {
        console.log(typeof(result));
      
           var obj = JSON.parse(result);
           option = '<option selected="selected" value="">Select Circle</option>';
            $.each(obj, function(){
                    option+='<option value="'+this["id"]+'">'+this["circle_name"]+'</option>';
                });

        $("#circular_circcle").html(option);
         event.preventDefault();

    }
        
    });
    });
    </script>
    
</body>

</html>
