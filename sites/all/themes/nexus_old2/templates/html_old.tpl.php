<!DOCTYPE html>
<html lang="<?php print $language->language; ?>">
<head>
<?php print $head; ?>

<title><?php print $head_title; ?></title>
<?php print $styles; ?>
<?php print $scripts; ?>

<!--[if lt IE 9]><script src="<?php print base_path() . drupal_get_path('theme', 'nexus') . '/js/html5.js'; ?>"></script><![endif]-->
<script>
(function ($) { // JavaScript should be compatible with other libraries than jQuery
$(function(){
	
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
if ((href.search("gov.in") >= 0) ||(href.search("nic.in") >= 0)||(href.search(".in") >= 0)) {
} 
else{
alert("External site that opens in a new window " + href);
}
});
});
})(jQuery);
</script>
</head>
<body class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>