 <?php
 $site_slogan = variable_get('site_slogan', "Default site name");
 $new =render($node);
//$front = url(variable_get('site_frontpage', 'node'));
	$big_array = get_object_vars($new);
	$mystring = variable_get('username',"virtual site name");
 $mystring2 = variable_get('menu',"virtual site name");
    $findme   = 'user';
    $pos = strpos($mystring, $findme);

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
  }
  if($lang=="en"){
	  $india="Government of India";
    $base_url=$baseurl.'/hi';
	$geth1class = 'class="h1classeng"';
	 $ilink="Important Links";
	$logoa1='Central Water Commission';
$logoa2='(Serving the nation since 1945)';
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
					<img src="<?=$GLOBALS['base_url']?>/sites/all/themes/nexus/images/flag.jpg" alt="india flag image"><?php echo " ".$india ?>
				</div>
				<div class="num">
					<ul>
					<li><a href="<?=$GLOBALS['base_url']?>" class="home"><span class="glyphicon glyphicon-home"></span>
</a></li>
					<li> <?php print render($page['skip_to_main']); ?></li>
					<li><?php print render($page['style_switcher']); ?></li>
					<li><?php print render($page['textsize']); ?></li>
					<li><?php print render($page['language_tran']); ?></li>
					
					
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
				 
 if ($pos === false) {
       print render($page['header']);
    }
elseif($mystring2=="main_menu"){
		print render($page['header']);
	}
    else {
       print render($page['header2']);
        
    }	
		 

			  ?>
				
				<?php print render($page['search']); ?>
			  </div>
			</div>
	  
	   
   </div>
    </div>
	 </div>
	 
	 
	 
	 
<?php if ($breadcrumb): ?><div id="breadcrumbs"><div class="container"><?php print $breadcrumb; ?></div></div><?php endif; ?>		
			
			
	</div>
	<!-- header-section-ends-here -->


<div class="main">


 <?php
if (drupal_is_front_page()):
    ?> 
    <div class="container">
<div class="newsmarquee">
<div class="col-sm-2 newsleft" tabindex="0"><?php echo  theme_get_setting('latest_news'); ?></div>
<div class="col-sm-10 news-slider"><?php print render($page['homepage_news_slider']); ?></div>
</div>

 <div style="clear:both"></div>
 <div id="maincontain-textsize">
  <div class="col-md-8 content-left "> <!-- content left-->
	  
    <div class="main-banner-01">
		<?php print render($page['slide_show']); ?>
	   </div>
	   <div class="home-content">
	     <?php print render($page['content']);?>
		</div>
		
	</div><!-- content left end-->
	  
	<div class="col-md-4 side-bar"> <!-- content right-->
		   
		<?php // print render($page['sidebar_first']); ?>
		  <?php print render($page['gallery']); ?>
		  <div class="chairman">
	  <?php print render($page['ministers_pic']); ?>

			  </div>
		  <div class="ministers">
	  <?php print render($page['chairman_pic']); ?>

			  </div>
		  
		  <div class="list_vertical">
		  <?php print render($page['notice_alert']); ?>
		  </div>
		    <?php print render($page['district_pofile']); ?>
	 </div><!-- content right end-->
   
   <div class="col-sm-12 bottomview">
   <div class="content-bottom">
		<?php print render($page['content_bottom']);?>
		</div>
   </div>
   
   
<div style="clear:both"></div>
<div class="bottom-content-slider">
<?php //print render($page['footer_third']); ?>
</div>

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
	$transleted_url=$array_val['en']['nid'];
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
			$field_discriptions = "विवरण";
			$fieldreferencenumbers = "संदर्भ क्रमांक";
			$field_circular_order_no="परिपत्र / आदेश संख्या.";
			$field_issued_by="द्वारा जारी";
			$field_important_notice_date="तारीख";
		}else{
		$url_alias=drupal_get_path_alias('node/'.$transleted_url, 'en');
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
			$field_discriptions = "Discriptions";
			$fieldreferencenumbers = "Reference Numbers";
		    $field_circular_order_no="Circular/Order No.";
			$field_issued_by="Issued by";
			$field_important_notice_date="Date";
			
			
		} 
		//print_r (menu_get_item());
	$new =render($node);
	$big_array = get_object_vars($new);
	if ($node->type=='important_notice' || $node->type=='news' || $node->type=='recruitment' || $node->type=='tender' || $node->type=='revenue'|| $node->type=='kgbo_recruitment' || $node->type=='kgbo_tenders' || $node->type=='kgbo_orders'){ ?>
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
	  $discriptions = render(field_view_field('node', $node, 'field_discriptions',array('label'=>'hidden')));
	  $reference_numbers = render(field_view_field('node', $node, 'field_reference_numbers',array('label'=>'hidden')));
	  $field_r = render(field_view_field('node', $node, 'field_r',array('label'=>'hidden')));
	  $field_reference_number = render(field_view_field('node', $node, 'field_reference_number',array('label'=>'hidden')));
	  //$external_link = render(field_view_field('node', $node, 'field_internal_external_link',array('label'=>'hidden')));
	  
	   $field_circular_order_nos = render(field_view_field('node', $node, 'field_circular_order_no',array('label'=>'hidden')));
	  $field_issued_bys = render(field_view_field('node', $node, 'field_issued_by',array('label'=>'hidden')));
	 
	  
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
	if($discriptions != ""){
	?>
	<tr>
	    <th><?php echo $field_discriptions; ?></th>
	    <td><?php echo $discriptions; ?></td>
	</tr>
	<?php 
	}
	if($reference_numbers != "" || $field_reference_number !=""){
	?>
	<tr>
	    <th><?php echo $fieldreferencenumbers; ?></th>
	    <td><?php echo $field_reference_number.''.$reference_numbers; ?></td>
	</tr>
	<?php 
	}
	if($field_r != ""){
	?>
	<tr>
	    <th><?php echo $fieldreferencenumbers; ?></th>
	    <td><?php echo $field_r; ?></td>
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
	if($field_circular_order_nos != ""){
	?>
	<tr>
	    <th><?php echo $field_circular_order_no; ?></th>
	    <td><?php echo $field_circular_order_nos;  ?></td>
	</tr>
	<?php 
	}
	if($field_issued_bys != ""){
	?>
	<tr>
	    <th><?php echo $field_issued_by; ?></th>
	    <td><?php echo $field_issued_bys;  ?></td>
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
		
	
	 if(($cpath != "HelpLine")){
		print render($page['HelpLine']);
	 }		

		?>
		  <div class="list_vertical">
		  
		  </div>
		    <?php print render($page['district_pofile']); ?>
			
		</div>
	
	
	<div style="clear:both"></div>
	</div>
</div>
</div>
<?php endif;?>
<!-- content-section-ends-here -->

<div class="btm-bg">
	
	<div class="container">
	
	<div class="row">
  <?php print render($page['footer']); ?>
</div>
	
	
	</div>
	
	
	
	</div>
	
	

	
	<!-- footer-section-starts-here -->
	<div class="footer">
		<div class="footer-top">
			<div class="wrap">
				
				<div class="col-md-4 footer-grid">
             <h4 class="footer-head"><?php echo $ilink;?></h4>
					<?php print render($page['footer_first']); ?>
				</div>
				<div class="col-md-4 footer-grid external-link">
				<?php print render($page['footer_third']); ?>
				</div>

				<div class="col-md-4 footer-grid">
					<?php print render($page['footer_second']); ?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="wrap">
				<div class="copyrights col-md-9">
			<?php print render($page['copy_right']); ?>

				</div>
				<div class="footer-social-icons col-md-3">
					<?php print render($page['social_link']); ?>
				</div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>
	<!-- footer-section-ends-here -->

<a href="#to-top" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
<!---->
</div>


