   
    
   <footer class="wrapper footer-wrapper">

<div class="container">
  
<div class="col-md-4 footer-grid">
             <h4 class="footer-head">Important Links</h4>
          <div class="region region-footer-first">
  <div id="block-menu-block-9" class="block block-menu-block">

    
  <div class="content">
    <div class="menu-block-wrapper menu-block-9 menu-name-menu-footer-bottom-link parent-mlid-0 menu-level-1">
  <ul class="menu">
<li class="leaf"><a href="<?php echo site_url();?>frontend/copyrightpolicy" class="local" target="_blank">Copyright Policy</a></li>
<li class="leaf"><a href="<?php echo site_url();?>frontend/desclaimer" class="local" target="_blank">Disclaimer</a></li>
<li class="leaf"><a href="<?php echo site_url();?>frontend/privacypolicy" class="local" target="_blank">Privacy Policy</a></li>
<li class="leaf"><a href="<?php echo site_url();?>frontend/termsconditions" class="local" target="_blank">Terms &amp; Condition</a></li>
<li class="leaf"><a href="<?php echo site_url();?>frontend/termsofuse" class="local" target="_blank">Terms of Use</a></li>
</ul></div>
  </div>
</div>
</div>
 <!-- /.region -->
        </div>


<div class="col-md-4 footer-grid">

  <div class="region region-footer-second">
  <div id="block-block-11" class="block block-block">

    
  <div class="content">
    <h4 class="footer-head">Contact Us</h4>
<address>
            <ul class="location">
              <li><span class="glyphicon glyphicon-map-marker"></span></li>
              <li>The Secretary<br>
                   Central Water Commission<br>
Room No-313(s), Sewa Bhawan , R.K. Puram<br>
New Delhi – 110066 </li>
              
            </ul> 
<div class="clearfix"></div>
            <ul class="location">
              <li><span class="glyphicon glyphicon-earphone"></span></li>
              <li>Fax No - +91- 11-26195516<br>
                                                           Phone No - +91-11-26187232(0)</li>
              
            </ul> 
<div class="clearfix"></div>
            <ul class="location">
              <li><span class="glyphicon glyphicon-envelope"></span></li>
              <li><a href="mailto:egovhelpdesk-cwc@nic.in" class="external">e-mail : secy-cwc[at]nic[dot]in</a><br>
                                                              <a href="mailto:grievance-cwc@nic.in" class="external">grievance-cwc[at]nic[dot]in</a><br>
                                                            <a href="mailto:egovhelpdesk-cwc@nic.in" class="external">egovhelpdesk-cwc[at]nic[dot]in</a></li>
              
            </ul>
<div class="clearfix"></div>
          
          </address>  </div>
</div>
</div>
 
      
</div>


        <div class="col-md-4 footer-grid">
          
                <h4 class="footer-head">Reach us</h4>

<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2477.7663907224646!2d77.17783001563716!3d28.567034980067017!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d1d9bc0b23fd5%3A0x654054e9d22962e6!2sCentral+Water+Commission!5e0!3m2!1sen!2sin!4v1521206122543" width="379" height="230" style="border:0" allowfullscreen=""></iframe>
        </div>



         
     </div>
   
     <div class="footer-bottom">
      Website owned & maintained by Central Water Commission, Ministry of Water Resources, River Development & Ganga 
                       Rejuvenation, Government of India
     </div>
</footer>
 
 
 
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/validationn.js"></script>
     <script type="text/javascript">
    $(function($) {

      $.ajaxSetup({
          data: {
              '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php echo $this->security->get_csrf_hash(); ?>'
          }
      });
   
  });//ends function

 /************JS for email verify********/

     $('#emaail_verrify_btn').on('click', function(event){
        var email = $('#emaail_verrify_value').val(); 
        var base_url = 'http://103.70.201.212:2001/cwc-jobs/';
        var link = base_url+'Frontend/verify_email/';
        var csrf_test_name = $("input[name=csrf_test_name]").val();

        if(email.length === 0)
        {
              var msg = 'Please enter email.';
              $(".errror").html(msg);
              $(".errror").show();
              $('.errror').css('color','red');                    
              return false;
        }

        else
        {
            $.ajax({
            method: "POST",
            url: link,
            data: {'csrf_test_name' : csrf_test_name,'email': email},
            success: function(result) {
            console.log(typeof(result));
            
           var obj = JSON.parse(result);
           if(obj.status == "success")
           {
              var msg = obj.msg;
                  $(".errror").html(msg);
                  $(".errror").show();
                  $('.errror').css('color','green'); 
                  $('#myModal').modal('show');
                 
           }

           else if(obj.status == "fails")
           {
              var msg = obj.msg;
              $(".errror").html(msg);
              $(".errror").show();
              $('.errror').css('color','red'); 
           }

           else
           {

           }
        }
        
    });
  }//ends else
});// ends function


    /************JS for phone verify**********/

   $('#phonnnee_verrify_btn').on('click', function(event){
        var email = $('#emaail_verrify_value').val();
        var phone = $('#phonnnee_verrify_value').val(); 
        var base_url = 'http://103.70.201.212:2001/cwc-jobs/';
        var link = base_url+'Frontend/verify_phone/';
        var csrf_test_name = $("input[name=csrf_test_name]").val();

        /*if(email.length === 0)
        {
              var msg = 'Please enter email.';
              $(".errror").html(msg);
              $(".errror").show();
              $('.errror').css('color','red');                    
              return false;
        }*/

         if(phone.length === 0)
        {
              var msg = 'Please enter phone.';
              $(".errffror").html(msg);
              $(".errffror").show();
              $('.errffror').css('color','red');                    
              return false;
        }

        else
        {
            $.ajax({
            method: "POST",
            url: link,
            /*data: {'csrf_test_name' : csrf_test_name,'email': email,'phone': phone},*/
            data: {'csrf_test_name' : csrf_test_name,'phone': phone},
            success: function(result) {
            console.log(typeof(result));
            
           var obj = JSON.parse(result);
           if(obj.status == "success")
           {
            //alert('asjdasjd');
              var msg = obj.msg;
                  $(".errffror").html(msg);
                  $(".errffror").show();
                  $('.errffror').css('color','green'); 
                  $('#myModal1').modal('show');

                 
           }

           else if(obj.status == "fails")
           {

              var msg = obj.msg;
              $(".errffror").html(msg);
              $(".errffror").show();
              $('.errffror').css('color','red');  
              $('#myModal1').modal('show');
           }

           else
           {

           }
        }
        
    });
  }//ends else
});// ends function

   // JS for  ***** verify mobile
   $('#verify_mobille').on('click', function(event){
        var otp_enter = $('#otp_code').val();
        var phone = $('#phonnnee_verrify_value').val();
        var base_url = 'http://103.70.201.212:2001/cwc-jobs/';
        var link = base_url+'Frontend/otp_verify/';
        var csrf_test_name = $("input[name=csrf_test_name]").val();

          $.ajax({
            method: "POST",
            url: link,
          
           data: {'csrf_test_name' : csrf_test_name,'otp_enter': otp_enter,'phone':phone},
            success: function(result) {
                console.log(typeof(result));
                //alert(result);
               var obj = JSON.parse(result);
               if(obj.status == "success")
               {
                
                  var msg = obj.msg;
                      $(".errffrorrrr").html(msg);
                      $(".errffrorrrr").show();
                      $('.errffrorrrr').css('color','green'); 
                      $('#phonnnee_verrify_value').attr('readonly', true); 
                      $('.modal').modal('hide');
                      $('#phonnnee_verrify_btn').hide();
                      $('.otp-success').show();
                       $(".errffror").html(msg);
                     $(".errffror").show();
                      $('.errffror').css('color','green'); 
                     // return false;    
               }

               else if(obj.status == "fails")
               {                
                  var msg = obj.msg;
                  $(".errffrorrrr").html(msg);
                  $(".errffrorrrr").show();
                  $('.errffrorrrr').css('color','red');
                 // return false;
                 // $('#myModal1').modal('show');
               }

               else
               {
                  
               }

              
            }
        
        });
  
});// ends function

   /*********JS for resend OTP**********/

   $('#resend_ottpp').on('click', function(event){

     
        var phone = $('#phonnnee_verrify_value').val(); 
        var base_url = 'http://103.70.201.212:2001/cwc-jobs/';
        var link = base_url+'Frontend/resnd_otp/';
        var csrf_test_name = $("input[name=csrf_test_name]").val();

         if(phone.length === 0)
        {
              var msg = 'Please enter phone.';
              $(".errffror").html(msg);
              $(".errffror").show();
              $('.errffror').css('color','red');                    
              return false;
        }

        else
        {
            $.ajax({
            method: "POST",
            url: link,
            /*data: {'csrf_test_name' : csrf_test_name,'email': email,'phone': phone},*/
            data: {'csrf_test_name' : csrf_test_name,'phone': phone},
            success: function(result) {
            console.log(typeof(result));
            
           var obj = JSON.parse(result);
           if(obj.status == "success")
           {
            //alert('asjdasjd');
              var msg = obj.msg;
                 $(".errffrorrrr").html(msg);
                 $(".errffrorrrr").show();
                 $('.errffrorrrr').css('color','green');
                
                 
           }

           else if(obj.status == "fails")
           {

              var msg = obj.msg;
               $(".errffrorrrr").html(msg);
                 $(".errffrorrrr").show();
                 $('.errffrorrrr').css('color','red');
              $('#myModal1').modal('show');
           }

           else
           {

           }
        }
        
    });
  }//ends else
});// ends function


   



  </script>

</body>

</html>