<div class="main">
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
	   <article>
	   <div class="home-content">
	     <h2 class="title"><?php echo $node->title;?></h2>
		 <?php //print render($page['content']);
echo $node->body['und'][0]['summary'];
//echo "<pre>";print_r($node);
?>
		</div>
		</article>
		
	</div><!-- content left end-->
	  
	<div class="col-md-4 side-bar"> <!-- content right-->
		   
		<?php // print render($page['sidebar_first']); ?>
		  <?php print render($page['gallery']); ?>
	     <div class="chairman">
		  <?php print render($page['chairman_pic']); ?>
		  </div>
		  <div class="ministers">
		  <?php print render($page['ministers_pic']); ?>
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
</div>
