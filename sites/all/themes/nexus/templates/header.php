<?php
 $site_slogan = variable_get('site_slogan', "Default site name");
 $new =render($node);
 
 $uid=$node->uid;
 $user=user_load($uid);
 $name=$user->name;
//$front = url(variable_get('site_frontpage', 'node'));
	$big_array = get_object_vars($new);
	$mystring = variable_get('username',"virtual site name");
  $mystring2 = variable_get('menu',"virtual site name");


    $findme   = 'user';
    $pos = strpos($mystring, $findme);
      print render($page['main_home']); 
	    print render($page['headquarter']); ?>
		
       <?php print render($page['regional_office']); ?>
	    
	   <div class="hidden">
	  
	   <?php print render($page['help']); ?>
	   
	   </div>
	    <div class="hidden2">
	  
	   <?php print render($page['youtube']); ?>
	   
	   </div>
	<?php	
	
    // Note our use of ===. Simply, == would not work as expected
    // because the position of 'a' was the 0th (first) character.
    // if ($pos === false) {
         // print render($page['headquarter']); 
         // print render($page['regional_office']); 
    // }
    // else {
        // $site_slogan = variable_get('site_slogan', "Default site name");
        // print render($page['headquarter']); 
        // print render($page['regional_office']);
        
    // }
 
?>
	


<?php



    global $language; 
     $baseurl=$GLOBALS['base_url'];
     $lang=$language->language;
  if($lang=="hi"){
   $base_url=$baseurl;
   $geth1class = 'class="h1classhindi"';
   $ilink="महत्वपूर्ण लिंक";
    $logoa1='केंद्रीय जल आयोग';
    $logoa2='(1945 से राष्ट्र की सेवा में)';
	$india="भारत सरकार";
	$login="लॉग इन";
  }
  if($lang=="en"){
	  $india="Government of India";
    $base_url=$baseurl.'/hi';
	$geth1class = 'class="h1classeng"';
	 $ilink="Important Links";
	$logoa1='Central Water Commission';
$logoa2='(Serving the nation since 1945)';
$login="Login";
  }
  if($lang=="gu"){
	
    $base_url=$baseurl;
  }
  $site_name = variable_get('site_name', "Default site name");
  
if($site_name != ""){
 $gettitle = $site_name;
}

if($site_slogan != ""){
 $gettitle .= " | ".$site_slogan;
}


  
?>

	<!-- header-section-starts-here -->
	<div class="header-top">
			<div class="wrap">
				<div class="top-menu">
					<img src="<?=$GLOBALS['base_url']?>/sites/all/themes/nexus/images/flag.jpg" alt="india flag image"> <?php echo " ".$india ?>
				</div>
				<div class="num">
					<ul>
					<li><a href="<?=$GLOBALS['base_url']?>" class="home"><span class="glyphicon glyphicon-home"></span>
</a></li><li> <?php print render($page['social_link']); ?></li>
					<li> <?php print render($page['skip_to_main']); ?></li>
					<li><?php print render($page['style_switcher']); ?></li>
					<li><?php print render($page['textsize']); ?></li>
					<li><?php print render($page['search']); ?></li>
					<li><?php print render($page['language_tran']); ?></li>
					<li><a href="<?=$GLOBALS['base_url']?>/user" target="_blank" class="home"><?php echo $login; ?></a></li>
								
				</ul>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="header-bottom">
		
		<div class="wrap">
		
		
		<div class="row">
		<div class="col-md-6">
		<div class="logimg"><img src="<?=$GLOBALS['base_url']?>/sites/default/files/cwc-logo2.png" alt="" /></div>
		<div class="logtext"><h1 class="logo"><?php echo $logoa1;?></h1><p class="logo-text"><?php echo $logoa2;?></p></div>
		<div class="clearfix"></div>
  
  </div>
  <div class="col-md-6 text-right">
  
	<div class="logo">




<?php 
	if ($pos === false) { ?>

  <a href="<?php print $front_page; ?>" title="<?php print t($gettitle); ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Site Logo'); ?>"  /></a>

<?php } 

else {?>
	
<h1 class="headermainTxt"><?php echo $site_slogan; ?></h1>
<?php }

?>
	
	</div>
			
	</div>
	
	

  
</div>
		
			
			
			
			</div>
			
			
			
	<div class="menu-bg">
	<div class="container">
   <div class="col-sm-12 ">
	  <div id="cssmenu">
			  <div id="topNav">
				 <?php
				 
if($mystring2=="main_menu"){
		print render($page['header']);
	}
	else{
		print render($page['header2']);
	}
    			 

			  ?>
				
				
			  </div>
			</div>
	  
	   
   </div>
    </div>
	 </div>		
			

	</div>
	<!-- header-section-ends-here -->

