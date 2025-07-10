   
   <footer class="wrapper footer-wrapper" style="clear:both;">

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
    <li><!-- <a href="mailto:egovhelpdesk-cwc@nic.in" class="external">e-mail : secy-cwc[at]nic[dot]in</a> -->
      <a  class="external">e-mail : egovhelpdesk-cwc@nic.in</a><br>
      <!-- <a href="mailto:grievance-cwc@nic.in" class="external">grievance-cwc[at]nic[dot]in</a> -->
      <a  class="external">grievance-cwc@nic.in</a><br>
    <!-- <a href="mailto:egovhelpdesk-cwc@nic.in" class="external">egovhelpdesk-cwc[at]nic[dot]in</a> -->
<a  class="external">egovhelpdesk-cwc@nic.in</a></li>
    
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

  
  <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/validationn.js"></script>
    <!-- <script src="https://cdn.jsdelivr.net/alasql/0.3/alasql.min.js"></script>
    <script src="https://cdn.jsdelivr.net/alasql/0.3/alasql.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.7.12/xlsx.core.min.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.0.272/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
    <script src="https://unpkg.com/jspdf-autotable@2.3.1/dist/jspdf.plugin.autotable.js"></script> -->
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/alasql.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/xlsx.core.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/html2canvas.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jspdf.debug.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jspdf.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jspdf.plugin.autotable.js"></script>
    
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/print.min.js"></script>

  <script>
    
    function mySubmit() 
    {
     
      var password = $('#pwd').val();
      var md = sha256(password);
     // var md = '<?php //echo encry('admin@123');?>';
      $('#pwd').val(md);
    
    }// ends function

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
 
  $('#restrict_special_char').keyup(function()
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


</script> 

 <script>
    
    /**************JS for Frgt pwd************/

  $('#frgt_pwd').validate({
    focusInvalid: false,
    ignore: "",
    rules: {
        email:{
            required : true,
            email : true
        },

       },

    messages: {
         email:{
            required : "Please enter email.",
            email : "Please enter email in proper format."
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

