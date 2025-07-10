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
$theme1="Grey Theme";
$theme2="Black Theme";
}
?>
<!--[if lt IE 9]><script src="<?php print base_path() . drupal_get_path('theme', 'nexus') . '/js/html5.js'; ?>"></script><![endif]-->
<?php global $user;
$mystring = (end(($user->roles)));
$findme   = 'user';
$pos = strpos($mystring, $findme);
if ($pos === false) {?>
		<script>
(function ($) { // JavaScript should be compatible with other libraries than jQuery
$(function(){
$(document).ready(function(){

   
 $('.menu-18 a').attr("href", "<?php echo $GLOBALS['base_url'];?>/admin/people");   
    });
	});
	})(jQuery);
</script>
<?php }

else{?>
	<script>
(function ($) { // JavaScript should be compatible with other libraries than jQuery
$(function(){
$(document).ready(function(){

   
 $('.menu-18 a').attr("href", "<?php echo $GLOBALS['base_url'];?>/admin/peoples"); 
 $('#edit-roles .form-type-checkbox').css("display","none"); 
 $('#edit-roles .form-item-roles-20').css("display","block");
 $('#edit-roles .form-item-roles-21').css("display","block"); 
$('.menu-4300').css("display","none"); 
 $('#user-profile-form--2 .form-type-checkbox').css("display","none"); 
 $('#user-profile-form--2 .form-item-roles-20').css("display","block");
 $('#user-profile-form--2 .form-item-roles-21').css("display","block");   
 $('#edit-sections-workbench-access').css("display","none"); 
 $(".toolbar-shortcuts ul li").eq(5).css("display","none");
$(".toolbar-shortcuts ul li").eq(2).css("display","none");
 var url= window.location.href;
 if(url=="<?php echo $GLOBALS['base_url'];?>/admin/people") 
 {
	 window.location.replace("<?php echo $GLOBALS['base_url'];?>/admin/peoples");
 }
 
 });
	});
	})(jQuery);
</script>
<? }
?>

<script>
(function ($) { // JavaScript should be compatible with other libraries than jQuery
$(function(){


	
// $(window).scroll(function(){
  // if ($(window).scrollTop() >= 200) {
    // $('.header-bottom').addClass('fixed');
   // }
   // else {
    // $('.header-bottom').removeClass('fixed');
   // }
// });	
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
$( 'a' ).each(function() {
  if( location.hostname === this.hostname ) {
     $(this).addClass('local');
  }

else {
     $(this).addClass('external');
    $(this).attr("tabindex","0");

	}
});
$(".external").click(function () {
if (! $(this).attr('href') ) {
       return false;

        e.preventDefault();
    }
	var href= $(this).attr('href');
   if (href =="javascript:void(0)" || href=="javascript:;"){
	   return false;
   }
 if (confirm("External site that opens in a new window " + href) == true) {
        return true;
    } else {
        return false;
    }

});
$('.sb-icon-search').click(function(){
	
if($('#edit-search-block-form--2').val()==""){
	$("#sb-search").toggleClass("sb-search-open");
	
}
else{
	$("#search-block-form").submit();
	
}


});
$("#edit-search-block-form--2").addClass("sb-search-input");
$("a.style-newstyle").attr("title","<? echo $default ?>");
$("input").attr("autocomplete","off");
$("a.style-newsite").attr("title","<? echo $theme1 ?>");
$("a.style-g").attr("title","<? echo $theme2 ?>");
 $('#slide').click(function(){
	 $('#slide').hide();
    var hidden = $('.hidden');
    if (hidden.hasClass('visible')){
        hidden.animate({"right":"-1000px"}, "slow").removeClass('visible');
    } else {
        hidden.animate({"right":"0px"}, "slow").addClass('visible');
    }
    });
$('#slide2').click(function(){
	$('#slide').show();
 var hidden2 = $('.hidden');
    if (hidden2.hasClass('visible')){
        hidden2.animate({"right":"-1000px"}, "slow").removeClass('visible');
    }
});	


 $('#slide3').click(function(){
	 $('#slide3').hide();
    var hidden = $('.hidden2');
    if (hidden.hasClass('visible')){
        hidden.animate({"right":"-1000px"}, "slow").removeClass('visible');
    } else {
        hidden.animate({"right":"0px"}, "slow").addClass('visible');
    }
    });

$('#slide4').click(function(){
	$('#slide3').show();
 var hidden2 = $('.hidden2');
    if (hidden2.hasClass('visible')){
        hidden2.animate({"right":"-1000px"}, "slow").removeClass('visible');
    }
});


<?php 
if (arg(0) == 'node' && is_numeric(arg(1))) {
  $nid = arg(1);
 $node = node_load($nid);
 $views_page = views_get_page_view();
   // echo "<pre>";print_r($node);
if($node->name=="admin"){?>	
	
$("a[href$='.pdf'],a[href$='.Pdf'],a[href$='.PDF']").each(function() {
if( location.hostname === this.hostname ) {
var url = $(this).attr('href');
var filename = url.substring(url.lastIndexOf('/')+1);
var newurl='/sites/default/files/'+filename;

var newurlall='<?php echo $GLOBALS['base_url'];?>/sites/default/files/'+filename;
				if(newurl==url || newurlall==url){
					
					  var links='<?php echo $GLOBALS['base_url'];?>/sites/default/files/';
		$(this).attr('href','<?php echo $GLOBALS['base_url'];?>/sites/default/files/'+filename);
		$('<img class="file-icon2" alt="PDF icon" title="application/pdf" src="<?php echo $GLOBALS['base_url'];?>/modules/file/icons/application-pdf.png"><span class="newsize">('+getFileSize(links+filename)+')</span>').insertAfter(this);

$('.file-size').remove();
$('.file-icon').remove();
$('.filesize').remove();
				}
				var newurl2='/sites/default/files/admin/'+filename;
				var newurlall2='<?php echo $GLOBALS['base_url'];?>/sites/default/files/admin/'+filename;
				if(newurl2==url || newurlall2==url){
					var links='<?php echo $GLOBALS['base_url'];?>/sites/default/files/admin/';
					if(getFileSize(links+filename)=='0byte'){
						$(this).attr('href','<?php echo $GLOBALS['base_url'];?>/sites/default/files/'+filename);
		             			  var links='<?php echo $GLOBALS['base_url'];?>/sites/default/files/';
		$(this).attr('href','<?php echo $GLOBALS['base_url'];?>/sites/default/files/'+filename);
		$('<img class="file-icon2" alt="PDF icon" title="application/pdf" src="<?php echo $GLOBALS['base_url'];?>/modules/file/icons/application-pdf.png"><span class="newsize">('+getFileSize(links+filename)+')</span>').insertAfter(this); 
					}
					else{
						$(this).attr('href','<?php echo $GLOBALS['base_url'];?>/sites/default/files/admin/'+filename);
		$('<img class="file-icon2" alt="PDF icon" title="application/pdf" src="<?php echo $GLOBALS['base_url'];?>/modules/file/icons/application-pdf.png"><span class="newsize">('+getFileSize(links+filename)+')</span>').insertAfter(this);
					}
					
					 
		

$('.filesize').remove();
$('.file-size').remove();
$('.file-icon').remove();
				}
				else{
			
				}

}


});

  <?php }
} 
?>

	
	

$('#map a').bind('click', function(){
	var hrefnew=$(this).attr('link');
	console.log("<?php echo $GLOBALS['base_url'];?>/"+hrefnew);
	 // $(".overlay").css("visibility", "visible");
	 // $(".overlay").css("opacity", "1");

    // var title=$(this).attr('title'); 
	if(hrefnew == null){
		return false;
	}
	else{
		window.open("<?php echo $GLOBALS['base_url'];?>/"+hrefnew, '_blank');
	}
	
	
	// if (hrefnew  == null){
	// $(".contentnew p").css("display","none");
	// $(".contentnew").text("there is no content");
   	
	// }
	// else{
	// $("#name").text(title);
	// $("#link").attr("href",hrefnew);
	// }
   
});

  
	 // $(".close").click(function(){
		
        // $(".overlay").css("visibility", "hidden");
		// $(".overlay").css("opacity", "0");
		// $("#link").attr("href"," ");
        // $("#name").text("");
    	// $("#link").attr("href","");

    // });	
});
});
})(jQuery);
function opentns(id) {
var content=document.getElementById(id).innerHTML;
 document.getElementById(id).style.display = "block"; 
 bootbox.alert({
  message: content,
        backdrop: true
    });
 document.getElementById(id).style.display = "none"; 
}
function getFileSize(url)
{
    var fileSize = '';
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false); // false = Synchronous

    http.send(null); // it will stop here until this http request is complete

    // when we are here, we already have a response, b/c we used Synchronous XHR

    if (http.status === 200) {
        fileSize = http.getResponseHeader('content-length');
        console.log('fileSize = ' + fileSize);
    }
	
	
	
	return formatSizeUnits(fileSize);
}
function formatSizeUnits(bytes){
      if      (bytes>=1073741824) {bytes=(bytes/1073741824).toFixed(2)+'GB';}
      else if (bytes>=1048576)    {bytes=(bytes/1048576).toFixed(2)+'MB';}
      else if (bytes>=1024)       {bytes=(bytes/1024).toFixed(2)+'KB';}
      else if (bytes>1)           {bytes=bytes+'bytes';}
      else if (bytes==1)          {bytes=bytes+'byte';}
      else                        {bytes='0byte';}
      return bytes;
}

</script>
<script>
<!--//--><![CDATA[//><!--
var pfHeaderImgUrl = '';var pfHeaderTagline = '';var pfdisableClickToDel  = '0';var pfHideImages = 0;var pfImageDisplayStyle = 'right';var pfDisablePDF = 0;var pfDisableEmail = 0;var pfDisablePrint = 0;var pfCustomCSS = '';var pfPlatform = 'Drupal 7';
//--><!]]>
</script>
<script  src="//cdn.printfriendly.com/printfriendly.js"></script>


</head> 
<body class="<?php print $classes; ?>"<?php print $attributes; ?>>
  <?php print $page_top; ?>
  <?php print $page; ?>
  <?php print $page_bottom; ?>
</body>
</html>

