<!DOCTYPE html>
<html lang="<?php print $language->language; ?>">
<head>
<?php print $head; ?>

<title><?php print $head_title; ?></title>
<?php print $styles; ?>
<?php print $scripts; ?>
<?php
global $language; 
$lang=$language->language;
 
if($lang=="hi"){
$default="डिफ़ॉल्ट थीम";
$theme1="ग्रे थीम";
$theme2="ब्लैक थीम";
}
else
{
$default="Default Theme";
$theme1="Gray Theme";
$theme2="Black Theme";
}
?>
<!--[if lt IE 9]><script src="<?php print base_path() . drupal_get_path('theme', 'nexus') . '/js/html5.js'; ?>"></script><![endif]-->

<script>
(function ($) { // JavaScript should be compatible with other libraries than jQuery
$(function(){
	
//search button disable code starts	
$(document).ready(function(){
    $('.region-region-search .form-submit').attr('disabled',true);
    $('#edit-search-block-form--2').keyup(function(){
        if($(this).val().length !=0)
            $('.region-region-search .form-submit').attr('disabled', false);            
        else
            $('.region-region-search .form-submit').attr('disabled',true);
    })
});
//search button disable code ends
	
// onsubmit starts for feedback
$(document).ready(function(){  
    $(".webform-client-form").submit(function(e) {
		var alpha = /^\s*[a-zA-Z\s]+\s*$/;
		if(!alpha.test($(".feedback-name").val())){
			e.preventDefault();
			alert("Only alphabets are alloweded for name.");
			$(".feedback-name").focus();
		}
		//var alphanumers = /^[a-zA-Z0-9.,- ]+$/;
		var alphanumers = /^\s*[a-zA-Z0-9,.-\s]+\s*$/;
		if(!alphanumers.test($(".feedback-feedback").val())){
			e.preventDefault();
			alert("No special charcters are alloweded in feedback.");
			$(".feedback-feedback").focus();
		}
		var captcha_value = $('#edit-captcha-response').val();
  if(captcha_value == "")
  {
   e.preventDefault();
   alert("Please enter the captcha.");
   $("#edit-captcha-response").focus();
  }
var x = $(".feedback-email").val();
  var atpos = x.indexOf("@");
  var dotpos = x.lastIndexOf(".");
  if (atpos<1 || dotpos<atpos+2 || dotpos+2>=x.length) {
  e.preventDefault();
        alert("Please enter a valid e-mail address");
  $(".feedback-email").focus();
  }
		   
    });
});
// onsubmit ends for feedback
	
$( 'a' ).each(function() {
  if( location.hostname === this.hostname || !this.hostname.length ) {
      $(this).addClass('local');
  } else {
     $(this).addClass('external');
	}
});
$(".external").click(function(event) {
var href= $(this).attr('href');
alert("External site that opens in a new window " + href);
});
$("a.style-newstyle").attr("title","<? echo $default ?>");
$("a.style-newsite").attr("title","<? echo $theme1 ?>");
$("a.style-g").attr("title","<? echo $theme2 ?>");

});
})(jQuery);
</script>
</head>
<body class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</div>  <script type="text/javascript">
<!--//--><![CDATA[//><!--
var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel  = '0';var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfPlatform = 'Drupal 7';
//--><!]]>
</script>
<script type="text/javascript" src="//cdn.printfriendly.com/printfriendly.js"></script>
</html>
