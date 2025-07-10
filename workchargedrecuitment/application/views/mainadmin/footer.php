<div class="footer-bottom">
      Website owned &amp; maintained by Central Water Commission, Ministry of Water Resources, River Development &amp; Ganga 
                       Rejuvenation, Government of India
     </div>


    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
     <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/dataTables.bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.slimscroll.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-ui.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/app.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/validationn.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.cookie.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/print.min.js"></script>
   
    <script type="text/javascript">

    
      $("#span_password_msg").hide();

      $("#span_password_msg2").hide();


     //datepicker

     $( function() {
            $("#datepicker11").datepicker({ dateFormat: 'dd/mm/yy' });
          } );

        $( function() {
            $("#datepicker12").datepicker({ dateFormat: 'dd/mm/yy' });
          } );

     
    function mySubmit() 
    {
     
      var password = $('#pwd').val();
      var password2 = $('#pwd2').val();


     if(password.length==0 || password2.length==0 )
     {
        return true;
     }

     else
     {
          var password = $('#pwd').val();
          var password2 = $('#pwd2').val();
          var sha = sha256(password);
          var sha2 = sha256(password2);
          $('#pwd').val(sha);
          $('#pwd2').val(sha2);
     }
     
    
    }// ends function

      //edit profile submit

    function mySubmit_profile() 
    {
     
      var password = $('#pwd').val();
      var password2 = $('#pwd2').val();

     if(password.length==0 || password2.length==0 )
     {
        return true;
     }

     else
     {
          var old_password = $('#old_pwd').val();
          var password = $('#pwd').val();
          var password2 = $('#pwd2').val();
          var sha = sha256(password);
          var sha2 = sha256(password2);
          var sha_old_pwd = sha256(old_password);
         
          $('#pwd').val(sha);
          $('#pwd2').val(sha2);
          $('#old_pwd').val(sha_old_pwd);
     }
     
    
    }// ends function


    //for key up password

    $("#pwd").focusin(function(){
    $("#span_password_msg").hide();
    });

    $("#pwd2").focusin(function(){
    $("#span_password_msg2").hide();
    });

    $("#pwd").focusout(function(){
       var password = $('#pwd').val();
       var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{4,70}$/;

       if(password.match(paswd))
       {
         $("#span_password_msg").hide();
          
       }

      else{
       $("#span_password_msg").show();
      }
  });


 
        //key up password2

    $('#pwd2').focusout(function(){
       var password = $('#pwd2').val();
       var paswd=  /^(?=.*[0-9])(?=.*[!@#$%^&*])[a-zA-Z0-9!@#$%^&*]{4,70}$/;

      if(password.match(paswd))
       {
         $("#span_password_msg2").hide();
          
       }

      else{
       $("#span_password_msg2").show();
      }
    });  




      //SHA 

   function sha256(ascii) {
  function rightRotate(value, amount) {
    return (value>>>amount) | (value<<(32 - amount));
  };
  
  var mathPow = Math.pow;
  var maxWord = mathPow(2, 32);
  var lengthProperty = 'length'
  var i, j; // Used as a counter across the whole file
  var result = ''

  var words = [];
  var asciiBitLength = ascii[lengthProperty]*8;
  
  //* caching results is optional - remove/add slash from front of this line to toggle
  // Initial hash value: first 32 bits of the fractional parts of the square roots of the first 8 primes
  // (we actually calculate the first 64, but extra values are just ignored)
  var hash = sha256.h = sha256.h || [];
  // Round constants: first 32 bits of the fractional parts of the cube roots of the first 64 primes
  var k = sha256.k = sha256.k || [];
  var primeCounter = k[lengthProperty];
  /*/
  var hash = [], k = [];
  var primeCounter = 0;
  //*/

  var isComposite = {};
  for (var candidate = 2; primeCounter < 64; candidate++) {
    if (!isComposite[candidate]) {
      for (i = 0; i < 313; i += candidate) {
        isComposite[i] = candidate;
      }
      hash[primeCounter] = (mathPow(candidate, .5)*maxWord)|0;
      k[primeCounter++] = (mathPow(candidate, 1/3)*maxWord)|0;
    }
  }
  
  ascii += '\x80' // Append Ƈ' bit (plus zero padding)
  while (ascii[lengthProperty]%64 - 56) ascii += '\x00' // More zero padding
  for (i = 0; i < ascii[lengthProperty]; i++) {
    j = ascii.charCodeAt(i);
    if (j>>8) return; // ASCII check: only accept characters in range 0-255
    words[i>>2] |= j << ((3 - i)%4)*8;
  }
  words[words[lengthProperty]] = ((asciiBitLength/maxWord)|0);
  words[words[lengthProperty]] = (asciiBitLength)
  
  // process each chunk
  for (j = 0; j < words[lengthProperty];) {
    var w = words.slice(j, j += 16); // The message is expanded into 64 words as part of the iteration
    var oldHash = hash;
    // This is now the undefinedworking hash", often labelled as variables a...g
    // (we have to truncate as well, otherwise extra entries at the end accumulate
    hash = hash.slice(0, 8);
    
    for (i = 0; i < 64; i++) {
      var i2 = i + j;
      // Expand the message into 64 words
      // Used below if 
      var w15 = w[i - 15], w2 = w[i - 2];

      // Iterate
      var a = hash[0], e = hash[4];
      var temp1 = hash[7]
        + (rightRotate(e, 6) ^ rightRotate(e, 11) ^ rightRotate(e, 25)) // S1
        + ((e&hash[5])^((~e)&hash[6])) // ch
        + k[i]
        // Expand the message schedule if needed
        + (w[i] = (i < 16) ? w[i] : (
            w[i - 16]
            + (rightRotate(w15, 7) ^ rightRotate(w15, 18) ^ (w15>>>3)) // s0
            + w[i - 7]
            + (rightRotate(w2, 17) ^ rightRotate(w2, 19) ^ (w2>>>10)) // s1
          )|0
        );
      // This is only used once, so *could* be moved below, but it only saves 4 bytes and makes things unreadble
      var temp2 = (rightRotate(a, 2) ^ rightRotate(a, 13) ^ rightRotate(a, 22)) // S0
        + ((a&hash[1])^(a&hash[2])^(hash[1]&hash[2])); // maj
      
      hash = [(temp1 + temp2)|0].concat(hash); // We don't bother trimming off the extra ones, they're harmless as long as we're truncating when we do the slice()
      hash[4] = (hash[4] + temp1)|0;
    }
    
    for (i = 0; i < 8; i++) {
      hash[i] = (hash[i] + oldHash[i])|0;
    }
  }
  
  for (i = 0; i < 8; i++) {
    for (j = 3; j + 1; j--) {
      var b = (hash[i]>>(j*8))&255;
      result += ((b < 16) ? 0 : '') + b.toString(16);
    }
  }
  return result;
};

//
      $(function(){
 
  $('.restrict_special_char').keyup(function()
  {
    var yourInput = $(this).val();
    re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
      $(this).val(no_spl_char);
    }
  });
 
});

      $(function(){
 
  $('#restrict_special_char2').keyup(function()
  {
    var yourInput = $(this).val();
    re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
      $(this).val(no_spl_char);
    }
  });
 
});

      $(function(){
 
  $('#restrict_special_char3').keyup(function()
  {
    var yourInput = $(this).val();
    re = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi;
    var isSplChar = re.test(yourInput);
    if(isSplChar)
    {
      var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi, '');
      $(this).val(no_spl_char);
    }
  });
 
});


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
        var link = base_url+'Superadmin/all_circle/';
        /*var csrf_test_name =$("input[name=csrf_test_name]").val();*/
        var csrf_test_name =$("input[name=csrf_test_name]").val();
      
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
        var link = base_url+'Superadmin/all_circle/';
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
        var link = base_url+'Superadmin/all_circular_circle/';
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

      /********validation for user form********/


  $('#add_usserrs').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        /*region_name:{
            required : true
        },

        circle_name:{
            required : true
        },*/

        post_name:{
            required : true
        },

        password:{
          required : true
          
        },

        cnfrm_password:{
          required : true
          
        },

        post_code:{
            required : true
        },

        user_type:{
            required : true
        },

        user_name:{
            required : true
        },

        email:{
            email : true
        },

        contact_no:{
            required : true
        },

        refrence_no:{
            required : true
        },

      
        
        user_id:{
            required : true
        },
       },

    messages: {

        /*region_name:{
            required : "Please enter region name."    
        },

        circle_name:{
             required : "Please enter circle name."    
        },*/

        post_name:{
            required : "Please enter post name." 
        },

        post_code:{
             required : "Please enter post code." 
        },

        password:{
          required : "Please enter password." 
          
        },

        cnfrm_password:{
          required : "Please enter confirm password." 
          
        },

        user_type:{
            required : "Please enter user type."  
        },

        user_name:{
            required : "Please enter user name."  
        },

        email:{
           email : "Please enter email."  
        },

        contact_no:{
            required : "Please enter contact no."  
        },

         refrence_no:{
           required : "Please enter refrence no."
        },

        user_id:{
           required : "Please enter userid."
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


    /*****Region and Circle show on change of user type********/
    $("#region").hide();
    $("#circle").hide(); 
    $('#usertype').on('change', function() {
        
     if(this.value == "1")
     {
       $("#region").hide();
       $("#circle").hide();
     } 
     else if(this.value == "3")
     {
       
        $("#region").show();
        $("#circle").show();
       
     } 
     else 
     {
       
        $("#region").hide();
        $("#circle").hide();  
     }
    
  })// function ends
    </script>
    
</body>

</html>