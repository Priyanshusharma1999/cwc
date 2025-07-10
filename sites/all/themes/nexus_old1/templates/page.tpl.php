<?php
    global $language; 
     $baseurl=$GLOBALS['base_url'];
     $lang=$language->language;
  if($lang=="hi"){
   $base_url=$baseurl.'/en';
   $geth1class = 'class="h1classhindi"';
  }
  if($lang=="en"){
    $base_url=$baseurl;
	$geth1class = 'class="h1classeng"';
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

<section class="top-header01" >
<div class="container" >
<div class="row">
	<div class="col-sm-12"> 
	    <div class="top-left01-inner1">
			
			 <?php print render($page['skip_to_main']); ?>
		</div>
		<div class="top-right01">
			
		<div class="top-right-inner2">
		<?php print render($page['style_switcher']); ?>
		</div>
		
		<div class="top-right-inner4">
		<?php print render($page['language_tran']); ?>
		</div>
		<div class="top-right-inner3">
		<?php print render($page['textsize']); ?>
		</div>
		
		<div class="clr"></div>
		</div>
		<div class="clr"></div>
	</div>
</div>
</div>
</section>

<div class="container">
<div class="row">	
	<div class="col-sm-12 ">
		   <div id="logo" class="col-md-8 col-sm-7 col-xs-12 animated fadeInDown delay-07s">
			<?php if ($logo): ?> <div id="site-logo" class="logo"><a href="<?php print $front_page; ?>" title="<?php print t($gettitle); ?>">
			  <img src="<?php print $logo; ?>" alt="<?php print t('Site Logo'); ?>" />
			</a></div>
			
			<?php endif; ?>
			</div>
			<div class="col-md-4  col-sm-5 col-xs-12"><?php print render($page['region_search']); ?></div>
   </div>
</div>
</div>
<div class="main">
	<div class="menu-bg">
	<div class="container">
   <div class="col-sm-12 ">
	  <div id="cssmenu">
			  <div id="topNav">
			  <?php
$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
if (strpos($url,'ibo') !== false || strpos($url,'ybo') !== false) {
   print render($page['header2']);
} 

else {
    print render($page['header']);
}
			  ?>
				
				
			  </div>
			</div>
	  
	   
   </div>
    </div>
	 </div>
<?php if ($breadcrumb): ?><div id="breadcrumbs"><div class="container"><?php print $breadcrumb; ?></div></div><?php endif; ?>

 <?php
if (drupal_is_front_page()):
    ?> 

   <div class="main-banner-01">
	   <div class="col-sm-12 ">
		<?php print render($page['slide_show']); ?>
	   </div>
   </div>

 <div style="clear:both"></div>
 
<div class="newsmarquee">
<div class="col-sm-1 newsleft" tabindex="0">Latest News</div>
<div class="col-sm-11 news-slider"><?php print render($page['homepage_news_slider']); ?></div>
</div>

 <div style="clear:both"></div>
 
<div id="maincontain-textsize">
 
<div class="container">
 <div class="row">
     <div class="col-sm-9 home-3-box home_height" id="maincontent">
	   <?php print render($page['content']);?>
		
    </div>
	  <div class="col-sm-3 homebg2" tabindex="0">
	   <?php print render($page['gallery']); ?>
	  </div>
	  
	  	  
	
	</div>
	
</div>
<div class="middlebox">
<div class="container">	
	  <div class="row">
	    <div class="col-sm-3 bgorange">
			
			<div class="news-box2"> <?php print render($page['district_pofile']); ?></div>
			
		</div>
	    <div class="col-sm-3 bgorange ">
			
			<div class="news-box2"><?php print render($page['district_information']); ?></div>
			
		</div>
	    <div class="col-sm-3 bgorange">
			
			<div class="news-box2"><?php print render($page['sectors_departments']); ?></div>
			
		</div>
		
		 <div class="col-sm-3">
			
			<div class="news-box2"><?php print render($page['notice_alert']); ?></div>
			
		</div>
		
		
		</div>
		</div>
		</div>
		<div class="container">	
	  <div class="clr"></div>
	 <div class="row">
	<div class=" col-sm-6 news-box"><?php print render($page['infocus']); ?></div>
	<div class=" col-sm-6 news-box"><?php print render($page['important_link']); ?></div>
	</div>
	<div class="clr"></div>
	  

	
	
   
	
</div>
</div>

<?php else: ?>
<div class="container" id="maincontain-textsize">
<div id="maincontent"></div>
<div class="row siderbartitle">
	
	<?
	$main_content = get_object_vars($node); 
	$body =$main_content['field_check_this_if_content_not_']['und'][0]['value'];
	$tanslated_node = translation_node_get_translations($node->tnid);
	$array_val = json_decode(json_encode($tanslated_node), True);
	$transleted_url=$array_val['hi']['nid'];
	$alias = drupal_get_path_alias('node/'.$transleted_url);
	$translations = translation_path_get_translations('node/'.$transleted_url);
	     $url=drupal_get_path_alias();
	//echo $translations;
	
	
	
if($lang == "hi"){
	$url_alias=drupal_get_path_alias('node/'.$transleted_url, 'en');
			$getdepartment = "विभाग का नाम";
			$getdate = "तारीख";
			$gettehsil = "तहसील का नाम";
			$getview = "देखें / डाउनलोड";
			$getexternalview = "बाह्य पीडीएफ देखें / डाउनलोड करें";
			$getpost = "पद";
			$expiry_date = "अंतिम तिथी";
			$click_download = " देखने या डाउनलोड करने के लिए यहां क्लिक करें ";
			$click_here = "यहां क्लिक करे";
			$view_download = "देखने या डाउनलोड करने के लिए";
			$get_ext_link = "लिंक";
		}else{
		$url_alias=drupal_get_path_alias('node/'.$transleted_url, 'hi');
			$getdepartment = "Department name";
			$gettehsil = "Department name";
			$getdate = "Date";
			$getview = "View / Download";
			$getpost = "Post";
			$expiry_date = "Last Date";
			$getexternalview = "View/Download External PDF";
			$click_download = "Click Here to view or download";
			$click_here = "Click Here";
			$view_download = "to view or download";
			$get_ext_link = "Link";
			
		} 
		
	if ($node->type=='important_notice' || $node->type=='news' || $node->type=='recruitment' || $node->type=='tender' || $node->type=='revenue'|| $node->type=='zila-panchayat-district-updates' ){ ?>
	<? 
	
	function formatSizeUnits($bytes)
    {
        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        return $bytes;
}
	
      $new =render($node);
	
	  $big_array = get_object_vars($new);
	  //echo "<pre>"; print_r($big_array);
	  $i=1;$j=0;
	  $title = $big_array['field_department_name'];
		
		
		$uploaded_pdf = $big_array['field_upload_pdf']['und'];
		  
		foreach($uploaded_pdf as $value){
		  
		  foreach($big_array['field_pdf_title']['und'] as $value1){
			$pdf_title = $big_array['field_pdf_title']['und'][0]['value'];
		}		
		 $link=$base_path."sites/default/files/".$value['filename']; 
     $filename = "sites/default/files/".$value['filename'];
	 $path_info = pathinfo($filename);
	$file_extension= $path_info['extension'];
       $bytes=$value['filesize'];
		
		 if($file_extension=="pdf"){
		   $filetype='<img class="file-icon" alt="PDF icon" title="application/pdf" src="'.$GLOBALS['base_url'].'/modules/file/icons/application-pdf.png">';
	   }
	    if($file_extension=="zip"){
		   $filetype='<img class="file-icon" alt="Package icon" title="application/zip" src="'.$GLOBALS['base_url'].'/modules/file/icons/package-x-generic.png">';
	   } 
	   if($file_extension=="xlsx"){
		   $filetype='<img class="file-icon" alt="File" title="application/msexcel" src="'.$GLOBALS['base_url'].'/modules/file/icons/x-office-spreadsheet.png">';
	   } 
	   if($file_extension=="doc" || $file_extension=="docs"){
		   $filetype='<img class="file-icon" alt="Microsoft Office document icon" title="application/msword" src="'.$GLOBALS['base_url'].'/modules/file/icons/x-office-document.png">';
	   }
		  
		  //$pdf_title = render(field_view_field('node', $node, 'field_pdf_title',array('label'=>'hidden')));
		  if(count($uploaded_pdf) == $i){
			//$htmldata .= '<a href="'.$link.'" target="blank" title="'.$pdf_title.'">'.$value['description'].'</a>';
		 $htmldata .= '<div class="linkfilesize2"><a href="'.$link.'" target="_blank" title="'.$click_download.' '.$value['description'].'">'.$value['description'].'</a>&nbsp; - ' .$filetype . "  &nbsp; <span class='filesize'>File size: &nbsp; ".formatSizeUnits($bytes).'</span></div>';
		 }else{
			  $htmldata .= '<div class="linkfilesize2"><a href="'.$link.'" target="_blank" title="'.$click_download.' '.$value['description'].'">'.$value['description'].'</a>  &nbsp; - ' .$filetype . "  &nbsp; <span class='filesize'>File size: &nbsp; ".formatSizeUnits($bytes).'</span></div><br> ';
		  }
		  $i++;		
	  }
	  $k=0;
	  foreach($big_array['field_internal_external_link']['und'] as $value2){
			$ext_link = $big_array['field_internal_external_link']['und'][0]['url'];
			$external_link_title = $big_array['field_internal_external_link']['und'][0]['title'];
			$target = $big_array['field_internal_external_link']['und'][0]['attributes'];
			$targets = $target['target'] ;
		
			if($targets != "")
			{
				$tar = $targets;
			}
			else{$tar = "_self";}
		
			if(count($ext_link) == $i){
			$external_link .= '<a href="'.$ext_link.'" target="'.$tar.'" title="'.$click_download.' '.$external_link_title.'">'.$external_link_title.'</a>';
		 }else{
			  $external_link .= '<a href="'.$ext_link.'" target="'.$tar.'" title="'.$click_download.' '.$external_link_title.'">'.$external_link_title.'</a> <br> ';
		  }
		  $k++;
		}
	  
	  $dou = render(field_view_field('node', $node, 'field_important_notice_date',array('label'=>'hidden')));
	  $department = render(field_view_field('node', $node, 'field_department_name',array('label'=>'hidden')));
	  $name_of_tehsil = render(field_view_field('node', $node, 'field_name_of_tehsil',array('label'=>'hidden')));
	  $department2 = render(field_view_field('node', $node, 'field_name_of_department',array('label'=>'hidden')));
	  
	  $title = render(field_view_field('node', $node, 'title_field',array('label'=>'hidden')));
	  $post = render(field_view_field('node', $node, 'field_post',array('label'=>'hidden')));
	  $exp_date = render(field_view_field('node', $node, 'field_expiry_date',array('label'=>'hidden')));
	  //$external_link = render(field_view_field('node', $node, 'field_internal_external_link',array('label'=>'hidden')));
	  
	  
	  //echo "<pre>";print_r($big_array);

	if ($big_array['body']['und'][0]['value']=='' && $body !="1"){?>

	<div class="col-sm-9">
	<h1 tabindex="0" <?php echo $geth1class;?> ><?php echo $title = drupal_get_title();?></h1>
	
	
	<table class="table table-bordered nobodytable" tabindex="0">
		<tbody>
	<?php 
	if($department != ""){
	?>
	<tr>
	    <th><?php echo $getdepartment; ?></th>
	    <td><?php echo $department; ?></td>
	</tr>
	<?php 
	}
	if($department2 != ""){
	?>
	<tr>
	    <th><?php echo $getdepartment; ?></th>
	    <td><?php echo $department2; ?></td>
	</tr>
	<?php 
	}
	if($name_of_tehsil != ""){
	?>
	<tr>
	    <th><?php echo $gettehsil; ?></th>
	    <td><?php echo $name_of_tehsil; ?></td>
	</tr>
	<?php 
	}
	if($post != ""){
	?>
	<tr>
	    <th><?php echo $getpost; ?></th>
	    <td><?php echo $post;  ?></td>
	</tr>
	<?php 
	}
	if($dou != ""){
	?>
	<tr>
	    <th><?php echo $getdate; ?></th>
	    <td><?php echo $dou;  ?></td>
	</tr>
	<?php 
	}
	if($external_link != ""){
	?>
	<tr>
	   <th><?php echo $get_ext_link; ?></th>
	   <td><?php echo $external_link;  ?></td>
	</tr>
	<?php 
	}
	if($htmldata != ""){
	?>
	<tr>
	   <th><?php echo $getview; ?></th>
	   <td><?php echo $htmldata;  ?></td>
	</tr>
	<?php 
	}
	?>
	</tbody>
</table>
	</div> 
	
	<?php
	 
	

	
} else { ?>
	
	<div class="col-sm-9">
	<h1 tabindex="0" <?php echo $geth1class;?> ><?php echo $title = drupal_get_title();?></h1>
	<div tabindex="0">

	<? if($body!="1")
	{
		?><div tabindex="0"><?php print render($page['content']); ?></div> 
		<?php
	}  
	elseif($body=="1"){
	 $url=drupal_get_path_alias();
	echo '<div style="clear:both"></div>';
    echo render($page['preface_middle']).'<br><a href="'.$base_url.'/'.$url_alias.'" title="'.$base_url.'/'.$url_alias.'">'.$base_url.'/'.$url_alias.'</a>';
	}
	else{
		?>
		<div tabindex="0"><?php print render($page['content']); ?></div>
<?php		}
?><?php $views_page = views_get_page_view();
if (is_object($views_page)) {
	echo "";
}
else{
	echo '<div style="clear:both"></div>';
 echo '<div class="page-update" id="notfound'.$node->changed.'"><time datetime="'.date('d-m-Y', $node->changed).'">Page last updated: '.date('d-m-Y', $node->changed).'</time></div>';
}
 ?>
	
	</div>
	</div>
	
	<? } ?>
	<? } else { ?>
	
	<div class="col-sm-9">
	<h1 tabindex="0" <?php echo $geth1class;?> ><?php echo $title = drupal_get_title();?></h1>
	<?
	
if($body!="1")
	{
		?><div tabindex="0"><?php print render($page['content']); ?></div> 
		<?php
	}  
	elseif($body=="1"){
	 $url=drupal_get_path_alias();
	echo '<div style="clear:both"></div>';
    echo render($page['preface_middle']).'<br><a href="'.$base_url.'/'.$url_alias.'" title="'.$base_url.'/'.$url_alias.'">'.$base_url.'/'.$url_alias.'</a>';
	}
	else{
		?>
		<div tabindex="0"><?php print render($page['content']); ?></div>
<?php		}
?><?php $views_page = views_get_page_view();
if (is_object($views_page)) {
	echo "";
}
else{
echo '<div style="clear:both"></div>';
 echo '<div class="page-update" id="notfound'.$node->changed.'"><time datetime="'.date('d-m-Y', $node->changed).'">Page last updated: '.date('d-m-Y', $node->changed).'</time></div>';
}
 ?>

	
	
	
	
	</div>
	<? } ?>

    <div class="col-sm-3">
	<div class="news-box">
	
	<?php 
     $cpath= current_path();
     if(($title != "Latest News")){
		 print render($page['notice_alert']);
	}	 
		
	if(($cpath != "main-department")){
		 print render($page['district_pofile']);
	}		 
		
		if(($cpath != "district-department")){
		print render($page['district_information']);
	}		 
		
	 if(($cpath != "important-notice")){
		 print render($page['sectors_departments']);
	}	
	// if(($cpath != "HelpLine")){
		 // print render($page['HelpLine']);
	// }		
		?>
			
		</div>
	
	
	<div style="clear:both"></div>
	</div>
</div>
</div>
<?php endif;?>
<div class="footerwhite">
<div class="container">
<div class="row">
<?php print render($page['footer']); ?>
</div>
</div>
</div>
<div class="footer-bg">
<div class="col-sm-12 footer-01">

	<div class="container">
		<div class="row footer02">
		
		<div class="col-sm-12"><?php print render($page['footer_one']); ?></div>
		<div class="col-sm-3"><?php print render($page['footer_first']); ?></div>
		<div class="col-sm-3"><?php print render($page['footer_second']); ?></div>
		<div class="col-sm-3"><?php print render($page['footer_third']); ?></div>
		<div class="col-sm-3"><?php print render($page['footer_fourth']); ?></div>
		<div class="col-sm-12 hindi<?php print $lang=$language->language;?>"><?php print render($page['footer_menu']); ?></div>
		<div class="col-sm-12 hindi<?php print $lang=$language->language;?>"><?php print render($page['footer_bottom_link']); ?></div>
      <div class="col-sm-12" tabindex="0"><?php print render($page['social_menu']); ?></div>
	  <div class="col-sm-12 lstupd" tabindex="0">
		<?php
		// get date of most most recent change to a node
		$result = db_query('SELECT title, changed FROM {node} WHERE status=1 ORDER BY changed DESC LIMIT 1');
		$node = $result->fetchObject();
		$date = date('d-M-Y g:i a', $node->changed);
		echo "Last updated: $date";
		?>
		
	 <div class="cssvalid">
	 <?php
		if($lang == 'hi')
		{
			$css = "मान्य CSS!";
			$conformance = "WCAG 2.0 लेवल डबल-ए कन्फॉर्मेंस का स्पष्टीकरण";
			$conformance_alt = "स्तर डबल-ए अनुरूपता, W3C WAI वेब सामग्री एक्सेसबिलिटी दिशानिर्देश 2.0";
			$acheckker = "WCAG 2.0 (Level A)";			
		}
		else
		{
			$css = "Valid CSS!";
			$conformance = "Explanation of WCAG 2.0 Level Double-A Conformance";
			$conformance_alt = "Level Double-A conformance,W3C WAI Web Content Accessibility Guidelines 2.0";
			$acheckker = "WCAG 2.0 (Level A)";
		}
	 ?>
          <a href="https://jigsaw.w3.org/css-validator/validator?uri=<?php print $GLOBALS['base_url'];?>" title="<?php echo $css; ?>" target="_blank">
		  <img style="border:0;width:88px;height:31px"  src="https://jigsaw.w3.org/css-validator/images/vcss-blue" alt="<?php echo $css; ?>" /></a>
          <a href="https://www.w3.org/WAI/WCAG2AA-Conformance" title="<?php echo $conformance; ?>" target="_blank">
          <img height="32" width="88" src="https://www.w3.org/WAI/wcag2AA" alt="<?php echo $conformance_alt; ?>"></a>
		  <a href="https://achecker.ca/checker/index.php?uri=referer&gid=WCAG2-A" target="_blank" title="<?php echo $acheckker; ?>">
         <img src="https://achecker.ca/images/icon_W2_a.jpg" alt="<?php echo $acheckker; ?>" height="32" width="102" />
         </a>
 </div>
		 </div>
		 </div>
		</div>
	</div>
</div> 
</div>