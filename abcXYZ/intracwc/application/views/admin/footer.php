  
  

     <div class="footer-bottom">
			Website owned & maintained by Central Water Commission, Ministry of Jal Shakti, Department of Water Resources, River Development & Ganga 
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
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/validationn.js"></script>
    <script src="https://cdn.jsdelivr.net/alasql/0.3/alasql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.12/xlsx.core.min.js"></script>

      <script>
        
    $('.multiple_roles').select2();
     $("#span_password_msg").hide();

      $("#span_password_msg2").hide();
        /* JS for getting circle in drop down*/
        $('#building_id1').on('change', function(event){
            
        var building_id = $("#building_id1").val();
        var option ='';
        var base_url = "<?php echo base_url(); ?>";
        var link = base_url+'Administrator/Employee/all_room/';
        
      
        $.ajax({
        method: "POST",
        url: link,
        data: {'id':building_id},
        success: function(result) {
        console.log(typeof(result));
      
           var obj = JSON.parse(result);
           option = '<option selected="selected" value="">Select Room</option>';
            $.each(obj, function(){
                    option+='<option value="'+this["room_id"]+'">'+this["room_name"]+'</option>';
                });

        $("#room_id").html(option);
         event.preventDefault();

    }
        
    });
    });

/************************JS for section based on wing************/

$('#wing_id1').on('change', function(event){
            
        var wing_id = $("#wing_id1").val();
        var option ='';
        var base_url = "<?php echo base_url(); ?>";
        var link = base_url+'Administrator/User/all_section/';
        
      
        $.ajax({
        method: "POST",
        url: link,
        data: {'id':wing_id},
        success: function(result) {
        console.log(typeof(result));
      
           var obj = JSON.parse(result);
           option = '<option selected="selected" value="">Select Section</option>';
            $.each(obj, function(){
                    option+='<option value="'+this["section_id"]+'">'+this["section_name"]+'</option>';
                });

        $("#section_id1").html(option);
         event.preventDefault();

    }
        
    });
    });


/******************************JS for geeting post basis of orgn name*********/

      $('#organisation_name1').on('change', function(event){
            
        var organisation_id = $("#organisation_name1").val();
        var option ='';
        var base_url = "<?php echo base_url(); ?>";
        var link = base_url+'Contact/Designation/all_post/';
        
      
        $.ajax({
        method: "POST",
        url: link,
        data: {'id':organisation_id},
        success: function(result) {
        console.log(typeof(result));
      
           var obj = JSON.parse(result);
           option = '<option selected="selected" value="">Select Post</option>';
            $.each(obj, function(){
                    option+='<option value="'+this["contact_post_id"]+'">'+this["contact_post_name"]+'</option>';
                });

        $("#post_name1").html(option);
         event.preventDefault();

    }
        
    });
    }); ///ends function

    //JS for dynamic value of city in contact section*******

      $('#statee').on('change', function(event){
       
        var city_id = $("#statee").val();
        var option ='';
        var base_url = "<?php echo base_url(); ?>";
        var link = base_url+'Contact/Contactdetail/all_city/';
      
      
        $.ajax({
        method: "POST",

        url: link,
        data: {'id':city_id},
        success: function(result) {
          console.log(result); 
           var obj = JSON.parse(result);
            $.each(obj, function(){
                    option+='<option value="'+this["District_Name_In_English"]+'">'+this["District_Name_In_English"]+'</option>';
                });
        $("#cityy").html(option);
         event.preventDefault();

    }
        
    });
    });// ends function



/**************************JS for Add USER******************************/

            $("#wing_idd").hide();
            $("#section_idd").hide();
            $("#building_idd").hide();
            $("#room_idd").hide(); 
            $('#user_name').on('change', function() {
             
             var user_id = $("#user_name").val();
             var option ='';
             var base_url = "<?php echo base_url(); ?>";
             var link = base_url+'Administrator/User/employee_data/';
              $.ajax({
                method: "POST",
                url: link,
                data: {'id':user_id},
                success: function(result) {
                console.log(typeof(result));
              
                   var obj = JSON.parse(result);
                   option = '<option selected="selected" value="">Select Room</option>';
                   /* $.each(obj, function(){
                            option+='<option value="'+this["room_id"]+'">'+this["room_name"]+'</option>';
                        });*/
                option1='<option value="'+obj.room_id+'">'+obj.room_name+'</option>';
                option2='<option value="'+obj.building_id+'">'+obj.building_name+'</option>';
                option3='<option value="'+obj.designation_id+'">'+obj.designation_name+'</option>';
                $("#room_id").html(option1);
                $("#building_id").html(option2);
                $("#room_idd").show();
                $("#building_idd").show();
                $("#designation_id").val(obj.designation_name);
                $("#contact_no").val(obj.employee_mobile);
                $("#email_id").val(obj.employee_email);
                $("#userrid").val(obj.employee_email);
                $("#wing_idd").show();
                $("#section_idd").show();
                 //event.preventDefault();
				}
           });
          });// function ends

        /********Ends JS for Add USER**************/


        /**********JS for special characters******/

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

      /*******js for add user pwd*****/

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
          var sha  = sha256(password);
          var sha2 = sha256(password2);
          $('#pwd').val(sha);
          $('#pwd2').val(sha2);
     }
     
    
    }// ends function
    
      /********js for submit edit profile*******/

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
          //var old_password = $('#old_pwd').val();
          var password = $('#pwd').val();
          var password2 = $('#pwd2').val();
          var sha = sha256(password);
          var sha2 = sha256(password2);
          //var sha_old_pwd = sha256(old_password);
         
          $('#pwd').val(sha);
          $('#pwd2').val(sha2);
          //$('#old_pwd').val(sha_old_pwd);
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

      
    </script>

   


</body>

</html> 
